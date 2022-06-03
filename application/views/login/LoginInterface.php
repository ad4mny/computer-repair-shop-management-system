<div class="container d-flex h-100 flex-column">
    <!-- Alert Section  -->
    <div id="alert" class="w-50 position-absolute top-0 start-50 translate-middle mt-5" style="z-index: 1;">
        <?php
        if ($this->session->tempdata('notice') != NULL) {
            echo '<div class="alert alert-warning shadow-sm alert-dismissible fade show" role="alert">';
            echo '<i class="fas fa-info-circle fa-fw"></i> ' . $this->session->tempdata('notice');
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        }
        if ($this->session->tempdata('error') != NULL) {
            echo '<div class="alert alert-danger shadow-sm alert-dismissible fade show" role="alert">';
            echo '<i class="fas fa-exclamation-circle fa-fw"></i> ' . $this->session->tempdata('error');
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        }
        ?>
    </div>
    <!-- Login Section -->
    <div class="row m-auto">
        <div class="col col-xs-12 m-auto ">
            <div><img src="<?php echo base_url() ?>assets/img/logo.png" width="120"></div>
            <h1 class="display-2 fw-bold" style="color: #056AC8;">RushRepairPC</h1>
            <h4 class="ms-1 text-muted">Get your device checkup and computer repair quotation.</h4>
        </div>
        <div class="col-4 col-xs-12">
            <div class=" p-4 shadow rounded-3 bg-white">
                <form method="post" action="<?php echo base_url() ?>login/auth">
                    <div class="form-group mb-2 input-group-lg">
                        <input type="text" class="form-control " name="usr" placeholder="Username" required>
                    </div>
                    <div class="form-group input-group-lg">
                        <input type="password" class="form-control input-lg" name="pwd" placeholder="Password" required>
                    </div>
                    <div class="form-group text-center d-grid gap-2 input-group-lg mt-3">
                        <button type="submit" class="btn btn-primary btn-block" name="submit">
                            <i class="fas fa-sign-in-alt fa-fw"></i> Log In
                        </button>
                    </div>
                    <div class="form-group mb-3 input-group-lg my-4">
                        <small>Want to be part of our team? Register
                            <a href="<?php echo base_url() ?>register" class="text-primary"> here</a>.
                        </small>
                    </div>
                    <div class="border-top text-center pt-3 input-group-lg">
                        <a href="<?php echo base_url() ?>create" class="btn btn-success btn-block">Create New Account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Footer Section -->
<div class="text-center py-2 fixed-bottom">
    <small>&copy; RushRepairPC 2022 </small>
</div>