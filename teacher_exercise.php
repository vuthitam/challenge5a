<?php
	if(!isset($_SESSION)){
        session_start();
    }
	if (!isset($_SESSION['username'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	} else {
        $username_teacher = $_SESSION['username'];
    }
	require("connect.php");

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $exercise_date = date('l jS F Y h:i:s A');
                        //Sunday 10th April 2022 12:25:19 AM
    if(isset($_POST["submit"])) {
        $exercise_dir = "uploads/teacher_assignment/";
        $exercise_file = $exercise_dir . basename($_FILES["exercise"]["name"]);
        $uploadOk = 1;
        $exercise_type = strtolower(pathinfo($exercise_file,PATHINFO_EXTENSION)); // type of exercise
        $exercise_name = $_FILES['exercise']['name']; // name of exercise   
        // Check if file already exists
        if (file_exists($exercise_file)) {
            echo '<script language="javascript"> alert("Sorry, file already exists.") </script>';
            $uploadOk = 0;
        }    
        // Allow certain file formats
        if($exercise_type != "pdf") {
            echo '<script language="javascript"> alert("Sorry, only PDF files are allowed.") </script>';
            $uploadOk = 0;
        }    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo '<script language="javascript"> alert("Sorry, there was an error uploading your file (0x2)") </script>';
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["exercise"]["tmp_name"], $exercise_file)) {
                $sql_get_teacher_id = "SELECT id FROM users where username = '$username_teacher'";
                $result = $connect->query($sql_get_teacher_id);
                $count = mysqli_num_rows($result);
                if ($count !== 1) {
                    exit();
                }
                $row = mysqli_fetch_array($result);
                $teacherId = $row['id'];
                //echo($exercise_date);
                $sql_upload_exercise = "INSERT INTO assignments (title, createdAt, files , author, teacherId) VALUES ('$exercise_name', '$exercise_date', '$exercise_file', '$username_teacher', $teacherId)";
                if($connect->query($sql_upload_exercise)) {
                    echo '<script language="javascript"> alert("Upload exercise success!") </script>';
                }
                else {
                    echo '<script language="javascript"> alert("Sorry, there was an error uploading your file (0x0)") </script>';
                }
            } else {
                echo '<script language="javascript"> alert("Sorry, there was an error uploading your file (0x1)") </script>';
            }
        }
    }
    $sql_get_submit_exercise = "SELECT * FROM assignments WHERE author = '$username_teacher'";
    $result_get_submit_exercise = $connect->query($sql_get_submit_exercise);
?>
<head>
    <title>View Exercise</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>
<?php include_once("header.php") ?>
    <div class="col-md-10 mx-auto container" style="margin-top:10%;">
        <h1>List exercise</h1>

        <?php while ($row_get_submit_exercise = mysqli_fetch_array($result_get_submit_exercise)): 
                    $assignmentid = $row_get_submit_exercise['id']; ?>

        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Exercise name</th>
                    <th>File exercise submit</th>
                    <th>Date created</th>
                </tr>
            </thead>
            
                <tbody >
                    <tr>
                        <td><?php echo $row_get_submit_exercise['title']; ?></td>
                        <td><a href="<?php echo 'https://svtamvt.000webhostapp.com/'.$row_get_submit_exercise['files']; ?>" download><?php echo $row_get_submit_exercise['files']; ?></a></td>
                        <td><?php echo $row_get_submit_exercise['createdAt']; ?></td>
                    </tr>
                    <table class="table table-bordered table-hover" >
                        <thead class="thead-light">
                            <tr> 
                                <th>Student name </th>
                                <th>Url file submit </th>
                                <th>Time submited </th>
                            <tr>
                        </thead>     
                        <?php $sql_get_student_submit = "SELECT * FROM submits JOIN users ON submits.studentid=users.id WHERE (submits.studentid= users.id) AND (submits.assignmentid=".$assignmentid.")";
                        $result_get_student_submit = $connect->query($sql_get_student_submit); 
                        while ($row_get_student_submit = mysqli_fetch_array($result_get_student_submit)): ?>
                        <tbody>
                            <tr>
                                <td> <?php echo $row_get_student_submit['username']; ?> </td>
                                <td><a href="<?php echo 'https://svtamvt.000webhostapp.com/'.$row_get_student_submit['link']; ?>" download><?php echo $row_get_student_submit['link']; ?></a></td>
                                <td> <?php echo $row_get_student_submit['updatedAt']; ?> </td>
                            </tr>
                        </tbody>
                        <?php endwhile; ?>
                    </table> <br>
                </tbody>
            
        </table>
        <?php endwhile; ?>
        <h1>Upload new exercise</h1>
        <form action="teacher_exercise.php" method="post" enctype="multipart/form-data">
            <p>Select file to upload:</p>
            <input type="file" name="exercise">
            <input type="submit" name="submit" value="Submit">
        </form>
        
    </div>
</body>
