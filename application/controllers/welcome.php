<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function test(){
		// Load the library
		$this->load->library('rest');

		// Set config options (only 'server' is required to work)

		$config = array('server'            => 'http://localhost/repo/ci/api/'
		                //'api_key'         => 'Setec_Astronomy'
		                //'api_name'        => 'X-API-KEY'
		                //'http_user'       => 'username',
		                //'http_pass'       => 'password',
		                //'http_auth'       => 'basic',
		                //'ssl_verify_peer' => TRUE,
		                //'ssl_cainfo'      => '/certs/cert.pem'
		                );
		$config['server'] = 'http://localhost/repo/ci/api/';
		// Run some setup
		$this->rest->initialize($config);

		// Pull in an array of tweets
		echo "<pre>";
		print_r( $this->rest->get('example/user?id=1.json') );
		echo "</pre>";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */