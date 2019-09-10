

<!DOCTYPE html>
<html>
 <head>
  <title>CSV File Editing and Importing in PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
  .box
  {
   max-width:600px;
   width:100%;
   margin: 0 auto;;
  }
  </style>
 </head>
 <body>
  <div class="container">
   <br />
   <h3 align="center">CSV File Editing and Importing in PHP</h3>
   <br />
   <form id="upload_csv" method="post" enctype="multipart/form-data">
    <div class="col-md-3">
     <br />
     <label>Select CSV File</label>
    </div>  
                <div class="col-md-4">  
                    <input type="file" name="csv_file" id="csv_file" accept=".csv" style="margin-top:15px;" />
                </div>  
                <div class="col-md-5">  
                    <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                </div>  
                <div style="clear:both"></div>
   </form>
   <br />
   <br />
   <div id="csv_file_data"></div>
   
  </div>
 </body>
</html>

<script>

$(document).ready(function(){
 $('#upload_csv').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:new FormData(this),
   dataType:'json',
   contentType:false,
   cache:false,
   processData:false,
   success:function(data)
   {
    var html = '<table class="table table-striped table-bordered">';
    if(data.column)
    {
     html += '<tr>';
     for(var count = 0; count < data.column.length; count++)
     {
      html += '<th>'+data.column[count]+'</th>';
     }
     html += '</tr>';
    }

    if(data.row_data)
    {
     for(var count = 0; count < data.row_data.length; count++)
     {
      html += '<tr>';
     html += '<td class="student_name" contenteditable>'+data.row_data[count].student_name+'</td>';
      html += '<td class="student_phone" contenteditable>'+data.row_data[count].student_phone+'</td></tr>';
      html += '<td class="yop" contenteditable>'+data.row_data[count].yop+'</td></tr>';
      html += '<td class="course" contenteditable>'+data.row_data[count].course+'</td></tr>';
      html += '<td class="parents_no" contenteditable>'+data.row_data[count].parents_no+'</td></tr>';
      html += '<td class="email" contenteditable>'+data.row_data[count].email+'</td></tr>';
      html += '<td class="address" contenteditable>'+data.row_data[count].address+'</td></tr>';
      html += '<td class="feedback" contenteditable>'+data.row_data[count].feedback+'</td></tr>';
     
     }
    }
    html += '<table>';
    html += '<div align="center"><button type="button" id="import_data" class="btn btn-success">Import</button></div>';

    $('#csv_file_data').html(html);
    $('#upload_csv')[0].reset();
   }
  })
 });

 $(document).on('click', '#import_data', function(){
   var student_name = [];
  var student_phone = [];
 var yop=[];
  var course=[];
  var parents_no=[];
  var email=[];
  var address=[];
  var feedback=[];
  $('.student_name').each(function(){
   student_name.push($(this).text());
  });
  $('.student_phone').each(function(){
   student_phone.push($(this).text());
  });
   $('.yop').each(function(){
   yop.push($(this).text());
  });
    $('.course').each(function(){
   course.push($(this).text());
  });
     $('.parents_no').each(function(){
   parents_no.push($(this).text());
  });
      $('.email').each(function(){
   email.push($(this).text());
  });
       $('.address').each(function(){
   address.push($(this).text());
  });
       $('.feedback').each(function(){
   feedback.push($(this).text());
  });
       
       
  $.ajax({
   url:"imp.php",
   method:"post",
  data:{student_name:student_name, student_phone:student_phone,yop:yop,course:course,parents_no:parents_no,email:email,address:address,feedback:feedback},
   success:function(data)
   {
    $('#csv_file_data').html('<div class="alert alert-success">Data Imported Successfully</div>');
   }
  })
 });
});

</script>


