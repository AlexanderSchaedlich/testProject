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
   

   // insert a new row into media table
   $sql = "INSERT INTO product (category, name, img, processor_frequency, processor_type, display_resolution, display_technology, camera_main, camera_front, ram, internal_memory, sim_card, sim_slot, available_amount, price, discount, visible)
           VALUES ('$category', '$name', '$image', '$processor_frequency', '$processor_type', '$display_resolution', '$display_technology', '$camera_main', '$camera_front', '$ram', '$internal_memory', '$sim_card', '$sim_slot', '$available_amount', '$price', '$discount', '$visible')";
    if($conn->query($sql) === TRUE): // mysqli_query returns true for successful INSERT queries. ?>

    <!DOCTYPE html>
    <html lang="de" dir="ltr">
        <head>
            <meta charset="utf-8">
            <title>New record created</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
            <link rel="stylesheet" href="../css/style.css">
        </head>

        <body id="body">
        <?php include('../parts/nav.php') ?>
        <div class="container">
            <h2 class='h5 mt-5'>Product successfully created</h2>
            <a href='../createproduct.php' class='btn btn-kommerz'>back</a>
            <a href='../crudprod.php' class='btn btn-kommerz'>products</a>
        </div>


    <?php
    else:
       echo "<div>";
       echo "Error " . $sql . ' ' . "<br>Unsuccessful query connect error no. " . $conn->connect_errno;
       echo "</div>";
    endif;

   $conn->close();
endif;

?>
