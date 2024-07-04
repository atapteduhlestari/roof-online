<?php
class Model_candidates extends CI_Model
{
    public $_table = 'candidates';
    public function insertDataCandidate($data)
    {
        $this->db->insert($this->_table, $data);
    }
}
