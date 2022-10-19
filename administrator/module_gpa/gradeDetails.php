<div id="content">

<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_gpa/index"><img src="../images/gpa.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Learning Achievement</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>รายละเอียดผลการศึกษาของนักเรียนรายบุคคล</strong></font></span></td>
      <td align="right">
      	<form name="back" method="post" action="index.php?option=module_gpa/studentList">
        	<input type="submit" class="button" value="ย้อนกลับ" name="search" >
            <input type="hidden" name="roomID" 
            	value="<?=displayRoomTable($_REQUEST['xlevel'],$_REQUEST['xyearth']) . (strlen(trim($_REQUEST['room']))>1?$_REQUEST['room']:("0".$_REQUEST['room']));?>"/>
        </form>
        <? $_result = mysql_query("select distinct concat(acadsemester,'/',acadyear) as display 
									from grades where student_id = '" . $_REQUEST['student_id'] . "' order by acadyear,acadsemester"); ?>
        <br/>
        <font size="2" color="#000000">
        <form name="filter" method="post">
        	เลือกภาคเรียนเพื่อแสดงผลการเรียน
            <select name="term" class="inputboxUpdate" onChange="document.filter.submit();">
                <? while($_term = mysql_fetch_assoc($_result)){ ?>
                		<option value="<?=$_term['display']?>" <?=$_term['display']==$_POST['term']?"selected":""?>><?=$_term['display']?></option>
						<?
							$_dd = explode("/",$_term['display']);
							$Qacadyear =   $_dd[1];
							$Qacadsemester = $_dd[0];
						?>
                <? } ?>
            </select>
        </form>
        </font>
      </td>
    </tr>
  </table>

  <?php
	  //$Qacadyear =  $acadyear;
	  //$Qacadsemester = $acadsemester;
	  
	  $_credit = 0.0;
	  $_unitPoint = 0.0;
	  $_gpa = "";
	  
	  if(isset($_POST['term']) || $_POST['term'] != "")
	  {
			$_dd = explode("/",$_POST['term']);
			$Qacadyear =   $_dd[1];
			$Qacadsemester = $_dd[0];
	  }
	  
	  $xlevel = $_REQUEST['xlevel'];
	  $xyearth = $_REQUEST['xyearth'];
	  $room = $_REQUEST['room'];
	  
	  
	  $_sql =   "select 
					 a.psubjectcode,b.psubjectname,b.psubjectcredit,a.p100,a.grade,a.regrade,b.groupsara
				from grades a 
					 left outer join subjects b on (a.psubjectcode = b.psubjectcode)
				where a.student_id = '" . $_REQUEST['student_id'] . "' and a.acadyear = '" . $Qacadyear . "' and 
					  acadsemester = '" . $Qacadsemester ."' and
					  b.acadyear = '" . $Qacadyear . "'
				order by b.groupsara";
	  // echo $_sql;
	  @$_result = mysql_query($_sql);
	  $_no = 1;
  ?>

<div align="center">
      <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center">
        <tr> 
          <th colspan="4" align="left">
                <img src="../images/school_logo.gif" width="120px"><br/>
          </th>
          <th colspan="4" align="right">
          	<?="<img src='../images/studphoto/id" . $_REQUEST['student_id'] . ".jpg' height='140px' width='120px' alt='รูปถ่ายนักเรียน' style='border:1px solid #000000'/>"?>
          </th>
        </tr>
        <tr>
          <th colspan="8">
                ผลสัมฤทธิ์ทางการเรียน<br/>
                ภาคเรียนที่ <?=$Qacadsemester?> ปีการศึกษา <?=$Qacadyear?><br/>
                ของ <?=$_REQUEST['name']?> เลขประจำตัว <?=$_REQUEST['student_id']?> 
                ปัจจุบันชั้นมัธยมศึกษาปีที่ <?=$xlevel==3?$xyearth:($xyearth+3)?>/<?=$_REQUEST['room']?><br/>
          </th>
        </tr>
        <tr> 
            <td class="key" width="35px" align="center">ที่</td>
            <td class="key" width="90px" align="center" >รหัสวิชา</td>
            <td class="key" width="255px" align="center" >รายวิชา</td>
            <td class="key" width="80px"  align="center" >หนวยการเรียน</td>
            <td class="key" width="80px" align="center">คะแนน</td>
            <td class="key" width="80px" align="center" >ผลการเรียน</td>
            <td class="key" width="90px" align="center" >ผลการเรียนเดิม</td>
            <td class="key" width="80px" align="center" >หมายเหตุ</td>
        </tr>
        <? while($_dat = mysql_fetch_assoc($_result)) { ?>
	        <tr>
        		<td align="center"><?=$_no++?></td>
                <td style="padding-left:20px;"><?=$_dat['psubjectcode']?></td>
                <td><?=$_dat['psubjectname']?></td>
                <td align="center"><?=$_dat['psubjectcredit']?></td>
                <td align="right" style="padding-right:25px;"><?=displayP100($_dat['p100'])?></td>
                <td align="center"><b><?=$_dat['regrade']!=""?displayGrade($_dat['regrade']):displayGrade($_dat['grade'])?></b></td>
                <td align="center"><b><?=$_dat['regrade']==""?"":displayGrade($_dat['grade'])?></b></td>
                <td align="center">
                	<? 	$_fileAttached = $_SERVER["DOCUMENT_ROOT"] . "/pk/grades/"; ?>
					<? 	$_fileAttached .= $Qacadyear.$Qacadsemester.$_REQUEST['student_id'].$_dat['groupsara'].substr($_dat['psubjectcode'],-5).".jpg"; ?>
                    <?  	 if($_dat['regrade']!="") {
								if(file_exists($_fileAttached)) {
									echo "<a target='_blank' href='module_gpa/displayFileAttached.php?id=" . substr($_fileAttached,-20) . "'>";
									echo "หลักฐาน";
									echo "</a>";
								}else { echo "ไม่มีหลักฐาน";}
							}
							else {}
					?>
                </td>
					<?
                    	$_credit += $_dat['psubjectcredit'];
						if(is_numeric($_dat['grade']) && $_dat['grade'] > 0) { $_unitPoint += $_dat['grade'] * $_dat['psubjectcredit']; }
						else if (is_numeric($_dat['regrade']) && $_dat['regrade'] > 0) { $_unitPoint += $_dat['regrade'] * $_dat['psubjectcredit'];}
                    ?>
    	    </tr>
        <? } ?>
        <tr>
        	<td class="key2" colspan="3" align="center" height="40px">รวมหน่วยการเรียน/รวมคะแนนหน่วยการเรียน/GPA</td>
            <td class="key2" align="center"><?=$_credit?></td>
            <td class="key2" align="center"><?=$_unitPoint>0?$_unitPoint:"-"?></td>
            <td class="key2" align="center">
				<? $_gpa = substr($_unitPoint/$_credit,0,4); ?>
				<?=number_format($_gpa,2,'.',',')?>
            </td>
            <td class="key2" colspan="2"></td>
        </tr>
    </table>
</div>
</div>

