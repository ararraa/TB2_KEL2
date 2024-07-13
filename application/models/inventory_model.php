

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('Stock_report_model');
        $this->load->model('Produk_model');
        $this->load->model('Request_model'); // Load model produk untuk mendapatkan daftar produk
        $this->load->library('form_validation');
    }

    public function stock_report() {
        $data['title'] = 'Laporan Kartu Stock';
        $data['produk'] = $this->Produk_model->get_all_produk(); // Gantilah dengan pemanggilan model dan metode yang sesuai
        $nama_barang = $this->input->post('nama_barang');

        $this->load->model('Stock_report_model');
        $data['stock_reports'] = $this->Stock_report_model->get_stock_reports($Nama_Barang);
        $this->load->model('Produk_model');
        $data['produk'] = $this->Produk_model->get_all_produk();
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventory/stock_report', $data);
        $this->load->view('templates/footer');
    }
    
    public function get_request_details($id_request)
    {
        $this->db->select('request_details.ID_Request_Detail, request_details.ID_Request, request_details.No_Item, request_details.Nama_Barang, request_details.Qty');
        $this->db->from('request_details');
        $this->db->where('request_details.ID_Request', $id_request);
        $query = $this->db->get();
        return $query->result_array();
    }


    }