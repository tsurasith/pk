
<link rel="stylesheet" type="text/css" href="module_discipline/css/calendar-mos2.css"/>
<script language="JavaScript" type="text/javascript" src="module_discipline/js/calendar.js"></script>
<script language="javascript" type="text/javascript">
function check(name,value)
	{ document.getElementById(name).bgColor=value;	}

function isNumberKey(evt)
{
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
}
function formCheckValue()
{
	if( document.getElementById('date').value == "" || document.getElementById('date').value.length < 10)
		{ alert("การป้อนข้อมูลวันที่เกิดเหตุไม่ถูกต้อง รูปแบบที่ต้องการคือ yyyy-mm-dd (10 ตัวอักษร)"); document.getElementById('date').focus(); return;}
		
	if(document.getElementById('p_village').value == "")
		{ alert("คุณยังไม่ได้ป้อนข้อมูลหมู่บ้านของนักเรียน หรือชื่อหมู่บ้านสั้นเกินไป"); document.getElementById('p_village').focus();return;}
		
	if(document.getElementById('informer').value == "" || document.getElementById('informer').value.length < 5)
		{ alert("คุณยังไม่ได้ป้อนข้อมูลผู้แจ้ง"); document.getElementById('informer').focus();return; }
	
	if( document.getElementById('informdate').value == "" || document.getElementById('informdate').value.length < 10)	
		{ alert("การป้อนข้อมูลวันที่แจ้งไม่ถูกต้อง รูปแบบที่ต้องการคือ yyyy-mm-dd (10 ตัวอักษร)"); document.getElementById('informdate').focus(); return;}
	
	if( document.getElementById('reciever').value == "" || document.getElementById('reciever').value.length < 10)	
		{ alert("คุณยังไม่ได้ป้อนข้อมูลผู้รับแจ้ง หรือชื่อผู้แจ้งสั้นเกินไป"); document.getElementById('reciever').focus(); return; }
	
	if( document.getElementById('recievedate').value == "" || document.getElementById('recievedate').value.length < 10)	
		{ alert("การป้อนข้อมูลวันที่รับแจ้งไม่ถูกต้อง รูปแบบที่ต้องการคือ yyyy-mm-dd (10 ตัวอักษร)"); document.getElementById('recievedate').focus(); return; }
	
	if( document.getElementById('disciplinedetail').value == "" || document.getElementById('disciplinedetail').value.length < 10)	
		{ alert("การป้อนข้อมูลพฤติกรรมไม่พึงประสงค์ไม่ถูกต้องหรือสั้นเกินไป"); document.getElementById('disciplinedetail').focus();return; }
	
	if( document.getElementById('recieverdetail').value == "" || document.getElementById('recieverdetail').value.length < 10)	
		{ alert("การป้อนข้อมูลพฤติกรรมไม่พึงประสงค์ไม่ถูกต้องหรือสั้นเกินไป"); document.getElementById('recieverdetail').focus();return; }
	else {document.myform.submit();}
}
</script>

<div id="content">

<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.1 บันทึกรับแจ้งพฤติกรรมไม่พึงประสงค์</strong></font></span></td>
      <td >
		<form method="post" autocomplete="off"> 
			ปีการศึกษา <?=$acadyear?> ภาคเรียนที่ <?=$acadsemester?> <br/>
			<font color="#000000" size="2"  > 
			เลขประจำตัวนักเรียน
			<input type="text" name="studentid" maxlength="5" value="<?=isset($_POST['studentid'])?$_POST['studentid']:""?>" size="5" class="inputboxUpdate" onKeyPress="return isNumberKey(event)"/>
			<input type="submit" name="action" value="เรียกดู" class="button" />
			</font>
		</form>
	  </td>
    </tr>
  </table>

<? if(isset($_POST['action']) && $_POST['studentid'] == ""){ ?>
	<center><br/><font color="#FF0000">กรุณาป้อน เลขประจำตัวนักเรียนก่อน !</font></center>
<? } ?>


