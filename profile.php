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
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Quản lý sinh viên</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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

<div class="container" style="color:blue; font-size: large; font-weight: bold;">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light col-10">

        <a class="navbar-brand" href="listuser.php">Quản lý sinh viên</a>

        <div class="collapse navbar-collapse" >
            <ul class="navbar-nav mr-8 mt-8 mt-lg-0">
                <li class="nav-item active">
                        
                    <a href="profile.php?id=<?php echo $row['id']; ?>&role=<?php echo $row['role']; ?>" class="nav-link" href="#"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="member.php">Danh sách người dùng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Bài tập</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">Challenge</a>
                </li>
            </ul>
        </div>
        <div class="col-2">
            <form class="form-inline my-2 my-lg-0">
                <input class="row form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success row" type="submit">Search</button>
            </form>
        </div>
        <div><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="logout.php">Đăng xuất</a>
        </div>
    </nav>

</div>   
<h1>Profile</h1>
<?php

if (isset($_POST['change_avatar'])) {
    header("location:upload_image.php");
}

$sql_avatar = "SELECT avatar FROM users WHERE username = '$username_avatar'";
$result = $connect->query($sql_avatar);
$row = mysqli_fetch_array($result);
echo '<img height="300" width="300" src="http://localhost/challenge5a/'.$row['avatar'].'" />';

$id = -1;
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}

$sql = "SELECT * FROM users WHERE id = ".$id;
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
        <td>Họ và tên</th>
		<td><?php echo $row['hoten']; ?></td>
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