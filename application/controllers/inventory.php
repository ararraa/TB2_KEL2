<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the model
        $this->load->model('Inventory_model');
        $this->load->library('form_validation');
    }

    public function receive()
    {
        $data['title'] = 'Penerimaan Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Get receipt details using Inventory_model method
        $data['receipt_details'] = $this->Inventory_model->get_receipt_details();

        // Load views
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventory/receive', $data);
        $this->load->view('templates/footer', $data);
    }

    public function stock_report()
    {
        // Validasi form jika diperlukan
        $this->form_validation->set_rules('no_invoice', 'No Invoice', 'required');
        $this->form_validation->set_rules('no_request_product', 'No Request Product', 'required');
        $this->form_validation->set_rules('detail_pengirim', 'Detail Pengirim', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan kembali halaman form dengan pesan error
            $data['title'] = 'Form Laporan Persediaan';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('inventory/stock_report', $data);
            $this->load->view('templates/footer');
        } else {
            // Jika validasi berhasil, simpan data ke dalam database atau lakukan operasi lainnya
            // Contoh penyimpanan data ke model (disesuaikan dengan struktur aplikasi Anda)
            $this->Inventory_model->save_stock_report($this->input->post());
            
            // Tampilkan pesan sukses menggunakan flashdata
            $this->session->set_flashdata('message', 'Data penerimaan berhasil disimpan');
            redirect('inventory/stock_report'); // Redirect kembali ke halaman ini atau halaman lain
        }
    }
}
