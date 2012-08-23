<?php
class Site_m extends CI_Model {
	
    function get_products($id = NULL) {

        // define optional id for single product
        // if an id was supplied
        if ( $id != NULL ) {
            $this->db->where('id',$id);
        }

        // execute query
        $query = $this->db->get('products');

        //make sure results exist
        if($query->num_rows() > 0) {
            $products = $query->result();
        } else {
            return FALSE;
        }

        // create array for appended (with option_keys) products
        $appended_products_array = array();

        // loop through each product
        foreach ($products as $product) 
        {
            // et option_keys associated with the product
            $this->db->where('prod_id', $product->id);
            $option_keys = $this->db->get('option_keys');

            // print_r($option_keys);

            if ($option_keys->num_rows() > 0)
            {
            	$product->option_keys = $option_keys;
            }
            else
            {
            	// $product->option_keys = array();
            }
          
          	// print_r($product);

            $option_keys_array = array();

            $option_values_array = array();

            if (isset($product->option_keys))
            {
            	foreach ($product->option_keys->result() as $option_key) 
				{
					// echo $option_key->id;
					// echo $option_key->option_key;

					// get the option_values associated with the option_key
					$this->db->where('option_id', $option_key->id);
					$option_values = $this->db->get('option_values');

					if ($option_values->num_rows() > 0)
					{
						$option_values_array[] = $option_values;
					}
					else
					{
						// $product->option_keys = array();
					}

					$option_key->option_values = $option_values_array;

					$option_values_array = ''; // unset the array after using

					// print_r($option_key);

					$option_keys_array[] = $option_key;
				}
            }

        	// print_r($option_keys_array);

            $count = count($option_keys_array);

            if ($count != 0)
            {
            	$product->option_keys = $option_keys_array;
            }

			// print_r($product);

			$option_keys_array = ''; // unset the array after using

            // rebuild the returned products with their option_keys
            $appended_products_array[] = $product;
        }

        // return it!
        return $appended_products_array;
    }
}