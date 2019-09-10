<?php 
session_start();
if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="1")){
  

//$_SESSION['clg_name']='$clg_name';

include"../access.php";
//$clg_name=$_GET['clg_name'];
//if(isset($_GET['clg_name'])){
if(isset($_POST['submit'])){
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Powered by SWIFTERZ</title>
<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  

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
  input{
        border: none;
        outline: none;
    }
    input[type="radio"]{
   float: left;
   width: auto;
  
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


<div class="container main_container">
<ol class="breadcrumb">
  <li><a href="../index.php">Home</a></li>
  <li class="active">Progress</li>
</ol>

</main>
</main>
<section>
	<div class="container">
		<table class="table">
		<tr><th>Sl.No.</th><!-- <th>User Id</th> --><th>College Name</th><th>Total</th></tr>
					<?php

					$sql = "SELECT `college_name` FROM clg_master ";     

											 $result = $conn->query($sql);
											 $slno=1;
											while($fetch = $result->fetch_assoc()){
												 $clg_name=$fetch['college_name'];
												// $college_name1 =($_POST['clg_name']);
													$clg1_name = strtolower($clg_name);
													$clg_name1=str_replace(' ', '_', $clg1_name);
												 $query_call_stauts = "SELECT * FROM `$clg_name1` ";
												 $result2 = $conn->query($query_call_stauts);
												 if (!$result2) {
																    echo "Could not successfully run query ($sql) from DB: " . mysqli_error();
																    exit;
}
												 $pending_calls = $result2->num_rows;
												 $href = "registration_progress.php?clg_name=".$clg_name;
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
