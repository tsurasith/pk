<SCRIPT language="Javascript" type="text/javascript">
      function isNumberKey(evt) {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         return true;
      }
	  function checkFormValue() {
	  		if(!document.getElementById('organize1').checked && !document.getElementById('organize2').checked && !document.getElementById('organize3').checked)
				{ alert('กรุณาเลือกหน่วยงานที่กำหนดเกณฑ์ประกันคุณภาพก่อน'); document.getElementById('organize1').focus(); return;}
			if(document.getElementById('standard').value == "")
				{ alert('กรุณาระบุ มาตรฐานของเกณฑ์ประกันคุณภาพก่อน'); document.getElementById('standard').focus(); return;}
			if(document.getElementById('indexof').value == "")
				{ alert('กรุณาระบุ มาตรฐานของเกณฑ์ประกันคุณภาพก่อน'); document.getElementById('indexof').focus(); return;}
			else { document.myform.submit();}
	  }
   </SCRIPT>
<div id="content">
	<link rel="stylesheet" type="text/css" href="module_projects/css/calendar-mos2.css"/>
	<script language="JavaScript" type="text/javascript" src="module_projects/js/calendar.js"></script>
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_projects/index">
			<img src="../images/computer.png" alt="" width="48" height="48" border="0"/>
		</a>
	  </td>
    <td ><strong><font color="#990000" size="4">ระบบสารสนเทศกิจกรรม/โครงการ</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>1.2 บันทึกความสอดคล้องกับมาตรฐานการศึกษา</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_projects/addQA&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_projects/addQA&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_projects/addQA&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_projects/addQA&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<font size="2" color="#000000">
			<form method="post" autocomplete="off">
				<? $_res = mysql_query("select project_id,project_name from project where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' "); ?>
				<select name="p_id" class="inputboxUpdate">
					<option value=""></option>
					<? while($_dat = mysql_fetch_assoc($_res)) { ?>
						<option value="<?=$_dat['project_id']?>" <?=$_POST['p_id']==$_dat['project_id'] || $_REQUEST['p_id']==$_dat['project_id']?"selected":""?>><?=strlen(trim($_dat['project_name']))>90?(substr($_dat['project_name'],0,90) . "..."):$_dat['project_name']?></option>
					<? }//end while ?>
				</select> <input type="submit" class="button" name="search" value="เรียกดู" />
			</form>
		</font>
	  </td>
    </tr>
  </table>
<? if(isset($_POST['search']) && $_POST['p_id']=="") { ?>
		<center><font color="#FF0000"><br/>กรุณาเลือก กิจกรรมโครงการ ที่ต้องการเพิ่ม/แก้ไขข้อมูลก่อน</font></center>
<? } //end if ?>


<?
	if(isset($_POST['save']) && $_POST['standard'] != "" && $_POST['indexof'] != "" && $_POST['organize'] != "") {
		$_sql = "insert into project_qa values (
					'" . $_POST['project_id'] . "',
					'" . $_POST['organize'] ."',
					'" . $_POST['standard'] . "',
					'" . $_POST['indexof'] . "' )";
		$_smsError = "ผิดพลาดเนื่องจาก : ";
		mysql_query($_sql) or die ($_smsError . mysql_error());
	}
?>


