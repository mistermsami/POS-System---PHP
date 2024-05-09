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
	<title>Utility</title>
	<?php include('include/headlinks.php') ?>
	<!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
            <h1>Utility</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Utility</li>
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

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Utility</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                include("include/opendb.php");
                $query="select * from utility where ut_date='". date("Y-m-d") ."'";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                 ?>
                  <tr>
                    <td><?php echo $row['ut_name']; ?></td>
                    <td><?php echo $row['ut_price']; ?></td>
                    <td><?php echo $row['ut_date']; ?></td>
                  </tr>
                <?php } ?>
                <tbody>
                  <tfoot>
                  <tr>
                    <?php 
                    $query="select sum(ut_price) as totalprice from utility where ut_date='". date("Y-m-d") ."'";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                 ?>
                    <th>Today's total Utilities is <b>RS: <?php echo $row['totalprice']; ?></b></th>
                    <?php } ?>
                    <th></th>
                    <th></th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <br>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add New Utility</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="padding: 35px;">
                <form action="" method="post">
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Utility Name</b></div>
                    <div class="col-6">
                      <input class="form-control" type="text" name="utname" placeholder="Enter Item Name">
                    </div>
                  </div>
                  <br>
                   <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Price</b></div>
                    <div class="col-6">
                      <input class="form-control" type="text" name="price" placeholder="Enter Price">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-8">
                      <center><button style="width: 120px; height: 40px; font-weight: 700; font-size: 18px;" class="btn btn-primary" name="btnsubmit">Add</button></center>
                    </div>
                  </div>
                </form>
                <?php 
                if (isset($_POST['btnsubmit'])) {
                      $utname= $_POST['utname'];
                      $price= $_POST['price'];
                    $query = "insert into utility (ut_name, ut_price, ut_date) values ('$utname', '$price', NOW())";
                    $result = $conn -> query($query) or die(error); 
                    echo "<script>window.location.href='utility.php'</script>";
                  }
                    ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
    <?php //include('include/jslinks.php') ?>
    <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</html>