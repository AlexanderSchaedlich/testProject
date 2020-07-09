<?php

ob_start();
session_start();
require_once 'actions/db-connect.php';

if ( !isset($_SESSION['admin']) ):
    header('Location: index.php');
    die;
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

    <body>
    <?php include('./parts/navbar.php') ?>
    <div class="text-center mt-5">
        <h1>Admin Dashboard</h1>
        <p>
            <a href="crudprod.php" class="btn btn-kommerz">
            create, update, edit and delete products
            </a>
        </p>

        <p>
            <a href="createuser.php" class="btn btn-kommerz">
                Create new accounts for users and administrators
            </a>
        </p>
        <p>
            <a href="ban.php" class="btn btn-kommerz">
                Ban users!
            </a>
        </p>
    </div>

 


        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        </script>
    </body>
</html>
