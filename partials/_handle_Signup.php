
 <?php
$showError = "false";
$signupSucc = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';
    $user_email = $_POST['signup-email'];
    $pass = $_POST['signup-pass'];
    $cpass = $_POST['signup-cpass'];

    // Check whether this email exists
    $existSql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);

    if ($numRows > 0) {
        $showError = "Email already in use";
    }
    if($numRows==1){
            // Continue with the registration process
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $showAlert = true;
                
                // Check if a file is uploaded
                if (isset($_FILES['user-img'])) {
                    // Get file details and insert into the database
                    $data = file_get_contents($_FILES['user-img']['tmp_name']);

                    // Insert image data into the database
                    $stmt = $conn->prepare("INSERT INTO `users` (`user-img`) VALUES (?)");
                    $stmt->bind_param("b", $data);
                    $uploadedImage = $stmt->execute();

                    if (!$uploadedImage) {
                        // Handle insertion failure
                        echo "Error inserting image: " . $stmt->error;
                    }

                    $stmt->close();
                    header("Location: /social-dairy/explore.php?signupsuccess=true");
                } 
                if(!isset($_FILES['user-img'])) {
                    // Use the default image if no file is uploaded
                    $defaultImage = 'imgs/default.jpg';
                    $data = file_get_contents($defaultImage);

                    // Insert default image data into the database
                    $stmt = $conn->prepare("INSERT INTO `users` (`user-img`) VALUES (?)");
                    $stmt->bind_param("b", $data);
                    $uploadedImage = $stmt->execute();

                    if (!$uploadedImage) {
                        // Handle insertion failure
                        echo "Error inserting default image: " . $stmt->error;
                    }

                    $stmt->close();
                    header("Location: /social-dairy/explore.php?signupsuccess=true");
                }

                header("Location: /social-dairy/login.php?signupsuccess=true&error=$showError");
                exit(); // Always exit after a header redirect
            } else {
                echo "Error: " . mysqli_error($conn);
                header("Location: /social-dairy/login.php?signupsuccess=false&error=$showError");
                exit(); // Always exit after a header redirect
            }
        }

    if (empty($user_email)) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Please enter a valid Email Id and upload a valid image.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        header("Location: /social-dairy/login.php?signupsuccess=false&error=$showError");
        exit(); // Always exit after a header redirect
    } elseif ($pass != $cpass || empty($pass)) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Passwords do not match or are empty.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        header("Location: /social-dairy/login.php?signupsuccess=false&error=$showError");
        exit(); // Always exit after a header redirect
    }
}
?>


