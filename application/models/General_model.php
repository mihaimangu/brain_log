<?php

class General_model extends CI_Model
{

    public function write_general($table, $params)
	{

		$this->db->insert($table, $params);

	}

}