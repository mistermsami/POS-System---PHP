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
	<title>Hilals Food</title>
	<?php include('include/headlinks.php') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include('include/nav.php') ?>
		<?php include('include/sidebar.php') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create Invoice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Create Invoice</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <!-- general form elements disabled -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Order Info</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="purchase.php" method="post">
                  
                  <table class="table table-striped table-bordered">
      <thead>
        <th class="text-center"><input type="checkbox" id="checkAll" onclick="toggle(this);"></th>
        <!-- <th>Category</th> -->
        <th>Product Name</th>
        <th>Price</th>
        <th>Quantity</th>
      </thead>
      <tbody>
        <?php 
        include("include/opendb.php");
          $sql="select * from menue";
          $query=$conn->query($sql);
          //$query= $conn->query($sql) or die("Query Error");
          $iterate=0;
          while($row=$query->fetch_array()){
            ?>
            <tr>
              <td class="text-center"><input type="checkbox" value="<?php echo $row['m_id']; ?>||<?php echo $iterate; ?>" name="m_id[]" style=""></td>
              <td><?php echo $row['m_item']; ?></td>
              <td class="text-right">&#x20A8; <?php echo number_format($row['m_itemprice'], 2); ?></td>
              <td><input type="text" class="form-control" name="quantity_<?php echo $iterate; ?>"></td>
            </tr>
            <?php
            $iterate++;
          }
        ?>
      </tbody>
    </table>
    <div class="row">
      <div class="col-md-3 col-sm-4">
        <input type="text" name="customer" class="form-control" placeholder="Customer Name" required>
      </div>
      <div class="col-md-3 col-sm-4">
        <select class="form-control" id="servedby" name="servedby" style="width:100%;">
          <?php 
                include("include/opendb.php");
                $query="select * from employees";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                 ?>
          <option value="<?php echo $row['e_id']; ?>"><?php echo $row['e_name']; ?></option>
        <?php } ?>
        </select>
      </div>
      <div class="col-md-3 col-sm-4">
        <select class="form-control" id="promo" name="promo" style="width:100%;">
          <?php 
                $query="select * from promotions";
                $result= $conn->query($query) or die("Query Error");
                foreach ($result as $row) {
                 ?>
          <option value="<?php echo $row['pr_id']; ?>"><?php echo $row['pr_name']; ?> RS:<?php echo $row['pr_rupees']; ?></option>
        <?php } ?>
        </select>
        <br>
      </div>
      
      <div class="col-md-3" style="margin-left:20px;">
        <button style="width: 120px; height: 45px; font-weight: 700; font-size: 20px;" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
      </div>
    </div>

                </form>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
         
  </div>
</section>
<script type="text/javascript">
  // $(document).ready(function(){
  //   $("#checkAll").click(function(){
  //       $('input:checkbox').not(this).prop('checked', this.checked);
  //   });
  // });
  function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script> 
  <!-- /.content-wrapper -->

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- <footer class="main-footer">
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-rc
    </div>
  </footer> -->

</body>
<?php include('include/jslinks.php') ?>
</html>