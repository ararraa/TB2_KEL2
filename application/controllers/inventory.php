<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
<<<<<<< HEAD
        // Load the models
        $this->load->model('Stock_report_model');
        $this->load->model('Produk_model'); // Load Produk_model untuk mengupdate stok
=======
        $this->load->model('Stock_report_model');
        $this->load->model('Receive_model'); 
        $this->load->model('Produk_model'); 
>>>>>>> ecd8e536eb55b510d0b133fe2602af2a08b1f25f
        $this->load->library('form_validation');
    }

    public function receive()
    {
        $data['title'] = 'Form Penerimaan Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['products'] = $this->Produk_model->get_all_produk();

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
            $receive_data = array(
                'no_invoice' => $this->input->post('no_invoice'),
                'no_request_product' => $this->input->post('no_request_product'),
                'detail_pengirim' => $this->input->post('detail_pengirim'),
                'tanggal' => $this->input->post('tanggal'),
            );

            $receive_id = $this->Receive_model->insertReceive($receive_data);

            $receive_details = array();
            $id_invoice_obat_details = $this->input->post('id_invoice_obat_detail');
            $nama_barangs = $this->input->post('nama_barang'); // Ubah name menjadi nama_barang
            $qtys = $this->input->post('qty');
            $hargas = $this->input->post('harga');
            $totals = $this->input->post('total');

            for ($i = 0; $i < count($id_invoice_obat_details); $i++) {
                $receive_details[] = array(
                    'receive_id' => $receive_id,
                    'id_invoice_obat_detail' => $id_invoice_obat_details[$i],
                    'nama_barang' => $nama_barangs[$i],
                    'qty' => $qtys[$i],
                    'harga' => $hargas[$i],
                    'total' => $totals[$i]
                );
            }

            foreach ($receive_details as $detail) {
                $this->Receive_model->insertReceiveDetail($detail);
            }

            foreach ($receive_details as $detail) {
                $stock_report_data = array(
                    'nama_barang' => $detail['nama_barang'],
                    'no_invoice' => $detail['no_invoice'],
                    'no_penjualan' => $detail['no_penjualan'],
                    'detail_pengirim_penerima' => $detail['detail_pengirim'],
                    'barang_masuk' => $detail['qty'],
                    'tanggal' => $detail['tanggal']
                );

                $this->Stock_report_model->save_stock_report($stock_report_data);
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penerimaan barang berhasil disimpan dan masuk ke laporan kartu stock!</div>');
            redirect('inventory/stock_report');
        }
    }

    public function stock_report()
    {
        $data['title'] = 'Form Laporan Persediaan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['products'] = $this->Produk_model->get_all_produk(); 

        $filter_item = $this->input->get('filter_item');
        if ($filter_item) {
            $data['stock_reports'] = $this->Stock_report_model->get_stock_reports_by_item($filter_item);
        } else {
            $data['stock_reports'] = $this->Stock_report_model->get_all_stock_reports();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventory/stock_report', $data);
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
