<?php 
$crud->columns('name', 'started_date', 'close_date',  'contractor_id', 'additional_time', 'progress', 'project_status_id');
		$crud->set_relation('site_id','site','name_ar');
		$crud->set_relation('project_status_id','project_status','name');
		$crud->set_relation('contractor_id','contractor','name');
		$crud->set_relation('project_status_id','project_status','name');
		$crud->display_as('name', $this->lang->line('project_name'))
				->display_as('project_status_id', $this->lang->line('project_status_name'))
				->display_as('contractor_id', $this->lang->line('contractor_name'))
				->display_as('started_date', $this->lang->line('start_date'))
				->display_as('close_date', $this->lang->line('close_date'))
				->display_as('additional_time', $this->lang->line('additional_time'))
				->display_as('progress', $this->lang->line('progress'));
		//fields will be displayed in add/edit form
		$crud->fields('name', 'started_date', 'close_date', 'contractor_id', 'additional_time', 'progress', 'project_status_id');
		//$crud->change_field_type('project_status_id','invisible');
		$crud->field_type('name', 'readonly');