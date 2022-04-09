<?php
    $connect = mysqli_connect ('localhost', 'root', '', 'studentmanage') or die ('Can not connect to database');
    mysqli_set_charset($connect, 'UTF8');
    if($connect === false){ 
        die("ERROR: Could not connect. " . mysqli_connect_error()); 
    }
?>

