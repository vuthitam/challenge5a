<html>
<body>
<?php include_once("header.php") ?>
    <div class="col-md-10 mx-auto " style="margin-top:10%;">
        <form action="upload_image.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
        </form>
    </div>
</body>
</html>

<?php
if(!isset($_SESSION)){
    session_start();
}
if (!isset($_SESSION['username'])) {
    echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
}
include("connect.php");


if(isset($_POST["submit"])) {

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $avatar_username = $_SESSION['username'];

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            $sql_upload_image = "UPDATE users SET avatar = '$target_file' WHERE username = '$avatar_username'";
            mysqli_query($connect, $sql_upload_image);

            $sql = "SELECT id, role FROM users WHERE username = '$avatar_username'";
	        $result = $connect->query($sql);
	        $row = mysqli_fetch_array($result);
            $id = $row['id'];
            $role = $row['role'];
            //echo "<script language=\"javascript\">window.location=\"profile.php?id=$id&role=$role\"</script>"; 
            //note: echo khong inject bien neu su dung '' nhung se inject bien neu su dung ""
            header("location:profile.php?id=".$id."&role=".$role);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

?>
