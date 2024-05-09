<?php
session_start();

// if(empty($_SESSION['ad_id']))
// {
//   header("location:home.php");
// }
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Today's Stock</title>
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
            <h1>Stock</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Stock</li>
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
                <h3 class="card-title">Today's Stock</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Add Stock</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $totalamount=0;
                include("include/opendb.php");
                $query="SELECT menue.m_item, menue.m_itemprice, stock.s_quantity, stock.s_date, stock.s_id FROM stock LEFT JOIN menue ON stock.m_id = menue.m_id where stock.s_date= '". date("Y-m-d") ."' and s_quantity !='0'";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                  $total= $row['s_quantity'] * $row['m_itemprice'];
                  $totalamount+=$total;
                  $s_id=$row['s_id'];
                 ?>
                 <form action="" method="post">
                  <tr>
                    <td><?php echo $row['m_item']; ?></td>
                    <td><?php echo $row['s_quantity']; ?></td>
                    <td><?php echo $row['s_date']; ?></td>
                    <td><?php echo $total; ?></td>
                    <td style="font-weight: 900; font-size: 20px; text-align: center;"><a href="addstock.php?id=<?php echo $row['s_id']; ?>">+</a></td>              
                  </tr>
                  </form>
                <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Total Amount of Stock Rs: <b><?php echo $totalamount; ?></b></th>
                    <th></th>
                    <th></th>
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
                <h3 class="card-title">Add New Stock</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="padding: 35px;">
                <form action="" method="post">
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Item</b></div>
                    <div class="col-6">
                      <select class="form-control" name="itemname">
                        <?php
                          $query="select * from menue";
                          $result= $conn->query($query) or die("Query Error");
                          foreach ($result as $row) {
                            $mname=$row['m_item'];
                        ?>
                        <option value="<?php echo $row['m_id']; ?>"><?php echo $row['m_item']; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Quantity</b></div>
                    <div class="col-6">
                      <input class="form-control" type="text" name="stockqty">
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
                      $itemname= $_POST['itemname'];
                      $stockqty= $_POST['stockqty'];
                      $query="SELECT m_id FROM `stock` WHERE s_date= '". date("Y-m-d") ."' and sold_quantity='0'";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                  $mid =$row['m_id'];
                  
                }
                if ($mid==$itemname) {
                    echo "<script type='text/javascript'>alert('The item $itemname already exists!')</script>";
                  }
                  else{

                    $query = "insert into stock (m_id, s_quantity, s_date) values ('$itemname', '$stockqty', NOW())";
                    $result = $conn -> query($query) or die(error); 
                    echo "<script>window.location.href='stock.php'</script>";
                  }
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