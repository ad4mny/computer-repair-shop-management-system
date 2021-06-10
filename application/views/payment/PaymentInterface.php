<div class="wrapper">
    <div class="container p-5  d-flex h-100 flex-column" id="content">
        <?php if (!empty($flag) && $flag == true) {
            if (isset($paypal) && is_array($paypal) && !empty($paypal)) { ?>
                <div class="row m-auto">
                    <div class="col text-center">
                        <h1 class="display-4 text-success"><i class="fas fa-check-circle"></i> Payment Successful!</h1>
                        <div class="  p-4 my-3">
                            <small>Transaction ID</small>
                            <p class="font-weight-light mb-0"><?php echo $paypal['txn_id']; ?> </p>
                            <small>Paid Amount</small>
                            <p class="font-weight-light mb-0"><?php echo 'RM ' . $paypal['payment_gross']; ?> </p>
                            <small>Service ID</small>
                            <p class="font-weight-light mb-0"><?php echo $paypal['item_number']; ?></p>
                            <small>Device Name</small>
                            <p class="font-weight-light mb-0"><?php echo $paypal['item_name']; ?> </p>
                        </div>
                        <a href="<?php echo base_url(); ?>dashboard" class="text-primary mt-5"><i class="fas fa-chevron-left"></i> Back to dashboard</a>
                    </div>
                </div>
            <?php } else { ?>
                <div class="row m-auto">
                    <div class="col text-center">
                        <h1 class="display-4 text-danger"><i class="fas fa-times-circle"></i> Payment Failed!</h1>
                        <p class="font-weight-light"><?php  if (isset($msg)) echo $msg; ?></p>
                        <a href="<?php echo base_url(); ?>dashboard" class="text-primary mt-5"><i class="fas fa-chevron-left"></i> Back to dashboard</a>
                    </div>
                </div>
        <?php }
        } else {
            redirect(base_url() . 'dashboard');
        } ?>
    </div>
</div>