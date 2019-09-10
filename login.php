<?php
include"access.php";
if(isset($_POST['submit'])){
	echo $email = $_POST['user_email'];
	$root = md5($_POST['user_root']);

	$query = "SELECT * FROM `user_master` WHERE `user_email` = '$email'";
	$result = $conn->query($query);
	echo mysqli_error($conn);
	$fetch  = $result->fetch_assoc();
	$user_root = $fetch['user_root'];
	$priority = $fetch['priority'];
	if ($user_root == $root) {
		session_start();
		$_SESSION['user'] = $email;
		$_SESSION['user_priority'] = $priority;
		if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])){
			header("LOCATION:index.php");	
		}
		else{
			$_SESSION['user'] = $user_email;
		$_SESSION['user_priority'] = $priority;
		}
		
	}
	else{
		?><span class="h3" style="color: red;">Username/Password Incorrect. Try Again. </span><?php
	}
}



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Powered by Big Data</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bs/css/bootstrap.min.css">
<script type="text/javascript" src="bs/js/bootstrap.min"></script>
<style>
.custom_header{
	background-color:#FFFFFF;
	color:#094ca1;
}

.main_container{
	margin-top:50px;
	}
.footer_jumbo{
margin-top:75px;
}
a{
    text-decoration: none;
    color: #000;
}


</style>
</head>


<body style="overflow-x: hidden;">
<!--<div id="loading">
        <img id="loading-image" src="img/loadinggif.GIF" alt="Loading..." />
        <h4 style="margin-top: 30%;">Powered by Big Data</h4>
    </div>-->
<header>
	<div class="jumbotron custom_header">
    	<div class="container">
        <div class="row">
        <div class="col-lg-6">
        <br><br>
 			<h2 class="h2">Login</h2>
            </div>
            <div class="col-lg-6">
            <img src="img/logo2.png" height="100" width="180" class="pull-right">
            </div>	
        </div>
    </div>
</header>
<main>
	<div class="row">
	<div class="container">
		<div class="col-lg-4"></div>
		<div class="col-lg-4">
			<table class="table table-striped">
				<form method="post" action="login.php">
					<input class="form-control" type="text" name="user_email" placeholder="Enter your Mail Id">
					<br><br>
					<input class="form-control" type="password" name="user_root" placeholder="Enter your login Password">
					<br><br>
					<input type="submit" class="btn btn-success" name="submit">
				</form>
			</table>
		</div>
		<div class="col-lg-4"></div>
	</div>
	</div>	
</main>

</body>
</html>