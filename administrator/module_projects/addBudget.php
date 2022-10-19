<SCRIPT language="Javascript" type="text/javascript">
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
	  function calculate()
	  {
	  	if(!document.getElementById('budget_type1').checked && !document.getElementById('budget_type2').checked)
			{ alert('กรุณาเลือกแหล่งที่มาของงบประมาณก่อน'); document.getElementById('budget_type1').focus(); return; }
		if(document.getElementById('budget_detail').value == "")
			{ alert('กรุณาป้อนรายละเอียดการใช้งบประมาณก่อน'); document.getElementById('budget_detail').focus(); return; }
		if(document.getElementById('amount').value == "")
			{ alert('กรุณาป้อน ราคาต่อหน่วยก่อน'); document.getElementById('amount').focus(); return; }
		if(document.getElementById('prize_per_unit').value == "")
			{ alert('กรุณาป้อนจำนวนหน่วยที่จัดซื้อ/จัดหาก่อน'); document.getElementById('prize_per_unit').focus(); return; }
		
		var x = document.getElementById("prize_per_unit").value;
		var y = document.getElementById("amount").value;
		
		if(isNaN(x))
		{
			document.form.money.value = 'Error!';
		}
		else 
		{
			document.form.money.value = x*y;
			document.form.money.disabled = false;
			document.form.save.disabled = false;
		}
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
	<span class="normal"><font color="#0066FF"><strong>1.3 บันทึกการใช้งบประมาณ</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_projects/addBudget&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo "<a href=\"index.php?option=module_projects/addBudget&acadyear=" . ($acadyear + 1) . "\"> <img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_projects/addBudget&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_projects/addBudget&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
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

<? if(isset($_POST['search']) && ($_POST['p_id']=="" || $_REQUEST['p_id']=="")) { ?>
		<center><br/><font color="#FF0000">กรุณาเลือก กิจกรรมโครงการ ที่ต้องการเพิ่ม/แก้ไขข้อมูลก่อน</font></center>
<? }//end_if ?>

<?
	$_sql = "select * from project where project_id ='" . (isset($_POST['p_id'])?$_POST['p_id']:$_REQUEST['p_id']) ."'";
	$_res = @mysql_query($_sql);
	if(@mysql_num_rows($_res)>0) {
		$_datProj = mysql_fetch_assoc($_res);
?>
	<table class="admintable" width="100%" align="center">
		<tr>
			<td class="key" colspan="2">รายการบันทึกการใช้งบประมาณกิจกรรมโครงการ</td>
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
	
	<?
		if(isset($_POST['save']) && $_POST['budget_type'] != "" && $_POST['budget_detail'] != "" && $_POST['prize_per_unit'] != "" && $_POST['amount'] != "") {
			$_sql = "insert into project_budget values (null,
						'" . $_POST['project_id'] . "',
						'" . $_POST['budget_type'] ."',
						'" . $_POST['budget_detail'] . "',
						'" . $_POST['prize_per_unit'] . "',
						'" . $_POST['amount'] . "',
						'" . $_POST['money'] . "'
							)";
			$_smsError = "ผิดพลาดเนื่องจาก : ";
			mysql_query($_sql) or die ($_smsError . mysql_error());
			//echo $_sql;
		}
	?>
	
	
	<? if(mysql_num_rows(mysql_query("select * from project_budget where project_id = '" . $_datProj['project_id'] . "'"))>0) { ?>
		<table width="100%" align="center" class="admintable">
			<tr>
				<td class="key" colspan="6">
					รายละเอียดรายการใช้จ่ายงบประมาณ
				</td>
			</tr>
			<? $_i = 1; $_sumA = 0;?>
			<? $_res = mysql_query("select * from project_budget where project_id = '" . $_datProj['project_id'] . "' and budget_type = '00' order by budget_id,money,amount"); ?>
			<? if(@mysql_num_rows($_res)>0) { ?>
				<tr>
					<td colspan="6"><b><font color="#0000CC">เงินงบประมาณแผ่นดิน</font></b></td>
				</tr>
				<tr>
					<td width="30px">&nbsp;</td>
					<td width="300px" class="key" align="center">รายการ</td>
					<td width="90px" class="key" align="center">จำนวน/หน่วย</td>
					<td width="90px" class="key" align="center">ราคา/หน่วย</td>
					<td width="120px" class="key" align="center">รวม(บาท)</td>
					<td>&nbsp;</td>
				</tr>
				<? while($_dat = mysql_fetch_assoc($_res)) { ?>
					<tr>
						<td width="30px">&nbsp;</td>
						<td ><?=$_i++ . '. ' . $_dat['budget_detail']?></td>
						<td align="right"><?=number_format($_dat['amount'],0,'.',',')?></td>
						<td align="right"><?=number_format($_dat['prize_per_unit'],2,'.',',')?></td>
						<td align="right"><b><?=number_format($_dat['money'],2,'.',',')?></b> <? $_sumA+=$_dat['money'] ;?></td>
						<td>
							<a href="index.php?option=module_projects/deleteBudget&project_id=<?=$_datProj['project_id']?>&budget_id=<?=$_dat['budget_id']?>&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>">
							<img src="../images/delete.gif" alt="หากต้องการลบคลิก"/>
							</a>
						</td>
					</tr>
				<? } //end while ?>
				<tr>
					<td width="30px">&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="2" align="center" class="key">รวม</td>
					<td align="right" class="key"><b><?=number_format($_sumA,2,'.',',')?></b></td>
				</tr>	
			<? } //end check_rows ?>
			
			
			
			<? $_i = 1; $_sumB =0; ?>
			<? $_res = mysql_query("select * from project_budget where project_id = '" . $_datProj['project_id'] . "' and budget_type = '01' order by budget_id,money,amount"); ?>
			<? if(@mysql_num_rows($_res)>0) { ?>
				<tr>
					<td colspan="6"><b><font color="#0000CC">เงินอุดหนุนอื่น</font></b></td>
				</tr>
				<tr>
					<td width="30px">&nbsp;</td>
					<td width="300px" class="key" align="center">รายการ</td>
					<td width="90px" class="key" align="center">จำนวน/หน่วย</td>
					<td width="90px" class="key" align="center">ราคา/หน่วย</td>
					<td width="120px" class="key" align="center">รวม(บาท)</td>
					<td>&nbsp;</td>
				</tr>
				<? while($_dat = mysql_fetch_assoc($_res)) { ?>
					<tr>
						<td width="30px">&nbsp;</td>
						<td width="250px"><?=$_i++ . '. ' . $_dat['budget_detail']?></td>
						<td align="right"><?=number_format($_dat['amount'],0,'.',',')?></td>
						<td align="right"><?=number_format($_dat['prize_per_unit'],2,'.',',')?></td>
						<td align="right"><b><?=number_format($_dat['money'],2,'.',',')?></b> <? $_sumB+=$_dat['money'];?></td>
						<td>
							<a href="index.php?option=module_projects/deleteBudget&project_id=<?=$_datProj['project_id']?>&budget_id=<?=$_dat['budget_id']?>&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>">
							<img src="../images/delete.gif" alt="หากต้องการลบคลิก"/>
							</a>
						</td>
					</tr>
				<? } //end while ?>
				<tr>
					<td width="30px">&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="2" align="center" class="key">รวม</td>
					<td align="right" class="key"><b><?=number_format($_sumB,2,'.',',')?></b></td>
				</tr>
			<? } //end check_rows ?>
			
			<tr>
				<td colspan="6"><b><font color="#0000CC">สรุปงบประมาณทั้งกิจกรรม/โครงการ</font></b></td>
			</tr>
			<tr>
				<td width="30px">&nbsp;</td>
				<td class="key" align="right">งบที่ได้รับ - [เงินงบประมาณ + เงินอุดหนุน]</td>
				<td class="key" colspan="3" align="right"><?=number_format($_datProj['budget_income'],2,'.',',')?> - [<?=number_format($_sumA,2,'.',',')?> + <?=number_format($_sumB,2,'.',',')?>]</td>
			</tr>
			<? $_total = $_datProj['budget_income']-($_sumA+$_sumB); ?>
			<tr>
				<td width="30px">&nbsp;</td>
				<td colspan="2">&nbsp;</td>
				<td align="right" class="key">
					<? 
						if($_total >= 0 ) echo "เงินคงเหลือ";
						else echo "ใช้เงินเกิน";
					?>
				</td>
				<td align="right" class="key">
					<?
						if($_total >= 0) echo "<font color='green'>" . number_format($_total,2,'.',',') . "</font>";
						else echo "<font color='red'>" . number_format($_total,2,'.',',') . "</font>";
					?>
				</td>
			</tr>
		</table>
	<? } // end if check_งบประมาณ ?>
<br/><hr />	
<form method="post" autocomplete="off" name="form">
	<table width="100%" align="center" class="admintable">
		<tr>
			<td class="key" colspan="2">
				<u>เพิ่ม</u>รายละเอียดรายการใช้จ่ายงบประมาณ(ของกิจกรรม/โครงการนี้)
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
			<td align="right" valign="top" class="key">เลือกแหล่งที่มาของงบ :</td>
			<td>
				<input type="radio" id="budget_type1" name="budget_type" value="00" <?=isset($_POST['budget_type'])&&$_POST['budget_type']=="00"?"checked":""?> /> เงินงบประมาณแผ่นดิน<br/>
				<input type="radio" id="budget_type2" name="budget_type" value="01" <?=isset($_POST['budget_type'])&&$_POST['budget_type']=="01"?"checked":""?> /> เงินอุดหนุนอื่น<br/>
			</td>
		</tr>
		<tr>
			<td class="key" align="right">รายการใช้จ่าย :</td>
			<td><input type="text" id="budget_detail" name="budget_detail" class="inputboxUpdate" size="50" maxlength="255" /></td>
		</tr>
		<tr>
			<td class="key" align="right">จำนวน :</td>
			<td>
				<input type="text" name="amount" id="amount" class="inputboxUpdate" size="2" maxlength="5" onkeypress="return isNumberKey(event)" />
			</td>
		</tr>
		<tr>
			<td class="key" align="right">ราคาต่อ 1 หน่วย :</td>
			<td>
				<input type="text" name="prize_per_unit" id="prize_per_unit" class="inputboxUpdate" size="5" maxlength="9" /> บาท/Bath
				<input type="button" value="คำนวณ !!!" id="cal" onclick="calculate()" />
			</td>
		</tr>
		<tr>
			<td class="key" align="right">รวมเป็นเงิน :</td>
			<td>
				<input type="text" name="money" id="money" class="inputboxUpdate" size="5" maxlength="9" disabled="disabled" />
				<input type="submit" id="save" name="save" value="บันทึก" class="button"  disabled="disabled" />
			</td>
		</tr>
	</table>
</form>
<? } //end if ?>
</div>

