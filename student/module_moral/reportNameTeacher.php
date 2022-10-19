<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_moral/index"><img src="../images/objects.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">ระบบสารสนเทศธนาคารความดี</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>2.2.3 รายงานสรุปครูผู้ควบคุมนักเรียน</strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			else if(isset($_POST['acadyear'])){ $acadyear = $_POST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])){ $acadsemester = $_REQUEST['acadsemester']; }
			else if(isset($_POST['acadsemester'])){ $acadsemester = $_POST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_moral/reportNameTeacher&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_moral/reportNameTeacher&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_moral/reportNameTeacher&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_moral/reportNameTeacher&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		</font>
		<br/>
	  		<font color="#000000"  size="2" >
			รายชื่อครู 
			<? @$_resTeacher = mysql_query("select distinct mteacher from student_moral where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'"); ?>
			<select name="mteacher" class="inputboxUpdate">
				<option value=""></option>
				<? while($_dat = mysql_fetch_assoc($_resTeacher)) { ?>
				<option value="<?=$_dat['mteacher']?>"  <?=isset($_POST['mteacher']) && $_POST['mteacher']==$_dat['mteacher']?"selected":""?>><?=$_dat['mteacher']?></option>
				<? } ?>
			</select>
	  		<input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		 </font>
	   </td>
    </tr>
  </table>
  </form>
<? if(isset($_POST['search']) && $_POST['mteacher']==""){ ?>
		<br/><br/><font color="#FF0000"><center>กรุณาเลือก ครูผู้ควบคุมนักเรียน ก่อน</center></font>
<? } ?>  
 <? if(isset($_POST['search']) && $_POST['mteacher'] != "") { ?>
  <table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <th colspan="6" align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			สรุปพฤติกรรมที่พึงประสงค์โดย "<?=$_POST['mteacher']!=""?"ของ" . $_POST['mteacher']:""?>" เป็นผู้ควบคุม ดูแล<br/>
			ประจำภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
	  </th>
    </tr>
    <tr> 
		<td class="key" width="40px" align="center">เลขที่</td>
      	<td class="key" width="80px" align="center">เลขประจำตัว</td>
      	<td class="key" width="190px" align="center">ชื่อ - นามสกุล</td>
		<td class="key" width="50px" align="center">ห้อง</td>
		<td class="key" align="center" width="80px">คะแนน<br/>ความประพฤติ</td>
		<td class="key" width="350px" align="center">พฤติกรรมที่พึงประสงค์</td>
    </tr>
	<?php
		$sqlStudent = "select a.id,prefix,firstname,lastname,nickname,xlevel,xyearth,room,points,b.id as num_id,mdesc,place,mdate
						 from students a right outer join student_moral b
						 	on a.id = b.student_id
						 where mteacher = '" .$_POST['mteacher'] . "'
						 		and xedbe = '" . $acadyear . "'
								and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' ";
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		$sqlStudent .= " order by xlevel,xyearth,a.id,sex,mdate ";
		
		$resStudent = mysql_query($sqlStudent);
		$ordinal = 1;
		$totalRows = mysql_num_rows($resStudent);
		$_xID = "";
		for($i = 0; $i < $totalRows ; $i++)
		{ $dat = mysql_fetch_array($resStudent); ?>
			<? if($dat['id'] != $_xID) { $_xID = $dat['id']; ?>
				<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
					<td align="center" valign="top"><?=$ordinal++?></td>
					<td align="center" valign="top"><a href='index.php?option=module_moral/addMoral&acadsemester=<?=$acadsemester?>&acadyear=<?=$acadyear?>&studentid=<?=$dat['id']?>' ><?=$dat['id']?></a></td>
					<td valign="top"><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
					<td align="center" valign="top"><?=$dat['xlevel']==3?$dat['xyearth']:($dat['xyearth']+3)?>/<?=$dat['room']?></td>
					<td align="center" valign="top"><?=displayPoint($dat['points'])?></td>
					<td>- <a href="index.php?option=module_moral/moralFull&num_id=<?=$dat['num_id']?>&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>"><?=$dat['mdesc']?></a></td>
				</tr>
			<? } else { ?>
				<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
					<td align="center"></td><td align="center"></td><td></td>
					<td align="center"></td><td></td>
					<td>- <a href="index.php?option=module_moral/moralFull&num_id=<?=$dat['num_id']?>&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>"><?=$dat['mdesc']?></a></td>
				</tr>
			<? } //end if-else ?>
		<? } //end for?>
</table>
<? } //end if ?>
</div>


