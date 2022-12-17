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

    <h2>Please enter the new customer's information.</h2>
<form class="submit-form" action="includes/handleAddCustomer.php" method="post">
    <table class="form">
        <tr>
            <td>Customer's First Name</td>
            <td><input name="FName" placeholder="John"></td>
        </tr>
        <tr>
            <td>Customer's Last Name</td>
            <td><input name="LName" placeholder="Doe"></td>
        </tr>
        <tr>
            <td>Customer's Title</td>
            <td><input name="title" placeholder="Mr"></td>
        </tr>
        <tr>
            <td>Customer's Street Address</td>
            <td><input name="address" placeholder="123 Street LN"></td>
        </tr>
        <tr>
            <td>Customer's City/State/Zip</td>
            <td><input name="city" placeholder="Somewhere VA 12345"></td>
        </tr>
        <tr>
            <td>Customer's Phone Number</td>
            <td><input name="phoneNumber" placeholder="1234567890"></td>
        </tr>
        <tr>
            <td>Customer's Email</td>
            <td><input name="email" placeholder="someone@email.com"></td>
        </tr>
        <tr>
            <td colspan="2">
            <button type="submit" onclick="" class="btn btn-primary">Submit</button>
            </td>
        </tr>
    </table>
</form>

    
    <script src="script.js"></script>
  </body>
</html>
