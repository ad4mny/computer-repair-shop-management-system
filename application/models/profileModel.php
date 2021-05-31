<?php
class ProfileModel extends CI_Model
{
    public function get_profile_info_model($user_id)
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('customer_data', 'cd_ud_id = ud_id');
        $this->db->where('ud_id', decrypt_it($user_id));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function set_profile_update_model($user_id, $username, $picture, $full_name, $contact_number, $street_1, $street_2, $postcode, $city, $state)
    {
        $data = array(
            'ud_usr' => $username,
            'ud_pic' => $picture,
            'ud_log' => date('H:m:s Y-m-d')
        );

        $this->db->where('ud_id', decrypt_it($user_id));
        $this->db->update('user_data', $data);

        $data = array(
            'cd_full_name' => $full_name,
            'cd_phone' => $contact_number,
            'cd_street_1' => $street_1,
            'cd_street_2' => $street_2,
            'cd_postcode' => $postcode,
            'cd_city' => $city,
            'cd_state' => $state,
            'cd_log' => date('H:m:s Y-m-d')
        );

        $this->db->where('cd_ud_id', decrypt_it($user_id));
        return $this->db->update('customer_data', $data);
    }

    public function set_password_change_model($user_id, $old_password, $password)
    {
        $this->db->select('ud_pwd');
        $this->db->from('user_data');
        $this->db->where('ud_id', decrypt_it($user_id));
        $result = $this->db->get()->row();

        if (md5($old_password) == $result->ud_pwd) {
            $data = array(
                'ud_pwd' => md5($password),
                'ud_log' => date('H:m:s Y-m-d')
            );

            $this->db->where('ud_id', decrypt_it($user_id));
            return $this->db->update('user_data', $data);
        } else {
            return false;
        }
    }
}
