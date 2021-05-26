<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('auth_session')) {
    function auth_session()
    {
        $CI = get_instance();
        $CI->load->library('session');

        if (!$CI->session->has_userdata('userid')) {
            redirect(base_url());
            exit();
        }
    }
}

if (!function_exists('encrypt_it')) {
    function encrypt_it($key)
    {
        $data = base64_encode(base64_encode($key));
        return str_replace(['+', '/', '='], ['-', '_', ''], $data);
    }
}

if (!function_exists('decrypt_it')) {
    function decrypt_it($key)
    {
        $data = str_replace(['+', '/', '='], ['-', '_', ''], $key);
        return base64_decode(base64_decode($data));
    }
}
