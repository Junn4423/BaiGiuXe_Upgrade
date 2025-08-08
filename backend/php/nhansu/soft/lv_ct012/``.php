<?php
session_start();
$vDir = "../";
include($vDir."config.php");
include($vDir."function.php");
include($vDir."paras.php");
$objid=$_GET['objid'];
$objvalue=$_GET['objvalue'];
$objtable=$_GET['objtable'];
$objfield=$_GET['objfield'];
$sql="select distinct * from (select lv001,$objfield lv002 from $objtable $objfield like '$objvalue%'
union
select lv001,$objfield lv002 from $objtable $objfield like '%$objvalue')";

$strul=" <ul id=\"subpop-nav\"><table border=0 width=\"100%\">@#01</table>	</ul>";
$strtr=" <tr><td><a href=\"javascript:PopupSelect('@01','$objid')\">@01</a></td><td><a href=\"javascript:PopupSelect('@01','$objid')\">@02</a></td></tr>";
$strAllTr='';
$lvResult = db_query($sql);
		while($row= db_fetch_array($lvResult)){
		$lvTemp=str_replace("@01",$row['lv001'],$strtr);
		$lvTemp=str_replace("@02",$row['lv002'],$lvTemp);
		$strAllTr=$strAllTr.$lvTemp;
		}

$strReturn=str_replace("'","''",str_replace("@#01",$strAllTr,$strul));
?>
div1 = document.getElementById('lv_popup');
div1.innerHTML="<?php echo $strReturn;?>";