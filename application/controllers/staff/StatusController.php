<?php
class StatusController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('staff/StatusModel');
        $this->load->model('staff/DashboardModel');
    }

    public function index($page = 'status', $repair_id = null)
    {
        auth_session();
        $this->load->view('templates/header');
        $this->load->view('templates/navigation_staff');
        $data['controller'] = $this;
        if ($page === 'status' && $repair_id === null) {
            $data['request'] = $this->get_all_accepted_request();
            $this->load->view('staff/status/StatusInterface', $data);
        } else {
            $data['request'] = $this->get_booking_request_by_id($repair_id);
            $this->load->view('staff/status/ViewStatusInterface', $data);
        }

        $this->load->view('templates/footer');
    }

    public function get_all_accepted_request()
    {
        $staff_id = $this->session->userdata('staffid');
        return $this->StatusModel->get_all_accepted_request_model($staff_id);
    }

    public function get_booking_request_by_id($repair_id)
    {
        return $this->DashboardModel->get_booking_request_by_id_model($repair_id);
    }

    public function get_technician_info($staff_id)
    {
        return $this->DashboardModel->get_technician_info_model($staff_id);
    }

    public function update_repair_request($request_id)
    {
        if ($this->StatusModel->update_repair_request_model($request_id, 2) !== false) {
            redirect(base_url() . 'staff/status');
        } else {
            $this->session->set_flashdata('error', 'unable to complete request');
            redirect(base_url() . 'staff/status');
        }
    }

}
