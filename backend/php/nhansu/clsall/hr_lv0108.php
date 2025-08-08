<?php
/////////////coding hr_lv0020///////////////
class   hr_lv0108 extends lv_controler
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
	protected $objhelp='hr_lv0020';
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
		$vsql="select * from  hr_lv0020";
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
			$this->lv018=$vrow['lv018'];
			$this->lv015=$vrow['lv015'];
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  hr_lv0020 Where lv001='$vlv001'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv001=$vrow['lv001'];
			$this->lv002=$vrow['lv002'];
			$this->lv030=$vrow['lv030'];
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
			$this->lv018=$vrow['lv018'];
			$this->lv015=$vrow['lv015'];

			$this->lv301=$vrow['lv301'];
			$this->lv302=$vrow['lv302'];
			$this->lv303=$vrow['lv303'];
			$this->lv304=$vrow['lv304'];
			$this->lv305=$vrow['lv305'];
			
		}
	}
	function LV_UpdatePrivate()
	{
		if($this->isEdit==0) return false;
		$this->lv011 = ($this->lv011!="")?recoverdate(($this->lv011), $this->lang):$this->DateDefault;
		$this->lv015 = ($this->lv015!="")?recoverdate(($this->lv015), $this->lang):$this->DateDefault;
		$this->lv030 = ($this->lv030!="")?recoverdate(($this->lv030), $this->lang):$this->DateDefault;
		$vIsTrue=false;
		$this->lv030=str_replace("/","-",$this->lv030);
		if($this->lv030>='2019-01-01' && $this->lv030<='2020-12-30')
		{
			$vIsTrue=true;
		}
		else
		{
			if($this->YearNgayThamGia<=2020 && $this->DateCurrent<='2021-10-20 00:00:00')
			{
				echo '<font color="red">Ngày tham gia chỉ cho phép sửa từ năm 2019 đến 2020!</font>';
			}
		}
		if($this->YearNgayThamGia<=2020 && $this->DateCurrent<='2021-10-20 00:00:00' && $vIsTrue==true)
			$lvsql="Update hr_lv0020 set lv030='".$this->lv030."',lv015='$this->lv015',lv018='$this->lv018',lv034='".sof_escape_string($this->lv034)."',lv035='".sof_escape_string($this->lv035)."',lv038='$this->lv038',lv041='$this->lv041',lv014='$this->lv014',lv106='$this->lv106',lv126='$this->lv126',lv010='$this->lv010',lv011='$this->lv011',lv012='".sof_escape_string($this->lv012)."',lv013='$this->lv013',lv301='".sof_escape_string($this->lv301)."',lv302='".sof_escape_string($this->lv302)."',lv303='".sof_escape_string($this->lv303)."',lv304='".sof_escape_string($this->lv304)."',lv305='".sof_escape_string($this->lv305)."' where  lv001='$this->lv001' ";
		else
			$lvsql="Update hr_lv0020 set lv015='$this->lv015',lv018='$this->lv018',lv034='".sof_escape_string($this->lv034)."',lv035='".sof_escape_string($this->lv035)."',lv038='$this->lv038',lv041='$this->lv041',lv014='$this->lv014',lv106='$this->lv106',lv126='$this->lv126',lv010='$this->lv010',lv011='$this->lv011',lv012='".sof_escape_string($this->lv012)."',lv013='$this->lv013',lv301='".sof_escape_string($this->lv301)."',lv302='".sof_escape_string($this->lv302)."',lv303='".sof_escape_string($this->lv303)."',lv304='".sof_escape_string($this->lv304)."',lv305='".sof_escape_string($this->lv305)."' where  lv001='$this->lv001' ";
		$vReturn= db_query($lvsql);
		if($vReturn) {
			$this->InsertLogOperation($this->DateCurrent,'hr_lv0020.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_UpdatePrivateLink()
	{
		if($this->isEdit==0) return false;
		
		$this->lv030 = ($this->lv030!="")?recoverdate(($this->lv030), $this->lang):$this->DateDefault;
		$vIsTrue=false;
		$this->lv030=str_replace("/","-",$this->lv030);
		if($this->lv030>='2019-01-01' && $this->lv030<='2020-12-30')
		{
			$vIsTrue=true;
		}
		else
		{
			if($this->YearNgayThamGia<=2020 && $this->DateCurrent<='2021-10-20 00:00:00')
			{
				echo '<font color="red">Ngày tham gia chỉ cho phép sửa từ năm 2019 đến 2020!</font>';
			}
		}
		if($this->YearNgayThamGia<=2020 && $this->DateCurrent<='2021-10-20 00:00:00' && $vIsTrue==true)
			$lvsql="Update hr_lv0020 set lv030='".$this->lv030."',lv301='".sof_escape_string($this->lv301)."',lv302='".sof_escape_string($this->lv302)."',lv303='".sof_escape_string($this->lv303)."',lv304='".sof_escape_string($this->lv304)."',lv305='".sof_escape_string($this->lv305)."' where  lv001='$this->lv001' ";
		else
			$lvsql="Update hr_lv0020 set lv301='".sof_escape_string($this->lv301)."',lv302='".sof_escape_string($this->lv302)."',lv303='".sof_escape_string($this->lv303)."',lv304='".sof_escape_string($this->lv304)."',lv305='".sof_escape_string($this->lv305)."' where  lv001='$this->lv001' ";
		$vReturn= db_query($lvsql);
		if($vReturn) {
			$this->InsertLogOperation($this->DateCurrent,'hr_lv0020.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_CheckSelft($vUserID)
	{
		$lvsql="select count(*) num from  hr_lv0020 Where lv001='$vUserID'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			if($vrow['num']>0) return true;
		}
		return false;
	}
	function LV_LoadStepCheck($vlv007)
	{
		$strReturn="";
		$strTotal=0;
		$lvsql="select lv001 from  nhansu_sof_documents_v4_0.hr_lv0041 Where lv002='$vlv007' ";
		$vresult=db_query($lvsql);
		$vrow = db_fetch_array ($vresult);
		if($vrow)
		{
			return $vrow['lv001'];				
		}
		return null;
	}
	function scaleImageFileToBlob($file,$max_width,$max_height) {

		$source_pic = $file;
		if($max_width==0) $max_width=661;
		if($max_height==0) $max_height=935;
		list($width, $height, $image_type) = getimagesize($file);
		
		switch ($image_type)
		{
			case 1: $src = imagecreatefromgif($file); break;
			case 2: $src = imagecreatefromjpeg($file);  break;
			case 3: $src = imagecreatefrompng($file); break;
			default: return '';  break;
		}
		
		$x_ratio = $max_width / $width;
		$y_ratio = $max_height / $height;
		
		if( ($width <= $max_width) && ($height <= $max_height) ){
			$tn_width = $width;
			$tn_height = $height;
			}elseif (($x_ratio * $height) < $max_height){
				$tn_height = ceil($x_ratio * $height);
				$tn_width = $max_width;
			}else{
				$tn_width = ceil($y_ratio * $width);
				$tn_height = $max_height;
		}
		
		$tmp = imagecreatetruecolor($tn_width,$tn_height);
		
		/* Check if this image is PNG or GIF, then set if Transparent*/
		if(($image_type == 1) OR ($image_type==3))
		{
			imagealphablending($tmp, false);
			imagesavealpha($tmp,true);
			$transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
			imagefilledrectangle($tmp, 0, 0, $tn_width, $tn_height, $transparent);
		}
		imagecopyresampled($tmp,$src,0,0,0,0,$tn_width, $tn_height,$width,$height);
		
		/*
		 * imageXXX() only has two options, save as a file, or send to the browser.
		 * It does not provide you the oppurtunity to manipulate the final GIF/JPG/PNG file stream
		 * So I start the output buffering, use imageXXX() to output the data stream to the browser, 
		 * get the contents of the stream, and use clean to silently discard the buffered contents.
		 */
		ob_start();
		
		switch ($image_type)
		{
			case 1: imagegif($tmp); break;
			case 2: imagejpeg($tmp, NULL, 100);  break; // best quality
			case 3: imagepng($tmp, NULL, 0); break; // no compression
			default: echo ''; break;
		}
		
		$final_image = ob_get_contents();
		
		ob_end_clean();
		
		return $final_image;
	}
	function LV_InsertAuto($vViTri,$vHinh)
	{
		if($this->isAdd==0) return false;
		$vField='lv'.Fillnum($vViTri,3);
		$lvsql="insert into nhansu_sof_documents_v4_0.hr_lv0041 (lv002,lv003,lv004,lv005,lv006,lv007,$vField) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','".sof_escape_string($vHinh)."')";
		$vReturn= db_query($lvsql);
		if($vReturn) 
		{
			$this->lv001=sof_insert_id();
			$this->InsertLogOperation($this->DateCurrent,'hr_lv0041.insert',sof_escape_string($lvsql));
		}
		return $vReturn;
	}	
	function LV_UpdateAuto($vKetQua,$vViTri,$vHinh)
	{
		if($this->isEdit==0) return false;
		$vField='lv'.Fillnum($vViTri,3);
		$lvsql="Update nhansu_sof_documents_v4_0.hr_lv0041 set $vField='".sof_escape_string($vHinh)."' where lv001='$vKetQua'";
		$vReturn= db_query($lvsql);
		if($vReturn) 
			$this->InsertLogOperation($this->DateCurrent,'nhansu_sof_documents_v4_0.hr_lv0041',sof_escape_string($lvsql));
		else
			echo sof_error();
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
}
?>