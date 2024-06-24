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

    public function get_request_details($id_request)
    {
        $this->db->where('ID_Request', $id_request);
        $query = $this->db->get('request_detail');
        return $query->result_array();
    }

    public function get_request($id_request)
    {
        $this->db->where('ID_Request', $id_request);
        $query = $this->db->get('request_produk');
        return $query->row_array();
    }
}

?>