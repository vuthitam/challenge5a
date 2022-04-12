<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="portal.css">
</head>

<body>
<div class="container">
    <div class="nav">
        <h1>QUẢN LÝ SINH VIÊN</h1>
        <?php
            if(!isset($_SESSION)){
                session_start();
            }
            if (!isset($_SESSION['username'])&&!isset($_SESSION['id'])&&!isset($_SESSION['role'])) {
                    echo("<div class='menu'>");
                    echo("<a class='button-18' href='./login.php'>Log in</a>");
                    echo("</div>");
            }
        ?>
    </div>
    <div class="">

    </div>
</div>
</body>
</html>