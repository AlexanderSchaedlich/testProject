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

if (isset($_GET['id'])):
    $product_id = $_GET['id'];

    $user_id = $_SESSION['user'];

$sql = "SELECT `id_review`, `title`, `text_area`, `stars` FROM review 
        INNER JOIN user ON review.fk_user = user.id
        INNER JOIN product ON review.fk_product = product.`id`
        WHERE user.`id` = {$user_id} and product.`id` = {$product_id};";
 
    
    $result = $conn->query($sql); // result of sql query
 
    $data = $result->fetch_assoc(); // fetches the first result as associative array
 
    $conn->close(); // closes the connection to database from db_connect.php


    if (isset($_SESSION['review_id'])):
        unset($_SESSION['review_id']);
      endif;
  
      if ($result->num_rows > 0):
        $_SESSION['review_id'] = $data['id_review'];
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
    <h2 class="mt-3"><?php echo ($result->num_rows> 0 ? "Update Your Review" : "Write Your Review"); ?></h2>

<form action="actions/a_create_update_review.php" method="post"><!--  this form submits the values via POST method to a_create.php -->


    <div class="form-group row">
        <label for="stars" class="col-sm-2 col-form-label">Stars:</label>
        <div class="col-sm-10">
            <select class="form-control" name="stars" id="stars" required>
                <option disabled selected value="">-- choose a rating --</option>
                <option>5</option>
                <option>4</option>
                <option>3</option>
                <option>2</option>
                <option>1</option>
            </select>
        </div>
      </div>

    <div class="form-group row">
        <label for="review_title" class="col-sm-2 col-form-label">Title:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="review_title" id="review_title" value="<?php echo ($result->num_rows> 0 ? $data['title'] : '' ) ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="review_text" class="col-sm-2 col-form-label">Your Opinion:</label>
        <div class="col-sm-10">
            <textarea type="text" class="form-control" name="review_text" id="review_text"><?php echo ($result->num_rows> 0 ? $data['text_area'] : '' ) ?></textarea>
        </div>
    </div>


    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
      <div class="form-group row mt-5 mt-md-0">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-kommerz">submit review</button>
          <a href='./details.php?id=<?php echo $product_id; ?>' class='btn btn-secondary'>back to product</a>
        </div>
      </div>
</form>

</div>






        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        </script>
    </body>
</html>

<?php endif; ?>
