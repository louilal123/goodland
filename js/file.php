
<script>
document.addEventListener('DOMContentLoaded', function () {
    var downloadModal = document.getElementById('downloadModal');
    downloadModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var fileId = button.getAttribute('data-id');
        var fileTitle = button.getAttribute('data-title');
        var filePath = button.getAttribute('data-path');

        var modalTitle = downloadModal.querySelector('#fileTitle');
        var modalFileId = downloadModal.querySelector('#fileId');
        var modalFilePath = downloadModal.querySelector('#filePath');

        modalTitle.textContent = fileTitle;
        modalFileId.value = fileId;
        modalFilePath.value = filePath; // Ensure file path includes 'uploads/'
    });
});
</script>



<script>
document.getElementById('mainSearch').addEventListener('input', function() {
    let filter = this.value.toLowerCase();
    let items = document.querySelectorAll('.document-item');
    let visibleCount = 0;
    items.forEach(function(item) {
        let title = item.querySelector('.custom-card-title').textContent.toLowerCase();
        if (title.includes(filter)) {
            item.style.display = '';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });
    document.getElementById('entryInfo').textContent = `Showing ${visibleCount} of ${items.length} total entries`;
});
</script>



<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const fileModal = document.getElementById('fileModal');
        fileModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const title = button.getAttribute('data-title');
            const description = button.getAttribute('data-description');
            const fileType = button.getAttribute('data-filetype');
            const status = button.getAttribute('data-status');
            const date = button.getAttribute('data-date');
            const uploadedby = button.getAttribute('data-uploadedby');
            const remarks = button.getAttribute('data-remarks');
            const path = button.getAttribute('data-path');

            const modalTitle = fileModal.querySelector('#fileModalTitle');
            const modalPreview = fileModal.querySelector('#fileModalPreview');
            const modalDescription = fileModal.querySelector('#fileModalDescription');
            const modalType = fileModal.querySelector('#fileModalType');
            const modalStatus = fileModal.querySelector('#fileModalStatus');
            const modalUploadedBy = fileModal.querySelector('#fileModalUploadedBy');
            const modalDate = fileModal.querySelector('#fileModalDate');
            const modalRemarks = fileModal.querySelector('#fileModalRemarks');
            const viewFileBtn = fileModal.querySelector('#viewFileBtn');

            modalTitle.textContent = title;
            modalPreview.src = path;
            modalDescription.textContent = description;
            modalType.textContent = fileType;
            // modalStatus.textContent = status; // Update this line if status is available
            modalUploadedBy.textContent = uploadedby; 
            modalDate.textContent = date; // Update this line if date is available
            // modalRemarks.textContent = remarks;

            viewFileBtn.addEventListener('click', () => {
                // Redirect to view the file directly if needed
                window.location.href = path; // Replace with appropriate action
            });
        });
    });
</script>