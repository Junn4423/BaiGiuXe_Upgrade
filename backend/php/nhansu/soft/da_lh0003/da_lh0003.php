<?php
if( $_GET['ID']!="") 
{
	if($_GET['ID1']!='isedit') $vDir='../';
}
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/da_lh0003.php");
require_once("$vDir../clsall/da_lh0002.php");
/////////////init object//////////////
$moda_lh0003=new da_lh0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Da0003');
$moac_lv0002=new da_lh0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Da0002');
$moda_lh0003->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($moda_lh0003->GetEdit()==1)
{
	if(isset($_GET['ajaxbangtext']))
	{
		$vdonhangid=$_GET['donhangid'];
		$vText=$_GET['textup'];
		$vText=str_replace('$$$','+',$vText);
		$voption=$_GET['optrun'];
		if($vdonhangid!='' && $vdonhangid!=NULL)
		{
			$vUserID=$moda_lh0003->LV_UserID;
			$vlvField='lv'.Fillnum($voption,3);
			switch($voption)
			{
				case 3:
				case 4:
				case 6:
				case 11:
				case 18:
				case 12:
				case 13:
				case 14:
				case 15:
				case 16:
				case 17:
				case 7:			
					$vsql="update da_lh0003 set $vlvField='$vText' where lv001='$vdonhangid'";
					break;
				case 19:
					if($plang=='') $plang='VN';
					$vDate=recoverdate(substr($vText,0,10),$plang);
					$vsql="update da_lh0003 set $vlvField='$vDate' where lv001='$vdonhangid' ";
					break;
			}
			$vresult=db_query($vsql);
		}
		exit;
	}
}
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","CR0278.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$moda_lh0003->ArrPush[0]=$vLangArr[17];
$moda_lh0003->ArrPush[1]=$vLangArr[18];
$moda_lh0003->ArrPush[2]=$vLangArr[20];
$moda_lh0003->ArrPush[3]=$vLangArr[21];
$moda_lh0003->ArrPush[4]="Giai đoạn";
$moda_lh0003->ArrPush[5]="Mã công việc";
$moda_lh0003->ArrPush[6]="Tên công việc (Tiếng Việt)";
$moda_lh0003->ArrPush[7]="Tên công việc (English)";
$moda_lh0003->ArrPush[8]="Mô tả công việc (Tiếng Việt)";
$moda_lh0003->ArrPush[9]="Mô tả công việc (English)";
$moda_lh0003->ArrPush[10]=$vLangArr[28];
$moda_lh0003->ArrPush[11]=$vLangArr[29];

$moda_lh0003->ArrPush[12]="Trạng thái";
$moda_lh0003->ArrPush[13]="Tên công việc";
$moda_lh0003->ArrPush[14]="Mã công việc";
$moda_lh0003->ArrPush[15]=$vLangArr[40];
$moda_lh0003->ArrPush[16]=$vLangArr[41];
$moda_lh0003->ArrPush[17]="Giai đoạn";
$moda_lh0003->ArrPush[18]=$vLangArr[43];
$moda_lh0003->ArrPush[19]="Mã dự án";
$moda_lh0003->ArrPush[20]="Ngày hoàn thành";
$moda_lh0003->ArrPush[21]="Chức năng";


