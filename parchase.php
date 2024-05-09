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
	<title>Items Purchased</title>
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
            <h1>Items Purchased</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Items Purchased</li>
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
                <h3 class="card-title">Today's Purchased Items Details</h3>
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
                $query="select purchaseitems.pur_item, perchase.p_quantity, perchase.p_price, perchase.p_paid, perchase.p_remaing, perchase.p_remainingpaid, perchase.p_date from perchase inner join purchaseitems on purchaseitems.pur_id=perchase.pur_id where perchase.p_date = '". date("Y-m-d") ."'";
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
                $query="select sum(p_price) as totalprice from perchase where p_date='". date("Y-m-d") ."'";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                 ?>
                    <th>Total parchase is <b>RS: <?php echo $row['totalprice']; ?></b></th>
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
                // $query="select sum(p_price) as totalprice from perchase where p_date='". date("Y-m-d") ."'";
                // $result= $conn->query($query) or die("Query Error");
                // foreach ($result as $row) {
                 ?>
                  <!-- <h5>Today's total parchase is <b>RS: <?php echo $row['totalprice']; ?></b></h5> -->
                <?php //} ?>
                </table>
                <br><br>
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Item</th>
                    <th>Total Dues</th>
                    <th>Total Paid Dues</th>
                    <th>Total Remaining Dues</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $remainingdues=0;
                $query="select sum(perchase.p_remaing) as toataldues, purchaseitems.pur_item, (select sum(perchase.p_remainingpaid)) AS duespaid from perchase inner join purchaseitems on purchaseitems.pur_id=perchase.pur_id WHERE p_date = '". date("Y-m-d") ."' group by perchase.pur_id having sum(perchase.p_remaing)";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                  $totaldues=$row['toataldues'];
                  $totalpaiddues=$row['duespaid'];
                  $remainingdues=$totaldues - $totalpaiddues;
                 ?>
                  <tr>
                    <td><?php echo $row['pur_item']; ?></td>
                    <td><?php echo $totaldues; ?></td>
                    <td><?php echo $totalpaiddues; ?></td>
                    <td><?php echo $remainingdues; ?></td>
                  </tr>
                <?php } ?>
                  </tbody>
                </table>
                <br><br>
                <?php
                $duesremain=0;
                $query="select sum(p_price) AS totapurchase, sum(p_paid) as paid, sum(p_remaing) as remaining, sum(p_remainingpaid) as duespaid FROM perchase WHERE p_date = '". date("Y-m-d") ."'";
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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <br>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add New Purchase</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="padding: 35px;">
                <form action="" method="post">
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Item</b></div>
                    <div class="col-6">
                      
                      <select class="form-control" name="item">
                        <?php 
                      $query="select * from purchaseitems";
                      $result= $conn->query($query) or die("Query Error");
                      foreach ($result as $row) {
                       ?>
                        <option value="<?php echo $row['pur_id']; ?>"><?php echo $row['pur_item']; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Quantity</b></div>
                    <div class="col-6">
                      <input class="form-control" type="number" name="quantity" placeholder="Enter Quantity">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Total</b></div>
                    <div class="col-6">
                      <input class="form-control" type="number" name="price" placeholder="Enter Price" required>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Paid</b></div>
                    <div class="col-6">
                      <input class="form-control" type="number" name="paid" placeholder="Enter Paid Price">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-8">
                      <center><button style="width: 120px; height: 40px; font-weight: 700; font-size: 18px;" class="btn btn-primary" name="btnsubmit">Add</button></center>
                    </div>
                  </div>
                </form>
                <br><br>
                <?php 
                $paid=0;
                if (isset($_POST['btnsubmit'])) {
                      $item= $_POST['item'];
                      $pquantity= $_POST['quantity'];
                      $price= $_POST['price'];
                      $paid=$_POST['paid'];
                      $remaining= $_POST['price'] - $_POST['paid'];
                       $query = "insert into perchase (pur_id, p_quantity, p_price, p_paid, p_remaing, p_date) values ('$item', $pquantity, '$price', '$paid', '$remaining', NOW())";
                    $result = $conn -> query($query) or die(error); 
                    echo "<script>window.location.href='parchase.php'</script>";
                  }
                    ?>
                    <h4>Pay Dues Amount</h4>
                    <br>
                    <form action="" method="post">
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Item</b></div>
                    <div class="col-6">
                      
                      <select class="form-control" name="itemn">
                        <?php 
                      $query="select purchaseitems.pur_id, purchaseitems.pur_item,sum( perchase.p_remaing) as balaa from perchase inner join purchaseitems on purchaseitems.pur_id=perchase.pur_id group by purchaseitems.pur_id having sum(perchase.p_remaing)";
                      $result= $conn->query($query) or die("Query Error");
                      foreach ($result as $row) {
                       ?>
                        <option value="<?php echo $row['pur_id']; ?>"><?php echo $row['pur_item']; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Details</b></div>
                    <div class="col-6">
                      <input class="form-control" type="text" name="remainingpaid" placeholder="Enter Item Details">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-8">
                      <center><button style="width: 120px; height: 40px; font-weight: 700; font-size: 18px;" class="btn btn-primary" name="btnsubmitt">Save</button></center>
                    </div>
                  </div>
                </form>
                <?php
                $remain=0;
                $puid=0;
                $padremain=0;
                $totremain=0;
                
                if (isset($_POST['btnsubmitt'])) {
                      $itemn= $_POST['itemn'];
                      $remainingpaid= $_POST['remainingpaid'];

                      $que="select sum(p_remaing) as remain, pur_id, (select sum(p_remainingpaid)) AS paidre from perchase where pur_id=$itemn group by pur_id having sum(p_remaing) ";
                      $res= $conn->query($que) or die("Query Error");
                      foreach ($res as $row) {
                        $remain=$row['remain'];
                        $padremain=$row['paidre'];
                        $totremain=$remain - $padremain;         
                      
                      if ($totremain == 0) {
                            //echo "<script>alert('Remaining Dues are just Rs: $totremain')</script>";
                            echo "<script>alert('Dues are clear')</script>";
                        
                      }
                      elseif ($remainingpaid > $remain ||  $totremain < $remainingpaid) {
                           //echo "<script>alert('Dues are clear')</script>";
                           echo "<script>alert('Remaining Dues are just Rs: $totremain')</script>";
                      }
                      else{
                        $query = "insert into perchase (pur_id, p_remainingpaid, p_date) values ('$itemn', '$remainingpaid', NOW())";
                           $result = $conn -> query($query) or die(error); 
                           echo "<script>window.location.href='parchase.php'</script>";
                        //echo "<script>alert('Good')</script>";
                          }
                       } 
                    }
                  ?>
                    <br><br>
                    <h4>Add Item Name</h4>
                    <br>
                    <form action="" method="post">
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Item</b></div>
                    <div class="col-6">
                      <input class="form-control" type="text" name="itemname" placeholder="Enter Item Name" required>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Details</b></div>
                    <div class="col-6">
                      <input class="form-control" type="text" name="details" placeholder="Enter Item Details">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Dealer</b></div>
                    <div class="col-6">
                      <input class="form-control" type="text" name="dealer" placeholder="Enter Dealer Name" required>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-2 col-sm-4"><b>Contact</b></div>
                    <div class="col-6">
                      <input class="form-control" type="text" name="contact" placeholder="Enter Dealer Contact">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-8">
                      <center><button style="width: 120px; height: 40px; font-weight: 700; font-size: 18px;" class="btn btn-primary" name="btnsubmittt">Save</button></center>
                    </div>
                  </div>
                      
                </form>
                <?php
                if (isset($_POST['btnsubmittt'])) {
                      $items= $_POST['itemname'];
                      $details= $_POST['details'];
                      $dealer=$_POST['dealer'];
                      $contact= $_POST['contact'];
                       $query = "insert INTO purchaseitems(pur_item, pur_details, pur_dealer, pur_contact) VALUES ('$items','$details','$dealer','$contact')";
                    $result = $conn -> query($query) or die(error); 
                    echo "<script>window.location.href='parchase.php'</script>";
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
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  $(function () {
    $("#example3").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    $('#example4').DataTable({
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