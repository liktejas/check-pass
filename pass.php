<?php
    session_start();
    include 'connection.php';
    if(empty($_SESSION['admin_name']))
    {
        header('Location:'.$base_url.'admin.php');
    }
    $id = $_GET['id'];
    $get_user_details_sql = "SELECT * FROM users WHERE id=$id";
    $get_user_details = mysqli_query($connection, $get_user_details_sql);
    if($get_user_details->num_rows > 0)
    {
        $res = mysqli_fetch_assoc($get_user_details);
    }
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>User Pass | Check Pass</title>

<?php include 'above_sidebar.php'?>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $base_url?>dashboard.php" class="nav-link active">
                  <i class="fas fa-tachometer-alt nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $base_url?>current_check.php" class="nav-link">
                  <i class="fas fa-user-check nav-icon"></i>
                  <p>Current Check</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $base_url?>check_history.php" class="nav-link">
                  <i class="fas fa-history nav-icon"></i>
                  <p>Check History</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Profile Details
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $base_url?>change_profile_details.php" class="nav-link">
                  <i class="far fa-id-card nav-icon"></i>
                  <p>Change Profile Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $base_url?>change_profile_image.php" class="nav-link">
                  <i class="fas fa-id-badge nav-icon"></i>
                  <p>Change Profile Image</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">User Pass</h1>  
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">User Pass</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content offset-3">
      <div class="container-fluid">
        <div class="row mt-3" id="div1">
          <div class="col-md-7 border border-dark">
            <div class="row mt-3">
              <div class="col-md-2">
                  <center><img src="assets/dist/img/id-card128.png" alt="Check Pass Logo" width="75" class="mt-2"></center>
              </div>
              <div class="col-md-8">
                  <h1 class="text-center">CHECK PASS</h1>
                  <p class="text-center">Company / Society Name, Place</p>
              </div>
              <div class="col-md-1">
              </div>
            </div>

            <hr style="text-align:left;margin-left:0;border: 1px solid black;">

            <div class="row mt-3">
              <div class="col-md-3">
                <center><img src="<?php echo $base_url?>uploads/<?php echo $res['img']?>" alt="avatar" width="150"></center>
              </div>
              <div class="col-md-5">
                <h6>&emsp;&emsp;<b>Name:</b></h6>
                <h6>&emsp;&emsp;<?php echo $res['name']?></h6>
                <h6>&emsp;&emsp;<b>Email:</b></h6>
                <h6>&emsp;&emsp;<?php echo $res['email']?></h6>
                <h6>&emsp;&emsp;<b>Contact:</b></h6>
                <h6>&emsp;&emsp;<?php echo $res['contact']?></h6>
              </div>
              <div class="col-md-4">
                <center><img src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo $res['pass_id']; ?>" alt="avatar" width="150"></center>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->

        <!-- <button class="btn btn-success">Print</button> -->
        <div class="row offset-3 mt-5">
          <div class="col-md-12">
              <button class="btn btn-success" onclick="printContent('div1')">Print</button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <script>
        function printContent(el) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
        }
    </script>

  <?php include 'footer.php'?>