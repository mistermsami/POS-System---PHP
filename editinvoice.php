<?php

session_start();

// if(empty($_SESSION['ad_id']))
// {
//   header("location:home.php");
// }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hilals Food</title>
	<?php include('include/headlinks.php') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include('include/nav.php') ?>
		<?php include('include/sidebar.php') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Invoice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Edit Invoice</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <style>
    	.itemcat{
    		text-transform: uppercase;
    		font-weight: 700;
    	}
    	.items{
    		height: 190px;
    		padding: 15px;
    		margin: 10px;
    		border-radius: 10px;
    		box-shadow: 10px 10px 5px #e6e6e6;
    		background: rgb(252,247,255);
    		background: linear-gradient(90deg, rgba(252,247,255,1) 0%, rgba(218,250,251,1) 50%, rgba(255,243,227,1) 100%);
    		/*background: radial-gradient(circle, rgba(252,247,255,1) 0%, rgba(218,250,251,1) 50%, rgba(255,243,227,1) 100%);*/

    		/*background: rgb(246,231,255);
				background: linear-gradient(90deg, rgba(246,231,255,1) 0%, rgba(203,250,251,1) 50%, rgba(255,236,210,1) 100%);*/
    	}
    	.items span{
    		font-size: 18px;
    		line-height: 1;
    	}
    	.items h4{
    		line-height: 1.2;
    	}
    	.items input{
    		
    	}
    </style>

    <?php 
    $editid = $_GET['id'];
     ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <!-- general form elements disabled -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Order Info</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              	<form action="purchase.php" method="post">
              		<div class="row">
      			      <div class="col-md-3 col-sm-4">
      			      	<label>Employee Name</label>
				        <select class="form-control" id="servedby" name="servedby" style="width:100%;">
				          <?php 
				                include("include/opendb.php");
				                $query="select * from employees";
				                $result= $conn->query($query) or die("Query Error");
				                foreach ($result as $row) {
				                 ?>
				          <option value="<?php echo $row['e_id']; ?>"><?php echo $row['e_name']; ?></option>
				        <?php } ?>
				        </select>
				      </div>
				      <div class="col-md-3 col-sm-4">
				      	<label>Add Discount</label>
				        <input type="text" name="discount" class="form-control" placeholder="Discount">
				      </div>
				      <div class="col-md-3 col-sm-4">
				      	<label>Add Promotion</label>
				        <select class="form-control" id="promo" name="promo" style="width:100%;">
				          <?php 
				                $query="select * from promotions";
				                $result= $conn->query($query) or die("Query Error");
				                foreach ($result as $row) {
				                 ?>
				          <option value="<?php echo $row['pr_id']; ?>"><?php echo $row['pr_name']; ?> RS:<?php echo $row['pr_rupees']; ?></option>
				        <?php } ?>
				        </select>
				        <br>
				      </div>
				      <div class="col-md-2" style="margin-left:20px;">
				        <button style="width: 120px; height: 45px; font-weight: 700; font-size: 20px; float: right; margin-top: 22px;" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span>Checkout</button>
				      </div>
				    </div>				  
                <div id="accordion">
                	<?php 
                include("include/opendb.php");
                $query="select * from category";
                $result= $conn->query($query) or die("Query Error");
                $iterate=0;
                foreach ($result as $row) {
                	$ca_id=$row['ca_id'];
                 ?>
				  <div class="card">
				    <div class="card-header" id="<?php echo $row['ca_id']; ?>">
				      <h5 class="mb-0">
				        <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#<?php echo $row['ca_name'] ?>12" aria-expanded="false" aria-controls="<?php echo $row['ca_name'] ?>12">
				          <h4 class="itemcat"><?php echo $row['ca_name']; ?></h4>
				        </a>
				      </h5>
				    </div>
				    <div id="<?php echo $row['ca_name'] ?>12" class="collapse" aria-labelledby="<?php echo $row['ca_id']; ?>" data-parent="#accordion">
				      <div class="card-body">
				      	<div class="row">
				        <?php                
                
				          $sql="select menue.m_id, menue.m_itemprice, menue.m_item, category.ca_id from menue inner join category on category.ca_id= menue.ca_id where category.ca_id= '".$row['ca_id']."' ";
				          $query=$conn->query($sql);
				          
				          while($row=$query->fetch_array()){

				            ?>
				            	
				            	  
				            		<div class="col-md-4 col-sm-6">
				            			<div class="card items">
				            			<input class="form-control" type="checkbox" value="<?php echo $row['m_id']; ?>||<?php echo $iterate; ?>" name="m_id[]" style="">
				            			<h4><?php echo $row['m_item']; ?><br><span>Rs:&nbsp;<?php echo number_format($row['m_itemprice'], 2); ?></span></h4>
				            			<input type="number" class="form-control" min="1" name="quantity_<?php echo $iterate; ?>">
					            		</div>
					            	</div>
				            	<?php $iterate++; } ?>
				              
				            <?php
				            
				          //}
				        ?>
				        </div>
				      </div>
				    </div>
				  </div>
				  <?php } ?>
				  
				</div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
         
  </div>
</section>
<script type="text/javascript">
  function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script> 
  <!-- /.content-wrapper -->

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- <footer class="main-footer">
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-rc
    </div>
  </footer> -->

</body>
<?php include('include/jslinks.php') ?>
</html>