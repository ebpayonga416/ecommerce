<html>
<?php include_once "conn_db.php"; ?>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
 <link rel="stylesheet" href="css/bootstrap.css">

</head>
<body>
        <!--Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <div class="container mt-3">
            <a class="navbar-brand" href="#" style="color: White; font-size: 20px; font-weight: 600; font-family: Georgia, 'Times New Roman', Times, serif;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown" >
                <ul class="navbar-nav ms-auto" style="font-weight: bolder;">
                    <li class="nav-item">
                        <a class="nav-link active" href="#u_user_display.php">USERS</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="product_display.php">PRODUCTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="o_order_display.php">ORDER</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active " href="l_logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <h3>New Record</h3>
                
                <?php
                     if(isset($_GET['new_record'])){
                            switch($_GET['new_record']){
                                case "added": echo "<div class='alert alert-success'>User Added.</div>";
                                      break;
                                case "failed":  echo "<div class='alert alert-danger'>User Not Added</div>";
                                      break;
                                        
                            }
                       }
                ?>
                
                <form action="u_newrecord.php" method="post">
                    <div class="mb-3">
                        <label for="new_username" class="form-label">Username</label>
                        <input type="text" id="new_username" required name="username" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Password</label>
                        <input type="password" required id="new_password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="new_fullname" class="form-label">Fullname</label>
                        <input type="text" required id="new_fullname" name="fullname" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" required id="new_address" name="address" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="contac_number" class="form-label">Contact Number</label>
                        <input type="number" required id="new_contact_number" name="contact_number" class="form-control">
                    </div>
                    <input type="submit" class="btn btn-primary">
                </form>
                
            </div>
            <div class="col-8">
               <h3>Update Record</h3>
                <?php
                    $userlist = query($conn, "select user_id, username, password, fullname, address, contact_number from users where user_status='A'");
                 // var_dump($userlist);
                    echo "<hr>";
                        if(isset($_GET['update_status'])){
                            switch($_GET['update_status']){
                                case "success": echo "<div class='alert alert-success'>User Updated.</div>";
                                      break;
                                case "failed":  echo "<div class='alert alert-danger'>User Failed to be updated.</div>";
                                      break;
                                        
                            }
                        }

                        echo "<table class='table table-bordered'>";
                        echo "<thead>";
                            echo "<th>Username</th>";
                            echo "<th>Password</th>";
                            echo "<th>Fullname</th>";
                            echo "<th>address</th>";
                            echo "<th>contact Number</th>";
                            echo "<th>Action</th>";
                        echo "</thead>";
                    foreach($userlist as $key => $row){
                        echo "<tr>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['password'] . "</td>";
                            echo "<td>" . $row['fullname'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['contact_number'] . "</td>";
                            
                            echo "<td> <a class='btn btn-success' href='u_submit_user.php?password=" . $row['password'] . "&fullname=" .$row['fullname'] . "&username=" . $row['username']. "&user_id=". $row['user_id'] . "&address=". $row['address'] . "&contact_number=" . $row['contact_number'] . "' > Update </a> </td>";
                            echo "<td> <a class='btn btn-danger' href='u_delete_user.php?user_id=". $row['user_id'] ." ' > Delete </a> </td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                
                ?>
                
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</body>
<script src="js/bootstrap.js"></script>
</html>