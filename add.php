<?php
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, "admission");

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $address = $_POST['address'];
    
        $sql = "INSERT INTO stud(name, age, address) VALUES('$name', '$age', '$address')";

        if (mysqli_query($connection, $sql)) {
            echo '<script> location.replace("insert.php")</script>';
        } else {
            echo "Something went wrong: " . $connection->error;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card-header">
                    <h1>Student Admission</h1>
                </div>
                <div class="card-body">
                    <form action="add.php" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label>Age</label>
                            <input type="text" name="age" class="form-control" placeholder="Enter Age">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter Address">
                        </div>
                        <br/>
                        <input type="submit" class="btn btn-primary" name="submit" value="Register">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
