<div class="wrapper">
    <div class="container p-5  d-flex h-100 flex-column" id="content">
        <?php if (is_array($paypal) && !empty($paypal)) { ?>
            <div class="row m-auto">
                <div class="col text-center">
                    <h1 class="display-4 text-success"><i class="fas fa-check-circle"></i> Payment Successful!</h1>
                    <div class="rounded bg-white shadow  p-4 my-3">
                        <small>Transaction ID</small>
                        <p class="font-weight-light mb-0"><?php echo $paypal[0]['txn_id']; ?> </p>
                        <small>Paid Amount</small>
                        <p class="font-weight-light mb-0"><?php echo 'RM ' . $paypal[0]['payment_gross']; ?> </p>
                        <small>Service ID</small>
                        <p class="font-weight-light mb-0"><?php echo encrypt_it($paypal[0]['item_number']); ?></p>
                        <small>Device Name</small>
                        <p class="font-weight-light mb-0"><?php echo $paypal[0]['item_name']; ?> </p>
                    </div>
                    <a href="<?php echo base_url(); ?>/dashboard" class="text-primary mt-5"><i class="fas fa-chevron-left"></i> Back to dashboard</a>
                </div>
            </div>
        <?php } else {
            header("Location: " . base_url() . 'dashboard');
        } ?>
    </div>
</div>