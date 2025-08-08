<?php
class jo_lv0040 extends lv_controler{
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
	public $paratimecard=null;
	public $datefrom=null;
	public $dateto=null;
	public $ArrEmp=null;
	public $ArrStateEmp=null;
	public $ArrEmpBack=null;
	public $Str_DateFromTo=null;
	public $lvHeader=null;
	public $lvState=null;
	public $lvSort=null;
	public $ArrTCEmp=null;
	public $DateWork=0;
	public $DateSun=0;
	public $ArrDept=null;
	public $ArrStateScan=null;
	public $ArrDateScan=null;
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
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011";	
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"2","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0","lv012"=>"0");
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
		$this->ArrDept=Array();
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
	function LV_GetCodeNghi($vCode)
	{
		$vArrayCode=Array("0.5&"=>0.5,"&"=>1,"0.5K"=>0.5,"0.5X"=>0.5,"X"=>1);
		return $vArrayCode[$vCode];
	}
	function LV_GetTCEmpSum($vEmpID)
	{
		$vCode="'V','中','日','^','&','0.5K','C'";
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
	function GetChildDept($vParentID,&$i)
	{
		$strReturn="";

		$vsql1="select lv001 from  hr_lv0002 where lv002='".$vParentID."' order by lv003";
		$vresult1=db_query($vsql1);
		$i++;
		while($vrow1=db_fetch_array($vresult1))		
		{
			$strReturn=$strReturn.",".$vrow1['lv001'];
			$strReturn=$strReturn.$this->GetBuilCheckListChild($vrow1['lv001'],$i);
			$i++;
		}
		$i--;
		return $strReturn;
	}
//////////////////////Buil list////////////////////
	function LV_BuilListReportOtherPrintLateSoon($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvopt=0,$vmau=0,$vshowgiokem=0,$isshift=0)
	{		
		$lvTable='
		<table border="1" cellpadding="10" cellspacing="0" style="page-break-before: always" width="977" align="center">
			<colgroup>
				<col width="27" />
				<col width="232" />
				<col width="58" />
				<col width="53" />
				<col width="84" />
				<col width="141" />
				<col width="71" />
				<col width="*" /></colgroup>
			<tbody>
				<tr>
					<td colspan="3" height="5" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in" width="327">
						<p align="center" class="western"><img src="../../logo.png" height="60"/></p>
					</td>
					<td colspan="3" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in" width="298">
						<p align="center" class="western" style="margin-bottom: 0in"><font face="Arial, sans-serif"><font style="font-size: 15pt">PHIẾU B&Aacute;O TĂNG CA</font></font></p>
						<p align="center" class="western"><font face="Arial, sans-serif">Ng&agrave;y: '.($this->FormatView($this->datefrom,2)).' đến '.($this->FormatView($this->dateto,2)).'</font></p>
					</td>
					<td colspan="2" style="border: 1px solid #000000; padding: 0in 0.08in" width="290">
						<p class="western" style="margin-bottom: 0in"><font face="Arial, sans-serif"><font style="font-size: 11pt">M&atilde;: BM-HCNS-15</font></font></p>
						<p class="western" style="margin-bottom: 0in"><font face="Arial, sans-serif"><font style="font-size: 11pt">Lần sửa đổi: 01</font></font></p>
						<p class="western"><font face="Arial, sans-serif"><font style="font-size: 11pt">Ng&agrave;y ban h&agrave;nh: 15/05/2012</font></font></p>
					</td>
				</tr>
				<tr>
					<td height="18" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in" width="27">
						<p align="center" class="western"><font face="Arial, sans-serif"><b>Stt</b></font></p>
					</td>
					<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in" width="232">
						<p align="center" class="western"><font face="Arial, sans-serif"><b>Họ t&ecirc;n</b></font></p>
					</td>
					<td colspan="2" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in" width="81">
						<p align="center" class="western"><font face="Arial, sans-serif"><b>Từ giờ</b></font></p>
					</td>
					<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in" width="84">
						<p align="center" class="western"><font face="Arial, sans-serif"><b>Đến giờ</b></font></p>
					</td>
					<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in" width="233">
						<p align="center" class="western"><font face="Arial, sans-serif"><b>L&yacute; do tăng ca</b></font></p>
					</td>
					<td style="border: 1px solid #000000; padding: 0in 0.08in" width="198">
						<p align="center" class="western"><font face="Arial, sans-serif"><b>Kết quả c&ocirc;ng việc</b></font></p>
					</td>
				</tr>
				@#01
				<tr>
					<td colspan="8" height="72" style="border: 1px solid #000000; padding: 0in 0.08in;" valign="top" width="955">
						
						<table width="100%" border="0"><tr><td width="25%" align="center">Duyệt</td><td width="25%" align="center"> Trưởng Bộ phận</td>
						<td width="25%" align="center"> TP.HCNS</td><td width="25%"  align="center"> Người lập phiếu</td>
						</tr></table>
						<p align="center" class="western" lang="en-US" style="margin-top: 0.08in; margin-bottom: 0in">&nbsp;</p>
						<p align="center" class="western" lang="en-US" style="margin-top: 0.08in">&nbsp;</p>
					</td>
				</tr>
			</tbody>
		</table>
';
		$vTR='<tr height="17">
			<td height="17" >'.(($sExport == "excel")?'<Data ss:Type="String">="@#01"':'@#01').'</td>
			<td style="white-space:nowrap">@#02</td>
			<td align=center style="white-space:nowrap">@#03</td>
			<td align=center>@#04</td>
			<td align=center>@#05</td>
			<td align=center>@#06</td>
			<td align=center>@#07</td>
		</tr>
			
		';
		$strCondi="";
		if($this->datefrom!="") 
		{
			 $strCondi=$strCondi." AND A.lv016>='$this->datefrom 00:00:00' ";
		}
		if($this->dateto!="")
		{
			$strCondi=$strCondi." AND A.lv016<='$this->dateto 23:59:59' ";
		}
		if($this->lv221!="")
		{
			$strCondi=$strCondi." AND  A.lv022 in ('".str_replace(",","','",$this->lv221)."') ";
		}
		if($this->lv028!="")
			$strCondi=$strCondi." AND  DD.lv009 in ('".str_replace(",","','",$this->lv028)."') ";
		if($this->lv029!="")  $strCondi=$strCondi." AND DD.lv029 in (".$this->LV_GetDep($this->lv029).")";
		if($this->lv030!="")  $strCondi=$strCondi." AND DD.lv001 in ('".$this->lv030."')";
		if($this->isStaffOff==1)  $strCondi=$strCondi." AND year(DD.lv044)<2014 ";
		switch($this->lvSort)
		{
			case 0:

			$lvsql="select A.*,DD.lv001 CodeID,DD.lv002 Name,DD.lv005 Title,DD.lv062 NhomCT,DD.lv030 DateWork,DD.lv029 Dep,DD.lv099 from jo_lv0004 A inner join hr_lv0020 DD on A.lv015=DD.lv001 where 1=1 $strCondi  order by DD.lv029 Asc,DD.lv008 asc";
				break;
			case 1:
				$lvsql="select A.*,DD.lv001 CodeID,DD.lv002 Name,DD.lv005 Title,DD.lv062 NhomCT,DD.lv030 DateWork,DD.lv029 Dep,DD.lv099 from jo_lv0004 A inner join hr_lv0020 DD on A.lv015=DD.lv001 where 1=1 $strCondi  order by DD.lv002,A.lv016 asc";
				break;
			case 2:
				 $lvsql="select A.*,DD.lv001 CodeID,DD.lv002 Name,DD.lv005 Title,DD.lv062 NhomCT,DD.lv030 DateWork,DD.lv029 Dep,DD.lv099 from jo_lv0004 A inner join hr_lv0020 DD on A.lv015=DD.lv001 where 1=1 $strCondi  order by DD.lv062,DD.lv099 asc";
				break;	
			case 3:
				 $lvsql="select A.*,DD.lv001 CodeID,DD.lv002 Name,DD.lv005 Title,DD.lv062 NhomCT,DD.lv030 DateWork,DD.lv029 Dep,DD.lv099 from jo_lv0004 A inner join hr_lv0020 DD on A.lv015=DD.lv001 where 1=1 $strCondi  order by DD.lv099,DD.lv062 asc";
				break;	
			case 4:
				$lvsql="select A.*,DD.lv001 CodeID,DD.lv002 Name,DD.lv005 Title,DD.lv062 NhomCT,DD.lv030 DateWork,DD.lv029 Dep,DD.lv099 from jo_lv0004 A inner join hr_lv0020 DD on A.lv015=DD.lv001 where 1=1 $strCondi  order by A.lv016,A.lv015 asc";
				break;	
		}
		$vorder=$curRow;
		$bResult = db_query($lvsql);
		$strDepart='';
		
		$vlv079_0=0;
		$vlv024_0=0;
		$vlv019_0=0;
		$vlv028_0=0;
		$vlv015_0=0;
		$vlv020_0=0;
		$vlv050_0=0;
		$vlv025_0=0;
		$vlv085_0=0;
		$vlv043_0=0;
		$vlv039_0=0;
		$vlv045_0=0;
		$vlv035_0=0;
		$vlv048_0=0;
		$vlv084_0=0;
		$vlv080_0=0;
		$strTrH='';
		$vOrder=0;
		while ($vrow = db_fetch_array ($bResult)){
			$vOrder++;
			$vLineOne=$vTR;
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$vrow['Name'],$vLineOne);
			$vLineOne=str_replace("@#03",$this->FormatView($vrow['lv016'],2),$vLineOne);
			$vLineOne=str_replace("@#04",substr($vrow['lv016'],11,8),$vLineOne);
			$vLineOne=str_replace("@#05",substr($vrow['lv017'],11,8),$vLineOne);
			$vLineOne=str_replace("@#06",$vrow['lv008'],$vLineOne);
			$vLineOne=str_replace("@#07",'&nbsp;',$vLineOne);
			$strTrH=$strTrH.$vLineOne;
		}
		$strTrH=$strTrH.$vLineOne;
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		return $strFullTbl;	
	}
	function LV_GetDepartment($vDepID)
	{
		if($this->ArrDept[$vDepID][0]==true) return $this->ArrDept[$vDepID][1];
		$this->ArrDept[$vDepID][0]=true;
		$this->ArrDept[$vDepID][1]=$this->getvaluelink('lv029',$vDepID);
		return $this->ArrDept[$vDepID][1];
	}
	function GetTime($vTime)
	{
		$vArrH=explode(":",$vTime);
			$vHours=(float)$vArrH[0] ;
			$vMinutes=(float)$vArrH[1];
			$vSecond=(float)$vArrH[2];
			$vMinutes=(int)($vSecond/60)+$vMinutes;
			$vSecond=$vSecond%60;
			$vHours=$vHours+(int)($vMinutes/60)+(($vMinutes%60)/60);	
			return $vHours;
	}
	
	function LV_GetSecond($lvStartTime,$lvEndTime)
	{
		$lvsql="select TIME_TO_SEC(TIMEDIFF('$lvEndTime','$lvStartTime')) as lv_time";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		return $vrow['lv_time'];
	}
	
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM tc_lv0011 A WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	
	public function GetTimeCode($vEmployeeID,$vStartDate,$vEndDate,$vTimeCode)
	{
		
		$lvList='lv001,lv002,lv003';
		$ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"1");
		$lvOrderList='0,1,2';
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$lvTable="
		<table  align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\">
		@#01
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">			
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=@#04>@02</td>";
		$lv_more_sql="select A2.lv001 from tc_lv0010 A2 where A2.lv002='$vEmployeeID'";
		$lv_condi_addmore=$this->GetMultiValue($lv_more_sql);
		/*$sqlS="select VM.lv001,C.lv002 lv002,sum(VM.SumHour) +sum(VM.SumMinute/60) + sum(VM.SumSecond/360) lv003 from(select A.lv001,A.lv002,A.lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003=A.lv001) PerCent,(select sum(left(A1.lv005,2)) + sum(substr(A1.lv005,4,5))/60 + sum(substr(A1.lv005,7,8))/360  from tc_lv0011 A1 where A1.lv007=A.lv001 and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') )  SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A where A.lv004!='1'																																																																																			  		UNION
		 select A.lv001,A.lv002,A.lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003=A.lv001) PerCent,(select sum(left(A1.lv006,2)) + sum(substr(A1.lv006,4,5))/60 + sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv007=A.lv001 and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A where A.lv004='1'
		 UNION
		 select '$vTimeCode' lv001,A.lv002,A.lv004,100 PerCent,(select sum(left(A1.lv005,2)) + sum(substr(A1.lv005,4,5))/60 + sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv007=A.lv001 and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A where A.lv004='1') VM left join tc_lv0002 C on VM.lv001=C.lv001   GROUP BY lv001;";*/
		$sqlS="select VM.lv001,C.lv002 lv002,sum(VM.SumHour) +sum(VM.SumMinute/60) + sum(VM.SumSecond/360) lv003 from(";
		$vsql="select * from tc_lv0002 where lv004!='1'";
		$vresult=db_query($vsql);
		if($vresult)
		{
			$strTemp="";																								
			while($vrow=db_fetch_array($vresult))
			{
				if($strTemp=="")
				$strTemp="select '".$vrow['lv001']."' lv001,'".sof_escape_string($vrow['lv002'])."' lv002,'".$vrow['lv004']."' lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003='".$vrow['lv001']."') PerCent,(select sum(left(A1.lv005,2)) + sum(substr(A1.lv005,4,5))/60 + sum(substr(A1.lv005,7,8))/360  from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') )  SumHour,0 SumMinute,0 SumSecond ";
				else
				 $strTemp=$strTemp." Union select '".$vrow['lv001']."' lv001,'".sof_escape_string($vrow['lv002'])."' lv002,'".$vrow['lv004']."' lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003='".$vrow['lv001']."') PerCent,(select sum(left(A1.lv005,2)) + sum(substr(A1.lv005,4,5))/60 + sum(substr(A1.lv005,7,8))/360  from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') )  SumHour,0 SumMinute,0 SumSecond";
			}
		}
		$vsql="select * from tc_lv0002 where lv004='1'";
		$vresult=db_query($vsql);
		if($vresult)
		{																							
			while($vrow=db_fetch_array($vresult))
			{
				if($strTemp=="")
					$strTemp="select '".$vrow['lv001']."' lv001,'".$vrow['lv002']."' lv002,'".$vrow['lv004']."' lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003='".$vrow['lv001']."') PerCent,(select sum(left(A1.lv006,2)) + sum(substr(A1.lv006,4,5))/60 + sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') ) SumHour,0 SumMinute,0 SumSecond
					UNION
		 select '$vTimeCode' lv001,'".$vrow['lv002']."' lv002,'".$vrow['lv004']."' lv004,100 PerCent,(select sum(left(A1.lv005,2)) + sum(substr(A1.lv005,4,5))/60 + sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') ) SumHour,0 SumMinute,0 SumSecond";
				 else
				 	$strTemp=$strTemp." Union select '".$vrow['lv001']."' lv001,'".$vrow['lv002']."' lv002,'".$vrow['lv004']."' lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003='".$vrow['lv001']."') PerCent,(select sum(left(A1.lv006,2)) + sum(substr(A1.lv006,4,5))/60 + sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') ) SumHour,0 SumMinute,0 SumSecond
					UNION
		 select '$vTimeCode' lv001,'".$vrow['lv002']."' lv002,'".$vrow['lv004']."' lv004,100 PerCent,(select sum(left(A1.lv005,2)) + sum(substr(A1.lv005,4,5))/60 + sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') ) SumHour,0 SumMinute,0 SumSecond";
			}
		}
		$sqlS=$sqlS.$strTemp.") VM left join tc_lv0002 C on VM.lv001=C.lv001   GROUP BY lv001;";
		$vSumSalary=0;
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		if($bResult ) {
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$this->ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"10","lv004"=>"10");
		if($this->lang=='CN')
		{
			$this->ArrTimeCordPush[2]="Code";
			$this->ArrTimeCordPush[3]="Name code";
			$this->ArrTimeCordPush[4]="Hour(h)";
			$this->ArrTimeCordPush[5]="Date(d)";
		}
		else
		{
			$this->ArrTimeCordPush[2]="Mã công";
			$this->ArrTimeCordPush[3]="Tên công";
			$this->ArrTimeCordPush[4]="Giờ công(h)";
			$this->ArrTimeCordPush[5]="Ngày công(d)";
		}
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrTimeCordPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				if($lstArr[$i]=='lv003')
				{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrTimeCordPush[5],$vTemp);
				$strH=$strH.$vTemp;
				}
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			 $vSumSalary= $vSumSalary+$vrow['lv006'];
			for($i=0;$i<count($lstArr);$i++)
			{				
				$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]),$lvTd);
				$strL=$strL.$vTemp;
				if($lstArr[$i]=='lv003')
				{
					$vTemp=str_replace("@02",$this->FormatView($vrow['lv003']/8,(int)$this->ArrView[$lstArr[$i]]),$lvTd);
					$strL=$strL.$vTemp;
				}
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			$strTr=str_replace("@#04","",$strTr);
			
		}
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
		
		
	
	}
	function Get_String_DateFromTo()
	{
		$this->lvHeader="";
		$vTD_TrangThai='<td >Thời gian scan</td><td>Trạng thái</td><td>Scan</td><td>Không scan</td>';
		$vTD_TrangThaiBold='<td  style="background:#d3d3d3">Thời gian scan</td><td style="background:#d3d3d3">Trạng thái</td><td style="background:#d3d3d3">Scan</td><td style="background:#d3d3d3">Không scan</td>';
		$strTD="";
		$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
		$datecur=$this->datefrom;
		for($i=1;$i<=$lvNumDate+1;$i++)
		{
			$vDows=date('w', strtotime($datecur))+1;
			if($vDows==1)
			{
				$this->DateSun++;
				$this->lvHeader=$this->lvHeader.'<td colspan="4" class="tdhprint" style="background:#d3d3d3"><center><b>'.Fillnum(getday($datecur),2).'</b></center></td>';
				$this->lvHeader1=$this->lvHeader1.$vTD_TrangThaiBold;
				$this->lvFooter=$this->lvFooter.'<td colspan="4" style="background:#d3d3d3"><center>'."<!--F-".str_replace("/","-",$datecur)."-->".'</center></td>';
				$strTD=$strTD.''."<!--".str_replace("/","-",$datecur)."-->".'';
				$this->strTDF=$this->strTDF.'<td style="background:#d3d3d3">&nbsp;</td><td style="background:#d3d3d3">&nbsp;</td>'."<td style=\"background:#d3d3d3\"><!--Scan:".str_replace("/","-",$datecur)."-->".'</td><td  style="background:#d3d3d3"><!--NoScan:'.str_replace("/","-",$datecur)."-->".'</td>';
			}
			else
			{
				$this->lvHeader=$this->lvHeader.'<td colspan="4" class="tdhprint"><center><b>'.Fillnum(getday($datecur),2).'</b></center></td>';
				$strTD=$strTD.''."<!--".str_replace("/","-",$datecur)."-->".'';
				$this->strTDF=$this->strTDF.'<td>&nbsp;</td><td>&nbsp;</td>'."<td><!--Scan:".str_replace("/","-",$datecur)."-->".'</td><td><!--NoScan:'.str_replace("/","-",$datecur)."-->".'</td>';
				$this->lvHeader1=$this->lvHeader1.$vTD_TrangThai;
				$this->lvFooter=$this->lvFooter.'<td colspan="4"><center>'."<!--F-".str_replace("/","-",$datecur)."-->".'</center></td>';
			}
			$datecur=ADDDATE($this->datefrom,$i);
		}
		return $strTD;
	}
