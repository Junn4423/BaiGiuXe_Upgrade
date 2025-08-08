<?php
class rp_lv0013 extends lv_controler{
	public $DefaultFieldList="lv001,lv058,lv002,lv007,lv003,lv004,lv005,lv006,lv008,lv051,lv052,lv053,lv054,lv055,lv074,lv075,lv076,lv077,lv078,lv079,lv011,lv072,lv010,lv012,lv025,lv013,lv014,lv019,lv093,lv018,lv023,lv015,lv016,lv017,lv020,lv021,lv022,lv092,lv024,lv026,lv027,lv028,lv029,lv030,lv031,lv032,lv033,lv034,lv035,lv036,lv037,lv038,lv039,lv040,lv041,lv042,lv043,lv044,lv045,lv046,lv047,lv048,lv049,lv050,lv009,lv056,lv057,lv059,lv060,lv061,lv062,lv063,lv064,lv065,lv066,lv067,lv068,lv069,lv070,lv071,lv073,lv080,lv100,lv101,lv090,lv091";	
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv024"=>"25","lv025"=>"26","lv026"=>"27","lv027"=>"28","lv028"=>"29","lv029"=>"30","lv030"=>"31","lv031"=>"32","lv032"=>"33","lv033"=>"34","lv034"=>"35","lv035"=>"36","lv036"=>"37","lv037"=>"38","lv038"=>"39","lv039"=>"40","lv040"=>"41","lv041"=>"42","lv042"=>"43","lv043"=>"44","lv044"=>"45","lv045"=>"46","lv046"=>"47","lv047"=>"48","lv048"=>"49","lv049"=>"50","lv050"=>"51","lv051"=>"52","lv052"=>"53","lv053"=>"54","lv054"=>"55","lv055"=>"56","lv056"=>"57","lv057"=>"58","lv058"=>"59","lv059"=>"60","lv060"=>"61","lv061"=>"62","lv062"=>"63","lv063"=>"64","lv064"=>"65","lv065"=>"66","lv066"=>"67","lv067"=>"68","lv068"=>"69","lv069"=>"70","lv070"=>"71","lv071"=>"72","lv072"=>"73","lv073"=>"74","lv074"=>"75","lv075"=>"76","lv076"=>"77","lv077"=>"78","lv078"=>"79","lv079"=>"80","lv080"=>"81","lv081"=>"82","lv082"=>"83","lv083"=>"84","lv084"=>"85","lv085"=>"86","lv086"=>"87","lv087"=>"88","lv088"=>"89","lv089"=>"90","lv090"=>"91","lv091"=>"92","lv092"=>"93","lv093"=>"94","lv100"=>"101","lv101"=>"102");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"2","lv004"=>"2","lv005"=>"2","lv006"=>"1","lv007"=>"0","lv008"=>"10","lv009"=>"10","lv010"=>"10","lv011"=>"10","lv012"=>"10","lv013"=>"10","lv014"=>"10","lv015"=>"10","lv016"=>"10","lv017"=>"10","lv018"=>"10","lv019"=>"10","lv020"=>"10","lv021"=>"10","lv022"=>"10","lv023"=>"10","lv024"=>"10","lv025"=>"10","lv026"=>"10","lv027"=>"10","lv028"=>"10","lv029"=>"10","lv030"=>"10","lv030"=>"10","lv031"=>"10","lv032"=>"10","lv033"=>"10","lv034"=>"10","lv035"=>"10","lv036"=>"10","lv037"=>"10","lv038"=>"10","lv039"=>"10","lv040"=>"10","lv041"=>"10","lv042"=>"10","lv043"=>"10","lv044"=>"10","lv045"=>"10","lv046"=>"10","lv047"=>"10","lv048"=>"10","lv049"=>"10","lv050"=>"10","lv051"=>"10","lv052"=>"10","lv053"=>"10","lv054"=>"10","lv055"=>"10","lv056"=>"0","lv057"=>"0","lv058"=>"0","lv059"=>"0","lv060"=>"0","lv061"=>"0","lv062"=>"0","lv063"=>"10","lv064"=>"10","lv065"=>"10","lv066"=>"10","lv067"=>"10","lv068"=>"10","lv069"=>"0","lv070"=>"10","lv071"=>"10","lv072"=>"10","lv073"=>"10","lv074"=>"10","lv075"=>"10","lv076"=>"10","lv077"=>"10","lv078"=>"10","lv079"=>"10","lv080"=>"10","lv081"=>"10","lv082"=>"10","lv083"=>"10","lv083"=>"10","lv084"=>"10","lv085"=>"10","lv086"=>"10","lv087"=>"10","lv088"=>"10","lv090"=>"10","lv091"=>"10","lv092"=>"10","lv093"=>"10","lv100"=>"0","lv101"=>"0");	
		
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
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ReportYear=null;
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

