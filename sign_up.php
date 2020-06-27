<?php
    ob_start();
    session_start();
    require_once 'actions/db-connect.php';
    include "functions.php";

    if (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
        header("Location: index.php");
    }

    $error = false;
    if (isset($_POST['sign_up'])) {
        $name = $_POST['name'];
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
        if (empty($name)) {
            $error = true;
            $nameError = "Please enter your full name.";
        } elseif (strlen($name) < 3) {
            $error = true;
            $nameError = "Name must have at least 3 characters.";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/",$name)) {
            $error = true;
            $nameError = "Name must contain only letters and whitespace.";
        }
        if (empty($email)) {
            $error = true;
            $emailError = "Please enter your email adress.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $emailError = "Please enter a valid email address.";
        } else {
            $sql = "select `email` from `user` where `email` = '$email'";
            $result = $conn->query($sql);
            if ($result->num_rows != 0) {
                $error = true;
                $emailError = "Provided email is already in use.";
            }
        }
        if (empty($password)) {
            $error = true;
            $passwordError = "Please enter a password.";
        } elseif (strlen($password) < 6) {
            $error = true;
            $passwordError = "Password must be at least 6 characters long";
        }
        $password = password_hash($password, PASSWORD_DEFAULT);

        // create a database entry
        if (!$error) {
            $sql = "insert into `user` (name, email, password) values ('$name', '$email', '$password')";
            $run = $conn->query($sql);
            if ($run) {
                $message = "Signed up successfully, you may log in now.";
                $messageColor = "success";
                unset($name);
                unset($email);
                unset($password);
            } else {
                $message = "Something went wrong, try again later...";
                $messageColor = "danger";
            }
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
            <h3 class="mt-5">Sign Up</h3>
<?php 
    if (isset($message)) {
        echo '
            <div class="alert alert-' .$messageColor. '">' .$message. '</div>
        ';
    }
?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="row">
                    <div class="col-sm-8 col-md-6 col-lg-4">
                        <label for="name" class="mb-0">Name</label>
<?php 
    if (isset($nameError)) {
        echo '
                        <div class="text-danger">' .$nameError. '</div>
        ';
    }
?>
                        <input type="text" name="name" id="name" class="form-control mb-2" maxlength="50" 
<?php 
    if (isset($name)) {
        echo '
                        value="' .$name. '"
        ';
    }
?>
                        >
                        <label for="email" class="mb-0">Email</label>
<?php 
    if (isset($emailError)) {
        echo '
                        <div class="text-danger">' .$emailError. '</div>
        ';
    }
?>
                        <input type="email" name="email" id="email" class="form-control mb-2" maxlength="60" 
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
                        <input type="password" name="password" id="password" class="form-control mb-2" placeholder="At least 6 characters"  maxlength="20">
                        <button type="submit" name="sign_up" class="btn btn-md mt-2 btn-dark">Sign Up</button>
                    </div>
                </div>
                <br>
                <a href="login.php" class="text-dark">Log in here</a>
            </form>
        </div>
    </main>

    <!-- footer -->
    <?php include 'parts/footer.php'; ?>
</body>
</html>

<?php ob_end_flush(); ?>