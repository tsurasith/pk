<SCRIPT language="Javascript" type="text/javascript">
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
	  function checkFromValue()
	  {
	  	 if(!document.getElementById('comment_type1').checked && !document.getElementById('comment_type2').checked)
		 	{ alert('กรุณาเลือก ปัญหา หรือ ข้อเสนอ ก่อน'); document.getElementById('comment_type1').focus(); return;}
		 if(document.getElementById('detail').value == "")
		 	{ alert('กรุณาป้อนรายละเอียดของปัญหา หรือ ข้อเสนอ ก่อน'); document.getElementById('detail').focus(); return; }
		 else { document.myform.submit();}
	  }
   </SCRIPT>
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_projects/index">
			<img src="../images/computer.png" alt="" width="48" height="48" border="0"/>
		</a>
	  </td>
    <td ><strong><font color="#990000" size="4">ระบบสารสนเทศกิจกรรม/โครงการ</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>1.4 บันทึกปัญหา/ข้อเสนอแนะ</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_projects/addComment&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_projects/addComment&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_projects/addComment&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_projects/addComment&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
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
 <?
		if(isset($_POST['save'])) {
			$_sql = "insert into project_comment values (null,
						'" . $_POST['project_id'] . "',
						'" . $_POST['comment_type'] ."',
						'" . $_POST['detail'] . "'
							)";
			$_smsError = "ผิดพลาดเนื่องจาก : ";
			mysql_query($_sql) or die ( "<center><font color='red'><br/>" . $_smsError . mysql_error() . "</font></center>");
		}
	?>
	 
  <? if(isset($_POST['search']) && $_POST['p_id'] == "") { ?>
  		<center><font color="#FF0000"><br/>กรุณาเลือก กิจกรรมโครงการ ที่ต้องการเพิ่ม/แก้ไขข้อมูลก่อน </font></center>
  <? } ?>

<?
	$_sql = "select * from project where project_id ='" . (isset($_POST['p_id'])?$_POST['p_id']:$_REQUEST['p_id']) . "'";
	$_res = @mysql_query($_sql);
	if(@mysql_num_rows($_res)>0) {
		$_datProj = mysql_fetch_assoc($_res);
?>
	<table class="admintable" width="100%" align="center">
		<tr>
			<td class="key" colspan="2">รายการบันทึกปัญหาและข้อเสนอแนะกิจกรรมโครงการ</td>
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
					<td>
						<?=$_dat['comment_type']==0?$_i++:$_j++;?>. <?=$_dat['detail']?>
						<a href="index.php?option=module_projects/deleteComment&project_id=<?=$_datProj['project_id']?>&id=<?=$_dat['id']?>&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>">
						<img src="../images/delete.gif" alt="หากต้องการลบคลิก"/>
						</a>
					</td>
				</tr>
			<? } //end while ?>
		</table>
	<? } // end if check_ปัญหาข้อเสนอแนะ ?>
<br/><hr />	
<form method="post" name="myform" autocomplete="off">
	<table width="100%" align="center" class="admintable">
		<tr>
			<td class="key" colspan="2">
				<u>เพิ่ม</u>ข้อแสดงความคิดเห็น [ปัญหา/ข้อเสนอแนะ](ของกิจกรรม/โครงการนี้)
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
			<td align="right" valign="top" class="key">ประเภทเนื้อหา :</td>
			<td>
				<input type="radio" id="comment_type1" name="comment_type" value="0" <?=isset($_POST['comment_type'])&&$_POST['comment_type']=="0"?"checked":""?> /> ปัญหา<br/>
				<input type="radio" id="comment_type2" name="comment_type" value="1" <?=isset($_POST['comment_type'])&&$_POST['comment_type']=="1"?"checked":""?> /> ข้อเสนอแนะ<br/>
			</td>
		</tr>
		<tr>
			<td class="key" align="right" valign="top">รายละเอียด :</td>
			<td>
				<textarea class="inputboxUpdate" id="detail" cols="55" rows="3" name="detail"></textarea><br/><br/>
				<input type="hidden" name="save" />
				<input type="button" value="บันทึก" class="button" onclick="checkFromValue()" />
			</td>
		</tr>
	</table>
</form>
<? } //end if ?>
</div>

