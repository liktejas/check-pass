<?php
    session_start();
    include 'connection.php';
    if(empty($_SESSION['admin_name']))
    {
        header('Location:'.$base_url.'admin.php');
    }
    $count_users_sql = "SELECT * FROM users";
    $count_users = mysqli_query($connection, $count_users_sql);
    $count_checked_in_sql = "SELECT * FROM `current_check` WHERE status=1";
    $count_checked_in = mysqli_query($connection, $count_checked_in_sql);
    $count_checked_out_sql = "SELECT * FROM `current_check` WHERE status=0";
    $count_checked_out = mysqli_query($connection, $count_checked_out_sql);
    $count_admin = mysqli_query($connection, "SELECT * FROM `admin`");
    
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

  <title>Dashboard | Check Pass</title>

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
            <h1 class="m-0 text-dark">Dashboard</h1>  
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $count_users->num_rows;?></h3>

                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $count_checked_in->num_rows;?></h3>

                <p>Checked In Users</p>
              </div>
              <div class="icon">
                <!-- <i class="ion ion-stats-bars"></i> -->
                <i class="ion ion-checkmark-circled"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $count_checked_out->num_rows;?></h3>

                <p>Checked Out Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-close-circled"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $count_admin->num_rows;?></h3>

                <p>No. of Admins</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
        </div>
      <h3><b><u>Users List</u></b></h3>
        <div class="row">
            <a href="<?php $base_url?>add_user.php" class="btn btn-primary">Add User</a>
        </div><!--row-->
        <div class="row mt-3">
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="users_table">
                <thead class="thead-dark">
                  <tr class="text-center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Created&nbsp;At</th>
                    <th>Updated&nbsp;At</th>
                    <th>Pass</th>
                    <th>Edit&nbsp;Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $fetch_users_sql = "SELECT * FROM users";
                $fetch_users = mysqli_query($connection, $fetch_users_sql);
                while($row = mysqli_fetch_assoc($fetch_users))
                {
                ?>
                  <tr class="text-center">
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['name']?></td>
                    <td><img src="uploads/<?php echo $row['img']?>" alt="" width="50" height="50"></td>
                    <td><?php echo $row['email']?></td>
                    <td><?php echo $row['contact']?></td>
                    <td><?php echo $row['created_at']?></td>
                    <td><?php echo $row['updated_at']?></td>

                    <td><a href="<?php $base_url?>pass.php?id=<?php echo $row['id']?>" class="btn btn-primary"><i class="fas fa-ticket-alt"></i></a></td>

                    <td><a href="<?php $base_url?>edit_image.php?id=<?php echo $row['id']?>" class="btn btn-warning"><i class="fas fa-image"></i></a></td>

                    <td><a href="<?php $base_url?>edit_users.php?id=<?php echo $row['id']?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a></td>

                    <td><a href="<?php $base_url?>delete_user.php?id=<?php echo $row['id']?>" onclick="return confirmDelete();" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
                    <script type="text/javascript">
                        function confirmDelete() {
                            return confirm('Are you sure to delete this user details?');
                        }
                    </script>
                  </tr>
                <?php
                }
                ?>
                </tbody>
              </table><!--table-->
            </div><!-- /.table-responsive -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->

  <?php include 'datatable_footer.php'?>