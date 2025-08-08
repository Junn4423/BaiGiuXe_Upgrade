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
$objvalue2=$_GET['objvalue2'];
$objvalue3=$_GET['objvalue3'];
$objtable=$_GET['objtable'];
$objfieldreturn=$_GET['objfieldreturn'];
$objfieldsearch=$_GET['objfieldsearch'];
$objfieldsearch2=$_GET['objfieldsearch2'];
$objfieldsearch3=$_GET['objfieldsearch3'];
$strCondition="";
if($objvalue2!="" || $objvalue2==NULL) $strCondition=" And $objfieldsearch2 like '%$objvalue2'";
if($objvalue3!="" || $objvalue3==NULL) $strCondition=" And $objfieldsearch3 like '%$objvalue3'";
if(trim($objvalue)=="")
$lvsql="";
else
{
$lvsql="select distinct * from (select concat('$vAdd',$objfieldreturn,',') lv001,$objfieldsearch lv002 from $objtable where $objfieldsearch like '$objvalue%' $strCondition union select concat('$vAdd',$objfieldreturn,',') lv001,$objfieldsearch lv002 from $objtable where $objfieldsearch like '%$objvalue%' $strCondition union select concat('$vAdd',$objfieldreturn,',') lv001,$objfieldsearch lv002 from $objtable where $objfieldsearch like '%$objvalue' $strCondition) A limit 0,20";
$strul="<ul id=subpop-nav><li class=menupopT><table border=0 width=100%>@#01</table></li></ul>";

$strtr="<tr><td><a href=\"javascript:PopupSelect('@01','$objid')\" tabindex=200>@01&nbsp;&nbsp;@02</a></td></tr>";
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