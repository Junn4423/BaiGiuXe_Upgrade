<?php
/////////////coding cr_lv0005///////////////
class   cr_lv0086 extends lv_controler
{
	public $isConnectSQLSERVER = false;
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
///////////
	public $DefaultFieldList="lv199,lv015,lv016,lv026,lv023,lv012,lv003,lv002,lv004,lv005,lv006,lv007,lv008,lv013,lv014,lv001,lv010,lv009,lv027,lv089";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='cr_lv0086';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv024"=>"25","lv025"=>"26","lv026"=>"27","lv027"=>"28","lv094"=>"95","lv096"=>"97","lv097"=>"98","lv098"=>"99","lv088"=>"89","lv100"=>"101","lv101"=>"102","lv111"=>"112","lv201"=>"202","lv099"=>"100","lv112"=>"113","lv199"=>"200","lv089"=>"90");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"22","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"22","lv011"=>"0","lv012"=>"22","lv013"=>"0","lv014"=>"0","lv015"=>"0","lv016"=>"10","lv017"=>"0","lv018"=>"0","lv019"=>"0","lv020"=>"0","lv021"=>"0","lv022"=>"0","lv023"=>"22","lv024"=>"0","lv025"=>"0","lv026"=>"0","lv027"=>"0","lv094"=>"2","lv096"=>"10","lv097"=>"10","lv098"=>"10","lv088"=>"0","lv100"=>"10","lv101"=>"10","lv201"=>"0","lv201"=>"0","lv099"=>"0","lv112"=>"0","lv199"=>"0");	
	var $ArrViewEnter=array("lv003"=>"33","lv005"=>"-1","lv012"=>"-1","lv015"=>"-1");
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
		$this->isRpt=0;
		$this->isAdd=0;
		$this->isEdit=0;
		$this->isDel=0;
	}
	protected function LV_CheckLock()
	{
		$lvsql="select lv098 from cr_lv0004 B where  B.lv001='$this->lv002'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if($vrow['lv098']>=1)
			{
				$this->isAdd=0;	
				$this->isEdit=0;	
				$this->isDel=0;	
			}
		}
		
	}
	function LV_LoadProject($vProjectID,$vType)
	{
		
		$lvsql="select * from  cr_lv0005 Where lv002='$vProjectID' and lv003='$vType'";
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
			$this->lv111=$vrow['lv111'];
		}
	}
	function LV_Load()
	{
		$vsql="select * from  cr_lv0005";
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
			$this->lv111=$vrow['lv111'];
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  cr_lv0005 Where lv001='$vlv001'";
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
			$this->lv111=$vrow['lv111'];
		}
	}
	function LV_LoadProjectRefID($vProjectID,$vType,$vRefID='')
	{
		
		$lvsql="select * from  cr_lv0005 Where lv002='$vProjectID' and lv003='$vType' and lv014='$vRefID'";
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
			$this->lv111=$vrow['lv111'];
		}
		else
		{
			$this->lv001=null;
		}
	}
	function LV_LoadActiveID($vlv001)
	{
		$lvsql="select * from  cr_lv0005 Where lv001='$vlv001' and lv011=1";
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
			$this->lv111=$vrow['lv111'];
		}
	}
	function LV_CheckLocked($vlv002)
	{
		$lvsql="select lv098 from  cr_lv0004 Where lv001='$vlv002'";
		$vresult=db_query($lvsql);
		if($vresult){
		$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				if($vrow['lv098']<=0 ) 
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
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang).' '.substr($this->lv005,11,8):$this->DateDefault;
		$this->lv012 = ($this->lv012!="")?recoverdate(($this->lv012), $this->lang).' '.substr($this->lv012,11,8):$this->DateDefault;
	   $lvsql="insert into cr_lv0005 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016) values('$this->lv002','$this->lv003','".sof_escape_string($this->lv004)."','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->LV_UserID',now(),'$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016')";
		$vReturn= db_query($lvsql);
		if($vReturn) 
		{
			$
			$this->InsertLogOperation($this->DateCurrent,'cr_lv0005.insert',sof_escape_string($lvsql));
		}
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
			$this->lv008=$vrow['lv008'];
			$this->lv009=$vrow['lv009'];
			$this->lv010=$vrow['lv010'];
			$this->lv011=$vrow['lv011'];
			$this->lv012=$vrow['lv012'];
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
			$this->lv111=$vrow['lv111'];
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
	function LV_UpdateChangeChild($lvsql)
	{
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'cr_lv0005.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		$this->lv010 = ($this->lv010!="")?recoverdate(($this->lv010), $this->lang).' '.substr($this->lv010,11,8):$this->DateDefault;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang).' '.substr($this->lv005,11,8):$this->DateDefault;
		$lvsql="Update cr_lv0005 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015' where  lv001='$this->lv001'";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'cr_lv0005.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM cr_lv0005  WHERE lv001 IN ($lvarr) and cr_lv0005.lv011=0  and (select A.lv098 from  cr_lv0004 A Where A.lv001= cr_lv0005.lv002)<=1 ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'cr_lv0005.delete',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_GetDaDuyetTK($vCodeID,$vLoai)
	{
		$lvsql = "select lv006 nums from cr_lv0372  WHERE lv002='$vCodeID' and lv006 in ('AprTK','UnAprTK') order by lv005 DESC  limit 0,1";
		$bResult= db_query($lvsql);
		while($vrow = db_fetch_array ($bResult))
		{
			if($vLoai!=$vrow['lv006'])
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
	}
	function LV_GetDuyetThamKhao($vCodeID,$vStaffID,$vLoai)
	{
		$lvsql = "select lv006 from cr_lv0372  WHERE lv002='$vCodeID' and lv004='$vStaffID'  order by lv005 DESC limit 0,1";
		$bResult= db_query($lvsql);
		while ($vrow = db_fetch_array ($bResult))
		{	
			if($vLoai!=$vrow['lv006'])
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		return true;
	}
	function LV_AprovalDuyetThamKhao($lvarr)
	{
		$lvsql = "select lv001,lv003,lv013,lv014 from cr_lv0005  WHERE lv001 IN ($lvarr) and lv011=1  and lv027=1 ";
		$bResult= db_query($lvsql);
		while ($vrow = db_fetch_array ($bResult))
		{	
			$this->LV_SetHistoryArr('AprTK',$vrow['lv001']);
		}
	}
	//History 
	function LV_SetHistoryArr($vFun,$lvarr)
	{
		$vArr=explode(",",$lvarr);
		foreach($vArr as $vLongTermID)
		{
			$vLongTermID=str_replace("'","",$vLongTermID);
			if($vLongTermID!='') $this->LV_SetHistory($vFun,$vLongTermID);
		}
	}
	//Log
	function LV_SetHistory($vFun,$vLongTermID)
	{
		$vTitle='';
		switch($vFun)
		{
			case 'Apr':
				$vTitle="Duyệt bảng công!";
				break;
			case 'AprTK':
				$vTitle="Trợ lý duyệt bảng công!";
				break;
			case 'UnApr':
				$vTitle="Trả lại bảng công!";
				break;
			case 'UnAprTK':
				$vTitle="Trợ lý duyệt trả lại bảng công!";
				break;
			default:
				break;
		}
		//cr_lv0312
		if($vTitle!='' && $this->LV_GetDuyetThamKhao($vLongTermID,$this->LV_UserID,$vFun))
		{
			$lvsql="insert into cr_lv0372 (lv002,lv003,lv004,lv005,lv006,lv007) values('".$vLongTermID."','".sof_escape_string($vTitle)."','$this->LV_UserID',now(),'$vFun',0)";
			$vReturn= db_query($lvsql);
			if($vReturn)
			{
			 	$this->InsertLogOperation($this->DateCurrent,'cr_lv0372.insert',sof_escape_string($lvsql));
				 if($vFun=='UnApr')
				 {
					$lvsql="update cr_lv0312 set lv008=lv008+1 where lv002='$vLongTermID'";
					$vReturn= db_query($lvsql);
					if($vReturn)
					{
						$this->InsertLogOperation($this->DateCurrent,'cr_lv0312.update',sof_escape_string($lvsql));
					}
				 }
				
				 
			}
		}
	}
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$vUserID=$this->LV_UserID;
		$lvsql = "select lv001,lv003,lv013,lv014 from cr_lv0005  WHERE lv001 IN ($lvarr) and lv011=1  and lv027=1 ";
		$bResult= db_query($lvsql);
		while ($vrow = db_fetch_array ($bResult)){
			
			$lvsql1 = "Update cr_lv0005 set lv027=IF(lv016=1,2,3),lv024='$this->LV_UserID',lv025=now()  WHERE lv001='".$vrow['lv001']."' and lv011=1  and lv027=1 ";
			$vReturn= db_query($lvsql1);
			if($vReturn) 
			{
				$this->InsertLogOperation($this->DateCurrent,'cr_lv0005.approval',sof_escape_string($lvsql1));
				if(trim($vrow['lv014'])!='')
				{
					switch($vrow['lv003'])
					{
						//Bán lẻ
						case 'PO':
							//HĐ
						case 'HĐKT':
						case 'PLHĐ':
						
							////Mãu
						case 'DEMO':
						case 'L':
						case 'M':
						case 'S':
							///Xử lý tạo công việc chung duyệt bán hàng
							//B1. Tạo công việc tất cả liên HĐ duyệt
							/////- Tạo 
							///
							break;
						case 'DUYETCONG':
							//Xử lý khoá công theo thông số
							$this->LV_KhoCongTheoCV($vrow['lv014'],2);
							break;
						case 'ĐNGH':
							///Xử lý kiểm tra check PBH có check đã đủ hàng hay chưa
							$vPBHID=$vrow['lv014'];
							//Xử lý khoá công theo thông số
							//Xử lý cập nhật trạng thái PBH đưa lên hoàn thànhth
							if($this->LV_CheckPBHWH($vPBHID)!=1)
							{
								$vJobCreateID='PMH';
								$vNguoiGV=$this->mojo_lv0016->lv339;
								$vNguoiDuyet=$this->mojo_lv0016->lv340;
								$this->LV_CheckCreate($vrow['lv001'],$vrow['lv003'],$vrow['lv013'],$vPBHID,$vJobCreateID,$vNguoiGV,$vNguoiDuyet);						
							}
							///
							$this->mocr_lv0253->LV_AprovalKho($vPBHID);
							break;
						case 'PMH':
							$vPBHID=$vrow['lv014'];
							//Xứ lý duyệt phiếu PMH
							//Duyệt Công Việc mua hàng lên thực hiện
							$this->LV_AprovalPBH($vrow['lv001'],$vPBHID);
							//Đưa trạng thái mua hàng lên thực hiện
							$this->LV_AprovalPMH($vrow['lv001'],$vPBHID);
							//Tạo thêm công việc đề nghị đầu vào
							$vJobCreateID='ĐNNK';
							$vNguoiGV=$this->mojo_lv0016->lv341;
							$vNguoiDuyet=$this->mojo_lv0016->lv342;
							$this->LV_CheckCreate($vrow['lv001'],$vrow['lv003'],$vrow['lv013'],$vPBHID,$vJobCreateID,$vNguoiGV,$vNguoiDuyet);
							/// Đề nghị chi tiền
							$vJobCreateID='PC';
							$vNguoiGV=$this->mojo_lv0016->lv343;
							$vNguoiDuyet=$this->mojo_lv0016->lv344;
							$this->LV_CheckCreate($vrow['lv001'],$vrow['lv003'],$vrow['lv013'],$vPBHID,$vJobCreateID,$vNguoiGV,$vNguoiDuyet);
							break;
						case 'ĐNNK':
							$vPBHID=$vrow['lv014'];
							//Xứ lý duyệt phiếu PMH
							//Duyệt Công Việc mua hàng lên thực hiện
							$this->LV_AprovalDNNK($vrow['lv001'],$vPBHID);
							break;
						case 'ĐNGH':
							$vPBHID=$vrow['lv014'];
							//Xứ lý duyệt phiếu PMH
							//Duyệt Công Việc mua hàng lên thực hiện
							$this->LV_AprovalDNGH($vrow['lv001'],$vPBHID);
							break;
					}
				}
			}
		}
		return $vReturn;
	}	
	///Xử lý cập nhật đề nghị nhập kho
	function LV_AprovalDNGH($vJobID,$vPBHID)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update cr_lv0113 set lv007=1,lv027=1  WHERE lv114='$vJobID' and lv006='$vPBHID'  and lv007=0 and lv027=0";
		$vReturn= db_query($lvsql);
		if($vReturn) 
			{
				//$this->LV_InsertLocal($lvarr);
				$this->InsertLogOperation($this->DateCurrent,'cr_lv0113.approval',sof_escape_string($lvsql));
			}
		return $vReturn;
	}	
	///Xử lý cập nhật đề nghị nhập kho
	function LV_AprovalDNNK($vJobID,$vPBHID)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update cr_lv0108 set lv007=1,lv027=1  WHERE lv114='$vJobID' and lv006='$vPBHID' and lv007=0 and lv027=0";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'cr_lv0108.cr_lv0086.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	///Xử lý cập nhật PMH
	function LV_AprovalPBH($vJobID,$vPBHID)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update sl_lv0013 set lv339=1  WHERE lv114='$vJobID' and lv115='$vPBHID'  and lv339<1 ";
		$vReturn= db_query($lvsql);
		if($vReturn) 
		{
			$this->InsertLogOperation($this->DateCurrent,'sl_lv0013.cr_lv0086.approval',sof_escape_string($lvsql));
			//$this->LV_SetHistoryArr('Apr',$lvarr);
		}
		return $vReturn;
	}	
	///Xử lý cập nhật PMH
	function LV_AprovalPMH($vJobID,$vPBHID)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update wh_lv0021 set lv027=3,lv011=1  WHERE lv114='$vJobID' and lv089='$vPBHID'  and lv027<=2 ";
		$vReturn= db_query($lvsql);
		if($vReturn) 
		{
			$this->InsertLogOperation($this->DateCurrent,'wh_lv0021.cr_lv0086.approval',sof_escape_string($lvsql));
			//$this->LV_SetHistoryArr('Apr',$lvarr);
		}
		return $vReturn;
	}	
	///Kiểm tra đủ hàng hay chua
	function LV_CheckPBHWH($vPBHID)
	{
		$lvsql="select lv232 from sl_lv0013 where lv115='$vPBHID'";
		$vReturn= db_query($lvsql);
		$vrow=db_fetch_array($vReturn);
		return $vrow['lv232'];
	}
	
	//Tạo ra đề nghị giao việc mua hàng
	function LV_CheckCreate($vParentID,$vJobID,$vType,$vRefID,$vJobCreateID,$vNguoiGV,$vNguoiDuyet)
	{
		////Tạo ra công việc ĐNMH
		//$vJobID,$vType,$vRefID
		
		$vNguoiGV=$this->mojo_lv0016->lv339;
		$this->LV_CheckCreateJob($vRefID,$vParentID,$vJobCreateID,$vNguoiGV,$vNguoiDuyet);
		if($this->lv001!=null)
		{
			//Copy attach file
			$lvsql="insert into cr_lv0091 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010) select MP.* from (select lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,'$this->LV_UserID' lv009,now() lv010 from cr_lv0091 where lv002='$vParentID' and lv006='CHECKWH') MP";
			$vReturn= db_query($lvsql);
			if($vReturn) 
			{
				$vInsertID=sof_insert_id();
				$this->InsertLogOperation($this->DateCurrent,'cr_lv0091.insert',sof_escape_string($lvsql));
				//Attached files
				$lvsql="insert into erp_sof_documents_v4_0.cr_lv0091(lv002,lv003,lv004,lv005,lv006,lv007,lv008) select MP.* from (select '$vInsertID' lv002,lv003,lv004,lv005,lv006,lv007,lv008 from erp_sof_documents_v4_0.cr_lv0091 where lv002='".$vParentID."') MP";
				$vReturn= db_query($lvsql);
				if($vReturn) 
				{
					$this->InsertLogOperation($this->DateCurrent,'cr_lv0091.insert',sof_escape_string($lvsql));
				}
			}
			
		}
	}
	function LV_CheckCreateJob($vMaPBHID,$vJobID,$vJobCreateID='CHECKWH',$vNguoiGV='',$vNguoiDuyet='')
	{
		if($vNguoiGV=='') $vNguoiGV=$this->LV_UserID;
		//Xác định DNDR có chưa
		$this->LV_LoadID($vJobID);
		//Xác định plan
		$vPlanID=$this->lv002;
		//Xử lý xem đầu ra có chưa?
		//echo "!$vPlanID,$vJobCreateID,$vMaPBHID!";
		$this->LV_LoadProjectRefID($vPlanID,$vJobCreateID,$vMaPBHID);
		if($this->lv001==null)
		{
			//Tạo ĐNGH
			$this->lv002=$vPlanID;
			//ĐNGH
			$this->lv003=$vJobCreateID;
			//Tên công việc
			$this->lv004='Tạo đề nghị mua hàng';
			//Ngay giao việc
			$this->lv005=$this->FormatView($this->DateCurrent,4);
			//NV Chính
			if(strpos($vNguoiGV,',')===false)
			{
				$this->lv006=$vNguoiGV;
				$this->lv007='';
			}
			else
			{
				$vArrGV=explode(',',$vNguoiGV,2);
				$this->lv006=$vArrGV[0];
				$this->lv007=$vArrGV[1];
			}
			//NV Duyệt
			if($vNguoiDuyet=='')
				$this->lv008=$this->LV_GetNguoiDuyet($this->lv006);
			else
				$this->lv008=$vNguoiDuyet;
			if($this->lv008=='') $this->lv008='MP001';
			$this->lv013='PBH';
			$this->lv014=$vMaPBHID;
			$this->lv015='0';
			$this->lv016='1';
			$this->LV_InsertJob();
		}
	}
	function LV_InsertJob()
	{
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang).' '.substr($this->lv005,11,8):$this->DateDefault;
		$this->lv012 = ($this->lv012!="")?recoverdate(($this->lv012), $this->lang).' '.substr($this->lv012,11,8):$this->DateDefault;
	    $lvsql="insert into cr_lv0005 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016) values('$this->lv002','$this->lv003','".sof_escape_string($this->lv004)."','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->LV_UserID',now(),'$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016')";
		$vReturn= db_query($lvsql);
		if($vReturn) 
		{
			$this->lv001=sof_insert_id();
			$this->InsertLogOperation($this->DateCurrent,'cr_lv0005.insert',sof_escape_string($lvsql));
		}
		return $vReturn;
	}	
	function LV_GetNguoiDuyet($vStaffID)
	{
		$lvsql="select A.lv100 from  hr_lv0002 A inner join hr_lv0020 B on B.lv029=A.lv001  Where B.lv001='$vStaffID'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		return $vrow['lv100'];
	}
	function LV_UnAprovalMore($lvarr)
	{
		if($this->isApr==0) return false;
		$vUserID=$this->LV_UserID;
		$lvsql = "select lv001,lv003,lv014 from cr_lv0005  WHERE lv001 IN ($lvarr) and lv011=1 ";
		$bResult= db_query($lvsql);
		while ($vrow = db_fetch_array ($bResult)){
			
			$lvsql1 = "Update cr_lv0005 set lv027=0,lv024='$this->LV_UserID',lv025=now()  WHERE lv001='".$vrow['lv001']."' and lv011=1 ";
			$vReturn= db_query($lvsql1);
			if($vReturn) 
			{
				$this->InsertLogOperation($this->DateCurrent,'cr_lv0005.approval',sof_escape_string($lvsql1));
				if($vrow['lv003']=='DUYETCONG' && trim($vrow['lv014'])!='')
				{
					//Xử lý khoá công theo thông số
					$this->LV_KhoCongTheoCV($vrow['lv014'],0);
				}
			}
		}
		return $vReturn;
	}	
	////////Khoa cong theo thong so////////////////
	function LV_KhoCongTheoCV($vCalID,$vOpt=0)
	{
		$lvsql = "select lv006,lv007 from tc_lv0013  WHERE lv001='$vCalID'";
		$bResult= db_query($lvsql);
		while ($vrow = db_fetch_array ($bResult)){
			$vMonth=$vrow['lv006'];
			$vYear=$vrow['lv007'];
			$vsql1="update tc_lv0009 set lv005='$vOpt' where lv003='".((int)$vMonth)."' and lv004='".$vYear."'";
			$vresult1=db_query($vsql1);
			if($vresult1) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.update',sof_escape_string($vsql1));
		}
	}
	function LV_UnAproval($lvarr)
	{
		if($this->isUnApr==0) return false;
		$vUserID=$this->LV_UserID;
		$lvsql = "Update cr_lv0005 set lv027=0  WHERE lv001 IN ($lvarr) and lv011=1  and lv027=1 ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'cr_lv0005.unapproval',sof_escape_string($lvsql));
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
		if($this->lv002!="")
		{
			if(strpos($this->lv002,","))
			{
					$strCondi=$strCondi." and A.lv002 in ('".str_replace(",","','",$this->lv002)."')";
			}
			else
			{
					$strCondi=$strCondi." and A.lv002 = '$this->lv002'";
			}
		}
		if($this->lv003!="")
		{
			if(strpos($this->lv003,","))
			{
					$strCondi=$strCondi." and A.lv003 in ('".str_replace(",","','",$this->lv003)."')";
			}
			else
			{
					$strCondi=$strCondi." and A.lv003 = '$this->lv003'";
			}
		}
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and A.lv007 like '%$this->lv007%'";
		if($this->lv008!="")
		{
			$strCondi=$strCondi." and A.lv008 = '$this->lv008'";
		}
		if($this->lv009!="")
		{
			if(strpos($this->lv009,","))
			{
					$strCondi=$strCondi." and A.lv009 in ('".str_replace(",","','",$this->lv009)."')";
			}
			else
			{
					$strCondi=$strCondi." and A.lv009 = '$this->lv009'";
			}
		}
		if($this->lv010!="")  $strCondi=$strCondi." and A.lv010 like '%$this->lv010%'";
		if($this->lv011!="")  $strCondi=$strCondi." and A.lv011='$this->lv011'";
		if($this->lv012!="")  $strCondi=$strCondi." and A.lv012='$this->lv012'";
		if($this->lv015!="")  $strCondi=$strCondi." and A.lv015 like '%$this->lv015%'";

		if($this->lv888!="")
		{
			if(strpos($this->lv888,","))
			{
					$strCondi=$strCondi." and B.lv088 in ('".str_replace(",","','",$this->lv888)."')";
			}
			else
			{
					$strCondi=$strCondi." and B.lv088 = '$this->lv888'";
			}
		}
		if($this->lv817!="")
		{
			if(strpos($this->lv817,","))
			{
					$strCondi=$strCondi." and B.lv017 in ('".str_replace(",","','",$this->lv817)."')";
			}
			else
			{
					$strCondi=$strCondi." and B.lv017 = '$this->lv817'";
			}
		}
		if($this->lv803!="")
		{
			if(strpos($this->lv803,","))
			{
					$strCondi=$strCondi." and B.lv003 in ('".str_replace(",","','",$this->lv803)."')";
			}
			else
			{
					$strCondi=$strCondi." and B.lv003 = '$this->lv803'";
			}
		}
		if($this->lv820!="")
		{
			if(strpos($this->lv820,","))
			{
					$strCondi=$strCondi." and B.lv020 in ('".str_replace(",","','",$this->lv820)."')";
			}
			else
			{
					$strCondi=$strCondi." and B.lv020 = '$this->lv820'";
			}
		}
		if($this->lv824!="")
		{
			if(strpos($this->lv824,","))
			{
					$strCondi=$strCondi." and B.lv024 in ('".str_replace(",","','",$this->lv824)."')";
			}
			else
			{
					$strCondi=$strCondi." and B.lv024 = '$this->lv824'";
			}
		}
		if($this->lv904!="")
		{
			if(strpos($this->lv904,","))
			{
					$strCondi=$strCondi." and C.lv004 in ('".str_replace(",","','",$this->lv904)."')";
			}
			else
			{
					$strCondi=$strCondi." and C.lv004 = '$this->lv904'";
			}
		}

		
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM cr_lv0005  A inner join cr_lv0004 C on A.lv002=C.lv001   WHERE A.lv011=1 and A.lv027=1   ".$this->GetCondition()." "; 
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_GetSumMarkForSale($vEmployeeID,$opt=0,$vParent)
	{
		if($opt==0)
			$lvsql="select sum(lv005) convertmoney FROM cr_lv0005 A where A.lv002='$vParent' AND A.lv003 in (select B.lv002 from sl_lv0037 B where B.lv003='".$vEmployeeID."')";
		else	
			$lvsql="select sum(lv006) convertmoney FROM cr_lv0005 A where A.lv002='$vParent' AND A.lv003 in (select B.lv002 from sl_lv0037 B where B.lv004='".$vEmployeeID."')";
		$vresult=db_query($lvsql);
		$vrow = db_fetch_array ($vresult);
		
		return $vrow['convertmoney'];
	}	
	function LV_GetStateTransport($vrow)
	{
		if($vrow['lv036']==0) 
			return 1;
		else
		{
			if(trim($vrow['lv010'])=='' || $vrow['lv010']==NULL)  
				return 1;
			else
			{
				if($vrow['lv037']==2) 
				{
					if($vrow['lv038']<2) return 3;
					else return 4;
				}
				else
				{
					if($vrow['lv035']==0) return 1;
					else return 2;
				}
				return 1;
			}
		}
		
	}
	function LV_GetSumAdvance($vID,$vopt)
	{
		$lvsql="select sum(A.lv003+lv005) convertmoney from sp_lv0035 A where A.lv002='$vID' AND A.lv016=$vopt";
		$vresult=db_query($lvsql);
		$vrow = db_fetch_array ($vresult);
		
		return $vrow['convertmoney'];
	}	
	///////////////Popup VIew//////////////////
	function LV_BuilPopup($lvList,$vArrCot,$bResult,$objid,$objvalue)
	{
		
		$lstArr=explode(",",$lvList);
		if($this->lang=='EN')
			$lvTrH="<tr class=\"lvhtable\"><td width=1% class=\"lvhtable\">No</td>@#01</tr>";
		else
			$lvTrH="<tr class=\"lvhtable\"><td width=1% class=\"lvhtable\">STT</td>@#01</tr>";
		$lvTr="<tr class=\"lvlinehtable@01\"><td>@03</td>@#01</tr>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=left><a href=\"javascript:PopupSelect('@01','$objid')\">@02</a></td>";
		$lvTdNo="<td align=left nowrap><a href=\"javascript:PopupSelect('@01','$objid')\">@02</a></td>";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			$strTrH=str_replace("@#01",$strH,$lvTrH);
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vrow[$vArrCot[$lstArr[$i]]]=str_replace($objvalue,"<font color=\"#FF0000\">".$objvalue."</font>",$vrow[$vArrCot[$lstArr[$i]]]);
				switch($lstArr[$i])
				{
					default:		
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$vArrCot[$lstArr[$i]]],(int)$this->ArrView[$lstArr[$i]])),$this->Align(str_replace("@01",$vrow['lv001'],$lvTd),(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		
		return $strTrH.$strTr;
	}
			//////////////////////Buil list////////////////////
//////////////////////Buil list////////////////////
	function LV_BuilList($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		if($curRow<0) $curRow=0;	$this->LV_CheckLock();
		//$this->isAdd=0;
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
		$lvHref="<span onclick=\"ProcessTextHiden(this)\"><a href=\"javascript:FunctRunning1('@01')\" style=\"text-decoration:none\">@02</a></span>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"2\">&nbsp;</td>";
		$lvTd="<td  class=\"#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT A.* FROM cr_lv0005  A  inner join cr_lv0004 C on A.lv002=C.lv001    WHERE A.lv011=1 and A.lv027=1   ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";		
		$strTrEnter="<td class=\"@#04\">&nbsp;</td><td class=\"@#04\"><input tabindex=2 type=\"checkbox\" name=\"qxtlvkeep\" value=1 ".(($this->tv001=='1')?'checked="true"':'')."/></td>";//<input type='hidden' name='qxtlv001' id='qxtlv001' value=''/><input onclick='Save()' tabindex='3' type='button' value='Thêm' style='width:80%'/></td>";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				$vTempF=str_replace("@01","<!--".$lstArr[$i]."-->",$lvTdF);
				$strF=$strF.$vTempF;
				$vTempEnter="";
				switch($lstArr[$i])
				{				
					/*case 'lv001':
						$vTempEnter='<td><input tabindex=2 type="textbox" style="width:40px" onblur="CheckLoadID(this.value)"/></td>';
						break;*/						
					case 'lv002':
						$vstr='
						
						';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv003':
						$vstr='
						<table style="width:100%">
							<tr>
							<td>
							  <ul id="pop-nav11" lang="pop-nav11" onMouseOver="ChangeName(this,11)" onkeyup="ChangeName(this,11)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="qxtlv003_search" id="qxtlv003_search" style="width:100%;height:27px;min-width:60px;" onKeyUp="LoadPopupParent(this,\'qxtlv003\',\'cr_lv0003\',\'concat(lv002,@! @!,lv001)\',2)" onFocus="LoadPopupParent(this,\'qxtlv003\',\'cr_lv0003\',\'concat(lv002,@! @!,lv001)\',2)" tabindex="2" >
							    <div id="lv_popup11" lang="lv_popup11"> </div>	
							</td>
							<td>
								<select class="selenterquick"   name="qxtlv003" id="qxtlv003" tabindex="2" style="width:100%;min-width:120px" onKeyPress="return CheckKey(event,7)">'.$this->LV_LinkFieldExt('lv003',$this->tv003).'</select>
							</td>
							</tr>
						</table>
						';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv004':
						$vstr='<div id="contactid"><textarea class="txtenterquick"  name="qxtlv004" type="text" id="qxtlv004" tabindex="2" maxlength="255" style="width:100%;min-width:120px;height:20px;" onKeyPress="return CheckKey(event,7)">'.$this->tv004.'</textarea></div>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv006':
						$vstr='
						<ul style="width:100%" id="pop-nav111" lang="pop-nav111" onMouseOver="ChangeName(this,111)" onKeyUp="ChangeName(this,111)"> <li class="menupopT">
												<input class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:100px;height:26px;text-align:center;" name="qxtlv006" id="qxtlv006" onKeyUp="LoadPopupParentTabIndex(event,this,\'qxtlv006\',\'hr_lv0020\',\'concat(lv002,@! @!,lv001)\')"  onKeyPress="return CheckKey(event,7)" tabindex="2" onblur="nguoiung_change(this.value)" value="'.$this->tv006.'">
												<div id="lv_popup111" lang="lv_popup111"> </div>						  
												</li>
											</ul>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv007':
						$vstr='
						<ul style="width:100%" id="pop-nav112" lang="pop-nav112" onMouseOver="ChangeName(this,112)" onKeyUp="ChangeName(this,112)"> <li class="menupopT">
												<input class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:100px;height:26px;text-align:center;" name="qxtlv007" id="qxtlv007" onKeyUp="LoadPopupParentTabIndex(event,this,\'qxtlv007\',\'hr_lv0020\',\'concat(lv002,@! @!,lv001)\')"  onKeyPress="return CheckKey(event,7)" tabindex="2" onblur="nguoiung_change(this.value)" value="'.$this->tv007.'">
												<div id="lv_popup112" lang="lv_popup112"> </div>						  
												</li>
											</ul>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;	
					case 'lv111':
						$vstr='<input class="txtenterquick"  autocomplete="off" name="qxtlv111" type="text" id="qxtlv111" value="'.$this->tv111.'" tabindex="2" maxlength="100" style="width:100%;min-width:120px" onKeyPress="return CheckKey(event,7)" ondblclick1="if(self.gfPop)gfPop.fPopCalendar(this);return false;">';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;	
					case 'lv008':
						$vstr='
						<ul style="width:100%" id="pop-nav113" lang="pop-nav113" onMouseOver="ChangeName(this,113)" onKeyUp="ChangeName(this,113)"> <li class="menupopT">
							<input class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:100px;height:26px;text-align:center;" name="qxtlv008" id="qxtlv008" onKeyUp="LoadPopupParentTabIndex(event,this,\'qxtlv008\',\'hr_lv0020\',\'concat(lv002,@! @!,lv001)\')"  onKeyPress="return CheckKey(event,7)" tabindex="2" onblur="nguoiung_change(this.value)" value="'.$this->tv008.'">
							<div id="lv_popup113" lang="lv_popup113"> </div>						  
							</li>
						</ul>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv005':
						$vstr='
						<table>
							<tr>
								<td>
								<input autocomplete="off" name="qxtlv005" type="text" id="qxtlv005" value="'.$this->tv005.'" tabindex="2" maxlength="50" style="width:100px" onKeyPress="return CheckKey(event,7)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmchoose.qxtlv005);return false;">
								</td>
								
								<td>
									<select name="qxtlv005_" type="text" id="qxtlv005_" value="'.$this->tv005_.'" tabindex="10" maxlength="50" style="width:100px;text-align:center;" onKeyPress="return CheckKey(event,7)">
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
					case 'lv013':
						$vstr='<select class="selenterquick"   name="qxtlv013" id="qxtlv013" tabindex="2" style="width:100%;min-width:120px" onKeyPress="return CheckKey(event,7)">'.$this->LV_LinkFieldExt('lv013',$this->tv013).'</select>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;	
					case 'lv015':
						$vstr='<select class="selenterquick"   name="qxtlv015" id="qxtlv015" tabindex="2" style="width:100%;min-width:120px" onKeyPress="return CheckKey(event,7)">'.$this->LV_LinkFieldExt('lv015',$this->tv015).'</select>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;	
					case 'lv014':
						$vstr='
						<table style="width:100%">
							<tr>
							<td>
								<ul id="pop-nav14" lang="pop-nav14" onMouseOver="ChangeName(this,14)" onkeyup="ChangeName(this,14)"> <li class="menupopT">
								<input type="text" autocomplete="off" class="search_img_btn" name="qxtlv014_search" id="qxtlv014_search" style="width:100%;height:27px;min-width:60px;" onKeyUp="LoadType(this)" onFocus="LoadType(this)" tabindex="2" >
								<div id="lv_popup14" lang="lv_popup14"> </div>	
							</td>
							<td>
								<input class="txtenterquick"  name="qxtlv014" type="text" id="qxtlv014" value="'.$this->tv014.'" tabindex="2" maxlength="255" style="width:100%;min-width:120px" onKeyPress="return CheckKey(event,7)"/>
							</td>
							</tr>
						</table>
						';
							$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
							break;
					/*case 'lv012':
						$vstr='<select class="selenterquick"   name="qxtlv012" id="qxtlv012" tabindex="2" style="width:100%;min-width:50px" onKeyPress="return CheckKey(event,7)">'.$this->LV_LinkFieldExt('lv012',$this->tv012).'</select>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;*/
					
					default:
						$vTempEnter="<td>&nbsp;</td>";
						break;
					
				}
				$strTrEnter=$strTrEnter.$vTempEnter;
			}
		if($this->isAdd==0) $strTrEnter='';
		$vData='111111111111111';	
		$vNumLine=0;
		while ($vrow = db_fetch_array ($bResult)){
			$vorder++;
			$strL="";
			//$vSumTongTien=$vSumTongTien+$vrow['lv004'];
			//$vTienAprQt=$this->LV_GetSumAdvance($vrow['lv001'],1);
		//	$vTienUnAprQt=$this->LV_GetSumAdvance($vrow['lv001'],0);
			//$vSumTongTienQT=$vSumTongTienQT+$vTienAprQt;
			//$vSumTongTienUnQT=$vSumTongTienUnQT+$vTienUnAprQt;
			//$vSumlv004=$vSumlv004+$vrow['lv004'];
			//$vSumlv005=$vSumlv005+$vTienAprQt;
			//$vSumlv016=$vSumlv016+$vrow['lv004']-$vTienAprQt;
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{	
					case 'lv199':
						$vChucNang="<span onclick=\"ProcessTextHiden(this)\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
						<tr>
						";
						$vChucNang=$vChucNang.'<td><a href="javascript:FunctRunning1(\''.$vrow['lv001'].'\')"><img style="cursor:pointer;width:25px;;padding:5px;"  alt="NoImg" src="../images/icon/work_experience.png" align="middle" border="0" name="new" class="lviconimg"></a></td>';
						if($this->GetEdit()==1)
						{
							$vChucNang=$vChucNang.'
							<td><img Title="'.(($vrow['lv027']==0)?'Edit':'View').'" style="cursor:pointer;width:25px;padding:5px;" onclick="Edit(\''.($vrow['lv001']).'\')" alt="NoImg" src="../images/icon/'.(($vrow['lv027']==0)?'Edt.png':'detail.png').'" align="middle" border="0" name="new" class="lviconimg"></td>
							';
						}
						if($this->GetApr()==1)
						{
							$vChucNang=$vChucNang.'
							<td><input style="padding:3px;width:60px" type="button" value="Duyệt" onclick="Approvals(\''.$vrow['lv001'].',\')"/></td>
							';
						}
						if($this->GetUnApr()==1)
						{
							$vChucNang=$vChucNang.'
							<td><input style="padding:3px;width:60px" type="button" value="Trả lại" onclick="UnApprovals(\''.$vrow['lv001'].',\')"/></td>
							';
						}
						$vChucNang=$vChucNang."</tr></table></span>";
						/*$vChucNang='
						<img style="cursor:pointer;height:25px;padding:5px;" onclick="Report(\''.base64_encode($vrow['lv001']).'\')" alt="NoImg" src="../images/icon/Rpt.png" align="middle" border="0" name="new" class="lviconimg">
						<span onclick="ProcessTextHiden(this)"><a href="javascript:FunctRunning1(\''.$vrow['lv001'].'\')"><img style="cursor:pointer;width:25px;;padding:5px;"  alt="NoImg" src="../images/icon/work_experience.png" align="middle" border="0" name="new" class="lviconimg"></a></span>
						';*/
						$vStr='	
						';
						/*
						$vStr1='
								<div style="cursor:pointer;color:blue;" onclick="showDetailHD(\'chitietid_'.$vrow['lv001'].'\',\''.$vrow['lv001'].'\')">'.'<img style="cursor:pointer;width:25px;;padding:5px;"  alt="NoImg" src="../images/icon/job.png" title="Xem Chi tiết hợp đồng"/>'.'</div>
								<div style="display:none;position:absolute;z-index:999999999999;background:#efefef;" id="chitietid_'.$vrow['lv001'].'" class="noidung_member">					
									<div class="hd_cafe" style="width:100%">
										<ul class="qlycafe" style="width:100%">
											<li style="padding:10px;"><img onclick="document.getElementById(\'chitietid_'.$vrow['lv001'].'\').style.display=\'none\';" width="20" src="images/icon/close.png"/></li>
											<li style="padding:10px;"><div style="width:100%;padding-top:2px;">
											<strong>CHI TIẾT HỢP ĐỒNG:'.$vrow['lv112'].' ['.$vrow['lv010'].'-'.$this->ArrStaff[$vrow['lv010']][2].']</strong></div>
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
								';*/
								$vChucNang=$vStr.$vChucNang;
						$vTemp=str_replace("@02",$vChucNang,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));						
						break;	
					case 'lv012':
						if($this->GetApr()==1)
						{
							$lvTdTextBox='
							<td align=center>
								<table>
									<tr>
										<td>
										<input autocomplete="off" onfocus="if(this.value==\'\') this.value=this.title;" title="'.$this->FormatView($vrow['lv023'],22).'" onblur="UpdateText(this,\''.$vrow['lv001'].'\',12)" value="'.$this->FormatView($vrow['lv012'],22).'" tabindex="2" maxlength="50" style="width:120px" onKeyPress="return CheckKey(event,7)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmchoose.qxtlv005);return false;">
										</td>
										
									</tr>
								</table>
							</td>';
						
						$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],0),$this->Align(str_replace("@01",$vrow['lv001'],$lvTdTextBox),(int)$this->ArrView[$lstArr[$i]]));	
							break;
						}
						else
						{
							$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						}
						break;
					case 'lv026':
						if($this->GetApr()==1)
						{
							$vlv002=$vrow['lv026'];
							$lvTdTextBox="<td align=center><textarea class='txtenterquick' type=\"textbox\"  @03 onblur=\"UpdateText(this,'".$vrow['lv001']."',26)\" style=\"min-width:120px;width:100%;text-align:left\" tabindex=\"2\"  maxlength=\"100\" >".$vlv002."</textarea></td>";
							//$lvTdTextBox="<td align=center><input class='txtenterquick' type=\"textbox\" value=\"".$vlv002."\" @03 onfocus=\"if(this.value=='') this.value='".$vlv009."'\" onblur=\"UpdateText(this,'".$vrow['lv001']."',26)\" style=\"min-width:120px;width:100%;text-align:center\" tabindex=\"2\"  maxlength=\"100\" /></td>";
							$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],0),$this->Align(str_replace("@01",$vrow['lv001'],$lvTdTextBox),(int)$this->ArrView[$lstArr[$i]]));	
							break;
						}
						else
						{
							$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						}
						break;
					case 'lv016':
						if($this->GetApr()==1)
						{										
								$lvTdTextBox="<td align=center><input class='txtenterquick'  onblur=\"UpdateTextCheck(this,'".$vrow['lv001']."',16)\" type=\"checkbox\" value=\"1\" ".(($vrow['lv016']==1)?'checked="true"':'')." @03  style=\"width:35px;text-align:center;\" tabindex=\"2\" maxlength=\"32\"   onKeyPress=\"return CheckKey(event,7)\"/></td>";
								$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],0),$this->Align(str_replace("@01",$vrow['lv001'],$lvTdTextBox),(int)$this->ArrView[$lstArr[$i]]));	
								break;
						}
						else
							$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv015':
						if($this->GetApr()==1)
						{
							$lvTdTextBox="<td align=@#05>
							<select class='txtenterquick' type=\"textbox\" value=\"@02\" @03 onblur=\"UpdateText(this,'".$vrow['lv001']."',15)\" style=\"width:90px\" tabindex=\"2\" >".$this->LV_LinkFieldExt('lv015',$vrow['lv015'])."</select></td>";
							$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]),$this->Align(str_replace("@01",$vrow['lv001'],$lvTdTextBox),(int)$this->ArrView[$lstArr[$i]]));	
						}
						else
							$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv004';
						$vrow[$lstArr[$i]]=str_replace("\n\r","<br/>",$vrow[$lstArr[$i]]);
						$vrow[$lstArr[$i]]=str_replace("\r\n","<br/>",$vrow[$lstArr[$i]]);
						$vrow[$lstArr[$i]]=str_replace("\n","<br/>",$vrow[$lstArr[$i]]);
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					
					default:
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
		}
		$strTr=str_replace("@#99",$vNumLine,$strTr);
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv004-->",$this->FormatView($vSumlv004,10),$strF);
		$strF=str_replace("<!--lv005-->",$this->FormatView($vSumlv005,10),$strF);
		$strF=str_replace("<!--lv015-->",$this->FormatView($vSumlv015,10),$strF);
		$strF=str_replace("<!--lv016-->",$this->FormatView($vSumlv016,10),$strF);
		//$strF=str_replace("<!--lv053-->",$this->FormatView($vSumlv053,10),$strF);
		//$lvTable=str_replace("@#02",$strF,$lvTable);
		$lvTable=str_replace("@#02",'',$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH."<tr class='lvlinehtable0'>".$strTrEnter."</tr>".$strTr,$lvTable);
	}
	function LV_BuilListDuyetCong($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		$this->LV_CheckLock();
		//$this->isAdd=0;
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
		$lvHref="<span onclick=\"ProcessTextHiden(this)\"><a href=\"javascript:FunctRunning1('@01')\" style=\"text-decoration:none\">@02</a></span>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\" nowrap>@02</td>";
		$lvTdF="<td align=\"right\" nowrap><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"1\">&nbsp;</td>";
		$lvTd="<td  class=\"#04\" align=\"@#05\" nowrap>@02</td>";
		$vCondition='';
		if($this->lv013!='')
		{
			$vCondition=$vCondition." and A.lv013='$this->lv013'";
		}
		if($this->lv014!='')
		{
			$vCondition=$vCondition." and A.lv014='$this->lv014'";
		}
		$sqlS = "SELECT A.* FROM cr_lv0005  A  inner join cr_lv0004 C on A.lv002=C.lv001    WHERE A.lv011=1 and A.lv027>=0  and A.lv003='DUYETCONG' $vCondition";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		if($this->Count==0) return '';
		$strTrH="";
		$strH = "";		
		$strTrEnter="<td class=\"@#04\">&nbsp;</td><td class=\"@#04\"><input tabindex=2 type=\"checkbox\" name=\"qxtlvkeep\" value=1 ".(($this->tv001=='1')?'checked="true"':'')."/></td>";//<input type='hidden' name='qxtlv001' id='qxtlv001' value=''/><input onclick='Save()' tabindex='3' type='button' value='Thêm' style='width:80%'/></td>";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				$vTempF=str_replace("@01","<!--".$lstArr[$i]."-->",$lvTdF);
				$strF=$strF.$vTempF;
				
			}
		$strTrEnter='';
		$vData='111111111111111';	
		$vNumLine=0;
		while ($vrow = db_fetch_array ($bResult)){
			$vorder++;
			$strL="";
			//$vSumTongTien=$vSumTongTien+$vrow['lv004'];
			//$vTienAprQt=$this->LV_GetSumAdvance($vrow['lv001'],1);
		//	$vTienUnAprQt=$this->LV_GetSumAdvance($vrow['lv001'],0);
			//$vSumTongTienQT=$vSumTongTienQT+$vTienAprQt;
			//$vSumTongTienUnQT=$vSumTongTienUnQT+$vTienUnAprQt;
			//$vSumlv004=$vSumlv004+$vrow['lv004'];
			//$vSumlv005=$vSumlv005+$vTienAprQt;
			//$vSumlv016=$vSumlv016+$vrow['lv004']-$vTienAprQt;
			$isEdit=false;
			if($vrow['lv027']==1) $isEdit=true;
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{	
					case 'lv199':
						$vChucNang="<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
						<tr>
						";
						if($vrow['lv027']==0)
						{
							$vChucNang=$vChucNang.'
							<td>Chưa đề xuất duyệt</td>
							';
						}
						elseif($vrow['lv027']==1)
						{
							if($this->GetApr()==1 && $this->GetUnApr()==1)
							{
								$visOK=$this->LV_GetDaDuyetTK($vrow['lv001'],'AprTK');
								if($visOK)
								{
									$vChucNang=$vChucNang."<td align=center><table style=\"border:1px #f3b12b solid;border-radius:5px;\"><tr><td height=\"20\"><input class='txtenterquick' style=\"height:15px\" type=\"checkbox\" checked=\"true\" onclick=\"return false;\"/></td><td>Trợ lý đã duyệt</td></tr></table></td>";
										$vChucNang=$vChucNang.'
									<td><input type="button" value="Duyệt công"  style="cursor:pointer;width:90px;padding:2px;" onclick="Approvals(\''.($vrow['lv001']).'\')" ></td>
									';
								}
								
							}
							else
							{
								$visOK=$this->LV_GetDaDuyetTK($vrow['lv001'],'AprTK');
								if(!$visOK)
								{
								$vChucNang=$vChucNang.'
								<td><input type="button" value="Trợ lý duyệt"  style="cursor:pointer;width:120px;padding:2px;" onclick="ApprovalsThamKhao(\''.($vrow['lv001']).'\')" ></td>
								<td><input type="button" value="Trợ lý trả lại"  style="cursor:pointer;width:120px;padding:2px;" onclick="UnApprovalsThamKhao(\''.($vrow['lv001']).'\')" ></td>
								';
								}
								else
								{
									$vChucNang=$vChucNang."<td align=center><table style=\"border:1px #f3b12b solid;border-radius:5px;\"><tr><td height=\"20\"><input class='txtenterquick' style=\"height:15px\" type=\"checkbox\" checked=\"true\" onclick=\"return false;\"/></td><td>Trợ lý đã duyệt</td></tr></table></td>";
								}
							}
							$vStr1='<td>
										<div style="cursor:pointer;color:blue;" onclick="showDetailHistory(\'chitietid_'.$vrow['lv001'].'\',\''.$vrow['lv001'].'\')">'.'<img style="cursor:pointer;width:25px;;padding:5px;"  alt="NoImg" src="../images/icon/license.png" title="Xem lịch sử duyệt"/>'.'</div>
										<div style="display:none;position:absolute;z-index:999999999999;background:#efefef;" id="chitietid_'.$vrow['lv001'].'" class="noidung_member">					
											<div class="hd_cafe" style="width:100%">
												<ul class="qlycafe" style="width:100%">
													<li style="padding:10px;"><img onclick="document.getElementById(\'chitietid_'.$vrow['lv001'].'\').style.display=\'none\';" width="20" src="images/icon/close.png"/></li>
													<li style="padding:10px;"><div style="width:100%;padding-top:2px;">
													<strong>LỊCH SỬ CÔNG VIỆC: '.$vrow['lv004'].'</strong></div>
													</li>
												</ul>
											</div>
											<div id="chitietlichsu_'.$vrow['lv001'].'" style="min-width:360px;overflow:hidden;"></div>
											<div width="100%;height:40px;">
												<center>
													<div style="width:160px;border-radius:5px;cursor:pointer;height:30px;padding-top:10px;" onclick="document.getElementById(\'chitietid_'.$vrow['lv001'].'\').style.display=\'none\';">ĐÓNG LẠI</div>
												</center>
											</div>
										</div>	
									</td>
									';
							$vChucNang=$vChucNang.$vStr1;
						}
						else
						{
							$vChucNang=$vChucNang.'
							<td><input type="button" value="Trả lại"  style="cursor:pointer;width:90px;padding:2px;" onclick="UnApprovals(\''.($vrow['lv001']).'\')" ></td>
							';
						}
						/*
						$vStr='<td>
								<div style="cursor:pointer;color:blue;" onclick="showDetailHD(\'chitietid_'.$vrow['lv001'].'\',\''.$vrow['lv001'].'\')">'.'<img style="cursor:pointer;width:25px;;padding:5px;"  alt="NoImg" src="../images/icon/job.png" title="Xem Chi tiết hợp đồng"/>'.'</div>
								<div style="display:none;position:absolute;z-index:999999999999;background:#efefef;" id="chitietid_'.$vrow['lv001'].'" class="noidung_member">					
									<div class="hd_cafe" style="width:100%">
										<ul class="qlycafe" style="width:100%">
											<li style="padding:10px;"><img onclick="document.getElementById(\'chitietid_'.$vrow['lv001'].'\').style.display=\'none\';" width="20" src="images/icon/close.png"/></li>
											<li style="padding:10px;"><div style="width:100%;padding-top:2px;">
											<strong>ĐÍNH KÈM TẬP TIN VÀ PHẢN HỒI</strong></div>
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
								</td>
								';
						$vChucNang=$vChucNang.$vStr."</tr></table>";
						*/
						$vChucNang=$vChucNang."</tr></table>";
						$vTemp=str_replace("@02",$vChucNang,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));						
						break;	
					case 'lv012':
						if($this->GetApr()==1 && $isEdit)
						{
							$lvTdTextBox='
							<td align=center>
								<table>
									<tr>
										<td>
										<input autocomplete="off" onfocus="if(this.value==\'\') this.value=this.title;" title="'.$this->FormatView($vrow['lv023'],22).'" onblur="UpdateText(this,\''.$vrow['lv001'].'\',12)" value="'.$this->FormatView($vrow['lv012'],22).'" tabindex="2" maxlength="50" style="width:120px" onKeyPress="return CheckKey(event,7)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmchoose.qxtlv005);return false;">
										</td>
										
									</tr>
								</table>
							</td>';
						
						$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],0),$this->Align(str_replace("@01",$vrow['lv001'],$lvTdTextBox),(int)$this->ArrView[$lstArr[$i]]));	
							break;
						}
						else
						{
							$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						}
						break;
					case 'lv026':
						if($this->GetApr()==1 && $isEdit)
						{
							$vlv002=$vrow['lv026'];
							$lvTdTextBox="<td align=center><input class='txtenterquick' type=\"textbox\" value=\"".$vlv002."\" @03 onfocus=\"if(this.value=='') this.value='".$vlv009."'\" onblur=\"UpdateText(this,'".$vrow['lv001']."',26)\" style=\"min-width:120px;width:100%;text-align:center\" tabindex=\"2\"  maxlength=\"100\" /></td>";
							$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],0),$this->Align(str_replace("@01",$vrow['lv001'],$lvTdTextBox),(int)$this->ArrView[$lstArr[$i]]));	
							break;
						}
						else
						{
							$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						}
						break;
					case 'lv016':
						if($this->GetApr()==1 && $isEdit)
						{										
								$lvTdTextBox="<td align=center><input class='txtenterquick'  onblur=\"UpdateTextCheck(this,'".$vrow['lv001']."',16)\" type=\"checkbox\" value=\"1\" ".(($vrow['lv016']==1)?'checked="true"':'')." @03  style=\"width:35px;text-align:center;\" tabindex=\"2\" maxlength=\"32\"   onKeyPress=\"return CheckKey(event,7)\"/></td>";
								$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],0),$this->Align(str_replace("@01",$vrow['lv001'],$lvTdTextBox),(int)$this->ArrView[$lstArr[$i]]));	
								
						}
						else
						{
							$lvTdTextBox="<td align=center><input disabled=\"disabled\" class='txtenterquick'  onblur=\"UpdateTextCheck(this,'".$vrow['lv001']."',16)\" type=\"checkbox\" value=\"1\" ".(($vrow['lv016']==1)?'checked="true"':'')." @03  style=\"width:35px;text-align:center;\" tabindex=\"2\" maxlength=\"32\"   onKeyPress=\"return CheckKey(event,7)\"/></td>";
							$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],0),$this->Align(str_replace("@01",$vrow['lv001'],$lvTdTextBox),(int)$this->ArrView[$lstArr[$i]]));	
						}
						break;
					case 'lv015':
						if($this->GetApr()==1 && $isEdit)
						{
							$lvTdTextBox="<td align=@#05>
							<select class='txtenterquick' type=\"textbox\" value=\"@02\" @03 onblur=\"UpdateText(this,'".$vrow['lv001']."',15)\" style=\"width:90px\" tabindex=\"2\" >".$this->LV_LinkFieldExt('lv015',$vrow['lv015'])."</select></td>";
							$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]),$this->Align(str_replace("@01",$vrow['lv001'],$lvTdTextBox),(int)$this->ArrView[$lstArr[$i]]));	
						}
						else
						{
							$lvTdTextBox="<td align=@#05>
							<select disabled=\"disabled\" class='txtenterquick' type=\"textbox\" value=\"@02\" @03  style=\"width:90px\" tabindex=\"2\" >".$this->LV_LinkFieldExt('lv015',$vrow['lv015'])."</select></td>";
							$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]),$this->Align(str_replace("@01",$vrow['lv001'],$lvTdTextBox),(int)$this->ArrView[$lstArr[$i]]));	
						}
						break;
					default:
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
		}
		$strTr=str_replace("@#99",$vNumLine,$strTr);
		$strF=$strF."</tr>";
		//$strF=str_replace("<!--lv004-->",$this->FormatView($vSumlv004,10),$strF);
		//$strF=str_replace("<!--lv005-->",$this->FormatView($vSumlv005,10),$strF);
		//$strF=str_replace("<!--lv015-->",$this->FormatView($vSumlv015,10),$strF);
		//$strF=str_replace("<!--lv016-->",$this->FormatView($vSumlv016,10),$strF);
		//$strF=str_replace("<!--lv053-->",$this->FormatView($vSumlv053,10),$strF);
		//$lvTable=str_replace("@#02",$strF,$lvTable);
		$lvTable=str_replace("@#02",'',$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH."<tr class='lvlinehtable0'>".$strTrEnter."</tr>".$strTr,$lvTable);
	}
	function LV_GetMoneyEmp($vContractID,$vopt=0,$vlock='',$vEmpId)
	{
		//$vList=$this->LV_GetDetail($vContractID);
		if($vopt==0)
		{
			if($vlock=='')			$lvsql="select sum(lv004)  money FROM cr_lv0005 where lv008='$vEmpId' $vCondition";	
			elseif($vlock=='0') $lvsql="select sum(lv004)  money FROM cr_lv0005 where lv008='$vEmpId' $vCondition and lv011=0";	
			elseif($vlock=='1') $lvsql="select sum(lv004)  money FROM cr_lv0005 where lv008='$vEmpId' $vCondition and lv011>=1";	
			elseif($vlock=='2') $lvsql="select sum(lv004)  money FROM cr_lv0005 where lv008='$vEmpId' $vCondition and lv011=1 and lv016=1";	
		}
		else
		{
			$lvsql="select sum(A.lv003+lv005) money from sp_lv0035 A where A.lv016=1 and A.lv002 in ( select BB.lv001   FROM cr_lv0005 BB where BB.lv008='$vEmpId' and  BB.lv002 in ($vList) $vCondition)";	
		}
		$vresult=db_query($lvsql);
		$vrow = db_fetch_array ($vresult);
		return (float)$vrow['money'];
	}
	/*function LV_BuilList($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		if($curRow<0) $curRow=0;	$this->PlanID=$vPlanID;
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
		<table  align=\"center\" class=\"lvtable\"><!--<tr ><td colspan=\"".(2+count($lstArr))."\" class=\"lvTTable\">".$this->ArrPush[0]."</td></tr>-->
		@#01
		@#02
		<tr ><td colspan=\"".(count($lstArr)+2)."\">$paging</td></tr>
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
		$strF="<tr><td colspan=\"2\">&nbsp;</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$lvTd="<td align=@#05 class=@#04>@02</td>";
		$sqlS = "select * from (SELECT A.lv008 lv001,A.lv008 lv002,B.lv029 lv011,sum(A.lv004) lv003 FROM cr_lv0005 A inner  join hr_lv0020 B on A.lv008=B.lv001   WHERE A.lv011=1 and A.lv027=1  group by A.lv008) MP order by MP.lv011";
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
		$strF=$strF."</tr>";
		$vTotalAll=0;
		$vTotalUnproval=0;
		$vTotalAproval=0;
		$vTotalAprovalNew=0;
		$vTotalPayment=0;
		$vTotalPC=0;
		$vTotalPT=0;
		$vDepID='11111111111111111';
		while ($vrow = db_fetch_array ($bResult)){
			if($vDepID!=$vrow['lv011'])
			{
				if($vDepID!='11111111111111111')
				{
					$vStrFF=$strF;
					$vStrFF=str_replace("<!--lv003-->",$this->FormatView($vTotalAll1,10),$vStrFF);
					$vStrFF=str_replace("<!--lv004-->",$this->FormatView($vTotalUnproval1,10),$vStrFF);
					$vStrFF=str_replace("<!--lv005-->",$this->FormatView($vTotalAproval1,10),$vStrFF);
					$vStrFF=str_replace("<!--lv006-->",$this->FormatView($vTotalPayment1,10),$vStrFF);
					$vStrFF=str_replace("<!--lv007-->",$this->FormatView($vTotalAproval1-$vTotalPayment1,10),$vStrFF);
					$vStrFF=str_replace("<!--lv008-->",$this->FormatView($vTotalPC1,10),$vStrFF);
					$vStrFF=str_replace("<!--lv009-->",$this->FormatView($vTotalPT1,10),$vStrFF);
					$vStrFF=str_replace("<!--lv010-->",$this->FormatView($vTotalPC1-$vTotalPayment1-$vTotalPT1,10),$vStrFF);
					$vStrFF=str_replace("<!--lv012-->",$this->FormatView($vTotalAprovalNew1,10),$vStrFF);
					$strTr=$strTr.$vStrFF;
					$vTotalAll1=0;
					$vTotalUnproval1=0;
					$vTotalAproval1=0;
					$vTotalPayment1=0;
					$vTotalPC1=0;
					$vTotalPT1=0;
					$vTotalAprovalNew=0;
				}
				$vDepID=$vrow['lv011'];
			}
			$strL="";
			$vorder++;
			$vAmountAll=$vrow['lv003'];//tong de xuat
			$vTotalAll=$vTotalAll+$vAmountAll;
			$vTotalAll1=$vTotalAll1+$vAmountAll;
			$vAmountUnproval=$this->LV_GetMoneyEmp($vPlanID,0,'0',$vrow['lv001']);//tong chua duyet
			$vTotalUnproval=$vTotalUnproval+$vAmountUnproval;
			$vTotalUnproval1=$vTotalUnproval1+$vAmountUnproval;
			$vAmountAproval=$this->LV_GetMoneyEmp($vPlanID,0,'1',$vrow['lv001']);//tong da duyet
			$vTotalAprovalNew=$this->LV_GetMoneyEmp($vPlanID,0,'2',$vrow['lv001']);//tong da duyet
			$vTotalAprovalNew1=$vTotalAprovalNew1+$vTotalAprovalNew;
			$vTotalAproval=$vTotalAproval+$vAmountAproval;
			$vTotalAproval1=$vTotalAproval1+$vAmountAproval;
			$vAmountPayment=$this->LV_GetMoneyEmp($vPlanID,1,'2',$vrow['lv001']);//tong da chi
			$vTotalPayment=$vTotalPayment+$vAmountPayment;
			$vTotalPayment1=$vTotalPayment1+$vAmountPayment;
			$vAmountPC=$this->LV_GetAmountPCEmp($vPlanID,$vrow['lv001']);//tong da chi
			$vTotalPC=$vTotalPC+$vAmountPC;
			$vTotalPC1=$vTotalPC1+$vAmountPC;
			$vAmountPT=$this->LV_GetAmountPTEmp($vPlanID,$vrow['lv001']);//tong da thu
			$vTotalPT=$vTotalPT+$vAmountPT;
			$vTotalPT1=$vTotalPT1+$vAmountPT;
			for($i=0;$i<count($lstArr);$i++)
			{				
				switch($lstArr[$i])
				{
					case 'lv004':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vAmountUnproval,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv012':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vTotalAprovalNew,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv005':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vAmountAproval,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv006':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vAmountPayment,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv007':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vAmountAproval-$vAmountPayment,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv008':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vAmountPC,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv009':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vAmountPT,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv010':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vAmountPC-$vAmountPayment-$vAmountPT,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						
						break;
				}
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv008']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else if($vrow['lv008']==2)		$strTr=str_replace("@#04","lvlineapproval_level2",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
		}
		$vStrFF=$strF;
		$vStrFF=str_replace("<!--lv003-->",$this->FormatView($vTotalAll1,10),$vStrFF);
		$vStrFF=str_replace("<!--lv004-->",$this->FormatView($vTotalUnproval1,10),$vStrFF);
		$vStrFF=str_replace("<!--lv005-->",$this->FormatView($vTotalAproval1,10),$vStrFF);
		$vStrFF=str_replace("<!--lv012-->",$this->FormatView($vTotalAprovalNew1,10),$vStrFF);
		$vStrFF=str_replace("<!--lv006-->",$this->FormatView($vTotalPayment1,10),$vStrFF);
		$vStrFF=str_replace("<!--lv007-->",$this->FormatView($vTotalAproval1-$vTotalPayment1,10),$vStrFF);
		$vStrFF=str_replace("<!--lv008-->",$this->FormatView($vTotalPC1,10),$vStrFF);
		$vStrFF=str_replace("<!--lv009-->",$this->FormatView($vTotalPT1,10),$vStrFF);
		$vStrFF=str_replace("<!--lv010-->",$this->FormatView($vTotalPC1-$vTotalPayment1-$vTotalPT1,10),$vStrFF);
		$strTr=$strTr.$vStrFF;
					
		$strF=str_replace("<!--lv003-->",$this->FormatView($vTotalAll,10),$strF);
		$strF=str_replace("<!--lv004-->",$this->FormatView($vTotalUnproval,10),$strF);
		$strF=str_replace("<!--lv005-->",$this->FormatView($vTotalAproval,10),$strF);
		$strF=str_replace("<!--lv012-->",$this->FormatView($vTotalAprovalNew,10),$strF);
		$strF=str_replace("<!--lv006-->",$this->FormatView($vTotalPayment,10),$strF);
		$strF=str_replace("<!--lv007-->",$this->FormatView($vTotalAproval-$vTotalPayment,10),$strF);
		$strF=str_replace("<!--lv008-->",$this->FormatView($vTotalPC,10),$strF);
		$strF=str_replace("<!--lv009-->",$this->FormatView($vTotalPT,10),$strF);
		$strF=str_replace("<!--lv010-->",$this->FormatView($vTotalPC-$vTotalPayment-$vTotalPT,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}*/
	function LV_GetAmountPCEmp($vlv001,$vEmpId)
	{
		$vReturn="";
		$lvsql="select sum(A.lv004) SumMoney from ac_lv0005 A where A.lv002 in(select BB.lv001 from  ac_lv0004 BB Where BB.lv003='PLAN' and BB.lv004='$vlv001' and BB.lv008='$vEmpId'  and BB.lv002=1)";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		
		if($vrow){
			return (float)$vrow['SumMoney'];			
		}
		return 0;
	}
	function LV_GetAmountPTEmp($vlv001,$vEmpId)
	{
		$vReturn="";
		$lvsql="select sum(A.lv004) SumMoney from ac_lv0005 A where A.lv002 in(select BB.lv001 from  ac_lv0004 BB Where BB.lv003='PLAN' and BB.lv004='$vlv001'  and BB.lv008='$vEmpId' and BB.lv002=0)";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		
		if($vrow){
			return (float)$vrow['SumMoney'];			
		}
		return 0;
	}
	function LV_GetAmountPT($vlv001)
	{
		$vReturn="";
		$lvsql="select sum(A.lv004) SumMoney from ac_lv0005 A where A.lv002 in(select BB.lv001 from  ac_lv0004 BB Where BB.lv003='PLAN' and BB.lv004='$vlv001'  and BB.lv002=0)";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		
		if($vrow){
			return (float)$vrow['SumMoney'];			
		}
		return 0;
	}
	function LV_BuilListNoEnter($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
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
		$lvHref="<span onclick=\"ProcessTextHiden(this)\"><a href=\"javascript:FunctRunning1('@01')\" style=\"text-decoration:none\">@02</a></span>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"4\">&nbsp;</td>";
		$lvTd="<td  class=\"#04\" align=\"@#05\">@02</td>";
		//$sqlS = "SELECT A.* FROM cr_lv0005 A  WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$sqlS = "SELECT A.* FROM cr_lv0005  A  inner join cr_lv0004 C on A.lv002=C.lv001   WHERE A.lv011=1 and A.lv027=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";		
		$strTrEnter="<td class=\"@#04\">&nbsp;</td><td class=\"@#04\"><input tabindex=2 type=\"checkbox\" name=\"qxtlvkeep\" value=1 ".(($this->tv001=='1')?'checked="true"':'')."/></td>";//<input type='hidden' name='qxtlv001' id='qxtlv001' value=''/><input onclick='Save()' tabindex='3' type='button' value='Thêm' style='width:80%'/></td>";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;				
			}
		$vData='111111111111111';	
		$vNumLine=0;
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			//$vSumTongTien=$vSumTongTien+$vrow['lv004'];
			$vTienAprQt=$this->LV_GetSumAdvance($vrow['lv001'],1);
			$vTienUnAprQt=$this->LV_GetSumAdvance($vrow['lv001'],0);
			//$vSumTongTienQT=$vSumTongTienQT+$vTienAprQt;
			$vSumTongTienUnQT=$vSumTongTienUnQT+$vTienUnAprQt;
			$vSumlv004=$vSumlv004+$vrow['lv004'];
			$vSumlv005=$vSumlv005+$vTienAprQt;
			$vSumlv016=$vSumlv016+$vrow['lv004']-$vTienAprQt;
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{	
					case 'lv005':
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vTienAprQt,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv015':
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vTienUnAprQt,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv016':
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv004']-$vTienAprQt,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv017':
						if($vrow['lv011']=='2')
						{
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv017'],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						}
						else
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView('',(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv007':
						if($this->GetEdit()==1 && $vrow['KH']=='1' && $vrow['KT']=='1' && $vrow['lv011']=='1')
						{
							$lvTdTextBox="<td align=@#05><input class='txtenterquick' type=\"textbox\" value=\"@02\" @03 onblur=\"UpdateText(this,'".$vrow['lv001']."',50)\" style=\"width:120px\" tabindex=\"2\"  maxlength=\"255\"   onKeyPress=\"return CheckKey(event,7)\"/></td>";
							$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]),$this->Align(str_replace("@01",$vrow['lv001'],$lvTdTextBox),(int)$this->ArrView[$lstArr[$i]]));	
						}
						else
							$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
		}
		$strTr=str_replace("@#99",$vNumLine,$strTr);
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv004-->",$this->FormatView($vSumlv004,10),$strF);
		$strF=str_replace("<!--lv005-->",$this->FormatView($vSumlv005,10),$strF);
		$strF=str_replace("<!--lv015-->",$this->FormatView($vSumlv015,10),$strF);
		$strF=str_replace("<!--lv016-->",$this->FormatView($vSumlv016,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH."<tr class='lvlinehtable0'>".$strTrEnter."</tr>".$strTr,$lvTable);
	}
