<?php
    class Register extends CI_Model {


        function __construct() {
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->model('register');
            $this->load->library('upload');
            $this->load->helper('form');
            error_reporting(E_ALL & ~E_NOTICE);
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
                $response['result'] = $result;
            }else{
                $response['status'] = "Error";
            }

            return $response;

        }

        public function sr_request($data){
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
                'istate' => $data['icity'],
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
                'bandwidth' => $data['bandwidth']

            );

            $this->db->insert('cip_address', $insert_data);
            $insert_id = $this->db->insert_id();

            $status_data = array(
                'sr_request_id' => $insert_id,
                'status' => 'customer submitted',
                'sr_request_number' => $data['request_number']
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
            $query = $this->db->get();
            $result = $query->result();

            return $result;
        }

        public function retrieve_users_requests(){
            $this->load->database();

            $this->db->select('*');
            $this->db->from('cip_address');
            $this->db->join('cip_sr_status', 'cip_sr_status.sr_request_id = cip_address.id');
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

        public function upload_data($data,$id){
            $this->load->database();

            $file_data = array(
                'filename' => $data['file_name'],
                'filepath' => $data['file_path'],
                'sr_request_number' => $id,
                'fullpath' => $data['full_path']
            );

            $this->db->insert('cip_uploads', $file_data);
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
    }
?>
