<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load necessary models, helpers, etc.
        $this->load->model('Request_model'); // Load Request_model
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

        // Fetch the form requests data
        $data['requests'] = $this->Request_model->get_all_requests();

        // Fetch users for dropdown
        $data['users'] = $this->db->get('user')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventory/request_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detail($id_request)
    {
        // Load necessary data from models, e.g., Request_model
        $data['request_details'] = $this->Request_model->get_request_details($id_request);
        $data['title'] = 'Detail Permintaan Barang';

        // Load views
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventory/request_detail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function continueRequest($id_request)
    {
        // Implement continuation logic, e.g., redirect to another form or action
        redirect('some/other/action'); // Replace with your logic
    } 

    public function get_request_details($id_request)
    {
        $data['request_details'] = $this->Request_model->get_request_details($id_request); // Fetch request details by ID_Request
        echo json_encode($data['request_details']); // Return JSON response
    }

    public function stockReport()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Laporan Kartu Stock';

        $filter_item = $this->input->get('filter_item');
        $data['stock_reports'] = $this->Stock_report_model->get_all_stock_reports();
        if ($filter_item) {
            $data['stock_reports'] = $this->Stock_report_model->get_stock_reports($filter_item);
        }
        $this->load->view('inventory/stock_report', $data);
    }
}
?>
