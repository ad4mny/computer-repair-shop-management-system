<div class="container d-flex h-100 flex-column">
    <!-- Login form -->
    <div class="row m-auto">
        <div class="col col-xs-12 m-auto ">
            <h1 class="display-2 fw-bold ">Derc's Computer Repair Shop</h1>
            <h4 class="">One stop center for your devices checkup and repair quotation.</h4>
        </div>
        <div class="col-4 col-xs-12">
            <form method="post" action="<?php echo base_url()?>login_auth">
                <div class=" p-4 py-5 shadow-lg rounded-3 bg-white border">
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" name="usr" placeholder="Username" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" name="pwd" placeholder="Password" required>
                    </div>
                    <div class="form-group text-center d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-block" name="submit"><i class="fas fa-sign-in-alt"></i> Log In</button>
                    </div>
                    <div class="form-group mb-3">
                        <span class="text-danger"><?php echo $this->session->flashdata("error")?></span>
                    </div>
                </div>
                <div class="border-top text-center pt-5">
                    <a href="<?php echo base_url()?>sign_up" class="btn btn-outline-success btn-block">Create New Account</a>
                </div>
            </form>

        </div>
    </div>
</div>

</div>