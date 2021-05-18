<?php
class RequestModel extends CI_Model
{
    public function add_new_request_model($customerid, $brand, $model, $color, $severity, $information)
    {
        $data = array(
            'rsd_cd_id' =>  $customerid,
            'rsd_status' =>  0,
            'rsd_progress' =>  0,
            'rsd_device_brand' => $brand,
            'rsd_device_model' => $model,
            'rsd_device_color' => $color,
            'rsd_damage_severity' => $severity,
            'rsd_damage_info' => $information,
        );

        $this->db->insert('repair_service_data', $data);

        return ($this->db->affected_rows() > 0) ? true : false;
    }
}
