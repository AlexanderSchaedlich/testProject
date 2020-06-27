<?php 
  ob_start();
  session_start();

var_dump($_POST);
  $error = false;
  if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $topic = $_POST['topic'];
    $message = "Email from: {$name} {$email}\r\n\r\n" . $_POST['message'];
    if (empty($name)) {
      $error = true;
      $nameError = "Please enter a name.";
    }
    if (empty($email)) {
      $error = true;
      $emailError = "Please enter an email adress.";
    }
    if (empty($topic)) {
      $error = true;
      $topicError = "Please enter a topic.";
    }
    if (empty($message)) {
      $error = true;
      $messageError = "Please enter a message.";
    }
    if (!$error){
      $recipient = "weareteamcoffee@gmail.com";
      $from = "From: Contact Form";
      mail($recipient, $topic, $message, $from);
      $success = 'Sent successfully!';
    }
  }
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
  <!-- navbar -->
  <?php include 'parts/navbar.php'; ?>

  <!-- content -->
  <main>
    <div class="container">

      <!-- contact -->
      <section>
        <h3 class="text-center pt-5 pb-3">Contact Us</h3>
        <p class="text-center text-success"><?php echo isset($success) ? $success : '' ; ?></p>
        <p class="text-center text-success"><?php echo isset($sendError) ? $sendError : '' ; ?></p>
        <p class="pb-3 text-center">Please check <a href="faq.php">Frequently Asked Questions</a> before sending a message here.</p>

        <!-- form -->
        <div class="row">
          <div class="col-md-8 col-lg-6 offset-md-2 offset-lg-3">
            <div class="p-3 bg-dark text-white text-center rounded-lg">
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="msgForm">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" id="name">
                  <span class="text-danger"><?php echo isset($nameError) ? $nameError : '' ; ?></span>
                </div>
                <div class="form-group">
                  <label for="newTopic">Email</label>
                  <input type="email" name="email" class="form-control" id="email">
                  <span class="text-danger"><?php echo isset($emailError) ? $emailError : '' ; ?></span>
                </div>
                <div class="form-group">
                  <label for="newTopic">Topic</label>
                  <input type="text" name="topic" class="form-control" id="newTopic">
                  <span class="text-danger"><?php echo isset($topicError) ? $topicError : '' ; ?></span>
                </div>
                <label for="newMessage">Message</label>
                <textarea name="message" class="form-control" id="newMessage" style="height: 150px;"></textarea>
                <button type="submit" class="btn btn-primary mt-3">Send</button>
              </form>
          </div>
        </div>
      </section>
      <br>
      
      <!-- location -->
      <section>
        <h3 class="text-center my-5">Our Location</h3>

        <!-- map -->
        <div id="map"></div>
      </section>
      <br>
  </main>

  <!-- footer -->
  <?php include 'parts/footer.php'; ?>

  <!-- google api -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtjaD-saUZQ47PbxigOg25cvuO6_SuX3M&callback=initMap"
  async defer></script>
  <script>
    var map;
    function initMap() {
      var ourLocation = {
        lat: 48.209478,
        lng: 16.369461
      };
      map = new google.maps.Map(document.getElementById('map'), {
        center: ourLocation,
        zoom: 18
      });
      var pinpoint = new google.maps.Marker({
        position: ourLocation,
        map: map
      });
    }
  </script>
</body>
</html>

<?php ob_end_flush(); ?>