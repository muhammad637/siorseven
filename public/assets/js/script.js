$(document).ready(function () {
    $('#myTable').DataTable();
    $('#merk').change(function () {
        if ($(this).val() === 'other') {
            $('#merk_other').show();
        } else {
            $('#merk_other').hide();
        }
    });
    // $('#status').change(function () {
    //     if ($(this).val() === 'selesai') {
    //         alert('oke');
    //         $('#status_selesai').show();
    //     } else {
    //         $('#status_selesai').hide();
    //     }
    // });
});