<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan_model extends CI_Model
{
    public function get_all_requests()
    {
        $query = $this->db->get('requests'); // Assuming your table name is 'requests'
        return $query->result_array();
    }
}
?>