<?php
class StatusModel extends CI_Model
{
    public function get_ongoing_request_model($customer_id)
    {
        $this->db->select('*');
        $this->db->from('repair_service_data');
        $this->db->where('rsd_cd_id', $customer_id);
        $this->db->where('rsd_progress', 1);
        $this->db->order_by('rsd_progress', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
