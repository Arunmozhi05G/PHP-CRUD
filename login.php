<?php
if (isset($_POST['submit'])) {
    $connection = mysqli_connect("localhost", "root", "", "admission");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Correct the query and bind parameter types
    $stmt = $connection->prepare("INSERT INTO login (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        echo '<script> location.replace("insert.php")</script>';
    } else {
        echo "Something went wrong: " . $stmt->error;
    }

    $stmt->close();
    mysqli_close($connection);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                    <form name="loginForm" method="post">
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
                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>
</html>
