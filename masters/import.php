<?php 
session_start();
if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="1")){
include"../access.php";
 
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
<script type="text/javascript">
  $(document).ready(
  function() {
    $("#frmCSVImport").on(
    "submit",
    function() {

      $("#response").attr("class", "");
      $("#response").html("");
      var fileType = ".csv";
      var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+("
          + fileType + ")$");
      if (!regex.test($("#file").val().toLowerCase())) {
        $("#response").addClass("error");
        $("#response").addClass("display-block");
        $("#response").html(
            "Invalid File. Upload : <b>" + fileType
                + "</b> Files.");
        return false;
      }
      return true;
    });
  });
</script>
    </head>
    <body>
      <header>
  <div class="jumbotron custom_header">
      <div class="container">
        <div class="row">
        <div class="col-lg-6">
        <br><br>
      <h2 class="h2">Upload CSV</h2>
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
  <?php
            
            if(isset($message)) {
          
                echo '<div class="text-center h7 alert-success">Total CSV file rows:'.$row.'</div>';
            }
            ?>
            <br>
        <div id="wrap">
           
                <div class="row">
                    <form class="form-horizontal" action="import.php"  method="post"  name="upload_excel" id="formCSVImport" enctype="multipart/form-data">
                        <fieldset>
                            <!-- Form Name -->
                            

                             <div class="form-group">
                                <label class="col-md-4 control-label" for="filebutton">College Name</label>
                                <div class="col-md-4">
                                    <select class="selectpicker" name="clg_name" id="clg_name" style=" height:28px; border: ridge;" >
                                     <option valccd xsccxv dt54rtec vaessaue="" disabled selected>Select College name</option>
                                     <?php
                                     $list = mysqli_query($conn,"SELECT * FROM `clg_master` ");
                                     while ($row_ah = mysqli_fetch_assoc($list)) {
                                     ?>

                                    <option   value="<?php echo $row_ah['clg_name']; ?>"><?php echo $row_ah['college_name']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                            </div>
                            <!-- File Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="filebutton">Select File</label>
                                <div class="col-md-4">
                                    <input type="file" name="file" id="file" class="input-large" accept=".csv" pattern="^.+\.(xlsx|xls|csv)$">
                                </div>
                            </div>
                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                                <div class="col-md-4">
                                    <button type="submit" id="frmCSVImport"   name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                                </div>
                            </div>

                        </fieldset>
                   
                    </form>
                </div>
                
                <div class="row">
                    <form class="form-horizontal" action="import_edit.php"  method="post"  name="edit" >
                        <fieldset>
                            <!-- Form Name -->
                            
                           <center><h4>[Or]</h4></center>
                            
                            <!-- File Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="filebutton"></label>
                                <div class="col-md-8">
                                  
                                          <a href="import_edit.php"><span class="glyphicon glyphicon-pencil"></span> 
                                       
                                    <button type="button" class="btn btn-link" name="Edit">Click Here</button></a>
                                    <label >To Enter Individual Data</label>
                                </div>
                            </div>
                            <!-- Button -->
                          
                        </fieldset>
                   
                    </form>
                </div>


    

      
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
if(isset($_POST["Import"])&&isset($_POST["clg_name"])){
       
        $clg_name = stripcslashes($_POST['clg_name']);
        $clg_sql="SELECT `id` FROM `clg_master` WHERE `clg_name`='$clg_name'";
        $res=$conn->query($clg_sql);
         $value = $res->fetch_assoc();
          $clg_id=$value['id'];

       // echo $clg_id;
        //echo $row_ah['clg_name'];
        $filename=$_FILES["file"]["tmp_name"];   
        
         if($_FILES["file"]["size"] > 0)
         {
            $file = fopen($filename, "r");
         $row = 0;
        echo '<table class="table table-bordered table-striped"><tr ><th colspan="8" class="text-danger"> NOT INSERTED INTO DB </th></tr>';
          while (($getData = fgetcsv($file, 2000000, ",")) !== FALSE)
               {
                $row++;
                $course_sql="SELECT `course` FROM `course_master` WHERE `course`='".$getData[2]."' ";
                $res=$conn->query($course_sql);
              $tot_num_rows=$res->num_rows;
                if($tot_num_rows>0){
             $sql = "INSERT into $clg_name (student_name, ph_no, course,yop, parents_no, email, address,feedback,clg_name,clg_id) 
                       values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."','".$getData[7]."','$clg_name','$clg_id')";
                       $result = $conn->query($sql);
                       echo mysqli_error($conn);
              }
              else
              {
                $row--;
                echo '<tr><td>'.$getData[0].'</td><td>'.$getData[1].'</td><td>'.$getData[2].'</td><td>'.$getData[3].'</td><td>'.$getData[4].'</td><td>'.$getData[5].'</td><td>'.$getData[6].'</td><td>'.$getData[7].'</td></tr>';
                continue;
              }

             }
               echo '</table>';
        $message = '<div class="text-center h7 alert-success">User deleted Successfully</div>';
            if(!isset($result))
            {
              echo "<script type=\"text/javascript\">
                  alert(\"Invalid File:Please Upload CSV File.\");
                  
                  </script>";    
            }
            else {
                echo "<script type=\"text/javascript\">
                alert(\"CSV File has been successfully Imported.\");
                
              </script>";
            }
               
          
               fclose($file);  
         }
      }

}
else{
    header("Location:../login.php");
}

?>