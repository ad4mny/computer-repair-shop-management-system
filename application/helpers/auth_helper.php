<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('auth_session'))
{
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


