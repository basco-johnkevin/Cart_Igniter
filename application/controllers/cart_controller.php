<?php

class Cart_controller extends CI_Controller {
	
	/**
	 * Validates and adds the item to the cart
	 *
	 * @return void
	 * @author John Kevin Basco
	 */
	function add()
	{
		$product_id = $this->input->get('product_id');

		// get the product details and validate if product really exists in the database
		$product = Product::get_products($product_id);

		// count the result
		$result_count = count($product);

		// kill script if the product doesn't exist in the database
		if ($result_count !== 1)
		{
			die('Product do not exist in the database! Are you CHEATING?!!');
		}

		$price = $product->price; // product price
		$product_name = $product->name; // product name

		if (count($product->option_keys) > 0)
		{
			$option_keys_array = array();

			foreach ($product->option_keys as $option_key) 
			{
				$option_keys_array[ $option_key->id ] = $option_key;
			}
		}

		$options_array = array(); // array that will hold the options chosen by the user

		//print_r($option_keys_array);

		foreach ($option_keys_array as $option_key) 
		{
			$options_array[ $option_key->id ][ $option_key->name ] = $this->input->get($option_key->name);
		}

		// print_r($options_array);

		foreach ($options_array as $option_key_id => $option_key) 
		{
			foreach ($option_key as $option_key => $option_value) 
			{			
				// validate! if option value is null lets kill the script. It means the user is cheating or modified the required (dropdown) select name in the form
				if ($option_value == '')
				{
					die('Cheating?!! Stop it you jerk!');
				}

				// validate if the option value for the option key really exist in the database
				$option_value_query = Option_value::get_option_value($option_key_id, $option_value);

				$temp_option_value = $option_value; // current option value to be used in the error message if the option value is not found in the database
			}

			// kill the script and show an error message if the option value chosen by the user for the option key doesn't exist
			if (count($option_value_query) === 0)
			{
				die('Cheating?!! ' . $temp_option_value . ' is not a valid option!');
			}

			$price += $option_value_query->price; // add the price of each option value that has been chosen by the user to the $price variable
		}

		// if we reach this point, it means that all validations has been passed, that means there are no errors so let's continue!

		// let's finally add the item into the cart baby!

		// raw options
		// print_r($options_array);

		// convert the options array to the format that the cart library understands
		foreach ($options_array as $key => $option_key) 
		{
			foreach ($option_key as $key => $value) 
			{
				$options[ $key ] = $value;
			}
		}

		// converted options
		// print_r($options);

		$this->_add($product_id, $qty = 1, $price, $product_name, $options);
	}

	/**
	 * Adds an item to the cart
	 *
	 * @return (bool) TRUE on success, FALSE on failure
	 * @author John Kevin M. Basco
	 */
	function _add($product_id, $qty, $price, $product_name, $options)
	{
		$data = array(
           'id'      => $product_id,
           'qty'     => $qty,
           'price'   => $price,
           'name'    => $product_name,
           'options' => $options
        );

		$this->cart->insert($data); 

		$cart = $this->cart->contents();
		print_r($cart);

	 	echo 'Cart Total Price: ' . $this->cart->total();
	}

	/**
	 * Clears the contents of the cart
	 *
	 * @return void
	 * @author John Kevin M. Basco
	 */
	function clear_cart()
	{
		$this->cart->destroy();
	}


}

/* End of file cart_controller.php */
/* Location: ./application/controllers/cart_controller.php */