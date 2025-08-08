<?php


session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/ts_lv0004.php");
require_once("$vDir../clsall/sl_lv0001.php");
require_once("$vDir../clsall/ts_lv0005.php");
require_once("$vDir../clsall/sl_lv0070.php");
require_once("$vDir../clsall/ts_lv0010.php");
require_once("$vDir../clsall/ts_lv0011.php");
require_once("$vDir../clsall/sl_lv0059.php");
require_once("$vDir../clsall/mn_lv0005.php");
require_once("$vDir../clsall/sl_lv0007.php");
require_once("$vDir../clsall/sl_lv0058.php");
require_once("$vDir../clsall/ts_lv0034.php");
////////init object////////////////////
	$lvts_lv0004=new ts_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0004');
	$lvts_lv0005=new ts_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0005');	
	$lvsl_lv0070=new sl_lv0070($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0070');
	$lvsl_lv0059=new sl_lv0059($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0059');
	$lvsl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
	$lvsl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0007');
	$lvmn_lv0005=new mn_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0005');
	$lvts_lv0034=new ts_lv0034($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0034');
	$lvsl_lv0070->LV_Load();
	$lvts_lv0004->obj_conf=$lvsl_lv0070;
	$lvts_lv0004->mots_lv0005=$lvts_lv0005;
$vNow=GetServerDate();	
if($lvts_lv0004->GetAdd()>0)
{
if(isset($_GET['ajaxchangeorder']))
{
	$vContractID=$_GET['ContractID'];
	$vContractIDOld=$_GET['ContractIDOld'];
	if($vContractID!=$vContractIDOld)
	{
		if($vContractIDOld=="" || $vContractIDOld==NULL)
		{
			$vContractID=$lvts_lv0004->LV_ExistEmp(getInfor($_SESSION['ERPSOFV2RUserID'],2));
			if($vContractID=="" || $vContractID==NULL)
			{
				if($lvts_lv0004->GetApr()==0) $lvts_lv0004->lv003=getInfor($_SESSION['ERPSOFV2RUserID'],2);
				if($lvts_lv0004->lv003=="") $lvts_lv0004->lv003=getInfor($_SESSION['ERPSOFV2RUserID'],2);
				$lvts_lv0004->lv023=getInfor($_SESSION['ERPSOFV2RUserID'],2);
				$lvts_lv0004->lv005=$lvts_lv0004->FormatView($vNow,2)." ".GetServerTime();
				$lvts_lv0004->lv001=$vContractID;
				//if($lvsl_lv0059->lv009>0) $lvts_lv0004->lv022=$lvsl_lv0059->lv009;
				$vresult=$lvts_lv0004->LV_Insert();
				if($vresult==false)
				{
				}
			}
			echo "[NEWCONTRACTID]";
				echo $vContractID;
			echo "[ENDNEWCONTRACTID]";
		}
		else
		{
			$vsql="update ts_lv0004 set lv001='$vContractID' where lv001='$vContractIDOld' and lv011=0 and lv010='".getInfor($_SESSION['ERPSOFV2RUserID'],2)."'";
			$vresult=db_query($vsql);
			echo "[NEWCONTRACTID]";
				echo $vContractID;
			echo "[ENDNEWCONTRACTID]";
		}
	}
	else
	{
		echo "[NEWCONTRACTID]";
				echo '';
			echo "[ENDNEWCONTRACTID]";
	}
	exit();
}
if(isset($_GET['ajaxitemsend']))
{
	echo $vItemID=$_GET['ItemID'];
	$vprogid=$_GET['progid'];
	$vWHID=$_GET['WHID'];
	$lvsl_lv0007->LV_LoadID($vItemID);
	if($lvsl_lv0007->lv001==NULL)
	{
		$lvmn_lv0005->LV_LoadID($vItemID);
		if($lvmn_lv0005->lv001==NULL)
			$vItemID='';
		else
		$vItemID=$lvmn_lv0005->lv002;
	}
	$vContractID=$_GET['ContractID'];
	if($vContractID=="" || $vContractID==NULL)
	{
		$vContractID=$lvts_lv0004->LV_ExistEmp(getInfor($_SESSION['ERPSOFV2RUserID'],2));
	}
	if($vContractID=="" || $vContractID==NULL)
	{
		$vContractID=InsertWithCheck('ts_lv0004', 'lv001', 'KK-'.getmonth($vNow)."/".getyear($vNow)."-",4);
		if($lvts_lv0004->GetApr()==0) $lvts_lv0004->lv003=getInfor($_SESSION['ERPSOFV2RUserID'],2);
		if($lvts_lv0004->lv003=="") $lvts_lv0004->lv003=getInfor($_SESSION['ERPSOFV2RUserID'],2);
		$lvts_lv0004->lv005=$lvts_lv0004->FormatView($vNow,2)." ".GetServerTime();
		$lvts_lv0004->lv001=$vContractID;
		$lvts_lv0004->lv002=$vWHID;
		//if($lvsl_lv0059->lv009>0) $lvts_lv0004->lv022=$lvsl_lv0059->lv009;
		$vresult=$lvts_lv0004->LV_InsertAuto();
		if($vresult==false)
		{
			$vContractID=InsertWithCheck('ts_lv0004', 'lv001', 'KK-'.getmonth($vNow)."/".getyear($vNow)."-",4);
			$lvts_lv0004->lv001=$vContractID;
			$vresult=$lvts_lv0004->LV_InsertAuto();
			if($vresult==false) $vContractID="";
		}
	}
	echo "[CONTRACTID]";
		echo $vContractID;
	echo "[ENDCONTRACTID]";
	if($vContractID!="" && $vContractID!=NULL)
	{
		$lvts_lv0004->LV_LoadID($vContractID);
		$vUpdate=$_GET['update'];
		$vDetailID=$lvts_lv0005->LV_CheckExitItem($vContractID,$vItemID);
		$vlv003=$lvts_lv0004->lv002;
		$vDateStart=$lvts_lv0004->lv005;
		$vDateEnd=$lvts_lv0004->lv005;
		if(($vDetailID!='' && $vDetailID!=NULL && $vUpdate==1))
			$vsql="update ts_lv0005 set lv008=lv008+1 where lv001='$vDetailID'";
		else
			$vsql="insert into ts_lv0005 (lv002,lv003,lv004,lv005,lv006,lv007,lv009,lv011,lv008) select '$vContractID',MP.lv001,if(ISNULL(ReReceiptQty),0,ReReceiptQty)-if(ISNULL(ReOutlv004),0,ReOutlv004)+if(ISNULL(InReceiptQty),0,InReceiptQty)-if(ISNULL(InOutlv004),0,InOutlv004) sl1,MP.lv004,if(ISNULL(ReReceiptQty),0,ReReceiptQty)-if(ISNULL(ReOutlv004),0,ReOutlv004)+if(ISNULL(InReceiptQty),0,InReceiptQty)-if(ISNULL(InOutlv004),0,InOutlv004) sl2,MP.lv004,MP.lv004,MP.lv008,1 from (select B.*,(select sum(A1.lv004) from ts_lv0009 A1 where A1.lv003=B.lv001 and A1.lv002 IN (select A11.lv001 from ts_lv0008 A11 Where A11.lv009<'$vDateStart 00:00:00' and A11.lv002='$vlv003')) ReReceiptQty,(select sum(A1.lv004) from ts_lv0009 A1 where A1.lv003=B.lv001 and A1.lv002 IN (select A11.lv001 from ts_lv0008 A11 Where A11.lv009>='$vDateStart 00:00:00' and A11.lv009<='$vDateEnd 23:59:59' and A11.lv002='$vlv003')) InReceiptQty,(select sum(A2.lv004) from ts_lv0011 A2 where A2.lv003=B.lv001 and A2.lv002 IN (select A21.lv001 from ts_lv0010 A21 Where A21.lv009<'$vDateStart 00:00:00' and A21.lv002='$vlv003')) ReOutlv004 ,(select sum(A2.lv004) from ts_lv0011 A2 where A2.lv003=B.lv001 and A2.lv002 IN (select A21.lv001 from ts_lv0010 A21 Where A21.lv009>='$vDateStart 00:00:00' and A21.lv009<='$vDateEnd 23:59:59' and A21.lv002='$vlv003')) InOutlv004  from  sl_lv0007 B where B.lv001='$vItemID'  and B.lv015=0 ) MP";
		$vresult=db_query($vsql);
		if($vresult)
		{
			echo '[HOPDONGMONEY]';
			if($plang=="") $plang="VN";
			$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
			echo $lvts_lv0004->LV_GetDetail($vContractID,$vWHID,$vLangArr,$vSum);
			echo '[ENDHOPDONGMONEY]';
			echo '[HOPDONGSUM]';
			echo $lvts_lv0004->FormatView($vSum,10);
			echo '[ENDHOPDONGSUM]';
			echo '[HOPDONGUNG]';
			echo 0;
			echo '[ENDHOPDONGUNG]';
			
		}
	}
	exit;
	
}
if(isset($_GET['ajaxbangtext']))
{
	$vdonhangid=$_GET['donhangid'];
	$vText=$_GET['textup'];
	$voption=$_GET['optrun'];	
	if($vdonhangid!='' && $vdonhangid!=NULL)
	{
		switch($voption)
		{			
			case 9:
				$vsql="update ts_lv0004 set lv006='$vText' where lv001='$vdonhangid' and lv007=0";
				break;
			case 5:
				echo $vsql="update ts_lv0004 set lv005='".recoverdate($vText,$plang)."' where lv001='$vdonhangid' and lv007=0";
				break;
			case 94:
				$vsql="update ts_lv0004 set lv002='$vText' where lv001='$vdonhangid' and lv007=0";
			break;
		}		
		$vresult=db_query($vsql);
	}
	exit;
}
if(isset($_GET['ajaxbangtextqty']))
{	
	$vdonhangid=$_GET['donhangid'];
	$vText=$_GET['textup'];
	$voption=$_GET['optrun'];	
	if($vdonhangid!='' && $vdonhangid!=NULL)
	{
		switch($voption)
		{			
			case 99:
				$vsql="update ts_lv0004 set lv099='$vText' where lv001='$vdonhangid' and lv011=0";
			break;
		}		
		$vresult=db_query($vsql);
	}
	$lvts_lv0004->LV_LoadID($vdonhangid);
	$vsum=$lvts_lv0004->LV_GetContractMoney($vdonhangid,0);
		echo '[CHECKDONHANG]';	
		echo $_GET['WHID'];
		//echo $vdata[1];
		echo '[ENDCHECKDONHANG]';
		echo '[DONHANGMONEY]';
			echo $lvts_lv0004->FormatView($vsum,10);
		echo '[ENDDONHANGMONEY]';
		echo '[DONHANGMONEYCL]';
			echo $vsum;
		echo '[ENDDONHANGMONEYCL]';
		echo '[HOPDONGTONG]';
			echo $lvts_lv0004->FormatView($lvts_lv0004->lv099-$vsum,10);
	echo '[ENDHOPDONGTONG]';
		echo '[CHOPDONGTONG]';
			if($lvts_lv0004->lv099-$vsum<0)			echo -($lvts_lv0004->lv099-$vsum);
			else
			echo 0;
	echo '[ENDCHOPDONGTONG]';
	exit;
}
if(isset($_GET['ajaxbangvat']))
{
	$vdonhangid=$_GET['donhangid'];
	$vTax=$_GET['taxonline'];
	if($vdonhangid!='' && $vdonhangid!=NULL)
	{
		$vsql="update ts_lv0004 set lv006=$vTax where lv001='$vdonhangid' and lv011<=1";
		$vresult=db_query($vsql);
	}
}
if(isset($_GET['ajaxcustomertext']))
{
	$vcusid=$_GET['cusid'];
	$lvsl_lv0001->LV_LoadID($vcusid);
	if($lvsl_lv0001->lv001=="" || $lvsl_lv0001->lv001==NULL)
	{
		$lvsl_lv0001->lv001=$vcusid;
		$lvsl_lv0001->lv002=$vcusid;
		
		$lvsl_lv0001->lv024=GetServerDate()." ".GetServerTime();
		$lvsl_lv0001->lv025=getInfor($_SESSION['ERPSOFV2RUserID'],2);
		$lvsl_lv0001->LV_Insert();
	}
	$vText=$_GET['textup'];
	$voption=$_GET['optrun'];
	if($vcusid!='' && $vcusid!=NULL)
	{
		switch($voption)
		{
			case 2:
				$vsql="update sl_lv0001 set lv002='$vText',lv003='".GetLastName($vText)."' where lv001='$vcusid'";
			break;
			case 6:
				$vsql="update sl_lv0001 set lv006='$vText' where lv001='$vcusid'";
			break;
			case 16:
				echo $vsql="update sl_lv0001 set lv010='$vText' where lv001='$vcusid'";
			break;
			case 23:
				$vsql="update sl_lv0001 set lv023='$vText' where lv001='$vcusid'";
			break;
		}
		
		$vresult=db_query($vsql);
	}
	exit;
}
if(isset($_GET['ajaxquantitysend']))
{
	//if($lvts_lv0004->GetEdit()>0)
	{
		$optqty=(int)$_GET['optqty'];
		if($optqty==2)
		{
			$vsql="update ts_lv0005 set lv010='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from ts_lv0004 A where A.lv001=ts_lv0005.lv002)<=0";
			$vresult=db_query($vsql);	
		}
		else
		{
			$lvts_lv0005->LV_UpdateQty($_GET['chitietid'],$_GET['qty']);
		//	$vsql="update ts_lv0005 set lv004='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from ts_lv0004 A where A.lv001=ts_lv0005.lv002)<=0";
		}
		
		
		}
	exit;
}
if(isset($_GET['ajaxquantitycalcsend']))
{
	$vQty=$lvts_lv0005->LV_UpdateCalc($_GET['chitietid']);	
	exit;
}
}	
	
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
	$vLangArr1=GetLangFile("$vDir../","TS0005.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($lvts_lv0004->GetAdd()>0)
{
if(isset($_GET['ajax']))
{
	$vcusid=$_GET['cusid'];
	$lvsl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
	$lvsl_lv0001->LV_LoadID($vcusid);
	echo '[CHECK]';
	echo $lvsl_lv0001->lv002;
	echo '[ENDCHECK]';
	echo '[TCHECK]';
	echo $lvsl_lv0001->lv006;
	echo '[ENDTCHECK]';
	echo '[SCHECK]';
	echo $lvsl_lv0001->lv010;
	echo '[ENDSCHECK]';
	echo '[DOANHCHECK]';
	echo $lvsl_lv0001->LV_ListPopupYear($lvsl_lv0001->lv001,getyear($vNow));
	echo '[ENDDOANHCHECK]';
	echo '[DATRATRUOC]';
	echo $lvsl_lv0001->SaveTotal;
	echo '[ENDDATRATRUOC]';
	echo '[PROGCHECK]';
	
		echo $vID=$lvsl_lv0059->LV_GetProgCus($lvsl_lv0001->lv022);
	
	echo '[ENDPROGCHECK]';
	exit;
}
if(isset($_GET['ajaxaproval']))
{
		$vContractID=$_GET['donhangid'];
		$vresult=$lvts_lv0004->LV_Aproval("'".$vContractID."'");
		echo '[DONHANGNHAN]';
		echo $_GET['donhangid'];
		echo '[ENDDONHANGNHAN]';
		echo '[EMPTYCONTRACT]';
		echo $lvts_lv0004->LV_GetDetail('','',$vLangArr,$vSum);
		echo '[ENDEMPTYCONTRACT]';
		exit;
}
if(isset($_GET['ajaxWHID']))
{
	$vWHID=$_GET['WHID'];
	$vsql="select * from ts_lv0004 BB where BB.lv007='$vWHID'  and BB.lv011=0 limit 0,1";
	$vresult=db_query($vsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
					echo '[CHECKBANGOK]';
						echo 1;
					echo '[ENDCHECKBANGOK]';
					echo '[CHECKWHID]';
						echo $vrow['lv002'];
					echo '[ENDCHECKWHID]';
					echo '[CHECK1WHID]';
						echo $vrow['lv003'];
					echo '[ENDCHECK1WHID]';
					echo '[CHECK2WHID]';
						echo $vrow['lv009'];
					echo '[ENDCHECK2WHID]';
					echo '[CHECK3WHID]';
						echo $vrow['lv014'];
					echo '[ENDCHECK3WHID]';
					echo '[CHECK4WHID]';
						echo $vrow['lv013'];
					echo '[ENDCHECK4WHID]';
			}
}
if(isset($_GET['ajaxquantity']))
{
	//if($lvts_lv0004->GetEdit()>0)
	{
	echo '[CHECKDONHANG]';
		$optqty=(int)$_GET['optqty'];
		if($optqty==2)
			$vsql="update ts_lv0005 set lv010='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv007 from ts_lv0004 A where A.lv001=ts_lv0005.lv002)<=0";
		else
			$vsql="update ts_lv0005 set lv008='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv007 from ts_lv0004 A where A.lv001=ts_lv0005.lv002)<=0";
		$vresult=db_query($vsql);	
		
		//$vdata=$lvts_lv0004->LV_GetBH_Invoice($_GET['chitietid']);
		if($_GET['optdel']==1) $lvts_lv0005->LV_Delete($_GET['chitietid']);
		echo $_GET['WHID'];
		//echo $vdata[1];
		echo '[ENDCHECKDONHANG]';
		echo '[DONHANGMONEY]';
			echo $lvts_lv0004->FormatView($vdata[2],10);
		echo '[ENDDONHANGMONEY]';
		echo '[DONHANGMONEYCL]';
			echo $lvts_lv0004->FormatView($vdata[3]-$vdata[2],10);
		echo '[ENDDONHANGMONEYCL]';
		echo '[HOPDONGUNG]';
			echo 0;
	echo '[ENDHOPDONGUNG]';
		}
	exit;
}
if(isset($_GET['ajaxprice']))
{
	//if($lvts_lv0004->GetEdit()>0)
	{
	$voptprice=$_GET['optprice'];
	echo '[CHECKDONHANG]';
		switch($voptprice)
		{
			case 1:
				$vsql="update ts_lv0005 set lv008='".$_GET['price']."' where lv001='".$_GET['chitietid']."' and (select A.lv007 from ts_lv0004 A where A.lv001=ts_lv0005.lv002)<=0";
				break;
			case 3:
				$vsql="update ts_lv0005 set lv010='".$_GET['price']."' where lv001='".$_GET['chitietid']."' and (select A.lv007 from ts_lv0004 A where A.lv001=ts_lv0005.lv002)<=0";
				break;
		}
		$vresult=db_query($vsql);	
		
		//$vdata=$lvts_lv0004->LV_GetBH_Invoice($_GET['chitietid']);
		//if($_GET['qty']<=0) $lvts_lv0005->LV_Delete($_GET['chitietid']);
		echo $_GET['WHID'];
		//echo $vdata[1];
		echo '[ENDCHECKDONHANG]';
		echo '[DONHANGMONEY]';
			echo $lvts_lv0004->FormatView($vdata[2],10);
		echo '[ENDDONHANGMONEY]';
		echo '[DONHANGMONEYCL]';
			echo $lvts_lv0004->FormatView($vdata[3]-$vdata[2],10);
		echo '[ENDDONHANGMONEYCL]';
		}
	exit;
}
if(isset($_GET['ajaxpro']))
{
		$Arr=Array();
		$Arr[0]=$_GET['programid'];
		$Arr[1]=$_GET['itemid'];
		if($_GET['programid']=='' || $_GET['itemid']=='')
		{
			echo '[CHECKDEF]';
			echo '(0sp -> 0đ)<input type="hidden" name="txtlvnumber" type="text" id="txtlvnumber" value="0"/><input type="hidden" name="txtlvscore" type="text" id="txtlvscore" value="0"/><input type="hidden" name="txtlv916" id="txtlv916" value=""/>';
			
			echo '[ENDCHECKDEF]';
			echo '[CHECKDIS]';
			echo 0;
			echo '[ENDCHECKDIS]';
		}
		else
		{
			$vsql="select A.lv001,A.lv002,B.lv004 discount,B.lv005 num,B.lv006 score from  sl_lv0059 A inner join sl_lv0060 B on A.lv001=B.lv002 where B.lv003='".$_GET['itemid']."' and A.lv001='".$_GET['programid']."' and A.lv008=1";
			$vresult=db_query($vsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
					echo '[CHECKDEF]';
					echo '('.$lvts_lv0005->FormatView($vrow['num'],10).'sp -> '.$lvts_lv0005->FormatView($vrow['score'],10).'đ)<input type="hidden" name="txtlvnumber" type="text" id="txtlvnumber" value="'.$vrow['num'].'"/><input type="hidden" name="txtlvscore" type="text" id="txtlvscore" value="'.$vrow['score'].'"/>';
					$vstrchild=$lvts_lv0005->LV_LinkField('lv016',$Arr);
					if($vstrchild=="")	
						echo '<input type="hidden" name="txtlv916" id="txtlv916" value=""/>';
					else
					{
					}
						echo '<select name="txtlv916" id="txtlv916"   tabindex="25"  style="width:150px" onkeypress="return CheckKey(event,1)" />'.$vstrchild.'<option value="">...none...</option></select>	';
					echo '[ENDCHECKDEF]';
					echo '[CHECKDIS]';
					echo $lvts_lv0005->FormatView($vrow['discount'],10);
					echo '[ENDCHECKDIS]';
			}
			else
			{
					echo '[CHECKDEF]';
					echo '(0sp -> 0đ)<input type="hidden" name="txtlvnumber" type="text" id="txtlvnumber" value="0"/><input type="hidden" name="txtlvscore" type="text" id="txtlvscore" value="0"/><input type="hidden" name="txtlv916" id="txtlv916" value=""/>';
					echo '[ENDCHECKDEF]';
					echo '[CHECKDIS]';
					echo 0;
					echo '[ENDCHECKDIS]';
			}
		}
}
//$lvts_lv0004->LV_CheckSQL();
$flagCtrl = (int)$_POST['txtFlag'];
//Lấy mã phiếu nhập kho
$lvts_lv0004->lv001=$lvts_lv0004->LV_ExistEmp(getInfor($_SESSION['ERPSOFV2RUserID'],2));
if($lvts_lv0004->lv001!="" && $lvts_lv0004->lv001!=NULL)
{	
	$lvts_lv0004->LV_LoadID($lvts_lv0004->lv001);
	$lvsl_lv0001->LV_LoadID($lvts_lv0004->lv002);
}
if($lvts_lv0004->lv001!="" && $lvts_lv0004->lv001!=NULL) $lvts_lv0004->LV_LoadID($lvts_lv0004->lv001);
if($_POST['txtdoiWHID']==1)  $lvts_lv0004->lv001=$_POST['txtlv801'];
$isExists =0;//$lvts_lv0004->LV_Exist($lvts_lv0004->lv001);	
}
else if($flagCtrl == 10){
$lvts_lv0004->lv002=$_POST['txtlv802'];
$lvts_lv0004->lv003=$_POST['txtlv803'];
$lvts_lv0004->lv006=$_POST['txtlv806'];
$lvts_lv0004->lv007=$_POST['txtlv807'];	
$lvts_lv0004->lv008=$_POST['txtlv808'];
$lvts_lv0004->lv006=$_POST['txtlv809'];
$lvts_lv0004->lv011=$_POST['txtlv811'];
$lvts_lv0004->lv012=$_POST['txtlv812'];
$lvts_lv0004->lv013=$_POST['txtlv813'];
$lvts_lv0004->lv014=$_POST['txtlv814'];
$lvts_lv0004->lv015=$_POST['txtlv815'];
$lvts_lv0004->lv016=$_POST['txtlv816'];
$lvts_lv0004->lv017=$_POST['txtlv817'];
$lvts_lv0004->lv018=$_POST['txtlv818'];
$lvts_lv0004->lv019=$_POST['txtlv819'];
$lvts_lv0004->lv022=$_POST['txtlv822'];

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$lvts_lv0004->ArrPush[0]=$vLangArr1[17];
$lvts_lv0004->ArrPush[1]=$vLangArr1[18];
$lvts_lv0004->ArrPush[2]=$vLangArr1[19];
$lvts_lv0004->ArrPush[3]=$vLangArr1[20];
$lvts_lv0004->ArrPush[4]=$vLangArr1[21];
$lvts_lv0004->ArrPush[5]=$vLangArr1[22];
$lvts_lv0004->ArrPush[6]=$vLangArr1[23];
$lvts_lv0004->ArrPush[7]=$vLangArr1[24];
$lvts_lv0004->ArrPush[8]=$vLangArr1[25];
$lvts_lv0004->ArrPush[9]=$vLangArr1[26];
$lvts_lv0004->ArrPush[10]=$vLangArr1[27];
$lvts_lv0004->ArrPush[11]=$vLangArr1[28];
$lvts_lv0004->ArrPush[12]=$vLangArr1[29];
$lvts_lv0004->ArrPush[13]=$vLangArr1[41];
$lvts_lv0004->ArrPush[14]=$vLangArr1[40];
$lvts_lv0004->ArrPush[15]=$vLangArr1[42];
$lvts_lv0004->ArrPush[16]=$vLangArr1[45];
$lvts_lv0004->ArrPush[17]=$vLangArr1[43];
$lvts_lv0004->ArrPush[18]=$vLangArr1[44];
$lvts_lv0004->ArrPush[19]=$vLangArr1[46];
$lvts_lv0004->ArrPush[20]=$vLangArr1[47];
$lvts_lv0004->ArrPush[21]=$vLangArr1[48];
$lvts_lv0004->ArrPush[22]=$vLangArr1[49];
$lvts_lv0004->ArrPush[23]=$vLangArr1[50];
$lvts_lv0004->ArrPush[24]=$vLangArr1[51];
$lvts_lv0004->ArrPush[25]=$vLangArr1[52];
$lvts_lv0004->ArrPush[26]=$vLangArr1[53];
$vFieldList="lv001,lv002,lv003,lv010,lv023";
if((int)$isExists>=1){
//	$lvts_lv0004->Load($lvts_lv0004->ID);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<style>
	.tblcaption
{
	color:#000099;
	font-weight:bold;
	background-color:#CFDDE9;
}
.bt_setdefaultmini
{
	width:<?php echo ($lvsl_lv0070->lv009==0)?100:$lvsl_lv0070->lv009-10;?>px !important;
}
.viewlift
{
	width:<?php echo ($lvsl_lv0070->lv009==0)?90:($lvsl_lv0070->lv009);?>px !important;
}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
<script language="javascript" src="<?php echo $vDir;?>../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/engines.js"></script>
	<title><?php echo $vLangArr[17];?></title>
	<script>

	<!--
	function runsubmit1()
	{
		document.frmadd.submit();
	}
	function runsubmit()
	{
			window.setTimeout('runsubmit1()',10000);
	}
	function DoiBang(to)
	{
		var o=document.frmadd;
		o.txtlv807.value=to.value;
		var vo=document.getElementById('txtdoiWHID');
		if(vo.value=="1")
		{
			if(confirm("Bạn có muốn đổi bàn không?"))
			{
				o.txtFlag.value="1";
				o.submit();
			}
				
		}		
	}
	function SetDefData(vTime,vRoomid)
	{
		var o=document.frmadd;
		o.txtlv807.value=vRoomid;
		o.txttyperent.value=vTime;
		{
			o.txtFlag.value="10";
			o.submit();
		}
	}
	/*=============================================================================*/
	function Back() {
		
		opener.document.frmadd.submit();
		window.close();
	}
	/*=======================================================================================*/
	function isNumber(s){
		if(s!=""){
			var str=".,0123456789";
			for(var j=0;j<s.length;j++)
				if(str.indexOf(s.charAt(j))==-1)
					return false;
			return true;
		}	
		return true;
	}
	function RunFunction()
	{
		var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>sl_lv0032/sl_lv0032.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
		div = document.getElementById('lvloaddata');
		div.innerHTML=str;
	}
	function AddProd(value)
	{
		var o1=document.getElementById("txtContractID");
		var o2=document.getElementById("txtlv994");

		AddItemNew(o1.value,o2.value,"1."+value);
		
	}
	function Add()
	{
		var o=document.frmadd;
		var o1=document.getElementById("txtContractID");
		var o2=document.getElementById("txtlv994");
		AddItemNew(o1.value,o2.value,"1."+o.txtlv903.value);
		o.txtlv903.value='';
		//o.txtlv903.focus();
	}
	function LoadType(to)
	{

		var o=document.frmadd;
		var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'BANHANG':
				LoadPopupParent(to,'txtlv806','ts_lv0004','lv003');
				break;
			case 'TRAHANG':
				LoadPopupParent(to,'txtlv806','ts_lv0004','lv003');
				break;
			case 'MUAHANG':
				LoadPopupParent(to,'txtlv806','ts_lv0021','lv003');
				break;
		}
	}
	function LoadItem()
	{
		var o=document.frmadd;
		ajax_do ('sl_lv0101/sl_lv0101exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv903.value,1);
		
	}
	function LoadSource()
	{
		var o=document.frmadd;
		var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'BANHANG':
				break;
			case 'TRAHANG':
				break;
			case 'MUAHANG':
				ajax_do ('sl_lv0101/sl_lv0101excesource.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value,1);
				window.setTimeout('RunFunction()',500);
				break;
		}		
	}
	function LoadHD(vobj,vreturn)
	{
		var vcondi="&contractid="+document.frmadd.txtlv801.value+"&startdate="+document.frmadd.txtlv804.value+"&enddate="+document.frmadd.txtlv805.value+"&parentid="+document.frmadd.txtlv817.value;
		LoadTextParentCond(vobj,vreturn,'sl_lv0016','lv003',document.frmadd.txtlv802.value,1,'<?php echo $plang;?>',vcondi);
	}
	function CalculateM()
	{
		var o=document.frmadd;
		o.txtlv911amount.value=parseFloat(o.txtlv904.value*o.txtlv906.value*o.txtlv911.value/100);
		o.txtlv908amount.value=parseFloat(o.txtlv904.value*o.txtlv906.value*o.txtlv908.value/100);
		o.txtlvallamount.value=-parseFloat(o.txtlv911amount.value)+parseFloat(o.txtlv908amount.value)+parseFloat(o.txtlv904.value*o.txtlv906.value);
		if(parseFloat(o.txtlvnumber.value)!=0) o.txtlv912.value=parseFloat(o.txtlv904.value)*parseFloat(o.txtlvscore.value)/parseFloat(o.txtlvnumber.value);
	}
	function viewmore()
	{
		var o=document.getElementById('morelistid');
		if(o.style.display=="block")
			o.style.display="none";
		else
			o.style.display="block";
	}
	function Report(vValue)
	{
		if(vValue=="")		var vValue=document.getElementById("txtContractID").value;
		//var vstr="ReportMoreEmpty('"+vValue+"')";
		//window.setTimeout(vstr,500);
		var vPT=document.getElementById("txtPTID").value;
		document.getElementById("txtPTID").value='';
		var vstr="ReportMore('"+vPT+"')";
		window.setTimeout(vstr,500);
		var o1=document.getElementById("txtContractID");
		if(vValue=="") vValue=o1.value;
		var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>ts_lv0004?func=<?php echo $_GET['func'];?>&childfunc=rptretail&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();		
	}
	function ReportMore(vValue)
	{
		if(vValue=="") 
		{
			return;
		}
		var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>sl_lv0058?func=&childdetailfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
	}
	function ReportMoreEmpty(vValue)
	{
		if(vValue=="")		var vValue=document.getElementById("txtContractID").value;
		if(vValue=="") 
		{
			return;
		}
		var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>ts_lv0004?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
	}
	function notSpecialChar(evt)
	{
		var e = evt; // for trans-browser compatibility
		var charCode = e.which || e.keyCode;
		if(charCode>=48 && charCode<=57)
		{
			return true;
		}
		if(charCode==75 || charCode==72  || charCode==8 || charCode==46 || charCode==9 || charCode==39 || charCode==13 || charCode==37) return true;  
		return false;

	}
	-->
	</script>
</head>
<?php
if($lvts_lv0004->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<form   name="frmadd" id="frmadd"  id="frmadd" method="POST" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" autocomplete="off">
<div id="bán hàngtab_1" class="libán hàngcur" onclick="setviewhere(1);curtab(1);" style="display:none"></div>
<style>


</style>
<div style="height:20px"></div>
<div class="hd_cafe">
	<div style="clear:both;padding:5px;font:bold 18px Arial,Tahoma;">
		<div style="float:left;width:250px"><?php echo $vLangArr1[19];?>
		<input type="textbox" name="txtContractID" id="txtContractID" style="width:120px;text-align:center;height:20px;color:blue" value="<?php echo $lvts_lv0004->lv001;?>" onblur="ChangeOrderID(this.value)"><input type="hidden" name="txtContractIDOld" id="txtContractIDOld" style="width:80px;text-align:center;height:20px;color:blue" value="<?php echo $lvts_lv0004->lv001;?>">
		</div><div style="float:left;width:200px"><?php echo $vLangArr1[20];?>
		<select name="txtlv994" id="txtlv994" onblur="UpdateContract(this,94)"   tabindex="50"  style="width:70px" onkeypress="return CheckKey(event,1)" />
						<?php echo $lvts_lv0004->LV_LinkField('lv002',$lvts_lv0004->lv002);?>
					</select>
		</div>
		<div style="float:left">
			<input style="width:90px;text-align:center;height:20px;color:blue" onblur="if(this.value == '') {this.value = this.title;} else {UpdateContract(this,5);}" onfocus="ProcessDateMore(); if(this.value == this.title) {this.value = '';}  " value="<?php echo ($lvts_lv0004->lv005!="" && $lvts_lv0004->lv005!=NULL)?$lvts_lv0004->FormatView($lvts_lv0004->lv005,2):$lvts_lv0004->FormatView($vNow,2);?>" title="Ngày kiểm" class="textview" name="txtcontractend" id="txtcontractend" type="text" tabindex="50" ondblclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtcontractend);return false;"/>
		</div>
		<div style="float:left">
			<input style="width:150px;text-align:center;height:20px;color:blue" onblur="if(this.value == '') {this.value = this.title;} else {UpdateContract(this,9);}" onfocus="if(this.value == this.title) this.value = '';" value="<?php echo ($lvts_lv0004->lv006!="" && $lvts_lv0004->lv006!=NULL)?$lvts_lv0004->lv006:$vLangArr1[24];?>" title="<?php echo $vLangArr1[24];?>" class="textview" name="txtcontractnote" id="txtcontractnote" type="text" tabindex="50" />
			<div style="display:none" id="tongtien"></div>
		</div>&nbsp;&nbsp;&nbsp;
		<div style="float:right;"><span style="color:black" title="<?php echo GetServerTimeSec();?>" id="countdown"></span>
		</div>
		<div style="float:right">
		<table>
										<tr>
											
											<td>
										<ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" xml:lang="pop-nav1">
											<li class="menupopT">
											<input type="text" autocomplete="off" class="search_img_btn" name="txtlv903_search" id="txtlv903_search" style="width:100px" onKeyUp="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,@! @!,lv001)')" onFocus="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,@! @!,lv001)')" tabindex="200">
											<div id="lv_popup" lang="lv_popup1" xml:lang="lv_popup1"> </div>
											</li>
										</ul>
											</td>
											<td>
												<input tabindex="19" title="barcode hoặc mã sản phẩm" name="txtlv903" id="txtlv903" tabindex="19"  style="width:100px;height:22px;text-align:center;" onkeypress="return CheckKeys(event,1,this)" value="<?php echo $lvts_lv0005->lv003;?>" onFocus="if(document.frmadd.txtlv913.value=='') document.frmadd.txtlv913.value=document.frmadd.txtlv805.value" onblur="//LoadItem();//changecategory_change(this.value)"/>
											</td>
										</tr>
									</table>
      </div>									

		
</div>
<!---------------Ban hang---------------------->
<div id="viewhere_1" style="display:block;">
	<div>
		
											<input type="hidden" name="txtStrID" id="txtStrID" value="">
											<input type="hidden" name="txtFlag" id="txtFlag" value="0">
											<input type="hidden" name="txtlv807" id="txtlv807" value="">
											<input type="hidden" name="txtPTID" id="txtPTID" value="">
											
											<input type="hidden" name="txtgopWHID" id="txtgopWHID" value="0">
											<input type="hidden" name="txtdoiWHID" id="txtdoiWHID" value="0">
											<input type="hidden" name="txtlv994" id="txtlv994" value="0">
											<input type="hidden" name="txtlv801" id="txtlv801" value=""/>
											<input type="hidden" name="txttyperent" id="txttyperent" value=""/>
											<input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
											<input type="hidden" name="curtabview" id="curtabview" value="<?php echo $_POST['curtabview'];?>"/>
											<input type="hidden" name="curtang" id="curtang" value="<?php echo $_POST['curtang'];?>"/>
			
<!-------------------SP------------------------->
				<div class="khungsp">

						<div  id="monan">
				
						<div style="clear:both;width:100%;overflow:hidden;" >
						<div id="detailview" style="float:right;background:#fff;height:400px; overflow: auto;width:39%">
							<div style="padding:5px">
							<?php 
							$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
							echo $lvts_lv0004->LV_GetDetail($lvts_lv0004->lv001,$vWHID,$vLangArr,$vSum);
							?>
							</div>
						</div>
					
						<div style="float:right;width:40%;overflow: auto;height:400px;padding:0px!important" class="thanhprocess" >
						<div style="padding:5px">
						<?php 
							$strthanh="";
							$i=0;
							$vsql="select * from sl_lv0006 where  lv004=0 and (ISNULL(lv003) or lv003='' or lv001=lv003) order by lv005 asc";
							$vresultparent=db_query($vsql);
							while($vrowparent=db_fetch_array($vresultparent))
							{
								$i++;
								$strthanh=$strthanh.'<div id="thanhthus_'.$i.'" onclick="viewthanhthu('.$i.')" class="thanhcon '.(($i==1)?'conactive':'').'" style="text-transform:none!important">'.$vrowparent['lv001'].'</div>';
								echo '	<div id="thanhthu_'.$i.'" style="clear:both;'.(($i==1)?'display:block':'display:none').'">';						
								$vsql="select distinct * from sl_lv0006 where (lv003='".$vrowparent['lv001']."') or ( lv001='".$vrowparent['lv001']."' and (ISNULL(lv003) or lv003='')) and lv004=0 order by lv005 asc";
								$vresult=db_query($vsql);
								while($vrow=db_fetch_array($vresult))
								{
						?>
									<div style="float:left;width:97%">
										<div class="groupcafe" style="padding:5px 0px 5px 0px!important;width:auto!important"><?php echo $vrow['lv002'];?></div>
										<div>
											<ul class="ulfix" style="padding:0px;margin:0px;">
											<?php
											$vsql1="select * from sl_lv0007 where lv003='".$vrow['lv001']."' order by lv010,lv002 asc";
											$vresult1=db_query($vsql1);
											$vWidth=$lvsl_lv0070->lv006;
											while($vrow1=db_fetch_array($vresult1))
											{
											?>
												<li style="float:left"><div style="position:relative;" onclick="AddProd('<?php echo $vrow1['lv001'];?>')" class="buttonClass">
												<?php
												if($lvsl_lv0070->lv010==1 && $vrow1['lv014']!="")
												{
												?>
												<img style="width:<?php echo $vWidth;?>px;position:absolute;top:0px;left:0px" src="<?php echo $vrow1['lv014'];?>"/>
												<?php
												}?>
												<span style="text-transform:none!important"  style="margin-left:<?php echo $vWidth;?>px;"><?php echo $vrow1['lv001'];?></span></div></li>
											<?php
											}
											?>
											</ul>
										</div>
									</div>
						<?php
								}?>
						</div>
						<?php
							}
							?>
							</div>
								</div>
						<?php
							echo '<div class="thanhnhom" style="float:left;width:20%;overflow: auto;height:400px"><div style="padding:5px"><input type="hidden" id="txttongthanh" value="'.$i.'"/>'.$strthanh.'</div></div>';
							?>
							
						</div>
						
					</div>	
					</div>
					
					<div>
					<div style="position:absolute;left:0px;bottom:0px;height:25px">
							<div class="vitribang" style="width:1000px">
							<div class="banhangmini" onclick="tratien('',2);"  style="float:left;"><a tabindex="99" href="javascript:" style="color:inherit" title="Chưa thu tiền và chưa xuất kho"><?php echo ($plang=='VN')?'Xong':'Finish';?></a></div>
								<div class="banhangmini" onclick="ReportMoreEmpty('<?php echo $lvts_lv0004->lv001;?>')"  style="float:left;"><?php echo ($plang=='VN')?'Báo cáo':'Report';?></div>
							<div  style="float:left;"><input style="padding:0px;margin:0px;height:10px;" type="checkbox" value=1  CHECKED="true" id="txtupdate"/></div>
						</div>					
<!---------------End SP------------------------>
<!--////////////////////////////////////Code add here///////////////////////////////////////////-->			</td>
			<div style="display:none;position:absolute;left:240px;bottom:0px;z-index:999999999999;" id="roomid"><select name="txtlv807tmp" id="txtlv807tmp"   tabindex="2"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)" onchange="DoiBang(this)"/>
															<?php echo $lvts_lv0004->LV_LinkField('lv007',$lvts_lv0004->lv007);?>
										</select></div>

			</div>
	</div>
	
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</div>
<!---------------Đơn hàng---------------------->
<!---------------Kiem tra tang---------------------->
<div id="viewhere_2" style="display:block;clear:both;">

<?php
//echo $lvts_lv0004->LV_getTangMini($vLangArr);
?>
</div>
										</form>
										<form method="post" enctype="multipart/form-data" name="frmprocess" > 
						<input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess1" > 
						<input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
<!---------------Tâng---------------------->

</body>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/menupopup.js"></script>
<script language="javascript">
window.setTimeout('RunFunction()',100);
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[61];?>';	
changecategory_change(document.frmadd.txtlv903.value);
function callsizeobj(t)
{
	var romid=document.getElementById('roomid');
	if(romid.innerHTML=='') return;
	var temp=document.getElementById('roomid_'+t);
	
	var tempchild=document.getElementById('roomidchild_'+t);
	tempchild.innerHTML=romid.innerHTML;
	temp.style.display='block';
	romid.innerHTML='';
}
function closepoprome(t)
{
	var romid=document.getElementById('roomid');
	
	var temp=document.getElementById('roomid_'+t);
	temp.style.display='none';
	var tempchild=document.getElementById('roomidchild_'+t);
	romid.innerHTML=tempchild.innerHTML;
	tempchild.innerHTML='';
	
}
function viewthanhthu(stt)
{
	sum=parseInt(document.getElementById('txttongthanh').value);
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('thanhthu_'+j);
		var vo=document.getElementById('thanhthus_'+j);
		if(stt==j) 
			{
				o.style.display="block";
				if(vo.className.indexOf('conactive')<=0) vo.className=vo.className+' conactive';
				
			}
		else 
			{
				o.style.display="none";
				if(vo.className.indexOf('conactive')>0) vo.className=vo.className.replace("conactive","");;
			}
			
		
	}
}
function ActiveGop(vthis,vDonHang,vTang)
{
	if(vDonHang=='') return;
	var o=document.getElementById('txtContractID');
	var o11=document.getElementById('txtContractIDOld');
	o.value=vDonHang;
	o11.value=vDonHang;
	var o1=document.getElementById('txtgopWHID');
	if(o1.value=="0")
		{
			o1.value="1";
			ActiveTable(0);
			vthis.value="<?php echo $vLangArr[83];?>";
		}
	else
		{
			o1.value="0";
			ActiveTable(1);
			vthis.value="<?php echo $vLangArr[81];?>";
			document.frmadd.submit();
		}
}
function ChangeOrderID(vDonHang)
{
	var o=document.getElementById('txtContractIDOld');
	vDonHangOld=o.value;
	$xmlhttp75=null;
	if(vDonHang=="") 
	{	
	return false;
	}
	xmlhttp75=GetXmlHttpObject();
	if (xmlhttp75==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
	var url=document.location;
	url=url+"?&ajaxchangeorder=ajaxcheck"+"&ContractID="+vDonHang+"&ContractIDOld="+vDonHangOld;
	url=url.replace("#","");
	xmlhttp75.onreadystatechange=stateChangeOrder;
	xmlhttp75.open("GET",url,true);
	xmlhttp75.send(null);
}
function stateChangeOrder()
{
		if (xmlhttp75.readyState==4)
		{
			var startdomain=xmlhttp75.responseText.indexOf('[NEWCONTRACTID]')+15;
			var enddomain=xmlhttp75.responseText.indexOf('[ENDNEWCONTRACTID]');
			var domainid=xmlhttp75.responseText.substr(startdomain,enddomain-startdomain);
			var o=document.getElementById('txtContractIDOld');
			if(domainid!='') o.value=domainid;
		}
}
function setDonHang(vDonHang)
{
	var o=document.getElementById('txtContractID');
	o.value=vDonHang;
}
function curtab(i)
{
	sum=5;
	var  vo=document.getElementById('curtabview');
	vo.value=i;
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('bán hàngtab_'+j);
		if(i==j)
		{
			o.className="libán hàngcur";
		}
		else
			o.className="libán hàng";
	}
}
function ActiveTable(vopt)
{
	sum=parseInt(document.getElementById('sumbangall').value);
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('gopbang_'+j);
		if(vopt==1)
		{
			var vo=document.getElementById('gopbangcheck_'+j);
			var vbang=document.getElementById('bang_'+j);			
			if(vo.checked || vbang.className.indexOf('active')>0)
				o.style.display="block";
			else
			o.style.display="none";
		}
		else
		{
			o.style.display="block";
		}
	}	
}	
function AddItemNew(hdid,WHID,vo)
{
		
		var vUpdate=0;
		if(document.getElementById('txtupdate').checked) vUpdate=1;
		$xmlhttp93=null;
			if(WHID=="") 
			{
			alert("Xin vui lòng chọn kho để kiểm.");
			document.getElementById("txtlv994").focus();
			return false;
			}
			xmlhttp93=GetXmlHttpObject();
			if (xmlhttp93==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			var ArItem=Array();
			ArItem=vo.split(".",2);
			url=url+"?&ajaxitemsend=ajaxcheck"+"&ContractID="+hdid+"&WHID="+WHID+"&ItemID="+ArItem[1]+"&update="+vUpdate;
			url=url.replace("#","");
			xmlhttp93.onreadystatechange=stateAddItemNew;
			xmlhttp93.open("GET",url,true);
			xmlhttp93.send(null);
}
function stateAddItemNew()
{
	if (xmlhttp93.readyState==4)
		{
			
			var startdomain=xmlhttp93.responseText.indexOf('[CONTRACTID]')+12;
			var enddomain=xmlhttp93.responseText.indexOf('[ENDCONTRACTID]');
			var domainid=xmlhttp93.responseText.substr(startdomain,enddomain-startdomain);
			var o=document.getElementById('txtContractID');
			o.value=domainid;
			var o11=document.getElementById('txtContractIDOld');
			o11.value=domainid;
			var startdomain1=xmlhttp93.responseText.indexOf('[HOPDONGMONEY]')+14;
			var enddomain1=xmlhttp93.responseText.indexOf('[ENDHOPDONGMONEY]');
			var domainid1=xmlhttp93.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('detailview');
			o.innerHTML=domainid1;
			var o=document.getElementById('tongtien');
			var startdomain3=xmlhttp93.responseText.indexOf('[HOPDONGSUM]')+12;
			var enddomain3=xmlhttp93.responseText.indexOf('[ENDHOPDONGSUM]');
			var domainid3=xmlhttp93.responseText.substr(startdomain3,enddomain3-startdomain3);
			o.innerHTML=domainid3;			
		}
}
function changeqtynoupdate(o,chitietid)
		{
			return;
			if(parseInt(o.value)==0)
				o.parentNode.parentNode.className=o.parentNode.parentNode.className+'  textunderline';
			else
				o.parentNode.parentNode.className=o.parentNode.parentNode.className.replace('textunderline','');
			$xmlhttp13=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp13=GetXmlHttpObject();
			if (xmlhttp13==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxquantitysend=ajaxcheck"+"&qty="+o.value+"&chitietid="+chitietid+"&optqty=1";
			url=url.replace("#","");
			xmlhttp13.onreadystatechange=statechitietdhnoup;
			xmlhttp13.open("GET",url,true);
			xmlhttp13.send(null);
		}
function changecalcqtynoupdate(o,chitietid)
		{
			return;
			if(parseInt(o.value)==0)
				o.parentNode.parentNode.className=o.parentNode.parentNode.className+'  textunderline';
			else
				o.parentNode.parentNode.className=o.parentNode.parentNode.className.replace('textunderline','');
			$xmlhttp13=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp13=GetXmlHttpObject();
			if (xmlhttp13==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxquantitycalcsend=ajaxcheck"+"&qty="+o.value+"&chitietid="+chitietid+"&optqty=1";
			url=url.replace("#","");
			xmlhttp13.onreadystatechange=statechitietdhnoup;
			xmlhttp13.open("GET",url,true);
			xmlhttp13.send(null);
		}		
function statechitietdhnoup()
{
	if (xmlhttp13.readyState==4)
		{
		
	}
}		
function changeqty(o,chitietid)
		{
			if(parseInt(o.value)==0)
				o.parentNode.parentNode.className=o.parentNode.parentNode.className+'  textunderline';
			else
				o.parentNode.parentNode.className=o.parentNode.parentNode.className.replace('textunderline','');
			$xmlhttp3=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp3=GetXmlHttpObject();
			if (xmlhttp3==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxquantity=ajaxcheck"+"&qty="+o.value+"&chitietid="+chitietid+"&optqty=1";
			url=url.replace("#","");
			xmlhttp3.onreadystatechange=statechitietdh;
			xmlhttp3.open("GET",url,true);
			xmlhttp3.send(null);
		}
function delline(o,chitietid)
		{
			o.parentNode.parentNode.innerHTML='';
			$xmlhttp3=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp3=GetXmlHttpObject();
			if (xmlhttp3==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxquantity=ajaxcheck"+"&qty="+0+"&chitietid="+chitietid+"&optqty=1"+'&optdel=1';
			url=url.replace("#","");
			xmlhttp3.onreadystatechange=statechitietdh;
			xmlhttp3.open("GET",url,true);
			xmlhttp3.send(null);
		}
function statechitietdh()
{
		if (xmlhttp3.readyState==4)
		{
			var startdomain=xmlhttp3.responseText.indexOf('[CHECKDONHANG]')+14;
			var enddomain=xmlhttp3.responseText.indexOf('[ENDCHECKDONHANG]');
			var domainid=xmlhttp3.responseText.substr(startdomain,enddomain-startdomain);
			var startdomain1=xmlhttp3.responseText.indexOf('[DONHANGMONEY]')+14;
			var enddomain1=xmlhttp3.responseText.indexOf('[ENDDONHANGMONEY]');
			var domainid1=xmlhttp3.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongtienct');
			o.innerHTML=domainid1;
			var o=document.getElementById('tongtien');
			o.innerHTML=domainid1;
			var startdomain4=xmlhttp3.responseText.indexOf('[HOPDONGUNG]')+12;
			var enddomain4=xmlhttp3.responseText.indexOf('[ENDHOPDONGUNG]');
			var domainid4=xmlhttp3.responseText.substr(startdomain4,enddomain4-startdomain4);
			var o=document.getElementById('tongtienconlai_'+domainid);
			o.innerHTML='<strong>'+domainid4+'</strong>';
			
			var startdomain1=xmlhttp3.responseText.indexOf('[DONHANGMONEYCL]')+16;
			var enddomain1=xmlhttp3.responseText.indexOf('[ENDDONHANGMONEYCL]');
			var domainid1=xmlhttp3.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongtientt_'+domainid);
			o.innerHTML=domainid1;
			var o=document.getElementById('tongtienconlai1_'+domainid2);
			o.innerHTML='<strong>'+domainid4+'</strong>';
			
			
		}
}	
function UpdateCustomer(o,option)
{
		$xmlhttp35=null;
			donhangid=document.getElementById('txtContractID').value;
			if(cusid=="")
			{
				alert("Xin vui lòng số điện thoại");return false;
			}
			xmlhttp35=GetXmlHttpObject();
			if (xmlhttp35==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxcustomertext=ajaxcheck"+"&donhangid="+donhangid+"&cusid="+cusid+"&textup="+o.value+"&optrun="+option;
			url=url.replace("#","");
			xmlhttp35.onreadystatechange=stateactivecustomertext;
			xmlhttp35.open("GET",url,true);
			xmlhttp35.send(null);	
}
function stateactivecustomertext()
{
	if (xmlhttp35.readyState==4)
		{
			
		}
}
function UpdateTextQty(o,donhangid,option)
{
		if(donhangid=='') donhangid = document.getElementById('txtContractID').value;
		if(donhangid=='') 
		{
			//alert('Đơn hàng chưa có!Xin vui lòng chọn sản phẩm bán để có đơn hàng!');
		}
		$xmlhttp655=null;
			xmlhttp655=GetXmlHttpObject();
			if (xmlhttp655==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxbangtextqty=ajaxcheck"+"&donhangid="+donhangid+"&textup="+o.value+"&optrun="+option;
			url=url.replace("#","");
			xmlhttp655.onreadystatechange=stateactivebangtextqty;
			xmlhttp655.open("GET",url,true);
			xmlhttp655.send(null);	
}
function stateactivebangtextqty()
{
	if (xmlhttp655.readyState==4)
		{
			var startdomain=xmlhttp655.responseText.indexOf('[CHECKDONHANG]')+14;
			var enddomain=xmlhttp655.responseText.indexOf('[ENDCHECKDONHANG]');
			var domainid=xmlhttp655.responseText.substr(startdomain,enddomain-startdomain);
			var startdomain1=xmlhttp655.responseText.indexOf('[DONHANGMONEY]')+14;
			var enddomain1=xmlhttp655.responseText.indexOf('[ENDDONHANGMONEY]');
			var domainid1=xmlhttp655.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongtien');
			o.innerHTML=domainid1;

			var startdomain4=xmlhttp655.responseText.indexOf('[HOPDONGTONG]')+13;
			var enddomain4=xmlhttp655.responseText.indexOf('[ENDHOPDONGTONG]');
			var domainid4=xmlhttp655.responseText.substr(startdomain4,enddomain4-startdomain4);
			var o=document.getElementById('tongtienconlai');
			o.innerHTML='<strong>'+domainid4+'</strong>';
			
		}
}
function UpdateContract(o,option)
{
		$xmlhttp555=null;
			xmlhttp555=GetXmlHttpObject();
			if (xmlhttp555==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var donhangid = document.getElementById('txtContractID').value;
			var url=document.location;
			url=url+"?&ajaxbangtext=ajaxcheck"+"&donhangid="+donhangid+"&textup="+o.value+"&optrun="+option;
			url=url.replace("#","");
			xmlhttp555.onreadystatechange=stateactivebangtext;
			xmlhttp555.open("GET",url,true);
			xmlhttp555.send(null);	
}
function stateactivebangtext()
{
}
function CheckVAT(o,donhangid)
{	
	taxonline=0;
	if(donhangid=='') donhangid = document.getElementById('txtContractID').value;
	if(o.checked) taxonline=10;	
	$xmlhttp55=null;
	xmlhttp55=GetXmlHttpObject();
	if (xmlhttp55==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
		var url=document.location;
		url=url+"?&ajaxbangvat=ajaxcheck"+"&donhangid="+donhangid+"&taxonline="+taxonline;		
		url=url.replace("#","");
		xmlhttp55.onreadystatechange=stateactivebangvat;
		xmlhttp55.open("GET",url,true);
		xmlhttp55.send(null);	
}	
function tratiendl(donhangid,opt)
{
			if(donhangid=="")
			{
				donhangid=document.getElementById('txtContractID').value;
			}
			
			$xmlhttp2=null;
			if(donhangid=="") 
			{
			alert("Mã đơn hàng trống");
			return false;
			}
			xmlhttp2=GetXmlHttpObject();
			if (xmlhttp2==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxaproval=ajaxcheck"+"&donhangid="+donhangid+"&cusid="+cusid+"&empid="+empid+"&trangthai="+opt+"&content="+vcontent+"&cusname="+cusname;
			url=url.replace("#","");
			xmlhttp2.onreadystatechange=statetratiendl;
			xmlhttp2.open("GET",url,true);
			xmlhttp2.send(null);
}
function statetratiendl()
{
		if (xmlhttp2.readyState==4)
		{
			var startdomain=xmlhttp2.responseText.indexOf('[DONHANGNHAN]')+13;
			var enddomain=xmlhttp2.responseText.indexOf('[ENDDONHANGNHAN]');
			var donhang=xmlhttp2.responseText.substr(startdomain,enddomain-startdomain);
			
			var startdomain=xmlhttp2.responseText.indexOf('[CHECKAPROVAL]')+14;
			var enddomain=xmlhttp2.responseText.indexOf('[ENDCHECKAPROVAL]');
			var domainid=xmlhttp2.responseText.substr(startdomain,enddomain-startdomain);
			document.getElementById('txtContractID').value="";			
			var startdomain=xmlhttp2.responseText.indexOf('[MAPHIEUTHU]')+12;
			var enddomain=xmlhttp2.responseText.indexOf('[ENDMAPHIEUTHU]');
			var maPT=xmlhttp2.responseText.substr(startdomain,enddomain-startdomain);
			document.getElementById('txtPTID').value=maPT;
			var o=document.getElementById('tongtien');			
			o.innerHTML='0';
			ReportMoreEmpty(donhang);
			var startdomain=xmlhttp2.responseText.indexOf('[EMPTYCONTRACT]')+15;
			var enddomain=xmlhttp2.responseText.indexOf('[ENDEMPTYCONTRACT]');
			var domainid=xmlhttp2.responseText.substr(startdomain,enddomain-startdomain);					
			document.getElementById('detailview').innerHTML=domainid;			
			var o=document.frmadd;		
			o.txtlv903.focus();	
		}
}	
function stateactivebangvat()
{
}
function tratien(donhangid,opt)
		{
			var vmoneytt=0;
			if(donhangid=="")
			{
				donhangid=document.getElementById('txtContractID').value;
			}
			
			$xmlhttp2=null;
			if(donhangid=="") 
			{
			alert("Mã đơn hàng trống");
			return false;
			}
			xmlhttp2=GetXmlHttpObject();
			if (xmlhttp2==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxaproval=ajaxcheck"+"&donhangid="+donhangid;
			url=url.replace("#","");
			xmlhttp2.onreadystatechange=statetratien;
			xmlhttp2.open("GET",url,true);
			xmlhttp2.send(null);
			}
function loaddataactive(WHID)
{
			$xmlhttp5=null;
			if(WHID=="") 
			{
			alert("Xin vui long nhap tên đăng nhập");
			return false;
			}
			xmlhttp5=GetXmlHttpObject();
			if (xmlhttp5==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxWHID=ajaxcheck"+"&WHID="+WHID;
			url=url.replace("#","");
			xmlhttp5.onreadystatechange=stateactivebang;
			xmlhttp5.open("GET",url,true);
			xmlhttp5.send(null);
}	
function changeprice(o,chitietid)
		{	
			if(parseInt(o.value)==0)
				o.parentNode.parentNode.className=o.parentNode.parentNode.className+'  textunderline';
			else
				o.parentNode.parentNode.className=o.parentNode.parentNode.className.replace('textunderline','');
			$xmlhttp6=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp6=GetXmlHttpObject();
			if (xmlhttp6==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxprice=ajaxcheck"+"&price="+o.value+"&chitietid="+chitietid+"&optprice=1";
			url=url.replace("#","");
			xmlhttp6.onreadystatechange=statepricedh;
			xmlhttp6.open("GET",url,true);
			xmlhttp6.send(null);
		}		
function changediscount(o,chitietid)
		{
			
			/*if(parseInt(o.value)==0)
				o.parentNode.parentNode.className=o.parentNode.parentNode.className+'  textunderline';
			else
				o.parentNode.parentNode.className=o.parentNode.parentNode.className.replace('textunderline','');
			*/
			$xmlhttp6=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp6=GetXmlHttpObject();
			if (xmlhttp6==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxprice=ajaxcheck"+"&price="+o.value+"&chitietid="+chitietid+"&optprice=3";
			url=url.replace("#","");
			xmlhttp6.onreadystatechange=statepricedh;
			xmlhttp6.open("GET",url,true);
			xmlhttp6.send(null);
		}			
function statepricedh()
{
		if (xmlhttp6.readyState==4)
		{
			var startdomain=xmlhttp6.responseText.indexOf('[CHECKDONHANG]')+14;
			var enddomain=xmlhttp6.responseText.indexOf('[ENDCHECKDONHANG]');
			var domainid=xmlhttp6.responseText.substr(startdomain,enddomain-startdomain);
			var startdomain1=xmlhttp6.responseText.indexOf('[DONHANGMONEY]')+14;
			var enddomain1=xmlhttp6.responseText.indexOf('[ENDDONHANGMONEY]');
			var domainid1=xmlhttp6.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongtien');
			o.innerHTML=domainid1;
			var o=document.getElementById('tongtienct');
			o.innerHTML=domainid1;
			var startdomain1=xmlhttp6.responseText.indexOf('[DONHANGMONEYCL]')+16;
			var enddomain1=xmlhttp6.responseText.indexOf('[ENDDONHANGMONEYCL]');
			var domainid1=xmlhttp6.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongtientt');
			o.innerHTML=domainid1;
		}
}		
function stateactivebang()
{
		if (xmlhttp5.readyState==4)
		{
			
			var startdomain=xmlhttp5.responseText.indexOf('[CHECKBANGOK]')+13;
			var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECKBANGOK]');
			var ok=xmlhttp5.responseText.substr(startdomain,enddomain-startdomain);
			if(parseInt(ok)==1)
			{
				var startdomain=xmlhttp5.responseText.indexOf('[CHECKWHID]')+13;
				var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECKWHID]');
				var donhang=xmlhttp5.responseText.substr(startdomain,enddomain-startdomain);
				var o=document.getElementById('txtlv802');
				o.value=donhang;
				var startdomain=xmlhttp5.responseText.indexOf('[CHECK1WHID]')+14;
				var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECK1WHID]');
				var donhang=xmlhttp5.responseText.substr(startdomain,enddomain-startdomain);
				var o=document.getElementById('txtlv803');
				o.value=donhang;
				var startdomain=xmlhttp5.responseText.indexOf('[CHECK3WHID]')+14;
				var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECK3WHID]');
				var donhang=xmlhttp5.responseText.substr(startdomain,enddomain-startdomain);
				var o=document.getElementById('txtlv814');
				o.value=donhang;
				var startdomain=xmlhttp5.responseText.indexOf('[CHECK2WHID]')+14;
				var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECK2WHID]');
				var donhang=xmlhttp5.responseText.substr(startdomain,enddomain-startdomain);
				var o=document.getElementById('txtlv809');
				o.value=donhang;
				var startdomain=xmlhttp5.responseText.indexOf('[CHECK4WHID]')+14;
				var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECK4WHID]');
				var donhang=xmlhttp5.responseText.substr(startdomain,enddomain-startdomain);
				var o=document.getElementById('txtlv813');
				o.value=donhang;
			}
		}
}
function statetratien()
{
		if (xmlhttp2.readyState==4)
		{
			var startdomain=xmlhttp2.responseText.indexOf('[DONHANGNHAN]')+13;
			var enddomain=xmlhttp2.responseText.indexOf('[ENDDONHANGNHAN]');
			var donhang=xmlhttp2.responseText.substr(startdomain,enddomain-startdomain);
			var startdomain=xmlhttp2.responseText.indexOf('[EMPTYCONTRACT]')+15;
			var enddomain=xmlhttp2.responseText.indexOf('[ENDEMPTYCONTRACT]');
			var domainid=xmlhttp2.responseText.substr(startdomain,enddomain-startdomain);					
			document.getElementById('detailview').innerHTML=domainid;		
			document.getElementById('txtContractID').value="";			
			document.getElementById('txtContractIDOld').value="";
			document.getElementById('txtlv994').value="";
			document.getElementById('txtcontractend').value="";
			document.getElementById('txtcontractnote').value="";
			var o=document.frmadd;		
			o.txtlv994.focus();	
		}
}		
function changecategory_change(value)
	{
		$xmlhttp=null;
		if(value=="") 
		{
		alert("Xin vui long nhap tên đăng nhập");
		return false;
		}
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		}
		var url=document.location;
		url=url+"?&ajax=ajaxcheck"+"&cusid="+value;
		url=url.replace("#","");
		xmlhttp.onreadystatechange=stateChanged;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	}
function stateChanged()
{
	if (xmlhttp.readyState==4)
	{
		var startdomain=xmlhttp.responseText.indexOf('[CHECK]')+7;
		var enddomain=xmlhttp.responseText.indexOf('[ENDCHECK]');
		var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('txtcusname').value=domainid;
		var startdomain=xmlhttp.responseText.indexOf('[TCHECK]')+8;
		var enddomain=xmlhttp.responseText.indexOf('[ENDTCHECK]');
		var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('txtcusadd').value=domainid;
		var startdomain=xmlhttp.responseText.indexOf('[SCHECK]')+8;
		var enddomain=xmlhttp.responseText.indexOf('[ENDSCHECK]');
		var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('txtcusnote').value=domainid;
		document.getElementById('txtcusname').focus();	
		var startdomain=xmlhttp.responseText.indexOf('[DOANHCHECK]')+12;
		var enddomain=xmlhttp.responseText.indexOf('[ENDDOANHCHECK]');
		var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('txtdoanhthu').innerHTML=domainid;
		var startdomain=xmlhttp.responseText.indexOf('[DATRATRUOC]')+12;
		var enddomain=xmlhttp.responseText.indexOf('[ENDDATRATRUOC]');
		var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('txtmoney').value=domainid;
		document.getElementById('tongtienconlai').innerHTML='0';		
		var startdomain=xmlhttp.responseText.indexOf('[PROGCHECK]')+11;
		var enddomain=xmlhttp.responseText.indexOf('[ENDPROGCHECK]');
		var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
	}
}
function stateChangedProgram()
{
	if (xmlhttp1.readyState==4)
	{
		var startdomain1=xmlhttp1.responseText.indexOf('[CHECKDEF]')+10;
		var enddomain1=xmlhttp1.responseText.indexOf('[ENDCHECKDEF]');
		var domainid1=xmlhttp1.responseText.substr(startdomain1,enddomain1-startdomain1);
		document.getElementById('calscore').innerHTML=domainid1;
		var startdomain2=xmlhttp1.responseText.indexOf('[CHECKDIS]')+10;
		var enddomain2=xmlhttp1.responseText.indexOf('[ENDCHECKDIS]');
		var domainid2=xmlhttp1.responseText.substr(startdomain2,enddomain2-startdomain2);
		document.getElementById('txtlv911').value=domainid2;
	}
}
function program_change(itemid,value)
{
	$xmlhttp1=null;
	xmlhttp1=GetXmlHttpObject();
	if (xmlhttp1==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
	var url=document.location;
	url=url+"?&ajaxpro=program"+"&programid="+value+"&itemid="+itemid;
	url=url.replace("#","");
	xmlhttp1.onreadystatechange=stateChangedProgram;
	xmlhttp1.open("GET",url,true);
	xmlhttp1.send(null);
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
</script>
<script language="javascript">

function setContractID(value)
{
	var o=document.getElementById('txtlv801');
	o.value=value;
	var vo=document.getElementById('txtdoiWHID');
	vo.value="1";
	
}
function viewfloorall(sum)
{
	for(j=1;j<=sum;j++)
	{
		var o=document.getElementById('bangtang_'+j);
		o.style.display="block";
		var v=document.getElementById('litangleft_'+j);
		v.className=v.className.replace('current','');
	}
	var v=document.getElementById('litangleft_0');
	if(v.className.indexOf('current')<=0) v.className=v.className+' current';
	var curtang=document.getElementById('curtang');
	curtang.value=0;
}
function viewfloor(value,sum)
{
	
	for(j=0;j<=sum;j++)
	{
		if(j>0) var o=document.getElementById('bangtang_'+j);
		var v=document.getElementById('litangleft_'+j);
		if(j==value)
			{
				if(j>0)  o.style.display="block";
				if(v.className.indexOf('current')<=0)	v.className=v.className+' current';
				
			}
		else
			{
				v.className=v.className.replace('current','');
				if(j>0)  o.style.display="none";
			}
	}
	var curtang=document.getElementById('curtang');
	curtang.value=value;
	//var v=document.getElementById('litangleft_0');
	//v.className=v.className.replace('current','');
}
/* Timer */
//setTimeout(setReload,<?php echo ($lvsl_lv0070->lv003==0)?60000:$lvsl_lv0070->lv003*1000;?>);
function setReload()
{
	var o=document.frmadd;
	o.submit();
}
setTimer();
function setTimer ()
{
		var othis=document.getElementById('countdown');
		var myTime=othis.title;
		if (parseInt(myTime)>=0)
		{
			var hour=parseInt(myTime/3600,10);
			var minute=parseInt((myTime%3600)/60,10);
			var second=(myTime%3600)%60;
			var str="";
			othis.innerHTML=(getNamDay(hour) + ":" + minute + ":" + second);
			othis.title=parseInt(myTime)+1;
		}
	setTimeout(setTimer,1000);
}
function getNamDay(hour)
{
	if(hour>24)
	{
		return parseInt(hour/24)+" ngày "+(hour%24);
	}
	return hour;
}
var o=document.frmadd;		
	o.txtlv903.focus();

/* End timer */
</script>
<?php
} else {
	include ("permit.php");
}	
?>
</html>