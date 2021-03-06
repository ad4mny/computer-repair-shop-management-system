<div class="wrapper">
    <div class="container-fluid" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Tracking</h3>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3 mx-3">
                <p>All repair request device tracking list</p>
            </div>
        </div>
        <div class="row mx-3 border-start border-2">
            <div class="col border-end">
                <?php
                if (isset($tracking) && is_array($tracking) && !empty($tracking) && isset($track) && is_array($track) && !empty($track)) {

                    foreach ($tracking as $row) {
                        if ($track[0]['td_rsd_id'] == $row['rsd_id']) {
                            if ($row['rsd_status'] == '0' && $row['rsd_progress'] == '0') {
                                echo '<div class="mt-5"> <p>Cancelled / Unable to repair</p></div>';
                                echo '<div class="py-2 bg-danger rounded-3 mb-2 shadow-sm position-relative">';
                            } else {
                                echo '<div class="border py-2 bg-primary rounded-3 mb-2 position-relative">';
                            }
                            echo '<a href="' . base_url() . 'track/' . encrypt_it($row['rsd_id']) . '" class="text-capitalize">';
                            echo '<h4 class="px-3 text-capitalize text-white">' . $row['rsd_device_brand'] . ' ' . $row['rsd_device_model'] . '</h4>';
                            echo '<div class="px-3 fw-light text-white">Service ID: DCRS-' . encrypt_it($row['rsd_id']) . '</div>';
                            echo '</a>';
                            echo '<span class="position-absolute top-50 end-0 translate-middle me-1"><i class="fas fa-chevron-right fa-fw fa-lg text-white"></i></span>';
                            echo '</div>';
                        } else {
                            if ($row['rsd_status'] == '0' && $row['rsd_progress'] == '0') {
                                echo '<div class="mt-5"> <p>Cancelled / Unable to repair</p></div>';
                                echo '<div class="py-2 bg-white rounded-3 mb-2 border position-relative">';
                                echo '<a href="' . base_url() . 'track/' . encrypt_it($row['rsd_id']) . '" class="text-capitalize">';
                                echo '<h4 class="px-3 text-capitalize text-danger">' . $row['rsd_device_brand'] . ' ' . $row['rsd_device_model'] . '</h4>';
                                echo '<div class="px-3 text-danger fw-light">Service ID: DCRS-' . encrypt_it($row['rsd_id']) . '</div>';
                                echo '</a>';
                            } else {
                                echo '<div class="py-2 bg-white rounded-3 mb-2 border position-relative">';
                                echo '<a href="' . base_url() . 'track/' . encrypt_it($row['rsd_id']) . '" class="text-capitalize">';
                                echo '<h4 class="px-3 text-capitalize text-primary">' . $row['rsd_device_brand'] . ' ' . $row['rsd_device_model'] . '</h4>';
                                echo '<div class="px-3 text-primary fw-light">Service ID: DCRS-' . encrypt_it($row['rsd_id']) . '</div>';
                                echo '</a>';
                            }
                            echo '<span class="position-absolute top-50 end-0 translate-middle me-1"><i class="fas fa-chevron-right fa-fw fa-lg text-white"></i></span>';
                            echo '</div>';
                        }
                    }
                } else {
                    echo '<p>No tracking data available.</p>';
                }
                ?>
            </div>
            <div class="col">
                <div class="box">
                    <ul id="first-list">
                        <?php if (isset($track) && is_array($track) && !empty($track)) {
                            foreach ($track as $row) {

                                echo '<li class="shadow-sm border">';

                                if ($row['rsd_status'] != '0' && $row['rsd_progress'] != '0') {
                                    switch ($row['td_status']) {
                                        case 'Picking Up':
                                            $comment = 'Runner picking up your device';
                                            break;
                                        case 'Paid':
                                            $comment = 'Awaiting repair queue';
                                            break;
                                        case 'Repairing':
                                            $comment = 'Repairing your device';
                                            break;
                                        case 'Completed':
                                            $comment = 'Repair is completed succesfully';
                                            break;
                                        case 'Delivering':
                                            $comment = 'Runner at the store';
                                            break;
                                        default:
                                            $comment = 'Device has been delivered';
                                            break;
                                    }
                                } else {
                                    switch ($row['td_status']) {
                                        case 'Picking Up':
                                            $comment = 'Runner picking up your device';
                                            break;
                                        case 'Paid':
                                            $comment = 'Awaiting repair queue';
                                            break;
                                        case 'Repairing':
                                            $comment = 'Repairing your device';
                                            break;
                                        case 'Completed':
                                            $comment = 'Unable to repair your device';
                                            break;
                                        case 'Delivering':
                                            $comment = 'Runner at the store';
                                            break;
                                        default:
                                            $comment = 'Device has been delivered';
                                            break;
                                    }
                                }

                                echo '<span></span>';
                                echo '<div class="text-capitalize text-primary">' . $row['td_status'] . '</div>';
                                echo '<div><p>' . $comment . '</p></div>';

                                if ($row['td_rd_id'] == null) {
                                    $technician = $controller->get_technician_info($row['td_rsd_id']);
                                    echo '<small class="text-capitalize pt-3 text-end">' . $technician[0]['sd_full_name'] . '</small>';
                                } else {
                                    $runner = $controller->get_runner_info($row['td_rd_id']);
                                    echo '<small class="text-capitalize pt-3 text-end">' . $runner[0]['rd_full_name'] . '</small>';
                                }

                                echo '<div class="time">';
                                $date_explode = explode(' ', $row['td_log']);

                                echo '<span class="text-capitalize">' . date("F j", strtotime($date_explode[0])) . '</span>';
                                echo '<span>' . date("H:i a", strtotime($date_explode[1])) . '</span>';
                                echo '</div>';
                                echo '</li>';
                            }
                        } else {
                            echo '<li>';
                            echo '<div class=" text-primary"><p>No tracking information available.</p></div>';
                            echo '</li>';
                        } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>