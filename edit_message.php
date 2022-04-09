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

    if (isset($_POST['edit'])) {
        $message_edit = $_POST['message_edit'];
        if (!isset($recipient_id) || !isset($sender_id)) {
            echo '<script language="javascript">alert("Some error occured, no change was made!"); window.location="member.php"</script>';   
        }
        $sql_edit_message = "UPDATE messages
        SET content = '$message_edit'
        WHERE idrec = $recipient_id AND idsend = $sender_id
        ORDER BY createdAt desc
        limit 1";

        if($connect->query($sql_edit_message)) {
            echo '<script language="javascript">alert("Message edited!"); window.location="member.php"</script>';   
        }
        else echo '<script language="javascript">alert("Some error occured, no change was made!"); window.location="member.php"</script>';   
    }

    //get targeted message content to display on text box
    $sql_current_message = "SELECT content, idrec FROM messages WHERE username ='$username'";
    $result = $connect->query($sql_current_message);
    $row = mysqli_fetch_array($result);
    if (mysqli_num_rows($result) !== 1) {
        echo '<script language="javascript">alert("You should first created a message, better luck next time bae!"); window.location="member.php"</script>';
        exit();
    }
?>

<html>
    <head>
        <style>
            .container{
                margin-top: 100px;
            }
        </style>
        <title>Edit Messages</title>
    </head>
    <body>
    <?php include("header.php") ?>
        <div class="container">
            <form action="edit_message.php?recipient=<?php echo $recipient; ?>" method="post">
            Edit your message here:<br>
            <textarea type="text" name="message_edit" rows="9" cols="70"><?php echo $row['content']; ?></textarea>
            <br>
            <input type="submit" name="edit" value="Edit">
            </form>
        </div>
    </body>
</html>