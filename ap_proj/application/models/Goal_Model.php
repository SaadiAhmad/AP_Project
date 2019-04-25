<?php
    class Goal_Model extends CI_Model {

        public function __construct() {
                parent::__construct();
                $this->load->database();
        }

        public function addGoal(){

            $data = array(
                'username' => $this->input->post('username'),
                'description' => $this->input->post('description'),
                'completed' => $this->input->post('completed'),
            );

            $this->db->insert('goal', $data);
            return ($this->db->affected_rows() != 1) ? false : true;
        }

        public function deleteGoal(){
            $username = $this->input->input_stream('username');
            $this->db->where('username', $username);
            $this->db->delete('goal');

            return ($this->db->affected_rows() == 0) ? false : true;
        }

        public function getGoals(){
            $username = $this->input->post('username');

            try{
                $this->db->select('description, time');
                $this->db->from('goal');
                $this->db->where('username', $username);
                $query = $this->db->get();
            }
            catch(Exception $e){
                return false;
            }

            return ($query->num_rows() != 0) ? true : false;
        }
    }
?>