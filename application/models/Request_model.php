<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request_model extends CI_Model
{
    public function get_all_requests()
    {
        $this->db->select('request_produk.*, user.name as Username');
        $this->db->from('request_produk');
        $this->db->join('user', 'user.id = request_produk.User_ID');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_requests_user()
    {
        $this->db->select('request_produk.*, user.name as Username');
        $this->db->from('request_produk');
        $this->db->join('user', 'user.id = request_produk.User_ID');
        $this->db->where('request_produk.status', 'continued'); // Filter by status
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_request_status($id_request, $status)
    {
        $this->db->set('status', $status);
        $this->db->where('ID_Request', $id_request);
        $this->db->update('request_produk');
    }

    public function get_request($id_request)
    {
        $this->db->where('ID_Request', $id_request);
        $query = $this->db->get('request_produk');
        return $query->row_array();
    }


    public function get_request_details($id_request)
    {
        $this->db->where('ID_Request', $id_request);
        $query = $this->db->get('request_detail');
        return $query->result_array();
    }
}


?>
