<?php
    session_start();
    include 'connection.php';
    if(empty($_SESSION['superadmin_name']))
    {
        header('Location:'.$base_url.'superadmin.php');
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

  <title>Add Admin | Check Pass</title>

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
            if(isset($_POST['submit']))
            {
                $name = $_POST['name'];
                $username = $_POST['username'];
                $temp_password = base64_encode($_POST['password']);
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

                $insert_admin_sql = "INSERT INTO `admin`(`name`, `username`, `password`, `email`, `contact`, `img`) VALUES ('$name', '$username', '$temp_password', '$email', '$contact', '$fileName')";
                $insert_admin = mysqli_query($connection, $insert_admin_sql);
                if($insert_admin == 1)
                {
      ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Admin Registered</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
      <?php            
                }
                else
                {
      ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Failed to Register Admin</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
      <?php            
                }
                
                
            }//end isset
            ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Admin</h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Add Admin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <form action="<?php $base_url?>add_admin.php" method="post" enctype="multipart/form-data">
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="name">Name <span class="text-danger">*</span>:</label>
                    <input type="text" name="name" id="name" placeholder="Name" class="form-control mb-3" required>
                </div>
                <div class="col-md-6">
                    <label for="username">Username <span class="text-danger">*</span>:</label>
                    <input type="text" name="username" id="username" placeholder="Username" class="form-control mb-3" required>
                </div>
                <div class="col-md-6">
                    <label for="password">Temporary Password <span class="text-danger">*</span>:</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control mb-3" required>
                </div>
                <div class="col-md-6">
                    <label for="email">Email <span class="text-danger">*</span>:</label>
                    <input type="email" name="email" id="email" placeholder="Email" class="form-control mb-3" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                </div>
                <div class="col-md-6">
                    <label for="contact">Contact <span class="text-danger">*</span>:</label>
                    <input type="text" name="contact" id="contact" placeholder="Contact" class="form-control mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Image <span class="text-danger">*</span>:</label>
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