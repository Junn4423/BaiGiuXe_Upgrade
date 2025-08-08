<?php
class rp_lv0011 extends lv_controler{
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
	public $ArrEmpBack=null;
	public $Str_DateFromTo=null;
	public $lvHeader=null;
	public $lvState=null;
	public $lvSort=null;
	public $mohr_lv0038=null;
	public $ArrTCEmp=null;
	public $DonXinPhep=null;
	public $ArrDaySpecial=null;
	public $vArrDay=null;
	public $MaxLe=null;
	public $ArrDEPTPROJECT=null;
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
		$this->MaxLe=Array();
	
		$this->isUnApr=0;
		$this->lang=$_GET['lang'];
		$this->ArrDaySpecial=Array();
		$this->vArrDay=Array();
		$this->ArrDEPTPROJECT=Array();
		
	}
	public function GetTimeCode($vEmployeeID,$vStartDate,$vEndDate,$vTimeCode)
	{
		return;
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
		if($this->lang=='EN')
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
	function LV_GetTangP($vTN,$vSN=3)
	{
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
	function LV_GetPhepHuong($vMonthCal,$vYearCal,$vMonthJoin,$vYearJoin)
	{
		if($vYearCal!=$vYearJoin)
		{
			return $vMonthCal;
		}
		else
		{
			return (($vMonthCal-$vMonthJoin)<0)?0:$vMonthCal-$vMonthJoin;
		}
	}
	function LV_GetFullReport($vEmpID)
	{
		$vArrSave=Array();
		$vMinDate='2016-01-01';
		$vMaxDate=$this->DateCurrent;
		$cM=getmonth($vMaxDate);
		$cY=getyear($vMaxDate);
		$this->mohr_lv0020->LV_LoadID($vEmpID);
		if($vMinDate>$this->mohr_lv0020->lv030)
		{
			$vdatefrom=$vMinDate;
		}
		else
			$vdatefrom=$this->mohr_lv0020->lv030;
		$stt=0;
		$vYearS=getyear($vdatefrom);
		$vYearE=getyear($vMaxDate);
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
				$this->datefrom=$y.'-'.Fillnum($m,2).'-01';
				$this->dateto=$y.'-'.Fillnum($m,2)."-".GetDayInMonth($y,$m);
				$this->motc_lv0013->LV_LoadActiveIDMonth($m,$y);
				$this->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$vlv221,$vlv222,$sExport,1,1);
				$vArrSave[$stt]['y']=$y;
				$vArrSave[$stt]['m']=$m;
				$vArrSave[$stt]['Emp']=$this->ArrEmp;
				$vArrSave[$stt]['EmpBack']=$this->ArrEmpBack;
				$vArrSave[$stt]['ArrTCEmp']=$this->ArrTCEmp;
				$vArrSave[$stt]['vArrDay']=$this->vArrDay;
				$vArrSave[$stt]['ArrDaySpecial']=$this->ArrDaySpecial;
				
				$vArrSave[$stt]['DateF']=$this->datefrom;
				$vArrSave[$stt]['DateT']=$this->dateto;
				$this->vArrDay=Array();
				$this->ArrDaySpecial=Array();
				$stt++;
			}
			
		}
		return $this->Get_BuildList_ArrayMuTi($vArrSave);
	}
	function LV_CheckSoNgayLe($vStartDate,$vEndDate)
	{
		$vArrLe=Array();
		$vsql="select lv002 from tc_lv0003 where (lv002>='$vStartDate 00:00:00' and lv002<='$vEndDate 23:59:59') and lv004='L'";
		$bResult=db_query($vsql);
		while($vrow = db_fetch_array ($bResult))
		{
			$vArrLe[$vrow['lv002']]=true;
		}
		return $vArrLe;
	}
	function Get_BuildList_ArrayMuTi($vArrSave)
	{
		
			$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Tháng/năm</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[14]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[15]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[16]."</b></td>".$this->lvHeader."
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">W.Day</td>
				<td colspan=\"4\" class=\"tdhprint\" width=\"10%\" align=\"center\">Monthly Taken</td>
				<td colspan=\"8\" class=\"tdhprint\" width=\"10%\" align=\"center\">Follow Up</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Total</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Total Overtime</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Total after 22h</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">SS</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">HL</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">SL</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">VR</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Tổng ngày làm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Ngày trả</td>
				<td colspan=\"3\" class=\"tdhprint\" width=\"10%\" align=\"center\">Cảnh báo</td>
			</tr>
			<tr>
				<td>DO</td>
				<td>L</td>
				<td>CL</td>
				<td>P</td>
				<td>Previous P</td>
				<td>P/Year</td>
				<td>P/Month</td>
				<td>P balance/Month</td>
				<td>Previous CL</td>
				<td>CL-L</td>
				<td>CL/Month</td>
				<td>CL balance/Month</td>
				<td>Ngày phải làm</td>
				<td>Ngày có thể/Ngày thiếu</td>
				<td>Cảnh báo</td>
			</tr>
			@01
		</table>
		";
		$lvListTrAll="";
		foreach($vArrSave as $vSave)
		{
			$this->datefrom=$vSave['DateF'];
			$this->datefrom=$vSave['DateT'];
			$this->ArrEmp=$vSave['Emp'];
			$this->ArrEmpBack=$vSave['EmpBack'];
			$this->ArrTCEmp=$vSave['ArrTCEmp'];
			$this->vArrDay=$vSave['vArrDay'];
			$this->ArrDaySpecial=$vSave['ArrDaySpecial'];
		$vMonth=getmonth($this->datefrom);
		$vYear=getyear($this->datefrom);
		$vNumMonth=	GetDayInMonth($vYear,$vMonth);
		$vEndDateInMonthNumber=(float)($vYear.$vMonth.$vNumMonth);
		$vCurDateInMonthNumber=(float)(str_replace("-","",$this->DateCurrent));
		$vOldMonth=false;
		$vDayCan=0;
		if($vCurDateInMonthNumber>$vEndDateInMonthNumber)
		{
			$vOldMonth=true;
		}
		else
		{
			$vDayCan=$vNumMonth-getday($this->DateCurrent)+1;
		}
		$vCurrentCheck=getyear($this->DateCurrent).getmonth($this->DateCurrent);
		$vCurDay=getday($this->DateCurrent);
		$vCalCheck=$vYear.$vMonth;
		for($i=1;$i<=count($this->ArrEmp);$i++)
		{
			$tNCS=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:VP']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:CT']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:SS']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:NS']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:0.5P']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:0.5CL'];
			$vSumTANGCATRUA=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCATRUA'])/$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TIMEWORK'][1]);
			$vOTTime=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['GIOTANGCA'];
			$vTANGCALE=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCALE'];
			$vTANGCADEM=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCADEM'])/$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TIMEWORK'][1]);
			if($sExport=="excel")
			{
				$lvListTrAll=$lvListTrAll.'<tr>'."<td nowrap='nowrap'>".$vMonth."/".$vYear.'</td><td nowrap="nowrap"><Data ss:Type="String">="'.$this->ArrEmp[$i][2].'"</Data>'."</td><td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$this->ArrEmp[$i][0]."\"</Data></td>";
			}
			else
			{
				$lvListTrAll=$lvListTrAll."<tr>"."<td nowrap='nowrap'>".$vMonth."/".$vYear."</td><td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][2]."</Data></td><td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][0]."</Data></td>";
			}
			$vdaydiv=22;
			$vdaydivoth=22;
			$vNgayNghi=$this->ArrTCEmp[$this->ArrEmp[$i][0]]["NgayNghi"];
			switch($vNgayNghi)
			{
				case 13:
				case 0:	
					$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['CN'];
				break;
				case 1:
					$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
					break;
				case 2:
						$vdaydiv=count($this->vArrDay)-0.5*(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				break;
				case 3: 
					$vdaydiv=count($this->vArrDay)-6;
					break;
				case 6: 
					$vdaydiv=count($this->vArrDay)-5;
					break;
				case 4: 
					$vdaydiv=8;
					break;
				case 7: 
					$vdaydiv=22;
					break;
				case 8: 
					$vdaydiv=25;
					break;
				case 9: 
					$vdaydiv=24;
					break;
				case 10: 
					$vdaydiv=26;
					break;
				case 11: 
					$vdaydiv=count($this->vArrDay);
					break;
				case 12: 
					$vdaydiv=30;
					break;
				case 5: 
					$vdaydiv=count($this->vArrDay)-4;
					break;
			}
			//echo "</br>số ngày làm việc:".$vdaydiv." / số thực làm ".$vdaydivoth."</br>";
			//Count Works Actual
			//<td>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAdd'],2)."</td>
			$vSumWDay=$tNCS+$vSumTANGCATRUA+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HL']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['0.5P']*0.5;
			$vCLAdd=($vSumWDay>$vdaydiv)?($vSumWDay-$vdaydiv):0;
			$vEmpID=$this->ArrEmp[$i][0];

			$isNotP=0;
			if(($vSumWDay+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TS'])<round($vdaydiv/2,0) || $vdaydiv==0)
			{
				if($vCurrentCheck>$vCalCheck)
				$isNotP=1;
				elseif($vCurrentCheck==$vCalCheck )
				{
					if($vCurDay>25) $isNotP=1;
				}
				else
					$isNotP=0;
			}
			else
				$isNotP=0;
			if($isNotP==1)
			{
				$FNKTinh=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FNKTinh'];//-1;
				$vCLLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L']+$vTANGCADEM+$vCLAdd-$vSumTANGCATRUA;
				$vPLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['0.5P']*0.5;
			}
			else
			{
				$FNKTinh=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FNKTinh'];
				$vCLLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L']+$vTANGCADEM+$vCLAdd-$vSumTANGCATRUA;
				$vPLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['0.5P']*0.5;
			}
			$vMessageC='';
			$vDayNeed=($vdaydiv-(($vSumWDay>$vdaydiv)?$vdaydiv:$vSumWDay));
			if($vOldMonth==false)
			{
				if($vSumWDay>=$vdaydiv)
				{
					$vMessageC='<font color="black">Đã đủ công</font>';
				}
				else
				{
					if($vDayNeed>$vDayCan)
					{
						$vMessageC='<font color="red">Thiếu công</font>';
					}
					elseif($vDayNeed<$vDayCan)
					{
						$vMessageC='<font color="blue">Tốt</font>';
					}
					else
					{
						$vMessageC='<font color="green">Không tốt</font>';
					}
				}
				
			}
			else
			{
				if($vSumWDay>$vdaydiv)
				{
					$vMessageC='<font color="blue">Dư công</font>';
				}
				elseif($vSumWDay==$vdaydiv)
					$vMessageC='<font color="green">Đủ công</font>';
				else
					$vMessageC='<font color="red">Thiếu công</font>';
			}
			
			if($this->ArrTCEmp[$this->ArrEmp[$i][0]]['VR']>round($vdaydiv/2,0)) $isNotP=1;
			$lvListTrAll=$lvListTrAll."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][1]."</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][4])."<td align=right>".round($tNCS,2)."</Data></td><td>".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['DO']+$this->ArrTCEmp[$this->ArrEmp[$i][0]][''])."</td>
			<td>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']."</td>
			<td>".round($vSumTANGCATRUA,2)."</td>
			<td>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['0.5P']*0.5,1)."</td>
			<td>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']-$FNKTinh,2)."</td>
			<td>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']."</td>
			<td>".(($isNotP==1)?0:round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,1))."</td>
			<td>".round($vPLast,2)."</td>
			<td>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious'],10)."</td>
			<td>".(($this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L']==0)?'&nbsp;':round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L'],2))."</td>
			<td>".round($vTANGCADEM+$vCLAdd,2)."</td>
			<td>".round($vCLLast,2)."</td>
			<td>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']+(($isNotP==1)?0:$this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12)-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['0.5P']*0.5+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L']+$vTANGCADEM+$vCLAdd-$vSumTANGCATRUA,1)."</td>			
			<td align=right>".$vOTTime."</td>
			<td align=right>".round($this->GetTime($vTANGCALE),1)."</td>
			<td align=right>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['SS']."</td>
			<td align=right>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HL']."</td>
			<td align=right>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['SL']."</td>
			<td align=right>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['VR']."</td>
			<td align=right>".round($vSumWDay,2)."</td>
			<td align=right>".round(($vSumWDay>$vdaydiv)?$vdaydiv:$vSumWDay,2)."</td>
			<td align=right>".$vdaydiv."</td>
			<td align=center>".$vDayCan."/".$vDayNeed."</td>
			<td align=left>".$vMessageC."</td>
			</tr>";

			//echo $this->ArrEmp[$i][0].":".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimePhepPrevious']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Prev']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAdd']."-".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeClear']."-".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeBUsed'].$vBr;
		}
		}
		return str_replace("@01",$lvListTrAll,$vTable);
	}