		return $strCondi;
	}
	protected function GetConditionOrther()
	{
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		//if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->datefrom!="")  $strCondi=$strCondi." and A.lv004  >= ADDDATE('$this->datefrom',-1)";
		if($this->dateto!="")  $strCondi=$strCondi." and A.lv004  <= ADDDATE('$this->dateto',1)";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and A.lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and A.lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and A.lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and A.lv010 like '%$this->lv010%'";
		if($this->lv028!="")  $strCondi=$strCondi." and A.lv002 in (".$this->GetMultiValue("select CC.lv001 from tc_lv0010 CC where CC.lv002 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv009 in ('".str_replace(",","','",$this->lv028)."')").")").")";
		if($this->lv029!="") 
		{
			$lsgdepart=$this->LV_GetDep($this->lv029);
			if($this->isDept==1)
				$strCondi=$strCondi." and C.lv029 not in ($lsgdepart)";
			else
				$strCondi=$strCondi." and C.lv029 in ($lsgdepart)";
		}
		if($this->lv029_!="") 
		{
			$lsgdepart=$this->LV_GetDep($this->lv029_);
			if($this->isDept==1)
				$strCondi=$strCondi." and C.lv029 not in ($lsgdepart)";
			else
				$strCondi=$strCondi." and C.lv029 in ($lsgdepart)";
		} 
		if($this->lv030!="")  $strCondi=$strCondi." and A.lv002 in (".$this->GetMultiValue("select CC.lv001 from tc_lv0010 CC where CC.lv002 in ('".$this->lv030."')").")";
		return $strCondi;
	}
	function LV_GetDep($vDepID)
	{
		if($vDepID=="") return '';
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		//if($this->isChildCheck=="") $this->isChildCheck=1;
		if($this->isChildCheck==1)
		{
			$vsql="select lv001 from  hr_lv0002 where lv001 in ($vReturn)  order by lv103 asc";
			$bResult=db_query($vsql);
			while ($vrow = db_fetch_array ($bResult)){
				//$vReturn=$vReturn.",'".$vrow['lv001']."'";
				$vReturn=$vReturn.",".$this->LV_GetChildDep($vrow['lv001']);
			}
		}
		return $vReturn;
	}
	function LV_GetChildDep($vDepID)
	{
		$vReturn="";
		if(trim($vDepID)=="") return '';
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		$vsql="select lv001 from  hr_lv0002 where lv002 in ($vReturn) order by lv103 asc";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			$vReturn=$vReturn.",".$this->LV_GetChildDep($vrow['lv001']);
		}
		return $vReturn;
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
		$sqlS = "SELECT A.*,(select B.lv003 from tc_lv0008 B where B.lv002=A.lv001 and lv005='$this->ReportYear') lv100  FROM hr_lv0020 A WHERE 1=1  ".$this->GetCondition()." $strSort ";
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
	function LV_DemSoLanIn($vUserID,$vCalID,$DepID)
	{
		$vsql="select * from  lv_lv0100 where lv002='$vCalID' and lv003='$DepID'";
		$bResult=db_query($vsql);
		$vrow = db_fetch_array ($bResult);
		if($vrow)
		{
			
		}
		else
		{
			
		}
	}
	function LV_GetSalary($vEmpID,$vYear,$vMonth)
	{
		$vslq="select sum(A.lv050) SalaryMoney from tc_lv0021 A inner join tc_lv0013 B on A.lv060=B.lv001 where A.lv002='$vEmpID' and B.lv006='$vMonth' and B.lv007='$vYear'";
		$bResultC = db_query($vslq);
		$arrRowC = db_fetch_array($bResultC);
		if($arrRowC['SalaryMoney']==0) return '&nbsp;';
		return $arrRowC['SalaryMoney'];
	}
	function LV_GetBonus($vEmployeeID,$vContractLaborID)
	{
		$vslq="select sum(A.lv005) Bonus from hr_lv0042 A where A.lv002='$vEmployeeID' and A.lv003='$vContractLaborID'";
		$bResultC = db_query($vslq);
		$arrRowC = db_fetch_array($bResultC);
		if($arrRowC['Bonus']==0) return '&nbsp;';
		return $arrRowC['Bonus'];
	}
	function LV_GetSalaryIncrease($vEmpID,$vShowLuong=0)
	{
		$vMinDate='2014-12-01';
		$vMaxDate=$this->DateCurrent;
		$cM=getmonth($vMaxDate);
		$cY=getyear($vMaxDate);
		$vArrContractBuild=Array();
		$lvsql="
		SELECT MP.* FROM (
			select A.lv004 DateS,A.lv001,A.lv003,A.lv004,A.lv005,A.lv009,A.lv010,A.lv021,A.lv022,A.lv023,A.lv024,A.lv025,A.lv027,A.lv028,C.lv003 Converters from hr_lv0038 A left join hr_lv0018 C on A.lv024=C.lv001 where A.lv002='".$vEmpID."' $vCondition
			UNION
			select B.lv004 DateS,A.lv001,A.lv003,A.lv004,A.lv005,A.lv009,IF(B.lv003='DOICVPB' OR B.lv003='DOIPHONGBAN',B.lv006,A.lv010) lv010,A.lv021,A.lv022,A.lv023,A.lv024,A.lv025,B.lv010 lv027,B.lv011 lv028,C.lv003 Converters from hr_lv0038 A inner join hr_lv0098 B on B.lv099=A.lv001 left join hr_lv0018 C on A.lv024=C.lv001 where A.lv002='".$vEmpID."' $vCondition
		) MP order by MP.DateS ASC";
		$vresult=db_query($lvsql);
		$vArrContractSave=Array();
		$vPre=0;
		$vNameVN=$this->getvaluelink('lv110',$vEmpID);
		$isFirst=false;
		$vCodeFirst='';
		$vSTTT=0;
		$vACot3=Array();
		$vACot7=Array();
		while($vrow=db_fetch_array($vresult))
		{
			if($vMinDate>$vrow['DateS'])
			{
				$vdatefrom=$vMinDate;
			}
			else
				$vdatefrom=$vrow['DateS'];
			
			$vYearS=getyear($vdatefrom);
			$vYearE=getyear($vMaxDate);
			$vYMin=getyear($vMinDate);
			if($vYearS<$vYMin) $vYearS=$vYMin;
			for($y=$vYearS;$y<=$vYearE;$y++)
			{
				if($y==$vYearS)
				{
					$vMonthS=(int)getmonth($vdatefrom);
				}
				else 
					$vMonthS=1;
				if($y==$cY) 
					$vMonthE=$cM;
				else 
					$vMonthE=12;
				for($m=$vMonthS;$m<=$vMonthE;$m++)
				{
					$stt=$y.'-'.Fillnum($m,2);
					$vArrContractBuild[$stt]['y']=$y;
					$vArrContractBuild[$stt]['m']=$m;
					$vArrContractBuild[$stt]['cot1']=Fillnum($m,2).'-'.$y;
					$vArrContractBuild[$stt]['cot2']=$vEmpID;
					if($vACot3[$vrow['lv010']][0]==true)
						$vArrContractBuild[$stt]['cot3']=$vACot3[$vrow['lv010']][1];
					else
					{
						$vACot3[$vrow['lv010']][1]=$this->getvaluelink('lv010',$vrow['lv010']);
						$vACot3[$vrow['lv010']][0]=true;
						$vArrContractBuild[$stt]['cot3']=$vACot3[$vrow['lv010']][1];
					}
					$vArrContractBuild[$stt]['cot4']=$this->FormatView($vrow['DateS'],2);
					$vArrContractBuild[$stt]['cot5']=$this->FormatView($vrow['lv005'],2);
					$vArrContractBuild[$stt]['cot6']=$vrow['lv001'];
					if($vACot7[$vrow['lv009']][0]==true)
						$vArrContractBuild[$stt]['cot7']=$vACot7[$vrow['lv009']][1];
					else
					{
						$vACot7[$vrow['lv009']][1]=$this->getvaluelink('lv009',$vrow['lv009']);
						$vACot7[$vrow['lv009']][0]=true;
						$vArrContractBuild[$stt]['cot7']=$vACot7[$vrow['lv009']][1];
					}
					$vArrContractBuild[$stt]['cot8']=$vrow['lv021'];
					$vArrContractBuild[$stt]['cot9']=$vrow['lv022']*$vrow['Converters'];
					$vArrContractBuild[$stt]['cot10']=$vrow['lv023']*$vrow['Converters'];
					$vArrContractBuild[$stt]['cot17']=$vrow['lv025']*$vrow['Converters'];
					$vArrContractBuild[$stt]['cot11']=($vrow['lv023']+$vrow['lv025']+$vrow['lv022'])*$vrow['Converters'];
					if($isFirst==false )
					{
						$isFirst=true;
						$vArrContractBuild[$stt]['cot12']='&nbsp;';
						$vCodeFirst=$stt;
					}
					else
					{
						if($vCodeFirst==$stt)
						{
							$vArrContractBuild[$stt]['cot12']='&nbsp;';
						}
						else
							$vArrContractBuild[$stt]['cot12']=($vPre<=0)?'&nbsp;':(((($vrow['lv023']+$vrow['lv025']+$vrow['lv022'])*$vrow['Converters'])!=$vPre)?(($vrow['lv023']+$vrow['lv025']+$vrow['lv022'])*$vrow['Converters']-$vPre):'&nbsp');
					}
					$vArrContractBuild[$y][$y]=$vArrContractBuild[$y][$y]+(float)$vArrContractBuild[$stt]['cot12'];
					$vArrContractBuild[$stt]['cot13']=$vrow['lv027'];
					$vArrContractBuild[$stt]['cot14']=$vrow['lv028'];
					$vArrContractBuild[$stt]['cot15']='&nbsp;';
					$vPre=($vrow['lv023']+$vrow['lv025']+$vrow['lv022'])*$vrow['Converters'];
				}
			
			}		
			$vPre=($vrow['lv023']+$vrow['lv025']+$vrow['lv022'])*$vrow['Converters'];		
		}
		
		return $vArrContractBuild;
	}
	function Get_BuildList_Array($vArrayEmpFull)
	{
		
		$cM=getmonth($this->datefrom);
		$cY=getyear($this->datefrom);
		if($cM==1) 
		{
			$cM=12;
			$cY=$cY-1;
		}
		if($this->lang=='VN')
			$vArrLang=Array('stt'=>'STT','manv'=>'Mã NV','hoten'=>'Họ và tên','trinhdo'=>'Trình độ','he'=>'Hệ','ngayvaolam'=>'Ngày vào làm','chucdanh'=>'Chức danh','luongthang'=>"Lương T".$cM."/".$cY,'ghichu'=>'Ghi chú','tong'=>'Tổng','luong'=>'Lương','tangluong'=>'Tăng lương','tongcong'=>'Tổng cộng');
		else
			$vArrLang=Array('stt'=>'Order','manv'=>'StaffID','hoten'=>'Full Name','trinhdo'=>'Level','he'=>'Regular and irregular','ngayvaolam'=>'Date Work','chucdanh'=>'Position','luongthang'=>"Salary month ".$cM."/".$cY,'ghichu'=>'Note','tong'=>'Total','luong'=>'Salary','tangluong'=>'Increase salary','tongcong'=>'Total All');
		$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$vArrLang['stt']."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$vArrLang['manv']."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$vArrLang['hoten']."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$vArrLang['trinhdo']."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$vArrLang['he']."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$vArrLang['ngayvaolam']."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$vArrLang['chucdanh']."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">".$vArrLang['luongthang']."</td>
				".$this->lvHeader."
				<td rowspan=\"2\">".$vArrLang['ghichu']."</td>
			</tr>
			<tr>
				".$this->lvHeader1."
			</tr>
			@01
		</table>
		";
		$lvListTrAll="";
		$vOrder=1;
		$vDeptName='00000000000000000000';
		$vArrSum=Array();
		$vArrSumAll=Array();
		$vFirt=true;
		$vDepTitle='';
		$vFooter='';
		$lvListTrAll1='';
		foreach($vArrayEmpFull as $vEmpFull)
		{
			$i=$this->ArrEmpBack[$vEmpFull[0]];
			$vDateLeave=$this->ArrEmp[$i][44];
			$vMonthLeave=getmonth($vDateLeave);
			$vYearLeave=getyear($vDateLeave);
			if($vYearLeave<=1990)
				$vDayInt=999999;
			else
				$vDayInt=(float)$vYearLeave.$vMonthLeave;
			$vEmpObj=$vEmpFull[1];
			if($vDeptName!=$this->ArrEmp[$i][222])
			{
				$lvListTrAll=$lvListTrAll.$vDepTitle;
				$lvListTrAll=$lvListTrAll.$lvListTrAll1;
				if($vFirt==false)
				{
					$lvListTrAll=$lvListTrAll.$vFooter;
					$vArrSum=NULL;
					$vOrder=1;
				}	
				
				$vDeptName=$this->ArrEmp[$i][222];
				$vFirt=false;
				
				$vDepTitle='';
				$vFooter='';
				$lvListTrAll1='';
				
			}
			if($sExport=="excel")
			{
				$lvListTrAll1=$lvListTrAll1.'<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$vOrder."\"</Data></td><td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$this->ArrEmp[$i][0]."\"</Data></td>".'<td nowrap="nowrap"><Data ss:Type="String">="'.$this->ArrEmp[$i][1].'"</Data>'."</td>";
				$vDepTitle='<tr><td colspan="8"><strong>'.$this->ArrEmp[$i][222].'</strong></td>';
				$vFooter='<tr><td colspan="7">'.$vArrLang['tong'].'</td>';
				$vFooterALL='<tr><td colspan="7">'.$vArrLang['tongcong'].'</td>';
			}
			else
			{
				$lvListTrAll1=$lvListTrAll1."<tr><td nowrap='nowrap'>".$vOrder."</td><td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][0]."</Data></td><td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][1]."</Data></td>";
				$vDepTitle='<tr><td colspan="8"><strong>'.$this->ArrEmp[$i][222].'</strong></td>';
				$vFooter='<tr><td colspan="7">'.$vArrLang['tong'].'</td>';
				$vFooterALL='<tr><td colspan="7">'.$vArrLang['tongcong'].'</td>';
			}
			$lvListTrAll1=$lvListTrAll1.'<td align="left">'.$this->ArrEmp[$i][28]."</td>"."<td>&nbsp;</td>".'<td align="center">'.$this->FormatView($this->ArrEmp[$i][30],2)."</td>".'<td align="left">'.$this->ArrEmp[$i][5]."</td>";
			$stt=$cY.'-'.Fillnum($cM,2);
			$lvListTrAll1=$lvListTrAll1.'<td align="right">'.$this->FormatView($vEmpObj[$stt]['cot11'],20)."</td>";
			$vArrSum[$stt]['cot11']=$vArrSum[$stt]['cot11']+(float)$vEmpObj[$stt]['cot11'];
			$vArrSum[$stt]['cot12']=$vArrSum[$stt]['cot12']+(float)$vEmpObj[$stt]['cot12'];
			$vFooter=$vFooter.'<td align="right">'.$this->FormatView($vArrSum[$stt]['cot11'],20).'</td>';
			$vArrSumAll[$stt]['cot11']=$vArrSumAll[$stt]['cot11']+(float)$vEmpObj[$stt]['cot11'];
			$vArrSumAll[$stt]['cot12']=$vArrSumAll[$stt]['cot12']+(float)$vEmpObj[$stt]['cot12'];
			$vFooterALL=$vFooterALL.'<td align="right">'.$this->FormatView($vArrSumAll[$stt]['cot11'],20).'</td>';
			$vCurY=0;
			foreach($this->DateFor as $vDateE)
			{
				$y=$vDateE['y'];
				$m=$vDateE['m'];
				$stt=$y.'-'.Fillnum($m,2);
				$sttInt=(float)$y.Fillnum($m,2);
				if($vDayInt>=$sttInt)
				{
					if($vCurY!=0 && $vCurY!=$y)
					{
						$lvListTrAll1=$lvListTrAll1.'<td align="right" style="background:#c3c3c3">'.$this->FormatView($vEmpObj[$vCurY][$vCurY],20)."</td>";	
						$vFooter=$vFooter.'<td align="right" style="background:#c3c3c3">'.$this->FormatView($vArrSum[$vCurY][$vCurY],20).'</td>';
						$vFooterALL=$vFooterALL.'<td align="right" style="background:#c3c3c3">'.$this->FormatView($vArrSumAll[$vCurY][$vCurY],20).'</td>';
						$vDepTitle=$vDepTitle.'<td style="background:#c3c3c3">&nbsp;</td>';
					}
					$lvListTrAll1=$lvListTrAll1.'<td align="right">'.$this->FormatView($vEmpObj[$stt]['cot11'],20)."</td>".'<td align="right">'.$this->FormatView($vEmpObj[$stt]['cot12'],20)."</td>";
					$vDepTitle=$vDepTitle.'<td>&nbsp;</td><td>&nbsp;</td>';
					$vArrSum[$stt]['cot11']=$vArrSum[$stt]['cot11']+(float)$vEmpObj[$stt]['cot11'];
					$vArrSum[$stt]['cot12']=$vArrSum[$stt]['cot12']+(float)$vEmpObj[$stt]['cot12'];
					$vArrSum[$y][$y]=$vArrSum[$y][$y]+(float)$vEmpObj[$stt]['cot12'];
					$vArrSumAll[$stt]['cot11']=$vArrSumAll[$stt]['cot11']+(float)$vEmpObj[$stt]['cot11'];
					$vArrSumAll[$stt]['cot12']=$vArrSumAll[$stt]['cot12']+(float)$vEmpObj[$stt]['cot12'];
					$vArrSumAll[$y][$y]=$vArrSumAll[$y][$y]+(float)$vEmpObj[$stt]['cot12'];
					$vFooter=$vFooter.'<td align="right">'.$this->FormatView($vArrSum[$stt]['cot11'],20).'</td><td align="right">'.$this->FormatView($vArrSum[$stt]['cot12'],20).'</td>';
					$vFooterALL=$vFooterALL.'<td align="right">'.$this->FormatView($vArrSumAll[$stt]['cot11'],20).'</td><td align="right">'.$this->FormatView($vArrSumAll[$stt]['cot12'],20).'</td>';
				}
				else
				{
					if($vCurY!=0 && $vCurY!=$y)
					{
						$lvListTrAll1=$lvListTrAll1.'<td align="right" style="background:#c3c3c3">&nbsp;'."</td>";	
						$vFooter=$vFooter.'<td align="right" style="background:#c3c3c3">&nbsp;</td>';
						$vFooterALL=$vFooterALL.'<td align="right" style="background:#c3c3c3">'.$this->FormatView($vArrSumAll[$vCurY][$vCurY],20).'</td>';
						$vDepTitle=$vDepTitle.'<td style="background:#c3c3c3">&nbsp;</td>';
					}
					$lvListTrAll1=$lvListTrAll1.'<td align="right">&nbsp;'."</td>".'<td align="right">&nbsp;</td>';
					$vDepTitle=$vDepTitle.'<td>&nbsp;</td><td>&nbsp;</td>';
					$vFooter=$vFooter.'<td align="right">&nbsp;</td><td align="right">&nbsp;</td>';
					$vFooterALL=$vFooterALL.'<td align="right">'.$this->FormatView($vArrSumAll[$stt]['cot11'],20).'</td><td align="right">'.$this->FormatView($vArrSumAll[$stt]['cot12'],20).'</td>';
				}
				$vCurY=$y;
			}
			$lvListTrAll1=$lvListTrAll1.'<td align="right"  style="background:#c3c3c3">'.$this->FormatView($vEmpObj[$vCurY][$vCurY],20)."</td>";	
			$vFooter=$vFooter.'<td align="right"  style="background:#c3c3c3">'.$this->FormatView($vArrSum[$vCurY][$vCurY],20).'</td>';
			$vFooterALL=$vFooterALL.'<td align="right"  style="background:#c3c3c3">'.$this->FormatView($vArrSumAll[$vCurY][$vCurY],20).'</td>';
			$vDepTitle=$vDepTitle.'<td style="background:#c3c3c3">&nbsp;</td>';
			$vFooter=$vFooter."<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
			$vFooterALL=$vFooterALL."<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
			$vDepTitle=$vDepTitle."<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
			$lvListTrAll1=$lvListTrAll1."<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
			$vOrder++;
		}
		$lvListTrAll=$lvListTrAll.$lvListTrAll1;
		$lvListTrAll=$lvListTrAll.$vFooter;
		$lvListTrAll=$lvListTrAll.$vFooterALL;
		return str_replace("@01",$lvListTrAll,$vTable);
	}
	function Get_Arr_Employees()
	{
		$this->ArrEmp=array();
		$this->ArrEmpBack=array();
		$strTd=$this->Get_String_DateFromTo();
		$lvcondition="";
		
		if($this->lv028!="")
			$strCondi=" AND  DD.lv009 in ('".str_replace(",","','",$this->lv028)."') ";
		if($this->lv029_!="")  
		{
			$lsguser=$this->LV_GetDep($this->lv029_);
			if($this->isDept==1)
				$strCondi=$strCondi." AND DD.lv029 not in (".$lsguser.")";
			else
				$strCondi=$strCondi." AND DD.lv029 in (".$lsguser.")";
		}
		if($this->lv009!="")
		{
			$strCondi=$strCondi." AND DD.lv009  in (".$this->lv009.")";
		}
		if($this->lv029!="")  
		{
			$lsguser=$this->LV_GetDep($this->lv029);
			if($this->isDept==1)
				$strCondi=$strCondi." AND DD.lv029 not in (".$lsguser.")";
			else
				$strCondi=$strCondi." AND DD.lv029 in (".$lsguser.")";
		}
		if($this->lv030!="") $strCondi=$strCondi." AND DD.lv001 in ('".$this->lv030."')";
		if($this->lvSort==0)
			$lvsql="select DD.lv030,DD.lv044,DD.lv001 CodeID,DD.lv002 Name,DD.lv005 TitleVN,BB.lv002 TrinhDo,DD.lv029 Dep,CC.lv003 DepName from hr_lv0020 DD left join hr_lv0005 BB on DD.lv028=BB.lv001 left join hr_lv0002 CC on DD.lv029=CC.lv001 where 1=1 $strCondi  order by DD.lv029";
		else 
			$lvsql="select DD.lv030,DD.lv044,DD.lv001 CodeID,DD.lv002 Name,DD.lv005 TitleVN,BB.lv002 TrinhDo,DD.lv029 Dep,CC.lv003 DepName from hr_lv0020 DD left join hr_lv0005 BB on DD.lv028=BB.lv001 left join hr_lv0002 CC on DD.lv029=CC.lv001 where 1=1 $strCondi  order by DD.lv001";
		$vresult=db_query($lvsql);	
		$i=0;
		while($vrow=db_fetch_array($vresult))
		{
			$this->ArrEmp[$i][0]=$vrow['CodeID'];
			$this->ArrEmp[$i][1]=$vrow['Name'];
			$this->ArrEmp[$i][2]=$vrow['Dep'];
			$this->ArrEmp[$i][222]=$vrow['DepName'];
			$this->ArrEmp[$i][3]=$this->Str_DateFromTo;
			$this->ArrEmp[$i][4]=$strTd;
			$this->ArrEmp[$i][5]=$vrow['TitleVN'];
			$this->ArrEmp[$i][28]=$vrow['TrinhDo'];
			$this->ArrEmp[$i][14]=$strTd;
			$this->ArrEmp[$i][30]=$vrow['lv030'];
			$this->ArrEmp[$i][44]=$vrow['lv044'];
			$this->ArrEmpBack[$vrow['CodeID']]=$i;
			$i++;
		}
	}
	function Get_String_DateFromTo()
	{
		$this->DateFor=Array();
		$this->lvHeader="";
		$this->lvFooter="";
		$this->lvHeader1="";
		$strTD="";
		$vMinDate='2014-12-01';
		$vMaxDate=$this->DateCurrent;
		$cM=getmonth($vMaxDate);
		$cY=getyear($vMaxDate);
		$vMonthS=getmonth($vMinDate);
		if($vMinDate>$this->datefrom)
			{
				$vdatefrom=$vMinDate;
			}
			else
				$vdatefrom=$this->datefrom;
			
			$vYearS=getyear($vdatefrom);
			$vYearE=getyear($vMaxDate);
			for($y=$vYearS;$y<=$vYearE;$y++)
			{
				if($y==$vYearS)
				{
					$vMonthS=(int)getmonth($vdatefrom);
				}
				if($y==$cY) 
					$vMonthE=$cM;
				else 
					$vMonthE=12;
				for($m=$vMonthS;$m<=$vMonthE;$m++)
				{
					$stt=$y.'-'.Fillnum($m,2);
					$this->DateFor[$stt]['stt']=$stt;
					$this->DateFor[$stt]['y']=$y;
					$this->DateFor[$stt]['m']=$m;
					$vTitle=Fillnum($m,2)."/".$y;
					$this->lvHeader=$this->lvHeader.'<td colspan="2"><center><b>'.$vTitle.'</b></center></td>';
					$this->lvFooter=$this->lvFooter.'<td><center>'."<!--F-".$vTitle."-->".'</center></td>';
					$this->lvHeader1=$this->lvHeader1.'<td class="tdhprint" ><center><b>Lương</b></center></td><td class="tdhprint" ><center><b>Tăng lương</b></center></td>';
					$strTD=$strTD.'<td align="right">'."<!--".$vTitle."-->".'</td><td align="right">'."<!--_".$vTitle."-->".'</td>';
				}
				$this->lvHeader=$this->lvHeader.'<td rowspan="2" style="background:#c3c3c3"><center><b>Tổng lương tăng '.$y.'</b></center></td>';
				$strTD=$strTD.'<td align="right">'."<!--".$y."_".$vTitle."-->".'</td>';
			}
		return $strTD;
	}
	
	function LV_BuilListReportOtherPrintLateSoon($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvopt,$vmau=0,$vshowgiokem=0,$sExport,$ShowOnce=1)
	{		
		$vArrFullEmp=Array();
		$this->Get_Arr_Employees();
		$this->ArrTCEmp=Array();
		$lvparatimecard=explode(",",$this->paratimecard);
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
			<td width=1% class=@#04>@03</td>
			@#01
		</tr>
		";
		$lvHref="@02";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=@#04>@02</td>";
		for($i=0;$i<count($this->ArrEmp);$i++)
		{
			$vEmpID=$this->ArrEmp[$i][0];
			$vArrFullEmp[$vEmpID][0]=$vEmpID;
			$vArrFullEmp[$vEmpID][1]=$this->LV_GetSalaryIncrease($vEmpID);
			$vArrFullEmp[$vEmpID][44]=$this->ArrEmp[$i][44];
		}
		return $this->Get_BuildList_Array($vArrFullEmp);
	}
	private function get_count_codeid($vempid)
	{
		$sqlS="select count(*) numfn from tc_lv0011 B where B.lv007='$this->TCCodeID' and B.lv002 in (".$this->GetBuilCalendar($vempid,'lv001').")";
		$bResult = db_query($sqlS);
		$vrow = db_fetch_array ($bResult);
		return $vrow['numfn'];
		
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
	public function GetBuilCheckListDept($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002',$vDepID="")
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
		if($vDepID=="") 
		{
			$vsql="select * from  ".$vTbl." where lv002='SOF' order by lv103 asc";
		}
		else
		{
			$vReturn="'".str_replace(",","','",$vDepID)."'";
			$vsql="select lv001,lv003 from  hr_lv0002 where (lv001 in ($vReturn))  order by lv003";
		}
		
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
			if($this->LV_IsNameDep==1)
				$strTemp=str_replace("@#02",$vrow[$vFieldView]."(".$vrow['lv001'].")",$strTemp);
			else
				$strTemp=str_replace("@#02",$vrow[$vFieldView],$strTemp);
			$strGetScript=$strGetScript.$strTemp;
			$strGetScript=$strGetScript.$this->GetBuilCheckListChild($vListID,$vID,$vrow['lv001'],$vTbl,$vFieldView,$i,$numrows,'');
			$i++;
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
	function GetBuilCheckListChild($vListID,$vID,$vParentID,$vTbl,$vFieldView,&$i,&$numrows,$vspace)
	{
		$strGetScript="";
		$lvChk="<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH="<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>			
		</tr>
		";
		$vsql1="select * from  ".$vTbl." where lv002='".$vParentID."' order by lv003";
		$vresult1=db_query($vsql1);
		$vnum=db_num_rows($vresult1);
		$numrows=$numrows+$vnum;
		$i++;
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
			if($this->LV_IsNameDep==1)
				$strTemp=str_replace("@#02",$vspace.'|-----'.$vrow1[$vFieldView]."(".$vrow1['lv001'].")",$strTemp);
			else
				$strTemp=str_replace("@#02",$vspace.'|-----'.$vrow1[$vFieldView],$strTemp);
			$strGetScript=$strGetScript.$strTemp;
			$strGetScript=$strGetScript.$this->GetBuilCheckListChild($vListID,$vID,$vrow1['lv001'],$vTbl,$vFieldView,$i,$numrows,$vspace.'&nbsp;&nbsp;&nbsp;');
			$i++;
		}
		$i--;
		return $strGetScript;
	}
	public function GetBuilCheckList($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002',$vSort='')
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
		$vsql="select * from  ".$vTbl." ".$vSort;
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
	/////////////////////ListFieldSave//////////////////////////
	function ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrder,$lvSortNum)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=",".$lvList.",";
		$lstArr=explode(",",$this->DefaultFieldList);
		$lvArrOrder=explode(",",$lvOrder);
		$lvSelect="<ul id=\"menu-nav\" onkeyup=\"return CheckKeyCheckTab(event,$lvFrom,".count($lstArr).")\">
						<li class=\"menusubT\"><img src=\"$this->Dir../images/lvicon/config.png\" border=\"0\" />".$this->ArrFunc[11]."
							<ul id=\"submenu-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript="		
		<script language=\"javascript\">
		function SelectChk(vFrom,len)
		{
			vFrom.txtFieldList.value=getChecked(len,'lvdisplaychk');
			vFrom.txtOrderList.value=getAlllen(len,'lvorder');
			vFrom.txtFlag.value=2;
			vFrom.submit();
		}
		function lv_on_open(opt)
		{
			div = document.getElementById('lvsllist');
			if(opt==0)
			{
				div.size=1;
			}
			else
				div.size=div.length;
			
		}
		function getChecked(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{

				if(str=='') 
					str=''+div.value;
				else
					 str=str+','+div.value;

				}
			}
			return str;
		}
		function getAlllen(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
				div = document.getElementById(nameobj+i);
				if(str=='') 
					str=''+div.value;
				else
					 str=str+','+div.value;
			}
			return str;
		}
		</script>
