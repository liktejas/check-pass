<?php

include 'connection.php';
$id = $_GET['id'];
$find_img_sql = "SELECT img FROM `admin` WHERE id=$id";
$find_img = mysqli_query($connection, $find_img_sql);
if($find_img->num_rows > 0)
{
    $img = mysqli_fetch_assoc($find_img);
    unlink('uploads/'.$img['img']);
}
$delete_admin_sql = "DELETE FROM `admin` WHERE id=$id";
$delete_admin = mysqli_query($connection, $delete_admin_sql);
if($delete_admin == 1)
{
?>
    <script>window.location="<?php echo $base_url?>super_dashboard.php";</script>
<?php
}
else
{
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed to Delete Admin</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
<?php
}

?>