<html lang="en">
<head>
  <title>ส่งข้อสอบ</title>
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
        <a class="navbar-brand" href="#">&nbsp;CES</a>
      </div>
      <ul class="nav navbar-nav">
        <li class=""><a href="lecturerIndex.php">หน้าหลัก</a></li>
        <li class=""><a href="createTest.php">สร้างชุดข้อสอบ</a></li>
        <li class="active"><a href="sendTest.php">ส่งข้อสอบ</a></li>
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
        <div class="col-sm-offset-1 col-sm-10">
          <div class="panel">
            <div class="panel-heading w3-red">
              ตารางแสดงรายการชุดข้อสอบ
            </div>
            <div class="panel-body " style="background-color: rgba(255, 255, 224, .45);; width: 100%; height: 250px; overflow: auto;">
              <input type="hidden" class="form-control" name="exam_status" value="ส่งแล้ว" />
              <?php
              //1. เชื่อมต่อ database:  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
              $class = $_SESSION['class'];
              $stat = '';
              //2. query ข้อมูลจากตาราง tb_member:
              $query = "SELECT * FROM create_exam WHERE users_class_id = '$class'
              and exam_status = '$stat' ORDER BY exam_id asc" or die("Error:" . mysqli_error());
              //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
              $result = mysqli_query($dbc, $query);
              //4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:

              echo "<table class='table table-hover'>";
              //หัวข้อตาราง
              echo "<thead>
              <tr>

              <th width='10%'>รายวิชา</th>
              <th width='75%'>ชื่อข้อสอบ</th>
              <th width='5%'></th>
              <th width='5%'></th>
              </tr>
              </thead>
              <tbody>";

              while($row = mysqli_fetch_array($result)) {
                echo "<tr>";

                echo "<td><a style='color:red;'>" .$row["users_class_id"] .  "</a></td> ";
                echo "<td>" .$row["exam_name"] .  "</td> ";
                echo
                "<td><label><a href='sendTest_view.php?exam_id=$row[0]' title='ดูข้อสอบ'>
                <img src = 'icon/info.png' width=30 px></label>
                </td>
                ";
                echo "<td><label><a href='sendTest_ad.php?exam_id=$row[0]' title='ส่งข้อสอบ'>
                <img src = 'icon/play-button.png' width=30 px></label></td>";

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
    <div class="container w3-animate-opacity">
      <div class="container-fluid">
        <div class="col-sm-offset-1 col-sm-10">
          <div class="panel">
            <div class="panel-heading w3-green">
              ตารางแสดงรายการข้อสอบที่ต้องตรวจ
            </div>
            <div class="panel-body" style=" width: 100%; height: 250px; overflow: auto;">
              <?php
              //1. เชื่อมต่อ database:  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
              $status = 'ส่งแล้ว';
              //2. query ข้อมูลจากตาราง tb_member:
              $query = "SELECT * FROM create_exam WHERE users_class_id = '$class' and exam_status = '$status' ORDER BY exam_id asc" or die("Error:" . mysqli_error());
              //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
              $result = mysqli_query($dbc, $query);
              //4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:

              echo "<table class='table table-hover'>";
              //หัวข้อตาราง
              echo "<thead>
              <tr>

              <th width='10%'>รายวิชา</th>
              <th width='75%'>ชื่อข้อสอบ</th>
              <th width='10%'></th>
              <th width='5%'></th>
              </tr>
              </thead>
              <tbody>";

              while($row = mysqli_fetch_array($result)) {
                echo "<tr>";

                echo "<td><a style='color:green;'>" .$row["users_class_id"] .  "</a></td> ";
                echo "<td>" .$row["exam_name"] .  "</td> ";
                echo "<td width='10%'>" .$row["exam_status"] . " <span class='glyphicon glyphicon-ok' style='color:green;'>" . "</td> ";

                $status=$row["send_status"];
                if($status=='เรียบร้อย') {
                  echo "<td><label> <a title='พิจารณาแล้ว'>
                  <img src = 'icon/checks.png' width=30 px></a></label></td> ";
                }else if($status=='') {
                  echo "<td><label> <a href='sendTest_can.php?exam_id=$row[0]' title='ยกเลิกการส่ง'>
                  <img src = 'icon/cancel.png' width=30 px></a></label></td> ";
                }
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
