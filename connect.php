<?php
    $connect = mysqli_connect ("localhost", "id18726542_root", "IWPoo9!z]!jL|QBB", "id18726542_studentmanage");
    mysqli_set_charset($connect, 'UTF8');
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
    
?>

