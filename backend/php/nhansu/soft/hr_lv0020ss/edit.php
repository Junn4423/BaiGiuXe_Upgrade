<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
$vDefaultPath="../../images/employees/";
//require_once("../../clsall/hr_lv0020.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0020.php");
//////////////init object////////////////
$lvhr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$lvhr_lv0020->lv001= $_GET['ID'] ?? '';
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","AD0022.txt",$plang);
$lvhr_lv0020->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
if($vFlag==1)
{
$lvhr_lv0020->lv001_=$_POST['txtlv001_'];
$lvhr_lv0020->lv002=$_POST['txtlv002'];
$lvhr_lv0020->lv003=$_POST['txtlv003'];
$lvhr_lv0020->lv004=$_POST['txtlv004'];
$lvhr_lv0020->lv005=$_POST['txtlv005'];
$lvhr_lv0020->lv006=$_POST['txtlv006'];
if($_FILES['userfile']['name']=="")
$lvhr_lv0020->lv007=$_POST['txtlv007'];
else
$lvhr_lv0020->lv007=$_FILES['userfile']['name'];
$lvhr_lv0020->lv008=$_POST['txtlv008'];
$lvhr_lv0020->lv009=$_POST['txtlv009'];
$lvhr_lv0020->lv010=$_POST['txtlv010'];
$lvhr_lv0020->lv011=$_POST['txtlv011'];
$lvhr_lv0020->lv012=$_POST['txtlv012'];
$lvhr_lv0020->lv013=$_POST['txtlv013'];
$lvhr_lv0020->lv014=$_POST['txtlv014'];
$lvhr_lv0020->lv015=$_POST['txtlv015'];
$lvhr_lv0020->lv016=$_POST['txtlv016'];
$lvhr_lv0020->lv017=$_POST['txtlv017'];
$lvhr_lv0020->lv018=$_POST['txtlv018'];
$lvhr_lv0020->lv019=$_POST['txtlv019'];
$lvhr_lv0020->lv020=$_POST['txtlv020'];
$lvhr_lv0020->lv021=$_POST['txtlv021'];
$lvhr_lv0020->lv022=$_POST['txtlv022'];
$lvhr_lv0020->lv023=$_POST['txtlv023'];
$lvhr_lv0020->lv024=$_POST['txtlv024'];
$lvhr_lv0020->lv025=$_POST['txtlv025'];
$lvhr_lv0020->lv026=$_POST['txtlv026'];
$lvhr_lv0020->lv027=$_POST['txtlv027'];
$lvhr_lv0020->lv028=$_POST['txtlv028'];
$lvhr_lv0020->lv029=$_POST['txtlv029'];
$lvhr_lv0020->lv030=$_POST['txtlv030'];
$lvhr_lv0020->lv031=$_POST['txtlv031'];
$lvhr_lv0020->lv032=$_POST['txtlv032'];
$lvhr_lv0020->lv033=$_POST['txtlv033'];
$lvhr_lv0020->lv034=$_POST['txtlv034'];
$lvhr_lv0020->lv035=$_POST['txtlv035'];
$lvhr_lv0020->lv036=$_POST['txtlv036'];
$lvhr_lv0020->lv037=$_POST['txtlv037'];
$lvhr_lv0020->lv038=$_POST['txtlv038'];
$lvhr_lv0020->lv039=$_POST['txtlv039'];
$lvhr_lv0020->lv040=$_POST['txtlv040'];
$lvhr_lv0020->lv041=$_POST['txtlv041'];
$lvhr_lv0020->lv042=$_POST['txtlv042'];
$lvhr_lv0020->lv043=$_POST['txtlv043'];
$lvhr_lv0020->lv044=$_POST['txtlv044'];
$lvhr_lv0020->lv045=$_POST['txtlv045'];
$lvhr_lv0020->lv049=$_POST['txtlv049'];
$lvhr_lv0020->lv060=$_POST['txtlv060'];
$lvhr_lv0020->lv061=$_POST['txtlv061'];
$lvhr_lv0020->lv062=$_POST['txtlv062'];
$lvhr_lv0020->lv063=$_POST['txtlv063'];
$lvhr_lv0020->lv064=$_POST['txtlv064'];
$lvhr_lv0020->lv065=$_POST['txtlv065'];
$lvhr_lv0020->lv066=$_POST['txtlv066'];
$lvhr_lv0020->lv067=$_POST['txtlv067'];
$lvhr_lv0020->lv068=$_POST['txtlv068'];
$lvhr_lv0020->lv069=$_POST['txtlv069'];
$lvhr_lv0020->lv106=$_POST['txtlv106'];

$lvhr_lv0020->lv099=$_POST['txtlv099'];
$lvhr_lv0020->lv100=$_POST['txtlv100'];
$lvhr_lv0020->lv101=$_POST['txtlv101'];
$lvhr_lv0020->lv102=$_POST['txtlv102'];
$lvhr_lv0020->lv299=$_POST['txtlv299'];
$lvhr_lv0020->lv114=$_POST['txtlv114'];
$lvhr_lv0020->lv116=$_POST['txtlv116'];
		$vresult=$lvhr_lv0020->LV_Update();
		if($vresult==true) {
			if($_FILES['userfile']['name']!="")
			UploadImg($vDefaultPath,$lvhr_lv0020->lv001, $lvhr_lv0020->lv007);///Call function Upload file
			$vStrMessage=$vLangArr[11];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();		
			$vFlag = 0;
		}
}
$lvhr_lv0020->LV_LoadID($lvhr_lv0020->lv001);
if($lvhr_lv0020->lv022=='') $lvhr_lv0020->lv022='VIETNAM';
if($lvhr_lv0020->lv044==NULL || $lvhr_lv0020->lv044=='' || $lvhr_lv0020->lv044=='1900-01-01' || $lvhr_lv0020->lv044=='0000-00-00') $lvhr_lv0020->lv044=' ';
if($lvhr_lv0020->lv021==NULL || $lvhr_lv0020->lv021='' || $lvhr_lv0020->lv021=='1900-01-01' || $lvhr_lv0020->lv021=='0000-00-00') $lvhr_lv0020->lv021=' ';
function DelFiles($path, $vFileName){
	if (is_dir($path)) {
		if ($dh = opendir($path)) {
			while (($file = readdir($dh)) !== false) {
				if(!(is_dir($path.$file) && $file!="." && $file!=".."  )) {
					if($file!=$vFileName && $file!="index.html") delete_file($path.$file);
				}
			}
			closedir($dh);
		}
	}
	//return $files;
}
function UploadImg($folder_name,$folderemp, $fname){
	$maxsize = 3169600;//Max file size 300kb
	$path = $folder_name.$folderemp."/";
	if( !is_dir($path )) create_folder( $folder_name,$folderemp);
	$vFileName = $fname;
	$arrName = explode(".", $fname);
		$fname = $arrName[0];///Get name without extention of file
	$result = upload_file($fpath, $fname, $path, $maxsize);
	if($result==1){
		$message = "Image uploaded successfully!";
		DelFiles($path, $vFileName);///Remove all other file
	}
	if($result==2)
		$message = "Incorrect file type!";
	if($result==3 || $result==4)
		$message = "Image size is very small or big!";
	if($result==5 || $result==6)
		$message = "Error in uploading file, please try again!";
}
$lvhr_lv0020->lv029ex='';
if($lvhr_lv0020->GetApr()==0)  $lvhr_lv0020->lv029ex=$lvhr_lv0020->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script></head>
<script language="javascript">
<!--
function isphone(s){
	if(s!=""){
		var str="0123456789. ()-"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					return false
				}	
			return true
		}	
		return true
}
	function Refresh()
	{
		var o=document.frmedit;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv001.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmedit;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		//o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmedit;
	if(o.txtlv001.value=="")
		{
			alert("<?php echo $vLangArr[60];?>");
			o.txtlv001.select();
		}
		else if(o.txtlv002.value==""){
			alert("<?php echo $vLangArr[61];?>");
			o.txtlv002.focus();
			}
		else if(!isphone(o.txtlv037.value)){
			alert("<?php echo $vLangArr[60];?>");
			o.txtlv004.focus();
			}	
		else if(!isphone(o.txtlv038.value)){
			alert("<?php echo $vLangArr[60];?>");
			o.txtlv038.focus();
			}	
		else if(!isphone(o.txtlv039.value)){
			alert("<?php echo $vLangArr[60];?>");
			o.txtlv039.focus();
			}		
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}

