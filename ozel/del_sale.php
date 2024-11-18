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

    $sales_id = $_GET["id"];
    

    $sql = "DELETE FROM sales WHERE id = '$sales_id'";
    $sendsql = mysqli_query($connect,$sql);

    if($sendsql){
      echo "<p>Sales with ID: $sales_id has been deleted.</p>";
    }else{
      echo "<p>Failed to delete Sales with ID: $sales_id.</p>";
    }

    redirect("sales.php");
    ?>
    
  </body>

</html>