//////////////////////Buil list////////////////////
	function LV_BuilListReportOtherPrintLateSoon($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvopt,$vmau=0,$vshowgiokem=0,$sExport,$ShowOnce=0,$ShowDept=0)
	{		
		$this->MaxLe=$this->LV_CheckSoNgayLe($this->datefrom,$this->dateto);
		$vArrState=Array(1=>'T',2=>'S',3=>'TS',4=>'Q');
		$this->ArrTCEmp=Array();
		$this->Get_Arr_Employees($ShowOnce,$ShowDept);
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
		$sqlS = "SELECT A.lv002,A.lv003,DAYOFWEEK(A.lv004) DOWS, ADDDATE('$this->datefrom',-1) DtFrom,ADDDATE('$this->dateto',1) DtTo,ADDDATE(A.lv004,1) DateNext,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,A.lv014,A.lv015,A.lv016,A.lv017,A.lv018,A.lv019,A.lv020,B.lv002 NVID,C.lv030 DateWork,C.lv029 lv001,D.lv007 Shift,IF(ISNULL(A.lv016),'00:00:00',A.lv016) TANGCATRUA,A.lv017 TANGCADEM,A.lv018 TANGCALE,A.lv021,D.lv003 FN_Nam,D.lv100 TimePhepPrevious,D.lv101 TimeAddPrevious,D.lv102 PYear,D.lv008 FN_Prev,(select sum(BB.lv096) from tc_lv0009 BB where BB.lv002=C.lv001 and BB.lv004=year(A.lv004) and BB.lv003<>month(A.lv004)) TimeAdd,(select sum(BB.lv131) from tc_lv0009 BB where BB.lv002=C.lv001 and BB.lv004=year(A.lv004) And BB.lv130=1 ) FNKTinh,D.lv098 TimeClear,D.lv099 TimeBUsed,C.lv102 Num_FN_F,(((year('$this->datefrom')-year(C.lv030))*12+month('$this->datefrom')-month(C.lv030))/12) Num_FN_FM,E.lv095 CL_L,E.lv096 CL_TimeSum,F.lv006 IsFNMonth,E.lv120 LastP,E.lv121 FirstP,E.lv122 LastCL,E.lv123 FirstCL FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 left join hr_lv0020 C on C.lv001=B.lv002 left join tc_lv0008 D on D.lv002=B.lv002  and D.lv005=year(A.lv004) left join tc_lv0009 E on E.lv002=B.lv002 and E.lv004=year(A.lv004) and E.lv003=month(A.lv004)  left join hr_lv0002 F on C.lv029=F.lv001  WHERE  A.lv100<>1  ".$this->GetConditionOrther()."  order by C.lv029 ASC,A.lv004 ASC";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$an=rand(0,1);	
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
		while ($vrow = db_fetch_array ($bResult)){
			$lvvt=$this->ArrEmpBack[$vrow['NVID']];
			if($lvvt!=0 && $lvvt!=NULL)
			{
			//NVID NVID
			//lv010 Ca		
			//Shift year
			if($vrow['DtFrom']!=$vrow['lv004'] && $vrow['DtTo']!=$vrow['lv004'])
			{
				
			if($this->ArrTCEmp[$vrow['NVID']]['TIMEWORK'][0]!=TRUE)
			{
				$this->mohr_lv0038->LV_LoadActive($vrow['NVID']);
				$this->ArrTCEmp[$vrow['NVID']]['TIMEWORK'][0]=TRUE;
				if($this->mohr_lv0038->lv007=="" || $this->mohr_lv0038->lv007=="00:00:00" || $this->mohr_lv0038->lv007==NULL)
					$this->ArrTCEmp[$vrow['NVID']]['TIMEWORK'][1]="08:00:00";
				else
					$this->ArrTCEmp[$vrow['NVID']]['TIMEWORK'][1]=$this->mohr_lv0038->lv007;
				$this->ArrTCEmp[$vrow['NVID']]["NgayNghi"]=$this->mohr_lv0038->lv011;
			}
			$this->ArrDEPTPROJECTLEV0[$vrow['lv001']]=$vrow['lv001'];
			$this->ArrDEPTPROJECTLEV1[$vrow['lv001']][$vrow['lv021']][0]=$vrow['lv001'];
			$this->ArrDEPTPROJECTLEV1[$vrow['lv001']][$vrow['lv021']][1]=$vrow['lv021'];
			
			if($this->ArrDEPTPROJECT[$vrow['lv001']][$vrow['lv021']][$vrow['lv007']][$vrow['lv004']][0]==NULL)
				$this->ArrDEPTPROJECT[$vrow['lv001']][$vrow['lv021']][$vrow['lv007']][$vrow['lv004']][0]=$vrow['lv005'];
			else
				$this->ArrDEPTPROJECT[$vrow['lv001']][$vrow['lv021']][$vrow['lv007']][$vrow['lv004']][0]=TIMEADD($vrow['lv005'],$this->ArrDEPTPROJECT[$vrow['lv001']][$vrow['lv021']][$vrow['lv007']][$vrow['lv004']][0]);
			$this->ArrDEPTPROJECT[$vrow['lv001']][$vrow['lv021']][$vrow['lv007']][$vrow['lv004']][1]=$vrow['lv001'];
			$this->ArrDEPTPROJECT[$vrow['lv001']][$vrow['lv021']][$vrow['lv007']][$vrow['lv004']][2]=$vrow['lv021'];
			$this->ArrDEPTPROJECT[$vrow['lv001']][$vrow['lv021']][$vrow['lv007']][$vrow['lv004']][3]=$vrow['lv007'];
			$this->ArrDEPTPROJECT[$vrow['lv001']][$vrow['lv021']][$vrow['lv007']][$vrow['lv004']][4]=$vrow['lv004'];
			$vYearCal=getyear($vrow['lv004']);
			$vTimeWork=$this->ArrTCEmp[$vrow['NVID']]['TIMEWORK'][1];
			$this->ArrTCEmp[$vrow['NVID']]['IsFNMonth']=$vrow['IsFNMonth'];
			//echo ($vrow['TimePhepPrevious']).$vBr;
			
			//$vP=($vrow['IsFNMonth']==0)?(($vrow['TimePhepPrevious']!=0)?$vrow['TimePhepPrevious']:(($vYearCal!='2015')?$vrow['PYear']:'0')):((($vYearCal=='2015')?0:$vrow['FN_Nam'])+$vrow['TimePhepPrevious']);
			//if($vrow['NVID']=='0197') echo $vrow['PYear'].'P:'.$vP.$vBr;
			$this->ArrTCEmp[$vrow['NVID']]['TimePhepPrevious']=$vrow['TimePhepPrevious'];
			//2015 lấy cấu trúc cũ.2016
			if(getmonth($this->datefrom)==1  || $vYearCal=='2015')
				$this->ArrTCEmp[$vrow['NVID']]['TimeAddPrevious']=$vrow['TimeAddPrevious'];
			else
				$this->ArrTCEmp[$vrow['NVID']]['TimeAddPrevious']=$vrow['FirstCL'];
			$this->ArrTCEmp[$vrow['NVID']]['FN_Prev']=$vrow['FN_Prev'];
			$this->ArrTCEmp[$vrow['NVID']]['TimeAdd']=$vrow['TimeAdd'];
			$this->ArrTCEmp[$vrow['NVID']]['FNKTinh']=$vrow['FNKTinh'];
			
			$this->ArrTCEmp[$vrow['NVID']]['TimeClear']=$vrow['TimeClear'];
			$this->ArrTCEmp[$vrow['NVID']]['TimeBUsed']=$vrow['TimeBUsed'];
			$this->ArrTCEmp[$vrow['NVID']]['Num_FN_FM']=$vrow['Num_FN_FM'];
			$vNum_FN_FM=$this->LV_GetTangP($this->LV_GetChan($this->ArrTCEmp[$vrow['NVID']]['Num_FN_FM']));
			
			//echo $vrow['NVID'].":".$vrow['TimeBUsed'].$vBr;
			$this->ArrTCEmp[$vrow['NVID']]['Num_FN_F']=$vrow['Num_FN_F']+$vNum_FN_FM;
			if($this->ArrTCEmp[$vrow['NVID']]['Num_FN_F']>20) $this->ArrTCEmp[$vrow['NVID']]['Num_FN_F']=20;
			$vNumCal=1;
			/*if($vYearCal<='2015')
				$vNumCal=1;
			else
				$vNumCal=$this->LV_GetPhepHuong(getmonth($vrow['lv004']),$vYearCal,getmonth($vrow['DateWork']),getyear($vrow['DateWork']));*/
			if(getmonth($this->datefrom)==1 || $vYearCal=='2015')
				$vP=$vrow['TimePhepPrevious'];
			else
				$vP=$vrow['FirstP'];
			$this->ArrTCEmp[$vrow['NVID']]['FN_Nam']=$vP;//$vrow['FN_Nam'];//($vrow['IsFNMonth']==0)?(($vrow['TimePhepPrevious']!=0)?$vrow['TimePhepPrevious']:$vrow['PYear']):($vrow['FN_Nam']+$vrow['TimePhepPrevious']);			
			$this->ArrTCEmp[$vrow['NVID']]['TANGCATRUA']=TIMEADD($this->ArrTCEmp[$vrow['NVID']]['TANGCATRUA'],$vrow['TANGCATRUA']);
			$this->ArrTCEmp[$vrow['NVID']]['TANGCALE']=TIMEADD($this->ArrTCEmp[$vrow['NVID']]['TANGCALE'],$vrow['TANGCALE']);
			$this->ArrTCEmp[$vrow['NVID']]['TANGCADEM']=TIMEADD($this->ArrTCEmp[$vrow['NVID']]['TANGCADEM'],$vrow['TANGCADEM']);
			if($vrow['lv014']!=NULL && $vrow['lv014']!="00:00:00" && $vrow['lv014']!="") 
			{
				$this->ArrTCEmp[$vrow['NVID']]['GIOTANGCA']=TIMEADD(($this->ArrTCEmp[$vrow['NVID']]['GIOTANGCA']==NULL)?'00:00:00':$this->ArrTCEmp[$vrow['NVID']]['GIOTANGCA'],$vrow['lv014']);
			}
			$vTimeWorks=$this->GetTime($this->ArrTCEmp[$vrow['NVID']]['TIMEWORK'][1]);
			if($vTimeWorks!=0)
			{
				if($vrow['lv007']=='0.5P')
				{
					if($vrow['DOWS']==1) if($vrow['lv005']!='04:00:00') $this->ArrTCEmp[$vrow['NVID']]['CN:'.$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']]['CN:'.$vrow['lv007']]+($this->GetTime($vrow['lv005'])-4)/$vTimeWorks;
					
						if($vrow['lv005']!='04:00:00') $this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]+($this->GetTime($vrow['lv005'])-4)/$vTimeWorks;
				}
				else
				{
					if($vrow['DOWS']==1) $this->ArrTCEmp[$vrow['NVID']]['CN:'.$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']]['CN:'.$vrow['lv007']]+$this->GetTime($vrow['lv005'])/$vTimeWorks;
						$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]+$this->GetTime($vrow['lv005'])/$vTimeWorks;
				}
			}
				
				switch($vrow['lv007'])
				{
					case 'SS':
						if(str_replace(":","",$vrow['lv005'])>=40000) $this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]+1;
						break;
					default:
						if($this->MaxLe[$vrow['lv004']]==true)
						{
							if($vrow['lv007']=='VP' || $vrow['lv007']=='CT') $this->ArrTCEmp[$vrow['NVID']]['L']=$this->ArrTCEmp[$vrow['NVID']]['L']+1;
						}							
						
						$this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]+1;
						break;
				}
			
			}
			$vListShiftReceive=$this->ArrDep[$vrow['lv001']][0];
			$arrTime=null;
			$arrShift=$this->GetTimeListArr($vrow['NVID'],$vrow['lv004'],$vrow['lv015'],$vrow['Shift'],$passday,$vListShiftReceive,$vPreShift[$vrow['NVID']][$vrow['lv004']],$arrTime);
			$lvcheck=$this->LV_CheckLateSoon($vrow['NVID'],$vrow['lv015'],$vrow['Shift'],$arrShift);
			$this->ArrStateEmp[$vrow['lv004']][$lvcheck]=$this->ArrStateEmp[$vrow['lv004']][$lvcheck]+1;
			
			$strL="";
			$vorder++;
			$lvstrgt="";
			foreach($lvparatimecard as $lvgt)
			{
				if(count($lvparatimecard)==1)
					$vBr="";
				else
					$vBr="<br/>";
				switch ($lvgt)
				{
					case 5:
						if($this->lvState==0)
							$lvstrgt=$lvstrgt.$vrow['lv005'].$vBr;
						else
							$lvstrgt=$lvstrgt.(($an)?'RH:':'').'<b>'.$vrow['lv005']."</b><br/>";
						break;
					case 6:
						if($this->lvState==0)
							$lvstrgt=$lvstrgt.$vrow['lv014'].$vBr;
						else
							$lvstrgt=$lvstrgt.(($an)?'TCTh:':'').'<b>'.$vrow['lv006']."</b><br/>";
						break;
					case 8:
						if($this->lvState==0)
							$lvstrgt=$lvstrgt.$vrow['lv016'].$vBr;
						else
							$lvstrgt=$lvstrgt.(($an)?'TCTr:':'').'<b>'.$vrow['lv016']."</b><br/>";
						break;
					case 9:
						if($this->lvState==0)
							$lvstrgt=$lvstrgt.$vrow['lv017'].$vBr;
						else
							$lvstrgt=$lvstrgt.(($an)?'TCDe:':'').'<b>'.$vrow['lv017']."</b><br/>";
						break;
					case 10:
						if($this->lvState==0)
							$lvstrgt=$lvstrgt.$vrow['lv018'].$vBr;
						else
							$lvstrgt=$lvstrgt.(($an)?'TCLe:':'').'<b>'.$vrow['lv018']."</b><br/>";
						break;
					case 18:
						if($this->lvState==0)
							$lvstrgt=$lvstrgt.$vrow['lv021'].$vBr;
						else
							$lvstrgt=$lvstrgt.(($an)?'PR:':'').'<b>'.$vrow['lv021']."</b><br/>";
						break;
					case 7:
						if($this->lvState==0)
						{
							if($vshowgiokem==1)
							{
								if($vrow['lv005']!=$vTimeWork && $vrow['lv005']!="00:00:00")
								{
									if($vrow['lv007']=='VR' || $vrow['lv007']=="SL"  || $vrow['lv007']=="0.5P" || $vrow['lv007']=="P")
											$lvstrgt=$lvstrgt.$vrow['lv007']."";
									else
									$lvstrgt=$lvstrgt.round(($this->GetTime($vrow['lv005'])/8),2)."";
								}
								else
								{
									if(($vrow['lv007']=='8' || $vrow['lv007']=='NS' || $vrow['lv007']=='SS' ) )
									{
										if($vrow['lv005']!="00:00:00")
											$lvstrgt=$lvstrgt.round(($this->GetTime($vrow['lv005'])/8),2)."";
										else
											$lvstrgt=$lvstrgt.'&nbsp;'."";
									}
									else
									{
										if(($vrow['lv007']=='CL'))
										{
											if(($vrow['lv016']=='08:00:00'))
												$lvstrgt=$lvstrgt.$vrow['lv007']."";
											else
												if(($vrow['lv016']=='00:00:00'))
												{
													$lvstrgt=$lvstrgt.'&nbsp;'."";
												}
												else
												{
													$lvstrgt=$lvstrgt.$this->GetTime($vrow['lv016']).$vrow['lv007']."";
												}
										}
										elseif(($vrow['lv007']=='0.5CL'))
										{
											if(($vrow['lv016']=='04:00:00'))
												$lvstrgt=$lvstrgt.$vrow['lv007']."";
											else
												if(($vrow['lv016']=='00:00:00'))
												{
													$lvstrgt=$lvstrgt.'&nbsp;'."";
												}
												else
												{
													$lvstrgt=$lvstrgt.$vrow['lv007']."";
												}
										}
										else
										{
											if($vrow['lv005']!="00:00:00" || $vrow['lv007']=='TS' || $vrow['lv007']=='VR' || $vrow['lv007']=="SL"  || $vrow['lv007']=="0.5P" || $vrow['lv007']=="P")
												$lvstrgt=$lvstrgt.$vrow['lv007']."";
											else
												$lvstrgt=$lvstrgt.'&nbsp;'."";
										}
									}
										
								}
							}
							else
								$lvstrgt=$lvstrgt.$vrow['lv007']."";
						}
						else
						{
							if($vshowgiokem==1)
							{
								if($vrow['lv005']!=$vTimeWork && $vrow['lv005']!="00:00:00")
									$lvstrgt=$lvstrgt.(($an)?'Code:':'').'<b>'.(round($this->GetTime($vrow['lv005'])/8,2)).$vrow['lv007']."</b>";
								else
								{
									if($vrow['lv007']=='8' || $vrow['lv007']=='NS' || $vrow['lv007']=='SS')
									{
										if($vrow['lv005']!="00:00:00")
											$lvstrgt=$lvstrgt.(($an)?'Code:':'').'<b>'.round(($this->GetTime($vrow['lv005'])/8),2)."</b>";
										else
											$lvstrgt=$lvstrgt.(($an)?'Code:':'')."<b>&nbsp;</b>";
									}
										
									else
									{
										if($vrow['lv005']!="00:00:00"  || $vrow['lv007']=='VR' || $vrow['lv007']=="SL")
											$lvstrgt=$lvstrgt.(($an)?'Code:':'').'<b>'.$vrow['lv007']."</b>";
										else
											$lvstrgt=$lvstrgt.(($an)?'Code:':'')."<b>&nbsp;</b>";
									}
										
								}
							}
							else
							{
								if($vrow['lv007']=='8' || $vrow['lv007']=='NS' || $vrow['lv007']=='SS')
									$lvstrgt=$lvstrgt.(($an)?'Code:':'').'<b>'.round(($this->GetTime($vrow['lv005'])/8),2)."</b>";
								else
									$lvstrgt=$lvstrgt.(($an)?'Code:':'').'<b>'.$vrow['lv007']."</b>";
							}
						}
						break;
					case 15:
						if($this->lvState==0)
						{
							if($vshowgiokem==1)
							{
								if($vrow['lv005']!=$vTimeWork && $vrow['lv005']!="00:00:00")
									$lvstrgt=$lvstrgt.'<br/>'.'<b>'.(round($this->GetTime($vrow['lv005'])/8,2)).$vrow['lv015']."</b><br/>";
								else
									$lvstrgt=$lvstrgt.'<br/>'.$vrow['lv015'].$vBr;
							}
							else
								$lvstrgt=$lvstrgt.'<br/>'.$vrow['lv015'].$vBr;
						}
						else
						{
							if($vshowgiokem==1)
							{
								if($vrow['lv005']!=$vTimeWork && $vrow['lv005']!="00:00:00")
									$lvstrgt=$lvstrgt.'<br/>'.(($an)?'Shift:':'').'<b>'.(round($this->GetTime($vrow['lv005'])/8,2)).$vrow['lv015']."</b><br/>";
								else
									$lvstrgt=$lvstrgt.'<br/>'.(($an)?'Shift:':'').'<b>'.$vrow['lv015']."</b><br/>";
							}
							else
								$lvstrgt=$lvstrgt.'<br/>'.(($an)?'Shift:':'').'<b>'.$vrow['lv015']."</b><br/>";
						}
						break;
					case 20:
						if($this->lvState==0)
						{
							$lvstrgt=$lvstrgt.$this->GetTimeListMore($arrTime,$vCount).$vBr;
						}
						else 
						{
							$lvstrgt=$lvstrgt.(($an)?'In-Out:':'').'<b>'.$this->GetTimeListMore($arrTime,$vCount)."</b><br/>";
						}
						break;
					case 21:
						if($this->lvState==0)
							$lvstrgt=$lvstrgt.'<br/>'.$vArrState[$lvcheck].$vBr;
						else
						$lvstrgt=$lvstrgt.(($an)?'State:':'').'<br/><b>'.$vArrState[$lvcheck]."</b><br/>";
						break;
					case 31:
						if($this->lvState!=0) $lvstrgt=$lvstrgt.(($an)?$vArrState[$lvcheck]:'');				
						$lvstrgt=$lvstrgt.'<br/><b>';
						switch($lvcheck)
						{
							case 1:
								$lvstrgt=$lvstrgt.substr($vrow['lv019'],0,5);
								break;
							case 2:
								$lvstrgt=$lvstrgt.substr($vrow['lv020'],0,5);
								break;
							case 3:
								$lvstrgt=$lvstrgt.substr($vrow['lv019'],0,5)."|".substr($vrow['lv020'],0,5);
								break;
						}
						$lvstrgt=$lvstrgt."</b><br/>";
						break;
				}
			}
			$this->ArrEmp[$lvvt][4]=str_replace("<!--".$vrow['lv004']."-->",($lvstrgt==NULL || trim($lvstrgt)=='')?'&nbsp;':$lvstrgt,$this->ArrEmp[$lvvt][4]);
			/*
			for($i=0;$i<count($lstArr);$i++)
			{
				
				if($lstArr[$i]=='lv011')
					{
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->GetTimeList($vrow['NVID'],$vrow['lv004'],$lvopt)),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						
					}
					else if($lstArr[$i]=='lv012')
					{
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$lvcheck),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
					else
					{
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			*/
			$vPreShift[$vrow['NVID']][$vrow['DateNext']][0]=$vrow['lv015'];
			$vPreShift[$vrow['NVID']][$vrow['DateNext']][1]=$passday;
			}
		}
		//$strTrH=str_replace("@#01",$strH,$lvTrH);
		if($ShowOnce==1) return;
		return $this->Get_BuildList_Array($sExport);
	}
	//////////////////////Buil list////////////////////
	function LV_BuilListReportOtherPrintClearP_CL($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvopt,$vmau=0,$vshowgiokem=0,$sExport)
	{		
		$vArrState=Array(1=>'T',2=>'S',3=>'TS',4=>'Q');
		$this->Get_Arr_Employees();
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
		$sqlS = "SELECT A.lv002,A.lv003, ADDDATE('$this->datefrom',-1) DtFrom,ADDDATE('$this->dateto',1) DtTo,ADDDATE(A.lv004,1) DateNext,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,A.lv015,A.lv016,A.lv019,A.lv020,B.lv002 NVID,C.lv030 DateWork,C.lv029 lv001,D.lv007 Shift,IF(ISNULL(A.lv016),'00:00:00',A.lv016) TANGCATRUA,A.lv017 TANGCADEM,A.lv018 TANGCALE,D.lv003 FN_Nam,D.lv100 TimePhepPrevious,D.lv101 TimeAddPrevious,D.lv102 PYear,D.lv008 FN_Prev,(select sum(BB.lv096) from tc_lv0009 BB where BB.lv002=C.lv001 and BB.lv004=year(A.lv004) and BB.lv003<>month(A.lv004)) TimeAdd,D.lv098 TimeClear,D.lv099 TimeBUsed,C.lv102 Num_FN_F,(((year('$this->datefrom')-year(C.lv030))*12+month('$this->datefrom')-month(C.lv030))/12) Num_FN_FM,E.lv095 CL_L,E.lv096 CL_TimeSum,F.lv006 IsFNMonth,E.lv120 LastP,E.lv121 FirstP,E.lv122 LastCL,E.lv123 FirstCL FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 left join hr_lv0020 C on C.lv001=B.lv002 left join tc_lv0008 D on D.lv002=B.lv002  and D.lv005=year(A.lv004) left join tc_lv0009 E on E.lv002=B.lv002 and E.lv004=year(A.lv004) and E.lv003=month(A.lv004)  left join hr_lv0002 F on C.lv029=F.lv001  WHERE  A.lv100<>1  ".$this->GetConditionOrther()."  order by C.lv029 ASC,A.lv004 ASC";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$an=rand(0,1);
		
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
		while ($vrow = db_fetch_array ($bResult)){
			$lvvt=$this->ArrEmpBack[$vrow['NVID']];
			//NVID NVID
			//lv010 Ca		
			//Shift year
			if($vrow['DtFrom']!=$vrow['lv004'] && $vrow['DtTo']!=$vrow['lv004'])
			{
			if($this->ArrTCEmp[$vrow['NVID']]['TIMEWORK'][0]!=TRUE)
			{
				$this->mohr_lv0038->LV_LoadActive($vrow['NVID']);
				$this->ArrTCEmp[$vrow['NVID']]['TIMEWORK'][0]=TRUE;
				if($this->mohr_lv0038->lv007=="" || $this->mohr_lv0038->lv007=="00:00:00" || $this->mohr_lv0038->lv007==NULL)
					$this->ArrTCEmp[$vrow['NVID']]['TIMEWORK'][1]="08:00:00";
				else
					$this->ArrTCEmp[$vrow['NVID']]['TIMEWORK'][1]=$this->mohr_lv0038->lv007;
				$this->ArrTCEmp[$vrow['NVID']]["NgayNghi"]=$this->mohr_lv0038->lv011;
			}
			$vYearCal=getyear($vrow['lv004']);
			$vTimeWork=$this->ArrTCEmp[$vrow['NVID']]['TIMEWORK'][1];
			$this->ArrTCEmp[$vrow['NVID']]['IsFNMonth']=$vrow['IsFNMonth'];
			//echo ($vrow['TimePhepPrevious']).$vBr;
			
			//$vP=($vrow['IsFNMonth']==0)?(($vrow['TimePhepPrevious']!=0)?$vrow['TimePhepPrevious']:(($vYearCal!='2015')?$vrow['PYear']:'0')):((($vYearCal=='2015')?0:$vrow['FN_Nam'])+$vrow['TimePhepPrevious']);
			//if($vrow['NVID']=='0197') echo $vrow['PYear'].'P:'.$vP.$vBr;
			$this->ArrTCEmp[$vrow['NVID']]['TimePhepPrevious']=$vrow['TimePhepPrevious'];
			//2015 lấy cấu trúc cũ.2016
			if(getmonth($this->datefrom)==1  || $vYearCal=='2015')
				$this->ArrTCEmp[$vrow['NVID']]['TimeAddPrevious']=$vrow['TimeAddPrevious'];
			else
				$this->ArrTCEmp[$vrow['NVID']]['TimeAddPrevious']=$vrow['FirstCL'];
			$this->ArrTCEmp[$vrow['NVID']]['FN_Prev']=$vrow['FN_Prev'];
			$this->ArrTCEmp[$vrow['NVID']]['TimeAdd']=$vrow['TimeAdd'];
			$this->ArrTCEmp[$vrow['NVID']]['TimeClear']=$vrow['TimeClear'];
			$this->ArrTCEmp[$vrow['NVID']]['TimeBUsed']=$vrow['TimeBUsed'];
			$this->ArrTCEmp[$vrow['NVID']]['Num_FN_FM']=$vrow['Num_FN_FM'];
			$vNum_FN_FM=$this->LV_GetTangP($this->LV_GetChan($this->ArrTCEmp[$vrow['NVID']]['Num_FN_FM']));
			
			//echo $vrow['NVID'].":".$vrow['TimeBUsed'].$vBr;
			$this->ArrTCEmp[$vrow['NVID']]['Num_FN_F']=$vrow['Num_FN_F']+$vNum_FN_FM;
			if($this->ArrTCEmp[$vrow['NVID']]['Num_FN_F']>20) $this->ArrTCEmp[$vrow['NVID']]['Num_FN_F']=20;
			$vNumCal=1;
			/*if($vYearCal<='2015')
				$vNumCal=1;
			else
				$vNumCal=$this->LV_GetPhepHuong(getmonth($vrow['lv004']),$vYearCal,getmonth($vrow['DateWork']),getyear($vrow['DateWork']));*/
			if(getmonth($this->datefrom)==1 || $vYearCal=='2015')
				if($vYearCal=='2015')
					$vP=$vrow['TimePhepPrevious'];
				else
					$vP=$vrow['TimePhepPrevious'];
			else
				$vP=$vrow['FirstP'];
			$this->ArrTCEmp[$vrow['NVID']]['FN_Nam']=$vP;//$vrow['FN_Nam'];//($vrow['IsFNMonth']==0)?(($vrow['TimePhepPrevious']!=0)?$vrow['TimePhepPrevious']:$vrow['PYear']):($vrow['FN_Nam']+$vrow['TimePhepPrevious']);
			$this->ArrTCEmp[$vrow['NVID']]['CL_L']=$vrow['CL_L'];
			$this->ArrTCEmp[$vrow['NVID']]['CL_TimeSum']=$vrow['CL_TimeSum'];
			
			$this->ArrTCEmp[$vrow['NVID']]['TANGCATRUA']=TIMEADD($this->ArrTCEmp[$vrow['NVID']]['TANGCATRUA'],$vrow['TANGCATRUA']);
			$this->ArrTCEmp[$vrow['NVID']]['TANGCALE']=TIMEADD($this->ArrTCEmp[$vrow['NVID']]['TANGCALE'],$vrow['TANGCALE']);
			$this->ArrTCEmp[$vrow['NVID']]['TANGCADEM']=TIMEADD($this->ArrTCEmp[$vrow['NVID']]['TANGCADEM'],$vrow['TANGCADEM']);
			if($vrow['lv014']!=NULL && $vrow['lv014']!="00:00:00" && $vrow['lv014']!="") 
			{
				$this->ArrTCEmp[$vrow['NVID']]['GIOTANGCA']=TIMEADD(($this->ArrTCEmp[$vrow['NVID']]['GIOTANGCA']==NULL)?'00:00:00':$this->ArrTCEmp[$vrow['NVID']]['GIOTANGCA'],$vrow['lv014']);
			}
			$vTimeWorks=$this->GetTime($this->ArrTCEmp[$vrow['NVID']]['TIMEWORK'][1]);
			if($vTimeWorks!=0)
			{
				if($vrow['lv007']=='0.5P')
				{
					if($vrow['lv005']!='04:00:00') $this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]+($this->GetTime($vrow['lv005'])-4)/$vTimeWorks;
				}
				else
					$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]+$this->GetTime($vrow['lv005'])/$vTimeWorks;
			}
				
				switch($vrow['lv007'])
				{
					case 'SS':
						if(str_replace(":","",$vrow['lv005'])>=40000) $this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]+1;
						break;
					default:
						$this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]+1;
						break;
				}
			
			}
			$vListShiftReceive=$this->ArrDep[$vrow['lv001']][0];
			$arrTime=null;
			$arrShift=$this->GetTimeListArr($vrow['NVID'],$vrow['lv004'],$vrow['lv015'],$vrow['Shift'],$passday,$vListShiftReceive,$vPreShift[$vrow['NVID']][$vrow['lv004']],$arrTime);
			$lvcheck=$this->LV_CheckLateSoon($vrow['NVID'],$vrow['lv015'],$vrow['Shift'],$arrShift);
			$this->ArrStateEmp[$vrow['lv004']][$lvcheck]=$this->ArrStateEmp[$vrow['lv004']][$lvcheck]+1;
			
			$strL="";
			$vorder++;
			$lvstrgt="";
			foreach($lvparatimecard as $lvgt)
			{
				switch ($lvgt)
				{
					case 5:
						if($this->lvState==0)
							$lvstrgt=$lvstrgt.$vrow['lv005'].$vBr;
						else
							$lvstrgt=$lvstrgt.(($an)?'RH:':'').'<b>'.$vrow['lv005']."</b><br/>";
						break;
					case 6:
						if($this->lvState==0)
							$lvstrgt=$lvstrgt.$vrow['lv006'].$vBr;
						else
							$lvstrgt=$lvstrgt.(($an)?'OH:':'').'<b>'.$vrow['lv006']."</b><br/>";
						break;
					case 7:
						if($this->lvState==0)
						{
							if($vshowgiokem==1)
							{
								if($vrow['lv005']!=$vTimeWork && $vrow['lv005']!="00:00:00")
								{
									if($vrow['lv007']=='VR' || $vrow['lv007']=="SL"  || $vrow['lv007']=="0.5P" || $vrow['lv007']=="P")
											$lvstrgt=$lvstrgt.$vrow['lv007']."";
									else
									$lvstrgt=$lvstrgt.(round($this->GetTime($vrow['lv005']),1))."";
								}
								else
								{
									if(($vrow['lv007']=='8' || $vrow['lv007']=='NS' || $vrow['lv007']=='SS' ) )
									{
										if($vrow['lv005']!="00:00:00")
											$lvstrgt=$lvstrgt.$this->GetTime($vrow['lv005'])."";
										else
											$lvstrgt=$lvstrgt.'&nbsp;'."";
									}
									else
									{
										if(($vrow['lv007']=='CL'))
										{
											if(($vrow['lv016']=='08:00:00'))
												$lvstrgt=$lvstrgt.$vrow['lv007']."";
											else
												if(($vrow['lv016']=='00:00:00'))
												{
													$lvstrgt=$lvstrgt.'&nbsp;'."";
												}
												else
												{
													$lvstrgt=$lvstrgt.$this->GetTime($vrow['lv016']).$vrow['lv007']."";
												}
										}
										elseif(($vrow['lv007']=='0.5CL'))
										{
											if(($vrow['lv016']=='04:00:00'))
												$lvstrgt=$lvstrgt.$vrow['lv007']."";
											else
												if(($vrow['lv016']=='00:00:00'))
												{
													$lvstrgt=$lvstrgt.'&nbsp;'."";
												}
												else
												{
													$lvstrgt=$lvstrgt.$vrow['lv007']."";
												}
										}
										else
										{
											if($vrow['lv005']!="00:00:00" || $vrow['lv007']=='TS' || $vrow['lv007']=='VR' || $vrow['lv007']=="SL"  || $vrow['lv007']=="0.5P" || $vrow['lv007']=="P")
												$lvstrgt=$lvstrgt.$vrow['lv007']."";
											else
												$lvstrgt=$lvstrgt.'&nbsp;'."";
										}
									}
										
								}
							}
							else
								$lvstrgt=$lvstrgt.$vrow['lv007']."";
						}
						else
						{
							if($vshowgiokem==1)
							{
								if($vrow['lv005']!=$vTimeWork && $vrow['lv005']!="00:00:00")
									$lvstrgt=$lvstrgt.(($an)?'Code:':'').'<b>'.(round($this->GetTime($vrow['lv005'])/8,2)).$vrow['lv007']."</b>";
								else
								{
									if($vrow['lv007']=='8' || $vrow['lv007']=='NS' || $vrow['lv007']=='SS')
									{
										if($vrow['lv005']!="00:00:00")
											$lvstrgt=$lvstrgt.(($an)?'Code:':'').'<b>'.$this->GetTime($vrow['lv005'])."</b>";
										else
											$lvstrgt=$lvstrgt.(($an)?'Code:':'')."<b>&nbsp;</b>";
									}
										
									else
									{
										if($vrow['lv005']!="00:00:00"  || $vrow['lv007']=='VR' || $vrow['lv007']=="SL")
											$lvstrgt=$lvstrgt.(($an)?'Code:':'').'<b>'.$vrow['lv007']."</b>";
										else
											$lvstrgt=$lvstrgt.(($an)?'Code:':'')."<b>&nbsp;</b>";
									}
										
								}
							}
							else
							{
								if($vrow['lv007']=='8' || $vrow['lv007']=='NS' || $vrow['lv007']=='SS')
									$lvstrgt=$lvstrgt.(($an)?'Code:':'').'<b>'.$this->GetTime($vrow['lv005'])."</b>";
								else
									$lvstrgt=$lvstrgt.(($an)?'Code:':'').'<b>'.$vrow['lv007']."</b>";
							}
						}
						break;
					case 15:
						if($this->lvState==0)
						{
							if($vshowgiokem==1)
							{
								if($vrow['lv005']!=$vTimeWork && $vrow['lv005']!="00:00:00")
									$lvstrgt=$lvstrgt.'<br/>'.'<b>'.(round($this->GetTime($vrow['lv005'])/8,2)).$vrow['lv015']."</b><br/>";
								else
									$lvstrgt=$lvstrgt.'<br/>'.$vrow['lv015'].$vBr;
							}
							else
								$lvstrgt=$lvstrgt.'<br/>'.$vrow['lv015'].$vBr;
						}
						else
						{
							if($vshowgiokem==1)
							{
								if($vrow['lv005']!=$vTimeWork && $vrow['lv005']!="00:00:00")
									$lvstrgt=$lvstrgt.'<br/>'.(($an)?'Shift:':'').'<b>'.(round($this->GetTime($vrow['lv005'])/8,2)).$vrow['lv015']."</b><br/>";
								else
									$lvstrgt=$lvstrgt.'<br/>'.(($an)?'Shift:':'').'<b>'.$vrow['lv015']."</b><br/>";
							}
							else
								$lvstrgt=$lvstrgt.'<br/>'.(($an)?'Shift:':'').'<b>'.$vrow['lv015']."</b><br/>";
						}
						break;
					case 20:
						if($this->lvState==0)
						{
							$lvstrgt=$lvstrgt.$this->GetTimeListMore($arrTime,$vCount).$vBr;
						}
						else 
						{
							$lvstrgt=$lvstrgt.(($an)?'In-Out:':'').'<b>'.$this->GetTimeListMore($arrTime,$vCount)."</b><br/>";
						}
						break;
					case 21:
						if($this->lvState==0)
							$lvstrgt=$lvstrgt.'<br/>'.$vArrState[$lvcheck].$vBr;
						else
						$lvstrgt=$lvstrgt.(($an)?'State:':'').'<br/><b>'.$vArrState[$lvcheck]."</b><br/>";
						break;
					case 31:
						if($this->lvState!=0) $lvstrgt=$lvstrgt.(($an)?$vArrState[$lvcheck]:'');				
						
						
						$lvstrgt=$lvstrgt.'<br/><b>';
						switch($lvcheck)
						{
							case 1:
								$lvstrgt=$lvstrgt.substr($vrow['lv019'],0,5);
								break;
							case 2:
								$lvstrgt=$lvstrgt.substr($vrow['lv020'],0,5);
								break;
							case 3:
								$lvstrgt=$lvstrgt.substr($vrow['lv019'],0,5)."|".substr($vrow['lv020'],0,5);
								break;
						}
						$lvstrgt=$lvstrgt."</b><br/>";
						break;
				}
			}
			$this->ArrEmp[$lvvt][4]=str_replace("<!--".$vrow['lv004']."-->",$lvstrgt,$this->ArrEmp[$lvvt][4]);
			/*
			for($i=0;$i<count($lstArr);$i++)
			{
				
				if($lstArr[$i]=='lv011')
					{
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->GetTimeList($vrow['NVID'],$vrow['lv004'],$lvopt)),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						
					}
					else if($lstArr[$i]=='lv012')
					{
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$lvcheck),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
					else
					{
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			*/
			$vPreShift[$vrow['NVID']][$vrow['DateNext']][0]=$vrow['lv015'];
			$vPreShift[$vrow['NVID']][$vrow['DateNext']][1]=$passday;
			}
		//$strTrH=str_replace("@#01",$strH,$lvTrH);
		return $this->Get_BuildList_Array_PCL($sExport);
	}
	function Get_BuildList_Array_PCL($sExport)
	{
		if($this->lvSort==1)
		$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[15]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[16]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[14]."</b></td>
				".$this->lvHeader."
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">W.Day</td>
			</tr>
			<tr>
				".$this->lvHeader1."
			</tr>
			@01
		</table>
		";
		else
			$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[14]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[15]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[16]."</b></td>".$this->lvHeader."
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">W.Day</td>
				<td colspan=\"4\" class=\"tdhprint\" width=\"10%\" align=\"center\">Monthly Taken</td>
				<td colspan=\"4\" class=\"tdhprint\" width=\"10%\" align=\"center\">Follow Up</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Total</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Total Overtime</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Total after 22h</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">SS</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">HL</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">SL</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">VR</td>				
			</tr>
			<tr>
				".$this->lvHeader1."
				<td>DO</td>
				<td>L</td>
				<td>CL</td>
				<td>P</td>
				<td>Previous P</td>
				<td>P balance/Month</td>
				<td>Previous CL</td>
				<td>CL balance/Month</td>
			</tr>
			@01
		</table>
		";
		$lvListTrAll="";
		for($i=1;$i<=count($this->ArrEmp);$i++)
		{
			$tNCS=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:VP']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:CT']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:SS']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:NS']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:0.5P']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:0.5CL'];
			$vSumTANGCATRUA=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCATRUA'])/$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TIMEWORK'][1]);
			$vOTTime=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['GIOTANGCA'];
			$vTANGCALE=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCALE'];
			$vTANGCADEM=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCADEM'])/$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TIMEWORK'][1]);
			if($sExport=="excel")
			{
				$lvListTrAll=$lvListTrAll.'<tr><td nowrap="nowrap"><Data ss:Type="String">="'.$this->ArrEmp[$i][2].'"</Data>'."</td><td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$this->ArrEmp[$i][0]."\"</Data></td>";
			}
			else
			{
				$lvListTrAll=$lvListTrAll."<tr><td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][2]."</Data></td><td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][0]."</Data></td>";
			}
			$vdaydiv=22;
			$vdaydivoth=22;
			$vNgayNghi=$this->ArrTCEmp[$this->ArrEmp[$i][0]]["NgayNghi"];
			switch($vNgayNghi)
			{
				case 13:
				case 0:	
					$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['CN'];
				break;
				case 1:
					$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
					break;
				case 2:
						$vdaydiv=count($this->vArrDay)-0.5*(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				break;
				case 3: 
					$vdaydiv=count($this->vArrDay)-6;
					break;
				case 6: 
					$vdaydiv=count($this->vArrDay)-5;
					break;
				case 4: 
					$vdaydiv=8;
					break;
				case 7: 
					$vdaydiv=22;
					break;
				case 8: 
					$vdaydiv=25;
					break;
				case 9: 
					$vdaydiv=24;
					break;
				case 10: 
					$vdaydiv=26;
					break;
				case 11: 
					$vdaydiv=count($this->vArrDay);
					break;
				case 12: 
					$vdaydiv=30;
					break;
				case 5: 
					$vdaydiv=count($this->vArrDay)-4;
					break;
			}
			//echo "</br>số ngày làm việc:".$vdaydiv." / số thực làm ".$vdaydivoth."</br>";
			//Count Works Actual
			//<td>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAdd'],2)."</td>
			$vSumWDay=$tNCS+$vSumTANGCATRUA+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HL']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['0.5P']*0.5;
			$vCLAdd=($vSumWDay>$vdaydiv)?($vSumWDay-$vdaydiv):0;
			$vMonth=getmonth($this->datefrom);
			$vYear=getyear($this->datefrom);
			$vEmpID=$this->ArrEmp[$i][0];
			$vCLLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']-$vSumTANGCATRUA;
			$vPLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['0.5P']*0.5;
			$lvListTrAll=$lvListTrAll."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][1]."</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][4])."<td align=right>".round($tNCS,2)."</Data></td><td>".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['DO']+$this->ArrTCEmp[$this->ArrEmp[$i][0]][''])."</td>
			<td>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']."</td>
			<td>".round($vSumTANGCATRUA,2)."</td>
			<td>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['0.5P']*0.5,1)."</td>
			<td>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam'],2)."</td>
			<td>".round($vPLast,2)."</td>
			<td>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious'],10)."</td>
			<td>".round($vCLLast,2)."</td>
			<td>".round($vCLLast+$vPLast,1)."</td>			
			<td align=right>".$vOTTime."</td>
			<td align=right>".round($this->GetTime($vTANGCALE),1)."</td>
			<td align=right>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['SS']."</td>
			<td align=right>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HL']."</td>
			<td align=right>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['SL']."</td>
			<td align=right>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['VR']."</td>
			</tr>";			
			}
		return str_replace("@01",$lvListTrAll,$vTable);
	}
	function Get_BuildList_Array($sExport)
	{
		if($this->lvSort==1)
		$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Mã CC</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[15]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[16]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[14]."</b></td>
				".$this->lvHeader."
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">W.Day</td>
			</tr>
			<tr>
				".$this->lvHeader1."
			</tr>
			@01
		</table>
		";
		else
			$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Mã CC</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[14]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[15]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[16]."</b></td>".$this->lvHeader."
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Ngày làm</td>
				<td colspan=\"6\" class=\"tdhprint\" width=\"10%\" align=\"center\">Hàng tháng</td>
				<td colspan=\"4\" class=\"tdhprint\" width=\"10%\" align=\"center\">Phép năm(P)</td>
				<td colspan=\"5\" class=\"tdhprint\" width=\"10%\" align=\"center\">Tăng ca</td>				
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">SS</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">HL</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">SL</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">VR</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Tổng ngày làm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Ngày trả</td>
				<td colspan=\"3\" class=\"tdhprint\" width=\"10%\" align=\"center\">Cảnh báo</td>
			</tr>
			<tr>
				".$this->lvHeader1."
				<td>VP</td>
				<td>CT</td>
				<td>CN</td>
				<td>L</td>
				<td>P</td>
				<td>DO</td>
				<td>P đầu kỳ</td>
				<td>P/ Năm</td>
				<td>P/ Tháng</td>
				<td>P cuối kỳ</td>
				<td align=\"center\">TC thường(150%)</td>	
				<td align=\"center\">TC trưa(150%)</td>	
				<td align=\"center\">TC CN(200%)</td>	
				<td align=\"center\">TC lễX(300%)</td>
				<td align=\"center\">Tổng TC</td>				
				<td>Ngày phải làm</td>
				<td>Ngày có thể/Ngày thiếu</td>
				<td>Cảnh báo</td>
			</tr>
			@01
		</table>
		";
		$lvListTrAll="";
		$vMonth=getmonth($this->datefrom);
		$vYear=getyear($this->datefrom);
		$vNumMonth=	GetDayInMonth($vYear,$vMonth);
		$vEndDateInMonthNumber=(float)($vYear.$vMonth.$vNumMonth);
		$vCurDateInMonthNumber=(float)(str_replace("-","",$this->DateCurrent));
		$vOldMonth=false;
		$vDayCan=0;
		if($vCurDateInMonthNumber>$vEndDateInMonthNumber)
		{
			$vOldMonth=true;
		}
		else
		{
			$vDayCan=$vNumMonth-getday($this->DateCurrent)+1;
		}
		
		$vCurrentCheck=getyear($this->DateCurrent).getmonth($this->DateCurrent);
		$vCurDay=getday($this->DateCurrent);
		$vCalCheck=$vYear.$vMonth;
		for($i=1;$i<=count($this->ArrEmp);$i++)
		{
			$tNCVP=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:VP'];
			$tNCCT=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:CT'];
			$tNCCN=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CN:VP']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CN:CT'];
			$tNCS=$tNCVP+$tNCCT+$tNCCN+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:SS']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:NS']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:0.5P']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:0.5VR'];
			$vOTTrua=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCATRUA']);
			$vOTTime=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['GIOTANGCA']);
			$vTANGCALE=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCALE']);
			$vOTDem=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCADEM']);
			if($sExport=="excel")
			{
				$lvListTrAll=$lvListTrAll.'<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][99]."</td>".'<td nowrap="nowrap"><Data ss:Type="String">="'.$this->ArrEmp[$i][2].'"</Data>'."</td><td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$this->ArrEmp[$i][0]."\"</Data></td>";
			}
			else
			{
				$lvListTrAll=$lvListTrAll.'<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][99]."</td>"."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][2]."</Data></td><td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][0]."</Data></td>";
			}
			$vdaydiv=22;
			$vdaydivoth=22;
			$vNgayNghi=$this->ArrTCEmp[$this->ArrEmp[$i][0]]["NgayNghi"];
			switch($vNgayNghi)
			{
				case 13:
				case 0:	
					$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['CN'];
					break;
				case 1:
					$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
					break;
				case 2:
					$vdaydiv=count($this->vArrDay)-0.5*(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
					break;
				case 3: 
					$vdaydiv=count($this->vArrDay)-6;
					break;
				case 4: 
					$vdaydiv=8;
					break;
				case 7: 
					$vdaydiv=22;
					break;
				case 8: 
					$vdaydiv=25;
					break;
				case 9: 
					$vdaydiv=24;
					break;
				case 10: 
					$vdaydiv=26;
					break;
				case 11: 
					$vdaydiv=count($this->vArrDay);
					break;
				case 5: 
					$vdaydiv=count($this->vArrDay)-4;
					break;
			}
			//echo "</br>số ngày làm việc:".$vdaydiv." / số thực làm ".$vdaydivoth."</br>";
			//Count Works Actual
			//<td>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAdd'],2)."</td>
			$vSumWDay=$tNCS+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HL']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['0.5P']*0.5;
			$vCLAdd=($vSumWDay>$vdaydiv)?($vSumWDay-$vdaydiv):0;
			$vEmpID=$this->ArrEmp[$i][0];
			if($vCLAdd!=0)
			{
				$lvsql = "Update tc_lv0009 set lv096='$vCLAdd'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv005=0 ";
				$vReturn= db_query($lvsql);
			}
			else
			{
				$lvsql = "Update tc_lv0009 set lv096='$vCLAdd'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv005=0 ";
				$vReturn= db_query($lvsql);
			}
			$isNotP=0;
			if(($vSumWDay+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TS'])<round($vdaydiv/2,0) || $vdaydiv==0)
			{
				if($vCurrentCheck>$vCalCheck)
				$isNotP=1;
				elseif($vCurrentCheck==$vCalCheck )
				{
					if($vCurDay>25) $isNotP=1;
				}
				else
					$isNotP=0;
			}
			else
				$isNotP=0;
			if($isNotP==1)
			{
				$FNKTinh=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FNKTinh'];//-1;
				$vCLLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L']+$vTANGCADEM+$vCLAdd-$vSumTANGCATRUA;
				$vPLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['0.5P']*0.5;
			}
			else
			{
				$FNKTinh=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FNKTinh'];
				$vCLLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L']+$vTANGCADEM+$vCLAdd-$vSumTANGCATRUA;
				$vPLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['0.5P']*0.5;
			}
			$vMessageC='';
			$vDayNeed=($vdaydiv-(($vSumWDay>$vdaydiv)?$vdaydiv:$vSumWDay));
			if($vOldMonth==false)
			{
				if($vSumWDay>=$vdaydiv)
				{
					$vMessageC='<font color="black">Đã đủ công</font>';
				}
				else
				{
					if($vDayNeed>$vDayCan)
					{
						$vMessageC='<font color="red">Thiếu công</font>';
					}
					elseif($vDayNeed<$vDayCan)
					{
						$vMessageC='<font color="blue">Tốt</font>';
					}
					else
					{
						$vMessageC='<font color="green">Không tốt</font>';
					}
				}
				
			}
			else
			{
				if($vSumWDay>$vdaydiv)
				{
					$vMessageC='<font color="blue">Dư công</font>';
				}
				elseif($vSumWDay==$vdaydiv)
					$vMessageC='<font color="green">Đủ công</font>';
				else
					$vMessageC='<font color="red">Thiếu công</font>';
			}
			//DO $this->ArrTCEmp[$this->ArrEmp[$i][0]]['DO']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['']
			if($this->ArrTCEmp[$this->ArrEmp[$i][0]]['VR']>round($vdaydiv/2,0)) $isNotP=1;
			$lvListTrAll=$lvListTrAll."
			<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][1]."</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][4])."
			<td align=center>".round($tNCS,2)."</Data></td>
			<td align=center>".round($tNCVP,2)."</td>
			<td align=center>".round($tNCCT,2)."</td>
			<td align=center>".round($tNCCN,2)."</td>
			<td align=center>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']."</td>
			<td align=center>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['0.5P']*0.5,1)."</td>
			<td align=center>".round(($vSumWDay>count($this->vArrDay))?0:count($this->vArrDay)-$vSumWDay,3)."</td>
			<td align=center>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam'],2)."</td>
			<td align=center>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']."</td>
			<td align=center>".(($isNotP==1)?0:round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,1))."</td>
			<td align=center>".round($vPLast,2)."</td>
			<td align=center>".$vOTTime."</td>			
			<td align=center>".round($vOTTrua,2)."</td>
			<td align=center>".round($vOTDem,2)."</td>
			<td align=center>".round($vTANGCALE,1)."</td>
			<td align=center>".round($vOTTime*1.5+$vOTTrua*1.5+$vOTDem*2+$vTANGCALE*3,1)."</td>
			<td align=center>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['SS']."</td>
			<td align=center>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HL']."</td>
			<td align=center>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['SL']."</td>
			<td align=center>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['VR']."</td>
			<td align=center>".round($vSumWDay,2)."</td>
			<td align=center>".round(($vSumWDay>$vdaydiv)?$vdaydiv:$vSumWDay,2)."</td>
			<td align=center>".$vdaydiv."</td>
			<td align=center>".$vDayCan."/".$vDayNeed."</td>
			<td align=left>".$vMessageC."</td>
			</tr>";
			$lvsql = "Update tc_lv0009 set lv120='$vPLast',lv122='$vCLLast',lv130='$isNotP',lv131='".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12)."'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv005=0 ";
			$vReturn= db_query($lvsql);
			if($vMonth<12)
			{
				$lvsql = "Update tc_lv0009 set lv121='$vPLast',lv123='$vCLLast'  WHERE lv002='$vEmpID' and lv003='".($vMonth+1)."' and lv004='$vYear' and lv005=0 ";
				$vReturn= db_query($lvsql);
			}
			else
			{
				$lvsql = "Update tc_lv0009 set lv121='0',lv123='0'  WHERE lv002='$vEmpID' and lv003='".(1)."' and lv004='".($vYear+1)."' and lv005=0 ";
				$vReturn= db_query($lvsql);
				$lvsql = "Update tc_lv0008 set lv100='$vPLast',lv101='$vCLLast'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";
				$vReturn= db_query($lvsql);
			}
			//echo $this->ArrEmp[$i][0].":".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimePhepPrevious']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Prev']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAdd']."-".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeClear']."-".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeBUsed'].$vBr;
		}
		$lvListTrAll=$lvListTrAll."<tr><td colspan=59><strong>TỔNG THỐNG KÊ THEO CÔNG TRÌNH<strong></td></tr>";
		foreach($this->ArrDEPTPROJECTLEV0 as $DeptID)
		{
			foreach($this->ArrDEPTPROJECTLEV1[$DeptID] as $Proj)
			{
				$lvListTrAll=$lvListTrAll."
				<tr>
				<td nowrap='nowrap'><Data ss:Type=\"String\">".$DeptID."</Data></td><td>".$this->ArrDep[$DeptID][3]."</td><td>".$Proj[1]."</td>
				";
				$tNCS=0;
				$tNCVP=0;
				$tNCCT=0;
				$tNCCN=0;
				$tLe=0;
				$tP=0;
				$tO=0;
				foreach($this->vArrDay as $vCDay)
				{
					//echo $this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['L'][$vCDay][0];
					$tLe=$tLe+$this->gettime($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['L'][$vCDay][0])/8;
					$tP=$tP+$this->gettime($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['P'][$vCDay][0])/8;
					$tO=$tO+$this->gettime($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['O'][$vCDay][0])/8;
					$vVP=$this->gettime($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['VP'][$vCDay][0])/8;
					$tNCVP=$tNCVP+$vVP;
					$vCT=$this->gettime($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['CT'][$vCDay][0])/8;
					$tNCCT=$tNCCT+$vCT;
					$vCong=$vVP+$vCT;
					$tNCS=$tNCS+$vCong;
					$vDows=date('w', strtotime($vCDay))+1;
					if($vDows==1)
					{
						$tNCCN=$tNCCN+$vCong;
					}
					$lvListTrAll=$lvListTrAll."<td align=center>".$this->FormatView($vCong,20)."</td>";
				}
				$lvListTrAll=$lvListTrAll."
				<td align=center>".round($tNCS,2)."</td>
				<td align=center>".round($tNCVP,2)."</td>
				<td align=center>".round($tNCCT,2)."</td>
				<td align=center>".round($tNCCN,2)."</td>
				<td align=center>".round($tLe,2)."</td>
				<td align=center>".round($tP,2)."</td>
				<td align=center>".round($tO,2)."</td>
				<td align=center colspan=\"18\">&nbsp;</td>
				</tr>";
			}
		}
		return str_replace("@01",$lvListTrAll,$vTable);
	}
	function LV_GetSecond($lvStartTime,$lvEndTime)
	{
		$lvsql="select TIME_TO_SEC(TIMEDIFF('$lvEndTime','$lvStartTime')) as lv_time";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		return $vrow['lv_time'];
	}
	function ConfirmShift($vArrShift,$vEndTime,$vListShiftReceive)
	{
		//trả về 2 trạng thái
		//Ca làm việc
		//Từ giờ starttime xác định vị trí ca.
		$vShift=Array();
		$vStartInt=(int)str_replace(":","",$vStartTime);
		$vEndInt=(int)str_replace(":","",$vEndTime);
		$vShiftIn='';
		$vShiftOut='';
		$vDistantInSizeStart=0;
		$vDistantInSizeStartEnd=0;
		$vStartTrue=false;
		$vEndTrue=false;
		foreach($vArrShift as $vShift)
		{
			//echo ',,'.$vListShiftReceive.',',',vinh'.$vShift[1][0].'vinh,='.strpos(',,'.$vListShiftReceive.',',','.$vShift[1][0].',').'<br/>';
			if($vListShiftReceive=="" || (strpos(',,'.$vListShiftReceive.',',','.$vShift[1][0].',')>0))
			{
				if($vShift[3][1]<=$vShift[4][1])
					{
						if($vEndInt>=$vShift[4][1])
						{
							$vEndTrue=true;
							if($vDistantInSizeEnd==0)
							{
								$vShiftOut=$vShift[1][0];
							}
							else
							{
								if($vEndInt>=$vShift[4][1])
									$vDistantInSizeEndNew=$vEndInt-$vShift[4][1];
								else
									$vDistantInSizeEndNew=$vShift[4][1]-$vEndInt;
								if($vDistantInSizeEndNew<=$vDistantInSizeEnd) $vShiftOut=$vShift[1][0];
							}
							if($vEndInt>=$vShift[4][1])
								$vDistantInSizeEnd=$vEndInt-$vShift[4][1];
							else
								$vDistantInSizeEnd=$vShift[4][1]-$vEndInt;
							
						}
						else
						{
							if($vDistantInSizeEnd==0)
							{
								$vShiftOut=$vShift[1][0];
								if($vEndInt>=$vShift[4][1])
								$vDistantInSizeEnd=$vEndInt-$vShift[4][1];
								else
								$vDistantInSizeEnd=$vShift[4][1]-$vEndInt;
							}
							else
							{
								if($vEndInt>$vShift[4][1])
									$vDistantInSizeEndNew=$vEndInt-$vShift[4][1];
								else
									$vDistantInSizeEndNew=$vShift[4][1]-$vEndInt;
								if($vDistantInSizeEndNew<=$vDistantInSizeEnd) $vShiftOut=$vShift[1][0];
							}
							
						}
					
					}
					else
					{

							if($vDistantInSizeEnd==0)
							{
								$vShiftOut=$vShift[1][0];
							}
							else
							{
								if($vEndInt>=$vShift[4][1])
									$vDistantInSizeEndNew=$vEndInt-$vShift[4][1];
								else
									$vDistantInSizeEndNew=$vShift[4][1]-$vEndInt;
								//echo "if($vDistantInSizeEndNew<$vDistantInSizeEnd) $vShiftOut=".$vShift[1][0].";";
								if($vDistantInSizeEndNew<=$vDistantInSizeEnd) $vShiftOut=$vShift[1][0];
							}
							if($vEndInt>$vShift[4][1])
								$vDistantInSizeEnd=$vEndInt-$vShift[4][1];
							else
								$vDistantInSizeEnd=$vShift[4][1]-$vEndInt;
							
					}
			}			
	
		}
		///Ca cuối xác định công và có tăng ca không					
		return $vShiftOut;
		//Công của công việc 0 không có tăng ca, 1 có tăng ca.
	}
	function ConfirmShiftOutDay($vArrShift,$vEndTime,$vListShiftReceive)
	{
		//trả về 2 trạng thái
		//Ca làm việc
		//Từ giờ starttime xác định vị trí ca.
		$vShift=Array();
		$vStartInt=(int)str_replace(":","",$vStartTime);
		$vEndInt=(int)str_replace(":","",$vEndTime);
		$vShiftIn='';
		$vShiftOut='';
		$vDistantInSizeStart=0;
		$vDistantInSizeStartEnd=0;
		$vStartTrue=false;
		$vEndTrue=false;
		foreach($vArrShift as $vShift)
		{
			
			if($vListShiftReceive=="" || (strpos(',,'.$vListShiftReceive.',',','.$vShift[1][0].',')>0))
			{
				//echo '<br/>,,'.$vListShiftReceive.',',',vinh'.$vShift[1][0].'vinh,='.strpos(',,'.$vListShiftReceive.',',','.$vShift[1][0].',').'<br/>';
				//echo "vinhne:$vDistantInSizeEnd<br/>";
				if($vShift[3][1]<=$vShift[4][1])
					{
						
						if($vEndInt>=$vShift[4][1])
						{
							$vEndTrue=true;
							/*if($vDistantInSizeEnd==0)
							{
								$vShiftOut=$vShift[1][0];
							}
							else*/
							{
								if($vEndInt>=$vShift[4][1])
									$vDistantInSizeEndNew=$vEndInt-$vShift[4][1];
								else
									$vDistantInSizeEndNew=$vShift[4][1]-$vEndInt;
								if($vDistantInSizeEndNew<=$vDistantInSizeEnd) $vShiftOut=$vShift[1][0];
							}
							if($vEndInt>=$vShift[4][1])
								$vDistantInSizeEnd=$vEndInt-$vShift[4][1];
							else
								$vDistantInSizeEnd=$vShift[4][1]-$vEndInt;
							
						}
						else
						{
							if($vDistantInSizeEnd==0)
							{
								$vShiftOut=$vShift[1][0];
								if($vEndInt>=$vShift[4][1])
								$vDistantInSizeEnd=$vEndInt-$vShift[4][1];
								else
								$vDistantInSizeEnd=$vShift[4][1]-$vEndInt;
							}
							else
							{
								if($vEndInt>$vShift[4][1])
									$vDistantInSizeEndNew=$vEndInt-$vShift[4][1];
								else
									$vDistantInSizeEndNew=$vShift[4][1]-$vEndInt;
								//echo "if($vDistantInSizeEndNew<$vDistantInSizeEnd) $vShiftOut=".$vShift[1][0].";<br/>";
								if($vDistantInSizeEndNew<=$vDistantInSizeEnd) $vShiftOut=$vShift[1][0];
							}
							
						}
					
					}
					else
					{

							/*if($vDistantInSizeEnd==0)
							{
								$vShiftOut=$vShift[1][0];
							}
							else*/
							{
								if($vEndInt>=$vShift[4][1])
									$vDistantInSizeEndNew=$vEndInt-$vShift[4][1];
								else
									$vDistantInSizeEndNew=$vShift[4][1]-$vEndInt;
								//echo "if($vDistantInSizeEndNew<$vDistantInSizeEnd) $vShiftOut=".$vShift[1][0].";<br/>";
								if($vDistantInSizeEndNew<=$vDistantInSizeEnd) $vShiftOut=$vShift[1][0];
							}
							if($vEndInt>$vShift[4][1])
								$vDistantInSizeEnd=$vEndInt-$vShift[4][1];
							else
								$vDistantInSizeEnd=$vShift[4][1]-$vEndInt;
							
					}
			}			
	
		}
		///Ca cuối xác định công và có tăng ca không					
		return $vShiftOut;
		//Công của công việc 0 không có tăng ca, 1 có tăng ca.
	}
	function GetTimeListArr($vlv001,$vlv002,$shiftDay,$shiftYear,&$passday,$vListShiftReceive,$vPreShift,&$arrTime)
	{
		$arrTime=Array();
		$vPass=(int)$vPreShift[1];
		$vGay=0;
		if($vPass==1 && $vPreShift[0]=='') $vPass=0;
		if($shiftDay!="" && $shiftDay!=NULL)
		{
			$shift_start=(int)str_replace(":","",$this->ArrShift[0]['IN-'.$shiftDay][3]);
			$shift_end=(int)str_replace(":","",$this->ArrShift[0]['OUT-'.$shiftDay][4]);
			if($passday!=2 && $passday!=-1)  $passday=($shift_start>$shift_end)?1:0;
			$vGay=$this->ArrShift[0]['GAY-'.$shiftDay][1];
		}
		else if($shiftYear!="" && $shiftYear!=NULL)
		{
			$shift_start=(int)str_replace(":","",$this->ArrShift[0]['IN-'.$shiftYear][3]);
			$shift_end=(int)str_replace(":","",$this->ArrShift[0]['OUT-'.$shiftYear][4]);
			if($passday!=2 && $passday!=-1) $passday=($shift_start>$shift_end)?1:0;
			$vGay=$this->ArrShift[0]['GAY-'.$shiftYear][1];
		}
		else
		{
			//if($isshift==0) return;
		}
		//echo "$vlv002 :".$passday.$vBr;
		$strReturn=array();
		if($passday!=1 && $passday!=-1)
		{
		$lvsql="select lv003,lv005 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002'  and lv006<>1 order by lv003 ASC";
			$vresult=db_query($lvsql);
			$count=db_num_rows($vresult);
			if($vresult){
				$i=1;
				$j=0;
				$vbo=0;
				while($vrow=db_fetch_array($vresult))
				{
					if($this->LV_GetSecond($vTimeSave,$vrow['lv003'])>900 || $i==1)
					{
						if($vPass==1)
						{
							//echo $vlv002.":".$vrow['lv003'].'->'.$vrow['lv003'].",".$vListShiftReceive;
							//$vShiftOut=$this->ConfirmShiftOutDay($this->ArrShift,$vrow['lv003'],$vListShiftReceive);
							//echo $vPreShift[0]."!=".$vShiftOut;
							//echo "<br/>";
							//if($vPreShift[0]!=$vShiftOut)
							{
								if($i==1)
								{
									$i++;
								}
								elseif(($i==2))
								{
									$arrTime[0]=$vrow['lv003'];
									$strReturn[0]=(int)str_replace(":","",$vrow['lv003']);
									$i++;
								}
								elseif($this->LV_GetSecond($arrTime[0],$vrow['lv003'])>900 )
								{
									$strReturn[1]=(int)str_replace(":","",$vrow['lv003']);
									$arrTime[1]=$vrow['lv003'];
									$i++;
								}
								
							}
						}
						else
						{
							if($vGay==1)
							{
								if($j==0)
								{
									
									$arrTime[$j]=$vrow['lv003'];
									$strReturn[$j]=(int)str_replace(":","",$vrow['lv003']);
								}
								elseif($this->LV_GetSecond($arrTime[$j-$vbo-1],$vrow['lv003'])>900 )
								{

									$arrTime[$j-$vbo]=$vrow['lv003'];
									$strReturn[$j-$vbo]=(int)str_replace(":","",$vrow['lv003']);
								}
								else
									$vbo++;
							}
							else
							{
								if($i==1)
								{
									
									$arrTime[0]=$vrow['lv003'];
									$strReturn[0]=(int)str_replace(":","",$vrow['lv003']);
								}
								elseif($this->LV_GetSecond($arrTime[0],$vrow['lv003'])>900 )
								{

									$arrTime[1]=$vrow['lv003'];
									$strReturn[1]=(int)str_replace(":","",$vrow['lv003']);
									return $strReturn;
								}
							}
								$i++;	
							
						}
						$j++;
					$vTimeSave=$vrow['lv003'];
					}
				}
			}
		}
		elseif($passday==-1)
		{
			
			$lvsql="select lv001,lv002,lv003,lv004,lv005,lv006 from  tc_lv0012 Where lv001='$vlv001' and lv002=ADDDATE('$vlv002',-1)  and lv006<>1 order by lv003 DESC  limit 0,1";
			$vresult=db_query($lvsql);
			$count=db_num_rows($vresult);
			if($vresult){
			$i=1;
			$vCount=0;
			while($vrow=db_fetch_array($vresult))
				{
				//Xác định giờ thuộc ca C không;
				$vShiftOut=$this->ConfirmShift($this->ArrShift,$vrow['lv003'],$vListShiftReceive);
				//if($vShiftOut==$shiftDay)
				{
					$strReturn[0]=(int)str_replace(":","",$vrow['lv003']);
					$arrTime[0]=$vrow['lv003'];
				}
				}
			}
			$lvsql="select lv003,lv005 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002'  and lv006<>1 order by lv003 ASC limit 0,1";
			$vresult=db_query($lvsql);
			$count=db_num_rows($vresult);
			if($vresult){
			$i=1;
			$vCount=0;
			while($vrow=db_fetch_array($vresult))
				{
					$arrTime[1]=$vrow['lv003'];
					$strReturn[1]=(int)str_replace(":","",$vrow['lv003']);
						
				}
			}
		}
		else
		{
			$lvsql="select lv003,lv005 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002'  and lv006<>1 order by lv003 DESC limit 0,1";
			$vresult=db_query($lvsql);
			$count=db_num_rows($vresult);
			if($vresult){
			$i=1;
			$vCount=0;
			while($vrow=db_fetch_array($vresult))
				{
					$arrTime[0]=$vrow['lv003'];
					$strReturn[0]=(int)str_replace(":","",$vrow['lv003']);
						
				}
			}
			$lvsql="select lv001,lv002,lv003,lv004,lv005,lv006 from  tc_lv0012 Where lv001='$vlv001' and lv002=ADDDATE('$vlv002',1)  and lv006<>1 order by lv003 ASC  limit 0,1";
			$vresult=db_query($lvsql);
			$count=db_num_rows($vresult);
			if($vresult){
			$i=1;
			$vCount=0;
			while($vrow=db_fetch_array($vresult))
				{
				//Xác định giờ thuộc ca C không;
				$vShiftOut=$this->ConfirmShift($this->ArrShift,$vrow['lv003'],$vListShiftReceive);
				if($vShiftOut==$shiftDay || (substr($shiftDay,0,3)=='CaC' && substr($vShiftOut,0,3)=='CaD') || (substr($shiftDay,0,3)=='CaD' && substr($vShiftOut,0,3)=='CaC') )
				{
					$strReturn[1]=(int)str_replace(":","",$vrow['lv003']);
					$arrTime[1]=$vrow['lv003'];
				}
				}
			}
		}
		
		return $strReturn;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM tc_lv0011 A WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_CheckLateSoon($NVID,$shiftDay,$shiftYear,$ArrTime)
	{
		if($shiftDay!="" && $shiftDay!=NULL)
		{
			$shift_start=(int)str_replace(":","",$this->ArrShift[0]['IN-'.$shiftDay][3]);
			$shift_end=(int)str_replace(":","",$this->ArrShift[0]['OUT-'.$shiftDay][4]);
			$passday=($shift_start>$shift_end)?1:0;
			//Kiem tra gio vao ra theo ca
			if(count($ArrTime)<2) return 4;
			if($passday==0)
			{
				if($ArrTime[0]>$shift_start && $ArrTime[1]<$shift_end)
					return 3;//Vao trễ và ra sớm
				else if ($ArrTime[0]>$shift_start)
					return 1;//Vào trễ
				else if($ArrTime[1]<$shift_end)
				 	return 2;//Ra sớm
				else
					return 0;
			}
			else
			{
				if($ArrTime[1]>$shift_start && $ArrTime[0]<$shift_end)
					return 3;//Vao trễ và ra sớm
				else if ($ArrTime[1]>$shift_start)
					return 1;//Vào trễ
				else if($ArrTime[0]<$shift_end)
				 	return 2;//Ra sớm
				else
					return 0;
			}
			
			
		}
		else if($shiftYear!="" && $shiftYear!=NULL)
		{
			
			$shift_start=(int)str_replace(":","",$this->ArrShift[0]['IN-'.$shiftYear][3]);
			$shift_end=(int)str_replace(":","",$this->ArrShift[0]['OUT-'.$shiftYear][4]);
			$passday=($shift_start>$shift_end)?1:0;
			//Kiem tra gio vao ra theo ca
			if(count($ArrTime)<2) return 4; 
			if($passday==0)
			{
				if($ArrTime[0]>$shift_start && $ArrTime[1]<$shift_end)
					return 3;//Vao trễ và ra sớm
				else if ($ArrTime[0]>$shift_start)
					return 1;//Vào trễ
				else if($ArrTime[1]<$shift_end)
				 	return 2;//Ra sớm
				else
					return 0;
			}
			else
			{
				if($ArrTime[1]>$shift_start && $ArrTime[0]<$shift_end)
					return 3;//Vao trễ và ra sớm
				else if ($ArrTime[1]>$shift_start)
					return 1;//Vào trễ
				else if($ArrTime[0]<$shift_end)
				 	return 2;//Ra sớm
				else
					return 0;
			}
		}
		else
		{
			return 5;
		}
	}
////GetTime list
	function GetTimeListMore($vArrTime,&$vCount=0)
	{
		$vCount=0;
		if($vArrTime==null) return;
		foreach($vArrTime as $vTime)
		{
			$vCount++;
			if($strReturn=="")
			$strReturn=$strReturn.''.substr($vTime,0,5)."";	
			else
				$strReturn=$strReturn." | ".''.substr($vTime,0,5)."";	
		}
		$strReturn="<span style='padding:3px;white-space: nowrap;'>".$strReturn."</span>";
		return $strReturn;
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
	function GetTimeList($vlv001,$vlv002,$opt=0)
	{
		$strReturn="";
		if($opt==0)
		{
			$lvsql="select lv001,lv002,lv003,lv004,lv005,lv006 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002' and (lv005='' or ISNULL(lv005))  order by lv003 ASC";
		}
		else
		{
			$lvsql="select lv001,lv002,lv003,lv004,lv005,lv006 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002'  order by lv003 ASC";
		}
		$vresult=db_query($lvsql);
		
		$count=db_num_rows($vresult);
		if($vresult){
		$i=1;
			while($vrow=db_fetch_array($vresult))
			{if(($i==1 || $i==$count) || $opt==0)
			{
				if($strReturn=="")
				{
					if(trim($vrow['lv005'])=='' || $vrow['lv005']==NULL)
						$strReturn=$strReturn.'<a href="javascript:'.(($vrow['lv006']=='1')?'undeltime':(($vrow['lv006']=='0' && $vrow['lv004']=='OTO')?'deltime':'overtime')).'(\''.$vrow['lv001'].'\',\''.$vrow['lv002'].'\',\''.$vrow['lv003'].'\',\''.$vid.'\')"><font style="'.(($vrow['lv006']=='1')?'text-decoration:line-through;':(($vrow['lv006']=='0' && $vrow['lv004']=='OTO')?'color:red':'color:blue;')).'">'.substr($vrow['lv003'],0,8)."</font></a>";
					else
					{
						$strReturn=$strReturn.'<a href="javascript:'.(($vrow['lv006']=='1')?'undeltime':(($vrow['lv006']=='0' && $vrow['lv004']=='OTO')?'deltime':'overtime')).'(\''.$vrow['lv001'].'\',\''.$vrow['lv002'].'\',\''.$vrow['lv003'].'\',\''.$vid.'\')">'.'<font style="color:red;text-decoration:underline" title="'.GetUserName($vrow['lv005'],$this->lang).'('.$vrow['lv005'].')'.'"><font style="'.(($vrow['lv006']=='1')?'text-decoration:line-through;':(($vrow['lv006']=='0' && $vrow['lv004']=='OTO')?'color:red':'color:blue')).'">'.substr($vrow['lv003'],0,8)."</font></font></a>";
					}
				}
				else
				{
					if(trim($vrow['lv005'])=='' || $vrow['lv005']==NULL)
					$strReturn=$strReturn." | ".'<a href="javascript:'.(($vrow['lv006']=='1')?'undeltime':(($vrow['lv006']=='0' && $vrow['lv004']=='OTO')?'deltime':'overtime')).'(\''.$vrow['lv001'].'\',\''.$vrow['lv002'].'\',\''.$vrow['lv003'].'\',\''.$vid.'\')"><font style="'.(($vrow['lv006']=='1')?'text-decoration:line-through;':(($vrow['lv006']=='0' && $vrow['lv004']=='OTO')?'color:red':'color:blue')).'">'.substr($vrow['lv003'],0,8)."</font></a>";
					else
					$strReturn=$strReturn."->".'<a href="javascript:'.(($vrow['lv006']=='1')?'undeltime':(($vrow['lv006']=='0' && $vrow['lv004']=='OTO')?'deltime':'overtime')).'(\''.$vrow['lv001'].'\',\''.$vrow['lv002'].'\',\''.$vrow['lv003'].'\',\''.$vid.'\')">'.'<font style="color:red;text-decoration:underline" title="'.GetUserName($vrow['lv005'],$this->lang).'('.$vrow['lv005'].')'.'"><font style="'.(($vrow['lv006']=='1')?'text-decoration:line-through;':(($vrow['lv006']=='0' && $vrow['lv004']=='OTO')?'color:red':'color:blue')).'">'.substr($vrow['lv003'],0,8)."</font></font></a>";
				}
			}
			$i++;
			}
		}
		$strReturn="<span style='padding:3px;white-space: nowrap;'>".$strReturn."</span>";
		return $strReturn;
	}
	function Get_Arr_Employees($ShowOnce=0,$ShowDept=1)
	{
		$this->ArrEmp=array();
		$this->ArrEmpBack=array();
		$vYearMonth=getyear($this->datefrom).getmonth($this->datefrom);
		if($ShowOnce==1)
		{
			$strTd=$this->Get_String_DateFromToFull();
		}
		else
			$strTd=$this->Get_String_DateFromTo();
		$lvcondition="";
		
		if($this->lv028!="")
			$strCondi=" AND  DD.lv009 in ('".str_replace(",","','",$this->lv028)."') ";
		if($this->lv029_!="")  
		{
			$lsguser=$this->LV_GetDep($this->lv029_);
			$strCondi=$strCondi." AND DD.lv029 in (".$lsguser.")";
		}
		if($this->lv029!="")  
		{
			$lsguser=$this->LV_GetDep($this->lv029);
			$strCondi=$strCondi." AND DD.lv029 in (".$lsguser.")";
		}
		if($this->isStaffOff==1) $strCondi=$strCondi." AND concat(year(DD.lv044),month(DD.lv044))<='$vYearMonth' ";// $strCondi=$strCondi." AND year(DD.lv044)<2014 ";
		if($this->lv030!="")  $strCondi=$strCondi." AND DD.lv001 in ('".$this->lv030."')";
		if($this->lvSort==0)
		{
			if($ShowDept==1)
				$lvsql="select DD.lv001 CodeID,DD.lv002 Name,AA.lv004 Dep,DD.lv099 MaCC from hr_lv0020 DD inner join tc_lv0064 AA on AA.lv003=DD.lv001 and AA.lv002='".$this->motc_lv0013->lv001."' where 1=1  and DD.lv030<='$this->dateto' $strCondi  order by AA.lv004";
			else
				$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv029 Dep,DD.lv099 MaCC from hr_lv0020 DD where 1=1  and DD.lv030<='$this->dateto' $strCondi  order by DD.lv029";
		}
		elseif($this->lvSort==1) 
		{
			if($ShowDept==1)
				$lvsql="select DD.lv001 CodeID,DD.lv002 Name,AA.lv004 Dep,DD.lv099 MaCC from hr_lv0020 DD inner join tc_lv0064 AA on AA.lv003=DD.lv001 and AA.lv002='".$this->motc_lv0013->lv001." where 1=1  and DD.lv030<='$this->dateto' $strCondi  order by AA.lv004";
			else
				$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv029 Dep,DD.lv099 MaCC from hr_lv0020 DD where 1=1  and DD.lv030<='$this->dateto' $strCondi  order by DD.lv001";
		}
		elseif($this->lvSort==2) 
		{
			if($ShowDept==1)
				$lvsql="select DD.lv001 CodeID,DD.lv002 Name,AA.lv004 Dep,DD.lv099 MaCC from hr_lv0020 DD inner join tc_lv0064 AA on AA.lv003=DD.lv001 and AA.lv002='".$this->motc_lv0013->lv001." where 1=1  and DD.lv030<='$this->dateto' $strCondi  order by DD.lv062,DD.lv099 asc";
			else
				$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv029 Dep,DD.lv099 MaCC from hr_lv0020 DD where 1=1  and DD.lv030<='$this->dateto' $strCondi  order by DD.lv062,DD.lv099 asc";
		}
		elseif($this->lvSort==3) 
		{
			if($ShowDept==1)
				$lvsql="select DD.lv001 CodeID,DD.lv002 Name,AA.lv004 Dep,DD.lv099 MaCC from hr_lv0020 DD inner join tc_lv0064 AA on AA.lv003=DD.lv001 and AA.lv002='".$this->motc_lv0013->lv001." where 1=1  and DD.lv030<='$this->dateto' $strCondi  order by DD.lv099 asc,DD.lv062 asc";
			else
				 $lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv029 Dep,DD.lv099 MaCC from hr_lv0020 DD where 1=1  and DD.lv030<='$this->dateto' $strCondi  order by DD.lv099 asc,DD.lv062 asc";
		}
		$vresult=db_query($lvsql);	
		$i=1;
		while($vrow=db_fetch_array($vresult))
		{
			$this->ArrEmp[$i][0]=$vrow['CodeID'];
			$this->ArrEmp[$i][1]=$vrow['Name'];
			$this->ArrEmp[$i][2]=$vrow['Dep'];
			$this->ArrEmp[$i][3]=$this->Str_DateFromTo;
			$this->ArrEmp[$i][4]=$strTd;
			$this->ArrEmp[$i][99]=$vrow['MaCC'];
			$this->ArrEmpBack[$vrow['CodeID']]=$i;
			$i++;
		}
	}
	function Get_String_DateFromToFull()
	{
		$vNoWork=false;
		$vDaysArr=array('1'=>'Sun','2'=>'Mon','3'=>'Tue','4'=>'Wed','5'=>'Thu','6'=>'Fri','7'=>'Sat');
		$this->lvHeader="";
		$this->lvFooter="";
		$this->lvHeader1="";
		$strTD="";
		$lvNumDate=31;
		$datecur=$this->datefrom;
		$vKhac=(getmonth($this->datefrom)!=getmonth($this->dateto))?1:0;
		for($i=1;$i<=$lvNumDate;$i++)
		{
			$vDows=date('w', strtotime($datecur))+1;
			if($vNoWork==false)
			{
				if(GetDayOfWeek($datecur)==7)	$this->ArrDaySpecial[0]['T7']=(int)$this->ArrDaySpecial[0]['T7']+1;
				if(GetDayOfWeek($datecur)==1)	$this->ArrDaySpecial[0]['CN']=(int)$this->ArrDaySpecial[0]['CN']+1;
			}
			if(getday($datecur)=='01' && $vKhac==1)
				$vTitle='<font color="red">1/'.((int)getmonth($datecur))."</font>";
			else
				$vTitle=Fillnum(getday($datecur),2);
			if($vDows==1 && $vNoWork==false)
			{
				
				$this->lvHeader=$this->lvHeader.'<td rowspan="2" class="tdhprint" ><center><b>'.$vTitle.'</b></center></td>';
				if($vNoWork==true)
				{
					$this->lvHeader1=$this->lvHeader1.'<td class="tdhprint" style="background:#d3d3d3"><center><b>'.$vDaysArr[$vDows].'</b></center></td>';
					$strTD=$strTD.'<td style="background:#d3d3d3"><center>&nbsp;</center></td>';
				}
				else
				{
					$this->DateSun++;
					$this->lvHeader1=$this->lvHeader1.'<td class="tdhprint" style="background:#d3d3d3"><center><b>'.$vDaysArr[$vDows].'</b></center></td>';
					$strTD=$strTD.'<td style="background:#d3d3d3"><center>'."<!--".str_replace("/","-",$datecur)."-->".'</center></td>';
				}
				$this->lvFooter=$this->lvFooter.'<td style="background:#d3d3d3"><center>'."<!--F-".str_replace("/","-",$datecur)."-->".'</center></td>';
				
			}
			else
			{
				
				$this->lvHeader=$this->lvHeader.'<td rowspan="2" class="tdhprint"><center><b>'.$vTitle.'</b></center></td>';
				if($vNoWork==true)
				{
					$this->lvHeader1=$this->lvHeader1.'<td class="tdhprint"><center><b>'.$vDaysArr[$vDows].'</b></center></td>';
					$strTD=$strTD.'<td><center>&nbsp;</center></td>';
				}
				else
				{
					$this->DateWork++;
					$this->lvHeader1=$this->lvHeader1.'<td class="tdhprint"><center><b>'.$vDaysArr[$vDows].'</b></center></td>';
					$strTD=$strTD.'<td><center>'."<!--".str_replace("/","-",$datecur)."-->".'</center></td>';
				}
				$this->lvFooter=$this->lvFooter.'<td><center>'."<!--F-".str_replace("/","-",$datecur)."-->".'</center></td>';
			}
			if($vNoWork==false) $this->vArrDay[$datecur]=$datecur;
			$datecur=ADDDATE($this->datefrom,$i);
			if(getmonth($this->datefrom)!=getmonth($datecur)) $vNoWork=true;
		}
		return $strTD;
	}
	function Get_String_DateFromTo()
	{
		$vDaysArr=array('1'=>'Sun','2'=>'Mon','3'=>'Tue','4'=>'Wed','5'=>'Thu','6'=>'Fri','7'=>'Sat');
		$this->lvHeader="";
		$strTD="";
		$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
		$datecur=$this->datefrom;
		$vKhac=(getmonth($this->datefrom)!=getmonth($this->dateto))?1:0;
		for($i=1;$i<=$lvNumDate+1;$i++)
		{
			$vDows=date('w', strtotime($datecur))+1;
			if(GetDayOfWeek($datecur)==7)	$this->ArrDaySpecial[0]['T7']=(int)$this->ArrDaySpecial[0]['T7']+1;
			if(GetDayOfWeek($datecur)==1)	$this->ArrDaySpecial[0]['CN']=(int)$this->ArrDaySpecial[0]['CN']+1;
			if(getday($datecur)=='01' && $vKhac==1)
				$vTitle='<font color="red">1/'.((int)getmonth($datecur))."</font>";
			else
				$vTitle=Fillnum(getday($datecur),2);
			if($vDows==1)
			{
				$this->DateSun++;
				$this->lvHeader=$this->lvHeader.'<td class="tdhprint" style="background:#d3d3d3"><center><b>'.$vTitle.'</b></center></td>';
				$this->lvHeader1=$this->lvHeader1.'<td class="tdhprint" style="background:#d3d3d3"><center><b>'.$vDaysArr[$vDows].'</b></center></td>';
				$this->lvFooter=$this->lvFooter.'<td style="background:#d3d3d3"><center>'."<!--F-".str_replace("/","-",$datecur)."-->".'</center></td>';
				$strTD=$strTD.'<td style="background:#d3d3d3"><center>'."<!--".str_replace("/","-",$datecur)."-->".'</center></td>';
			}
			else
			{
				$this->DateWork++;
				$this->lvHeader=$this->lvHeader.'<td class="tdhprint"><center><b>'.$vTitle.'</b></center></td>';
				$this->lvHeader1=$this->lvHeader1.'<td class="tdhprint"><center><b>'.$vDaysArr[$vDows].'</b></center></td>';
				$strTD=$strTD.'<td><center>'."<!--".str_replace("/","-",$datecur)."-->".'</center></td>';
				$this->lvFooter=$this->lvFooter.'<td><center>'."<!--F-".str_replace("/","-",$datecur)."-->".'</center></td>';
			}
			$this->vArrDay[$datecur]=$datecur;
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
		if($this->lv029_!="")  $strCondi=$strCondi." and C.lv029 in (".$this->LV_GetDep($this->lv029_).")";
		return $strCondi;
	}
	protected function GetConditionOrther()
	{
		$vYearMonth=getyear($this->datefrom).getmonth($this->datefrom);
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		//if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->datefrom!="")  $strCondi=$strCondi." and A.lv004  >= ADDDATE('$this->datefrom',-1)";
		if($this->dateto!="") 
		{
			$strCondi=$strCondi." and A.lv004  <= ADDDATE('$this->dateto',1)";
		}
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and A.lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and A.lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and A.lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and A.lv010 like '%$this->lv010%'";
		if($this->isStaffOff==1) 
			if($this->lv028!="")  $strCondi=$strCondi." and A.lv002 in (".$this->GetMultiValue("select CC.lv001 from tc_lv0010 CC where CC.lv002 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv009 in ('".str_replace(",","','",$this->lv028)."') and DD.lv030<='$this->dateto' AND concat(year(DD.lv044),month(DD.lv044))<='$vYearMonth'").")").")";
		else
			if($this->lv028!="")  $strCondi=$strCondi." and A.lv002 in (".$this->GetMultiValue("select CC.lv001 from tc_lv0010 CC where CC.lv002 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv009 in ('".str_replace(",","','",$this->lv028)."') and DD.lv030<='$this->dateto'").")").")";
		if($this->lv029!="")  $strCondi=$strCondi." and C.lv029 in (".$this->LV_GetDep($this->lv029).")";
		if($this->lv029_!="")  $strCondi=$strCondi." and C.lv029 in (".$this->LV_GetDep($this->lv029_).")";
		if($this->lv030!="")  $strCondi=$strCondi." and A.lv002 in (".$this->GetMultiValue("select CC.lv001 from tc_lv0010 CC where CC.lv002 in ('".$this->lv030."')").")";
		return $strCondi;
	}
	function LV_GetDep($vDepID)
	{
		if($vDepID=="") return '';
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		$vsql="select lv001 from  hr_lv0002 where lv001 in ($vReturn)  order by lv103 asc";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			//$vReturn=$vReturn.",'".$vrow['lv001']."'";
			$vReturn=$vReturn.",".$this->LV_GetChildDep($vrow['lv001']);
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
		$vtr="<tr onDblClick=\"this.innerHTTS=''\" style=\"cursor:move;font-size:20px;font-weight:bold\"><td class=\"right_hr\" colspan=\"$vColpan\" valign=\"top\" >$vLang: @01</td></tr>";
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
	public function GetBuilCheckList($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002',$vDepID="")
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
		$vsql="select * from  ".$vTbl;
		}
		else
		{
			$vReturn="'".str_replace(",","','",$vDepID)."'";
			$vsql="select lv001,lv003 from  hr_lv0002 where (lv001 in ($vReturn) or lv002 in ($vReturn))  order by lv003";
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