<? if((isset($_POST['search']) && $_POST['p_id']!="") || $_REQUEST['p_id'] != ""){ ?>
		<? $_sql = "select * from project where project_id ='" . (isset($_POST['p_id'])?$_POST['p_id']:$_REQUEST['p_id']) ."'"; ?>
		<? $_res = @mysql_query($_sql); ?>
		<? if(@mysql_num_rows($_res)>0) { ?>
				<? $_datProj = mysql_fetch_assoc($_res); ?>
				<table class="admintable" width="100%" align="center">
					<tr>
						<td class="key" colspan="2">รายการบันทึกความสอดคล้องกับมาตรฐานการศึกษา</td>
					</tr>
					<tr>
						<td align="right" width="200px" valign="top" class="key">รหัสกิจกรรม/โครงการ :</td>
						<td>
							<b><font color="#CC0000"><?=$_datProj['project_id']?></font></b>
						</td>
					</tr>
					<tr>
						<td align="right" class="key">ชื่อกิจกรรม/โครงการ :</td>
						<td><b><font color="#CC0000"><?=$_datProj['project_name']?></font></b></td>
					</tr>
					<tr>
						<td align="right" valign="top" class="key">หลักการและเหตุผล :</td>
						<td>
							<?=$_datProj['detail']?>
						</td>
					</tr>
					<tr>
						<td align="right" valign="top" class="key">เป้าหมายเชิงปริมาณ :</td>
						<td>
							<? 
								switch ($_datProj['purpose']) {
									case "1": echo "<img src='../images/apply.png' width='16px' height='16px' /> <b>ผ่านเกณฑ์ที่ตั้งไว้</b>"; break;
									case "0": echo "<img src='../images/delete.png' width='16px' height='16px' /> <b>ไม่ผ่านเกณฑ์ที่ตั้งไว้</b>"; break;
									default: echo "<b>ยังไม่มีการบันทึกข้อมูลส่วนนี้</b>";
								}
							?>
						</td>
					</tr>
					<tr>
						<td align="right" class="key">วันที่เริ่ม :</td>
						<td><?=displayFullDate($_datProj['start_date'])?></td>
					</tr>
					<tr>
						<td align="right" class="key">วันที่สิ้นสุด :</td>
						<td><?=displayFullDate($_datProj['finish_date'])?></td>
					</tr>
					<tr>
						<td align="right" valign="top" class="key">เงินงบประมาณที่ใช้ :</td>
						<td> <b><?=number_format($_datProj['budget_income'],2,'.',',')?> บาท</b> จาก 
							<? 
								switch ($_datProj['budget_type']) {
									case "01": echo "<b>เงินอุดหนุนอื่น</b>"; break;
									case "00": echo "<b>เงินงบประมาณแผ่นดิน</b>"; break;
									default: echo "<b>ยังไม่มีการบันทึกข้อมูลส่วนนี้</b>";
								}
							?>
						</td>
					</tr>
				</table>
					<? if(mysql_num_rows(mysql_query("select * from project_qa where project_id = '" . $_datProj['project_id'] . "'"))>0) { ?>
						<table width="100%" align="center" class="admintable">
							<tr>
								<td class="key" colspan="3">
									ความสอดคล้องกับมาตรฐานคุณภาพการศึกษา
								</td>
							</tr>
							<tr>
								<td colspan="3"><b><font color="#0000CC">สมศ.</font></b></td>
							</tr>
							<? $_std = ""; ?>
							<? $_res = mysql_query("select * from project_qa where project_id = '" . $_datProj['project_id'] . "' and organize = '00' order by standard,indexof"); ?>
							<? while($_dat = mysql_fetch_assoc($_res)) { ?>
								<tr>
									<td width="30px">&nbsp;</td>
									<td width="90px">
										<? if($_dat['standard']!=$_std)
											{
												echo "<font color='#FF0033'><b>" . "มาตรฐานที่ " .$_dat['standard'] . "</b></font>";
												$_std = $_dat['standard'];
											}
										?>
									</td>
									<td>
										ตัวชี้วัดที่ <?=$_dat['indexof']?> 
										<a href="index.php?option=module_projects/deleteQA&project_id=<?=$_datProj['project_id']?>&organize=00&indexof=<?=$_dat['indexof']?>&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>">
										<img src="../images/delete.gif" alt="หากต้องการลบคลิก"/>
										</a>
									</td>
								</tr>
							<? } //end while ?>
							<tr>
								<td colspan="3"><b><font color="#0000CC">สพฐ.</font></b></td>
							</tr>
							<? $_res = mysql_query("select * from project_qa where project_id = '" . $_datProj['project_id'] . "' and organize = '01' order by standard,indexof"); ?>
							<? while($_dat = mysql_fetch_assoc($_res)) { ?>
							<tr>
									<td width="30px">&nbsp;</td>
									<td width="90px">
										<? if($_dat['standard']!=$_std)
											{
												echo "<font color='#FF0033'><b>" . "มาตรฐานที่ " .$_dat['standard'] . "</b></font>";
												$_std = $_dat['standard'];
											}
										?>
									</td>
									<td>
										ตัวชี้วัดที่ <?=$_dat['indexof']?> 
										<a href="index.php?option=module_projects/deleteQA&project_id=<?=$_datProj['project_id']?>&organize=01&indexof=<?=$_dat['indexof']?>&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>">
										<img src="../images/delete.gif" alt="หากต้องการลบคลิก"/>
										</a>
									</td>
								</tr>
							<? } //end while ?>
							<tr>
								<td colspan="3"><b><font color="#0000CC">ท้องถิ่น</font></b></td>
							</tr>
							<? $_res = mysql_query("select * from project_qa where project_id = '" . $_datProj['project_id'] . "' and organize = '02' order by standard,indexof"); ?>
							<? while($_dat = mysql_fetch_assoc($_res)) { ?>
								<tr>
									<td width="30px">&nbsp;</td>
									<td width="90px">
										<? if($_dat['standard']!=$_std)
											{
												echo "<font color='#FF0033'><b>" . "มาตรฐานที่ " .$_dat['standard'] . "</b></font>";
												$_std = $_dat['standard'];
											}
										?>
									</td>
									<td>
										ตัวชี้วัดที่ <?=$_dat['indexof']?> 
										<a href="index.php?option=module_projects/deleteQA&project_id=<?=$_datProj['project_id']?>&organize=02&indexof=<?=$_dat['indexof']?>&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>">
										<img src="../images/delete.gif" alt="หากต้องการลบคลิก"/>
										</a>
									</td>
								</tr>
							<? } //end while ?>
						</table>
					<? } // end if check_มาตรฐานการศึกษา ?>
				<form method="post" autocomplete="off" name="myform">
					<table width="100%" align="center" class="admintable">
						<tr>
							<td class="key" colspan="2">
								<u>เพิ่ม</u>ความสอดคล้องกับมาตรฐานคุณภาพการศึกษา(ของกิจกรรม/โครงการนี้)
								<input type="hidden" name="p_id" value="<?=(isset($_POST['p_id'])?$_POST['p_id']:$_REQUEST['p_id'])?>" />
							</td>
						</tr>
						<tr>
							<td width="200px" class="key" align="right">รหัสกิจกรรม/โครงการ :</td>
							<td>
								<input type="text" name="project_id" class="inputboxUpdate" size="10" value="<?=(isset($_POST['p_id'])?$_POST['p_id']:$_REQUEST['p_id'])?>" readonly />
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" class="key">เลือกเกณฑ์ของหน่วยงาน :</td>
							<td>
								<input type="radio" id="organize1" name="organize" value="00" <?=isset($_POST['organize'])&&$_POST['organize']=="00"?"checked":""?> /> สมศ.<br/>
								<input type="radio" id="organize2" name="organize" value="01" <?=isset($_POST['organize'])&&$_POST['organize']=="01"?"checked":""?> /> สพฐ.<br/>
								<input type="radio" id="organize3" name="organize" value="02" <?=isset($_POST['organize'])&&$_POST['organize']=="02"?"checked":""?> /> ท้องถิ่น
							</td>
						</tr>
						<tr>
							<td class="key" align="right">มาตรฐานที่ :</td>
							<td><input type="text" id="standard" name="standard" class="inputboxUpdate" size="2" maxlength="2" onkeypress="return isNumberKey(event)" /></td>
						</tr>
						<tr>
							<td class="key" align="right">ตัวชี้วัดที่ :</td>
							<td>
								<input type="text" id="indexof" name="indexof" class="inputboxUpdate" size="2" maxlength="2" onkeypress="return isNumberKey(event)" />
								<input type="hidden" name="save" value="save" /><br/>
							</td>
						</tr>
						<tr>
							<td></td><td><input type="button"  onclick="checkFormValue()" value="บันทึก" class="button" /></td>
						</tr>
					</table>
				</form>
				<? } else { echo "<center><font color='red'><br/>ไม่พบข้อมูลกิจกรรมโครงการที่เรียกดูข้อมูล</font></center>";} ?>
<? } //end if search ข้อมูล ?>	


</div>

