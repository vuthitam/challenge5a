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
                header("location:upload_image.php");
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