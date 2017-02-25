<?php
	session_start();
	class Admin extends CI_Controller{
//~~~~~~~~~~~~~~~~~~ Manga main page ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		public function manga(){
			$data['page'] = 'admin/manga';
			$this->load->view('menu/content', $data);
		}
//~~~~~~~~~~~~~~~~~~ Anime main page ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		public function anime(){
			$data["page"] = 'admin/anime';
			$this->load->view('menu/content', $data);
		}

//~~~~~~~~~~~~~~~~~~ User, we can just remove ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		public function user(){
			$this->load->model('user_model');
			$data['users'] = $this->user_model->getUser();
			$data["page"] = 'admin/user';
			$this->load->view('menu/content', $data);
		}

//~~~~~~~~~~~~~~~~~~ Remove User ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		public function remove_user($id_user, $conf){
			$this->load->model('user_model');
			$data['id'] = $id_user;
			$data['users'] = $this->user_model->getUser();
			$nb_users = count($data['users']);

			for ($i=0; $i < $nb_users ; $i++) { 
				if ($data['users'][$i]['id'] == $id_user) {
					$date['user'] = $data['users'][$i];
				}
			}

			if (isset($conf) && $conf == 'yes') {
				$data['user_remove'] = $this->user_model->deleteUser($data['id']);
			}
			elseif (isset($conf) && $conf == 'null') {
				$data['page'] = 'admin/user';
				$this->load->view('menu/content', $data);
			}
			elseif (isset($conf) && $conf == 'no') {
				$data['cancel'] = 'You have cancel!';
				$data['page'] = 'admin/user';
				$this->load->view('menu/content', $data);
			}

			if (isset($data['user_remove'])) {
				$data['success'] = 'You have remove the user '.$date['user']['username'];
				$data['users'] = $this->user_model->getUser(); //i reload a new user table
				$data['page'] = 'admin/user';
				$this->load->view('menu/content', $data);
			}
			elseif (isset($data['user_remove']) && $data['user_remove'] == false) {
				$data['error'] = "You don't success remove the user!";
				$data['page'] = 'admin/user';
				$this->load->view('menu/content', $data);
			}
		}

//~~~~~~~~~~~~~~~~~~ Add Manga ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		public function add_manga(){
			$this->load->model('media_model');
			$btn = $this->input->post('save');

			if (isset($btn)) {
				//take all parameters of my form
				$title = $this->input->post('title');
				$author = $this->input->post('author');
				$years = $this->input->post('years');
				$genre = $this->input->post('genre');
				$in_anime = $this->input->post('in_anime');
				$description = $this->input->post('description');
				
				$config['upload_path']          = './images/manga/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('image_pres'))
                {
                        $data['errorfile'] = array('error' => $this->upload->display_errors());
                        $data['error'] = "Don't upload file!".$data['errorfile']['error'];
                        $error = 1;

                        $data['page'] = 'admin/add_manga';
                        $this->load->view('menu/content', $data);
                }
                else
                {
                        $error = 0;

                        $data['manga'] = $this->media_model->getManga();
                        $nb_Manga = count($data['manga']);

                        for ($i=0; $i < $nb_Manga; $i++) { 
                        	if ($data['manga'][$i]['title'] == $title) {
                        		$data['error'] = 'A manga with the same title alredy exist!';
                        		$title_exist = 1;
                        	}
                        }

                        if (!isset($title_exist)) {
                        	$data['result'] = array('upload_data' => $this->upload->data());
                        	$image_Path = 'images/manga/'.$data['result']['upload_data']['file_name'];
                        	$insert_data = array(
                        		'id' => NULL,
                        		'type' => 1,
                        		'title' => $title,
                        		'author' => $author,
                        		'genre' => $genre,
                        		'year' => $years,
                        		'in_anime' => $in_anime,
                        		'studio' => NULL,
                        		'description' => $description,
                        		'image' => $image_Path
                        		 );

                        	$data['addManga'] = $this->media_model->addMedia($insert_data);
                        	//print_r($data['addManga']);

                        	if ($data['addManga'] == true) {
                        		$data['success'] = 'A new manga have been add!';
                        	}
                        	elseif ($data['addManga'] == false) {
                        		$data['error'] = 'Not success  to add a manga'; 
                        	}
                        	
                        }
                        //$data['imgpath'] = $image_Path;

                        $data['page'] = 'admin/add_manga';
                        $this->load->view('menu/content', $data);
                }

				//print_r($image);
			}

			if (!isset($error)) {
				$data["page"] = 'admin/add_manga';
				$this->load->view('menu/content', $data);
			}
			
		}

