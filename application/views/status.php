<div class="wrapper">
    <div class="container p-5 pb-0" id="content">
        <div id="repair_info">
            <div class="row">
                <div class="col">
                    <h3 class="display-4 mb-0 text-secondary ">Repair Status </h3>
                </div>
            </div>
            <?php if (is_array($request) && !empty($request)) { ?>
                <div class="row m-3 border-start border-2 ">
                    <div class="col">
                        <div class="card text-white bg-primary shadow rounded-lg border position-relative h-100">
                            <div class="card-body">
                                <span><i class="fas fa-clock fa-lg"></i></span>
                                <h1 class="card-title p-4 fw-light text-capitalize">
                                    <?php echo $request[0]['rsd_device_brand']; ?><br>
                                    <?php echo $request[0]['rsd_device_model']; ?>
                                </h1>
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
                                <div class="card-text px-3">ONGOING</div>
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
                                    if ($request[0]['rsd_status'] == 1) {
                                        echo '<p class="text-capitalize mb-0 text-info"><i class="fas fa-circle-notch fa-xs fa-fw"></i> Can be repair</p>';
                                    } else {
                                        echo '<p class="text-capitalize mb-0 text-danger"><i class="fas fa-circle-notch fa-xs fa-fw"></i> Cannot be repair</p>';
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
                                        case 2:
                                            echo '<p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> Completed</p>';
                                            break;
                                        case 1:
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
                                    <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $request[0]['rsd_comment']; ?></p>
                                </div>
                            </div>
                            <div class="col border-start">
                                <div class="py-3">
                                    <small>Insepction Charge </small>
                                    <p class="text-capitalize mb-0">RM 50.00</p>
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
                                        echo 'RM ' . number_format((int)$repair_cost + (int)$service_tax + 50, 2);
                                        ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-3">
                    <div class="col-4 m-auto">
                        <select class="form-select text-capitalize" id="request_list">
                            <?php
                            if (is_array($services) && !empty($services) && is_array($request) && !empty($request)) {
                                foreach ($services as $row) {
                                    if ($row['rsd_id'] === $request[0]['rsd_id']) {
                                        echo '<option disabled selected>' . $row['rsd_device_brand'] . ' ' . $row['rsd_device_model'] . '</option>';
                                    } else {
                                        echo '<option value="' . encrypt_it($row['rsd_id']) . '">' . $row['rsd_device_brand'] . ' ' . $row['rsd_device_model'] . '</option>';
                                    }
                                }
                            } else {
                                echo '<option disabled selected>No service request</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col text-end">
                        <a href="<?php echo base_url(); ?>/dashboard" class="btn btn-secondary">CANCEL REQUEST</a>
                        <button class="btn btn-primary" id="continue_btn">CONTINUE</button>
                    </div>
                </div>
            <?php } else {
                echo 'No upcoming and past request.';
            } ?>
        </div>
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
                        echo 'RM ' . number_format((int)$repair_cost + (int)$service_tax + 50, 2);
                        ?>
                    </h2>
                    <small class="text-muted ">Note: Please present Service ID during device collection.</small><br>
                </div>
                <div class="col ps-3 ">
                    <form method="post" action="<?php echo base_url(); ?>payment/pay">
                        <small>Pickup Date & Time</small>
                        <div class="row row-cols-auto g-1">
                            <div class="col-auto">
                                <input type="date" class="form-control" name="pickup_date" required>
                            </div>
                            <div class="col-auto">
                                <select class="form-select" name="pickup_time" required>
                                    <option value="10">10.00 AM</option>
                                    <option value="2">2.00 PM</option>
                                    <option value="6">6.00 PM</option>
                                    <option value="8">8.00 PM</option>
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