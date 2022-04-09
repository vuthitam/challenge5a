<?php
	session_start();
	if (!isset($_SESSION['username'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	} else {
        $username_avatar = $_SESSION['username'];
    }
	include("connect.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<title>Profile</title>
<style type="text/css">
        table, th, td{
            border:1px solid #868585;
        }
        table{
            border-collapse:collapse;
            width:100%;
        }
        th, td{
            text-align:center;
            padding:10px;
        }
        table tr:nth-child(odd){
            background-color:#eee;
        }
        table tr:nth-child(even){
            background-color:white;
        }
</style>
</head>
<body>
<h1>Profile</h1>
<?php

if (isset($_POST['change_avatar'])) {
    header("location:upload_image.php");
}

$sql_avatar = "SELECT location FROM avatar WHERE username = '$username_avatar'";
$result = $connect->query($sql_avatar);
$row = mysqli_fetch_array($result);
echo '<img height="300" width="300" src="http://localhost/Challenge5a_hoaln/'.$row['location'].'" />';

$id = -1;
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}

$sql = "SELECT * FROM member WHERE id = ".$id;
$result = $connect->query($sql);
$row = mysqli_fetch_array($result);

?>
<form action="profile.php" method="post">
<input type="submit" name="change_avatar" value="Change avatar">
</form>
<table>
    <tr>
        <td>Username</td>
		<td><?php echo $row['username']; ?></td>
    </tr>
	<tr>
        <td>Full name</th>
		<td><?php echo $row['fullname']; ?></td>
    </tr>
	<tr>
        <td>Email</td>
		<td><?php echo $row['email']; ?></td>
    </tr>
	<tr>
        <td>Phone</td>
		<td><?php echo $row['phone']; ?></td>
    </tr>
	<tr>
        <td>Role</td>
		<td><?php echo $row['role']; ?></td>
    </tr>
</table>

<a href="edit_profile.php?id=<?php echo $row['id']; ?>&role=<?php echo $row['role']; ?>">Edit</a>

</body>
</html>