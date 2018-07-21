<?php

class Users_model extends CI_Model
{

	public function get_account_details($user = NULL)
	{
        
    }
    
    public function email_exists($email)
    {
        
        //TODO: This is to be replaced with a procedure. Data should not be read directly from the table.

		$response = $this->db->get_where('users', array(
			'email' => $email,
		));
        return $response->result_array();
        
    }
    
    public function register_user()
    {
        
        //this is where you write the database logic (writing in the database).
        
        return true;
        
    }
    
    public function remember_user($id = NULL)
    {
        
      
        $this->load->library('session');
        
        $array = array(
            'logged_in' => true,
            'username' => 'adm',
            'user_id' => 1,
        );
        
        $this->session->set_userdata($array);
        
    }
    
    public function check_auth()
    {   
    
        $logged_in = $this->session->userdata('logged_in');
        
        if(isset($logged_in) && $logged_in){
            return true;
        } else {
            return false;
        }
        
        
    }
    
    public function logout()
    {

        $this->load->helper('cookie');

        delete_cookie('auth_data');


        
    }

    public function user_login($email, $password)
	{

		$error = false;

		//make login verification to be based on a procedure
		$data = array(
			'data' => array(),
			'success' => false,
		);

		$query = $this->db->get_where('users', array('email' => $email));
		$result = $query->row();


		if(empty($result)){
			$data['success'] = false;
			return $data;
		}

		$db_pass = $result->password;

		$password_match = password_verify($password,$db_pass);
		//return $password_match;

		$keys = array('id', 'email');

		if($password_match){
			$data['success'] = true;
			$data['data'] = array(
				'id' => $result->id,
				'email' => $result->email,
			);
			return $data;
		} else {
			$data['success'] = false;
			return $data;
		}

	}
    
    public function set_auth_cookie($id, $email)
    {
        
        $data = array(
            'id' => $id,
            'email' => $email,
        );
            
       
        $encoded = JSON_ENCODE($data);
        
        $this->load->helper('cookie');
        
        $expire = 3600 * 24 * 10;
        
        set_cookie('auth_data', $encoded, $expire);
    }

    public function get_login_status()
    {
        
        $this->load->helper('cookie');
        
        $response = array(
            'authentificated' => false,
            'user_details' => NULL,
        );
            
        
        if(isset($_COOKIE['auth_data'])){
            $auth_data = get_cookie('auth_data');
            $decoded = JSON_DECODE($auth_data);
            
            $response['user_details'] = $decoded;
            $response['authentificated'] = true;
            
            return $response;
        }
        
        return $response;
    }

    
}