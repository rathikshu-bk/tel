<?php 
session_start();
if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="1")){
  

//$_SESSION['clg_name']='$clg_name';

include"../access.php";
//$clg_name=$_GET['clg_name'];
//if(isset($_GET['clg_name'])){
if(isset($_POST['submit'])){
 
 $current_status=$_POST['current_status'];
 $ph_no=$_POST['ph_no'];

 $follow_date=$_POST['follow_date'];
 $comment=$_POST['comment'];
  
  

  //$clg1_name = strtolower($college_name);
// //echo $clg_name=str_replace(' ', '_', $clg1_name);
//echo $clg_name;

 $sql = "UPDATE  `".$_SESSION['college_name']."` SET `called_person1`='".$_SESSION['user']."', `current_status`='$current_status',  call_status1=1,`remark1`='$comment',`follow_date`='$follow_date' WHERE `ph_no`='$ph_no' ";
//$sql1="INSERT INTO follow_date (clg_id,db_id,follow_date) SELECT "
$result=$conn->query($sql);
  if($result){
   

    $follow_update="INSERT INTO follow_master (clg_id,db_id,follow_date) SELECT clg_id,db_id,follow_date FROM `".$_SESSION['college_name']."` WHERE `ph_no`='$ph_no' ";

    $resultt=$conn->query($follow_update);
    if($resultt)
    {
       echo  '<div class="text-center h3 alert-success"> Added Successfully</div>';
    }
  }
 else {
            
            echo '<div class="text-center h3 alert-danger">Error</div>';
        }
 }
  

 if(isset($_GET['clg_name'])){

  $college_name = stripcslashes($_GET['clg_name']);


  $clg1_name = strtolower($college_name);
  $clg_name=str_replace(' ', '_', $clg1_name);
    $_SESSION['college_name']=$clg_name; 
  }
  if(isset($_SESSION['college_name'])){
  $_SESSION['college_name'];
  $clg_nm = strtoupper($_SESSION['college_name']);
  $clg=str_replace( '_',' ',$clg_nm);


  $query1 = "SELECT student_name,clg_name,course,yop,ph_no FROM `".$_SESSION['college_name']."` WHERE call_status1=0 order by 'db_id' asc limit 1";
  $result= $conn->query($query1);
//echo mysqli_error($conn);
  $row = $result->fetch_assoc();
                  $student_name=$row['student_name'];
                  $clg_name=$row['clg_name'];
                  $course=$row['course'];
                  $yop=$row['yop'];
                  $ph_no=$row['ph_no'];
//printf ("%s (%s)\n", $row["Name"], $row[""]);
    //$row=mysqli_fetch_array($result);
    //print_r($row);
  if($row==0){
       unset($_SESSION['college_name']);
          
  
            echo '<div class="text-center h7 alert-danger">No pending calls.</div>';
             header("Location: pend.php");


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
<body style="overflow-x: hidden;">


 <form action="pending_progress.php" method="post">
  <table>
          <tr><td> <label for="comment">College Name:</label></td>
              <td><input type="text" name="clg_name" id="clg_name " value="<?php echo $clg ?> "></td>
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
  </td> 
  <td><label class="radio-inline">
      <input type="radio" name="current_status" id="current_status" value="Interested">Interested</label>
  </td>
    
    <td><label class="radio-inline">
      <input type="radio" name="current_status" id="current_status" value="Waiting">Waiting </label>
  </td>
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
</body>
</html>
<?php
}
}
else{
    header("Location:../login.php");
}
?>
