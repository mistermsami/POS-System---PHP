<?php

session_start();

if(empty($_SESSION['ad_id']))
{
  header("location:home.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Items Perchased</title>
	<?php include('include/headlinks.php') ?>
</head>

<body>
	<div class="wrapper">
	<?php include('include/nav.php') ?>
	<?php include('include/sidebar.php') ?>

        <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoices</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoices</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <style>
              .card{
                padding: 25px;
              }
              
            </style>
            <!-- <form action="" method="post"> -->
            <div class="card">
            	<div class="card-head">
            		Add Quantity of Sock
            	</div>
            	<div class="card-body">
            		<?php
                $s_id = $_GET['id'];
                include("include/pdo.php");
                  $query = "SELECT menue.m_item, menue.m_itemprice, stock.s_quantity, stock.s_date, stock.s_id FROM stock LEFT JOIN menue ON stock.m_id = menue.m_id where stock.s_id= '".$s_id."'";

                  $result = $conn->query($query);
                  foreach ($result as $row) {
                 ?>
            		<form action="" method="post">
            			
            			<div class="row">
            			<div class="col-2">Item</div>
            			<div class="col-6">
            				<input class="form-control" type="text" name="item" value="<?php echo $row['m_item']; ?>" disabled>
            			</div>
            			</div>
            			<br>
            			<div class="row">
            			<div class="col-2">Quantity</div>
            			<div class="col-6">
            				<input class="form-control" type="text" id="quantity" name="quantity" value="<?php echo $row['s_quantity']; ?>" disabled>
            			</div>
            			</div>
            			<br>
            			<div class="row">
            			<div class="col-2">Date</div>
            			<div class="col-6">
            				<input class="form-control" type="text" name="sdate" value="<?php echo $row['s_date']; ?>" disabled>
            			</div>
            			</div>
            			<br>
            			<div class="row">
            			<div class="col-2">Add</div>
            			<div class="col-6">
            				<input class="form-control" type="text" name="quantityadd" placeholder="ADD HERE" required>
            			</div>
            			</div>
            			<br>
            			<div class="row">
            				<div class="col-3">
            					<button style="width: 120px; height: 40px; font-weight: 700; font-size: 18px;" class="btn btn-primary" name="btnsubmit">save</button>
            				</div>
            			</div>
            			
            		</form>
            		<?php } ?>
            		<?php 
            		if (isset($_POST['btnsubmit'])) {
                      $add = $_POST['quantityadd'];
                      $addd= $row['s_quantity'] + $add;
                    $query = 'update stock set s_quantity='.$addd.' where s_id='.$s_id.'';
                    $result = $conn -> query($query) or die(error); 
                    echo "<script>window.location.href='stock.php'</script>";
                  }
                    ?>
            		
            	</div>
              
            </div>

            <div class="card">
              <div class="card-head">
                Subtract Quantity of Sock
              </div>
              <div class="card-body">
                <?php
                  $query = "SELECT menue.m_item, menue.m_itemprice, stock.s_quantity, stock.s_date, stock.s_id FROM stock LEFT JOIN menue ON stock.m_id = menue.m_id where stock.s_id= '".$s_id."'";

                  $result = $conn->query($query);
                  foreach ($result as $row) {
                 ?>
                <form action="" method="post">
                  
                  <div class="row">
                  <div class="col-2">Item</div>
                  <div class="col-6">
                    <input class="form-control" type="text" name="itemsu" value="<?php echo $row['m_item']; ?>" disabled>
                  </div>
                  </div>
                  <br>
                  <div class="row">
                  <div class="col-2">Quantity</div>
                  <div class="col-6">
                    <input class="form-control" type="text" id="quantitysu" name="quantitysu" value="<?php echo $row['s_quantity']; ?>" disabled>
                  </div>
                  </div>
                  <br>
                  <div class="row">
                  <div class="col-2">Date</div>
                  <div class="col-6">
                    <input class="form-control" type="text" name="sdatesu" value="<?php echo $row['s_date']; ?>" disabled>
                  </div>
                  </div>
                  <br>
                  <div class="row">
                  <div class="col-2">Subtract</div>
                  <div class="col-6">
                    <input class="form-control" type="text" name="quantitysub" placeholder="SUBTRACT HERE" required>
                  </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-3">
                      <button style="width: 120px; height: 40px; font-weight: 700; font-size: 18px;" class="btn btn-primary" name="btnsubmitsu">save</button>
                    </div>
                  </div>
                  
                </form>
                <?php } ?>
                <?php 
                if (isset($_POST['btnsubmitsu'])) {
                      $sub = $_POST['quantitysub'];
                      $subb= $row['s_quantity'] - $sub;
                      if ($sub >= $row['s_quantity']) {
                        echo"<script>alert('Error')</script>";
                      }
                      else{
                    $query = 'update stock set s_quantity='.$subb.' where s_id='.$s_id.'';
                    $result = $conn -> query($query) or die(error); 
                    echo"$subb";
                    // echo "<script>window.location.href='stock.php'</script>";
                  }
                  }
                    ?>
                
              </div>
              
            </div>
            
                         
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


    </div>
</body>

    <?php include('include/jslinks.php') ?>
    
</html>