<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Quản lý sinh viên</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">

    <style>
        li:hover{
            opacity: 0.5;
        }
    </style>
</head>
<body>
<div class="container col-md-10 " style="color:blue; font-size: large; font-weight: bold;">
    <nav class="navbar fixed-top mx-auto navbar-expand-lg navbar-light bg-light col-10">

        <a class="navbar-brand col" href="#">Quản lý sinh viên</a>

        <div class="collapse navbar-collapse col-6" >
            <ul class="navbar-nav mr-8 mt-8 mt-lg-0">
            <li class="nav-item active">
                    <a href="profile.php" class="nav-link"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="member.php">List users</a>
                </li>

                <li class="nav-item ">
                    <?php
                        if(!isset($_SESSION)){
                            session_start();
                        }
                        if (isset($_SESSION['role'])) { 
                            $role=$_SESSION['role'];
                            if ($role === "teacher") 
                                echo '<a class="nav-link " href="teacher_exercise.php" >Assigments</a>';
                            elseif ($role === "student") {
                                echo '<a class="nav-link " href="student_exercise.php" >My assignments</a>';
                            }
                            else {
                                echo '<script language="javascript">alert("You must login first!"); window.location="login.php"</script>';
                            }
                        }
                    ?>
            
                </li>
                <li class="nav-item ">
                <?php
                    if (isset($_SESSION['role'])) { 
                        $role=$_SESSION['role'];
                        if ($role === "teacher") 
                                echo '<a class="nav-link " href="teacher_challenge.php" >Challenges</a>';
                            elseif ($role === "student") {
                                echo '<a class="nav-link " href="student_challenge.php" >My challenges</a>';
                            }
                            else {
                                echo '<script language="javascript">alert("You must login first!"); window.location="login.php"</script>';
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
        <div class="col-2"><a class="nav-link" href="logout.php">Đăng xuất</a>
        </div>
    </nav>
</div>
</body>
<?php
?>
