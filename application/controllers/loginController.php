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
        $data['css'] = '<link rel="stylesheet" href="' . base_url() . 'assets/css/login.css">';
        if ($page === 'create') {
            $this->load->view('templates/header');
            $this->load->view('login/CreateInterface');
        } else  if ($page === 'create_staff') {
            $this->load->view('templates/header');
            $this->load->view('login/RegisterInterface');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('login/LoginInterface');
        }
        $this->load->view('templates/footer');
    }

    public function login_auth()
    {
        $usr = $this->input->post('usr');
        $pwd = md5($this->input->post('pwd'));

        $return = $this->LoginModel->login_auth_model($usr, $pwd);

        if ($return !== false) {

            $this->session->set_userdata('userid', encrypt_it($return->ud_id));
            $this->session->set_userdata('username', encrypt_it($return->ud_usr));
            $this->session->set_userdata('picture', encrypt_it($return->ud_pic));
            $this->session->set_userdata('role', encrypt_it($return->ud_role));

            $return = $this->LoginModel->login_role_model($this->session->userdata('userid'), $this->session->userdata('role'));

            if ($return !== false) {
                switch (decrypt_it($this->session->userdata('role'))) {
                    case 2:
                        $this->session->set_userdata('staffid', encrypt_it($return->sd_id));
                        redirect(base_url() . 'staff/dashboard');
                        break;
                    case 1:
                        $this->session->set_userdata('runnerid', encrypt_it($return->rd_id));
                        redirect(base_url() . 'runner/dashboard');
                        break;
                    default:
                        $this->session->set_userdata('customerid', encrypt_it($return->cd_id));
                        redirect(base_url() . 'dashboard');
                        break;
                }
            } else {
                $this->session->set_tempdata('error', 'Invalid user account, please register again.', 3);
                redirect(base_url());
            }
        } else {
            $this->session->set_tempdata('error', 'Wrong username or password entered.', 3);

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

            $this->session->set_userdata('userid', encrypt_it($return->ud_id));
            $this->session->set_userdata('username', encrypt_it($return->ud_usr));
            $this->session->set_userdata('role', encrypt_it($return->ud_role));

            $return = $this->LoginModel->login_role_model($this->session->userdata('userid'), $this->session->userdata('role'));

            $this->session->set_userdata('customerid', encrypt_it($return->cd_id));

            echo decrypt_it($this->session->userdata('role'));
        } else {
            echo json_encode(false);
        }
    }

    public function create_staff_account()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $type = $this->input->post('type');
        $plat_num = $this->input->post('plat_num');
        $full_name = $this->input->post('full_name');
        $contact_number = $this->input->post('contact_number');

        $return = $this->LoginModel->create_staff_account_model($username, $password, $type, $plat_num, $full_name, $contact_number);

        if ($return !== false) {

            $this->session->set_userdata('userid', encrypt_it($return->ud_id));
            $this->session->set_userdata('username', encrypt_it($return->ud_usr));
            $this->session->set_userdata('role', encrypt_it($return->ud_role));

            $return = $this->LoginModel->login_role_model($this->session->userdata('userid'), $this->session->userdata('role'));

            if (decrypt_it($this->session->userdata('role')) == 2) {
                $this->session->set_userdata('staffid', encrypt_it($return->sd_id));
            } else {
                $this->session->set_userdata('runnerid', encrypt_it($return->rd_id));
            }

            echo decrypt_it($this->session->userdata('role'));
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
            'picture',
            'role'
        );

        $this->session->set_tempdata('notice', 'You have logout successfully.', 3);
        $this->session->unset_userdata($session_data);
        redirect(base_url());
    }
}
