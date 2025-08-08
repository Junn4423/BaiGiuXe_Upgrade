<?php
/////////////coding ml_lv0001///////////////
class   ml_lv0001 extends lv_controler
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
	public $Inbox=null;
	public $Outbox=null;
	public $DeleteItem=null;
	public $SendItem=null;
	public $Domain="";
	public $DirLink="";
	public $ishtml=false;
///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014";	
////////////////////GetDate
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='ml_lv0001';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv020"=>"21");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"2","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"3","lv010"=>"0","lv011"=>"10","lv012"=>"10","lv013"=>"3","lv014"=>"0","lv020"=>"10");

	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;
		$this->isRpt=1;		
	 	$this->isFil=1;	
		$this->isAdd=0;
		$this->isEdit=0;
	
		$this->isUnApr=0;
		$this->isApr=0;
		$this->lang=$_GET['lang'];
		
		$this->Inbox="";
		$this->Outbox="";
		$this->DeleteItem="";
		$this->SendItem="";
		$this->lv002=1;
		$this->lv012="0";
		
	}
	function LoadBox($vlv003)
	{
		$vListUser=$this->GetBuilStringExc($vlv003,'lv003');
		$vsql="select (select count(*) from ml_lv0001 where lv002=1 and lv012=0 and lv011=1 and lv017 in (".$vListUser.")) Inbox,(select count(*) from ml_lv0001 where lv002=2 and lv012=0  and lv011=1 and lv003='$vlv003') Outbox,(select count(*) from ml_lv0001 where lv002=1 and lv012=1  and lv011=1 and lv017 in (".$vListUser.")) DeleteItem,(select count(*) from ml_lv0001 where lv002=2 and lv012=1 and lv011=1 and lv003='$vlv003') SendItem ";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->Inbox=($vrow['Inbox']>0)?"(".$vrow['Inbox'].")":"";
			$this->Outbox=($vrow['Outbox']>0)?"(".$vrow['Outbox'].")":"";			
			$this->DeleteItem=($vrow['DeleteItem']>0)?"(".$vrow['DeleteItem'].")":"";
			$this->SendItem=($vrow['SendItem']>0)?"(".$vrow['SendItem'].")":"";
		}
		else
		{
			$this->Inbox="";
			$this->Outbox="";
			$this->DeleteItem="";
			$this->SendItem="";
		}	
	}
	function LV_GetText($vcontent)
	{
		$varrhtml=get_tag_html();
		$vavt=array();
		$i=0;
		$vminpos=-1;
		$vminar = -1;
		foreach($varrhtml as $value )
		{		
			$vpos=strpos($vcontent,$value);
			if($vpos===false)
			{
				$vavt[$i]=-1;
			}
			else	
			{
				if($vminpos>$vpos || $vminpos==-1)
				{
					$vminpos=$vpos;
					$vminar=$i;
				}
				$vavt[$i]=$vpos;
			}
			$i++;
		}
		if($vminar==-1) 
		{	
			return $vcontent;
		}
		else
		{
			return $this->LV_ProcessHTML($vcontent,$varrhtml,$vavt,$vminar,false);
			
		}
	}
	function LV_ProcessHTML($vcontent,$varrhtml,$vavt,$vminar,$ishtml)
	{
		$vAcontent=explode($varrhtml[$vminar],$vcontent,2);
		$vstate=$this->LV_CheckTab($vAcontent[1],$varrhtml[$vminar]);
		if($ishtml)
		{			
			if($vstate==2)
			{
				$this->ishtml=true;
				return $varrhtml[$vminar].$vAcontent[1];
			}
			else
			{
				return $vcontent;
				$this->ishtml=false;
			}
		}
		else
		{
			if($vstate==2)
			{
				$strEmpty = $vAcontent[0];
				$vstate=$this->LV_CheckNotData($strEmpty);
				if($vstate)
				{
					$this->ishtml=true;
					return $vcontent;
				}
				else
				{
					return $vAcontent[0];
				}
			}
			else
				return $vcontent;
		}
	}
	function LV_CheckNotData($vdata)
	{
		$vdata=str_replace("\r\n","",$vdata);
		$vdata=str_replace("\r","",$vdata);
		$vdata=str_replace("\n","",$vdata);
		$vdata=str_replace("=","",$vdata);
		$vdata=str_replace("-","",$vdata);
		$vdata=str_replace(".","",$vdata);
		$vdata=str_replace("_","",$vdata);
		$vdata=str_replace(":","",$vdata);
		$vdata=str_replace(" ","",$vdata);
		if($vdata=="") return true;
		return false;
	}
	function LV_CheckTab($vContent,$tabhtml)
	{
		$vstate=0;
		if(eregi(">",$vContent)) $vstate=1;
		if(eregi(str_replace("<","</",$tabhtml).'>',$vContent)) $vstate=2;
		return $vstate;
	}
	function LV_ReplyTab($vContent,$vMailID)
	{
		$strTitle=$strTitle."&nbsp;\r\n----------------------------------------------\r\n>From:".$this->lv007."\r\n";
		$strTitle=$strTitle.">To:".$this->lv006."\r\n";
		$strTitle=$strTitle.">Send:".$this->lv004." ".$this->lv014."\r\n";
		$strTitle=$strTitle.">Subject:".$this->lv005."\r\n";
		$vContent=$strTitle.">".str_replace("\r\n","\r\n>",$vContent);
		return $vContent;
	}
	function LV_ReplyTabHTML($vContent,$vMailID)
	{
		$strTitle=$strTitle."&nbsp;<br/>----------------------------------------------<br/>From:".$this->lv007."<br/>";
		$strTitle=$strTitle."To:".$this->lv006."<br/>";
		$strTitle=$strTitle."Send:".$this->lv004." ".$this->lv014."<br/>";
		$strTitle=$strTitle."Subject:".$this->lv005."<br/>";
		$vContent=$strTitle.$vContent;
		return $vContent;
	}
	function LV_ForwardTab($vContent,$vMailID)
	{
		$strTitle=$strTitle."&nbsp;\r\n---------------------Forward Message-------------------------\r\n>From:".$this->lv007."\r\n";
		$strTitle=$strTitle.">To:".$this->lv006."\r\n";
		$strTitle=$strTitle.">Send:".$this->lv004." ".$this->lv014."\r\n";
		$strTitle=$strTitle.">Subject:".$this->lv005."\r\n";
		$vContent=$strTitle.">".str_replace("\r\n","\r\n>",$vContent);
		return $vContent;
	}
	function LV_ForwardTabHTML($vContent,$vMailID)
	{
		$strTitle=$strTitle."&nbsp;<br/>--------------------Forward Message--------------------------<br/>From:".$this->lv007."<br/>";
		$strTitle=$strTitle."To:".$this->lv006."<br/>";
		$strTitle=$strTitle."Send:".$this->lv004." ".$this->lv014."<br/>";
		$strTitle=$strTitle."Subject:".$this->lv005."<br/>";
		$vContent=$strTitle.$vContent;
		return $vContent;
	}
	function LV_Load()
	{
		$vsql="select * from  ml_lv0001";
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
			$this->lv016=$vrow['lv016'];
			$this->lv017=$vrow['lv017'];
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
			$this->lv023=$vrow['lv023'];
		}
	}
	function get_subject($lvsubject)
	{
			$vsub=$lvsubject;
			if(!strpos($lvsubject,"?B?")===false)
			{
				$varrsub=explode("?B?",$lvsubject,2);
				$varrsub[1] = str_replace("==?=","?=",$varrsub[1]);
				$varrsub[1] = str_replace("=?=","?=",$varrsub[1]);
				$vstrPlit="?=";
				if(strpos($varrsub[1],$vstrPlit)===false)
				{
					$vstrPlit="=?";
					if(strpos($varrsub[1],$vstrPlit)===false)	$vstrPlit="=";
				}
				$varrsub1=explode($vstrPlit,$varrsub[1],2);
				$vsub=$varrsub1[0];
				if(count($varrsub1)>1)
				{
					if($varrsub1[1]!="=")
						$vsub=base64_decode($vsub).$this->get_subject($varrsub1[1]);
					else 
						$vsub=base64_decode($vsub);
				}	
				else
					$vsub=base64_decode($vsub);
			}
			elseif(!strpos($lvsubject,"?Q?")===false)
			{
				$varrsub=explode("?Q?",$lvsubject,2);
				$vstrPlit="=?=";
				if(strpos($varrsub[1],$vstrPlit)===false)
				{
					$vstrPlit="?=";
					if(strpos($varrsub[1],$vstrPlit)===false)	$vstrPlit="=?";
				}
				$varrsub1=explode($vstrPlit,$varrsub[1],2);
				$vsub=$varrsub1[0];
				if(count($varrsub1)>1)
				{
					if($varrsub1[1]!="=")
						$vsub=quoted_printable_decode($vsub).$this->get_subject($varrsub1[1]);
					else
						$vsub=quoted_printable_decode($vsub);
				}
				else
					$vsub=quoted_printable_decode($vsub);

			}
			return $vsub;
			
	}
	function SaveFile($vPtich,$vFileName,$vTime,$NumTimes)
	{
		if($vFileName=="") return;
		if(eregi(";",$vFileName)) 
		{
			$vArrFileName=explode(";",$vFileName,2);
			if(trim($vArrFileName[0])!="" || $vArrFileName[0]!=NULL) $vFileName=$vArrFileName[0];
		}
		if(eregi(",",$vFileName)) 
		{
			$vArrFileName=explode(",",$vFileName,2);
			if(trim($vArrFileName[0])!="" || $vArrFileName[0]!=NULL) $vFileName=$vArrFileName[0];
		}
		
		$vFileName=$this->get_subject($vFileName);
		$vFileName=trim($vFileName);
		$vFileName=str_replace("\n\r","",$vFileName);
		$vFileName=str_replace("\n","",$vFileName);
		$vFileName=str_replace("\r","",$vFileName);
		$vFileName=str_replace("\t","",$vFileName);
		$vFileName=str_replace("'","",$vFileName);
		$vFileName=str_replace("\"","",$vFileName);
		$j=$NumTimes;
		$strFileName=str_replace(" ","_",trim($vFileName));
		//$strFileNameHref="File_".$this->UserID."_".$vTime.$j.strrchr($vFileName,".");
		$strFolder="";
		$strPath="../AttachFile/";
		$strFileNameHref=$this->LV_Get_isFile($strPath,$vFileName);
		$this->AttachFile($strPath.$strFileNameHref,$strFileName);	
		$fp = fopen($this->Dir.$strPath.$strFileNameHref, "w" );
		fwrite( $fp,$vPtich );
		fclose( $fp );		
		return $strPath.$strFileNameHref;		
	}
	function checkFileName($vFileName)
	{
		$vNewName="";
		$vlen=strlen($vFileName);
		for($i=0;$i<$vlen;$i++)
		{
			$vasci=ord(substr($vFileName,$i,1));
			if ( $vasci>=40 && $vasci<=122) $vNewName=$vNewName.substr($vFileName,$i,1);
		}
		return $vNewName;
	}
	function LV_Get_isFile($strPath,$vFileName)
	{
		$vFileNametmp=$vFileName;
		$vduoifile=strrchr($vFileNametmp,".");
		$vtenfile=str_replace($vduoifile,'',$vFileNametmp);
		$vtenfile_none=str_replace(" ","_",unicode_to_none($vtenfile));
		$vtenfile_none = $this->checkFileName($vtenfile_none);
		$vduoifile = $this->checkFileName($vduoifile);
		$i=0;
		while(true)
		{
			$strFileNameHref=$this->UserID."_".$vtenfile_none.(($i==0)?'':$i).$vduoifile;
			if(file_exists($this->Dir.$strPath.$strFileNameHref))			$i++;
			else
				return $strFileNameHref;				
		}
		return ;
	}
	function LV_GET_CONTENT_FILEATTACH($contents)
	{
		$vContent;
		$vArrContent=explode("<MESSAGE>",$contents,2);
		$vmessage=$vArrContent[1];
		$vboundary=$this->LV_GET_Boundary($vArrContent[0]);
		if($vboundary!="")
		{
			$vlistmessage=explode($vboundary,$vmessage);
			/*----------------------Get content mail--------------------------*/
			$vstrheader=$vlistmessage[1];
			if($vstrheader=="" || $vstrheader==NULL)  
			{
				$this->LV_GET_CONTENT_FILEATTACH("<MESSAGE>".$vlistmessage[0]);
				return;
			}
			$vContent=$this->LV_CHECK_BOUNDARY($vstrheader);
			$this->LV_Insert_Child($vContent)	;	
			/*----------------------End Get content mail--------------------------*/
			$this->LV_GET_FILE($vlistmessage);
		}
		else 
		{
			if(strpos($vmessage,"begin 666")===false)
			{
				$vArrContent1=Array();
				$vArrContent1[0]='';
				$vArrContent1[1]='';
				$vArrContent1[2]=$vmessage;
				$vContent=$this->LV_GET_FILE($vArrContent1);
			}
			else
				{
					$vContent='';
					$vmessage=str_replace("</MESSAGE>",'',$vmessage);
					$vArMessage=explode("begin 666",$vmessage);
							$jt=0;
							foreach($vArMessage as $tmessage)
							{
								if($jt==0)	
									$vContent=$this->LV_GET_HEADER_NOBOUNDARY($tmessage);
								else
								{
									$vArrNameFile=explode("\n\r",$tmessage,2);
									$vArrNameFiles=explode("\n",$vArrNameFile[0],2);
									$vArrNameFiless=explode("\r",$vArrNameFiles[0],2);
									$tmessage="begin 666".$tmessage;
									$this->SaveFile($tmessage,trim($vArrNameFiless[0]).'_.uue','',$jt);
								}
								$jt++;
							}
					$this->LV_UpdateAttachFile();						
				}
			$this->LV_Insert_Child($vContent)	;	
			
		}
		
	}
	function LV_Insert_Child($vContent)
	{
		if($this->lv001==0 || $this->lv001==NULL) return;
		$this->lv009=$this->LV_Escape_String(quoted_printable_encode($vContent));
		$this->lv015='';
		$lvsql="insert into ml_lv0001_ (lv001,lv009,lv015) values('$this->lv001','$this->lv009','$this->lv015')";
		$vReturn= db_query($lvsql);
		$this->InsertLogOperation($this->DateCurrent,'ml_lv0001_.insert',sof_escape_string($lvsql));
	}
	function LV_Update_Child($vContent)
	{
		if($this->lv001==0 || $this->lv001==NULL) return;
		$this->lv009=$this->LV_Escape_String(quoted_printable_encode($vContent));
		$lvsql1="update ml_lv0001_ set lv009=concat(lv009,'$this->lv009')  where lv001='$this->lv001'";
		$vReturn1= db_query($lvsql1);
		if($vReturn1)
		{
			$this->InsertLogOperation($this->DateCurrent,'ml_lv0001_.insert',sof_escape_string($lvsql1));
		}
		return $vReturn;
	}
	function LV_Update_Child_Inline($vCode,$vStrInline,$vstrLinkImg)
	{
		if($this->lv001==0 || $this->lv001==NULL) return;
		$vStrInline=$this->LV_Escape_String($vStrInline);
		$vCode=$this->LV_Escape_String($vCode);
		$lvsql1="update ml_lv0001_ set lv009=REPLACE(REPLACE(REPLACE(REPLACE(lv009,concat('src=\"cid:','$vCode'),concat('src=\"','$vCode')),concat('src=\"','$vCode'),concat('src=\"','$vstrLinkImg')),concat('cid:','$vCode'),'$vCode'),'$vCode','$vStrInline')  where lv001='$this->lv001'";
		$vReturn1= db_query($lvsql1);
		if($vReturn1)
		{
			$this->InsertLogOperation($this->DateCurrent,'ml_lv0001_.update',sof_escape_string($lvsql1));
		}		
		return $vReturn;
	}
