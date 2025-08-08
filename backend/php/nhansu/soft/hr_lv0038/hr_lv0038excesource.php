<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0238.php");

$mohr_lv0238=new  hr_lv0238($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0003');	
$vlHDID=$_GET['HDID'];	
$vlv005=$_GET['lv005'];	
$vlv006=$_GET['lv006'];	
$vlv011=$_GET['lv011'];	
$vlv012=$_GET['lv012'];	
$vType=$_GET['Type'];	
$mohr_lv0238->LV_LoadID($vlHDID);
///////////Init object ///////////////////////////////
if($mohr_lv0238->lv001!="" && $mohr_lv0238->lv001!=NULL)
{
	
	switch($mohr_lv0238->lv003)
	{
		case 2://Thử việc
		case 5:
			if($vType==6)
			{
				?>
				
				var div004 = document.getElementById('txtlv004');
div004.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,1),2);?>';
var div098 = document.getElementById('txtlv098');
div098.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,1),2);?>';
var div005 = document.getElementById('txtlv005');
div005.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,85),2);?>';
<?php	

			}
			else
			{
				$vNumDay=365;
				switch($vType)
				{
					case 7:
						$vNumDay=365;
						?>
var div004 = document.getElementById('txtlv004');
div004.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,1),2);?>';
var div098 = document.getElementById('txtlv098');
div098.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,1),2);?>';
var div005 = document.getElementById('txtlv005');
div005.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,$vNumDay),2);?>';
<?php				
						break;
					case 8:
						$vNumDay=730;
						?>
var div004 = document.getElementById('txtlv004');
div004.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,1),2);?>';
var div098 = document.getElementById('txtlv098');
div098.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,1),2);?>';
var div005 = document.getElementById('txtlv005');
div005.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,$vNumDay),2);?>';
<?php				
						break;
					case 3:
					?>
var div004 = document.getElementById('txtlv004');
div004.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,1),2);?>';
var div098 = document.getElementById('txtlv098');
div098.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,1),2);?>';
var div005 = document.getElementById('txtlv005');
div005.value='01/01/2050';
<?php				
						break;
				}

			}
			break;
		default:
			if($vType==6)
			{
				?>
				var div004 = document.getElementById('txtlv004');
div004.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,1),2);?>';
var div098 = document.getElementById('txtlv098');
div098.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,4),2);?>';
var div005 = document.getElementById('txtlv005');
div005.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,89),2);?>';
<?php	

			}
			else
			{
				$vNumDay=365;
				switch($vType)
				{
					case 7:
						$vNumDay=365;
						?>
var div004 = document.getElementById('txtlv004');
div004.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,1),2);?>';
var div098 = document.getElementById('txtlv098');
div098.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,1),2);?>';
var div005 = document.getElementById('txtlv005');
div005.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,$vNumDay),2);?>';
<?php				
						break;
					case 8:
						$vNumDay=730;
						?>
var div004 = document.getElementById('txtlv004');
div004.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,1),2);?>';
var div098 = document.getElementById('txtlv098');
div098.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,1),2);?>';
var div005 = document.getElementById('txtlv005');
div005.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,$vNumDay),2);?>';
<?php				
						break;
					case 3:
					?>
var div004 = document.getElementById('txtlv004');
div004.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,1),2);?>';
var div098 = document.getElementById('txtlv098');
div098.value='<?php echo $mohr_lv0238->FormatView(ADDDATE($mohr_lv0238->lv005,1),2);?>';
var div005 = document.getElementById('txtlv005');
div005.value='01/01/2050';
<?php				
						break;
				}

			}
			break;
	}
?>

var div007 = document.getElementById('txtlv007');
div007.value='<?php echo str_replace("'","",$mohr_lv0238->lv007);?>';
var div010 = document.getElementById('txtlv010');
div010.value='<?php echo str_replace("'","",$mohr_lv0238->lv010);?>';
var div011 = document.getElementById('txtlv011');
div011.value='<?php echo str_replace("'","",$mohr_lv0238->lv011);?>';
var div012 = document.getElementById('txtlv012');
div012.value='<?php echo str_replace("'","",$mohr_lv0238->lv012);?>';
var div013 = document.getElementById('txtlv013');
div013.value='<?php echo str_replace("'","",$mohr_lv0238->lv013);?>';
var div015 = document.getElementById('txtlv015');
div015.value='<?php echo str_replace("'","",$mohr_lv0238->lv015);?>';
var div017 = document.getElementById('txtlv017');
div017.value='<?php echo str_replace("'","",$mohr_lv0238->lv017);?>';
var div019 = document.getElementById('txtlv019');
div019.value='<?php echo str_replace("'","",$mohr_lv0238->lv019);?>';
var div021 = document.getElementById('txtlv021');
div021.value='<?php echo str_replace("'","",$mohr_lv0238->lv021);?>';
var div022 = document.getElementById('txtlv022');
div022.value='<?php echo str_replace("'","",$mohr_lv0238->lv022);?>';
var div024 = document.getElementById('txtlv024');
div024.value='<?php echo str_replace("'","",$mohr_lv0238->lv024);?>';
var div027 = document.getElementById('txtlv027');
div027.value='<?php echo str_replace("'","",$mohr_lv0238->lv027);?>';
var div028 = document.getElementById('txtlv028');
div028.value='<?php echo str_replace("'","",$mohr_lv0238->lv028);?>';
var div029 = document.getElementById('txtlv029');
div029.value='<?php echo str_replace("'","",$mohr_lv0238->lv029);?>';
var div030 = document.getElementById('txtlv030');
div030.value='<?php echo str_replace("'","",$mohr_lv0238->lv030);?>';

<?php
}
?>