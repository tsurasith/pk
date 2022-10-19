

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>4.3 แผนภูมิเปรียบเทียบการลงชื่อกิจกรรมหน้าเสาธง<br/>ของครูที่ปรึกษา</strong></font></span></td>
      <td>
		<?php
			if(isset($_REQUEST['acadyear']))
			{
				$acadyear = $_REQUEST['acadyear'];
			}
			if(isset($_REQUEST['acadsemester']))
			{
				$acadsemester = $_REQUEST['acadsemester'];
			}
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_800/reportSemesterChartSign&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_800/reportSemesterChartSign&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_800/reportSemesterChartSign&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_800/reportSemesterChartSign&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<form action="" method="post">
		<font color="#000000" size="2"  >
		เลือกเดือน
			 <select name="month" class="inputboxUpdate">
			 	<option value=""> </option>
				<?php
					$_sqlMonth = "select distinct month(check_date)as m,year(check_date)+543 as y
									from student_800 where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
									order by year(check_date),month(check_date)";
					$_resMonth = mysql_query($_sqlMonth);
					while($_datMonth = mysql_fetch_assoc($_resMonth))
					{
						$_select = (isset($_POST['month'])&&$_POST['month'] == $_datMonth['m']?"selected":"");
						echo "<option value=\"" . $_datMonth['m'] . "\" $_select>" . displayMonth($_datMonth['m']) . ' ' . $_datMonth['y'] . "</option>";
					}
				?>
				<? if(mysql_num_rows($_resMonth)>0){ ?> <option value="all" <?=isset($_POST['month'])&&$_POST['month']=="all"?"selected":""?>>ทั้งหมด</option> <? } ?>
			 </select>
			 <input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
		  </font>
		  </form>
	  </td>
    </tr>
  </table>
<?php
		$_sql = "";
		if($_POST['month'] == "all")
		{
			$_sql = "SELECT room_id,
					  sum(if(stutus = 'sign',1,null)) as 'sign',
					  sum(if(stutus = 'unsign',1,null)) as 'unsign'
					 FROM teachers_800
					where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
					group by room_id";
		}
		else 
		{
			$_sql = "SELECT room_id,
					  sum(if(stutus = 'sign',1,null)) as 'sign',
					  sum(if(stutus = 'unsign',1,null)) as 'unsign'
					 FROM teachers_800
					where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
						and month(check_date) = '" . $_POST['month'] . "'
					group by room_id";
		}
	?>	 

<? if(isset($_POST['search']) && $_POST['month'] == ""){ ?>
		<br/><br/><center><font color="#FF0000">กรุณาเลือก เดือน ที่ต้องการทราบข้อมูลก่อน</font></center>
<? } //end if ?>

<? if(isset($_POST['search']) && $_POST['month'] != ""){ ?>
	<? $_res = mysql_query($_sql); ?>
	<? if(mysql_num_rows($_res)>0){ ?>
	  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%">
		<tr>
		  <th align="center">
			<img src="../images/school_logo.gif" width="120px">
			<br/>แผนภูมิสรุปการลงลายมือชื่อของครูที่ปรึกษากิจกรรมหน้าเสาธง
			<br/>ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
			<br/><?=($_POST['month']=="")?"":("ประจำเดือน ". displayMonth($_POST['month'])) ?>
		  </th>
		</tr>
		<tr > 
			<td align="center">
				<?php
					$_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ;
					$_strXML = $_strXML . "<chart xaxisname='' yaxisname='' hovercapbg='DEDEBE' hovercapborder='889E6D' rotateNames='0' numdivlines='9' divLineColor='CCCCCC' divLineAlpha='80' decimalPrecision='0' showAlternateVGridColor='1' AlternateVGridAlpha='30' AlternateVGridColor='CCCCCC' caption='' subcaption='' >";
					$_catXML = "<categories>";
					$_setA = "<dataset seriesname='ลงชื่อ' color='FF5904' showValue='1' alpha='50'>";
					$_setB = "<dataset seriesname='ไม่ลงชื่อ' color='0000FF' showValue='1' alpha='70'>";
					while($_dat = mysql_fetch_assoc($_res))
					{
						$_catXML .= "<category name='" . getFullRoomFormat($_dat['room_id']) . "' hoverText=''/>";
						$_setA .= "<set value='" . $_dat['sign'] . "' />";
						$_setB .= "<set value='" . $_dat['unsign'] . "' />";
					}
					$_catXML .= "</categories>";
					$_setA .= "</dataset>";
					$_setB .= "</dataset>";
					$_strXML .= $_catXML . $_setA . $_setB . "</chart>";
					FC_SetRenderer( "javascript" );
					echo renderChart("../fusionII/charts/MSBar2D.swf", "", $_strXML , "absent", 600, (mysql_num_rows($_res)*30));
				?>
			</td>
		</tr>
	</table>
	<? } else { echo "<br/><br/><center><font color='red'>ยังไม่มีการบันทึกข้อมูลในรายการที่คุณเลือก</font></center>";} ?>
<? } //end if ตรวจสอบการเช็ค ?>
</div>
