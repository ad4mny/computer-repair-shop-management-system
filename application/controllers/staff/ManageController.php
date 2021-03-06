<?php
class ManageController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('staff/ManageModel');
    }

    public function index($page = 'manage', $user_id = NULL)
    {
        auth_session();
        $this->load->view('templates/header');
        $this->load->view('templates/navigation_staff');

        if ($page === 'manage' && $user_id === NULL) {
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

    public function search_user()
    {
        if (!empty($this->input->post('query'))) {
            $query = explode("-", $this->input->post('query'));
            if (isset($query[1]))
                $customer_id = $query[1];
            else
                $customer_id = NULL;
        } else {
            $customer_id = NULL;
        }

        $data['user'] = $this->ManageModel->search_user_model($customer_id);
        $this->load->view('templates/header');
        $this->load->view('templates/navigation_staff');
        $this->load->view('staff/manage/ManageInterface', $data);
        $this->load->view('templates/footer');
    }
}
