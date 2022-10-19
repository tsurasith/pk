<?php
	include("../../include/class.mysqldb.php");
	include("../../include/config.inc.php");
	include("../../include/shareFunction.php");
	if(!isset($_SESSION['pk-logined'])) {
		echo "<meta http-equiv='refresh' content='0;url=../../index.php'>";
	} 
?>
<html>
<head>
	<title>บันทึกข้อมูลการคัดกรองสารเสพติดในสถานศึกษา</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <script type="text/javascript">
		function check(name,value){ document.getElementById(name).bgColor=value; }
	</script>
</head>
<body>

<?php
	  $xlevel  = getXlevel($_REQUEST['room']);
	  $xyear   = getXyearth($_REQUEST['room']);
	  $room_id = getRoom($_REQUEST['room']);
?>

<div align="center">
<form method="post" action="../index.php?option=module_discipline/insertStudentCheck">
	<table width="800px"  align="center" cellspacing="1" class="admintable">
            <tr>
                <td class="header" align="center">
                    <img src="../../images/school_logo.gif" width="120px"><br/>
                    บันทึกการคัดกรองสารเสพติด "<font color="red"><?=displayDrug($_REQUEST['drugType'])?></font>"<br/>
                    เดือน	<font color="red"><?=displayMonth($_REQUEST['month'])?></font>
                    ห้อง <font color="red"><?=getFullRoomFormat($_REQUEST['room'])?> </font><br/>
                    ภาคเรียนที่ <font color="red"><?=$_REQUEST['acadsemester']?></font>
                    ปีการศึกษา <font color="red"><?=$_REQUEST['acadyear']?></font><br/>
                </td>
            </tr>
            <tr>
                <td class="key">รายละเอียดเพิ่มเติม</td>
            </tr>
            <tr>			  	
                <td align="center">
                    <font size="2" face="MS Sans Serif, sans-serif" color="#6633FF">
                        คลิ๊กเลือกที่เช็คบ๊อกสำหรับผลการคัดกรองประเภทสารเสพติดเหมือนกัน</font>
                        <?php
                            $p_sql = "select task_date , task_roomid, task_status , drug_id from student_drug_task 
                                        where month(task_date) = '"  .$_REQUEST['month'] . "' 
                                            and task_roomid = '" . $_REQUEST['room'] . "' 
                                            and acadyear = '" . $_REQUEST['acadyear'] ."'
                                        order by drug_id" ;
                            $p_res = mysql_query($p_sql) or dir(mysql_error());
                        ?>
                        <table cellspacing="2" cellpadding="2" class="admintable">
                            <tr>
                            <? while($_datP = mysql_fetch_assoc($p_res)) { ?>
                                <? if($_datP['task_status']=="0" && $_datP['drug_id'] != $_REQUEST['drugType']){ ?>
                                    <td <?=($_datP['drug_id']==$_REQUEST['drugType'])?"":"class='key'"?>>
                                        <input type="checkbox" name="drugCheck<?=$_datP['drug_id']?>" value="<?=$_datP['drug_id']?>" />
                                        <?=displayDrug($_datP['drug_id'])?>
                                    </td>
                                <? } else { //end if ?>
                                    <td >
                                        <font color="#009933"><b><?=displayDrug($_datP['drug_id'])?></b></font>
                                    </td>
                                <? } //end else ?>
                            <? } //end while ?>
                            </tr>
                        </table>
                </td>
            </tr>
            <tr>
                <td align="center">		 
                    <input type="hidden" name="room_id" value="<?=$_REQUEST['room']?>"/>
                    <input type="hidden" name="month" value="<?=$_REQUEST['month']?>"/>
                    <input type="hidden" name="drugType" value="<?=$_REQUEST['drugType']?>"/>
                    <input type="hidden" name="acadyear" value="<?=$_REQUEST['acadyear']?>"/>
                    <input type="hidden" name="acadsemester" value="<?=$_REQUEST['acadsemester']?>"/>					  
                    <table width="638px" class="admintable">
                        <tr>
                            <td>
                                <font face="MS Sans Serif, sans-serif" size="2">ผู้บันทึกข้อมูล :</font><font color="blue" face="MS Sans Serif, sans-serif" size="2"> <?= $_SESSION['name'] ?></font>
                            </td>
                        </tr>
                    </table>
                    <?php
                        $sql = "SELECT id, prefix , firstname , lastname FROM students
                                    WHERE xlevel = '" . $xlevel . "' AND xyearth = '" . $xyear . "' 
                                        and room = '" . $room_id  .  "' and xedbe = '" .$acadyear . "'  
                                        and studstatus = '1' order by sex,id ";
                        $result = mysql_query($sql) or die ('Error  - ' . mysql_error());
                        $i = 1;
                        $j = 0;
                        $rows = mysql_num_rows($result);
                    ?>
                    <table width="638px" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#3366FF" class="admintable">
                        <tr align="center"> 
                            <td width="60px" rowspan="2" class="key"><font color="#990066"><strong>เลขที่</strong></font></td>
                            <td width="100px" rowspan="2" class="key"><font color="#990066"><strong>เลขประจำตัว</strong></font></td>
                            <td width="220px" rowspan="2" class="key"><font color="#990066"><strong>ชื่อ - สกุล</strong></font></td>
                            <td colspan="4" class="key"><font color="#990066"><strong>การมาเข้าห้องเรียน</strong></font></td>
                        </tr>
                        <tr align="center"> 
                            <td width="10%"  class="key">ปกติ</td>
                            <td width="10%"  class="key">เสี่ยง</td>
                            <td width="10%"  class="key">เคยลอง</td>
                            <td width="10%"  class="key">ติด</td>
                        </tr>
                        <? while($data = mysql_fetch_array($result)) { ?>
                        <tr id="check[<?=$j?>]"  bgcolor='#FFFFFF' >
                            <td align="center"><?=$i?></td>
                            <td align="center">
                                <input type="hidden" name="student_id[<?=$j?>]" value="<?=$data[0]?>" />
                                <?=$data[0]?>
                            </td>
                            <td><?=$data[1].$data[2]. ' ' . $data[3]?></td>
                            <td align="center"><input type="radio" name="check[<?=$j?>]" value="white" checked onClick="check(this.name,this.value)" /></td>
                            <td align="center"><input type="radio" name="check[<?=$j?>]" value="yellow" onClick="check(this.name,this.value)" ></td>
                            <td align="center"><input type="radio" name="check[<?=$j?>]" value="orange" onClick="check(this.name,this.value)" ></td>
                            <td align="center"><input type="radio" name="check[<?=$j?>]" value="red" onClick="check(this.name,this.value)" ></td>	
                        </tr>
                        <? $j++; $i++; ?>
                        <? } //end while ?>
                        <tr bgcolor="#FFFFFF">
                            <td colspan="8" align="center">
                                <input type="hidden" name="count" value="<?=$j?>"/>
                                <input type="submit" value="บันทึก"/>
                                <input type="button" value="ยกเลิก" onClick="history.go(-1)"/> 
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
    </table>
</form>	
</div>		
	

</body>
</html>
<?php

	function displayDrug($_value)
	{
		switch($_value){
			case '00' : return "บุหรี่"; break;
			case '01' : return "เครื่องดื่มแอลกอฮอร์"; break;
			case '02' : return "ยาบ้า"; break;
			case '03' : return "สารระเหย"; break;
			default : return "ไม่ระบุ"; }
	}
?>