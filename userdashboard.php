<?php
ob_start();
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
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Smartphones</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script
    src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/4d20ff7212.js" crossorigin="anonymous"></script>
</head>

    <body>
    <?php include('./parts/navbar.php') ?>


    <div class="text-center mt-5">
        <h1>User Dashboard</h1>

    <form action ="create_update_customer.php" method="post">
        <div class="form-group">
            <button type="submit" class="btn btn-primary">manage your address</button>
        </div>
    </form>





        <hr class="mt-5">
        <p>Danger Zone:</p>
        <p>
            <a href="deleteaccount.php" class="btn btn-danger">
                delete your account
            </a>
        </p>
    </div>

 
<footer>
    <div class="text-center bg-dark p-3 fixed-bottom">
        <a href="index.php" class="text-white-50" style="text-decoration: none;">&copy; Copyright Coffee 2020</a>
    </div>
</footer>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        </script>
    </body>
</html>
