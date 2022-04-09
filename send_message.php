<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
    } else {
        $username = $_SESSION['username'];
    }
    include("connect.php");

    if (isset($_GET['recipient'])) {
        $recipient = $_GET['recipient'];
    }

    if (isset($_POST['submit'])) {
        $message_send = $_POST['message_send'];
        $sql_store_message = "UPDATE member SET message_to = '$message_send', recipient = '$recipient' WHERE username = '$username'";
        $connect->query($sql_store_message);
        echo '<script language="javascript">alert("Send message success!"); window.location="member.php"</script>';
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Send Messages</title>
</head>
<body>
    <form action="send_message.php?recipient=<?php echo $recipient; ?>" method="post">
        Write your message here:<br>
        <textarea type="text" name="message_send" rows="9" cols="70"></textarea>
        <br>
        <input type="submit" name="submit" value="Send">
    </form>

</body>
</html>