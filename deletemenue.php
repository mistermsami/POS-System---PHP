<?php
                $m_id = $_GET['id'];
                include("include/pdo.php");
                  $query = "delete from menue where m_id= '".$m_id."'";
                  $result = $conn->query($query);
                  echo "<script>window.location.href='menue.php'</script>";
                ?>