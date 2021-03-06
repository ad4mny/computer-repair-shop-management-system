<?php
class DashboardModel extends CI_Model
{
    public function get_available_delivery_model()
    {
        $this->db->select('rsd_id');
        $this->db->from('repair_service_data');
        $this->db->where('rsd_progress', 2);
        $this->db->or_where('rsd_progress', 0);
        $query = $this->db->get();

        $data = array();

        if ($query->num_rows() > 0) {

            $result = $query->result_array();

            foreach ($result as $row) {
                $this->db->select('*');
                $this->db->from('track_data');
                $this->db->join('repair_service_data', 'rsd_id = td_rsd_id');
                $this->db->join('customer_data', 'cd_id = rsd_cd_id');
                $this->db->where('td_id = (SELECT MAX(td_id) as td_id FROM track_data WHERE td_rsd_id =' . $row['rsd_id'] . ')');
                $this->db->where('td_status','Completed');
                $query = $this->db->get();

                if ($query->num_rows() > 0) {
                    array_push($data, $query->row_array());
                }
            }
        }

        return $data;
    }

    public function get_available_pickup_model()
    {
        $this->db->select('rsd_id');
        $this->db->from('repair_service_data');
        $query = $this->db->get();

        $data = array();

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as $row) {
                $this->db->select('*');
                $this->db->from('track_data');
                $this->db->where('td_rsd_id', $row['rsd_id']);
                $query = $this->db->get();

                if ($query->num_rows() < 1) {
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

    public function take_delivery_request_model($repair_id, $runner_id)
    {
        $data = array(
            'td_rsd_id' => decrypt_it($repair_id),
            'td_rd_id' => decrypt_it($runner_id),
            'td_status' => 'Delivering',
            'td_log' => date('Y-m-d H:i:s')
        );

        return $this->db->insert('track_data', $data);
    }

    public function take_pickup_request_model($repair_id, $runner_id)
    {
        $data = array(
            'td_rsd_id' => decrypt_it($repair_id),
            'td_rd_id' => decrypt_it($runner_id),
            'td_status' => 'Picking Up',
            'td_log' => date('Y-m-d H:i:s')
        );
        
        return $this->db->insert('track_data', $data);
    }
}
