<?php 
$crud->columns('name', 'site_id', 'consultant_id', 'contractor_id', 'project_status_id');
		$crud->set_relation('site_id','site','name_ar');
		$crud->set_relation('consultant_id','consultant','name');
		$crud->set_relation('contractor_id','contractor','name');
		$crud->set_relation('project_status_id','project_status','name');
		$crud->display_as('name', $this->lang->line('name'))
				->display_as('site_id', $this->lang->line('site_name'))
				->display_as('consultant_id', $this->lang->line('consultant_name'))
				->display_as('contractor_id', $this->lang->line('contractor_name'))
				->display_as('project_status_id', $this->lang->line('project_status_name'));
		//fields will be displayed in add/edit form
		$crud->fields('name', 'site_id', 'consultant_id', 'contractor_id', 'project_status_id');
		$crud->change_field_type('project_status_id','invisible');