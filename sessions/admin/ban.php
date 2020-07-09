<?php

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
        <title>Products</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body id="body">

    <?php include('./parts/nav.php') ?>

        <div class="text-center mt-5">
            <h1>Ban users</h1>
        </div>
        

        <main class="container">
            
                <?php
                   $sql = "SELECT * FROM user";
                   $result = $conn->query($sql); // $conn from db_connect.php

                    if($result->num_rows> 0): // object oriented style
                        $rows = $result->fetch_all(MYSQLI_ASSOC); // fetches all result rows and specifies array type
                        foreach($rows as $row) {
                           
                            
                            echo ($row['status'] == 'banned' ? "<p><div>{$row['name']}</div> <div><a href='confirmban.php?id={$row['id']}' class='btn btn-kommerz'>unban</a></div></p>" : "<p><div>{$row['name']}</div> <div><a href='confirmban.php?id={$row['id']}' class='btn btn-danger'>ban</a></div></p>");
                            
                       }
                    endif;
                ?>

            </div>
        </main>


        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        </script>
    </body>
</html>
