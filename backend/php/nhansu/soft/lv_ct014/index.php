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
$vuser=$_SESSION['ERPSOFV2RUserID'];
$objvaluearray=explode(";",str_replace(",",";",str_replace('"','',str_replace("'","",$_GET['objvalue']))));
$vAdd="";
for($i=0;$i<count($objvaluearray)-1;$i++)
{
$vAdd=$vAdd.$objvaluearray[$i].",";
}
$objvalue=$objvaluearray[count($objvaluearray)-1];
//$objvalue=$_GET['objvalue'];
$objtable=$_GET['objtable'];
$objfieldreturn=str_replace("@!","'",$_GET['objfieldreturn']);
$objfieldsearch=str_replace("@!","'",$_GET['objfieldsearch']);
if(trim($objvalue)=="")
$lvsql="";
else
{
	$lvsql="select top 30 * from (select distinct * from (select ('$vAdd'+CAST($objfieldreturn as varchar)+',') lv001,$objfieldsearch lv002 from [dbo].$objtable where $objfieldsearch like '$objvalue%' union select ('$vAdd'+CAST($objfieldreturn as varchar)+',') lv001,$objfieldsearch lv002 from [dbo].$objtable where $objfieldsearch like '%$objvalue%'  union select ('$vAdd'+CAST($objfieldreturn as varchar)+',') lv001,$objfieldsearch lv002 from [dbo].$objtable where $objfieldsearch like '%$objvalue') A ) AA";
}
$strul="<ul id=subpop-nav><li class=menupopT><table border=0 width=100%>@#01</table></li></ul>";

$strtr="<tr><td><a href=\"javascript:PopupSelect('@01','$objid')\" tabindex=200>@01&nbsp;&nbsp;@02</a></td></tr>";
$strAllTr='';
$vsql1="select * from jo_lv0016";
$vresult1=db_query($vsql1);
$vrow1=db_fetch_array($vresult1);
$vServer=$vrow1['lv006'];
$vUser=$vrow1['lv007'];
$vPass=$vrow1['lv008'];
$vDatabase=$vrow1['lv009'];
$link = mssql_connect($vServer, $vUser, $vPass);
if (!$link || !mssql_select_db($vDatabase, $link)) {
	die('Unable to connect or select database!');
}
$lvResult = mssql_query($lvsql);
while($row=mssql_fetch_array($lvResult)){
		$lvTemp=str_replace("@01",$row['lv001'],$strtr);
		$lvTemp=str_replace("@02",str_replace($objvalue,"<font color=\"#FF0000\">".$objvalue."</font>",$row['lv002']),$lvTemp);
		$strAllTr=$strAllTr.$lvTemp;
		}
$strReturn=str_replace("'","\'",str_replace("@#01",$strAllTr,$strul));
$strReturn=str_replace('"','\"',$strReturn);
$strReturn=str_replace("
","",$strReturn);	

?>
div1 = document.getElementById('lv_popup');
div1.innerHTML="<?php echo $strReturn;?>";