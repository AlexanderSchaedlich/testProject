<?php

session_start();
require_once 'actions/db-connect.php';

if ( !isset($_SESSION['admin']) ):
    header('Location: index.php');
    die;
endif;


// if there is GET parameter id in URL
if ($_GET['id']):
   $id = $_GET['id'];

   $sql = "SELECT * FROM product WHERE id={$id}" ;
   $result = $conn->query($sql); // result of sql query

   $data = $result->fetch_assoc(); // fetches the first result as associative array

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

    <?php include('./parts/nav.php') ?>


<div class="container">

    <h2 class="mt-3">Update Product:</h2>

    <form action="actions/a_update.php" method="post"><!--  this form submits the values via POST method to a_update.php -->
      <div class="form-group row">
        <label for="category" class="col-sm-2 col-form-label">Category:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="category" id="category" value="<?php echo $data['category']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="name" id="name" value="<?php echo $data['name']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="image" class="col-sm-2 col-form-label">Image:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="image" id="image" value="<?php echo $data['img']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="processor_frequency" class="col-sm-2 col-form-label">Processor Frequency:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="processor_frequency" id="processor_frequency" value="<?php echo $data['processor_frequency']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="processor_type" class="col-sm-2 col-form-label">Processor Type:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="processor_type" id="processor_type" value="<?php echo $data['processor_type']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="display_resolution" class="col-sm-2 col-form-label">Display Resolution:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="display_resolution" id="display_resolution" value="<?php echo $data['display_resolution']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="display_technology" class="col-sm-2 col-form-label">Display Technology:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="display_technology" id="display_technology" value="<?php echo $data['display_technology']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="camera_main" class="col-sm-2 col-form-label">Main Camera:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="camera_main" id="camera_main" value="<?php echo $data['camera_main']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="camera_front" class="col-sm-2 col-form-label">Front Camera:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="camera_front" id="camera_front" value="<?php echo $data['camera_front']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="ram" class="col-sm-2 col-form-label">RAM:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="ram" id="ram" value="<?php echo $data['ram']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="internal_memory" class="col-sm-2 col-form-label">Internal Memory:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="internal_memory" id="internal_memory" value="<?php echo $data['internal_memory']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="sim_card" class="col-sm-2 col-form-label">Sim Card:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="sim_card" id="sim_card" value="<?php echo $data['sim_card']; ?>">
        </div>
      </div>
       <div class="form-group row">
        <label for="sim_slot" class="col-sm-2 col-form-label">Sim Slot:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="sim_slot" id="sim_slot" value="<?php echo $data['sim_slot']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="available_amount" class="col-sm-2 col-form-label">Available units:</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" name="available_amount" id="available" value="<?php echo $data['available_amount']; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="price" class="col-sm-2 col-form-label">Price:</label>
        <div class="col-sm-10">
          <input type="number" step="any" class="form-control" name="price" id="price" value="<?php echo $data['price']; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="discount" class="col-sm-2 col-form-label">Discount (% off):</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" name="discount" id="discount" value="<?php echo $data['discount']; ?>">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-2">Visible:</div>
          <div class="col-sm-10">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="visible" id="visible" value="true" <?php echo ($data['visible'] == 1 ? 'checked' : ''); ?>>
            </div>
          </div>
      </div>




      <input type="hidden" name="id" value="<?php echo $data['id']?>" />
      <div class="form-group row">
        <div class="col-sm-10 mt-5 mt-md-0">
          <button type="submit" class="btn btn-kommerz">save changes</button>
          <a href='./crudprod.php' class='btn btn-secondary'>back</a>
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

<?php
endif;
?>
