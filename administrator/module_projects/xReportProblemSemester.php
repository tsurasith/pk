<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_projects/index">
			<img src="../images/computer.png" alt="" width="48" height="48" border="0"/>
		</a>
	  </td>
    <td ><strong><font color="#990000" size="4">ระบบสารสนเทศกิจกรรม/โครงการ</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>2.1.4 รายงานสรุป ปัญหาและข้อเสนอแนะ<br/> กิจกรรมโครงการ</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_projects/xReportProblemSemester&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_projects/xReportProblemSemester&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_projects/xReportProblemSemester&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_projects/xReportProblemSemester&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
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
<? if(isset($_POST['search']) && $_POST['p_id'] == ""){ ?>
		<center><font color="#FF0000"><br/><br/>กรุณาเลือก กิจกรรมโครงการ ที่ต้องการทราบข้อมูลก่อน</font></center>
<? } //end if ?> 
<?
	$_pID = $_POST['p_id']!=""?$_POST['p_id']:$_REQUEST['p_id'];
	$_sql = "select * from project where project_id ='" . $_pID ."'";
	$_res = @mysql_query($_sql);
	if(@mysql_num_rows($_res)>0) {
		$_datProj = mysql_fetch_assoc($_res);
?>
	<table class="admintable" width="100%" align="center">
		<tr>
			<td class="key" colspan="2">รายละเอียดกิจกรรม/โครงการ</td>
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
			<td><?=displayDate($_datProj['start_date'])?></td>
		</tr>
		<tr>
			<td align="right" class="key">วันที่สิ้นสุด :</td>
			<td><?=displayDate($_datProj['finish_date'])?></td>
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
		if(isset($_POST['save']) && $_POST['standard'] != "" && $_POST['indexof'] != "" && $_POST['organize'] != "") {
			$_sql = "insert into project_qa values (
						'" . $_POST['project_id'] . "',
						'" . $_POST['organize'] ."',
						'" . $_POST['standard'] . "',
						'" . $_POST['indexof'] . "'
							)";
			$_smsError = "ผิดพลาดเนื่องจาก : ";
			mysql_query($_sql) or die ($_smsError . mysql_error());
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
			<? } //end check_rows ?>
			<? while($_dat = mysql_fetch_assoc($_res)) { ?>
				<tr>
					<td width="30px">&nbsp;</td>
					<td ><?=$_i++ . '. ' . $_dat['budget_detail']?></td>
					<td align="right"><?=number_format($_dat['amount'],0,'.',',')?></td>
					<td align="right"><?=number_format($_dat['prize_per_unit'],2,'.',',')?></td>
					<td align="right"><b><?=number_format($_dat['money'],2,'.',',')?></b> <? $_sumA+=$_dat['money'] ;?></td>
				</tr>
			<? } //end while ?>
			<tr>
				<td width="30px">&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="2" align="center" class="key">รวม</td>
				<td align="right" class="key"><b><?=number_format($_sumA,2,'.',',')?></b></td>
			</tr>
			
			
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
			<? } //end check_rows ?>
			<? while($_dat = mysql_fetch_assoc($_res)) { ?>
				<tr>
					<td width="30px">&nbsp;</td>
					<td width="250px"><?=$_i++ . '. ' . $_dat['budget_detail']?></td>
					<td align="right"><?=number_format($_dat['amount'],0,'.',',')?></td>
					<td align="right"><?=number_format($_dat['prize_per_unit'],2,'.',',')?></td>
					<td align="right"><b><?=number_format($_dat['money'],2,'.',',')?></b> <? $_sumB+=$_dat['money'];?></td>
				</tr>
			<? } //end while ?>
			<tr>
				<td width="30px">&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="2" align="center" class="key">รวม</td>
				<td align="right" class="key"><b><?=number_format($_sumB,2,'.',',')?></b></td>
			</tr>
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
	
	
	<? if(mysql_num_rows(mysql_query("select * from project_comment where project_id = '" . $_datProj['project_id'] . "'"))>0) { ?>
		<table width="100%" align="center" class="admintable">
			<tr>
				<td class="key" colspan="3">
					ข้อแสดงความคิดเห็น [ปัญหา/ข้อเสนอแนะ]
				</td>
			</tr>
			<? $_cType = ""; $_i=1;$_j=1; ?>
			<? $_res = mysql_query("select * from project_comment where project_id = '" . $_datProj['project_id'] . "' order by comment_type"); ?>
			<? while($_dat = mysql_fetch_assoc($_res)) { ?>
				<tr>
					<td width="30px">&nbsp;</td>
					<td width="75px">
						<? if($_dat['comment_type']!=$_cType)
							{
								echo "<font color='#FF0033'><b>" . ($_dat['comment_type']==0?"ปัญหา":"ข้อเสนอแนะ") . "</b></font>";
								$_cType = $_dat['comment_type'];
							}
						?>
					</td>
					<td><?=$_dat['comment_type']==0?$_i++:$_j++;?>. <?=$_dat['detail']?></td>
				</tr>
			<? } //end while ?>
		</table>
	<? } // end if check_มาตรฐานการศึกษา ?>
	
	
	
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
					<td>ตัวชี้วัดที่ <?=$_dat['indexof']?></td>
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
					<td>ตัวชี้วัดที่ <?=$_dat['indexof']?></td>
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
					<td>ตัวชี้วัดที่ <?=$_dat['indexof']?></td>
				</tr>
			<? } //end while ?>
		</table>
	<? } // end if check_มาตรฐานการศึกษา ?>

<? } //end if ?>
</div>

