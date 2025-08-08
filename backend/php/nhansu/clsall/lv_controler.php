<?php
/*
Báº£ng quyá»�n ERPSOFV2R.com
KhÃ´ng Ä‘Æ°á»£c sá»­a
NgÃ y táº¡o:06/04/2007
*/
class lv_controler
{
	protected $isOnce =0;
	protected $isAddPer  =0;
	protected $isReset  =0;

	

	protected $isView=0;
	protected $isAdd=0;
	protected $isEdit=0;	
	protected $isDel=0;	
	protected $isFil=0;		
	protected $isRpt=0;	
	protected $isRel=0;		
	protected $isHelp=0;		
	protected $isConfig=0;
	
	protected $isApr=0;		
	protected $isUnApr=0;	
///////////////Control////////////////////
	protected $UserID="";
	protected $isLog=1;
	public $LV_UserID="";
///////////Load max////////////
	public $MaxRows=0;
	public $CurPage=1;
	public $SortNum=0;
	public $ListView="";
	public $ListOrder="";
	public $RptCondition="";
	public $GB_Sort=null;
	protected $isRight=NULL;
	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	public $domainrel='https://erp.SOF.biz';
	public $domain='https://erp.SOF.biz';
	public $domain_baohang='https://erp.SOF.biz/baohanh/';
	public $domain_bhpmh='https://erp.SOF.biz/muahang/';
	public $domain_qrlocal='https://erp.SOF.biz/khonoibo/';
	public $domains='http://localhost/levinhsoft/SOF/';
	public $ImageLink='';
	public $kpi_max=100;
	public $kpi_min=0;
	public $STTNote=0;
	public $BothSalePTT="'MP105'";
	
