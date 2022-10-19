<div id="content">
	  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.1 เลือกวันที่บันทึกข้อมูล</strong></font></span></td>
      <td align="right">
        <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
			//==============$_POST value===========//
			if(isset($_POST['acadyearX']))
			{
				$acadyear = $_POST['acadyearX'];
			}
			if(isset($_POST['acadsemesterX']))
			{
				$acadsemester = $_POST['acadsemesterX'];
			}
		?>
        ปีการศึกษา
        <?php  
					echo "<a href=\"index.php?option=module_800/dateTaskList&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_800/dateTaskList&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
        
        ภาคเรียนที่ 
        <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_800/dateTaskList&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_800/dateTaskList&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
                <br/>
                <br/>
                <font color="#000000" size="2"  >
                	<form method="post" name="dateList" action="index.php?option=module_800/dateTaskList">
				  	                เลือกวันที่ 
                                      <select name="date" class="inputboxUpdate" onChange="document.dateList.submit();">
                                        <option value="">  </option>
                                        <?php
									mysql_select_db($database_nn);
									$sql_date = "select distinct task_date from student_800_task where task_status = '0' and acadyear = '" . $acadyear . "' and acadsemester='".$acadsemester ."' order by task_date " ;
									$result = mysql_query($sql_date);
									while($data = mysql_fetch_assoc($result))
									{ ?>
                                        <option value="<?=$data['task_date']?>" <?=$_POST['date']==$data['task_date']?"selected":""?>>
											<?=displayFullDate($data['task_date'])?>
										</option>
								<?	} ?>
                                      </select>
									  <input type="hidden" name="acadyearX" value="<?=$acadyear?>">
									  <input type="hidden" name="acadsemesterX" value="<?=$acadsemester?>">
                                      <input type="submit" name="Submit" value="เลือก" class="button">
                    </form>
                </font>
      </td>
    </tr>
  </table>
  <br />
  							<?php
								$sql_room = "select * from student_800_task where task_status = '0' and task_date  = '" .  $_POST['date']  ."' order by task_roomid" ;
								$res = mysql_query($sql_room) or die (' ' . mysql_error());
								$row_room  =  mysql_num_rows($res);
								$i  = 1;
								if($row_room != 0)
								{
							?>
				<div align="center" style="width:100%;">
                                    <table width="43%" border="0" cellspacing="1" cellpadding="1" bgcolor="#FF99FF" align="center">
                                      <tr bgcolor="#006600"> 
                                        <td width="28%" height="22"><div align="center"><font color="#FFCC66"><strong><font size="2"  >ลำดับที่</font></strong></font></div></td>
                                        <td width="37%"><div align="center"><font color="#FFCC66"><strong><font size="2"  >ห้อง</font></strong></font></div></td>
										<td width="37%"><div align="center"><font color="#FFCC66"><strong><font size="2"  >หมายเหตุ</font></strong></font></div></td>
                                      </tr>
                                      <? while($dat = mysql_fetch_assoc($res)) {  ?>
                                          <tr bgcolor="#FFFFFF"> 
                                            <td align="center"><font size="2"  ><?php echo $i; ?> 
                                              </font> <div align="center"></div></td>
                                            <td align="center"><font size="2"  >
											<?php 
												echo getFullRoomFormat($dat['task_roomid']) ; 
											?> 
                                          </font> <div align="center"></div></td>
										  <td align="center"> <a href="<?php echo "module_800/studentListForm.php?room=" .$dat['task_roomid'] . "&date=" .$dat['task_date'] ."&acadyear=" . $acadyear . "&acadsemester=".$acadsemester  ;  ?>">บันทึก </a></td>
                                      </tr>
                                      <? $i++ ;}}
									  	mysql_free_result($result);  ?>
                                    </table>
               </div>
</div>

								