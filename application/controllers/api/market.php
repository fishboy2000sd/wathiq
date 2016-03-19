<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Market
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Ahmed Merghani
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Market extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
        
        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }
    
    function get_apps_get()
    {
        
        //$apps = Model\App::limit($count, $id)->order_by('timestamp', 'DESC')->where_in('id', $case_ids)->all();
		$apps = Model\App::all();
    	//$user = @$users[$this->get('id')];
    	
        if($apps)
        {
            foreach($apps as $app){
                $app_data = $app->record->get('data');
                $app_data['rating'] = $app->review();
                $data[] = $app_data;
            }
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No apps found'), 404);
        }
    }

    function get_categories_get()
    {
        
        //$apps = Model\App::limit($count, $id)->order_by('timestamp', 'DESC')->where_in('id', $case_ids)->all();
        $cats = Model\category::all();
        //$user = @$users[$this->get('id')];
        
        if($cats)
        {
            foreach($cats as $cat)
                $data[] = $cat->record->get('data');
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No categories found'), 404);
        }
    }

    function get_app_details_get()
    {

        $id = $this->get('id');
        if(! $id)
        {
            $this->response(NULL, 400);
        }
        
        //$apps = Model\App::limit($count, $id)->order_by('timestamp', 'DESC')->where_in('id', $case_ids)->all();
        $app = Model\App::find($id);
        //$user = @$users[$this->get('id')];
        
        if($app)
        {
            //foreach($apps as $app)
                //$data[] = $app->record->get('data');
            $data = $app->record->get('data');

            $screen_data = $app->screen();
            $screens = array();
            foreach ($screen_data as $value) {
                $screens[] = $value->screen;
            }
            $comment_data = $app->comment();
            $comments = array();
            foreach ($comment_data as $value) {
                $comments[] = $value->msg;
            }
            $rating = 0;
            $sum = 0;
            $rating_data = $app->review();
            $count = count($rating_data);
            foreach ($rating_data as $value) {
                $sum += $value->rating;
            }
            if($count > 0)
                $rating = $sum / $count;
            $data['screens'] = $screens;
            $data['comments'] = $comments;
            $data['rating'] = $rating;
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'App not found'), 404);
        }
    }

    function get_category_apps_get()
    {

        $cat_id = $this->get('id');
        if(! $cat_id)
        {
            $this->response(NULL, 400);
        }
        
        //$apps = Model\App::limit($count, $id)->order_by('timestamp', 'DESC')->where_in('id', $case_ids)->all();
        $apps = Model\App::where('category_id', $cat_id)->all();
        //$user = @$users[$this->get('id')];
        
        if($apps)
        {
            foreach($apps as $app){
                //$data[] = $app->record->get('data');
                $app_data = $app->record->get('data');
                $app_data['rating'] = $app->review();
                $data[] = $app_data;
            }
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No apps found'), 404);
        }
    }

    function rate_post()
    {
        $app_id = $this->post('id');
        $rating = $this->post('rating');
        if(! $app_id || ! $rating)
        {
            $this->response(NULL, 400);
        }
        
        if($rating <= 5 && $rating >= 1)
        {
            $review = Model\Review::make(array('app_id' => $app_id, 'rating' => $rating));//->save();
            $status = $review->save();

            $rs = Model\Review::where('app_id', $app_id)->sum('rating');
            $count = Model\Review::where('app_id', $app_id)->all();
            $data = array('rating' => $rs->rating / count($count) );
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Invalid number'), 404);
        }
    }

    function comment_post()
    {
        $app_id = $this->post('id');
        $msg = $this->post('msg');
        if(! $app_id || ! $msg)
        {
            $this->response(NULL, 400);
        }
        
        if($msg != "")
        {
            $comment = Model\Comment::make(array('app_id' => $app_id, 'msg' => $msg));//->save();
            $status = $comment->save();

            $this->response(array(), 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Invalid number'), 404);
        }
    }

    function get_featured_apps_get()
    {
        
        //$apps = Model\App::limit($count, $id)->order_by('timestamp', 'DESC')->where_in('id', $case_ids)->all();
        $apps = Model\App::order_by('rating', 'DESC')->all();
        //$user = @$users[$this->get('id')];
        
        if($apps)
        {
            foreach($apps as $app){ 
                $app_data = $app->record->get('data');
                $app_data['rating'] = $app->review();
                $data[] = $app_data;
            }
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No apps found'), 404);
        }
    }

    function get_top_apps_get()
    {
        
        //$apps = Model\App::limit($count, $id)->order_by('timestamp', 'DESC')->where_in('id', $case_ids)->all();
        $apps = Model\App::order_by('rating', 'DESC')->all();
        //$user = @$users[$this->get('id')];
        
        if($apps)
        {
            foreach($apps as $app){ 
                $app_data = $app->record->get('data');
                $app_data['rating'] = $app->review();
                $data[] = $app_data;
            }
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No apps found'), 404);
        }
    }

    function get_new_apps_get()
    {
        
        //$apps = Model\App::limit($count, $id)->order_by('timestamp', 'DESC')->where_in('id', $case_ids)->all();
        $apps = Model\App::order_by('created', 'DESC')->all();
        //$user = @$users[$this->get('id')];
        
        if($apps)
        {
            foreach($apps as $app){ 
                $app_data = $app->record->get('data');
                $app_data['rating'] = $app->review();
                $data[] = $app_data;
            }
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No apps found'), 404);
        }
    }

    function check_update_get()
    {

        $version = $this->get('version');
        //$package_name = $this->get('package_name');
        //$this->response($version, 200); 
        if(! $version)
        {
            $this->response(NULL, 400);
        }
        
        //$apps = Model\App::limit($count, $id)->order_by('timestamp', 'DESC')->where_in('id', $case_ids)->all();
        $app = Model\App_setting::where('version >', $version)->order_by('updated', 'DESC')->all();
        //$user = @$users[$this->get('id')];
        //$this->response($app[0]->record->get('data'), 200);
        if($app)
        {
            //foreach($apps as $app)
                //$data[] = $app->record->get('data');
            $this->response($app[0]->record->get('data'), 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No update found'), 404);
        }
    }

    function check_apps_update_post()
    {

        $data = $this->post('data');
        //$this->response($version, 200);
        //$package_name = $this->post('package_name');
        //$this->response($version, 200); 
        if(! $data )
        {
            $this->response(NULL, 400);
        }
        
        //$apps = Model\App::limit($count, $id)->order_by('timestamp', 'DESC')->where_in('id', $case_ids)->all();
        $rs = array();
        foreach($data as $item){
            $app = Model\App::where(array('package_name' => $item['package_name'], 'current_version >' => $item['version']))->order_by('updated', 'DESC')->all();
            if($app)
                $rs[] = $app[0]->record->get('data');
        }
        //$user = @$users[$this->get('id')];
        //$this->response($app[0]->record->get('data'), 200);
        if($rs)
        {
            //foreach($apps as $app)
                //$data[] = $app->record->get('data');
            $this->response($rs, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No update found'), 404);
        }
    }
    
    /*function user_post()
    {
        //$this->some_model->updateUser( $this->get('id') );
        $message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function user_delete()
    {
    	//$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function users_get()
    {
        //$users = $this->some_model->getSomething( $this->get('limit') );
        $users = array(
			array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
			array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => array('hobbies' => array('fartings', 'bikes'))),
		);
        
        if($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }


	public function send_post()
	{
		var_dump($this->request->body);
	}


	public function send_put()
	{
		var_dump($this->put('foo'));
	}*/
}