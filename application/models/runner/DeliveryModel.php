<?php
class DeliveryModel extends CI_Model
{
    public function get_accepted_delivery_model($runner_id)
    {
        $this->db->select('rsd_id');
        $this->db->from('repair_service_data');
        $this->db->where('rsd_progress', 2);
        $this->db->or_where('rsd_status', 0);
        $query = $this->db->get();

        $data = array();

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as $row) {
                $sql = 'SELECT * FROM track_data JOIN repair_service_data ON repair_service_data.rsd_id = track_data.td_rsd_id JOIN customer_data ON repair_service_data.rsd_cd_id = customer_data.cd_id WHERE td_id = (SELECT MAX(td_id) as td_id FROM track_data WHERE td_rsd_id =' . $row['rsd_id'] . ') AND td_status != "Completed" AND td_rd_id = ' . decrypt_it($runner_id);
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0)
                    array_push($data, $query->row_array());
            }
        }

        return $data;
    }

    public function get_accepted_pickup_model($runner_id)
    {
        $this->db->select('rsd_id');
        $this->db->from('repair_service_data');
        $this->db->where('rsd_progress');
        $query = $this->db->get();

        $data = array();

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as $row) {
                $this->db->select('*');
                $this->db->from('track_data');
                $this->db->where('td_rd_id', decrypt_it($runner_id));
                $this->db->where('td_rsd_id', $row['rsd_id']);
                $query = $this->db->get();

                if ($query->num_rows() > 0) {
                    $this->db->select('*');
                    $this->db->from('repair_service_data');
                    $this->db->join('customer_data', 'rsd_cd_id = cd_id');
                    $this->db->where('rsd_id', $row['rsd_id']);
                    $query = $this->db->get();

                    array_push($data, $query->row_array());
                }
            }
        }

        return $data;
    }

    public function cancel_delivery_request_model($request_id, $runner_id)
    {
        $this->db->where('td_rsd_id', decrypt_it($request_id));
        $this->db->where('td_rd_id', decrypt_it($runner_id));
        return $this->db->delete('track_data');
    }

    public function complete_delivery_request_model($request_id, $runner_id)
    {
        $data = array(
            'td_rsd_id' => decrypt_it($request_id),
            'td_rd_id' => decrypt_it($runner_id),
            'td_status' => 'Delivered',
            'td_log' => date('Y-m-d H:i:s'),
        );
        return $this->db->insert('track_data', $data);
    }

    public function cancel_pickup_request_model($request_id, $runner_id)
    {
        $this->db->where('td_rsd_id', decrypt_it($request_id));
        $this->db->where('td_rd_id', decrypt_it($runner_id));
        return $this->db->delete('track_data');
    }

    public function complete_pickup_request_model($request_id, $runner_id)
    {
        $data = array(
            'rsd_progress' => 0,
            'rsd_comment' => 'Device awaiting inspection',
            'rsd_log' => date('Y-m-d H:i:s')
        );

        $this->db->where('rsd_id', decrypt_it($request_id));
        return $this->db->update('repair_service_data', $data);
    }
}
