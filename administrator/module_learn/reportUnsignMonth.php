
<div id="content">

  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_learn/index"><img src="../images/history.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Room Tracking</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.3 รายงานจำนวนครูไม่ลงชื่อเข้าสอน<br/>ตามระดับห้องเรียนรายคาบ [รายเดือน]</strong></font></span></td>
      <td >
	  	 ปีการศึกษา
        <?php  
			if(isset($_REQUEST['acadyear']))
			{
				$acadyear = $_REQUEST['acadyear'];
			}
			if(isset($_REQUEST['acadsemester']))
			{
				$acadsemester = $_REQUEST['acadsemester'];
			}
					echo "<a href=\"index.php?option=module_learn/reportUnsignMonth&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_learn/reportUnsignMonth&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
        ภาคเรียนที่ 
        <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_learn/reportUnsignMonth&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_learn/reportUnsignMonth&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>	<br/>
		 <font  size="2" color="#000000">
		 <form action="" method="post">
		 	เลือกเดือน 
			<select name="month" class="inputboxUpdate">
			 	<option value=""></option>
				<?php
					$_sqlMonth = "select distinct month(check_date)as m,year(check_date)+543 as y
									from student_learn where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
									order by year(check_date),month(check_date)";
					$_resMonth = mysql_query($_sqlMonth);
					while($_datMonth = mysql_fetch_assoc($_resMonth))
					{
						$_select = (isset($_POST['month'])&&$_POST['month'] == $_datMonth['m']?"selected":"");
						echo "<option value=\"" . $_datMonth['m'] . "\" $_select >" . displayMonth($_datMonth['m']) . ' ' . $_datMonth['y'] . "</option>";
					} mysql_free_result($_resMonth);
				?>
		   </select> <input type="submit" name="search" value="เรียกดู" class="button" />
		 </form>
		 </font>
	  </td>
    </tr>
  </table>

<? if(isset($_POST['search'])){ ?>
<?	$_sql = "select room_id,
			  sum(if(period = 1 and stutus = 'unsign',1,null)) as p1,
			  sum(if(period = 2 and stutus = 'unsign',1,null)) as p2,
			  sum(if(period = 3 and stutus = 'unsign',1,null)) as p3,
			  sum(if(period = 4 and stutus = 'unsign',1,null)) as p4,
			  sum(if(period = 5 and stutus = 'unsign',1,null)) as p5,
			  sum(if(period = 6 and stutus = 'unsign',1,null)) as p6,
			  sum(if(period = 7 and stutus = 'unsign',1,null)) as p7,
			  sum(if(period = 8 and stutus = 'unsign',1,null)) as p8
			from teachers_learn
			where acadyear = '" . $acadyear ."' and acadsemester = '" . $acadsemester ."' and month(check_date) = '" . $_POST['month'] ."'
			group by room_id order by room_id";
	$_res = mysql_query($_sql); ?>
	<? if(@mysql_num_rows($_res)>0) { ?>
			<table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center">
			<tr>
			<th colspan="10" align="center">
				<img src="../images/school_logo.gif" width="120px">
				<br/>
				การไม่ลงชื่อเข้าสอนของครูผู้สอนจากแบบบันทึกการเข้าเรียนฝ่ายกิจการนักเรียน<br/>
				ประจำเดือน <?=displayMonth($_POST['month'])?> ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>			  </th>
			</tr>
			<tr> 
				<td class="key" width="180px" align="center" rowspan="2">ระดับชั้น</td>
				<td class="key" align="center" colspan="8">คาบเรียนที่</td>
				<td class="key" align="center" width="80px" rowspan="2">รวม</td>
			</tr>
			<tr align="center">
				<td class="key" width="45px">1</td>
				<td class="key" width="45px">2</td>
				<td class="key" width="45px">3</td>
				<td class="key" width="45px">4</td>
				<td class="key" width="45px">5</td>
				<td class="key" width="45px">6</td>
				<td class="key" width="45px">7</td>
				<td class="key" width="45px">8</td>
			</tr>
			<? $p1=0;$p2=0;$p3=0;$p4=0;$p5=0;$p6=0;$p7=0;$p8=0;?>
			<? while($_dat = mysql_fetch_assoc($_res)){ ?>
			<tr>
				<td align="center">มัธยมศึกษาปีที่ <?=getFullRoomFormat($_dat['room_id'])?></td>
				<td align="center"><b><?=$_dat['p1']!=0?$_dat['p1']:"-"?></b></td>
				<td align="center"><b><?=$_dat['p2']!=0?$_dat['p2']:"-"?></b></td>
				<td align="center"><b><?=$_dat['p3']!=0?$_dat['p3']:"-"?></b></td>
				<td align="center"><b><?=$_dat['p4']!=0?$_dat['p4']:"-"?></b></td>
				<td align="center"><b><?=$_dat['p5']!=0?$_dat['p5']:"-"?></b></td>
				<td align="center"><b><?=$_dat['p6']!=0?$_dat['p6']:"-"?></b></td>
				<td align="center"><b><?=$_dat['p7']!=0?$_dat['p7']:"-"?></b></td>
				<td align="center"><b><?=$_dat['p8']!=0?$_dat['p8']:"-"?></b></td>
                 <? $_sumP1P8 = ($_dat['p1']+$_dat['p2']+$_dat['p3']+$_dat['p4']+$_dat['p5']+$_dat['p6']+$_dat['p7']+$_dat['p8']);?>
				<td align="center"><b><?=$_sumP1P8==0?"-":$_sumP1P8;?></b></td>
			</tr>
			<?	$p1+=$_dat['p1']; $p2+=$_dat['p2']; $p3+=$_dat['p3']; $p4+=$_dat['p4']; $p5+=$_dat['p5']; $p6+=$_dat['p6']; $p7+=$_dat['p7']; $p8+=$_dat['p8'];?>
			<? } mysql_free_result($_res); //end while ?>
			<tr>
			  <td class="key" align="center"><font color="#990066"><b>รวม</b></font></td>
			  <td class="key" align="center"><font color="#990066"><b><?=$p1==0?"-":$p1?></b></font></td>
			  <td class="key" align="center"><font color="#990066"><b><?=$p2==0?"-":$p2?></b></font></td>
			  <td class="key" align="center"><font color="#990066"><b><?=$p3==0?"-":$p3?></b></font></td>
			  <td class="key" align="center"><font color="#990066"><b><?=$p4==0?"-":$p4?></b></font></td>
			  <td class="key" align="center"><font color="#990066"><b><?=$p5==0?"-":$p5?></b></font></td>
			  <td class="key" align="center"><font color="#990066"><b><?=$p6==0?"-":$p6?></b></font></td>
			  <td class="key" align="center"><font color="#990066"><b><?=$p7==0?"-":$p7?></b></font></td>
			  <td class="key" align="center"><font color="#990066"><b><?=$p8==0?"-":$p8?></b></font></td>
			  <td class="key" align="center"><font color="#990066"><b><?=($p1+$p2+$p3+$p4+$p5+$p6+$p7+$p8==0?"-":($p1+$p2+$p3+$p4+$p5+$p6+$p7+$p8))?></b></font></td>
			  </tr>
		 </table>
<?	} else { //end chekc_rows	 ?>
		<table width="100%" align="center">
			<tr>
				<td align="center"><font color="#FF0000"><br/>ไม่พบข้อมูลที่ค้นตามเงื่อนไข กรุณาทดลองใหม่อีกครั้ง</font></td>
			</tr>
		</table>
<?	} //end else ?>
<? } //end if($_POST[''] ?>  

</div>

