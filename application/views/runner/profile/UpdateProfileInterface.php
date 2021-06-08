<div class="wrapper position-relative">
    <!-- alert  -->
    <div id="alert" class="w-50 position-absolute top-0 start-50 translate-middle mt-5" style="z-index: 1;">
        <?php
        if ($this->session->tempdata('notice') != NULL) {
            echo '<div class="alert alert-success shadow alert-dismissible fade show" role="alert">';
            echo '<i class="fas fa-info-circle fa-fw"></i> ' . $this->session->tempdata('notice');
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        }
        if ($this->session->tempdata('error') != NULL) {
            echo '<div class="alert alert-danger shadow alert-dismissible fade show" role="alert">';
            echo '<i class="fas fa-exclamation-circle fa-fw"></i> ' . $this->session->tempdata('error');
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        }
        ?>
    </div>
    <div class="container p-5" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Update Profile</h3>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3 mx-3">
                <p>Update your personal and vehicle information</p>
            </div>
        </div>
        <form method="post" action="" id="profile_form">
            <?php
            if (is_array($profile)) {
                foreach ($profile as $row) {
            ?>
                    <div class="row mx-3 border-start border-2">
                        <div class="col-4">
                            <div class="form-group pb-2">
                                <small class="text-muted">Full Name</small>
                                <input type="text" class="form-control" name="full_name" value="<?php echo $row['rd_full_name']; ?>" required>
                            </div>
                            <div class="form-group pb-2">
                                <small class="text-muted">Contact Number</small>
                                <input type="number" class="form-control" name="contact_number" value="<?php echo $row['rd_phone']; ?>" required>
                            </div>
                            <div class="form-group pb-2">
                                <small class="text-muted">Registration Number</small>
                                <input type="text" class="form-control" name="plat_num" value="<?php echo $row['rd_plat_num']; ?>" required>
                            </div>
                            <div class="form-group pb-2">
                                <small class="text-muted">Upload Profile Picture</small>
                                <input class="form-control" type="file" name="picture">
                            </div>
                            <div class="form-group pb-2">
                                <small class="text-muted">Change Username</small>
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo $row['ud_usr']; ?>">
                                <small id="username_info" class="text-muted">
                                    Minimum 4 characters.
                                </small>
                            </div>
                        </div>
                        <div class="col-4 text-center">
                            <div class="pb-2">
                                <?php if ($row['ud_pic'] != "") {
                                    echo '<div class="rounded-circle bg-white d-inline-flex align-middle shadow mb-4"><img src="' . base_url() . 'assets/img/profile/thumbnail/' . $row['ud_pic'] . '" class="img-fluid rounded-circle shadow border border-5 border-white" width="250"></div>';
                                } else {
                                    echo '<div class="rounded-circle bg-white d-inline-flex p-5 align-middle shadow mb-4"><i class="fas fa-user fa-4x text-secondary" width="250"></i></div>';
                                }
                                ?>
                            </div>
                            <div class="pb-2 ">
                                <button type="submit" class="btn btn-primary" name="submit">UPDATE PROFILE</button>
                            </div>
                            <div class="form-group pb-2">
                                <small>
                                    <a href="#" type="button" class="text-primary " data-bs-toggle="modal" data-bs-target="#change_password_modal">
                                        Change your password
                                    </a>
                                </small>
                            </div>
                            <div class="pb-2 ">
                                <small>
                                    <a href="#" type="button" class="text-danger " data-bs-toggle="modal" data-bs-target="#deactivate_modal">
                                        Deactivate account
                                    </a>
                                </small>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </form>
    </div>
</div>
<!-- Changee password modal -->
<div class="modal fade" id="change_password_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="password_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group py-2">
                        <small>Enter Old Password</small>
                        <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Enter your old password" required>
                    </div>
                    <div class="form-group py-2">
                        <small>Change Your Password</small>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Choose your new password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Minimum 8 characters, at least one letter and one number." required>
                    </div>
                    <div class="form-group pb-2">
                        <small>Confirm Password</small>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm your new password" required>
                        <small id="password_info" class="text-muted">
                            Minimum 8 characters, at least one letter and one number.
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Deactivate account modal -->
<div class="modal fade" id="deactivate_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="deactivate_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group py-2">
                        <small>Enter Your Password</small>
                        <input type="password" class="form-control" name="password" placeholder="Enter your old password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-danger">Confirm Deactivate</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        var errors = {
            "usr": "0",
            "pwd": "0"
        };

        // password comparison for setup
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

        // check username availability ajax call function
        $('#username').on('keyup', function() {
            var username = this.value;

            $.ajax({
                url: '<?php echo base_url(); ?>login/check_username',
                method: 'post',
                data: {
                    username: username
                },
                dataType: 'json',
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

        // setup userdata ajax call function
        $('#deactivate_form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '<?php echo base_url() . 'runner/profile/deactivate_account'; ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data == 'true') {
                        window.location.replace('<?php echo base_url(); ?>');
                    } else {
                        window.location.replace('<?php echo base_url() . 'runner/profile/update'; ?>');
                    }
                }
            });
        });

        // setup userdata ajax call function
        $('#password_form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            if (errors['pwd'] === '1') {
                $('#alert').replaceWith('<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                    '<i class="fas fa-exclamation-circle fa-fw"></i> Password missmatch, enter your password again.' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '</div>');
            } else {
                $.ajax({
                    url: '<?php echo base_url() . 'runner/profile/set_password_change'; ?>',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        window.location.replace('<?php echo base_url() . 'runner/profile/update'; ?>');
                    }
                });
            }
        });

        // setup userdata ajax call function
        $('#profile_form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            if (errors['usr'] === '1') {
                $('#alert').replaceWith(
                    '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                    '<i class="fas fa-exclamation-circle fa-fw"></i> Username not available, please choose another username.' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '</div>'
                );
            } else {
                $.ajax({
                    url: '<?php echo base_url() . 'runner/profile/set_profile_update'; ?>',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data == 'true') {
                            window.location.replace('<?php echo base_url() . 'runner/profile'; ?>');
                        } else {
                            window.location.replace('<?php echo base_url() . 'runner/profile/update'; ?>');
                        }
                    }
                });
            }
        });

    });
</script>