<?php
class DashboardController extends CI_Controller
{
    public function index()
    {
        auth_session();
        $data['request'] = $this->get_booking_request();
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function get_booking_request() 
    {
        $this->load->model('dashboardModel');
        return $this->dashboardModel->get_booking_request_model($this->session->userdata('customerid'));

    }

}
