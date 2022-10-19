<?php
	include("../../include/class.mysqldb.php");
	include("../../include/config.inc.php");
	include("../../include/shareFunction.php");
	if(!isset($_SESSION['pk-logined'])) {
		echo "<meta http-equiv='refresh' content='0;url=../index.php'>";
	} 
?>
<html>
<head>
	<title>หน้าต่างบันทึกข้อมูลการเข้าห้องเรียน</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    
    <style>
		.hover:hover{
			background-color:#C9F;
		}
	
		select option[value="white"] {
			background-color:#FFF;
		}
		select option[value="red"]{
			background-color: #F00;
		}
		select option[value="lightgreen"]{
			background-color: #0F0;
		}
		select option[value="yellow"]{
			background-color: #FF0;
		}
		select option[value="blue"]{
			background-color: #00F;
		}
	</style>
    
    
</head>
<body>
<script language="javascript" type="text/javascript">
	function check(name,value) 
	{ 
		if(value=="unsign")
		{
			document.getElementById(name).bgColor = "red"; 
		}
		else
		{
			document.getElementById(name).bgColor = "transparent"; 
		}
		
	}
	function check2(name,value) 
	{ 
		document.getElementById(name).bgColor=value; 
		document.getElementsByName(name).bgColor=value;
	}
</script>
<?php
			$room_id = getRoom($_REQUEST['room']);
			$xyear = getXyearth($_REQUEST['room']);
			$xlevel  = getXLevel($_REQUEST['room']);
/*
	$date = ????-??-??
	$room_id = ?
	$room = ?0?
	$xlevel = 3|4
	$xyear = 1-6
*/
?>
<form method="post" action="../index.php?option=module_learn/insertStudentCheck2">
<div  align="center">
	<table width="800px"  align="center" cellspacing="1" class="admintable">
		<tr>
			<td class="header" align="center">
				<img src="../../images/school_logo.gif" width="120px"><br/>
				บันทึกการเข้าชั้นเรียน<br/>ประจำวันที่  
				<font color="red"><?=displayFullDate($_REQUEST['date'])?></font>
				ห้อง  <font color="red"><?=getFullRoomFormat($_REQUEST['room'])?> </font><br/>
				ภาคเรียนที่ <?=$_REQUEST['acadsemester']?>  ปีการศึกษา <?=$_REQUEST['acadyear']?><br/>
			</td>
		</tr>
		<tr>
			<td class="key">รายละเอียดเพิ่มเติม</td>
		</tr>
		<tr>
        	<td>
                    <table width="100%">
                        <tr class="hover">
                            <td>
                                การลงลายมือชื่อของครูผู้สอน
                            </td>
                            <? for($_i=1;$_i<=8;$_i++) { ?>
                                    <td align="center" id="tCheck[<?=$_i?>]">
                                       คาบที่ <?=$_i?><br/>
                                        <select name="tCheck[<?=$_i?>]" onChange="check(this.name,this.value)">
                                            <option value="sign">ลงชื่อ</option>
                                            <option value="unsign">ไม่ลงชื่อ</option>
                                        </select>
                                    </td>
                            <? } ?>
                        </tr>
                    </table>
              </td>
        </tr>
		<tr>
			<td align="center">
					  <input type="hidden" name="room_id" value="<?=$_REQUEST['room']; ?>"/>
					  <input type="hidden" name="date" value="<?=$_REQUEST['date']; ?>"/>
					  <input type="hidden" name="acadyear" value="<?=$_REQUEST['acadyear']?>"/>
					  <input type="hidden" name="acadsemester" value="<?=$_REQUEST['acadsemester']?>"/>					  
					  					
                                          <table border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#3366FF">
                                            <tr bgcolor="#CCCCFF"> 
                                              <td width="20px" rowspan="2"><div align="center"><font color="#990066"><strong>เลขที่</strong></font></div></td>
                                              <td width="80px" rowspan="2"><div align="center"><font color="#990066"><strong>เลขประจำตัว</strong></font></div></td>
                                              <td width="200px" rowspan="2"><div align="center"><font color="#990066"><strong>ชื่อ - สกุล</strong></font></div></td>
                                              <td colspan="8"><div align="center"><font color="#990066"><strong>การมาเข้าห้องเรียน</strong></font></div></td>
                                            </tr>
                                            <tr bgcolor="#CCCCFF"> 
                                              <? for($_i=1;$_i<=8;$_i++){ ?>
                                              		<td align="center"><font color="#990066">คาบที่ <?=$_i?></font></td>
                                              <? } ?>
                                            </tr>
                                            <?php

  	$sql = 'SELECT id, prefix , firstname , lastname FROM students WHERE xLevel =  \''. $xlevel . '\' AND xYearth = \'' . $xyear .'\' and room = \'' . $room_id  .  '\' and xedbe = \'' .$acadyear . '\'  and studstatus = \'1\' order by sex,id';
//	echo $sql;
  	$result = mysql_query($sql) or die ('Error  - ' .mysql_error());
	$j = 1;
	$rows = mysql_num_rows($result);
	while($data = mysql_fetch_array($result))
	{
		echo "<tr class=\"hover\" bgcolor=\"#FFFFFF\">";
		echo "<td align=\"center\"><font size=\"2\" face=\"Tahoma, sans-serif\">" . $j . "</font></td>";
		echo "<td align=\"center\"><input type=\"hidden\" name=\"student_id[$j]\" value=\"$data[0]\" /><font size=\"2\" face=\"Tahoma, sans-serif\">$data[0]</font></td>";
		echo "<td><font size=\"2\" face=\"Tahoma, sans-serif\">$data[1]$data[2]  $data[3]</font></td>";
		for($_i=1;$_i<=8;$_i++) {
			echo "<td id=\"sCheck[$j][$_i]\" align=\"center\">
						<select name=\"sCheck[$j][$_i]\" onChange='check2(this.name,this.value);'>
							<option value='white'>มา</option>
							<option value='lightgreen'>กก.</option>
							<option value='yellow'>สาย</option>
							<option value='blue'>ลา</option>
							<option value='red'>ขาด</option>
						</select>
				  </td>";
		}
		echo "</tr>";
		$j++;
	}
	
?>
                                            <tr bgcolor="#FFFFFF"> 
                                              <td colspan="11" align="center"> 
                                                <input type="hidden" name="count" value="<?=$j?>>"/>
                                                <input type="submit" value="บันทึก"/> 
                                                <input type="button" value="ยกเลิก" onClick="history.go(-1)"/> 
                                              </td>
                                            </tr>
                                          </table>


					  </td>
					  </tr>
</table>

<? mysql_free_result($result); ?>		
</div>		
</form>	
</body>
</html>
