<?php
	session_start();
	Class User extends CI_Controller {
		public function validate_login(){
			$this->load->model('User_model');
			$data['users'] = $this->User_model->getUser();
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$passHash = hash('sha256', $password);
			$nb_users = count($data['users']);
			//echo $username;
			//print_r($data['users'][0]['description']);
			for ($i=0; $i < $nb_users ; $i++) { 
				if ($username == $data['users'][$i]['username'] && $passHash == $data['users'][$i]['password']) {
					$data['page']='main/index';
					$validate = 1;
					$_SESSION['user'] = $data['users'][$i];
					$this->load->view('menu/content', $data);
				}
			}
			if (!isset($validate)) {
				$data['error'] = 'Error to login in! Wrong couple Username/Password !';
				$data['page']='main/login';
				$this->load->view('menu/content', $data);
			}
			
		}

		public function register(){
			$this->load->model('User_model');
			// I take all parameters of my form
			$username = $this->input->post('username');
			$pass = $this->input->post('pass');
			$confpass = $this->input->post('confpass');
			$email = $this->input->post('email');
			$description = $this->input->post('description');
			$data['users'] = $this->User_model->getUser();
			$nb_users = count($data['users']);


			for ($i=0; $i < $nb_users ; $i++) { 
				if ($username == $data['users'][$i]['username']) {
					$data['error'] = 'Sorry but this username alredy exist!';
					$data['page'] = 'user/register';
					$error = 1;
					$this->load->view('menu/content', $data);
				}
			}

			if ($pass != $confpass) {
				$error = 1;
				$data['error'] = "Sorry but your password and confirm password dosen't match";
				$data['page'] = 'user/register';
				$this->load->view('menu/content', $data);
			}
			elseif($pass == $confpass && $email != NULL){
				$error = 0;
				$passHash = hash('sha256', $pass);
				$insertData = array(
					"id" => NULL,
					"username" => $username,
					"password" => $passHash,
					"email" => $email,
					"description" => $description,
					"img_profile" => 'images/user/default_profile.png'
					);

				//print_r($insertData);
				$data['addUser'] = $this->User_model->registerUser($insertData);
				//print_r($data['addUser']);

				$data['success'] = 'Your now register! Enjoy your day :)';
				$data['page'] = 'user/register';
				$this->load->view('menu/content', $data);
			}

			if (!isset($error)) {
				$data['page'] = 'user/register';
				$this->load->view('menu/content', $data);
			}
			
			
		}

		// We remove all session variables and destroy too
		public function logout(){
			session_unset();
			session_destroy();
			$data['page'] = 'main/login';
			$this->load->view('menu/content', $data);
		}

		public function profile(){
			$this->load->model('User_model');
			$data['page'] = 'user/profile';
			$this->load->view('menu/content', $data);
		}

		public function updateProfile(){
			$this->load->model('User_model');
			$btnUpdate = $this->input->post('btnUpdateProfile');

			if ($btnUpdate) {
				$pass = $this->input->post('pass');
				$confpass = $this->input->post('confpass');
				$email = $this->input->post('email');
				$description = $this->input->post('description');
				$password = $_SESSION['user']['password'];
				$image_profile = $_SESSION['user']["img_profile"];
				$id_user = $_SESSION['user']['id'];

				$config['upload_path']          = './images/user/';
        	    $config['allowed_types']        = 'gif|jpg|png';
            	$config['max_size']             = 500;
            	$config['max_width']            = 1600;
            	$config['max_height']           = 900;

            	$this->load->library('upload', $config);

            	if ( ! $this->upload->do_upload('img_profile') && $_FILES['img_profile']['name'] != null)
            	{
       	        	$data['errorfile'] = array('error' => $this->upload->display_errors());
                	$data['error'] = "Don't upload file!".$data['errorfile']['error'];
                	$error = 1;

                	$data['page'] = 'user/updateProfile';
                	$this->load->view('menu/content', $data);
            	}
            	else
            	{	
                	$error = 0;
                	$pass_hash = hash('sha256', $pass);
                	if ($pass != NULL) {
                		if ($pass_hash == $_SESSION['user']['password']) {
                			$data['error'] = "Sorry you can't use the same password!";
                		}
                		elseif($pass == $confpass) {
                			$password = $pass_hash;
                		}
                		else{
                			$data['error'] = "Sorry but your password and confpass are differents!";
                		}
                	}

                	if ($_FILES['img_profile']['name'] != null) {
                		$data['result'] = array('upload_data' => $this->upload->data());
                        $image_profile = 'images/user/'.$data['result']['upload_data']['file_name'];
                	}

                	// I check if something change
                	if (($description != $_SESSION['user']['description'] || $email != $_SESSION['user']['email'] || $pass != null || $_FILES['img_profile']['name'] != null) && !isset($data['error'])) {
                		$insertData = array(
                				'password' => $password,
                				'email' => $email,
                				'description' => $description,
                				'img_profile' => $image_profile
                			);

                		$data['userUpdate'] = $this->User_model->userUpdate($insertData, $id_user);
                		if ($data['userUpdate']) {
                			$data['success'] = 'You have update your profile!';
                			$userUpdate = array(
                				'id' => $_SESSION['user']['id'],
                				'username' => $_SESSION['user']['username'],
                				'password' => $password,
                				'email' => $email,
                				'description' => $description,
                				'img_profile' => $image_profile
                			);
                			$_SESSION['user'] = $userUpdate;

                		}
                		elseif (!$data['userUpdate']) {
                			$data['errorUp'] = "You don't success to update your profile!";
                		}
                	}
                	else{
                		$data['errorUp'] = "Sorry but nothing change!";
                	}

                    $data['page'] = 'user/updateProfile';
                    $this->load->view('menu/content', $data);
                }
			}
			
			if (!isset($data['error']) && !isset($data['success'])) {
				$data['page'] = 'user/updateProfile';
				$this->load->view('menu/content', $data);
			}
			
		}
	} 
?>