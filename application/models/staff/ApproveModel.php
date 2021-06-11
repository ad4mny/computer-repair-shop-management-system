<?php
class ApproveModel extends CI_Model
{
    public function get_pending_staff_model()
    {
        $this->db->select('*');
        $this->db->from('staff_data');
        $this->db->where('sd_status');
        return $this->db->get()->result_array();
    }

    public function get_pending_runner_model()
    {
        $this->db->select('*');
        $this->db->from('runner_data');
        $this->db->where('rd_status');
        return $this->db->get()->result_array();
    }

    public function set_accept_user_model($user_id, $role)
    {
        if (decrypt_it($role) === '2') {

            $data = array(
                'sd_status' => 1,
            );

            $this->db->where('sd_id', decrypt_it($user_id));
            return $this->db->update('staff_data', $data);
        } else {

            $data = array(
                'rd_status' => 1,
            );

            $this->db->where('rd_id', decrypt_it($user_id));
            return $this->db->update('runner_data', $data);
        }
    }

    public function set_reject_user_model($user_id, $role)
    {
        if (decrypt_it($role) === '2') {
            $this->db->where('sd_id', decrypt_it($user_id));
            return $this->db->delete('staff_data');
        } else {
            $this->db->where('rd_id', decrypt_it($user_id));
            return $this->db->delete('runner_data');
        }
    }
}
