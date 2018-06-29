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
        
        //var_dump($logged_in);
       
        if(!$logged_in){
             header("Location: " . base_url('/login'));
            
        }
        
     
        $this->load->view('part/header');
        $this->load->view('add_note');
        
        $post = $this->input->post();
        

        if(isset($post) && count($post)){
            
            $this->general_model->add_feeling($post);
        
        }
        
        //load entries
        $data['feelings'] = $this->general_model->get_feelings();
        $this->load->view('list_feelings', $data);
        
        
        $this->load->view('part/footer');
        
        
    }
    
    public function login()
    {
        
        $post = $this->input->post();

        
        if(isset($post['username']) && $post['username'] == 'adm' && isset($post['password']) && $post['password'] == 'chrome4setup' )
        {
      
            $this->users_model->remember_user();   
            
            //echo 'success';
            
            header("Location: " . base_url(''));
            
        }
        
        $this->load->view('part/header');
        $this->load->view('login');
         $this->load->view('part/footer');
        
    }
    
    public function logout()
    {
        
        $this->users_model->logout();
        header("Location: " . base_url(''));
        
        
    }
    
    public function add_note()
    {
        
        echo 'add note';
        
    }
    
    public function view_all()
    {
        
        echo 'view all notes';
        
    }
    
    public function debug()
    {
        
      $logged_in = $this->session->userdata();
        
        var_dump($logged_in);
        
    }
    
}