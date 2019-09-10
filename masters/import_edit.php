 <?php 
session_start();
if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="2")){
include"../access.php";
if(isset($_POST["Import_edit"]))
{ 
  echo 'hello rathikshu!';
 

 $clg_id=$_POST['clg_name'];
 echo $clg_id;
 $s="SELECT `clg_name` from clg_master WHERE id=$clg_id";
 $res=$conn->query($s);
 while ($row_a = mysqli_fetch_assoc($res)) 
 {
   $clg_name=$row_a['clg_name'];
 }
 echo $clg_name;
 $_SESSION['college_name']=$clg_name;
 $address=$_POST['address'];
 $student_name=$_POST['student_name'];
 $parent_no=$_POST['parent_no'];
 $email=$_POST['email'];
 $course=$_POST['course'];
 $yop=$_POST['yop'];
 $ph_no=$_POST['ph_no'];
 $feedback=$_POST['feedback'];


  
  echo $sql = "INSERT INTO `$clg_name` ( `clg_id`,`student_name`,`course`,`yop`,`address`,`ph_no`,`parents_no`,`email`,`feedback`) VALUES ( '$clg_id','$student_name','$course','$yop','$address','$ph_no','$parent_no','$email','$feedback')";
  if($conn->query($sql)===TRUE){

      echo  '<div class="text-center h3 alert-success">Student Info Added Successfully</div>';
        echo $clg_name;
}
}
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
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
    margin-right: 100px;
}
.dropdown,.dropdown-menu {
  left: 50% !important;
  right: auto !important;
  text-align: center !important;
  transform: translate(-50%, 0) !important;
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
          <h2 class="h2">Update Info</h2>
          </div>
              <div class="col-lg-6">
              <img src="../img/logo2.png" height="100" width="130" class="pull-right">
              </div>  
        </div>
        </div>
  </header>
<div class="container">
<ol class="breadcrumb">
  <li><a href="../index.php">Home</a></li>
  <li><a href="index.php">Masters</a></li>
  <li class="active">Upload</li>
</ol>

 <div class="row">
 <form class="form-horizontal" action="import_edit.php"  method="post" >
                       
                            <!-- Form Name -->
                            

                             <div class="form-group">
                                <label class="col-md-4 control-label" for="editbutton">College Name:</label>
                                <div class="col-md-4">
                                    <select class="selectpicker" name="clg_name" id="clg_name" style=" height:28px; border: ridge;" >
                                     <option value="" disabled selected>Select College name</option>
                                     <?php
                                     $list = mysqli_query($conn,"SELECT * FROM `clg_master` ");
                                     while ($row_ah = mysqli_fetch_assoc($list)) { 
                                      $clg_id=$row_ah['id'];
                                      $clg_name=$row_ah['clg_name'];

                                     ?>

                                      <option   value="<?php echo $row_ah['id']; ?>"><?php echo $row_ah['clg_name']; ?></option>
                                      <?php } ?>
                                      </select> 
                                </div>
                             </div>
                            <!-- File Button -->
                           
                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="editbutton">Course:</label>
                                 <div class="col-md-4">
                                    <select class="selectpicker" name="course" id="course"   style=" height:28px; border: ridge;" >
                                     <option value="" disabled selected>Select Course</option>
                                     <?php
                                     $l = mysqli_query($conn,"SELECT `course` FROM `course_master` ");
                                     while ($row_ah = mysqli_fetch_assoc($l)) {
                                     ?>

                                    <option value="<?php echo $row_ah['course']; ?>"><?php echo $row_ah['course']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                            </div>
                                
                            
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="editbutton">Student Name:</label>
                                 <div class="col-md-4">
                                    <input type="text" name="student_name" id="student_name"   style=" height:28px; border: ridge;">
                                </div>

                                
                            </div>
                             <div class="form-group">
                                <label class="col-md-4 control-label" for="editbutton">Year Of Passing:</label>
                                 <div class="col-md-4">
                                    <input type="text" name="yop" id="yop"   style=" height:28px; border: ridge;">
                                </div>

                                
                            </div>
                             <div class="form-group">
                                <label class="col-md-4 control-label" for="editbutton">Contact Number:</label>
                                 <div class="col-md-4">
                                    <input type="text" name="ph_no" id="ph_no"   style=" height:28px; border: ridge;">
                                </div>

                                
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="editbutton">Address:</label>
                                 <div class="col-md-4">
                                    <textarea class="form-control" rows="2" id="address" name="address"></textarea>
                                </div>

                                
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="editbutton">Parents contact number:</label>
                                 <div class="col-md-4">
                                    <input type="text" name="parent_no" id="parent_no"   style=" height:28px; border: ridge;">
                                </div>

                                
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="editbutton">E-mail:</label>
                                 <div class="col-md-4">
                                    <input type="text" name="email" id="email"   style=" height:28px; border: ridge;">
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="editbutton">FeedBack:</label>
                                 <div class="col-md-4">
                                    <input type="text" name="feedback" id="feedback"   style=" height:28px; border: ridge;">
                                </div>

                            </div>
                            
                            <center><Button type="submit"  value="Save Info" class="btn btn-success btn-md" name="Import_edit" id="Import_edit">
                              <span class="glyphicon glyphicon-save"></span>Save Info 
                            </Buttton></center>
                          
                   
                 
      </div>
</div>
      
<br>
<br>
</form>
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