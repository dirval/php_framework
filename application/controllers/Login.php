<?php
	Class Login extends CI_Controller {
		public function login(){
			$data['page']='main/login';
			$this->load->view('menu/content', $data);
		}
	} 
?>