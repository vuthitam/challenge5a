<?php
include("connect.php");
session_start();


if (isset($_SESSION['username'])) {
    include("connect.php");
    $username = $_SESSION['username'];
    $sql = "SELECT id, role FROM users WHERE username = '$username'";
    $result = $connect->query($sql);
    $row = mysqli_fetch_array($result);
    $sql_student = "SELECT username, hoten, email, phone, role, id FROM users";
    $result_student = $connect->query($sql_student);
} else {
    header("location:login.php");
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Quản lý sinh viên</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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

    <div class="container" style="margin-top: 20%;">
    <h2>Danh sách người dùng</h2>
    <?php
    if ($row['role'] === "teacher") {
        echo '<a href="register.php"> <button style="width: 200px; margin-bottom: 20px" type="button" > <i class="fa fa-plus"></i> Thêm mới</button></a>';
    }
    
?>
    
    <table class="table table-bordered">
    <tr>
        <th>Username</th>
        <th>Họ và tên</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Chức vụ</th>
        <th></th>
        <th>Message</th>
    </tr>
    <?php while ($row = mysqli_fetch_array($result_student)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['hoten']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['phone']); ?></td>
            <td><?php echo htmlspecialchars($row['role']); ?></td>
            <td><a href="edit_profile.php?id=<?php echo $row['id']; ?>&role=<?php echo $row['role']; ?>">edit</a></td>
            <td><a href="send_message.php?recipient=<?php echo $row['username']; ?>">Write</a> <a href="edit_message.php?recipient=<?php echo $row['username']; ?>">Edit</a></td>
        </tr>
    <?php endwhile; ?>
    </table>
    </div>
</div>
</body>
</html>