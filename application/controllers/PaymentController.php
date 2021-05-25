<?php
class PaymentController extends CI_Controller
{
    private $pickup_time;
    private $pickup_date;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Paypal');
        $this->load->model('PaymentModel');
        $this->load->model('StatusModel');
    }

    public function index($page = 'payment', $data = array())
    {
        auth_session();
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        if ($page === 'success') {
            $this->load->view('payment/success', $data);
        } else if ($page === 'cancel') {
            $this->load->view('payment/cancel');
        } else {
            $this->load->view('payment/return', $data);
        }
        $this->load->view('templates/footer');
    }

    public function pay($request_id)
    {
        $customer_id = decrypt_it($this->session->userdata('customerid'));
        $this->pickup_date = $this->input->post('pickup_date');
        $this->pickup_time = $this->input->post('pickup_time');

        $request = $this->statusModel->get_ongoing_request_by_id_model($request_id);
        $service_name = ucfirst($request[0]['rsd_device_brand']) . ' ' . ucfirst($request[0]['rsd_device_model']);
        $service_id = encrypt_it($request[0]['rsd_id']);
        $service_price = $request[0]['rsd_repair_cost'] + ((6 / 100) * $request[0]['rsd_repair_cost']) + 50;

        // Add fields to paypal form 
        $this->paypal->add_field('return', base_url() . 'paymentController/get_pay_ipn');
        $this->paypal->add_field('cancel_return', base_url() . 'paymentController/get_pay_cancel');
        $this->paypal->add_field('notify_url', base_url() . 'paymentController/get_pay_ipn');
        $this->paypal->add_field('item_name', $service_name);
        $this->paypal->add_field('custom', $customer_id);
        $this->paypal->add_field('item_number', $service_id);
        $this->paypal->add_field('amount', $service_price);

        // Render paypal form 
        $this->paypal->paypal_auto_form();
    }

    public function get_pay_success()
    {
        // Get the transaction data 
        $paypal_return = $this->input->get();

        if (!empty($paypal_return['item_number']) && !empty($paypal_return['tx']) && !empty($paypal_return['amt']) && !empty($paypal_return['cc']) && !empty($paypal_return['st'])) {
            $item_name = $paypal_return['item_name'];
            $item_number = $paypal_return['item_number'];
            $txn_id = $paypal_return["tx"];
            $payment_amt = $paypal_return["amt"];
            $currency_code = $paypal_return["cc"];
            $status = $paypal_return["st"];

            // Get product info from the database 
            $request = $this->statusModel->get_ongoing_request_by_id_model($item_number);

            // Check if transaction data exists with the same TXN ID 
            $txn_result = $this->paymentModel->get_existing_txn_model(array('txn_id' => $txn_id));
        }

        // Pass the transaction data to view 
        $data['request'] = $request;
        $data['payment'] = $txn_result;
        $this->index('return',$data);
    }

    public function get_pay_cancel()
    {
        $this->index('cancel');
    }

    public function get_pay_ipn()
    {
        // Retrieve transaction data from PayPal IPN POST 
        $paypal_return = $this->input->post();

        if (!empty($paypal_return)) {
            // Validate and get the ipn response 
            $ipn_check = $this->paypal->validate_ipn($paypal_return);

            // Check whether the transaction is valid 
            if ($ipn_check) {
                // Check whether the transaction data is exists 
                $existing_payment = $this->paymentModel->get_existing_txn_model(array('txn_id' => $paypal_return["txn_id"]));

                if (!$existing_payment) {
                    // Insert the transaction data in the database 
                    $this->paymentModel->add_transaction_model($paypal_return);
                    $this->paymentModel->add_tracking_model($this->pickup_date, $this->pickup_time, $paypal_return["item_number"]);
                    $this->paymentModel->set_request_ongoing_model($paypal_return["item_number"]);
                }
            }
        }
        $data['paypal'] = $paypal_return;
        $this->index('success', $data);

    }
}
