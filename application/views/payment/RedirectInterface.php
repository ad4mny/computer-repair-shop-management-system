<div class="wrapper">
    <div class="container-fluid d-flex h-100 flex-column" id="content">
        <?php if (!empty($paypal_url) && !empty($paypal_field)) { ?>
            <div class="row m-auto">
                <div class="col text-center">
                    <div class="d-inline-flex">
                        <img src='<?php echo base_url() ?>assets/img/load.gif' width='35px' height='35px' alt="No image">
                        <h4 class="my-0 m-auto ">Redirecting..</h4>
                    </div>
                    <p>Please wait, your payment is being processed and you will be redirected to the PayPal website.</p>
                    <form method="post" action="<?php echo $paypal_url; ?>" name="paypal_form" id="paypal_form">
                        <?php
                        foreach ($paypal_field as $name => $value) {
                            echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
                        }
                        ?>
                        <small class="text-muted">Click <button type="submit" class="btn text-primary p-0 m-0">here</button> if the browser does not refresh.</small>
                    </form>
                </div>
            </div>
        <?php } else {
            header("Location: " . base_url() . 'dashboard');
        } ?>
    </div>
</div>
<script>
    window.onload = function() {
        document.forms['paypal_form'].submit();
    }
</script>