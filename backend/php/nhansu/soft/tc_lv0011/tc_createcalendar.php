<?php
session_start();
include("../../clsall/lv_controler.php");
include("../../clsall/tc_lv0011.php");
include("../../clsall/tc_lv0010.php");
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0026.txt",$plang);
////////////////////////init object///////////////////////////
$lvtc_lv0011=new tc_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0011');
$lvtc_lv0010=new tc_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0010');
/////////////////////////////////////////////////////////////
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
$vFlag=$_POST['txtFlag'];
$vTimesheetID=$_GET['ChildID'];
$lvtc_lv0010->LV_LoadID($vTimesheetID);
$vsql="select lv004,lv005 from tc_lv0010 where lv001='$vTimesheetID' and lv007<>1";
$vlv009=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$tresult=db_query($vsql);
$vnum=db_num_rows($tresult);
if($vnum>0)
{
$trow=db_fetch_array($tresult);
$vStartDate=$trow['lv004'];
$vEndDate=$trow['lv005'];
$vTimesCodeID=$_POST['txttc_lv007'];
$vDelCalandar=$_POST['chkDelCalandar'];
}
?>
<script language="javascript">
	function CreateCalandar()
	{
		var o=document.frmcreatecalandar;
		if(o.txtlv010.value=='') 
		{
			if(confirm("Ban có muốn dừng tạo hợp đồng khi mã trống"))
			{
				return;
			}
		}
		o.cmdCreateCalandar.disabled=true;
		o.txtFlag.value="1";
		o.submit();
		
	}