$moda_lh0003->ArrFunc[0]='//Function';
$moda_lh0003->ArrFunc[1]=$vLangArr[2];
$moda_lh0003->ArrFunc[2]=$vLangArr[4];
$moda_lh0003->ArrFunc[3]=$vLangArr[6];
$moda_lh0003->ArrFunc[4]=$vLangArr[7];
$moda_lh0003->ArrFunc[5]='';
$moda_lh0003->ArrFunc[6]='';
$moda_lh0003->ArrFunc[7]='';
$moda_lh0003->ArrFunc[8]=$vLangArr[10];
$moda_lh0003->ArrFunc[9]=$vLangArr[12];
$moda_lh0003->ArrFunc[10]=$vLangArr[0];
$moda_lh0003->ArrFunc[11]=$vLangArr[32];
$moda_lh0003->ArrFunc[12]=$vLangArr[33];
$moda_lh0003->ArrFunc[13]=$vLangArr[34];
$moda_lh0003->ArrFunc[14]=$vLangArr[35];
$moda_lh0003->ArrFunc[15]=$vLangArr[36];
////Other
$moda_lh0003->ArrOther[1]=$vLangArr[30];
$moda_lh0003->ArrOther[2]=$vLangArr[31];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vOrderList=$_POST['txtOrderList'];
$vStrMessage=""; 
if( $_GET['ID']!="" && !isset($_POST["txtFlag"]))
{	echo "<div style='color:blue;'>[DEBUG] ID nhận được từ URL: <b>" . htmlspecialchars($_GET['ID']) . "</b></div>";

	$moac_lv0002->LV_LoadID( $_GET['ID']);
	$moda_lh0003->Values['lv018']= $_GET['ID'] ?? '';
	$moda_lh0003->Values['lv013']=$moac_lv0002->lv002;
}
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moda_lh0003->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"da_lh0003",$lvMessage);
}
elseif($flagID==3)///Admin Mode
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moda_lh0003->LV_Delete($strar);
}
elseif($flagID==6)
{
	$moda_lh0003->lv001=$_POST['qxtlv001'];
	$moda_lh0003->lv002=$_POST['qxtlv002'];
	if( $_GET['ID']=="")
		$moda_lh0003->lv018=$_POST['qxtlv018'];
	else
		$moda_lh0003->lv018= $_GET['ID'] ?? '';
	$moda_lh0003->lv003=$_POST['qxtlv003'];
	$moda_lh0003->lv004=$_POST['qxtlv004'];
	$moda_lh0003->lv005=$_POST['qxtlv005'];
	$moda_lh0003->lv006=$_POST['qxtlv006'];
	$moda_lh0003->lv007=$_POST['qxtlv007'];
	$moda_lh0003->lv008=$_POST['qxtlv008'];
	
	$moda_lh0003->lv011=$_POST['qxtlv011'];
	$moda_lh0003->lv012=$_POST['qxtlv012'];
	$moda_lh0003->lv013=$_POST['qxtlv013'];
	$moda_lh0003->lv014=$_POST['qxtlv014'];
	$moda_lh0003->lv015=$_POST['qxtlv015'];
	$moda_lh0003->lv016=$_POST['qxtlv016'];
	$moda_lh0003->lv017=$_POST['qxtlv017'];
	$moda_lh0003->lv018=$_POST['qxtlv018'];
	$moda_lh0003->lv019=$_POST['qxtlv019'];
	$vresult=$moda_lh0003->LV_Insert();	
	if(!$vresult)
	{
		$moda_lh0003->Values['lv001']=$_POST['qxtlv001'];
		$moda_lh0003->Values['lv002']=$_POST['qxtlv002'];
		if( $_GET['ID']=="")
			$moda_lh0003->Values['lv018']=$_POST['qxtlv018'];
		else
			$moda_lh0003->Values['lv018']= $_GET['ID'] ?? '';
		$moda_lh0003->Values['lv003']=$_POST['qxtlv003'];
		$moda_lh0003->Values['lv004']=$_POST['qxtlv004'];
		$moda_lh0003->Values['lv005']=$_POST['qxtlv005'];
		$moda_lh0003->Values['lv006']=$_POST['qxtlv006'];
		$moda_lh0003->Values['lv007']=$_POST['qxtlv007'];
		$moda_lh0003->Values['lv008']=$_POST['qxtlv008'];

		$moda_lh0003->Values['lv011']=$_POST['qxtlv011'];
		$moda_lh0003->Values['lv012']=$_POST['qxtlv012'];
		$moda_lh0003->Values['lv013']=$_POST['qxtlv013'];
		$moda_lh0003->Values['lv014']=$_POST['qxtlv014'];
		$moda_lh0003->Values['lv015']=$_POST['qxtlv015'];
		$moda_lh0003->Values['lv016']=$_POST['qxtlv016'];
		$moda_lh0003->Values['lv017']=$_POST['qxtlv017'];
		$moda_lh0003->Values['lv019']=$_POST['qxtlv019'];
		echo sof_error();	
	}
	$moda_lh0003->lv001='';
	$moda_lh0003->lv002='';
	$moda_lh0003->lv003='';
	$moda_lh0003->lv004='';
	$moda_lh0003->lv005='';
	$moda_lh0003->lv006='';
	$moda_lh0003->lv007='';
	$moda_lh0003->lv008='';

	$moda_lh0003->lv011='';
	$moda_lh0003->lv012='';
	$moda_lh0003->lv013='';
	$moda_lh0003->lv014='';
	$moda_lh0003->lv015='';
	$moda_lh0003->lv016='';
	$moda_lh0003->lv017='';
}
else if($flagID==12)
{
	$data = array();
	function add_person( $ArrField,$ArrList)
	{
		global $data;
		$i=1;
		if(count($ArrField)>0)
		{
			foreach($ArrField as $vField)
			{
				$vRowData[$vField]=$ArrList[$i];
				$i++;
			}
			$data []= $vRowData;
		}
	}
	$vBOQua=0;
	 $lvNow=GetServerDate()." ".GetServerTime();
	 if ( $_FILES['file']['tmp_name'] )
  	{
	  $dom=new DOMDocument();
	  	$dom->load( $_FILES['file']['tmp_name'] );
	  $rows = $dom->getElementsByTagName( 'Row' );
	  $first_row = true;
	  $DongDau=true;
	  foreach ($rows as $row)
	  {
	  	$ArrList=Array();
		  if ( !$first_row )
		  {
			$vBOQua++;
			if($vBOQua>0)
			{
				if($DongDau)
				{
					$DongDau=false;	
				}
				else
				{
					$first = "";
					$middle = "";
					$last = "";
					$email = "";
				
					$index = 1;
					$cells = $row->getElementsByTagName( 'Cell' );
					if($cells!=null)
					{
						foreach( $cells as $cell )
						{ 
						//$ind = $cell->getAttribute( 'Index' );
						//if ( $ind != null )
						{
							
							$ArrList[$index]=$cell->nodeValue;
							$index += 1;
						} 
						}	
						add_person($ArrField,$ArrList);
					}
					
				}
			}
		  	
	 	 }
	 	 else
	 	 {
			
				$index=1;
				$cells = $row->getElementsByTagName( 'Cell' );
				$ArrField=Array();
				if($cells!=null)
				{
					foreach( $cells as $cell )
					{ 
						//echo $ind = $cell->getAttribute( 'Index' );
						//if ( $ind != null )
						if($cell->nodeValue!=NULL && $cell->nodeValue!='' && $cell->nodeValue!='0')
						{ 
							$ArrField[$index]='lv'.Fillnum($cell->nodeValue,3);
							if('lv'.Fillnum($cell->nodeValue,3)=='lv064' && $vArrTang[0][0]==0)
							{
								$vArrTang[0][0]=$index;
							}
							if('lv'.Fillnum($cell->nodeValue,3)=='lv065'  && $vArrKhuVuc[0][0]==0)
							{
								$vArrKhuVuc[0][0]=$index;
							}
							$index += 1;
						}
					}
				} 	
			}
	 	 
		  $first_row = false;
	  }
  	}
	global $data;
	$moda_lh0003->lang='VN';
	foreach( $data as $row )
	{
		$moda_lh0003->lv018= $_GET['ID'] ?? '';
		$vresult=$moda_lh0003->LV_InsertFieldFull($ArrField,$row);
	}
	$i=0;
	
		if($vresult==true) {
			$vStrMessage=$vLangArr[9];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}
}
if($flagID>0)
{
	$moda_lh0003->lv001=$_POST['txtlv001'];
	$moda_lh0003->lv002=$_POST['txtlv002'];
	if( $_GET['ID']=="")
	$moda_lh0003->lv018=$_POST['txtlv018'];
	else
	$moda_lh0003->lv018= $_GET['ID'] ?? '';
	$moda_lh0003->lv003=$_POST['txtlv003'];
	$moda_lh0003->lv004=$_POST['txtlv004'];
	$moda_lh0003->lv005=$_POST['txtlv005'];
	$moda_lh0003->lv006=$_POST['txtlv006'];
	$moda_lh0003->lv007=$_POST['txtlv007'];
	$moda_lh0003->lv011=$_POST['txtlv011'];
	$moda_lh0003->lv012=$_POST['txtlv012'];
	$moda_lh0003->lv013=$_POST['txtlv013'];
	$moda_lh0003->lv014=$_POST['txtlv014'];
	$moda_lh0003->lv015=$_POST['txtlv015'];
	$moda_lh0003->lv016=$_POST['txtlv016'];
	$moda_lh0003->lv017=$_POST['txtlv017'];
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$moda_lh0003->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'da_lh0003');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moda_lh0003->ListView;
$curPage = $moda_lh0003->CurPage;
$maxRows =$moda_lh0003->MaxRows;
$vOrderList=$moda_lh0003->ListOrder;
$vSortNum=$moda_lh0003->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$moda_lh0003->SaveOperation($_SESSION['ERPSOFV2RUserID'],'da_lh0003',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if( $_GET['ID']=="")
$moda_lh0003->lv002=$_POST['txtlv002'];
else
$moda_lh0003->lv018= $_GET['ID'] ?? '';
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moda_lh0003->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = (($curPage-1)<0)?0:($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>MINH PHUONG</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/menu.css" type="text/css">	
<link rel="stylesheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
<script language="javascript" src="<?php echo $vDir;?>../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/pubscript.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/engines.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/menupopup.js"></script>
</head>
<script language="JavaScript" type="text/javascript">
<!--
function FunctRunning1(vID)
{
	window.open('<?php echo $vDir;?>'+'da_lh0003/?lang=<?php echo $plang;?>&childfunc=download&ID='+vID,'download','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');

}
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>','filter');
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ID1=<?php echo $_GET['ID1'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<iframe id='lvframefrm' height=500 marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>da_lh0003?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ID1=<?php echo $_GET['ID1'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>' class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function Save()
{
	var o=document.frmchoose;
	o.txtFlag.value=6;
	if(o.qxtlv013.value==""){
		alert("Mô tả không trống!");
		o.qxtlv004.focus();
	}	
	else
	{
		o.submit();
	}
}
	setTimeout(focusmain,1000);
function focusmain()
{
	document.getElementById('qxtlv001').focus();
}
function XuLyUpLoad()
{
	var o=document.frmchoose;
	o.target="_self";
	o.txtFlag.value=12;
	o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ID1=<?php echo $_GET['ID1'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	o.submit();
}
function ChangeInfor()
{
	//if(LV_CheckSearch())
	{
		var o1=document.frmchoose;
		o1.submit();
	}
}	
//-->
</script>
<?php
if($moda_lh0003->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft">
						<form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ID1=<?php echo $_GET['ID1'];?>&ID=<?php echo  $_GET['ID']?>&<?php  echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" method="post" name="frmchoose" id="frmchoose"  enctype="multipart/form-data">
						<table style="background:#F2F2F2;padding:5px;color:#4D4D4F!important;" border="0" cellpadding="3" cellspacing="3">
									<tr>	
										<td><input  style="width:80px;text-align:center" type="button" value="Tìm kiếm" onclick="ChangeInfor()"/></td>
										<td align="center"><?php echo 'Giai đoạn';?></td>
										<td align="center">
											<input type="textbox" name="txtlv004" id="txtlv004" value="<?php echo $moda_lh0003->lv004;?>" style="min-width:120px;width:100%"  autocomplete="off"  onKeyPress="return CheckKey(event,7)"/>
										</td>
										<td align="center"><?php echo 'Mã công việc';?></td>
										<td align="center"><input type="textbox" name="txtlv005" id="txtlv005" value="<?php echo $moda_lh0003->lv005;?>" style="min-width:120px;width:100%"  autocomplete="off"  onKeyPress="return CheckKey(event,7)"/></td>
										<td align="center"><?php echo 'Tên công việc';?></td>
										<td align="center"><input type="textbox" name="txtlv006" id="txtlv006" value="<?php echo $moda_lh0003->lv006;?>" style="min-width:120px;width:100%"  autocomplete="off"  onKeyPress="return CheckKey(event,7)"/></td>
									</tr>
						</table>
					  	<input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>						
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $moda_lh0003->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002"  value="<?php echo $moda_lh0003->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $moda_lh0003->lv003;?>"/>					
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $moda_lh0003->lv007;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $moda_lh0003->lv011;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $moda_lh0003->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $moda_lh0003->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $moda_lh0003->lv016;?>"/>
					    <?php echo $moda_lh0003->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
				  </form>

				  
</div></div>
</body>
				
<?php
} else {
	include("../da_lh0003/permit.php");
}
?>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
function UpdateText(o,donhangid,option)
{
		$xmlhttp555=null;		
		xmlhttp555=GetXmlHttpObject();
		if (xmlhttp555==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		}
		var url=document.location;
		var value=o.value
		url=url+"&ajaxbangtext=ajaxcheck"+"&donhangid="+donhangid+"&textup="+value+"&optrun="+option;
		url=url.replace("#","");
		xmlhttp555.onreadystatechange=stateactivebangtext;
		xmlhttp555.open("GET",url,true);
		xmlhttp555.send(null);	
}	
function UpdateTextCheck(o,donhangid,option)
{
		$xmlhttp555=null;		
		xmlhttp555=GetXmlHttpObject();
		if (xmlhttp555==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		}
		var url=document.location;
		var value=(o.checked)?1:0;
		url=url+"&ajaxbangtext=ajaxcheck"+"&donhangid="+donhangid+"&textup="+value+"&optrun="+option;
		url=url.replace("#","");
		xmlhttp555.onreadystatechange=stateactivebangtext;
		xmlhttp555.open("GET",url,true);
		xmlhttp555.send(null);	
}	
function stateactivebangtext()
{
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
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $moda_lh0003->ArrPush[0];?>';	
</script>
</html>