";
		$lvScript="<li class=\"menuT\"> @01 </li>";
		$lvNumPage="".$this->ArrOther[2]."<input type=\"text\" class=\"lvmaxrow\" name=lvmaxrow id=lvmaxrow value=\"$maxRows\">";
		$lvSortPage="".GetLangSort(0,$this->lang)."<select class=\"lvsortrow\" name=lvsort id=lvsort >
				<option value=0 ".(($lvSortNum==0)?'selected':'').">".GetLangSort(1,$this->lang)."</option>
				<option value=1 ".(($lvSortNum==1)?'selected':'').">".GetLangSort(2,$this->lang)."</option>
				<option value=2 ".(($lvSortNum==2)?'selected':'').">".GetLangSort(3,$this->lang)."</option>
		</select>";
		$lvChk="<input type=\"checkbox\" id=\"lvdisplaychk@01\" name=\"lvdisplaychk@01\" value=\"@02\" @03><input id=\"lvorder@01\" name=\"lvorder@01\"  type=\"text\" value=\"@06\"\ style=\"width:20px\" >";
		$lvButton="<input class=lvbtdisplay type=\"button\" id=\"lvbutton\" value=\"".$this->ArrOther[1]."\" onclick=\"SelectChk($lvFrom,".count($lstArr).")\">";
		$strGetList="";
		$strGetScript="";
		$strTemp=str_replace("@01",$lvButton,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strTemp=str_replace("@01",$lvNumPage,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
				$strTemp=str_replace("@01",$lvSortPage,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		
		for ($i=0;$i<count($lstArr);$i++)
		{
			
			$strTempChk=str_replace("@01",$i,$lvChk.$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]]);
			$strTempChk=str_replace("@02",$lstArr[$i],$strTempChk);
			
			$strTempChk=str_replace("@07",100+$i,$strTempChk);
			if(strpos($lvList,",".$lstArr[$i].",") === FALSE)
			{
				$strTempChk=str_replace("@03","",$strTempChk);
				
			}
			else
			{
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			}
			if(!isset($lvArrOrder[$i]) || $lvArrOrder[$i] === NULL || $lvArrOrder[$i] === "")
				{
				$strTempChk=str_replace("@06",$i,$strTempChk);
				}
			else
				$strTempChk=str_replace("@06",$lvArrOrder[$i],$strTempChk);
			
			
			$strTemp=str_replace("@01",$strTempChk,$lvScript);
			$strGetScript=$strGetScript.$strTemp;
		}
		$strReturn=str_replace("@#01",$strGetScript,$lvSelect).$strScript;
		return $strReturn;
		
	}
	public function LV_LinkField($vFile,$vSelectID)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectID),0));
	}
private function sqlcondition($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv001':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0013";
				break;
			case 'lv002':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002";
				break;
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