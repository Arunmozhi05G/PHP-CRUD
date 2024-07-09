<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit();
}

$connection = mysqli_connect("localhost", "root", "", "admission");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM stud";
$res = mysqli_query($connection, $query);

if (!$res) {
    die("Query failed: " . mysqli_error($connection));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container my-5">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card-header">
                <h1 class="intab">Student List</h1>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Hobbies</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($res)): ?>
                        <tr>
                            <td><?php echo $row['sno']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['age']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['hobbies']; ?></td>
                            <td>
                                <a href="edit.php?edit=<?php echo $row['sno']; ?>" class="btn btn-success">Edit</a>
                                <a href="delete.php?del=<?php echo $row['sno']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <a href="add.php" class="btn btn-primary">Add New Student</a>
                <a href="login.php" class="btn btn-danger">Log Out</a>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
</body>
</html>
