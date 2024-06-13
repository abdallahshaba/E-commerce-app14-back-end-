<?php

include "../connect.php";

$username = filterRequest("username");
$password = filterRequest("password");
$email = filterRequest("email");
$phone = filterRequest("phone");
$verifycode = "0";


$stmt = $con->prepare("SELECT * FROM users WHERE users_email =? OR users_phone=?");
$stmt -> execute(array($email , $phone));
$count = $stmt ->rowCount();

if($count > 0){
    printFailur(
        message: "Email Or Password Exist"
    );
}
else {
    $data = array(
        "users_name" => $username,
        "users_email" => $email,
        "users_phone" => $phone,
        "users_verfiycode" => $verifycode,
        "users_password" => $password,
    );
    insertData("users" , $data);
}