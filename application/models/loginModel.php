<?php
class LoginModel extends CI_Model
{
    public function login_auth_model($username, $password)
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->where('ud_usr', $username);
        $this->db->where('ud_pwd', $password);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();

            $data = array(
                'ud_log' => date('Y-m-d H:i:s ')
            );

            $this->db->where('ud_id', $result->ud_id);
            $this->db->update('user_data', $data);

            return $result;
        } else {
            return false;
        }
    }

    public function login_role_model($user_id, $role)
    {
        $this->db->select('*');
        switch (decrypt_it($role)) {
            case 2:
                $this->db->from('staff_data');
                $this->db->where('sd_ud_id', decrypt_it($user_id));
                break;
            case 1:
                $this->db->from('runner_data');
                $this->db->where('rd_ud_id', decrypt_it($user_id));
                break;
            default:
                $this->db->from('customer_data');
                $this->db->where('cd_ud_id', decrypt_it($user_id));
                break;
        }
        return $this->db->get()->row();
    }

    public function check_username_model($username)
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->where('ud_usr', $username);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function create_user_account_model($username, $password, $full_name, $contact_number, $street_1, $street_2, $postcode, $city, $state)
    {
        // create new user data
        $data = array(
            'ud_usr' =>  $username,
            'ud_pwd' =>  $password,
            'ud_role' => 0,
            'ud_log' => date('Y-m-d H:i:s '),
            'ud_created' => date('Y-m-d H:i:s ')
        );

        // insert user data
        $this->db->insert('user_data', $data);

        // get new inserted user data
        $this->db->select('ud_id');
        $this->db->from('user_data');
        $this->db->where('ud_usr', $username);
        $this->db->where('ud_pwd', $password);

        // get user id 
        $result = $this->db->get()->row();

        // create new customer data
        $data = array(
            'cd_ud_id' => $result->ud_id,
            'cd_full_name' => $full_name,
            'cd_phone' => $contact_number,
            'cd_street_1' => $street_1,
            'cd_street_2' => $street_2,
            'cd_postcode' => $postcode,
            'cd_city' => $city,
            'cd_state' => $state,
        );

        // insert customer data 
        $this->db->insert('customer_data', $data);

        return $this->login_auth_model($username, $password);
    }

    public function create_staff_account_model($username, $password, $type, $plat_num, $full_name, $contact_number, $email)
    {
        // create new user data
        $data = array(
            'ud_usr' => $username,
            'ud_pwd' => $password,
            'ud_role' => $type,
            'ud_email' => $email,
            'ud_log' => date('Y-m-d H:i:s '),
            'ud_created' => date('Y-m-d H:i:s ')
        );

        // insert user data
        $this->db->insert('user_data', $data);

        // get new inserted user data
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->where('ud_usr', $username);
        $this->db->where('ud_pwd', $password);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            $result = $query->row();
            $email = $result->ud_email;
            $this->send_notice_email($email, $username);

            if ($type == 2) {
                $data = array(
                    'sd_ud_id' => $result->ud_id,
                    'sd_full_name' => $full_name,
                    'sd_phone' => $contact_number
                );

                return $this->db->insert('staff_data', $data);
            } else {
                $data = array(
                    'rd_ud_id' => $result->ud_id,
                    'rd_full_name' => $full_name,
                    'rd_phone' => $contact_number,
                    'rd_plat_num' => $plat_num
                );

                return $this->db->insert('runner_data', $data);
            }
        } else {
            return false;
        }
    }

    public function send_notice_email($email, $username)
    {
        $this->load->library('email');

        $subject = 'Dercs Computer Repair Shop';
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
                <h2><b>Your Account is under approval.</b></h2>
                    <p>Please wait while our staff get to approve your joining request,</p><br>
                    <p>from DCRS Team.</p>';

        $this->email
            ->from('no-reply@dcrs.com', 'Dercs Computer Repair Shop')
            ->to($email, $username)
            ->subject($subject)
            ->message($body)
            ->send();

    }
}
