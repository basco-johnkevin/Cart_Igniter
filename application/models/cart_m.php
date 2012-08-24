<?php
class Cart_m extends CI_Model
{
	
	/**
     * Fetches a product in the database
     *
     * @param (string) $id -The product id 
     * @return (object)
     * @author John Kevin M. Basco
     */
	function get_product($id)
	{
		return $this->db->where('id', $id)
						->get('products');
	}

	/**
     * Fetches option_keys in the database that is associated w/ a product
     *
     * @param (string) $prod_id -The product id 
     * @return (object)
     * @author John Kevin M. Basco
     */
	function get_option_keys($prod_id)
	{
		return $this->db->where('prod_id', $prod_id)
						->get('option_keys');
	}

	/**
     * Fetches an option_value in the database that is associated w/ an option_key
     *
     * @param (string) $option_key_id -The id of the option_key
     * @param (string) $option_value -The option value
     * @return (object)
     * @author John Kevin M. Basco
     */
	function get_option_value($option_key_id, $option_value)
	{
		return $this->db->where('option_id', $option_key_id)
						->where('option_value', $option_value)
						->get('option_values');
	}

}

/* End of file cart_m.php */
/* Location: ./application/models/cart_m.php */