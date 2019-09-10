<?php 
session_start();
if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="1")){
include"../access.php";
if(isset($_GET['user_name'])){
	
	$user_name = stripcslashes($_GET['user_name']);
	
	$query1 = "DELETE FROM `user_master` WHERE `user_master`.`user_name` = '$user_name'";

	if($conn->query($query1) === TRUE){
	?> <?php
        
        $message = '<div class="text-center h7 alert-success">User deleted Successfully</div>';
	 } else {
            
            $message = '<div class="text-center h7 alert-danger">Error</div>';
        }
}
if(isset($_POST['submit'])){

	$user_name = $_POST['user_name'];
	$user_root =md5($_POST['user_root']);
	$user_email = $_POST['user_email'];
	$user_priority = $_POST['user_priority'];
	$sql = "INSERT INTO `user_master` (`user_id`, `user_name`, `user_root`, `user_email`,`priority`) VALUES (NULL, '$user_name', '$user_root', '$user_email','$user_priority')";
	if($conn->query($sql)===TRUE){
	?> <?php
        
        $message = '<div class="text-center h3 alert-success">User Added Successfully</div>';
	} else {
            
            $message = '<div class="text-center h3 alert-danger">User Already Exists</div>';
            ?>
            <?php
            
        }

}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User Master Entry</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../bs/css/bootstrap.min.css">
<script type="text/javascript" src="../bs/js/bootstrap.min"></script>
<style>
.custom_header{
	background-color:#FFFFFF;
	color:#094ca1;
}
.logo_header{
    margin-right: 120px;
}
</style>
</head>


<body>
<header>
	<div class="jumbotron custom_header">
    	<div class="container">
        <div class="row">
        <div class="col-lg-6">
        <br><br>
 			<h2 class="h2">Progress Master</h2>
            </div>
            <div class="col-lg-6">
           	<img src="../img/logo2.png" height="100" width="180" class="pull-right">
            </div>	
        </div>
    </div>
</header>
<main>
	<div class="container">
	<ol class="breadcrumb">
  <li><a href="../index.php">Home</a></li>
  <li><a href="index.php">Masters</a></li>
  <li class="active">User Master</li>
</ol>
            <?php
            
            if(isset($message)) {
          
                echo $message;
            }
            ?>
            
            
		<table class="table table hover">
		<form method="post" action="user_master.php">
		
			<tr><td class="h3">Employee Name</td><td><input type="text" name="user_name"></td></tr>
                        <tr><td class="h3">Login Password</td><td><input type="Password" name="user_root" required=""></td></tr>
                        <tr><td class="h3">Employee  Email or UserName for Login</td><td><input type="text" name="user_email" required=""></td></tr>
			<tr><td class="h3">Priority</td><td><input type="text" name="user_priority" placeholder="1 for Master access. 2 for other two"></td></tr>
			<tr><td><input type="submit" name="submit"></td><td></td></tr>
		</form>
			
		</table>
	</div>
</main>
<section>
	<div class="container">
		<table class="table">
		<tr><th>Sl.No.</th><!-- <th>User Id</th> --><th>User Name</th><th>Action</th></tr>
					<?php

					$sql = "SELECT * FROM `user_master`"; 
					
						$query = $conn->query($sql);
						$slno = 1;
						while($fetch = $query->fetch_assoc()){
						$user_id = $fetch['user_id'];
						$user_name = $fetch['user_name'];
						$href = "user_master.php?user_name=".$user_name;
					?>
		<tr><td><?php echo $slno; ?></td><!-- <td><?php echo $user_id; ?> --></td><td><?php echo $href; ?></td><td><span class="btn btn-danger"><a style="text-decoration: none; color: #FFF;" href="<?php echo $href; ?>"></a></span>Delete</td></tr>

					<?php $slno++;	}
					?>

		</table>
	</div>
</section>

</body>
</html>
<?php


}
else{
    header("Location:../login.php");
}

?>
