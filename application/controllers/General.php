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

        $logged = $this->logged_in();

        if($logged)
        {
            header("Location: " . base_url('/show'));
        } else {
           
            $data['show_menu'] = false;

            $this->load->view('part/header', $data);
            $this->load->view('home_presentation');
            $this->load->view('part/footer');
        }

    }

    public function show()
    {
    
        global $login_data;
    
        //$this->redirect_auth();
        
        $this->load->view('part/header');
       
        $post = $this->input->post();
    
        if(isset($post) && count($post)){
            $this->general_model->add_feeling($post);        
        }

        if(isset($_GET['type'])){
            $type = $_GET['type'];
        }

       // var_dump($login_data);

        if(isset($login_data) && isset($login_data['user_details']->id)){
            // echo 'you are logged in';

            $user_id = $login_data['user_details']->id;

            $data['logs'] = $this->general_model->get_logs($user_id);
            $this->load->view('add_note');
            $this->load->view('list_logs', $data);

        } else 

            // echo 'You are not logged in, no data to display';
            $this->load->view('not_logged');

        }
        
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
          'type' => ['1'], 
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

        
        if(isset($post['username']) && isset($post['password']))
        {
      
            $this->load->model("users_model");

            $email = $post['username'];
            $password = $post['password'];

            $response = $this->users_model->user_login($email, $password);
            $success = $response['success'];

            if($success){

                $email = $response['data']['email'];
                $id = $response['data']['id'];
    
                $this->users_model->set_auth_cookie($id, $email);   
                header("Location: " . base_url(''));
            }
        }


        $data['show_menu'] = false;
        
        $this->load->view('part/header', $data);
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
        
        $post = $this->input->post();
        
        
        if(isset($post) && count($post))
        {
            var_dump($post);
            $params = [
                'type' => $post['type'],
                'rating' => $post['measurement'],
                'user_id' => 1,
                'time' => time(),
            ];
            
            $this->general_model->write_general('logs', $params);
            echo 'added';
            
           
        }
        
        $filter = [
            'user_id' => [0,1],
        ];
        
        $data['types'] = $this->general_model->read_general('log_types', NULL, $filter);
        
        //var_dump($data);
        
        $this->load->view('part/header');
        $this->load->view('track', $data);
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

    function logged_in()
    {

        $this->load->model('users_model');

        //if not logged in, move to index page
        $login_data = $this->users_model->get_login_status();
        $logged_in = $login_data['authentificated'];

        return $logged_in;

    }
    
    function redirect_auth()
    {

        global $login_data;



        if(!$logged_in){
             header("Location: " . base_url('/login'));
        }
        
    }
    
}