<?php

class General_model extends CI_Model
{

    public function write_general($table, $params)
	{

		$this->db->insert($table, $params);

	}
    
    public function add_feeling($data)
    {
        
        $data['time'] = time();
        
        $this->db->insert('logs', $data);
        
    }
    
    public function get_feelings()
    {
        
        $where = array('user_id' => 1);
        
        $this->db->where($where);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('logs');
        
        return $query->result_array();
        
        
    }

}