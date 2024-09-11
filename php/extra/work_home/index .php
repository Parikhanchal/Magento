<?php
	include 'library.php';

	$product = new Product();
	$result = $product->select();
	if ($result->num_rows > 0) {
	  while($row = $result->fetch_assoc()) {
	    echo "id: " . $row["entity_id"]. " - Name: " . $row["sku"]. " " . $row["price"]. "<br>";
	  }
	} else {
	  echo "0 results";
	}



	$result = $product->delete(1);
	echo get_class($product);
	echo "<pre>";print_r(get_class_methods($result));
	echo "11<pre>";print_r($result->fetch_column());
	die;


?>