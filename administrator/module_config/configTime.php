<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_config/index">
			<img src="../images/config.png" alt="" width="48" height="48" />
		</a>
	</td>
      <td><strong><font color="#990000" size="4">ปรับแต่งระบบ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2. การปรับเปลี่ยนภาคเรียนและปีการศึกษาปัจจุบันเป็นค่าเริ่มต้นของระบบ [วิธีการ]</strong></font></span></td>
      <td align="right"> </td>
    </tr>
  </table>

  <table class="admintable" width="100%">
  	<tr>
		<td colspan="2" class="key">
			ขั้นการการตั้งค่าภาคเรียนและปีการศึกษาปัจจุบันเป็นค่าเริ่มต้นของระบบ
		</td>
	</tr>
	<tr>
		<td width="10px"></td>
		<td>
			<ol>
				<li>จากโฟลเดอร์หลักของระบบคือ <font color="#CC0066"><b>bn</b></font> 
					ให้เปิดเข้าไปที่ <font color="#CC0066"><b>pk/include/</b></font> 
					แล้วเปิดไฟล์ <font color="#CC0066"><b>config.inc.php</b></font> ขึ้นมา
				</li>
				<li>เมื่อเปิดไฟล์ <font color="#CC0066"><b>config.inc.php</b></font> ขึ้นมาแล้วให้ทำการแก้ไขค่า ที่อยู่บรรทัดที่ 3-4 คือ <br/>
				  	<code>
						<font color="#CC0066">
						<b>
						&nbsp; $acadyear = 2552;<br />
						&nbsp; $acadsemester = 2;
						</b>
						</font>
					</code><br/><br/>
				</li>
				<li>หากต้องการตั้งค่าเริ่มต้นให้เป็นปีการศึกษา 2553 ให้ทำการเปลี่ยนค่าได้ คือ <font color="#CC0066"><b>$acadyear = 2553;</b></font></li>
				<li>หากต้องการตั้งค่าเริ่มต้นให้เป็นภาคเรียนที่ 1 ให้ทำการเปลี่ยนค่าได้ คือ <font color="#CC0066"><b>$acadsemester = 1;</b></font></li>
				<li>จากนั้นทำการบันทึกแล้วปิดไฟล์นี้ไป ถือว่าเป็นอันเสร็จสิ้น</li>
			</ol>
	  </td>
	</tr>
  </table>
</div>
