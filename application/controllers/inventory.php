<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the models
        $this->load->model('Stock_report_model');
        $this->load->model('Produk_model'); // Load Produk_model untuk mengupdate stok
        $this->load->library('form_validation');
    }

    public function stock_report()
    {
        $data['title'] = 'Form Laporan Persediaan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['stock_reports'] = $this->Stock_report_model->get_all_stock_reports();

        // Load views
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventory/stock_report', $data); // Pastikan file ini ada
        $this->load->view('templates/footer');
    }

    public function process_stock_report()
    {
        // Validasi form
        $this->form_validation->set_rules('no_invoice', 'No Invoice', 'required');
        // Tambahkan aturan validasi untuk field lainnya

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembali ke halaman penerimaan barang
            $this->stock_report();
        } else {
            // Data untuk disimpan ke tabel penerimaan_barang
            $data_penerimaan = array(
                'no_invoice' => $this->input->post('no_invoice'),
                'no_request_product' => $this->input->post('no_request_product'),
                'detail_pengirim' => $this->input->post('detail_pengirim'),
                'tanggal' => $this->input->post('tanggal')
                // Tambahkan field lainnya sesuai kebutuhan
            );

            // Simpan data penerimaan ke database
            $this->Stock_report_model->insert_stock_report($data_penerimaan);

            // Loop untuk mengupdate stok produk di Produk_model
            $items = $this->input->post('nama_item');
            foreach ($items as $key => $item) {
                $detail_penerimaan = array(
                    'id_invoice_obat_detail' => $this->input->post('id_invoice_obat_detail')[$key],
                    'nama_item' => $item,
                    'qty' => $this->input->post('qty')[$key],
                    'harga' => $this->input->post('harga')[$key],
                    'total' => $this->input->post('total')[$key]
                );

                // Simpan detail penerimaan ke database
                $this->Stock_report_model->insert_detail_stock_report($detail_penerimaan);

                // Update stok produk di Produk_model
                $this->Produk_model->update_qty($item, $detail_penerimaan['qty']);
            }

            // Set pesan sukses untuk ditampilkan ke user
            $this->session->set_flashdata('message', 'Barang berhasil diterima dan stok berhasil diperbarui.');

            // Redirect ke halaman laporan persediaan atau halaman lain yang sesuai
            redirect('inventory/stock_report');
        }
    }
}
