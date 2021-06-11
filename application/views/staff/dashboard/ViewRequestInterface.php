<div class="wrapper">
    <div class="container p-5" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Request Details</h3>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3 mx-3">
                <p>Update information and accept repair request</p>
            </div>
        </div>
        <?php
        if (is_array($request) && !empty($request)) {
        ?>
            <form method="post" action="<?php echo base_url(); ?>staff/dashboard/take_repair_request/<?php echo encrypt_it($request[0]['rsd_id']); ?>">
                <div class="row mx-3 border-start border-2">
                    <div class="col-4">
                        <div class="card text-white bg-primary shadow-sm rounded-3 position-relative h-100">
                            <span class="position-absolute top-0 start-0 m-3">
                                <i class="fas fa-clock fa-lg fa-fw"></i>
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
                            <a href="<?php echo base_url() . 'staff/dashboard/'; ?>" class="position-absolute top-100 start-50 translate-middle">
                                <span class="fa-stack fa-2x">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-eye-slash fa-stack-1x text-white"></i>
                                </span>
                            </a>

                        </div>
                    </div>
                    <div class="col">
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
                                    <select class="form-select" name="status" id="status_select" required>
                                        <option value="0">Unable to repair</option>
                                        <option value="1">Can be repair</option>
                                    </select>
                                </div>
                                <div class="form-group pb-2" id="reason_select">
                                    <small class="text-muted">Repair Reason</small>
                                    <select class="form-select" name="reason">
                                        <option <?php if ($request[0]['rsd_comment'] == 'No parts available')  echo 'selected'; ?>>No parts available</option>
                                        <option <?php if ($request[0]['rsd_comment'] == 'No technician available')  echo 'selected'; ?>>No technician available</option>
                                    </select>
                                </div>
                                <div class="form-group pb-2" id="price_input" style="display: none;">
                                    <small class="text-muted">Repair Estimation Cost</small>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">RM</div>
                                        </div>
                                        <input type="number" class="form-control" name="price" placeholder="Enter quotation price" value="<?php echo $request[0]['rsd_repair_cost']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-3">
                    <div class="col text-end">
                        <a href="<?php echo base_url(); ?>staff/dashboard/delete/<?php echo encrypt_it($request[0]['rsd_id']); ?>" class="btn btn-danger" onclick="return confirm('Are sure you want to delete this repair request?');">DELETE REQUEST</a>
                        <button type="submit" class="btn btn-primary" name="submit" value="submit" onclick="return confirm('Are sure you want to update this repair request as it will be assigned to you?');">UPDATE AND ACCEPT REPAIR</button>
                    </div>
                </div>
            </form>
        <?php
        } else {
            redirect(base_url() . 'staff/dashboard');
        }
        ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#status_select').on('change', function() {
            if ($('#status_select').val() == '0') {
                $('#reason_select').show();
                $('#price_input').hide();
            } else {
                $('#reason_select').hide();
                $('#price_input').show();
            }
        });
    });
</script>