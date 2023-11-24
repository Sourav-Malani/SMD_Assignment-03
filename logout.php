<?php

if(!empty($_POST['email']) && !empty($_POST['apiKey'])){
    $email = $_POST['email'];
    $apiKey = $_POST['apiKey'];
    $conn = mysqli_connect("localhost", "root", "", "user_login_register");
    if($con){
        $sql = "select * from users where name = '".$name."' and apiKey = '".$apiKey."'";
        $res = mysqli_query($con, $sql);
        if(mysqli_num_rows($res) != 0){
            $res = mysqli_query($con, $sql);
            $sqlUpdate = "update users set apiKey = '' where name = '".$name."'";
            if(mysql_query($con, $sqlUpdate)){
                echo "success";
            } else echo "Logout Failed";
        } else echo "Unauthorized To Access"; 
    } else echo "Database connection Failed";
} else echo "All fields are required";