	public function Set_User($vCheckAdmin,$vUserID,$vright)
	{
		$this->UserID=$vUserID;
		$this->isRight=$vCheckAdmin;
		$this->LV_UserID=$_SESSION['userlogin_smcd'] ?? null;
		$this->isVisible=$this->Get_User($vUserID,'lv007');
		$ImageLink="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$ArrImageLink=explode('?',$ImageLink,2);
		$this->ImageLink=$ArrImageLink[0];
		if($this->isVisible==1)
		{
			$this->isAdd=0;
			$this->isEdit=0;
			$this->isDel=0;
			$this->isFil=0;
			$this->isRpt=0;
			$this->isRel=0;
			$this->isHelp=0;
			$this->isApr=0;
			$this->isUnApr=0;
			$this->isView=0;
			$this->isConfig=0;
			$this->isAddPer=0;
			$_SESSION['ERPSOFV2RUserID']=NULL;
			$_SESSION['ERPSOFV2RRight']=NULL;
			$_SESSION['userlogin_smcd']=NULL;
		}
		else
		{
			$this->isAdd=$this->SetOnce($vCheckAdmin,$vUserID,$vright,"Add");
			$this->isEdit=$this->SetOnce($vCheckAdmin,$vUserID,$vright,"Edit");
			$this->isDel=$this->SetOnce($vCheckAdmin,$vUserID,$vright,"Del");
			$this->isFil=$this->SetOnce($vCheckAdmin,$vUserID,$vright,"Fil");
			$this->isRpt=$this->SetOnce($vCheckAdmin,$vUserID,$vright,"Rpt");
			$this->isRel=$this->SetOnce($vCheckAdmin,$vUserID,$vright,"Rel");
			$this->isHelp=$this->SetOnce($vCheckAdmin,$vUserID,$vright,"Help");
			$this->isApr=$this->SetOnce($vCheckAdmin,$vUserID,$vright,"Apr");
			$this->isUnApr=$this->SetOnce($vCheckAdmin,$vUserID,$vright,"UnApr");
			$this->isView=$this->SetOnce($vCheckAdmin,$vUserID,$vright,"View");
			$this->isConfig=$this->SetOnce($vCheckAdmin,$vUserID,$vright,"Config");
		}
		$this->LV_ConnectSQLServer();
	
	}
	function LoadSQLConfig()
	{
		if (($this->isConnectSQLSERVER ?? false)) return;
		$this->EmailAlarm='';
		$this->EmailAlarmCC='';
		$lvsql="select * from  jo_lv0016";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->ServerSQLServer=$vrow['lv006'];
			$this->DatabaseSQLServer=$vrow['lv009'];			
			$this->UserSQLServer=$vrow['lv007'];
			$this->PassSQLServer=$vrow['lv008'];
			$this->EmailAlarm=$vrow['lv016'];
			$this->EmailAlarmCC=$vrow['lv015'];
		}
		$this->isConnectSQLSERVER=true;
	}
	function LV_ConnectSQLServer()
	{
		$this->LoadSQLConfig();
		$this->Server=$this->ServerSQLServer;
		$vUser=$this->UserSQLServer;
		$vPass=$this->PassSQLServer;
		$vDatabase=$this->DatabaseSQLServer;
		$this->connectionOptions = array(
		    "Database" => $vDatabase,
		    "Uid" => $vUser,
		    "PWD" => $vPass
		);
	}
	public function LV_Escape_String ($lvStr)
	{
		return sof_escape_string($lvStr);
	}
	public function LV_SortBuild($lvArr,$sort)
	{
		if( $lvArr==null) return " lv001 ".$sort;
		if( count($lvArr)==0) return " lv001 ".$sort;
		$lvReturn="";
		for ($i=0;$i<=9;$i++)
		{
			if($lvArr[$i]!="" && $lvArr[$i]!=NULL)
			{
				if($lvReturn=="") 
					$lvReturn=$lvArr[$i]." ".$sort;
				else
					$lvReturn=$lvReturn.",".$lvArr[$i]." ".$sort; 
			}
		}	
		return $lvReturn;
	}
	public function getsort($vArr1,$vArr2)
	{
		$lstArr=$vArr1;
		$vArr1=explode(",",$this->DefaultFieldList);		 
		$vReturn=array();
		$vGetArr=array();
		$vBothArr=array();
		for($i=0;$i<count($vArr1);$i++)
		{
			$vBothArr[$i][0] = $vArr2[$i] ?? '';
			$vBothArr[$i][1]=$vArr1[$i];
			$key = (int)substr($vArr1[$i],2,3)-1;
			$vGetArr[$i] = $vArr2[$key] ?? '';
			if(!(strpos($vBothArr[$i][0],".")===false)){$tmpArr=explode(".",$vBothArr[$i][0]);$this->GB_Sort[(int)($tmpArr[1])]=$vBothArr[$i][1];}
		}
		$strpos="";
		for($i=0;$i<count($vArr1);$i++)
		{
			$pos=0;
			$vTem=$vBothArr[$i][0];
			for($j=0;$j<count($vBothArr);$j++)
			{
				if($vTem>$vBothArr[$j][0])$pos++;
			}
			while(true)
			{
				if(strpos($strpos,"@".$pos."@")===false)
				{
					$vReturn[$pos]=$vBothArr[$i][1];
					break;
				}
				else
				{
					$pos++;
				}
			}
			$strpos="@".$pos."@".$strpos;
		}
		$vArrTemp=Array();
		$j=0;
		for($i=0;$i<count($vReturn);$i++)
		{
			
			if(array_search($vReturn[$i], $lstArr)===FALSE)
			{
			}
			else
			{
				$vArrTemp[$j]=$vReturn[$i];
				$j++;
			}
			
		}
		return $vArrTemp;
	}
	private function SetOnce($vCheckAdmin,$vUserID,$vright,$vrightcontrol)
	{
		if('admin'==$vCheckAdmin)
		{
			return 1;
		}
		else
		{
			$vsql="select count(*) as count from lv_lv0009 A Where A.lv002='$vrightcontrol' and A.lv004=1 and A.lv003 in (select lv001 from lv_lv0008 B where B.lv002='$vUserID' and B.lv003='$vright' and B.lv004=1) ";
			$tresult=db_query($vsql);
			$trow=db_fetch_array($tresult);
			return (int)$trow['count'];
		}
	}
	public function Get_User($vUserID,$vField)
	{
		if('admin'==$vUserID && ($vField=='lv909' || $vField=='lv910' ||  $vField=='lv911' || $vField=='lv912' || $vField=='lv913') )
		{
			return 1;
		}
		else
		{
			$vsql="select $vField from lv_lv0007 where lv001='$vUserID'";
			$tresult=db_query($vsql);
			$trow=db_fetch_array($tresult);
			  if (is_array($trow) && isset($trow[$vField])) {
				return $trow[$vField];
				} else {
					return null; // hoặc giá trị mặc định khác
				}
			//return $trow[$vField];		
		}
	}
	public  function TabAddPer()
	{
		if($this->isAddPer==1)
		{
			$strTable="<TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
			<TBODY>
			<TR vAlign=center align=middle>
			@#01
			</TR>
			</TBODY>
			</TABLE>
			";
			$strTDNo="<td><div style='margin-top:7px;'>/</div></td>";
			$strTD="<td nowrap=\"nowrap\"><a class=lvtoolbar 
				href=\"javascript:@02(@03)\" tabindex=\"@05\"><div style='float:left'><img alt=\"NoImg\" src=\"$this->Dir../images/icon/@04.png\" align=\"middle\" border=\"0\" name=\"new\" class=\"lviconimg\" /></div><div class='lv_functext' style='float:left'>@01</div></a></td>";
			$strNoneTD="<td nowrap=\"nowrap\"><a class=lvtoolbar 
				tabindex=\"@05\"><div style='float:left'><img alt=\"NoImg\" src=\"$this->Dir../images/icon/@04.png\" align=\"middle\" border=\"0\" name=\"new\" class=\"lviconimg\" ></div><div style='float:left'  class='lv_functext'>@01</div></a></td>";
			$strFunc="";
			
					$strTemp=str_replace("@02","AddPer",$strTD);
					$strTemp=str_replace("@03","",$strTemp);
					$strTemp=str_replace("@04","AddPer",$strTemp);
					$strTemp=str_replace("@05","1",$strTemp);
					$strTemp=str_replace("@01",GetLangTopBar(13,$this->lang),$strTemp);
					$strFunc=$strFunc.$strTemp.$strTDNo;
				
			return str_replace("@#01",$strFunc,$strTable);
		}
		else
		{
			return '';
		}
	}
	public  function TabReset()
	{
		if($this->isReset==1)
		{
			$strTable="<TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
			<TBODY>
			<TR vAlign=center align=middle>
			@#01
			</TR>
			</TBODY>
			</TABLE>
			";
			$strTDNo="<td><div style='margin-top:7px;'>/</div></td>";
			$strTD="<td nowrap=\"nowrap\"><a class=lvtoolbar 
				href=\"javascript:@02(@03)\" tabindex=\"@05\"><div style='float:left'><img alt=\"NoImg\" src=\"$this->Dir../images/icon/@04.png\" align=\"middle\" border=\"0\" name=\"new\" class=\"lviconimg\" /></div><div class='lv_functext' style='float:left'>@01</div></a></td>";
			$strNoneTD="<td nowrap=\"nowrap\"><a class=lvtoolbar 
				tabindex=\"@05\"><div style='float:left'><img alt=\"NoImg\" src=\"$this->Dir../images/icon/@04.png\" align=\"middle\" border=\"0\" name=\"new\" class=\"lviconimg\" ></div><div style='float:left'  class='lv_functext'>@01</div></a></td>";
			$strFunc="";
			$strTemp=str_replace("@02","Reset",$strTD);
			$strTemp=str_replace("@03","",$strTemp);
			$strTemp=str_replace("@04","Reset",$strTemp);
			$strTemp=str_replace("@05","1",$strTemp);
			$strTemp=str_replace("@01",GetLangTopBar(12,$this->lang),$strTemp);
			$strFunc=$strFunc.$strTemp.$strTDNo;
			return str_replace("@#01",$strFunc,$strTable);
		}
		else
		{
			return '';
		}
	}
	protected function TabFunction($lvFrom,$lvList,$maxRows)
	{
		$strTable="<TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
		@#01
		</TR>
		</TBODY>
		</TABLE>
		";
		$strTDNo="<td><div style='margin-top:7px;'>/</div></td>";
		$strTD="<td nowrap=\"nowrap\"><a class=lvtoolbar 
            href=\"javascript:@02(@03)\" tabindex=\"@05\"><div style='float:left'><img alt=\"NoImg\" src=\"$this->Dir../images/icon/@04.png\" align=\"middle\" border=\"0\" name=\"new\" class=\"lviconimg\" /></div><div class='lv_functext' style='float:left'>@01</div></a></td>";
		$strNoneTD="<td nowrap=\"nowrap\"><a class=lvtoolbar 
             tabindex=\"@05\"><div style='float:left'><img alt=\"NoImg\" src=\"$this->Dir../images/icon/@04.png\" align=\"middle\" border=\"0\" name=\"new\" class=\"lviconimg\" ></div><div style='float:left'  class='lv_functext'>@01</div></a></td>";
		$strFunc="";
		if($this->isAdd==1)
		{
			$strTemp=str_replace("@02","Add",$strTD);
			$strTemp=str_replace("@03","",$strTemp);
			$strTemp=str_replace("@04","Add",$strTemp);
			$strTemp=str_replace("@05","1",$strTemp);
			$strTemp=str_replace("@01",$this->ArrFunc[1],$strTemp);
			$strFunc=$strFunc.$strTemp.$strTDNo;
			if($this->isOnce==1)
			{
				$strTemp=str_replace("@02","AddOne",$strTD);
				$strTemp=str_replace("@03","",$strTemp);
				$strTemp=str_replace("@04","AddOne",$strTemp);
				$strTemp=str_replace("@05","1",$strTemp);
				$strTemp=str_replace("@01",GetLangTopBar(11,$this->lang),$strTemp);
				$strFunc=$strFunc.$strTemp.$strTDNo;
			}
			if($this->isAddPer==1 )
			{
				$strTemp=str_replace("@02","AddPer",$strTD);
				$strTemp=str_replace("@03","",$strTemp);
				$strTemp=str_replace("@04","AddPer",$strTemp);
				$strTemp=str_replace("@05","1",$strTemp);
				$strTemp=str_replace("@01",GetLangTopBar(13,$this->lang),$strTemp);
				$strFunc=$strFunc.$strTemp.$strTDNo;
			}
		}
		if($this->isEdit==1)
		{
			$strTemp=str_replace("@02","Edt",$strTD);
			$strTemp=str_replace("@03","",$strTemp);
			$strTemp=str_replace("@04","Edt",$strTemp);
			$strTemp=str_replace("@05","3",$strTemp);
			$strTemp=str_replace("@01",$this->ArrFunc[2],$strTemp);
			$strFunc=$strFunc.$strTemp.$strTDNo;
			if($this->isReset==1 )
			{
				$strTemp=str_replace("@02","Reset",$strTD);
				$strTemp=str_replace("@03","",$strTemp);
				$strTemp=str_replace("@04","Reset",$strTemp);
				$strTemp=str_replace("@05","1",$strTemp);
				$strTemp=str_replace("@01",GetLangTopBar(12,$this->lang),$strTemp);
				$strFunc=$strFunc.$strTemp.$strTDNo;
			}
		}
		if($this->isDel==1)
		{
			$strTemp=str_replace("@02","Del",$strTD);
			$strTemp=str_replace("@03","",$strTemp);
			$strTemp=str_replace("@04","Del",$strTemp);
			$strTemp=str_replace("@05","3",$strTemp);
			$strTemp=str_replace("@01",$this->ArrFunc[3],$strTemp);
			$strFunc=$strFunc.$strTemp.$strTDNo;
		}
		
		if($this->isApr==1)
		{
			$strTemp=str_replace("@02","Apr",$strTD);
			$strTemp=str_replace("@03","",$strTemp);
			$strTemp=str_replace("@04","Apr",$strTemp);
			$strTemp=str_replace("@05","3",$strTemp);
			$strTemp=str_replace("@01",$this->ArrFunc[6],$strTemp);
			$strFunc=$strFunc.$strTemp.$strTDNo;
		}
		if($this->isUnApr==1)
		{
			$strTemp=str_replace("@02","UnApr",$strTD);
			$strTemp=str_replace("@03","",$strTemp);
			$strTemp=str_replace("@04","UnApr",$strTemp);
			$strTemp=str_replace("@05","3",$strTemp);
			$strTemp=str_replace("@01",$this->ArrFunc[7],$strTemp);
			$strFunc=$strFunc.$strTemp.$strTDNo;
		}
		if($this->isRel==1)
		{
			$strTemp=str_replace("@02",$lvFrom.".submit",$strTD);
			$strTemp=str_replace("@03","",$strTemp);
			$strTemp=str_replace("@04","Reload",$strTemp);
			$strTemp=str_replace("@05","3",$strTemp);
			$strTemp=str_replace("@01",$this->ArrFunc[8],$strTemp);
			$strFunc=$strFunc.$strTemp.$strTDNo;
		}
		if($this->isFil==1)
		{
			$strTemp=str_replace("@02","Fil",$strTD);
			$strTemp=str_replace("@03","",$strTemp);
			$strTemp=str_replace("@04","Filter",$strTemp);
			$strTemp=str_replace("@05","3",$strTemp);
			$strTemp=str_replace("@01",$this->ArrFunc[4],$strTemp);
			$strFunc=$strFunc.$strTemp.$strTDNo;
		}
		if($this->isRpt==1)
		{
			$strTemp=str_replace("@02","Rpt",$strTD);
			$strTemp=str_replace("@03","",$strTemp);
			$strTemp=str_replace("@04","Rpt",$strTemp);
			$strTemp=str_replace("@05","3",$strTemp);
			$strTemp=str_replace("@01",$this->ArrFunc[5],$strTemp);
			$strFunc=$strFunc.$strTemp.$strTDNo;
		}
		if($this->isHelp==1)
		{
			$strTemp=str_replace("@02","Help",$strTD);
			$strTemp=str_replace("@03","'".base64_encode($this->objhelp)."','$this->lang'",$strTemp);
			$strTemp=str_replace("@04","Help",$strTemp);
			$strTemp=str_replace("@05","3",$strTemp);
			$strTemp=str_replace("@01",$this->ArrFunc[9],$strTemp);
			$strFunc=$strFunc.$strTemp;
		}
		if($this->isConfig==1)
		{
			$strTemp=str_replace("@02","Config",$strNoneTD);
			$strTemp=str_replace("@03","'hr_lv0001'",$strTemp);
			$strTemp=str_replace("@04","Config",$strTemp);
			$strTemp=str_replace("@05","3",$strTemp);
			$strTemp=str_replace("@01",$this->ArrFunc[10],$strTemp);
			$strFunc=$strFunc.$strTemp;
		}
		
	return str_replace("@#01",$strFunc,$strTable);
				
	}
	protected function GetOne_TabFunction($vFun,$vFunName)
	{
		$strTable="<TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
		@#01
		</TR>
		</TBODY>
		</TABLE>
		";
		$strTDNo="<td><div style='margin-top:7px;'>/</div></td>";
		$strTD="<td nowrap=\"nowrap\"><a class=lvtoolbar 
            href=\"javascript:@02(@03)\" tabindex=\"@05\"><div style='float:left'><img alt=\"NoImg\" src=\"$this->Dir../images/icon/@04.png\" align=\"middle\" border=\"0\" name=\"new\" class=\"lviconimg\" /></div><div class='lv_functext' style='float:left'>@01</div></a></td>";
		$strNoneTD="<td nowrap=\"nowrap\"><a class=lvtoolbar 
             tabindex=\"@05\"><div style='float:left'><img alt=\"NoImg\" src=\"$this->Dir../images/icon/@04.png\" align=\"middle\" border=\"0\" name=\"new\" class=\"lviconimg\" ></div><div style='float:left'  class='lv_functext'>@01</div></a></td>";
		$strFunc="";
		$strTemp=str_replace("@02",$vFun,$strTD);
		$strTemp=str_replace("@03","'".base64_encode($this->objhelp)."','$this->lang'",$strTemp);
		$strTemp=str_replace("@04",$vFun,$strTemp);
		$strTemp=str_replace("@05","3",$strTemp);
		$strTemp=str_replace("@01",$vFunName,$strTemp);
		$strFunc=$strFunc.$strTemp;
		return str_replace("@#01",$strFunc,$strTable);
				
	}
