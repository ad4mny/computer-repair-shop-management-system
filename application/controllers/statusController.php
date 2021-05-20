<?php
class StatusController extends CI_Controller
{
    public function index()
    {
        auth_session();
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('status');
        $this->load->view('templates/footer');
    }

}
