<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td width="45%"><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.6.1 ทำเนียบนักเรียนตามห้องเรียน</strong></font></span></td>
      <td >
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
					echo "<a href=\"index.php?option=module_history/studentListPics&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/studentListPics&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_history/studentListPics&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_history/studentListPics&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<br/><font color="#000000" size="2" >
	  		เลือกห้องเรียน
			<?php 
					$sql_Room = "select room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id";
					$resRoom = mysql_query($sql_Room);			
			?>
			<select name="roomID" class="inputboxUpdate">
		  	<option value=""> </option>
			<?php
		
							while($dat = mysql_fetch_assoc($resRoom))
							{
								$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
								echo "<option value=\"" . $dat['room_id'] . "\" $_select>";
								echo getFullRoomFormat($dat['room_id']);
								echo "</option>";
							} mysql_free_result($resRoom);
						?>
			</select>
	  		<input type="submit" value="สืบค้น" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา</font>
	   </td>
    </tr>
  </table>
  </form>
  <?php
	  $xlevel = getXlevel($_POST['roomID']);
	  $xyearth= getXyearth($_POST['roomID']);
	  $room = getRoom($_POST['roomID']);
  ?>
  <? if(isset($_POST['search']) && $_POST['roomID'] == "") { ?>
  		<br/><center><font color="#FF0000">กรุณาเลือกห้องเรียนก่อน !</font></center>
  <? } else if (isset($_POST['search']) && $_POST['roomID'] != "") { ?>
  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <td class="key" colspan="5" align="center">
	  	<img src="../images/school_logo.gif" width="120px"><br/>
	  	รายชื่อนักเรียนห้อง <?=getFullRoomFormat($_POST['roomID']); ?> ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
	</td>
    </tr>
	<?php
		$sqlStudent = "select id,prefix,firstname,lastname,sex,nickname,p_village,studstatus,points
						from students 
						where xlevel = '". $xlevel . "' and xyearth = '" . $xyearth . "' and room = '" . $room . "' 
								and xedbe = '" . $acadyear . "' ";
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		$sqlStudent .= " order by sex,id,ordinal ";
		$resStudent = mysql_query($sqlStudent);
		$ordinal = 1;
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
					{echo "<img src='../images/" . ($dat['sex']==1?"_unknown_male":"_unknown_female") . ".png' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #CC0CC0'/></a><br/>"; }
				echo "" . $dat['id'] . "- [". displayPoint($dat['nickname']) . "]<br/>" ;
				echo "" . displayPrefix($dat['prefix']) . $dat['firstname'] . " " . $dat['lastname'] . "<br/>";
				echo "</td>";
				$ordinal++;
			}
			echo "</tr>";
		}
	?>
</table>
<? } //end else-if ?>
  
</div>
