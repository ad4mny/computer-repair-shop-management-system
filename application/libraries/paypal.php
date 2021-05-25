<?php

class Paypal
{
	var $paypal_url;            // holds the last error encountered 
	var $last_error;            // holds the last error encountered 
	var $ipn_log;                // bool: log IPN results to text file? 

	var $ipn_log_file;            // filename of the IPN log 
	var $ipn_response;            // holds the IPN response from paypal     
	var $ipn_data = array();    // array contains the POST values for IPN 
	var $fields = array();        // array holds the fields to submit to paypal 

	var $CI;

	function __construct()
	{
		$this->CI = &get_instance();
		$this->CI->load->helper('url');
		$this->CI->load->helper('form');

		$sanbox = $this->CI->config->item('sandbox');
		$this->paypal_url = ($sanbox == TRUE) ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

		$this->last_error = '';
		$this->ipn_response = '';

		$this->ipn_log_file = $this->CI->config->item('paypal_lib_ipn_log_file');
		$this->ipn_log = $this->CI->config->item('paypal_lib_ipn_log');

		$this->add_field('business', $this->CI->config->item('business'));
		$this->add_field('rm', '2');  
		$this->add_field('cmd', '_xclick');
		$this->add_field('currency_code', $this->CI->config->item('paypal_lib_currency_code'));
		$this->add_field('quantity', '1');
	}

	function add_field($field, $value)
	{
		$this->fields[$field] = $value;
	}

	function paypal_auto_form()
	{
		echo '<html>' . "\n";
		echo '<head><title>Processing Payment...</title></head>' . "\n";
		echo '<body style="text-align:center;" onLoad="document.forms["paypal_auto_form"].submit();">' . "\n";
		echo '<p style="text-align:center;">Please wait, your order is being processed and you will be redirected to the PayPal website.</p>' . "\n";
		echo $this->paypal_form('paypal_auto_form');
		echo '</body></html>';
	}

	function paypal_form($form_name = 'paypal_form')
	{
		$str = '';
		$str .= '<form method="post" action="' . $this->paypal_url . '" name="' . $form_name . '"/>' . "\n";
		foreach ($this->fields as $name => $value)
			$str .= form_hidden($name, $value) . "\n";
		$str .= '<p><input type="submit" name="submit" value="Pay now!"></p>';
		$str .= form_close() . "\n";
		return $str;
	}

	function validate_ipn($paypalReturn)
	{
		$ipn_response = $this->curlPost($this->paypal_url, $paypalReturn);

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
		$fp = fopen($this->ipn_log_file, 'a');
		fwrite($fp, $text . "\n\n");

		fclose($fp);  // close file 
	}


	function curlPost($paypal_url, $paypal_return_arr)
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
