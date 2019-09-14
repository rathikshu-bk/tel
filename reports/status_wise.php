<?php 
session_start();
if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="1")){
include"../access.php";

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Status Report</title>
<!-- Latest compiled and minified CSS -->

<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../bs/css/bootstrap.min.css">
<script type="text/javascript" src="../bs/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../bs/js/jquery.min.js"></script>
<script type="text/javascript">
$('document').ready(function() {
    $('#output').hide();
    $('form').submit(function(e) {
        $('#output').show();
        e.preventDefault();
    });
});
</script>
<style>
#output{
display:none;
}
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
 			<h2 class="h2">Status Report</h2>
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
  <li><a href="index.php">Reports</a></li>
  <li class="active">Status Report</li>
</ol>
            <?php
            
            if(isset($message)) {
          
                echo $message;
            }
            ?>
            
            
		<table class="table table hover" style="table-border:none;">
		<form method="post" action="status_wise.php">
    <tr><td class="h3"><b>Status :</b></td><td><select name="status">
  <option  value="Interested">Interested</option>
  <option  value="NotInterest">Not Interested</option>
  <option  value="Waiting">Waiting</option>
  <option  value="Walkin">Walkin</option>
  <option  value="Register">Registered</option>
</select>
  
</body></td></tr>
      
      
    <tr><td>                                  
    <button type="submit" class="btn btn-primary" name="submit"><span class="glyphicon glyphicon-download-alt"></span> Retrieve</button></td><td></td></tr>
    </form>
      
    </table>
  </div>
</main>
<section>
  <div class="container">
    <table class="table" id="output">
    <tr><th>Sl.No.</th><!-- <th>User Id</th> --><th>College Name</th><th>Student Name</th><th>Course Name</th><th>Year Of Passing</th><th>Phone</th></tr>
          <?php
          if(isset($_POST['submit'])){
           $Status = $_POST['status'];
            $sql = "SELECT * FROM `clg_master`"; 
          
            $query = $conn->query($sql);
           

            $slno=1;
            while($fetch = $query->fetch_assoc()){
            
            $clg_name = $fetch['clg_name'];
            $status_query = "SELECT student_name,course,yop,ph_no,clg_name  FROM `$clg_name` WHERE current_status='$Status' ";
                
               $result= $conn->query($status_query);
               $tot_num_rows=$result->num_rows;
//echo mysqli_error($conn);
              
  while($row = $result->fetch_assoc()){
                  
                  $student_name=$row['student_name'];
                  $clg_nm=$row['clg_name'];
                  $course=$row['course'];
                  $yop=$row['yop'];
                  $ph_no=$row['ph_no'];
                  $clg1_name = strtoupper($clg_nm);
                  $stu_nm=strtoupper($student_name);
  $clg_name=str_replace('_', ' ', $clg1_name);
        
       if($tot_num_rows>0)  { ?>



    <tr><td><?php echo $slno; ?></td><!-- <td><?php echo $user_id; ?> --></td>

        <td><?php echo $clg_name; ?></td>
        <td><?php echo $stu_nm; ?></td>
        <td><?php echo $course; ?></td>
        <td><?php echo $yop; ?></td>
        <td><?php echo $ph_no; ?></td>
        


          <?php  $slno++; }
         }
        }
      }
          ?>

    </table>
  </div>
</section>
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
