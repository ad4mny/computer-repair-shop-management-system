<?php
class RequestController extends CI_Controller
{
    public function index()
    {
        auth_session();
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('request');
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

        $this->load->model('requestModel');

        if ($this->requestModel->add_new_request_model($customer_id, $brand, $model, $color, $severity, $information) !== false) {
            redirect(base_url() . 'dashboard');
        } else {
            $this->session->set_flashdata('error', 'unable to complete request');
            redirect(base_url() . 'request');
        }
    }
}
