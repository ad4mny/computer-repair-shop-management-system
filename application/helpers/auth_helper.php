<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('auth_session')) {
    function auth_session()
    {
        $CI = get_instance();
        $CI->load->library('session');

        if (!$CI->session->has_userdata('userid')) {
            redirect(base_url() . 'login');
            exit();
        }
    }
}

if (!function_exists('encrypt_it')) {
    function encrypt_it($q)
    {
        $key = 'HqE0luoquf';
        return base64_encode(base64_encode($key . $q));
    }
}

if (!function_exists('decrypt_it')) {
    function decrypt_it($q)
    {
        $key = 'HqE0luoquf';
        $decoded_key =  base64_decode(base64_decode($q));
        return str_replace($key, "", $decoded_key);
    }
}
