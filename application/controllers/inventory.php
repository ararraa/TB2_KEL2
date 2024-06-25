<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the model
        $this->load->model('Stock_report_model');
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
}
