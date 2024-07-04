<?php
if (isset($_POST['submit'])) {
    $connection = mysqli_connect("localhost", "root", "", "admission");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $hobbies = isset($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : '';

    $stmt = $connection->prepare("INSERT INTO stud (name, age, address, gender, hobbies) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $name, $age, $address, $gender, $hobbies);

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
    <title>Add Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card-header">
                    <h1 class="mtable">Student Admission Details</h1>
                </div>
                <div class="card-body">
                    <form action="add.php" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label>Age</label>
                            <input type="text" name="age" class="form-control" placeholder="Enter Age" required>
                        </div>
                        <div class="form-group my-3">
                            <label>District</label>
                            <select name="address" class="form-control" required>
                                <option value="">Select your District</option>
                                <option value="chennai">Chennai</option>
                                <option value="tenkasi">Tenkasi</option>
                                <option value="coimbatore">Coimbatore</option>
                                <option value="selam">Selam</option>
                                <option value="madhurai">Madhurai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <div class="form-check">
                                <input type="radio" name="gender" value="Male" class="form-check-input" required> Male
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gender" value="Female" class="form-check-input" required> Female
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gender" value="Others" class="form-check-input" required> Others
                            </div>
                        </div>
                        <div class="form-group my-3">
                            <label>Hobbies</label><br>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" value="Reading Books" class="form-check-input"> Reading Books
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" value="Drawing" class="form-check-input"> Drawing
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" value="Photography" class="form-check-input"> Photography
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" value="Writing" class="form-check-input"> Writing
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" value="Dance" class="form-check-input"> Dance
                            </div>
                        </div>
                        <br/>
                        <center>
                            <input type="submit" class="btn btn-primary" name="submit" value="Register">
                        </center>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>
</html>
