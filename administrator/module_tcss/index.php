<div id="content">
	<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_tcss/index"><img src="../images/tcss.png" alt="" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">TCSS</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>ระบบบริหารจัดการการประเมินนักเรียน SDQ/EQ/ฯลฯ</strong></font></span></td>
      <td >
	  	<form action="" method="post">
		ปีการศึกษา <?=$acadyear?>
		ภาคเรียนที่ <?=$acadsemester?>
		<br/>
		<font color="#000000" size="2"  >
		เลือกแบบประเมิน </font>
		  	<select name="content" onChange="this.form.submit()" class="inputboxUpdate">
		  		<option value=""></option>
				<option value="sdq" <?=($_POST['content'] == "sdq" || $_REQUEST['content'] == "sdq") ? "selected":""?>>งานประเมิน SDQ</option>
				<option value="eq" <?=isset($_POST['content'])&&$_POST['content'] == "eq" ? "selected":""?>> งานประเมิน EQ</option>
				<option value="stress" <?=isset($_POST['content'])&&$_POST['content'] == "stress" ? "selected":""?>>งานประเมินความเครียด</option>
				<option value="moral" <?=isset($_POST['content'])&&$_POST['content'] == "moral" ? "selected":""?>>งานประเมินภาวะซึมเศร้า</option>
				<option value="game" <?=isset($_POST['content'])&&$_POST['content'] == "game" ? "selected":""?>>งานประเมินการติดเกมส์</option>
			</select>
		 
		  </form>
	  </td>
    </tr>
  </table>
