<?php
	if(!isset($_SESSION)){
        session_start();
    }
	if (!isset($_SESSION['username'])||!isset($_SESSION['id'])||!isset($_SESSION['role'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	} else {
        $username_avatar = $_SESSION['username'];
        $id = $_SESSION['id'];
        $role  = $_SESSION['role'];
    }

	if (isset($_GET['id'])) {
		$requestid = $_GET['id'];
	}

	//verify permission
	if ($role === 'teacher') {
		$approved = true;
	}
	else if ($id === $requestid) {
		$approved = true;
	}
	else {
		$approved = false;
		echo '<script language="javascript">alert("You are not allowed to do that"); window.location="login.php"</script>';
	}

    include("connect.php");

	$sql = "SELECT * FROM users WHERE id = ".$id;
	$result = $connect->query($sql);
	$row = mysqli_fetch_array($result);
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<title>List</title>
</head>
<body>
<?php include("header.php") ?>

<?php
	require("debug.php");

	if (isset($_POST["submit"])) {
		$password = $_POST["password"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		if (!isset($_POST['fullname'])) {
			$fullname = $row['hoten'];
		}
		else {
			$fullname = $_POST["fullname"];
		}
		if (!isset($_POST['username'])) {
			$username_edit = $row['username'];
		}
		else {
			$username_edit = $_POST['username'];
		}

		$sql_update = "UPDATE users SET username = '$username_edit', hoten = '$fullname', password = '$password', 
		email = '$email', phone = $phone WHERE id = $id";			

		if ($connect->query($sql_update)) {
			echo '<script language="javascript">alert("Profile edited!"); window.location="profile.php"</script>';
		}
		else {
			echo '<script language="javascript">alert("Error update database!"); window.location="profile.php"</script>';
		}
	}
	

	
?>
<div class="container" style="margin-top:10%;">
	<?php 		
        echo '<img height="250" width="250" src="http://localhost/challenge5a/'.$row['avatar'].'" />';
	?>	

	<?php
		echo '<form action="edit_profile.php?id='.$requestid.'" method="post">';
	?>
		<table>
			<tr>	
				<td>
					<h3>Edit information of user</h3>
				</td>
			</tr>
			<tr>
				<td>Username:</td>
				<?php
					if ($role === "teacher") {
						echo '<td><input type="text" name="username" required value="'.$row['username'].'"></td>';
					} else {
						echo '<td><input type="text" name="username" required value="'.$row['username'].'" disabled=""></td>';
					}
				?>	
				
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="text" name="password" required value="<?php echo $row['password']; ?>"></td>
			</tr>
				<td>Họ và tên:</td>
				<?php
					if ($role === "teacher") {
						echo '<td><input type="text" name="fullname" required value="'.$row['hoten'].'"></td>';
					} else {
						echo '<td><input type="text" name="fullname" required value="'.$row['hoten'].'" disabled=""></td>';
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
</div>
</body>
</html>
