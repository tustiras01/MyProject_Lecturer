<html lang="en">
<head>
  <title>ตรวจสถานะ-แก้ไขข้อสอบ</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">

  <?php
  include("jscss.php");
  include("mysqlconnect.php");
  ?>

</head>
<body>
  <?php
  //1. เชื่อมต่อ database:
  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

  $test_id = $_REQUEST["test_id"];

  //2. query ข้อมูลจากตาราง:
  $sql = "SELECT * FROM test_exam WHERE test_id='$test_id' ";
  $result = mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
  $row = mysqli_fetch_array($result);
  extract($row);
  ?>

  <?php
  session_start();
  //echo $_SESSION['name'];
  // echo "OK";
  ?>
  <nav class="navbar navbar-default">
    <div class="container-fluid ">
      <div class="navbar-header navbar-right">
        <a class="navbar-brand" href="#">&nbsp;CES</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="disabled"><a href="">หน้าหลัก</a></li>
        <li class="disabled"><a href="">สร้างชุดข้อสอบ</a></li>
        <li class="disabled"><a href="">ส่งข้อสอบ</a></li>
        <li class="disabled"><a href="">ตรวจสถานะข้อสอบ</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" style="color:orange;">
          <span class="glyphicon glyphicon-credit-card"></span> <u><?php echo $_SESSION['type'];?></u>
        </a></li>
        <li><a href="#" style="color:#6699CC;">
          <span class="glyphicon glyphicon-book"></span> <u><?php echo $_SESSION['class'];?></u>&nbsp;
          <span class="glyphicon glyphicon-user"></span> <u><?php echo $_SESSION['name'];?></u>
        </a></li>
        <li><a href="../index.php" style="color:#990033;" class="w3-hover-red">
          <span class="glyphicon glyphicon-log-out"></span> Logout &nbsp;</a></li>
        </ul>
      </div>
    </nav>

    <div class="container w3-padding-16 w3-animate-opacity">
      <div class="container-fluid">
        <div class="col-sm-offset-1 col-sm-10">
          <div class="panel panel-warning">
            <div class="panel-heading w3-orange">
              แก้ไขข้อสอบรายวิชา
            </div>
            <div class="panel-body">
              <form action="testVeiw_edit_ed_db.php" class="form-horizontal" name="from1" method="post"
              enctype="multipart/form-data" >
              <div class="form-group">
                <div class="col-sm-8">
                  <input type="hidden" class="form-control" name="test_id" value="<?php echo $test_id; ?>" />
                  <input type="hidden" class="form-control" name="testsend_edit" value="แก้ไขแล้ว" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">ข้อที่</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="test_no" placeholder=""
                  value="<?php echo $test_no; ?>" required/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">โจทย์</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="test_name" placeholder="ชื่อผู้ใช้งาน"
                  value="<?php echo $test_name; ?>" required/>
                </div>
                <div class="col-sm-offset-3 col-sm-8">
                  <?php if(empty( $test_namepic )) {
                    echo "<td></td>";

                  } else {
                    echo"<img src='../img/".$test_namepic."' width='600'>";
                  }?>
                </div>
              </div>
              <hr />
              <div class="form-group">
                <label class="col-sm-3 control-label">1.</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="choiceA" placeholder="คำตอบ A"
                  value="<?php echo $choiceA; ?>" required/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">2.</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="choiceB" placeholder="คำตอบ A"
                  value="<?php echo $choiceB; ?>" required/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">3.</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="choiceC" placeholder="คำตอบ A"
                  value="<?php echo $choiceC; ?>" required/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">4.</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="choiceD" placeholder="คำตอบ A"
                  value="<?php echo $choiceD; ?>" required/>
                </div>
              </div>
              <hr />
              <div class="form-group">
                <label class="col-sm-3 control-label">เฉลย</label>
                <div class="col-sm-8">
                  <?php
                  if($test_ans=='1'){
                    ?>
                    <label class="radio-inline"><input type="radio" name="test_ans" value="1" checked>1.</label>
                    <label class="radio-inline"><input type="radio" name="test_ans" value="2">2.</label>
                    <label class="radio-inline"><input type="radio" name="test_ans" value="3">3.</label>
                    <label class="radio-inline"><input type="radio" name="test_ans" value="4">4.</label>
                    <?php }
                    else if($test_ans=='2'){?>
                      <label class="radio-inline"><input type="radio" name="test_ans" value="1">1.</label>
                      <label class="radio-inline"><input type="radio" name="test_ans" value="2" checked>2.</label>
                      <label class="radio-inline"><input type="radio" name="test_ans" value="3">3.</label>
                      <label class="radio-inline"><input type="radio" name="test_ans" value="4">4.</label>
                      <?php }
                      else if($test_ans=='3'){  ?>
                        <label class="radio-inline"><input type="radio" name="test_ans" value="1">1.</label>
                        <label class="radio-inline"><input type="radio" name="test_ans" value="2">2.</label>
                        <label class="radio-inline"><input type="radio" name="test_ans" value="3" checked>3.</label>
                        <label class="radio-inline"><input type="radio" name="test_ans" value="4">4.</label>
                        <?php }
                        else if($test_ans=='4'){  ?>
                          <label class="radio-inline"><input type="radio" name="test_ans" value="1">1.</label>
                          <label class="radio-inline"><input type="radio" name="test_ans" value="2">2.</label>
                          <label class="radio-inline"><input type="radio" name="test_ans" value="3">3.</label>
                          <label class="radio-inline"><input type="radio" name="test_ans" value="4" checked>4.</label>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-warning col-sm-offset-8 col-md-3" name="Update" style="" value="submit">แก้ไข</button>
                        </div>
                      </div>
                    </form>

                    <a href="testVeiw_edit.php?exam_id=<?php echo $_SESSION['exam_id'];?> style="color:orange;"">
                      ย้อนกลับ</a>

                    </div>
                  </div>
                </div>
              </div>
            </div>

          </body>
          </html>
