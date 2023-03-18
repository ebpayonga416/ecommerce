<!--index.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Ordering Module</title>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
	<div class="container">
		<h1>Ordering Module</h1>
		<?php
			include_once "conn_db.php";
			
			$product_list = query($conn, "SELECT * FROM products WHERE item_status = 'A'");
			if(count($product_list) > 0) { 
				echo "<hr>";
                echo "<table class='table table-bordered'>";
                echo "<thead>";
                echo "<th>Product Name</th>";
                echo "<th>Price</th>";
                echo "<th>Order Qty.</th>";
                echo "</thead>";
                echo "<tbody>";
                
				foreach($product_list as $product){
					echo "<tr>";
					echo "<td>".$product['item_name']."</td>";
					echo "<td>".$product['item_price']."</td>";
					echo "<td>";
					echo "<form action='' method='post'>";
					echo "<input type='hidden' name='item_id' value='".$product['item_id']."'>";
					echo "<div class='form-group'>";
					echo "<input type='number' class='form-control' id='item_qty' name='item_qty' value='1' min='1'>";
					echo "</div>";
					echo "</td>";
					echo "<td>";
					echo "<button type='submit' class='btn btn-success'>Add to cart</button>";
					echo "</form>";
					echo "</td>";
					echo "</tr>";
				}
				echo "</tbody>";
                echo "</table>";
				echo "<a href='z_exam_checkout.php' class='btn btn-success float-end'>Buy now</a>";
			}
			else {
				echo "<p>No products found.</p>";
			}
		?>
	</div>
</body>
</html>