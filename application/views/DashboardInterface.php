<div class="wrapper">
    <div class="container-fluid" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Dashboard</h3>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3 mx-3">
                <p>All upcoming and past repair request</p>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 mx-3 border-start border-2">
            <?php
            if (is_array($request) && !empty($request)) {
                foreach ($request as $row) {
                    if ($row['rsd_status'] != '0' && $row['rsd_progress'] != '2') {
            ?>
                        <div class="col mb-5">
                            <?php
                            if ($row['rsd_status'] == '0') {
                                echo '<div class="card text-white bg-danger shadow-lg rounded-3 position-relative h-100">';
                                echo '<span class="position-absolute top-0 start-0 m-3"><i class="fas fa-times fa-lg fa-fw"></i></span>';
                            } else {
                                echo '<div class="card text-white bg-secondary shadow-lg rounded-3 position-relative h-100">';
                                echo '<span class="position-absolute top-0 start-0 m-3"><i class="fas fa-clock fa-lg fa-fw"></i></span>';
                            }
                            ?>
                            <span class="position-absolute top-0 end-0 m-3">
                                <?php echo 'DCRS-' . encrypt_it($row['rsd_id']); ?>
                            </span>
                            <div class="card-body">
                                <div class="card-title  px-4 py-5 fw-light text-capitalize">
                                    <h1>
                                        <?php echo $row['rsd_device_brand']; ?><br>
                                        <small><?php echo $row['rsd_device_model']; ?></small>
                                    </h1>
                                </div>
                                <div class="px-4 pb-5 mb-3">
                                    <div class="card-text text-capitalize"><?php echo $row['rsd_damage_info']; ?></div>
                                    <div class="card-text text-capitalize">
                                        <?php
                                        if ($row['rsd_sd_id'] === null) {
                                            echo 'No technician assigned';
                                        } else {
                                            $technician = $controller->get_technician_info($row['rsd_sd_id']);
                                            $technician_name = explode(' ', $technician[0]['sd_full_name']);
                                            echo 'Technician ' . $technician_name[0];
                                        }
                                        ?>
                                    </div>
                                    <div class="card-text text-capitalize pb-2">
                                        <?php
                                        switch ($row['rsd_damage_severity']) {
                                            case '2':
                                                echo 'Severity Worst';
                                                break;
                                            case '1':
                                                echo 'Severity Average';
                                                break;
                                            default:
                                                echo 'Severity Fair';
                                                break;
                                        }
                                        ?>
                                    </div>
                                    <div class="card-text text-center pt-2 border-top">
                                        <?php
                                        if ($row['rsd_status'] == null && $row['rsd_progress'] == null) {
                                            echo 'Awaiting Runner';
                                        }
                                        if ($row['rsd_status'] == null && $row['rsd_progress'] == '0') {
                                            echo 'Inspection Pending';
                                        }
                                        if ($row['rsd_status'] == '1' && $row['rsd_progress'] != '1') {
                                            echo 'Payment Pending';
                                        }
                                        if ($row['rsd_status'] == '1' && $row['rsd_progress'] != '0') {
                                            echo 'Ongoing Repair';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="position-absolute top-100 start-50 translate-middle ">
                                <div class="d-inline-flex">
                                    <?php if ($row['rsd_progress'] == null) { ?>
                                        <a href="<?php echo base_url() . 'dashboard/delete/' . encrypt_it($row['rsd_id']); ?>" onclick="return confirm('Are you sure you want to cancel your request?');">
                                            <span class="fa-stack fa-2x">
                                                <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                                <i class="fa fa-times fa-stack-1x text-white"></i>
                                            </span>
                                        </a>
                                    <?php } ?>
                                    <a href="<?php echo base_url() . 'status/' . encrypt_it($row['rsd_id']); ?>">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                            <?php
                                            if ($row['rsd_status'] == null && $row['rsd_progress'] == null) {
                                                echo '<i class="fas fa-eye fa-stack-1x text-white"></i>';
                                            } else  if ($row['rsd_status'] == null && $row['rsd_progress'] == '0') {
                                                echo '<i class="fas fa-eye fa-stack-1x text-white"></i>';
                                            } else  if ($row['rsd_status'] == '1' && $row['rsd_progress'] == '1') {
                                                echo '<i class="fas fa-eye fa-stack-1x text-white"></i>';
                                            } else  if ($row['rsd_status'] == '1' && $row['rsd_progress'] == '2') {
                                                echo '<i class="fas fa-eye fa-stack-1x text-white"></i>';
                                            } else {
                                                echo '<i class="fab fa-paypal fa-stack-1x text-white"></i>';
                                            }
                                            ?>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                        echo '</div>';
                    } else {
                    ?>
                        <div class="col mb-5">
                            <?php
                            if ($row['rsd_status'] == '0') {
                                echo '<div class="card text-white bg-danger rounded-3 position-relative h-100">';
                                echo '<span class="position-absolute top-0 start-0 m-3"><i class="fas fa-times fa-lg fa-fw"></i> UNABLE TO REPAIR</span>';
                            } else {
                                echo '<div class="card bg-white rounded-3 position-relative h-100">';
                                echo '<span class="position-absolute top-0 start-0 m-3"><i class="fas fa-check fa-lg fa-fw"></i> COMPLETED</span>';
                            }
                            ?>
                            <div class="card-body">
                                <div class="card-title  px-4 py-5 fw-light text-capitalize">
                                    <h1>
                                        <?php echo $row['rsd_device_brand']; ?><br>
                                        <small><?php echo $row['rsd_device_model']; ?></small>
                                    </h1>
                                </div>
                                <div class="px-4 pb-5 mb-5">
                                    <div class="card-text text-capitalize"><?php echo $row['rsd_damage_info']; ?></div>
                                    <div class="card-text text-capitalize">
                                        <?php
                                        if ($row['rsd_sd_id'] === null) {
                                            echo 'No technician assigned';
                                        } else {
                                            $technician = $controller->get_technician_info($row['rsd_sd_id']);
                                            $technician_name = explode(' ', $technician[0]['sd_full_name']);
                                            echo 'Technician ' . $technician_name[0];
                                        }
                                        ?>
                                    </div>
                                    <div class="card-text text-capitalize pb-2">
                                        <?php
                                        switch ($row['rsd_damage_severity']) {
                                            case 2:
                                                echo 'Severity Worst';
                                                break;
                                            case 1:
                                                echo 'Severity Average';
                                                break;
                                            default:
                                                echo 'Severity Fair';
                                                break;
                                        }
                                        ?>
                                    </div>
                                    <div class="card-text text-center text-capitalize border-top pt-2">
                                        <?php echo $row['rsd_comment']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center"><?php echo 'DCRS-' . encrypt_it($row['rsd_id']); ?></div>
                        </div>
            <?php
                        echo '</div>';
                    }
                }
            } else {
                echo '<div class="col"><p>No upcoming and past request.</p></div>';
            }
            ?>
        </div>
    </div>
</div>