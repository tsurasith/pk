<link rel="stylesheet" type="text/css" href="module_moral/css/calendar-mos2.css"/>
<script language="JavaScript" type="text/javascript" src="module_moral/js/calendar.js"></script>
<SCRIPT language="javascript" type="text/javascript">


	  function checkValue(){
	  		if(document.getElementById('date').value == "")
				{ alert('กรุณาป้อนข้อมูล วันที่ ของกิจกรรมที่พึงประสงค์ก่อน'); document.getElementById('date').focus(); return;}
			if(document.getElementById('mdesc').value == "")
				{ alert('กรุณาป้อนข้อมูล รายละเอียด ของพฤติกรรมที่พึงประสงค์ก่อน'); document.getElementById('mdesc').focus(); return; }
			if(document.getElementById('mplace').value == "")
				{ alert('กรุณาป้อนข้อมูล หน่วยงานที่รับผิดชอบ(เจ้าของงาน) ของพฤติกรรมที่พึงประสงค์ก่อน'); document.getElementById('mplace').focus(); return; }
			if(document.getElementById('mtype').value == "")
				{ alert('กรุณาเลือก ประเภท ของพฤติกรรมที่พึงประสงค์ก่อน'); document.getElementById('mtype').focus(); return;  }
			if(document.getElementById('mlevel').value == "")
				{ alert('กรุณาเลือก ระดับ ของกิจกรรมที่เข้าร่วมก่อน'); document.getElementById('mlevel').focus(); return; }
			if(document.getElementById('mprize').value == "")
				{ alert('กรุณาเลือก รางวัล ที่ได้รับจากกิจกรรมที่เข้าร่วมก่อน'); document.getElementById('mprize').focus(); return; }
			if(document.getElementById('teacher').value == "")
				{ alert('กรุณาเลือก ครูผู้ควบคุมนักเรียน ที่เข้าร่วม/ทำกิจกรรมที่พึงประสงค์ก่อน'); document.getElementById('teacher').focus(); return; }
			if(document.getElementById('academic').value == "")
				{ alert('กรุณาเลือกกลุ่มสาระการเรียนรู้ก่อน'); document.getElementById('academic').focus(); return; }
			else { document.myform.submit(); }
	  }
	  
	  
	function checkFile(e) {

		var file_list = e.target.files;
	
		for (var i = 0, file; file = file_list[i]; i++) {
			var sFileName = file.name;
			var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
			var iFileSize = file.size;
			var iConvert = (file.size / 1048576).toFixed(2);
	
			if (!(sFileExtension === "jpg") || iFileSize > 1048576) {
				txt = "พบข้อผิดพลาดในการเลือกไฟล์ \n\n";
				txt += " - ประเภทไฟล์ : " + sFileExtension + "\n";
				txt += " - ขนาด: " + iConvert + " MB \n";
				txt += "โปรดตรวจสอบไฟล์อีกครั้งว่ามีประเภทไฟล์ (นามสกุล เป็น .jpg) และขนาดไม่เกิน 1 MB หรือไม่ \n\n";
				alert(txt);
				document.getElementById('confirm').value = "";
			}
		}
	}
		  
	  
   </SCRIPT>
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_moral/index"><img src="../images/objects.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">ระบบสารสนเทศธนาคารความดี</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>1.1 บันทึกข้อมูลพฤติกรรมที่พึงประสงค์</strong></font></span></td>
     <td >
		<?php
			$_studentID = "";
			if(isset($_REQUEST['studentid'])){$_studentID = $_REQUEST['studentid'];}
			else {$_studentID = $_POST['studentid'];}
			
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_moral/addMoral&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_moral/addMoral&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		 ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_moral/addMoral&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_moral/addMoral&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
			<font color="#000000" size="2">
			<form method="post" autocomplete="off">
				เลขประจำตัวนักเรียน
				<input type="text" name="studentid" maxlength="5" size="5" class="inputboxUpdate" value="<?=isset($_POST['studentid'])?$_POST['studentid']:$_REQUEST['studentid']?>" onKeyPress="return isNumberKey(event)"/>
				<input type="submit" name="search" value="เรียกดู" class="button" onkeypress="return isNumberKey(event)" />
			</form>
			</font>
	  </td>
    </tr>
  </table>
