<?php
class Site_m extends CI_Model {
	
    /**
     * Fetches products in the database
     *
     * @param (OPTIONAL) (string) $id -The product id 
     * @return (array) $products_array
     * @author John Kevin M. Basco
     */
    function get_products($id = NULL)
    {
        //-----------------------------------------------------------------------------------------
        // queries starts #########################################################################
        //-----------------------------------------------------------------------------------------

        // check if an id is passed as a parameter
        if ($id != NULL)
        {
            $this->db->where('id', $id); // filter by id to get 1 product from the dbase
        }

        // query the products
        $products_query = $this->db->get('products');

        $product_ids = array(); // array that will hold product id's

        // store the product id's in an array to be used in querying the option_keys
        foreach ($products_query->result() as $product) 
        {
            $product_ids[] = $product->id;
        }

        // print_r($product_ids);

        // query the option_keys of the products
        $option_keys_query = $this->db->where_in('prod_id', $product_ids)
                                      ->get('option_keys');

        // print_r($option_keys->result());

        $option_key_ids = array(); // array that will hold option_key id's

        // store the option key id's in an array to be used in querying the option_values
        foreach ($option_keys_query->result() as $option_key) 
        {
            $option_key_ids[] = $option_key->id;
        }  

        // print_r($option_key_ids);

        // check if the array $option_key_ids is not empty
        if (count($option_key_ids) > 0)
        { // array $option_key_ids is not empty so lets get the option values associated w/ it!
            $option_values_query = $this->db->where_in('option_id', $option_key_ids)
                                            ->get('option_values');
        }
     
        // print_r($option_values_query->result());

        //-----------------------------------------------------------------------------------------
        // queries ends ###########################################################################
        //----------------------------------------------------------------------------------------- 



        //-----------------------------------------------------------------------------------------
        // handling results and forming data structures starts ####################################
        //----------------------------------------------------------------------------------------- 

        $products_array = array(); // array that will hold all the products to be returned

        // option values
        if (isset($option_values_query))
        {
            foreach ($option_values_query->result() as $option_value) 
            { 
                // store the $option_value object to an associative array to associate it with the option_id(option key id)
                $option_values[ $option_value->option_id ][] = $option_value;
            }
        }
        
        // print_r($option_values);

        // option keys
        if ($option_keys_query->num_rows() > 0)
        {
            foreach ($option_keys_query->result() as $option_key) 
            {
                // associate the option values array that holds the option values object to their corresponding option_keys object
                $option_key->option_values = isset($option_values[ $option_key->id ]) ? $option_values[ $option_key->id ] : '';

                // store the $option_key object to an associative array to associate it with the product id
                $option_keys[ $option_key->prod_id ][] = $option_key;
            }
        }
        
        // print_r($option_keys);

        // products
        foreach ($products_query->result() as $product) 
        {
            // check if there are available option keys related to this product id
            // if there is none, do not assign a option_key to the product
            if (isset($option_keys[$product->id]))
            {
                // associate the option_keys array that holds the option keys object to their corresponding product object
                $product->option_keys = isset($option_keys[ $product->id ]) ? $option_keys[$product->id] : '';
            }
            
            // print_r($product);

            // append/store the $product object to the products array
            $products_array[] = $product;   
        }

        //-----------------------------------------------------------------------------------------
        // handling results and forming data structures ends ######################################
        //-----------------------------------------------------------------------------------------   



        // our work here is done, let's return the products array to the controller! Yay! Beer time! Cheers!
        return $products_array;      

    }


}


/* End of file site_m.php */
/* Location: ./application/models/site_m.php */