<?php
class LoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel');
    }

    public function index($page = 'login')
    {
        $this->load->view('templates/header');
        if ($page === 'create') {
            $this->load->view('create_account');
        } else {
            $this->load->view('login');
        }
        $this->load->view('templates/footer');
    }

    public function login_auth()
    {
        $usr = $this->input->post('usr');
        $pwd = md5($this->input->post('pwd'));

        $return = $this->LoginModel->login_auth_model($usr, $pwd);

        if ($return !== false) {

            $session_data = array(
                'userid' => encrypt_it($return->ud_id),
                'username' => encrypt_it($return->ud_usr),
                'customerid' => encrypt_it($return->cd_id),
                'role' => encrypt_it($return->ud_role)
            );

            $this->session->set_userdata($session_data);

            switch ($this->session->set_userdata('role')) {
                case 2:
                    redirect(base_url() . 'staff/dashboard');
                    break;
                case 1:
                    redirect(base_url() . 'runner/dashboard');
                    break;
                default:
                    redirect(base_url() . 'dashboard');
                    break;
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect(base_url());
        }
    }

    public function create_user_account()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $full_name = $this->input->post('full_name');
        $contact_number = $this->input->post('contact_number');
        $street_1 = $this->input->post('street_1');
        $street_2 = $this->input->post('street_2');
        $postcode = $this->input->post('postcode');
        $city = $this->input->post('city');
        $state = $this->input->post('state');

        $return = $this->LoginModel->create_user_account_model($username, $password, $full_name, $contact_number, $street_1, $street_2, $postcode, $city, $state);

        if ($return !== false) {

            $session_data = array(
                'userid' => encrypt_it($return->ud_id),
                'username' => encrypt_it($return->ud_usr),
                'customerid' => encrypt_it($return->cd_id),
                'role' => encrypt_it($return->ud_role)
            );

            $this->session->set_userdata($session_data);
            echo json_encode($this->session->userdata());
        } else {
            echo json_encode(false);
        }
    }

    public function check_username()
    {
        $username = $this->input->post('username');
        echo json_encode($this->LoginModel->check_username_model($username));
    }

    public function logout()
    {
        $session_data = array(
            'userid',
            'username',
            'customerid',
            'role'
        );

        $this->session->unset_userdata($session_data);
        redirect(base_url());
    }
}
