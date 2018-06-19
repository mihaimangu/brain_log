<?php 
require(APPPATH.'/libraries/REST_Controller.php');

class General extends CI_Controller
{
    
    public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
        $this->load->model("general_model");
	}
    
    public function index()
    {
        
      
        $logged_in = $this->users_model->check_auth();
       
        if(!$logged_in){
             header("Location: " . base_url('/login'));
        }
        
     
        $this->load->view('add_note');
        
        $post = $this->input->post();
        
        if(isset($post) && count($post)){
            
            echo 'added';
            var_dump($this->input->post());
            
            $this->general_model->add_feeling($post);
        
        }
        
    }
    
    public function login()
    {
        
        $post = $this->input->post();

        
        if(isset($post['username']) && $post['username'] == 'adm' && isset($post['password']) && $post['password'] == 'chrome4setup' )
        {
      
            $this->users_model->remember_user();   
            
            echo 'success';
            
            header("Location: " . base_url(''));
            
        }
        
        $this->load->view('login');
        
    }
    
    public function add_note()
    {
        
        echo 'add note';
        
    }
    
    public function view_all()
    {
        
        echo 'view all notes';
        
    }
    
}