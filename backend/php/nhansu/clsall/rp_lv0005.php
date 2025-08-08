<?php
class rp_lv0005 extends lv_controler{
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
		$vArrState=Array(1=>'T',2=>'S',3=>'TS',4=>'Q');
		$this->Get_Arr_Employees($vmau);
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
		if($vmau==4)
			$vTD_TrangThai="<td>@#01</td>";
		elseif($vmau==5)
			$vTD_TrangThai="<td style='background:blue;color:#fff'>@#01</td>";
		else
			$vTD_TrangThai="<td>@#01</td><td>@#02</td><td>@#03</td><td>@#04</td>";
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% class=@#04>@03</td>
			@#01
		</tr>
		";
		$lvHref="@02";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=@#04>@02</td>";
		$sqlS = "SELECT distinct A.lv002,A.lv003, ADDDATE('$this->datefrom',-1) DtFrom,ADDDATE('$this->dateto',1) DtTo,ADDDATE(A.lv004,1) DateNext,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,A.lv014,A.lv015,B.lv002 NVID,C.lv029 lv001,D.lv007 Shift,DayOfWeek(A.lv004) DOWS FROM tc_lv0011 A inner join tc_lv0010 B on A.lv002=B.lv001 inner join hr_lv0020 C on C.lv001=B.lv002 left join tc_lv0008 D on D.lv002=B.lv002  and year(D.lv005)=year(A.lv004) left join tc_lv0003 LL on A.lv004=LL.lv002 WHERE 1=1 ".$this->GetConditionOrther()." and A.lv100=0  order by C.lv029 ASC,A.lv004 ASC";
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
			$vEmpOK=Array();
			$vPreShift=Array();
		while ($vrow = db_fetch_array ($bResult)){
			$lvvt=$this->ArrEmpBack[$vrow['NVID']];
			if($vrow['DtFrom']!=$vrow['lv004'] && $vrow['DtTo']!=$vrow['lv004'])
				{
			//NVID NVID	
			//Shift year
			$strL="";
			$vorder++;
			$lvstrgt=$vTD_TrangThai;
			$vListShiftReceive=$this->ArrDep[$vrow['lv001']][0];
			$arrTime=null;
			$arrShift=$this->GetTimeListArr($vrow['NVID'],$vrow['lv004'],$vrow['lv015'],$vrow['Shift'],$passday,$vListShiftReceive,$vPreShift[$vrow['NVID']][$vrow['lv004']],$arrTime);
			$lvcheck=$this->LV_CheckLateSoon($vrow['NVID'],$vrow['lv015'],$vrow['Shift'],$arrShift);
			$this->ArrStateEmp[$vrow['lv004']][$lvcheck]=$this->ArrStateEmp[$vrow['lv004']][$lvcheck]+1;
			//if($passday==1)
			//	$lvstrgt=str_replace("@#01",$this->GetTimeListMoreOutDate($vrow['NVID'],$vrow['lv004'],$lvopt,$vCount),$lvstrgt);
			//else
			$lvstrgt=str_replace("@#01",$this->GetTimeListMore($arrTime,$vCount),$lvstrgt);
			$vPreShift[$vrow['NVID']][$vrow['DateNext']][0]=$vrow['lv015'];
			$vPreShift[$vrow['NVID']][$vrow['DateNext']][1]=$passday;
			if($vrow['DtFrom']!=$vrow['lv004'] && $vrow['DtTo']!=$vrow['lv004'])
			{
				
			if($vmau==3)
			{
				$vScan=0;
				$vNoScan=0;
				if($vCount>0)
				{
					$vScan=1;
					$vNoScan=0;
				}
				else
				{
					$this->ArrDeptSave[$vrow['lv001']][9]=$this->ArrDeptSave[$vrow['lv001']][9]."<br/>".$this->getvaluelink('lv099',$vrow['NVID']);
					$vScan=0;
					$vNoScan=1;
				}
			}
			else
			{
				$vScan=0;
				$vNoScan=0;
				if($vCount>0)
				{
					if($vCount==1)
					{
						if($lvcheck==4 || $lvcheck==5)
						{
						$vScan=0;
						$vNoScan=1;
						}
						else
						{
						 $vScan=1;
						$vNoScan=0;
						}
					}
					else
					{
						$vScan=1;
						$vNoScan=0;
					}
				}
				else
				{
					$vScan=0;
					$vNoScan=1;
				}
			}
			if($lvcheck==1 || $lvcheck==2 || $lvcheck==3) $this->ArrEmp[$lvvt][100]=true;
			$this->ArrDateScan[$vrow['lv004']]['Scan']=$this->ArrDateScan[$vrow['lv004']]['Scan']+(int)$vScan;
			$this->ArrDateScan[$vrow['lv004']]['NoScan']=$this->ArrDateScan[$vrow['lv004']]['NoScan']+(int)$vNoScan;
			$this->ArrDeptSave[$vrow['lv001']][0]=$this->ArrDeptSave[$vrow['lv001']][0]+(int)$vScan;
			$this->ArrDeptSave[$vrow['lv001']][1]=$this->ArrDeptSave[$vrow['lv001']][1]+(int)$vNoScan;
			if($vEmpOK[$vrow['NVID']]!=true) 
			{
				$this->ArrDeptSave[$vrow['lv001']][2]=$this->ArrDeptSave[$vrow['lv001']][2]+1;
				$vEmpOK[$vrow['NVID']]=true;
			}
			$lvstrgt=str_replace("@#02",$vArrState[$lvcheck],$lvstrgt);
			$lvstrgt=str_replace("@#03",$vScan,$lvstrgt);
			$lvstrgt=str_replace("@#04",$vNoScan,$lvstrgt);
			$this->ArrStateScan[$vrow['lv004']][0]=(float)$this->ArrStateScan[$vrow['lv004']][0]+$vScan;
			$this->ArrStateScan[$vrow['lv004']][1]=(float)$this->ArrStateScan[$vrow['lv004']][1]+$vNoScan;
			if($vmau==4)
			{
				if($lvcheck==1 || $lvcheck==2 || $lvcheck==3)
					$this->ArrEmp[$lvvt][4]=str_replace("<!--".$vrow['lv004']."-->",$lvstrgt,$this->ArrEmp[$lvvt][4]);
				else
					$this->ArrEmp[$lvvt][4]=str_replace("<!--".$vrow['lv004']."-->",'<td>&nbsp;</td>',$this->ArrEmp[$lvvt][4]);

				
			}
			elseif($vmau==5)
			{
				if($vrow['DOWS']!=1)
				{
					if($lvcheck==4 || $lvcheck==5)
						$this->ArrEmp[$lvvt][4]=str_replace("<!--".$vrow['lv004']."-->",$lvstrgt,$this->ArrEmp[$lvvt][4]);
					else
						$this->ArrEmp[$lvvt][4]=str_replace("<!--".$vrow['lv004']."-->",'<td>&nbsp;</td>',$this->ArrEmp[$lvvt][4]);
				}
				else
				{
					$this->ArrEmp[$lvvt][4]=str_replace("<!--".$vrow['lv004']."-->",'<td>&nbsp;</td>',$this->ArrEmp[$lvvt][4]);
				}
				
			}
			else
				$this->ArrEmp[$lvvt][4]=str_replace("<!--".$vrow['lv004']."-->",$lvstrgt,$this->ArrEmp[$lvvt][4]);
		
			}
			}
		}
				//$this->ArrEmp[$lvvt][44]=str_replace("<!--".$vrow['lv004']."-->",$lvstrgt,$this->ArrEmp[$lvvt][44]);
			
