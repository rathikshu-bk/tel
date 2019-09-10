<?php 
session_start();
if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="1")){
  

//$_SESSION['clg_name']='$clg_name';

include"../access.php";
//$clg_name=$_GET['clg_name'];
//if(isset($_GET['clg_name'])){
if(isset($_POST['submit'])){
  "hi";
    $table_name = $_SESSION['reg_progress'];
 //$current_status=$_POST['current_status'];
 //$ph_no=$_POST['ph_no'];


  
 $hobby=array();
 $hobby=$_POST['walkin'];

  foreach ($hobby as $hoby=>$value) {
            "Hobby : ".$value."<br />";
        
 //echo $t1;
   //$check_ph=  implode(",", $value);
   //echo $check_ph;

        //$check_ph = $t1[$i];
      $s = "UPDATE $table_name SET `current_status`='registration' WHERE db_id='".$value."' ";

                $res=$conn->query($s);
              }
                if($res){
                    echo '<div class="text-center h7 alert-success">Inserted Successfully</div>';
                }else{
                    echo '<div class="text-center h7 alert-danger">Error</div>';
                }
     

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
  <script type="text/javascript" src="../bs/js/html-table-search.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('table.search-table').tableSearch({
          searchText:'<span class="glyphicon glyphicon-filter"> </span>  Filter :',
          searchPlaceHolder:'  Input Value'
        });
      });
    </script>
<style>
.custom_header{
  background-color:#FFFFFF;
  color:#094ca1;
}
.form-actions{
    margin: 0;
    background-color: transparent;
    text-align: right;
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
   <li><a href="../index.php">Progress</a></li>
  <li class="active">Registration</li>
</ol>

</main>
</main>
<section>
  <form action="registration_progress.php" method="post">
	<div class="container">
		  <table class="search-table table" >
		<tr><th>Sl.No.</th><!-- <th>User Id</th> --><th>Student Name</th><th>Course</th><th>Year Of Passing</th><th>Phone no</th><th>Walkin Status</th></tr>
					<?php
if(isset($_GET['clg_name'])){

  $college_name = stripcslashes($_GET['clg_name']);


  $clg1_name = strtolower($college_name);
  $clg_name=str_replace(' ', '_', $clg1_name);
    $_SESSION['reg_progress']=$clg_name; 
  }
  if(isset($_SESSION['reg_progress'])){
 $walkin=$_SESSION['reg_progress'];

$query1 = "SELECT db_id,student_name,clg_name,course,yop,ph_no FROM `$walkin`  order by 'db_id' asc ";
  $result= $conn->query($query1);
//echo mysqli_error($conn);
   $slno=1;
 while($row = $result->fetch_assoc()){
                  $db_id=$row['db_id'];
                  $student_name=$row['student_name'];
                  $clg_name=$row['clg_name'];
                  $course=$row['course'];
                  $yop=$row['yop'];
                  $ph_no=$row['ph_no'];
//printf ("%s (%s)\n", $row["Name"], $row[""]);
    //$row=mysqli_fetch_array($result);
    //print_r($row);
                  


?>
												 	 <tr>
												<td><?php echo $slno; ?></td>
												 	    <td><?php echo $student_name; ?></td>
												 	    <td><?php echo $course; ?></td>
                                <td><?php echo $yop; ?></td>
                                  <td ><?php echo $ph_no; ?></td>
                                  <td><input type="checkbox" class="form-check-input" id="walkin[]" name="walkin[]" value="<?php echo $db_id; ?>" ></td>


												 	</tr>

												 
					<?php $slno++;	}
				
						?>
            

		</table>
	</div>
<div class="form-actions">
           
                    <button type="submit" name="submit" >
   <span class="glyphicon glyphicon-floppy-saved"> SAVE</span>
</button>
</div>
</form>
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
}}

else{
    header("Location:../login.php");
}
?>
