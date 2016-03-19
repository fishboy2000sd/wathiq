<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		//$this->load->database();
		//$this->load->helper('url');
		$this->load->model('Reports_model');

		//$this->load->library('grocery_CRUD');
		//$this->lang->load('labels', 'arabic');
	}

	

	public function index()
	{		
		redirect(site_url('reports/showReports'));
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

		$output['js_files'][] = base_url()."assets/grocery_crud/js/jquery-1.11.1.min.js";		
		$output['css_files'][] = base_url()."assets/grocery_crud/css/ui/simple/jquery-ui-1.10.1.custom.min.css";
		$this->load->view('template.php',$output);
	}
	
	
	

	public function showReports()
	{
					
		$data = $this->getAll('sector');
		$data+= $this->getAll('site_type');
		$data+= $this->getAll('owner_type');
				
		$data['output'] = $this->load->view('reports/show_reports_stat', $data, TRUE);		
		$this->_template($data);
		
	}
	
	

	public function ListSites()
	{
					
		$data = $this->getAll('sector');
		$data+= $this->getAll('site_type');
		$data+= $this->getAll('owner_type');
		$data+= $this->getAll('consultant');
		
		$data['show_reports'] = $this->load->view('reports/list_sites', $data, TRUE);
		$data['output'] = $this->load->view('reports/show_reports', $data, TRUE);		
		$this->_template($data);
		
	}
	

	public function CardSites()
	{
					
		$data = $this->getAll('sector');
		$data+= $this->getAll('site_type');
		$data+= $this->getAll('owner_type');
		$data+= $this->getAll('consultant');
		
		$data['show_reports'] = $this->load->view('reports/card_sites', $data, TRUE);	
		$data['output'] = $this->load->view('reports/show_reports', $data, TRUE);			
		$this->_template($data);
		
	}
	

	public function OwnerStatus()
	{
					
		$data = $this->getAll('sector');
		$data+= $this->getAll('site_type');
		$data+= $this->getAll('owner_type');
		$data+= $this->getAll('consultant');
		$data+= $this->getAll('project_status');
		
		$data['show_reports'] = $this->load->view('reports/owner_status', $data, TRUE);
		$data['output'] = $this->load->view('reports/show_reports', $data, TRUE);			
		$this->_template($data);
		
	}
	
	

	public function Consultants()
	{
					
		$data = $this->getAll('sector');			
		$data+= $this->getAll('consultant');
		
		$data['show_reports'] = $this->load->view('reports/consultants', $data, TRUE);	
		$data['output'] = $this->load->view('reports/show_reports', $data, TRUE);			
		$this->_template($data);
		
	}
	
	public function ProjectPhases()
	{
					
		$data = $this->getAll('sector');
		$data+= $this->getAll('site_type');			
		$data+= $this->getAll('consultant');		
		$data+= $this->getAll('project_status');
		
		$data['show_reports'] = $this->load->view('reports/project_phases', $data, TRUE);	
		$data['output'] = $this->load->view('reports/show_reports', $data, TRUE);		
		$this->_template($data);
		
	}	  
    
    

    public function getRegions() {
        $status = "";
        $msg = "";

        $sector_id = $_POST['sectors'];
        $regions_list = array();
        $i=0;
        if ($status != "error") {
            $result = $this->Reports_model->getRegion($sector_id);
            if($result) {
                foreach ($result as $row) {
                    $region_id[$i] = $row['id'];
                    $region_name[$i] = $row['name'];
                    $i++;
                }
                $status = "success";
                $msg = "OK";
            }
            else {
                $status = "error";
                $msg = "لاتوجد منطقة في هذه القطاع";
            }
            $regions_list = $i--;

            $out_put="<option value='all'>الكل</option>";
            for($i=0;$i<$regions_list;$i++) {
                $out_put.="<option value=".$region_id[$i].">".$region_name[$i]."</option>";
            }

        }
        echo json_encode(array('status' => $status, 'msg' => $msg, 'output' => $out_put));

    }
    
    

    public function getStates() {

        $status = "";
        $msg = "";
        $region_id = $_POST['regions'];
        $states_list = array();
        $i=0;
        if ($status != "error") {
            $result = $this->Reports_model->getState($region_id);
            if($result) {
                foreach ($result as $row) {
                    $state_id[$i] = $row['id'];
                    $state_name[$i] = $row['name'];
                    $i++;
                }
                $status = "success";
                $msg = "OK";
            }
            else {
                $status = "error";
                $msg = "لا توجد محافظات في هذا هذه المنطقة ";
            }
            $states_list = $i--;
            $out_put="<option value='all'>الكل</option>";
            for($i=0;$i<$states_list;$i++) {
                $out_put.="<option value=".$state_id[$i].">".$state_name[$i]."</option>";
            }

        }
        echo json_encode(array('status' => $status, 'msg' => $msg, 'output' => $out_put));

    }
	
            
    
    public function getAll($table=null, $Id=null, $name=null) {

        $data = array();
        $i=0;
        if(isset ($name)) {
            $result = $this->Reports_model->get($table, $Id, $name);
            if($result) {
                foreach ($result as $row) {
                    $_name = $row['name'];
                }
                return $_name;
            }
        } else if(isset ($Id)) {
            $result = $this->Reports_model->get($table, $Id);
            if($result) {
                foreach ($result as $row) {
                    $data[$table.'_ID'][$i] = $row['id'];
                    $data[$table.'_Name'][$i] = $row['name'];
                    $i++;
                }
            } else {
                $data['data_'.$table] = FALSE;
            }
            $data['data_'.$table] = $i--;
            return $data;
        }
        else {
            $result = $this->Reports_model->get($table);
            if($result) {
                foreach ($result as $row) {
                   $data[$table.'_ID'][$i] = $row['id'];
                    $data[$table.'_Name'][$i] = $row['name'];
                    $i++;
                }
            } else {
                $data['data_'.$table] = FALSE;
            }
            $data['data_'.$table] = $i--;
            return $data;
        }

    }                   
	
   
	public function getAllState($where=null){
		$data_res = array();
		$result = $this->Reports_model->getAllStates($where);
			 foreach ($result as $row) {
			 	array_push($data_res, $row['id']);
			 }     
			//$data_res = implode(",", $data_res);
			
			return $data_res;
	}
	
	
	

	public function getRegionByState($state_id=null){
		$where = array('state.id' => $state_id);
		$result = $this->Reports_model->getAllStates($where);
			 foreach ($result as $row) {
			 	$region_id = $row['region_id'];
			 }     
						
			return $region_id;
	}
	
	
	
    
	public function showDataReports()
	{
	  if(isset ($_POST)){	
										
		$where = array();
		$_where = array();
		$where_in = array();				
		$owner = NULL;
		$i=0;
		
		if(isset($_POST['sectors']) && $_POST['sectors'] == "all"){										
			$where = null;	
			$where_in= null;
		}
		else{			
			$_where['region.sector_id'] = $_POST['sectors']; 			
			$where_in = $this->getAllState($_where);  					  		    //
		}		
        if(isset($_POST['regions']) && $_POST['regions'] != 'all'){
        	$_where['region.id'] = $_POST['regions']; 			
			$where_in = $this->getAllState($_where);		    
		}		
        if(isset($_POST['states']) && $_POST['states'] != 'all'){
		    $where['site.state_id'] = $_POST['states'];		
		}		
		if(isset($_POST['site_types']) && $_POST['site_types'] != 'all'){
		    $where['site_type_id'] = $_POST['site_types'];		
		}           	  
		if(isset($_POST['owner_types']) && $_POST['owner_types'] != 'all'){
		    $where['owner.owner_type_id'] = $_POST['owner_types'];
		    $owner = $_POST['owner_types'];		
		}					 
		if(isset($_POST['consultant']) && $_POST['consultant'] != 'all'){
		    $where['project.consultant_id'] = $_POST['consultant'];
		    //$owner = $owner_types;		
		}	  
		if(isset($_POST['owner_status']) && $_POST['owner_status'] != 'all'){
		    $where['project.project_status_id'] = $_POST['owner_status'];		   	
		}		
				
		
		
		/*------------------------------------report_type list_sites & card_sites -------------------------------------*/
		
		if($_POST['report_type'] == "list_sites" || $_POST['report_type'] == "card_sites"){
			$total_site = 0;
			$total_init_area = 0;
			$total_actual_area = 0;
			$total_exp_unit = 0;
			$total_actual_unit = 0;
			$res = $this->Reports_model->list_report($where, $where_in);
			if($res) {					                           
				foreach ($res as $rows) {                            	
					//$data['id'][$i] = $rows['id'];
					$data['code'][$i] = $rows['code'];                          	
					$data['regionName'][$i] = $this->getAll('region', $this->getRegionByState($rows['state_id']), 1);                          	
					$data['stateName'][$i] = $this->getAll('state', $rows['state_id'], 1);                                                   	
					$data['site_name'][$i] = $rows['name_ar'];                          	
					$data['site_type'][$i] = $this->getAll('site_type', $rows['site_type_id'], 1);                          	
					$data['site_area'][$i] = $rows['site_area'];                          
					$data['consultunt_area'][$i] = $rows['consultant_area'];                          		                          	
					$data['start_date'][$i] = $rows['started_date'];                          	
					$data['expected_unit'][$i] = $rows['expected_unit_num'];                          	
					$data['actual_unit'][$i] = $rows['actual_unit_num'];                          	
					$data['consultant'][$i] = $this->getAll('consultant', $rows['consultant_id'], 1);                          	
					$data['contractor'][$i] = $this->getAll('contractor', $rows['contractor_id'], 1);
					$data['contract_model'][$i] = $this->getAll('contract_model', $rows['contract_model_id'], 1);
					$data['project_phase'][$i] = $this->getAll('project_phase', $rows['project_phase_id'], 1);
					$data['status'][$i] = $this->getAll('project_status', $rows['project_status_id'], 1);                          	
					$total_init_area+= $data['site_area'][$i];                         	
					$total_actual_area+= $data['consultunt_area'][$i];                         	
					$total_exp_unit+= $data['actual_unit'][$i];                          	
					$total_actual_unit+= $data['expected_unit'][$i];                          	
					$i++;                          	
					$total_site++;                          
				}            
                          
				$data['show_data'] = $i--;					    
			}	
		
			$data['total_site'] = $total_site;		
			$data['total_init_area'] = $total_init_area;							    
			$data['total_actual_area'] = $total_actual_area;		
			$data['total_exp_unit'] = $total_exp_unit;							    
			$data['total_actual_unit'] = $total_actual_unit;		
								
			

			/*------------------------------------report_type consultants -------------------------------------*/
			
			
		} elseif ($_POST['report_type'] == "consultants"){
			$siteCount=0;
			$unitCount=0;
			$areaCount=0;
			$result = $this->Reports_model->getReportsAllConsultants($where, $where_in);				
					if($result) {					  
                          foreach ($result as $rows) {                            
							$data['consultant_name'][$i] = $rows['name'];
							$data['site_no'][$i] = $rows['NumberDuplicates'];
							if(isset($rows['unit'])){							
								$data['actual_unit'][$i] = $rows['unit'];
							} else
							{
								$data['actual_unit'][$i] = 0;
							}
							if(isset($rows['area'])){							
								$data['site_area'][$i] = $rows['area'];
							} else
							{
								$data['site_area'][$i] = 0;
							} 												
							$data['CNT'][$i] = $rows['CNT'];			
							$siteCount+=$data['site_no'][$i];	
							$unitCount+=$data['actual_unit'][$i];
							$areaCount+=$data['site_area'][$i];																					
							$i++;
                          }            

                          $data['show_data'] = $i--;
					    }
				$data['siteCount'] = $siteCount;					
				$data['unitCount']= $unitCount;
				$data['areaCount']= $areaCount;	

				
				/*------------------------------------report_type project_phases -------------------------------------*/
				
		} elseif ($_POST['report_type'] == "project_phases"){
			$siteCount=0;
			$unitCount=0;
			$areaCount=0;
			$result = $this->Reports_model->getReportsProjectPhase($where, $where_in);									
			if($result) {					                            
				foreach ($result as $rows) {                            							
					$data['region_name'][$i] = $rows['name'];							
					$data['site_no'][$i] = $rows['NumberDuplicates'];							
					if(isset($rows['actual_unit_num'])){															
						$data['actual_unit'][$i] = $rows['actual_unit_num'];							
					} else							
					{								
						$data['actual_unit'][$i] = 0;							
					}							
					if(isset($rows['site_area'])){															
						$data['site_area'][$i] = $rows['site_area'];							
					} else							
					{								
						$data['site_area'][$i] = 0;							
					} 																			
					$data['CNT'][$i] = $rows['CNT'];										
					$siteCount+=$data['site_no'][$i];								
					$unitCount+=$data['actual_unit'][$i];							
					$areaCount+=$data['site_area'][$i];										
					//$RecordAdd+=$data['CNT'][$i];																				
					$i++;                          
				}                                      
				$data['show_data'] = $i--;
			}				
			$data['siteCount'] = $siteCount;									
			$data['unitCount']= $unitCount;				
			$data['areaCount']= $areaCount;	
			
			
			/*------------------------------------report_type owner_status -------------------------------------*/
			
		}elseif ($_POST['report_type'] == "owner_status"){			
			$total_site=0;
			$total_ownertype=0;
			$result = $this->Reports_model->getReportsOwnerStatus($where, $where_in);									
			if($result) {					                            
				foreach ($result as $rows) {                            							
					$data['code'][$i] = $rows['code'];                          	
					$data['regionName'][$i] = $this->getAll('region', $this->getRegionByState($rows['state_id']), 1);                          	
					$data['stateName'][$i] = $this->getAll('state', $rows['state_id'], 1);                                                   	
					$data['site_name'][$i] = $rows['name_ar'];                          	
					$data['site_type'][$i] = $this->getAll('site_type', $rows['site_type_id'], 1);                          	
					$data['site_area'][$i] = $rows['site_area'];                          
					$data['consultant'][$i] = $this->getAll('consultant', $rows['consultant_id'], 1);                          	
					$data['status'][$i] = $this->getAll('project_status', $rows['project_status_id'], 1);
					$data['num_sites'][$i] =  $rows['num_sites'];					
					$data['owner_type'][$i] = $this->getAll('owner', $rows['id'], 1);
					
					$total_site+= $data['num_sites'][$i];                         																								
					$i++;                          
				}                                      
				$data['show_data'] = $i--;
			}				
			$data['total_site'] = $total_site;

			
		}
				
		$data['report_type'] = $_POST['report_type'];		
		$this->load->view('reports/report_list', $data);		   
	  }	

	  
	}
	
	
	
	
	public function LiveServerData(){	  

		// Set the JSON header
		// The x value is the current JavaScript time, which is the Unix time multiplied by 1000.
		$x = time() * 1000;
		// The y value is a random number
		$y = rand(0, 100);

		// Create a PHP array and echo it as JSON
		$ret = array($x, $y);
		echo json_encode($ret);
	}
	
	public function showReportStat(){		

		$where = array();		
		$RecordCount=0;
		$RecordAdd=0;
		$owner = NULL;
		$i=0;
			if(isset($_POST['sectors']) && $_POST['sectors'] == "all"){
			
				$select = array("sector.name");								
				$group_by = array('sector.name');
				
				$result = $this->Reports_model->getReports($select, $where, $join="sector", $group_by, $owner);				
					if($result) {					  
                          foreach ($result as $rows) {                            
							$data['sector_name'][$i] = $rows['name'];
							$data['total'][$i] = $rows['NumberDuplicates'];
							$RecordCount+=$data['total'][$i];							
							$data['CNT'][$i] = $rows['CNT'];						
							$RecordAdd+=$data['CNT'][$i];														
							$i++;
                          }            

                          $data['show_data'] = $i--;
					    }					    
			}
			else{
			
				if(isset($_POST['regions']) && $_POST['regions'] == "all"){	
				
					$data = array("region.name");								
					$group_by = array('region.name');
				
				
					if(isset($_POST['states']) && $_POST['states'] == "all"){									
						$result = $this->Reports_model->getReports($data, $where, $join="region", $group_by, $owner);				
						if($result) {					                           						
							foreach ($result as $rows) {                            							
								$data['region_name'][$i] = $rows['name'];							
								$data['total'][$i] = $rows['NumberDuplicates'];							
								$RecordCount =$data['total'][$i];														
								$data['CNT'][$i] = $rows['CNT'];														
								$RecordAdd=$data['CNT'][$i];																						
								$i++;                          
							}                                      
							$data['show_data'] = $i--;
					    }								                     			
			}
			else{		
				
				$result = $this->Reports_model->getReports($data, $where, $join="region", $group_by, $owner);				
					    if($result) {					                            
					    	foreach ($result as $rows) {                            							
					    		$data['region_name'][$i] = $rows['name'];							
					    		$data['total'][$i] = $rows['NumberDuplicates'];							
					    		$RecordCount+=$data['total'][$i];														
					    		$data['CNT'][$i] = $rows['CNT'];														
					    		$RecordAdd+=$data['CNT'][$i];															
					    		$i++;                          
					    	}                          					                           
					    	$data['show_data'] = $i--;					   
					    }
			}							                     			
			}
			else{		
				$data = array('state.name');				
				$group_by = array('state.name');					
				$result = $this->Reports_model->getReports($data, $where, $join="state", $group_by);				
					    if($result) {								    			                           
					    	foreach ($result as $rows) {                            							
					    		$data['state_name'][$i] = $rows['name'];							
					    		$data['total'][$i] = $rows['NumberDuplicates'];																				
					    		$RecordCount+=$data['total'][$i];														
					    		$data['CNT'][$i] = $rows['CNT'];														
					    		$RecordAdd+=$data['CNT'][$i];																				
					    		$i++;                          
					    	}                                                                        
					    	$data['show_data'] = $i--;					    
					    }
			}			   
			}						
		
			$data['RecordCount'] = $RecordCount;		
			$data['RecordAdd']= $RecordAdd;
		
	}
	
	

	/* Reports Management */
	

}