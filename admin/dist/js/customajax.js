

  
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
