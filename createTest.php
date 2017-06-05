<html lang="en">
<head>
  <title>สร้างชุดข้อสอบ</title>
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
  // echo $_SESSION['pass'];
  // echo "OK";
  ?>
  <nav class="navbar navbar-default">
    <div class="container-fluid ">
      <div class="navbar-header navbar-right">
        <a class="navbar-brand" href="#"> &nbsp;CES</a>
      </div>
      <ul class="nav navbar-nav">
        <li class=""><a href="lecturerIndex.php">หน้าหลัก</a></li>
        <li class="active"><a href="createTest.php">สร้างชุดข้อสอบ</a></li>
        <li class=""><a href="sendTest.php">ส่งข้อสอบ</a></li>
        <li class=""><a href="checkStatus.php">ตรวจสถานะข้อสอบ</a></li>

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
        <div class="col-md-offset-1 col-md-10">

          <?php
          if(isset($_POST["uploadExam"])){

            $exam_name= $_POST["exam_name"];
            $users_class_id=$_SESSION['class'];


            $stmt = $dbc->prepare("INSERT INTO create_exam (
              exam_name,
              users_class_id)

              VALUES(?,?)");
              $stmt->bind_param("ss",
              $exam_name,
              $users_class_id);

              $stmt->execute();
              ?>

              <div class="alert alert-success alert-dismissible" role="alert">
                <a href="createTest.php" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </a>
                <span class="glyphicon glyphicon-ok"></span> <strong>บันทึกสำเร็จ</strong> <?php echo $exam_name; ?>
              </div>

              <?php }  ?>

              <div class="panel">
                <div class="panel-heading w3-green">
                  เพิ่มชุดข้อสอบ
                </div>
                <div class="panel-body" style="background-color: rgba(255, 255, 224, .45);">
                  <br /><form class="form-horizontal" name="from1" method="post" enctype="multipart/form-data" >
                    <div class="form-group">
                      <label class="col-sm-3 control-label">ชื่อชุดข้อสอบ</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="exam_name" placeholder="ชื่อชุดข้อสอบ" value="" required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">รหัสวิชา</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="users_class_id" value="<?php echo $_SESSION['class'];?>" disabled/>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class=" col-sm-12">
                        <button type="submit" class="btn btn-success col-sm-offset-9 col-md-2"
                        name="uploadExam" style="" value="submit">เพิ่ม</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container w3-animate-opacity">
          <div class="container-fluid">
            <div class="col-sm-offset-1 col-sm-10">
              <div class="panel">
                <div class="panel-heading w3-blue">
                  ตารางแสดงรายการชุดข้อสอบ
                </div>
                <div class="panel-body"  style="width: 100%; height: 300px; overflow: auto;">
                  <?php
                  //1. เชื่อมต่อ database:  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้านี้
                  $status = '';
                  $class = $_SESSION['class'];
                  //2. query ข้อมูลจากตาราง tb_member:
                  $query = "SELECT * FROM create_exam WHERE users_class_id = '$class'
                  and exam_status = '$status' ORDER BY exam_id asc" or die("Error:" . mysqli_error());
                  //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . ORDER BY exam_id asc" or die("Error:" . mysqli_error());
                  //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
                  $result = mysqli_query($dbc, $query);
                  //4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:

                  echo "<table class='table table-hover'>";
                  //หัวข้อตาราง
                  echo "<thead>
                  <tr>

                  <th width='10%'>รายวิชา</th>
                  <th width='70%'>ชื่อข้อสอบ</th>
                  <th width='5%'></th>
                  <th width='5%'></th>
                  <th width='5%'></th>
                  <th width='5%'></th>

                  </tr>
                  </thead>
                  <tbody>";

                  while($row = mysqli_fetch_array($result)) {
                    echo "<tr>";

                    echo "<td><a class='w3-text-blue'>" .$row["users_class_id"] .  "</a></td> ";
                    echo "<td>" .$row["exam_name"] .  "</td> ";

                    echo "<td><label><a href='addTest.php?exam_id=$row[0]' title='เพิ่มข้อสอบ'>
                    <img src = 'icon/add.png' width=30 px></label></td>
                    ";

                    echo "<td><label><a href='addTest_csv.php?exam_id=$row[0]' title='เพิ่มข้อสอบด้วยCSV'>
                    <img src = 'icon/csv.png' width=30 px></label></td>
                    ";

                    echo
                    "<td><label><a href='testVeiw.php?exam_id=$row[0]' title='ดูข้อสอบ'>
                    <img src = 'icon/info.png' width=30 px></label>
                    </td>
                    ";


                    echo "<td width='5%'><label><a href='createTest_dl.php?exam_id=$row[0]' title='ลบชุดข้อสอบ'
                    onclick=\"return confirm('Do you want to delete this record? !!!')\">
                    <img src = 'icon/remove.png' width=30 px></label></td>
                    ";

                    echo "</tr>";
                  }
                  echo "</tbody></table>";
                  //5. close connection

                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </body>
      </html>
