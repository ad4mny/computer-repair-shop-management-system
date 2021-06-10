<?php
class DashboardModel extends CI_Model
{
    public function get_booking_request_model()
    {
        $this->db->select('*');
        $this->db->from('repair_service_data');
        $this->db->where('rsd_status', NULL);
        $this->db->order_by('rsd_id', 'DESC');
        $this->db->order_by('rsd_progress', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_booking_request_by_id_model($request_id)
    {
        $this->db->select('*');
        $this->db->from('repair_service_data');
        $this->db->where('rsd_id', decrypt_it($request_id));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function take_repair_request_model($request_id, $staff_id, $brand, $model, $color, $severity, $information, $status, $reason, $price)
    {
        $data = array(
            'rsd_sd_id' =>  decrypt_it($staff_id),
            'rsd_status' => $status,
            'rsd_device_brand' => $brand,
            'rsd_device_model' => $model,
            'rsd_device_color' => $color,
            'rsd_damage_severity' => $severity,
            'rsd_damage_info' => $information,
            'rsd_comment' => $reason,
            'rsd_repair_cost' => $price
        );
        $this->db->where('rsd_id', decrypt_it($request_id));
        return $this->db->update('repair_service_data', $data);
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
        $this->db->where('rsd_id', decrypt_it($request_id));
        return $this->db->delete('repair_service_data');
    }
}
