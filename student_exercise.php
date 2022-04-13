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

    $sql_get_assignments = "SELECT * FROM assignments";
    $get_assignment_result = $connect->query($sql_get_assignments);
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>Exercise</title>
</head>
<body>
<?php include_once("header.php") ?>
    <div class="col-md-10 mx-auto container" style="margin-top:10%;">
        <h1>Exercise</h1>
        <table class="table table-bordered table-hover">
            <thead class="thead-light">    
                <tr>
                    <th>File exercise</th>
                    <th>Date create</th>
                    <th>Your submit</th>
                    <th>Action</th>
                </tr>
            </thead>  
            <?php while ($get_assignment_row = mysqli_fetch_array($get_assignment_result)): ?>
                <tbody >
                    <tr>
                        <td><a href="<?php echo 'https://svtamvt.000webhostapp.com/'.$get_assignment_row['files']; ?>" download><?php echo $get_assignment_row['files']; ?></a></td>
                        <td><?php echo $get_assignment_row['createdAt']; ?></td>
                        <?php 
                        $assignmentid =  $get_assignment_row['id'];
                        $sql_get_submit = "SELECT * FROM submits WHERE studentid = $userid AND assignmentid = $assignmentid";
                        $get_submit_result = $connect->query($sql_get_submit);
                        if (mysqli_num_rows($get_submit_result)===1) {
                            $submit_row = mysqli_fetch_array($get_submit_result);
                            $submit_title = $submit_row['title'];
                            $submit_link = $submit_row['link'];
                            echo '<td><a href="http://svtamvt.000webhostapp.com/'.$submit_link.'">'.$submit_title.'</a></td>';
                        }
                        else {
                            echo "<td></td>";
                        }
                        
                        ?> 
                        <td><a href="upload_exercise.php?assignmentid=<?php echo $get_assignment_row['id'];?>">Upload exercise</a></td>
                    </tr>
                </tbody>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>