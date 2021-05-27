<?php
class StatusModel extends CI_Model
{
    public function get_latest_ongoing_request_model($customer_id)
    {
        $this->db->select('*');
        $this->db->from('repair_service_data');
        $this->db->where('rsd_cd_id', decrypt_it($customer_id));
        $this->db->where('rsd_status', 1);
        $this->db->where('rsd_progress !=', 2);
        $this->db->order_by('rsd_id', 'DESC');
        $this->db->limit(1); 
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_ongoing_request_by_id_model($repair_id)
    {
        $this->db->select('*');
        $this->db->from('repair_service_data');
        $this->db->where('rsd_id', decrypt_it($repair_id));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_request_id_model($customer_id)
    {
        $this->db->select('rsd_id, rsd_device_brand, rsd_device_model');
        $this->db->from('repair_service_data');
        $this->db->where('rsd_cd_id', decrypt_it($customer_id));
        $this->db->where('rsd_status', 1);
        $this->db->where('rsd_progress !=', 2);
        $this->db->order_by('rsd_id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }  
    

}
