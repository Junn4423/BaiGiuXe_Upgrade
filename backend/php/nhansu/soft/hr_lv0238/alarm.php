<?php 
require_once("../clsall/lv_controler.php");
require_once("../clsall/hr_lv0238.php");
$mohr_lv0238=new hr_lv0238($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0238');
if($mohr_lv0238->GetView()==1)
{
$plang=$_GET['lang'];
if($plang!="VN" || $plang=="")
$plang="EN";
$vNow=GetServerDate();
?>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				<li class="home_title">
	<?php 
	$vStrLi='';
	$vStr='';
	$vStrPost='';
	$vCount=0;
	$slq="select * from (select A.lv001,A.lv002,A.lv003,A.lv004,DATEDIFF(B.lv005,'$vNow') State,(select count(*) from hr_lv0038 BB where BB.lv002=A.lv001 and BB.lv004>='$vNow') OverMore,B.lv001 MaHD from hr_lv0020 A inner join hr_lv0038 B on A.lv001=B.lv002  where  B.lv004<='$vNow' and B.lv005>='$vNow' And B.lv005<=(DATE_ADD('$vNow',INTERVAL 30 DAY)) and B.lv009=1  and  A.lv009 not in (2,3,7,5) and  year(A.lv044)<='2015')  MP where MP.State<=30 and MP.OverMore=0 order by MP.State Asc";
$vResult=db_query($slq);
while($vrow=db_fetch_array($vResult))
{
	$vCount++;
	 $vTitle=''; 
	 if(trim($vrow['MaHD'])!='' && $vrow['MaHD']!=null)
	 {
		if($vStrPost=="")
			$vStrPostHD=$vrow['MaHD'];
		else
			$vStrPostHD=$vStrPostHD.",".$vrow['MaHD'];
	 }
			if($plang=="EN")
			{
				if($vStrPost=="")
						$vStrPost=$vrow['lv001'].",";
					else
						$vStrPost=$vStrPost.$vrow['lv001'].",";
				$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td><a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv001']."</a></td><td>"."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."</a>"."</td><td align=center>".$vrow['State']."</td><tr>";
				$vStr=$vStr."<br/><a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."(".$vrow['lv001']." - ExpireDate:".$vrow['State']." day)</a>&nbsp;&nbsp;&nbsp;";
			}
			else 
			{
				if($vStrPost=="")
						$vStrPost=$vrow['lv001'].",";
					else
						$vStrPost=$vStrPost.$vrow['lv001'].",";
				$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td><a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv001']."</a></td><td>"."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."</a>"."</td><td align=center>".$vrow['State']."</td><tr>";
				$vStr=$vStr."<br/><a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>". $vrow['lv004']." ".$vrow['lv003']." ".$vrow['lv002']."(".$vrow['lv001']." - Ngày còn lại:".$vrow['State']." ngày)</a>&nbsp;&nbsp;&nbsp;";
			}
}
		  if($plang=="EN")
			{	
			 $vTitle='STAFF LISTS TO EXPIRE CONTRACT ('.$vCount.')';
			 echo $vTitle.(($vStrPost=='')?'':'<span  style="cursor:pointer" onclick="SendSubmit(document.frmsaphethdthoivu)">View</span> <span  style="cursor:pointer" onclick="SendSubmit(document.frmsaphethdthoivuhd)">View Contract Labor</span>');// onclick="SendCheckApr(2,\''.$vTitle.'\')"
			}
		   else
		   {
		   	 $vTitle= 'DANH SÁCH NHÂN VIÊN SẮP HẾT HẠN HỢP ĐỒNG ('.$vCount.')';
			 echo $vTitle.(($vStrPost=='')?'':'<span style="cursor:pointer" onclick="SendSubmit(document.frmsaphethdthoivu)">Xem</span>&nbsp;&nbsp;<span  style="cursor:pointer" onclick="SendSubmit(document.frmsaphethdthoivuhd)">Xem HĐLĐ</span>'); //onclick="SendCheckApr(2,\''.$vTitle.'\')"
		   }	
?> <div id="calendarview_2" class="viewcalandar" style="width:600px;display: none; clear: both; z-index: 99999;position:relative;clear:both">
					<form action="?lang=<?php echo $plang;?>&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=" method="post" name="frmsaphethdthoivu" id="frmsaphethdthoivu">
							<input type="hidden" name="LSEMPID" value="<?php echo $vStrPost;?>"/>
							
						</form>
						<form action="?lang=<?php echo $plang;?>&opt=5&item=&link=aHJfbHYwMDM4L2hyX2x2MDAzOC5waHA=" method="post" name="frmsaphethdthoivuhd" id="frmsaphethdthoivuhd">
							<input type="hidden" name="LSHDID" value="<?php echo $vStrPostHD;?>"/>
						</form>
						
					<!--<div style="float:left;width:400px">
						<p onclick="closepopcalendar('2')"><img width="20" src="../images/icon/close.png"></p>
						<table class="lvtable">
						<tr><td class="lvhtable">STT</td><td class="lvhtable">Mã</td><td class="lvhtable">Tên</td ></tr>
						<?php //echo $vStrLi;?>
						</table>
					</div>
					<div style="float:right;width:20px;color:red;cursor:pointer;overflow:hidden;"><p onclick="closepopcalendar('2')"><img width="20" src="../images/icon/close.png"></p>--></div>
</li>
					</div>
				</td>
				</tr>
				<tr>
				  <td> 
				  <div>
	<!--<marquee onmouseover="this.stop()" onmouseout="this.start()">-->
	<?php
		//echo $vStr;
?>
	<!--</marquee>         -->
	<?php
	echo '<table class="lvtable">
	<tr><td class="lvhtable">STT</td><td class="lvhtable">Mã</td><td class="lvhtable">Tên</td ><td class="lvhtable"> Ngày còn lại</td ></tr>';

	echo $vStrLi;
	echo '</table>';
	?>
		</div>
		</td>
		</tr>
		</tbody>
		</table>
	
<?php 
}
if($_POST['txtthemes']!="")
	{
		$themes=$_POST['themes'];
		GetUserThemeUpdate($_SESSION['ERPSOFV2RUserID'],$themes);
	}
	else
		$themes=getInfor($_SESSION['ERPSOFV2RUserID'],99);
	if($themes=='')	$themes='lvhrcss';
?>
	<script language="javascript">

		function SendCheckApr(codeid,vTitle)
		{
			var o=document.getElementById('calendarview_'+codeid);
			o.style.display="block";
		}
		function closepopcalendar(codeid)
		{
			var o=document.getElementById('calendarview_'+codeid);
			o.style.display="none";
		}
		function openWD(codeid,vTitle)
		{
			var myWindow = window.open("","MsgWindow"+codeid, "toolbar=yes, scrollbars=yes, resizable=yes, width=auto, height=auto");
			var strcss='<link rel="stylesheet" href="../css/<?php echo $themes;?>.css" type="text/css">';
			var o=document.getElementById('calendarview_'+codeid);
			
			myWindow.document.write(strcss);
			myWindow.document.write('<div class="lv0" align="center">'+vTitle+'</div>');
			myWindow.document.write(o.innerHTML);
		}
</script>
<style>
.home_title
{
	font-weight:bold;
	padding:10px;
	padding-left:20px;
	background:url(pointer.png) no-repeat;
	list-style:none;
}		
		table.ftable
{
	background-color:#fff;
	width:100%;
	text-align:left;
	margin:0 auto;
}
table.ftable tr
{

}
table.f_table tr:nth-child(even) 
{
	background-color:#f0f0f0;
}
table.ftable tr td
{
	padding:8px 15px 8px 15px;
}
table.sftable tr td
{
	padding:2px 10px 2px 10px;
}
table.f_table tr td
{
	padding:6px 15px 6px 15px;
}
table.ftable tr td.grey
{
	background-color:#f0f0f0;
}
.ftable table
{
	width:100%;
}
td.editor table tr td
{
	padding:0px !important;
}
td.titlerow,tr.titlerow
{
	background-color:#fff !important;
	border-bottom:1px #e5e5e5 solid;
}
#tab_notice li:hover
{
	color:#0485be !important;
}
#sof_pages  .sof_pages_content
{
	background:#fff;
	text-align:left;
	padding:10px;
	padding-left:0px;
	padding-right:0px;
}
</style>