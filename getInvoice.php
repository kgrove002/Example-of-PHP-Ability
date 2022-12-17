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

    <h2>Please enter the invoice you are looking for.</h2>

    <div class="card-body search">
        <div class="row">
            <div class="col-md-7">

                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Search data by Last Name or Customer ID!">
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
                            <th>Invoice ID</th>
                            <th>Customer ID</th>
                            <th>Customer Last Name</th>
                            <th>Service</th>
                            <th>Customer Bill</th>
                            <th>Amount Paid</th>
                            <th>Bill Date</th>
                            <th>Date Paid</th>
                        </tr>
                                 
                        <?php 
                                    include_once 'includes/dbh.inc.php';

                                    if(isset($_POST['search']))
                                    {
                                        $filtervalues = $_POST['search'];
                                        $query = "SELECT * FROM billing WHERE CONCAT(customer_L_Name, customer_ID) LIKE '%$filtervalues%' ";
                                        $query_run = mysqli_query($conn, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $items['invoice_ID']; ?></td>
                                                    <td><?= $items['customer_ID']; ?></td>
                                                    <td><?= $items['customer_L_Name']; ?></td>
                                                    <td><?= $items['service']; ?></td>
                                                    <td><?= $items['customer_bill']; ?></td>
                                                    <td><?= $items['amt_paid']; ?></td>
                                                    <td><?= $items['bill_date']; ?></td>
                                                    <td><?= $items['date_paid']; ?></td>
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
