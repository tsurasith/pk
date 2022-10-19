
<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_tcss/index&content=sdq"><img src="../images/tcss.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">TCSS</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>รายงานฉบับเต็มผลการประเมิน SDQ</strong></font></span></td>
      <td >
		<input type="button" value="กลับหน้ารายชื่อทั้งห้องเรียน" onclick="history.go(-1)" />
	   </td>
    </tr>
  </table>
  </form>
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
<br/>
<? $_dat = mysql_fetch_assoc(mysql_query("select id,prefix,firstname,lastname,xlevel,xyearth,room,studstatus,a_name from students where id = '" . $_REQUEST['student_id'] . "' and xedbe = '" . $acadyear . "'")); ?>
<? $_s = mysql_fetch_assoc(mysql_query("select * from sdq_student where student_id = '" . $_REQUEST['student_id'] . "' and acadyear = '" . $acadyear . "' and semester = '" . $acadsemester . "'")); ?>
<? $_p = mysql_fetch_assoc(mysql_query("select * from sdq_parent where student_id = '" . $_REQUEST['student_id'] . "' and acadyear = '" . $acadyear . "' and semester = '" . $acadsemester . "'")); ?>
<? $_t = mysql_fetch_assoc(mysql_query("select * from sdq_teacher where student_id = '" . $_REQUEST['student_id'] . "' and acadyear = '" . $acadyear . "' and semester = '" . $acadsemester . "'")); ?>
<? $_all = mysql_fetch_assoc(mysql_query("select student_id,
			  sum(if(questioner='student',a.all,0)) as s,
			  sum(if(questioner='parent',a.all,0)) as p,
			  sum(if(questioner='teacher',a.all,0)) as t from sdq_result a
			where student_id = '" . $_REQUEST['student_id'] . "'
			and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' group by a.student_id"));?>
  <table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
    <tr>
		<td colspan="3" class="key">สรุปผลการประเมิน SDQ ทั้งหมดของนักเรียน</td>
	</tr>
	<tr>
		<td rowspan="7" width="150px" align="center">
			<img src="../images/studPhoto/id<?=$_REQUEST['student_id']?>.jpg" alt="รูปของนักเรียน" width="150px" style="border:#000000 groove 4px" />
		</td>
		<td align="right" width="200px">ภาคเรียน/ปีการศึกษา :</td>
		<td><?=displayText($acadsemester.'/'.$acadyear)?></td>
	</tr>
	<tr>
		<td align="right" >เลขประจำตัว :</td>
		<td><?=displayText($_dat['id'])?></td>
	</tr>
	<tr>
		<td align="right" >ชื่อ-สกุล :</td>
		<td><?=displayText($_dat['prefix'] . $_dat['firstname'] . ' ' . $_dat['lastname'])?></td>
	</tr>
	<tr>
		<td align="right" >ห้อง :</td>
		<td><?=displayText("ชั้นมัธยมศึกษาปีที่ " . ($_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3).'/'.$_dat['room'])?></td>
	</tr>
	<tr>
		<td align="right" >สถานภาพ :</td>
		<td><?=displayStudentStatusColor($_dat['studstatus'])?></td>
	</tr>
	<tr>
		<td align="right" >ชื่อ-สกุลผู้ปกครอง :</td>
		<td><?=displayText($_dat['a_name'])?></td>
	</tr>
	<tr>
		<td align="right" valign="top">วันที่ทำการประเมิน :</td>
		<td>
			<?=$_s['status']==0?noSurvey():displayText(displayFullDate($_s['finish_date']))?> || ฉบับนักเรียนประเมิน <br/>
			<?=$_p['status']==0?noSurvey():displayText(displayFullDate($_p['finish_date']))?> || ฉบับผู้ปกครองประเมิน <br/>
			<?=$_t['status']==0?noSurvey():displayText(displayFullDate($_t['finish_date']))?> || ฉบับครูที่ปรึกษาประเมิน <br/>
		</td>
	</tr>
</table>
<table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
	<tr>
		<td class="key" colspan="5">สรุปการแปลผลรายด้าน : ด้านที่ 1 "ด้านอารมณ์"</td>
	</tr>
	<tr>
		<td class="key" align="center" width="50px" rowspan="2">ข้อ</td>
		<td class="key" align="center" rowspan="2">รายการประเมิน/หัวข้อคำถาม</td>
		<td class="key" align="center" colspan="3">ผู้ประเมิน</td>
	</tr>
	<tr>
		<td class="key" align="center" width="90px">นักเรียน</td>
		<td class="key" align="center" width="90px">ผู้ปกครอง</td>
		<td class="key" align="center" width="90px">ครูที่ปรึกษา</td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">3</td>
		<td>มักจะบ่นว่าปวดศรีษะ ปวดท้อง หรือไม่สบายบ่อยๆ</td>
		<td align="center"><?=displaySurvey($_s['c03'])?></td>
		<td align="center"><?=displaySurvey($_p['c03'])?></td>
		<td align="center"><?=displaySurvey($_t['c03'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">8</td>
		<td>กังวลใจหลายเรื่อง ดูกังวลเสมอ</td>
		<td align="center"><?=displaySurvey($_s['c08'])?></td>
		<td align="center"><?=displaySurvey($_p['c08'])?></td>
		<td align="center"><?=displaySurvey($_t['c08'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">13</td>
		<td>ดูไม่มีความสุข ท้อแท้</td>
		<td align="center"><?=displaySurvey($_s['c13'])?></td>
		<td align="center"><?=displaySurvey($_p['c13'])?></td>
		<td align="center"><?=displaySurvey($_t['c13'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">16</td>
		<td>เครียด ไม่ยอมห่างในสถานการณ์ที่ไม่คุ้น และขาดความเชื่อมันในตนเอง</td>
		<td align="center"><?=displaySurvey($_s['c16'])?></td>
		<td align="center"><?=displaySurvey($_p['c16'])?></td>
		<td align="center"><?=displaySurvey($_t['c16'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">24</td>
		<td>ขี้กลัว รู้สึกหวาดกลัวได้ง่าย</td>
		<td align="center"><?=displaySurvey($_s['c24'])?></td>
		<td align="center"><?=displaySurvey($_p['c24'])?></td>
		<td align="center"><?=displaySurvey($_t['c24'])?></td>
	</tr>
	<tr>
		<td></td>
		<td align="center" class="key">สรุปและแปลผลด้านที่ 1</td>
		<td align="center" class="key"><?=$_s['c03']+$_s['c08']+$_s['c13']+$_s['c16']+$_s['c24']?></td>
		<td align="center" class="key"><?=$_p['c03']+$_p['c08']+$_p['c13']+$_p['c16']+$_p['c24']?></td>
		<td align="center" class="key"><?=$_t['c03']+$_t['c08']+$_t['c13']+$_t['c16']+$_t['c24']?></td>
	</tr>
</table><br/>
<table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
	<tr>
		<td class="key" colspan="5">สรุปการแปลผลรายด้าน : ด้านที่ 2 "ด้านความประพฤติ/เกเร"</td>
	</tr>
	<tr>
		<td class="key" align="center" width="50px" rowspan="2">ข้อ</td>
		<td class="key" align="center" rowspan="2">รายการประเมิน/หัวข้อคำถาม</td>
		<td class="key" align="center" colspan="3">ผู้ประเมิน</td>
	</tr>
	<tr>
		<td class="key" align="center" width="90px">นักเรียน</td>
		<td class="key" align="center" width="90px">ผู้ปกครอง</td>
		<td class="key" align="center" width="90px">ครูที่ปรึกษา</td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">5</td>
		<td>มักจะอาละวาด หรือโมโหร้าย</td>
		<td align="center"><?=displaySurvey($_s['c05'])?></td>
		<td align="center"><?=displaySurvey($_p['c05'])?></td>
		<td align="center"><?=displaySurvey($_t['c05'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">7</td>
		<td>เชื่อฟัง มักจะทำตามที่ผู้ใหญ่ต้องการ</td>
		<td align="center"><?=displaySurveyReverse($_s['c07'])?></td>
		<td align="center"><?=displaySurveyReverse($_p['c07'])?></td>
		<td align="center"><?=displaySurveyReverse($_t['c07'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">12</td>
		<td>มักจะมีเรื่องทะเลาะวิวาทกับเด็กอื่น หรือรังแกเด็กอื่น</td>
		<td align="center"><?=displaySurvey($_s['c12'])?></td>
		<td align="center"><?=displaySurvey($_p['c12'])?></td>
		<td align="center"><?=displaySurvey($_t['c12'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">18</td>
		<td>ชอบโกหก หรือขี้โกง</td>
		<td align="center"><?=displaySurvey($_s['c18'])?></td>
		<td align="center"><?=displaySurvey($_p['c18'])?></td>
		<td align="center"><?=displaySurvey($_t['c18'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">22</td>
		<td>ขโมยของของที่บ้าน ที่โรงเรียน หรือที่อื่น</td>
		<td align="center"><?=displaySurvey($_s['c22'])?></td>
		<td align="center"><?=displaySurvey($_p['c22'])?></td>
		<td align="center"><?=displaySurvey($_t['c22'])?></td>
	</tr>
	<tr>
		<td></td>
		<td align="center" class="key">สรุปและแปลผลด้านที่ 2</td>
		<td align="center" class="key"><?=$_s['c05']+$_s['c07']+$_s['c12']+$_s['c18']+$_s['c22']?></td>
		<td align="center" class="key"><?=$_p['c05']+$_p['c07']+$_p['c12']+$_p['c18']+$_p['c22']?></td>
		<td align="center" class="key"><?=$_t['c05']+$_t['c07']+$_t['c12']+$_t['c18']+$_t['c22']?></td>
	</tr>
</table><br/>
<table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
	<tr>
		<td class="key" colspan="5">สรุปการแปลผลรายด้าน : ด้านที่ 3 "ด้านพฤติกรรมอยู่ไม่นิ่ง/สมาธิสั้น"</td>
	</tr>
	<tr>
		<td class="key" align="center" width="50px" rowspan="2">ข้อ</td>
		<td class="key" align="center" rowspan="2">รายการประเมิน/หัวข้อคำถาม</td>
		<td class="key" align="center" colspan="3">ผู้ประเมิน</td>
	</tr>
	<tr>
		<td class="key" align="center" width="90px">นักเรียน</td>
		<td class="key" align="center" width="90px">ผู้ปกครอง</td>
		<td class="key" align="center" width="90px">ครูที่ปรึกษา</td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">2</td>
		<td>อยู่ไม่นิ่ง นั่งนิ่งๆ ไม่ได้</td>
		<td align="center"><?=displaySurvey($_s['c02'])?></td>
		<td align="center"><?=displaySurvey($_p['c02'])?></td>
		<td align="center"><?=displaySurvey($_t['c02'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">10</td>
		<td>อยู่ไม่สุข วุ่นวายอย่างมาก</td>
		<td align="center"><?=displaySurvey($_s['c10'])?></td>
		<td align="center"><?=displaySurvey($_p['c10'])?></td>
		<td align="center"><?=displaySurvey($_t['c10'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">15</td>
		<td>วอกแวกง่าย สมาธิสั้น</td>
		<td align="center"><?=displaySurvey($_s['c15'])?></td>
		<td align="center"><?=displaySurvey($_p['c15'])?></td>
		<td align="center"><?=displaySurvey($_t['c15'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">21</td>
		<td>คิดก่อนทำ</td>
		<td align="center"><?=displaySurveyReverse($_s['c21'])?></td>
		<td align="center"><?=displaySurveyReverse($_p['c21'])?></td>
		<td align="center"><?=displaySurveyReverse($_t['c21'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">25</td>
		<td>ทำงานได้จนเสร็จ มีความตั้งใจในการทำงาน</td>
		<td align="center"><?=displaySurveyReverse($_s['c25'])?></td>
		<td align="center"><?=displaySurveyReverse($_p['c25'])?></td>
		<td align="center"><?=displaySurveyReverse($_t['c25'])?></td>
	</tr>
	<tr>
		<td></td>
		<td align="center" class="key">สรุปและแปลผลด้านที่ 3</td>
		<td align="center" class="key"><?=$_s['c02']+$_s['c10']+$_s['c15']+$_s['c21']+$_s['c25']?></td>
		<td align="center" class="key"><?=$_p['c02']+$_p['c10']+$_p['c15']+$_p['c21']+$_p['c25']?></td>
		<td align="center" class="key"><?=$_t['c02']+$_t['c10']+$_t['c15']+$_t['c21']+$_t['c25']?></td>
	</tr>
</table><br/>
<table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
	<tr>
		<td class="key" colspan="5">สรุปการแปลผลรายด้าน : ด้านที่ 4 "ด้านความสัมพันธ์กับเพื่อน"</td>
	</tr>
	<tr>
		<td class="key" align="center" width="50px" rowspan="2">ข้อ</td>
		<td class="key" align="center" rowspan="2">รายการประเมิน/หัวข้อคำถาม</td>
		<td class="key" align="center" colspan="3">ผู้ประเมิน</td>
	</tr>
	<tr>
		<td class="key" align="center" width="90px">นักเรียน</td>
		<td class="key" align="center" width="90px">ผู้ปกครอง</td>
		<td class="key" align="center" width="90px">ครูที่ปรึกษา</td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">6</td>
		<td>ค่อนข้างแยกตัว ชอบเล่นคนเดียว</td>
		<td align="center"><?=displaySurvey($_s['c06'])?></td>
		<td align="center"><?=displaySurvey($_p['c06'])?></td>
		<td align="center"><?=displaySurvey($_t['c06'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">11</td>
		<td>มีเพื่อนสนิท</td>
		<td align="center"><?=displaySurveyReverse($_s['c11'])?></td>
		<td align="center"><?=displaySurveyReverse($_p['c11'])?></td>
		<td align="center"><?=displaySurveyReverse($_t['c11'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">14</td>
		<td>เป็นที่ชื่นชอบของเพื่อน</td>
		<td align="center"><?=displaySurveyReverse($_s['c14'])?></td>
		<td align="center"><?=displaySurveyReverse($_p['c14'])?></td>
		<td align="center"><?=displaySurveyReverse($_t['c14'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">19</td>
		<td>ถูกเด็กคนอื่นล้อเล่น หรือรังแก</td>
		<td align="center"><?=displaySurvey($_s['c19'])?></td>
		<td align="center"><?=displaySurvey($_p['c19'])?></td>
		<td align="center"><?=displaySurvey($_t['c19'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">23</td>
		<td>เข้ากับผู้ใหญ่ได้ดีกว่าเด็กในวัยเดียวกัน</td>
		<td align="center"><?=displaySurvey($_s['c23'])?></td>
		<td align="center"><?=displaySurvey($_p['c23'])?></td>
		<td align="center"><?=displaySurvey($_t['c23'])?></td>
	</tr>
	<tr>
		<td></td>
		<td align="center" class="key">สรุปและแปลผลด้านที่ 4</td>
		<td align="center" class="key"><?=$_s['c06']+$_s['c11']+$_s['c14']+$_s['c19']+$_s['c23']?></td>
		<td align="center" class="key"><?=$_p['c06']+$_p['c11']+$_p['c14']+$_p['c19']+$_p['c23']?></td>
		<td align="center" class="key"><?=$_t['c06']+$_t['c11']+$_t['c14']+$_t['c19']+$_t['c23']?></td>
	</tr>
</table><br/>
<table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
	<tr>
		<td class="key" colspan="5">สรุปการแปลผลรายด้าน : ด้านที่ 5 "ด้านสัมพันธภาพทางสังคม"</td>
	</tr>
	<tr>
		<td class="key" align="center" width="50px" rowspan="2">ข้อ</td>
		<td class="key" align="center" rowspan="2">รายการประเมิน/หัวข้อคำถาม</td>
		<td class="key" align="center" colspan="3">ผู้ประเมิน</td>
	</tr>
	<tr>
		<td class="key" align="center" width="90px">นักเรียน</td>
		<td class="key" align="center" width="90px">ผู้ปกครอง</td>
		<td class="key" align="center" width="90px">ครูที่ปรึกษา</td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">1</td>
		<td>ห่วงในความรู้สึกคนอื่น</td>
		<td align="center"><?=displaySurvey($_s['c01'])?></td>
		<td align="center"><?=displaySurvey($_p['c01'])?></td>
		<td align="center"><?=displaySurvey($_t['c01'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">4</td>
		<td>เต็มใจแบ่งปันสิ่งของให้เพื่อน เช่น ขนม ของเล่น ดินสอ เป็นต้น</td>
		<td align="center"><?=displaySurvey($_s['c04'])?></td>
		<td align="center"><?=displaySurvey($_p['c04'])?></td>
		<td align="center"><?=displaySurvey($_t['c04'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">9</td>
		<td>เป็นที่พึ่งได้เวลาที่คนอื่นเสียใจ อารมณ์ไม่ดี หรือไม่สบายใจ</td>
		<td align="center"><?=displaySurvey($_s['c09'])?></td>
		<td align="center"><?=displaySurvey($_p['c09'])?></td>
		<td align="center"><?=displaySurvey($_t['c09'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">17</td>
		<td>ใจดีกับเด็กที่เล็กกว่า</td>
		<td align="center"><?=displaySurvey($_s['c17'])?></td>
		<td align="center"><?=displaySurvey($_p['c17'])?></td>
		<td align="center"><?=displaySurvey($_t['c17'])?></td>
	</tr>
	<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
		<td align="center">20</td>
		<td>ชอบอาสาช่วยเหลือผู้อื่น เช่น พ่อแม่ ครู เพื่อน หรือคนอื่นๆ</td>
		<td align="center"><?=displaySurvey($_s['c20'])?></td>
		<td align="center"><?=displaySurvey($_p['c20'])?></td>
		<td align="center"><?=displaySurvey($_t['c20'])?></td>
	</tr>
	<tr>
		<td></td>
		<td align="center" class="key">สรุปและแปลผลด้านที่ 5</td>
		<td align="center" class="key"><?=$_s['c01']+$_s['c04']+$_s['c09']+$_s['c17']+$_s['c20']?></td>
		<td align="center" class="key"><?=$_p['c01']+$_p['c04']+$_p['c09']+$_p['c17']+$_p['c20']?></td>
		<td align="center" class="key"><?=$_t['c01']+$_t['c04']+$_t['c09']+$_t['c17']+$_t['c20']?></td>
	</tr>
</table><br/>
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
<br/><br/>
</div>

