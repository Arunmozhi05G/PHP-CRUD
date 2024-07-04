<?php
$connection = mysqli_connect("localhost", "root", "", "admission");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$edit = $_GET['edit'];

$sql = "SELECT * FROM stud WHERE sno = '$edit'";
$run = mysqli_query($connection, $sql);

if (!$run) {
    die("Query failed: " . mysqli_error($connection));
}

while ($row = mysqli_fetch_array($run)) {
    $id = $row['sno'];
    $name = $row['name'];
    $age = $row['age'];
    $address = $row['address'];
}
?>

<?php
$connection = mysqli_connect("localhost", "root", "", "admission");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) 
{
    $edit = $_GET['edit'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];

    $sql = "UPDATE stud SET name = '$name', age = '$age', address = '$address' WHERE sno = '$edit'";

    if (mysqli_query($connection, $sql)) {
        echo '<script> location.replace("insert.php")</script>';
    } else {
        echo "Something went wrong: " . mysqli_error($connection);
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
        <div class="col-md-3"></div>
            <div class="col-md-5">
                <div class="card-header text-center">
                    <h1 class="intab">Student Details Changes</h1>
                </div>
                <div class="card-body">
                    <form action="add.php?edit=<?php echo $id;?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?php echo isset($name) ? $name : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label>Age</label>
                            <input type="text" name="age" class="form-control" placeholder="Enter Age" value="<?php echo isset($age) ? $age : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter Address" value="<?php echo isset($address) ? $address : ''; ?>">
                        </div>
                        <br/>
                        <center>
                        <input type="submit" class="btn btn-primary" name="submit" value="Edit"></center>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>
</html>
