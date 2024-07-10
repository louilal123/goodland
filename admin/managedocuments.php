<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

<link rel="stylesheet" href="dist/custom.css">

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper"> 
           <?php 
            include "includes/topnav.php"; ?>
            <main class="app-main">
            <div class="app-content-header"> 
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Manage Documents</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Manage Documents
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content"> 
                <div class="container-fluid"> 
                    <div class="row">
                    <div class="col-md-12">
                            <div class="card mb-4 card-outline-primary">
                            <div class="card-header d-flex ">
                                <h3 class="card-title mb-0">List of Documents</h3>
                                <a class="btn btn-primary ms-auto custombtn" data-bs-toggle="modal" data-bs-target="#addDocumentModal">Add New Document</a>
                            </div>
 
                                <div class="card-body">
                                    <div class="container-fluid">
                                <table id="myTable" class="table-responsive table table-hover table-striped w-100">
                                <thead>
                               
                                <tr>
                                    <th>File ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Publication Date</th>
                                    <th>Category</th>
                                    <th>Uploaded By</th>
                                    <th>Uploaded At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($documents as $document): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($document['file_id']); ?></td>
                                        <td><?php echo htmlspecialchars($document['title']); ?></td>
                                        <td><?php echo htmlspecialchars($document['author']); ?></td>
                                        <td><?php echo htmlspecialchars($document['publication_date']); ?></td>
                                        <td><?php echo htmlspecialchars($document['status']); ?></td>
                                        <td><?php echo htmlspecialchars($document['uploaded_by']); ?></td>
                                        <td><?php echo htmlspecialchars($document['uploaded_at']); ?></td>
                                        <td>
                                        <button class="btn btn-info btn-sm viewDocumentBtn" data-bs-toggle="modal" data-bs-target="#viewDocumentModal"><i class="bi bi-eye"></i></button>
                                        <a href="#" class="btn btn-success btn-sm editDocumentBtn" data-bs-toggle="modal" data-bs-target="#editDocumentModal"><i class="bi bi-pencil-square"></i></a>
                                        <a href="classes/delete_document.php?id=<?=$document['file_id']; ?>" class="btn btn-danger btn-sm deleteDocumentBtn"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                           
                            </table>
                                </div> 
                                </div>
                            </div> <!-- /.card -->
                        </div> <!-- /.col -->
                        
                    </div> 
                </div>
                
<!-- View Document Modal -->
<div class="modal" id="viewDocumentModal" tabindex="-1" aria-labelledby="viewDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="viewDocumentModalLabel">View Document Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="viewDocumentForm">
                    <div class="row">
                        <div class="col">
                            <label for="file_id1" class="form-label">File ID</label>
                            <input type="text" class="form-control" name="file_id" id="file_id1" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="title1" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title1" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="author1" class="form-label">Author</label>
                            <input type="text" class="form-control" name="author" id="author1" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="publication_date1" class="form-label">Publication Date</label>
                            <input type="text" class="form-control" id="publication_date1" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="category1" class="form-label">Category</label>
                            <input type="text" class="form-control" id="category1" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="description1" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description1" readonly></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="uploaded_by1" class="form-label">Uploaded By</label>
                            <input type="text" class="form-control" id="uploaded_by1" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="uploaded_at1" class="form-label">Uploaded At</label>
                            <input type="text" class="form-control" id="uploaded_at1" readonly>
                        </div>
                    </div>
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary custombtn" data-bs-dismiss="modal">Close</button>
                   </div>
                </form>
            </div>
        </div>
    </div>
</div>
                
<!-- Edit Document Modal -->
<div class="modal" id="editDocumentModal" tabindex="-1" aria-labelledby="editDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editDocumentModalLabel">Edit Document</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="classes/documents_crud.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="file_id" id="file_id" readonly>
                    <div class="row">
                        <div class="col">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?php echo $_SESSION['form_data']['title'] ?? ''; ?>">
                            <?php if (isset($_SESSION['error_title'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_title']; unset($_SESSION['error_title']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" name="author" id="author" value="<?php echo $_SESSION['form_data']['author'] ?? ''; ?>">
                            <?php if (isset($_SESSION['error_author'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_author']; unset($_SESSION['error_author']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="publication_date" class="form-label">Publication Date</label>
                            <input type="date" class="form-control" name="publication_date" id="publication_date" value="<?php echo $_SESSION['form_data']['publication_date'] ?? ''; ?>">
                            <?php if (isset($_SESSION['error_publication_date'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_publication_date']; unset($_SESSION['error_publication_date']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" name="category" id="category" value="<?php echo $_SESSION['form_data']['category'] ?? ''; ?>">
                            <?php if (isset($_SESSION['error_category'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_category']; unset($_SESSION['error_category']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description"><?php echo $_SESSION['form_data']['description'] ?? ''; ?></textarea>
                            <?php if (isset($_SESSION['error_description'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_description']; unset($_SESSION['error_description']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary custombtn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update" class="btn btn-primary custombtn">Update</button>
                   </div>
                </form>
            </div>
        </div>
    </div>
</div>
                <!-- Add Document Modal -->
                <div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="addDocumentModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="addDocumentModalLabel">Add New Document</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="classes/documents_crud.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title" id="title" value="<?php echo $_SESSION['form_data']['title'] ?? ''; ?>">
                                            <?php if (isset($_SESSION['error_title'])): ?>
                                                <p class="error text-danger"><?php echo $_SESSION['error_title']; unset($_SESSION['error_title']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label for="author" class="form-label">Author</label>
                                            <input type="text" class="form-control" name="author" id="author" value="<?php echo $_SESSION['form_data']['author'] ?? ''; ?>">
                                            <?php if (isset($_SESSION['error_author'])): ?>
                                                <p class="error text-danger"><?php echo $_SESSION['error_author']; unset($_SESSION['error_author']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label for="publication_date" class="form-label">Publication Date</label>
                                            <input type="date" class="form-control" name="publication_date" id="publication_date" value="<?php echo $_SESSION['form_data']['publication_date'] ?? ''; ?>">
                                            <?php if (isset($_SESSION['error_publication_date'])): ?>
                                                <p class="error text-danger"><?php echo $_SESSION['error_publication_date']; unset($_SESSION['error_publication_date']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label for="category" class="form-label">Category</label>
                                            <input type="text" class="form-control" name="category" id="category" value="<?php echo $_SESSION['form_data']['category'] ?? ''; ?>">
                                            <?php if (isset($_SESSION['error_category'])): ?>
                                                <p class="error text-danger"><?php echo $_SESSION['error_category']; unset($_SESSION['error_category']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" id="description"><?php echo $_SESSION['form_data']['description'] ?? ''; ?></textarea>
                                            <?php if (isset($_SESSION['error_description'])): ?>
                                                <p class="error text-danger"><?php echo $_SESSION['error_description']; unset($_SESSION['error_description']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label for="document_file" class="form-label">Upload Document</label>
                                            <input type="file" class="form-control" name="document_file" id="document_file">
                                            <?php if (isset($_SESSION['error_document_file'])): ?>
                                                <p class="error text-danger"><?php echo $_SESSION['error_document_file']; unset($_SESSION['error_document_file']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="modal-footer mt-4">
                                        <button type="button" class="btn btn-secondary custombtn" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="save" class="btn btn-primary custombtn">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
</body>

<?php include "includes/footer.php"; ?>

</html>
