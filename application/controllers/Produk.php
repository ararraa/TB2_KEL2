
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Inventory_Out_Model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Daftar Produk';
        $data['produk'] = $this->Produk_model->get_all_produk();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['inventory_out'] = $this->Inventory_Out_Model->get_all_inventory_out(); // Ambil data inventory_out

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data); // Pastikan variabel $user ada di sini
        $this->load->view('produk/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['title'] = 'Tambah Produk';

        $this->form_validation->set_rules('no_item', 'No Item', 'required|is_unique[produk.no_item]');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('produk/create', $data);
            $this->load->view('templates/footer');
        } else {
            $data_produk = array(
                'no_item' => $this->input->post('no_item'),
                'nama_barang' => $this->input->post('nama_barang'),
            );
            $this->Produk_model->insert_produk($data_produk);
            $this->session->set_flashdata('message', 'Produk berhasil ditambahkan');
            redirect('produk/index');
        }
    }

    public function edit($no_item) {
        $data['title'] = 'Edit Produk';
        $data['produk'] = $this->Produk_model->get_produk_by_no_item($no_item);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if (empty($data['produk'])) {
            show_404();
        }

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('produk/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data_produk = array(
                'nama_barang' => $this->input->post('nama_barang'),
            );
            $this->Produk_model->update_produk($no_item, $data_produk);
            $this->session->set_flashdata('message', 'Produk berhasil diperbarui');
            redirect('produk/index');
        }
    }

    public function delete($no_item) {
        $this->Produk_model->delete_produk($no_item);
        $this->session->set_flashdata('message', 'Produk berhasil dihapus');
        redirect('produk/index');
    }
}
?>