<?php
class RequestController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        auth_session();

        $this->load->model('RequestModel');
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('RepairRequestInterface');
        $this->load->view('templates/footer');
    }

    public function add_new_request()
    {
        $customer_id = $this->session->userdata('customerid');
        $brand = $this->input->post('brand');
        $model = $this->input->post('model');
        $color = $this->input->post('color');
        $severity = $this->input->post('severity');
        $information = $this->input->post('information');

        if ($this->RequestModel->add_new_request_model($customer_id, $brand, $model, $color, $severity, $information) !== false) {
            redirect(base_url() . 'dashboard');
        } else {
            $this->session->set_flashdata('error', 'unable to complete request');
            redirect(base_url() . 'request');
        }
    }

    public function update_request_by_id($request_id)
    {
        $customer_id = $this->session->userdata('customerid');
        $brand = $this->input->post('brand');
        $model = $this->input->post('model');
        $color = $this->input->post('color');
        $severity = $this->input->post('severity');
        $information = $this->input->post('information');

        if ($this->RequestModel->update_request_by_id_model($request_id, $brand, $model, $color, $severity, $information) !== false) {
            redirect(base_url() . 'status/' . $request_id);
        } else {
            $this->session->set_flashdata('error', 'unable to complete request');
            redirect(base_url() . 'status/' . $request_id . '/update');
        }
    }
}
