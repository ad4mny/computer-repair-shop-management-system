<?php
class DashboardModel extends CI_Model
{
    public function get_available_delivery_model()
    {
        $this->db->select('rsd_id');
        $this->db->from('repair_service_data');
        $this->db->where('rsd_progress', 2);
        $result = $this->db->get()->result_array();

        $data = array();

        foreach ($result as $row) {
            $sql = 'SELECT * FROM track_data JOIN repair_service_data ON repair_service_data.rsd_id = track_data.td_rsd_id JOIN customer_data ON repair_service_data.rsd_cd_id = customer_data.cd_id WHERE td_id = (SELECT MAX(td_id) as td_id FROM track_data WHERE td_rsd_id =' . $row['rsd_id'] . ') AND td_status = "Completed"';
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0)
                array_push($data, $query->row_array());
        }

        return $data;
    }

    public function take_delivery_request_model($repair_id, $runner_id)
    {
        $data = array(
            'td_rsd_id' => decrypt_it($repair_id),
            'td_rd_id' => decrypt_it($runner_id),
            'td_status' => 'Delivering',
            'td_log' => date('H:m:s Y-m-d')
        );

        return $this->db->insert('track_data', $data);
    }
}
