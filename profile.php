<?php
	if(!isset($_SESSION)){
        session_start();
    }
	if (!isset($_SESSION['username'])||!isset($_SESSION['id'])||!isset($_SESSION['role'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	} else {
        $username = $_SESSION['username'];
        $id = $_SESSION['id'];
        $role  = $_SESSION['role'];
    }
    if (isset($_GET['id'])) {
        $requestid = $_GET['id'];
    }
    else {
        $requestid = $id;
    }
    //verify permission
    $self = false;

    if ($role === 'teacher') {
        $approved = true;
    }
    else if ($id === $requestid) {
        $approved = true;
    }
    else {
        $approved = false;
    }
    if ($id === $requestid) {
        $self = true;
    }

	include("connect.php");
    require("redirect.php");
    require("debug.php");
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'delete') {
            if (!$self) {                       //user can not delete their account
                if ($role === 'teacher') {      //user must be teacher  

                    $sql_get_user_file = "SELECT * FROM assignments WHERE teacherId=$requestid";
                    $result_get_user_file = $connect->query($sql_get_user_file);
                    while ($fetched_row = mysqli_fetch_array($result_get_user_file)) {
                        $file = $fetched_row['files'];
                        unlink($file);
                    }

                    $sql_get_user_file = "SELECT * FROM challenges WHERE teacherid=$requestid";
                    $result_get_user_file = $connect->query($sql_get_user_file);
                    while ($fetched_row = mysqli_fetch_array($result_get_user_file)) {
                        $file = $fetched_row['files'];
                        unlink($file);
                    }

                    $sql_get_user_file = "SELECT * FROM submits WHERE studentid=$requestid";
                    $result_get_user_file = $connect->query($sql_get_user_file);
                    while ($fetched_row = mysqli_fetch_array($result_get_user_file)) {
                        $file = $fetched_row['link'];
                        unlink($file);
                    }
                    
                    $sql_get_user_challenge = "SELECT * FROM challenges WHERE teacherid=$requestid";
                    $sql_get_user_submit = "SELECT * FROM submits WHERE studentid=$requestid";

                    $sql_delete_user = "DELETE FROM users WHERE id=$requestid";
                    $sql_delete_user_message = "DELETE FROM messages WHERE idsend=$requestid OR idrec=$requestid";
                    $sql_delete_user_assignment = "DELETE FROM assignments WHERE teacherId=$requestid";
                    $sql_delete_user_challenge = "DELETE FROM challenges WHERE teacherid=$requestid";
                    $sql_delete_user_submit = "DELETE FROM submits WHERE studentid=$requestid";
                    if(!$connect->query($sql_delete_user)) {
                        breakpoint($sql_delete_user);
                        echo '<script language="javascript">alert("Some error occured while deleting user! (0x0)")</script>';
                    }   
                    if(!$connect->query($sql_delete_user_message)){
                        echo '<script language="javascript">alert("Some error occured while deleting user! (0x1)")</script>';
                    }
                    if(!$connect->query($sql_delete_user_assignment)){
                        echo '<script language="javascript">alert("Some error occured while deleting user! (0x2)")</script>';
                    }
                    if(!$connect->query($sql_delete_user_challenge)){
                        echo '<script language="javascript">alert("Some error occured while deleting user! (0x3)")</script>';
                    }
                    if(!$connect->query($sql_delete_user_submit)){
                        echo '<script language="javascript">alert("Some error occured while deleting user! (0x4)")</script>';
                    }

                    echo '<script language="javascript">alert("User deleted!")</script>';
                    back();
                }
            }
        }
    }
?>

<html>
<head>
    <link rel="stylesheet" href="style.css"/>
    
</head>
<body>
    <?php include("header.php") ?>
    <div class="container col-md-10 mx-auto">
        <h1>Profile</h1>
        <?php
            if (isset($_POST['change_avatar'])) {
                echo '<script language="javascript">window.location="upload_image.php"</script>';
            }

            $sql = "SELECT * FROM users WHERE id = $requestid";
            $result = $connect->query($sql);
            $row = mysqli_fetch_array($result);

            echo '<img height="250" width="250" src="http://localhost/challenge5a/'.$row['avatar'].'" /><br>
                    <h4>Profile image </h4>';

            if ($approved === true) {
                echo '<form action="profile.php" method="post"><input type="submit" name="change_avatar" value="Change avatar"></form>';
            }
        ?>
        <div class="col-md-6 mx-auto">
            <table class="table table-bordered table-striped">
                <tr>
                    <td>Tên đăng nhập</td>
                    <td><?php echo $row['username']; ?></td>
                </tr>
                <tr>
                    <td>Họ và tên</th>
                    <td><?php echo $row['hoten']; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $row['email']; ?></td>
                </tr>
                <tr>
                    <td>Điện thoại</td>
                    <td><?php echo $row['phone']; ?></td>
                </tr>
                <tr>
                    <td>Chức năng</td>
                    <td><?php echo $row['role']; ?></td>
                </tr>
            </table>
        </div>

        <?php
            if ($approved === true) {
                echo '<div class="col-md-1 col-xs-1 col-lg-1 mx-auto">';
                echo '<button>';
                echo '<a href="edit_profile.php?id='.$requestid.'">Edit</a>';
                echo '</button>';
                echo '</div>';
            }
        ?>
    </div>

    <?php
        if (!$self) {
            require_once("send_message.php");
        }
    ?>
    
    <?php
        //get message
        if ($self) {
            $sql_get_message = "SELECT * FROM messages WHERE idrec = $id";
        }
        else {
            $sql_get_message = "SELECT * FROM messages WHERE idrec = $requestid AND idsend = $id";
        }
        $result_get_message = $connect->query($sql_get_message);
    ?>
        
    <div class="container col-md-10 mx-auto" <?=isset($_GET['id'])?'':'style="display:none"'?>>
        <table class="table table-bordered table-striped">
            <tr style="text-align:center">
                <td>Nội dung tin nhắn   
                <td>Thời gian
                <td colspan="<?=$self?1:2?>">Hành động
            </tr>

            <?php while ($message_record = mysqli_fetch_array($result_get_message)): ?>
            <tr>
                <td><?=$message_record['content']?>
                <td><?=$message_record['createdAt']?>
                <?php
                    if(!$self)
                    echo '<td><button><a href="edit_message.php?id='.$message_record['id'].'">Edit</a></button>';
                ?>
                <td><button><a href="edit_message.php?id=<?=$message_record['id']?>&action=delete">Delete</a></button>
            </tr>
            <?php endwhile; ?>

        </table>
    </div>

</body>