<?php
require_once('includes/load.php'); // Ensure this file includes your database connection setup

if (isset($_POST['delete_user'])) {
    $req_fields = array('username', 'password');
    validate_fields($req_fields);

    if (empty($errors)) {
        $username = remove_junk($db->escape($_POST['username']));
        $password = remove_junk($db->escape($_POST['password']));

        // Check if the username and password match
        $check_query = "SELECT * FROM users WHERE username='{$username}' AND password='{$password}' LIMIT 1";
        $result = $db->query($check_query);

        if ($result->num_rows > 0) {
            $query = "DELETE FROM users WHERE username='{$username}' AND password='{$password}' LIMIT 1";
            if ($db->query($query)) {
                $session->msg('s', "{$username} has been deleted.");
                redirect('del_users.php', false);
            } else {
                $session->msg('d', "Sorry, failed to delete {$username}.");
                redirect('del_users.php', false);
            }
        } else {
            $session->msg('d', "Username and password do not match.");
            redirect('del_users.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('del_users.php', false);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sidebar.css">
    <title>Inventory Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    
    <style>
        .home {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logo {
            display: flex;
            flex-direction: row;
            align-items: center;
            width: 50px;
            height: 50px;
            background-color: #181919;
            border-radius: 50%;
            margin-right: 10px;
        }

        .icon {
            min-width: 30px;
            border-radius: 6px;
            height: 100%;
            font-size: 20px;
            color: #ffffff;
        }

        .container {
            display: flex;
            flex-direction: column;
            height: auto;
            width: 500px;
            overflow-y: auto;
            padding: 20px;
            border-radius: 25px;
            background-color: #3a3b3c;
            margin: 25px;
            color: #ffffff;
            align-items: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, select {
            width: 350px;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .msg {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            font-size: 16px;
        }

        .msg-s {
            background: #d4edda;
            color: #155724;
        }

        .msg-d {
            background: #f8d7da;
            color: #721c24;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,td {
            padding: 10px;
            text-align: center;
        }

        th {
            border-bottom: 2px solid #ffffff;
        }

        tr {
            border-bottom: 2px solid #ffffff;
        }

    </style>

</head>
<body class="dark">
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span><img src="layout/ozelLogo.jpg" alt="ozel chempaka logo" class="logo"></span>
                <div class="text logo-text">
                    <span class="name">OZEL CHEMPAKA</span>
                    <span class="profession">Inventory System</span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="home.php"><i class='bx bx-home-alt icon'></i>
                        <span class="text nav-text">Dashboard</span></a>
                    </li>
                    <li class="nav-link">
                        <a href="sales.php"><i class='bx bx-bar-chart-alt-2 icon'></i>
                        <span class="text nav-text">Sales</span></a>
                    </li>
                    
                    <li class="nav-link">
                        <a href="sales_report.php">
                            <i class='bx bxs-wallet-alt icon'></i>
                            <span class="text nav-text">Sales Report</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="users.php"><i class='bx bx-user-plus icon'></i>
                        <span class="text nav-text">Users</span></a>
                    </li>
                    <li>
                        <a href="products.php"><i class='bx bxs-package icon'></i>
                        <span class="text nav-text">Products</span></a>
                    </li>
                    <li>
                        <a href="about.html"><i class='bx bxs-info-circle icon'></i>
                        <span class="text nav-text">About Us</span></a>
                    </li>
                </ul>
            </div>
            <div class="bottom-content">
                <li><a href="logout.php"><i class='bx bx-log-out icon'></i><span class="text nav-text">Logout</span></a></li>
                <li class="mode">
                    <div class="sun-moon"><i class='bx bx-moon icon moon'></i><i class='bx bx-sun icon sun'></i></div>
                    <span class="mode-text text">Dark mode</span>
                    <div class="toggle-switch"><span class="switch"></span></div>
                </li>
            </div>
        </div>
    </nav>

    <section class="home">
        <div class="container">
            <div class="login-box">
                <?php echo display_msg($msg); ?>
                <form id="deleteUserForm" action="del_users.php" method="post">
                    <div class="user-box">
                        <br>
                        <label>Username</label>
                        <input type="text" name="username" required="">
                    </div>
                    <div class="user-box">
                        <label>Password</label>
                        <input type="password" name="password" required="">
                        <br><br>
                    </div>
                    <center>
                        <button type="submit" name="delete_user">CONFIRM</button>
                    </center>
                    <br>
                </form>
            </div>
        </div>

    <script>
        const body = document.querySelector('body'),
        sidebar = body.querySelector('nav'),
        toggle = body.querySelector(".toggle"),
        modeSwitch = body.querySelector(".toggle-switch"),
        modeText = body.querySelector(".mode-text");

        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });

        modeSwitch.addEventListener("click", () => {
            body.classList.toggle("dark");
            if (body.classList.contains("dark")) {
                modeText.innerText = "Light mode";
            } else {
                modeText.innerText = "Dark mode";
            }
        });
    </script>
</body>
</html>
