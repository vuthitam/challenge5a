<?php
include("connect.php");
if(!isset($_SESSION)){
    session_start();
}
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT id, role FROM users WHERE username = '$username'";
    $result = $connect->query($sql);
    $row = mysqli_fetch_array($result);
    $sql_student = "SELECT username, hoten, email, phone, role, id FROM users";
    $result_student = $connect->query($sql_student);
} else {
    echo '<script language="javascript">window.location="login.php"</script>';
}
?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<?php include("header.php") ?>
    <div class="col-md-10 mx-auto" style="margin-top: 10%;">
    <h2>Danh sách người dùng</h2>
        <?php
            if ($row['role'] === "teacher") {
                echo '<a href="add_user.php"> <button style="width: 200px; margin-bottom: 20px" type="button" > <i class="fa fa-plus"></i> Thêm mới</button></a>';
            }
        ?>
    <table class="table table-bordered">
    <tr style="text-align:center">
        <th>Username</th>
        <th>Họ và tên</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Chức vụ</th>
        <th colspan=3 >Hành động</th>
        <!--<th>Message</th>-->
    </tr>
   
    <?php while ($row = mysqli_fetch_array($result_student)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['hoten']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['phone']); ?></td>
            <td><?php echo htmlspecialchars($row['role']); ?></td>
            <td><button><a href="profile.php?id=<?php echo $row['id'];?>">Xem chi tiết</a></button>
            <td><button><a href="edit_profile.php?id=<?php echo $row['id'];?>">Edit</a></button>
            <td><button><a href="profile.php?id=<?php echo $row['id'];?>&action=delete">Delete user</a></button>
        </tr>
        <?php endwhile; ?>
    </table>
</div>


