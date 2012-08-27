<?php

class Site_controller extends CI_Controller {
	
	function index()
	{
		// get all the products
		$data['products'] = Product::get_products();

		// render the view
		$this->load->view('home', $data);
	}

}

/* End of file site_controller.php */
/* Location: ./application/controllers/site_controller.php */