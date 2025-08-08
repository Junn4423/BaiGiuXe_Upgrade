<?php
/////////////coding ts_lv1001///////////////
class   ts_lv1001 extends lv_controler
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
	public $lv011=null;
	public $lv012=null;
	public $lv013=null;
	public $lv014=null;
	public $lv015=null;
	public $lv016=null;
	public $lv017=null;
	public $lv018=null;
	public $lv019=null;
	public $lv020=null;
	
///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='ts_lv1001';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"2","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"4","lv016"=>"0","lv017"=>"0","lv018"=>"6","lv019"=>"0","lv020"=>"2","lv021"=>"10");	

	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;
	 	$this->isFil=1;
		$this->lang=$_GET['lang'];		
		$this->lv036='0';
	}
	protected function LV_CheckLock()
	{
		$lvsql="select B.lv011,C.lv039 from sp_lv0009 B inner join sp_lv0008 C on B.lv002=C.lv001 where  B.lv001='$this->lv002'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if($vrow['lv011']!=1 && $vrow['lv039']!=1)
			{
				$this->isAdd=0;	
				$this->isEdit=0;	
				$this->isDel=0;	
			}
		}
		
	}
	function LV_Load()
	{
		$vsql="select * from  ts_lv1001";
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
			$this->lv015=$vrow['lv015'];
			$this->lv016=$vrow['lv016'];
			$this->lv017=$vrow['lv017'];
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  ts_lv1001 Where lv001='$vlv001'";
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
			$this->lv015=$vrow['lv015'];
			$this->lv016=$vrow['lv016'];
			$this->lv017=$vrow['lv017'];
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
		}
	}
	function LV_CheckLocked($vlv002)
	{
		$lvsql="select lv011 from  sp_lv0009 Where lv001='$vlv002'";
		$vresult=db_query($lvsql);
		if($vresult){
		$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				if($vrow['lv011']==1) 
					return true;
				else 
					return false;
			}
			else
			return false;
		}else
		return false;
	}
	function LV_Insert()
	{
		if($this->isAdd==0) return false;
		$this->lv011 = ($this->lv011!="")?recoverdate(($this->lv011), $this->lang)." ".gettime($this->lv011):$this->DateDefault;
		$this->lv020 = ($this->lv020!="")?recoverdate(($this->lv020), $this->lang)." ".gettime($this->lv020):$this->DateDefault;
	    $lvsql="insert into ts_lv1001 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv017,lv018,lv019,lv020) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv017','$this->lv018','$this->lv019','$this->lv020')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ts_lv1001.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_InsertTemp($vTemID,$vlv002)
	{
		$lvsql="select '$vTemID' lv002,lv003,lv004,lv005,lv006,lv007 from sl_lv0063 where lv002='$vlv002'";
		$vReturn= db_query($lvsql);
		while($vrow=db_fetch_array($vReturn))
		{
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];
			$this->lv007=$vrow['lv007'];
			$this->LV_Insert();
		}
		if($vReturn) $this->LV_DeleteTemp($vlv002);
		return $vReturn;
	}
	function LV_DeleteTemp($vlv002)
	{
		$lvsql = "DELETE FROM sl_lv0063  WHERE sl_lv0063.lv002='$vlv002'";
		$vReturn= db_query($lvsql);
		return $vReturn;
	}	
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$vUserID=getInfor($_SESSION['ERPSOFV2RUserID'], 2);
		$lvsql = "Update ts_lv1001 set lv016=1,lv014='$vUserID',lv015=concat(CURDATE(),' ',CURTIME())  WHERE ts_lv1001.lv001 IN ($lvarr) and ts_lv1001.lv016=0  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ts_lv1001.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_UnAproval($lvarr)
	{
		if($this->isUnApr==0) return false;
		$vUserID=getInfor($_SESSION['ERPSOFV2RUserID'], 2);
		$lvsql = "Update ts_lv1001 set lv016=0,lv014='$vUserID',lv015=concat(CURDATE(),' ',CURTIME())  WHERE ts_lv1001.lv001 IN ($lvarr) and ts_lv1001.lv016=1  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ts_lv1001.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Update()
	{
		
		if($this->isEdit==0) return false;
		$this->lv011 = ($this->lv011!="")?recoverdate(($this->lv011), $this->lang)." ".gettime($this->lv011):$this->DateDefault;
		$this->lv020 = ($this->lv020!="")?recoverdate(($this->lv020), $this->lang)." ".gettime($this->lv020):$this->DateDefault;
		$lvsql="Update ts_lv1001 set lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv017='$this->lv017',lv018='$this->lv018',lv019='$this->lv019' where  lv001='$this->lv001' and lv016=0";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ts_lv1001.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM ts_lv1001  WHERE ts_lv1001.lv001 IN ($lvarr) and lv016=0";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ts_lv1001.delete',sof_escape_string($lvsql));
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
		if($this->lv001!="") $strCondi=$strCondi." and lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and lv002  = '$this->lv002'";
		if($this->lv003!="") $strCondi=$strCondi." and lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and lv007 like '%$this->lv007%'";
		if($this->lv007!="")  $strCondi=$strCondi." and lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and lv010 like '%$this->lv010%'";
		if($this->lv011!="")  $strCondi=$strCondi." and lv011 like '%$this->lv011%'";
		if($this->lv012!="")  $strCondi=$strCondi." and lv012 like '%$this->lv012%'";
		if($this->lv017!="")  $strCondi=$strCondi." and lv017 like '%$this->lv017%'";
		if($this->lv019!="")  $strCondi=$strCondi." and lv019 like '%$this->lv019%'";
		if($this->lv020!="")  $strCondi=$strCondi." and lv020 like '%$this->lv020%'";
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM ts_lv1001 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_InsertInvoice($vDate,$vopt,$vUserID,$plang,$vCompanyID)
	{
		$vCondition="";
		if($vCompanyID!="" || $vCompanyID!=NULL) $vCondition=" and A.lv019='$vCompanyID'";
		$vDate=recoverdate($vDate,$plang);
		if($vopt==0)
		{
			$lvsql="insert into ac_lv0048 
			(lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025) 
			select '$vUserID',A.lv012,'1','',A.lv003,'VND',A.lv004,A.lv003,B.lv020,B.lv021,A.lv013,A.lv010,A.lv011,'',A.lv005,A.lv005,'1331',0,0,0,A.lv008,A.lv009,A.lv007,C.lv013 from ts_lv1001 A left join sp_lv0005 B on A.lv012=B.lv001 left join ts_lv0003 C on A.lv005=C.lv001 where A.lv011='$vDate' $vCondition";
		}
		else
		{
				$lvsql="insert into ac_lv0048 
			(lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025) 
			select '$vUserID',A.lv012,'1','',A.lv003,'VND',A.lv004,A.lv003,B.lv020,B.lv021,A.lv013,A.lv010,A.lv011,'',A.lv005,A.lv005,'1331',0,0,0,A.lv008,A.lv009,A.lv007,C.lv013 from ts_lv1001 A left join sp_lv0005 B on A.lv012=B.lv001 left join ts_lv0003 C on A.lv005=C.lv001 where year(A.lv011)=year('$vDate') and month(A.lv011)=month('$vDate') $vCondition";
		}
		$vresult=db_query($lvsql);
	}
	function LV_GetSumMarkForSale($vEmployeeID,$opt=0,$vParent)
	{
		if($opt==0)
			$lvsql="select sum(lv005) convertmoney from ts_lv1001 A where A.lv002='$vParent' AND A.lv003 in (select B.lv002 from sl_lv0037 B where B.lv003='".$vEmployeeID."')";
		else	
			$lvsql="select sum(lv006) convertmoney from ts_lv1001 A where A.lv002='$vParent' AND A.lv003 in (select B.lv002 from sl_lv0037 B where B.lv004='".$vEmployeeID."')";
		$vresult=db_query($lvsql);
		$vrow = db_fetch_array ($vresult);
		
		return $vrow['convertmoney'];
	}	
			//////////////////////Buil list////////////////////
//////////////////////Buil list////////////////////
	function LV_BuilList($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
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
		<div id=\"func_id\" style='position:relative;background:#f2f2f2'><div style=\"float:left\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</div><div style=\"float:right\">".$this->ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrderList,$lvSortNum)."</div><div style='float:right'>&nbsp;&nbsp;&nbsp;</div><div style='float:right'>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</div></div><div style='height:35px'></div><table  align=\"center\" class=\"lvtable\"><!--<tr ><td colspan=\"".(2+count($lstArr))."\" class=\"lvTTable\">".$this->ArrPush[0]."</td></tr>-->
		@#01
		@#02
		<tr ><td colspan=\"".(count($lstArr)+2)."\">$paging</td></tr>
		<tr class=\"cssbold_tab\"><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right></td></tr>
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
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"2\">&nbsp;</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM ts_lv1001 WHERE 1=1 and lv017<>4 ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$strTrEnter="<td class=\"#04\">&nbsp;</td><td class=\"#04\">&nbsp;</td>";//<input type='hidden' name='qxtlv001' id='qxtlv001' value=''/><input onclick='Save()' tabindex='3' type='button' value='Thêm' style='width:80%'/></td>";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
				if($this->GetAdd()==1)
				{
				$vTempF=str_replace("@01","<!--".$lstArr[$i]."-->",$lvTdF);
				$strF=$strF.$vTempF;
				$vTempEnter="";
				switch($lstArr[$i])
				{
				
					case 'lv003':
						
						$vstr='<input class="txtenterquick" name="qxtlv003" type="text" id="qxtlv003" value="0" tabindex="2" maxlength="32" style="width:100%;min-width:50px" onKeyPress="return CheckKey(event,7)">';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv004':
						$vstr='<input  onKeyDown="CalculateC()"  onChange="CalculateC()"  class="txtenterquick"  name="qxtlv004" type="text" id="qxtlv004" value="0" tabindex="2" maxlength="255" style="width:100%;min-width:50px" onKeyPress="return CheckKey(event,7)"/>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv005':
						$vstr='<input class="txtenterquick"  name="qxtlv005" type="text" id="qxtlv005" value="0" tabindex="2" maxlength="255" style="width:100%;min-width:50px" onKeyPress="return CheckKey(event,7)"/>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv006':
						$vstr='<ul style="width:100%" id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onKeyUp="ChangeName(this,1)"> <li class="menupopT">
												<input class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:50px" name="qxtlv006" id="qxtlv006" onKeyUp="LoadPopupParentTabIndexChild(event,this,\'qxtlv006\',\'ts_lv0003\',\'concat(lv002,@! @!,lv001)\')" onKeyPress="return CheckKey(event,7)"  tabindex="2"">
												<div id="lv_popup" lang="lv_popup1"> </div>						  
												</li>
											</ul>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv007':
						$vstr='<input class="txtenterquick"  autocomplete="off" name="qxtlv007" type="text" id="qxtlv007" value="" tabindex="2" maxlength="32" style="width:100%;min-width:120px" onKeyPress="return CheckKey(event,7)"  onfocus="changecustomer_change(document.getElementById(\'qxtlv006\').value)">';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv008':
						$vstr='<input class="txtenterquick" name="qxtlv008" type="text" id="qxtlv008" value="" tabindex="2" maxlength="32" style="width:100%;min-width:50px" onKeyPress="return CheckKey(event,7)">';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv009':
						$vstr='<input class="txtenterquick" name="qxtlv009" type="text" id="qxtlv009" value="" tabindex="2" maxlength="32" style="width:100%;min-width:50px" onKeyPress="return CheckKey(event,7)">';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv010':
						$vstr='<input class="txtenterquick" name="qxtlv010" type="text" id="qxtlv010" value="" tabindex="2" maxlength="32" style="width:100%;min-width:50px" onKeyPress="return CheckKey(event,7)">';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv011':
						$vstr='<input class="txtenterquick"  autocomplete="off" name="qxtlv011" type="text" id="qxtlv011" value="'.$this->FormatView($this->DateCurrent,2).'" tabindex="2" maxlength="32" style="width:100%;min-width:120px" onKeyPress="return CheckKey(event,7)" ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;">';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;	
					case 'lv012':
						$vstr='<ul style="width:100%" id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onKeyUp="ChangeName(this,2)"> <li class="menupopT">
												<select class="selenterquick" name="qxtlv012" id="qxtlv012" tabindex="2" style="width:100%;min-width:59px" onKeyPress="return CheckKey(event,7)">'.$this->LV_LinkField('lv012',$this->lv012).'</select>
												<div id="lv_popup2" lang="lv_popup2"> </div>						  
												</li>
											</ul>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv013':
						$vstr='<input class="txtenterquick" name="qxtlv013" type="text" id="qxtlv013" value="" tabindex="2" maxlength="32" style="width:100%;min-width:50px" onKeyPress="return CheckKey(event,7)">';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv017':
						$vstr='<select class="selenterquick" name="qxtlv017" id="qxtlv017" tabindex="2" style="width:100%;min-width:59px" onKeyPress="return CheckKey(event,7)">'.$this->LV_LinkField('lv017',$this->lv017).'</select>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv018':
						$vstr='<input class="txtenterquick" name="userfile" type="file" id="userfile" value="" tabindex="2" maxlength="32" style="width:100%;min-width:50px" onKeyPress="return CheckKey(event,7)"><input class="txtenterquick" name="qxtlv018" type="hidden" id="qxtlv018" value="" tabindex="2" maxlength="32" style="width:100%;min-width:50px" onKeyPress="return CheckKey(event,7)">';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv019':
						$vstr='<select class="selenterquick" name="qxtlv019" id="qxtlv019" tabindex="2" style="width:100%;min-width:59px" onKeyPress="return CheckKey(event,7)">'.$this->LV_LinkField('lv019',$this->lv019).'</select>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv020':
						$vstr='<input class="txtenterquick"  autocomplete="off" name="qxtlv020" type="text" id="qxtlv020" value="'.$this->FormatView($this->DateCurrent,2).'" tabindex="2" maxlength="32" style="width:100%;min-width:120px" onKeyPress="return CheckKey(event,7)" ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;">';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;	
					default:
						$vTempEnter="<td>&nbsp;</td>";
						break;
					
				}
				$strTrEnter=$strTrEnter.$vTempEnter;
				}
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$vSumlv003=$vSumlv003+$vrow['lv003'];
			$vSumlv005=$vSumlv005+$vrow['lv005'];
			for($i=0;$i<count($lstArr);$i++)
			{
				if($lstArr[$i]=='lv021')
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv003']+$vrow['lv005'],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));					
				else
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv016']==1)		$strTr=str_replace("@#04","lvlineapproval_level2",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv003-->",$this->FormatView($vSumlv003,10),$strF);
		$strF=str_replace("<!--lv005-->",$this->FormatView($vSumlv005,10),$strF);
		$strF=str_replace("<!--lv020-->",$this->FormatView($vSumlv003+$vSumlv005,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH."<tr class='lvlinehtable0'>".$strTrEnter."</tr>".$strTr,$lvTable);
	}
/////////////////////ListFieldExport//////////////////////////
//////////////////////Buil list////////////////////
	function LV_BuilListReportView($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
	{
			
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
		$lvTable="
		<div align=\"left\"><h1>".($this->ArrPush[0])."</h2></div>
		<table  align=\"left\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\">
		@#01
		@#02
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
		$sqlS = "SELECT * FROM ts_lv1001 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$strSubTotal=0;
		$strSubTax=0;
		$strTotalAmount=0;
		$vUnitPrice="VN�"; 
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			//$vSumlv012=$vSumlv012+$vrow['lv012'];
			$vSumlv014=$vSumlv014+$vrow['lv014'];
			$vSumlv052=$vSumlv052+$vrow['lv052'];
			$vSumlv053=$vSumlv053+$vrow['lv053'];
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])).(($lstArr[$i]=='lv010'|| $lstArr[$i]=='lv011')?'%':''),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strF=$strF."</tr>";
		//$strF=str_replace("<!--lv012-->",$this->FormatView($vSumlv012,10),$strF);
		$strF=str_replace("<!--lv014-->",$this->FormatView($vSumlv014,10),$strF);
		$strF=str_replace("<!--lv052-->",$this->FormatView($vSumlv052,10),$strF);
		$strF=str_replace("<!--lv053-->",$this->FormatView($vSumlv053,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",str_replace("@01","(".$vUnitPrice.")",$strH),$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	function LV_BuilListReportOther($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$vTax)
	{
			
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
		$sqlS = "SELECT * FROM ts_lv1001 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$strSubTotal=0;
		$strSubTax=0;
		$strTotalAmount=0;
		$vUnitPrice="VN�"; 
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$vSumlv012=$vSumlv012+$vrow['lv012'];
			$vSumlv014=$vSumlv014+$vrow['lv014'];
			$vSumlv052=$vSumlv052+$vrow['lv052'];
			$vSumlv053=$vSumlv053+$vrow['lv053'];
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])).(($lstArr[$i]=='lv010'|| $lstArr[$i]=='lv011')?'%':''),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv012-->",$this->FormatView($vSumlv012,10),$strF);
		$strF=str_replace("<!--lv014-->",$this->FormatView($vSumlv014,10),$strF);
		$strF=str_replace("<!--lv052-->",$this->FormatView($vSumlv052,10),$strF);
		$strF=str_replace("<!--lv053-->",$this->FormatView($vSumlv053,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",str_replace("@01","(".$vUnitPrice.")",$strH),$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	
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
			window.open('".$this->Dir."ts_lv1001/?lang=".$this->lang."&childfunc='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
		$strTemp=str_replace("@01",$lvNumPage,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
				$strTemp=str_replace("@01",$lvSortPage,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strTemp=str_replace("@01",$lvButton,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
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
		@#02
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
		$lvTd="<td  class=\"#04\" align=\"@#05\">@02</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"1\">&nbsp;</td>";
		$sqlS = "SELECT * FROM ts_lv1001 WHERE 1=1 and lv017<>4 ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
				$vTempF=str_replace("@01","<!--".$lstArr[$i]."-->",$lvTdF);
				$strF=$strF.$vTempF;
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$vSumlv012=$vSumlv012+$vrow['lv012'];
			$vSumlv014=$vSumlv014+$vrow['lv014'];
			$vSumlv052=$vSumlv052+$vrow['lv052'];
			$vSumlv053=$vSumlv053+$vrow['lv053'];
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv012-->",$this->FormatView($vSumlv012,10),$strF);
		$strF=str_replace("<!--lv014-->",$this->FormatView($vSumlv014,10),$strF);
		$strF=str_replace("<!--lv052-->",$this->FormatView($vSumlv052,10),$strF);
		$strF=str_replace("<!--lv053-->",$this->FormatView($vSumlv053,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	public function LV_LinkFieldExt($vFile,$vSelectID)
	{
		return($this->CreateSelect($this->sqlconditionext($vFile,$vSelectID),1));
	}
	private function sqlconditionext($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv017':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sp_lv0037 where lv001<>4";
				break;
			case 'lv019':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0001 where lv001='$vSelectID'";
				break;	
			default:
				$vsql="";
				break;
		}
		return $vsql;
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
			case 'lv012':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sp_lv0005";
				break;
			case 'lv017':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sp_lv0037 where lv001<>4";
				break;
			case 'lv019':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0001";
				break;
			default:
				$vsql="";
				break;
		}
		return $vsql;
	}
	function getvaluelink($vFile,$vSelectID)
	{
		if($vSelectID=="")
		{
			return $vSelectID;
		}
		switch($vFile)
		{
			
			case 'lv006':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  ts_lv0003 where lv001='$vSelectID'";
				break;			
			case 'lv014':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;		
			case 'lv017':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sp_lv0037 where lv001='$vSelectID'";
				break;
			case 'lv019':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0001 where lv001='$vSelectID'";
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