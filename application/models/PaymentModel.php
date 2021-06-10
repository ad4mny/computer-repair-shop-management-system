<?php

class PaymentModel extends CI_Model
{
    public function get_existing_payment_model($service_id)
    {
        $this->db->select('pd_rsd_id');
        $this->db->from('payment_data');
        $this->db->where('pd_rsd_id', decrypt_it($service_id));
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function add_transaction_model($paypal_return)
    {
        $data = array(
            'pd_cd_id' => decrypt_it($paypal_return["custom"]),
            'pd_rsd_id' => decrypt_it($paypal_return["item_number"]),
            'pd_payment_gross' => $paypal_return["mc_gross"],
            'pd_status' => $paypal_return["payment_status"],
            'pd_log' => date('Y-m-d H:i:s')
        );

        return $this->db->insert('payment_data', $data);
    }

    public function set_request_ongoing_model($request_id)
    {
        $data = array(
            'rsd_progress' => 1,
            'rsd_comment' => 'Repairing',
            'rsd_log' => date('Y-m-d H:i:s')
        );

        $this->db->where('rsd_id', decrypt_it($request_id));
        return $this->db->update('repair_service_data', $data);
    }

}
