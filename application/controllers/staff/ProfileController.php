<?php
class ProfileController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('staff/ProfileModel');
    }

    public function index($page = 'profile')
    {
        auth_session();
        $data['profile'] = $this->get_profile_info();
        $this->load->view('templates/header');
        $this->load->view('templates/navigation_staff');
        if ($page === 'update') {
            $this->load->view('staff/profile/UpdateProfileInterface', $data);
        } else {
            $this->load->view('staff/profile/ProfileInterface', $data);
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
        $full_name = $this->input->post('full_name');
        $contact_number = $this->input->post('contact_number');

        if ($this->ProfileModel->set_profile_update_model($user_id, $full_name, $contact_number) !== false) {
            redirect(base_url() . 'staff/profile');
        } else {
            $this->session->set_flashdata('error', 'Unable to update profile');
            redirect(base_url() . 'staff/profile/update');
        }
    }
}
