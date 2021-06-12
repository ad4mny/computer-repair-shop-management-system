<?php

class ApproveModel extends CI_Model
{
    public function get_pending_staff_model()
    {
        $this->db->select('*');
        $this->db->from('staff_data');
        $this->db->where('sd_status');
        return $this->db->get()->result_array();
    }

    public function get_pending_runner_model()
    {
        $this->db->select('*');
        $this->db->from('runner_data');
        $this->db->where('rd_status');
        return $this->db->get()->result_array();
    }

    public function set_accept_user_model($user_id, $role)
    {
        if (decrypt_it($role) === '2') {

            $this->db->select('*');
            $this->db->from('staff_data');
            $this->db->join('user_data', 'sd_ud_id = ud_id');
            $this->db->where('sd_id', decrypt_it($user_id));
            $query = $this->db->get();

            if ($query->num_rows() > 0) {

                $result = $query->row();
                $this->send_notice_email($result->ud_email, $result->ud_usr, 1);

                $data = array(
                    'sd_status' => 1,
                );

                $this->db->where('sd_id', decrypt_it($user_id));
                return $this->db->update('staff_data', $data);
            }
        } else {
            $this->db->select('*');
            $this->db->from('runner_data');
            $this->db->join('user_data', 'rd_ud_id = ud_id');
            $this->db->where('rd_id', decrypt_it($user_id));
            $query = $this->db->get();

            if ($query->num_rows() > 0) {

                $result = $query->row();
                $this->send_notice_email($result->ud_email, $result->ud_usr, 1);

                $data = array(
                    'rd_status' => 1,
                );

                $this->db->where('rd_id', decrypt_it($user_id));
                return $this->db->update('runner_data', $data);
            }
        }
    }

    public function set_reject_user_model($user_id, $role)
    {
        if (decrypt_it($role) === '2') {

            $this->db->select('*');
            $this->db->from('staff_data');
            $this->db->join('user_data', 'sd_ud_id = ud_id');
            $this->db->where('sd_id', decrypt_it($user_id));
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $result = $query->row();
                $this->send_notice_email($result->ud_email, $result->ud_usr, 0);
                $this->db->where('sd_id', decrypt_it($user_id));
                return $this->db->delete('staff_data');
            }
        } else {
            $this->db->select('*');
            $this->db->from('runner_data');
            $this->db->join('user_data', 'rd_ud_id = ud_id');
            $this->db->where('rd_id', decrypt_it($user_id));
            $query = $this->db->get();

            if ($query->num_rows() > 0) {

                $result = $query->row();
                $this->send_notice_email($result->ud_email, $result->ud_usr, 0);
                $this->db->where('rd_id', decrypt_it($user_id));
                return $this->db->delete('runner_data');
            }
        }
    }

    public function send_notice_email($email, $username, $status)
    {
        $this->load->library('email');

        $subject = 'Dercs Computer Repair Shop';

        if ($status === 0) {
            $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
            <title>' . html_escape($subject) . '</title>
            <style type="text/css">
                body {
                    font-family: Arial, Verdana, Helvetica, sans-serif;
                    font-size: 16px;
                }
            </style>
        </head>
        <h1>Hi, ' . $username . '.</h1> 
                 <h2><b>Your account has been rejected :(</b></h2>
                <p>Sorry to say we have rejected your application to join our team.</p><br>
                <p>You may reapply here, https://dercs.000webhostapp.com/register</p><br>
                    <p>from DCRS Team.</p>';
        } else {
            $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
                <title>' . html_escape($subject) . '</title>
                <style type="text/css">
                    body {
                        font-family: Arial, Verdana, Helvetica, sans-serif;
                        font-size: 16px;
                    }
                </style>
            </head>
            <h1>Hi, ' . $username . '.</h1> 
                    <h2><b>Your Account has been approved!</b></h2>
                        <p>We are happy to say we would love having you a part of our team,</p><br>
                        <p>You may login now, https://dercs.000webhostapp.com/</p><br>
                        <p>from DCRS Team.</p>';
        }

        $response = $this->email
            ->from('no-reply@dcrs.com', 'Dercs Computer Repair Shop')
            ->to($email, $username)
            ->subject($subject)
            ->message($body)
            ->send();

    }
}
