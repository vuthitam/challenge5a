<?php
	session_start();
	if (!isset($_SESSION['username'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	} else {
        $username_teacher = $_SESSION['username'];
    }
	include("connect.php");

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $exercise_date = date('l jS F Y h:i:s A');

    if(isset($_POST["submit"])) {

        $exercise_dir = "uploads/teacher_exercise/";
        $exercise_file = $exercise_dir . basename($_FILES["exercise"]["name"]);
        $uploadOk = 1;
        $exercise_type = strtolower(pathinfo($exercise_file,PATHINFO_EXTENSION)); // type of exercise
        $exercise_name = $_FILES['exercise']['name']; // name of exercise
    
        // Check if file already exists
        if (file_exists($exercise_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        if($exercise_type != "pdf") {
            echo "Sorry, only PDF files are allowed.";
            $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["exercise"]["tmp_name"], $exercise_file)) {
                $sql_upload_exercise = "INSERT INTO exercise (file_name, type, date, location, teacher) VALUES ('$exercise_name', '$exercise_type', '$exercise_date', '$exercise_file', '$username_teacher')";
                $connect->query($sql_upload_exercise);
                echo '<script language="javascript"> alert("Upload exercise success!") </script>';
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    $sql_get_submit_exercise = "SELECT * FROM submit_exercise WHERE teacher = '$username_teacher'";
    $result_get_submit_exercise = $connect->query($sql_get_submit_exercise);
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<title>View Exercise</title>
<style type="text/css">
        table, th, td{
            border:1px solid #868585;
        }
        table{
            border-collapse:collapse;
            width:100%;
        }
        th, td{
            text-align:center;
            padding:10px;
        }
        table tr:nth-child(odd){
            background-color:#eee;
        }
        table tr:nth-child(even){
            background-color:white;
        }
</style>
</head>
<body>
<h1>List exercise</h1>
<table>
    <tr>
        <th>Exercise name</th>
        <th>File exercise submit</th>
        <th>Student</th>
    </tr>
    <?php while ($row_get_submit_exercise = mysqli_fetch_array($result_get_submit_exercise)): ?>
        <tr>
            <td><?php echo $row_get_submit_exercise['exercise_name']; ?></td>
            <td><a href="<?php echo 'http://localhost/Challenge5a_hoaln/'.$row_get_submit_exercise['location']; ?>" download><?php echo $row_get_submit_exercise['submit_exercise_name']; ?></a></td>
            <td><?php echo $row_get_submit_exercise['student']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<h1>Upload new exercise</h1>
<form action="teacher_exercise.php" method="post" enctype="multipart/form-data">
    <p>Select file to upload:</p>
    <input type="file" name="exercise">
    <input type="submit" name="submit" value="Submit">
</form>




</body>
</html>