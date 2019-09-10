<?php
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Powered by SWIFTERZ</title>
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


</style>
</head>


<body style="overflow-x: hidden;">
<!--<div id="loading">
        <img id="loading-image" src="img/loadinggif.GIF" alt="Loading..." />
        <h4 style="margin-top: 30%;">Powered by Big Data</h4>
    </div>-->
<header>
	<div class="jumbotron custom_header">
    	<div class="container">
        <div class="row">
        <div class="col-lg-6">
        <br><br>
 			<h2 class="h2">Tel-C Management</h2>
            </div>
            <div class="col-lg-6">
            <img src="img/logo2.png" height="100" width="130" class="pull-right">
            </div>	
        </div>
    </div>
</header>
<section>
<div class="container">

    <?php 
        session_start();
        if(isset($_SESSION['user'])){
            ?>
            <span class="h4" style="color: green;">Logged In : <?php echo $_SESSION['user']; ?>
                
            </span>
            <a href="logout.php">
            <span class="glyphicon glyphicon-off btn btn-default pull-right">
                
            </span>
            </a><?php
        }
        else{
             ?><span class="h4" style="color: red;">Not Logged In</span>

             <a href="login.php">
            <span class="glyphicon glyphicon-off btn btn-default pull-right">
                
            </span>
            </a>
             <?php
        }
    ?>
    </div>
</section>
<main>
<div class="row">
	<div class="container main_container text-center">
   <a href="masters/"><div class="col-lg-4"><div class="jumbotron sub_jumbo"><h3 class="h3"><span class="glyphicon glyphicon-education"></span> Masters</h3></div></div></a>
   <a href="progress/index.php"><div class="col-lg-4"><div class="jumbotron sub_jumbo"><h3 class="h3"><span class="glyphicon glyphicon-headphones"></span> Tel-C Progress</h3></div></div></a>
    <a href="reports/index.php"><div class="col-lg-4"><div class="jumbotron sub_jumbo"><h3 class="h3"><span class="glyphicon glyphicon-stats"></span> Reports</h3></div></div></a>
    
    	</div>
    </div>
    </div>
</main>
<br>

<footer>
        <div class="container text-right">
        <span class="h5">Powered By</span>
        <img src="img/logo.png" height="75">
    </div>
</footer>

</body>
</html>