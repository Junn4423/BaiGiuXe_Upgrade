<?php
class rp_lv0011 extends lv_controler{
	
	public $isConnectSQLSERVER = false;
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
	
	function LV_QCC($vStartDate,$vEndDate)
	{
		$vsql="select lv002,lv004,lv006 from hr_lv0036 where (lv006>='$vStartDate 00:00:00' and lv006<='$vEndDate 23:59:59') and lv004 in ('QCC','NĐX')";
		$bResult=db_query($vsql);
		while($vrow = db_fetch_array ($bResult))
		{
			if($vrow['lv004']=='QCC')
			{
				$this->ArrQCC[$vrow['lv002']]=$this->ArrQCC[$vrow['lv002']]+1;
				$this->ArrQCCDAY[$vrow['lv002']][substr($vrow['lv006'],0,10)]=$this->ArrQCCDAY[$vrow['lv002']][substr($vrow['lv006'],0,10)]+1;
			}
			else
			{
				$this->ArrNDX[$vrow['lv002']]=$this->ArrQCC[$vrow['lv002']]+1;
				$this->ArrNDXDAY[$vrow['lv002']][substr($vrow['lv006'],0,10)]=$this->ArrNDXDAY[$vrow['lv002']][substr($vrow['lv006'],0,10)]+1;
			}
		}
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
	function LV_CheckXinDiTreVeSom($vStartDate,$vEndDate)
	{
		if($this->ArrDonxinDiTreVeSom[0][0]) return;
		$this->ArrDonxinDiTreVeSom=Array();
		$vsql="select lv015,lv016,lv017,DATEDIFF(lv017,lv016) SoNgay,IF('$vEndDate 23:59:59'>lv017,DATEDIFF(lv017,lv016),DATEDIFF('$vEndDate',lv016)) SoNgayTinh from jo_lv0004 where (lv016>='$vStartDate 00:00:00' and lv016<='$vEndDate 23:59:59') and lv022='13' and lv021=1";
		$bResult=db_query($vsql);
		$this->ArrDonxinDiTreVeSom[0][0]=true;
		while($vrow = db_fetch_array ($bResult))
		{
			//Chưa xử lý xin liên tục.
			$vDayXinPhep=substr($vrow['lv016'],0,10);
			$vDayXinPhep1=substr($vrow['lv017'],0,10);
			$this->ArrDonxinDiTreVeSoOK[$vrow['lv015']][$vDayXinPhep]=true;	
			if($vDayXinPhep1!=$vDayXinPhep)
			{
				$this->ArrDonxinDiTreVeSoOK[$vrow['lv015']][$vDayXinPhep1]=true;	
			}
			/*
			if($vrow['SoNgay']==0)
				$this->ArrDonxinDiTreVeSom[$vrow['lv015']][0]=$this->ArrDonxinDiTreVeSom[$vrow['lv015']][0]+1;
			else
			{
				$this->ArrDonxinDiTreVeSom[$vrow['lv015']][0]=$this->ArrDonxinDiTreVeSom[$vrow['lv015']][0]+$vrow['SoNgayTinh']+1;
			}*/

		}
	}
	function LV_CheckQCCDon($vStartDate,$vEndDate)
	{
		if($this->ArrDonxinQCC[0][0]) return;
		$this->ArrDonxinQCC=Array();
		$vsql="select lv015,lv003,lv016,lv017,DATEDIFF(lv017,lv016) SoNgay,IF('$vEndDate 23:59:59'>lv017,DATEDIFF(lv017,lv016),DATEDIFF('$vEndDate',lv016)) SoNgayTinh from jo_lv0004 where (lv016>='$vStartDate 00:00:00' and lv016<='$vEndDate 23:59:59') and lv003 in ('QCC','NĐX') and lv021=1";
		$bResult=db_query($vsql);
		$this->ArrDonxinQCC[0][0]=true;
		while($vrow = db_fetch_array ($bResult))
		{
			if($vrow['lv003']=='QCC')
			{
				$this->ArrDonxinQCC[$vrow['lv015']][0]=$this->ArrDonxinQCC[$vrow['lv015']][0]+1;
				$this->ArrDonxinQCCDAY[$vrow['lv015']][substr($vrow['lv016'],0,10)][0]=$this->ArrDonxinQCCDAY[$vrow['lv015']][substr($vrow['lv016'],0,10)][0]+1;
			}
			else
			{
				$this->ArrDonxinNDX[$vrow['lv015']][0]=$this->ArrDonxinNDX[$vrow['lv015']][0]+1;
				$this->ArrDonxinNDXDAY[$vrow['lv015']][substr($vrow['lv016'],0,10)][0]=$this->ArrDonxinNDXDAY[$vrow['lv015']][substr($vrow['lv016'],0,10)][0]+1;
			}
		}
	}
	function LV_GetOKDung($vSoThang,$vSoNam=5)
	{
		
		if($vSoThang/12<4) return false;
		$vDemNam=$vSoThang/(12*$vSoNam);
		$vSoDu=$vSoThang%12;
		if($vDemNam>0)
		{
			return true;
			$vSoDu=$vSoThang%12;
			if($vSoDu==0)
			{
				return true;
			}
		}
		return false;
	}
	function LV_GetOKDungThang($vSoThang,$vSoNam=5)
	{
		if($vSoThang/12<4) return false;
		$vDemNam=$vSoThang/(12*$vSoNam);
		//$vSoDu=$vSoThang%(12*$vSoNam);
		if($vDemNam>0)
		{
			$vSoDu=$vSoThang%(12*$vSoNam);
			if($vSoDu==0)
			{
				return true;
			}
		}
		return false;
	}
	function LV_InsertAutoDouble($vNVID,$vDate)
	{
		$vsql="insert into tc_lv0117(lv001,lv002,lv003,lv004,lv005) values('$vDate','$vNVID','$this->LV_UserID',now(),0)";
		db_query($vsql);
	}
//////////////////////Buil list////////////////////
	function LV_BuilListReportOtherPrintLateSoon($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvopt,$vmau=0,$vshowgiokem=0,$sExport,$ShowOnce=0,$ShowDept=0)
	{	
		$this->ArrCheckDoubleStaff=Array();
		$this->ArrKhoaCong=Array();	
		$this->MaxLe=$this->LV_CheckSoNgayLe($this->datefrom,$this->dateto);
		$this->LV_QCC($this->datefrom,$this->dateto);
		$this->LV_CheckXinDiTreVeSom($this->datefrom,$this->dateto);
		$this->LV_CheckQCCDon($this->datefrom,$this->dateto);
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
		$vMonth=getmonth($this->datefrom);
		$vYear=getyear($this->datefrom);
		if($vmau==24)
		{
			$vArrWork=$this->mocr_lv0211->LV_XuLyTuNgayDenNgay($this->datefrom,$this->dateto);
		} 
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
		$sqlS = "SELECT D.lv200 PhepCuaNam,D.lv208 PhepNamTruocDu,A.lv002,A.lv003,DAYOFWEEK(A.lv004) DOWS, ADDDATE('$this->datefrom',-1) DtFrom,ADDDATE('$this->dateto',1) DtTo,ADDDATE(A.lv004,1) DateNext,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,A.lv013,A.lv014,A.lv015,A.lv016,A.lv017,A.lv018,A.lv019 TimeLate,A.lv020 TimeSoon,B.lv002 NVID,C.lv030 DateWork,C.lv029 lv001,D.lv007 Shift,IF(ISNULL(A.lv016),'00:00:00',A.lv016) TANGCATRUA,A.lv017 TANGCADEM,A.lv018 TANGCALE,A.lv021,D.lv003 FN_Nam,D.lv008 TimePhepPrevious,D.lv101 TimeAddPrevious,D.lv102 PYear,D.lv008 FN_Prev,(select sum(BB.lv096) from tc_lv0009 BB where BB.lv002=C.lv001 and BB.lv004=year(A.lv004) and BB.lv003<>month(A.lv004)) TimeAdd,(select sum(BB.lv131) from tc_lv0009 BB where BB.lv002=C.lv001 and BB.lv004=year(A.lv004) And BB.lv130=1 ) FNKTinh,D.lv098 TimeClear,D.lv099 TimeBUsed,C.lv102 Num_FN_F,(((year('$this->datefrom')-year(C.lv030))*12+month('$this->datefrom')-month(C.lv030))/12) Num_FN_FM,(((year('$this->datefrom')-year(C.lv030))*12+month('$this->datefrom')-month(C.lv030))) Num_FN_FM_Month,E.lv095 CL_L,E.lv096 CL_TimeSum,F.lv006 IsFNMonth,E.lv120 LastP,E.lv121 FirstP,E.lv122 LastCL,E.lv123 FirstCL,E.lv005 StateApr,A.lv001 MaCode FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 left join hr_lv0020 C on C.lv001=B.lv002 left join tc_lv0008 D on D.lv002=B.lv002  and D.lv005=year(A.lv004) left join tc_lv0009 E on E.lv002=B.lv002 and E.lv004=year(A.lv004) and E.lv003=month(A.lv004)  left join hr_lv0002 F on C.lv029=F.lv001  WHERE  A.lv100<>1  ".$this->GetConditionOrther()."  order by C.lv029 ASC,A.lv004 ASC";
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
				$this->ArrCheckDoubleStaff[$vrow['NVID']][$vrow['lv004']]++;
				if($this->ArrCheckDoubleStaff[$vrow['NVID']][$vrow['lv004']]>1 && $this->ArrCheckDoubleStaff[$vrow['NVID']][0]!=true)
				{
					$this->ArrCheckDoubleStaff[$vrow['NVID']][0]=true;
					///Đẩy dữ liệu lên hàm đợi để hệ thống cập nhật lịch ẩn
					$this->LV_InsertAutoDouble($vrow['NVID'],$vrow['lv004']);
				}
			//NVID NVID
			//lv010 Ca		
			//Shift year
			if($vrow['DtFrom']!=$vrow['lv004'] && $vrow['DtTo']!=$vrow['lv004'])
			{
				$this->ArrTCEmp[$vrow['NVID']]['PhepCuaNam']=$vrow['PhepCuaNam'];
				$this->ArrTCEmp[$vrow['NVID']]['PhepNamTruocDu']=$vrow['PhepNamTruocDu'];
			if($this->ArrKhoaCong[$vrow['NVID']][0]!=true)
			{
				$this->ArrKhoaCong[$vrow['NVID']][0]=true;
				$this->ArrKhoaCong[$vrow['NVID']][1]=$vrow['StateApr'];
			}
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
			$vTimeWorks=$this->GetTime($this->ArrTCEmp[$vrow['NVID']]['TIMEWORK'][1]);
			if($vTimeWorks==0) $vTimeWorks=8;
			$this->ArrDEPTPROJECTLEV0[$vrow['lv001']]=$vrow['lv001'];
			$this->ArrDEPTPROJECTLEV1[$vrow['lv001']][$vrow['lv021']][0]=$vrow['lv001'];
			$this->ArrDEPTPROJECTLEV1[$vrow['lv001']][$vrow['lv021']][1]=$vrow['lv021'];
			
			if($this->ArrDEPTPROJECT[$vrow['lv001']][$vrow['lv021']][$vrow['lv007']][$vrow['lv004']][0]==NULL)
				$this->ArrDEPTPROJECT[$vrow['lv001']][$vrow['lv021']][$vrow['lv007']][$vrow['lv004']][0]=$this->GetTime($vrow['lv005'])/$vTimeWorks;
			else
				$this->ArrDEPTPROJECT[$vrow['lv001']][$vrow['lv021']][$vrow['lv007']][$vrow['lv004']][0]=$this->GetTime($vrow['lv005'])/$vTimeWorks+$this->ArrDEPTPROJECT[$vrow['lv001']][$vrow['lv021']][$vrow['lv007']][$vrow['lv004']][0];
			$this->ArrDEPTPROJECT[$vrow['lv001']][$vrow['lv021']][$vrow['lv007']][$vrow['lv004']][1]=$vrow['lv001'];
			$this->ArrDEPTPROJECT[$vrow['lv001']][$vrow['lv021']][$vrow['lv007']][$vrow['lv004']][2]=$vrow['lv021'];
			$this->ArrDEPTPROJECT[$vrow['lv001']][$vrow['lv021']][$vrow['lv007']][$vrow['lv004']][3]=$vrow['lv007'];
			$this->ArrDEPTPROJECT[$vrow['lv001']][$vrow['lv021']][$vrow['lv007']][$vrow['lv004']][4]=$vrow['lv004'];
			$vYearCal=getyear($vrow['lv004']);
			$vTimeLate=$this->GetTimeMinute($vrow['TimeLate']);
			$vTimeSoon=$this->GetTimeMinute($vrow['TimeSoon']);
		//	if($vrow['lv004']=='2020-02-03') echo $vTimeLate;
			//if(($vTimeLate>=1 && $vTimeLate<4) ||($vTimeSoon>=1 && $vTimeSoon<4))
			if(($vTimeLate>0) ||($vTimeSoon>0))
			{
				//echo 'VINH a';
				//echo $vrow['lv004'].": $vTimeLate+$vTimeSoon<br/>";
				if($vTimeLate>0)
				{
					$this->ArrTCEmp[$vrow['NVID']]['LateSoon']=(int)$this->ArrTCEmp[$vrow['NVID']]['LateSoon']+1;
				}
				if($vTimeSoon>0)
				{
					$this->ArrTCEmp[$vrow['NVID']]['LateSoon']=(int)$this->ArrTCEmp[$vrow['NVID']]['LateSoon']+1;
				}
				$this->ArrTCEmp[$vrow['NVID']]['MinLateSoon']=(int)$this->ArrTCEmp[$vrow['NVID']]['MinLateSoon']+$vTimeLate+$vTimeSoon;
				$this->ArrTCEmp[$vrow['NVID']]['isLateSoonPhep']=(int)$this->ArrTCEmp[$vrow['NVID']]['isLateSoonPhep']+$vrow['lv013'];
			//	echo $vrow['lv004'].'=>'.$vrow['lv013'].'<br/>';	
			}
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
			if($vYear==getyear($this->ArrEmp[$lvvt][30]) && $vMonth==getmonth($this->ArrEmp[$lvvt][30]))
			{
				if(getday($this->ArrEmp[$lvvt][30])>15)
				{
					//$vrow['Num_FN_FM']=0;
					//$vrow['Num_FN_F']=0;
				}
			}
			$this->ArrTCEmp[$vrow['NVID']]['Num_FN_FM']=$vrow['Num_FN_FM'];
			$visTang=$this->LV_GetOKDung($vrow['Num_FN_FM_Month'],5);
			$vNum_FN_FM=$this->LV_GetTangP($this->LV_GetChan($this->ArrTCEmp[$vrow['NVID']]['Num_FN_FM']));
			if($visTang==false && $vNum_FN_FM>0)
			{
				//$vNum_FN_FM=$vNum_FN_FM-1;
			}
			//echo $vrow['NVID'].":".$vrow['TimeBUsed'].$vBr;
			$this->ArrTCEmp[$vrow['NVID']]['Num_FN_F']=$vrow['Num_FN_F']+$vNum_FN_FM;
			if($this->ArrTCEmp[$vrow['NVID']]['Num_FN_F']>20) $this->ArrTCEmp[$vrow['NVID']]['Num_FN_F']=20;
			$vNumCal=1;
			/*if($vYearCal<='2015')
				$vNumCal=1;
			else
				$vNumCal=$this->LV_GetPhepHuong(getmonth($vrow['lv004']),$vYearCal,getmonth($vrow['DateWork']),getyear($vrow['DateWork']));*/
				//echo getmonth($this->datefrom);
			if($visTang)//getmonth($this->datefrom)==1 || $vYearCal=='2015')
			{
				//echo $vrow['TimePhepPrevious'].'+'.$vrow['FN_Prev'].'=';
				/*if(getmonth($this->datefrom)==1)
				{
					$vP=$vrow['FirstP'];
				}
				else
				{
					if($this->ArrTCEmp[$vrow['NVID']]['Num_FN_F']>12)
						$vP=($this->ArrTCEmp[$vrow['NVID']]['Num_FN_F']-12)+$vrow['TimePhepPrevious']+$vrow['FN_Prev'];			
					else
						$vP=$vrow['TimePhepPrevious']+$vrow['FN_Prev'];			
				}
							*/
				if(getmonth($this->datefrom)==1)
				{
					$vP=$vrow['TimePhepPrevious']+$vNum_FN_FM;
				}
				else
				{
					if($this->LV_GetOKDungThang($vrow['Num_FN_FM_Month'],5))
					{
						//$vP=$vrow['FirstP']+$vNum_FN_FM;	
						$vP=$vrow['FirstP']+1;
					}
					else
					{
						$vP=$vrow['FirstP'];
					}
				}
			}
			else
			{
				if(getmonth($this->datefrom)==1)
				{
					$vP=$vrow['TimePhepPrevious'];
				}
				else
					$vP=$vrow['FirstP'];

			}
			$this->ArrTCEmp[$vrow['NVID']]['FN_Nam']=$vP;//$vrow['FN_Nam'];//($vrow['IsFNMonth']==0)?(($vrow['TimePhepPrevious']!=0)?$vrow['TimePhepPrevious']:$vrow['PYear']):($vrow['FN_Nam']+$vrow['TimePhepPrevious']);			
			$this->ArrTCEmp[$vrow['NVID']]['TANGCATRUA']=TIMEADD($this->ArrTCEmp[$vrow['NVID']]['TANGCATRUA'],$vrow['TANGCATRUA']);
			$this->ArrTCEmp[$vrow['NVID']]['TANGCALE']=TIMEADD($this->ArrTCEmp[$vrow['NVID']]['TANGCALE'],$vrow['TANGCALE']);
			$this->ArrTCEmp[$vrow['NVID']]['TANGCADEM']=TIMEADD($this->ArrTCEmp[$vrow['NVID']]['TANGCADEM'],$vrow['TANGCADEM']);
			if($vrow['lv014']!=NULL && $vrow['lv014']!="00:00:00" && $vrow['lv014']!="") 
			{
				$this->ArrTCEmp[$vrow['NVID']]['GIOTANGCA']=TIMEADD(($this->ArrTCEmp[$vrow['NVID']]['GIOTANGCA']==NULL)?'00:00:00':$this->ArrTCEmp[$vrow['NVID']]['GIOTANGCA'],$vrow['lv014']);
			}
			if(trim($vrow['lv008'])!='' && $vrow['lv008']!=NULL)
			{
				if($vrow['lv008']=='1/2P' || $vrow['lv008']=='1/2KH' || $vrow['lv008']=='1/2KL' || $vrow['lv008']=='1/2KP'  || $vrow['lv008']=='1/2PB' || $vrow['lv008']=='1/4KP')
				{
					$this->ArrTCEmp[$vrow['NVID']][$vrow['lv008']]=$this->ArrTCEmp[$vrow['NVID']][$vrow['lv008']]+1;
					$this->ArrTCEmpShowThem[$vrow['NVID']][$vrow['lv004']]=$vrow['lv008'];
					//echo $this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv008']]=$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv008']]+round((4)/$vTimeWorks,2);
				}
				else{
					if($vrow['lv008']=='CT')
					{
						$this->ArrTCEmp[$vrow['NVID']][$vrow['lv008']]=$this->ArrTCEmp[$vrow['NVID']][$vrow['lv008']]+1-$this->GetTime($vrow['lv005'])/$vTimeWorks;
						if(1-$this->GetTime($vrow['lv005'])/$vTimeWorks>0)
						{
							if($vrow['lv007']!='1/2KL' && $vrow['lv007']!='1/2KP' && $vrow['lv007']!='1/4KP') $this->ArrTCEmp[$vrow['NVID']]['TI:X']=$this->ArrTCEmp[$vrow['NVID']]['TI:X']+1-$this->GetTime($vrow['lv005'])/$vTimeWorks;
						}
					}
					//$this->ArrTCEmpShowThem[$vrow['NVID']][$vrow['lv004']]=$vrow['lv008'];
				}
			}
			if($vTimeWorks!=0)
			{
				if(substr($vrow['lv007'],0,3)=='1/2')
				{
					if($vrow['lv007']=='1/2KL'  || $vrow['lv007']=='1/2PB' || $vrow['lv007']=='1/2KP')
						$vMaCong='X';
					else
						$vMaCong=$vrow['lv007'];//(trim($vrow['lv021'])!='')?'X':'X';
					//$vMaCong=(trim($vrow['lv021'])!='')?'X':'X';
					if($vrow['DOWS']==1) 
					{
						if($vrow['lv005']!='04:00:00') 
						{
							$this->ArrTCEmp[$vrow['NVID']]['CN:'.$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']]['CN:'.$vrow['lv007']]+round(($this->GetTime($vrow['lv005'])-4)/$vTimeWorks,2);
						}
					}
					if($vrow['lv005']!='04:00:00') 
						$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]+round(($this->GetTime($vrow['lv005'])-4)/$vTimeWorks,2);
					
					if($vrow['lv007']=='1/2P' || $vrow['lv007']=='1/2KH' || $vrow['lv007']=='1/2KL'  || $vrow['lv007']=='1/2PB')
					{
						$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vMaCong]=$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vMaCong]+round((4)/$vTimeWorks,2);
						//echo round(($this->GetTime($vrow['lv005'])-4)/$vTimeWorks,2);
						$this->ArrTCEmp[$vrow['NVID']]['TI:X']=$this->ArrTCEmp[$vrow['NVID']]['TI:X']+round(($this->GetTime($vrow['lv005'])-4)/$vTimeWorks,2);
					}
					else
						$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vMaCong]=$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vMaCong]+round(($this->GetTime($vrow['lv005']))/$vTimeWorks,2);

				}
				elseif(substr($vrow['lv007'],0,3)=='1/4')
				{
					if($vrow['lv007']=='1/4KP')
						$vMaCong='X';
					else
						$vMaCong=$vrow['lv007'];//(trim($vrow['lv021'])!='')?'X':'X';
					//$vMaCong=(trim($vrow['lv021'])!='')?'X':'X';
					if($vrow['DOWS']==1) 
					{
						if($vrow['lv005']!='06:00:00') 
						{
							$this->ArrTCEmp[$vrow['NVID']]['CN:'.$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']]['CN:'.$vrow['lv007']]+round(($this->GetTime($vrow['lv005'])-6)/$vTimeWorks,2);
						}
					}
					if($vrow['lv005']!='06:00:00') 
						$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]+round(($this->GetTime($vrow['lv005'])-6)/$vTimeWorks,2);
					
					$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vMaCong]=$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vMaCong]+round(($this->GetTime($vrow['lv005']))/$vTimeWorks,2);

				}
				else
				{
					if($vrow['DOWS']==1) $this->ArrTCEmp[$vrow['NVID']]['CN:'.$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']]['CN:'.$vrow['lv007']]+round($this->GetTime($vrow['lv005'])/$vTimeWorks,2);
						$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]+round($this->GetTime($vrow['lv005'])/$vTimeWorks,2);
				}
			}
				switch($vrow['lv007'])
				{
					case 'TN':
						if(str_replace(":","",$vrow['lv005'])>=40000) $this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]+1;
						break;
					default:
						if($this->MaxLe[$vrow['lv004']]==true)
						{
							if($vrow['lv007']=='1' || $vrow['lv007']=='CT') $this->ArrTCEmp[$vrow['NVID']]['L']=$this->ArrTCEmp[$vrow['NVID']]['L']+1;
						}							
						
						$this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]+1;
						break;
				}
			
			
			$vListShiftReceive=$this->ArrDep[$vrow['lv001']][0];
			$arrTime=null;
			$arrShift=$this->GetTimeListArr($vrow['NVID'],$vrow['lv004'],$vrow['lv015'],$vrow['Shift'],$passday,$vListShiftReceive,$vPreShift[$vrow['NVID']][$vrow['lv004']],$arrTime,$lvopt);
			$lvcheck=$this->LV_CheckLateSoon($vrow['NVID'],$vrow['lv015'],$vrow['Shift'],$arrShift);
			$this->ArrStateEmp[$vrow['lv004']][$lvcheck]=$this->ArrStateEmp[$vrow['lv004']][$lvcheck]+1;
			
			$strL="";
			$vorder++;
			$lvstrgt="";
			$lvstrgt4="";
			$lvstrgt5="";
			$lvstrgt6="";
			$lvstrgt7="";
			$lvstrgt8="";
			$lvstrgt9="";
			$lvstrgt10="";
			$lvstrgt15="";
			$lvstrgt18="";
			$lvstrgt20="";
			$lvstrgt21="";
			$lvstrgt31="";
			$lvstrgt69="";
			$lvstrgt4Tam="";
			$lvstrgt69Tam="";
			$vState6=false;
			$vState8=false;
			$vState9=false;
			$vState10=false;
			$vColor=" style='color:red;font-style:italic;' ";
			$vColorNone=" style='color:#000;font-style:none;' ";
			foreach($lvparatimecard as $lvgt)
			{
				if(count($lvparatimecard)==1)
					$vBr="";
				else
					$vBr="";
				switch ($lvgt)
				{
					case 5:
						$lvstrgt5=$lvstrgt5.$vrow['lv005'].$vBr;
						break;
					case 6:
						if($vrow['lv014']!=NULL && $vrow['lv014']!="00:00:00" && ($vrow['DtFrom']!=$vrow['lv004'] && $vrow['DtTo']!=$vrow['lv004']))
						{
							$this->ArrEmp[$lvvt][90]=$this->ArrEmp[$lvvt][90].",6,";
							$vState6=true;
						}
						$lvstrgt6=$lvstrgt6."<font $vColor>".$this->FormatView(round($this->GetTime($vrow['lv014'])+$this->GetTime($vrow['lv016']),2),20)."</font>".$vBr;
						break;
					case 8:
						if($vrow['lv016']!=NULL && $vrow['lv016']!="00:00:00" && ($vrow['DtFrom']!=$vrow['lv004'] && $vrow['DtTo']!=$vrow['lv004']))
						{
							$this->ArrEmp[$lvvt][90]=$this->ArrEmp[$lvvt][90].",8,";
							$vState8=true;
						}
						$lvstrgt8=$lvstrgt8."<font $vColor>".$this->FormatView(round($this->GetTime($vrow['lv016']),2),20)."</font>".$vBr;
						break;
					case 9:
						if($vrow['lv017']!=NULL && $vrow['lv017']!="00:00:00" && ($vrow['DtFrom']!=$vrow['lv004'] && $vrow['DtTo']!=$vrow['lv004']))
						{
							$this->ArrEmp[$lvvt][90]=$this->ArrEmp[$lvvt][90].",9,";
							$vState9=true;
						}
						$lvstrgt9=$lvstrgt9."<font $vColor>".$this->FormatView(round($this->GetTime($vrow['lv017']),2),20)."</font>".$vBr;
						break;
					case 10:
						if($vrow['lv018']!=NULL && $vrow['lv018']!="00:00:00" && ($vrow['DtFrom']!=$vrow['lv004'] && $vrow['DtTo']!=$vrow['lv004']))
						{
							$this->ArrEmp[$lvvt][90]=$this->ArrEmp[$lvvt][90].",10,";
							$vState10=true;
						}
						$lvstrgt10=$lvstrgt10."<font $vColor>".$this->FormatView(round($this->GetTime($vrow['lv018']),2),20)."</font>".$vBr;
						break;
					case 18:
							$lvstrgt18=$lvstrgt18.$vrow['lv021'].$vBr;
						break;
					case 69:
					case 4:
						$lvstrgt4='';
						$lvstrgt69='';
						$vCoDiLam=true;
						$vStrlv007='';
						$vlv001=$vrow['NVID'];
						$vlv002=$vrow['lv004'];
						$vTime='';
						if($_GET['childfunc']!='excel' && (($vrow['lv007']!='X' && $vrow['lv007']!='') || ($lvcheck>0 && $vrow['DOWS']!=1  && $vrow['DOWS']!=7))) 
						{
							$vTenNguoiSua='';
							$vTenNV=$this->LV_GetStaffName($vlv001);
							$vCode=str_replace(":",'',"$vlv001$vlv002$vTime");
							$vStrlv007=$this->LV_CodeShowS7($vCode,$vlv001,$vlv002,$vTenNV,$vTime,$vTenNguoiSua,$vrow['lv007']);
						}
						else
						{
							if($vmau==24)
							{
								$vTenNguoiSua='';
								$vTenNV='';
								$vCode=str_replace(":",'',"$vlv001$vlv002$vTime");
								$vStrlv007=$this->LV_CodeShowS7($vCode,$vlv001,$vlv002,$vTenNV,$vTime,$vTenNguoiSua,$vrow['lv007']);
							}
							else
								$vStrlv007=$vrow['lv007'];						
						}
						if($this->lvState==0)
						{
							$vSubTitle='';
							if($this->ArrTCEmpShowThem[$vrow['NVID']][$vrow['lv004']]!=null && $this->ArrTCEmpShowThem[$vrow['NVID']][$vrow['lv004']]!='')
							{
								$vCodeThem=$this->ArrTCEmpShowThem[$vrow['NVID']][$vrow['lv004']];
								if(substr($vCodeThem,0,3)=='1/2')
								{
									$vSubTitle='+'.$vCodeThem;
								}
							}
							if($vCodeThem=='')
							{
								if(trim($vrow['lv008'])!='' && $vrow['lv008']!=null)
								{
									$vSubTitle='+'.$vrow['lv008'];
								}
							}
							if($vshowgiokem==1)
							{
								if($vrow['lv005']!=$vTimeWork && $vrow['lv005']!="00:00:00")
								{
									if($vrow['lv007']=='NĐX')
									{
										$lvstrgt4=$lvstrgt4.round(($this->GetTime($vrow['lv005'])/$vTimeWorks),2)."+".round(((8-$this->GetTime($vrow['lv005']))/$vTimeWorks),2).'NĐX';
									}
									elseif($vrow['lv007']=='KL')
									{
										$lvstrgt4=$lvstrgt4.round(($this->GetTime($vrow['lv005'])/$vTimeWorks),2).$vSubTitle."";
									}
									elseif( $vrow['lv007']=="KL"  || $vrow['lv007']=="SL"  || $vrow['lv007']=="1/2P" || $vrow['lv007']=='1/2KL' || $vrow['lv007']=='1/2KP' || $vrow['lv007']=='1/2KH' || $vrow['lv007']=='1/2KL'  || $vrow['lv007']=='1/2PB' || $vrow['lv007']=="P")
									{
										if($this->lvState==0)
											$lvstrgt4=$lvstrgt4.$vStrlv007."".$vSubTitle;
										else
											$lvstrgt4=$lvstrgt4."<font style='text-transform: uppercase;''>".$vStrlv007.$vSubTitle."</font>";
									}
									else
										$lvstrgt4=$lvstrgt4.round(($this->GetTime($vrow['lv005'])/$vTimeWorks),2)."";
								}
								else
								{
									if(($vrow['lv007']=='8' || $vrow['lv007']=='NS' || $vrow['lv007']=='TN' ) )
									{
										if($vrow['lv005']!="00:00:00")
											$lvstrgt4=$lvstrgt4.round(($this->GetTime($vrow['lv005'])/$vTimeWorks),2).$vSubTitle."";
										else
											$lvstrgt4=$lvstrgt4.'&nbsp;'."";
									}
									else
									{
										if(($vrow['lv007']=='CL'))
										{
											if(($vrow['lv016']=='08:00:00'))
												{
													if($this->lvState==0)
														$lvstrgt4=$lvstrgt4.$vrow['lv007'].$vSubTitle."";
													else
														$lvstrgt4=$lvstrgt4."<font style='text-transform: uppercase;''>".$vrow['lv007'].$vSubTitle."</font>";
												}
											else
												if(($vrow['lv016']=='00:00:00'))
												{
													$lvstrgt4=$lvstrgt4.'&nbsp;'."";
												}
												else
												{
													$lvstrgt4=$lvstrgt4.$this->GetTime($vrow['lv016']).$vrow['lv007'].$vSubTitle."";
												}
										}
										elseif(($vrow['lv007']=='1/2CL'))
										{
											if(($vrow['lv016']=='04:00:00'))
												$lvstrgt4=$lvstrgt4.$vrow['lv007'].$vSubTitle."";
											else
												if(($vrow['lv016']=='00:00:00'))
												{
													$lvstrgt4=$lvstrgt4.'&nbsp;'."".$vSubTitle;
												}
												else
												{
													if($this->lvState==0)
														$lvstrgt4=$lvstrgt4.$vStrlv007.$vSubTitle."";
													else
														$lvstrgt4=$lvstrgt4."<font style='text-transform: uppercase;''>".$vrow['lv007'].$vSubTitle."</font>";
												}
										}
										else
										{
											if($vrow['lv005']!="00:00:00" || $vrow['lv007']=='TS' || $vrow['lv007']=='KL' || $vrow['lv007']=="SL" || $vrow['lv007']=="DS" || $vrow['lv007']=="HL" || $vrow['lv007']=="C" || $vrow['lv007']=="HS" || $vrow['lv007']=="KP" || $vrow['lv007']=="KT" || $vrow['lv007']=="PB" || $vrow['lv007']=="PC" || $vrow['lv007']=="PT" || $vrow['lv007']=="TS" || $vrow['lv007']=="TT" || $vrow['lv007']=="VS"  || $vrow['lv007']=="1/2P" || $vrow['lv007']=="P"   || $vrow['lv007']=="KL" )
												{
													if($this->lvState==0)
														$lvstrgt4=$lvstrgt4.$vStrlv007.$vSubTitle."";
													else
														$lvstrgt4=$lvstrgt4."<font style='text-transform: uppercase;''>".$vrow['lv007'].$vSubTitle."</font>";
												}
											else
												$lvstrgt4=$lvstrgt4.'&nbsp;'."".$vSubTitle;
										}
									}
										
								}
							}
							else
							{
								if($this->lvState==0)
									$lvstrgt4=$lvstrgt4.$vStrlv007."";
								else
									$lvstrgt4=$lvstrgt4."<font style='text-transform: uppercase;''>".$vStrlv007.$vSubTitle."</font>";
							}
						}
						else
						{
							if($vshowgiokem==1)
							{
								if($vrow['lv005']!=$vTimeWork && $vrow['lv005']!="00:00:00")
									$lvstrgt4=$lvstrgt4.(($an)?'Code:':'').'<b>'.(round($this->GetTime($vrow['lv005'])/$vTimeWorks,2)).$vStrlv007."</b>";
								else
								{
									if($vrow['lv007']=='8' || $vrow['lv007']=='NS' || $vrow['lv007']=='TN')
									{
										if($vrow['lv005']!="00:00:00")
											$lvstrgt4=$lvstrgt4.(($an)?'Code:':'').'<b>'.round(($this->GetTime($vrow['lv005'])/$vTimeWorks),2)."</b>";
										else
											$lvstrgt4=$lvstrgt4.(($an)?'Code:':'')."<b>&nbsp;</b>";
									}
										
									else
									{
										if($vrow['lv005']!="00:00:00"  || $vrow['lv007']=='KL' || $vrow['lv007']=="SL")
											$lvstrgt4=$lvstrgt4.(($an)?'Code:':'').'<b>'.$vStrlv007."</b>";
										else
											$lvstrgt4=$lvstrgt4.(($an)?'Code:':'')."<b>&nbsp;</b>";
									}
										
								}
							}
							else
							{
								if($vrow['lv007']=='8' || $vrow['lv007']=='NS' || $vrow['lv007']=='TN')
									$lvstrgt4=$lvstrgt4.(($an)?'Code:':'').'<b>'.round(($this->GetTime($vrow['lv005'])/$vTimeWorks),2)."</b>";
								else
									$lvstrgt4=$lvstrgt4.(($an)?'Code:':'').'<b>'.$vrow['lv007']."</b>";
							}
						}
						
						if($vrow['DtFrom']!=$vrow['lv004'] && $vrow['DtTo']!=$vrow['lv004'])
						{
							if($vrow['lv007']=='KH' || $vrow['lv007']=='KL' || $vrow['lv007']=='KP' || $vrow['lv007']=='L' || $vrow['lv007']=='P' || $vrow['lv007']=='PT' || $vrow['lv007']=='TS')
							{
								$vCoDiLam=false;
							}
							else
							{
								if($vrow['lv007']=='1/2P' || $vrow['lv008']=='1/2P')
								{
									if($vrow['lv005']>'04:00:00')
									{
										if($vrow['DOWS']!=1) $this->ArrTCEmp[$vrow['NVID']]['BCCV']=$this->ArrTCEmp[$vrow['NVID']]['BCCV']+1;
									}
									else
									{
										$vCoDiLam=false;
									}
								}
								else
								{
									if($vrow['DOWS']!=1) $this->ArrTCEmp[$vrow['NVID']]['BCCV']=$this->ArrTCEmp[$vrow['NVID']]['BCCV']+1;
								}
							}
							if($vrow['DOWS']==1) $vCoDiLam=false;
						if(strpos($lvstrgt4,'QCC')===false)
						{	
							if($this->ArrDonxinQCCDAY[$vrow['NVID']][$vrow['lv004']][0]>0 || $this->ArrQCCDAY[$vrow['NVID']][$vrow['lv004']]>0)
							{
								$lvstrgt4=$lvstrgt4.'+QCC';
							}	
						}
						if($vArrWork[$vrow['NVID']][$vrow['lv004']][0])	
						{
							$vCode=$vrow['MaCode'];
							if($vrow['DOWS']!=1)  $this->ArrTCEmp[$vrow['NVID']]['BCCVY']=$this->ArrTCEmp[$vrow['NVID']]['BCCVY']+1;
							$vTenNV=$this->LV_GetStaffName($vlv001);
							$lvstrgt69='
							<div style="cursor:pointer;color:blue;" onclick="showDetailBBCV(\'chitietbccvid_'.$vCode.'\',\''.$vCode.'\',\''.$vlv001.'\',\''.$vlv002.'\')">Y</div>
								<div style="display:none;position:absolute;z-index:999999999999;background:#efefef;width:800px;" id="chitietbccvid_'.$vCode.'" class="noidung_member">
								
								<div class="hd_cafe" style="width:100%">
									<ul class="qlycafe" style="width:100%">
									<li style="padding:10px;"><img onclick="document.getElementById(\'chitietbccvid_'.$vCode.'\').style.display=\'none\';" width="20" src="../images/icon/close.png"/></li>
									<li style="padding:10px;">
										<div style="width:100%;padding-top:2px;">
											<div>
												<div style="float:left;"><strong>'.$vTenNV.' ['.$this->FormatView($vrow['lv004'],2).']</strong></div>'.'
											</div>
										</div>
									</li>
									</ul>
								</div>
								<div id="chitietnoidung_'.$vCode.'" style="min-width:360px;overflow:hidden;overflow: scroll;text-align:left">'.$vArrWork[$vrow['NVID']][$vrow['lv004']][2].'
								</div>
								<div width="100%;height:40px;">
									<center>
										<div style="width:160px;border-radius:5px;cursor:pointer;height:30px;padding-top:10px;" onclick="document.getElementById(\'chitietbccvid_'.$vCode.'\').style.display=\'none\';">ĐÓNG LẠI</div>
									</center>
								</div>
							</div>	
							';	
							//$lvstrgt69='<span onclick="showBC('.$vrow['lv001'].')">Y</span><div id="BCCV_'.$vrow['lv001'].'" style="display:none;">'.$vArrWork[$vrow['NVID']][$vrow['lv004']][2].'</div>';
						}
						else
						{
							//echo $vrow['lv004'].'->'.$this->ArrTCEmp[$vrow['NVID']]['BCCVN'].'<br/>';
							$lvstrgt69=$lvstrgt4;
							$lvstrgt69=str_replace('>X<','>&nbsp;<',$lvstrgt69);
							if($vCoDiLam && $vrow['DOWS']!=1) $this->ArrTCEmp[$vrow['NVID']]['BCCVN']=$this->ArrTCEmp[$vrow['NVID']]['BCCVN']+1;	
							/*
							if($vrow['DOWS']!=1)  
							{
								if($vrow['lv005']=='00:00:00')
								{
									if($vrow['lv007']=='')
										$this->ArrTCEmp[$vrow['NVID']]['BCCVN']=$this->ArrTCEmp[$vrow['NVID']]['BCCVN']+1;	
									else
									{
										//if(trim($vrow['lv007'])!='' && trim($vrow['lv007'])!='X') $lvstrgt69=$vrow['lv007'];//($vrow['lv007']=='X')?'':$vrow['lv007'];
									}
								}
								else
								{
									if($vrow['lv005']=='08:00:00')
									{
										//$lvstrgt69=($vrow['lv007']=='X')?'':$vrow['lv007'];
									}
									else if($vrow['lv005']=='04:00:00')
									{
										if($vrow['lv007']=='1/2P' || $vrow['lv008']=='1/2P')
										{
											//$lvstrgt69=$vrow['lv007'].'+'.$vrow['lv008'];
										}
										else
										{
											$this->ArrTCEmp[$vrow['NVID']]['BCCVN']=$this->ArrTCEmp[$vrow['NVID']]['BCCVN']+1;	
										}
									}	
									else
									{
										$this->ArrTCEmp[$vrow['NVID']]['BCCVN']=$this->ArrTCEmp[$vrow['NVID']]['BCCVN']+1;								
									}
								}
							}
							*/
						}
						}		
						if($lvgt==4)
						{
							$lvstrgt4Tam=$lvstrgt4;
						}
						if($lvgt==69)
						{
							$lvstrgt69Tam=$lvstrgt69;
						}				
						break;
					case 15:
						if($this->lvState==0)
						{
							if($vshowgiokem==1)
							{
								if($vrow['lv005']!=$vTimeWork && $vrow['lv005']!="00:00:00")
									$lvstrgt15=$lvstrgt15.'<br/>'.'<b>'.(round($this->GetTime($vrow['lv005'])/$vTimeWorks,2)).$vrow['lv015']."</b><br/>";
								else
									$lvstrgt15=$lvstrgt15.'<br/>'.$vrow['lv015'].$vBr;
							}
							else
								$lvstrgt15=$lvstrgt15.'<br/>'.$vrow['lv015'].$vBr;
						}
						else
						{
							if($vshowgiokem==1)
							{
								if($vrow['lv005']!=$vTimeWork && $vrow['lv005']!="00:00:00")
									$lvstrgt15=$lvstrgt15.''.(($an)?'Shift:':'').'<b>'.(round($this->GetTime($vrow['lv005'])/$vTimeWorks,2)).$vrow['lv015']."</b>";
								else
									$lvstrgt15=$lvstrgt15.''.(($an)?'Shift:':'').'<b>'.$vrow['lv015']."</b>";
							}
							else
								$lvstrgt15=$lvstrgt15.''.(($an)?'Shift:':'').'<b>'.$vrow['lv015']."</b>";
						}
						break;
					case 20:
							$lvstrgt20=$lvstrgt20.$this->GetTimeListMore($arrTime,$vCount,$vrow['NVID'],$vrow['lv004']).$vBr;
						break;
					case 21:
							$lvstrgt21=$lvstrgt21.'<br/>'.$vArrState[$lvcheck].$vBr;
						break;
					
					case 31:
						if($this->lvState!=0) $lvstrgt31=$lvstrgt31.(($an)?$vArrState[$lvcheck]:'');				
						$lvstrgt31=$lvstrgt31.'<b>';
						switch($lvcheck)
						{
							case 1:
								if(substr($vrow['TimeLate'],0,5)!='00:00') $lvstrgt31=$lvstrgt31.substr($vrow['TimeLate'],0,5);
								if(substr($vrow['TimeSoon'],0,5)!='00:00')  $lvstrgt31=$lvstrgt31.substr($vrow['TimeSoon'],0,5);
								break;
							case 2:
								if(substr($vrow['TimeSoon'],0,5)!='00:00')  $lvstrgt31=$lvstrgt31.substr($vrow['TimeSoon'],0,5);
								break;
							case 3:
								if(substr($vrow['TimeSoon'],0,5)!='00:00' && substr($vrow['TimeLate'],0,5)!='00:00')
								{
									$lvstrgt31=$lvstrgt31.substr($vrow['TimeLate'],0,5)."|".substr($vrow['TimeSoon'],0,5);
								}
								else
								{
									if(substr($vrow['TimeSoon'],0,5)!='00:00')  $lvstrgt31=$lvstrgt31.substr($vrow['TimeSoon'],0,5);
									if(substr($vrow['TimeLate'],0,5)!='00:00') $lvstrgt31=$lvstrgt31.substr($vrow['TimeLate'],0,5);
								}
								
								break;
						}
						$lvstrgt31=$lvstrgt31."</b>";
						break;
				}
			}
			$lvstrgt4=$lvstrgt4Tam;
			$lvstrgt69=$lvstrgt69Tam;
			$this->ArrEmp[$lvvt][4]=str_replace("<!--".$vrow['lv004']."-->",($lvstrgt4==NULL || trim($lvstrgt4)=='')?'&nbsp;':$lvstrgt4,$this->ArrEmp[$lvvt][4]);
			$this->ArrEmp[$lvvt][5]=str_replace("<!--".$vrow['lv004']."-->",($lvstrgt5==NULL || trim($lvstrgt5)=='')?'&nbsp;':$lvstrgt5,$this->ArrEmp[$lvvt][5]);
			$this->ArrEmp[$lvvt][6]=str_replace("<!--".$vrow['lv004']."-->",($lvstrgt6==NULL || trim($lvstrgt6)=='')?'&nbsp;':$lvstrgt6,$this->ArrEmp[$lvvt][6]);
			$this->ArrEmp[$lvvt][7]=str_replace("<!--".$vrow['lv004']."-->",($lvstrgt7==NULL || trim($lvstrgt7)=='')?'&nbsp;':$lvstrgt7,$this->ArrEmp[$lvvt][7]);
			$this->ArrEmp[$lvvt][8]=str_replace("<!--".$vrow['lv004']."-->",($lvstrgt8==NULL || trim($lvstrgt8)=='')?'&nbsp;':$lvstrgt8,$this->ArrEmp[$lvvt][8]);
			$this->ArrEmp[$lvvt][9]=str_replace("<!--".$vrow['lv004']."-->",($lvstrgt9==NULL || trim($lvstrgt9)=='')?'&nbsp;':$lvstrgt9,$this->ArrEmp[$lvvt][9]);
			$this->ArrEmp[$lvvt][10]=str_replace("<!--".$vrow['lv004']."-->",($lvstrgt10==NULL || trim($lvstrgt10)=='')?'&nbsp;':$lvstrgt10,$this->ArrEmp[$lvvt][10]);
			$this->ArrEmp[$lvvt][15]=str_replace("<!--".$vrow['lv004']."-->",($lvstrgt15==NULL || trim($lvstrgt15)=='')?'&nbsp;':$lvstrgt15,$this->ArrEmp[$lvvt][15]);
			$this->ArrEmp[$lvvt][18]=str_replace("<!--".$vrow['lv004']."-->",($lvstrgt18==NULL || trim($lvstrgt18)=='')?'&nbsp;':$lvstrgt18,$this->ArrEmp[$lvvt][18]);
			$this->ArrEmp[$lvvt][20]=str_replace("<!--".$vrow['lv004']."-->",($lvstrgt20==NULL || trim($lvstrgt20)=='')?'&nbsp;':$lvstrgt20,$this->ArrEmp[$lvvt][20]);
			$this->ArrEmp[$lvvt][21]=str_replace("<!--".$vrow['lv004']."-->",($lvstrgt21==NULL || trim($lvstrgt21)=='')?'&nbsp;':$lvstrgt21,$this->ArrEmp[$lvvt][21]);
			$this->ArrEmp[$lvvt][31]=str_replace("<!--".$vrow['lv004']."-->",($lvstrgt31==NULL || trim($lvstrgt31)=='')?'&nbsp;':$lvstrgt31,$this->ArrEmp[$lvvt][31]);
			$this->ArrEmp[$lvvt][69]=str_replace("<!--".$vrow['lv004']."-->",($lvstrgt69==NULL || trim($lvstrgt69)=='')?'&nbsp;':$lvstrgt69,$this->ArrEmp[$lvvt][69]);
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
			}
			$vPreShift[$vrow['NVID']][$vrow['DateNext']][0]=$vrow['lv015'];
			$vPreShift[$vrow['NVID']][$vrow['DateNext']][1]=$passday;
			}
		}
		//$strTrH=str_replace("@#01",$strH,$lvTrH);
		if($ShowOnce==1) return;
		if($vmau==4)
		{
			return $this->Get_BuildList_ArrayKP($sExport,$lvparatimecard);
			//return $this->Get_BuildList_ArrayKP($sExport,$lvparatimecard);
			//return $this->Get_BuildList_ArrayTDL($sExport,$lvparatimecard);
		}
		elseif($vmau==14)
		{
			return $this->Get_BuildList_ArrayTDL($sExport,$lvparatimecard);
			//return $this->Get_BuildList_ArrayTDL($sExport,$lvparatimecard);
		}
		elseif($vmau==24)
		{
			return $this->Get_BuildList_ArrayTDL_Duyet($sExport,$lvparatimecard);
			//return $this->Get_BuildList_ArrayTDL($sExport,$lvparatimecard);
		}
		elseif($vmau==5)
			return $this->Get_BuildList_ArrayTDLLimited($sExport,$lvparatimecard);
		else
			return $this->Get_BuildList_Array($sExport,$lvparatimecard);
	}
	function Get_BuildList_ArrayTDL_Duyet($sExport,$lvparatimecard)
	{

			if($this->isCongViec==1)
			{
				$vTable="
			<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr id='CC_Title' height=\"30px\">
				<td rowspan=\"2\" class=\"tdhprint\" width=\"1%\" align=\"center\"><b>STT</b></td>
				<!--<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Duyệt</b></td>
				
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Mã CC</b></td>-->
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Phòng ban</b></td>
				<!--<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[15]."</b></td>-->
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[16]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Chức vụ</b></td>
				".$this->lvHeader."
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Tổng ngày làm việc</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Tổng ngày báo cáo (Y)</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Tổng ngày ko báo cáo</b></td>
			</tr>
			<tr  id='CCC_Title' >
				".$this->lvHeader1."
				
			</tr>
			@01
		</table>
		";
			}
			else
			{
			$vTable="
			<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr id='CC_Title' height=\"30px\">
				<td rowspan=\"2\" class=\"tdhprint\" width=\"1%\" align=\"center\"><b>STT</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Duyệt</b></td>
				<!--
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Mã CC</b></td>-->
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Phòng ban</b></td>
				<!--<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[15]."</b></td>-->
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[16]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Chức vụ</b></td>
				".$this->lvHeader."
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">NC thực tế</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">KL</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">KP</td>	

				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">L</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">P</td>	

				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">PT</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">CT</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">KH</td>	
				<!--<td colspan=\"8\" class=\"tdhprint\" width=\"10%\" align=\"center\" title=\"\">Ngày nghỉ theo chế độ BH</td>	-->
				<td colspan=\"4\" class=\"tdhprint\" width=\"10%\" align=\"center\">Tăng ca</td>
				<td colspan=\"4\" class=\"tdhprint\" width=\"10%\" align=\"center\">Phép năm</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Phạt NC QCC</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Phạt KP</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><strong>NC tính lương</strong></td>

				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Số phút đi trễ
				về sớm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"> Số lần đi trễ
				về sớm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Phạt số lần đi trễ
				về sớm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Xin phép đi trễ
				về sớm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Số lần QCC</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Ghi chú</td>
			</tr>
			<tr  id='CCC_Title' >
				".$this->lvHeader1."
				<!--<td>VP</td>
				<td>CT</td>
				<td>CN</td>
				<td>L</td>
				<td>P</td>
				<td>B</td>
				<td align=\"center\" title=\"Nghỉ phép tang\">PT</td>
				<td align=\"center\" title=\"Nghỉ phép bệnh\">CT</td>
				<td align=\"center\" title=\"Nghỉ kết hôn\">KH</td>-->
							
				<!--
				<td align=\"center\" title=\"Nghỉ tai nạn lao động\">TN</td>
				<td align=\"center\" title=\"Nghỉ dưỡng sức\">DS</td>
				<td align=\"center\" title=\"Nghỉ con ốm\">CO</td>
				<td align=\"center\" title=\"Nghỉ thực hiện biện pháp tránh thai\">TT</td>
				<td align=\"center\" title=\"Nghỉ vợ sinh con\">VS</td>
				<td align=\"center\" title=\"Nghỉ khám thai\">KT</td>
				<td align=\"center\" title=\"Nghỉ hậu sản\">HS</td>
				<td align=\"center\" title=\"Nghỉ thai sản\">TS</td>-->
				
				<td align=\"center\">TC thường(150%)</td>	
				<td align=\"center\">TC CN(200%)</td>	
				<td align=\"center\">TC lễX(300%)</td>
				<td align=\"center\">Tổng TC</td>	
				<td>P đầu kỳ</td>
				<td>P/ Năm</td>
				<td>P/ Tháng</td>
				<td>P cuối kỳ</td>
			</tr>
			@01
		</table>
		";
			}
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
		$vTTT=0;
		for($i=1;$i<=count($this->ArrEmp);$i++)
		{
			$vTTT++;
			$vQCC_1=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:QCC'];
			$vQCC_2=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CN:QCC'];
			$tNCVP=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:X']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:NĐX']+$vQCC_1;
			$tNCCT=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:CT'];			
			$tNCCN=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CN:X']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CN:CT']+$vQCC_2;
			$tNCKH=0;//(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:KH'];
			$tNCS=$tNCVP+$tNCCT+$tNCKH+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:SS']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:NS'];
			$vOTTrua=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCATRUA']);
			$vOTTime=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['GIOTANGCA']);
			$vTANGCALE=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCALE']);
			$vOTDem=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCADEM']);
			if($vYear.$vMonth<'202212')
			{
				$vChoTinh=1;
				$vNumQCC=$this->ArrQCC[$this->ArrEmp[$i][0]];
				$vNumNDX=$this->ArrNDX[$this->ArrEmp[$i][0]];
			}
			else
			{
				$vChoTinh=0;
				$vQCC_1=0;
				$vQCC_2=0;
				$vNumQCC=$this->ArrDonxinQCC[$this->ArrEmp[$i][0]][0];
				$vNumNDX=$this->ArrDonxinNDX[$this->ArrEmp[$i][0]][0];
			}
			//Số phút đi trễ
			$vPhutDiTre=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['MinLateSoon'];
			//SỐ lần đi trễ
			$vSoLanDiTre=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['LateSoon']- $this->ArrTCEmp[$this->ArrEmp[$i][0]]['isLateSoonPhep']-$vNumNDX;
			if($vSoLanDiTre<0) $vSoLanDiTre=0;
			//Số tiền đi trễ
			$vSoTienDiTre=$this->LV_GetTienDiTreVeSom($vSoLanDiTre);
			//Số đơn xin đi trễ
			/*if($this->ArrDonxinDiTreVeSom[$this->ArrEmp[$i][0]][0]==null || $this->ArrDonxinDiTreVeSom[$this->ArrEmp[$i][0]][0]==0)
			{
				$vSoDonXinDiTre=0;
			}
			else
			{
				$vSoDonXinDiTre=$this->ArrDonxinDiTreVeSom[$this->ArrEmp[$i][0]][0];
			}*/
			$vSoDonXinDiTre=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['isLateSoonPhep'];
			if($this->isCongViec==1)
			{
				if($sExport=="excel")
				{
					$lvListTrAllTr='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">".$vTTT."</td>"."<!--<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][99]."</td>-->".'<td nowrap="nowrap"><Data ss:Type="String">="'.$this->ArrEmp[$i][2].'"</Data>'."</td><!--<td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$this->ArrEmp[$i][0]."\"</Data></td>-->";
					$lvListTrAllEmpty='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td><!--<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td>-->".'<td nowrap="nowrap"><Data ss:Type="String">&nbsp;</Data></td><td nowrap="nowrap"><Data ss:Type="String">&nbsp;</Data></td>'."<!--<td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$this->ArrEmp[$i][0]."\"</Data></td>-->";
				}
				else
				{
					if($this->ArrKhoaCong[$this->ArrEmp[$i][0]][1]==1)
					{
						$vText='<input value="Mở khóa" style="width:80px;background:blue;color:white;" type="button" onclick="UpdateMonthly(this,\''.$this->ArrEmp[$i][0].'\',\''.$this->year.'\',\''.$this->month.'\',0)" >';
					}
					else
					{
						$vText='<input  value="Khóa công" style="width:80px;background:red;color:white;" type="button" onclick="UpdateMonthly(this,\''.$this->ArrEmp[$i][0].'\',\''.$this->year.'\',\''.$this->month.'\',1)" >';
					}
					$lvListTrAllTr='
					<tr id="CC_Title_'.$vTTT.'"></tr>
					<tr id="CCC_Title_'.$vTTT.'"></tr>
					<tr onDblClick="Show_CC_Title('.$vTTT.')">'."
					<td nowrap='nowrap'><Data ss:Type=\"String\">".$vTTT."</td>
					<!--"."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][99]."</td>-->"."
					<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->LV_GetPhongBanCap1($this->ArrEmp[$i][2])."</Data>
					</td>
					
					<!--<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][0]."</Data></td>-->";
					$lvListTrAllEmpty='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td><td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td><!--<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td>".'--><td nowrap="nowrap"><Data ss:Type="String">&nbsp;</td><td nowrap="nowrap"><Data ss:Type="String">&nbsp;</Data>'."</td><!--<td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td>-->";
				}
			}
			else
			{
				if($sExport=="excel")
				{
					$lvListTrAllTr='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">".$vTTT."</td>"."<!--<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][99]."</td>-->".'<td nowrap="nowrap"><Data ss:Type="String">="'.$this->ArrEmp[$i][2].'"</Data>'."</td><!--<td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$this->ArrEmp[$i][0]."\"</Data></td>-->";
					$lvListTrAllEmpty='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td><!--<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td>-->".'<td nowrap="nowrap"><Data ss:Type="String">&nbsp;</Data></td><td nowrap="nowrap"><Data ss:Type="String">&nbsp;</Data></td>'."<!--<td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$this->ArrEmp[$i][0]."\"</Data></td>-->";
				}
				else
				{
					if($this->ArrKhoaCong[$this->ArrEmp[$i][0]][1]==1)
					{
						$vText='<input value="Mở khóa" style="width:80px;background:blue;color:white;" type="button" onclick="UpdateMonthly(this,\''.$this->ArrEmp[$i][0].'\',\''.$this->year.'\',\''.$this->month.'\',0)" >';
					}
					else
					{
						$vText='<input  value="Khóa công" style="width:80px;background:red;color:white;" type="button" onclick="UpdateMonthly(this,\''.$this->ArrEmp[$i][0].'\',\''.$this->year.'\',\''.$this->month.'\',1)" >';
					}
					$lvListTrAllTr='
					<tr id="CC_Title_'.$vTTT.'"></tr>
					<tr id="CCC_Title_'.$vTTT.'"></tr>
					<tr onDblClick="Show_CC_Title('.$vTTT.')">'."
					<td nowrap='nowrap'><Data ss:Type=\"String\">".$vTTT."</td>
					<td nowrap='nowrap'><Data ss:Type=\"String\">".$vText."</td>
					<!--"."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][99]."</td>-->"."
					<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->LV_GetPhongBanCap1($this->ArrEmp[$i][2])."</Data>
					</td>
					
					<!--<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][0]."</Data></td>-->";
					$lvListTrAllEmpty='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td><td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td><!--<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td>".'--><td nowrap="nowrap"><Data ss:Type="String">&nbsp;</td><td nowrap="nowrap"><Data ss:Type="String">&nbsp;</Data>'."</td><!--<td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td>-->";
				}
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
			$vSumWDay=$tNCS+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HL']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['KH']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['PT']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['B'];
			$vCLAdd=($vSumWDay>$vdaydiv)?($vSumWDay-$vdaydiv):0;
			$vEmpID=$this->ArrEmp[$i][0];
			/*if($vCLAdd!=0)
			{
				$lvsql = "Update tc_lv0009 set lv096='$vCLAdd'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv050=0 ";
				$vReturn= db_query($lvsql);
			}
			else
			{
				$lvsql = "Update tc_lv0009 set lv096='$vCLAdd'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv050=0 ";
				$vReturn= db_query($lvsql);
			}*/
			//$lvsql = "Update tc_lv0008 set lv100='".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F'])."'  WHERE lv002='$vEmpID' and lv005='$vYear'";
			//$vReturn= db_query($lvsql);
			
			$isNotP=0;
			if($vYear==getyear($this->ArrEmp[$i][44]) && $vMonth==getmonth($this->ArrEmp[$i][44]))
			{
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
			}
			else
			{
				if($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TS']>0)
				{
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
				}
			}
			$isNotP=0;
			/*
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
				*/
			if($isNotP==1)
			{
				$FNKTinh=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FNKTinh'];//-1;
				$vCLLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L']+$vTANGCADEM+$vCLAdd-$vSumTANGCATRUA;
				$vPLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5;
			}
			else
			{
				$FNKTinh=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FNKTinh'];
				$vCLLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L']+$vTANGCADEM+$vCLAdd-$vSumTANGCATRUA;
				$vPLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']+round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,0)-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5;
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
			if($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KL']>round($vdaydiv/2,0)) $isNotP=1;
			//print_r($lvparatimecard);
			$vTCColor=" style='color:red;font-style:italic;' ";
			$vSoNgayQCC=$vNumQCC+$vQCC_1+$vQCC_2;
			$vSoNCQCC=0;
			if($vSoNgayQCC>3)
			{
				if($this->ArrEmp[$i][27]=='VP')
					$vSoNCQCC=0.5*($vSoNgayQCC-3);
				else
					$vSoNCQCC=0.25*($vSoNgayQCC-3);
			}
			$vKPBiTru=0;
			if($vYear.$vMonth>'202304')
			{
				$vKPBiTru=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['KP']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KP']*0.5+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/4KP']*0.25;
			}
			if($this->isLuuCV==1)
			{
				$vSNLV=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['BCCV'];
				$vY=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['BCCVY'];
				$vN=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['BCCVN'];
				$vTitlle='(Y:'.$vY.' ngày, N:'.$vN.' ngày)';
				if($this->isCongViec==1)
				{
					$lvsql = "Update tc_lv0009 set lv201='$vSNLV',lv202='$vY',lv203='$vN'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv050=0 ";
					$vReturn= db_query($lvsql);
				}
			}
			foreach($lvparatimecard as $lvgt)
			{
				switch($lvgt)
				{
					case 4:
						$vcolor=" style='color:blue;' ";
						$lvListTrAll=$lvListTrAll.$lvListTrAllTr;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\"><strong>".$this->ArrEmp[$i][1]."</strong></td>
						<td nowrap='nowrap'><Data ss:Type=\"String\">".($this->ArrEmp[$i][67])."</Data>
						</td>
						".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][4])."
						<td align=center><strong>".round($tNCS,2)."</strong></td>
						<td align=center $vcolor>".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KL']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KL']*0.5)."</td>
						<td align=center $vcolor>".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KP']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KP']*0.5+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/4KP']*0.25)."</td>
						<!--<td align=center $vcolor><strong>".ROUNd($tNCVP,2)."</strong></td>
						<td align=center $vcolor><strong>".ROUNd($tNCCT,2)."</strong></td>
						<td align=center $vcolor>".round($tNCCN,2)."</td>-->
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']."</td>
						<td align=center $vcolor>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5,1)."</td>
						<!--<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['B']."</td>-->
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['PT']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CT']."</td>
						<td align=center $vcolor>".(($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KH']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KH']))."</td>
						<!--
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TN']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['DS']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CO']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TT']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['VS']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['KT']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HS']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TS']."</td>-->
						
						<td align=center $vcolor>".round($vOTTime+$vOTTrua,2)."</td>			
						<td align=center $vcolor>".round($vOTDem,2)."</td>
						<td align=center $vcolor>".round($vTANGCALE,1)."</td>
						<td align=center $vcolor>".round($vOTTime+$vOTTrua+$vOTDem+$vTANGCALE,2)."</td>
						<td align=center>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam'],2)."</td>
						<td align=center>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F'],2)."</td>
						<td align=center>".(($isNotP==1)?0:round(round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,0),1))."</td>
						<td align=center>".round($vPLast,2)."</td>
						<td align=center>".round($vSoNCQCC,2)."</td>
						<td align=center $vcolor>".$vKPBiTru."</td>
						<td align=center><strong>".round($vSumWDay-$vSoNCQCC-$vKPBiTru,2)."</strong></td>

						<td align=center>".round($vPhutDiTre,2)."</td>
						<td align=center>".round($vSoLanDiTre,2)."</td>
						<td align=center>".$this->FormatView(round($vSoTienDiTre,2),10)."</td>
						<td align=center>".round($vSoDonXinDiTre+$vNumNDX,2)."</td>
						<td align=center>".round($vNumQCC+$vQCC_1*$vChoTinh+$vQCC_2*$vChoTinh,2)."</td>
						<td align=center nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						</tr>";
						break;
						case 31:
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">Đi trễ về sớm</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][31])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							</tr>";
							break;
					case 5:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Giờ làm</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][5])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
		
						</tr>";
						break;
					case 6:
						if(strpos($this->ArrEmp[$i][90],','.$lvgt.',')>0)
						{
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap' $vTCColor><Data ss:Type=\"String\">Tăng ca thường(150%)</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][6])."
							<td align=center></td>
							<td align=center</td>
							<td align=center><!--".round($vOTTime+$vOTTrua,2)."--></td>			
							<td align=center></td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>

							</tr>";
						}
						break;
					case 7:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\"></td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][7])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=left></td>
						<td align=center</td>
						</tr>";
						break;
					case 9:
						if(strpos($this->ArrEmp[$i][90],','.$lvgt.',')>0)
						{
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap' $vTCColor><Data ss:Type=\"String\">Tăng ca CN(200%)</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][9])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center><!--".round($vOTDem,2)."--></td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							
						</tr>";
						}
						break;
					case 10:
						if(strpos($this->ArrEmp[$i][90],','.$lvgt.',')>0)
						{
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap' $vTCColor><Data ss:Type=\"String\">Tăng ca lễ(300%)</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][10])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center><!--".round($vTANGCALE,2)."--></td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center</td>
						<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
						</tr>";
						}
						break;
					case 15:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Ca làm</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][15])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
		
						</tr>";
						break;
					case 18:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Dư án</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][18])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=left></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
	
						</tr>";
						break;
					case 18:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">Dư án</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][18])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
						</tr>";
						break;
					case 20:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">Giờ vào ra</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][20])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
						</tr>";
						break;
					case 21:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Phản ánh hàng ngày</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][21])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
	
			
						</tr>";
						break;
					case 69:
						$vSNLV=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['BCCV'];
						$vY=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['BCCVY'];
						$vN=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['BCCVN'];
						$vTitlle='(Y:'.$vY.' ngày, N:'.$vN.' ngày)';
						if($this->isCongViec==1)
						{
							$lvListTrAll=$lvListTrAll.$lvListTrAllTr;
							$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\"><strong>".$this->ArrEmp[$i][1]."</strong></td>
						<td nowrap='nowrap'><Data ss:Type=\"String\">".($this->ArrEmp[$i][67])."</Data></td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][69])."
						<td align=center><strong>".$vSNLV."</strong></td>
						<td align=center $vcolor>".$vY."</td>
						<td align=center $vcolor>".$vN."</td>
						</tr>";
						}
						else
						{
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">BC công việc".$vTitlle."</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][69])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
	
			
						</tr>";
						}
						
						break;
					
				}

			}
			/*$lvsql = "Update tc_lv0009 set lv120='$vPLast',lv122='$vCLLast',lv130='$isNotP',lv131='".(round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,0))."'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv050=0 ";
			$vReturn= db_query($lvsql);
			if($vMonth<12)
			{
				$lvsql = "Update tc_lv0009 set lv121='$vPLast',lv123='$vCLLast'  WHERE lv002='$vEmpID' and lv003='".($vMonth+1)."' and lv004='$vYear' and lv050=0 ";
				$vReturn= db_query($lvsql);
			}
			else
			{
				$lvsql = "Update tc_lv0009 set lv121='0',lv123='0'  WHERE lv002='$vEmpID' and lv003='".(1)."' and lv004='".($vYear+1)."' and lv050=0 ";
				$vReturn= db_query($lvsql);
				if($vPLast>3)
				{
					$vPLastNam=3;
				}
				else
				{
					$vPLastNam=$vPLast;
				}
				$lvsql = "Update tc_lv0008 set lv008='$vPLastNam',lv100='0',lv101='0'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";//$lvsql = "Update tc_lv0008 set lv100='$vPLast',lv101='$vCLLast'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";
				$vReturn= db_query($lvsql);
			}*/
			//echo $this->ArrEmp[$i][0].":".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimePhepPrevious']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Prev']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAdd']."-".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeClear']."-".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeBUsed'].$vBr;
		}
		if((int)$_GET['ProjectID']==1)
		{
			$lvListTrAll=$lvListTrAll."<tr><td colspan=59><strong>TỔNG THỐNG KÊ THEO CÔNG TRÌNH<strong></td></tr>";
			foreach($this->ArrDEPTPROJECTLEV0 as $DeptID)
			{
				foreach($this->ArrDEPTPROJECTLEV1[$DeptID] as $Proj)
				{
					$lvListTrAll=$lvListTrAll."
					<tr>
					<td>&nbsp;</td><td nowrap='nowrap'><Data ss:Type=\"String\">".$DeptID."</Data></td><td>".$this->ArrDep[$DeptID][3]."</td><td>".$Proj[1]."</td><td>&nbsp;</td>
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
						 $vCDay=str_replace("/","-", $vCDay);
						//echo $this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['L'][$vCDay][0];
						$tLe=$tLe+($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['L'][$vCDay][0]);
						$tP=$tP+($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['P'][$vCDay][0]);
						$tO=$tO+($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['O'][$vCDay][0]);
						$vVP=($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['1'][$vCDay][0]);
						$tNCVP=$tNCVP+$vVP;
						$vCT=($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['CT'][$vCDay][0]);
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
					<td align=center><strong>".ROUNd($tNCVP,2)."</strong></td>
					<td align=center><strong>".ROUNd($tNCCT,2)."</strong></td>
					<td align=center>".round($tNCCN,2)."</td>
					<td align=center>".round($tLe,2)."</td>
					<td align=center>".round($tP,2)."</td>
					<td align=center>".round($tO,2)."</td>
					<td align=center colspan=\"18\">&nbsp;</td>
					</tr>";
				}
			}
		}
		return str_replace("@01",$lvListTrAll,$vTable);
	}
	function Get_BuildList_ArrayTDLLimited($sExport,$lvparatimecard)
	{
	
			$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr id='CC_Title' height=\"30px\">
				<td rowspan=\"2\" class=\"tdhprint\" width=\"1%\" align=\"center\"><b>STT</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Mã CC</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[14]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[15]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[16]."</b></td>".$this->lvHeader."
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Ngày làm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">VR</td>	
				<td colspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Hàng tháng</td>
				<td colspan=\"3\" class=\"tdhprint\" width=\"10%\" align=\"center\" title=\"\">Phép</td>
				<td colspan=\"8\" class=\"tdhprint\" width=\"10%\" align=\"center\" title=\"\">Ngày nghỉ theo chế độ BH</td>	
				<td colspan=\"4\" class=\"tdhprint\" width=\"10%\" align=\"center\">Tăng ca</td>
				<td colspan=\"4\" class=\"tdhprint\" width=\"10%\" align=\"center\">Phép năm</td>	
				
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Tổng ngày làm</td>
			</tr>
			<tr  id='CCC_Title' >
				".$this->lvHeader1."
				<!--<td>VP</td>
				<td>CT</td>
				<td>CN</td>-->
				<td>L</td>
				<td>P</td>
				<!--<td>B</td>-->
				<td align=\"center\" title=\"Nghỉ phép tang\">PT</td>
				<td align=\"center\" title=\"Nghỉ phép bệnh\">PB</td>
				<td align=\"center\" title=\"Nghỉ kết hôn\">KH</td>			
				<td align=\"center\" title=\"Nghỉ tai nạn lao động\">TN</td>
				<td align=\"center\" title=\"Nghỉ dưỡng sức\">DS</td>
				<td align=\"center\" title=\"Nghỉ con ốm\">CO</td>
				<td align=\"center\" title=\"Nghỉ thực hiện biện pháp tránh thai\">TT</td>
				<td align=\"center\" title=\"Nghỉ vợ sinh con\">VS</td>
				<td align=\"center\" title=\"Nghỉ khám thai\">KT</td>
				<td align=\"center\" title=\"Nghỉ hậu sản\">HS</td>
				<td align=\"center\" title=\"Nghỉ thai sản\">TS</td>
				<td align=\"center\">TC thường(150%)</td>	
				<td align=\"center\">TC CN(200%)</td>	
				<td align=\"center\">TC lễX(300%)</td>
				<td align=\"center\">Tổng TC</td>	
				<td>P đầu kỳ</td>
				<td>P/ Năm</td>
				<td>P/ Tháng</td>
				<td>P cuối kỳ</td>
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
		$vTTT=1;
		for($i=1;$i<=count($this->ArrEmp);$i++)
		{
			$tNCVP=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:X']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:NĐX'];
			$tNCCT=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:CT'];
			$tNCCN=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CN:X']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CN:CT'];
			$tNCKH=0;//(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:KH'];
			$tNCS=$tNCVP+$tNCCT+$tNCKH+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:SS']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:NS'];
			$vOTTrua=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCATRUA']);
			$vOTTime=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['GIOTANGCA']);
			$vTANGCALE=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCALE']);
			$vOTDem=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCADEM']);
			if($sExport=="excel")
			{
				$lvListTrAllTr='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">".$vTTT."</td>"."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][99]."</td>".'<td nowrap="nowrap"><Data ss:Type="String">="'.$this->ArrEmp[$i][2].'"</Data>'."</td><td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$this->ArrEmp[$i][0]."\"</Data></td>";
				$lvListTrAllEmpty='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td><td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td>".'<td nowrap="nowrap"><Data ss:Type="String">&nbsp;</Data>'."</td><td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$this->ArrEmp[$i][0]."\"</Data></td>";
			}
			else
			{
				$lvListTrAllTr='
				<tr id="CC_Title_'.$vTTT.'"></tr>
				<tr id="CCC_Title_'.$vTTT.'"></tr>
				<tr onDblClick="Show_CC_Title('.$vTTT.')">'."<td nowrap='nowrap'><Data ss:Type=\"String\">".$vTTT."</td>"."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][99]."</td>"."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][2]."</Data></td><td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][0]."</Data></td>";
				$lvListTrAllEmpty='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td><td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td>".'<td nowrap="nowrap"><Data ss:Type="String">&nbsp;</Data>'."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td>";
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
			$vSumWDay=$tNCS+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HL']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['KH']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['PT']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['B'];
			$vCLAdd=($vSumWDay>$vdaydiv)?($vSumWDay-$vdaydiv):0;
			$vEmpID=$this->ArrEmp[$i][0];
			if($vCLAdd!=0)
			{
				//$lvsql = "Update tc_lv0009 set lv096='$vCLAdd'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv050=0 ";
				//$vReturn= db_query($lvsql);
			}
			else
			{
				//$lvsql = "Update tc_lv0009 set lv096='$vCLAdd'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv050=0 ";
				//$vReturn= db_query($lvsql);
			}
			$isNotP=0;
			$isNotP=0;
			if($vYear==getyear($this->ArrEmp[$i][44]) && $vMonth==getmonth($this->ArrEmp[$i][44]))
			{
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
			}
			else
			{
				if($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TS']>0)
				{
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
				}
			}
			$isNotP=0;
			/*
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
				*/
			if($isNotP==1)
			{
				$FNKTinh=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FNKTinh'];//-1;
				$vCLLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L']+$vTANGCADEM+$vCLAdd-$vSumTANGCATRUA;
				$vPLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5;
			}
			else
			{
				$FNKTinh=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FNKTinh'];
				$vCLLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L']+$vTANGCADEM+$vCLAdd-$vSumTANGCATRUA;
				$vPLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']+round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,0)-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5;
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
			if($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KL']>round($vdaydiv/2,0)) $isNotP=1;
			$vTCColor=" style='color:red;font-style:italic;' ";
			if($tNCS>0 || $tNCVP>0 || $tNCCT>0 || $tNCCN>0  || ($this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5)>0 || ($vOTTime+$vOTTrua+$vOTDem+$vTANGCALE)>0)
			{
				$vTTT++;
				foreach($lvparatimecard as $lvgt)
				{
					switch($lvgt)
					{
						case 4:
							$vcolor=" style='color:blue;' ";
							$lvListTrAll=$lvListTrAll.$lvListTrAllTr;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][1]."</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][4])."
							<td align=center><strong>".round($tNCS,2)."</strong></td>
						<td align=center $vcolor>".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KL']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KL']*0.5)."</td>
						<!--<td align=center $vcolor><strong>".ROUNd($tNCVP,2)."</strong></td>
						<td align=center $vcolor><strong>".ROUNd($tNCCT,2)."</strong></td>
						<td align=center $vcolor>".round($tNCCN,2)."</td>-->
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']."</td>
						<td align=center $vcolor>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5,1)."</td>
						<!--<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['B']."</td>-->
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['PT']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['PB']."</td>
						<td align=center $vcolor>".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KH']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KH'])."</td>

						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TN']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['DS']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CO']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TT']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['VS']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['KT']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HS']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TS']."</td>
						<td align=center $vcolor>".round($vOTTime+$vOTTrua,2)."</td>			
						<td align=center $vcolor>".round($vOTDem,2)."</td>
						<td align=center $vcolor>".round($vTANGCALE,1)."</td>
						<td align=center $vcolor>".round($vOTTime+$vOTTrua+$vOTDem+$vTANGCALE,2)."</td>
						<td align=center>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam'],2)."</td>
						<td align=center>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F'],2)."</td>
						<td align=center>".(($isNotP==1)?0:round(round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,0),1))."</td>
						<td align=center>".round($vPLast,2)."</td>
						<td align=center>".round($vSumWDay,2)."</td>
							</tr>";
							break;
						case 5:
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">Giờ làm</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][5])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center></td>
							</tr>";
							break;
						case 6:
							if(strpos($this->ArrEmp[$i][90],','.$lvgt.',')>0)
							{
								$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
								$lvListTrAll=$lvListTrAll."
								<td nowrap='nowrap' $vTCColor><Data ss:Type=\"String\">Tăng ca thường(150%)</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][6])."
								<td align=center></td>
								<td align=center</td>
								<td align=center><!--".round($vOTTime+$vOTTrua,2)."--></td>		
								<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>	
								<td align=center></td>
								<td align=center></td>
								<td align=center> </td>
								<td align=center> </td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
								<td align=center> </td>
								<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center></td>
								</tr>";
							}
							break;
						case 7:
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\"></td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][7])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=left></td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>

							</tr>";
							break;
						case 9:
							if(strpos($this->ArrEmp[$i][90],','.$lvgt.',')>0)
							{
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap' $vTCColor><Data ss:Type=\"String\">Tăng ca CN(200%)</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][9])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center><!--".round($vOTDem,2)."--></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center></td>
							</tr>";
							}
							break;
						case 10:
							if(strpos($this->ArrEmp[$i][90],','.$lvgt.',')>0)
							{
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap' $vTCColor><Data ss:Type=\"String\">Tăng ca lễ(300%)</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][10])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center><!--".round($vTANGCALE,2)."--></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>

							</tr>";
							}
							break;
						case 15:
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">Ca làm</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][15])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>

							</tr>";
							break;
						case 18:
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">Dư án</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][18])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=left></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>

							</tr>";
							break;
						case 18:
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">Dư án</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][18])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>

							</tr>";
							break;
						case 20:
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">Giờ vào ra</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][20])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							</tr>";
							break;
						case 21:
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">Phản ánh hàng ngày</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][21])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							</tr>";
							break;
						case 31:
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">Đi trễ về sớm</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][31])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							</tr>";
							break;
					}

				}
			}
			/*$lvsql = "Update tc_lv0009 set lv120='$vPLast',lv122='$vCLLast',lv130='$isNotP',lv131='".(round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,0))."'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv050=0 ";
			$vReturn= db_query($lvsql);
			if($vMonth<12)
			{
				$lvsql = "Update tc_lv0009 set lv121='$vPLast',lv123='$vCLLast'  WHERE lv002='$vEmpID' and lv003='".($vMonth+1)."' and lv004='$vYear' and lv050=0 ";
				$vReturn= db_query($lvsql);
			}
			else
			{
				$lvsql = "Update tc_lv0009 set lv121='0',lv123='0'  WHERE lv002='$vEmpID' and lv003='".(1)."' and lv004='".($vYear+1)."' and lv050=0 ";
				$vReturn= db_query($lvsql);
				if($vPLast>3)
				{
					$vPLastNam=3;
				}
				else
				{
					$vPLastNam=$vPLast;
				}
				$lvsql = "Update tc_lv0008 set lv008='$vPLastNam',lv100='0',lv101='0'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";//$lvsql = "Update tc_lv0008 set lv100='$vPLast',lv101='$vCLLast'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";
				$vReturn= db_query($lvsql);
			}
			*/
			//echo $this->ArrEmp[$i][0].":".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimePhepPrevious']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Prev']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAdd']."-".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeClear']."-".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeBUsed'].$vBr;
		}
		if((int)$_GET['ProjectID']==1)
		{
			$lvListTrAll=$lvListTrAll."<tr><td colspan=59><strong>TỔNG THỐNG KÊ THEO CÔNG TRÌNH<strong></td></tr>";
			foreach($this->ArrDEPTPROJECTLEV0 as $DeptID)
			{
				foreach($this->ArrDEPTPROJECTLEV1[$DeptID] as $Proj)
				{
					$lvListTrAll=$lvListTrAll."
					<tr>
					<td>&nbsp;</td><td nowrap='nowrap'><Data ss:Type=\"String\">".$DeptID."</Data></td><td>".$this->ArrDep[$DeptID][3]."</td><td>".$Proj[1]."</td><td>&nbsp;</td>
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
						 $vCDay=str_replace("/","-", $vCDay);
						//echo $this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['L'][$vCDay][0];
						$tLe=$tLe+$this->gettime($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['L'][$vCDay][0]);
						$tP=$tP+$this->gettime($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['P'][$vCDay][0]);
						$tO=$tO+$this->gettime($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['O'][$vCDay][0]);
						$vVP=$this->gettime($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['1'][$vCDay][0]);
						$tNCVP=$tNCVP+$vVP;
						$vCT=$this->gettime($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['CT'][$vCDay][0]);
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
					<td align=center><strong>".ROUNd($tNCVP,2)."</strong></td>
					<td align=center><strong>".ROUNd($tNCCT,2)."</strong></td>
					<td align=center>".round($tNCCN,2)."</td>
					<td align=center>".round($tLe,2)."</td>
					<td align=center>".round($tP,2)."</td>
					<td align=center>".round($tO,2)."</td>
					<td align=center colspan=\"18\">&nbsp;</td>
					</tr>";
				}
			}
		}
		return str_replace("@01",$lvListTrAll,$vTable);
	}
	function LV_GetTienDiTreVeSom($vSoLan)
	{
		$vSoTien=0;
		switch($vSoLan)
		{
			case 0:
				$vSoTien=0;
				break;
			case 1:
				$vSoTien=0;
				break;
			case 2:
				$vSoTien=20000;
				break;
			case 3:
				$vSoTien=60000;
				break;
			case 4:
				$vSoTien=120000;
				break;
			case 5:
				$vSoTien=220000;
				break;
			case 6:
				$vSoTien=320000;
				break;
			case 7:
				$vSoTien=420000;
				break;
			case 8:
				$vSoTien=520000;
				break;
			case 9:
				$vSoTien=620000;
				break;
			case 10:
				$vSoTien=720000;
				break;
			case 11:
				$vSoTien=820000;
				break;
			case 12:
				$vSoTien=920000;
				break;
			case 13:
				$vSoTien=1020000;
				break;
			case 14:
				$vSoTien=1120000;
				break;
			default:
				$vSoTien=1120000+($vSoLan-14)*100000;
				break;
		}
		return $vSoTien;
	}
	function Get_BuildList_ArrayTDL($sExport,$lvparatimecard)
	{
	
			$vTable="
			<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr id='CC_Title' height=\"30px\">
				<td rowspan=\"2\" class=\"tdhprint\" width=\"1%\" align=\"center\"><b>STT</b></td>
				<!--
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Mã CC</b></td>-->
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Phòng ban</b></td>
				<!--<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[15]."</b></td>-->
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[16]."</b></td>".$this->lvHeader."
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">NC thực tế</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">KL</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">KP</td>	

				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">L</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">P</td>	

				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">PT</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">CT</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">KH</td>	
				<!--<td colspan=\"8\" class=\"tdhprint\" width=\"10%\" align=\"center\" title=\"\">Ngày nghỉ theo chế độ BH</td>	-->
				<td colspan=\"4\" class=\"tdhprint\" width=\"10%\" align=\"center\">Tăng ca</td>
				<td colspan=\"4\" class=\"tdhprint\" width=\"10%\" align=\"center\">Phép năm</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Phạt NC QCC</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Phạt KP</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><strong>NC tính lương</strong></td>

				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Số phút đi trễ
				về sớm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"> Số lần đi trễ
				về sớm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Phạt số lần đi trễ
				về sớm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Xin phép đi trễ
				về sớm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Số lần QCC</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Ghi chú</td>
			</tr>
			<tr  id='CCC_Title' >
				".$this->lvHeader1."
				<!--<td>VP</td>
				<td>CT</td>
				<td>CN</td>
				<td>L</td>
				<td>P</td>
				<td>B</td>
				<td align=\"center\" title=\"Nghỉ phép tang\">PT</td>
				<td align=\"center\" title=\"Nghỉ phép bệnh\">CT</td>
				<td align=\"center\" title=\"Nghỉ kết hôn\">KH</td>-->
							
				<!--
				<td align=\"center\" title=\"Nghỉ tai nạn lao động\">TN</td>
				<td align=\"center\" title=\"Nghỉ dưỡng sức\">DS</td>
				<td align=\"center\" title=\"Nghỉ con ốm\">CO</td>
				<td align=\"center\" title=\"Nghỉ thực hiện biện pháp tránh thai\">TT</td>
				<td align=\"center\" title=\"Nghỉ vợ sinh con\">VS</td>
				<td align=\"center\" title=\"Nghỉ khám thai\">KT</td>
				<td align=\"center\" title=\"Nghỉ hậu sản\">HS</td>
				<td align=\"center\" title=\"Nghỉ thai sản\">TS</td>-->
				
				<td align=\"center\">TC thường(150%)</td>	
				<td align=\"center\">TC CN(200%)</td>	
				<td align=\"center\">TC lễX(300%)</td>
				<td align=\"center\">Tổng TC</td>	
				<td>P đầu kỳ</td>
				<td>P/ Năm</td>
				<td>P/ Tháng</td>
				<td>P cuối kỳ</td>
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
		$vTTT=0;
		for($i=1;$i<=count($this->ArrEmp);$i++)
		{
			
			$vTTT++;
			$vQCC_1=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:QCC'];
			$vQCC_2=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CN:QCC'];
			$tNCVP=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:X']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:NĐX']+$vQCC_1;
			$tNCCT=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:CT'];
			$tNCCN=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CN:X']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CN:CT']+$vQCC_2;
			$tNCKH=0;//(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:KH'];
			$tNCS=$tNCVP+$tNCCT+$tNCKH+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:SS']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:NS'];
			$vOTTrua=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCATRUA']);
			$vOTTime=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['GIOTANGCA']);
			$vTANGCALE=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCALE']);
			$vOTDem=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCADEM']);
			if($vYear.$vMonth<'202212')
			{
				$vChoTinh=1;
				$vNumQCC=$this->ArrQCC[$this->ArrEmp[$i][0]];
				$vNumNDX=$this->ArrNDX[$this->ArrEmp[$i][0]];
			}
			else
			{
				$vChoTinh=0;
				$vQCC_1=0;
				$vQCC_2=0;
				$vNumQCC=$this->ArrDonxinQCC[$this->ArrEmp[$i][0]][0];
				$vNumNDX=$this->ArrDonxinNDX[$this->ArrEmp[$i][0]][0];
			}
			//Số phút đi trễ
			$vPhutDiTre=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['MinLateSoon'];
			//SỐ lần đi trễ
			$vSoLanDiTre=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['LateSoon']- $this->ArrTCEmp[$this->ArrEmp[$i][0]]['isLateSoonPhep']-$vNumNDX;
			if($vSoLanDiTre<0) $vSoLanDiTre=0;
			//Số tiền đi trễ
			$vSoTienDiTre=$this->LV_GetTienDiTreVeSom($vSoLanDiTre);
			//Số đơn xin đi trễ
			/*if($this->ArrDonxinDiTreVeSom[$this->ArrEmp[$i][0]][0]==null || $this->ArrDonxinDiTreVeSom[$this->ArrEmp[$i][0]][0]==0)
			{
				$vSoDonXinDiTre=0;
			}
			else
			{
				$vSoDonXinDiTre=$this->ArrDonxinDiTreVeSom[$this->ArrEmp[$i][0]][0];
			}*/
			$vSoDonXinDiTre=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['isLateSoonPhep'];
			if($sExport=="excel")
			{
				$lvListTrAllTr='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">".$vTTT."</td>"."<!--<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][99]."</td>-->".'<td nowrap="nowrap"><Data ss:Type="String">="'.$this->ArrEmp[$i][2].'"</Data>'."</td><!--<td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$this->ArrEmp[$i][0]."\"</Data></td>-->";
				$lvListTrAllEmpty='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td><!--<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td>".'--><td nowrap="nowrap"><Data ss:Type="String">&nbsp;</Data>'."</td><!--<td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$this->ArrEmp[$i][0]."\"</Data></td>-->";
			}
			else
			{
				$lvListTrAllTr='
				<tr id="CC_Title_'.$vTTT.'"></tr>
				<tr id="CCC_Title_'.$vTTT.'"></tr>
				<tr onDblClick="Show_CC_Title('.$vTTT.')">'."<td nowrap='nowrap'><Data ss:Type=\"String\">".$vTTT."</td><!--"."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][99]."</td>-->"."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->LV_GetPhongBanCap1($this->ArrEmp[$i][2])."</Data></td><!--<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][0]."</Data></td>-->";
				$lvListTrAllEmpty='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td><!--<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td>-->".'<td nowrap="nowrap"><Data ss:Type="String">&nbsp;</Data>'."</td><!--<td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td>-->";
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
			$vSumWDay=$tNCS+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HL']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['KH']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['PT']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['B'];
			$vCLAdd=($vSumWDay>$vdaydiv)?($vSumWDay-$vdaydiv):0;
			$vEmpID=$this->ArrEmp[$i][0];
			if($vCLAdd!=0)
			{
				$lvsql = "Update tc_lv0009 set lv096='$vCLAdd'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv050=0 ";
				$vReturn= db_query($lvsql);
			}
			else
			{
				$lvsql = "Update tc_lv0009 set lv096='$vCLAdd'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv050=0 ";
				$vReturn= db_query($lvsql);
			}
			//$lvsql = "Update tc_lv0008 set lv100='".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F'])."'  WHERE lv002='$vEmpID' and lv005='$vYear'";
			//$vReturn= db_query($lvsql);
			
			$isNotP=0;
			if($vYear==getyear($this->ArrEmp[$i][44]) && $vMonth==getmonth($this->ArrEmp[$i][44]))
			{
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
			}
			else
			{
				if($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TS']>0)
				{
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
				}
			}
			$isNotP=0;
			/*
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
				*/
			if($isNotP==1)
			{
				$FNKTinh=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FNKTinh'];//-1;
				$vCLLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L']+$vTANGCADEM+$vCLAdd-$vSumTANGCATRUA;
				$vPLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5;
			}
			else
			{
				$FNKTinh=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FNKTinh'];
				$vCLLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L']+$vTANGCADEM+$vCLAdd-$vSumTANGCATRUA;
				$vPLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']+round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,0)-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5;
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
			if($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KL']>round($vdaydiv/2,0)) $isNotP=1;
			//print_r($lvparatimecard);
			$vTCColor=" style='color:red;font-style:italic;' ";
			$vSoNgayQCC=$vNumQCC+$vQCC_1+$vQCC_2;
			$vSoNCQCC=0;
			if($vSoNgayQCC>3)
			{
				if($this->ArrEmp[$i][27]=='VP')
					$vSoNCQCC=0.5*($vSoNgayQCC-3);
				else
					$vSoNCQCC=0.25*($vSoNgayQCC-3);
			}
			$vKPBiTru=0;
			if($vYear.$vMonth>'202304')
			{
				$vKPBiTru=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['KP']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KP']*0.5+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/4KP']*0.25;
			}
			foreach($lvparatimecard as $lvgt)
			{
				switch($lvgt)
				{
					case 4:
						$vcolor=" style='color:blue;' ";
						$lvListTrAll=$lvListTrAll.$lvListTrAllTr;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\"><strong>".$this->ArrEmp[$i][1]."</strong></td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][4])."
						<td align=center><strong>".round($tNCS,2)."</strong></td>
						<td align=center $vcolor>".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KL']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KL']*0.5)."</td>
						<td align=center $vcolor>".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KP']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KP']*0.5+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/4KP']*0.25)."</td>
						<!--<td align=center $vcolor><strong>".ROUNd($tNCVP,2)."</strong></td>
						<td align=center $vcolor><strong>".ROUNd($tNCCT,2)."</strong></td>
						<td align=center $vcolor>".round($tNCCN,2)."</td>-->
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']."</td>
						<td align=center $vcolor>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5,1)."</td>
						<!--<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['B']."</td>-->
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['PT']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CT']."</td>
						<td align=center $vcolor>".(($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KH']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KH']))."</td>
						<!--
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TN']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['DS']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CO']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TT']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['VS']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['KT']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HS']."</td>
						<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TS']."</td>-->
						
						<td align=center $vcolor>".round($vOTTime+$vOTTrua,2)."</td>			
						<td align=center $vcolor>".round($vOTDem,2)."</td>
						<td align=center $vcolor>".round($vTANGCALE,1)."</td>
						<td align=center $vcolor>".round($vOTTime+$vOTTrua+$vOTDem+$vTANGCALE,2)."</td>
						<td align=center>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam'],2)."</td>
						<td align=center>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F'],2)."</td>
						<td align=center>".(($isNotP==1)?0:round(round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,0),1))."</td>
						<td align=center>".round($vPLast,2)."</td>
						<td align=center>".round($vSoNCQCC,2)."</td>
						<td align=center $vcolor>".$vKPBiTru."</td>
						<td align=center><strong>".round($vSumWDay-$vSoNCQCC-$vKPBiTru,2)."</strong></td>

						<td align=center>".round($vPhutDiTre,2)."</td>
						<td align=center>".round($vSoLanDiTre,2)."</td>
						<td align=center>".$this->FormatView(round($vSoTienDiTre,2),10)."</td>
						<td align=center>".round($vSoDonXinDiTre+$vNumNDX,2)."</td>
						<td align=center>".round($vNumQCC+$vQCC_1*$vChoTinh+$vQCC_2*$vChoTinh,2)."</td>
						<td align=center nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						</tr>";
						break;
						case 31:
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">Đi trễ về sớm</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][31])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							</tr>";
							break;
					case 5:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Giờ làm</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][5])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
		
						</tr>";
						break;
					case 6:
						if(strpos($this->ArrEmp[$i][90],','.$lvgt.',')>0)
						{
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap' $vTCColor><Data ss:Type=\"String\">Tăng ca thường(150%)</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][6])."
							<td align=center></td>
							<td align=center</td>
							<td align=center><!--".round($vOTTime+$vOTTrua,2)."--></td>			
							<td align=center></td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>

							</tr>";
						}
						break;
					case 7:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\"></td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][7])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=left></td>
						<td align=center</td>
						</tr>";
						break;
					case 9:
						if(strpos($this->ArrEmp[$i][90],','.$lvgt.',')>0)
						{
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap' $vTCColor><Data ss:Type=\"String\">Tăng ca CN(200%)</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][9])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center><!--".round($vOTDem,2)."--></td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							
						</tr>";
						}
						break;
					case 10:
						if(strpos($this->ArrEmp[$i][90],','.$lvgt.',')>0)
						{
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap' $vTCColor><Data ss:Type=\"String\">Tăng ca lễ(300%)</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][10])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center><!--".round($vTANGCALE,2)."--></td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center</td>
						<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
						</tr>";
						}
						break;
					case 15:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Ca làm</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][15])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
		
						</tr>";
						break;
					case 18:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Dư án</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][18])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=left></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
	
						</tr>";
						break;
					case 18:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">Dư án</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][18])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
						</tr>";
						break;
					case 20:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">Giờ vào ra</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][20])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
						</tr>";
						break;
					case 21:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Phản ánh hàng ngày</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][21])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
	
			
						</tr>";
						break;
					
				}

			}
			if($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']>12 && $vYear>2023)
			{
				if($this->ArrTCEmp[$vEmpID]['PhepCuaNam']<$this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F'])
				{
					$lvsql = "Update tc_lv0008 set lv200='".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F'])."'  WHERE lv002='$vEmpID' and lv005='".($vYear)."'";
					$vReturn= db_query($lvsql);
				}
			}			
			$lvsql = "Update tc_lv0009 set lv120='$vPLast',lv122='$vCLLast',lv130='$isNotP',lv131='".(round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,0))."'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv050=0 ";
			$vReturn= db_query($lvsql);
			if($vMonth<12)
			{
				if($vMonth==3)
				{
					if($this->ArrTCEmp[$vEmpID]['PhepNamTruocDu']>0)
					{
						$vPLast=$vPLast-$this->ArrTCEmp[$vEmpID]['PhepNamTruocDu'];
						if($vPLast<0) $vPLast=0;
						$lvsql = "Update tc_lv0009 set lv121='$vPLast'  WHERE lv002='$vEmpID' and lv003='".($vMonth+1)."' and lv004='$vYear' ";
						$vReturn= db_query($lvsql);
						//$lvsql = "Update tc_lv0009 set lv121='$vPLast',lv123='$vCLLast'  WHERE lv002='$vEmpID' and lv003='".($vMonth+1)."' and lv004='$vYear' and lv050=0 ";
						//$vReturn= db_query($lvsql);
					}
					else
					{
						$lvsql = "Update tc_lv0009 set lv121='$vPLast',lv123='$vCLLast'  WHERE lv002='$vEmpID' and lv003='".($vMonth+1)."' and lv004='$vYear' and lv050=0 ";
						$vReturn= db_query($lvsql);
					}
				}
				else
				{
					$lvsql = "Update tc_lv0009 set lv121='$vPLast',lv123='$vCLLast'  WHERE lv002='$vEmpID' and lv003='".($vMonth+1)."' and lv004='$vYear' and lv050=0 ";
					$vReturn= db_query($lvsql);
				}
				
				if($vYear==getyear($this->ArrEmp[$i][30]) && $vMonth==getmonth($this->ArrEmp[$i][30]))
				{
					$lvsql = "Update tc_lv0008 set lv200='".(12-$vMonth+1)."'  WHERE lv002='$vEmpID' and lv005='".($vYear)."'";//$lvsql = "Update tc_lv0008 set lv100='$vPLast',lv101='$vCLLast'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";
					$vReturn= db_query($lvsql);
					/*
					if(getday($this->ArrEmp[$i][30])<15)
					{
						$lvsql = "Update tc_lv0008 set lv200='".(12-$vMonth+1)."'  WHERE lv002='$vEmpID' and lv005='".($vYear)."'";//$lvsql = "Update tc_lv0008 set lv100='$vPLast',lv101='$vCLLast'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";
						$vReturn= db_query($lvsql);
					}
					else
					{
						$lvsql = "Update tc_lv0008 set lv200='".(12-$vMonth)."'  WHERE lv002='$vEmpID' and lv005='".($vYear)."'";//$lvsql = "Update tc_lv0008 set lv100='$vPLast',lv101='$vCLLast'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";
						$vReturn= db_query($lvsql);
					}*/
				}
			}
			else
			{
				$lvsql = "Update tc_lv0009 set lv121='0',lv123='0'  WHERE lv002='$vEmpID' and lv003='".(1)."' and lv004='".($vYear+1)."' and lv050=0 ";
				$vReturn= db_query($lvsql);
				if($vPLast>3)
				{
					$vPLastNam=3;
				}
				else
				{
					$vPLastNam=$vPLast;
				}
				if($vYear+1>2023)
				{
					$lvsql = "Update tc_lv0008 set lv008='$vPLastNam',lv100='0',lv101='0'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";//$lvsql = "Update tc_lv0008 set lv100='$vPLast',lv101='$vCLLast'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";
					$vReturn= db_query($lvsql);
				}
			/*	if($vEmpID=='MP067')
				{
					echo $lvsql.'<br/>';
				}*/
				if($vYear==getyear($this->ArrEmp[$i][30]) && $vMonth==getmonth($this->ArrEmp[$i][30]))
				{
					$lvsql = "Update tc_lv0008 set lv200='".(12-$vMonth+1)."'  WHERE lv002='$vEmpID' and lv005='".($vYear)."'";//$lvsql = "Update tc_lv0008 set lv100='$vPLast',lv101='$vCLLast'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";
						$vReturn= db_query($lvsql);
						/*
					if(getday($this->ArrEmp[$i][30])<15)
					{
						$lvsql = "Update tc_lv0008 set lv200='".(12-$vMonth+1)."'  WHERE lv002='$vEmpID' and lv005='".($vYear)."'";//$lvsql = "Update tc_lv0008 set lv100='$vPLast',lv101='$vCLLast'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";
						$vReturn= db_query($lvsql);
					}
					else
					{
						$lvsql = "Update tc_lv0008 set lv200='".(12-$vMonth)."'  WHERE lv002='$vEmpID' and lv005='".($vYear)."'";//$lvsql = "Update tc_lv0008 set lv100='$vPLast',lv101='$vCLLast'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";
						$vReturn= db_query($lvsql);
					}*/
				}
				else
				{
					if($vYear+1>2023)
					{
						$lvsql = "Update tc_lv0008 set lv200='".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F'])."'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";//$lvsql = "Update tc_lv0008 set lv100='$vPLast',lv101='$vCLLast'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";
						$vReturn= db_query($lvsql);
					}
				}
				/*if($vEmpID=='MP067')
				{
					echo $lvsql.'<br/>';
				}*/
			}
			//echo $this->ArrEmp[$i][0].":".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimePhepPrevious']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Prev']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAdd']."-".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeClear']."-".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeBUsed'].$vBr;
		}

		if((int)$_GET['ProjectID']==1)
		{
			$lvListTrAll=$lvListTrAll."<tr><td colspan=59><strong>TỔNG THỐNG KÊ THEO CÔNG TRÌNH<strong></td></tr>";
			foreach($this->ArrDEPTPROJECTLEV0 as $DeptID)
			{
				foreach($this->ArrDEPTPROJECTLEV1[$DeptID] as $Proj)
				{
					$lvListTrAll=$lvListTrAll."
					<tr>
					<td>&nbsp;</td><td nowrap='nowrap'><Data ss:Type=\"String\">".$DeptID."</Data></td><td>".$this->ArrDep[$DeptID][3]."</td><td>".$Proj[1]."</td><td>&nbsp;</td>
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
						 $vCDay=str_replace("/","-", $vCDay);
						//echo $this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['L'][$vCDay][0];
						$tLe=$tLe+($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['L'][$vCDay][0]);
						$tP=$tP+($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['P'][$vCDay][0]);
						$tO=$tO+($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['O'][$vCDay][0]);
						$vVP=($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['1'][$vCDay][0]);
						$tNCVP=$tNCVP+$vVP;
						$vCT=($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['CT'][$vCDay][0]);
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
					<td align=center><strong>".ROUNd($tNCVP,2)."</strong></td>
					<td align=center><strong>".ROUNd($tNCCT,2)."</strong></td>
					<td align=center>".round($tNCCN,2)."</td>
					<td align=center>".round($tLe,2)."</td>
					<td align=center>".round($tP,2)."</td>
					<td align=center>".round($tO,2)."</td>
					<td align=center colspan=\"18\">&nbsp;</td>
					</tr>";
				}
			}
		}
		return str_replace("@01",$lvListTrAll,$vTable);
	}
	function Get_BuildList_ArrayKP($sExport,$lvparatimecard)
	{
	
			$vTable="
			<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr id='CC_Title' height=\"30px\">
				<td rowspan=\"2\" class=\"tdhprint\" width=\"1%\" align=\"center\"><b>STT</b></td>
				<!--
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Mã CC</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[14]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[15]."</b></td>-->
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[16]."</b></td>".$this->lvHeader."
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">NC thực tế</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">KL</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">KP</td>	

				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">L</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">P</td>	

				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">PT</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">CT</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">KH</td>	
				<!--<td colspan=\"8\" class=\"tdhprint\" width=\"10%\" align=\"center\" title=\"\">Ngày nghỉ theo chế độ BH</td>	-->
				<!--<td colspan=\"4\" class=\"tdhprint\" width=\"10%\" align=\"center\">Tăng ca</td>-->
				<!--<td colspan=\"4\" class=\"tdhprint\" width=\"10%\" align=\"center\">Phép năm</td>	-->
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Phạt NC QCC</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Phạt KP</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><strong>NC tính lương</strong></td>

				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Số phút đi trễ
				về sớm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"> Số lần đi trễ
				về sớm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Phạt số lần đi trễ
				về sớm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Xin phép đi trễ
				về sớm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Số lần QCC</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Ghi chú</td>
			</tr>
			<tr  id='CCC_Title' >
				".$this->lvHeader1."
				<!--<td>VP</td>
				<td>CT</td>
				<td>CN</td>
				<td>L</td>
				<td>P</td>
				<td>B</td>
				<td align=\"center\" title=\"Nghỉ phép tang\">PT</td>
				<td align=\"center\" title=\"Nghỉ phép bệnh\">CT</td>
				<td align=\"center\" title=\"Nghỉ kết hôn\">KH</td>-->
							
				<!--
				<td align=\"center\" title=\"Nghỉ tai nạn lao động\">TN</td>
				<td align=\"center\" title=\"Nghỉ dưỡng sức\">DS</td>
				<td align=\"center\" title=\"Nghỉ con ốm\">CO</td>
				<td align=\"center\" title=\"Nghỉ thực hiện biện pháp tránh thai\">TT</td>
				<td align=\"center\" title=\"Nghỉ vợ sinh con\">VS</td>
				<td align=\"center\" title=\"Nghỉ khám thai\">KT</td>
				<td align=\"center\" title=\"Nghỉ hậu sản\">HS</td>
				<td align=\"center\" title=\"Nghỉ thai sản\">TS</td>-->
				<!--
				<td align=\"center\">TC thường(150%)</td>	
				<td align=\"center\">TC CN(200%)</td>	
				<td align=\"center\">TC lễX(300%)</td>
				<td align=\"center\">Tổng TC</td>	-->
				<!--<td>P đầu kỳ</td>
				<td>P/ Năm</td>
				<td>P/ Tháng</td>
				<td>P cuối kỳ</td>-->
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
		$vTTT=0;
		for($i=1;$i<=count($this->ArrEmp);$i++)
		{
			$vTTT++;
			$vQCC_1=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:QCC'];
			$vQCC_2=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CN:QCC'];
			$tNCVP=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:X']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:NĐX']+$vQCC_1;
			$tNCCT=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:CT'];
			$tNCCN=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CN:X']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CN:CT']+$vQCC_2;
			$tNCKH=0;//(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:KH'];
			$tNCS=$tNCVP+$tNCCT+$tNCKH+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:SS']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:NS'];
			$vOTTrua=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCATRUA']);
			$vOTTime=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['GIOTANGCA']);
			$vTANGCALE=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCALE']);
			$vOTDem=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCADEM']);
			if($vYear.$vMonth<'202212')
			{
				$vChoTinh=1;
				$vNumQCC=$this->ArrQCC[$this->ArrEmp[$i][0]];
				$vNumNDX=$this->ArrNDX[$this->ArrEmp[$i][0]];
			}
			else
			{
				$vChoTinh=0;
				$vQCC_1=0;
				$vQCC_2=0;
				$vNumQCC=$this->ArrDonxinQCC[$this->ArrEmp[$i][0]][0];
				$vNumNDX=$this->ArrDonxinNDX[$this->ArrEmp[$i][0]][0];
			}
			//Số phút đi trễ
			$vPhutDiTre=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['MinLateSoon'];
			//SỐ lần đi trễ
			$vSoLanDiTre=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['LateSoon']- $this->ArrTCEmp[$this->ArrEmp[$i][0]]['isLateSoonPhep']-$vNumNDX;
			if($vSoLanDiTre<0) $vSoLanDiTre=0;
			//Số tiền đi trễ
			$vSoTienDiTre=$this->LV_GetTienDiTreVeSom($vSoLanDiTre);
			//Số đơn xin đi trễ
			/*if($this->ArrDonxinDiTreVeSom[$this->ArrEmp[$i][0]][0]==null || $this->ArrDonxinDiTreVeSom[$this->ArrEmp[$i][0]][0]==0)
			{
				$vSoDonXinDiTre=0;
			}
			else
			{
				$vSoDonXinDiTre=$this->ArrDonxinDiTreVeSom[$this->ArrEmp[$i][0]][0];
			}*/
			$vSoDonXinDiTre=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['isLateSoonPhep'];
			if($sExport=="excel")
			{
				$lvListTrAllTr='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">".$vTTT."</td>"."<!--<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][99]."</td>".'<td nowrap="nowrap"><Data ss:Type="String">="'.$this->ArrEmp[$i][2].'"</Data>'."</td><td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$this->ArrEmp[$i][0]."\"</Data></td>-->";
				$lvListTrAllEmpty='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td><!--<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td>".'<td nowrap="nowrap"><Data ss:Type="String">&nbsp;</Data>'."</td><td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$this->ArrEmp[$i][0]."\"</Data></td>-->";
			}
			else
			{
				$lvListTrAllTr='
				<tr id="CC_Title_'.$vTTT.'"></tr>
				<tr id="CCC_Title_'.$vTTT.'"></tr>
				<tr onDblClick="Show_CC_Title('.$vTTT.')">'."<td nowrap='nowrap'><Data ss:Type=\"String\">".$vTTT."</td><!--"."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][99]."</td>"."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][2]."</Data></td><td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][0]."</Data></td>-->";
				$lvListTrAllEmpty='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td><!--<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td>".'<td nowrap="nowrap"><Data ss:Type="String">&nbsp;</Data>'."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td>-->";
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
			$vSumWDay=$tNCS+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HL']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['KH']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['PT']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['B'];
			$vCLAdd=($vSumWDay>$vdaydiv)?($vSumWDay-$vdaydiv):0;
			$vEmpID=$this->ArrEmp[$i][0];
			if($vCLAdd!=0)
			{
				//$lvsql = "Update tc_lv0009 set lv096='$vCLAdd'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv050=0 ";
				//$vReturn= db_query($lvsql);
			}
			else
			{
				//$lvsql = "Update tc_lv0009 set lv096='$vCLAdd'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv050=0 ";
				//$vReturn= db_query($lvsql);
			}
			//$lvsql = "Update tc_lv0008 set lv100='".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F'])."'  WHERE lv002='$vEmpID' and lv005='$vYear'";
			//$vReturn= db_query($lvsql);
			
			$isNotP=0;
			if($vYear==getyear($this->ArrEmp[$i][44]) && $vMonth==getmonth($this->ArrEmp[$i][44]))
			{
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
			}
			else
			{
				if($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TS']>0)
				{
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
				}
			}
			$isNotP=0;
			/*
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
				*/
			if($isNotP==1)
			{
				$FNKTinh=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FNKTinh'];//-1;
				$vCLLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L']+$vTANGCADEM+$vCLAdd-$vSumTANGCATRUA;
				$vPLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5;
			}
			else
			{
				$FNKTinh=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FNKTinh'];
				$vCLLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L']+$vTANGCADEM+$vCLAdd-$vSumTANGCATRUA;
				$vPLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']+round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,0)-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5;
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
			if($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KL']>round($vdaydiv/2,0)) $isNotP=1;
			//print_r($lvparatimecard);
			$vTCColor=" style='color:red;font-style:italic;' ";
			$vSoNgayQCC=$vNumQCC+$vQCC_1+$vQCC_2;
			$vSoNCQCC=0;
			if($vSoNgayQCC>3)
			{
				if($this->ArrEmp[$i][27]=='VP')
					$vSoNCQCC=0.5*($vSoNgayQCC-3);
				else
					$vSoNCQCC=0.25*($vSoNgayQCC-3);
			}
			$vKPBiTru=0;
			if($vYear.$vMonth>'202304')
			{
				$vKPBiTru=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['KP']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KP']*0.5+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/4KP']*0.25;
			}
			foreach($lvparatimecard as $lvgt)
			{
				switch($lvgt)
				{
					case 4:
						$vcolor=" style='color:blue;' ";
						$lvListTrAll=$lvListTrAll.$lvListTrAllTr;
						$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\"><strong>".$this->ArrEmp[$i][1]."</strong></td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][4])."
							<td align=center><strong>".round($tNCS,2)."</strong></td>
							<td align=center $vcolor>".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KL']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KL']*0.5)."</td>
							<td align=center $vcolor>".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KP']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KP']*0.5+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/4KP']*0.25)."</td>
							<!--<td align=center $vcolor><strong>".ROUNd($tNCVP,2)."</strong></td>
							<td align=center $vcolor><strong>".ROUNd($tNCCT,2)."</strong></td>
							<td align=center $vcolor>".round($tNCCN,2)."</td>-->
							<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']."</td>
							<td align=center $vcolor>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5,1)."</td>
							<!--<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['B']."</td>-->
							<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['PT']."</td>
							<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CT']."</td>
							<td align=center $vcolor>".(($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KH']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KH']))."</td>
							<!--
							<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TN']."</td>
							<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['DS']."</td>
							<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CO']."</td>
							<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TT']."</td>
							<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['VS']."</td>
							<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['KT']."</td>
							<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HS']."</td>
							<td align=center $vcolor>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TS']."</td>-->
							<!--
							<td align=center $vcolor>".round($vOTTime+$vOTTrua,2)."</td>			
							<td align=center $vcolor>".round($vOTDem,2)."</td>
							<td align=center $vcolor>".round($vTANGCALE,1)."</td>
							<td align=center $vcolor>".round($vOTTime+$vOTTrua+$vOTDem+$vTANGCALE,2)."</td>-->
							<!--<td align=center>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam'],2)."</td>
							<td align=center>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F'],2)."</td>
							<td align=center>".(($isNotP==1)?0:round(round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,0),1))."</td>
							<td align=center>".round($vPLast,2)."</td>-->
							<td align=center>".round($vSoNCQCC,2)."</td>
							<td align=center $vcolor>".$vKPBiTru."</td>
						<td align=center><strong>".round($vSumWDay-$vSoNCQCC-$vKPBiTru,2)."</strong></td>

							<td align=center>".round($vPhutDiTre,2)."</td>
							<td align=center>".round($vSoLanDiTre,2)."</td>
							<td align=center>".$this->FormatView(round($vSoTienDiTre,2),10)."</td>
							<td align=center>".round($vSoDonXinDiTre+$vNumNDX,2)."</td>
							<td align=center>".round($vNumQCC+$vQCC_1*$vChoTinh+$vQCC_2*$vChoTinh,2)."</td>
							<td align=center nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							</tr>";
							break;
						case 31:
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">Đi trễ về sớm</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][31])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
		
							</tr>";
							break;
					case 5:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">Giờ làm</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][5])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center> </td>			
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
						</tr>";
						break;
					case 6:
						if(strpos($this->ArrEmp[$i][90],','.$lvgt.',')>0)
						{
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
								<td nowrap='nowrap' $vTCColor><Data ss:Type=\"String\">Tăng ca thường(150%)</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][6])."
								<td align=center></td>
								<td align=center</td>
								<td align=center><!--".round($vOTTime+$vOTTrua,2)."--></td>			
								<td align=center></td>
								<td align=center></td>
								<td align=center> </td>
								<td align=center> </td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
								<td align=center></td>
							</tr>";
						}
						break;
					case 7:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\"></td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][7])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=left></td>
						<td align=center</td>
						</tr>";
						break;
					case 9:
						if(strpos($this->ArrEmp[$i][90],','.$lvgt.',')>0)
						{
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap' $vTCColor><Data ss:Type=\"String\">Tăng ca CN(200%)</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][9])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center><!--".round($vOTDem,2)."--></td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						</tr>";
						}
						break;
					case 10:
						if(strpos($this->ArrEmp[$i][90],','.$lvgt.',')>0)
						{
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap' $vTCColor><Data ss:Type=\"String\">Tăng ca lễ(300%)</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][10])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center><!--".round($vTANGCALE,2)."--></td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>						
						</tr>";
						}
						break;
					case 15:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Ca làm</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][15])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center</td>
						</tr>";
						break;
					case 18:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Dư án</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][18])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=left></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
	
						</tr>";
						break;
					case 18:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Dư án</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][18])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center</td>
						</tr>";
						break;
					case 20:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Giờ vào ra</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][20])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>

						</tr>";
						break;
					case 21:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Phản ánh hàng ngày</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][21])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
			
						</tr>";
						break;
					
				}

			}
			/*$lvsql = "Update tc_lv0009 set lv120='$vPLast',lv122='$vCLLast',lv130='$isNotP',lv131='".(round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,0))."'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv050=0 ";
			$vReturn= db_query($lvsql);
			if($vMonth<12)
			{
				$lvsql = "Update tc_lv0009 set lv121='$vPLast',lv123='$vCLLast'  WHERE lv002='$vEmpID' and lv003='".($vMonth+1)."' and lv004='$vYear' and lv050=0 ";
				$vReturn= db_query($lvsql);
			}
			else
			{
				$lvsql = "Update tc_lv0009 set lv121='0',lv123='0'  WHERE lv002='$vEmpID' and lv003='".(1)."' and lv004='".($vYear+1)."' and lv050=0 ";
				$vReturn= db_query($lvsql);
				if($vPLast>3)
				{
					$vPLastNam=3;
				}
				else
				{
					$vPLastNam=$vPLast;
				}
				$lvsql = "Update tc_lv0008 set lv008='$vPLastNam',lv100='0',lv101='0'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";//$lvsql = "Update tc_lv0008 set lv100='$vPLast',lv101='$vCLLast'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";
				$vReturn= db_query($lvsql);
			}*/
			//echo $this->ArrEmp[$i][0].":".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimePhepPrevious']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Prev']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAdd']."-".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeClear']."-".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeBUsed'].$vBr;
		}
		if((int)$_GET['ProjectID']==1)
		{
			$lvListTrAll=$lvListTrAll."<tr><td colspan=59><strong>TỔNG THỐNG KÊ THEO CÔNG TRÌNH<strong></td></tr>";
			foreach($this->ArrDEPTPROJECTLEV0 as $DeptID)
			{
				foreach($this->ArrDEPTPROJECTLEV1[$DeptID] as $Proj)
				{
					$lvListTrAll=$lvListTrAll."
					<tr>
					<td>&nbsp;</td><td nowrap='nowrap'><Data ss:Type=\"String\">".$DeptID."</Data></td><td>".$this->ArrDep[$DeptID][3]."</td><td>".$Proj[1]."</td><td>&nbsp;</td>
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
						 $vCDay=str_replace("/","-", $vCDay);
						//echo $this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['L'][$vCDay][0];
						$tLe=$tLe+($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['L'][$vCDay][0]);
						$tP=$tP+($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['P'][$vCDay][0]);
						$tO=$tO+($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['O'][$vCDay][0]);
						$vVP=($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['1'][$vCDay][0]);
						$tNCVP=$tNCVP+$vVP;
						$vCT=($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['CT'][$vCDay][0]);
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
					<td align=center><strong>".ROUNd($tNCVP,2)."</strong></td>
					<td align=center><strong>".ROUNd($tNCCT,2)."</strong></td>
					<td align=center>".round($tNCCN,2)."</td>
					<td align=center>".round($tLe,2)."</td>
					<td align=center>".round($tP,2)."</td>
					<td align=center>".round($tO,2)."</td>
					<td align=center colspan=\"18\">&nbsp;</td>
					</tr>";
				}
			}
		}
		return str_replace("@01",$lvListTrAll,$vTable);
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
		$sqlS = "SELECT A.lv002,A.lv003, ADDDATE('$this->datefrom',-1) DtFrom,ADDDATE('$this->dateto',1) DtTo,ADDDATE(A.lv004,1) DateNext,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,A.lv015,A.lv016,A.lv019,A.lv020,B.lv002 NVID,C.lv030 DateWork,C.lv029 lv001,D.lv007 Shift,IF(ISNULL(A.lv016),'00:00:00',A.lv016) TANGCATRUA,A.lv017 TANGCADEM,A.lv018 TANGCALE,D.lv003 FN_Nam,D.lv008 TimePhepPrevious,D.lv101 TimeAddPrevious,D.lv102 PYear,D.lv008 FN_Prev,(select sum(BB.lv096) from tc_lv0009 BB where BB.lv002=C.lv001 and BB.lv004=year(A.lv004) and BB.lv003<>month(A.lv004)) TimeAdd,D.lv098 TimeClear,D.lv099 TimeBUsed,C.lv102 Num_FN_F,(((year('$this->datefrom')-year(C.lv030))*12+month('$this->datefrom')-month(C.lv030))/12) Num_FN_FM,(((year('$this->datefrom')-year(C.lv030))*12+month('$this->datefrom')-month(C.lv030))) Num_FN_FM_Month,E.lv095 CL_L,E.lv096 CL_TimeSum,F.lv006 IsFNMonth,E.lv120 LastP,E.lv121 FirstP,E.lv122 LastCL,E.lv123 FirstCL FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 left join hr_lv0020 C on C.lv001=B.lv002 left join tc_lv0008 D on D.lv002=B.lv002  and D.lv005=year(A.lv004) left join tc_lv0009 E on E.lv002=B.lv002 and E.lv004=year(A.lv004) and E.lv003=month(A.lv004)  left join hr_lv0002 F on C.lv029=F.lv001  WHERE  A.lv100<>1  ".$this->GetConditionOrther()."  order by C.lv029 ASC,A.lv004 ASC";
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
			$vMaCong1_2='X';
			if($vTimeWorks!=0)
			{
				if($vrow['lv007']=='1/2P'  || $vrow['lv007']=='1/2KL' || $vrow['lv007']=='1/2KP' || $vrow['lv007']=='1/2KH'  || $vrow['lv007']=='1/2PB')
				{
					if($vrow['lv005']!='04:00:00') $this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]+($this->GetTime($vrow['lv005'])-4)/$vTimeWorks;
					if($vrow['lv007']=='1/2KL' || $vrow['lv007']=='1/2KP' || $vrow['lv007']=='1/2KH'  || $vrow['lv007']=='1/2PB') 
					{
						$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vMaCong1_2]=$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vMaCong1_2]+$this->GetTime($vrow['lv005'])/$vTimeWorks;
					}
				}
				else
					$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']]['TI:'.$vrow['lv007']]+$this->GetTime($vrow['lv005'])/$vTimeWorks;
			}
				
				switch($vrow['lv007'])
				{
					case 'TN':
						if(str_replace(":","",$vrow['lv005'])>=40000) $this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]+1;
						break;
					default:
						$this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]=$this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]+1;
						break;
				}
			
			}
			$vListShiftReceive=$this->ArrDep[$vrow['lv001']][0];
			$arrTime=null;
			$arrShift=$this->GetTimeListArr($vrow['NVID'],$vrow['lv004'],$vrow['lv015'],$vrow['Shift'],$passday,$vListShiftReceive,$vPreShift[$vrow['NVID']][$vrow['lv004']],$arrTime,$lvopt);
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
							$lvstrgt=$lvstrgt.(($an)?'OH:':'').'<b>'.$this->GetTime($vrow['lv006'])."</b><br/>";
						break;
					case 4:
						if($this->lvState==0)
						{
							if($vshowgiokem==1)
							{
								if($vrow['lv005']!=$vTimeWork && $vrow['lv005']!="00:00:00")
								{
									if($vrow['lv007']=='KL' || $vrow['lv007']=="KL"  || $vrow['lv007']=="SL"  || $vrow['lv007']=="1/2P" || $vrow['lv007']=='1/2KL' || $vrow['lv007']=='1/2KP' || $vrow['lv007']=='1/2KH' || $vrow['lv007']=='1/2KL'  || $vrow['lv007']=='1/2PB' || $vrow['lv007']=="P")
											$lvstrgt=$lvstrgt.$vrow['lv007']."";
									else
									$lvstrgt=$lvstrgt.(round($this->GetTime($vrow['lv005']),1))."";
								}
								else
								{
									if(($vrow['lv007']=='8' || $vrow['lv007']=='NS' || $vrow['lv007']=='TN' ) )
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
										elseif(($vrow['lv007']=='1/2CL'))
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
											if($vrow['lv005']!="00:00:00" || $vrow['lv007']=='TS' || $vrow['lv007']=='KL' || $vrow['lv007']=="SL" || $vrow['lv007']=="DS" || $vrow['lv007']=="HL" || $vrow['lv007']=="C" || $vrow['lv007']=="HS" || $vrow['lv007']=="KP" || $vrow['lv007']=="KT" || $vrow['lv007']=="PB" || $vrow['lv007']=="PC" || $vrow['lv007']=="PT" || $vrow['lv007']=="TS" || $vrow['lv007']=="TT" || $vrow['lv007']=="VS"  || $vrow['lv007']=="1/2P" || $vrow['lv007']=="P"   || $vrow['lv007']=="KL" )
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
									$lvstrgt=$lvstrgt.(($an)?'Code:':'').'<b>'.(round($this->GetTime($vrow['lv005'])/$vTimeWorks,2)).$vrow['lv007']."</b>";
								else
								{
									if($vrow['lv007']=='8' || $vrow['lv007']=='NS' || $vrow['lv007']=='TN')
									{
										if($vrow['lv005']!="00:00:00")
											$lvstrgt=$lvstrgt.(($an)?'Code:':'').'<b>'.$this->GetTime($vrow['lv005'])."</b>";
										else
											$lvstrgt=$lvstrgt.(($an)?'Code:':'')."<b>&nbsp;</b>";
									}
										
									else
									{
										if($vrow['lv005']!="00:00:00"  || $vrow['lv007']=='KL' || $vrow['lv007']=="SL")
											$lvstrgt=$lvstrgt.(($an)?'Code:':'').'<b>'.$vrow['lv007']."</b>";
										else
											$lvstrgt=$lvstrgt.(($an)?'Code:':'')."<b>&nbsp;</b>";
									}
										
								}
							}
							else
							{
								if($vrow['lv007']=='8' || $vrow['lv007']=='NS' || $vrow['lv007']=='TN')
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
									$lvstrgt=$lvstrgt.'<br/>'.'<b>'.(round($this->GetTime($vrow['lv005'])/$vTimeWorks,2)).$vrow['lv015']."</b><br/>";
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
									$lvstrgt=$lvstrgt.'<br/>'.(($an)?'Shift:':'').'<b>'.(round($this->GetTime($vrow['lv005'])/$vTimeWorks,2)).$vrow['lv015']."</b><br/>";
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
							$lvstrgt=$lvstrgt.$this->GetTimeListMore($arrTime,$vCount,$vrow['NVID'],$vrow['lv004']).$vBr;
						}
						else 
						{
							$lvstrgt=$lvstrgt.(($an)?'In-Out:':'').'<b>'.$this->GetTimeListMore($arrTime,$vCount,$vrow['NVID'],$vrow['lv004'])."</b><br/>";
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
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">TN</td>
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
				<td>B</td>
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
			$tNCS=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:X']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:CT']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:SS']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:NS']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:1/2P']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:1/2CL'];
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
			$vSumWDay=$tNCS+$vSumTANGCATRUA+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HL']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['B'];
			$vCLAdd=($vSumWDay>$vdaydiv)?($vSumWDay-$vdaydiv):0;
			$vMonth=getmonth($this->datefrom);
			$vYear=getyear($this->datefrom);
			$vEmpID=$this->ArrEmp[$i][0];
			$vCLLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']-$vSumTANGCATRUA;
			$vPLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5;
			$lvListTrAll=$lvListTrAll."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][1]."</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][4])."<td align=right><strong>".ROUnd($tNCS,2)."</strong></td><td>".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['DO']+$this->ArrTCEmp[$this->ArrEmp[$i][0]][''])."</td>
			<td>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']."</td>
			<td>".round($vSumTANGCATRUA,2)."</td>
			<td>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5,1)."</td>
			<td>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam'],2)."</td>
			<td>".round($vPLast,2)."</td>
			<td>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious'],10)."</td>
			<td>".round($vCLLast,2)."</td>
			<td>".round($vCLLast+$vPLast,1)."</td>			
			<td align=right>".$vOTTime."</td>
			<td align=right>".round($this->GetTime($vTANGCALE),1)."</td>
			<td align=right>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TN']."</td>
			<td align=right>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HL']."</td>
			<td align=right>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['SL']."</td>
			<td align=right>".($this->arRTCemp[$this->arRemp[$i][0]]['KL']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KL']*0.5)."</td>
			</tr>";			
			}
		return str_replace("@01",$lvListTrAll,$vTable);
	}
	function Get_BuildList_Array($sExport,$lvparatimecard)
	{
		if($this->lvSort==1)
		$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\"  id='CC_Title'>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"1%\" align=\"center\"><b>STT</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Mã CC</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[15]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[16]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[14]."</b></td>
				".$this->lvHeader."
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">W.Day</td>
			</tr>
			<tr  id='CCC_Title'>
				".$this->lvHeader1."
			</tr>
			@01
		</table>
		";
		else
			$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\"  id='CC_Title'>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"1%\" align=\"center\"><b>STT</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Mã CC</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[14]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[15]."</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[16]."</b></td>".$this->lvHeader."
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Ngày làm</td>
				<td colspan=\"6\" class=\"tdhprint\" width=\"10%\" align=\"center\">Hàng tháng</td>
				<td colspan=\"4\" class=\"tdhprint\" width=\"10%\" align=\"center\">Phép năm(P)</td>
				<td colspan=\"5\" class=\"tdhprint\" width=\"10%\" align=\"center\">Tăng ca</td>	
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">KH</td>			
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">TN</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">HL</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">SL</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">VR</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Tổng ngày làm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\">Ngày trả</td>
				<td colspan=\"3\" class=\"tdhprint\" width=\"10%\" align=\"center\">Cảnh báo</td>
			</tr>
			<tr  id='CCC_Title'>
				".$this->lvHeader1."
				<td>VP</td>
				<td>CT</td>
				<td>CN</td>
				<td>L</td>
				<td>P</td>
				<td>B</td>
				<!--<td>DO</td>-->
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
		$vTTT=0;
		for($i=1;$i<=count($this->ArrEmp);$i++)
		{
			$vTTT++;
			$tNCVP=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:X']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:NĐX'];
			$tNCCT=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:CT'];
			$tNCCN=(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CN:X']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CN:CT'];
			$tNCKH=0;//(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:KH'];
			$tNCS=$tNCVP+$tNCCT+$tNCKH+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:SS']+(float)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TI:NS'];
			$vOTTrua=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCATRUA']);
			$vOTTime=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['GIOTANGCA']);
			$vTANGCALE=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCALE']);
			$vOTDem=$this->GetTime($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TANGCADEM']);
			if($sExport=="excel")
			{
				$lvListTrAllTr='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">".$vTTT."</td>"."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][99]."</td>".'<td nowrap="nowrap"><Data ss:Type="String">="'.$this->ArrEmp[$i][2].'"</Data>'."</td><td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$this->ArrEmp[$i][0]."\"</Data></td>";
				$lvListTrAllEmpty='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td><td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td>".'<td nowrap="nowrap"><Data ss:Type="String">&nbsp;</Data>'."</td><td nowrap='nowrap'><Data ss:Type=\"String\">=\"".$this->ArrEmp[$i][0]."\"</Data></td>";
			}
			else
			{
				$lvListTrAllTr='<tr id="CC_Title_'.$vTTT.'"></tr>
				<tr id="CCC_Title_'.$vTTT.'"></tr>
				<tr onDblClick="Show_CC_Title('.$vTTT.')">'."<td nowrap='nowrap'><Data ss:Type=\"String\">".$vTTT."</td>"."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][99]."</td>"."<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][2]."</Data></td><td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][0]."</Data></td>";
				$lvListTrAllEmpty='<tr>'."<td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td><td nowrap='nowrap'><Data ss:Type=\"String\">&nbsp;</td>".'<td nowrap="nowrap"><Data ss:Type="String">&nbsp;</Data>'."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td>";
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
			$vSumWDay=$tNCS+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HL']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['KH']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['PT']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['B'];
			$vCLAdd=($vSumWDay>$vdaydiv)?($vSumWDay-$vdaydiv):0;
			$vEmpID=$this->ArrEmp[$i][0];
			if($vCLAdd!=0)
			{
				//$lvsql = "Update tc_lv0009 set lv096='$vCLAdd'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv050=0 ";
				//$vReturn= db_query($lvsql);
			}
			else
			{
				//$lvsql = "Update tc_lv0009 set lv096='$vCLAdd'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv050=0 ";
				//$vReturn= db_query($lvsql);
			}
			$isNotP=0;
			if($vYear==getyear($this->ArrEmp[$i][44]) && $vMonth==getmonth($this->ArrEmp[$i][44]))
			{
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
			}
			else
			{
				if($this->ArrTCEmp[$this->ArrEmp[$i][0]]['TS']>0)
				{
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
				}
			}
			$isNotP=0;
			/*
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
				*/
			if($isNotP==1)
			{
				$FNKTinh=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FNKTinh'];//-1;
				$vCLLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L']+$vTANGCADEM+$vCLAdd-$vSumTANGCATRUA;
				$vPLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5;
			}
			else
			{
				$FNKTinh=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FNKTinh'];
				$vCLLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['CL_L']+$vTANGCADEM+$vCLAdd-$vSumTANGCATRUA;
				$vPLast=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']+round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,0)-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']-$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5;
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
			if($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KL']>round($vdaydiv/2,0)) $isNotP=1;
			//print_r($lvparatimecard);
			$vKPBiTru=0;
			if($vYear.$vMonth>'202304')
			{
				$vKPBiTru=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['KP']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KP']*0.5+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/4KP']*0.25;
			}
			foreach($lvparatimecard as $lvgt)
			{
				switch($lvgt)
				{
					case 4:
						$lvListTrAll=$lvListTrAll.$lvListTrAllTr;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">".$this->ArrEmp[$i][1]."</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][4])."
						<td align=center><strong>".ROUnd($tNCS,2)."</strong></td>
						<td align=center><strong>".ROUNd($tNCVP,2)."</strong></td>
						<td align=center><strong>".ROUNd($tNCCT,2)."</strong></td>
						<td align=center>".round($tNCCN,2)."</td>
						<td align=center>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['L']."</td>
						<td align=center>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['P']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2P']*0.5,1)."</td>
						<td align=center>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['B']."</td>
						<!--<td align=center>".round(($vSumWDay>count($this->vArrDay))?0:count($this->vArrDay)-$vSumWDay,2)."</td>-->
						<td align=center>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam'],2)."</td>
						<td align=center>".round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F'],2)."</td>
						<td align=center>".(($isNotP==1)?0:round(round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,0),1))."</td>
						<td align=center>".round($vPLast,2)."</td>
						<td align=center>".round($vOTTime,2)."</td>			
						<td align=center>".round($vOTTrua,2)."</td>
						<td align=center>".round($vOTDem,2)."</td>
						<td align=center>".round($vTANGCALE,1)."</td>
						<td align=center>".round($vOTTime+$vOTTrua+$vOTDem+$vTANGCALE,2)."</td>
						<td align=center>".($this->ArrTCEmp[$this->ArrEmp[$i][0]]['KH']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KH'])."</td>
						<td align=center>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TN']."</td>
						<td align=center>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['HL']."</td>
						<td align=center>".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['SL']."</td>
						<td align=center>".($this->arRTCemp[$this->arRemp[$i][0]]['KL']+$this->ArrTCEmp[$this->ArrEmp[$i][0]]['1/2KL']*0.5)."</td>
						<td align=center>".round($vSumWDay,2)."</td>
						<td align=center>".round(($vSumWDay>$vdaydiv)?$vdaydiv:$vSumWDay,2)."</td>
						<td align=center>".round($vdaydiv,2)."</td>
						<td align=center>".round($vDayCan,2)."/".round($vDayNeed,2)."</td>
						<td align=left>".$vMessageC."</td>
						</tr>";
						break;
					case 5:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Giờ làm</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][5])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=left></td>
						<td align=left></td>

						</tr>";
						break;
					case 6:
						if(strpos($this->ArrEmp[$i][90],','.$lvgt.',')>0)
						{
							$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
							$lvListTrAll=$lvListTrAll."
							<td nowrap='nowrap'><Data ss:Type=\"String\">Tăng ca thường(150%)</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][6])."
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center</td>
							<td align=center>".round($vOTTime,2)."</td>			
							<td align=center></td>
							<td align=center></td>
							<td align=center> </td>
							<td align=center> </td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=center></td>
							<td align=left></td>
							<td align=left></td>
							</tr>";
						}
						break;
					case 7:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\"></td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][7])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=left></td>
						<td align=left></td>
						</tr>";
						break;
					case 8:
						if(strpos($this->ArrEmp[$i][90],','.$lvgt.',')>0)
						{
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Tăng ca trưa(150%)</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][8])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center>".round($vOTTrua,2)."</td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=left></td>
						<td align=left></td>
						</tr>";
						}
						break;
					case 9:
						if(strpos($this->ArrEmp[$i][90],','.$lvgt.',')>0)
						{
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Tăng ca CN(200%)</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][9])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center>".round($vOTDem,2)."</td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=left></td>
						<td align=left></td>
						</tr>";
						}
						break;
					case 10:
						if(strpos($this->ArrEmp[$i][90],','.$lvgt.',')>0)
						{
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Tăng ca lễ(300%)</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][10])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center>".round($vTANGCALE,2)."</td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=left></td>
						<td align=left></td>
						</tr>";
						}
						break;
					case 15:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Ca làm</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][15])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=left></td>
						<td align=left></td>
						</tr>";
						break;
					case 18:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Dư án</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][18])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=left></td>
						<td align=left></td>
						</tr>";
						break;
					case 20:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Giờ vào ra</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][20])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=left></td>
						<td align=left></td>
						</tr>";
						break;
					case 21:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Phản ánh hàng ngày</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][21])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=left></td>
						<td align=left></td>
						</tr>";
						break;
					case 31:
						$lvListTrAll=$lvListTrAll.$lvListTrAllEmpty;
						$lvListTrAll=$lvListTrAll."
						<td nowrap='nowrap'><Data ss:Type=\"String\">Đi trễ về sớm</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][31])."
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center</td>
						<td align=center> </td>			
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center> </td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=center></td>
						<td align=left></td>
						<td align=left></td>
						</tr>";
						break;
				}

			}
			/*$lvsql = "Update tc_lv0009 set lv120='$vPLast',lv122='$vCLLast',lv130='$isNotP',lv131='".(round($this->ArrTCEmp[$this->ArrEmp[$i][0]]['Num_FN_F']/12,0))."'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear' and lv050=0 ";
			$vReturn= db_query($lvsql);
			if($vMonth<12)
			{
				$lvsql = "Update tc_lv0009 set lv121='$vPLast',lv123='$vCLLast'  WHERE lv002='$vEmpID' and lv003='".($vMonth+1)."' and lv004='$vYear' and lv050=0 ";
				$vReturn= db_query($lvsql);
			}
			else
			{
				$lvsql = "Update tc_lv0009 set lv121='0',lv123='0'  WHERE lv002='$vEmpID' and lv003='".(1)."' and lv004='".($vYear+1)."' and lv050=0 ";
				$vReturn= db_query($lvsql);
				if($vPLast>3)
				{
					$vPLastNam=3;
				}
				else
				{
					$vPLastNam=$vPLast;
				}
				$lvsql = "Update tc_lv0008 set lv008='$vPLastNam',lv100='0',lv101='0'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";//$lvsql = "Update tc_lv0008 set lv100='$vPLast',lv101='$vCLLast'  WHERE lv002='$vEmpID' and lv005='".($vYear+1)."'";
				$vReturn= db_query($lvsql);
			}*/
			//echo $this->ArrEmp[$i][0].":".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Nam']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimePhepPrevious']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAddPrevious']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['FN_Prev']."+".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeAdd']."-".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeClear']."-".$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeBUsed'].$vBr;
		}
		if((int)$_GET['ProjectID']==1)
		{
			$lvListTrAll=$lvListTrAll."<tr><td colspan=59><strong>TỔNG THỐNG KÊ THEO CÔNG TRÌNH<strong></td></tr>";
			foreach($this->ArrDEPTPROJECTLEV0 as $DeptID)
			{
				foreach($this->ArrDEPTPROJECTLEV1[$DeptID] as $Proj)
				{
					$lvListTrAll=$lvListTrAll."
					<tr>
					<td>&nbsp;</td><td nowrap='nowrap'><Data ss:Type=\"String\">".$DeptID."</Data></td><td>".$this->ArrDep[$DeptID][3]."</td><td>".$Proj[1]."</td><td>&nbsp;</td>
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
						 $vCDay=str_replace("/","-", $vCDay);
						//echo $this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['L'][$vCDay][0];
						$tLe=$tLe+($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['L'][$vCDay][0])/8;
						$tP=$tP+($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['P'][$vCDay][0])/8;
						$tO=$tO+($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['O'][$vCDay][0])/8;
						$vVP=($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['1'][$vCDay][0])/8;
						$tNCVP=$tNCVP+$vVP;
						$vCT=($this->ArrDEPTPROJECT[$DeptID][$Proj[1]]['CT'][$vCDay][0])/8;
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
					<td align=center><strong>".ROUNd($tNCVP,2)."</strong></td>
					<td align=center><strong>".ROUNd($tNCCT,2)."</strong></td>
					<td align=center>".round($tNCCN,2)."</td>
					<td align=center>".round($tLe,2)."</td>
					<td align=center>".round($tP,2)."</td>
					<td align=center>".round($tO,2)."</td>
					<td align=center colspan=\"18\">&nbsp;</td>
					</tr>";
				}
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
	function GetTimeListArr($vlv001,$vlv002,$shiftDay,$shiftYear,&$passday,$vListShiftReceive,$vPreShift,&$arrTime,$lvopt='0')
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
		if($lvopt==0)
		{
			$strReturn=array();
			$lvsql="select lv003,lv005 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002'  and lv006<>1 order by lv003 ASC";
			$vresult=db_query($lvsql);
			$count=db_num_rows($vresult);
			if($vresult){
				$i=0;
				$j=0;
				$vbo=0;
				while($vrow=db_fetch_array($vresult))
				{
					if($this->LV_GetSecond($vTimeSave,$vrow['lv003'])>600 || $i==0)
					{
						$this->ArrTimeCheckUser[$vlv001][$vlv002][$vrow['lv003']]=$vrow['lv005'];
						$arrTime[$i]=$vrow['lv003'];
						$strReturn[$i]=(int)str_replace(":","",$vrow['lv003']);
						$i++;	
						$j++;
						$vTimeSave=$vrow['lv003'];
					}
				}
			}
			
		}
		else
		{
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
						if($this->LV_GetSecond($vTimeSave,$vrow['lv003'])>600 || $i==1)
						{
							$this->ArrTimeCheckUser[$vlv001][$vlv002][$vrow['lv003']]=$vrow['lv005'];
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
									elseif($this->LV_GetSecond($arrTime[0],$vrow['lv003'])>600 )
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
									elseif($this->LV_GetSecond($arrTime[$j-$vbo-1],$vrow['lv003'])>600 )
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
									elseif($this->LV_GetSecond($arrTime[0],$vrow['lv003'])>600 )
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
						$this->ArrTimeCheckUser[$vlv001][$vlv002][$vrow['lv003']]=$vrow['lv005'];
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
						$this->ArrTimeCheckUser[$vlv001][$vlv002][$vrow['lv003']]=$vrow['lv005'];
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
						$this->ArrTimeCheckUser[$vlv001][$vlv002][$vrow['lv003']]=$vrow['lv005'];
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
						$this->ArrTimeCheckUser[$vlv001][$vlv002][$vrow['lv003']]=$vrow['lv005'];
						$strReturn[1]=(int)str_replace(":","",$vrow['lv003']);
						$arrTime[1]=$vrow['lv003'];
					}
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
	function LV_GetStaffName($vStaffID)
	{
		if( $this->ArrStaffName[$vStaffID][0]) return  $this->ArrStaffName[$vStaffID][1];
		$this->ArrStaffName[$vStaffID][0]=true;

		return $this->ArrStaffName[$vStaffID][1]=$this->getvaluelink('lv009',$vStaffID);
	}
	function LV_CodeShowS7($vCode,$vlv001='',$vlv002='',$vTenNV='',$vTime1='',$vTenNguoiSua='',$vTime='')
	{
		$lvcheck=($this->ArrDonxinDiTreVeSoOK[$vlv001][$vlv002])?1:0;
		if($vTime=='X' && $lvcheck==0)
			$vTyle='color:#000';
		else
			$vTyle='color:red;text-decoration:underline;';
		$vStrCode='
				<div style="cursor:pointer;color:blue;" onclick="showDetailHD(\'chitietid_'.$vCode.'\',\''.$vCode.'\',\''.$vlv001.'\',\''.$vlv002.'\')"><span  style="'.$vTyle.'" title="'.$vTenNguoiSua.'">'.$vTime.'</span></div>
					<div style="display:none;position:absolute;z-index:999999999999;background:#efefef;width:800px;" id="chitietid_'.$vCode.'" class="noidung_member">
					
					<div class="hd_cafe" style="width:100%">
						<ul class="qlycafe" style="width:100%">
						<li style="padding:10px;"><img onclick="document.getElementById(\'chitietid_'.$vCode.'\').style.display=\'none\';" width="20" src="../images/icon/close.png"/></li>
						<li style="padding:10px;">
							<div style="width:100%;padding-top:2px;">
								<div>
									<div style="float:left;"><strong>'.$vTenNV.' ['.$this->FormatView($vlv002,2).' '.$vTime.']</strong></div>'.'
								</div>
							</div>
						</li>
						</ul>
					</div>
					<div id="chitietnoidung_'.$vCode.'" style="min-width:360px;overflow:hidden;overflow: scroll;">
					Load nội dung phép lên cho ngày này
					</div>
					<div width="100%;height:40px;">
						<center>
							<div style="width:160px;border-radius:5px;cursor:pointer;height:30px;padding-top:10px;" onclick="document.getElementById(\'chitietid_'.$vCode.'\').style.display=\'none\';">ĐÓNG LẠI</div>
						</center>
					</div>
				</div>	
				';	
		return $vStrCode;
	}
	function LV_CodeShow($vCode,$vlv001='',$vlv002='',$vTenNV='',$vTime='',$vTenNguoiSua='')
	{
		$vStrCode='
				<div style="cursor:pointer;color:blue;" onclick="showDetailHD(\'chitietid_'.$vCode.'\',\''.$vCode.'\',\''.$vlv001.'\',\''.$vlv002.'\')"><span  style="color:red;text-decoration:underline;" title="'.$vTenNguoiSua.'">'.substr($vTime,0,5).'</span></div>
					<div style="display:none;position:absolute;z-index:999999999999;background:#efefef;width:800px;" id="chitietid_'.$vCode.'" class="noidung_member">
					
					<div class="hd_cafe" style="width:100%">
						<ul class="qlycafe" style="width:100%">
						<li style="padding:10px;"><img onclick="document.getElementById(\'chitietid_'.$vCode.'\').style.display=\'none\';" width="20" src="../images/icon/close.png"/></li>
						<li style="padding:10px;">
							<div style="width:100%;padding-top:2px;">
								<div>
									<div style="float:left;"><strong>'.$vTenNV.' ['.$this->FormatView($vlv002,2).' '.$vTime.']</strong></div>'.'
								</div>
							</div>
						</li>
						</ul>
					</div>
					<div id="chitietnoidung_'.$vCode.'" style="min-width:360px;overflow:hidden;overflow: scroll;">
					Load nội dung phép lên cho ngày này
					</div>
					<div width="100%;height:40px;">
						<center>
							<div style="width:160px;border-radius:5px;cursor:pointer;height:30px;padding-top:10px;" onclick="document.getElementById(\'chitietid_'.$vCode.'\').style.display=\'none\';">ĐÓNG LẠI</div>
						</center>
					</div>
				</div>	
				';	
		return $vStrCode;
	}
////GetTime list
	function GetTimeListMore($vArrTime,&$vCount=0,$vlv001='',$vlv002='')
	{
		$vCount=0;
		if($vArrTime==null) return;
		foreach($vArrTime as $vTime)
		{
			$vCount++;
			if($_GET['childfunc']!='excel' && $this->ArrTimeCheckUser[$vlv001][$vlv002][$vTime]!=null && trim($this->ArrTimeCheckUser[$vlv001][$vlv002][$vTime])!='')
			{
				$vTenNguoiSua=$this->LV_GetStaffName($this->ArrTimeCheckUser[$vlv001][$vlv002][$vTime]);
				$vTenNV=$this->LV_GetStaffName($vlv001);
				$vCode=str_replace(":",'',"$vlv001$vlv002$vTime");
				$vStrCode=$this->LV_CodeShow($vCode,$vlv001,$vlv002,$vTenNV,$vTime,$vTenNguoiSua);
				//$vStrCode='';
				if($strReturn=="")
					$strReturn=$strReturn.'<td>'.$vStrCode.'</td>';
				else
					$strReturn=$strReturn."<td>|</td>".'<td>'.$vStrCode.'</td>';	
				//echo 'VINH ne'.$this->ArrTimeCheckUser[$vlv001][$vlv002][$vTime].'<br/>';
			}
			else
			{
				if($strReturn=="")
					$strReturn=$strReturn.'<td>'.substr($vTime,0,5).'</td>';	
				else
					$strReturn=$strReturn."<td>|</td>".'<td>'.substr($vTime,0,5).'</td>';	
				//$strReturn=$strReturn1;	
			}
		}
		$strReturn="<table border=0><tr>".$strReturn."</tr></table>";
		return $strReturn;
	}
	function GetTimeMinute($vTime)
	{
	
			$vArrH=explode(":",$vTime);
			$vHours=(float)$vArrH[0] ;
			$vMinutes=(float)$vArrH[1];
			$vSecond=(float)$vArrH[2];
			$vMinutes=(int)($vSecond/60)+$vMinutes;
			$vHours=(int)($vHours*60)+((int)($vMinutes));	
			return $vHours;
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
		if($this->lv030!="")  $strCondi=$strCondi." AND DD.lv001 in ('".str_replace(",","','",$this->lv030)."')";
		if($this->lvSort==0)
		{
			if($ShowDept==1)
				$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv067 ChucVuVietTat,AA.lv004 Dep,DD.lv099 MaCC,DD.lv027 NhomCC,DD.lv030 DateW,DD.lv044 DateOff from hr_lv0020 DD inner join tc_lv0064 AA on AA.lv003=DD.lv001 and AA.lv002='".$this->motc_lv0013->lv001."' left join hr_lv0002 E on AA.lv004=E.lv001  where 1=1  and DD.lv030<='$this->dateto' $strCondi  order by E.lv103,DD.lv008,AA.lv004,DD.lv099";
			else
				$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv067 ChucVuVietTat,DD.lv029 Dep,DD.lv099 MaCC,DD.lv027 NhomCC,DD.lv030 DateW,DD.lv044 DateOff from hr_lv0020 DD  left join hr_lv0002 E on DD.lv029=E.lv001 where 1=1  and DD.lv030<='$this->dateto' $strCondi  order by E.lv103,DD.lv008,DD.lv029";
		}
		elseif($this->lvSort==1) 
		{
			if($ShowDept==1)
				$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv067 ChucVuVietTat,AA.lv004 Dep,DD.lv099 MaCC,DD.lv027 NhomCC,DD.lv030 DateW,DD.lv044 DateOff from hr_lv0020 DD inner join tc_lv0064 AA on AA.lv003=DD.lv001 and AA.lv002='".$this->motc_lv0013->lv001." left join hr_lv0002 E on AA.lv004=E.lv001  where 1=1  and DD.lv030<='$this->dateto' $strCondi  order by E.lv103,DD.lv008,AA.lv004";
			else
				$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv067 ChucVuVietTat,DD.lv029 Dep,DD.lv099 MaCC,DD.lv027 NhomCC,DD.lv030 DateW,DD.lv044 DateOff from hr_lv0020 DD  left join hr_lv0002 E on DD.lv029=E.lv001 where 1=1  and DD.lv030<='$this->dateto' $strCondi  order by E.lv103,DD.lv008,DD.lv001";
		}
		elseif($this->lvSort==2) 
		{
			if($ShowDept==1)
				$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv067 ChucVuVietTat,AA.lv004 Dep,DD.lv099 MaCC,DD.lv027 NhomCC,DD.lv030 DateW,DD.lv044 DateOff from hr_lv0020 DD inner join tc_lv0064 AA on AA.lv003=DD.lv001 and AA.lv002='".$this->motc_lv0013->lv001." left join hr_lv0002 E on AA.lv004=E.lv001  where 1=1  and DD.lv030<='$this->dateto' $strCondi  order by E.lv103,DD.lv008,DD.lv062,DD.lv099 asc";
			else
				$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv067 ChucVuVietTat,DD.lv029 Dep,DD.lv099 MaCC,DD.lv027 NhomCC,DD.lv030 DateW,DD.lv044 DateOff from hr_lv0020 DD  left join hr_lv0002 E on DD.lv029=E.lv001 where 1=1  and DD.lv030<='$this->dateto' $strCondi  order by E.lv103,DD.lv008,DD.lv062,DD.lv099 asc";
		}
		elseif($this->lvSort==3) 
		{
			if($ShowDept==1)
				$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv067 ChucVuVietTat,AA.lv004 Dep,DD.lv099 MaCC,DD.lv027 NhomCC,DD.lv030 DateW,DD.lv044 DateOff from hr_lv0020 DD inner join tc_lv0064 AA on AA.lv003=DD.lv001 and AA.lv002='".$this->motc_lv0013->lv001." left join hr_lv0002 E on AA.lv004=E.lv001  where 1=1  and DD.lv030<='$this->dateto' $strCondi  order by E.lv103,DD.lv008,DD.lv099 asc,DD.lv062 asc";
			else
				 $lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv067 ChucVuVietTat,DD.lv029 Dep,DD.lv099 MaCC,DD.lv027 NhomCC,DD.lv030 DateW,DD.lv044 DateOff from hr_lv0020 DD  left join hr_lv0002 E on DD.lv029=E.lv001 where 1=1  and DD.lv030<='$this->dateto' $strCondi  order by E.lv103,DD.lv008,DD.lv099 asc,DD.lv062 asc";
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
			$this->ArrEmp[$i][5]=$strTd;
			$this->ArrEmp[$i][6]=$strTd;
			$this->ArrEmp[$i][7]=$strTd;
			$this->ArrEmp[$i][8]=$strTd;
			$this->ArrEmp[$i][9]=$strTd;
			$this->ArrEmp[$i][10]=$strTd;
			$this->ArrEmp[$i][15]=$strTd;
			$this->ArrEmp[$i][18]=$strTd;
			$this->ArrEmp[$i][20]=$strTd;
			$this->ArrEmp[$i][21]=$strTd;
			$this->ArrEmp[$i][31]=$strTd;
			$this->ArrEmp[$i][69]=$strTd;
			$this->ArrEmp[$i][30]=$vrow['DateW'];
			$this->ArrEmp[$i][44]=$vrow['DateOff'];
			$this->ArrEmp[$i][27]=$vrow['NhomCC'];
			$this->ArrEmp[$i][67]=$vrow['ChucVuVietTat'];
			
			$this->ArrEmp[$i][90]="CHECK:";
			$this->ArrEmp[$i][99]=$vrow['MaCC'];
			$this->ArrEmpBack[$vrow['CodeID']]=$i;
			$i++;
		}
	}
	function Get_String_DateFromToFull()
	{
		$vNoWork=false;
		$vDaysArr=array('1'=>'CN','2'=>'T2','3'=>'T3','4'=>'T4','5'=>'T5','6'=>'T6','7'=>'T7');
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
		$vDaysArr=array('1'=>'CN','2'=>'T2','3'=>'T3','4'=>'T4','5'=>'T5','6'=>'T6','7'=>'T7');
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
		if($this->lv029!="")  $strCondi=$strCondi." and A.lv029 in (".$this->LV_GetDep($this->lv029).")";
		if($this->lv029_!="")  $strCondi=$strCondi." and A.lv029 in (".$this->LV_GetDep($this->lv029_).")";
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
		if($this->lv030!="")  $strCondi=$strCondi." and A.lv002 in (".$this->GetMultiValue("select CC.lv001 from tc_lv0010 CC where CC.lv002 in ('".str_replace(",","','",$this->lv030)."')").")";
		return $strCondi;
	}
	function LV_GetPhongBanCap1($vPBID)
	{
		if($this->ArrPBVT[$vPBID][0]) return $this->ArrPBVT[$vPBID][1];
		$this->OrderRun=0;
		$vsql="select lv002,lv004 from  hr_lv0002 where lv001='$vPBID'";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			if(trim($vrow['lv004'])=='')
				 $this->ArrPBVT[$vPBID][1]=$this->LV_GetPhongBanCap1Parent($vrow['lv002']);
			else
				$this->ArrPBVT[$vPBID][1]=$vrow['lv004'];
			break;
		}
		$this->ArrPBVT[$vPBID][0]=true;
		return $this->ArrPBVT[$vPBID][1];
	}
	
	function LV_GetPhongBanCap1Parent($vPBID)
	{
		$this->OrderRun++;
		if($this->OrderRun>10) return '';
		if($vPBID=='SOF') return '';
		$vsql="select lv002,lv004 from  hr_lv0002 where lv001='$vPBID'";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			if(trim($vrow['lv004'])=='')
				return $this->LV_GetPhongBanCap1Parent($vrow['lv002']);
			else
				return $vrow['lv004'];
		}
	}
	function LV_GetDep($vDepID)
	{
		if($vDepID=="") return '';
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		if($this->isChildCheck.""=="") $this->isChildCheck=1;
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
	public  function getvaluelink($vFile,$vSelectID)
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