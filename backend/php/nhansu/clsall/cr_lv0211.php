<?php
/////////////coding cr_lv0090///////////////
class   cr_lv0211 extends lv_controler
{
	public $isConnectSQLSERVER = false;
	
	public $lv001=null;
	public $lv002=null;
	public $lv003=null;
	public $lv004=null;
	public $lv005=null;
	public $lv006=null;
	public $lv007=null;


///////////
	public $DefaultFieldList="lv008,lv005,lv016,lv909,lv014,lv003,lv004,lv011,lv012,lv013,lv015,lv008,lv006,lv007,lv010,lv009";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='cr_lv0090';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv909"=>"910");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"22","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"22","lv016"=>"0","lv909"=>"0");	
	var $ArrViewEnter=array("lv015"=>"-1","lv016"=>"44","lv014"=>"999","lv013"=>"33","lv001"=>"-1","lv001"=>"-2","lv004"=>"5","lv005"=>"22","lv012"=>"5","lv007"=>"-1","lv008"=>"-1","lv006"=>"-1","lv009"=>"-1","lv010"=>"-1");
	var $Tables=array("lv014"=>"sl_lv0001");
	var $TableLink=array("lv014"=>"concat(lv001,@! @!,lv002)");
	var $TableLinkReturn=array("lv014"=>"lv002");
	
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
	function LV_GetManageCV()
	{
		$lvsql="select B.lv001 from  hr_lv0002 B  where (B.lv300='$this->LV_UserID')";
		$lvResult= db_query($lvsql);
		while($row= db_fetch_array($lvResult))
		{
			if($vResult=="")
				$vResult="".$row['lv001']."";
			else
				$vResult=$vResult.",".$row['lv001']."";;					
		}
		if($vResult=='') 
			return "''";
		else
			return $vResult;
	}
	protected function LV_CheckLock()
	{
		$lvsql="select lv027 from cr_lv0005 B where  B.lv001='$this->lv002'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if($vrow['lv027']>=2)
			{
				$this->isAdd=0;	
				$this->isEdit=0;	
				$this->isDel=0;	
			}
		}
		
	}
	function LV_Load()
	{
		$vsql="select * from  cr_lv0090";
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
			$this->lv011=$vrow['lv011'];
			$this->lv012=$vrow['lv012'];
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  cr_lv0090 Where lv001='$vlv001'";
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
			$this->lv011=$vrow['lv011'];
			$this->lv012=$vrow['lv012'];
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
		}
	}
	function LV_Insert()
	{
		if($this->isAdd==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang).' '.substr($this->lv005,11,8):$this->DateDefault;
		//$this->lv015 = ($this->lv015!="")?recoverdate(($this->lv015), $this->lang):$this->DateDefault;
		$lvsql="insert into cr_lv0090 (lv002,lv003,lv004,lv005,lv015,lv008,lv011,lv012,lv013,lv014,lv016) values('$this->lv002','".sof_escape_string($this->lv003)."','".sof_escape_string($this->lv004)."','$this->lv005',now(),'$this->LV_UserID','".sof_escape_string($this->lv011)."','".sof_escape_string($this->lv012)."','".sof_escape_string($this->lv013)."','".sof_escape_string($this->lv014)."','".sof_escape_string($this->lv016)."')";
		$vReturn= db_query($lvsql);
		if($vReturn){	
		 	$this->InsertLogOperation($this->DateCurrent,'cr_lv0090.insert',sof_escape_string($lvsql));
		 }
		return $vReturn;
	}	
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang).' '.substr($this->lv005,11,8):$this->DateDefault;
		$lvsql="Update cr_lv0090 set lv005='".sof_escape_string($this->lv005)."',lv006='".sof_escape_string($this->lv006)."',lv007='".sof_escape_string($this->lv007)."',lv011='".sof_escape_string($this->lv011)."',lv012='".sof_escape_string($this->lv012)."',lv013='".sof_escape_string($this->lv013)."',lv014='".sof_escape_string($this->lv014)."',lv016='".sof_escape_string($this->lv016)."' where  lv001='$this->lv001' and lv009=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'cr_lv0090.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$vUserID=$this->LV_UserID;
		$lvsql = "Update cr_lv0090 set lv009=1,lv007=now(),lv008='$this->LV_UserID'  WHERE cr_lv0090.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'cr_lv0090.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_UnAproval($lvarr)
	{
		if($this->isApr==0) return false;
		$vUserID=$this->LV_UserID;
		$lvsql = "Update cr_lv0090 set lv009=0,lv007=now(),lv008='$this->LV_UserID'  WHERE cr_lv0090.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'cr_lv0090.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_CheckLocked($vlv002)
	{
		$lvsql="select lv027 from  cr_lv0005 Where lv001='$vlv002'";
		$vresult=db_query($lvsql);
		if($vresult){
		$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				if($vrow['lv027']<=3) return true;
				else 
					return false;
			}
			else
			return false;
		}else
		return false;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM cr_lv0090  WHERE cr_lv0090.lv001 IN ($lvarr) and lv009=0 ";
		$vReturn= db_query($lvsql);
		if($vReturn) {
			$this->InsertLogOperation($this->DateCurrent,'cr_lv0090.delete',sof_escape_string($lvsql));
		}
		return $vReturn;
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
	//////////Get Filter///////////////
	protected function GetCondition()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002='$this->lv002'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and A.lv007 like '%$this->lv007%'";
		//if($this->lv008!="") $strCondi=$strCondi." and A.lv008='$this->lv008'";
		if($this->ListStaff!="")
		{
			if($this->lv008=='')
				$strCondi=$strCondi." and (  A.lv008 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv029 in (".$this->LV_GetDep($this->ListStaff).")").")";
			else
				$strCondi=$strCondi." and ( A.lv008='$this->lv008' OR A.lv008 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv029 in (".$this->LV_GetDep($this->ListStaff).")")."))";
		}
		else
		{
			if($this->lv008!="") $strCondi=$strCondi." and A.lv008='$this->lv008'";
		}
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM cr_lv0090 A WHERE 1=1 ".$this->GetCondition();
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
		<tr ><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>".$this->ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrderList,$lvSortNum)."</td></tr>
		@#01
		<tr ><td colspan=\"".(count($lstArr)+2)."\">$paging</td></tr>
		<tr ><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</td></tr>
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
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT A.*,C.lv009 lv909 FROM cr_lv0090 A inner join  cr_lv0005 B on A.lv002=B.lv001 inner join  cr_lv0004 C on B.lv002=C.lv001 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
				$vField=$lstArr[$i];
				$vStringNumber="";
				if($this->ArrViewEnter[$vField] = $this->ArrViewEnter[$vField] ?? 0) $this->ArrViewEnter[$vField]=0;
				$vStringNumber="";
				switch($this->ArrView[$vField] ?? 0)
				{
					case '10':
					case '20':
					case '1':
						$vStringNumber=' onfocus="LayLaiGiaTri(this)" onblur="SetGiaTri(this);" ';
						break;
				}
				switch($this->ArrViewEnter[$vField])
				{			
					case 99:
						if($this->isPopupPlus==0) $this->isPopupPlus=1;
						$vstr='<ul style="width:100%" id="pop-nav'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="pop-nav'.$this->isPopupPlus.'" onMouseOver="ChangeName(this,'.$this->isPopupPlus.')" onKeyUp="ChangeName(this,'.$this->isPopupPlus.')"> <li class="menupopT">
									<input autocomplete="off" class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:30px" name="qxt'.$vField.'" id="qxt'.$vField.'" onKeyUp="LoadPopupTabIndex(event,this,\'qxt'.$vField.'\',\''.$this->Tables[$vField].'\',\'concat(lv002,@! @!,lv001)\')"  onKeyPress="return CheckKey(event,7)" tabindex="2" onblur="LoadSource(this.value)" value="'.$this->Values[$vField].'">
									<div id="lv_popup'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="lv_popup'.$this->isPopupPlus.'"> </div>						  
									</li>
								</ul>';
						$this->isPopupPlus++;
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 999:
						if($this->isPopupPlus==0) $this->isPopupPlus=1;
						$vstr='<ul style="width:100%" id="pop-nav'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="pop-nav'.$this->isPopupPlus.'" onMouseOver="ChangeName(this,'.$this->isPopupPlus.')" onKeyUp="ChangeName(this,'.$this->isPopupPlus.')"> <li class="menupopT">
									<input autocomplete="off" class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:30px" name="qxt'.$vField.'" id="qxt'.$vField.'" onKeyUp="LoadSelfNext(this,\'qxt'.$vField.'\',\''.$this->Tables[$vField].'\',\''.$this->TableLinkReturn[$vField].'\',\''.$this->TableLink[$vField].'\')"  onKeyPress="return CheckKey(event,7)" tabindex="2" value="'.$this->Values[$vField].'" onblur="if(this.value.substr(this.value.length-1,this.value.length)==\',\') {this.value=this.value.substr(0,this.value.length-1);};">
									<div id="lv_popup'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="lv_popup'.$this->isPopupPlus.'"> </div>						  
									</li>
								</ul>';
						$this->isPopupPlus++;
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 88:
						$vstr='<select class="selenterquick" name="qxt'.$vField.'" id="qxt'.$vField.'" tabindex="2" style="width:100%;min-width:30px" onKeyPress="return CheckKey(event,7)">'.$this->LV_LinkField($vField,$this->Values[$vField]).'</select>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 89:
							$vstr='<select class="selenterquick" name="qxt'.$vField.'" id="qxt'.$vField.'" tabindex="2" style="width:100%;min-width:30px" onKeyPress="return CheckKey(event,7)">
								<option value="">...</option>
							'.$this->LV_LinkField($vField,$this->Values[$vField]).'</select>';
							$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
							break;
					case 4:
						$vstr='<table><tr><td><input autocomplete="off" class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'_1" type="text" id="qxt'.$vField.'_1" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:100%;min-width:80px" onKeyPress="return CheckKey(event,7)" ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;"></td><td><input class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'_2" type="text" id="qxt'.$vField.'_2" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:50%;min-width:60px" onKeyPress="return CheckKey(event,7)" ></td></tr></table>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 22:
							$vstr='
							<table>
								<tr>
									<td>
									<input autocomplete="off" name="qxt'.$vField.'" id="qxt'.$vField.'" value="'.$this->Values[$vField].'" tabindex="2" maxlength="50" style="width:100px" onKeyPress="return CheckKey(event,7)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmchoose.qxtlv005);return false;">
									</td>
									<td>
										<select name="qxt'.$vField.'_" id="qxt'.$vField.'_" type="text"  value="'.$this->tv005_.'" tabindex="10" maxlength="50" style="width:100px;text-align:center;" onKeyPress="return CheckKey(event,7)">
											<option value="00:00:00">---</option>
											<option value="08:00:00" selected="selected">08:00:00</option>
											<option value="09:00:00">09:00:00</option>
											<option value="10:00:00">10:00:00</option>
											<option value="11:00:00">11:00:00</option>
											<option value="12:00:00">12:00:00</option>
											<option value="13:00:00">13:00:00</option>
											<option value="14:00:00">14:00:00</option>
											<option value="15:00:00">15:00:00</option>
											<option value="16:00:00">16:00:00</option>
											<option value="17:00:00" >17:00:00</option>
											<option value="18:00:00">18:00:00</option>
										</select>
									</td>
								</tr>
							</table>';
							$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
							break;	
						case 44:
							$vstr='
							<table>
								<tr>
									<td>
										<select name="qxt'.$vField.'" id="qxt'.$vField.'" type="text"  tabindex="10" maxlength="50" style="width:100px;text-align:center;" onKeyPress="return CheckKey(event,7)">
											<option value="00:00:00">---</option>
											<option value="08:00:00">08:00:00</option>
											<option value="09:00:00">09:00:00</option>
											<option value="10:00:00">10:00:00</option>
											<option value="11:00:00">11:00:00</option>
											<option value="12:00:00">12:00:00</option>
											<option value="13:00:00">13:00:00</option>
											<option value="14:00:00">14:00:00</option>
											<option value="15:00:00">15:00:00</option>
											<option value="16:00:00">16:00:00</option>
											<option value="17:00:00" selected="selected">17:00:00</option>
											<option value="18:00:00">18:00:00</option>
										</select>
									</td>
								</tr>
							</table>';
							$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
							break;	
					case 2:
						$vstr='<input autocomplete="off" class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'" type="text" id="qxt'.$vField.'" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:100%;min-width:60px" onKeyPress="return CheckKey(event,7)" ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;">';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 33:
						$vstr='<input autocomplete="off" class="txtenterquick" name="qxt'.$vField.'" type="checkbox" id="qxt'.$vField.'" value="1" '.(($this->Values[$vField]==1)?'checked="true"':'').' tabindex="2" style="width:100%;min-width:30px;text-align:center;" onKeyPress="return CheckKey(event,7)">';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 5:
						$vstr='<textarea '.$vStringNumber.' autocomplete="off" class="txtenterquick" name="qxt'.$vField.'" type="text" id="qxt'.$vField.'" tabindex="2" style="width:100%;min-width:80px;text-align:center;height:18px;" onKeyPress="return CheckKey(event,7)">'.$this->Values[$vField].'</textarea>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 0:
						$vstr = '<input '.$vStringNumber.' autocomplete="off" class="txtenterquick" name="qxt'.$vField.'" type="text" id="qxt'.$vField.'" value="'.htmlspecialchars($this->Values[$vField] ?? '', ENT_QUOTES).'" tabindex="2" style="width:100%;min-width:30px;text-align:center;" onKeyPress="return CheckKey(event,7)">';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					default:
						$vTempEnter="<td>&nbsp;</td>";
						break;
				}
				$strTrEnter=$strTrEnter.$vTempEnter;
				$strTrEnterEmpty=$strTrEnterEmpty."<td>&nbsp;</td>";
			}
		if($this->isAdd==1) 
			$strTrEnter="<tr class='entermobil'><td colspan='2'>".'<img tabindex="2" border="0" title="Add" class="imgButton" onclick="Save()" onmouseout="this.src=\'../images/iconcontrol/btn_add.jpg\';" onmouseover="this.src=\'../images/iconcontrol/btn_add_02.jpg\';" src="../images/iconcontrol/btn_add.jpg" onkeypress="return CheckKey(event,11)">'."</td>".$strTrEnter."</tr>";
		else
			$strTrEnter="";//"<tr class='entermobil'><td colspan='2'>".'&nbsp;'."</td>".$strTrEnterEmpty."</tr>";
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{	
					
					case 'lv013':
						if($this->GetEdit()==1 && $vrow['lv009']==0)
						{													
							$lvTdTextBox="<td align=center><input class='txtenterquick' type=\"checkbox\" value=\"1\" ".(($vrow['lv013']==1)?'checked="true"':'')." @03 onclick=\"UpdateTextCheck(this,'".$vrow['lv001']."',13)\" style=\"width:35px;text-align:center;\" tabindex=\"2\" maxlength=\"32\"   onKeyPress=\"return CheckKey(event,7)\"/></td>";
							$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],0),$this->Align(str_replace("@01",$vrow['lv001'],$lvTdTextBox),(int)$this->ArrView[$lstArr[$i]]));	
						}
						else
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				//$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH.$strTrEnter.$strTr,$lvTable);
	}
	
