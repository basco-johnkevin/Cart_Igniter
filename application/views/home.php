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

	// print_r($products);

	// output the products 1 by 1
    foreach ($products as $product) 
    {
    	echo form_open('cart_controller/add', 'method="get"'); // open form

    	echo form_hidden('product_id', $product->id); // product id

        echo strtoupper($product->name);

        echo ' starting at: ' . $product->price . ' dollars';

        echo '<br>';
        
        if (isset($product->option_keys))
        {
            // check if this product has option_keys available
            foreach ($product->option_keys as $option_key)
            {
                echo $option_key->option_key;
                echo '<br>';

                if (isset($option_key->option_values))
                {
                	$option_values_array = array();
                	$option_values_price_array = array();
                  
                    foreach ($option_key->option_values as $option_value) 
                    {
                       	$option_values_array[] = $option_value->option_value;
                       	$option_values_price_array[] = $option_value->price;
                    }

                    // print_r($option_values_array);
                    // print_r($option_values_price_array);

                    $options_array = array();

                    $x = 0;
             		foreach ($option_values_array as $key => $value) 
             		{
						$options_array[ $value ] = $value . ' @ ' . $option_values_price_array[ $x ] . ' dollars';

						$x++; // iterate
					}

					echo form_dropdown(
				 		$option_key->option_key,
				 		$options_array
				 	);

					// $options_array = ''; // unset the options array to be used next to the next iteration 

                    echo '<br>';
                }
                else
                {
                    die('What the hell dude! there are no option values available for this option key! so lets kill the script!');
                }

            }
        }

        echo '<br>'; 
        
        echo form_submit('submit', 'add to cart'); // add to cart button

        echo form_close(); // close form

        echo '<hr>';

        

    }
	?>
</body>
</html>