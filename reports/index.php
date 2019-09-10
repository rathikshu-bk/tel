<?php
session_start();
if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="1")){

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Master Entry Page</title>
<!-- Latest compiled and minified CSS -->
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
            <h2 class="h2">Master</h2>
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
  <li class="active">Masters</li>
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

<div class="row">
    <div class="container main_container">
    <a href="date_wise.php"><div class="col-lg-4"><div class="jumbotron sub_jumbo"><h3 class="h3"><span class="glyphicon glyphicon-calendar"></span> Date Wise Report</h3></div></div></a>

    <a href="collegewise.php"><div class="col-lg-4"><div class="jumbotron sub_jumbo"><h3 class="h3"><span class="glyphicon glyphicon-education"></span> College Wise Report</h3></div></div></a>
    <a href="status_wise.php"><div class="col-lg-4"><div class="jumbotron sub_jumbo"><h3 class="h3"><span class="glyphicon glyphicon-tasks"></span> Activity Wise Report</h3></div></div></a>
   
        </div>
    </div>

<div class="row">
    <div class="container main_container">
         
<a href="user_wisee.php"><div class="col-lg-4"><div class="jumbotron sub_jumbo"><h3 class="h3"><span class="glyphicon glyphicon-user"></span>User Wise Report</h3></div></div></a>

   
   <!--  <a href="process.php"><div class="col-lg-4"><div class="jumbotron sub_jumbo"><h3 class="h3">Process Master</h3></div></div></a>
    <a href="part_spec.php"><div class="col-lg-4"><div class="jumbotron sub_jumbo"><h3 class="h3">Sequence Master</h3></div></div></a>  -->
        </div>
    </div>
    
    <div class="row">
    <div class="container main_container">
    
       <!--  <a href="assembly.php"><div class="col-lg-4"><div class="jumbotron sub_jumbo"><h3 class="h3">Assembly Master</h3></div></div></a>
        <a href="special_char.php"><div class="col-lg-4"><div class="jumbotron sub_jumbo"><h3 class="h3">Special Char Master</h3></div></div></a> -->
        
        </div>
    </div>

</div>
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
else{
    header("Location:../login.php");
}
?>