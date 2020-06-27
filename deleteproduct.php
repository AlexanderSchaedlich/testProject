<?php

session_start();
require_once 'actions/db-connect.php';

if ( !isset($_SESSION['admin']) ):
    header('Location: index.php');
    die;
endif;


// if there is GET parameter id in URL
if ($_GET['id']) {
   $id = $_GET['id'];

   $sql = "SELECT * FROM product WHERE id = {$id}" ;
   $result = $conn->query($sql); // result of sql query
   $data = $result->fetch_assoc(); // fetches one result as associative array

   $conn->close(); // closes the connection to database from db_connect.php
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

        <?php include('parts/nav.php'); ?>


<div class="container">

<h2 class="h5 mt-3">Do you really want to delete this Product?</h2>
<form action ="actions/a_delete.php" method="post"><!--  this form submits the values via POST method to a_delete.php -->

   <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />
   <div class="button-group">
       <button type="submit" class="btn btn-danger">Yes, delete it!</button >
       <a href="crudprod.php" class="btn btn-secondary">No, go back!</a>
   </div>
</form>

</body>
</html>

<?php
}
?>
