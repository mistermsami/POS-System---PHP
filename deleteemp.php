<?php
                $emp_id = $_GET['id'];
                include("include/pdo.php");
                  $query = "delete from employees where e_id= '".$emp_id."'";
                  $result = $conn->query($query);
                  echo "<script>window.location.href='employ.php'</script>";
                ?>