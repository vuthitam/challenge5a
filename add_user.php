<?php
    include_once("connect.php")
    ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php require_once("header.php"); ?>
<div class="container col-10 mx-auto" style="margin-top:12vh; padding-top:10vh;">
<form method="post" action="add_user.php" class="form" >

    <h4>Thêm người dùng mới</h4>

    Username: <input type="text" name="username" value="" required/>

    Password: <input type="text" name="password" value="" required/>

    Họ và tên: <input type="text" name="hoten" value="" required/>

    Email: <input type="email" name="email" value="" required/>

    Phone: <input type="text" name="phone" value="" required/>

    <input type="submit" class="button" name="adduser" value="Thêm"/>
</form>
</div>
</body>
</html>

<?php
// Dùng isset để kiểm tra Form
if(isset($_POST['adduser'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hoten = $_POST['hoten'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = "student";

    $sql = "INSERT INTO users (username, password, hoten, email, phone, role) VALUES ('$username','$password','$hoten','$email','$phone','$role')";
    mysqli_query($connect, $sql);
    echo '<script language="javascript">alert("Add user successed!"); window.location="index.php"</script>';

}
?>