<?php
class ProfileModel extends CI_Model
{
    public function get_profile_info_model($user_id)
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('runner_data', 'rd_ud_id = ud_id');
        $this->db->where('ud_id', decrypt_it($user_id));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function set_profile_update_model($user_id, $username, $picture, $full_name, $contact_number, $plat_num)
    {
        if ($picture !== NULL) {
            $data = array(
                'ud_usr' => $username,
                'ud_pic' => $picture,
                'ud_log' => date('Y-m-d H:i:s ')
            );
        } else {
            $data = array(
                'ud_usr' => $username,
                'ud_log' => date('Y-m-d H:i:s ')
            );
        }
        
        $this->db->where('ud_id', decrypt_it($user_id));
        $this->db->update('user_data', $data);

        $data = array(
            'rd_full_name' => $full_name,
            'rd_phone' => $contact_number,
            'rd_plat_num' => $plat_num
        );

        $this->db->where('rd_ud_id', decrypt_it($user_id));
        return $this->db->update('runner_data', $data);
    }

    public function set_password_change_model($user_id, $old_password, $password)
    {
        $this->db->select('ud_pwd');
        $this->db->from('user_data');
        $this->db->where('ud_id', decrypt_it($user_id));
        $result = $this->db->get()->row();

        if (md5($old_password) == $result->ud_pwd) {
            $data = array(
                'ud_pwd' => md5($password),
                'ud_log' => date('Y-m-d H:i:s ')
            );

            $this->db->where('ud_id', decrypt_it($user_id));
            return $this->db->update('user_data', $data);
        } else {
            return false;
        }
    }

    public function deactivate_account_model($user_id, $password)
    {
        $this->db->select('ud_pwd, ud_pic');
        $this->db->from('user_data');
        $this->db->where('ud_id', decrypt_it($user_id));
        $result = $this->db->get()->row();

        if (md5($password) == $result->ud_pwd) {

            $data = array(
                'ud_id' => decrypt_it($user_id)
            );
            
            if ($result->ud_pic != NULL) {
                unlink(base_url() . $result->ud_pic);
            }

            return $this->db->delete('user_data', $data);
        } else {
            return false;
        }
    }
}
