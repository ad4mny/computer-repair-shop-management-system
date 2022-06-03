<?php
class StatusController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        auth_session();

        $this->load->model('ProfileModel');
        $this->load->model('StatusModel');
        $this->load->model('DashboardModel');
    }

    public function index($repair_id = null, $page = null)
    {
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $data['profile'] = $this->ProfileModel->get_profile_info_model($this->session->userdata('userid'));
        $data['controller'] = $this;

        if ($repair_id !== null && $page !== null) {
            $data['request'] = $this->get_ongoing_request_by_id($repair_id);
            $this->load->view('status/StatusUpdateInterface', $data);
        } else if ($repair_id !== null) {
            $data['request'] = $this->get_ongoing_request_by_id($repair_id);
            $this->load->view('status/StatusInterface', $data);
        } else {
            $data['request'] = $this->get_latest_ongoing_request();
            $this->load->view('status/StatusInterface', $data);
        }

        $this->load->view('templates/footer');
    }

    public function get_ongoing_request_by_id($repair_id)
    {
        return $this->StatusModel->get_ongoing_request_by_id_model($repair_id);
    }

    public function get_latest_ongoing_request()
    {
        $customer_id = $this->session->userdata('customerid');
        return $this->StatusModel->get_latest_ongoing_request_model($customer_id);
    }

    public function get_all_request_id()
    {
        $customer_id = $this->session->userdata('customerid');
        return $this->StatusModel->get_all_request_id_model($customer_id);
    }

    public function get_technician_info($staff_id)
    {
        return $this->DashboardModel->get_technician_info_model($staff_id);
    }
}
