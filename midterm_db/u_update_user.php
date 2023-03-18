<?php
include_once "conn_db.php";


if(isset($_POST['user_id'])){
    $table = "users";
    
    $p_user_id  = $_POST['user_id'];
    $p_username = $_POST['username'];
    $p_password = $_POST['password'];
    $p_fullname = $_POST['fullname'];
    $p_address = $_POST['address'];
    $p_contact = $_POST['contact_number'];
    
    
    $fields = array( 'username' => $p_username
                   , 'password' => $p_password
                   , 'fullname' => $p_fullname 
                   , 'address' => $p_address
                   , 'contact_number' => $p_contact
                   );
    $filter = array( 'user_id' => $p_user_id );
    
   
   if( update($conn, $table, $fields, $filter )){
       header("location: u_user_display.php?update_status=success");
       exit();
   }
    else{
        header("location: u_user_display.php?update_status=failed");
        exit();
    }
 }
?>