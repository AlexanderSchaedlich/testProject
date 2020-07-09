<?php

session_start();
require_once 'db-connect.php';

if ( !isset($_SESSION['admin']) ):
    header('Location: index.php');
    die;
endif;

if ($_POST):
    $category = $_POST['category'];
    $name = $_POST['name'];
    $image = $_POST['image'];
    $processor_frequency = $_POST['processor_frequency'];
    $processor_type = $_POST['processor_type'];
    $display_resolution = $_POST['display_resolution'];
    $display_technology = $_POST['display_technology'];
    $camera_main = $_POST['camera_main'];
    $camera_front = $_POST['camera_front'];
    $ram = $_POST['ram'];
    $internal_memory = $_POST['internal_memory'];
    $sim_card = $_POST['sim_card'];
    $sim_slot = $_POST['sim_slot'];
    $available_amount = $_POST['available_amount'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    // Discount auf Zahl 0 setzten wenn Feld nicht ausgefüllt wird
    $discount = empty($discount) ? 0 : $_POST['discount'];

    // visible tinyint auf 1 setzen wenn checkbox markiert
    if (!empty($_POST['visible'])) {
        $visible = 1;
    } else {
        $visible = 0;
    }

   $id = $_POST['id'];
   // Update the Row that matches the $id variable from hidden form input in updateproduct.php
   $sql = "UPDATE product SET category = '$category', name = '$name', img = '$image', processor_frequency = '$processor_frequency', processor_type = '$processor_type', display_resolution = '$display_resolution', display_technology = '$display_technology', camera_main = '$camera_main', camera_front = '$camera_front', ram = '$ram', internal_memory = '$internal_memory', sim_card = '$sim_card', sim_slot = '$sim_slot', available_amount = '$available_amount', price = '$price', discount = '$discount', visible = '$visible' WHERE id = {$id}";

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
           <h2 class='h5 mt-5'>Product Successfully Updated</h2>
          <?php echo "<a href='../updateproduct.php?id={$id}' class='btn btn-kommerz'>back</a>" ?>
          <a href='../crudprod.php' class='btn btn-kommerz'>products</a>
       </div>

   <?php
   else:
        echo "Error while updating record : ". $conn->error;
   endif;

   $conn->close();

endif;

?>
