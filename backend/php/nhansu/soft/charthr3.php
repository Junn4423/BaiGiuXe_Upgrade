<?php 
include("config.php");
include("configrun.php");
include("function.php");
function dickelinie($img,$start_x,$start_y,$end_x,$end_y,$color,$thickness)
{
    $angle=(atan2(($start_y - $end_y),($end_x - $start_x)));

    $dist_x=$thickness*(sin($angle));
    $dist_y=$thickness*(cos($angle));
   
    $p1x=ceil(($start_x + $dist_x));
    $p1y=ceil(($start_y + $dist_y));
    $p2x=ceil(($end_x + $dist_x));
    $p2y=ceil(($end_y + $dist_y));
    $p3x=ceil(($end_x - $dist_x));
    $p3y=ceil(($end_y - $dist_y));
    $p4x=ceil(($start_x - $dist_x));
    $p4y=ceil(($start_y - $dist_y));
   
    $array=array(0=>$p1x,$p1y,$p2x,$p2y,$p3x,$p3y,$p4x,$p4y);
    imagefilledpolygon ( $img, $array, (count($array)/2), $color );
}

// Example:
header ("Content-type: image/jpeg");
$img = ImageCreate (1050, 600) or die("Cannot Initialize new GD image stream ");

$backgroundcolor = ImageColorAllocate ($img, 241, 241, 241);
$orange = ImageColorAllocate($img, 252, 102, 4);
$blue = ImageColorAllocate($img, 21, 122, 214);
$green = ImageColorAllocate($img, 0x00, 0x00, 0x00);
function builchar($img,$orange,$blue)
{
	$vNow=GetServerDate();
	$vmonth=(int)getmonth($vNow);
	$vyear=(int)getyear($vNow);
	$vday=(int)getday($vNow);
	$vNow1[0]=$vyear;
	$vlang=$_GET['lang'];
	if($vlang=='') $vlang='EN';
	$sql="select MP.* from (";
	$vunione="";
	for($i=0;$i<=15;$i++)
	{
		//A.lv009 not in(2,3,7)
		$sql=$sql.$vunione." select (select count(*) from hr_lv0020 A where A.lv018=1 AND ((A.lv009 not in(2,3,7) and (YEAR(A.lv044)='1900-01-01' or YEAR(A.lv044)='0000-00-00') and YEAR(A.lv030)<='$vNow1[$i]')or (A.lv009 not in(0,1) and YEAR(A.lv044)>='$vNow1[$i]' and YEAR(A.lv030)<='$vNow1[$i]'))) personmale,(select count(*) from hr_lv0020 A where  A.lv018=0 AND ((A.lv009 not in(2,3,7) and (YEAR(A.lv044)='1900-01-01' or YEAR(A.lv044)='0000-00-00') and YEAR(A.lv030)<='$vNow1[$i]')or (A.lv009 not in(0,1) and YEAR(A.lv044)>='$vNow1[$i]' and YEAR(A.lv030)<='$vNow1[$i]'))) personfemale,$i thang,'$vNow1[$i]' months ";
			$vNow1[$i+1]=$vyear-1-$i;
			$vunione=" union ";
		
	}
		
		$sql=$sql.")   MP order by thang desc";
		/* $sql="select MP.* from (
		  select (select count(*) from hr_lv0020 A where A.lv018=1 AND (A.lv009 not in(2,3,7) and (YEAR(A.lv044)='1900-01-01' or YEAR(A.lv044)='0000-00-00') and YEAR(A.lv030)<='$vNow1[0]')or (A.lv009 not in(0,1) and YEAR(A.lv044)>='$vNow1[0]' and YEAR(A.lv030)<='$vNow1[0]')) personmale,(select count(*) from hr_lv0020 A where  A.lv018=0 AND (A.lv009 not in(2,3,7) and (YEAR(A.lv044)='1900-01-01' or YEAR(A.lv044)='0000-00-00') and YEAR(A.lv030)<='$vNow1[0]')or (A.lv009 not in(0,1) and YEAR(A.lv044)>='$vNow1[0]' and YEAR(A.lv030)<='$vNow1[0]')) personfemale,1 thang,'$vNow1[0]' months 
		  union 
		  select (select count(*) from hr_lv0020 A where  A.lv018=1 AND (A.lv009 not in(2,3,7) and (YEAR(A.lv044)='1900-01-01' or YEAR(A.lv044)='0000-00-00') and YEAR(A.lv030)<='$vNow1[1]')or (A.lv009 not in(0,1) and YEAR(A.lv044)>='$vNow1[1]' and YEAR(A.lv030)<='$vNow1[1]')) personmale,(select count(*) from hr_lv0020 A where  A.lv018=0 AND (A.lv009 not in(2,3,7) and (YEAR(A.lv044)='1900-01-01' or YEAR(A.lv044)='0000-00-00') and YEAR(A.lv030)<='$vNow1[1]')or (A.lv009 not in(0,1) and YEAR(A.lv044)>='$vNow1[1]' and YEAR(A.lv030)<='$vNow1[1]')) personfemale,2 thang,'$vNow1[1]' months
		  union
		  select (select count(*) from hr_lv0020 A where  A.lv018=1 AND (A.lv009 not in(2,3,7) and (YEAR(A.lv044)='1900-01-01' or YEAR(A.lv044)='0000-00-00') and YEAR(A.lv030)<='$vNow1[2]')or (A.lv009 not in(0,1) and YEAR(A.lv044)>='$vNow1[2]' and YEAR(A.lv030)<='$vNow1[2]')) personmale,(select count(*) from hr_lv0020 A where  A.lv018=0 AND (A.lv009 not in(2,3,7) and (YEAR(A.lv044)='1900-01-01' or YEAR(A.lv044)='0000-00-00') and YEAR(A.lv030)<='$vNow1[2]')or (A.lv009 not in(0,1) and YEAR(A.lv044)>='$vNow1[2]' and YEAR(A.lv030)<='$vNow1[2]')) personfemale,3 thang,'$vNow1[2]' months
		  union
		  select (select count(*) from hr_lv0020 A where  A.lv018=1 AND (A.lv009 not in(2,3,7) and (YEAR(A.lv044)='1900-01-01' or YEAR(A.lv044)='0000-00-00') and YEAR(A.lv030)<='$vNow1[3]')or (A.lv009 not in(0,1) and YEAR(A.lv044)>='$vNow1[3]' and YEAR(A.lv030)<='$vNow1[3]')) personmale,(select count(*) from hr_lv0020 A where  A.lv018=0 AND (A.lv009 not in(2,3,7) and (YEAR(A.lv044)='1900-01-01' or YEAR(A.lv044)='0000-00-00') and YEAR(A.lv030)<='$vNow1[3]')or (A.lv009 not in(0,1) and YEAR(A.lv044)>='$vNow1[3]' and YEAR(A.lv030)<='$vNow1[3]')) personfemale,4 thang,'$vNow1[3]' months
		  union
		  select (select count(*) from hr_lv0020 A where  A.lv018=1 AND (A.lv009 not in(2,3,7) and (YEAR(A.lv044)='1900-01-01' or YEAR(A.lv044)='0000-00-00') and YEAR(A.lv030)<='$vNow1[4]')or (A.lv009 not in(0,1) and YEAR(A.lv044)>='$vNow1[4]' and YEAR(A.lv030)<='$vNow1[4]')) personmale,(select count(*) from hr_lv0020 A where  A.lv018=0 AND (A.lv009 not in(2,3,7) and (YEAR(A.lv044)='1900-01-01' or YEAR(A.lv044)='0000-00-00') and YEAR(A.lv030)<='$vNow1[4]')or (A.lv009 not in(0,1) and YEAR(A.lv044)>='$vNow1[4]' and YEAR(A.lv030)<='$vNow1[4]')) personfemale,5 thang,'$vNow1[4]' months
		   union
		  select (select count(*) from hr_lv0020 A where  A.lv018=1 AND (A.lv009 not in(2,3,7) and (YEAR(A.lv044)='1900-01-01' or YEAR(A.lv044)='0000-00-00') and YEAR(A.lv030)<='$vNow1[5]')or (A.lv009 not in(0,1) and YEAR(A.lv044)>='$vNow1[5]' and YEAR(A.lv030)<='$vNow1[5]')) personmale,(select count(*) from hr_lv0020 A where  A.lv018=0 AND (A.lv009 not in(2,3,7) and (YEAR(A.lv044)='1900-01-01' or YEAR(A.lv044)='0000-00-00') and YEAR(A.lv030)<='$vNow1[5]')or (A.lv009 not in(0,1) and YEAR(A.lv044)>='$vNow1[5]' and YEAR(A.lv030)<='$vNow1[5]')) personfemale,6 thang,'$vNow1[5]' months) 
		  MP order by thang desc";	*/  
	$vresult=db_query($sql);
	$next=0;
	// Path to our ttf font file
	$font_file = './arial.ttf';
	$black = imagecolorallocate($img, 0x00, 0x00, 0x00);
	$lvMaxTotal=700;
	$lvScale=580/$lvMaxTotal;
// Draw the text 'PHP Manual' using font size 13
	while($vrow=db_fetch_array($vresult))
	{
		$vsumperson=$vrow['personmale']+$vrow['personfemale'];
		$vFemaleperson=$vrow['personfemale'];
		if($next!=0)
		{
			dickelinie($img, 10+$next-67,600-$vprevious ,10+$next, 600-$vsumperson*$lvScale,$orange,1);
			$vprevious=$vsumperson*$lvScale;
			$vpreviousfemale=$vFemaleperson*$lvScale;
			dickelinie($img, 10+$next,600,10+$next, 600-$vsumperson*$lvScale,$blue,4);
			dickelinie($img, 20+$next,600,20+$next, 600-$vpreviousfemale,$orange,4);
			imagefttext($img, 10, 0, $next, 600-$vsumperson*$lvScale-5, $black, $font_file, $vsumperson);
			imagefttext($img, 10, 90, 40+$next, 600, $black, $font_file, str_replace("/","-",$vrow['months'])."   (Nu: ".$vFemaleperson." nguoi - ".round($vFemaleperson*100/$vsumperson,0)."%)");
		}
		else 
		{
			$vprevious=$vsumperson*$lvScale;
			$vpreviousfemale=$vFemaleperson*$lvScale;
			dickelinie($img, 10,600 ,10, 600-$vprevious,$blue,4);
			dickelinie($img, 20,600 ,20, 600-$vpreviousfemale,$orange,4);
			imagefttext($img, 10, 0, 0, 600-$vprevious-5, $black, $font_file, $vsumperson);
			imagefttext($img, 10, 90, 40, 600, $black, $font_file,str_replace("/","-",$vrow['months'])."   (Nu: ".$vFemaleperson." nguoi - ".round($vFemaleperson*100/$vsumperson,0)."%)");
		}
		
		$next=$next+67;
	}
}
builchar($img,$orange,$blue);
imagejpeg($img);  
ImageDestroy($img);

?>