/////////////InsertLog/////////////////////	
	protected function InsertLogOperation($vDateLog,$vTableID,$vLogText)
	{
		if($this->isLog==0) return false;
		$lvsql="insert into lv_lv0001 (lv002,lv003,lv004,lv005,lv006,lv007) values('$this->UserID','$vDateLog','$vTableID','$vLogText','".$_SESSION['SOFIP']."','".$_SESSION['SOFMAC']."')";
		$return=db_query($lvsql);
		if($return)
			return $return;
		else 
		{
			$lvsql="insert into lv_lv0001 (lv002,lv003,lv004,lv005) values('$this->UserID','$vDateLog','$vTableID','$vLogText')";
			return db_query($lvsql);
		}
	}
	public function SaveOperation($vlv002,$vlv003,$vlv004,$vlv005,$vlv006,$vlv007,$vlv008)
	{
		$lvsql="select count(*) nums from lv_lv0002 where lv002='$vlv002' and lv003='$vlv003' ";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow['nums']>0)
		{
			return $this->UpdateSaveOperation($vlv002,$vlv003,$vlv004,$vlv005,$vlv006,$vlv007,$vlv008);
		}
		else
			return $this->InsertSaveOperation($vlv002,$vlv003,$vlv004,$vlv005,$vlv006,$vlv007,$vlv008);
		
	}
