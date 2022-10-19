<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_maps/index"><img src="../images/add.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">แผนที่ติดตามที่อยู่</font></strong><br />
			<span class="normal"><font color="#0066FF"><strong>1.2.1 ทำเนียบรูปภาพนักเรียนตามหมู่บ้าน</strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			else if(isset($_POST['acadyear'])) { $acadyear = $_POST['acadyear']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_maps/studentListPics&acadyear=" . ($acadyear - 1) .  "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_maps/studentListPics&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/><font color="#000000" size="2">เลือกหมู่บ้าน	 
			<select name="p_village" class="inputboxUpdate">
				<?	$_resultVillage = mysql_query("select distinct trim(p_village) as p_village from students where xEDBE = '" . $acadyear . "' order by 1");
					while($_datVillage = mysql_fetch_assoc($_resultVillage)) {  ?>
						<option value="<?=$_datVillage['p_village']?>" <?=isset($_POST['p_village'])&&$_POST['p_village']==$_datVillage['p_village']?"selected":""?> > <?=$_datVillage['p_village']?> </option>
				<?	} mysql_free_result($_resultVillage) ?>
			</select>
			<input type="submit" value="เรียกดู" class="button" name="search"/><br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> /> เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา</font>
	   </td>
    </tr>
  </table>
  </form>
<? if(isset($_POST['search'])){ ?>
<?php
		$sqlStudent = "select id,prefix,firstname,lastname,nickname,sex,studstatus,points,xlevel,xyearth,room,travelby
						from students 
						where p_village = '" . $_POST['p_village'] . "'
								and xedbe = '" . $acadyear . "' ";
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		$sqlStudent .= " order by xlevel,xyearth,room,sex,id";
		$resStudent = mysql_query($sqlStudent);
		$ordinal = 1; ?>
	<? if(mysql_num_rows($resStudent)>0) { ?>
		  <table class="admintable" align="center" width="800px">
			<tr>
				<th colspan="5" align="center">
					<img src="../images/school_logo.gif" width="120px"><br/>
					ทำเนียบนักเรียนหมู่บ้าน <?=$_POST['p_village']?> ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
				</th>
			</tr>
		<?	
				$totalRows = mysql_num_rows($resStudent);
				$_cols = 5;
				for($i = 0; $i < $totalRows/5 ; $i++)
				{
					echo "<tr height='205px'>";
					for($_j = 0 ; $_j < 5 ; $_j++)
					{
						if($ordinal > $totalRows) continue;
						$dat = mysql_fetch_array($resStudent);
						echo "<td align='center' width='160px'>";
						echo "<font color='red'><b>$ordinal</b></font>";
						if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/pk/images/studphoto/id" . $dat['id'] . ".jpg"))
							{ echo "<img src='../images/studphoto/id" . $dat['id'] . ".jpg' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #CC0CC0'/><br/>"; }
						else 
							{echo "<img src='../images/" . ($dat['sex']==1?"_unknown_male":"_unknown_female") . ".png' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #CC0CC0'/><br/>"; }
						echo "" . ($dat['xlevel']==3?$dat['xyearth']:$dat['xyearth']+3).'/'.$dat['room'] . '-' . $dat['id'] . "-[". displayPoint($dat['nickname']) . "]<br/>" ;
						echo "" . displayPrefix($dat['prefix']) . $dat['firstname'] . " " . $dat['lastname'] . "<br/>";
						echo "" . displayTravel($dat['travelby'])  ;
						//echo "" . displayStatus($dat['studstatus']) ;
						echo "</td>";
						$ordinal++;
					}
					echo "</tr>";
				}
			?>
		</table>
	<? }else {?><br/><br/><center><font color="#FF0000">ไม่มีข้อมูลตามเงื่อนไขที่ท่านเลือก</font></center><? } ?>
<? } //end check submit ?>  
</div>

