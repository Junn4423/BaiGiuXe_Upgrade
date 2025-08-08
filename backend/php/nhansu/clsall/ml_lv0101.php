<?php
class ml_lv0101 {

	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/

	var $server;
	var $port;
	var $protocol;
	var $connection;
	var $user;
	var $pass;
	var $CountSave;
	var $UserID;
	var $Dir;
	/**
	* description connection resource to mail server
	*
	* @var type
	*
	* @access type
	*/
	var $conn;
	

	function ml_lv0101() {

		$this->name = "mail";
		$this->CountSave=0;
		$this->Dir="";
	}

	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function Login ($server , $port , $protocol , $conn = "", $user , $pass) {

		//saving the variables
		$this->server = $server;
		$this->port = $port; //imap = 142 ; pop3 = 110
		$this->protocol = $protocol ; //imap = /imap   pop3 = /pop3
		$this->connection = $conn; //ssl = /ssl/novalidate-cert

		$this->s_conn = "{" . $server . ($port ? ":" . $port : "" ) ."/". $protocol . $conn . "}INBOX";
		
		//user data
		$this->user = $user;
		$this->pass = $pass;

		//initializing connection to server
		$this->conn = imap_open( $this->s_conn, $this->user , $this->pass);

		//checking if the connection succeded
		if (!is_resource($this->conn))
			return "0";

		
		return "1";
	}
	

	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function GetMails() {
$vDate=GetServerDate();
		//checking if the connection is still acctive
		if (@imap_ping($this->conn)) {

			//get number of messages 
			$messages = imap_num_msg($this->conn); 
			if ($messages > 0) {
				//reading the messages
				for ($i = 1; $i <= $messages; $i++) {
					///////////////////////////////////////////////////////				
					///////////////////init mail////////////////////////////				
					$lvml_lv0001=new ml_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0001');
					$lvml_lv0001->lv007=$this->user;
					//$strArr=explode("@",$lvml_lv0001->To);
					$lvml_lv0001->lv003=$this->UserID;
					///////////////////////////////////////////////////////
					$info = imap_fetchstructure($this->conn, $i);
					// find out how may parts the object has
					$numparts = count($info->parts);
					$mofetchoverview=imap_fetch_overview($this->conn , $i);
						 if (is_array($mofetchoverview)) {
							foreach ($mofetchoverview as $val) {
							//Get header infor																
								$lvml_lv0001->lv005=mysql_real_escape_string($val->subject);
								$lvml_lv0001->lv006=$val->from;
								$strArrDate=GetFormatDate($val->date,1);
								$lvml_lv0001->lv004=$strArrDate[0];
								$lvml_lv0001->lv014=$strArrDate[1];
//								echo "$val->msgno - $val->date - $val->subject-$val->from\n";
							}
						}					
					// find if if multipart message
					if ($numparts >= 1) {
						
					   $j=1;$vTime=GetServerTime();
					   foreach ($info->parts as $part) {
						  if (strtolower( $part->disposition )== "attachment" || strtolower($part->disposition=="inline")) {
							 // an attachment
							$vPtich=imap_fetchbody($this->conn , $i, $j);
							$strNote=base64_decode($vPtich);
							if(trim($part->dparameters[0]->value)=="" || $part->dparameters[0]->value==NULL)
							{
								$lvml_lv0001->lv009=$lvml_lv0001->lv009.$vPtich;
							}
							else
							{
								 $strFileName=str_replace(" ","_",trim($part->dparameters[0]->value));
								 $strFileNameHref="File_".$j.strrchr($strFileName,".");
								 $strFolder=$lvml_lv0001->lv003."/".str_replace("-","",$vDate).str_replace(":","",$vTime);
								$strPath=$this->Dir."../AttachFile/";
								create_folder($strPath, $strFolder);
								$lvml_lv0001->AttachFile("../AttachFile/".$strFolder."/".$strFileNameHref,$strFileName);	
								$fp = fopen($strPath.$strFolder."/".$strFileNameHref, "w" );
								fwrite( $fp,$strNote );
								fclose( $fp );				
							}

						  }
						  else				
						  	$lvml_lv0001->lv009=$lvml_lv0001->lv009.imap_fetchbody($this->conn , $i, $j);
						   $j++; 
						 
					   }
	
					   	
					}		
					else//Num part =0;
					   $lvml_lv0001->lv009=$lvml_lv0001->lv009.imap_fetchbody($this->conn , $i,1);

					   $lvml_lv0001->lv009=mysql_real_escape_string($lvml_lv0001->lv009);
					   // $lvml_lv0001->Body=str_replace("\n","<br>",$lvml_lv0001->Body);
					   
					   $lvml_lv0001->lv012=0;
					   $lvml_lv0001->lv011=1;
					   $lvml_lv0001->lv002=1;
					  if($lvml_lv0001->LV_Insert())
					  {
						  $this->CountSave=$this->CountSave+1;
					  }
					  else
					  {
					  	$lvml_lv0001->LV_Insert();
					  }					
					
				}
				
				return $mails;

			} else 
				return NULL;

		} else
			return NULL;
	}


	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function DeleteEmails() {
		//checking if the connection is still acctive
		if (@imap_ping($this->conn))
				
			//get number of messages 
			$messages = imap_num_msg($this->conn); 
			
			if ($messages > 0) {
				//reading the messages
				for ($i = 1; $i <= $messages; $i++) {
					//reading messages headers
					imap_delete ( $this->conn, $i);
				}

				imap_expunge($this->conn);
				return 1;
			} 

		return 0;
	}
	function DeleteEmailsGet($messages) {
		//checking if the connection is still acctive
		if (@imap_ping($this->conn))
				
			//get number of messages 
			
			if ($messages > 0) {
				//reading the messages
				for ($i = 1; $i <= $messages; $i++) {
					//reading messages headers
					imap_delete ( $this->conn, $i);
				}

				imap_expunge($this->conn);
				return 1;
			} 

		return 0;
	}

	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function DeleteEmail($id) {
		//checking if the connection is still acctive
		if (@imap_ping($this->conn)) {
			imap_delete ($this->conn , $id);

			return 1;
		} else 
			return 0;
	}
	

	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function Close() {
		//checking if the connection is still acctive
		if (@imap_ping($this->conn)) {
	
			imap_close($this->conn);
			return 1;

		} else
			return 0;
	}		
	function AnalysisAttachment($imap)
	{
	$message = 0;
		$info = imap_fetchstructure($imap, $message);
		
		// find out how may parts the object has
		$numparts = count($info->parts);
		
		// find if if multipart message
		if ($numparts > 1) {
		
		   echo "More then one part<BR>";
		   
		   foreach ($info->parts as $part) {
		
			  if ($part->disposition == "inline") {
				 // inline message. Show number of lines
			  
				 printf("Inline message has %s lines<BR>", $part->lines);
			  
			  } elseif ($part->disposition == "attachment") {
				 // an attachment
			  
				 echo "Attachment found!";
				 // print out the file name
				 echo "Filename: ", $part->dparameters[0]->value;
				 
			  }
			  
		   }
		   
		} else {
		   // only one part so get some useful info
		   echo "Only one part";
		}	
	}
}
?>