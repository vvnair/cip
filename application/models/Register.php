<?php
    class Register extends CI_Model {


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
                'localcontactemail' => $data['localcontactemail']

            );

            $this->db->insert('cip_address', $insert_data);
            $insert_id = $this->db->insert_id();

            return $insert_id;
        }

    }
?>
