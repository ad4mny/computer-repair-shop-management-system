<div class="wrapper">
    <div class="container p-5" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary">Manage My Account</h3><br>
            </div>
        </div>
        <form method="post" action="<?php echo base_url(); ?>profile/set_profile_update">
            <?php
            if (is_array($profile)) {
                foreach ($profile as $row) {
            ?>
                    <div class="row p-3">
                        <div class="col-3 text-center">
                            <div class="rounded-circle bg-white d-inline-flex p-5 align-middle shadow mb-4"><i class="fas fa-user fa-4x text-secondary"></i>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm" name="submit">UPDATE PROFILE</button>
                        </div>
                        <div class="col-5 border-start ps-5">
                            <div class="row  border-bottom pt-2">
                                <div class="col">
                                    <small>Full Name</small>
                                    <input type="text" class="form-control" name="full_name" value="<?php echo $row['cd_full_name']; ?>" required>
                                </div>
                            </div>
                            <div class="row  border-bottom pt-2">
                                <div class="col">
                                    <small>Contact Number</small>
                                    <input type="number" class="form-control" name="contact_number" value="<?php echo $row['cd_phone']; ?>" required>
                                </div>
                            </div>
                            <div class="row  border-bottom pt-2">
                                <div class="col">
                                    <small>Street Address 1</small>
                                    <input type="text" class="form-control" name="street_1" value="<?php echo $row['cd_street_1']; ?>" required>
                                </div>
                            </div>
                            <div class="row  border-bottom pt-2">
                                <div class="col">
                                    <small>Street Address 2</small>
                                    <input type="text" class="form-control" name="street_2" value="<?php echo $row['cd_street_2']; ?>" required>
                                </div>
                            </div>
                            <div class="row  border-bottom pt-2">
                                <div class="col">
                                    <small>Postcode</small>
                                    <input type="number" class="form-control" name="postcode" value="<?php echo $row['cd_postcode']; ?>" required>
                                </div>
                            </div>
                            <div class="row  border-bottom pt-2">
                                <div class="col">
                                    <small>City</small>
                                    <input type="text" class="form-control" name="city" value="<?php echo $row['cd_city']; ?>" required>
                                </div>
                                <div class="col">
                                    <small>State</small>
                                    <input type="text" class="form-control" name="state" value="<?php echo $row['cd_state']; ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php
                }
            }
            ?>
        </form>
    </div>
</div>