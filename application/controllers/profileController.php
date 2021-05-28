<?php
class ProfileController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProfileModel');
        $this->load->library('upload');
        $this->load->helper('image');
    }

    public function index($page = 'profile')
    {
        auth_session();
        $data['profile'] = $this->get_profile_info();
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        if ($page === 'update') {
            $this->load->view('profile/UpdateProfileInterface', $data);
        } else {
            $this->load->view('profile/ProfileInterface', $data);
        }
        $this->load->view('templates/footer');
    }

    public function get_profile_info()
    {
        $user_id = $this->session->userdata('userid');
        return $this->ProfileModel->get_profile_info_model($user_id);
    }

    public function set_profile_update()
    {
        $user_id = $this->session->userdata('userid');
        $username = $this->input->post('username');
        $full_name = $this->input->post('full_name');
        $contact_number = $this->input->post('contact_number');
        $street_1 = $this->input->post('street_1');
        $street_2 = $this->input->post('street_2');
        $postcode = $this->input->post('postcode');
        $city = $this->input->post('city');
        $state = $this->input->post('state');

        $config['upload_path'] = './assets/img/profile';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size']     = '0';
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('picture')) {
            echo $this->upload->display_errors('', '');
        } else {
            $picture = $this->upload->data('file_name');
            create_square_image($_SERVER['DOCUMENT_ROOT'] . '/devdcrs/assets/img/profile/' . $this->upload->data('file_name'), $_SERVER['DOCUMENT_ROOT'] . '/devdcrs/assets/img/profile/thumbnail/' . $this->upload->data('file_name'), 300);

            $return = $this->ProfileModel->set_profile_update_model($user_id, $username, $picture, $full_name, $contact_number, $street_1, $street_2, $postcode, $city, $state);

            if ($return != false) {
                $this->session->set_userdata('picture', encrypt_it($picture));
                echo json_encode($return);
            } else {
                echo json_encode(false);
            }
        }
    }

    public function set_password_change()
    {
        $user_id = $this->session->userdata('userid');
        $old_password = $this->input->post('old_password');
        $password = $this->input->post('password');

        echo json_encode($this->ProfileModel->set_password_change_model($user_id, $old_password, $password));
    }
}
