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
            <h1>Menue</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Menue</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Item</th>
                    <th>Category</th>
                    <th>Cost</th>
                    <th>Price</th>
                    <th>Last Updated</th>
                    <th>Update Price</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                include("include/opendb.php");
                $query="select menue.m_id, menue.m_item, menue.m_itemcost, menue.m_itemprice, menue.m_lastupdate, category.ca_name from menue inner join category on category.ca_id=menue.ca_id";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                 ?>
                  <tr>
                    <td><?php echo $row['m_item']; ?></td>
                    <td><?php echo $row['ca_name']; ?></td>
                    <td><?php echo $row['m_itemcost']; ?></td>
                    <td><?php echo $row['m_itemprice']; ?></td>
                    <td><?php echo $row['m_lastupdate']; ?></td>
                    <td style="font-weight: 900; font-size: 20px; text-align: center;"><button class="btn btn-primary" onclick="window.location.href='updatemenue.php?id=<?php echo $row['m_id']; ?>'"><b>+</b></button></td>
                    <td style="font-weight: 900; font-size: 20px; text-align: center;"><button class="btn btn-danger" onclick="window.location.href='deletemenue.php?id=<?php echo $row['m_id']; ?>'">Delete</button></td>
                  </tr>
                <?php } ?>
                <tbody>
                  <tfoot>
                  <tr>
                    <th>Item</th>
                    <th>Category</th>
                    <th>Cost</th>
                    <th>Price</th>
                    <th>Last Updated</th>
                    <th>Update Price</th>
                    <th>Delete</th>
                  </tr>
                  </tfoot>
                </table>
                <br><br>
                <h3>Categories</h3>
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Category</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                include("include/opendb.php");
                $query="select * from category";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                 ?>
                  <tr>
                    <td><?php echo $row['ca_name']; ?></td>
                    <td style="font-weight: 900; font-size: 20px; text-align: center;"><a href="updatecategory.php?id=<?php echo $row['ca_id']; ?>">+</a></td>
                    <td style="font-weight: 900; font-size: 20px; text-align: center;"><button class="btn btn-danger" onclick="window.location.href='deletecat.php?id=<?php echo $row['ca_id']; ?>'">Delete</button></td>
                  </tr>
                <?php } ?>
                <tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <br>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add New Item in Menue</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="padding: 35px;">
                <form action="" method="post">
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Item</b></div>
                    <div class="col-6">
                      <input class="form-control" type="text" name="item" placeholder="Enter Item Name">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Category</b></div>
                    <div class="col-6">
                      <select class="form-control" id="category" name="category" style="width:100%;">
                  <?php 
                        include("include/opendb.php");
                        $query="select * from category";
                        $result= $conn->query($query) or die("Query Error");
                        foreach ($result as $row) {
                         ?>
                  <option value="<?php echo $row['ca_id']; ?>"><?php echo $row['ca_name']; ?></option>
                <?php } ?>
                </select>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Cost</b></div>
                    <div class="col-6">
                      <input class="form-control" type="text" name="cost" placeholder="Enter Cost">
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
                      $item= $_POST['item'];
                      $category=$_POST['category'];
                      $price= $_POST['price'];
                      $cost= $_POST['cost'];
                    $query = "insert into menue (ca_id, m_item, m_itemcost, m_itemprice, m_lastupdate) values ('$category','$item', '$cost', '$price', NOW())";
                    $result = $conn -> query($query) or die(error); 
                    echo "<script>window.location.href='menue.php'</script>";
                  }
                    ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <br>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add New Category in Menue</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="padding: 35px;">
                <form action="" method="post">
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Category Name</b></div>
                    <div class="col-6">
                      <input class="form-control" type="text" name="catname" placeholder="Enter Category Name">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-8">
                      <center><button style="width: 120px; height: 40px; font-weight: 700; font-size: 18px;" class="btn btn-primary" name="btnsubmitcat">Save</button></center>
                    </div>
                  </div>
                </form>
                <?php 
                if (isset($_POST['btnsubmitcat'])) {
                      $caname= $_POST['catname'];
                    $query = "insert into category (ca_name) values ('$caname')";
                    $result = $conn -> query($query) or die(error); 
                    echo "<script>window.location.href='menue.php'</script>";
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
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</html>