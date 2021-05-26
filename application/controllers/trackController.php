<?php
class TrackController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('TrackModel');
    }

    public function index($repair_id = null)
    {
        auth_session();
        $data['controller'] = $this;
        $data['css'] = '<link rel="stylesheet" href="' . base_url() . 'assets/css/track.css">';
        $data['tracking'] = $this->get_all_tracking_id();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navigation');

        if ($repair_id !== null) {
            $data['track'] = $this->get_tracking_request_by_id($repair_id);
            $this->load->view('track', $data);
        } else {
            $data['track'] = $this->get_latest_tracking_request();
            $this->load->view('track', $data);
        }

        $this->load->view('templates/footer');
    }

    public function get_all_tracking_id()
    {
        $customer_id = $this->session->userdata('customerid');
        return $this->TrackModel->get_all_tracking_id_model($customer_id);
    } 
    
    public function get_tracking_request_by_id($repair_id)
    {
        return $this->TrackModel->get_tracking_request_by_id_model($repair_id);
    }

    public function get_latest_tracking_request()
    {
        $customer_id = $this->session->userdata('customerid');
        return $this->TrackModel->get_latest_tracking_request_model($customer_id);
    }

    public function get_runner_info($runner_id)
    {
        return $this->TrackModel->get_runner_info_model($runner_id);
    }
}
