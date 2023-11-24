<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senderId = $_POST['sender_id'];
    $receiverId = $_POST['receiver_id'];
    $message = $_POST['message'];
    
    // Handle file upload
    $file_path = 'http://localhost/phpmyadmin/index.php?route=/table/structure&db=user_login_register&table=users';

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploads_dir = 'uploads/';
        $tmp_name = $_FILES['file']['tmp_name'];
        $file_name = basename($_FILES['file']['name']);
        move_uploaded_file($tmp_name, "$uploads_dir/$file_name");
        $file_path = "$uploads_dir/$file_name";
    }

    $sql = "INSERT INTO messages (sender_id, receiver_id, message, file_path) VALUES ('$senderId', '$receiverId', '$message', '$file_path')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
