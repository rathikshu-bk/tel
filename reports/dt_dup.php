?php
session_start();
if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="1"))
{
include "../access.php";
 $sql_c = "SELECT * FROM `clg_master`"; 
  $sum=0;
            $query = $conn->query($sql_c);
 while($fetch = $query->fetch_assoc()){
            
            $clg_name1= $fetch['clg_name'];
            $query_call_stauts = "SELECT call_status1 as `tot` FROM `$clg_name1` WHERE call_status1='1' ";
            $result2 = $conn->query($query_call_stauts);
            $tot_calls = $result2->num_rows; 
            $sum+=$tot_calls;
                        
                        
                         if($tot_calls<0)
                         {
                           
                              echo 'No calls';
                         }
                     
}
 echo $sum;

          
  if( !empty($_POST["from_date"])&&!empty($_POST['to_date']))
 {  

            $slno = 1;
            $sum_int=0;
            $sum_notint=0;
            $sum_wait=0;
            $sum_notyet=0;
            $sum_walkin=0;
            $sum_reg=0;
            $sql = "SELECT * FROM `clg_master`"; 
  
            $query = $conn->query($sql);
            while($fetch = $query->fetch_assoc()){
            
            $clg_name1= $fetch['clg_name'];
            
                        // $college_name1 =($_POST['clg_name']);
                        //$clg1_name = strtolower($clg_name);
                        //$clg_name1=str_replace(' ', '_', $clg1_name);
                        //echo $clg_name1;
                      
                        $interest="SELECT current_status as interest FROM $clg_name1 WHERE current_status='interest' ";
                        $notinterest="SELECT current_status as notinterest FROM $clg_name1 WHERE current_status='notinterest' ";
                        $waiting="SELECT current_status as waiting FROM $clg_name1 WHERE current_status='waiting' ";
                        $notyetcall="SELECT current_status as notyetcall FROM $clg_name1 WHERE current_status='Not Yet Call' ";
                        $walkin="SELECT current_status as walkin FROM $clg_name1 WHERE current_status='walkin' ";
                        $register="SELECT current_status as register FROM $clg_name1 WHERE current_status='register' ";
                        $query_call_stauts1 = "SELECT current_status, count(*) as number FROM $clg_name1 WHERE call_date1 BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' GROUP BY current_status ";
                        $res1=$conn->query($interest);
                        $res2=$conn->query($notinterest);
                        $res3=$conn->query($waiting);
                        $res4=$conn->query($notyetcall);
                        $res5=$conn->query($walkin);
                        $res6=$conn->query($register);

                      
                         //$result5 = $conn->query($query_call_stauts);
                        $result3 = $conn->query($query_call_stauts1);
                        $row = $result3->fetch_assoc();
                        
                         
                         //$sum+=$result2;
                         $tot_int=$res1->num_rows;
                         $tot_notint=$res2->num_rows;
                         $tot_wait=$res3->num_rows;
                         $tot_notyet=$res4->num_rows;
                         $tot_walkin=$res5->num_rows;
                         $tot_reg=$res6->num_rows;

                     
                       $sum_int+=$tot_int;
                       $sum_notint+=$tot_notint;
                       $sum_wait+=$tot_wait;
                       $sum_notyet+=$tot_notyet;
                       $sum_walkin+=$tot_walkin;
                       $sum_reg+=$tot_reg;

                         }
                          echo $sum_int;
                          echo $sum_reg;
                          echo $sum_walkin;
                          echo $sum_notyet;
                          echo $sum_notint;
                          echo $sum_wait;
                              $store = array("Interest" => $sum_int, "NotInterest" => $sum_notint, "Waiting" => $sum_wait,"Walkin" => $sum_walkin,"Registration" => $sum_reg,"Not Yet Call"=>$sum_notyet);
                             echo '<pre>'; 


                  //echo $array;
}
 ?>  
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Report generation</title>
<!-- Latest compiled and minified CSS -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
          

      
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
  </div>
</header>
<main>

<div class="container main_container">
<ol class="breadcrumb">
  <li><a href="../index.php">Home</a></li>
  <li><a href="index.php">Report</a></li>

  <li class="active">DateWise Report</li>
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
</main>
<form action="date_wise.php"  method="post">
   <script type="text/javascript">  

           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                 var data = google.visualization.arrayToDataTable([  
                          ['current_status', 'Number'],  
                          <?php  
                         foreach ($store as $key => $value) {
                            echo "['".$key."', ".$store[$key]."],"; 
                         }
                            
                          ?>  
                     ]);  

                var options = {  
                      title: 'Percentage of Date wise report',  
                      is3D:true,  
                      pieHole: 0.5  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script>  

<div class="container">  
<div class="row">
<h3 align="center"><b>Date wise report</b></h3>  
      
     <div class="col-lg-3" >
          <tr>
            <td class="h8">From date  </td><td class="h7"><input type="date" id="from_date" name="from_date">
            </td>
          </tr>
     </div>
     <div class="col-lg-3">
          <tr>
            <td class="h8">To date </td><td class="h7"><input type="date" id="to_date" name="to_date"  >

            </td>
          </tr>
     </div>
    <div class="col-lg-3">
        <Button type="submit" value="submit"class="btn btn-success btn-md" id="btn">
              <span class="glyphicon glyphicon-filter">Submit</span>
        </button>
    </div>                        
</div> 
</div>      
                        <br>
                        <div class="container">  
                         <div class="row"> 
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
                                        <div class="col-lg-4"><label class="col-lg-3 control-label" for="filebutton">Course :</label>
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
                                        <div class="col-lg-4"> <Button type="submit" value="submit"class="btn btn-danger btn-lg" id="btn">
                                     <span class="glyphicon glyphicon-filter">Filter</span>
                                    </button>
                                        </div>
                     </div>
                    </div>
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
                 <div class="col-lg-8">
                <div id="piechart" style="width: 900px; height: 500px;"></div>  
              
               <div class="col-lg-4">
                
              </div>
         </div>
       </div>
     </div>

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
