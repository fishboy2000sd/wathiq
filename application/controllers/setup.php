<?php if (!defined('BASEPATH')) die ('No direct script access allowed!');

class Setup extends CI_Controller
{
        public function __construct()
        {
                parent::__construct();
        }

        /*
         * Displays all of the blog posts in a table
         */
        public function index()
        {
                // load all of our posts
                //$data['posts'] = Model\app::all();

                // build our blog table
                //$data['content'] = $this->load->view('view_many_posts', $data, TRUE);

                // show the main template
                //$this->load->view('main_template', $data);
        }
}