<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Stock_report_model');
        $this->load->model('Receive_model'); // Load model Receive_model untuk menyimpan penerimaan barang
        $this->load->model('Produk_model'); // Load model produk untuk mendapatkan daftar produk
        $this->load->library('form_validation');
    }

    public function receive()
    {
        $data['title'] = 'Form Penerimaan Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['products'] = $this->Produk_model->get_all_produk(); // Dapatkan daftar semua produk

        // Validasi form
        $this->form_validation->set_rules('no_invoice', 'No Invoice', 'required');
        $this->form_validation->set_rules('no_request_product', 'No Request Product', 'required');
        $this->form_validation->set_rules('detail_pengirim', 'Detail Pengirim', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('inventory/receive', $data);
            $this->load->view('templates/footer');
        } else {
            // Ambil data dari form
            $receive_data = array(
                'no_invoice' => $this->input->post('no_invoice'),
                'no_request_product' => $this->input->post('no_request_product'),
                'detail_pengirim' => $this->input->post('detail_pengirim'),
                'tanggal' => $this->input->post('tanggal'),
            );

            // Simpan data penerimaan barang
            $receive_id = $this->Receive_model->insertReceive($receive_data);

            // Ambil data detail penerimaan barang (looping dari form tabel)
            $receive_details = array();
            $id_invoice_obat_details = $this->input->post('id_invoice_obat_detail');
            $nama_items = $this->input->post('nama_item');
            $qtys = $this->input->post('qty');
            $hargas = $this->input->post('harga');
            $totals = $this->input->post('total');

            for ($i = 0; $i < count($id_invoice_obat_details); $i++) {
                $receive_details[] = array(
                    'receive_id' => $receive_id,
                    'id_invoice_obat_detail' => $id_invoice_obat_details[$i],
                    'nama_item' => $nama_items[$i],
                    'qty' => $qtys[$i],
                    'harga' => $hargas[$i],
                    'total' => $totals[$i]
                );
            }

            // Simpan detail penerimaan barang
            foreach ($receive_details as $detail) {
                $this->Receive_model->insertReceiveDetail($detail);
            }

            // Redirect atau set flashdata success message
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penerimaan barang berhasil disimpan!</div>');
            redirect('inventory/receive');
        }
    }

    public function stock_report()
    {
        $data['title'] = 'Form Laporan Persediaan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['products'] = $this->Produk_model->get_all_produk(); // Dapatkan daftar semua produk

        $filter_item = $this->input->get('filter_item');
        if ($filter_item) {
            $data['stock_reports'] = $this->Stock_report_model->get_stock_reports_by_item($filter_item);
        } else {
            $data['stock_reports'] = $this->Stock_report_model->get_all_stock_reports();
        }

        // Load views
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventory/stock_report', $data);
        $this->load->view('templates/footer');
    }
}
?>
