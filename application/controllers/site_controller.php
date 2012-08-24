<?php
class Site_Controller extends CI_Controller {
	
	function index()
	{
		$this->load->model('site_m');

		// fetch all the products!
		$products = $this->site_m->get_products();

		// print_r($products);	

		// pass the $products variable to the $data array to be passed to the view
		$data['products'] = $products;

		// render the view
		$this->load->view('home', $data);

	}
}

/* End of file site_controller.php */
/* Location: ./application/controllers/site_controller.php */