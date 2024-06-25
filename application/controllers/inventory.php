<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Stock_report_model');
        $this->load->model('Receive_model');
        $this->load->model('Produk_model');
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
            // Validasi form gagal, tampilkan kembali form dengan pesan error
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('inventory/receive', $data);
            $this->load->view('templates/footer');
        } else {
            // Validasi berhasil, proses penyimpanan data
            $receive_data = array(
                'no_invoice' => $this->input->post('no_invoice'),
                'no_request_product' => $this->input->post('no_request_product'),
                'detail_pengirim' => $this->input->post('detail_pengirim'),
                'tanggal' => $this->input->post('tanggal')
                // Tambahkan field lainnya sesuai kebutuhan
            );

            // Simpan data penerimaan
            $receive_id = $this->Receive_model->insertReceive($receive_data);

            // Ambil detail penerimaan dari input form
            $receive_details = array();
            $nama_barang = $this->input->post('nama_barang');
            $qty = $this->input->post('qty');
            $harga = $this->input->post('harga');
            $total = $this->input->post('total');

            // Buat array untuk setiap detail penerimaan
            for ($i = 0; $i < count($nama_barang); $i++) {
                $receive_details[] = array(
                    'id_receive' => $receive_id,
                    'nama_barang' => $nama_barang[$i],
                    'qty' => $qty[$i],
                    'harga' => $harga[$i],
                    'total' => $total[$i]
                    // Tambahkan field lainnya sesuai kebutuhan
                );
            }

            // Simpan detail penerimaan
            foreach ($receive_details as $detail) {
                $this->Receive_model->insertReceiveDetail($detail);
                
                // Simpan juga ke laporan persediaan (stock report)
                $stock_report_data = array(
                    'nama_barang' => $detail['nama_barang'],
                    'no_invoice' => $receive_data['no_invoice'],
                    'detail_pengirim_penerima' => $receive_data['detail_pengirim'],
                    'barang_masuk' => $detail['qty'],
                    'tanggal' => $receive_data['tanggal']
                    // Pastikan field lainnya sesuai dengan kebutuhan stock report
                );

                $this->Stock_report_model->save_stock_report($stock_report_data);
            }

            // Set pesan sukses untuk ditampilkan di halaman selanjutnya
            $this->session->set_flashdata('message', 'Penerimaan barang berhasil disimpan.');

            // Redirect ke halaman atau lakukan operasi lain setelah berhasil
            redirect('inventory/receive');
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
        $this->form_validation->set_rules('no_invoice', 'No Invoice', 'required');
        // Tambahkan aturan validasi untuk field lainnya sesuai kebutuhan

        if ($this->form_validation->run() == false) {
            // Jika validasi gagal, kembali ke halaman laporan persediaan
            $this->stock_report();
        } else {
            // Proses penyimpanan laporan persediaan
            // ...
        }
    }
}
?>
