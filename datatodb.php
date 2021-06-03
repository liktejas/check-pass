<?php

include 'connection.php';

$code = $_POST['code'];


$check_user_sql = "SELECT pass_id FROM users WHERE pass_id='$code'";
$check_user = mysqli_query($connection, $check_user_sql);
if($check_user->num_rows == 1)
{
	// echo 'User Found';
	// Check if user is checked in or not
	$check_status_sql = "SELECT status FROM current_check WHERE pass_id='$code'";
	$check_status = mysqli_query($connection, $check_status_sql);
	if($check_status->num_rows == 1)
	{
		// echo 'Status Found';
		$get_status = mysqli_fetch_assoc($check_status);
		$status = $get_status['status'];
		// If user is checked out
		if($status == 0)
		{
			// echo 'status 0';
			$change_status_sql = "UPDATE `current_check` SET `status`= 1 WHERE pass_id='$code'";
			$change_status = mysqli_query($connection, $change_status_sql);
			// print_r($change_status);
			// Get info of user to insert into history
			$user_info_sql = "SELECT * FROM users WHERE pass_id='$code'";
			$user_info = mysqli_query($connection, $user_info_sql);
			// print_r($user_info);
			if($user_info->num_rows == 1)
			{
				$user_sql = mysqli_fetch_assoc($user_info);
				// print_r($user_sql);
				$name = $user_sql['name'];
				$insert_history_sql = "INSERT INTO `check_history`(`name`, `pass_id`, `status`) VALUES ('$name','$code','1')";
				$insert_history = mysqli_query($connection,$insert_history_sql);
				if($insert_history == 1)
				{
					echo 'Checked In Successfully';
				}
				else
				{
					echo 'Failed to Check In';
				}
			}

		}
		// If user is checked in
		else
		{
			// echo 'status 1';
			$change_status_sql = "UPDATE `current_check` SET `status`= 0 WHERE pass_id='$code'";
			$change_status = mysqli_query($connection, $change_status_sql);
			// print_r($change_status);
			$user_info_sql = "SELECT * FROM users WHERE pass_id='$code'";
			$user_info = mysqli_query($connection, $user_info_sql);
			// print_r($user_info);
			if($user_info->num_rows == 1)
			{
				$user_sql = mysqli_fetch_assoc($user_info);
				// print_r($user_sql);
				$name = $user_sql['name'];
				$insert_history_sql = "INSERT INTO `check_history`(`name`, `pass_id`, `status`) VALUES ('$name','$code','0')";
				$insert_history = mysqli_query($connection,$insert_history_sql);
				if($insert_history == 1)
				{
					echo 'Checked Out Successfully';
				}
				else
				{
					echo 'Failed to Check Out';
				}
			}
		}
	}
	else
	{
		echo 'No Status Found';
	}
}
else
{
	echo 'No User Found';
}
// $res = mysqli_fetch_assoc($check_user);
// echo $res['pass_id'];
// $sql = "INSERT INTO `users`(`pass_id`) VALUES ('$code')";
// $sql_result = mysqli_query($connection, $sql);
// if($sql_result == '1')
// {
// 	echo "Code Inserted";
// }
// else
// {
// 	echo "Code Not Inserted";
// }

?>