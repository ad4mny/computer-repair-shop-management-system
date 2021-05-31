<?php
class PaymentController extends CI_Controller
{
    var $paypal_url;
    var $last_error;
    var $ipn_log;

    var $ipn_log_file;
    var $ipn_response;
    var $ipn_data = array();
    var $fields = array();

    public function __construct()
    {
        parent::__construct();
        auth_session();

        $this->load->model('PaymentModel');
        $this->load->model('StatusModel');
        $this->load->model('ProfileModel');

        $sandbox = TRUE;
        $this->paypal_url = ($sandbox == TRUE) ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

        $this->last_error = '';
        $this->ipn_response = '';

        $this->ipn_log_file = base_url() . 'log/';
        $this->ipn_log = TRUE;

        $this->paypal_field('business', 'developer@susundev.com');
        $this->paypal_field('rm', '2');
        $this->paypal_field('cmd', '_xclick');
        $this->paypal_field('currency_code', 'MYR');
    }

    public function index($page = 'payment', $data = array())
    {
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $data['flag'] = true;
        if ($page === 'success') {
            $this->load->view('payment/PaymentInterface', $data);
        } else {
            $this->load->view('payment/PaymentInterface', $data);
        }
        $this->load->view('templates/footer');
    }

    public function pay($request_id)
    {
        // Get post detail
        $user_id = $this->session->userdata('userid');
        $this->session->set_userdata('pickup_date', $this->input->post('pickup_date'));
        $this->session->set_userdata('pickup_time', $this->input->post('pickup_time'));

        // Get customer detail
        $customer = $this->ProfileModel->get_profile_info_model($user_id);
        $customer_id = encrypt_it($customer[0]['cd_id']);
        $customer_full_name = explode(' ',  $customer[0]['cd_full_name']);
        $name_length = sizeof($customer_full_name);
        $customer_first_name = $customer_full_name[0];
        $customer_last_name = $customer_full_name[$name_length - 1];

        // Get service detail
        $service = $this->StatusModel->get_ongoing_request_by_id_model($request_id);
        $service_name = ucfirst($service[0]['rsd_device_brand']) . ' ' . ucfirst($service[0]['rsd_device_model']);
        $service_id = encrypt_it($service[0]['rsd_id']);
        $service_price = $service[0]['rsd_repair_cost'] + ((6 / 100) * $service[0]['rsd_repair_cost']) + 20;

        // Add fields to paypal form 
        $this->paypal_field('return', base_url() . 'paymentController/get_pay_ipn');
        $this->paypal_field('cancel_return', base_url() . 'paymentController/get_pay_cancel');
        $this->paypal_field('notify_url', base_url() . 'paymentController/get_pay_ipn');
        $this->paypal_field('item_name', $service_name);
        $this->paypal_field('item_number', $service_id);
        $this->paypal_field('amount', $service_price);
        $this->paypal_field('custom', $customer_id);
        $this->paypal_field('first_name', $customer_first_name);
        $this->paypal_field('last_name', $customer_last_name);
        $this->paypal_field('no_shipping', 1);

        // Render paypal form 
        $this->paypal_redirect();
    }

    public function get_pay_cancel()
    {
        $this->index('cancel');
    }

    public function get_pay_ipn()
    {
        // Retrieve transaction data from PayPal IPN POST 
        $paypal = $this->input->post();
        
        if (!empty($paypal)) {
            // Validate and get the ipn response 
            $ipn_check = $this->validate_ipn($paypal);
            // Check whether the transaction is valid 
            if ($ipn_check) {
                // Check whether the transaction data is exists 
                if ($this->PaymentModel->get_existing_payment_model($paypal["item_number"]) === 0) {
                    // Insert the transaction data in the database 
                    $this->PaymentModel->add_transaction_model($paypal);
                    $this->PaymentModel->add_tracking_model($paypal["item_number"]);
                    $this->PaymentModel->set_request_ongoing_model($paypal["item_number"]);
                    $data['paypal'] = $paypal;
                    $this->index('success', $data);
                } else {
                    $this->get_pay_cancel();
                }
            } else {
                $this->get_pay_cancel();
            }
        } else {
            $this->get_pay_cancel();
        }
    }

    function paypal_field($field, $value)
    {
        $this->fields[$field] = $value;
    }

    function paypal_redirect()
    {
        $data['paypal_url'] = $this->paypal_url;
        $data['paypal_field'] = $this->fields;

        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('payment/RedirectInterface', $data);
        $this->load->view('templates/footer');
    }

    function validate_ipn($paypal_return)
    {
        $ipn_response = $this->curl_post($this->paypal_url, $paypal_return);

        if (preg_match("/VERIFIED/i", $ipn_response)) {
            // Valid IPN transaction. 
            return true;
        } else {
            // Invalid IPN transaction.  Check the log for details. 
            $this->last_error = 'IPN Validation Failed.';
            $this->log_ipn_results(false);
            return false;
        }
    }

    function log_ipn_results($success)
    {
        if (!$this->ipn_log) return;  // is logging turned off? 

        // Timestamp 
        $text = '[' . date('m/d/Y g:i A') . '] - ';

        // Success or failure being logged? 
        if ($success) $text .= "SUCCESS!\n";
        else $text .= 'FAIL: ' . $this->last_error . "\n";

        // Log the POST variables 
        $text .= "IPN POST Vars from Paypal:\n";
        foreach ($this->ipn_data as $key => $value)
            $text .= "$key=$value, ";

        // Log the response from the paypal server 
        $text .= "\nIPN Response from Paypal Server:\n " . $this->ipn_response;

        // Write to log 
        $fp = fopen($this->ipn_log_file, date('H:m:s d/m/y'));
        fwrite($fp, $text . "\n\n");
        fclose($fp);
    }


    function curl_post($paypal_url, $paypal_return_arr)
    {
        $req = 'cmd=_notify-validate';
        foreach ($paypal_return_arr as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }

        $ipn_site_url = $paypal_url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ipn_site_url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
