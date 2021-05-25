<?php
class TrackController extends CI_Controller
{
    public function index()
    {
        auth_session();
        $data['css'] = '<link rel="stylesheet" href="' . base_url() . 'assets/css/track.css">';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navigation');
        $this->load->view('track');
        $this->load->view('templates/footer');
    }
}
