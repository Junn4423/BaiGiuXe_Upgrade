<?php
/*
Copy right sof.vn
DateCreate:06/04/2007
*/
class lv_controlmn
{
var $vstrChild1_2_key = null;
	
var $BuildMenu=null;
var $Count=null;
var $getfirstlink=null;
/////////////////////////Thẻ HTML//////////////////////////////////////

var	$vstrParent1="
    <ul id=\"top-nav\"> 
	#01
	</ul>
";
var $vstrParent1_key="
			<ul style=\"display:none\" id=\"ul_a_#@stt\"> 
				#01
			</ul>
";
		//Sử dụng cho menu có cấp con
var	$vstrParent12_1="
		<li><a class=\"#77\" href=\"#01\" title=\"#02\" ><p>#03</p></a>
			<ul>
				#04
			</ul>
		</li>
		";
var	$vstrParent12_1_no="
		<li><a class=\"#77\" title=\"#02\"><p>#03</p></a>
			<ul>
				#04
			</ul>
		</li>
		";		
var $vstrParent12_1_key="
		<li><a class=\"menuleft_con #77\" href=\"#01\" title=\"#02\" id=\"a_#@stt\" onkeyup=\"KeyMenuRun(event,this,#@stt)\" rev=\"#@level\" rel=\"c_#@pstt\" name=\"#@child\" onmouseover=\"on_mouse_click(#@stt)\"><span>#03</span></a>
			<ul style=\"display:none\" id=\"ul_a_#@stt\">
				#04
			</ul>
		</li>
		";
		//Sử dụng cho menu không có cấp con
var	$vstrParent12_2="
		<li><a class=\"#77\" href=\"#01\" title=\"#02\" ><p>#03</p></a></li>
		";
var $vstrParent12_2_key="
		<li><a href=\"#01\" title=\"#02\" id=\"a_#@stt\" onkeyup=\"KeyMenuRun(event,this,#@stt)\" rev=\"#@level\"  rel=\"c_#@pstt\" name=\"#@child\"><span>#03</span></a></li>
		";
		//Sử dụng cho menu có cấp con
var	$vstrChild1_1="
		<li><a  class=\"#77\" href=\"#01\" title=\"#02\" ><p>#03</p></a></li>
		";
var $vstrChild1_1_key="
		<li><a href=\"#01\" title=\"#02\" id=\"a_#@stt\" onkeyup=\"KeyMenuRun(event,this,#@stt)\" rev=\"#@level\" rel=\"c_#@pstt\"  name=\"#@child\"><span>#03</span></a></li>
		";
		//Sử dụng cho menu không có cấp con
var	$vstrChild1_2="
		";
		//Sử dụng cho menu  có cấp con
var	$vstrChild2="	
		";
var	$vhref="?lang=#01&opt=#02&item=#03&link=#04";
		
