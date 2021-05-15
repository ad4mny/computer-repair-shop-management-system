<?php
class DashboardController extends CI_Controller
{
    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('dashboard');
        $this->load->view('templates/footer');
    }

}
