<?php
require_once('includes/load.php');

if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];
    $product = find_by_id('products', $product_id);
} else {
    $session->msg('d', 'Missing product id.');
    redirect('products.php');
}

if (isset($_POST['update_product'])) {
    $req_fields = array('name', 'buy_price', 'sell_price', 'quantity', 'date', 'category');
    validate_fields($req_fields);

    if (empty($errors)) {
        $name = remove_junk($db->escape($_POST['name']));
        $buy_price = remove_junk($db->escape($_POST['buy_price']));
        $sell_price = remove_junk($db->escape($_POST['sell_price']));
        $quantity = remove_junk($db->escape($_POST['quantity']));
        $date = $_POST['date'];
        $category = remove_junk($db->escape($_POST['category']));

        $query = "UPDATE products SET";
        $query .= " name='{$name}', buy_price='{$buy_price}', sale_price='{$sell_price}', quantity='{$quantity}', date='{$date}', categorie_id='{$category}'";
        $query .= " WHERE id='{$product_id}'";
        if ($db->query($query)) {
            $session->msg('s', "Product updated successfully.");
            redirect('products.php', false);
        } else {
            $session->msg('d', 'Failed to update product.');
            redirect('edit_prod.php?id=' . $product_id, false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('edit_prod.php?id=' . $product_id, false);
    }
}

// Fetch categories for the dropdown
$categories = find_all('categories');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
    <link rel="stylesheet" href="sidebar.css">
    <title>Edit Product</title>
    
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .icon {
            min-width: 30px;
            border-radius: 6px;
            height: 100%;
            font-size: 20px;
            color: #ffffff;
        }

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

        .form-container {
            display: flex;
            flex-direction: column;
            margin-right: 20px;
        }

        .container {
            display: flex;
            flex-direction: row;
            height: auto;
            width: auto;
            overflow-y: auto;
            padding: 20px;
            border-radius: 25px;
            background-color: #3a3b3c;
            margin: 25px;
            color: #ffffff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
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
                        <i class='bx bx-log-out icon'></i>
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
        <div class="container">
            <form method="post" action="edit_prod.php?id=<?php echo (int)$product['id']; ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo remove_junk($product['name']); ?>">
                </div>
                <div class="form-group">
                    <label for="buy_price">Buy Price</label>
                    <input type="number" class="form-control" name="buy_price" value="<?php echo remove_junk($product['buy_price']); ?>">
                </div>
                <div class="form-group">
                    <label for="sell_price">Sell Price</label>
                    <input type="number" class="form-control" name="sell_price" value="<?php echo remove_junk($product['sale_price']); ?>">
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" name="quantity" value="<?php echo remove_junk($product['quantity']); ?>">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" name="date" value="<?php echo remove_junk($product['date']); ?>">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" name="category">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo (int)$category['id']; ?>" <?php if ($category['id'] == $product['categorie_id']) echo 'selected'; ?>>
                                <?php echo remove_junk($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" name="update_product" class="btn btn-primary">Update Product</button>
            </form>
        </div>
    </section>

    <script>
        const body = document.querySelector('body');
        const sidebar = body.querySelector('nav');
        const toggle = body.querySelector(".toggle");
        const modeText = body.querySelector(".mode-text");

        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });

        const modeSwitch = body.querySelector(".toggle-switch");
        modeSwitch.addEventListener("click", () => {
            body.classList.toggle("dark");
            modeText.innerText = body.classList.contains("dark") ? "Light mode" : "Dark mode";
        });
    </script>
</body>
</html>
