
<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_tcss/index&content=sdq"><img src="../images/tcss.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">TCSS</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.1 ผลการประเมินจากแบบประเมิน SDQ</strong></font></span></td>
      <td >
	  	<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_tcss/sdq_ReportPersonalFull&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_tcss/sdq_ReportPersonalFull&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		 ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_tcss/sdq_ReportPersonalFull&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_tcss/sdq_ReportPersonalFull&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					} ?> <br/>
	  </td>
    </tr>
  </table>
  </form>
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
<br/>
<? $_resS = mysql_query("select id,prefix,firstname,lastname,xlevel,xyearth,room,studstatus,a_name from students where id = '" . $_SESSION['username'] . "' and xedbe = '" . $acadyear . "'"); ?>
<? if(mysql_num_rows($_resS)>0) { ?>
<? $_dat = mysql_fetch_assoc($_resS); ?>
<? $_s = mysql_fetch_assoc(mysql_query("select * from sdq_student where student_id = '" . $_SESSION['username'] . "' and acadyear = '" . $acadyear . "' and semester = '" . $acadsemester . "'")); ?>
<? $_p = mysql_fetch_assoc(mysql_query("select * from sdq_parent where student_id = '" . $_SESSION['username'] . "' and acadyear = '" . $acadyear . "' and semester = '" . $acadsemester . "'")); ?>
<? $_t = mysql_fetch_assoc(mysql_query("select * from sdq_teacher where student_id = '" . $_SESSION['username'] . "' and acadyear = '" . $acadyear . "' and semester = '" . $acadsemester . "'")); ?>
<? $_all = mysql_fetch_assoc(mysql_query("select student_id,
			  sum(if(questioner='student',a.all,0)) as s,
			  sum(if(questioner='parent',a.all,0)) as p,
			  sum(if(questioner='teacher',a.all,0)) as t from sdq_result a
			where student_id = '" . $_SESSION['username'] . "'
			and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' group by a.student_id"));?>
  <table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
    <tr>
		<td colspan="3" class="key">สรุปผลการประเมิน SDQ ทั้งหมดของนักเรียน</td>
	</tr>
	<tr>
		<td rowspan="7" width="150px" align="center">
			<img src="../images/studPhoto/id<?=$_SESSION['username']?>.jpg" alt="รูปของนักเรียน" width="150px" style="border:#000000 groove 4px" />
		</td>
		<td align="right" width="200px">ภาคเรียน/ปีการศึกษา :</td>
		<td><?=display($acadsemester.'/'.$acadyear)?></td>
	</tr>
	<tr>
		<td align="right" >เลขประจำตัว :</td>
		<td><?=display($_dat['id'])?></td>
	</tr>
	<tr>
		<td align="right" >ชื่อ-สกุล :</td>
		<td><?=display($_dat['prefix'] . $_dat['firstname'] . ' ' . $_dat['lastname'])?></td>
	</tr>
	<tr>
		<td align="right" >ห้อง :</td>
		<td><?=display("ชั้นมัธยมศึกษาปีที่ " . ($_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3).'/'.$_dat['room'])?></td>
	</tr>
	<tr>
		<td align="right" >สถานภาพ :</td>
		<td><?=displayStudentStatusColor($_dat['studstatus'])?></td>
	</tr>
	<tr>
		<td align="right" >ชื่อ-สกุลผู้ปกครอง :</td>
		<td><?=display($_dat['a_name'])?></td>
	</tr>
	<tr>
		<td align="right" valign="top">วันที่ทำการประเมิน :</td>
		<td>
			<?=$_s['status']==0?noSurvey():display(displayDate($_s['finish_date']))?> || ฉบับนักเรียนประเมิน <br/>
			<?=$_p['status']==0?noSurvey():display(displayDate($_p['finish_date']))?> || ฉบับผู้ปกครองประเมิน <br/>
			<?=$_t['status']==0?noSurvey():display(displayDate($_t['finish_date']))?> || ฉบับครูที่ปรึกษาประเมิน <br/>
		</td>
	</tr>
</table>
  <br/>
<table class="admintable" cellpadding="1" cellspacing="1" border="0" align="center">
	<tr>
		<td class="key" colspan="5">สรุปการแปลผลรวมทุกด้าน</td>
	</tr>
	<tr>
		<td class="key" align="center" width="50px" rowspan="2">ด้าน</td>
		<td class="key" align="center" rowspan="2">รายละเอียด</td>
		<td class="key" align="center" colspan="3">สรุปผลผู้ประเมิน</td>
	</tr>
	<tr>
		<td class="key" align="center" width="90px">นักเรียน</td>
		<td class="key" align="center" width="90px">ผู้ปกครอง</td>
		<td class="key" align="center" width="90px">ครูที่ปรึกษา</td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">1</td>
		<td >ด้านอารมณ์</td>
		<td align="center" ><?=$_s['status']==0?noSurvey():displayType1($_s['c03']+$_s['c08']+$_s['c13']+$_s['c16']+$_s['c24'],"student")?></td>
		<td align="center" ><?=$_p['status']==0?noSurvey():displayType1($_p['c03']+$_p['c08']+$_p['c13']+$_p['c16']+$_p['c24'],"parent")?></td>
		<td align="center" ><?=$_t['status']==0?noSurvey():displayType1($_t['c03']+$_t['c08']+$_t['c13']+$_t['c16']+$_t['c24'],"teacher")?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">2</td>
		<td >ด้านความประพฤติ/เกเร</td>
		<td align="center" ><?=$_s['status']==0?noSurvey():displayType2($_s['c05']+$_s['c07']+$_s['c12']+$_s['c18']+$_s['c22'],"student")?></td>
		<td align="center" ><?=$_p['status']==0?noSurvey():displayType2($_p['c05']+$_p['c07']+$_p['c12']+$_p['c18']+$_p['c22'],"parent")?></td>
		<td align="center" ><?=$_t['status']==0?noSurvey():displayType2($_t['c05']+$_t['c07']+$_t['c12']+$_t['c18']+$_t['c22'],"teacher")?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">3</td>
		<td >ด้านพฤติกรรมอยู่ไม่นิ่ง/สมาธิสั้น</td>
		<td align="center" ><?=$_s['status']==0?noSurvey():displayType3($_s['c02']+$_s['c10']+$_s['c15']+$_s['c21']+$_s['c25'],"student")?></td>
		<td align="center" ><?=$_p['status']==0?noSurvey():displayType3($_p['c02']+$_p['c10']+$_p['c15']+$_p['c21']+$_p['c25'],"parent")?></td>
		<td align="center" ><?=$_t['status']==0?noSurvey():displayType3($_t['c02']+$_t['c10']+$_t['c15']+$_t['c21']+$_t['c25'],"teacher")?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">4</td>
		<td >ด้านความสัมพันธ์กับเพื่อน</td>
		<td align="center" ><?=$_s['status']==0?noSurvey():displayType4($_s['c06']+$_s['c11']+$_s['c14']+$_s['c19']+$_s['c23'],"student")?></td>
		<td align="center" ><?=$_p['status']==0?noSurvey():displayType4($_p['c06']+$_p['c11']+$_p['c14']+$_p['c19']+$_p['c23'],"parent")?></td>
		<td align="center" ><?=$_t['status']==0?noSurvey():displayType4($_t['c06']+$_t['c11']+$_t['c14']+$_t['c19']+$_t['c23'],"teacher")?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">5</td>
		<td >ด้านสัมพันธภาพทางสังคม</td>
		<td align="center" ><?=$_s['status']==0?noSurvey():displayType5($_s['c01']+$_s['c04']+$_s['c09']+$_s['c17']+$_s['c20'],"student")?></td>
		<td align="center" ><?=$_p['status']==0?noSurvey():displayType5($_p['c01']+$_p['c04']+$_p['c09']+$_p['c17']+$_p['c20'],"parent")?></td>
		<td align="center" ><?=$_t['status']==0?noSurvey():displayType5($_t['c01']+$_t['c04']+$_t['c09']+$_t['c17']+$_t['c20'],"teacher")?></td>
	</tr>
	<tr>
		<td></td>
		<td align="center" class="key">สรุปผลรวม</td>
		<td align="center" class="key"><?=displayAll($_all['s'],"student")?></td>
		<td align="center" class="key"><?=displayAll($_all['p'],"parent")?></td>
		<td align="center" class="key"><?=displayAll($_all['t'],"teacher")?></td>
	</tr>
</table>
<? } else { ?> <br/><center><font color="#FF0000">ยังไม่มีข้อมูลในภาคเรียนนี้</font></center><? } ?>
<br/><br/>
</div>

