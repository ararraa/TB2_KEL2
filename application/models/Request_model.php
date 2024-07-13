 
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request_model extends CI_Model
{
    public function get_all_unique_product_names() {
        $this->db->distinct();
        $this->db->select('Nama_Barang');
        $query = $this->db->get('request_details');
        return $query->result_array();
    }

    public function get_all_requested_products() {
        $this->db->select('DISTINCT(Nama_Barang)');
        $this->db->from('request_details'); // assuming the table name is 'request_details'
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    public function get_all_requests()
    {
        $this->db->select('requests.ID_Request, requests.No_Request_Detail, user.name, requests.Tanggal');
        $this->db->from('requests');
        $this->db->join('user', 'requests.user_id = user.id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_request_details($id_request)
    {
        $this->db->select('request_details.ID_Request_Detail, request_details.ID_Request, request_details.No_Item, request_details.Nama_Barang, request_details.Qty');
        $this->db->from('request_details');
        $this->db->where('request_details.ID_Request', $id_request);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_requests($id_request)
    {
        $this->db->where('ID_Request', $id_request);
        $query = $this->db->get('requests');
        return $query->row_array();
    }
}
?>
