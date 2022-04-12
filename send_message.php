<?php
    
    if(!isset($_SESSION)){
        session_start();
    }
	if (!isset($_SESSION['username'])||!isset($_SESSION['id'])||!isset($_SESSION['role'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	} else {
        $username = $_SESSION['username'];
        $id = $_SESSION['id'];
        $role  = $_SESSION['role'];
    }
    include("connect.php");

    if (isset($_GET['id'])) {
        $recipient_id = $_GET['id'];
        $sender_id = $id;
        if ($recipient_id === $sender_id) {
            echo '<script language="javascript">alert("You can not send message to yourself, idiot!"); window.location="profile.php?id='.$requestid.'"</script>';
            exit();
        }
    }

    if (isset($_POST['submit'])) {
        $message_send = $_POST['message_send'];
        if (!isset($recipient_id) || !isset($sender_id)) {
            echo '<script language="javascript">alert("Some error occured, no change was made!"); window.location="member.php"</script>';   
        }
        //sql update 
        $sql_store_message = "INSERT INTO messages (content, idrec, idsend)
        VALUES ('$message_send', '$recipient_id', '$sender_id')";
        if($connect->query($sql_store_message)) {
            echo '<script language="javascript"> 
                var success = 1;
            </script>';
        }
        else {
            echo '<script language="javascript"> 
                var success = 0;
            </script>';
        }
    }
?>

<script type="text/javascript"> 
    var recipient_id = "<?php echo ''.$recipient_id?>";
    if (typeof success !== 'undefined') {
        if (success === 1) {
            alert("Success!");
            var locationn = "member.php?id=";
            window.location = locationn.concat(recipient_id);  
        }
        else {
            alert("Some error occured!");
            var locationn = "member.php?id=";
            window.location = locationn.concat(recipient_id);  
        }
    }
</script>

<div class="container col-md-10 mx-auto">
    <form action="send_message.php?id=<?php echo $requestid; ?>" method="post">
        Write your message here:<br>
        <textarea type="text" name="message_send" rows="5" cols="100"></textarea><br>
        <input type="submit" name="submit" value="Send">
    </form>
</div>