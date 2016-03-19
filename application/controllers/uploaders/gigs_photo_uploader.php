<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('uploader.php');

class Gigs_photo_uploader extends Uploader {
	protected $path_to_uploade_function = 'uploaders/gigs_photo_uploader/multi_uploade'; // path to function. 
	private $files = array();
	protected $default_css_path = 'assets/styles/';
	protected $default_javascript_path = 'assets/scripts/';
	protected $path_to_directory = 'assets/gigs/';
	// table description
	protected $file_table = 'gig_pictures';
	protected $category_id_field = 'gig_id';
	protected $file_name_field = 'picture';
	protected $primary_key = 'id';
	protected $allowed_types = 'gif|jpeg|jpg|png';

	function __construct() {
		parent::__construct();		
	}
}

