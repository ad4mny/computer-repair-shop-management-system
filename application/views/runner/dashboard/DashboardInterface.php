<div class="wrapper">
    <div class="container p-5" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Dashboard</h3>
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
            ?>
                    <div class="col mb-5">
                        <div class="card text-white bg-info shadow rounded-lg border position-relative h-100">
                            <div class="card-body">
                                <span><i class="fas fa-box fa-lg fa-fw"></i> NEW DELIVERY</span>
                                <div class="card-title p-4 fw-light text-capitalize">
                                    <h1>
                                        <?php echo $row['rsd_device_brand'] . '<br><small>' . $row['rsd_device_model'] . '</small>'; ?>
                                    </h1>
                                </div>
                                <div class="card-text text-capitalize pb-4 px-4">
                                    <small>Delivery Address:</small>
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
                            <a href="<?php echo  base_url() . 'runner/dashboard/take_delivery_request/' . encrypt_it($row['rsd_id']); ?>" class="position-absolute top-100 start-50 translate-middle" onclick="return confirm('Are you sure want to accept this delivery?');"><span class="fa-stack fa-2x "><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-plus fa-stack-1x text-white"></i></span></a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<div class="col"><p>No available delivery request.</p></div>';
            }
            ?>

        </div>
        <div class="row row-cols-1 row-cols-md-3 mx-3 border-start border-2 d-none" id="pickup_display">
            <?php
            if (is_array($pickup) && !empty($pickup)) {
                foreach ($pickup as $row) {
            ?>
                    <div class="col mb-3">
                        <div class="card text-white bg-secondary shadow rounded-lg border position-relative h-100">
                            <div class="card-body">
                                <span><i class="fas fa-box fa-lg fa-fw"></i> NEW PICKUP</span>
                                <div class="card-title p-4 fw-light text-capitalize">
                                    <h1>
                                        <?php echo $row['rsd_device_brand'] . '<br><small>' . $row['rsd_device_model'] . '</small>'; ?>
                                    </h1>
                                </div>
                                <div class="card-text text-capitalize pb-4 px-4">
                                    <small>Pickup Datetime:</small>
                                    <div><?php echo $row['rsd_pickup_log']; ?></div>
                                </div>
                                <div class="card-text text-capitalize pb-4 px-4">
                                    <small>Pickup Address:</small>
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
                            <a href="<?php echo base_url() . 'runner/dashboard/take_pickup_request/' . encrypt_it($row['rsd_id']); ?>" class="position-absolute top-100 start-50 translate-middle" onclick="return confirm('Are you sure want to accept this delivery?');">
                                <span class="fa-stack fa-2x ">
                                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                    <i class="fa fa-plus fa-stack-1x text-white"></i>
                                </span>
                            </a>
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