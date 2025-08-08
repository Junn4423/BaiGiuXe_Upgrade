<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/da_lh0002.php");
require_once("../clsall/cr_lv0309.php");
/////////////init object//////////////
$moda_lh0002=new da_lh0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Da002');
$mocr_lv0309=new cr_lv0309($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Da002');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","CR0010.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$moda_lh0002->ArrPush[0]=$vLangArr[17];
$moda_lh0002->ArrPush[1]=$vLangArr[18];
$moda_lh0002->ArrPush[2]=$vLangArr[20];
$moda_lh0002->ArrPush[3]=$vLangArr[21];
$moda_lh0002->ArrPush[4]=$vLangArr[22];
$moda_lh0002->ArrPush[5]=$vLangArr[23];
$moda_lh0002->ArrPush[6]=$vLangArr[24];
$moda_lh0002->ArrPush[7]=$vLangArr[25];
$moda_lh0002->ArrPush[8]='Chức năng';

$moda_lh0002->ArrFunc[0]='//Function';
$moda_lh0002->ArrFunc[1]=$vLangArr[2];
$moda_lh0002->ArrFunc[2]=$vLangArr[4];
$moda_lh0002->ArrFunc[3]=$vLangArr[6];
$moda_lh0002->ArrFunc[4]=$vLangArr[7];
$moda_lh0002->ArrFunc[5]='';
$moda_lh0002->ArrFunc[6]='';
$moda_lh0002->ArrFunc[7]='';
$moda_lh0002->ArrFunc[8]=$vLangArr[10];
$moda_lh0002->ArrFunc[9]=$vLangArr[12];
$moda_lh0002->ArrFunc[10]=$vLangArr[0];
$moda_lh0002->ArrFunc[11]=$vLangArr[27];
$moda_lh0002->ArrFunc[12]=$vLangArr[28];
$moda_lh0002->ArrFunc[13]=$vLangArr[29];
$moda_lh0002->ArrFunc[14]=$vLangArr[30];
$moda_lh0002->ArrFunc[15]=$vLangArr[31];
////Other
$moda_lh0002->ArrOther[1]=$vLangArr[25];
$moda_lh0002->ArrOther[2]=$vLangArr[26];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moda_lh0002->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"da_lh0002",$lvMessage);
}
elseif($flagID==2)
{
	$moda_lh0002->lv001=$_POST['txtlv001'];
	$moda_lh0002->lv002=$_POST['txtlv002'];
	$moda_lh0002->lv003=$_POST['txtlv003'];
}
elseif($flagID==6)
{
	$moda_lh0002->lv001=$_POST['qxtlv001'];
	$moda_lh0002->lv002=$_POST['qxtlv002'];
	$moda_lh0002->lv003=$_POST['qxtlv003'];
	$moda_lh0002->lv004=$_POST['qxtlv004'];
	$moda_lh0002->lv005=$_POST['qxtlv005'];
	$vresult=$moda_lh0002->LV_Insert();	
	if(!$vresult)
	{
		$moda_lh0002->Values['lv001']=$_POST['qxtlv001'];
		$moda_lh0002->Values['lv002']=$_POST['qxtlv002'];
		$moda_lh0002->Values['lv003']=$_POST['qxtlv003'];
		$moda_lh0002->Values['lv004']=$_POST['qxtlv004'];
		$moda_lh0002->Values['lv005']=$_POST['qxtlv005'];
		echo sof_error();	
	}
	$moda_lh0002->lv001='';
	$moda_lh0002->lv002='';
}
elseif($flagID==10)
{
	$data = array();
	function add_person( $lv001,$lv002,$lv003, $lv004, $lv005,$lv806,$lv812,$lv817,$lv804)
	{
	global $data;
	
	$data []= array(
	'lv001' => $lv001,
	'lv002' => $lv002,
	'lv003' => $lv003,
	'lv004' => $lv004,
	'lv005' => $lv005,
	'lv806' => $lv806,
	'lv812' => $lv812,
	'lv817' => $lv817,
	'lv804' => $lv804
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
			  $lv001 = "";
			  $lv002 = "";
			  $lv003 = "";
			  $lv004 = "";
			  $lv005="";
			  $lv806="";
			  $lv812="";
			  
			  $index = 1;
			  $cells = $row->getElementsByTagName( 'Cell' );
			  foreach( $cells as $cell )
			  { 
			  $ind = $cell->getAttribute( 'Index' );
			  if ( $ind != null ) $index = $ind;
  			  if ( $index == 1 ) $lv001 = $cell->nodeValue;
			  if ( $index == 2 ) $lv002 = $cell->nodeValue;
			  if ( $index == 3 ) $lv003 = $cell->nodeValue;
			  if ( $index == 4 ) $lv004 = $cell->nodeValue;
			  if ( $index == 5 ) $lv005 = $cell->nodeValue;
			  if ( $index == 6 ) $lv806 = $cell->nodeValue;
			  if ( $index == 7 ) $lv812 = $cell->nodeValue;
			  if ( $index == 8 ) $lv817 = $cell->nodeValue;
			  if ( $index == 9 ) $lv804 = $cell->nodeValue;
			  $index += 1;
		  }
		  //echo "$lv001, $lv002, $lv003, $lv004, $lv005,$lv806,$lv812";
	  	add_person( $lv001, $lv002, $lv003, $lv004, $lv005,$lv806,$lv812,$lv817,$lv804);
	  }
	  $first_row = false;
	  }
  	}
	  global $data;
	foreach( $data as $row )
	{
		if(trim($row['lv001'])!="" && $row['lv001']!=NULL)
		{
		$moda_lh0002->LV_LoadID(trim($row['lv001']));
		if($moda_lh0002->lv001==NULL)
		{
		$moda_lh0002->lv001=trim($row['lv001']);
		$moda_lh0002->lv002=$row['lv002'];
		$moda_lh0002->lv003=$row['lv003'];
		$moda_lh0002->lv004=$row['lv004'];
		$moda_lh0002->lv005=$row['lv005'];
		
		$vresult=$moda_lh0002->LV_Insert();
		if($vresult)
		{
			$mocr_lv0309->lv018=$row['lv001'];
			$mocr_lv0309->lv013=$row['lv002'];
			$mocr_lv0309->lv004=$row['lv804'];
			$mocr_lv0309->lv006=$row['lv806'];
			$mocr_lv0309->lv012=$row['lv812'];
			$mocr_lv0309->lv017=$row['lv817'];
			$mocr_lv0309->LV_InsertAutoNo();
		}
		}
		else
		{
			$moda_lh0002->lv001=trim($row['lv001']);
			$moda_lh0002->lv001_=$moda_lh0002->lv001;
			$moda_lh0002->lv002=$row['lv002'];
			$moda_lh0002->lv003=$row['lv003'];
			$moda_lh0002->lv004=$row['lv004'];
			$moda_lh0002->lv005=$row['lv005'];
		
			$vresult=$moda_lh0002->LV_Update();
			if($vresult)
			{
				//$vID=$mocr_lv0309->LV_LoadAcc($moda_lh0002->lv001);
				
				$vID=$mocr_lv0309->LV_LoadAccAll($moda_lh0002->lv001,$row['lv817']);
				$mocr_lv0309->lv018=$row['lv001'];
				$mocr_lv0309->lv013=$row['lv002'];
				$mocr_lv0309->lv004=$row['lv804'];
				$mocr_lv0309->lv006=$row['lv806'];
				$mocr_lv0309->lv012=$row['lv812'];
				$mocr_lv0309->lv017=$row['lv817'];
				if($vID==null)
				{
					$mocr_lv0309->LV_InsertAutoNo();
				}
				else
				{
					$mocr_lv0309->lv001=$vID;
					$mocr_lv0309->LV_UpdateAcc();
					//$mocr_lv0309->LV_UpdateAccAll($moda_lh0002->lv001);
				}
			}
		}
		}
	}
		
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$moda_lh0002->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'da_lh0002');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moda_lh0002->ListView;
$curPage = $moda_lh0002->CurPage;
$maxRows =$moda_lh0002->MaxRows;
$vSortNum=$moda_lh0002->SortNum;
$vOrderList=$moda_lh0002->ListOrder;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$moda_lh0002->SaveOperation($_SESSION['ERPSOFV2RUserID'],'da_lh0002',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moda_lh0002->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
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
RunFunction(vID,'child');
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>','filter');
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
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=\"da_lh0002?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function Save()
	{
		var o=document.frmchoose;
		o.txtFlag.value=6;
		if(o.qxtlv001.value==""){
			alert("Mã không rỗng");
			o.qxtlv001.focus();
		}	
		else if(o.qxtlv002.value==""){
			alert("Xin vui lòng nhập tên");
			o.qxtlv002.focus();
		}	
		else
		{
			o.submit();
		}
	}
	function ChangeInfor()
{
	var o1=document.frmchoose;
 	o1.submit();
}
//-->
</script>
<?php
if($moda_lh0002->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose"> <input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
					  <table style="background:#F2F2F2;padding:5px;color:#4D4D4F!important;" border="0" cellpadding="3" cellspacing="3">
				<tr>
						<td>
						</td>
						<td align="center"><?php echo $moda_lh0002->ArrPush[2];?> </td>
						<td align="center"><?php echo $moda_lh0002->ArrPush[3];?></td>
						<td align="center"><?php echo $moda_lh0002->ArrPush[4];?></td>
						<td align="center"><?php echo $moda_lh0002->ArrPush[5];?></td>
						<td align="center"><?php echo $moda_lh0002->ArrPush[6];?></td>
					</tr>
					<tr>
						<td><input  style="width:80px;text-align:center" type="button" value="Tìm kiếm" onclick="ChangeInfor()"/></td>
						<td>
							<table width="95%">
								<tr>
									<td>
										<ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)">
										<li class="menupopT">
											<input type="textbox" tabindex="1" name="txtlv001" id="txtlv001" value="<?php echo $moda_lh0002->lv001;?>" style="min-width:100px;width:100%;text-align:center;"  autocomplete="off" onkeyup="LoadSelfNextParent(this,'txtlv001','da_lh0002','lv001','concat(lv002,@! - @!,lv001)')"/>
											<div id="lv_popup" lang="lv_popup1"> </div>
											</li>
										</ul>
									</td>
								</tr>
							</table>
						</td>
						<td>
							<table width="95%">
								<tr>
									<td>
										<ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)">
										<li class="menupopT">
											<input type="textbox" tabindex="1" name="txtlv002" id="txtlv002" value="<?php echo $moda_lh0002->lv002;?>" style="min-width:100px;width:100%;text-align:center;"  autocomplete="off" onkeyup="LoadSelfNextParent(this,'txtlv002','da_lh0002','lv002','concat(lv002,@! - @!,lv001)')" onblur="if(this.value.substr(this.value.length-1,this.value.length)==',') {this.value=this.value.substr(0,this.value.length-1);};"/>
											<div id="lv_popup2" lang="lv_popup2"> </div>
											</li>
										</ul>
									</td>
								</tr>
								</table>
						</td>
						<td>
							<input type="textbox" name="txtlv003" id="txtlv003"  style="min-width:100px;width:100%;text-align:center;" value="<?php echo $moda_lh0002->lv003;?>"/>	
						</td>
						<td>
							<table width="95%">
								<tr>
									<td>
										<ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)">
										<li class="menupopT">
											<input type="textbox" tabindex="1" name="txtlv004" id="txtlv004" value="<?php echo $moda_lh0002->lv004;?>" style="min-width:100px;width:100%;text-align:center;"  autocomplete="off" onkeyup="LoadSelfNextParent(this,'txtlv004','da_lh0002','lv004','concat(lv004,@! - @!,lv001)')"/>
											<div id="lv_popup4" lang="lv_popup4"> </div>
											</li>
										</ul>
									</td>
								</tr>
							</table>
						</td>	
						<td>
							<input type="textbox" name="txtlv005" id="txtlv005"  style="min-width:100px;width:100%;text-align:center;" value="<?php echo $moda_lh0002->lv005;?>"/>	
						</td>
				</tr>
			</table>
						
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $moda_lh0002->lv006;?>"/>
					    <?php echo $moda_lh0002->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
				  </form>
				  
</div></div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $moda_lh0002->ArrPush[0];?>';	
</script>