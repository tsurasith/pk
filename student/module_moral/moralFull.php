

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_moral/index"><img src="../images/objects.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">ระบบสารสนเทศธนาคารความดี</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>2. รายงานผลพฤติกรรมที่พึงประสงค์ [ฉบับเต็มแต่ละคดี]</strong></font></span></td>
     <td >
		<?  $_numID = "";
			if(isset($_REQUEST['num_id'])){$_numID = $_REQUEST['num_id'];}
			else {$_numID = $_POST['num_id'];}
			
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา
		<?  echo "<a href=\"index.php?option=module_moral/moralFull&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
			echo ' <font color=\'blue\'>' .$acadyear . '</font>';
			echo " <a href=\"index.php?option=module_moral/moralFull&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
		?><br/>
		<font color="#000000" size="2">
		<form method="post" autocomplete="off">
			 รหัสพฤติกรรมที่พึงประสงค์ 
			 <input type="text" name="num_id" maxlength="5" size="4" class="inputboxUpdate" value="<?=isset($_POST['num_id'])?$_POST['num_id']:$_REQUEST['num_id']?>" onKeyPress="return isNumberKey(event)"/>
			 <input type="submit" name="search" value="เรียกดู" class="button" />
		</form>
		</font>
	  </td>
    </tr>
  </table>
 <? if(isset($_POST['search']) && $_POST['num_id']==""){ ?>
 		<br/><br/><font color="#FF0000"><center>กรุณาป้อน รหัสพฤติกรรมที่พึงประสงค์ก่อน</center></font>
 <? } //end if ?>
 <? if((isset($_POST['search']) && $_POST['num_id']!= "" )|| $_numID != "")	{ ?>
 		<? $sql = "select a.id,pin,prefix,firstname,lastname,nickname,xlevel,xyearth,room,
						b.id as num_id,mdate,place,mlevel,mdesc,mprize,mtype,mteacher,academic,point,image
					 from students a right outer join student_moral b on a.id = b.student_id
					 where b.id = '" . $_numID . "' and xedbe = '" . $acadyear . "'" ;?>
		<? $result = mysql_query($sql); ?>
		<? if($result && mysql_num_rows($result) > 0){ ?>
		<? $dat = mysql_fetch_array($result); ?>
		<form method="post">
		<table width="100%" class="admintable">
			<tr><td class="key" colspan="3" height="30px">รายละเอียดพฤติกรรมที่พึงประสงค์ </td></tr>
			<tr>
				<td align="right" width="200px">เลขบัตรประจำตัวประชาชน :</td>
				<td><input class="noborder2" type="text" size="13" readonly="true" name="a_mobile" value="<?=$dat['pin']?>"/></td>
				<td rowspan="5" valign="top">
					<img src="../images/studphoto/id<?=$dat['id']?>.jpg" width="120px" alt="รูปนักเรียน" align="top" style="border:solid 3px #333333"/>
				</td>
			<tr>
				<td align="right">เลขประจำตัว :</td>
				<td><input class="noborder2" type="text" size="5" readonly="true" name="student_id" value="<?=$dat['id']?>"/></td>
			</tr>
			<tr>
				<td align="right">ชื่อ - สกุล :</td>
				<td><input class="noborder2" type="text" size="30" readonly="true" name="studentname" value="<?=$dat['prefix'] . $dat['firstname'] . ' ' . $dat['lastname']?>" /></td>
			</tr>
			<tr>
				<td align="right">ระดับชั้น :</td>
				<td><input class="noborder2" type="text" readonly="true" name="edu" value="ชั้นมัธยมศึกษาปีที่  <?=$dat['xlevel']==3?$dat['xyearth']:($dat['xyearth']+3)?> / <?=$dat['room']?>"/></td>
			</tr>
			<tr>
				<td align="right">วันที่ :</td>
				<td ><input class="noborder2" type="text" size="30" id="date" name="date" value="<?=displayFullDate($dat['mdate'])?>"/></td>
			</tr>
			<tr>
				<td align="right" valign="top">รายละเอียดพฤติกรรมที่พึงประสงค์ :</td>
				<td colspan="2"><textarea class="inputboxUpdate" name="mdesc" rows="4" cols="60" readonly="true"><?=$dat['mdesc']?></textarea></td>
			</tr>
			<tr>
				<td align="right">สถานที่/หน่วยงานที่รับผิดชอบ:</td>
				<td colspan="2"><input class="noborder2" type="text" size="50" name="mplace" value="<?=$dat['place']?>" readonly="true"/></td>
			</tr>
			<tr>
				<td align="right">ประเภทของพฤติกรรมที่พึงประสงค์ :</td>
				<td colspan="2">
					<?php
						$_resMoral = mysql_query("SELECT moral_description FROM ref_moral where moral_id = '" . $dat['mtype'] . "'");
						$_datMoral = mysql_fetch_assoc($_resMoral)
					?>
					<input type="text" class="noborder2" name="mtype" size="50" value="<?=$_datMoral['moral_description']?>" readonly="true"/>
					<? mysql_free_result($_resMoral); ?>
				</td>
			</tr>
			<tr>
				<td align="right">ระดับของกิจกรรม :</td>
				<td colspan="2" >
					<?php
						$_resMoral = mysql_query("SELECT morallev_description FROM ref_morallevel where morallev_id = '" . $dat['mlevel'] . "'");
						$_datMoral = mysql_fetch_assoc($_resMoral)
					?>
					<input type="text" class="noborder2" name="mlevel" size="50" value="<?=$_datMoral['morallev_description']?>" readonly="true" />
					<? mysql_free_result($_resMoral); ?>
				</td>
			</tr>
			<tr>
				<td align="right">รางวัลที่ได้รับ :</td>
				<td colspan="2">
					<?php
						$_resMoral = mysql_query("SELECT moraljoin_description FROM ref_moraljoin where moraljoin_id = '" . $dat['mprize'] . "'");
						$_datMoral = mysql_fetch_assoc($_resMoral)
					?>
					<input type="text" class="noborder2" name="mprize" size="50" value="<?=$_datMoral['moraljoin_description']?>" readonly="true"/>
					<? mysql_free_result($_resMoral); ?>
				</td>
			</tr>
			<tr>
				<td align="right">ครูผู้ควบคุม :</td>
				<td colspan="2"><input type="text" name="teacher" value="<?=$dat['mteacher']?>" class="noborder2" size="35" readonly="true"/>
			</tr>
			<tr>
				<td align="right">กลุ่มสาระการเรียนรู้ :</td>
				<td colspan="2">
					<?php
						$_resMoral = mysql_query("SELECT academic_description FROM ref_academic where academic_id = '" . $dat['academic'] . "'");
						$_datMoral = mysql_fetch_assoc($_resMoral)
					?>
					<input type="text" class="noborder2" name="academic" size="50" value="<?=$_datMoral['academic_description']?>" readonly="true" />
					<? mysql_free_result($_resMoral); ?>
				</td>
			</tr>
			<tr>
				<td align="right">การเพิ่มคะแนนความประพฤติ :</td>
				<td colspan="2"><input type="text" name="point" class="noborder2" value="<?=$dat['point']?>" size="2" maxlength="2" readonly="true"/> คะแนน
			</tr>
            <tr>
            	<td align="right">รูปภาพเกียรติบัตร :</td>
                <td>
                	<? $_fileCertificate = $_SERVER["DOCUMENT_ROOT"] . "/pk/certificates/". $dat['image'] . ".jpg"; ?>
					<? if(file_exists($_fileCertificate)){?>
                    		<a target="_blank" href="module_moral/displayCertificate.php?id=<?=$dat['image'];?>">
                            	<b>เกียรติบัตร</b>
                            </a>
                    <? } else { echo "ไม่มีเกียรติบัตรแนบ";} ?>
                </td>
            </tr>
		</table>
		</form>
		<? }  else	{ ?>
				<br/><br/><font color="#FF0000"><center>ไม่พบข้อมูล พฤติกรรมที่พึงประสงค์ ตามเงื่อนไขที่ค้นหา</center></font>
		<?	} //end-else check_rows search?>	
 <?	}//end if search ?>

</div>

