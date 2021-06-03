<?php
    session_start();
    include 'connection.php';
    if(empty($_SESSION['superadmin_name']))
    {
        header('Location:'.$base_url.'superadmin.php');
    }
    date_default_timezone_set('Asia/Calcutta');
    $id = $_GET['id'];
    $get_user_details_sql = "SELECT * FROM `admin` WHERE id=$id";
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

  <title>Edit Image | Check Pass</title>

<?php include 'super_above_sidebar.php'?>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $base_url?>super_dashboard.php" class="nav-link active">
                  <i class="fas fa-tachometer-alt nav-icon"></i>
                  <p>Super Dashboard</p>
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

            $old_image_sql = "SELECT img FROM `admin` WHERE id=$id";
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

            $update_user_details_sql = "UPDATE `admin` SET `img` = '$fileName', `updated_at`='$updated_at' WHERE `id` = $id";
            $update_user_details = mysqli_query($connection, $update_user_details_sql);
            if($update_user_details == 1)
            {
       ?>
                <script>window.location="<?php echo $base_url?>super_dashboard.php";</script>
       <?php
            }
            else
            {
       ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed to Update User Image</strong>
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
            <h1 class="m-0 text-dark">Edit Admin Image</h1>  
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Edit Admin Image</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <form action="<?php $base_url?>edit_admin_image.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
          <div class="row">
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