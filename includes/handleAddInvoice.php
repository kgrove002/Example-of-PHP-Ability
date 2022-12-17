<?php

include_once 'dbh.inc.php';

$LName = isset($_POST['LName']) ? $_POST['LName'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : '';
$service = isset($_POST['service']) ? $_POST['service'] : '';
$bill = isset($_POST['bill']) ? $_POST['bill'] : '';


$addInvoice = "INSERT INTO billing (invoice_ID, customer_ID, customer_L_Name, service, customer_bill, amt_paid, bill_date, date_paid) VALUES (NULL, '$id', '$LName', '$service', '$bill', DEFAULT, CURDATE(), NULL)";
$addInvoice_run = mysqli_query($conn, $addInvoice);

if($addInvoice_run)
{
    header("Location: ../addInvoice.php?record=success");

}
else
{
    header("Location: ../addInvoice.php?record=fail");


}
?>