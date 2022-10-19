

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt=""  border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>4.5 แผนภูมิเปรียบเทียบการเข้าร่วมกิจกรรมหน้าเสาธง<br/>(กราฟพื้นที่เลือกห้องเรียน)</strong></font></span></td>
      <td >
		<? if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา <?php  
					echo "<a href=\"index.php?option=module_800/reportSemesterChartLineRoom&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_800/reportSemesterChartLineRoom&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <? if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_800/reportSemesterChartLineRoom&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_800/reportSemesterChartLineRoom&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					} ?>
		<form action="" method="post">
		<font color="#000000" size="2"  >
		ห้อง
		<select name="roomID" class="inputboxUpdate">
		  	<option value=""></option>
			<? $sql_Room = "select  room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id"; ?>
			<? $resRoom = mysql_query($sql_Room); ?>
			<? while($dat = mysql_fetch_assoc($resRoom)) {
					$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
					echo "<option value=\"" . $dat['room_id'] . "\" $_select >";
					echo getFullRoomFormat($dat['room_id']);
					echo "</option>";
				}
			?>
			</select>
			 <input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			 <input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		  </font>
		  </form>
	  </td>
    </tr>
  </table>
<? $_sql = ""; ?>
<? if($_POST['roomID'] == "") {
			$_sql = "select student_id,prefix,firstname,lastname,
					  sum(if(timecheck_id = '00',timecheck_id,0)+1) as a,
					  sum(if(timecheck_id = '01',timecheck_id,0)) as b,
					  sum(if(timecheck_id = '02',timecheck_id,0))/2 as c,
					  sum(if(timecheck_id = '03',timecheck_id,0))/3 as d,
					  sum(if(timecheck_id = '04',timecheck_id,0))/4 as e
					from student_800 left outer join students on student_id = id
					where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' and xedbe = '" . $acadyear . "'
					 and class_id = '601' ";
			if($_POST['studstatus']=="1,2") $_sql .= "and studstatus in (1,2) ";
			$_sql .= "group by student_id order by xlevel,xyearth,sex,student_id";
		}
		else {
			$_sql = "select student_id,prefix,firstname,lastname,
					  sum(if(timecheck_id = '00',timecheck_id,0)+1) as a,
					  sum(if(timecheck_id = '01',timecheck_id,0)) as b,
					  sum(if(timecheck_id = '02',timecheck_id,0))/2 as c,
					  sum(if(timecheck_id = '03',timecheck_id,0))/3 as d,
					  sum(if(timecheck_id = '04',timecheck_id,0))/4 as e
					from student_800 left outer join students on student_id = id
					where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' 
					 and xedbe = '" . $acadyear . "'
					 and class_id = '" . $_POST['roomID'] ."' ";
			if($_POST['studstatus']=="1,2") $_sql .= "and studstatus in (1,2) ";
			$_sql .= "group by student_id order by xlevel,xyearth,sex,student_id";
		}
	?>	
<? if(isset($_POST['search']) && $_POST['roomID'] == ""){ echo "<br/><br/><center><font color='red'>กรุณาเลือก ห้องเรียน ก่อน</font></center>";} ?> 
<? if(isset($_POST['search']) && $_POST['roomID'] != "") { ?>
  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%">
    <tr>
      <th align="center">
	  	<img src="../images/school_logo.gif" width="120px">
	  	<br/>เปรียบเทียบการเข้าร่วมกิจกรรมหน้าเสาธงห้อง <?=getFullRoomFormat($_POST['roomID'])?>
		<br/>ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?> <br/>
	  </th>
    </tr>
    <tr > 
		<td align="center">
			<?php
				$_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ;
				$_strXML = $_strXML . "<graph caption='' xAxisName='' yAxisName='' hovercapbg='FFECAA' hovercapborder='F47E00' formatNumberScale='0' decimalPrecision='0' showvalues='0' animation='1' numdivlines='3' numVdivlines='0'  lineThickness='1' labelDisplay='Rotate'>";
				$_catXML = "<categories>";
				$_setA = "<dataset seriesname='ขาด' color='FF0000' showValue='1' alpha='100' anchorAlpha='100' lineThickness='3'>";
				$_setB = "<dataset seriesname='ลา'  color='0099FF' showValue='0' alpha='100' anchorAlpha='20' lineThickness='1'>";
				$_setC = "<dataset seriesname='สาย' color='009933' showValue='0' alpha='100' anchorAlpha='0' lineThickness='1'>";
				$_res = mysql_query($_sql);
				$_rows = mysql_num_rows($_res);
				while($_dat = mysql_fetch_assoc($_res))
				{
					$_catXML .= "<category name='" . $_dat['student_id'] .' '. $_dat['prefix'] . $_dat['firstname'] .' '. $_dat['lastname'] . "'/>";
					$_setA .= "<set value='" . $_dat['e'] . "' />";
					$_setB .= "<set value='" . $_dat['d'] . "' />";
					$_setC .= "<set value='" . $_dat['c'] . "' />";
				}
				$_catXML .= "</categories>";
				$_setA .= "</dataset>";
				$_setB .= "</dataset>";
				$_setC .= "</dataset>";
				$_strXML .= $_catXML . $_setA . $_setB . $_setC . "</graph>";
				FC_SetRenderer( "javascript" );
				echo renderChart("../fusionII/charts/MSLine.swf", "", $_strXML , "absent", 700, 600);
				echo $_strXML;
			?>
		</td>
    </tr>
</table>
<? }//end if ?>
</div>

