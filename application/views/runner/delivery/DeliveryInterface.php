<div class="wrapper">
    <div class="container p-5" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Manage Delivery</h3>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3 mx-3">
                <p>All accepted delivery request</p>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 mx-3 border-start border-2">
            <?php
            if (is_array($delivery) && !empty($delivery)) {
                foreach ($delivery as $row) {
                    if ($row['td_status'] == 'Delivering') {
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
                                <div class="position-absolute top-100 start-50 translate-middle ">
                                    <div class="d-inline-flex">
                                        <a href="<?php echo base_url() . 'runner/delivery/cancel_delivery_request/' . encrypt_it($row['rsd_id']); ?>" class="" onclick="return confirm('Cancel delivery?');"><span class="fa-stack fa-2x "><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-times fa-stack-1x text-white"></i></span></a>
                                        <a href="<?php echo base_url() . 'runner/delivery/complete_delivery_request/' . encrypt_it($row['rsd_id']); ?>" onclick="return confirm('Mark completed?');"><span class="fa-stack fa-2x "><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-check fa-stack-1x text-white"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col mb-3">
                            <div class="card bg-white  rounded-lg  position-relative h-100">
                                <div class="card-body">
                                    <span><i class="fas fa-check fa-lg fa-fw"></i> COMPLETED</span>
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
    </div>
</div>