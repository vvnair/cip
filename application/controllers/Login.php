<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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
        if($istrue == 200){
            $this->profile();
        }else{
            $this->index();
        }
    }

    public function profile(){
        $this->load->view('profile_page');
    }
}
