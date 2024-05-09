<?php session_start(); ?>
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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <style>
      /*.small-box{
        height: 150px;
      }
      .small-box h4{
        margin-top: 62px;
      }*/
      .card-body{
        height: 90px;
      }
      .card-footer a{
        text-decoration: none;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #000;
      }

    </style>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        	<div class="col-lg-3 col-6">
            <!-- small box -->
            <div  class="card small-box bg-info">
              <div class="card-body">
              <div class=" inner">
                <h3></h3>

                <h4>Create Invoice</h4>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              </div>
              <div class="card-footer">
                 <center><a href="createinvoice1.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a></center>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div  class="card small-box bg-warning">
              <div class="card-body">
              <div class="inner">
                <!-- <h3>44</h3> -->

                <h4>Stock</h4>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              </div>
              <div class="card-footer">
                 <center><a href="stock.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a></center>
            </div>
          </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="caed small-box bg-danger">
              <div class="card-body">
              <div class="inner">
                <!-- <h3>65</h3> -->

                <h4>Invoices</h4>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              </div>
              <div class="card-footer">
                 <center><a href="invoice.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a></center>
               </div>
            </div>
          </div>
          <!-- ./col -->
          <?php
            if(!empty($_SESSION['ad_id']))
            { 
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="card small-box bg-info">
              <div class="card-body">
              <div class="inner">
                <!-- <h3>150</h3> -->
                  <h4>Items Perchased</h4>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              </div>
              <div class="card-footer">
                 <center><a href="parchase.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a></center>
               </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="card small-box bg-success">
              <div class="card-body">
              <div class="inner">
                <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->

                <h4>Menue</h4>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              </div>
              <div class="card-footer">
                 <center><a href="menue.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a></center>
               </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="card small-box bg-warning">
              <div class="card-body">
              <div class="inner">
                <!-- <h3>44</h3> -->

                <h4>Employees</h4>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              </div>
              <div class="card-footer">
                 <center><a href="employ.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a></center>
               </div>
            </div>
          </div>
          <!-- ./col -->
          
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="card small-box bg-success">
              <div class="card-body">
              <div class="inner">
                <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->

                <h4>Today's Report</h4>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              </div>
              <div class="card-footer">
                 <center><a href="dailyreport.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a></center>
               </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="card small-box bg-warning">
              <div class="card-body">
              <div class="inner">
                <!-- <h3>44</h3> -->

                <h4>Promotions</h4>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              </div>
              <div class="card-footer">
                 <center><a href="promotions.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a></center>
               </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="card small-box bg-danger">
              <div class="card-body">
              <div class="inner">
                <!-- <h3>65</h3> -->

                <h4>Utility</h4>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              </div>
              <div class="card-footer">
                 <center><a href="utility.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a></center>
               </div>
            </div>
          </div>
          <!-- ./col -->
         <?php }
         ?>
        </div>
        <!-- /.row -->
        

          
  </div>
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