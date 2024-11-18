<?php require_once('includes/load.php'); ?>
<?php

// Connect to the database
$db = new MySqli_DB();
$sql = "SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON products.categorie_id = categories.id";
$result = $db->query($sql);

// close the database connection
$db->db_disconnect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data here
    // Assuming the form data is processed successfully

    // Get the search input value
    $searchInput = $_POST['searchInput'];

    // Modify the SQL query to include the search input condition
    $sql = "SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON products.categorie_id = categories.id WHERE products.name LIKE '%$searchInput%'";

    // Execute the modified SQL query
    $result = $db->query($sql);
}
?>

<?php
// search function

// Connect to the database
$db = new MySqli_DB();

// Get the search input value from the query string
$searchInput = $_GET['search'];

// Modify the SQL query to include the search input condition
$sql = "SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON products.categorie_id = categories.id WHERE products.name LIKE '%$searchInput%'";

$result = $db->query($sql);

// ...
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
    <link rel="stylesheet" href="sidebar.css">
    <title>Products</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    
    <style>
        /* ... */

        .search {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 500px;
            margin-right: 475px;
        }

        .search-icon {
            margin-right: 10px;
            color: white;
        }

        .search-input {
            padding: 10px;
            border-radius: 5px;
            border: none;
            outline: none;
            color: black;
            width: 100%;
        }

    </style>
</head>

    <style>
        .icon {
            min-width: 30px;
            border-radius: 6px;
            height: 100%;
            font-size: 20px;
            color: #ffffff;
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
            background-color: #bbb;
            border: none;
            color: #ffffff;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            color: #ffffff;
        }

        .icon:hover {
            color: #ffffff;
            transition: all 0.5s ease;
        }

        .home {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            flex-direction: column;
            max-height: 600px;
            width: auto;
            overflow-y: auto;
            padding: 20px;
            border-radius: 25px;
            background-color: #3a3b3c;
            margin: 25px;
            color: white;
            align-items: center;
        }

        

        table {
            width: 100%;
            border-collapse: collapse;
            color: white;
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
        <div class="addButton">
            <a href="add_prod.php">ADD</a>
        </div>

        <form action="products.php" method="get">
            <div class="search">
                <span class="search-icon material-symbols-outlined">search</span>
                <input class="search-input" type="text" name="search" placeholder="search...">
            </div>
        </form>

        <div class="container">
            <table>
                <tbody>
                <th>
                    <tr>
                        <th>Name</th>
                        <th>Buy Price</th>
                        <th>Sell Price</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </th>

                <?php 
                        echo '<p style="font-size: 30px; font-weight: bold;"> INVENTORY </p>';
                 if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['buy_price'] . "</td>";
                        echo "<td>" . $row['sale_price'] . "</td>";
                        echo "<td>" . $row['quantity'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['category_name'] . "</td>";
                        echo "<td>
                                <a href='edit_prod.php?id=" . $row['id'] . "'><i class='bx bx-edit-alt icon'></i></a>
                                <a href='del_prod.php?id=" . $row['id'] . "'> <i class='bx bx-trash icon'></i></a>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
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

    // Initialize the mode text based on the current mode
    if (body.classList.contains("dark")) {
        modeText.innerText = "Light mode";
    } else {
        modeText.innerText = "Dark mode";
    }

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
