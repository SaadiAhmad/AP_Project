<?php
    class User_Model extends CI_Model {

        public function __construct() {
                parent::__construct();
                $this->load->database();
        }

        public function isUserExist($username, $password) {
                
            $query = "SELECT * FROM user WHERE username = ? AND password = ?";
            $query = $this->db->query($query, array($username, $password));
            $result = $query->row();

            if($query->num_rows() == 1) {
               
                return true;
            }
            else {
                return false;
            }
        }

        public function userExists($username) {
                
            $query = "SELECT * FROM user WHERE username = ?";
            $query = $this->db->query($query, array($username));

            if($query->num_rows() == 1) {  
                return true;
            }
            else {
                return false;
            }
        }

        public function createUser($username){

            if(!($this->userExists($username))){
                $data = array(
                    'username' => $username,
                    'password' => $this->input->post('password'),
                    'age' => $this->input->post('age'),
                    'weight' => $this->input->post('weight'),
                    'height' => $this->input->post('height'),
                );
                $this->db->insert('user', $data);
                return true;
            }
            
            return false;
        }

        public function reminder_insert($username, $subject,$time) {
                
                //$query = "SELECT * FROM user WHERE username = ? AND password = ?";
                //$query = $this->db->query($query, array($username, $password));
                //$result = $query->row();
                $data = array(
                    'Username'=>$username,
                    'Subject'=>$subject,
                    'Time'=>$time
                );
                try{
                    $this->db->insert('Reminder',$data);
                    return true;
                }
                catch (Exception $e) {
                    //alert the user.
                    console.log($e->getMessage());
                    return false;
                }                
        }

        public function reminder_delete($username, $subject,$time) {
                
                //$query = "SELECT * FROM user WHERE username = ? AND password = ?";
                //$query = $this->db->query($query, array($username, $password));
                //$result = $query->row();
                $array = array('Username' => $username, 'Subject' => $subject, 'Time' => $time);
                try{
               

                //$this->db->where('Username',$username); 
                $this->db->delete('Reminder',$array);
                if($this->db->affected_rows()==0)
                {

                  return false;
                }
                return true;
                }
                catch (Exception $e) {
                 //alert the user.
                console.log($e->getMessage());
                    return false;
                }
              

                
        }

        public function reminder_show($username) {
                
            //$query = "SELECT * FROM user WHERE username = ? AND password = ?";
            //$query = $this->db->query($query, array($username, $password));
            //$result = $query->row();
            $this->db->select('Username, Subject, Time');
            $this->db->from('Reminder');
            $this->db->where('Username', $username); 
            $query = $this->db->get();

            if($query->num_rows() > 0){
           
                return $query->result_array();
            }
            else{
                return 0;
            }
        }

        public function changeWeight(){
            $w = $this->input->input_stream('weight');
            // echo $w;
            if($w > 0){
                $data = array('weight'=> $w);
                $this->db->where('username','saadi');
                $this->db->update('user', $data);
                return true;
            }
            else{
                return false;
            }
        }

        public function changeHeight(){
            $h = $this->input->input_stream('height');
            if($h > 0){
                $data = array('height'=> $h);
                $this->db->where('username','saadi');
                $this->db->update('user',$data);
                return true;
            }
            else{
                return false;
            }
        }

        public function changeUsername(){
            $username = $this->input->input_stream('username');
            
            if(!($this->userExists($username))){
                $data = array('username'=> $username);
                $this->db->where('username','saadi');
                $this->db->update('user', $data);
                return true;
            }
            else{
                return false;
            }
        }

        public function changePassword(){
            $password = $this->input->input_stream('password');
            
            if(strlen($password) > 2){
                $data = array('password'=> $password);
                $this->db->where('username','saadi');
                $this->db->update('user', $data);
                return true;
            }
            else{
                return false;
            }
        }
    }
?>