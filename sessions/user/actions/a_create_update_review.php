<?php

session_start();
require_once 'db-connect.php';

if ( !isset($_SESSION['user']) ):
    header('Location: index.php');
    die;
endif;

if ($_POST):
   $title = $_POST['review_title'];
   $text_area = $_POST['review_text'];
   $stars = $_POST['stars'];

   $product_id = $_POST['product_id'];

    if (isset($_SESSION['review_id'])):
        $sql = "UPDATE review SET title = '$title', text_area = '$text_area', stars = '$stars' WHERE id_review = {$_SESSION['review_id']}";
    else:
        $sql = "INSERT INTO review (fk_user, fk_product, title, text_area, stars) VALUES ('{$_SESSION['user']}', '$product_id', '$title', '$text_area', '$stars')";
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
            <h2 class='h5 mt-5'><?php echo ( isset($_SESSION['review_id']) ? "You've Successfully updated your review" : "You've Successfully submitted your review"); ?></h2>
            <a href='../create_update_review.php?id=<?php echo $product_id; ?>' class='btn btn-secondary'>back to review</a>
       </div>

   <?php
   else:
        echo "Error while updating record : ". $conn->error;
   endif;

   $conn->close();

endif;

?>
