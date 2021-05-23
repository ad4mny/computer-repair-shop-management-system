<?php
class StatusController extends CI_Controller
{
    public function index($repair_id = null)
    {
        auth_session();
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->model('profileModel');
        $data['profile'] = $this->profileModel->get_profile_info_model($this->session->userdata('userid'));
        $data['controller'] = $this;
        $data['services'] = $this->get_all_request_id();

        if ($repair_id !== null) {
            $data['request'] = $this->get_ongoing_request_by_id($repair_id);
            $data['request'] = $this->get_ongoing_request_by_id($repair_id);
            $this->load->view('status', $data);
        } else {
            $data['request'] = $this->get_latest_ongoing_request();
            $this->load->view('status', $data);
        }

        $this->load->view('templates/footer');
    }

    public function get_ongoing_request_by_id($repair_id)
    {
        $this->load->model('statusModel');
        return $this->statusModel->get_ongoing_request_by_id_model($repair_id);
    }


    public function get_latest_ongoing_request()
    {
        $customer_id = $this->session->userdata('customerid');
        $this->load->model('statusModel');
        return $this->statusModel->get_latest_ongoing_request_model($customer_id);
    }

    public function get_all_request_id()
    {
        $customer_id = $this->session->userdata('customerid');
        $this->load->model('statusModel');
        return $this->statusModel->get_all_request_id_model($customer_id);
    }

    public function get_technician_info($staff_id)
    {
        $this->load->model('dashboardModel');
        return $this->dashboardModel->get_technician_info_model($staff_id);
    }
}
