<?php 
session_start();
if(isset($_SESSION['user'])&&isset($_SESSION['user_priority'])&&($_SESSION['user_priority']=="1")){
  


//$_SESSION['clg_name']='$clg_name';

include"../access.php";
if(isset($_POST['filter']))
{
  echo 'ho';
  $table_name = $_SESSION['walkin_progress'];
      $filter=trim($_POST['filter']);
      if(!empty($_POST['filter']))
      {
        $fil_con=$conn->prepare("SELECT * FROM $table_name WHERE `course` LIKE ? ");
        $fil_con->bind_param("s", $filter);
        $fil_con->execute();
        $fil_con->store_result();
        $fil_con->bind_result($student_name,$yop,$ph_no,$course);
        $final=array();
        while($fil_con->fetch())
        { 
          $each=array(
              'student_name'=>$student_name,
              'yop'=>$yop,
              'ph_no'=>$ph_no,
              'course'=>$course


            );
          array_push($final,$each);


        }
        echo json_encode($final);
       echo '<pre>'; print_r($final);
       $fil_con->close();
      }


}
?>