<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if (!isset($_SESSION['username'])) {
        echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
    } else {
        $username = $_SESSION['username'];
    }
    include("connect.php");

    if (isset($_GET['recipient'])) {
        $recipient = $_GET['recipient'];
        //get recipient id
        $sql_get_recipient_id= "SELECT id FROM users WHERE username = '$recipient'";
        $res = $connect->query($sql_get_recipient_id);
        if (mysqli_num_rows($res) === 1) {
            $row = mysqli_fetch_array($res);
            $recipient_id = $row['id'];

            //get sender id
            $sql_get_sender_id= "SELECT id FROM users WHERE username = '$username'";
            $res = $connect->query($sql_get_sender_id);
            if (mysqli_num_rows($res) === 1) {
                $row = mysqli_fetch_array($res);
                $sender_id = $row['id'];
                
                if ($recipient_id === $sender_id) {
                    echo '<script language="javascript">alert("You can not send message to yourself, idiot!"); window.location="member.php"</script>';
                    exit();
                }
            }
        }
    }

    if (isset($_POST['submit'])) {
        $message_send = $_POST['message_send'];
        if (!isset($recipient_id) || !isset($sender_id)) {
            echo '<script language="javascript">alert("Some error occured, no change was made!"); window.location="member.php"</script>';   
        }
        //sql update 
        $sql_store_message = "INSERT INTO messages (content, username, idrec, idsend)
        VALUES ('$message_send', '$username', '$recipient_id',  '$sender_id')";
        if($connect->query($sql_store_message)) {
            echo '<script language="javascript">alert("Send message success!"); window.location="member.php"</script>';   
        }
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