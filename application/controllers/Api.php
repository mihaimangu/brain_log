<?php 
require(APPPATH.'/libraries/REST_Controller.php');

class api extends REST_Controller
{
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        
    }
    
    public function index_get()
    {
        
        echo 'hi';
        
    }
    
    
    public function logs_get()
    {
        
//        $logged_in = $this->users_model->check_auth();
//        
//        if(!$logged_in){
//            
//            $response['message'] = 'You are not logged in';
//            
//            $this->response($response, 401);
//            
//        }
        
        $this->load->model('general_model');
        
        $user_id = 1;
        
        $search = [
            'user_id' => [$user_id],
        ];
        
        $logs = $this->general_model->read_general('logs', NULL, $search);
        
        
        $this->response($logs, 200);
        
        
    }
    
    public function logs_post()
    {
        
        $user_id = 1;
        
        $logged_in = $this->users_model->check_auth();
        
        $this->response($logged_in);
        
        
    }
    
    
    
    
        
}

