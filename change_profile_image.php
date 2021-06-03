<?php
    session_start();
    include 'connection.php';
    if(empty($_SESSION['admin_name']))
    {
        header('Location:'.$base_url.'admin.php');
    }
    date_default_timezone_set('Asia/Calcutta');
    $admin_id = $_SESSION['admin_id'];
    $get_admin_details_sql = "SELECT * FROM `admin` WHERE id=$admin_id";
    $get_admin_details = mysqli_query($connection, $get_admin_details_sql);
    if($get_admin_details->num_rows > 0)
    {
        $res = mysqli_fetch_assoc($get_admin_details);
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

  <title>Change Profile Image | Check Pass</title>

<?php include 'above_sidebar.php'?>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $base_url?>dashboard.php" class="nav-link">
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
                <a href="<?php echo $base_url?>change_profile_image.php" class="nav-link active">
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
        if(isset($_POST['update_image']))
        {
            $img = $_POST['image'];
            $name = $res['name'];
            
            $folderPath = "uploads/";
            
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            
            $image_base64 = base64_decode($image_parts[1]);
            $t=time();
            $fileName = $name[0].$t. '.png';
            
            $file = $folderPath . $fileName;

            $old_image_sql = "SELECT img FROM `admin` WHERE id=$admin_id";
            $fetch_old_image = mysqli_query($connection, $old_image_sql);
            if($fetch_old_image->num_rows > 0)
            {
              $old_image = mysqli_fetch_assoc($fetch_old_image);
              $old_image = $old_image['img'];
              unlink('uploads/'.$old_image);
              file_put_contents($file, $image_base64);
            }
            $date = date('Y-m-d');
            $time = date('H:i:s');
            $updated_at = $date." ".$time;

            $update_user_details_sql = "UPDATE `admin` SET `img` = '$fileName', `updated_at`='$updated_at' WHERE `id` = $admin_id";
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
                    <strong>Failed to Update Admin Image</strong>
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
            <h1 class="m-0 text-dark">Change Profile Image</h1>  
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Change Profile Image</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <form action="<?php $base_url?>change_profile_image.php" method="post" enctype="multipart/form-data">
          <div class="row mt-3">
            <div class="col-md-6">
              <div class="text-center">
                <center><div id="my_camera"></div>
                <br/>
                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                <input type="hidden" name="image" class="image-tag">
                </center>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mt-3" id="results">Your captured image will appear here...</div>
            </div>
            <div class="col-md-12 text-center">
              <br/>
              <!-- <button name="submit" class="btn btn-success mb-3">Submit</button> -->
              <input type="submit" name="update_image" onclick="return confirmsubmit();" class="btn btn-success mb-3" value="Update Image">
              <script type="text/javascript">
                  function confirmsubmit() {
                    return confirm('Are you sure to submit details? \nMake Sure to click "Take Snapshot Button" to take picture, before clicking "OK"');
                  }
              </script>
            </div>
          </div>
          <!-- /.row -->
        </form>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->

  <?php include 'camera_footer.php'?>