<div id="content">
	<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
		<tr> 
		  <td width="6%" align="center"><img src="../images/discipline.png" alt="" width="48" height="48" /></td>
		  <td ><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
			<span class="normal"><font color="#0066FF"><strong>ระบบบริหารจัดการงานวินัยนักเรียน</strong></font></span></td>
		  <td >&nbsp;</td>
		</tr>
	</table>
	
	<table width="100%" align="center" cellspacing="1" class="admintable">
		<tr>
			<td class="key" colspan="2">
				1. ระบบรับแจ้งพฤติกรรม บันทึกการสอบสวนและดำเนินการ
				[<a href="index.php?option=module_discipline/studentList">รายชื่อนักเรียน</b></a>]
				[<a href="index.php?option=module_discipline/disciplineSearch">สืบค้นคดี</b></a>]
			</td>
		</tr>
		<tr>
			<td width="20px">&nbsp;</td>
			<td><a href="index.php?option=module_discipline/disciplineEvent">1.1 บันทึกรับแจ้งพฤติกรรมไม่พึงประสงค์</a></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td>
				<a href="index.php?option=module_discipline/disciplineInvestigate">1.2 บันทึกการสอบสวนพฤติกรรมไม่พึงประสงค์</a>
				<b>[</b><a href="index.php?option=module_discipline/disciplineCopy">ระบบคัดลอกการสอบสวน</a><b>]</b>
			</td>
		</tr>
		<tr><td >&nbsp;</td><td><a href="index.php?option=module_discipline/disciplineSanction">1.3 บันทึกบทลงโทษนักเรียน</a></td></tr>
		<tr><td >&nbsp;</td><td><a href="index.php?option=module_discipline/disciplineActivate">1.4 บันทึกการทำกิจกรรมปรับเปลี่ยนพฤติกรรม</a></td></tr>
		<tr><td >&nbsp;</td><td><a href="index.php?option=module_discipline/disciplineDecision">1.5 บันทึกการดำเนินการหัวหน้าฝ่ายกิจการนักเรียน</a></td></tr>
        <tr><td >&nbsp;</td><td><a href="index.php?option=module_discipline/reportStudentList">1.6 แสดงรายชื่อนักเรียนที่มีคดีตามห้องเรียน</a></td></tr>
   <? if($_SESSION['superAdmin']) { ?>
        <tr><td >&nbsp;</td><td><a href="index.php?option=module_discipline/deductStudentPoint">1.7 ตัดคะแนนความประพฤติ</a></td></tr>
   <? } //end-check_superAdmin ?>
		<tr>
			<td colspan="2" class="key" >2. รายงานผลพฤติกรรมไม่พึงประสงค์ </td>
		</tr>
		<tr><td >&nbsp;</td><td><a href="index.php?option=module_discipline/reportStatusRoom">2.1 รายงานสรุปพฤติกรรมไม่พึงประสงค์ตามสถานะการดำเนินการตามห้องเรียน</a></td></tr>
		<tr><td >&nbsp;</td><td><a href="index.php?option=module_discipline/reportStatusLevel">2.2 รายงานสรุปพฤติกรรมไม่พึงประสงค์ตามสถานะการดำเนินการตามระดับชั้น</a></td></tr>
		<tr><td >&nbsp;</td><td><a href="index.php?option=module_discipline/reportDisTypeRoom">2.3 รายงานสรุปพฤติกรรมไม่พึงประสงค์ตามประเภทพฤติกรรมไม่พึงประสงค์ตามห้องเรียน</a></td></tr>
		<tr><td >&nbsp;</td><td><a href="index.php?option=module_discipline/reportDisTypeLevel">2.4 รายงานสรุปพฤติกรรมไม่พึงประสงค์ตามประเภทพฤติกรรมไม่พึงประสงค์ตามระดับชั้น</a></td></tr>
		<tr><td >&nbsp;</td><td><a href="index.php?option=module_discipline/reportDisLevelRoom">2.5 รายงานสรุปพฤติกรรมไม่พึงประสงค์ตามระดับโทษความผิดตามห้องเรียน</a></td></tr>
		<tr><td >&nbsp;</td><td><a href="index.php?option=module_discipline/reportDisLevelLevel">2.6 รายงานสรุปพฤติกรรมไม่พึงประสงค์ตามระดับโทษความผิดตามระดับชั้น</a></td></tr>
		<tr><td >&nbsp;</td><td><a href="index.php?option=module_discipline/reportTeacherSanction">2.7 รายงานสรุปพฤติกรรมไม่พึงประสงค์ตามครูผู้ควบคุมการดำเนินกิจกรรมปรับเปลี่ยนพฤติกรรม</a></td></tr>
		
		<tr>
			<td colspan="2" class="key">3. แผนภูมิพฤติกรรมไม่พึงประสงค์</td>
		</tr>
		<tr><td>&nbsp;</td><td><a href="index.php?option=module_discipline/xChartStatus">3.1 แผนภูมิแสดงพฤติกรรมไม่พึงประสงค์ตามสถานะการดำเนินการ</b></a></td></tr>
		<tr><td >&nbsp;</td><td><a href="index.php?option=module_discipline/xChartStatusLevel">3.2 แผนภูมิแสดงพฤติกรรมไม่พึงประสงค์ตามสถานะการดำเนินการตามระดับชั้น</a></td></tr>
		<tr><td >&nbsp;</td><td><a href="index.php?option=module_discipline/xChartDistypeLevel">3.3 แผนภูมิสรุปพฤติกรรมไม่พึงประสงค์ตามประเภทพฤติกรรมไม่พึงประสงค์ตามระดับชั้น</a></td></tr>
		<tr><td >&nbsp;</td><td><a href="index.php?option=module_discipline/xChartDisLevelLevel">3.4 แผนภูมิสรุปพฤติกรรมไม่พึงประสงค์ตามระดับโทษความผิดตามระดับชั้น</a></td></tr>
		
	<? if($_SESSION['superAdmin']) { ?>
		<tr>
			<td class="key" colspan="2">
				4. ระบบคัดกรองยาเสพติด 
				[<a href="index.php?option=module_discipline/Drug_createTask">สร้างงานคัดกรอง</a>]
				[<a href="index.php?option=module_discipline/Drug_tasklist">บันทึกงานคัดกรอง</a>]
				[<a href="index.php?option=module_discipline/editStudentDrugCheck">แก้ไขการคัดกรอง</a>]
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><a href="index.php?option=module_discipline/Drug_reportNumber">4.1 รายงานคัดกรองยาเสพติด(ตัวเลข)</a></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><a href="index.php?option=module_discipline/Drug_reportName">4.2 รายงานคัดกรองยาเสพติด(รายชื่อ)</a></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><a href="index.php?option=module_discipline/Drug_reportNameRoom">4.3 รายงานคัดกรองยาเสพติด(รายชื่อตามห้องเรียน)</a></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><a href="index.php?option=module_discipline/Drug_chartSex">4.4 แผนภูมิรายงานการคัดกรองยาเสพติด (แยกตามเพศ)</a></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><a href="index.php?option=module_discipline/Drug_chartLevel">4.5 แผนภูมิรายงานการคัดกรองยาเสพติด (แยกตามระดับชั้น)</a></td>
		</tr>
	<? } //end-check_superAdmin ?>
	</table>
				  
</div>