<div class="container-fluid d-flex h-100 flex-column ">
    <!-- Alert Section  -->
    <div id="alert" class="w-50 position-absolute" style="z-index: 1; top:10%; left: 25%;">
    </div>
    <!-- Register Section  -->
    <div class="row m-auto">
        <div class="col col-xs-12">
            <h4 class="mb-0 text-center">Join us and be part of our team!</h4>
            <div class="p-4 ">
                <form method="post" action="" id="create_form">
                    <div class="row pt-1 pb-4 boder-bottom">
                        <div class="col">
                            <small>Choose Department</small>
                            <select class="form-select" name="type" id="department_type">
                                <option value="1">Runner</option>
                                <option value="2">Staff</option>
                            </select>
                        </div>
                        <div class="col-6" id="plat_num">
                            <small>Vehicle Registration Number</small>
                            <input type="text" class="form-control" name="plat_num" placeholder="Enter your plate number">
                        </div>
                    </div>
                    <div class="row pt-4 pb-2 border-top">
                        <div class="col">
                            <small>Full Name</small>
                            <input type="text" class="form-control" name="full_name" placeholder="Enter your full name" required>
                        </div>
                    </div>
                    <div class="row pb-4">
                        <div class="col">
                            <small>Email Address</small>
                            <input type="text" class="form-control" name="email" placeholder="Enter your email address" required>
                        </div>
                        <div class="col">
                            <small>Contact Number</small>
                            <input type="text" class="form-control" name="contact_number" placeholder="Enter your contact number" required>
                        </div>
                    </div>
                    <div class="row pt-4 border-top">
                        <div class="col-6">
                            <small>Username</small>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Choose a username" id="username" pattern="^[A-Za-z]{4,}$" title="Minimum 4 characters." required>
                            <small id="username_info" class="text-muted">
                                Minimum 4 characters.
                            </small>
                        </div>
                        <div class="col">
                            <small>Password</small>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Create a password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Minimum 8 characters, at least one letter and one number." required>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col offset-6">
                            <small>Confirm Password</small>
                            <input type="password" class="form-control input-lg" name="confirm_password" id="confirm_password" placeholder="Confirm your password" required>
                            <small id="password_info" class="text-muted">
                                Minimum 8 characters, at least one letter and one number.
                            </small>
                        </div>
                    </div>
                    <div class="form-group mb-3 input-group-lg">
                        <span class="text-danger"><?php echo $this->session->flashdata("error") ?></span>
                    </div>
                    <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                        <a href="<?php echo base_url(); ?>login" class="text-primary">
                            <i class="fas fa-chevron-left fa-fw fa-sm"></i> Back to login
                        </a>
                        <div class="position-absolute text-center top-50 start-50 translate-middle bg-white p-3 rounded-3 shadow" id="load_info" style="display: none;">
                            <img src='<?php echo base_url(); ?>assets/img/load.gif' width='100px' height='100px' alt="No image">
                            <p>Creating your account..</p>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="submit" id="join_btn">
                            <i class="fas fa-sign-in-alt fa-fw fa-sm"></i> Join Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Footer Section -->
<footer>
    <div class="text-center py-2">
        <small>&copy; RushRepairPC 2022 </small>
    </div>
</footer>
<script>
    $(document).ready(function() {

        var errors = {
            "usr": "0",
            "pwd": "0"
        };

        $('#department_type').on('change', function() {
            if ($('#department_type').val() == '1') {
                $('#plat_num').show();
            } else {
                $('#plat_num').hide();
            }
        });

        // Compare password function
        $('#password, #confirm_password').on('keyup', function() {
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

        // Validate existing username ajax call
        $('#username').on('keyup', function() {
            var username = this.value;

            $.ajax({
                url: '<?php echo base_url(); ?>login/check_username',
                method: 'POST',
                data: {
                    username: username
                },
                dataType: 'JSON',
                success: function(output) {
                    if (output != 0 || username.length <= 4) {
                        $('#username').addClass("border border-danger");
                        $('#username_info').html("Username not available.").addClass("text-danger").removeClass("text-muted");
                        errors['usr'] = '1';
                    } else {
                        $('#username').removeClass("border border-danger");
                        $('#username_info').html("Minimum 4 characters.").addClass("text-muted").removeClass("text-danger");
                        errors['usr'] = '0';
                    }
                }
            })

        })

        // Register staff account ajax call
        $('#create_form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            if (errors['pwd'] === '1' || errors['usr'] === '1') {
                $('#alert').replaceWith('<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                    '<i class="fas fa-exclamation-circle fa-fw"></i> You should check in on some of those fields below.' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '</div>');
            } else {
                $.ajax({
                    url: '<?php echo base_url() . 'login/create_staff'; ?>',
                    type: 'POST',
                    data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $("#load_info").addClass("d-inline-block");
                        $("#load_info").show();
                        $("#join_btn").attr("disabled", true);
                        $("body").attr("style", 'background: rgb(0,0,0,0.7);');
                    },
                    success: function(data) {
                        if (data == true) {
                            window.location.replace('<?php echo base_url(); ?>');
                        } else {
                            window.location.replace('<?php echo base_url() . 'register'; ?>');
                        }
                    }
                });
            }
        });

    });
</script>