<? if(isset($_POST['action']) && $_POST['studentid'] != ""){ ?>
	<? $sql = "select id,pin,prefix,firstname,lastname,nickname,xlevel,xyearth,room,sex,f_name,m_name,a_name,a_mobile,p_village,p_tumbol from students where id = '" . $_POST['studentid'] . "' and xedbe = '" . $acadyear . "'" ; ?>
	<? $result = mysql_query($sql);?>
	<? if($result && mysql_num_rows($result) > 0) { ?>
		 <form name="myform"  method="post" autocomplete="off">
		  <table width="100%" align="center" cellspacing="1" class="admintable" border="0" cellpadding="0">
			<tr>
				<td  class="key" colspan="2">แบบบันทึกการรับแจ้งพฤติกรรมที่ไม่พึงประสงค์ </td>
                <td rowspan="2" align="right"><img src="../images/studphoto/id<?=$_POST['studentid']?>.jpg" width="100px" height="120px" alt="รูปนักเรียน" align="top" style="border:solid 1px #003399"/></td>
			</tr>
			<tr><td class="key" colspan="2">รายละเอียดการบันทึก </td></tr>
			<tr>
				<td width="100px" align="right">วันที่เกิดเหตุ :</td>
				<td width="220px"><input class="noborder2" type="text" id="date" name="date" size="10" onClick="showCalendar(this.id)"/><font color="red">*</font></td>
				<td colspan="2">รายละเอียดพฤติกรรมที่ไม่พึงประสงค์ <font color="red">*</font></td>
			</tr>
			<tr>
				<td align="right">เวลา :</td>
				<td>
					<select id="hour" name="hour" class="inputboxUpdate">
					<?	for($i = 0 ; $i <=23 ; $i++) {
							$value = "";
							if($i < 10){ $value = "0" . $i; }
							else $value = $i;
							echo "<option value='" . $value . "'>$value</option>";
						} ?>
					</select>
					<select name="minute" class="inputboxUpdate">
					<?	for($i = 0 ; $i <=59 ; $i++) {
							$value = "";
							if($i < 10){ $value = "0" . $i;  }
							else $value = $i;
							echo "<option value='" . $value . "'>$value</option>";
						} ?>
					</select> น.<font color="red">*</font></td>
				<td colspan="2" rowspan="10" valign="top">
					<textarea id="disciplinedetail" name="disciplinedetail" cols="50" rows="15" class="inputboxUpdate" style="width:100% !important;"></textarea>
				</td>
			</tr>
			<? $dat = mysql_fetch_array($result); ?>
			<tr>
				<td align="right">เลขประจำตัว :</td>
				<td><input class="noborder2" type="text" size="10" readonly="true" name="student_id" value="<?=$dat['id']?>"/></td>
			</tr>
			<tr>
				<td align="right">ชื่อ - สกุล :</td>
				<td><input class="noborder2" type="text" readonly="true" name="studentname" value="<?=$dat['prefix'] . $dat['firstname'] . ' ' . $dat['lastname']?>"/></td>
			</tr>
			<tr>
				<td align="right">ระดับชั้น :</td>
				<td><input class="noborder2" type="text" readonly="true" name="edu" value="ชั้นมัธยมศึกษาปีที่ <?=$dat['xlevel']==3?$dat['xyearth']:$dat['xyearth']+3?>/<?=$dat['room']?>"/></td>
			</tr>
			<tr>
				<td align="right">ชื่อผู้ปกครอง :</td>
				<td><input class="noborder2" type="text"  readonly="true" name="a_name" value="<?=$dat['a_name']?>"/></td>
			</tr>
			<tr>
				<td align="right">เบอร์โทร :</td>
				<td><input class="noborder2" type="text"  readonly="true" name="a_mobile" value="<?=$dat['a_mobile']?>"/></td>
			</tr>
			<tr>
				<td align="right">ชื่อหมู่บ้าน :</td>
				<td><input class="noborder2" type="text" id="p_village"  name="p_village" value="<?=$dat['p_village']?>"/><font color="red">*</font></td>
			</tr>
			<tr>
				<td align="right">ตำบล :</td>
				<td><input class="noborder2" type="text"  readonly="true" name="p_tumbol" value="<?=$dat['p_tumbol']?>"/></td>
			</tr>
			<tr>
				<td align="right">ผู้แจ้ง :</td>
				<td><input class="noborder2" type="text" id="informer" name="informer" /><font color="red">*</font></td>
			</tr>
			<tr>
				<td align="right">วันที่แจ้ง :</td>
				<td><input class="noborder2" type="text" id="informdate" name="informdate" size="10" onClick="showCalendar(this.id)"/><font color="red">*</font></td>
			</tr>
			<tr>
				<td align="right">กลุ่มผู้แจ้ง :</td>
				<td >
					<input type="radio" name="informgroup" value="ครู" checked/> ครู
					<input type="radio" name="informgroup" value="นักเรียน" /> นักเรียน
					<input type="radio" name="informgroup" value="ผู้ปกครอง" /> ผู้ปกครอง
					<font color="red">*</font>
				</td>
				<td colspan="2">ความเห็นของผู้ัรับแจ้ง<font color="red">*</font></td>
			</tr>
			<tr>
				<td align="right">ผู้รับแจ้ง :</td>
				<td><input class="noborder2" type="text" id="reciever" name="reciever" /><font color="red">*</font></td>
				<td colspan="2" rowspan="2" valign="top"> <textarea id="recieverdetail" class="inputboxUpdate" name="recieverdetail" cols="40" rows="3" style="width:100% !important;"></textarea></td>
			</tr>
			<tr>
				<td align="right">วันที่รับแจ้ง :</td>
				<td><input class="noborder2" type="text" id="recievedate" name="recievedate" size="10" onClick="showCalendar(this.id)"/><font color="red">*</font></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3" class="key">
					<input type="button" value="บันทึก"  name="saveedit" class="button" onClick="formCheckValue()"/> 
					<input type="button" value="ยกเลิก" class="button" onClick="location.href='../administrator/index.php?option=module_discipline/index'"/> 
				</td>
			</tr> 
		</table>
	<?	} //end if - check_data
		else { ?>
				<center><br/><font color="red">ผิดพลาด ไม่พบข้อมูลที่ค้นหา กรุณาตรวจสอบเลขประจำตัวนักเรียนอีกครั้ง</font></center>
	<?	} //end-else?>	
<?	} // end_submit_search?>


 <?	if(isset($_POST['student_id'])) { ?>
		<table class="admintable" width="100%">
			<tr><td class="key"> ผลการบันทึกข้อมูล </td></tr>
			<?php
					$sql = "insert into student_discipline values (null,'" . $_POST['student_id'] . "','" . $_POST['date'] . "','" .
							$_POST['hour'] ."." . $_POST['minute'] . "','" . trim($_POST['p_village']) . "','" .
							trim($_POST['p_tumbol']) . "','". trim($_POST['informer']) . "','" . $_POST['informdate'] . "','" .
							$_POST['informgroup'] . "','" . trim($_POST['reciever']) . "','". $_POST['recievedate'] . "','" . trim($_POST['recieverdetail']) . "','" .
							trim($_POST['disciplinedetail']) . "','" . $_SESSION['name'] . "')";
					$sql_status = "insert into student_disciplinestatus values('" . $_POST['student_id']  . "',null,'1','00','0','" . $acadyear . "','" . $acadsemester . "')";
					
					$y = mysql_query($sql_status);
					if(mysql_query($sql))
					{
						$_resNumberID = mysql_query("select dis_id from student_discipline
											 where dis_studentid ='" . $_POST['student_id'] . "'
												and dis_date = '" . $_POST['date'] . "'
												and dis_detail = '" . trim($_POST['disciplinedetail']) . "'
												and dis_time = '" . $_POST['hour'] . "." . $_POST['minute'] ."'");
						$_datID = mysql_fetch_assoc($_resNumberID) or die (mysql_error());
						echo "<tr><td align='center'>
								<font color='green'>บันทึกข้อมูลเรียบร้อยแล้ว<br/>
								หมายเลขคดี : <b>". $_datID['dis_id'] ."</a></b></font></td></tr>";
					}
					else{ showError("การบันทึกข้อมูลผิดพลาด เนื่องจาก ". mysql_error()); } ?>		
		</table>
		</form>
	<? } ?>

</div>

<?php
	function showError($msg) { echo "<tr><td align='center'><font color=\"red\">$msg</font></td></tr>"; }
?>