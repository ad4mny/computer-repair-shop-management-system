<?php
class DeliveryController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('runner/DeliveryModel');
    }

    public function index()
    {
        auth_session();
        $data['delivery'] = $this->get_accepted_delivery();
        $this->load->view('templates/header');
        $this->load->view('templates/navigation_runner');
        $this->load->view('runner/delivery/DeliveryInterface', $data);
        $this->load->view('templates/footer');
    }

    public function get_accepted_delivery()
    {
        $runner_id = $this->session->userdata('runnerid');
        return $this->DeliveryModel->get_accepted_delivery_model($runner_id);
    }

    public function cancel_delivery_request($request_id,)
    {
        $runner_id = $this->session->userdata('runnerid');
        if ($this->DeliveryModel->cancel_delivery_request_model($request_id, $runner_id) === true) {
            redirect(base_url() . 'runner/delivery');
        } else {
            $this->session->set_flashdata('error', 'Unable to process request.');
            redirect(base_url() . 'runner/delivery');
        }
    }

    public function complete_delivery_request($request_id)
    {
        $runner_id = $this->session->userdata('runnerid');
        if ($this->DeliveryModel->complete_delivery_request_model($request_id, $runner_id) === true) {
            redirect(base_url() . 'runner/delivery');
        } else {
            $this->session->set_flashdata('error', 'Unable to process request.');
            redirect(base_url() . 'runner/delivery');
        }
    }
}
