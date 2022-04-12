<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="login.css"/>


</head>
<body>
    <div class="container-reg">
		
		<div class="table-register ">
            <div class="header"><h1>Trang quản lý sinh viên HUST</h1> <br>
            <h3>One love, one future</h3>
            </div>
			
			<h1>Đăng ký</h1>
			<form action="register.php" class="text-center" method='POST'>
                <div>Username: <input type="text" name="username" placeholder="User Name" required/></div><br>
                Password: <input type="password" name="password" placeholder="Password" required/><br>
                Full name:  <input type="text" name="hoten" placeholder="Full name" required/><br>
                Email: <input type="email" name="email" placeholder="Email" required/><br>
                Phone: <input type="text" name="phone" placeholder="Phone" required/><br>
                <input type="submit" class="button" name="dangky" value='Đăng ký' />
			</form>
                    
			<div class="line" ></div>
		</div>
	</div>

</body>
</html>

<?php
header('Content-Type: text/html; charset=utf-8');
// Kết nối cơ sở dữ liệu
$connect = mysqli_connect('localhost', 'root', '', 'studentmanage') or die ('Lỗi kết nối');
mysqli_set_charset($connect, "utf8");

// Dùng isset để kiểm tra Form
if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hoten = $_POST['hoten'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = "student";

    $sql = "INSERT INTO users (username, password, hoten, email, phone, role) VALUES ('$username','$password','$hoten','$email','$phone','$role')";
    mysqli_query($connect, $sql);
    echo '<script language="javascript">alert("Register successed!"); window.location="index.php"</script>';
}
?>