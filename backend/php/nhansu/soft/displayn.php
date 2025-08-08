<?php 
require_once("../clsall/lv_controler.php");
$plang=$_GET['lang'];
if($plang!="VN" || $plang=="")
$plang="EN";
$vNow=GetServerDate();

echo$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

?>
<div id='lv_introduce'>
<script language="javascript">
function introvisible()
{
	var o=document.getElementById('lv_introduce_content');
	var o1=document.getElementById('seemore');
	if(o.style.display=='block')
	{
		o.style.display="none";
		<?php
		$vTitle=''; if($plang=="EN")
		{	
		?>
		o1.innerHTML='See more';
		<?php
		 }
		 else 
		 {
		?>
		o1.innerHTML='Xem thêm';
		<?php 
		}?>
	}
	else
	{
		o.style.display="block";
		<?php
		$vTitle=''; if($plang=="EN")
		{	
		?>
		o1.innerHTML='Close';
		<?php
		 }
		 else 
		 {
		?>
		o1.innerHTML='Đóng';
		<?php 
		}?>
	}
}
</script>
<?php

if($plang=="EN")
{		
?>
<div id='lv_introduce_header'>KEYBOARD SHORTCUTS ERP SOF V3.0 <a href="javascript:introvisible()" id='seemore'>See more</a></div>
<div id='lv_introduce_content' style="display:none"> 
<br />
<strong>Shortcuts:</strong>
<br/>
&nbsp;&nbsp;&nbsp;<strong>+ Keyboard Shortcuts section on the first function of the software (Menu Header):</strong><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + Up : Hiding items on the header of the software<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + Down : Visible items on the header of the software<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + Left : Allow the item functions run on the left of the bar.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + Right : Allows the entry function to run on the right of the bar.  <br/><br/>
&nbsp;&nbsp;&nbsp;<strong>+ The keyboard shortcuts to the left of the software (Left Menu):</strong><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- F9 : Toggle display monitors keystrokes and mouse<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + F9 : On/Off screen display function on the left<br/><br/>
&nbsp;&nbsp;&nbsp;<strong>+ The keyboard Shortcuts section of software to manipulate content (Content):</strong><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shift + L/l : Set the interface manipulating content (right click the first to manipulate the text)<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shift + E/e : Edit the selected content<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shif + X/x : Delete the selected content.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shif + F/f : Content Filtering.  <br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shif + V/v : The directory the row and column operations (ECs to exit Press - Press Enter to save - Use the Tab or Shift + Tab keys to move up and down).<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shif + K/k : The directory the output data manipulation (ECs to exit Press - Press Enter to save - Use the Tab or Shift + Tab keys to move up and down).<br/>

<br />
<br />
About Company:
<br />
SOF CO., LTD
<br />
Add: Lot III/21 19/5A, Industrial Group III, Tan Binh IZ, Tay Thanh Ward, Tan Phu District, Ho Chi Minh City
<br />
Phone: (848) 36.020.139    Fax: (848) 38.498.379
<br/>
Mobi: 0933 549 469
<br/>
Email:info@sof.vn
<br />
Website: <a href="http://www.sof.vn" target="_blank">www.sof.vn</a>
<br />
</div>
<?php
}
else
{
?>
<div id='lv_introduce_header'>
CÁC PHÍM TẮT ERP SOF V3.0 <a href="javascript:introvisible()" id='seemore'>Xem thêm</a>
</div>
<div id='lv_introduce_content' style="display:none"> 
<br />
<strong>Các phím tắt:</strong>
<br/>
&nbsp;&nbsp;&nbsp;<strong>+ Phím tắt mục chức năng trên đầu của phần mềm (Menu Header):</strong><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + Up : Ẩn mục chức năng trên cùng của phần mềm<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + Down : Hiện mục chức năng trên cùng của phần mềm<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + Left : Cho phép các mục chức năng chạy về trái của thanh.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + Right : Cho phép các mục chức năng chạy về phải của thanh.  <br/><br/>
&nbsp;&nbsp;&nbsp;<strong>+ Phím tắt mục chức năng bên trái của phần mềm (Menu Left):</strong><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- F9 : Chuyển đổi qua lại màn hình thao tác phím và màn hình dùng chuột<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + F9 : Tắt mở màn hình chức năng bên trái màn hình<br/><br/>
&nbsp;&nbsp;&nbsp;<strong>+ Phím tắt mục thao tác nội dụng phần mềm (Content):</strong><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shift + L/l : Chọn giao diện thao tác nội dung(phải nhấn đầu tiên khi muốn thao tác phần nội dung)<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shift + E/e : Sửa dòng nội dung được chọn<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shif + X/x : Xóa dòng nội dung được chọn.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shif + F/f : Lọc nội dung.  <br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shif + V/v : Hiện mục chức thao tác dòng và cột (Nhấn phím Ecs để thoát - Nhấn phím Enter để lưu - Sử dụng phím Tab hoặc Shift +Tab để di chuyển lên xuống).<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shif + K/k : Hiện mục chức thao tác kết xuất dữ liệu (Nhấn phím Ecs để thoát - Nhấn phím Enter để lưu - Sử dụng phím Tab hoặc Shift +Tab để di chuyển lên xuống).<br/>

<br />
Về Công Ty:
<br />
CTY TNHH SOF
<br />
Địa chỉ: 69/9 Đường D9, Phường Tây Thạnh, Quận Tân Phú, Thành phố Hồ Chí Minh
<br />
Điện thoại: (848) 36.020.139    Fax: (848) 38.498.379
Di động: 0933 549.469
<br />
Email:info@sof.vn
<br />
Website: <a href="http://sof.vn" target="_blank">www.sof.vn</a>
<br />
</div>
<?php
}
require_once("../clsall/hr_lv0038.php");
require_once("../clsall/tc_lv0013.php");
require_once("../clsall/tc_lv0064.php");
$motc_lv0064=new tc_lv0064($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0064');
$vNow=GetServerDate();
require_once("../clsall/tc_lv0013.php");
require_once("../clsall/tc_lv0064.php");
$motc_lv0064=new tc_lv0064($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0064');
$vNow=GetServerDate();
if(getday($vNow)==22 || getday($vNow)==28)
{
	require_once("../clsall/tc_lv0048.php");
	require_once("../clsall/hr_lv0002.php");
	require_once("../clsall/tc_lv0077.php");
	$mohr_lv0002=new hr_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0064');
	$lvtc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
	$motc_lv0048=new tc_lv0048($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0048');
	$motc_lv0077=new tc_lv0077($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0048');
	/*$vCalID=$lvtc_lv0013->LV_LoadActiveIDMonth(getmonth($vNow),getyear($vNow));
	if($vCalID==NULL || $vCalID=='')
	{
		$vCalID1=$lvtc_lv0013->LV_LoadPreMonth(getmonth($vNow),getyear($vNow));
		if($vCalID1==NULL || $vCalID1=='')
		{
		}
		$lvtc_lv0013->LV_CopyPreInsert($vCalID1);
		$vCalID=$lvtc_lv0013->LV_LoadActiveIDMonth(getmonth($vNow),getyear($vNow));
	}
	*/
	$vCalID=$lvtc_lv0013->LV_LoadNextMonth(getmonth($vNow),getyear($vNow));
	if($vCalID==NULL || $vCalID=='')
	{
		$vCalID1=$lvtc_lv0013->LV_LoadActiveIDMonth(getmonth($vNow),getyear($vNow));
		if($vCalID1==NULL || $vCalID1=='')
		{
		}
		$lvtc_lv0013->LV_CopyPreInsert($vCalID1);
		$vCalID=$lvtc_lv0013->LV_LoadNextMonth(getmonth($vNow),getyear($vNow));
	}
	$lvtc_lv0013->LV_LoadID($vCalID);
	$motc_lv0048->CalID=$lvtc_lv0013->lv001;
	$motc_lv0048->month=$lvtc_lv0013->lv006;
	$motc_lv0048->year=$lvtc_lv0013->lv007;
	$motc_lv0048->dayfrom=$_POST['txtDayFrom'];
	$motc_lv0048->dayto=$_POST['txtDayTo'];
	$motc_lv0048->lv004=$year."-".$month;
	$motc_lv0048->datefrom=$lvtc_lv0013->lv004;
	$motc_lv0048->dateto=$lvtc_lv0013->lv005;
	$lvtc_lv0013->LV_UpdateFinishAuto($lvtc_lv0013->lv001);
	if($lvtc_lv0013->lv101==0)
	{
		$motc_lv0048->motc_lv0077=$motc_lv0077;
		$motc_lv0048->AuRunCalendar($mohr_lv0002,$lvtc_lv0013);
		$motc_lv0064->objtc_lv0013=$lvtc_lv0013;
		$motc_lv0064->LV_Aproval($lvtc_lv0013->lv001);
	}
}

//require_once("../clsall/tc_lv0012.php");
//$motc_lv0012=new tc_lv0012($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0012');
//if($motc_lv0012->GetCount()==0)
//{
//	$vsql="insert into tc_lv0012(lv001,lv002,lv003) select B.lv002,A.lv002,A.lv003 from tc_lv0012_ A inner join tc_lv0012_1 B on A.lv001=B.lv001 where B.lv002 in (select B.lv001 from hr_lv0020 B)";
//	db_query($vsql);
//}
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
if($motc_lv0013->GetApr()==1 && $motc_lv0013->GetUnApr()==1)
{
	if(isset($_POST['txtCalID']))
	{
		$motc_lv0013->LV_SetCal($_POST['txtCalID']);
	}
	$motc_lv0013->LV_GetCal();
?>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				
	 <form name="frmcalculate" method="post">
	<?php 
	
		  $vTitle=''; 
		  if($plang=="EN")
			{	

					echo 'OPTION PARAMETER TO CACULATE ';
			}
		   else
		   {
				echo 'CHỌN THÔNG SỐ TÍNH LƯƠNG';
		   }
		   ?>
		   <input type="hidden" name="lang" value="<?php echo $_GET['lang'];?>"/>
		    <select name="txtCalID">
		    	<option value="">...</option>
				<?php echo $motc_lv0013->LV_LinkField('lv999',$motc_lv0013->lv999);?>
			</select>
		  	<input type="submit" value="Chọn ngay" onclick="document.frmcalculate.submit()"/>
			</form> 
		</td>
		</tr>
		</tbody>
		</table>	
<?php
}
$motc_lv0064->objtc_lv0013=$motc_lv0013;
$vDSNVCo2PB=$motc_lv0064->LV_AlarmDeptTwoo($motc_lv0013->lv999);
if($vDSNVCo2PB!='')
{
	$movvtc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
	$movvtc_lv0013->LV_LoadID($motc_lv0013->lv999);
?>

<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				<li class="home_title"> DS NV CÓ 2 PHÒNG BAN TRONG THÁNG <?php echo $movvtc_lv0013->lv006."/".$movvtc_lv0013->lv007;?></li>
				</div>
				</td>
				</tr>
				<tr>
				  <td>      
				  <div style="width:100%">

	<?php
		echo $vDSNVCo2PB;
?>
	
		</div>
		</td>
		</tr>
		</tbody>
</table>	
<?php
}
if($motc_lv0064->GetView()==1)
{
	
	$motc_lv0013->LV_LoadActiveID();
	$motc_lv0064->objtc_lv0013=$motc_lv0013;
	if($motc_lv0013->lv001!=NULL && $motc_lv0013->lv001!="")
	{
		$vValueCurDay=str_replace("-","",$vNow);
		if($motc_lv0013->lv097==0)
		{
			$motc_lv0064->lv002=$motc_lv0013->lv001;
			//$motc_lv0064->LV_Aproval();
			$motc_lv0013->LV_UpdateStateStaff($motc_lv0013->lv001);
		}
		elseif($motc_lv0013->lv097==1 && (float)$vValueCurDay>=(float)str_replace("-","",$motc_lv0013->lv005))
		{	
			$motc_lv0064->lv002=$motc_lv0013->lv001;
			//$motc_lv0064->LV_Aproval();
			$motc_lv0013->LV_UpdateStateStaff($motc_lv0013->lv001);
		}
			
	}
}
require_once("../clsall/hr_lv0098.php");
$mohr_lv0098=new hr_lv0098($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0098');
if($mohr_lv0098->GetView()==1)
{
	require_once("../clsall/tc_lv0064.php");
	$motc_lv0064=new tc_lv0064('admin','admin','Tc0064');
	$mohr_lv0098->motc_lv0064=$motc_lv0064;
	$mohr_lv0098->LV_AcceptDept();
}
require_once("../clsall/hr_lv0020.php");
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
if($mohr_lv0020->GetView()==1)
{
	$lvhr_lv0038=new hr_lv0038('admin','admin','Hr0046');
	$mohr_lv0020->mohr_lv0038=$lvhr_lv0038;
	$mohr_lv0020->LV_AutoRunAuto();
	$vStr='';
	$vStrLi='';
	$vStrPost='';
	$vCount=0;
	$slq="
	select count(lv099) SoMa,concat('MCC:',lv099) ID from hr_lv0020 where lv009 not in (2,3) and lv099<>'' GROUP BY lv099 HAVING SoMa>1 
	union
	select count(lv010) SoMa,concat('CMND:',lv010) ID from hr_lv0020 where lv009 not in (2,3) and lv010<>'' GROUP BY lv010 HAVING SoMa>1 
	union
	select count(lv101) SoMa,concat('MCC CŨ:',lv101) ID from hr_lv0020 where lv009 not in (2,3) and lv101<>'' GROUP BY lv101 HAVING SoMa>1 
	union
	select count(lv014) SoMa,concat('STK NH:',lv014) ID from hr_lv0020 where lv009 not in (2,3) and lv014<>'' GROUP BY lv014 HAVING SoMa>1 
	union
	select count(lv013) SoMa,concat('MS THUẾ:',lv013) ID from hr_lv0020 where lv009 not in (2,3) and lv013<>'' GROUP BY lv013 HAVING SoMa>1 
	union
	select count(md5(lv002)) SoMa,concat('Tên NV:',lv002) ID from hr_lv0020 where lv009 not in (2,3) and lv029 not in ('801','803','804') and lv002<>'' GROUP BY md5(lv002) HAVING SoMa>1 
	";
	//union select count(lv020) SoMa,concat('SỐ BHXH:',lv020) ID from hr_lv0020 where lv009 not in (2,3) and lv020<>'' GROUP BY lv020 HAVING SoMa>1 
	$vResult=db_query($slq);
	while($vrow=db_fetch_array($vResult))
	{
		$vCount++;
		if($plang=="EN")
		{
			if($vStrPost=="")
				$vStrPost=$vrow['lv001'].",";
			else
				$vStrPost=$vStrPost.$vrow['lv001'].",";
			$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td>".$vrow['ID']."</td><td>"."".$vrow['SoMa']."</td><tr>";
			$vStr=$vStr."".$vrow['ID']."(".$vrow['SoMa'].")</a>&nbsp;&nbsp;&nbsp;";
		}
		else
		{
			if($vStrPost=="")
				$vStrPost=$vrow['lv001'].",";
			else
				$vStrPost=$vStrPost.$vrow['lv001'].",";
			$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td>".$vrow['ID']."</td><td>"."".$vrow['SoMa']."</td><tr>";
			$vStr=$vStr."".$vrow['ID']."(".$vrow['SoMa'].")</a>&nbsp;&nbsp;&nbsp;";
		}
	}
?>
</div>

</div>
<div >&nbsp;</div>
<script language="javascript">
function SendSubmit(o)
{
	o.submit();
}
</script>

<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				<li class="home_title">
	<?php 
		  $vTitle=''; 
		  if($plang=="EN")
			{	
			  $vTitle= 'ALARM DUPLICAT ID('.$vCount.')';
			  echo  $vTitle.(($vStrPost=='')?'':'<span style="cursor:pointer" onclick="SendCheckApr(100,\''.$vTitle.'\')">View</span>');//onclick="SendCheckApr(1,\''.$vTitle.'\')"
			}
		   else
		   {
		   	  $vTitle= 'CẢNH BẢO TRÙNG MÃ('.$vCount.')';
			  echo  $vTitle.(($vStrPost=='')?'':'<span style="cursor:pointer" onclick="SendCheckApr(100,\''.$vTitle.'\')">Xem</span>');//onclick="SendCheckApr(1,\''.$vTitle.'\')"
		   }	
?> 
				<div id="calendarview_100" class="viewcalandar" style="width:600px;display: none; clear: both; z-index: 99999;position:relative;clear:both;overflow:hidden;">
						<form action="?lang=<?php echo $plang;?>&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=" method="post" name="frmduplicat" id="frmduplicat">
							<input type="hidden" name="LSEMPID" value="<?php echo $vStrPost;?>"/>
						</form>
					<div style="float:left;width:400px">
						<p onclick="closepopcalendar('100')"><img width="20" src="../images/icon/close.png"></p>
						<table class="lvtable">
						<tr><td class="lvhtable">STT</td><td class="lvhtable">Mã</td><td class="lvhtable">Số lần trùng</td ></tr>
						<?php echo $vStrLi;?>
						</table>
					</div>
					<div style="float:right;width:20px;color:red;cursor:pointer;overflow:hidden;"></div>
</li>
					</div>
				</td>
				</tr>
				<tr>
				  <td>      
				  <div style="width:100%">
	<marquee onmouseover="this.stop()" onmouseout="this.start()">
	<?php
		echo $vStr;
?>
	</marquee>      
		</div>
		</td>
		</tr>
		</tbody>
</table>

<?php
}
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0046');
if($mohr_lv0038->GetView()==1)
{
	$mohr_lv0038->LV_AcceptPreActive();
	$vStr='';
	$vStrLi='';
	$vStrPost='';
	$vCount=0;
	$slq="select * from (select A.lv001,A.lv002,A.lv003,A.lv004,(select count(*) from hr_lv0038 B where A.lv001=B.lv002 ) StateNo from hr_lv0020 A where A.lv009 not in (2,3,7) and  year(A.lv044)<='2015') MP where MP.StateNo=0";
	$vResult=db_query($slq);
	while($vrow=db_fetch_array($vResult))
	{
		$vCount++;
			if($plang=="EN")
				{
					if($vStrPost=="")
						$vStrPost=$vrow['lv001'].",";
					else
						$vStrPost=$vStrPost.$vrow['lv001'].",";
					$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td><a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv001']."</a></td><td>"."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."</a>"."</td><tr>";
					$vStr=$vStr."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."(".$vrow['lv001'].")</a>&nbsp;&nbsp;&nbsp;";
				}
				else
				{
					if($vStrPost=="")
						$vStrPost=$vrow['lv001'].",";
					else
						$vStrPost=$vStrPost.$vrow['lv001'].",";
					$vStrLi=$vStrLi."<tr  class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td>".$vrow['lv001']."</td><td>"."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."</a>"."</td><tr>";
					$vStr=$vStr."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv004']." ".$vrow['lv003']." ".$vrow['lv002']."(".$vrow['lv001'].")</a>&nbsp;&nbsp;&nbsp;";
				}
	}
?>
</div>

</div>
<div >&nbsp;</div>
<script language="javascript">
function SendSubmit(o)
{
	o.submit();
}
</script>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				<li class="home_title">
	<?php 
		  $vTitle=''; 
		  if($plang=="EN")
			{	
			  $vTitle= 'LIST EMPLOYEE NOT CONTRACT('.$vCount.')';
			  echo  $vTitle.(($vStrPost=='')?'':'<span style="cursor:pointer" onclick="SendSubmit(document.frmchuanhaphdld)">View</span>');//onclick="SendCheckApr(1,\''.$vTitle.'\')"
			}
		   else
		   {
		   	  $vTitle= 'DANH SÁCH NHÂN VIÊN CHƯA NHẬP HỢP ĐỒNG('.$vCount.')';
			  echo  $vTitle.(($vStrPost=='')?'':'<span style="cursor:pointer" onclick="SendSubmit(document.frmchuanhaphdld)">Xem</span>');//onclick="SendCheckApr(1,\''.$vTitle.'\')"
		   }	
?> 
				<div id="calendarview_10" class="viewcalandar" style="width:600px;display: none; clear: both; z-index: 99999;position:relative;clear:both">
						<form action="?lang=<?php echo $plang;?>&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=" method="post" name="frmchuanhaphdld" id="frmchuanhaphdld">
							<input type="hidden" name="LSEMPID" value="<?php echo $vStrPost;?>"/>
						</form>
				<!--	<div style="float:left;width:400px">
						<p onclick="closepopcalendar('1')"><img width="20" src="../images/icon/close.png"></p>
						<table class="lvtable">
						<tr><td class="lvhtable">STT</td><td class="lvhtable">Mã</td><td class="lvhtable">Tên</td ></tr>
						<?php //echo $vStrLi;?>
						</table>
					</div>
					<div style="float:right;width:20px;color:red;cursor:pointer;overflow:hidden;">--></div>
</li>
					</div>
				</td>
				</tr>
				<tr>
				  <td>      
				  <div style="width:100%">
	<marquee onmouseover="this.stop()" onmouseout="this.start()">
	<?php
		echo $vStr;
?>
	</marquee>      
		</div>
		</td>
		</tr>
		</tbody>
		</table>
<div >&nbsp;</div>
<?php
$vStr='';
$vStrLi='';
$vStrPost='';
$vCount=0;
$slq="select * from (select A.lv001,A.lv002,A.lv003,A.lv004,(select count(*) from hr_lv0038 B where A.lv001=B.lv002 and B.lv004<='$vNow' and B.lv005>='$vNow' and B.lv009>=1 ) State,(select count(*) from hr_lv0038 B where A.lv001=B.lv002 and B.lv009=1 ) StateNo,(select count(*) from hr_lv0038 B where A.lv001=B.lv002  ) NumContract from hr_lv0020 A where A.lv009 not in (2,3,7,5) and  year(A.lv044)<='2015') MP where MP.NumContract>0 and ((MP.State)=0 OR MP.StateNo<>1)";
$vResult=db_query($slq);
while($vrow=db_fetch_array($vResult))
{
	if($vrow['StateNo']>1)
	{
		//Code xử lý active hợp đồng gần nhất
		$mohr_lv0038->LV_AprovalMoreTwo($vrow['lv001']);
	}
	else
	{
	$vCount++;
		if($plang=="EN")
			{
				if($vStrPost=="")
					$vStrPost=$vrow['lv001'].",";
				else
					$vStrPost=$vStrPost.$vrow['lv001'].",";
				$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td><a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv001']."</a></td><td>"."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."</a>"."</td><tr>";
				$vStr=$vStr."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."(".$vrow['lv001'].")</a>&nbsp;&nbsp;&nbsp;";
			}
			else
			{
				if($vStrPost=="")
					$vStrPost=$vrow['lv001'].",";
				else
					$vStrPost=$vStrPost.$vrow['lv001'].",";
				$vStrLi=$vStrLi."<tr  class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td>".$vrow['lv001']."</td><td>"."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."</a>"."</td><tr>";
				$vStr=$vStr."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv004']." ".$vrow['lv003']." ".$vrow['lv002']."(".$vrow['lv001'].")</a>&nbsp;&nbsp;&nbsp;";
			}
	}
}
?>
</div>

</div>
<div >&nbsp;</div>
<script language="javascript">
function SendSubmit(o)
{
o.submit();
}
</script>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
<tbody><tr>
<td class="titlerow" style="color:#000;font-weight:bold">
<div style="clear:both">
			<li class="home_title">
<?php 
	  $vTitle=''; 
	  if($plang=="EN")
		{	
		  $vTitle= 'LIST EMPLOYEE NOT ACTIVE CONTRACT OR MORE 1 ACTIVE CONTRACT TO CALCULATE SALARY('.$vCount.')';
		  echo  $vTitle.(($vStrPost=='')?'':'<span style="cursor:pointer" onclick="SendSubmit(document.frmchuakhoahd)">View</span>');//onclick="SendCheckApr(1,\''.$vTitle.'\')"
		}
	   else
	   {
			 $vTitle= '<font style="text-transform: uppercase;">Nhân viên chưa kích hoạt HĐ trong tháng hoặc hơn 1 HĐ cho phép tính lương('.$vCount.')</font>';
		  echo  $vTitle.(($vStrPost=='')?'':'<span style="cursor:pointer" onclick="SendSubmit(document.frmchuakhoahd)">Xem</span>');//onclick="SendCheckApr(1,\''.$vTitle.'\')"
	   }	
?> 
			<div id="calendarview_11" class="viewcalandar" style="width:600px;display: none; clear: both; z-index: 99999;position:relative;clear:both">
					<form action="?lang=<?php echo $plang;?>&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=" method="post" name="frmchuakhoahd" id="frmchuakhoahd">
						<input type="hidden" name="LSEMPID" value="<?php echo $vStrPost;?>"/>
					</form>
			<!--	<div style="float:left;width:400px">
					<p onclick="closepopcalendar('1')"><img width="20" src="../images/icon/close.png"></p>
					<table class="lvtable">
					<tr><td class="lvhtable">STT</td><td class="lvhtable">Mã</td><td class="lvhtable">Tên</td ></tr>
					<?php //echo $vStrLi;?>
					</table>
				</div>
				<div style="float:right;width:20px;color:red;cursor:pointer;overflow:hidden;">--></div>
</li>
				</div>
			</td>
			</tr>
			<tr>
			  <td>      
			  <div style="width:100%">
<marquee onmouseover="this.stop()" onmouseout="this.start()">
<?php
	echo $vStr;
?>
</marquee>      
	</div>
	</td>
	</tr>
	</tbody>
	</table>
	<div >&nbsp;</div>
<?php
$vStr='';
$vStrLi='';
$vStrPost='';
$vCount=0;
$slq="select * from (select A.lv001,A.lv002,A.lv003,A.lv004,(select count(*) from hr_lv0038 B where A.lv001=B.lv002 and B.lv004<='$vNow' and B.lv005>='$vNow' and B.lv009>=1 ) State,(select count(*) from hr_lv0038 B where A.lv001=B.lv002 and B.lv009=1 ) StateNo,(select count(*) from hr_lv0038 B where A.lv001=B.lv002  ) NumContract from hr_lv0020 A where A.lv009='5' and  year(A.lv044)<='2015') MP where MP.NumContract>0 and ((MP.State)=0 OR MP.StateNo<>1)";
$vResult=db_query($slq);
while($vrow=db_fetch_array($vResult))
{

		$vCount++;
		if($plang=="EN")
			{
				if($vStrPost=="")
					$vStrPost=$vrow['lv001'].",";
				else
					$vStrPost=$vStrPost.$vrow['lv001'].",";
				$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td><a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv001']."</a></td><td>"."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."</a>"."</td><tr>";
				$vStr=$vStr."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."(".$vrow['lv001'].")</a>&nbsp;&nbsp;&nbsp;";
			}
			else
			{
				if($vStrPost=="")
					$vStrPost=$vrow['lv001'].",";
				else
					$vStrPost=$vStrPost.$vrow['lv001'].",";
				$vStrLi=$vStrLi."<tr  class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td>".$vrow['lv001']."</td><td>"."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."</a>"."</td><tr>";
				$vStr=$vStr."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv004']." ".$vrow['lv003']." ".$vrow['lv002']."(".$vrow['lv001'].")</a>&nbsp;&nbsp;&nbsp;";
			}
}
?>
</div>

</div>

<div >&nbsp;</div>
<?php
	$vStr='';
	$vStrLi='';
	$vStrPost='';
	$vCount=0;
	$slq="select A.lv001,A.lv002,A.lv003,A.lv004 from hr_lv0038 B inner join hr_lv0020 A on B.lv002=A.lv001 where A.lv001=B.lv002 and B.lv009<1  and A.lv009 not in (2,3,7)";
	$vResult=db_query($slq);
	while($vrow=db_fetch_array($vResult))
	{
		$vCount++;
			if($plang=="EN")
				{
					if($vStrPost=="")
						$vStrPost=$vrow['lv001'].",";
					else
						$vStrPost=$vStrPost.$vrow['lv001'].",";
					$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td><a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv001']."</a></td><td>"."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."</a>"."</td><tr>";
					$vStr=$vStr."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."(".$vrow['lv001'].")</a>&nbsp;&nbsp;&nbsp;";
				}
				else
				{
					if($vStrPost=="")
						$vStrPost=$vrow['lv001'].",";
					else
						$vStrPost=$vStrPost.$vrow['lv001'].",";
					$vStrLi=$vStrLi."<tr  class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td>".$vrow['lv001']."</td><td>"."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."</a>"."</td><tr>";
					$vStr=$vStr."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv004']." ".$vrow['lv003']." ".$vrow['lv002']."(".$vrow['lv001'].")</a>&nbsp;&nbsp;&nbsp;";
				}
	}
?>
</div>

</div>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				<li class="home_title">
	<?php 
		  $vTitle=''; 
		  if($plang=="EN")
			{	
			  $vTitle= 'LIST CONTRACT LABOR OF EMPLOYEES NOT ACTIVE('.$vCount.')';
			  echo  $vTitle.(($vStrPost=='')?'':'<span style="cursor:pointer" onclick="SendSubmit(document.frmchuanhaphd)">View</span>');//onclick="SendCheckApr(1,\''.$vTitle.'\')"
			}
		   else
		   {
		   	  $vTitle= '<font style="text-transform: uppercase;">DS HĐ chưa kích hoạt('.$vCount.')</font>';
			  echo  $vTitle.(($vStrPost=='')?'':'<span style="cursor:pointer" onclick="SendSubmit(document.frmchuanhaphd)">Xem</span>');//onclick="SendCheckApr(1,\''.$vTitle.'\')"
		   }	
?> 
				<div id="calendarview_1" class="viewcalandar" style="width:600px;display: none; clear: both; z-index: 99999;position:relative;clear:both">
						<form action="?lang=<?php echo $plang;?>&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=" method="post" name="frmchuanhaphd" id="frmchuanhaphd">
							<input type="hidden" name="LSEMPID" value="<?php echo $vStrPost;?>"/>
						</form>
				<!--	<div style="float:left;width:400px">
						<p onclick="closepopcalendar('1')"><img width="20" src="../images/icon/close.png"></p>
						<table class="lvtable">
						<tr><td class="lvhtable">STT</td><td class="lvhtable">Mã</td><td class="lvhtable">Tên</td ></tr>
						<?php //echo $vStrLi;?>
						</table>
					</div>
					<div style="float:right;width:20px;color:red;cursor:pointer;overflow:hidden;">--></div>
</li>
					</div>
				</td>
				</tr>
				<tr>
				  <td>      
				  <div style="width:100%">
	<marquee onmouseover="this.stop()" onmouseout="this.start()">
	<?php
		echo $vStr;
?>
	</marquee>      
		</div>
		</td>
		</tr>
		</tbody>
		</table>
<div >&nbsp;</div>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				<li class="home_title">
	<?php 
	$vStrLi='';
	$vStr='';
	$vStrPost='';
	$vCount=0;
	$slq="select * from (select A.lv001,A.lv002,A.lv003,A.lv004,DATEDIFF(B.lv005,'$vNow') State,(select count(*) from hr_lv0038 BB where BB.lv002=A.lv001 and BB.lv004>='$vNow') OverMore,B.lv001 MaHD from hr_lv0020 A inner join hr_lv0038 B on A.lv001=B.lv002  where  B.lv004<='$vNow' and B.lv005>='$vNow' And B.lv005<=(DATE_ADD('$vNow',INTERVAL 30 DAY)) and B.lv009=1  and  A.lv009 not in (2,3,7,5) and  year(A.lv044)<='2015')  MP where MP.State<=30 and MP.OverMore=0 order by MP.State Asc";
$vResult=db_query($slq);
while($vrow=db_fetch_array($vResult))
{
	$vCount++;
	 $vTitle=''; 
	 if(trim($vrow['MaHD'])!='' && $vrow['MaHD']!=null)
	 {
		if($vStrPost=="")
			$vStrPostHD=$vrow['MaHD'];
		else
			$vStrPostHD=$vStrPostHD.",".$vrow['MaHD'];
	 }
			if($plang=="EN")
			{
				if($vStrPost=="")
						$vStrPost=$vrow['lv001'].",";
					else
						$vStrPost=$vStrPost.$vrow['lv001'].",";
				$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td><a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv001']."</a></td><td>"."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."</a>"."</td><tr>";
				$vStr=$vStr."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."(".$vrow['lv001']." - ExpireDate:".$vrow['State']." day)</a>&nbsp;&nbsp;&nbsp;";
			}
			else 
			{
				if($vStrPost=="")
						$vStrPost=$vrow['lv001'].",";
					else
						$vStrPost=$vStrPost.$vrow['lv001'].",";
				$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td><a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv001']."</a></td><td>"."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."</a>"."</td><tr>";
				$vStr=$vStr."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>". $vrow['lv004']." ".$vrow['lv003']." ".$vrow['lv002']."(".$vrow['lv001']." - Ngày còn lại:".$vrow['State']." ngày)</a>&nbsp;&nbsp;&nbsp;";
			}
}
		  if($plang=="EN")
			{	
			 $vTitle='STAFF LISTS TO EXPIRE CONTRACT ('.$vCount.')';
			 echo $vTitle.(($vStrPost=='')?'':'<span  style="cursor:pointer" onclick="SendSubmit(document.frmsaphethdthoivu)">View</span> <span  style="cursor:pointer" onclick="SendSubmit(document.frmsaphethdthoivuhd)">View Contract Labor</span>');// onclick="SendCheckApr(2,\''.$vTitle.'\')"
			}
		   else
		   {
		   	 $vTitle= 'DANH SÁCH NHÂN VIÊN SẮP HẾT HẠN HỢP ĐỒNG ('.$vCount.')';
			 echo $vTitle.(($vStrPost=='')?'':'<span style="cursor:pointer" onclick="SendSubmit(document.frmsaphethdthoivu)">Xem</span>&nbsp;&nbsp;<span  style="cursor:pointer" onclick="SendSubmit(document.frmsaphethdthoivuhd)">Xem HĐLĐ</span>'); //onclick="SendCheckApr(2,\''.$vTitle.'\')"
		   }	
?> <div id="calendarview_2" class="viewcalandar" style="width:600px;display: none; clear: both; z-index: 99999;position:relative;clear:both">
					<form action="?lang=<?php echo $plang;?>&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=" method="post" name="frmsaphethdthoivu" id="frmsaphethdthoivu">
							<input type="hidden" name="LSEMPID" value="<?php echo $vStrPost;?>"/>
							
						</form>
						<form action="?lang=<?php echo $plang;?>&opt=5&item=&link=aHJfbHYwMDM4L2hyX2x2MDAzOC5waHA=" method="post" name="frmsaphethdthoivuhd" id="frmsaphethdthoivuhd">
							<input type="hidden" name="LSHDID" value="<?php echo $vStrPostHD;?>"/>
						</form>
						
					<!--<div style="float:left;width:400px">
						<p onclick="closepopcalendar('2')"><img width="20" src="../images/icon/close.png"></p>
						<table class="lvtable">
						<tr><td class="lvhtable">STT</td><td class="lvhtable">Mã</td><td class="lvhtable">Tên</td ></tr>
						<?php //echo $vStrLi;?>
						</table>
					</div>
					<div style="float:right;width:20px;color:red;cursor:pointer;overflow:hidden;"><p onclick="closepopcalendar('2')"><img width="20" src="../images/icon/close.png"></p>--></div>
</li>
					</div>
				</td>
				</tr>
				<tr>
				  <td> 
				  <div>
	<marquee onmouseover="this.stop()" onmouseout="this.start()">
	<?php
		echo $vStr;
?>
	</marquee>         
		</div>
		</td>
		</tr>
		</tbody>
		</table>
		<div >&nbsp;</div>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				<li class="home_title">
	<?php 
	$vStrLi='';
	$vStr='';
	$vStrPost='';
	$vCount=0;
	$slq="select * from (select A.lv001,A.lv002,A.lv003,A.lv004,DATEDIFF(B.lv005,'$vNow') State,(select count(*) from hr_lv0038 BB where BB.lv002=A.lv001 and BB.lv004>='$vNow') OverMore from hr_lv0020 A inner join hr_lv0038 B on A.lv001=B.lv002  where  B.lv004<='$vNow' and B.lv005>='$vNow' And B.lv005<=(DATE_ADD('$vNow',INTERVAL 30 DAY)) and B.lv009=1  and  A.lv009='5' and  year(A.lv044)<='2015')  MP where MP.State<=30 and MP.OverMore=0 order by MP.State Asc";
$vResult=db_query($slq);
while($vrow=db_fetch_array($vResult))
{
	$vCount++;
	 $vTitle=''; 
			if($plang=="EN")
			{
				if($vStrPost=="")
						$vStrPost=$vrow['lv001'].",";
					else
						$vStrPost=$vStrPost.$vrow['lv001'].",";
				$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td><a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv001']."</a></td><td>"."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."</a>"."</td><tr>";
				$vStr=$vStr."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."(".$vrow['lv001']." - ExpireDate:".$vrow['State']." day)</a>&nbsp;&nbsp;&nbsp;";
			}
			else 
			{
				if($vStrPost=="")
						$vStrPost=$vrow['lv001'].",";
					else
						$vStrPost=$vStrPost.$vrow['lv001'].",";
				$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td><a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv001']."</a></td><td>"."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."</a>"."</td><tr>";
				$vStr=$vStr."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>". $vrow['lv004']." ".$vrow['lv003']." ".$vrow['lv002']."(".$vrow['lv001']." - Ngày còn lại:".$vrow['State']." ngày)</a>&nbsp;&nbsp;&nbsp;";
			}
}
		  if($plang=="EN")
			{	
			 $vTitle='THOI VU - STAFF LISTS TO EXPIRE CONTRACT ('.$vCount.')';
			 echo $vTitle.(($vStrPost=='')?'':'<span  style="cursor:pointer" onclick="SendSubmit(document.frmsaphethd)">View</span>');// onclick="SendCheckApr(2,\''.$vTitle.'\')"
			}
		   else
		   {
		   	 $vTitle= 'THỜI VỤ - DANH SÁCH NHÂN VIÊN SẮP HẾT HẠN HỢP ĐỒNG ('.$vCount.')';
			 echo $vTitle.(($vStrPost=='')?'':'<span style="cursor:pointer" onclick="SendSubmit(document.frmsaphethd)">Xem</span>'); //onclick="SendCheckApr(2,\''.$vTitle.'\')"
		   }	
?> <div id="calendarview_2" class="viewcalandar" style="width:600px;display: none; clear: both; z-index: 99999;position:relative;clear:both">
					<form action="?lang=<?php echo $plang;?>&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=" method="post" name="frmsaphethd" id="frmsaphethd">
							<input type="hidden" name="LSEMPID" value="<?php echo $vStrPost;?>"/>
						</form>
					<!--<div style="float:left;width:400px">
						<p onclick="closepopcalendar('2')"><img width="20" src="../images/icon/close.png"></p>
						<table class="lvtable">
						<tr><td class="lvhtable">STT</td><td class="lvhtable">Mã</td><td class="lvhtable">Tên</td ></tr>
						<?php //echo $vStrLi;?>
						</table>
					</div>
					<div style="float:right;width:20px;color:red;cursor:pointer;overflow:hidden;"><p onclick="closepopcalendar('2')"><img width="20" src="../images/icon/close.png"></p>--></div>
</li>
					</div>
				</td>
				</tr>
				<tr>
				  <td> 
				  <div>
	<marquee onmouseover="this.stop()" onmouseout="this.start()">
	<?php
		echo $vStr;
?>
	</marquee>         
		</div>
		</td>
		</tr>
		</tbody>
		</table>
		<div >&nbsp;</div>
<script language="javascript">
function SendSubmit(o)
{
o.submit();
}
</script>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
<tbody><tr>
<td class="titlerow" style="color:#000;font-weight:bold">
<div style="clear:both">
			<li class="home_title">
<?php 
	  $vTitle=''; 
	  if($plang=="EN")
		{	
		  $vTitle= 'LIST EMPLOYEE NOT ACTIVE CONTRACT OR MORE 1 ACTIVE CONTRACT TO CALCULATE SALARY('.$vCount.')';
		  echo  $vTitle.(($vStrPost=='')?'':'<span style="cursor:pointer" onclick="SendSubmit(document.frmchuakhoahdthoivu)">View</span>');//onclick="SendCheckApr(1,\''.$vTitle.'\')"
		}
	   else
	   {
			 $vTitle= 'THỜI VỤ - DANH SÁCH NHÂN VIÊN CHƯA KÍCH HOẠT HỢP ĐỒNG TRONG THÁNG HOẶC HƠN 1 HỢP ĐỒNG CHO PHÉP TÍNH LƯƠNG('.$vCount.')';
		  echo  $vTitle.(($vStrPost=='')?'':'<span style="cursor:pointer" onclick="SendSubmit(document.frmchuakhoahdthoivu)">Xem</span>');//onclick="SendCheckApr(1,\''.$vTitle.'\')"
	   }	
?> 
			<div id="calendarview_11" class="viewcalandar" style="width:600px;display: none; clear: both; z-index: 99999;position:relative;clear:both">
					<form action="?lang=<?php echo $plang;?>&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=" method="post" name="frmchuakhoahdthoivu" id="frmchuakhoahdthoivu">
						<input type="hidden" name="LSEMPID" value="<?php echo $vStrPost;?>"/>
					</form>
			<!--	<div style="float:left;width:400px">
					<p onclick="closepopcalendar('1')"><img width="20" src="../images/icon/close.png"></p>
					<table class="lvtable">
					<tr><td class="lvhtable">STT</td><td class="lvhtable">Mã</td><td class="lvhtable">Tên</td ></tr>
					<?php //echo $vStrLi;?>
					</table>
				</div>
				<div style="float:right;width:20px;color:red;cursor:pointer;overflow:hidden;">--></div>
</li>
				</div>
			</td>
			</tr>
			<tr>
			  <td>      
			  <div style="width:100%">
<marquee onmouseover="this.stop()" onmouseout="this.start()">
<?php
	echo $vStr;
?>
</marquee>      
	</div>
	</td>
	</tr>
	</tbody>
	</table>	

<div >&nbsp;</div>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				<li class="home_title">
	<?php 
	$vStrLi='';
	$vStr='';
	$vStrPost='';
	$vCount=0;
	$slq="select * from (select A.lv001,A.lv002,A.lv003,A.lv004,A.lv015,A.lv018 State,DATEDIFF(concat(year(CURRENT_DATE()),'-',month(lv015),'-',day(lv015)),CURRENT_DATE()) DAYRE  from hr_lv0020 A  where  DATEDIFF(concat(year(CURRENT_DATE()),'-',month(lv015),'-',day(lv015)),CURRENT_DATE())>=0 and DATEDIFF(concat(year(CURRENT_DATE()),'-',month(lv015),'-',day(lv015)),CURRENT_DATE())<=7  AND A.lv009 not in (2,3,7)) MP order by MP.DAYRE asc";
$vResult=db_query($slq);
while($vrow=db_fetch_array($vResult))
{
	$vCount++;
			if($plang=="EN")
			{
				
				$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td>".$vrow['lv001']."</a></td><td>"."".$vrow['lv004']." ".$vrow['lv003']." ".$vrow['lv002']."</a>"."</td><td>".$mohr_lv0038->FormatView($vrow['lv015'],2)."</td><td>".(($vrow['DAYRE']==0)?'Today':$vrow['DAYRE']." days")."</td><tr>";
				$vStr=$vStr.$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."(".$vrow['lv001']." - ExpireDate:".(($vrow['DAYRE']==0)?'Today':$vrow['DAYRE']." days")."(".$mohr_lv0038->FormatView($vrow['lv015'],2).") )&nbsp;&nbsp;&nbsp;";
			}
			else 
			{
				$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td>".$vrow['lv001']."</a></td><td>"."".$vrow['lv004']." ".$vrow['lv003']." ".$vrow['lv002']."</a>"."</td><td>".$mohr_lv0038->FormatView($vrow['lv015'],2)."</td><td>".(($vrow['DAYRE']==0)?'Hôm nay':$vrow['DAYRE']." ngày")."</td><tr>";
				$vStr=$vStr.$vrow['lv004']." ".$vrow['lv003']." ".$vrow['lv002']."(".$vrow['lv001']." - Ngày còn lại:".(($vrow['DAYRE']==0)?'Hôm nay':$vrow['DAYRE']." ngày")."(".$mohr_lv0038->FormatView($vrow['lv015'],2)."))</a>&nbsp;&nbsp;&nbsp;";
			}
}
		  $vTitle=''; 
		  if($plang=="EN")
			{	
			 $vTitle= 'STAFF LIST BEFORE 7 DAYS BIRTHDAY ('.$vCount.')';
			 echo $vTitle.'<span style="cursor:pointer" onclick="SendCheckApr(3,\''.$vTitle.'\')">View</span>';
			}
		   else
		   {
		   	 $vTitle= 'DANH SÁCH NHÂN VIÊN SẮP SINH NHẬT TRƯỚC 7 NGÀY ('.$vCount.')';
			 echo $vTitle.'<span style="cursor:pointer" onclick="SendCheckApr(3,\''.$vTitle.'\')">Xem</span>';
		   }	
?> <div id="calendarview_3" class="viewcalandar" style="width:600px;width:600px;display: none; clear: both; z-index: 99999;position:relative;clear:both">
					<!--<div style="float:left;width:400px">-->
					<p onclick="closepopcalendar('3')"><img width="20" src="../images/icon/close.png"></p>
						<table class="lvtable">
						<tr><td class="lvhtable">STT</td><td class="lvhtable">Mã</td><td class="lvhtable">Tên</td ><td class="lvhtable">Ngày Sinh</td ><td class="lvhtable">Ngày còn lại</td ></tr>
						<?php echo $vStrLi;?>
						</table>
					<!--</div>
					<div style="float:right;width:20px;color:red;cursor:pointer;overflow:hidden;"><p onclick="closepopcalendar('3')"><img width="20" src="../images/icon/close.png"></p>--></div>
</li>
					</div>
				</td>
				</tr>
				<tr>
				  <td>      
				  <div style="width:100%">
	<marquee onmouseover="this.stop()" onmouseout="this.start()">
	<?php
		echo $vStr;
?>
	</marquee>
	</div>
		</td>
		</tr>
		</tbody>
		</table>
<?php 
}
?>
<div >&nbsp;</div>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				<li class="home_title">
	<?php 
	$vStrLi='';
	$vStr='';
	$vStrPost='';
	$vCount=0;
	$slq="select A.lv001,A.lv015,A.lv002,A.lv003,A.lv004,A.lv018 State,(DATEDIFF(CURRENT_DATE(),DATE_ADD(lv015,INTERVAL 0 DAY))) DAYRE  from hr_lv0020 A  where ((A.lv018=1 and (DATEDIFF(CURRENT_DATE(),DATE_ADD(lv015,INTERVAL -60 DAY))/365.25)>=60) or (A.lv018=0 and (DATEDIFF(CURRENT_DATE(),DATE_ADD(lv015,INTERVAL -60 DAY))/365.25)>=55))  AND A.lv009 not in (2,3,7)";
$vResult=db_query($slq);

while($vrow=db_fetch_array($vResult))
{
	$vCount++;
			if($plang=="EN")
			{
				$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td>".$vrow['lv001']."</td><td>"."".$vrow['lv004']." ".$vrow['lv003']." ".$vrow['lv002'].""."</td><td>".$mohr_lv0038->FormatView($vrow['lv015'],2)."</td><td>".((($vrow['State']==1)?60*365+15:55*365+14)-$vrow['DAYRE'])."</td><tr>";
				$vStr=$vStr.$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."(".$vrow['lv001']." - ExpireDate:".((($vrow['State']==1)?60*365+15:55*365+14)-$vrow['DAYRE'])." day)&nbsp;&nbsp;&nbsp;";
			}
			else 
			{
				$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td>".$vrow['lv001']."</td><td>"."".$vrow['lv004']." ".$vrow['lv003']." ".$vrow['lv002'].""."</td><td>".$mohr_lv0038->FormatView($vrow['lv015'],2)."</td><td>".((($vrow['State']==1)?60*365+15:55*365+14)-$vrow['DAYRE'])."</td><tr>";
				$vStr=$vStr.$vrow['lv004']." ".$vrow['lv003']." ".$vrow['lv002']."(".$vrow['lv001']." - Ngày còn lại:".((($vrow['State']==1)?60*365+15:55*365+14)-$vrow['DAYRE'])." ngày)&nbsp;&nbsp;&nbsp;";
			}
}
		  $vTitle=''; 
		  if($plang=="EN")
			{	
			 $vTitle= 'STAFF LIST BEFORE 60 DAYS RETIRING ('.$vCount.')';
			 echo $vTitle.'<span style="cursor:pointer" onclick="SendCheckApr(4,\''.$vTitle.'\')">View</span>';
			}
		   else
		   {
		   	 $vTitle= 'DANH SÁCH NHÂN VIÊN SĂP NGHỈ HƯU TRƯỚC 60 NGÀY ('.$vCount.')';
			 echo $vTitle.'<span style="cursor:pointer" onclick="SendCheckApr(4,\''.$vTitle.'\')">Xem</span>';
		   }	
?> <div id="calendarview_4" class="viewcalandar" style="width:600px;display: none; clear: both; z-index: 99999;position:relative;clear:both">
					<!--<div style="float:left;width:400px">-->
						<p onclick="closepopcalendar('4')"><img width="20" src="../images/icon/close.png"></p>
						<table class="lvtable">
						<tr><td class="lvhtable">STT</td><td class="lvhtable">Mã</td><td class="lvhtable">Tên</td ><td class="lvhtable">Ngày sinh</td ><td class="lvhtable">Ngày còn lại</td ></tr>
						<?php echo $vStrLi;?>
						</table>
					<!--</div>
					<div style="float:right;width:20px;color:red;cursor:pointer;overflow:hidden;"><p onclick="closepopcalendar('4')"><img width="20" src="../images/icon/close.png"></p>--></div>
</li>
					</div>
				</td>
				</tr>
				<tr>
				  <td>      
				  <div style="width:100%">
	<marquee onmouseover="this.stop()" onmouseout="this.start()">
	<?php
		echo $vStr;
?>
	</marquee>
	</div>
		</td>
		</tr>
	</tbody>
</table>
<?php 
require_once("../clsall/hr_lv0027.php");
$mohr_lv0027=new hr_lv0027($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0054');
if($mohr_lv0038->GetView()==1)
{
?>
<div >&nbsp;</div>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				<li class="home_title">
	<?php 
	$vStrLi='';
	$vStr='';
	$vStrPost='';
	$vCount=0;
	$slq="select * from (select A.lv001,A.lv002,A.lv003,A.lv004,DATEDIFF(B.lv007,'$vNow') State  from hr_lv0020 A inner join hr_lv0027 B on A.lv001=B.lv002  where  B.lv006<='$vNow' and B.lv007>='$vNow' and  A.lv009 not in (2,3,7)) MP where MP.State<=60 order by MP.State Asc";
$vResult=db_query($slq);
while($vrow=db_fetch_array($vResult))
{
	$vCount++;
	 $vTitle=''; 
			if($plang=="EN")
			{
				if($vStrPost=="")
						$vStrPost=$vrow['lv001'].",";
					else
						$vStrPost=$vStrPost.$vrow['lv001'].",";
				$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td><a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv001']."</a></td><td>"."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."</a>"."</td><tr>";
				$vStr=$vStr."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."(".$vrow['lv001']." - ExpireDate:".$vrow['State']." day)</a>&nbsp;&nbsp;&nbsp;";
			}
			else 
			{
				if($vStrPost=="")
						$vStrPost=$vrow['lv001'].",";
					else
						$vStrPost=$vStrPost.$vrow['lv001'].",";
				$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td><a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv001']."</a></td><td>"."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>".$vrow['lv002']." ".$vrow['lv003']." ".$vrow['lv004']."</a>"."</td><tr>";
				$vStr=$vStr."<a href=\"?lang=".$plang."&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=&EmpID=".$vrow['lv001']."\"  style='color:none;'>". $vrow['lv004']." ".$vrow['lv003']." ".$vrow['lv002']."(".$vrow['lv001']." - Ngày còn lại:".$vrow['State']." ngày)</a>&nbsp;&nbsp;&nbsp;";
			}
}
		  if($plang=="EN")
			{	
			 $vTitle='STAFF LISTS TO EXPIRE VISA,PASSPORT 60 DAYS ('.$vCount.')';
			 echo $vTitle.(($vStrPost=='')?'':'<span  style="cursor:pointer" onclick="SendSubmit(document.frmvisa)">View</span>');// onclick="SendCheckApr(2,\''.$vTitle.'\')"
			}
		   else
		   {
		   	 $vTitle= 'DANH SÁCH NHÂN VIÊN SẮP HẾT HẠN VISA,PASSPORT TRƯỚC 60 NGÀY('.$vCount.')';
			 echo $vTitle.(($vStrPost=='')?'':'<span style="cursor:pointer" onclick="SendSubmit(document.frmvisa)">Xem</span>'); //onclick="SendCheckApr(2,\''.$vTitle.'\')"
		   }	
?> <div id="calendarview_27" class="viewcalandar" style="width:600px;display: none; clear: both; z-index: 99999;position:relative;clear:both">
					<form action="?lang=<?php echo $plang;?>&opt=5&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=" method="post" name="frmvisa" id="frmvisa">
							<input type="hidden" name="LSEMPID" value="<?php echo $vStrPost;?>"/>
						</form>
					<!--<div style="float:left;width:400px">
						<p onclick="closepopcalendar('2')"><img width="20" src="../images/icon/close.png"></p>
						<table class="lvtable">
						<tr><td class="lvhtable">STT</td><td class="lvhtable">Mã</td><td class="lvhtable">Tên</td ></tr>
						<?php //echo $vStrLi;?>
						</table>
					</div>
					<div style="float:right;width:20px;color:red;cursor:pointer;overflow:hidden;"><p onclick="closepopcalendar('2')"><img width="20" src="../images/icon/close.png"></p>--></div>
</li>
					</div>
				</td>
				</tr>
				<tr>
				  <td> 
				  <div>
	<marquee onmouseover="this.stop()" onmouseout="this.start()">
	<?php
		echo $vStr;
?>
	</marquee>         
		</div>
		</td>
		</tr>
		</tbody>
		</table>
<?php
}		
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
require_once("../clsall/rp_lv0016.php");
$morp_lv0016=new  rp_lv0016($_SESSION['BINHDIENRRight'],$_SESSION['BINHDIENRUserID'],'Rp0016');
if($mohr_lv0038->GetView()==1)
{
$vrnd=2;
?>
<script type="text/javascript">
	
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
function RunChar()
{
 	var o=document.frmhome;
	o.txtstate.value=getChecked(o.chklv009.value,'chklv009');
	document.frmhome.submit()
}
</script>
<div >&nbsp;</div>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				
	 <form name="frmhome" method="get">
	<?php 
	
		  $vTitle=''; 
		  if($plang=="EN")
			{	

					echo 'STAFFING SITUATION IN THIS YEAR ';
			}
		   else
		   {
				echo 'LƯỢC ĐỒ BIẾN ĐỘNG NHÂN SỰ TRONG NĂM ';
		   }
if(!isset($_GET['txtstate']))
{
	$morp_lv0016->lv009='0,1,2,3,4,5,6,7,8,9';
	$_GET['txtstate']='0,1,2,3,4,5,6,7,8,9';
}
else
	$morp_lv0016->lv009=$_GET['txtstate'];		   
$vtxtDay=$_GET['txtDay'];		
if($vtxtDay=="" || $vtxtDay==NULL) $vtxtDay= getday($vNow);
$vtxtMonth=$_GET['txtMonth'];		   
if($vtxtMonth=="" || $vtxtMonth==NULL) $vtxtMonth= getmonth($vNow);
		   ?>
		  
		   <input type="hidden" name="lang" value="<?php echo $_GET['lang'];?>"/>
		   <input type="hidden" name="opt" value="<?php echo $_GET['opt'];?>"/>
		    <select name="txtDay">
				<?php
				for($i=1;$i<=31;$i++)
				{
				echo '<option value="'.(Fillnum($i,2)).'" '.(($vtxtDay==$i)?'selected="selected"':'').'>'.(Fillnum($i,2)).'</option>';
				}
				?>
			</select>
		   <select name="txtMonth">
				<?php
				for($i=1;$i<=12;$i++)
				{
				echo '<option value="'.Fillnum($i,2).'" '.(($vtxtMonth==$i)?'selected="selected"':'').'>'.(Fillnum($i,2)).'</option>';
				}
				?>
			</select>
		   <select name="txtYear" >
				<?php
				$vtxtYear=$_GET['txtYear'];
				$vyear=(int)getyear($vNow);
				
				for($i=0;$i<=15;$i++)
				{
				echo '<option value="'.($vyear-$i).'" '.(($vtxtYear==($vyear-$i))?'selected="selected"':'').'>'.($vyear-$i).'</option>';
				}
				?>
			</select>
			<input type="button" value="Xem" onclick="RunChar();"/>
			<div style="height:190px;overflow:auto">
				<div style="float:left;width:120px;">
				<?php if($plang=="EN")
			{	
				echo 'Option state of staff';
			}
			else
			{
				echo 'Chọn trạng thái nhân viên';
			}
			?>
				</div>
				<div style="float:left;width:auto;">
					<?php echo $morp_lv0016->GetBuilCheckList($morp_lv0016->lv009,'chklv009',10,'hr_lv0022');?>
				</div>
			</div>
			<input type="hidden" name="txtstate" value="<?php echo $_GET['txtstate'];?>"/>
			
		</form>
	</li>
					</div>
				</td>
				</tr>
				<tr>
				  <td>      
				  <div style="width:100%">
		<img src="charthr<?php echo $vrnd;?>.php?lang=<?php echo $plang;?>&txtYear=<?php echo $_GET['txtYear'];?>&txtMonth=<?php echo $_GET['txtMonth'];?>&txtDay=<?php echo $_GET['txtDay'];?>&txtstate=<?php echo $_GET['txtstate'];?>" width="100%" />
		</div>
		</td>
		</tr>
		</tbody>
		</table>
<?php 
}
if($mohr_lv0038->GetView()==1)
{
$vrnd=1;
?>
<div >&nbsp;</div>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				<li class="home_title">
	<?php 
	
		  $vTitle=''; if($plang=="EN")
			{	

					echo 'STAFFING SITUATION LAST 15 YEARS';

			}
		   else
		   {
				echo 'LƯỢC ĐỒ BIẾN ĐỘNG NHÂN SỰ 15 NĂM GẦN ĐÂY';

		   }	
		   ?>
	</li>
					</div>
				</td>
				</tr>
				<tr>
				  <td>      
				  <div style="width:100%">
		<img src="charthr1.php?lang=<?php echo $plang;?>&txtstate=<?php echo $_GET['txtstate'];?>" width="100%" />
		</div>
		</td>
		</tr>
		</tbody>
		</table>
<?php 
}
if($_POST['txtthemes']!="")
	{
		$themes=$_POST['themes'];
		GetUserThemeUpdate($_SESSION['ERPSOFV2RUserID'],$themes);
	}
	else
		$themes=getInfor($_SESSION['ERPSOFV2RUserID'],99);
	if($themes=='')	$themes='lvhrcss';
?>
	<script language="javascript">

		function SendCheckApr(codeid,vTitle)
		{
			var o=document.getElementById('calendarview_'+codeid);
			o.style.display="block";
		}
		function closepopcalendar(codeid)
		{
			var o=document.getElementById('calendarview_'+codeid);
			o.style.display="none";
		}
		function openWD(codeid,vTitle)
		{
			var myWindow = window.open("","MsgWindow"+codeid, "toolbar=yes, scrollbars=yes, resizable=yes, width=auto, height=auto");
			var strcss='<link rel="stylesheet" href="../css/<?php echo $themes;?>.css" type="text/css">';
			var o=document.getElementById('calendarview_'+codeid);
			
			myWindow.document.write(strcss);
			myWindow.document.write('<div class="lv0" align="center">'+vTitle+'</div>');
			myWindow.document.write(o.innerHTML);
		}
</script>
<style>
.home_title
{
	font-weight:bold;
	padding:10px;
	padding-left:20px;
	background:url(pointer.png) no-repeat;
	list-style:none;
}		
		table.ftable
{
	background-color:#fff;
	width:100%;
	text-align:left;
	margin:0 auto;
}
table.ftable tr
{

}
table.f_table tr:nth-child(even) 
{
	background-color:#f0f0f0;
}
table.ftable tr td
{
	padding:8px 15px 8px 15px;
}
table.sftable tr td
{
	padding:2px 10px 2px 10px;
}
table.f_table tr td
{
	padding:6px 15px 6px 15px;
}
table.ftable tr td.grey
{
	background-color:#f0f0f0;
}
.ftable table
{
	width:100%;
}
td.editor table tr td
{
	padding:0px !important;
}
td.titlerow,tr.titlerow
{
	background-color:#fff !important;
	border-bottom:1px #e5e5e5 solid;
}
#tab_notice li:hover
{
	color:#0485be !important;
}
#sof_pages  .sof_pages_content
{
	background:#fff;
	text-align:left;
	padding:10px;
	padding-left:0px;
	padding-right:0px;
}
</style>