<?php
/////////////coding ts_lv0009///////////////
class   ts_lv0009 extends lv_controler
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

///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv088,lv004,lv005,lv006,lv007,lv008,lv009,lv011,lv013,lv014,lv015,lv016,lv017";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='ts_lv0009';
	public $objlot=null;
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv088"=>'89',"lv099"=>"100");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"20","lv005"=>"21","lv006"=>"2","lv007"=>"0","lv008"=>"10","lv009"=>"21","lv010"=>"10","lv011"=>"2","lv012"=>"0","lv013"=>"10","lv014"=>"0","lv015"=>"0","lv016"=>"22","lv017"=>"10","lv088"=>'0',"lv099"=>"100");	

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
		$lvsql="select lv007 from ts_lv0008 B where  B.lv001='$this->lv002'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if (!empty($vrow['lv007']) && $vrow['lv007'] >= 1) 
			{
				$this->isAdd=0;	
				$this->isEdit=0;	
				$this->isDel=0;	
			}
		}
		
	}
	function LV_Load()
	{
		$vsql="select * from  ts_lv0009";
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
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  ts_lv0009 Where lv001='$vlv001'";
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
		}
	}
	function LV_InsertAuto()
	{
		if($this->isAdd==0) return false;
		//if(!$this->LV_CheckLocked($this->lv002)) return false;
		//$this->lv015 = ($this->lv015!="")?recoverdate(($this->lv015), $this->lang):$this->DateDefault;
		//$this->lv011 = ($this->lv011!="")?recoverdate(($this->lv011), $this->lang):$this->DateDefault;
		$lvsql="insert into ts_lv0009 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv098,lv099) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005',now(),'$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv098','$this->lv099')";
		$vReturn= db_query($lvsql);
		if($vReturn){
			$this->InsertLogOperation($this->DateCurrent,'ts_lv0009.insert',sof_escape_string($lvsql));
			$vWHID=$this->GetParentWH($this->lv002);
			$vWhId=$vWHID;
			$this->AddLotReciept($this->lv014,$this->lv003,$vWhId,$this->lv006,$this->lv008,$this->lv019,$this->lv015,$this->lv011);
			$this->CheckChild($this->lv003,$vWHID);
			$tsql="Update ts_lv0012 set lv004=lv004+$this->lv004,lv006=lv006+$this->lv006 where lv002='$this->lv003' and lv003 in (select C.lv002 from ts_lv0008 C where C.lv001='$this->lv002')";
			if(db_query($tsql)) 
			{	
				$this->InsertLogOperation($this->DateCurrent,'ts_lv0012.Update',sof_escape_string($tsql));
			}
		 	if($this->obj_wb_lv0006!=null)
		 	{
		 		$this->obj_wb_lv0006->LV_Update_Balance($this->lv003,$vWHID);
		 	}
		 }
		return $vReturn;
	}	
	function LV_Insert()
	{
		if($this->isAdd==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		//$this->lv015 = ($this->lv015!="")?recoverdate(($this->lv015), $this->lang):$this->DateDefault;
		$this->lv011 = ($this->lv011!="")?recoverdate(($this->lv011), $this->lang):$this->DateDefault;
		$this->lv006 = ($this->lv006!="")?recoverdate(($this->lv006), $this->lang):$this->DateDefault;
		$lvsql="insert into ts_lv0009 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv098,lv099) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv098','$this->lv099')";
		$vReturn= db_query($lvsql);
		if($vReturn){
			$this->InsertLogOperation($this->DateCurrent,'ts_lv0009.insert',sof_escape_string($lvsql));
			$vWHID=$this->GetParentWH($this->lv002);
			$vWhId=$vWHID;
			$this->AddLotReciept($this->lv014,$this->lv003,$vWhId,$this->lv006,$this->lv008,$this->lv019,$this->lv015,$this->lv011);
			$this->CheckChild($this->lv003,$vWHID);
			$tsql="Update ts_lv0012 set lv004=lv004+$this->lv004,lv006=lv006+$this->lv006 where lv002='$this->lv003' and lv003 in (select C.lv002 from ts_lv0008 C where C.lv001='$this->lv002')";
			if(db_query($tsql)) 
			{	
				$this->InsertLogOperation($this->DateCurrent,'ts_lv0012.Update',sof_escape_string($tsql));
			}
		 	if($this->obj_wb_lv0006!=null)
		 	{
		 		$this->obj_wb_lv0006->LV_Update_Balance($this->lv003,$vWHID);
		 	}
		 }
		return $vReturn;
	}	
	function LV_InsertTemp($vTemID,$vlv002,$vWhId)
	{
		$lvsql="select '$vTemID' lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv098,lv099 from ts_lv0030 where lv002='$vlv002' and lv004<>0";
		$vReturn= db_query($lvsql);
		while($vrow=db_fetch_array($vReturn))
		{
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$this->FormatView($vrow['lv006'],2);
			$this->lv007=$vrow['lv007'];
			$this->lv008=$vrow['lv008'];
			$this->lv009=$vrow['lv009'];
			$this->lv010=$vrow['lv010'];
			$this->lv011=$this->FormatView($vrow['lv011'],2);
			$this->lv012=$vrow['lv012'];
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
			$this->lv015=$vrow['lv015'];
			$this->lv016=$vrow['lv016'];
			if(strpos($this->lv015,"-")===false)
			{
			$this->lv017=$vrow['lv017'];
			$this->lv018=$vrow['lv018'];
			}
			else
			{
				$arlv015=explode("-",$this->lv015,2);
				$this->lv017=$arlv015[1];
				$this->lv018=$arlv015[0];
			}			
			$this->lv019=$vrow['lv019'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->LV_Insert();
			$this->AddLotReciept($this->lv014,$this->lv003,$vWhId,$this->lv006,$this->lv008,$this->lv019,$this->lv015,$this->lv011);
		}
		if($vReturn) 
		{	$this->LV_InsertOutStock($vlv002);
			$this->LV_DeleteTemp($vlv002);
		}
		return $vReturn;
	}
	function LV_InsertTempSLChild($vInvoiceID,$vTemID,$vQty)
	{
		$lvsql="select '$vInvoiceID' lv002,A.lv003,A.lv004*$vQty lv004,A.lv005 lv005,'' lv006,'' lv007,B.lv007 lv008,B.lv008 lv009,'' lv010,'' lv011,concat(CURDATE(),' ',CURTIME()) lv016,B.lv016 WHID from mn_lv0004 A inner join sl_lv0007 B on A.lv003=B.lv001  where A.lv002='$vTemID'";
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
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
			$this->WHID=$vrow['WHID'];
			if($this->lv004>0)
			{
					$this->LV_Insert();
			}
		}
	}
	function LV_InsertTempSL($vInvoiceID,$vlv002,$vWarehourID)
	{
		$lvsql="select '$vInvoiceID' lv002,A.lv003,A.lv004,B.lv004 lv005,'' lv006,'' lv007,A.lv006 lv008,A.lv007 lv009,A.lv008 lv010,'' lv011,concat(CURDATE(),' ',CURTIME()) lv016,B.lv016 WHID from sl_lv0014 A inner join sl_lv0007 B on A.lv003=B.lv001  where A.lv002='$vlv002'";
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
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
			$this->WHID=$vrow['WHID'];
			if($this->lv004>0)
			{
					$this->LV_Insert();
					//$this->LV_InsertTempSLChild($vInvoiceID,$this->lv003,$this->lv004);
			}
		}
		return $vReturn;
	}
	function AddLotReciept($lvLotId,$lvItemId,$lvWhId,$lvColor,$lvSize,$lvTypeSize,$lvNote,$lvExpireDate)
	{
		if($this->CheckLot($lvLotId,$lvItemId,$lvWhId)<=0)
		{
		$lvsql="insert into ts_lv0020 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008) values('$lvLotId','$lvItemId','$lvWhId','$lvExpireDate','$lvColor','$lvSize',concat(CURRENT_DATE(),' ',CURRENT_TIME()),'$lvNote')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ts_lv0020.insert',sof_escape_string($lvsql));
		}
	}
	function CheckLot($lvLotId,$lvItemId,$lvWhId)
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM ts_lv0020 WHERE lv001='$lvLotId' and lv002='$lvItemId' and lv003='$lvWhId'";
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_InsertOutStockNoCondition($vlv002)
	{
		$lvsql="insert into ts_lv0031 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016) select '".getInfor($_SESSION['ERPSOFV2RUserID'],2)."',lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv012,'',lv013,lv014,lv015,lv016 from ts_lv0009 where lv002='$vlv002'";
		$vReturn= db_query($lvsql);
		return $vReturn;
	}
	function LV_InsertOutStock($vlv002)
	{
		$lvsql="insert into ts_lv0031 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016) select lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv012,'',lv013,lv014,lv015,lv016 from ts_lv0030 where lv013=1 and lv002='$vlv002'";
		$vReturn= db_query($lvsql);
		return $vReturn;
	}
	function LV_DeleteTemp($vlv002)
	{
		$lvsql = "DELETE FROM ts_lv0030  WHERE ts_lv0030.lv002='$vlv002'";
		$vReturn= db_query($lvsql);
		return $vReturn;
	}	
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		$this->lv011 = ($this->lv011!="")?recoverdate(($this->lv011), $this->lang):$this->DateDefault;
		$this->lv006 = ($this->lv006!="")?recoverdate(($this->lv006), $this->lang):$this->DateDefault;
		$lvsql="Update ts_lv0009 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ts_lv0009.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateEdit($vOldlv004,$vOldlv006)
	{
		$vOldlv004=(float)$vOldlv004;
		$vOldlv006=(float)$vOldlv006;
		if($this->isEdit==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		$this->lv011 = ($this->lv011!="")?recoverdate(($this->lv011), $this->lang):$this->DateDefault;
		$vlv003=$this->GetParentWH($this->lv002);
		  $lvsql="Update ts_lv0009 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn){
			$vsql1="update ts_lv0012 set lv004=lv004+($this->lv004-$vOldlv004),lv006=lv006+($this->lv006-$vOldlv006) where lv002='$this->lv0003' and lv003='$vlv003'";
			if(	db_query($vsql1))
			{
				$vWhId=$this->GetParentWH($this->lv002);
				$this->AddLotReciept($this->lv014,$this->lv003,$vWhId,$this->lv017,$this->lv018,$this->lv019,$this->lv015,$this->lv011);
				$this->InsertLogOperation($this->DateCurrent,'ts_lv0009.update',sof_escape_string($vsql1));
			}
		 $this->InsertLogOperation($this->DateCurrent,'ts_lv0009.update',sof_escape_string($lvsql));
			if($this->obj_wb_lv0006!=null)
			 	{
			 		$this->obj_wb_lv0006->LV_get_slt_lot($this->lv003,$vlv003);
			 	}
		 
		 }
		return $vReturn;
	}
	function LV_CheckLocked($vlv002)
	{
		$lvsql="select lv007 from  ts_lv0008 Where lv001='$vlv002'";
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
		$lvsql = "DELETE FROM ts_lv0009  WHERE ts_lv0009.lv001 IN ($lvarr) and (select lv007 from ts_lv0008 B where  B.lv001= ts_lv0009.lv002)<=0  ";
		$vReturn= db_query($lvsql);
		if($vReturn) {
			$this->InsertLogOperation($this->DateCurrent,'ts_lv0009.delete',sof_escape_string($lvsql));
		}
		return $vReturn;
	}	
	function LV_DeleteDetail($lvarr)
	{
		$sqlD = "SELECT A.lv001 lv001,A.lv002 lv002,A.lv003 lv003,A.lv004 lv004,A.lv006 lv006,B.lv002 lvb002 FROM ts_lv0009 A inner join ts_lv0008 B on A.lv002=B.lv001 WHERE A.lv001 IN ($lvarr) and (select lv007 from ts_lv0008 B where  B.lv001= A.lv002)<=0;";
		$vresult=db_query($sqlD);
		$strReturn=false;
		while($vrow=db_fetch_array($vresult))
		{
			
			 $vsql="update ts_lv0012 set lv004=lv004-".$vrow['lv004'].",lv006=lv006-".$vrow['lv006']." where lv002='".$vrow['lv003']."' and lv003='".$vrow['lvb002']."'";
			if(db_query($vsql))
			{
				$tsql="delete from ts_lv0009 where lv001='".$vrow['lv001']."'";
				if(db_query($tsql))
				{
					$strReturn= true;
					if($this->obj_wb_lv0006!=null)
				 	{
				 		$this->obj_wb_lv0006->LV_Update_Balance($vrow['lv003'],$vrow['lvb002']);
				 	}
				}
				else
				{
					$vsql="update ts_lv0012 set lv004=lv004+".$vrow['lv004'].",lv006=lv006+".$vrow['lv006']." where lv002='".$vrow['lv003']."' and lv003='".$vrow['lvb002']."'";
					db_query($vsql);
					$strReturn= false;
				}
				
			}	
			
		}
		return $strReturn;
	}
	function DeleteOrther($strar)
	{
		$sqlD = "SELECT A.*,B.lv002 lvb002 FROM ts_lv0009 A inner join ts_lv0008 B on A.lv002=B.lv001 WHERE B.lv007<=0;";
		$vresult=db_query($sqlD);
		$strReturn=false;
		while($vrow=db_fetch_array($vresult))
		{
			$vsql="update ts_lv0012 set lv004=lv004-".$vrow['lv004'].",lv006=lv006-".$vrow['lv006']." where lv002='".$vrow['lv003']."' and lv003='".$vrow['lvb002']."'";
			if(db_query($vsql))
			{
				$tsql="delete from ts_lv0009 where lv001='".$vrow['lv001']."'";
				if(db_query($tsql))
				{
					if($this->obj_wb_lv0006!=null)
				 	{
				 		$this->obj_wb_lv0006->LV_Update_Balance($vrow['lv003'],$vrow['lvb002']);
				 	}
					$strReturn= true;
				}
				else
				{
					$vsql="update ts_lv0012 set lv004=lv004+".$vrow['lv004'].",lv006=lv006+".$vrow['lv006']." where lv002='".$vrow['lv003']."' and lv003='".$vrow['lvb002']."'";
					db_query($vsql);
					$strReturn= false;
				}
				
			}
		}
		return $strReturn;

	}
	function CheckChild($vlv002,$vlv003)
	{
		$sqlD = "SELECT count(*) nums FROM ts_lv0012 WHERE lv002='$vlv002' and lv003='$vlv003'";
		$vresult=db_query($sqlD);
		if($vresult){
			$vrow=db_fetch_array($vresult);
			if($vrow['nums']<=0)
			{
				$lvsql="insert into ts_lv0012 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013) values('$vlv002','$vlv003','0','$this->lv005','0','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013')";
				db_query($lvsql);	
			}
		}
	}
	function GetParentWH($vlv001)
	{
		$sqlD = "SELECT lv002 FROM ts_lv0008 WHERE lv001='$vlv001' ";
		$vresult=db_query($sqlD);
		if($vresult){
			$vrow=db_fetch_array($vresult);
			return $vrow['lv002'];
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
	//////////Get Filter///////////////
	protected function GetCondition()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002 ='$this->lv002'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and A.lv007 = '$this->lv007'";
		if($this->lv008!="")  $strCondi=$strCondi." and A.lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and A.lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and A.lv010 like '%$this->lv010%'";
		if($this->lv011!="")  $strCondi=$strCondi." and A.lv011 like '%$this->lv011%'";
		if($this->lv012!="")  $strCondi=$strCondi." and A.lv012 like '%$this->lv012%'";
		if($this->lv013!="")  $strCondi=$strCondi." and A.lv013 like '%$this->lv013%'";
		if($this->lv014!="")  $strCondi=$strCondi." and A.lv014 like '%$this->lv014%'";
		if($this->lv015!="")  $strCondi=$strCondi." and A.lv015 like '%$this->lv015%'";
		if($this->lv016!="")  $strCondi=$strCondi." and A.lv016 like '%$this->lv016%'";
		$strwh=$this->Get_TSControler();
		$strCondi=$strCondi." and A.lv002 in (select B.lv001 from ts_lv0008 B where B.lv002 in ($strwh))";		
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM ts_lv0009 A WHERE 1=1 ".$this->GetCondition();
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
		$lvTd="<td align=@#05>@02</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"2\">&nbsp;</td>";
		$lvSumTd="<tr><td colspan=\"".count($lstArr)."\"><strong>".$this->ArrPush[99].": @#01</strong></td></tr>";
		$lvTotalNumTd="<tr><td colspan=\"".count($lstArr)."\"><strong>".$this->ArrPush[99].": @#01</strong></td></tr>";
		$sqlS = "SELECT A.*,A.lv003 lv088,IF(ISNULL(CC.lv016),BB.lv006,CC.lv016) lv099 FROM ts_lv0009 A inner join ts_lv0008 BB on A.lv002=BB.lv001 left join sl_lv0013 CC on BB.lv006=CC.lv001 and BB.lv005 in ('BANHANG','TRAHANG')  WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$vtotalnum = 0;
		$vtotalnum = 0;
		$vsumamount  = 0;
		$strTr  = 0;
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
			$vlineamount=$vrow['lv004']*$vrow['lv008']+$vrow['lv004']*$vrow['lv008']*$vrow['lv010']/100-$vrow['lv004']*$vrow['lv008']*$vrow['lv012']/100;
			$vsumamount=$vsumamount+$vlineamount;
			$vtotalnum=$vtotalnum+$vrow['lv004'];
			for($i=0;$i<count($lstArr);$i++)
			{
				if($lstArr[$i]=='lv017')
				{
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vlineamount,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				elseif($lstArr[$i]=='lv013')
				{
					$vslline = $this->objlot->LV_Get_slt_lot_all($vrow['lv014'],$vrow['lv003']);
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vslline,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
				$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv004-->",$this->FormatView($vtotalnum,10),$strF);
		$strF=str_replace("<!--lv017-->",$this->FormatView($vsumamount,10),$strF);
		$strF=str_replace("<!--lv003-->",'<p style="text-align:center;padding:5px">Tổng:</p>',$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		$lvSumTd=str_replace("@#01",$this->FormatView($vsumamount,10),$lvSumTd);
		$lvTotalNumTd=str_replace("@#01",$this->FormatView($vtotalnum,10),$lvTotalNumTd);
		return str_replace("@#01",$strTrH.$strTr,str_replace("@#04",$lvSumTd,str_replace("@#03",$lvTotalNumTd,$lvTable)));
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
			window.open('".$this->Dir."ts_lv0009/?lang=".$this->lang."&childdetailfunc='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
		$lvTdF="<td align=\"@#05\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"1\">&nbsp;</td>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT A.*,A.lv003 lv088,IF(ISNULL(CC.lv016),BB.lv006,CC.lv016) lv099 FROM ts_lv0009 A inner join ts_lv0008 BB on A.lv002=BB.lv001 left join sl_lv0013 CC on BB.lv006=CC.lv001 and BB.lv005 in ('BANHANG','TRAHANG')  WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";		
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
				$vTempF=str_replace("@01","<!--".$lstArr[$i]."-->",$this->Align($lvTdF,(int)$this->ArrView[$lstArr[$i]]));
				$strF=$strF.$vTempF;
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$vlineamount=$vrow['lv004']*$vrow['lv008']+$vrow['lv004']*$vrow['lv008']*$vrow['lv010']/100-$vrow['lv004']*$vrow['lv008']*$vrow['lv012']/100;
			$vsumamount=$vsumamount+$vlineamount;
			$vtotalnum=$vtotalnum+$vrow['lv004'];
			for($i=0;$i<count($lstArr);$i++)
			{
				if($lstArr[$i]=='lv017')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vlineamount,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				elseif($lstArr[$i]=='lv013')
				{
					$vslline = $this->objlot->LV_Get_slt_lot_all($vrow['lv014'],$vrow['lv003']);
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vslline,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv004-->",$this->FormatView($vtotalnum,10),$strF);
		$strF=str_replace("<!--lv017-->",$this->FormatView($vsumamount,10),$strF);
		$strF=str_replace("<!--lv003-->",'<p style="text-align:center;padding:5px">Tổng:</p>',$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
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
		<table  align=\"left\" class=\"lvtable\" border=1>
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
		$lvTdF="<td align=\"@#05\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"1\">&nbsp;</td>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT A.*,A.lv003 lv088,IF(ISNULL(CC.lv016),BB.lv006,CC.lv016) lv099 FROM ts_lv0009 A inner join ts_lv0008 BB on A.lv002=BB.lv001 left join sl_lv0013 CC on BB.lv006=CC.lv001 and BB.lv005 in ('BANHANG','TRAHANG')  WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";		
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
				$vTempF=str_replace("@01","<!--".$lstArr[$i]."-->",$this->Align($lvTdF,(int)$this->ArrView[$lstArr[$i]]));
				$strF=$strF.$vTempF;
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$vlineamount=$vrow['lv004']*$vrow['lv008']+$vrow['lv004']*$vrow['lv008']*$vrow['lv010']/100-$vrow['lv004']*$vrow['lv008']*$vrow['lv012']/100;
			$vsumamount=$vsumamount+$vlineamount;
			$vtotalnum=$vtotalnum+$vrow['lv004'];
			for($i=0;$i<count($lstArr);$i++)
			{
				if($lstArr[$i]=='lv017')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vlineamount,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				elseif($lstArr[$i]=='lv013')
				{
					$vslline = $this->objlot->LV_Get_slt_lot_all($vrow['lv014'],$vrow['lv003']);
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vslline,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv004-->",$this->FormatView($vtotalnum,10),$strF);
		$strF=str_replace("<!--lv017-->",$this->FormatView($vsumamount,10),$strF);
		$strF=str_replace("<!--lv003-->",'<p style="text-align:center;padding:5px">Tổng:</p>',$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
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
			<td class=\"lvlineboldtable\" align=\"right\">@01</td>
		</tr>
		";
		$lvTdF="<td align=\"@#05\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"1\">&nbsp;</td>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT A.*,A.lv003 lv088,IF(ISNULL(CC.lv016),BB.lv006,CC.lv016) lv099 FROM ts_lv0009 A inner join ts_lv0008 BB on A.lv002=BB.lv001 left join sl_lv0013 CC on BB.lv006=CC.lv001 and BB.lv005 in ('BANHANG','TRAHANG')  WHERE  1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$strSubTotal=0;
		$strSubTax=0;
		$strTotalAmount=0;
		$vUnitPrice="VNĐ";
		$sumtrue=false;
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;		
				if($lstArr[$i]=='lv017') $sumtrue=true;
				$vTempF=str_replace("@01","<!--".$lstArr[$i]."-->",$this->Align($lvTdF,(int)$this->ArrView[$lstArr[$i]]));
				$strF=$strF.$vTempF;
			}
		if($sumtrue==false) $lvTrTotal="";
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$vlineamount=$vrow['lv004']*$vrow['lv008']+$vrow['lv004']*$vrow['lv008']*$vrow['lv010']/100-$vrow['lv004']*$vrow['lv008']*$vrow['lv012']/100;
			$vsumamount=$vsumamount+$vlineamount;
			$vtotalnum=$vtotalnum+$vrow['lv004'];
			$vtotalnum1=$vtotalnum1+$vrow['lv006']*$vrow['lv004'];
			$vtotalnum2=$vtotalnum2+$vrow['lv008']*$vrow['lv004'];
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv017':				
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vlineamount,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv013':
						$vslline = $this->objlot->LV_Get_slt_lot_all($vrow['lv014'],$vrow['lv003']);
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vslline,(int)$this->ArrView[$lstArr[$i]])).(($lstArr[$i]=='lv010' || $lstArr[$i]=='lv012')?'%':''),$lvTd);
						break;
					default:
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				$strL=$strL.$vTemp;
			}
			$vUnitPrice=$this->getvaluelink('lv007',$this->FormatView($vrow['lv007'],(int)$this->ArrView[$vrow['lv007']]));
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vTax>0 || $vTax==-1)
			{
				$strSubTotal=$strSubTotal+$vrow['lv004']*$vrow['lv008']-$vrow['lv004']*$vrow['lv008']*$vrow['lv012']/100;
			}
			else
			{
				$strSubTotal=$strSubTotal+$vrow['lv004']*$vrow['lv008']+$vrow['lv004']*$vrow['lv008']*$vrow['lv010']/100-$vrow['lv004']*$vrow['lv008']*$vrow['lv012']/100;
			}			
		}
			/*$strLine=str_replace("@01",$this->FormatView($strSubTotal,1),$lvTrTotal);
			$strLine=str_replace("@03",$this->ArrPush[42],$strLine);
			$strLine=str_replace("@04",count($lstArr),$strLine);
			//$strTr=$strTr.$strLine;
			if($vTax>0)
			{
			$strSubTax=$strSubTotal*$vTax/100;
			$strLine=str_replace("@01",$this->FormatView($strSubTax,1),$lvTrTotal);
			$strLine=str_replace("@03",str_replace("@02",$this->FormatView($vTax,10),$this->ArrPush[43]),$strLine);
			$strLine=str_replace("@04",count($lstArr),$strLine);
			$strTr=$strTr.$strLine;
			}
		
			$strTotalAmount=$strSubTotal+$strSubTax;
			$strLine=str_replace("@01",$this->FormatView($strTotalAmount,1),$lvTrTotal);
			$strLine=str_replace("@03",$this->ArrPush[44],$strLine);
			$strLine=str_replace("@04",count($lstArr),$strLine);
			$strTr=$strTr.$strLine;*/
			$strF=$strF."</tr>";
		$strF=str_replace("<!--lv004-->",$this->FormatView($vtotalnum,10),$strF);
		$strF=str_replace("<!--lv006-->",$this->FormatView($vtotalnum1,10),$strF);
		$strF=str_replace("<!--lv017-->",$this->FormatView($vsumamount,10),$strF);
		$strF=str_replace("<!--lv003-->",'<p style="text-align:center;padding:5px">Tổng:</p>',$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",str_replace("@01","(".$vUnitPrice.")",$strH),$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	function Get_String_BuilHeader()
	{
		$this->lvHeader="";
		$strTD="";
		$sqlS1 = "SELECT lv014  FROM ts_lv0009 A WHERE 1=1  ".$this->GetCondition()." ";
		$bResult = db_query($sqlS1);
		$ArSize=Array();
		$ArColor=Array();
		while ($vrow = db_fetch_array ($bResult))
		{
		
			$vData=explode("-",$vrow['lv014'],2);
			if(count($vData)==1)
			{
				$ArCol[$vData[0]]=$vData[0];
				//$ArSize['-']='-';
			}
			else
			{
				
				$ArSize[$vData[0]]=$vData[0];
				$ArCol[$vData[1]]=$vData[1];
			}
			
		}
		$strTD=Array();
		$vArSize=$ArSize;
		$this->lvHeader='<td class="lvhtable" align="center">'.$this->ArrPush[4].'</td><td class="lvhtable" align="center">'.$this->ArrPush[46].'</td>';
		$this->lvFooter='<tr style="font-weight:bold"><td  align="center">&nbsp</td><td  align="center">&nbsp</td><td  align="center">&nbsp</td>';
		$this->ArSize=$ArSize;
		foreach($ArSize as $size)
		{
			$this->lvHeader=$this->lvHeader.'<td class="lvhtable" align="center"><b><font color="'.$color.'">'.$size.'</font></b></td>';
			$this->lvFooter=$this->lvFooter.'<td  align="right"><!--'.$size.'--></td>';
		}
		$this->lvHeader=$this->lvHeader.'<td class="lvhtable" align="center">TC SL</td><td class="lvhtable" align="center">'.$this->ArrPush[6].'</td><td class="lvhtable" align="center">'.$this->ArrPush[16].'</td>';
		$this->lvFooter=$this->lvFooter.'<td  align="right"><!--allsize--></td><td>&nbsp</td><td>&nbsp;</td></tr>';
		$i=0;	
		$this->ArCol=$ArCol;
		foreach($ArCol as $Col)
		{
			$strTD[$Col][1]='<!--%'.$Col.'%--><td align="center"><!--#stt#--><td align=";left"><!--#item#--></td><td align="center">'.$Col.'</td>';
			foreach($vArSize as $size)
			{
				$strTD[$Col][1]=$strTD[$Col][1].'<td align="right"><!--'.$size.'-'.$Col.'-->'.'</td>';
			}
			$strTD[$Col][1]=$strTD[$Col][1].'<td align="right"><!--sum:*item*-'.$Col.'-->'.'</td><td align="center"><!--unit:*item*-'.$Col.'-->'.'</td><td align="center"><!--note:*item*-'.$Col.'-->'.'</td>';
		}
		
	$i++;
		return $strTD;
		
	}
	function LV_BuilListReportOtherSoon($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$vTax)
	{
		$vArrRow=$this->Get_String_BuilHeader();		
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
		$strF="<tr><td colspan=\"2\">&nbsp;</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$sqlS = "select * from (SELECT lv003,lv014,sum(lv004) lv004,lv005,lv003 lv088 FROM ts_lv0009 A WHERE 1=1  ".$this->GetCondition()." group by lv003,lv014) MP order by MP.lv003";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$ArrItem=Array();
		$ArrSumItem=Array();
		$ArrSumSize=Array();
		$vDataItem="213412412312";
		while ($vrow = db_fetch_array ($bResult)){
			$vData=explode("-",$vrow['lv014'],2);
			if(count($vData)==1)
				{
					$CodeID=$vData[0];
					$SizeID="-";
				}
				else
				{
					$SizeID=$vData[0];
					$CodeID=$vData[1];
				}
			/*if($vDataItem!=$vrow['lv003'])
			{
				
				
				$ArrItem[$vDataItem][1]=str_replace('<!--sum:'.$CodeID.'-->',$ArrSumItem[$vDataItem][0],$ArrItem[$vDataItem]);
				$ArrItem[$vDataItem]=str_replace('<!--note:'.$CodeID.'-->',$ArrSumItem[$vDataItem][1],$ArrItem[$vDataItem]);
				$vDataItem=$vrow['lv003'];
			}*/
			$ArrSumSize[$SizeID]=$ArrSumSize[$SizeID]+$vrow['lv004'];
			$ArrItem[$vrow['lv003']][0]=$vrow['lv003'];
			$ArrSumItem[$vrow['lv003']][$CodeID][2]=$vrow['lv005'];
			$ArrSumItem[$vrow['lv003']][$CodeID][0]=$ArrSumItem[$vrow['lv003']][$CodeID][0]+$vrow['lv004'];
			$ArrSumItem[$vrow['lv003']][$CodeID][1]=$ArrSumItem[$vrow['lv003']][$CodeID][1].$vrow['lv015'];
			$ArrItem[$vrow['lv003']][1]=$this->LV_GetValue($vArrRow,$vrow['lv003'],$vrow['lv014'],$ArrItem[$vrow['lv003']][1],$vorder);
			$ArrItem[$vrow['lv003']][1]=str_replace('<!--'.(($vrow['lv014']=="")?"-":$vrow['lv014']).'-->',$this->FormatView($vrow['lv004'],10),$ArrItem[$vrow['lv003']][1]);
		}
		foreach($ArrItem as $stritem)
		{
			$vArCol=$this->ArCol;
			foreach($vArCol as $Col)
			{
				$stritem[1]=str_replace("<!--sum:".$stritem[0]."-$Col-->",$ArrSumItem[$stritem[0]][$Col][0],$stritem[1]);
				$stritem[1]=str_replace("<!--note:".$stritem[0]."-$Col-->",$ArrSumItem[$stritem[0]][$Col][1],$stritem[1]);
				$stritem[1]=str_replace("<!--unit:".$stritem[0]."-$Col-->",$ArrSumItem[$stritem[0]][$Col][2],$stritem[1]);
			}
			$strTrH=$strTrH.$stritem[1];
		}
		$ArSize=$this->ArSize;
		if(count($ArSize)==0)
		{
			$vSumAll=$ArrSumSize['-'];
		}
		else
		{
			foreach($ArSize as $size)
			{
				$vSumAll=$vSumAll+$ArrSumSize[$size];
				$this->lvFooter=str_replace("<!--$size-->",$this->FormatView($ArrSumSize[$size],10),$this->lvFooter);
			}
		}
		$this->lvFooter=str_replace("<!--allsize-->",$this->FormatView($vSumAll,10),$this->lvFooter);
		
		$strTrH=str_replace("@#01",$this->lvHeader,$lvTrH).$strTrH.$this->lvFooter;
		return str_replace("@#01",$strTrH,$lvTable);
	}
	function LV_GetValue($vArrRow,$vItem,$vLotID,$vStrItem,&$vorder)
	{
		$lvTr="<tr class=\"lvlinehtable1\">
			@#01
		</tr>";
		$vData=explode("-",$vLotID,2);
		if(count($vData)==1)
		{
			$CodeID=$vData[0];
		}
		else
		{
			
			$CodeID=$vData[1];
		}
		if(!strpos($vStrItem,"<!--%$CodeID%-->")===false) return $vStrItem;
		if($vStrItem=="")
		{
			$vStrItem=$vStrItem.str_replace("@#01",$vArrRow[$CodeID][1],$lvTr);
			$vorder++;
			$vStrItem=str_replace("<!--#stt#-->",$vorder,$vStrItem);
			$vStrItem=str_replace("<!--#item#-->",$this->getvaluelink('lv003',$vItem),$vStrItem);
		}
		else
		{
			$vStrItem=$vStrItem.str_replace("@#01",$vArrRow[$CodeID][1],$lvTr);
			$vStrItem=str_replace("<!--#item#-->",'',$vStrItem);
		}
		$vStrItem=str_replace("*item*-",$vItem."-",$vStrItem);
		return $vStrItem;
	}
	public function LV_LinkField($vFile,$vSelectID)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectID),1));
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
			case 'lv003':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0007 where 1=1 and lv015=0 and (lv016 ='$vSelectID' or lv016='')";
				break;
			case 'lv005':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0005";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0005";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0005";
				break;
			case 'lv011':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0003";
				break;
			case 'lv012':
				$vsql="select lv001,concat(lv001,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0002";
				break;
			case 'lv013':
				$vsql="select lv001,concat(lv001,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0002";
				break;
			case 'lv017':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0027";
				break;
			case 'lv018':
				$vsql="select lv003 lv001,lv003 lv002,0 lv003 from  sl_lv0030 where lv002='$vSelectID' order by lv002 asc";
				break;
			case 'lv019':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0029";
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
				$strwh=$this->Get_TSControler();
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0007 where 1=1 and lv015=0 and (lv016 in ($strwh)) order by lv001 asc";
				break;
			case 'lv005':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0005";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018";
				break;
			case 'lv017':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0027";
				break;
			case 'lv018':
				$vsql="select lv003 lv001,lv003 lv002,0 lv003 from  sl_lv0030 where lv002='$vSelectID' order by lv002 asc";
				break;
			case 'lv019':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0029";
				break;
		}
		return $vsql;
	}
	private  function getvaluelink($vFile,$vSelectID)
	{	$lvopt=2;
		switch($vFile)
		{
			//case 'lv003':
			//	$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0007 where lv001='$vSelectID'";
			//	break;
			case 'lv088':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0007 where lv001='$vSelectID'";
				break;
			case 'lv005':
				$lvopt=0;
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0005 where lv001='$vSelectID'";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv009':
				$lvopt=0;
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018 where lv001='$vSelectID'";
				break;
			case 'lv018':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0028 where lv001='$vSelectID'";
				break;
			case 'lv019':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0029 where lv001='$vSelectID'";
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