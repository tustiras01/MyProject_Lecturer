<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database:
include('mysqlconnect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$users_id = $_REQUEST["exam_id"];

move_uploaded_file($_FILES["fileCSV"]["tmp_name"],$_FILES["fileCSV"]["name"]); // Copy/Upload CSV

// $objConnect = mysql_connect("localhost","root","root") or die("Error Connect to Database"); // Conect to MySQL
// $objDB = mysql_select_db("mydatabase");

$objCSV = fopen($_FILES["fileCSV"]["name"], "r");
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
	$strSQL = "INSERT INTO test_exam";
	$strSQL .="(test_no,
  test_name,
  choiceA,
  choiceB,
  choiceC,
  choiceD,
  test_ans,
  test_namepic,
  exam_id) ";
	$strSQL .="VALUES ";
	$strSQL .="('".$objArr[0]."','".$objArr[1]."','".$objArr[2]."' ";
	$strSQL .=",'".$objArr[3]."','".$objArr[4]."','".$objArr[5]."','".$objArr[6]."'
  ,'".$objArr[7]."','".$objArr[8]."') ";
	$objQuery = mysql_query($strSQL);
}
fclose($objCSV);


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
