<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Request_model');
        $this->load->model('Receive_model');
        $this->load->model('Stock_report_model');
        $this->load->library('form_validation');
    }
    public function receive() {
        $data['requests'] = $this->Request_model->get_all_requests();
        $data['produk'] = $this->Produk_model->get_all_produk();
        $data['title'] = 'Penerimaan Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    
        $this->form_validation->set_rules('no_invoice', 'No Invoice', 'required');
        $this->form_validation->set_rules('id_request', 'ID Request', 'required');
        $this->form_validation->set_rules('detail_pengirim', 'Detail Pengirim', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
    
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('inventory/receive', $data);
            $this->load->view('templates/footer');
        } else {
            $form_data = array(
                'no_invoice' => $this->input->post('no_invoice'),
                'id_request' => $this->input->post('id_request'),
                'detail_pengirim' => $this->input->post('detail_pengirim'),
                'tanggal' => $this->input->post('tanggal')
            );
    
            // Insert receive data
            $receive_id = $this->Receive_model->insertReceive($form_data);
    
            // Get request details
            $id_request = $this->input->post('id_request');
            $request_details = $this->Request_model->get_request_details($id_request);

            // Prepare data for stock report and save to database
            foreach ($request_details as $detail) {
                $stock_data = array(
                    'no_invoice' => $form_data['no_invoice'],
                    'nama_barang' => $detail['Nama_Barang'],
                    'qty' => $detail['Qty'],
                    'status' => 'in'
                );
                $this->Stock_report_model->save_stock_report($stock_data);
            }
    
            // Set flash message
            $this->session->set_flashdata('message', 'Data penerimaan berhasil disimpan.');
            redirect('inventory/stock_report');
        }
    }

    public function stockReport() {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Laporan Kartu Stock';
    
        $this->load->model('Request_model');
        $data['requested_products'] = $this->Request_model->get_all_requested_products();
        
        $filter_item = $this->input->get('filterProduct');
        $this->load->model('Stock_report_model');
        
        if ($filter_item) {
            $data['stock_reports'] = $this->Stock_report_model->get_stock_reports($filter_item);
        } else {
            $data['stock_reports'] = $this->Stock_report_model->get_all_stock_reports();
        }
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventory/stock_report', $data);
        $this->load->view('templates/footer');
    }
    public function get_all_requested_products() {
        $this->load->model('Request_model');
        $requested_products = $this->Request_model->get_all_requested_products();
        return $requested_products;
    }    
    public function get_request_details($id_request) {
        $this->load->model('Request_model');
        $request_details = $this->Request_model->get_request_details($id_request);
        echo json_encode($request_details);
    }
    

}    



?>