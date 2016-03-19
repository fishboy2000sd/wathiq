<?php
class Reports_model extends CI_Model {

    function _construct() {
        // Call the Model constructor
        parent::_construct();
    }



    public function get($table=null, $id=null, $name=null) {
       
    	$this->db->select("id,name");    	
    			if(isset ($name)) {                			       			
    				$this->db->from($table);                			
    				$this->db->where('id', $id);            		
    			} else if(isset ($id)) {                		               			
    				$this->db->from($table);                			
    				$this->db->where('id!=', $id);            		
    			} else {                			              			
    				$this->db->from($table);            		
    			}         		 	    	
    		    	
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $result= $query->result_array();
            return $result;
        }
        else {
            return null;

        }
    }
	  
    

    public function getRegion($sector_id) {

        $this->db->select("id,name");
        $this->db->from('region');
        if(isset ($sector_id)) {
            $this->db->where('sector_id', $sector_id);
        }
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $result= $query->result_array();
            return $result;
        }
        else {
            return null;

        }
    }




    public function getState($region_id) {

        $this->db->select("id,name");
        $this->db->from('state');
        if(isset ($region_id)) {
            $this->db->where('region_id', $region_id);
        }
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $result= $query->result_array();
            return $result;
        }
        else {
            return null;

        }
    }
    

    
    /*public function getSite($where=null) {
       
    	$this->db->select("*");
        $this->db->from('site');        
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $result= $query->result_array();
            return $result;
        }
        else {
            return null;

        }
    }
    */
    
    public function getOwnerTypes() {
       
    	$this->db->select("id,name");
        $this->db->from('owner_type');        
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $result= $query->result_array();
            return $result;
        }
        else {
            return null;

        }
    }         
         
    
    
	
    public function list_report($where=null, $where_in=null) {

        $this->db->select("project.*, site.*");
        $this->db->from('site');        
        if(isset($where_in)){        	
        	$this->db->where_in('state_id', $where_in);
        } 
        $this->db->join('project', 'site.id = project.site_id', 'left outer');
        if(isset ($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows()>0) {
            $result= $query->result_array();
            return $result;
        }
        else {
            return null;

        }
    }
	 
	 
    function getReports($data=null, $where=null, $join=null, $group_by=null, $owner=null) {
       
 		if(isset($data)){    	
 			$this->db->select($data);
 			$this->db->select('COUNT(site.id) as NumberDuplicates, COUNT(code) as CNT');
 		}
  	    $this->db->from('site');
    
  	    if(isset($owner)){  	    	  	      	      	    
  	   		$this->db->join('owner', 'owner.site_id = site.id', 'right outer');
  	   	}
  	    if(isset($join)){
  	    	if($join == "sector"){  	      	      	    	
  	    		$this->db->join('sector', 'sector.id = site.sector_id', 'right outer');
  	    	}
  	    	elseif ($join == "region"){
  	    		$this->db->join('region', 'region.id = site.region_id', 'right outer'); 
  	    	}
  	    	else {
  	    		$this->db->join('state', 'state.id = site.state_id', 'right outer'); 
  	    	}
  	    } 
  	    if(isset($where)){  	    
  	    	$this->db->where($where);
  	    }    
  	    if(isset($group_by)){  	    
  	    	$this->db->group_by($group_by);
  	    }  	     
  	    $this->db->order_by('NumberDuplicates', 'desc');  		 	         
  	    $query = $this->db->get();
  	    //echo $this->db->last_query();  	
  	    if ($query->num_rows()>0) {  		
  	    	$result= $query->result_array();  		
  	    	return $result;          	
  	    }  	
  	    else {  		
  	    	return null;  		          	
  	    }    
    }
  
	 
	 function getReportsAllConsultants($where=null, $where_in=null) {
       
 		$this->db->select("consultant.name, SUM(site.actual_unit_num) AS unit, SUM(site.site_area) AS area, COUNT(project.id) as NumberDuplicates, COUNT(site_id) as CNT");
  	    $this->db->from('project');  	    
  	    $this->db->join('consultant', 'consultant.id = project.consultant_id', 'right outer'); 
  	    $this->db->join('site', 'site.id = project.site_id', 'left outer');
  	    if(isset($where)){  	    
  	    	$this->db->where($where);
  	    }
  	    if(isset($where_in)){        	
        	$this->db->where_in('state_id', $where_in);
        } 
  	    $this->db->group_by(array("consultant.name"));
  	    $this->db->order_by('NumberDuplicates', 'desc');  		
 	    
  	$query = $this->db->get();
    // echo $this->db->last_query();
  	if ($query->num_rows()>0) {
  		$result= $query->result_array();
  		return $result;        
  	}
  	else {
  		return null;  		        
  	}   
  }
  

  function getReportsProjectPhase($where=null, $where_in=null) {
       
 		$this->db->select("region.name, site.actual_unit_num, site.site_area, COUNT(project.id) as NumberDuplicates, COUNT(site_id) as CNT");
  	    $this->db->from('project');  	      	     
  	    $this->db->join('site', 'site.id = project.site_id', 'left outer');
  	    $this->db->join('region', 'region.id = site.region_id', 'right outer');
  	    //$this->db->join('project_status', 'project_status.id = project.project_status_id ', 'right outer');
  	    if(isset($where)){  	    
  	    	$this->db->where($where);
  	    }
        if(isset($where_in)){        	
        	$this->db->where_in('state_id', $where_in);
        }
  	    $this->db->group_by(array("region.name"));
  	    $this->db->order_by('NumberDuplicates', 'desc');  		
 	    
  	$query = $this->db->get();
    // echo $this->db->last_query();
  	if ($query->num_rows()>0) {
  		$result= $query->result_array();
  		return $result;        
  	}
  	else {
  		return null;  		        
  	}   
  }
  
  

  function getReportsOwnerStatus($where=null, $where_in=null) {
       
 		$this->db->select("site.*, project.*, owner.*, COUNT(site.id) as num_sites");
  	    $this->db->from('project');  	      	     
  	    $this->db->join('site', 'site.id = project.site_id', 'left outer');  	    
  	    $this->db->join('owner', 'owner.site_id = site.id', 'left outer');  	    
  	    if(isset($where)){  	    
  	    	$this->db->where($where);
  	    }
   
  	    if(isset($where_in)){        	
        	$this->db->where_in('state_id', $where_in);
        }
  	    
  	    $this->db->group_by(array("site.id"));  	      	      	    
  	    //$this->db->order_by('NumberDuplicates', 'desc');  		
 	    
  	$query = $this->db->get();
    //echo $this->db->last_query();
  	if ($query->num_rows()>0) {
  		$result= $query->result_array();
  		return $result;        
  	}
  	else {
  		return null;  		        
  	}   
  }
  
 function getOwnerStatus($where=null, $where_in=null) {
       
 		$this->db->select("site.*, project.*, owner_type.name as owner_name, owner.*, COUNT(owner.id) as num_owners");
  	    $this->db->from('project');  	      	     
  	    $this->db->join('site', 'site.id = project.site_id', 'left outer');  	    
  	    $this->db->join('owner', 'owner.site_id = site.id', 'left outer');
  	    $this->db->join('owner_type', 'owner.id = owner_type.id', 'left outer');   	    
  	    if(isset($where)){  	    
  	    	$this->db->where($where);
  	    }
   
  	    if(isset($where_in)){        	
        	$this->db->where_in('state_id', $where_in);
        }
  	    
  	 $this->db->group_by(array("owner_name"));  	      	      	    
  	//$this->db->order_by('NumberDuplicates', 'desc');  		
 	    
  	$query = $this->db->get();
    //echo $this->db->last_query();
  	if ($query->num_rows()>0) {
  		$result= $query->result_array();
  		return $result;        
  	}
  	else {
  		return null;  		        
  	}   
  }
	 
  

  function getAllStates($where=null) {
       
 		$this->db->select("state.*");
  	    $this->db->from('state');  	      	     
  	    //$this->db->join('sector', 'sector.id = region.sector_id', 'right outer');
  	    $this->db->join('region', 'region.id = state.region_id', 'right outer');  	    //
  	    if(isset($where)){  	    
  	    	$this->db->where($where);
  	    }
  	    //$this->db->group_by(array("region.name"));
  	    //$this->db->order_by('NumberDuplicates', 'desc');  		
 	    
  	$query = $this->db->get();
    // echo $this->db->last_query();
  	if ($query->num_rows()>0) {
  		$result= $query->result_array();
  		return $result;        
  	}
  	else {
  		return null;  		        
  	}   
  }
 
	
	 

}
 ?>