-->
</script>
<?php
if($lvhr_lv0020->GetEdit()>0)
{
?>
<body onkeyup="KeyPublicRun(event)">
<div id="content_child" >
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[14];?></h2>
    <h3>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmedit" method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="4" height="100%" align="center">
								</font>
								<?php
									$vStrMessage = "";
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="150"  height="20"><?php echo $vLangArr[15];?></td>
								<td width="300"  height="20">
								<input name="txtlv001" type="hidden" id="txtlv001"  value="<?php echo $lvhr_lv0020->lv001;?>" tabindex="5" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)" />			
								<input name="txtlv001_" type="text" id="txtlv001_"  value="<?php echo $lvhr_lv0020->lv001;?>" tabindex="5" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								</td>
								<td width="150"   height="20"><?php echo $vLangArr[16];?></td>
								<td width="300"  height="20"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvhr_lv0020->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[17];?></td>
								<td  height="20"><input  name="txtlv003" type="text" id="txtlv003" value="<?php echo $lvhr_lv0020->lv003;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td  height="20"><?php echo $vLangArr[18];?></td>
								<td  height="20"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvhr_lv0020->lv004;?>" tabindex="8" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>								
							<tr>
								<td  height="20"><?php echo $vLangArr[19];?></td>
								<td  height="20"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvhr_lv0020->lv005;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
								<td  height="20"><?php echo $vLangArr[20];?></td>
								<td  height="20"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvhr_lv0020->lv006;?>" tabindex="10" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							</tr>	
							<tr>
								<td  height="20"><?php echo $vLangArr[43];?></td>
							    <td  height="20"><select name="txtlv029"  id="txtlv029" value="<?php echo $lvhr_lv0020->lv029;?>" tabindex="11"  style="width:80%" onKeyPress="return CheckKey(event,7)"><?php echo $lvhr_lv0020->LV_GetChildDepSelect($lvhr_lv0020->lv029ex,$lvhr_lv0020->lv029);//LV_LinkField('lv029',$lvhr_lv0020->lv029);?></select></td></select></td>
								<td colspan="2" rowspan="4" align="center"><img  name="imgView" border="1" style="border-color:#CCCCCC;" title="" alt="Image" width="96px" height="100px" 
								src="<?php echo "../../images/employees/".$lvhr_lv0020->lv001."/".$lvhr_lv0020->lv007; ?>" /></td>
								</td>
							</tr>
							<tr>
															 
								<td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20"><select name="txtlv009" id="txtlv009" tabindex="13" style="width:80%" onKeyPress="return CheckKey(event,7)">
							  	<?php echo $lvhr_lv0020->LV_LinkField('lv009',$lvhr_lv0020->lv009);?>
								
							    </select>							  </td>
							</tr>
							<tr>
								<td  height="20"><?php echo 'KPI';?></td>
							    <td  height="20">
									<table style="width:80%"><tr><td style="width:50%">
										<select name="txtlv299"  id="txtlv299" value="<?php echo $lvhr_lv0020->lv299;?>" tabindex="11"  style="width:100%" onKeyPress="return CheckKey(event,7)">
									 	<?php echo $lvhr_lv0020->LV_LinkField('lv299',$lvhr_lv0020->lv299);?>
									 	</select>
								 	</td>
								  <td>
									<ul id="pop-nav99" lang="pop-nav99" onMouseOver="ChangeName(this,99)" onkeyup="ChangeName(this,99)"> <li class="menupopT">
										<input type="text" autocomplete="off" class="search_img_btn" name="txtlv299_search" id="txtlv299_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv299','ki_lv0003','lv002')" onFocus="LoadPopup(this,'txtlv299','ki_lv0003','lv002')" tabindex="200" >
										<div id="lv_popup99" lang="lv_popup99"> </div>						  
										</li>
									</ul></td></tr></table>
							    </td>
								
							</tr>
							<tr>
							  <td><?php echo $vLangArr[21];?></td>
								<td><input name="txtlv007" type="hidden" id="txtlv007"  value="<?php echo $lvhr_lv0020->lv007;?>" tabindex="11" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" />	
								<div class="file_upload"><input type="file" name="userfile" id="userfile" size="23" readonly="true" tabindex="11"/></div>		</td>
							  
							</tr>

                            <tr>
                              <td  height="20" colspan="4"><div class="lv_gachchia"></div></td>
                            </tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[24];?></td>
								<td  height="20"><input  name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvhr_lv0020->lv010;?>" tabindex="14" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td  height="20"><?php echo $vLangArr[25];?></td>
								<td  height="20"><input name="txtlv011" type="text" id="txtlv011" value="<?php echo $lvhr_lv0020->FormatView($lvhr_lv0020->lv011,2);?>" tabindex="15" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
								<span class="td"> <img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv011);return false;" /></span></td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[26];?></td>
								<td  height="20"><input name="txtlv012" type="text" id="txtlv012" value="<?php echo $lvhr_lv0020->lv012;?>" tabindex="16" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
								<td  height="20"><?php echo $vLangArr[27];?></td>
								<td  height="20">
									<input name="txtlv013" type="text" id="txtlv013"  value="<?php echo $lvhr_lv0020->lv013;?>" tabindex="17" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[28].' (1)';?></td>
								<td  height="20"><input name="txtlv014" type="text" id="txtlv014"  value="<?php echo $lvhr_lv0020->lv014;?>" tabindex="18" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td  height="20"><?php echo $vLangArr[82].' (1)';?></td>
								<td  height="20"><input name="txtlv106"  id="txtlv106" value="<?php echo $lvhr_lv0020->lv106;?>" tabindex="18" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
							<tr>
								<td  height="20"><?php echo $vLangArr[28].' (2)';?></td>
								<td  height="20"><input name="txtlv114" type="text" id="txtlv114"  value="<?php echo $lvhr_lv0020->lv114;?>" tabindex="18" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td  height="20"><?php echo $vLangArr[82].' (2)';?></td>
								<td  height="20"><input name="txtlv116"  id="txtlv116" value="<?php echo $lvhr_lv0020->lv116;?>" tabindex="18" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>								
							<tr>
								<td  height="20"><?php echo $vLangArr[29];?></td>
								<td  height="20"><input  name="txtlv015" type="text" id="txtlv015" value="<?php echo $lvhr_lv0020->FormatView($lvhr_lv0020->lv015,2);?>" tabindex="19" maxlength="20" style="width:80%" onKeyPress="return CheckKey(event,7)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv015);return false;"/>
						      		<span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv015);return false;" /> </span>
														 	
															</td>
								<td  height="20"><?php echo $vLangArr[84];?></td>
								<td  height="20"><input type="checkbox" name="txtlv069" type="text" id="txtlv069" value="1" <?php echo ($lvhr_lv0020->lv069==1)?'checked="checked"':'';?>/></td>
								
							</tr>		
							<tr>
								<td  height="20"><?php echo $vLangArr[30];?></td>
								<td  height="20"><input  name="txtlv016" type="text" id="txtlv016" value="<?php echo $lvhr_lv0020->lv016;?>" tabindex="20" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td  height="20"><?php echo $vLangArr[62];?></td>
								<td  height="20"><input type="text" name="txtlv045" type="text" id="txtlv045" value="<?php echo $lvhr_lv0020->lv045;?>"  tabindex="21"  style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[32];?></td>
							  <td  height="20"><select name="txtlv018" id="txtlv018" tabindex="22">
							  	<option value="0" <?php echo ((int)$lvhr_lv0020->lv018==0)?'selected="selected"':''; ?> >Nữ</option>
								<option value="1" <?php echo ((int)$lvhr_lv0020->lv018==1)?'selected="selected"':''; ?>>Nam</option>
							    </select></td>
								<td height="20"><?php echo $vLangArr[33];?></td>
								<td height="20">
									<select name="txtlv019" id="txtlv019" tabindex="23">
							  	<option value="0" <?php echo ((int)$lvhr_lv0020->lv019==0)?'selected="selected"':''; ?> >Không</option>
								<option value="1" <?php echo ((int)$lvhr_lv0020->lv019==1)?'selected="selected"':''; ?>>Có</option>
							    </select>			</td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[34];?></td>
								<td  height="20"><input  name="txtlv020" type="text" id="txtlv020" value="<?php echo $lvhr_lv0020->lv020;?>" tabindex="24" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td  height="20"><?php echo $vLangArr[35];?></td>
								<td  height="20"><input  name="txtlv021" type="text" id="txtlv021" value="<?php echo ($lvhr_lv0020->lv021==' ')?$lvhr_lv0020->lv021:$lvhr_lv0020->FormatView($lvhr_lv0020->lv021,2);?>" tabindex="25" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								<span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv021);return false;" /></span></td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[57];?></td>
								<td  height="20"><input  name="txtlv043" type="text" id="txtlv043" value="<?php echo $lvhr_lv0020->lv043;?>" tabindex="25" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td  height="20"><?php echo $vLangArr[36];?></td>
								<td  height="20"><table style="width:80%"><tr><td style="width:50%"><select  name="txtlv022" id="txtlv022" value="<?php echo $lvhr_lv0020->lv022;?>" tabindex="26"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
								  <?php echo $lvhr_lv0020->LV_LinkField('lv022',$lvhr_lv0020->lv022);?>
								  </select></td><td>
											  <ul id="pop-nav5" lang="pop-nav5" onMouseOver="ChangeName(this,5)" onkeyup="ChangeName(this,5)"> <li class="menupopT">
												<input type="text" autocomplete="off" class="search_img_btn" name="txtlv022_search" id="txtlv022_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv022','hr_lv0014','lv002')" onFocus="LoadPopup(this,'txtlv022','hr_lv0014','lv002')" tabindex="200" >
												<div id="lv_popup5" lang="lv_popup5"> </div>						  
												</li>
											</ul></td></tr></table>
								</td>
							</tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[31];?></td>
							 <td  height="20"><select name="txtlv017" type="text" id="txtlv017"  tabindex="27"  style="width:80%" onKeyPress="return CheckKey(event,7)"><?php echo $lvhr_lv0020->LV_LinkField('lv017',$lvhr_lv0020->lv017);?></select></td>
							  <td  height="20"><?php echo $vLangArr[37];?></td>
							  <td  height="20"><table style="width:80%"><tr><td style="width:50%"><select name="txtlv023"  id="txtlv023" value="<?php echo $lvhr_lv0020->lv023;?>" tabindex="27"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)">
							  <?php echo $lvhr_lv0020->LV_LinkField('lv023',$lvhr_lv0020->lv023);?>
							  </select></td>
							  <td>
								<ul id="pop-nav6" lang="pop-nav6" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
									<input type="text" autocomplete="off" class="search_img_btn" name="txtlv023_search" id="txtlv023_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv023','hr_lv0016','lv002')" onFocus="LoadPopup(this,'txtlv023','hr_lv0016','lv002')" tabindex="200" >
									<div id="lv_popup6" lang="lv_popup6"> </div>						  
									</li>
								</ul></td></tr></table></td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[26];?></td>
								<td  height="20"><select name="txtlv024"  id="txtlv024" value="<?php echo $lvhr_lv0020->lv024;?>" tabindex="28" style="width:80%" onKeyPress="return CheckKey(event,7)">
											<?php echo $lvhr_lv0020->LV_LinkField('lv024',$lvhr_lv0020->lv024);?>
											</select></td>
								<td height="20"><?php echo $vLangArr[76];?></td>
								<td height="20">
									<input name="txtlv099" type="text" id="txtlv099" value="<?php echo $lvhr_lv0020->lv099;?>" tabindex="29" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[77];?></td>
								<td  height="20"><input name="txtlv102"  id="txtlv102" value="<?php echo $lvhr_lv0020->lv102;?>" tabindex="28" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
											
								<td height="20"><?php echo 'Mã NV chính(Chỉ user HC)';?></td>
								<td height="20">
									<input name="txtlv101" type="text" id="txtlv101" value="<?php echo $lvhr_lv0020->lv101;?>" tabindex="29" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td  height="20" colspan="4"><div class="lv_gachchia"></div></td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[40];?></td>
								<td  height="20"><input name="txtlv026" type="text" id="txtlv026" value="<?php echo $lvhr_lv0020->lv026;?>" tabindex="30" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
								<td  height="20"><?php echo $vLangArr[41];?></td>
								<td  height="20"><select  name="txtlv027" type="text" id="txtlv027" value="<?php echo $lvhr_lv0020->lv027;?>" tabindex="31"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
									<?php echo $lvhr_lv0020->LV_LinkField('lv027',$lvhr_lv0020->lv027);?>
									</select></td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[42];?></td>
								<td  height="20"><table style="width:80%"><tr><td style="width:50%"><select  name="txtlv028"  id="txtlv028" value="<?php echo $lvhr_lv0020->lv028;?>" tabindex="32"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
									  <?php echo $lvhr_lv0020->LV_LinkField('lv028',$lvhr_lv0020->lv028);?></select></td><td>
												  <ul id="pop-nav" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> 			
											   <li class="menupopT">
											  <input type="text" autocomplete="off" class="search_img_btn" name="txtlv028_search" id="txtlv028_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv028','hr_lv0005','lv002')" onFocus="LoadPopup(this,'txtlv028','hr_lv0005','lv002')" tabindex="200" >
											  <div id="lv_popup" lang="lv_popup2"> </div>

										</ul></td></tr></table></td>
							  <td  height="20"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><input name="txtlv008" type="text" id="txtlv008" value="<?php echo $lvhr_lv0020->lv008;?>" tabindex="33" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							</tr>							  
							<tr>  
							  <td  height="20"><?php echo $vLangArr[44];?></td>
							  <td  height="20"><input name="txtlv030" type="text" id="txtlv030" value="<?php echo $lvhr_lv0020->FormatView($lvhr_lv0020->lv030,2);?>" tabindex="34" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
							    <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv030);return false;" /></span></td>
							  <td  height="20"><?php echo $vLangArr[58];?></td>
							  <td  height="20"><input name="txtlv044" type="text" id="txtlv044" value="<?php echo ($lvhr_lv0020->lv044==' ')?$lvhr_lv0020->lv044:$lvhr_lv0020->FormatView($lvhr_lv0020->lv044,2);?>" tabindex="34" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
							    <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv044);return false;" /></span></td>
							</tr>		
							<tr>
                                  <td  height="20" colspan="4"><div class="lv_gachchia"></div></td>
                            </tr>
							<tr>
								<td height="20"><?php echo $vLangArr[45];?></td>
								<td height="20"><table style="width:80%"><tr><td style="width:50%"><select name="txtlv031" id="txtlv031"  tabindex="35"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
										<?php echo $lvhr_lv0020->LV_LinkField('lv031',$lvhr_lv0020->lv031);?></select></td><td>
										<ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
											<input type="text" autocomplete="off" class="search_img_btn" name="txtlv031_search" id="txtlv031_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv031','hr_lv0014','lv002')" onFocus="LoadPopup(this,'txtlv031','hr_lv0014','lv002')" tabindex="200" >
											<div id="lv_popup3" lang="lv_popup3"> </div>						  
											</li>
										</ul></td></tr></table>							
								</td>
								<td  height="20"><?php echo $vLangArr[46];?></td>
								<td  height="20"><table style="width:80%"><tr><td style="width:50%"><select name="txtlv032" type="text" id="txtlv032"  value="<?php echo $lvhr_lv0020->lv032;?>" tabindex="36" maxlength="6" style="width:100%" onkeypress="return CheckKeys(event,7,this)" />
									  <?php echo $lvhr_lv0020->LV_LinkField('lv032',$lvhr_lv0020->lv032);?>
									  </select></td><td>
									  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
										<input type="text" autocomplete="off" class="search_img_btn" name="txtlv032_search" id="txtlv032_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv032','hr_lv0023','lv002')" onFocus="LoadPopup(this,'txtlv032','hr_lv0023','lv002')" tabindex="200" >
										<div id="lv_popup4" lang="lv_popup4"> </div>						  
									</li>
									</ul></td></tr></table>	</td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[48];?></td>
								<td  height="20"><input  name="txtlv034" type="text" id="txtlv034" value="<?php echo $lvhr_lv0020->lv034;?>" tabindex="38" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td  height="20"><?php echo $vLangArr[47];?></td>
								<td  height="20"><input  name="txtlv033" type="text" id="txtlv033" value="<?php echo $lvhr_lv0020->lv033;?>" tabindex="37" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								</tr>							  
							<tr>
								<td  height="20"><?php echo $vLangArr[49];?></td>
								<td  height="20"><input name="txtlv035" type="text" id="txtlv035" value="<?php echo $lvhr_lv0020->lv035;?>" tabindex="39" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
								<td  height="20"><?php echo $vLangArr[50];?></td>
								<td  height="20"><input name="txtlv036" type="text" id="txtlv036" value="<?php echo $lvhr_lv0020->lv036;?>" tabindex="40" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							</tr>		
							<tr>
								<td height="20"><?php echo $vLangArr[51];?></td>
								<td height="20">
									<input name="txtlv037" type="text" id="txtlv037"  value="<?php echo $lvhr_lv0020->lv037;?>" tabindex="41" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
								<td  height="20"><?php echo $vLangArr[52];?></td>
								<td  height="20"><input name="txtlv038" type="text" id="txtlv038"  value="<?php echo $lvhr_lv0020->lv038;?>" tabindex="42" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
								<td height="20"><?php echo $vLangArr[53];?></td>
								<td height="20"><input  name="txtlv039" type="text" id="txtlv039" value="<?php echo $lvhr_lv0020->lv039;?>" tabindex="43" maxlength="20" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td height="20"><?php echo $vLangArr[54];?></td>
								<td height="20">
									<input name="txtlv040" type="text" id="txtlv040"  value="<?php echo $lvhr_lv0020->lv040;?>" tabindex="44" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[55];?></td>
							  <td  height="20"><input name="txtlv041" type="text" id="txtlv041"  value="<?php echo $lvhr_lv0020->lv041;?>" tabindex="45" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td  height="20"><?php echo $vLangArr[56];?></td>
							  <td  height="20"><table style="width:80%"><tr><td style="width:50%"><select name="txtlv042" type="text" id="txtlv042"  value="<?php echo $lvhr_lv0020->lv042;?>" tabindex="36" maxlength="6" style="width:100%" onkeypress="return CheckKeys(event,7,this)" />
							  <option value=""></option>
									  <?php echo $lvhr_lv0020->LV_LinkField('lv042',$lvhr_lv0020->lv042);?>
									  </select></td><td>
									  <ul id="pop-nav42" lang="pop-nav42" onMouseOver="ChangeName(this,42)" onkeyup="ChangeName(this,42)"> <li class="menupopT">
										<input type="text" autocomplete="off" class="search_img_btn" name="txtlv042_search" id="txtlv042_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv042','hr_lv0020','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv042','hr_lv0020','concat(lv001,@! @!,lv002)')" tabindex="200" >
										<div id="lv_popup42" lang="lv_popup42"> </div>						  
									</li>
									</ul></td></tr></table></td>
							</tr>
