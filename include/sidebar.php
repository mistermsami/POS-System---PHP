 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link">
      <center><span class="brand-text font-weight-light">HILALS FOOD'S</span></center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="" class="img-circle elevation-2" >
        </div>
        <div class="info">
          <?php if(!empty($_SESSION['ad_id']))
          {
            ?>
          
          <a href="#" class="d-block"><?php  echo $_SESSION['ad_name']; ?></a>
          <?php } ?>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="home.php" class="nav-link active">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php if(!empty($_SESSION['ad_id']))
          {
            
          ?>
          <li class="nav-item">
            <a href="menue.php" class="nav-link">
              <i class="nav-icon ion ion-bag"></i>
              <p>
                Menue
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="employ.php" class="nav-link">
              <i class="nav-icon ion ion-person-add"></i>
              <p>
                Employees
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="createinvoice1.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Create Invoice
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon ion ion-bag"></i>
              <p>
                Items Purchased
                <i class="fas fa-angle-left right"></i>                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="parchase.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchased Today</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="parchaseweek.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchased In Week</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="parchasemonth.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchased In Month</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Stock
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="stock.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Today's Stock</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="stockweek.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Week Stock</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="stockmonth.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Month Stock</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Invoices
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="invoice.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Today's Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="invoiceweek.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Week Invoices</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="invoicemonth.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Month Invoices</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Utility
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="utility.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Today's Utility</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="weekutility.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Week Utilities</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="monthutility.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Month Utilities</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="dailyreport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Today's Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="weekreport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Week Reports</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="monthreport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Month Reports</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                LogOut
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" data-toggle="modal" data-target="#conformation" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Admin Details
              </p>
            </a>
          </li>
        <?php } 
        else{
          echo'<li class="nav-item">
            <a href="login.php" class="nav-link" data-toggle="modal" data-target="#exampleModalCenter">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Login
              </p>
            </a>
          </li>';
        } ?>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Hilal's Food Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <main class="form-signin">
  <form action="" method="POST">
    
    <h1 class="h3 mb-3 fw-normal"></h1>

    <div class="form-floating">
      <label for="floatingInput" style="float:left;">Uesename</label>
      <input type="text" name="username" class="form-control" id="floatingInput" placeholder="username" required>
      
    </div>
    <div class="form-floating">
      <label for="floatingPassword" style="float:left;">Password</label>
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
      
    </div>
    <!-- <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div> -->
    <br>
    <button class="w-100 btn btn-lg btn-primary" type="submit" name="btnsubmitad">Login</button>
  </form>
</main>
<?php

    include("include/pdo.php");
  if (isset($_POST['btnsubmitad'])) {
    
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query="select * from admin where ad_name='$username' and ad_password='$password'";
        $result=$conn->query($query);
        $rowcount=$result->rowCount();
  if($rowcount>0) {
    foreach ($result as $row) {
        $_SESSION['ad_id']=$row['ad_id'];
        $_SESSION['ad_name']=$row['ad_name'];
        $_SESSION['ad_password']=$row['ad_password'];

         echo "<script>window.location.href='home.php' </script>";


    }
  }
  else{
    echo "<script type='text/javascript'>alert('Invailed Email or Password!')</script>";
  }
  }
  ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="conformation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Admin Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <main class="form-signin">
  <form action="" method="POST">
    
    <h1 class="h3 mb-3 fw-normal"></h1>

    <div class="form-floating">
      <label for="floatingInput" style="float:left;">Uesename</label>
      <input type="text" name="username" class="form-control" id="floatingInput" placeholder="username" required>
      
    </div>
    <div class="form-floating">
      <label for="floatingPassword" style="float:left;">Password</label>
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
      
    </div>
    <!-- <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div> -->
    <br>
    <button class="w-100 btn btn-lg btn-primary" type="submit" name="btnsubmittc">Login</button>
  </form>
</main>
<?php
  if (isset($_POST['btnsubmittc'])) {
    
        $username = $_POST['username'];
        $password = $_POST['password'];


        if (($username == $_SESSION['ad_name']) || ($password == $_SESSION['ad_password'])){
          // echo "<script type='text/javascript'>alert('good')</script>";
          echo "<script type='text/javascript'>window.location.href='admininfo.php'</script>";
        }

  else{
    echo "<script type='text/javascript'>window.location.href='logout.php'</script>";
  }
  }
  ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>