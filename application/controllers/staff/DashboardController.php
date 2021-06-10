<?php
class DashboardController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        auth_session();
        $this->load->model('staff/DashboardModel');
        $this->load->model('TrackingModel');
    }

    public function index($page = 'dashboard', $repair_id = null)
    {
        $data['controller'] = $this;
        $this->load->view('templates/header');
        $this->load->view('templates/navigation_staff');

        if ($page === 'dashboard' && $repair_id === null) {
            $data['request'] = $this->get_booking_request();
            $this->load->view('staff/dashboard/DashboardInterface', $data);
        } else {
            $data['request'] = $this->get_booking_request_by_id($repair_id);
            $this->load->view('staff/dashboard/ViewRequestInterface', $data);
        }

        $this->load->view('templates/footer');
    }

    public function get_booking_request()
    {
        return $this->DashboardModel->get_booking_request_model();
    }

    public function get_booking_request_by_id($repair_id)
    {
        return $this->DashboardModel->get_booking_request_by_id_model($repair_id);
    }

    public function get_technician_info($staff_id)
    {
        return $this->DashboardModel->get_technician_info_model($staff_id);
    }

    public function take_repair_request($request_id)
    {
        $staff_id = $this->session->userdata('staffid');
        $brand = $this->input->post('brand');
        $model = $this->input->post('model');
        $color = $this->input->post('color');
        $severity = $this->input->post('severity');
        $information = $this->input->post('information');
        $status = $this->input->post('status');
        $price = $this->input->post('price');

        if ($price == "") {
            $price = 0;
        }

        if ($status == 0) {
            $reason = $this->input->post('reason');
        } else {
            $reason = 'Waiting customer confirmation';
        }

        if ($this->DashboardModel->take_repair_request_model($request_id, $staff_id, $brand, $model, $color, $severity, $information, $status, $reason, $price) !== false) {
            $this->TrackingModel->add_tracking_model($request_id, 'Completed');
            redirect(base_url() . 'staff/dashboard');
        } else {
            $this->session->set_flashdata('error', 'unable to complete request');
            redirect(base_url() . 'staff/dashboard');
        }
    }

    public function delete_request($request_id)
    {
        if ($this->DashboardModel->delete_request_model($request_id) === true) {
            redirect(base_url() . 'staff/dashboard');
        } else {
            $this->session->set_flashdata('error', 'Unable to process request.');
            redirect(base_url() . 'staff/dashboard');
        }
    }
}