//////////Insert Save Oper//////////////////////////////////	
	protected function InsertSaveOperation($vlv002,$vlv003,$vlv004,$vlv005,$vlv006,$vlv007,$vlv008)
	{
		$lv_lv009=sof_escape_string( $this->GetCondition());
		$lvsql="insert into lv_lv0002 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009) values('$vlv002','$vlv003','$vlv004','$vlv005','$vlv006','$vlv007','$vlv008','$lv_lv009')";
		return db_query($lvsql);
	}
	protected function UpdateSaveOperation($vlv002,$vlv003,$vlv004,$vlv005,$vlv006,$vlv007,$vlv008)
	{
		$lv_lv009=sof_escape_string( $this->GetCondition());
		$lvsql="update lv_lv0002 set lv004='$vlv004',lv005='$vlv005',lv006='$vlv006',lv007='$vlv007',lv008='$vlv008',lv009='$lv_lv009' where lv002='$vlv002' and lv003='$vlv003'";
		return db_query($lvsql);
	}
	public function LoadSaveOperation($vlv002,$vlv003)
	{
		$lvsql="select lv004,lv005,lv006,lv007,lv008,lv009 from  lv_lv0002 Where lv002='$vlv002' and lv003='$vlv003'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->ListView=$vrow['lv004'];
			$this->MaxRows=$vrow['lv005'];
			$this->CurPage=$vrow['lv006'];	
			$this->ListOrder=$vrow['lv007'];			
			$this->SortNum=$vrow['lv008'];
			$this->RptCondition=$vrow['lv009'];
		}
		else
		{
			$lvsql="select lv004,lv005,lv006,lv007,lv008,lv009 from  lv_lv0002 Where lv002='admin' and lv003='$vlv003'";
			$vresult=db_query($lvsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				$this->ListView=$vrow['lv004'];
				$this->MaxRows=$vrow['lv005'];
				$this->CurPage=$vrow['lv006'];	
				$this->ListOrder=$vrow['lv007'];			
				$this->SortNum=$vrow['lv008'];
				$this->RptCondition=$vrow['lv009'];
			}
		}
	}
	public function CreateSelect($lvsql,$lvopt)
	{
		if($lvsql=='') return ;
		if (isset($this->SAVESQLRUN[$lvsql]) && $this->SAVESQLRUN[$lvsql] != null) {
			return $this->SAVESQLRUN[$lvsql];
		}
		$strReturn="";
		$this->LV_CurValue='';
		$strOption='<option value="@01" @03>@02</option>';
		$lvResult = db_query($lvsql);
		if($lvResult!=null)
		{
			while($row= db_fetch_array($lvResult)){
			if($strReturn=="") $this->LV_CurValue=$row['lv001'];
			$lvTemp=str_replace("@01",$row['lv001'],$strOption);
			$lvTemp=str_replace("@03",((int)$row['lv003']==1)?'selected="selected"':'',$lvTemp);
			$lvTemp=str_replace("@02",($lvopt==0)?$row['lv002']:(($lvopt==1)?$row['lv001']."(".$row['lv002'].")":(($lvopt==2)?$row['lv002']."(".$row['lv001'].")":$row['lv001'])),$lvTemp);
			$strReturn=$strReturn.$lvTemp;
			}
		}
		$this->SAVESQLRUN[$lvsql]=$strReturn;
		return $strReturn;
	}
	public function FormatView($vValue,$vopt)
	{
		$this->langconver=$this->lang;
		switch($vopt)
		{
			case 1:$this->langconver='EN';return LCurrency($vValue,$this->langconver);
			case 2:
				if($vValue=='' || $vValue=='0000-00-00' || $vValue=='1900-01-01' || $vValue=='1990-01-01') return '';
				/*if($this->isBuilList==1)
				return $this->DateShowShort($vValue);
				else*/
				return formatdate($vValue,$this->lang);
			case 22: 
				if($vValue=='' || $vValue=='0000-00-00 00:00:00' || $vValue=='1900-01-01 00:00:00' || substr($vValue,0,10)=='1990-01-01' || substr($vValue,0,10)=='1900-01-01') return '';
				/*if($this->isBuilList==1)
					return $this->DateShowShort($vValue).' '.substr($vValue,10,9);
				else*/
					return formatdate(substr($vValue,0,10),$this->lang).' '.substr($vValue,10,9);
			case 3: return '***';
			case 4:
				if($vValue=='' || $vValue=='0000-00-00 00:00:00' || $vValue=='1900-01-01 00:00:00' || substr($vValue,0,10)=='1990-01-01'  || substr($vValue,0,10)=='1900-01-01') return '';
				return formatdate($vValue,$this->lang)." ".substr($vValue,11,8);
			case 5: if($vValue<0) return '('.LCurrency(-$vValue,$this->lang).')'; else return LCurrency($vValue,$this->lang);
			case 6:return '<img src="'.$this->path_server.$this->path_web.$vValue.'" border="0" style="height:'.$this->img_height.'px" />';
			case 10:$this->langconver='EN';return LCurrencys($vValue,$this->langconver);
			case 20:$this->langconver='EN';return ($vValue==0)?'&nbsp':LCurrencys($vValue,$this->langconver);
			case 13:$this->langconver='EN';return LCurrencys($vValue,$this->langconver);
			case 60:
				$this->STTNote++;
				return $this->LV_ShowShortNote($this->STTNote,$vValue);
				break;
			default:
				//if($vValue==NULL) $vValue="&nbsp;";
			return $vValue;
		}
	}
	public function DateShowShort($g_date)
	{
		if($g_date!="" || $g_date!=NULL){
			$vArrMonth=Array(1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
			$y=substr($g_date,2,2);
			$m=substr($g_date,5,2);
			$d=substr($g_date,8,2);
			return($d."-".$vArrMonth[(int)$m]."-".$y);
		} 
		else{
			return("&nbsp;");//NULL
		}
	}
	public function DateShowLong($g_date)
	{
		if($g_date!="" || $g_date!=NULL){
			$vArrMonth=Array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
			$y=substr($g_date,0,4);
			$m=substr($g_date,5,2);
			$d=substr($g_date,8,2);
			return($d."-".$vArrMonth[(int)$m]."-".$y);
		} 
		else{
			return("&nbsp;");//NULL
		}
	}
	public function FormatSave($vValue,$vopt)
	{
		switch($vopt)
		{
			case 1:return LCurrency($vValue,$this->lang);
			case 2:return recoverdate($vValue,$this->lang);
			default:return $vValue;
		}
	}
	public function GetLogo()
	{
		$vPathLogo='../../../images/logo/';
		return '../../banner.jpg';		
		$lvsql="select  lv001,lv009 from  hr_lv0001 where lv001='SOF'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			if($vrow['lv009']=='')
				return $vPathLogo.'banner.jpg';		
			else
			 return $vPathLogo.$vrow['lv001']."/".$vrow['lv009'];		

		}
		else
			return $vPathLogo.'banner.jpg';		
	
		return '';
	}
	public function Get_LECODE()
	{
		return base64_decode($this->LE_CODE);
	}
		public function GetCompany()
	{
		$lvsql="select  lv002 from  hr_lv0001 where lv001='SOF'";
		$vresult=db_query($lvsql);
		if(!$vresult) return ;
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			 return $vrow['lv002'];		
		}
	
		return '';
	}
	public function GetAddress()
	{
		$lvsql="select  lv003 from  hr_lv0001 where lv001='SOF'";
		$vresult=db_query($lvsql);
		if(!$vresult) return ;
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			 return $vrow['lv003'];		
		}
	
		return '';
	}
	public function GetPhone()
	{
		$lvsql="select  lv005 from  hr_lv0001 where lv001='SOF'";
		$vresult=db_query($lvsql);
		if(!$vresult) return ;
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			 return $vrow['lv005'];		
		}
	
		return '';
	}
	public function GetFax()
	{
		$lvsql="select  lv006 from  hr_lv0001 where lv001='SOF'";
		$vresult=db_query($lvsql);
		if(!$vresult) return ;
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			 return $vrow['lv006'];		
		}
	
		return '';
	}
	public function GetCompanyTax()
	{
		$lvsql="select  lv008 from  hr_lv0001 where lv001='SOF'";
		$vresult=db_query($lvsql);
		if(!$vresult) return ;
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			 return $vrow['lv006'];		
		}
	
		return '';
	}
	public function GetWeb()
	{
		$lvsql="select  lv007 from  hr_lv0001 where lv001='SOF'";
		$vresult=db_query($lvsql);
		if(!$vresult) return ;
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			 return $vrow['lv007'];		
		}
	
		return '';
	}
	public function Align($vtd,$vopt)
	{
		switch($vopt)
		{
			case 1:
			case 10:
			case 20:
				return str_replace("@#05","right",$vtd);
			break;
			case 3: return str_replace("@#05","center",$vtd);
			break;
			default:
				return str_replace("@#05","left",$vtd);

		}
	}
