<?php
class LoginController extends CI_Controller
{
    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('login');
        $this->load->view('templates/footer');
    }

    public function login_auth()
    {
        $usr = $this->input->post('usr');
        $pwd = md5($this->input->post('pwd'));
        $this->load->model('loginModel');
        $returned = $this->loginModel->login_auth_model($usr, $pwd);

        if ($returned !== false) {
            $session_data = array(
                'username' => $returned->ud_usr,
                'userid' => $returned->ud_id
            );
            $this->session->set_userdata($session_data);
            redirect(base_url() . 'dashboard');
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect(base_url() . 'login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        redirect(base_url() . 'login');
    }
}
