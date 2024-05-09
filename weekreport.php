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
  <title>Weekly Report</title>
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
            <h1>Weekly Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Weekly Report</li>
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
                <h3 class="card-title">Weekly Report</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Item</th>
                    <th>Stock IN</th>  
                    <th>Stock Sold</th>
                    <th>Remaining Stock</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $totalamount=0;
                  $remainingstock=0;
                include("include/opendb.php");
                // $query="SELECT menue.m_item, stock.s_quantity, stock.sold_quantity, stock.s_date, stock.s_id FROM stock LEFT JOIN menue ON stock.m_id = menue.m_id where stock.s_date= '". date("Y-m-d") ."'";
                $query="select menue.m_item, sum(stock.sold_quantity) as soldqty, sum(stock.s_quantity) s_qty FROM stock INNER JOIN menue ON menue.m_id= stock.m_id where stock.s_date BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() group by menue.m_id having sum(stock.sold_quantity)";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                $remainingstock= $row['s_qty'] - $row['soldqty'];
                  
                 ?>
                  <tr>
                    <td><?php echo $row['m_item']; ?></td>
                    <td><?php echo $row['s_qty']; ?></td>
                    <td><?php echo $row['soldqty']; ?></td>
                    <?php if ($remainingstock == 0) { 
                      echo"<td style='font-weight: 500; color: green;'>$remainingstock</td>";
                     } 
                    elseif ($remainingstock > 0) { 
                     echo"<td style='font-weight: 500; color: blue;'>$remainingstock</td>";
                    }
                     else {
                     echo"<td style='font-weight: 500; color: Red;'>$remainingstock</td>";
                     } ?>
                    
                  </tr>
                <?php } ?>
                  <tfoot>
                  <tr>
                    <th>Item</th>
                    <th>Stock IN</th>  
                    <th>Stock Sold</th>
                    <th>Remaining Stock</th>
                  </tr>
                  </tfoot>
                </table>
                <!--<br><br>
                <table id="example3" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Item</th> 
                    <th>Stock Sold</th>
                  </tr>
                  </thead>
                   <tbody>
                  <?php 
                //   $totalamount=0;
                // include("include/opendb.php");
                // $query="select menue.m_item, sum(sales.sa_quantity) as qty, neworder.or_date FROM sales INNER JOIN menue ON menue.m_id= sales.m_id INNER JOIN neworder ON neworder.or_id= sales.or_id where neworder.or_date LIKE '". date("Y-m-d") ."%' group by menue.m_id having sum(sales.sa_quantity)";
                // $result= $conn->query($query) or die("Query Error");
                // foreach ($result as $row) {
                  
                 ?>
                  <tr>
                    <td><?php //echo $row['m_item']; ?></td>
                    <td><?php //echo $row['qty']; ?></td>
                  </tr>
                <?php //} ?>
                  <tfoot>
                  <tr>
                    <th>Item</th> 
                    <th>Stock Sold</th>
                  </tr>
                  </tfoot>
                </table> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <br>
            <div class="card">
              <div class="card-header">Stats</div>
              <div class="card-body">
                
                      <h4>Amount of Items IN</h4>
                      <br>
                        <?php
                        $totalamount=0;
                      $query="SELECT menue.m_itemprice, stock.s_quantity, stock.s_date, stock.s_id FROM stock LEFT JOIN menue ON stock.m_id = menue.m_id where stock.s_date BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW()";
                    $result= $conn->query($query) or die("Query Error");
                    foreach ($result as $row) {
                      $total= $row['s_quantity'] * $row['m_itemprice'];
                      $totalamount+=$total;
                         }
                       ?>
                      <div class="row">
                   <div class="col-4">
                     <h5>Stock IN</h5>
                   </div>
                   <div class="col-3">
                     <h4>RS: <?php echo $totalamount;; ?></h4>
                   </div>
                 </div>
                 <hr>
                 <br><br>
                  <h4>Total Orders</h4>
                  <br>
                <?php
                $query="select COUNT(or_customer) AS oders, or_date FROM neworder WHERE or_date LIKE '". date("Y-m-d") ."%'";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                 ?>
                 <div class="row">
                   <div class="col-4">
                     <h5>Total No of Orders :</h5>
                   </div>
                   <div class="col-3">
                     <h4> <?php echo $row['oders']; ?></h4>
                   </div>
                 </div>
                 <hr>
              <?php } ?>
              <br><br>
                  <h4>Orders taken by Employees</h4>
                  <br>
                <?php
                $query="select COUNT(neworder.e_id) AS odertaken,employees.e_name, neworder.or_date FROM neworder INNER JOIN employees ON neworder.e_id=employees.e_id WHERE or_date BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() GROUP BY neworder.e_id HAVING COUNT(neworder.e_id)";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                 ?>
                 <div class="row">
                   <div class="col-4">
                     <h5><?php echo $row['e_name']; ?></h5>
                   </div>
                   <div class="col-3">
                     <h4> <?php echo $row['odertaken']; ?></h4>
                   </div>
                 </div>
                 <hr>
              <?php } ?>
                    
                    <br><br>
                  <h4>Amount of Sold Items</h4>
                  <br>
                <?php
                $profit=0;
                $query="select sum(neworder.or_total) as total, sum(promotions.pr_rupees) as pro, sum(neworder.or_discount) as dis, sum(neworder.or_grandtotal) as gtotal, sum(neworder.or_profit) as profit from neworder INNER JOIN promotions ON promotions.pr_id = neworder.pr_id where neworder.or_date BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW()";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                  $profit=$row['profit'];
                 ?>
                 <div class="row">
                   <div class="col-4">
                     <h5>Total Sales</h5>
                   </div>
                   <div class="col-3">
                     <h4>Rs: <?php echo $row['total']; ?></h4>
                   </div>
                 </div>
                 <hr>
                 <div class="row">
                   <div class="col-4">
                     <h5>Total Promotion</h5>
                   </div>
                   <div class="col-3">
                     <h4>RS: <?php echo $row['pro']; ?></h4>
                   </div>
                 </div>
                 <hr>
                 <div class="row">
                   <div class="col-4">
                     <h5>Total Dicount</h5>
                   </div>
                   <div class="col-3">
                     <h4>Rs: <?php echo $row['dis']; ?></h4>
                   </div>
                 </div>
                 <hr>
                 <div class="row">
                   <div class="col-4">
                    <h5>Total Amount</h5>
                   </div>
                   <div class="col-3">
                     <h4>Rs:  <?php echo $row['gtotal']; ?></h4>
                   </div>
                 </div>
                 <?php if ($profit == 0) {                
                    } 
                    else{
                      ?>
                 <hr>
                 <div class="row">
                   <div class="col-4">
                    <h5>Total Profit</h5>
                   </div>
                   
                   <div class="col-3">
                     <h4>Rs:  <?php echo $row['profit']; ?></h4>
                   </div>
                 
                 </div>
              <?php  }} ?>
               <hr>
                    
                    <br><br>
                  <h4>Item Purchased</h4>
                  <br>
                <?php
                $duesremain=0;
                $query="select sum(p_price) AS totapurchase, sum(p_paid) as paid, sum(p_remaing) as remaining, sum(p_remainingpaid) as duespaid FROM perchase WHERE p_date BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW()";
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
              <br><br>
                  <h4>Utility</h4>
                  <br>
                <?php
                $query="select sum(ut_price) AS totautility FROM utility WHERE ut_date BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW()";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                  $totautility=$row['totautility'];
                 ?>
                 <div class="row">
                   <div class="col-4">
                     <h5>Total Utility</h5>
                   </div>
                   <div class="col-3">
                     <h4>Rs: <?php echo $row['totautility']; ?></h4>
                   </div>
                 </div>
                 <hr>
              <?php } ?>
              <?php if ($profit == 0) {                
              } 
              else{
                ?>
              <br><br>
                  <h4>Today's Total</h4>
                  <br>
                <?php
                $totalprofit=0;
                $totalexpance=0;
                $totalexpance=$pipaid + $piduepaid + $totautility;
                $totalprofit=$profit - $totalexpance;
                ?>
                 <div class="row">
                   <div class="col-4">
                     <h5>Total Expences Paid</h5>
                   </div>
                   <div class="col-3">
                     <h4>Rs: <?php echo $totalexpance; ?></h4>
                   </div>
                 </div>
                 <hr>
                 <div class="row">
                   <div class="col-4">
                     <h5>Total Profit</h5>
                   </div>
                   <div class="col-3">
                     <h4>Rs: <?php echo $totalprofit; ?></h4>
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
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
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