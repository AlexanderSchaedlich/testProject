<?php
    ob_start();
    session_start();
    require_once(__DIR__ . "/../../services/database_connection.php");
    include(__DIR__ . "/../../services/main.php");

    if (isset($_SESSION["user"]) || isset($_SESSION["admin"])) {
        header("Location: index.php");
    }

    $error = false;
    if (isset($_POST["sign_up"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // sanitize input to prevent sql injection
        function sanitize($string) {
            // strip whitespace, tab characters etc. from the beginning and the end of the string
            $string = trim($string);
            // convert applicable characters to html entities
            $string = escape($string);
            return $string;
        }
        $name = sanitize($name);
        $email = sanitize($email);
        $password = sanitize($password);

        // check if input is valid
        if (empty($name)) {
            $error = true;
            $nameError = "Please enter your full name.";
        } elseif (strlen($name) < 3) {
            $error = true;
            $nameError = "Name must have at least 3 characters.";
        }
        if (empty($email)) {
            $error = true;
            $emailError = "Please enter your email adress.";
        } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $emailError = "Please enter a valid email address.";
        } else {
            $sql = "select `email` from `user` where `email` = '$email'";
            $result = $connection->query($sql);
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
        if (! $error) {
            $sql = "insert into `user` (name, email, password) values ('{$name}', '{$email}', '{$password}')";
            $run = $connection->query($sql);
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
    <!-- head tags -->
    <?php include(__DIR__ . "/../../view/head.php") ?>
</head>
<body class="d-flex flex-column justify-content-between min-vh-100">
    <!-- navbar -->
    <?php include(__DIR__ . "/../../view/navbar.php") ?>

    <!-- content -->
    <main>
        <div class="container">
            <h3 class="mt-5">Sign Up</h3>
<?php 
    if (isset($message)) {
        echo '
            <div class="alert alert-' . $messageColor . '">' . $message . '</div>
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
                        <div class="text-danger">' . $nameError . '</div>
        ';
    }
?>
                        <input type="text" name="name" id="name" class="form-control mb-2" maxlength="50" 
<?php 
    if (isset($name)) {
        echo '
                        value="' . $name . '"
        ';
    }
?>
                        >
                        <label for="email" class="mb-0">Email</label>
<?php 
    if (isset($emailError)) {
        echo '
                        <div class="text-danger">' . $emailError . '</div>
        ';
    }
?>
                        <input type="email" name="email" id="email" class="form-control mb-2" maxlength="60" 
<?php 
    if (isset($email)) {
        echo '
                        value="' . $email . '"
        ';
    }
?>
                        >
                        <label for="password" class="mb-0">Password</label>
<?php 
    if (isset($passwordError)) {
        echo '
                        <div class="text-danger">' . $passwordError . '</div>
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
    <?php include(__DIR__ . "/../../view/footer.php") ?>
</body>
</html>

<?php ob_end_flush() ?>