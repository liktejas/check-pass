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

  <title>Super Dashboard | Check Pass</title>

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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Super Dashboard</h1>  
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Super Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <h3><b><u>List of Admins</u></b></h3>
        <div class="row">
            <a href="<?php $base_url?>add_admin.php" class="btn btn-primary">Add Admin</a>
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
                    <th>Edit&nbsp;Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $fetch_users_sql = "SELECT * FROM admin";
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

                    <td><a href="<?php $base_url?>edit_admin_image.php?id=<?php echo $row['id']?>" class="btn btn-warning"><i class="fas fa-image"></i></a></td>

                    <td><a href="<?php $base_url?>edit_admin.php?id=<?php echo $row['id']?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a></td>

                    <td><a href="<?php $base_url?>delete_admin.php?id=<?php echo $row['id']?>" onclick="return confirmDelete();" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
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