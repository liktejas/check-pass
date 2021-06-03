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

  <title>Add User | Check Pass</title>

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
            if(isset($_POST['submit']))
            {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $contact = $_POST['contact'];
                $img = $_POST['image'];

                $folderPath = "uploads/";
            
                $image_parts = explode(";base64,", $img);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
            
                $image_base64 = base64_decode($image_parts[1]);
                $t=time();
                $fileName = $name[0].$t. '.png';
            
                $file = $folderPath . $fileName;
                file_put_contents($file, $image_base64);

                $name_initial = $name[0];
                $pass_id = $name_initial.uniqid().$t;
                $pass_id = strtoupper($pass_id);
                $check_pass_id_sql = "SELECT pass_id FROM users WHERE pass_id='$pass_id'";
                $check_pass_id = mysqli_query($connection, $check_pass_id_sql);
                if($check_pass_id->num_rows > 0)
                {
                  $pass_id = $name_initial.uniqid().$t;
                  $pass_id = strtoupper($pass_id);
                }
                else
                {
                  $insert_pass_id_sql = "INSERT INTO `users`(`name`, `email`, `img`, `contact`, `pass_id`) VALUES ('$name', '$email', '$fileName', '$contact', '$pass_id')";
                  $insert_pass_id = mysqli_query($connection, $insert_pass_id_sql);
                  if($insert_pass_id == 1)
                  {
            ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>User Registered</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
            <?php
                      $insert_current_check_sql = "INSERT INTO `current_check`(`name`, `pass_id`, `status`) VALUES ('$name', '$pass_id', '1')";
                      $insert_current_check = mysqli_query($connection, $insert_current_check_sql);
                      if($insert_current_check == 1)
                      {
            ?>
                          <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>User Checked In</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
            <?php
                          $insert_user_history_sql = "INSERT INTO `check_history`(`name`, `pass_id`, `status`) VALUES ('$name', '$pass_id', '1')";
                          $insert_user_history = mysqli_query($connection, $insert_user_history_sql);
                          if($insert_user_history == 1)
                          {
            ?>
                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>User Entered in History</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
            <?php                
                          }
                          else //Failed to Enter User in History
                          {
            ?>
                              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Failed to Enter User in History</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
            <?php                
                          }
                      }
                      else //Failed to Check User
                      {
            ?>
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Failed to Check User</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
            <?php
                      }
                  }
                  else //Failed to Register User
                  {
            ?>
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Failed to Register User</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
            <?php      
                  }
                }//Else of num-rows
            }//end isset
            ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add User</h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Add User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <form action="<?php $base_url?>add_user.php" method="post" enctype="multipart/form-data">
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="name">Name <span class="text-danger">*</span>:</label>
                    <input type="text" name="name" id="name" placeholder="Name" class="form-control mb-3" required>

                    <label for="contact">Contact <span class="text-danger">*</span>:</label>
                    <input type="text" name="contact" id="contact" placeholder="Contact" class="form-control mb-3" required>
                </div>
                <div class="col-md-6">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Image:</label>
                    <div id="my_camera"></div>
                    <br/>
                    <input type=button value="Take Snapshot" onClick="take_snapshot()">
                    <input type="hidden" name="image" class="image-tag">
                </div>
                <div class="col-md-6">
                    <div class="mt-5" id="results">Your captured image will appear here...</div>
                </div>
                <div class="col-md-12 text-center">
                <br/>
                <!-- <button name="submit" class="btn btn-success mb-3">Submit</button> -->
                <input type="submit" name="submit" onclick="return confirmsubmit();" class="btn btn-success mb-3" value="Submit">
                <script type="text/javascript">
                        function confirmsubmit() {
                            return confirm('Are you sure to submit details? \nMake Sure to click "Take Snapshot Button" to take picture, before clicking "OK"');
                        }
                </script>
                <p class="text-danger">'<b>*</b>' marked are mandatory</p>
            </div>
                
            </div>
        </form>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->

  <?php include 'camera_footer.php'?>