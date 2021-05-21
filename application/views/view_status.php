<div class="wrapper">
    <div class="container p-5" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Repair Status Details</h3>
            </div>
        </div>
        <?php
        if (is_array($request) && !empty($request)) {
            foreach ($request as $row) {
        ?>
                <div class="row p-3">
                    <div class="col-5">
                        <div class="py-3 border-bottom">
                            <small>Device Detail</small>
                            <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $row['rsd_device_brand'] . ' ' . $row['rsd_device_model']; ?></p>
                            <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $row['rsd_device_color']; ?></p>
                        </div>
                        <div class="py-3 border-bottom">
                            <small>Repair Status</small>
                            <?php
                            if ($row['rsd_status'] == 1) {
                                echo '<p class="text-capitalize mb-0 text-info"><i class="fas fa-circle-notch fa-xs fa-fw"></i> Can be repair</p>';
                            } else {
                                echo '<p class="text-capitalize mb-0 text-danger"><i class="fas fa-circle-notch fa-xs fa-fw"></i> Cannot be repair</p>';
                            }
                            ?>
                        </div>
                        <div class="py-3 border-bottom">
                            <small>Damage Info</small>
                            <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $row['rsd_damage_info']; ?></p>
                        </div>
                        <div class="py-3 border-bottom">
                            <small class="">Repair Progress</small>
                            <?php
                            switch ($row['rsd_progress']) {
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
                            <p class="text-capitalize mb-0"><i class="fas fa-circle-notch fa-xs fa-fw"></i> <?php echo $row['rsd_comment']; ?></p>
                        </div>
                    </div>
                    <div class="col border-start">
                        <div class="py-3">
                            <small>Insepction Charge </small>
                            <p class="text-capitalize mb-0">RM 50.00</p>
                            <small>Repair Cost</small>
                            <p class="text-capitalize mb-0">RM 600.00</p>
                            <small>Service Charge 6%</small>
                            <p class="text-capitalize mb-0">RM 39.00</p>
                            <small>Total Price</small>
                            <h4 class="text-capitalize mb-0">RM 689.00</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-11 text-end fixed-bottom pb-5">
                        <a href="<?php echo base_url(); ?>/dashboard" class="btn btn-secondary">CANCEL REPAIR</a>
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">CONFIRM REPAIR AND PROCEED PAYMENT</button>
                    </div>
                </div>
        <?php

            }
        }
        ?>
    </div>
</div>