<?php

    // o_checkout.php
    // this is the interface for the checkout where user can see there order
    // with user info for recipient something 

    include_once "conn_db.php";

    // If the cart doesn't exist yet, create it as an empty array
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    // If the user is logged in, store their user ID in the session
    if (isset($_SESSION['user_id'])) {
        // Retrieve user information from the database
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            // User found, fill the form fields with user data
            $row = mysqli_fetch_assoc($result);  
            $username = $row['username'];  
            $fullname = $row['fullname'];   
            $address = $row['address'];   
            $contact_number = $row['contact_number'];   
        } else {   
            // User not found, show an error message    
            echo "User not found.";  
        }
    }
    
    // If the user submitted a form to add an item to the cart
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['item_id']) && isset($_POST['item_qty'])) {
        // Get the item ID and quantity from the form
        $item_id = filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT);
        $item_qty = filter_input(INPUT_POST, 'item_qty', FILTER_SANITIZE_NUMBER_INT);
    
        // Validate the item ID and quantity
        if (!is_numeric($item_id) || !is_numeric($item_qty)) {
            // Redirect the user back to the order display page with an error message
            header('Location: o_order_display.php?error=invalid_input');
            exit;
        }
    
        // If the item is already in the cart, update its quantity
        if (isset($_SESSION['cart'][$user_id][$item_id])) {
            $_SESSION['cart'][$user_id][$item_id] += $item_qty;
        } else {
            // Otherwise, add the item to the cart with the specified quantity
            $_SESSION['cart'][$user_id][$item_id] = $item_qty;
        }
    
        // Redirect the user back to the order display page
        header('Location: o_order_display.php');
        exit;
    }
    
    // If the user wants to remove an item from the cart
    if (isset($_GET['remove'])) {
        // Get the item ID to remove
        $item_id = filter_input(INPUT_GET, 'remove', FILTER_SANITIZE_NUMBER_INT);
    
        // Validate the item ID
        if (!is_numeric($item_id)) {
            // Redirect the user back to the cart page with an error message
            header('Location: o_checkout.php?error=invalid_input');
            exit;
        }
    
        // Remove the item from the cart
        unset($_SESSION['cart'][$user_id][$item_id]);
    
        // Redirect the user back to the cart page
        header('Location: o_checkout.php');
        exit;
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-6">
                <h1>Checkout</h1>
                <?php
                    // Initialize total amount to 0
                    $total_amount = 0;

                    // Display the contents of the cart
                    echo "<table class='table table-bordered'>";
                    echo '<thead><tr>';
                    echo '<th>Item Name</th>';
                    echo '<th>Quantity</th>';
                    echo '<th>Price</th>';
                    echo '<th>Subtotal</th>';
                    echo '</tr></thead>';
                    
                    foreach ($_SESSION['cart'] as $item_id => $item_qty) {          
                        // Get the details of the item from the database
                        $query = "SELECT item_name, item_price FROM products WHERE item_id = $item_id";
                        $result = mysqli_query($conn, $query);
                        
                        // Check if the query was successful
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                        // Calculate the subtotal for the item
                            $subtotal = $item_qty * $row['item_price'];

                            // Add the subtotal to the total amount
                            $total_amount += $subtotal;

                            // Display a row for the item in the cart                   
                            echo '<tr>';                        
                            echo '<td>' . $row['item_name'] . '</td>';                                          
                            echo '<td>' . $item_qty . '</td>';                                          
                            echo '<td>' . $row['item_price'] . '</td>';                                           
                            echo '<td>' . $subtotal . '</td>';               
                            echo '</tr>';                                  
                        } else {                                     
                            // If the query was not successful, display an error message                             
                            echo '<tr><td colspan="5">Error retrieving item details from database</td></tr>';                                  
                        }              
                    }
             
                
                    // Display the total amount                       
                    echo '<tr>';                       
                    echo '<td colspan="3"></td>';                         
                    echo '<td><strong>Total Amount: Php</strong> ' . $total_amount . '</td>';         
                    echo '<td></td>';                    
                    echo '</tr>';
               
                    echo '</table>';
    
                    // Display a link to the checkout page if the cart is not empty
                    if (!empty($_SESSION['cart'])) {              
                        echo '<a class="btn btn-info me-5" href="o_order_display.php">back</a>';                 
                    } else {

                    // If the cart is empty, display a message              
                    echo 'Your cart is empty.';
                }     
            ?>
            </div>
            <div class="col-6">
                <h2>Enter User Information</h2>                   
                <form action="o_process_checkout.php" method="POST">
                    <div class="mb-3">
                        <label for="new_fullname" class="form-label">Fullname</label>
                        <input type="text" required id="new_fullname" name="fullname" class="form-control" value="<?php echo isset($fullname) ? $fullname : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" required id="new_address" name="address" class="form-control" value="<?php echo isset($address) ? $address : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="contac_number" class="form-label">Contact Number</label>
                        <input type="number" required id="new_contact_number" name="contact_number" class="form-control" value="<?php echo isset($contact_number) ? $contact_number : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="new_username" class="form-label">Username</label>
                        <input type="text" id="new_username" required name="username" class="form-control" value="<?php echo isset($username) ? $username : ''; ?>">
                    </div>
                        <input type="submit" class="btn btn-success float-end" value="Checkout">
                </form>
            </div>
        </div>
    </div>

</body>
<script src="js/bootstrap.js"></script>
</html>
