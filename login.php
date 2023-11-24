<?php

if(!empty($_POST['email']) && !empty($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = array();
    $con = mysqli_connect("localhost", "root", "", "user_login_register");

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    if($con){
        $sql = "select * from users where email = '".$email."'";
        $res = mysqli_query($con, $sql);
        if(mysqli_num_rows($res) != 0){
            $row = mysqli_fetch_assoc($res);
            if($name == $row['name'] && password_verify($password, $row['password'])){
                try{
                    $apiKey = bin2hex(random_bytes(23));
                }
                catch(Exception $e){
                    $apiKey = bin2hex(uniqid($name, true));
                }
                $sqlUpdate = "update users set apiKey = '".$apiKey."' where email = '".$email."'";
                if(mysqli_query($con, $sqlUpdate)){
                    $result = array("status"=>"success", "message"=>"Login Successful", "name"=>$row['name'], "email"=>['email'], "apiKey"=>$row['apiKey']);
                } else $result = array("status"=>"failed", "message"=>"Login failed try again");
            } else $result = array("status"=>"failed", "message"=>"Retry with correct name and password");
        } else $result = array("status"=>"failed", "message"=>"Database connection Failed");
    } else $result = array("status"=>"failed", "message"=>"All fields are required");
}

echo json_encode($result, JSON_PRETTY_PRINT);
