<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
$vDefaultPath="../../images/employees/";
//require_once("../../clsall/ts_lv1001.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv1001.php");
require_once("../../clsall/sp_lv0009.php");
require_once("../../clsall/ts_lv0003.php");
//////////////init object////////////////
$lvts_lv1001=new ts_lv1001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts1001');
$lvsp_lv0009=new sp_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sp0007');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if(isset($_GET['ajax']))
{
	$vcusid=$_GET['cusid'];
	$mots_lv0003=new ts_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0003');
	$mots_lv0003->LV_LoadID($vcusid);
	echo '[CHECK]';
	echo $mots_lv0003->lv002;
	echo '[ENDCHECK]';
	echo '[TCHECK]';
	echo $mots_lv0003->lv019;
	echo '[ENDTCHECK]';
	echo '[SCHECK]';
	echo $mots_lv0003->lv020;
	echo '[ENDSCHECK]';
	exit;
}	
function UploadImg($folder_name, $fname){
	$maxsize = 3169600;//Max file size 300KMB
	$path = "../../images/uploads/";
	$arrName = explode(".", $fname);
	$fname = $arrName[0];///Get name without extention of file
	create_folder($path, $folder_name);
	$path = $path.$folder_name."/";
	$result = upload_file($fpath, $fname, $path, $maxsize);
	if($result==1){
		$message = "Image uploaded successfully!";
		//$vFlag = 2;//Upload successful.
		//$fpath = "";
		//$fname = "";
	}
	if($result==2)
		$message = "Incorrect file type!";
	if($result==3 || $result==4)
		$message = "Image size is very small or big!";
	if($result==5 || $result==6)
		$message = "Error in uploading file, please try again!";	
}
$lvts_lv1001->lv001=$_GET['ExtChildID'];
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SP0047.txt",$plang);
$mots_lv1001->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
if($vFlag==1)
{
$lvts_lv1001->lv002=$_POST['txtlv002'];
$lvts_lv1001->lv003=$_POST['txtlv003'];
$lvts_lv1001->lv004=$_POST['txtlv004'];
$lvts_lv1001->lv005=$_POST['txtlv005'];
$lvts_lv1001->lv006=$_POST['txtlv006'];
$lvts_lv1001->lv007=$_POST['txtlv007'];
$lvts_lv1001->lv008=$_POST['txtlv008'];
$lvts_lv1001->lv009=$_POST['txtlv009'];
$lvts_lv1001->lv010=$_POST['txtlv010'];
$lvts_lv1001->lv011=$_POST['txtlv011'];
if($lvts_lv1001->lv011=="" || $lvts_lv1001->lv011==NULL) $lvts_lv1001->lv011=$lvts_lv1001->DateCurrent;
$lvts_lv1001->lv012=$_POST['txtlv012'];
$lvts_lv1001->lv013=$_POST['txtlv013'];
$lvts_lv1001->lv017=$_POST['txtlv017'];
$lvts_lv1001->lv018=$_POST['txtlv018'];
$lvts_lv1001->lv019=$_POST['txtlv019'];
if($_FILES['userfile']['name']=="" || $_FILES['userfile']['name']==NULL)
			$lvts_lv1001->lv018=$_POST['txtlv018'];
		else
		{
			$lvts_lv1001->lv018="qt_".time().exten($_FILES['userfile']['name']);
		}
		$lvsp_lv0009->LV_LoadActiveID( $_GET['ID']);
		if($lvsp_lv0009->lv001=="" || $lvsp_lv0009->lv001=NULL)
		{
				$vMessage='Quyết toán không cho phép nhập!';
				$vFlag = 0;
		}
		else
		{
		$vresult=$lvts_lv1001->LV_Update();
		if($vresult==true) {
			if($_FILES['userfile']['name']!="" && $_FILES['userfile']['name']!=null)		UploadImg(getInfor($_SESSION['ERPSOFV2RUserID'],2), $lvts_lv1001->lv018);///Call function Upload file
			$vStrMessage=$vLangArr[11];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();		
			$vFlag = 0;
		}
		}
}

