<?php

include_once 'includes/dbh.inc.php';
include_once 'includes/thankYou.php';
include_once 'includes/billMail.php';

 $payment = isset($_POST['payment']) ? $_POST['payment'] : '';
 $id = isset($_POST['invoice_ID']) ? $_POST['invoice_ID'] : ''; 

 $mail_query = "SELECT customer_bill - $payment <= 0 as math FROM `billing` WHERE invoice_ID = $id ";
 $mail_query_run = mysqli_query($conn, $mail_query);
 $mail_query_check = mysqli_num_rows($mail_query_run); 
 $customer_payment = isset($_POST['payment']) ? $_POST['payment'] : '';

 $updateTable = "UPDATE billing SET customer_bill = customer_bill - $customer_payment, date_paid = CURDATE(), amt_paid = amt_paid + $customer_payment WHERE invoice_ID = $id";
 $updateTable_run = mysqli_query($conn, $updateTable);

 function sendMail($check, $run, $query_text)
    {        
        if($check > 0) {
            while ($row = mysqli_fetch_assoc($run)) {
                $mailTo = isset($_POST['customer_Email']) ? $_POST['customer_Email'] : '';
                $mailName = isset($_POST['customer_L_Name']) ? $_POST['customer_L_Name'] : '';
                $mailTitle = isset($_POST['customer_title']) ? $_POST['customer_title'] : '';
                $customer_payment = isset($_POST['payment']) ? $_POST['payment'] : '';
                $customer_bill = isset($_POST['customer_bill']) ? $_POST['customer_bill'] : '';

                if($row[$query_text] == '1') {
                    sendThankYou($mailTo, $mailTitle, $mailName);
                } elseif ($row[$query_text] == '0') {
                    sendBill($mailTo, $mailTitle, $mailName, $customer_payment, $customer_bill - $customer_payment );
                    
                } else {
                    header("Location: error.php");
                }
            }
           } else {
            echo 'Error';
           }      
       }    

sendMail($mail_query_check, $mail_query_run, 'math');

?>