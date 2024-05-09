<?php 
$c_id = $_GET['id'];
include("include/pdo.php");

$query = "delete neworder, stock from neworder INNER JOIN stock ON neworder.or_id=stock.or_id where neworder.or_id= '".$c_id."'";
          $result = $conn->query($query);
          echo "<script>window.location.href='home.php'</script>"; ?>