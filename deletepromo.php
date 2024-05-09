<?php

session_start();

if(empty($_SESSION['ad_id']))
{
  header("location:home.php");
}
?>
<?php
$pr_id= $_GET['id'];
include("include/opendb.php");
$query="delete from promotions where pr_id='$pr_id'"; 
$result= $conn->query($query) or die("Query Error");
echo "<script>window.location.href='promotions.php'</script>";
?>