//~~~~~~~~~~~~~~~~~~ Remove Manga ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		public function remove_manga(){
			$this->load->model('media_model');
			$btnSearch = $this->input->post('search');
			$btnYes = $this->input->post('yes');
			$btnNo = $this->input->post('no');

			if (isset($btnSearch)){

				$title = $this->input->post('title');
				$data['manga'] = $this->media_model->getManga();
				$nb_Manga = count($data['manga']);
				//print_r($data['manga']);

				for ($i=0; $i < $nb_Manga ; $i++) { 
					if ($title == $data['manga'][$i]['title']) {
						$_SESSION['manga_found'] = $data['manga'][$i];
					}
				}

				if(!isset($_SESSION['manga_found'])){
					$data['error'] = 'Sorry any Manga found with the same title!';
					$data['page'] = 'admin/remove_manga';
					$this->load->view('menu/content', $data);
				}
				elseif(isset($_SESSION['manga_found'])){
					$data['found'] = 'Manga found!';
					$data['page'] = 'admin/remove_manga';
					$this->load->view('menu/content', $data);
				}
			}

			if (isset($btnYes)) {
				$data['yesDelete'] = 'You choose to delete '.$_SESSION['manga_found']['title'];
				$data['remove'] = $this->media_model->deleteMedia($_SESSION['manga_found']['id']);
				print_r($data['remove']);
				unset($_SESSION['manga_found']);
				$data["page"] = 'admin/remove_manga';
				$this->load->view('menu/content', $data);
			}
			elseif (isset($btnNo)) {
				$data['noDelete'] = 'You choose to cancel!';
				unset($_SESSION['manga_found']);
				$data["page"] = 'admin/remove_manga';
				$this->load->view('menu/content', $data);
			}

			if (!isset($data['error']) && !isset($data['found']) && !isset($btnYes) && !isset($btnNo)) {
				$data["page"] = 'admin/remove_manga';
				$this->load->view('menu/content', $data);
			}
			
		}

//~~~~~~~~~~~~~~~~~~ Update Manga ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		public function update_manga(){
			$this->load->model('media_model');
			$btnSearch = $this->input->post('search');
			$btnUpdate = $this->input->post('update');

			if (isset($btnSearch)) {
				$title = $this->input->post('title');
				$data['manga'] = $this->media_model->getManga();
				$nb_Manga = count($data['manga']);

				for ($i=0; $i < $nb_Manga ; $i++) { 
					if ($title == $data['manga'][$i]['title']) {
						$_SESSION['manga_found'] = $data['manga'][$i];
					}
				}

				if(!isset($_SESSION['manga_found'])){
					$data['error'] = 'Sorry any Manga found with the same title!';
					$data['page'] = 'admin/update_manga';
					$this->load->view('menu/content', $data);
				}
				elseif(isset($_SESSION['manga_found'])){
					$data['found'] = 'Manga found!';
					$data['page'] = 'admin/update_manga';
					$this->load->view('menu/content', $data);
				}
			}

			if (isset($btnUpdate)) {
				$title = $this->input->post('title');
				$author = $this->input->post('author');
				$years = $this->input->post('years');
				$genre = $this->input->post('genre');
				$description = $this->input->post('description');
				
				$config['upload_path']          = './images/manga/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('image_pres') && $_FILES['image_pres']['name'] != null)
                {
                    $data['errorfile'] = array('error' => $this->upload->display_errors());
                    $data['error'] = "Don't upload file!".$data['errorfile']['error'];
                    $error = 1;
                    $data['page'] = 'admin/update_manga';
                    $this->load->view('menu/content', $data);
                }
                else
                {
                    $error = 0;
                    $data['manga'] = $this->media_model->getManga();
                    $nb_Manga = count($data['manga']);

                    if ($_SESSION['manga_found']['title'] != $title) {
                    	for ($i=0; $i < $nb_Manga; $i++) {
                      		if ($data['manga'][$i]['title'] == $title) {
                      			$data['error'] = 'A manga with the same title alredy exist!';
                       			$title_exist = 1;
                       			$data['page'] = 'admin/update_manga';
                    			$this->load->view('menu/content', $data);
                       		}
                    	}
                	}

                    if (!isset($title_exist)) {
                       	$data['result'] = array('upload_data' => $this->upload->data());
                       	$image_Path = $_SESSION['manga_found']['image'];
                       	if ($data['result']['upload_data']['file_name'] != null) {
                       		$image_Path = 'images/manga/'.$data['result']['upload_data']['file_name'];
                       	}

                       	$insert_data = array(
                      		'title' => $title,
                       		'author' => $author,
                       		'genre' => $genre,
                       		'year' => $years,
                       		'description' => $description,
                       		'image' => $image_Path
                   		);

                        $data['updateManga'] = $this->media_model->updateMedia($insert_data, $_SESSION['manga_found']['id']);
                        //print_r($data['updateManga']);

                        if ($data['updateManga'] == true) {
                        	$data['success'] = 'A manga have been update!';
                        }
                        elseif ($data['updateManga'] == false) {
                       		$data['error'] = 'Not success  to update a manga'; 
                        }
                        unset($_SESSION['manga_found']);
                        	
                    }

                    if (!isset($error)) {
                    	$data['page'] = 'admin/update_manga';
                    	$this->load->view('menu/content', $data);
                    }
                    
                }
			}

			if (!isset($data['error']) && !isset($data['found'])) {
				$data["page"] = 'admin/update_manga';
				$this->load->view('menu/content', $data);
			}
		}

