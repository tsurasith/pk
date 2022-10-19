
<link rel="stylesheet" type="text/css" href="module_800/css/calendar-mos2.css"/>
<script language="javaScript" type="text/javascript" src="module_800/js/calendar.js"></script>

<div id ="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.1 แบบรายงานประจำวัน(ตัวเลขทั้งโรงเรียน)</strong></font></span></td>
      <td >
	  	ปีการศึกษา <?=$acadyear?> 
		ภาคเรียนที่	<?=$acadsemester?>
	  </td>
    </tr>
  </table>

<table class="admintable" width="100%" align="center">
	<tr>
		<td class="key" align="center" colspan="2">
			<form action="" method="post">
				เลือกวันที่ : 
				<input type="text" id="date" name="date" onClick="showCalendar(this.id)" size="12" maxlength="10" value="<?=(isset($_POST['date'])&&$_POST['date']!=""?$_POST['date']:"")?>" class="inputboxUpdate" /><br/>
				<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
				เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา <br/>
				<input type="submit" value="เรียกดู" name="search" class="button"/>
			</form>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<?php
				if(isset($_POST['search']) && $_POST['date'] == "")
				{
					echo "<font color='red'><br/><br/>ผิดพลาด ! ยังไม่ได้เลือกวันที่ค่ะ </font>";
				}
				if(isset($_POST['search']) && $_POST['date'] != "")
				{
					$sql = "";
					if($_POST['studstatus'] == "1,2")
					{
						$sql = "select class_id,
								  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
									sum(if(timecheck_id = '01',timecheck_id,null)) as b,
									sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
									sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
									sum(if(timecheck_id = '04',timecheck_id,null))/4 as e,
									count(class_id) as sum
								from student_800 left outer join students on student_id = id
									where check_date = '" . $_POST['date'] . "' and
									studstatus in (" . $_POST['studstatus'] . ") and xedbe = '" . $acadyear . "'
								  group by class_id order by class_id";
					}
					else
					{
						$sql = "select class_id,
								  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
								  sum(if(timecheck_id = '01',timecheck_id,null)) as b,
								  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
								  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
								  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e,
								  count(class_id) as sum
								from student_800
								where check_date = '" . $_POST['date'] . "'
								group by class_id order by class_id";
					}
					
					$result = mysql_query($sql);
					if(!$result || mysql_num_rows($result) == 0)
					{
						echo "<br/><br/><font color='red'>ไม่พบข้อมูลที่ค้นหา อาจเนื่องมาจากยังไม่บันทึกข้อมูลวันที่ค้นหา หรือ รูปแบบวันที่ผิดพลาด</font>";
					}
					else
					{
						echo "<table cellpadding=\"0\" cellspacing=\"1\" width=\"420\"  align=\"center\">";
						echo "<tr><td align=\"center\">"; ?>
						<br/><img src="../images/school_logo.gif" width="120px"><br/>
					<?	echo reportHeader($_POST['date'],$_POST['studstatus']);
						echo "</td></tr></table>";
						echo "<table cellpadding=\"0\" cellspacing=\"1\" width=\"420\" bgcolor=\"lightpink\" align=\"center\">";
						echo "<tr bgcolor=\"#FEEFEF\" align=\"center\">";
						echo "<td width=\"60px\">ห้อง</td>";
						echo "<td width=\"60px\">มา</td><td width=\"60px\">กิจกรรม</td>";
						echo "<td width=\"60px\">สาย</td><td width=\"60px\">ลา</td>";
						echo "<td width=\"60px\">ขาด</td><td width=\"60px\">รวม</td>";
						echo "</tr>";
						$_00 = 0;	$_01 = 0;	$_02 = 0;	$_03 = 0; $_04 = 0; $_sum = 0;
						while($dat = mysql_fetch_assoc($result))
						{
							echo "<tr bgcolor=\"white\">";
							echo "<td align=\"center\">" . getFullRoomFormat($dat['class_id']) . "</td>";
							echo "<td align=\"right\">" . ($dat['a']>0?$dat['a']:"-") . "</td>";
							echo "<td align=\"right\">" . ($dat['b']>0?$dat['b']:"-") . "</td>";
							echo "<td align=\"right\">" . ($dat['c']>0?$dat['c']:"-") . "</td>";
							echo "<td align=\"right\">" . ($dat['d']>0?$dat['d']:"-") . "</td>";
							echo "<td align=\"right\">" . ($dat['e']>0?$dat['e']:"-") . "</td>";
							echo "<td align=\"right\">" . number_format($dat['sum'],0,'.',',') . "</td>";
							echo "</tr>";
							$_00 = $_00 + $dat['a'];
							$_01 = $_01 + $dat['b'];
							$_02 = $_02 + $dat['c'];
							$_03 = $_03 + $dat['d'];
							$_04 = $_04 + $dat['e'];
							$_sum = $_sum + $dat['sum'];
						}
						echo "<tr>";
						echo "<td align=\"center\">รวม</td>";
						echo "<td align=\"right\">" . ($_00>0?number_format($_00,0,'.',','):"-") . "</td>";
						echo "<td align=\"right\">" . ($_01>0?$_01:"-") . "</td>";
						echo "<td align=\"right\">" . ($_02>0?$_02:"-") . "</td>";
						echo "<td align=\"right\">" . ($_03>0?$_03:"-") . "</td>";
						echo "<td align=\"right\">" . ($_04>0?$_04:"-") . "</td>";
						echo "<td align=\"right\">" . number_format($_sum,0,'.',',') . "</td>";
						echo "</tr>";
						echo "<tr bgcolor='#FBFBFB'>";
						echo "<td align=\"center\"><b>ร้อยละ</b></td>";
						echo "<td align=\"right\"><b><font color='red'>" . number_format(($_00/$_sum)*100,2,'.',',') . "</font></b></td>";
						echo "<td align=\"right\"><b><font color='red'>" . number_format(($_01/$_sum)*100,2,'.',',') . "</font></b></td>";
						echo "<td align=\"right\"><b><font color='red'>" . number_format(($_02/$_sum)*100,2,'.',',') . "</font></b></td>";
						echo "<td align=\"right\"><b><font color='red'>" . number_format(($_03/$_sum)*100,2,'.',',') . "</font></b></td>";
						echo "<td align=\"right\"><b><font color='red'>" . number_format(($_04/$_sum)*100,2,'.',',') . "</font></b></td>";
						echo "<td align=\"right\"><b><font color='red'>" . number_format(($_sum/$_sum)*100,2,'.',',') . "</font></b></td>";
						echo "</tr>";
						echo "</table>";
						mysql_free_result($result);
					}
				}
			?>
		</td>
	</tr>
</table>
</div>

<?php

	function reportHeader($date,$check)
	{
		$txt = "<span class='style1'><b>สถิติการมาเข้าร่วมกิจกรรมหน้าเสาธง</b><br/>";
		$txt = $txt . "โรงเรียนโป่งนกประชาสามัคคี <br/>ประจำวันที่ " ;

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
		
		if($check == "1,2")
		{
			$txt .= "<br/>รายงานนี้นับเฉพาะนักเรียนที่มีสถานภาพปกติหรือสำเร็จการศึกษาเท่านั้น";
		}
		
		return $txt  . "</span>";
	}
	
?>