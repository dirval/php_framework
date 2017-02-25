<?php
	class Media extends CI_Controller{
		public function show_manga(){
			$this->load->model('media_model');
			$data['manga'] = $this->media_model->getManga();
			$data['page'] = 'media/show_manga';
			$this->load->view('menu/content', $data);
		}

		public function search_manga($letter){
			$this->load->model('media_model');
			$data['search'] = 1;
			$data['manga'] = $this->media_model->getManga();
			$nb_manga = count($data['manga']);
			$x =0;
			for ($i=0; $i <$nb_manga ; $i++) {
				$pos = stripos($data['manga'][$i]['title'], $letter);
				if ($pos === 0) {
					$data['manga_search'][$x] =  $data['manga'][$i];
					$x ++;
				}
			}

			if (!isset($data['manga_search'])) {
				$data['error'] = 'No Manga start by this letter!';
				$data['page'] = 'media/show_manga';
				$this->load->view('menu/content', $data);
			}
			elseif (isset($data['manga_search'])) {
				$data['page'] = 'media/show_manga';
				$this->load->view('menu/content', $data);
			}
		}

		public function search_anime($letter){
			$this->load->model('media_model');
			$data['search'] = 1;
			$data['anime'] = $this->media_model->getAnime();
			$nb_manga = count($data['anime']);
			$x =0;
			for ($i=0; $i <$nb_manga ; $i++) {
				$pos = stripos($data['anime'][$i]['title'], $letter);
				if ($pos === 0) {
					$data['anime_search'][$x] =  $data['anime'][$i];
					$x ++;
				}
			}

			if (!isset($data['anime_search'])) {
				$data['error'] = 'No Anime start by this letter!';
				$data['page'] = 'media/show_anime';
				$this->load->view('menu/content', $data);
			}
			elseif (isset($data['anime_search'])) {
				$data['page'] = 'media/show_anime';
				$this->load->view('menu/content', $data);
			}
		}

		public function show_anime(){
			$this->load->model('media_model');
			$data['anime'] = $this->media_model->getAnime();
			$data["page"] = 'media/show_anime';
			$this->load->view('menu/content', $data);
		}
	}
?>