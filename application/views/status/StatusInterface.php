<div class="wrapper">
    <div class="container p-5 " id="content">
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
                <div class="row mx-3 mb-3 border-start border-2 ">
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
                            <div class="col border-end">
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
                                            echo '<p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> Pending</p>';
                                            break;
                                    }
                                    ?>
                                </div>
                                <div class="py-3 border-bottom">
                                    <small>Damage Info</small>
                                    <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i>
                                        <?php echo $request[0]['rsd_damage_info']; ?>
                                    </p>
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
                            <div class="col">
                                <div class="py-3">
                                    <small>Payment Status</small>
                                    <h4 class="text-capitalize mb-0 ">
                                        <?php
                                        if ($request[0]['rsd_progress'] == NULL || $request[0]['rsd_progress'] == '0') {
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-3">
                    <div class="col text-end">
                        <?php
                        if ($request[0]['rsd_status'] == null && $request[0]['rsd_progress'] == null) {

                            echo '<small class="text-muted">Awaiting device pickup by runner.</small><br>';
                            echo '<a href="' . base_url() . 'status/' . encrypt_it($request[0]['rsd_id']) . '/update" class="btn btn-primary mt-2"><i class="fas fa-edit fa-fw fa-sm me-1"></i> UPDATE REQUEST</a>';

                        } else if ($request[0]['rsd_status'] == null && $request[0]['rsd_progress'] == '0') {

                            echo '<small class="text-muted">Awaiting for staff to repair your device.</small><br>';

                        } else if ($request[0]['rsd_status'] == '0' && $request[0]['rsd_progress'] == '0') {

                            echo '<small class="text-muted">The technician is unable to repair your device but you need to pay the inspection fees.</small><br>';
                            echo '<a href="' . base_url() . 'payment/pay/' . encrypt_it($request[0]['rsd_id']) . '" type="submit" class="btn btn-primary mt-2" name="submit">PAY INSPECTION FEE <i class="fas fa-chevron-right fa-fw"></i></a>';

                        } else if ($request[0]['rsd_status'] == '1' && $request[0]['rsd_progress'] == '0') {

                            echo '<button class="btn btn-primary" id="continue_btn">CONTINUE <i class="fas fa-chevron-right fa-fw fa-sm me-1"></i></button>';
                            
                        } else {
                            echo '<small class="text-muted">Please wait while the technician repairing your device.</small>';
                        }
                        ?>
                    </div>
                </div>
            <?php } else {
                echo '<div class="row mx-3 border-start border-2 "><p class="col">No ongoing repair request.</p></div>';
            } ?>
        </div>
        <?php
        if (is_array($request) && !empty($request)) {
            if ($request[0]['rsd_progress'] !== null) { ?>
                <div class="my-5" id="delivery_info" style="display:none;">
                    <div class="row pt-5">
                        <div class="col">
                            <h3 class="display-4 mb-0 text-secondary ">Delivery Information</h3>
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
                        <div class="col text-end m-auto">
                            <a href="<?php echo base_url(); ?>payment/pay/<?php echo encrypt_it($request[0]['rsd_id']); ?>" type="submit" class="btn btn-primary" name="submit">PROCEED PAYMENT</a>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
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