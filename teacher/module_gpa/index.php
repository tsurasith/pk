<div id="content">
				 <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><img src="../images/gpa.png" alt="" width="48" height="48" /></td>
      <td width="64%"><strong><font color="#990000" size="4">Learning Achievement</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>ระบบติดตาม ตรวจสอบผลสัมฤทธิ์ทางการเรียน</strong></font></span></td>
      <td >&nbsp;</td>
    </tr>
  </table>
    <table width="100%" align="center" cellspacing="1" class="admintable">
	  <tr> 
		<td class="key" colspan="2">1. รายงานผลสัมฤทธิ์ทางการเรียน</td></tr>
		<tr>
            <td width="20px">&nbsp;</td>
            <td><a href="index.php?option=module_gpa/studentList">1.1 ผลสัมฤทธิ์นักเรียนตามห้องเรียน (1 ภาคเรียน)</a></td>
		</tr>
        <tr>
            <td width="20px">&nbsp;</td>
            <td><a href="index.php?option=module_gpa/studentListGradeAll">1.2 ผลสัมฤทธิ์นักเรียนตามห้องเรียน (ทุกภาคเรียน)</a></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><a href="index.php?option=module_gpa/studentListFailsLevel">1.3 ผลสัมฤทธิ์ไม่พึงประสงค์ตามระดับชั้น</a></td>
		</tr>
        <tr>
			<td>&nbsp;</td>
			<td><a href="index.php?option=module_gpa/studentListRegradeLevel">1.4 รายชื่อนักเรียนที่ส่งผลสอบแก้ไขผลการเรียนแล้ว</a></td>
		</tr>
	   <tr>
		<td class="key" colspan="2">2. แผนภูมิ </td>
	   </tr>
		<tr><td>&nbsp;</td>
			<td><a href="#">2.1 ค่าเฉลี่ยของห้องเรียนตามรายวิชา</a></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><a href="#">2.2 ภาพรวมผลสัมฤทธิ์ทั้งโรงเรียน</a></td> </tr>
       <!-- <tr>
			<td>&nbsp;</td>
			<td><a href="http://122.154.151.154/download/grades.xls" target="_blank">2.3 ดาวน์โหลดผลการเรียนสำหรับสร้างรายงาน Pivot Table</a></td> </tr> -->
            
       <? if(in_array($_SESSION['username'],$_config['grade'])) { ?>
       <tr>
			<td class="key" colspan="2">3. งานทะเบียนวัดผล </td>
	   </tr>
		<tr>
        	<td>&nbsp;</td>
			<td><a href="index.php?option=module_gpa/gradeEdit">3.1 แก้ไขผลการเรียนนักเรียน</a></td>
        </tr>    
        <? } ?>
	</table>
				  
</div>