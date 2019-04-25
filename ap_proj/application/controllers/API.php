<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class API extends CI_Controller {

		public function __construct() {
			parent::__construct();
	    //$this->load->library('session');
		}
		public function index()
		{
			$this->load->view('welcome_message');
			$this->load->model('User_Model');
		}
		/*public function login()
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->load->model('User_Model');

			if(($this->User_Model->isUserExist($username, $password))['isUserExist']) {
				$user_data = array(
					'user_id' => $this->User_Model->isUserExist($username, $password)['id'],
					'logged_in' => true
				);
				//success message
				echo json_encode(array(
					'message' => array(
						'msg' => 'user found successfully',
						'code' => '200',
					),
				));
			}
			//error message
			else {
				echo json_encode(array(
					'error' => array(
						'msg' => 'user not found',
						'code' => '100',
					),
				));
	    //redirect('user/login');
			}
		}*/

		public function login()
			{
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$this->load->model('User_Model');

				if($this->User_Model->isUserExist($username,$password)) {
					//success message
					echo json_encode(array(
						'message' => array(
							'msg' => 'user found successfully',
							'code' => '200',
						)
					));
				}
				//error message
				else {
					echo json_encode(array(
						'error' => array(
							'msg' => 'user not found',
							'code' => '100',
						)
					));
		    //redirect('user/login');
				}
		}

		public function signUp(){
			$username = $this->input->post('username');
			
			// echo $username;
			$this->load->model('User_Model');

			if($this->User_Model->createUser($username)){
				echo json_encode(array(
					'message' => array(
						'msg' => 'user registered successfully',
						'code' => '200',
						),
				));
			}
			else{
				echo json_encode(array(
					'message' => array(
						'msg' => 'Error while registering',
						'code' => '101',
					),
				));
			}
		}

		public function addGoal(){
			$this->load->model('Goal_Model');

			if($this->Goal_Model->addGoal()){
				echo json_encode(array(
					'message' => array(
						'text' => 'New goal added successfully',
						'code' => '200',
					),
				));
			}
			else{
				echo json_encode(array(
					'message' => array(
						'text' => 'Could not add goal',
						'error-code' => '101',
					),
				));
			}
		}

		public function removeGoal(){
			$this->load->model('Goal_Model');

			if($this->Goal_Model->deleteGoal()){
				echo json_encode(array(
					'message' => array(
						'text' => 'Goal removed',
						'code' => '200',
					),
				));
			}
			else{
				echo json_encode(array(
					'message' => array(
						'text' => 'Could not remove goal',
						'error-code' => '100',
					),
				));
			}
		}

		public function getGoals(){
			$this->load->model('Goal_Model');

			if($this->Goal_Model->getGoals()){
				echo json_encode(array(
					'message' => array(
						'text' => 'Goal retrieval successful',
						'code' => '200',
					),
				));
			}
			else{
				echo json_encode(array(
					'message' => array(
						'text' => 'Could not retrieve goal',
						'error-code' => '105',
					),
				));
			}
		}

		public function reminder_insert(){
				if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

	    		// The request is using the POST method
					echo json_encode(array(
						'message' => 'reminder failed to add , bad method',
							'error code' => '100',
						)
					);
					return;

				}
				$username = $this->input->post('username');
				$subject = $this->input->post('subject');
				$time=$this->input->post('time');
				$this->load->model('User_Model');

				if(($this->User_Model->reminder_insert($username, $subject, $time))) {
					
					//success message
					echo json_encode(array(
						'message' => 'reminder added',
							'code' => '200',
						)
					);
				}
				//error message
				else {
					echo json_encode(array(
						'message' => 'reminder failed to add',
							'error code' => '100',
						)
					);
		    //redirect('user/login');
				}
		}

		public function reminder_delete()
			{	
				if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {

	     // The request is using the POST method
					echo json_encode(array(
						'message' => 'reminder not deleted, not suitable method',
							'error code' => '100',
						)
					);
					return;

				}
				$username = $this->input->post('username');
				$subject = $this->input->post('subject');
				$time=$this->input->post('time');
				$this->load->model('User_Model');

				if(($this->User_Model->reminder_delete($username, $subject, $time))) {
					
					//success message
					echo json_encode(array(
						'message' => 'reminder deleted',
							'code' => '200',
						)
					);
				}
				//error message
				else {
					echo json_encode(array(
						'message' => 'reminder not deleted',
							'error code' => '100',
						)
					);
		    //redirect('user/login');
				}
			}
	
		public function reminder_show()
			{	
				if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
					echo json_encode(array(
						'message' => 'BAD METHOD',
							'error code' => '100',
						)
					);

				}
				$username = $this->input->post('username');
				$this->load->model('User_Model');

				
				$result = $this->User_Model->reminder_show($username);
					//success message
				 if($result){
		            echo json_encode(array(
						'message' => $result,
						)
					);
		        } 
		        else{
		        	echo json_encode(array(
						'message' => 'no reminder found',
							'code' => '200',
						)
					);
		           
		        }
					
			}
	
		public function updateWeight(){
			$this->load->model('User_Model');
			
			if($this->User_Model->changeWeight()){
				echo json_encode(array(
					'message' => array(
						'text' => 'Weight updated',
						'code' => '200',
					),
				));
			}
			else{
				echo json_encode(array(
					'message' => array(
						'text' => 'Failed to update weight',
						'error-code' => '105',
					),
				));
			}
		}

		public function updateUsername(){
			$this->load->model('User_Model');
			
			if($this->User_Model->changeUsername()){
				echo json_encode(array(
					'message' => array(
						'text' => 'Username updated',
						'code' => '200',
					),
				));
			}
			else{
				echo json_encode(array(
					'message' => array(
						'text' => 'Failed to update username',
						'error-code' => '105',
					),
				));
			}
		}

		public function updatePassword(){
			$this->load->model('User_Model');
			
			if($this->User_Model->changePassword()){
				echo json_encode(array(
					'message' => array(
						'text' => 'Password updated',
						'code' => '200',
					),
				));
			}
			else{
				echo json_encode(array(
					'message' => array(
						'text' => 'Failed to update password',
						'error-code' => '105',
					),
				));
			}
		}
	}
?>