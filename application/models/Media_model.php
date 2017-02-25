<?php
	Class Media_model extends CI_model{
		public function getMedia(){
			$this->db->select('*');
			$this->db->from('media');
			return $this->db->get()->result_array();
		}

		public function getManga(){
			$this->db->select('*');
			$this->db->from('media');
			$this->db->where('type=1');
			return $this->db->get()->result_array();
		}

		public function getAnime(){
			$this->db->select('*');
			$this->db->from('media');
			$this->db->where('type=0');
			return $this->db->get()->result_array();
		}

		public function addMedia($insert_data){
			$this->db->insert("media" ,$insert_data);
			if($this->db->affected_rows() > 0){
				return true;
			}
			else{
				return false;

			}
		}

		public function deleteMedia($id_media){
			$this->db->where('id ='.$id_manga);
			$this->db->delete('media');
			if($this->db->affected_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}

		public function updateMedia($insert_data, $id_media){
			$this->db->where("id=".$id_media);
			$this->db->update('media', $insert_data);
			if($this->db->affected_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}
	}

?>
