
<?php
class Stock_report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save_stock_report($data) {
        $this->db->insert('stock_report', $data); // Adjust if your table name differs
    }

    public function get_all_stock_reports() {
        $query = $this->db->get('stock_report');
        return $query->result_array();
    }
    public function get_stock_reports($filter_product) {
        $this->db->select('Nama_Barang, no_invoice, SUM(Qty) as Total_Qty');
        $this->db->from('stock_report');
        $this->db->where('Nama_Barang', $filter_product);
        $this->db->group_by('no_invoice, Nama_Barang, Qty, status');
        $query = $this->db->get();
        return $query->result_array();
    }
    }
    

?>