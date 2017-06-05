<html lang="en">
<head>
  <title>เพิ่มข้อสอบ</title>
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
  session_start();
  //echo $_SESSION['name'];
  // echo "OK";
  ?>
  <?php
  //1. เชื่อมต่อ database:
  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

  $exam_id = $_REQUEST["exam_id"];


  //2. query ข้อมูลจากตาราง:
  $sql = "SELECT * FROM create_exam WHERE exam_id='$exam_id' ";
  $result = mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
  $row = mysqli_fetch_array($result);
  extract($row);
  $_SESSION['exam_id'] = $row["exam_id"];

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
          <?php
          if(isset($_POST["uploadTest"])){

            $test_no= $_POST["test_no"];
            $test_name= $_POST["test_name"];
            $choiceA= $_POST["choiceA"];
            $choiceB= $_POST["choiceB"];
            $choiceC= $_POST["choiceC"];
            $choiceD= $_POST["choiceD"];
            $test_ans= $_POST["test_ans"];

            $image_name = $_FILES['test_namepic']['name'];
            $image_type = $_FILES['test_namepic']['type'];
            $image_size = $_FILES['test_namepic']['size'];
            $image_tmp_name = $_FILES['test_namepic']['tmp_name'];

            // $image_name2 = $_FILES['choiceApic'];
            // $image_type2 = $_FILES['choiceApic']['type'];
            // $image_size2 = $_FILES['choiceApic']['size'];
            // $image_tmp_name2 = $_FILES['choiceApic']['tmp_name'];
            //
            // $image_name3 = $_FILES['choiceBpic'];
            // $image_type3 = $_FILES['choiceBpic']['type'];
            // $image_size3 = $_FILES['choiceBpic']['size'];
            // $image_tmp_name3 = $_FILES['choiceBpic']['tmp_name'];
            //
            // $image_name4 = $_FILES['choiceCpic'];
            // $image_type4 = $_FILES['choiceCpic']['type'];
            // $image_size4 = $_FILES['choiceCpic']['size'];
            // $image_tmp_name4 = $_FILES['choiceCpic']['tmp_name'];
            //
            // $image_name5 = $_FILES['choiceDpic'];
            // $image_type5 = $_FILES['choiceDpic']['type'];
            // $image_size5 = $_FILES['choiceDpic']['size'];
            // $image_tmp_name5 = $_FILES['choiceDpic']['tmp_name'];

            $exam_id= $_POST["exam_id"];

            move_uploaded_file($image_tmp_name,"../img/$image_name");
            // move_uploaded_file($image_tmp_name2,"img/$image_name2");
            // move_uploaded_file($image_tmp_name3,"img/$image_name3");
            // move_uploaded_file($image_tmp_name4,"img/$image_name4");
            // move_uploaded_file($image_tmp_name5,"img/$image_name5");

            $stmt = $dbc->prepare("INSERT INTO test_exam (
              test_no,
              test_name,
              choiceA,
              choiceB,
              choiceC,
              choiceD,
              test_ans,
              test_namepic,
              -- image_name2,
              -- image_name3,
              -- image_name4,
              -- image_name5,
              exam_id)

              VALUES(?,?,?,?,?,?,?,?,?)");
              $stmt->bind_param("sssssssss",
              $test_no,
              $test_name,
              $choiceA,
              $choiceB,
              $choiceC,
              $choiceD,
              $test_ans,
              $image_name,
              // $image_name2,
              // $image_name3,
              // $image_name4,
              // $image_name5,
              $exam_id);

              $stmt->execute();

              ?>

              <div class="alert alert-success alert-dismissible" role="alert">
                <a href="addTest.php" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </a>
                <span class="glyphicon glyphicon-ok"></span> <strong>บันทึกสำเร็จ</strong> <?php echo $test_name; ?>
              </div>

              <?php }  ?>
              <div class="panel">
                <div class="panel-heading w3-green">
                  เพิ่มข้อสอบรายวิชา <?php echo $exam_name ?>
                </div>
                <div class="panel-body" style="background-color:rgba(255, 255, 224, .45);">
                  <form class="form-horizontal" name="from1" method="post" enctype="multipart/form-data" >

                    <div class="form-group">
                      <label class="col-sm-3 control-label"></label>
                      <div class="col-sm-6">
                        <input type="hidden" class="form-control" name="test_name" value="<?php echo $exam_name ?>" disabled='disabled' />
                        <input type="hidden" class="form-control" name="exam_id" value="<?php echo $exam_id ?>" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">ข้อที่</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="test_no" placeholder=""
                        required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">โจทย์</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="test_name" placeholder="โจทย์"
                        required/>
                      </div>
                      <div class="col-sm-offset-3 col-sm-8">
                        <input type="file" class="form-control-file" name="test_namepic">
                      </div>
                    </div>
                    <hr />
                    <div class="form-group">
                      <label class="col-sm-3 control-label">1.</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="choiceA" placeholder="คำตอบ A"
                        required/>
                      </div>
                      <!-- <div class="col-sm-offset-3 col-sm-8">
                      <input type="file" class="form-control-file" name="choiceApic">
                    </div> -->
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">2.</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="choiceB" placeholder="คำตอบ A"
                      required/>
                    </div>
                    <!-- <div class="col-sm-offset-3 col-sm-8">
                    <input type="file" class="form-control-file" name="choiceBpic">
                  </div> -->
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">3.</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="choiceC" placeholder="คำตอบ A"
                    required/>
                  </div>
                  <!-- <div class="col-sm-offset-3 col-sm-8">
                  <input type="file" class="form-control-file" name="choiceCpic">
                </div> -->
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">4.</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="choiceD" placeholder="คำตอบ A"
                  required/>
                </div>
                <!-- <div class="col-sm-offset-3 col-sm-8">
                <input type="file" class="form-control-file" name="choiceDpic">
              </div> -->
            </div>
            <hr />
            <div class="form-group">
              <label class="col-sm-3 control-label">เฉลย</label>
              <div class="col-sm-8">
                <label class="radio-inline"><input type="radio" name="test_ans" value="1." checked>1.</label>
                <label class="radio-inline"><input type="radio" name="test_ans" value="2.">2.</label>
                <label class="radio-inline"><input type="radio" name="test_ans" value="3.">3.</label>
                <label class="radio-inline"><input type="radio" name="test_ans" value="4.">4.</label>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-success col-sm-offset-9 col-md-2"
                name="uploadTest" style="" value="submit">เพิ่ม</button>
              </div>
            </div>
          </form>
          <a href="createTest.php" style="color:orange;">
            ย้อนกลับ</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container w3-animate-opacity">
    <div class="container-fluid">
      <div class="col-sm-offset-1 col-sm-10">
        <div class="panel">
          <div class="panel-heading w3-lime">
            ตารางแสดงรายการข้อสอบ
          </div>
          <div class="panel-body" style="width: 100%; height: 200px; overflow: auto;">
            <?php
            //1. เชื่อมต่อ database:  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

            //2. query ข้อมูลจากตาราง tb_member:
            $query = "SELECT * FROM test_exam WHERE exam_id = $exam_id ORDER BY test_no asc" or die("Error:" . mysqli_error());
            //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
            $result = mysqli_query($dbc, $query);
            //4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:

            echo "<table class='table table-hover'>";
            //หัวข้อตาราง
            echo "<thead>
            <tr>

            <th width='5%'>ที่</th>
            <th width='70%'>โจทย์</th>
            <th width='15%'>รูป</th>
            <th width='5%'></th>
            <th width='5%'></th>
            </tr>
            </thead>
            <tbody>";

            while($row = mysqli_fetch_array($result)) {
              echo "<tr>";
              echo "<td>" .$row["test_no"] .  "</td> ";
              echo "<td>" .$row["test_name"] .  "</td> ";

              $image_name = $row["test_namepic"];
              if(empty( $image_name )) {
                echo "<td></td>";

              } else {
                echo "<td>". "<img src='../img/".$row["test_namepic"]."' width='100'>" . "</td> ";

              }

              echo "<td width='5%'><label><a href='testEdit.php?test_id=$row[0]' title='แก้ไขข้อสอบ'>
              <img src = 'icon/setting.png' width=30 px></label></td> ";

              echo "<td width='5%'><label><a href='testDelete.php?test_id=$row[0]' title='ลบข้อสอบ'
              onclick=\"return confirm('Do you want to delete this record? !!!')\">
              <img src = 'icon/remove.png' width=30 px></label></td> ";

              echo "</tr>";
            }
            echo "</tbody></table>";
            //5. close connection
            mysqli_close($dbc);
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
