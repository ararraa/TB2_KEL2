<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

    public function get_all_produk() {
        $this->db->select('*');
        $this->db->from('produk');
        $query = $this->db->get();
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

    public function get_all_produk_with_quantity() {
        $query = $this->db->query("SELECT p.no_item, p.nama_barang, IFNULL(qty.quantity, 0) AS quantity
                                  FROM produk p
                                  LEFT JOIN (
                                      SELECT no_item, SUM(qty) AS qty
                                      FROM penerimaan_barang
                                      GROUP BY no_item
                                  ) AS qty ON p.no_item = qty.no_item");
        return $query->result();
    }

    public function update_qty($nama_barang, $qty) {
        $this->db->set('qty', 'qty + ' . $qty, FALSE);
        $this->db->where('nama_barang', $nama_barang);
        $this->db->update('produk');
    }
}
