<?php
$connection = mysqli_connect("localhost", "root", "", "admission");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$edit_id = $_GET['edit'];

$sql = "SELECT * FROM stud WHERE sno = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $edit_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $row = $result->fetch_assoc();
    $id = $row['sno'];
    $name = $row['name'];
    $age = $row['age'];
    $address = $row['address'];
    $gender = $row['gender'];
    $hobbies = explode(", ", $row['hobbies']);
} else {
    die("Query failed: " . $stmt->error);
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $hobbies = isset($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : '';

    $update_sql = "UPDATE stud SET name = ?, age = ?, address = ?, gender = ?, hobbies = ? WHERE sno = ?";
    $update_stmt = $connection->prepare($update_sql);
    $update_stmt->bind_param("sisssi", $name, $age, $address, $gender, $hobbies, $edit_id);

    if ($update_stmt->execute()) {
        echo '<script> location.replace("insert.php")</script>';
    } else {
        echo "Something went wrong: " . $update_stmt->error;
    }

    $update_stmt->close();
}

$stmt->close();
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card-header text-center">
                    <h1 class="intab">Edit Student Details</h1>
                </div>
                <div class="card-body">
                    <form action="edit.php?edit=<?php echo $id;?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?php echo htmlspecialchars($name); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Age</label>
                            <input type="text" name="age" class="form-control" placeholder="Enter Age" value="<?php echo htmlspecialchars($age); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>District</label>
                            <select name="address" class="form-control" required>
                                <option value="">Select your District</option>
                                <option value="chennai" <?php if($address == "chennai"){ echo "selected"; } ?>>Chennai</option>
                                <option value="tenkasi" <?php if($address == "tenkasi"){ echo "selected"; } ?>>Tenkasi</option>
                                <option value="coimbatore" <?php if($address == "coimbatore"){ echo "selected"; } ?>>Coimbatore</option>
                                <option value="selam" <?php if($address == "selam"){ echo "selected"; } ?>>Selam</option>
                                <option value="madhurai" <?php if($address == "madhurai"){ echo "selected"; } ?>>Madhurai</option>
                            </select>
                        </div>
                        <div class="form-group my-3">
                            <label>Gender</label>
                            <div class="form-check">
                                <input type="radio" name="gender" value="Male" class="form-check-input" <?php if($gender == "Male"){ echo "checked";} ?>> Male
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gender" value="Female" class="form-check-input" <?php if($gender == "Female"){ echo "checked";} ?>> Female
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gender" value="Others" class="form-check-input" <?php if($gender == "Others"){ echo "checked";} ?>> Others
                            </div>
                        </div>
                        <div class="form-group my-3">
                            <label>Hobbies</label><br>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" value="Reading Books" class="form-check-input" <?php if(in_array("Reading Books", $hobbies)){ echo "checked"; } ?>> Reading Books
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" value="Writing" class="form-check-input" <?php if(in_array("Writing", $hobbies)){ echo "checked"; } ?>> Writing
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" value="Dance" class="form-check-input" <?php if(in_array("Dance", $hobbies)){ echo "checked"; } ?>> Dance
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" value="Photography" class="form-check-input" <?php if(in_array("Photography", $hobbies)){ echo "checked"; } ?>> Photography
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" value="Drawing" class="form-check-input" <?php if(in_array("Drawing", $hobbies)){ echo "checked"; } ?>> Drawing
                            </div>
                        </div>
                        <br/>
                        <center>
                            <input type="submit" class="btn btn-primary" name="submit" value="Edit">
                        </center>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>
</html>
