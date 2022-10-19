<?php
	include("../../include/class.mysqldb.php");
	include("../../include/config.inc.php");
	if(!isset($_SESSION['pk-logined'])) {
		?><meta http-equiv="refresh" content="0;url=../index.php"><?
	} 
?>
<html>
	<head>
		<title>หน้าต่างบันทึกข้อมูลการเข้าร่วมกิจกรรมคณะสี</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
	<script type="text/javascript" language="javascript">
		function check(name,value) { document.getElementById(name).bgColor=value; }
	</script>

	<? $sql = 'SELECT id, prefix , firstname , lastname,xyearth,room FROM students WHERE xLevel =  \''. $_REQUEST['xlevel'] . '\' and color=\'' .$_REQUEST['color'] . '\' and xedbe = \'' .$acadyear . '\'  and studstatus = \'1\' order by xyearth,room,ordinal'; ?>
	<? $result = mysql_query($sql) or die ('Error  - ' .mysql_error()); ?>
	<? $i = 1;  $j = 0; ?>
	<? $rows = mysql_num_rows($result); ?>
	<form method="post" action="../index.php?option=module_color/insertStudentCheck">
	<table width="800px" align="center" class="admintable">
		<tr>
			<th class="header">
				<img src="../../images/school_logo.gif" width="120px"><br/>
				บันทึกการมาเข้าร่วมกิจกรรมคณะสีวันที่ <font color="red"><?=displayDate($_REQUEST['date'])?></font><br/>
				คณะสี <font color="#FF0000"><?=$_REQUEST['color']?></font> ระดับชั้น <font color="#FF0000"><?=$_REQUEST['xlevel']==3?"มัธยมศึกษาตอนต้น":"มัธยมศึกษาตอนปลาย"?></font>
			</th>
		</tr>
		<tr>
			<td align="center">
				<input type="hidden" name="task_id" value="<?=$_REQUEST['task_id']?>"/>
				<input type="hidden" name="date" value="<?=$_REQUEST['date']?>"/>
				<input type="hidden" name="acadyear" value="<?=$_REQUEST['acadyear']?>"/>
				<input type="hidden" name="acadsemester" value="<?=$_REQUEST['acadsemester']?>"/>
				<input type="hidden" name="color" value="<?=$_REQUEST['color']?>"/>
				<table width="760px" align="center">
					<tr> 
						<td rowspan="2" width="50px" class="key" align="center">เลขที่</td>
						<td rowspan="2" width="90px" align="center" class="key">เลขประจำตัว</td>
						<td rowspan="2" class="key" align="center">ชื่อ - สกุล</td>
						<td rowspan="2" width="60px" class="key" align="center">ห้อง</td>
						<td colspan="5" class="key" align="center">การมาเข้ากิจกรรมคณะสี <?=$_REQUEST['color']?></td>
					</tr>
					<tr>
						<td width="50px" align="center" class="key">มา</td>
						<td width="50px" align="center" class="key">กิจกรรม</td>
						<td width="50px" align="center" class="key">สาย</td>
						<td width="50px" align="center" class="key">ลา</td>
						<td width="50px" align="center" class="key">ขาด</td>
					</tr>
					<? while($data = mysql_fetch_array($result)){ ?>
						<tr id="<?="check[$j]"?>">
							<td align="center"><?=$i?></td>
							<td align="center"><input type="hidden" name=<?="student_id[$j]"?> value=<?=$data[0]?> /><?=$data[0]?></td>
							<td><?=$data[1].$data[2]. ' ' . $data[3]?></td>
							<td align="center">
								<?=$_REQUEST['xlevel']==3?$data[4]:3+$data[4]?>/<?=$data[5]?>
								<input type="hidden" name="<?="room_id[$j]"?>" value=<?=($_REQUEST['xlevel']==3?$data[4]:3+$data[4]) . "0" . $data[5]?> /></td>
							<td align="center"><input type='radio' name=<?="check[$j]"?> value='white'  checked onclick="check(this.name,this.value)" /></td>
							<td align="center"><input type='radio' name=<?="check[$j]"?> value='lightgreen'  onclick="check(this.name,this.value)" /></td>
							<td align="center"><input type='radio' name=<?="check[$j]"?> value='yellow'   onclick="check(this.name,this.value)" ></td>
							<td align="center"><input type='radio' name=<?="check[$j]"?> value='blue'   onclick="check(this.name,this.value)" ></td>
							<td align="center"><input type='radio' name=<?="check[$j]"?> value='red'  onclick="check(this.name,this.value)" ></td>
						</tr>
						<? $j++; $i++; ?>
						<? } //end while ?>
						<tr> 
							<td colspan="9" align="center"><br/>
								<input type="hidden" name="count" value="<?=$j?>"/>
								<input type="submit" value="บันทึก" />
								<input type="button" value="ยกเลิก" onClick="history.go(-1)"/>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		</form>
	</body>
</html>
<?php
	function displayDate($date) {
		$txt = "" ;
		$_x = explode('-',$date,3);
		switch ($_x[1]) {
			case "01" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน มกราคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "02" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน กุมภาพันธ์  พ.ศ. " . ($_x[0] + 543) ;break;
			case "03" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน มีนาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "04" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน เมษายน  พ.ศ. " . ($_x[0] + 543) ;break;
			case "05" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน พฤษภาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "06" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน มิถุุนายน  พ.ศ. " . ($_x[0] + 543) ;break;
			case "07" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน กรกฎาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "08" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน สิงหาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "09" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน กันยายน  พ.ศ. " . ($_x[0] + 543) ;break;
			case "10" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน ตุลาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "11" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน พฤศจิกายน  พ.ศ. " . ($_x[0] + 543) ;break;
			case "12" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน ธันวาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			default : $txt = $txt . "ผิดพลาด";
		}
		return $txt ;
	}
?>