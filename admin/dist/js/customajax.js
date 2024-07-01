
$(document).ready(function() {
        $('.deleteBtn').on('click', function(e) {
            e.preventDefault(); 
            
            const href = $(this).attr('href'); 
            Swal.fire({
                title: 'Are you sure?',
                text: 'Admin will be deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
       
        
        $('.viewAdminDetailBtn').on('click', function() {
        const adminId = $(this).data('id');
        
        $.ajax({
            url: 'classes/fetch_admin.php',
            type: 'POST',
            data: { admin_id: adminId },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    $('#adminDetailsContent').html('<p>' + response.error + '</p>');
                } else {
                    let statusBadge = response.status == 'Active' 
                        ? '<span class="badge bg-success">Active</span>' 
                        : '<span class="badge bg-secondary">Inactive</span>';

                    let adminDetailsHtml = `
                        <p> <strong>Photo:</strong> <img src="${response.admin_photo}" alt="Admin Photo" style="width: 200px; 
                                      height: 200px; display:flex; margin:auto;  border: 2px solid #f0f0f0; "> </p>
                        <p><strong>Full Name:</strong> ${response.fullname}</p>
                        <p><strong>Username:</strong> ${response.username}</p>
                        <p><strong>Email:</strong> ${response.email}</p>
                       <p><strong>Date Created:</strong> ${response.date_created}</p>
                        <p><strong>Date Updated:</strong> ${response.date_updated}</p>
                        <p><strong>Status:</strong> ${statusBadge}</p>
                    `;
                    $('#adminDetailsContent').html(adminDetailsHtml);
                }
            },
            error: function() {
                $('#adminDetailsContent').html('<p>An error occurred while fetching the admin details.</p>');
            }
        });
    });

  
    // Edit Admin status 
    // $('.editAdminDetailBtn').on('click', function() {
    //     const adminId = $(this).data('id');

    //     $.ajax({
    //         url: 'classes/fetch_admin.php',
    //         type: 'POST',
    //         data: { admin_id: adminId },
    //         dataType: 'json',
    //         success: function(response) {
    //             if (response.error) {
    //                 $('#editAdminModal .modal-body').html('<p>' + response.error + '</p>');
    //             } else {
    //                 $('#editAdminId').val(response.admin_id);
    //                 $('#editAdminUsername').val(response.username);
    //                 $('#status').val(response.status);
    //                 $('#editAdminModal').modal('show');
    //             }
    //         },
    //         error: function() {
    //             $('#editAdminModal .modal-body').html('<p>An error occurred while fetching the admin details.</p>');
    //         }
    //     });
    // });
});