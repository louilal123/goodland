<?php
require_once __DIR__ . '/admin/classes/Main_class.php';
require_once "classes/config.php"; 

$mainClass = new Main_class();

if (isset($_GET['id'])) {
    $encryptedId = $_GET['id'];
    $fileId = encryptor('decrypt', $encryptedId); 
    $file_details = $mainClass->getFileById($fileId);

    if ($file_details) {
        $file = $file_details[0]; 
        ?>
        
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
    <style>
        .custom-btn {
            border-radius: 0px !important;
        }

        .uniform-image {
            width: 100%;
            max-width: 100%;
            height: 500px;
            object-fit: cover;
        }
    </style>
</head>

<body class="blog-page">

<?php include "includes/topnav.php"; ?>
<main class="main mt-4">

    <div class="page-title mt-4">
        <div class="heading mt-4">  
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                       
                     
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index">Home</a></li>
                    <li><a href="library.php">Library</a></li>
                    <li class="current"><?php echo htmlspecialchars($file['title']); ?></li>
                </ol>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <section id="file-details" class="file_details section">
                    <div class="container">
                        <div class="row gy-4">
                            <div class="col-lg-12">
                                <h3 class="mb-2"><q><?php echo htmlspecialchars($file['description']); ?></q></h3>
                                <br>
                                <img src="<?php echo htmlspecialchars($file['cover_path']); ?>" alt="File Cover Image" class="img-fluid uniform-image mb-4">
                                <p><strong>Uploaded on:</strong> <?php echo date('F j, Y', strtotime($file['upload_date'])); ?></p>
                                <hr>
                                <p>File size: <a href="<?php echo htmlspecialchars($file['file_path']); ?>" target="_blank">Download Here</a></p>
                                <a href="javascript:void(0);" class="btn custom-btn" onclick="requestFileCopy('<?php echo $file['id']; ?>', '<?php echo htmlspecialchars($file['title']); ?>')">
    Request a copy
</a>
  
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

</main>

<?php include "includes/footer.php"; ?>
<script>
    // Function to open the SweetAlert modal for file requests
function requestFileCopy(fileId, fileTitle) {
    Swal.fire({
        title: `Request a copy of "${fileTitle}"`,
        input: "email",
        inputPlaceholder: "Enter your email",
        inputAttributes: {
            autocapitalize: "off"
        },
        showCancelButton: true,
        confirmButtonText: "Submit Request",
        showLoaderOnConfirm: true,
        preConfirm: (email) => {
            if (!email) {
                Swal.showValidationMessage("Please enter a valid email.");
                return false;
            }
            // Send request details to server
            return fetch("handle_request.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ email: email, fileId: fileId })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(response.statusText);
                }
                return response.json();
            })
            .catch(error => {
                Swal.showValidationMessage(`Request failed: ${error}`);
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Request Sent",
                text: "Your request has been submitted successfully.",
                icon: "success"
            });
        }
    });
}

</script>
</body>
</html>

<?php
    } else {
        echo '<p>File not found.</p>';
    }
} else {
    echo '<p>No file selected.</p>';
}
?>
