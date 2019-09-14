<?php 
session_start();
if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="1")){
 
include"../access.php"; 

//$clg_name=$_GET['clg_name'];
//if(isset($_GET['clg_name'])){


  

 if (!empty($_POST['course'])) {
    


  //$college_name = stripcslashes($_POST['clg_name']);
 $_SESSION['course_name'] =$_POST['course'];
 $value=$_SESSION['course_name'];

   $arr=explode("-",$value);
   $clg_id = $arr[1];
   $course_id = $arr[0];

$get_course="SELECT `course` FROM `course_master` WHERE id='$course_id'";
$course_res=$conn->query($get_course);
$value = $course_res->fetch_assoc();
$course=$value['course'];

$get_clg="SELECT * FROM `clg_master` WHERE `id`='$clg_id' ";
$clg_res=$conn->query($get_clg);
$get_clg=$clg_res->fetch_assoc();
$college=$get_clg['clg_name'];

mysqli_error($conn);

  //$clg1_name = strtolower($college_name);
  //$clg_name=str_replace(' ', '_', $clg1_name);
   
   echo $_SESSION['c_nm']=$college;

echo $_SESSION['course_name']=$course;
//echo $c=$_SESSION['c_nm'];
}

if(isset( $_SESSION['c_nm']))
{

  
  $clg_nm = strtoupper($_SESSION['c_nm']);
  $clg=str_replace( '_',' ',$clg_nm);


 $query1 = "SELECT student_name,clg_name,course,yop,ph_no FROM `".$_SESSION['c_nm']."` WHERE call_status1=0 AND `course`='".$_SESSION['course_name']."' order by 'id' asc limit 1";
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
  
}
if(isset($_POST['submit_update']))
{


 $current_status=$_POST['current_status'];
 $ph_no=$_POST['ph_no'];

 $follow_date=$_POST['follow_date'];
 $comment=$_POST['comment'];

$sql = "UPDATE  `".$_SESSION['c_nm']."` SET `called_person1`='".$_SESSION['user']."', `current_status`='$current_status',  call_status1=1,`remark1`='$comment',`follow_date`='$follow_date' WHERE `ph_no`='$ph_no' ";
//$sql1="INSERT INTO follow_date (clg_id,db_id,follow_date) SELECT "
$result=$conn->query($sql);
  if($result){
   

    $follow_update="INSERT INTO follow_master (clg_id,db_id,follow_date) SELECT clg_id,id,follow_date FROM `".$_SESSION['c_nm']."` WHERE `ph_no`='$ph_no' ";

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
  



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Powered by SWIFTERZ</title>
<!-- Latest compiled and minified CSS -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../bs/css/bootstrap.min.css">
  <script type="text/javascript" src="../bs/js/jquery.min.js"></script>

<script type="text/javascript" src="../bs/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  


 
<style>
fieldset {
    text-align: center;
}
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


 <form action="pending_pgs_dup.php" method="post">
  <table style="border:1px solid white;margin-left:auto;margin-right:auto;">
    <?php
    if(isset( $_SESSION['c_nm']))
{


  
  $clg_nm = strtoupper($_SESSION['c_nm']);
  $clg=str_replace( '_',' ',$clg_nm);


 $query1 = "SELECT id,student_name,clg_name,course,yop,ph_no FROM `".$_SESSION['c_nm']."` WHERE call_status1=0 order by 'id' asc limit 1";
  $result= $conn->query($query1);
//echo mysqli_error($conn);
   $row = $result->fetch_assoc();
                   $id=$row['id'];
                  $student_name=$row['student_name'];
                  $clg_name=$row['clg_name'];
                  $course=$row['course'];
                  $yop=$row['yop'];
                  $ph_no=$row['ph_no'];
//printf ("%s (%s)\n", $row["Name"], $row[""]);
    //$row=mysqli_fetch_array($result);
    //print_r($row);
  
}
?>

          <tr colspan="4"><div class="text-center h4 "><b><?php echo $clg; ?></b></div>
          </tr>

          <tr colspan="4"><div class="text-center h4 "><b><?php echo $_SESSION['course_name']; ?></b> </div>
          </tr>

          <tr colspan="4"><div class="text-center h4 "><b><?php echo $student_name; ?></b></div>
          </tr>

           <tr colspan="4"><div class="text-center h4 "><b><?php echo $yop.' -Passed Out'; ?></b></div>
           </tr>

           <tr colspan="4" ><div class="text-center h4 "><b><input type="text" style="text-align:center" name="ph_no" value="<?php echo $ph_no; ?>"></b></div>
          </tr>

  <tr>    
  
   <td>
      <input type="radio" name="current_status" id="current_status" value="NotInterested">NotInterested </td>
 
  <td>
      <input type="radio" name="current_status" id="current_status" value="Interested">Interested</td>

 <td>
      <input type="radio" name="current_status" id="current_status" value="Waiting">Waiting </td>
</tr>       
          

<tr >
<th colspan="4" style="text-align:center"> <textarea class="form-control" rows="2" id="comment" name="comment" placeholder="Remarks" ></textarea></th></div></tr>
  <tr >
    <th colspan="4" style="text-align:center"><div class="text-center h4 ">  <input class="form-control" type="text" name="follow_date" id="follow_date"  placeholder=" Pick Follow Date"></th>
  </tr>
 
 
<tr >
       <th colspan="2" style="text-align:center">
        
          <button type="submit" class="btn btn-success btn-md" id="submit" name="submit">
          <span class="glyphicon glyphicon-earphone"></span> Call
          </button>
         
      </th>
   
      <th colspan="2" style="text-align:center">
       
        <button type="submit" class="btn btn-primary btn-md" id="submit_update" name="submit_update">
        <span class="glyphicon glyphicon-pencil"></span> Update
        </button>
        
      </th>
   
      </tr>
      <tr><th colspan="2" style="text-align:center"></th> </tr>
     
<tr><th colspan="4" style="text-align:center">
 <input type="button" class="btn btn-info" value="Go To Homepage" onclick="location.href = 'pend.php';">
      </th>
</tr>
   
   
  </table>
  </form>

  </div>

</main>
<br>
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
