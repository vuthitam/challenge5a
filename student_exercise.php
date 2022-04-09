<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
    } else {
        $username_student = $_SESSION['username'];
    }
    include("connect.php");

    $sql_exercise = "SELECT * FROM exercise";
    $result = $connect->query($sql_exercise);
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Exercise</title>
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

<h1>Exercise</h1>
<table>
    <tr>
        <th>File exercise</th>
        <th>Date create</th>
        <th>Teacher</th>
        <th>Action</th>
    </tr>
    <?php while ($row = mysqli_fetch_array($result)): ?>
        <tr>
            <td><a href="<?php echo 'http://localhost/Challenge5a_hoaln/'.$row['location']; ?>" download><?php echo $row['file_name']; ?></a></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['teacher']; ?></td>
            <td><a href="upload_exercise.php?exercise_file=<?php echo $row['file_name']; ?>&teacher=<?php echo $row['teacher']; ?>">Upload exercise</a></td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>