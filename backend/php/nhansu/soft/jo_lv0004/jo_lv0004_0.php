<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/jo_lv0004_0.php");
require_once("../clsall/jo_lv0016.php");
require_once("../clsall/tc_lv0013.php");
require_once("../clsall/tc_lv0009.php");
require_once("../clsall/hr_lv0020.php");
require_once("../clsall/hr_lv0002.php");
require_once("../clsall/tc_lv0008.php");
require_once("../clsall/rp_lv0006.php");
//echo base64_encode('jo_lv0004/jo_lv0004_0_2.php');
/////////////init object//////////////
$mojo_lv0004=new jo_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$lvjo_lv0016=new jo_lv0016($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0016');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$mohr_lv0002=new hr_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$motc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$lvtc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$morp_lv0006=new rp_lv0006($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$lvjo_lv0016->LV_Load();
$vSoPhepNamTruoc=0;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if(isset($_GET['ajaxphep']))
{
	$timeid=$_GET['timecardid'];
	$codeid=$_GET['codeid'];
	$lvNVID=$_GET['NVID'];
	$vNgayPhepFrom=$_GET['NgayPhepFrom'];
	$vNgayPhepTo=$_GET['NgayPhepTo'];
	if($vNgayPhepFrom!='' && $vNgayPhepTo!='')
	{
		$vNgayFrom=recoverdate($_GET['NgayPhepFrom'],'VN');
		$vNgayTo=recoverdate($_GET['NgayPhepTo'],'VN');
		
		$month=getmonth($vNgayFrom);
		$year=getyear($vNgayFrom);
		if(getmonth($mojo_lv0004->DateCurrent)==1 && $month==1)
		{
			$lvtc_lv0008->LV_LoadCurrentID($lvtc_lv0008->LV_UserID,getyear($lvtc_lv0008->DateCurrent));
			$vSoPhepNamTruoc=$lvtc_lv0008->lv008;
		}
		$motc_lv0009->LV_LoadMonthID($motc_lv0009->LV_UserID,$month,$year);
		$vPDK=(float)$motc_lv0009->lv121;
		$vNumDayInMonth= GetDayInMonth((int)$year,(int)$month);
		$vStartDate=$year."-".Fillnum($month,2)."-01";
		$vEndDate=$year."-".Fillnum($month,2)."-".Fillnum($vNumDayInMonth,2);
		$vListPhep="'P','1/2P'";
		$vArrPhepP=$mojo_lv0004->LV_CheckXinPN($motc_lv0009->LV_UserID,$vStartDate,$vEndDate,$vListPhep);
		$vNum_FN_FM=$mojo_lv0004->LV_GetPNThamNien($motc_lv0009->LV_UserID,$vStartDate);
		$vPhepNamCon=$vNum_FN_FM+$vSoPhepNamTruoc+$motc_lv0009->lv121-$vArrPhepP[1]-$vArrPhepP[0];
		$vHeSo=1;
		if($codeid=='1/2P') $vHeSo=0.5;
		$vSoNgayXin=(DATEDIFF($vNgayTo,$vNgayFrom)+1)*$vHeSo;
		echo '[CHECKDEF]';
		echo ($vPhepNamCon-$vSoNgayXin);
		echo '[ENDCHECKDEF]';
	}
	exit;
}
if($motc_lv0013->GetApr()==1 && $motc_lv0013->GetUnApr()==1)
{
	if(isset($_POST['txtCalID']))
	{
		$motc_lv0013->LV_SetCal($_POST['txtCalID']);
	}
	$motc_lv0013->LV_GetCal();
	if($motc_lv0013->lv999!='' || $motc_lv0013->lv999!=NULL)
	{
		$motc_lv0013->LV_LoadID($motc_lv0013->lv999);
	}
	else
		$motc_lv0013->LV_LoadActiveID();
?>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				
	 <form name="frmcalculate" method="post">
	<?php 
	
		  $vTitle=''; 
		  if($plang=="EN")
			{	

					echo 'OPTION PARAMETER TO CACULATE ';
			}
		   else
		   {
				echo 'CHỌN THÔNG SỐ TÍNH LƯƠNG';
		   }
		   ?>
		   <input type="hidden" name="lang" value="<?php echo $_GET['lang'];?>"/>
		    <select name="txtCalID">
		    	<option value=""></option>
				<?php echo $motc_lv0013->LV_LinkField('lv999',$motc_lv0013->lv999);?>
			</select>
		  	<input type="submit" value="Chọn ngay" onclick="document.frmcalculate.submit()"/>
		  	</form>
		  	</div>
		  	
		</td>
		</tr>
		</tbody>
		</table>	
<?php
}
else
	$motc_lv0013->LV_LoadActiveID();
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","JO0005.txt",$plang);
$mojo_lv0004->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mojo_lv0004->ArrPush[0]=$vLangArr[17];
$mojo_lv0004->ArrPush[1]=$vLangArr[18];
$mojo_lv0004->ArrPush[2]=$vLangArr[19];
$mojo_lv0004->ArrPush[3]=$vLangArr[20];
$mojo_lv0004->ArrPush[4]=$vLangArr[21];
$mojo_lv0004->ArrPush[5]=$vLangArr[22];
$mojo_lv0004->ArrPush[6]=$vLangArr[23];
$mojo_lv0004->ArrPush[7]=$vLangArr[24];
$mojo_lv0004->ArrPush[8]=$vLangArr[25];
$mojo_lv0004->ArrPush[9]=$vLangArr[26];
$mojo_lv0004->ArrPush[10]=$vLangArr[27];
$mojo_lv0004->ArrPush[11]=$vLangArr[28];
$mojo_lv0004->ArrPush[12]=$vLangArr[29];
$mojo_lv0004->ArrPush[13]=$vLangArr[30];
$mojo_lv0004->ArrPush[14]=$vLangArr[31];
$mojo_lv0004->ArrPush[15]=$vLangArr[32];
$mojo_lv0004->ArrPush[16]=$vLangArr[33];
$mojo_lv0004->ArrPush[17]=$vLangArr[34];
$mojo_lv0004->ArrPush[18]=$vLangArr[35];
$mojo_lv0004->ArrPush[19]=$vLangArr[36];
$mojo_lv0004->ArrPush[20]=$vLangArr[37];
$mojo_lv0004->ArrPush[21]=$vLangArr[38];
$mojo_lv0004->ArrPush[22]=$vLangArr[39];
$mojo_lv0004->ArrPush[23]=$vLangArr[40];
$mojo_lv0004->ArrPush[24]=$vLangArr[41];
$mojo_lv0004->ArrPush[26]='Ngày tạo đơn';
$mojo_lv0004->ArrPush[100]='Tên';
$mojo_lv0004->ArrPush[99]='Số ngày';
$mojo_lv0004->ArrPush[830]='Phòng ban';

$mojo_lv0004->ArrFunc[0]='//Function';
$mojo_lv0004->ArrFunc[1]=$vLangArr[2];
$mojo_lv0004->ArrFunc[2]=$vLangArr[4];
$mojo_lv0004->ArrFunc[3]=$vLangArr[6];
$mojo_lv0004->ArrFunc[4]=$vLangArr[7];
$mojo_lv0004->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mojo_lv0004->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mojo_lv0004->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mojo_lv0004->ArrFunc[8]=$vLangArr[10];
$mojo_lv0004->ArrFunc[9]=$vLangArr[12];
$mojo_lv0004->ArrFunc[10]=$vLangArr[0];
$mojo_lv0004->ArrFunc[11]=$vLangArr[44];
$mojo_lv0004->ArrFunc[12]=$vLangArr[45];
$mojo_lv0004->ArrFunc[13]=$vLangArr[46];
$mojo_lv0004->ArrFunc[14]=$vLangArr[47];
$mojo_lv0004->ArrFunc[15]=$vLangArr[48];

////Other
$mojo_lv0004->ArrOther[1]=$vLangArr[42];
$mojo_lv0004->ArrOther[2]=$vLangArr[43];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vOrderList=$_POST['txtOrderList'];
$vkeep=$_POST['qxtlvkeep'];
$vStrMessage="";
if(!isset($_POST['txtStringID']))
{
	$vDateCur=ADDDATE(GetServerDate(),2);
	$mojo_lv0004->tv016_1=$mojo_lv0004->FormatView($vDateCur,2);
	$mojo_lv0004->tv017_1=$mojo_lv0004->FormatView($vDateCur,2);
	$mojo_lv0004->tv016_2='08:00:00';
	$mojo_lv0004->tv017_2='17:00:00';
	if($mojo_lv0004->LV_UserID=='MP001' || $mojo_lv0004->LV_UserID=='MP002') $_POST['curTabView']=1;
}
if($flagID==1)
{
	$strar="'".$strchk."'";
	$vresult=$mojo_lv0004->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"jo_lv0004",$lvMessage);
}
elseif($flagID==2)
{
$mojo_lv0004->lv001=$_POST['txtlv001'];
$mojo_lv0004->lv002=$_POST['txtlv002'];
$mojo_lv0004->lv003=$_POST['txtlv003'];
$mojo_lv0004->lv004=$_POST['txtlv004'];
$mojo_lv0004->lv005=$_POST['txtlv005'];
$mojo_lv0004->lv006=$_POST['txtlv006'];
$mojo_lv0004->lv007=$_POST['txtlv007'];
$mojo_lv0004->lv008=$_POST['txtlv008'];
$mojo_lv0004->lv009=$_POST['txtlv009'];
$mojo_lv0004->lv010=$_POST['txtlv010'];
$mojo_lv0004->lv011=$_POST['txtlv011'];
$mojo_lv0004->lv012=$_POST['txtlv012'];
$mojo_lv0004->lv013=$_POST['txtlv013'];
$mojo_lv0004->lv014=$_POST['txtlv014'];
$mojo_lv0004->lv015=$_POST['txtlv015'];
$mojo_lv0004->lv016=$_POST['txtlv016'];
$mojo_lv0004->lv017=$_POST['txtlv017'];
$mojo_lv0004->lv018=$_POST['txtlv018'];
$mojo_lv0004->lv019=$_POST['txtlv019'];
$mojo_lv0004->lv020=$_POST['txtlv020'];
$mojo_lv0004->lv021=$_POST['txtlv021'];
$mojo_lv0004->lv022=$_POST['txtlv022'];
$mojo_lv0004->lv023=$_POST['txtlv023'];
$mojo_lv0004->lv024=$_POST['txtlv024'];
$mojo_lv0004->lv025=$_POST['txtlv025'];

}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mojo_lv0004->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mojo_lv0004->LV_UnAproval($strar);
}
elseif($flagID==6)
{
	$mojo_lv0004->lv002=$_POST['qxtlv002'];
	$mojo_lv0004->lv003=$_POST['qxtlv003'];
	$mojo_lv0004->lv008=$_POST['qxtlv008'];
	$mojo_lv0004->lv015=$mojo_lv0004->LV_UserID;
	$mojo_lv0004->lv022=$_POST['qxtlv022'];
	$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
	$mohr_lv0020->LV_LoadID($mojo_lv0004->lv015);
	$mohr_lv0002->LV_LoadID($mohr_lv0020->lv029);
	$mojo_lv0004->lv013=$mohr_lv0002->lv100;
	$mojo_lv0004->lv012=getInfor($_SESSION['ERPSOFV2RUserID'],2);
	$mojo_lv0004->lv016=$_POST['qxtlv016_1']." ".$_POST['qxtlv016_2'];
	$mojo_lv0004->tv016_1=$_POST['qxtlv016_1'];
	$mojo_lv0004->tv016_2=$_POST['qxtlv016_2'];
	if($mojo_lv0004->lv003=='QCC')
	{
		$mojo_lv0004->lv017=$mojo_lv0004->lv016;
		$mojo_lv0004->tv017_1=$mojo_lv0004->lv016_1;
		$mojo_lv0004->tv017_2=$mojo_lv0004->lv016_2;
	}
	else
	{
		$mojo_lv0004->lv017=$_POST['qxtlv017_1']." ".$_POST['qxtlv017_2'];
		$mojo_lv0004->tv017_1=$_POST['qxtlv017_1'];
		$mojo_lv0004->tv017_2=$_POST['qxtlv017_2'];
	}
	$mojo_lv0004->lv018=$_POST['qxtlv018_1']." ".$_POST['qxtlv018_2'];
	if(trim($mojo_lv0004->lv018)=='') 	$mojo_lv0004->lv018=$mojo_lv0004->lv016;
	$mojo_lv0004->lv019=$_POST['qxtlv019_1']." ".$_POST['qxtlv019_2'];
	if(trim($mojo_lv0004->lv019)=='') 	$mojo_lv0004->lv019=$mojo_lv0004->lv017;
	$mojo_lv0004->lv014=$mohr_lv0020->lv042;
	if($mojo_lv0004->lv014=="") $mojo_lv0004->lv014=$lvjo_lv0016->lv003;
	if($mojo_lv0004->lv014=="") $mojo_lv0004->lv014=$lvjo_lv0016->lv004;
	/*
	else
		$mojo_lv0004->lv014=$mojo_lv0004->lv014.";".$lvjo_lv0016->lv004;*/
			$mojo_lv0004->lv004=0;
		$mojo_lv0004->lv006=0;
	$isPN=true;	
	//Kiem tra phep nam P
	$vNgayXin=recoverdate($mojo_lv0004->lv016,$plang);
	$vNgayXinDen=recoverdate($mojo_lv0004->lv017,$plang);
	$vSoNgay=DATEDIFF(substr($mojo_lv0004->DateCurrent,0,10),$vNgayXin);
	$vSoLonHon=DATEDIFF($vNgayXinDen,$vNgayXin);
	if($vSoLonHon<0)
	{
		$isPN=false;
		echo '<font color="red">Đến ngày không nhỏ hơn ngày từ ngày!</font>';
	}
	if($vSoNgay>=7)
	{
		$isPN=false;
		echo '<font color="red">Đơn xin phép không quá 7 ngày!</font>';
	}
	$vDows=date('w', strtotime($vNgayXin))+1;
	if($vDows==7 && substr($mojo_lv0004->lv003,0,3)=='1/2' && $mohr_lv0020->lv027=='VP')
	{
		$isPN=false;
		echo '<font color="red">Thứ 7 không được xin '.$mojo_lv0004->lv003.' phép!';
	}
	else
	{
		if($isPN)
		{	
			switch($mojo_lv0004->lv003)
			{
				case 'P':
				case '1/2P':
					//$mohr_lv0020->lv030;
					//Điều chỉnh xác định thời gian là 2 tháng.
					//Khi dò tháng kế tiếp..Thì lấy thêm đầu tháng trước để xử lý.
					
					$vPhepXin=(DATEDIFF($vNgayXinDen,$vNgayXin)+1)*(($mojo_lv0004->lv003=='P')?1:0.5);
					$visSoNgay=DATEDIFF($vNgayXin,$mohr_lv0020->lv030);
					if($visSoNgay<60)
					{
						$isPN=false;
						echo '<font color="red">Đơn phép năm được dùng sau 2 tháng thử việc!</font>';	
					}
					else
					{
						///Xử lý thêm trường hợp phép là phép tháng tới
						$vDateTime=$mojo_lv0004->DateCurrent;
						if(getyear($vNgayXin)==getyear($vDateTime) && getmonth($vNgayXin)==getmonth($vDateTime))
						{
							$vPhepNamCon=$_POST['PhepNamCon'];
						}
						else
						{
							$vIsNextMonth=false;
							if(getmonth($vNgayXin)==1)
							{
								if((getyear($vNgayXin)==getyear($vDateTime)+1) && getmonth($vDateTime)==12)
								{
									$vIsNextMonth=true;
								}
							}
							else
							{
								if(getyear($vNgayXin)==getyear($vDateTime) && getmonth($vNgayXin)==getmonth($vDateTime)+1)
								{
									$vIsNextMonth=true;
								}
							}
							if($vIsNextMonth)
							{
								///Cho phép xử lý tháng kế tiếp cộng thêm tháng phép hiện tại
								$vPhepNamCon1=$_POST['PhepNamCon'];
								$vPhepNamCon=0;
								/////Xu lly
								$month=getmonth($vNgayXin);
								$year=getyear($vNgayXin);
								if(getmonth($mojo_lv0004->DateCurrent)==1 && $month==1)
								{
									$lvtc_lv0008->LV_LoadCurrentID($lvtc_lv0008->LV_UserID,getyear($lvtc_lv0008->DateCurrent));
									$vSoPhepNamTruoc=$lvtc_lv0008->lv008;
								}
								$motc_lv0009->LV_LoadMonthID($motc_lv0009->LV_UserID,$month,$year);
								if($motc_lv0009->lv001==null)
								{
									$motc_lv0009->LV_UpdatePreHSo($month,$year);
								}
								$motc_lv0008->LV_LoadCurrentID($motc_lv0009->LV_UserID,$year);
								$vDateFrom="$year-01-01";
								$vDateTo=$motc_lv0009->DateCurrent;
								//$vKL=$mohr_lv0020->LV_GetPhepFromTo($motc_lv0009->LV_UserID,$vPhep,$vDateFrom,$vDateTo);
								//$mojo_lv0004->ListEmp=$mojo_lv0004->LV_CheckPhepFilter($mojo_lv0004->lv016_,$mojo_lv0004->lv017_);
								$totalRowsC=$mojo_lv0004->GetCount();
								$vListPhep="'P','1/2P'";
								$vDateFromP="$year-$month-01";
								$vDateToP="$year-$month-".GetDayInMonth((int)$year,(int)$month);;
								//$vDateToP='';
								$vArrPhepP=$mojo_lv0004->LV_CheckXinPN($motc_lv0009->LV_UserID,$vDateFromP,$vDateToP,$vListPhep);
								$mohr_lv0020->LV_LoadID($mohr_lv0020->LV_UserID);
								$vNum_FN_FM=$mojo_lv0004->LV_GetPNThamNien($mohr_lv0020->LV_UserID,$vDateFromP);
								if(getyear($mohr_lv0020->lv030)==$year && getmonth($mohr_lv0020->lv030)==$month)
								{
									$vPhepNamCon=0;
								}
								elseif(getyear($mohr_lv0020->lv044)==$year && getmonth($mohr_lv0020->lv044)==$month)
								{
									if(getday($mohr_lv0020->lv044)>15)
									{
										$vPhepNamCon=$vNum_FN_FM+$vSoPhepNamTruoc+$motc_lv0009->lv121-$vArrPhepP[1]-$vArrPhepP[0]+1;
									}
									else
									$vPhepNamCon=$vNum_FN_FM+$vSoPhepNamTruoc+$motc_lv0009->lv121-$vArrPhepP[1]-$vArrPhepP[0];
								}
								else
								{
									//echo "$vNum_FN_FM+$vSoPhepNamTruoc+$motc_lv0009->lv121-".$vArrPhepP[1]."-".$vArrPhepP[0]."+1=";
									$vPhepNamCon=$vNum_FN_FM+$vSoPhepNamTruoc+$motc_lv0009->lv121-$vArrPhepP[1]-$vArrPhepP[0]+1;
								}
								$vPhepNamCon=$vPhepNamCon+$vPhepNamCon1;
							}
							else
							{
								//Xử lý theo như trước
								//xu ly phep năm của tháng
								$vPhepNamCon=0;
								/////Xu lly
								$month=getmonth($vNgayXin);
								$year=getyear($vNgayXin);
								if(getmonth($mojo_lv0004->DateCurrent)==1 && $month==1)
								{
									$lvtc_lv0008->LV_LoadCurrentID($lvtc_lv0008->LV_UserID,getyear($lvtc_lv0008->DateCurrent));
									$vSoPhepNamTruoc=$lvtc_lv0008->lv008;
								}
								$motc_lv0009->LV_LoadMonthID($motc_lv0009->LV_UserID,$month,$year);
								if($motc_lv0009->lv001==null)
								{
									$motc_lv0009->LV_UpdatePreHSo($month,$year);
								}
								$motc_lv0008->LV_LoadCurrentID($motc_lv0009->LV_UserID,$year);
								$vDateFrom="$year-01-01";
								$vDateTo=$motc_lv0009->DateCurrent;
								//$vKL=$mohr_lv0020->LV_GetPhepFromTo($motc_lv0009->LV_UserID,$vPhep,$vDateFrom,$vDateTo);
								//$mojo_lv0004->ListEmp=$mojo_lv0004->LV_CheckPhepFilter($mojo_lv0004->lv016_,$mojo_lv0004->lv017_);
								$totalRowsC=$mojo_lv0004->GetCount();
								$vListPhep="'P','1/2P'";
								$vDateFromP="$year-$month-01";
								$vDateToP="$year-$month-".GetDayInMonth((int)$year,(int)$month);;
								//$vDateToP='';
								$vArrPhepP=$mojo_lv0004->LV_CheckXinPN($motc_lv0009->LV_UserID,$vDateFromP,$vDateToP,$vListPhep);
								$mohr_lv0020->LV_LoadID($mohr_lv0020->LV_UserID);
								$vNum_FN_FM=$mojo_lv0004->LV_GetPNThamNien($mohr_lv0020->LV_UserID,$vDateFromP);
								if(getyear($mohr_lv0020->lv030)==$year && getmonth($mohr_lv0020->lv030)==$month)
								{
									$vPhepNamCon=0;
								}
								elseif(getyear($mohr_lv0020->lv044)==$year && getmonth($mohr_lv0020->lv044)==$month)
								{
									if(getday($mohr_lv0020->lv044)>15)
									{
										$vPhepNamCon=$vNum_FN_FM+$vSoPhepNamTruoc+$motc_lv0009->lv121-$vArrPhepP[1]-$vArrPhepP[0]+1;
									}
									else
									$vPhepNamCon=$vNum_FN_FM+$vSoPhepNamTruoc+$motc_lv0009->lv121-$vArrPhepP[1]-$vArrPhepP[0];
								}
								else
								{
									//echo "$vNum_FN_FM+$vSoPhepNamTruoc+$motc_lv0009->lv121-".$vArrPhepP[1]."-".$vArrPhepP[0]."+1=";
									$vPhepNamCon=$vNum_FN_FM+$vSoPhepNamTruoc+$motc_lv0009->lv121-$vArrPhepP[1]-$vArrPhepP[0]+1;
								}
							}
							//////////////////////////////
						}
						if($vPhepXin>$vPhepNamCon)
						{
							$isPN=false;	
							echo '<font color="red">Phép năm xin phép:'.$vPhepXin.'>'.$vPhepNamCon.' phép còn lại!</font>';
						}
						else
						{
							$isPN=true;	
						}
					}
					break;
				default:
					$isPN=true;	
					break;
			}
		}
	}
	if($isPN)
	{	
		$vresult=$mojo_lv0004->LV_Insert_NoID();	
		$mojo_lv0004->lv002='';
		$mojo_lv0004->lv002='';
		$mojo_lv0004->lv003='';
		$mojo_lv0004->lv004='';
		$mojo_lv0004->lv005='';
		$mojo_lv0004->lv006='';
		$mojo_lv0004->lv007='';
		$mojo_lv0004->lv008='';
		$mojo_lv0004->lv009='';
		$mojo_lv0004->lv010='';
		$mojo_lv0004->lv011='';
		$mojo_lv0004->lv012='';
		$mojo_lv0004->lv013='';
		$mojo_lv0004->lv014='';
		$mojo_lv0004->lv015='';
		$mojo_lv0004->lv016='';
		$mojo_lv0004->lv017='';
		$mojo_lv0004->lv018='';
		$mojo_lv0004->lv019='';
		$mojo_lv0004->lv022='';
	}
	else
	{
		$mojo_lv0004->tv001=$vkeep;
		$mojo_lv0004->tv002=$_POST['qxtlv002'];
		$mojo_lv0004->tv003=$_POST['qxtlv003'];
		$mojo_lv0004->tv008=$_POST['qxtlv008'];
		$mojo_lv0004->tv015=$_POST['qxtlv015'];
		$mojo_lv0004->tv022=$_POST['qxtlv022'];
		$mojo_lv0004->tv016=$_POST['qxtlv016_1']." ".$_POST['qxtlv016_2'];
		$mojo_lv0004->tv017=$_POST['qxtlv017_1']." ".$_POST['qxtlv017_2'];
		$mojo_lv0004->tv018=$_POST['qxtlv018_1']." ".$_POST['qxtlv018_2'];
		$mojo_lv0004->tv019=$_POST['qxtlv019_1']." ".$_POST['qxtlv019_2'];
	}
	
	
}
if($vkeep==1)
{
	$mojo_lv0004->tv001=$vkeep;
	$mojo_lv0004->tv002=$_POST['qxtlv002'];
	$mojo_lv0004->tv003=$_POST['qxtlv003'];
	$mojo_lv0004->tv008=$_POST['qxtlv008'];
	$mojo_lv0004->tv015=$_POST['qxtlv015'];
	$mojo_lv0004->tv022=$_POST['qxtlv022'];
	$mojo_lv0004->tv016=$_POST['qxtlv016_1']." ".$_POST['qxtlv016_2'];
	$mojo_lv0004->tv017=$_POST['qxtlv017_1']." ".$_POST['qxtlv017_2'];
	$mojo_lv0004->tv018=$_POST['qxtlv018_1']." ".$_POST['qxtlv018_2'];
	$mojo_lv0004->tv019=$_POST['qxtlv019_1']." ".$_POST['qxtlv019_2'];
}
else
{
	$mojo_lv0004->tv015=$mojo_lv0004->LV_UserID;
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mojo_lv0004->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'jo_lv0004');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mojo_lv0004->ListView;
$curPage = $mojo_lv0004->CurPage;
$maxRows =$mojo_lv0004->MaxRows;
$vOrderList=$mojo_lv0004->ListOrder;
$vSortNum=$mojo_lv0004->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mojo_lv0004->SaveOperation($_SESSION['ERPSOFV2RUserID'],'jo_lv0004',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;
//if($mojo_lv0004->GetApr()<>1 || $mojo_lv0004->GetUnApr()<>1)
{
 $mojo_lv0004->lv015=$mojo_lv0004->LV_UserID;
}
$mojo_lv0004->checkmonth=$_POST['txtcheckmonth'];
if($mojo_lv0004->checkmonth==0)
{
	//$motc_lv0013->LV_LoadActiveID();
	//$mojo_lv0004->lv016_=$motc_lv0013->lv004;
	//$mojo_lv0004->lv017_=$motc_lv0013->lv005;
	
}
$month=getmonth($motc_lv0009->DateCurrent);
$year=getyear($motc_lv0009->DateCurrent);
$motc_lv0009->LV_LoadMonthID($motc_lv0009->LV_UserID,$month,$year);
if($motc_lv0009->lv001==null)
{
	$motc_lv0009->LV_UpdatePreHSo($month,$year);
}
$motc_lv0008->LV_LoadCurrentID($motc_lv0009->LV_UserID,$year);
$vPhep="'KL','1/2KL'";
$vDateFrom="$year-01-01";
$vDateTo=$motc_lv0009->DateCurrent;
$vDateFromP="$year-$month-01";
$vDateToP="$year-$month-".GetDayInMonth((int)$year,(int)$month);;
$vArrPhepKL=$mojo_lv0004->LV_CheckXinKL($motc_lv0009->LV_UserID,$vDateFromP,$vDateToP,$vPhep);
$mohr_lv0020->LV_GetPhepFromToKL($motc_lv0009->LV_UserID,$vPhep,$vDateFrom,$vDateFromP);
$vKL=$mohr_lv0020->LV_GetPhepFromToKL($motc_lv0009->LV_UserID,$vPhep,$vDateFrom,$vDateFromP)+$vArrPhepKL[0]+$vArrPhepKL[1];
//$mojo_lv0004->ListEmp=$mojo_lv0004->LV_CheckPhepFilter($mojo_lv0004->lv016_,$mojo_lv0004->lv017_);
$totalRowsC=$mojo_lv0004->GetCount();
$vListPhep="'P','1/2P'";

$vDateToP='';
$vArrPhepP=$mojo_lv0004->LV_CheckXinPN($motc_lv0009->LV_UserID,$vDateFromP,$vDateToP,$vListPhep);
if($month==12)
{
	$vDateFromPN=($year+1)."-01-01";
	$vDateToPN=($year+1)."-01-31";
}
else
{
	$vDateFromPN="$year-".Fillnum($month+1,2)."-01";
	$vDateToPN="$year-".Fillnum($month+1,2)."-".GetDayInMonth((int)$year,(int)$month+1);
}
$vArrPhepPN=$mojo_lv0004->LV_CheckXinPN($motc_lv0009->LV_UserID,$vDateFromPN,$vDateToPN,$vListPhep);
$vPhepCongThangTruoc=0;
if($vArrPhepPN[1]+$vArrPhepPN[0]>0)
{
	$vPhepCongThangTruoc=1;
}
$mohr_lv0020->LV_LoadID($mohr_lv0020->LV_UserID);
$vNum_FN_FM=$mojo_lv0004->LV_GetPNThamNien($mohr_lv0020->LV_UserID,$vDateFromP);
if(getmonth($mojo_lv0004->DateCurrent)==1 && $month==1)
{
	$lvtc_lv0008->LV_LoadCurrentID($lvtc_lv0008->LV_UserID,getyear($lvtc_lv0008->DateCurrent));
	$vSoPhepNamTruoc=$lvtc_lv0008->lv008-$vArrPhepPN[1]-$vArrPhepPN[0]+$vPhepCongThangTruoc;
}
if(getyear($mohr_lv0020->lv030)==$year && getmonth($mohr_lv0020->lv030)==$month)
{
	$vPhepNamCon=0;
}
elseif(getyear($mohr_lv0020->lv044)==$year && getmonth($mohr_lv0020->lv044)==$month)
{
	if(getday($mohr_lv0020->lv044)>15)
	{
		$vPhepNamCon=$vNum_FN_FM+$vSoPhepNamTruoc+$motc_lv0009->lv121-$vArrPhepP[1]-$vArrPhepP[0]-$vArrPhepPN[1]-$vArrPhepPN[0]+$vPhepCongThangTruoc+1;
	}
	else
		$vPhepNamCon=$vNum_FN_FM+$vSoPhepNamTruoc+$motc_lv0009->lv121-$vArrPhepP[1]-$vArrPhepP[0]-$vArrPhepPN[1]-$vArrPhepPN[0]+$vPhepCongThangTruoc;
}
else
{
	//echo "$vNum_FN_FM+$vSoPhepNamTruoc+$motc_lv0009->lv121-".$vArrPhepP[1]."-".$vArrPhepP[0]."+1=";
	$vPhepNamCon=$vNum_FN_FM+$vSoPhepNamTruoc+$motc_lv0009->lv121-$vArrPhepP[1]-$vArrPhepP[0]-$vArrPhepPN[1]-$vArrPhepPN[0]+$vPhepCongThangTruoc+1;
}
//echo "$motc_lv0009->lv121-$vArrPhepP[1]-$vArrPhepP[0]+1";
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<script language="JavaScript" type="text/javascript">
<!--
function Add()
{

RunFunction('','add');
}
function Edt()
{
	lv_chk_list(document.frmchoose,'lvChk',2);
}
function Edit(vValue)
{

	RunFunction(vValue,'edit');
}
function Fil()
{
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv0010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&lv015=<?php echo $_POST['txtlv015'];?>&lv016=<?php echo $_POST['txtlv016'];?>&lv017=<?php echo $_POST['txtlv017'];?>&lv018=<?php echo $_POST['txtlv018'];?>&lv019=<?php echo $_POST['txtlv019'];?>&lv020=<?php echo $_POST['txtlv020'];?>&lv021=<?php echo $_POST['txtlv021'];?>&lv022=<?php echo $_POST['txtlv022'];?>&lv023=<?php echo $_POST['txtlv023'];?>&lv024=<?php echo $_POST['txtlv024'];?>&lv025=<?php echo $_POST['txtlv025'];?>&checkmonth=<?php echo $_POST['txtcheckmonth'];?>','filter');
}
function Del()
{
	lv_chk_list(document.frmchoose,'lvChk',3);
}
function Delete(vValue)
{
	if(confirm("Bạn có muốn xoá phép này không?(Y/N)"))
	{
 		var o=document.frmchoose;
 		o.txtStringID.value=vValue;
		o.txtFlag.value=1;
	 	o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 	o.submit();
	}

}
function FunctRunning1(vID)
{
RunFunction(vID,'child');
}
function RunFunction(vID,func)
{
	var oparent=window.parent.document.getElementById('showparent');
	if(oparent!=null) 
		var oheight=parseInt(oparent.style.height);
	else
		var oheight=0;
	oheight=oheight-10;
	if(isNaN(oheight)) oheight=1000;
	if(oheight<0) oheight=1000;
	switch(func)
	{
		case 'child':
			var str="<br><iframe height=1900 marginheight=0 marginwidth=0 frameborder=0 src=jo_lv0004?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
		default:
			var str="<br><iframe height=1900 marginheight=0 marginwidth=0 frameborder=0 src=jo_lv0004?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
	}
	
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function Apr()
{
	lv_chk_list(document.frmchoose,'lvChk',9);
}
function Approvals(vValue)
{
var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=3;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();
}
function UnApr()
{
	lv_chk_list(document.frmchoose,'lvChk',10);
}
function UnApprovals(vValue)
{
var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=4;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();
}
function Rpt()
{
	lv_chk_list(document.frmchoose,'lvChk',4);
}
function Report(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>jo_lv0004?func=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
function Save()
{
	var o=document.frmchoose;
	o.txtFlag.value=6;
	if(o.qxtlv003.value=="" )
	{
		alert("Xin vui lòng chọn phép!");
		o.qxtlv003.focus();
	}
	else if(o.qxtlv016_1.value=="" && o.qxtlv017_1.value=="")
	{
		alert("Ngày không rỗng!");
		if(o.qxtlv016_1.value=="")
		{
			
			o.qxtlv016_1.focus();
		}
		else
		{
			o.qxtlv017_1.focus();
		}
	}
	else
	{
		
		o.submit();
		
	}
}
function SetDefaultGio(value)
{
	switch(parseInt(value))
	{
		case 6:
			if(document.getElementById('qxtlv016_2').value=='') document.getElementById('qxtlv016_2').value='22:00';
			if(document.getElementById('qxtlv017_2').value=='')  document.getElementById('qxtlv017_2').value='';
			break;
		case 5:
			if(document.getElementById('qxtlv016_2').value=='') document.getElementById('qxtlv016_2').value='12:00';
			if(document.getElementById('qxtlv017_2').value=='')  document.getElementById('qxtlv017_2').value='13:00';
			break;
		case 4:
			if(document.getElementById('qxtlv016_2').value=='') document.getElementById('qxtlv016_2').value='17:00';
			if(document.getElementById('qxtlv017_2').value=='')  document.getElementById('qxtlv017_2').value='20:00';
			break;
		case 0:
			if(document.getElementById('qxtlv016_2').value=='') document.getElementById('qxtlv016_2').value='08:00';
			if(document.getElementById('qxtlv017_2').value=='')  document.getElementById('qxtlv017_2').value='17:00';
			break;
		default:
		if(document.getElementById('qxtlv016_2').value=='') document.getElementById('qxtlv016_2').value='00:00';
		if(document.getElementById('qxtlv017_2').value=='')  document.getElementById('qxtlv017_2').value='00:00';
			break;
	}		
	
}
function runchangephep(codeid)
		{
			if(codeid!='P' && codeid!='0.5P')
			{
				return ;
			} 
			$xmlhttp=null;
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var lvNVID=document.getElementById('qxtlv015').value;
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxphep=program"+"&year=<?php echo $motc_lv0013->lv007;?>&month=<?php echo $motc_lv0013->lv006;?>&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxphep=program"+"&year=<?php echo $motc_lv0013->lv007;?>&month=<?php echo $motc_lv0013->lv006;?>&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp.onreadystatechange=stateChangedProgram;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
		function stateChangedProgram()
		{
			if (xmlhttp.readyState==4)
			{
				var startdomain=xmlhttp.responseText.indexOf('[CHECK]')+7;
				var enddomain=xmlhttp.responseText.indexOf('[ENDCHECK]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				if(domainid=='')
				{
					var startdomain1=xmlhttp.responseText.indexOf('[CHECKDEF]')+10;
					var enddomain1=xmlhttp.responseText.indexOf('[ENDCHECKDEF]');
					var domainid1=xmlhttp.responseText.substr(startdomain1,enddomain1-startdomain1);
					document.getElementById('txtPhenNamSuDung').innerHTML=domainid1;
				}
				else
				{
					alert(domainid);
				}
				
			}
		}
		function GetXmlHttpObject()
		{
			if (window.XMLHttpRequest)
			{
			  // code for IE7+, Firefox, Chrome, Opera, Safari
				return new XMLHttpRequest();
			}
			if (window.ActiveXObject)
			{
			  // code for IE6, IE5
				return new ActiveXObject("Microsoft.XMLHTTP");
			}
			return null;
		}

function RunDisableAll(cur)
{
	var o=document.getElementById("curTabView");
	o.value=cur;
	for(var js=0;js<=5;js++)
	{
		var o1=document.getElementById("cl_"+js+"_1");
		var h1=document.getElementById("cl_"+js+"_2");
		var o3=document.getElementById("hrtab_"+js);
		var if1=document.getElementById("cl_"+js+"_3");
		if(cur==js)
		{
			if(o1!=null) 
			{
				o1.style.display="block";
				if(if1!=null) if1.src=h1.value;
			}
			if(o3!=null) o3.className="curshow";
			
		}
		else
		{
			if(o1!=null) o1.style.display="none";
			if(o3!=null) o3.className="cssTab";
		}
	}	
}
function jobshow(cur)
{
	for(var js=0;js<=5;js++)
	{
		var o1=document.getElementById("job_"+js);
		
		if(cur==js)
		{
			if(o1!=null) o1.style.display="block";
			
		}
		else
		{
			if(o1!=null) o1.style.display="none";
			
		}
	}	
}

//-->
</script>
<?php
if($mojo_lv0004->GetView()==1)
{
?>
<?php
	$vCodeList="'KL','1/2KL'";
	$motc_lv0008->lv100=$motc_lv0008->lv200;
	$vSoPhepKLDaDung=$vKL;//$motc_lv0008->get_count_codeidyear($motc_lv0008->LV_UserID,$year,$vCodeList);
?>
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
					  	<input id="curTabView" name="curTabView" type="hidden" value="<?php echo $_POST['curTabView'];?>"/>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mojo_lv0004->lv001;?>"/>
						<input type="hidden" name="txtPhenNamSuDung" id="txtPhenNamSuDung"  value="<?php echo $vPhepNamCon;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mojo_lv0004->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mojo_lv0004->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mojo_lv0004->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mojo_lv0004->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mojo_lv0004->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mojo_lv0004->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mojo_lv0004->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mojo_lv0004->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mojo_lv0004->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mojo_lv0004->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mojo_lv0004->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mojo_lv0004->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mojo_lv0004->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mojo_lv0004->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $mojo_lv0004->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $mojo_lv0004->lv016;?>"/>
                        <input type="hidden" name="txtlv017" id="txtlv017" value="<?php echo $mojo_lv0004->lv017;?>"/>
						<input type="hidden" name="txtlv018" id="txtlv018" value="<?php echo $mojo_lv0004->lv018;?>"/>
						<input type="hidden" name="txtlv019" id="txtlv019" value="<?php echo $mojo_lv0004->lv019;?>"/>
						<input type="hidden" name="txtlv020" id="txtlv020" value="<?php echo $mojo_lv0004->lv020;?>"/>
						<input type="hidden" name="txtlv021" id="txtlv021" value="<?php echo $mojo_lv0004->lv021;?>"/>
						<input type="hidden" name="txtlv022" id="txtlv022" value="<?php echo $mojo_lv0004->lv022;?>"/>
						<input type="hidden" name="txtlv023" id="txtlv023" value="<?php echo $mojo_lv0004->lv023;?>"/>
						<input type="hidden" name="txtlv024" id="txtlv024" value="<?php echo $mojo_lv0004->lv024;?>"/>
						<input type="hidden" name="txtlv025" id="txtlv025" value="<?php echo $mojo_lv0004->lv025;?>"/>		
						<input type="hidden" name="PhepNamCon" id="PhepNamCon" value="<?php echo $vPhepNamCon;?>"/>		
						
						<table border="0" width="100%">
							<tbody>
								<tr>
									<td align="left" id="TabViewHr">
										<ul class="IdTabViewHr">
											<?php
											if(($mojo_lv0004->LV_UserID!='MP001' && $mojo_lv0004->LV_UserID!='MP002') || $_SESSION['ERPSOFV2RUserID']=='admin')
											{
											?> 
											<li><div id="hrtab_0" class="curshow" onclick="RunDisableAll(0)">Xin nghỉ phép và công tác</div></li>
											<li><div id="hrtab_2" class="curshow" onclick="RunDisableAll(2)">Xin đi trễ về sớm và thai sản</div></li>
											<li><div id="hrtab_3" class="curshow" onclick="RunDisableAll(3)">Tăng ca </div></li>
											<?php
											}
											?>
											<li><div id="hrtab_1" class="cssTab" onclick="RunDisableAll(1)">Xem đơn xin phép toàn công ty</div></li>
											<?php
											if(($mojo_lv0004->LV_UserID!='MP001' && $mojo_lv0004->LV_UserID!='MP002') || $_SESSION['ERPSOFV2RUserID']=='admin')
											{
											?> 
											<li><div id="hrtab_4" class="curshow"  onclick="RunDisableAll(4)"><?php echo "PN (".$month."/".$year."):".$motc_lv0009->FormatView($vPhepNamCon,10);?> ngày</div></li>
											<li><div id="hrtab_5" class="curshow" onclick="RunDisableAll(5)"><?php echo "KL (".$year."):".$motc_lv0009->FormatView(7-$motc_lv0008->lv201-$vSoPhepKLDaDung,10);?> ngày</div></li>
											<?php
											}?>
									</td>
								</tr>
							</tbody>
						</table>
						<div id="cl_0_1">
							<?php 
							echo $mojo_lv0004->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);
							?>
						</div>
						<div id="cl_2_1">
							<input type="hidden" name="cl_2_2" id="cl_2_2" value="home.php?lang=VN&opt=27&item=&link=am9fbHYwMDA0L2pvX2x2MDAwNC0xMC5waHA="/>
							<iframe name="cl_2_3" id="cl_2_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
						</div>
						<div id="cl_3_1">
							<input type="hidden" name="cl_3_2" id="cl_3_2" value="home.php?lang=VN&opt=27&item=&link=am9fbHYwMDA0L2pvX2x2MDAwNC0yMC5waHA="/>
							<iframe name="cl_3_3" id="cl_3_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
						</div>
						<div id="cl_1_1" style="display:none">
							<input type="hidden" name="cl_1_2" id="cl_1_2" value="home.php?lang=VN&opt=27&item=&link=am9fbHYwMDA0L2pvX2x2MDAwNC0zMC5waHA="/>
							<iframe  name="cl_1_3" id="cl_1_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
						</div>
						<div id="cl_4_1" style="display:none">
							<input type="hidden" name="cl_4_2" id="cl_4_2" value="home.php?lang=VN&opt=27&item=&link=am9fbHYwMDA0L2pvX2x2MDAwNF8wXzEucGhw"/>
							<iframe name="cl_4_3" id="cl_4_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
						
							<?php
							/*
								$vCodeList="'P','1/2P'";
								$vSoPhepDaDung=$motc_lv0008->get_count_codeidyear($motc_lv0008->LV_UserID,$year,$vCodeList);
							?>
							<table width="400">
								<tr>
									<td>Tổng phép năm: <?php echo $motc_lv0008->FormatView($motc_lv0008->lv100,10);?> ngày</td>
								</tr>
								<tr>
									<td>Phép năm còn lại năm trước: <?php echo $motc_lv0008->FormatView($motc_lv0008->lv008,10);?> ngày</td>
								</tr>
								<tr>
									<td>Đã sử dụng: <?php echo $motc_lv0008->FormatView($motc_lv0008->lv101+$vSoPhepDaDung,10);?> ngày</td>
									</tr>
								<tr>
									<td>Còn lại: <?php echo $motc_lv0008->FormatView($motc_lv0008->lv100+$motc_lv0008->lv008-$motc_lv0008->lv101-$vSoPhepDaDung,10);?> ngày</td>
								</tr>
							</table>	
							<?php
							if($plang=="") $plang="VN";
							$vLangArr=GetLangFile("../","AD0025.txt",$plang);
							
							$morp_lv0006->ArrPush[0]='BÁO CÁO PHÉP NĂM';
						$morp_lv0006->ArrPush[1]=$vLangArr[18];
						$morp_lv0006->ArrPush[2]=$vLangArr[19];
						$morp_lv0006->ArrPush[3]=$vLangArr[20];
						$morp_lv0006->ArrPush[4]=$vLangArr[21];
						$morp_lv0006->ArrPush[5]=$vLangArr[22];
						$morp_lv0006->ArrPush[6]=$vLangArr[23];
						$morp_lv0006->ArrPush[7]=$vLangArr[24];
						$morp_lv0006->ArrPush[8]=$vLangArr[25];
						$morp_lv0006->ArrPush[9]=$vLangArr[26];
						$morp_lv0006->ArrPush[10]=$vLangArr[27];
						$morp_lv0006->ArrPush[11]=$vLangArr[28];
						$morp_lv0006->ArrPush[12]=$vLangArr[29];
						$morp_lv0006->ArrPush[13]=$vLangArr[30];
						$morp_lv0006->ArrPush[14]=$vLangArr[31];
						$morp_lv0006->ArrPush[15]=$vLangArr[32];
						$morp_lv0006->ArrPush[16]=$vLangArr[33];
						$morp_lv0006->ArrPush[17]=$vLangArr[34];
						$morp_lv0006->ArrPush[18]=$vLangArr[35];
						$morp_lv0006->ArrPush[19]=$vLangArr[36];
						$morp_lv0006->ArrPush[20]=$vLangArr[37];
						$morp_lv0006->ArrPush[21]=$vLangArr[38];
						$morp_lv0006->ArrPush[22]=$vLangArr[39];
						$morp_lv0006->ArrPush[23]=$vLangArr[40];
						$morp_lv0006->ArrPush[24]=$vLangArr[41];
						$morp_lv0006->ArrPush[25]=$vLangArr[42];
						$morp_lv0006->ArrPush[26]=$vLangArr[43];
						$morp_lv0006->ArrPush[27]=$vLangArr[44];
						$morp_lv0006->ArrPush[28]=$vLangArr[45];
						$morp_lv0006->ArrPush[29]=$vLangArr[46];
						$morp_lv0006->ArrPush[30]=$vLangArr[47];
						$morp_lv0006->ArrPush[31]=$vLangArr[48];
						$morp_lv0006->ArrPush[32]=$vLangArr[49];
						$morp_lv0006->ArrPush[33]=$vLangArr[50];
						$morp_lv0006->ArrPush[34]=$vLangArr[51];
						$morp_lv0006->ArrPush[35]=$vLangArr[52];
						$morp_lv0006->ArrPush[36]=$vLangArr[53];
						$morp_lv0006->ArrPush[37]=$vLangArr[54];
						$morp_lv0006->ArrPush[38]=$vLangArr[55];
						$morp_lv0006->ArrPush[39]=$vLangArr[56];
						$morp_lv0006->ArrPush[40]=$vLangArr[57];
						$morp_lv0006->ArrPush[41]=$vLangArr[58];
						$morp_lv0006->ArrPush[42]=$vLangArr[59];
						$morp_lv0006->ArrPush[43]=$vLangArr[60];
						$morp_lv0006->ArrPush[44]=$vLangArr[61];
						$morp_lv0006->ArrPush[45]=$vLangArr[62];
						$morp_lv0006->ArrPush[202]='T1';
						$morp_lv0006->ArrPush[203]='T2';
						$morp_lv0006->ArrPush[204]='T3';
						$morp_lv0006->ArrPush[205]='T4';
						$morp_lv0006->ArrPush[206]='T5';
						$morp_lv0006->ArrPush[207]='T6';
						$morp_lv0006->ArrPush[208]='T7';
						$morp_lv0006->ArrPush[209]='T8';
						$morp_lv0006->ArrPush[210]='T9';
						$morp_lv0006->ArrPush[211]='T10';
						$morp_lv0006->ArrPush[212]='T11';
						$morp_lv0006->ArrPush[213]='T12';
						$morp_lv0006->ArrPush[214]='Ký tên';
						$morp_lv0006->ArrPush[104]='Phép còn lại '.($year-1);
						$morp_lv0006->ArrPush[101]='Phép hưởng '.$year;
						$morp_lv0006->ArrPush[46]='';
						$morp_lv0006->ArrPush[47]='Số phép đã dùng';
						$morp_lv0006->ArrPush[48]='Số phép còn lại';
						$morp_lv0006->TCCodeID="'P','1/2P'";
						$morp_lv0006->lv001=$morp_lv0006->LV_UserID;
						$vdatefrom=$year.'-01-01';
						$vdateto= $year.'-12-31';
						$morp_lv0006->ReportYear=$year;
						
						
						$vOrderList='1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23';
						$vFieldList="lv001,lv030,lv029,lv002,lv100,lv103,lv201,lv202,lv203,lv204,lv205,lv206,lv207,lv208,lv209,lv210,lv211,lv212,lv101,lv102,lv213";
						$txtlv221=1;
						echo $morp_lv0006->LV_FN_Main($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$txtlv221);
						*/
							?>	
						</div>
						<div id="cl_5_1" style="display:none">
							<input type="hidden" name="cl_5_2" id="cl_5_2" value="home.php?lang=VN&opt=27&item=&link=am9fbHYwMDA0L2pvX2x2MDAwNF8wXzIucGhw"/>
							<iframe name="cl_5_3" id="cl_5_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
						
						
						<?php
						/*
						?>	
							<table width="400">
								<tr>
									<td>Tổng phép KL: <?php echo 7;?> ngày</td>
								</tr>
								<tr>
									<td>Đã sử dụng: <?php echo $motc_lv0008->FormatView($motc_lv0008->lv201+$vSoPhepKLDaDung,10);?> ngày</td>
								</tr>
								<tr>
									<td>Còn lại: <?php echo $motc_lv0008->FormatView(7-$motc_lv0008->lv201-$vSoPhepKLDaDung,10);?> ngày</td>
								</tr>
							</table>
							<?php
								$morp_lv0006->TCCodeID="'KL','1/2KL'";
								$morp_lv0006->ArrPush[0]='BÁO CÁO PHÉP KL';
								$txtlv221=2;
								echo $morp_lv0006->LV_FN_Main($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$txtlv221);
						*/	
								?>	

						</div>
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
</div></div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
setTimeout("RunDisableAll(<?php echo (int)$_POST['curTabView'];?>)",100);
setTimeout("setFocusNow()",1000);
function setFocusNow()
{
document.frmchoose.qxtlv001.focus();
}
</script>