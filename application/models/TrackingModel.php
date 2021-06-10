<?php
class TrackingModel extends CI_Model
{
    public function add_tracking_model($request_id, $status)
    {
        $data = array(
            'td_rsd_id' => decrypt_it($request_id),
            'td_status' => $status,
            'td_log' => date('Y-m-d H:i:s')
        );

        return $this->db->insert('track_data', $data);
    }

    public function get_all_tracking_id_model($customer_id)
    {
        $this->db->select('*');
        $this->db->from('repair_service_data');
        $this->db->where('rsd_cd_id', decrypt_it($customer_id));
        $this->db->where('rsd_progress IS NOT NULL');
        $this->db->order_by('rsd_status', 'DESC');
        $this->db->order_by('rsd_id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_latest_tracking_request_model($customer_id)
    {
        $data = $this->get_all_tracking_id_model($customer_id);

        if (!empty($data)) {
            $this->db->select('td_rsd_id');
            $this->db->from('track_data');
            $this->db->where('td_rsd_id', $data[0]['rsd_id']);
            $this->db->order_by('td_id', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
                $this->db->select('*');
                $this->db->from('track_data');
                $this->db->join('repair_service_data', 'rsd_id = td_rsd_id');
                $this->db->where('td_rsd_id', $result[0]['td_rsd_id']);
                $this->db->order_by('td_id', 'DESC');
                $query = $this->db->get();
            }
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function get_tracking_request_by_id_model($repair_id)
    {
        $this->db->select('*');
        $this->db->from('track_data');
        $this->db->join('repair_service_data', 'rsd_id = td_rsd_id');
        $this->db->join('staff_data', 'rsd_sd_id = sd_id');
        $this->db->where('td_rsd_id', decrypt_it($repair_id));
        $this->db->order_by('td_id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_runner_info_model($runner_id)
    {
        $this->db->select('*');
        $this->db->from('runner_data');
        $this->db->where('rd_id', $runner_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_technician_info_model($request_id)
    {
        $this->db->select('*');
        $this->db->from('repair_service_data');
        $this->db->join('staff_data', 'rsd_sd_id = sd_id');
        $this->db->where('rsd_id', $request_id);
        $query = $this->db->get();
        return $query->result_array();
    }
}
