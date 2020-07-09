<?php

session_start();
require_once 'db-connect.php';

if ( !isset($_SESSION['admin']) ):
    header('Location: index.php');
    die;
endif;

if (isset($_GET['id'])) {
   $id = $_GET['id'];

   $sql = "DELETE FROM review WHERE id_review = {$id}";
    if($conn->query($sql) === TRUE) { // mysqli_query returns true for successful DELETE queries. ?>

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
                <h2 class='h5 mt-5'>Successfully deleted!</h2>
                <a href='../dashboard.php' class='btn btn-kommerz'>dashboard</a>
<?php
   } else {
       echo "Error updating record : " . $conn->error;
   }

   $conn->close();
}

?>
