<?php
class Site extends CI_Controller {
	
	function index()
	{
		$this->load->model('site_m');
		$products = $this->site_m->get_products();

		// print_r($products);

		$data['products'] = $products;

		$this->load->view('home', $data);
	}
}