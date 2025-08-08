<?php
/*
Bảng quyỿn ERPSOFV2R.com
Không được sửa
Ngày tạo:06/04/2007
*/
class lvhrv1_0
{
//#01:Tên tiêu đỿ
//#02:Liên kết
//#03	
//Biến lưu giá trị hiện thanh của frame
public $LV_UserID;
var $MenuParent=null;
var $LinkParent=null;
var $LinkOrder=null;
var $EnableLinkOrder=null;
var $MenuChild=null;
var $PreLinkOrder=null;
var $getoptionrun=null;
var $getfirstlink=null;
var $curmenu=null;
public $curmenu_stt=null;
public $chinhanh='cn001';
var $RunVisibleall="<div class=\"color_line\"><a  href=\"javascript:openoptionhere(#02)\" border=\"0\" ><p>#01</p></a>#04</div><div class=\"none_line\">&nbsp;</div>";
var $RunVisible="<td style=\"background-image : url();\" ></td><td style=\"padding-left:7px;\"></td><td><table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr height=\"20\"><td ><img border=\"0\" src=\"../images/images/button_01.gif\" width=\"18\" height=\"18\" alt=\"\" ></td><td style=\"\" nowrap><a  id=\"header_menu\"  href=\"#02\" border=\"0\" class=lvcurrentTab><table height=\"24\" width=100% border=0 cellspacing=\"0\" cellpadding=\"0\"><tr><td nowrap align=right><img border=\"0\" src=\"../images/images/inbox/bt_03.gif\" width=\"6\" height=\"24\" alt=\"\" ></td><td nowrap background=\"../images/images/inbox/bt_04.gif\"><font class=lvcurrentTab>#01</font></td><td nowrap><img border=\"0\" src=\"../images/images/inbox/bt_06.gif\" width=\"6\" height=\"24\" alt=\"\" ></td></tr></table></a></td><td >#04</td><td ><img src=\"\" width=\"1\" height=\"1\" border=\"0\" alt=\"\"></td></tr></table></td>";
//Biến lưu giá trị ẩn thanh của frame
var $RunInvisible="<td><table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\" ><tr height=\"20\"><td ><img border=\"0\" src=\"../images/images/button_01.gif\" width=\"18\" height=\"18\" alt=\"\" ></td><td class=\"lvotherTab\" nowrap><a class=\"lvotherTab\"  href=\"#02\"><font class=lvotherTab>#01</font></a></td><td >#04</td><td ><img src=\"../images/images/spacer.gif\" width=\"1\" height=\"1\" border=\"0\" ></td></tr></table></td>";
var $vstrParent="#01";
	function __construct($vlang,$vUserRun)
	{
		$this->curmenu="";
		$this->curmenu_stt="";
		$tLangArr=GetLangFile("../","LB0100.txt",$vlang);
		$this->MenuParent= array(1=>$tLangArr[2],2=>$tLangArr[3],3=>$tLangArr[4],4=>$tLangArr[5],5=>$tLangArr[6],6=>$tLangArr[7],7=>$tLangArr[8],8=>$tLangArr[9],9=>$tLangArr[10],10=>$tLangArr[11],11=>$tLangArr[12],12=>$tLangArr[13],13=>$tLangArr[30],14=>$tLangArr[15],15=>$tLangArr[16],16=>$tLangArr[17],17=>$tLangArr[18],18=>$tLangArr[19],19=>$tLangArr[20],20=>$tLangArr[21],21=>$tLangArr[22],22=>$tLangArr[23],23=>$tLangArr[24],24=>$tLangArr[25],25=>$tLangArr[26],26=>$tLangArr[27],27=>$tLangArr[28]);
		$this->LinkParent= array(1=>'?lang=#01&opt=1',2=>'?lang=#01&opt=10',3=>'?lang=#01&opt=6',4=>'?lang=#01&opt=100',5=>'?lang=#01&opt=102',6=>'?lang=#01&opt=101',7=>'?lang=#01&opt=103',8=>'?lang=#01&opt=5',9=>'?lang=#01&opt=8',10=>'?lang=#01&opt=11',11=>'?lang=#01&opt=99',12=>'?lang=#01&opt=9',13=>'?lang=#01&opt=27',14=>'?lang=#01&opt=7',15=>'?lang=#01&opt=13',16=>'?lang=#01&opt=14',17=>'?lang=#01&opt=15',18=>'?lang=#01&opt=16',19=>'?lang=#01&opt=17',20=>'?lang=#01&opt=18',21=>'?lang=#01&opt=19',22=>'?lang=#01&opt=20',23=>'?lang=#01&opt=21',24=>'?lang=#01&opt=22',25=>'?lang=#01&opt=23',26=>'?lang=#01&opt=24',27=>'?lang=#01&opt=25');		
		$this->LinkOrder= array(1=>1,10=>2,6=>3,100=>4,102=>5,101=>6,103=>7,5=>8,8=>9,11=>10,99=>11,9=>12,27=>13,7=>14,13=>15,14=>16,15=>17,16=>18,17=>19,18=>20,19=>21,20=>22,21=>23,22=>24,23=>25,24=>26,25=>27);
		$this->PreLinkOrder= array(1=>1,2=>10,3=>6,4=>100,5=>102,6=>101,7=>103,8=>5,9=>8,10=>11,11=>99,12=>9,13=>27,14=>7,15=>13,16=>14,17=>15,18=>16,19=>17,20=>18,21=>19,22=>20,23=>21,24=>22,25=>23,26=>24,27=>25);
		$this->EnableLinkOrder= array(1=>1,2=>1,3=>1,4=>0,5=>1,6=>1,7=>1,8=>1,9=>1,10=>0,11=>1,12=>0,13=>1,14=>0,15=>0,16=>0,17=>0,18=>0,19=>1,20=>0,21=>1,22=>0,23=>1,24=>1,25=>1,26=>0,27=>1);
		$this->getoptionrun=$this->getrightrun($vUserRun);
		$this->getfirstlink="";		
		
	}
//Mục tiêu hàm là tạo frame và phân quyỿn hoàn thiện frame
	function createframeall($vUserRun,$vRightRun,$vlang)
	{
		$vStrReturn="";
		$i=1;
		$vgetrun=$this->getoptionrun;
		
		$opt  = isset($_GET['opt'])  ? $_GET['opt']  : 0;
		$link = isset($_GET['link']) ? base64_decode($_GET['link']) : '';

		$this->curmenu = $this->lv_getcur_level1($opt, $link);
		foreach ($this->MenuParent as $vMenu) {		
			if($this->EnableLinkOrder[$i]==1)
			{
				if(strpos($vgetrun,"@".$this->PreLinkOrder[$i]."@") || $i==0 )//Mục tiêu là xác định user có quyỿn trong mục này không
				{

					if(is_array($this->LinkOrder) && isset($this->LinkOrder[$vRightRun]) && $this->LinkOrder[$vRightRun] == $i)//Menu được trỿn
					{
						$vTemp=$this->RunVisibleall;
						$vTemp=str_replace("#01",$this->MenuParent[$i],$vTemp);
						$vTemp=str_replace("#02",$this->PreLinkOrder[$i],$vTemp);
						$vStrReturn=$vStrReturn.$vTemp;		
						$vStrReturn=str_replace("#04","<!--".$this->PreLinkOrder[$i]."-->",$vStrReturn);						
					}
					else
					{
						$vTemp=$this->RunVisibleall;		
						$vTemp=str_replace("#01",$this->MenuParent[$i],$vTemp);
						$vTemp=str_replace("#02",$this->PreLinkOrder[$i],$vTemp);
						$vStrReturn=$vStrReturn.$vTemp;		
						$vStrReturn=str_replace("#04","<!--".$this->PreLinkOrder[$i]."-->",$vStrReturn);
					}
				}
			}
			
			$i++;
		}
		$preLink = (is_array($this->PreLinkOrder) && isset($this->PreLinkOrder[$i])) ? $this->PreLinkOrder[$i] : '';
		$vStrReturn=str_replace("#04","<!--".$preLink."-->",$vStrReturn);
		return $vStrReturn;				
	}	
	function createframe($vUserRun,$vRightRun,$vlang)
	{
		$vStrReturn="";
		$i=0;
		$vgetrun=$this->getoptionrun;
		foreach ($this->MenuParent as $vMenu) {
			if($this->EnableLinkOrder[$i]==1)
			{
				if(strpos($vgetrun,"@".$this->PreLinkOrder[$i]."@") || $i==0 )//Mục tiêu là xác định user có quyỿn trong mục này không
				{
					$vStrReturn=str_replace("#04","<img src=\"../images/images/button_02.gif\" width=\"6\" height=\"47\" border=\"0\">",$vStrReturn);
					if($this->LinkOrder[$vRightRun]==$i)//Menu được trỿn
					{
						$vTemp=$this->RunVisible;
						$vTemp=str_replace("#01",$this->MenuParent[$i],$vTemp);
						$vTemp=str_replace("#02",str_replace("#01",$vlang,$this->LinkParent[$i]),$vTemp);
						$vStrReturn=$vStrReturn.$vTemp;

						
					}
					else
					{
						$vTemp=$this->RunInvisible;		
						$vTemp=str_replace("#01",$this->MenuParent[$i],$vTemp);
						$vTemp=str_replace("#02",str_replace("#01",$vlang,$this->LinkParent[$i]),$vTemp);
						$vStrReturn=$vStrReturn.$vTemp;	
											
					}
				}
			}
			
			$i++;
		}
		$vStrReturn=str_replace("#04",'<img src="../images/images/spacer.gif" width="1" height="1" border="0">',$vStrReturn);

		return $vStrReturn;
				
	}
	function getmenuchild($vUserRun,$vRightRun,$vlang,&$giatrian,&$lvspt)
	{
		$molv_controlmn=new lv_controlmn();	
		if((int)$_GET['opt']==0 && (int)$_GET['menuopt']==0) return "";
		
		$vstrParent1="
			<ul> 
				#01
			</ul>
";
		$vstrParent1_key="
			<ul style=\"width:100%\"> 
				#01
			</ul>
";
		//Sử dụng cho menu có cấp con
		$vstrParent12_1="
		<li><a href=\"#01\" title=\"#02\" >#03</a>
			<ul >
				#04
			</ul>
		</li>
		";
		$vstrParent12_1_key="
		<li><a class=\"menuleft_con\" href=\"#01\" title=\"#02\" id=\"a_#@stt\" onkeyup=\"KeyMenuRun(event,this,#@stt)\" rev=\"#@level\" name=\"#@child\" onmouseover=\"on_mouse_click(#@stt)\"><span>#03</span></a>
			<ul style=\"display:none\" id=\"ul_a_#@stt\">
				#04
			</ul>
		</li>
		";
		//Sử dụng cho menu không có cấp con
		$vstrParent12_2_key="
		<li><a href=\"#01\" title=\"#02\" id=\"a_#@stt\" onkeyup=\"KeyMenuRun(event,this,#@stt)\" rev=\"#@level\" name=\"#@child\"><span>#03</span></a></li>
		";
		$vstrParent12_2="
		<li><a href=\"#01\" title=\"#02\" >#03</a></li>
		";
		//Sử dụng cho menu có cấp con
		$vstrChild1_1="
		<li><a href=\"#01\" title=\"#02\" >#03</a></li>
		";
		$vstrChild1_1_key="
		<li><a href=\"#01\" title=\"#02\" id=\"a_#@stt\" onkeyup=\"KeyMenuRun(event,this,#@stt)\" rev=\"#@level\" name=\"#@child\"><span>#03</span></a></li>
		";
		//Sử dụng cho menu không có cấp con
		$vstrChild1_2="
		";
		//Sử dụng cho menu  có cấp con
		$vstrChild2="	
		";
		$vhref="?lang=#01&opt=#02&item=#03&link=#04";
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////*****************************//////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////	
		if('admin'==$_SESSION['ERPSOFV2RRight'])
		{
			$vsql="select  A.*  from lv_lv0005 A where lv004=$vRightRun and lv007=1 and lv005=0 order by lv008 asc";
		}
		else
		{	
			$vsql="select  A.*  from lv_lv0005 A inner join lv_lv0008 B on A.lv001=B.lv003 where B.lv002='$vUserRun' and A.lv004=$vRightRun and A.lv007=1 and A.lv005=0  order by A.lv008 asc";
		}
				$lfresult=db_query($vsql);
					$lfi=0;
					$lvfi=1;
				$pstrget="";
				$pstrget_key="";
				$vstrChild1_2_key='';
					$pParentNum=db_num_rows($lfresult);	
					while($lfrow=db_fetch_array($lfresult))
					{
						$pstrpa="";
						$pstrpa_key="";
						$vlv006=$lfrow['lv001'];
						$vrCount=$molv_controlmn->Count($vlv006);						
						$vstrgettext=GetLangRightID($lfrow['lv001'],$vlang);				
						$pstrpa=($vrCount<=0)?$vstrParent12_2:$vstrParent12_1;
						$pstrpa_key=($vrCount<=0)?$vstrParent12_2_key:$vstrParent12_1_key;
						$pstrpa_key=str_replace("#@stt",$lvfi,$pstrpa_key);
						$pstrpa_key=str_replace("#@level",$lfrow['lv007'],$pstrpa_key);
						$pstrpa_key=str_replace("#@child",($vrCount<=0)?'':'1',$pstrpa_key);
						//Lấy liên kết
						$vlink= $vhref;
						$vlink=str_replace("#01",$vlang,$vlink);
						$vlink=str_replace("#02",$vRightRun,$vlink);
						$vlink=str_replace("#03",'',$vlink);
						$vlink=str_replace("#04",base64_encode($lfrow['lv003']),$vlink);
						if($lfi==0) $this->getfirstlink=base64_encode($lfrow['lv003']);
						//Chuyển liên kết vào mục chính
						$pstrpa=str_replace("#01",$vlink,$pstrpa);
						$pstrpa_key=str_replace("#01",$vlink,$pstrpa_key);
						
						//Chuyển chủ đỿ vào liên kết
						$pstrpa=str_replace("#02",$vstrgettext,$pstrpa);
						$pstrpa=str_replace("#03",$vstrgettext,$pstrpa);
						$pstrpa=$pstrpa.str_replace("#01",$lfi,$vstrChild1_2);
						$pstrpa_key=str_replace("#02",$vstrgettext,$pstrpa_key);
						$pstrpa_key=str_replace("#03",$vstrgettext,$pstrpa_key);
						$pstrpa_key=$pstrpa_key.str_replace("#01",$lfi,$vstrChild1_2_key);
						if($vrCount>0){
							$molv_controlmn->RunBuild($vlv006,$vUserRun,$vRightRun,$vlang,$_SESSION['ERPSOFV2RRight'],$lvgiatri1,$lvgiatri2,$lvfi,$giatrian);
							$pstrpa=str_replace("#04",$lvgiatri1,$pstrpa);						
							$pstrpa_key=str_replace("#04",$lvgiatri2,$pstrpa_key);
							//$pstrpa_key=str_replace("#04",$molv_controlmn->RunBuild($vlv006,$vUserRun,$vRightRun,$vlang,$_SESSION['ERPSOFV2RRight']),$pstrpa_key);
						}
				////////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////		
						$pstrget=$pstrget.$pstrpa;
						$pstrget_key=$pstrget_key.$pstrpa_key;
						$lfi++;		
						$lvfi++;					
					}
					if($lfi!=0){
									$pstrget=str_replace("#01",$pstrget,$vstrParent1);
									$pstrget=str_replace("#01",$pstrget,str_replace("#03",GetLangTopBar(5,$vlang),$this->vstrParent));
									$pstrget_key=str_replace("#01",$pstrget_key,$vstrParent1_key);
									$pstrget_key=str_replace("#01",$pstrget_key,str_replace("#03",GetLangTopBar(5,$vlang),$this->vstrParent));
								}
	if(trim($this->getfirstlink)=="") 		$this->getfirstlink	=$molv_controlmn->getfirstlink;
	$lvspt=$lvfi;
	return $pstrget.$pstrget_key;					
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////*****************************//////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
//Mục tiêu hàm là tạo menu con biểu diễn theo danh mục cha
	function getmenuchildall($vUserRun,$vRightRun,$vlang,&$giatrian,&$lvspt)
	{
		$molv_controlmn=new lv_controlmn();	
		if((int)$_GET['opt']==0 && (int)$_GET['menuopt']==0) return "";
		$vstrParent1="
		
			<ul style=\"display:block\" id=\"ul_menu_".$vRightRun."\"> 
				#01
			</ul>
";
		$vstrParent1_key="
			<ul style=\"display:none\"> 
				#01
			</ul>
";
		//Sử dụng cho menu có cấp con
		$vstrParent12_1="
		<li><div style=\"clear:both;overflow:hidden\"><div style=\"float:left\"><a  class=\"#77\" href=\"#01\" title=\"#02\" ><p>#03</p></a></div><div  style=\"float:right;padding-top:8px;padding-right:5px\"><p title=\"click here to open the submenu\" style=\"cursor:pointer\" onclick=\"openchildmenu('level_".$vRightRun."_1_#99')\"><img src=\"../images/expand.png\"/></p></div></div>
			<ul style=\"display:#88;clear:both;\" id=\"level_".$vRightRun."_1_#99\">
				#04
			</ul>
		</li>
		";
		$vstrParent12_1_key="
		<li><a class=\"menuleft_con #77\" href=\"#01\" title=\"#02\" id=\"a_#@stt\" onkeyup=\"KeyMenuRun(event,this,#@stt)\" rev=\"#@level\" name=\"#@child\" onmouseover=\"on_mouse_click(#@stt)\"><span>#03</span></a>
			<ul style=\"display:none\" id=\"ul_a_#@stt\">
				#04
			</ul>
		</li>
		";
		//Sử dụng cho menu không có cấp con
		$vstrParent12_2_key="
		<li><a class=\"#77\" href=\"#01\" title=\"#02\" id=\"a_#@stt\" onkeyup=\"KeyMenuRun(event,this,#@stt)\" rev=\"#@level\" name=\"#@child\"><span>#03</span></a></li>
		";
		$vstrParent12_2="
		<li ><a class=\"#77\" href=\"#01\" title=\"#02\" ><p>#03</p></a></li>
		";
		//Sử dụng cho menu có cấp con
		$vstrChild1_1="
		<li><a class=\"#77\" href=\"#01\" title=\"#02\" ><p>#03</p></a></li>
		";
		$vstrChild1_1_key="
		<li><a class=\"#77\" href=\"#01\" title=\"#02\" id=\"a_#@stt\" onkeyup=\"KeyMenuRun(event,this,#@stt)\" rev=\"#@level\" name=\"#@child\"><span>#03</span></a></li>
		";
		//Sử dụng cho menu không có cấp con
		$vstrChild1_2="
		";
		//Sử dụng cho menu  có cấp con
		$vstrChild2="	
		";
		$vhref="?lang=#01&opt=#02&item=#03&link=#04";
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////*****************************//////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////	
		if('admin'==$_SESSION['ERPSOFV2RRight'])
		{
			$vsql="select  A.*  from lv_lv0005 A where lv004=$vRightRun and A.lv007=1 and A.lv005=0 order by A.lv008 asc";
		}
		else
		{	
			$vsql="select  A.*  from lv_lv0005 A inner join lv_lv0008 B on A.lv001=B.lv003 where B.lv002='$vUserRun' and A.lv004=$vRightRun and A.lv007=1 and A.lv005=0 order by A.lv008 asc";
		}
		$getlink=base64_decode($_GET['link']);
				$lfresult=db_query($vsql);
					$lfi=0;
					$lvfi=1;
					$pstrget="";
					$pstrget_key="";
					$vstrChild1_2_key='';
					$pParentNum=db_num_rows($lfresult);	
					while($lfrow=db_fetch_array($lfresult))
					{
						$pstrpa="";
						$pstrpa_key="";
						$vlv006=$lfrow['lv001'];
						$vrCount=$molv_controlmn->Count($vlv006);						
						$vstrgettext=GetLangRightID($lfrow['lv001'],$vlang);				
						$pstrpa=($vrCount<=0)?$vstrParent12_2:$vstrParent12_1;
						$pstrpa=str_replace('#99',$lvfi,$pstrpa);
						$pstrpa=str_replace('#88',($this->curmenu==$lfrow['lv001'])?'block':'none',$pstrpa);
						if($this->curmenu==$lfrow['lv001']) $this->curmenu_stt="level_".$vRightRun."_1_".$lvfi;
						$pstrpa_key=($vrCount<=0)?$vstrParent12_2_key:$vstrParent12_1_key;
						$pstrpa_key=str_replace("#@stt",$lvfi,$pstrpa_key);
						$pstrpa_key=str_replace("#@level",$lfrow['lv007'],$pstrpa_key);
						$pstrpa_key=str_replace("#@child",($vrCount<=0)?'':'1',$pstrpa_key);
						//Lấy liên kết
						if(trim($lfrow['lv003'])!="")
						{
						$vlink= $vhref;
						$vlink=str_replace("#01",$vlang,$vlink);
						$vlink=str_replace("#02",$vRightRun,$vlink);
						$vlink=str_replace("#03",'',$vlink);
						$vlink=str_replace("#04",base64_encode($lfrow['lv003']),$vlink);
						if($lfi==0) $this->getfirstlink=base64_encode($lfrow['lv003']);
						}
						else
						{

							$vlink="javascript:openchildmenu('level_".$vRightRun."_1_#99')";
							$vlink=str_replace('#99',$lvfi,$vlink);
						}
						//Chuyển liên kết vào mục chính
						$pstrpa=str_replace("#01",$vlink,$pstrpa);
						$pstrpa_key=str_replace("#01",$vlink,$pstrpa_key);
						
						//Chuyển chủ đỿ vào liên kết
						$pstrpa=str_replace("#02",$vstrgettext,$pstrpa);
						$pstrpa=str_replace("#03",$vstrgettext,$pstrpa);
						$pstrpa=$pstrpa.str_replace("#01",$lfi,$vstrChild1_2);
						$pstrpa_key=str_replace("#02",$vstrgettext,$pstrpa_key);
						$pstrpa_key=str_replace("#03",$vstrgettext,$pstrpa_key);
						$pstrpa_key=$pstrpa_key.str_replace("#01",$lfi,$vstrChild1_2_key);
						if($vrCount>0){
							$molv_controlmn->RunBuild($vlv006,$vUserRun,$vRightRun,$vlang,$_SESSION['ERPSOFV2RRight'],$lvgiatri1,$lvgiatri2,$lvfi,$giatrian);
							$pstrpa=str_replace("#04",$lvgiatri1,$pstrpa);						
							$pstrpa_key=str_replace("#04",$lvgiatri2,$pstrpa_key);
							//$pstrpa_key=str_replace("#04",$molv_controlmn->RunBuild($vlv006,$vUserRun,$vRightRun,$vlang,$_SESSION['ERPSOFV2RRight']),$pstrpa_key);
						}
						if($getlink==$lfrow['lv003'] && trim($lfrow['lv003'])!='')// && $getopt==$lfrow['lv004'])
							$pstrpa=str_replace("#77",'menu_cur',$pstrpa);
						else
							$pstrpa=str_replace("#77",'',$pstrpa);
				////////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////		
						$pstrget=$pstrget.$pstrpa;
						$pstrget_key=$pstrget_key.$pstrpa_key;
						$lfi++;		
						$lvfi++;					
					}
					if($lfi!=0){
									$pstrget=str_replace("#01",$pstrget,$vstrParent1);
									$pstrget=str_replace("#01",$pstrget,str_replace("#03",GetLangTopBar(5,$vlang),$this->vstrParent));
									$pstrget_key=str_replace("#01",$pstrget_key,$vstrParent1_key);
									$pstrget_key=str_replace("#01",$pstrget_key,str_replace("#03",GetLangTopBar(5,$vlang),$this->vstrParent));
								}
	if(trim($this->getfirstlink)=="") 		$this->getfirstlink	=$molv_controlmn->getfirstlink;
	$lvspt=$lvfi;
	return $pstrget.$pstrget_key;					
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////*****************************//////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
//Lấy mảng hai chiỿu những quyỿn của user	
	function getrightrun($vUserRun)
	{
		$strRetrun=" @";
		$vsql="";
		if('admin'==$_SESSION['ERPSOFV2RRight'])
		{
			$vsql="select distinct A.lv004  from lv_lv0005 A where A.lv005!=2";
		}
		else
		{
			$vsql=$vsql."select distinct A.lv004,A.lv005 from lv_lv0008 B inner join lv_lv0005 A on B.lv003=A.lv001 where B.lv002='$vUserRun' and B.lv004=1";
		}
		$tresult=db_query($vsql);
		while($trow=db_fetch_array($tresult))
		{			
			$strRetrun=$strRetrun.$trow['lv004']."@";	
		}
		return $strRetrun;
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Hàm láy mục điỿu khiển thông dụng
////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	function getTopBar($vUserRun,$plang)
	{
		$vStrReturn="";
		if(trim($vUserRun)=="") return "";	
		$sql_count="select count(*) num from ml_lv0001 where lv002=1 and lv012=0 and lv011=1 and lv017 in (".$this->GetBuilStringExc($vUserRun,'lv003').")";
		$tresult=db_query($sql_count);
		$lv_row=db_fetch_array($tresult);
		$this->getoptionrun=$this->getoptionrun."@0@2@3@4@";
		$vStrReturn="
		<li><a href=\"?".getsaveget($plang,4,"","","",1,0,0,0)."\" target=\"_self\"><font class=lvfuncview >".GetLangTopBar(3,$plang)."</font></a></li>
			  ";
		return $vStrReturn;
	}
	function GetBuilStringExc($vUserID,$vField)
	{
		$vsql="select $vField from ml_lv0008 where lv002='$vUserID'";
		$vresult=db_query($vsql);
		$strReturn="";
		if($vresult)
		{
			while($vrow=db_fetch_array($vresult))
			{
		   		if($strReturn=="") $strReturn="'".$vrow["$vField"]."'";
				else $strReturn=$strReturn.",'".$vrow["$vField"]."'";
			}
			if($strReturn=='') return "''";
			return $strReturn;
		}
		if($strReturn=='') return "''";
	}
	function FillSessionEmpty()
	{
		$_SESSION['lv-opt']=NULL;
		$_SESSION['lv-item']=NULL;
		$_SESSION['lv-link']=NULL;
		$_SESSION['lv-group']=NULL;
		$_SESSION['lv-itemlst']=NULL;
		$_SESSION['lv-childlst']=NULL;
		$_SESSION['lv-level3lst']=NULL;
		$_SESSION['lv-child3lst']=NULL;
		$_SESSION['lv-lang']=NULL;
	}
	function FillSession($vlink)
	{
		$_SESSION['lv-opt']=NULL;
		$_SESSION['lv-item']=NULL;
		$_SESSION['lv-link']=NULL;
		$_SESSION['lv-group']=NULL;
		$_SESSION['lv-itemlst']=NULL;
		$_SESSION['lv-childlst']=NULL;
		$_SESSION['lv-level3lst']=NULL;
		$_SESSION['lv-child3lst']=NULL;
		$_SESSION['lv-lang']=NULL;
		$vArrayLink=explode("&",str_replace("?","",$vlink));
		foreach($vArrayLink as $vrow)
		{
			$vtext=explode("=",$vrow);
			if($vtext[0]!="" && $vtext!=NULL)		$_SESSION['lv-'.$vtext[0]]=$vtext[1];
		}
		
	}
	function lv_getfavoriteone($vUserRun,$plang)
	{
	 return	"<ul id=\"menu2-nav\"><li class=\"menusubT2\"><a href=\"\" target=\"_self\"><font class=lvfuncview><p style='margin-top:-4px;'>".GetLangTopBar(8,$plang)." /</p></font></a>".$this->lv_getfavorite($vUserRun,$plang)."</li></ul>";
	}
	function lv_getstrlimit()
	{
	
	}
	function lv_getfavoritefull($vUserRun,$plang,&$vArrLink)
	{	
		$str_returnstart='
		<ul class="qlyfullmenu">';
		$vsql="select * from lv_lv0010 where lv002='$vUserRun' order by lv005 asc";
		$tresult=db_query($vsql);
		$i=1;
		$vtrue=false;
		$vlinks=$_GET['link'];
		if($vlinks=='' || $vlinks==NULL)
		{
			$vName='<div class="csshomeicon" title="Trang chủ"></div>';
			$vtrue=true;
			$vArrLink[$i][0]='?'.$_SERVER["QUERY_STRING"];
			$vArrLink[$i][1]=true;
			$str_return='<li style="cursor:pointer;" id="lvtabli_'.$i.'" class="lifullmenucur"  ondblclick="runtrangchu();//setviewtabload('.$i.')"  onclick="runtrangchu();//setviewtab('.$i.')"><div style="overflow:hidden;position:relavtive;">'.$vName.'</div></li>'.$str_return;
			$i++;
		}
		else
		{
			$vName='<div class="csshomeicon" title="Trang chủ"></div>';
			$vtrue=true;
			$vArrLink[$i][0]='?&lang='.$plang;
			$vArrLink[$i][1]=true;
			$str_return='<li id="lvtabli_'.$i.'" class="lifullmenucur"  ondblclick="runtrangchu();//setviewtabload('.$i.')"  onclick="runtrangchu();//setviewtab('.$i.')"><div style="overflow:hidden;position:relavtive;">'.$vName.'</div></li>'.$str_return;
			$i++;
		}
		while($trow=db_fetch_array($tresult))
		{		
			if("?".$_SERVER['QUERY_STRING']!=$trow['lv004'])
			{
				$vArrLink[$i][0]=$trow['lv004'];
				if($i==2 && (($vlinks=='' || $vlinks==NULL) && ($vitemlst==NULL || $vitemlst=='')))
					$vArrLink[$i][1]=true;
				else
					$vArrLink[$i][1]=false;
				$str_return=$str_return.'<li id="lvtabli_'.$i.'" class="lifullmenu" ondblclick="setviewtabload('.$i.')" onclick="setviewtab('.$i.')" title="'.$trow['lv003'].'"><div style="padding:4px;overflow:hidden;position:relavtive;"  title="'.$trow['lv003'].'">'.$trow['lv003'].'<div class="hvclose" style="position:absolute;top:0;right:0" onclick="RemoveFavoriteTab(\''.$trow['lv004'].'\')"></div></div></li>';
				$i++;
			}
			else
			{
				$vtrue=true;
				$vArrLink[$i][0]=$trow['lv004'];
				$vArrLink[$i][1]=true;
				$str_return=$str_return.'<li id="lvtabli_'.$i.'" class="lifullmenucur" ondblclick="setviewtabload('.$i.')" onclick="setviewtab('.$i.')" title="'.$trow['lv003'].'"><div style="padding:4px;overflow:hidden;position:relavtive;"  title="'.$trow['lv003'].'">'.$trow['lv003'].'<div class="hvclose" style="position:absolute;top:0;right:0" onclick="RemoveFavoriteTab(\''.$trow['lv004'].'\')"></div></div></li>';
				$i++;
			}
		}
		if($vtrue==false) 
		{
			$vlinks=$_GET['link'];
			if(($vlinks=='' || $vlinks==NULL) && ($vitemlst==NULL || $vitemlst==''))
			{
				$vtrue=false;
			}
			else
			{
				$vName=$this->lv_getcur_link(base64_decode($vlinks));
				$vtrue=true;
				$vArrLink[$i][0]='?'.$_SERVER["QUERY_STRING"];
				$vArrLink[$i][1]=true;
				$str_return='<li id="lvtabli_'.$i.'" class="lifullmenucur"  ondblclick="setviewtabload('.$i.')"  onclick="setviewtab('.$i.')" title="'.$vName.'"><div style="padding:4px;overflow:hidden;position:relavtive;" title="'.$vName.'">'.$vName.'<div class="hvadd" style="position:absolute;top:0;right:0" onclick="javascript:AddFavorite()"></div></div></li>'.$str_return;
			}
		}
		$str_return=$str_return.'
		</ul>
		';
		return $str_returnstart.$str_return;
	}
	function lv_getfavorite($vUserRun,$plang)
	{
		$str_return='
		<ul id="submenu2-nav">';
		$vsql="select * from lv_lv0010 where lv002='$vUserRun' order by lv005 asc";
		$tresult=db_query($vsql);
		
		if ($tresult) {
			while($trow=db_fetch_array($tresult))
		{			
			$str_return=$str_return.'<li class="menuT"><a href="'.$trow['lv004'].'"><p>'.$trow['lv003'].'</p></a></li>';
		}
		$str_return=$str_return.'
		</ul>
		';
		return $str_return;
   
		}
		
	}
	function lv_updatefavorite($vUserRun,$vTitle,$vlink)
	{
		if($this->lv_checkfavorite($vUserRun,$vlink)==false)
		{
			return true;
			$tsql="insert into lv_lv0010 (lv002,lv003,lv004,lv005) values ('$vUserRun','".sof_escape_string($vTitle)."','$vlink',1)";
			return db_query($tsql);
		}
		return false;		
	}
	function lv_deletefavorite($vUserRun,$vlink)
	{

		$tsql="delete from lv_lv0010 where lv002='$vUserRun' and lv004='$vlink'";
		return db_query($tsql);
	}
	function lv_deleteall($vUserRun)
	{

		$tsql="delete from lv_lv0010 where lv002='$vUserRun'";
		return db_query($tsql);
	}
	function lv_checkfavorite($vUserRun,$vlink)
	{
		$vsql="select lv001 from lv_lv0010 where lv002='$vUserRun' and lv004='$vlink'";
		$tresult=db_query($vsql);
		$trow=db_fetch_array($tresult);
		if(is_array($trow) && isset($trow['lv001']) && $trow['lv001'] !== NULL && $trow['lv001'] !== "")
		 return true;
		return false;
	}
	function lv_checkfavorite_name($vUserRun,$vlink,$plang)
	{
		$vsql="select lv001 from lv_lv0005 where lv003='$vlink'";
		$tresult=db_query($vsql);
		if($tresult)
		{
			$trow=db_fetch_array($tresult);
			if(trim($trow['lv001'])=="") return '!';
			$vCodeID=$trow['lv001'];
			return GetLangRightID($vCodeID,$plang);
		}
		return "!";
	}
	function lv_getcur_level1($opt,$link)
	{
		$vsql="select  *  from lv_lv0005  where lv003='$link' and lv004='$opt'";
		$tresult=db_query($vsql);
		$trow=db_fetch_array($tresult);
		if(is_array($trow) && isset($trow['lv001']) && $trow['lv001'] !== NULL && $trow['lv001'] !== "")
		{
			if($trow['lv001']==$trow['lv006']) return "";
			if($trow['lv007']==1)
				return $trow['lv001'];
			else
				return $this->lv_getcur_level($trow['lv006']);
		}
		else
		{
			return '';
		}
	}
	function lv_getcur_level($vNode)
	{
		$vsql="select  A.*  from lv_lv0005 A where A.lv001='$vNode'";
		$tresult=db_query($vsql);
		$trow=db_fetch_array($tresult);
		if($trow['lv001']!=NULL && $trow['lv001']!="" )
		{
			if($trow['lv001']==$trow['lv006']) return "";
			if($trow['lv007']==1)
				return $trow['lv001'];
			else
				return $this->lv_getcur_level($trow['lv006']);
		}
		else
		{
		return '';
		
		}
		
	}
	function lv_getcur_link($vlink)
	{
		$vsql="select  A.*  from lv_lv0005 A where A.lv003='$vlink'";
		$tresult=db_query($vsql);
		$trow=db_fetch_array($tresult);
		if($trow['lv001']!=NULL && $trow['lv001']!="" )
		{
			return GetLangRightID($trow['lv001'],strtoupper($_GET['lang']));
		}
		else
		{
			return '';
		}
	}
	public function LV_GetAlarm()
	{
		return '';
		$vStrReturn="";
		//Check alarm thành viên mới.
		$vsql="select A.lv001,DATEDIFF(curdate(),A.lv030) SoNgay,A.lv009,A.lv006 from hr_lv0020 A where A.lv001='".$_SESSION['userlogin_smcd']."'";
		$tresult=db_query($vsql);
		$trow=db_fetch_array($tresult);
		if($trow['lv001']!=NULL && $trow['lv001']!="" )
		{
			if($trow['SoNgay']<=3)
			{
				$vStrReturn="SOF chúc mừng thành viên mới!";
			}
			elseif($trow['SoNgay']<=10 && $trow['SoNgay']>=7 && $trow['lv009']==1)
			{
				$vSoNgay=(10-$trow['SoNgay']);
				if($vSoNgay<=0) $vSoNgay=1;
				$vStrReturn="Hồ sơ của bạn đã quá 7 ngày chưa duyệt. Còn ".($vSoNgay)." ngày nửa hệ thống sẽ tự động khoá tài khoản của bạn. Xin vui lòng liên hệ gấp SOF để giải quyết!";
			}
			if(trim($trow['lv006'])!='')
			{
				$vStrReturn=$vStrReturn."(".$trow['lv006'].")";
			}
		}
		return $vStrReturn;
	}
	function LV_GetLevel($vStaffID)
	{
		$lvsql="select lv019,lv025 from  hr_lv0020 Where lv001='$vStaffID'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			if($vrow['lv019']=='' || $vrow['lv019']==null)
				return $vrow['lv025'];
			else
				return $vrow['lv019'];
		}
		return 'AA';
	} 
	function  LV_TaiLieuThanhVien($vStaffID)
	{
		return;
		$vStrReturn='';
			$vThuHang=$this->ThuHangHienTai;
			$sqlS = "SELECT  * FROM hr_lv0221 WHERE  lv006=1 and ( (concat(',',lv007,',') like '%,$vThuHang,%') )  order by lv009 ASC";
			$bResult = db_query($sqlS);
			$vOrder=0;
			while ($vrow = db_fetch_array ($bResult)){
				if($vrow['lv003']==0)
				{
					$vStrReturn=$vStrReturn."<div onclick=\"closepopchinhanh()\" style=\"width:100%;height:100%;;border-color:#CCCCCC;cursor:pointer;color:black;\"><br/>".$vrow['lv002'].'<br/></div>';
				}
				else
					$vStrReturn=$vStrReturn."<img name=\"imgView\" border=\"0\" onclick=\"closepopchinhanh()\" style=\"width:100%;height:auto;;border-color:#CCCCCC;cursor:pointer\" title=\"\" alt=\"Image\" src=\"hr_lv0221/readfile.php?ContractID=".$vrow['lv001']."&type=8&size=0\" />";

			}
			
		return $vStrReturn;
	}
	public function LV_GetLinkCN()
	{
		$vStrReturn='';
		if('admin'==$_SESSION['ERPSOFV2RRight'])
		{
			$lvsql="select  * from  lv_lv0012 where lv001!='$this->chinhanh'";
		}
		else
		{
			$lvsql="select  * from  lv_lv0012 where lv001!='$this->chinhanh'";
		}
		$str_return="";
		$vresult=db_query($lvsql);
		
		while($vrow=db_fetch_array($vresult))
		{
			//$vLinkChiNhanh=str_replace($this->chinhanh,'',$_SERVER['PHP_SELF']);
			$vLink=$vrow['lv003'];	
			$vLink=str_replace('{domain}',$_SERVER['SERVER_NAME'],$vLink);
			$vLink=str_replace('{request}',$_SERVER['QUERY_STRING'],$vLink);
			$vHref='<div style="float:left;padding-left:20px;padding-top:20px;;cursor:pointer;"><a href="'.$vLink.'">
			<div class="licafe" style="width:130px;height:130px;">
				<div style="padding:5px;padding-top:10px;text-align:center;">
					<font style="font-size:20px">'.$vrow['lv002'].'</font>
					<br/>
					<font style="font-size:10px">Đ/C:'.$vrow['lv004'].'</font>
				</div>
			</div>
			
			</a></div>';
			$vStrReturn=$vStrReturn.$vHref;
		}
		$vHref='<div style="float:left;padding-left:20px;padding-top:20px;">
			<div class="licafe" style="width:130px;height:130px;cursor:pointer;" onclick="closepopchinhanh()">
				<div style="padding:15px;padding-top:50px;font-size:20px;text-align:center;">ĐÓNG</div>
			</div>
			</div>';
		$vStrReturn=$vStrReturn.$vHref;
		return $vStrReturn;
	}

}
?>