</script>
<?php
if($lvtc_lv0011->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<form name="frmcreatecalandar" method="post" action="#">
<?php
if($vnum>0)
{
	if((int)$vFlag==1)
	{
	$vGetMonthEn=array(1=>"january",2=>"february",3=>"march",4=>"april",5=>"may",6=>"june",7=>"july",8=>"august",9=>"september",10=>"october",11=>"november",12=>"december");
	$vStrStartDate=getday($vStartDate)." ".$vGetMonthEn[(int)getmonth($vStartDate)]." ".getyear($vStartDate)." GMT";
	//Tạm thời lịch tối đa 2030 giống với bảng tc_lv0011_
	if(getyear($vEndDate)>2030)
		$vStrEndDate=getday($vEndDate)." ".$vGetMonthEn[(int)getmonth($vEndDate)]." 2030 GMT";
	else
		$vStrEndDate=getday($vEndDate)." ".$vGetMonthEn[(int)getmonth($vEndDate)]." ".getyear($vEndDate)." GMT";
	$vSaveStartDate=strtotime($vStrStartDate);
	$vSaveEndDate=strtotime($vStrEndDate);//+(24 * 60 * 60);
	$vSpecialDate=false;
	//$vDate=strtotime("28 october 2007 GMT")+(24 * 60 * 60);
//	echo date('Y-m-d',$vDate);
	if($vDelCalandar!="")
	{
		//xóa bảng theo timesheetID
		$lvtc_lv0011->LV_DeleteParent($vTimesheetID);
	}
	if($_POST['chkQuickly']==1)
	{	
		if($lvtc_lv0011->LV_CheckCountHDLD($lvtc_lv0010->lv010)<=0)
		{
		
			$vDateLimited=$lvtc_lv0011->LV_GetHoliday($vStartDate,$vEndDate);
			if($vDateLimited=="''")
			{
				$psql="insert into tc_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv099) select '$vTimesheetID',lv003,lv004,lv005,lv006,'$vTimesCodeID',lv008,'$vlv009','".$lvtc_lv0010->lv010."' from tc_lv0011_ where lv004>='$vStartDate' and lv004<='$vEndDate'";
				db_query($psql);
			}
			else
			{
				$psql="insert into tc_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv099) select '$vTimesheetID',lv003,lv004,lv005,lv006,'$vTimesCodeID',lv008,'$vlv009','".$lvtc_lv0010->lv010."' from tc_lv0011_ where lv004>='$vStartDate' and lv004<='$vEndDate' and (lv004 not in ($vDateLimited))";
				db_query($psql);
				$psql="insert into tc_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv099) select '$vTimesheetID',A.lv003,A.lv004,A.lv005,A.lv006,B.lv004,A.lv008,'$vlv009','".$lvtc_lv0010->lv010."' from tc_lv0011_ A left join tc_lv0003 B on A.lv004=B.lv002 where A.lv004>='$vStartDate' and A.lv004<='$vEndDate' and (A.lv004 in ($vDateLimited))";
				db_query($psql);
			}
			echo "Create calendar successfull!<br>";
		}
		else
		{
			echo 'Không tạo được lịch. Hệ thống kiểm tra thấy hợp đồng này đã được tạo';
		}
	}
	else
	{
		//echo "<br/>$vSaveStartDate - $vSaveEndDate <br/>";
		$vVT=1;
		$vj=0;
		$vInsertSelect=Array();
		while((float)$vSaveStartDate<=(float)$vSaveEndDate)
		{
			//break;
			$vj++;
			if($vj==1000)
			{
				$vVT++;
				$vj=0;
			}
			$psql="";
			$vSpecialDate=false;
			$vTempDate=date('Y-m-d',$vSaveStartDate);
			$vsql="select (select count(*) from tc_lv0011 A  where A.lv002='$vTimesheetID'  and A.lv004='$vTempDate') as count1,(select count(*)  from tc_lv0003  where lv002='$vTempDate') count2,(select lv004  from tc_lv0003  where lv002='$vTempDate') NG";
			$tresult=db_query($vsql);
			$tvrow=db_fetch_array($tresult);
			$tnumrows=$tvrow['count1'];
			$vSpecialDate=$tvrow['count2'];
			$vNG=trim($tvrow['NG']);
			
			if($vDelCalandar=="")
			{
			 if($tnumrows==0)
				{
					if($vSpecialDate==0)
					{
						if($vInsertSelect[$vVT]=="")
							$vInsertSelect[$vVT]=$vInsertSelect[$vVT]." (select '$vTimesheetID' lv002,MONTH('$vTempDate') lv003,'$vTempDate' lv004,'$vTimesCodeID' lv007,'$vlv009' lv009,'' lv005,'' lv006,'".$lvtc_lv0010->lv010."' lv099)";
						else
							$vInsertSelect[$vVT]=$vInsertSelect[$vVT]." union (select '$vTimesheetID' lv002,MONTH('$vTempDate') lv003,'$vTempDate' lv004,'$vTimesCodeID' lv007,'$vlv009' lv009,'' lv005,'' lv006,'".$lvtc_lv0010->lv010."' lv099)";
						//$psql="insert into tc_lv0011(lv002,lv003,lv004,lv007,lv009,lv005,lv006,lv099) values('$vTimesheetID',MONTH('$vTempDate'),'$vTempDate','$vTimesCodeID','$vlv009','','','".$lvtc_lv0010->lv010."') ";
					}
					else
					{
						if($vInsertSelect[$vVT]=="")
							$vInsertSelect[$vVT]=$vInsertSelect[$vVT]." (select '$vTimesheetID' lv002,MONTH('$vTempDate') lv003,'$vTempDate' lv004,'$vNG' lv007,'08:00:00' lv005,'$vlv009' lv009,'' lv006,'".$lvtc_lv0010->lv010."' lv099)";
						else
							$vInsertSelect[$vVT]=$vInsertSelect[$vVT]." union (select '$vTimesheetID' lv002,MONTH('$vTempDate') lv003,'$vTempDate' lv004,'$vNG' lv007,'08:00:00' lv005,'$vlv009' lv009,'' lv006,'".$lvtc_lv0010->lv010."' lv099)";
						//$psql="insert into tc_lv0011(lv002,lv003,lv004,lv007,lv005,lv009,lv006,lv099) values('$vTimesheetID',MONTH('$vTempDate'),'$vTempDate','$vNG','08:00:00','$vlv009','','".$lvtc_lv0010->lv010."') ";
					}
				}
			}
			else
			{
				if($vSpecialDate==0)
					{
						if($vInsertSelect[$vVT]=="")
							$vInsertSelect[$vVT]=$vInsertSelect[$vVT]." (select '$vTimesheetID' lv002,MONTH('$vTempDate') lv003,'$vTempDate' lv004,'$vTimesCodeID' lv007,'$vlv009' lv009,'' lv005,'' lv006,'".$lvtc_lv0010->lv010."' lv099)";
						else
							$vInsertSelect[$vVT]=$vInsertSelect[$vVT]." union (select '$vTimesheetID' lv002,MONTH('$vTempDate') lv003,'$vTempDate' lv004,'$vTimesCodeID' lv007,'$vlv009' lv009,'' lv005,'' lv006,'".$lvtc_lv0010->lv010."' lv099)";
						//$psql="insert into tc_lv0011(lv002,lv003,lv004,lv007,lv009,lv005,lv006,lv099) values('$vTimesheetID',MONTH('$vTempDate'),'$vTempDate','$vTimesCodeID','$vlv009','','','".$lvtc_lv0010->lv010."') ";
					}
					else
					{
						if($vInsertSelect[$vVT]=="")
							$vInsertSelect[$vVT]=$vInsertSelect[$vVT]." (select '$vTimesheetID' lv002,MONTH('$vTempDate') lv003,'$vTempDate' lv004,'$vNG' lv007,'08:00:00' lv005,'$vlv009' lv009,'' lv006,'".$lvtc_lv0010->lv010."' lv099)";
						else
							$vInsertSelect[$vVT]=$vInsertSelect[$vVT]." union (select '$vTimesheetID' lv002,MONTH('$vTempDate') lv003,'$vTempDate' lv004,'$vNG' lv007,'08:00:00' lv005,'$vlv009' lv009,'' lv006,'".$lvtc_lv0010->lv010."' lv099)";
						//$psql="insert into tc_lv0011(lv002,lv003,lv004,lv007,lv005,lv009,lv006,lv099) values('$vTimesheetID',MONTH('$vTempDate'),'$vTempDate','$vNG','08:00:00','$vlv009','','".$lvtc_lv0010->lv010."') ";
					}
			}
			$vSaveStartDate=$vSaveStartDate+ (24 * 60 * 60);
		}
		
			foreach($vInsertSelect as $vSelectIns)
			{
				if(trim($vSelectIns)!="")
				{
					 $psql="insert into tc_lv0011(lv002,lv003,lv004,lv007,lv005,lv009,lv006,lv099)  select MP.* from ($vSelectIns) MP";
					db_query($psql);
				}
			}
		echo "Create calendar successfull!<br>";
	}
		
		echo "<input type=\"button\" value=\"Close\"  name=\"cmdclose\" id=\"cmdclose\" onclick=\"javascript:window.close()\"";	
	}
	else
	{
	?>
	  <table width="422" border="1">
		<tr>
		  <td height="26" colspan="2"><label>
			<input name="chkDelCalandar" type="checkbox" id="chkDelCalandar" value="0" /><?php echo $vLangArr[1];?></label></td>
			
		</tr>
		<tr>
		  <td height="26" colspan="2"><label >
			<input name="chkQuickly" type="checkbox" id="chkQuickly" value="1" checked /><?php echo 'Tạo lịch nhanh(Tạo lịch cho lần đầu tiên, đã tạo rồi,không nên check cái này)';?></label></td>
			
		</tr>
		<tr>
		  <td width="157"><?php echo $vLangArr[2];?></td>
		  <td width="440"><select name="txttc_lv007" style="width:144px">
	<?php echo $lvtc_lv0011->LV_LinkField('lv007',($vTimesCodeID=='' || $vTimesCodeID==NULL)?'GLVT':$vTimesCodeID);?>
		  </select>
		    <input name="txtStartDate" type="hidden" id="txtStartDate" value="<?php echo $vStartDate;?>"/>
		    <input name="txtEndDate" type="hidden" id="txtEndDate" value="<?php echo $vEndDate;?>" />
		  <input name="txtTimesheetID" type="hidden" id="txtTimesheetID" value="<?php echo $vTimesheetID;?>" />
		  <input name="txtFlag" type="hidden" id="txtFlag" value="0" /></td>
		</tr>
		<tr>
		  <td width="157"><?php echo $vLangArr[5];?></td>
		   <td width="440">
			<input name="txtlv010" type="textbox" id="txtlv010" value="<?php echo $lvtc_lv0010->lv010;?>" readonly="true" />
		   </td>
		<tr>
		  <td colspan="2"><input name="cmdCreateCalandar" type="submit" id="cmdCreateCalandar" value="<?php echo $vLangArr[3];?>" onclick="CreateCalandar()" /></td>
		</tr>
	  </table>
	<?php
		}
	}
	else
	{
		echo "<input type='button' value='Close' onclick='javascript:window.close()'/>";
	}
	?>	
</form>
</body>
<?php
} else {
	include ("../calandar/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[0];?>';	
</script>
</html>
