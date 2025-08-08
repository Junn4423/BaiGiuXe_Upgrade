<?php
/////////////coding hr_lv0020///////////////
class   tc_lv0019 extends lv_controler
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
	public $lv021=null;
	public $lv022=null;
	public $lv023=null;
	public $lv024=null;
	public $lv025=null;
	public $lv026=null;
	public $lv027=null;
	public $lv028=null;
	public $lv029=null;
	public $lv030=null;
	public $lv031=null;
	public $lv032=null;
	public $lv033=null;
	public $lv034=null;
	public $lv035=null;
	public $lv036=null;
	public $lv037=null;
	public $lv038=null;
	public $lv039=null;
	public $lv040=null;
	public $lv041=null;
	public $lv042=null;
	public $lv043=null;
	public $lv044=null;	
///////////
	public $DefaultFieldList="lv001,lv002,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv043,lv022,lv023,lv024,lv026,lv027,lv028,lv029,lv030,lv044,lv031,lv032,lv033,lv034,lv035,lv036,lv037,lv038,lv039,lv040,lv041,lv042";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='hr_lv0020';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv024"=>"25","lv025"=>"26","lv026"=>"27","lv027"=>"28","lv028"=>"29","lv029"=>"30","lv030"=>"31","lv031"=>"32","lv032"=>"33","lv033"=>"34","lv034"=>"35","lv035"=>"36","lv036"=>"37","lv037"=>"38","lv038"=>"39","lv039"=>"40","lv040"=>"41","lv041"=>"42","lv042"=>"43","lv043"=>"44","lv044"=>"45");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"2","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"2","lv016"=>"0","lv017"=>"0","lv018"=>"0","lv019"=>"0","lv020"=>"0","lv021"=>"2","lv022"=>"0","lv023"=>"0","lv024"=>"0","lv025"=>"0","lv026"=>"0","lv027"=>"0","lv028"=>"0","lv029"=>"0","lv030"=>"2","lv031"=>"0","lv032"=>"0","lv033"=>"0","lv034"=>"0","lv035"=>"0","lv036"=>"0","lv037"=>"0","lv038"=>"0","lv039"=>"0","lv040"=>"0","lv041"=>"0","lv042"=>"0","lv043"=>"0","lv044"=>"2");	

	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;
	 	$this->isFil=1;	
	
		$this->isUnApr=0;
		$this->isAdd=0;
		$this->isEdit=0;	
		$this->isDel=0;	
		$this->lang=$_GET['lang'];
		
	}
	
	function LV_Load()
	{
		$vsql="select * from  hr_lv0020";
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
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
			$this->lv023=$vrow['lv023'];
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];
			$this->lv027=$vrow['lv027'];
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv038=$vrow['lv038'];
			$this->lv039=$vrow['lv039'];
			$this->lv040=$vrow['lv040'];
			$this->lv041=$vrow['lv041'];
			$this->lv042=$vrow['lv042'];
			$this->lv043=$vrow['lv043'];
			$this->lv044=$vrow['lv044'];

		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  hr_lv0020 Where lv001='$vlv001'";
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
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
			$this->lv023=$vrow['lv023'];
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];
			$this->lv027=$vrow['lv027'];
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv038=$vrow['lv038'];
			$this->lv039=$vrow['lv039'];
			$this->lv040=$vrow['lv040'];
			$this->lv041=$vrow['lv041'];
			$this->lv042=$vrow['lv042'];				
			$this->lv043=$vrow['lv043'];
			$this->lv044=$vrow['lv044'];
		}
	}
	function LV_Insert()
	{
		
		if($this->isAdd==0) return false;
		$this->lv011 = ($this->lv011!="")?recoverdate(($this->lv011), $this->lang):$this->DateDefault;
		$this->lv015 = ($this->lv015!="")?recoverdate(($this->lv015), $this->lang):$this->DateDefault;
		$this->lv021 = ($this->lv021!="")?recoverdate(($this->lv021), $this->lang):$this->DateDefault;
		$this->lv030 = ($this->lv030!="")?recoverdate(($this->lv030), $this->lang):$this->DateDefault;
		$this->lv044 = ($this->lv044!="")?recoverdate(($this->lv044), $this->lang):$this->DateDefault;
		 $lvsql="insert into hr_lv0020 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026,lv027,lv028,lv029,lv030,lv031,lv032,lv033,lv034,lv035,lv036,lv037,lv038,lv039,lv040,lv041,lv042,lv043,lv044) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv018','$this->lv019','$this->lv020','$this->lv021','$this->lv022','$this->lv023','$this->lv024','$this->lv025','$this->lv026','$this->lv027','$this->lv028','$this->lv029','$this->lv030','$this->lv031','$this->lv032','$this->lv033','$this->lv034','$this->lv035','$this->lv036','$this->lv037','$this->lv038','$this->lv039','$this->lv040','$this->lv041','$this->lv042','$this->lv043','$this->lv044')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0020.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		$this->lv011 = ($this->lv011!="")?recoverdate(($this->lv011), $this->lang):$this->DateDefault;
		$this->lv015 = ($this->lv015!="")?recoverdate(($this->lv015), $this->lang):$this->DateDefault;
		$this->lv021 = ($this->lv021!="")?recoverdate(($this->lv021), $this->lang):$this->DateDefault;
		$this->lv030 = ($this->lv030!="")?recoverdate(($this->lv030), $this->lang):$this->DateDefault;
		$this->lv044 = ($this->lv044!="")?recoverdate(($this->lv044), $this->lang):$this->DateDefault;
		  $lvsql="Update hr_lv0020 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016',lv017='$this->lv017',lv018='$this->lv018',lv019='$this->lv019',lv020='$this->lv020',lv021='$this->lv021',lv022='$this->lv022',lv023='$this->lv023',lv024='$this->lv024',lv025='$this->lv025',lv026='$this->lv026',lv027='$this->lv027',lv028='$this->lv028',lv029='$this->lv029',lv030='$this->lv030',lv031='$this->lv031',lv032='$this->lv032',lv033='$this->lv033',lv034='$this->lv034',lv035='$this->lv035',lv036='$this->lv036',lv037='$this->lv037',lv038='$this->lv038',lv039='$this->lv039',lv040='$this->lv040',lv041='$this->lv041',lv042='$this->lv042',lv043='$this->lv043',lv044='$this->lv044' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0020.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM hr_lv0020  WHERE hr_lv0020.lv001 IN ($lvarr)";// and (select count(*) from hr_lv0020 B where  B.lv002= hr_lv0020.lv001)<=0  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0020.delete',sof_escape_string($lvsql));
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
		if($this->FullName!="")
		{	
			$vArrName=explode(",",$this->FullName);
			foreach($vArrName as $vName)
			{
				if($vName!="")
				{
				if($strCondi=="")	
					$strCondi= " AND ( concat(lv004,' ',lv003,' ',lv002)  like '%$vName%'";
				else
					$strCondi=$strCondi." OR concat(lv004,' ',lv003,' ',lv002)  like '%$vName%'";		
				}
			}
			$strCondi=$strCondi.")";
			
		}
		if($this->lv001!="") $strCondi=$strCondi." and lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and lv009 in ('".str_replace(",","','",$this->lv009)."')";
		if($this->lv010!="")  $strCondi=$strCondi." and lv010 like '%$this->lv010%'";
		if($this->lv011!="")  $strCondi=$strCondi." and lv011 like '%$this->lv011%'";
		if($this->lv012!="")  $strCondi=$strCondi." and lv012 like '%$this->lv012%'";
		if($this->lv013!="")  $strCondi=$strCondi." and lv013 like '%$this->lv013%'";
		if($this->lv014!="")  $strCondi=$strCondi." and lv014 like '%$this->lv014%'";
		if($this->lv015!="")  $strCondi=$strCondi." and lv015 like '%$this->lv015%'";
		if($this->lv016!="")  $strCondi=$strCondi." and lv016 like '%$this->lv016%'";
		if($this->lv017!="")  $strCondi=$strCondi." and lv017 like '%$this->lv017%'";
		if($this->lv018!="")  $strCondi=$strCondi." and lv018 like '%$this->lv018%'";
		if($this->lv019!="")  $strCondi=$strCondi." and lv019 like '%$this->lv019%'";
		if($this->lv020!="")  $strCondi=$strCondi." and lv020 like '%$this->lv020%'";
		if($this->lv021!="")  $strCondi=$strCondi." and lv021 like '%$this->lv021%'";
		if($this->lv022!="")  $strCondi=$strCondi." and lv022 like '%$this->lv022%'";
		if($this->lv023!="")  $strCondi=$strCondi." and lv023 like '%$this->lv023%'";
		if($this->lv024!="")  $strCondi=$strCondi." and lv024 like '%$this->lv024%'";
		if($this->lv025!="")  $strCondi=$strCondi." and lv025 like '%$this->lv025%'";
		if($this->lv026!="")  $strCondi=$strCondi." and lv026 like '%$this->lv026%'";
		if($this->lv027!="")  $strCondi=$strCondi." and lv027 like '%$this->lv027%'";
		if($this->lv028!="")  $strCondi=$strCondi." and lv028 like '%$this->lv028%'";
		if($this->lv029!="")  
		{
			$strCondi=$strCondi." and lv029 in (".$this->LV_GetDep($this->lv029).")";
		}
		if($this->lv030!="")  $strCondi=$strCondi." and lv030 like '%$this->lv030%'";
		if($this->lv031!="")  $strCondi=$strCondi." and lv031 like '%$this->lv031%'";
		if($this->lv032!="")  $strCondi=$strCondi." and lv032 like '%$this->lv032%'";
		if($this->lv033!="")  $strCondi=$strCondi." and lv033 like '%$this->lv033%'";
		if($this->lv034!="")  $strCondi=$strCondi." and lv034 like '%$this->lv034%'";
		if($this->lv035!="")  $strCondi=$strCondi." and lv035 like '%$this->lv035%'";
		if($this->lv036!="")  $strCondi=$strCondi." and lv036 like '%$this->lv036%'";
		if($this->lv037!="")  $strCondi=$strCondi." and lv037 like '%$this->lv037%'";
		if($this->lv038!="")  $strCondi=$strCondi." and lv038 like '%$this->lv038%'";
		if($this->lv039!="")  $strCondi=$strCondi." and lv039 like '%$this->lv039%'";
		if($this->lv040!="")  $strCondi=$strCondi." and lv040 like '%$this->lv040%'";
		if($this->lv041!="")  $strCondi=$strCondi." and lv041 like '%$this->lv041%'";
		if($this->lv042!="")  $strCondi=$strCondi." and lv042 like '%$this->lv042%'";
		if($this->lv043!="")  $strCondi=$strCondi." and lv043 like '%$this->lv043%'";
		if($this->lv044!="")  $strCondi=$strCondi." and lv044 like '%$this->lv044%'";

		return $strCondi;
	}
	function LV_GetDep($vDepID)
	{
		if($vDepID=="") return '';
		$vReturn="'".str_replace(",","','",$vDepID)."'";
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
		////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM hr_lv0020 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	public function CheckListFilter($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002')
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
	public function GetBuilCheckListDep($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002')
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
			if($this->LV_IsNameDep==1)
				$strTemp=str_replace("@#02",$vrow[$vFieldView]."(".$vrow['lv001'].")",$strTemp);
			else
				$strTemp=str_replace("@#02",$vrow[$vFieldView],$strTemp);
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
							if($this->LV_IsNameDep==1)
								$strTemp=str_replace("@#02",'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$vrow1[$vFieldView]."(".$vrow1['lv001'].")",$strTemp);
							else
								$strTemp=str_replace("@#02",'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$vrow1[$vFieldView],$strTemp);
							$strGetScript=$strGetScript.$strTemp;
										$i++;
							
						}
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
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
	//////////////////////Buil list////////////////////
	function LV_BuilList($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		if($curRow<0) $curRow=0;	if($lvList=="") $lvList=$this->DefaultFieldList;
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
		$lvHref="<a href=\"javascript:FunctRunning1('@01')\" style=\"text-decoration:none\">@02</a>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$lvImg="<td  ><img name=\"imgView\" border=\"0\" style=\"border-color:#CCCCCC\" title=\"\" alt=\"Image\" width=\"96px\" height=\"128px\" src=\"../../images/employees/@01/@02\" /></td>";
		$sqlS = "SELECT * FROM hr_lv0020 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
				if($lstArr[$i]=='lv007')
				{
					$vTemp=str_replace("@02",$vrow[$lstArr[$i]],str_replace("@01",$vrow['lv001'],$lvImg));

				}
				else
				$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	public function GetMonthStartEnd($vStartDate,$vEndDate)
	{
		$vCount=0;
		$vStartMonth=getmonth($vStartDate);
		$vStartYear=getyear($vStartDate);
		$vSDate=getday($vStartDate);
		
		$vEndMonth=getmonth($vEndDate);
		$vEndYear=getyear($vEndDate);
		$vEDate=getday($vEndDate);
		if($vStartYear==$vEndYear)
		{
			$vCount= ($vEndMonth-$vStartMonth);
		}
		else
		{
			for($i=$vStartYear;$i<=$vEndYear;$i++)
			{
				if($i==$vStartYear)
				{
					$vCount=$vCount+12-$vStartMonth;				
				}
				else if($i==$vEndYear)
				{
					$vCount=$vCount+$vEndMonth;
				}
				else
				{
					$vCount=$vCount+12;				
				}
				
			}
		}
		if((int)$vEDate-(int)$vSDate>15) $vCount++;
		return $vCount;
		
	}
/////////////////////ListFieldExport//////////////////////////
	function ListFieldExport($lvFrom,$lvList,$maxRows)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=",".$lvList.",";
		$lstArr=explode(",",$this->DefaultFieldList);
		$lvSelect="<ul id=\"menu1-nav\" onkeyup=\"return CheckKeyCheckTabExp(event)\">
						<li class=\"menusubT1\"><img src=\"../images/lvicon/config.png\" border=\"0\" />".$this->ArrFunc[12]."
							<ul id=\"submenu1-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript="		
		<script language=\"javascript\">
		function Export(vFrom,value)
		{
			window.open('hr_lv0020/?lang=".$this->lang."&func='+value,'','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
						<li class=\"menusubT\"><img src=\"../images/lvicon/config.png\" border=\"0\" />".$this->ArrFunc[11]."
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
		$sqlS = "SELECT * FROM hr_lv0020 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  lv_lv0004";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0022";
				break;
			case 'lv017':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0021";
				break;
			case 'lv022':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014";
				break;
			case 'lv023':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0016";
				break;
			case 'lv024':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0017";
				break;
			case 'lv025':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0015";
				break;
			case 'lv026':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0007";
				break;
			case 'lv027':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0004";
				break;
			case 'lv028':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0005";
				break;
			case 'lv029':
				$vsql="select lv001,CONCAT(lv003,'[',lv002,']') lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002";
				break;
			case 'lv031':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014";
				break;
			case 'lv032':
				$vsql="select lv001,CONCAT(lv002,'[',lv003,']') lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0023	";
				
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
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  lv_lv0004 where lv001='$vSelectID'";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0022 where lv001='$vSelectID'";
				break;
			case 'lv017':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0021 where lv001='$vSelectID'";
				break;
			case 'lv022':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014 where lv001='$vSelectID'";
				break;
			case 'lv023':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0016 where lv001='$vSelectID'";
				break;
			case 'lv024':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0017 where lv001='$vSelectID'";
				break;
			case 'lv025':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0015 where lv001='$vSelectID'";
				break;
			case 'lv026':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0007 where lv001='$vSelectID'";
				break;
			case 'lv027':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0004 where lv001='$vSelectID'";
				break;
			case 'lv028':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0005 where lv001='$vSelectID'";
				break;
			case 'lv029':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002 where lv001='$vSelectID'";
				break;
			case 'lv031':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014  where lv001='$vSelectID'";
				break;
			case 'lv032':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from hr_lv0023 	 where lv001='$vSelectID'";
				
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