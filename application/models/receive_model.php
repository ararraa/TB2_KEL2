<?php
defined('BASEPATH') OR exit('No direct script access allowed');

<<<<<<< HEAD
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
=======
class Receive_model extends CI_Model
{
    public function insertReceive($data)
    {
        $this->db->insert('receive', $data);
        return $this->db->insert_id();
    }

    public function insertReceiveDetail($data)
    {
        $this->db->insert('receive_detail', $data);
    }
}
>>>>>>> ecd8e536eb55b510d0b133fe2602af2a08b1f25f
