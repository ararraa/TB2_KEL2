<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Produk_model extends CI_Model {

    public function get_all_produk() {
        $query = $this->db->get('produk');
        return $query->result();
    }

    public function get_produk_by_no_item($no_item) {
        $query = $this->db->get_where('produk', array('no_item' => $no_item));
        return $query->row();
    }

    public function insert_produk($data) {
        $this->db->insert('produk', $data);
    }

    public function update_produk($no_item, $data) {
        $this->db->where('no_item', $no_item);
        $this->db->update('produk', $data);
    }

    public function delete_produk($no_item) {
        $this->db->where('no_item', $no_item);
        $this->db->delete('produk');
    }

    public function get_produk_by_id($id) {
        return $this->db->get_where('produk', ['id' => $id])->row();
    }
}
