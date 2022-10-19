<div id="content">

<table width="98%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_gpa/index"><img src="../images/gpa.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Learning Achievement</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>รายละเอียดผลการศึกษาของนักเรียนรายบุคคล</strong></font></span></td>
      <td align="right">
      	<input type="button" class="button" value="ย้อนกลับ" onClick="history.go(-1);">
      </td>
    </tr>
  </table>

  <?php

	  $_resSemester = mysql_query("select distinct concat(acadsemester,'/',acadyear) as display,acadsemester,acadyear 
									from grades where student_id = '" . $_REQUEST['student_id'] . "' order by acadyear ,acadsemester ");
  ?>

<div align="center">
      <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center">
        <tr> 
          <th colspan="5" align="left">
                <img src="../images/school_logo.gif" width="120px"><br/>
          </th>
          <th colspan="5" align="right">
          	<?="<img src='../images/studphoto/id" . $_REQUEST['student_id'] . ".jpg' height='140px' width='100px' alt='รูปถ่ายนักเรียน' style='border:1px solid #000000'/>"?>
          </th>
        </tr>
        <tr>
          <th colspan="10">
                ผลสัมฤทธิ์ทางการเรียน<br/>
                ภาคเรียนที่ <?=$acadsemester;?> ปีการศึกษา <?=$acadyear;?><br/>
                ของ <?=$_REQUEST['name']?> เลขประจำตัว <?=$_REQUEST['student_id']?> นักเรียนชั้นมัธยมศึกษาปีที่ <?=$xlevel==3?$xyearth:($xyearth+3)?>/<?=$_REQUEST['room']?><br/>
          </th>
        </tr>
        <tr> 
            <td class="key" width="70px" align="center">ปีการศึกษา</td>
            <td class="key" width="45px" align="center">ภาคเรียน</td>
            <td class="key" width="90px" align="center" >รหัสวิชา</td>
            <td class="key" width="200px" align="center" >รายวิชา</td>
            <td class="key" width="90px"  align="center" >หนวยการเรียน</td>
            <td class="key" width="70px" align="center">คะแนน</td>
            <td class="key" width="90px" align="center" >ผลการเรียน</td>
            <td class="key" width="90px" align="center" >ผลการเรียนเดิม</td>
            <td class="key" width="80px" align="center" >หมายเหตุ</td>            
        </tr>
        <? while($_Term = mysql_fetch_assoc($_resSemester)){ ?>
        <? 	$_sql =   "select 
						 a.acadyear,a.acadsemester,a.psubjectcode,
						 b.psubjectname,b.psubjectcredit,a.p100,a.grade,a.regrade,b.groupsara
					from grades a 
						 left outer join subjects b on 
						 (a.psubjectcode = b.psubjectcode and a.acadyear = b.acadyear)
					where a.student_id = '" . $_REQUEST['student_id'] . "' and
						  a.acadsemester = '" . $_Term['acadsemester'] . "' and
						  a.acadyear = '" . $_Term['acadyear'] . "' 
					order by a.acadyear desc,a.acadsemester desc,b.groupsara"; 
		  			// echo $_sql;
		 			 @$_result = mysql_query($_sql);
					 
					 $_credit = 0.0;
					 $_unitPoint = 0.0;
					 $_gpa = "";

                     $_xYear = "";
                     $_xSemester = "";
                                ?>
                                <? while($_dat = mysql_fetch_assoc($_result)) { ?>
                                    <tr>
                                        <td align="center"><?=$_dat['acadyear']==$_xYear?"":$_dat['acadyear']?></td>
                                        <td align="center"><?=$_dat['acadsemester']==$_xSemester?"":$_dat['acadsemester']?></td>
                                        <td style="padding-left:20px;"><?=$_dat['psubjectcode']?></td>
                                        <td><?=$_dat['psubjectname']?></td>
                                        <td align="center"><?=$_dat['psubjectcredit']?></td>
                                        <td align="right" style="padding-right:25px;"><?=displayP100($_dat['p100'])?></td>
                                        <td align="center"><b><?=$_dat['regrade']!=""?displayGrade($_dat['regrade']):displayGrade($_dat['grade'])?></b></td>
                                        <td align="center"><b><?=$_dat['regrade']==""?"":displayGrade($_dat['grade'])?></b></td>
                                        <td align="center">
                                            <? 	$_fileAttached = $_SERVER["DOCUMENT_ROOT"] . "/pk/grades/"; ?>
                                            <? 	$_fileAttached .= $_dat['acadyear'].$_dat['acadsemester'].$_REQUEST['student_id'].$_dat['groupsara'].substr($_dat['psubjectcode'],-5).".jpg"; ?>
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
                                        <? $_xYear = $_dat['acadyear']; ?>
                                        <? $_xSemester = $_dat['acadsemester']; ?>
                                        <?
											$_credit += $_dat['psubjectcredit'];
											if(is_numeric($_dat['grade']) && $_dat['grade'] > 0) { $_unitPoint += $_dat['grade'] * $_dat['psubjectcredit']; }
											else if (is_numeric($_dat['regrade']) && $_dat['regrade'] > 0) { $_unitPoint += $_dat['regrade'] * $_dat['psubjectcredit'];}
										?>
                                    </tr>
                                <? } ?>
                                <tr>
                                    <td class="key2"></td>
                                    <td class="key2"></td>
                                    <td class="key2"></td>
                                    <td class="key2" align="center" height="40px">ผลการเรียนเฉลี่ย</td>
                                    <td class="key2" align="center"><?=$_credit?></td>
                                    <td class="key2" align="center"><?=$_unitPoint>0?$_unitPoint:"-"?></td>
                                    <td class="key2" align="center">
                                        <? $_gpa = substr($_unitPoint/$_credit,0,4); ?>
                                        <?=number_format($_gpa,2,'.',',')?>
                                    </td>
                                    <td class="key2" colspan="2"></td>
                                </tr>
          <? } // fetch each acadsemester?>
    </table>
</div>
</div>
