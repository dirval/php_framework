<?php
	session_start();
	class Comment extends CI_Controller{
		public function media_comment($id_media){
			$this->load->model('media_model');
			$this->load->model('comment_model');
			$this->load->model('user_model');
			$data['media'] = $this->media_model->getMedia();
			$data['commentMedia'] = $this->comment_model->getComment($id_media);
			if ($data['commentMedia']) {
				$nb_comment = count($data['commentMedia']);
				for ($i=0; $i < $nb_comment; $i++) {
					//print_r($data['commentMedia']);
					$data['user'] = $this->user_model->getCommentUser($data['commentMedia'][$i]['ref_id_user']);
					$data['usersComment'][$i] = array(
						'username' => $data['user'][0]['username'], 
						'comment' => $data['commentMedia'][$i]['post_text'],
						'img_profile' => $data['user'][0]['img_profile']
						);
				}
			}
			$nb_manga = count($data['media']);
			for ($i=0; $i < $nb_manga; $i++) { 
				if ($data['media'][$i]['id'] == $id_media) {
					$_SESSION['mangaComment'] = $data['media'][$i];
				}
			}

			$data['page'] = 'comment/comment';
			$this->load->view('menu/content', $data);
		}

		public function add_comment(){
			$this->load->model('comment_model');
			$userId = $this->input->post('userId');
			$mediaId = $this->input->post('mediaId');
			$rating = $this->input->post('rating');
			$commentText = $this->input->post('comment');

			$insert_data = array(
				'id'=> NULL,
				'ref_id_media' => $mediaId,
				'ref_id_user' => $userId,
				'ranking' => $rating,
				'post_text' => $commentText
			);

			$data['addComment'] = $this->comment_model->addComment($insert_data);

			if (!$data['addComment']) {
				$data['error'] = "You don't success add a new comment!";
			}
			//echo $userId.' '.$mediaId.' '.$rating.' '.$commentText;

			$this->media_comment($mediaId);
		}
	}
?>