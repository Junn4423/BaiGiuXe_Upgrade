<?php
session_start();
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

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","AD0022.txt",$plang);

$curPage=(int)$_GET['curPg'];	
$vFlag=(int)$_GET['txtFlag'];
$vlv001=$_GET['lv001'];
$vlv002=$_GET['lv002'];
$vlv003=$_GET['lv003'];
$vlv004=$_GET['lv004'];
$vlv005=$_GET['lv005'];
$vlv006=$_GET['lv006'];
$vlv007=$_GET['lv007'];
$vlv008=$_GET['lv008'];
$vlv009=$_GET['lv009'];
$vlv010=$_GET['lv010'];
$vlv011=$_GET['lv011'];
$vlv012=$_GET['lv012'];
$vlv013=$_GET['lv013'];
$vlv014=$_GET['lv014'];
$vlv015=$_GET['lv015'];
$vlv016=$_GET['lv016'];
$vlv017=$_GET['lv017'];
$vlv018=$_GET['lv018'];
$vlv019=$_GET['lv019'];
$vlv020=$_GET['lv020'];
$vlv021=$_GET['lv021'];
$vlv022=$_GET['lv022'];
$vlv023=$_GET['lv023'];
$vlv024=$_GET['lv024'];
$vlv025=$_GET['lv025'];
$vlv026=$_GET['lv026'];
$vlv027=$_GET['lv027'];
$vlv028=$_GET['lv028'];
$vlv029=$_GET['lv029'];
$vlv030=$_GET['lv030'];
$vlv031=$_GET['lv031'];
$vlv032=$_GET['lv032'];
$vlv033=$_GET['lv033'];
$vlv034=$_GET['lv034'];
$vlv035=$_GET['lv035'];
$vlv036=$_GET['lv036'];
$vlv037=$_GET['lv037'];
$vlv038=$_GET['lv038'];
$vlv039=$_GET['lv039'];
$vlv040=$_GET['lv040'];
$vlv041=$_GET['lv041'];
$vlv042=$_GET['lv042'];
$vlv043=$_GET['lv043'];
$vlv044=$_GET['lv044'];
$vlv060=$_GET['lv060'];
$vlv061=$_GET['lv061'];
$vlv062=$_GET['lv062'];
$vlv063=$_GET['lv063'];
$vlv064=$_GET['lv064'];
$vlv065=$_GET['lv065'];
$vlv066=$_GET['lv066'];
$vlv067=$_GET['lv067'];
$vlv106=$_GET['lv106'];
$vlv069=$_GET['lv069'];
$vlv070=$_GET['lv070'];
$vlv071=$_GET['lv071'];
$vlv299=$_GET['lv299'];
$vlv029ex='';
if($lvhr_lv0020->GetApr()==0)  $vlv029ex=$lvhr_lv0020->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script>

