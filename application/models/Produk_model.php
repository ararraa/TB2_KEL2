<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

    public function get_all_produk() {
        return $this->db->get('produk')->result();
    }

    public function insert_produk($data) {
        return $this->db->insert('produk', $data);
    }

    public function get_produk_by_no_item($no_item) {
        return $this->db->get_where('produk', array('no_item' => $no_item))->row();
    }

    public function update_produk($no_item, $data) {
        $this->db->where('no_item', $no_item);
        return $this->db->update('produk', $data);
    }

    public function delete_produk($no_item) {
        $this->db->where('no_item', $no_item);
        return $this->db->delete('produk');
    }

    public function get_produk_by_id($id) {
        return $this->db->get_where('produk', array('id' => $id))->row();
    }

     public function get_produk_by_id_request($id_request) {
        $this->db->select('produk.*');
        $this->db->from('produk');
        $this->db->join('request_detail', 'produk.no_item = request_detail.no_item');
        $this->db->where('request_detail.ID_Request', $id_request);
        return $this->db->get()->result();
    }
}
?>