<tr>
                                  <td  height="20" colspan="4"><div class="lv_gachchia"></div></td>
                            </tr>
							<tr>
								<td height="20"><?php echo $vLangArr[63];?></td>
								<td height="20"><input  name="txtlv060" type="text" id="txtlv060" value="<?php echo $lvhr_lv0020->lv060;?>" tabindex="60" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td height="20"><?php echo $vLangArr[64];?></td>
								<td height="20">
									<input name="txtlv061" type="text" id="txtlv061"  value="<?php echo $lvhr_lv0020->lv061;?>" tabindex="50" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td height="20"><?php echo '';?></td>
								<td height="20">&nbsp;</td>
								<td height="20"><?php echo $vLangArr[70];?></td>
								<td height="20">
									<input name="txtlv067" type="text" id="txtlv067"  value="<?php echo $lvhr_lv0020->lv067;?>" tabindex="60" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td height="20"><?php echo $vLangArr[65];?></td>
								<td height="20">
								<table style="width:80%"><tr><td style="width:50%"><select name="txtlv062" type="text" id="txtlv062"  value="<?php echo $lvhr_lv0020->lv042;?>" tabindex="36" maxlength="6" style="width:100%" onkeypress="return CheckKeys(event,7,this)" />
									<option value=""></option>
											<?php echo $lvhr_lv0020->LV_LinkField('lv062',$lvhr_lv0020->lv062);?>
											</select></td><td>
											<ul id="pop-nav62" lang="pop-nav62" onMouseOver="ChangeName(this,62)" onkeyup="ChangeName(this,62)"> <li class="menupopT">
												<input type="text" autocomplete="off" class="search_img_btn" name="txtlv062_search" id="txtlv062_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv062','cr_lv0008','concat(lv002,@! @!,lv001)')" onFocus="LoadPopup(this,'txtlv062','cr_lv0008','concat(lv002,@! @!,lv001)')" tabindex="200" >
												<div id="lv_popup62" lang="lv_popup62"> </div>						  
											</li>
											</ul></td></tr></table>
							</td>
								<td height="20"><?php echo $vLangArr[66];?></td>
								<td height="20">
									<input name="txtlv063" type="text" id="txtlv063"  value="<?php echo $lvhr_lv0020->lv063;?>" tabindex="60" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td height="20"><?php echo $vLangArr[67];?></td>
								<td height="20">
									
								<select name="txtlv064" id="txtlv064"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
										<option value=""><?php echo 'Cả hai';?></option>
										<option value="SOF" <?php echo ( $lvhr_lv0020->lv064=='SOF')?'selected="selected"':'';?> ><?php echo 'CTY CP MINH PHƯƠNG';?></option>
										<option value="TNHHMP" <?php echo ( $lvhr_lv0020->lv064=='TNHHMP')?'selected="selected"':'';?>><?php echo 'CTY TNHH MINH PHUONG';?></option>
                             	 	</select>	
							</td>
								<td height="20"><?php echo $vLangArr[68];?></td>
								<td height="20">
									<input name="txtlv065" type="text" id="txtlv065"  value="<?php echo $lvhr_lv0020->lv065;?>" tabindex="60" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td height="20"><?php echo $vLangArr[69];?></td>
								<td height="20"><input  name="txtlv066" type="text" id="txtlv066" value="<?php echo $lvhr_lv0020->lv066;?>" tabindex="60" maxlength="30" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td height="20"><?php echo $vLangArr[81];?></td>
								<td height="20"><input  name="txtlv049" type="text" id="txtlv049" value="<?php echo $lvhr_lv0020->lv049;?>" tabindex="60" maxlength="30" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>						
							<tr>
							  <td  height="20" colspan="3"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							  <td  height="20" colspan="3"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="47"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="48"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="49"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
					</form>	

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td>
			</tr>
		</table>
	</h3>
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
	var o=document.frmedit;
		o.txtlv001.focus();
</script>
<script language="javascript" src="../../javascripts/menupopup.js"></script>
	<?php
	if($vFlag==1)
	{
	?>
	<script language="javascript">
	<!--
		Cancel();
	//-->
	</script>
	<?php
	}
	?>
<?php
} else {
	include("../permit.php");
}
?>
</body>
</html>