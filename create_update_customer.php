<?php

session_start();
require_once 'actions/db-connect.php';

if ( !isset($_SESSION['user']) ):
    header('Location: index.php');
    die;
    /* Ban Check */
elseif (isset($_SESSION['user'])): 
  $query = "SELECT * from user where status='banned' and id={$_SESSION['user']}";
  $result = $conn->query($query);
  $count = $result->num_rows;
  if ($count != 0):
      header('Location: logout.php?logout');
  endif;
/* End Ban Check*/
endif;


  
   $id = $_SESSION['user'];

   $sql = "SELECT customer.`id` AS customer_id, `f_name`, `l_name`, `address`, `phone_number` FROM customer INNER JOIN user ON customer.fk_user = user.id WHERE user.id = {$id}";
   $result = $conn->query($sql); // result of sql query
   $data = $result->fetch_assoc(); // fetches the first result as associative array
   $conn->close(); // closes the connection to database from db_connect.php

    if (isset($_SESSION['customer_id'])):
      unset($_SESSION['customer_id']);
    endif;

    if ($result->num_rows > 0):
      $_SESSION['customer_id'] = $data['customer_id'];
    endif;

?>

<!DOCTYPE html>
<html lang="de" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body id="body">

    <?php include('./parts/nav.php') ?>


<div class="container">

    <h2 class="mt-3"><?php echo ($result->num_rows> 0 ? "Update Your Address:" : "Please Enter Your Address"); ?> </h2>

    <form action="actions/a_create_update_customer.php" method="post"><!--  this form submits the values via POST method to a_update.php -->
      <div class="form-group row">
        <label for="f_name" class="col-sm-2 col-form-label">First Name:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="f_name" id="f_name" value="<?php echo ($result->num_rows> 0 ? $data['f_name'] : '' ) ?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="l_name" class="col-sm-2 col-form-label">Last Name:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="l_name" id="l_name" value="<?php echo ($result->num_rows> 0 ? $data['l_name'] : '' ) ?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="address" class="col-sm-2 col-form-label">Shipping Address:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="address" id="address" value="<?php echo ($result->num_rows> 0 ? $data['address'] : '' ) ?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="phone_number" class="col-sm-2 col-form-label">Phone Number:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="phone_number" id="phone_number" value="<?php echo ($result->num_rows> 0 ? $data['phone_number'] : '' ) ?>">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-10 mt-5 mt-md-0">
          <button type="submit" class="btn btn-kommerz"><?php echo ($result->num_rows> 0 ? 'save changes' : 'save' ) ?></button>
          <a href='./userdashboard.php' class='btn btn-secondary'>back</a>
        </div>
      </div>
    </form>


</div>


        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        </script>
    </body>
</html>
