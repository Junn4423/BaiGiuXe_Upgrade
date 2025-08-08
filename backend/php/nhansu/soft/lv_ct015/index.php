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
$fieldreturn=str_replace("@!","'",$_GET['fieldreturn']);
if(trim($objvalue)=="")
$lvsql="";
else
{
	$lvsql="select distinct * from (select $fieldreturn lv001,$objfield lv002 from $objtable where $objfield like '$objvalue%' union select $fieldreturn lv001,$objfield lv002 from $objtable where $objfield like '%$objvalue%' union select $fieldreturn lv001,$objfield lv002 from $objtable where $objfield like '%$objvalue') A limit 0,20";
	$strul="<ul id=subpop-nav><li class=menupopT><table border=0 width=100%>@#01</table></li></ul>";

	$strtr="<tr><td><a href=\"javascript:PopupSelect('@01','$objid')\" tabindex=2>@01&nbsp;&nbsp;@02</a></td></tr>";
	$strAllTr='';
	$lvResult = db_query($lvsql);
	while($row=db_fetch_array($lvResult)){
			$lvTemp=str_replace("@01",$row['lv001'],$strtr);
			$lvTemp=str_replace("@02",str_replace($objvalue,"<font color=\"#FF0000\">".$objvalue."</font>",$row['lv002']),$lvTemp);
			$strAllTr=$strAllTr.$lvTemp;
			}
}
$strReturn=str_replace("'","\'",str_replace("@#01",$strAllTr,$strul));
$strReturn=str_replace('"','\"',$strReturn);
$strReturn=str_replace("
","",$strReturn);
?>
div1 = document.getElementById('lv_popup');
div1.innerHTML="<?php echo $strReturn;?>";
