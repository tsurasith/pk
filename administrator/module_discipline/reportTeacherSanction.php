
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.7 รายงานสรุปพฤติกรรมไม่พึงประสงค์<br/>ตามครูผู้ควบคุมการดำเนินกิจกรรมปรับเปลี่ยนพฤติกรรม</strong></font></span></td>
      <td align="right">
		<?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา <?php  
					echo "<a href=\"index.php?option=module_discipline/reportTeacherSanction&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/reportTeacherSanction&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_discipline/reportTeacherSanction&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_discipline/reportTeacherSanction&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<form name="myform" method="post">
		<font color="#000000" size="2"  >
			 เลือกครูผู้ควบคุม
			 <? $_resTeacher = mysql_query("select distinct sanc_teacher from student_sanction a left outer join student_disciplinestatus b 
			 									on (a.dis_id = b.dis_id) where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
												and sanc_time > 0 order by 1");?>
			 <select name="teacher" class="inputboxUpdate" onchange="document.myform.submit();">
			 	<option value=""></option>
				<? while($_datT = mysql_fetch_assoc($_resTeacher)){ ?>
						<option value="<?=$_datT['sanc_teacher']?>" <?=isset($_POST['teacher'])&&$_POST['teacher']==$_datT['sanc_teacher']?"selected":""?>><?=$_datT['sanc_teacher']?></option>
				<? } //end while ?>
			 </select>
		  </font>
		  </form>
	  </td>
    </tr>
  </table>
<br/>

<? if($_POST['teacher'] != "") {?>
		<? $_sql = "select a.dis_id,sanc_date,sanc_detail,sanc_time
						from student_sanction a left outer join student_disciplinestatus b
						on (a.dis_id = b.dis_id)
						where acadyear = '" .$acadyear . "' and acadsemester = '" . $acadsemester . "' 
						      and sanc_teacher = '" . $_POST['teacher'] . "' and sanc_time != 0"; ?>
		<? $_resDetail = mysql_query($_sql); ?>
        <div align="center">
		<table class="admintable" align="center">
					<tr>
						<th colspan="5" align="center">
							<img src="../images/school_logo.gif" width="120px">
							<br/>รายงานการกำกับติดตามการดำเนินกิจกรรมปรับเปลี่ยนพฤติกรรมของ <?=$_POST['teacher']?>
							<br/>ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
						</th>
					</tr>
					<tr>
						<td class="key" align="center" width="55">ลำดับที่</td>
						<td class="key" align="center" width="75px">หมายเลขคดี</td>
						<td class="key" align="center" width="400px">รายละเอียดกิจกรรมปรับเปลี่ยนพฤติกรรม</td>
						<td class="key" align="center" width="140px">วัน เดือน ปี</td>
						<td class="key" align="center" width="140px">เวลาที่<br/>นักเรียนทำกิจกรรม</td>
					</tr>
					<? $_z = 1; $_allTime; $_disID = ""; ?>
					<? while($_dat = mysql_fetch_assoc($_resDetail)) { ?>
							<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF" >
								<td align="center"><?=$_z++?></td>
								<td align="center"><?=$_dat['dis_id']==$_disID?"":$_dat['dis_id']?><? $_disID = $_dat['dis_id']; ?></td>
								<td><?=$_dat['sanc_detail']?></td>
								<td align="center"><?=displayDate($_dat['sanc_date'])?></td>
								<td align="center"><?=displayTime($_dat['sanc_time'])?></td>
							</tr>
					<? $_allTime+=$_dat['sanc_time']; ?>
					<? } //end while ?>
					<tr height="35px">
						<td align="center" class="key" colspan="4">รวมเวลาควบคุมพฤติกรรมทั้งหมด</td>
						<td align="center" class="key"><?=displayTime($_allTime)?></td>
					</tr>
			</table>
		  </div>
<? } else { ?>
		<? $_sql = "select sanc_teacher,
						sum(if(sanc_time>0,1,0)) as 'count',
						sum(sanc_time) as 'time'
					from student_sanction a left outer join student_disciplinestatus b
					on (a.dis_id = b.dis_id)
					where sanc_time > 0 and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' 
					group by sanc_teacher order by 3 desc"; ?>
		<? $_res = @mysql_query($_sql); ?>
		<? if(mysql_num_rows($_res) > 0){ ?>
        	  <div align="center">
				<table class="admintable" align="center">
					<tr>
						<th colspan="6" align="center">
							<img src="../images/school_logo.gif" width="120px">
							<br/>รายงานพฤติกรรมไม่พึงประสงค์ตามครูผู้ควบคุมการดำเนินกิจกรรมปรับเปลี่ยนพฤติกรรม
							<br/>ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
						</th>
					</tr>
					<tr>
						<td class="key" align="center" width="70">ลำดับที่</td>
						<td class="key" align="center" width="250px">ครูผู้ควบคุม</td>
						<td class="key" align="center" width="90px">จำนวนคดี<br/>ที่ควบคุม</td>
						<td class="key" align="center" width="140px">เวลารวม</td>
					</tr>
					<? $_i = 1; $_count;$_time; ?>
					<? while($_dat = mysql_fetch_assoc($_res)){ ?>
					<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF" >
						<td align="center"><?=$_i++?></td>
						<td><?=$_dat['sanc_teacher']?></td>
						<td align="right" style="padding-right:20px"><?=$_dat['count']?></td>
						<td align="right" style="padding-right:20px"><?=displayTime($_dat['time'])?></td>
					</tr>
					<? $_count+=$_dat['count']; $_time+=$_dat['time'];?>
					<? } //end while ?>
					<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#F6F6F6" height="35px">
						<td align="center" class="key" colspan="2">รวม</td>
						<td align="right"  class="key" style="padding-right:20px"><?=$_count>0?number_format($_count,0,'',','):"-"?></td>
						<td align="right"  class="key" style="padding-right:20px"><?=displayTime($_time)?></td>
					</tr>
				</table>
             </div>
		<? } else { ?><center><font color="#FF0000"><br/>ไม่พบข้อมูลในภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?></font></center><? } ?>
<? } //end if-else ตรวจสอบค่า $_POST['teacher'] ?>
</div>
<? 
	function displayTime($_value){
		if($_value != "" && $_value > 0){
			$_textTime = "";
			if($_value/60 >= 1){ $_textTime .= (int)($_value/60) ." ชั่วโมง "; }
			if($_value%60 >  0){$_textTime .= (int)($_value%60) . " นาที"; }
			return $_textTime ;
		}else { return "-";}
	}//ปิดฟังก์ชันแสดงเวลา x ชั่วโมง y นาที
	
?>