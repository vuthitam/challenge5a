<?php
	if(!isset($_SESSION)){
        session_start();
    }
	if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	} else {
        $username_student = $_SESSION['username'];
        $userid = $_SESSION['id'];
    }
	include("connect.php");

    if (isset($_GET['assignmentid'])) {
        $assignmentid = $_GET['assignmentid'];
    }



    if(isset($_POST["submit"])) {
        $exercise_submit_dir = "uploads/student_submit/";
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
                //set current date
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $exercise_date = date('l jS F Y h:i:s A');

                $sql_get_submit = "SELECT * FROM submits WHERE studentid = $userid AND assignmentid = $assignmentid";
                $get_submit_result = $connect->query($sql_get_submit);
                if (mysqli_num_rows($get_submit_result)===1) {
                    //Already exist record, update it instead
                    $sql_submit_exercise_update = "UPDATE submits SET studentid=$userid, assignmentid=$assignmentid, title='$exercise_submit_name', link='$exercise_submit_location', updatedAt='$exercise_date' WHERE studentid = $userid AND assignmentid = $assignmentid";
                    if ($connect->query($sql_submit_exercise_update)) {
                        echo '<script language="javascript"> alert("Submit exercise success!"); window.location="student_exercise.php" </script>';
                    }
                }
                else {
                    $sql_submit_exercise = "INSERT INTO submits (studentid, assignmentid, title, link, updatedAt) VALUES ( $userid, $assignmentid, '$exercise_submit_name', '$exercise_submit_location', '$exercise_date')";
                    if ($connect->query($sql_submit_exercise)) {
                        echo '<script language="javascript"> alert("Submit exercise success!"); window.location="student_exercise.php" </script>';
                    }
                }
               
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
?>


<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Upload exercise</title>
</head>
<body>
<?php include_once("header.php") ?>
    <div class="col-md-10 mx-auto " style="margin-top:10%;">
    <form action="upload_exercise.php?assignmentid=<?php echo $assignmentid; ?>" method="post" enctype="multipart/form-data">
        <p>Select file to upload:</p>
        <input type="file" name="exercise">
        <input type="submit" name="submit" value="Submit">
    </form>
</div>
</body>
</html>