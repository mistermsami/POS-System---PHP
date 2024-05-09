<?php
session_start();

if(empty($_SESSION['ad_id']))
{
  header("location:home.php");
}
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Details</title>
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
            <h1>Admin Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Admin Details</li>
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
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Username</th>
                    <th>Password</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $totalamount=0;
                include("include/opendb.php");
                $query="select * from admin";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                 ?>
                 <form action="" method="post">
                  <tr>
                    <td><?php echo $row['ad_name']; ?></td>
                    <td class="pass" style="-webkit-text-security: disc; "><?php echo $row['ad_password']; ?></td>           
                  </tr>
                  </form>
                <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Username</th>
                    <th>Password</th>
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
                <h3 class="card-title">Add New Admin</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="padding: 35px;">
              	<h4>Add New Admin</h4>
                    <br>
                <form action="" method="post">
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Username</b></div>
                    <div class="col-6">
                      <input class="form-control" type="text" name="username" placeholder="Enter Username" required>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Password</b></div>
                    <div class="col-6">
                      <input class="form-control" type="password" name="password" placeholder="Enter Password" required>
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
                      $username= $_POST['username'];
                      $password= $_POST['password'];
                      
                    $query = "insert into admin (ad_name, ad_password) values ('$username', '$password')";
                    $result = $conn -> query($query) or die(error); 
                    echo "<script>window.location.href='admininfo.php'</script>";
                  }
                    ?>
                    <br><br>
                    <h4>Edit Your Password</h4>
                    <br>
                    <form action="" method="post">
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Pasword</b></div>
                    <div class="col-6">
                      <input class="form-control" type="text" name="pass" placeholder="Enter New Password" required>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-8">
                      <center><button style="width: 120px; height: 40px; font-weight: 700; font-size: 18px;" class="btn btn-primary" name="btnedit">Save</button></center>
                    </div>
                  </div>
                </form>
                <?php 
                if (isset($_POST['btnedit'])) {
                      $pass= $_POST['pass'];
                      
                    $query = "UPDATE admin set ad_password='$pass' where ad_id='".$_SESSION['ad_id']."' ";
                    $result = $conn -> query($query) or die(error); 
                    echo "<script>alert('Your Password changed')</script>";
                    echo "<script>window.location.href='logout.php'</script>";
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
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</html>