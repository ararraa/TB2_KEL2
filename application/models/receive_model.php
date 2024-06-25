<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receive_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insertReceive($data) {
        $this->db->insert('receive', $data);
        return $this->db->insert_id();
    }

    public function insertReceiveDetail($detail) {
        $this->db->insert('receive_details', $detail);
    }

}
?>
