<?php
/////////////coding ts_lv0042///////////////
class   ts_lv0042 extends lv_controler
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
///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='ts_lv0042';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"1","lv005"=>"0","lv006"=>"1","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"0","lv016"=>"2","lv017"=>"	0","lv018"=>"0");	

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
	
		$this->isApr=0;		
		$this->isUnApr=0;
		$this->lang=$_GET['lang'];
		
	}
	protected function LV_CheckLock()
	{
		$lvsql="select lv007 from ts_lv0041 B where  B.lv001='$this->lv002'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if($vrow['lv007']>=1)
			{
				$this->isAdd=0;	
				$this->isEdit=0;	
				$this->isDel=0;	
			}
		}
		
	}
	function LV_Load()
	{
		$vsql="select * from  ts_lv0042";
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
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  ts_lv0042 Where lv001='$vlv001'";
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
		}
	}
	function LV_Insert()
	{
		
		
		if($this->isAdd==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		//$this->lv015 = ($this->lv015!="")?recoverdate(($this->lv015), $this->lang):$this->DateDefault;
		$lvsql="insert into ts_lv0042 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv018')";
		$vReturn= db_query($lvsql);
		if($vReturn){
		 	$this->InsertLogOperation($this->DateCurrent,'ts_lv0042.insert',sof_escape_string($lvsql));
		 }
		return $vReturn;
	}	
	function LV_InsertTemp($vTemID,$vlv002,$vWhId)
	{
		$lvsql="select '$vTemID' lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018 from ts_lv0044 where lv002='$vlv002'";
		$vReturn= db_query($lvsql);
		while($vrow=db_fetch_array($vReturn))
		{
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
			$this->LV_Insert();
		}
		if($vReturn) $this->LV_DeleteTemp($vlv002);
		return $vReturn;
	}
	function CheckLot($lvLotId,$lvItemId,$lvWhId)
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM ts_lv0020 WHERE lv001='$lvLotId' and lv002='$lvItemId' and lv003='$lvWhId'";
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_DeleteTemp($vlv002)
	{
		$lvsql = "DELETE FROM ts_lv0044  WHERE ts_lv0044.lv002='$vlv002'";
		$vReturn= db_query($lvsql);
		return $vReturn;
	}	
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		$this->lv016 = ($this->lv016!="")?recoverdate(($this->lv016), $this->lang):$this->DateDefault;
		  $lvsql="Update ts_lv0042 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016',lv017='$this->lv017',lv018='$this->lv018' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ts_lv0042.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateEdit($vOldlv004,$vOldlv006)
	{
		if($this->isEdit==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		$this->lv016 = ($this->lv016!="")?recoverdate(($this->lv016), $this->lang):$this->DateDefault;
		  $lvsql="Update ts_lv0042 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016',lv017='$this->lv017',lv018='$this->lv018' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn){
		 $this->InsertLogOperation($this->DateCurrent,'ts_lv0042.update',sof_escape_string($lvsql));
		 
		 }
		return $vReturn;
	}
	function LV_CheckLocked($vlv002)
	{
		$lvsql="select lv007 from  ts_lv0041 Where lv001='$vlv002'";
		$vresult=db_query($lvsql);
		if($vresult){
		$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				if($vrow['lv007']<=0) 
					return true;
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
		$lvsql = "DELETE FROM ts_lv0042  WHERE ts_lv0042.lv001 IN ($lvarr) and (select lv007 from ts_lv0041 B where  B.lv001= ts_lv0042.lv002)<=0  ";
		$vReturn= db_query($lvsql);
		if($vReturn) {
			$this->InsertLogOperation($this->DateCurrent,'ts_lv0042.delete',sof_escape_string($lvsql));
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
		if($this->lv001!="") $strCondi=$strCondi." and lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and lv002 ='$this->lv002'";
		if($this->lv003!="") $strCondi=$strCondi." and lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and lv010 like '%$this->lv010%'";
		if($this->lv011!="")  $strCondi=$strCondi." and lv011 like '%$this->lv011%'";
		if($this->lv012!="")  $strCondi=$strCondi." and lv012 like '%$this->lv012%'";
		if($this->lv013!="")  $strCondi=$strCondi." and lv013 like '%$this->lv013%'";
		if($this->lv014!="")  $strCondi=$strCondi." and lv014 like '%$this->lv014%'";
		if($this->lv015!="")  $strCondi=$strCondi." and lv015 like '%$this->lv015%'";
		if($this->lv016!="")  $strCondi=$strCondi." and lv016 like '%$this->lv016%'";	
		if($this->lv017!="")  $strCondi=$strCondi." and lv017 like '%$this->lv017%'";	
		if($this->lv018!="")  $strCondi=$strCondi." and lv018 like '%$this->lv018%'";	
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM ts_lv0042 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
			//////////////////////Buil list////////////////////
//////////////////////Buil list////////////////////
	function LV_BuilList($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
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
		$lvTable="
		<div id=\"func_id\" style='position:relative;background:#f2f2f2'><div style=\"float:left\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</div><div style=\"float:right\">".$this->ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrderList,$lvSortNum)."</div><div style='float:right'>&nbsp;&nbsp;&nbsp;</div><div style='float:right'>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</div></div><div style='height:35px'></div><table  align=\"center\" class=\"lvtable\"><!--<tr ><td colspan=\"".(2+count($lstArr))."\" class=\"lvTTable\">".$this->ArrPush[0]."</td></tr>-->
		@#01
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
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT * FROM ts_lv0042 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
			window.open('".$this->Dir."ts_lv0042/?lang=".$this->lang."&childdetailfunc='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
		$lvTable="<div align=\"center\"><div ondblclick=\"this.innerHTML=''\">".$this->Get_TitleHeader()."</div></div>
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
		$sqlS = "SELECT * FROM ts_lv0042 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
		$sqlS = "SELECT * FROM ts_lv0042 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$strSubTotal=0;
		$strSubTax=0;
		$strTotalAmount=0;
		$vUnitPrice="VNÐ";
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
	function PrintInPackingListParent($plang,$vlv001)
	{
		$strReturn="";
		$vConditionStock="";
		if($vlv001!="") 	$vConditionStock=$vConditionStock." AND C.lv001 like '$vlv001'";
		 $sqlS = "select distinct A.lv002,A.lv003,A.lv005 UnitName,A.lv008,A.lv009,B.lv002 ItemName,D.lv004 lvLong,D.lv005 lvWidth,D.lv006 lvHeight,C.lv010 maxCol from ts_lv0042 A left join sl_lv0007 B on A.lv003=B.lv001 inner join ts_lv0041 C on A.lv002=C.lv001 left join ts_lv0036 D on D.lv001=A.lv012  where 1=1    $vConditionStock";	
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$maxCol=0;
		$strExpportAll = "";
		$vStockCategorylv001="";
		$lvFirst=1;
		///Packing view///
		$parenttotal_caton=0;
		$parenttotal_quantity=0;
		$parenttotal_nw=0;
		$parenttotal_gw=0;
		$parenttotal_wcaton=0;
		///Packing view///
		$strReturn=$strReturn.'
		<style>
.htable
{
	font-weight:bold;
	text-align:center
}
</style>
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
				$strReturn=$strReturn.$this->PrintInPackingListDetail($arrS['lv002'],$arrS['lv003'],$arrS['lv008'],$arrS['lv009'],$arrS['lv004'],$arrS['maxCol'],$lvFirst,$parenttotal_caton,$parenttotal_quantity,$parenttotal_nw,$parenttotal_gw,$parenttotal_wcaton);
				$maxCol=$arrS['maxCol'];
				$lvFirst++;
			}
		}
		$strReturn=$strReturn."
		<tr height=\"30px\">
				<td class=\"htable\" colspan=".($maxCol+5).">TOTAL</td>
				<td class=\"htable\" width=\"10%\">&nbsp;</td>	
				<td class=\"htable\" width=\"10%\">".$this->FormatView($parenttotal_caton,10)."</td>	
				<td class=\"htable\" width=\"10%\">".$this->FormatView($parenttotal_quantity,10)."</td>	
				<td class=\"htable\" width=\"10%\">".$this->FormatView($parenttotal_nw,10)."</td>	
				<td class=\"htable\" width=\"10%\">".$this->FormatView($parenttotal_gw,10)."</td>	
				<td class=\"htable\" width=\"10%\"  colspan=3>".$this->FormatView($parenttotal_wcaton,10)."</td>	

			</tr>
		</table>";
		return $strReturn;
	}
	function PrintInPackingListDetail($lvPackingId,$lvItemId,$lvColor,$lvCut,$Quantity,$maxCol,$lvFirst,&$parenttotal_caton,&$parenttotal_quantity,&$parenttotal_nw,&$parenttotal_gw,&$parenttotal_wcaton)
	{
		$lvArrCateSize=array();
		$lvArrChildSize=array();
		$lvarrPackNo=array();
	$this->BuilCategorySize($lvPackingId,$lvItemId,$lvColor,$lvCut,$lvArrChildSize,$maxCol,$rowline,$rowts,$endrowts);
	if($lvFirst==1)
		$vHeaderReportInventory="
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" >@02</td>
				<td class=\"htable\" width=\"8%\" rowspan=2>@03</td>
				<td class=\"htable\" width=\"*%\" rowspan=2>@04</td>
				<td class=\"htable\" width=\"5%\" rowspan=2>@05</td>	
				<td class=\"htable\" width=\"5%\" rowspan=2>@06</td>
				<td class=\"htable\" width=\"5%\" colspan=#22@>SIZE</td>
				<td class=\"htable\" width=\"10%\"  >@07</td>	
				<td class=\"htable\" width=\"10%\"  >@08</td>	
				<td class=\"htable\" width=\"10%\"  >@09</td>	
				<td class=\"htable\" width=\"10%\"  >@10</td>	
				<td class=\"htable\" width=\"10%\"  >@11</td>	
				<td class=\"htable\" width=\"10%\"  colspan=3>MEAS</td>	

			</tr>
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" >No</td>
				#02@
				<td class=\"htable\" width=\"10%\"  >CTN</td>	
				<td class=\"htable\" width=\"10%\"  >(CTNS)</td>	
				<td class=\"htable\" width=\"10%\"  >(PCS)</td>	
				<td class=\"htable\" width=\"10%\"  >(KGS)</td>	
				<td class=\"htable\" width=\"10%\"  >(KGS)</td>	
				<td class=\"htable\" width=\"10%\"  >@12</td>	
				<td class=\"htable\" width=\"10%\"  >@13</td>
				<td class=\"htable\" width=\"10%\"  >@14</td>
			</tr>
			#01@
			@01
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" colspan=\"5\" >TOTAL</td>
				#03@
				<td class=\"htable\" width=\"10%\"  >&nbsp;</td>	
				<td class=\"htable\" width=\"10%\"  >#05@</td>	
				<td class=\"htable\" width=\"10%\"  >#06@</td>	
				<td class=\"htable\" width=\"10%\"  >#07@</td>	
				<td class=\"htable\" width=\"10%\"  >#08@</td>	
				<td class=\"htable\" width=\"10%\" colspan=\"3\" >#09@</td>	
			</tr>";	
	else
		$vHeaderReportInventory="
			
			#01@
			@01
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" colspan=\"5\" >TOTAL</td>
				#03@
				<td class=\"htable\" width=\"10%\"  >&nbsp;</td>	
				<td class=\"htable\" width=\"10%\"  >#05@</td>	
				<td class=\"htable\" width=\"10%\"  >#06@</td>	
				<td class=\"htable\" width=\"10%\"  >#07@</td>	
				<td class=\"htable\" width=\"10%\"  >#08@</td>	
				<td class=\"htable\" width=\"10%\" colspan=\"3\" >#09@</td>	
			</tr>";		
		$vRowFirst="
			<tr>
				<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >@02</td>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_style\" >@04</td>
				<td class=\"left_style\" >@05</td>
				<td class=\"right_style\" >@06</td>
				@99
				<td class=\"right_style\" >@07</td>
				<td class=\"right_style\" >@08</td>
				<td class=\"right_style\" >@09</td>		
				<td class=\"right_style\" >@10</td>
				<td class=\"right_style\" >@11</td>	
				<td class=\"right_style\" >@12</td>
				<td class=\"right_style\" >@13</td>
				<td class=\"right_style\" >@14</td>
			</tr>
			";

		$vRowLightText="<tr>
				<td class=\"right_style\" >@07</td>
				<td class=\"right_style\" >@08</td>
				<td class=\"right_style\" >@09</td>		
				<td class=\"right_style\" >@10</td>
				<td class=\"right_style\" >@11</td>	
				<td class=\"right_style\" >@12</td>
				<td class=\"right_style\" >@13</td>
				<td class=\"right_style\" >@14</td>						
			</tr>";
		$vConditionStock="and A.lv002='$lvPackingId' and A.lv003='$lvItemId' and A.lv008='$lvColor' and A.lv009='$lvCut' " ;
		 $sqlS = "select distinct A.lv002,A.lv003,A.lv004,A.lv005 UnitName,A.lv008,A.lv009,A.lv011,B.lv002 ItemName,D.lv004 lvLong,D.lv005 lvWidth,D.lv006 lvHeight from ts_lv0042 A left join sl_lv0007 B on A.lv003=B.lv001 inner join ts_lv0041 C on A.lv002=C.lv001 left join ts_lv0036 D on D.lv001=A.lv012  where 1=1    $vConditionStock order by A.lv003 asc,A.lv011 asc,A.lv004 desc,A.lv018 asc";	
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		///Packing view///
		$lvtotal_caton=0;
		$lvtotal_quantity=0;
		$lvtotal_nw=0;
		$lvtotal_gw=0;
		$lvtotal_wcaton=0;
		///Packing view///
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
				if($this->Check_PackNo($lvarrPackNo,$lvPackingId,$lvItemId,$lvColor,$lvCut,$arrS['lv004'],$arrS['lv011'])==true)
				{
					if($vtInventorylv001 != $arrS['lv001']){
						$vOrder++;
						
						//$vtInventorylv001 = $arrS['lv001'];
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@03", ($arrS['lv009']!="" || $arrS['lv009']!=NULL)?$arrS['lv009']:"-", $vLineRun);
						$vLineRun = str_replace("@04",($arrS['lv003']!="" || $arrS['lv003']!=NULL)?$arrS['lv003']:"-", $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;	
				$vLineRun = str_replace("@05", ($arrS['lv008']!="" || $arrS['lv008']!=NULL)?$arrS['lv008']:"-", $vLineRun);
				$vLineRun = str_replace("@06", ($arrS['UnitName']!="" || $arrS['UnitName']!=NULL)?$arrS['UnitName']:"-", $vLineRun);
				$vLineRun = str_replace("@12", ($arrS['lvLong']!="" || $arrS['lvLong']!=NULL)?$this->FormatView($arrS['lvLong'],10):"-", $vLineRun);
				$vLineRun = str_replace("@13", ($arrS['lvWidth']!="" || $arrS['lvWidth']!=NULL)?$this->FormatView($arrS['lvWidth'],10):"-", $vLineRun);
				$vLineRun = str_replace("@14",($arrS['lvHeight']!="" || $arrS['lvHeight']!=NULL)?$this->FormatView($arrS['lvHeight'],10):"-", $vLineRun);	
				$sumLine=0;$sumGW=0;$sumNW=0;$NumPack=0;
				
				$vLineRun=str_replace("@99",$this->BuilCategorySizeDetail($lvArrCateSize,$lvArrChildSize,$maxCol,$arrS['lv002'],$arrS['lv003'],$arrS['lv004'],$arrS['lv008'],$arrS['lv009'],$arrS['lv011'],$arrS['lv013'],$sumLine,$sumNW,$sumGW,$NumPack,$StartNum,$lvarrPackNo),$vLineRun);
				$vLineRun = str_replace("@02", $StartNum." - ".((int)$StartNum+(int)$NumPack-1), $vLineRun);
				$vLineRun = str_replace("@07",$sumLine/$NumPack, $vLineRun);
				$lvtotal_caton=$lvtotal_caton+$NumPack;
				$lvtotal_quantity=$lvtotal_quantity+$sumLine;
				$lvtotal_nw=$lvtotal_nw+$sumNW;
				$lvtotal_gw=$lvtotal_nw+$sumGW;
				$vLineRun = str_replace("@08",($NumPack!="" || $NumPack!=NULL)?$this->FormatView($NumPack,10):"-", $vLineRun);	
				$vLineRun = str_replace("@09",($sumLine!="" || $sumLine!=NULL)?$this->FormatView($sumLine,10):"-", $vLineRun);	
				$vLineRun = str_replace("@10",($sumNW!="" || $sumNW!=NULL)?$this->FormatView($sumNW,10):"-", $vLineRun);	
				$vLineRun = str_replace("@11",($sumGW!="" || $sumGW!=NULL)?$this->FormatView($sumGW,10):"-", $vLineRun);	
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
			}
		} else {
			return $vArrLang[5];
		}	
		//$strExpportAll=$strExpportAll.$this->SumSQLRun($sqlS,8,$vArrLang[14],$plang);	
		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = str_replace("#01@",$rowline,$vHeaderReportInventory);
		$vHeader = str_replace("#02@",$rowts,$vHeader);
		$vHeader = str_replace("#03@",$endrowts,$vHeader);
		$vHeader = str_replace("#05@",$this->FormatView($lvtotal_caton,10),$vHeader);
		$vHeader = str_replace("#06@",$this->FormatView($lvtotal_quantity,10),$vHeader);
		$vHeader = str_replace("#07@",$this->FormatView($lvtotal_nw,10),$vHeader);
		$vHeader = str_replace("#08@",$this->FormatView($lvtotal_gw,10),$vHeader);
		$vHeader = str_replace("#22@",$maxCol,$vHeader);
		
		$lvtotal_wcaton=$lvtotal_gw-$lvtotal_nw;

		$vHeader = str_replace("#09@",$this->FormatView($lvtotal_wcaton,10),$vHeader);
		$parenttotal_caton=$parenttotal_caton+$lvtotal_caton;
		$parenttotal_quantity=$parenttotal_quantity+$lvtotal_quantity;
		$parenttotal_nw=$parenttotal_nw+$lvtotal_nw;
		$parenttotal_gw=$parenttotal_gw+$lvtotal_gw;
		$parenttotal_wcaton=$parenttotal_wcaton+$lvtotal_wcaton;
		//Order
		$vHeader = str_replace("@02", "CARTON", $vHeader);
		//lv003
		$vHeader = str_replace("@03", "CUT#", $vHeader);
		//Stock lv002
		$vHeader = str_replace("@04", "STYLE#", $vHeader);
		//CLR
		$vHeader = str_replace("@05","CLR", $vHeader);
		//Unit
		$vHeader = str_replace("@06","UNIT", $vHeader);
		//Fist
		$vHeader = str_replace("@07", "QTY/", $vHeader);
		//Input Mlv001dle
		$vHeader = str_replace("@08", "TOTAL", $vHeader);
		//Output Mlv001dle
		$vHeader = str_replace("@09","TOTAL", $vHeader);
		//Last
		$vHeader = str_replace("@10","N.W.", $vHeader);		
		$vHeader = str_replace("@11","G.W.", $vHeader);	
		$vHeader = str_replace("@12","L", $vHeader);	
		$vHeader = str_replace("@13","W", $vHeader);	
		$vHeader = str_replace("@14","H", $vHeader);	

		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);	
	
	}	
	function Check_PackNo($lvarrPackNo,$lvPackingId,$lvItemId,$lvColor,$lvCut,$lvQuantity,$lvSize)
	{
		 $lvchildslq="select lv018 as packno  from ts_lv0042 A where lv002='$lvPackingId' and lv003='$lvItemId' and lv008='$lvColor' and lv009='$lvCut' and lv011='$lvSize' and lv004=$lvQuantity";
		$i=0;
		$vchildResultS = db_query($lvchildslq);
		$childarrS=db_fetch_array($vchildResultS);
		 if($lvarrPackNo[(int)$childarrS['packno']]==true) 
		 {
		 	return false;
		 }
		 else
			 return true;
	}
	function BuilCategorySize($lvPackingId,$lvItemId,$lvColor,$lvCut,&$lvArrChildSize,&$maxCol,&$rowline,&$rowts,&$endrowts)
	{
		//Khai bao mang chua type size
		$vRowFirst="
			<tr>
				<td class=\"htable\">&nbsp;</td>
				<td class=\"htable\">&nbsp;</td>
				<td class=\"htable\">&nbsp;</td>
				<td class=\"htable\">&nbsp;</td>
				<td class=\"htable\">&nbsp;</td>
				@01
				<td class=\"right_style\" >&nbsp;</td>
				<td class=\"right_style\" >&nbsp;</td>
				<td class=\"right_style\" >&nbsp;</td>		
				<td class=\"right_style\" >&nbsp;</td>
				<td class=\"right_style\" >&nbsp;</td>	
				<td class=\"right_style\" >&nbsp;</td>
				<td class=\"right_style\" >&nbsp;</td>
				<td class=\"right_style\" >&nbsp;</td>
			</tr>
			";
		$vColFill="<td class=\"htable\" >@01</td>";
		 $lvchildslq="select distinct lv011 as lv003  from ts_lv0042 A where lv002='$lvPackingId' and lv003='$lvItemId' and lv008='$lvColor' and lv009='$lvCut'  order by lv011 asc";
		$i=0;
		$vchildResultS = db_query($lvchildslq);
			$j=0;
			$line="";
			$max=0;
			while($childarrS=db_fetch_array($vchildResultS)){	
			$line=$line.str_replace("@01",$childarrS['lv003'],$vColFill);
			$lvArrChildSize[$i][$j]=$childarrS['lv003'];
			$j++;
			$max++;
			}		
		
		for($z=1;$z<=$maxCol;$z++)
		{
			if($max<$maxCol) 
			{
				$line=$line.str_replace("@01","&nbsp;",$vColFill);
				$max++;
			}
			$rowts=$rowts.str_replace("@01","s".$z,$vColFill);
			$value=$this->Get_SUMQuantity($lvPackingId,$lvItemId,$lvColor,$lvCut,$lvArrChildSize[0][$z-1]);
			$endrowts=$endrowts.str_replace("@01",($value!="" && $value!=NULL)?$this->FormatView($value,10):"&nbsp;",$vColFill);
		}
		$rowline=$rowline.str_replace("@01",$line,$vRowFirst);
		
	}
	function Get_SUMQuantity($lvPackingId,$lvItemId,$lvColor,$lvCut,$Size)
	{
		  $lvchildslq="select sum(lv004) as sumall  from ts_lv0042 A where lv002='$lvPackingId' and lv003='$lvItemId' and lv008='$lvColor' and lv009='$lvCut' and lv011='$Size'  ";
		$i=0;
		$vchildResultS = db_query($lvchildslq);
		$childarrS=db_fetch_array($vchildResultS);
		return $childarrS['sumall'];
	}
	function BuilCategorySizeDetail($lvArrCateSize,$lvArrChildSize,$maxCol,$dklv002,$dklv003,$dklv004,$dklv008,$dklv009,$dklv011,$dklv013,&$sumLine,&$sumNW,&$sumGW,&$NumPack,&$startNum,&$lvarrPackNo)
	{
		$vArrColFill= array();
		//Khai bao mang chua type size
		$vColFill="<td class=\"right_style\">@01</td>";
		$vsql="select lv011,lv004,lv014,lv013,lv018 from ts_lv0042 where lv002='$dklv002' and lv003='$dklv003' and lv004=$dklv004 and lv008='$dklv008' and lv009='$dklv009' and lv011='$dklv011'  order by lv012 asc";
		$startNum=0;
		$i=0;
		$line="";
		$PackNo="";
		$bResultS = db_query($vsql);
		while($arrS=db_fetch_array($bResultS)){	
			 $sumLine=$sumLine+$arrS['lv004'];
			 $sumNW=$sumNW+(float)$arrS['lv014'];
			 $sumGW=$sumGW+(float)$arrS['lv013'];
			 $NumPack++;
			 if($startNum==0) $startNum=$arrS['lv018'];
			 if($startNum>$arrS['lv018']) $startNum=$arrS['lv018'];
			 $PackNo=$arrS['lv018'];
			/*while($childarrS=db_fetch_array($vchildResultS)){	
			$line=$line.str_replace("@01",$childarrS['lv003'],$vColFill);
			$lvArrChildSize[$i][$j]=$childarrS['lv003'];
			$j++;
			$max++;
			}*/

		$i++;
		}
		for($i=0;$i<$maxCol;$i++)
		{
			//echo $vColFill[($lvArrChildSize[($lvArrCateSize[$dklv011])][$i])];
			if($dklv011==$lvArrChildSize[0][$i])
				$line=$line.str_replace("@01",$this->FormatView($dklv004,10),$vColFill);
			else
			{
				$sumPackno=$this->Get_packno_size($dklv002,$dklv003,$dklv008,$dklv009,$lvArrChildSize[0][$i],$PackNo,$sumLine,$sumNW,$sumGW);
				if($sumPackno>0)
				{
					
					$line=$line.str_replace("@01",$this->FormatView($sumPackno,10),$vColFill);
					$lvarrPackNo[(int)$PackNo]=true;
				}
				else
				$line=$line.str_replace("@01","&nbsp;",$vColFill);
				
			}
		}
		return $line;
		
	}
	function Get_packno_size($lvPackingId,$lvItemId,$lvColor,$lvCut,$Size,$PackNo,&$sumLine,&$sumNW,&$sumGW)
	{
		 $lvchildslq="select lv004,lv014,lv013  from ts_lv0042 A where lv002='$lvPackingId' and lv003='$lvItemId' and lv008='$lvColor' and lv009='$lvCut' and lv011='$Size' and lv018='$PackNo' ";
		$i=0;
		$vchildResultS = db_query($lvchildslq);
		$childarrS=db_fetch_array($vchildResultS);
		$sumLine=$sumLine+(float)$childarrS['lv004'];
		$sumNW=$sumNW+(float)$childarrS['lv014'];
		$sumGW=$sumGW+(float)$childarrS['lv013'];
		return $childarrS['lv004'];
		
	}
	
	public function LV_LinkField($vFile,$vSelectID)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectID),2));
	}
	public function LV_LinkFieldMulti($vFile,$vcondition)
	{
		return($this->CreateSelect($this->sqlconditionmulti($vFile,$vcondition),2));
	}	
	private function sqlconditionmulti($vFile,$vcondition)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv003':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0007 where 1=1  $vcondition";
				break;
			case 'lv005':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0005 where 1=1  $vcondition";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018 where 1=1  $vcondition";
				break;
			case 'lv008':
				 $vsql="select distinct lv009 lv001,lv009 lv002,IF(lv009='$vSelectID',1,0) lv003 from  sl_lv0014 where 1=1  $vcondition";
				break;
			case 'lv009':
				$vsql="select distinct lv010 lv001,lv010 lv002,IF(lv010='$vSelectID',1,0) lv003 from  sl_lv0014 where 1=1  $vcondition";
				break;
			case 'lv010':
				 $vsql="select distinct  lv011 lv001,lv011 lv002,IF(lv011='$vSelectID',1,0) lv003 from  sl_lv0014 where 1=1  $vcondition";
				break;
			case 'lv011':
				$vsql="select lv012 lv001,lv012 lv002,IF(lv012='$vSelectID',1,0) lv003 from  sl_lv0014 where 1=1  $vcondition order by lv012";
				break;
			case 'lv012':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  ts_lv0036 where 1=1  $vcondition";
				break;
		}
		return $vsql;
	}
	private function sqlcondition($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv003':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0007 where 1=1 and lv015=0";
				break;
			case 'lv005':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0005";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018";
				break;
			case 'lv008':
				$vsql="select distinct lv009 lv001,lv009 lv002,IF(lv009='$vSelectID',1,0) lv003 from  sl_lv0014 where lv010='$vSelectID'";
				break;
			case 'lv009':
				$vsql="select distinct lv010 lv001,lv010 lv002,IF(lv010='$vSelectID',1,0) lv003 from  sl_lv0014 where lv003='$vSelectID'";
				break;
			case 'lv010':
				$vsql="select lv011 lv001,lv011 lv002,IF(lv011='$vSelectID',1,0) lv003 from  sl_lv0029 where lv010	='$vSelectID'";
				break;
			case 'lv011':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0030 where 1=1 and lv002='$vSelectID'";
				break;
			case 'lv012':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  ts_lv0036";
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
			case 'lv003':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0007 where lv001='$vSelectID' ";
				break;
			case 'lv005':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0005 where lv001='$vSelectID'";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018 where lv001='$vSelectID'";
				break;
			case 'lv010':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0029 where lv001='$vSelectID'";
				break;
			case 'lv012':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  ts_lv0036 where lv001='$vSelectID'";
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