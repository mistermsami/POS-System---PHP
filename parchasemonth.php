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
            <h1>Items Perchased</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Items Perchased</li>
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
                <h3 class="card-title">Items Purchased Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Paid</th>
                    <th>Dues</th>
                    <th>Dues Paid</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                include("include/opendb.php");
                $query="select purchaseitems.pur_item, perchase.p_quantity, perchase.p_price, perchase.p_paid, perchase.p_remaing, perchase.p_remainingpaid, perchase.p_date from perchase inner join purchaseitems on purchaseitems.pur_id=perchase.pur_id where perchase.p_date BETWEEN (NOW() - INTERVAL 1 MONTH) AND NOW()";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                 ?>
                  <tr>
                    <td><?php echo $row['pur_item']; ?></td>
                    <td><?php echo $row['p_quantity']; ?></td>
                    <td><?php echo $row['p_price']; ?></td>
                    <td><?php echo $row['p_paid']; ?></td>
                    <td><?php echo $row['p_remaing']; ?></td>
                    <td><?php echo $row['p_remainingpaid']; ?></td>
                    <td><?php echo $row['p_date']; ?></td>
                  </tr>
                <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <?php
                $query="select sum(p_price) as totalprice from perchase where p_date BETWEEN (NOW() - INTERVAL 1 MONTH) AND NOW()";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                 ?>
                    <th>Total Parchase is <b>RS: <?php echo $row['totalprice']; ?></b></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                  <?php } ?>
                  </tfoot>
                  <?php
                // $query="select sum(p_price) as totalprice from perchase where p_date BETWEEN (NOW() - INTERVAL 1 MONTH) AND NOW()";
                // $result= $conn->query($query) or die("Query Error");
                // foreach ($result as $row) {
                 ?>
                  <!-- <h5>Today's total parchase is <b>RS: <?php //echo $row['totalprice']; ?></b></h5> -->
                <?php //} ?>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-body">
                <h4>Item Purchased</h4>
                  <br>
                <?php
                $duesremain=0;
                $query="select sum(p_price) AS totapurchase, sum(p_paid) as paid, sum(p_remaing) as remaining, sum(p_remainingpaid) as duespaid FROM perchase WHERE p_date BETWEEN (NOW() - INTERVAL 1 MONTH) AND NOW()";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                  $duesremain=$row['remaining'] - $row['duespaid'];
                  $pipaid=$row['paid'];
                  $piduepaid=$row['duespaid'];
                 ?>
                 <div class="row">
                   <div class="col-4">
                     <h5>Total Purchase</h5>
                   </div>
                   <div class="col-3">
                     <h4>Rs: <?php echo $row['totapurchase']; ?></h4>
                   </div>
                 </div>
                 <hr>
                 <div class="row">
                   <div class="col-4">
                     <h5>Total Paid</h5>
                   </div>
                   <div class="col-3">
                     <h4>Rs: <?php echo $row['paid']; ?></h4>
                   </div>
                 </div>
                 <hr>
                 <div class="row">
                   <div class="col-4">
                     <h5>Total Dues</h5>
                   </div>
                   <div class="col-3">
                     <h4>Rs: <?php echo $row['remaining']; ?></h4>
                   </div>
                 </div>
                 <hr>
                 <div class="row">
                   <div class="col-4">
                     <h5>Total Dues Paid</h5>
                   </div>
                   <div class="col-3">
                     <h4>Rs: <?php echo $row['duespaid']; ?></h4>
                   </div>
                 </div>
                 <hr>
                 <div class="row">
                   <div class="col-4">
                     <h5>Dues Remaining</h5>
                   </div>
                   <div class="col-3">
                     <h4>Rs: <?php echo $duesremain; ?></h4>
                   </div>
                 </div>
                 <hr>
              <?php } ?>
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