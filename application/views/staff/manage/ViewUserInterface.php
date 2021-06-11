<div class="wrapper">
    <div class="container p-5 " id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Manage User Account</h3>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3 mx-3">
                <p><?php echo 'CD-' . encrypt_it($user['cd_id']); ?>'s Information</p>
            </div>
        </div>
        <div class="row mx-3 p-3 shadow-sm bg-white">
            <?php
            if (is_array($user) && !empty($user)) {
            ?>
                <div class="col text-capitalize">
                    <div class="py-2">
                        <small>Customer ID</small>
                        <p><?php echo 'CD-' . encrypt_it($user['cd_id']); ?></p>
                    </div>
                    <div class="pb-2">
                        <small>Full Name</small>
                        <p><?php echo $user['cd_full_name']; ?></p>
                    </div>
                    <div class="pb-2">
                        <small>Contact Number</small>
                        <p><?php echo $user['cd_phone']; ?></p>
                    </div>
                </div>
                <div class="col text-capitalize">
                    <div class="py-2">
                        <small>Address</small>
                        <p class="mb-0"><?php echo $user['cd_street_1']; ?></p>
                        <p class="mb-0"><?php echo $user['cd_street_2']; ?></p>
                        <p class="mb-0"><?php echo $user['cd_postcode']; ?></p>
                        <p class="mb-0"><?php echo $user['cd_city'] . ', ' .  $user['cd_state'] ?></p>
                    </div>
                </div>
            <?php
            } else {
                echo '<div class="col"><p>No registered user in the system.</p></div>';
            }
            ?>
        </div>
        <div class="row">
            <div class="col mt-3 mx-3">
                <p>Recent Services Information</p>
            </div>
        </div>
        <div class="row mx-3 p-3 shadow-sm bg-white">
            <div class="col">
                <div class="row text-muted">
                    <div class="col-1 text-center"><small>NO</small></div>
                    <div class="col-2 text-uppercase"><small>DATETIME</small></div>
                    <div class="col-2 text-capitalize"><small>SERIVCE ID</small></div>
                    <div class="col text-capitalize"><small>DEVICE INFORMATION</small></div>
                    <div class="col text-capitalize"><small>SERVICE INFORMATION</small></div>
                    <div class="col text-capitalize"><small>SERVICE STATUS</small></div>
                </div>
                <?php
                $i = 0;
                if (is_array($device) && !empty($device)) {
                    foreach ($device as $row) {
                ?>
                        <div class="row mb-1 py-1 border-bottom">
                            <div class="col-1 text-center m-auto"><?php echo ++$i; ?></div>
                            <div class="col-2 text-uppercase m-auto"> <?php echo  $row['rsd_log']; ?></div>
                            <div class="col-2 text-uppercase m-auto"> <?php echo 'DCRS-' . encrypt_it($row['rsd_id']); ?></div>
                            <div class="col text-capitalize m-auto"> <?php echo $row['rsd_device_brand'] . ' ' . $row['rsd_device_model']; ?></div>
                            <div class="col text-capitalize m-auto"> <?php echo $row['rsd_damage_info']; ?></div>
                            <div class="col text-capitalize m-auto"> <?php echo $row['rsd_comment']; ?></div>
                        </div>
                <?php
                    }
                } else {
                    echo '<div class="col"><p>No services found for this user.</p></div>';
                }
                ?>
            </div>

        </div>
    </div>
</div>