<!--o_order_display.php -->
<?php
    include_once "conn_db.php";
    
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Ordering</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container mt-3">
            <a class="navbar-brand" href="#" style="color: White; font-size: 20px; font-weight: 600; font-family: Georgia, 'Times New Roman', Times, serif;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown" >
                <ul class="navbar-nav ms-auto" style="font-weight: bolder;">
                    <li class="nav-item">
                        <a class="nav-link active" href="u_user_display.php">USERS</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="product_display.php">PRODUCTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="o_order_display.php">ORDER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="l_logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <div class="row">
            <div class="col-7">
<!--Displaying the list of products -->
                <h2>Order Now</h2>
                <?php
                    $product_list = query($conn, "SELECT item_id, item_name, item_price FROM products WHERE item_status='A'");
                    echo "<hr>";
                    echo "<table class='table table-bordered'>";
                    echo "<thead>";
                    echo "<th>Product Name</th>";
                    echo "<th>Price</th>";
                    echo "<th>Order Qty.</th>";
                    echo "</thead>";
                    echo "<tbody>";
                    foreach($product_list as $key => $row){
                        echo "<tr>";
                        echo "<td>" . $row['item_name'] . "</td>";
                        echo "<td>" . $row['item_price'] . "</td>";
                        echo "<td> 
                            <form action='o_displaycart.php' method='POST'>
                                <input type='hidden' name='item_id' value='". $row['item_id'] ."' />
                                <input type='number' name='item_qty' value='1' min='1' />
                                <button type='submit' class='btn btn-success'>Add to cart</button>
                            </form>
                        </td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "<a class='btn btn-success float-end' href='o_checkout.php'> Buy Now </a>";
                ?>
            </div>
            <div class="col-5">
                <h2>Ordered</h2>
                <?php
                    // Display the contents of the cart, o_displaycart.php
                    echo "<hr>";
                    echo "<table class='table table-bordered'>";    echo "<thead>";             
                    echo "<th>Item Name</th>";
                    echo "<th>Item Qty.</th>";
                    echo "<th>Subtotal</th>";   
                    echo "<th>Action</th>";
                    
                    foreach($product_list as $key => $row){
                        if(isset($_SESSION['cart'][$row['item_id']])) {
                            $item_qty = $_SESSION['cart'][$row['item_id']];
                            $subtotal = $item_qty * $row['item_price'];
                            // Display a row for the item in the cart
                            echo '<tr>';
                            echo '<td>' . $row['item_name'] . '</td>';
                            echo '<td>' . $item_qty . '</td>';
                            echo '<td>' . $subtotal . '</td>';
                            echo '<td><a class="btn btn-danger" href="o_displaycart.php?remove=' . $row['item_id'] . '">Remove</a></td>';
                            echo '</tr>';
                        }
                    }
                    ?>
            </div>
        </div>
    </div>
   
</body>
<script src="js/bootstrap.js"></script>
</html>
