// Sweetalert
const error = $('.error').data('flashdata');
const sukses = $('.sukses').data('flashdata');

if (error) {
    Swal.fire({
        title: 'Error',
        text: error,
        icon: 'error',
        showConfirmButton: false,
        timer: 1500
    })
}

if (sukses) {
    Swal.fire({
        title: 'Notifikasi',
        text: sukses,
        icon: 'success',
        showConfirmButton: false,
        timer: 1500
    })
}
// Swal.fire({
//     title: 'Are you sure?',
//     text: "You won't be able to revert this!",
//     icon: 'warning',
//     showCancelButton: true,
//     confirmButtonColor: '#3085d6',
//     cancelButtonColor: '#d33',
//     confirmButtonText: 'Yes, delete it!'
// }).then((result) => {
//     if (result.isConfirmed) {
//         Swal.fire(
//             'Deleted!',
//             'Your file has been deleted.',
//             'success'
//         )
//     }
// })