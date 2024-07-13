<?php
class Stock_report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save_stock_report($data) {
        $this->db->insert('stock_report', $data);
    }

    public function get_all_stock_reports() {
        $query = $this->db->get('stock_report');
        return $query->result_array();
    }

    public function get_stock_reports($filter_product) {
        $this->db->where('nama_barang', $filter_product);
        $query = $this->db->get('stock_report');
        return $query->result_array();
    }
}
?>
