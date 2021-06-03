<?php

include 'connection.php';
$id = $_GET['id'];
$find_img_sql = "SELECT * FROM `users` WHERE id=$id";
$find_img = mysqli_query($connection, $find_img_sql);
if($find_img->num_rows > 0)
{
    $img = mysqli_fetch_assoc($find_img);
    unlink('uploads/'.$img['img']);
}
$delete_user_sql = "DELETE FROM `users` WHERE id=$id";
$delete_user = mysqli_query($connection, $delete_user_sql);
if($delete_user == 1)
{
    $delete_check_user_sql = "DELETE FROM `current_check` WHERE id=$id";
    $delete_check_user = mysqli_query($connection, $delete_check_user_sql);
    if($delete_check_user == 1)
    {
?>
        <script>window.location="<?php echo $base_url?>dashboard.php";</script>
<?php
    }
    else
    {
?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed to Delete User From Check</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
<?php
    }
}
else
{
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed to Delete User</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
<?php
}

?>