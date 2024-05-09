<?php
                $ca_id = $_GET['id'];
                include("include/pdo.php");
                  $query = "delete from category where ca_id= '".$ca_id."'";
                  $result = $conn->query($query);
                  echo "<script>window.location.href='menue.php'</script>";
                ?>