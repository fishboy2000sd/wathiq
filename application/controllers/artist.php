<?php

class Artist extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('session');	
		$this->load->library('Grocery_crud');
		
	}
		
	public function index() {
		
		try{
			$crud = new Grocery_crud();
			$crud->set_table('artists');
			$crud->set_subject('Artist');
			
			$crud->fields('title', 'description', 'pictures');

			require_once FCPATH . "application/controllers/uploaders/artists_photo_uploader.php";

			//Set the multi uploader functionality
			$artistsPhotoUploader = new Artists_photo_uploader();
			$crud->callback_add_field('pictures', array($artistsPhotoUploader, 'add_upload_fied'));
			$crud->callback_edit_field('pictures', array($artistsPhotoUploader, 'edit_upload_fied'));
			$crud->callback_read_field('pictures', array($artistsPhotoUploader, 'view_upload_fied'));
			$crud->callback_before_insert(array($this, '_set_files'));
			$crud->callback_after_insert(array($this, '_save_files_into_db'));
			$crud->callback_before_update(array($this, '_set_files'));
			$crud->callback_after_update(array($this, '_save_files_into_db'));

			$artistsPhotoUploader->set_js($crud);

			//$crud->unset_jquery();
			$output = $crud->render();

			$this->load->view('crud.php',$output);
	
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
		
	function _set_files($post_array) {
		require_once FCPATH . "application/controllers/uploaders/artists_photo_uploader.php";
		$photo_uploader = new Artists_photo_uploader();
		$photo_uploader->_set_files($post_array);
	}

	function _save_files_into_db($post_array, $primary_key) {
		require_once FCPATH . "application/controllers/uploaders/artists_photo_uploader.php";
		$photo_uploader = new Artists_photo_uploader();
		$photo_uploader->_save_files_into_db($post_array, $primary_key);
	}
}	