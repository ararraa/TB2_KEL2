<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receive_model extends CI_Model {

    public function insert_stock_report($data) {
        $this->db->insert('stock_reports', $data);
        return $this->db->insert_id();
    }

    public function insert_detail_stock_report($data) {
        $this->db->insert_batch('detail_stock_reports', $data);
    }

    public function update_qty($nama_barang, $qty) {
        // Memanggil Produk_model untuk mengupdate qty
        $this->load->model('Produk_model');
        $this->Produk_model->update_qty($nama_barang, $qty);
    }

}
?>
