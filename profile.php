<?php

if(!empty($_POST['email']) && !empty($_POST['apiKey'])){
    $email = $_POST['email'];
    $apiKey = $_POST['apiKey'];
    $result = array();
    $con = mysqli_connect("localhost", "root", "", "user_login_register");
    if($con){
        $sql = "select * from users where email = '".$email."' and apiKey = '".$apiKey."'";
        $res = mysqli_query($con, $sql);
        if(mysqli_num_rows($res) != 0){
            $row mysqli_fetch_assoc($res);
            $result = array("status" => "success", "message" => "Data fetched successfully",
                            "name" => $row['name'], "email" => $row['email'], "apiKey" =>['apiKey']);
        } else $result = array("status" => "failed", "message" => "Unauthorized Access");
    } else $result = array("status" => "failed", "message" => "Database connection failed")
} else $result = array("status" => "failed", "message" => "All fields are required");