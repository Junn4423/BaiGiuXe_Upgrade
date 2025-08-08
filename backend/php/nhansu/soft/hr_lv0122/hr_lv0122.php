<?php
$vDir='';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/hr_lv0122.php");
if($plang=="EN")
			{
$vtitle="MANAGE INCREASE LEVEL SALARY BASIC";
			}
else
{
$vtitle="QUẢN LÝ NÂNG BẬC LƯƠNG CĂN BẢN";
}			
/////////////init object//////////////
$mohr_lv0122=new hr_lv0122($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0122');
if($mohr_lv0122->GetView()==1)
{
	$vsql="select * from hr_lv0008 order by lv004 asc,lv003 asc";
	$vResult=db_query($vsql);
	$stt=0;
	$dep='333333333333333';
	while($vrow=db_fetch_array($vResult))
	{
		if($vrow['lv003']!=$dep)
		{
		$stt++;
		$dep=$vrow['lv003'];
		}
		else
		$stt=1;
		
		$ArrLevel[$vrow['lv004']][$stt]=$vrow['lv002'];		
		$ArrLevel[$vrow['lv004']][$vrow['lv002']]=$stt;
	}
	if($plang=="EN")
			{	
	$vStrTableMin='<table id="lvtoolbar" border="1" align="center" width="100%">
	<tr class="lvhtable"><td class="lvhtable">Order</td><td class="lvhtable">EmployeeID</td><td class="lvhtable">Employee Name</td><td class="lvhtable">Department Name</td><td class="lvhtable">Level curent</td><td class="lvhtable">Date level</td><td class="lvhtable">Next Level</td></tr>
	@01
	</table>';
	$vStrTableMax='<table border="1" id="lvtoolbar"  width="100%">
	<tr class="lvhtable"><td class="lvhtable">Order</td><td class="lvhtable">EmployeeID</td><td class="lvhtable">Employee Name</td><td class="lvhtable">Department Name</td><td class="lvhtable">Level curent</td><td class="lvhtable">Date level</td><td class="lvhtable">Next Level</td></tr>
	@01
	</table>';
	}
	else
	{
		$vStrTableMin='<table id="lvtoolbar"  align="center"  width="100%">
	<tr class="lvhtable"><td class="lvhtable">STT</td class="lvhtable"><td class="lvhtable">Mã nhân viên</td><td class="lvhtable">Tên nhân viên</td><td class="lvhtable">Tên phòng ban</td><td class="lvhtable">Bậc hiện tại</td><td class="lvhtable">Ngày của bậc hiện tại</td><td class="lvhtable">Bậc sắp nâng</td></tr>
	@01
	</table>';
	$vStrTableMax='<table  id="lvtoolbar"  width="100%">
	<tr class="lvhtable"><td class="lvhtable">Stt</td><td class="lvhtable">Mã nhân viên</td><td class="lvhtable">Tên nhân viên</td><td class="lvhtable">Tên phòng ban</td><td class="lvhtable">Bậc hiện tại</td><td class="lvhtable">Ngày của bậc hiện tại</td><td class="lvhtable">Bậc sắp nâng</td></tr>
	@01
	</table>';
	}	
	$vCount=0;
	$sqlS = "SELECT A.lv001,concat(A.lv004,' ',A.lv003,' ',A.lv002) lv002,B.lv003 DepName,(select concat(BB.lv001,'@',BB.lv002,'@',BB.lv005,'@',AA.lv005,'@',DATEDIFF(CURRENT_DATE(),AA.lv005)/(30.4),'@',BB.lv004) from hr_lv0033 AA inner join hr_lv0008 BB on AA.lv003=BB.lv001	 where AA.lv002=A.lv001 order by AA.lv003 DESC limit 0,1) codeid FROM hr_lv0020 A left join hr_lv0002 B on A.lv029=B.lv001 WHERE 1=1 order by A.lv029 asc,A.lv001 asc";
	$str_min="";
	$str_max="";
	$alarmmax=false;
	$alarmmin=false;
	$alarmnotlevel=false;
	$str_td="<tr class='@#00'><td>@#01</td><td>@#02</td><td>@#03</td><td>@#13</td><td>@#04</td><td  align='right'><strong>@#05</strong></td><td align='right'><strong>@#06</strong></td></tr>";
	$vResult=db_query($sqlS);
	while($vrow=db_fetch_array($vResult))
	{
		
		$vArrCode=explode("@",$vrow['codeid']);
		$tmpstr_td=$str_td;
		$tmpstr_td=str_replace("@#02",$vrow['lv001'],$tmpstr_td);
		$tmpstr_td=str_replace("@#03",$vrow['lv002'],$tmpstr_td);
		$tmpstr_td=str_replace("@#13",$vrow['DepName'],$tmpstr_td);
		$tmpstr_td=str_replace("@#04",$vArrCode[1],$tmpstr_td);
		$tmpstr_td=str_replace("@#05",$mohr_lv0122->FormatView($vArrCode[3],2),$tmpstr_td);
		$vsttcur=$ArrLevel[$vArrCode[5]][$vArrCode[1]];
		$tmpstr_td=str_replace("@#06",$ArrLevel[$vArrCode[5]][($vsttcur+1)],$tmpstr_td);
		
		if($vArrCode[0]=='' || $vArrCode[0]==NULL)
		{
			$vCount1++;
			$tmpstr_td=str_replace("@#00","lvlinehtable".($vCount1%2),$tmpstr_td);
			$tmpstr_td=str_replace("@#01",$vCount1,$tmpstr_td);
				$alarmnotlevel=true;
				$tmpstr_td=str_replace("@#05",$mohr_lv0122->FormatView($vrow['lv018'],10),$tmpstr_td);
				$str_notlevel=$str_notlevel.$tmpstr_td;	
		}
		else if($vArrCode[2]-$vArrCode[4]<=0)
		{			
				$vCount2++;
				$tmpstr_td=str_replace("@#00","lvlinehtable".($vCount2%2),$tmpstr_td);
				$tmpstr_td=str_replace("@#01",$vCount2,$tmpstr_td);
				$alarmmin=true;
				$tmpstr_td=str_replace("@#05",$mohr_lv0122->FormatView($vrow['lv018'],10),$tmpstr_td);
				$str_min=$str_min.$tmpstr_td;
		}
		else if($vArrCode[2]-1-$vArrCode[4]<0)
		{
				$vCount3++;
				$tmpstr_td=str_replace("@#00","lvlinehtable".($vCount3%2),$tmpstr_td);
				$tmpstr_td=str_replace("@#01",$vCount3,$tmpstr_td);
				$alarmmax=true;
				$tmpstr_td=str_replace("@#05",$mohr_lv0122->FormatView($vrow['lv019'],10),$tmpstr_td);
				$str_max=$str_max.$tmpstr_td;
		}
		
					
				
	}
?>
	<?php
		
		if($alarmmin)
		{
			echo "<div style='font-weight:bold'><strong>LEVEL SẮP THI 1 THÁNG NÂNG BẬC</strong></div>";
			echo str_replace("@01",$str_min,$vStrTableMin)."<br/>";
		}
		if($alarmmax) 
		{
			echo "<div style='font-weight:bold'><strong>LEVEL ĐƯỢC THI NÂNG BẬC</strong></div>";
			echo str_replace("@01",$str_max,$vStrTableMax)."<br/>";
		}
		if($alarmnotlevel)  
		{
			echo "<div style='font-weight:bold'><strong>KHÔNG THIẾT LẬP TRÌNH ĐỘ CHUYÊN MÔN LÀM VIỆC</strong></div>";
			echo str_replace("@01",$str_notlevel,$vStrTableMax)."<br/>";
		}
	?>
<?php 
} else {
	include("../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vtitle;?>';	
</script>