</head>
<script language="javascript">
<!--
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
		var o=document.frmfilter;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv001.focus();
	}
	function Cancel(){	var o=window.parent.document.getElementById('frmchoose');		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";		o.submit();	}
	function Save()
	{
		var o=window.parent.document.getElementById('frmchoose');
		o.txtFlag.value="2";
		o.txtlv001.value=document.frmfilter.txtlv001.value;
		o.txtlv002.value=document.frmfilter.txtlv002.value;		
		o.txtlv299.value=document.frmfilter.txtlv299.value;		
		//o.txtlv004.value=document.frmfilter.txtlv004.value;		
		o.txtlv005.value=document.frmfilter.txtlv005.value;		
		o.txtlv006.value=document.frmfilter.txtlv006.value;
		o.txtlv007.value=document.frmfilter.txtlv007.value;
		o.txtlv008.value=document.frmfilter.txtlv008.value;
		o.txtlv009.value=getChecked(document.frmfilter.chklv009.value,'chklv009');
		o.txtlv010.value=document.frmfilter.txtlv010.value;
		o.txtlv011.value=document.frmfilter.txtlv011.value;
		o.txtlv012.value=document.frmfilter.txtlv012.value;
		o.txtlv013.value=document.frmfilter.txtlv013.value;
		o.txtlv014.value=document.frmfilter.txtlv014.value;
		o.txtlv015.value=document.frmfilter.txtlv015.value;
		o.txtlv016.value=document.frmfilter.txtlv016.value;
		o.txtlv017.value=document.frmfilter.txtlv017.value;
		o.txtlv018.value=document.frmfilter.txtlv018.value;
		o.txtlv019.value=document.frmfilter.txtlv019.value;
		o.txtlv020.value=document.frmfilter.txtlv020.value;
		o.txtlv021.value=document.frmfilter.txtlv021.value;
		o.txtlv022.value=document.frmfilter.txtlv022.value;
		o.txtlv023.value=document.frmfilter.txtlv023.value;
		o.txtlv024.value=document.frmfilter.txtlv024.value;
		//o.txtlv025.value=document.frmfilter.txtlv025.value;
		o.txtlv026.value=document.frmfilter.txtlv026.value;
		o.txtlv027.value=document.frmfilter.txtlv027.value;
		o.txtlv028.value=document.frmfilter.txtlv028.value;
		o.txtlv029.value=getChecked(document.frmfilter.chklv029.value,'chklv029');
		o.txtlv030.value=document.frmfilter.txtlv030.value;
		o.txtlv031.value=document.frmfilter.txtlv031.value;
		o.txtlv032.value=document.frmfilter.txtlv032.value;
		o.txtlv033.value=document.frmfilter.txtlv033.value;
		o.txtlv034.value=document.frmfilter.txtlv034.value;
		o.txtlv035.value=document.frmfilter.txtlv035.value;
		o.txtlv036.value=document.frmfilter.txtlv036.value;
		o.txtlv037.value=document.frmfilter.txtlv037.value;
		o.txtlv038.value=document.frmfilter.txtlv038.value;
		o.txtlv039.value=document.frmfilter.txtlv039.value;
		o.txtlv040.value=document.frmfilter.txtlv040.value;
		o.txtlv041.value=document.frmfilter.txtlv041.value;
		o.txtlv042.value=document.frmfilter.txtlv042.value;
		o.txtlv043.value=document.frmfilter.txtlv043.value;	
		o.txtlv044.value=document.frmfilter.txtlv044.value;	
		o.txtlv045.value=document.frmfilter.txtlv045.value;	
		o.txtlv060.value=document.frmfilter.txtlv060.value;	
		o.txtlv061.value=document.frmfilter.txtlv061.value;	
		o.txtlv062.value=document.frmfilter.txtlv062.value;	
		o.txtlv063.value=document.frmfilter.txtlv063.value;	
		o.txtlv064.value=document.frmfilter.txtlv064.value;	
		o.txtlv065.value=document.frmfilter.txtlv065.value;	
		o.txtlv066.value=document.frmfilter.txtlv066.value;
		o.txtlv106.value=document.frmfilter.txtlv106.value;		
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
		o.submit();
	}

-->
</script>
<?php
if(1==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[1];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmfilter" method="post">
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
								<td width="150"><?php echo $vLangArr[15];?></td>
								<td width="300">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $vlv001;?>" tabindex="5" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
								<td width="150"><?php echo $vLangArr[16];?></td>
								<td width="300"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $vlv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<!--
							<tr>
							  <td><?php echo $vLangArr[17];?></td>
							  <td><input  name="txtlv003" type="text" id="txtlv003" value="<?php echo $vlv003;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td><?php echo $vLangArr[18];?></td>
							  <td><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $vlv004;?>" tabindex="8" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  </tr>							  -->
							<tr>
							  <td><?php echo $vLangArr[19];?></td>
							  <td><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $vlv005;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  <td><?php echo $vLangArr[20];?></td>
							  <td><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $vlv006;?>" tabindex="10" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							</tr>	
							<tr>
								<td><?php echo $vLangArr[43];?></td>
								<td><input type="hidden" name="txtlv029"  id="txtlv029" value="<?php echo $vlv029;?>" tabindex="11"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								<div style="width:250px;height:150px;position:relative;overflow: auto;top:0px;">
									<?php echo $lvhr_lv0020->GetBuilCheckListDept($vlv029,'chklv029',10,'hr_lv0002','lv003',$vlv029ex);?>
								</div>
								</td>
								<td><?php echo $vLangArr[23];?></td>
								<td><input type="hidden" name="txtlv009" id="txtlv009" tabindex="13" style="width:80%" onKeyPress="return CheckKey(event,7)" />
							  	<div style="width:250px;height:150px;position:relative;overflow: auto;top:0px;"><?php echo $lvhr_lv0020->CheckListFilter($vlv009,'chklv009',10,'hr_lv0022','lv002');?></div></td>
								
							</tr>
							<tr>
								<td  height="20"><?php echo 'KPI';?></td>
							    <td  height="20">
									<table style="width:80%"><tr><td style="width:50%">
										<select name="txtlv299"  id="txtlv299" value="<?php echo $lvhr_lv0020->lv299;?>" tabindex="11"  style="width:100%" onKeyPress="return CheckKey(event,7)">
									 	<?php echo $lvhr_lv0020->LV_LinkField('lv299',$vlv299);?>
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
								<td><?php echo $vLangArr[22];?></td>
								<td  height="20"><input name="txtlv008" type="text" id="txtlv008" value="<?php echo $vlv008;?>" tabindex="12" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
								<td><?php echo $vLangArr[21];?></td>
								<td>
									<input name="txtlv007" type="text" id="txtlv007"  value="<?php echo $vlv007;?>" tabindex="14" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							 </tr>

                            <tr>
                              <td colspan="4"><div class="lv_gachchia"></div></td>
                            </tr>
							<tr>
								<td><?php echo $vLangArr[24];?></td>
								<td><input  name="txtlv010" type="text" id="txtlv010" value="<?php echo $vlv010;?>" tabindex="14" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td><?php echo $vLangArr[25];?></td>
								<td><input name="txtlv011" type="text" id="txtlv011" value="<?php echo $lvhr_lv0020->FormatView($vlv011,2);?>" tabindex="15" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
									<span class="td"> <img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv011);return false;" /></span></td>
							</tr>
							<tr>
								<td><?php echo $vLangArr[26];?></td>
								<td><input name="txtlv012" type="text" id="txtlv012" value="<?php echo $vlv012;?>" tabindex="16" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
								<td><?php echo $vLangArr[27];?></td>
								<td>
									<input name="txtlv013" type="text" id="txtlv013"  value="<?php echo $vlv013;?>" tabindex="17" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
							  <td><?php echo $vLangArr[28];?></td>
							  <td><input name="txtlv014" type="text" id="txtlv014"  value="<?php echo $vlv014;?>" tabindex="18" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td><?php echo $vLangArr[29];?></td>
							  <td><input  name="txtlv015" type="text" id="txtlv015" value="<?php echo $lvhr_lv0020->FormatView($vlv015,2);?>" tabindex="19" maxlength="6" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv015);return false;" /></span></td>
							</tr>
							<tr>
								<td  height="20"><?php echo 'Chi nhánh ngân hàng';?></td>
								<td  height="20"><input name="txtlv106"  id="txtlv106" value="<?php echo $vlv106;?>" tabindex="18" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td  height="20"></td>
								<td  height="20"></td>
							</tr>
							<tr>
							  <td><?php echo $vLangArr[30];?></td>
							  <td><input  name="txtlv016" type="text" id="txtlv016" value="<?php echo $vlv016;?>" tabindex="20" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td  height="20"><?php echo $vLangArr[62];?></td>
							  <td  height="20"><input type="text" name="txtlv045" type="text" id="txtlv045" value="<?php echo $vlv045;?>"  tabindex="21"  style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  </tr>							  
							<tr>
							  <td><?php echo $vLangArr[31];?></td>
							  <td><select name="txtlv017" type="text" id="txtlv017"  tabindex="21"  style="width:80%" onKeyPress="return CheckKey(event,7)">
							  <option value=""></option>
							  <?php echo $lvhr_lv0020->LV_LinkField('lv017',$vlv017);?></select></td>
							  <td><?php echo $vLangArr[32];?></td>
							  <td><select name="txtlv018" id="txtlv018" tabindex="22">
                              	<option value=""   >...</option>
							  	<option value="0" <?php echo ($vlv018=='0')?'selected="selected"':''; ?> >0</option>
								<option value="1" <?php echo ($vlv018=='1')?'selected="selected"':''; ?>>1</option>
							    </select></td>
							 </tr>		
							<tr>
								<td><?php echo $vLangArr[33];?></td>
								<td><select name="txtlv019" id="txtlv019" tabindex="23"><option value=""   >...</option>
							  	<option value="0" <?php echo ($vlv019=='0')?'selected="selected"':''; ?> >0</option>
								<option value="1" <?php echo ($vlv019=='1')?'selected="selected"':''; ?>>1</option>
							    </select>			</td>
								<td><?php echo $vLangArr[34];?></td>
								<td><input  name="txtlv020" type="text" id="txtlv020" value="<?php echo $vlv020;?>" tabindex="24" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
								<td><?php echo $vLangArr[35];?></td>
								<td><input  name="txtlv021" type="text" id="txtlv021" value="<?php echo $lvhr_lv0020->FormatView($vlv021,2);?>" tabindex="25" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/>							    <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv021);return false;" /></span></td>
								<td><?php echo $vLangArr[57];?></td>
								<td><input  name="txtlv043" type="text" id="txtlv043" value="<?php echo $vlv043;?>" tabindex="25" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
							    <td><?php echo $vLangArr[36];?></td>
								<td><table style="width:80%"><tr><td style="width:50%"><select  name="txtlv022" id="txtlv022" value="<?php echo $vlv022;?>" tabindex="26"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
									<option value=""></option>
									<?php echo $lvhr_lv0020->LV_LinkField('lv022',$vlv022);?>
									</select></td><td>
									<ul id="pop-nav5" lang="pop-nav5" onMouseOver="ChangeName(this,5)" onkeyup="ChangeName(this,5)"> <li class="menupopT">
									<input type="text" autocomplete="off" class="search_img_btn" name="txtlv022_search" id="txtlv022_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv022','hr_lv0014','lv002')" onFocus="LoadPopup(this,'txtlv022','hr_lv0014','lv002')" tabindex="200" >
									<div id="lv_popup5" lang="lv_popup5"> </div>						  
									</li>
									</ul></td></tr></table></td>
								<td><?php echo $vLangArr[37];?></td>
								<td><table style="width:80%"><tr><td style="width:50%"><select name="txtlv023"  id="txtlv023" value="<?php echo $vlv023;?>" tabindex="27"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)">
										  <option value=""></option>
										  <?php echo $lvhr_lv0020->LV_LinkField('lv023',$vlv023);?>
										  </select></td><td>
										  <ul id="pop-nav6" lang="pop-nav6" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
											<input type="text" autocomplete="off" class="search_img_btn" name="txtlv023_search" id="txtlv023_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv023','hr_lv0016','lv002')" onFocus="LoadPopup(this,'txtlv023','hr_lv0016','lv002')" tabindex="200" >
											<div id="lv_popup6" lang="lv_popup6"> </div>						  
									</li>
								</ul></td></tr></table></td>
							</tr>
							<tr>
							  <td><?php echo $vLangArr[38];?></td>
							  <td><select name="txtlv024"  id="txtlv024" value="<?php echo $vlv024;?>" tabindex="28" style="width:80%" onKeyPress="return CheckKey(event,7)"><option value=""></option>
							  <?php echo $lvhr_lv0020->LV_LinkField('lv024',$vlv024);?>
							  </select></td>
								<td><?php //echo $vLangArr[39];?></td>
								<td>
								<!--
									<select name="txtlv025"  id="txtlv025"  value="<?php echo $vlv025;?>" tabindex="29" style="width:80%" onKeyPress="return CheckKey(event,7)" /><option value=""></option><?php echo $lvhr_lv0020->LV_LinkField('lv025',$vlv025);?>
									</select>	-->		</td>
							</tr>
							<tr>
							   <td  height="20" colspan="4"><div class="lv_gachchia"></div></td>
							</tr>
							<tr>
							  <td><?php echo $vLangArr[40];?></td>
							  <td><table style="width:80%"><tr><td style="width:50%"><select name="txtlv026"  id="txtlv026"  value="<?php echo $vlv026;?>" tabindex="30"  style="width:100%" onkeypress="return CheckKeys(event,7,this)"/>
							  <option value=""></option>
							  <?php echo $lvhr_lv0020->LV_LinkField('lv026',$vlv026);?>
							      </select></td><td>
										  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
									  <input type="text" autocomplete="off" class="search_img_btn" name="txtlv026_search" id="txtlv026_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv026','hr_lv0007','lv002')" onFocus="LoadPopup(this,'txtlv026','hr_lv0007','lv002')" tabindex="200" >
									  <div id="lv_popup" lang="lv_popup1"> </div>						  
									</li>
									
								</ul></td></tr></table></td>
							  <td><?php echo $vLangArr[41];?></td>
							  <td><select  name="txtlv027" type="text" id="txtlv027" value="<?php echo $vlv027;?>" tabindex="31"  style="width:80%" onKeyPress="return CheckKey(event,7)"/> <option value=""></option>
									<?php echo $lvhr_lv0020->LV_LinkField('lv027',$vlv027);?>
									</select></td>
							</tr>
							<tr>
								<td><?php echo $vLangArr[42];?></td>
								<td><table style="width:80%"><tr><td style="width:50%"><select  name="txtlv028"  id="txtlv028" value="<?php echo $vlv028;?>" tabindex="32"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
				  				<option value=""></option>
								 <?php echo $lvhr_lv0020->LV_LinkField('lv028',$vlv028);?></select></td><td>
											  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> 			
										   <li class="menupopT">
										  <input type="text" autocomplete="off" class="search_img_btn" name="txtlv028_search" id="txtlv028_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv028','hr_lv0005','lv002')" onFocus="LoadPopup(this,'txtlv028','hr_lv0005','lv002')" tabindex="200" >
										  <div id="lv_popup2" lang="lv_popup2"> </div>

									</ul></td></tr></table></td>
								<td><?php echo $vLangArr[44];?></td>
								<td><input name="txtlv030" type="text" id="txtlv030" value="<?php echo $lvhr_lv0020->FormatView($vlv030,2);?>" tabindex="34" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
							    <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv030);return false;" /></span></td>
							</tr>		
							<tr>
							  <td><?php echo $vLangArr[58];?></td>
							  <td><input name="txtlv044" type="text" id="txtlv044" value="<?php echo $lvhr_lv0020->FormatView($vlv044,2);?>" tabindex="34" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
							    <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv044);return false;" /></span></td>
								 <td  height="20" colspan="2"></td>
							</tr>	
                            <tr>
                                  <td  height="20" colspan="4"><div class="lv_gachchia"></div></td>
                            </tr>
							<tr>
								<td><?php echo $vLangArr[45];?></td>
								<td><table style="width:80%"><tr><td style="width:50%"><select name="txtlv031" id="txtlv031"  tabindex="35"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
									<option value=""></option>
									 <?php echo $lvhr_lv0020->LV_LinkField('lv031',$vlv031);?></select></td><td>
												<ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
										  <input type="text" autocomplete="off" class="search_img_btn" name="txtlv031_search" id="txtlv031_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv031','hr_lv0014','lv002')" onFocus="LoadPopup(this,'txtlv031','hr_lv0014','lv002')" tabindex="200" >
										  <div id="lv_popup3" lang="lv_popup3"> </div>						  
										</li>
										
									</ul></td></tr></table>							</td>
								<td><?php echo $vLangArr[46];?></td>
								<td><table style="width:80%"><tr><td style="width:50%"><select name="txtlv032" type="text" id="txtlv032"  value="<?php echo $vlv032;?>" tabindex="36" maxlength="6" style="width:100%" onkeypress="return CheckKeys(event,7,this)" />
							  		<option value=""></option>
									 <?php echo $lvhr_lv0020->LV_LinkField('lv032',$vlv032);?>
											  </select></td><td>
											  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
												<input type="text" autocomplete="off" class="search_img_btn" name="txtlv032_search" id="txtlv032_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv032','hr_lv0023','lv002')" onFocus="LoadPopup(this,'txtlv032','hr_lv0023','lv002')" tabindex="200" >
												<div id="lv_popup4" lang="lv_popup4"> </div>						  
										</li>
									</ul></td></tr></table>	</td>
							</tr>
							<tr>
								<td><?php echo $vLangArr[47];?></td>
								<td><input  name="txtlv033" type="text" id="txtlv033" value="<?php echo $vlv033;?>" tabindex="37" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td><?php echo $vLangArr[48];?></td>
								<td><input  name="txtlv034" type="text" id="txtlv034" value="<?php echo $vlv034;?>" tabindex="38" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  </tr>							  
							<tr>
							  <td><?php echo $vLangArr[49];?></td>
							  <td><input name="txtlv035" type="text" id="txtlv035" value="<?php echo $vlv035;?>" tabindex="39" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  <td><?php echo $vLangArr[50];?></td>
							  <td><input name="txtlv036" type="text" id="txtlv036" value="<?php echo $vlv036;?>" tabindex="40" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							</tr>		
							<tr>
								<td><?php echo $vLangArr[51];?></td>
								<td>
									<input name="txtlv037" type="text" id="txtlv037"  value="<?php echo $vlv037;?>" tabindex="41" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
								<td><?php echo $vLangArr[52];?></td>
								<td><input name="txtlv038" type="text" id="txtlv038"  value="<?php echo $vlv038;?>" tabindex="42" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
								<td><?php echo $vLangArr[53];?></td>
								<td><input  name="txtlv039" type="text" id="txtlv039" value="<?php echo $vlv039;?>" tabindex="43" maxlength="20" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td><?php echo $vLangArr[54];?></td>
								<td>
									<input name="txtlv040" type="text" id="txtlv040"  value="<?php echo $vlv040;?>" tabindex="44" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
							  <td><?php echo $vLangArr[55];?></td>
							  <td><input name="txtlv041" type="text" id="txtlv041"  value="<?php echo $vlv041;?>" tabindex="45" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td><?php echo $vLangArr[56];?></td>
							  <td><table style="width:80%"><tr><td style="width:50%"><select name="txtlv042" type="text" id="txtlv042"  value="<?php echo $vlv042;?>" tabindex="36" maxlength="6" style="width:100%" onkeypress="return CheckKeys(event,7,this)" />
									  <option value=""></option>
									  <?php echo $lvhr_lv0020->LV_LinkField('lv042',$vlv042);?>
									  </select></td><td>
									  <ul id="pop-nav42" lang="pop-nav42" onMouseOver="ChangeName(this,42)" onkeyup="ChangeName(this,42)"> <li class="menupopT">
										<input type="text" autocomplete="off" class="search_img_btn" name="txtlv042_search" id="txtlv042_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv042','hr_lv0121','lv002')" onFocus="LoadPopup(this,'txtlv042','hr_lv0121','lv002')" tabindex="200" >
										<div id="lv_popup42" lang="lv_popup42"> </div>						  
									</li>
									</ul></td></tr></table></td>
							</tr>
							<tr>
                                  <td  height="20" colspan="4"><div class="lv_gachchia"></div></td>
                            </tr>
							<tr>
								<td height="20"><?php echo $vLangArr[75];?></td>
								<td height="20"><input  name="txtlv072" type="text" id="txtlv072" value="<?php echo $vlv072;?>" tabindex="60" maxlength="30" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td height="20"><?php echo $vLangArr[64];?></td>
								<td height="20">
									<input name="txtlv061" type="text" id="txtlv061"  value="<?php echo $vlv061;?>" tabindex="60" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
							<td height="20"><?php echo $vLangArr[63];?></td>
								<td height="20"><input  name="txtlv060" type="text" id="txtlv060" value="<?php echo $vlv060;?>" tabindex="60" maxlength="30" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td height="20"><?php echo $vLangArr[70];?></td>
								<td height="20">
									<input name="txtlv067" type="text" id="txtlv067"  value="<?php echo $vlv067;?>" tabindex="60" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td height="20"><?php echo $vLangArr[65];?></td>
								<td height="20"><input  name="txtlv062" type="text" id="txtlv062" value="<?php echo $vlv062;?>" tabindex="60" maxlength="30" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td height="20"><?php echo $vLangArr[66];?></td>
								<td height="20">
									<input name="txtlv063" type="text" id="txtlv063"  value="<?php echo $vlv063;?>" tabindex="60" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td height="20"><?php echo $vLangArr[67];?></td>
								<td height="20">
									<select  name="txtlv064" type="text" id="txtlv064" tabindex="60" maxlength="30" style="width:80%" onKeyPress="return CheckKey(event,7)">
										<option value=""></option>
										<?php echo $lvhr_lv0020->LV_LinkField('lv064',$vlv064);?>
									  </select>
								</td>
								<td height="20"><?php echo $vLangArr[68];?></td>
								<td height="20">
									<input name="txtlv065" type="text" id="txtlv065"  value="<?php echo $vlv065;?>" tabindex="60" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
								<td height="20"><?php echo $vLangArr[69];?></td>
								<td height="20"><input  name="txtlv066" type="text" id="txtlv066" value="<?php echo $vlv066;?>" tabindex="60" maxlength="30" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
								<td height="20"><?php echo $vLangArr[81];?></td>
								<td height="20"><input  name="txtlv049" type="text" id="txtlv049" value="<?php echo $vlv049;?>" tabindex="60" maxlength="30" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							  <td colspan="2"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							  <td colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="16"><img src="../../images/lvicon/Filter.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[3];?></a></TD>
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
					</form>	

				
  </div>
</div>
<script language="javascript">
	var o=document.frmfilter;
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