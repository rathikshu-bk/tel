<?php 
session_start();
if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="1")){
include"../access.php";
 $conn = mysqli_connect("localhost", "root", "", "tel");  



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
 			<h2 class="h2">Tele Calling Progress</h2>
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
            
            
		
	</div>
</main>
<section>
	<div class="container">
		<table class="table">
		<tr><th>Sl.No.</th><!-- <th>User Id</th> --><th>College Name</th><th>Pending Calls</th></tr>
					<?php

					$sql = "SELECT * FROM clg_master ";     

											 $result = $conn->query($sql);
											 $slno=1;
											while($fetch = $result->fetch_assoc()){
												 $clg_name=$fetch['college_name'];
												// $college_name1 =($_POST['clg_name']);
													$clg1_name = strtolower($clg_name);
													$clg_name1=str_replace(' ', '_', $clg1_name);
												echo $query_call_stauts = "SELECT `call_status1` FROM `$clg_name1` WHERE `call_status1`= 0";
												 $result2 = $conn->query($query_call_stauts);
												 echo mysqli_error($conn);
												 if (!$result2) {
																     echo "Could not successfully run query ($conn) from DB: " . mysqli_error();
																    exit;
}
												 $pending_calls = $result2->num_rows;
												 $href = "pending_progress.php?clg_name=".$clg_name;
												 if($pending_calls>0){?>
												 	 <tr>
												 	 	<td><?php echo $slno; ?></td>
												 	    </td><td><a href ="<?php echo $href; ?>"><?php echo $clg_name; ?></a></td>
												 	    <td><?php echo $pending_calls; ?></td>

												 	</tr>


												  <?php  } ?>
												 
					<?php $slno++;	}
				
						?>

		</table>
	</div>
</section>
<br>
<br>
<footer>
        <div class="container text-right">
        <span class="h5">Powered By</span>
        <img src="../img/logo.png" height="80" width="201">
    </div>
</footer>
</body>
</html>
<?php
}

else{
    header("Location:../login.php");
}
?>
