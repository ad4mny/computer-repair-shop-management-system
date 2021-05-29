<?php
class ManageController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('staff/ManageModel');
    }

    public function index($page = 'manage', $user_id = null)
    {
        auth_session();
        $data['controller'] = $this;
        $this->load->view('templates/header');
        $this->load->view('templates/navigation_staff');

        if ($page === 'manage' && $user_id === null) {
            $data['user'] = $this->get_user_list();
            $this->load->view('staff/manage/ManageInterface', $data);
        } else {
            $data['user'] = $this->get_user_information($user_id);
            $data['device'] = $this->get_device_information_by_user($user_id);
            $this->load->view('staff/manage/ViewUserInterface', $data);
        }

        $this->load->view('templates/footer');
    }

    public function get_user_list()
    {
        return $this->ManageModel->get_user_list_model();
    }

    public function get_user_information($user_id)
    {
        return $this->ManageModel->get_user_information_model($user_id);
    }
    
    public function get_device_information_by_user($user_id)
    {
        return $this->ManageModel->get_device_information_by_user_model($user_id);
    }
}
