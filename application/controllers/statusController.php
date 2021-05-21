<?php
class StatusController extends CI_Controller
{
    public function index($page = 'status', $repair_id = null)
    {
        auth_session();
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $data['controller'] = $this;

        if ($page === 'status') {
            $data['request'] = $this->get_ongoing_request();
            $this->load->view('status', $data);
        } else {
            $data['request'] = $this->view_request($repair_id);
            $this->load->view('view_status', $data);
        }

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

    public function view_request($repair_id)
    {
        $this->load->model('statusModel');
        return $this->statusModel->view_request_model($repair_id);
    }
}
