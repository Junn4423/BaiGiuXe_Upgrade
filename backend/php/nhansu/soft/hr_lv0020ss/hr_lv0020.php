<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/hr_lv0020.php");
require_once("../clsall/jo_lv0016.php");

/////////////init object//////////////
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
//$mojo_lv0016=new jo_lv0016($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0016');

$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","AD0025.txt",$plang);
$mohr_lv0020->lang=strtoupper($plang);
if(isset($_POST['txtlv009']))
$mohr_lv0020->lv009=$_POST['txtlv009'];
else
{
 $_POST['txtlv009']="0,1,5";
$mohr_lv0020->lv009=$_POST['txtlv009'];
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0020->ArrPush[0]=$vLangArr[17];
$mohr_lv0020->ArrPush[1]=$vLangArr[18];
$mohr_lv0020->ArrPush[2]=$vLangArr[19];
$mohr_lv0020->ArrPush[3]=$vLangArr[20];
$mohr_lv0020->ArrPush[4]=$vLangArr[21];
$mohr_lv0020->ArrPush[5]=$vLangArr[22];
$mohr_lv0020->ArrPush[6]=$vLangArr[23];
$mohr_lv0020->ArrPush[7]=$vLangArr[24];
$mohr_lv0020->ArrPush[8]=$vLangArr[25];
$mohr_lv0020->ArrPush[9]=$vLangArr[26];
$mohr_lv0020->ArrPush[10]=$vLangArr[27];
$mohr_lv0020->ArrPush[11]=$vLangArr[28];
$mohr_lv0020->ArrPush[12]=$vLangArr[29];
$mohr_lv0020->ArrPush[13]=$vLangArr[30];
$mohr_lv0020->ArrPush[14]=$vLangArr[31];
$mohr_lv0020->ArrPush[15]=$vLangArr[32];
$mohr_lv0020->ArrPush[16]=$vLangArr[33];
$mohr_lv0020->ArrPush[17]=$vLangArr[34];
$mohr_lv0020->ArrPush[18]=$vLangArr[35];
$mohr_lv0020->ArrPush[19]=$vLangArr[36];
$mohr_lv0020->ArrPush[20]=$vLangArr[37];
$mohr_lv0020->ArrPush[21]=$vLangArr[38];
$mohr_lv0020->ArrPush[22]=$vLangArr[39];
$mohr_lv0020->ArrPush[23]=$vLangArr[40];
$mohr_lv0020->ArrPush[24]=$vLangArr[41];
$mohr_lv0020->ArrPush[25]=$vLangArr[42];
$mohr_lv0020->ArrPush[26]=$vLangArr[43];
$mohr_lv0020->ArrPush[27]=$vLangArr[44];
$mohr_lv0020->ArrPush[28]=$vLangArr[45];
$mohr_lv0020->ArrPush[29]=$vLangArr[46];
$mohr_lv0020->ArrPush[30]=$vLangArr[47];
$mohr_lv0020->ArrPush[31]=$vLangArr[48];
$mohr_lv0020->ArrPush[32]=$vLangArr[49];
$mohr_lv0020->ArrPush[33]=$vLangArr[50];
$mohr_lv0020->ArrPush[34]=$vLangArr[51];
$mohr_lv0020->ArrPush[35]=$vLangArr[52];
$mohr_lv0020->ArrPush[36]=$vLangArr[53];
$mohr_lv0020->ArrPush[37]=$vLangArr[54];
$mohr_lv0020->ArrPush[38]=$vLangArr[55];
$mohr_lv0020->ArrPush[39]=$vLangArr[56];
$mohr_lv0020->ArrPush[40]=$vLangArr[57];
$mohr_lv0020->ArrPush[41]=$vLangArr[58];
$mohr_lv0020->ArrPush[42]=$vLangArr[59];
$mohr_lv0020->ArrPush[43]=$vLangArr[60];
$mohr_lv0020->ArrPush[44]=$vLangArr[61];
$mohr_lv0020->ArrPush[45]=$vLangArr[62];
$mohr_lv0020->ArrPush[46]=$vLangArr[71];
$mohr_lv0020->ArrPush[47]=$vLangArr[72];
$mohr_lv0020->ArrPush[48]=$vLangArr[73];
$mohr_lv0020->ArrPush[49]=$vLangArr[74];
$mohr_lv0020->ArrPush[50]=$vLangArr[75];
$mohr_lv0020->ArrPush[51]=$vLangArr[76];
$mohr_lv0020->ArrPush[52]=$vLangArr[78];
$mohr_lv0020->ArrPush[53]=$vLangArr[79];
$mohr_lv0020->ArrPush[61]=$vLangArr[80];
$mohr_lv0020->ArrPush[62]=$vLangArr[81];
$mohr_lv0020->ArrPush[63]=$vLangArr[82];
$mohr_lv0020->ArrPush[64]=$vLangArr[83];
$mohr_lv0020->ArrPush[65]=$vLangArr[84];
$mohr_lv0020->ArrPush[66]=$vLangArr[85];
$mohr_lv0020->ArrPush[67]=$vLangArr[86];
$mohr_lv0020->ArrPush[68]=$vLangArr[87];
$mohr_lv0020->ArrPush[69]=$vLangArr[88];
$mohr_lv0020->ArrPush[70]=$vLangArr[100];
$mohr_lv0020->ArrPush[71]=$vLangArr[90];
$mohr_lv0020->ArrPush[72]=$vLangArr[91];
$mohr_lv0020->ArrPush[73]=$vLangArr[92];
$mohr_lv0020->ArrPush[100]=$vLangArr[93];
$mohr_lv0020->ArrPush[102]=$vLangArr[101];
$mohr_lv0020->ArrPush[103]=$vLangArr[94];
$mohr_lv0020->ArrPush[104]=$vLangArr[95];
$mohr_lv0020->ArrPush[105]=$vLangArr[102];
$mohr_lv0020->ArrPush[106]=$vLangArr[103];
$mohr_lv0020->ArrPush[107]=$vLangArr[98];
$mohr_lv0020->ArrPush[151]=$vLangArr[96];
$mohr_lv0020->ArrPush[200]=$vLangArr[97];

$mohr_lv0020->ArrPush[300]='KPI';
$mohr_lv0020->ArrPush[115]='Số tài khoản/Thông tin (2)';
$mohr_lv0020->ArrPush[117]='Chi nhánh ngân hàng (2)	';

$mohr_lv0020->ArrFunc[0]='//Function';
$mohr_lv0020->ArrFunc[1]=$vLangArr[2];
$mohr_lv0020->ArrFunc[2]=$vLangArr[4];
$mohr_lv0020->ArrFunc[3]=$vLangArr[6];
$mohr_lv0020->ArrFunc[4]=$vLangArr[7];
$mohr_lv0020->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mohr_lv0020->ArrFunc[6]=GetLangExcept('Work',$plang);
$mohr_lv0020->ArrFunc[7]=GetLangExcept('Leave',$plang);
$mohr_lv0020->ArrFunc[8]=$vLangArr[10];
$mohr_lv0020->ArrFunc[9]=$vLangArr[12];
$mohr_lv0020->ArrFunc[10]=$vLangArr[0];
$mohr_lv0020->ArrFunc[11]=$vLangArr[65];
$mohr_lv0020->ArrFunc[12]=$vLangArr[66];
$mohr_lv0020->ArrFunc[13]=$vLangArr[67];
$mohr_lv0020->ArrFunc[14]=$vLangArr[68];
$mohr_lv0020->ArrFunc[15]=$vLangArr[69];

////Other
$mohr_lv0020->ArrOther[1]=$vLangArr[63];
$mohr_lv0020->ArrOther[2]=$vLangArr[64];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];
$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0020->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"hr_lv0020",$lvMessage);
}
elseif($flagID==2)
{
$mohr_lv0020->lv001=$_POST['txtlv001'];
$mohr_lv0020->lv002=$_POST['txtlv002'];
$mohr_lv0020->lv003=$_POST['txtlv003'];
$mohr_lv0020->lv004=$_POST['txtlv004'];
$mohr_lv0020->lv005=$_POST['txtlv005'];
$mohr_lv0020->lv006=$_POST['txtlv006'];
$mohr_lv0020->lv007=$_POST['txtlv007'];
$mohr_lv0020->lv008=$_POST['txtlv008'];
if(isset($_POST['txtlv009']))
$mohr_lv0020->lv009=$_POST['txtlv009'];
else
{
 $_POST['txtlv009']="0,1,5";
$mohr_lv0020->lv009=$_POST['txtlv009'];
}
$mohr_lv0020->lv010=$_POST['txtlv010'];
$mohr_lv0020->lv011=$_POST['txtlv011'];
$mohr_lv0020->lv012=$_POST['txtlv012'];
$mohr_lv0020->lv013=$_POST['txtlv013'];
$mohr_lv0020->lv014=$_POST['txtlv014'];
$mohr_lv0020->lv015=$_POST['txtlv015'];
$mohr_lv0020->lv016=$_POST['txtlv016'];
$mohr_lv0020->lv017=$_POST['txtlv017'];
$mohr_lv0020->lv018=$_POST['txtlv018'];
$mohr_lv0020->lv019=$_POST['txtlv019'];
$mohr_lv0020->lv020=$_POST['txtlv020'];
$mohr_lv0020->lv021=$_POST['txtlv021'];
$mohr_lv0020->lv022=$_POST['txtlv022'];
$mohr_lv0020->lv023=$_POST['txtlv023'];
$mohr_lv0020->lv024=$_POST['txtlv024'];
$mohr_lv0020->lv025=$_POST['txtlv025'];
$mohr_lv0020->lv026=$_POST['txtlv026'];
$mohr_lv0020->lv027=$_POST['txtlv027'];
$mohr_lv0020->lv028=$_POST['txtlv028'];
$mohr_lv0020->lv029=$_POST['txtlv029'];
$mohr_lv0020->lv030=$_POST['txtlv030'];
$mohr_lv0020->lv031=$_POST['txtlv031'];
$mohr_lv0020->lv032=$_POST['txtlv032'];
$mohr_lv0020->lv033=$_POST['txtlv033'];
$mohr_lv0020->lv034=$_POST['txtlv034'];
$mohr_lv0020->lv035=$_POST['txtlv035'];
$mohr_lv0020->lv036=$_POST['txtlv036'];
$mohr_lv0020->lv037=$_POST['txtlv037'];
$mohr_lv0020->lv038=$_POST['txtlv038'];
$mohr_lv0020->lv039=$_POST['txtlv039'];
$mohr_lv0020->lv040=$_POST['txtlv040'];
$mohr_lv0020->lv041=$_POST['txtlv041'];
$mohr_lv0020->lv042=$_POST['txtlv042'];
$mohr_lv0020->lv043=$_POST['txtlv043'];
$mohr_lv0020->lv044=$_POST['txtlv044'];
$mohr_lv0020->lv045=$_POST['txtlv045'];

$mohr_lv0020->lv060=$_POST['txtlv060'];
$mohr_lv0020->lv061=$_POST['txtlv061'];
$mohr_lv0020->lv062=$_POST['txtlv062'];
$mohr_lv0020->lv063=$_POST['txtlv063'];
$mohr_lv0020->lv064=$_POST['txtlv064'];
$mohr_lv0020->lv065=$_POST['txtlv065'];
$mohr_lv0020->lv066=$_POST['txtlv066'];
$mohr_lv0020->lv067=$_POST['txtlv067'];

$mohr_lv0020->lv099=$_POST['txtlv099'];
$mohr_lv0020->FullName=$_POST['txtFullName'];
}
elseif($flagID==3)
{
	/*$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0020->LV_Aproval($strar);*/
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0020->LV_UnAproval($strar);
}
elseif($flagID==14)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	require_once("../clsall/hr_lv0038.php");
	$lvhr_lv0038=new hr_lv0038('admin','admin','Hr0046');
	$mohr_lv0020->mohr_lv0038=$lvhr_lv0038;
	$vresult=$mohr_lv0020->LV_AutoRunHD($strar);
}
elseif($flagID==10)
{
	$mojo_lv0016=new jo_lv0016($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0016');
$mojo_lv0016->LV_Load();

	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vServer=$mojo_lv0016->lv006;
	$vUser=$mojo_lv0016->lv007;
	$vPass=$mojo_lv0016->lv008;
	$vDatabase=$mojo_lv0016->lv009;
	$vresult=$mohr_lv0020->LV_UpdateMita($strar,$vServer,$vUser,$vPass,$vDatabase);
}
elseif($flagID==11)
{
	require_once("../clsall/ml_lv0008.php");
	require_once("../clsall/ml_lv0009.php");
	require_once("../clsall/ml_lv0013.php");
	require_once("../clsall/ml_lv0100.php");
	require_once("../clsall/class.phpmailer.php");
	function SplitToEsc($vAddress,$vPara1,$vopt)
	{
		$strTemp=$vAddress;
		$vArrTemp=explode($vPara1,$strTemp);
		$strReturn="";
		if(count($vArrTemp)==0) return $vAddress;
		for($i=0;$i<count($vArrTemp);$i++)
		{
			if($vopt==1)
			{
				if (!(strpos($vArrTemp[$i],"@11111111".$Domain)===false))
				{
					if($strReturn!="")
						$strReturn=$strReturn.$vPara1.trim($vArrTemp[$i]);
					else
						$strReturn=$strReturn.trim($vArrTemp[$i]);			
				}		
			}
			else
			{
				if ((strpos($vArrTemp[$i],"@11111".$Domain)===false))
				{
					if($strReturn!="")
						$strReturn=$strReturn.$vPara1.trim($vArrTemp[$i]);
					else
						$strReturn=$strReturn.trim($vArrTemp[$i]);			
				}		
			
			}
		}
		return $strReturn;
	}
	function LV_SendMail($lvcontent,$lvtitle,$lvuser,$lvemail,$vTo)
	{
		$lvListId_del="";
		$lvml_lv0008=new ml_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0008');
		$lvml_lv0100=new ml_lv0100($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0100');		
		$lvml_lv0009=new ml_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0009');
		$lvml_lv0009->LV_LoadSMTP();
		$lvml_lv0008->LV_LoadUser($lvuser,$lvemail);
			$vstrTo=SplitTo(str_replace(";",",",str_replace(" ","",$vTo)),"<",">",",");
			$vstrToSend=SplitToEsc($vstrTo,",",0);
			$lvml_lv0100=new ml_lv0100($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0100');
			$lvml_lv0100->To(explode(",",$vstrToSend));		
			if($lvml_lv0008->lv005==1)
			{
					$lvml_lv0100->lvml_lv0009=$lvml_lv0009;
					$lvml_lv0100->lvml_lv0008=$lvml_lv0008;
					$lvml_lv0100->To(explode(",",$vstrToSend));
					$lvml_lv0100->From($lvemail);
					$lvml_lv0100->Subject($lvtitle);
					$lvml_lv0100->Priority(3);	
					$lvml_lv0100->Content_type("multipart/related");
					$lvml_lv0100->charset="utf-8";
					$lvml_lv0100->ctencoding="quoted-printable";
					$lvml_lv0100->Cc(explode(",",$vstrCCSend));
					$lvml_lv0100->Bcc(explode(",",$vstrBCCSend));
					$lvml_lv0100->Body($lvcontent,'');
					$lvml_lv0100->Content_type('text/html');
					if($lvml_lv0100->Send())
					{
						$vMessage= 'Thành công gửi! Email:'.$vTo."<br/>";
					}
					else	
						$vMessage= 'Không thành công gửi! Email:'.$vTo."<br/>";

			}
			else	
						$vMessage= 'Không thành công gửi! Email:'.$vTo."<br/>";

		return $vMessage;
	}
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$lvsql="select lv001,lv040,lv041 from  hr_lv0020 Where lv001 in ($strar)";
	$vresult=db_query($lvsql);
	while($vrow=db_fetch_array($vresult))
	{
		$vCode=$vrow['lv001'];
		$vTo='';
		if(trim($vrow['lv040'])!="" && trim($vrow['lv041'])!="")
			$vTo=$vrow['lv040'].",".$vrow['lv041'];
		else if(trim($vrow['lv040'])!="")
			$vTo=$vrow['lv040'];
		else if(trim($vrow['lv041'])!="")
			$vTo=$vrow['lv041'];
		if($vTo!='')
		{
			$mohr_lv0020->LV_AprovalChangePass($vCode);
		}						
		else
		{
			$lmessage=$lmessage."<br><font color=#FF0000>Cập nhật dữ liệu không thành công cho mã [$vCode]. Xin vui lòng liên hệ với quản trị website để khắc phục sự cố này.</font>";
			
		}
	}
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0020->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0020');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mohr_lv0020->ListView;
$curPage = $mohr_lv0020->CurPage;
$maxRows =$mohr_lv0020->MaxRows;
$vOrderList=$mohr_lv0020->ListOrder;
$vSortNum=$mohr_lv0020->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mohr_lv0020->SaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0020',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;
$mohr_lv0020->lsempid=$_POST['LSEMPID'] ?? '';
$mohr_lv0020->lv029_=$mohr_lv0020->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
$totalRowsC=$mohr_lv0020->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'] ?? '';?>
	&lv002=<?php echo $_POST['txtlv002'] ?? '';?>
	&lv003=<?php echo $_POST['txtlv003'] ?? '';?>
	&lv004=<?php echo $_POST['txtlv004'] ?? '';?>
	&lv005=<?php echo $_POST['txtlv005'] ?? '';?>
	&lv006=<?php echo $_POST['txtlv006'] ?? '';?>
	&lv007=<?php echo $_POST['txtlv007'] ?? '';?>
	&lv008=<?php echo $_POST['txtlv008'] ?? '';?>
	&lv009=<?php echo $_POST['txtlv009'] ?? '';?>
	&lv0010=<?php echo $_POST['txtlv010'] ?? '';?>
	&lv011=<?php echo $_POST['txtlv011'] ?? '';?>
	&lv012=<?php echo $_POST['txtlv012'] ?? '';?>
	&lv013=<?php echo $_POST['txtlv013'] ?? '';?>
	&lv014=<?php echo $_POST['txtlv014'] ?? '';?>
	&lv015=<?php echo $_POST['txtlv015'] ?? '';?>
	&lv015=<?php echo $_POST['txtlv016'] ?? '';?>
	&lv017=<?php echo $_POST['txtlv017'] ?? '';?>
	&lv018=<?php echo $_POST['txtlv018'] ?? '';?>
	&lv019=<?php echo $_POST['txtlv019'] ?? '';?>
	&lv020=<?php echo $_POST['txtlv020'] ?? '';?>
	&lv021=<?php echo $_POST['txtlv021'] ?? '';?>
	&lv022=<?php echo $_POST['txtlv022'] ?? '';?>
	&lv023=<?php echo $_POST['txtlv023'] ?? '';?>
	&lv024=<?php echo $_POST['txtlv024'] ?? '';?>
	&lv025=<?php echo $_POST['txtlv025'] ?? '';?>
	&lv026=<?php echo $_POST['txtlv026'] ?? '';?>
	&lv027=<?php echo $_POST['txtlv027'] ?? '';?>
	&lv028=<?php echo $_POST['txtlv028'] ?? '';?>
	&lv029=<?php echo $_POST['txtlv029'] ?? '';?>
	&lv030=<?php echo $_POST['txtlv030'] ?? '';?>
	&lv031=<?php echo $_POST['txtlv031'] ?? '';?>
	&lv033=<?php echo $_POST['txtlv033'] ?? '';?>
	&lv034=<?php echo $_POST['txtlv034'] ?? '';?>
	&lv035=<?php echo $_POST['txtlv035'] ?? '';?>
	&lv036=<?php echo $_POST['txtlv036'] ?? '';?>
	&lv037=<?php echo $_POST['txtlv037'] ?? '';?>
	&lv038=<?php echo $_POST['txtlv038'] ?? '';?>
	&lv039=<?php echo $_POST['txtlv039'] ?? '';?>
	&lv040=<?php echo $_POST['txtlv040'] ?? '';?>
	&lv041=<?php echo $_POST['txtlv041'] ?? '';?>
	&lv042=<?php echo $_POST['txtlv042'] ?? '';?>
	&lv060=<?php echo $_POST['txtlv060'] ?? '';?>
	&lv061=<?php echo $_POST['txtlv061'] ?? '';?>
	&lv062=<?php echo $_POST['txtlv062'] ?? '';?>
	&lv063=<?php echo $_POST['txtlv063'] ?? '';?>
	&lv064=<?php echo $_POST['txtlv064'] ?? '';?>
	&lv065=<?php echo $_POST['txtlv065'] ?? '';?>
	&lv066=<?php echo $_POST['txtlv066'] ?? '';?>
	&lv067=<?php echo $_POST['txtlv067'] ?? '';?>
	&lv105=<?php echo $_POST['txtlv105'] ?? '';?>
	&lv106=<?php echo $_POST['txtlv106'] ?? '';?>
	&lv299=<?php echo $_POST['txtlv299'] ?? '';?>
','filter');


}
function Del()
{
	lv_chk_list(document.frmchoose,'lvChk',3);
}
function Delete(vValue)
{
 	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=1;
	 o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();

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
			var str="<br><iframe height=1400 marginheight=0 marginwidth=0 frameborder=0 src=hr_lv0020?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
			break;
		default:
			var str = "<br><iframe height='1600' marginheight='0' marginwidth='0' frameborder='0' src='hr_lv0020?func=" + func + "&ID=" + vID + "&CandID=<?php echo $_GET['CandID'] ?? ''; ?>&<?php echo getsaveget($plang, $popt, $pitem, $plink, $pgroup, 0, 0, 0, 0); ?>' class='lvframe'></iframe>";

			
			break;
	}
	
	div = document.getElementById('lvright');
	div.innerHTML=str;
	ProcessHiden();
	//scrollToBottom();
}
function Rpt()
{
lv_chk_list(document.frmchoose,'lvChk',4);
}
function Report(vValue)
{
	<?php
$vDir = $_GET['vDir'] ?? ''; // ví dụ lấy từ URL
?>
var o=document.frmprocess;
	o.target="_blank";
o.action = "<?php echo isset($vDir) ? $vDir : ''; ?>hr_lv0020?func=rpt&ID=" + vValue + "&lang=<?php echo $plang ?? ''; ?>";

	var fun2="Report1('"+vValue+"')";
	setTimeout(fun2,100);
	o.submit();
}	
function Report1(vValue)
{
var o=document.frmprocess1;
	o.target="_blank";
	o.action="<?php echo $vDir;?>hr_lv0020?func=rpt1&ID="+vValue+"&lang=<?php echo $plang;?>";
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>"
	 o.submit();
}
function Apr()
{
	lv_chk_list(document.frmchoose,'lvChk',10);
}
function Approvals(vValue)
{
var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=3;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>"
	 o.submit();
}
function ResetPassHr()
{
	lv_chk_list(document.frmchoose,'lvChk',11);
}
function UpdateCalanderVisible()
{
	lv_chk_list(document.frmchoose,'lvChk',7);
}
function FunctRunning2(vValue)
{
	if(confirm("Bạn có đồng ý cập nhật lịch của người toàn quyền?"))
	{
	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=14;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>"
	 o.submit();
	}
}
function FunctRunning4(vValue)
{
	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=11;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>"
	 o.submit();
}
function UpToMachine()
{
	lv_chk_list(document.frmchoose,'lvChk',8);
}
function FunctRunning3(vValue)
{
	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=10;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();
}
function ChangeInfor()
{
var o1=document.frmchoose;
 	o1.submit();
}
function CheckEnter(e)
{
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;
	if(keynum=="13")
	{
		ChangeInfor();
	}
}
//-->
</script>
<?php
if($mohr_lv0020->GetView()==1)
{
?>
<link rel="stylesheet" href="../css/popup.css" type="text/css">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
						<table width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#f2f2f2;font:10px arial"><tr>
<?php
if($mohr_lv0020->GetApr()==1 && $mohr_lv0020->GetUnApr()==1)
{?>
					<!--	<td><input type="button" value="Reset mật khẩu" onclick="ResetPassHr()"/></td>-->
<?php
}			
?>			
<?php
if($mohr_lv0020->GetApr()==1 && $mohr_lv0020->GetUnApr()==1)//$_SESSION['ERPSOFV2RRight']=='admin')
{?>
						<td><input type="button" value="Cập nhật lại lịch ẩn" onclick="UpdateCalanderVisible()"/></td>
<?php
}			
?>						

						<td><input type="button" value="<?php echo 'Cập nhập mita';?>" onclick="UpToMachine()"/></td><td><?php echo $vLangArr[19];?> <input type="text" name="txtlv001" id="txtlv001" tabindex="1" value="<?php echo $mohr_lv0020->lv001;?>" onchange="ChangeInfor()"/>
						&nbsp;&nbsp;&nbsp;</td><td><?php echo $vLangArr[20];?></td><td>
							  <ul lang="pop-nav1" onmouseover="ChangeName(this,1)" id="pop-nav"> <li class="menupopT"> <input onKeyPress="return CheckEnter(event)"  name="txtFullName" id="txtFullName" autocomplete="off"  tabindex="1" maxlength="255" style="width:200px" value="<?php echo $mohr_lv0020->FullName;?>" onKeyUp="LoadSelfNextParent(this,'txtFullName','hr_lv0020','lv002','lv002')" onFocus="LoadSelfNextParent(this,'txtFullName','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)','concat(@! @!,lv004,@! @!,lv003,@! @!,lv002)')"/><div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td><td>&nbsp;&nbsp;&nbsp;<?php echo $vLangArr[28];?> <input type="text"  tabindex="1" name="txtlv010" id="txtlv010" value="<?php echo $mohr_lv0020->lv010;?>" onChange="ChangeInfor()"/></td></tr></table>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mohr_lv0020->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mohr_lv0020->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mohr_lv0020->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mohr_lv0020->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mohr_lv0020->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mohr_lv0020->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mohr_lv0020->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mohr_lv0020->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mohr_lv0020->lv009;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mohr_lv0020->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mohr_lv0020->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mohr_lv0020->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mohr_lv0020->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $mohr_lv0020->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $mohr_lv0020->lv016;?>"/>
						<input type="hidden" name="txtlv017" id="txtlv017" value="<?php echo $mohr_lv0020->lv017;?>"/>
						<input type="hidden" name="txtlv018" id="txtlv018" value="<?php echo $mohr_lv0020->lv018;?>"/>
						<input type="hidden" name="txtlv019" id="txtlv019" value="<?php echo $mohr_lv0020->lv019;?>"/>
						<input type="hidden" name="txtlv020" id="txtlv020" value="<?php echo $mohr_lv0020->lv020;?>"/>
						<input type="hidden" name="txtlv021" id="txtlv021" value="<?php echo $mohr_lv0020->lv021;?>"/>
						<input type="hidden" name="txtlv022" id="txtlv022" value="<?php echo $mohr_lv0020->lv022;?>"/>
						<input type="hidden" name="txtlv023" id="txtlv023" value="<?php echo $mohr_lv0020->lv023;?>"/>
						<input type="hidden" name="txtlv024" id="txtlv024" value="<?php echo $mohr_lv0020->lv024;?>"/>
						<input type="hidden" name="txtlv025" id="txtlv025" value="<?php echo $mohr_lv0020->lv025;?>"/>
						<input type="hidden" name="txtlv026" id="txtlv026" value="<?php echo $mohr_lv0020->lv026;?>"/>
						<input type="hidden" name="txtlv027" id="txtlv027" value="<?php echo $mohr_lv0020->lv027;?>"/>
						<input type="hidden" name="txtlv028" id="txtlv028" value="<?php echo $mohr_lv0020->lv028;?>"/>
						<input type="hidden" name="txtlv029" id="txtlv029" value="<?php echo $mohr_lv0020->lv029;?>"/>
						<input type="hidden" name="txtlv030" id="txtlv030" value="<?php echo $mohr_lv0020->lv030;?>"/>
						<input type="hidden" name="txtlv031" id="txtlv031" value="<?php echo $mohr_lv0020->lv031;?>"/>
						<input type="hidden" name="txtlv032" id="txtlv032" value="<?php echo $mohr_lv0020->lv032;?>"/>
						<input type="hidden" name="txtlv033" id="txtlv033" value="<?php echo $mohr_lv0020->lv033;?>"/>
						<input type="hidden" name="txtlv034" id="txtlv034" value="<?php echo $mohr_lv0020->lv034;?>"/>
						<input type="hidden" name="txtlv035" id="txtlv035" value="<?php echo $mohr_lv0020->lv035;?>"/>
						<input type="hidden" name="txtlv036" id="txtlv036" value="<?php echo $mohr_lv0020->lv036;?>"/>
						<input type="hidden" name="txtlv037" id="txtlv037" value="<?php echo $mohr_lv0020->lv037;?>"/>
						<input type="hidden" name="txtlv038" id="txtlv038" value="<?php echo $mohr_lv0020->lv038;?>"/>
						<input type="hidden" name="txtlv039" id="txtlv039" value="<?php echo $mohr_lv0020->lv039;?>"/>
						<input type="hidden" name="txtlv040" id="txtlv040" value="<?php echo $mohr_lv0020->lv040;?>"/>
						<input type="hidden" name="txtlv041" id="txtlv041" value="<?php echo $mohr_lv0020->lv041;?>"/>
						<input type="hidden" name="txtlv042" id="txtlv042" value="<?php echo $mohr_lv0020->lv042;?>"/>
						<input type="hidden" name="txtlv043" id="txtlv043" value="<?php echo $mohr_lv0020->lv043;?>"/>
						<input type="hidden" name="txtlv044" id="txtlv044" value="<?php echo $mohr_lv0020->lv044;?>"/>
						<input type="hidden" name="txtlv045" id="txtlv045" value="<?php echo $mohr_lv0020->lv045;?>"/>
						<input type="hidden" name="txtlv060" id="txtlv060" value="<?php echo $mohr_lv0020->lv060;?>"/>
						<input type="hidden" name="txtlv061" id="txtlv061" value="<?php echo $mohr_lv0020->lv061;?>"/>
						<input type="hidden" name="txtlv062" id="txtlv062" value="<?php echo $mohr_lv0020->lv062;?>"/>
						<input type="hidden" name="txtlv063" id="txtlv063" value="<?php echo $mohr_lv0020->lv063;?>"/>
						<input type="hidden" name="txtlv064" id="txtlv064" value="<?php echo $mohr_lv0020->lv064;?>"/>
						<input type="hidden" name="txtlv065" id="txtlv065" value="<?php echo $mohr_lv0020->lv065;?>"/>
						<input type="hidden" name="txtlv066" id="txtlv066" value="<?php echo $mohr_lv0020->lv066;?>"/>
						<input type="hidden" name="txtlv067" id="txtlv067" value="<?php echo $mohr_lv0020->lv067;?>"/>
						<input type="hidden" name="txtlv105" id="txtlv105" value="<?php echo $mohr_lv0020->lv105;?>"/>
						<input type="hidden" name="txtlv106" id="txtlv106" value="<?php echo $mohr_lv0020->lv106;?>"/>
						<input type="hidden" name="txtlv099" id="txtlv099" value="<?php echo $mohr_lv0020->lv099;?>"/>
						<input type="hidden" name="txtlv299" id="txtlv299" value="<?php echo $mohr_lv0020->lv299;?>"/>
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess1" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
<script language="javascript" src="../javascripts/menupopup.js"></script>						  
				  
</div></div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
<?php if($_GET['CandID']!="" && $_GET['CandID']!=NULL )
{
?>
setTimeout('Add()',1000);
<?php 
}
?>
<?php if($_GET['EmpID']!="" && $_GET['EmpID']!=NULL )
{
?>
setTimeout('FunctRunning1("<?php echo $_GET['EmpID'];?>")',1000);
<?php 
}
?>
</script>