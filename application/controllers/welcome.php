<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {



	 public function __construct()
    {
    	parent::__construct();
    	$this->output->enable_profiler(TRUE);

    }







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


		// $users = User::all();

		// //var_dump($users);

		// foreach ($users as $user) {
		// 	echo $user->name;
		// }

		// $this->load->spark('php-activerecord/0.0.2');
		// echo '<pre>'; var_dump(Test::all()); exit;
		// $this->load->view('welcome_message');

		// -------------------------------------------------------
		// sample in dealing w/ relationships 1 to many starts
		// -------------------------------------------------------

		 // $users = User::find('all', array('limit' => 10, 'include' => array('post')));

		 // //var_dump($users);

		 // 	foreach ($users as $user) {
		 // 		echo $user->name;

		 // 		foreach ($user->post as $post) {
		 // 			echo $post->content;
		 // 		}
		 // 	}

		// -------------------------------------------------------
		// sample in dealing w/ relationships 1 to many ends
		// -------------------------------------------------------



		// -------------------------------------------------------
		// sample in dealing w/ deep relationships starts
		// -------------------------------------------------------

		 // $users = User::find('all', array('limit' => 10, 'include' => array('post' => array('comments'))));
 
		 // //var_dump($users);

		 // // to check last query made
		 // //echo User::connection()->last_query;

		 // 	foreach ($users as $user) {
		 // 		//echo $user->name;

		 // 		foreach ($user->post as $post) {
		 // 			//echo $post->content;

		 // 			//print_r($post->comments);


		 // 			foreach ($post->comments as $comment) {
		 // 				//echo $comment->comment;
		 // 			}
		 // 		}
		 // 	}

		 // -------------------------------------------------------
		// sample in dealing w/ deep relationships ends
		// -------------------------------------------------------


		// // lazy load
		// //$users = User::find('all');
	

		// // eager load
		//  $users = User::find('all', array('limit' => 10, 'include' => array('post' => array('comments'))));

		
 
		//  //var_dump($users);

		//  // to check last query made
		//  echo User::connection()->last_query;

		//  	foreach ($users as $user) {
		//  		echo 'User Name: ' . $user->name;
		//  		echo '<br>';

		//  		foreach ($user->post as $post) {
		//  			echo 'Post: ' . $post->content;
		//  			echo '<br>';

		//  			//print_r($post->comments);


		//  			foreach ($post->comments as $comment) {
		//  				echo 'Comment: ' . $comment->comment;
		//  				echo '<br>';

		//  			}
		//  		}
		//  	}



		// --------------------------------------------------------


		// lazy load
		//$users = User::find('all');
	
		// eager load
 		$users = User::find('all', array('include' => array('posts' => array('comments' => array('blogs')))));

		 //var_dump($users);

		 // to check last query made
		
 		//  echo User::connection()->last_query;
		 	foreach ($users as $user) {
		 		echo 'User Name: ' . $user->name;
		 		echo '<br>';

		 		foreach ($user->posts as $post) {
		 			echo 'Post: ' . $post->content;
		 			echo '<br>';

		 			//print_r($post->comments);


		 			foreach ($post->comments as $comment) {
		 				echo 'Comment: ' . $comment->comment;
		 				echo '<br>';

		 				foreach ($comment->blogs as $blog) {

		 				//	echo User::connection()->last_query;
		 					echo $blog->name;

		 				}

		 			}
		 		}
		 	}
		  		
	}

	function eager()
	{
		
		// lazy load
		//$users = User::find('all');
	
		// eager load
 		 $users = User::find('all', array('include' => array('posts' => array('comments' => array('blogs')))));
		//$users = User::find('all', array('include' => array('posts')));

		 //var_dump($users);

		 // to check last query made
		
 		//  echo User::connection()->last_query;
		 	foreach ($users as $user) {
		 		echo 'User Name: ' . $user->name;
		 		echo '<br>';

		 		foreach ($user->posts as $post) {
		 			echo 'Post: ' . $post->content;
		 			echo '<br>';

		 			//print_r($post->comments);


		 			foreach ($post->comments as $comment) {
		 				echo 'Comment: ' . $comment->comment;
		 				echo '<br>';

		 				foreach ($comment->blogs as $blog) {

		 				//	echo User::connection()->last_query;
		 					echo $blog->name;

		 				}

		 			}
		 		}
		 	}
	}


	function lazy()
	{

		// lazy load
		$users = User::find('all');
	
		// eager load
 		//$users = User::find('all', array('include' => array('posts' => array('comments' => array('blogs')))));

		 //var_dump($users);

		 // to check last query made
		
 		  //echo User::connection()->last_query;
		 	foreach ($users as $user) {
		 		echo 'User Name: ' . $user->name;
		 		echo '<br>';

		 		foreach ($user->posts as $post) {
		 			echo 'Post: ' . $post->content;
		 			echo '<br>';

		 			//print_r($post->comments);


		 			foreach ($post->comments as $comment) {
		 				echo 'Comment: ' . $comment->comment;
		 				echo '<br>';

		 				foreach ($comment->blogs as $blog) {

		 					//echo User::connection()->last_query;
		 					echo $blog->name;

		 				}

		 			}
		 		}
		 	}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */