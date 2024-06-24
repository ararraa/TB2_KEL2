<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_report_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function insertStockReport($data) {
        $this->db->insert('stock_report', $data);
    }

    // Tambahkan metode lain yang diperlukan
}