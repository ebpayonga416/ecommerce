<?php
include_once "conn_db.php";

if(isset($_POST['username'])){
    $n_username=$_POST['username'];
    $n_password=$_POST['password'];
    $n_fullname=$_POST['fullname'];
    $p_address = $_POST['address'];
    $p_contact = $_POST['contact_number'];
    
    $table = "users";
    $fields = array('username' => $n_username
                   , 'password' => $n_password
                   , 'fullname' => $n_fullname 
                   , 'address' => $p_address
                   , 'contact_number' => $p_contact
                   );
    
    if(insert($conn, $table, $fields) ){
        header("location: u_user_display.php?new_record=added");
        exit();
    }  
    else{
        header("location: u_user_display.php?new_record=failed");
        exit();
    }
}
?>