<div class="wrapper">
    <div class="container p-5" id="content">
        <!-- alert  -->
        <div id="alert" class="w-50 position-absolute" style="z-index: 1; top:10%; left: 25%;">
        </div>
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary">Manage My Account</h3><br>
            </div>
        </div>
        <?php
        if (is_array($profile)) {
            foreach ($profile as $row) {
        ?>
                <div class="row rounded-3 mx-3 p-5 shadow-sm bg-white border-start border-primary border-5">
                    <div class="col-4">
                        <div class="py-2">
                            <small>Username</small>
                            <p class=""><?php echo $row['ud_usr']; ?></p>
                        </div>
                        <div class="pb-2">
                            <small>Full Name</small>
                            <p class="text-capitalize"><?php echo $row['cd_full_name']; ?></p>
                        </div>
                        <div class="pb-2">
                            <small>Contact Number</small>
                            <p class="text-capitalize"><?php echo $row['cd_phone']; ?></p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="py-2">
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
                        <div class="py-2">
                            <?php if ($row['ud_pic'] != "") {
                                echo '<div class="rounded-circle bg-white d-inline-flex align-middle shadow mb-4"><img src="' . base_url() . 'assets/img/profile/thumbnail/' . $row['ud_pic'] . '" class="img-fluid rounded-circle shadow border border-5 border-white"></div>';
                            } else {
                                echo '<div class="rounded-circle bg-white d-inline-flex p-5 align-middle shadow mb-4"><i class="fas fa-user fa-4x text-secondary"></i></div>';
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