<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'hilalfoods';
$port = 3306;

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connection Successfull";
}
catch(PDOException $e){
    echo  $e->getMessage();
    }
 

?>
