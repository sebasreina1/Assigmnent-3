<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './inc/header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2 id = 'home'>List of Users</h2>
        <a class="btn btn-primary" href="/DATABASE_JS/makeuser.php" role="button">New Client</a>
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Profile Image</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "DATABASE_JS";

                    $connection = new mysqli($servername, $username, $password, $database);
                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }
                    
                    $sql = "SELECT * FROM clients";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $connection->error);
                    }
                    
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>$row[id]</td>
                            <td>$row[name]</td>
                            <td>$row[email]</td>
                            <td>$row[phone]</td>
                            <td>$row[address]</td>
                            <td><img src='$row[profile_image]' alt='Profile Image' class='profile-img'></td>
                            <td>$row[created_at]</td>
                            <td>
                                <div class='btn-group'>
                                    <a class='btn btn-primary btn-sm' href='/DATABASE_JS/edit.php?id=$row[id]'>Edit</a>
                                    <a class='btn btn-danger btn-sm' href='/DATABASE_JS/delete.php?id=$row[id]'>Delete</a>
                                </div>
                            </td>
                        </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
                <?php include 'inc/footer.php'; ?>

        </div>
    </div>
</body>
</html>