<? if(isset($_POST['search']) && $_POST['studentid'] == "") { ?>
		<br/><br/><font color="#FF0000"><center>กรุณาป้อน เลขประจำตัวนักเรียนที่ต้องการทราบข้อมูก่อน</center></font>
<? }//end if ?>  

 <? if((isset($_POST['search']) && $_POST['studentid'] != "") || (!isset($_POST['saveedit']) && $_REQUEST['studentid'] !="")) { ?>
 		<? $sql = "select id,pin,prefix,firstname,lastname,nickname,xlevel,xyearth,room from students where id = '" . $_studentID . "' and xedbe = '" . $acadyear . "'" ;?>
		<? $result = mysql_query($sql); ?>
		<? if(mysql_num_rows($result)>0){ ?>
		<? $dat = mysql_fetch_array($result); ?>
		<form method="post" name="myform" enctype="multipart/form-data">
		<table width="100%" class="admintable">
			<tr><td class="key" colspan="3">รายละเอียดการบันทึก </td></tr>
			<tr>
				<td align="right" width="200px">เลขบัตรประจำตัวประชาชน :</td>
				<td><input class="noborder2" type="text" size="13" readonly="true" name="a_mobile" value="<?=$dat['pin']?>"/></td>
				<td rowspan="5" valign="top">
					<img src="../images/studphoto/id<?=$_studentID?>.jpg" width="120px" alt="รูปนักเรียน" align="top" style="border:solid 3px #333333"/>
				</td>
			<tr>
				<td align="right">เลขประจำตัว :</td>
				<td><input class="noborder2" type="text" size="5" readonly="true" name="student_id" value="<?=$dat['id']?>"/></td>
			</tr>
			<tr>
				<td align="right">ชื่อ - สกุล :</td>
				<td><input class="noborder2" type="text" size="30" readonly="true" name="studentname" value="<?=$dat['prefix'] . $dat['firstname'] . ' ' . $dat['lastname']?>"/></td>
			</tr>
			<tr>
				<td align="right">ระดับชั้น :</td>
				<td><input class="noborder2" type="text" readonly="true" name="edu" value="ชั้นมัธยมศึกษาปีที่  <?=$dat['xlevel']==3?$dat['xyearth']:($dat['xyearth']+3)?> / <?=$dat['room']?>"/></td>
			</tr>
			<tr>
				<td align="right">วันที่ :</td>
				<td ><input class="noborder2" type="text" id="date" name="date" size="10" onClick="showCalendar(this.id)"/><font color="red">*</font></td>
			</tr>
			<tr>
				<td align="right" valign="top">รายละเอียดพฤติกรรมที่พึงประสงค์ :</td>
				<td colspan="2"><textarea class="inputboxUpdate" name="mdesc" id="mdesc" rows="4" cols="60"></textarea><font color="red">*</font></td>
			</tr>
			<tr>
				<td align="right">สถานที่/หน่วยงานที่รับผิดชอบ:</td>
				<td colspan="2"><input class="noborder2" type="text" name="mplace" id="mplace" size="50"/><font color="red">*</font></td>
			</tr>
			<tr>
				<td align="right">ประเภทของพฤติกรรมที่พึงประสงค์ :</td>
				<td colspan="2">
					<select name="mtype" class="inputboxUpdate" id="mtype">
						<option value=""></option>
						<? $_resMoral = mysql_query("SELECT * FROM ref_moral");
						   while($_datMoral = mysql_fetch_assoc($_resMoral)) {  ?>
								<option value="<?=$_datMoral['moral_id']?>"><?=$_datMoral['moral_description']?></option>
						<?	} mysql_free_result($_resMoral); ?>
					</select> <font color="red">*</font>
				</td>
			</tr>
			<tr>
				<td align="right">ระดับของกิจกรรม :</td>
				<td colspan="2" >
					<select name="mlevel" class="inputboxUpdate" id="mlevel">
						<option value=""></option>
						<?  $_resMoral = mysql_query("SELECT * FROM ref_morallevel");
							while($_datMoral = mysql_fetch_assoc($_resMoral)) {  ?>
								<option value="<?=$_datMoral['morallev_id']?>"><?=$_datMoral['morallev_description']?></option>
						<?	} mysql_free_result($_resMoral); ?>
					</select> <font color="red">*</font>
				</td>
			</tr>
			<tr>
				<td align="right">รางวัลที่ได้รับ :</td>
				<td colspan="2">
					<select name="mprize" class="inputboxUpdate" id="mprize">
						<option value=""></option>
						<?  $_resMoral = mysql_query("SELECT * FROM ref_moraljoin");
							while($_datMoral = mysql_fetch_assoc($_resMoral)) {  ?>
								<option value="<?=$_datMoral['moraljoin_id']?>"><?=$_datMoral['moraljoin_description']?></option>
						<?	} mysql_free_result($_resMoral); ?>
					</select> <font color="red">*</font>
				</td>
			</tr>
			<tr>
				<td align="right">ครูผู้ควบคุม :</td>
				<td colspan="2">
					<? $_sqlTeacher = "select teaccode,prefix,firstname,lastname from teachers where type in ('admin','teacher') order by firstname"; ?>
						<? $_resTeacher = mysql_query($_sqlTeacher); ?>
						<select id="teacher" name="teacher" class="inputboxUpdate">
							<option value=""></option>
						<? while($_dat = mysql_fetch_assoc($_resTeacher)){ ?>
							<option value="<?=$_dat['prefix'].$_dat['firstname'].' '.$_dat['lastname']?>" ><?=$_dat['prefix'].$_dat['firstname'].' '.$_dat['lastname']?></option>
						<? } mysql_free_result($_resTeacher);//end while ?>
						</select> <font color="#FF0000">*</font>
				</td>
			</tr>
			<tr>
				<td align="right">กลุ่มสาระการเรียนรู้ :</td>
				<td colspan="2">
					<select name="academic" class="inputboxUpdate" id="academic">
						<option value=""></option>
						<?  $_resMoral = mysql_query("SELECT * FROM ref_academic");
							while($_datMoral = mysql_fetch_assoc($_resMoral)) {  ?>
								<option value="<?=$_datMoral['academic_id']?>"><?=$_datMoral['academic_description']?></option>
						<?	} mysql_free_result($_resMoral); ?>
					</select> <font color="red">*</font>
				</td>
			</tr>
			<tr>
				<td align="right">การเพิ่มคะแนนความประพฤติ :</td>
				<td colspan="2"><input type="text" name="point" class="noborder2" value="0" size="2" maxlength="2" onKeyPress="return isNumberKey(event)"/> คะแนน <font color="red">*</font></td>
			</tr>
            <tr>
            	<td align="right" valign="top">ไฟล์รูปภาพเกียรติบัตร</td>
                <td>
                	<input type="file" name="file" id="confirm" size="60px" onchange="checkFile(event);"/><br/>
                    ไฟล์เกียรติบัตรที่แนบต้องมีรูปแบบไฟล์เป็น .jpg และขนาดไม่ควรเกิน 1 MB<br/>
                </td>
            </tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="2">
					<input type="hidden" name="student_id" value="<?=$_studentID?>" />
					<input type="hidden" name="saveedit" /> 
					<input type="button" value="บันทึก" class="button" onclick="checkValue();" />
					<input type="button" value="ยกเลิก" class="button" onClick="history.go(-1);"/> 
				</td>
			</tr>
		</table>
		</form>
		<? }else { ?>
				<br/><br/><font color="#FF0000"><center>ไม่พบข้อมูลที่ค้นหาตามเงื่อนไข</center></font>
		<? } //end-else check_rows search ?>	
 <?	}//end if search ?>

