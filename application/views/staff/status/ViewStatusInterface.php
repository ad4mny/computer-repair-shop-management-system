<div class="wrapper">
    <div class="container p-5" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Status Details</h3>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3 mx-3">
                <p>View the repair status detail</p>
            </div>
        </div>
        <div class="row mx-3 border-start border-2 mx-3">
            <div class="col-4">
                <?php
                if (is_array($request) && !empty($request)) {
                ?>
                    <div class="col mb-5">
                        <div class="card text-white bg-info shadow border rounded position-relative h-100">
                            <span class="position-absolute top-0 start-0 m-3">
                                <i class="fas fa-spinner fa-lg fa-fw"></i>
                            </span>
                            <span class="position-absolute top-0 end-0 m-3"><?php echo 'DCRS-' . encrypt_it($request[0]['rsd_id']); ?></span>
                            <div class="card-body">
                                <div class="card-title  px-4 py-5 fw-light text-capitalize">
                                    <h1>
                                        <?php echo $request[0]['rsd_device_brand']; ?><br>
                                        <small><?php echo $request[0]['rsd_device_model']; ?></small>
                                    </h1>
                                </div>
                                <div class="px-4 pb-5 mb-5">
                                    <div class="card-text text-capitalize"><?php echo $request[0]['rsd_damage_info']; ?></div>
                                    <div class="card-text text-capitalize">
                                        <?php
                                        if ($request[0]['rsd_sd_id'] === null) {
                                            echo 'No technician assigned';
                                        } else {
                                            $technician = $controller->get_technician_info($request[0]['rsd_sd_id']);
                                            $technician_name = explode(' ', $technician[0]['sd_full_name']);
                                            echo 'Technician ' . $technician_name[0];
                                        }
                                        ?>
                                    </div>
                                    <div class="card-text text-capitalize">
                                        <?php
                                        switch ($request[0]['rsd_damage_severity']) {
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
                            <a href="<?php echo base_url() . 'staff/status'; ?>" class="position-absolute top-100 start-50 translate-middle">
                                <span class="fa-stack fa-2x">
                                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                    <i class="fa fa-eye-slash fa-stack-1x text-white"></i>
                                </span>
                            </a>

                        </div>
                    </div>
                <?php
                } else {
                    redirect(base_url() . 'staff/dashboard');
                }
                ?>
            </div>
            <div class="col">
                <?php if (is_array($request) && !empty($request)) { ?>
                    <form method="post" action="<?php echo base_url(); ?>staff/dashboard/take_repair_request/<?php echo encrypt_it($request[0]['rsd_id']); ?>">
                        <div class="row p-3">
                            <div class="col">
                                <div class="py-3 border-bottom">
                                    <small class="text-muted">Device Brand</small>
                                    <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i>
                                        <?php echo $request[0]['rsd_device_brand']; ?>
                                    </p>
                                </div>
                                <div class="py-3 border-bottom">
                                    <small class="text-muted">Device Model</small>
                                    <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i>
                                        <?php echo $request[0]['rsd_device_model']; ?>
                                    </p>
                                </div>
                                <div class="py-3 border-bottom">
                                    <small class="text-muted">Device Color</small>
                                    <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i>
                                        <?php echo $request[0]['rsd_device_color']; ?>
                                    </p>
                                </div>
                                <div class="py-3 border-bottom">
                                    <small class="text-muted">Damage Information</small>
                                    <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i>
                                        <?php echo $request[0]['rsd_damage_info']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="py-3 border-bottom">
                                    <small class="text-muted">Repair Progress</small>
                                    <?php
                                    switch ($request[0]['rsd_progress']) {
                                        case '2':
                                            echo '<p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> Completed</p>';
                                            break;
                                        case '1':
                                            echo '<p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> Repairing</p>';
                                            break;
                                        default:
                                            echo '<p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> Pending</p>';
                                            break;
                                    }
                                    ?>
                                </div>
                                <div class="py-3 ">
                                    <small class="text-muted">Repair Status</small>
                                    <select class="form-select" name="status" id="status_select" required>
                                        <option value="0" disabled>Pending</option>
                                        <option value="1">Repairing</option>
                                        <option value="2">Completed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row p-3">
                            <div class="col text-end">
                                <a href="<?php echo base_url() . 'staff/status/update/' . encrypt_it($request[0]['rsd_id']); ?>" type="submit" class="btn btn-primary" name="submit" value="submit" onclick="return confirm('Are sure you want to update this repair request as it will be assigned to you?');">UPDATE REQUEST</a>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>