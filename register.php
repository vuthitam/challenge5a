<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="style.css"/>
</head>
<body>

<form method="post" action="register.php" class="form">

<h2>Register new member</h2>

Username: <input type="text" name="username" value="" required>

Password: <input type="text" name="password" value="" required/>

Full name: <input type="text" name="fullname" value="" required/>

Email: <input type="email" name="email" value="" required/>

Phone: <input type="text" name="phone" value="" required/>

<input type="submit" class="button" name="register" value="Register"/>
</form>

</body>
</html>

<?php
header('Content-Type: text/html; charset=utf-8');
// Kết nối cơ sở dữ liệu
$connect = mysqli_connect('localhost', 'root', '', 'user') or die ('Lỗi kết nối');
mysqli_set_charset($connect, "utf8");

// Dùng isset để kiểm tra Form
if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = "student";

$sql = "INSERT INTO member (username, password, fullname, email, phone, role) VALUES ('$username','$password','$fullname','$email','$phone','$role')";
mysqli_query($connect, $sql);
echo '<script language="javascript">alert("Register successed!"); window.location="index.php"</script>';


}
?>