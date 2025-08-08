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
	public $ArrTCEmp=null;
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
//////////////////////Buil list////////////////////
	function LV_BuilListReportOtherPrintLateSoon($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvopt)
	{		
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
		$sqlS = "SELECT A.lv002,A.lv003,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,A.lv015,B.lv002 NVID,C.lv029 lv001,D.lv007 Shift FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 left join hr_lv0020 C on C.lv001=B.lv002 left join tc_lv0008 D on D.lv002=B.lv002  and year(D.lv005)=year(A.lv004) WHERE 1=1  ".$this->GetConditionOrther()."  order by C.lv029 ASC,A.lv004 ASC";
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
			$arrShift=$this->GetTimeListArr($vrow['NVID'],$vrow['lv004']);
			$lvcheck=$this->LV_CheckLateSoon($vrow['NVID'],$vrow['lv015'],$vrow['Shift'],$arrShift);
			$this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]=(int)$this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]+1;
			$strL="";
			$vorder++;
			$lvstrgt="";
			foreach($lvparatimecard as $lvgt)
			{
				switch ($lvgt)
				{
					case 5:
						if($this->lvState==0)
							$lvstrgt=$lvstrgt.$vrow['lv005']."<br/>";
						else
							$lvstrgt=$lvstrgt.(($an)?'RH:':'').'<b>'.$vrow['lv005']."</b><br/>";
						break;
					case 6:
						if($this->lvState==0)
							$lvstrgt=$lvstrgt.$vrow['lv006']."<br/>";
						else
							$lvstrgt=$lvstrgt.(($an)?'OH:':'').'<b>'.$vrow['lv006']."</b><br/>";
						break;
					case 7:
						if($this->lvState==0)
							$lvstrgt=$lvstrgt.$vrow['lv007']."<br/>";
						else
						$lvstrgt=$lvstrgt.(($an)?'Code:':'').'<b>'.$vrow['lv007']."</b><br/>";
						break;
					case 15:
						if($this->lvState==0)
							$lvstrgt=$lvstrgt.$vrow['lv015']."<br/>";
						else
						$lvstrgt=$lvstrgt.(($an)?'Shift:':'').'<b>'.$vrow['lv015']."</b><br/>";
						break;
					case 20:
						if($this->lvState==0)
						{
							if($lvopt==2)
								$lvstrgt=$lvstrgt.$this->GetTimeListMore($vrow['NVID'],$vrow['lv004'],$lvopt)."<br/>";
							else	
								$lvstrgt=$lvstrgt.$this->GetTimeList($vrow['NVID'],$vrow['lv004'],$lvopt)."<br/>";
						}
						else 
						{
							if($lvopt==2)
								$lvstrgt=$lvstrgt.(($an)?'In-Out:':'').'<b>'.$this->GetTimeListMore($vrow['NVID'],$vrow['lv004'],$lvopt)."</b><br/>";
							else
								$lvstrgt=$lvstrgt.(($an)?'In-Out:':'').'<b>'.$this->GetTimeList($vrow['NVID'],$vrow['lv004'],$lvopt)."</b><br/>";
						}
						break;
					case 21:
						if($this->lvState==0)
							$lvstrgt=$lvstrgt.$lvcheck."<br/>";
						else
						$lvstrgt=$lvstrgt.(($an)?'State:':'').'<b>'.$lvcheck."</b><br/>";
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
			}
		//$strTrH=str_replace("@#01",$strH,$lvTrH);
		return $this->Get_BuildList_Array();
	}
	function Get_BuildList_Array()
	{
		if($this->lvSort==1)
		$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[15]."</b></td><td class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[16]."</b></td><td class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[14]."</b></td>".$this->lvHeader."<td class=\"tdhprint\" width=\"10%\" align=\"center\">Tổng công</td>
			</tr>
			@01
		</table>
		";
		else
			$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[14]."</b></td><td class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[15]."</b></td><td class=\"tdhprint\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[16]."</b></td>".$this->lvHeader."<td class=\"tdhprint\" width=\"10%\" align=\"center\">Tổng công</td>	
			</tr>
			@01
		</table>
		";
		$lvListTrAll="";
		for($i=0;$i<count($this->ArrEmp);$i++)
		{
			if($this->lvSort==1)
				$lvListTrAll=$lvListTrAll."<tr><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][2]."</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][4])."<td align=right>".$this->LV_GetTCEmpSum($this->ArrEmp[$i][0])."</td></tr>";	
			else
				$lvListTrAll=$lvListTrAll."<tr><td nowrap='nowrap'>".$this->ArrEmp[$i][2]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td>".str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][4])."<td align=right>".$this->LV_GetTCEmpSum($this->ArrEmp[$i][0])."</td></tr>";
		}
		return str_replace("@01",$lvListTrAll,$vTable);
	}
	function GetTimeListArr($vlv001,$vlv002)
	{
		$strReturn=array();
		$lvsql="select lv003,lv005 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002'  and lv006<>1 order by lv003 ASC";
		$vresult=db_query($lvsql);
		$count=db_num_rows($vresult);
		if($vresult){
			$i=1;
			while($vrow=db_fetch_array($vresult))
			{
				if(($i==1))
				{
					$strReturn[0]=(int)str_replace(":","",$vrow['lv003']);
				}
				else if($i==$count)
				{
					$strReturn[1]=(int)str_replace(":","",$vrow['lv003']);
				}
			$i++;
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
			//Lay gio ca
			$sqlShift = "select * from tc_lv0004 where lv001='$shiftDay'";
			$db_Shift = db_query($sqlShift);
			$objShift = db_fetch_array ($db_Shift);
			$shift_start=(int)str_replace(":","",$objShift['lv003']);
			$shift_end=(int)str_replace(":","",$objShift['lv004']);
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
			//Lay gio ca
			$sqlShift = "select * from tc_lv0004 where lv001='$shiftYear'";
			$db_Shift = db_query($sqlShift);
			$objShift = db_fetch_array ($db_Shift);
			$shift_start=(int)str_replace(":","",$objShift['lv003']);
			$shift_end=(int)str_replace(":","",$objShift['lv004']);
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
	function GetTimeListMore($vlv001,$vlv002,$opt=0)
	{
		$strReturn="";
		$lvsql="select lv001,lv002,lv003,lv004,lv005,lv006 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002'  and lv006<>1 order by lv003 ASC";
		$vresult=db_query($lvsql);
		$count=db_num_rows($vresult);
			if($vresult){
			$i=1;
			while($vrow=db_fetch_array($vresult))
			{
			if(($i==1 || $i==$count) || $opt==0)
			{
				if($strReturn=="")
				{
					if(trim($vrow['lv005'])=='' || $vrow['lv005']==NULL)
						$strReturn=$strReturn.'<a href="javascript:'.(($vrow['lv006']=='1')?'undeltime':(($vrow['lv006']=='0' && $vrow['lv004']=='OTO')?'deltime':'overtime')).'(\''.$vrow['lv001'].'\',\''.$vrow['lv002'].'\',\''.$vrow['lv003'].'\',\''.$vid.'\')"><font style="'.(($vrow['lv006']=='1')?'text-decoration:line-through;':(($vrow['lv006']=='0' && $vrow['lv004']=='OTO')?'color:red':'color:blue;')).'">'.substr($vrow['lv003'],0,5)."</font></a>";
					else
					{
						$strReturn=$strReturn.'<a href="javascript:'.(($vrow['lv006']=='1')?'undeltime':(($vrow['lv006']=='0' && $vrow['lv004']=='OTO')?'deltime':'overtime')).'(\''.$vrow['lv001'].'\',\''.$vrow['lv002'].'\',\''.$vrow['lv003'].'\',\''.$vid.'\')">'.'<font style="color:red;text-decoration:underline" title="'.GetUserName($vrow['lv005'],$this->lang).'('.$vrow['lv005'].')'.'"><font style="'.(($vrow['lv006']=='1')?'text-decoration:line-through;':(($vrow['lv006']=='0' && $vrow['lv004']=='OTO')?'color:red':'color:blue')).'">'.substr($vrow['lv003'],0,5)."</font></font></a>";
					}
				}
				else
				{
					if(trim($vrow['lv005'])=='' || $vrow['lv005']==NULL)
					$strReturn=$strReturn." | ".'<a href="javascript:'.(($vrow['lv006']=='1')?'undeltime':(($vrow['lv006']=='0' && $vrow['lv004']=='OTO')?'deltime':'overtime')).'(\''.$vrow['lv001'].'\',\''.$vrow['lv002'].'\',\''.$vrow['lv003'].'\',\''.$vid.'\')"><font style="'.(($vrow['lv006']=='1')?'text-decoration:line-through;':(($vrow['lv006']=='0' && $vrow['lv004']=='OTO')?'color:red':'color:blue')).'">'.substr($vrow['lv003'],0,5)."</font></a>";
					else
					$strReturn=$strReturn."->".'<a href="javascript:'.(($vrow['lv006']=='1')?'undeltime':(($vrow['lv006']=='0' && $vrow['lv004']=='OTO')?'deltime':'overtime')).'(\''.$vrow['lv001'].'\',\''.$vrow['lv002'].'\',\''.$vrow['lv003'].'\',\''.$vid.'\')">'.'<font style="color:red;text-decoration:underline" title="'.GetUserName($vrow['lv005'],$this->lang).'('.$vrow['lv005'].')'.'"><font style="'.(($vrow['lv006']=='1')?'text-decoration:line-through;':(($vrow['lv006']=='0' && $vrow['lv004']=='OTO')?'color:red':'color:blue')).'">'.substr($vrow['lv003'],0,5)."</font></font></a>";
				}
				}
				$i++;
			}
		}
		$strReturn="<span style='padding:3px;white-space: nowrap;'>".$strReturn."</span>";
		return $strReturn;
	}
	function GetTimeList($vlv001,$vlv002,$opt=0)
	{
		$strReturn="";
		$lvsql="select lv003,lv005 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002'  and lv006<>1 order by lv003 ASC";
		$vresult=db_query($lvsql);
		$count=db_num_rows($vresult);
		if($vresult){
			$i=1;
			while($vrow=db_fetch_array($vresult))
			{
				if(($i==1 || $i==$count) || $opt==0)
			{
				if($strReturn=="")
				{
					if(trim($vrow['lv005'])=='' || $vrow['lv005']==NULL)
					$strReturn=$strReturn.$vrow['lv003'];
					else
					{
						$strReturn=$strReturn.'<font style="color:red;text-decoration:underline" title="'.GetUserName($vrow['lv005'],$this->lang).'('.$vrow['lv005'].')'.'">'.$vrow['lv003']."</font>";
					}
				}
				else
				{
					if(trim($vrow['lv005'])=='' || $vrow['lv005']==NULL)
					$strReturn=$strReturn."->".$vrow['lv003'];
					else
					$strReturn=$strReturn."->".'<font style="color:red;text-decoration:underline" title="'.GetUserName($vrow['lv005'],$this->lang).'('.$vrow['lv005'].')'.'">'.$vrow['lv003']."</font>";
				}
			}
			$i++;
			}
		}
		return $strReturn;
	}
	function Get_Arr_Employees()
	{
		$this->ArrEmp=array();
		$this->ArrEmpBack=array();
		$strTd=$this->Get_String_DateFromTo();
		$lvcondition="";
		
		if($this->lv028!="")
			$strCondi=" AND  DD.lv009 in ('".str_replace(",","','",$this->lv028)."') ";
		if($this->lv029!="")  $strCondi=$strCondi." AND DD.lv029 in ('".str_replace(",","','",$this->lv029)."')";
		if($this->lv030!="")  $strCondi=$strCondi." AND DD.lv001 in ('".$this->lv030."')";
		if($this->lvSort==0)
			$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv029 Dep from hr_lv0020 DD where 1=1 $strCondi  order by DD.lv029";
		else 
			$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv029 Dep from hr_lv0020 DD where 1=1 $strCondi  order by DD.lv001";
		$vresult=db_query($lvsql);	
		$i=0;
		while($vrow=db_fetch_array($vresult))
		{
			$this->ArrEmp[$i][0]=$vrow['CodeID'];
			$this->ArrEmp[$i][1]=$vrow['Name'];
			$this->ArrEmp[$i][2]=$vrow['Dep'];
			$this->ArrEmp[$i][3]=$this->Str_DateFromTo;
			$this->ArrEmp[$i][4]=$strTd;
			$this->ArrEmpBack[$vrow['CodeID']]=$i;
			$i++;
		}
	}
	function Get_String_DateFromTo()
	{
		$this->lvHeader="";
		$strTD="";
		$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
		$datecur=$this->datefrom;
		for($i=1;$i<=$lvNumDate+1;$i++)
		{
			$this->lvHeader=$this->lvHeader.'<td class="tdhprint"><center><b>'.Fillnum(getday($datecur),2).'</b></center></td>';
			$strTD=$strTD.'<td><center>'."<!--".str_replace("/","-",$datecur)."-->".'</center></td>';
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
		if($this->lv029!="")  $strCondi=$strCondi." and A.lv002 in (".$this->GetMultiValue("select CC.lv001 from tc_lv0010 CC where CC.lv002 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where (DD.lv009=0 or DD.lv009=1) and DD.lv029 in ('".str_replace(",","','",$this->lv029)."')").")").")";
		return $strCondi;
	}
	protected function GetConditionOrther()
	{
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		//if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->datefrom!="")  $strCondi=$strCondi." and A.lv004  >= '$this->datefrom'";
		if($this->dateto!="")  $strCondi=$strCondi." and A.lv004  <= '$this->dateto'";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and A.lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and A.lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and A.lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and A.lv010 like '%$this->lv010%'";
		if($this->lv028!="")  $strCondi=$strCondi." and A.lv002 in (".$this->GetMultiValue("select CC.lv001 from tc_lv0010 CC where CC.lv002 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv009 in ('".str_replace(",","','",$this->lv028)."')").")").")";
		if($this->lv029!="")  $strCondi=$strCondi." and A.lv002 in (".$this->GetMultiValue("select CC.lv001 from tc_lv0010 CC where CC.lv002 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv029 in ('".str_replace(",","','",$this->lv029)."')").")").")";
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