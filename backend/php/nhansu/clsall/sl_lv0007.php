<?php
/////////////coding sl_lv0007///////////////
class   sl_lv0007 extends lv_controler
{
	public $lv001=null;
	public $isBOM =null;
	public $lv099 =null;
	public $Dir =null;
	
	
	 
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
///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv022,lv099,lv299,lv098";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	public $ArrReturnAll=null;
	protected $objhelp='sl_lv0007';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv022"=>"23","lv099"=>"100","lv299"=>"300","lv098"=>"99");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"0","lv006"=>"0","lv007"=>"10","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0","lv012"=>"0","lv013"=>"0","lv014"=>"6","lv015"=>"0","lv016"=>"0","lv017"=>"0","lv018"=>"10","lv019"=>"10","lv022"=>"10","lv099"=>"0","lv299"=>"6","lv098"=>"0");	

	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;
	 	$this->isFil=1;	
		$this->img_height=50;
		
		$this->isApr=0;		
		$this->isUnApr=0;
		$this->lang=$_GET['lang'];		
	}	
	function LV_AutoDongBoBOM($lvarr)
	{
		if($lvarr!='')
			$lvsql = "select lv001  FROM sl_lv0007  WHERE sl_lv0007.lv001 IN ($lvarr)";
		else
			$lvsql = "select distinct A.lv001  FROM sl_lv0007 A inner join mn_lv0004 B on A.lv001=B.lv002";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$this->LV_ProcessBOMAuto($vrow['lv001']);
		}
	}
	function LV_ProcessBOMAuto($vMaCha)
	{
		$vArrMaOK=Array();
		$lvsql = "select *  FROM mn_lv0004 where lv002='$vMaCha'";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($vArrMaOK[$vrow['lv003']])
			{
				$lvsql1 = "delete from mn_lv0004 where lv002='$vMaCha' and lv003='".$vrow['lv003']."'";
				$vresult1=db_query($lvsql1);
				if($vresult1) $this->InsertLogOperation($this->DateCurrent,'mn_lv0004.delete',sof_escape_string($lvsql1));
			}
			else
			{
				if($vrow['lv011']==1)
				{
					$this->LV_XuLyBomChoBom($vrow['lv002'],$vrow['lv003'],$vrow['lv004']);
				}
				else
				{
					$lvsql1="update mn_lv0004 set lv004='1' where lv002='".$vrow['lv002']."' and lv003='".$vrow['lv003']."'";
					$vresult1=db_query($lvsql1);
					if($vresult1) $this->InsertLogOperation($this->DateCurrent,'mn_lv0004.delete',sof_escape_string($lvsql1));
				}
			}
			$vArrMaOK[$vrow['lv003']]=true;
		}
	}
	function LV_XuLyBomChoBom($vMaCha,$vMaBong,$vSLBong)
	{
		////////Xu lý lấy BOM tu BOM CHA
		$vsql="select lv017 from  cr_lv0219 where lv003='$vMaCha' order by lv017 DESC";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($vrow['lv017']<>$vSLBong && $vrow['lv017']>0)
			{
				$vSLBong=$vrow['lv017'];
				if($vSLBong==0) $vSLBong=1;
				$lvsql1="update mn_lv0004 set lv004='".$vSLBong."' where lv002='".$vMaCha."' and lv003='$vMaBong'";
				$vresult1=db_query($lvsql1);
				if($vresult1) $this->InsertLogOperation($this->DateCurrent,'mn_lv0004.update',sof_escape_string($lvsql1));
			}
			else if($vSLBong==0)
			{
				$vSLBong=$vrow['lv017'];
				if($vSLBong==0) $vSLBong=1;
				$lvsql1="update mn_lv0004 set lv004='".$vSLBong."' where lv002='".$vMaCha."' and lv003='$vMaBong'";
				$vresult1=db_query($lvsql1);
				if($vresult1) $this->InsertLogOperation($this->DateCurrent,'mn_lv0004.update',sof_escape_string($lvsql1));
			}
			return;
		}
		////Cập nhật bóng đó lên BOM


	}
	function LV_LoadALL()
	{
		if($this->ArrReturnAll['9999999999999999999999999']) return;
		$this->ArrReturnAll['9999999999999999999999999']=true;
		$vsql="select lv001 from  sl_lv0007";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			$this->ArrReturnAll[$vrow['lv001']]=true;
		}
	}
	function LV_LoadArr($vArrItem)
	{
		if($this->ArrReturnAll['9999999999999999999999999']) return;
		$this->ArrReturnAll['9999999999999999999999999']=true;
		$vsql="select lv001 from  sl_lv0007 where lv001 in ($vArrItem)";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			$this->ArrReturnAll[$vrow['lv001']]=true;
		}
	}
	function LV_LoadArrOne($vArrItem)
	{
		if($this->ArrReturnAll1[$vArrItem]) return;
		$this->ArrReturnAll1[$vArrItem]=true;
		$vsql="select lv001 from  sl_lv0007 where lv001 in ($vArrItem)";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			$this->ArrReturnAll[$vrow['lv001']]=true;
		}
	}
	function LV_Load()
	{
		$vsql="select * from  sl_lv0007";
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
			$this->lv098=$vrow['lv098'];
		}
	}
	function LV_BuilQRcode($vLItemID,$vNumPrint=0)
	{
		$lvsql="select * from  sl_lv0007 Where lv001 in ($vLItemID)";
		$vresult=db_query($lvsql);
		$i=0;
		$vOrder=1;
		if($vNumPrint==0) $vNumPrint=1;
		while($vrow=db_fetch_array($vresult))
		{
			for ($j=1;$j<=$vNumPrint;$j++)
			{
			$i++;
			$vcode=(trim($vrow['lv017'])=='' || trim($vrow['lv017'])=='0')?$vrow['lv001']:$vrow['lv017'];
			//Local
			echo file_get_contents($this->domains."qrcode/index.php?data=".$vcode);
			//Mạng
			//echo file_get_contents("https://quanlykho.benthanhhouse.com.vn/qrcode/index.php?data=".$vcode);
			$vStrImg='../../qrcode/images/'.$vcode.'.png';
			if($i==1)echo '<table style="width:226px;height:150px;font:8px Arial;"><tr>';
			
			echo '<td style="padding-left:0px;padding-right:15px;width:150px;" valign="top">
			<center><img style="width:150px;height:150px;" src="'.$vStrImg.'"/></center>
			<div style="padding-left:5px;width:200px;"><div note="transform: rotate(-90deg);" style="width:200px;heigth:65px;"><center><font style="font:10px Arial;"><strong>'.$vrow['lv002']."</strong></font>".'<br/><font style="font:12px Arial;"><strong>Mã: '.$vrow['lv001'].'</strong></font></center></div></td>';
			
			if($i==2)
			{
				$vOrder++;
				echo '<td style="width:30px">&nbsp;</td></tr></table>';
				$i=0;
			}	
			}
		}
		if($i!=0) echo '</tr></table>';
	}
	function LV_BuilBarcode($vLItemID,$vNumPrint=0)
	{
		$lvsql="select * from  sl_lv0007 Where lv001 in ($vLItemID)";
		$vresult=db_query($lvsql);
		$i=0;
		$vOrder=1;
		if($vNumPrint==0) $vNumPrint=1;
		while($vrow=db_fetch_array($vresult))
		{
			for ($j=1;$j<=$vNumPrint;$j++)
			{
			$i++;
			$vcode=(trim($vrow['lv017'])=='' || trim($vrow['lv017'])=='0')?$vrow['lv001']:$vrow['lv017'];
			$vStrImg='../../clsall/barcode/barcode.php?barnumber='.$vcode.'&noshowimg=1';
			if($i==1)echo '<table style="width:438px;height:115px;font:8px Arial;"><tr>';
			
			echo '<td style="padding-left:0px;padding-right:6px;width:130px;" valign="top"><center><font style="font:8px Arial;"><strong>'.$vrow['lv002']."</strong></font><br/><strong>Giá:".$this->FormatView($vrow['lv007'],10).' '.$vrow['lv008'].'</strong><br/><font style="font:12px Arial;"><strong>'.$vrow['lv001'].'</strong></font></center>
			<center><img style="width:130px;" src="'.$vStrImg.'"/></center></td>';
			
			if($i==3)
			{
				$vOrder++;
				echo '<td style="width:30px">&nbsp;</td></tr></table>';
				$i=0;
			}	
			}
		}
		if($i!=0) echo '</tr></table>';
	}
	function LV_LoadWHID(&$vlv001,$vWhID)
	{
		if(trim($vlv001)=='') return;
		$lvsql="select B.* from wh_lv0012 A inner join  sl_lv0007 B on A.lv002=B.lv001 and A.lv003='$vWhID' Where B.lv001='$vlv001' or B.lv017='$vlv001'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vlv001=$vrow['lv001'];
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
			$this->lv098=$vrow['lv098'];
		}
		else
		{
			$this->lv001=NULL;
		}
	}
	function LV_LoadID(&$vlv001)
	{
		if(trim($vlv001)=='') return;
		$lvsql="select * from  sl_lv0007 Where lv001='$vlv001' or lv017='$vlv001'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vlv001=$vrow['lv001'];
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
			$this->lv098=$vrow['lv098'];
		}
		else
		{
			$this->lv001=NULL;
		}
	}
	function LV_LoadPriceID(&$vlv001)
	{
		if(trim($vlv001)=='') return;
		$lvsql="select * from  sl_lv0007 Where lv001='$vlv001' or lv017='$vlv001'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vlv001=$vrow['lv001'];
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
			$this->lv098=$vrow['lv098'];
		}
		else
		{
			$this->lv001=NULL;
		}
	}
	////////////
	function LV_ReplaceObj($vStrObj,$vrowobj)
	{
		$lvsql = "select * from cr_lv0018 ";
		$vresult= db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			//echo $vrowobj[$vrow['lv001']].'<br>';
			$vrowobj[$vrow['lv001']]=str_replace("<","&lt;",$vrowobj[$vrow['lv001']]);
			$vrowobj[$vrow['lv001']]=str_replace(">","&gt;",$vrowobj[$vrow['lv001']]);
			if($vrowobj[$vrow['lv001']]!='')
			{
				$vValues=$vrowobj[$vrow['lv001']];
				if(strpos($vValues,'|')===false)
				{
					$vValue=$vValues;
				}
				else
				{
					$vArrValue=explode("|",$vValues);
					$vValue=$vArrValue[1];
				}
				if(trim($vrow['lv007'])!='')
					$vStrObj=str_replace("{".$vrow['lv001']."}",$vrow['lv008'],$vStrObj);
				else
					$vStrObj=str_replace("{".$vrow['lv001']."}",$vrow['lv004'],$vStrObj);
				$vStrObj=str_replace("[".$vrow['lv001']."]",$vValue,$vStrObj);
			}
			else
			{
				$vStrObj=str_replace("{".$vrow['lv001']."}: ",'',$vStrObj);
				$vStrObj=str_replace("{".$vrow['lv001']."}:",'',$vStrObj);
				$vStrObj=str_replace("{".$vrow['lv001']."}",'',$vStrObj);
				$vStrObj=str_replace("[".$vrow['lv001']."]",$vrowobj[$vrow['lv001']],$vStrObj);
			}
		}
		$vStrObj=$this->LV_ReplaceEnter($vStrObj);
		return $vStrObj;
	}
	function LV_ReplaceEnter($vStrObj)
	{
		$vReturn='';
		$vArrObj=explode("\n",$vStrObj);
		foreach($vArrObj as $vLine)
		{
			$vLine=trim($vLine);
			if($vLine!='')
			{
				if($vReturn=='') 
					$vReturn=$vLine;
				else
					$vReturn=$vReturn."\n".$vLine;
			}
		}
		return $vReturn;
	}
	//Doc Catalogue đã ok
	function LV_ReadGetCatalogue($vID)
	{
		if($this->ArrCatalogue[$vID][0]) return;
		$this->ArrCatalogue[$vID][0]=true;
		$this->mocr_lv0013->LV_LoadID($vID);
		if($this->mocr_lv0013->lv001==null)
		{
			$this->mocr_lv0013->LV_LoadID('NONE');
		}
		$this->ArrCatalogue[$vID][4]=$this->mocr_lv0013->lv004;
		$this->ArrCatalogue[$vID][8]=$this->mocr_lv0013->lv008;
		$this->ArrCatalogue[$vID][9]=$this->mocr_lv0013->lv009;
		$this->ArrCatalogue[$vID][10]=$this->mocr_lv0013->lv010;
	}
	/// Liên kết cột lấy giá theo cấu trúc
	function LV_SendCodePriceCatalogue($vrow,$vCodePrice)
	{
		//Xử lý thêm ký tự /
		$vArrReturn=Array();
		$vStrField='';
		$vStrValue=''; 
		$vStrMore='';
		$vArrCode=explode(',',$vCodePrice);
		foreach($vArrCode as $vCode)
		{
			if(trim($vCode)!='')
			{
				$vSub=substr($vCode,0,1);
				if($vSub=='/')
				{
					$vField='lv'.Fillnum(substr($vCode,1,3),3);
					if($vStrField=='')
					{
						$vStrField=$vField;
						$vStrValue=$vrow[$vField];
					}
					else
					{
						$vStrField=$vStrField.",'@',".$vField;
						$vStrValue=$vStrValue."@".$vrow[$vField];
					}
					/*if($vStrMore=='')
					{
						$vStrMore=" ($vField like '%".$vrow[$vField]."%')";
					}
					else
					{
						$vStrMore=$vStrMore." and ($vField like '%".$vrow[$vField]."%')";
					}*/
				}
				else
				{
					$vField='lv'.Fillnum($vCode,3);
					if($vStrField=='')
					{
						$vStrField=$vField;
						$vStrValue=$vrow[$vField];
					}
					else
					{
						$vStrField=$vStrField.",'@',".$vField;
						$vStrValue=$vStrValue."@".$vrow[$vField];
					}
				}
			}
		}
		if($vStrField!='') $vStrField="concat(".$vStrField.")";
		$vArrReturn[0]=$vStrField;
		$vArrReturn[1]=$vStrValue;
		//Điều kiện hoặc
		$vArrReturn[2]=$vStrMore;
		return $vArrReturn;
	}
	function LV_GetDonVi($vDonVi)
	{
		$vDesc='';
		//Ưu tiên 1 mua hàng
		$lvsql="select lv001 from  sl_lv0005 Where UPPER(lv001)=UPPER('$vDonVi') and lv001<>''";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vDesc=trim($vrow['lv001']);
		}
		if($vDesc=='' || $vDesc==null)
		{
			$lvsql="select lv001 from  sl_lv0005 Where UPPER(lv002)=UPPER('$vDonVi') and lv001<>''";
			$vresult=db_query($lvsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				$vDesc=trim($vrow['lv001']);
			}
		}
		if($vDesc=='' || $vDesc==null)
		{
			$lvsql="select lv001 from  sl_lv0005 Where UPPER(lv003)=UPPER('$vDonVi') and lv001<>''";
			$vresult=db_query($lvsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				$vDesc=trim($vrow['lv001']);
			}
		}
		return $vDesc;
	}
	function LV_GetDescrition($vBomID)
	{
		$vDesc='';
		//Ưu tiên 1 mua hàng
		$lvsql="select lv011 from  wh_lv0022 Where lv003='$vBomID' order by lv001 desc limit 0,1";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vDesc=trim($vrow['lv011']);
		}
		/*
		if($vDesc=='' || $vDesc==null)
		{
			//Ưu tiên PBH.
			$lvsql="select lv011 from  cr_lv0276 Where lv003='$vBomID' order by lv001 desc limit 0,1";
			$vresult=db_query($lvsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				$vDesc=trim($vrow['lv011']);
			}
		}
			*/

	}
	function LV_CapNhatSanPhamMuaHang($lvarr)
	{
		if($lvarr=='')
		{
			$this->LV_LoadALL();
			$lvsql = "select lv003,lv005,lv011,lv130,lv299 from wh_lv0022 where (trim(lv003)<>'')";
		}
		else
		{
			$this->LV_LoadArr($lvarr);
			$lvsql = "select lv003,lv005,lv011,lv130,lv299 from wh_lv0022 where lv003 IN ($lvarr) and (trim(lv003)<>'')";
		}
		$vresult= db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$isRun=true;
			if($this->ArrReturnAll[$vCodeID]==true)
			{
				if(trim($vrow['lv003'])!='' && strlen(trim($vrow['lv003']))>=13)
				{
					$vDonVi=$this->LV_GetDonVi($vrow['lv005']);
					if($vDonVi=='') $vDonVi=$vrow['lv005'];
					$vCodeID=$vrow['lv003'];
					$vStrDes=$vrow['lv011'];
					$this->lv001=$vCodeID;
					$this->lv010=$vStrDes;
					$this->lv009=$vrow['lv299'];
					$this->lv004=$vDonVi;
					$this->lv005=$vDonVi;
					$this->LV_UpdateMainMota();
				}
			}
			else
			{
				if(trim($vrow['lv003'])!='' && strlen(trim($vrow['lv003']))>=13)
				{
					if(is_numeric(substr($vrow['lv003'],0,3)))
					{
						$vCodeID=$vrow['lv003'];
						$vStrDes=$vrow['lv011'];
						$vDonVi=$this->LV_GetDonVi($vrow['lv005']);
						if($vDonVi=='') $vDonVi=$vrow['lv005'];
						$this->lv001=$vCodeID;
						$this->lv002=$vrow['lv130'];
						$this->lv003='TP';
						$this->lv008='VND';
						$this->lv010=$vStrDes;
						$this->lv004=$vDonVi;
						$this->lv005=$vDonVi;
						$this->lv006=1;
						$this->lv016='';
						//Nha cung cấp
						$this->lv009=$vrow['lv299'];
						$this->lv013='';
						$this->lv017=$vItemWH;;
						$this->lv012='FIFO';
						$this->LV_Insert();
					}
							
				}
			}
		}
	}
	function LV_CapNhatSanPham($lvarr)
	{
		if($lvarr=='')
		{
			$this->LV_LoadALL();
			$lvsql = "select lv001,lv003,lv004,lv008,lv009,lv010,lv015,lv013,lv014,lv016,lv021,lv022,lv024,lv026,lv027,lv029,lv030,lv031,lv052,lv130 from cr_lv0219 where (trim(lv003)<>'')";
		}
		else
		{
			$this->LV_LoadArr($lvarr);
			$lvsql = "select * from cr_lv0219 where lv003 IN ($lvarr) and (trim(lv003)<>'')";
		}
		$vresult= db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$isRun=true;
			$vCodeID=$vrow['lv003'];
			if($this->ArrReturnAll[$vCodeID]==true)
			{
				if($lvarr=='') $isRun=false;
				if($this->isMota==1)
				{
					$vStrDes=$this->LV_GetDescrition($vrow['lv003']);
					if($vStrDes!='' && $vStrDes!=null)
					{
						$vCodeID=$vrow['lv003'];
						$this->lv001=$vCodeID;
						$this->lv010=$vStrDes;
						$this->LV_UpdateMainMota();
					}
				}
			}
			if($isRun)
			{
			if(trim($vrow['lv003'])!='' && strlen(trim($vrow['lv003']))>=13)
			{
				$vID=$vrow['lv004'];
				$vStrDes=$this->LV_GetDescrition($vrow['lv003']);
				if($vStrDes=='')
				{
					$this->LV_ReadGetCatalogue($vID);
					$vCodePrice=$this->ArrCatalogue[$vID][10];
					//if($this->IsVietNam==1)
						$vStrDes=$this->ArrCatalogue[$vID][9];
					//else
						//$vStrDes=$this->ArrCatalogue[$vID][8];			
					$vStrDes=$this->LV_ReplaceObj($vStrDes,$vrow);
					$vArrCodePrice=$this->LV_SendCodePriceCatalogue($vrow,$vCodePrice);
					$vCotSoSanh=$vArrCodePrice[0];
					$vGiaTriXuLy=$vArrCodePrice[1];
					$vGiaTriXuLyMore=$vArrCodePrice[2];
					//$vPriceChuan=
					//Biểu diễn mã kho
					//$vItemWH=$vGiaTriXuLy;
					$vItemWH='';
				}
				$vCodeID=$vrow['lv003'];
				if($lvarr=='')
				{
					if($this->ArrReturnAll[$vCodeID]!=true)
						{
							$this->lv001=$vCodeID;
							$this->lv002=$vrow['lv130'];
							$this->lv003='TP';
							$this->lv008='VND';
							$this->lv009=$vrow['lv004'];
							$this->lv010=$vStrDes;
							$this->lv004=$vrow['lv052'];
							$this->lv005=$vrow['lv052'];
							$this->lv006=1;
							$this->lv016='';
							//Nha cung cấp
							$this->lv009=$vrow['lv004'];
							$this->lv013='';
							$this->lv017=$vItemWH;;
							$this->lv012='FIFO';
							$this->LV_Insert();
						}
						else
						{
							$this->lv001=$vCodeID;
							$this->lv002=$vrow['lv130'];
							//$this->mosl_lv0007->lv004=$vrow['lv052'];
							//$this->mosl_lv0007->lv005=$vrow['lv052'];
							//$this->mosl_lv0007->lv006=1;
							$this->lv012='FIFO';
							$this->lv010=$vStrDes;
							$this->lv017=$vItemWH;
							$this->LV_UpdateMain();
						}
					}
					else
					{
						$this->lv001=$vCodeID;
							$this->lv002=$vrow['lv130'];
							//$this->mosl_lv0007->lv004=$vrow['lv052'];
							//$this->mosl_lv0007->lv005=$vrow['lv052'];
							//$this->mosl_lv0007->lv006=1;
							$this->lv012='FIFO';
							$this->lv010=$vStrDes;
							$this->lv017=$vItemWH;
							$this->LV_UpdateMain();
					}
					$this->ArrReturnAll[$vCodeID]=true;
					
			}
		}
		}
	}
	function LV_Insert()
	{
		
		if($this->isAdd==0) return false;
		$lvsql="insert into sl_lv0007 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv098) values('$this->lv001','".sof_escape_string($this->lv002)."','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','".sof_escape_string($this->lv010)."','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv018','$this->lv019','$this->lv020','$this->lv021','$this->lv098')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0007.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		if($this->lv001_=="") $this->lv001_=$this->lv001;
		$lvsql="Update sl_lv0007 set lv001='$this->lv001_',lv002='".sof_escape_string($this->lv002)."',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='".sof_escape_string($this->lv010)."',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016',lv017='$this->lv017',lv018='$this->lv018',lv019='$this->lv019'  where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0007.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateMain()
	{
		if($this->isEdit==0) return false;
		$lvsql="Update sl_lv0007 set lv002='".sof_escape_string($this->lv002)."',lv010='".sof_escape_string($this->lv010)."',lv012='".sof_escape_string($this->lv012)."',lv017='".sof_escape_string($this->lv017)."',lv017='".sof_escape_string($this->lv017)."'  where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0007.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateMainMota()
	{
		if($this->isEdit==0) return false;
		$lvsql="Update sl_lv0007 set lv010='".sof_escape_string($this->lv010)."',lv004='".sof_escape_string($this->lv004)."',lv005='".sof_escape_string($this->lv005)."',lv009='".sof_escape_string($this->lv009)."'  where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0007.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM sl_lv0007  WHERE sl_lv0007.lv001 IN ($lvarr) and (select count(*) from sl_lv0014 B where  B.lv003= sl_lv0007.lv001)<=0";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0007.delete',sof_escape_string($lvsql));
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
	function LV_GetItemToBOM($vItemID,$vCateID)
	{
		$vListItem='';
		$vcondition='';
		if($vItemID!='') $vcondition=" and t1.lv002='$vItemID'";
		if($vCateID!="")
		{
			if(strpos($vCateID,","))
			{
					$vcondition=$vcondition." and t2.lv003 in ('".str_replace(",","','",$vCateID)."')";
			}
			else
			{
					$vcondition=$vcondition." and t2.lv003 = '$vCateID'";
			}
		}
		$this->ArrItemView=Array();
		//if($vcondition=='') return  '';
		$vslq="select distinct t2.lv001,IF(t1.lv002=t1.lv003,1,0) IsParent  from  mn_lv0004 t1 inner join sl_lv0007 t2 on t1.lv002=t2.lv001 where 1=1 $vcondition";
		$vresult=db_query($vslq);
		while($vrow=db_fetch_array($vresult))
		{
			if($vListItem=='')
				$vListItem="'".$vrow['lv001']."'";
			else
				$vListItem=$vListItem.",'".$vrow['lv001']."'";
			if($vrow['IsParent']==1) $this->ArrItemView[$vrow['lv001']]=true;
		}
		return  $vListItem;
	}
	//////////Get Filter///////////////
	protected function GetCondition()
	{
		$strCondi="";
		if($this->isBOM==1)
		{
			$vListItem=$this->LV_GetItemToBOM($this->lv001,$this->lv003);
			if($vListItem!="") $strCondi=$strCondi." and lv001 not in ($vListItem)";
		}
		if($this->lv001!="")
		{
			if(strpos($this->lv001,","))
			{
					$strCondi=$strCondi." and lv001 in ('".str_replace(",","','",$this->lv001)."')";
			}
			else
			{
					$strCondi=$strCondi." and lv001 = '$this->lv001'";
			}
		}
		if($this->lv002!="")
		{
			if(strpos($this->lv002,","))
			{
					$strCondi=$strCondi." and lv002 in ('".str_replace(",","','",$this->lv002)."')";
			}
			else
			{
					$strCondi=$strCondi." and lv002 = '$this->lv002'";
			}
		}
		if($this->lv003!="")
		{
			if(strpos($this->lv003,","))
			{
					$strCondi=$strCondi." and lv003 in ('".str_replace(",","','",$this->lv003)."')";
			}
			else
			{
					$strCondi=$strCondi." and lv003 = '$this->lv003'";
			}
		}
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
		if($this->lv017!="")
		{
			if(strpos($this->lv017,","))
			{
					$strCondi=$strCondi." and lv017 in ('".str_replace(",","','",$this->lv017)."')";
			}
			else
			{
					$strCondi=$strCondi." and lv017 = '$this->lv017'";
			}
		}
		if($this->lv099!="")
		{
			
			$strCondi=$strCondi." and lv001 in ($this->ListItem)";
		}
		$strwh=$this->Get_WHControler();
		$strCondi=$strCondi." and lv016 in ($strwh)";
		return $strCondi;
	}
		////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0007 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_GetGiaVon($vlv001,$vWHID)
	{
		$vslq="select IF(ISNULL(C.lv008),0,C.lv008) giavon from wh_lv0012 C where C.lv002='$vlv001' and C.lv003='NHANKHO'";
		/*if($vWHID!="")
			$vslq="select IF(ISNULL(C.lv008),0,C.lv008) giavon from wh_lv0012 C where C.lv002='$vlv001' and C.lv003='$vWHID'";
		else
			$vslq="select sum(A.lv004*IF(ISNULL(C.lv008),0,C.lv008)) giavon from mn_lv0004 A inner join sl_lv0007 B on A.lv003=B.lv001 left join wh_lv0012 C on B.lv001=C.lv002 and B.lv016=C.lv003 where A.lv002='$vlv001'";*/
		$vresult=db_query($vslq);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return round($vrow['giavon'],0);
		}
		return 0;
	}
	function LV_UpdateSQL($lvsql)
	{							
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0007.update',sof_escape_string($lvsql));
		return $vReturn;			
	}
	function LV_GetBarcode()
	{
		$vslq="select * from mn_lv0005";
		$vresult=db_query($vslq);
		while($vrow=db_fetch_array($vresult))
		{
			if(!(strpos($vrow['lv001'],$this->lv099)===false)) 
			{
				if($this->ListItem=='')
					$this->ListItem="'".$vrow['lv002']."'";
				else
					$this->ListItem=$this->ListItem.",'".$vrow['lv002']."'";

			}
			if($this->ArrBarcode[$vrow['lv002']]==null || $this->ArrBarcode[$vrow['lv002']]=='')
				$this->ArrBarcode[$vrow['lv002']]=$vrow['lv001'];
			else
				$this->ArrBarcode[$vrow['lv002']]=$this->ArrBarcode[$vrow['lv002']].",".$vrow['lv001'];
		}
		
	}
	function LV_BOMView($vItemID)
	{
		$vslq="select count(*) nums from mn_lv0004 C where C.lv002='$vItemID'";
		$vresult=db_query($vslq);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['nums'];
		}
		return 0;
	}
	function LV_GetCodeKho($vItemID)
	{
		
		 $vslq="select lv001 from sl_lv0007 where lv001='$vItemID' or lv017='$vItemID'";
		$vresult=db_query($vslq);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			if($vrow['lv001']!=null && trim($vrow['lv001'])!='') return $vrow['lv001']; 
		}

		$vslq="select lv002 from mn_lv0005 where lv001='$vItemID'";
		$vresult=db_query($vslq);
		while($vrow=db_fetch_array($vresult))
		{
			return $vrow['lv002'];
			
		}
		return '';
	}
	//////////////////////Buil list////////////////////
	function LV_BuilList($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		if($curRow<0) $curRow=0;	$this->LV_GetBarcode();
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
			<td width=1%><input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckOne($lvFrom, '$lvChk', '$lvChkAll', this)\" value='@02' tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"/></td>
			@#01
		</tr>
		";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"2\">&nbsp;</td>";
		$lvHref="<a href=\"javascript:FunctRunning1('@01')\" style=\"text-decoration:none\">@02</a>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT * FROM sl_lv0007 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$strH = '';
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
			$vtotalgia=$vtotalgia+$vrow['lv007'];
			$vStrImg='';
			/*if($this->isBOM==1)
			{
				$vStrImg='bom.png';
			}
			else*/
			{
				$isBOM=$this->LV_BOMView($vrow['lv001']);
				if($isBOM)
				{
					$vStrImg='bom.png';
				}
			}
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv299':
						if($this->ArrItemView[$vrow['lv001']])
						{
							$vStrImg='bom_ok.png';
						}
						//$vStrImg='../clsall/barcode/barcode.php?barnumber='.$vrow['lv001'];
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vStrImg,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv099':
						$vBarcode=$this->ArrBarcode[$vrow['lv001']];
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vBarcode,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv022':
						$vGiaVon=$this->LV_GetGiaVon($vrow['lv001'],$vrow['lv016']);
						$vtotalgiavon=$vtotalgiavon+$vGiaVon;
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vGiaVon,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				/*	case 'lv017':
						$vcode=(trim($vrow['lv017'])=='' || trim($vrow['lv017'])=='0')?$vrow['lv001']:$vrow['lv017'];
						$vStrImg='../clsall/barcode/barcode.php?barnumber='.$vcode;
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vStrImg,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;*/
					case 'lv098';
							$vField=$lstArr[$i];
							$vSTTCot=(int)substr($lstArr[$i],2,3);
							$vID=$vrow['lv001'];				
							$vStringNumber=' onblur="UpdateTextCheck(this,\''.$vID.'\','.$vSTTCot.')" ';	
							$vstr="<input ".$vStringNumber." autocomplete=\"off\"   type=\"checkbox\" value=\"1\" ".(($vrow[$vField]==1)?'checked="true"':'')." @03  style=\"text-align:center;\" tabindex=\"2\" maxlength=\"32\"   onKeyPress=\"return CheckKey(event,7)\"/>";
							$vTemp=str_replace("@02",$vstr,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
		}
		$vtotalgia = '';
		$vtotalgiavon = '';
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv007-->",$this->FormatView($vtotalgia,10),$strF);
		$strF=str_replace("<!--lv022-->",$this->FormatView($vtotalgiavon,10),$strF);
		$strF=str_replace("<!--lv003-->",'<p style="text-align:center;padding:5px">Tổng:</p>',$strF);
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
			var text='&txtlv001='+document.frmchoose.txtlv001.value+'&txtlv002='+document.frmchoose.txtlv002.value+'&txtlv003='+document.frmchoose.txtlv003.value
			window.open('sl_lv0007/?lang=".$this->lang."&func='+value+text,'','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
		$lvTable="
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
		$strF="<tr><td colspan=\"2\">&nbsp;</td>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT * FROM sl_lv0007 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT 0, 2000";
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
			$vtotalgia=$vtotalgia+$vrow['lv007'];
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
				case 'lv022':
					$vGiaVon=$this->LV_GetGiaVon($vrow['lv001'],$vrow['lv016']);
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vGiaVon,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				/*case 'lv017':
					$vcode=(trim($vrow['lv017'])=='' || trim($vrow['lv017'])=='0')?$vrow['lv001']:$vrow['lv017'];
						$vStrImg='../../clsall/barcode/barcode.php?barnumber='.$vcode;
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vStrImg,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;*/
				default:
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				}
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv007-->",$this->FormatView($vtotalgia,10),$strF);
		$strF=str_replace("<!--lv022-->",$this->FormatView($vtotalgiavon,10),$strF);
		$strF=str_replace("<!--lv003-->",'<p style="text-align:center;padding:5px">Tổng:</p>',$strF);
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
			case 'lv003':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0006";
				break;
			case 'lv004':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0005";
				break;
			case 'lv005':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0005";
				break;
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018 order by lv004";
				break;
			case 'lv012':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0003";
				break;
			case 'lv013':
				$vsql="select lv001,concat(lv001,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0003 where lv018=3";
				break;
			case 'lv016':
				$strwh=$this->Get_WHControler();
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0001  where lv001 in ($strwh)";
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
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0006 where lv001='$vSelectID'";
				break;
			case 'lv004':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0005 where lv001='$vSelectID'";
				break;
			case 'lv005':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0005 where lv001='$vSelectID'";
				break;
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018 where lv001='$vSelectID'";
				break;
			case 'lv012':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0003 where lv001='$vSelectID'";
				break;
			case 'lv013':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0003 where lv001='$vSelectID'";
				break;
			case 'lv016':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0001 where lv001='$vSelectID'";
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