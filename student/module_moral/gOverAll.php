

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_moral/index"><img src="../images/objects.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">ระบบสารสนเทศธนาคารความดี</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>3.3 แผนภูมิสรุปเปรียบเทียบตาม<br/>ประเภทพฤติกรรมที่พึงประสงค์รายภาคเรียน</strong></font></span></td>
     <td align="right" valign="top">
		<form method="post">
			<font color="#000000" size="2">
			ประเภทของกิจกรรม
			<? @$_resMtype = mysql_query("select * from ref_moral") ?>
			<select name="mtype" class="inputboxUpdate">
				<option value=""></option>
				<? while($_dat = mysql_fetch_assoc($_resMtype)) { ?>
				<option value="<?=$_dat['moral_id']?>" <?=(isset($_POST['mtype']) && $_POST['mtype'] == $_dat['moral_id'])?"selected":""?>><?=$_dat['moral_description']?></option>
				<? } ?>
				<option value="all" <?=$_POST['mtype']=="all"?"selected":""?>>รวมทุกประเภท</option>
			</select>
			<input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			</font>
		</form>
	  </td>
    </tr>
  </table>
  
	<?
  		$_xmlColumn = "<?xml version='1.0' encoding='UTF-8' ?>";
		$_xmlColumn .= "<graph caption='' formatNumberScale='0' decimalPrecision='0' yaxismaxvalue='50' >";
	?>

<? if(isset($_POST['search']) && $_POST['mtype'] == ""){ ?>
		<br/><br/><center><font color="#FF0000">กรุณาเลือก ประเภทพฤติกรรมที่พึงประสงค์ ก่อน</font></center>
<? } ?>
		
<? if(isset($_POST['search']) && $_POST['mtype'] != ""){ ?>
	<? $_sql = "select acadyear,acadsemester,count(*) as total from student_moral ";?>
	<? if($_POST['mtype'] != "all") $_sql .= " where mtype = '" . $_POST['mtype'] . "' "; ?>
	<? $_sql .= " group by acadyear,acadsemester order by acadyear,acadsemester "; ?>
    <? $_res = mysql_query($_sql); ?>
	<?  while($_dat = mysql_fetch_assoc($_res)) { 
			$_xmlColumn .= "<set name='" .$_dat['acadsemester'].'/'.$_dat['acadyear']."' value='" . $_dat['total'] . "' color='" . getFCColor() . "' /> ";
		} $_xmlColumn .= "</graph>"; ?>
	<? if(mysql_num_rows($_res)>0) { ?>
		<table class="admintable"  width="100%">
			<tr>
				<th align="center">
					<img src="../images/school_logo.gif" width="120px"><br/>
					แผนภูมิสรุปเปรียบเทียบผลการเข้าร่วมกิจกรรม "<?=displayMtype($_POST['mtype'])?>"<br/>
				</th>
			</tr>
			<tr>
				<td align="center">
					<div id="chart1" align="center" ></div>
				</td>
			</tr>
		</table>
		<script language="javascript" type="text/javascript">			
			FusionCharts.setCurrentRenderer('JavaScript');
			var myColumn = new FusionCharts("../fusionII/charts/Column3D.swf", "myColumn2", "540", "350"); 
			myColumn.setDataXML("<?=$_xmlColumn?>"); 
			myColumn.render("chart1");
			myColumn.addEventListener( "nodatatodisplay", function() { 
									if ( window.windowIsReady ){
										notifyLocalAJAXSecurityRestriction(); 
									}else
									{
										$(document).ready (function(){
											notifyLocalAJAXSecurityRestriction();
										});
									}
								});
		</script> 
	<? } else{ ?><br/><br/><center><font color="#FF0000">ไม่พบข้อมูลตามเงื่อนไขที่คุณเลือก</font></center> <? } ?>
<? } //end if?>
</div>


