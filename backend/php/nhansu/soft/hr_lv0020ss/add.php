<?php
session_start();
//require_once("../../clsall/hr_lv0020.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/hr_lv0038.php");
require_once("../../clsall/tc_lv0008.php");
require_once("../../clsall/tc_lv0010.php");
require_once("../../clsall/tc_lv0011.php");
//////////////init object////////////////
$lvhr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
$lvhr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0046');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","AD0022.txt",$plang);
$lvhr_lv0020->lang=strtoupper($plang);
if(!isset($_POST['txtlv001']))
{
	$_POST['txtlv102']=12;
}
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvhr_lv0020->lv001=str_replace(" ","",$_POST['txtlv001'] ?? '');
$lvhr_lv0020->lv002=$_POST['txtlv002'] ?? '';
$lvhr_lv0020->lv003=$_POST['txtlv003'] ?? '';
$lvhr_lv0020->lv004=$_POST['txtlv004'] ?? '';
$lvhr_lv0020->lv005=$_POST['txtlv005'] ?? '';
$lvhr_lv0020->lv006=$_POST['txtlv006'] ?? '';
$lvhr_lv0020->lv007=$_FILES['userfile']['name'] ?? '';
$lvhr_lv0020->lv008=$_POST['txtlv008'] ?? '';
$lvhr_lv0020->lv009=$_POST['txtlv009'] ?? '';
if($lvhr_lv0020->lv009=="" || $lvhr_lv0020->lv009==NULL) $lvhr_lv0020->lv009=1;
$lvhr_lv0020->lv010=$_POST['txtlv010'] ?? '';
$lvhr_lv0020->lv011=$_POST['txtlv011'] ?? '';
$lvhr_lv0020->lv012=$_POST['txtlv012'] ?? '';
$lvhr_lv0020->lv013=$_POST['txtlv013'] ?? '';
$lvhr_lv0020->lv014=$_POST['txtlv014'] ?? '';
$lvhr_lv0020->lv015=$_POST['txtlv015'] ?? '';
$lvhr_lv0020->lv016=$_POST['txtlv016'] ?? '';
$lvhr_lv0020->lv017=$_POST['txtlv017'] ??  '';
if($lvhr_lv0020->lv017=="" || $lvhr_lv0020->lv017==NULL) $lvhr_lv0020->lv017='MS002';
$lvhr_lv0020->lv018=$_POST['txtlv018'] ?? '';
$lvhr_lv0020->lv019=$_POST['txtlv019'] ?? '';
$lvhr_lv0020->lv020=$_POST['txtlv020'] ?? '';
$lvhr_lv0020->lv021=$_POST['txtlv021'] ?? '';
$lvhr_lv0020->lv022=$_POST['txtlv022'] ?? '';
if($lvhr_lv0020->lv022=='') 
	$lvhr_lv0020->lv022='VIETNAM';
$lvhr_lv0020->lv023=$_POST['txtlv023'] ?? '';
if($lvhr_lv0020->lv023=="" || $lvhr_lv0020->lv023==NULL) $lvhr_lv0020->lv023='KINH';
$lvhr_lv0020->lv024=$_POST['txtlv024'] ?? '';
if($lvhr_lv0020->lv024=="" || $lvhr_lv0020->lv024==NULL) $lvhr_lv0020->lv024='KHONG';
$lvhr_lv0020->lv025=$_POST['txtlv025'] ?? '';
$lvhr_lv0020->lv026=$_POST['txtlv026'] ?? '';
if($lvhr_lv0020->lv024=="" || $lvhr_lv0020->lv024==NULL) $lvhr_lv0020->lv024='...';
$lvhr_lv0020->lv027=$_POST['txtlv027'] ?? '';
if($lvhr_lv0020->lv027=="" || $lvhr_lv0020->lv027==NULL) $lvhr_lv0020->lv027='TT';
$lvhr_lv0020->lv028=$_POST['txtlv028'] ?? '';
$lvhr_lv0020->lv029=$_POST['txtlv029'] ?? '';
$lvhr_lv0020->lv030=$_POST['txtlv030'] ?? '';
$lvhr_lv0020->lv031=$_POST['txtlv031'] ?? '';
if($lvhr_lv0020->lv031=='') $lvhr_lv0020->lv031='VIETNAM';
$lvhr_lv0020->lv032=$_POST['txtlv032'] ?? '';
$lvhr_lv0020->lv033=$_POST['txtlv033'] ?? '';
$lvhr_lv0020->lv034=$_POST['txtlv034'] ?? '';
$lvhr_lv0020->lv035=$_POST['txtlv035'] ?? '';
$lvhr_lv0020->lv036=$_POST['txtlv036'] ?? '';
$lvhr_lv0020->lv037=$_POST['txtlv037'] ?? '';
$lvhr_lv0020->lv038=$_POST['txtlv038'] ?? '';
$lvhr_lv0020->lv039=$_POST['txtlv039'] ?? '';
$lvhr_lv0020->lv040=$_POST['txtlv040'] ?? '';
$lvhr_lv0020->lv041=$_POST['txtlv041'] ?? '';
$lvhr_lv0020->lv042=$_POST['txtlv042'] ?? '';
if($lvhr_lv0020->lv042=="" || $lvhr_lv0020->lv042==NULL) $lvhr_lv0020->lv042='...';
$lvhr_lv0020->lv043=$_POST['txtlv043'] ?? '';
$lvhr_lv0020->lv044=$_POST['txtlv044'] ?? '';
$lvhr_lv0020->lv045=$_POST['txtlv045'] ?? '';
$lvhr_lv0020->lv045=$_POST['txtlv045'] ??  '';
$lvhr_lv0020->lv049=$_POST['txtlv049'] ?? '';

$lvhr_lv0020->lv060=$_POST['txtlv060'] ?? '';
$lvhr_lv0020->lv061=$_POST['txtlv061'] ?? '';
$lvhr_lv0020->lv062=$_POST['txtlv062'] ?? '';
$lvhr_lv0020->lv063=$_POST['txtlv063'] ?? '';
$lvhr_lv0020->lv064=$_POST['txtlv064'] ?? '';
$lvhr_lv0020->lv065=$_POST['txtlv065'] ?? '';
$lvhr_lv0020->lv066=$_POST['txtlv066'] ?? '';
$lvhr_lv0020->lv067=$_POST['txtlv067'] ?? '';
$lvhr_lv0020->lv068=$_POST['txtlv068'] ?? '';
$lvhr_lv0020->lv069=$_POST['txtlv069'] ?? '';
$lvhr_lv0020->lv106=$_POST['txtlv106'] ?? '';

