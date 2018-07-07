<?php

class General_model extends CI_Model
{
    
   	public function read_general($table, $id = NULL, $data = NULL, $count = false, $search = NULL, $order_by = NULL, $join = NULL, $extra_query_size = NULL){

		$offset = "";

		// if no id is specified, get the list of all the products. 

		//determinte the list's dimension. maximum of 100 allowed.
		if(isset($data['request_size'][0])){
			$limit_val = $data['request_size'];
			if(is_array($data['request_size'])){
				$limit_val = $data['request_size'][0];
			}
			if($limit_val > 100)
			{
				$limit_val = 100;
			}
			unset($data['request_size']);
		} else {
			$limit_val = 100;	
		}

		if(isset($extra_query_size)){
			$limit_val = $extra_query_size;
		} 

		$limit_string = "LIMIT " . strval($limit_val);

		if(isset($data['page'])){
			if (isset($data['page'][0])){
					$offset = $limit_val * ($data['page'][0] - 1);
					
			}
			unset($data['page']);
		}


		// if(isset($data['orderby'])){
		// 	$order_by = array($data['orderby'][0], 'asc');
		// 	unset($data['orderby']);
		// }


		if(empty($data)){
			$getwhere = array();
		} else {
			$getwhere = '';

			//put all the GET data ($data) into a string, used later in the query for filtering
			foreach($data as $key => $param){
				if ($getwhere == '') {
					$getwhere = $getwhere . " " . $key . " in (";
					if(!is_array($param)){
						return 'Bad request. Parameters should be presented as array.';
					}
					foreach($param as $key => $p){
						if(is_string($p)){
							$p = "'" . $p . "'";
						}
						if($key == 0){
							$getwhere = $getwhere . $p;
						} else {
							$getwhere = $getwhere . "," . $p;
						}
					}
					$getwhere = $getwhere . ") "; 
				} else {
					$getwhere = $getwhere . "AND " . $key . " in (";
					foreach($param as $key => $p){
						if(is_string($p)){
							$p = "'" . $p . "'";
						}
						if($key == 0){
							$getwhere = $getwhere . $p;
						} else {
							$getwhere = $getwhere . "," . $p;
						}
					}
					$getwhere = $getwhere . ") "; 
				}
			}

		} 

		// return only the product matching the ID
		if($id){

			$query = $this->db->get_where($table, array('id' => $id));
			$result = $query->result_array();

			return $result;
		}

		if(isset($order_by)){
			$this->db->order_by($order_by[0], $order_by[1]);
		}

		if($count){
			$select= array("count(*) as Total");
			$this->db->select($select);
			$this->db->from($table);
			$this->db->where($getwhere);
			if(isset($search)){
				$this->pass_filters($search);
			}	
			$query = $this->db->get();
			return $query->row_object();

		} else {
			//$query = $this->db->get_where($table, $getwhere, $limit_val, $offset);


			$limit_str = $limit_val . ',' . $offset;

			$this->db->from($table);
			$this->db->where($getwhere);
			if(isset($order_by[0])){
				$this->db->order_by($order_by[0], $order_by[1]);
			}
			$this->db->limit($limit_val, $offset);
			if(isset($search)){
				//return $search;
				$this->pass_filters($search);
			}
			if(isset($join) && is_array($join)){
				$this->db->join($join[0], $join[1], $join[2]);
			}

			$query = $this->db->get();
			$result = $query->result_array();
		}

		return $result;

	}
        

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
        
        $where = array(
            'user_id' => 1,
            'deleted' => 0    
        );
        
        $this->db->where($where);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('logs');
        
        return $query->result_array();
        
    }
    
	public function update_general($table, $id, $params)
	{

		$this->db->where('id', $id);
		$this->db->update($table, $params);

	}

}