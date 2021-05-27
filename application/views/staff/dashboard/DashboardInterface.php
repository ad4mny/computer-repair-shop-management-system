<div class="wrapper">
    <div class="container p-5" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Dashboard</h3>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3 mx-3">
                <p>All new repair request</p>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 mx-3 mb-5  border-start border-2">

            <?php
            if (is_array($request) && !empty($request)) {
                foreach ($request as $row) {
                    if ($row['rsd_progress'] == 0) {
            ?>
                        <div class="col mb-5">
                            <div class="card text-white bg-info shadow-lg border rounded position-relative h-100">
                                <span class="position-absolute top-0 start-0 m-3"><i class="fas fa-clock fa-lg fa-fw"></i></span>
                                <span class="position-absolute top-0 end-0 m-3"><?php echo 'DCRS-' . encrypt_it($row['rsd_id']); ?></span>
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
                                        <div class="card-text text-capitalize">
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
                                    </div>
                                </div>
                                <a href="<?php echo base_url() . 'staff/dashboard/view/' . encrypt_it($row['rsd_id']) ?>" class="position-absolute top-100 start-50 translate-middle">
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                        <i class="fa fa-tools fa-stack-1x text-white"></i>
                                    </span>
                                </a>

                            </div>
                        </div>
            <?php
                    }
                }
            } else {
                echo '<div class="col"><p>No upcoming and past request.</p></div>';
            }
            ?>
        </div>
    </div>
</div>