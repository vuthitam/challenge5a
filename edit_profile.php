<?php
	session_start();
	if (!isset($_SESSION['username'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	}
    include("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<title>List</title>
</head>
<body>

<?php

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}

	if (isset($_POST["submit"])) {
		$password = $_POST["password"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		if (isset($_POST['username'])) {
			$username_edit = $_POST['username'];
			if (isset($_POST['hoten'])) {
				$hoten = $_POST['hoten'];
				$sql_update = "UPDATE users SET username = '$username_edit', hoten = '$hoten', password = '$password', email = '$email', phone = '$phone' WHERE id = '$id'";
			} else {
				$sql_update = "UPDATE users SET username = '$username_edit', password = '$password', email = '$email', phone = '$phone' WHERE id = '$id'";
			}
		} else {
			$sql_update = "UPDATE users SET password = '$password', email = '$email', phone = '$phone' WHERE id = '$id'";
		}
		$connect->query($sql_update);
		echo '<script language="javascript">alert("Profile edited!"); window.location="index.php"</script>';
	}

	if (isset($_GET['role'])) {
		$role = $_GET['role'];
	}

	$username = $_SESSION['username'];
	$sql_check_role = "SELECT role, username FROM users WHERE username = '$username'";
	$result = $connect->query($sql_check_role);
	$row_ = mysqli_fetch_array($result);
	if ($row_['role'] != "teacher") {
		if ($row_['role'] === "student") {
			if ($username != $row_['username']) {
				echo '<script language="javascript">alert("You don\'t have permision!"); history.back()</script>';
			}
		} else {
			echo '<script language="javascript">alert("You don\'t have permision!"); history.back()</script>';
		}
	}

?>

	<form action="edit_profile.php?id=<?php echo $id; ?>&role=<?php echo $role; ?>" method="post">
		<table>
			<tr>
				<td>
					<h3>Edit information of user</h3>
				</td>
			</tr>
			<?php
			$sql = "SELECT * FROM users WHERE id = ".$id;
			$result = $connect->query($sql);
			$row = mysqli_fetch_array($result);
			$username = $row['username'];
			?>
			<tr>
				<td>Username:</td>
				<?php
					if ($row_['role'] === "teacher") {
						echo "<td><input type=\"text\" name=\"username\" value=\"".$row['username']."\"></td>";
					} else {
						echo "<td><input type=\"text\" name=\"username\" value=\"".$row['username']."\" disabled=\"\"></td>";
					}
				?>
				
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="text" name="password" value="<?php echo $row['password']; ?>"></td>
			</tr>
				<td>Họ và tên:</td>
				<?php
					if ($row_['role'] === "teacher") {
						echo "<td><input type=\"text\" name=\"fullname\" value=\"".$row['hoten']."\"></td>";
					} else {
						echo "<td><input type=\"text\" name=\"fullname\" value=\"".$row['hoten']."\" disabled=\"\"></td>";
					}
				?>
			<tr>
				<td>Email:</td>
				<td><input type="text" name="email" value="<?php echo $row['email']; ?>"></td>
			</tr>
			<tr>
				<td>Mobile:</td>
				<td><input type="text" name="phone" value="<?php echo $row['phone']; ?>"></td>
			</tr>
			<tr>
				<td><input type="submit" name="submit" value="Save"></td>
			</tr>

		</table>
	</form>

</body>
</html>
