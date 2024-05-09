<?php

session_start();

// if(empty($_SESSION['ad_id']))
// {
//   header("location:home.php");
// }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Print Invoice</title>
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
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
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
                /*margin-left: auto; 
                margin-right: auto;*/
              }
              .amount{
                width: 90%;
                margin-top: 10px;
                
              }
              .pricet{
                float: right;
                margin-right: -70px;
              }
              .brand img{
                height: 170px;
                width: 60%;
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
                  padding: 0;
                  padding-top: 10px;
                  padding-left: 0;
                  margin-left: 0;
                  padding-bottom: 10px;
                  margin: 0;
                  width: 42%;
                  left: 0;
                  top: 0;
                }
                .brand img{
                  height: 90px;
                  width: 60%;
                  margin-top: 5px;
                  margin-bottom: 7px;
                }
                .amount{
                width: 95%;
              }
              .head{
                font-size: 14px;
              }
              .card{
                padding: 1px;
              }
              table{
                width: 95%;
              }
              }
            </style>
            <div class="card printthis" id="printthis">
              <div class="brand">
              <center><!-- <img src="images/hilalz.png"> --><h2>HILALS FOOD'S</h2></center>
              <br>
            </div>
              <?php
                $c_id = $_GET['id'];
                // $invoiceno=0;
                include("include/pdo.php");
                $que = "select count(or_id) as invoiceno from neworder where or_date like'". date("Y-m-d") ."%'";

                  $res = $conn->query($que);
                  foreach ($res as $row) {
                    $invoiceno=$row['invoiceno'];
                  }
                  $query = "select neworder.or_id, employees.e_name, neworder.or_date FROM neworder INNER JOIN employees ON employees.e_id = neworder.e_id WHERE neworder.or_id=".$c_id."";

                  $result = $conn->query($query);
                  foreach ($result as $row) {
                    $inodid=$row['or_id'];
                 ?>
              <p>INVOICE NO: <b><?php echo $invoiceno;  ?></b><b style="float:right">NOT FOR CUSTOMER</b><br>SERIAL NO: <b><?php echo $inodid;  ?></b><br>ORDER TAKEN: <b><?php echo $row['e_name']; ?></b><br><span style="float:left;">DATE: <b><?php echo $row['or_date']; ?></b></span></p>
              
            <?php } ?>
            <style>
              td:after {
                /*content: " ";
                display: block;
                border-bottom: 0.5px solid #9E9E9E;*/
              }
              tr {
  border-bottom: 1px solid black;
}
            </style>
              <center><table style="">
                <thead>
                  <tr>
                    <th>ITEM</th>
                    <th>QTY</th>
                    <th>PRICE</th>
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
                      <td><b><?php echo $row['m_item']; ?></b></td>
                      <td><b><?php echo $row['sa_quantity']; ?></b></td>
                      <td><b><?php echo number_format($row['m_itemprice']); ?></b></td>
                      <td><b><?php echo number_format($row['sa_itemtotal']); ?></b></td>
                    </tr>
                    
                    <?php } ?>
                </tbody>
                </table>
                <div class="amount" >
                  <?php 
                    $query = "select neworder.or_total, neworder.or_discount, neworder.or_disamt, promotions.pr_rupees, promotions.pr_name, or_grandtotal FROM neworder INNER JOIN promotions ON promotions.pr_id = neworder.pr_id WHERE neworder.or_id=".$c_id."";

                    $result = $conn->query($query);
                    foreach ($result as $row) {
                    ?>
                    <div class="total">
                  <div class="row" >
                  <div class="col-7 text-left" style="">SUB TOTAL:</div>
                  <div class="col-5 pricet"><b><?php echo number_format($row['or_total'],2); ?></b></div>
                
                  <div class="col-7 text-left" style="">DISCOUNT:&nbsp;<b><?php echo $row['or_discount']; ?>%</b></div>
                  <div class="col-5 pricet"><b><?php echo number_format($row['or_disamt'],2); ?></b></div>
                
                  <div class="col-7 text-left" style="">PROMOTION:&nbsp;<b><?php echo $row['pr_name']; ?></b></div>
                  <div class="col-5 pricet"><b><?php echo number_format($row['pr_rupees'],2); ?></b></div>
                
                  <div class="col-7 text-left" style="">GRAND TOTAL:</div>
                  <div class="col-5 pricet ffl"><b><?php echo number_format($row['or_grandtotal'],2); ?></b></div>
                </div>
              </div>
                <?php } ?>
                <br>
                <center><b>NOT FOR CUSTOMER</b></center>
                <br>
                </div>
                
              
              </center>
            </div>
            <center><button class="btn btn-primary" onclick="history.back()">Back</button>
            <button class="btn btn-secondary" data-toggle="modal" data-target="#cencelorder">Cancel</button></center>
            <br>
             
                    <!-- Modal -->
                  <div class="modal fade" id="cencelorder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Order Cancel Conformation</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <main class="form-signin">
                    <form action="" method="POST">
                      <?php 
                        $query = "select * from neworder where or_id=".$c_id."";
                        $result = $conn->query($query);
                        foreach ($result as $row) {
                      ?>
                            <input class="form-control" type="hidden" name="or_id" value="<?php echo $row['or_id']; ?>">
                            <input class="form-control" type="hidden" name="invoiceno" value="<?php echo $row['invoiceno']; ?>">
                            <input class="form-control" type="hidden" name="e_id" value="<?php echo $row['e_id']; ?>">
                            <input class="form-control" type="hidden" name="or_discount" value="<?php echo $row['or_discount']; ?>">
                            <input class="form-control" type="hidden" name="pr_id" value="<?php echo $row['pr_id']; ?>">
                            <input class="form-control" type="hidden" name="or_grandtotal" value="<?php echo $row['or_grandtotal']; ?>">
                            <input class="form-control" type="hidden" name="or_date" value="<?php echo $row['or_date']; ?>" >
                          <?php } ?>
                        <!-- <div class="row"> -->
                          <label for="frd">Order Cancellation Reason</label>
                          <div id="frd">
                          <div class="form-check">
                            <b><input class="form-check-input rdb" type="radio" name="orcancelreasonradio" id="flexRadioDefault1" value="Order Cancelled" required>Order Cancelled</b>
                          </div>
                          <div class="form-check">
                            <b><input class="form-check-input rdb" type="radio" name="orcancelreasonradio" id="flexRadioDefault2" value="Change of mind">Change of mind</b>
                          </div>
                          <div class="form-check">
                            <b><input class="form-check-input rdb" type="radio" name="orcancelreasonradio" id="flexRadioDefault3" value="Odered by mistake">Odered by mistake</b>
                          </div>
                        </div>
                        <br>
                        <!-- </div> -->
                        <div class="col-12">
                          <label for="textareat">Cancellation Reason Details</label>
                          <textarea class="form-control" id="textareat" name="orcancelreason" rows="2" placeholder="(Optional)"></textarea>
                        </div>
                      <br>
                      <center><button class="w-55 btn btn-lg btn-primary" type="submit" name="cancelbtn">Cancel Order</button></center>
                    </form>
                  </main>
                  <?php 
                    if (isset($_POST['cancelbtn'])) {
                          $or_id= $_POST['or_id'];
                          $invoiceno=$_POST['invoiceno'];
                          $e_id=$_POST['e_id'];
                          $or_discount=$_POST['or_discount'];
                          $pr_id=$_POST['pr_id'];
                          $or_grandtotal=$_POST['or_grandtotal'];
                          $or_date=$_POST['or_date'];
                          $orcancelreasonradio= $_POST['orcancelreasonradio'];
                          $orcancelreason= $_POST['orcancelreason'];
                        $query = "insert into cancelorder (or_id, invoiceno, e_id, or_discount, pr_id, or_grandtotal, or_date, orcancelreasonradio, orcancelreason, orcanceldate) values ('$or_id', '$invoiceno', '$e_id', '$or_discount', '$pr_id', '$or_grandtotal', '$or_date', '$orcancelreason', '$orcancelreasonradio', NOW())";
                        $result = $conn -> query($query) or die(error); 
                        echo "<script>window.location.href='deleteinvoice.php?id=".$c_id."'</script>";
                      }
                    ?>
                    </div>
                    
                  </div>
                </div>
              </div>
              091-5273712
            
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