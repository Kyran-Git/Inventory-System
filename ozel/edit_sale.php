<?php
require_once('includes/load.php');

if(isset($_GET['id'])) {
    $sale_id = (int)$_GET['id'];
    $sale = find_by_id('sales', $sale_id);
    $original_quantity = $sale['qty'];
} else {
    $session->msg('d', 'Missing sale id.');
    redirect('sales.php');
}


if(isset($_POST['update_sale'])) {
    $req_fields = array('product-id', 'qty', 'price', 'date');
    validate_fields($req_fields);

    if(empty($errors)) {
        $prod = remove_junk($db->escape($_POST['product-id']));
        $quantity = remove_junk($db->escape($_POST['qty']));
        $price = remove_junk($db->escape($_POST['price']));
        $date = $_POST['date'];

        $query = "UPDATE sales SET";
        $query .= " product_id='{$prod}', qty='{$quantity}', price='{$price}', date='{$date}'";
        $query .= " WHERE id='{$sale_id}'";
        if($db->query($query)) {
            // Update the inventory
            if($quantity > $original_quantity) {
                // If quantity increased, deduct the difference from the inventory
                $diff = $quantity - $original_quantity;
                $update_inventory_query = "UPDATE products SET quantity = quantity - {$diff} WHERE id='{$prod}'";
            } else {
                // If quantity decreased, add the difference back to the inventory
                $diff = $original_quantity - $quantity;
                $update_inventory_query = "UPDATE products SET quantity = quantity + {$diff} WHERE id='{$prod}'";
            }
            $db->query($update_inventory_query);
            
            $session->msg('s', "Sale updated successfully.");
            redirect('sales.php', false);
        } else {
            $session->msg('d', 'Failed to update sale.');
            redirect('edit_sale.php?id='.$sale_id, false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('edit_sale.php?id='.$sale_id, false);
    }
}

    // Fetch products for the reference table
    $products = find_all('products');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
    <link rel="stylesheet" href="sidebar.css">
    <title>Edit Sale</title>
    
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

        .form-container {
            display: flex;
            flex-direction: column;
            margin-right: 20px;
        }

        .reference-container {
            display: flex;
            flex-direction: column;
            background-color: #2a2b2c;
            padding: 10px;
            border-radius: 10px;
            max-height: 400px;
            overflow-y: auto;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
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

        .reference-table {
            width: 100%;
            border-collapse: collapse;
        }

        .reference-table th, .reference-table td {
            padding: 8px;
            text-align: left;
        }

        .reference-table th {
            border-bottom: 1px solid #ffffff;
        }

        .reference-table tr {
            border-bottom: 1px solid #ffffff;
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
            <div class="form-container">
                <form method="post" action="edit_sale.php?id=<?php echo (int)$sale['id']; ?>">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" name="date" value="<?php echo remove_junk($sale['date']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="product-id">Product ID</label>
                        <input type="text" class="form-control" name="product-id" value="<?php echo remove_junk($sale['product_id']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="qty">Product Quantity</label>
                        <input type="number" class="form-control" name="qty" value="<?php echo remove_junk($sale['qty']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" id="product-price" class="form-control" name="price" readonly>
                    </div>

                    <button type="submit" name="update_sale" class="btn btn-primary">Update Sale</button>
                </form>
            </div>
            <div class="reference-container">
                <h3>Product References</h3>
                <table class="reference-table">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><?php echo $product['name']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        const body = document.querySelector('body'),
        sidebar = body.querySelector('nav'),
        toggle = body.querySelector(".toggle"),
        modeText = body.querySelector(".mode-text");

        toggle.addEventListener("click" , () =>{
            sidebar.classList.toggle("close");
        });
        
    </script>
</body>
</html>
