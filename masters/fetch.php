
<?php

//fetch.php

if(!empty($_FILES['csv_file']['name']))
{
 $file_data = fopen($_FILES['csv_file']['tmp_name'], 'r');
 $column = fgetcsv($file_data);
 while($row = fgetcsv($file_data))
 {
  $row_data[] = array(
   'student_name'  => $row[0],
   'student_phone'  => $row[1],
   'yop'=>$row[2],
   'course'=>$row[3],
   'parents_no'=>$row[4],
   'email'=>$row[5],
   'address'=>$row[6],
   'feedback'=>$row[7]

  );
 }
 $output = array(
  'column'  => $column,
  'row_data'  => $row_data
 );

 echo json_encode($output);

}

?>
