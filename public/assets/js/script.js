$(document).ready(function () {
    $('#myTable').DataTable();
    $('#merk').change(function () {
        if ($(this).val() === 'other') {
            $('#merk_other').show();
        } else {
            $('#merk_other').hide();
        }
    });
});