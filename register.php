<?<php

if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])){

    $con = mysqli_connect("localhost", "root", "", "user_register_login");
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if($con){
    $sql = "insert into users( name, email, password) values ('".$name."', '".$email."', '".$password."')";
    if(mysqli_query($con, $sql)){
        echo "Success";
    }
    else echo "Registration Failed";
}
else echo "Database connection failed!";

}
else echo "All fields are required!";