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

<h2 class="h5 mt-3">Do you really want to permanently delete your account?</h2>
<form action ="actions/a_deleteaccount.php" method="post"><!--  this form submits the values via POST method to a_delete.php -->

   <div class="button-group">
       <button type="submit" class="btn btn-danger">Yes, delete it!</button >
       <a href="userdashboard.php" class="btn btn-secondary">No, go back!</a>
   </div>
</form>

</body>
</html>