//~~~~~~~~~~~~~~~~~~ Add anime ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		public function add_anime(){
			$this->load->model('Media_model');
			$btn = $this->input->post('save');

			if (isset($btn)) {
				//take all parameters of my form
				$title = $this->input->post('title');
				$author = $this->input->post('author');
				$years = $this->input->post('years');
				$genre = $this->input->post('genre');
				$studio = $this->input->post('studio');
				$description = $this->input->post('description');
				
				$config['upload_path']          = './images/anime/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config); // I load the upload library with my config

                if ( ! $this->upload->do_upload('image_pres'))
                {
                        $data['error'] = array('error' => $this->upload->display_errors());
                        $error = 1;

                        $data['page'] = 'admin/add_anime';
                        $this->load->view('menu/content', $data);
                }
                else
                {
                        $error = 0;

                        $data['anime'] = $this->Media_model->getAnime();
                        $nb_Manga = count($data['anime']);

                        // I check if the title alredy exist
                        for ($i=0; $i < $nb_Manga; $i++) { 
                        	if ($data['anime'][$i]['title'] == $title) {
                        		$data['error'] = 'A anime with the same title alredy exist!';
                        		$title_exist = 1;
                        	}
                        }

                        // I upload my image in the good folder and add my new anime
                        if (!isset($title_exist)) {
                        	$data['result'] = array('upload_data' => $this->upload->data());
                        	$image_Path = 'images/anime/'.$data['result']['upload_data']['file_name'];
                        	$insert_data = array(
                        		'id' => NULL,
                        		'type' => 0,
                        		'title' => $title,
                        		'author' => $author,
                        		'genre' => $genre,
                        		'year' => $years,
                        		'in_anime' => NULL,
                        		'studio' => $studio,
                        		'description' => $description,
                        		'image' => $image_Path
                        		 );

                        	$data['addAnime'] = $this->Media_model->addMedia($insert_data); //call function for add

                        	if ($data['addAnime'] == true) {
                        		$data['success'] = 'A new Anime have been add!';
                        	}
                        	elseif ($data['addAnime'] == false) {
                        		$data['error'] = 'Not success  to add a Anime'; 
                        	}
                        	
                        }

                        $data['page'] = 'admin/add_anime';
                        $this->load->view('menu/content', $data);
                }

				//print_r($image);
			}

			if (!isset($error)) {
				$data["page"] = 'admin/add_anime';
				$this->load->view('menu/content', $data);
			}
		}

//~~~~~~~~~~~~~~~~~~ remove anime ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		public function remove_anime(){
			$this->load->model('media_model');
			$btnSearch = $this->input->post('search');
			$btnYes = $this->input->post('yes');
			$btnNo = $this->input->post('no');

			if (isset($btnSearch)){
				$title = $this->input->post('title');
				$data['anime'] = $this->media_model->getAnime();
				$nb_anime = count($data['anime']);

				for ($i=0; $i < $nb_anime ; $i++) { 
					if ($title == $data['anime'][$i]['title']) {
						$_SESSION['anime_found'] = $data['anime'][$i];
					}
				}

				if(!isset($_SESSION['anime_found'])){
					$data['error'] = 'Sorry any Anime found with the same title!';
					$data['page'] = 'admin/remove_anime';
					$this->load->view('menu/content', $data);
				}
				elseif(isset($_SESSION['anime_found'])){
					$data['found'] = 'Anime found!';
					$data['page'] = 'admin/remove_anime';
					$this->load->view('menu/content', $data);
				}
			}

			if (isset($btnYes)) {
				$data['yesDelete'] = 'You choose to delete '.$_SESSION['anime_found']['title'];
				$data['remove'] = $this->media_model->deleteMedia($_SESSION['anime_found']['id']);
				print_r($data['remove']);
				unset($_SESSION['anime_found']);
				$data["page"] = 'admin/remove_anime';
				$this->load->view('menu/content', $data);
			}
			elseif (isset($btnNo)) {
				$data['noDelete'] = 'You choose to cancel!';
				unset($_SESSION['anime_found']);
				$data["page"] = 'admin/remove_anime';
				$this->load->view('menu/content', $data);
			}

			if (!isset($data['error']) && !isset($data['found']) && !isset($btnYes) && !isset($btnNo)) {
				$data["page"] = 'admin/remove_anime';
				$this->load->view('menu/content', $data);
			}
		}

