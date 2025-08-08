<?php
/*
*/
class ml_lv0102
{
	public $apop_detect = null;    // default = FALSE
	public $log = null;            // default = FALSE
	public $log_file =null; // must be set when $this->log = TRUE !!!
	public $qmailer = null;
	
	
	// func $pop3->connect()
	public $server = null;
	// optional !!
	public $port = null;
	public $conn_timeout =null;  // Connection Timeout
	public $sock_timeout =null; // Socket Timeout
	
	// func $pop3->login()
	public $username = null;
	public $password = null;
	public $savetomysql = null;
	public $savetofile = null;
	public $delete = null;
	public $pop3=null;
	public $lvml_lv0001=null;	
	var $file_fp;
	function __construct()
	{
	
	// Constructor
	// optional
	$this->apop_detect = TRUE;    // default = FALSE
	$this->log = TRUE;            // default = FALSE
	$this->log_file = "mail.sof.vn"; // must be set when $this->log = TRUE !!!
	$this->qmailer = FALSE;
	
	
	// func $pop3->connect()
	$this->server = "mail.sof.vn";
	// optional !!
	$port = "110";
	$conn_timeout = "125";  // Connection Timeout
	$sock_timeout = "110,1500"; // Socket Timeout
	
	// func $pop3->login()
	$this->username = "";
	$this->password = "";
	$this->savetomysql = TRUE;
	$this->savetofile = FALSE;
	$this->delete = TRUE;
	}
	function getmail()
	{
		$pop3 = new POP3($this->log,$this->log_file,$this->apop_detect);
		
		if($pop3->connect($this->server)){
			if($pop3->login($this->username,$this->password)){
				if(!$msg_list = $pop3->get_office_status()){
					echo $pop3->error;
					return;
				}
			}else{
				echo $pop3->error;
				return;
			}
		}else{
			echo $pop3->error;
			return;
		}
		$noob = TRUE;
		for($i=1;$i<=$msg_list["count_mails"];$i++){
			if(!$header = $pop3->get_top($i)){
				echo $pop3->error;
			}
			// Get Message ID and set $unique_id for save2file()
				$g = 0;
				while(!ereg("</HEADER>",$header[$g])){
					if(eregi("Message-ID",$header[$g])){
						$unique_id = md5($header[$g]);
					}
					$g++;
				}
			unset($g);
			$unique_id=$_SESSION['ERPSOFV2RUserID']."_".$unique_id."_".date("Ymd_his");
			$get_msg = TRUE;
			//$this->savetofile = TRUE;
		   // $this->savetomysql = TRUE;
			if($get_msg){
				if(!$message = $pop3->get_mail($i, $this->qmailer)){
					echo $pop3->error;
					//$this->savetofile = FALSE;
					//$this->savetomysql = FALSE;
					//$this->delete = FALSE;
				}
			}
			// Save to File !!!
			$this->savetofile=true;
			if($this->savetofile){
				$filename = "../backupmail/".$unique_id.".txt";
		
				if(!is_file($filename)){
				$completed = $this->save2file($message,$filename,$pop3);
				if($completed){
					echo "File save to complete !! \r\n <br>";
				}
				}else{
					echo "File <b>(".$filename.")</b> already exists. !! \r\n <br>";
				}
			}	
			
			// Save to MySQL
		/*	$completed=true;
			if($this->savetomysql){
				$completed = $this->save2mysql($message);
				if($completed){
					echo "File save to MySQL complete.\r\n <br>";// (".$count_bytes." Bytes written) !! \r\n <br>";
				}else{
					echo $pop3->error;
					return;
				}
			}
			*/
			// Send Noob command !!
			if($noop){
				if(!$pop3->noop()){
					echo $pop3->error;
					$noob = FALSE;
				}
			}	
			// Delete MSG
			if($this->delete && $completed ){
				if($pop3->delete_mail($i)){
					echo "Email is recevied and deleted !!! \r\n <br>";
				}else{
					echo $pop3->error;
				}
			}	
		}
		if($msg_list["count_mails"] == "0"){
			echo "No email receive!!";
		}
		
		$pop3->close();
		}
		  /*
      Funktion save2mysql($message,$mysql_socket,$dir_table = "inbox",$msg_table = "messages",$read = "0")
      Access: Public

    */
	function get_subject($lvsubject)
	{
			$vsub=$lvsubject;
			if(!strpos($lvsubject,"?B?")===false)
			{
				$varrsub=explode("?B?",$lvsubject,2);
				$vstrPlit="=?=";
				if(strpos($varrsub[1],$vstrPlit)===false)
				{
					$vstrPlit="=?";
					if(strpos($varrsub[1],$vstrPlit)===false)	$vstrPlit="?=";
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
					$vstrPlit="=?";
					if(strpos($varrsub[1],$vstrPlit)===false)	$vstrPlit="?=";
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
	function get_checkcontent($response)
    {
     if(eregi("charset=",$response)) return true;
	 if(eregi("Content-Transfer-Encoding:",$response)) return true;
     return false;  		
    }
	function save2file($message,$filename,$pop3){
		$header=Array();
		$this->lvml_lv0001=new ml_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0001');
        $this->file_fp = fopen($filename,"w+");
        if(!$this->file_fp){
            $this->error = "POP3 save2file() - Error: Can't open file in write mode. (".$filename.")";
            if(!$pop3->_logging($this->error)) return FALSE;
            $pop3->_cleanup();
            return FALSE;
        }
        if(!$pop3->_logging("LOG FILE: File ".$filename." created.")){
            $pop3->_cleanup();
            return FALSE;
        }
        $count_bytes = "0";
        $vheadercheck=true;
        $vattachfilecheck=false;
        for($i=0;$i<count($message);$i++){
            $line = $message[$i];
            $str_len = strlen($line);
            if($str_len>0)
            {
            	if($vheadercheck)
            	{
            		if(substr($line,0,9) == "</HEADER>")
            		{
            			$vheadercheck=false;
            		}
            		$header=$this->save_array_header($header,$message,$i);
            	}
            	else 
            	{
            		if($vattachfilecheck==false)
            		{
	            		if(eregi("Content-Disposition:",$message[$i]) && (eregi("attachment",$message[$i]) || eregi("inline",$message[$i]))){
	            			$vattachfilecheck=true;
	            		}
            		}
            	}
	            $count_bytes = $count_bytes + $str_len;
	            if(!fputs($this->file_fp,$line,$str_len)){
	                $this->error = "POP3 save2file() - Error: Can't write string to file (".$filename.") !!!";
	                if(!$pop3->_logging($this->error)) return FALSE;
	                $this->_cleanup();
	                return FALSE;
	            }
            }
            unset($line);
        }
        if(!$pop3->_logging("LOG FILE: File ".$filename." (".$count_bytes." Bytes) written.")){
            $pop3->_cleanup();
            return FALSE;
        }
		$this->lvml_lv0001->lv002='1';
		$this->lvml_lv0001->lv003=$_SESSION['ERPSOFV2RUserID'];
		 // Vars that must be set with a value !!!
        if(!isset($header["message_id"])) $header["message_id"] = "--";
        if(!isset($header["from"])) $header["from"] = "--";
        if(!isset($header["to"])) $header["to"] = "--";
        if(!isset($header["subject"])) $header["subject"] = "--";
        if(!isset($header["date"])) $header["date"] = "--";
        if(!isset($header["received"])) $header["received"] = "--";
		$strDate=$this->ConverDateMail($header["date"]);
        ////////////////////////////////////////////////////////////////////////
		$this->lvml_lv0001->lv004=$strDate;
		$this->lvml_lv0001->lv005=$this->lvml_lv0001->LV_Escape_String(strip_tags(str_replace("Subject: ","",$this->get_subject($header["subject"]))));
		$this->lvml_lv0001->lv006=$this->LV_ConvertCode(str_replace("From: ","",$header["from"]));
		$this->lvml_lv0001->lv007=$this->LV_ConvertCode($this->GetExactly(str_replace("To: ","",$header["to"])));
		$this->lvml_lv0001->lv008=$this->lvml_lv0001->LV_Escape_String($this->GetExactly(str_replace("Cc: ","",$header["cc"])));
		$this->lvml_lv0001->lv016=$this->lvml_lv0001->LV_Escape_String($this->GetExactly(str_replace("Bcc: ","",$header["bcc"])));
		if($vattachfilecheck)
		 	$this->lvml_lv0001->lv010="Có";
		else
			$this->lvml_lv0001->lv010="Không";
		$this->lvml_lv0001->lv009=$filename;
		$this->lvml_lv0001->lv011='1';
		$this->lvml_lv0001->lv012='0';
		$this->lvml_lv0001->lv014=gettime($strDate);
		$this->lvml_lv0001->lv015=$this->lvml_lv0001->LV_Escape_String($vAllStr);
		$this->lvml_lv0001->lv017=$this->username;
		$this->lvml_lv0001->lv020=$count_bytes;
		$vReturn=$this->lvml_lv0001->LV_InsertAuto(); 
        $this->mysql_socket = FALSE;
      
        return $vReturn;
    }
    function save_array_header($header,$message,$i)
    {
    	
            $message[$i] = str_replace("'","\"",$message[$i]);
			$vAllStr=$vAllStr.$message[$i];
            while(substr($message[$i],0,1) == " "){
                $header_keys = array_keys($header);
                $header[$header_keys[count($header_keys)-1]] .= $message[$i];
                unset($array_keys);
                $i++;
            }
            if(eregi("Message-ID",$message[$i])){
                $header["message_id"] = trim($message[$i]);
            }
            if(eregi("Subject",substr(trim($message[$i]),0,7))){
				$header["subject"] = $message[$i];
				while(true)
				{
					$headerext=trim($message[$i+1]);
					if(substr($headerext,0,2)=="=?")
					{ 
					$header["subject"]=$header["subject"].$headerext;
					$i++;
					}
					else
					break;
				}
            }
            $to = substr(trim($message[$i]),0,2);
            if(eregi("TO",$to)){
               $header["to"] = trim($message[$i]);
            }

            if(eregi("CC",$to)){
               $header["cc"] = trim($message[$i]);
            }
            unset($to);
            if(eregi("BCC",substr(trim($message[$i]),0,3))){
                $header["bcc"] = trim($message[$i]);
            }
            if(eregi("FROM",substr(trim($message[$i]),0,4))){
            	$header["from"] = trim($message[$i]);
            }
            if(eregi("DATE",substr(trim($message[$i]),0,4))){
                $header["date"] = trim($message[$i]);
            }
            if(eregi("Content-Type",$message[$i])){
                $header["content_type"] = trim($message[$i]);
            }
            if(eregi("Content-Transfer-Encoding",$message[$i])){
                $header["content_encode"] = trim($message[$i]);
            }
            if(eregi("MIME-Version",$message[$i])){
                $header["mime_version"] = trim($message[$i]);
            }
            if(eregi("Reply-To",substr($message[$i],0,8))){
                $header["reply_to"] = trim($message[$i]);
            }
            if(eregi("X-Mailer",$message[$i])){
                $header["x_mailer"] = trim($message[$i]);
            }
            if(eregi("X-Priority",$message[$i])){
                $header["x_priority"] = substr(trim($message[$i]),-1);
            }
            if(eregi("Sender",$message[$i])){
                if(!(strpos($message[$i],"@"))===false)  $header["sender"] = trim($message[$i]);
            }
            if(eregi("Mail-Followup-To",$message[$i])){
                $header["mail_followup_to"] = trim($message[$i]);
            }
            if(eregi("Mail-Reply-To",$message[$i])){
                $header["mail_reply_to"] = trim($message[$i]);
            }
            if(eregi("Return-Receipt-To",$message[$i])){
                $header["return_receipt_to"] = trim($message[$i]);
            }
			if(eregi("boundary",$message[$i])){
                $header["boundary"] = trim($message[$i]);
            }
			
            if(eregi("Disposition-Notifaction-To",$message[$i])){
                $header["disposition_notifaction_to"] = trim($message[$i]);
            }
            if(eregi("Received",$message[$i])){
                if(isset($header["received"])){
                    $header["received"] .= " <next> ";
                    $header["received"] .= trim($message[$i]);
                }else{
                    $header["received"] = trim($message[$i]);
                }
            }
            return $header;
			
    }
    function LV_ConvertCode($lv_Str)
    {
    	if(!strpos($lv_Str,"?=")===false)
    	{
    	$vArrTemp=explode("?=",str_replace("=?UTF-8?Q?","",str_replace("=?utf-8?Q?","",str_replace("=?UTF-8?B?","",str_replace("=?utf-8?B?","",$lv_Str)))));

    	if(!strpos($lv_Str,"?B?")===false)
			$vArrTemp[0]=base64_decode($vArrTemp[0]);
		elseif(!strpos($lv_Str,"?Q?")===false)
			$vArrTemp[0]=quoted_printable_decode($vArrTemp[0]);
		 return $vArrTemp[0].$vArrTemp[1];
    	}
		return $lv_Str;
    }
	function ConverDateMail($StrDate)
	{
		$StrDate=trim($StrDate);
		$vArr=explode(" ",$StrDate);
		if((int)$vArr[4]>2000)
			return $vArr[4]."-".GetMonthNumBer($vArr[3])."-".Fillnum($vArr[2],2)." ".$vArr[5];
		else
			return $vArr[3]."-".GetMonthNumBer($vArr[2])."-".Fillnum($vArr[1],2)." ".$vArr[4];
	}
	function SaveFile($vPtich,$vFileName,$vCode,$vDate,$NumTimes)
	{
		$j=$NumTimes;$vTime=str_replace(":","",GetServerTime());
		if(trim($vFileName)=="" || $vFileName==NULL)
		{
			$lvml_lv0001->lv009=$lvml_lv0001->lv009.$vPtich;
		}
		else
		{
			$strFileName=str_replace(" ","_",trim($vFileName));
			$strFileNameHref="File_".$this->lvml_lv0001->lv003."_".$vTime.$j.strrchr($vFileName,".");
			$strFolder="";
			$strPath=$this->Dir."../AttachFile/";
			if($vCode=="base64")	$strSave=base64_decode(trim($vPtich));
			else
				$strSave=$vPtich;
			$this->lvml_lv0001->AttachFile($strPath.$strFileNameHref,$strFileName);	
			$fp = fopen($strPath.$strFileNameHref, "w" );
			fwrite( $fp,$strSave );
			fclose( $fp );				
		}
	}
	function GetExactly($vEmail)
	{
		if(eregi("<",$vEmail))
		{
			$vArray=explode("<",$vEmail);
			$vArray2=explode(">",$vArray[1]);
			return $vArray2[0];
		}
		return $vEmail;
	}
}
?>
