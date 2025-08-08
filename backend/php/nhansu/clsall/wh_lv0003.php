<?php
/////////////coding wh_lv0003///////////////
class   wh_lv0003 extends lv_controler
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

	
///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv097,lv098,lv099,lv025,lv022,lv025,lv024";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='wh_lv0003';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv026"=>"27","lv090"=>"91","lv097"=>"98","lv098"=>"99","lv099"=>"100","lv100"=>"101","lv101"=>"102","lv102"=>"103","lv022"=>"23","lv025"=>"26","lv024"=>"25");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"0","lv016"=>"0","lv017"=>"0","lv018"=>"0","lv019"=>"0","lv020"=>"0","lv021"=>"0","lv022"=>"0","lv026"=>"10","lv090"=>"0","lv097"=>"10","lv098"=>"10","lv099"=>"10","lv100"=>"0","lv101"=>"0","lv102"=>"22","lv025"=>"0","lv024"=>"22");	
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
		//$this->isApr=0;
		//$this->isUnApr=0;
		$this->lang=$_GET['lang'];
	}
	
	function LV_Load()
	{
		$vsql="select * from  wh_lv0003";
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
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];
			$this->lv090=$vrow['lv090'];

		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  wh_lv0003 Where lv001='$vlv001'";
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
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];		
			$this->lv090=$vrow['lv090'];	
		}
		else
			$this->lv001=NULL;
	}
	function LV_Insert()
	{
		if($this->isAdd==0) return false;
		//$this->lv017 = ($this->lv017!="")?recoverdate(($this->lv017), $this->lang)." ".gettime($this->lv017):$this->DateDefault;
		 $lvsql="insert into wh_lv0003 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv024,lv025,lv026,lv090) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv018','$this->lv019','$this->lv020','$this->lv021','$this->lv022',now(),'$this->LV_UserID','$this->lv026','$this->lv090')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'wh_lv0003.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		//$this->lv017 = ($this->lv017!="")?recoverdate(($this->lv017), $this->lang)." ".gettime($this->lv017):$this->DateDefault;
		$lvsql="Update wh_lv0003 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016',lv017='$this->lv017',lv018='$this->lv018',lv019='$this->lv019',lv020='$this->lv020',lv021='$this->lv021',lv022='$this->lv022',lv026='$this->lv026',lv090='$this->lv090' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'wh_lv0003.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM wh_lv0003  WHERE wh_lv0003.lv001 IN ($lvarr) and (select count(*) from sl_lv0010 B where  B.lv002= wh_lv0003.lv001)<=0  and (select count(*) from sl_lv0013 B where  B.lv002= wh_lv0003.lv001)<=0 ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'wh_lv0003.delete',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update wh_lv0003 set lv100=1,lv101='$this->LV_UserID',lv102=now()  WHERE wh_lv0003.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) 
		{
			$this->InsertLogOperation($this->DateCurrent,'wh_lv0003.approval',sof_escape_string($lvsql));
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
						$strCondi= " AND ( lv001 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR lv001 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and lv001  = '$this->lv001'";
			}
			
		}
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
		if($this->lv018!="")  $strCondi=$strCondi." and lv018 ='$this->lv018'";
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
						$strCondi= " AND ( lv025 = '$vNameCus'";
					else
						$strCondi=$strCondi." OR lv025 = '$vNameCus'";		
					}
				}
				$strCondi=$strCondi.")";
				
			}
			else
			{
				$strCondi=$strCondi." and lv025  = '$this->lv025'";
			}
			
		}
		return $strCondi;
	}
	function LV_GetBLMoney($vSupplierID)
	{
		$lvsql="select sum(PM.lv003) money,sum(PM.lv004) convertmoney,sum(PM.lv005) discount from ((select sum(A.lv004*A.lv006) lv003,sum(A.lv004*A.lv006*A.lv008/100) lv004,sum(A.lv004*A.lv006*A.lv009/100) lv005 from wh_lv0022 A inner join wh_lv0021 B on A.lv002=B.lv001  where 1=1 and B.lv002='$vSupplierID' )) PM ";	
		$vresult=db_query($lvsql);
		$vrow = db_fetch_array ($vresult);
		if($vrow['convertmoney']==0)
		{
			if($vrow['money']==0) return "0";
		}
		return $vrow['convertmoney']+$vrow['money']-$vrow['discount'];
	}	
	function LV_GetInvoiceParent($vSupplierID)
	{
		$vResult='';
		$lvsql = "select B.lv001 from ac_lv0004 B where B.lv003='SUP' and B.lv004='$vSupplierID' ";
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
	function LV_GetPCMoney($vSupplierID)
	{
	//GetMoney
		$vListParent=$this->LV_GetInvoiceParent($vSupplierID);
		$lvsql = "select if(ISNULL(sum(lv004)),0,sum(lv004)) SumMoney from ac_lv0005 A  WHERE A.lv002 in (".$vListParent.") ";
		$vReturnArr=array();
		$lvResult= db_query($lvsql);
		$row= db_fetch_array($lvResult);
		return $row['SumMoney'];			
		
	}	
		////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM wh_lv0003 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_ConnectSendSanPham()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api.evbi.vn/api/p/list_insurance_package?nhom=BIZNET&NV=CN.6',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Authority: test@biznet.vn-A00C6F7ABD77BF14FFB7C8A06037ADDD',
			'Cookie: BIGipServerbaohiem-vbi-vn=!mPk+WbUeDuGPA51PZMQd+dIk24jNqK9+QW/pkgQH3EkqSTj9T0TjcNOKrjU5tNM1KuCXf3rcnYfWIGuIagLU0WNgQk3rKFhVZFvpuk6msLfNwbAmj8TpwKxCLWEA8zhudmnQ4Pd/cLn3TlTuvayJgy/GtYBlTrs=; TS014bab9b=013caf07cbfd0c844893d603f76e4c126e5acb59dceebb356a719c9b18424e551a37428d29c5fe134533e8b7063501eb30ca67f15ac93da38bc5ac46a00cc6967009a5660a'
		),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		$ArrData=json_decode($response);
		foreach($ArrData as $key => $value)
		{
			switch($key)
			{
				case 'goi_bh':
					$vgoi_bh=$value;
					$vArrGoiBaoHiem=json_decode($vgoi_bh);
					foreach($vArrGoiBaoHiem as $keygoi => $giatri)
					{
						switch($keygoi)
						{
							case 'so_id':
								$so_id=$giatri;
								break;
							case 'nhom':
								$nhom=$giatri;
								break;	
							case 'ma':
								$ma=$giatri;
								break;
							case 'ten':
								$so_id=$giatri;
								break;
							case 'tu_tuoi':
								$tu_tuoi=$giatri;
								break;
							case 'toi_tuoi':
								$toi_tuoi=$giatri;
								break;
							case 'gioi_tinh':
								$gioi_tinh=$giatri;
								break;
							case 'phi_bh':
								$phi_bh=$giatri;
								break;
							case 'tien_bh_chinh':
								$tien_bh_chinh=$giatri;
								break;
							case 'nt_phi':
								$nt_phi=$giatri;
								break;
							case 'dkbs':
								$dkbs=$giatri;
								break;													
						}
					}
					break;
				default:
					break;
			}
		}
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
		$lvHref="<span onclick=\"ProcessTextHiden(this)\"><a href=\"javascript:FunctRunning1('@01')\" class=@#04 style=\"text-decoration:none\">@02</a></span>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"2\">&nbsp;</td>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT * FROM wh_lv0003 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
			$vTienHD=$this->LV_GetBLMoney($vrow['lv001']);
			$vTienPC=$this->LV_GetPCMoney($vrow['lv001']);
			$vSumTienHD=$vSumTienHD+$vTienHD;
			$vSumTienPC=$vSumTienPC+$vTienPC;
			$vSumTienDK=$vSumTienDK+$vrow['lv026'];
			for($i=0;$i<count($lstArr);$i++)
			{
				if($lstArr[$i]=="lv097")
				{
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vTienHD,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				elseif($lstArr[$i]=="lv098")
				{
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vTienPC,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				elseif($lstArr[$i]=="lv099")
				{
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vTienHD-$vTienPC,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
				$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",str_replace(' ','|',$vrow['lv001']),str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv026-->",$this->FormatView($vSumTienDK,10),$strF);
		$strF=str_replace("<!--lv097-->",$this->FormatView($vSumTienHD,10),$strF);
		$strF=str_replace("<!--lv098-->",$this->FormatView($vSumTienPC,10),$strF);
		$strF=str_replace("<!--lv099-->",$this->FormatView($vSumTienHD-$vSumTienPC,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
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
			window.open('wh_lv0003/?lang=".$this->lang."&func='+value,'','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
		$lvTable="<div align=\"center\"><div ondblclick=\"this.innerHTML=''\"><img  src=\"".$this->GetLogo()."\" style=\"max-width:1024px\" /></div></div>
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
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"1\">&nbsp;</td>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT * FROM wh_lv0003 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv026-->",$this->FormatView($vSumTienDK,10),$strF);
		$strF=str_replace("<!--lv097-->",$this->FormatView($vSumTienHD,10),$strF);
		$strF=str_replace("<!--lv098-->",$this->FormatView($vSumTienPC,10),$strF);
		$strF=str_replace("<!--lv099-->",$this->FormatView($vSumTienHD-$vSumTienPC,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
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
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0050";
				break;
			case 'lv021':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;
			case 'lv090':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0003 where lv018='3'";
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
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0023 where lv001='$vSelectID'";
				break;
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014 where lv001='$vSelectID'";
				break;
			case 'lv018':
				$lvopt=1;
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0050 where lv001='$vSelectID'";
				break;
			case 'lv021':
				$lvopt=1;
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