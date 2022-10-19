<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_maps/index"><img src="../images/add.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">แผนที่ติดตามที่อยู่</font></strong><br />
			<span class="normal"><font color="#0066FF"><strong>1.1.4 รายชื่อนักเรียนตามวิธีการเดินทางมาโรงเรียน</strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			else if(isset($_POST['acadyear'])){ $acadyear = $_POST['acadyear']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_maps/studentListTravelBy&acadyear=" . ($acadyear - 1) .  "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_maps/studentListTravelBy&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
		<font color="#000000" size="2">
		เลือกวิธีการเดินทาง
			<? $_resTravel = mysql_query("select * from ref_travel order by 1"); ?>
			<select name="travelby" class="inputboxUpdate">
				<option value=""></option>
				<? while($_datTravel = mysql_fetch_assoc($_resTravel)) { ?>
					<option value="<?=$_datTravel['travel_id']?>" <?=$_POST['travelby']==$_datTravel['travel_id']?"selected":""?>><?=$_datTravel['travel_description']?></option>
				<? } //end-while ?>
				<? mysql_free_result($_resTravel); ?>
			</select> 
			เพศ
			<select name="sex" class="inputboxUpdate">
				<option value=""></option>
				<option value="1" <?=isset($_POST['sex']) && $_POST['sex']==1?"selected":""?>>ชาย</option>
				<option value="2" <?=isset($_POST['sex']) && $_POST['sex']==2?"selected":""?>>หญิง</option>
				<option value="all" <?=isset($_POST['sex']) && $_POST['sex']=="all"?"selected":""?>>ทั้งหมด</option>
			</select>
	  		 <br/>
			<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา 
			 <input type="submit" value="เรียกดู" class="button" name="search"/>
			</font>
	   </td>
    </tr>
  </table>
  </form>
<br/>
<? if(isset($_POST['search']) && ($_POST['travelby'] == "" || $_POST['sex'] =="")){ ?>
		<center><font color="#FF0000"><br/>กรุณาเลือก วิธีการเดินทาง ที่ต้องการเรียกดูข้อมูลก่อน</font></center>
<? } //end if ?>


<? if(isset($_POST['search']) && $_POST['travelby'] != "" && $_POST['sex'] != "") { ?>
  <table class="admintable" align="center">
    <tr> 
      <th colspan="8" align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			รายชื่อนักเรียนที่เดินทางมาโรงเรียนโดย :  <?=displayTravel($_POST['travelby'])?><br/>
			ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?></th>
    </tr>
    <tr> 
		<td class="key" width="40px" align="center">เลขที่</td>
      	<td class="key" width="75px" align="center">เลขประจำตัว</td>
      	<td class="key" width="200px" align="center">ชื่อ - นามสกุล</td>
		<td class="key" width="35px" align="center">ห้อง</td>
      	<td class="key" width="100px"  align="center">สถานภาพ<br/>ปัจจุบัน</td>
		<td class="key" width="150px" align="center">หมู่บ้าน</td>
      	<td class="key" width="80px" align="center">เวลาที่ใช้<br/>(นาที)</td>
      	<td class="key" width="70px"  align="center">-</td>
    </tr>
	<?php
		$sqlStudent = "select id,prefix,firstname,lastname,xlevel,xyearth,room,
								howlong,p_village,utm_coordinate_x,utm_coordinate_y,studstatus
						 from students 
						 where xedbe = '" . $acadyear . "' and travelby = '" . $_POST['travelby'] . "' ";
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		if($_POST['sex']!="all") $sqlStudent .= " and sex = '" . $_POST['sex'] . "' ";
		$sqlStudent .= " order by xlevel,xyearth,room,sex ,id ";
		$resStudent = mysql_query($sqlStudent);
		$ordinal = 1; ?>
		<? if(mysql_num_rows($resStudent)>0) { ?>
			<? while($dat = mysql_fetch_assoc($resStudent)) { ?>
				<tr>
					<td align="center"><?=$ordinal++?></td>
					<td align="center"> <? if($_SESSION['superAdmin']) { echo "<a href='index.php?option=module_maps/updatemaps&report=studentListTravelBy&travelby=" . $_POST['travelby'] . "&acadyear=" . $acadyear . "&student_id=" . $dat['id'] ."&sex=".$_POST['sex']."'>" . $dat['id'] . "</a>";}
											else {echo $dat['id'] ;} ?> </td>
					<td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
					<td align="center"><?=($dat['xlevel']==3?$dat['xyearth']:$dat['xyearth']+3) . '/' . $dat['room']?></td>
					<td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
					<td><?=($dat['p_village']!=""?$dat['p_village']:"-")?></td>
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
			<? }//end while?>
		<? } else { ?> <tr><td colspan="9" align="center"><br/><br/><font color="#FF0000">ไม่พบข้อมูลที่สืบค้นตามเงื่อนไข</font></td></tr> <? } ?>
</table>
<? }  //end if check $_POST['p_village'] ?> 
</div>


