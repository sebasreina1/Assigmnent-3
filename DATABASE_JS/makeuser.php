<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make User</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-box">
                <h2>New Client</h2>
                <?php
                $errorMessage = "";
                $successMessage = "";

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $phone = $_POST["phone"];
                    $address = $_POST["address"];
                    $profileImage = $_FILES["profile_image"];

                    do {
                        // Check for empty fields
                        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
                            $errorMessage = "All fields are required, including the profile image.";
                            break;
                        }

                        // Validate image file type
                        // $allowedTypes = ['img/jpeg', 'img/png', 'img/jpg'];
                        //if (!in_array($profileImage['type'], $allowedTypes)) {
                         //   $errorMessage = "Only JPG and PNG images are allowed.";
                        //    break;
                        //}

                        // Handle file upload
                        $targetDir = "uploads";
                        if (!file_exists($targetDir)) {
                           mkdir($targetDir, 0777, true);
                        }
                       // $targetFile = $targetDir . basename($profileImage["name"]);
                      //  if (!move_uploaded_file($profileImage["tmp_name"], $targetFile)) {
                       //     $errorMessage = "Failed to upload image.";
                       //     break;
                       // }

                        // Database connection
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "DATABASE_JS";
                        $connection = new mysqli($servername, $username, $password, $database);
                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }

                        // Insert data into database
                        $sql = "INSERT INTO clients (name, email, phone, address, profile_image) VALUES ('$name', '$email', '$phone', '$address', '$targetFile')";
                        $result = $connection->query($sql);
                        if (!$result) {
                            $errorMessage = "Invalid query: " . $connection->error;
                            break;
                        }

                        // Clear form data
                        $name = "";
                        $email = "";
                        $phone = "";
                        $address = "";
                        $profileImage = "";
                        $successMessage = "Client added successfully.";

                        // Redirect to index page
                        header("Location: index.php");
                        exit;
                    } while (false);
                }
                ?>

                <!-- Error Message Display -->
                <?php if (!empty($errorMessage)): ?>
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong><?php echo $errorMessage; ?></strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                <?php endif; ?>
                
                <?php 
                $targetDir = "uploads";
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }

                $targetFile = $targetDir . basename($_FILES["profile_image"]["name"]);
                if ($_FILES["profile_image"]["size"] > 2000000) { // 2MB file size limit
                    $errorMessage = "File is too large.";
                } elseif (!move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {
                     $errorMessage = "Failed to upload image.";
                } else {
                    $successMessage = "Image uploaded successfully.";
                }
                ?>

                <!-- Success Message Display -->
                <?php if (!empty($successMessage)): ?>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong><?php echo $successMessage; ?></strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                <?php endif; ?>

                <!-- Form -->
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="profile_image">Profile Image (JPG, PNG)</label>
                        <input type="file" id="profile_image" name="profile_image" class="form-control" accept="image/jpeg, image/png" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="index.php" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include 'inc/footer.php'; ?>
</body>
</html>
