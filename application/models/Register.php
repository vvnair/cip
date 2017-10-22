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

    }
?>
