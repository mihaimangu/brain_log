<?php 
require(APPPATH.'/libraries/REST_Controller.php');

class users extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
	}

    public function index_get()
    {
        
        echo 'Codeigniter User-Flow';
        
    }
    
    public function user_post()
	{
        
        //$this->response($_POST, 200);
        
        $post = $this->input->post();
        
        if(!isset($post['email']) || !isset($post['password'])){
			$this->response(array(
				'message' => 'Username and password are both required',
				'success' => false,
			), 400);
		}

        
        $first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$password = $this->input->post('password');
		$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
		$email = $this->input->post('email');

		//return error if email and password are not set

        
		$email_exists = $this->users_model->email_exists($email);

		if($email_exists){
			$this->response(array(
				'message' => "Email address is already in use",
				'success' => false,
			), 400);
		}

		$user_data = array(
			//'first_name' => $first_name,
			//'last_name' => $last_name,
			'email' => $email,
			'password' => $password,
		);

        $this->load->model('general_model');
        
        $table = 'app_users';
		$success = $this->general_model->write_general($table,$user_data);

		if($success){
			$this->response(
				array(
					'message' => 'User account created successfuly',
					'success' => true,  )
				, 200);
		} else {
			$this->response(
				array(
				'message' => 'There was a problem with the creation of the account',
				'success' => false,
				), 400);
		}
	

    }
    
}

