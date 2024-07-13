<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receive_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function insertReceive($data) {
        $this->db->insert('receive', $data);
        return $this->db->insert_id(); // Return the insert ID if needed
    }
    

    public function insertReceiveDetail($detail) {
        $this->db->insert('receive', $detail);
    }

    public function save_receive_data($data, $details) {
        $this->db->trans_start();

        $receive_id = $this->insertReceive($data);

        foreach ($details as $detail) {
            $detail['id_receive'] = $receive_id;
            $this->insertReceiveDetail($detail);
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}
?>