///WH controler
	public function Get_WHControler()
	{
		$vUserID=$this->UserID;
		if('admin'==$this->isRight)
		{
			$lvsql="select  lv001 from  wh_lv0001";
		}
		else
			$lvsql="select  lv003 as lv001 from  wh_lv0034 where lv002='$vUserID'";
		$str_return="";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($str_return=="")
				$str_return="'".$vrow['lv001']."'";		
			else
				$str_return=$str_return.",'".$vrow['lv001']."'";	
		}
		if($str_return=="") $str_return="''";
		return $str_return;
	}
	public function Get_TSControler()
	{
		$vUserID=$this->UserID;
		if('admin'==$this->isRight)
		{
			$lvsql="select  lv001 from  ts_lv0001";
		}
		else
			$lvsql="select  lv003 as lv001 from  wh_lv0034 where lv002='$vUserID'";
		$str_return="";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($str_return=="")
				$str_return="'".$vrow['lv001']."'";		
			else
				$str_return=$str_return.",'".$vrow['lv001']."'";	
		}
		if($str_return=="") $str_return="''";
		return $str_return;
	}
	function InsertWithCheckTwo($vField, $vSYMBOL,$vLengthCast){
		$vReturn = "";
		$sqlS = "	SELECT $vField FROM
						(
							SELECT $vField FROM sl_lv0013 where ($vField LIKE '$vSYMBOL%')
							UNION 
							SELECT $vField FROM sl_lv0333 where ($vField LIKE '$vSYMBOL%')
						) MP order by $vField DESC limit 0,1";
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		if ($totalRows>0) {
			$arrS = db_fetch_array($bResultS);
			$vGiaTri=$arrS[$vField];
			if($vGiaTri!='' && $vGiaTri!=null)
			{
				$vvalue=(float)str_replace($vSYMBOL,'',$vGiaTri)+1;
				return $vSYMBOL.Fillnum($vvalue,$vLengthCast);
			}
			else
			{
				return $vSYMBOL.Fillnum("1",$vLengthCast);
			}
		}
		else { // co van de trong viec luu du lieu, vi du luu khong dung format theo quy dinh
			return $vSYMBOL.Fillnum("1",$vLengthCast);
		}
		return $vReturn;
	}
	public function Get_AccountChange()
	{
		$this->LV_YearAC=Array();
		if('admin'==$this->isRight)
		{
			$lvsql="select  lv006 from  ac_lv0114 where lv011='1'";
			///$lvsql="select  lv006 from  ac_namtiendoanv3_0.ac1_lv0114";
		}
		else
			$lvsql="select  lv006 from  ac_lv0114 where lv011='1'";
		$str_return="";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$this->LV_YearAC[$vrow['lv006']]=true;
		}
		if($str_return=="") $str_return="''";
		return $str_return;
	}
	public function LV_CheckAccount($vDateCheck)
	{
		return true;
		$vDateCheck=str_replace("/","-",$vDateCheck);
		if($this->LV_ValidateDate($vDateCheck))
		{
			if(count($this->LV_YearAC)>0) 
			{
				$vGYear=getyear($vDateCheck);
				if($this->LV_YearAC[$vGYear]) return true;
			}
			return false;
		}
		return false;
	}
	public function LV_ValidateDate($date)
	{
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date))
		{
			return true;
		}else{
			return false;
		}
	}
	public function GetIconAproval($vUserID,$vTenDuyet,$vNgayGioDuyet,$vState=0)
	{
		$vReturn='
		<div class="csduyetcap1">
			
			<div class="csduyetcap1_ten">'.$vTenDuyet.'</div>
			<div class="csduyetcap1_title">Đã duyệt</div>
			<div class="csduyetcap1_ngay">Ngày duyệt:'.$this->FormatView($vNgayGioDuyet,22).'</div>
		</div>
		';
		return $vReturn;
	}
	public function GetIconAproval1($vUserID,$vTenDuyet,$vNgayGioDuyet,$vState=0,$vopt=0,$vlang='')
	{
		$vTitle='Đã duyệt';
		$vTitleDate='Ngày duyệt';
		switch($vopt)
		{
			case 0:
			if($vlang=='VN')
			{
				$vTitle='Đã duyệt';
				$vTitleDate='Ngày duyệt';
			}
			else
			{
				$vTitle='Đã duyệt';
				$vTitleDate='Ngày duyệt';
			}
			break;
		case 1:
			if($vlang=='VN')
			{
				$vTitle='Đề xuất';
				$vTitleDate='Ngày đề xuất';
			}
			else
			{
				$vTitle='Đề xuất';
				$vTitleDate='Ngày đề xuất';
			}
			break;
		case 2:
			if($vlang=='VN')
			{
				$vTitle='Đã chi';
				$vTitleDate='Ngày chi';
			}
			else
			{
				$vTitle='Đã chi';
				$vTitleDate='Ngày chi';
			}
			break;
		case 3:
			if($vlang=='VN')
			{
				$vTitle='Đã thu';
				$vTitleDate='Ngày thu';
			}
			else
			{
				$vTitle='Đã thu';
				$vTitleDate='Ngày thu';
			}
			break;
		}
		$vReturn='
		<div class="csduyetcap1">
			
			<div class="csduyetcap1_ten">'.$vTenDuyet.'</div>
			<div class="csduyetcap1_title">'.$vTitle.'</div>
			<div class="csduyetcap1_ngay">'.$vTitleDate.':'.$this->FormatView($vNgayGioDuyet,22).'</div>
		</div>
		';
		return $vReturn;
	}
	function LV_GetKPI_InputText($vOpt,$vValue,$vAutoID,$vCotIndex)
	{
		$vRetrun="";
		switch($vOpt)
		{
			case 1:
				$vRetrun='<select onblur="UpdateText(this,\''.$vAutoID.'\','.$vCotIndex.')" class="selenterquick" tabindex="2" style="width:100%;min-width:35px" onKeyPress="return CheckKey(event,7)">';
				$vRetrun=$vRetrun.'<option '.(($vValue==$this->kpi_min)?'selected="selected"':'').' value="'.$this->kpi_min.'">0</option>';
				for($i=$this->kpi_max;$i>$this->kpi_min;$i--)
				{
					if($vValue==$i)
						$vRetrun=$vRetrun.'<option selected="selected" value="'.$i.'">'.$i.'</option>';
					else
						$vRetrun=$vRetrun.'<option value="'.$i.'">'.$i.'</option>';
				}
				$vRetrun=$vRetrun.'</select>';
				break;
			case 2:
				$vRetrun='<select onblur="UpdateText(this,\''.$vAutoID.'\','.$vCotIndex.')" class="selenterquick" tabindex="2" style="width:100%;min-width:35px" onKeyPress="return CheckKey(event,7)">';
				$vRetrun=$vRetrun.'<option '.(($vValue==$this->kpi_min)?'selected="selected"':'').' value="'.$this->kpi_min.'">Không</option>';
				$vRetrun=$vRetrun.'<option '.(($vValue==$this->kpi_max)?'selected="selected"':'').' value="'.$this->kpi_max.'">Có</option>';
				$vRetrun=$vRetrun.'</select>';
				break;
			case 3:
				$vRetrun='<select onblur="UpdateText(this,\''.$vAutoID.'\','.$vCotIndex.')" class="selenterquick" tabindex="2" style="width:100%;min-width:35px" onKeyPress="return CheckKey(event,7)">';
				$vRetrun=$vRetrun.'<option '.(($vValue==$this->kpi_max)?'selected="selected"':'').' value="'.($this->kpi_max*1).'">A</option>';
				$vRetrun=$vRetrun.'<option '.(($vValue==$this->kpi_max*0.75)?'selected="selected"':'').' value="'.($this->kpi_max*0.75).'">B</option>';
				$vRetrun=$vRetrun.'<option '.(($vValue==$this->kpi_max*0.5)?'selected="selected"':'').' value="'.($this->kpi_max*0.5).'">C</option>';
				$vRetrun=$vRetrun.'<option '.(($vValue==$this->kpi_max*0.25)?'selected="selected"':'').' value="'.($this->kpi_max*0.25).'">D</option>';
				$vRetrun=$vRetrun.'<option '.(($vValue==$this->kpi_min)?'selected="selected"':'').' value="'.$this->kpi_min.'">0</option>';
				$vRetrun=$vRetrun.'</select>';
				break;
			case 4:
				$vRetrun='<input id="'.$vCotIndex.'_HTNV-BP" type="textbox" onblur="UpdateText(this,\''.$vAutoID.'\','.$vCotIndex.')" class="selenterquick" tabindex="2" style="width:100%;min-width:35px;text-align:center" onKeyPress="return CheckKey(event,7)" value="'.$vValue.'"/>';
				break;
			case 5:
				$vRetrun='<select onblur="UpdateText(this,\''.$vAutoID.'\','.$vCotIndex.')" class="selenterquick" tabindex="2" style="width:100%;min-width:35px" onKeyPress="return CheckKey(event,7)">';
				$vRetrun=$vRetrun.'<option '.(($vValue==$this->kpi_max*0.2)?'selected="selected"':'').' value="'.($this->kpi_max*0.2).'">'.($this->kpi_max*0.2).'</option>';
				$vRetrun=$vRetrun.'<option '.(($vValue==$this->kpi_max*0.1)?'selected="selected"':'').' value="'.($this->kpi_max*0.1).'">'.($this->kpi_max*0.1).'</option>';
				$vRetrun=$vRetrun.'<option '.(($vValue==$this->kpi_min)?'selected="selected"':'').' value="'.$this->kpi_min.'">0</option>';
				$vRetrun=$vRetrun.'</select>';
				break;
		}
		return $vRetrun;
	}	
	function LV_ShowShortNote($vCode,$vTextNote,$vSoKyTu=69)
	{
		$vStrLen=strlen($vTextNote);
		if($vStrLen<=$vSoKyTu) return $vTextNote;
		//$vCode,$vlv001='',$vlv002='',$vTenNV='',$vTime1='',$vTenNguoiSua='',$vTime=''
		$vSoKyTuLayVe=$vSoKyTu;
		$vNoteShort=$this->LV_GetTextNote($vTextNote,$vSoKyTu,$vSoKyTuLayVe);
		if($vSoKyTuLayVe==$vStrLen)
		{
			return $vTextNote;
		}
		$vNoteBase64=base64_encode($vNoteShort);
		if($vTime=='X')
			$vTyle='color:#000';
		else
			$vTyle='color:red;text-decoration:underline;';
		$vStrCode='<div style="cursor:pointer;color:blue;/*position:relative;*/" onclick="showNoteMore(\'shownoteid_'.$vCode.'\')" title="'.$vTextNote.'">'.$vNoteShort.'</div>
					<div style="display:none;position:absolute;z-index:999999999999;background:#efefef;width:360px;" id="shownoteid_'.$vCode.'" class="noidung_note">	
					<div id="shownotenoidung_'.$vCode.'" style="min-width:346px;overflow:hidden;overflow1: scroll;border:3px #f3b12b solid;border-radius:5px;padding:5px;">
					<img onclick="document.getElementById(\'shownoteid_'.$vCode.'\').style.display=\'none\';" width="20" src="../images/icon/close.png"/>
					'.$vTextNote.'
					</div>
				</div>	
				';	
		return $vStrCode;
	}
	function LV_GetTextNote($vTextNote,$vSoKyTu=69,&$vSoKyTuLayVe=0)
	{
		$vStrLen=strlen($vTextNote);
		$viMore=0;
		for($i=$vSoKyTu;$i<$vStrLen;$i++)
		{
			$vChar=substr($vTextNote,$i,1);
			if($vChar==' ')
			{
				break;
			}
			$viMore++;
		}
		$vTraVe=substr($vTextNote,0,$vSoKyTu+$viMore);
		$vSoKyTuLayVe=strlen($vTraVe);
		return $vTraVe.'...';
	
	}
}
?>