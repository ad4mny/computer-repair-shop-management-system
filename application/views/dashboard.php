<div class="wrapper">
    <div class="container p-5" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary">Dashboard</h3><br>
                <button class="btn btn-primary">REQUEST NEW</button>
            </div>
        </div>
        <div class="d-flex flex-row flex-nowrap overflow-auto py-5">
            <?php
            if (is_array($request)) {
                foreach ($request as $row) {
            ?>
                    <div class="col-sm-12 col-md-3  me-4 ">
                        <div class="card text-white bg-secondary shadow rounded-lg border">
                            <div class="card-body">
                                <span><i class="fas fa-clock fa-lg"></i></span>
                                <h1 class="card-title p-3 fw-light text-capitalize"><?php echo $row['rsd_device_brand'] . ' ' .  $row['rsd_device_model']; ?></h1>
                                <div class="p-3">
                                    <div class="card-text text-capitalize"><?php echo $row['rsd_damage_info']; ?></div>
                                    <div class="card-text text-capitalize">
                                        <?php
                                        if ($row['rsd_sd_id'] === null) {
                                            echo 'No technician assigned yet.';
                                        } else {
                                            echo $row['rsd_sd_id'];
                                        }
                                        ?>
                                    </div>
                                    <div class="card-text text-capitalize">
                                        <?php
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
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <div class="card-text px-3">
                                    <?php
                                    switch ($row['rsd_progress']) {
                                        case 2:
                                            echo 'COMPLETED';
                                            break;
                                        case 1:
                                            echo 'ONGOING';
                                            break;
                                        default:
                                            echo 'PENDING';
                                            break;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center pt-3">
                            <button class="btn rounded-circle bg-danger shadow-sm"><i class="fas fa-times fa-2x text-white p-1 "></i></button>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo 'No upcoming and past request.';
            }
            ?>
        </div>
    </div>
</div>