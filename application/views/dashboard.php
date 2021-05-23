<div class="wrapper">
    <div class="container p-5" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Dashboard</h3>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3  m-3 border-start border-2">
            <?php
            if (is_array($request) && !empty($request)) {
                foreach ($request as $row) {

                    if ($row['rsd_progress'] == 0) {

                        echo '<div class="col">';
                        echo '<div class="card text-white bg-secondary shadow rounded-lg border position-relative h-100">';
                        echo '<div class="card-body">';
                        echo '<span><i class="fas fa-clock fa-lg"></i></span>';

                        echo '<h1 class="card-title p-4 fw-light text-capitalize">' . $row['rsd_device_brand'] . '<br>' .  $row['rsd_device_model'] . '</h1>';

                        echo  '<div class="p-4">';
                        echo  '<div class="card-text text-capitalize">' . $row['rsd_damage_info'] . '</div>';
                        echo '<div class="card-text text-capitalize">';

                        if ($row['rsd_sd_id'] === null) {
                            echo 'No technician assigned';
                        } else {
                            $technician = $controller->get_technician_info($row['rsd_sd_id']);
                            $technician_name = explode(' ', $technician[0]['sd_full_name']);
                            echo 'Technician ' . $technician_name[0];
                        }

                        echo '</div>';
                        echo '<div class="card-text text-capitalize">';

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

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="card-footer text-center">';
                        echo '<div class="card-text px-3">';

                        echo 'PENDING';
                        echo '</div>';
                        echo '</div>';
                        echo '<a href="' . base_url() . 'dashboard/delete/' . encrypt_it($row['rsd_id']) . '" class="position-absolute top-0 end-0 m-2" onclick="return confirm("Are you sure you want to cancel your request");"><span class="fa-stack fa-lg "><i class="fa fa-circle fa-stack-2x text-danger" ></i><i class="fa fa-times fa-stack-1x text-white"></i></span></a>';
                        echo '</div>';

                        echo '<div class="d-flex justify-content-center pt-3">';

                        echo '</div>';
                        echo '</div>';
                    } else {

                        echo '<div class="col">';
                        echo '<div class="card bg-white rounded-lg position-relative h-100">';
                        echo '<div class="card-body">';
                        echo '<span><i class="fas fa-check fa-lg"></i></span>';

                        echo '<h1 class="card-title p-4 fw-light text-capitalize">' . $row['rsd_device_brand'] . '<br>' .  $row['rsd_device_model'] . '</h1>';


                        echo  '<div class="p-4">';
                        echo  '<div class="card-text text-capitalize">' . $row['rsd_damage_info'] . '</div>';
                        echo '<div class="card-text text-capitalize">';

                        if ($row['rsd_sd_id'] === null) {
                            echo 'No technician assigned';
                        } else {
                            $technician = $controller->get_technician_info($row['rsd_sd_id']);
                            $technician_name = explode(' ', $technician[0]['sd_full_name']);
                            echo 'Technician ' . $technician_name[0];
                        }

                        echo '</div>';
                        echo '<div class="card-text text-capitalize">';

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

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                        echo '<div class="card-footer text-center">';
                        echo '<div class="card-text px-3">';
                        echo 'COMPLETED';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                        echo '<div class="d-flex justify-content-center pt-3">';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            } else {
                echo '<div class="col">No upcoming and past request.</div>';
            }
            ?>
        </div>
    </div>
</div>