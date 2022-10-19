<?php
	include("../include/class.mysqldb.php");
	include("../include/config.inc.php");
	include("../include/shareFunction.php");
	if(!isset($_SESSION['pk-logined']) && $_SESSION['pk-type'] != 'student') {
		echo "<meta http-equiv='refresh' content='0;url=../index.php'>";
	} else
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Mr.Surasith Taokok" />
	<meta name="keywords" content="โรงเรียนโป่งนกประชาสามัคคี" />
	<meta name="description" content="Student Information Project" />	
	<link rel="shortcut icon" href="../images/favicon.ico" />
    <link href="../css/main.css" type=text/css rel=stylesheet>
    <link href="../css/calendar-mos.css" type=text/css rel=stylesheet>
    <script language="javascript" src="../js/calendar.js"></script>
    <script language="javascript" src="../js/main.js"></script>

	<?php
		include("../fusionII/FusionCharts.php");
		include("../fusionII/FC_Colors.php");
	?>
    <script type="text/javascript" src="../fusionII/charts/FusionCharts.js"></script>
    <script type="text/javascript" language="Javascript" src="../fusionII/assets/ui/js/jquery.min.js"></script>
    <script type="text/javascript" language="Javascript" src="../fusionII/assets/ui/js/lib.js"></script>

	<title>ระบบสารสนเทศกิจการนักเรียนโรงเรียนโป่งนกประชาสามัคคี</title>
</head>
<body>
	<div id="header-bar">
		<div id="header-logoff" style="width:500px;">ยินดีต้อนรับ <?= $_SESSION['name'] ?> 
        &raquo; 
        | <a href="../logoff.php">ออกจากระบบ</a></div>
    </div>
    <div id="body">
    	<h3><a href="index.php">ระบบสารสนเทศกิจการนักเรียนโรงเรียนโป่งนกประชาสามัคคี</a></h3>
        <div id="left">
        <? if(!isset($_REQUEST['option'])) { ?>
            <div id="slogan">ระบบจัดการสารสนเทศกิจการนักเรียนเพื่อกำกับ ติดตาม ดูแลช่วยเหลือนักเรียน เพื่อเป้าหมายนักเรียนมีคุณลักษณะที่พึงประสงค์</div>
			<div id="cpanel">
                <div style="float:left;">
                    <div class="icon">
                        <a href="index.php?option=module_800/index">
                        <img src="../images/refresh.png" alt="กิจกรรมหน้าเสาธง" align="middle" border="0" />
                        <span>กิจกรรมหน้าเสาธง</span>
                        </a>
                    </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="index.php?option=module_learn/index">
                        <img src="../images/history.png" alt="บันทึกการเข้าชั้นเรียนและการเข้าสอน" align="middle" border="0" />
                        <span>บันทึกการเข้าเรียน</span>
                        </a>
                    </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="index.php?option=module_history/index">
                        <img src="../images/users.png" alt="สืบค้นประวัติ" align="middle" border="0" />
                        <span>สืบค้นประวัติ</span>
                        </a>
                    </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="index.php?option=module_gpa/index">
                        <img src="../images/gpa.png" alt="ผลสัมฤทธิ์ทางการเรียน" align="middle" border="0" />
                        <span>ผลการเรียน</span>
                        </a>
                    </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="index.php?option=module_discipline/index">
                        <img src="../images/discipline.png" alt="งานวินัยนักเรียน" align="middle" border="0" />
                        <span>งานวินัยนักเรียน</span>
                        </a>
                    </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                         <a href="index.php?option=module_maps/index">
                        <img src="../images/add.png" alt="แผนที่ติดตามที่อยู่" align="middle" border="0" height="48px" />
                        <span>แผนที่ติดตามที่อยู่</span>
                        </a>
                    </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="index.php?option=module_qa/index">
                        <img src="../images/qa.png" alt="งานประกันคุณภาพ/งานประเมิน" align="middle" border="0" />
                        <span>QA &amp; SAR</span>
                        </a>
                    </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="index.php?option=module_reports/index">
                        <img src="../images/chart.png" alt="สถิติ/รายงาน" align="middle" border="0" />
                        <span>สถิติ/รายงาน</span>
                        </a>
                    </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="index.php?option=module_projects/index">
                        <img src="../images/computer.png" alt="กิจกรรม/โครงการ" align="middle" border="0" />
                        <span>กิจกรรม/โครงการ</span>
                        </a>
                    </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="index.php?option=module_tcss/index">
                        <img src="../images/tcss.png" alt="ระบบดูแลช่วยเหลือนักเรียน" align="middle" border="0" />
                        <span>TCSS</span>
                        </a>
                    </div>
                </div>
                
                <div style="float:left;">
                    <div class="icon">
                        <a href="index.php?option=module_moral/index">
                        <img src="../images/objects.png" alt="ระบบสารสนเทศและดูแลธนาคารความดี" align="middle" border="0" />
                        <span>ธนาคารความดี</span>
                        </a>
                    </div>
                </div>

                <div style="float:left;display:none;">
                    <div class="icon">
                        <a href="index.php?option=module_color/index">
                        <img src="../images/color.png" alt="กิจกรรมคณะสี" align="middle" border="0" />
                        <span>กิจกรรมคณะสี</span>
                        </a>
                    </div> 
                </div>
				
                <div style="float:left;display:none;">
                    <div class="icon">
                        <a href="#">
                        <img src="../images/download.png" alt="คู่มือการใช้งาน" align="middle" border="0" />
                        <span>คู่มือการใช้งาน</span>
                        </a>
                    </div>
                </div>


                <div style="clear:both;"> </div>
            </div>
            <?php
				 } else { 
            		include($_REQUEST['option'] . ".php"); 
                 } 
            ?>
        </div>
        <div id="right">
			<h1>เมนูจัดการระบบ</h1>
                <ul>
                    <li><a href="index.php?option=module_800/index">กิจกรรมหน้าเสาธง</a></li>
                    <li><a href="index.php?option=module_learn/index">บันทึกการเข้าเรียน</a></li>
                    <li><a href="index.php?option=module_history/index">สืบค้นประวัติ</a></li>
                    <li><a href="index.php?option=module_discipline/index">งานวินัยนักเรียน</a></li>
                    <li><a href="index.php?option=module_maps/index">แผนที่ติดตามที่อยู่</a></li>
                    <li><a href="index.php?option=module_tcss/index">TCSS</a></li>
                    <li><a href="index.php?option=module_reports/index">สถิติ/รายงาน</a></li>
                </ul>
        </div>
    <div id="footer">
            สงวนลิขสิทธิ์ &copy; ระบบจัดการสารสนเทศกิจการนักเรียน<br />
			Copy Right &copy; Toby , All rights reserved. <br/>
			<a>System Develop by: Mr.Surasith Taokok,
			   E-mail:taokok@gmail.com,Tel:087 370 8079</a>
            <!-- ปรับปรุงล่าสุด 30 มีนาคม 2551 เวลา 4:06:15 น. -->
    </div>
    </div>
</body>
</html>
<?php
	}// end-else
	$link->closeConnect();
?>