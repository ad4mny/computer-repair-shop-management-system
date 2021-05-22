<?php

class PaymentController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('paypal_lib');
        $this->load->model('product');
    }

    function success() {
        //get the transaction data
        $paypalInfo = $this->input->get();

        $data['item_number'] = $paypalInfo['item_number'];
        $data['txn_id'] = $paypalInfo["tx"];
        $data['payment_amt'] = $paypalInfo["amt"];
        $data['currency_code'] = $paypalInfo["cc"];
        $data['status'] = $paypalInfo["st"];

        //pass the transaction data to view
        $this->load->view('payment/success', $data);
    }

    function cancel() {
        $this->load->view('payment/success');
    }

    function ipn() {
        //paypal return transaction details array
        $paypalInfo = $this->input->post();

        $data['user_id'] = $paypalInfo['custom'];
        $data['product_id'] = $paypalInfo["item_number"];
        $data['txn_id'] = $paypalInfo["txn_id"];
        $data['payment_gross'] = $paypalInfo["payment_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['payer_email'] = $paypalInfo["payer_email"];
        $data['payment_status'] = $paypalInfo["payment_status"];

        $paypalURL = $this->paypal_lib->paypal_url;
        $result = $this->paypal_lib->curlPost($paypalURL, $paypalInfo);

        //check whether the payment is verified
        if (preg_match("/VERIFIED/i", $result)) {
            //insert the transaction data into the database
            $this->product->insertTransaction($data);
        }
    }

}
