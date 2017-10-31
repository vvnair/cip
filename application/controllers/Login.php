<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('register');
        $this->load->helper('form');
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

        $session_data =$this->session->userdata();
        // if($session_data['session_data']){
        //         echo "yes";exit;
        // }
        //print_r($session_data);exit;
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
        if(empty($data->sessionid)){
            $arraydata = array(
                    'sessionid'  => $data->id,
                    'useremail'  => $data->email,
                    'username' => $data->name,
                    'loggedin' => 1
            );
            $this->session->set_userdata($arraydata);
        }

        $session_data = $this->session->userdata();
        $page_data = $this->user_page_data($session_data['sessionid']);

        $this->load->view('profile_page',$page_data);

    }

    public function admin_profile($data){
        $arraydata = array(
                'sessionid'  => $data->id,
                'useremail'  => $data->email,
                'username' => $data->name,
                'loggedin' => 1,
                'isadmin' => 1
        );
        $this->session->set_userdata($arraydata);
        $session_data = $this->session->userdata();
        $users_data = $this->register->retrieve_users_requests();
        $proposal_data = $this->register->admin_retrieve_proposal_data();
        $view_data['data'] = $users_data;
        if($proposal_data){
            $view_data['customer_proposal_data'] = $proposal_data;
        }
        //echo "<pre>";print_r($proposal_data);exit;
        $view_data['statuses'] = array('customer submitted',
                                        'work in progress',
                                        'feasible',
                                        'unfeasible');
        //$this->do_login();
        $this->load->view('admin_profile_page',$view_data);
    }

    public function logout(){
        session_destroy();
        redirect('','refresh');
    }

    public function new_request(){

        $insert_data = $this->input->post();
        $user_id = $insert_data['user_id'];
        $insert = $this->register->sr_request($insert_data);
        $session_data = $this->session->userdata();

        $page_data = $this->user_page_data($session_data['sessionid']);

        if($insert == true){
            $this->load->view('profile_page',$page_data);
        }


    }

    public function update_status(){

        $data = $this->input->post();

        foreach($_FILES as $k => $file){
            if(!$_FILES[$k]['name'] == ''){
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = '*';
                $config['max_size']             = 10000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $this->upload->do_upload($k);

                $upload_data = $this->upload->data();
                $this->register->upload_data($upload_data,$data['req_num']);
            }
        }

        $update = $this->register->update_status($data);

        /** To fix invalid argument **/

        $session_data = $this->session->userdata();
        $users_data = $this->register->retrieve_users_requests();
        $proposal_data = $this->register->admin_retrieve_proposal_data();
        $view_data['data'] = $users_data;
        if($proposal_data){
            $view_data['customer_proposal_data'] = $proposal_data;
        }
        //echo "<pre>";print_r($proposal_data);exit;
        $view_data['statuses'] = array('customer submitted',
                                        'work in progress',
                                        'feasible',
                                        'unfeasible');
        /************************/

        $this->load->view('admin_profile_page',$view_data);

    }

    public function download(){
        $this->load->helper('download');

        $get = $this->input->get();
        $path= $get['p'];

        force_download($path, NULL);
    }

    public function change_proposal_status(){
        $data = $this->input->post();
        //echo "<pre>";print_r($data);exit;
        $update_status = $this->register->update_proposal_status($data);
        $session_data = $this->session->userdata();
        $page_data = $this->user_page_data($session_data['sessionid']);

        $this->load->view('profile_page',$page_data);

    }

    public function user_page_data($id){

        $user_data = $this->register->retrieve_user_requests($id);

        $upload_data = array();
        foreach ($user_data as $key => $value) {
            $sr_number = $value->request_number;
            $upload_data[] = $this->register->retrieve_upload_data($sr_number);
            $proposal_data[] = $this->register->retrieve_proposal_data($sr_number);
        }

        $view_data['data'] = $user_data;
        if($upload_data){
            $view_data['files'] = $upload_data;
            $view_data['proposal_statuses'] = array('Proposal Read',
                                            'Proposal Accepted');
        }

        if($proposal_data) {
            $view_data['customer_proposal_status'] = $proposal_data;
        }

        return $view_data;
    }
}
