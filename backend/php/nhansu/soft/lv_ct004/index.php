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
	switch($objtable)
	{
		case 'hr_lv0020':
			$lvsql="select distinct * from (select concat('$vAdd',$objfieldreturn,',') lv001,$objfieldsearch lv002 from $objtable where lv009 not in (2,3) and $objfieldsearch like '$objvalue%' union select concat('$vAdd',$objfieldreturn,',') lv001,$objfieldsearch lv002 from $objtable where lv009 not in (2,3) and $objfieldsearch like '%$objvalue%' union select concat('$vAdd',$objfieldreturn,',') lv001,$objfieldsearch lv002 from $objtable where lv009 not in (2,3) and $objfieldsearch like '%$objvalue') A limit 0,20";
			break;
		default:
			$lvsql="select distinct * from (select concat('$vAdd',$objfieldreturn,',') lv001,$objfieldsearch lv002 from $objtable where $objfieldsearch like '$objvalue%' union select concat('$vAdd',$objfieldreturn,',') lv001,$objfieldsearch lv002 from $objtable where $objfieldsearch like '%$objvalue%' union select concat('$vAdd',$objfieldreturn,',') lv001,$objfieldsearch lv002 from $objtable where $objfieldsearch like '%$objvalue') A limit 0,20";
			break;
	}
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