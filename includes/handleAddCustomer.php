<?php

include_once 'dbh.inc.php';

$FName = isset($_POST['FName']) ? $_POST['FName'] : '';
$LName = isset($_POST['LName']) ? $_POST['LName'] : '';
$title = isset($_POST['title']) ? $_POST['title'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';
$phoneNumber = isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

$addCustomer = "INSERT INTO customer (customer_ID, customer_L_Name, customer_F_Name, customer_title, street_Address, city_State_Zip, customer_Phone, customer_Email) VALUES (NULL, '$LName', '$FName', '$title', '$address', '$city', '$phoneNumber', '$email')";
$addCustomer_run = mysqli_query($conn, $addCustomer);

if($addCustomer_run)
{
    header("Location: ../addCustomer.php?record=success");

}
else
{
    header("Location: ../addCustomer.php?record=fail");

}
?>