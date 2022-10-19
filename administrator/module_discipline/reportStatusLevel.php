
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.2 รายงานสรุปพฤติกรรมไม่พึงประสงค์<br/>ตามสถานะการดำเนินการตามระดับชั้น</strong></font></span></td>
      <td align="left" width="360px">
		<?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา <?php  
					echo "<a href=\"index.php?option=module_discipline/reportStatusLevel&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/reportStatusLevel&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_discipline/reportStatusLevel&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_discipline/reportStatusLevel&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<form name="myform" method="post">
		<font color="#000000" size="2" >
			 <input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> onclick="document.myform.submit();" />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา <br/>
			  <input type="checkbox" name="split" value="split" <?=$_POST['split']=="split"?"checked='checked'":""?> onclick="document.myform.submit();" />
			 ไม่นับรวมการขาด สาย ลา กิจกรรมหน้าเสาธง
		  </font>
		  </form>
	  </td>
    </tr>
  </table>
<br/>
<? $_sql = "select xlevel,xyearth,
			  sum(if(dis_status=0,1,0)) as 'a',
			  sum(if(dis_status=1,1,0)) as 'b',
			  sum(if(dis_status=2,1,0)) as 'c',
			  sum(if(dis_status=3,1,0)) as 'd',
			  sum(if(dis_status=4,1,0)) as 'e',
			  sum(if(dis_status=5,1,0)) as 'f',
			  sum(if(dis_status=6 || dis_status=0,1,0)) as 'g',
			  count(dis_status) as 'total'
			from students right outer join student_disciplinestatus
			on (id = student_id)
			where xedbe = '" . $acadyear . "' and acadyear = '" . $acadyear . "'
			and acadsemester = '" . $acadsemester . "' "; ?>
<? if($_POST['studstatus']=="1,2"){ $_sql .= " and studstatus in (1,2) "; } ?>
<? if($_POST['split']=="split"){$_sql.= " and dis_id in (select dis_id from student_discipline where dis_detail not like '%การเข้าร่วมกิจกรรมหน้าเสาธง%')";}?>
<? $_sql .= " group by xlevel,xyearth";?>
<? $_res = @mysql_query($_sql); ?>
<? if(mysql_num_rows($_res) > 0){ ?>
	<div align="center">
		<table class="admintable" align="center">
			<tr>
				<th colspan="9" align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>รายงานพฤติกรรมไม่พึงประสงค์ตามสถานะการดำเนินคดี
					<br/>ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
				</th>
			</tr>
			<tr>
				<td class="key" align="center" width="65px">ระดับชั้น</td>
				<td class="key" align="center" width="70px">คดีเข้าใหม่</td>
				<td class="key" align="center" width="80px">ดำเนินการสอบสวนแล้ว</td>
				<td class="key" align="center" width="80px">แจ้งบทลงโทษแล้ว</td>
				<td class="key" align="center" width="80px">อยู่ระหว่างกำกับติดตาม</td>
				<td class="key" align="center" width="100px">อยู่ระหว่างการพิจารณาหักคะแนน</td>
				<td class="key" align="center" width="70px">ปิดคดี</td>
				<td class="key" align="center" width="100px">รวม</td>
			</tr>
			<? $_b;$_c;$_d;$_e;$_f;$_g;$_total; ?>
			<? while($_dat = mysql_fetch_assoc($_res)){ ?>
			<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF" >
				<td align="center">ม.<?=$_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3?></td>
				<td align="right" style="padding-right:20px"><?=$_dat['b']>0?number_format($_dat['b'],0,'',','):"-"?></td>
				<td align="right" style="padding-right:20px"><?=$_dat['c']>0?number_format($_dat['c'],0,'',','):"-"?></td>
				<td align="right" style="padding-right:20px"><?=$_dat['d']>0?number_format($_dat['d'],0,'',','):"-"?></td>
				<td align="right" style="padding-right:20px"><?=$_dat['e']>0?number_format($_dat['e'],0,'',','):"-"?></td>
				<td align="right" style="padding-right:20px"><?=$_dat['f']>0?number_format($_dat['f'],0,'',','):"-"?></td>
				<td align="right" style="padding-right:20px"><?=$_dat['g']>0?number_format($_dat['g'],0,'',','):"-"?></td>
				<th align="right" style="padding-right:20px"><?=$_dat['total']>0?number_format($_dat['total'],0,'',','):"-"?></th>
			</tr>
			<? $_b+=$_dat['b']; $_c+=$_dat['c']; $_d+=$_dat['d']; $_e+=$_dat['e']; $_f+=$_dat['f']; $_g+=$_dat['g']; $_total+=$_dat['total']; ?>
			<? } //end while ?>
			<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#F6F6F6" height="35px">
				<td align="center" class="key" >รวม</td>
				<td align="right"  class="key" style="padding-right:20px"><?=$_b>0?number_format($_b,0,'',','):"-"?></td>
				<td align="right"  class="key" style="padding-right:20px"><?=$_c>0?number_format($_c,0,'',','):"-"?></td>
				<td align="right"  class="key" style="padding-right:20px"><?=$_d>0?number_format($_d,0,'',','):"-"?></td>
				<td align="right"  class="key" style="padding-right:20px"><?=$_e>0?number_format($_e,0,'',','):"-"?></td>
				<td align="right"  class="key" style="padding-right:20px"><?=$_f>0?number_format($_f,0,'',','):"-"?></td>
				<td align="right"  class="key" style="padding-right:20px"><?=$_g>0?number_format($_g,0,'',','):"-"?></td>
				<td align="right"  class="key" style="padding-right:20px"><?=$_total>0?number_format($_total,0,'',','):"-"?></td>
			</tr>
		</table>
     </div>
<? } else { ?><center><font color="#FF0000"><br/>ไม่พบข้อมูลในภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?></font></center><? } ?>
</div>
