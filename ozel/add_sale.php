
<?php
$page_title = 'Add Sale';
require_once('includes/load.php');
?>
<?php
$sale = find_by_id('sales', (int)$_GET['id']);
$product = find_by_id('products', $sale['product_id']);
?>

<?php
if (isset($_POST['add_sale'])) {

    $req_fields = array('product-id', 'qty', 'date');
    validate_fields($req_fields);

    if (empty($errors)) {
        $prod = remove_junk($db->escape($_POST['product-id']));
        $quantity = (int)remove_junk($db->escape($_POST['qty']));
        $date = remove_junk($db->escape($_POST['date']));

        // Fetch the product details
        $product = find_by_id('products', $prod);
        $price = $quantity * $product['sale_price'];

        // Deduct the quantity from inventory
        $new_quantity = $product['quantity'] - $quantity;
        if ($new_quantity < 0) {
            $session->msg('d', 'Not enough quantity in stock.');
            redirect('add_sale.php', false);
        } else {
            $update_query = "UPDATE products SET quantity = '{$new_quantity}' WHERE id = '{$prod}'";
            if (!$db->query($update_query)) {
                $session->msg('d', 'Failed to update product quantity.');
                redirect('add_sale.php', false);
            }
        }

        // Insert the sale
        $query = "INSERT INTO sales (product_id, qty, price, date) VALUES ('{$prod}', '{$quantity}', '{$price}', '{$date}')";
        if ($db->query($query)) {
            // Success
            $session->msg('s', 'Successfully Added!');
            redirect('add_sale.php', false);
        } else {
            // Failed
            $session->msg('d', 'Sorry, failed to add the sale.');
            redirect('add_sale.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('add_sale.php', false);
    }
}

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

        .input-box {
            margin: 15px;
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

        .reference-table {
            width: 100%;
            border-collapse: collapse;
            color: #ffffff;
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
        <div class="container">
        <div class="form-container">
                <form method="post" action="add_sale.php">
                    <div class="input-box">
                        <span class="details">Product</span>
                        <select name="product-id" id="product-id" required>
                            <?php foreach ($products as $product): ?>
                                <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Quantity</span>
                        <input type="number" name="qty" id="qty" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Date</span>
                        <input type="date" name="date" id="date" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Total Price</span>
                        <input type="text" id="product-price" readonly>
                    </div>
                    
                    <div>
                        <button type="submit" name="add_sale" value="Add Sale" class="btn btn-danger">Add Sale</button>
                    </div>
                </form>
            </div> 
            <div class="reference-container">
                <h3>Product References</h3>
                <table class="reference-table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Sell Price</th>
                            <th>Quantity Left</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['sale_price']; ?></td>
                            <td><?php echo $product['quantity']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
        
    </section>

    <script>
        const productPrice = document.querySelector("#product-price");
        const productSelect = document.querySelector("#product-id");
        const qtyInput = document.querySelector("#qty");

        productSelect.addEventListener("change", updatePrice);
        qtyInput.addEventListener("input", updatePrice);

        function updatePrice() {
            const selectedProductId = productSelect.value;
            const quantity = qtyInput.value;
            if (selectedProductId && quantity) {
                const selectedProduct = <?php echo json_encode($products); ?>.find(product => product.id == selectedProductId);
                if (selectedProduct) {
                    const price = quantity * selectedProduct.sale_price;
                    productPrice.value = price.toFixed(2);
                }
            } else {
                productPrice.value = '';
            }
        }

    </script>

</body>
</html>