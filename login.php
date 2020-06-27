<?php
    ob_start();
    session_start();
    require_once 'actions/db-connect.php';
    include "functions.php";

    if (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
        header("Location: index.php");
    }

    $error = false;
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // sanitize input to prevent sql injection
        function sanitize($string) {
            // strip whitespace, tab characters etc. from the beginning and the end of the string
            $string = trim($string);
            // convert applicable characters to html entities
            $string = escape($string);
            return $string;
        }
        $email = sanitize($email);
        $password = sanitize($password);

        // check if input is valid
        if (empty($email)) {
            $error = true;
            $emailError = "Please enter your email address.";
        } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $emailError = "Please enter a valid email address.";
        }
        if (empty($password)) {
            $error = true;
            $passwordError = "Please enter your password.";
        }

        // compare input with database entries
        if (! $error) {
            $sql = "select * from `user` where `email` = '{$email}'";
            $result = $conn->query($sql);
            function check_credentials($result, $password) {
                // count accounts that match the given email adress
                switch ($result->num_rows) {
                    case 0:
                        global $errorMessage;
                        $errorMessage = "Incorrect email adress.";
                        break;
                    case 1:
                        $row = $result->fetch_assoc();
                        // check password
                        if (password_verify($password, $row['password'])) {
                            set_session($row);
                        } else {
                            global $errorMessage;
                            $errorMessage = "Incorrect password.";
                        }
                        break;
                    case 2:// (admin and user)
                        $matches = false;
                        while ($row = $result->fetch_assoc()) {
                            // check password
                            if (password_verify($password, $row['password'])) {
                                $matches = true;
                                set_session($row);
                            }
                        }
                        if (! $matches) {
                            global $errorMessage;
                            $errorMessage = "Incorrect password.";
                        }
                        break;
                }
            }
            function set_session($array) {
                // regenerate the session id for security
                // session_regenerate_id();
                if ($array['role'] == 'user') {
                    if ($array['status'] != 'banned') {
                        // if it's the first login-session for the user
                        if (empty($array['cart'])) {
                            $_SESSION['user'] = $array['id'];
                            $_SESSION['cart'] = array('products' => [], 'total_items' => 0);
                        } 
                        // if there was a previous login-session
                        else {
                            // restore the cart
                            $_SESSION['cart'] = json_decode($array['cart'], true); // converts the json object to an associative array
                        }
                        header("Location: index.php");
                    } else {
                        global $errorMessage;
                        $errorMessage = "You've been banned!";
                    }
                } else {
                    $_SESSION['admin'] = $array['id'];
                    header("Location: dashboard.php");
                }
            }
            check_credentials($result, $password);
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

            <!-- hero -->
            <div class="jumbotron my-5">
                <h1>Live to spend!</h1>
                <p class="lead">Please sign up and log in to take part in this exlusive shopping experience!</p>
                <a class="btn btn-lg btn-dark" href="sign_up.php">Sign Up!</a>
            </div>
    
            <!-- login -->
            <h3>Log In</h3>
            <form action="login.php#loginForm" method="post" id="loginForm" autocomplete="off">
                <div class="row">
                    <div class="col-sm-8 col-md-6 col-lg-4">
                        <label for="email" class="mb-0">Email Adress</label>
<?php 
    if (isset($emailError)) {
        echo '
                        <div class="text-danger">' .$emailError. '</div>
        ';
    } 
?>
                        <input type="email" name="email" class="form-control mb-2" id="email" 
<?php 
    if (isset($email)) {
        echo '
                        value="' .$email. '"
        ';
    } 
?>                              
                        >
                        <label for="password" class="mb-0">Password</label>
<?php 
    if (isset($passwordError)) {
        echo '
                        <div class="text-danger">' .$passwordError. '</div>
        ';
    } 
?>
                        <input type="password" name="password" id="password" class="form-control mb-2">
                        <button type="submit" name="login" class="btn btn-md mt-2 btn-dark">Log In</button>
                    </div>
                </div>
            </form>
<?php 
    if (isset($errorMessage)) {
        echo '
            <div class="mt-2 text-danger">' .$errorMessage. '</div>
        ';
    } 
?>
        </div>
    </main>

    <!-- footer -->
    <?php include 'parts/footer.php'; ?>
</body>
</html>

<?php ob_end_flush(); ?>