	function lv_controlmn()
	{
		$this->getfirstlink	="";
		$this->BuildMenu=0;
		$this->Count=0;
	}
	function Count($vlv006)
	{	
		$vsql="select lv001 from lv_lv0005 where lv006='$vlv006' and lv001!='$vlv006' and lv005=0";
		$vresult=db_query($vsql);
		return (db_num_rows($vresult));
	}
	function RunBuild($vlv006,$vUserRun,$vRightRun,$vlang,$vRightUser,&$lvgiatri1,&$lvgiatri2,&$lvfi,&$giatrian)
	{	
//Xác định các cấu trúc cần thiết cho phân quyỿn ngưỿi dùng
		$vrow=null;
		if('admin'==$vRightUser)
		{
			$vsql="select  A.*  from lv_lv0005 A where lv004=$vRightRun and A.lv006='$vlv006' and A.lv001!='$vlv006' and A.lv005=0 order by A.lv008 asc";
		}
		else
		{	
		    $vsql="select  A.*  from lv_lv0005 A inner join lv_lv0008 B on A.lv001=B.lv003 where B.lv002='$vUserRun' and A.lv004=$vRightRun  and A.lv006='$vlv006' and A.lv001!='$vlv006' and A.lv005=0 order by A.lv008 asc";
		}
		$lfresult=db_query($vsql);
		$lfi=0;
		$pstrget="";
		$pstrget_key="";
		$pParentNum=db_num_rows($lfresult);	
		$plvfi=$lvfi;
		$getlink=base64_decode($_GET['link']);
		$getopt=$_GET['opt'];
		while($lfrow=db_fetch_array($lfresult))
		{
			$lvfi++;
			$giatrian=$giatrian.",".$lvfi.",";
			$pstrpa="";
			$pstrpa_key="";
			$vlv006=$lfrow['lv001'];
			
			$vstrgettext=GetLangRightID($lfrow['lv001'],$vlang);				
			//Kiểm tra xem có cấp con hay không.
			$vrCount=$this->Count($lfrow['lv001']);
			//Lấy link kết đến nếu có
			$vstrgettext=GetLangRightID($lfrow['lv001'],$vlang);				
			$pstrpa=($vrCount<=0)?$this->vstrParent12_2:(($lfrow['lv003']!='')?$this->vstrParent12_1:$this->vstrParent12_1_no);
			$pstrpa_key=($vrCount<=0)?$this->vstrParent12_2_key:$this->vstrParent12_1_key;
			$pstrpa_key=str_replace("#@stt",$lvfi,$pstrpa_key);
			$pstrpa_key=str_replace("#@pstt",$plvfi,$pstrpa_key);
			$pstrpa_key=str_replace("#@level",$lfrow['lv007'],$pstrpa_key);
			$pstrpa_key=str_replace("#@child",($vrCount<=0)?'':'1',$pstrpa_key);
			//Lấy liên kết
			$vlink= $this->vhref;
			$vlink=str_replace("#01",$vlang,$vlink);
			$vlink=str_replace("#02",$vRightRun,$vlink);
			$vlink=str_replace("#03",'',$vlink);
			if(trim($this->getfirstlink)=="") $this->getfirstlink=base64_encode($lfrow['lv003']);
			$vlink=str_replace("#04",base64_encode($lfrow['lv003']),$vlink);
			//Chuyển liên kết vào mục chính
			$pstrpa=str_replace("#01",$vlink,$pstrpa);
			$pstrpa_key=str_replace("#01",$vlink,$pstrpa_key);
			
			//Chuyển chủ đỿ vào liên kết
			$pstrpa=str_replace("#02",$vstrgettext,$pstrpa);
			$pstrpa=str_replace("#03",$vstrgettext,$pstrpa);
			$pstrpa=$pstrpa.str_replace("#01",$lfi,$this->vstrChild1_2);
			$pstrpa_key=str_replace("#02",$vstrgettext,$pstrpa_key);
			$pstrpa_key=str_replace("#03",$vstrgettext,$pstrpa_key);
			$pstrpa_key=$pstrpa_key.str_replace("#01",$lfi,$this->vstrChild1_2_key);
			////////////////////////////////////////////////////////////
			if($vrCount>0)
			{ 
				$this->RunBuild($lfrow['lv001'],$vUserRun,$vRightRun,$vlang,$vRightUser,$lvgiatri11,$lvgiatri21,$lvfi,$giatrian);
				$pstrpa=str_replace("#04",$lvgiatri11,$pstrpa);
				$pstrpa_key=str_replace("#04",$lvgiatri21,$pstrpa_key);
			}				
			if($getlink==$lfrow['lv003'] && $getopt==$lfrow['lv004'])
				$pstrpa=str_replace("#77",'menu_cur',$pstrpa);
			else
				$pstrpa=str_replace("#77",'',$pstrpa);
			$pstrget=$pstrget.$pstrpa;
			$pstrget_key=$pstrget_key.$pstrpa_key;
//Xây dựng buil cấu trúc cho lớp cấp con của cấu trúc nếu có.		
					
		}
		$lvgiatri1=$pstrget;
		$lvgiatri2=$pstrget_key;
		return ;
		
	}
	
}
?>