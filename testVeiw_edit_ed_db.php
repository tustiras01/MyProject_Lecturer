<meta charset="UTF-8">
<?php
session_start();
//1. เชื่อมต่อ database:
include('mysqlconnect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$test_id = $_REQUEST["test_id"];
$test_no= $_REQUEST["test_no"];
$test_name= $_REQUEST["test_name"];
$choiceA= $_REQUEST["choiceA"];
$choiceB= $_REQUEST["choiceB"];
$choiceC= $_REQUEST["choiceC"];
$choiceD= $_REQUEST["choiceD"];
$test_ans= $_REQUEST["test_ans"];
$testsend_edit= $_REQUEST["testsend_edit"];

$exam_id = $_SESSION['exam_id'];
//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database

$sql = "UPDATE test_exam SET
test_no='$test_no' ,
test_name='$test_name' ,
choiceA='$choiceA' ,
choiceB='$choiceB' ,
choiceC='$choiceC' ,
choiceD='$choiceD' ,
test_ans='$test_ans' ,
testsend_edit='$testsend_edit'
WHERE test_id='$test_id' ";

$result = mysqli_query($dbc, $sql) or die ("Error in query: $dbc " . mysqli_error());

mysqli_close($dbc); //ปิดการเชื่อมต่อ database

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if($result){
  echo "<script type='text/javascript'>";
  echo "alert('แก้ไขข้อสอบสำเร็จ');";
  //echo "window.location ='testVeiw_edit.php?exam_id=$exam_id'; ";
  echo "</script>";
}
else{
  echo "<script type='text/javascript'>";
  echo "alert('Error back to Update again');";
  echo "</script>";
}
?>
