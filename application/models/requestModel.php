<?php
class RequestModel extends CI_Model
{
    public function add_new_request_model($customer_id, $brand, $model, $color, $severity, $information)
    {
        $data = array(
            'rsd_cd_id' =>  decrypt_it($customer_id),
            'rsd_status' =>  0,
            'rsd_progress' =>  0,
            'rsd_device_brand' => $brand,
            'rsd_device_model' => $model,
            'rsd_device_color' => $color,
            'rsd_damage_severity' => $severity,
            'rsd_damage_info' => $information,
        );

        return $this->db->insert('repair_service_data', $data);
    }
}
