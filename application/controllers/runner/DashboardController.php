<?php
class DashboardController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        auth_session();
        $this->load->model('runner/DashboardModel');
    }

    public function index($page = 'dashboard', $repair_id = null)
    {
        $data['delivery'] = $this->get_available_delivery();
        $data['pickup'] = $this->get_available_pickup();
        $this->load->view('templates/header');
        $this->load->view('templates/navigation_runner');
        $this->load->view('runner/dashboard/DashboardInterface', $data);
        $this->load->view('templates/footer');
    }

    public function get_available_delivery()
    {
        return $this->DashboardModel->get_available_delivery_model();
    } 
    
    public function get_available_pickup()
    {
        return $this->DashboardModel->get_available_pickup_model();
    }

    public function take_delivery_request($request_id)
    {
        $runner_id = $this->session->userdata('runnerid');
        if ($this->DashboardModel->take_delivery_request_model($request_id, $runner_id) !== false) {
            redirect(base_url() . 'runner/dashboard');
        } else {
            $this->session->set_tempdata('error', 'Unable to complete request', 3);
            redirect(base_url() . 'runner/dashboard');
        }
    }

    public function take_pickup_request($request_id)
    {
        $runner_id = $this->session->userdata('runnerid');
        if ($this->DashboardModel->take_pickup_request_model($request_id, $runner_id) !== false) {
            redirect(base_url() . 'runner/dashboard');
        } else {
            $this->session->set_tempdata('error', 'Unable to complete request', 3);
            redirect(base_url() . 'runner/dashboard');
        }
    }


}
