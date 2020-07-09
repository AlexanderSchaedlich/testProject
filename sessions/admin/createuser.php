<?php

session_start();
require_once 'actions/db-connect.php';

if ( !isset($_SESSION['admin']) ):
    header('Location: index.php');
    die;
endif;

$error = false;
if (isset($_POST['btn-signup'])):

    // sanitize user input to prevent sql injection
    $name = trim($_POST['name']); //trim - strips whitespace (or other characters) from the beginning and end of a string
    $name = strip_tags($name); // strip_tags — strips HTML and PHP tags from a string
    $name = htmlspecialchars($name); // htmlspecialchars converts special characters to HTML entities

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    if (empty($_POST['userrole'])) {
      $userrole = "user";
  } else {
      $userrole = "admin";
  }

    // basic name validation
    if (empty($name)):
        $error = true;
        $nameError = "Please enter the new users name.";
    elseif (strlen($name) < 3):
        $error = true;
        $nameError = "Name must have at least 3 characters.";
    elseif (!preg_match("/^[a-zA-Z ]+$/",$name)): // irgendwelche regex
        $error = true;
        $nameError = "Name can contain only letters and whitespace";
    endif;

    //basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)):
        $error = true;
        $emailError = "Please enter a valid email address.";
    else:
        // check whether the email exists or not
        $query = "SELECT email FROM user WHERE email = '$email'";
        $result = $conn->query($query); //ergebnis der sql query $conn in db-connect.php definiert. Objektorientierte Schreibweise.
        $count = $result->num_rows;
        if ($count != 0):
            $error = true;
            $emailError = "Provided Email is already in use.";
        endif;
    endif;

    // password validation
    if (empty($pass)):
        $error = true;
        $passError = "Please enter a password!";
    elseif (strlen($pass) < 6):
        $error = true;
        $passError = "Password must be at least 6 characters long";
    endif;

    // password hashing for security. Prework uses hash('sha256' , $pass) This is an newer method;
    $password = password_hash($pass, PASSWORD_DEFAULT);


    // if there's no error, continue to signup.
    if (!$error):
        $query = "INSERT INTO user (name, email, password, role)
                  VALUES ('$name', '$email', '$password', '$userrole')";
        $result = $conn->query($query); // Returns FALSE on failure. For successful SELECT, SHOW, DESCRIBE or EXPLAIN queries mysqli_query() will return a mysqli_result object. For other successful queries mysqli_query() will return TRUE.

        if ($result):
            $errType = "success";
            $errMSG = "User successfully created.";
            unset($name);
            unset($email);
            unset($pass);
            unset($userrole);
        else:
            $errType = "danger";
            $errMSG = "Something went wrong, try again later...";
        endif;
    endif;
endif;
?>

<!DOCTYPE html>
<html lang="de" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Super-Kommerz</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <?php include('./parts/nav.php') ?>
        <div class="container">
            <form class="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); // Angeblich um Cross Site Scripting zu verhindern ?>" method="post">
                <h2 class="mt-3">Create a new user</h2>

                <?php if (isset($errMSG)): ?>
                    <div class="alert alert-<?php echo $errType; ?>">
                        <?php echo $errMSG; ?>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <label for="name" class="mb-0">User name</label>
                        <input type="text" name="name" id="name" class="form-control" maxlength="50" value="<?php if (isset($name)): echo $name; endif; // damit der Wert bei einem Fehler nicht verloren geht ?>">
                        <?php if (isset($nameError)): echo "<div class='text-danger reg-error'>" . $nameError . "</div>"; endif; ?>
                        
                        <label for="email" class="mt-2 mb-0">User Email</label>
                        <input type="email" name="email" id="email" class="form-control" maxlength="40" value="<?php if (isset($email)): echo $email; endif; ?>">
                        <?php if (isset($emailError)): echo "<div class='text-danger reg-error'>" . $emailError . "</div>"; endif; ?>

                        <label for="pass" class="mt-2 mb-0">Password</label>
                        <input type="password" name="pass" id="pass" class="form-control" placeholder="At least 6 characters"  maxlength="15">
                        <?php if (isset($passError)): echo "<div class='text-danger reg-error'>" . $passError . "</div>"; endif; ?>

                        <div class="form-check mt-2">
                        <label for="userrole" class="mt-2 mb-0"><input class="form-check-input" type="checkbox" name="userrole" id="userrole" value="admin">Admin</label>
                        </div>
                       
                           


                        <button type="submit" class="btn btn-block mt-4 btn-kommerz" name="btn-signup">create user</button>
                    </div>
                </div>
                
            

               


            </form>
        </div>





        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
<?php ob_end_flush(); ?>
