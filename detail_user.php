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

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }

	include("connect.php");
?>

<html>
<head>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php include("header.php") ?>
    <div class="col-md-10 mx-auto">
        <h1>Profile</h1>
        <?php
        if (isset($_POST['change_avatar'])) {
            echo '<script language="javascript">window.location="upload_image.php"</script>';
            //header("location:upload_image.php");
        }

        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $connect->query($sql);
        $row = mysqli_fetch_array($result);

        echo '<img height="250" width="250" src="http://localhost/challenge5a/'.$row['avatar'].'" />';

        ?>
        <div class="col-md-6 mx-auto">
            <table class="table table-bordered table-striped">
                <tr>
                    <td>Tên đăng nhập</td>
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
                    <td>Điện thoại</td>
                    <td><?php echo $row['phone']; ?></td>
                </tr>
                <tr>
                    <td>Chức năng</td>
                    <td><?php echo $row['role']; ?></td>
                </tr>
            </table>
         </div>
    </div>
</body>