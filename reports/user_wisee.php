<?php
session_start();
if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="1")){
include "../access.php";


if(!empty($_POST["clg_name"])){
  $clg_name = stripcslashes($_POST['clg_name']);
   $_SESSION['userwise_clg']=$clg_name;
  $_SESSION['userwise_clg'];

  
    if(!empty($_POST["course"]))
    {
        //echo 'hoi';
        $course = stripcslashes($_POST['course']);
        
        $connect = mysqli_connect("localhost", "root", "", "tel");  
       $query = "SELECT called_person1, count(*) as number FROM $clg_name WHERE `course` LIKE '%$course' GROUP BY called_person1 ";  
         $result = mysqli_query($connect, $query);  
        }
    else
    {
      //echo 'hi';
     $connect = mysqli_connect("localhost", "root", "", "tel");  
     $query = "SELECT called_person1, count(*) as number FROM $clg_name GROUP BY called_person1 ";  
     $result = mysqli_query($connect, $query);  

    }
}
if(!empty($_POST["user_name"])){
//echo 'hy';
  $user_name=stripcslashes($_POST['user_name']);
   $connect = mysqli_connect("localhost", "root", "", "tel"); 
  $user_query="SELECT current_status,count(*) as tot FROM ".$_SESSION['userwise_clg']." WHERE called_person1='$user_name' GROUP BY current_status ";
 $result1= mysqli_query($connect, $user_query); 
}
 ?>  
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Report generation</title>
<!-- Latest compiled and minified CSS -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../bs/css/bootstrap.min.css">
<script type="text/javascript" src="../bs/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../bs/js/jquery.min.js"></script> 
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart); 
           google.charts.setOnLoadCallback(drawChart2); 
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['current_status', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["called_person1"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Percentage of User wise report',  
                      is3D:true,  
                      pieHole: 0.5  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           function drawChart2()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['current_status', 'tot'],  
                          <?php  
                          while($row = mysqli_fetch_array($result1))  
                          {  
                               echo "['".$row["current_status"]."', ".$row["tot"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Percentage of User/status wise report',  
                      is3D:true,  
                      pieHole: 0.5  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart2'));  
                chart.draw(data, options);  
           }  
           </script>  
     
<style>
.custom_header{
    background-color:#FFFFFF;
    color:#094ca1;
}
.logo_header{
    margin-right: 120px;
}
.footer_jumbo{
margin-top:12%;
}
a{
    text-decoration: none;
    color: #000;
}
.tr_color{
    background: #CFD8DC;
    text-decoration: none;

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
            <h2 class="h2">Report</h2>
            </div>
            <div class="col-lg-6">
            <img src="../img/logo2.png" height="100" width="130" class="pull-right">
            </div>  
        </div>
    </div>
</header>
<main>

<div class="container main_container">
<ol class="breadcrumb">
  <li><a href="../index.php">Home</a></li>
  <li><a href="../index.php">Report</a></li>

  <li class="active">User Report</li>
</ol>
<!--<table class="table">
    <tr>
    <th class="tr_color"><a href="user.php" style="text-decoration: none;"><span class="h2">User Master</span></a></th>
    <th class="tr_color"><a href="parameter.php" style="text-decoration: none;"><span class="h2">Parameter Master</span></a></th>
    <th class="tr_color"><a href="machine.php" style="text-decoration: none;"><span class="h2">machine Master</span></a></th>
    <th class="tr_color"><a href="part.php" style="text-decoration: none;"><span class="h2">Part Master</span></a></th>
    <th class="tr_color"><a href="part_spec.php" style="text-decoration: none;"><span class="h2">Part Specification Master</span></a></th>
    </tr>
</table>-->
 <form action="user_wisee.php"  method="post"  >
  <div class="container">
<div class="row">
          
     
                <h3 align="center"><b>User wise report</b></h3>  
               
                  
                        
                      <br>
                               
                                <div class="col-lg-3">
                                  
                                    <select class="selectpicker" name="clg_name" id="clg_name"    style=" height:28px; border: ridge;" >
                                     <option value="" disabled selected>Select College name</option>
                                     <?php
                                     $list = mysqli_query($conn,"SELECT `clg_name` FROM `clg_master` ");
                                     while ($row_ah = mysqli_fetch_assoc($list)) {
                                     ?>

                                    <option value="<?php echo $row_ah['clg_name']; ?>"><?php echo $row_ah['clg_name']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                                 <div class="col-lg-3">
                                  
                                   <select class="selectpicker" name="course" id="course"   style=" height:28px; border: ridge;" >
                                     <option value="" disabled selected>Select Course</option>
                                     <?php
                                     $list = mysqli_query($conn,"SELECT `course` FROM `course_master` ");
                                     while ($row_ah = mysqli_fetch_assoc($list)) {
                                     ?>

                                    <option value="<?php echo $row_ah['course']; ?>"><?php echo $row_ah['course']; ?></option>
                                    <?php } ?>
                                  </select>
                                 </div>
                                 <div class="col-lg-3">
                                     <select class="selectpicker" name="user_name" id="user_name"   style=" height:28px;  border: ridge;" onchange="this.form.submit()">
                                     <option value="" disabled selected>Select User</option>
                                     <?php
                                     $list = mysqli_query($conn,"SELECT `user_name` FROM `user_master` ");
                                     while ($row_ah = mysqli_fetch_assoc($list)) {
                                     ?>

                                    <option value="<?php echo $row_ah['user_name']; ?>"><?php echo $row_ah['user_name']; ?></option>
                                    <?php } ?>
                                  </select>
                                 </div>

                                 <div class="col-lg-3">
                                  <Button class="btn btn-success btn-md" id="btn" type="submit" name="submit" value="submit" >
                                     <span class="glyphicon glyphicon-filter">Filter</span>
                                    </button>
                                 </div>
                            

                        </div>
                     </div>
               </form>
      
     <div class="container">  
                <div class="row"> 
                 <div class="col-lg-6">
                <div id="piechart" style="width: 900px; height: 500px;"></div>  
              
               <div class="col-lg-6">
                
                  <div id="piechart2" style="width: 900px; height: 500px;"></div>  
                 
              </div>
         </div>
      

                
         
</main>

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
