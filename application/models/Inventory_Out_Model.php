

<?php
class Inventory_Out_Model extends CI_Model {

    public function insert($data) {
        $this->db->insert('inventory_out', $data);
    }

    public function get_all_inventory_out() {
        $query = $this->db->get('inventory_out');
        return $query->result();
    }
}
?>