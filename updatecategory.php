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
	<title>Category</title>
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
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
                $ca_id = $_GET['id'];
                include("include/pdo.php");
                  $query = "select * from category where ca_id= '".$ca_id."'";
                  $result = $conn->query($query);
                  foreach ($result as $row) {
                    
                 ?>
            		<form action="" method="post">
            			
            			<div class="row">
            			<div class="col-2">Category Name</div>
            			<div class="col-6">
            				<input class="form-control" type="text" name="category" value="<?php echo $row['ca_name'] ?>" >
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
                      $category = $_POST['category'];
                    $query = "UPDATE category SET ca_name='".$category."' where ca_id='".$ca_id."'";
                    $result = $conn -> query($query) or die(error); 
                    echo "<script>window.location.href='menue.php'</script>";
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