//////////Get Filter///////////////
	protected function GetCondition()
	{
		$strCondi=" and A.lv002 in (".$this->GetMultiValue("select CC.lv001 from tc_lv0010 CC where CC.lv002 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where (DD.lv009=0 or DD.lv009=1)").")").")";
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and A.lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and A.lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and A.lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and A.lv010 like '%$this->lv010%'";
		if($this->lv028!="")  $strCondi=$strCondi." and A.lv002 in (".$this->GetMultiValue("select CC.lv001 from tc_lv0010 CC where CC.lv002 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv009 in ('".str_replace(",","','",$this->lv028)."')").")").")";
		if($this->lv029!="")  $strCondi=$strCondi." and C.lv029 in (".$this->LV_GetDep($this->lv029).")";
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
		if($this->lv028!="")  $strCondi=$strCondi." and B.lv002 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv009 in ('".str_replace(",","','",$this->lv028)."')").")";
		if($this->lv029!="")  $strCondi=$strCondi." and B.lv002 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv029 in (".$this->LV_GetDep($this->lv029).")").")";
		if($this->lv030!="")  $strCondi=$strCondi." and A.lv002 in (".$this->GetMultiValue("select CC.lv001 from tc_lv0010 CC where CC.lv002 in ('".$this->lv030."')").")";
		return $strCondi;
	}
	function GetMultiValue($sqlS)
	{
		$lv_str="";
		$bResult = db_query($sqlS);
		while ($vrow = db_fetch_array ($bResult)){	
			if($lv_str=="")
				$lv_str=$vrow['lv001'];
			else
				$lv_str=$lv_str."','".$vrow['lv001'];
		}
		$lv_str="'".$lv_str."'";
		return $lv_str;
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
			$strTemp=str_replace("@#02",$vrow[$vFieldView]."(".$vrow['lv001'].")",$strTemp);
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
			$strTemp=str_replace("@#02",$vspace.'|-----'.$vrow1[$vFieldView]."(".$vrow1['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
			$strGetScript=$strGetScript.$this->GetBuilCheckListChild($vListID,$vID,$vrow1['lv001'],$vTbl,$vFieldView,$i,$numrows,$vspace.'&nbsp;&nbsp;&nbsp;');
			$i++;
		}
		$i--;
		return $strGetScript;
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
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0002";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";				
			case 'lv010':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0004";
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
			case 'lv002':
				$vsql="select tc_lv0010.lv002,concat(hr_lv0020.lv004,' ',hr_lv0020.lv003,' ',hr_lv0020.lv002,'(',hr_lv0020.lv001,')') lv002,IF(tc_lv0010.lv001='$vSelectID',1,0) lv003 from  tc_lv0010 left join hr_lv0020 on hr_lv0020.lv001=tc_lv0010.lv002 where tc_lv0010.lv001='$vSelectID'";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0002 where lv001='$vSelectID'";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv010':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0004 where lv001='$vSelectID'";
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