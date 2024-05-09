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
	<title>Employee</title>
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
            <h1>Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employee</li>
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
                <h3 class="card-title">Employee List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>CNIC</th>
                    <th>Address</th>
                    <th>Salary</th>
                    <th>Joining Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                include("include/opendb.php");
                $query="select * from employees";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                 ?>
                  <tr>
                    <td><?php echo $row['e_name']; ?></td>
                    <td><?php echo $row['e_cnic']; ?></td>
                    <td><?php echo $row['e_address']; ?></td>
                    <td><?php echo $row['e_salary']; ?></td>
                    <td><?php echo $row['e_joining']; ?></td>
                    <td style="font-weight: 900; font-size: 20px; text-align: center;"><button class="btn btn-primary" onclick="window.location.href='updateemp.php?id=<?php echo $row['e_id']; ?>'"><b>+</b></button></td>
                    <td style="font-weight: 900; font-size: 20px; text-align: center;"><button class="btn btn-danger" onclick="window.location.href='deleteemp.php?id=<?php echo $row['e_id']; ?>'">Delete</button></td>
                  </tr>
                <?php } ?>
                <tbody>
                  <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>CNIC</th>
                    <th>Address</th>
                    <th>Salary</th>
                    <th>Joining Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
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
                <h3 class="card-title">Add New Employee</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="padding: 35px;">
                <form action="" method="post">
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Name</b></div>
                    <div class="col-6">
                      <input class="form-control" type="text" name="name">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>CNIC</b></div>
                    <div class="col-6">
                      <input class="form-control" type="text" name="cnic">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Address</b></div>
                    <div class="col-6">
                      <input class="form-control" type="text" name="address">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Salary</b></div>
                    <div class="col-6">
                      <input class="form-control" type="number" name="salary">
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
                      $name= $_POST['name'];
                      $cnic= $_POST['cnic'];
                      $address= $_POST['address'];
                      $salary= $_POST['salary'];
                    $query = "insert into employees (e_name, e_cnic, e_address, e_salary, e_joining) values ('$name', '$cnic', '$address', '$salary', NOW())";
                    $result = $conn -> query($query) or die(error); 
                    echo "<script>window.location.href='employ.php'</script>";
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