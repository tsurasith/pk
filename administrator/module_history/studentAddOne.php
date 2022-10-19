<SCRIPT language="javascript" type="text/javascript">

	  function checkValue(){
	  	if(document.getElementById('id').value.length < 5)
		{alert('รูปแบบของเลขประจำตัวนักเรียนไม่ถูกต้อง ความยาวอย่างน้อย 5 ตัวอักษร'); document.getElementById('id').focus(); return;}
		if(document.getElementById('prefix').value == "")
		{alert('กรุณาเลือกคำนำหน้าของนักเรียนให้ถูกต้องก่อน'); document.getElementById('prefix').focus(); return;}
		if(document.getElementById('firstname').value == "")
		{alert('กรุณาระบุชื่อนักเรียนก่อน'); document.getElementById('firstname').focus(); return;}
		if(document.getElementById('lastname').value == "")
		{alert('กรุณาระบุนามสกุลนักเรียนก่อน'); document.getElementById('lastname').focus(); return;}
		if(document.getElementById('xlevel').value == "")
		{alert('กรุณาระบุระดับการศึกษานักเรียนก่อน'); document.getElementById('xlevel').focus(); return;}
		if(document.getElementById('xyearth').value == "")
		{alert('กรุณาระบุระดับชั้นนักเรียนก่อน'); document.getElementById('xyearth').focus(); return;}
		if(document.getElementById('room').value == "")
		{alert('กรุณาระบุห้องนักเรียนก่อน'); document.getElementById('room').focus(); return;}
		if(document.getElementById('ordinal').value == "")
		{alert('กรุณาระบุเลขที่นักเรียนก่อน'); document.getElementById('ordinal').focus(); return;}
		
		if(!document.getElementById('sex1').checked && !document.getElementById('sex2').checked)
		{alert('กรุณาระบุเพศของนักเรียนก่อน'); document.getElementById('sex1').focus(); return;}
		
		if(document.getElementById('end_date').value.length < 10)
		{alert('กรุณาระบุวันที่เข้าศึกษาของนักเรียนให้ถูกต้อง'); document.getElementById('end_date').focus(); return;}
		else { document.myform.submit(); }
	  }
   </SCRIPT>
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td align="center">
      <a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.2 เพิ่มนักเรียนเข้าใหม่/ย้ายเข้า</strong></font></span></td>
      <td>ปีการศึกษา <?=$acadyear?>  ภาคเรียนที่ <?=$acadsemester?></td>
    </tr>
</table>

