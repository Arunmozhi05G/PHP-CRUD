<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Admission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
        <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card-header">
                     <h1 class="intab">Student Details</h1>
                </div>
                <div class="card-body">
                    <button class="btn btn-success"><a href="add.php" class="text-light">Add Details</a></button>
                    <br/>
                    <table class="table table-hover table-borderrd table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Address</th>
                                <th scope="col">Changes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $connection = mysqli_connect("localhost", "root", "", "admission");

                            if (!$connection) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            $sql = "SELECT * FROM stud";
                            $run = mysqli_query($connection, $sql);

                            if ($run) {
                                while ($row = mysqli_fetch_array($run)) {
                                    $id = $row['sno'];
                                    $name = $row['name'];
                                    $age = $row['age'];
                                    $address = $row['address'];
                                    echo "<tr>
                                        <td>{$id}</td>
                                        <td>{$name}</td>
                                        <td>{$age}</td>
                                        <td>{$address}</td>
                                        <td>
                                            <button class='btn btn-success'><a href='edit.php?edit={$id}' class='text-light'>Edit</a></button>
                                            <button class='btn btn-danger'><a href='delete.php?del={$id}' class='text-light'>Delete</a></button>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No records found</td></tr>";
                            }

                            mysqli_close($connection);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>
</html>
