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

    public function set_profile_update_model($user_id, $full_name, $contact_number, $street_1, $street_2, $postcode, $city, $state)
    {
        $data = array(
            'cd_full_name' => $full_name,
            'cd_phone' => $contact_number,
            'cd_street_1' => $street_1,
            'cd_street_2' => $street_2,
            'cd_postcode' => $postcode,
            'cd_city' => $city,
            'cd_state' => $state,
            'cd_log' => date('h:m:s d/m/y')
        );

        $this->db->where('cd_ud_id', decrypt_it($user_id));
        return $this->db->update('customer_data', $data);
    }
}
