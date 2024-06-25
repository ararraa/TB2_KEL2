<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
    }

    public function index() {
        // Ambil data pengguna dari session atau database


        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Daftar Produk';
        $data['produk'] = $this->Produk_model->get_all_produk();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('produk/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        // Ambil data pengguna dari session atau database
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Tambah Produk';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('produk/create');
        $this->load->view('templates/footer');
    }
    
    public function store() {
        $data = array(
            'no_item' => $this->input->post('no_item'),
            'nama_barang' => $this->input->post('nama_barang'),
            'qty' => $this->input->post('qty')  // Menambah quantity dari input post
        );
    
        // Validasi jika quantity kosong
        $quantity = $this->input->post('qty');
        if (!$quantity) {
            // Jika quantity NULL, redirect kembali ke halaman create dengan pesan error
            $this->session->set_flashdata('error', 'Quantity harus diisi');
            redirect('produk/create');
            return; // Jangan lupa return setelah redirect
        }

        $this->Produk_model->insert_produk($data);

        // Redirect ke halaman index produk setelah berhasil menyimpan
        redirect('produk/index');
    }
    

    public function edit($no_item) {
        // Ambil data pengguna dari session atau database

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Edit Produk';
        $data['produk'] = $this->Produk_model->get_produk_by_no_item($no_item);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('produk/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update() {
        $no_item = $this->input->post('no_item');
        $data = array(
            'nama_barang' => $this->input->post('nama_barang')
        );
        $this->Produk_model->update_produk($no_item, $data);
        redirect('produk/index');
    }

    public function delete($no_item)
    {
        // Load model
        $this->load->model('Produk_model');
        // Panggil method untuk menghapus produk berdasarkan no_item
        $this->Produk_model->delete_produk($no_item);
        // Redirect kembali ke halaman daftar produk setelah penghapusan
        redirect('produk/index');
    }

    public function detail($id)
    {
    
        $data['title'] = 'Detail Produk';
        $data['produk'] = $this->Produk_model->get_produk_by_id($id);
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('produk/detail', $data);
        $this->load->view('templates/footer', $data);
    }
}