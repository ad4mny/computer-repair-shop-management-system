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
        $query = $this->db->get();
        $result = $query->row();

        if ($result > 0) {
            $data = array(
                'ud_log' => date('h:m:s d/m/y')
            );

            $this->db->where('ud_id', $result->ud_id);
            $this->db->update('user_data', $data);

            return $result;
        } else {
            return false;
        }
    }
}
