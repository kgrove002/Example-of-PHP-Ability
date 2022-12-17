<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <title>Lee's Landscape Customer Portal</title>
  </head>
  <body>
    <header>
      <p class="header">Lee's Landscape</p>
      <p class="header">Customer Portal</p>
      <nav class="main-nav">
        <ul>
          <li><a href="addInvoice.php"><button>Add Invoice</button></a></li>
          <li><a href="addCustomer.php"><button>Add Customer</button></a></li>
          <li>
            <a href="getCustomers.php"><button>View Customers</button></a>
          </li>
          
          <li>
            <a href="getInvoice.php"><button>View Invoice</button></a>
          </li>
          <li>
            <a href="sendBill.php"><button>Pay Invoice</button></a>
          </li>
          <li><button onclick="logout()">Logout</button></li>
        </ul>
      </nav>
    </header>

    <h2>Please enter the Invoice the customer wishes to pay.</h2>

    <div class="card-body search">
      <div class="row">
        <div class="col-md-7">
          <form action="" method="post">
            <div class="input-group mb-3">
              <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Enter the Invoice ID."
              />
              <button type="submit" class="btn btn-primary">Search</button>
            </div>
          </form>
        </div>
      </div>
    </div>

<?php
   

    function getRecord($check, $run, $table_text, $query_text)
    {        
        if($check > 0) {
            while ($row = mysqli_fetch_assoc($run)) {
                ?>
                <tr>                   
                <td><?=$table_text?>:</td>
                <td><input name ="<?=$query_text?>" type="hidden" value="<?=$row[$query_text]?>"><?=$row[$query_text]?></td>
            </tr>
            <?php
            }
           }      
       }   
?>

    <form class="submit-form" action="mailHandler.php" method="post">
        <?php
        include_once 'includes/dbh.inc.php';

        if(isset($_POST['search']))
            {
            $value = $_POST['search'];
            $validURL = "sendBill.php";
            $id_query = "SELECT invoice_ID FROM `billing` WHERE invoice_ID = '$value' ";
            $id_query_run = mysqli_query($conn, $id_query);
            $id_query_check = mysqli_num_rows($id_query_run);

            $custid_query = "SELECT customer_id FROM `billing` WHERE invoice_ID = '$value' ";
            $custid_query_run = mysqli_query($conn, $custid_query);
            $custid_query_check = mysqli_num_rows($custid_query_run);

            $title_query = "SELECT c.customer_title FROM customer c JOIN billing b ON c.customer_ID = b.customer_ID WHERE b.invoice_ID = '$value' ";
            $title_query_run = mysqli_query($conn, $title_query);
            $title_query_check = mysqli_num_rows($title_query_run);

            $name_query = "SELECT customer_L_Name FROM `billing` WHERE invoice_ID = '$value' ";
            $name_query_run = mysqli_query($conn, $name_query);
            $name_query_check = mysqli_num_rows($name_query_run);

            $service_query = "SELECT service FROM `billing` WHERE invoice_ID = '$value' ";
            $service_query_run = mysqli_query($conn, $service_query);
            $service_query_check = mysqli_num_rows($service_query_run);

            $mail_query = "SELECT c.customer_Email FROM customer c JOIN billing b ON c.customer_ID = b.customer_ID WHERE b.invoice_ID = '$value' ";
            $mail_query_run = mysqli_query($conn, $mail_query);
            $mail_query_check = mysqli_num_rows($mail_query_run);

            $bill_query = "SELECT customer_bill FROM `billing` WHERE invoice_ID = '$value' ";
            $bill_query_run = mysqli_query($conn, $bill_query);
            $bill_query_check = mysqli_num_rows($bill_query_run);

            $paid_query = "SELECT amt_paid FROM `billing` WHERE invoice_ID = '$value' ";
            $paid_query_run = mysqli_query($conn, $paid_query);
            $paid_query_check = mysqli_num_rows($paid_query_run);

            }

            if(!isset($id_query_check) or $id_query_check < 1 ){
                echo'<h3>No Invoice Found!</h3>';
            } else {

        ?>
        <table class="form">
        <?php
             getRecord($id_query_check, $id_query_run,'Invoice ID','invoice_ID');
             getRecord($custid_query_check, $custid_query_run,'Customer ID','customer_id');
             getRecord($title_query_check, $title_query_run,'Prefix','customer_title');
             getRecord($name_query_check, $name_query_run,'Last Name','customer_L_Name');
             getRecord($service_query_check, $service_query_run,'Service Provided','service');
             getRecord($mail_query_check, $mail_query_run,'Customer Email','customer_Email');
             getRecord($bill_query_check, $bill_query_run,'Amount Due','customer_bill');
             getRecord($paid_query_check, $paid_query_run,'Amount Paid','amt_paid');             
        ?>

        <tr>
          <td><label for="payment">Payment:</label></td>
          <td>
            <input class="pay-input" type="text" name="payment" placeholder="0.00" required />
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <button type="submit" onclick="" class="btn btn-primary">Submit</button>
          </td>
        </tr>
        </table>
    </form>
        <?php 
         
        }
            if(isset($_POST['payment'])) {
            
            $payment = $_POST['payment'];
                     
            $mail_query = "SELECT customer_bill - $payment < 0 as math FROM `billing` WHERE invoice_ID = $value ";
            $mail_query_run = mysqli_query($conn, $mail_query);
            $mail_query_check = mysqli_num_rows($mail_query_run);

            if($mail_query_check > 0) {
                while ($row = mysqli_fetch_assoc($mail_query_run)) {
                    
                    if($row['math'] == '1') {
                        header("Location: thankYou.php");
                    } elseif ($row['math'] == '0') {
                        header("Location: sendBill.php");
                    } else {
                        header("Location: error.php");
                    }    
                }
               }      
            }
        ?>
        
    <script src="script.js"></script>
  </body>
</html>
