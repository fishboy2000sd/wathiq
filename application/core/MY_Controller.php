<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Controller extends CI_Controller {
	//var $lgn;
	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');  



        if(! $this->_is_logged_in()){
        	redirect('authenticator/login');
        	exit(0);
        }      /**/
                                    
    }
	public function index()
	{			
								
	}	

	private function _is_logged_in(){
		//$this->echo_r($this->session->all_userdata());exit;
        return $this->session->userdata('logged_in');
    }

	public function echo_r($param){
		echo "<pre>";
		print_r($param);
		echo "</pre>";
	}

	public function has_privilege($privilege){
		// get the role id from the user after get user id from session 
		$role_id = $this->session->userdata('role_id'); //1;
		$role = Model\Role::find($role_id);

		/*echo "<pre>";
		print_r($role);
		echo "</pre>";*/
		$privileges = array();
		foreach($role->privilege() as $prv) :               
           $privileges[$prv->id] = $prv->code;
        endforeach;

        /*echo "<pre>";
		print_r($privileges);
		echo "</pre>";*/
		// array_search($privilege, $privileges)
		
		//if(array_key_exists($privilege, $privileges))
		if(in_array($privilege, $privileges))
			return TRUE;
		else
			return FALSE;
	}
    
}

/* End of file my_controller.php */
/* Location: ./application/core/my_controller.php */
