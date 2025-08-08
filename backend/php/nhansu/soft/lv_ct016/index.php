<?php
session_start();
if($_SESSION['ERPSOFV2RUserID']=="" || $_SESSION['ERPSOFV2RUserID']==NULL)
{
	exit();
}
$vDir = "../";
include($vDir."config.php");
include($vDir."function.php");
include($vDir."paras.php");
$objid=$_GET['objid'];
$objvalue=$_GET['objvalue'];
$objtable=$_GET['objtable'];
$objfield=str_replace("@!","'",$_GET['objfield']);
if(trim($objvalue)=="")
$lvsql="";
else
{
$lvsql="select B.*,0 lv005 from ( select distinct * from (select lv001,$objfield lv002,lv002 lv003,lv003 lv004,lv008 from $objtable where $objfield like '$objvalue%' union select lv001,$objfield lv002,lv002 lv003,lv003 lv004,lv008 from $objtable where $objfield like '%$objvalue%' union select lv001,$objfield lv002,lv002 lv003,lv003 lv004,lv008 from $objtable where $objfield like '%$objvalue') A) B";
$strul="<ul id=subpop-nav><li class=menupopT><table border=0 width=100%>@#01</table></li></ul>";

$strtr="<tr><td><a href=\"javascript:PopupSelect('@01','$objid')\" tabindex=200>@01&nbsp;&nbsp;@02</a></td></tr>";
$strAllTr='';
$lvResult = db_query($lvsql);
while($row=db_fetch_array($lvResult)){
		$lvTemp=str_replace("@01",$row['lv008'],$strtr);
		$lvTemp=str_replace("@02",str_replace($objvalue,"<font color=\"#FF0000\">".$objvalue."</font>",$row['lv002'].' SLT:'.get_slt_lot($row['lv001'],$row['lv003'],$row['lv004'])),$lvTemp);
		$strAllTr=$strAllTr.$lvTemp;
		}
}
$strReturn=str_replace("'","\'",str_replace("@#01",$strAllTr,$strul));
$strReturn=str_replace('"','\"',$strReturn);
$strReturn=str_replace("
","",$strReturn);
function get_slt_lot($vLotId,$vItemId,$vWhId)
{
	$sophieu=get_sophieu($vWhId,0,'lv001');
	if($sophieu=="") $sophieu="''";
	$vsql="select sum(lv004) sumslnhap from wh_lv0009 A where A.lv002 in ($sophieu) and A.lv003='$vItemId' and A.lv014='$vLotId'";
	$vresult=db_query($vsql);
	$vrow=db_fetch_array($vresult);
	$slnhap=$vrow['sumslnhap'];
	$sophieu=get_sophieu($vWhId,1,'lv001');
	$vsql="select sum(lv004) sumslxuat from wh_lv0011 A where A.lv002 in ($sophieu) and A.lv003='$vItemId' and A.lv014='$vLotId'";
	$vresult=db_query($vsql);
	$vrow=db_fetch_array($vresult);
	$slxuat=$vrow['sumslxuat'];
	return LCurrency($slnhap-$slxuat,"EN");
}
function get_sophieu($vWhId,$vopt,$vField)
{
	if($vopt==0)
		$vsql="select $vField from wh_lv0008 where lv002='$vWhId'";
	else
		$vsql="select $vField from wh_lv0010 where lv002='$vWhId'";
	$vresult=db_query($vsql);
		$strReturn="";
		if($vresult)
		{
			while($vrow=db_fetch_array($vresult))
			{
		   		if($strReturn=="") $strReturn="'".$vrow["$vField"]."'";
				else $strReturn=$strReturn.",'".$vrow["$vField"]."'";
			}
			return $strReturn;
		}
		return $strReturn;
		
}
?>
div1 = document.getElementById('lv_popup');
div1.innerHTML="<?php echo $strReturn;?>";
