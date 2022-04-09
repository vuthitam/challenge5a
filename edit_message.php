<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
    } else {
        $username = $_SESSION['username'];
    }
    include("connect.php");

    $sql_current_message = "SELECT message_to FROM member WHERE username ='$username'";
    $result = $connect->query($sql_current_message);
    $row = mysqli_fetch_array($result);

    if (isset($_GET['recipient'])) {
        $recipient = $_GET['recipient'];
    }

    if (isset($_POST['edit'])) {
        $message_edit = $_POST['message_edit'];
        $sql_edit_message = "UPDATE member SET message_to = '$message_edit' WHERE username = '$username'";
        $connect->query($sql_edit_message);
        echo '<script language="javascript">alert("Edit message success!"); window.location="member.php"</script>';
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
        <title>Edit Messages</title>
    </head>
    <body>
        <form action="edit_message.php?recipient=<?php echo $recipient; ?>" method="post">
        Edit your message here:<br>
        <textarea type="text" name="message_edit" rows="9" cols="70"><?php echo $row['message_to']; ?></textarea>
        <br>
        <input type="submit" name="edit" value="Edit">
        </form>
    </body>
</html>