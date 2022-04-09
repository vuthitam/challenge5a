<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Quản lý sinh viên</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>

<?php
    session_start();
    if (isset($_SESSION['username'])) {
        include("connect.php");
        $username = $_SESSION['username'];
        $sql = "SELECT id, role FROM member WHERE username = '$username'";
        $result = $connect->query($sql);
        $row = mysqli_fetch_array($result);
    } else {
        header("location:login.php");
    }

?>

<div class="container" style="color:blue; font-size: large; font-weight: bold;">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light col-10">

        <a class="navbar-brand" href="listuser.php">Quản lý sinh viên</a>

        <div class="collapse navbar-collapse" >
            <ul class="navbar-nav mr-8 mt-8 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Home <span class="sr-only">(current)</span></a>
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

    <div class="example" style="margin-top: 20%;">
        <div class="container">
            <div class="row">
                <h2>Danh sách người dùng</h2>
                <?php if ($_SESSION['username']['roleId']==1): ?>
                    <a href="index.php?controller=username&action=register" >
                        <button style="width: 100px; margin-bottom: 20px" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</button>
                    </a>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên tài khoản</th>
                            <th>Họ và tên</th>
                            <th>Avatar</th>
                            <th>Hành Động</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>

</body>

</html>

<a href="index.php">Trang chủ<br></a>
<a href="profile.php?id=<?php echo $row['id']; ?>&role=<?php echo $row['role']; ?>">Profile<br></a>
<a href="member.php?id=<?php echo $row['id']; ?>&role=<?php echo $row['role']; ?>">Members<br></a>
<a href="message_received.php?id=<?php echo $row['id']; ?>&role=<?php echo $row['role']; ?>">Message Received<br></a>
<?php
    if ($row['role'] === "teacher") {
        echo '<a href="teacher_exercise.php">View exercise<br></a>';
    }
    if ($row['role'] === "student") {
        echo '<a href="student_exercise.php">My exercise<br></a>';
    }
?>
<?php
    if ($row['role'] === "teacher") {
        echo '<a href="teacher_challenge.php">Upload challenges<br></a>';
    }
    if ($row['role'] === "student") {
        echo '<a href="student_challenge.php">My challenges<br></a>';
    }
?>
<a href="logout.php">Log out<br></a>


</body>
</html>