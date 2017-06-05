<html lang="en">
<head>
  <title>จัดการผู้ใช้งาน</title>
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
        <li class="active"><a href="addUser.php">จัดการผู้ใช้งาน</a></li>
        <li class=""><a href="createTest.php">สร้างชุดข้อสอบ</a></li>
        <li class=""><a href="sendTest.php">ส่งข้อสอบ</a></li>
        <li class=""><a href="testCheck.php">พิจารณาข้อสอบ</a></li>
        <li class=""><a href="checkStatus.php">ตรวจสถานะข้อสอบ</a></li>
        <li class=""><a href="testRandom.php">สุ่มข้อสอบ</a></li>
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
          if(isset($_POST["uploadUser"])){

            $users_type= $_POST["users_type"];
            $users_name= $_POST["users_name"];
            $users_pass= $_POST["users_pass"];
            $users_fname= $_POST["users_fname"];
            $users_lname= $_POST["users_lname"];
            $users_class= $_POST["users_class"];
            $users_class_id= $_POST["users_class_id"];
            $users_mail= $_POST["users_mail"];
            $users_call= $_POST["users_call"];

            $stmt = $dbc->prepare("INSERT INTO test_insert ( users_type,
              users_name,
              users_pass,
              users_fname,
              users_lname,
              users_class,
              users_class_id,
              users_mail,
              users_call)
              VALUES(?,?,?,?,?,?,?,?,?)");
              $stmt->bind_param("sssssssss",$users_type,$users_name,$users_pass,$users_fname,$users_lname,$users_class,$users_class_id,$users_mail,$users_call);
              $stmt->execute();
              ?>

              <div class="alert alert-success alert-dismissible" role="alert">
                <a href="addUser.php" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </a>
                <span class="glyphicon glyphicon-ok"></span> <strong>บันทึกสำเร็จ</strong> <?php echo $users_name; ?>
              </div>

              <?php }  ?>

              <div class="panel" >
                <div class="panel-heading w3-red">
                  <span class="glyphicon glyphicon-user"></span> &nbsp;เพิ่มผู้ใช้งาน
                </div>
                <div class="panel-body" style="background-color: rgba(255, 255, 224, .45);">
                  <form class="form-horizontal" name="from1" method="post" enctype="multipart/form-data" >
                    <br />
                    <div class="form-group">
                      <label class="col-sm-3 control-label">ประเภทผู้ใช้งาน</label>
                      <div class="col-sm-8">
                        <select class="form-control" name="users_type" required>
                          <option value="">เลือกประเภทผู้ใช้งาน</option>
                          <option value="LECTURER">อาจารย์</option>
                          <option value="COORDINATER">ผู้ประสานงานรายวิชา 344-493</option>
                          <option value="COMMITTEE">คณะกรรมการ</option>
                          <option value="ADMIN">ผู้ดูแลระบบ</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">ชื่อผู้ใช้งาน</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="users_name" placeholder="ชื่อผู้ใช้งาน"
                        required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">รหัสผ่าน</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" name="users_pass" placeholder="รหัสผ่าน"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                        title="กรุณาใช้ตัวอักษรภาษาอังกฤษพิมใหญ่ พิมพ์เล็ก และตัวเลข จำนวน8ตัวอักษร" required/>

                      </div>
                    </div>
                    <hr />

                    <div class="form-group">
                      <label class="col-sm-3 control-label">ชื่อ</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="users_fname" placeholder="ชื่อ"
                        title="Somchai" style="text-transform:capitalize;" required/>

                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">นามสกุล</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="users_lname" placeholder="สกุล"
                        title="Tongsri" style="text-transform:capitalize;" required/>

                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">ชื่อวิชา</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="users_class"
                        placeholder="ชื่อรายวิชา" style="text-transform:capitalize;" required/>

                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">รหัสวิชา</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control " name="users_class_id"
                        placeholder="ex: 344-123" pattern="344[\-]\d{3}" required/>

                      </div>
                    </div>
                    <hr />

                    <div class="form-group">
                      <label class="col-sm-3 control-label">อีเมล</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="users_mail"
                        placeholder="ex: example@email.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                        required/>

                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">เบอร์โทรศัพท์</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="users_call" placeholder="ex: 012-345-6789"
                        pattern="\d{3}[\-]\d{3}[\-]\d{4}" required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class=" col-sm-12">

                        <button type="submit" class="btn btn-success col-sm-offset-9 col-md-2"
                        name="uploadUser" style="" value="submit">เพิ่ม</button>

                      </div>

                    </div>
                  </form>
                  <button class="btn btn-warning" data-toggle="collapse" data-target="#news">
                    <span class="glyphicon glyphicon-option-vertical"></span> &nbsp;แสดงรายการผู้ใช้งาน</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container w3-animate-opacity">
          <div class="container-fluid">
            <div class="col-sm-offset-1 col-sm-10">
              <div id="news" class="panel collapse">
                <div class="panel-heading w3-orange">
                  <span class="glyphicon glyphicon-user"></span> &nbsp;ตารางแสดงรายการผู้ใช้งาน
                </div>
                <div class="panel-body" style="width: 100%; height: 500px; overflow: auto;">
                  <?php
                  //1. เชื่อมต่อ database:  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

                  //2. query ข้อมูลจากตาราง tb_member:
                  $query = "SELECT * FROM test_insert ORDER BY users_id asc" or die("Error:" . mysqli_error());
                  //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
                  $result = mysqli_query($dbc, $query);
                  //4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:

                  echo "<table class='table table-hover'>";
                  //หัวข้อตาราง
                  echo "
                  <thead>
                  <tr>
                  <th width='5%'>#</th>
                  <th width='15%'>ชื่อ</th>
                  <th width='10%'>Username</th>
                  <th width='40%'>วิชา</th>
                  <th width='15%'>รหัสวิชา</th>
                  <th width='10%'>ประเภท</th>
                  <th width='5%'></th>
                  <th width='5%'></th>
                  </tr>
                  </thead>
                  <tbody>";

                  while($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" .$row["users_id"] .  "</td> ";
                    echo "<td class='w3-text-orange'>" .$row["users_fname"] .  "</td> ";
                    echo "<td>" .$row["users_name"] .  "</td> ";
                    echo "<td>" .$row["users_class"] .  "</td> ";
                    echo "<td class='w3-text-orange'>" .$row["users_class_id"] .  "</td> ";
                    echo "<td>" .$row["users_type"] .  "</td> ";

                    echo "<td><label><a href='userEdit.php?users_id=$row[0]' title='แก้ไขผู้ใช้งาน'>
                    <img src = 'icon/setting.png' width=30 px></label>
                    </td>" ;

                    echo
                    "<td><label><a href='userDelete.php?users_id=$row[0]' title='ลบผู้ใช้งาน'
                    onclick=\"return confirm('Do you want to delete this record? !!!')\">
                    <img src = 'icon/remove.png' width=30 px></label>
                    </td> ";

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
