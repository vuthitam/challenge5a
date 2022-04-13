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
    require('debug.php');
    if(!isset($_SESSION)){
        breakpoint(1);
        session_start();
    }
    if (isset($_SESSION['username'])) {
        echo '<script language="javascript">window.location="profile.php"</script>';
    } else {
        echo '<script language="javascript">window.location="portal.php"</script>';
    }

?>
</body>
</html>
