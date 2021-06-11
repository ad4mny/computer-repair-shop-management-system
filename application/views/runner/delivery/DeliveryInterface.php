<div class="wrapper">
    <div class="container p-5" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Manage Delivery & Pickup</h3>
            </div>
        </div>
        <div class="row">
            <div class="col my-3 mx-3">
                <div class="btn-group">
                    <button class="btn btn-outline-primary active" id="delivery_btn">Delivery</button>
                    <button class="btn btn-outline-primary" id="pickup_btn">Pickup</button>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 mx-3 border-start border-2" id="delivery_display">
            <?php
            if (is_array($delivery) && !empty($delivery)) {
                foreach ($delivery as $row) {
                    if ($row['td_status'] == 'Delivering') {
            ?>
                        <div class="col mb-5">
                            <div class="card text-white bg-primary shadow-sm rounded-3 position-relative h-100">
                                <div class="card-body">
                                    <span><i class="fas fa-angle-double-right fa-lg fa-fw"></i> CURRENTLY DELIVERING</span>
                                    <div class="card-title p-4 fw-light text-capitalize">
                                        <h1>
                                            <?php echo $row['rsd_device_brand'] . '<br><small>' . $row['rsd_device_model'] . '</small>'; ?>
                                        </h1>
                                    </div>
                                    <div class="card-text text-capitalize pb-4 px-4">
                                        <small class="text-white border-bottom">Delivery Address</small>
                                        <div>
                                            <?php echo $row['cd_full_name']; ?>
                                        </div>
                                        <div>
                                            <?php echo $row['cd_phone']; ?>
                                        </div>
                                        <div>
                                            <?php echo $row['cd_street_1'] . ', ' . $row['cd_street_2'] . ', ' . $row['cd_postcode'] . ', ' . $row['cd_city'] . ', ' . $row['cd_state']; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-absolute top-100 start-50 translate-middle ">
                                    <div class="d-inline-flex">
                                        <a href="<?php echo base_url() . 'runner/delivery/cancel_delivery_request/' . encrypt_it($row['rsd_id']); ?>" class="" onclick="return confirm('Cancel this device delivery?');"><span class="fa-stack fa-2x "><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-times fa-stack-1x text-white"></i></span></a>
                                        <a href="<?php echo base_url() . 'runner/delivery/complete_delivery_request/' . encrypt_it($row['rsd_id']); ?>" onclick="return confirm('Mark device delivery completed?');"><span class="fa-stack fa-2x "><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-check fa-stack-1x text-white"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col mb-3">
                            <div class="card bg-white  rounded-3  position-relative h-100">
                                <div class="card-body">
                                    <span><i class="fas fa-check fa-lg fa-fw"></i> COMPLETED</span>
                                    <div class="card-title p-4 fw-light text-capitalize">
                                        <h1>
                                            <?php echo $row['rsd_device_brand'] . '<br><small>' . $row['rsd_device_model'] . '</small>'; ?>
                                        </h1>
                                    </div>
                                    <div class="card-text text-capitalize pb-4 px-4">
                                        <small class="border-bottom text-secondary">Delivery Address</small>
                                        <div>
                                            <?php echo $row['cd_full_name']; ?>
                                        </div>
                                        <div>
                                            <?php echo $row['cd_phone']; ?>
                                        </div>
                                        <div>
                                            <?php echo $row['cd_street_1'] . ', ' . $row['cd_street_2'] . ', ' . $row['cd_postcode'] . ', ' . $row['cd_city'] . ', ' . $row['cd_state']; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center text-capitalize">
                                    <?php echo 'DCRS-' . encrypt_it($row['rsd_id']); ?>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            } else {
                echo '<div class="col"><p>No available delivery request.</p></div>';
            }
            ?>
        </div>
        <div class="row row-cols-1 row-cols-md-3 mx-3 border-start border-2 d-none" id="pickup_display">
            <?php
            if (isset($pickup) && is_array($pickup) && !empty($pickup)) {
                foreach ($pickup as $row) {
            ?>
                    <div class="col mb-3">
                        <div class="card text-white bg-secondary shadow rounded-3 position-relative h-100">
                            <div class="card-body">
                                <span><i class="fas fa-angle-double-right fa-lg fa-fw"></i> CURRENTLY PICKING UP</span>
                                <div class="card-title p-4 fw-light text-capitalize">
                                    <h1>
                                        <?php echo $row['rsd_device_brand'] . '<br><small>' . $row['rsd_device_model'] . '</small>'; ?>
                                    </h1>
                                </div>
                                <div class="card-text text-capitalize pb-1 px-4">
                                    <small class="text-white border-bottom">Pickup Datetime</small>
                                    <div><?php echo $row['rsd_pickup_log']; ?></div>
                                </div>
                                <div class="card-text text-capitalize pb-5 px-4">
                                    <small class="text-white border-bottom">Pickup Address</small>
                                    <div>
                                        <?php echo $row['cd_full_name']; ?>
                                    </div>
                                    <div>
                                        <?php echo $row['cd_phone']; ?>
                                    </div>
                                    <div>
                                        <?php echo $row['cd_street_1'] . ', ' . $row['cd_street_2'] . ', ' . $row['cd_postcode'] . ', ' . $row['cd_city'] . ', ' . $row['cd_state']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="position-absolute top-100 start-50 translate-middle ">
                                <div class="d-inline-flex">
                                    <a href="<?php echo base_url() . 'runner/delivery/cancel_pickup_request/' . encrypt_it($row['rsd_id']); ?>" class="" onclick="return confirm('Cancel this device pickup?');"><span class="fa-stack fa-2x "><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-times fa-stack-1x text-white"></i></span></a>
                                    <a href="<?php echo base_url() . 'runner/delivery/complete_pickup_request/' . encrypt_it($row['rsd_id']); ?>" onclick="return confirm('Mark device pickup completed?');"><span class="fa-stack fa-2x "><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-check fa-stack-1x text-white"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<div class="col"><p>No available pickup request.</p></div>';
            }
            ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('#delivery_btn').on('click', function() {
            $('#delivery_display').removeClass('d-none');
            $('#pickup_display').addClass('d-none');
            $('#pickup_btn').removeClass('active');
            $('#delivery_btn').addClass('active');
        });
        $('#pickup_btn').on('click', function() {
            $('#pickup_display').removeClass('d-none');
            $('#delivery_display').addClass('d-none');
            $('#delivery_btn').removeClass('active');
            $('#pickup_btn').addClass('active');
        });

    });
</script>