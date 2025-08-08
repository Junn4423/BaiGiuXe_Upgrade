<?php
class ml_lv0015 extends lv_controler{
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
	public $Inbox=null;
	public $Outbox=null;
	public $DeleteItem=null;
	public $SendItem=null;
	public $Domain="";
	public $DirLink="";
///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014";	
////////////////////GetDate
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='ml_lv0014';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"2","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"3","lv010"=>"0","lv011"=>"10","lv012"=>"10","lv013"=>"3","lv014"=>"0");
	
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;	
	 	$this->isFil=1;	
	
		$this->isApr=0;		
		$this->isUnApr=0;
		$this->lang=$_GET['lang'];
		
	}
function LV_Insert()
	{
		$lvsql="insert into ml_lv0001 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv018','$this->lv019')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ml_lv0001.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_InsertAutoID()
	{
		$lvsql="insert into ml_lv0001 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv018','$this->lv019')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ml_lv0001.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_InsertAuto()
	{
		$lvsql="insert into ml_lv0001 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv018','$this->lv019')";
		$vReturn= db_query($lvsql);
	//	if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ml_lv0001.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Update()
	{
		 $lvsql="Update ml_lv0001 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ml_lv0001.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateState()
	{
		$lvsql="Update ml_lv0001 set lv011=0 where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ml_lv0001.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateDel()
	{
		 $lvsql="Update ml_lv0001 set lv012=1 where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ml_lv0001.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM ml_lv0001  WHERE ml_lv0001.lv001 IN ($lvarr) and (select count(*) from hr_lv0002 B where  B.lv002= ml_lv0001.lv001)<=0  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ml_lv0001.delete',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_DeleteState($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "update ml_lv0001 set lv012=lv012+1  WHERE ml_lv0001.lv001 IN ($lvarr)   ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ml_lv0001.delete',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Aproval($lvcontent,$lvtitle,$lvnum,$lvuser,$lvemail)
	{
		if($this->isView==0) return false;
		$lvsql = "select A.lv001,A.lv002,A.lv003,A.lv004 from ml_lv0015 A  WHERE A.lv002='$lvuser'  limit 0,$lvnum";
		$vReturn= db_query($lvsql);
		$lvListId_del="";
		if(!$vReturn) return;
		$lvml_lv0008=new ml_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0008');
		$lvml_lv0007=new ml_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0007');
		$lvml_lv0100=new ml_lv0100($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0100');		
		$lvml_lv0009=new ml_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0009');
		$lvml_lv0009->LV_LoadSMTP();
		$lvml_lv0008->LV_LoadUser($lvuser,$lvemail);
		$lvml_lv0007->LV_LoadUser($lvuser,$lvemail);
		$lvcontent=$lvcontent.str_replace("\n","<br/>",$lvml_lv0007->lv004);
		$this->Domain=$lvml_lv0009->lv010;
		while ($vrow = db_fetch_array ($vReturn)){
			$vstrTo=SplitTo(str_replace(";",",",str_replace(" ","",$vrow['lv003'])),"<",">",",");
			$vstrToSend=$this->SplitToEsc($vstrTo,",",0);
			$lvml_lv0100=new ml_lv0100($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0100');
			$lvml_lv0100->To(explode(",",$vstrToSend));		
			//if($vrow['lv013']!="" || $vrow['lv013']!=NULL)
			//{
			//	$ArrAttach=explode("<@>",$vrow['lv013']);
			//	foreach($ArrAttach as $vAttach)
			//	{
			//		$vname=strrchr($vAttach,"/");
			//		$lvml_lv0100->Attach($vAttach,substr($vname,1,strlen($vname)-1),"attachment")	;
			//	}
			//}		
			if($lvml_lv0008->lv005==1)
			{
					$lvml_lv0100->lvml_lv0009=$lvml_lv0009;
					$lvml_lv0100->lvml_lv0008=$lvml_lv0008;
					$lvml_lv0100->To(explode(",",$vstrToSend));
					$lvml_lv0100->From($lvemail);
					$lvml_lv0100->Subject($lvtitle);
					$lvml_lv0100->Priority(3);	
					$lvml_lv0100->Content_type("multipart/related");
					$lvml_lv0100->charset="utf-8";
					$lvml_lv0100->ctencoding="quoted-printable";
					$lvml_lv0100->Cc(explode(",",$vstrCCSend));
					$lvml_lv0100->Bcc(explode(",",$vstrBCCSend));
					$lvml_lv0100->Body($lvcontent,'');
					$lvml_lv0100->Content_type('text/html');
					if($lvml_lv0100->Send())
					{
						if($lvListId_del=="")
							$lvListId_del=$vrow['lv001'];
						else
							$lvListId_del=$lvListId_del.",".$vrow['lv001'];
						echo 'Thành công gửi! Email:'.$vrow['lv003']."<br/>";
					}
					else	
						echo 'Không thành công ! Email:'.$vrow['lv003']."<br/>";
				
				
			}
		
		}	
		$lvsql = "delete from ml_lv0015 WHERE lv001 in ($lvListId_del)";
		$vReturn= db_query($lvsql);
		
		return $vReturn;
	}
	function LV_UnAproval($lvarr)
	{
		if($this->isUnApr==0) return false;
		$lvsql = "Update ml_lv0001 set lv018=2  WHERE ml_lv0001.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ml_lv0001.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function SendLocal($vAddMailTo,$vAddMailCC,$vAddMailBCC,$vType,$vNew,$vDelete)
	{
		$this->lv002=$vType;
		$this->lv011=$vNew;
		$this->lv012=$vDelete;
		$vAddMail=$vAddMailTo.",".$vAddMailCC.",".$vAddMailBCC;
		$vArrTemp=explode(",",$vAddMail);
		if(count($vArrTemp)==1) return $vBody;
		for($i=0;$i<count($vArrTemp);$i++)
		{
			if($vArrTemp[$i]!="")
			{
				$this->lv003="admin";
				$this->lv007=$vArrTemp[$i];
				$this->lv017=$vArrTemp[$i];
				$this->LV_InsertAuto();
			}
		}
	}
	function SplitToEsc($vAddress,$vPara1,$vopt)
	{
		$strTemp=$vAddress;
		$vArrTemp=explode($vPara1,$strTemp);
		$strReturn="";
		if(count($vArrTemp)==0) return $vAddress;
		for($i=0;$i<count($vArrTemp);$i++)
		{
			if($vopt==1)
			{
				if (!(strpos($vArrTemp[$i],"@".$this->Domain)===false))
				{
					if($strReturn!="")
						$strReturn=$strReturn.$vPara1.trim($vArrTemp[$i]);
					else
						$strReturn=$strReturn.trim($vArrTemp[$i]);			
				}		
			}
			else
			{
				if ((strpos($vArrTemp[$i],"@".$this->Domain)===false))
				{
					if($strReturn!="")
						$strReturn=$strReturn.$vPara1.trim($vArrTemp[$i]);
					else
						$strReturn=$strReturn.trim($vArrTemp[$i]);			
				}		
			
			}
		}
		return $strReturn;
	}
	function AttachFile($vPath,$vFileName)
	{
		$vHref="<a target=_blank href=\"".$vPath."\">".$vFileName."</a>";
		if($this->lv010=="")
		{
			$this->lv013=$this->lv013.$vPath;
			$this->lv010=$this->lv010.$vHref;
		}
		else
		{
			$this->lv013=$this->lv013."<@>".$vPath;		
			$this->lv010=$this->lv010."|".$vHref;
		}
	}
	function SaveAndGetFile($vFileRead,$vFilePath,$vUserID,$vFileName)
	{	

			$vDate=GetServerDate();
			$vTime=GetServerTime();
			if(!is_dir($strPath.$vUserID))			create_folder($strPath, $vUserID);
			$strFolder=$vUserID."/".str_replace("-","",$vDate).str_replace(":","",$vTime);
			$strPath=$vFilePath;
			create_folder($strPath, $strFolder);
			$handle = fopen($vFileRead, "r" );
			$contents = fread($handle, filesize($vFileRead));
			fclose( $handle );
			$fp = fopen($strPath.$strFolder."/".$vFileName, "w" );
			fwrite( $fp,$contents );
			fclose( $fp);
			return "../SendFile/".$strFolder."/".$vFileName;			
	}
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
	
	function SumSQLRun($vSQL,$vColpan,$vLang,$plang)
	{
		$vtr="<tr onDblClick=\"this.innerHTML=''\" style=\"cursor:move;font-size:20px;font-weight:bold\"><td class=\"right_hr\" colspan=\"$vColpan\" valign=\"top\" >$vLang: @01</td></tr>";
		$bResultS = db_query($vSQL);
		$vValue="";
		while($arrS=db_fetch_array($bResultS)){		
			if($vValue=="") $vValue=Lcurrency($arrS['SumQty'],$plang).$arrS['Unitlv002'];
			else $vValue=$vValue." ; ".Lcurrency($arrS['SumQty'],$plang).$arrS['Unitlv002'];
		}
		if($vValue!="") return  str_replace("@01",$vValue,$vtr);
		return "";
	}
	public function GetBuilCheckList($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002')
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
	public function LV_LinkField($vFile,$vSelectlv001)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectlv001),2));
	}
	private function sqlcondition($vFile,$vSelectlv001)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv004':
				$vsql="select lv003 lv001,lv003 lv002,1 lv003 from  ml_lv0008 where lv002='$vSelectlv001'";
				break;
			case 'lv003':
				$vsql="select lv001,lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  ml_lv0013";
				break;
		}
		return $vsql;
	}
	public  function getvaluelink($vFile,$vSelectlv001)
	{
		switch($vFile)
		{
		
			case 'lv003':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  ml_lv0013 where lv001='$vSelectID'";
				break;
			default:
				$vsql ="";
				break;
		}
		if($vsql=="")
		{
			return $vSelectlv001;
		}
		else
		$lvResult = db_query($vsql);
		while($row= db_fetch_array($lvResult)){
		return ($lvopt==0)?$row['lv002']:(($lvopt==1)?$row['lv001']."(".$row['lv002'].")":(($lvopt==2)?$row['lv002']."(".$row['lv001'].")":$row['lv001']));
		}
		
	}
}
	?>