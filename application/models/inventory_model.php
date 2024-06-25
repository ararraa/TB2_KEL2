<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load dependencies atau lakukan inisialisasi jika diperlukan
    }

    public function save_stock_report($data) {
        // Metode untuk menyimpan data laporan persediaan stock ke database
        $data_to_insert = array(
            'no_invoice' => $data['no_invoice'],
            'no_request_product' => $data['no_request_product'],
            'detail_pengirim' => $data['detail_pengirim'],
            'tanggal' => $data['tanggal']
            // Sesuaikan dengan struktur tabel dan data lain yang ingin disimpan
        );

        // Simpan data ke dalam tabel 'stock_reports'
        $this->db->insert('stock_reports', $data_to_insert);
        foreach ($data['details'] as $detail) {
            $this->update_product_quantity($detail['no_item'], $detail['qty']);
        }
    }
    
    private function update_product_quantity($no_item, $qty) {
        // Update quantity produk di tabel 'produk'
        $this->db->set('qty', 'qty + ' . $qty, FALSE);
        $this->db->where('no_item', $no_item);
        $this->db->update('produk');
    }
    }



    // Metode lain untuk mengambil atau memanipulasi data lain terkait stok
