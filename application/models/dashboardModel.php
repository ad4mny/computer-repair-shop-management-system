<?php
class DashboardModel extends CI_Model
{
    public function get_booking_request_model($customerid) {

        $sql = "SELECT * FROM repair_service_data WHERE rsd_cd_id = ?";
        $query = $this->db->query($sql, array($customerid));

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    
}
