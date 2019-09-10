<?php
session_start();
if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="1")){
include "../access.php";
 

          $sql = "SELECT `college_name` FROM clg_master ";     

                       $result = $conn->query($sql);
                       $slno=1;
                       $sum=0;
                      while($fetch = $result->fetch_assoc()){
                         $clg_name=$fetch['college_name'];
                        // $college_name1 =($_POST['clg_name']);
                        $clg1_name = strtolower($clg_name);
                        $clg_name1=str_replace(' ', '_', $clg1_name);
                        $query_call_stauts = "SELECT call_status1 as `tot` FROM `$clg_name1` WHERE call_status1='1' ";
          $result2 = $conn->query($query_call_stauts);
           $tot_calls = mysqli_num_rows($result2); 
            $sum+=$tot_calls;
                        
                        
                         if($tot_calls<0)
                         {
                           
                              echo 'No calls';
                         }
                     
}
$sum;


if(!empty($_POST["clg_name"])){
  $clg_name = stripcslashes($_POST['clg_name']);
    if(!empty($_POST["course"]))
    {
        echo 'hi';
        $course = stripcslashes($_POST['course']);
        
        echo $query = "SELECT current_status, count(*) as number FROM $clg_name WHERE `course` LIKE '%$course' AND call_status1='1' GROUP BY current_status ";  
         $result = $conn-> query($query);  
         $tot_cl = $result2->num_rows;
         echo $tot_cl;
         
         echo '';
        }
    else
    {
     
     $query = "SELECT current_status, count(*) as number FROM $clg_name WHERE call_status1='1'  GROUP BY current_status ";  
    $result = $conn-> query($query);  
         $tot_cl = $result2->num_rows;
        
         echo '';

    }
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
<script type="text/javascript" src="../bs/js/jquery.min.js"></script> <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['current_status', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["current_status"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Percentage of College wise report',  
                      is3D:true,  
                      pieHole: 0.5  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
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
  <li><a href="index.php">Report</a></li>

  <li class="active">College Wise Report</li>
</ol>
<?php
            
            if(isset($message)) {
          
                echo $message;
            }
            ?>

<!--<table class="table">
    <tr>
    <th class="tr_color"><a href="user.php" style="text-decoration: none;"><span class="h2">User Master</span></a></th>
    <th class="tr_color"><a href="parameter.php" style="text-decoration: none;"><span class="h2">Parameter Master</span></a></th>
    <th class="tr_color"><a href="machine.php" style="text-decoration: none;"><span class="h2">machine Master</span></a></th>
    <th class="tr_color"><a href="part.php" style="text-decoration: none;"><span class="h2">Part Master</span></a></th>
    <th class="tr_color"><a href="part_spec.php" style="text-decoration: none;"><span class="h2">Part Specification Master</span></a></th>
    </tr>
</table>-->
 <form action="collegewise.php"  method="post"  >
<div class="row">
          
     
                <h3 align="center"><b>College wise report</b></h3>  
               
                  
                        
                      <br>
                               
                                <div class="col-lg-4">
                                   <label class="col-lg-3 control-label" for="filebutton">College :</label>
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
                                 <div class="col-lg-4">
                                   <label class="col-lg-3 control-label" for="filebutton">Course :</label>
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
                                 <div class="col-lg-4">
                                  <Button class="btn btn-success btn-md" id="btn" onchange="this.form.submit()">
                                     <span class="glyphicon glyphicon-filter">Filter</span>
                                    </button>
                                 </div>
                            

                        </div>
                        <br>
                        <br>
                         <div class="container">  
                         <div class="row"> 
                                       <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-4"><b>Total Number Of Calls Met</b> <input type="text" style="border:none" value="<?php echo $sum; ?>"  placeholder="<?php echo $sum; ?>" ></div>
                                        </div>
                                        <div class="col-lg-4">
                                        </div>
                     </div>
                    </div>
                <div class="container">  
                <div class="row"> 
                 <div class="col-lg-6">
                <div id="piechart" style="width: 900px; height: 500px;"></div>  
              
               <div class="col-lg-6">
                
                  
                 
              </div>
         </div>
</main>
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
