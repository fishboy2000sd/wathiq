<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploader extends CI_Controller {
	protected $path_to_uploade_function = 'admin/uploader/multi_uploade'; // path to function. 
	private $files = array();
	protected $default_css_path = 'assets/styles/';
	protected $default_javascript_path = 'assets/scripts/';
	protected $path_to_directory = 'assets/uploads/screens/';
	// table description
	protected $file_table = 'screen';
	protected $category_id_field = 'app_id';
	protected $file_name_field = 'screen';
	protected $primary_key = 'id';
	protected $allowed_types = 'apk|gif|jpeg|jpg|png';

	function __construct() {
		parent::__construct();
		$this->load->library('cache');
	}

	function set_default_css_path($path) {
		$this->default_css_path = $path;
	}

	function set_default_js_path($path) {
		$this->default_javascript_path = $path;
	}

	function set_path_to_directory($path) {
		$this->path_to_directory = $path;
	}

	function file_table($table) {
		$this->file_table = $table;
	}

	function set_category_id_field($field) {
		$this->category_id_field = $field;
	}

	function set_primary_key($key) {
		$this->primary_key = $key;
	}

	function set_file_name_field($field) {
		$this->file_name_field = $field;
	}

	function set_js($crud)
	{
		$crud->set_css('assets/grocery_crud/css/ui/simple/' . grocery_CRUD::JQUERY_UI_CSS);
		$crud->set_css('assets/grocery_crud/css/jquery_plugins/file_upload/file-uploader.css');
		$crud->set_css('assets/grocery_crud/css/jquery_plugins/file_upload/jquery.fileupload-ui.css');
		$crud->set_css('assets/styles/multi_uploader.css');
		$crud->set_js('assets/grocery_crud/js/' . grocery_CRUD::JQUERY);
		$crud->set_js('assets/grocery_crud/js/jquery_plugins/ui/' . grocery_CRUD::JQUERY_UI_JS);
		$crud->set_js('assets/grocery_crud/js/jquery_plugins/tmpl.min.js');
		$crud->set_js('assets/grocery_crud/js/jquery_plugins/load-image.min.js');
		$crud->set_js('assets/grocery_crud/js/jquery_plugins/jquery.iframe-transport.js');
		$crud->set_js('assets/grocery_crud/js/jquery_plugins/jquery.fileupload.js');
		$crud->set_js('assets/grocery_crud/js/jquery_plugins/config/jquery.fileupload.config.js');
		$crud->set_css('assets/grocery_crud/css/jquery_plugins/fancybox/jquery.fancybox.css');
		$crud->set_js('assets/grocery_crud/js/jquery_plugins/jquery.fancybox.pack.js');
		$crud->set_js('assets/grocery_crud/js/jquery_plugins/jquery.easing-1.3.pack.js');
		$crud->set_js('assets/scripts/jquery.mousewheel.js');
		$crud->set_js('assets/grocery_crud/js/jquery_plugins/config/jquery.fancybox.config.js');
		return $crud;
	}

	function add_upload_fied()
	{
		$html = '
		<div>
			<span class="fileinput-button qq-upload-button" id="' . $this->file_name_field . '_upload-button-svc">
				<span>Upload a file</span>
				<input type="file" name="' . $this->file_name_field . '_multi_aploade" id="' . $this->file_name_field . '_multi_aploade_field" >
			</span> <span class="qq-upload-spinner" id="ajax-loader-file" style="display:none;"></span>
			<span id="' . $this->file_name_field . '_progress-multiple" style="display:none;"></span>
		</div>
		<select name="' . $this->file_name_field . '_files[]" multiple="multiple" size="8" class="multiselect" id="' . $this->file_name_field . '_multiple_select" style="display:none;">
		</select>
		<div id="' . $this->file_name_field . '_list_svc" class="mutiupload_list" style="margin-top: 40px;">
		</div>';
		$html.=$this->JS();
		return $html;
	}

	function edit_upload_fied($value, $primary_key)
	{
		//var_dump(get_object_vars($this));
		$files = $this->db->get_where($this->file_table, array($this->category_id_field => $primary_key))->result_array();
		$html = '
		<div>
			<span class="fileinput-button qq-upload-button" id="' . $this->file_name_field . '_upload-button-svc">
				<span>Upload a file</span>
				<input type="file" name="' . $this->file_name_field . '_multi_aploade" id="' . $this->file_name_field . '_multi_aploade_field" >
			</span> <span class="qq-upload-spinner" id="ajax-loader-file" style="display:none;"></span>
			<span id="' . $this->file_name_field . '_progress-multiple" style="display:none;"></span>
		</div>';

		$html.= '<select name="' . $this->file_name_field . '_files[]" multiple="multiple" size="8" class="multiselect" id="' . $this->file_name_field . '_multiple_select" style="display:none;">';
		if (!empty($files))
		{
			foreach ($files as $items)
			{
				$html.="<option value=" . $items[$this->file_name_field] . " selected='selected'>" . $items[$this->file_name_field] . "</option>";
			}
		}
		$html.='</select>';
		$html.='<div id="' . $this->file_name_field . '_list_svc" class="mutiupload_list" style="margin-top: 40px;">';
		if (!empty($files))
		{
			foreach ($files as $items)
			{
				if ($this->_is_image($items[$this->file_name_field]) === true)
				{
					$html.= '<div id="' . $items[$this->file_name_field] . '">';
					$html.= '<a href="' . base_url() . $this->path_to_directory . $items[$this->file_name_field] . '" class="image-thumbnail" id="fancy_' . $items[$this->file_name_field] . '">';
					$html.='<img src="' . base_url() . $this->path_to_directory . $items[$this->file_name_field] . '" height="50"/>';
					$html.='</a><br>';
					$html.='<a href="javascript:" onclick="delete_' . $this->file_name_field . '_svc($(this),\'' . $items[$this->file_name_field] . '\')" style="color:red;" >Delete</a>';
					$html.='</div>';
				}
				else
				{
					$html.='<div id="' . $items[$this->file_name_field] . '" >
					<span>' . $items[$this->file_name_field] . '</span>
					<a href="javascript:" onclick="delete_' . $this->file_name_field . '_svc($(this),\'' . $items[$this->file_name_field] . '\')" style="color:red;" >Delete</a>
					</div>';
				}
			}
		}
		$html.='</div>';
		$html.=$this->JS();
		return $html;
	}

	function view_upload_fied($value, $primary_key)
	{
		//var_dump(get_object_vars($this));
		$files = $this->db->get_where($this->file_table, array($this->category_id_field => $primary_key))->result_array();
		
		$html = '<select name="' . $this->file_name_field . '_files[]" multiple="multiple" size="8" class="multiselect" id="' . $this->file_name_field . '_multiple_select" style="display:none;">';
		if (!empty($files))
		{
			foreach ($files as $items)
			{
				$html.="<option value=" . $items[$this->file_name_field] . " selected='selected'>" . $items[$this->file_name_field] . "</option>";
			}
		}
		$html.='</select>';
		$html.='<div id="' . $this->file_name_field . '_list_svc" class="mutiupload_list" style="margin-top: 40px;">';
		if (!empty($files))
		{
			foreach ($files as $items)
			{
				if ($this->_is_image($items[$this->file_name_field]) === true)
				{
					$html.= '<div id="' . $items[$this->file_name_field] . '">';
					$html.= '<a href="' . base_url() . $this->path_to_directory . $items[$this->file_name_field] . '" class="image-thumbnail" id="fancy_' . $items[$this->file_name_field] . '">';
					$html.='<img src="' . base_url() . $this->path_to_directory . $items[$this->file_name_field] . '" height="50"/>';
					$html.='</a>';
					$html.='</div>';
				}
				else
				{
					$html.='<div id="' . $items[$this->file_name_field] . '" >
					<span>' . $items[$this->file_name_field] . '</span>
					<a href="javascript:" onclick="delete_' . $this->file_name_field . '_svc($(this),\'' . $items[$this->file_name_field] . '\')" style="color:red;" >Delete</a>
					</div>';
				}
			}
		}
		$html.='</div>';
		$html.=$this->JS();
		return $html;
	}

	function _is_image($name)
	{
		return ((substr($name, -4) == '.jpg')
			|| (substr($name, -4) == '.png')
			|| (substr($name, -5) == '.jpeg')
			|| (substr($name, -4) == '.gif' )
			|| (substr($name, -5) == '.tiff')) ? true : false;
	}

	 function JS()
	 {
	 	$js = "<script>
 		if (typeof string_progress === 'undefined') {
 			var string_upload_file 	= 'Upload a file';
			var string_delete_file 	= 'Deleting file';
			var string_progress 			= 'Progress: ';
			var error_on_uploading 			= 'An error has occurred on uploading.';
			var message_prompt_delete_file 	= 'Are you sure that you want to delete this file?';

			var error_max_number_of_files 	= 'You can only upload one file each time.';
			var error_accept_file_types 	= 'You are not allow to upload this kind of extension.';
			var error_max_file_size 		= 'The uploaded file exceeds the 5000MB directive that was specified.';
			var error_min_file_size 		= 'You cannot upload an empty file.';

 		}	
	 	function delete_" . $this->file_name_field . "_svc(link,filename)
	 	{
	 		$('#" . $this->file_name_field . "_multiple_select option[value=\"'+filename+'\"]').remove();
	 		link.parent().remove();
	 		$.post('" . base_url() . $this->path_to_uploade_function . "/delete_file', 'file_name='+filename, function(json){
	 			if(json.succes == 'true')
	 			{
	 				console.log('json data', json);
	 			}
	 		}, 'json');
}
$(document).ready(function() {
	$('#" . $this->file_name_field . "_multi_aploade_field').fileupload({
		url: '" . base_url() . $this->path_to_uploade_function . "/uploade',
		sequentialUploads: true,
		cache: false,
		autoUpload: true,
		dataType: 'json',
		acceptFileTypes: /(\.|\/)(" . $this->config->item('grocery_crud_file_upload_allow_file_types') . ")$/i,
		limitMultiFileUploads: 1,
		beforeSend: function()
		{
			$('#" . $this->file_name_field . "_upload-button-svc').slideUp('fast');
			$('#ajax-loader-file').css('display','block');
			$('#" . $this->file_name_field . "_progress-multiple').css('display','block');
		},
		progress: function (e, data) {
			$('#" . $this->file_name_field . "_progress-multiple').html(string_progress + parseInt(data.loaded / data.total * 100, 10) + '%');
		},
		done: function (e, data)
		{
			console.log(data.result);
			if(data.result.success == 'false') {
				alert(data.result.error);
				$('#" . $this->file_name_field . "_upload-button-svc').show('fast');
				$('#ajax-loader-file').css('display','none');
				$('#" . $this->file_name_field . "_progress-multiple').css('display','none');
				$('#" . $this->file_name_field . "_progress-multiple').html('');
				return;
			}
			$('#" . $this->file_name_field . "_multiple_select').append('<option value=\"'+data.result.file_name+'\" selected=\"selected\">'+data.result.file_name+'</select>');
			var is_image = (data.result.file_name.substr(-4) == '.jpg'
				|| data.result.file_name.substr(-4) == '.png'
				|| data.result.file_name.substr(-5) == '.jpeg'
				|| data.result.file_name.substr(-4) == '.gif'
				|| data.result.file_name.substr(-5) == '.tiff')
				? true : false;
				var html;
				if(is_image==true)
				{
					html='<div id=\"'+data.result.file_name+'\" ><a href=\"" . base_url() . $this->path_to_directory . "'+data.result.file_name+'\" class=\"image-thumbnail\" id=\"fancy_'+data.result.file_name+'\">';
					html+='<img src=\"" . base_url() . $this->path_to_directory . "'+data.result.file_name+'\" height=\"50\"/>';
					html+='</a><br><a href=\"javascript:;\" onclick=\"delete_" . $this->file_name_field . "_svc($(this),\''+data.result.file_name+'\')\" style=\"color:red;\" >Delete</a></div>';
					$('#" . $this->file_name_field . "_list_svc').append(html);
					$('.image-thumbnail').fancybox({
						'transitionIn' : 'elastic',
						'transitionOut' : 'elastic',
						'speedIn' : 600,
						'speedOut' : 200,
						'overlayShow' : true
					});
				}
				else
				{
					html = '<div id=\"'+data.result.file_name+'\" ><span>'+data.result.file_name+'</span> <br><a href=\"javascript:\" onclick=\"delete_" . $this->file_name_field . "_svc($(this),\''+data.result.file_name+'\')\" style=\"color:red;\" >Delete</a></div>';
					$('#" . $this->file_name_field . "_list_svc').append(html);
				}
					$('#" . $this->file_name_field . "_upload-button-svc').show('fast');
					$('#ajax-loader-file').css('display','none');
					$('#" . $this->file_name_field . "_progress-multiple').css('display','none');
					$('#" . $this->file_name_field . "_progress-multiple').html('');
				}
			});

		});
</script>";
return $js;
}

	function multi_uploade($action = NULL)
	{
		switch ($action)
		{
			case 'uploade':
			$this->uploade_file();

			break;
			case 'delete_file':
			$this->delete_file();

			break;

			default:

			break;
		}
	}

	function uploade_file()
	{
		$json = NULL;
		$config['upload_path'] = $this->path_to_directory;
		//$config['allowed_types'] = $this->config->item('grocery_crud_file_upload_allow_file_types');
		$config['allowed_types'] = $this->allowed_types;
		//$config['encrypt_name'] = TRUE;
		$config['remove_spaces'] = TRUE;
		$config['max_filename'] = 0;
		$config['file_name'] = trim_unique_filename($_FILES[$this->file_name_field . '_multi_aploade']['name']);
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($this->file_name_field . '_multi_aploade'))
		{
			$json['error'] = $this->upload->display_errors() . "Allowed file types are " . $this->allowed_types ;
			$json['success'] = 'false';
		}
		else
		{
			$uploade_data = $this->upload->data();
			$json['success'] = 'true';
			$json['file_name'] = $uploade_data['file_name'];
		}
		echo json_encode($json);
		exit;
	}

	function _set_files($post_array)
	{
		$this->files = $post_array[$this->file_name_field . '_files'];		
		$sessionId = $this->session->userdata('session_id');
		$this->cache->write($this->files, $sessionId . '_' . $this->file_name_field, 3600);
		
		unset($post_array[$this->file_name_field . '_files']);
		return $post_array;
	}

	function _save_files_into_db($post_array, $primary_key)
	{
		$sessionId = $this->session->userdata('session_id');
		$this->files = $this->cache->get($sessionId . '_' . $this->file_name_field);
		$this->db->delete($this->file_table, array($this->category_id_field => $primary_key));
		$files = array();
		if (!empty($this->files))
		{
			foreach ($this->files as $file)
			{
				$files[] = array($this->category_id_field => $primary_key, $this->file_name_field => $file);
			}
		}
		if (!empty($files))
		{
			$this->db->insert_batch($this->file_table, $files);
		}
		$this->cache->delete($sessionId . '_' . $this->file_name_field);
		return true;
	}

	function delete_file($file_name = NULL)
	{
		$file_name = $this->input->post('file_name') ? $this->input->post('file_name') : $file_name;
		$this->db->delete($this->file_table, array($this->file_name_field => $file_name));
		if (file_exists($this->path_to_directory . $file_name))
		{
			unlink($this->path_to_directory . $file_name);
		}
		$json = array('success' => true);
		echo json_encode($json);
		exit;
	}

	function _delete_files($primary_key) {
		require_once FCPATH . "application/controllers/uploaders/artists_photo_uploader.php";
		$photo_uploader = new Artists_photo_uploader();
		$photo_uploader->handle_row_delete($primary_key);
		
		require_once FCPATH . "application/controllers/uploaders/artists_video_uploader.php";
		$video_uploader = new Artists_video_uploader();
		$video_uploader->handle_row_delete($primary_key);
	}

	function handle_row_delete($primary_key) {
        $this->load->model('common_model', 'cModel');
        //Retrive all the rows from the table where the files uploaded are being recorded for.
        $rows = $this->cModel->getAllFor($this->file_table, $this->category_id_field, $primary_key);
        foreach ($rows as $row) {
            //Delete each uploaded file from backend
            $file = $row[$this->file_name_field];
            $final_path = $this->path_to_directory . $file;
            try {
                unlink($final_path);
            } catch (Exception $e) {
                //Even if there is an exception ... here we aint much bothered, like file dose not exists or whatever.
            }
            //Once the file is deleted ... delete that record from the table
            $this->cModel->delete($file_table, $this->primary_key, $row[$this->primary_key]);
        }
    }

	function test() {
		echo "This is a test";
	}
}

