<?php
session_start();
if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="1")){
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

 

 



?>  
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Report generation</title>
<!-- Latest compiled and minified CSS -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
 </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 

 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           
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
<form action="date_wise.php"  method="post" >

<div class="container">  
<div class="row">
<h3 align="center"><b>Date wise report</b></h3>  <br>
 <div class="table">     
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
      <div class="col-lg-4">
                                 
                                    <select class="selectpicker" name="clg_name" id="clg_name"    style=" height:28px; border: ridge; border-color:white" >
                                     <option value="" disabled selected>Select College name</option>
                                     <?php
                                     $list = mysqli_query($conn,"SELECT `clg_name`,`college_name` FROM `clg_master` ");
                                     while ($row_ah = mysqli_fetch_assoc($list)) {
                                     ?>

                                    <option value="<?php echo $row_ah['clg_name']; ?>"><?php echo $row_ah['college_name']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
    <div class="col-lg-2">
        <Button type="submit" value="submit"class="btn btn-success btn-sm" id="btn">
              <span class="glyphicon glyphicon-download-alt">Submit</span>
        </Button>
    </div>                        
</div> 
</table>
</div>  
</div>    
</form> 
     <br>    
   
    <?php
     if( !empty($_POST["from_date"])&&!empty($_POST['to_date']))
 {  

    if(!empty($_POST["clg_name"])){
  $clg_name = stripcslashes($_POST['clg_name']);

       $query = "SELECT current_status, count(*) as number FROM $clg_name WHERE call_date1 BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' GROUP BY current_status ";  
         $result =$conn->query($query);  
         $tot_cl = $result2->num_rows;
         $message='<div class="text-center h5 alert-success">Total Number of calls met in $clg_name</div>';
         //echo '';
    }

     $sum=0;

     $sql = "SELECT * FROM `clg_master`"; 
           $sum=0;
            $query = $conn->query($sql);
            $slno = 1;
            $sum_int=0;
            $sum_notint=0;
            $sum_wait=0;
            $sum_notyet=0;
            $sum_walkin=0;
            $sum_reg=0;
            echo '<table class="table table-bordered table-striped"><tr ><th class="text-success">College Name </th><th class="text-success">Total No of Calls </th><th class="text-success">Interested </th><th class="text-success">NotInterested </th><th class="text-success">Waiting </th><th class="text-success">Walkin</th><th class="text-success">Register </th><th class="text-success">Not Yet Call</th></tr>';
            while($fetch = $query->fetch_assoc()){
            
            $clg_name1= $fetch['clg_name'];

                        // $college_name1 =($_POST['clg_name']);
                        $clg1_name = strtoupper($clg_name1);
                        $clg_nm=str_replace('_', ' ', $clg1_name);
                        //echo $clg_name1;
                        $query_call_stauts = "SELECT call_status1 as `tot` FROM `$clg_name1` WHERE call_status1='1' ";
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

                        $result2 = $conn->query($query_call_stauts);
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
                         $tot_calls = $result2->num_rows;
echo '<tr><td>'.$clg_nm.'</td><td>'.$tot_calls.'</td><td>'.$tot_int.'</td><td>'.$tot_notint.'</td><td>'.$tot_wait.'</td><td>'.$tot_walkin.'</td><td>'.$tot_reg.'</td><td>'.$tot_notyet.'</td></tr>';
                       
                       $sum_int+=$tot_int;
                       $sum_notint+=$tot_notint;
                       $sum_wait+=$tot_wait;
                       $sum_notyet+=$tot_notyet;
                       $sum_walkin+=$tot_walkin;
                       $sum_reg+=$tot_reg;

                         $sum+=$tot_calls;
                         
                        
                         if($tot_calls<0){
                           
                              echo 'No calls';
                                  }
                       //$sum = $sum+$tot_calls; 
 

                          }
                          echo '</table>';
                           $sum;
                           $sum_int;
                           $sum_reg;
                           $sum_walkin;
                           $sum_notyet;
                           $sum_notint;
                           $sum_wait;
                           $store = array("Interest" => $sum_int, "NotInterest" => $sum_notint, "Waiting" => $sum_wait,"Walkin" => $sum_walkin,"Registration" => $sum_reg,"Not Yet Call"=>$sum_notyet);
                           


                  //echo $array;
}

    ?>
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

               
               <div class="container text-left">

                  <div id="piechart" style="width: 900px; height: 500px;"></div>  
           
                </div>
         
</main>
</div>
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
