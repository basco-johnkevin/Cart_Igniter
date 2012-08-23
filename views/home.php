<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title></title>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/style.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<style>
		
	</style>

</head>
<body>
	<?php 
		//print_r($products);

		foreach ($products as $product) 
        {
        	// print_r($product);

        	echo form_open('cart/add', 'method="get"');

        	echo form_hidden('product_id', $product->id);

        	echo 'Product Name: ' , $product->name;
        	echo '<br>';
        	echo '<br>';
        	echo 'Product Price starting at: ' , $product->price;
        	echo '<br>';
        	echo '<br>';

        	// print_r($product->option_keys);

        	// print_r($product->option_keys[0]->option_values[0]->result());

        	if (isset($product->option_keys))
        	{
        		foreach ($product->option_keys as $option_key) 
        		{
	        		// print_r($option_key);
	        		// print_r($option_key->option_values);

	        		echo 'Option Key: ' , $option_key->option_key;
	        		echo '<br>';
	        		echo '<br>';

	        		foreach ($option_key->option_values as $option_values) 
	        		{
	        			// print_r($option_values->result());

	        			$pre_options = array();

	        			foreach ($option_values->result() as $option_value) 
	        			{
	        				// print_r($option_value);
	        				$pre_options[$option_value->option_value] = $option_value->option_value . ' @ ' . $option_value->price;

	        			}

	        			// print_r($pre_options);

	        			// convert to the suited array format to be supplied to the dropdown in the form!
	        			foreach ($pre_options as $key => $value) {
	        				$options[$key] = $value;
	        			}

	        			//print_r($options);

	        			echo form_dropdown(
									 		$option_key->option_key,
									 		$options
									 	);

	        			$options = ''; // reset the options array!

	        			echo '<br>';
	        			echo '<br>';

	        		}
	        	}
        	}

        	
        	echo form_submit('submit', 'submit');

	        echo form_close();

	        echo '<br>';
	        echo '<br>';
	        echo '<br>';
	        echo '<br>';
	        echo '<hr>';

	   		
        	
        }
	?>
</body>
</html>