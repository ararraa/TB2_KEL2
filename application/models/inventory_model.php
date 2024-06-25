<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('Stock_report_model');
        $this->load->model('Produk_model'); // Load model produk untuk mendapatkan daftar produk
        $this->load->library('form_validation');
    }

    public function stock_report() {
        $data['title'] = 'Laporan Kartu Stock';
        $data['produk'] = $this->Produk_model->get_all_produk(); // Gantilah dengan pemanggilan model dan metode yang sesuai
        $nama_barang = $this->input->post('nama_barang');
        $this->load->model('Stock_report_model');
        $data['stock_reports'] = $this->Stock_report_model->get_stock_reports($nama_barang);
        $this->load->model('Produk_model');
        $data['produk'] = $this->Produk_model->get_all_produk();
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventory/stock_report', $data);
        $this->load->view('templates/footer');
    }
    
    
    private function update_product_quantity($no_item, $qty) {
        // Update quantity produk di tabel 'produk'
        $this->db->set('qty', 'qty + ' . $qty, FALSE);
        $this->db->where('no_item', $no_item);
        $this->db->update('produk');
    }
    }



    // Metode lain untuk mengambil atau memanipulasi data lain terkait stok
