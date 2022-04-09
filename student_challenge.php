<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
    } else {
        $username_student = $_SESSION['username'];
    }
    include("connect.php");

    header("Content-type: text/html; charset=utf-8");
    $sql_challenge = "SELECT * FROM challenge";
    $result = $connect->query($sql_challenge);

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Challenge</title>
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

<h1>Challenge</h1>
<form action="student_challenge.php" method="post">
<table>
    <tr>
        <th>Description</th>
        <th>Teacher</th>
        <th>Answer</th>
    </tr>
    <?php while ($row = mysqli_fetch_array($result)): ?>
        <tr>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['teacher']; ?></td>
            <td>
                <?php
                    if (isset($_POST['submit'])) {
                        $answer = $_POST['answer'];
                        if (md5($answer) === $row['file_name']) {
                            echo '<script language="javascript">alert("Your answer is right, congratulation!");</script>';
                            $content = fopen($row['location'], "r");
                            while(!feof($content)) {
                                echo fgets($content) . "<br>";
                            }
                            fclose($content);
                        } else {
                            echo '<script language="javascript">alert("Your answer is wrong, try again!"); window.location="student_challenge.php"</script>';
                        }
                    }
                ?>
                <input type="text" name="answer" size="20">
                <input type="submit" name="submit" value="Submit">
            </td>
        </tr>
    <?php endwhile; ?>
</table>
</form>

</body>
</html>