<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
    } else {
        $username = $_SESSION['username'];
    }
    include("connect.php");

    $sql_message = "SELECT message_to, username FROM member WHERE recipient = '$username'";
    $result_message = $connect->query($sql_message);

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Message</title>
    <style type="text/css">
        table, th, td{
            border:1px solid #868585;
        }
        table{
            border-collapse:collapse;
            width:100%;
        }
        th, td{
            text-align:left;
            padding:10px;
        }
        table tr:nth-child(odd){
            background-color:#eee;
        }
        table tr:nth-child(even){
            background-color:white;
        }
        table tr:nth-child(1){
            background-color:#4CAF50;
        }
    </style>
</head>
<body>

<h1>Messages</h1>
<table>
    <tr>
        <th>Contents</th>
        <th>Senders</th>
    </tr>
    <?php while ($row = mysqli_fetch_array($result_message)): ?>
        <tr>
            <td><?php echo $row['message_to']; ?></td>
            <td><?php echo $row['username']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>