/////////////////////ListFieldExport//////////////////////////
	function ListFieldExport($lvFrom,$lvList,$maxRows)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=",".$lvList.",";
		$lstArr=explode(",",$this->DefaultFieldList);
		$lvSelect="<ul id=\"menu1-nav\" onkeyup=\"return CheckKeyCheckTabExp(event)\">
						<li class=\"menusubT1\"><img src=\"$this->Dir../images/lvicon/export.png\" border=\"0\" />".$this->ArrFunc[12]."
							<ul id=\"submenu1-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript="		
		<script language=\"javascript\">
		function Export(vFrom,value)
		{
			window.open('".$this->Dir."cr_lv0090/?lang=".$this->lang."&childdetailfunc='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
		return '';	
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
		$sqlS = "SELECT A.*,C.lv009 lv909 FROM cr_lv0090 A inner join  cr_lv0005 B on A.lv002=B.lv001  inner join  cr_lv0004 C on B.lv002=C.lv001 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	
//////////////////////Buil list////////////////////
	//////////////////////Buil list////////////////////
	function LV_BuilListReportOther($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$vTax)
	{
		return '';	
		if($lvList=="") $lvList=$this->DefaultFieldList;
		if($this->isView==0) return false;
		$lvList=$lvList."";
		$lvOrderList=$lvOrderList."";
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
		$lvTable="<table  align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\">
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
		$lvTrTotal="<tr >
			<td class=\"lvlineboldtable\"  colspan=@04>@03</td>
			<td class=\"lvlineboldtable\">@01</td>
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT A.* FROM cr_lv0090 A inner join  cr_lv0005 B on A.lv002=B.lv001 inner join  cr_lv0004 C on B.lv002=C.lv001 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$strSubTotal=0;
		$strSubTax=0;
		$strTotalAmount=0;
		$vUnitPrice="VND";
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
				if($lstArr[$i]=="lv013")
				{
					if($vTax>0 || $vTax==-1)
					{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv004']*$vrow['lv006'],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
					else
					{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv004']*$vrow['lv006']+$vrow['lv004']*$vrow['lv006']*$vrow['lv008']/100,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
				}
				else
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])).(($lstArr[$i]=='lv008')?'%':''),$lvTd);
				$strL=$strL.$vTemp;
			}
			$vUnitPrice=$this->getvaluelink('lv007',$this->FormatView($vrow['lv007'],(int)$this->ArrView[$vrow['lv007']]));
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vTax>0 || $vTax==-1)
			{
				$strSubTotal=$strSubTotal+$vrow['lv004']*$vrow['lv006'];
			}
			else
			{
				$strSubTotal=$strSubTotal+$vrow['lv004']*$vrow['lv006']+$vrow['lv004']*$vrow['lv006']*$vrow['lv008']/100;
			}
			
		}
		/*$strLine=str_replace("@01",$this->FormatView($strSubTotal,1),$lvTrTotal);
			$strLine=str_replace("@03",$this->ArrPush[15],$strLine);
			$strLine=str_replace("@04",count($lstArr),$strLine);
			$strTr=$strTr.$strLine;
			if($vTax>0)
			{
			$strSubTax=$strSubTotal*$vTax/100;
			$strLine=str_replace("@01",$this->FormatView($strSubTax,1),$lvTrTotal);
			$strLine=str_replace("@03",str_replace("@02",$this->FormatView($vTax,10),$this->ArrPush[16]),$strLine);
			$strLine=str_replace("@04",count($lstArr),$strLine);
			$strTr=$strTr.$strLine;
			}
		
			$strTotalAmount=$strSubTotal+$strSubTax;
			$strLine=str_replace("@01",$this->FormatView($strTotalAmount,1),$lvTrTotal);
			$strLine=str_replace("@03",$this->ArrPush[17],$strLine);
			$strLine=str_replace("@04",count($lstArr),$strLine);
			$strTr=$strTr.$strLine;*/
		$strTrH=str_replace("@#01",str_replace("@01","(".$vUnitPrice.")",$strH),$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	function LV_CheckQuyenQuanLy($NDPLAN,$NTPLAN,$NSPLAN)
	{
		if($_SESSION['ERPSOFV2RRight']=='admin') return true;
		if($this->LV_UserID==$NDPLAN) return true;
		if($this->LV_UserID==$NTPLAN) return true;
		if($this->LV_UserID==$NSPLAN) return true;
		return false;
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
	function LV_GetNameVietTat($vPBID)
	{
		if($this->ArrPBVT[$vPBID][0]) return $this->ArrPBVT[$vPBID][1];
		$this->OrderRun=0;
		$vsql="select lv002,lv004 from  hr_lv0002 where lv001='$vPBID'";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			if(trim($vrow['lv004'])=='')
				 $this->ArrPBVT[$vPBID][1]=$this->LV_GetNameVietTatParent($vrow['lv002']);
			else
				$this->ArrPBVT[$vPBID][1]=$vrow['lv004'];
			break;
		}
		$this->ArrPBVT[$vPBID][0]=true;
		return $this->ArrPBVT[$vPBID][1];
	}
	
	function LV_GetNameVietTatParent($vPBID)
	{
		$this->OrderRun++;
		if($this->OrderRun>10) return '';
		if($vPBID=='SOF') return '';
		$vsql="select lv002,lv004 from  hr_lv0002 where lv001='$vPBID'";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			if(trim($vrow['lv004'])=='')
				return $this->LV_GetNameVietTatParent($vrow['lv002']);
			else
				return $vrow['lv004'];
		}
	}
	function LV_XuLyTuNgayDenNgay($vDateFrom,$vDateTo)
	{
		$vArrWork=Array();
		if($vDateFrom)
		{
			$vCondition=$vCondition." and A.lv005>='$vDateFrom 00:00:00'";
			$vCondition1=$vCondition1." and AC.lv005>='$vDateFrom 00:00:00'";
		}
		if($vDateTo)
		{
			$vCondition=$vCondition." and A.lv005<='$vDateTo 23:59:59'";
			$vCondition1=$vCondition1." and AC.lv005<='$vDateTo 23:59:59'";
		}
		///DS ngay lam viec
		$sqlS = "
		select MP.* from (
		SELECT A.lv001,A.lv015,A.lv008,A.lv005,A.lv016,A.lv014,A.lv003,A.lv004,A.lv011,A.lv012,A.lv013,A.lv006,A.lv009,AA.lv008 NDPLAN,C.lv004 NTPLAN,C.lv097 NSPLAN,C.lv009 lv909,A.lv008 lv499 FROM cr_lv0090  A  inner join cr_lv0005  AA on A.lv002=AA.lv001  inner join cr_lv0004 C on AA.lv002=C.lv001 inner join cr_lv0003 D on AA.lv003=D.lv001  where 1=1  $vCondition 
		union
		SELECT A.lv001,A.lv015,A.lv008,IF(ISNULL(AC.lv005),now(),AC.lv005) lv005,A.lv016,A.lv014,A.lv003,A.lv004,A.lv011,A.lv012,AC.lv013,A.lv006,A.lv009,AA.lv008 NDPLAN,C.lv004 NTPLAN,C.lv097 NSPLAN,C.lv009 lv909,A.lv008 lv499 FROM cr_lv0310 AC  inner join cr_lv0090  A  on AC.lv002=A.lv001 and LEFT(AC.lv005,10)=curdate()  inner join cr_lv0005  AA on A.lv002=AA.lv001  inner join cr_lv0004 C on AA.lv002=C.lv001 inner join cr_lv0003 D on AA.lv003=D.lv001  where 1=1  $vCondition1 
		) MP order by MP.lv015 asc ";
		//$sqlS = "SELECT A.*,AA.lv008 NDPLAN,C.lv004 NTPLAN,C.lv097 NSPLAN,C.lv009 lv909,AA.lv004 TenCV FROM cr_lv0090  A  inner join cr_lv0005  AA on A.lv002=AA.lv001  inner join cr_lv0004 C on AA.lv002=C.lv001 inner join cr_lv0003 D on AA.lv003=D.lv001  where 1=1  $vCondition order by A.lv005 asc ";
		$bResult=db_query($sqlS);
		while ($vrow = db_fetch_array ($bResult)){
			
			$vDateBC=substr($vrow['lv005'],0,10);
			$vArrWork[$vrow['lv008']][$vDateBC][0]=true;
			$vArrWork[$vrow['lv008']][$vDateBC][1]++;
			$vArrWork[$vrow['lv008']][$vDateBC][2]=$vArrWork[$vrow['lv008']][$vDateBC][2].$vrow['TenCV']." | ".$vrow['lv909']." | ".$vrow['lv014']." | ".$vrow['lv004']." | ".$vrow['lv012'].'<br/>';
		}
		return $vArrWork;
	}
	//////////////////////Buil list////////////////////
	function LV_BuilListReport_Short($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
	{
		$vCondition='';
		if($this->DateFrom)
		{
			$vCondition=$vCondition." and A.lv005>='$this->DateFrom 00:00:00'";
		}
		if($this->DateTo)
		{
			$vCondition=$vCondition." and A.lv005<='$this->DateTo 23:59:59'";
		}
		if($this->DepID!='')
		{
			$vCondition=$vCondition." and A.lv008 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv029 in (".$this->LV_GetDep($this->DepID).")").")";
		}
		if($this->ListStaff!='')
		{
			if($this->lv008=='')
				$vCondition=$vCondition." and (  A.lv008 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv029 in (".$this->LV_GetDep($this->ListStaff).")").")";
			else
				$vCondition=$vCondition." and ( A.lv008='$this->lv008' OR A.lv008 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv029 in (".$this->LV_GetDep($this->ListStaff).")")."))";
		}
		else
		{
			if($this->lv008!='')
			{
				$vCondition=$vCondition." and A.lv008='$this->lv008'";
			}
		}
		if($this->lv009!='')
		{
			$vCondition=$vCondition." and A.lv009='$this->lv009'";
		}
		if($this->PlanID!='')
		{
			$vCondition=$vCondition." and AA.lv002='$this->PlanID'";
		}
		if($this->lv003!='')
		{
			$vCondition=$vCondition." and AA.lv003='$this->lv003'";
		}
		
		///DS ngay lam viec
		$sqlS = "SELECT A.*,AA.lv008 NDPLAN,C.lv004 NTPLAN,C.lv097 NSPLAN,C.lv009 lv909,AA.lv004 TenCV FROM cr_lv0090  A  inner join cr_lv0005  AA on A.lv002=AA.lv001  inner join cr_lv0004 C on AA.lv002=C.lv001 inner join cr_lv0003 D on AA.lv003=D.lv001  where 1=1  $vCondition order by A.lv005 asc ";
		$bResult=db_query($sqlS);
		while ($vrow = db_fetch_array ($bResult)){
			
			$vDateBC=substr($vrow['lv005'],0,10);
			$vArrWork[$vrow['lv008']][$vDateBC][0]=true;
			$vArrWork[$vrow['lv008']][$vDateBC][1]++;
			$vArrWork[$vrow['lv008']][$vDateBC][2]=$vArrWork[$vrow['lv008']][$vDateBC][2].$vrow['TenCV']." | ".$vrow['lv909']." | ".$vrow['lv014']." | ".$vrow['lv004']." | ".$vrow['lv012'].'<br/>';
		}
		//Danh sách nhân viên.
		$vCondition1=' and A.lv019=1 ';
		if($this->DepID!='')
		{
			$vCondition1=$vCondition1." and A.lv001 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv029 in (".$this->LV_GetDep($this->DepID).")").")";
		}
		
		if($this->NVID!='')
		{
			$vCondition1=$vCondition1." and A.lv001='$this->NVID'";
		}
		
		$lvNumDate=DATEDIFF($this->DateTo,$this->DateFrom)+1;
		$vDateBC=str_replace("/","-",$this->DateFrom);
		
		for($i=1;$i<=$lvNumDate;$i++)
		{
			$vSTT=0;
			$vStrTR=$vStrTR.'<tr  class="lvlinehtable'.(($vSTT%2)?1:0).'"><td colspan="6"><strong>Báo cáo ngày: '.$this->FormatView($vDateBC,2).'</strong></td></tr>';

			$vsql="select * from hr_lv0020 A where 1=1 $vCondition1 order by A.lv029";
			$bResult=db_query($vsql);
			while ($vrow = db_fetch_array ($bResult)){
				$isRun=true;
				if($vrow['lv009']==2 || $vrow['lv009']==3)
				{
					if(getyear($vrow['lv044'])<2000)
					{
						$isRun=false;
					}
					else
					{
						if($vDateBC>$vrow['lv044'])
						{
							$isRun=false;
						}
					}

				}
				if($isRun==true)
				{
					if($vArrWork[$vrow['lv001']][$vDateBC][0]==true)
					{
						$vTitle="Đã báo cáo";
						$vNoteBC=$vArrWork[$vrow['lv001']][$vDateBC][2];
					}
					else
					{
						$vTitle='Chưa báo cáo';
						$vNoteBC='';
					}
					switch($this->lv013)
					{
						case '0':
							
							if($vArrWork[$vrow['lv001']][$vDateBC][0]!=true)
							{
								$vSTT++;
								$vStrTR=$vStrTR.'<tr  class="lvlinehtable'.(($vSTT%2)?1:0).'"><td>'.$vSTT.'</td><td>'.$this->LV_GetNameVietTat($vrow['lv029']).'</td><td>'.$vrow['lv002'].'</td><td>'.$vTitle.'</td><td>'.$vNoteBC.'</td></tr>';
							}
							break;
						case '1':
							if($vArrWork[$vrow['lv001']][$vDateBC][0]==true)
							{
								$vSTT++;
								$vStrTR=$vStrTR.'<tr  class="lvlinehtable'.(($vSTT%2)?1:0).'"><td>'.$vSTT.'</td><td>'.$this->LV_GetNameVietTat($vrow['lv029']).'</td><td>'.$vrow['lv002'].'</td><td>'.$vTitle.'</td><td>'.$vNoteBC.'</td></tr>';
							}
							break;
						default:
							$vSTT++;
							$vStrTR=$vStrTR.'<tr  class="lvlinehtable'.(($vSTT%2)?1:0).'"><td>'.$vSTT.'</td><td>'.$this->LV_GetNameVietTat($vrow['lv029']).'</td><td>'.$vrow['lv002'].'</td><td>'.$vTitle.'</td><td>'.$vNoteBC.'</td></tr>';
							break;
					}
				}
				
			}
			//break;
			$vDateBC=ADDDATE($this->DateFrom,$i);
		}
		$vStrTRTH='<tr class="lvhtable"><td>STT</td><td>Phòng ban</td><td>Tên</td><td>Kết quả</td><td>Nội dung báo cáo</td></tr>';
		return "<table align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\">".$vStrTRTH.$vStrTR.'</table>';
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
							$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow3['lv001']."' order by lv003";
							$bResult4=db_query($vsql);
							while ($vrow4 = db_fetch_array ($bResult4)){
								
								$vReturn=$vReturn."<option value='".$vrow4['lv001']."' ".(($vSelectID==$vrow4['lv001'])?'selected="selected"':'').">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$vrow4['lv003']."</option>";
							}
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
	function LV_BuilList7Day($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
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
		$lvTd="<td class=@#04 align=@#05 nowrap>@02</td>";
		$sqlS = "SELECT A.*,DATEDIFF(A.lv016,A.lv025) SoNgayXinPhep,B.lv029 lv829,A.lv015 lv099,IF(SUBSTR(A.lv003,1,3)='1/2',DATEDIFF(A.lv017,A.lv016)+0.5,IF(TIME_TO_SEC(TIMEDIFF(A.lv017,A.lv016))<TIME_TO_SEC('24:00:00'),1,DATEDIFF(A.lv017,A.lv016)+1)) lv098 FROM jo_lv0004 A inner join hr_lv0020 B on A.lv015=B.lv001 WHERE 1=1  ".$this->GetCondition7Day()."  order by A.lv016 asc";
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
			if($vrow['lv003']=='CT')
				{
					$vrow['lv008']='***';
				}
			if($vrow['SoNgayXinPhep']<2)
			{
				if($vrow['lv003']!='CT')
				{
				//$vrow['lv008']=$vrow['lv008'].'('.'Xin phép không đúng trước 2 ngày'.')';
				}
			}
			for($i=0;$i<count($lstArr);$i++)
			{
				//if($lstArr[$i]=='lv099')
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				//else
				//$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			//if($vrow['lv021']==1)
			{
				switch($vrow['lv021'])
				{
					case 0:
						$strTr=str_replace("@#04","lvlineapproval_level2",$strTr);
						break;
					case 1:
						$strTr=str_replace("@#04","lvlineapproval_black",$strTr);
						break;
					case 2:
						$strTr=str_replace("@#04","lvlineapproval_level3",$strTr);
						break;
				}
				
			}
		//else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
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
			case 'lv008':
				if($this->ListStaff!='')
				{
					if($this->lv008=='')
						$vCondition=$vCondition." and (  A.lv001 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv029 in (".$this->LV_GetDep($this->ListStaff).")").")";
					else
						$vCondition=$vCondition." and ( A.lv001='$this->lv008' OR A.lv001 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv029 in (".$this->LV_GetDep($this->ListStaff).")")."))";
				}
				else
				{
					if($this->lv008!='')
					{
						$vCondition=$vCondition." and A.lv001='$this->lv008'";
					}
				}
				$vsql="select A.lv001,A.lv002,IF(A.lv001='$vSelectID',1,0) lv003 from  hr_lv0020 A where 1=1 $vCondition ";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  cr_lv0215 ";
				break;
			default:
				$vsql="";
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
			case 'lv029':
				$lvopt=0;
				$vsql="select A.lv001,A.lv003 lv002,IF(A.lv001='$vSelectID',1,0) lv003 from  hr_lv0002 A where lv001='$vSelectID'";
				break;
			case 'lv008':
				$lvopt=0;
				$vsql="select A.lv001,A.lv002,IF(A.lv001='$vSelectID',1,0) lv003 from  hr_lv0020 A where lv001='$vSelectID'";
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