			foreach($lvparatimecard as $lvgt)
			{
				$this->LV_GetFooter($lvgt);
			}
			switch($vmau)
			{
				case 5:
					return $this->Get_BuildList_ArrayNoScan();
					break;
				case 4:
					return $this->Get_BuildList_ArraySimple();
					break;
				case 3:
					return $this->Get_BuildList_Array_Sum_Eat();
					break;
				case 1:
					return $this->Get_BuildList_Array_Sum();
					break;
				default:
					return $this->Get_BuildList_Array();
					break;
			}
	}
	function Get_BuildList_ArrayNoScan()
	{
		
			$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>STT</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Mã ID cc</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Mã nhân viên</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Ngày vào làm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Phòng ban</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Tên nhân viên</td>".$this->lvHeader."
							</tr>
			<tr>
			".$this->lvHeader1."
			</tr>
			@01
			<tr>
				<td  class=\"tdhprint\" width=\"10%\" align=\"center\" colspan=\"6\"><b>&nbsp;</b></td>@02
			</tr>
		</table>
		";
		
		$lvListTrAll="";
		$this->lvHeader="";
		$strTD="";
		$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
		$datecur=$this->datefrom;
		for($i=1;$i<=31;$i++)
		{
			$datecur=str_replace("/","-", $datecur);
			$vDows=date('w', strtotime($datecur))+1;
			
			$this->strTDF=str_replace("<!--Scan:".$datecur."-->",$this->ArrDateScan[$datecur]['Scan'],$this->strTDF);
			$this->strTDF=str_replace("<!--NoScan:".$datecur."-->",$this->ArrDateScan[$datecur]['NoScan'],$this->strTDF);
			$datecur=ADDDATE($this->datefrom,$i);
		}
		$vOrder=0;
		for($i=0;$i<count($this->ArrEmp);$i++)
		{
			if($this->isLateSoon==1)
			{
				if($this->ArrEmp[$i][100]==true)
				{
					$vOrder++;
					$lvListTrAll=$lvListTrAll."<tr><td nowrap='nowrap'>".($vOrder)."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][99]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td><td nowrap='nowrap'>".$this->FormatView($this->ArrEmp[$i][130],2)."</td><td nowrap='nowrap'>".$this->LV_GetDepartment($this->ArrEmp[$i][2])."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td>".str_replace("<!--","&nbsp;<!--",$this->LV_AutoFillDate($this->ArrEmp[$i][4]))."</tr>";
				}
				
			}
			else
			{
				$lvListTrAll=$lvListTrAll."<tr><td nowrap='nowrap'>".($i+1)."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][99]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td><td nowrap='nowrap'>".$this->FormatView($this->ArrEmp[$i][130],2)."</td><td nowrap='nowrap'>".$this->LV_GetDepartment($this->ArrEmp[$i][2])."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td>".str_replace("<!--","&nbsp;<!--",$this->LV_AutoFillDate($this->ArrEmp[$i][4]))."</tr>";
			}
			
		}
		$vTD_TrangThai="<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
		if($vmau==2)
		{
			$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
			$datecur=$this->datefrom;
			for($i=1;$i<=31;$i++)
			{
				$vDows=date('w', strtotime($datecur))+1;
				$lvListTrAll=str_replace("<!--".str_replace("/","-",$datecur)."-->",$vTD_TrangThai,$lvListTrAll);
				$datecur=ADDDATE($this->datefrom,$i);
			}
		}
		else
		{
			$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
			$datecur=$this->datefrom;
			for($i=1;$i<=$lvNumDate+1;$i++)
			{
				$vDows=date('w', strtotime($datecur))+1;
				$lvListTrAll=str_replace("<!--".str_replace("/","-",$datecur)."-->",$vTD_TrangThai,$lvListTrAll);
				$datecur=ADDDATE($this->datefrom,$i);
			}
		}
		return str_replace("@01",$lvListTrAll,str_replace("@02",$this->strTDF,$vTable));
	}
	function LV_AutoFillDate($vStrFill)
	{
			for($i=0;$i<=31;$i++)
			{
				$datecur=ADDDATE($this->datefrom,$i);
				$vStrFill=str_replace("<!--".str_replace("/","-",$datecur)."-->",'<td>&nbsp;</td>',$vStrFill);
				
			}
			return $vStrFill;
	}
	function Get_BuildList_ArraySimPle()
	{
		
			$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>STT</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Mã ID cc</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Mã nhân viên</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Ngày vào làm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Phòng ban</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Tên nhân viên</td>".$this->lvHeader."
							</tr>
			<tr>
			".$this->lvHeader1."
			</tr>
			@01
			<tr>
				<td  class=\"tdhprint\" width=\"10%\" align=\"center\" colspan=\"6\"><b>&nbsp;</b></td>@02
			</tr>
		</table>
		";
		
		$lvListTrAll="";
		$this->lvHeader="";
		$strTD="";
		$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
		$datecur=$this->datefrom;
		for($i=1;$i<=31;$i++)
		{
			$datecur=str_replace("/","-", $datecur);
			$vDows=date('w', strtotime($datecur))+1;
			
			$this->strTDF=str_replace("<!--Scan:".$datecur."-->",$this->ArrDateScan[$datecur]['Scan'],$this->strTDF);
			$this->strTDF=str_replace("<!--NoScan:".$datecur."-->",$this->ArrDateScan[$datecur]['NoScan'],$this->strTDF);
			$datecur=ADDDATE($this->datefrom,$i);
		}
		$vOrder=0;
		for($i=0;$i<count($this->ArrEmp);$i++)
		{
			if($this->isLateSoon==1)
			{
				if($this->ArrEmp[$i][100]==true)
				{
					$vOrder++;
					$lvListTrAll=$lvListTrAll."<tr><td nowrap='nowrap'>".($vOrder)."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][99]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td><td nowrap='nowrap'>".$this->FormatView($this->ArrEmp[$i][130],2)."</td><td nowrap='nowrap'>".$this->LV_GetDepartment($this->ArrEmp[$i][2])."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td>".str_replace("<!--","&nbsp;<!--",$this->LV_AutoFillDate($this->ArrEmp[$i][4]))."</tr>";
				}
				
			}
			else
			{
				$lvListTrAll=$lvListTrAll."<tr><td nowrap='nowrap'>".($i+1)."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][99]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td><td nowrap='nowrap'>".$this->FormatView($this->ArrEmp[$i][130],2)."</td><td nowrap='nowrap'>".$this->LV_GetDepartment($this->ArrEmp[$i][2])."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td>".str_replace("<!--","&nbsp;<!--",$this->LV_AutoFillDate($this->ArrEmp[$i][4]))."</tr>";
			}
			
		}
		$vTD_TrangThai="<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
		if($vmau==2)
		{
			$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
			$datecur=$this->datefrom;
			for($i=1;$i<=31;$i++)
			{
				$vDows=date('w', strtotime($datecur))+1;
				$lvListTrAll=str_replace("<!--".str_replace("/","-",$datecur)."-->",$vTD_TrangThai,$lvListTrAll);
				$datecur=ADDDATE($this->datefrom,$i);
			}
		}
		else
		{
			$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
			$datecur=$this->datefrom;
			for($i=1;$i<=$lvNumDate+1;$i++)
			{
				$vDows=date('w', strtotime($datecur))+1;
				$lvListTrAll=str_replace("<!--".str_replace("/","-",$datecur)."-->",$vTD_TrangThai,$lvListTrAll);
				$datecur=ADDDATE($this->datefrom,$i);
			}
		}
		return str_replace("@01",$lvListTrAll,str_replace("@02",$this->strTDF,$vTable));
	}
	function LV_GetFooter($vState)
	{
		$strTD="";
		$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
		$datecur=$this->datefrom;
		
		for($i=1;$i<=$lvNumDate+1;$i++)
		{
			$vStrSave="";
			switch($vState)
			{
				case '21':
					for($j=1;$j<=5;$j++)
					{
						if($this->ArrStateEmp[str_replace("/","-",$datecur)][$j]>0)
						{
							$vStrSave=$vStrSave.$j."(".$this->ArrStateEmp[str_replace("/","-",$datecur)][$j].")"."<br/>";
						}
					}
					$this->lvFooter=str_replace("<!--F-".str_replace("/","-",$datecur)."-->",$vStrSave,$this->lvFooter);
					break;
			}
			$datecur=ADDDATE($this->datefrom,$i);
		}
		return $strTD;
		
	}
	function Get_BuildList_Array_Sum_Eat()
	{
	$vTable='<br/><center><table  style="width: 972px;"   align="center" class="tblprint" id="tabletc" border="1" cellpadding="0" cellspacing="0">
<colgroup><col width="30"></col> <col width="164"></col> <col width="110"></col> <col width="238"></col> <col width="145"></col> <col width="145"></col> <col width="285"></col> </colgroup> 
<tbody>
<tr height="21">
<td class="lvhtable"> 訂單號碼<BR/>STT</td>
<td class="lvhtable"> 部門代號<BR/>MÃ BỘ PHẬN</td>
<td class="lvhtable" >部門名稱<BR/>TÊN BỘ PHẬN</td>
<td class="lvhtable" >應到人數<BR/>SỐ NGƯỜI PHẢI ĐẾN</td>
<td class="lvhtable" >實到人數<BR/>SỐ NGƯỜI THỰC ĐẾN</td>
<td class="lvhtable" >出勤率<BR/>TỶ LỆ CHUYÊN CẦN</td>
<td class="lvhtable" >缺席人員<BR/>NHÂN VIÊN VẮNG MẶT</td>
</tr>

@01
<tr height="21">
<td height="21">&nbsp;</td>
<td >&nbsp;</td>
<td>&nbsp;TỔNG CỘNG&nbsp;</td>
<td align=right style="padding:3px">@67</td>
<td align=right  style="padding:3px">@68</td>
<td align=right  style="padding:3px">@69</td>
<td >&nbsp;</td>
</tr>
</tbody>
</table>';
		$vTrStr='
		<tr style="background-color:@11" height="21">
			<td style="padding:3px" align="left">@#01</td>
			<td style="padding:3px" align="left">@#99</td>
			<td style="padding:3px" align="left">@#02</td>
			<td style="padding:3px" align="right">@#03</td>
			<td style="padding:3px" align="right">@#04</td>		
			<td style="padding:3px" align="right">@#05</td>
			<td style="padding:3px" align="left">@#06</td>
		</tr>
';
		$lvListTrAll="";
		$vDepartment="";
		$StrMulSub="";
		$vSumAn=0;
		$vSumNoScan=0;
		$vSum=0;
		if($this->lv029=="" || $this->lv029==NULL)
		{
		$vDepID='SOF';
		$vsql="select lv001,lv003 from  hr_lv0002 where lv002='$vDepID' order by lv003";
		}
		else
		{
			
		$vsql="select lv001,lv003 from  hr_lv0002 where lv001 in ('".str_replace(",","','",$this->lv029)."') order by lv003";
		}
		
		$bResult=db_query($vsql);
		$i=1;
		while ($vrow = db_fetch_array ($bResult)){
			$LineTrStrParent=$vTrStr;
			$color='#EAEAEA';
			$LineTrStrParent=str_replace("@11",$color,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#01",$i,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#02",$vrow['lv003'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@#99",$vrow['lv001'],$LineTrStrParent);
			$vSLScan=(float)$this->ArrDeptSave[$vrow['lv001']][0];
			$vSLNoScan=(float)$this->ArrDeptSave[$vrow['lv001']][1];
			$vSoNV=(float)$this->ArrDeptSave[$vrow['lv001']][2];
			$vReturn=$vReturn."<option value='".$vrow['lv001']."' ".(($vSelectID==$vrow['lv001'])?'selected="selected"':'').">".$vrow['lv003']."</option>";
			$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow['lv001']."' order by lv003";
			$bResult1=db_query($vsql);
			$StrMulSub="";
			$j=1;
			while ($vrow1 = db_fetch_array ($bResult1)){
				$LineTrStrEmp=$vTrStr;
				$color='#fff';
				$LineTrStrEmp=str_replace("@11",$color,$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#01",$i.".".$j,$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#02",$vrow1['lv003'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#99",$vrow1['lv001'],$LineTrStrEmp);
				
				$LineTrStrEmp=str_replace("@#03",$this->FormatView($this->ArrDeptSave[$vrow1['lv001']][2],10),$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#04",$this->FormatView($this->ArrDeptSave[$vrow1['lv001']][0],10),$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#05",$this->FormatView($this->ArrDeptSave[$vrow1['lv001']][1],10),$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#06",$this->ArrDeptSave[$vrow1['lv001']][9],$LineTrStrEmp);
				$StrMulSub=$StrMulSub.$LineTrStrEmp;
				$j++;
				$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow['lv001']."' order by lv003";
				$bResult1=db_query($vsql);
				$StrMulSub="";
				$i1=1;
				
				while ($vrow1 = db_fetch_array ($bResult1)){
				$StrMulSub1='';
				$LineTrStrEmp1=$vTrStr;
				$color='#fff';
				$LineTrStrEmp1=str_replace("@11",$color,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#01",$i.".".$i1,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#02",$vrow1['lv003'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#99",$vrow1['lv001'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#06",$this->ArrDeptSave[$vrow1['lv001']][9],$LineTrStrEmp1);
				$vSoNV=$vSoNV+(float)$this->ArrDeptSave[$vrow1['lv001']][2];
				$vSLScan=$vSLScan+(float)$this->ArrDeptSave[$vrow1['lv001']][0];
				$vSLNoScan=$vSLNoScan+(float)$this->ArrDeptSave[$vrow1['lv001']][1];
				$vSLScan1=0;
				$vSLNoScan1=0;
				$vSLScan1=$vSLScan1+(float)$this->ArrDeptSave[$vrow1['lv001']][0];
				$vSLNoScan1=$vSLNoScan1+(float)$this->ArrDeptSave[$vrow1['lv001']][1];
				
				$i2=1;
				$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow1['lv001']."' order by lv003";
				$bResult2=db_query($vsql);
				while ($vrow2 = db_fetch_array ($bResult2)){
					$LineTrStrEmp=$vTrStr;
					$color='#fff';
					$LineTrStrEmp=str_replace("@11",$color,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#01",$i.".".$i1.".".$i2,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#02",$vrow2['lv003'],$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#99",$vrow2['lv001'],$LineTrStrEmp);
					$vSoNV=$vSoNV+(float)$this->ArrDeptSave[$vrow2['lv001']][2];
					$vSLScan=$vSLScan+(float)$this->ArrDeptSave[$vrow2['lv001']][0];
					$vSLNoScan=$vSLNoScan+(float)$this->ArrDeptSave[$vrow2['lv001']][1];
					$vSLScan1=$vSLScan1+(float)$this->ArrDeptSave[$vrow2['lv001']][0];
					$vSLNoScan1=$vSLNoScan1+(float)$this->ArrDeptSave[$vrow2['lv001']][1];
					$LineTrStrEmp=str_replace("@#03",$this->FormatView($this->ArrDeptSave[$vrow2['lv001']][0],10),$LineTrStrEmp);
					
					$LineTrStrEmp=str_replace("@#04",$this->FormatView($this->ArrDeptSave[$vrow2['lv001']][1],10),$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#05",$this->FormatView($this->ArrDeptSave[$vrow2['lv001']][0]+$this->ArrDeptSave[$vrow2['lv001']][1],10),$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#06",$this->ArrDeptSave[$vrow2['lv001']][9],$LineTrStrEmp);
					$StrMulSub1=$StrMulSub1.$LineTrStrEmp;
					$i3=1;
					$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow2['lv001']."' order by lv003";
					$bResult3=db_query($vsql);
					while ($vrow3 = db_fetch_array ($bResult3)){
						$LineTrStrEmp=$vTrStr;
						$color='#fff';
						$LineTrStrEmp=str_replace("@11",$color,$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#01",$i.".".$i1.".".$i2.".".$i3,$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#02",$vrow3['lv003'],$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#99",$vrow3['lv001'],$LineTrStrEmp);
						$vSoNV=$vSoNV+(float)$this->ArrDeptSave[$vrow3['lv001']][2];
						$vSLScan=$vSLScan+(float)$this->ArrDeptSave[$vrow3['lv001']][0];
						$vSLNoScan=$vSLNoScan+(float)$this->ArrDeptSave[$vrow3['lv001']][1];
						$vSLScan1=$vSLScan1+(float)$this->ArrDeptSave[$vrow3['lv001']][0];
						$vSLNoScan1=$vSLNoScan1+(float)$this->ArrDeptSave[$vrow3['lv001']][1];
						$LineTrStrEmp=str_replace("@#03",$this->FormatView($this->ArrDeptSave[$vrow3['lv001']][0],10),$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#04",$this->FormatView($this->ArrDeptSave[$vrow3['lv001']][1],10),$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#05",$this->FormatView($this->ArrDeptSave[$vrow3['lv001']][0]+$this->ArrDeptSave[$vrow3['lv001']][1],10),$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#06",$this->ArrDeptSave[$vrow3['lv001']][9],$LineTrStrEmp);
						$StrMulSub1=$StrMulSub1.$LineTrStrEmp;
						$i3++;
					}
					$i2++;
				}
				$LineTrStrEmp1=str_replace("@#04",$this->FormatView($vSLScan1,10),$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#05",$this->FormatView(round($vSLScan1*100/($vSLScan1+$vSLNoScan1),0),10),$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#03",$this->FormatView($vSLScan1+$vSLNoScan1,10),$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#06",'&nbsp;',$LineTrStrEmp1);
				$StrMulSub=$StrMulSub.$LineTrStrEmp1;
				$StrMulSub=$StrMulSub.$StrMulSub1;
				$i1++;
			}
			}
			$vSumAn=$vSumAn+$vSLScan;
			$vSumNoScan=$vSumNoScan+$vSLNoScan;
			$vSumNV=$vSumNV+$vSoNV;
			$LineTrStrParent=str_replace("@#03",$this->FormatView($vSoNV,10),$LineTrStrParent);
			$LineTrStrParent=str_replace("@#04",$this->FormatView($vSLScan,10),$LineTrStrParent);
			$LineTrStrParent=str_replace("@#05",$this->FormatView(round($vSLScan*100/$vSoNV,0),10),$LineTrStrParent);
			$LineTrStrParent=str_replace("@#06",'&nbsp;',$LineTrStrParent);
			$lvListTrAll=$lvListTrAll.$LineTrStrParent;
			$lvListTrAll=$lvListTrAll.$StrMulSub;
			$i++;
		}
		$vTable=str_replace("@67",$this->FormatView($vSumNV,10),$vTable);
		$vTable=str_replace("@68",$this->FormatView($vSumAn,10),$vTable);
		$vTable=str_replace("@69",$this->FormatView(round($vSumAn*100/$vSumNV,0),10),$vTable);
		$vTable=str_replace("@70",$this->FormatView(($vSumAn+$vSumNoScan),10),$vTable);
		
		$vTable=str_replace("@71",$this->FormatView($vMoneyCom,10),$vTable);
		return str_replace("@01",$lvListTrAll,str_replace("#02",$this->FormatView($vSum,10),$vTable));
	}
	function Get_BuildList_Array_Sum()
	{
	$vTable='<br/><center><table  style="width: 972px;"   align="center" class="tblprint" id="tabletc" border="1" cellpadding="0" cellspacing="0">
<colgroup><col width="30"></col> <col width="164"></col> <col width="110"></col> <col width="238"></col> <col width="145"></col> <col width="285"></col> </colgroup> 
<tbody>
<tr height="21">
<td class="lvhtable">  STT</td>
<td class="lvhtable" >Phòng ban</td>
<td class="lvhtable" >Tổng số người trong bộ phận </td>
<td class="lvhtable" >Tổng số lượng scan</td>
<td class="lvhtable" >Tổng số lượng không scan</td>
<td class="lvhtable" >&nbsp;Ghi chú&nbsp;</td>
</tr>

@01
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;Total&nbsp;</td>
<td align=right style="padding:3px">@67</td>
<td align=right  style="padding:3px">@68</td>
<td align=right  style="padding:3px">@69</td>
<td width="285">&nbsp;</td>
</tr>
</tbody>
</table>';
		$vTrStr='
		<tr style="background-color:@11" height="21">
			<td style="padding:3px" align="left">@#01</td>
			<td style="padding:3px" align="left">@#02</td>
			<td style="padding:3px" align="right">@#03</td>
			<td style="padding:3px" align="right">@#04</td>		
			<td style="padding:3px" align="right">@#05</td>
			<td style="padding:3px" align="left">@#06</td>
		</tr>
';
		$lvListTrAll="";
		$vDepartment="";
		$StrMulSub="";
		$vSumAn=0;
		$vSumNoScan=0;
		$vSum=0;
		if($this->lv029=="" || $this->lv029==NULL)
		{
		$vDepID='SOF';
		$vsql="select lv001,lv003 from  hr_lv0002 where lv002='$vDepID' order by lv003";
		}
		else
		{
			
		$vsql="select lv001,lv003 from  hr_lv0002 where lv001 in ('".str_replace(",","','",$this->lv029)."') order by lv003";
		}
		
		$bResult=db_query($vsql);
		$i=1;
		while ($vrow = db_fetch_array ($bResult)){
			$LineTrStrParent=$vTrStr;
			$color='#EAEAEA';
			$LineTrStrParent=str_replace("@11",$color,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#01",$i,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#02",$vrow['lv003'],$LineTrStrParent);
			$vSLScan=(float)$this->ArrDeptSave[$vrow['lv001']][0];
			$vSLNoScan=(float)$this->ArrDeptSave[$vrow['lv001']][1];
			$vSoNV=(float)$this->ArrDeptSave[$vrow['lv001']][2];
			$vReturn=$vReturn."<option value='".$vrow['lv001']."' ".(($vSelectID==$vrow['lv001'])?'selected="selected"':'').">".$vrow['lv003']."</option>";
			$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow['lv001']."' order by lv003";
			$bResult1=db_query($vsql);
			$StrMulSub="";
			$j=1;
			while ($vrow1 = db_fetch_array ($bResult1)){
				$LineTrStrEmp=$vTrStr;
				$color='#fff';
				$LineTrStrEmp=str_replace("@11",$color,$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#01",$i.".".$j,$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#02",$vrow1['lv003'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#03",$this->FormatView($this->ArrDeptSave[$vrow1['lv001']][2],10),$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#04",$this->FormatView($this->ArrDeptSave[$vrow1['lv001']][0],10),$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#05",$this->FormatView($this->ArrDeptSave[$vrow1['lv001']][1],10),$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#06",'&nbsp;',$LineTrStrEmp);
				$StrMulSub=$StrMulSub.$LineTrStrEmp;
				$j++;
				$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow['lv001']."' order by lv003";
				$bResult1=db_query($vsql);
				$StrMulSub="";
				$i1=1;
				
				while ($vrow1 = db_fetch_array ($bResult1)){
				$StrMulSub1='';
				$LineTrStrEmp1=$vTrStr;
				$color='#fff';
				$LineTrStrEmp1=str_replace("@11",$color,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#01",$i.".".$i1,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#02",$vrow1['lv003'],$LineTrStrEmp1);
				$vSoNV=$vSoNV+(float)$this->ArrDeptSave[$vrow1['lv001']][2];
				$vSLScan=$vSLScan+(float)$this->ArrDeptSave[$vrow1['lv001']][0];
				$vSLNoScan=$vSLNoScan+(float)$this->ArrDeptSave[$vrow1['lv001']][1];
				$vSLScan1=0;
				$vSLNoScan1=0;
				$vSLScan1=$vSLScan1+(float)$this->ArrDeptSave[$vrow1['lv001']][0];
				$vSLNoScan1=$vSLNoScan1+(float)$this->ArrDeptSave[$vrow1['lv001']][1];
				
				$i2=1;
				$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow1['lv001']."' order by lv003";
				$bResult2=db_query($vsql);
				while ($vrow2 = db_fetch_array ($bResult2)){
					$LineTrStrEmp=$vTrStr;
					$color='#fff';
					$LineTrStrEmp=str_replace("@11",$color,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#01",$i.".".$i1.".".$i2,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#02",$vrow2['lv003'],$LineTrStrEmp);
					$vSoNV=$vSoNV+(float)$this->ArrDeptSave[$vrow2['lv001']][2];
					$vSLScan=$vSLScan+(float)$this->ArrDeptSave[$vrow2['lv001']][0];
					$vSLNoScan=$vSLNoScan+(float)$this->ArrDeptSave[$vrow2['lv001']][1];
					$vSLScan1=$vSLScan1+(float)$this->ArrDeptSave[$vrow2['lv001']][0];
					$vSLNoScan1=$vSLNoScan1+(float)$this->ArrDeptSave[$vrow2['lv001']][1];
					$LineTrStrEmp=str_replace("@#03",$this->FormatView($this->ArrDeptSave[$vrow2['lv001']][0],10),$LineTrStrEmp);
					
					$LineTrStrEmp=str_replace("@#04",$this->FormatView($this->ArrDeptSave[$vrow2['lv001']][1],10),$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#05",$this->FormatView($this->ArrDeptSave[$vrow2['lv001']][0]+$this->ArrDeptSave[$vrow2['lv001']][1],10),$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#06",'&nbsp;',$LineTrStrEmp);
					$StrMulSub1=$StrMulSub1.$LineTrStrEmp;
					$i3=1;
					$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow2['lv001']."' order by lv003";
					$bResult3=db_query($vsql);
					while ($vrow3 = db_fetch_array ($bResult3)){
						$LineTrStrEmp=$vTrStr;
						$color='#fff';
						$LineTrStrEmp=str_replace("@11",$color,$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#01",$i.".".$i1.".".$i2.".".$i3,$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#02",$vrow3['lv003'],$LineTrStrEmp);
						$vSoNV=$vSoNV+(float)$this->ArrDeptSave[$vrow3['lv001']][2];
						$vSLScan=$vSLScan+(float)$this->ArrDeptSave[$vrow3['lv001']][0];
						$vSLNoScan=$vSLNoScan+(float)$this->ArrDeptSave[$vrow3['lv001']][1];
						$vSLScan1=$vSLScan1+(float)$this->ArrDeptSave[$vrow3['lv001']][0];
						$vSLNoScan1=$vSLNoScan1+(float)$this->ArrDeptSave[$vrow3['lv001']][1];
						$LineTrStrEmp=str_replace("@#03",$this->FormatView($this->ArrDeptSave[$vrow3['lv001']][0],10),$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#04",$this->FormatView($this->ArrDeptSave[$vrow3['lv001']][1],10),$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#05",$this->FormatView($this->ArrDeptSave[$vrow3['lv001']][0]+$this->ArrDeptSave[$vrow3['lv001']][1],10),$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#06",'&nbsp;',$LineTrStrEmp);
						$StrMulSub1=$StrMulSub1.$LineTrStrEmp;
						$i3++;
					}
					$i2++;
				}
				$LineTrStrEmp1=str_replace("@#04",$this->FormatView($vSLScan1,10),$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#05",$this->FormatView($vSLNoScan1,10),$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#03",$this->FormatView($vSLScan1+$vSLNoScan1,10),$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#06",'&nbsp;',$LineTrStrEmp1);
				$StrMulSub=$StrMulSub.$LineTrStrEmp1;
				$StrMulSub=$StrMulSub.$StrMulSub1;
				$i1++;
			}
			}
			$vSumAn=$vSumAn+$vSLScan;
			$vSumNoScan=$vSumNoScan+$vSLNoScan;
			$vSumNV=$vSumNV+$vSoNV;
			$LineTrStrParent=str_replace("@#03",$this->FormatView($vSoNV,10),$LineTrStrParent);
			$LineTrStrParent=str_replace("@#04",$this->FormatView($vSLScan,10),$LineTrStrParent);
			$LineTrStrParent=str_replace("@#05",$this->FormatView($vSLNoScan,10),$LineTrStrParent);
			$LineTrStrParent=str_replace("@#06",'&nbsp;',$LineTrStrParent);
			$lvListTrAll=$lvListTrAll.$LineTrStrParent;
			$lvListTrAll=$lvListTrAll.$StrMulSub;
			$i++;
		}
		$vTable=str_replace("@67",$this->FormatView($vSumNV,10),$vTable);
		$vTable=str_replace("@68",$this->FormatView($vSumAn,10),$vTable);
		$vTable=str_replace("@69",$this->FormatView($vSumNoScan,10),$vTable);
		$vTable=str_replace("@70",$this->FormatView(($vSumAn+$vSumNoScan),10),$vTable);
		
		$vTable=str_replace("@71",$this->FormatView($vMoneyCom,10),$vTable);
		return str_replace("@01",$lvListTrAll,str_replace("#02",$this->FormatView($vSum,10),$vTable));
	}
	function Get_BuildList_Array()
	{
		
			$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>STT</b></td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Mã ID cc</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Mã nhân viên</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Ngày vào làm</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Phòng ban</td>
				<td rowspan=\"2\" class=\"tdhprint\" width=\"10%\" align=\"center\"><b>Tên nhân viên</td>".$this->lvHeader."
							</tr>
			<tr>
			".$this->lvHeader1."
			</tr>
			@01
			<tr>
				<td  class=\"tdhprint\" width=\"10%\" align=\"center\" colspan=\"6\"><b>&nbsp;</b></td>@02
			</tr>
		</table>
		";
		
		$lvListTrAll="";
		$this->lvHeader="";
		$strTD="";
		$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
		$datecur=$this->datefrom;
		for($i=1;$i<=31;$i++)
		{
			$datecur=str_replace("/","-", $datecur);
			$vDows=date('w', strtotime($datecur))+1;
			
			$this->strTDF=str_replace("<!--Scan:".$datecur."-->",$this->ArrDateScan[$datecur]['Scan'],$this->strTDF);
			$this->strTDF=str_replace("<!--NoScan:".$datecur."-->",$this->ArrDateScan[$datecur]['NoScan'],$this->strTDF);
			$datecur=ADDDATE($this->datefrom,$i);
		}
		$vOrder=0;
		for($i=0;$i<count($this->ArrEmp);$i++)
		{
			if($this->isLateSoon==1)
			{
				if($this->ArrEmp[$i][100]==true)
				{
					$vOrder++;
					$lvListTrAll=$lvListTrAll."<tr><td nowrap='nowrap'>".($vOrder)."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][99]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td><td nowrap='nowrap'>".$this->FormatView($this->ArrEmp[$i][130],2)."</td><td nowrap='nowrap'>".$this->LV_GetDepartment($this->ArrEmp[$i][2])."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][4])."</tr>";
				}
				
			}
			else
			{
				$lvListTrAll=$lvListTrAll."<tr><td nowrap='nowrap'>".($i+1)."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][99]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td><td nowrap='nowrap'>".$this->FormatView($this->ArrEmp[$i][130],2)."</td><td nowrap='nowrap'>".$this->LV_GetDepartment($this->ArrEmp[$i][2])."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][4])."</tr>";
			}
			
		}
		$vTD_TrangThai="<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
		if($vmau==2)
		{
			$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
			$datecur=$this->datefrom;
			for($i=1;$i<=31;$i++)
			{
				$vDows=date('w', strtotime($datecur))+1;
				$lvListTrAll=str_replace("<!--".str_replace("/","-",$datecur)."-->",$vTD_TrangThai,$lvListTrAll);
				$datecur=ADDDATE($this->datefrom,$i);
			}
		}
		else
		{
			$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
			$datecur=$this->datefrom;
			for($i=1;$i<=$lvNumDate+1;$i++)
			{
				$vDows=date('w', strtotime($datecur))+1;
				$lvListTrAll=str_replace("<!--".str_replace("/","-",$datecur)."-->",$vTD_TrangThai,$lvListTrAll);
				$datecur=ADDDATE($this->datefrom,$i);
			}
		}
		return str_replace("@01",$lvListTrAll,str_replace("@02",$this->strTDF,$vTable));
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
	function GetTimeListArr($vlv001,$vlv002,$shiftDay,$shiftYear,&$passday,$vListShiftReceive,$vPreShift,&$arrTime)
	{
		$arrTime1=Array();
		$vPass=(int)$vPreShift[1];
		if($shiftDay!="" && $shiftDay!=NULL)
		{
			$shift_start=(int)str_replace(":","",$this->ArrShift[0]['IN-'.$shiftDay][3]);
			$shift_end=(int)str_replace(":","",$this->ArrShift[0]['OUT-'.$shiftDay][4]);
			$passday=($shift_start>$shift_end)?1:0;
			$isgay=$this->ArrShift[0]['GAY-'.$shiftDay][1];
		}
		else if($shiftYear!="" && $shiftYear!=NULL)
		{
			$shift_start=(int)str_replace(":","",$this->ArrShift[0]['IN-'.$shiftYear][3]);
			$shift_end=(int)str_replace(":","",$this->ArrShift[0]['OUT-'.$shiftYear][4]);
			$passday=($shift_start>$shift_end)?1:0;
			$isgay=$this->ArrShift[0]['GAY-'.$shiftYear][1];
		}
		
		$strReturn=array();
		if($passday!=1)
		{
			$lvsql="select lv003,lv005 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002'  and lv006<>1 order by lv003 ASC";
			$vresult=db_query($lvsql);
			$count=db_num_rows($vresult);
			if($vresult){
				$i=1;
				$j=1;
				$vbo=0;
				while($vrow=db_fetch_array($vresult))
				{
					$arrTime1[$j]=$vrow['lv003'];
					if($vPass==1)
					{
						$vShiftOut=$this->ConfirmShift($this->ArrShift,$vrow['lv003'],$vListShiftReceive);
						if($vPreShift[0]!=$vShiftOut)
						{
							if(($i==1))
							{
								$arrTime[0]=$vrow['lv003'];
								$strReturn[0]=(int)str_replace(":","",$vrow['lv003']);
							}
							else if($j==$count)
							{
								$strReturn[1]=(int)str_replace(":","",$vrow['lv003']);
								$arrTime[1]=$vrow['lv003'];
							}
							$i++;
						}
					}
					else
					{
						if($isgay==1)
						{
							if($this->LV_GetSecond($arrTime[$i-2+$vbo],$vrow['lv003'])>90 || $i==1)
							{
								$arrTime[$i-1+$vbo]=$vrow['lv003'];
								$strReturn[$i-1+$vbo]=(int)str_replace(":","",$vrow['lv003']);
							}
							else
								$vbo++;
						}
						else
						{
							
							if($shift_start>(str_replace(":","",$vrow['lv003'])+40000))
							{
								$i--;
								$count--;
							}
							else
							{
								if(($i==1))
								{
									$arrTime[0]=$vrow['lv003'];
									$strReturn[0]=(int)str_replace(":","",$vrow['lv003']);
								}
								else if($i==$count)
								{
									$strReturn[1]=(int)str_replace(":","",$vrow['lv003']);
									$arrTime[1]=$vrow['lv003'];
								}
							}
						}
						$i++;
					}
					$j++;
				
				}
			}
		}
		else
		{
			if($this->isType==1)
			{
			$lvsql="select lv003,lv005 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002'  and lv006<>1 order by lv003 ASC";
			$vresult=db_query($lvsql);
			$count=db_num_rows($vresult);
			if($vresult){
				$i=1;
				$j=1;
				$vbo=0;
				while($vrow=db_fetch_array($vresult))
				{
					$arrTime1[$j]=$vrow['lv003'];
				}
			}
			}
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
				//$vShiftOut=$this->ConfirmShift($this->ArrShift,$vrow['lv003'],$vListShiftReceive);
				//if($vShiftOut==$shiftDay)
				{
					$strReturn[1]=(int)str_replace(":","",$vrow['lv003']);
					$arrTime[1]=$vrow['lv003'];
				}
				}
			}
		}
		if($this->isType==1) $arrTime=$arrTime1;
		return $strReturn;
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
	function GetTimeListMoreOutDate($vlv001,$vlv002,$opt=0,&$vCount=0)
	{
		$vCount=0;
		$strReturn="";
		$lvsql="select lv001,lv002,lv003,lv004,lv005,lv006 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002'  and lv006<>1 order by lv003 DESC limit 0,1";
		$vresult=db_query($lvsql);
		$count=db_num_rows($vresult);
			if($vresult){
			$i=1;
			while($vrow=db_fetch_array($vresult))
				{
				$vCount++;
						if($strReturn=="")
						{
							if(trim($vrow['lv005'])=='' || $vrow['lv005']==NULL)
								$strReturn=$strReturn.''.substr($vrow['lv003'],0,5)."";
							else
							{
								$strReturn=$strReturn.''.substr($vrow['lv003'],0,5)."";
							}
						}
						else
						{
							if(trim($vrow['lv005'])=='' || $vrow['lv005']==NULL)
							$strReturn=$strReturn." | ".substr($vrow['lv003'],0,5)."";
							else
							$strReturn=$strReturn." | ".''.substr($vrow['lv003'],0,5)."";
						}
				}
			}
			$lvsql="select lv001,lv002,lv003,lv004,lv005,lv006 from  tc_lv0012 Where lv001='$vlv001' and lv002=ADDDATE('$vlv002',1)  and lv006<>1 order by lv003 ASC  limit 0,1";
			$vresult=db_query($lvsql);
			$count=db_num_rows($vresult);
			if($vresult){
			$i=1;
			while($vrow=db_fetch_array($vresult))
				{
				$vCount++;
						if($strReturn=="")
						{
							if(trim($vrow['lv005'])=='' || $vrow['lv005']==NULL)
								$strReturn=$strReturn.''.substr($vrow['lv003'],0,5)."";
							else
							{
								$strReturn=$strReturn.''.substr($vrow['lv003'],0,5)."";
							}
						}
						else
						{
							if(trim($vrow['lv005'])=='' || $vrow['lv005']==NULL)
							$strReturn=$strReturn." | ".substr($vrow['lv003'],0,5)."";
							else
							$strReturn=$strReturn." | ".''.substr($vrow['lv003'],0,5)."";
						}
				}
			}
		$strReturn="<span style='padding:3px;white-space: nowrap;'>".$strReturn."</span>";
		return $strReturn;
	}
	function GetTimeListMoreBK($vlv001,$vlv002,$opt=0,&$vCount=0,$vPreShift)
	{
		$vPass=(int)$vPreShift[1];
		$strReturn="";
		$lvsql="select lv001,lv002,lv003,lv004,lv005,lv006 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002'  and lv006<>1 order by lv003 ASC";
		$vresult=db_query($lvsql);
		$count=db_num_rows($vresult);
			if($vresult){
			$i=1;
			$vCount=0;
			while($vrow=db_fetch_array($vresult))
			{
			$vCount++;
			if((($i)==(1+$vPass) || $i==$count) || $opt==0)
			{
				if($strReturn=="")
				{
					if(trim($vrow['lv005'])=='' || $vrow['lv005']==NULL)
						$strReturn=$strReturn.''.substr($vrow['lv003'],0,5)."";
					else
					{
						$strReturn=$strReturn.''.substr($vrow['lv003'],0,5)."";
					}
				}
				else
				{
					if(trim($vrow['lv005'])=='' || $vrow['lv005']==NULL)
					$strReturn=$strReturn." | ".substr($vrow['lv003'],0,5)."";
					else
					$strReturn=$strReturn." | ".''.substr($vrow['lv003'],0,5)."";
				}
				}
				$i++;
			}
		}
		$strReturn="<span style='padding:3px;white-space: nowrap;'>".$strReturn."</span>";
		return $strReturn;
	}
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
	function GetTimeList($vlv001,$vlv002,$opt=0)
	{
		$strReturn="";
		if($opt==0)
		{
			$lvsql="select lv001,lv002,lv003,lv004,lv005,lv006 from  tc_lv0012 Where lv006!=1 and lv001='$vlv001' and lv002='$vlv002'  order by lv003 ASC";
		}
		else
		{
			$lvsql="select lv001,lv002,lv003,lv004,lv005,lv006 from  tc_lv0012 Where lv006!=1 and lv001='$vlv001' and lv002='$vlv002'  order by lv003 ASC";
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
	function Get_Arr_Employees($vmau)
	{
		$this->ArrEmp=array();
		$this->ArrEmpBack=array();
		if($vmau==2)
			$strTd=$this->Get_String_DateFromTo31();
		elseif($vmau==4 || $vmau==5)
			$strTd=$this->Get_String_DateFromToMau4($vmau);
		else
			$strTd=$this->Get_String_DateFromTo();
		$lvcondition="";
		
		if($this->lv028!="")
			$strCondi=" AND  DD.lv009 in ('".str_replace(",","','",$this->lv028)."') ";
		if($this->lv029!="")  $strCondi=$strCondi." AND DD.lv029 in (".$this->LV_GetChildDep($this->lv029).")";
		if($this->lv030!="")  $strCondi=$strCondi." AND DD.lv001 in ('".$this->lv030."')";
		if($this->isStaffOff==1)  
			{
				$strCondi=$strCondi." AND ((DD.lv044>='$this->datefrom' AND Year(DD.lv044)>2000)  OR (Year(DD.lv044)<2000))";
			}
		switch($this->isViet)
		{
			case 0:
				break;
			case 1:
				$strCondi=$strCondi." and DD.lv022='VIETNAM'";
				break;
			case 2:
				$strCondi=$strCondi." and DD.lv022<>'VIETNAM'";
				break;
		}
		if($this->lvSort==0)
			$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv005 Title,DD.lv006 TenHoa,DD.lv030 DateWork,DD.lv029 Dep,DD.lv099 from hr_lv0020 DD where 1=1 $strCondi  order by DD.lv029 Asc,DD.lv008 asc";
		else 
			$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv005 Title,DD.lv006 TenHoa,DD.lv030 DateWork,DD.lv029 Dep,DD.lv099 from hr_lv0020 DD where 1=1 $strCondi  order by DD.lv008 asc";
		$vresult=db_query($lvsql);	
		$i=0;
		while($vrow=db_fetch_array($vresult))
		{
			$this->ArrEmp[$i][0]=$vrow['CodeID'];
			$this->ArrEmp[$i][1]=$vrow['Name'].'<br/>'.$vrow['TenHoa'];
			$this->ArrEmp[$i][2]=$vrow['Dep'];
			$this->ArrEmp[$i][3]=$this->Str_DateFromTo;
			$this->ArrEmp[$i][4]=$strTd;
			$this->ArrEmp[$i][44]=$this->strTDF;
			$this->ArrEmp[$i][105]=$vrow['Title'];
			$this->ArrEmp[$i][130]=$vrow['DateWork'];
			$this->ArrEmp[$i][99]=$vrow['lv099'];
			$this->ArrEmpBack[$vrow['CodeID']]=$i;
			$i++;
		}
	}
	function Get_String_DateFromToMau4($vLoai)
	{
		$this->lvHeader="";
		if($vLoai==4)
		{
			$vTD_TrangThai='<td >Đi trễ về sớm</td>';
			$vTD_TrangThaiBold='<td  style="background:#d3d3d3">Đi trễ về sớm</td>';
		}
		else
		{
			$vTD_TrangThai='<td >Không scan</td>';
			$vTD_TrangThaiBold='<td  style="background:#d3d3d3">Không scan</td>';
		}
		
		$strTD="";
		$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
		$datecur=$this->datefrom;
		for($i=1;$i<=$lvNumDate+1;$i++)
		{
			$vDows=date('w', strtotime($datecur))+1;
			if($vDows==1)
			{
				$this->DateSun++;
				$this->lvHeader=$this->lvHeader.'<td class="tdhprint" style="background:#d3d3d3"><center><b>'.Fillnum(getday($datecur),2).'</b></center></td>';
				$this->lvHeader1=$this->lvHeader1.$vTD_TrangThaiBold;
				$this->lvFooter=$this->lvFooter.'<td style="background:#d3d3d3"><center>'."<!--F-".str_replace("/","-",$datecur)."-->".'</center></td>';
				$strTD=$strTD.''."<!--".str_replace("/","-",$datecur)."-->".'';
				$this->strTDF=$this->strTDF.'<td style="background:#d3d3d3">&nbsp;</td>';
			}
			else
			{
				$this->lvHeader=$this->lvHeader.'<td class="tdhprint"><center><b>'.Fillnum(getday($datecur),2).'</b></center></td>';
				$strTD=$strTD.''."<!--".str_replace("/","-",$datecur)."-->".'';
				$this->strTDF=$this->strTDF.'<td>&nbsp;</td>';
				$this->lvHeader1=$this->lvHeader1.$vTD_TrangThai;
				$this->lvFooter=$this->lvFooter.'<td ><center>'."<!--F-".str_replace("/","-",$datecur)."-->".'</center></td>';
			}
			$datecur=ADDDATE($this->datefrom,$i);
		}
		return $strTD;
	}
	function Get_String_DateFromTo31()
	{
		$this->lvHeader="";
		$strTD="";
		$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
		$datecur=$this->datefrom;
		$vTD_TrangThai='<td >Thời gian scan</td><td>Trạng thái</td><td>Scan</td><td>Không scan</td>';
		$vTD_TrangThaiBold='<td  style="background:#d3d3d3">Thời gian scan</td><td style="background:#d3d3d3">Trạng thái</td><td style="background:#d3d3d3">Scan</td><td style="background:#d3d3d3">Không scan</td>';
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
				$this->lvFooter=$this->lvFooter.'<td style="background:#d3d3d3" colspan="4" style="background:#d3d3d3"><center>'."<!--F-".str_replace("/","-",$datecur)."-->".'</center></td>';
				$strTD=$strTD."<!--".str_replace("/","-",$datecur)."-->";
			}
			else
			{
				$this->DateWork++;
				$this->lvHeader=$this->lvHeader.'<td style="background:#d3d3d3" colspan="4" class="tdhprint"><center><b>'.Fillnum(getday($datecur),2).'</b></center></td>';
				$this->lvHeader1=$this->lvHeader1.$vTD_TrangThai;
				$strTD=$strTD."<!--".str_replace("/","-",$datecur)."-->";
				$this->lvFooter=$this->lvFooter.'<td style="background:#d3d3d3" colspan="4"><center>'."<!--F-".str_replace("/","-",$datecur)."-->".'</center></td>';
			}
			$datecur=ADDDATE($this->datefrom,$i);
		}
		return $strTD;
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
		if($this->lv029!="")  $strCondi=$strCondi." and A.lv029 in (".$this->LV_GetChildDep($this->lv029).")";
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
		if($this->lv028!="") {
			$strCondi=$strCondi." and B.lv002 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv009 in ('".str_replace(",","','",$this->lv028)."')").")";
		} 


/*--extent-----*/
if($this->lv028!="")
			$vExtCondi=" AND  DD.lv009 in ('".str_replace(",","','",$this->lv028)."') ";
		if($this->lv029!="")  $vExtCondi=$vExtCondi." AND DD.lv029 in (".$this->LV_GetChildDep($this->lv029).")";
		if($this->lv030!="")  $vExtCondi=$vExtCondi." AND DD.lv001 in ('".$this->lv030."')";
		if($this->isStaffOff==1)  
			{
				$vExtCondi=$vExtCondi." AND ((DD.lv044>='$this->datefrom' AND Year(DD.lv044)>2000)  OR (Year(DD.lv044)<2000))";
			}
		switch($this->isViet)
		{
			case 0:
				break;
			case 1:
				$strCondi=$vExtCondi." and DD.lv022='VIETNAM'";
				break;
			case 2:
				$strCondi=$vExtCondi." and DD.lv022<>'VIETNAM'";
				break;
		}

/*--End Extent------*/
		if($this->lv029!="")  $strCondi=$strCondi." and B.lv002 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where 1=1 $vExtCondi and DD.lv029 in (".$this->LV_GetChildDep($this->lv029).")").")";
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
			case 'lv099':
				$vsql="select lv001,concat(lv006,' - ',lv004,lv003,lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
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