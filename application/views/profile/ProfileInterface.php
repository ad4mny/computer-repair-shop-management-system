<div class="wrapper">
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
                <h3 class="display-4 mb-0 text-secondary ">Manage Profile</h3>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3 mx-3">
                <p>All personal and address information</p>
            </div>
        </div>
        <?php
        if (is_array($profile)) {
            foreach ($profile as $row) {
        ?>
                <div class="row mx-3 border-start border-2">
                    <div class="col-4">
                        <div class="pb-2">
                            <small>Full Name</small>
                            <p class="text-capitalize"><?php echo $row['cd_full_name']; ?></p>
                        </div>
                        <div class="pb-2">
                            <small>Contact Number</small>
                            <p class="text-capitalize"><?php echo $row['cd_phone']; ?></p>
                        </div>
                        <div class="pb-2">
                            <small>Username</small>
                            <p class=""><?php echo $row['ud_usr']; ?></p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="pb-2">
                            <small>Street Address 1</small>
                            <p class="text-capitalize"><?php echo $row['cd_street_1']; ?></p>
                        </div>
                        <div class="pb-2">
                            <small>Street Address 2</small>
                            <p class="text-capitalize"><?php echo $row['cd_street_2']; ?></p>
                        </div>
                        <div class="pb-2">
                            <small>Postcode</small>
                            <p class="text-capitalize"><?php echo $row['cd_postcode']; ?></p>
                        </div>
                        <div class="pb-2">
                            <small>State</small>
                            <p class="text-capitalize"><?php echo $row['cd_city'] . ', ' . $row['cd_state']; ?></p>
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
                        <div class="pb-2">
                            <a href="<?php echo base_url(); ?>profile/update" class="btn btn-primary">UPDATE PROFILE</a>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>