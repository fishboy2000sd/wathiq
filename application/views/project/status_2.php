<?php 
	$crud->columns('name', 'started_date', 'close_date', 'contract_model_id','phase_id', 'file');
	$crud->set_relation('site_id','site','name_ar');
	$crud->set_relation('consultant_id','consultant','name');
		
	$crud->set_relation('phase_id','project_status','name');
	$crud->set_relation('contract_model_id','contract_model','name');
	//$crud->where('project_status_id', 1);

	$crud->set_field_upload('file','assets/uploads/sketchs');


	$crud->display_as('name', $this->lang->line('project_name'))
			->display_as('site_id', $this->lang->line('site_name'))
			->display_as('consultant_id', $this->lang->line('consultant_name'))
			->display_as('started_date', $this->lang->line('start_date'))
			->display_as('close_date', $this->lang->line('close_date'))
			->display_as('contract_model_id', $this->lang->line('contract_model'))
			->display_as('project_status_id', $this->lang->line('project_status'))
			->display_as('file', $this->lang->line('file'));
	//fields will be displayed in add/edit form
	$crud->fields('name', 'started_date', 'close_date','contract_model_id', 'file');
	$crud->field_type('name', 'readonly');
	//$crud->unset_add_fields('project_status_id');
	//$crud->unset_columns('project_status_id');
	//$crud->change_field_type('project_status.name','invisible');
	//$crud->change_field_type('project_status_id','invisible');
