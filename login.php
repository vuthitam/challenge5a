<!DOCTYPE html>
 <html>
	<head>
		<link rel="stylesheet" href="login.css">
	</head>
	<body>
		 <div class="container">
				<div class="info">
					<h2>Trang quản lý sinh viên HUST</h2>
					<h3>One love, one future</h3>

				</div>

				<div class="table">
					<h1>Đăng nhập</h1>
					<form action="login.php" class="text-center" method='POST'>
                        <div><input type="text" name="username" placeholder="User Name" required/></div>
                        <input type="password" name="password" placeholder="Password" required/>
                        <input type="submit" class="button" name="dangnhap" value='Đăng nhập' />
					</form>
                    <div class="register" href="register.php">Register</div>
					<div class="forgot">Forgot password?</div>
					<div class="line" ></div>
				</div>
			</div>
	</body>

</html>

<?php
    session_start();
    header('Content-Type: text/html; charset=UTF-8');

    if (isset($_POST['dangnhap'])) {
    $connect = mysqli_connect ('localhost', 'root', '', 'studentmanage');
    mysqli_set_charset($connect, 'UTF8');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($connect, $query);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $row = mysqli_fetch_array($result);

        if ($password != $row['password']) {
        echo "Password wrong. Try again!";
        exit();
        } else {

            $_SESSION['username'] = $username;
            header("location:index.php");
        }
    } else {
    echo "The username doesn't consist!";
    }

    $connect->close();
    }
?>