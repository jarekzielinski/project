<?php
session_start();
if (isset($_POST['name'])) {
    $isOk = true;
    $name = $_POST['name'];
    if (strlen($name) < 3 || strlen($name) > 20) {
        $isOk = false;
        $_SESSION['e_name'] = "Name field must contain between 3 and 20 characters";
    } elseif (!ctype_alnum($name)) {
        $isOk = false;
        $_SESSION['e_name'] = "The name must consist of letters or numbers (without Polish characters)";
    }

    $email = $_POST['email'];
    $emailb = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($emailb, FILTER_VALIDATE_EMAIL) || $emailb != $email) {
        $isOk = false;
        $_SESSION['e_email'] = "Invalid e-mail address";
    }

    $password=$_POST['password'];
    $password2=$_POST['password2'];
    if(strlen($password)<3||strlen($password)>20){
        $isOk=false;
        $_SESSION['e_password']="Password must contain between 8 and 20 characters";
    }
    elseif($password!=$password2){
        $isOk=false;
        $_SESSION['e_password']="The passwords are not identical";
    }

    if (!isset($_POST['regulation'])) {
        $isOk = false;
        $_SESSION['e_regulation'] = "Accept the terms and conditions";
    }

}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>

<body>
    <h1>Create a free account</h1>
    <form action="registration.php" method="post">
        <p>
            Name:
            <input type="text" name="name" id="">
            <?php
            if (isset($_SESSION['e_name'])) {
                echo '<div style="color:red">' . $_SESSION['e_name'] . '</div>';
                unset($_SESSION['e_name']);
            }
            ?>
        </p>
        <p>
            Email:
            <input type="email" name="email" id="">
            <?php
            if (isset($_SESSION['e_email'])) {
                echo '<div style="color:red">' . $_SESSION['e_email'] . '</div>';
                unset($_SESSION['e_email']);
            }
            ?>
        </p>
        <p>
            Password:
            <input type="password" name="password">
            <?php
            if (isset($_SESSION['e_password'])) {
                echo '<div style="color:red">' . $_SESSION['e_password'] . '</div>';
                unset($_SESSION['e_password']);
            }
            ?>
        </p>

        <p>
            Retype Password:
            <input type="password" name="password2">
        </p>
        <?php
            if (isset($_SESSION['e_password'])) {
                echo '<div style="color:red">' . $_SESSION['e_password'] . '</div>';
                unset($_SESSION['e_password']);
            }
            ?>
        <p>
            <input type="checkbox" name="regulation" id="">
            I accept the terms and conditions
            <?php
            if (isset($_SESSION['e_regulation'])) {
                echo '<div style="color:red">' . $_SESSION['e_regulation'] . '</div>';
                unset($_SESSION['e_regulation']);
            }
            ?>
        </p>
        <input type="submit" value="Register">
    </form>
</body>

</html>