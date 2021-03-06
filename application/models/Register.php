<?php
    class Register extends CI_Model {


        function __construct() {
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->model('register');
            $this->load->library('upload');
            $this->load->helper('form');
            $this->load->library('email');
            error_reporting(E_ALL & ~E_NOTICE);
        }

        public function get_user_roles(){

            $this->load->database();

            $this->db->select('*');
            $this->db->where_not_in('role', 'vendoradmin');
            $this->db->from('cip_users');
            $query = $this->db->get();
            $result = $query->result();

            return $result;
        }

        public function update_role($data){

            $this->load->database();
            $update_data = array(
                'role' => $data['role'],
            );

            $this->db->where('id', $data['user_id']);
            $this->db->update('cip_users', $update_data);

            $this->db->select('*');
            $this->db->where('user_id', $data['user_id']);
            $this->db->from('cip_company_users');
            $query = $this->db->get();
            if ( $query->num_rows() > 0 ) {
                $this->db->where('user_id', $data['user_id']);
                $this->db->delete('cip_company_users');

                foreach($data['company'] as $k => $v) {
                    $insert_data = array(
                        'company' => $v,
                        'user_id' => $data['user_id']
                    );
                    $this->db->insert('cip_company_users', $insert_data);
                }

            }else{
                $count = count($data['company']);
                foreach($data['company'] as $k => $v) {
                    $insert_data = array(
                        'company' => $v,
                        'user_id' => $data['user_id']
                    );
                    $this->db->insert('cip_company_users', $insert_data);
                }

            }

        }

        public function get_company_users(){
            $this->load->database();

            $this->db->select('*');
            $this->db->join('cip_companies', 'cip_companies.id = cip_company_users.company');
            $this->db->from('cip_company_users');
            $query = $this->db->get();
            $result = $query->result();

            return $result;
        }

        public function get_company_user($id){
            $this->load->database();

            $this->db->select('*');
            $this->db->join('cip_companies', 'cip_companies.id = cip_company_users.company');
            $this->db->where('cip_company_users.user_id', $id);
            $this->db->from('cip_company_users');
            $query = $this->db->get();
            $result = $query->result();

            return $result;
        }

        public function register_into_db($data)
        {
            $this->load->database();
            $insert_data = array(
                'email' => $data['email'],
                'name' => $data['name'],
                'password' => $data['password'],
                'company_name' => $data['company_name']
            );

            $this->db->insert('cip_users', $insert_data);

        }

        public function add_company($data)
        {
            $this->load->database();
            $insert_data = array(
                'company' => $data['company']
            );

            $this->db->insert('cip_companies', $insert_data);

        }

        public function get_companies()
        {
            $this->load->database();

            $this->db->select('*');
            $this->db->from('cip_companies');
            $query = $this->db->get();
            $result = $query->result();

            return $result;


        }

        public function usercheck($data){
            $this->load->database();
            $email = $data['email'];
            $password = $data['password'];

            $this->db->select('*');
            $this->db->where('email', $email);
            $this->db->where('password', $password);
            $this->db->from('cip_users');
            $query = $this->db->get();
            $result = $query->row();

            if(!empty($result)){
                $response['status'] = "200";
                if($result->isadmin == 0){
                    $response['admin'] = "0";
                }else{
                    $response['admin'] = "1";
                }

                $response['role'] = $result->role;
                $response['result'] = $result;
            }else{
                $response['status'] = "Error";
            }

            return $response;

        }

        public function sr_request($data, $company){
            $this->load->database();
            $insert_data = array(
                'baddress1' => $data['baddress1'],
                'baddress2' => $data['baddress2'],
                'baddress3' => $data['baddress3'],
                'bcity' => $data['bcity'],
                'bstate' => $data['bstate'],
                'bcountry' => $data['bcountry'],
                'bzipcode' => $data['bzipcode'],
                'iaddress1' => $data['iaddress1'],
                'iaddress2' => $data['iaddress2'],
                'iaddress3' => $data['iaddress3'],
                'icity' => $data['icity'],
                'istate' => $data['istate'],
                'icountry' => $data['icountry'],
                'izipcode' => $data['izipcode'],
                'request_number' => $data['request_number'],
                'request_date' => $data['request_date'],
                'user_id' => $data['user_id'],
                'localcontactnum1' => $data['localcontactnum1'],
                'localcontactnum2' => $data['localcontactnum2'],
                'localcontact' => $data['localcontact'],
                'localcontactemail' => $data['localcontactemail'],
                'igst' => $data['igst'],
                'bgst' => $data['bgst'],
                'bandwidth' => $data['bandwidth'],
                'company' => $data['company']

            );

            $this->db->insert('cip_address', $insert_data);
            $insert_id = $this->db->insert_id();

            $status_data = array(
                'sr_request_id' => $insert_id,
                'status' => 'customer submitted',
                'sr_request_number' => $data['request_number'],
                'company_name' => $company
            );

            $this->db->insert('cip_sr_status', $status_data);

            return true;
        }

        public function retrieve_user_requests($user_id){
            $this->load->database();

            $this->db->select('*');
            $this->db->where('user_id', $user_id);
            $this->db->from('cip_address');
            $this->db->join('cip_sr_status', 'cip_sr_status.sr_request_id = cip_address.id');
            $this->db->join('cip_companies','cip_companies.id = cip_address.company');
            $query = $this->db->get();
            $result = $query->result();

            return $result;
        }

        public function retrieve_users_requests(){
            $this->load->database();

            $this->db->select('*');
            $this->db->from('cip_address');
            $this->db->join('cip_sr_status', 'cip_sr_status.sr_request_id = cip_address.id');
            $this->db->join('cip_users', 'cip_users.id = cip_address.user_id');
            $this->db->join('cip_companies','cip_companies.id = cip_address.company');
            $query = $this->db->get();
            $result = $query->result();

            return $result;
        }

        public function retrieve_companyusers_requests($company){

            $this->load->database();

            $this->db->select('*');
            $this->db->from('cip_address');
            $this->db->join('cip_sr_status', 'cip_sr_status.sr_request_id = cip_address.id');
            $this->db->join('cip_users', 'cip_users.company_name = cip_sr_status.company_name');
            $this->db->join('cip_companies','cip_companies.id = cip_address.company');
            $array = array('cip_sr_status.company_name' => $company, 'cip_users.role' => 'customer');
            $this->db->where($array);
            $query = $this->db->get();
            $result = $query->result();

            return $result;
        }

        public function update_status($data){
            $this->load->database();

            $update_data = array(
                    'status' => $data['status'],
            );

            $this->db->where('sr_request_number', $data['req_num']);
            $this->db->update('cip_sr_status', $update_data);
        }

        public function sr_date_update($data){
            $this->load->database();

            $this->db->select('*');
            $this->db->where('sr_request_number', $data['req_num']);
            $this->db->from('cip_sr_date');
            $query = $this->db->get();

            if ( $query->num_rows() > 0 ) {
                $update_data = array(
                    'update_date' => $data['last_update_date'],
                    'updated_by' => $data['user_name']
                );

                  $this->db->where('sr_request_number',$data['req_num']);
                  $this->db->update('cip_sr_date',$update_data);
            } else {
                $insert_data = array(
                    'sr_request_number' => $data['req_num'],
                    'update_date' => $data['last_update_date'],
                    'updated_by' => $data['user_name']
                );
                $this->db->insert('cip_sr_date',$insert_data);
            }

        }

        public function last_update($sr_number){
            $this->load->database();

            $this->db->select('*');
            $this->db->where('sr_request_number', $sr_number);
            $this->db->from('cip_sr_date');
            $query = $this->db->get();
            $result = $query->result();

            return $result;

        }

        public function upload_data($data,$id){
            $this->load->database();

            $file_data = array(
                'filename' => $data['file_name'],
                'filepath' => $data['file_path'],
                'sr_request_number' => $id,
                'fullpath' => $data['full_path'],
                'type' => $data['type']
            );

            $this->db->insert('cip_uploads', $file_data);
        }

        public function customer_upload_data($data,$req){
            $this->load->database();

            $file_data = array(
                'filename' => $data['file_name'],
                'filepath' => $data['file_path'],
                'sr_request_number' => $req['sr_request_number'],
                'fullpath' => $data['full_path'],
                'type' => $data['type'],
                'user_id' => $req['user_id']
            );

            $this->db->insert('cip_customer_uploads', $file_data);
        }

        public function update_upload_data($data,$id){
            $this->load->database();

            $file_data = array(
                'filename' => $data['file_name'],
                'filepath' => $data['file_path'],
                'fullpath' => $data['full_path'],
                );

            $array = array('sr_request_number' => $id, 'type' => $data['type']);
            $this->db->where($array);
            $this->db->update('cip_uploads',$file_data);

        }

        public function customer_update_upload_data($data,$req){
            $this->load->database();

            $file_data = array(
                'filename' => $data['file_name'],
                'filepath' => $data['file_path'],
                'fullpath' => $data['full_path'],
                );

            $array = array('sr_request_number' => $req['sr_request_number'], 'type' => $data['type'], 'user_id' => $req['user_id']);
            $this->db->where($array);
            $this->db->update('cip_customer_uploads',$file_data);

        }

        public function retrieve_upload_data($req_num){
            $this->load->database();

            $this->db->select('*');
            $this->db->where('sr_request_number', $req_num);
            $this->db->from('cip_uploads');
            $query = $this->db->get();
            $result = $query->result();

            return $result;
        }

        public function retrieve_customer_upload_data($user_id,$req_num){
            $this->load->database();

            $this->db->select('*');
            $this->db->where('sr_request_number', $req_num);
            $this->db->where('user_id', $user_id);
            $this->db->from('cip_customer_uploads');
            $query = $this->db->get();
            $result = $query->result();

            return $result;
        }

        public function check_uploads($data){

            $this->load->database();

            $this->db->select('*');
            $this->db->where('sr_request_number', $data['req_num']);
            $this->db->from('cip_uploads');
            $query = $this->db->get();
            $result = $query->result();
            $count = count($result);
            if($count == 2){
                return true;
            }else{
                return false;
            }

        }

        public function check_customer_uploads($data){

            $this->load->database();

            $this->db->select('*');
            $this->db->where('sr_request_number', $data['sr_request_number']);
            $this->db->where('user_id', $data['user_id']);
            $this->db->from('cip_customer_uploads');
            $query = $this->db->get();
            $result = $query->result();

            $count = count($result);
            if($count == 2){
                return true;
            }else{
                return false;
            }

        }

        public function update_proposal_status($data){
            $this->load->database();

            $this->db->select('*');
            $this->db->where('sr_request_number', $data['sr_request_number']);
            $this->db->from('cip_proposal_status');
            $query = $this->db->get();

            if ( $query->num_rows() > 0 ) {
                $update_data = array(
                    'proposal_status' => $data['proposal_status']
                );

                  $this->db->where('sr_request_number',$data['sr_request_number']);
                  $this->db->update('cip_proposal_status',$update_data);
            } else {
                $insert_data = array(
                    'sr_request_number' => $data['sr_request_number'],
                    'proposal_status' => $data['proposal_status']
                );
                $this->db->insert('cip_proposal_status',$insert_data);
            }
        }

        public function retrieve_proposal_data($id){

            $this->load->database();

            $this->db->select('*');
            $this->db->where('sr_request_number', $id);
            $this->db->from('cip_proposal_status');
            $query = $this->db->get();
            $result = $query->row();

            return $result;
        }

        public function admin_retrieve_proposal_data(){

            $this->load->database();

            $this->db->select('*');
            $this->db->from('cip_proposal_status');
            $query = $this->db->get();
            $result = $query->result();

            return $result;
        }
    }
?>
