
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Quản lý sinh viên</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
<div class="container mx-auto " style="color:blue; font-size: large; font-weight: bold;">
    <nav class="navbar fixed-top mx-auto navbar-expand-lg navbar-light bg-light col-10">

        <a class="navbar-brand" href="member.php">Quản lý sinh viên</a>

        <div class="collapse navbar-collapse" >
            <ul class="navbar-nav mr-8 mt-8 mt-lg-0">
            <li class="nav-item active">
                    <a href="profile.php?id=<?php echo $row['id']; ?>" class="nav-link" href="#"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="member.php">Danh sách người dùng</a>
                </li>
                <li class="nav-item">
                    <?php
                        if(!isset($_SESSION)){
                            session_start();
                        }
                        if (isset($_SESSION['role'])) { 
                            $role=$_SESSION['role'];
                            if ($role === "teacher") 
                                echo '<a class="nav-link" href="teacher_exercise.php">View exercise</a>';
                            elseif ($role === "student") {
                                echo '<a class="nav-link" href="student_exercise.php">My exercise</a>';
                            }
                            else {
                                echo '<script language="javascript">alert("You must login first!"); window.location="login.php"</script>';
                            }
                        }
                    ?>
                </li>
                <li class="nav-item">
                <?php
                    if (isset($_SESSION['role'])) { 
                        $role=$_SESSION['role'];
                        if ($role === "teacher") {
                            echo '<a class="nav-link" href="teacher_challenge.php">Upload challenges</a>';
                        }
                        if ($role === "student") {
                            echo '<a class="nav-link" href="student_challenge.php">My challenges</a>';
                        }
                    }
                    
                ?>
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
</body>
<?php
?>