$lvhr_lv0020->lv099=$_POST['txtlv099'] ?? '';
$lvhr_lv0020->lv100=$_POST['txtlv100'] ?? '';
$lvhr_lv0020->lv101=$_POST['txtlv101'] ?? '';
$lvhr_lv0020->lv102=$_POST['txtlv102'] ?? '';
$lvhr_lv0020->lv104=$_POST['txtlv104'] ?? '';
$lvhr_lv0020->lv105=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$lvhr_lv0020->lv106=$_POST['txtlv106'] ?? '';
$lvhr_lv0020->lv029ex='';
$lvhr_lv0020->lv299=$_POST['txtlv299'] ?? '';
$lvhr_lv0020->lv114=$_POST['txtlv114'] ?? '';
$lvhr_lv0020->lv116=$_POST['txtlv116'] ?? '';
echo $lvhr_lv0020->lv116=$_POST['txtlv102'] ?? '';
if($lvhr_lv0020->GetApr()==0)  $lvhr_lv0020->lv029ex=$lvhr_lv0020->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
if($vFlag==1)
{
		
		$vresult=$lvhr_lv0020->LV_Insert();
		if($vresult==true) {
			//UploadImg($lvhr_lv0020->lv001, $lvhr_lv0020->lv007);///Call function Upload file
			$vStrMessage=$vLangArr[9];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}
}
else if($vFlag==2)
{
		$data = array();
  
  function add_person( $lv001,$lv002,$lv003,$lv004,$lv005, $lv029, $lv015,$lv010,$lv011,$lv012,$lv013,$lv014,$lv018,$lv022,$lv034,$lv009,$lv030,$lv039,$lv040,$lv803,$lv804,$lv805,$lv812,$lv807,$lv810,$lv811,$lv813,$lv814,$lv815,$lv816,$lv817,$lv818,$lv819,$lv820,$lv821,$lv822,$lv823,$lv824,$lv825,$lv826,$lv831,$lv832,$lv833,$lv834,$lv835,$lv836,$lv837,$lv8101,$cn099,$lv099,$lv100,$lv101,$lv102,$lv026,$lv028,$lv035,$lv044,$lv049,$lv060,$lv061,$lv062,$lv063,$lv064,$lv065,$lv066,$lv067,$lv068,$lv069,$lv106)
  {
  global $data;
  
  $data []= array(
  'lv001' => $lv001,
  'lv002' => $lv002,
  'lv003' => $lv003,
  'lv004' => $lv004,
  'lv005' => $lv005,
  'lv029' => $lv029,
  'lv015' => $lv015,
  'lv010' => $lv010,
  'lv011' => $lv011,
  'lv012' => $lv012,
  'lv013' => $lv013,
  'lv014' => $lv014,
  'lv018' => $lv018,
  'lv022' => $lv022,
  'lv034' => $lv034,
  'lv009' => $lv009,
  'lv030' => $lv030,
  'lv039' => $lv039,
  'lv040' => $lv040,
  'lv803' => $lv803,
  'lv804' => $lv804,
  'lv805' => $lv805,  
  'lv807' => $lv807,
  'lv810' => $lv810,
  'lv811' => $lv811,
  'lv812' => $lv812,
  'lv813' => $lv813,
  'lv814' => $lv814,
  'lv815' => $lv815,
  'lv816' => $lv816,
  'lv817' => $lv817,
  'lv818' => $lv818,
  'lv819' => $lv819,
  'lv820' => $lv820,
  'lv821' => $lv821,
  'lv822' => $lv822,
  'lv823' => $lv823,
  'lv824' => $lv824,
  'lv825' => $lv825,
  'lv826' => $lv826,
  'lv831' => $lv831,
  'lv832' => $lv832,
  'lv833' => $lv833,
  'lv834' => $lv834,
  'lv835' => $lv835,
  'lv836' => $lv836,
  'lv837' => $lv837,
  'lv8101'=> $lv8101,
  'lv099' => $lv099,
  'lv100' => $lv100,
  'lv101' => $lv101,
  'lv102' => $lv102,
  'cn099' => $cn099,
  'lv026' => $lv026,
  'lv028' => $lv028,
  'lv035' => $lv035,
  'lv044' => $lv044,
  'lv049' => $lv049,
  'lv060' => $lv060,
  'lv061' => $lv061,
  'lv062' => $lv062,
  'lv063' => $lv063,
  'lv064' => $lv064,
  'lv065' => $lv065,
  'lv066' => $lv066,
  'lv067' => $lv067,
  'lv068' => $lv068,
  'lv069' => $lv069,
  'lv106' => $lv106,
  );
  }

	 $lvNow=GetServerDate()." ".GetServerTime();
	 if ( $_FILES['file']['tmp_name'] )
  	{
	  $dom=new DOMDocument();
	  	$dom->load( $_FILES['file']['tmp_name'] );
	  $rows = $dom->getElementsByTagName( 'Row' );
	  $first_row = true;
	  foreach ($rows as $row)
	  {
		  if ( !$first_row )
		  {
			  $first = "";
			  $middle = "";
			  $last = "";
			  $email = "";
			  $lv001="";
			  
			  $index = 1;
			  $cells = $row->getElementsByTagName( 'Cell' );
			  foreach( $cells as $cell )
			  { 
				  $ind = $cell->getAttribute( 'Index' );
				  if ( $ind != null ) $index = $ind;
				  if ( $index == 1 ) $lv001 = trim($cell->nodeValue);
				  if ( $index == 2 ) $lv002 = $cell->nodeValue;
				  if ( $index == 3 ) $lv005 = $cell->nodeValue;
				  if ( $index == 4 ) $lv029 = $cell->nodeValue;
				  if ( $index == 5 ) $lv015 = $cell->nodeValue;
				  if ( $index == 6 ) $lv010 = $cell->nodeValue;
				  if ( $index == 7 ) $lv011 = $cell->nodeValue;
				  if ( $index == 8 ) $lv012 = $cell->nodeValue;
				  if ( $index == 9 ) $lv013 = $cell->nodeValue;
				  if ( $index == 10 ) $lv014 = $cell->nodeValue;
				  if ( $index == 11 ) $lv106 = $cell->nodeValue;
				  if ( $index == 12 ) $lv018 = $cell->nodeValue;
				  if ( $index == 13 ) $lv034 = $cell->nodeValue;
				  if ( $index == 14 ) $lv009 = $cell->nodeValue;
				  if ( $index == 15 ) $lv039 = $cell->nodeValue;
				  if ( $index == 16 ) $lv040 = $cell->nodeValue;
				  if ( $index == 17 ) $lv030 = $cell->nodeValue;
				  if ( $index == 18 ) $lv804 = $cell->nodeValue;
				  if ( $index == 19 ) $lv805 = $cell->nodeValue;
				  if ( $index == 20 ) $lv803 = $cell->nodeValue;
				  if ( $index == 21 ) $lv812 = $cell->nodeValue;
				  if ( $index == 22 ) $lv807 = $cell->nodeValue;
				  if ( $index == 23 ) $lv821 = $cell->nodeValue;
				  if ( $index == 24 ) $lv822 = $cell->nodeValue;
				  if ( $index == 25 ) $lv813 = $cell->nodeValue;
				  if ( $index == 26 ) $lv814 = $cell->nodeValue;
				  if ( $index == 27 ) $lv826 = $cell->nodeValue;
				  if ( $index == 28 ) $lv816 = $cell->nodeValue;
				  if ( $index == 29 ) $lv818 = $cell->nodeValue;
				  if ( $index == 30 ) $lv820 = $cell->nodeValue;
				  if ( $index == 31 ) $lv825 = $cell->nodeValue;
				  if ( $index == 32 ) $lv823 = $cell->nodeValue;
				  if ( $index == 33 ) $lv831 = $cell->nodeValue;
				  if ( $index == 34 ) $lv832 = $cell->nodeValue;
				  if ( $index == 35 ) $lv833 = $cell->nodeValue;
				  if ( $index == 36 ) $lv834 = $cell->nodeValue;
				  if ( $index == 37 ) $lv835 = $cell->nodeValue;
				  if ( $index == 38 ) $lv836 = $cell->nodeValue;
				  if ( $index == 39 ) $lv837 = $cell->nodeValue;

				  if ( $index == 40 ) $lv824 = $cell->nodeValue;
				  if ( $index == 41 ) $lv811 = $cell->nodeValue;
				  if ( $index == 42 ) $lv819 = $cell->nodeValue;
				  if ( $index == 43 ) $lv817 = $cell->nodeValue;
				  if ( $index == 44 ) $lv815 = $cell->nodeValue;
				  if ( $index == 45 ) $lv8101 = $cell->nodeValue;				  
				  if ( $index == 46 ) $cn099 = $cell->nodeValue;
				  if ( $index == 47 ) $lv099 = $cell->nodeValue;
				  if ( $index == 48 ) $lv101 = $cell->nodeValue;
				  if ( $index == 49 ) $lv022 = $cell->nodeValue;
				  if ( $index == 50 ) $lv102 = $cell->nodeValue;
				  if ( $index == 51 ) $lv060 = $cell->nodeValue;
				  if ( $index == 52 ) $lv062 = $cell->nodeValue;
				  if ( $index == 53 ) $lv061 = $cell->nodeValue;
				  if ( $index == 54 ) $lv063 = $cell->nodeValue;
				  if ( $index == 55 ) $lv035 = $cell->nodeValue;
				  if ( $index == 56 ) $lv028 = $cell->nodeValue;
				  if ( $index == 57 ) $lv026 = $cell->nodeValue;
				  if ( $index == 58 ) $lv065 = $cell->nodeValue;
				  if ( $index == 59 ) $lv066 = $cell->nodeValue;
				  if ( $index == 60 ) $lv064 = $cell->nodeValue;
				  if ( $index == 61 ) $lv049 = $cell->nodeValue;
				  if ( $index == 62 ) $lv067 = $cell->nodeValue;
				  if ( $index == 63 ) $lv068 = $cell->nodeValue;
				  if ( $index == 64 ) $lv069 = $cell->nodeValue;
				  if ( $index == 65 ) $lv044 = $cell->nodeValue;
				  if ( $index == 66 ) $lv081 = $cell->nodeValue;
				  if ( $index == 67 ) $lv003 = $cell->nodeValue;
				  if ( $index == 68 ) $lv004 = $cell->nodeValue;
				  $index += 1;
		  }
		if(trim($lv001)!="" && $lv001!=NULL) add_person( $lv001,$lv002,$lv003,$lv004,$lv005, $lv029, $lv015,$lv010,$lv011,$lv012,$lv013,$lv014,$lv018,$lv022,$lv034,$lv009,$lv030,$lv039,$lv040,$lv803,$lv804,$lv805,$lv812,$lv807,$lv810,$lv811,$lv813,$lv814,$lv815,$lv816,$lv817,$lv818,$lv819,$lv820,$lv821,$lv822,$lv823,$lv824,$lv825,$lv826,$lv831,$lv832,$lv833,$lv834,$lv835,$lv836,$lv837,$lv8101,$cn099,$lv099,$lv100,$lv101,$lv102,$lv026,$lv028,$lv035,$lv044,$lv049,$lv060,$lv061,$lv062,$lv063,$lv064,$lv065,$lv066,$lv067,$lv068,$lv069,$lv106);
	  }
	  $first_row = false;
	  }
  	}
	$lvtc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0008');
	$lvtc_lv0011=new tc_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0011');
	$vDateLimited=$lvtc_lv0011->LV_GetHoliday('2015-01-01','2050-01-01');
	$vOrderThem=0;
	$vOrderCapnhat=0;
	foreach( $data as $row )
	{
		if(trim($row['lv001'])!="" && strpos(' ',trim($row['lv001']))===false )
		{
		$lvhr_lv0020->LV_LoadID($row['lv001']);
		if($lvhr_lv0020->lv001==NULL)
		{
		$lvhr_lv0020->lv001=$row['lv001'];
		$lvhr_lv0020->lv002=$row['lv002'];
		$lvhr_lv0020->lv003=$row['lv003'];
		$lvhr_lv0020->lv004=$row['lv004'];
		$lvhr_lv0020->lv005=$row['lv005'];
		$lvhr_lv0020->lv006=$row['lv006'];
		$lvhr_lv0020->lv007=$row['lv007'];
		$lvhr_lv0020->lv008=$row['lv008'];
		$lvhr_lv0020->lv009=$row['lv009'];
		$lvhr_lv0020->lv010=$row['lv010'];
		$lvhr_lv0020->lv011=$row['lv011'];
		$lvhr_lv0020->lv012=$row['lv012'];
		$lvhr_lv0020->lv013=$row['lv013'];
		$lvhr_lv0020->lv014=$row['lv014'];
		$lvhr_lv0020->lv069=$row['lv069'];
		if($lvhr_lv0020->lv069==1)
		{
			$lvhr_lv0020->lv015=$row['lv015'];
			if(strlen(trim($lvhr_lv0020->lv015))==4) $lvhr_lv0020->lv015="01/01/".trim($lvhr_lv0020->lv015);
		}
		else
			$lvhr_lv0020->lv015=$row['lv015'];
		$lvhr_lv0020->lv018=$row['lv018'];		
		$lvhr_lv0020->lv022=$row['lv022'];	
		$lvhr_lv0020->lv029=$row['lv029'];
		$lvhr_lv0020->lv030=$row['lv030'];
		$lvhr_lv0020->lv031=$row['lv022'];	
		$lvhr_lv0020->lv034=$row['lv034'];
		$lvhr_lv0020->lv039=$row['lv039'];
		$lvhr_lv0020->lv040=$row['lv040'];
		$lvhr_lv0020->lv044=$row['lv044'];
		$lvhr_lv0020->lv099=$row['lv099'];
		$lvhr_lv0020->lv100=$row['lv100'];
		$lvhr_lv0020->lv101=$row['lv101'];
		$lvhr_lv0020->lv102=$row['lv102'];
		$lvhr_lv0020->lv060=$row['lv060'];
		$lvhr_lv0020->lv061=$row['lv061'];
		$lvhr_lv0020->lv062=$row['lv062'];
		$lvhr_lv0020->lv063=$row['lv063'];
		$lvhr_lv0020->lv064=$row['lv064'];
		$lvhr_lv0020->lv065=$row['lv065'];
		$lvhr_lv0020->lv066=$row['lv066'];
		$lvhr_lv0020->lv067=$row['lv067'];
		$lvhr_lv0020->lv068=$row['lv068'];
		
		$lvhr_lv0020->lv028=$row['lv028'];
		$lvhr_lv0020->lv026=$row['lv026'];
		$lvhr_lv0020->lv035=$row['lv035'];
		$lvhr_lv0020->lv049=$row['lv049'];
		$vresult=$lvhr_lv0020->LV_Insert();
		$vOrderThem++;
		if($vresult)
		{
			$vDSThemMoi=$vDSThemMoi.$vOrderThem.".".$lvhr_lv0020->lv001." ".$lvhr_lv0020->lv002.": Đã thêm thành công<br/>";
		}
		else
		{
			$vDSThemMoi=$vDSThemMoi.$vOrderThem.".".$lvhr_lv0020->lv001." ".$lvhr_lv0020->lv002.": <font color=red>Đã thêm không thành công</font><br/>";
		}
		if($vresult && $row['cn099']==1)
		{
		
			$lvhr_lv0038->lv002=$lvhr_lv0020->lv001;
			$lvhr_lv0038->lv003=$row['lv803'];
			if($lvhr_lv0038->lv003==0) $lvhr_lv0038->lv003=2;
			$lvhr_lv0038->lv004=$row['lv804'];
			$lvhr_lv0038->lv098=$row['lv804'];
			$lvhr_lv0038->lv005=$row['lv805'];			
			$lvhr_lv0038->lv007=$row['lv807'];
			$lvhr_lv0038->lv009=1;
			$lvhr_lv0038->lv010=$row['lv029'];	
			$lvhr_lv0038->lv011=$row['lv811'];			
			$lvhr_lv0038->lv012=$row['lv812'];
			$lvhr_lv0038->lv013=$row['lv813'];
			$lvhr_lv0038->lv014=$row['lv814'];
			$lvhr_lv0038->lv015=$row['lv815'];
			$lvhr_lv0038->lv016=$row['lv816'];
			$lvhr_lv0038->lv017=$row['lv817'];
			$lvhr_lv0038->lv018=$row['lv818'];
			$lvhr_lv0038->lv019=$row['lv819'];
			$lvhr_lv0038->lv020=$row['lv820'];
			$lvhr_lv0038->lv021=$row['lv821'];
			$lvhr_lv0038->lv022=$row['lv822'];
			$lvhr_lv0038->lv023=$row['lv823'];
			$lvhr_lv0038->lv024=$row['lv824'];
			$lvhr_lv0038->lv025=$row['lv825'];
			$lvhr_lv0038->lv026=$row['lv826'];
			$lvhr_lv0038->lv031=$row['lv831'];
			$lvhr_lv0038->lv032=$row['lv832'];
			$lvhr_lv0038->lv033=$row['lv833'];
			$lvhr_lv0038->lv034=$row['lv834'];
			$lvhr_lv0038->lv035=$row['lv835'];
			$lvhr_lv0038->lv036=$row['lv836'];
			$lvhr_lv0038->lv037=$row['lv837'];

			$lvhr_lv0038->lv027=$row['lv005'];
			$lvhr_lv0038->lv028=$row['lv060'];
			$lvhr_lv0038->lv029=$row['lv061'];
			$lvhr_lv0038->lv030=$row['lv067'];
			
			$vStartDate=$lvhr_lv0038->lv004;
			$vEndDate=$lvhr_lv0038->lv005;
			$vresult=$lvhr_lv0038->LV_Insert_NoID();			
			if($vresult && $row['cn099']==1)
			{
				$lvtc_lv0008->lang=$plang;
				//echo "$lvhr_lv0038->lv002,$lvhr_lv0038->lv010,$lvhr_lv0038->lv007,$lvhr_lv0038->lv004,$lvhr_lv0038->lv005";
				//$lvtc_lv0008->LV_InsertEmpContract($lvhr_lv0038->lv002,$lvhr_lv0038->lv010,$lvhr_lv0038->lv007,$lvhr_lv0038->lv004,$lvhr_lv0038->lv005);
				$lvtc_lv0010=new tc_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0046');
				//$lvtc_lv0010->lv001=InsertWithCheckExt('tc_lv0010', 'lv001', '',1);
				$lvtc_lv0010->lv002=$row['lv001'];
				$lvtc_lv0010->lv003="PRJ000001";
				$lvtc_lv0010->lv004=$vStartDate;
				$lvtc_lv0010->lv005=$vEndDate;
				$lvtc_lv0010->lv006=1;
				$lvtc_lv0010->lv008=$_SESSION['ERPSOFV2RUserID'];
				$lvtc_lv0010->lv009=GetServerDate();
				$lvtc_lv0010->lv010=$lvhr_lv0038->lv001;
				$lvResult=$lvtc_lv0010->LV_InsertNoID();
				if($lvResult)
				{
					$vTimesheetID=$lvtc_lv0010->lv001;
					if($vDateLimited=="''")
						{
							$psql="insert into tc_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv099) select '$vTimesheetID',lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,'$lvhr_lv0038->lv001' from tc_lv0011_ where lv004>='$lvtc_lv0010->lv004' and lv004<='$lvtc_lv0010->lv005'";
							db_query($psql);
						}
						else
						{
							$psql="insert into tc_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv099) select '$vTimesheetID',lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,'$lvhr_lv0038->lv001' from tc_lv0011_ where lv004>='$lvtc_lv0010->lv004' and lv004<='$lvtc_lv0010->lv005' and (lv004 not in ($vDateLimited))";
							db_query($psql);
							$psql="insert into tc_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv099) select '$vTimesheetID',A.lv003,A.lv004,A.lv005,A.lv006,B.lv004,A.lv008,A.lv009,A.lv010,A.lv011,'$lvhr_lv0038->lv001' from tc_lv0011_ A inner join tc_lv0003 B on A.lv004=B.lv002 where A.lv004>='$lvtc_lv0010->lv004' and A.lv004<='$lvtc_lv0010->lv005' and (A.lv004 in ($vDateLimited))";
							db_query($psql);
						}
					
				}
			}
			
		}
		}
		else
		{
		$lvhr_lv0020->lv001=$row['lv001'];
		$lvhr_lv0020->lv002=$row['lv002'];
		$lvhr_lv0020->lv003=$row['lv003'];
		$lvhr_lv0020->lv004=$row['lv004'];
		$lvhr_lv0020->lv005=$row['lv005'];
		$lvhr_lv0020->lv006=$row['lv006'];
		$lvhr_lv0020->lv007=$row['lv007'];
		$lvhr_lv0020->lv008=$row['lv008'];
		$lvhr_lv0020->lv009=$row['lv009'];
		$lvhr_lv0020->lv010=$row['lv010'];
		$lvhr_lv0020->lv011=$row['lv011'];
		$lvhr_lv0020->lv012=$row['lv012'];
		$lvhr_lv0020->lv013=$row['lv013'];
		$lvhr_lv0020->lv014=$row['lv014'];
		$lvhr_lv0020->lv069=$row['lv069'];
		if($lvhr_lv0020->lv069==1)
		{
			$lvhr_lv0020->lv015=$row['lv015'];
			if(strlen(trim($lvhr_lv0020->lv015))==4) $lvhr_lv0020->lv015="01/01/".trim($lvhr_lv0020->lv015);
		}
		else
			$lvhr_lv0020->lv015=$row['lv015'];
		$lvhr_lv0020->lv018=$row['lv018'];		
		$lvhr_lv0020->lv022=$row['lv022'];	
		$lvhr_lv0020->lv029=$row['lv029'];
		$lvhr_lv0020->lv030=$row['lv030'];
		$lvhr_lv0020->lv031=$row['lv022'];	
		$lvhr_lv0020->lv034=$row['lv034'];
		$lvhr_lv0020->lv039=$row['lv039'];
		$lvhr_lv0020->lv040=$row['lv040'];
		$lvhr_lv0020->lv099=$row['lv099'];
		$lvhr_lv0020->lv100=$row['lv100'];
		$lvhr_lv0020->lv101=$row['lv101'];
		$lvhr_lv0020->lv102=$row['lv102'];
		$lvhr_lv0020->lv106=$row['lv106'];
		$lvhr_lv0020->lv060=$row['lv060'];
		$lvhr_lv0020->lv061=$row['lv061'];
		$lvhr_lv0020->lv062=$row['lv062'];
		$lvhr_lv0020->lv063=$row['lv063'];
		$lvhr_lv0020->lv064=$row['lv064'];
		$lvhr_lv0020->lv065=$row['lv065'];
		$lvhr_lv0020->lv066=$row['lv066'];
		$lvhr_lv0020->lv067=$row['lv067'];
		$lvhr_lv0020->lv028=$row['lv028'];
		$lvhr_lv0020->lv026=$row['lv026'];
		$lvhr_lv0020->lv035=$row['lv035'];
		$lvhr_lv0020->lv049=$row['lv049'];
		$lvhr_lv0020->lv068=$row['lv068'];	
		$lvhr_lv0020->lv044=$row['lv044'];		
		$vOrderCapnhat++;
		$vresult=$lvhr_lv0020->LV_UpdateXML();
		if($vresult)
		{
			$vDSCapNhat=$vDSCapNhat.$vOrderCapnhat.".".$lvhr_lv0020->lv001." ".$lvhr_lv0020->lv002.": cập nhật thành công<br/>";
		}
		else
		{
			$vDSCapNhat=$vDSCapNhat.$vOrderCapnhat.".".$lvhr_lv0020->lv001." ".$lvhr_lv0020->lv002.": <font color=red>cập nhật không thành công</font><br/>";
		}
		}
		
		}
		
	}
	echo '<div style="text-align:left">
	<h2> I. Danh sách thêm mới</h2>';
	if($vOrderThem>0)
		echo $vDSThemMoi;
	else
		echo 'Không có nhân viên nào';
	echo '
	<hr>
	<div style="text-align:left">
	<h2> II. Danh sách cập nhật</h2>';
	if($vOrderCapnhat>0)
		echo $vDSCapNhat;
	else
		echo 'Không có nhân viên nào';
	echo "</div>";
		if($vresult==true) {
			$vStrMessage=$vLangArr[9];
			$vFlag = 0;
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}
}
else
{
	$vCandID=$_GET['CandID'];
	if($vCandID!="" && $vCandID!=NULL)
	{
		require_once("../../clsall/hr_lv0078.php");
		$lvhr_lv0078=new hr_lv0078($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0078');
		$lvhr_lv0078->LV_LoadID($vCandID);
		$lvhr_lv0020->lv002=$lvhr_lv0078->lv003;
		$lvhr_lv0020->lv003=$lvhr_lv0078->lv004;
		$lvhr_lv0020->lv004=$lvhr_lv0078->lv005;
		$lvhr_lv0020->lv005=$lvhr_lv0078->getvaluelink('lv002',$lvhr_lv0078->lv002);
		$lvhr_lv0020->lv006=$lvhr_lv0078->lv006;
		$lvhr_lv0020->lv007=$_FILES['userfile']['name'];
		$lvhr_lv0020->lv008=$_POST['txtlv008'];
		$lvhr_lv0020->lv009=$_POST['txtlv009'];
		$lvhr_lv0020->lv010=$lvhr_lv0078->lv007;
		$lvhr_lv0020->lv011=$lvhr_lv0078->lv008;;
		$lvhr_lv0020->lv012=$lvhr_lv0078->lv009;
		$lvhr_lv0020->lv013=$_POST['txtlv013'];
		$lvhr_lv0020->lv014=$_POST['txtlv014'];
		$lvhr_lv0020->lv015=$lvhr_lv0078->lv010;
		$lvhr_lv0020->lv016=$lvhr_lv0078->lv011;
		$lvhr_lv0020->lv017=$lvhr_lv0078->lv016;
		$lvhr_lv0020->lv018=$lvhr_lv0078->lv012;
		$lvhr_lv0020->lv019=$_POST['txtlv019'];
		$lvhr_lv0020->lv020=$_POST['txtlv020'];
		$lvhr_lv0020->lv021=$_POST['txtlv021'];
		$lvhr_lv0020->lv022=$lvhr_lv0078->lv013;
		$lvhr_lv0020->lv023=$lvhr_lv0078->lv014;
		$lvhr_lv0020->lv024=$lvhr_lv0078->lv015;
		$lvhr_lv0020->lv025=$_POST['txtlv025'];
		$lvhr_lv0020->lv026=$_POST['txtlv026'];
		$lvhr_lv0020->lv027=$lvhr_lv0078->lv044;
		$lvhr_lv0020->lv028=$_POST['txtlv028'];
		$lvhr_lv0020->lv029=$_POST['txtlv029'];
		$lvhr_lv0020->lv030=$lvhr_lv0078->lv042;
		$lvhr_lv0020->lv031=$lvhr_lv0078->lv017;
		$lvhr_lv0020->lv032=$lvhr_lv0078->lv018;
		$lvhr_lv0020->lv033=$_POST['txtlv033'];
		$lvhr_lv0020->lv034=$lvhr_lv0078->lv019;
		$lvhr_lv0020->lv035=$lvhr_lv0078->lv020;
		$lvhr_lv0020->lv036=$_POST['txtlv036'];
		$lvhr_lv0020->lv037=$lvhr_lv0078->lv021;
		$lvhr_lv0020->lv038=$lvhr_lv0078->lv022;
		$lvhr_lv0020->lv039=$lvhr_lv0078->lv023;
		$lvhr_lv0020->lv040=$lvhr_lv0078->lv024;
		$lvhr_lv0020->lv041=$lvhr_lv0078->lv025;
		$lvhr_lv0020->lv042=$_POST['txtlv042'];
		$lvhr_lv0020->lv043=$_POST['txtlv043'];
		$lvhr_lv0020->lv044=$_POST['txtlv044'];
	}
}
function UploadImg($folder_name, $fname){
	$maxsize = 3169600;//Max file size 300KMB
	$path = "../../images/employees/";
	$arrName = explode(".", $fname);
		$fname = $arrName[0];///Get name without extention of file
	if(create_folder($path, $folder_name)==true){
		$path = $path.$folder_name."/";
		$result = upload_file($fpath, $fname, $path, $maxsize);
		if($result==1){
			$message = "Image uploaded successfully!";
			//$vFlag = 2;//Upload successful.
			//$fpath = "";
			//$fname = "";
		}
		if($result==2)
			$message = "Incorrect file type!";
		if($result==3 || $result==4)
			$message = "Image size is very small or big!";
		if($result==5 || $result==6)
			$message = "Error in uploading file, please try again!";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script>
</head>
<script language="javascript">
<!--
function isphone(s){
	if(s!=""){
		var str="0123456789. ()-"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					return false
				}	
			return true
		}	
		return true
}
	function Refresh()
	{
		var o=document.frmadd;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv001.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		//o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv001.value=="")
		{
			alert("<?php echo $vLangArr[60];?>");
			o.txtlv001.select();
		}
		else if(o.txtlv002.value==""){
			alert("<?php echo $vLangArr[61];?>");
			o.txtlv002.focus();
			}
		else if(o.txtlv030.value==""){
		alert("<?php echo 'Ngày làm việc không bỏ trống!';?>");
		o.txtlv030.focus();
		}	
		else if(!isphone(o.txtlv038.value)){
			alert("<?php echo $vLangArr[60];?>");
			o.txtlv038.focus();
			}	
		else if(!isphone(o.txtlv039.value)){
			alert("<?php echo $vLangArr[60];?>");
			o.txtlv039.focus();
			}	
		else
			{
				o.txtlv007.value=o.userfile.value;
				o.txtFlag.value="1";
				o.submit();
			}
		
	}
	function SaveMul()
	{
		var o=document.frmadd;
		
				o.txtFlag.value=2;
				o.submit();

	}
	
	function uploadCCCD(){
		var formData = new FormData();
		var fileInput = document.getElementById('anhcmnd');
		var file = fileInput.files[0];
		formData.append("file", file);

		fetch('http://192.168.1.20:5000/api/process-id', {
		  method: 'POST',
		  
		  // KHÔNG set headers 'Content-Type' ở đây!
		  body: formData
		})
		.then(response => response.json())
		.then(data => {
			console.log(data);
			document.querySelector('[name="txtlv010"]').value = data.data.cccd_number;
			document.querySelector('[name="txtlv015"]').value = data.data.birthdate;
			if (data.data.gender === "Nam") {
				document.querySelector('[name="txtlv018"]').value = "1";
			} else if (data.data.gender === "Nữ") {
				document.querySelector('[name="txtlv018"]').value = "0";
			}
			document.querySelector('[name="txtlv011"]').value = data.data.issue_date;
			document.querySelector('[name="txtlv002"]').value = data.data.fullname;
			
		})
		.catch(error => {
		  console.error('Lỗi khi gọi API:', error);
		});
	}
-->
</script>
<?php
if($lvhr_lv0020->GetAdd()>0)
{
$loadenter	=$_POST['load-enter'] ?? '';
?>
<body onkeyup="KeyPublicRun(event)">
<div id="content_child" >
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[0];?></h2>
    <h3>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td>
				
				
				<form id="cccdForm" enctype="multipart/form-data" onsubmit="event.preventDefault(); uploadCCCD();">
					 <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); text-align: center; margin-bottom: 20px">
						<h2 style="margin-bottom: 20px;">Tải ảnh lên</h2>
					
						  <h3>Đọc dữ liệu từ ảnh CCCD/CMND</h3>
						  <input type="file" name="anhcmnd" id="anhcmnd">
						  <button type="submit">Tải ảnh và lấy dữ liệu</button>
					</div>
				</form>
				
				
				
				
				
				
				
				
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form  name="frmadd" method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag"  />
						<table width="100%" border="0" align="center" id="table">
							<tr>
							  <td colspan="2" height="100%" align="center"><p>
							    <label>
							      <input type="radio" name="load-enter" value="0" id="load-enter_0" <?php echo ($loadenter==0)?'checked':'';?> onClick="changestate(1)">
							      Nhập từng nhân viên
							    </label>
							    
							    <label>
							      <input type="radio" name="load-enter" value="1" id="load-enter_1" <?php echo ($loadenter==1)?'checked':'';?> onClick="changestate(2)">
							     Nạp nhân viên từ tập tin
							    </label>
							    <br>
						      </p></td>
						  </tr>
                         </table>
			<!---Load File-->                         
                         <div id="fileload" style="display:none">
                         <table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo 'Chọn tập tin';?></td>
								<td width="*%"  height="20px">
									<input type="file" name="file" />			</td>
							</tr>															
							<tr>
							  <td  height="20px" colspan="2"><a href="LIST_EMP_TEMPLATE.zip" title="<?php echo $vLangArr[33];?>"><?php echo 'Download mẫu';?></a></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
                                        <TBODY>
                                        <TR vAlign=center align=middle>
                                              <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:SaveMul();" tabindex="16"><img src="../images/controlright/save_f2.png" 
                                            alt="Save" title="<?php echo $vLangArr[1];?>" 
                                            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
                                          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
                                            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
                                            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
                                          <TD nowrap="nowrap"><a class=lvtoolbar 
                                            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
                                            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
                                            name=remove> <?php echo $vLangArr[6];?></a></TD>
                                            </TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
                      </div>
<!---End Load File-->
<!---Enter New Line-->   
                 
                      <div id="enterline" style="display:block">
				
					 
						<table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="4" height="100%" align="center">
								</font>
								<?php
								$vStrMessage = '';
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="150"  height="20"><?php echo $vLangArr[15];?></td>
								<td width="300"  height="20">
								<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo ($lvhr_lv0020->lv001=="")?InsertWithCheckExtCONVERT('hr_lv0020', 'lv001', 'MP',3):$lvhr_lv0020->lv001;?>" tabindex="5" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
								<td width="150"   height="20"><?php echo $vLangArr[16];?></td>
								<td width="300"  height="20"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvhr_lv0020->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
							
							<tr>
								<td  height="20"><?php echo $vLangArr[17];?></td>
								<td  height="20"><input  name="txtlv003" type="text" id="txtlv003" value="<?php echo $lvhr_lv0020->lv003;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td  height="20"><?php echo $vLangArr[18];?></td>
								<td  height="20"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvhr_lv0020->lv004;?>" tabindex="8" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>								
							<tr>
								<td  height="20"><?php echo $vLangArr[19];?></td>
								<td  height="20"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvhr_lv0020->lv005;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
								<td  height="20"><?php echo $vLangArr[20];?></td>
								<td  height="20"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvhr_lv0020->lv006;?>" tabindex="10" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							</tr>	
							<tr>
								<td  height="20"><?php echo $vLangArr[43];?></td>
							    <td  height="20"><select name="txtlv029"  id="txtlv029" value="<?php echo $lvhr_lv0020->lv029;?>" tabindex="11"  style="width:80%" onKeyPress="return CheckKey(event,7)">
								<?php echo $lvhr_lv0020->LV_GetChildDepSelect($lvhr_lv0020->lv029ex,$lvhr_lv0020->lv029);//LV_LinkField('lv029',$lvhr_lv0020->lv029);?></select></td>
								<td colspan="2" rowspan="4" align="center"><img  name="imgView" border="1" style="border-color:#CCCCCC;" title="" alt="Image" width="96px" height="100px" 
								src="<?php echo "../../images/employees/".$lvhr_lv0020->lv001."/".$lvhr_lv0020->lv007; ?>" /></td>
								</td>
							</tr>
							<tr>
															 
								<td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20"><select name="txtlv009" id="txtlv009" tabindex="13" style="width:80%" onKeyPress="return CheckKey(event,7)">
							  	<?php echo $lvhr_lv0020->LV_LinkField('lv009',$lvhr_lv0020->lv009);?>
								
							    </select>							  </td>
							</tr>
							<tr>
								<td  height="20"><?php echo 'KPI';?></td>
							    <td  height="20">
									<table style="width:80%"><tr><td style="width:50%">
										<select name="txtlv299"  id="txtlv299" value="<?php echo $lvhr_lv0020->lv299;?>" tabindex="11"  style="width:100%" onKeyPress="return CheckKey(event,7)">
									 	<?php echo $lvhr_lv0020->LV_LinkField('lv299',$lvhr_lv0020->lv299);?>
									 	</select>
								 	</td>
								  <td>
									<ul id="pop-nav99" lang="pop-nav99" onMouseOver="ChangeName(this,99)" onkeyup="ChangeName(this,99)"> <li class="menupopT">
										<input type="text" autocomplete="off" class="search_img_btn" name="txtlv299_search" id="txtlv299_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv299','ki_lv0003','lv002')" onFocus="LoadPopup(this,'txtlv299','ki_lv0003','lv002')" tabindex="200" >
										<div id="lv_popup99" lang="lv_popup99"> </div>						  
										</li>
									</ul></td></tr></table>
							    </td>
								
							</tr>
							<tr>
							  <td><?php echo $vLangArr[21];?></td>
								<td><input name="txtlv007" type="hidden" id="txtlv007"  value="<?php echo $lvhr_lv0020->lv007;?>" tabindex="11" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" />	
								<div class="file_upload"><input type="file" name="userfile" id="userfile" size="23" readonly="true" tabindex="11"/></div>		</td>
							  
							</tr>
							
                            <tr>
                              <td  height="20" colspan="4"><div class="lv_gachchia"></div></td>
                            </tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[24];?></td>
								<td  height="20">
								<input  name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvhr_lv0020->lv010;?>" tabindex="14" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								</td>
								<td  height="20"><?php echo $vLangArr[25];?></td>
								<td  height="20"><input name="txtlv011" type="text" id="txtlv011" value="<?php echo $lvhr_lv0020->FormatView($lvhr_lv0020->lv011,2);?>" tabindex="15" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
								<span class="td"> <img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv011);return false;" /></span></td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[26];?></td>
								<td  height="20"><input name="txtlv012" type="text" id="txtlv012" value="<?php echo $lvhr_lv0020->lv012;?>" tabindex="16" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
								<td  height="20"><?php echo $vLangArr[27];?></td>
								<td  height="20">
									<input name="txtlv013" type="text" id="txtlv013"  value="<?php echo $lvhr_lv0020->lv013;?>" tabindex="17" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[28].' (1)';?></td>
								<td  height="20"><input name="txtlv014" type="text" id="txtlv014"  value="<?php echo $lvhr_lv0020->lv014;?>" tabindex="18" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td  height="20"><?php echo $vLangArr[82].' (1)';?></td>
								<td  height="20"><input name="txtlv106"  id="txtlv106" value="<?php echo $lvhr_lv0020->lv106;?>" tabindex="18" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
							<tr>
								<td  height="20"><?php echo $vLangArr[28].' (2)';?></td>
								<td  height="20"><input name="txtlv114" type="text" id="txtlv114"  value="<?php echo $lvhr_lv0020->lv114;?>" tabindex="18" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td  height="20"><?php echo $vLangArr[82].' (2)';?></td>
								<td  height="20"><input name="txtlv116"  id="txtlv116" value="<?php echo $lvhr_lv0020->lv116;?>" tabindex="18" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>								
							<tr>
								<td  height="20"><?php echo $vLangArr[29];?></td>
								<td  height="20"><input  name="txtlv015" type="text" id="txtlv015" value="<?php echo $lvhr_lv0020->FormatView($lvhr_lv0020->lv015,2);?>" tabindex="19" maxlength="20" style="width:80%" onKeyPress="return CheckKey(event,7)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv015);return false;"/>
						      		<span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv015);return false;" /> </span>
														 	
															</td>
								<td  height="20"><?php echo $vLangArr[84];?></td>
								<td  height="20"><input type="checkbox" name="txtlv069" type="text" id="txtlv069" value="1" <?php echo ($lvhr_lv0020->lv069==1)?'checked="checked"':'';?>/></td>
								
							</tr>				
							<tr>
								<td  height="20"><?php echo $vLangArr[30];?></td>
								<td  height="20"><input  name="txtlv016" type="text" id="txtlv016" value="<?php echo $lvhr_lv0020->lv016;?>" tabindex="20" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td  height="20"><?php echo $vLangArr[62];?></td>
								<td  height="20"><input type="text" name="txtlv045" type="text" id="txtlv045" value="<?php echo $lvhr_lv0020->lv045;?>"  tabindex="21"  style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[32];?></td>
							  <td  height="20"><select name="txtlv018" id="txtlv018" tabindex="22">
							  	<option value="0" <?php echo ((int)$lvhr_lv0020->lv018==0)?'selected="selected"':''; ?> >Nữ</option>
								<option value="1" <?php echo ((int)$lvhr_lv0020->lv018==1)?'selected="selected"':''; ?>>Nam</option>
							    </select></td>
								<td height="20"><?php echo $vLangArr[33];?></td>
								<td height="20">
									<select name="txtlv019" id="txtlv019" tabindex="23">
							  	<option value="0" <?php echo ((int)$lvhr_lv0020->lv019==0)?'selected="selected"':''; ?> >Không</option>
								<option value="1" <?php echo ((int)$lvhr_lv0020->lv019==1)?'selected="selected"':''; ?>>Có</option>
							    </select>			</td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[34];?></td>
								<td  height="20"><input  name="txtlv020" type="text" id="txtlv020" value="<?php echo $lvhr_lv0020->lv020;?>" tabindex="24" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td  height="20"><?php echo $vLangArr[35];?></td>
								<td  height="20"><input  name="txtlv021" type="text" id="txtlv021" value="<?php echo $lvhr_lv0020->FormatView($lvhr_lv0020->lv021,2);?>" tabindex="25" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								<span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv021);return false;" /></span></td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[57];?></td>
								<td  height="20"><input  name="txtlv043" type="text" id="txtlv043" value="<?php echo $lvhr_lv0020->lv043;?>" tabindex="25" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td  height="20"><?php echo $vLangArr[36];?></td>
								<td  height="20"><table style="width:80%"><tr><td style="width:50%"><select  name="txtlv022" id="txtlv022" value="<?php echo $lvhr_lv0020->lv022;?>" tabindex="26"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
								  <?php echo $lvhr_lv0020->LV_LinkField('lv022',$lvhr_lv0020->lv022);?>
								  </select></td><td>
											  <ul id="pop-nav5" lang="pop-nav5" onMouseOver="ChangeName(this,5)" onkeyup="ChangeName(this,5)"> <li class="menupopT">
												<input type="text" autocomplete="off" class="search_img_btn" name="txtlv022_search" id="txtlv022_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv022','hr_lv0014','lv002')" onFocus="LoadPopup(this,'txtlv022','hr_lv0014','lv002')" tabindex="200" >
												<div id="lv_popup5" lang="lv_popup5"> </div>						  
												</li>
											</ul></td></tr></table>
								</td>
							</tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[31];?></td>
							  <td  height="20"><select name="txtlv017" id="txtlv017"  tabindex="27"  style="width:80%" onKeyPress="return CheckKey(event,7)"><?php echo $lvhr_lv0020->LV_LinkField('lv017',$lvhr_lv0020->lv017);?></select></td>
							  <td  height="20"><?php echo $vLangArr[37];?></td>
							  <td  height="20"><table style="width:80%"><tr><td style="width:50%"><select name="txtlv023"  id="txtlv023" value="<?php echo $lvhr_lv0020->lv023;?>" tabindex="27"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)">
							  <?php echo $lvhr_lv0020->LV_LinkField('lv023',$lvhr_lv0020->lv023);?>
							  </select></td>
							  <td>
								<ul id="pop-nav6" lang="pop-nav6" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
									<input type="text" autocomplete="off" class="search_img_btn" name="txtlv023_search" id="txtlv023_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv023','hr_lv0016','lv002')" onFocus="LoadPopup(this,'txtlv023','hr_lv0016','lv002')" tabindex="200" >
									<div id="lv_popup6" lang="lv_popup6"> </div>						  
									</li>
								</ul></td></tr></table></td>
							  
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[38];?></td>
								<td  height="20"><select name="txtlv024"  id="txtlv024" value="<?php echo $lvhr_lv0020->lv024;?>" tabindex="28" style="width:80%" onKeyPress="return CheckKey(event,7)">
											<?php echo $lvhr_lv0020->LV_LinkField('lv024',$lvhr_lv0020->lv024);?>
											</select></td>
											
								<td height="20"><?php echo $vLangArr[76];?></td>
								<td height="20">
									<input name="txtlv099" type="text" id="txtlv099" value="<?php echo $lvhr_lv0020->lv099;?>" tabindex="29" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[77];?></td>
								<td  height="20"><input name="txtlv102"  id="txtlv102" value="<?php echo $lvhr_lv0020->lv102;?>" tabindex="28" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
											
								<td height="20"><?php echo $vLangArr[85];?></td>
								<td height="20">
									<input name="txtlv101" type="text" id="txtlv101" value="<?php echo $lvhr_lv0020->lv101;?>" tabindex="29" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td  height="20" colspan="4"><div class="lv_gachchia"></div></td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[40];?></td>
								<td  height="20"><input name="txtlv26" type="text" id="txtlv26" value="<?php echo $lvhr_lv0020->lv026;?>" tabindex="30" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
								<td  height="20"><?php echo $vLangArr[41];?></td>
								<td  height="20"><select  name="txtlv027" type="text" id="txtlv027" value="<?php echo $lvhr_lv0020->lv027;?>" tabindex="31"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
									<?php echo $lvhr_lv0020->LV_LinkField('lv027',$lvhr_lv0020->lv027);?>
									</select></td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[42];?></td>
								<td  height="20"><table style="width:80%"><tr><td style="width:50%"><select  name="txtlv028"  id="txtlv028" value="<?php echo $lvhr_lv0020->lv028;?>" tabindex="32"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
									  <?php echo $lvhr_lv0020->LV_LinkField('lv028',$lvhr_lv0020->lv028);?></select></td><td>
												  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> 			
											   <li class="menupopT">
											  <input type="text" autocomplete="off" class="search_img_btn" name="txtlv028_search" id="txtlv028_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv028','hr_lv0005','lv002')" onFocus="LoadPopup(this,'txtlv028','hr_lv0005','lv002')" tabindex="200" >
											  <div id="lv_popup" lang="lv_popup2"> </div>

										</ul></td></tr></table></td>
							  <td  height="20"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><input name="txtlv008" type="text" id="txtlv008" value="<?php echo $lvhr_lv0020->lv008;?>" tabindex="33" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							</tr>							  
							<tr>  
							  <td  height="20"><?php echo $vLangArr[44];?></td>
							  <td  height="20"><input name="txtlv030" type="text" id="txtlv030" value="<?php echo $lvhr_lv0020->FormatView($lvhr_lv0020->lv030,2);?>" tabindex="34" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
							    <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv030);return false;" /></span></td>
							  <td  height="20"><?php echo $vLangArr[58];?></td>
							  <td  height="20"><input name="txtlv044" type="text" id="txtlv044" value="<?php echo $lvhr_lv0020->FormatView($lvhr_lv0020->lv044,2);?>" tabindex="34" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
							    <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv044);return false;" /></span></td>
							</tr>		
							<tr>
                                  <td  height="20" colspan="4"><div class="lv_gachchia"></div></td>
                            </tr>
							<tr>
								<td height="20"><?php echo $vLangArr[45];?></td>
								<td height="20"><table style="width:80%"><tr><td style="width:50%"><select name="txtlv031" id="txtlv031"  tabindex="35"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
										<?php echo $lvhr_lv0020->LV_LinkField('lv031',$lvhr_lv0020->lv031);?></select></td><td>
										<ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
											<input type="text" autocomplete="off" class="search_img_btn" name="txtlv031_search" id="txtlv031_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv031','hr_lv0014','lv002')" onFocus="LoadPopup(this,'txtlv031','hr_lv0014','lv002')" tabindex="200" >
											<div id="lv_popup3" lang="lv_popup3"> </div>						  
											</li>
										</ul></td></tr></table>							
								</td>
								<td  height="20"><?php echo $vLangArr[46];?></td>
								<td  height="20"><table style="width:80%"><tr><td style="width:50%"><select name="txtlv032" type="text" id="txtlv032"  value="<?php echo $lvhr_lv0020->lv032;?>" tabindex="36" maxlength="6" style="width:100%" onkeypress="return CheckKeys(event,7,this)" />
									  <?php echo $lvhr_lv0020->LV_LinkField('lv032',$lvhr_lv0020->lv032);?>
									  </select></td><td>
									  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
										<input type="text" autocomplete="off" class="search_img_btn" name="txtlv032_search" id="txtlv032_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv032','hr_lv0023','lv002')" onFocus="LoadPopup(this,'txtlv032','hr_lv0023','lv002')" tabindex="200" >
										<div id="lv_popup4" lang="lv_popup4"> </div>						  
									</li>
									</ul></td></tr></table>	</td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[48];?></td>
								<td  height="20"><input  name="txtlv034" type="text" id="txtlv034" value="<?php echo $lvhr_lv0020->lv034;?>" tabindex="38" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td  height="20"><?php echo $vLangArr[47];?></td>
								<td  height="20"><input  name="txtlv033" type="text" id="txtlv033" value="<?php echo $lvhr_lv0020->lv033;?>" tabindex="37" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								</tr>							  
							<tr>
								<td  height="20"><?php echo $vLangArr[49];?></td>
								<td  height="20"><input name="txtlv035" type="text" id="txtlv035" value="<?php echo $lvhr_lv0020->lv035;?>" tabindex="39" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
								<td  height="20"><?php echo $vLangArr[50];?></td>
								<td  height="20"><input name="txtlv036" type="text" id="txtlv036" value="<?php echo $lvhr_lv0020->lv036;?>" tabindex="40" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							</tr>		
							<tr>
								<td height="20"><?php echo $vLangArr[51];?></td>
								<td height="20">
									<input name="txtlv037" type="text" id="txtlv037"  value="<?php echo $lvhr_lv0020->lv037;?>" tabindex="41" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
								<td  height="20"><?php echo $vLangArr[52];?></td>
								<td  height="20"><input name="txtlv038" type="text" id="txtlv038"  value="<?php echo $lvhr_lv0020->lv038;?>" tabindex="42" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
								<td height="20"><?php echo $vLangArr[53];?></td>
								<td height="20"><input  name="txtlv039" type="text" id="txtlv039" value="<?php echo $lvhr_lv0020->lv039;?>" tabindex="43" maxlength="20" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td height="20"><?php echo $vLangArr[54];?></td>
								<td height="20">
									<input name="txtlv040" type="text" id="txtlv040"  value="<?php echo $lvhr_lv0020->lv040;?>" tabindex="44" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[55];?></td>
							  <td  height="20"><input name="txtlv041" type="text" id="txtlv041"  value="<?php echo $lvhr_lv0020->lv041;?>" tabindex="45" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td  height="20"><?php echo $vLangArr[56];?></td>
							  <td  height="20"><table style="width:80%"><tr><td style="width:50%"><select name="txtlv042" type="text" id="txtlv042"  value="<?php echo $lvhr_lv0020->lv042;?>" tabindex="36" maxlength="6" style="width:100%" onkeypress="return CheckKeys(event,7,this)" />
							  <option value=""></option>
									  <?php echo $lvhr_lv0020->LV_LinkField('lv042',$lvhr_lv0020->lv042);?>
									  </select></td><td>
									  <ul id="pop-nav42" lang="pop-nav42" onMouseOver="ChangeName(this,42)" onkeyup="ChangeName(this,42)"> <li class="menupopT">
										<input type="text" autocomplete="off" class="search_img_btn" name="txtlv042_search" id="txtlv042_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv042','hr_lv0020','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv042','hr_lv0020','concat(lv001,@! @!,lv002)')" tabindex="200" >
										<div id="lv_popup42" lang="lv_popup42"> </div>						  
									</li>
									</ul></td></tr></table></td>
							</tr>
							<tr>
                                  <td  height="20" colspan="4"><div class="lv_gachchia"></div></td>
                            </tr>
							<tr>
								<td height="20"><?php echo $vLangArr[63];?></td>
								<td height="20"><input  name="txtlv060" type="text" id="txtlv060" value="<?php echo $lvhr_lv0020->lv060;?>" tabindex="60" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td height="20"><?php echo $vLangArr[64];?></td>
								<td height="20">
									<input name="txtlv061" type="text" id="txtlv061"  value="<?php echo $lvhr_lv0020->lv061;?>" tabindex="60" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td height="20"><?php echo '';?></td>
								<td height="20">&nbsp;</td>
								<td height="20"><?php echo $vLangArr[70];?></td>
								<td height="20">
									<input name="txtlv067" type="text" id="txtlv067"  value="<?php echo $lvhr_lv0020->lv067;?>" tabindex="60" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td height="20"><?php echo $vLangArr[65];?></td>
								<td height="20">
								<table style="width:80%"><tr><td style="width:50%"><select name="txtlv062" type="text" id="txtlv062"  value="<?php echo $lvhr_lv0020->lv042;?>" tabindex="36" maxlength="6" style="width:100%" onkeypress="return CheckKeys(event,7,this)" />
									<option value=""></option>
											<?php echo $lvhr_lv0020->LV_LinkField('lv062',$lvhr_lv0020->lv062);?>
											</select></td><td>
											<ul id="pop-nav62" lang="pop-nav62" onMouseOver="ChangeName(this,62)" onkeyup="ChangeName(this,62)"> <li class="menupopT">
												<input type="text" autocomplete="off" class="search_img_btn" name="txtlv062_search" id="txtlv062_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv062','cr_lv0008','concat(lv002,@! @!,lv001)')" onFocus="LoadPopup(this,'txtlv062','cr_lv0008','concat(lv002,@! @!,lv001)')" tabindex="200" >
												<div id="lv_popup62" lang="lv_popup62"> </div>						  
											</li>
											</ul></td></tr></table>
							</td>
								<td height="20"><?php echo $vLangArr[66];?></td>
								<td height="20">
									<input name="txtlv063" type="text" id="txtlv063"  value="<?php echo $lvhr_lv0020->lv063;?>" tabindex="60" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td height="20"><?php echo $vLangArr[67];?></td>
								<td height="20">
									<select name="txtlv064" id="txtlv064"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
										<option value=""><?php echo 'Cả hai';?></option>
										<option value="SOF" <?php echo ( $lvhr_lv0020->lv064=='SOF')?'selected="selected"':'';?> ><?php echo 'CTY CP MINH PHƯƠNG';?></option>
										<option value="TNHHMP" <?php echo ( $lvhr_lv0020->lv064=='TNHHMP')?'selected="selected"':'';?>><?php echo 'CTY TNHH MINH PHUONG';?></option>
                             	 	</select>
								</td>
								<td height="20"><?php echo $vLangArr[68];?></td>
								<td height="20">
									<input name="txtlv065" type="text" id="txtlv065"  value="<?php echo $lvhr_lv0020->lv065;?>" tabindex="60" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td height="20"><?php echo $vLangArr[69];?></td>
								<td height="20"><input  name="txtlv066" type="text" id="txtlv066" value="<?php echo $lvhr_lv0020->lv066;?>" tabindex="60" maxlength="30" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td height="20"><?php echo $vLangArr[81];?></td>
								<td height="20"><input  name="txtlv049" type="text" id="txtlv049" value="<?php echo $lvhr_lv0020->lv049;?>" tabindex="60" maxlength="30" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
							  <td  height="20" colspan="3"></td>
							</tr>
							<tr>
							  <td  height="20" colspan="3"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
							<TBODY>
							<TR vAlign=center align=middle>
								  <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="47"><img src="../images/controlright/save_f2.png" 
								alt="Save" title="<?php echo $vLangArr[1];?>" 
								name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
							  <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="48"><img src="../images/controlright/move_f2.png" 
								alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
								border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
							  <TD nowrap="nowrap"><a class=lvtoolbar 
								href="javascript:Refresh();" tabindex="49"><img title="<?php echo $vLangArr[5];?>" 
								alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
								name=remove> <?php echo $vLangArr[6];?></a></TD>
								</TR></TBODY></TABLE> </td>
											  </tr>
										  </table>
										</form>	
										 </div>
<!---End Enter New Line-->  
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td>
			</tr>
		</table>
	</h3>
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
function changestate(value)
	{
		var o1=document.getElementById('fileload');
		var o2=document.getElementById('enterline');
		if(value==2)
		{
			o1.style.display="block";
			o2.style.display="none";
			
		}
		else
		{
			o1.style.display="none";
			o2.style.display="block";
		}
	}
	changestate(<?php echo (int)$loadenter+1;?>)
	var o=document.frmadd;
		o.txtlv001.focus();
</script>

<script language="javascript" src="../../javascripts/menupopup.js"></script>
	<?php
	if($vFlag==1)
	{
	?>
	<script language="javascript">
	<!--
		Cancel();
	//-->
	</script>
	<?php
	}
	?>
<?php
} else {
	include("../permit.php");
}
?>
</body>
</html>