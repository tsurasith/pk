

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_learn/index"><img src="../images/history.png" alt="" width="48" height="48" border="0" /></a></td>
      <td><strong><font color="#990000" size="4">Room Tracking</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.2 เลือกวันที่บันทึกข้อมูล (แบบใหม่)</strong></font></span></td>
      <td>
	  <? if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }

			//==============$_POST value===========//
			if(isset($_POST['acadyearX'])) { $acadyear = $_POST['acadyearX']; }
			if(isset($_POST['acadsemesterX'])) { $acadsemester = $_POST['acadsemesterX']; }
		?>
        ปีการศึกษา
        <?php  
					echo "<a href=\"index.php?option=module_learn/dateTaskList2&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_learn/dateTaskList2&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
        
        ภาคเรียนที่ 
        <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_learn/dateTaskList2&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_learn/dateTaskList2&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
            <font color="#000000" size="2">
            	<form name="dateSelected" method="post" action="index.php?option=module_learn/dateTaskList2">
				  	                เลือกวันที่ 
                                      <select name="date" class="inputboxUpdate" onchange="document.dateSelected.submit();" >
                                        <option value=""></option>
                                        <?php
									mysql_select_db($database_nn);
									$sql_date = "select distinct task_date from student_learn_task where task_status = '0' and acadyear = '" .$acadyear ."' and acadsemester = '" .$acadsemester."' order by task_date " ;
									$result = mysql_query($sql_date);
									while($data = mysql_fetch_assoc($result)) { ?>
                                        <option value="<?=$data['task_date']?>" <?=$_POST['date']==$data['task_date']?"selected":""?>><?=displayFullDate($data['task_date'])?></option>
                                    <? } ?>
                                      </select>
									   <input type="hidden" name="acadyearX" value="<?=$acadyear?>">
									  <input type="hidden" name="acadsemesterX" value="<?=$acadsemester?>">
                                      <input type="submit" name="Submit" value="เลือก" class="button">
                </form>
            </font>
                
	  </td>
    </tr>
  </table>

	  <?
	  	$sql_room = "select distinct task_date,task_roomid from student_learn_task where task_date  = '" .  $_POST['date']  ."' order by task_roomid" ;
		$res = mysql_query($sql_room) or die (' ' . mysql_error());
		$row_room  =  mysql_num_rows($res);
		$i  = 1;
		if($row_room != 0)
			{
	 ?>

	<br/>
    <div style="width:100%;" align="center">
            <table class="admintable" align="center">
                <tr>
                    <td class="key" width="40px" align="center">ที่</td>
                    <td class="key" width="45px" align="center">ห้อง</td>
                    <td class="key" width="200px" align="center">เลือกห้องที่ต้องการบันทึก</td>
                    <td class="key" width="150px" align="center">สถานะการบันทึก</td>
                </tr>
                <? while($dat = mysql_fetch_assoc($res)){  ?>
                            <tr>
                                <td align="center"><?=$i?></td>
                                <td align="center"><?=getFullRoomFormat(trim($dat['task_roomid']))?></td>
                                
                                
                                <?php
                                    $sql_checkstatus = "select task_date,task_roomid,task_status,period from student_learn_task where task_date  = '" .  $_POST['date']  ."' and task_roomid = '" .$dat['task_roomid'] . "'" ;
                                    $res_checkstatus = mysql_query($sql_checkstatus);
                                    $res_dat = mysql_query($sql_checkstatus);
                                    $dat = mysql_fetch_assoc($res_dat);
                                    $int_check = 0;
                                    while($check_dat = mysql_fetch_assoc($res_checkstatus)) {
                                        if($check_dat['task_status'] == '1') { }
                                        else { $int_check++; }
                                    }//end while
                                ?>
                                <td align="center">
                                    <? if($int_check == 8) { ?>
                                        <? echo "<a href=\"module_learn/studentListForm2.php?room=" .$dat['task_roomid'] . "&date=" .$dat['task_date'] . "&acadyear=" . $acadyear . "&acadsemester=".$acadsemester . "\">"; ?>
                                        <? echo "บันทึกข้อมูล"; ?>
                                        <? echo "</a>"; ?>
                                    <? } else if ($int_check > 0){ echo "ให้กลับไปใช้รูปแบบบันทึกแบบเก่า"; ?>
                                    <? } else { echo "-"; } ?>
                                </td>
                                <td>
                                    <?
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
</div>
