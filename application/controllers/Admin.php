
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load necessary models, helpers, etc.
        $this->load->model('Menu_model'); // Make sure you have a User model to fetch user data
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

    // Load the Request_model
    $this->load->model('Request_model');
    
    // Fetch the form requests data
    $data['requests'] = $this->Request_model->get_all_requests();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('inventory/request_form', $data);
    $this->load->view('templates/footer', $data);
}


    public function permintaan()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Penerimaan Barang';

        // Restrict access based on user role
        if ($data['user']['role_id'] != 1) {
            // Redirect to a "no access" page or show an error message
            redirect('no_access');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('request/form_permintaan', $data);
        $this->load->view('templates/footer', $data);
    }

    public function produk()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Produk Barang (Obat)';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('produk/index', $data);
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

