<div class="wrapper">
    <div class="container p-5 pb-0" id="content">
        <div id="repair_info">
            <div class="row">
                <div class="col">
                    <h3 class="display-4 mb-0 text-secondary ">Status</h3>
                </div>
            </div>
            <div class="row">
                <div class="col mt-3 mx-3">
                    <p>Latest repair request status</p>
                </div>
            </div>
            <?php if (is_array($request) && !empty($request)) { ?>
                <div class="row mx-3 border-start border-2 ">
                    <div class="col">
                        <div class="card text-white bg-primary shadow rounded-lg border position-relative h-100">
                            <?php if ($request[0]['rsd_progress'] == 0) {
                                echo '<span class="position-absolute top-0 start-0 m-3"><i class="fas fa-clock fa-lg fa-fw"></i> PENDING</span>';
                            } else {
                                echo '<span class="position-absolute top-0 start-0 m-3"><i class="fas fa-spinner fa-lg fa-fw"></i> REPAIRING</span>';
                            }
                            ?>
                            <div class="card-body pt-5">
                                <div class="card-text px-4 py-5 fw-light text-capitalize ">
                                    <h1> <?php echo $request[0]['rsd_device_brand']; ?><br>
                                        <small><?php echo $request[0]['rsd_device_model']; ?></small>
                                    </h1>
                                </div>
                                <div class="p-4">
                                    <div class="card-text text-capitalize"> <?php echo $request[0]['rsd_damage_info']; ?></div>
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
                            <div class="card-footer text-center">
                                <div class="card-text text-capitalize text-center"><?php echo 'DCRS-' . encrypt_it($request[0]['rsd_id']); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="row p-3">
                            <div class="col">
                                <div class="py-3 border-bottom">
                                    <small>Device Detail</small>
                                    <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $request[0]['rsd_device_brand'] . ' ' . $request[0]['rsd_device_model']; ?></p>
                                    <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $request[0]['rsd_device_color']; ?></p>
                                </div>
                                <div class="py-3 border-bottom">
                                    <small>Repair Status</small>
                                    <?php
                                    switch ($request[0]['rsd_status']) {
                                        case '1':
                                            echo '<p class="text-capitalize mb-0 text-info"><i class="fas fa-circle-notch fa-xs fa-fw"></i> Can be repair</p>';
                                            break;
                                        case '0':
                                            echo '<p class="text-capitalize mb-0 text-danger"><i class="fas fa-circle-notch fa-xs fa-fw"></i> Cannot be repair</p>';
                                            break;
                                        default:
                                            echo '<p class="text-capitalize mb-0 text-muted"><i class="fas fa-circle-notch fa-xs fa-fw"></i> Pending</p>';
                                            break;
                                    }
                                    ?>
                                </div>
                                <div class="py-3 border-bottom">
                                    <small>Damage Info</small>
                                    <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $request[0]['rsd_damage_info']; ?></p>
                                </div>
                                <div class="py-3 border-bottom">
                                    <small class="">Repair Progress</small>
                                    <?php
                                    switch ($request[0]['rsd_progress']) {
                                        case '2':
                                            echo '<p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> Completed</p>';
                                            break;
                                        case '1':
                                            echo '<p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> Ongoing</p>';
                                            break;
                                        default:
                                            echo '<p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> Pending</p>';
                                            break;
                                    }
                                    ?>
                                </div>
                                <div class="py-3">
                                    <small>Comment</small>
                                    <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i>
                                        <?php
                                        if (!empty($request[0]['rsd_comment'])) {
                                            echo $request[0]['rsd_comment'];
                                        } else {
                                            echo 'None';
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col border-start position-relative mb-5">
                                <div class="py-3">
                                    <small>Payment Status</small>
                                    <h4 class="text-capitalize mb-0 ">
                                        <?php
                                        if ($request[0]['rsd_progress'] == '0') {
                                            echo '<span class="text-warning">Pending</span>';
                                        } else {
                                            echo '<span class="text-success">Paid</span>';
                                        } ?>
                                    </h4>
                                    <small>Inspection Charge </small>
                                    <p class="text-capitalize mb-0">RM 20.00</p>
                                    <small>Repair Cost</small>
                                    <p class="text-capitalize mb-0">
                                        <?php
                                        $repair_cost = number_format($request[0]['rsd_repair_cost'], 2, '.', '');
                                        echo 'RM ' . $repair_cost
                                        ?>
                                    </p>
                                    <small>Service Charge 6%</small>
                                    <p class="text-capitalize mb-0">
                                        <?php
                                        $service_tax = number_format(((6 / 100) * $request[0]['rsd_repair_cost']), 2);
                                        echo 'RM ' . $service_tax;
                                        ?>
                                    </p>
                                    <small>Total Price</small>
                                    <h4 class="text-capitalize mb-0">
                                        <?php
                                        echo 'RM ' . number_format((int)$repair_cost + (int)$service_tax + 20, 2);
                                        ?>
                                    </h4>
                                </div>
                                <div class="position-absolute bottom-0 end-0 ms-3 text-end">
                                    <?php
                                    if ($request[0]['rsd_progress'] == '0') {
                                        switch ($request[0]['rsd_status']) {
                                            case '1':
                                    ?>
                                                <a href="<?php echo base_url() . 'dashboard/delete/' . encrypt_it($request[0]['rsd_id']); ?>" class="btn btn-danger me-2" onclick="return confirm('Are you sure you want to cancel your request?');">CANCEL</a>
                                    <?php
                                                echo '<button class="btn btn-primary" id="continue_btn">CONTINUE <i class="fas fa-chevron-down fa-fw"></i></button>';
                                                break;
                                            case '0':
                                                echo '<small class="text-muted">The technician is unable to repair your device but you need to pay the inspection fees.</small><br>';
                                                echo '<form method="post" action="' . base_url() . 'payment/pay/' . encrypt_it($request[0]['rsd_id']) . '">';
                                                echo '<input type="hidden" name="pickup_date">';
                                                echo '<input type="hidden" name="pickup_time">';
                                                echo '<button type="submit" class="btn btn-primary mt-2" name="submit">PAY INSPECTION FEE <i class="fas fa-chevron-right fa-fw"></i></button>';
                                                echo '</form>';
                                                break;
                                            default:
                                                echo '<small class="text-muted">Please wait while the technician inspecting your repair request.</small><br>';
                                                echo '<a href="' . base_url() . 'status/' . encrypt_it($request[0]['rsd_id']) . '/update" class="btn btn-primary mt-2">UPDATE REQUEST</a>';
                                                break;
                                        }
                                    } else {
                                        echo '<small class="text-muted">Please wait while the technician repairing your device.</small>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-3">

                </div>
            <?php } else {
                echo '<div class="row m-3 border-start border-2 "><p class="col">No ongoing repair request.</p></div>';
            } ?>
        </div>
        <?php if (isset($request[0]['rsd_progress']) && $request[0]['rsd_progress'] == '0') { ?>
            <div class="my-5" id="delivery_info" style="display:none;">
                <div class="row pt-5">
                    <div class="col">
                        <h3 class="display-4 mb-0 text-secondary ">Delivery & Pickup Information</h3>
                    </div>
                </div>
                <div class="row  p-3">
                    <div class="col">
                        <div class="py-2">
                            <small>Service ID</small>
                            <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo 'DCRS-' . encrypt_it($request[0]['rsd_id']); ?></p>
                        </div>
                        <div class="py-2 ">
                            <small>Customer Name</small>
                            <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $profile[0]['cd_full_name']; ?></p>
                        </div>
                        <div class="py-2">
                            <small>Contact Number</small>
                            <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $profile[0]['cd_phone']; ?></p>
                        </div>
                        <div class="py-2 ">
                            <small>Device Detail</small>
                            <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $request[0]['rsd_device_brand'] . ' ' . $request[0]['rsd_device_model']; ?></p>
                            <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $request[0]['rsd_device_color']; ?></p>
                        </div>
                    </div>
                    <div class="col border-start border-2 ps-5">
                        <div class="py-2 ">
                            <small>Street Address 1</small>
                            <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $profile[0]['cd_street_1']; ?></p>
                        </div>
                        <div class="py-2 ">
                            <small>Street Address 2</small>
                            <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $profile[0]['cd_street_2']; ?></p>
                        </div>
                        <div class="py-2 ">
                            <small>City</small>
                            <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $profile[0]['cd_city']; ?></p>
                        </div>
                        <div class="py-2 ">
                            <small>Postcode</small>
                            <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $profile[0]['cd_postcode']; ?></p>
                        </div>
                        <div class="py-2 ">
                            <small>State</small>
                            <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $profile[0]['cd_state']; ?></p>
                        </div>
                        <div class="py-2 ">
                            <a href="<?php echo base_url(); ?>profile/update" class="text-primary">Update Address Information</a>
                        </div>
                    </div>
                </div>
                <div class="row p-3 ">
                    <div class="col">
                        <small>Total Price</small>
                        <h2 class="text-capitalize mb-0">
                            <?php
                            echo 'RM ' . number_format((int)$repair_cost + (int)$service_tax + 20, 2);
                            ?>
                        </h2>
                        <small class="text-muted ">Note: Please present Service ID during device collection.</small><br>
                    </div>
                    <div class="col ps-3 ">
                        <form method="post" action="<?php echo base_url(); ?>payment/pay/<?php echo encrypt_it($request[0]['rsd_id']); ?>">
                            <small>Pickup Date & Time</small>
                            <div class="row row-cols-auto g-1">
                                <div class="col-auto">
                                    <input type="date" class="form-control" name="pickup_date" min="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                                <div class="col-auto">
                                    <select class="form-select" name="pickup_time" required>
                                        <option value="10:00:00">10.00 AM</option>
                                        <option value="14:00:00">2.00 PM</option>
                                        <option value="18:00:00">6.00 PM</option>
                                        <option value="20:00:00">8.00 PM</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary" name="submit">PROCEED PAYMENT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('#request_list').on('change', function() {
            window.location.replace('<?php echo base_url(); ?>status/' + this.value);
        });

        $('#continue_btn').on('click', function() {
            $("#delivery_info").show();
            $('html,body').animate({
                scrollTop: $("#delivery_info").offset().top
            }, 'slow');
        });
    });
</script>