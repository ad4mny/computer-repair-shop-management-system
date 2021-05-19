<div class="wrapper">
    <div class="container p-5" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary">Manage My Account</h3><br>
            </div>
        </div>
        <?php
        if (is_array($profile)) {
            foreach ($profile as $row) {
        ?>
                <div class="row p-3">
                    <div class="col-3 text-center">
                        <div class="rounded-circle bg-white d-inline-flex p-5 align-middle shadow mb-4"><i class="fas fa-user fa-4x text-secondary"></i>
                        </div>
                        <a href="<?php echo base_url(); ?>profile/update" class="btn btn-primary btn-sm">UPDATE PROFILE</a>
                    </div>
                    <div class="col">
                        <div class="row pt-1">
                            <div class="col">
                                <small>Full Name</small>
                                <p class="text-capitalize"><?php echo $row['cd_full_name']; ?></p>
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="col">
                                <small>Contact Number</small>
                                <p class="text-capitalize"><?php echo $row['cd_phone']; ?></p>
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="col">
                                <small>Street Address 1</small>
                                <p class="text-capitalize"><?php echo $row['cd_street_1']; ?></p>
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="col">
                                <small>Street Address 2</small>
                                <p class="text-capitalize"><?php echo $row['cd_street_2']; ?></p>
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="col">
                                <small>Postcode</small>
                                <p class="text-capitalize"><?php echo $row['cd_postcode']; ?></p>
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="col">
                                <small>State</small>
                                <p class="text-capitalize"><?php echo $row['cd_city'] . ', ' . $row['cd_state']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>