<div class="wrapper">
    <div class="container p-5" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Dashboard</h3>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3 mx-3">
                <p>All new delivery request</p>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 mx-3 border-start border-2">
            <?php
            if (is_array($delivery) && !empty($delivery)) {
                foreach ($delivery as $row) {
            ?>
                    <div class="col mb-3">
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
                                    <h5>
                                        <?php echo $row['cd_street_1'] . ', ' . $row['cd_street_2'] . ', ' . $row['cd_postcode'] . ', ' . $row['cd_city'] . ', ' . $row['cd_state']; ?>
                                    </h5>
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
    </div>
</div>