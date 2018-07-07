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
        
        date_default_timezone_set('Europe/Bucharest');
        

        $this->redirect_auth();
        
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
    
    public function feeling($id)
    {
        
        //detect if user want to delete the entry
        if(isset($_POST) && isset($_POST['delete']) && $_POST['delete'] == true){
            $params = [
              'deleted' => 1
            ];
            $this->general_model->update_general('logs', $id, $params);
        }
        
        $filter = [
          'type' => ['feeling'], 
            'id' => [$id],
        ];
        
        $data = $this->general_model->read_general('logs', NULL, $filter);
        if(count($data)){

            $data = [
                'data' => $data[0]
            ];
            $this->load->view('part/header');
            $this->load->view('single_feeling', $data);
            $this->load->view('part/footer');    
            
        } else {
            
            $this->load->view('part/header');
            $this->load->view('not_found');
            $this->load->view('part/footer');
        
        }
 
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
    
    public function track()
    {
        
        $this->load->view('part/header');
        $this->load->view('track');
        $this->load->view('part/footer');
        
        
    }
    
    public function new_influent()
    {
        
        $this->redirect_auth();

        
        if(isset($_POST) && count($_POST)){
            
            $post = $this->input->post();
            
            $params = [
                'user_id' => 1,
                'name' => $post['name'],
                'unit_of_measure' => $post['measure'],
            ];
            
            var_dump($params);
            
            $this->general_model->write_general('log_types', $params);
        }
        
        $this->load->view('part/header');
        $this->load->view('new_influent');
        $this->load->view('part/footer');
        
    }
    
    function redirect_auth()
    {
        
        //if not logged in, move to index page
        $logged_in = $this->users_model->check_auth();
        if(!$logged_in){
             header("Location: " . base_url('/login'));
        }
        
    }
    
}