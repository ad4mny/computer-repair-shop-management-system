<?php
class ProfileController extends CI_Controller
{
    public function index($page = 'profile')
    {
        auth_session();
        $data['profile'] = $this->get_profile_info();
        $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        if ($page === 'update') {
            $this->load->view('update_profile', $data);
        } else {
            $this->load->view('profile', $data);
        }
        $this->load->view('templates/footer');
    }

    public function get_profile_info()
    {
        $user_id = $this->session->userdata('userid');
        $this->load->model('profileModel');
        return $this->profileModel->get_profile_info_model($user_id);
    }

    public function set_profile_update()
    {
        $user_id = $this->session->userdata('userid');
        $full_name = $this->input->post('full_name');
        $contact_number = $this->input->post('contact_number');
        $street_1 = $this->input->post('street_1');
        $street_2 = $this->input->post('street_2');
        $postcode = $this->input->post('postcode');
        $city = $this->input->post('city');
        $state = $this->input->post('state');

        $this->load->model('profileModel');

        if ($this->profileModel->set_profile_update_model($user_id, $full_name, $contact_number, $street_1, $street_2, $postcode, $city, $state) !== false) {
            redirect(base_url() . 'profile');
        } else {
            $this->session->set_flashdata('error', 'unable to update profile');
            redirect(base_url() . 'profile/update');
        }
    }
}
