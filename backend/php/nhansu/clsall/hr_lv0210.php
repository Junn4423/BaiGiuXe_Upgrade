<?php
/////////////coding hr_lv0210///////////////
class   hr_lv0210 extends lv_controler
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
	public $doanhthu=null;
	public $percent1=null;
	public $percent2=null;
	public $percent4=null;
	public $percent3=null;
///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='hr_lv0211';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"10","lv010"=>"0","lv011"=>"10","lv012"=>"0","lv013"=>"10","lv014"=>"0","lv015"=>"0","lv015"=>"0");	

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
	}
	function LV_Load()
	{
		$vsql="select * from  hr_lv0211";
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
	function LV_GetLevel($vStaffID)
	{
		$lvsql="select lv019,lv025 from  hr_lv0020 Where lv001='$vStaffID'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			if($vrow['lv019']=='' || $vrow['lv019']==null)
				return $vrow['lv025'];
			else
				return $vrow['lv019'];
		}
		return 'AA';
	}
	function LV_GetGroupID($vStaffID)
	{
		$lvsql="select lv001 from  lv_lv0007 Where lv001='$vStaffID'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			
				return $vrow['lv001'];
		}
		return '';
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  hr_lv0211 Where lv001='$vlv001'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv001=$vrow['lv001'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv038=$vrow['lv038'];
			$this->lv039=$vrow['lv039'];
			$this->lv041=$vrow['lv041'];
			$this->lv014=$vrow['lv014'];
			$this->lv106=$vrow['lv106'];
			$this->lv126=$vrow['lv126'];
			$this->lv013=$vrow['lv013'];
			$this->lv010=$vrow['lv010'];
			$this->lv011=$vrow['lv011'];
			$this->lv012=$vrow['lv012'];
			
		}
	}
	function  LV_TaiLieuThanhVien($vDepID)
	{
		$vLineAllSearch="";
		$vStrReturn='
		<div class="tailieu_tab" style="float:left;width:100%;">
			<ul>
				@01
			</ul>
		</div>
		';
		$vLi='
		<li >
		<div style="width:100%;overflow:hidden;" class="licafe litangleft" onclick="ShowHide(\'@01\')"><strong>- @02</strong></div>
			<ul id="litangleft_@01" style="display:none;overflow:hidden;">
				@#03
			</ul>
		</li>';
		$vLiChild='
		<li >
			<div style="clear:both;width:100%;text-transform: uppercase;"  class="litangleft" onclick1="viewfloor(\'@01\')"><strong>+ @02</strong></div>
			<div style="clear:both;width:100%;"  id="litangleftnd_@01">@#03</div>
		</li>';
		
		$sqlS1 = "SELECT  * FROM hr_lv0214  where (lv003='' or ISNULL(lv003))  order by lv004 ASC";
		$bResult1 = db_query($sqlS1);
		while ($vrow1 = db_fetch_array ($bResult1))
		{
			$vLi1=$vLi;	
			$vLi1=str_replace("@01",$vrow1['lv001'],$vLi1);
			$vLi1=str_replace("@02",$vrow1['lv002'],$vLi1);
			$vStrLi=$vStrLi.$vLi1;
			$vTable='
			<div  id="viewhere_'.$vrow1['lv001'].'" style="float:left;width:100%;padding-bottom:30px;padding-left:15px;" class="mob_table" >
			<table align="center" class="lvtable" style="padding-left:15px;background:#fff!important;">
			<tbody>
			<!--<tr class="lvhtable">
				<td width="*%" class="lvhtable" colspan="14">'.$vrow1['lv002'].'</td>
			</tr>-->
			<tr class="lvlinehtable0">
				<td style="text-align:center;width:1%"><strong>STT</strong></td>
				<td style="text-align:center;"><strong>Tên tài liệu</strong></td>
				<td style="text-align:center;width:100px;"><strong>Tải</strong></td>
				<td style="text-align:center;width:100px;"><strong>Ngày tạo</strong></td>
				</tr>
			@#01
			</tbody>
			</table>
			</div>
			';
			$vTr='
			<tr class="lvlinehtable@#01">
				<td align="left">@01</td>
				<td align="left">@02</td>
				<td align="center">@03</td>
				<td align="center">@04</td>
			</tr>';
			$vSumTr='
			<tr class="lvlinehtable0">
				<td align="left"><strong>@01</strong></td>
				<td align="left"><strong>@02</strong></td>
				<td align="center"><strong>@03</strong></td>
				<td align="center"><strong></strong></td>
			</tr>';
			$vLineAll='';
			$vThuHang=$this->ThuHangHienTai;
			/*$sqlS = "SELECT  * FROM hr_lv0211 WHERE  lv003='".$vrow1['lv001']."' and lv006=1 and ( (concat(',',lv007,',') like '%,$vThuHang,%') )  order by lv009 ASC";
			$bResult = db_query($sqlS);
			$vOrder=0;
			while ($vrow = db_fetch_array ($bResult)){
				$vLineOne=$vTr;
				$vOrder++;
				$vLineOne=str_replace("@#01",($vOrder%2),$vLineOne);
				$vLineOne=str_replace("@01",$vOrder,$vLineOne);
				$vLineOne=str_replace("@02",$vrow['lv002'],$vLineOne);
				$lvImg="<a target='_blank' href='hr_lv0210/readfile.php?ContractID=".$vrow['lv001']."&type=8&size=0'>Tải tập tin</a>";
				$vLineOne=str_replace("@03",$lvImg,$vLineOne);
				$vLineOne=str_replace("@04",$vrow['lv004'],$vLineOne);
				$vLineOne=str_replace("@05",$vrow['lv005'],$vLineOne);
				$vLineAll=$vLineAll.$vLineOne;
			}
			$vTable=str_replace("@#01",$vLineAll,$vTable);
			if($vLineAll!='') $vTables=$vTables.$vTable;*/
			$vLineAll='';
			$strCondi='';
			
			$sqlS2 = "SELECT  * FROM hr_lv0214  where lv003='".$vrow1['lv001']."' order by lv004 ASC";
			$bResult2 = db_query($sqlS2);
			$vStrLi2='';
			$vStrLi22='';
			while ($vrow2 = db_fetch_array ($bResult2))
			{
				$vLi1=$vLiChild;	
				$vLi1=str_replace("@01",$vrow2['lv001'],$vLi1);
				$vLi1=str_replace("@02",$vrow2['lv002'],$vLi1);
				$vStrLi22=$vStrLi22.$vLi1;
				$vTable='
				<div  id="viewhere_'.$vrow1['lv001'].'" style="float:left;width:100%;padding-bottom:30px;" class="mob_table" >
				<table align="center" class="lvtable" style="padding-left:15px;">
				<tbody>
				<!--<tr class="lvhtable">
					<td width="*%" class="lvhtable" colspan="14">'.$vrow1['lv002'].'</td>
				</tr>-->
				<tr class="lvlinehtable0">
					<td style="text-align:center;width:1%;"><strong>STT</strong></td>
					<td style="text-align:center;"><strong>Tên tài liệu</strong></td>
					<td style="text-align:center;"><strong>Tên tập tin</strong></td>
					<td style="text-align:center;width:100px;"><strong>Tải về</strong></td>
					<td style="text-align:center;width:100px;"><strong>Ngày tạo</strong></td>
					</tr>
				@#01
				</tbody>
				</table>
				</div>
				';
				$vTr='
				<tr class="lvlinehtable@#01 @#99" >
					<td align="left">@01</td>
					<td align="left">@22</td>
					<td align="left">@02</td>
					<td align="center">@03</td>
					<td align="center">@04</td>
				</tr>';
				$vSumTr='
				<tr class="lvlinehtable0">
					<td align="left"><strong>@01</strong></td>
					<td align="left"><strong>@22</strong></td>
					<td align="left"><strong>@02</strong></td>
					<td align="center" nowrap><strong>@03</strong></td>
					<td align="center" nowrap><strong></strong></td>
				</tr>';
				$vLineAll='';
				$strCondiOk='';
				if($this->lv002!='')
				{
					if(!strpos($this->lv002,',')===false)
					{	
						$vArrNameCus=explode(",",$this->lv002);
						foreach($vArrNameCus as $vNameCus)
						{
							if($vNameCus!="")
							{
							if($strCondiOk=="")	
								$strCondiOk= " AND ( lv002 = '$vNameCus'";
							else
								$strCondiOk=$strCondiOk." OR lv002 = '$vNameCus'";		
							}
						}
						$strCondiOk=$strCondiOk.")";
						
					}
					else
					{
						$strCondiOk=$strCondiOk." and lv002  = '$this->lv002'";
					}
				}
				$vThuHang=$this->ThuHangHienTai;
				//and ( (concat(',',lv007,',') like '%,$vThuHang,%') )
				if($this->LV_UserID=='MP001' || $vDepID=='')
					$sqlS = "SELECT  * FROM hr_lv0211  where 1=1 $strCondiOk and lv003='".$vrow2['lv001']."' and lv007=1   order by lv009 ASC";
				else
					$sqlS = "SELECT  * FROM hr_lv0211  where 1=1 $strCondiOk and  lv003='".$vrow2['lv001']."' and lv007=1  and concat(',',lv008,',') like '%,$vDepID,%'  order by lv009 ASC";
					$bResult = db_query($sqlS);
				$vOrder=0;
				while ($vrow = db_fetch_array ($bResult)){
					$vLineOne=$vTr;
					if($vrow['lv011']==1)
					{
						$vLineOne=str_replace("@#99","nhapnhay",$vLineOne);
					}
					else
					{
						$vLineOne=str_replace("@#99","",$vLineOne);
					}
					
					$vOrder++;
					$vLineOne=str_replace("@#01",($vOrder%2),$vLineOne);
					$vLineOne=str_replace("@01",$vOrder,$vLineOne);
					$vLineOne=str_replace("@02",$vrow['lv004'],$vLineOne);
					$vLineOne=str_replace("@22",$vrow['lv002'],$vLineOne);
					$lvImg="<table >
								<tr>
									<td nowrap >
										<a target='_blank' href='hr_lv0210/readfile.php?FileID=".$vrow['lv001']."&type=8&size=0'>Tải tập tin</a>
									</td>
									<td>|</td>
									<td nowrap>
										<a target='_blank' href='hr_lv0210/readviewdata.php?FileID=".$vrow['lv001']."&type=8&size=0'>Xem nhanh</a>
									</td>
								</tr>		
							</table>";
					$vLineOne=str_replace("@03",$lvImg,$vLineOne);
					$vLineOne=str_replace("@04",$this->FormatView($vrow['lv010'],2),$vLineOne);
					//$vLineOne=str_replace("@05",$vrow['lv005'],$vLineOne);
					$vLineAll=$vLineAll.$vLineOne;
					$vLineAllSearch=$vLineAllSearch.$vLineOne;
				}
				
				if($vLineAll!='')
				{
					$vTable1=str_replace("@#01",$vLineAll,$vTable);
					$vStrLi22=str_replace("@#03",$vTable1,$vStrLi22);
					$vStrLi2=$vStrLi2.$vStrLi22;
					$vStrLi22='';
				}
				else
				{
					//$vTable1=str_replace("@#01",'',$vTable);
					//$vStrLi2=str_replace("@#03",$vTable1,$vStrLi2);
					$vStrLi22='';
					$vStrLi2=$vStrLi2.$vStrLi22;
				}
				//$vStrLi=str_replace("@#03",$vStrLi2,$vStrLi);
				//if($vLineAll!='') $vTables=$vTables.$vTable;
				//$vTables=$vTables.$vTable;
				$vLineAll='';
			}
			$vStrLi=str_replace("@#03",$vStrLi2,$vStrLi);
		}
		if($this->lv002!='')
		{
			$vStrReturn=str_replace("@#01",$vLineAllSearch,$vTable);
			return $vStrReturn;
		}
		else
		{
			$vStrReturn=str_replace("@01",$vStrLi,$vStrReturn);
			return $vStrReturn.$vTables;
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
}
?>