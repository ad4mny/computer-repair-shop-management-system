<?php
class TrackController extends CI_Controller
{
    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('track');
        $this->load->view('templates/footer');
    }

}
