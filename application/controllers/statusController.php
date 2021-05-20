<?php
class StatusController extends CI_Controller
{
    public function index()
    {
        auth_session();
        $data['controller'] = $this; 
        $data['request'] = $this->get_ongoing_request();
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('status', $data);
        $this->load->view('templates/footer');
    }

    public function get_ongoing_request()
    {
        $customer_id = $this->session->userdata('customerid');
        $this->load->model('statusModel');
        return $this->statusModel->get_ongoing_request_model($customer_id);
    }

    public function get_technician_info($staff_id)
    {
        $this->load->model('dashboardModel');
        return $this->dashboardModel->get_technician_info_model($staff_id);
    }

}
