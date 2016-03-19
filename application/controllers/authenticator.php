<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Authenticator extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');     
        $this->load->library('form_validation');         
               
    }
	public function index()
	{			
								
	}
    public function is_logged_in(){
        return $this->session->userdata('logged_in');
    }

    public function login(){
        
        $this->load->view('login.php');

       $this->load->view('login.php');
    }

    public function do_login(){
    	

		//print_r($this->input->post());exit;
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE){
            $this->load->helper('security');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $password = do_hash($this->input->post('password'), 'md5');
    		$query = $this->db->get_where('user', array('user_name' => $username, 'password' => $password));	
            //echo "User: $username";
            //echo "<br />Pass: $password";
    		//echo "<pre>"; print_r($query->row()); echo "</pre>"; exit;
    		if($query->num_rows() > 0){
                //echo "test";exit;
                $user_id = $query->row()->id;
                $role_id = $query->row()->role_id;
                $name = $query->row()->name;
    			$this->session->set_userdata('logged_in', true);
    			$this->session->set_userdata('username', $username);
                //$this->session->set_userdata('name', $name);
                $this->session->set_userdata('user_id', $user_id);
                $this->session->set_userdata('role_id', $role_id);
                //$this->session->set_userdata('privileges', $privileges);
    			//$portal->apps_management();
    			redirect(site_url('portal/index'));
    		}else{
    			//$this->index();
                //echo "<pre>"; print_r($this->session->all_userdata()); echo "</pre>"; exit;
    			redirect(site_url('authenticator/login'));
    		}
        }else{
            redirect(site_url('authenticator/login'));   
        }
    }

    public function logout(){
        $login_info = array(
                       'username'  => '',                   
                       'logged_in' => FALSE
                   );
        $this->session->set_userdata($login_info);
        //$this->session->sess_destroy();
        //print_r($this->session->all_userdata());
        $this->load->view('login.php');
    }    
}