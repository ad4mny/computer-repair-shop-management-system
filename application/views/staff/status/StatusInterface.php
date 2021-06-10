<div class="wrapper">
    <div class="container p-5" id="content">
        <div id="repair_info">
            <div class="row">
                <div class="col">
                    <h3 class="display-4 mb-0 text-secondary ">Repair Status </h3>
                </div>
            </div>
            <div class="row">
                <div class="col mt-3 mx-3">
                    <p>Accepted repair request</p>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 mx-3 border-start border-2">
                <?php if (is_array($request) && !empty($request)) {
                    foreach ($request as $row) {
                        if ($row['rsd_status'] == '1' && $row['rsd_progress'] != '2') { ?>
                            <div class="col mb-5">
                                <div class="card text-white bg-info shadow rounded-lg border position-relative h-100">
                                    <?php if ($row['rsd_progress'] == '0') {
                                        echo '<span class="position-absolute top-0 start-0 m-3"><i class="fas fa-clock fa-lg fa-fw"></i> PENDING CONFIRMATION</span>';
                                    } else {
                                        echo '<span class="position-absolute top-0 start-0 m-3"><i class="fas fa-spinner fa-lg fa-fw"></i> </span>';
                                        echo '<span class="position-absolute top-0 end-0 m-3">DCRS-' . encrypt_it($row['rsd_id']) . '</span>';
                                    }
                                    ?>
                                    <div class="card-body">
                                        <div class="card-text px-4 py-5 fw-light text-capitalize ">
                                            <h1> <?php echo $row['rsd_device_brand']; ?><br>
                                                <small><?php echo $row['rsd_device_model']; ?></small>
                                            </h1>
                                        </div>
                                        <div class="px-4 pb-5">
                                            <div class="card-text text-capitalize"> <?php echo $row['rsd_damage_info']; ?></div>
                                            <div class="card-text text-capitalize">You has been assigned</div>
                                            <div class="card-text text-capitalize pb-1">
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
                                            <div class="card-text border-top pt-1"><?php echo $row['rsd_comment']; ?> </div>
                                        </div>
                                    </div>
                                    <?php
                                    if ($row['rsd_progress'] != '1' && $row['rsd_progress'] != '2') {
                                        echo '<div class="card-footer"><div class="card-text text-capitalize text-center">DCRS-' . encrypt_it($row['rsd_id']) . '</div></div>';
                                    } else {
                                    ?>
                                        <a href="<?php echo base_url() . 'staff/status/view/' . encrypt_it($row['rsd_id']); ?>" class="position-absolute top-100 start-50 translate-middle" >
                                            <span class="fa-stack fa-2x ">
                                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                                <i class="fa fa-tools fa-stack-1x text-white"></i>
                                            </span>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col mb-5">
                                <?php if ($row['rsd_progress'] == '2') {
                                    echo '<div class="card text-dark bg-white rounded position-relative h-100">';
                                    echo '<span class="position-absolute top-0 start-0 m-3"><i class="fas fa-check fa-lg fa-fw"></i> COMPLETED</span>';
                                } else {
                                    echo '<div class="card text-white bg-danger rounded position-relative h-100">';
                                    echo '<span class="position-absolute top-0 start-0 m-3"><i class="fas fa-times fa-lg fa-fw"></i> UNABLE TO REPAIR</span>';
                                }
                                ?>
                                    <div class="card-body">
                                        <div class="card-text px-4 py-5 fw-light text-capitalize ">
                                            <h1> <?php echo $row['rsd_device_brand']; ?><br>
                                                <small><?php echo $row['rsd_device_model']; ?></small>
                                            </h1>
                                        </div>
                                        <div class="px-4 pb-5">
                                            <div class="card-text text-capitalize"> <?php echo $row['rsd_damage_info']; ?></div>
                                            <div class="card-text text-capitalize">You has been assigned</div>
                                            <div class="card-text text-capitalize pb-1">
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
                                            <div class="card-text pt-1 border-top"><?php echo $row['rsd_comment']; ?> </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="card-text text-capitalize text-center"><?php echo 'DCRS-' . encrypt_it($row['rsd_id']); ?></div>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }
                } else {
                    echo '<div class="col"><p>No ongoing repair request.</p></div>';
                } ?>
            </div>
        </div>
    </div>
</div>