//~~~~~~~~~~~~~~~~~~ Update anime ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		public function update_anime(){
			$this->load->model('media_model');
			$btnSearch = $this->input->post('search');
			$btnUpdate = $this->input->post('update');

			if (isset($btnSearch)) {
				$title = $this->input->post('title');
				$data['anime'] = $this->media_model->getAnime();
				$nb_Manga = count($data['anime']);

				for ($i=0; $i < $nb_Manga ; $i++) { 
					if ($title == $data['anime'][$i]['title']) {
						$_SESSION['anime_found'] = $data['anime'][$i];
					}
				}

				if(!isset($_SESSION['anime_found'])){
					$data['error'] = 'Sorry any anime found with the same title!';
					$data['page'] = 'admin/update_manga';
					$this->load->view('menu/content', $data);
				}
				elseif(isset($_SESSION['anime_found'])){
					$data['found'] = 'Anime found!';
					$data['page'] = 'admin/update_anime';
					$this->load->view('menu/content', $data);
				}
			}

			if (isset($btnUpdate)) {
				$title = $this->input->post('title');
				$author = $this->input->post('author');
				$years = $this->input->post('years');
				$genre = $this->input->post('genre');
				$studio = $this->input->post('studio');
				$description = $this->input->post('description');
				
				$config['upload_path']          = './images/anime/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('image_pres') && $_FILES['image_pres']['name'] != null)
                {
                    $data['errorfile'] = array('error' => $this->upload->display_errors());
                    $data['error'] = "Don't upload file!".$data['errorfile']['error'];
                    $error = 1;
                    $data['page'] = 'admin/update_anime';
                    $this->load->view('menu/content', $data);
                }
                else
                {
                    $error = 0;
                    $data['anime'] = $this->media_model->getAnime();
                    $nb_Manga = count($data['anime']);

                    if ($_SESSION['anime_found']['title'] != $title) {
                    	for ($i=0; $i < $nb_Manga; $i++) {
                      		if ($data['anime'][$i]['title'] == $title) {
                      			$data['error'] = 'A anime with the same title alredy exist!';
                       			$title_exist = 1;
                       			$data['page'] = 'admin/update_anime';
                    			$this->load->view('menu/content', $data);
                       		}
                    	}
                	}

                    if (!isset($title_exist)) {
                       	$data['result'] = array('upload_data' => $this->upload->data());
                       	$image_Path = $_SESSION['anime_found']['image'];
                       	if ($data['result']['upload_data']['file_name'] != null) {
                       		$image_Path = 'images/anime/'.$data['result']['upload_data']['file_name'];
                       	}

                       	$insert_data = array(
                      		'title' => $title,
                       		'author' => $author,
                       		'genre' => $genre,
                       		'year' => $years,
                       		'studio' => $studio,
                       		'description' => $description,
                       		'image' => $image_Path
                   		);


                        $data['updateAnime'] = $this->media_model->updateMedia($insert_data, $_SESSION['anime_found']['id']);
                        //print_r($data['updateManga']);

                        if ($data['updateAnime'] == true) {
                        	$data['success'] = 'A anime have been update!';
                        }
                        elseif ($data['updateAnime'] == false) {
                       		$data['error'] = 'Not success  to update a anime'; 
                        }
                        unset($_SESSION['anime_found']);
                        	
                    }

                    if (!isset($error)) {
                    	$data['page'] = 'admin/update_anime';
                    	$this->load->view('menu/content', $data);
                    }
                    
                }
			}

			if (!isset($data['error']) && !isset($data['found'])) {
				$data["page"] = 'admin/update_anime';
				$this->load->view('menu/content', $data);
			}
		}
	}
?>