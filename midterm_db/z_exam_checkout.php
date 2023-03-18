<!--checkout.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
	<div class="container">
		<h1>Checkout</h1>
		<form action="process_checkout.php" method="post">
			<div class="form-group">
				<label for="contact_number">Contact Number</label>
				<input type="text" class="form-control" id="contact_number" name="contact_number" required>
			</div>
			<div class="form-group">
				<label for="address">Address</label>
				<textarea class="form-control" id="address" name="address" rows="3" required></textarea>
			</div>
			<div class="form-group">
				<label for="recipient_name">Recipient Name</label>
				<input type="text" class="form-control" id="recipient_name" name="recipient_name" required>
			</div>
			<?php echo "<a href='z_exam_order_list.php' class='btn btn-success mt-2'>Confirm Order</a>"; ?>
		</form>
	</div>
</body>
</html>
