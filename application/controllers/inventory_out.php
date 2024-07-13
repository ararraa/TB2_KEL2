<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_Out extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Inventory_Out_Model');
        $this->load->model('Stock_report_model');
        $this->load->model('Produk_model');
    }

    public function index() {
        $data['title'] = 'Inventory Keluar';
        $data['inventory_out'] = $this->Inventory_Out_Model->get_all_inventory_out();
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventory_out/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['title'] = 'Tambah Inventory Keluar';
        $data['produk'] = $this->Produk_model->get_all_produk();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventory_out/create', $data);
        $this->load->view('templates/footer');
    }

    public function store() {
        $data = [
            'no_invoice' => $this->input->post('no_invoice'),
            'nama_barang' => $this->input->post('nama_barang'),
            'qty' => -abs($this->input->post('qty')), // Make sure qty is negative
            'date_out' => date('Y-m-d H:i:s')
        ];
    
        if ($data['nama_barang'] !== NULL) {
            $this->Inventory_Out_Model->insert($data);
    
            // Insert into stock report
            $stock_data = [
                'no_invoice' => $data['no_invoice'],
                'nama_barang' => $data['nama_barang'],
                'qty' => $data['qty'],
                'status' => 'out'
            ];
            $this->Stock_report_model->save_stock_report($stock_data);
    
            $this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
            redirect('inventory_out');
        } else {
            $this->session->set_flashdata('error', 'Nama Barang is required.');
            redirect('inventory_out/create');
        }
    }
    

    // Other methods remain the same
}
?>
