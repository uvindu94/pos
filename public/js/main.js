$(document).ready(function () {
    // Global Confirmation for Destructive Actions
    $(document).on('submit', '.confirm-delete', function (e) {
        e.preventDefault();
        let form = this;
        let title = $(this).data('title') || 'Are you sure?';
        let text = $(this).data('text') || "You won't be able to revert this!";

        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444', // Red for delete
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Global Alert for Generic Confirmations
    $(document).on('click', '.confirm-action', function (e) {
        e.preventDefault();
        let link = $(this).attr('href');
        let title = $(this).data('title') || 'Are you sure?';
        let text = $(this).data('text') || "";

        Swal.fire({
            title: title,
            text: text,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4361ee',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, proceed'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});
