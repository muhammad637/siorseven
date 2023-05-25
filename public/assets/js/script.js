$(document).ready(function () {
    $('#myTable').DataTable();
    $('#merk').change(function () {
        if ($(this).val() === 'other') {
            $('#merk_other').show();
        } else {
            $('#merk_other').hide();
        }
    });
    $('#eye').addClass('fa fa-eye-slash')
    $('#eye1').addClass('fa fa-eye-slash')
    $('#eye2').addClass('fa fa-eye-slash')
    $('#mybutton').click(function () {
        // $('#currentPassword').attr('value','aan')
        var passwordInputan = $('#currentPassword');
        var passwordFieldTypean = passwordInputan.attr('type');

        // Toggle tampilan password
        if (passwordFieldTypean === 'password') {
            passwordInputan.attr('type', 'text');
            $('#eye1').removeClass('fa fa-eye-slash')
            $('#eye1').addClass('fa fa-eye')
        } else {
            $('#eye1').removeClass('fa fa-eye')
            $('#eye1').addClass('fa fa-eye-slash')
            passwordInputan.attr('type', 'password');
        }
    });
    $('#mybutton2').click(function () {
        var passwordInput = $('#newPassword');
        var passwordFieldType = passwordInput.attr('type');

        // Toggle tampilan password
        if (passwordFieldType === 'password') {
            passwordInput.attr('type', 'text');
            $('#eye').removeClass('fa fa-eye-slash')
            $('#eye').addClass('fa fa-eye')
        } else {
            $('#eye').removeClass('fa fa-eye')
            $('#eye').addClass('fa fa-eye-slash')
            passwordInput.attr('type', 'password');
        }
    });
    $('#mybutton3').click(function () {
        var passwordInput = $('#confirmPassword');
        var passwordFieldType = passwordInput.attr('type');

        // Toggle tampilan password
        if (passwordFieldType === 'password') {
            passwordInput.attr('type', 'text');
            $('#eye2').removeClass('fa fa-eye-slash')
            $('#eye2').addClass('fa fa-eye')
        } else {
            $('#eye2').removeClass('fa fa-eye')
            $('#eye2').addClass('fa fa-eye-slash')
            passwordInput.attr('type', 'password');
            // alert('oke')
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