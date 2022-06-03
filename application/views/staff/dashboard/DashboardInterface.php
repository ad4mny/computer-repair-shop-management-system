<div class="wrapper">
    <div class="container-fluid" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Dashboard</h3>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3 mx-3">
                <p>All new available and incoming repair request</p>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 mx-3 border-start border-2">
            <?php
            if (is_array($request) && !empty($request)) {
                foreach ($request as $row) {
            ?>
                    <div class="col mb-5">
                        <div class="card text-white bg-primary shadow-sm rounded-3 position-relative h-100">
                            <?php
                            if ($row['rsd_progress'] === NULL) {
                                echo '<span class="position-absolute top-0 start-0 m-3"><i class="fas fa-route fa-lg fa-fw"></i> INCOMING REQUEST </span>';
                            } else {
                                echo '<span class="position-absolute top-0 start-0 m-3"><i class="fas fa-plus fa-lg fa-fw"></i> NEW AVAILABLE </span>';
                            }
                            ?>
                            <div class="card-body">
                                <div class="card-title px-4 py-5 fw-light text-capitalize">
                                    <h1>
                                        <?php echo $row['rsd_device_brand']; ?><br>
                                        <small><?php echo $row['rsd_device_model']; ?></small>
                                    </h1>
                                </div>
                                <div class="px-4 pb-4 mb-5">
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
                                    <div class="card-text border-top pt-2 text-center"><?php echo $row['rsd_comment']; ?> </div>
                                </div>
                            </div>
                            <?php
                            if ($row['rsd_progress'] === NULL) {
                                echo '<div class="card-footer"><div class="card-text text-capitalize text-center">DCRS-' . encrypt_it($row['rsd_id']) . '</div></div>';
                            } else {
                            ?>
                                <a href="<?php echo base_url() . 'staff/dashboard/view/' . encrypt_it($row['rsd_id']) ?>" class="position-absolute top-100 start-50 translate-middle">
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x text-info"></i>
                                        <i class="fa fa-tools fa-stack-1x text-white"></i>
                                    </span>
                                </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<div class="col"><p>No upcoming and past request.</p></div>';
            }
            ?>
        </div>
    </div>
</div>