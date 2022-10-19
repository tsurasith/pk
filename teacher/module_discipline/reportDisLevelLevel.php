
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.6 รายงานสรุปพฤติกรรมไม่พึงประสงค์<br/>ตามระดับโทษความผิดตามระดับชั้น</strong></font></span></td>
      <td align="left" width="360px">
		<?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา <?php  
					echo "<a href=\"index.php?option=module_discipline/reportDisLevelLevel&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/reportDisLevelLevel&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_discipline/reportDisLevelLevel&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_discipline/reportDisLevelLevel&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<form name="myform" method="post">
		<font color="#000000" size="2">
			 <input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> onclick="document.myform.submit();" />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา<br/>
			 <input type="checkbox" name="split" value="split" <?=$_POST['split']=="split"?"checked='checked'":""?> onclick="document.myform.submit();" />
			 ไม่นับรวมการขาด สาย ลา กิจกรรมหน้าเสาธง
		  </font>
		  </form>
	  </td>
    </tr>
    <tr>
    	<td colspan="3">
        	<font size="2" color="#000000">
            	<u>คำชี้แจง</u> - รายงานนี้จะนับเฉพาะคดีที่มีสถานะตั้งแต่สอบสวนคดีเสร็จสิ้นแล้วจนถึงสถานะปิดคดี
            </font>
        </td>
    </tr>
  </table>
<br/>
<? $_sql = "select xlevel,xyearth,
			  sum(if(c.dis_level='10',1,0)) as 'a',
			  sum(if(c.dis_level='11',1,0)) as 'b',
			  sum(if(c.dis_level='12',1,0)) as 'c',
			  sum(if(c.dis_level='13',1,0)) as 'd',
			  count(c.dis_level) as 'total'
			from students right outer join student_disciplinestatus b
			on (id = b.student_id) right outer join student_investigation c
			on (b.dis_id = c.dis_id)
			where xedbe = '" . $acadyear . "' and b.acadyear = '" . $acadyear . "' and c.dis_level != '00' 
			and b.acadsemester = '" . $acadsemester . "' "; ?>
<? if($_POST['studstatus']=="1,2"){ $_sql .= " and studstatus in (1,2) "; } ?>
<? if($_POST['split']=="split"){$_sql.= " and b.dis_id in (select dis_id from student_discipline where dis_detail not like '%การเข้าร่วมกิจกรรมหน้าเสาธง%')";}?>
<? $_sql .= " group by xlevel,xyearth";?>
<? $_res = @mysql_query($_sql); ?>
<? if(mysql_num_rows($_res) > 0){ ?>
	<div align="center">
		<table class="admintable" align="center">
			<tr>
				<th colspan="6" align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>รายงานพฤติกรรมไม่พึงประสงค์ตามตามระดับโทษความผิด
					<br/>ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
				</th>
			</tr>
			<tr>
				<td class="key" align="center" width="65px">ห้อง</td>
				<td class="key" align="center" width="80px">สถานเบา</td>
				<td class="key" align="center" width="80px">สถานปานกลาง</td>
				<td class="key" align="center" width="80px">สถานหนัก</td>
				<td class="key" align="center" width="80px">สถานหนักมาก</td>
				<td class="key" align="center" width="100px">รวม</td>
			</tr>
			<? $_a;$_b;$_c;$_d; $_total; ?>
			<? while($_dat = mysql_fetch_assoc($_res)){ ?>
			<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF" >
				<td align="center">ม.<?=$_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3?></td>
				<td align="right" style="padding-right:20px"><?=$_dat['a']>0?$_dat['a']:"-"?></td>
				<td align="right" style="padding-right:20px"><?=$_dat['b']>0?$_dat['b']:"-"?></td>
				<td align="right" style="padding-right:20px"><?=$_dat['c']>0?$_dat['c']:"-"?></td>
				<td align="right" style="padding-right:20px"><?=$_dat['d']>0?$_dat['d']:"-"?></td>
				<th align="right" style="padding-right:20px"><?=$_dat['total']>0?number_format($_dat['total'],0,'',','):"-"?></th>
			</tr>
			<? $_a+=$_dat['a']; $_b+=$_dat['b']; $_c+=$_dat['c']; $_d+=$_dat['d'];  $_total+=$_dat['total']; ?>
			<? } //end while ?>
			<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#F6F6F6" height="35px">
				<td align="center" class="key">รวม</td>
				<td align="right"  class="key" style="padding-right:20px"><?=$_a>0?number_format($_a,0,'',','):"-"?></td>
				<td align="right"  class="key" style="padding-right:20px"><?=$_b>0?number_format($_b,0,'',','):"-"?></td>
				<td align="right"  class="key" style="padding-right:20px"><?=$_c>0?$_c:"-"?></td>
				<td align="right"  class="key" style="padding-right:20px"><?=$_d>0?$_d:"-"?></td>
				<td align="right"  class="key" style="padding-right:20px"><?=$_total>0?number_format($_total,0,'',','):"-"?></td>
			</tr>
		</table>
      </div>
<? } else { ?><center><font color="#FF0000"><br/>ไม่พบข้อมูลในภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?></font></center><? } ?>
</div>