<? if(isset($_POST['saveedit'])) {
		
		$_target = $_SERVER["DOCUMENT_ROOT"] . "/pk/certificates/";
		$_fileName = $acadyear . '-' . $acadsemester . '-' . $_POST['student_id'] . '-' . time();
		
		$sql = "insert into student_moral values (null,
						'" . $_POST['date'] . "',
						'" . trim($_POST['mplace']) . "',
						'" . $_POST['mlevel'] ."',
						'" . trim($_POST['mdesc']) . "',
						'" . $_POST['mtype'] . "',
						'" . $_POST['mprize'] . "',
						'" . trim($_POST['teacher']) . "',
						'" . $_POST['student_id'] . "',
						'" . $_POST['academic'] . "',
						'" . $acadyear . "',
						'" . $acadsemester . "',
						'" . $_POST['point'] . "',
						'" . $_fileName . "')";
						
			
			$_uploadError = 0;

			if ((($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png")))
			{
				if ($_FILES["file"]["error"] > 0)
				{ $_uploadError = 1; /* error ที่การ upload */ }
				else if ($_FILES["file"]["size"] > 1000000)
				{ $_uploadError = 3; /* error ที่ขนาดไฟล์ใหญ่กว่าที่กำหนด 1MB */ }
				else
				{
					// @unlink($_target . "id" . $_studentID . ".jpg");
					move_uploaded_file($_FILES["file"]["tmp_name"], $_target . $_FILES["file"]["name"]);
					if($_FILES["file"]["name"] != ( $_fileName . ".jpg"))
					{
						@rename($_target . $_FILES["file"]["name"] , $_target.$_fileName . ".jpg");
						$_uploadError = 4; // upload Complete	
					}
				}
			}
			else 
			{ 
				// $_uploadError = 2; // error ที่เลือกไฟล์ไม่ถูกต้อง }
			}			

		if(mysql_query($sql)){
			$_point = "update students set points = points + " . $_POST['point'] . " 
								where id = '" . $_POST['student_id'] ."' and xedbe = '" . $acadyear . "'";
			$y = mysql_query($_point)or die("<br/><br/><center><font color='red' size='2'>การบันทึกคะแนนพฤติกรรมผิดพลาด เนื่องจาก ". mysql_error() . "</font></center>");
					//echo $sql;
			$_resNumberID = mysql_query("select id,acadyear,acadsemester,image from student_moral
									 where student_id ='" . $_POST['student_id'] . "'
										and mdate = '" . $_POST['date'] . "'
										and place = '" . trim($_POST['mplace']) . "'
										and point = '" . $_POST['point'] . "'
										and mdesc = '" . trim($_POST['mdesc']) ."'");
				$_datID = mysql_fetch_assoc($_resNumberID) or die (mysql_error());
				echo "<br/><br/><center><font color='green'><b>บันทึกข้อมูลเรียบร้อยแล้ว<br/>
							รหัสพฤติกรรมที่พึงประสงค์ : 
							<a href='index.php?option=module_moral/moralFull
								&num_id=" . $_datID['id'] . "
								&acadyear=". $_datID['acadyear']."
								&acadsemester=". $_datID['acadsemester']."
								&certificate=" . $_datID['image'] . "'>" . $_datID['id'] ."</a></b></font></center><br/>";
		} else { echo "<br/><br/><center><font color='red' size='4'>การบันทึกข้อมูลผิดพลาด เนื่องจาก ". mysql_error() . "</font></center>"; }
	} //end isset($_POST['save']) ?>
</div>
