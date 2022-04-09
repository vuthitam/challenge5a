<?php
	if(!isset($_SESSION)){
        session_start();
    }
	if (!isset($_SESSION['username'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	} else {
        $username_student = $_SESSION['username'];
    }
	include("connect.php");

    if (isset($_GET['exercise_file']) && isset($_GET['teacher'])) {
        $exercise_name = $_GET['exercise_file'];
        $exercise_teacher = $_GET['teacher'];
    }



    if(isset($_POST["submit"])) {

        $exercise_submit_dir = "uploads/student_exercise/";
        $exercise_submit_location = $exercise_submit_dir . basename($_FILES["exercise"]["name"]);
        $uploadOk = 1;
        $exercise_submit_type = strtolower(pathinfo($exercise_submit_location,PATHINFO_EXTENSION)); // type of exercise
        $exercise_submit_name = $_FILES['exercise']['name']; // name of exercise
    
        // Check if file already exists
        if (file_exists($exercise_submit_location)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        if($exercise_submit_type != "pdf") {
            echo "Sorry, only PDF files are allowed.";
            $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["exercise"]["tmp_name"], $exercise_submit_location)) {
                $sql_submit_exercise = "INSERT INTO submits (teachername, studentname, title, link, createdAt, updatedAt) VALUES ('$exercise_teacher', '$username_student', '$exercise_submit_name', '$exercise_submit_location')";
                $connect->query($sql_submit_exercise);
                echo '<script language="javascript"> alert("Submit exercise success!"); window.location="student_exercise.php" </script>';
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<title>Upload exercise</title>

</head>
<body>

<form action="upload_exercise.php?exercise_file=<?php echo $exercise_name; ?>&teacher=<?php echo $exercise_teacher; ?>" method="post" enctype="multipart/form-data">
    <p>Select file to upload:</p>
    <input type="file" name="exercise">
    <input type="submit" name="submit" value="Submit">
</form>




</body>
</html>