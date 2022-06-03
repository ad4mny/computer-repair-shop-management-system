<?php
class RequestModel extends CI_Model
{
    public function add_new_request_model($customer_id, $brand, $model, $color, $severity, $information, $datetime)
    {
        $data = array(
            'rsd_cd_id' => decrypt_it($customer_id),
            'rsd_comment' => 'Awaiting runner pickup',
            'rsd_device_brand' => $brand,
            'rsd_device_model' => $model,
            'rsd_device_color' => $color,
            'rsd_damage_severity' => $severity,
            'rsd_damage_info' => $information,
            'rsd_pickup_log' => $datetime,
            'rsd_log' => date('Y-m-d H:i:s')
        );

        return $this->db->insert('repair_service_data', $data);
    }

    public function update_request_by_id_model($request_id, $brand, $model, $color, $severity, $information, $datetime)
    {
        $data = array(
            'rsd_device_brand' => $brand,
            'rsd_device_model' => $model,
            'rsd_device_color' => $color,
            'rsd_damage_severity' => $severity,
            'rsd_damage_info' => $information,
            'rsd_pickup_log' => $datetime,
            'rsd_log' => date('Y-m-d H:i:s')
        );
        $this->db->where('rsd_id', decrypt_it($request_id));
        return $this->db->update('repair_service_data', $data);
    }
}
