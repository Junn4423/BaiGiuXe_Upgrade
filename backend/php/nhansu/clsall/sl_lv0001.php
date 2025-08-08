<?php
/////////////coding sl_lv0001///////////////
class   sl_lv0001 extends lv_controler
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
	public $SaveTotal=null;
	
///////////
	//public $DefaultFieldList="lv199,lv013,lv001,lv022,lv002,lv006,lv010,lv012,lv014,lv015,lv007,lv008,lv021,lv023,lv024,lv025";
	public $DefaultFieldList="lv199,lv013,lv001,lv002,lv006,lv007,lv008,lv009,lv004,lv003,lv005,lv010,lv011,lv015,lv017,lv014,lv016,lv012,lv018,lv019,lv020,lv021,lv022,lv023,lv088,lv024,lv025";
	//public $DefaultFieldList="lv199,lv013,lv001,lv022,lv002,lv006,lv010,lv012,lv014,lv015,lv007,lv008,lv803,lv804,lv805,lv807,lv021,lv023,lv024,lv025,lv088";
	var $ArrViewEnter=array("lv023"=>"33","lv024"=>"-1","lv025"=>"-1","lv199"=>"-1","lv022"=>"89","lv022"=>"89");
	//public $DefaultFieldList="lv001,lv100,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='sl_lv0001';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv024"=>"25","lv025"=>"26","lv026"=>"27","lv027"=>"28","lv028"=>"29","lv088"=>"89","lv099"=>"30","lv100"=>"101","lv803"=>"804","lv804"=>"805","lv805"=>"806","lv807"=>"808","lv199"=>"200");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"0","lv016"=>"0","lv017"=>"2","lv018"=>"0","lv019"=>"2","lv020"=>"0","lv021"=>"0","lv022"=>"0","lv023"=>"0","lv024"=>"22","lv025"=>"0","lv026"=>"10","lv027"=>"10","lv028"=>"10","lv029"=>"10","lv088"=>"0","lv099"=>"10","lv100"=>"0","lv803"=>"0","lv804"=>"0","lv805"=>"0","lv807"=>"0","lv199"=>"0");	
	var $ArrViewSecu=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"3","lv011"=>"3","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"3","lv016"=>"3","lv017"=>"2","lv018"=>"0","lv019"=>"2","lv020"=>"0","lv021"=>"0","lv022"=>"3","lv023"=>"0","lv024"=>"22","lv025"=>"3","lv026"=>"10","lv027"=>"10","lv028"=>"10","lv029"=>"10","lv088"=>"0","lv099"=>"10","lv100"=>"0","lv803"=>"0","lv804"=>"0","lv805"=>"0","lv807"=>"0","lv199"=>"0");	
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
		$this->lang=$_GET['lang'];
		$this->SaveTotal=0;
		$this->quanlykhuvuc='';
	}
	function LV_GetDepUser($vUserID)
	{
		
			$vsql="select lv002 from  lv_lv0007 where lv001='$vUserID'";
			$bResult=db_query($vsql);
			$vrow = db_fetch_array ($bResult);
			if($vrow!=null) return $vrow['lv002'];
			return '';
	}
	function LV_CheckRightUser($vDepID)
	{
		///isQuyenNV {0: Cá nhân ; 1: Quản lý khu vực ; 2: Quản lý cấp cao}
		
		$this->isQuyenNV=0;
		$this->ListPTTT=$this->LV_GetDep('PTTT,PTTT_AD');
		if(strpos($this->ListPTTT,"'".$vDepID."'")===false)
		{
			$this->ListKD=$this->LV_GetDep('KD');
			if(strpos($this->ListKD,"'".$vDepID."'")===false)
			{
				$this->isPPTTT=2;
				$this->ListAD=$this->LV_GetDep('AD');
			}
			else
			{
				$this->isPPTTT=0;
			}
		}
		else
		{
			$this->lv025=$this->LV_UserID;
			$this->isPPTTT=1;
		}
		
		$this->DepManger=$this->LV_GetDepUser($_SESSION['ERPSOFV2RUserID']);
		if(trim($this->DepManger)=='' || $this->DepManger==null)
		{
			$this->isQuyenNV=0;
		}
		else
		{
			$this->isQuyenNV=1;
			$this->quanlykhuvuc=$this->khuvuc;

		}
		
		if($_SESSION['ERPSOFV2RUserID']=='MINHNGHIA' || $_SESSION['ERPSOFV2RUserID']=='THANHHUY' || $_SESSION['ERPSOFV2RUserID']=='MINHDUY'  || $_SESSION['ERPSOFV2RUserID']=='PHUONGTHAO' || $_SESSION['ERPSOFV2RUserID']=='admin' || $_SESSION['ERPSOFV2RUserID']=='kinhdoanh')
		{
			$this->isQuyenNV=2;
			$this->lv129='';
			$this->lv025_='';
			$this->lv025='';
			$this->quanlykhuvuc='';
			
		}
		$vsql="select A.lv002  lv001 from cr_lv0209 A where A.lv003='".$_SESSION['ERPSOFV2RUserID']."'";
		$this->khachhangshare=$this->GetMultiValue($vsql);
		if($this->khachhangshare=="''") $this->khachhangshare='';
		if($this->khuvuc!='')
		{
			switch($this->isPPTTT)
			{
				case 0:
					if($this->ListKD!='')
						$vsql="select lv001 from hr_lv0020 where lv062='$this->khuvuc' and lv029 in (".$this->ListKD.")";
					else
						$vsql="select lv001 from hr_lv0020 where lv062='$this->khuvuc'";
					$this->nvkhuvuc=trim($this->GetMultiValue($vsql));
					break;
				case 1:
					if($this->ListPTTT!='')
						$vsql="select lv001 from hr_lv0020 where lv062='$this->khuvuc' and lv029 in (".$this->ListPTTT.")";
					else
						$vsql="select lv001 from hr_lv0020 where lv062='$this->khuvuc'";
					
					$this->nvkhuvuc=trim($this->GetMultiValue($vsql));
					break;
				case 2:
					if($this->ListAD!='')
						$vsql="select lv001 from hr_lv0020 where lv062='$this->khuvuc'  and lv029 in (".$this->ListAD.")";
					else
						$vsql="select lv001 from hr_lv0020 where lv062='$this->khuvuc'";
					
					$this->nvkhuvuc=trim($this->GetMultiValue($vsql));
					break;
				default:
					$vsql="select lv001 from hr_lv0020 where lv062='$this->khuvuc'";
					$this->nvkhuvuc=trim($this->GetMultiValue($vsql));
					break;
			}
			if($this->isQuyenNV==1)
			{
				$vsql="select A.lv002  lv001 from cr_lv0209 A inner join lv_lv0007 B on A.lv003=B.lv001 where B.lv006 in (".$this->nvkhuvuc.")";
				$vkhachhangshare=$this->GetMultiValue($vsql);
				if($this->khachhangshare=='')
				{
					$this->khachhangshare=$vkhachhangshare;
				}
				else
				{
					$this->khachhangshare=$this->khachhangshare.','.$vkhachhangshare;
				}
			}
			
		}
		if($_SESSION['ERPSOFV2RUserID']=='MINHDUC')
		{
			//$this->isPPTTT=0;
			$this->lv129='';
			$this->lv025_='';
			$this->lv025='';
			$vListKD=$this->LV_GetDep('KDHN');
			$this->isQuyenNV=2;
			$vsql="select lv001 from hr_lv0020 where lv062='$this->khuvuc' and lv029 in (".$vListKD.")";
			if($this->nvkhuvuc=='')
				$this->nvkhuvuc=trim($this->GetMultiValue($vsql));
			else
				$this->nvkhuvuc=$this->nvkhuvuc.','.trim($this->GetMultiValue($vsql));
		}
	}
	function LV_Load()
	{
		$vsql="select * from  sl_lv0001";
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
			$this->lv088=$vrow['lv088'];
			$this->lv099=$vrow['lv099'];
		}
	}
	function LV_LoadName($vName)
	{
		$lvsql="select * from  sl_lv0001 Where lv002='$vName'";
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
			$this->lv088=$vrow['lv088'];
			$this->lv099=$vrow['lv099'];
		}
		else
			$this->lv001="";
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  sl_lv0001 Where lv001='$vlv001'";
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
			$this->lv088=$vrow['lv088'];
			$this->lv099=$vrow['lv099'];
		}
		else
			$this->lv001="";
	}
	function LV_CheckShare($vCusID,$vUserID)
	{
		$vsql="select count(*) Nums from cr_lv0209 A where A.lv003='$vUserID' and A.lv002='$vCusID'";
		$bResult=db_query($vsql);
		return $vrow['Nums'];
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
	function GetBuilCheckShift($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002')
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
		$vsql="select * from  ".$vTbl." where lv001!='' ";
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
	function LV_CheckCMND($vMemberID,$vCMND)
	{
		$vCusID='';
		$lvsql="select lv001 from  sl_lv0001 Where lv025='$vMemberID' and lv013='$vCMND'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vCusID=$vrow['lv001'];
		}
		return $vCusID;
	}
	function LV_CheckCMND_Service($vDataSave,$vMemberID,$vCMND)
	{
		$vCusID='';
		$lvsql="select lv001 from  ".$vDataSave."sl_lv0001 Where lv025='$vMemberID' and lv013='$vCMND'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vCusID=$vrow['lv001'];
		}
		return $vCusID;
	}
	function LV_InsertMember_Service($vDataSave)
	{		
		if($this->isAdd==0) return false;
		$lvsql="insert into ".$vDataSave."sl_lv0001 (lv001,lv002,lv006,lv011,lv013,lv015,lv017,lv025,lv024) values('$this->lv001','".sof_escape_string($this->lv002)."','".sof_escape_string($this->lv006)."','$this->lv011','$this->lv013','$this->lv015','$this->lv017','$this->lv025',now())";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0001.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_UpdateMember_Service($vDataSave)
	{
		if($this->isEdit==0) return false;
		$lvsql="Update ".$vDataSave."sl_lv0001 set lv002='".sof_escape_string($this->lv002)."',lv006='".sof_escape_string($this->lv006)."',lv011='$this->lv011',lv013='$this->lv013',lv015='$this->lv015',lv017='$this->lv017' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0001.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_InsertMember()
	{		
		if($this->isAdd==0) return false;
		$this->lv017 = ($this->lv017!="")?recoverdate(($this->lv017), $this->lang):$this->DateDefault;
		$lvsql="insert into sl_lv0001 (lv001,lv002,lv006,lv011,lv013,lv015,lv017,lv025,lv024) values('$this->lv001','".sof_escape_string($this->lv002)."','".sof_escape_string($this->lv006)."','$this->lv011','$this->lv013','$this->lv015','$this->lv017','$this->lv025',now())";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0001.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_UpdateMember()
	{
		if($this->isEdit==0) return false;
		$this->lv017 = ($this->lv017!="")?recoverdate(($this->lv017), $this->lang):$this->DateDefault;
		$lvsql="Update sl_lv0001 set lv002='".sof_escape_string($this->lv002)."',lv006='".sof_escape_string($this->lv006)."',lv011='$this->lv011',lv013='$this->lv013',lv015='$this->lv015',lv017='$this->lv017' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0001.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_CheckExitCus($vlv001)
	{
		$vCusID=null;
		$lvsql="select lv001 from  sl_lv0001 Where lv001='$vlv001'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vCusID=$vrow['lv001'];
		}
		return $vCusID;
	}
	function LV_CheckExitChild($vlv002,$vlv003,$vlv004)
	{
		$vCusID=null;
		$lvsql="select lv001 from  sl_lv0299 Where lv002='$vlv002' and lv003='$vlv003' and lv004='$vlv004'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vCusID=$vrow['lv001'];
		}
		return $vCusID;
	}
	function LV_Insert_Update()
	{
		if($this->isEdit==0) return false;
		//$this->lv017 = ($this->lv017!="")?recoverdate(($this->lv017), $this->lang):$this->DateDefault;
		$lvsql="Update sl_lv0001 set lv002='".sof_escape_string($this->lv002)."',lv006='".sof_escape_string($this->lv006)."',lv010='".sof_escape_string($this->lv010)."',lv012='".sof_escape_string($this->lv012)."',lv015='".sof_escape_string($this->lv015)."',lv016='".sof_escape_string($this->lv016)."',lv021='".sof_escape_string($this->lv021)."',lv022='".sof_escape_string($this->lv022)."',lv023='".sof_escape_string($this->lv023)."',lv024=now(),lv025='$this->LV_UserID' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) 
		{
			$this->InsertLogOperation($this->DateCurrent,'sl_lv0001.insert',sof_escape_string($lvsql));
			$vIDUpdate=$this->LV_CheckExitChild($this->lv001,$this->lv803,$this->lv804);
			if($vIDUpdate==null)
			{
				$lvsql1="insert into sl_lv0299 (lv002,lv003,lv004,lv005,lv006,lv007,lv009) values('".$this->lv001."','".$this->lv803."','".$this->lv804."','".$this->lv805."','','".$this->lv807."',1)";
				$vReturn1= db_query($lvsql1);
			}
			else
			{
				$lvsql1="update sl_lv0299 set lv005='$this->lv805',lv007='$this->lv807' where lv001='$vIDUpdate'";
				$vReturn1= db_query($lvsql1);
			}
			if($vReturn1) 
			{
				$this->InsertLogOperation($this->DateCurrent,'sl_lv0299.insert',sof_escape_string($lvsql1));
			}
		}
		return $vReturn;
	}
	function LV_Insert()
	{		
		if($this->isAdd==0) return false;
		//$this->lv017 = ($this->lv017!="")?recoverdate(($this->lv017), $this->lang):$this->DateDefault;
		$lvsql="insert into sl_lv0001 (lv001,lv002,lv006,lv010,lv012,lv015,lv021,lv022,lv023,lv024,lv025,lv013,lv016,lv088) values('$this->lv001','".sof_escape_string($this->lv002)."','".sof_escape_string($this->lv006)."','".sof_escape_string($this->lv010)."','".sof_escape_string($this->lv012)."','".sof_escape_string($this->lv015)."','".sof_escape_string($this->lv021)."','".sof_escape_string($this->lv022)."','".sof_escape_string($this->lv023)."',now(),'$this->LV_UserID','".sof_escape_string($this->lv013)."','".sof_escape_string($this->lv016)."','".sof_escape_string($this->lv088)."')";
		$vReturn= db_query($lvsql);
		if($vReturn) 
		{
			$this->InsertLogOperation($this->DateCurrent,'sl_lv0001.insert',sof_escape_string($lvsql));
			if(trim($this->lv803)!='' || trim($this->lv804)!='' || trim($this->lv805)!='' || trim($this->lv807)!='')
			{
				$lvsql1="insert into sl_lv0299 (lv002,lv003,lv004,lv005,lv006,lv007,lv009,lv011,lv012) values('".$this->lv001."','".$this->lv803."','".$this->lv804."','".$this->lv805."','','".$this->lv807."',1,'$this->LV_UserID',now())";
				$vReturn1= db_query($lvsql1);
				if($vReturn1) 
				{
					$this->InsertLogOperation($this->DateCurrent,'sl_lv0299.insert',sof_escape_string($lvsql1));
				}
			}
		}
		return $vReturn;
	}	
	function LV_InsertChild()
	{	
		$lvsql1="insert into sl_lv0299 (lv002,lv003,lv004,lv005,lv006,lv007,lv009,lv011,lv012) values('".$this->lv001."','".$this->lv003."','".$this->lv005."','".$this->lv010."','".$this->lv011."','".$this->lv015."',1,'$this->LV_UserID',now())";
		$vReturn1= db_query($lvsql1);
		if($vReturn1) 
		{
			$this->InsertLogOperation($this->DateCurrent,'sl_lv0299.insert',sof_escape_string($lvsql1));
		}
	}
	function LV_InsertAuto()
	{		
		if($this->isAdd==0) return false;
		//$this->lv017 = ($this->lv017!="")?recoverdate(($this->lv017), $this->lang):$this->DateDefault;
		$lvsql="insert into sl_lv0001 (lv001,lv002,lv006,lv010,lv012,lv015,lv021,lv022,lv023,lv024,lv025,lv099,lv013,lv016,lv088) values('$this->lv001','".sof_escape_string($this->lv002)."','".sof_escape_string($this->lv006)."','".sof_escape_string($this->lv010)."','".sof_escape_string($this->lv012)."','".sof_escape_string($this->lv015)."','".sof_escape_string($this->lv021)."','".sof_escape_string($this->lv022)."','".sof_escape_string($this->lv023)."',now(),'$this->LV_UserID','$this->lv099','".sof_escape_string($this->lv013)."','".sof_escape_string($this->lv016)."','".sof_escape_string($this->lv088)."')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0001.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_LoadMaOld($lv099)
	{
		$lvsql="select lv001 from  sl_lv0001 Where lv099='$lv099'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv001=$vrow['lv001'];
		}
		else
		{
			$this->lv001=null;
		}
		return $this->lv001;
	}
	//Lấy data
	function LV_GetDataAuto()
	{
		//Tạo lệnh sản xuất từ SAP.
		//Điều kiện sản xuất
		//Biểu diễn lệnh sản xuất, Mã Lệnh, Mã Lệnh SAP, 		
		$link = sqlsrv_connect($this->Server, $this->connectionOptions);
		if(!$link)
		{
			print_r(sqlsrv_errors());
			return;
		}
		//SELECT [id],[order_id],[reservation],[material],[plant],[sloc],[redate],[quant],[unit],[wqty],[wvalue],[cur],[une],[uentry],[pegre] FROM [erp_stk].[dbo].[sap_bom]	
		//$bResult = db_query($sqlS);
		$vCondition="";
		$lvsql = "SELECT [CON_ID] lv099
		,[CON_CODE] lv001
		,[CON_NAME] lv002
		,[CON_ADDRESS] lv006
		,[CON_TEL] lv010
		,[CON_FAX] lv012
		,[CON_EMAIL] lv015
		,[CON_SERVICE] lv021
		,[CON_DESC] lv022
		,[CON_ACTIVE] lv023
		,[USERS_ID1] lv024
		,[INPUT_DATE] lv025
	FROM [ContractManagement].[dbo].[CONTRACTOR]
  where 1=1 $vCondition";
		$vresult=sqlsrv_query($link,$lvsql);
		$i=0;
		while($vrow=sqlsrv_fetch_array($vresult))
		{
			$vOldID=$this->LV_LoadMaOld($vrow['lv099']);
			if($vOldID==null)
			{
				$this->lv001=$vrow['lv001'];
				$this->lv002=$vrow['lv002'];
				$this->lv006=$vrow['lv006'];
				$this->lv010=$vrow['lv010'];
				$this->lv012=$vrow['lv012'];
				$this->lv015=$vrow['lv015'];	
				$this->lv021=$vrow['lv021'];
				$this->lv022=$vrow['lv022'];
				$this->lv023=$vrow['lv023'];
				$this->lv024=$vrow['lv024'];
				$this->lv025=$vrow['lv025'];
				$this->lv099=$vrow['lv099'];
				$this->LV_InsertAuto();
				$this->LV_Load_Child($vrow['lv099'],$vrow['lv001'],$link);
			}
			else
				$this->LV_Load_Child($vrow['lv099'],$vrow['lv001'],$link);
		}
		//Biễu diễn chi tiết sản xuất. 
	}
	function LV_Load_Child($vCON_ID,$vCON_CODE,$link)
	{
		/*$link = sqlsrv_connect($this->Server, $this->connectionOptions);
		if(!$link)
		{
			print_r(sqlsrv_errors());
			return;
		}*/
		$vCondition=" and [CON_ID]='$vCON_ID'";
		$lvsql = "SELECT [PER_ID] lv099
		,[CON_ID] lv002
		,[PER_NAME] lv003
		,[PER_TITLE] lv004
		,[PER_TEL1] lv005
		,[PER_TEL2] lv006
		,[PER_EMAIL] lv007
		,[PER_REMARK] lv010
		,[PER_STATUS] lv008
		,[PER_STATUS] lv009
		FROM [ContractManagement].[dbo].[CON_CONTACT] 
		where 1=1 $vCondition";
		$vresult=sqlsrv_query($link,$lvsql);
		$i=0;
		while($vrow=sqlsrv_fetch_array($vresult))
		{
			$vOldID=$this->LV_LoadMaOldChild($vrow['lv099']);
			if($vOldID==null)
			{
				$vsql="insert into sl_lv0299(lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv099) 
				values('".sof_escape_string($vCON_CODE)."','".sof_escape_string($vrow['lv003'])."','".sof_escape_string($vrow['lv004'])."','".sof_escape_string($vrow['lv005'])."','".sof_escape_string($vrow['lv006'])."','".sof_escape_string($vrow['lv007'])."','".sof_escape_string($vrow['lv008'])."','".sof_escape_string($vrow['lv009'])."','".sof_escape_string($vrow['lv010'])."','".sof_escape_string($vrow['lv099'])."')";
				$vReturn= db_query($vsql);
			}
		}
		return $vReturn;
	}
	function LV_LoadMaOldChild($lv099)
	{
		$lvsql="select lv001 from  sl_lv0299 Where lv099='$lv099'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['lv001'];
		}
		else
		{
			return null;
		}
	}
	function LV_InsertFull()
	{		
		if($this->isAdd==0) return false;
		$this->lv017 = ($this->lv017!="")?recoverdate(($this->lv017), $this->lang):$this->DateDefault;
		$lvsql="insert into sl_lv0001 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv099) values('$this->lv001',UPPER('".sof_escape_string($this->lv002)."'),'$this->lv003','$this->lv004','$this->lv005','".sof_escape_string($this->lv006)."','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv018','$this->lv019','$this->lv020','$this->lv021','$this->lv022','$this->lv023','$this->lv024','$this->lv025','$this->lv099')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0001.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		//$this->lv017 = ($this->lv017!="")?recoverdate(($this->lv017), $this->lang):$this->DateDefault;
		$lvsql="Update sl_lv0001 set lv001='".($this->lv001_)."',lv002=UPPER('".sof_escape_string($this->lv002)."'),lv006='".sof_escape_string($this->lv006)."',lv010='".sof_escape_string($this->lv010)."',lv012='".sof_escape_string($this->lv012)."',lv015='".sof_escape_string($this->lv015)."',lv016='".sof_escape_string($this->lv016)."',lv021='".sof_escape_string($this->lv021)."',lv022='".sof_escape_string($this->lv022)."',lv023='".sof_escape_string($this->lv023)."',lv013='".sof_escape_string($this->lv013)."',lv088='".sof_escape_string($this->lv088)."' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0001.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateFull()
	{
		if($this->isEdit==0) return false;
		$this->lv017 = ($this->lv017!="")?recoverdate(($this->lv017), $this->lang):$this->DateDefault;
		$lvsql="Update sl_lv0001 set lv002=UPPER('".sof_escape_string($this->lv002)."'),lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='".sof_escape_string($this->lv006)."',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016',lv017='$this->lv017',lv018='$this->lv018',lv019='$this->lv019',lv020='$this->lv020',lv021='$this->lv021',lv022='$this->lv022',lv023='$this->lv023',lv099='$this->lv099' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0001.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateState($vCustomerID,$vState)
	{
		$lvsql="Update sl_lv0001 set lv023='$vState' where  lv001='$vCustomerID';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0001.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM sl_lv0001  WHERE sl_lv0001.lv001 IN ($lvarr) and (select count(*) from sl_lv0010 B where  B.lv002= sl_lv0001.lv001)<=0  and (select count(*) from sl_lv0013 B where  B.lv002= sl_lv0001.lv001)<=0 ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0001.delete',sof_escape_string($lvsql));
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
	function GetCondition11()
	{
		$strCondi="";
		if($this->lv022!="") 
		{
			if(!strpos($this->lv022,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv022);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv022 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv022 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				 $strCondi=$strCondi." and A.lv022  like '%$this->lv022%'";
			}
			
		}
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
						$strCondi= " AND ( A.lv001 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv001 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv001  = '$this->lv001'";
			}
			
		}
		if($this->lv002!="") 
		{
			/*if(!strpos($this->lv002,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv002);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv002 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv002 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{*/
				$strCondi=$strCondi." and A.lv002  like '%$this->lv002%'";
			//}
			
		}
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->lv006!="") 
		{
			if(!strpos($this->lv006,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv006);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv006 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv006 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
			}
			
		}
		if($this->lv007!="")  $strCondi=$strCondi." and A.lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and A.lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and A.lv009 like '%$this->lv009%'";
		if($this->lv010!="") 
		{
			if(!strpos($this->lv010,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv010);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv010 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv010 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv010  like '%$this->lv010%'";
			}
			
		}
		if($this->lv011!="")  $strCondi=$strCondi." and A.lv011 like '%$this->lv011%'";
		if($this->lv012!="") 
		{
			if(!strpos($this->lv012,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv012);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv012 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv012 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv012  like '%$this->lv012%'";
			}
			
		}
		if($this->lv013!="")  $strCondi=$strCondi." and A.lv013 like '%$this->lv013%'";
		if($this->lv014!="")  $strCondi=$strCondi." and A.lv014 like '%$this->lv014%'";
		if($this->lv015!="") 
		{
			if(!strpos($this->lv015,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv015);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv015 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv015 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv015  like '%$this->lv015%'";
			}
			
		}
		if($this->lv016!="")  $strCondi=$strCondi." and A.lv016 like '%$this->lv016%'";
		if($this->lv017!="")  $strCondi=$strCondi." and A.lv017 like '%$this->lv017%'";
		if($this->lv018!="")  $strCondi=$strCondi." and A.lv018 like '%$this->lv018%'";
		if($this->lv019!="")  $strCondi=$strCondi." and A.lv019 like '%$this->lv019%'";
		if($this->lv020!="")  $strCondi=$strCondi." and A.lv020 like '%$this->lv020%'";
		if($this->lv021!="") 
		{
			if(!strpos($this->lv021,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv021);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv021 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv021 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv021  like '%$this->lv021%'";
			}
			
		}
		if($this->lv925!="") 
		{
			if(!strpos($this->lv925,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv925);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv025 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv025 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				 $strCondi=$strCondi." and A.lv025  = '$this->lv925'";
			}
			
		}
		if($this->lv023!="")  $strCondi=$strCondi." and A.lv023 like '%$this->lv023%'";
		if($this->lv024!="")  $strCondi=$strCondi." and A.lv024 like '%$this->lv024%'";
		if($this->lv099!="")  $strCondi=$strCondi." and A.lv099 like '$this->lv099'";
		
		if($this->lv025!="") 
		{
			if(!strpos($this->lv025,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv025);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv025 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv025 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				 $strCondi=$strCondi." and A.lv025  = '$this->lv025'";
			}
			
		}
		return $strCondi;
	}
	protected function GetCondition()
	{
		$strCondi="";
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
						$strCondi= " AND ( A.lv001 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv001 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv001  = '$this->lv001'";
			}
			
		}
		if($this->lv002!="") 
		{
			/*if(!strpos($this->lv002,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv002);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv002 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv002 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv002  like '%$this->lv002%'";
			}*/
			$strCondi=$strCondi." and A.lv002  = '$this->lv002'";
		}
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->lv006!="") 
		{
			if(!strpos($this->lv006,';')===false)
			{	
				$vArrNameCus=explode(";",$this->lv006);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv006 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv006 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv006  = '$this->lv006'";
			}
			
		}
		if($this->lv007!="")  $strCondi=$strCondi." and A.lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and A.lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and A.lv009 like '%$this->lv009%'";
		if($this->lv010!="") 
		{
			if(!strpos($this->lv010,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv010);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv010 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv010 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv010  = '$this->lv010'";
			}
			
		}
		if($this->lv011!="")  $strCondi=$strCondi." and A.lv011 like '%$this->lv011%'";
		if($this->lv012!="") 
		{
			if(!strpos($this->lv012,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv012);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv012 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv012 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv012  = '$this->lv012'";
			}
			
		}
		if($this->lv013!="")  $strCondi=$strCondi." and A.lv013 like '%$this->lv013%'";
		if($this->lv014!="")  $strCondi=$strCondi." and A.lv014 like '%$this->lv014%'";
		if($this->lv015!="") 
		{
			if(!strpos($this->lv015,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv015);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv015 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv015 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv015  = '$this->lv015'";
			}
			
		}
		if($this->lv016!="")  $strCondi=$strCondi." and A.lv016 like '%$this->lv016%'";
		if($this->lv017!="")  $strCondi=$strCondi." and A.lv017 like '%$this->lv017%'";
		if($this->lv018!="")  $strCondi=$strCondi." and A.lv018 like '%$this->lv018%'";
		if($this->lv019!="")  $strCondi=$strCondi." and A.lv019 like '%$this->lv019%'";
		if($this->lv020!="")  $strCondi=$strCondi." and A.lv020 like '%$this->lv020%'";
		if($this->lv021!="") 
		{
			if(!strpos($this->lv021,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv021);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv021 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv021 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv021  = '$this->lv021'";
			}
			
		}
		if($this->lv022!="") 
		{
			if(!strpos($this->lv022,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv022);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv022 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv022 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				 $strCondi=$strCondi." and A.lv022  = '$this->lv022'";
			}
			
		}
		if($this->lv925!="") 
		{
			if(!strpos($this->lv925,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv925);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv025 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv025 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				 $strCondi=$strCondi." and A.lv025  = '$this->lv925'";
			}
			
		}
		if($this->lv023!="")  $strCondi=$strCondi." and A.lv023 like '%$this->lv023%'";
		if($this->lv024!="")  $strCondi=$strCondi." and A.lv024 like '%$this->lv024%'";
		if($this->lv099!="")  $strCondi=$strCondi." and A.lv099 like '$this->lv099'";
		$vstr1='';
		if($this->lv025_!="")
		{
			$vsql="select A.lv002  lv001 from cr_lv0209 A inner join lv_lv0007 B on A.lv003=B.lv001 where B.lv006='$this->lv025_'";
			$vstr1=$this->GetMultiValue($vsql);
		}
		if($this->lv025_!="" || $this->lv129!=""  || $this->quanlykhuvuc!="")
		{
			if($this->lv129!="")
			{
				$vsql="select lv001 from hr_lv0020 where lv029 in ('".str_replace(",","','",$this->lv129)."')";
				$vstr=trim($this->GetMultiValue($vsql));
			}
			$vstr2='';
			if($this->quanlykhuvuc!="")
			{
				$vstr2=$this->nvkhuvuc;
				if($vstr2!='')
				{
					if($vstr=='')
						$vstr=$vstr2;
					else
						$vstr=$vstr.','.$vstr2;
				}
			}
		
			/*if($vstr1!='')
				$strCondi=$strCondi." and (A.lv025 in ('$this->lv025',$vstr) or A.lv001 in ($vstr1))"; 
			else
				$strCondi=$strCondi." and A.lv025 in ('$this->lv025',$vstr)"; 
			*/
			if($this->lv025_!="")
			{
				
				if($vstr!='' && $vstr!="''")
				{
					if($vstr1!='')
					{
						$strCondi=$strCondi." and ((A.lv025 in ('$this->lv025_',$vstr)) or A.lv001 in ($vstr1))"; 
					}
					else
						$strCondi=$strCondi." and (A.lv025 in ('$this->lv025_',$vstr))"; 
				}
				else
				{
					if($vstr1!='')
					{
						$strCondi=$strCondi." and ((A.lv025 = '$this->lv025_') or A.lv001 in ($vstr1))"; 
					}
					else
						$strCondi=$strCondi." and (A.lv025 = '$this->lv025_')"; 
				}
			}
			else if($vstr!='' && $vstr!="''") 
			{
				if($vstr1!='')
					{
						$strCondi=$strCondi." and (A.lv025 in ($vstr) or A.lv001 in ($vstr1))";
					}
				else
					$strCondi=$strCondi." and A.lv025 in ($vstr)"; 
			}
		}
		if($this->lv025!="") 
		{
			if(!strpos($this->lv025,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv025);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv025 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv025 = '$vNameCus'";		
					}
				}
				if($vstr1!='')
					{
						$strCondi=$strCondi." or A.lv001 in ($vstr1))";
					}
				else
					$strCondi=$strCondi.")";
				
			}
			else
			{
				if($vstr1!='')
					{
						$strCondi=$strCondi." and ((A.lv025  = '$this->lv025')  or A.lv001 in ($vstr1))";
					}
				else
					 $strCondi=$strCondi." and A.lv025  = '$this->lv025'";
			}
			
		}
		return $strCondi;
	}
	protected function GetConditionSearch()
	{
		$strCondi="";
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
						$strCondi= " AND ( A.lv001 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv001 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv001  = '$this->lv001'";
			}
			
		}
		if($this->lv002!="") 
		{
			/*if(!strpos($this->lv002,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv002);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv002 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv002 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv002  like '%$this->lv002%'";
			}*/
			$strCondi=$strCondi." and A.lv002  = '$this->lv002'";
		}
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->lv006!="") 
		{
			if(!strpos($this->lv006,';')===false)
			{	
				$vArrNameCus=explode(";",$this->lv006);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv006 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv006 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv006  = '$this->lv006'";
			}
			
		}
		if($this->lv007!="")  $strCondi=$strCondi." and A.lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and A.lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and A.lv009 like '%$this->lv009%'";
		if($this->lv010!="") 
		{
			if(!strpos($this->lv010,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv010);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv010 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv010 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv010  = '$this->lv010'";
			}
			
		}
		if($this->lv011!="")  $strCondi=$strCondi." and A.lv011 like '%$this->lv011%'";
		if($this->lv012!="") 
		{
			if(!strpos($this->lv012,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv012);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv012 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv012 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv012  = '$this->lv012'";
			}
			
		}
		if($this->lv013!="")  $strCondi=$strCondi." and A.lv013 like '%$this->lv013%'";
		if($this->lv014!="")  $strCondi=$strCondi." and A.lv014 like '%$this->lv014%'";
		if($this->lv015!="") 
		{
			if(!strpos($this->lv015,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv015);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv015 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv015 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv015  = '$this->lv015'";
			}
			
		}
		if($this->lv016!="")  $strCondi=$strCondi." and A.lv016 like '%$this->lv016%'";
		if($this->lv017!="")  $strCondi=$strCondi." and A.lv017 like '%$this->lv017%'";
		if($this->lv018!="")  $strCondi=$strCondi." and A.lv018 like '%$this->lv018%'";
		if($this->lv019!="")  $strCondi=$strCondi." and A.lv019 like '%$this->lv019%'";
		if($this->lv020!="")  $strCondi=$strCondi." and A.lv020 like '%$this->lv020%'";
		if($this->lv021!="") 
		{
			if(!strpos($this->lv021,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv021);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv021 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv021 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and A.lv021  = '$this->lv021'";
			}
			
		}
		if($this->lv022!="") 
		{
			if(!strpos($this->lv022,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv022);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv022 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv022 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				 $strCondi=$strCondi." and A.lv022  = '$this->lv022'";
			}
			
		}
		if($this->lv925!="") 
		{
			if(!strpos($this->lv925,',')===false)
			{	
				$vArrNameCus=explode(",",$this->lv925);
				foreach($vArrNameCus as $vNameCus)
				{
					if($vNameCus!="")
					{
					if($strCondi=="")	
						$strCondi= " AND ( A.lv025 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR A.lv025 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				 $strCondi=$strCondi." and A.lv025  = '$this->lv925'";
			}
			
		}
		if($this->lv023!="")  $strCondi=$strCondi." and A.lv023 like '%$this->lv023%'";
		if($this->lv024!="")  $strCondi=$strCondi." and A.lv024 like '%$this->lv024%'";
		if($this->lv099!="")  $strCondi=$strCondi." and A.lv099 like '$this->lv099'";
		
		return $strCondi;
	}
	function LV_GetMoreCustomer($vStaffID)
	{
		
	}
	function LV_ListPopupYear($vCustomerID,$vYearTo)
	{
		$i=2014;
		$vStrReturn='
		<div  style="position:relative"><img src="../images/icon/income.png" onclick="document.getElementById(\'logto\').style.display=\'block\'">
		<div id="logto" style="display:none;position:absolute;z-index:9999;background:#FFF;" >
		<img src="../images/icon/close.png" style="position:absolute;right:0px;top:0px" onclick="document.getElementById(\'logto\').style.display=\'none\'">
		
		<table border=1 cellspacing=0 cellpadding=0 class="lvtable" style="width:150px!important">
		<tr class="lvhtable"><td  class="lvhtable">Năm</td><td  class="lvhtable">Tổng tiền nạp</td><td  class="lvhtable">Tổng tiền mua</td><td  class="lvhtable">Tổng tiền còn lại</td>
		';
		$vSum=0;
		for(;$i<=$vYearTo;$i++)
		{
			$vTotalContract=$this->LV_GetContractMoney($vCustomerID,$i);
			$vTotalMoneyPT=$this->LV_GetPTMoney($vCustomerID,$i)-$this->LV_GetPCMoney($vCustomerID,$i);
			$vSum1=$vSum1+$vTotalMoneyPT;
			$vSum2=$vSum2+$vTotalContract;
			$vStrReturn=$vStrReturn."<tr class=\"lvlinehtable".($i%2)."\"><td>".$i."</td><td align=right>".$this->FormatView($vTotalMoneyPT,10)."</td><td align=right>".$this->FormatView($vTotalContract,10)."</td><td align=right>".$this->FormatView($vTotalMoneyPT-$vTotalContract,10)."</td></tr>";
		}
		$vStrReturn=$vStrReturn."
		<tr class=\"lvlinehtable".($i%2)."\"><td >Tổng:</td><td align=right> ".$this->FormatView($vSum1,10)."</td><td align=right> ".$this->FormatView($vSum2,10)."</td><td align=right> ".$this->FormatView($vSum1-$vSum2,10)."</td></tr>";
		$i++;
		$vStrReturn=$vStrReturn."
		<tr class=\"lvlinehtable".($i%2)."\"><td colspan='4' >Ma KH: ".$vCustomerID."</td></tr>
		</table>
		</div>
		</div>
		";
		$this->SaveTotal=$vSum1-$vSum2;
		return $vStrReturn;
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
		////////////////Count///////////////////////////
	function LV_CheckLoaiKH($vLoaiKH)
	{
		$vLoaiKH="'".$vLoaiKH."'";
		if($this->isPPTTT==1)
		{
			if(strpos("'TT','ME','NT','TKME','TKKT','TKCS','TKLandscape','TKNT'",$vLoaiKH)===false)
			{
				return false;
			}
			return true;
		}
		elseif($this->isPPTTT==2)
		{
			if(strpos("'TT','ME','NT','QLKL','TVGS'",$vLoaiKH)===false)
			{
				return false;
			}
			return true;
		}
		else
		{
			if(strpos("'TT','ME','NT'",$vLoaiKH)===false)
			{
				return false;
			}
			return true;
		}
		return false;
	}
	function GetCount()
	{
		if($this->nvkhuvuc=='') $this->nvkhuvuc="''";
		if($this->isPPTTT==1)
		{
			// 'TKME','TKKT','TKCS','TKLandscape','TKNT'
			switch($this->isQuyenNV)
			{	
				case 1:
					if($this->khachhangshare!='')
						$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0001 A WHERE   (A.lv022 in ('TKME','TKKT','TKCS','TKLandscape','TKNT') ".$this->GetConditionSearch().") or (A.lv001 in ($this->khachhangshare) and 1=1 ".$this->GetConditionSearch().") or  ((A.lv025 in (".$this->nvkhuvuc.") ".$this->GetConditionSearch().") and A.lv022 in ('CĐT','BQLDA','TKME','TKKT','TKCS','TKLandscape','TKNT')  ) or ( 1=1 ".$this->GetCondition().")";
					else
						$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0001 A WHERE   (A.lv022 in ('TKME','TKKT','TKCS','TKLandscape','TKNT') ".$this->GetConditionSearch().") or ((A.lv025 in (".$this->nvkhuvuc.") ".$this->GetConditionSearch().") and A.lv022 in ('CĐT','BQLDA','TKME','TKKT','TKCS','TKLandscape','TKNT')  ) or ( 1=1 ".$this->GetCondition().")";
					break;			
				case 2:
					$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0001 A WHERE    ( 1=1 ".$this->GetCondition().")";
					break;
				default:
					if($this->khachhangshare!='')
						$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0001 A WHERE   (A.lv022 in ('TKME','TKKT','TKCS','TKLandscape','TKNT') ".$this->GetConditionSearch().") or (A.lv001 in ($this->khachhangshare) and 1=1 ".$this->GetConditionSearch().") or  (A.lv022 in ('TT','ME','NT','TKME','TKKT','TKCS','TKLandscape','TKNT') ".$this->GetCondition11().") or ( 1=1 ".$this->GetCondition().")";
					else
						$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0001 A WHERE   (A.lv022 in ('TKME','TKKT','TKCS','TKLandscape','TKNT') ".$this->GetConditionSearch().") or (A.lv022 in ('TT','ME','NT','TKME','TKKT','TKCS','TKLandscape','TKNT') ".$this->GetCondition11().") or ( 1=1 ".$this->GetCondition().")";	
					break;
			}
		}
		elseif($this->isPPTTT==2)
		{
			switch($this->isQuyenNV)
			{				
				case 2:
					$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0001 A WHERE    ( 1=1 ".$this->GetCondition().")";
					break;
				default:
					if($this->khachhangshare!='')
						$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0001 A WHERE   (A.lv001 in ($this->khachhangshare) and 1=1 ".$this->GetConditionSearch().") or ( 1=1 ".$this->GetCondition().")";
					else
						$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0001 A WHERE     ( 1=1 ".$this->GetCondition().")";	
					break;
			}
		}
		else
		{
			//'QLKL','TVGS','TT','ME','NT'
			switch($this->isQuyenNV)
			{	
				case 1:
					if($this->khachhangshare!='')
						$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0001 A WHERE   (A.lv022 in ('QLKL','TVGS','TT','ME','NT') ".$this->GetConditionSearch().") or (A.lv001 in ($this->khachhangshare) and 1=1 ".$this->GetConditionSearch().") or (A.lv025 in (".$this->nvkhuvuc.") ".$this->GetConditionSearch().") or ( 1=1 ".$this->GetCondition().")";
					else
						$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0001 A WHERE    (A.lv022 in ('QLKL','TVGS','TT','ME','NT') ".$this->GetConditionSearch().") or (A.lv025 in (".$this->nvkhuvuc.") ".$this->GetConditionSearch().") or ( 1=1 ".$this->GetCondition().")";
					break;			
				case 2:
					$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0001 A WHERE    ( 1=1 ".$this->GetCondition().")";
					break;
				default:
					if($this->khachhangshare!='')
						$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0001 A WHERE   (A.lv022 in ('QLKL','TVGS','TT','ME','NT') ".$this->GetConditionSearch().") or (A.lv001 in ($this->khachhangshare) and 1=1 ".$this->GetConditionSearch().") or (A.lv022 in ('TT','ME','NT') ".$this->GetCondition11().") or ( 1=1 ".$this->GetCondition().")";
					else
						$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0001 A WHERE    (A.lv022 in ('QLKL','TVGS','TT','ME','NT') ".$this->GetConditionSearch().") or (A.lv022 in ('TT','ME','NT') ".$this->GetCondition11().") or ( 1=1 ".$this->GetCondition().")";
					break;
			}
			
		}
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_GetContractMoney($vCusID,$vYear='')
	{
		if($vYear!="") $vCondition=" and Year(B.lv004)='$vYear'";
		$lvsql="
			select * from (
			select sum(PM1.money-PM1.convertmoney+PM1.convertmoney*PM1.VAT/100-PM1.money*PM1.CKTM/100) TongTien from (select PM.ContractID,PM.VAT,PM.CKTM,sum(PM.lv003) money,sum(PM.lv004) convertmoney,sum(PM.lv005) discountmoney from ((select sum(A.lv004*A.lv006) lv003,sum(A.lv004*A.lv006*A.lv008/100) lv004,sum(A.lv004*A.lv006*A.lv011/100) lv005,B.lv022 CKTM,B.lv006 VAT,A.lv002 ContractID from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1 AND B.lv015=0 AND B.lv011>=2 and B.lv002='$vCusID'  $vCondition  )) PM ) PM1
			union
			select -sum(PM1.money-PM1.convertmoney+PM1.convertmoney*PM1.VAT/100-PM1.money*PM1.CKTM/100) TongTien from (select PM.ContractID,PM.VAT,PM.CKTM,sum(PM.lv003) money,sum(PM.lv004) convertmoney,sum(PM.lv005) discountmoney from ((select sum(A.lv004*A.lv006) lv003,sum(A.lv004*A.lv006*A.lv008/100) lv004,sum(A.lv004*A.lv006*A.lv011/100) lv005,B.lv022 CKTM,B.lv006 VAT,A.lv002 ContractID from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1 AND B.lv015=1 AND B.lv011>=2 and B.lv002='$vCusID'  $vCondition  )) PM ) PM1) MP2
		";	
		$vresult=db_query($lvsql);
		$vrow = db_fetch_array ($vresult);
		if($vrow['TongTien']==0)
		{
			return "0";
		}
		return $vrow['TongTien'];
	}

	function LV_GetInvoiceParent($vCusID,$vtype,$vYear='')
	{
		$vResult='';
		if($vYear!="") $vCondition=" and Year(B.lv009)='$vYear'";
		$lvsql = "select B.lv001 from ac_lv0004 B where B.lv003='CUS' and B.lv004='$vCusID' and B.lv002='$vtype' and B.lv017=0 $vCondition";
		$lvResult= db_query($lvsql);
		while($row= db_fetch_array($lvResult))
		{
			if($vResult=="")
				$vResult="'".$row['lv001']."'";
			else
				$vResult=$vResult.",'".$row['lv001']."'";;					
		}
		if($vResult=='') return "''";
		else
			return $vResult;
	}	
	function LV_GetPCMoney($vCusID,$vYear='')
	{
	//GetMoney
		if($vCusID=='' || $vCusID==NULL) return 0;
		$vListParent=$this->LV_GetInvoiceParent($vCusID,1,$vYear);
		$lvsql = "select if(ISNULL(sum(lv004)),0,sum(lv004)) SumMoney from ac_lv0005 A  WHERE A.lv002 in (".$vListParent.")";
		$vReturnArr=array();
		$lvResult= db_query($lvsql);
		$row= db_fetch_array($lvResult);
		return $row['SumMoney'];			
		
	}	
	function LV_GetPTMoney($vCusID,$vYear='')
	{
	//GetMoney
		if($vCusID=='' || $vCusID==NULL) return 0;
		$vListParent=$this->LV_GetInvoiceParent($vCusID,0,$vYear);
		$lvsql = "select if(ISNULL(sum(lv004)),0,sum(lv004)) SumMoney from ac_lv0005 A  WHERE  A.lv002 in (".$vListParent.") ";
		$vReturnArr=array();
		$lvResult= db_query($lvsql);
		$row= db_fetch_array($lvResult);
		return $row['SumMoney'];
	}
	function LV_GetGroupCustomer($vListStaff)
	{
		$vStrReturn='';
		$vArrStaff=explode(',',$vListStaff);
		foreach($vArrStaff as $vStaffID)
		{
			if($vStrReturn=='')
			{
				$vStrReturn=$this->getvaluelink('lv022',$vStaffID);
			}
			else
			{
				$vStrReturn=$vStrReturn.",".$this->getvaluelink('lv022',$vStaffID);
			}
		}
		return $vStrReturn;
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
		$lvHref="@02</span>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"2\">&nbsp;</td>";
		$lvTd="<td align=@#05>@02</td>";
		//$sqlS = "SELECT A.*,B.lv003 lv803,B.lv004 lv804,B.lv005 lv805,B.lv007 lv807 FROM sl_lv0001 A left join sl_lv0299 B on A.lv001=B.lv002   WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		
		if($this->isPPTTT==1)
		{
			switch($this->isQuyenNV)
			{
				case 1:
					if($this->khachhangshare!='')
						$sqlS = "SELECT A.* FROM sl_lv0001 A WHERE (A.lv022 in ('TKME','TKKT','TKCS','TKLandscape','TKNT') ".$this->GetConditionSearch().") or  (A.lv001 in ($this->khachhangshare) and 1=1 ".$this->GetConditionSearch().") or ((A.lv025 in (".$this->nvkhuvuc.") ".$this->GetConditionSearch().") and A.lv022 in ('CĐT','BQLDA','TKME','TKKT','TKCS','TKLandscape','TKNT')  ) or ( 1=1 ".$this->GetCondition().")  $strSort LIMIT $curRow, $maxRows";
					else
						$sqlS = "SELECT A.* FROM sl_lv0001 A WHERE (A.lv022 in ('TKME','TKKT','TKCS','TKLandscape','TKNT') ".$this->GetConditionSearch().") or  ((A.lv025 in (".$this->nvkhuvuc.") ".$this->GetConditionSearch().") and A.lv022 in ('CĐT','BQLDA','TKME','TKKT','TKCS','TKLandscape','TKNT')  ) or ( 1=1 ".$this->GetCondition().")  $strSort LIMIT $curRow, $maxRows";
					break;					
				case 2:
					$sqlS = "SELECT A.* FROM sl_lv0001 A WHERE     1=1 ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
					break;
				default:
					if($this->khachhangshare!='')
						$sqlS = "SELECT A.* FROM sl_lv0001 A WHERE  (A.lv022 in ('TKME','TKKT','TKCS','TKLandscape','TKNT') ".$this->GetConditionSearch().") or (A.lv001 in ($this->khachhangshare) and 1=1 ".$this->GetConditionSearch().") or (A.lv022 in ('TT','ME','NT','TKME','TKKT','TKCS','TKLandscape','TKNT')  ".$this->GetCondition11().")  or ( 1=1 ".$this->GetCondition().") $strSort LIMIT $curRow, $maxRows";
					else
						$sqlS = "SELECT A.* FROM sl_lv0001 A WHERE  (A.lv022 in ('TKME','TKKT','TKCS','TKLandscape','TKNT') ".$this->GetConditionSearch().") or (A.lv022 in ('TT','ME','NT','TKME','TKKT','TKCS','TKLandscape','TKNT')  ".$this->GetCondition11().")  or ( 1=1 ".$this->GetCondition().") $strSort LIMIT $curRow, $maxRows";
					break;
			}
		}
		elseif($this->isPPTTT==2)
		{
			switch($this->isQuyenNV)
			{
				case 2:
					$sqlS = "SELECT A.* FROM sl_lv0001 A WHERE     1=1 ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
					break;
				default:
					if($this->khachhangshare!='')
						$sqlS = "SELECT A.* FROM sl_lv0001 A WHERE   (A.lv001 in ($this->khachhangshare) and 1=1 ".$this->GetConditionSearch().") or ( 1=1 ".$this->GetCondition().") $strSort LIMIT $curRow, $maxRows";
					else
						$sqlS = "SELECT A.* FROM sl_lv0001 A WHERE   ( 1=1 ".$this->GetCondition().") $strSort LIMIT $curRow, $maxRows";
					break;
			}
		}
		else
		{
			switch($this->isQuyenNV)
			{
				case 1:
					if($this->khachhangshare!='')
						$sqlS = "SELECT A.* FROM sl_lv0001 A WHERE   (A.lv022 in ('QLKL','TVGS','TT','ME','NT') ".$this->GetConditionSearch().") or (A.lv001 in ($this->khachhangshare) and 1=1 ".$this->GetConditionSearch().") or (A.lv025 in (".$this->nvkhuvuc.") ".$this->GetConditionSearch().") or ( 1=1 ".$this->GetCondition().")  $strSort LIMIT $curRow, $maxRows";
					else
						$sqlS = "SELECT A.* FROM sl_lv0001 A WHERE   (A.lv022 in ('QLKL','TVGS','TT','ME','NT') ".$this->GetConditionSearch().") or (A.lv025 in (".$this->nvkhuvuc.") ".$this->GetConditionSearch().") or ( 1=1 ".$this->GetCondition().")  $strSort LIMIT $curRow, $maxRows";
					break;		
				case 2:
					$sqlS = "SELECT A.* FROM sl_lv0001 A WHERE     1=1 ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
					break;
				default:
					if($this->khachhangshare!='')
						$sqlS = "SELECT A.* FROM sl_lv0001 A WHERE   (A.lv022 in ('QLKL','TVGS','TT','ME','NT') ".$this->GetConditionSearch().") or (A.lv001 in ($this->khachhangshare) and 1=1 ".$this->GetConditionSearch().") or (A.lv022 in ('TT','ME','NT')  ".$this->GetCondition11().")  or ( 1=1 ".$this->GetCondition().") $strSort LIMIT $curRow, $maxRows";
					else
						$sqlS = "SELECT A.* FROM sl_lv0001 A WHERE   (A.lv022 in ('QLKL','TVGS','TT','ME','NT') ".$this->GetConditionSearch().") or (A.lv022 in ('TT','ME','NT')  ".$this->GetCondition11().")  or ( 1=1 ".$this->GetCondition().") $strSort LIMIT $curRow, $maxRows";
					break;
			}
		}
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
				if($vField=='lv001')
				{
					$vStringNumber=' onfocus="if(this.value==\'\') this.value=document.getElementById(\'qxtlv013\').value;" ';
				}
				switch($this->ArrViewEnter[$vField])
				{			
					case 99:
						if($this->isPopupPlus==0) $this->isPopupPlus=1;
						$vstr='<ul style="width:100%" id="pop-nav'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="pop-nav'.$this->isPopupPlus.'" onMouseOver="ChangeName(this,'.$this->isPopupPlus.')" onKeyUp="ChangeName(this,'.$this->isPopupPlus.')"> <li class="menupopT">
									<input autocomplete="off" class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:30px" name="qxt'.$vField.'" id="qxt'.$vField.'" onKeyUp="LoadPopupParentTabIndex(event,this,\'qxt'.$vField.'\',\''.$this->Tables[$vField].'\',\'concat(lv002,@! @!,lv001)\')"  onKeyPress="return CheckKey(event,7)" tabindex="2" onblur="LoadSource(this.value)" value="'.$this->Values[$vField].'">
									<div id="lv_popup'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="lv_popup'.$this->isPopupPlus.'"> </div>						  
									</li>
								</ul>';
						$this->isPopupPlus++;
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 999:
						if($this->isPopupPlus==0) $this->isPopupPlus=1;
						$vstr='<ul style="width:100%" id="pop-nav'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="pop-nav'.$this->isPopupPlus.'" onMouseOver="ChangeName(this,'.$this->isPopupPlus.')" onKeyUp="ChangeName(this,'.$this->isPopupPlus.')"> <li class="menupopT">
									<input autocomplete="off" class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:30px" name="qxt'.$vField.'" id="qxt'.$vField.'" onKeyUp="LoadSelfNextParent(this,\'qxt'.$vField.'\',\''.$this->Tables[$vField].'\',\''.$this->TableLinkReturn[$vField].'\',\''.$this->TableLink[$vField].'\')"  onKeyPress="return CheckKey(event,7)" tabindex="2" value="'.$this->Values[$vField].'" onblur="if(this.value.substr(this.value.length-1,this.value.length)==\',\') {this.value=this.value.substr(0,this.value.length-1);};">
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
					case 2:
						$vstr='<input autocomplete="off" class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'" type="text" id="qxt'.$vField.'" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:100%;min-width:60px" onKeyPress="return CheckKey(event,7)" ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;">';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 33:
						$vstr='<input autocomplete="off" class="txtenterquick" name="qxt'.$vField.'" type="checkbox" id="qxt'.$vField.'" value="1" '.(($this->Values[$vField]==1)?'checked="true"':'').' tabindex="2" style="width:100%;min-width:30px;text-align:center;" onKeyPress="return CheckKey(event,7)">';
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
		$vTotalDauKy=0;				
		$vTotalBH=0;
		$vTotalPT=0;
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$vFlagMoney=true;
			$vFlagContract=true;
			if($vrow['lv025']==$this->LV_UserID)
			{
				$ArrView=$this->ArrView;
			}
			else
			{
				switch($this->isQuyenNV)
				{
					case 2:
						$ArrView=$this->ArrView;
						break;
					default:
						$ArrView=$this->ArrViewSecu;	
						break;
				}
			}
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv199':
						$vChucNang="<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
						<tr>
						";
							$vChucNang=$vChucNang.'<td><span onclick="ProcessTextHidenMore(this)"><a href="javascript:FunctRunning1(\''.$vrow['lv001'].'\')"><img style="cursor:pointer;width:25px;;padding:5px;"  alt="NoImg" src="../images/icon/work_experience.png" align="middle" border="0" name="new" class="lviconimg"></a></span></td>';
						if($this->GetEdit()==1)
						{
							/*$vChucNang=$vChucNang.'
							<td><img Title="'.(($vrow['lv027']==0)?'Edit':'View').'" style="cursor:pointer;width:25px;padding:5px;" onclick="Edit(\''.($vrow['lv001']).'\')" alt="NoImg" src="../images/icon/'.(($vrow['lv027']==0)?'Edt.png':'detail.png').'" align="middle" border="0" name="new" class="lviconimg"></td>
							';*/
							$vChucNang=$vChucNang.'
							<td><img Title="Edit" style="cursor:pointer;width:25px;padding:5px;" onclick="Edit(\''.($vrow['lv001']).'\')" alt="NoImg" src="../images/icon/Edt.png" align="middle" border="0" name="new" class="lviconimg"></td>
							';
						}
						$vChucNang=$vChucNang."</tr></table>";
						$vStr='	
						';
						$vChucNang=$vStr.$vChucNang;
						$vTemp=str_replace("@02",$vChucNang,$this->Align($lvTd,(int)$ArrView[$lstArr[$i]]));						
						break;						
					/*case 'lv100':
						$vStr1='
						<div style="cursor:pointer;color:blue;" onclick="showDetailHD(\'chitietid_'.$vrow['lv001'].'\',\''.$vrow['lv001'].'\')">'.'<img style="cursor:pointer;width:25px;;padding:5px;"  alt="NoImg" src="../images/icon/job.png" title="Xem Chi tiết hợp đồng"/>'.'</div>
						<div style="display:none;position:absolute;z-index:999999999999;background:#efefef;" id="chitietid_'.$vrow['lv001'].'" class="noidung_member">					
							<div class="hd_cafe" style="width:100%">
								<ul class="qlycafe" style="width:100%">
									<li style="padding:10px;"><img onclick="document.getElementById(\'chitietid_'.$vrow['lv001'].'\').style.display=\'none\';" width="20" src="images/icon/close.png"/></li>
									<li style="padding:10px;"><div style="width:100%;padding-top:2px;">
									<strong>CHI TIẾT HỢP ĐỒNG KHÁCH HÀNG:'.$vrow['lv002'].']</strong></div>
									</li>
								</ul>
							</div>
							<div id="chitietnoidung_'.$vrow['lv001'].'" style="min-width:360px;overflow:hidden;"></div>
							<div width="100%;height:40px;">
								<center>
									<div style="width:160px;border-radius:5px;cursor:pointer;height:30px;padding-top:10px;" onclick="document.getElementById(\'chitietid_'.$vrow['lv001'].'\').style.display=\'none\';">ĐÓNG LẠI</div>
								</center>
							</div>
						</div>	
						';
						$vChucNang=$vStr1;
						$vTemp=str_replace("@02",$vChucNang,$this->Align($lvTd,(int)$ArrView[$lstArr[$i]]));	
						break;*/
					case 'lv023':
						if($this->GetEdit()==1)
						{													
							$lvTdTextBox="<td align=center><input class='txtenterquick' type=\"checkbox\" value=\"1\" ".(($vrow['lv003']==1)?'checked="true"':'')." @03 onclick=\"UpdateTextCheck(this,'".$vrow['lv001']."',3)\" style=\"width:35px;text-align:center;\" tabindex=\"2\" maxlength=\"32\"   onKeyPress=\"return CheckKey(event,7)\"/></td>";
							$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],0),$this->Align(str_replace("@01",$vrow['lv001'],$lvTdTextBox),(int)$ArrView[$lstArr[$i]]));	
						}
						else
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$ArrView[$lstArr[$i]]));
						break;
					case 'lv022':
						$vlv022=$vrow['lv022'];
						$lvTdTextBox=$this->LV_GetGroupCustomer($vlv022);
						$vTemp=str_replace("@02",str_replace("@02",$lvTdTextBox,str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$ArrView[$lstArr[$i]]));
						//$vTemp=str_replace("@02",str_replace("@02",$lvTdTextBox,str_replace("@01",$vrow['lv001'] ,$lvHReal)),$this->Align($lvTd,(int)$ArrView[$lstArr[$i]]));		
						break;
					default:
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$ArrView[$lstArr[$i]]));
						break;
				}
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strF=$strF."</tr>";
		$lvTable=str_replace("@#02",$strF,$lvTable);
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
			window.open('sl_lv0001/?lang=".$this->lang."&func='+value,'','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
	function LV_BuilPopup($lvList,$vArrCot,$bResult,$objid,$objvalue,&$vLayVe='')
	{
		$vLayVe='';
		if($lvList!='lv001,lv002')
		{
			//$vLayVe=$this->LV_LoadAddObject($lvList,$objid,$objvalue);
			return $this->LV_BuilPopupAdd($lvList,$vArrCot,$bResult,$objid,$objvalue);
		}
		$lstArr=explode(",",$lvList);
		if($this->lang=='EN')
			$lvTrH="<tr class=\"lvhtable\"><td width=1% class=\"lvhtable\">No</td>@#01</tr>";
		else
			$lvTrH="<tr class=\"lvhtable\"><td width=1% class=\"lvhtable\">STT</td>@#01</tr>";
		$lvTr="<tr class=\"lvlinehtable@01\"><td>@03</td>@#01</tr>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTdAdd="<td align=left>@02</td>";
		$lvTd="<td align=left><a href=\"javascript:PopupSelect('@01','$objid')\">@02</a></td>";
		$lvTdNo="<td align=left nowrap><a href=\"javascript:PopupSelect('@01','$objid')\">@02</a></td>";
		$vStrReturnFeild='';
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				$vField=trim($lstArr[$i]);
				$vStrReturnFeild=$vStrReturnFeild.'+"&qxt'.$vField.'="+'."ConverStrScript(document.frmchoose.qxt$vField.value)";
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
									<input autocomplete="off" class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:30px" name="qxt'.$vField.'" id="qxt'.$vField.'" onKeyUp="LoadPopupParentTabIndex(event,this,\'qxt'.$vField.'\',\''.$this->Tables[$vField].'\',\'concat(lv002,@! @!,lv001)\')"  onKeyPress="return CheckKey(event,7)" tabindex="2" onblur="LoadSource(this.value)" value="'.$this->Values[$vField].'">
									<div id="lv_popup'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="lv_popup'.$this->isPopupPlus.'"> </div>						  
									</li>
								</ul>';
						$this->isPopupPlus++;
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 999:
						if($this->isPopupPlus==0) $this->isPopupPlus=1;
						$vstr='<ul style="width:100%" id="pop-nav'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="pop-nav'.$this->isPopupPlus.'" onMouseOver="ChangeName(this,'.$this->isPopupPlus.')" onKeyUp="ChangeName(this,'.$this->isPopupPlus.')"> <li class="menupopT">
									<input autocomplete="off" class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:30px" name="qxt'.$vField.'" id="qxt'.$vField.'" onKeyUp="LoadSelfNextParent(this,\'qxt'.$vField.'\',\''.$this->Tables[$vField].'\',\''.$this->TableLinkReturn[$vField].'\',\''.$this->TableLink[$vField].'\')"  onKeyPress="return CheckKey(event,7)" tabindex="2" value="'.$this->Values[$vField].'" onblur="if(this.value.substr(this.value.length-1,this.value.length)==\',\') {this.value=this.value.substr(0,this.value.length-1);};">
									<div id="lv_popup'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="lv_popup'.$this->isPopupPlus.'"> </div>						  
									</li>
								</ul>';
						$this->isPopupPlus++;
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 88:
						$vstr='<select class="selenterquick" name="qxt'.$vField.'" id="qxt'.$vField.'" tabindex="2" style="width:100%;min-width:30px" onKeyPress="return CheckKey(event,7)">'.$this->LV_LinkField($vField,$this->Values[$vField]).'</select>';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 89:
							$vstr='<select class="selenterquick" name="qxt'.$vField.'" id="qxt'.$vField.'" tabindex="2" style="width:100%;min-width:30px" onKeyPress="return CheckKey(event,7)">
								<option value="">...</option>
							'.$this->LV_LinkField($vField,$this->Values[$vField]).'</select>';
							$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
							break;
					case 4:
						$vstr='<table><tr><td><input autocomplete="off" class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'_1" type="text" id="qxt'.$vField.'_1" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:100%;min-width:80px" onKeyPress="return CheckKey(event,7)" ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;"></td><td><input class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'_2" type="text" id="qxt'.$vField.'_2" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:50%;min-width:60px" onKeyPress="return CheckKey(event,7)" ></td></tr></table>';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 22:
					case 2:
						$vstr='<input autocomplete="off" class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'" type="text" id="qxt'.$vField.'" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:100%;min-width:60px" onKeyPress="return CheckKey(event,7)" ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;">';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 33:
						$vstr='<input autocomplete="off" class="txtenterquick" name="qxt'.$vField.'" type="checkbox" id="qxt'.$vField.'" value="1" '.(($this->Values[$vField]==1)?'checked="true"':'').' tabindex="2" style="width:100%;min-width:30px;text-align:center;" onKeyPress="return CheckKey(event,7)">';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 0:
						$vstr = '<input '.$vStringNumber.' autocomplete="off" class="txtenterquick" name="qxt'.$vField.'" type="text" id="qxt'.$vField.'" value="'.htmlspecialchars($this->Values[$vField] ?? '', ENT_QUOTES).'" tabindex="2" style="width:100%;min-width:30px;text-align:center;" onKeyPress="return CheckKey(event,7)">';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTempEnter="<td>&nbsp;</td>";
						break;
				}
				$strTrEnter=$strTrEnter.$vTempEnter;
				$strTrEnterEmpty=$strTrEnterEmpty."<td>&nbsp;</td>";
			}
		$vFunAddScript='
		';
		$vStrReturnFeild=str_replace(" ","",$vStrReturnFeild);
		$strTrEnter="<tr class='entermobil'><td>".'&nbsp;'."</td>".$strTrEnter."<td>".'&nbsp;'."</td></tr>";
		$strTrEnter='';
			$strTrH=str_replace("@#01",$strH,$lvTrH);
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vrow[$vArrCot[$lstArr[$i]]]=str_replace($objvalue,"<font color=\"#FF0000\">".$objvalue."</font>",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$vArrCot[$lstArr[$i]]],(int)$this->ArrView[$lstArr[$i]])));
				switch($lstArr[$i])
				{
					default:		
						$vTemp=str_replace("@02",$vrow[$vArrCot[$lstArr[$i]]],$this->Align(str_replace("@01",$vrow['lv001'],$lvTd),(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		
		return $strTrH.$strTrEnter.$strTr;
	}
	//Tạo ra một sự thêm từ popup liên kết
	function LV_LoadAddObject2($lvList,$objid,$objvalue)
	{
		
		$lstArr=explode(",",$lvList);
		if($this->lang=='EN')
			$lvTrH="<tr class=\"lvhtable\"><td width=1% class=\"lvhtable\">No</td>@#01</tr>";
		else
			$lvTrH="<tr class=\"lvhtable\"><td width=1% class=\"lvhtable\">STT</td>@#01</tr>";
		$lvTr="<tr class=\"lvlinehtable@01\">@#01</tr>";
		$lvTdH="<td width=\"@01\" align=\"left\">@02</td>";
		$lvTdAdd="<td align=left>@02</td>";
		$lvTd="<td align=left><a href=\"javascript:PopupSelect('@01','$objid')\">@02</a></td>";
		$lvTdNo="<td align=left nowrap><a href=\"javascript:PopupSelect('@01','$objid')\">@02</a></td>";
		$vStrReturnFeild='';
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				//$strH=$strH.$vTemp;
				$vField=trim($lstArr[$i]);
				$vStrReturnFeild=$vStrReturnFeild.'+"&qxt'.$vField.'="+'."ConverStrScript(document.frmchoose.qxt$vField.value)";
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
				$vTempEnter='';
				$vKeyExcepttion='';
				switch($vField)
				{
					case 'lv001':
						$vKeyExcepttion=' onkeypress="return CheckKeyValidCharID(event);" onblur="LoadSourceCusID(this);"';
						break;
					default:
						break;
				}
				switch($this->ArrViewEnter[$vField])
				{			
					case 99:
						if($this->isPopupPlus==0) $this->isPopupPlus=1;
						$vstr='<ul style="width:100%" id="pop-nav'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="pop-nav'.$this->isPopupPlus.'" onMouseOver="ChangeName(this,'.$this->isPopupPlus.')" onKeyUp="ChangeName(this,'.$this->isPopupPlus.')"> <li class="menupopT">
									<input autocomplete="off" class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:30px" name="qxt'.$vField.'" id="qxt'.$vField.'" onKeyUp="LoadPopupTabIndex(event,this,\'qxt'.$vField.'\',\''.$this->Tables[$vField].'\',\'concat(lv002,@! @!,lv001)\')"  '.$vKeyExcepttion.' tabindex="2" onblur="LoadSource(this.value)" value="'.$this->Values[$vField].'">
									<div id="lv_popup'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="lv_popup'.$this->isPopupPlus.'"> </div>						  
									</li>
								</ul>';
						$this->isPopupPlus++;
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 999:
						if($this->isPopupPlus==0) $this->isPopupPlus=1;
						$vstr='<ul style="width:100%" id="pop-nav'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="pop-nav'.$this->isPopupPlus.'" onMouseOver="ChangeName(this,'.$this->isPopupPlus.')" onKeyUp="ChangeName(this,'.$this->isPopupPlus.')"> <li class="menupopT">
									<input autocomplete="off" class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:30px" name="qxt'.$vField.'" id="qxt'.$vField.'" onKeyUp="LoadSelfNext(this,\'qxt'.$vField.'\',\''.$this->Tables[$vField].'\',\''.$this->TableLinkReturn[$vField].'\',\''.$this->TableLink[$vField].'\')"  '.$vKeyExcepttion.' tabindex="2" value="'.$this->Values[$vField].'" onblur="if(this.value.substr(this.value.length-1,this.value.length)==\',\') {this.value=this.value.substr(0,this.value.length-1);};">
									<div id="lv_popup'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="lv_popup'.$this->isPopupPlus.'"> </div>						  
									</li>
								</ul>';
						$this->isPopupPlus++;
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 88:
						$vstr='<select class="selenterquick" name="qxt'.$vField.'" id="qxt'.$vField.'" tabindex="2" style="width:100%;min-width:30px" '.$vKeyExcepttion.'>'.$this->LV_LinkField($vField,$this->Values[$vField]).'</select>';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 89:
							$vstr='<select class="selenterquick" name="qxt'.$vField.'" id="qxt'.$vField.'" tabindex="2" style="width:100%;min-width:30px" '.$vKeyExcepttion.'>
								<option value="">...</option>
							'.$this->LV_LinkField($vField,$this->Values[$vField]).'</select>';
							$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
							break;
					case 4:
						$vstr='<table><tr><td><input autocomplete="off" class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'_1" type="text" id="qxt'.$vField.'_1" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:50%;min-width:80px" '.$vKeyExcepttion.' ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;"></td><td><input class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'_2" type="text" id="qxt'.$vField.'_2" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:50%;min-width:60px" '.$vKeyExcepttion.' ></td></tr></table>';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 22:
					case 2:
						$vstr='<input autocomplete="off" class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'" type="text" id="qxt'.$vField.'" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:100%;min-width:60px" '.$vKeyExcepttion.' ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;">';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 33:
						$vstr='<input autocomplete="off" class="txtenterquick" name="qxt'.$vField.'" type="checkbox" id="qxt'.$vField.'" value="1" '.(($this->Values[$vField]==1)?'checked="true"':'').' tabindex="2" style="width:100%;min-width:30px;text-align:center;" '.$vKeyExcepttion.'>';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 0:
						$vstr='<input '.$vStringNumber.' autocomplete="off" class="txtenterquick" name="qxt'.$vField.'" type="text" id="qxt'.$vField.'" value="'.$this->Values[$vField].'" tabindex="2" style="width:100%;min-width:30px;text-align:center;" '.$vKeyExcepttion.'>';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTempEnter="<td>&nbsp;</td>";
						break;
				}
				$lvTr="<tr class=\"lvlinehtable".(($i%2))."\">$vTemp $vTempEnter </tr>";
				$strTrEnter=$strTrEnter.$lvTr;
			}
		$vFunAddScript='
		';
		$vStrReturnFeild=str_replace(" ","",$vStrReturnFeild);
		if($this->isAdd==1) 
			$strTrEnter="
			<tr  class=\"lvhtable\">
				<td  class=\"lvhtable\"  align=\"left\" height=\"40\">".'
				<table>
					<tr>
					<td style="cursor:pointer;color:red;"><span onclick=\"CustomerCreateID()\">Lưu Lại</span></td>
					<td>
					
							<img style="cursor:pointer;" tabindex="2" border="0" title="Add New Customer" class="imgButton" onclick="CustomerCreateID()"  src="../images/controlright/save_f2.png" onkeypress="return CheckKey(event,11)">
							
					</td>
					</tr>
				</table>
				'."</td>
				<td  class=\"lvhtable\" align=\"right\">".'
				<table>
						<tr><td>
							<ul id="pop-nav48" lang="pop-nav48" onmouseover="ChangeName(this,48)" onkeyup="ChangeName(this,48)"> 
								<li class="menupopT">
										<input type="text" autocomplete="off" class="search_img_btn" name="qxtlv001_search" id="qxtlv001_search" style="width:30px;" 
																	onkeyup="LoadSelfNextParentNewSreen2(this,\'qxtlv001\',\'sl_lv0001\',\'lv001\',\'lv001,lv002,lv010,lv015\',\'\',\'\',1)" 
																	onfocus="if(this.value==\'\'){this.value=document.frmchoose.qxtlv001.value};this.style.width=\'200px\';LoadSelfNextParentNewSreen2(this,\'qxtlv001\',\'sl_lv0001\',\'lv001\',\'lv001,lv002,lv010,lv015\',\'\',\'\',1));" onfocusout="this.style.width=\'30px\';" tabindex="200">
																	<div id="lv_popup48" lang="lv_popup48"> </div>						  
																	</li>
																</ul>
															
							</td>
							<td>
							<img style="cursor:pointer" tabindex="2" border="0" title="Close" class="imgButton" onclick="CloseKhachHang(\'AnHienKhachHangID\')" src="../images/icon/close.png" onkeypress="return CheckKey(event,11)">'."
						</td>
						</tr>
					</table>
				</td>
			</tr>
			".$strTrEnter."
			<tr  class=\"lvhtable\">
				<td  class=\"lvhtable\"  align=\"left\" height=\"40\">".'
				<table>
					<tr>
					<td style="cursor:pointer;color:white;"><span onclick=\"CustomerCreateID()\">Lưu Lại</span></td>
					<td>
					<img style="cursor:pointer;" tabindex="2" border="0" title="Add New Customer" class="imgButton"  onclick="CustomerCreateID()"  src="../images/controlright/save_f2.png" onkeypress="return CheckKey(event,11)">
					</td>
					</tr>
				</table>
				'."</td>
				<td  class=\"lvhtable\" align=\"right\">".'<img style="cursor:pointer" tabindex="2" border="0" title="Close" class="imgButton" onclick="CloseKhachHang(\'AnHienKhachHangID\')" src="../images/icon/close.png" onkeypress="return CheckKey(event,11)">'."</td>
			</tr>";
		else
			$strTrEnter="";
		return '<div id="CustomerCreateID"><table>'.$strTrEnter.'</table></div>';
	}
	//Tạo ra một sự thêm từ popup liên kết
	function LV_LoadAddObject($lvList,$objid,$objvalue)
	{
		
		$lstArr=explode(",",$lvList);
		if($this->lang=='EN')
			$lvTrH="<tr class=\"lvhtable\"><td width=1% class=\"lvhtable\">No</td>@#01</tr>";
		else
			$lvTrH="<tr class=\"lvhtable\"><td width=1% class=\"lvhtable\">STT</td>@#01</tr>";
		$lvTr="<tr class=\"lvlinehtable@01\">@#01</tr>";
		$lvTdH="<td width=\"@01\" align=\"left\">@02</td>";
		$lvTdAdd="<td align=left>@02</td>";
		$lvTd="<td align=left><a href=\"javascript:PopupSelect('@01','$objid')\">@02</a></td>";
		$lvTdNo="<td align=left nowrap><a href=\"javascript:PopupSelect('@01','$objid')\">@02</a></td>";
		$vStrReturnFeild='';
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				//$strH=$strH.$vTemp;
				$vField=trim($lstArr[$i]);
				$vStrReturnFeild=$vStrReturnFeild.'+"&qxt'.$vField.'="+'."ConverStrScript(document.frmchoose.qxt$vField.value)";
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
				$vTempEnter='';
				$vKeyExcepttion='';
				switch($vField)
				{
					case 'lv001':
						$vKeyExcepttion=' onkeypress="return CheckKeyValidCharID(event);" onblur="LoadSourceCusID(this);"';
						break;
					default:
						break;
				}
				switch($this->ArrViewEnter[$vField])
				{			
					case 99:
						if($this->isPopupPlus==0) $this->isPopupPlus=1;
						$vstr='<ul style="width:100%" id="pop-nav'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="pop-nav'.$this->isPopupPlus.'" onMouseOver="ChangeName(this,'.$this->isPopupPlus.')" onKeyUp="ChangeName(this,'.$this->isPopupPlus.')"> <li class="menupopT">
									<input autocomplete="off" class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:30px" name="qxt'.$vField.'" id="qxt'.$vField.'" onKeyUp="LoadPopupParentTabIndex(event,this,\'qxt'.$vField.'\',\''.$this->Tables[$vField].'\',\'concat(lv002,@! @!,lv001)\')"  '.$vKeyExcepttion.' tabindex="2" onblur="LoadSource(this.value)" value="'.$this->Values[$vField].'">
									<div id="lv_popup'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="lv_popup'.$this->isPopupPlus.'"> </div>						  
									</li>
								</ul>';
						$this->isPopupPlus++;
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 999:
						if($this->isPopupPlus==0) $this->isPopupPlus=1;
						$vstr='<ul style="width:100%" id="pop-nav'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="pop-nav'.$this->isPopupPlus.'" onMouseOver="ChangeName(this,'.$this->isPopupPlus.')" onKeyUp="ChangeName(this,'.$this->isPopupPlus.')"> <li class="menupopT">
									<input autocomplete="off" class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:30px" name="qxt'.$vField.'" id="qxt'.$vField.'" onKeyUp="LoadSelfNextParent(this,\'qxt'.$vField.'\',\''.$this->Tables[$vField].'\',\''.$this->TableLinkReturn[$vField].'\',\''.$this->TableLink[$vField].'\')"  '.$vKeyExcepttion.' tabindex="2" value="'.$this->Values[$vField].'" onblur="if(this.value.substr(this.value.length-1,this.value.length)==\',\') {this.value=this.value.substr(0,this.value.length-1);};">
									<div id="lv_popup'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="lv_popup'.$this->isPopupPlus.'"> </div>						  
									</li>
								</ul>';
						$this->isPopupPlus++;
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 88:
						$vstr='<select class="selenterquick" name="qxt'.$vField.'" id="qxt'.$vField.'" tabindex="2" style="width:100%;min-width:30px" '.$vKeyExcepttion.'>'.$this->LV_LinkField($vField,$this->Values[$vField]).'</select>';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 89:
							$vstr='<select class="selenterquick" name="qxt'.$vField.'" id="qxt'.$vField.'" tabindex="2" style="width:100%;min-width:30px" '.$vKeyExcepttion.'>
								<option value="">...</option>
							'.$this->LV_LinkField($vField,$this->Values[$vField]).'</select>';
							$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
							break;
					case 4:
						$vstr='<table><tr><td><input autocomplete="off" class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'_1" type="text" id="qxt'.$vField.'_1" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:50%;min-width:80px" '.$vKeyExcepttion.' ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;"></td><td><input class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'_2" type="text" id="qxt'.$vField.'_2" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:50%;min-width:60px" '.$vKeyExcepttion.' ></td></tr></table>';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 22:
					case 2:
						$vstr='<input autocomplete="off" class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'" type="text" id="qxt'.$vField.'" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:100%;min-width:60px" '.$vKeyExcepttion.' ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;">';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 33:
						$vstr='<input autocomplete="off" class="txtenterquick" name="qxt'.$vField.'" type="checkbox" id="qxt'.$vField.'" value="1" '.(($this->Values[$vField]==1)?'checked="true"':'').' tabindex="2" style="width:100%;min-width:30px;text-align:center;" '.$vKeyExcepttion.'>';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 0:
						$vstr='<input '.$vStringNumber.' autocomplete="off" class="txtenterquick" name="qxt'.$vField.'" type="text" id="qxt'.$vField.'" value="'.$this->Values[$vField].'" tabindex="2" style="width:100%;min-width:30px;text-align:center;" '.$vKeyExcepttion.'>';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTempEnter="<td>&nbsp;</td>";
						break;
				}
				$lvTr="<tr class=\"lvlinehtable".(($i%2))."\">$vTemp $vTempEnter </tr>";
				$strTrEnter=$strTrEnter.$lvTr;
			}
		$vFunAddScript='
		';
		$vStrReturnFeild=str_replace(" ","",$vStrReturnFeild);
		if($this->isAdd==1) 
			$strTrEnter="
			<tr  class=\"lvhtable\">
				<td  class=\"lvhtable\"  align=\"left\" height=\"40\">".'
				<table>
					<tr>
					<td style="cursor:pointer;color:red;"><span onclick=\"CustomerCreateID()\">Lưu Lại</span></td>
					<td>
					
							<img style="cursor:pointer;" tabindex="2" border="0" title="Add New Customer" class="imgButton" onclick="CustomerCreateID()"  src="../images/controlright/save_f2.png" onkeypress="return CheckKey(event,11)">
							
					</td>
					</tr>
				</table>
				'."</td>
				<td  class=\"lvhtable\" align=\"right\">".'
				<table>
						<tr><td>
							<ul id="pop-nav48" lang="pop-nav48" onmouseover="ChangeName(this,48)" onkeyup="ChangeName(this,48)"> 
								<li class="menupopT">
										<input type="text" autocomplete="off" class="search_img_btn" name="qxtlv001_search" id="qxtlv001_search" style="width:30px;" 
																	onkeyup="LoadSelfNextParentNewSreen(this,\'qxtlv001\',\'sl_lv0001\',\'lv001\',\'lv001,lv002,lv010,lv015\',\'\',\'\',1)" 
																	onfocus="if(this.value==\'\'){this.value=document.frmchoose.qxtlv001.value};this.style.width=\'200px\';LoadSelfNextParentNewSreen(this,\'qxtlv001\',\'sl_lv0001\',\'lv001\',\'lv001,lv002,lv010,lv015\',\'\',\'\',1));" onfocusout="this.style.width=\'30px\';" tabindex="200">
																	<div id="lv_popup48" lang="lv_popup48"> </div>						  
																	</li>
																</ul>
															
							</td>
							<td>
							<img style="cursor:pointer" tabindex="2" border="0" title="Close" class="imgButton" onclick="CloseKhachHang(\'AnHienKhachHangID\')" src="../images/icon/close.png" onkeypress="return CheckKey(event,11)">'."
						</td>
						</tr>
					</table>
				</td>
			</tr>
			".$strTrEnter."
			<tr  class=\"lvhtable\">
				<td  class=\"lvhtable\"  align=\"left\" height=\"40\">".'
				<table>
					<tr>
					<td style="cursor:pointer;color:white;"><span onclick=\"CustomerCreateID()\">Lưu Lại</span></td>
					<td>
					<img style="cursor:pointer;" tabindex="2" border="0" title="Add New Customer" class="imgButton"  onclick="CustomerCreateID()"  src="../images/controlright/save_f2.png" onkeypress="return CheckKey(event,11)">
					</td>
					</tr>
				</table>
				'."</td>
				<td  class=\"lvhtable\" align=\"right\">".'<img style="cursor:pointer" tabindex="2" border="0" title="Close" class="imgButton" onclick="CloseKhachHang(\'AnHienKhachHangID\')" src="../images/icon/close.png" onkeypress="return CheckKey(event,11)">'."</td>
			</tr>";
		else
			$strTrEnter="";
		return '<div id="CustomerCreateID"><table>'.$strTrEnter.'</table></div>';
	}
	//
	function LV_BuilPopupAdd($lvList,$vArrCot,$bResult,$objid,$objvalue)
	{
		
		$lstArr=explode(",",$lvList);
		if($this->lang=='EN')
			$lvTrH="<tr class=\"lvhtable\"><td width=1% class=\"lvhtable\">No</td>@#01</tr>";
		else
			$lvTrH="<tr class=\"lvhtable\"><td width=1% class=\"lvhtable\">STT</td>@#01</tr>";
		$lvTr="<tr class=\"lvlinehtable@01\"><td>@03</td>@#01</tr>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTdAdd="<td align=left>@02</td>";
		$lvTd="<td align=left><a href=\"javascript:PopupSelect('@01','$objid')\">@02</a></td>";
		$lvTdNo="<td align=left nowrap><a href=\"javascript:PopupSelect('@01','$objid')\">@02</a></td>";
		$vStrReturnFeild='';
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				$vField=trim($lstArr[$i]);
				$vStrReturnFeild=$vStrReturnFeild.'+"&qxt'.$vField.'="+'."ConverStrScript(document.frmchoose.qxt$vField.value)";
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
									<input autocomplete="off" class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:30px" name="qxt'.$vField.'" id="qxt'.$vField.'" onKeyUp="LoadPopupParentTabIndex(event,this,\'qxt'.$vField.'\',\''.$this->Tables[$vField].'\',\'concat(lv002,@! @!,lv001)\')"  onKeyPress="return CheckKey(event,7)" tabindex="2" onblur="LoadSource(this.value)" value="'.$this->Values[$vField].'">
									<div id="lv_popup'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="lv_popup'.$this->isPopupPlus.'"> </div>						  
									</li>
								</ul>';
						$this->isPopupPlus++;
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 999:
						if($this->isPopupPlus==0) $this->isPopupPlus=1;
						$vstr='<ul style="width:100%" id="pop-nav'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="pop-nav'.$this->isPopupPlus.'" onMouseOver="ChangeName(this,'.$this->isPopupPlus.')" onKeyUp="ChangeName(this,'.$this->isPopupPlus.')"> <li class="menupopT">
									<input autocomplete="off" class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:30px" name="qxt'.$vField.'" id="qxt'.$vField.'" onKeyUp="LoadSelfNextParent(this,\'qxt'.$vField.'\',\''.$this->Tables[$vField].'\',\''.$this->TableLinkReturn[$vField].'\',\''.$this->TableLink[$vField].'\')"  onKeyPress="return CheckKey(event,7)" tabindex="2" value="'.$this->Values[$vField].'" onblur="if(this.value.substr(this.value.length-1,this.value.length)==\',\') {this.value=this.value.substr(0,this.value.length-1);};">
									<div id="lv_popup'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="lv_popup'.$this->isPopupPlus.'"> </div>						  
									</li>
								</ul>';
						$this->isPopupPlus++;
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 88:
						$vstr='<select class="selenterquick" name="qxt'.$vField.'" id="qxt'.$vField.'" tabindex="2" style="width:100%;min-width:30px" onKeyPress="return CheckKey(event,7)">'.$this->LV_LinkField($vField,$this->Values[$vField]).'</select>';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 89:
							$vstr='<select class="selenterquick" name="qxt'.$vField.'" id="qxt'.$vField.'" tabindex="2" style="width:100%;min-width:30px" onKeyPress="return CheckKey(event,7)">
								<option value="">...</option>
							'.$this->LV_LinkField($vField,$this->Values[$vField]).'</select>';
							$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
							break;
					case 4:
						$vstr='<table><tr><td><input autocomplete="off" class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'_1" type="text" id="qxt'.$vField.'_1" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:100%;min-width:80px" onKeyPress="return CheckKey(event,7)" ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;"></td><td><input class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'_2" type="text" id="qxt'.$vField.'_2" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:50%;min-width:60px" onKeyPress="return CheckKey(event,7)" ></td></tr></table>';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 22:
					case 2:
						$vstr='<input autocomplete="off" class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'" type="text" id="qxt'.$vField.'" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:100%;min-width:60px" onKeyPress="return CheckKey(event,7)" ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;">';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 33:
						$vstr='<input autocomplete="off" class="txtenterquick" name="qxt'.$vField.'" type="checkbox" id="qxt'.$vField.'" value="1" '.(($this->Values[$vField]==1)?'checked="true"':'').' tabindex="2" style="width:100%;min-width:30px;text-align:center;" onKeyPress="return CheckKey(event,7)">';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 0:
						$vstr = '<input '.$vStringNumber.' autocomplete="off" class="txtenterquick" name="qxt'.$vField.'" type="text" id="qxt'.$vField.'" value="'.htmlspecialchars($this->Values[$vField] ?? '', ENT_QUOTES).'" tabindex="2" style="width:100%;min-width:30px;text-align:center;" onKeyPress="return CheckKey(event,7)">';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTdAdd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTempEnter="<td>&nbsp;</td>";
						break;
				}
				$strTrEnter=$strTrEnter.$vTempEnter;
				$strTrEnterEmpty=$strTrEnterEmpty."<td>&nbsp;</td>";
			}
		$vFunAddScript='
		';
		$vStrReturnFeild=str_replace(" ","",$vStrReturnFeild);
		$strTrEnter='';
		/*if($this->isAdd==1) 
			$strTrEnter="<tr class='entermobil'><td>".'<img tabindex="2" border="0" title="Add" class="imgButton" onclick=\'$xmlhttp99=null;xmlhttp99=GetXmlHttpObject();var url=document.location;url=url+"?&add_sl_lv0001=ajaxcheck"'.$vStrReturnFeild.';url=url.replace("#","");xmlhttp99.onreadystatechange=satecustomerslist;xmlhttp99.open("GET",url,true);xmlhttp99.send(null);\' onmouseout="this.src=\'../images/iconcontrol/btn_add.jpg\';" onmouseover="this.src=\'../images/iconcontrol/btn_add_02.jpg\';" src="../images/iconcontrol/btn_add.jpg" onkeypress="return CheckKey(event,11)">'."</td>".$strTrEnter."<td>".'<img tabindex="2" border="0" title="Add" class="imgButton" onclick=\'$xmlhttp99=null;xmlhttp99=GetXmlHttpObject();var url=document.location;url=url+"?&add_sl_lv0001=ajaxcheck"'.$vStrReturnFeild.';url=url.replace("#","");xmlhttp99.onreadystatechange=satecustomerslist;xmlhttp99.open("GET",url,true);xmlhttp99.send(null);\' onmouseout="this.src=\'../images/iconcontrol/btn_add.jpg\';" onmouseover="this.src=\'../images/iconcontrol/btn_add_02.jpg\';" src="../images/iconcontrol/btn_add.jpg" onkeypress="return CheckKey(event,11)">'."</td></tr>";
		else
			$strTrEnter="<tr class='entermobil'><td>".'&nbsp;'."</td>".$strTrEnter."<td>".'&nbsp;'."</td></tr>";
			*/
			$strTrH=str_replace("@#01",$strH,$lvTrH);
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vrow[$vArrCot[$lstArr[$i]]]=str_replace($objvalue,"<font color=\"#FF0000\">".$objvalue."</font>",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$vArrCot[$lstArr[$i]]],(int)$this->ArrView[$lstArr[$i]])));
				switch($lstArr[$i])
				{
					default:		
						$vTemp=str_replace("@02",$vrow[$vArrCot[$lstArr[$i]]],$this->Align(str_replace("@01",$vrow['lv001'],$lvTd),(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		return $strTrH.$strTrEnter.$strTr;
	}
	function LV_BuilListReport($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		return;	
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
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT A.*,B.lv003 lv803,B.lv004 lv804,B.lv005 lv805,B.lv007 lv807 FROM sl_lv0001 A left join sl_lv0299 B on A.lv001=B.lv002WHERE (A.lv022 in ('TT','ME','NT')  ".$this->GetCondition11().")  or ( 1=1 ".$this->GetCondition().") and ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
				if($lstArr[$i]=="lv026")
				{
					
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GetContractMoney($vrow['lv001']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
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
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0023";
				break;
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014";
				break;
			case 'lv018':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014";
				break;
			case 'lv022':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0034";
				break;
			case 'lv023':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0035";
				break;
			case 'lv130':
				if($this->isQuyenNV==2)
					$vsql="select lv001,lv003 lv002,IF(lv003='$vSelectID',1,0) lv003 from  sl_lv0299 where lv002='$this->ContractorID'  order by lv009 desc";
				else
					$vsql="select lv001,lv003 lv002,IF(lv003='$vSelectID',1,0) lv003 from  sl_lv0299 where lv002='$this->ContractorID' and lv011='$this->LV_UserID' order by lv009 desc";
				break;	
		}
		return $vsql;
	}
	private function getvaluelink($vFile,$vSelectID)
	{
		if (!empty($this->ArrGetValueLink[$vFile][$vSelectID][0] ?? null)) {return $this->ArrGetValueLink[$vFile][$vSelectID][1] ?? null;}
		if($vSelectID=="")
		{
			return $vSelectID;
		}
		switch($vFile)
		{
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0023 where lv001='$vSelectID'";
				break;
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014 where lv001='$vSelectID'";
				break;
			case 'lv018':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014 where lv001='$vSelectID'";
				break;
			case 'lv022':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0034 where lv001='$vSelectID'";
				break;
			case 'lv023':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0035 where lv001='$vSelectID'";
				break;
			case 'lv025':
				$lvopt=0;
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
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