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
        if($istrue['status'] == 200 && $istrue['admin'] == '0'){

            $this->profile($istrue['result']);
        }elseif($istrue['status'] == 200 && $istrue['admin'] == '1'){
            $this->admin_profile($istrue['result']);
        }else{
            redirect('','refresh');
        }
    }

    public function profile($data){

        $arraydata = array(
                'session_id'  => $data->id,
                'user_email'  => $data->email,
                'user_name' => $data->name,
                'logged_in' => 1
        );
        $this->session->set_userdata($arraydata);
        $session_data = $this->session->userdata();
        $user_data = $this->register->retrieve_user_requests($session_data['session_id']);
        $view_data['data'] = $user_data;
        //echo "<pre>";print_r($user_data);exit;
        $this->load->view('profile_page',$view_data);


    }

    public function admin_profile($data){
        $arraydata = array(
                'session_id'  => $data->id,
                'user_email'  => $data->email,
                'user_name' => $data->name,
                'logged_in' => 1,
                'isadmin' => 1
        );
        $this->session->set_userdata($arraydata);
        $session_data = $this->session->userdata();
        $users_data = $this->register->retrieve_users_requests();
        $view_data['data'] = $users_data;

        $this->load->view('admin_profile_page',$view_data);
    }

    public function logout(){
        session_destroy();
        redirect('','refresh');
    }

    public function new_request(){
        //echo "<pre>";print_r($this->input->post());exit;
        $insert_data = $this->input->post();
        $user_id = $insert_data['user_id'];
        $insert = $this->register->sr_request($insert_data);

        if($insert == true){
            $this->load->view('profile_page');
        }


    }

    public function update_status(){

        $data = $this->input->post();
        $update = $this->register->update_status($data);
    }
}
