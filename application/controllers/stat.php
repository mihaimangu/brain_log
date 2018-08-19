<?php 
require(APPPATH.'/libraries/REST_Controller.php');

class Stat extends CI_Controller
{
    
    public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
        $this->load->model("general_model");
	}
    
    public function about()
    {

        $this->load->view('part/header');
        $this->load->view('static/about');
        $this->load->view('part/footer');
    }

}