<? if(isset($_POST['addNew'])) { ?>
		<table class="admintable" width="650px">
			<tr><td class="key">ผลการเพิ่มข้อมูล</td></tr>
			<tr>
				<td align="center">
					<?php
						$_sqlAddnew = "insert into students
											(ID,PREFIX,FIRSTNAME,LASTNAME,xLevel,xYearth,ROOM,ORDINAL,xEDBE,EnglishNAME,NICKNAME,SEX,ENT_YEAR,ENT_DATE,studstatus,Points,Color)
											values (
											'" . $_POST['ID'] . "',
											'" . $_POST['PREFIX'] . "',
											'" . $_POST['FIRSTNAME'] . "',
											'" . $_POST['LASTNAME'] . "',
											'" . $_POST['xLevel'] . "',
											'" . $_POST['xYearth'] . "',
											'" . $_POST['ROOM'] . "',
											'" . $_POST['ORDINAL'] . "',
											'" . $acadyear . "',
											'" . $_POST['EnglishNAME'] . "',
											'" . $_POST['NICKNAME'] . "',
											'" . $_POST['SEX'] . "',
											'" . $acadyear . "',
											'" . $_POST['ENT_DATE'] . "',
											'" . $_POST['studstatus'] . "','100',
											'" . $_POST['Color'] . "')";
						$_resID = mysql_query("select ID from students where ID = '" . $_POST['ID'] . "' and xEDBE = '" . $acadyear . "'");
						//echo $_sqlAddnew;
						if(mysql_num_rows($_resID)>0) {
							echo "<br/><br/><font color='red'>การดำเนินการผิดพลาดเนื่องจาก : ";
							echo "เลขประจำตัว " . $_POST['ID'] . " ได้มีอยู่ในระบบแล้ว <br/>หากท่านต้องการยืนยันที่จะใช้เลขประจำตัวนี้ให้ตรวจสอบการเลื่อนระดับชั้น</font><br/><br/>";
						}
						else if(mysql_query($_sqlAddnew)) {
							echo "<br/><br/>";
							echo "<font color='green'><b>การดำเนินเพิ่มนักเรียนใหม่เรียบร้อยแล้ว</b></font><br/><br/>";
						}
						else { echo "<font color='red'><b>การดำเนินการผิดพลาดเนื่องจาก : " . mysql_error() . "</b></font><br/><br/>"; }
					?>
				</td>
			</tr>
		</table>
<?	}	?>
			<form method="post" name="myform">
			<table class="admintable" cellpadding="0" cellspacing="0" >
				<tr><td colspan="2" class="key">รายการเพิ่มข้อมูลนักเรียนเข้าใหม่/ย้ายเข้า</td></tr>
				<tr><td align="right" width="250px" >เลขประจำตัว :</td>
					<td width="400px">
							<input id="id" type="text" value="<?=isset($_POST['ID'])?$_POST['ID']:""?>" name="ID" size="5" maxlength="5" class="inputboxUpdate" onkeypress="return isNumberKey(event)"/>
							<font color="#FF0000"><b>*</b></font> ตัวอย่าง 02363
					</td>
				</tr>
				<tr>
				  <td align="right">คำนำหน้า :</td>
				  <td>
				  		<select id="prefix" name="PREFIX" class="inputboxUpdate">
				  		<option value=""></option>
						<? $_resPrefix = mysql_query("select prefix_detail from ref_prefix where prefix_id < 5");
							while($_datPrefix = mysql_fetch_assoc($_resPrefix)) {  ?>
								<option value="<?=$_datPrefix['prefix_detail']?>" <?=isset($_POST['PREFIX'])&&$_POST['PREFIX']==$_datPrefix['prefix_detail']?"SELECTED":""?>><?=$_datPrefix['prefix_detail']?></option>
						<?	} mysql_free_result($_resPrefix); ?>
						</select><font color="#FF0000"><b>*</b></font>
					</td>
			  </tr>
				<tr>
				  <td align="right">ชื่อ :</td>
				  <td>
				  		<input id="firstname" type="text"  value="<?=isset($_POST['FIRSTNAME'])?$_POST['FIRSTNAME']:""?>"  name="FIRSTNAME" class="inputboxUpdate" size="20" />
						<font color="#FF0000"><b>*</b></font>
				  </td>
			  </tr>
			  <tr>
				  <td align="right">นามสกุล :</td>
				  <td>
				  		<input id="lastname" type="text" value="<?=isset($_POST['LASTNAME'])?$_POST['LASTNAME']:""?>" name="LASTNAME" class="inputboxUpdate" size="20" />
						<font color="#FF0000"><b>*</b></font>
				  </td>
			  </tr>
			  <tr>
				  <td align="right">ระดับการศึกษา :</td>
				  <td>
				  		<select id="xlevel" name="xLevel" class="inputboxUpdate" >
							<option value=""></option>
							<option value="3" <?=isset($_POST['xLevel'])&&$_POST['xLevel']==3?"SELECTED":""?> >มัธยมศึกษาตอนต้น</option>
							<option value="4" <?=isset($_POST['xLevel'])&&$_POST['xLevel']==4?"SELECTED":""?>>มัธยมศึกษาตอนปลาย</option>
						</select> <font color="#FF0000"><b>*</b></font>
				 </td>
			  </tr>
			  <tr>
				  <td align="right">ระดับชั้น :</td>
			    <td>
				  		<select id="xyearth" name="xYearth" class="inputboxUpdate" >
							<option value=""></option>
							<option value="1" >ม.1</option>
							<option value="2" >ม.2</option>
							<option value="3" >ม.3</option>
							<option value="1" >ม.4</option>
							<option value="2" >ม.5</option>
							<option value="3" >ม.6</option>
						</select> <font color="#FF0000"><b>*</b></font></td>
			  </tr>
			  <tr>
				  <td align="right">ห้อง :</td>
				  <td>
				  		<input id="room" type="text" value="<?=isset($_POST['ROOM'])?$_POST['ROOM']:""?>" name="ROOM" class="inputboxUpdate" size="2" maxlength="2" onKeyPress="return isNumberKey(event)" />
						<font color="#FF0000"><b>*</b></font> ตัวอย่าง 1 หรือ 2 หรือ 3 เป็นต้น
				  </td>
			  </tr>
			  <tr>
				  <td align="right">เลขที่ :</td>
				  <td>
				  		<input id="ordinal" type="text" value="<?=isset($_POST['ORDINAL'])?$_POST['ORDINAL']:""?>"  name="ORDINAL" class="inputboxUpdate" size="2" maxlength="2" onKeyPress="return isNumberKey(event)" />
						<font color="#FF0000"><b>*</b></font>
				  </td>
			  </tr>
			  <tr>
				  <td align="right">ปีการศึกษา :</td>
				  <td><input type="text" value="<?=$acadyear?>" name="xEDBE" class="inputboxUpdate" size="4" disabled="disabled" /></td>
			  </tr>
			  <tr>
				  <td align="right">ชื่อภาษาอังกฤษ :</td>
				  <td><input type="text" value="<?=isset($_POST['EnglishNAME'])?$_POST['EnglishNAME']:""?>"  name="EnglishNAME" class="inputboxUpdate" size="30" /></td>
			  </tr>
			  <tr>
				  <td align="right">ชื่อเล่น :</td>
				  <td><input type="text" value="<?=isset($_POST['NICKNAME'])?$_POST['NICKNAME']:""?>"  name="NICKNAME" class="inputboxUpdate" size="10" /></td>
			  </tr>
			  <tr>
				  <td align="right">เพศ :</td>
				  <td>
				  		<input id="sex1" type="radio" name="SEX" value="1" /> ชาย | <input id="sex2" type="radio" name="SEX" value="2"/> หญิง				  </td>
			  </tr>
			  <tr>
				  <td align="right">ปีที่เข้าศึกษา :</td>
				  <td><input type="text" value="<?=$acadyear?>" name="ENT_YEAR" class="inputboxUpdate" size="5" disabled="disabled" /></td>
			  </tr>
			  <tr>
				  <td align="right">วัน/เดือน/ปี ที่เข้าศึกษา :</td>
				  <td>
				  		<input id="end_date" type="text" value="<?=isset($_POST['ENT_DATE'])?$_POST['ENT_DATE']:""?>"   name="ENT_DATE" class="inputboxUpdate" size="10" maxlength="10" />
						<font color="#FF0000"><b>*</b></font>
						ตัวอย่าง = 31/05/2545				  </td>
			  </tr>
			  <tr>
				  <td align="right">สถานภาพปัจจุบัน :</td>
				  <td>
				  		<font color="#0000FF"><b>ปกติ</b></font><input type="hidden" name="studstatus" value="1" />				  </td>
			  </tr>
			  <tr>
				  <td align="right">คณะสี :</td>
				  <td>
				  		<select name="Color" class="inputboxUpdate">
				  		<? $_resColor = mysql_query("SELECT color_description FROM ref_color");
							while($_datColor = mysql_fetch_assoc($_resColor)) {  ?>
								<option value="<?=$_datColor['color_description']?>" <?=(isset($_POST['Color'])&&$_POST['Color']==$_datColor['color_description']?"SELECTED":"")?>><?=$_datColor['color_description']?></option>
						<?	} mysql_free_result($_resColor); ?>
						</select>
				</td>
			  </tr>
			  <tr>
				  <td align="right">&nbsp;</td>
				  <td>
				  		<input type="hidden" name="addNew" />
						<input type="button" value="บันทึก" class="button" onclick="checkValue()" /> 
						<input type="button" value="ยกเลิก" class="button" onclick="location.href='index.php?option=module_history/index'" />				  </td>
			  </tr>
			</table>
			</form>
</div>
   