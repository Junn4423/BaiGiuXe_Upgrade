<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
$vDefaultPath="../../images/employees/";
//require_once("../../clsall/tc_lv0006.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0006.php");
//////////////init object////////////////
$lvtc_lv0006=new tc_lv0006($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$lvtc_lv0006->lv001= $_GET['ID'] ?? '';
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","AD0022.txt",$plang);
$motc_lv0006->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
if($vFlag==1)
{
$lvtc_lv0006->lv002=$_POST['txtlv002'];
$lvtc_lv0006->lv003=$_POST['txtlv003'];
$lvtc_lv0006->lv004=$_POST['txtlv004'];
$lvtc_lv0006->lv005=$_POST['txtlv005'];
$lvtc_lv0006->lv006=$_POST['txtlv006'];
if($_FILES['userfile']['name']=="")
$lvtc_lv0006->lv007=$_POST['txtlv007'];
else
$lvtc_lv0006->lv007=$_FILES['userfile']['name'];
$lvtc_lv0006->lv008=$_POST['txtlv008'];
$lvtc_lv0006->lv009=$_POST['txtlv009'];
$lvtc_lv0006->lv010=$_POST['txtlv010'];
$lvtc_lv0006->lv011=$_POST['txtlv011'];
$lvtc_lv0006->lv012=$_POST['txtlv012'];
$lvtc_lv0006->lv013=$_POST['txtlv013'];
$lvtc_lv0006->lv014=$_POST['txtlv014'];
$lvtc_lv0006->lv015=$_POST['txtlv015'];
$lvtc_lv0006->lv016=$_POST['txtlv016'];
$lvtc_lv0006->lv017=$_POST['txtlv017'];
$lvtc_lv0006->lv018=$_POST['txtlv018'];
$lvtc_lv0006->lv019=$_POST['txtlv019'];
$lvtc_lv0006->lv020=$_POST['txtlv020'];
$lvtc_lv0006->lv021=$_POST['txtlv021'];
$lvtc_lv0006->lv022=$_POST['txtlv022'];
$lvtc_lv0006->lv023=$_POST['txtlv023'];
$lvtc_lv0006->lv024=$_POST['txtlv024'];
$lvtc_lv0006->lv025=$_POST['txtlv025'];
$lvtc_lv0006->lv026=$_POST['txtlv026'];
$lvtc_lv0006->lv027=$_POST['txtlv027'];
$lvtc_lv0006->lv028=$_POST['txtlv028'];
$lvtc_lv0006->lv029=$_POST['txtlv029'];
$lvtc_lv0006->lv030=$_POST['txtlv030'];
$lvtc_lv0006->lv031=$_POST['txtlv031'];
$lvtc_lv0006->lv032=$_POST['txtlv032'];
$lvtc_lv0006->lv033=$_POST['txtlv033'];
$lvtc_lv0006->lv034=$_POST['txtlv034'];
$lvtc_lv0006->lv035=$_POST['txtlv035'];
$lvtc_lv0006->lv036=$_POST['txtlv036'];
$lvtc_lv0006->lv037=$_POST['txtlv037'];
$lvtc_lv0006->lv038=$_POST['txtlv038'];
$lvtc_lv0006->lv039=$_POST['txtlv039'];
$lvtc_lv0006->lv040=$_POST['txtlv040'];
$lvtc_lv0006->lv041=$_POST['txtlv041'];
$lvtc_lv0006->lv042=$_POST['txtlv042'];
$lvtc_lv0006->lv043=$_POST['txtlv043'];
$lvtc_lv0006->lv044=$_POST['txtlv044'];
		
		$vresult=$lvtc_lv0006->LV_Update();
		if($vresult==true) {
			if($_FILES['userfile']['name']!="")
			UploadImg($vDefaultPath,$lvtc_lv0006->lv001, $lvtc_lv0006->lv007);///Call function Upload file
			$vStrMessage=$vLangArr[11];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();		
			$vFlag = 0;
		}
}
$lvtc_lv0006->LV_LoadID($lvtc_lv0006->lv001);
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
	$maxsize = 316960;//Max file size 4MB
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
		var str="0123456789.()-"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					alert("<?php echo $vLangArr[21];?>")	
					return false
				}	
			return true
		}	
		return true
}
	function Refresh()
	{
		var o=document.frmadd;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv001.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
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
		var o=document.frmadd;
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
			alert("<?php echo $vLangArr[59];?>");
			o.txtlv004.focus();
			}	
		else if(!isphone(o.txtlv038.value)){
			alert("<?php echo $vLangArr[59];?>");
			o.txtlv005.focus();
			}	
		else if(!isphone(o.txtlv039.value)){
			alert("<?php echo $vLangArr[59];?>");
			o.txtlv005.focus();
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
if($lvtc_lv0006->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[14];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmadd" method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="760" border="0" align="center" class="table1">
							<tr>
								<td colspan="3" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20"><?php echo $vLangArr[15];?></td>
								<td width="178"  height="20">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvtc_lv0006->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							    <td width="178" rowspan="6"><img name="imgView" border="1" style="border-color:#CCCCCC" title="" alt="Image" width="96px" height="128px" 
								src="<?php echo "../../images/employees/".$lvtc_lv0006->lv001."/".$lvtc_lv0006->lv007; ?>" /></td>
							</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvtc_lv0006->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><input  name="txtlv003" type="text" id="txtlv003" value="<?php echo $lvtc_lv0006->lv003;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
				  <td  height="20"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvtc_lv0006->lv004;?>" tabindex="8" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvtc_lv0006->lv005;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvtc_lv0006->lv006;?>" tabindex="10" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
								</tr>	
<tr>
								<td width="166"  height="20"><?php echo $vLangArr[21];?></td>
								<td width="178"  height="20">
									<input name="txtlv007" type="text" id="txtlv007"  value="<?php echo $lvtc_lv0006->lv007;?>" tabindex="11" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td> <td><input type="file" name="userfile" id="userfile" size="23" readonly="true"/></td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><select name="txtlv008" type="text" id="txtlv008"  value="<?php echo $lvtc_lv0006->lv008;?>" tabindex="12"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvtc_lv0006->LV_LinkField('lv008',$lvtc_lv0006->lv008);?>
							  </select>							  </td>
							  <td>&nbsp;</td>
							</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20"><select name="txtlv009" id="txtlv009" tabindex="13" style="width:80%" onKeyPress="return CheckKey(event,7)">
							  	<?php echo $lvtc_lv0006->LV_LinkField('lv009',$lvtc_lv0006->lv009);?>
								
							    </select>							  </td>
							  <td>&nbsp;</td>
							</tr>
                            <tr>
                              <td  height="20" colspan="3"><hr></td>
                            </tr>
                          <tr>
							  <td  height="20"><?php echo $vLangArr[24];?></td>
				  <td  height="20"><input  name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvtc_lv0006->lv010;?>" tabindex="14" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td>&nbsp;</td>
                          </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[25];?></td>
							  <td  height="20"><input name="txtlv011" type="text" id="txtlv011" value="<?php echo $lvtc_lv0006->FormatView($lvtc_lv0006->lv011,2);?>" tabindex="15" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"> <img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv011);return false;" /></span></td>
							  <td>&nbsp;</td>
							</tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[26];?></td>
							  <td  height="20"><input name="txtlv012" type="text" id="txtlv012" value="<?php echo $lvtc_lv0006->lv012;?>" tabindex="16" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  <td>&nbsp;</td>
							  </tr>		
<tr>
								<td width="166"  height="20"><?php echo $vLangArr[27];?></td>
								<td width="178"  height="20">
									<input name="txtlv013" type="text" id="txtlv013"  value="<?php echo $lvtc_lv0006->lv013;?>" tabindex="17" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							    <td width="178">&nbsp;</td>
</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[28];?></td>
							  <td  height="20"><input name="txtlv014" type="text" id="txtlv014"  value="<?php echo $lvtc_lv0006->lv014;?>" tabindex="18" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td>&nbsp;</td>
							</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[29];?></td>
							  <td  height="20"><input  name="txtlv015" type="text" id="txtlv015" value="<?php echo $lvtc_lv0006->FormatView($lvtc_lv0006->lv015,2);?>" tabindex="19" maxlength="6" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv015);return false;" /></span></td>
							  <td>&nbsp;</td>
							</tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[30];?></td>
				  <td  height="20"><input  name="txtlv016" type="text" id="txtlv016" value="<?php echo $lvtc_lv0006->lv016;?>" tabindex="20" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td>&nbsp;</td>
</tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[31];?></td>
							  <td  height="20"><select name="txtlv017" type="text" id="txtlv017"  tabindex="21"  style="width:80%" onKeyPress="return CheckKey(event,7)"><?php echo $lvtc_lv0006->LV_LinkField('lv017',$lvtc_lv0006->lv017);?></select></td>
							  <td>&nbsp;</td>
							</tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[32];?></td>
							  <td  height="20"><select name="txtlv018" id="txtlv018" tabindex="22">
							  	<option value="0" <?php echo ((int)$lvtc_lv0006->lv018==0)?'selected="selected"':''; ?> >0</option>
								<option value="1" <?php echo ((int)$lvtc_lv0006->lv018==1)?'selected="selected"':''; ?>>1</option>
							    </select></td>
							  <td>&nbsp;</td>
							  </tr>		
<tr>
								<td width="166"  height="20"><?php echo $vLangArr[33];?></td>
								<td width="178"  height="20">
									<select name="txtlv019" id="txtlv019" tabindex="23">
							  	<option value="0" <?php echo ((int)$lvtc_lv0006->lv019==0)?'selected="selected"':''; ?> >0</option>
								<option value="1" <?php echo ((int)$lvtc_lv0006->lv019==1)?'selected="selected"':''; ?>>1</option>
							    </select>			</td>
							    <td width="178">&nbsp;</td>
</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[34];?></td>
							  <td  height="20"><input  name="txtlv020" type="text" id="txtlv020" value="<?php echo $lvtc_lv0006->lv020;?>" tabindex="24" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td>&nbsp;</td>
							</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[35];?></td>
							  <td  height="20"><input  name="txtlv021" type="text" id="txtlv021" value="<?php echo $lvtc_lv0006->FormatView($lvtc_lv0006->lv021,2);?>" tabindex="25" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv021);return false;" /></span></td>
							  <td>&nbsp;</td>
							</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[57];?></td>
							  <td  height="20"><input  name="txtlv043" type="text" id="txtlv043" value="<?php echo $lvtc_lv0006->lv043;?>" tabindex="25" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td>&nbsp;</td>
							</tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[36];?></td>
				  <td  height="20"><select  name="txtlv022" id="txtlv022" value="<?php echo $lvtc_lv0006->lv022;?>" tabindex="26"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
				  <?php echo $lvtc_lv0006->LV_LinkField('lv022',$lvtc_lv0006->lv022);?>
				  </select><br><table><tr><td></td><td>
							  <ul id="pop-nav5" lang="pop-nav5" onMouseOver="ChangeName(this,5)" onkeyup="ChangeName(this,5)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch2" id="txtlvsearch2" style="width:200px" onKeyUp="LoadPopup(this,'txtlv022','hr_lv0014','lv002')" onFocus="LoadPopup(this,'txtlv022','hr_lv0014','lv002')" tabindex="200" >
							    <div id="lv_popup5" lang="lv_popup5"> </div>						  
						</li>
					</ul></td></tr></table></td>
							  <td>&nbsp;</td>
</tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[37];?></td>
							  <td  height="20"><select name="txtlv023"  id="txtlv023" value="<?php echo $lvtc_lv0006->lv023;?>" tabindex="27"  style="width:80%" onkeypress="return CheckKey(event,7)">
                                <?php echo $lvtc_lv0006->LV_LinkField('lv023',$lvtc_lv0006->lv023);?>
                              </select><br><table><tr><td></td><td>
							  <ul id="pop-nav6" lang="pop-nav6" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch2" id="txtlvsearch2" style="width:200px" onKeyUp="LoadPopup(this,'txtlv023','hr_lv0016','lv002')" onFocus="LoadPopup(this,'txtlv023','hr_lv0016','lv002')" tabindex="200" >
							    <div id="lv_popup6" lang="lv_popup6"> </div>						  
						</li>
					</ul></td></tr></table></td>
							  <td>&nbsp;</td>
							</tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[38];?></td>
							  <td  height="20"><select name="txtlv024"  id="txtlv024" value="<?php echo $lvtc_lv0006->lv024;?>" tabindex="28" style="width:80%" onKeyPress="return CheckKey(event,7)">
							  <?php echo $lvtc_lv0006->LV_LinkField('lv024',$lvtc_lv0006->lv024);?>
							  </select></td>
							  <td>&nbsp;</td>
							  </tr>		
