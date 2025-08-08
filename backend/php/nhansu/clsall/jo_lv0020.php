<?php
/////////////coding jo_lv0020///////////////
class   jo_lv0020 extends lv_controler
{
	public $lv001=null;
	public $lv002=null;
	public $lv003=null;
	public $lv004=null;
	public $lv005=null;
	public $lv006=null;
	public $lv007=null;
	public $lv008=null;
	public $lv009=null;
	public $lv010=null;
	public $lv028=null;
	public $lv029=null;
	public $lvNVID=null;
	public $lvShiID=null;
	public $lvReShiID=null;
	public $month=null;
	public $year=null;
	public $is_tc09_add=null;
	public $is_tc09_apr=null;
	public $ArrTC=null;
	public $ArrTCEmp=null;

///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='jo_lv0020';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"2","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0");	

	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=0;
		$this->isRpt=0;	
		
	 	$this->isHelp=1;	
		$this->isConfig=0;
	 	$this->isFil=0;	
		$this->isDel=0;
		$this->lang=$_GET['lang'];
		
	}
	protected function LV_CheckLock()
	{
		$lvsql="select lv005 from  tc_lv0009 Where lv003=month('$this->lv004') and lv004=year('$this->lv004')";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if($vrow['lv005']>=1)
			{
				$this->isAdd=0;	
				$this->isEdit=0;	
				$this->isDel=0;	
			}
		}
		
	}
	function LV_Load()
	{
		$vsql="select * from  tc_lv0011";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv001=$vrow['lv001'];
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];
			$this->lv007=$vrow['lv007'];
			$this->lv008=$vrow['lv008'];
			$this->lv009=$vrow['lv009'];
			$this->lv010=$vrow['lv010'];
			
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  tc_lv0011 Where lv001='$vlv001'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv001=$vrow['lv001'];
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];	
			$this->lv007=$vrow['lv007'];
			$this->lv008=$vrow['lv008'];
			$this->lv009=$vrow['lv009'];
			$this->lv010=$vrow['lv010'];
			
		}
	}
	//////////get view///////////////
	function GetView()
	{
		return $this->isView;
	}//////////get view///////////////
	function GetRpt()
	{
		return $this->isRpt;
	}
	//////////get view///////////////
	function GetAdd()
	{
		return $this->isAdd;
	}	
	//////////get edit///////////////
	function GetEdit()
	{
		return $this->isEdit;
	}	
	//////////get edit///////////////
	function GetApr()
	{
		return $this->isApr;
	}		
	//////////get edit///////////////
	function GetUnApr()
	{
		return $this->isUnApr;
	}	
	function SetAllDisiable()
	{
		$this->isAdd=0;
		$this->isEdit=0;
		$this->isApr=0;
		$this->isUnApr=0;
		
	}
	//////////Get Filter///////////////
	protected function GetCondition()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and lv010 like '%$this->lv010%'";
		if($this->lvNVID!="") $strCondi=$strCondi." and lv002 IN (select B.lv001 from tc_lv0010 B where B.lv002='$this->lvNVID')";	
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM tc_lv0011 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	/////////////////////ListFieldExport//////////////////////////
	function ListFieldExport($lvFrom,$lvList,$maxRows)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=",".$lvList.",";
		$lstArr=explode(",",$this->DefaultFieldList);
		$lvSelect="<ul id=\"menu1-nav\" onkeyup=\"return CheckKeyCheckTabExp(event)\">
						<li class=\"menusubT1\"><img src=\"$this->Dir../images/lvicon/export.png\" border=\"0\" />".$this->ArrFunc[12]."
							<ul id=\"submenu1-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript="		
		<script language=\"javascript\">
		function Export(vFrom,value)
		{
			".$lvFrom.".action='".$this->Dir."sL_lv0067/?func=rpt&lang=".$this->lang."&childfunc='+value+'&ID=".base64_encode($this->lv002)."&NVID=".$this->lvNVID."&YearMonth=".$this->lv004."&txtlv029=".$this->lv029."&txtlv001=".$this->lv001."'
			".$lvFrom.".target='_blank';
			".$lvFrom.".submit();
			".$lvFrom.".target='_self';
			//window.open('".$this->Dir."sL_lv0067/?lang=".$this->lang."&childfunc='+value+'&ID=".base64_encode($this->lv002)."&NVID=".$this->lvNVID."&YearMonth=".$this->lv004."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
		}
		
		</script>
