<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_maps/index"><img src="../images/add.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">แผนที่ติดตามที่อยู่</font></strong><br />
			<span class="normal"><font color="#0066FF"><strong>1.2.3 ทำเนียบรูปภาพนักเรียนตามวิธีการเดินทางมาโรงเรียน</strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			else if(isset($_POST['acadyear'])) { $acadyear = $_POST['acadyear']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_maps/studentListPicsTravelBy&acadyear=" . ($acadyear - 1) .  "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_maps/studentListPicsTravelBy&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/><font color="#000000" size="2">
		เลือกระดับชั้น
		  	<select name="roomID" class="inputboxUpdate">
				<option value=""></option>
                <option value="3/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/1"?"selected":""?>> มัธยมศึกษาปีที่ 1 </option>
				<option value="3/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/2"?"selected":""?>> มัธยมศึกษาปีที่ 2 </option>
				<option value="3/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/3"?"selected":""?>> มัธยมศึกษาปีที่ 3 </option>
				<option value="4/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/1"?"selected":""?>> มัธยมศึกษาปีที่ 4 </option>
				<option value="4/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/2"?"selected":""?>> มัธยมศึกษาปีที่ 5 </option>
				<option value="4/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/3"?"selected":""?>> มัธยมศึกษาปีที่ 6 </option>
				<option value="all" <?=isset($_POST['roomID'])&&$_POST['roomID']=="all"?"selected":""?>> ทั้งโรงเรียน </option>
			</select> 
            &nbsp; &nbsp;
        <input type="submit" value="เรียกดู" class="button" name="search"/> 
        <br/>
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
			 
			</font>
	   </td>
    </tr>
  </table>
  </form>
<? if(isset($_POST['search']) && ($_POST['sex'] == "" || $_POST['travelby'] == "" || $_POST['roomID'] == "")){ ?>  
	<br/><br/><center><font color="#FF0000">กรุณาเลือก ระดับชั้น วิธีการเดินทาง และ เพศ ที่ท่านต้องการทราบข้อมูลก่อน</font></center>
<? }//end if ?>

<? if(isset($_POST['search']) && $_POST['sex'] != "" && $_POST['travelby'] != "" && $_POST['roomID'] != ""){ ?>
	<?php
		$sqlStudent = "select id,prefix,firstname,lastname,nickname,sex,studstatus,p_village,points,xlevel,howlong,xyearth,room,travelby
						from students 
						where travelby = '" . $_POST['travelby'] . "'
								and xedbe = '" . $acadyear . "' ";
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		if($_POST['sex'] != "all") $sqlStudent .= " and sex = '" . $_POST['sex'] . "' ";
		if($_POST['roomID'] != "all") $sqlStudent .= " and xlevel = '" . substr($_POST['roomID'],0,1) . "' and xyearth = '" . substr($_POST['roomID'],-1) . "' ";
		$sqlStudent .= " order by xlevel,xyearth,room,sex,id";
		$resStudent = mysql_query($sqlStudent);
		$ordinal = 1; ?>
	<? if(mysql_num_rows($resStudent)>0) { ?>
		  <table class="admintable" align="center" width="800px">
			<tr>
				<th colspan="5" align="center">
					<img src="../images/school_logo.gif" width="120px"><br/>
					ทำเนียบนักเรียนที่เดินทางมาโรงเรียนโดย : <?=displayTravel($_POST['travelby'])?> <br/>
                    ชั้นมัธยมศึกษาปีที่ <?=displayXyear($_POST['roomID'])?> 
					ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
				</th>
			</tr>
		<?	
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
							{echo "<img src='../images/" . ($dat['sex']==1?"_unknown_male":"_unknown_female") . ".png' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #CC0CC0'/><br/>"; }
						echo "" . ($dat['xlevel']==3?$dat['xyearth']:$dat['xyearth']+3).'/'.$dat['room'] . '-' . $dat['id'] . "-[". displayPoint($dat['nickname']) . "]<br/>" ;
						echo "" . displayPrefix($dat['prefix']) . $dat['firstname'] . " " . $dat['lastname'] . "<br/>";
						echo "ใช้เวลา : <b>" . ($dat['howlong']>0?$dat['howlong']:"-") . "</b> นาที<br/>"  ;
						echo "" . $dat['p_village'] ;
						//echo "" . displayStatus($dat['studstatus']) ;
						echo "</td>";
						$ordinal++;
					}
					echo "</tr>";
				}
			?>
		</table>
	<? }else {?><br/><br/><center><font color="#FF0000">ไม่มีข้อมูลตามเงื่อนไขที่ท่านเลือก</font></center><? } ?>
<? } //end check submit data ?>  
</div>

