<div class="wrapper">
    <div class="container p-5" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Request Details</h3>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3 mx-3">
                <p>Repair request</p>
            </div>
        </div>
        <div class="row mx-3 border-start border-2 mx-3">
            <div class="col-4">
                <?php
                if (is_array($request) && !empty($request)) {
                    echo '<div class="card text-white bg-info shadow rounded-lg border position-relative h-100">';
                    echo '<div class="card-body">';
                    echo '<span><i class="fas fa-plus fa-lg"></i></span>';

                    echo '<h1 class="card-title p-4 fw-light text-capitalize">' . $request[0]['rsd_device_brand'] . '<br>' .  $request[0]['rsd_device_model'] . '</h1>';

                    echo  '<div class="p-4">';
                    echo  '<div class="card-text text-capitalize">' . $request[0]['rsd_damage_info'] . '</div>';
                    echo '<div class="card-text text-capitalize">';

                    if ($request[0]['rsd_sd_id'] === null) {
                        echo 'No technician assigned';
                    } else {
                        $technician = $controller->get_technician_info($request[0]['rsd_sd_id']);
                        $technician_name = explode(' ', $technician[0]['sd_full_name']);
                        echo 'Technician ' . $technician_name[0];
                    }

                    echo '</div>';
                    echo '<div class="card-text text-capitalize">';

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

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    echo '<a href="' . base_url() . 'staff/dashboard" class="position-absolute top-100 start-50 translate-middle" onclick="return confirm("Are you sure you want to cancel your request");"><span class="fa-stack fa-2x "><i class="fa fa-circle fa-stack-2x text-primary" ></i><i class="fa fa-eye-slash fa-stack-1x text-white"></i></span></a>';
                    echo '</div>';

                    echo '<div class="d-flex justify-content-center pt-3">';

                    echo '</div>';
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
                                <div class="form-group pb-2">
                                    <small class="text-muted">Device Brand</small>
                                    <input type="text" class="form-control" name="brand" placeholder="Enter device brand" value="<?php echo $request[0]['rsd_device_brand']; ?>" required>
                                </div>
                                <div class="form-group pb-2">
                                    <small class="text-muted">Device Model</small>
                                    <input type="text" class="form-control" name="model" placeholder="Enter device model" value="<?php echo $request[0]['rsd_device_model']; ?>" required>
                                </div>
                                <div class="form-group pb-2">
                                    <small class="text-muted">Device Color</small>
                                    <input type="text" class="form-control" name="color" placeholder="Enter device color" value="<?php echo $request[0]['rsd_device_color']; ?>" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group pb-2">
                                    <small class="text-muted">Damage Severity</small>
                                    <select class="form-select" name="severity" required>
                                        <option value="0" <?php if ($request[0]['rsd_damage_severity'] == 0)  echo 'selected'; ?>>Fair</option>
                                        <option value="1" <?php if ($request[0]['rsd_damage_severity'] == 1)  echo 'selected'; ?>>Average</option>
                                        <option value="2" <?php if ($request[0]['rsd_damage_severity'] == 2)  echo 'selected'; ?>>Worst</option>
                                    </select>
                                </div>
                                <div class="form-group pb-2">
                                    <small class="text-muted">Damage Information</small>
                                    <textarea class="form-control" name="information" row="3" max="100" placeholder="Max 100 characters." required><?php echo $request[0]['rsd_damage_info']; ?></textarea>
                                </div>
                                <div class="form-group pb-2">
                                    <small class="text-muted">Repair Status</small>
                                    <select class="form-select" name="status" required>
                                        <option value="0">Unable to repair</option>
                                        <option value="1">Can be repair</option>
                                    </select>
                                </div>
                                <div class="form-group pb-2">
                                    <small class="text-muted">Repair Reason</small>
                                    <select class="form-select" name="severity" required>
                                        <option <?php if ($request[0]['rsd_comment'] == 'Waiting customer confirmation')  echo 'selected'; ?>>Waiting customer confirmation</option>
                                        <option <?php if ($request[0]['rsd_comment'] == 'No parts available')  echo 'selected'; ?>>No parts available</option>
                                        <option <?php if ($request[0]['rsd_comment'] == 'No technician available')  echo 'selected'; ?>>No technician available</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row p-3">
                            <div class="col text-end">
                                <a href="<?php echo base_url(); ?>staff/dashboard/delete/<?php echo encrypt_it($request[0]['rsd_id']); ?>" class="btn btn-danger" onclick="return confirm('Are sure you want to delete this repair request?');">DELETE REQUEST</a>
                                <button type="submit" class="btn btn-primary" name="submit" value="submit" onclick="return confirm('Are sure you want to take this repair request as it will be assigned to you?');">DO REPAIR</button>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>