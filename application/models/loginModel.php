<?php
class LoginModel extends CI_Model
{
    public function login_auth_model($username, $password)
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('customer_data', 'cd_ud_id = ud_id');
        $this->db->where('ud_usr', $username);
        $this->db->where('ud_pwd', $password);
        $result = $this->db->get()->row();

        if ($result->ud_id !== null) {
            $data = array(
                'ud_log' => date('h:m:s Y-m-d')
            );

            $this->db->where('ud_id', $result->ud_id);
            $this->db->update('user_data', $data);

            return $result;
        } else {
            return false;
        }
    }

    public function check_username_model($username)
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->where('ud_usr', $username);
        $query = $this->db->get();
        return json_encode($query->num_rows());
    }

    public function create_user_account_model($username, $password, $full_name, $contact_number, $street_1, $street_2, $postcode, $city, $state)
    {
        // create new user data
        $data = array(
            'ud_usr' =>  $username,
            'ud_pwd' =>  $password,
            'ud_log' => date('h:m:s Y-m-d'),
            'ud_created' => date('h:m:s Y-m-d')
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
}
