<?php
session_start();

if (isset($_POST['login']))
{
    // Database connection
    $hostname = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "ozel";

    // Create a new database connection
    $conn = new mysqli($hostname, $username, $password, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the username and password from the form submission
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Query the database to check if the credentials are valid
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    // Check if a user was found
    if (mysqli_num_rows($result) > 0) {
        // User is authenticated, start a session and redirect to home.php
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id']; // Store user ID in session
        $_SESSION['username'] = $user['username']; // Store username in session
        $_SESSION['user_level'] = $user['user_level']; // Store user level in session
        header("Location: home.php"); // Redirect to users.php
        exit();
    } else {
        // Invalid credentials, display an error message
        echo 'Invalid username or password.';
    }

    // Close the database connection
    mysqli_close($conn);
}

?>

<?php

if (isset($_POST['register']))
{
    // Database connection
    $hostname = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "ozel";

    // Create a new database connection
    $conn = new mysqli($hostname, $username, $password, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the username and password from the form submission
    $name = $_POST['regFname'];
    $username = $_POST['regUname'];
    $password = $_POST['regPassword'];


    // Query the database to check if the credentials are valid
    $query = "INSERT INTO users (name, username, password, user_level) VALUES ('$name', '$username','$password',2)";
    $result = mysqli_query($conn, $query);

    // Check if the insertion was successful
    if ($result) {
        echo 'Registration successful! You can now log in.';
    } else {
        // Display the error message and the SQL query for debugging purposes
        echo 'Registration failed. Please try again.<br>';
        echo 'Error: ' . mysqli_error($conn) . '<br>';
        echo 'SQL Query: ' . $query;
    }

    // Close the database connection
    mysqli_close($conn);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="layout/redo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300&display=swap" rel="stylesheet">
    <title>Login Page</title>
</head>
<body>
    <div class="body-container">
    <div class="container" id="container">
        <div>
        <div class="form-container sign-up-container">
            <form action="#login.php" method="post">
                <h1>Create Account</h1>
                <input name="regFname" type="text" placeholder="Full Name" />
                <input name="regUname" type="text" placeholder="Username" />
                <input name="regPassword" type="password" placeholder="Password" />
                <input type="submit" class="btn-grad" value="Register" name="register">
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="#login.php" method="post">
                <h1>Sign In</h1>
                <input name="username" type="text" placeholder="Username" />
                <input name="password" type="password" placeholder="Password" />
                
                    <input type="submit" class="btn-grad" value="Login" name="login">
            </form>
        </div>
        </div>

        <div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>
                        Already have an account?
                    </p>
                    <div class="btn-grad" id="signIn">Login</div>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello!</h1>
                    <p>Time for a new account</p>
                    <p>Let's welcome you into Ozel Chempaka's Inventory System!</p>
                    <div class="btn-grad" id="signUp">Register</div>
                </div>
            </div>
        </div>
        </div>
    </div>

    </div>
    <script>
        
        const signUpBtn = document.getElementById('signUp');
        const signInBtn = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpBtn.addEventListener('click', () => {
            container.classList.add('right-panel-active');
        });

        signInBtn.addEventListener('click', () => {
            container.classList.remove('right-panel-active');
        });

    </script>
</body>
</html>