<? if($_REQUEST['content'] == "sdq" || $_POST['content'] == "sdq") { ?>
    <table width="100%" align="center" cellspacing="1" class="admintable">
		<tr> 
			<td class="key" colspan="2">1. แบบประเมินตนเอง (The Strengths and Difficulties Questionaire: SDQ)</td>
		</tr>
		<tr>
			<td width="20px">&nbsp;</td>
			<td><a href="index.php?option=module_tcss/sdq_create">1.1 สร้างงานประเมิน SDQ</a></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td><a href="index.php?option=module_tcss/sdq_student">1.2 บันทึกข้อมูลนักเรียนประเมินตนเอง (นักเรียนเป็นผู้ประเมิน)</a></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td><a href="index.php?option=module_tcss/sdq_parent">1.3 บันทึกข้อมูลผู้ปกครองประเมินนักเรียน (ผู้ปกครองเป็นผู้ประเมิน)</a></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td><a href="index.php?option=module_tcss/sdq_teacher">1.4 บันทึกข้อมูลครูที่ปรึกษาประเมินนักเรียน (ครูเป็นผู้ประเมิน)</a></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td><a href="index.php?option=module_tcss/sdq_xEdit">1.5 แก้ไขบันทึกข้อมูลประเมิน SDQ โดยครูที่ปรึกษาเป็นผู้ประเมิน (กรณีบันทึกผิดพลาด)</a></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td><a href="index.php?option=module_tcss/sdq_xEdit2">1.6 แก้ไขบันทึกข้อมูลประเมิน SDQ โดยนักเรียนหรือผู้ปกครองเป็นผู้ประเมิน (กรณีบันทึกผิดพลาด)</a></td>
		</tr>
		<tr> 
			<td class="key" colspan="2">2. การกำกับติดตามแบบประเมิน</td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td><a href="index.php?option=module_tcss/sdq_studentList">2.1 รายงานติดตามการประเมิน (รายชื่อรายห้อง)</a></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td><a href="index.php?option=module_tcss/sdq_status">2.2 รายงานติดตามการประเมิน (ตัวเลขรายห้อง)</a></td>
		</tr>
		<tr> 
			<td class="key" colspan="2">3. รายงานการคัดกรอง</td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td><a href="index.php?option=module_tcss/sdq_ReportPersonal">3.1 รายงานการคัดกรอกรายห้อง(เปรียบเทียบ 3 แบบประเมิน)</a></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td><a href="index.php?option=module_tcss/sdq_ReportNameRoom">3.2 รายงานการคัดกรองรายห้อง(แปลผลรายด้าน 3 แบบประเมิน)</a></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td><a href="index.php?option=module_tcss/sdq_ReportStatRoom">3.3 รายงานสถิติการคัดกรองรายห้อง</a></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td><a href="index.php?option=module_tcss/sdq_ReportStatLevel">3.4 รายงานการคัดกรองรายระดับชั้น</a></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td><a href="index.php?option=module_tcss/sdq_ReportStatSchool">3.5 รายงานการคัดกรองทั้งโรงเรียน</a></td>
		</tr>		
	</table>
<? } else if($_REQUEST['content'] == "eq" || $_POST['content'] == "eq") { ?>
				   <!-- <table width="100%" align="center" cellspacing="1" class="admintable">
							  <tr><td class="key" colspan="2">1. การประเมินความฉลาดทางอารมณ์ (EQ)</td></tr>
						   </tr>
							<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/eq_create">1.1 สร้างงานประเมิน EQ</a></td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/eq_student">1.2 บันทึกข้อมูลนักเรียนประเมินตนเอง</a></td>
						</tr>
						<tr> 
							<td class="key" colspan="2">2. การกำกับติดตามแบบประเมิน EQ</td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/eq_status">2.1 การประเมินตนเองของนักเรียน</a></td>
						</tr>
						<tr> 
							<td class="key" colspan="2">3. รายงานการคัดกรอง</td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/eq_report">3.1 รายงานการคัดกรอกรายบุคลล</a></td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/eq_report">3.2 รายงานการคัดกรองรายห้อง</a></td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/eq_report">3.3 รายงานการคัดกรองระดับชั้น</a></td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/eq_report">3.4 รายงานการคัดกรองทั้งโรงเรียน</a></td>
						</tr>
					</table>-->
			<center><font color="#FF0000" size="4"><br/><br/>ขออภัย ส่วนงานประเมินความฉลาดทางอารมณ์ (EQ) ยังไม่เปิดให้ใช้บริการ</font></center>
<? } else if($_REQUEST['content'] == "stress" || $_POST['content'] == "stress") { ?>
                  <!--<table width="100%" align="center" cellspacing="1" class="admintable">
							  <tr><td class="key" colspan="2">1. การประเมินความเครียด</td></tr>
						   </tr>
							<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/stress_create">1.1 สร้างงานประเมินความเครียด</a></td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/stress_student">1.2 บันทึกข้อมูลนักเรียนประเมินตนเอง</a></td>
						</tr>
						<tr> 
							<td class="key" colspan="2">2. การกำกับติดตามแบบประเมิน EQ</td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/stress_status">2.1 การประเมินตนเองของนักเรียน</a></td>
						</tr>
						<tr> 
							<td class="key" colspan="2">3. รายงานการคัดกรอง</td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/stress_report">3.1 รายงานการคัดกรอกรายบุคลล</a></td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/stress_report">3.2 รายงานการคัดกรองรายห้อง</a></td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/stress_report">3.3 รายงานการคัดกรองระดับชั้น</a></td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/stress_report">3.4 รายงานการคัดกรองทั้งโรงเรียน</a></td>
						</tr>
					</table>-->
			<center><font color="#FF0000" size="4"><br/><br/>ขออภัย ส่วนงานประเมินภาวะความเครียด ยังไม่เปิดให้ใช้บริการ</font></center>
<? } else if($_REQUEST['content'] == "moral" || $_POST['content'] == "moral") { ?>
			 <!--<table width="100%" align="center" cellspacing="1" class="admintable">
							  <tr><td class="key" colspan="2">1. การประเมินความภาวะซึมเศร้า</td></tr>
						   </tr>
							<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/moral_create">1.1 สร้างงานประเมินภาวะซึมเศร้า</a></td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/moral_student">1.2 บันทึกข้อมูลนักเรียนประเมินตนเอง</a></td>
						</tr>
						<tr> 
							<td class="key" colspan="2">2. การกำกับติดตามแบบประเมิน EQ</td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/moral_status">2.1 การประเมินตนเองของนักเรียน</a></td>
						</tr>
						<tr> 
							<td class="key" colspan="2">3. รายงานการคัดกรอง</td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/moral_report">3.1 รายงานการคัดกรอกรายบุคลล</a></td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/moral_report">3.2 รายงานการคัดกรองรายห้อง</a></td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/moral_report">3.3 รายงานการคัดกรองระดับชั้น</a></td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/moral_report">3.4 รายงานการคัดกรองทั้งโรงเรียน</a></td>
						</tr>
					</table>-->
			<center><font color="#FF0000" size="4"><br/><br/>ขออภัย ส่วนงานประเมินภาวะซึมเศร้า ยังไม่เปิดให้ใช้บริการ</font></center>
<? } else if($_REQUEST['content'] == "game" || $_POST['content'] == "game") { ?>
			 <!--<table width="100%" align="center" cellspacing="1" class="admintable">
							  <tr><td class="key" colspan="2">1. การประเมินการติดเกมส์</td></tr>
						   </tr>
							<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/game_create">1.1 สร้างงานประเมินการติดเกมส์</a></td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/game_student">1.2 บันทึกข้อมูลนักเรียนประเมินตนเอง</a></td>
						</tr>
						<tr> 
							<td class="key" colspan="2">2. การกำกับติดตามแบบประเมิน EQ</td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/game_status">2.1 การประเมินตนเองของนักเรียน</a></td>
						</tr>
						<tr> 
							<td class="key" colspan="2">3. รายงานการคัดกรอง</td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/game_report">3.1 รายงานการคัดกรอกรายบุคลล</a></td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/game_report">3.2 รายงานการคัดกรองรายห้อง</a></td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/game_report">3.3 รายงานการคัดกรองระดับชั้น</a></td>
						</tr>
						<tr>
							<td width="2px">&nbsp;</td>
							<td><a href="index.php?option=module_tcss/game_report">3.4 รายงานการคัดกรองทั้งโรงเรียน</a></td>
						</tr>
					</table>-->
			<center><font color="#FF0000" size="4"><br/><br/>ขออภัย ส่วนงานประเมินการติดเกม ยังไม่เปิดให้ใช้บริการ</font></center>
<? } else { ?>
				<table width="100%" align="center" cellspacing="1" class="admintable">
					<tr><td class="key" colspan="2">ระบบดูแลช่วยเหลือโรงเรียนโป่งนกประชาสามัคคี</td></tr>
					<tr>
							<td width="2px">&nbsp;</td>
							<td> &nbsp; &nbsp; 
								ระบบดูแลช่วยเหลือนักเรียนเป็นกระบวนการดำเนินงานดูแลช่วยเหลือนักเรียนอย่างมีขั้นตอน พร้อมด้วยวิธีการและเครื่องมือทำงานที่ชัดเจน
								โดยมีฝ่ายกิจการนักเรียน หัวหน้าฝ่าย หัวหน้าระดับ และครูที่ปรึกษาเป็นบุคลากรในการดำเนินงานดังกล่าว และมีการประสานความร่วมมือ
								อย่างใกล้ชิด กับผู้ปกครอง ชุมชน บุคคลภายนอกรวมทั้งองค์อื่นที่ให้การสนับสนุน<br/>&nbsp; &nbsp; 
								<font color="#FF0000"><b>"การดูแลช่วยเหลือ"</b></font> หมายถึง การส่งเสริม ป้องกัน และการช่วยเหลือแก้ปัญหา โดย
								มีวิธีการและเครื่องมือสำหรับบุคลากรที่เกี่ยวข้อง เพื่อใช้ในการดำเนินการพัฒนานักเรียนให้เป็นคนดี คนเก่ง ปลอดจากสารเสพติดและมีความสุข
								ในการดำรงชีวิตอยู่ในสังคม
							</td>
					</tr>
					<tr>
						<td class="key" colspan="2">วัตถุประสงค์</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
							<ol>
								<li>เพื่อให้การดำเนินงานระบบดูแลช่วยเหลือนักเรียนของโรงเรียนเป็นไปอย่างมีระบบ มีประสิทธิภาพและประสิทธิผล</li>
								<li>เพื่อให้โรงเรียน ผู้ปกครอง หน่วยงานที่เกี่ยวข้อง หรือชุมชนมีการทำงานร่วมกัน โดยผ่านกระบวนการทำงานที่มีระบบพร้อมด้วยเอกสารหลักฐาน
								การปฏิบัติงานที่สามารถตรวจสอบหรือรับการประเมินได้</li>
							</ol>
						</td>
					</tr>
				</table>
<? } ?>	  
</div>