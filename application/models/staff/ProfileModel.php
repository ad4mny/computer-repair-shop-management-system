<?php
class ProfileModel extends CI_Model
{
    public function get_profile_info_model($user_id)
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('staff_data', 'sd_ud_id = ud_id');
        $this->db->where('ud_id', decrypt_it($user_id));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function set_profile_update_model($user_id, $full_name, $contact_number)
    {
        $data = array(
            'sd_full_name' => $full_name,
            'sd_phone' => $contact_number
        );

        $this->db->where('sd_ud_id', decrypt_it($user_id));
        return $this->db->update('staff_data', $data);
    }
}
