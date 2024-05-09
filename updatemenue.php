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
	<title>Menue</title>
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
            <h1>Menue</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Menue</li>
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
                $m_id = $_GET['id'];
                include("include/pdo.php");
                  $query = "select menue.m_id, menue.m_item, menue.m_itemcost, menue.m_itemprice, menue.m_lastupdate, category.ca_id, category.ca_name from menue inner join category on category.ca_id=menue.ca_id where menue.m_id= '".$m_id."'";
                  $result = $conn->query($query);
                  foreach ($result as $row) {
                    $catid=$row['ca_id'];
                    $catname=$row['ca_name'];
                    $mitem=$row['m_item'];
                    $mitemcost=$row['m_itemcost'];
                    $mitemprice=$row['m_itemprice'];

                 ?>
            		<form action="" method="post">
            			
            			<div class="row">
            			<div class="col-2">Item</div>
            			<div class="col-6">
            				<input class="form-control" type="text" name="item" value="<?php echo $mitem ?>">
            			</div>
            			</div>
                  <br>
                  <div class="row">
                  <div class="col-2">Category</div>
                  <div class="col-6">
                    <select class="form-control" id="category" name="category">
                      <option value="<?php echo $catid ?>"><?php echo $catname ?></option>
                  <?php 
                        $qu="select * from category";
                        $re= $conn->query($qu) or die("Query Error");
                        foreach ($re as $row) {
                         ?>
                         
                  <option value="<?php echo $row['ca_id']; ?>"><?php echo $row['ca_name']; ?></option>
                <?php } ?>
                </select>
                  </div>
                  </div>
            			<br>
                  <div class="row">
                  <div class="col-2">Cost</div>
                  <div class="col-6">
                    <input class="form-control" type="text" name="cost" value="<?php echo $mitemcost ?>">
                  </div>
                  </div>
                  <br>
            			<div class="row">
            			<div class="col-2">Price</div>
            			<div class="col-6">
            				<input class="form-control" type="text" name="price" value="<?php echo $mitemprice ?>">
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
                      $item = $_POST['item'];
                      $category = $_POST['category'];
                      $price = $_POST['price'];
                      $cost=$_POST['cost'];
                    $query = "update menue set m_item='".$item."', m_itemprice='".$price."', m_itemcost='".$cost."', ca_id='".$category."', m_lastupdate= NOW() where m_id='".$m_id."'";
                    $result = $conn -> query($query) or die(error); 
                    echo "<script>window.location.href='menue.php'</script>";
                  }
                  // else{
                  //   echo"<script>alert('error')</script>";
                  // }
                  
                  
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