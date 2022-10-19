<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_moral/index"><img src="../images/objects.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">ระบบสารสนเทศธนาคารความดี</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>1.3.1 รายงานสรุปพฤติกรรมที่พึงประสงค์ของนักเรียน<br/>รายปีการศึกษา</strong></font></span></td>
		<td align="right">
	  <?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			else if(isset($_POST['acadyear'])){ $acadyear = $_POST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])){ $acadsemester = $_REQUEST['acadsemester']; }
			else if(isset($_POST['acadsemester'])){ $acadsemester = $_POST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_moral/reportStudentYear&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_moral/reportStudentYear&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
	  		<font color="#000000"  size="2" >
			ประเภทของกิจกรรม
			<? @$_resMtype = mysql_query("select * from ref_moral") ?>
			<select name="mtype" class="inputboxUpdate">
				<option value=""></option>
				<? while($_dat = mysql_fetch_assoc($_resMtype)) { ?>
				<option value="<?=$_dat['moral_id']?>" <?=(isset($_POST['mtype']) && $_POST['mtype'] == $_dat['moral_id'])?"selected":""?>><?=$_dat['moral_description']?></option>
				<? } ?>
				<option value="all" <?=$_POST['mtype']=="all"?"selected":""?>>รวมทุกประเภท</option>
			</select>
			<input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
		 </font>
	   </td>
    </tr>
  </table>
  </form>
<? if(isset($_POST['search']) && $_POST['mtype']==""){ ?>
		<br/><br/><font color="#FF0000"><center>กรุณาเลือก ประเภทกิจกรรม ที่ต้องการทราบข้อมูลก่อน</center></font>
<? } ?>  
 <? if(isset($_POST['search']) && $_POST['mtype'] != "") { ?>
		<? $_sql = "select * from student_moral where acadyear = '" . $acadyear . "' and student_id = '" . $_SESSION['username'] . "' " . ($_POST['mtype']!="all"?" and mtype = '" . $_POST['mtype'] . "'":"") . " order by mdate,acadsemester"; ?>
		<? $_res = mysql_query($_sql); ?>
		<? if(mysql_num_rows($_res)>0){ ?>
		  <table class="admintable" align="center">
			<tr> 
			  <th colspan="6" align="center">
					<img src="../images/school_logo.gif" width="120px"><br/>
					สรุปพฤติกรรมที่พึงประสงค์ของ "<?=$_SESSION['name']?><br/>
					ประเภทของพฤติกรรม : <?=displayMtype($_POST['mtype'])?> ปีการศึกษา <?=$acadyear?>
			  </th>
			</tr>
			<tr> 
				<td class="key" width="30px" align="center">ที่</td>
				<td class="key" width="100px" align="center">วันที่</td>
				<td class="key" width="65px" align="center">ภาคเรียน</td>
				<td class="key" width="400px" align="center">พฤติกรรมที่พึงประสงค์</td>
				<td class="key" width="200px" align="center">สถานที่/ผู้รับผิดชอบ</td>
				<td class="key" width="50px" align="center">คะแนน<br/>เพิ่ม</td>
			</tr>
			<? $ordinal=1;?>
			<? while($_dat = mysql_fetch_assoc($_res)){ ?>
				<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
					<td align="center" valign="top"><?=$ordinal++?></td>
					<td align="center" valign="top"><?=displayDate($_dat['mdate'])?></td>
					<td align="center" valign="top"><?=$_dat['acadsemester'].'/'.$_dat['acadyear']?></td>
					<td align="left" valign="top"><?=$_dat['mdesc']?></td>
					<td align="left" valign="top"><?=$_dat['place']?></td>
					<td align="center" valign="top"><?=$_dat['point']>0?"+".$_dat['point']:"-"?></td>
				</tr>
			<? } //end for?>
		</table>
	<? }else{?><br/><br/><font color="#FF0000"><center>ไม่พบข้อมูลที่ต้องการทราบตามเงื่อนไข</center></font> <? }?>
<? } //end if ?>
</div>
<?php
	function displayMtype($_value){
		switch($_value){
			case "00" : return "การบำเพ็ญประโยชน์"; break;
			case "01" : return "การเข้าร่วมกิจกรรม"; break;
			case "02" : return "การแข่งขันทักษะทางวิชาการ"; break;
			case "03" : return "การแข่งขันทักษะด้านกีฬา"; break;
			default : return "รวมทั้งทุกประเภทกิจกรรม";
		}
	}
	function displayStatus($id) {
		switch ($id) {
			case 0 :  return "<font color='red'><b>ออก</b></font>"; break;
			case 1 :  return "ปกติ"; break;
			case 2 :  return "<b>สำเร็จการศึกษา</b>"; break;
			case 3 :  return "<font color='red'><b>แขวนลอย</b></font>"; break;
			case 4 :  return "<font color='darkorange'><b>พักการเรียน</b></font>"; break;
			case 5 :  return "<font color='blue'><b>ย้ายสถานศึกษา</b></font>"; break;
			case 9 :  return "<font color='red'><b>เสียชีวิต</b></font>"; break;
			default : return " - ไม่ทราบ - ";
		}	
	}
	
	function displayRoom($_value) {
		switch ($_value){
			case "3/1": return "1" ; break;
			case "3/2": return "2" ; break;
			case "3/3": return "3" ; break;
			case "4/1": return "4" ; break;
			case "4/2": return "5" ; break;
			case "4/3": return "6" ; break;
			default : return "ทั้งโรงเรียน";
		}
	}
	
	function displayDate($date) {
		$txt = "" ;
		$_x = explode('-',$date,3);
		switch ($_x[1]) {
			case "01" : $txt = $txt . number_format($_x[2],0,'.','') . " ม.ค. " . ($_x[0] + 543) ;break;
			case "02" : $txt = $txt . number_format($_x[2],0,'.','') . " ก.พ. " . ($_x[0] + 543) ;break;
			case "03" : $txt = $txt . number_format($_x[2],0,'.','') . " มี.ค. " . ($_x[0] + 543) ;break;
			case "04" : $txt = $txt . number_format($_x[2],0,'.','') . " เม.ย. " . ($_x[0] + 543) ;break;
			case "05" : $txt = $txt . number_format($_x[2],0,'.','') . " พ.ค. " . ($_x[0] + 543) ;break;
			case "06" : $txt = $txt . number_format($_x[2],0,'.','') . " มิ.ย. " . ($_x[0] + 543) ;break;
			case "07" : $txt = $txt . number_format($_x[2],0,'.','') . " ก.ค. " . ($_x[0] + 543) ;break;
			case "08" : $txt = $txt . number_format($_x[2],0,'.','') . " ส.ค. " . ($_x[0] + 543) ;break;
			case "09" : $txt = $txt . number_format($_x[2],0,'.','') . " ก.ย. " . ($_x[0] + 543) ;break;
			case "10" : $txt = $txt . number_format($_x[2],0,'.','') . " ต.ค. " . ($_x[0] + 543) ;break;
			case "11" : $txt = $txt . number_format($_x[2],0,'.','') . " พ.ย. " . ($_x[0] + 543) ;break;
			case "12" : $txt = $txt . number_format($_x[2],0,'.','') . " ธ.ค. " . ($_x[0] + 543) ;break;
			default : $txt = $txt . "ผิดพลาด";
		}
		return $txt ;
	}
?>