<?php

class Users_model extends CI_Model
{

	public function get_account_details($user = NULL)
	{
        
    }
    
    public function email_exists()
    {
        
        
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
    
    
    
}