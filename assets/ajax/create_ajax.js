$(document).ready(function () {

    var errors = {"usr":"0","pwd":"0"};

    // password comparison for setup
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() != $('#confirm_password').val()) {
            $('#confirm_password').addClass("border border-danger");
            $('#password_info').html("Password do not match!").addClass("text-danger").removeClass("text-muted");
            errors['pwd'] = '1'; 

        } else {
            $('#confirm_password').removeClass("border border-danger");
            $('#password_info').html("Minimum 8 characters, at least one letter and one number.").addClass("text-muted").removeClass("text-danger");
            errors['pwd'] = '0'; 

        }
    });

    // check username availability ajax call function
    $('#username').on('keyup', function () {
        var username = this.value;
        $.ajax({
            type: "POST",
            data:{submit:'check_username',username:username},
            dataType: 'JSON',
            success: function (data) {
                if (data != 0 || username.length <= 4) {
                    $('#username').addClass("border border-danger");
                    $('#username_info').html("Username not available.").addClass("text-danger").removeClass("text-muted");
                    errors['usr'] = '1'; 
                } else {
                    $('#username').removeClass("border border-danger");
                    $('#username_info').html("Minimum 4 characters.").addClass("text-muted").removeClass("text-danger");
                    errors['usr'] = '0'; 
                }
            }
        });
    });

    // setup userdata ajax call function
    $('#create_form').on('submit',function(e){
        e.preventDefault();
        var formData = new FormData(this);

        if (errors['pwd'] === '1' || errors['usr'] === '1') {
            $('#alert').replaceWith('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
                '<i class="fas fa-exclamation-circle fa-fw"></i> You should check in on some of those fields below.'+
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                '</div>');
        } else {
            $.ajax({
                type: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData:false,
                success: function (data) {
                    if (data == 'true') {
                        window.location.replace('manage');
                    } else {
                        window.location.replace('setup?error=setup_error');
                    }
                }
            });
        }
    });

});