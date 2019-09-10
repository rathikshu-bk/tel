<?php 
session_start();
if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="1")){
  

//$_SESSION['clg_name']='$clg_name';

include"../access.php";
//$clg_name=$_GET['clg_name'];
//if(isset($_GET['clg_name'])){
if(isset($_POST['submit'])){
echo 'hey it will work ';
 
 $current_status=$_POST['current_status'];
 echo $current_status;
 $ph_no=$_POST['ph_no'];
 
 $follow_date=$_POST['follow_date'];
 $comment=$_POST['comment'];
 $table_name = $_SESSION['follow_clg'];
 $sql_clg_id="SELECT clg_id,db_id FROM $table_name WHERE ph_no=$ph_no";
 $res_sql_clg_id=$conn->query($sql_clg_id);
 $row_clg_id=$res_sql_clg_id->fetch_assoc();
 $clg_id=$row_clg_id['clg_id'];
 $db_id=$row_clg_id['db_id'];
 echo $clg_id;
echo  $sql_del="DELETE * FROM `follow_master` WHERE clg_id='$clg_id' AND follow_date='$follow_date' AND db_id='$db_id'";
 
 $res_sql_del=$conn->query($sql_del);


$i=2;
for($i=2; $i<6; $i++){
  
 
  $field_name = "call_status".$i;
$cl_status_chck="SELECT `$field_name` FROM `$table_name` WHERE `ph_no`='$ph_no'";
$res=$conn->query($cl_status_chck);
$fetch = $res->fetch_assoc();
if($fetch["$field_name"]=='0'){
    echo "CALL DONE";
    break;
    $user = $_SESSION['user'];
    $field_name="call_date".$i;
    $field_name2 = "called_person".$i;
    $field_name3 = "call_status".$i;
    $field_name4 = "remarks".$i;
  $sql = "UPDATE `$table_name` SET `$field_name` = '$today', `$field_name2` = '$user', `$field_name3` = '1', `$field_name4` = '$comment' `current_status`='$current_status' WHERE `ph_no` = $ph_no;";
$result=$conn->query($sql);
die($mysqli_error($conn));
  if($result){

  //$clg1_name = strtolower($college_name);
// //echo $clg_name=str_replace(' ', '_', $clg1_name);
//echo $clg_name;
}
 else {
            
            echo '<div class="text-center h3 alert-danger">Error</div>';
        }

    
}$i++;
  $today = date("Y-m-d");
    $user = $_SESSION['user'];
    $field_name="call_date".$i;
    $field_name2 = "called_person".$i;
    $field_name3 = "call_status".$i;
    $field_name4 = "remark".$i;
$sql = "UPDATE `$table_name` SET `$field_name` = '$today', `$field_name2` = '$user', `$field_name3` = '1', `$field_name4` = 'TESTREMARKS' WHERE `ph_no` = $ph_no;";
//break;

$result=$conn->query($sql);
echo mysqli_error($conn);
  if($result){

  //$clg1_name = strtolower($college_name);
// //echo $clg_name=str_replace(' ', '_', $clg1_name);
//echo $clg_name;
}
 else {
            
            echo '<div class="text-center h3 alert-danger">Error</div>';
        }

//break;
}
}


  
      

//$sql1="INSERT INTO follow_date (clg_id,db_id,follow_date) SELECT "




 if(isset($_GET['clg_name'])){
 echo 'hi';
  $college_name = stripcslashes($_GET['clg_name']);
$college_name;
 
  $clg1_name = strtolower($college_name);
  $clg_name=str_replace(' ', '_', $clg1_name);
   echo  $_SESSION['follow_clg']=$clg_name; 
  }
  if(isset($_SESSION['follow_clg'])){
  $_SESSION['follow_clg'];
  $clg_nm = strtoupper($_SESSION['follow_clg']);
  $clg=str_replace('_',' ',$clg_nm);


 $query1 = "SELECT clg_id,student_name,clg_name,course,yop,ph_no FROM `".$_SESSION['follow_clg']."` WHERE `follow_date`<=CURRENT_DATE() order by 'db_id' asc limit 1";
  $result= $conn->query($query1);
//echo mysqli_error($conn);
  $row = $result->fetch_assoc();
                  $clg_id=$row['clg_id'];
                  $student_name=$row['student_name'];
                  $clg_name=$row['clg_name'];
                  $course=$row['course'];
                  $yop=$row['yop'];
                  $ph_no=$row['ph_no'];
//printf ("%s (%s)\n", $row["Name"], $row[""]);
    //$row=mysqli_fetch_array($result);
    //print_r($row);
  //if($row==0){
       //unset($_SESSION['follow_clg']);
          
  
            //echo '<div class="text-center h7 alert-danger">No pending calls.</div>';
             //header("Location: follow_progress.php");


        }

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Powered by SWIFTERZ</title>
<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="../bs/css/bootstrap.min.css">
  <script src="../bs/js/jquery.min.js"></script>
  <script src="../bs/js/bootstrap.min.js"></script>
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
   <li><a href="index.php">Progress</a></li>
  <li class="active">Follow-Ups</li>
</ol>

</main>
<body style="overflow-x: hidden;">


 <form action="follow_progress.php" method="post">
  <table>
          <tr><td> <label for="comment">College Name:</label></td>
              <td><input type="text" name="clg_name" id="clg_name" value="<?php echo $clg ?> "></td>
          </tr>

          <tr><td><label for="comment">Student Name:</label></td>
             <td><input type="text" name="student_name" id="student_name" value="<?php echo $student_name ?> " ></td>
          </tr>

          <tr><td> <label for="comment">Course:</label></td>
              <td><input type="text" name="dept" id="dept" value="<?php echo $course ?> ">  </td>
       
          </tr>
           <tr><td><label for="comment">Year of Passing:</label></td>
              <td><input type="text" name="yop" id="yop" value="<?php echo $yop ?> ">  </td>
       
          </tr>
           <tr><td><label >Contact No:</lable></td>
              <td><input type="text" name="ph_no" id="ph_no" value="<?php echo $ph_no ?> ">  </td>
       <td><a href="#" class="btn btn-success btn-md">
              <span class="glyphicon glyphicon-earphone"></span>  Call 
           </a>
      </td>
          </tr>
          

<tr>    
  <td><label>Status</lable>
   <td><label class="radio-inline">
      <input type="radio" name="current_status" id="current_status" value="NotInterested">NotInterested </label>
 
  <label class="radio-inline">
      <input type="radio" name="current_status" id="current_status" value="Interested">Interested</label>

 <label class="radio-inline">
      <input type="radio" name="current_status" id="current_status" value="Waiting">Waiting </label></td>

<!--     <td><label class="radio-inline">
      <input type="radio" name="current_status" id="current_status" value="WalkIn">WalkIn </label>
  </td>
    <td><label class="radio-inline">
      <input type="radio" name="current_status" id="current_status"  value="Register">Register </label>
  </td> -->
</tr>
  <tr><td><label >Follow Date:</label></td>
              <td><input class="form-control" type="text" name="follow_date" id="follow_date"  ></td>
          </tr>
  <tr> <td>
      <label for="comment">Comment:</label>
      <textarea class="form-control" rows="2" id="comment" name="comment"></textarea></td>
   </tr>
   
   <br><br>
<tr></tr>
     <tr><td>
      
        </td></tr>
   
    </table>
    <div align=center>
      <button type="submit" class="btn btn-default btn-lg" id="submit" name="submit">
          <span class="glyphicon glyphicon-pencil"></span> Update
        </button>
        </div> 
  </form>

 
   </div>
  
 
</main>
 

  
<script>



      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#cl_date").datepicker();  
                $("#follow_date").datepicker();
                
                
           }); 
             
      
            });

 </script>
</main>
<br>
<br>
<footer>
        <div class="container text-right">
        <span class="h5">Powered By</span>
        <img src="../img/logo.png" height="80" width="201">
    </div>
</footer>

<?php
}

else{
    header("Location:../login.php");
}
?>
</body>
</html>