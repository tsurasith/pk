<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_maps/index"><img src="../images/add.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">แผนที่ติดตามที่อยู่</font></strong><br />
			<span class="normal"><font color="#0066FF"><strong>2.3.2 สารสนเทศจำนวนนักเรียนตามตำบล<br/> แยกตามเพศและระดับการศึกษา</strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_maps/reportNumberTumbolSex&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_maps/reportNumberTumbolSex&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
	  	<font color="#000000" size="2">
		เลือกระดับการศึกษา
		  	<select name="xlevel" class="inputboxUpdate">
		  		<option value=""></option>
				<option value="3" <?=isset($_POST['xlevel'])&&$_POST['xlevel']=="3"?"selected":""?>> มัธยมศึกษาตอนต้น </option>
				<option value="4" <?=isset($_POST['xlevel'])&&$_POST['xlevel']=="4"?"selected":""?>> มัธยมศึกษาตอนปลาย </option>
			</select>  
	  		<input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			 </font>
	   </td>
    </tr>
  </table>
  </form>
<? if(isset($_POST['search']) && $_POST['xlevel'] == ""){ ?>
		<center><font color="#FF0000"><br/>กรุณาเลือก ระดับการศึกษา ที่ต้องการเรียกดูข้อมูลก่อน</font></center>
<? } //end if ?>
 <?php
  $_sql = "";
  if($_POST['xlevel'] !="" && isset($_POST['search'])) {
	$_sql = "select p_tumbol,
				  sum(if(sex=1 and xyearth=1,1,0)) as 'm1',
				  sum(if(sex=2 and xyearth=1,1,0)) as 'f1',
				  sum(if(sex=1 and xyearth=2,1,0)) as 'm2',
				  sum(if(sex=2 and xyearth=2,1,0)) as 'f2',
				  sum(if(sex=1 and xyearth=3,1,0)) as 'm3',
				  sum(if(sex=2 and xyearth=3,1,0)) as 'f3',
				  count(*) as 'total'
				from students where xedbe = '" . $acadyear . "' ";
	if($_POST['xlevel']!="all"){ $_sql .= " and xlevel = '" . $_POST['xlevel'] . "' "; }
	if($_POST['studstatus']=="1,2"){ $_sql .= " and studstatus in (1,2) ";}
	$_sql .= " group by p_tumbol order by count(*) desc ";
 	$_result = mysql_query($_sql);
	if(mysql_num_rows($_result)>0) {
  ?>
  <table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <th align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			รายงานแสดงจำนวนนักเรียนตามตำบลและสถานภาพของนักเรียน <br/>
			<?=$_POST['xlevel']==3?"ชั้นมัธยมศึกษาตอนต้น":"ชั้นมัธยมศึกษาตอนปลาย"?><br/>
			ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
	  </th>
    </tr>
	<tr>
		<td align="center">
			<table class="admintable">
				<tr> 
					<td class="key" width="150px" align="center" rowspan="3">หมู่บ้าน</td>
					<td class="key" align="center" colspan="6">ระดับชั้น/เพศ</td>
					<td class="key" width="80px" align="center" rowspan="3">รวม</td>
				</tr>
				<tr>
					<td class="key" align="center" colspan="2">ม.<?=$_POST['xlevel']==3?1:4?></td>
					<td class="key" align="center" colspan="2">ม.<?=$_POST['xlevel']==3?2:5?></td>
					<td class="key" align="center" colspan="2">ม.<?=$_POST['xlevel']==3?3:6?></td>
				</tr>
				<tr>
					<td class="key" width="70px" align="center">ชาย</td>
					<td class="key" width="70px" align="center">หญิง</td>
					<td class="key" width="70px" align="center">ชาย</td>
					<td class="key" width="70px" align="center">หญิง</td>
					<td class="key" width="70px" align="center">ชาย</td>
					<td class="key" width="70px" align="center">หญิง</td>
				</tr>
				<?  $_a=0;$_b=0;$_c=0;$_d=0;$_e=0;$_f=0;$_g=0; ?>
				<?	while($_dat = mysql_fetch_assoc($_result)){ ?>
					<tr bgcolor="#FFFFFF">
						<td style="padding-left:10px;" align="left"><?=$_dat['p_tumbol']!=""?$_dat['p_tumbol']:"-"?></td>
						<td style="padding-right:15px;" align="right"><?=$_dat['m1']==0?"-":$_dat['m1']?></td>
						<td style="padding-right:15px;" align="right"><?=$_dat['f1']==0?"-":$_dat['f1']?></td>
						<td style="padding-right:15px;" align="right"><?=$_dat['m2']==0?"-":$_dat['m2']?></td>
						<td style="padding-right:15px;" align="right"><?=$_dat['f2']==0?"-":$_dat['f2']?></td>
						<td style="padding-right:15px;" align="right"><?=$_dat['m3']==0?"-":$_dat['m3']?></td>
						<td style="padding-right:15px;" align="right"><?=$_dat['f3']==0?"-":$_dat['f3']?></td>
						<td style="padding-right:15px;" align="right"><?=$_dat['total']==0?"-":$_dat['total']?></td>
					</tr>	
				<? $_a+=$_dat['m1'];$_b+=$_dat['f1'];$_c+=$_dat['m2'];$_d+=$_dat['f2'];$_e+=$_dat['m3'];$_f+=$_dat['f3'];$_g+=$_dat['total'] ?>
				<?	} mysql_free_result($_result); ?>
					<tr height="30px">
						<td class="key" align="center">รวม</td>
						<td class="key" style="padding-right:15px;" align="right"><?=$_a>0?number_format($_a,0,'',','):"-"?></td>
						<td class="key" style="padding-right:15px;" align="right"><?=$_b>0?number_format($_b,0,'',','):"-"?></td>
						<td class="key" style="padding-right:15px;" align="right"><?=$_c>0?number_format($_c,0,'',','):"-"?></td>
						<td class="key" style="padding-right:15px;" align="right"><?=$_d>0?number_format($_d,0,'',','):"-"?></td>
						<td class="key" style="padding-right:15px;" align="right"><?=$_e>0?number_format($_e,0,'',','):"-"?></td>
						<td class="key" style="padding-right:15px;" align="right"><?=$_f>0?number_format($_f,0,'',','):"-"?></td>
						<td class="key" style="padding-right:15px;" align="right"><?=$_g>0?number_format($_g,0,'',','):"-"?></td>
					</tr>
			</table>
		</td>
	</tr>
</table>
<? }} // end if
	else
	{ } // end else ?>  
</div>
