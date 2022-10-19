
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_learn/index"><img src="../images/history.png" alt="" width="48" height="48" border="0" /></a></td>
      <td><strong><font color="#990000" size="4">Room Tracking</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.1 เลือกวันที่บันทึกข้อมูล (แบบเก่า)</strong></font></span></td>
      <td align="right">
	  <? if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }

			//==============$_POST value===========//
			if(isset($_POST['acadyearX'])) { $acadyear = $_POST['acadyearX']; }
			if(isset($_POST['acadsemesterX'])) { $acadsemester = $_POST['acadsemesterX']; }
		?>
        ปีการศึกษา
        <?php  
					echo "<a href=\"index.php?option=module_learn/dateTaskList&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_learn/dateTaskList&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
        
        ภาคเรียนที่ 
        <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_learn/dateTaskList&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_learn/dateTaskList&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
           <font color="#000000" size="2">
           		<form name="sSelect" method="post" action="index.php?option=module_learn/dateTaskList">
				  	                เลือกวันที่ 
                                      <select name="date" class="inputboxUpdate" onchange="document.sSelect.submit();" >
                                        <option value=""></option>
                                   <?php
									$sql_date = "select distinct task_date from student_learn_task where task_status = '0' and acadyear = '" .$acadyear ."' and acadsemester = '" .$acadsemester."' order by task_date " ;
									$result = mysql_query($sql_date);
									while($data = mysql_fetch_assoc($result)) { ?>
                                        <option value="<?=$data['task_date']?>" <?=$_POST['date']==$data['task_date']?"selected":""?>><?=displayFullDate($data['task_date'])?></option>
                                    <? }  ?>
                                      </select>
									   <input type="hidden" name="acadyearX" value="<?=$acadyear?>">
									  <input type="hidden" name="acadsemesterX" value="<?=$acadsemester?>">
                                      <input type="submit" name="Submit" value="เลือก" class="button">
                </form>
           </font>
	  </td>
    </tr>
  </table>

	  
    <br/>
    
    <?
		$sql_room = "select distinct task_date,task_roomid from student_learn_task where task_date  = '" .  $_POST['date']  ."' order by task_roomid" ;
		$res = mysql_query($sql_room) or die (' ' . mysql_error());
		$row_room  =  mysql_num_rows($res);
		$i  = 1;
		if($row_room != 0)
			{
	?>
    <table width="100%" class="admintable">
		<tr>
			<td class="key" width="30px" align="center">ลำดับที่</td>
			<td class="key" width="45px" align="center">ห้อง</td>
			<td class="key" colspan="8" align="center">คาบเรียน</td>
			<td class="key" width="150px" align="center">สถานะการบันทึก</td>
		</tr>
		<? while($dat = mysql_fetch_assoc($res)){  ?>
					<tr>
						<td align="center"><?=$i?></td>
						<td align="center"><?=getFullRoomFormat(trim($dat['task_roomid']))?></td>
						<?
							$p_sql = "select task_date , task_roomid, task_status , period from student_learn_task where task_date = '" . $dat['task_date'] . "' and task_roomid = '" . trim($dat['task_roomid']) . "' order by period" ;
							$p_res = mysql_query($p_sql) or die ( ' ' . mysql_error());
							$x = 1;
							while($p_dat = mysql_fetch_assoc($p_res)) {	
								echo "<td align=\"center\" width='35px'>";
								if($p_dat['period'] == $x && $p_dat['task_status'] == '0') {
									echo "<a href=\"module_learn/studentListForm.php?room=" .$dat['task_roomid'] . "&date=" .$dat['task_date'] . "&period=" . $x . "&acadyear=" . $acadyear . "&acadsemester=".$acadsemester . "\">";
									echo "<b>คาบ $x</b>";
									echo "</a>";
								} else { echo "<font color=\"blue\" >คาบ $x </font>"; }
								echo "</td>";
								$x++;
							}//end while คาบเรียน ?>
						<td align="center">
						<?php
							$sql_checkstatus = "select distinct task_date,task_roomid,task_status,period from student_learn_task where task_date  = '" .  $_POST['date']  ."' and task_roomid = '" .$dat['task_roomid'] . "'" ;
							$res_checkstatus = mysql_query($sql_checkstatus);
							$int_check = 0;
							while($check_dat = mysql_fetch_assoc($res_checkstatus)) {
								if($check_dat['task_status'] == '1') { }
								else { $int_check++; }
							}//end while
							if($int_check == 0) { echo "<font color=\"green\" >บันทึกข้อมูลเรียบร้อยแล้ว</font>"; }
							else { echo "<font color=\"red\" >บันทึกข้อมูลยังไม่ครบ</font>"; }
						?>
						</td>
					</tr>
					<? $i++ ;?>
				<? }mysql_free_result($result); //end while?>
			</table>
            <? } //end if ?>
</div>