function LV_GET_FILE($vlistmessage)
	{
		$vTime=str_replace("/","-",str_replace(":","",date("Y-m-d").time()));
		$vArrFile=array();
		$vContent="";
		for($i=2;$i<count($vlistmessage);$i++)
		{
			$vboundary=$this->LV_GET_Boundary($vlistmessage[$i]);
			if($vboundary!="")
			{
				$vlistmessage1=explode($vboundary,$vlistmessage[$i]);
				foreach($vlistmessage1 as $value1)
				{
					$vArrFile=$this->LV_GET_FILE_NOBOUNDARY($value1);
					if($vArrFile["Attach"]==true)
					{
						if($vArrFile["Name"]!="" && $vArrFile["Name"]!=NULL)
							$this->SaveFile($vArrFile["Content"],$vArrFile["Name"],$vTime,$i);
						else 
							$vContent=$vContent.$vArrFile["Content"];
					}
					else
					$vContent=$vContent.$vArrFile["Content"];
				}
			}
			else
			{
				$vArrFile=$this->LV_GET_FILE_NOBOUNDARY($vlistmessage[$i]);
				if($vArrFile["Attach"]==true)
				{
					if($vArrFile["Inline"]==true)
					{
						if($vArrFile["Name"]!="" && $vArrFile["Name"]!=NULL)
						{
							$vInlineName=$this->SaveFile($vArrFile["Content"],$vArrFile["Name"],$vTime,$i);
							$vFileName=$vArrFile["Name"];
							if(eregi(";",$vFileName)) 
							{
								$vArrFileName=explode(";",$vFileName,2);
								if(trim($vArrFileName[0])!="" || $vArrFileName[0]!=NULL) $vFileName=$vArrFileName[0];
							}
							if(eregi(",",$vFileName)) 
							{
								$vArrFileName=explode(",",$vFileName,2);
								if(trim($vArrFileName[0])!="" || $vArrFileName[0]!=NULL) $vFileName=$vArrFileName[0];
							}
							$ContentId=trim($vArrFile["ContentId"]);
							$ContentId=str_replace("<","",$ContentId);
							$ContentId=str_replace(">","",$ContentId);
							$ContentId=str_replace("[","",$ContentId);
							$ContentId=str_replace("]","",$ContentId);
							if(LV_Check_Image($vInlineName))
							{
								$vContentLine="<img src='../".$vInlineName."' border='0'/>";
							}
							else
							{
								$vContentLine="<a href='../".$vInlineName."' target='blank'>".$this->get_subject($vFileName)."</a>";
							}
							$this->LV_Update_Child_Inline($ContentId,$vContentLine,'../'.$vInlineName);
						}
						else 
							$vContent=$vContent.$vArrFile["Content"];
					}
					else
					{
						if($vArrFile["Name"]!="" && $vArrFile["Name"]!=NULL)
							$this->SaveFile($vArrFile["Content"],$vArrFile["Name"],$vTime,$i);
						else 
							$vContent=$vContent.$vArrFile["Content"];
					}
				}
				else
				$vContent=$vContent.$vArrFile["Content"];
			}
			
		}
		$this->LV_UpdateAttachFile();
		if($vContent!="") $this->LV_Update_Child($vContent)	;
	}
	function LV_CHECK_BOUNDARY($vmessage)
	{
		$vboundary=$this->LV_GET_Boundary($vmessage);
		if($vboundary!="")
		{
			$vlistmessage1=explode($vboundary,$vmessage);
			$i=0;
			foreach($vlistmessage1 as $value1)
			{
				if($i>0) $vContent=$vContent.$this->LV_CHECK_BOUNDARY($value1);
				$i++;
			}
			
		}
		else
		{
			if(strpos($vmessage,"begin 666")===false)
			{
				$vArrContent1=Array();
				$vArrContent1[0]='';
				$vArrContent1[1]='';
				$vArrContent1[2]=$vmessage;
				$vContent=$this->LV_GET_FILE($vArrContent1);
			}
			else
				{
					$vContent='';
					$vmessage=str_replace("</MESSAGE>",'',$vmessage);
					$vArMessage=explode("begin 666",$vmessage);
					$jt=0;
					foreach($vArMessage as $tmessage)
					{
						if($jt==0)	
							$vContent=$this->LV_GET_HEADER_NOBOUNDARY($tmessage);
						else
						{
							$vArrNameFile=explode("\n\r",$tmessage,2);
							$vArrNameFiles=explode("\n",$vArrNameFile[0],2);
							$vArrNameFiless=explode("\r",$vArrNameFiles[0],2);
							$tmessage="begin 666".$tmessage;
							$this->SaveFile($tmessage,$vArrNameFiless[0]."_.uue",'',$jt);
						}
						$jt++;
					}
					$this->LV_UpdateAttachFile();
				}
		}
		return $vContent;
	}
	function LV_GET_FILE_NOBOUNDARY($vmessage)
	{
		$vAttachReturn=array();
		$vContent="";
		$endline="\n";
		$InCr=0;
			if(strpos($vmessage,$endline)===false)
			{
				$endline="\n\r";
				$vArMessage=explode($endline,$vmessage);
			}
			else
				$vArMessage=explode($endline,$vmessage);
			$vcodeconvert="";
			$vContent="";
			$vFirt="";
			$vnumbase64=0;
			$vIsFile=false;
			$vFileName="";
			$vStrFirstLine="";
			$vProcessStr=false;
			$vAutoLenght=0;
			$isImg=false;
			$vflag=0;
			foreach($vArMessage as $value)
			{
				$value=str_replace("\r","",$value);
				if(eregi("</MESSAGE>",$value)) break;
				if(eregi("Content-Type:",$value))
				{
					if(eregi("image",$value)) $isImg=true;
					if(eregi("quoted-printable",$value))  $vcodeconvert="quoted-printable";
					if(eregi("base64",$value))  $vcodeconvert="base64";
					if(eregi("filename=",$value))
						{
							$vArrFile=explode("filename=",$value);
							$vFileName=str_replace("\"","",$vArrFile[1]);
						}
					if(eregi("filename\*=",$value))
						{
							$vArrFile=explode("filename*=",$value);
							$vFileName=str_replace("\"","",$vArrFile[1]);
						}
					if(eregi("name=",$value))
						{
							$vArrFile=explode("name=",$value);
							$vFileName=str_replace("\"","",$vArrFile[1]);
						}
					//quoted-printable or base64
				}
				else if(eregi("	charset=",$value))
				{
					$vflag=0;
				}
				else if(eregi("Content-Transfer-Encoding:",$value))
				{
					$vflag=2;
					if(eregi("quoted-printable",$value))  $vcodeconvert="quoted-printable";
					if(eregi("base64",$value))  $vcodeconvert="base64";
				}
				else if(eregi("Content-Disposition:",$value))
				{
					$vflag=3;
					if(eregi("attachment",$value) || eregi("inline",$value))
					{
						if(eregi("inline",$value))
						{
							$InCr++;
						}
						$vIsFile=true;
						if(eregi("filename=",$value))
						{
							$vflag=4;
							$vArrFile=explode("filename=",$value);
							$vFileName=str_replace("\"","",$vArrFile[1]);
						}
						if(eregi("filename\*=",$value))
						{
							$vflag=4;
							$vArrFile=explode("filename*=",$value);
							$vFileName=str_replace("\"","",$vArrFile[1]);
						}
					}
				}
				else if(eregi("filename=",$value))
						{
							$vflag=4;
							$vArrFile=explode("filename=",$value);
							$vFileName=str_replace("\"","",$vArrFile[1]);
						}
				else if(eregi("filename\*=",$value))
						{
							$vflag=4;
							$vArrFile=explode("filename*=",$value);
							$vFileName=str_replace("\"","",$vArrFile[1]);
						}
				else if(eregi("name=",$value))
						{
							$vflag=5;
							$vArrFile=explode("name=",$value);
							$vFileName1=str_replace("\"","",$vArrFile[1]);
						}	
				else if(eregi("X-Attachment-Id:",$value))
						{
							$vflag=6;
							$vArrFile=explode("X-Attachment-Id:",$value);
							$vAttachmentId=str_replace("\"","",$vArrFile[1]);
						}	
				else if(eregi("Content-Id:",$value))
						{
							$vflag=7;
							$vArrFile=explode("Content-Id:",$value);
							if(count($vArrFile)==1)
							{
								$vArrFile=explode("Content-ID:",$value);
								if(count($vArrFile)==1)
								{
									$vArrFile=explode("Content-id:",$value);
									if(count($vArrFile)==1)
									{
										$vArrFile=explode("content-id:",$value);
									}
								}
							}
							$vContentId=str_replace("\"","",$vArrFile[1]);
						}
				else if(eregi("Content-Description:",$value))
				{
					$vflag=8;
				}
				else 
				{
					if($vIsFile==true && (substr($value,0,1)=="\t" || substr($value,0,1)==" "))
					{
						switch($vflag)
						{
							case 4:
								$vFileName=$vFileName.str_replace("\t","",$value);
								break;
							case 5:
								$vFileName1=$vFileName1.str_replace("\t","",$value);
								break;
							case 7:
								$vFileName1=$vFileName1.str_replace("\t","",$value);
								break;
						}
						$vflag=0;
					}
					else
					{
						$vflag=0;
						if($value=="" || $value==NULL)
							$vContent=$vContent.$endline;
						else
							if($value=="\n--" || $value=="--" || $value=="--\r" || $value=="\"\r" || $value=="\"" || $value=="\r")	
							{
		
							}
							else 
							{
								$vsplit=explode("\n--",$value);
								$vContent=$vContent.$vsplit[0].$endline;
							}
					}
				}
				//Nhan dien Content-Type: va Content-Transfer-Encoding:
			}
			if($vProcessStr==true)
			{
				$vpos=strpos($vmessage, $vStrFirstLine);
				$vContent=substr($vmessage,$vpos-1,strlen($vmessage)-$vpos);
			}
			if($vnumbase64==2 & $vcodeconvert=="") $vcodeconvert="base64";
			switch($vcodeconvert)
			{
				case 'quoted-printable':
						$vContent1=quoted_printable_decode($vContent);
					break;
				case 'base64':
						$vContent1=base64_decode($vContent);
						if($vContent1=="" || $vContent1==NULL) $vContent1=quoted_printable_decode($vContent);
					break;
				default:
					if($this->LV_Check_Base64($vContent))
					{
						$vContent1=base64_decode($vContent);
						$vContent=$vContent1;
					}
					$vContent=quoted_printable_decode($vContent);		
					$vContent1=$vContent;
					break;
			}
			if($vFileName=="") $vFileName=$vFileName1;
			if($vIsFile==false) 
			{
				$vIsFile=$isImg;
				$InCr=1;
			}
			$vAttachReturn["Content"]=$vContent1;
			$vAttachReturn["Name"]=$vFileName;
			$vAttachReturn["Attach"]=$vIsFile;
			$vAttachReturn["ContentId"]=$vContentId;
			$vAttachReturn["Inline"]=(($InCr>0)?true:false);
			return $vAttachReturn;
	}
	function LV_GET_HEADER_NOBOUNDARY($vmessage)
	{
		$vContent="";
		$endline="\n\r";
			if(strpos($vmessage,$endline)===false)
			{
				$endline="\n";
				$vArMessage=explode($endline,$vmessage);
			}
			else
				$vArMessage=explode($endline,$vmessage);
			$vcodeconvert="";
			$vContent="";
			$vFirt="";
			$vnumbase64=0;
			foreach($vArMessage as $value)
			{
				if(eregi("</MESSAGE>",$value)) break;
				if(eregi("Content-Type:",$value))
				{
					if(eregi("quoted-printable",$value))  $vcodeconvert="quoted-printable";
					if(eregi("base64",$value))  $vcodeconvert="base64";
					//quoted-printable or base64
				}
				else if(eregi("Content-Transfer-Encoding:",$value))
				{
					if(eregi("quoted-printable",$value))  $vcodeconvert="quoted-printable";
					if(eregi("base64",$value))  $vcodeconvert="base64";
				}
				else 
				{
					if($value=="" || $value==NULL)
						$vContent=$vContent.$endline;
					else
						if($value=="\n--" || $value=="--" || $value=="--\r" || $value=="\"\r" || $value=="\"" )	
						{
							$vsplit=explode("\n--",$value);
							$vContent=$vContent.$vsplit[0].$endline;
						}
						else 
						{
							$vContent=$vContent.$value.$endline;
						}
						
						
					if($vnumbase64<2)
					{
						$value=trim($value);
						if(strpos($value," ")===FALSE )
						{
							if( strlen($value)>300)
								$vnumbase64=2;
							elseif( strlen($value)>30)
								$vnumbase64++;
							else
								$vnumbase64=0;
						}
						else
						{
								$vnumbase64=0;
						}
					}
					
				}
				//Nhan dien Content-Type: va Content-Transfer-Encoding:
			}
			if($vnumbase64==2 & $vcodeconvert=="") $vcodeconvert="base64";
			switch($vcodeconvert)
			{
				
				case 'base64':
						$vContent1=base64_decode($vContent);
						if($vContent1=="" || $vContent1==NULL) $vContent1=quoted_printable_decode($vContent);
					break;
				case 'quoted-printable':
						$vContent1=quoted_printable_decode($vContent);
					break;
				default:
					if($this->LV_Check_Base64($vContent))
					{
						$vContent1=base64_decode($vContent);
					}
					//if ($vContent1=="")	
					$vContent1=quoted_printable_decode($vContent);
					break;
			}
			return $vContent1;
	}
	function LV_Check_Base64($vcontent)
	{
		$vlen=strlen($vcontent);
		$vcount=0;
		if ($vlen>50)
		{
			$vArrContent=explode(" ",$vcontent);
			$vContent1=base64_decode($vcontent);
			if(trim($vContent1)!="" && $vContent1!=NULL)
			{
				for($i=0;$i<count($vArrContent);$i++)
				{
					if(strlen($vArrContent[$i])>50)
						{
							$vcount++;
							if(count($vArrContent)==1 )
							{
									
										return true;
							
							}
							else
							{
								if(count($vArrContent)>5)
								{
									if($vcount>=2) return true;
								}
								else
									return true;			
							}
						}
					if($i>10) return false;
				}
			}
		}
		return false;
	}
	function LV_CHECK_TYPECONVERT($vContent,$vcodeconvert)
	{
		if($vcodeconvert=="" || $vcodeconvert==NULL)
		{
			return $vcodeconvert;
		}
		return $vcodeconvert;
	}
	function LV_GET_Boundary($headers)
	{
		$strsplit='boundary="';
		if(!eregi($strsplit,$headers))
		{
			$strsplit='boundary=';
			if(!eregi($strsplit,$headers))
			{
				$strsplit='boundary';
				if(!eregi($strsplit,$headers))
				$strsplit='';
			}
			
		}
		if($strsplit=='') return '';
		$vArrHeader=explode($strsplit,$headers,2);
		if(count($vArrHeader)==1)
		{
			$strsplit=str_replace("boundary","Boundary",$strsplit);
			$vArrHeader=explode($strsplit,$headers,2);
			if(count($vArrHeader)==1)
			{
				$strsplit=str_replace("Boundary","BOUNDARY",$strsplit);
				$vArrHeader=explode($strsplit,$headers,2);
			}
		}
		if(count($vArrHeader)>=2)
		{
			if($strsplit=='boundary="' || $strsplit=='Boundary="' || $strsplit=='BOUNDARY="')
				$vArr1Header=explode('"',$vArrHeader[1],2);
			else
				$vArr1Header=explode("\n",$vArrHeader[1],2);
			return $vArr1Header[0];
		}
		return '';
	}
	private function LV_BuilContent($vlv001)
	{
		$vsql="select lv001 from  ml_lv0001_ where lv001='$vlv001'";
		$vresult=db_query($vsql);
		$count=db_num_rows($vresult);
		if($count==0)
		{
			$vsql="select lv001,lv009 from  ml_lv0001 where lv001='$vlv001'";
			$vresult=db_query($vsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				$this->lv001=$vrow['lv001'];
				$filename =$this->Dir.$vrow['lv009'];
				$handle = fopen($filename, "r");
				$contents = fread($handle, filesize($filename));
				fclose($handle);
				$this->LV_Insert_Child('');
				$this->LV_GET_CONTENT_FILEATTACH($contents);
				
			}	
		}
		
	}
	function LV_LoadID($vlv001)
	{
		$this->LV_BuilContent($vlv001);
		$lvsql="select A.lv001,A.lv002,A.lv003,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,B.lv009 lv009,A.lv010,A.lv011,A.lv012,A.lv013,A.lv014,B.lv015 lv015,A.lv016,A.lv017,A.lv018,A.lv019 from  ml_lv0001 A inner join ml_lv0001_ B on A.lv001=B.lv001 Where A.lv001='$vlv001'";
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
			$this->lv009=quoted_printable_decode($vrow['lv009']);
			$this->lv010=str_replace('href="../','href="../'.$this->DirLink,$vrow['lv010']);
			$this->lv011=$vrow['lv011'];	
			$this->lv012=$vrow['lv012'];
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
			$this->lv016=$vrow['lv016'];
			$this->lv017=$vrow['lv017'];	
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];	
			$this->lv020=$vrow['lv020'];
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
			$this->lv023=$vrow['lv023'];
		}
	}
	function LV_Insert()
	{
		$lvsql="insert into ml_lv0001 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv001','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv001','$this->lv016','$this->lv017','$this->lv018','$this->lv019','$this->lv020','$this->lv021','$this->lv022','$this->lv023')";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{ 
			$lvsql="insert into ml_lv0001_ (lv001,lv009,lv015) values('$this->lv001','$this->lv009','$this->lv015')";
			$vReturn= db_query($lvsql);
			$this->InsertLogOperation($this->DateCurrent,'ml_lv0001.insert',sof_escape_string($lvsql));
		}
		return $vReturn;
	}	
	function LV_InsertAutoID()
	{
		$lvsql="insert into ml_lv0001 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv001','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv001','$this->lv016','$this->lv017','$this->lv018','$this->lv019','$this->lv020','$this->lv021','$this->lv022','$this->lv023')";
		$vReturn= db_query($lvsql);
		if($vReturn){
			$lvsql="insert into ml_lv0001_ (lv001,lv009,lv015) values('$this->lv001','$this->lv009','$this->lv015')";
			$vReturn= db_query($lvsql);
			$this->InsertLogOperation($this->DateCurrent,'ml_lv0001.insert',sof_escape_string($lvsql));
		}
		return $vReturn;
	}	
	function LV_InsertAuto()
	{
		//$vlv001=InsertWithCheck('ml_lv0001', 'lv001', '',0);
		$lvsql="insert into ml_lv0001 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv001','$this->lv016','$this->lv017','$this->lv018','$this->lv019','$this->lv020','$this->lv021','$this->lv022','$this->lv023')";
		$vReturn= db_query($lvsql);
		if($vReturn){
		//	$this->lv009=$this->LV_Escape_String($this->lv009);
		//	$this->lv015=$this->LV_Escape_String($this->lv015);
		//echo	$lvsql="insert into ml_lv0001_ (lv001,lv009,lv015) values('$vlv001','$this->lv009','$this->lv015')";
			//$vReturn= db_query($lvsql);
			$this->InsertLogOperation($this->DateCurrent,'ml_lv0001.insert',sof_escape_string($lvsql));
		}
		return $vReturn;
	}	
	function LV_UpdateAttachFile()
	{
		$lvsql="Update ml_lv0001 set lv010='$this->lv010',lv013='$this->lv013' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn){
			$vReturn= db_query($lvsql);
			$this->InsertLogOperation($this->DateCurrent,'ml_lv0001.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_UpdateReply($vlv001)
	{
		$lvsql="Update ml_lv0001 set lv023='1' where  lv001='$vlv001';";
		$vReturn= db_query($lvsql);
		if($vReturn){
			$vReturn= db_query($lvsql);
			$this->InsertLogOperation($this->DateCurrent,'ml_lv0001.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_UpdateForward($vlv001)
	{
		$lvsql="Update ml_lv0001 set lv024='1' where  lv001='$vlv001';";
		$vReturn= db_query($lvsql);
		if($vReturn){
			$vReturn= db_query($lvsql);
			$this->InsertLogOperation($this->DateCurrent,'ml_lv0001.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_Update()
	{
		$lvsql="Update ml_lv0001 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn){
			$lvsql="Update ml_lv0001 set lv009='$this->lv009' where  lv001='$this->lv001';";
			$vReturn= db_query($lvsql);
			$this->InsertLogOperation($this->DateCurrent,'ml_lv0001.update',sof_escape_string($lvsql));
		}
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
		$lvsql = "DELETE FROM ml_lv0001  WHERE ml_lv0001.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn){
			$this->InsertLogOperation($this->DateCurrent,'ml_lv0001.delete',sof_escape_string($lvsql));
			$lvsql = "DELETE FROM ml_lv0001_  WHERE ml_lv0001_.lv001 IN ($lvarr)  ";
			$vReturn= db_query($lvsql);
		}
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
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvList="";
	 	$lvsql = "select B.lv015 lv015  from ml_lv0001 A inner join ml_lv0001_ B on A.lv001=B.lv001 WHERE A.lv001 IN ($lvarr)";
		$vReturn= db_query($lvsql);
		if(!$vReturn) return;
		while ($vrow = db_fetch_array ($vReturn)){
			$lvArrayMail=null;
			$lvArrayMail=explode("<MESSAGE>",$vrow['lv015'],2);
			if(count($lvArrayMail)==2)
			{
				$lvArrTo=null;
				$lvArrTo=explode("To:",$lvArrayMail[1]);
				$lvEmail=null;
				$lvEmail=explode("\n",$lvArrTo[1],2);
				if($lvList=="")
					$lvList="'".trim($lvEmail[0])."'";
				else
					$lvList=$lvList.",'".trim($lvEmail[0])."'";
			}
		
		}
		$vsql="delete from ml_lv0012_pro  WHERE lv003 in ($lvList)";
		$vReturn1= db_query($vsql);
		//if($vReturn1) $this->InsertLogOperation($this->DateCurrent,'ml_lv0012.delete',sof_escape_string($vsql));
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
	/*function SplitToEsc($vAddress,$vPara1,$vopt)
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
	}*/
	function SplitToEsc($vAddress,$vPara1,$vopt)
	{
		if($vopt==1) return "";
		$strTemp=$vAddress;
		$vArrTemp=explode($vPara1,$strTemp);
		$strReturn="";
		if(count($vArrTemp)==0) return $vAddress;
		for($i=0;$i<count($vArrTemp);$i++)
		{
			
					if($strReturn!="")
						$strReturn=$strReturn.$vPara1.trim($vArrTemp[$i]);
					else
						$strReturn=$strReturn.trim($vArrTemp[$i]);			
			
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
		$strCondi="and lv017 in (".$this->GetBuilStringExc($_SESSION['ERPSOFV2RUserID'],'lv003').")";
		if($this->lv001!="") $strCondi=$strCondi." and lv001 like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and lv002 = '$this->lv002'";
		if($this->lv003!="") $strCondi=$strCondi." and lv003 like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and lv004 like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and lv005 like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and lv006 like '%$this->lv006%'";
		if($this->lv007!="") $strCondi=$strCondi." and lv007 like '%$this->lv007%'";
		if($this->lv008!="") $strCondi=$strCondi." and lv008 like '%$this->lv008%'";
		if($this->lv009!="") $strCondi=$strCondi." and lv009 like '%$this->lv009%'";
		if($this->lv010!="") $strCondi=$strCondi." and lv010 like '%$this->lv010%'";
		if($this->lv011!="") $strCondi=$strCondi." and lv011 = '$this->lv011'";
		if($this->lv012!="") $strCondi=$strCondi." and lv012 = '$this->lv012'";
		if($this->lv013!="") $strCondi=$strCondi." and lv013 like '%$this->lv013%'";
		if($this->lv014!="") $strCondi=$strCondi." and lv014 like '%$this->lv014%'";
		if($this->lv016!="") $strCondi=$strCondi." and lv016 like '%$this->lv016%'";
		return $strCondi;
	}
	function GetBuilStringExc($vUserID,$vField)
	{
		$vsql="select $vField from ml_lv0008 where lv002='$vUserID'";
		$vresult=db_query($vsql);
		$strReturn="";
		if($vresult)
		{
			while($vrow=db_fetch_array($vresult))
			{
		   		if($strReturn=="") $strReturn="'".$vrow["$vField"]."'";
				else $strReturn=$strReturn.",'".$vrow["$vField"]."'";
			}
			if($strReturn=='') return "''";
			return $strReturn;
		}
		if($strReturn=='') return "''";
	}
		////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM ml_lv0001 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
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
		<tr ><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>".$this->ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrderList,$lvSortNum)."</td></tr>
		@#01
		<tr ><td colspan=\"".(count($lstArr)+2)."\">$paging</td></tr>
		<tr ><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</td></tr>
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
			<td width=1%><input name=\"$lvChkAll\" type=\"checkbox\" id=\"$lvChkAll\" onclick=\"DoChkAll($lvFrom, '$lvChk', this)\" value=\"$curRow\" tabindex=\"2\"/></td>
			<td><center><strong>*</strong></center></td>
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			<td width=1%><input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckOne($lvFrom, '$lvChk', '$lvChkAll', this)\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"/></td>
			<td><center>@98</center></td>
			@#01
		</tr>
		";
		$lvHref="<a href=\"javascript:FunctRunning1('@01',@#05)\" style=\"text-decoration:none;color:#000\" class=@#04>@02</a>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=@#04 id=@#05>@02</td>";
		$lvImgReply="<img src='".$this->dir."../images/iconcontrol/reply.png' width='12' height='12' title='Reply Email'/>";
		$lvImgRF="<img src='".$this->dir."../images/iconcontrol/all.png' width='12' height='12' title='Forward And Reply Email'/>";
		$lvImgForward="<img src='".$this->dir."../images/iconcontrol/forward.png' width='12' height='12' title='Forward Email'/>";
		$sqlS = "SELECT lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,'***' as lv009,lv010,lv011,lv012,lv013,lv014,lv016,lv020,lv023,lv024 FROM ml_lv0001 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
				$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@#05",count($lstArr) ,str_replace("@01",$vrow['lv001'] ,$lvHref))),str_replace("@#05",$vrow['lv001']."_".$i ,$lvTd));
				$strL=$strL.$vTemp;
			}
			$strImg='';
			if(	$vrow['lv023']==1 && $vrow['lv024']==1)
			{
				$strImg=$lvImgRF;
			}
			else
			{	if($vrow['lv023']==1)	
					$strImg=$lvImgReply;
				elseif($vrow['lv024']==1)	
					$strImg=$lvImgForward;
			}
				
			$lvTr1=str_replace("@98",$strImg,$lvTr);
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr1))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineboldtable",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
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
			window.open('".$this->Dir."ml_lv0001/?lang=".$this->lang."&func='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
		function getChecked(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{
				if(str=='') 
					str=div.value;
				else
					 str=str+','+div.value;
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
				$strTempChk=str_replace("@03","",$strTempChk);
			else
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			
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
		$lvTable="<div align=\"center\"><div ondblclick=\"this.innerHTML=''\"><img  src=\"".$this->GetLogo()."\" style=\"max-width:1024px\" /></div></div>
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
		$sqlS = "SELECT lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,'***' as lv009,lv010,lv011,lv012,lv013,lv014,lv016,lv020 FROM ml_lv0001 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
		$strTr=str_replace("../AttachFile","../../AttachFile",$strTr);
		$strTr=str_replace("../SendFile","../../SendFile",$strTr);
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

			case 'lv030':
				 $vsql="select lv003 lv001,lv003 lv002,IF(lv003='$vSelectID',1,0) lv003 from  ml_lv0008 where lv002='$this->lv003' order by lv007 asc";
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

			case 'lv030':
				$vsql="select lv003 lv001,lv003 lv002,IF(lv003='$vSelectID',1,0) lv003 from ml_lv0008 	 where lv003='$vSelectID' and lv002='$this->lv003'";
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