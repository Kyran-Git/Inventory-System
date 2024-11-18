<?php
session_start(); // Start the session

// Redirect to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include your database connection file
require_once('includes/load.php');

// Get the user level and ID from the session
$user_level = $_SESSION['user_level'];
$current_user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
    <link rel="stylesheet" href="sidebar.css">
    <title>Inventory Dashboard</title>
    
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    

    <style>
        .icon {
            min-width: 30px;
            border-radius: 6px;
            height: 100%;
            font-size: 20px;
            color: #ffffff;
        }

        h2 {
            border-bottom: 5px solid #ffffff;
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

        .addButton {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #3a3b3c;
            border: none;
            color: #ffffff;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .home {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .page {
            display: flex;
            flex-direction: column;
            height: auto;
            width: auto;
            overflow-y: auto;
            padding: 20px;
            border-radius: 25px;
            background-color: #3a3b3c;
            margin: 25px;
            color: #ffffff;
            align-items: center;
        }

        .container {
            display: flex;
            flex-direction: column;
            height: auto;
            width: auto;
            overflow-y: auto;
            padding: 20px;
            border-radius: 25px;
            background-color: #3a3b3c;
            margin: 0px;
            color: #ffffff;
            align-items: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: #ffffff;
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

        .user-details {
            margin: 10px;
        }

        .user-actions {
            padding: 10px;
        }

        .edit-button{
            margin: 7px;
            background-color: #ffffff;
            border: none;
            color: #3a3b3c;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 15px;
        }

        .add-button {
            margin: 7px;
            background-color: #ffffff;
            border: none;
            color: #3a3b3c;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 15px;
        }

        .delete-button {
            margin: 7px;
            background-color: #ffffff;
            border: none;
            color: #3a3b3c;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 15px;
        }

        select {
            margin: 7px;
            background-color: #ffffff;
            border: none;
            color: #3a3b3c;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 25px;
        }

    </style>
  
</head>
<body class="dark">
    <nav class="sidebar close">
        <header>
            <div class="image-text">
            <span><img src="layout\ozelLogo.jpg" alt="ozel chempaka logo" class="logo"></span>

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
                        <a href="home.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="sales.php">
                            <i class='bx bx-bar-chart-alt-2 icon' ></i>
                            <span class="text nav-text">Sales</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="sales_report.php">
                            <i class='bx bxs-wallet-alt icon'></i>
                            <span class="text nav-text">Sales Report</span>
                        </a>
                    </li>
                    
                    <li class="nav-link">
                        <a href="users.php">
                            <i class='bx bx-user-plus icon' ></i>
                            <span class="text nav-text">Users</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="products.php">
                            <i class='bx bxs-package icon'></i>
                            <span class="text nav-text">Products</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="about.html">
                        <i class='bx bxs-info-circle icon'></i>
                            <span class="text nav-text">About Us</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="logout.php">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
                
            </div>
        </div>

    </nav>

    <section class="home">
            <?php  
                $db = new MySqli_DB();
                $query = "SELECT * FROM users";
                $result = $db->query($query);
                
                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                }
            ?>

        <div class="page">
            <h2>User Details</h2>
            <div class="user-details">
            <?php
                $db = new MySqli_DB();
                $query = "SELECT * FROM users";
                $result = $db->query($query);
                $users = [];

                while ($user = $result->fetch_assoc()) {
                    if ($user['id'] == $current_user_id) {
                        array_unshift($users, $user);
                    } else {
                        $users[] = $user;
                    }
                }

                $db->db_disconnect();
            ?>

            <script>
                const users = <?php echo json_encode($users); ?>;
                const currentUserId = <?php echo $current_user_id; ?>;
            </script>

                </p>
        </div>

            <div class="user-details">
                <p><strong>Name :</strong> <span id="user-name"></span></p>
                <p><strong>Role :</strong> <span id="user-role"></span></p>
            </div>
            <div class="user-actions">
                <?php if ($user_level == 1): ?>
                    <button class="add-button">
                        <a href="add_users.php">ADD</a>
                    </button>
                    <button class="delete-button">
                        <a href="del_users.php">DELETE</a>
                    </button>
                <?php endif; ?>
            </div>
            <div class="user-list">
                <label for="users">Select a user:</label>
                <select id="users" name="users">
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['id']; ?>" <?php if ($user['id'] == $current_user_id) echo 'selected'; ?>>
                            <?php echo $user['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <script>
            document.getElementById('users').addEventListener('change', function() {
                const selectedUserId = this.value;
                const user = users.find(u => u.id == selectedUserId);
                
                if (user) {
                    document.getElementById('user-name').textContent = user.name;
                    document.getElementById('user-role').textContent = user.user_level;
                }
            });

            // Trigger the change event on page load to display the current user's details by default
            document.getElementById('users').dispatchEvent(new Event('change'));
        </script>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Group Name</th>
                    <th>Group Level</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // Connect to the database
                $db = new MySqli_DB();

                // Query to fetch group data
                $query = "SELECT * FROM user_groups";
                $result = $db->query($query);

                // Loop through the result and generate table rows
                while ($group = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $group['group_name'] . "</td>";
                    echo "<td>" . $group['group_level'] . "</td>";
                    echo "</tr>";
                    }

                // Close the database connection
                $db->db_disconnect();
            ?>
            </tbody>
            </tbody>
        </table>
    </div>
    </section>

    <script>
      const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");


    toggle.addEventListener("click" , () =>{
        sidebar.classList.toggle("close");
    })

    modeSwitch.addEventListener("click" , () =>{
        body.classList.toggle("dark");
        
        if(body.classList.contains("dark")){
            modeText.innerText = "Light mode";
        }else{
            modeText.innerText = "Dark mode";
            
        }
    });



    </script>

</body>
</html>
