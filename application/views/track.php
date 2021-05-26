<div class="wrapper">
    <div class="container p-5" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Tracking </h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="box">
                    <ul id="first-list">
                        <?php if (is_array($track) && !empty($track)) {
                            foreach ($track as $row) { ?>
                                <li class="shadow">
                                    <?php
                                    switch ($row['td_status']) {
                                        case 'Completed':
                                            $comment = 'Repair Success.';
                                            break;
                                        case 'Picking Up':
                                            $comment = 'At the store';
                                            break;
                                        default:
                                            $comment = 'Repairing';
                                            break;
                                    }
                                    echo '<span></span>';
                                    echo '<div class="title text-capitalize text-primary">' . $row['td_status'] . '</div>';
                                    echo '<div class="info text-sentance">' . $comment . '</div>';

                                    if ($row['td_rd_id'] == null) {
                                        echo '<div class="name text-capitalize ">' . $row['sd_full_name'] . '</div>';
                                    } else {
                                        $runner = $controller->get_runner_info($row['td_rd_id']);
                                        echo '<div class="name text-capitalize ">' . $runner[0]['rd_full_name'] . '</div>';
                                    }

                                    echo '<div class="time">';
                                    $date_explode = explode(' ', $row['td_log']);

                                    echo '<span class="text-capitalize">' . date("F j", strtotime($date_explode[1])) . '</span>';
                                    echo '<span>' . date("H:m a", strtotime($date_explode[0])) . '</span>';
                                    echo '</div>';
                                    ?>
                                </li>
                        <?php }
                        } ?>
                    </ul>
                </div>
            </div>
            <div class="col border-start ps-5">
                <p>All tracking list</p>
                <?php
                $temp = '';
                if (is_array($tracking) && !empty($tracking) && is_array($track) && !empty($track)) {
                    foreach ($tracking as $row) {
                        if ($row['td_rsd_id'] !== $temp) {
                            $temp = $row['td_rsd_id'];
                            echo '<a href="' . base_url() . 'track/' . encrypt_it($row['rsd_id']) . '" class="text-capitalize">';
                            echo '<div class="card bg-white rounded-lg mb-2">';
                            echo '<div class="card-body">';
                            echo '<h4 class="card-title fw-light text-capitalize text-primary">' . $row['rsd_device_brand'] . ' ' . $row['rsd_device_model'] . '</h4>';
                            echo '<div class="card-text text-muted">Service ID: '. encrypt_it($row['rsd_id']) . '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</a>';
                        }
                    }
                } else {
                    echo '<p>No tracking detail found.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>