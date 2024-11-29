// Check for query parameters (message = success or error)
const urlParams = new URLSearchParams(window.location.search);
const message = urlParams.get('message');

// Show the appropriate SweetAlert2 notification
if (message === 'success') {
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Your booking order has been sent successfully!',
        confirmButtonText: 'OK',
        confirmButtonColor: '#28a745'
    });
} else if (message === 'error') {
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: 'Failed to send your booking order. Please try again.',
        confirmButtonText: 'OK',
        confirmButtonColor: '#d33'
    });
}
