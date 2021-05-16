<?php
class LoginModel extends CI_Model
{
    public function login_auth_model($username, $password)
    {
        $query = $this->db->query('SELECT * FROM user_data');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
}
