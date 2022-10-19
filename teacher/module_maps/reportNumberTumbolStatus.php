<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_maps/index"><img src="../images/add.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">แผนที่ติดตามที่อยู่</font></strong><br />
			<span class="normal"><font color="#0066FF"><strong>2.3.4 สารสนเทศตำบลที่นักเรียนอาศัย <br/>สถานภาพ แยกตามระดับการศึกษา</strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_maps/reportNumberTumbolStatus&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_maps/reportNumberTumbolStatus&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
	  	<font color="#000000" size="2">
		เลือกระดับการศึกษา
		  	<select name="xlevel" class="inputboxUpdate">
		  		<option value=""></option>
				<option value="3" <?=isset($_POST['xlevel'])&&$_POST['xlevel']=="3"?"selected":""?>> มัธยมศึกษาตอนต้น </option>
				<option value="4" <?=isset($_POST['xlevel'])&&$_POST['xlevel']=="4"?"selected":""?>> มัธยมศึกษาตอนปลาย </option>
				<option value="all" <?=isset($_POST['xlevel'])&&$_POST['xlevel']=="all"?"selected":""?>> ทั้งโรงเรียน </option>
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
	$_sql = "select trim(p_tumbol) as 'p_tumbol',
			  sum(if(studstatus=2,1,0)) as 'a',
			  sum(if(studstatus=1,1,0)) as 'b',
			  sum(if(studstatus=0,1,0)) as 'c',
			  sum(if(studstatus=5,1,0)) as 'd',
			  sum(if(studstatus=3,1,0)) as 'e',
			  sum(if(studstatus=4,1,0)) as 'f',
			  sum(if(studstatus=9,1,0)) as 'g',
			  count(studstatus) as 'sum'
			from students
				where xedbe = '" . $acadyear . "' ";
	if($_POST['xlevel']!="all"){ $_sql .= " and xlevel = '" . $_POST['xlevel'] . "' "; }
	if($_POST['studstatus']=="1,2"){ $_sql .= " and studstatus in (1,2) ";}
	$_sql .= " group by trim(p_tumbol) order by sum desc";
 	$_result = mysql_query($_sql);
	if(mysql_num_rows($_result)>0) {
  ?>
  <table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <th align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			รายงานแสดงจำนวนนักเรียนตามตำบลและสถานภาพของนักเรียน <br/>
			<?=$_POST['xlevel']==3?"ชั้นมัธยมศึกษาตอนต้น":($_POST['xlevel']==4?"ชั้นมัธยมศึกษาตอนปลาย":"ทั้งโรงเรียน")?><br/>
			ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
	  </th>
    </tr>
	<tr>
		<td align="center">
			<table bgcolor="#000000" cellspacing="1px">
				<tr bgcolor="#CCCCFF"> 
					<td width="150px" align="center" rowspan="2">ตำบล</td>
					<td align="center" colspan="7">จำนวนนักเรียนและสถานภาพ(คน)</td>
					<td width="80px" align="center" rowspan="2">รวม</td>
				</tr>
				<tr bgcolor="#ccccff">
					<td width="50px" align="center">จบ</td>
					<td width="50px" align="center">ปกติ</td>
					<td width="50px" align="center">ออก</td>
					<td width="50px" align="center">ย้าย</td>
					<td width="60px" align="center">แขวนลอย</td>
					<td width="70px" align="center">พักการเรียน</td>
					<td width="50px" align="center">เสียชีวิต</td>
				</tr>
				<?  $_a=0;$_b=0;$_c=0;$_d=0;$_e=0;$_f=0;$_g=0; ?>
				<?	while($_dat = mysql_fetch_assoc($_result)){ ?>
					<tr bgcolor="#FFFFFF">
						<td style="padding-left:10px;" align="left"><?=$_dat['p_tumbol']!=""?$_dat['p_tumbol']:"-"?></td>
						<td style="padding-right:15px;" align="right"><?=$_dat['a']==0?"-":number_format($_dat['a'],0,'.',',')?></td>
						<td style="padding-right:15px;" align="right"><?=$_dat['b']==0?"-":number_format($_dat['b'],0,'.',',')?></td>
						<td style="padding-right:15px;" align="right"><?=$_dat['c']==0?"-":$_dat['c']?></td>
						<td style="padding-right:15px;" align="right"><?=$_dat['d']==0?"-":$_dat['d']?></td>
						<td style="padding-right:15px;" align="right"><?=$_dat['e']==0?"-":$_dat['e']?></td>
						<td style="padding-right:15px;" align="right"><?=$_dat['f']==0?"-":$_dat['f']?></td>
						<td style="padding-right:15px;" align="right"><?=$_dat['g']==0?"-":$_dat['g']?></td>
						<td style="padding-right:15px;" align="right"><?=number_format($_dat['sum'],0,'.',',')?></td>
					</tr>	
				<? $_a+=$_dat['a'];$_b+=$_dat['b'];$_c+=$_dat['c'];$_d+=$_dat['d'];$_e+=$_dat['e'];$_f+=$_dat['f'];$_g+=$_dat['g'] ?>
				<?	} mysql_free_result($_result); ?>
					<tr bgcolor="#FFFFCC" height="30px">
						<th align="center">รวม</th>
						<th style="padding-right:15px;" align="right"><?=$_a>0?number_format($_a,0,'',','):"-"?></th>
						<th style="padding-right:15px;" align="right"><?=$_b>0?number_format($_b,0,'',','):"-"?></th>
						<th style="padding-right:15px;" align="right"><?=$_c>0?number_format($_c,0,'',','):"-"?></th>
						<th style="padding-right:15px;" align="right"><?=$_d>0?number_format($_d,0,'',','):"-"?></th>
						<th style="padding-right:15px;" align="right"><?=$_e>0?number_format($_e,0,'',','):"-"?></th>
						<th style="padding-right:15px;" align="right"><?=$_f>0?number_format($_f,0,'',','):"-"?></th>
						<th style="padding-right:15px;" align="right"><?=$_g>0?number_format($_g,0,'',','):"-"?></th>
						<th style="padding-right:15px;" align="right"><?=number_format($_a+$_b+$_c+$_d+$_e+$_f+$_g,0,'',',')?></th>
					</tr>
			</table>
		</td>
	</tr>
</table>
<? }} // end if
	else
	{ } // end else ?>  
</div>

