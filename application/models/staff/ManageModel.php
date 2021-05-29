<?php
class ManageModel extends CI_Model
{
    public function get_user_list_model()
    {
        $this->db->select('*');
        $this->db->from('customer_data');
        return $this->db->get()->result_array();
    }

    public function get_user_information_model($user_id)
    {
        $this->db->select('*');
        $this->db->from('customer_data');
        $this->db->where('cd_id', decrypt_it($user_id));
        return $this->db->get()->row_array();
    }  
    
    public function get_device_information_by_user_model($user_id)
    {
        $this->db->select('*');
        $this->db->from('repair_service_data');
        $this->db->where('rsd_cd_id', decrypt_it($user_id));
        $this->db->order_by('rsd_id', 'DESC');
        return $this->db->get()->result_array();
    }

}