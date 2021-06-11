<?php
class ApproveController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        auth_session();
        $this->load->model('staff/ApproveModel');
    }

    public function index()
    {
        $data['staff'] = $this->get_pending_staff();
        $data['runner'] = $this->get_pending_runner();

        $this->load->view('templates/header');
        $this->load->view('templates/navigation_staff');
        $this->load->view('staff/approve/ApproveInterface', $data);
        $this->load->view('templates/footer');
    }

    public function get_pending_staff()
    {
        return $this->ApproveModel->get_pending_staff_model();
    }

    public function get_pending_runner()
    {
        return $this->ApproveModel->get_pending_runner_model();
    }

    public function set_accept_user($user_id, $role)
    {
        if ($this->ApproveModel->set_accept_user_model($user_id, $role) !== FALSE) {
            $this->session->set_tempdata('notice', 'The user has been approved.', 3);
            redirect(base_url() . 'staff/approve');
        } else {
            $this->session->set_tempdata('error', 'Failed to approve the selected user.', 3);
            redirect(base_url() . 'staff/approve');
        }
    }

    public function set_reject_user($user_id, $role)
    {
        if ($this->ApproveModel->set_reject_user_model($user_id, $role) !== FALSE) {
            $this->session->set_tempdata('notice', 'The user has been rejected.', 3);
            redirect(base_url() . 'staff/approve');
        } else {
            $this->session->set_tempdata('error', 'Failed to reject the selected user.', 3);
            redirect(base_url() . 'staff/approve');
        }
    }
}
