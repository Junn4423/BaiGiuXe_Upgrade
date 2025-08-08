<?php
/////////////coding hr_lv0042///////////////
class   hr_lv0042 extends lv_controler
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
	
///////////
	public $DefaultFieldList="lv001,lv002,lv032,lv004,lv005,lv006,lv008,lv009,lv020,lv021,lv022,lv023,lv010,lv013,lv027,lv012";	
////////////////////GetDate
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='hr_lv0042';
	public $Dir="";
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv012"=>"13","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv032"=>"33","lv013"=>"14","lv027"=>"28");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"1","lv006"=>"0","lv007"=>"0","lv008"=>"2","lv009"=>"2","lv020"=>"10","lv021"=>"10","lv022"=>"10","lv023"=>"10","lv027"=>"0");	
	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;
		$this->isRpt=0;		
	 	$this->isFil=1;	
		$this->lang=$_GET['lang'];
		
	}
	function LV_Disable()
	{
		$this->isAdd=0;
		$this->isEdit=0;
		$this->isDel=0;
	}
	function LV_Load()
	{
		$vsql="select * from  hr_lv0042";
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
	function LV_GetAnAll()
	{		
		$this->isAdd=0;	
		$this->isEdit=0;	
		$this->isDel=0;	
		$this->isApr=0;	
		$this->isUnApr=0;
		$this->isRpt=0;		
	}
		protected function LV_CheckLock()
	{
		$lvsql="select lv009 from hr_lv0038 B where  B.lv001='$this->lv003'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if($vrow['lv009']>=1)
			{
				$this->isAdd=0;	
				$this->isEdit=0;	
				$this->isDel=0;	
			}
		}
		
	}
	function LV_LoadContractApr($lv002)
	{
		$lvsql="select lv001 from  hr_lv0038 Where lv002='$lv002' and lv009=1";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['lv001'];
		}
		return '**';
		
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  hr_lv0042 Where lv001='$vlv001'";
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
	function LV_XyLyDeleteChangeOK($vDNPC,$vStaffID,$vSoTien,$vDVi,$vDateFrom,$vDateTo,$vMaTK='1192')
	{
		$lvsql="delete from  hr_lv0042 Where lv002='$vStaffID' and lv012='$vDNPC' and lv013=0";
		$vresult=db_query($lvsql);
		if($vresult)
		{
			$this->InsertLogOperation($this->DateCurrent,'hr_lv0042.delete',sof_escape_string($lvsql));
			$this->LV_CreateAuutoDNPC($vDNPC,$vStaffID,$vSoTien,$vDVi,$vDateFrom,$vDateTo,$vMaTK);
		}
	}
	function LV_XyLyDeleteNoCreate($vDNPC,$vStaffID)
	{
		$lvsql="delete from  hr_lv0042 Where lv002='$vStaffID' and lv012='$vDNPC' and lv027<=0";
		$vresult=db_query($lvsql);
		if($vresult)
		{
			$this->InsertLogOperation($this->DateCurrent,'hr_lv0042.delete',sof_escape_string($lvsql));
		}
	}
	function LV_XyLyDeleteChange($vDNPC,$vStaffID,$vSoTien,$vDVi,$vDateFrom,$vDateTo,$vMaTK='1192')
	{
		$lvsql="delete from  hr_lv0042 Where lv002='$vStaffID' and lv012='$vDNPC' and (lv008<>'$vDateFrom' or lv009<>'$vDateTo')";//and lv013=0 
		$vresult=db_query($lvsql);
		if($vresult)
		{
			$this->InsertLogOperation($this->DateCurrent,'hr_lv0042.delete',sof_escape_string($lvsql));
			$this->LV_CreateAuutoDNPC($vDNPC,$vStaffID,$vSoTien,$vDVi,$vDateFrom,$vDateTo,$vMaTK);
		}
	}
	function LV_CreateAuutoDNPC($vDNPC,$vStaffID,$vSoTien,$vDVi,$vDateFrom,$vDateTo,$vMaTK='1192')
	{
		$lvsql="select count(*) nums from  hr_lv0042 Where lv002='$vStaffID' and lv012='$vDNPC'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow['nums']==0)
		{
			$vSoThang=$this->LV_SoThang($vDateFrom,$vDateTo);
			if($vSoThang==0) $vSoThang=1;
			$this->lv002=$vStaffID;
			$this->lv004=$vMaTK;
			$this->lv005=$vSoTien/$vSoThang;	
			$this->lv006=$vDVi;
			$this->lv008=$vDateFrom;
			$this->lv009=$vDateTo;
			$this->lv012=$vDNPC;
			$this->LV_InsertAuto();
		}
		return 0;
	}
	
	function LV_LoadBasicSal($EmpID,$vContactID)
	{
		$lvsql="select sum(lv005) SumM from  hr_lv0042 Where lv002='$EmpID' and lv003='$vContactID' and lv004='101'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv001=$vrow['SumM'];
			return $this->lv001;
			
		}
		return 0;
	}
	public function LV_LoadPara($vlv002,$vlv003,$vlv004)
	{
		$lvsql="select * from  hr_lv0042 Where lv002='$vlv002' and lv003='$vlv003' and lv004='$vlv004'";
		$vresult=db_query($lvsql);
		if($vresult)
		{
			$vrow=db_fetch_array($vresult);
			return $this->FormatView($vrow['lv005'],1).$this->getvaluelink('lv006',$vrow['lv006']);
		}
		return "&nbsp;";
	}
	function LV_Insert()
	{
		if($this->isAdd==0) return false;
		$this->lv007=$this->GetType($this->lv004);
		$this->lv008 = ($this->lv008!="")?recoverdate(($this->lv008), $this->lang):$this->DateDefault;
		$this->lv009 = ($this->lv009!="")?recoverdate(($this->lv009), $this->lang):$this->DateDefault;
		$lvsql="insert into hr_lv0042 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv096,lv097) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->LV_UserID',now())";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0042.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_InsertAuto()
	{
		if($this->isAdd==0) return false;
		$this->lv007=$this->GetType($this->lv004);
		//$this->lv008 = ($this->lv008!="")?recoverdate(($this->lv008), $this->lang):$this->DateDefault;
		//$this->lv009 = ($this->lv009!="")?recoverdate(($this->lv009), $this->lang):$this->DateDefault;
		$lvsql="insert into hr_lv0042 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv096,lv097) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->LV_UserID',now())";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0042.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function GetType($vlv001)
	{
		$lvsql="select lv003 from  hr_lv0037 Where lv001='$vlv001'";
		$vresult=db_query($lvsql);
		if($vresult)
		{
			$vrow=db_fetch_array($vresult);
			return $vrow['lv003'];
		}
		return 0;
	}
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		$this->lv008 = ($this->lv008!="")?recoverdate(($this->lv008), $this->lang):$this->DateDefault;
		$this->lv009 = ($this->lv009!="")?recoverdate(($this->lv009), $this->lang):$this->DateDefault;
		$this->lv007=$this->GetType($this->lv004);
		$lvsql="Update hr_lv0042 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='".sof_escape_string($this->lv010)."' where  lv001='$this->lv001' and  lv013=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0042.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM hr_lv0042  WHERE hr_lv0042.lv001 IN ($lvarr) and lv013=0";// and (select count(*) from hr_lv0042 B where  B.lv002= hr_lv0042.lv001)<=0  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0042.delete',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update hr_lv0042 set lv013=1,lv027=1  WHERE hr_lv0042.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0042.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_UnAproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update hr_lv0042 set lv013=0,lv027=0  WHERE hr_lv0042.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0042.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
	/////lv admin deletet
	
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
	//////////Get Filter///////////////
	protected function GetCondition()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and lv001 like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and lv002 like '%$this->lv002%'";
		if($this->lv002!="") 
		{
			if(!strpos($this->lv002,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv002);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( lv002 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR lv002 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and lv002  like '%$this->lv002%'";
			}
		}
		//($this->lv003!="") $strCondi=$strCondi." and lv003 = '$this->lv003'";
		if($this->lv004!="") $strCondi=$strCondi." and lv004 like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and lv005 like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and lv006 like '%$this->lv006%'";
		if($this->lv008!="") $strCondi=$strCondi." and lv008 like '%$this->lv008%'";
		if($this->lv009!="") $strCondi=$strCondi." and lv009 like '%$this->lv009%'";
		if($this->lv010!="") $strCondi=$strCondi." and lv010 like '%$this->lv010%'";
		
		if($this->DateFrom!="" && $this->DateTo!="")
		{
			$strCondi=$strCondi." and (
			(lv008>= '".recoverdate($this->DateFrom,$this->lang)."' and lv009<= '".recoverdate($this->DateTo,$this->lang)."')
			or
			(lv008>= '".recoverdate($this->DateFrom,$this->lang)."' and lv008<= '".recoverdate($this->DateTo,$this->lang)."')
			or
			(lv009>= '".recoverdate($this->DateFrom,$this->lang)."' and lv009<= '".recoverdate($this->DateTo,$this->lang)."')
			or
			(lv008<= '".recoverdate($this->DateFrom,$this->lang)."' and lv009>= '".recoverdate($this->DateTo,$this->lang)."')
			)
			";
		}
		else if($this->DateFrom!="")
		{
			$strCondi=$strCondi." and lv008>= '".recoverdate($this->DateFrom,$this->lang)."'";
		}
		else if($this->DateTo!="") 
		{
			$strCondi=$strCondi." and lv008<= '".recoverdate($this->DateTo,$this->lang)."'";
		}
		if($this->lv012!="") $strCondi=$strCondi." and lv012 = '$this->lv012'";
		return $strCondi;
	}
		////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM hr_lv0042 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_SoThang($vDateFrom,$vDateTo)
	{
		$vYearFrom=getyear($vDateFrom);
		$vMonthFrom=getmonth($vDateFrom);
		$vYearTo=getyear($vDateTo);
		$vMonthTo=getmonth($vDateTo);
		if($vYearFrom==$vYearTo)
		{
			$vSoThang=$vMonthTo-$vMonthFrom+1;
		}
		else
		{
			if(($vYearTo-$vYearFrom)==1)
			{
				$vSoThang=$vMonthTo+(12-$vMonthFrom+1);
			}
			else
			{
				$vSoThang=$vMonthTo+(12-$vMonthFrom+1)+($vYearTo-$vYearFrom-1)*12;
			}
		}
		return $vSoThang;
	}
	function LV_GetSumLuong($vStaffID,$vDateFrom,$vDateTo,$vType,$vSoTien=0)
	{
		$vSoTien=(float)$vSoTien;
		$vDateFrom=substr($vDateFrom,0,8).'01';
		switch($vType)
		{
			case 5:
				$sqlC = "SELECT sum(IF(lv027>$vSoTien,$vSoTien,lv027)) TongTien FROM tc_lv0021 WHERE lv002='$vStaffID' and lv004>='$vDateFrom' and lv004<='$vDateTo' ";
				break;
			default:
				$sqlC = "SELECT sum(IF(lv009>$vSoTien,$vSoTien,lv009)) TongTien FROM tc_lv0021 WHERE lv002='$vStaffID' and lv004>='$vDateFrom' and lv004<='$vDateTo' ";
				break;
		}
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['TongTien'];
	}
			//////////////////////Buil list////////////////////
	function LV_BuilList($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		if($curRow<0) $curRow=0;	$this->LV_CheckLock();
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
		<table  align=\"center\" class=\"lvtable\">
		<!--<tr ><td colspan=\"".(2+count($lstArr))."\" class=\"lvTTable\">".$this->ArrPush[0]."</td></tr>-->
		<tr class=\"cssbold_tab\"><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>".$this->ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrderList,$lvSortNum)."</td></tr>
		@#01
		@#02
		<tr ><td colspan=\"".(count($lstArr)+2)."\">$paging</td></tr>
		<tr class=\"cssbold_tab\"><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</td></tr>
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
			<td width=1%><input name=\"$lvChkAll\" type=\"checkbox\" id=\"$lvChkAll\" onclick=\"DoChkAll($lvFrom, '$lvChk', this)\" value=\"$curRow\" tabindex=\"2\"/></td>
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			<td width=1%><input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckOne($lvFrom, '$lvChk', '$lvChkAll', this)\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"/></td>
			@#01
		</tr>
		";
		$lvHref="<a href=\"javascript:FunctRunning1('@01')\" style=\"text-decoration:none\">@02</a>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"2\">&nbsp;</td>";
		$sqlS = "SELECT *,lv002 lv032 FROM hr_lv0042 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strTr="";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				$vTempF=str_replace("@01","<!--".$lstArr[$i]."-->",$lvTdF);
				$strF=$strF.$vTempF;
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			
			$isTrue=true;
			if($this->IsHU0T==1)
			{
				$vrow['lv020']=$this->LV_SoThang($vrow['lv008'],$vrow['lv009']);
				$vrow['lv021']=$vrow['lv020']*$vrow['lv005'];
				$vrow['lv022']=$this->LV_GetSumLuong($vrow['lv002'],$vrow['lv008'],$vrow['lv009'],$vrow['lv007'],$vrow['lv005']);
				if(($vrow['lv021']-$vrow['lv022'])<=500 && ($vrow['lv021']-$vrow['lv022'])>=-500) $isTrue=false;

			}
			if($isTrue)
			{
				$vorder++;
				$vrow['lv020']=$this->LV_SoThang($vrow['lv008'],$vrow['lv009']);
				$slv020=$slv020+$vrow['lv020'];
				$vrow['lv021']=$vrow['lv020']*$vrow['lv005'];
				$slv021=$slv021+$vrow['lv021'];
				$vrow['lv022']=$this->LV_GetSumLuong($vrow['lv002'],$vrow['lv008'],$vrow['lv009'],$vrow['lv007'],$vrow['lv005']);
				$slv022=$slv022+$vrow['lv022'];
				$vrow['lv023']=$vrow['lv021']-$vrow['lv022'];
				$slv023=$slv023+$vrow['lv023'];
				for($i=0;$i<count($lstArr);$i++)
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					$strL=$strL.$vTemp;
				}
				$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			}
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv020-->",$this->FormatView($slv020,10),$strF);
		$strF=str_replace("<!--lv021-->",$this->FormatView($slv021,10),$strF);
		$strF=str_replace("<!--lv022-->",$this->FormatView($slv022,10),$strF);
		$strF=str_replace("<!--lv023-->",$this->FormatView($slv023,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH.$strTr,$lvTable);
	}
