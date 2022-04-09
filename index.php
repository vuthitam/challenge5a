<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Quản lý sinh viên</title>
    <link rel="stylesheet" href="login.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>

<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if (isset($_SESSION['username'])) {
        include("connect.php");
        $username = $_SESSION['username'];
        $sql = "SELECT id, role FROM users WHERE username = '$username'";
        $result = $connect->query($sql);
        $row = mysqli_fetch_array($result);
        header("location:header.php");
    } else {
        header("location:login.php");
    }

?>

<!--

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
-->