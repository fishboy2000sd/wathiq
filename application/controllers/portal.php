<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portal extends MY_Controller {
	var $name = "";
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		$this->load->library('session');

		$this->load->library('grocery_CRUD');
		$this->lang->load('labels', 'arabic');

		//$output['name'] = "name";

		//$this->name = $this->session->userdata('username');//"name";
		//echo "<pre>"; print_r($this->session->all_userdata()); echo "</pre>"; exit;


	}

	public function test(){
		$privileges = Model\Privilege::find_by_id(2);

		foreach($privileges as $privilege) :               
            echo $privilege->id;
            echo $privilege->name;
            //print_r( $privilege->role() );                      
            echo "<pre>";
			print_r($privilege->role());
			echo "</pre>";
        endforeach;

		/*echo "<pre>";
		//print_r($privileges[0]->meta->get('entities'));
		print_r($privileges);
		echo "</pre>";*/

	}

	

	public function index()
	{
		//redirect(site_url('portal/projects_management'));
		
		

		//$output->js_files[] = base_url()."assets/grocery_crud/js/jquery-1.11.1.min.js";
		$output->js_files[] = base_url()."assets/grocery_crud/js/jquery-1.11.1.min.js";

		$output->js_files[] = base_url()."assets/grocery_crud/js/jquery_plugins/ui/jquery-ui-1.10.3.custom.min.js";
		$output->js_files[] = base_url()."assets/grocery_crud/js/jquery_plugins/jquery.easing-1.3.pack.js";
		$output->js_files[] = base_url()."assets/grocery_crud/js/jquery_plugins/jquery.fancybox-1.3.4.js";
		$output->js_files[] = base_url()."assets/grocery_crud/themes/flexigrid/js/jquery.printElement.min.js";
		$output->js_files[] = base_url()."assets/grocery_crud/js/jquery_plugins/jquery.numeric.min.js";
		$output->js_files[] = base_url()."assets/grocery_crud/js/jquery_plugins/jquery.form.min.js";
		//$output->js_files[] = base_url()."assets/grocery_crud/themes/flexigrid/js/flexigrid.js";



		//$output->css_files[] = base_url()."assets/grocery_crud/themes/flexigrid/css/flexigrid.css";
		$output->css_files[] = base_url()."assets/grocery_crud/themes/flexigrid/css/flexigrid_rtl.css";
		$output->css_files[] = base_url()."assets/grocery_crud/css/jquery_plugins/fancybox/jquery.fancybox.css";
		$output->css_files[] = base_url()."assets/grocery_crud/css/ui/simple/jquery-ui-1.10.1.custom.min.css";

		$data = array();
		$output->output = $this->load->view('home.php', $data, TRUE);
		$this->_template($output);
	}

	public function _template($output = null)
	{
		if($output == null)
			$output['name'] = $this->session->userdata('username');//$this->name;
		else
			$output->name = $this->session->userdata('username');//$this->name;
		if($output == null)
			$output['ci'] = &get_instance();
		else
			$output->ci = &get_instance();
		$this->load->view('template.php', $output);
	}

	/*public function index(){
		$this->projects_management();
		
	}*/
	public function check(){

		$this->load->helper('security');
		$password = do_hash($this->input->post('password'), 'md5');

		/*$this->load->library('encrypt');
		//$key = 'super-secret-key';
		$user_name = $this->input->post('username');
	    $password = $this->encrypt->encode($this->input->post('password'));*/
	    //echo $password;
		$user = Model\User::where(array('user_name' => $this->input->post('username'),
										'password'  => $password))->all();/**/

		//$user = Model\User::find_by_user_name($user_name);

		if($user)
			return TRUE;
		else
			return FALSE;

		//echo "Password: ".$password;
		//echo "<pre>";print_r($this->input->post());echo "</pre>";
		//echo "<pre>";print_r($user);echo "</pre>";exit;
		/*if($user)
			echo "TRUE";
		else
			echo "FALSE";
		exit;*/
	}

	public function login(){
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

	    if ($this->form_validation->run() == TRUE && $this->check())
	    {

			redirect(site_url('portal/projects_management'));
		}
		else
		{
			$this->load->view('login.php');
		}
		
		

		/*if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('login.php');
		}
		else
		{
			redirect(site_url('portal/projects_management'));
		}*/

	}

	function update_status_callback($post_array) { 
		//$post_array['created_at'] = date('Y-m-d h:i:s'); //2015-09-04 00:00:00
		$post_array['project_status_id'] = $post_array['project_status_id'] + 1;
		 
		return $post_array;
	}

	function insert_status_callback($post_array) { 
		//$post_array['created_at'] = date('Y-m-d h:i:s'); //2015-09-04 00:00:00
		$post_array['phase_id'] = 1;
		 
		return $post_array;
	}

	function after_insert_project_callback($post_array, $primary_key) { 
		//$post_array['created_at'] = date('Y-m-d h:i:s'); //2015-09-04 00:00:00
		//$post_array['project_status_id'] = 1;
		//$qry = 'INSERT INTO project_phase (start_date, project_status_id, project_id) values
		//		('.DATE_FORMAT($post_array['started_date'].',"%m-%d-%Y %T"),'. $post_array["project_status_id"].','.$primary_key.')';
		$str = str_replace('/', '-', $post_array['started_date']);
		$date = strtotime($str);
		$qry = 'INSERT INTO project_phase (start_date, phase_id, project_id) values("'.
				date("Y-m-d h:i:s", $date).'",'. $post_array["phase_id"].','.$primary_key.')';

		//log_message('info', $str);
		//log_message('info', $date);
		//log_message('info', $qry);
		
		$query = $this->db->query($qry);
		$project_phase_id = $this->db->insert_id();

		$path = $post_array["file"];
		$attachment_category_id = 1;
		$attachment_type_id = 1;
		


		$qry = 'INSERT INTO attachment_phase (path, attachment_type_id, attachment_category_id, project_phase_id) values("'.
				$path.'",'.$attachment_type_id.','. $attachment_category_id.', '.$project_phase_id.')';

		//log_message('info', $str);
		//log_message('info', $date);
		//log_message('info', $qry);
		
		$query = $this->db->query($qry);
		 
		return $post_array;
	}

	function after_update_project_callback($post_array, $primary_key) { 
		//$post_array['created_at'] = date('Y-m-d h:i:s'); //2015-09-04 00:00:00
		$post_array['project_status_id'] = 3;
		//$qry = 'INSERT INTO project_phase (start_date, project_status_id, project_id) values
		//		('.DATE_FORMAT($post_array['started_date'].',"%m-%d-%Y %T"),'. $post_array["project_status_id"].','.$primary_key.')';
		$str1 = str_replace('/', '-', $post_array['started_date']);
		$date1 = strtotime($str1);

		$str2 = str_replace('/', '-', $post_array['close_date']);
		$date2 = strtotime($str2);
		$qry = 'INSERT INTO project_phase (start_date, close_date, project_status_id, project_id) values("'.
				date("Y-m-d h:i:s", $date1).'",
			"'.date("Y-m-d h:i:s", $date2).'",'. $post_array["project_status_id"].','.$primary_key.')';

		//log_message('info', $str);
		//log_message('info', $date);
		//log_message('info', $qry);
		
		$query = $this->db->query($qry);
		$project_phase_id = $this->db->insert_id();

		$path = $post_array["file"];
		$attachment_category_id = 1;
		$attachment_type_id = 1;
		
		$qry = 'INSERT INTO attachment_phase (path, attachment_type_id, attachment_category_id, project_phase_id) values("'.
				$path.'",'.$attachment_type_id.','. $attachment_category_id.', '.$project_phase_id.')';		
		
		$query = $this->db->query($qry);
		 
		return $post_array;
	}

	

	function do_nothindg($post_array, $primary_key) { 
		 
		return $post_array;
	}

	

	public function projects_management()
	{
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();
		$param = $this->uri->segment(4);
		$extra = array();

		
		$query = $this->db->get('phase');
		$extra['phases'] = $query->result();

		$this->db->from('project')->where('id', $param);
		//$this->db->where('id', $param);
		$rs = $this->db->get();
		if($rs->num_rows() > 0)
			$crud->phase_id = $rs->row()->phase_id;
		else
			$crud->phase_id = 1;
		//$crud->set_theme('datatables');
		$crud->set_table('project');
		$crud->set_subject($this->lang->line('project'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		
		//$crud->callback_before_update(array($this,'update_status_callback'));
		if($crud->phase_id == 2){
			$this->db->from('project')->where('id', $param);
			//$this->db->where('id', $param);
			$rs = $this->db->get();
			$contract_model_id = 1;
			$contract_phase_id = 1;
			//echo "<pre>"; print_r( $rs->row() ); echo "</pre>"; exit;
			if($rs->num_rows() > 0){
				$contract_model_id = $rs->row()->contract_model_id;
				$contract_phase_id = $rs->row()->contract_phase_id;
			}else{
				$crud->contract_model_id = $contract_model_id;
				$crud->contract_phase_id = $contract_phase_id;
			}

			$this->db->from('contract_phase')->where('contract_model_id', 1);
			$query = $this->db->get();

			$extra['contracts'] = $query->result();
			$extra['contract_phase_id'] = $contract_phase_id;

			
				
		}else
		if($crud->phase_id == 1){
			$crud->callback_before_insert(array($this,'insert_status_callback'));
			$crud->callback_after_insert(array($this,'after_insert_project_callback'));
		}else
		if($crud->phase_id == 3){
			//$crud->callback_update(array($this,'do_nothindg'));
			$crud->callback_after_update(array($this,'after_update_project_callback'));
		}else
		if($crud->phase_id == 5){
			//$crud->callback_update(array($this,'do_nothindg'));
			$crud->callback_after_update(array($this,'after_update_project_callback'));
		}
		$crud->set_extra($extra);

		$data['crud'] = $crud;
		//fields to be displayed in view table
		$this->load->view("project/status_".$crud->phase_id, $data);
		
		if(! $this->has_privilege('read_project'))
			$crud->unset_read();
		if(! $this->has_privilege('create_project'))
			$crud->unset_add();
		if(! $this->has_privilege('update_project'))
			$crud->unset_edit();
		if(! $this->has_privilege('delete_project'))
			$crud->unset_delete();
		

		//echo "<pre>"; print_r( $rs->row()->project_status_id ); echo "</pre>"; exit;		
		//echo "Param: $param";
		//echo "<pre>"; print_r( $crud->grocery_CRUD_Model() ); echo "</pre>"; exit;
		//$crud->unset_texteditor('uses_permission');

		//$crud->set_subject('Employee');

		//$crud->required_fields('lastName');
		//$crud->unset_delete();
		//$crud->unset_columns('id');
		//$crud->set_field_upload('sketch','assets/uploads/sketchs');
				

		//For the images 
		//$crud->change_field_type('password', 'password');
 		//$crud->callback_before_insert(array($this,'screens_shoot_callback'));

		/*require_once FCPATH . "application/controllers/uploaders/artists_photo_uploader.php";

		//Set the multi uploader functionality
		$artistsPhotoUploader = new Artists_photo_uploader();
		$crud->callback_add_field('screen', array($artistsPhotoUploader, 'add_upload_fied'));
		$crud->callback_edit_field('screen', array($artistsPhotoUploader, 'edit_upload_fied'));
		$crud->callback_read_field('screen', array($artistsPhotoUploader, 'view_upload_fied'));
		$crud->callback_before_insert(array($this, '_set_files'));
		$crud->callback_after_insert(array($this, '_save_files_into_db'));
		$crud->callback_before_update(array($this, '_set_files'));
		$crud->callback_after_update(array($this, '_save_files_into_db'));

		$artistsPhotoUploader->set_js($crud);*/
			
		$output = $crud->render();

		//echo "<pre>"; print_r( $output ); echo "</pre>"; exit;


		//$output = (object) array_merge( (array)$output, $extra);
		//$output->extra = $extra;

		/*$this->load->model('grocery_CRUD_Model');
		$this->grocery_CRUD_Model->set_basic_table('project');
		$this->grocery_CRUD_Model->where('id', 2);
		$rs = $this->grocery_CRUD_Model->get_list();*/

		


		/*$js_files = $output->js_files;
		$css_files = $output->css_files;
		$output = "<h1>List 1</h1>".$output->output;

		$this->_template((object)array(
				'js_files' => $js_files,
				'css_files' => $css_files,
				'output'	=> $output
		));*/


		$this->_template($output);
	}



	public function project_status_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('project_status');
		$crud->set_subject($this->lang->line('status_name'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name');
		
		
		$crud->display_as('name', $this->lang->line('status_name'));
		$crud->display_as('id', $this->lang->line('id'));


		//fields will be displayed in add/edit form
		$crud->fields('name');


		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('icon','assets/uploads/files');

		if(! $this->has_privilege('read_project_status'))
			$crud->unset_read();
		if(! $this->has_privilege('create_project_status'))
			$crud->unset_add();
		if(! $this->has_privilege('update_project_status'))
			$crud->unset_edit();
		if(! $this->has_privilege('delete_project_status'))
			$crud->unset_delete();
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function deliverables_status_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('deliverable_status');
		$crud->set_subject($this->lang->line('status_name'));
		$crud->set_language("arabic"); 
		//fields to be displayed in view table
		$crud->columns('id', 'name');
		
		
		$crud->display_as('name', $this->lang->line('status_name'));
		$crud->display_as('id', $this->lang->line('id'));


		//fields will be displayed in add/edit form
		$crud->fields('name');
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function deliverables_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('project_subphase_deliverable');
		$crud->set_subject($this->lang->line('project_subphase_deliverable'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'inbox_date', 'outbox_date', 'inbox_no', 'outbox_no', 'revision_start_date', 
			'actual_revision_start_date', 'revision_finish_date', 'actual_revision_finish_date', 'close_date', 'actual_close_date', 'project_phase_id');
		
		$crud->set_relation('project_phase_id','project_phase','name');

		$crud->display_as('inbox_date', $this->lang->line('inbox_date'));
		$crud->display_as('outbox_date', $this->lang->line('outbox_date'));
		$crud->display_as('inbox_no', $this->lang->line('inbox_no'));
		$crud->display_as('outbox_no', $this->lang->line('outbox_no'));
		$crud->display_as('revision_start_date', $this->lang->line('revision_start_date'));
		$crud->display_as('actual_revision_start_date', $this->lang->line('actual_revision_start_date'));
		$crud->display_as('revision_finish_date', $this->lang->line('revision_finish_date'));
		$crud->display_as('actual_revision_finish_date', $this->lang->line('actual_revision_finish_date'));
		$crud->display_as('close_date', $this->lang->line('close_date'));		
		$crud->display_as('actual_close_date', $this->lang->line('actual_close_date'));
		$crud->display_as('project_phase_id', $this->lang->line('project_phase_name')."/".$this->lang->line('project_subphase_name'));


		//fields will be displayed in add/edit form
		$crud->fields('inbox_date', 'outbox_date', 'inbox_no', 'outbox_no', 'revision_start_date', 
			'actual_revision_start_date', 'revision_finish_date', 'actual_revision_finish_date', 'close_date', 'actual_close_date', 'project_phase_id');


		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('icon','assets/uploads/files');

		if(! $this->has_privilege('read_deliverable'))
			$crud->unset_read();
		if(! $this->has_privilege('create_deliverable'))
			$crud->unset_add();
		if(! $this->has_privilege('update_deliverable'))
			$crud->unset_edit();
		if(! $this->has_privilege('delete_deliverable'))
			$crud->unset_delete();
				
			
		$output = $crud->render();

		$this->_template($output);
	}


	public function phase_attachements_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('attachment_phase');
		$crud->set_subject($this->lang->line('attachment_phase'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'path', 'attachment_type_id', 'attachment_category_id', 'project_phase_id');
		
		$crud->set_relation('attachment_type_id','attachment_type','type');
		$crud->set_relation('attachment_category_id','attachment_category','category');
		$crud->set_relation('project_phase_id','project_phase','name');

		$crud->display_as('path', $this->lang->line('path'));
		$crud->display_as('attachment_type_id', $this->lang->line('attachment_type'));
		$crud->display_as('attachment_category_id', $this->lang->line('attachment_category'));
		$crud->display_as('project_phase_id', $this->lang->line('project_phase'));

		//fields will be displayed in add/edit form
		$crud->fields('path', 'attachment_type_id', 'attachment_category_id', 'project_phase_id');


		//$crud->set_subject('Employee');

		
		$crud->set_field_upload('path','assets/uploads/attachments');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	

	public function deliverable_attachements_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('attachment_deliverable');
		$crud->set_subject($this->lang->line('attachment_deliverable'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'path', 'attachment_type_id', 'attachment_category_id', 'project_subphase_deliverable_id');
		
		$crud->set_relation('attachment_type_id','attachment_type','type');
		$crud->set_relation('attachment_category_id','attachment_category','category');
		$crud->set_relation('project_subphase_deliverable_id','project_subphase_deliverable','id');

		$crud->display_as('path', $this->lang->line('path'));
		$crud->display_as('attachment_type_id', $this->lang->line('attachment_type'));
		$crud->display_as('attachment_category_id', $this->lang->line('attachment_category'));
		$crud->display_as('project_subphase_deliverable_id', $this->lang->line('project_subphase_deliverable'));

		//fields will be displayed in add/edit form
		$crud->fields('path', 'attachment_type_id', 'attachment_category_id', 'project_subphase_deliverable_id');


		//$crud->set_subject('Employee');

		
		$crud->set_field_upload('path','assets/uploads/attachments');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function attachement_categories_management()
	{
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('attachment_category');
		$crud->set_subject($this->lang->line('attachment_category'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'category', 'level');

		$crud->display_as('category', $this->lang->line('category'));
		$crud->display_as('level', $this->lang->line('level'));
		
		//fields will be displayed in add/edit form
		$crud->fields('category', 'level');
	
		$output = $crud->render();

		$this->_template($output);
	}

	public function attachement_types_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('attachment_type');
		$crud->set_subject($this->lang->line('attachment_type'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'type');
		
		$crud->display_as('type', $this->lang->line('type'));

		//fields will be displayed in add/edit form
		$crud->fields('type');				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function owners_management()
	{
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('owner');
		$crud->set_subject($this->lang->line('site_owner'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');

		$crud->set_relation('owner_type_id','owner_type','name');
		$crud->set_relation('site_id','site','name_ar');

		//fields to be displayed in view table
		$crud->columns('site_id', 'owner_type_id', 'ref_no', 'area', 'attachment', 'comment');
		
		$crud->display_as('owner_type_id', $this->lang->line('owner_type'));
		$crud->display_as('ref_no', $this->lang->line('ref_no'));
		$crud->display_as('area', $this->lang->line('area'));
		$crud->display_as('attachment', $this->lang->line('attachment'));
		$crud->display_as('comment', $this->lang->line('comment'));
		$crud->display_as('site_id', $this->lang->line('site_name'));

		//fields will be displayed in add/edit form
		$crud->fields('site_id', 'owner_type_id', 'ref_no', 'area', 'attachment', 'comment');

		//$crud->set_subject('Employee');

		
		$crud->set_field_upload('attachment','assets/uploads/attachments');
		
		//$crud->callback_after_insert(array($this, 'just_a_test'));	
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function owner_types_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('owner_type');
		$crud->set_subject($this->lang->line('owner_type'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name');
		
		
		$crud->display_as('name', $this->lang->line('owner_type'));
		$crud->display_as('id', $this->lang->line('id'));


		//fields will be displayed in add/edit form
		$crud->fields('name');


		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('icon','assets/uploads/files');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	function just_a_test($primary_key , $row)
	{
    	redirect(site_url('portal/sites_management'));
    	//return site_url('portal/owners_management/add').'?site_id='.$row->id;
	}

	function addresses_management()
	{
        $this->load->library('grocery_CRUD');
        $this->load->library('ajax_grocery_CRUD');

		//create ajax_grocery_CRUD instead of grocery_CRUD. This extends the functionality with the set_relation_dependency method keeping all original functionality as well
        $crud = new ajax_grocery_CRUD();

		//this is the default grocery CRUD model declaration
        $crud->set_table('state');
        $crud->set_relation('region_id','region','name');
        //$crud->set_relation('ad_state_id','state','s_name');

		//this is the specific line that specifies the relation.
		// 'ad_state_id' is the field (drop down) that depends on the field 'ad_country_id' (also drop down).
		// 's_country_id' is the foreign key field on the state table that specifies state's country
        $crud->set_relation_dependency('region_id');

        $output = $crud->render();
        $this->_template($output);
	}

	function add_management()
	{
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table('state');
		$crud->set_relation('region_id','region','name');
		$crud->set_relation('state_id','state','name');

		$this->load->library('gc_dependent_select');
		// settings

		$fields = array(

		// first field:
		'sector' => array( // first dropdown name
		'table_name' => 'sector', // table of country
		'title' => 'country_title', // country title
		'relate' => null // the first dropdown hasn't a relation
		),
		// second field
		'region' => array( // second dropdown name
		'table_name' => 'region', // table of state
		'title' => 'region_title', // state title
		'id_field' => 'id', // table of state: primary key
		'relate' => 'sector_id', // table of state:
		'data-placeholder' => 'select region' //dropdown's data-placeholder:

		),
		// third field. same settings
		'state' => array(
		'table_name' => 'state',
		//'where' =>"post_code>'167'",  // string. It's an optional parameter.
		//'order_by'=>"state_title DESC",  // string. It's an optional parameter.
		'title' => 'id: {id} / state : {name}',  // now you can use this format )))
		'id_field' => 'id',
		'relate' => 'region_id',
		'data-placeholder' => 'select state'
		)
		);

		$config = array(
		'main_table' => 'dd_goods',
		'main_table_primary' => 'goods_id',
		"url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/', //path to method
		'ajax_loader' => base_url() . 'ajax-loader.gif', // path to ajax-loader image. It's an optional parameter
		'segment_name' =>'Your_segment_name' // It's an optional parameter. by default "get_items"
		);
		$categories = new gc_dependent_select($crud, $fields, $config);

		// first method:
		//$output = $categories->render();

		// the second method:
		$js = $categories->get_js();
		$output = $crud->render();
		$output->output.= $js;
		$this->_template($output);
	}

	public function sites_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('site');
		$crud->set_subject($this->lang->line('site'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//$crud->add_action('', base_url().'assets/grocery_crud/themes/flexigrid/css/images/folder_closed.png', 'portal/owners_management/add','ui-icon-plus');
		//fields to be displayed in view table
		$crud->columns('code', 'name_ar', 'name_en', 'site_type_id',  'site_area', 'expected_unit_num', 'state_id', //'owner_id',
			'latitute', 'longitute'//, 'sketch', 'map_link'
			//'package_name','uses_permission', 'size','price','download_no','category_id','created','updated'
			//,'status'
			);

		//$crud->set_relation_n_n('owner', 'owner', 'owner_type', 'site_id', 'owner_type_id', 'name');

		$crud->set_relation('site_type_id','site_type','name');
		$crud->set_relation('state_id','state','name');
		//$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		//$crud->set_relation_n_n('site_owner', 'owner', 'owner_type', 'site_id', 'owner_type_id', 'owner_type.name','id');
		//$crud->set_relation('owner_id','owner','name');
		$crud->display_as('code', $this->lang->line('code'))
				->display_as('name_ar', $this->lang->line('name_ar'))
				->display_as('name_en', $this->lang->line('name_en'))
				->display_as('site_type_id', $this->lang->line('site_type_name'))
				->display_as('state_id', $this->lang->line('state_name'))
				->display_as('site_area', $this->lang->line('site_area'))
				->display_as('expected_unit_num', $this->lang->line('expected_unit_num'))
				->display_as('sketch', $this->lang->line('sketch'))
				->display_as('latitute', $this->lang->line('latitute'))
				->display_as('longitute', $this->lang->line('longitute'))				
				//->display_as('owner', $this->lang->line('site_owner'))
				->display_as('map_link', $this->lang->line('map_link'));

		//fields will be displayed in add/edit form
		$crud->fields('code', 'name_ar','name_en','site_type_id','sketch', 'site_area', 'expected_unit_num', 'state_id',//'owner_id',
			'latitute', 'longitute','map_link'
			//,'owner'
			//'package_name','uses_permission', 'size','price','download_no','category_id','created','updated'
			//,'status'
			);

		//$crud->unset_texteditor('uses_permission');

		//$crud->set_subject('Employee');

		//$crud->required_fields('lastName');
		//$crud->unset_delete();
		//$crud->unset_columns('id');
		

		$crud->set_field_upload('sketch','assets/uploads/sketchs');
		
		$crud->callback_after_insert(array($this, '_save_owner'));


		//For the images 
		//$crud->change_field_type('password', 'password');
 		//$crud->callback_before_insert(array($this,'screens_shoot_callback'));

		/*require_once FCPATH . "application/controllers/uploaders/artists_photo_uploader.php";

		//Set the multi uploader functionality
		$artistsPhotoUploader = new Artists_photo_uploader();
		$crud->callback_add_field('sketch', array($artistsPhotoUploader, 'add_upload_fied'));
		$crud->callback_edit_field('sketch', array($artistsPhotoUploader, 'edit_upload_fied'));
		$crud->callback_read_field('sketch', array($artistsPhotoUploader, 'view_upload_fied'));
		$crud->callback_before_insert(array($this, '_set_files'));
		$crud->callback_after_insert(array($this, '_save_files_into_db'));
		$crud->callback_before_update(array($this, '_set_files'));
		$crud->callback_after_update(array($this, '_save_files_into_db'));

		$artistsPhotoUploader->set_js($crud);*/
			
		$output = $crud->render();


		/*$js_files = $output->js_files;
		$css_files = $output->css_files;
		$output = "<h1>List 1</h1>".$output->output;

		$this->_template((object)array(
				'js_files' => $js_files,
				'css_files' => $css_files,
				'output'	=> $output
		));*/


		$this->_template($output);
	}

	

	function _save_owner($post_array, $primary_key) {
		//require_once FCPATH . "application/controllers/uploaders/artists_photo_uploader.php";
		//$photo_uploader = new Artists_photo_uploader();
		//$photo_uploader->_save_files_into_db($post_array, $primary_key);
		$site_id = $primary_key;

		$ref_no_1 = $this->input->post('ref_no-1');
		$date_1 = $this->input->post('date-1');
		$area_1 = $this->input->post('area-1');
		$attach_file_1 = $this->input->post('attach-file-1');
		$remarks_1 = $this->input->post('remarks-1');

		$data = array(
					'site_id' => $site_id,
					'owner_type_id' => 1,
					'ref_no' => $ref_no_1,
					'name' => $date_1,
					'area' => $area_1,
					'attachment' => $attach_file_1,
					'comment' => $remarks_1 
					);
		$this->db->insert('owner', $data); 

		$ref_no_2 = $this->input->post('ref_no-2');
		$date_2 = $this->input->post('date-2');
		$area_2 = $this->input->post('area-2');
		$attach_file_2 = $this->input->post('attach-file-2');
		$remarks_2 = $this->input->post('remarks-2');

		$data = array(
					'site_id' => $site_id,
					'owner_type_id' => 2,
					'ref_no' => $ref_no_2,
					'name' => $date_2,
					'area' => $area_2,
					'attachment' => $attach_file_2,
					'comment' => $remarks_2 
					);
		$this->db->insert('owner', $data); 

		$ref_no_3 = $this->input->post('ref_no-3');
		$date_3 = $this->input->post('date-3');
		$area_3 = $this->input->post('area-3');
		$attach_file_3 = $this->input->post('attach-file-3');
		$remarks_3 = $this->input->post('remarks-3');

		$data = array(
					'site_id' => $site_id,
					'owner_type_id' => 3,
					'ref_no' => $ref_no_3,
					'name' => $date_3,
					'area' => $area_3,
					'attachment' => $attach_file_3,
					'comment' => $remarks_3 
					);
		$this->db->insert('owner', $data); 
	}

	public function site_types_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('site_type');
		$crud->set_subject($this->lang->line('site_type'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name');
		
		
		$crud->display_as('name', $this->lang->line('site_type_name'));
		$crud->display_as('id', $this->lang->line('id'));

		//fields will be displayed in add/edit form
		$crud->fields('name');

		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('icon','assets/uploads/files');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function departments_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('department');
		$crud->set_subject($this->lang->line('department'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name');
		
		
		$crud->display_as('name', $this->lang->line('department_name'));
		$crud->display_as('id', $this->lang->line('id'));

		//fields will be displayed in add/edit form
		$crud->fields('name');

		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('icon','assets/uploads/files');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function sections_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('section');
		$crud->set_subject($this->lang->line('section'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name','department_id');
		$crud->set_relation('department_id','department','name');
		
		
		$crud->display_as('name', $this->lang->line('section_name'));
		$crud->display_as('department_id', $this->lang->line('department_name'));
		$crud->display_as('id', $this->lang->line('id'));

		//fields will be displayed in add/edit form
		$crud->fields('name', 'department_id');

		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('icon','assets/uploads/files');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function sectors_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('sector');
		$crud->set_subject($this->lang->line('sector'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name');
		
		
		$crud->display_as('name', $this->lang->line('sector_name'));
		$crud->display_as('id', $this->lang->line('id'));

		//fields will be displayed in add/edit form
		$crud->fields('name');

		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('icon','assets/uploads/files');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function regions_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('region');
		$crud->set_subject($this->lang->line('region'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name','sector_id');
		$crud->set_relation('sector_id','sector','name');
		
		
		$crud->display_as('name', $this->lang->line('region_name'));
		$crud->display_as('sector_id', $this->lang->line('sector_name'));
		$crud->display_as('id', $this->lang->line('id'));

		//fields will be displayed in add/edit form
		$crud->fields('name', 'sector_id');

		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('icon','assets/uploads/files');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function states_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('state');
		$crud->set_subject($this->lang->line('state'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name', 'region_id');
		$crud->set_relation('region_id','region','name');
		
		
		$crud->display_as('name', $this->lang->line('state_name'));
		$crud->display_as('id', $this->lang->line('id'));
		$crud->display_as('region_id', $this->lang->line('region_name'));

		//fields will be displayed in add/edit form
		$crud->fields('name', 'region_id');

		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('icon','assets/uploads/files');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function users_management()
	{
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('user');
		$crud->set_subject($this->lang->line('user'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name', 'user_name', 'email', 'role_id', 'section_id');

		
		
		$crud->set_relation('role_id','role','name');
		$crud->set_relation('section_id','section','name');
		
		
		$crud->display_as('name', $this->lang->line('name'));
		$crud->display_as('user_name', $this->lang->line('user_name'));
		$crud->display_as('password', $this->lang->line('password'));
		$crud->display_as('email', $this->lang->line('email'));
		$crud->display_as('role_id', $this->lang->line('role_name'));
		$crud->display_as('section_id', $this->lang->line('section_name'));
		

		//fields will be displayed in add/edit form
		$crud->fields('name', 'user_name', 'password', 'email', 'role_id', 'section_id');

		$crud->field_type('password', 'password');
		$crud->callback_before_insert(array($this,'encrypt_password_callback'));
    	$crud->callback_before_update(array($this,'encrypt_password_callback'));
    	$crud->callback_edit_field('password',array($this,'decrypt_password_callback'));

		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('attachment','assets/uploads/attachments');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	function encrypt_password_callback($post_array, $primary_key = null)
	{

		$this->load->helper('security');
		$post_array['password'] = do_hash($post_array['password'], 'md5');
		return $post_array;

	    /*$this->load->library('encrypt');
	 
	    //$key = 'super-secret-key';
	    //echo "password: ".$post_array['password'];exit;
	    //log_message('debug', "password: ".$post_array['password']);
	    $post_array['password'] = $this->encrypt->encode($post_array['password']);
	    return $post_array;*/
	}
	 
	function decrypt_password_callback($value)
	{
	    $this->load->library('encrypt');
	 
	    //$key = 'super-secret-key';
	    //echo $value;
	    $decrypted_password = $this->encrypt->decode($value);
	    //log_message('debug', "decrypted_password: ".$value);
	    //log_message('debug', "decrypted_password: ".$decrypted_password);
	    return "<input type='password' name='password' value='$decrypted_password' />";
	}

	public function consultants_management()
	{
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('consultant');
		$crud->set_subject($this->lang->line('consultant'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name');
		
		
		$crud->display_as('name', $this->lang->line('consultant_name'));

		//fields will be displayed in add/edit form
		$crud->fields('name');

		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('attachment','assets/uploads/attachments');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function contractors_management()
	{
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('contractor');
		$crud->set_subject($this->lang->line('contractor'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name');
		
		
		$crud->display_as('name', $this->lang->line('contractor_name'));

		//fields will be displayed in add/edit form
		$crud->fields('name');

		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('attachment','assets/uploads/attachments');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function privileges_management(){
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('privilege');
		$crud->set_subject($this->lang->line('privilege'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name', 'code');
		
		
		$crud->display_as('name', $this->lang->line('privilege_name'));
		$crud->display_as('code', $this->lang->line('privilege_code'));

		//fields will be displayed in add/edit form
		$crud->fields('name', 'code');

		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('attachment','assets/uploads/attachments');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function roles_management(){
		$crud = new grocery_CRUD();

		$crud->set_table('role');
		$crud->set_subject($this->lang->line('role'));
		$crud->set_language("arabic");
		$crud->order_by('id','desc');
		$crud->set_relation_n_n('privileges', 'role_privilege', 'privilege', 'role_id', 'privilege_id', 'name', 'priority');
		//$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		//$crud->unset_columns('special_features','description','actors');

		$crud->fields('name', 'privileges');
		$crud->display_as('name', $this->lang->line('role_name'));
		$crud->display_as('privileges', $this->lang->line('privileges'));

		$output = $crud->render();

		$this->_template($output);
	}

	/*
	public function contract_types_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('contract_type');
		$crud->set_subject($this->lang->line('contract_type'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'type');
		
		
		$crud->display_as('type', $this->lang->line('contract_type'));
		$crud->display_as('id', $this->lang->line('id'));


		//fields will be displayed in add/edit form
		$crud->fields('type');


		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('icon','assets/uploads/files');
				
			
		$output = $crud->render();

		$this->_template($output);
	}
	*/
	
	public function contract_categories_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();
		//$crud->set_model('contract_category_join');

		//$crud->set_theme('datatables');
		$crud->set_table('contract_category');
		$crud->set_subject($this->lang->line('contract_category'));
		$crud->set_language("arabic"); 
		$crud->order_by('contract_category.id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name', 'contract_phase_id');
		
		$crud->set_relation('contract_phase_id','contract_phase','name'); //{username} -
		//$crud->set_relation('contract_phase_id','contract_phase','name');
		//$crud->set_relation('contract_type_id','contract_type','type');

		$crud->display_as('name', $this->lang->line('contract_category'));
		$crud->display_as('contract_phase_id', $this->lang->line('contract_phase_name'));
		$crud->display_as('id', $this->lang->line('id'));


		//fields will be displayed in add/edit form
		$crud->fields('name', 'contract_phase_id');


		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('icon','assets/uploads/files');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function contract_categories_management2()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();
		

		//$crud->set_theme('datatables');
		$crud->set_table('contract_category');
		$crud->set_subject($this->lang->line('contract_category'));
		$crud->set_language("arabic"); 
		$crud->order_by('contract_category.id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name', 'contract_phase_id');
		
		$crud->set_relation('contract_phase_id','contract_phase','{contract_type_id} - {name}'); //{username} -
		//$crud->set_relation('contract_phase_id','contract_phase','name');
		//$crud->set_relation('contract_type_id','contract_type','type');

		$crud->display_as('name', $this->lang->line('contract_category'));
		$crud->display_as('contract_phase_id', $this->lang->line('contract_phase_name'));
		$crud->display_as('id', $this->lang->line('id'));


		//fields will be displayed in add/edit form
		$crud->fields('name', 'contract_phase_id');


		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('icon','assets/uploads/files');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function contract_phases_management()
	{
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('contract_phase');
		$crud->set_subject($this->lang->line('contract_phase'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id','name', 'description', 'phase_order', 'contract_model_id');
		$crud->set_relation('contract_model_id','contract_model','name');
		
		
		
		$crud->display_as('name', $this->lang->line('contract_phase_name'));
		$crud->display_as('description', $this->lang->line('contract_phase_description'));		
		$crud->display_as('phase_order', $this->lang->line('contract_phase_order'));
		$crud->display_as('contract_model_id', $this->lang->line('contract_model'));


		//fields will be displayed in add/edit form
		$crud->fields('name', 'description', 'phase_order', 'contract_model_id');

		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('attachment','assets/uploads/attachments');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function contract_phase_category_list_management()
	{
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('contract_phase_category_list');
		$crud->set_subject($this->lang->line('contract_phase_category_list'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id','name', 'description', 'percentage', 'page_no', 'done', 'contract_category_id');
		$crud->set_relation('contract_category_id','contract_category','name');
		
		
		
		$crud->display_as('name', $this->lang->line('contract_phase_name'));
		$crud->display_as('description', $this->lang->line('description'));		
		$crud->display_as('percentage', $this->lang->line('percentage'));
		$crud->display_as('page_no', $this->lang->line('page_no'));
		$crud->display_as('done', $this->lang->line('done'));
		$crud->display_as('contract_category_id', $this->lang->line('contract_category'));

		$crud->field_type('done','enum',array('Yes','No'));

		//fields will be displayed in add/edit form
		$crud->fields('name', 'description', 'percentage', 'page_no', 'done', 'contract_category_id');

		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('attachment','assets/uploads/attachments');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function contracts_management()
	{
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('contract_model');
		$crud->set_subject($this->lang->line('contract_model'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name', 'duration');
		//$crud->set_relation('contract_type_id','contract_type','type');
		
		
		$crud->display_as('name', $this->lang->line('contract_model_name'));
		$crud->display_as('duration', $this->lang->line('contract_duration'));
		//$crud->display_as('contract_type_id', $this->lang->line('type'));

		//fields will be displayed in add/edit form
		$crud->fields('name', 'duration');

		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('attachment','assets/uploads/attachments');
				
			
		$output = $crud->render();

		$this->_template($output);
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

	public function phase_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('phase');
		$crud->set_subject($this->lang->line('project_phase'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name');
		
		$crud->display_as('name', $this->lang->line('project_phase_name'));
		$crud->display_as('id', $this->lang->line('id'));
		
		//fields will be displayed in add/edit form
		$crud->fields('name');

		//$crud->set_subject('Employee');
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function project_phase_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('project_phase');
		$crud->set_subject($this->lang->line('project_phase'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name', 'description', 'start_date', 'close_date', 'actual_start_date', 'actual_close_date');
		
		
		$crud->display_as('name', $this->lang->line('project_phase_name'));
		$crud->display_as('id', $this->lang->line('id'));
		$crud->display_as('description', $this->lang->line('description'));
		$crud->display_as('start_date', $this->lang->line('start_date'));
		$crud->display_as('close_date', $this->lang->line('close_date'));
		$crud->display_as('actual_start_date', $this->lang->line('actual_start_date'));
		$crud->display_as('actual_close_date', $this->lang->line('actual_close_date'));


		//fields will be displayed in add/edit form
		$crud->fields('name', 'description', 'start_date', 'close_date', 'actual_start_date', 'actual_close_date');


		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('icon','assets/uploads/files');
		if(! $this->has_privilege('read_project_phase'))
			$crud->unset_read();
		if(! $this->has_privilege('create_project_phase'))
			$crud->unset_add();
		if(! $this->has_privilege('update_project_phase'))
			$crud->unset_edit();
		if(! $this->has_privilege('delete_project_phase'))
			$crud->unset_delete();
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	/*

	public function subphase_attachements_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('attachment_subphase');
		$crud->set_subject($this->lang->line('attachment_subphase'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'path', 'attachment_type_id', 'attachment_category_id', 'project_subphase_id');
		
		$crud->set_relation('attachment_type_id','attachment_type','type');
		$crud->set_relation('attachment_category_id','attachment_category','category');
		$crud->set_relation('project_subphase_id','project_subphase','name');

		$crud->display_as('path', $this->lang->line('path'));
		$crud->display_as('attachment_type_id', $this->lang->line('attachment_type'));
		$crud->display_as('attachment_category_id', $this->lang->line('attachment_category'));
		$crud->display_as('project_subphase_id', $this->lang->line('project_subphase'));

		//fields will be displayed in add/edit form
		$crud->fields('path', 'attachment_type_id', 'attachment_category_id', 'project_subphase_id');


		//$crud->set_subject('Employee');

		
		$crud->set_field_upload('path','assets/uploads/attachments');
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function project_phase_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('project_phase');
		$crud->set_subject($this->lang->line('project_phase'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name', 'description', 'start_date', 'close_date', 'actual_start_date', 'actual_close_date');
		
		
		$crud->display_as('name', $this->lang->line('project_phase_name'));
		$crud->display_as('id', $this->lang->line('id'));
		$crud->display_as('description', $this->lang->line('description'));
		$crud->display_as('start_date', $this->lang->line('start_date'));
		$crud->display_as('close_date', $this->lang->line('close_date'));
		$crud->display_as('actual_start_date', $this->lang->line('actual_start_date'));
		$crud->display_as('actual_close_date', $this->lang->line('actual_close_date'));


		//fields will be displayed in add/edit form
		$crud->fields('name', 'description', 'start_date', 'close_date', 'actual_start_date', 'actual_close_date');


		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('icon','assets/uploads/files');
		if(! $this->has_privilege('read_project_phase'))
			$crud->unset_read();
		if(! $this->has_privilege('create_project_phase'))
			$crud->unset_add();
		if(! $this->has_privilege('update_project_phase'))
			$crud->unset_edit();
		if(! $this->has_privilege('delete_project_phase'))
			$crud->unset_delete();
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	public function project_subphase_management()
	{
		
		
		//$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('project_subphase');
		$crud->set_subject($this->lang->line('project_subphase'));
		$crud->set_language("arabic"); 
		$crud->order_by('id','desc');
		//fields to be displayed in view table
		$crud->columns('id', 'name', 'description', 'start_date', 'close_date', 'actual_start_date', 'actual_close_date', 'project_phase_id');
		
		$crud->set_relation('project_phase_id','project_phase','name');

		$crud->display_as('name', $this->lang->line('project_subphase_name'));
		$crud->display_as('id', $this->lang->line('id'));
		$crud->display_as('description', $this->lang->line('description'));
		$crud->display_as('start_date', $this->lang->line('start_date'));
		$crud->display_as('close_date', $this->lang->line('close_date'));
		$crud->display_as('actual_start_date', $this->lang->line('actual_start_date'));
		$crud->display_as('actual_close_date', $this->lang->line('actual_close_date'));
		$crud->display_as('project_phase_id', $this->lang->line('project_phase_name'));


		//fields will be displayed in add/edit form
		$crud->fields('name', 'description', 'start_date', 'close_date', 'actual_start_date', 'actual_close_date', 'project_phase_id');


		//$crud->set_subject('Employee');

		
		//$crud->set_field_upload('icon','assets/uploads/files');

		if(! $this->has_privilege('read_project_subphase'))
			$crud->unset_read();
		if(! $this->has_privilege('create_project_subphase'))
			$crud->unset_add();
		if(! $this->has_privilege('update_project_subphase'))
			$crud->unset_edit();
		if(! $this->has_privilege('delete_project_subphase'))
			$crud->unset_delete();
				
			
		$output = $crud->render();

		$this->_template($output);
	}

	/**/

}