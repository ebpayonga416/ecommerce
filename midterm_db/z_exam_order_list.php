
<!--order_list.php -->

<html>
<?php include_once "conn_db.php"; ?>
<head>
    <meta charset="UTF-8">
    <title>List of Products</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
            <!--Displaying the ordered record list -->
                <h1>Order List Record</h1>
                <?php
                    // Perform the join query
                    $query = "SELECT u.fullname, u.contact_number, u.address, p.item_name, o.item_qty, o.date_ordered, o.order_status
                        FROM orders o
                        JOIN users u ON u.user_id = o.user_id
                        JOIN products p ON p.item_id = o.item_id
                        WHERE o.order_status = 'P'
                        ORDER BY o.order_id DESC"; // order by order_id in descending order
                
                    $result = mysqli_query($conn, $query);
                
                    // Check if the query was successful
                    if ($result && mysqli_num_rows($result) > 0) {
                    // Display the order list
                        echo "<table class='table table-bordered'>";
                        echo "<thead>";   
                        echo "<tr>";  
                        echo "<th>User</th>";   
                        echo "<th>Contact Number</th>";
                        echo "<th>Address</th>"; 
                        echo "<th>Product</th>";   
                        echo "<th>Quantity</th>";       
                        echo "<th>Date Ordered</th>";    
                        echo "<th>Order Status</th>";   
                        echo "</tr>";   
                        echo "</thead>";    
                        echo "<tbody>";
                        while ($row = mysqli_fetch_assoc($result)) { 
                            echo "<tr>";    
                            echo "<td>" . $row['fullname'] . "</td>";   
                            echo "<td>" . $row['contact_number'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>"; 
                            echo "<td>" . $row['item_name'] . "</td>";  
                            echo "<td>" . $row['item_qty'] . "</td>"; 
                            echo "<td>" . $row['date_ordered'] . "</td>";
                            echo "<td>" . $row['order_status'] . "</td>";
                            echo "</tr>";
                        }  
                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        // If the query was not successful, display an error message
                        echo "Error retrieving order list from database.";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
<script src="js/bootstrap.js"></script>
</html>