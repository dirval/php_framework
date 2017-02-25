<?php
	Class User_model extends CI_model{
		public function getUser(){
			$this->db->select('*');
			$this->db->from('user');
			return $this->db->get()->result_array();
		}

		public function registerUser($insert_data){
			$this->db->insert('user', $insert_data);
			if($this->db->affected_rows() > 0){
				return true;
			}
			else{
				return false;

			}
		}

		public function deleteUser($id_user){
			$this->db->where("id=".$id_user);
			$this->db->delete("user");
			if($this->db->affected_rows() > 0){
				return true;
			}
			else{
				return false;

			}
		}

		public function getCommentUser($id_user){
			$this->db->select('username, img_profile');
			$this->db->from('user');
			$this->db->where('id='.$id_user);
			return $this->db->get()->result_array();
		}

		public function userUpdate($insert_data, $id_user){
			$this->db->where("id=".$id_user);
			$this->db->update('user', $insert_data);
			if($this->db->affected_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}
	}

?>