/////////////////////ListFieldExport//////////////////////////
//////////////////////Buil list////////////////////
	function LV_BuilListReportOther($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$vTax)
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
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"1\">&nbsp;</td>";
		$vCondition='';
		if($this->lv904!='')
		{
			$vCondition=$vCondition." and C.lv004='$this->lv904'";
		}
		if($this->lv002!='')
		{
			$vCondition=$vCondition." and A.lv002='$this->lv002'";
		}
		$sqlS = "SELECT A.* FROM cr_lv0005  A  inner join cr_lv0004 C on A.lv002=C.lv001  WHERE 1=1 and $vCondition  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
		//$sqlS = "SELECT * FROM cr_lv0005 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
			//$vSumTongTien=$vSumTongTien+$vrow['lv004'];
			$vTienAprQt=$this->LV_GetSumAdvance($vrow['lv001'],1);
			$vTienUnAprQt=$this->LV_GetSumAdvance($vrow['lv001'],0);
			//$vSumTongTienQT=$vSumTongTienQT+$vTienAprQt;
			$vSumTongTienUnQT=$vSumTongTienUnQT+$vTienUnAprQt;
			$vSumlv004=$vSumlv004+$vrow['lv004'];
			$vSumlv005=$vSumlv005+$vTienAprQt;
			$vSumlv016=$vSumlv016+$vrow['lv004']-$vTienAprQt;
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{	
					case 'lv005':
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vTienAprQt,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv015':
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vTienUnAprQt,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv016':
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv004']-$vTienAprQt,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}

				
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv004-->",$this->FormatView($vSumlv004,10),$strF);
		$strF=str_replace("<!--lv005-->",$this->FormatView($vSumlv005,10),$strF);
		$strF=str_replace("<!--lv015-->",$this->FormatView($vSumlv015,10),$strF);
		$strF=str_replace("<!--lv016-->",$this->FormatView($vSumlv016,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
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
			window.open('".$this->Dir."cr_lv0086/?lang=".$this->lang."&childfunc='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"1\">&nbsp;</td>";
		if($this->lv009!='')
		{
			$vCondition=$vCondition." and A.lv009='$this->lv009'";
		}
		if($this->lv002!='')
		{
			$vCondition=$vCondition." and A.lv002='$this->lv002'";
		}
		$sqlS = "SELECT A.*,BB.lv029 lv099,DATEDIFF(CURDATE(),A.lv010) lv017,B.lv036 KH,B.lv039 KT,B.lv003 lv018,B.lv006 lv019,B.lv008 lv020,B.lv019 lv021,B.lv017 lv022,B.lv010 lv023,B.lv011 lv024,B.lv025 lv025,B.lv026 lv026,B.lv088 lv088,B.lv024 lv094,BB.lv014 lv201 FROM cr_lv0005  A  inner join cr_lv0004 C on A.lv002=C.lv001 left  join hr_lv0020 BB on A.lv008=BB.lv001 left join sp_lv0008 B on B.lv001=A.lv112    WHERE A.lv011=1 and A.lv027=1   ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
		//$sqlS = "SELECT * FROM cr_lv0005 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
			//$vSumTongTien=$vSumTongTien+$vrow['lv004'];
			$vTienAprQt=$this->LV_GetSumAdvance($vrow['lv001'],1);
			$vTienUnAprQt=$this->LV_GetSumAdvance($vrow['lv001'],0);
			//$vSumTongTienQT=$vSumTongTienQT+$vTienAprQt;
			$vSumTongTienUnQT=$vSumTongTienUnQT+$vTienUnAprQt;
			$vSumlv004=$vSumlv004+$vrow['lv004'];
			$vSumlv005=$vSumlv005+$vTienAprQt;
			$vSumlv016=$vSumlv016+$vrow['lv004']-$vTienAprQt;
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{	
					case 'lv005':
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vTienAprQt,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv015':
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vTienUnAprQt,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv016':
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv004']-$vTienAprQt,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}

				
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv004-->",$this->FormatView($vSumlv004,10),$strF);
		$strF=str_replace("<!--lv005-->",$this->FormatView($vSumlv005,10),$strF);
		$strF=str_replace("<!--lv015-->",$this->FormatView($vSumlv015,10),$strF);
		$strF=str_replace("<!--lv016-->",$this->FormatView($vSumlv016,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	public function LV_LinkFieldExt($vFile,$vSelectID)
	{
		return($this->CreateSelect($this->sqlconditionext($vFile,$vSelectID),0));
	}
	private function sqlconditionext($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv002':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  cr_lv0004 where lv008=1";
				break;
			case 'lv003':
				$vsql="select lv001,concat(IF(lv009=1,'----',''),lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  cr_lv0003 order by lv008 asc";
				break;
			case 'lv006':
				$vsql="select lv001,concat(lv001,' - ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;
			case 'lv007':
				$vsql="select lv001,concat(lv001,' - ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;
			case 'lv008':
				$vsql="select lv001,concat(lv001,' - ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;
			case 'lv013':
				$vsql="select lv001,lv002,IF(concat(lv001,'')='$vSelectID',1,0) lv003 from  ac_lv0030";
				break;
			case 'lv015':
				$vsql="select lv001,lv002,IF(concat(lv001,'')='$vSelectID',1,0) lv003 from  cr_lv0031";
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
			case 'lv002':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  cr_lv0004 where lv008=1";
				break;
			case 'lv003':
				$vsql="select lv001,concat(IF(lv009=1,'    ',''),lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  cr_lv0003 order by lv008 asc";
				break;
			case 'lv006':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;
			case 'lv013':
				$vsql="select lv001,lv002,IF(concat(lv001,'')='$vSelectID',1,0) lv003 from  ac_lv0030";
				break;
			case 'lv015':
				$vsql="select lv001,lv002,IF(concat(lv001,'')='$vSelectID',1,0) lv003 from  cr_lv0031";
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
			case 'lv002':
				//$vsql="select lv001,IF(lv009<>'',lv009,lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  cr_lv0004 where lv001='$vSelectID'";
				$vsql="select lv001,lv009 lv002,IF(lv001='$vSelectID',1,0) lv003 from  cr_lv0004 where lv001='$vSelectID'";
				break;
			case 'lv003':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  cr_lv0003 where lv001='$vSelectID'";
				break;
			case 'lv006':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			/*case 'lv012':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0030 where lv001='$vSelectID'";
				break;*/
			case 'lv027':
				$vsql="select lv001,lv002,IF(concat('',lv001)='$vSelectID',1,0) lv003 from  cr_lv0006 where lv001='$vSelectID'";
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