$lvts_lv1001->LV_LoadID($lvts_lv1001->lv001);
$lvts_lv1001->lv029ex='';
if($lvts_lv1001->GetApr()==0)  $lvts_lv1001->lv029ex=$lvts_lv1001->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');		
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
		o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc=<?php echo $_GET['childdetailfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo  $_GET['ID'] ?? '';?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,5,0);?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmedit;
		if(parseFloat(o.txtlv003.value)<=0)
	{
			alert("Tiền phải lớn hơn 0");
			o.txtlv003.focus();
	}	
	else if(o.txtlv007.value=="")
	{
		alert("Phải nhập tên khách hàng");
		o.txtlv007.focus();
			
	}
	else if(o.txtlv012.value=="")
	{
		alert("Phải nhập mã sản phẩm");
		o.txtlv012.focus();
			
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
if($lvts_lv1001->GetEdit()>0)
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
					<form action="#" name="frmedit" id="frmedit" method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="4" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="150"  height="20"><?php echo $vLangArr[15];?></td>
								<td width="300"  height="20">
								<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvts_lv1001->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/><input name="txtlv002" type="hidden" id="txtlv002"  value="<?php echo $lvts_lv1001->lv002;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
						<tr>
								
								<td  height="20"><?php echo $vLangArr[16];?></td>
								<td  height="20"><input  name="txtlv003" type="text" id="txtlv003" value="<?php echo (float)$lvts_lv1001->lv003;?>" tabindex="8" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</TR>
							<TR>
								<td  height="20"><?php echo $vLangArr[19];?></td>
								<td  height="20"><table style="width:80%"><tr><td style="width:50%"><input  name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvts_lv1001->lv003;?>" tabindex="9" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)" onblur="changecustomer_change(this.value)"/></td><td>
											  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
												<input type="text" autocomplete="off" class="search_img_btn" name="txtlv006_search" id="txtlv006_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv006','ts_lv0003','lv002')" onFocus="LoadPopup(this,'txtlv006','ts_lv0003','lv002')" tabindex="200" >
												<div id="lv_popup" lang="lv_popup1"> </div>						  
												</li>
											</ul></td></tr></table></td>
							
							<td  height="20"><?php echo $vLangArr[20];?></td>
								<td  height="20"><input name="txtlv007" type="text" id="txtlv007" value="<?php echo $lvts_lv1001->lv007;?>" tabindex="10" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)">
								</td>
							</tr>	
							<tr>
								<td  height="20"><?php echo $vLangArr[25];?></td>
								<td  height="20">
								<table style="width:80%"><tr><td style="width:50%"><input type="textbox" name="txtlv012" id="txtlv012" tabindex="10" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"  value="<?php echo $lvts_lv1001->lv012;?>"/></td><td>
											  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
												<input type="text" autocomplete="off" class="search_img_btn" name="txtlv012_search" id="txtlv012_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv012','sl_lv0007','concat(lv002,@! @!,lv001)')" onFocus="LoadPopup(this,'txtlv012','sl_lv0007','concat(lv002,@! @!,lv001)')" tabindex="200" >
												<div id="lv_popup2" lang="lv_popup2"> </div>						  
												</li>
											</ul></td></tr></table>
								<td  height="20"><?php echo $vLangArr[26];?></td>
								<td  height="20" ><textarea  name="txtlv013" type="text" id="txtlv013" tabindex="10" maxlength="255" style="width:80%"><?php echo $lvts_lv1001->lv013?></textarea></td>												
							</tr>
							<tr>
							<td width="150"   height="20"><?php echo $vLangArr[30];?></td>
								<td width="300"  height="20"><select name="txtlv017" id="txtlv017" tabindex="11" style="width:80%" onKeyPress="return CheckKey(event,7)">
									<?php echo $lvts_lv1001->LV_LinkField('lv017',$lvts_lv1001->lv017);?>								
							    </select></td>
								<td width="150"   height="20"><?php echo $vLangArr[31];?></td>
								<td width="300"  height="20"><input type="file" Name="userfile" id="userfile" tabindex="9"/><input  name="txtlv018" type="hidden" id="txtlv018" value="<?php echo ($lvts_lv1001->lv018!="")?$lvts_lv1001->lv018:"qt_".time().".jpg";?>" tabindex="14" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)"/> </td>
							</tr>
							<tr>
							<td width="150"   height="20"><?php echo $vLangArr[32];?></td>
								<td width="300"  height="20"><select name="txtlv019" id="txtlv019" tabindex="13" style="width:80%" onKeyPress="return CheckKey(event,7)">
									<?php echo $lvts_lv1001->LV_LinkField('lv019',$lvts_lv1001->lv019);?>								
							    </select></td>
								<td width="150"   height="20"></td>
								<td width="300"  height="20"></td>
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
<script language="javascript"> /*var o=document.frmedit; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);*/
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