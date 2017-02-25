<?php
	Class Main extends CI_Controller {
		public function index(){
			session_start();
			if (isset($_SESSION['user'])) {
				$data['page']='main/index';
				$this->load->view('menu/content', $data);
			}
			else {
				$data['page']='main/login';
				$this->load->view('menu/content', $data);
			}
		}
	} 
?>