<tr>
								<td width="166"  height="20"><?php echo $vLangArr[39];?></td>
								<td width="178"  height="20">
									<select name="txtlv025"  id="txtlv025"  value="<?php echo $lvtc_lv0006->lv025;?>" tabindex="29" style="width:80%" onKeyPress="return CheckKey(event,7)" /><?php echo $lvtc_lv0006->LV_LinkField('lv025',$lvtc_lv0006->lv025);?>
									</select>			</td>
							    <td width="178">&nbsp;</td>
</tr>
							<tr>
							  <td  height="20" colspan="3"><hr></td>
						  </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[40];?></td>
							  <td  height="20"><select name="txtlv026"  id="txtlv026"  value="<?php echo $lvtc_lv0006->lv026;?>" tabindex="30"  style="width:80%" onKeyPress="return CheckKey(event,7)"/><?php echo $lvtc_lv0006->LV_LinkField('lv026',$lvtc_lv0006->lv026);?></select><br><table><tr><td></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
						  <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch" id="txtlvsearch" style="width:200px" onKeyUp="LoadPopup(this,'txtlv026','hr_lv0007','lv002')" onFocus="LoadPopup(this,'txtlv026','hr_lv0007','lv002')" tabindex="200" >
						  <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
							  <td>&nbsp;</td>
							</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[41];?></td>
							  <td  height="20"><select  name="txtlv027" type="text" id="txtlv027" value="<?php echo $lvtc_lv0006->lv027;?>" tabindex="31"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvtc_lv0006->LV_LinkField('lv027',$lvtc_lv0006->lv027);?>
							  </select></td>
							  <td>&nbsp;</td>
							</tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[42];?></td>
				  <td  height="20"><select  name="txtlv028"  id="txtlv028" value="<?php echo $lvtc_lv0006->lv028;?>" tabindex="32"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
				  <?php echo $lvtc_lv0006->LV_LinkField('lv028',$lvtc_lv0006->lv028);?></select><br><table><tr><td></td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> 			
						   <li class="menupopT">
						  <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch" id="txtlvsearch" style="width:200px" onKeyUp="LoadPopup(this,'txtlv028','hr_lv0005','lv002')"  onFocus="LoadPopup(this,'txtlv028','hr_lv0005','lv002')"  tabindex="200" >
						  <div id="lv_popup2" lang="lv_popup2"> </div>
					</ul></td></tr></table></td>
							  <td>&nbsp;</td>
</tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[43];?></td>
							  <td  height="20"><select name="txtlv029"  id="txtlv029" value="<?php echo $lvtc_lv0006->lv029;?>" tabindex="33"  style="width:80%" onKeyPress="return CheckKey(event,7)"><?php echo $lvtc_lv0006->LV_LinkField('lv029',$lvtc_lv0006->lv029);?></select></td>
							  <td>&nbsp;</td>
							</tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[44];?></td>
							  <td  height="20"><input name="txtlv030" type="text" id="txtlv030" value="<?php echo $lvtc_lv0006->FormatView($lvtc_lv0006->lv030,2);?>" tabindex="34" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
							    <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv030);return false;" /></span></td>
							  <td>&nbsp;</td>
							  </tr>		
							   <tr>
							  <td  height="20"><?php echo $vLangArr[58];?></td>
							  <td  height="20"><input name="txtlv044" type="text" id="txtlv044" value="<?php echo $lvtc_lv0006->FormatView($lvtc_lv0006->lv044,2);?>" tabindex="34" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
							    <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv044);return false;" /></span></td>
							  <td>&nbsp;</td>
							  </tr>	
                                <tr>
                                  <td  height="20" colspan="3"><hr></td>
                                </tr>
                           <tr>
								<td width="166"  height="20"><?php echo $vLangArr[45];?></td>
								<td width="178"  height="20"><select name="txtlv031" id="txtlv031"  tabindex="35" maxlength="6" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								<?php echo $lvtc_lv0006->LV_LinkField('lv031',$lvtc_lv0006->lv031);?></select><br><table><tr><td></td><td>
							  <ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
						  <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch" id="txtlvsearch" style="width:200px" onKeyUp="LoadPopup(this,'txtlv031','hr_lv0014','lv002')" onFocus="LoadPopup(this,'txtlv031','hr_lv0014','lv002')" tabindex="200" >
						  <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table>							</td>
							    <td width="178">&nbsp;</td>
                          </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[46];?></td>
							  <td  height="20"><select name="txtlv032" type="text" id="txtlv032"  value="<?php echo $lvtc_lv0006->lv032;?>" tabindex="36" maxlength="6" style="width:80%" onkeypress="return CheckKey(event,7)" />
							  <?php echo $lvtc_lv0006->LV_LinkField('lv032',$lvtc_lv0006->lv032);?>
						      </select><br><table><tr><td></td><td>
							  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
						  <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch" id="txtlvsearch" style="width:200px" onKeyUp="LoadPopup(this,'txtlv032','hr_lv0023','lv002')" onFocus="LoadPopup(this,'txtlv032','hr_lv0023','lv002')" tabindex="200" >
						  <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table></td>
							  <td>&nbsp;</td>
							</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[47];?></td>
							  <td  height="20"><input  name="txtlv033" type="text" id="txtlv033" value="<?php echo $lvtc_lv0006->lv033;?>" tabindex="37" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td>&nbsp;</td>
							</tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[48];?></td>
				  <td  height="20"><input  name="txtlv034" type="text" id="txtlv034" value="<?php echo $lvtc_lv0006->lv034;?>" tabindex="38" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td>&nbsp;</td>
</tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[49];?></td>
							  <td  height="20"><input name="txtlv035" type="text" id="txtlv035" value="<?php echo $lvtc_lv0006->lv035;?>" tabindex="39" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  <td>&nbsp;</td>
							</tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[50];?></td>
							  <td  height="20"><input name="txtlv036" type="text" id="txtlv036" value="<?php echo $lvtc_lv0006->lv036;?>" tabindex="40" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  <td>&nbsp;</td>
							  </tr>		
<tr>
								<td width="166"  height="20"><?php echo $vLangArr[51];?></td>
								<td width="178"  height="20">
									<input name="txtlv037" type="text" id="txtlv037"  value="<?php echo $lvtc_lv0006->lv037;?>" tabindex="41" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							    <td width="178">&nbsp;</td>
</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[52];?></td>
							  <td  height="20"><input name="txtlv038" type="text" id="txtlv038"  value="<?php echo $lvtc_lv0006->lv038;?>" tabindex="42" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td>&nbsp;</td>
							</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[53];?></td>
							  <td  height="20"><input  name="txtlv039" type="text" id="txtlv039" value="<?php echo $lvtc_lv0006->lv039;?>" tabindex="43" maxlength="20" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td>&nbsp;</td>
							</tr>
<tr>
								<td width="166"  height="20"><?php echo $vLangArr[54];?></td>
								<td width="178"  height="20">
									<input name="txtlv040" type="text" id="txtlv040"  value="<?php echo $lvtc_lv0006->lv040;?>" tabindex="44" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							    <td width="178">&nbsp;</td>
</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[55];?></td>
							  <td  height="20"><input name="txtlv041" type="text" id="txtlv041"  value="<?php echo $lvtc_lv0006->lv041;?>" tabindex="45" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td>&nbsp;</td>
							</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[56];?></td>
							  <td  height="20"><input  name="txtlv042" type="text" id="txtlv042" value="<?php echo $lvtc_lv0006->lv042;?>" tabindex="46" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td>&nbsp;</td>
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

				
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
	var o=document.frmadd;
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