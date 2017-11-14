<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('register');
        $this->load->helper('form');
       	
        $this->load->library('email');
        error_reporting(E_ALL & ~E_NOTICE);
        require_once(APPPATH.'third_party/PHPMailerAutoload.php');
        $this->load->library("mail");

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
        $this->sendmail_customer($register_data);
        $this->sendmail_admin($register_data);
        redirect('','refresh');
    }

    public function sendmail_admin($data){
        $mail['text'] = "A new user has registered in CIP with email id :".$data['email'].". Please verify the user and assign a role.";
        $mail['email'] = "cipvendor2017@gmail.com";

        $mail['subject'] = "New User Registered";
        $this->sendmail($mail);
    }

    public function sendmail_customer($data){
        $mail['text'] = "Hello ".$data['name']. ". Thank you for registering in the CIP. You will be able to login only after you have been verified by the administrator. We will let you know once action has been taken. Thank you";
        $mail['email'] = $data['email'];
        $mail['subject'] = "Welcome";
        
	$this->sendmail($mail);
    }

    public function sendmail($data){
    
    
	$mail = new Mail();

	$mail->setMailBody($data['text']);
	$mail->sendMail($data['subject'], $data['email']);
       
    }
    public function do_login()
    {
        // if($this->session->userdata('sessionid')){
        //     $sess_data = $this->session->userdata();//echo "<pre>";print_r($sess_data);
        //     $istrue['status'] =200;
        //
        //     if($istrue['status'] == 200 && $sess_data['role'] == 'customer'){
        //         $this->profile($sess_data);
        //     }elseif ($istrue['status'] == 200 && $sess_data['role'] == 'vendoradmin') {
        //         $this->admin_profile($sess_data);
        //     }elseif($istrue['status'] == 200 && $sess_data['role'] == 'customeradmin'){
        //         $this->customer_admin_profile($sess_data);
        //     }
        //
        // }else{
            $login_data = $this->input->post();
            $this->load->model('register');
            $istrue = $this->register->usercheck($login_data);

            if($istrue['status'] == 200 && $istrue['admin'] == '0' && $istrue['role'] == 'customer'){
                $this->profile($istrue['result']);
            }elseif($istrue['status'] == 200 && $istrue['admin'] == '1' && $istrue['role'] == 'vendoradmin'){
                $this->admin_profile($istrue['result']);
            }elseif($istrue['status'] == 200 && $istrue['role'] == 'customeradmin'){
                $this->customer_admin_profile($istrue['result']);
            }
            else{
                redirect('','refresh');
            }
        //}

    }

    public function profile($data){
        if(empty($data->sessionid)){
            $arraydata = array(
                    'sessionid'  => $data->id,
                    'useremail'  => $data->email,
                    'username' => $data->name,
                    'loggedin' => 1,
                    'companyname' => $data->company_name,
                    'role' => $data->role
            );
            $this->session->set_userdata($arraydata);
        }

        $session_data = $this->session->userdata();
        $page_data = $this->user_page_data($session_data['sessionid']);

        $this->load->view('profile_page',$page_data);

    }

    public function admin_profile($data){
        if(empty($data->sessionid)){
            $arraydata = array(
                    'sessionid'  => $data->id,
                    'useremail'  => $data->email,
                    'username' => $data->name,
                    'loggedin' => 1,
                    'isadmin' => 1,
                    'companyname' => $data->company_name,
                    'role' => $data->role
            );

            $this->session->set_userdata($arraydata);
        }
        $session_data = $this->session->userdata();
        $admin_page_data = $this->admin_page_data();
        //echo "<pre>";print_r($_SESSION);exit;
        $this->load->view('admin_profile_page',$admin_page_data);
    }

    public function customer_admin_profile($data){
        if(empty($data->sessionid)){
            $arraydata = array(
                    'sessionid'  => $data->id,
                    'useremail'  => $data->email,
                    'username' => $data->name,
                    'loggedin' => 1,
                    'isadmin' => 1,
                    'companyname' => $data->company_name,
                    'role' => $data->role
            );

            $this->session->set_userdata($arraydata);
        }
        $session_data = $this->session->userdata();
        $customeradmin_page_data = $this->customeradmin_page_data($session_data['companyname']);

        $this->load->view('customeradmin_profile_page',$customeradmin_page_data);

    }

    public function logout(){
        session_destroy();
        redirect('','refresh');
    }

    public function new_request(){

        $session_data = $this->session->userdata();
        $insert_data = $this->input->post();
        $user_id = $insert_data['user_id'];
        $insert = $this->register->sr_request($insert_data, $session_data['companyname']);
        $session_data = $this->session->userdata();

        $page_data = $this->user_page_data($session_data['sessionid']);

        if($insert == true){
            $this->load->view('profile_page',$page_data);
        }


    }

    public function update_status(){

        $data = $this->input->post();
        $check_files = $this->register->check_uploads($data);

        foreach($_FILES as $k => $file){
            if(!$_FILES[$k]['name'] == ''){
                $filename = $k."-".$data['req_num'].".pdf";
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = '*';
                $config['max_size']             = 10000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                $config['file_name'] = $filename;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $this->upload->do_upload($k);

                $upload_data = $this->upload->data();
                $upload_data['type'] = $k;

                if($check_files){
                    $this->register->update_upload_data($upload_data,$data['req_num']);
                }else{
                    $this->register->upload_data($upload_data,$data['req_num']);
                }
            }
        }

        $update = $this->register->update_status($data);
        $last_update_date = $this->register->sr_date_update($data);

        $session_data = $this->session->userdata();
        $admin_page_data = $this->admin_page_data();
        $this->load->view('admin_profile_page',$admin_page_data);

    }

    public function add_company(){
        $data = $this->input->post();
        $insert = $this->register->add_company($data);

        $admin_page_data = $this->admin_page_data();
        $this->load->view('admin_profile_page',$admin_page_data);

    }
    public function download(){
        $this->load->helper('download');

        $get = $this->input->get();
        $path= $get['p'];

        force_download($path, NULL);
    }

    public function change_proposal_status(){
        $data = $this->input->post();
        $check_files = $this->register->check_customer_uploads($data);

        foreach($_FILES as $k => $file){
            if(!$_FILES[$k]['name'] == ''){
                if($k == 'signedproposal'){
                    $filename = "PO-".$data['sr_request_number'].".pdf";
                }else{
                    $filename = $k."-".$data['sr_request_number'].".pdf";
                }

                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = '*';
                $config['max_size']             = 10000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                $config['file_name'] = $filename;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $this->upload->do_upload($k);

                $upload_data = $this->upload->data();
                $upload_data['type'] = $k;

                if($check_files){
                    $this->register->customer_update_upload_data($upload_data,$data);
                }else{
                    $this->register->customer_upload_data($upload_data,$data);
                }
            }
        }


        $update_status = $this->register->update_proposal_status($data);
        $last_update_date = $this->register->sr_date_update($data);
        $session_data = $this->session->userdata();
        $page_data = $this->user_page_data($session_data['sessionid']);

        $this->load->view('profile_page',$page_data);

    }

    public function user_page_data($id){

        $user_data = $this->register->retrieve_user_requests($id);
        $get_user_companies = $this->register->get_company_user($id);

        $upload_data = array();
        foreach ($user_data as $key => $value) {
            $sr_number = $value->request_number;
            $upload_data[] = $this->register->retrieve_upload_data($sr_number);
            $self_upload_data[] = $this->register->retrieve_customer_upload_data($value->user_id,$sr_number);
            $proposal_data[] = $this->register->retrieve_proposal_data($sr_number);
            $last_update[] = $this->register->last_update($sr_number);
        }
        if($get_user_companies){
            $view_data['user_companies'] = $get_user_companies;
        }
        $view_data['data'] = $user_data;
        $view_data['user_id'] = $id;
        if($upload_data){
            $view_data['files'] = $upload_data;
            $view_data['proposal_statuses'] = array('Proposal Unread',
                                                    'Proposal Read',
                                                    'Proposal Accepted');
        }
        if($self_upload_data){
            $view_data['self_files'] = $self_upload_data;
        }
        if($last_update){
            $view_data['last_update'] = $last_update;
        }
        //echo "<pre>";print_r($last_update);exit;
        if($proposal_data) {
            $view_data['customer_proposal_status'] = $proposal_data;
        }

        return $view_data;
    }

    public function admin_page_data(){

        $users_data = $this->register->retrieve_users_requests();
        $proposal_data = $this->register->admin_retrieve_proposal_data();
        $users_role = $this->register->get_user_roles();
        $get_companies = $this->register->get_companies();

        $get_company_users = $this->register->get_company_users();

        $view_data['data'] = $users_data;
        foreach ($users_data as $key => $value) {
            $upload_data[] = $this->register->retrieve_customer_upload_data($value->user_id,$value->sr_request_number);
            $self_upload_data[] = $this->register->retrieve_upload_data($value->sr_request_number);
            $last_update[] = $this->register->last_update($value->sr_request_number);
        }
        if($upload_data){
            $view_data['files'] = $upload_data;
        }
        if($last_update){
            $view_data['last_update'] = $last_update;
        }
        if($self_upload_data){
            $view_data['self_files'] = $self_upload_data;
        }
        if($proposal_data){
            $view_data['customer_proposal_data'] = $proposal_data;
        }
        if($users_role){
            $view_data['user_roles'] = $users_role;
        }
        if($get_companies){
            $view_data['companies'] = $get_companies;
        }
        if($get_company_users){
            $view_data['cmp_users'] = $get_company_users;
        }
        //echo "<pre>";print_r($upload_data);exit;
        //echo "<pre>";print_r($proposal_data);exit;
        $view_data['statuses'] = array('customer submitted',
                                        'work in progress',
                                        'feasible',
                                        'unfeasible');
        $view_data['roles'] = array('vendoradmin',
                                        'customeradmin',
                                        'customer',
                                    );
        return $view_data;
    }

    public function customeradmin_page_data($company){

        $users_data = $this->register->retrieve_companyusers_requests($company);

        foreach ($users_data as $key => $value) {
            $sr_number = $value->request_number;
            $upload_data[] = $this->register->retrieve_upload_data($sr_number);
            $self_upload_data[] = $this->register->retrieve_customer_upload_data($value->user_id,$sr_number);
            $get_user_companies[] = $this->register->get_company_user($value->user_id);
            $last_update[] = $this->register->last_update($sr_number);
        }
        //echo "<pre>";print_r($users_data);exit;
        if($upload_data){
            $view_data['files'] = $upload_data;
        }
        if($self_upload_data){
            $view_data['self_files'] = $self_upload_data;
        }
        if($last_update){
            $view_data['last_update'] = $last_update;
        }
        //echo "<pre>";print_r($upload_data);exit;
        $view_data['data'] = $users_data;

        return $view_data;

    }

    public function update_user_role(){

        $data = $this->input->post();//echo "<pre>";print_r($data);print_r(count($data['company']));exit;
        $update = $this->register->update_role($data);

        $admin_page_data = $this->admin_page_data();
        $this->load->view('admin_profile_page',$admin_page_data);
    }
}
