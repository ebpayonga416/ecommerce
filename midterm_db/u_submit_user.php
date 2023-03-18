<?php

if(isset($_GET['user_id'])){
    $user_id  = $_GET['user_id'];
    $password = $_GET['password'];
    $fullname = $_GET['fullname'];
    $username = $_GET['username'];
    $address = $_GET['address'];
    $contact_number = $_GET['contact_number'];
    }

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>submit user</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form action="u_update_user.php" method="POST">
                    <div class="mb-3">
                       <label for="">User</label>
                        <input type="text" hidden name="user_id" value="<?php echo $user_id; ?>" class="form-control">
                        <input type="text" name="username" value="<?php echo $username; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                       <label for="">Password</label>
                        <input type="password" name="password" value="<?php echo $password; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                       <label for="">Fullname</label>
                        <input type="text" name="fullname" value="<?php echo $fullname; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" value="<?php echo $address; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="contac_number" class="form-label">Contact Number</label>
                        <input type="text" name="contact_number" value="<?php echo $contact_number; ?>" class="form-control">
                    </div>
                    <input type="submit" class="btn btn-primary">
                </form>
                
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>
<script src="js/bootstrap.js"></script>
</html>