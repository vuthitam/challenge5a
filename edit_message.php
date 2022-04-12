<?php
    require("redirect.php");

    if(!isset($_SESSION)){
        session_start();
    }
?>

<?php

	if (!isset($_SESSION['username'])||!isset($_SESSION['id'])||!isset($_SESSION['role'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	} 
    else {
        //data of current user
        $username = $_SESSION['username'];
        $id = $_SESSION['id'];
        $role  = $_SESSION['role'];
    }

    include("connect.php");

    if (isset($_GET['id'])){
        $messageid = $_GET['id'];
    }

    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'delete') {
            $sql_delete_message = "DELETE FROM messages WHERE id=$messageid";
            if ($connect->query($sql_delete_message)) {
                echo '<script type="text/javascript">alert("Message deleted! You will be send back to previous page.");</script>';
            }
            else {
                echo '<script type="text/javascript">alert("Some error occured. You will be send back to previous page.");</script>';
            }
            back();
            exit();
        }
    }
    else {
        if (isset($_POST['edit'])) {
            $message_content = $_POST['message_content'];
            $sql_edit_message = "UPDATE messages
            SET content = '$message_content'
            WHERE id=$messageid";
    
            if($connect->query($sql_edit_message)) {
                echo '<script language="javascript">alert("Message edited!")</script>';    
            }
            else {
                echo '<script language="javascript">alert("Some error occured, no change was made!")</script>';
            }
            backback();
        }
    
        //get targeted message content to display on text box
        $sql_current_message = "SELECT content FROM messages WHERE id = $messageid";
        $result = $connect->query($sql_current_message);
        $row = mysqli_fetch_array($result);
        if (mysqli_num_rows($result) === 0) {
            echo '<script language="javascript">alert("Some error occured or you should first created a message, better luck next time bae!")</script>';
            back();
            exit();
        }
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
            <form action="edit_message.php?id=<?php echo $messageid; ?>" method="post">
            Edit your message here:<br>
            <textarea type="text" name="message_content" rows="9" cols="70"><?php echo $row['content']; ?></textarea>
            <br>
            <input type="submit" name="edit" value="Edit">
            </form>
        </div>
    </body>
</html>