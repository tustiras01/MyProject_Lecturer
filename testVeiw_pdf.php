<?php
require_once('mpdf/mpdf.php');
ob_start();
?>
<?php
include("jscss.php");
include("mysqlconnect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
  <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
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
    $exam_id = $_GET["exam_id"];
    //2. query ข้อมูลจากตาราง:
    $sql = "SELECT * FROM create_exam WHERE exam_id='$exam_id' ";
    $result = mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
    $row = mysqli_fetch_array($result);
    extract($row);
    ?>
    <div class=header>
      <table align="center" cellpadding="4" cellspacing="0">
        <tr>
          <td align="center"><span style="font-size: 14pt; font-weight: bold; text-decoration: underline;">
            แบบทดสอบ <?php echo $exam_name; ?></span>
          </td>
        </tr>
        <tr>
          <td align="center"><span
            style="font-size: 12pt;">
            <?php
            $thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
            $thai_month_arr=array(
              "0"=>"",
              "1"=>"มกราคม",
              "2"=>"กุมภาพันธ์",
              "3"=>"มีนาคม",
              "4"=>"เมษายน",
              "5"=>"พฤษภาคม",
              "6"=>"มิถุนายน",
              "7"=>"กรกฎาคม",
              "8"=>"สิงหาคม",
              "9"=>"กันยายน",
              "10"=>"ตุลาคม",
              "11"=>"พฤศจิกายน",
              "12"=>"ธันวาคม"
            );
            function thai_date($time){
              global $thai_day_arr,$thai_month_arr;
              $thai_date_return="วัน".$thai_day_arr[date("w",$time)];
              $thai_date_return.= "ที่ ".date("j",$time);
              $thai_date_return.=" เดือน".$thai_month_arr[date("n",$time)];
              $thai_date_return.= " พ.ศ.".(date("Yํ",$time)+543);
              // $thai_date_return.= "  ".date("H:i",$time)." น.";
              return $thai_date_return;
            }
            ?>
            <?php
            $eng_date=time(); // แสดงวันที่ปัจจุบัน
            echo "วันที่ออกข้อสอบ " . thai_date($eng_date); ?></span>
          </td>
        </tr>
        <tr>
          <td align="center"><span
            style="font-size: 12pt;">
            ภาควิชาวิทยาการคอมพิวเตอร์ คณะวิทยาศาสตร์</span>
          </td>
        </tr>
        <tr>
          <td align="center"><span
            style="font-size: 12pt;">
            มหาวิทยาลัยสงขลานครินทร์ วิทยาเขตหาดใหญ่</span>
          </td>
        </tr>
      </table>
      <hr />
    </div>
    <div class=body>

      <?php
      //1. เชื่อมต่อ database:  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

      //2. query ข้อมูลจากตาราง tb_member:
      $query = "SELECT * FROM test_exam WHERE exam_id = $exam_id ORDER BY test_no asc" or die("Error:" . mysqli_error());
      //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
      $result = mysqli_query($dbc, $query);
      while($row = mysqli_fetch_array($result)) {
        $no = $row["test_no"];
        ?>
          <table align="left" cellpadding="4" cellspacing="0">
            <tr>
              <td align="left"><span
                style="font-size: 11pt; font-weight: bold;">
                <?php echo $row["test_no"]; ?>. <?php echo $row["test_name"]; ?></span>
              </td>
            </tr>
            <tr>
              <?php  $image_name = $row["test_namepic"];
              if(empty( $image_name )) {
              } else {
                echo "<td>" . "<img src='../img/".$row["test_namepic"]."' width='500' align='center'>" . "</td> <br />";
              }?>
            </tr>
            <tr>
              <td>

              </td>
            </tr>
            <tr>
              <?php
              $test_ans = $row["test_ans"];
              if($test_ans == '1.') { ?>
                <td align="left"><label><span
                  style="font-size: 11pt; color: red;">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  1. <?php echo $row["choiceA"];?></span></label>
                </td>
                <?php }else{?>
                  <td align="left"><label><span
                    style="font-size: 11pt;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    1. <?php echo $row["choiceA"];?></span></label>
                  </td>
                  <?php } ?>
                </tr>
                <tr>
                  <?php
                  $test_ans = $row["test_ans"];
                  if($test_ans == '2.') { ?>
                    <td align="left"><label><span
                      style="font-size: 11pt; color: red;">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      2. <?php echo $row["choiceB"];?></span></label>
                    </td>
                    <?php }else{?>
                      <td align="left"><label><span
                        style="font-size: 11pt;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        2. <?php echo $row["choiceB"];?></span></label>
                      </td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <?php
                      $test_ans = $row["test_ans"];
                      if($test_ans == '3.') { ?>
                        <td align="left"><label><span
                          style="font-size: 11pt; color: red;">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          3. <?php echo $row["choiceC"];?></span></label>
                        </td>
                        <?php }else{?>
                          <td align="left"><label><span
                            style="font-size: 11pt;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            3. <?php echo $row["choiceC"];?></span></label>
                          </td>
                          <?php } ?>
                        </tr>
                        <tr>
                          <?php
                          $test_ans = $row["test_ans"];
                          if($test_ans == '4.') { ?>
                            <td align="left"><label><span
                              style="font-size: 11pt; color: red;">
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              4. <?php echo $row["choiceD"];?></span></label>
                            </td>
                            <?php }else{?>
                              <td align="left"><label><span
                                style="font-size: 11pt;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                4. <?php echo $row["choiceD"];?></span></label>
                              </td>
                              <?php } ?>
                            </tr>
                            <td align="left">

                            </td>
                          </tr>
                        </table>
                      </div>
                      <?php } ?>
                    <footer style="position: absolute; bottom: 10px; right: 16px;">
                      รายวิชา 344-493 ประมวลความรอบรู้ทางวิทยาการคอมพิวเตอร์
                    </footer>
                  </body>
                  </html>
                  <?Php
                  $html = ob_get_contents();
                  ob_end_clean();
                  $pdf = new mPDF('th', 'A4', '0', 'THSaraban');
                  $pdf->SetAutoFont();
                  $pdf->SetDisplayMode('fullpage');
                  $pdf->WriteHTML($html, 2);
                  $pdf->Output();
                  ?>
                  <!-- ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF.pdf">คลิกที่นี้</a> -->
