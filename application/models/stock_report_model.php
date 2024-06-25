<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_report_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insertStockReport($data) {
        $this->db->insert('stock_report', $data);
    }


    public function get_all_stock_reports() {
        return $this->db->get('stock_report')->result_array();
    }

    public function get_stock_reports($nama_barang = null) {
        if ($nama_barang) {
            $this->db->where('nama_barang', $nama_barang);
        }
        return $this->db->get('stock_report')->result_array();
    }

    public function save_stock_report($data) {
        $this->db->insert('stock_report', $data);
    }

}
?>
