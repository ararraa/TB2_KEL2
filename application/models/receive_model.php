<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receive_model extends CI_Model
{
    public function insertReceive($data)
    {
        $this->db->insert('receive', $data);
        return $this->db->insert_id();
    }

    public function insertReceiveDetail($data)
    {
        $this->db->insert('receive_detail', $data);
    }
}
