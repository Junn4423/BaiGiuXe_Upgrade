<?php
class ml_sendmail
{
        /*
        list of To addresses
        @var        array
        */
        var $sendto = array();
        /*
        @var        array
        */
        var $acc = array();
        /*
        @var        array
        */
        var $abcc = array();
        /*
        paths of attached files
        @var array
        */
        var $aattach = array();
        /*
        list of message headers
        @var array
        */
        var $xheaders = array();
        /*
        message priorities referential
        @var array
        */
        var $priorities = array( '1 (Highest)', '2 (High)', '3 (Normal)', '4 (Low)', '5 (Lowest)' );
        /*
        character set of message
        @var string
        */
        var $charset = "us-ascii";
        var $ctencoding = "7bit";
        var $receipt = 0;
        var $content_type='';
		var $lvml_lv0009=false;

/*

        Mail contructor

*/

function ml_sendmail()
{
		$this->Mail = new PHPMailer();
        $this->autoCheck( true );
        $this->boundary= "--" . md5( uniqid("myboundary") );
}

function Content_type($contenttype){

    $this->content_type=$contenttype;
    //echo $this->content_type;
    //echo '<br>';
    //exit();
}

/*

activate or desactivate the email addresses validator
ex: autoCheck( true ) turn the validator on
by default autoCheck feature is on

@param boolean        $bool set to true to turn on the auto validation
@access public
*/
function autoCheck( $bool )
{
        if( $bool )
                $this->checkAddress = true;
        else
                $this->checkAddress = false;
}


/*

Define the subject line of the email
@param string $subject any monoline string

*/
function Subject( $subject )
{
  $this->Mail->Subject=$subject;
}


/*

set the sender of the mail
@param string $from should be an email address

*/

function From( $from )
{

//        if( ! is_string($from) ) {
  //              echo "Class Mail: error, From is not a string";
    //            exit;
      //  }
        $this->xheaders['From'] = $from;
}

/*
 set the Reply-to header
 @param string $email should be an email address

*/
function ReplyTo( $address )
{

        if( ! is_string($address) )
                return false;

        $this->xheaders["Reply-To"] = $address;

}


/*
add a receipt to the mail ie.  a confirmation is returned to the "From" address (or "ReplyTo" if defined)
when the receiver opens the message.

@warning this functionality is *not* a standard, thus only some mail clients are compliants.

*/

function Receipt()
{
        $this->receipt = 1;
}


/*
set the mail recipient
@param string $to email address, accept both a single address or an array of addresses

*/

function To( $to )
{

        // TODO : test validité sur to
        if( is_array( $to ) )
                $this->sendto= $to;
        else
                $this->sendto[] = $to;

        if( $this->checkAddress == true )
                $this->CheckAdresses( $this->sendto );

}


/*                Cc()
 *                set the CC headers ( carbon copy )
 *                $cc : email address(es), accept both array and string
 */

function Cc( $cc )
{
        if( is_array($cc) )
                $this->acc= $cc;
        else
                $this->acc[]= $cc;

        if( $this->checkAddress == true )
                $this->CheckAdresses( $this->acc );

}



/*                Bcc()
 *                set the Bcc headers ( blank carbon copy ).
 *                $bcc : email address(es), accept both array and string
 */

function Bcc( $bcc )
{
        if( is_array($bcc) ) {
                $this->abcc = $bcc;
        } else {
                $this->abcc[]= $bcc;
        }

        if( $this->checkAddress == true )
                $this->CheckAdresses( $this->abcc );
}

/*                Body( text [, charset] )
 *                set the body (message) of the mail
 *                define the charset if the message contains extended characters (accents)
 *                default to us-ascii
 *                $mail->Body( "mél en français avec des accents", "iso-8859-1" );
 */
function Body( $body, $charset="" )
{
       $this->Mail->Body=$body;
}


/*                Organization( $org )
 *                set the Organization header
 */

function Organization( $org )
{
        if( trim( $org != "" )  )
                $this->xheaders['Organization'] = $org;
}


/*                Priority( $priority )
 *                set the mail priority
 *                $priority : integer taken between 1 (highest) and 5 ( lowest )
 *                ex: $mail->Priority(1) ; => Highest
 */

function Priority( $priority )
{
        if( ! intval( $priority ) )
                return false;

        if( ! isset( $this->priorities[$priority-1]) )
                return false;

        $this->xheaders["X-Priority"] = $this->priorities[$priority-1];

        return true;

}


/*
 Attach a file to the mail

 @param string $filename : path of the file to attach
 @param string $filetype : MIME-type of the file. default to 'application/x-unknown-content-type'
 @param string $disposition : instruct the Mailclient to display the file if possible ("inline") or always as a link ("attachment") possible values are "inline", "attachment"
 */

function Attach($filename,$filealias = "", $filetype = "",$disposition = "inline",$encoding = 'base64')
{

       $this->Mail->AddAttachment($filename, $filealias, $encoding, $filetype);

}

/*

Build the email message

@access protected

*/
/*
        fornat and send the mail
        @access public
*/
	
function Send()
{
        //global $filename;
//        $this->BuildMail();

		$this->setUp();
		
		$this->CheckChanges();
        $this->strTo = implode( ", ", $this->sendto );
		for($i=0;$i<count($this->sendto);$i++)
		{
			$this->SetAddress($this->sendto[$i],"","to");
		}
		for($i=0;$i<count($this->acc);$i++)
		{
			$this->SetAddress($this->acc[$i],"","cc");			
		}
		$res = $this->Mail->Send();
       // $res = @mail( $this->strTo, $this->xheaders['Subject'], $this->fullBody, $this->headers );

		return $res;

}



/*
 *                return the whole e-mail , headers + message
 *                can be used for displaying the message in plain text or logging it
 */

function Get()
{
        $this->BuildMail();
        $mail = "To: " . $this->strTo . "\n";
        $mail .= $this->headers . "\n";
        $mail .= $this->fullBody;
        return $mail;
}


/*
        check an email address validity
        @access public
        @param string $address : email address to check
        @return true if email adress is ok
 */

function ValidEmail($address)
{
        if( ereg( ".*<(.+)>", $address, $regs ) ) {
                $address = $regs[1];
        }
         if(ereg( "^[^@  ]+@([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9\-]{2}|net|com|gov|mil|org|edu|int)\$",$address) )
                 return true;
         else
                 return false;
}


/*

        check validity of email addresses
        @param        array $aad -
        @return if unvalid, output an error message and exit, this may -should- be customized

 */

function CheckAdresses( $aad )
{
        for($i=0;$i< count( $aad); $i++ ) {
                if( ! $this->ValidEmail( $aad[$i]) ) {
//                        echo "Class Mail, method Mail : invalid address $aad[$i]";
  //                      exit;
                }
        }
}


/*
 check and encode attach file(s) . internal use only

*/


///////SaveFile
	function SaveAndGetFile($vFileRead,$vFilePath,$vUserID,$vFileName)
	{	

			$vDate=GetServerDate();
			$vTime=GetServerTime();
			$strFolder=$vUserID."/".str_replace("-","",$vDate).str_replace(":","",$vTime);
			$strPath=$vFilePath;
			create_folder($strPath, $strFolder);
			$handle = fopen($vFileRead, "r" );
			$contents = fread($handle, filesize($vFileRead));
			fclose( $handle );
			$fp = fopen($strPath.$strFolder."/".$vFileName, "w" );
			fwrite( $fp,$contents );
			fclose( $fp);
			return "/mailmanagementx06/SendFile/".$strFolder."/".$vFileName;			
	}

//////////////////////////////SMTP Proceess/////////////////////////////
    function setUp() {
		$vRoot=explode("@",$this->xheaders['From']);
        $this->Mail->Priority = 3;
        $this->Mail->Encoding = "8bit";
        $this->Mail->CharSet = "iso-8859-1";
        $this->Mail->From =$this->xheaders['From'];
        $this->Mail->FromName =$vRoot[0];
        $this->Mail->Sender = $this->lvml_lv0009->UserLog;
        $this->Mail->AltBody = "";
        $this->Mail->WordWrap = 0;
        $this->Mail->Host =$this->lvml_lv0009->Server;
        $this->Mail->Port = $this->lvml_lv0009->Port;
        $this->Mail->Helo =$vRoot[1];
        $this->Mail->SMTPAuth = true;
        $this->Mail->Username = $this->lvml_lv0009->UserLog;
        $this->Mail->Password =$this->lvml_lv0009->PwdLog;
        $this->Mail->PluginDir = $INCLUDE_DIR;
		$this->Mail->AddReplyTo($this->xheaders['From'], "");
        $this->Mail->Sender = $this->lvml_lv0009->UserLog;
        if(strlen($this->Mail->Host) > 0)
            $this->Mail->Mailer = "smtp";
        else
        {
            $this->Mail->Mailer = "mail";
            $this->Sender = $this->lvml_lv0009->UserLog;
        }

    } 
    /**
     * Check which default settings have been changed for the report.
     * @private
     * @returns void
     */	
    function CheckChanges() {
        if($this->Mail->Priority != 3)
            $this->AddChange("Priority", $this->Mail->Priority);
        if($this->Mail->Encoding != "8bit")
            $this->AddChange("Encoding", $this->Mail->Encoding);
        if($this->Mail->CharSet != "iso-8859-1")
            $this->AddChange("CharSet", $this->Mail->CharSet);
        if($this->Mail->Sender != "")
            $this->AddChange("Sender", $this->Mail->Sender);
        if($this->Mail->WordWrap != 0)
            $this->AddChange("WordWrap", $this->Mail->WordWrap);
        if($this->Mail->Mailer != "mail")
            $this->AddChange("Mailer", $this->Mail->Mailer);
        if($this->Mail->Port != 25)
            $this->AddChange("Port", $this->Mail->Port);
        if($this->Mail->Helo != "localhost.localdomain")
            $this->AddChange("Helo", $this->Mail->Helo);
        if($this->Mail->SMTPAuth)
            $this->AddChange("SMTPAuth", "true");
    }
    
    /**
     * Adds a change entry.
     * @private
     * @returns void
     */
    function AddChange($sName, $sNewValue) {
        $cur = count($this->ChangeLog);
        $this->ChangeLog[$cur][0] = $sName;
        $this->ChangeLog[$cur][1] = $sNewValue;
    }	
    /**
     * Adds all of the addresses
     * @public
     * @returns void
     */
	function SetAddress($sAddress, $sName = "", $sType = "to") {
        switch($sType)
        {
            case "to":
                $this->Mail->AddAddress($sAddress, $sName);
                break;
            case "cc":
                $this->Mail->AddCC($sAddress, $sName);
                break;
            case "bcc":
                $this->Mail->AddBCC($sAddress, $sName);
                break;
        }
    }	
} // class Mail



?>