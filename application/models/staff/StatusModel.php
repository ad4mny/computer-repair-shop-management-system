<?php
class StatusModel extends CI_Model
{
    public function get_all_accepted_request_model($staff_id)
    {
        $this->db->select('*');
        $this->db->from('repair_service_data');
        $this->db->where('rsd_sd_id', decrypt_it($staff_id));
        $this->db->where('rsd_status !=', NULL);
        $this->db->order_by('rsd_status', 'DESC');
        $this->db->order_by('rsd_progress', 'ASC');
        $this->db->order_by('rsd_id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_repair_request_model($request_id, $progress)
    {
        $data = array(
            'rsd_progress' => $progress,
            'rsd_comment' => 'Repair is complete',
        );

        $this->db->where('rsd_id', decrypt_it($request_id));
        return $this->db->update('repair_service_data', $data);
    }
}
