<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load necessary models, helpers, etc. 
        $this->load->model('Menu_model'); // Make sure you have a User model to fetch user data
        $this->load->model('Request_model');
        $this->load->helper('url'); // For base_url()
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'My Profile';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function requestForm()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Form Permintaan Barang';

        $data['requests'] = $this->Request_model->get_all_requests(); // Get all requests

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventory/request_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function continueRequest($id_request)
{
    // Misalnya mengubah status permintaan menjadi 'continued'
    $this->Request_model->update_request_status($id_request, 'continued');

    $this->session->set_flashdata('message', 'Form permintaan berhasil diteruskan.');

    redirect('admin/requestForm'); // Redirect kembali ke halaman admin
}




    public function detail($id_request)
{
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['title'] = 'Detail Permintaan';

    $this->load->model('Request_model');
    $data['request_details'] = $this->Request_model->get_request_details($id_request);

    $data['request'] = $this->Request_model->get_request($id_request);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('inventory/request_detail', $data);
    $this->load->view('templates/footer', $data);
}


    public function receive()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Penerimaan Barang';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventory/receive', $data);
        $this->load->view('templates/footer', $data);
    }

    public function insert_receive($data) {
        $this->db->insert('receive', $data);
        return $this->db->insert_id(); // Return the ID of the inserted row
    }
    

    public function products()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Produk Barang (Obat)';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventory/products', $data);
        $this->load->view('templates/footer', $data);
    }

    public function stockReport()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Laporan Kartu Stock';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('reports/stock_report', $data);
        $this->load->view('templates/footer', $data);
    }
}
?>