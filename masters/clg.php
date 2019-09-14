<?php 
session_start();

if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="1")){
include"../access.php";
if(isset($_GET['clg_name'])){
	
	$college_name = stripcslashes($_GET['clg_name']);

	$clg1_name = strtolower($college_name);
	$clg_name=str_replace(' ', '_', $clg1_name);
	$query1 = "DELETE FROM `clg_master` WHERE `clg_master`.`clg_name` = '$clg_name'";

	if($conn->query($query1) === TRUE){
	?> <?php
        
        $message = '<div class="text-center h7 alert-success">User deleted Successfully</div>';

	 } else {
            
            $message = '<div class="text-center h7 alert-danger">Error</div>';
        }
}
if(isset($_POST['submit'])){

	
	$college_name =($_POST['clg_name']);
	$clg1_name = strtolower($college_name);
	$clg_name=str_replace(' ', '_', $clg1_name);
	
	$sql = "INSERT INTO `clg_master` ( `clg_name`,`college_name`) VALUES ( '$clg_name','$college_name')";
	if($conn->query($sql)===TRUE){
	?> <?php
        
       echo '<div class="text-center h3 alert-success">College Added Successfully</div>';
       
    $sql1="CREATE TABLE $clg_name (id int(225) AUTO_INCREMENT PRIMARY KEY,clg_id int(225),student_name varchar(50),clg_name varchar(50) , ph_no varchar(50) UNIQUE KEY, course varchar(50), yop varchar(50),parents_no varchar(50),address varchar(50),email varchar(50),feedback varchar(50),current_status varchar(50) DEFAULT 'NOTYET CALL',call_date1 TIMESTAMP DEFAULT CURRENT_TIMESTAMP,called_person1 varchar(50)  DEFAULT 'NOTYET CALL',call_status1 int(50),remark1 varchar(50),follow_date DATE,call_date2 DATE,called_person2 varchar(50),remark2 varchar(50),call_status2 int(50),call_date3 DATE,called_person3 varchar(50),remark3 varchar(50),call_status3 int(50),call_date4 DATE,called_person4 varchar(50),remark4 varchar(50),call_status4 int(50),call_date5 DATE,called_person5 varchar(50),call_status5 int(50),remark5 varchar(50),CONSTRAINT UC_Person UNIQUE (id,ph_no))
 ";

         if($conn->query($sql1)===TRUE)
         {
	                   $message1 = '<div class="text-center h3 alert-success">college Table Added Successfully</div>';
	     }
	     else
	     {
		 $message = '<div class="text-center h3 alert-danger">College Table doesnot created Successfully</div>';
	     }

} else {
            
            $message = '<div class="text-center h3 alert-danger">College name Already Exists</div>';
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

<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../bs/css/bootstrap.min.css">
<script type="text/javascript" src="../bs/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../bs/js/jquery.min.js"></script>
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
 			<h2 class="h2">College Master</h2>
            </div>
            <div class="col-lg-6">
           	<img src="../img/logo2.png" height="100" width="130" class="pull-right">
            </div>	
        </div>
    </div>
</header>
<main>
	<div class="container">
	<ol class="breadcrumb">
  <li><a href="../index.php">Home</a></li>
  <li><a href="index.php">Masters</a></li>
  <li class="active">College Master</li>
</ol>
            <?php
            
            if(isset($message)) {
          
                echo $message;
            }
            ?>
            
            
		<table class="table table hover">
		<form method="post" action="clg.php">
		
			<tr><td class="h3">College Name</td><td><input type="text" name="clg_name"></td></tr>
			
			<tr><td>
                                       
                                    <button type="submit" class="btn btn-primary" name="submit"><span class="glyphicon glyphicon-save"></span> Save</button></td><td></td></tr>
		</form>
			
		</table>
	</div>
</main>
<section>
	<div class="container">
		<table class="table">
		<tr><th>Sl.No.</th><!-- <th>User Id</th> --><th>College Name</th><th>Action</th></tr>
					<?php

					$sql = "SELECT * FROM `clg_master`"; 
					
						$query = $conn->query($sql);
						$slno = 1;
						while($fetch = $query->fetch_assoc()){
						
						$clg_name = $fetch['clg_name'];
						$href = "clg.php?clg_name=".$clg_name;
						$clg1_name = strtoupper($clg_name);
	                    $clg_name1=str_replace('_', ' ', $clg1_name);
					?>
		<tr><td><?php echo $slno; ?></td><!-- <td><?php echo $user_id; ?> --></td><td><?php echo $clg_name1; ?></td><td><span class="btn btn-danger"><a style="text-decoration: none; color: #FFF;" href="<?php echo $href; ?>">Delete</a></span></td></tr>

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