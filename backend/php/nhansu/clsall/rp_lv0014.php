<?php
class rp_lv0014 extends lv_controler{
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
	public $lvNVID=null;
	public $lvShiID=null;
	public $lvReShiID=null;
	public $month=null;
	public $year=null;
	public $is_tc09_add=null;
	public $is_tc09_apr=null;
	public $ArrTC=null;
	public $ArrTCEmp=null;
	public $ArrDeptSave=null;

///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='tc_lv0043';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"2","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0");	

	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;
	 	$this->isFil=1;	
		
		$this->isUnApr=0;
		$this->lang=$_GET['lang'];
		$this->ArrDeptSave=Array();
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
		return "";
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM tc_lv0011 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function SetAllDisiable()
	{
		$this->isAdd=0;
		$this->isEdit=0;
		$this->isApr=0;
		$this->isUnApr=0;
		
	}
	//////////////////////Buil list////////////////////
	function Get_String_DateFromTo()
	{
		$this->lvHeader="";
		$this->lvHeader1="";
		$strTD="";
		$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
		$datecur=$this->datefrom;
		$childfunc=$_GET['childfunc'];
		$vstar=1;
		if($lvNumDate==0)
		{
			$vstar=(int)getday($datecur);
			$lvNumDate=$vstar-1;
		}
		for($i=$vstar;$i<=$lvNumDate+1;$i++)
		{
			$vdayofw=GetDayOfWeek($datecur);
			if($vdayofw==1) 
				$color='yellow';
			else if($vdayofw==7) 
				$color='orange';
			else 
			{
				if($_GET['childfunc']=="pdf")
					$color='white';
				else
					$color='black';
			}
			if($_GET['day']=='')
			{
				if($this->opt==0) 
					$this->lvHeader=$this->lvHeader.'<td class="lvhtable" align="center"  COLSPAN="2"><b><font color="'.$color.'">'.Fillnum($i,2).'</font></b></td>';
				else
					$this->lvHeader=$this->lvHeader.'<td class="lvhtable" align="center" ><b><font color="'.$color.'">'.Fillnum($i,2).'</font></b></td>';
				if($this->opt==0 || $this->opt==1)$this->lvHeader1=$this->lvHeader1.'<td  align="center"></td>';
				if($this->opt==0 || $this->opt==2) $this->lvHeader1=$this->lvHeader1.'<td  align="center">Giờ</td>';
			}
			else
			{
				if($_GET['day']==$i)
				{
				if($this->opt==0) 
					$this->lvHeader=$this->lvHeader.'<td class="lvhtable" align="center"  COLSPAN="2"><b><font color="'.$color.'">'.Fillnum($i,2).'</font></b></td>';
				else
					$this->lvHeader=$this->lvHeader.'<td class="lvhtable" align="center" ><b><font color="'.$color.'">'.Fillnum($i,2).'</font></b></td>';
				if($this->opt==0 || $this->opt==1)$this->lvHeader1=$this->lvHeader1.'<td  align="center"></td>';
				if($this->opt==0 || $this->opt==2) $this->lvHeader1=$this->lvHeader1.'<td  align="center">Giờ ăn</td>';
				}
			}
			if($this->opt==0 || $this->opt==1)
				$strTD=$strTD.'<td align="center">'."<!--".str_replace("/","-",$datecur)."-->".'</td>';
			if($this->opt==0 || $this->opt==2)
				$strTD=$strTD.'<td align="center">'."<!--_".str_replace("/","-",$datecur)."-->".'</td>';
			
			$datecur=ADDDATE($this->datefrom,$i);
		}
		$this->MoreCols=$i-1;
		return $strTD;
	}
	function Get_Arr_EmployeesShift()
	{
		$this->ArrEmp=array();
		$this->ArrEmpBack=array();
		$strTd=$this->Get_String_DateFromTo();
		$lvcondition="";
		
		$strCondi=" AND  DD.lv009 not in ('2','3') ";
		if($this->lv028!="")  $strCondi=$strCondi." AND DD.lv008 in ('".str_replace(",","','",$this->lv028)."')";
		if($this->lv029!="")  $strCondi=$strCondi." AND DD.lv029 in ('".str_replace(",","','",$this->lv029)."')";
		if($this->lv001!="")  $strCondi=$strCondi." AND DD.lv001 in ('".str_replace(",","','",$this->lv001)."')";
		if($this->lv030!="")  $strCondi=$strCondi." AND DD.lv001 in ('".$this->lv030."')";
		if($this->lvSort==0)
			$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv029 Dep,EE.lv007 HeSoL,EE.lv008 DangGia,EE.lv005 Locks,EE.lv094 Meal,EE.lv001 MonthID from hr_lv0020 DD left join tc_lv0009 EE on DD.lv001=EE.lv002 and EE.lv003='$this->month' and EE.lv004='$this->year' where 1=1 $strCondi  order by DD.lv029";
		else 
			$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv029 Dep,EE.lv007 HeSoL,EE.lv008 DangGia,EE.lv005 Locks,EE.lv094 Meal,EE.lv001 MonthID from hr_lv0020 DD DD left join tc_lv0009 EE on DD.lv001=EE.lv002 and EE.lv003='$this->month' and EE.lv004='$this->year' where 1=1 $strCondi  order by DD.lv001";
		$vresult=db_query($lvsql);	
		$i=0;
		while($vrow=db_fetch_array($vresult))
		{
			$this->ArrEmp[$i][0]=$vrow['CodeID'];
			$this->ArrEmp[$i][1]=$vrow['Name'];
			$this->ArrEmp[$i][2]=$vrow['Dep'];
			$this->ArrEmp[$i][3]=$this->Str_DateFromTo;
			$this->ArrEmp[$i][4]=$strTd;
			$this->ArrEmp[$i][9]=$vrow['Meal'];
			$this->ArrEmpBack[$vrow['CodeID']]=$i;
			$i++;
		}
	}
	function Get_Arr_Employees()
	{
		$this->ArrEmp=array();
		$this->ArrEmpBack=array();
		$strTd=$this->Get_String_DateFromTo();
		$lvcondition="";
		$strCondi=" AND  DD.lv009 not in ('2','3') ";
		if($this->lv028!="")  $strCondi=$strCondi." AND DD.lv008 in ('".str_replace(",","','",$this->lv028)."')";
		if($this->lv029!="") 
		{
			$lsguser=$this->LV_GetDep($this->lv029);
			$strCondi=$strCondi." AND DD.lv029 in (".$lsguser.")";
		}
		if($this->lv001!="")  $strCondi=$strCondi." AND DD.lv001 in ('".str_replace(",","','",$this->lv001)."')";
		if($this->lv030!="")  $strCondi=$strCondi." AND DD.lv001 in ('".$this->lv030."')";
		if($this->lvSort==0)
			$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv062 Nhom,DD.lv029 Dep,EE.lv007 HeSoL,EE.lv008 DangGia,EE.lv005 Locks,EE.lv001 MonthID,EE.lv094 Meal,EE.lv027 MealNV,EE.lv012 MealT2,EE.lv013 MealT3,EE.lv014 MealT4,EE.lv015 MealT5,EE.lv027 MealNV,EE.lv022 MealNVT2,EE.lv023 MealNVT3,EE.lv024 MealNVT4,EE.lv025 MealNVT5 from hr_lv0020 DD left join tc_lv0009 EE on DD.lv001=EE.lv002 and EE.lv003='$this->month' and EE.lv004='$this->year' where 1=1 $strCondi  order by DD.lv029";
		else 
			$lvsql="select DD.lv001 CodeID,DD.lv002 Name,DD.lv062 Nhom,DD.lv029 Dep,EE.lv007 HeSoL,EE.lv008 DangGia,EE.lv005 Locks,EE.lv001 MonthID,EE.lv094 Meal,EE.lv027 MealNV,EE.lv012 MealT2,EE.lv013 MealT3,EE.lv014 MealT4,EE.lv015 MealT5,EE.lv027 MealNV,EE.lv022 MealNVT2,EE.lv023 MealNVT3,EE.lv024 MealNVT4,EE.lv025 MealNVT5 from hr_lv0020 DD DD left join tc_lv0009 EE on DD.lv001=EE.lv002 and EE.lv003='$this->month' and EE.lv004='$this->year' where 1=1 $strCondi  order by DD.lv001";
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
				
			
			$this->ArrEmp[$i][11]=$vrow['Nhom'];
			if(strpos(" ,".$this->comkh.",",',1,')>0)
				$this->ArrEmp[$i][9]=$vrow['Meal'];	
			else
				$this->ArrEmp[$i][9]=0;	
			if(strpos(" ,".$this->comkh.",",',2,')>0)
				$this->ArrEmp[$i][12]=$vrow['MealT2'];
			else
				$this->ArrEmp[$i][12]=0;
			if(strpos(" ,".$this->comkh.",",',3,')>0)
				$this->ArrEmp[$i][13]=$vrow['MealT3'];
			else
				$this->ArrEmp[$i][13]=0;
			if(strpos(" ,".$this->comkh.",",',4,')>0)
				$this->ArrEmp[$i][14]=$vrow['MealT4'];
			else
				$this->ArrEmp[$i][14]=0;
			if(strpos(" ,".$this->comkh.",",',5,')>0)
				$this->ArrEmp[$i][15]=$vrow['MealT5'];
			else
				$this->ArrEmp[$i][15]=0;
			if(strpos(" ,".$this->comnv.",",',1,')>0)
				$this->ArrEmp[$i][10]=$vrow['MealNV'];
			else
				$this->ArrEmp[$i][10]=0;
			if(strpos(" ,".$this->comnv.",",',2,')>0)
				$this->ArrEmp[$i][22]=$vrow['MealNVT2'];
			else
				$this->ArrEmp[$i][22]=0;
			if(strpos(" ,".$this->comnv.",",',3,')>0)
				$this->ArrEmp[$i][23]=$vrow['MealNVT3'];
			else
				$this->ArrEmp[$i][23]=0;
			if(strpos(" ,".$this->comnv.",",',4,')>0)
				$this->ArrEmp[$i][24]=$vrow['MealNVT4'];
			else
				$this->ArrEmp[$i][24]=0;
			if(strpos(" ,".$this->comnv.",",',5,')>0)
				$this->ArrEmp[$i][25]=$vrow['MealNVT5'];
			else
				$this->ArrEmp[$i][25]=0;
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
		$vsql="select lv001,lv003 lv002 from  tc_lv0025 where lv002 in (select A.lv001 from tc_lv0013 A where A.lv011=1) ";
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
	function LV_BuilListReportOtherPrintLateSoon($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvopt,$lvgt=0)
	{		
		$this->Get_Arr_Employees();
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=$lvList.",lv012";
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$vEmpOK=Array();
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
		if($this->datefrom!="") $vcondition=$vcondition." and A.lv004 >='$this->datefrom'";
		if($this->dateto!="") $vcondition=$vcondition." and A.lv004 <='$this->dateto'";
		if($this->lv028<>"")
		{
		$lsguser="'".$this->lv028."'";
		$vcondition= " and C.lv008 in ($lsguser)";
		}
		if($this->lv001!="") 		$vcondition=$vcondition." AND C.lv001 in ('".str_replace(",","','",$this->lv001)."')";		
		if($this->lv029<>"")
		{
			$lsguser=$this->LV_GetDep($this->lv029);
			$strCondi=$strCondi." AND DD.lv029 in (".$lsguser.")";
		}
		//if(trim($_GET['day'])!="") $vcondition=$vcondition." and A.lv004 <='$this->dateto'";
		$lvHref="@02";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT A.lv002,A.lv003,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,B.lv002 NVID,C.lv029 lv001,A.lv001 TimeCardId  FROM tc_lv0011 A inner join tc_lv0010 B on A.lv002=B.lv001 inner join hr_lv0020 C on C.lv001=B.lv002 WHERE  A.lv100<>1 $vcondition order by C.lv029 ASC,A.lv004 ASC";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$vArr[1]['lv001']='';
		$vArr[1]['lv002']='';
		$vArr[2]['lv001']='1';
		$vArr[2]['lv002']='1';
		$an=rand(0,1);
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
			}
		while ($vrow = db_fetch_array ($bResult)){
			$lvvt=$this->ArrEmpBack[$vrow['NVID']];
			$strL="";
			$vorder++;
			$lvstrgt="";
			$lvstrgt=(trim($vrow['lv010'])=="")?"&nbsp;":$vrow['lv010'];
			$lvstrgt1=(trim($vrow['lv008'])=="")?"&nbsp;":'<font color="red">'.$vrow['lv008'].'</font>';
			$this->ArrTC[$vrow['lv010']]=(int)$this->ArrTC[$vrow['lv010']]+1;		
			$vGetCount=0;
			$vTimesMeal=$this->GetTimeList($vrow['NVID'],$vrow['lv004'],1,$vGetCount);
			$this->ArrEmp[$lvvt][6]=str_replace("<!--".$vrow['lv004']."-->",(($vGetCount==0)?'&nbsp;':$vGetCount),$this->ArrEmp[$lvvt][6]);
			$this->ArrTCEmp[$vrow['NVID']]['COM']=(int)$this->ArrTCEmp[$vrow['NVID']]['COM']+(int)$vGetCount;
			$this->ArrDeptSave[$vrow['lv001']][0]=$this->ArrDeptSave[$vrow['lv001']][0]+(int)$vGetCount;
			if($vEmpOK[$vrow['NVID']]!=true) 
			{
				$this->ArrDeptSave[$vrow['lv001']][0]=$this->ArrDeptSave[$vrow['lv001']][0]+(int)$this->ArrEmp[$lvvt][10]+(int)$this->ArrEmp[$lvvt][22]+(int)$this->ArrEmp[$lvvt][23]+(int)$this->ArrEmp[$lvvt][24]+(int)$this->ArrEmp[$lvvt][25];
				$this->ArrDeptSave[$vrow['lv001']][1]=$this->ArrDeptSave[$vrow['lv001']][1]+(int)$this->ArrEmp[$lvvt][9]+(int)$this->ArrEmp[$lvvt][12]+(int)$this->ArrEmp[$lvvt][13]+(int)$this->ArrEmp[$lvvt][14]+(int)$this->ArrEmp[$lvvt][15];
				$vEmpOK[$vrow['NVID']]=true;
			}
			
			if($this->opt==0 || $this->opt==1) 
				{
					$this->ArrTCEmp[$vrow['NVID']][$vrow['lv010']]=(int)$this->ArrTCEmp[$vrow['NVID']][$vrow['lv010']]+1;
					$this->ArrTCEmp[$vrow['lv001']][$vrow['lv010']]=(int)$this->ArrTCEmp[$vrow['lv001']][$vrow['lv010']]+1;
					$this->ArrEmp[$lvvt][6]=str_replace("<!--".$vrow['lv004']."-->",''.(($vGetCount==0)?'&nbsp;':$vGetCount),$this->ArrEmp[$lvvt][6]);
				}
			if($this->opt==0)
				{
					$this->ArrTCEmp[$vrow['NVID']][$vrow['lv008']]=(int)$this->ArrTCEmp[$vrow['NVID']][$vrow['lv008']]+1;
					$this->ArrTCEmp[$vrow['lv001']][$vrow['lv008']]=(int)$this->ArrTCEmp[$vrow['lv001']][$vrow['lv008']]+1;
					$this->ArrEmp[$lvvt][6]=str_replace("<!--_".$vrow['lv004']."-->",$vTimesMeal,$this->ArrEmp[$lvvt][6]);
				}
			}
		switch($lvopt)
		{
		case 0:
		case 1:
			return $this->Get_BuildList_Array($lvFrom);
			break;
		case 2:
			
			return $this->Get_BuildList_ArraySum($lvFrom);
			break;
		}
	}
	function Get_BuildList_ArraySum($lvFrom)
	{
	$this->isAdd=0;
	$this->isEdit=0;
	$childfunc=$_GET['childfunc'];
	$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
	if($this->month==1)
	{
		$this->predateto=($this->year-1)."-12-".Fillnum(GetDayInMonth($this->year,12),2);
		$this->predatefrom=($this->year-1)."-12-01";
		$this->premonth=12;
		$this->preyear=$this->year-1;
	}
	else
	{
		$this->predateto=$this->year."-".Fillnum(($this->month-1),2)."-".Fillnum(GetDayInMonth($this->year,($this->month-1)),2);
		$this->predatefrom=$this->year."-".Fillnum(($this->month-1),2)."-01";
		$this->premonth=$this->month-1;
		$this->preyear=$this->year;
	}
	
			$vTable='
			
			<br/><center>
			<p style="width: 760px;text-align:right;font:12px Arial, tahoma;"><strong>Currency Unit: VND</strong></p> 
			<table  style="width: 760px;"   align="center" class="tblprint" id="tabletc" border="1" cellpadding="0" cellspacing="0">
<colgroup>
<col width="6%"></col> 
<col width="18%"></col>
 <col width="12%"></col>
 <col width="12%"></col> 
 <col width="24%"></col> 
 <col width="30%"></col> </colgroup> 
<tbody>
<tr height="21">
<td class="lvhtable" rowspan="2" height="42" >&nbsp;NO.&nbsp;</td>
<td class="lvhtable" rowspan="2" >&nbsp;DEPT.&nbsp;</td>
<td class="lvhtable"  colspan="2" >MAIN   MEAL</td>
<td class="lvhtable" rowspan="2"  >&nbsp;TOTAL&nbsp;</td>
<td class="lvhtable" rowspan="2"  >&nbsp;NOTE&nbsp;</td>
</tr>
<td class="lvhtable" align="center" width="12%">&nbsp;STAFF&nbsp;</td>
<td class="lvhtable" align="center" width="12%">&nbsp;CL<br /> / TRAINEE&nbsp;</td>
</tr>
@01
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;Total&nbsp;</td>
<td align=right style="padding:3px">@67</td>
<td align=right  style="padding:3px">@68</td>
<td align=right  style="padding:3px">@70</td>
<td >&nbsp;</td>
</tr>
</tbody>
</table>

<br/>

<table style="width: 760px;"   align="center" class="tblprint" id="tabletc" border="1" cellpadding="0" cellspacing="0">
<colgroup> <col width="164"></col> <col width="110"></col> <col width="238"></col> <col width="145"></col> <col width="285"></col> </colgroup> 
<tbody>
<tr height="42">
<td width="164">VOUCHER CATEGORY</td>
<td width="110">PRICE (VND)</td>
<td width="238">QUANTITY</td>
<td width="145">TOTAL (VND)</td>
<td width="285" ondblclick="this.innerHTML=\'\'">&nbsp;   From: '.$this->FormatView($this->predatefrom,2).' - '.$this->FormatView($this->predateto,2).'</td>
</tr>
<tr height="21"  style="padding:3px">
<td>Main Meal&nbsp;</td>
<td align=right  style="padding:3px"> '.$this->FormatView($this->motc_lv0013->lv025,10).'</td>
<td align=right   style="padding:3px">@69</td>
<td align=right  style="padding:3px">@70</td>
<td width="285" align=right   ondblclick="this.innerHTML=\'\'"  style="padding:3px">@71</td>
</tr>
<tr height="21">
<td>Tổng cộng</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td width="285">&nbsp;</td>
</tr>	
</table>
<table style="width: 760px;"   align="center" class="tblprint" id="tabletc" border="0" cellpadding="0" 
<tr height="21">
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td >&nbsp;</td>
</tr>
<tr height="20">
<td colspan="2" height="20" align=center>Prepared   by</td>
<td align=center>Checked by</td>
<td>&nbsp;</td>
<td align=center>Canteen Supplier</td>
<td align=center>Approved by</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td >&nbsp;</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td colspan="2" height="20" align=center><input style="backround:#fff;border:0px;text-align:center" type="textbox" value="Phạm   Thị Thúy Hằng"/></td>
<td colspan="2" align=center><input style="backround:#fff;border:0px;text-align:center" type="textbox" value="Trần Thị Thu Thúy"/></td>
<td>&nbsp;</td>
<td >&nbsp;</td>
</tr>
<tr height="20">
<td colspan="2" height="20" align=center>HR   Officer</td>
<td align=center>AHR Manager</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
</center>

		';

		$vTrStr='
		<tr style="background-color:@11" height="21">
			<td style="padding:3px" align="left">@#01</td>
			<td style="padding:3px" align="left">@#02</td>
			<td style="padding:3px" align="right">@#03</td>
			<td style="padding:3px" align="right">@#04</td>		
			<td style="padding:3px" align="right">@#05</td>
			<td style="padding:3px" align="left"><input style="backround:none;border:0px;text-align:center" type="textbox" value=""/></td>
		</tr>
';
		$vArr=$this->LV_GetRate();
		$lvListTrAll="";
		$vDepartment="";
		$StrMulSub="";
		$vSumAn=0;
		$vSumKhach=0;
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
			$vSLAn=(float)$this->ArrDeptSave[$vrow['lv001']][0];
			$vSLKhach=(float)$this->ArrDeptSave[$vrow['lv001']][1];
			$vReturn=$vReturn."<option value='".$vrow['lv001']."' ".(($vSelectID==$vrow['lv001'])?'selected="selected"':'').">".$vrow['lv003']."</option>";
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
				$vSLAn=$vSLAn+(float)$this->ArrDeptSave[$vrow1['lv001']][0];
				$vSLKhach=$vSLKhach+(float)$this->ArrDeptSave[$vrow1['lv001']][1];
				$vSLAn1=0;
				$vSLKhach1=0;
				$vSLAn1=$vSLAn1+(float)$this->ArrDeptSave[$vrow1['lv001']][0];
				$vSLKhach1=$vSLKhach1+(float)$this->ArrDeptSave[$vrow1['lv001']][1];
				
				$i2=1;
				$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow1['lv001']."' order by lv003";
				$bResult2=db_query($vsql);
				while ($vrow2 = db_fetch_array ($bResult2)){
					$LineTrStrEmp=$vTrStr;
					$color='#fff';
					$LineTrStrEmp=str_replace("@11",$color,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#01",$i.".".$i1.".".$i2,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#02",$vrow2['lv003'],$LineTrStrEmp);
					$vSLAn=$vSLAn+(float)$this->ArrDeptSave[$vrow2['lv001']][0];
					$vSLKhach=$vSLKhach+(float)$this->ArrDeptSave[$vrow2['lv001']][1];
					$vSLAn1=$vSLAn1+(float)$this->ArrDeptSave[$vrow2['lv001']][0];
					$vSLKhach1=$vSLKhach1+(float)$this->ArrDeptSave[$vrow2['lv001']][1];
					$LineTrStrEmp=str_replace("@#03",$this->FormatView($this->ArrDeptSave[$vrow2['lv001']][0],10),$LineTrStrEmp);
					
					$LineTrStrEmp=str_replace("@#04",$this->FormatView($this->ArrDeptSave[$vrow2['lv001']][1],10),$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#05",$this->FormatView(($this->ArrDeptSave[$vrow2['lv001']][0]+$this->ArrDeptSave[$vrow2['lv001']][1])*$this->motc_lv0013->lv025,10),$LineTrStrEmp);
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
						$vSLAn=$vSLAn+(float)$this->ArrDeptSave[$vrow3['lv001']][0];
						$vSLKhach=$vSLKhach+(float)$this->ArrDeptSave[$vrow3['lv001']][1];
						$vSLAn1=$vSLAn1+(float)$this->ArrDeptSave[$vrow3['lv001']][0];
						$vSLKhach1=$vSLKhach1+(float)$this->ArrDeptSave[$vrow3['lv001']][1];
						$LineTrStrEmp=str_replace("@#03",$this->FormatView($this->ArrDeptSave[$vrow3['lv001']][0],10),$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#04",$this->FormatView($this->ArrDeptSave[$vrow3['lv001']][1],10),$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#05",$this->FormatView(($this->ArrDeptSave[$vrow3['lv001']][0]+$this->ArrDeptSave[$vrow3['lv001']][1])*$this->motc_lv0013->lv025,10),$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#06",'&nbsp;',$LineTrStrEmp);
						$StrMulSub1=$StrMulSub1.$LineTrStrEmp;
						$i3++;
					}
					$i2++;
				}
				$LineTrStrEmp1=str_replace("@#03",$this->FormatView($vSLAn1,10),$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#04",$this->FormatView($vSLKhach1,10),$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#05",$this->FormatView(($vSLAn1+$vSLKhach1)*$this->motc_lv0013->lv025,10),$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#06",'&nbsp;',$LineTrStrEmp1);
				$StrMulSub=$StrMulSub.$LineTrStrEmp1;
				$StrMulSub=$StrMulSub.$StrMulSub1;
				$i1++;
			}
			$vSumAn=$vSumAn+$vSLAn;
			$vSumKhach=$vSumKhach+$vSLKhach;
			$LineTrStrParent=str_replace("@#03",$this->FormatView($vSLAn,10),$LineTrStrParent);
			$LineTrStrParent=str_replace("@#04",$this->FormatView($vSLKhach,10),$LineTrStrParent);
			$LineTrStrParent=str_replace("@#05",$this->FormatView(($vSLAn+$vSLKhach)*$this->motc_lv0013->lv025,10),$LineTrStrParent);
			$LineTrStrParent=str_replace("@#06",'&nbsp;',$LineTrStrParent);
			$lvListTrAll=$lvListTrAll.$LineTrStrParent;
			$lvListTrAll=$lvListTrAll.$StrMulSub;
			$i++;
		}
		$vTable=str_replace("@67",$this->FormatView($vSumAn,10),$vTable);
		$vTable=str_replace("@68",$this->FormatView($vSumKhach,10),$vTable);
		$vTable=str_replace("@69",$this->FormatView($vSumAn+$vSumKhach,10),$vTable);
		$vTable=str_replace("@70",$this->FormatView(($vSumAn+$vSumKhach)*$this->motc_lv0013->lv025,10),$vTable);
		$vMoneyCom=$this->GetComPreviousMonth($this->premonth,$this->preyear);
		$vTable=str_replace("@71",$this->FormatView($vMoneyCom,10),$vTable);
		return str_replace("@01",$lvListTrAll,str_replace("#02",$this->FormatView($vSum,10),$vTable));
	}
	function GetComPreviousMonth($month,$year)
	{
		$vsql="select count(*) nums from  tc_lv0060 Where year(lv002)='$year' and month(lv002)='$month' and lv006=0";
		$lvResult = db_query($vsql);
		$row= db_fetch_array($lvResult);
		return $row['nums']*$this->motc_lv0013->lv025;
		
	}
	function LV_GetTCEmp($vEmpID)
	{
		$str="";
		$values=$this->ArrTCEmp[$vEmpID];
		if($values!=NULL) 
		{uksort($values, 'strcasecmp');
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
	function LV_GetTCEmp1($vEmpID)
	{
		$str="";
		$values=$this->ArrTCEmp[$vEmpID];
		if($values!=NULL) 
		{
		uksort($values, 'strcasecmp');
		while (list($key, $value) = each($values)) { 	
			if($key==1)
			{
				return $value;
			}
		}	
		}
		return 0;
	}
	function GetTimeList($vlv001,$vlv002,$opt=0,&$GetCount=0)
	{
		$strReturn="";
		if($opt==0)
		{
			$lvsql="select lv003,lv005 from  tc_lv0060 Where lv001='$vlv001' and lv002='$vlv002' and lv006=0  order by lv003 ASC";
		}
		else
		{
			$lvsql="select lv003,lv005 from  tc_lv0060 Where lv001='$vlv001' and lv002='$vlv002' and lv006=0  order by lv003 ASC";
		}
		$vresult=db_query($lvsql);
		$i=1;
		$count=db_num_rows($vresult);
		if($vresult){
		
			while($vrow=db_fetch_array($vresult))
			{//if(($i==1 || $i==$count) || $opt==0)
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
					$strReturn=$strReturn." | ".$vrow['lv003'];
					else
					$strReturn=$strReturn." | ".'<font style="color:red;text-decoration:underline" title="'.GetUserName($vrow['lv005'],$this->lang).'('.$vrow['lv005'].')'.'">'.$vrow['lv003']."</font>";
				}
			}
			$i++;
			}
		}
		$GetCount=$i-1;
		$strReturn="<span style='padding:3px;white-space: nowrap;'>".$strReturn."</span>";
		return $strReturn;
	}
	function Get_BuildList_Array($lvFrom)
	{
	$this->isAdd=0;
	$this->isEdit=0;
	$childfunc=$_GET['childfunc'];
	$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
		if($this->lvSort==1)		
		$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\" id=\"tabletc\">
			<tr height=\"30px\">
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[1]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[2]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[3]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>Nhóm</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[4]."</b></td>".$this->lvHeader."<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>Cơm khách</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[30]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[39]."</b></td>		
			</tr>
			<tr>
				".$this->lvHeader1."		
			</tr>
			@01
			<tr>
				<td><strong>Tổng:</strong></td><td><strong>#02</strong></td><td colspan=5>&nbsp;</td>
			</tr>
		</table>
		";
		else
			$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\" id=\"tabletc\">
			<tr height=\"30px\">
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[1]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[3]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[2]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[4]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>Nhóm</b></td>".$this->lvHeader."<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>Cơm khách</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[30]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[39]."</b></td>
			</tr>
			<tr>
				".$this->lvHeader1."		
			</tr>
			@01
			<tr>
				<td><strong>Tổng:</strong></td><td colspan=\"".($this->MoreCols+5)."\"><strong>#02</strong></td>
			</tr>
		</table>
		";

		
		$vArr=$this->LV_GetRate();
		$lvListTrAll="";
		$vDepartment="";
		$vSum=0;
		for($i=0;$i<count($this->ArrEmp);$i++)
		{
			if($this->ArrEmp[$i][2]!="" && $this->ArrEmp[$i][2]!=NULL)
			{
			if($i%2==0) $color='#fff';
			else $color='#EAEAEA';
			//$vp_col1_1="<td nowrap='nowrap'>".$this->FormatView($this->ArrEmp[$i][3],10)."</td><td nowrap='nowrap'>".$this->GetValueArr($vArr,$this->ArrEmp[$i][4])."</td>";
			//$vp_col2_2="<td nowrap='nowrap'>".$this->ArrEmp[$i][7]."</td>$vp_col1_1";
			//$vp_col3_1="<td nowrap='nowrap'>".$this->FormatView($this->ArrEmp[$i][3],10)."</td><td nowrap='nowrap'>".$this->GetValueArr($vArr,$this->ArrEmp[$i][4]).""."</td>";
			//$vp_col3_3="<td nowrap='nowrap'>".$this->FormatView($this->ArrEmp[$i][3],10)."</td><td nowrap='nowrap'>".$this->GetValueArr($vArr,$this->ArrEmp[$i][4])."</td>";
			$vComKH=$this->ArrEmp[$i][9]+(int)$this->ArrEmp[$i][12]+(int)$this->ArrEmp[$i][13]+(int)$this->ArrEmp[$i][14]+(int)$this->ArrEmp[$i][15];
			$vCurCom=((int)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['COM']+$this->ArrEmp[$i][9]+$this->ArrEmp[$i][10]+$this->ArrEmp[$i][12]+$this->ArrEmp[$i][13]+$this->ArrEmp[$i][14]+$this->ArrEmp[$i][15]+$this->ArrEmp[$i][22]+$this->ArrEmp[$i][23]+$this->ArrEmp[$i][24]+$this->ArrEmp[$i][25]);
			$vp_col4=str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][6]);
			$vp_col5="<td nowrap='nowrap'>".(($vComKH==0)?'&nbsp;':$vComKH)."</td><td nowrap='nowrap'>".(($vCurCom==0)?'&nbsp;':$vCurCom)."</td><td>&nbsp;</td></tr>";
			$vSum=$vSum+((int)$this->ArrTCEmp[$this->ArrEmp[$i][0]]['COM']+$this->ArrEmp[$i][9]+$this->ArrEmp[$i][10]+$this->ArrEmp[$i][12]+$this->ArrEmp[$i][13]+$this->ArrEmp[$i][14]+$this->ArrEmp[$i][15]+$this->ArrEmp[$i][22]+$this->ArrEmp[$i][23]+$this->ArrEmp[$i][24]+$this->ArrEmp[$i][25]);
			if($this->ArrEmp[$i][2]==$vDepartment)
			{
				$vp_col1="<td nowrap='nowrap'>".($i+1)."</td><td nowrap='nowrap'>&nbsp;</td><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][11]."</td>";		
			}
			else
			{
				
				$vp_col1="<td nowrap='nowrap'>".($i+1)."</td><td nowrap='nowrap'>".$this->getvaluelink('lv001',$this->ArrEmp[$i][2])."(".($this->ArrEmp[$i][2]).")"."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][11]."</td>";		
				$vDepartment=$this->ArrEmp[$i][2];
			}
			
			$lvListTrAll=$lvListTrAll."<tr style='background-color:".$color."'>$vp_col1$vp_col2_2".$vp_col4.$vp_col5."</tr>";
			}
		}
		
		return str_replace("@01",$lvListTrAll,str_replace("#02",$this->FormatView($vSum,10),$vTable));
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
	public function LV_LinkField($vFile,$vSelectlv001)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectlv001),2));
	}
	private function sqlcondition($vFile,$vSelectlv001)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv002':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  tc_lv0013";
				break;
			case 'lv001':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  hr_lv0002";
				break;
		}
		return $vsql;
	}
	public  function getvaluelink($vFile,$vSelectlv001)
	{
		switch($vFile)
		{
			case 'lv002':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  tc_lv0013 where lv001='$vSelectlv001'";
				break;
			case 'lv001':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  hr_lv0002 where lv001='$vSelectlv001'";
				break;
			default:
				$vsql ="";
				break;
		}
		if($vsql=="")
		{
			return $vSelectlv001;
		}
		else
		$lvResult = db_query($vsql);
		while($row= db_fetch_array($lvResult)){
		return ($lvopt==0)?$row['lv002']:(($lvopt==1)?$row['lv001']."(".$row['lv002'].")":(($lvopt==2)?$row['lv002']."(".$row['lv001'].")":$row['lv001']));
		}
		
	}
}
	?>