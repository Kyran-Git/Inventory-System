<?php
  require_once('includes/load.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title> localhost </title>
  </head>
  
  <body>
  <?php
    $DB_HOST = "localhost: 3306";
    $DB_USER = "root";
    $DB_PASS = "";
    $DB_NAME = "ozel";
    
    $connect = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME) 
    OR DIE ("CONNECTION FAILED");

    $products_id = $_GET["id"];
    

    $sql = "DELETE FROM products WHERE id = '$products_id'";
    $sendsql = mysqli_query($connect,$sql);

    if($sendsql){
      echo "<p>Product with ID: $products_id has been deleted.</p>";
    }else{
      echo "<p>Failed to delete product with ID: $products_id.</p>";
    }

    redirect("products.php");
    ?>
    
  </body>

</html>