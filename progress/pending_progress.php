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
   

  echo  $follow_update="INSERT INTO follow_master (clg_id,db_id,follow_date) SELECT clg_id,id,follow_date FROM `".$_SESSION['college_name']."` WHERE `ph_no`='$ph_no' ";

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
  

 if(isset($_POST['select_form'])){
echo 'hello';

  //$college_name = stripcslashes($_POST['clg_name']);
   $value=$_POST['course'];
   echo $value;

   $arr=explode("-",$value);
   $clg_id = $arr[1];
   $course_id = $arr[0];
$get_course="SELECT `course` FROM `course_master` WHERE id='$course_id'";
$course_res=$conn->query($get_course);
$value = $course_res->fetch_assoc();
$course=$value['course'];
$get_clg="SELECT * FROM `clg_master`";
$clg_res=$conn->query($get_clg);
$get_clg=$clg_res->fetch_assoc();
$college=$get_clg['clg_name'];


  //$clg1_name = strtolower($college_name);
  //$clg_name=str_replace(' ', '_', $clg1_name);
    $_SESSION['course_name']=$course; 
    $_SESSION['c_nm']=$college;
  }
  if(isset($_SESSION['c_nm'])){
  //$_SESSION['college_name'];
  $clg_nm = strtoupper($_SESSION['c_nm']);
  $clg=str_replace( '_',' ',$clg_nm);


 echo $query1 = "SELECT student_name,clg_name,course,yop,ph_no FROM `".$_SESSION['c_nm']."` WHERE call_status1=0 order by 'id' asc limit 1";
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
 





?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Powered by SWIFTERZ</title>
<!-- Latest compiled and minified CSS -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../bs/css/bootstrap.min.css">
<script type="text/javascript" src="../bs/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../bs/js/jquery.min.js"></script>


 
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

<main>
<body style="overflow-x: hidden;">


 <form action="pending_progress.php" method="post">
  <table>

          <tr colspan="4"><div class="text-center h4 "><b><?php echo $clg; ?></b></div>
          </tr>

          <tr colspan="4"><div class="text-center h4 "><?php echo $value; ?> </div>
          </tr>

          <tr colspan="4"><div class="text-center h4 "><b><?php echo $student_name; ?></b></div>
          </tr>

           <tr colspan="4"><div class="text-center h4 "><b><?php echo $yop.' -Passed Out'; ?></b></div>
           </tr>

           <tr colspan="4"><div class="text-center h4 "><b><?php echo $ph_no; ?></b></div>
          </tr>

          <tr colspan="4">    
            <div class="text-center h4 ">
             <td><label class="radio-inline">
                <input type="radio" name="current_status" id="current_status" value="NotInterested"><b>NotInterested </b></label>
           
             <label class="radio-inline">
                <input type="radio" name="current_status" id="current_status" value="Interested"><b>Interested<b/></label>

             <label class="radio-inline">
                <input type="radio" name="current_status" id="current_status" value="Waiting"><b>Waiting <b></label></td>
              </div>
          </tr>
          

<tr>    
<td> <textarea class="form-control" rows="2" id="comment" name="comment" placeholder="Remarks" ></textarea></td>
</tr>
  <tr>
    <td><input class="form-control" type="text" name="follow_date" id="follow_date"  placeholder=" Pick Follow Date"></td>
  </tr>
 
 

     <tr>
       <td>
        
          <button type="submit" class="btn btn-default btn-md" id="submit" name="submit">
          <span class="glyphicon glyphicon-phone"></span> Call
          </button>
         
      </td>
   
      <td>
       
        <button type="submit" class="btn btn-default btn-md" id="submit" name="submit">
        <span class="glyphicon glyphicon-pencil"></span> Update
        </button>
        
      </td>

      </tr>
   
   
  </table>
  </form>
<?php ?>
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
