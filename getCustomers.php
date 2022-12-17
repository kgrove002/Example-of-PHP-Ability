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
      <p class="header">Customer Management Portal</p>
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

    <h2>Please enter the customer you are looking for.</h2>

    <div class="card-body search">
        <div class="row">
            <div class="col-md-7">

                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Search data by First/Last, Name Address, or Phone number!">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>Customer First Name</th>
                            <th>Customer Last Name</th>
                            <th>Customer Address</th>
                            <th>City, State, Zip</th>
                            <th>Customer Phone Number</th>
                            <th>Customer Email</th>
                            <th>Amount Owed</th>
                        </tr>                                 
                        <?php 
                                    include_once 'includes/dbh.inc.php';
                                    
                                    if(isset($_POST['search']))
                                    {
                                        $filtervalues = $_POST['search'];
                                        $query = "SELECT customer_ID, customer_F_Name, customer_L_Name, street_Address, city_State_Zip, customer_Phone, customer_Email, (SELECT SUM(customer_bill) FROM billing WHERE customer_ID = c.customer_ID) AS total
                                        FROM customer as c WHERE CONCAT(customer_F_Name,customer_L_Name,street_Address,customer_Phone) LIKE '%$filtervalues%' ";
                                        $query_run = mysqli_query($conn, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $items['customer_ID']; ?></td>
                                                    <td><?= $items['customer_F_Name']; ?></td>
                                                    <td><?= $items['customer_L_Name']; ?></td>
                                                    <td><?= $items['street_Address']; ?></td>
                                                    <td><?= $items['city_State_Zip']; ?></td>
                                                    <td><?= $items['customer_Phone']; ?></td>
                                                    <td><?= $items['customer_Email']; ?></td>
                                                    <td><?= $items['total']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="4">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?> 
                    </thead>
                    <tbody>
            </div>
        </div>
    </div>
<script src="script.js"></script>
  </body>
</html>
