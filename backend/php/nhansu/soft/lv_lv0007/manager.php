<?php
session_start(); 
unset( $_SESSION['NodesHasBeenAddedCheckBox'] );
unset( $_SESSION['treeviewcheckbox'] );
unset( $_SESSION['treeviewcheckbox'] );
if (isset( $_SESSION['NodesHasBeenAddedCheckBox'] )) {
	session_destroy();
}
if (isset( $_SESSION['treeviewcheckbox'] )) {
	session_destroy();
}
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/lv_lv0007.php");

/////////////init object//////////////
$molv_lv0007=new lv_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0214');
require_once("$vDir../clsall/hr_lv0020.php");
require_once("$vDir../clsall/hr_lv0086.php");
require_once("$vDir../clsall/ml_lv0008.php");
require_once("$vDir../clsall/ml_lv0009.php");
require_once("$vDir../clsall/ml_lv0013.php");
require_once("$vDir../clsall/ml_lv0100.php");
require_once("$vDir../clsall/hr_lv0100.php");
require_once("$vDir../clsall/hr_lv0101.php");
require_once("$vDir../clsall/hr_lv0103.php");
require_once("$vDir../clsall/sl_lv0007.php");
$lvhr_lv0086=new hr_lv0086($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0086');
$lvsl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0007');
$lvhr_lv0103=new hr_lv0103($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0103');
$lvhr_lv0086->LV_Load();
$lvsl_lv0007->LV_LoadID($lvhr_lv0086->lv014);
require_once("$vDir../clsall/class.phpmailer.php");
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$mohr_lv0100=new hr_lv0100($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0100');
$mohr_lv0101=new hr_lv0101($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0101');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$mohr_lv0100->lvhr_lv0086=$lvhr_lv0086;
$molv_lv0007->mohr_lv0020=$mohr_lv0020;
$molv_lv0007->mohr_lv0086=$lvhr_lv0086;
$molv_lv0007->mohr_lv0100=$mohr_lv0100;
$molv_lv0007->mohr_lv0101=$mohr_lv0101;
$molv_lv0007->mosl_lv0007=$lvsl_lv0007;
$molv_lv0007->lvhr_lv0103=$lvhr_lv0103;
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","LV0003.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0007->ArrPush[0]=$vLangArr[11];
$molv_lv0007->ArrPush[1]=$vLangArr[12];
$molv_lv0007->ArrPush[2]=$vLangArr[13];
$molv_lv0007->ArrPush[3]=$vLangArr[14];
$molv_lv0007->ArrPush[4]=$vLangArr[15];
$molv_lv0007->ArrPush[5]=$vLangArr[26];
$molv_lv0007->ArrPush[6]=$vLangArr[17];
$molv_lv0007->ArrPush[7]=$vLangArr[18];
$molv_lv0007->ArrPush[8]=$vLangArr[19];
$molv_lv0007->ArrPush[9]=$vLangArr[20];
$molv_lv0007->ArrPush[10]=$vLangArr[21];
$molv_lv0007->ArrPush[11]=$vLangArr[22];
$molv_lv0007->ArrPush[12]=$vLangArr[23];
$molv_lv0007->ArrPush[13]=$vLangArr[24];
$molv_lv0007->ArrPush[14]=$vLangArr[25];
$molv_lv0007->ArrPush[15]=$vLangArr[26];
$molv_lv0007->ArrPush[16]=$vLangArr[27];
$molv_lv0007->ArrPush[17]=$vLangArr[35];
$molv_lv0007->ArrPush[18]=$vLangArr[36];
$molv_lv0007->ArrPush[19]=$vLangArr[37];
$molv_lv0007->ArrPush[20]=$vLangArr[38];
$molv_lv0007->ArrPush[21]=$vLangArr[39];
$molv_lv0007->ArrPush[22]=$vLangArr[40];
$molv_lv0007->ArrPush[23]=$vLangArr[41];


$molv_lv0007->ArrFunc[0]='//Function';
$molv_lv0007->ArrFunc[1]=$vLangArr[2];
$molv_lv0007->ArrFunc[2]=$vLangArr[4];
$molv_lv0007->ArrFunc[3]=$vLangArr[6];
$molv_lv0007->ArrFunc[4]=$vLangArr[7];
$molv_lv0007->ArrFunc[5]=$vLangArr[5];
$molv_lv0007->ArrFunc[6]=$vLangArr[3];
$molv_lv0007->ArrFunc[7]='Mở khóa';
$molv_lv0007->ArrFunc[8]=$vLangArr[8];
$molv_lv0007->ArrFunc[9]=$vLangArr[10];
$molv_lv0007->ArrFunc[10]=$vLangArr[0];
$molv_lv0007->ArrFunc[11]=$vLangArr[30];
$molv_lv0007->ArrFunc[12]=$vLangArr[31];
$molv_lv0007->ArrFunc[13]=$vLangArr[32];
$molv_lv0007->ArrFunc[14]=$vLangArr[33];
$molv_lv0007->ArrFunc[15]=$vLangArr[34];
////Other
$molv_lv0007->ArrOther[1]=$vLangArr[28];
$molv_lv0007->ArrOther[2]=$vLangArr[29];
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
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$molv_lv0007->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"lv_lv0007",$lvMessage);
}
elseif($flagID==2)
{
$molv_lv0007->lv001=$_POST['txtlv001'];
if( $_GET['ID']=="")
$lvwb_lv0001->lv002=$_POST['txtlv002'];
else
$lvwb_lv0001->lv002= $_GET['ID'] ?? '';
$molv_lv0007->lv003=$_POST['txtlv003'];
$molv_lv0007->lv004=$_POST['txtlv004'];
$molv_lv0007->lv005=$_POST['txtlv005'];
$molv_lv0007->lv006=$_POST['txtlv006'];
$molv_lv0007->lv007=$_POST['txtlv007'];
$molv_lv0007->lv008=$_POST['txtlv008'];
$molv_lv0007->lv009=$_POST['txtlv009'];
$molv_lv0007->lv010=$_POST['txtlv010'];
$molv_lv0007->lv011=$_POST['txtlv011'];
$molv_lv0007->lv012=$_POST['txtlv012'];
$molv_lv0007->lv013=$_POST['txtlv013'];
$molv_lv0007->lv014=$_POST['txtlv014'];
$molv_lv0007->lv015=$_POST['txtlv015'];
$molv_lv0007->lv016=$_POST['txtlv016'];
$molv_lv0007->lv017=$_POST['txtlv017'];
$molv_lv0007->lv018=$_POST['txtlv018'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$molv_lv0007->LV_Aproval($strar);
	if($vresult)
	{
		require_once("$vDir../clsall/hr_lv0093.php");
		$mohr_lv0093=new hr_lv0093($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0093');
		$mohr_lv0093->lvhr_lv0086=$lvhr_lv0086;
		$mohr_lv0093->LV_BuilTree($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum,$_SESSION['userlogin_smcd']);
		echo "<br>"."Đã xử lý nâng cấp level!(Process level successfull!)";
	}
	$molv_lv0007->lv001='';	
	$molv_lv0007->lv002='';	
	$molv_lv0007->lv003='';
	$molv_lv0007->lv004='';
	$molv_lv0007->lv005='';
	$molv_lv0007->lv006='';
	$molv_lv0007->lv007='';
	$molv_lv0007->lv008='';
	$molv_lv0007->lv009='';
	$molv_lv0007->lv010='';
	$molv_lv0007->lv011='';
	$molv_lv0007->lv012='';
	$molv_lv0007->lv013='';
	$molv_lv0007->lv014='';
	$molv_lv0007->lv015='';
	$molv_lv0007->lv016='';
	$molv_lv0007->lv017='';
	$molv_lv0007->lv018='';
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$molv_lv0007->LV_UnAproval($strar);
}
elseif($flagID==5)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$molv_lv0007->LV_ResetPwd($strar);
}
elseif($flagID==6)
{
	$moml_lv0013=new ml_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0013');
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$moml_lv0013->LV_LoadID($_POST['txtlv099']);
	$molv_lv0007->moml_lv0013=$moml_lv0013;
	$vresult=$molv_lv0007->LV_SendMailAll($strar);
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0007->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'lv_lv0007');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$molv_lv0007->ListView;
$vOrderList=$molv_lv0007->ListOrder;
$curPage = $molv_lv0007->CurPage;
$maxRows =$molv_lv0007->MaxRows;
$vOrderList=$molv_lv0007->ListOrder;
$vSortNum=$molv_lv0007->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$molv_lv0007->SaveOperation($_SESSION['ERPSOFV2RUserID'],'lv_lv0007',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$molv_lv0007->GetCountManage('');
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
	var str="<br><iframe id='lvframefrm' height=650 marginheight=0 marginwidth=0 frameborder=0 src=lv_lv0007?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;
	scrollToBottom();
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
	
}
function AddPer()
	{
		Chked2Submit(document.frmchoose,'lvChk',6)
	}
	function AddPermission(vValue)
	{
		var o=document.frmcomtemp;
		o.txtlv001.value=vValue;
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,3,0,0,0);?>";
		o.target="_self";
		o.submit();
	}
function Rpt()
{
	lv_chk_list(document.frmchoose,'lvChk',4);
}
function Fil()
{
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv0010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&lv015=<?php echo $_POST['txtlv015'];?>&lv015=<?php echo $_POST['txtlv016'];?>&lv017=<?php echo $_POST['txtlv017'];?>&lv018=<?php echo $_POST['txtlv018'];?>&lv019=<?php echo $_POST['txtlv019'];?>&lv020=<?php echo $_POST['txtlv020'];?>&lv021=<?php echo $_POST['txtlv021'];?>&lv022=<?php echo $_POST['txtlv022'];?>&lv023=<?php echo $_POST['txtlv023'];?>&lv024=<?php echo $_POST['txtlv024'];?>&lv025=<?php echo $_POST['txtlv025'];?>&lv026=<?php echo $_POST['txtlv026'];?>&lv027=<?php echo $_POST['txtlv027'];?>&lv028=<?php echo $_POST['txtlv028'];?>&lv029=<?php echo $_POST['txtlv029'];?>&lv030=<?php echo $_POST['txtlv030'];?>&lv031=<?php echo $_POST['txtlv022'];?>&lv033=<?php echo $_POST['txtlv033'];?>&lv034=<?php echo $_POST['txtlv034'];?>&lv035=<?php echo $_POST['txtlv035'];?>&lv036=<?php echo $_POST['txtlv036'];?>&lv037=<?php echo $_POST['txtlv037'];?>&lv038=<?php echo $_POST['txtlv038'];?>&lv039=<?php echo $_POST['txtlv039'];?>&lv040=<?php echo $_POST['txtlv040'];?>&lv041=<?php echo $_POST['txtlv041'];?>&lv042=<?php echo $_POST['txtlv042'];?>','filter');
}
function Report(vValue)
{
	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=5;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
function FunctRunning1(vValue)
{
	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=6;
	o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	o.submit();
}
function GuiMail ()
{
	var o=document.frmchoose;
	if( o.txtlv099.value=="")
	{
		alert('Xin vuil lòng chọn mẫu');
		o.txtlv099.focus();
	}
	else
	{
		lv_chk_list(document.frmchoose,'lvChk',6);
	}
	
}
	function DoResetPass()
	{
		Chked2Submit(document.frmchoose,"lvChk",26);
	}
	function ResetPass(vValue)
	{
		var o=document.frmcomtemp;
		o.txtlv001.value=vValue;
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,17,0,0,0);?>";
		o.target="_self";
		o.submit();
	}
//-->
</script>
<?php
if($molv_lv0007->GetView()==1)
{
?>
<form action="" name="frmcomtemp" method="post" target="_blank" enctype="multipart/form-data">
						<input type="hidden" name="txtlv001" id="txtlv001" />
						<input type="hidden" name="txtFlagControl" id="txtFlagControl" value="2" />
						<input type="hidden" name="curPg" id="curPg" value="">						
						<input type="hidden" name="txtSQL" id="txtSQL" value="<?php echo $psql;?>" />
					</form>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
						 <TABLE id=toolbar cellSpacing=5 cellPadding=5 border=0>
							<TBODY>
								<TR vAlign=center align=middle>
									<td><a class="toolbar" href="javascript:DoResetPass();">
										<img src="../images/controlright/key.gif" title="<?php echo $vLangArr[14];?>" name="reset" border="0" align="middle" id="reset" /><br /><?php echo 'Đổi mật khẩu';?></a>
									</td>
									<td>
										<a class="toolbar"  href="javascript:AddPer();"><img src="../images/controlright/config.gif" title="" name="new" border="0" align="middle" id="new" /> <br /><?php echo 'Phân quyền';?></a>
									</td>
									<td>
										<input type="button" value="Gửi mail" onclick="GuiMail()" /> <select name="txtlv099" id="txtlv099"  tabindex="7"  style="width:250" onKeyPress="return CheckKey(event,7)"/>
										<option value=""></option>
										<?php echo $molv_lv0007->LV_LinkField('lv099',$molv_lv0007->lv099);?></select>
									</td>
								</tr>
							</TBODY>
						</table>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $molv_lv0007->LV_BuilListManager($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="0"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $molv_lv0007->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $molv_lv0007->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $molv_lv0007->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $molv_lv0007->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $molv_lv0007->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $molv_lv0007->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $molv_lv0007->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $molv_lv0007->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $molv_lv0007->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $molv_lv0007->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $molv_lv0007->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $molv_lv0007->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $molv_lv0007->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $molv_lv0007->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $molv_lv0007->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $molv_lv0007->lv016;?>"/>
						<input type="hidden" name="txtlv017" id="txtlv017" value="<?php echo $molv_lv0007->lv017;?>"/>
						<input type="hidden" name="txtlv018" id="txtlv018" value="<?php echo $molv_lv0007->lv018;?>"/>
					    
				  </form>
</div></div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $molv_lv0007->ArrPush[0];?>';	
</script>