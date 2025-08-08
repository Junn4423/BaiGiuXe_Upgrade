<?php
class ml_toolmail
{
var $strproccess=null;
var $ArrConect=null;
var $ArrHeader=null;
	function ml_toolmail()
	{
	$this->ArrConect=array();
	$this->ArrConect[0][0]="------=_NextPart";
	$this->ArrConect[0][1]=4;	
	$this->ArrConect[0][2]="";	
	$this->ArrConect[1][0]="--0-";	
	$this->ArrConect[1][1]=3;	
	$this->ArrConect[1][2]=":=";			
	$this->ArrConect[2][0]="--=_alternative";		
	$this->ArrConect[2][1]=2;			
	$this->ArrConect[2][2]="";			
	$this->ArrConect[3][0]="------_=_NextPart";
	$this->ArrConect[3][1]=4;	
	$this->ArrConect[3][2]="";	
	$this->ArrConect[4][0]="--0-";	
	$this->ArrConect[4][1]=3;	
	$this->ArrConect[4][2]="=:";
	$this->ArrConect[5][0]="--1__=";	
	$this->ArrConect[5][1]=4;	
	$this->ArrConect[5][2]="";
				
	

	$this->ArrHeader= array();
	$this->ArrHeader[0][0]="=?utf-8?";
	$this->ArrHeader[0][1]=2;
	$this->ArrHeader[0][2]="?=";	
	$this->ArrHeader[1][0]="=?iso-8859-1?";
	$this->ArrHeader[1][1]=1;	
	$this->ArrHeader[1][2]="?=";		
	$this->ArrHeader[2][0]="=?Windows-1252?";
	$this->ArrHeader[2][1]=2;	
	$this->ArrHeader[2][2]="?=";			
	$this->ArrHeader[3][0]="=?UTF-8?";
	$this->ArrHeader[3][1]=2;	
	$this->ArrHeader[3][2]="?=";			
	}
	function Analysis($vProcess)
	{
		$u=0;
		$this->strproccess=$vProcess;
	
		for($j=0;$j<=count($this->ArrConect);$j++)
		{
			$u=0;
			$pos=strpos($vProcess,$this->ArrConect[$j][0]);	
			while($pos!==false)
			{
				
				$len=0;	
				$i=0;
				for($i=$pos;$i<strlen($this->strproccess);$i++)
				{
					if(substr($this->strproccess,$i,1)=="\n") $len++;
					if ($len>=(int)$this->ArrConect[$j][1]) { break;}
				}
				$strReplace=substr($this->strproccess,$pos,$i-$pos);
				if($this->ArrConect[$j][2]=="" || ($this->ArrConect[$j][2]!="" && strpos($strReplace,$this->ArrConect[$j][2])!==false)) 
				{	$this->strproccess=str_replace($strReplace,"",$this->strproccess);
				}
				$pos=strpos($this->strproccess,$this->ArrConect[$j][0],$u);	
				$u++;
				if($u>1000)
				{
				echo 'error!Please contract admin';
				break;			
				}
			}
		}
		return $this->strproccess;

	}
	function AnalysisHeader($vHeader)
	{
		$u=0;
		$this->strproccess=$vHeader;
		for($j=0;$j<=count($this->ArrHeader);$j++)
		{
				echo "[".$pos=strpos($this->strproccess,$this->ArrHeader[$j][0]);	
				if($pos!==false)
				{
					$u++;
					$strReplace=substr($this->strproccess,$pos,strlen($this->ArrHeader[$j][0])+2);
					$strDecode=substr($strReplace,strlen($strReplace)-2,2);
					$this->strproccess=str_replace($strReplace,"",$this->strproccess);
					$this->strproccess=str_replace("?=","",$this->strproccess);
					if($strDecode=="B?" || $strDecode=="b?") 
					{
						$this->strproccess=base64_decode($this->strproccess);
					}
					else
					$this->strproccess=quoted_printable_decode($this->strproccess);
					
				}
				

		}
		if($u<=0) $this->strproccess=quoted_printable_decode($this->strproccess);
		return $this->strproccess;	
	}
}
?>
			
