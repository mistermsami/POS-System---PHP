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
	<title>Month Invoices</title>
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
            <h1>Month Invoices</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Month Invoices</li>
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
                <h3 class="card-title">Month Invoices</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Date</th>
                    <th>Serial No</th> 
                    <th>Invoice No</th> 
                    <th>Served By</th>                  
                    <th>Total</th>
                    <th>Details</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                include("include/opendb.php");
                $query="select neworder.or_id, neworder.invoiceno, neworder.or_date, neworder.or_grandtotal, employees.e_name from neworder left join employees on neworder.e_id = employees.e_id where neworder.or_date BETWEEN (NOW() - INTERVAL 1 MONTH) AND NOW()";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                 ?>
                  <tr>
                    
                    <td><?php echo $row['or_date']; ?></td>
                    <td><?php echo $row['or_id']; ?></td>
                    <td><?php echo $row['invoiceno']; ?></td>
                    <td><?php echo $row['e_name']; ?></td>                   
                    <td><?php echo $row['or_grandtotal']; ?></td>
                    <td style="font-weight: 600;text-align: center;"><a href="invoicedetails.php?id=<?php echo $row['or_id']; ?>">View</a></td>
                  </tr>
                <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Date</th>
                    <th>Serial No</th> 
                    <th>Invoice No</th>  
                    <th>Order Taken</th>                 
                    <th>Total</th>
                    <th>Details</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <br>
            <div class="card">
              <div class="card-header">Stats</div>
              <div class="card-body">
                <h4>Cancelled Oders</h4>
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Serial No</th> 
                    <th>Invoice No</th> 
                    <th>Total</th>                  
                    <th>Order Date</th>
                    <th>Cancel Reason</th>
                    <th>Cancel Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                $query="SELECT or_id, invoiceno, or_grandtotal, or_date, orcancelreasonradio, orcancelreason, orcanceldate FROM cancelorder WHERE orcanceldate BETWEEN (NOW() - INTERVAL 1 MONTH) AND NOW()";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                 ?>
                  <tr>
                    
                    <td><?php echo $row['or_id']; ?></td>
                    <td><?php echo $row['invoiceno']; ?></td>
                    <td><?php echo $row['or_grandtotal']; ?></td>
                    <td><?php echo $row['or_date']; ?></td>                   
                    <td><?php echo $row['orcancelreason']; ?></td>
                    <td><?php echo $row['orcanceldate']; ?></td>
                    
                  </tr>
                <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Serial No</th> 
                    <th>Invoice No</th> 
                    <th>Total</th>                  
                    <th>Order Date</th>
                    <th>Cancel Reason</th>
                    <th>Cancel Date</th>
                  </tr>
                  </tfoot>
                </table>
                <br>
                
                    
                    <?php
                       // $query="select menue.m_item, sum(stock.s_quantity) as stq, stock.s_date FROM stock INNER JOIN menue ON menue.m_id= stock.m_id WHERE stock.s_date= '". date("Y-m-d") ."' group by menue.m_id having sum(stock.s_quantity)";
                       // $result= $conn->query($query) or die("Query Error");
                       // foreach ($result as $row) {
                       //  $item=$row['m_item'];
                       //  $stin=$row['stq'];
                        ?>
                        <?php //echo $item; ?>
                        <?php //echo $stin; ?>
                      <?php //} ?>
                      <h4>Sold Items</h4>
                      <br>
                        <?php
                      $qu="select menue.m_item, sum(sales.sa_quantity) as qty, neworder.or_date FROM sales INNER JOIN menue ON menue.m_id= sales.m_id INNER JOIN neworder ON neworder.or_id= sales.or_id where neworder.or_date BETWEEN (NOW() - INTERVAL 1 MONTH) AND NOW() group by menue.m_id having sum(sales.sa_quantity)";

                      
                      $rs= $conn->query($qu) or die("Query Error");
                      
                        foreach ($rs as $row) {
                         
                       ?>
                      <div class="row">
                   <div class="col-4">
                     <h6><?php echo $row['m_item']; ?></h6>
                   </div>
                   <div class="col-3">
                     <h6><?php echo $row['qty']; ?></h6>
                   </div>
                 </div>
                 <hr>
                    <?php } ?>
                    <br><br>
                  <h4>Amount of Sold Items</h4>
                  <br>
                <?php
                $query="select sum(neworder.or_total) as total, sum(promotions.pr_rupees) as pro, sum(neworder.or_discount) as dis, sum(neworder.or_grandtotal) as gtotal, sum(neworder.or_profit) as profit from neworder INNER JOIN promotions ON promotions.pr_id = neworder.pr_id where neworder.or_date BETWEEN (NOW() - INTERVAL 1 MONTH) AND NOW()";
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
              <?php } } ?>
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