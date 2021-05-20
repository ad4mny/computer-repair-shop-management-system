<?php
class DashboardModel extends CI_Model
{
    public function get_booking_request_model($customer_id)
    {
        $this->db->select('*');
        $this->db->from('repair_service_data');
        $this->db->where('rsd_cd_id', $customer_id);
        $this->db->order_by('rsd_id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_technician_info_model($staff_id)
    {
        $this->db->select('*');
        $this->db->from('staff_data');
        $this->db->where('sd_id', $staff_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_request_model($request_id)
    {
        $dec_request_id = $this->encryption->decrypt($request_id);
        $this->db->where('rsd_id', $dec_request_id);
        return $this->db->delete('repair_service_data');
    }
}
