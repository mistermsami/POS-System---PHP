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
            <h1>Invoices</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoices</li>
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
            <style>
              .card{
                padding: 25px;
              }
              table{
                width: 90%;
                margin-left: auto; 
                margin-right: auto;
              }
              th input{
                border: 0;
                width: 60px;
                font-weight: bold;
              }
              input[name=grandtotal] {
                pointer-events: none; /* Does not work */
              }
              input[name=promotion] {
                pointer-events: none; /* Does not work */
              }
              input[name=tot] {
                pointer-events: none; /* Does not work */
              }
              @media print {
                body * {
                  visibility: hidden;
                }
                .printthis * {
                  visibility: visible;
                }
                .printthis {
                  position: relative;
                  left: 0;
                  top: 0;
                }
              }
            </style>
            <form action="" method="post">
            <div class="card printthis" id="printthis">
              <h2>HILALS FOOD'S</h2>
              <?php
                $c_id = $_GET['id'];
                include("include/pdo.php");
                  $query = "select neworder.or_customer, employees.e_name, neworder.or_date FROM neworder INNER JOIN employees ON employees.e_id = neworder.e_id WHERE neworder.or_id=".$c_id."";

                  $result = $conn->query($query);
                  foreach ($result as $row) {
                 ?>
              <p>Customer Name: <b><?php echo $row['or_customer']; ?></b><span style="float:right;"><b>INVOICE</b></span></p>
              <p>Served By: <b><?php echo $row['e_name']; ?></b><span style="float:right;">Date:<?php echo $row['or_date']; ?></span></p>
            <?php } ?>
            
              <center><table>
                <thead>
                  <tr>
                    <th>ITEM</th>
                    <th>PRICE</th>
                    <th>QTY</th>
                    <th>TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $query = "select menue.m_item, menue.m_itemprice, sales.sa_quantity, sales.sa_itemtotal FROM sales INNER JOIN menue ON menue.m_id = sales.m_id WHERE sales.or_id=".$c_id."";

                    $result = $conn->query($query);
                    foreach ($result as $row) {
                      ?>
                  <tr>                
                    
                    <td><?php echo $row['m_item']; ?></td>
                    <td><?php echo $row['m_itemprice']; ?></td>
                    <td><?php echo $row['sa_quantity']; ?></td>
                    <td><?php echo $row['sa_itemtotal']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                  <th></th><br>
                  <th></th><br>
                  <th><br>SUB TOTAL:<br>DISCOUNT:<br>PROMOTION:<br>GRAND TOTAL:</th><br><?php 
                    $query = "select neworder.or_total, neworder.or_discount, promotions.pr_rupees, or_grandtotal FROM neworder INNER JOIN promotions ON promotions.pr_id = neworder.pr_id WHERE neworder.or_id=".$c_id."";

                    $result = $conn->query($query);
                    foreach ($result as $row) {
                      if ($row['pr_rupees'] != 0) {
                        $grandtot= $row['or_total'] - $row['pr_rupees'];
                      }
                      else{
                        $grandtot=$row['or_total'];
                      }
                      ?>
                  <th><br><input type="" name="tot" value="<?php echo $row['or_total']; ?>"disabled><br><input type="text" name="discount" id="discount" onchange="calculateAmount(this.value)" value="<?php echo $row['or_discount']; ?>"><br><input type="text" name="promotion" id="promotion" value="<?php echo $row['pr_rupees']; ?>"disabled><br><input type="text" id="grandtotal" name="grandtotal" value="<?php echo $grandtot; ?>"></th>
                <?php } ?>
                </tfoot>
              </table>
              </center>

              <script>
                
            function calculateAmount(val) {
              var dis = <?php echo $grandtot; ?> - val;
               var sa = document.getElementById('grandtotal');
              sa.value = dis;
            }
        </script>
            </div>
            <center><button class="btn btn-primary" name="btnsubmit">Save & Print</button></center>
              </form>
              <?php
                if (isset($_POST['btnsubmit'])) {
                  $discount = $_POST['discount'];
                  $grandtotal = $_POST['grandtotal'];

                  $query = 'update neworder set or_discount='.$discount.', or_grandtotal='.$grandtotal.' where or_id='.$c_id.'';
                  
                  $result = $conn -> query($query) or die(error);
                  echo "<script>window.location.href='lastinvoiceprint.php?id=$c_id'</script>";
                  //echo "<script>window.print()</script>";          
                }

              ?>
            
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