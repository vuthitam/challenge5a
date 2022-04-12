<?php
	if(!isset($_SESSION)){
        session_start();
    }
	if (!isset($_SESSION['username'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	} else {
        $username_teacher = $_SESSION['username'];
    }
    if (!isset($_SESSION['id'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	} else {
        $teacherId = $_SESSION['id'];
    }
	include("connect.php");

    if(isset($_POST["submit"])) {
        $title = $_POST['title'];
        $goiy = $_POST['goiy'];
        $challenge_dir = "uploads/challenge/";
        $challenge_file = $challenge_dir . basename($_FILES["challenge"]["name"]);
        $uploadOk = 1;
        $challenge_type = strtolower(pathinfo($challenge_file,PATHINFO_EXTENSION)); // type of challenge
    
        // Check if file already exists
        if (file_exists($challenge_file)) {
            echo '<script language="javascript"> alert("Sorry, file already exists.") </script>';
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        if($challenge_type != "txt") {
            echo '<script language="javascript"> alert("Sorry, only .txt files are allowed.") </script>';
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo '<script language="javascript"> alert("Sorry, there was an error uploading your file (0x2)") </script>';
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["challenge"]["tmp_name"], $challenge_file)) {
                $sql_upload_challenge = "INSERT INTO challenges (teacherid, title, files, goiy) VALUES ($teacherId, '$title', '$challenge_file', '$goiy' )";

                if($connect->query($sql_upload_challenge)) {
                    echo '<script language="javascript"> alert("Upload challenge success!") </script>';
                }              
                else {
                echo '<script language="javascript">alert("Sorry, there was an error update your database."); window.location="teacher_challenge.php"</script>';
                }
            }
        }
    }
    $sql_get_challenge = "SELECT * FROM challenges WHERE teacherid=$teacherId";
    $result_get_challenge = $connect->query($sql_get_challenge);
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<title>Upload challenge</title>
</head>
<body>
<?php include_once("header.php") ?>
    <div class="col-md-10 mx-auto " style="margin-top:10%;">
        <h1>List challenges</h1>
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Tittle challenge</th>
                    <th>Gợi ý</th>
                    <th>File challenge</th>
                    <th>Date created</th>
                </tr>
            </thead>
            <?php while ($row_get_challenge = mysqli_fetch_array($result_get_challenge)): ?>
                <tbody >
                    <tr>
                        <td><?php echo $row_get_challenge['title']; ?></td>
                        <td><?php echo $row_get_challenge['goiy']; ?></td>
                        <td><a href="<?php echo 'http://localhost/challenge5a/'.$row_get_challenge['files']; ?>" download><?php echo $row_get_challenge['files']; ?></a></td>
                        <td><?php echo $row_get_challenge['createdAt']; ?></td>
                    </tr>
                </tbody>
            <?php endwhile; ?>
        </table>

        <h1>Upload new challenge</h1>
        <form action="teacher_challenge.php" method="post" enctype="multipart/form-data">
            Tên challenge:<br>
            <input type="text" name="title" required> <br>
            Gợi ý cho challenge:<br>
            <textarea type="text" name="goiy" rows="5" cols="80"></textarea>
            <br>
            <p>Select file to upload:</p>
            <input type="file" name="challenge">
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
</html>