/////////////////////ListFieldExport//////////////////////////
	function ListFieldExport($lvFrom,$lvList,$maxRows)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=",".$lvList.",";
		$lstArr=explode(",",$this->DefaultFieldList);
		$lvSelect="<ul id=\"menu1-nav\" onkeyup=\"return CheckKeyCheckTabExp(event)\">
						<li class=\"menusubT1\"><img src=\"$this->Dir../images/lvicon/config.png\" border=\"0\" />".$this->ArrFunc[12]."
							<ul id=\"submenu1-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript="		
		<script language=\"javascript\">
		function Export(vFrom,value)
		{
			window.open('$this->Dir'+'hr_lv0042/?lang=".$this->lang."&childfunc='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
	function LV_BuilListReportView($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
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
		<div align=\"left\"><h1>".($this->ArrPush[0])."</h2></div>
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
		$sqlS = "SELECT *,lv002 lv032 FROM hr_lv0042 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strTr="";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH.$strTr,$lvTable);
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
			if($lvArrOrder[$i]==NULL || $lvArrOrder[$i]=="")
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
	public function GetBuilCheckList($vListID,$vID,$vTabIndex)
	{
		$vListID=",".$vListID.",";
		$strTbl="<table  align=\"center\" class=\"lvtable\">
		<input type=\"hidden\" id=$vID name=$vID value=\"@#02\">
		@#01
		</table>
		<script language=\"javascript\">
		function getChecked(len,nameobj,namevalue)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{
				div1 = document.getElementById(namevalue+i);
				if(str=='') 
					str=(namevalue=='')?div.value:div1.value;
				else
					 str=str+','+(namevalue=='')?div.value:div1.value;
				}
			
			}
			return str;
		}
		</script>
		";
		$lvChk="<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH="<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>
			
		</tr>
		";
		$vsql="select * from  hr_lv0004";
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
			{
				$strTempChk=str_replace("@03","",$strTempChk);
			}
			else
			{
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			}
			
			$strTempChk=str_replace("@04",$vrow['lv003'],$strTempChk);
			
			$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
			$strTemp=str_replace("@#02",$vrow['lv002']."(".$vrow['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
						$i++;
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
//////////////////////Buil list////////////////////
	function LV_BuilListReport($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
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
		$lvTable="<!--<div align=\"center\"><img  src=\"".$this->GetLogo()."\" style=\"max-width:1024px\" /></div>-->
		<div align=\"center\"><h1>".($this->ArrPush[0])."</h2></div>
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
		$sqlS = "SELECT *,lv002 lv032 FROM hr_lv0042 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strTr="";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$vrow['lv020']=$this->LV_SoThang($vrow['lv008'],$vrow['lv009']);
			$slv020=$slv020+$vrow['lv020'];
			$vrow['lv021']=$vrow['lv020']*$vrow['lv005'];
			$slv021=$slv021+$vrow['lv021'];
			$vrow['lv022']=$this->LV_GetSumLuong($vrow['lv002'],$vrow['lv008'],$vrow['lv009'],$vrow['lv007'],$vrow['lv005']);
			$slv022=$slv022+$vrow['lv022'];
			$vrow['lv023']=$vrow['lv021']-$vrow['lv022'];
			$slv023=$slv023+$vrow['lv023'];
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH.$strTr,$lvTable);
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
			case 'lv003':
				$vsql="select lv001,concat(lv004,'->',lv005) lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0038 where lv002='$this->lv002' and lv009=0";
				break;
			case 'lv004':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0037 ";
				break;
			case 'lv006':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018 order by lv004";
				break;
		}
		return $vsql;
	}
	public function getvaluelink($vFile,$vSelectID)
	{
		if($this->ArrGetValueLink[$vFile][$vSelectID][0]) return $this->ArrGetValueLink[$vFile][$vSelectID][1];
		if($vSelectID=="")
		{
			return $vSelectID;
		}
		switch($vFile)
		{
			case 'lv013':
				$vsql="select * from
				(select 0 lv001,'Chưa khoá' lv002,IF('0'='$vSelectID',1,0) lv003 
				union
				select 1 lv001,'Đã khoá' lv002,IF('1'='$vSelectID',1,0) lv003) MP where lv003=1 
				";
				break;
			case 'lv027':
				$vsql="select * from
				(
				select 0 lv001,'Chưa duyệt' lv002,IF('0'='$vSelectID',1,0) lv003 
				union
				select 1 lv001,'Đã duyệt' lv002,IF('1'='$vSelectID',1,0) lv003 ) MP where lv003=1 
				";
				break;
			case 'lv032':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv003':
				if($this->lv002=="")
					$vsql="select lv001,concat(lv004,'->',lv005) lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0038 where lv001='$vSelectID'";
				else
					$vsql="select lv001,concat(lv004,'->',lv005) lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0038 where lv002='$this->lv002' and lv001='$vSelectID'";
					$lvopt=1;
				break;
			case 'lv004':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0037 where lv001='$vSelectID'";
				break;
			case 'lv006':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018 where lv001='$vSelectID'";
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