<?php
class rp_lv0006 extends lv_controler{
	var $vRowHeader="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"tdhprint\" width=\"10%\" align=\"center\"><b>@02</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@03</b></td>
				<td class=\"tdhprint\" width=\"25%\" align=\"center\"><b>@04</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@05</b></td>
				<td class=\"tdhprint\" width=\"*\" align=\"center\"><b>@06</b></td>
			</tr>
		@01
		</table>";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	var $vRowHeaderAll="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"tdhprint\" width=\"10%\" align=\"center\"><b>@02</b></td>
				<td class=\"tdhprint\" width=\"15%\" align=\"center\"><b>@03</b></td>
				<td class=\"tdhprint\" width=\"*\" align=\"center\"><b>@04</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@05</b></td>
				<td class=\"tdhprint\" width=\"15%\" align=\"center\"><b>@06</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@07</b></td>
			</tr>
		@01
		</table>";
		//,lv097,lv098
	public $DefaultFieldList="lv001,lv030,lv029,lv002,lv100,lv103,lv308,lv309,lv201,lv202,lv203,lv204,lv205,lv206,lv207,lv208,lv209,lv210,lv211,lv212,lv101,lv102,lv213";	
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ReportYear=null;
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv024"=>"25","lv025"=>"26","lv026"=>"27","lv027"=>"28","lv028"=>"29","lv029"=>"30","lv030"=>"31","lv031"=>"32","lv032"=>"33","lv033"=>"34","lv034"=>"35","lv035"=>"36","lv036"=>"37","lv037"=>"38","lv038"=>"39","lv039"=>"40","lv040"=>"41","lv041"=>"42","lv042"=>"43","lv043"=>"44","lv044"=>"45","lv097"=>"98","lv098"=>"99","lv100"=>"101","lv101"=>"47","lv102"=>"48","lv103"=>"104","lv201"=>"202","lv202"=>"203","lv203"=>"204","lv204"=>"205","lv205"=>"206","lv206"=>"207","lv207"=>"208","lv208"=>"209","lv209"=>"210","lv210"=>"211","lv211"=>"212","lv212"=>"213","lv213"=>"214","lv308"=>"309","lv309"=>"310");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"2","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"2","lv016"=>"0","lv017"=>"0","lv018"=>"0","lv019"=>"0","lv020"=>"0","lv021"=>"2","lv022"=>"0","lv023"=>"0","lv024"=>"0","lv025"=>"0","lv026"=>"0","lv027"=>"0","lv028"=>"0","lv029"=>"0","lv030"=>"2","lv031"=>"0","lv032"=>"0","lv033"=>"0","lv034"=>"0","lv035"=>"0","lv036"=>"0","lv037"=>"0","lv038"=>"0","lv039"=>"0","lv040"=>"0","lv041"=>"0","lv042"=>"0","lv043"=>"0","lv044"=>"2","lv097"=>"10","lv098"=>"10","lv100"=>"10","lv101"=>"10","lv102"=>"10","lv103"=>"10","lv201"=>"10","lv202"=>"10","lv203"=>"10","lv204"=>"10","lv205"=>"10","lv206"=>"10","lv207"=>"10","lv208"=>"10","lv209"=>"10","lv210"=>"10","lv211"=>"10","lv212"=>"10","lv213"=>"0","lv308"=>"10","lv309"=>"10");
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;	
	 	$this->isFil=1;	
	
		$this->isApr=0;		
		$this->isUnApr=0;
		$this->lang=$_GET['lang'];
		
	}
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
	
	protected function GetCondition()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and A.lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and A.lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and A.lv009 in ('".str_replace(",","','",$this->lv009)."')";
		if($this->lv010!="")  $strCondi=$strCondi." and A.lv010 like '%$this->lv010%'";
		if($this->lv011!="")  $strCondi=$strCondi." and A.lv011 like '%$this->lv011%'";
		if($this->lv012!="")  $strCondi=$strCondi." and A.lv012 like '%$this->lv012%'";
		if($this->lv013!="")  $strCondi=$strCondi." and A.lv013 like '%$this->lv013%'";
		if($this->lv014!="")  $strCondi=$strCondi." and A.lv014 like '%$this->lv014%'";
		if($this->lv015!="")  $strCondi=$strCondi." and A.lv015 like '%$this->lv015%'";
		if($this->lv016!="")  $strCondi=$strCondi." and A.lv016 like '%$this->lv016%'";
		if($this->lv017!="")  $strCondi=$strCondi." and A.lv017 like '%$this->lv017%'";
		if($this->lv018!="")  $strCondi=$strCondi." and A.lv018 like '%$this->lv018%'";
		if($this->lv019!="")  $strCondi=$strCondi." and A.lv019 like '%$this->lv019%'";
		if($this->lv020!="")  $strCondi=$strCondi." and A.lv020 like '%$this->lv020%'";
		if($this->lv021!="")  $strCondi=$strCondi." and A.lv021 like '%$this->lv021%'";
		if($this->lv022!="")  $strCondi=$strCondi." and A.lv022 like '%$this->lv022%'";
		if($this->lv023!="")  $strCondi=$strCondi." and A.lv023 like '%$this->lv023%'";
		if($this->lv024!="")  $strCondi=$strCondi." and A.lv024 like '%$this->lv024%'";
		if($this->lv025!="")  $strCondi=$strCondi." and A.lv025 like '%$this->lv025%'";
		if($this->lv026!="")  $strCondi=$strCondi." and A.lv026 like '%$this->lv026%'";
		if($this->lv027!="")  $strCondi=$strCondi." and A.lv027 like '%$this->lv027%'";
		if($this->lv028!="")  $strCondi=$strCondi." and A.lv028 like '%$this->lv028%'";
		if($this->lv029!="")  $strCondi=$strCondi." and A.lv029 in ('".str_replace(",","','",$this->lv029)."')";
		if($this->lv030!="")  $strCondi=$strCondi." and A.lv030 like '%$this->lv030%'";
		if($this->lv031!="")  $strCondi=$strCondi." and A.lv031 like '%$this->lv031%'";
		if($this->lv032!="")  $strCondi=$strCondi." and A.lv032 like '%$this->lv032%'";
		if($this->lv033!="")  $strCondi=$strCondi." and A.lv033 like '%$this->lv033%'";
		if($this->lv034!="")  $strCondi=$strCondi." and A.lv034 like '%$this->lv034%'";
		if($this->lv035!="")  $strCondi=$strCondi." and A.lv035 like '%$this->lv035%'";
		if($this->lv036!="")  $strCondi=$strCondi." and A.lv036 like '%$this->lv036%'";
		if($this->lv037!="")  $strCondi=$strCondi." and A.lv037 like '%$this->lv037%'";
		if($this->lv038!="")  $strCondi=$strCondi." and A.lv038 like '%$this->lv038%'";
		if($this->lv039!="")  $strCondi=$strCondi." and A.lv039 like '%$this->lv039%'";
		if($this->lv040!="")  $strCondi=$strCondi." and A.lv040 like '%$this->lv040%'";
		if($this->lv041!="")  $strCondi=$strCondi." and A.lv041 like '%$this->lv041%'";
		if($this->lv042!="")  $strCondi=$strCondi." and A.lv042 like '%$this->lv042%'";
		if($this->lv043!="")  $strCondi=$strCondi." and A.lv043 like '%$this->lv043%'";
		if($this->lv044!="")  $strCondi=$strCondi." and A.lv044 like '%$this->lv044%'";
		if($this->isStaffOff==1)  $strCondi=$strCondi." AND year(A.lv044)<2014 ";
		return $strCondi;
	}
	function SumSQLRun($vSQL,$vColpan,$vLang,$plang)
	{
		$vtr="<tr onDblClick=\"this.innerHTML=''\" style=\"cursor:move;font-size:20px;font-weight:bold\"><td class=\"right_hr\" colspan=\"$vColpan\" valign=\"top\" >$vLang: @01</td></tr>";
		$bResultS = db_query($vSQL);
		$vValue="";
		while($arrS=db_fetch_array($bResultS)){		
			if($vValue=="") $vValue=Lcurrency($arrS['SumQty'],$plang).$arrS['Unitlv002'];
			else $vValue=$vValue." ; ".Lcurrency($arrS['SumQty'],$plang).$arrS['Unitlv002'];
		}
		if($vValue!="") return  str_replace("@01",$vValue,$vtr);
		return "";
	}
	function LV_FN($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$strSort=" Order by lv029 asc,lv001 asc";
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
		$lvTable="<div align=\"center\" ondblclick=\"this.innerHTML=''\"><img  src=\"".$this->GetLogo()."\" style=\"max-width:1024px\" /></div>
		<table  align=\"center\" class=\"lvtable\" border=1>
		@#01
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
			
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$lvImg="<td  ><img name=\"imgView\" border=\"0\" style=\"border-color:#CCCCCC\" title=\"\" alt=\"Image\" width=\"96px\" height=\"128px\" src=\"../../images/employees/@01/@02\" /></td>";
		$sqlS = "SELECT A.*,B.lv003 lv100,B.lv099 lv101,B.lv008 lv103  FROM hr_lv0020 A left join tc_lv0008 B on A.lv001=B.lv002 And B.lv005='$this->ReportYear' WHERE 1=1  ".$this->GetCondition()." $strSort ";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;	
			}
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$lineFN_current=0;
			for($i=0;$i<count($lstArr);$i++)
			{
				if($lstArr[$i]=='lv007')
				{
					$vTemp=str_replace("@02",$vrow[$lstArr[$i]],str_replace("@01",$vrow['lv001'],$lvImg));

				}
				elseif($lstArr[$i]=='lv101')
				{
					$lineFN_current=$this->get_count_codeid($vrow['lv001']);
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $lineFN_current,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				elseif($lstArr[$i]=='lv102')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $vrow['lv100']-$lineFN_current,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);	
	}
	function LV_GetInforYear($vEmpID,$vYear)
	{
		
		$lvsql="select * from  tc_lv0008 Where lv002='$vEmpID' and lv005='$vYear'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		return $vrow;
		
	}
	function LV_GetTangP($vTN,$vSN=5)
	{
		return $this->LV_GetChan($vTN/$vSN);
		if($vTN>=$vSN)
			return $vTN-$vSN+1;
		else
			return 0;
		
	}
	function LV_GetChan($vvalue)
	{
		$vArr=explode(".",$vvalue);
		return $vArr[0];
	}
	function LV_FN_Main($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$vOpt='',$vType=1)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
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
		<table  align=\"center\" class=\"lvtable\" border=1>
		@#01
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
			
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$lvTdBold="<td align=@#05><span style=\"color:red\"><strong>@02</strong></font></td>";
		$lvImg="<td  ><img name=\"imgView\" border=\"0\" style=\"border-color:#CCCCCC\" title=\"\" alt=\"Image\" width=\"96px\" height=\"128px\" src=\"../../images/employees/@01/@02\" /></td>";
		$strSort=" order by B.lv103,A.lv008";
		$sqlS = "SELECT A.*  FROM hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 WHERE 1=1  ".$this->GetCondition()." $strSort ";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		for($i=0;$i<count($lstArr);$i++)
			{
				
				switch($lstArr[$i])
				{
					case 'lv100':
						$vTemp=str_replace("@01","5%",$lvTdH);
						break;
					case 'lv101':
						$vTemp=str_replace("@01","5%",$lvTdH);
						break;
					case 'lv102':
						$vTemp=str_replace("@01","5%",$lvTdH);
						break;
					case 'lv103':
						$vTemp=str_replace("@01","5%",$lvTdH);
						break;
					case 'lv104':
						$vTemp=str_replace("@01","5%",$lvTdH);
						break;
					case 'lv098':
						$vTemp=str_replace("@01","5%",$lvTdH);
						break;
					case 'lv097':
						$vTemp=str_replace("@01","5%",$lvTdH);
						break;
					default:
						$vTemp=str_replace("@01","",$lvTdH);
						break;
				}
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$lineFN_current=0;
			$lineFN_Year=$this->get_count_codeidyear($vrow['lv001'],$this->ReportYear,'01');
			$vObjFN=$this->LV_GetInforYear($vrow['lv001'],$this->ReportYear);
			$vDaDungDK=$vObjFN['lv101'];
			//Đẩy dữ dữ liệu PN qua phép chính
			$vObjFN['lv100']=$vObjFN['lv200'];
			if($vType==2)
			{
				$vObjFN['lv100']=7;
				//Tổng phép ca năm
				$vObjFN['lv008']=0;
				$vObjFN['lv208']=0;
				$vObjFN['lv309']=0;
				$vDaDungDK=$vObjFN['lv201'];
			}
			$lineFN_current1=$this->get_count_codeidmonth($vrow['lv001'],$this->ReportYear,'01');
			$lineFN_current2=$this->get_count_codeidmonth($vrow['lv001'],$this->ReportYear,'02');
			$lineFN_current3=$this->get_count_codeidmonth($vrow['lv001'],$this->ReportYear,'03');
			$vTongPhepDaDungT1den3=$lineFN_current1+$lineFN_current2+$lineFN_current3;
			//echo $vType;
			if($vType!=2)
			{
				//echo $vrow['lv001']."=>".$vTongPhepDaDungT1den3.'>='.$vObjFN['lv008'].'<br/>';
				/*if(substr($this->DateCurrent,0,7)<=$this->ReportYear.'-03')
				{
					if($vTongPhepDaDungT1den3>$vObjFN['lv008'])
					{
						$vObjFN['lv208']=$vObjFN['lv008'];
					}
					else
						$vObjFN['lv208']=$vTongPhepDaDungT1den3;
						
					$lvsql = "Update tc_lv0008 set lv208='".$vObjFN['lv208']."' WHERE lv002='".$vrow['lv001']."' and lv005='".($this->ReportYear)."'";//$lvsql = "Update tc_lv0008 set lv100='$vPLast',lv101='$vCLLast'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";
					$vReturn= db_query($lvsql);
				}
				else*/
				{
					if($vTongPhepDaDungT1den3>=$vObjFN['lv008'] || $vObjFN['lv008']==0)
					{
						$vObjFN['lv208']=0;
						
					}
					else
					{
						if($vObjFN['lv208']!=($vObjFN['lv008']-$vTongPhepDaDungT1den3))
						{
							$vObjFN['lv208']=$vObjFN['lv008']-$vTongPhepDaDungT1den3;
							
						}
					}
				}
				if(substr($this->DateCurrent,0,7)<=$this->ReportYear.'-03')
				{
					$vObjFN['lv309']=0;
					$lvsql = "Update tc_lv0008 set lv208='".$vObjFN['lv309']."' WHERE lv002='".$vrow['lv001']."' and lv005='".($this->ReportYear)."'";//$lvsql = "Update tc_lv0008 set lv100='$vPLast',lv101='$vCLLast'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";
					$vReturn= db_query($lvsql);
				}
				else
				{
					$vObjFN['lv309']=$vObjFN['lv208'];
					$lvsql = "Update tc_lv0008 set lv208='".$vObjFN['lv309']."' WHERE lv002='".$vrow['lv001']."' and lv005='".($this->ReportYear)."'";//$lvsql = "Update tc_lv0008 set lv100='$vPLast',lv101='$vCLLast'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";
					$vReturn= db_query($lvsql);
				}
			}
			for($i=0;$i<count($lstArr);$i++)
			{
			
				switch($lstArr[$i])
				{
				case 'lv201':
						
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $lineFN_current1,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				case 'lv202':
						
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $lineFN_current2,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;	
				case 'lv203':
						
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $lineFN_current3,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				case 'lv204':
						$lineFN_current=$this->get_count_codeidmonth($vrow['lv001'],$this->ReportYear,'04');
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $lineFN_current,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				case 'lv202':
						$lineFN_current=$this->get_count_codeidmonth($vrow['lv001'],$this->ReportYear,'01');
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $lineFN_current,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				case 'lv205':
						$lineFN_current=$this->get_count_codeidmonth($vrow['lv001'],$this->ReportYear,'05');
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $lineFN_current,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				case 'lv206':
						$lineFN_current=$this->get_count_codeidmonth($vrow['lv001'],$this->ReportYear,'06');
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $lineFN_current,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				case 'lv207':
						$lineFN_current=$this->get_count_codeidmonth($vrow['lv001'],$this->ReportYear,'07');
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $lineFN_current,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				case 'lv208':
						$lineFN_current=$this->get_count_codeidmonth($vrow['lv001'],$this->ReportYear,'08');
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $lineFN_current,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				case 'lv209':
						$lineFN_current=$this->get_count_codeidmonth($vrow['lv001'],$this->ReportYear,'09');
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $lineFN_current,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				case 'lv210':
						$lineFN_current=$this->get_count_codeidmonth($vrow['lv001'],$this->ReportYear,'10');
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $lineFN_current,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				case 'lv211':
						$lineFN_current=$this->get_count_codeidmonth($vrow['lv001'],$this->ReportYear,'11');
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $lineFN_current,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				case 'lv212':
						$lineFN_current=$this->get_count_codeidmonth($vrow['lv001'],$this->ReportYear,'12');
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $lineFN_current,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				case 'lv007':
						$vTemp=str_replace("@02",$vrow[$lstArr[$i]],str_replace("@01",$vrow['lv001'],$lvImg));
						break;
				case 'lv101':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vDaDungDK+$lineFN_Year,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				case 'lv097':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vObjFN['lv097'],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				case 'lv098':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vObjFN['lv098'],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				case 'lv102':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $vObjFN['lv100']+$vObjFN['lv008']-$vDaDungDK-$lineFN_Year-$vObjFN['lv309'],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTdBold,(int)$this->ArrView[$lstArr[$i]]));//$vrow['lv100']+$vrow['lv103']+$vObjFN['lv097']-$vObjFN['lv098']-$lineFN_Year
						break;
				case 'lv100':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $vObjFN['lv100'],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));//$vrow['lv100']+$vrow['lv103']+$vObjFN['lv097']-$vObjFN['lv098']-$lineFN_Year
						break;
				case 'lv309':
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $vObjFN['lv309'],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));//$vrow['lv100']+$vrow['lv103']+$vObjFN['lv097']-$vObjFN['lv098']-$lineFN_Year
					break;
				case 'lv308':
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $vObjFN['lv008']-$vObjFN['lv208'],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));//$vrow['lv100']+$vrow['lv103']+$vObjFN['lv097']-$vObjFN['lv098']-$lineFN_Year
					break;
				case 'lv103':
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView( $vObjFN['lv008'],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));//$vrow['lv100']+$vrow['lv103']+$vObjFN['lv097']-$vObjFN['lv098']-$lineFN_Year
					break;
				default:
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);	
	}
	private function get_count_codeid($vempid)
	{
		$numfn=0;
		$sqlS="select sum(IF(B.lv007='$this->KCodeID',1,0.5)) numfn from tc_lv0011 B inner join tc_lv0010 A on A.lv001=B.lv002 and A.lv002='$vempid' where B.lv100<>1 and B.lv007 in ($this->TCCodeID)";
		$bResult = db_query($sqlS);
		$vrow = db_fetch_array ($bResult);
		$numfn=$numfn+$vrow['numfn'];
		$sqlS="select sum(IF(B.lv008='$this->KCodeID',1,0.5)) numfn from tc_lv0011 B inner join tc_lv0010 A on A.lv001=B.lv002 and A.lv002='$vempid' where B.lv100<>1 and B.lv008 in ($this->TCCodeID)";
		$bResult = db_query($sqlS);
		$vrow = db_fetch_array ($bResult);
		$numfn=$numfn+$vrow['numfn'];
		return $numfn;
		
	}
	private function get_count_codeidmonth($vempid,$vyear,$vmonth)
	{
		$numfn=0;
		$sqlS="select sum(IF(B.lv007='$this->KCodeID',1,0.5)) numfn from tc_lv0011 B inner join tc_lv0010 A on A.lv001=B.lv002 and A.lv002='$vempid' where B.lv100<>1 and B.lv007 in ($this->TCCodeID) and year(B.lv004)='$vyear' and month(B.lv004)='$vmonth'";
		$bResult = db_query($sqlS);
		$vrow = db_fetch_array ($bResult);
		$numfn=$numfn+$vrow['numfn'];
		$sqlS="select sum(IF(B.lv008='$this->KCodeID',1,0.5)) numfn from tc_lv0011 B inner join tc_lv0010 A on A.lv001=B.lv002 and A.lv002='$vempid' where B.lv100<>1 and B.lv008 in ($this->TCCodeID) and year(B.lv004)='$vyear' and month(B.lv004)='$vmonth'";
		$bResult = db_query($sqlS);
		$vrow = db_fetch_array ($bResult);
		$numfn=$numfn+$vrow['numfn'];
		return $numfn;
		
	}
	private function get_count_codeidyear($vempid,$vyear)
	{
		$sqlS="select sum(IF(B.lv007='$this->KCodeID',1,0.5)) numfn from tc_lv0011 B inner join tc_lv0010 A on A.lv001=B.lv002 and A.lv002='$vempid' where  B.lv100<>1 and B.lv007 in ($this->TCCodeID) and year(B.lv004)='$vyear'";
		$bResult = db_query($sqlS);
		$vrow = db_fetch_array ($bResult);
		$numfn=$numfn+$vrow['numfn'];
		$sqlS="select sum(IF(B.lv008='$this->KCodeID',1,0.5)) numfn from tc_lv0011 B inner join tc_lv0010 A on A.lv001=B.lv002 and A.lv002='$vempid' where  B.lv100<>1 and B.lv008 in ($this->TCCodeID) and year(B.lv004)='$vyear'";
		$bResult = db_query($sqlS);
		$vrow = db_fetch_array ($bResult);
		$numfn=$numfn+$vrow['numfn'];
		return $numfn;
	}
	function GetBuilCalendar($vEmployeeID,$vField)
	{
		$vsql="select $vField from tc_lv0010 where lv002='$vEmployeeID'";
		$vresult=db_query($vsql);
		$strReturn="";
		if($vresult)
		{
			while($vrow=db_fetch_array($vresult))
			{
		   		if($strReturn=="") $strReturn="'".$vrow["$vField"]."'";
				else $strReturn=$strReturn.",'".$vrow["$vField"]."'";
			}
			return $strReturn;
		}
	}
	public function GetBuilCheckListDep($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002')
	{
		$vListID=",".$vListID.",";
		$strTbl="<table  align=\"center\" class=\"lvtable\">
		<input type=\"hidden\" id=$vID name=$vID value=\"@#02\">
		@#01
		</table>
		";
		$lvChk="<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH="<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>
			
		</tr>
		";
		$vsql="select * from  ".$vTbl." where lv002='SOF' order by lv103 asc";
		$strGetList="";
		$strGetScript="";
		$i=0;
		$vresult=db_query($vsql);
		$numrows=db_num_rows($vresult);
		while($vrow=db_fetch_array($vresult))		
		{

			$strTempChk=str_replace("@01",$i,$lvChk);
			$strTempChk=str_replace("@02",$vrow['lv001'],$strTempChk);
			if(strpos($vListID,",".$vrow['lv001'].",") === FALSE)
				$strTempChk=str_replace("@03","",$strTempChk);
			else
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			
			$strTempChk=str_replace("@04",$vrow['lv003'],$strTempChk);
			
			$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
			$strTemp=str_replace("@#02",$vrow[$vFieldView]."(".$vrow['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
			
						$i++;
						$vsql1="select * from  ".$vTbl." where lv002='".$vrow['lv001']."' order by lv003";
						$vresult1=db_query($vsql1);
						$numrows=$numrows+db_num_rows($vresult1);
						while($vrow1=db_fetch_array($vresult1))		
						{
							$strTempChk=str_replace("@01",$i,$lvChk);
							$strTempChk=str_replace("@02",$vrow1['lv001'],$strTempChk);
							if(strpos($vListID,",".$vrow1['lv001'].",") === FALSE)
								$strTempChk=str_replace("@03","",$strTempChk);
							else
								$strTempChk=str_replace("@03","checked=checked",$strTempChk);
							
							$strTempChk=str_replace("@04",'&nbsp;&nbsp;&nbsp;'.$vrow1['lv003'],$strTempChk);
							
							$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
							$strTemp=str_replace("@#02",'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$vrow1[$vFieldView]."(".$vrow1['lv001'].")",$strTemp);
							$strGetScript=$strGetScript.$strTemp;
										$i++;
							
						}
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
	public function GetBuilCheckList($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002')
	{
		$vListID=",".$vListID.",";
		$strTbl="<table  align=\"center\" class=\"lvtable\">
		<input type=\"hidden\" id=$vID name=$vID value=\"@#02\">
		@#01
		</table>
		";
		$lvChk="<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH="<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>
			
		</tr>
		";
		$vsql="select * from  ".$vTbl;
		$strGetList="";
		$strGetScript="";
		$i=0;
		$vresult=db_query($vsql);
		$numrows=db_num_rows($vresult);
		while($vrow=db_fetch_array($vresult))		
		{

			$strTempChk=str_replace("@01",$i,$lvChk);
			$strTempChk=str_replace("@02",$vrow['lv001'],$strTempChk);
			if(strpos($vListID,",".$vrow['lv001'].",") === FALSE)
				$strTempChk=str_replace("@03","",$strTempChk);
			else
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			
			$strTempChk=str_replace("@04",$vrow['lv003'],$strTempChk);
			
			$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
			$strTemp=str_replace("@#02",$vrow[$vFieldView]."(".$vrow['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
						$i++;
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
	public function LV_LinkField($vFile,$vSelectlv001)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectlv001),2));
	}
private function sqlcondition($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  lv_lv0004";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0022";
				break;
			case 'lv017':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0021";
				break;
			case 'lv022':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014";
				break;
			case 'lv023':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0016";
				break;
			case 'lv024':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0017";
				break;
			case 'lv025':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0015";
				break;
			case 'lv026':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0007";
				break;
			case 'lv027':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0004";
				break;
			case 'lv028':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0005";
				break;
			case 'lv029':
				$vsql="select lv001,CONCAT(lv003,'[',lv002,']') lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002";
				break;
			case 'lv031':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014";
				break;
			case 'lv032':
				$vsql="select lv001,CONCAT(lv002,'[',lv003,']') lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0023	";
				break;
			case 'lv106':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0002";
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
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  lv_lv0004 where lv001='$vSelectID'";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0022 where lv001='$vSelectID'";
				break;
			case 'lv017':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0021 where lv001='$vSelectID'";
				break;
			case 'lv022':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014 where lv001='$vSelectID'";
				break;
			case 'lv023':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0016 where lv001='$vSelectID'";
				break;
			case 'lv024':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0017 where lv001='$vSelectID'";
				break;
			case 'lv025':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0015 where lv001='$vSelectID'";
				break;
			case 'lv026':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0007 where lv001='$vSelectID'";
				break;
			case 'lv027':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0004 where lv001='$vSelectID'";
				break;
			case 'lv028':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0005 where lv001='$vSelectID'";
				break;
			case 'lv029':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002 where lv001='$vSelectID'";
				break;
			case 'lv031':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014  where lv001='$vSelectID'";
				break;
			case 'lv032':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from hr_lv0023 	 where lv001='$vSelectID'";
				break;
			case 'lv106':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from tc_lv0002 	 where lv001='$vSelectID'";
				break;
			default:
				$vsql ="";
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