<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/mn_lv0220.php");
/////////////init object//////////////
$momn_lv0220=new mn_lv0220($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0220');

$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
//echo base64_encode('mn_lv0220/mn_lv0220-1.php');
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vOrderList=$_POST['txtOrderList'];
$vkeep=$_POST['qxtlvkeep'];
$vStrMessage="";
$isFirst=false;

//PO VT
$momn_lv0220->TypePO='1';
$momn_lv0220->trangthai2='';
$totalRowsC=$momn_lv0220->GetCount();
//PO VT Phụ
$momn_lv0220->TypePO='4';
$momn_lv0220->trangthai2='';
$totalRowsC4=$momn_lv0220->GetCount();
// PO TN
$momn_lv0220->TypePO='2';
//$momn_lv0220->trangthai2='0,1';
$totalRowsC1=$momn_lv0220->GetCount();

// PO NN
$momn_lv0220->TypePO='3';
$momn_lv0220->trangthai2='';
$totalRowsC2=$momn_lv0220->GetCount();

//Tong
$totalRowsC3=$totalRowsC+$totalRowsC1+$totalRowsC2+$totalRowsC4;
//SỔ QUỸ

//$maxPages = 10;
//if($curPage=="") 
//$curPage = 1;
//$curRow = ($curPage-1)*$maxRows;
//$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<script language="JavaScript" type="text/javascript">
<!--

function RunDisableAll(cur)
{
	var o=document.getElementById("curTabView");
	o.value=cur;
	for(var js='0';js<=6;js++)
	{
		var o1=document.getElementById("cl_"+js+"_1");
		var h1=document.getElementById("cl_"+js+"_2");
		var o3=document.getElementById("hrtab_"+js);
		var if1=document.getElementById("cl_"+js+"_3");
		if(cur==js)
		{
			if(o1!=null) 
			{
				o1.style.display="block";
				if(if1!=null) if1.src=h1.value;
			}
			if(o3!=null) o3.className="curshow";
			
		}
		else
		{
			if(o1!=null) o1.style.display="none";
			if(o3!=null) o3.className="cssTab";
		}
	}	
}
function jobshow(cur)
{
	for(var js='0';js<=6;js++)
	{
		var o1=document.getElementById("job_"+js);
		
		if(cur==js)
		{
			if(o1!=null) o1.style.display="block";
			
		}
		else
		{
			if(o1!=null) o1.style.display="none";
			
		}
	}	
}	
//-->
</script>
<?php
if($momn_lv0220->GetApr()==0 && $momn_lv0220->GetUnApr()==0)
{
	$momn_lv0220->DefaultFieldList='lv001,lv015,lv829,lv003,lv022,lv025,lv016,lv017,lv098,lv008,lv013,lv018,lv019,lv021';
}
if($momn_lv0220->GetView()==1)
{
?>
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					<input id="curTabView" name="curTabView" type="hidden" value="<?php echo $_POST['curTabView'];?>"/> 
					<input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
					<table border="0" width="100%">
							<tbody>
								<tr>
									<td align="left" id="TabViewHr">
										<ul class="IdTabViewHr">
											<?php
											$vMaThamChieu=$momn_lv0220->Get_User($_SESSION['ERPSOFV2RUserID'],'lv904');
											if($vMaThamChieu!='MP002' || $_SESSION['ERPSOFV2RRight']=='admin')
											{
											?>
											<li><div id="hrtab_0" class="curshow" onclick="RunDisableAll(0)">PMH HC<?php echo (($totalRowsC>0)?'('.$totalRowsC.')':'');?></div></li>
											<?php
											}
											if($vMaThamChieu!='MP001' || $_SESSION['ERPSOFV2RRight']=='admin')
											{
											?>
											<li><div id="hrtab_4" class="cssTab" onclick="RunDisableAll(4)">VT PHỤ<?php echo (($totalRowsC4>0)?'('.$totalRowsC4.')':'');?></div></li>
											<?php
											}
										/*	if($vMaThamChieu!='MP001'|| $_SESSION['ERPSOFV2RRight']=='admin')
											{
											?>
											<li><div id="hrtab_1" class="cssTab" onclick="RunDisableAll(1)">PMH TN<?php echo (($totalRowsC1>0)?'('.$totalRowsC1.')':'');?></div></li>
											<li><div id="hrtab_2" class="cssTab" onclick="RunDisableAll(2)">PMH NN<?php echo (($totalRowsC2>0)?'('.$totalRowsC2.')':'');?></div></li>
											<?php
											}
											if(($vMaThamChieu!='MP002' && $vMaThamChieu!='MP001') || $_SESSION['ERPSOFV2RRight']=='admin')
											{
											?>
											<li><div id="hrtab_3" class="cssTab" onclick="RunDisableAll(3)">Tổng hợp<?php echo (($totalRowsC3>0)?'('.$totalRowsC3.')':'');?></div></li>
											<?php
											}
											*/
											?>
										</ul>
									</td>
								</tr>
							</tbody>
						</table>
						<?php
							if($vMaThamChieu!='MP002' || $_SESSION['ERPSOFV2RRight']=='admin')
							{
								$isFirst=true;
							?>
						<div id="cl_0_1">
							<input type="hidden" name="cl_0_2" id="cl_0_2" value="home.php?lang=VN&opt=27&item=&link=bW5fbHYwMjIwL21uX2x2MDIyMC0xLnBocA==&TypePO=1"/>
							<iframe name="cl_0_3" id="cl_0_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="home.php?lang=VN&opt=27&item=&link=bW5fbHYwMjIwL21uX2x2MDIyMC0xLnBocA==&TypePO=1" class=lvframe></iframe>
					 	</div>
						 <?php
							}
							if($vMaThamChieu!='MP001'|| $_SESSION['ERPSOFV2RRight']=='admin')
							{
							?>
						<div id="cl_1_1">
							<input type="hidden" name="cl_1_2" id="cl_1_2" value="home.php?lang=VN&opt=27&item=&link=bW5fbHYwMjIwL21uX2x2MDIyMC0xLnBocA==&TypePO=2"/>
							<iframe name="cl_1_3" id="cl_1_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
						</div>	
						<div id="cl_2_1">
							<input type="hidden" name="cl_2_2" id="cl_2_2" value="home.php?lang=VN&opt=27&item=&link=bW5fbHYwMjIwL21uX2x2MDIyMC0xLnBocA==&TypePO=3"/>
							<iframe name="cl_2_3" id="cl_2_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
						</div>
						<?php
						}
						if(($vMaThamChieu!='MP002' && $vMaThamChieu!='MP001') || $_SESSION['ERPSOFV2RRight']=='admin')
						{
						?>
						<div id="cl_3_1">
							<input type="hidden" name="cl_3_2" id="cl_3_2" value="home.php?lang=VN&opt=27&item=&link=bW5fbHYwMjIwL21uX2x2MDIyMC0xLnBocA==&TypePO="/>
							<iframe name="cl_3_3" id="cl_3_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
						</div>
						<?php
						}
						if($vMaThamChieu!='MP001' || $_SESSION['ERPSOFV2RRight']=='admin')
						{
						?>
						<div id="cl_4_1">
							<input type="hidden" name="cl_4_2" id="cl_4_2" value="home.php?lang=VN&opt=27&item=&link=bW5fbHYwMjIwL21uX2x2MDIyMC0xLnBocA==&TypePO=4"/>
							<iframe name="cl_4_3" id="cl_4_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
						</div>		
						<?php
						}
						?>				
				  </form>
				 
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
</div></div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
	<?php 
	if(!isset($_POST['curTabView']) && $isFirst==false)
	{?>
		RunDisableAll(1);
	<?php
	}
	?>
setTimeout("setFocusNow()",1000);
function setFocusNow()
{
	document.frmchoose.qxtlv001.focus();
}
</script>