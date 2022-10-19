<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_maps/index"><img src="../images/add.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">แผนที่ติดตามที่อยู่</font></strong><br />
		<span class="normal"><font color="#0066FF"><strong>1.1.3 รายชื่อนักเรียนตามตำบล</strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			else if(isset($_POST['acadyear'])){ $acadyear = $_POST['acadyear']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_maps/studentListTumbol&acadyear=" . ($acadyear - 1) .  "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_maps/studentListTumbol&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/><font color="#000000" size="2">
			เลือกตำบล
			<select name="p_tumbol" class="inputboxUpdate"> 
				<?	$_resultVillage = mysql_query("select distinct trim(p_tumbol) as p_tumbol from students where xEDBE = '" . $acadyear . "' order by 1");
					while($_datVillage = mysql_fetch_assoc($_resultVillage))
					{  ?>
						<option value="<?=$_datVillage['p_tumbol']?>" <?=isset($_POST['p_tumbol'])&&$_POST['p_tumbol']==$_datVillage['p_tumbol']?"selected":""?> > <?=$_datVillage['p_tumbol']?> </option>
				<?	} mysql_free_result($_resultVillage) ?>
			</select> 
			เพศ
			<select name="sex" class="inputboxUpdate">
				<option value=""></option>
				<option value="1" <?=isset($_POST['sex']) && $_POST['sex']==1?"selected":""?>>ชาย</option>
				<option value="2" <?=isset($_POST['sex']) && $_POST['sex']==2?"selected":""?>>หญิง</option>
				<option value="all" <?=isset($_POST['sex']) && $_POST['sex']=="all"?"selected":""?>>ทั้งหมด</option>
			</select>
	  		<input type="submit" value="เรียกดู" class="button" name="search"/><br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> /> เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา </font>
	   </td>
    </tr>
  </table>
  </form>
<? if(isset($_POST['search']) && $_POST['sex'] == ""){ ?>
	<br/><br/><center><font color="#FF0000">กรุณาเลือก ตำบล และ เพศ ที่ต้องการทราบข้อมูลก่อน</font></center>
<? } //end if ?>

<? if(isset($_POST['p_tumbol']) && $_POST['sex'] != "") { ?>
  <table class="admintable" align="center">
    <tr> 
      <th colspan="9" align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			รายชื่อนักเรียนตำบล  <?=$_POST['p_tumbol']; ?><br/>
			ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?></th>
    </tr>
    <tr> 
		<td class="key" width="30px" align="center">ที่</td>
      	<td class="key" width="70px" align="center">เลขประจำตัว</td>
      	<td class="key" width="180px" align="center">ชื่อ - นามสกุล</td>
		<td class="key" width="40px" align="center">ห้องเรียน</td>
      	<td class="key" width="80px"  align="center">สถานภาพ<br/>ปัจจุบัน</td>
		<td class="key" width="100px" align="center">หมู่บ้าน</td>
		<td class="key" width="140px" align="center">การเดินทาง<br/>มาโรงเรียน</td>
      	<td class="key" width="40px" align="center">เวลาที่ใช้<br/>(นาที)</td>
      	<td class="key" width="40px"  align="center">แผนที่</td>
    </tr>
	<? $sqlStudent = "select id,prefix,firstname,lastname,xlevel,xyearth,room,p_village,
								howlong,travelby,utm_coordinate_x,utm_coordinate_y,studstatus
						 from students  where xedbe = '" . $acadyear . "' and trim(p_tumbol) = '" . $_POST['p_tumbol'] . "'";
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		if($_POST['sex']!="all") $sqlStudent .= " and sex = '" . $_POST['sex'] . "' ";
		$sqlStudent .= " order by xlevel,xyearth,room,sex ";
		$resStudent = mysql_query($sqlStudent); ?>
	<? if(mysql_num_rows($resStudent)>0){ ?>
	<? $ordinal = 1; ?>
	<? while($dat = mysql_fetch_assoc($resStudent)){ ?>
		<tr>
			<td align="center"><?=$ordinal++?></td>
			<td align="center">
			<? if($_SESSION['superAdmin']) { echo "<a href='index.php?option=module_maps/updatemaps&report=studentListTumbol&acadyear=" . $acadyear . "&student_id=" . $dat['id'] ."&sex=". $_POST['sex'] . "&p_tumbol=".$_POST['p_tumbol']."'>" . $dat['id'] . "</a>";}
			   else { echo $dat['id'] ;} ?>
			</td>
			<td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
			<td align="center"><?=($dat['xlevel']==3?$dat['xyearth']:$dat['xyearth']+3) . '/' . $dat['room']?></td>
			<td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
			<td><?=$dat['p_village']?></td>
			<td><?=displayTravel($dat['travelby'])?></td>
			<td align="center"><?=$dat['howlong']?></td>
			<td align="center">
					<? if(trim($dat['utm_coordinate_x']) != "" && trim($dat['utm_coordinate_y']) != ""){ ?>
                    	<a href="module_maps/maps.php?id=<?=$dat['id']?>
                        		&stName=<?=$dat['prefix'].$dat['firstname'].'%20'.$dat['lastname']?>
                                &p_village=<?=$dat['p_village']?>
                                &lat=<?=$dat['utm_coordinate_x']?>
                                &long=<?=$dat['utm_coordinate_y']?>" target="_blank">แผนที่</a>
                    <? }else { ?>
                    	-
                    <? } ?>
				</td>
		</tr>
	<? } //end while?>
	<tr>
		<td colspan="9"><a href="module_maps/ztestMapTumbol.php?village=<?=$_POST['p_tumbol']?>&acadyear=<?=$acadyear?>" target="_blank">ดูแผนที่่ตามตำบล</a></td>
	</tr>
	<? }else{ ?> 
	<tr><td colspan="9" align="center"><br/><br/><font color="#FF0000">ไม่พบข้อมูลที่สืบค้นตามเงื่อนไข</font></td></tr>
	<? }?>
</table>
<? }  //end if check $_POST['p_village'] ?> 
</div>

