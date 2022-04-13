<?php
    session_start();
    unset($_SESSION['username']);
    session_destroy();
    echo '<script language="javascript">window.location="login.php"</script>';
?>