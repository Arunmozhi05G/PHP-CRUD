<?php
include_once 'session.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $res = mysqli_query($connection, "SELECT * FROM login WHERE email = '$email'");
    $row = mysqli_fetch_assoc($res);

    if (mysqli_num_rows($res) > 0) {
        if ($password == $row["password"]) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("location: insert.php");
        } else {
            echo "<script> alert('Wrong password');</script>";
        }
    } else {
        echo "<script> alert('User not registered');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            var email = document.forms["loginForm"]["email"].value;
            var password = document.forms["loginForm"]["password"].value;
            if (email == "" || password == "") {
                alert("Both email and password must be filled out");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div class="container my-5">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card-header">
                <h1 class="intab">Login</h1>
            </div>
            <div class="card-body">
                <form name="loginForm" method="post" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email ID" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <br/>
                    <center>
                        <input type="submit" class="btn btn-primary" name="submit" value="Login">
                    </center>
                    <a href="register.php">Register Your ID</a>
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
</body>
</html>
