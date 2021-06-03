<?php
    session_start();
    include 'connection.php';
    if(empty($_SESSION['admin_name']))
    {
        header('Location:'.$base_url.'admin.php');
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

  <title>Contact | Check Pass</title>

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
            <h1 class="m-0 text-dark">Contact</h1>  
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Contact</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-md-12">
                <h2 style="font-family: 'Proza Libre', sans-serif;">Lorem Technology & Solutions Pvt Ltd</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h5><i class="fas fa-envelope"></i> : <a href="mailto:example@example.com">example@example.com</a></h5>
                <h5><i class="fas fa-phone-alt"></i> : <a href="tel:5554280940">5554280940</a></h5>
                <h5><i class="fas fa-globe"></i> : <a href="http://www.example.com" target="_blank">Example.com</a></h5>
            </div>
            <div class="col-md-8">
                <h5><i class="fab fa-facebook"></i> : <a href="https://www.facebook.com/pages/category/Interest/Example-Account-197494372329/" target="_blank">Lorem Technology & Solutions Pvt Ltd (Official FB Page)</a></h5>
                <h5><i class="fab fa-twitter"></i> : <a href="https://twitter.com/" target="_blank">Lorem Technology & Solutions Pvt Ltd (Official Twitter Page)</a></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="embed-responsive embed-responsive-21by9">
                    <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d29818.374447855116!2d74.77708940978661!3d20.900375198233316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1594810207121!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->

  <?php include 'footer.php'?>