<?php
/////////////coding tc_lv0041///////////////
class   tc_lv0041 extends lv_controler
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
	public $lvNVID=null;
	public $lvShiID=null;
	public $lvReShiID=null;
	public $month=null;
	public $year=null;
	public $is_tc09_add=null;
	public $is_tc09_apr=null;
	public $ArrTC=null;
	public $ArrTCEmp=null;
	public $ArrDayOfWeek=null;
///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='tc_lv0041';
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
		$this->ArrDayOfWeek=Array();
		
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
	function LV_Update()
	{
		if(!$this->LV_CheckLocked($this->lv004)) return false;
		$lvsql="Update tc_lv0011 set lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv010='$this->lv010' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) {			
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0041.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_UpdateCode($vlv001,$vlv007)
	{
		$this->LV_LoadID($vlv001);
		if(!$this->LV_CheckLocked($this->lv004)) return false;
		$lvsql="Update tc_lv0011 set lv007='$vlv007' where  lv001='$vlv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) {			
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0041.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_UpdateProject($vlv001,$vlv021)
	{
		$this->LV_LoadID($vlv001);
		if(!$this->LV_CheckLocked($this->lv004)) return false;
		$lvsql="Update tc_lv0011 set lv021='$vlv021' where  lv001='$vlv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) {			
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0041.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_UpdateShift($vlv001,$vlv015)
	{
		$this->LV_LoadID($vlv001);
		if(!$this->LV_CheckLocked($this->lv004)) return false;
		$lvsql="Update tc_lv0011 set lv015='$vlv015' where  lv001='$vlv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) {			
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0041.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_UpdateShiftAuto($vlv001,$vlv015)
	{
		$this->LV_LoadID($vlv001);
		if(!$this->LV_CheckLocked($this->lv004)) return false;
		$lvsql="Update tc_lv0011 set lv089='$vlv015' where  lv001='$vlv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) {			
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0041.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_UpdateTimeWork($vlv001,$vlv005)
	{
		$this->LV_LoadID($vlv001);
		if(!$this->LV_CheckLocked($this->lv004)) return false;
		$lvsql="Update tc_lv0011 set lv005='$vlv005' where  lv001='$vlv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) {			
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0041.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_UpdateOverTime($vlv001,$vlv014)
	{
		$this->LV_LoadID($vlv001);
		if(!$this->LV_CheckLocked($this->lv004)) return false;
		$lvsql="Update tc_lv0011 set lv014='$vlv014' where  lv001='$vlv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) {			
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0041.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_UpdateClearTime($vlv001,$vlv016)
	{
		$this->LV_LoadID($vlv001);
		if(!$this->LV_CheckLocked($this->lv004)) return false;
		$lvsql="Update tc_lv0011 set lv016='$vlv016' where  lv001='$vlv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) {			
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0041.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_UpdateGioBu($vlv001,$vlv017)
	{
		$this->LV_LoadID($vlv001);
		if(!$this->LV_CheckLocked($this->lv004)) return false;
		$lvsql="Update tc_lv0011 set lv017='$vlv017' where  lv001='$vlv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) {			
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0041.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_UpdateGioSau22h($vlv001,$vlv018)
	{
		$this->LV_LoadID($vlv001);
		if(!$this->LV_CheckLocked($this->lv004)) return false;
		$lvsql="Update tc_lv0011 set lv018='$vlv018' where  lv001='$vlv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) {			
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0041.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_UpdateEat($vlv001,$vlv010)
	{
		$this->LV_LoadID($vlv001);
		if(!$this->LV_CheckLocked($this->lv004)) return false;
		$lvsql="Update tc_lv0011 set lv010='$vlv010' where  lv001='$vlv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) {			
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0041.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_OrtherInsert($lvNVID,$vlv004,$vlv007,$vlv008)
	{
		if($this->LV_CheckExistMonth($vlv004)<=0)
		{
		$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv007,lv008) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv007','$vlv008')";
		
		$vReturn= db_query($lvsql);
		if($vReturn){
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
			 return $vReturn;
			}
		}
		$lvsql = "Update tc_lv0009 set lv007='$vlv007',lv008='$vlv008'  WHERE lv003=month('$vlv004') and lv004=year('$vlv004') and lv002='$lvNVID' ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0041.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Aproval($vlv004)
	{
		if($this->isApr==0) return false;
		if($this->LV_CheckExistMonth($vlv004)<=0)
		{
			$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),1,'".getInfor($this->UserID,2)."')";
			$vReturn= db_query($lvsql);
			if($vReturn){
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
			 return $vReturn;
			}
		}
		$lvsql = "Update tc_lv0009 set lv005=1  WHERE lv003=month('$vlv004') and lv004=year('$vlv004') ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0041.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_UnAproval($vlv004)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0009 set lv005=0  WHERE lv003=month('$vlv004') and lv004=year('$vlv004')  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0041.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_CheckExistMonth($vlv004)
	{
		$lvsql = "select count(*) nums from tc_lv0009  WHERE lv003=month('$vlv004') and lv004=year('$vlv004') and lv002='$this->lvNVID'  ";
		$bResultC = db_query($lvsql);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_CheckLocked($vlv004)
	{
		 $lvsql="select lv005 from  tc_lv0009 Where lv003=month('$vlv004') and lv004=year('$vlv004') and lv002='$this->lvNVID'";
		$vresult=db_query($lvsql);
		if($vresult){
		$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				if($vrow['lv005']<=0) 
					return true;
				else 
					return false;
			}
			else
			{
			return true;
			}
		}else
		{
			
			return true;
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
		$sqlC = "SELECT COUNT(*) AS nums FROM tc_lv0011 WHERE lv100<>1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
			//////////////////////Buil list////////////////////
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
		$lvHref="@02";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM tc_lv0011 WHERE lv100<>1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	function LV_BuilListInput($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		$this->LV_CheckLock();
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
		if($this->LV_CheckLocked($this->lv004."-01"))
		{
			$vSave="<a class=\"lvtoolbar\" href=\"javascript:Save();\" tabindex=\"47\"><img src=\"../images/controlright/save_f2.png\"  alt=\"Save\" title=\"<?php echo $vLangArr[1];?>\" name=\"save\" border=\"0\" align=\"middle\" id=\"save\" /> <?php echo $vLangArr[2];?></a>";
			$this->isUnApr=0;
		}
		else
		{
			$this->isApr=0;
		}
		$lvTable="
		<table  align=\"center\" class=\"lvtable\">
		<!--<tr ><td colspan=\"".(2+count($lstArr))."\" class=\"lvTTable\">".$this->ArrPush[0]."</td></tr>-->
		<tr ><td colspan=\"".(count($lstArr)-2)."\" align=right>".$vSave."</td><td colspan=\"2\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>".$this->ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrderList,$lvSortNum)."</td></tr>
		@#01
		<tr ><td colspan=\"".(count($lstArr)+2)."\">$paging</td></tr>
		<tr ><td colspan=\"".(count($lstArr)-2)."\" align=right>".$vSave."</td><td colspan=\"2\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</td></tr>
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
		$lvHref="@02";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td >@02</td>";
		$lvTdInput="<td ><input id=\"@03\" name=\"@03\" value=\"@02\" tabindex=2 class=\"lvsizeinput\" onKeyUp=\"return CheckKeyCheckOther(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@13,'@14')\"></td>";
		$lvTdInput2="<td ><input id=\"@03\" name=\"@03\" value=\"@02\" tabindex=2 class=\"lvsizeinput2\" onKeyUp=\"return CheckKeyCheckOther(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@13,'@14')\"></td>";
		$lvTdSelect="<td ><select id=\"@03\" name=\"@03\"  tabindex=2 class=\"lvsizeselect\">@02</select>";
		$lvTdSelect2="<td ><select id=\"@03\" name=\"@03\"  tabindex=2 class=\"lvsizeselect2\">@02</select>";
		$lvTdInputHidden="<td >@02<input type=hidden id=\"@03\" name=\"@03\" value=\"@02\" ></td>";
		$sqlS = "SELECT lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,DAYOFWEEK(lv004) DOW FROM tc_lv0011 WHERE lv100<>1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv005':
					case 'lv006':
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),str_replace("@14","txt".$lstArr[$i],str_replace("@03","txt".$lstArr[$i].$vorder,str_replace("@13",$vorder,$lvTdInput))));
					break;
					case 'lv008':
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),str_replace("@14","txt".$lstArr[$i],str_replace("@03","txt".$lstArr[$i].$vorder,str_replace("@13",$vorder,$lvTdInput2))));
					break;
					case 'lv010':
					$vTemp=str_replace("@02",str_replace("@02",$this->LV_LinkField($lstArr[$i],$vrow[$lstArr[$i]]),str_replace("@01",$vrow['lv001'] ,$lvHref)),str_replace("@03","txt".$lstArr[$i].$vorder,$lvTdSelect2));
					break;
					case 'lv007':
						$vTemp=str_replace("@02",str_replace("@02",$this->LV_LinkField($lstArr[$i],$vrow[$lstArr[$i]]),str_replace("@01",$vrow['lv001'] ,$lvHref)),str_replace("@03","txt".$lstArr[$i].$vorder,$lvTdSelect));
					break;
					case 'lv001':
					case 'lv002':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),str_replace("@03","txt".$lstArr[$i].$vorder,$lvTdInputHidden));
					break;
					case 'lv011':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->GetTimeList($this->lvNVID,$vrow['lv004'])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						
					break;
					default:
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				}
				$strL=$strL.$vTemp;
			}
			if((int)$vrow['DOW']==1)
			{
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",'3',$lvTr))));
			}
			else
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
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
			".$lvFrom.".action='".$this->Dir."tc_lv0041/?func=rpt&lang=".$this->lang."&childfunc='+value+'&ID=".base64_encode($this->lv002)."&NVID=".$this->lvNVID."&YearMonth=".$this->lv004."&txtlv029=".$this->lv029."&txtlv001=".$this->lv001."'
			".$lvFrom.".target='_blank';
			".$lvFrom.".submit();
			".$lvFrom.".target='_self';
			//window.open('".$this->Dir."tc_lv0041/?lang=".$this->lang."&childfunc='+value+'&ID=".base64_encode($this->lv002)."&NVID=".$this->lvNVID."&YearMonth=".$this->lv004."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
	function LV_Dictint($lvsql)
	{
		$vArrReturn=array();
		$i=0;
		$sql="";
		$vResult=db_query($lvsql);
		while($vrow=db_fetch_array($vResult))
		{
			if($this->LV_GetSecond($vArrReturn[$i-1],$vrow['lv003'])>60 || $i==0)
			{
				$vArrReturn[$i]=$vrow['lv003'];
				if($sql=="")
					$sql="select '".$vrow['lv003']."' lv003,'".$vrow['lv005']."' lv005";
				else
					$sql=$sql." UNION select '".$vrow['lv003']."' lv003,'".$vrow['lv005']."' lv005 ";
				$i++;
			}
		}
		if($sql!="") $sql="select MP.* from (".$sql.") MP limit 1,2";
		return $sql;
	}
	function LV_GetSecond($lvStartTime,$lvEndTime)
	{
		$lvsql="select TIME_TO_SEC(TIMEDIFF('$lvEndTime','$lvStartTime')) as lv_time";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		return $vrow['lv_time'];
	}
	////GetTime list
	function GetTimeList($vlv001,$vlv002,$opt=0)
	{
		$strReturn="";
		if($opt==0)
		{
			$lvsql="select lv003,lv005 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002' and (lv005='' or ISNULL(lv005))  order by lv003 ASC";
		}
		else
		{
			$lvsql="select lv003,lv005 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002'  order by lv003 ASC";
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
					$strReturn=$strReturn.substr($vrow['lv003'],0,5);
					else
					{
						$strReturn=$strReturn.'<font style="color:red;text-decoration:underline" title="'.GetUserName($vrow['lv005'],$this->lang).'('.$vrow['lv005'].')'.'">'.substr($vrow['lv003'],0,5)."</font>";
					}
				}
				else
				{
					if(trim($vrow['lv005'])=='' || $vrow['lv005']==NULL)
					$strReturn=$strReturn." | ".substr($vrow['lv003'],0,5);
					else
					$strReturn=$strReturn." | ".'<font style="color:red;text-decoration:underline" title="'.GetUserName($vrow['lv005'],$this->lang).'('.$vrow['lv005'].')'.'">'.substr($vrow['lv003'],0,5)."</font>";
				}
			}
			$i++;
			}
		}
		$strReturn="<span style='padding:3px;white-space: nowrap;'>".$strReturn."</span>";
		return $strReturn;
	}
	////GetTime list
	function GetTimeListC3($vlv001,$vlv002,$opt=0)
	{
		$strReturn="";
		
		$lvsql="select lv003,lv005 from (select lv003,lv005 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002' and lv006<>1 order by lv003 DESC limit 0,1) MA
		UNION
		select lv003,lv005 from (
		select lv003,lv005 from  tc_lv0012 Where lv001='$vlv001' and lv002=ADDDATE('$vlv002',1) and lv006<>1 order by lv003 ASC limit 0,1) MB";
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
	function LV_GetListCalendar($vListEmployeeID,$vField)
	{
		$vsql="select $vField from tc_lv0010 where lv002 in ($vListEmployeeID)";
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
	function TinhCongTheoNgayVP_BV($vEmpID,$vyear,$vmonth,&$ArrEmpList)
	{
		$vListEmp="'".$vEmpID."'";
		$vListCalendar=$this->LV_GetListCalendar($vListEmp,'lv001');
		if($vListCalendar=="") $vListCalendar="''";
		$vNumDay=GetDayInMonth($vyear,(int)$vmonth);
		for($i=1;$i<=$vNumDay;$i++)
		{
			$vDay=$vyear."-".Fillnum($vmonth,2)."-".Fillnum($i,2);
			$vsql="select A.lv007 MaCong,A.lv010 tiencom,A.lv004 ngaytinh from tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 left join tc_lv0009 C on B.lv002=C.lv002 where A.lv100<>1 A.lv004='$vDay' and A.lv002 in ($vListCalendar);";
			$vresult=db_query($vsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				$ArrEmpList["$vEmpID"][$i]['value']=true;
				$ArrEmpList["$vEmpID"][$i]['MaCong']=$vrow['MaCong'];
				$ArrEmpList["$vEmpID"][$i]['ngaytinh']=$vrow['ngaytinh'];
				$ArrEmpList["$vEmpID"][$i]['hesok']=$vrow['hesok'];				
				$ArrEmpList["$vEmpID"][0][$vrow['MaCong']]=(int)$ArrEmpList["$vEmpID"][0][$vrow['MaCong']]+1;
				if($ArrEmpList["$vEmpID"][$i]['MaCong']=='1' || $ArrEmpList["$vEmpID"][$i]['MaCong']=='11' || $ArrEmpList["$vEmpID"][$i]['MaCong']=='2' || $ArrEmpList["$vEmpID"][$i]['MaCong']=='22' || $ArrEmpList["$vEmpID"][$i]['MaCong']=='3' || $ArrEmpList["$vEmpID"][$i]['MaCong']=='33' || $ArrEmpList["$vEmpID"][$i]['MaCong']=='U' || $ArrEmpList["$vEmpID"][$i]['MaCong']=='VS')
				{
					if($vrow['tiencom']!=1)
						$ArrEmpList["$vEmpID"][0]['tiencom']=(int)$ArrEmpList["$vEmpID"][0]['tiencom']+1;	
					else
						$ArrEmpList["$vEmpID"][0]['tiencoman'][$vrow['MaCong']]=(int)$ArrEmpList["$vEmpID"][0]['tiencoman'][$vrow['MaCong']]+1;	
				}
			}
		}
		
	}
	public function GetTimeCodeMore($vEmployeeID,$vyear,$vmonth)
	{
		$ArrEmpList=Array();
		$this->TinhCongTheoNgayVP_BV($vEmployeeID,$vyear,$vmonth,$ArrEmpList);
		$lvList='lv001,lv002,lv003,lv004';
		$ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"1","lv004"=>"1");
		$lvOrderList='0,1,2,3';
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
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$vsql="select * from tc_lv0002 where lv001<>' '";
		$bResult=db_query($vsql);
		$this->ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"10","lv004"=>"10");
		$this->ArrTimeCordPush[2]="Mã công";
		$this->ArrTimeCordPush[3]="Tên công";
		$this->ArrTimeCordPush[4]="Ngày công(h)";
		$this->ArrTimeCordPush[5]="Tiền com dã an";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrTimeCordPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{				
				
				if($lstArr[$i]=='lv003')
				{
					$vTemp=str_replace("@02",$this->FormatView($ArrEmpList["$vEmployeeID"][0][$vrow['lv001']],(int)$this->ArrView[$lstArr[$i]]),$lvTd);
				}
				else if($lstArr[$i]=='lv004')
				{
					$vTemp=str_replace("@02",$this->FormatView($ArrEmpList["$vEmployeeID"][0]['tiencoman'][$vrow['lv001']],(int)$this->ArrView[$lstArr[$i]]),$lvTd);
				}
				else
					$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]),$lvTd);
				
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
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
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
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
		$this->ArrTimeCordPush[2]="Mã công";
		$this->ArrTimeCordPush[3]="Tên công";
		$this->ArrTimeCordPush[4]="Giờ công(h)";
		$this->ArrTimeCordPush[5]="Ngày công(d)";
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
	function GetMultiValueArray($sqlS)
	{
		$lv_reValue=array();
		$lv_str="";
		$bResult = db_query($sqlS);
		$vrow = db_fetch_array ($bResult);
		$lv_reValue[0]=$vrow['SumHour'];
		$lv_reValue[1]=$vrow['SumMinute'];
		$lv_reValue[2]=$vrow['SumSecond'];
		return $lv_reValue;
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
			<td width=1% class=@#04>@03</td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$lvHref="@02";
		$sqlS = "SELECT lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,DAYOFWEEK(lv004) DOW FROM tc_lv0011 WHERE lv100<>1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv011':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->GetTimeList($this->lvNVID,$vrow['lv004'])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						$strL=$strL.$vTemp;
						
						break;
					default:
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
						break;
				}
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	//////////////////////Buil list////////////////////
	function LV_BuilListReportEmp($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
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
				$strSort=" order by lv004 asc";
				break;
			case 1:
				$strSort=" order by lv004 asc";
				break;
			case 2:
				$strSort=" order by lv004 desc";
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
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$lvHref="@02";
		$sqlS = "SELECT lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,DAYOFWEEK(lv004) DOW FROM tc_lv0011 WHERE lv100<>1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv011':
						if($this->LV_Checkshift($this->lvNVID,$vrow['lv004'],$vrow['lv010']))
						{
							$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->GetTimeListC3($this->lvNVID,$vrow['lv004'],1)),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						}
						else
						{
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->GetTimeList($this->lvNVID,$vrow['lv004'],1)),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						}
						$strL=$strL.$vTemp;
						
						break;
					default:
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
						break;
				}
			}
			$this->lvReShiID=$vrow['lv010'];


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	function LV_Checkshift($lvNVID,$vDate,$ShiftId)
	{
		if($ShiftId=="")
		{ if($this->lvShiID==null)
			{
				$vsql="select lv007 from tc_lv0008 where lv002='$lvNVID' and lv005=YEAR($vDate)";
				$vresult=db_query($vsql);
				$vrow=db_fetch_array($vresult);
				if($vrow)
				{
					$this->lvShiID=$vrow['lv007'];
					$ShiftId=$this->lvShiID;
				}
				else
				$this->lvShiID='';
			}
		   	$ShiftId=$this->lvShiID;			
		}
			if($ShiftId=="") return false;
			$vsql="select lv003,lv004 from tc_lv0004 where lv001='$ShiftId'";
			$vresult=db_query($vsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				$lvstart=(float)str_replace(":","",$vrow['lv003']);
				$lvend=(float)str_replace(":","",$vrow['lv004']);
				if($lvstart>$lvend) return true;
				else
				return false;
			}
		return false;
	}
	//////////////////////Buil list////////////////////
	function LV_BuilListReportOther($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
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
		<div align=\"center\" class=lv0>".($this->ArrPush[0])."</div>
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
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM tc_lv0011 WHERE lv100<>1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	//////////////////////Buil list////////////////////
	function LV_GetLimitDate($vstartdate,$venddate)
	{
		$vArrDay=Array();
		$vstt=1;
		$vstartday=(int)getday($vstartdate);
		$vstartmonth=getmonth($vstartdate);
		$vstartyear=getyear($vstartdate);
		$vendday=(int)getday($venddate);
		$vendmonth=getmonth($venddate);
		$vendyear=getyear($venddate);
		if($vstartmonth!=$vendmonth)
		{
			$vStartNumDay=GetDayInMonth($vstartyear,$vstartmonth);
			for($i=$vstartday;$i<=$vStartNumDay;$i++)
			{
				$vArrDay[$vstt]=$vstartyear."-".Fillnum($vstartmonth,2)."-".Fillnum($i,2);
				$vstt++;
			}
			$vEndNumDay=$vendday;
			for($i=1;$i<=$vEndNumDay;$i++)
			{
				$vArrDay[$vstt]=$vendyear."-".Fillnum($vendmonth,2)."-".Fillnum($i,2);
				$vstt++;
			}
		}
		else
		{
			for($i=$vstartday;$i<=$vendday;$i++)
			{
				$vArrDay[$vstt]=$vstartyear."-".Fillnum($vstartmonth,2)."-".Fillnum($i,2);
				$vstt++;
			}
		}
		return $vArrDay;
	}
	function Get_String_DateFromTo()
	{
		
	
		// noi in ra cai heder 
		$this->lvHeader="";
		$this->lvHeader1="";
		$strTD="";
		//$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
		$vArrDay=$this->LV_GetLimitDate($this->datefrom,$this->dateto);
		$datecur=$this->datefrom;
		$childfunc=$_GET['childfunc'];

		for($i=1;$i<=count($vArrDay);$i++)
		{
				
			$vdayofw=GetDayOfWeek($datecur);
			$this->ArrDayOfWeek[$datecur]=$vdayofw;
			if($vdayofw==1) 
				$color='yellow';
			else if($vdayofw==7) 
				$color='orange';
			else 
				$color='white';
			if($this->isProj) 
			{
				$vTdProj='<td align="center">Dự án</td>';
				$vTdProjData='<td align="center"><!--21_'.str_replace("/","-",$datecur).'--></td>';
				$vColSpan=12;
			}
			else
			{
				$vTdProj='';
				$vTdProjData='';
				$vColSpan=11;
			}
			if($childfunc=="rpt"  || $childfunc=="excel" || $childfunc=="word" || $childfunc=="pdf")
				{
						
					if($_GET['day']=='')
					{
						$this->lvHeader=$this->lvHeader.'<td COLSPAN="'.$vColSpan.'" class="lvhtable" align="center"><b><font color="'.$color.'">'.getday($datecur).'</font></b></td>';
						$this->lvHeader1=$this->lvHeader1.$vTdProj.'<td align="center">Công</td><td  align="center">Ca</td><td  align="center">Giờ làm</td><td  align="center">Giờ TC</td><td  align="center">TC trưa</td><td  align="center">TC CN</td><td  align="center">Tăng ca lễ</td><td  align="center">Trễ</td><td  align="center">Sớm</td><td  align="center">Giờ vào ra</td><td  align="center">Giờ từ máy</td>';
					}
					else
					{
						$this->lvHeader=$this->lvHeader.'<td COLSPAN="'.$vColSpan.'" class="lvhtable" align="center"><b><font color="'.$color.'">'.$this->FormatView($datecur,2).'</font></b></td>';	
						$this->lvHeader1=$this->lvHeader1.$vTdProj.'<td align="center">Công</td><td  align="center">Ca</td><td  align="center">Giờ làm</td><td  align="center">Giờ TC</td><td  align="center">TC trưa</td><td  align="center">TC CN</td><td  align="center">Tăng ca lễ</td><td  align="center">Trễ</td><td  align="center">Sớm</td><td  align="center">Giờ vào ra</td><td  align="center">Giờ từ máy</td>';
					}
				}
			else
			{
			
				$this->lvHeader=$this->lvHeader.'<td COLSPAN="'.$vColSpan.'" class="lvhtable" align="center"><b><font color="'.$color.'">'.getday($datecur).'</font></b><br/><input type="checkbox" id="hdcheck_'.((int)getday($datecur)).'" onclick="checkRunCong(\''.trim(((int)getday($datecur))).'\',this)"/></td>';
				$this->lvHeader1=$this->lvHeader1.$vTdProj.
				'<td align="center">Công</td>
				<td  align="center">Ca</td>
				<td  align="center">Giờ làm</td>
				<td  align="center">Giờ TC</td>
				<td  align="center">TC trưa</td>
				<td  align="center">TC CN</td>
				<td  align="center">Tăng ca lễ</td>
				<td  align="center">Trễ</td>
				<td  align="center">Sớm</td>
				<td  align="center">Chỉnh giờ vào ra</td>
				<td  align="center">Giờ từ máy</td> 
				<td  align="center">Giờ làm đêm 22h -> 6h</td> 
				
				';
			}
			
			/// cai nay  ne sua o day 
			$strTD=$strTD.$vTdProjData.'
			<td align="center">'."<!--".str_replace("/","-",$datecur)."-->".'</td>
			<td align="center"><!--1_'.str_replace("/","-",$datecur).'-->
				</td>
				<td align="center"><!--2_'.str_replace("/","-",$datecur).'-->
				</td>
				<td align="center"><!--3_'.str_replace("/","-",$datecur).'-->
				</td>
				<td align="center"><!--4_'.str_replace("/","-",$datecur).'-->
				</td>
				<td align="center"><!--5_'.str_replace("/","-",$datecur).'-->
				</td>
				<td align="left"><!--6_'.str_replace("/","-",$datecur).'-->
				</td>
				<td align="left"><!--7_'.str_replace("/","-",$datecur).'-->
				</td>
				<td align="left"><!--8_'.str_replace("/","-",$datecur).'-->
				</td>
				<td align="left"><!--9_'.str_replace("/","-",$datecur).'-->
				</td>
				<td align="left"><!--10_'.str_replace("/","-",$datecur).'-->
				</td>
	
				';
				
			$datecur=ADDDATE($this->datefrom,$i);
		}
		return $strTD;
	}
	function Get_Arr_EmployeesShift()
	{
	
		$this->ArrEmp=array();
		$this->ArrEmpBack=array();
		$strTd=$this->Get_String_DateFromTo();
		$lvcondition="";
		$strCondi=" AND  DD.lv009 not in (2,3) ";
		if($this->lv028!="") 
		{
			$lsguser=$this->LV_GetDep($this->lv028);
			$strCondi=$strCondi." AND DD.lv029 in (".$lsguser.")";
		}
		if($this->lv029!="")  $strCondi=$strCondi." AND DD.lv029 in ('".str_replace(",","','",$this->lv029)."')";
		if($this->lv001!="")  $strCondi=$strCondi." AND DD.lv001 in ('".str_replace(",","','",$this->lv001)."')";		
		if($this->lv005!="") 		$strCondi=$strCondi." AND DD.lv005 like '%$this->lv005%'";		
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
	
	// in ra gia tri
	function Get_Arr_Employees()
	{
		

//ham nay
		$this->ArrEmp=array();
		$this->ArrEmpBack=array();
		$strTd=$this->Get_String_DateFromTo();
		$lvcondition="";
		$strCondi=" AND  DD.lv009 not in (2,3) ";
		
		if($this->lv099<>"")
		{
			
			 $strCondi= $strCondi." and DD.lv001 in (select VV.lv002 from tc_lv0009 VV where VV.lv008='$this->lv099' and lv003='$this->month' and lv004='$this->year')";
		}
		if($this->lv028!="") 
		{
			
			$lsguser=$this->LV_GetDep($this->lv028);
			$strCondi=$strCondi." AND DD.lv029 in (".$lsguser.")";
		}
		if($this->lv029!="")
		{
			
		$lsgdepart=$this->LV_GetDep($this->lv029);
		$strCondi=$strCondi." AND DD.lv029 in (".$lsgdepart.")";	
		}		
		$vlan1=0;
		if($this->lv001!="") 		
		{
			if(!strpos($this->lv001,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv001);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( DD.lv001 = '$vNameCus'";
						else
						{
							if($vlan1==0)
								$strCondi=$strCondi." and (DD.lv001 = '$vNameCus'";		
							else
								$strCondi=$strCondi." OR DD.lv001 = '$vNameCus'";		
								$vlan1++;
						}
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." AND DD.lv001 = '$this->lv001'";	
			}
		}
		$vlan1=0;
		if($this->lv002!="") 		
		{
			if(!strpos($this->lv002,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv001);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( DD.lv002 = '$vNameCus'";
						else
						{
							if($vlan1==0)
								$strCondi=$strCondi." and (DD.lv002 = '$vNameCus'";		
							else
								$strCondi=$strCondi." OR DD.lv002 = '$vNameCus'";		
								$vlan1++;
						}
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." AND DD.lv002 = '$this->lv002'";	
			}
		}
		if($this->lv030!="")  $strCondi=$strCondi." AND DD.lv001 in ('".$this->lv030."')";
		if($this->lvSort==0)
			$lvsql="select DD.lv001 CodeID,EE.lv100 ShiftCal,DD.lv002 Name,DD.lv029 Dep,EE.lv007 HeSoL,EE.lv008 DangGia,EE.lv005 Locks,EE.lv009 Petrol,EE.lv028 Allowance,EE.lv029 Laundry,EE.lv030 Insurance,EE.lv001 MonthID from hr_lv0020 DD left join tc_lv0009 EE on DD.lv001=EE.lv002 and EE.lv003='$this->month' and EE.lv004='$this->year' where 1=1 $strCondi  order by DD.lv029";
		else 
			$lvsql="select DD.lv001 CodeID,EE.lv100 ShiftCal,DD.lv002 Name,DD.lv029 Dep,EE.lv007 HeSoL,EE.lv008 DangGia,EE.lv005 Locks,EE.lv009 Petrol,EE.lv028 Allowance,EE.lv029 Laundry,EE.lv030 Insurance,EE.lv001 MonthID from hr_lv0020 DD DD left join tc_lv0009 EE on DD.lv001=EE.lv002 and EE.lv003='$this->month' and EE.lv004='$this->year' where 1=1 $strCondi  order by DD.lv001";
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
			$this->ArrEmp[$i][9]=$vrow['Petrol'];
			$this->ArrEmp[$i][28]=$vrow['Allowance'];
			$this->ArrEmp[$i][29]=$vrow['Laundry'];
			$this->ArrEmp[$i][30]=$vrow['Insurance'];
			$this->ArrEmp[$i][100]=$vrow['ShiftCal'];
			
			$this->ArrEmpBack[$vrow['CodeID']]=$i;
			$i++;
		}




	}
	function LV_GetProject()
	{
		$vArr=Array();
		$vsql="select * from sl_lv0013 where 1=1  and lv011>=1 and lv011<=2 order by lv001";
		$bResult=db_query($vsql);
		$i=0;
		while ($vrow = db_fetch_array ($bResult)){
			$vArr[$i]['lv001']=$vrow['lv001'];
			$vArr[$i]['lv002']=$vrow['lv001'];
			$i++;
		}
		return $vArr;
	}
	function LV_GetTimeCard()
	{
		$vArr=Array();
		$vsql="select * from tc_lv0002 where lv004=0 order by lv001";
		$bResult=db_query($vsql);
		$i=0;
		while ($vrow = db_fetch_array ($bResult)){
			$vArr[$i]['lv001']=$vrow['lv001'];
			$vArr[$i]['lv002']=$vrow['lv001'];
			$i++;
		}
		return $vArr;
	}
	function LV_GetShift()
	{
		$vArr=Array();
		$vsql="select * from tc_lv0004";
		$bResult=db_query($vsql);
		$i=0;
		while ($vrow = db_fetch_array ($bResult)){
			$vArr[$i]['lv001']=$vrow['lv001'];
			$vArr[$i]['lv002']=$vrow['lv001'];
			$i++;
		}
		return $vArr;
	}
	function LV_GetPetrol()
	{
		$vArr=Array();
		$vsql="select lv001, lv003 lv002 from  tc_lv0047 where lv002 in (select A.lv001 from tc_lv0013 A where A.lv011=1) ";
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
	function LV_GetShiftState()
	{
		$vArr=Array();
		return;
		$vArr=Array();
		$vsql="select lv001, lv002 from  tc_lv0070 ";
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
	function LV_GetInsurance()
	{
		$vArr=Array();
		$vsql="select lv001, lv002 from  tc_lv0100 ";
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
	function LV_GetLock()
	{
		$vArr=Array();
		$vsql="
		select 0 lv001, 'Mở khóa' lv002 
		Union
		select 1 lv001, 'Khóa' lv002 
		";
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
		if($vArr==null) return '';
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
		echo $vsql="select lv001 from  hr_lv0002 where lv001 in ($vReturn)  order by lv103 asc";
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
	public function LV_GetChildDepSelect($vDepID,$vSelectID)
	{
		if($vDepID=="") 
		{
			$vDepID='SOF';
			$vsql="select lv001,lv003 from  hr_lv0002 where lv002='$vDepID' order by lv003";
			$bResult=db_query($vsql);
			while ($vrow = db_fetch_array ($bResult)){
				$vReturn=$vReturn."<option value='".$vrow['lv001']."' ".(($vSelectID==$vrow['lv001'])?'selected="selected"':'').">".$vrow['lv003']."</option>";
				$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow['lv001']."' order by lv003";
				$bResult1=db_query($vsql);
				while ($vrow1 = db_fetch_array ($bResult1)){					
					$vReturn=$vReturn."<option value='".$vrow1['lv001']."' ".(($vSelectID==$vrow1['lv001'])?'selected="selected"':'').">&nbsp;&nbsp;&nbsp;&nbsp;".$vrow1['lv003']."</option>";
					$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow1['lv001']."' order by lv003";
					$bResult2=db_query($vsql);
					while ($vrow2 = db_fetch_array ($bResult2)){
						
						$vReturn=$vReturn."<option value='".$vrow2['lv001']."' ".(($vSelectID==$vrow2['lv001'])?'selected="selected"':'').">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$vrow2['lv003']."</option>";
						$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow2['lv001']."' order by lv003";
						$bResult3=db_query($vsql);
						while ($vrow3 = db_fetch_array ($bResult3)){
							
							$vReturn=$vReturn."<option value='".$vrow3['lv001']."' ".(($vSelectID==$vrow3['lv001'])?'selected="selected"':'').">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$vrow3['lv003']."</option>";
						}
					}
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
	function LV_BuilListReportOtherPrintLateSoon($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvopt,$lvgt=0,$vFocus,$vViewTimeAll=0)
	{		
		$vRowTemp=Array();
		$vXMLRow='<Row ss:AutoFitHeight="0">
    <Cell ss:StyleID="s84"><Data ss:Type="String">@01</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@02</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@03</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@04</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@05</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@06</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@07</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@08</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@09</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@10</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@11</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@12</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@13</Data></Cell>
	<Cell ss:StyleID="s84"><Data ss:Type="String">@14</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@15</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@16</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@17</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@18</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@19</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@20</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@21</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@22</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@23</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@24</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@25</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@26</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@27</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@28</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@29</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@30</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@31</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@32</Data></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">@33</Data></Cell>
   </Row>';
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
		$vcondition=" AND  C.lv009 not in (2,3) ";
		if($this->datefrom!="") $vcondition=$vcondition." and A.lv004 >='$this->datefrom'";
		if($this->dateto!="") $vcondition= $vcondition." and A.lv004 <='$this->dateto'";
		if($this->lv028<>"")
		{
			$lsguser=$this->LV_GetDep($this->lv028);
			$vcondition= $vcondition." and C.lv029 in ($lsguser)";
		}
		if($this->lv099<>"")
		{
			 $vcondition= $vcondition." and C.lv001 in (select VV.lv002 from tc_lv0009 VV where VV.lv008='$this->lv099' and lv003='$this->month' and lv004='$this->year')";
		}
		$vlan1=0;
		if($this->lv001!="") 		
		{
			if(!strpos($this->lv001,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv001);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($vcondition=="")	
						$vcondition= " AND ( C.lv001 = '$vNameCus'";
						else
						{
							if($vlan1==0)
								$vcondition=$vcondition." and (C.lv001 = '$vNameCus'";		
							else
								$vcondition=$vcondition." OR C.lv001 = '$vNameCus'";		
								$vlan1++;
						}
					}
				}
				$vcondition=$vcondition.")";
				
			}
			else
			{
				$vcondition=$vcondition." AND C.lv001 = '$this->lv001'";	
			}
		}
		$vlan1=0;
		if($this->lv002!="") 		
		{
			if(!strpos($this->lv002,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv001);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($vcondition=="")	
						$vcondition= " AND ( C.lv002 = '$vNameCus'";
						else
						{
							if($vlan1==0)
								$vcondition=$vcondition." and (C.lv002 = '$vNameCus'";		
							else
								$vcondition=$vcondition." OR C.lv002 = '$vNameCus'";		
								$vlan1++;
						}
					}
				}
				$vcondition=$vcondition.")";
				
			}
			else
			{
				$vcondition=$vcondition." AND C.lv002 = '$this->lv002'";	
			}
		}
		
		if($this->lv029<>"")
		{
			$lsgdepart=$this->LV_GetDep($this->lv029);
			$vcondition=$vcondition." and C.lv029 in ($lsgdepart)";
		}
		$lvHref="@02";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT A.lv002,A.lv003,A.lv004,A.lv005,A.lv014,A.lv016,A.lv017,A.lv018,A.lv019,A.lv020,A.lv021,A.lv015,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,B.lv002 NVID,C.lv029 lv001,A.lv001 TimeCardId,A.lv089 FixDay  FROM tc_lv0011 A inner join tc_lv0010 B on A.lv002=B.lv001 inner join hr_lv0020 C on C.lv001=B.lv002 WHERE A.lv100<>1 $vcondition order by C.lv029 ASC,A.lv004 ASC";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		switch ($lvgt)
				{
					case 0:
					$vArr=$this->LV_GetTimeCard();
					$vArr1=$this->LV_GetShift();
					$vArr2=$this->LV_GetProject();
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
			$lvvt=$this->ArrEmpBack[$vrow['NVID']];
			$strL="";
			$vorder++;
			$lvstrgt="";
			$vDayCss=(int)getday($vrow['lv004']);
			if($vRowTemp[$this->ArrEmp[$lvvt][0]]==NULL || $vRowTemp[$this->ArrEmp[$lvvt][0]]=='') $vRowTemp[$this->ArrEmp[$lvvt][0]]=str_replace("@01",$this->ArrEmp[$lvvt][0],$vXMLRow);
				$vRowTemp[$this->ArrEmp[$lvvt][0]]=str_replace("@02",$this->ArrEmp[$lvvt][1],$vRowTemp[$this->ArrEmp[$lvvt][0]]);
				switch($lvgt)
				{
					case 0:
						if($this->isEdit==1)
						{
							$lvstrgt21='<select  title="'.$this->ArrEmp[$lvvt][1]." ".$this->FormatView($vrow['lv004'],2).'"  lang="runchangeproject(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',\'@!99\')" class="lineproject_'.$vDayCss.'" style="width:35px;font-size:10px;background-color:#@@99;color:inherit;" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'" id="project_'.$vrow['TimeCardId'].'" onblur="runchangeproject(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)">'.$this->CreateSelectArr($vArr2,$vrow['lv021']).'</select>';
							$lvstrgt='<select  title="'.$this->ArrEmp[$lvvt][1]." ".$this->FormatView($vrow['lv004'],2).'"  lang="runchangetime(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',\'@!99\')" class="lineday_'.$vDayCss.'" style="width:35px;font-size:10px;background-color:#@@99;color:inherit;" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'" id="timecard_'.$vrow['TimeCardId'].'" onblur="runchangetime(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)">'.$this->CreateSelectArr($vArr,$vrow['lv007']).'</select>';
							$lvstrgt1='<div style="white-space: nowrap;">
							<select lang="runchangeshift(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',\'@!99\')" class="lineshift_'.$vDayCss.'" style="width:55px;font-size:10px;background-color:#@@99;color:inherit;" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'" id="shift_'.$vrow['TimeCardId'].'" onblur="runchangeshift(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)">'.$this->CreateSelectArr($vArr1,$vrow['lv015']).'</select>
							'.(($vViewTimeAll==1)?'<input type="button" style="width:60px;background-color:'.$color.'" type="text" onclick="runchangeshiftauto(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this)" value="'.(($vrow['FixDay']==1)?'Fixed':'Auto').'"/>':'').'</div>';
							$lvstrgt2='<input type="textbox" lang="runchangetimework(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',\'@!99\')" class="linetimework_'.$vDayCss.'" style="width:39px;text-align:center;background-color:#@@99;color:inherit;" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'" id="work_'.$vrow['TimeCardId'].'" onblur="runchangetimework(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)" value="'.substr($vrow['lv005'],0,5).'"/>';
							$lvstrgt3='<input type="textbox" lang="runchangeovertime(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',\'@!99\')" class="lineovertime_'.$vDayCss.'" style="width:39px;text-align:center;background-color:#@@99;color:inherit;" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'" id="work_'.$vrow['TimeCardId'].'" onblur="runchangeovertime(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)" value="'.substr($vrow['lv014'],0,5).'"/>';
							$lvstrgt4='<input type="textbox" lang="runchangecleartime(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',\'@!99\')" class="linecleartime_'.$vDayCss.'" style="width:39px;text-align:center;background-color:#@@99;color:inherit;" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'" id="work_'.$vrow['TimeCardId'].'" onblur="runchangecleartime(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)" value="'.substr($vrow['lv016'],0,5).'"/>';
							$lvstrgt5='<input type="textbox" lang="runchangegiobu(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',\'@!99\')" class="linegiobu_'.$vDayCss.'" style="width:39px;text-align:center;background-color:#@@99;color:inherit;" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'" id="work_'.$vrow['TimeCardId'].'" onblur="runchangegiobu(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)" value="'.substr($vrow['lv017'],0,5).'"/>';
							$lvstrgt6='<input type="textbox" lang="runchangegiosau22h(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',\'@!99\')" class="linegiosau22h_'.$vDayCss.'" style="width:39px;text-align:center;background-color:#@@99;color:inherit;" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'" id="work_'.$vrow['TimeCardId'].'" onblur="runchangegiosau22h(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)" value="'.substr($vrow['lv018'],0,5).'"/>';
							$lvstrgt7=(trim($vrow['lv019'])=="")?"&nbsp;":substr($vrow['lv019'],0,5);
							$lvstrgt8=(trim($vrow['lv020'])=="")?"&nbsp;":substr($vrow['lv020'],0,5);
						}
						else
						{
							$lvstrgt21=(trim($vrow['lv007'])=="")?"&nbsp;":$vrow['lv021'];
							$lvstrgt=(trim($vrow['lv007'])=="")?"&nbsp;":$vrow['lv007'];
							$lvstrgt1=(trim($vrow['lv015'])=="")?"&nbsp;":$vrow['lv015'];
							$lvstrgt2=(trim($vrow['lv005'])=="")?"&nbsp;":$vrow['lv005'];
							$lvstrgt3=(trim($vrow['lv014'])=="")?"&nbsp;":substr($vrow['lv014'],0,5);
							$lvstrgt4=(trim($vrow['lv016'])=="")?"&nbsp;":substr($vrow['lv016'],0,5);
							$lvstrgt5=(trim($vrow['lv017'])=="")?"&nbsp;":substr($vrow['lv017'],0,5);
							$lvstrgt6=(trim($vrow['lv018'])=="")?"&nbsp;":substr($vrow['lv018'],0,5);
							$lvstrgt7=(trim($vrow['lv019'])=="")?"&nbsp;":substr($vrow['lv019'],0,5);
							$lvstrgt8=(trim($vrow['lv020'])=="")?"&nbsp;":substr($vrow['lv020'],0,5);
						}
						$this->ArrTC[$vrow['lv007']]=(int)$this->ArrTC[$vrow['lv007']]+1;
						$this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]=(int)$this->ArrTCEmp[$vrow['NVID']][$vrow['lv007']]+1;
						break;
					case 1:
						if($this->isEdit==1)
						{
							$lvstrgt21='<select lang="runchangetime(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',\'@!99\')" class="lineday_'.$vDayCss.'"  style="width:35px;font-size:10px;background-color:#@@99" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'"  onblur="runchangetime(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)">'.$this->CreateSelectArr($vArr2,$vrow['lv021']).'<select>';
							$lvstrgt='<select lang="runchangetime(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',\'@!99\')" class="lineday_'.$vDayCss.'"  style="width:35px;font-size:10px;background-color:#@@99" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'"  onblur="runchangetime(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)">'.$this->CreateSelectArr($vArr,$vrow['lv007']).'<select>';
							$lvstrgt1='<div style="white-space: nowrap;">
							<select lang="runchangeshift(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',\'@!99\')" class="lineshift_'.$vDayCss.'" style="width:55px;font-size:10px;background-color:#@@99;color:inherit;" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'" id="shift_'.$vrow['TimeCardId'].'" onblur="runchangeshift(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)">'.$this->CreateSelectArr($vArr1,$vrow['lv015']).'</select>
							'.(($vViewTimeAll==1)?'<input type="button" style="width:60px;background-color:'.$color.'" type="text" onclick="runchangeshiftauto(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this)" value="'.(($vrow['FixDay']==1)?'Fixed':'Auto').'"/>':'').'</div>';
							$lvstrgt2='<input type="textbox" lang="runchangetimework(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',\'@!99\')" class="linetimework_'.$vDayCss.'" style="width:39px;text-align:center;background-color:#@@99;color:inherit;" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'" id="work_'.$vrow['TimeCardId'].'" onblur="runchangetimework(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)" value="'.substr($vrow['lv005'],0,5).'"/>';
							$lvstrgt3='<input type="textbox" lang="runchangeovertime(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',\'@!99\')" class="lineovertime_'.$vDayCss.'" style="width:39px;text-align:center;background-color:#@@99;color:inherit;" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'" id="work_'.$vrow['TimeCardId'].'" onblur="runchangeovertime(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)" value="'.substr($vrow['lv014'],0,5).'"/>';
							$lvstrgt4='<input type="textbox" lang="runchangecleartime(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',\'@!99\')" class="linecleartime_'.$vDayCss.'" style="width:39px;text-align:center;background-color:#@@99;color:inherit;" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'" id="work_'.$vrow['TimeCardId'].'" onblur="runchangecleartime(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)" value="'.substr($vrow['lv016'],0,5).'"/>';
							$lvstrgt5='<input type="textbox" lang="runchangegiobu(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',\'@!99\')" class="linegiobu_'.$vDayCss.'" style="width:39px;text-align:center;background-color:#@@99;color:inherit;" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'" id="work_'.$vrow['TimeCardId'].'" onblur="runchangegiobu(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)" value="'.substr($vrow['lv017'],0,5).'"/>';
							$lvstrgt6='<input type="textbox" lang="runchangegiosau22h(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',\'@!99\')" class="linegiosau22h_'.$vDayCss.'" style="width:39px;text-align:center;background-color:#@@99;color:inherit;" '.(($vFocus==1)?' tabindex="'.((int)substr ($vrow['lv004'],8,10)).'"':'').'" id="work_'.$vrow['TimeCardId'].'" onblur="runchangegiosau22h(\''.$vrow['TimeCardId'].'\',\''.$this->ArrEmp[$lvvt][0].'\',this.value)" value="'.substr($vrow['lv018'],0,5).'"/>';
							$lvstrgt7=(trim($vrow['lv019'])=="")?"&nbsp;":substr($vrow['lv019'],0,5);
							$lvstrgt8=(trim($vrow['lv020'])=="")?"&nbsp;":substr($vrow['lv020'],0,5);
						}
						else
						{
							$lvstrgt=(trim($vrow['lv007'])=="")?"&nbsp;":$vrow['lv021'];
							$lvstrgt=(trim($vrow['lv007'])=="")?"&nbsp;":$vrow['lv007'];
							$lvstrgt1=(trim($vrow['lv015'])=="")?"&nbsp;":$vrow['lv015'];
							$lvstrgt2=(trim($vrow['lv005'])=="")?"&nbsp;":substr($vrow['lv005'],0,5);
							$lvstrgt3=(trim($vrow['lv014'])=="")?"&nbsp;":substr($vrow['lv014'],0,5);
							$lvstrgt4=(trim($vrow['lv016'])=="")?"&nbsp;":substr($vrow['lv016'],0,5);
							$lvstrgt5=(trim($vrow['lv017'])=="")?"&nbsp;":substr($vrow['lv017'],0,5);
							$lvstrgt6=(trim($vrow['lv018'])=="")?"&nbsp;":substr($vrow['lv018'],0,5);
							$lvstrgt7=(trim($vrow['lv019'])=="")?"&nbsp;":substr($vrow['lv019'],0,5);
							$lvstrgt8=(trim($vrow['lv020'])=="")?"&nbsp;":substr($vrow['lv020'],0,5);
						}
						$this->ArrTC[$vrow['lv010']]=(int)$this->ArrTC[$vrow['lv010']]+1;
						$this->ArrTCEmp[$vrow['NVID']][$vrow['lv010']]=(int)$this->ArrTCEmp[$vrow['NVID']][$vrow['lv010']]+1;
						
						break;
				}
			$this->ArrEmp[$lvvt][6]=str_replace("<!--21_".$vrow['lv004']."-->",$lvstrgt21,$this->ArrEmp[$lvvt][6]);
			$this->ArrEmp[$lvvt][6]=str_replace("<!--".$vrow['lv004']."-->",$lvstrgt,$this->ArrEmp[$lvvt][6]);
			$this->ArrEmp[$lvvt][6]=str_replace("<!--1_".$vrow['lv004']."-->",$lvstrgt1,$this->ArrEmp[$lvvt][6]);
			$this->ArrEmp[$lvvt][6]=str_replace("<!--2_".$vrow['lv004']."-->",$lvstrgt2,$this->ArrEmp[$lvvt][6]);
			$this->ArrEmp[$lvvt][6]=str_replace("<!--3_".$vrow['lv004']."-->",$lvstrgt3,$this->ArrEmp[$lvvt][6]);
			$this->ArrEmp[$lvvt][6]=str_replace("<!--4_".$vrow['lv004']."-->",$lvstrgt4,$this->ArrEmp[$lvvt][6]);
			$this->ArrEmp[$lvvt][6]=str_replace("<!--5_".$vrow['lv004']."-->",$lvstrgt5,$this->ArrEmp[$lvvt][6]);
			$this->ArrEmp[$lvvt][6]=str_replace("<!--6_".$vrow['lv004']."-->",$lvstrgt6,$this->ArrEmp[$lvvt][6]);
			$this->ArrEmp[$lvvt][6]=str_replace("<!--7_".$vrow['lv004']."-->",$lvstrgt7,$this->ArrEmp[$lvvt][6]);
			$this->ArrEmp[$lvvt][6]=str_replace("<!--8_".$vrow['lv004']."-->",$lvstrgt8,$this->ArrEmp[$lvvt][6]);
			if($this->isEdit==1)
				$this->ArrEmp[$lvvt][6]=str_replace("<!--9_".$vrow['lv004']."-->",$this->GetTimeListOutOff($vrow['NVID'],$vrow['lv004'],$vrow['TimeCardId'],$vViewTimeAll),$this->ArrEmp[$lvvt][6]);
			else
				$this->ArrEmp[$lvvt][6]=str_replace("<!--9_".$vrow['lv004']."-->",$this->GetTimeList($vrow['NVID'],$vrow['lv004'],1),$this->ArrEmp[$lvvt][6]);
			$this->ArrEmp[$lvvt][6]=str_replace("<!--10_".$vrow['lv004']."-->",$this->GetTimeList($vrow['NVID'],$vrow['lv004']),$this->ArrEmp[$lvvt][6]);
			$vCodeR='@'.Fillnum((int)getday($vrow['lv004'])+2,2);
				$vRowTemp[$this->ArrEmp[$lvvt][0]]=str_replace($vCodeR,$vrow['lv007'],$vRowTemp[$this->ArrEmp[$lvvt][0]]);
			}
		return $this->Get_BuildList_Array($lvFrom,$vRowTemp);
	}
	function LV_GetColorShow($vState,$vDel)
	{
		switch($vState)
		{
			case 1:
				return (($vDel=='1')?'text-decoration:line-through':'').';color:red';
				break;
			case 2:
				return (($vDel=='1')?'text-decoration:line-through':'').';color:pink';
				break;
			case 3:
				return (($vDel=='1')?'text-decoration:line-through':'').';color:green';
				break;
			case 4:
				return (($vDel=='1')?'text-decoration:line-through':'').';color:blue';
				break;
			default:
				return (($vDel=='1')?'text-decoration:line-through':'').';color:black';
				break;
		}
	}
	function GetTimeListOutOff($vlv001,$vlv002,$vid,$vopt=0,$vGetNoID=0)
	{
		$strReturn="";
		if($vopt==0) 
		$lvsql="select lv001,lv002,lv003,lv004,lv005,lv006 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002' and lv006=0 order by lv003 ASC";
		else
		$lvsql="select lv001,lv002,lv003,lv004,lv005,lv006 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002'  order by lv003 ASC";
		$vresult=db_query($lvsql);
		if($vresult){
		
			while($vrow=db_fetch_array($vresult))
			{
				if($strReturn=="")
				{
					if(trim($vrow['lv005'])=='' || $vrow['lv005']==NULL)
						$strReturn=$strReturn.'<a href="javascript:'.(($vrow['lv006']=='1')?'undeltime':'deltime').'(\''.$vrow['lv001'].'\',\''.$vrow['lv002'].'\',\''.$vrow['lv003'].'\',\''.$vid.'\')"><font style="'.$this->LV_GetColorShow($vrow['lv004'],$vrow['lv006']).'">'.substr($vrow['lv003'],0,5)."</font></a>";
					else
					{
						$strReturn=$strReturn.'<a href="javascript:'.(($vrow['lv006']=='1')?'undeltime':'deltime').'(\''.$vrow['lv001'].'\',\''.$vrow['lv002'].'\',\''.$vrow['lv003'].'\',\''.$vid.'\')">'.'<font style="'.$this->LV_GetColorShow($vrow['lv004'],$vrow['lv006']).'" title="'.GetUserName($vrow['lv005'],$this->lang).'('.$vrow['lv005'].')'.'"><font style="'.(($vrow['lv006']=='1')?'text-decoration:line-through;':(($vrow['lv006']=='0' && $vrow['lv004']=='1')?'color:red':'color:blue')).'">'.substr($vrow['lv003'],0,5)."</font></font></a>";
					}
				}
				else
				{
					if(trim($vrow['lv005'])=='' || $vrow['lv005']==NULL)
					$strReturn=$strReturn." | ".'<a href="javascript:'.(($vrow['lv006']=='1')?'undeltime':'deltime').'(\''.$vrow['lv001'].'\',\''.$vrow['lv002'].'\',\''.$vrow['lv003'].'\',\''.$vid.'\')"><font style="'.$this->LV_GetColorShow($vrow['lv004'],$vrow['lv006']).'">'.substr($vrow['lv003'],0,5)."</font></a>";
					else
					$strReturn=$strReturn." | ".'<a href="javascript:'.(($vrow['lv006']=='1')?'undeltime':'deltime').'(\''.$vrow['lv001'].'\',\''.$vrow['lv002'].'\',\''.$vrow['lv003'].'\',\''.$vid.'\')">'.'<font style="'.$this->LV_GetColorShow($vrow['lv004'],$vrow['lv006']).'" title="'.GetUserName($vrow['lv005'],$this->lang).'('.$vrow['lv005'].')'.'"><font style="'.(($vrow['lv006']=='1')?'text-decoration:line-through;':(($vrow['lv006']=='0' && $vrow['lv004']=='1')?'color:red':'color:blue')).'">'.substr($vrow['lv003'],0,5)."</font></font></a>";
				}
			}
		}
			if($vGetNoID==1)
				return '<span onclick="showtimeadd('.$vid.')" style="cursor:pointer"><img src="../images/icon/add_bn.png"/></span><div style="display:none;position:absolute;" id="timeadd_'.$vid.'" ><input id="txttimeadd_'.$vid.'" type="textbox" value="00:00" onchange="addtime(\''.$vlv001.'\',\''.$vlv002.'\','.$vid.',this)" style="width:60px;right:0px;top:0px;"/><img src="../images/icon/close.png"  onclick="closetimeadd('.$vid.')"/></div> | '.$strReturn.'';
			else
				return '<div id="'.$vid.'" style="padding:3px;white-space: nowrap;"><span onclick="showtimeadd('.$vid.')" style="cursor:pointer"><img src="../images/icon/add_bn.png"/></span><div style="display:none;position:absolute;" id="timeadd_'.$vid.'" ><input id="txttimeadd_'.$vid.'" type="textbox" value="00:00" onchange="addtime(\''.$vlv001.'\',\''.$vlv002.'\','.$vid.',this)" style="width:60px;right:0px;top:0px;"/><img src="../images/icon/close.png"  onclick="closetimeadd('.$vid.')"/></div> | '.$strReturn.'</div>';
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
		$vCode="'X','HA','HP'";
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
	function Get_BuildList_Array($lvFrom,$vRowTemp)
	{
		$vXMLFile='<?xml version="1.0"?>
<?mso-application progid="Excel.Sheet"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <Author>SOF</Author>
  <LastAuthor>SOF</LastAuthor>
  <Created>2013-12-25T02:20:17Z</Created>
  <LastSaved>2015-11-14T08:56:52Z</LastSaved>
  <Version>12.00</Version>
 </DocumentProperties>
 <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
  <WindowHeight>7935</WindowHeight>
  <WindowWidth>20055</WindowWidth>
  <WindowTopX>240</WindowTopX>
  <WindowTopY>75</WindowTopY>
  <ProtectStructure>False</ProtectStructure>
  <ProtectWindows>False</ProtectWindows>
 </ExcelWorkbook>
 <Styles>
  <Style ss:ID="Default" ss:Name="Normal">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s62" ss:Name="Normal 2">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Arial"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="m100295572">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
  </Style>
  <Style ss:ID="m100295592">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
  </Style>
  <Style ss:ID="m100295612">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
  </Style>
  <Style ss:ID="s64">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
  </Style>
  <Style ss:ID="s66">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s81">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
  </Style>
  <Style ss:ID="s82">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s84" ss:Parent="s62">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Arial" ss:Size="9" ss:Bold="1"/>
   <Interior/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s85" ss:Parent="s62">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="9" ss:Bold="1"/>
   <Interior/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s86" ss:Parent="s62">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#333333"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#333333"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#333333"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#333333"/>
   </Borders>
   <Font ss:FontName="Arial" ss:Size="9" ss:Bold="1"/>
   <Interior/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s87" ss:Parent="s62">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="VNI-Times" ss:Size="9" ss:Bold="1"/>
   <Interior/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s88" ss:Parent="s62">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Font ss:FontName="Arial" ss:Size="9" ss:Bold="1"/>
   <Interior/>
   <NumberFormat ss:Format="@"/>
  </Style>
 </Styles>
 <Worksheet ss:Name="Phòng nhân sự">
  <Table ss:ExpandedColumnCount="33" ss:ExpandedRowCount="12" x:FullColumns="1"
   x:FullRows="1" ss:DefaultRowHeight="15">
   <Column ss:AutoFitWidth="0" ss:Width="83.25"/>
   <Column ss:AutoFitWidth="0" ss:Width="111.75"/>
   <Column ss:Index="7" ss:AutoFitWidth="0" ss:Width="79.5"/>
   <Row ss:AutoFitHeight="0">
    <Cell ss:MergeAcross="2" ss:StyleID="s64"><Data ss:Type="String">Nhập công/ca/giờ</Data></Cell>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
    <Cell ss:StyleID="s66"/>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:MergeDown="1" ss:StyleID="m100295572"><Data ss:Type="String">Mã nhân viên</Data></Cell>
    <Cell ss:MergeDown="1" ss:StyleID="m100295592"><Data ss:Type="String">Tên NV</Data></Cell>
    <Cell ss:MergeAcross="30" ss:StyleID="m100295612"><Data ss:Type="String">Chúy ý nhập mã công, mã ca, còn nhập giờ (định dạng 00:00:00 hoặc 00:00 hoặc bỏ trống), nếu nhiều giờ vào ra thì cách nhau dấu ,</Data></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:Index="3" ss:StyleID="s81"><Data ss:Type="Number">1</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">2</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">3</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">4</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">5</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">6</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">7</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">8</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">9</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">10</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">11</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">12</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">13</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">14</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">15</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">16</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">17</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">18</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">19</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">20</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">21</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">22</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">23</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">24</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">25</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">26</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">27</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">28</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">29</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">30</Data></Cell>
    <Cell ss:StyleID="s81"><Data ss:Type="Number">31</Data></Cell>
   </Row>
	@#01
	  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Header x:Margin="0.3"/>
    <Footer x:Margin="0.3"/>
    <PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>
   </PageSetup>
   <Unsynced/>
   <Print>
    <ValidPrinterInfo/>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
   </Print>
   <Selected/>
   <Panes>
    <Pane>
     <Number>3</Number>
     <ActiveRow>7</ActiveRow>
     <ActiveCol>5</ActiveCol>
    </Pane>
   </Panes>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
 <Worksheet ss:Name="Sheet3">
  <Table ss:ExpandedColumnCount="1" ss:ExpandedRowCount="1" x:FullColumns="1"
   x:FullRows="1" ss:DefaultRowHeight="15">
   <Row ss:AutoFitHeight="0"/>
  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Header x:Margin="0.3"/>
    <Footer x:Margin="0.3"/>
    <PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>
   </PageSetup>
   <Unsynced/>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
</Workbook>

  ';
 
	$vArLock=$this->LV_GetLock();
	$vArr=$this->LV_GetRate();
	$vArrPetrol=$this->LV_GetPetrol();
	$vArShift=$this->LV_GetShiftState();
	$vArrInsurance=$this->LV_GetInsurance();
	$this->isAdd=0;
	$this->isEdit=0;
	$childfunc=$_GET['childfunc'];
	$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
	//noi menu
	if($childfunc=="rpt" || $childfunc=="excel" || $childfunc=="word"  || $childfunc=="pdf" )
	{
		
		if($this->lvSort==1)		
		$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\" id=\"tabletc\">
			<tr height=\"30px\">
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[1]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[2]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[4]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[6]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[7]."</b></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>Tính BH</b></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>Công PC</b></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>PN dư của quý</b></td>
				".$this->lvHeader."<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[30]."</b></td>		
			</tr>
			<tr>
				".$this->lvHeader1."		
			</tr>
			@01
		</table>
		";
		else
			$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\" id=\"tabletc\">
			<tr height=\"30px\">
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[1]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[2]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[4]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[6]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[7]."</b></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>Tính BH</b></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>Công PC</b></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>PN dư của quý</b></td>
				".$this->lvHeader."<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[30]."</b></td>
			</tr>
			<tr>
				".$this->lvHeader1."		
			</tr>
			@01
		</table>
		";
	}
	else
	{
		
	if($this->lvSort==1)		
		$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\" id=\"tabletc\">
			<tr height=\"30px\" class='lvhtable'>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[1]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[2]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[3]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[4]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[5]."</b></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\" valign=\"bottom\"><b>Tính ca</b></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[6]."</b></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[7]."</b></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[8]."</b></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>Tính BH</b></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>Công PC</b></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>PN dư của quý</b></td>
				".$this->lvHeader."<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[4]."</b></td>	
			</tr>
			<tr>
				".$this->lvHeader1."		
			</tr>
			@01
			<tr ><td rowspan='2' colspan=\"".($lvNumDate+5)."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td rowspan='2' colspan=\"4\" align=right>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</td></tr>
		</table>
		";
		else
			
		 
			$vTable="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\" id=\"tabletc\">
			<tr height=\"30px\" class='lvhtable'>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[1]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[3]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[2]."</b></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[4]."</b></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[5]."</b><br/><select ".(($vFocus==1)?' tabindex="1"':'').'" style="width:60px"  onchange="checkRunTC(1,this)">'.$this->CreateSelectArr($vArLock,'')."</select></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\" valign=\"bottom\"><b>Tính ca</b><select ".(($vFocus==1)?' tabindex="1"':'').'" style="width:60px"  onchange="checkRunTC(100,this)">'.$this->CreateSelectArr($vArShift,'')."</select></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\" valign=\"bottom\"><b>".$this->ArrPush[6]."</b><select ".(($vFocus==1)?' tabindex="1"':'').'" style="width:60px"  onchange="checkRunTC(2,this)">'.$this->CreateSelectArr($vArrPetrol,'')."</select></td><td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"  valign=\"bottom\"><b>".$this->ArrPush[7]."</b><br/><select style=\"background-color:".$color."\" ".(($vFocus==1)?' tabindex="1"':'').'" style="width:60px;height:22px" onchange="checkRunTC(1,this)">'.$this->CreateSelectArr($vArr,'')."</select></td>
				
				
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>Tính BH</b></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>Công PC</b></td>
				<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>PN dư của quý</b></td>
				".$this->lvHeader."<td rowspan='2' class=\"lvhtable\" width=\"10%\" align=\"center\"><b>".$this->ArrPush[4]."</b></td>	
			</tr>
			<tr>
				".$this->lvHeader1."		
			</tr>
			@01
			<tr ><td rowspan='2' colspan=\"".($lvNumDate+5)."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td rowspan='2' colspan=\"4\" align=right>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</td></tr>
		</table>
		";
	}

		$lvListTrAll="";
		for($i=0;$i<count($this->ArrEmp);$i++)
		{
			
			$lvStrXML=$lvStrXML.$vRowTemp[$this->ArrEmp[$i][0]];
			if($i%2==0) $color='#fff';
			else $color='#EAEAEA';
			$vp_col1_1="<td nowrap='nowrap'>".$this->GetValueArr($vArrPetrol,$this->ArrEmp[$i][9])."</td><td nowrap='nowrap'>".$this->GetValueArr($vArr,$this->ArrEmp[$i][4])."</td>";
			$vp_col2="<td nowrap='nowrap'><input id='btmonth_".$this->ArrEmp[$i][8]."' value='Mở Khóa' style='width:60px;color:blue' type='button' onclick=\"UpdateMonthly('".$this->ArrEmp[$i][8]."','".$this->ArrEmp[$i][0]."','".$this->ArrEmp[$i][7]."',4)\"  class=\"linecontrol_1\" lang=\"UpdateMonthly('".$this->ArrEmp[$i][8]."','".$this->ArrEmp[$i][0]."',@!99,4)\"/></td>";
			$vp_col2_1="<td nowrap='nowrap'><input id='btmonth_".$this->ArrEmp[$i][8]."' value='Khóa' style='width:60px' type='button' onclick=\"UpdateMonthly('".$this->ArrEmp[$i][8]."','".$this->ArrEmp[$i][0]."','".$this->ArrEmp[$i][7]."',3)\" class=\"linecontrol_1\" lang=\"UpdateMonthly('".$this->ArrEmp[$i][8]."','".$this->ArrEmp[$i][0]."',@!99,3)\"/></td>";
			if($childfunc=="rpt"  || $childfunc=="excel" || $childfunc=="word" || $childfunc=="pdf")
				$vp_col2_2="$vp_col1_1";
			else
				$vp_col2_2="<td nowrap='nowrap'>".$this->ArrEmp[$i][7]."</td>$vp_col1_1";
			if($this->is_tc09_unapr==1)
				$vp_col3="<td nowrap='nowrap'><input style='width:60px;background-color:".$color."' type='text' value='".$this->ArrEmp[$i][3]."' onblur=\"UpdateMonthly('".$this->ArrEmp[$i][8]."','".$this->ArrEmp[$i][0]."',this.value,1)\" /></td><td nowrap='nowrap'><select style=\"background-color:".$color."\" ".(($vFocus==1)?' tabindex="1"':'').'" style="width:60px" onblur="UpdateMonthly(\''.$this->ArrEmp[$i][8].'\',\''.$this->ArrEmp[$i][0].'\',this.value,2)"  class="linecontrol_1">'.$this->CreateSelectArr($vArr,$this->ArrEmp[$i][4])."</select>"."</td>";
			else
				$vp_col3="<td nowrap='nowrap'>".$this->ArrEmp[$i][3]."</td><td nowrap='nowrap'><select style=\"background-color:".$color."\" ".(($vFocus==1)?' tabindex="1"':'').'" style="width:60px" onblur="UpdateMonthly(\''.$this->ArrEmp[$i][8].'\',\''.$this->ArrEmp[$i][0].'\',this.value,2)"   class="linecontrol_1">'.$this->CreateSelectArr($vArr,$this->ArrEmp[$i][4])."</select>"."</td>";
			$vp_col3_1="<td nowrap='nowrap'>".$this->FormatView($this->ArrEmp[$i][3],10)."</td><td nowrap='nowrap'>".$this->GetValueArr($vArr,$this->ArrEmp[$i][4]).""."</td><td nowrap='nowrap'>".$this->GetValueArr($vArrPetrol,$this->ArrEmp[$i][4])."</td>";
			if($this->is_tc09_apr==0)
			{
			
				$vp_col3_2="
			<td nowrap='nowrap'>".$this->ArrEmp[$i][4]."</td>
			<td nowrap='nowrap'>".$this->ArrEmp[$i][30]."</td>
			<td nowrap='nowrap'>".$this->ArrEmp[$i][28]."</td>
			<td nowrap='nowrap'>".$this->ArrEmp[$i][29]."</td>
			";
			}
			else
				///
				$vp_col3_2="
			<td nowrap='nowrap'>
			<input type=\"button\" class=\"linecontrol_100\"  style='width:60px;background-color:".$color."' type='text' onclick=\"UpdateMonthlyShift('".$this->ArrEmp[$i][8]."','".$this->ArrEmp[$i][0]."',this,100)\" lang=\"UpdateMonthly('".$this->ArrEmp[$i][8]."','".$this->ArrEmp[$i][0]."',@!99,100)\" value=\"".(($this->ArrEmp[$i][100]==1)?'Fixed':'Auto')."\"/>
			</td>
			<td nowrap='nowrap'><select  class=\"linecontrol_2\"  style='width:60px;background-color:".$color."' type='text' onblur=\"UpdateMonthly('".$this->ArrEmp[$i][8]."','".$this->ArrEmp[$i][0]."',this.value,5)\" lang=\"UpdateMonthly('".$this->ArrEmp[$i][8]."','".$this->ArrEmp[$i][0]."',@!99,5)\" >".$this->CreateSelectArr($vArrPetrol,$this->ArrEmp[$i][9])."</select></td>
			<td nowrap='nowrap'><select  style=\"width:40px;background-color:".$color."\" ".(($vFocus==1)?' tabindex="1"':'').'" onblur="UpdateMonthly(\''.$this->ArrEmp[$i][8].'\',\''.$this->ArrEmp[$i][0].'\',this.value,2)" lang="UpdateMonthly(\''.$this->ArrEmp[$i][8].'\',\''.$this->ArrEmp[$i][0].'\',@!99,2)" class="linecontrol_1">'.$this->CreateSelectArr($vArr,$this->ArrEmp[$i][4])."</select></td>
			<td nowrap='nowrap'><select  style=\"text-align:center;width:35px;background-color:".$color."\" ".(($vFocus==1)?' tabindex="1"':'').'" onblur="UpdateMonthly(\''.$this->ArrEmp[$i][8].'\',\''.$this->ArrEmp[$i][0].'\',this.value,30)" lang="UpdateMonthly(\''.$this->ArrEmp[$i][8].'\',\''.$this->ArrEmp[$i][0].'\',@!99,30)" class="linecontrol_30">'.$this->CreateSelectArr($vArrInsurance,$this->ArrEmp[$i][30])."</select></td>
			<td nowrap='nowrap'><input  style=\"text-align:center;width:30px;background-color:".$color."\" ".(($vFocus==1)?' tabindex="1"':'').'" onblur="UpdateMonthly(\''.$this->ArrEmp[$i][8].'\',\''.$this->ArrEmp[$i][0].'\',this.value,28)" lang="UpdateMonthly(\''.$this->ArrEmp[$i][8].'\',\''.$this->ArrEmp[$i][0].'\',@!99,28)" class="linecontrol_28" value="'.$this->ArrEmp[$i][28]."\"/></td>
			<td nowrap='nowrap'><input  style=\"text-align:center;width:30px;background-color:".$color."\" ".(($vFocus==1)?' tabindex="1"':'').'" onblur="UpdateMonthly(\''.$this->ArrEmp[$i][8].'\',\''.$this->ArrEmp[$i][0].'\',this.value,29)" lang="UpdateMonthly(\''.$this->ArrEmp[$i][8].'\',\''.$this->ArrEmp[$i][0].'\',@!99,29)" class="linecontrol_29" value="'.$this->ArrEmp[$i][29]."\"/></td>
			";
			
			$vp_col3_3="<td nowrap='nowrap'>".$this->GetValueArr($vArrPetrol,$this->ArrEmp[$i][9])."</td><td nowrap='nowrap'>".$this->GetValueArr($vArr,$this->ArrEmp[$i][4])."</td>";
			$vp_col4=str_replace("<!--","&nbsp;<!--",$this->ArrEmp[$i][6]);
			echo $vp_col4;
			$vp_col4=str_replace("#@@99",$color,$vp_col4);
			if($childfunc=="rpt"  || $childfunc=="excel" || $childfunc=="word" || $childfunc=="pdf")
				
				$vp_col5="<td nowrap='nowrap'>".$this->LV_GetTCEmpSum($this->ArrEmp[$i][0])."</td></tr>";
			else
				
				$vp_col5="<td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td></tr>";
			
			{
				if($childfunc=="rpt"  || $childfunc=="excel" || $childfunc=="word" || $childfunc=="pdf")
					$vp_col1="<td nowrap='nowrap'>".($i+1)."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td>";
				else
					$vp_col1="<td nowrap='nowrap'>".($i+1)."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][2]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][0]."</td><td nowrap='nowrap'>".$this->ArrEmp[$i][1]."</td>";
				
				if($this->is_tc09_apr==1)
				{
					
					if($this->ArrEmp[$i][7]==1)
					
						$lvListTrAll=$lvListTrAll."<tr style='background-color:".$color."'>$vp_col1$vp_col2$vp_col3_2".$vp_col4.$vp_col5;
					else
					{
						
						$lvListTrAll=$lvListTrAll."<tr style='background-color:".$color."'>$vp_col1$vp_col2_1$vp_col3_2".$vp_col4.$vp_col5;
					}
							
				}
				else
					$lvListTrAll=$lvListTrAll."<tr style='background-color:".$color."'>$vp_col1$vp_col2_2$vp_col3_2".$vp_col4.$vp_col5;
				
					
			}
		}
		$lvStrXML=str_replace("@33",'',$lvStrXML);$lvStrXML=str_replace("@32",'',$lvStrXML);$lvStrXML=str_replace("@31",'',$lvStrXML);
		$lvStrXML=str_replace("@30",'',$lvStrXML);
		$lvStrXML=str_replace("@29",'',$lvStrXML);
		$lvStrXML=str_replace("@28",'',$lvStrXML);
		$lvStrXML=str_replace("@27",'',$lvStrXML);
		$lvStrXML=str_replace("@26",'',$lvStrXML);
		$lvStrXML=str_replace("@25",'',$lvStrXML);
		$lvStrXML=str_replace("@24",'',$lvStrXML);
		$lvStrXML=str_replace("@23",'',$lvStrXML);
		$lvStrXML=str_replace("@22",'',$lvStrXML);
		$lvStrXML=str_replace("@21",'',$lvStrXML);
		$lvStrXML=str_replace("@20",'',$lvStrXML);
		$lvStrXML=str_replace("@19",'',$lvStrXML);
		$lvStrXML=str_replace("@18",'',$lvStrXML);
		$lvStrXML=str_replace("@17",'',$lvStrXML);
		$lvStrXML=str_replace("@16",'',$lvStrXML);
		$lvStrXML=str_replace("@15",'',$lvStrXML);
		$lvStrXML=str_replace("@14",'',$lvStrXML);
		$lvStrXML=str_replace("@13",'',$lvStrXML);
		$lvStrXML=str_replace("@12",'',$lvStrXML);
		$lvStrXML=str_replace("@11",'',$lvStrXML);
		$lvStrXML=str_replace("@10",'',$lvStrXML);
		$lvStrXML=str_replace("@09",'',$lvStrXML);
		$lvStrXML=str_replace("@08",'',$lvStrXML);
		$lvStrXML=str_replace("@07",'',$lvStrXML);
		$lvStrXML=str_replace("@06",'',$lvStrXML);
		$lvStrXML=str_replace("@05",'',$lvStrXML);
		$lvStrXML=str_replace("@04",'',$lvStrXML);
		$lvStrXML=str_replace("@03",'',$lvStrXML);
		$lvStrXML=str_replace("@02",'',$lvStrXML);
		$lvStrXML=str_replace("@01",'',$lvStrXML);
		$vXMLFile=str_replace("@#01",$lvStrXML,$vXMLFile);
		//echo '<textarea>'.$vXMLFile.'</textarea>';
		/*
		$myfile = fopen("tc_lv0041/MAU.xml", "w") or die("Unable to open file!");
		fwrite($myfile, $vXMLFile);
		fclose($myfile);
		$zip = new ZipArchive;
		$res = $zip->open('tc_lv0041/MAU.zip', ZipArchive::CREATE);
		if ($res === TRUE) {
			$zip->addFromString("MAU.xml", $vXMLFile);
			$zip->close();
			//echo 'ok';
		} else {
			//echo 'failed';
		}*/
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
			case 'lv015':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0004 where lv001='$vSelectID'";
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