";
		$lvScript="<li class=\"menuT\"> @01 </li>";
		$lvexcel="<input class=lvbtdisplay type=\"button\" id=\"lvbuttonexcel\" value=\"".$this->ArrFunc[13]."\" onclick=\"Export($lvFrom,'excel')\">";
		$lvpdf="<input class=lvbtdisplay type=\"button\" id=\"lvbutton\" value=\"".$this->ArrFunc[15]."\" onclick=\"Export($lvFrom,'pdf')\">";
		$lvword="<input class=lvbtdisplay type=\"button\" id=\"lvbutton\" value=\"".$this->ArrFunc[14]."\" onclick=\"Export($lvFrom,'word')\">";
		$strGetList="";
		$strGetScript="";
		
		$strTemp=str_replace("@01",$lvexcel,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strTemp=str_replace("@01",$lvword,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strTemp=str_replace("@01",$lvpdf,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strReturn=str_replace("@#01",$strGetScript,$lvSelect).$strScript;
		return $strReturn;
		
	}
	//////////////////////Buil list////////////////////
	function Get_String_DateFromTo()
	{
		$this->lvHeader="";
		$strTD="";
		$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
		$datecur=$this->datefrom;
		$childfunc=$_GET['childfunc'];
		$vNow=GetServerDate();
		for($i=1;$i<=$lvNumDate+1;$i++)
		{
			$vdayofw=GetDayOfWeek($datecur);
			if($vdayofw==1) 
				$color='yellow';
			else if($vdayofw==7) 
				$color='orange';
			else 
				$color='white';
			if($childfunc=="rpt"  || $childfunc=="excel" || $childfunc=="word" || $childfunc=="pdf")
				{
					if($_GET['day']=='')
						$this->lvHeader=$this->lvHeader.'<td class="lvhtable" align="center"><b><font color="'.$color.'">'.Fillnum($i,2).'</font></b></td>';
					else
						$this->lvHeader=$this->lvHeader.'<td class="lvhtable" align="center"><b><font color="'.$color.'">'.$this->FormatView($datecur,2).'</font></b></td>';						
				}
			else
				$this->lvHeader=$this->lvHeader.'<td class="lvhtable" align="center"><b><font color="'.$color.'">'.Fillnum($i,2).'</font></b></td>';
				if($vNow==$datecur)
					$strTD=$strTD.'<td align="center" class="calenda_contentcur"><div class="calenda_contentcur">'."<!--".str_replace("/","-",$datecur)."-->".'</div></td>';
				else
					$strTD=$strTD.'<td align="center"><div class="calenda_content">'."<!--".str_replace("/","-",$datecur)."-->".'</div></td>';
			$datecur=ADDDATE($this->datefrom,$i);
		}
		return $strTD;
	}

	function Get_Arr_Employees()
	{
		$this->ArrEmp=array();
		$this->ArrEmpBack=array();
		$strTd=$this->Get_String_DateFromTo();
		$lvcondition="";	
		if($this->lv028!="") 
		{
			$lsguser=$this->LV_GetChildDep($this->lv028);
			$strCondi=$strCondi." AND DD.lv029 in (".$lsguser.")";
		}
		if($this->lv029!="")  $strCondi=$strCondi." AND DD.lv029 in ('".str_replace(",","','",$this->lv029)."')";		
		if($this->lv001!="")  $strCondi=$strCondi." AND DD.lv001 in ('".str_replace(",","','",$this->lv001)."')";		
		$lvsql="select distinct B.lv001 CodeID,B.lv002 Name from sl_lv0003_1 A inner join jo_lv0019 B on A.lv002=B.lv001 inner join hr_lv0020 DD on A.lv010=DD.lv001  where month(A.lv006)='$this->month' and year(A.lv006)='$this->year' $strCondi";
		$vresult=db_query($lvsql);	
		$i=0;
		while($vrow=db_fetch_array($vresult))
		{
			$this->ArrEmp[$i][0]=$vrow['CodeID'];
			$this->ArrEmp[$i][1]=$vrow['Name'];
			$this->ArrEmp[$i][2]=$vrow['Dep'];
			$this->ArrEmp[$i][3]=$vrow['HeSoL'];
			$this->ArrEmp[$i][4]=$vrow['DangGia'];
			$this->ArrEmp[$i][5]=$this->Str_DateFromTo;
			$this->ArrEmp[$i][6]=$strTd;
			$this->ArrEmp[$i][7]=$vrow['Locks'];
			$this->ArrEmp[$i][8]=$vrow['MonthID'];
			$this->ArrEmpBack[$vrow['CodeID']]=$i;
			$i++;
		}
	}
	function LV_GetTimeCard()
	{
		$vArr=Array();
		$vsql="select * from tc_lv0002 order by lv001";
		$bResult=db_query($vsql);
		$i=0;
		while ($vrow = db_fetch_array ($bResult)){
			$vArr[$i]['lv001']=$vrow['lv001'];
			$vArr[$i]['lv002']=$vrow['lv001'];
			$i++;
		}
		return $vArr;
	}
	function LV_GetRate()
	{
		$vArr=Array();
		$vsql="select lv001, lv003 lv002 from  tc_lv0025 where lv002 in (select A.lv001 from tc_lv0013 A where A.lv011=1) ";
		$bResult=db_query($vsql);
		$i=1;
		$vArr[0]['lv001']='';
		$vArr[0]['lv002']='';
		while ($vrow = db_fetch_array ($bResult)){
			$vArr[$i]['lv001']=$vrow['lv001'];
			$vArr[$i]['lv002']=$vrow['lv002'];
			$i++;
		}
		return $vArr;
	}
	function CreateSelectArr($vArr,$vID)
	{
		if(count($vArr)==0) return '';
		$strReturn="";
		$strOption='<option value="@01" @03>@02</option>';
		foreach($vArr as $row)
		{
		$lvTemp=str_replace("@01",$row['lv001'],$strOption);
		$lvTemp=str_replace("@03",($row['lv001']==$vID)?'selected="selected"':'',$lvTemp);
		$lvTemp=str_replace("@02",$row['lv002'],$lvTemp);
		$strReturn=$strReturn.$lvTemp;
		}
		return $strReturn;
	}
	function GetValueArr($vArr,$vID)
	{
		if($vID=="") return "&nbsp";
		if(count($vArr)==0) return '&nbsp';
		foreach($vArr as $row)
		{
			if($row['lv001']==$vID) return $row['lv002'];
		}
		return '&nbsp'	;
	}
	function LV_GetChildDep($vDepID)
	{
		if($vDepID=="") return '';
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		$vsql="select lv001 from  hr_lv0002 where lv002 in ($vReturn) order by lv103 asc";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			$vReturn=$vReturn.",'".$vrow['lv001']."'";
		}
		return $vReturn;
	}
	public function LV_GetChildDepSelect($vDepID,$vSelectID)
	{
		if($vDepID=="") 
		{
			$vDepID='SAPA';
			$vsql="select lv001,lv003 from  hr_lv0002 where lv002='$vDepID' order by lv003";
			$bResult=db_query($vsql);
			while ($vrow = db_fetch_array ($bResult)){
				$vReturn=$vReturn."<option value='".$vrow['lv001']."' ".(($vSelectID==$vrow['lv001'])?'selected="selected"':'').">".$vrow['lv003']."</option>";
				$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow['lv001']."' order by lv003";
				$bResult1=db_query($vsql);
				while ($vrow1 = db_fetch_array ($bResult1)){
					
					$vReturn=$vReturn."<option value='".$vrow1['lv001']."' ".(($vSelectID==$vrow1['lv001'])?'selected="selected"':'').">&nbsp;&nbsp;&nbsp;&nbsp;".$vrow1['lv003']."</option>";
				}
			}
		}
		else
		{
		if(strpos($vDepID,",")===false) $vReturn="<option value='".$vDepID."'>".$vDepID."</option>";
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		$vsql="select lv001,lv003 from  hr_lv0002 where (lv001 in ($vReturn) or lv002 in ($vReturn))  order by lv003";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			
			$vReturn=$vReturn."<option value='".$vrow['lv001']."' ".(($vSelectID==$vrow['lv001'])?'selected="selected"':'').">&nbsp;&nbsp;&nbsp;&nbsp;".$vrow['lv003']."</option>";
		}
		}
		return $vReturn;
	}
	function LV_BuilListReportOtherPrintLateSoon($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvopt,$lvgt=0,$vFocus)
	{		
		$this->Get_Arr_Employees();
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=$lvList.",lv012";
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$strSort="";
		switch($lvSortNum)
		{
			case 0:
				break;
			case 1:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"asc");
				break;
			case 2:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"desc");
				break;
		}
		$lvTable="
		<table  align=\"center\" class=\"lvtable\" border=1 id=\"table1\">
		@#01
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
			
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% class=@#04>@03</td>
			@#01
		</tr>
		";
		$lvul='
			<ul>
				<li>@#02</li>
				<li><p onclick="viewpopcalendar(\'@#01\')" style="cursor:pointer">@#03</p></li>
				<li><div id="calendarview_@#01" class="viewcalandar" style="display:none;clear:both;">
					<div style="float:left;width:90%">
				@#04
					</div>
					<div style="float:right;width:10%;color:red;cursor:pointer;overflow:hidden;"><p onclick="closepopcalendar(\'@#01\')"><img width="20" src="images/icon/close.png"/></p></div>
				</div></li>
			</ul>
		';
		$lvHref="@02";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=@#04>@02</td>";
		if($this->lv028!="") 
		{
			$lsguser=$this->LV_GetChildDep($this->lv028);
			$strCondi=$strCondi." AND DD.lv029 in (".$lsguser.")";
		}
		if($this->lv029!="")  $strCondi=$strCondi." AND DD.lv029 in ('".str_replace(",","','",$this->lv029)."')";		
		if($this->lv001!="")  $strCondi=$strCondi." AND DD.lv001 in ('".str_replace(",","','",$this->lv001)."')";		
		$lvsql="select A.*,B.lv001 CodeID,B.lv002 Name from sl_lv0003_1 A inner join jo_lv0019 B on A.lv002=B.lv001  inner join hr_lv0020 DD on A.lv010=DD.lv001  where month(A.lv006)='$this->month' and year(A.lv006)='$this->year' $strCondi";
		$vorder=$curRow;
		$bResult = db_query($lvsql);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		switch ($lvgt)
				{
					case 0:
					$vArr=$this->LV_GetTimeCard();
					break;
					case 1:
					$vArr[1]['lv001']='';
					$vArr[1]['lv002']='';
					$vArr[2]['lv001']='1';
					$vArr[2]['lv002']='1';
					break;
				}
		$an=rand(0,1);
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
		while ($vrow = db_fetch_array ($bResult)){
			$lvvt=$this->ArrEmpBack[$vrow['CodeID']];
			$strL="";
			$vorder++;
			$lvstrgt="";
				switch ($lvgt)
				{
					case 0:
						/*if($this->isEdit==1)
							$lvstrgt='<select style="width:49px;font-size:10px;background-color:#@@99" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'" id="timecard_'.$vrow['TimeCardId'].'" onblur="runchangetime(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)">'.$this->CreateSelectArr($vArr,$vrow['lv007']).'</select>';
						else*/
						$lvstrgt=(trim($vrow['lv003'])=="")?"&nbsp;":$vrow['lv003'];
						$this->ArrTC[$vrow['lv007']]=(int)$this->ArrTC[$vrow['lv007']]+1;
						$this->ArrTCEmp[$vrow['CodeID']][$vrow['lv007']]=(int)$this->ArrTCEmp[$vrow['CodeID']][$vrow['lv007']]+1;
						break;
					case 1:
						/*if($this->isEdit==1)
							$lvstrgt='<select style="width:49px;font-size:10px;background-color:#@@99" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'"  onblur="runchangetime(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)">'.$this->CreateSelectArr($vArr,$vrow['lv010']).'<select>';
						else*/
							$lvstrgt=(trim($vrow['lv010'])=="")?"&nbsp;":$vrow['lv010'];
						$this->ArrTC[$vrow['lv010']]=(int)$this->ArrTC[$vrow['lv010']]+1;
						$this->ArrTCEmp[$vrow['CodeID']][$vrow['lv010']]=(int)$this->ArrTCEmp[$vrow['CodeID']][$vrow['lv010']]+1;
						
						break;
				}
				$vsaveul=$lvul;
				$vicon=$this->LV_GetIcon($vrow['lv009']);
				if($vicon!="") 
					{
						if(strpos($vicon,"http:")===false)
							$vsaveul=str_replace("@#02",'<img src="images/icon/'.$vicon.'" style="width:20px;"/>',$vsaveul);
						else
							$vsaveul=str_replace("@#02",'<img src="'.$vicon.'" style="width:20px;"/>',$vsaveul);
					}
					else
							$vsaveul=str_replace("@#02",'',$vsaveul);
				
				$vsaveul=str_replace("@#03",$lvstrgt,$vsaveul);
				$lvnote='
					Người liên hệ:'.$vrow['lv004'].'<br/>
					Điện thoại liên hệ:'.$vrow['lv005'].'<br/>
					Ngày liên hệ:'.$vrow['lv006'].'<br/>
					Giờ liên hệ:'.$vrow['lv011'].'<br/>
					Khoản thời gian gặp:'.$vrow['lv012'].'<br/>
					Nội dung:'.$vrow['lv008'].'<br/>
					Người đề xuất:'.$vrow['lv010']."-".$this->getvaluelink('lv009',$vrow['lv010']).'<br/>
					'.(($vrow['lv013']==1)?'
					Hơp đồng: <span style="cursor:pointer;font-weight:bold" onclick="Report(\''.$vrow['lv014'].'\')">'.$vrow['lv014'].'</span>
					':'').'
				';
				$vsaveul=str_replace("@#04",$lvnote,$vsaveul);
				$vsaveul=str_replace("@#01",$vorder,$vsaveul);
				$this->ArrEmp[$lvvt][6]=str_replace("<!--".$vrow['lv006']."-->",$vsaveul."<!--".$vrow['lv006']."-->",$this->ArrEmp[$lvvt][6]);
			
			}
		return $this->Get_BuildList_Array($lvFrom);
	}
	function LV_GetIcon($vTypeID)
	{
		$vsql="select lv003 from  sl_lv0068 where lv001='$vTypeID' ";
		$bResult=db_query($vsql);
		$vrow = db_fetch_array ($bResult);
		return $vrow['lv003'];
	}
	function LV_GetTCEmp($vEmpID)
	{
		$str="";
		$values=$this->ArrTCEmp[$vEmpID];
		if($values!=NULL) 
		{
			uksort($values, 'strcasecmp');
			while (list($key, $value) = each($values)) { 	
			if($str=="")
				$str=$str.$key."(".$value.")";
			else
				$str=$str." | ".$key."(".$value.")";
			}
		}
		if($str=="") return "&nbsp;";
		return $str;
	}
	function LV_GetTCEmpSum($vEmpID)
	{
		$vCode="'1','11','2','22','3','33','H','VS','VS11','VS22','VS3','VS33','CT'";
		$return=0;
		$values=$this->ArrTCEmp[$vEmpID];
		if($values!=NULL) 
		{
			while (list($key, $value) = each($values)) { 	
				if(!(strpos($vCode,"'".$key."'")===false)) $return=$return+(int)$value;
				
			}
		}
		return $return;
	}
	function Get_BuildList_Array($lvFrom)
	{
	$this->isAdd=0;
	$this->isEdit=0;
	$childfunc=$_GET['childfunc'];
	$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
	if($childfunc=="rpt" || $childfunc=="excel" || $childfunc=="word"  || $childfunc=="pdf" )
	{
		
			$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\" id=\"tabletc\">
			<tr height=\"30px\">
				<td class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[1]."</b></td><td class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[2]."</b></td><td class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[4]."</b></td>".$this->lvHeader."<td class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[30]."</b></td>
			</tr>
			@01
		</table>
		";
	}
	else
	{

			$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\" id=\"tabletc\">
			<tr height=\"30px\" class='lvhtable'>
				<td class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[1]."</b></td><td class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[2]."</b></td><td class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[4]."</b></td></td>".$this->lvHeader."<td class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[4]."</b></td>	
			</tr>
			@01
			<tr ><td colspan=\"".($lvNumDate+2)."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"4\" align=right>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</td></tr>
		</table>
		";
	}
		$vArr=$this->LV_GetRate();
		$lvListTrAll="";
		for($i=0;$i<count($this->ArrEmp);$i++)
		{
			if($i%2==0) $color='#fff';
			else $color='#EAEAEA';
			$vp_col1="<td nowrap='nowrap' align=\"right\">".$i."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td>";
		
			$vp_col4=str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][6]);
			$vp_col4=str_replace("#@@99",$color,$vp_col4);
			$lvListTrAll=$lvListTrAll."<tr style='background-color:".$color."'>$vp_col1".$vp_col4."<td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td></tr>";

		}
		return str_replace("@01",$lvListTrAll,$vTable);
	}
	function Get_BuildList_ArrayShift()
	{
		if($this->lvSort==1)
		$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			@01
		</table>
		";
		else
			$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			@01
		</table>
		";
		$lvListTrAll="";
		for($i=0;$i<count($this->ArrEmp);$i++)
		{
			if($this->lvSort==1)
				$lvListTrAll=$lvListTrAll."<tr><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][2]."</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][4])."</tr>";	
			else
				$lvListTrAll=$lvListTrAll."<tr><td nowrap='nowrap'>".$this->ArrEmp[$i][2]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][4])."</tr>";
		}
		return str_replace("@01",$lvListTrAll,$vTable);
	}
	public function LV_LinkField($vFile,$vSelectID)
	{
		switch($vFile)
		{
			case 'lv007':
			case 'lv010':
				return($this->CreateSelect($this->sqlcondition($vFile,$vSelectID),4));
				break;
			default:
				return($this->CreateSelect($this->sqlcondition($vFile,$vSelectID),0));
				break;
		}
	}
	private function sqlcondition($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0002 order by lv001";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";				
			case 'lv010':
				$vsql="
				select '' lv001,'Không an com' lv002,IF('0'='$vSelectID',1,0) lv003 
				union
				select '1' lv001,'Ðã an' lv002,IF('1'='$vSelectID',1,0) lv003 ";
				break;
			case 'lv099':
				$vsql="select lv001, lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0025 where lv002 in (select A.lv001 from tc_lv0013 A where A.lv011=1) ";				
				break;
			case 'lv029':
				$vsql="select lv001,CONCAT(lv003,'[',lv002,']') lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002";
				break;
		}
		return $vsql;
	}
	public function getvaluelink($vFile,$vSelectID)
	{
		if (!empty($this->ArrGetValueLink[$vFile][$vSelectID][0] ?? null)) {return $this->ArrGetValueLink[$vFile][$vSelectID][1] ?? null;}
		if($vSelectID=="")
		{
			return $vSelectID;
		}
		switch($vFile)
		{
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0002 where lv001='$vSelectID'";
				$lvopt=4;
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv029':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002 where lv001='$vSelectID'";
				break;
			
		}
		if($vsql=="")
		{
			return $vSelectID;
		}
		else
		{
			$lvResult = db_query($vsql);
			$this->ArrGetValueLink[$vFile][$vSelectID][0]=true;
		}
		while($row= db_fetch_array($lvResult)){
			$this->ArrGetValueLink[$vFile][$vSelectID][1]=($lvopt==0)?$row['lv002']:(($lvopt==1)?$row['lv001']."(".$row['lv002'].")":(($lvopt==2)?$row['lv002']."(".$row['lv001'].")":$row['lv001']));
			return $this->ArrGetValueLink[$vFile][$vSelectID][1];
		}
		
	}
	
}
?>