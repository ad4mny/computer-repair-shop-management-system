<?php
class DashboardController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DashboardModel');
    }
    
    public function index()
    {
        auth_session();
        $data['controller'] = $this; 
        $data['request'] = $this->get_booking_request();
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('DashboardInterface', $data);
        $this->load->view('templates/footer');
    }

    public function get_booking_request()
    {
        $customer_id = $this->session->userdata('customerid');
        return $this->DashboardModel->get_booking_request_model($customer_id);
    }

    public function get_technician_info($staff_id)
    {
        return $this->DashboardModel->get_technician_info_model($staff_id);
    }

    public function delete_request($request_id)
    {
        if($this->DashboardModel->delete_request_model($request_id) === true) {
            redirect(base_url() . 'dashboard');
        } else {
            $this->session->set_flashdata('error', 'Unable to process request.');
            redirect(base_url() . 'dashboard');
        }
    }
}
