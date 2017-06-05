<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database:
include('mysqlconnect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$users_id = $_REQUEST["exam_id"];


//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database

$sql = "UPDATE test_insert SET
users_name='$users_name' ,
users_pass='$users_pass' ,
users_fname='$users_fname' ,
users_lname='$users_lname' ,
users_class='$users_class' ,
users_class_id='$users_class_id' ,
users_mail='$users_mail' ,
users_call='$users_call' ,
users_type='$users_type'
WHERE users_id='$users_id' ";

$result = mysqli_query($dbc, $sql) or die ("Error in query: $dbc " . mysqli_error());

mysqli_close($dbc); //ปิดการเชื่อมต่อ database

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if($result){
  echo "<script type='text/javascript'>";
  echo "alert('Update Succesfuly');";
  echo "window.location = 'addUser.php'; ";
  echo "</script>";
}
else{
  echo "<script type='text/javascript'>";
  echo "alert('Error back to Update again');";
  echo "</script>";
}
?>
