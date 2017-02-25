<?php
	Class Comment_model extends CI_model{
		public function addComment($insert_data){
			$this->db->insert('comment', $insert_data);
			if($this->db->affected_rows() > 0){
				return true;
			}
			else{
				return false;

			}
		}

		public function getComment($id_media){
			$this->db->select('*');
			$this->db->from('comment');
			$this->db->where("ref_id_media=".$id_media);
			return $this->db->get()->result_array();
		}

	}
?>