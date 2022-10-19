<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.2 ข้อมูลนักเรียนแยกตามสถานะผู้ปกครอง [บัตรแขวน]</strong></font></span></td>
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
					echo "<a href=\"index.php?option=module_history/reportZYX&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/reportZYX&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
	  	<font color="#000000" size="2"  >
		<?php 
					$sql_Room = "select replace(room_id,'0','/') as room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id";
					//echo $sql_Room ;
					$resRoom = mysql_query($sql_Room);			
			?>
		เลือกห้องเรียน
		  	<select name="roomID" class="inputboxUpdate">
				<?php

					while($dat = mysql_fetch_assoc($resRoom))
					{
						$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
						echo "<option value=\"" . $dat['room_id'] . "\" $_select>";
						echo $dat['room_id'];
						echo "</option>";
					}
					
				?>
			</select>
	  		<input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			</font>
	   </td>
    </tr>
  </table>
  </form>

<?php
  $xlevel;
  $xyearth;
  $room = substr($_POST['roomID'],2,1);
  if(substr($_POST['roomID'],0,1) > 3)
  {
  	$xlevel = 4;
	if(substr($_POST['roomID'],0,1) == 4){ $xyearth = 1;}
	if(substr($_POST['roomID'],0,1) == 5){ $xyearth = 2;}
	if(substr($_POST['roomID'],0,1) == 6){ $xyearth = 3;}		
  }
  else
  {
  	$xlevel = 3;
	if(substr($_POST['roomID'],0,1) == 1){ $xyearth = 1;}
	if(substr($_POST['roomID'],0,1) == 2){ $xyearth = 2;}
	if(substr($_POST['roomID'],0,1) == 3){ $xyearth = 3;}
  }
  ?>
  <table  width="100%" cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <td class="key" colspan="2" align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			บัตรไปทัศนศึกษา <?=displayClass($_POST['roomID'])?> <br/>
			ปีการศึกษา <?php echo $acadyear; ?>	  </td>
    </tr>
<? if(isset($_POST['search']) && $_POST['roomID'] != ""){ ?>
	<?php
		$sqlStudent = "select id,prefix,firstname,lastname,xlevel,xyearth,room,nickname from students ";
		if($_POST['roomID']!="all"){$sqlStudent .=  " where xlevel = '". $xlevel . "' and xyearth = '" . $xyearth . "' and xedbe = '" . $acadyear . "' and room = '" . $room . "'";}
		else {$sqlStudent .= " where xedbe = '" . $acadyear . "' " ;}
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		$sqlStudent .= "order by xlevel,xyearth,room,sex,id";
		$resStudent = mysql_query($sqlStudent);
		$ordinal = 1;
		$totalRows = mysql_num_rows($resStudent);
		while($_dat = mysql_fetch_assoc($resStudent)){ ?>
		<tr>
			<td align="center"><br/><br/><br/>
				<table cellpadding="2px" cellspacing="2px" bgcolor="#0000CC">
					<tr>
						<td align="center" bgcolor="#FFFFFF" valign="bottom">
							<img src="../images/temp_visit.png" />
						</td>
					</tr>
					<tr>
						<td width="350px" valign="top" align="center" bgcolor="#FFFFFF">
							<img src="../images/temp_.png" /><br/>
							<img src='../images/studphoto/id<?=$_dat['id']?>.jpg' width='120px' height='160px' style='border:1px solid #CC0CC0'/><br/><br/>
							<font size="6" face="Browallia News" color="#339966">
								ชื่อเล่น :<b>"<?=$_dat['nickname']?>"
							</font><h6>&nbsp;</h6>
							<font size="6" face="Browallia News">
								ชื่อ : <font color="#993399"><b><?=$_dat['firstname']?> <?=$_dat['lastname']?></b></font>
							</font><h6>&nbsp;</h6>
							<font size="6" face="Browallia News" color="#996600">
								ชั้นมัธยมศึกษาปีที่ <?=$_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3?><br/>
								Tel : 044 846 117							</font>
						</td>
					</tr>
				</table>
			</td>
			<? $_dat = mysql_fetch_assoc($resStudent) ?>
			<td align="center"><br/><br/><br/>
				<table cellpadding="2px" cellspacing="2px" bgcolor="#0000CC">
					<tr>
						<td align="center" bgcolor="#FFFFFF" valign="bottom">
							<img src="../images/temp_visit.png" />
						</td>
					</tr>
					<tr>
						<td width="350px" valign="top" align="center" bgcolor="#FFFFFF">
							<img src="../images/temp_.png" /><br/>
							<img src='../images/studphoto/id<?=$_dat['id']?>.jpg' width='120px' height='160px' style='border:1px solid #CC0CC0'/><br/><br/>
							<font size="6" face="Browallia News" color="#339966">
								ชื่อเล่น :<b>"<?=$_dat['nickname']?>"
							</font><h6>&nbsp;</h6>
							<font size="6" face="Browallia News">
								ชื่อ : <font color="#993399"><b><?=$_dat['firstname']?> <?=$_dat['lastname']?></b></font>
							</font><h6>&nbsp;</h6>
							<font size="6" face="Browallia News" color="#996600">
								ชั้นมัธยมศึกษาปีที่ <?=$_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3?><br/>
								Tel : 044 846 117							</font>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	<?	} //end while	?>
<? } //end if ?>
</table>
  
</div>
<?
	function displayClass($_id)
	{
		$_xlevel = substr($_id,0,1);
		$_xyearth = substr($_id,2,1);
		if($_xlevel == 0)
		{
			return "ของนักเรียนทั้งหมด";
		}
		else
		{
			return "นักเรียนชั้นมัธยมศึกษาปีที่ " . ($_xlevel == 3 ? $_xyearth : $_xyearth + 3);
		}
	}
?>