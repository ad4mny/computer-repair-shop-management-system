<?php
class ProfileController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('runner/ProfileModel');
        $this->load->library('upload');
        $this->load->helper('image');
    }

    public function index($page = 'profile')
    {
        auth_session();
        $data['profile'] = $this->get_profile_info();
        $this->load->view('templates/header');
        $this->load->view('templates/navigation_runner');
        if ($page === 'update') {
            $this->load->view('runner/profile/UpdateProfileInterface', $data);
        } else {
            $this->load->view('runner/profile/ProfileInterface', $data);
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
            if (!empty($_FILES['picture']['name'])) {
                $this->session->set_tempdata('error', $this->upload->display_errors('', ''), 3);
                echo json_encode(false);
                exit;
            } else {
                $return = $this->ProfileModel->set_profile_update_model($user_id, $username, NULL, $full_name, $contact_number, $street_1, $street_2, $postcode, $city, $state);

                if ($return != false) {
                    $this->session->set_tempdata('notice', 'Your profile has been updated successfully.', 3);
                    echo json_encode($return);
                    exit;
                } else {
                    $this->session->set_tempdata('error', 'Error while updating your profile, please try again.', 3);
                    echo json_encode(false);
                    exit;
                }
            }
        } else {
            $picture = $this->upload->data('file_name');
            create_square_image($_SERVER['DOCUMENT_ROOT'] . '/devdcrs/assets/img/profile/' . $this->upload->data('file_name'), $_SERVER['DOCUMENT_ROOT'] . '/devdcrs/assets/img/profile/thumbnail/' . $this->upload->data('file_name'), 300);

            $return = $this->ProfileModel->set_profile_update_model($user_id, $username, $picture, $full_name, $contact_number, $street_1, $street_2, $postcode, $city, $state);

            if ($return != false) {
                $this->session->set_tempdata('notice', 'Your profile has been updated successfully.', 3);
                $this->session->set_userdata('picture', encrypt_it($picture));
                echo json_encode($return);
            } else {
                $this->session->set_tempdata('error', 'Error while updating your profile, please try again.', 3);
                echo json_encode(false);
            }
        }
    }

    public function set_password_change()
    {
        $user_id = $this->session->userdata('userid');
        $old_password = $this->input->post('old_password');
        $password = $this->input->post('password');
        $return = $this->ProfileModel->set_password_change_model($user_id, $old_password, $password);
        if ($return !== false) {
            $this->session->set_tempdata('notice', 'Your password has been changed successfully.', 3);
            echo json_encode($return);
        } else {
            $this->session->set_tempdata('error', 'Your old password is incorrect.', 3);
            echo json_encode($return);
        }
    }

    public function deactivate_account()
    {
        $user_id = $this->session->userdata('userid');
        $password = $this->input->post('password');
        $return = $this->ProfileModel->deactivate_account_model($user_id, $password);
        if ($return !== false) {
            $session_data = array(
                'userid',
                'username',
                'runnerid',
                'picture',
                'role'
            );
            $this->session->unset_userdata($session_data);
            $this->session->set_tempdata('notice', 'Your account has been deactivated.', 3);
            echo json_encode($return);
        } else {
            $this->session->set_tempdata('error', 'Your password is incorrect.', 3);
            echo json_encode($return);
        }
    }
}
