<div class="wrapper">
    <div class="container p-5 " id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">Manage User Account</h3>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3 mx-3">
                <p>All registered user in the system</p>
            </div>
        </div>
        <div class="row mx-3 mb-3">
            <div class="col-5 ">
                <form method="post" action="<?php echo base_url(); ?>staff/manage/search">
                    <div class="input-group">
                        <input type="text" class="form-control" name="query" placeholder="Search user..">
                        <button class="btn btn-primary" type="submit" name="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mx-3 text-muted">
            <div class="col-1 text-center"><small>NO</small></div>
            <div class="col-2 text-uppercase"><small>ID</small></div>
            <div class="col text-capitalize"><small>FULL NAME</small></div>
            <div class="col-4 text-capitalize"><small>LOCATION</small></div>
            <div class="col-1 text-capitalize"></div>
        </div>
        <?php
        $i = 0;
        if (is_array($user) && !empty($user)) {
            foreach ($user as $row) {
        ?>
                <div class="row mx-3 mb-1 py-2 shadow-sm bg-white border">
                    <div class="col-1 text-center m-auto"><?php echo ++$i; ?></div>
                    <div class="col-2 m-auto"> <?php echo 'CD-' . encrypt_it($row['cd_id']); ?></div>
                    <div class="col text-capitalize m-auto"> <?php echo $row['cd_full_name']; ?></div>
                    <div class="col-4 text-capitalize m-auto"> <?php echo $row['cd_city'] . ', ' . $row['cd_state']; ?></div>
                    <div class="col-1 float-right m-auto"><a href="<?php echo base_url() . 'staff/manage/view/' . encrypt_it($row['cd_id']); ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a></div>
                </div>
        <?php
            }
        } else {
            echo '<div class="row mx-3 mb-1 py-2">';
            echo '<div class="col"><p>No registered user in the system.</p></div>';
            echo '</div>';
        }
        ?>
    </div>
</div>