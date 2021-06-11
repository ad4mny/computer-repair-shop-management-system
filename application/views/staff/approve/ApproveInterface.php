<div class="wrapper">
    <div class="container p-5 " id="content">
        <!-- Alert Section  -->
        <div id="alert" class="w-50 position-absolute top-0 start-50 translate-middle mt-5" style="z-index: 1;">
            <?php
            if ($this->session->tempdata('notice') != NULL) {
                echo '<div class="alert alert-warning shadow-sm alert-dismissible fade show" role="alert">';
                echo '<i class="fas fa-info-circle fa-fw"></i> ' . $this->session->tempdata('notice');
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            }
            if ($this->session->tempdata('error') != NULL) {
                echo '<div class="alert alert-danger shadow-sm alert-dismissible fade show" role="alert">';
                echo '<i class="fas fa-exclamation-circle fa-fw"></i> ' . $this->session->tempdata('error');
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            }
            ?>
        </div>
        <!-- Login Section -->
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Manage Pending User</h3>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3 mx-3">
                <p>All pending runner and staff in the system</p>
            </div>
        </div>
        <div class="row mx-3">
            <p>Pending Staff</p>
        </div>
        <?php
        $i = 0;
        if (isset($staff) && is_array($staff) && !empty($staff)) {
            ?>
            <div class="row mx-3 text-muted">
                <div class="col-1 text-center"><small>NO</small></div>
                <div class="col-2 text-uppercase"><small>ID</small></div>
                <div class="col text-capitalize"><small>FULL NAME</small></div>
                <div class="col-2  text-capitalize"><small>CONTACT</small></div>
                <div class="col-2  text-capitalize"></div>
            </div>
            <?php
            foreach ($staff as $row) {
        ?>
                <div class="row mx-3 mb-1 py-2 shadow-sm bg-white rounded-3">
                    <div class="col-1 text-center m-auto"><?php echo ++$i; ?></div>
                    <div class="col-2 m-auto"> <?php echo 'SD-' . encrypt_it($row['sd_id']); ?></div>
                    <div class="col text-capitalize m-auto"> <?php echo $row['sd_full_name']; ?></div>
                    <div class="col-2 text-capitalize m-auto"> <?php echo $row['sd_phone']; ?></div>
                    <div class="col-2 text-end m-auto">
                        <a href="<?php echo base_url() . 'staff/approve/reject/' . encrypt_it($row['sd_id']) . '/' . encrypt_it(2); ?>" class="btn btn-danger btn-sm">
                            <i class="fas fa-times fa-fw"></i>
                        </a>
                        <a href="<?php echo base_url() . 'staff/approve/accept/' . encrypt_it($row['sd_id']) . '/' . encrypt_it(2); ?>" class="btn btn-success btn-sm">
                            <i class="fas fa-check fa-fw"></i>
                        </a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '<div class="row mx-3 mb-1 py-2 shadow-sm bg-white rounded-3 text-center">';
            echo '<div class="col">No pending staff in the system.</div>';
            echo '</div>';
        }
        ?>
        <div class="row mx-3 mt-3">
            <p>Pending Runner</p>
        </div>
        <?php
        $i = 0;
        if (isset($runner) && is_array($runner) && !empty($runner)) {
        ?>
            <div class="row mx-3 text-muted">
                <div class="col-1 text-center"><small>NO</small></div>
                <div class="col-2 text-uppercase"><small>ID</small></div>
                <div class="col text-capitalize"><small>FULL NAME</small></div>
                <div class="col-2  text-capitalize"><small>CONTACT</small></div>
                <div class="col-2  text-capitalize"></div>
            </div>
            <?php
            foreach ($runner as $row) {
            ?>
                <div class="row mx-3 mb-1 py-2 shadow-sm bg-white rounded-3">
                    <div class="col-1 text-center m-auto"><?php echo ++$i; ?></div>
                    <div class="col-2 m-auto"> <?php echo 'SD-' . encrypt_it($row['rd_id']); ?></div>
                    <div class="col text-capitalize m-auto"> <?php echo $row['rd_full_name']; ?></div>
                    <div class="col-2 text-capitalize m-auto"> <?php echo $row['rd_phone']; ?></div>
                    <div class="col-2 text-end m-auto">
                        <a href="<?php echo base_url() . 'staff/approve/reject/' . encrypt_it($row['rd_id']) . '/' . encrypt_it(1); ?>" class="btn btn-danger btn-sm">
                            <i class="fas fa-times fa-fw"></i>
                        </a>
                        <a href="<?php echo base_url() . 'staff/approve/accept/' . encrypt_it($row['rd_id']) . '/' . encrypt_it(1); ?>" class="btn btn-success btn-sm">
                            <i class="fas fa-check fa-fw"></i>
                        </a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '<div class="row mx-3 mb-1 py-2 shadow-sm bg-white rounded-3 text-center">';
            echo '<div class="col">No pending runner in the system.</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>