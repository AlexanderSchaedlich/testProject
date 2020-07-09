<?php

session_start();
require_once 'db-connect.php';

if ( !isset($_SESSION['user']) ):
    header('Location: index.php');
    die;
endif;

if ($_POST):
   $f_name = $_POST['f_name'];
   $l_name = $_POST['l_name'];
   $address = $_POST['address'];
   $phone_number = $_POST['phone_number'];

    if (isset($_SESSION['customer_id'])):
        $sql = "UPDATE customer SET f_name = \"$f_name\", l_name = '$l_name', address = '$address', phone_number = '$phone_number' WHERE id = {$_SESSION['customer_id']}";
    else:
        $sql = "INSERT INTO customer (fk_user, f_name, l_name, address, phone_number) VALUES ('{$_SESSION['user']}', '$f_name', '$l_name', '$address', '$phone_number')";
    endif;
    
   if($conn->query($sql) === TRUE): // mysqli_query returns true for successful UPDATE queries. ?>

   <!DOCTYPE html>
   <html lang="de" dir="ltr">
       <head>
           <meta charset="utf-8">
           <title></title>
           <meta name="viewport" content="width=device-width, initial-scale=1">
           <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
           <link rel="stylesheet" href="../css/style.css">
       </head>

       <body id="body">
       <?php include('../parts/nav.php') ?>
       <div class="container">
            <h2 class='h5 mt-5'><?php echo ( isset($_SESSION['customer_id']) ? "You've Successfully updated your address" : "You've Successfully saved your address"); ?></h2>
            <a href='../userdashboard.php' class='btn btn-kommerz'>Your Account</a>
       </div>

   <?php
   else:
        echo "Error while updating record : ". $conn->error;
   endif;

   $conn->close();

endif;

?>
