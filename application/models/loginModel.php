<?php
class LoginModel extends CI_Model
{
    public function login_auth_model($username, $password)
    {
        $sql = "SELECT * FROM user_data JOIN customer_data ON cd_ud_id = ud_id WHERE ud_usr = ? AND ud_pwd = ?";
        $query = $this->db->query($sql, array($username, $password));

        if ($query->num_rows() > 0) {
            $data = array(
                'ud_log' => date('h:m:s d/m/y'),
            );
            $this->db->insert('user_data', $data);

            return $query->row();
        } else {
            return false;
        }
    }
}
