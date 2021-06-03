<?php
    session_start();
    include 'connection.php';
    if(empty($_SESSION['admin_name']))
    {
        header('Location:'.$base_url.'admin.php');
    }
    date_default_timezone_set('Asia/Calcutta');
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

  <title>Edit User | Check Pass</title>

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
      <?php
        if(isset($_POST['submit_changes']))
        {
            $name = $_POST['name'];
            $contact = $_POST['contact'];
            $email = $_POST['email'];
            $date = date('Y-m-d');
            $time = date('H:i:s');
            $updated_at = $date." ".$time;

            // echo $name." ".$contact." ".$email." ".$updated_at;
            $update_user_details_sql = "UPDATE `users` SET `name` = '$name', `contact` = '$contact', `email` = '$email', `updated_at` = '$updated_at' WHERE `id` = $id";
            $update_user_details = mysqli_query($connection, $update_user_details_sql);
            if($update_user_details == 1)
            {
       ?>
                <script>window.location="<?php echo $base_url?>dashboard.php";</script>
       <?php
            }
            else
            {
       ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed to Update User</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
       <?php         
            }
        }
      ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit User</h1>  
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Edit User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-4 offset-4">
                <form action="" method="post">
                    <label for="name">Name <span class="text-danger">*</span>:</label>
                    <input type="text" name="name" id="name" placeholder="Name" value="<?php echo $res['name']?>" class="form-control mb-3" required>

                    <label for="contact">Contact <span class="text-danger">*</span>:</label>
                    <input type="text" name="contact" id="contact" placeholder="Contact" value="<?php echo $res['contact']?>" class="form-control mb-3" required>

                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Email" value="<?php echo $res['email']?>" class="form-control mb-4" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary" value="Submit Changes" name="submit_changes">
                    </div>
                    <p class="text-danger text-center mt-3">'<b>*</b>' marked are mandatory</p>
                </form>
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
