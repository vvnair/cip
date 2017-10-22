<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('register');
        error_reporting(E_ALL & ~E_NOTICE);
    }

	public function index()
	{
		$this->load->view('login_form');
	}

    public function register()
    {
        $this->load->view('registration_form');
    }

    public function on_register()
    {

        $register_data = $this->input->post();
        $this->load->model('register');
        $this->register->register_into_db($register_data);
        $this->index();
    }

    public function do_login()
    {
        $login_data = $this->input->post();
        $this->load->model('register');
        $istrue = $this->register->usercheck($login_data);
        if($istrue['status'] == 200){
            $this->profile($istrue['result']);
        }else{
            redirect('','refresh');
        }
    }

    public function profile($data){

        $arraydata = array(
                'session_id'  => $data->id,
                'user_email'  => $data->email,
                'user_name' => $data->name
        );
        $this->session->set_userdata($arraydata);
        $this->load->view('profile_page');
    }

    public function logout(){
        session_destroy();
        redirect('','refresh');
    }

    public function new_request(){
        //echo "<pre>";print_r($this->input->post());exit;
        $insert_data = $this->input->post();
        $insert = $this->register->sr_request($insert_data);
        echo "<pre>";print_r($insert);exit;
        
        if($insert == "true"){
            $this->load->view('profile_page');
        }


    }
}
