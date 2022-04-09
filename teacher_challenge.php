<?php
	session_start();
	if (!isset($_SESSION['username'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	} else {
        $username_teacher = $_SESSION['username'];
    }
	include("connect.php");

    if(isset($_POST["submit"])) {
        $challenge_description = $_POST['challenge_description'];
        $challenge_dir = "uploads/challenge/";
        $challenge_file = $challenge_dir . basename($_FILES["challenge"]["name"]);
        $uploadOk = 1;
        $challenge_type = strtolower(pathinfo($challenge_file,PATHINFO_EXTENSION)); // type of challenge
        $challenge_name = md5(substr($_FILES['challenge']['name'], 0, -4)); // name of challenge
    
        // Check if file already exists
        if (file_exists($challenge_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        if($challenge_type != "txt") {
            echo "Sorry, only .txt files are allowed.";
            $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["challenge"]["tmp_name"], $challenge_file)) {
                $sql_upload_challenge = "INSERT INTO challenge (file_name, description, location, teacher) VALUES ('$challenge_name', '$challenge_description', '$challenge_file', '$username_teacher')";
                $connect->query($sql_upload_challenge);
                echo '<script language="javascript"> alert("Upload challenge success!") </script>';
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
<title>Upload challenge</title>
</head>
<body>
<h1>Upload new challenge</h1>
<form action="teacher_challenge.php" method="post" enctype="multipart/form-data">
    Description of challenge:<br>
    <textarea type="text" name="challenge_description" rows="9" cols="70"></textarea>
    <br>
    <p>Select file to upload:</p>
    <input type="file" name="challenge">
    <input type="submit" name="submit" value="Submit">
</form>




</body>
</html>