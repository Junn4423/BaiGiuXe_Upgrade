	<?php 
	require_once("../clsall/lv_controler.php");
	require_once("../clsall/hr_lv0038.php");
	$plang=$_GET['lang'];
	if($plang!="VN" || $plang=="")
	$plang="EN";
	$vNow=GetServerDate();
	?>
	<style>
	.cssTabAlarm {
		animation-name: example;
		animation-duration: 4s;
		animation-iteration-count:infinite;
		animation-direction: alternate;
	}
	@keyframes example {
	0%   {background-color:#f3b12b; left:0px; top:0px;}
	25%  {background-color:#F8D66E; left:200px; top:0px;}
	50%  {background-color:#F68420; left:200px; top:200px;}
	75%  {background-color:#F8D66E; left:0px; top:200px;}
	100% {background-color:#f3b12b; left:0px; top:0px;}
	}
	</style>
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
	<div id='lv_introduce_header' style="display:none">
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
	Địa chỉ: Số 69/9, Đường D9, Phường Tây Thạnh, Quận Tân Phú, TP. Hồ Chí Minh
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
	require_once("../clsall/hr_lv0020.php");
	$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
	$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0046');
	if($mohr_lv0020->GetView()==1)
	{
		$lvhr_lv0038=new hr_lv0038('admin','admin','Hr0046');
		$mohr_lv0020->mohr_lv0038=$lvhr_lv0038;
		$mohr_lv0020->LV_AutoRunAuto();
	}
	$vNow=GetServerDate();
	require_once("../clsall/jo_lv0004.php");
	require_once("../clsall/jo_lv0008.php");
	require_once("../clsall/jo_lv0012.php");
	require_once("../clsall/cr_lv0218.php");
	require_once("../clsall/cr_lv0146.php");
	$vSoLanShow=0;
	$vShowDauTien=-1;
	?>
	<input id="curTabView" name="curTabView" type="hidden" value="<?php echo $_POST['curTabView'];?>"/>
		<table border="0" width="100%">
			<tbody>
				<tr>
					<td align="left" id="TabViewHr">
						<div style1="width:100%;max-height:40px;overflow:auto">
							<ul class="IdTabViewHr IdTabViewHrHome">
								<li><div id="hrtab_21" class="cssTab <?php echo $vAlarms;?>" onclick="RunDisableAll(21)"  title="<?php echo $vAlarms;?>" style="<?php echo $vAlarm;?>"><font style="font-size:14px!important">Cảnh báo chung<?php echo ($vCount>0)?"($vCount)":'';?></font></div></li>
								<?php
								$mocr_lv0146=new cr_lv0146($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0146');
								if($mocr_lv0146->GetView()==1)
								{
									if($vShowDauTien==-1) $vShowDauTien=15;
									$vSoLanShow++;
									
									$vAlarm='cssTabAlarm';
								?>
								<li><div id="hrtab_15" class="cssTab <?php echo $vAlarms;?>" onclick="RunDisableAll(15)"  title="<?php echo $vAlarms;?>" style="<?php echo $vAlarm;?>"><font style="font-size:14px!important">Xem giờ công<?php echo ($vCount>0)?"($vCount)":'';?></font></div></li>
								<?php
								}
								$mojo_lv0004=new jo_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
								$mojo_lv0004->lv015=$mojo_lv0004->LV_UserID;
								if($mojo_lv0004->GetAdd()==1)
								{
									if($vShowDauTien==-1) $vShowDauTien=3;
									$vSoLanShow++;
									//$vCount=$mojo_lv0004->GetCountWaitFull();
									$mojo_lv0004->CountAlarm=$vCount;
									if($vCount==0)
										$vAlarms='';
									else
										$vAlarms='cssTabAlarm';//-webkit-animation: glowing 1500ms infinite;-moz-animation: glowing 1500ms infinite;-o-animation: glowing 1500ms infinite;animation: glowing 1500ms infinite;';	
								?>
								<li><div id="hrtab_3" class="cssTab <?php echo $vAlarms;?>" onclick="RunDisableAll(3)"  title="<?php echo $vAlarms;?>" style="<?php echo $vAlarm;?>"><font style="font-size:14px!important">Xin phép<?php echo ($vCount>0)?"($vCount)":'';?></font></div></li>
								<?php
								}
								$mojo_lv0008=new jo_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0008');
							
								$mojo_lv0008->lv013=$mojo_lv0008->LV_UserID;
								if($mojo_lv0008->GetApr()==1)
								{
									
									$vSoLanShow++;
									$vCount=$mojo_lv0008->GetCount();
									$mojo_lv0008->CountAlarm=$vCount;
									if($vCount==0)
										$vAlarms='';
									else
										$vAlarms='cssTabAlarm';//-webkit-animation: glowing 1500ms infinite;-moz-animation: glowing 1500ms infinite;-o-animation: glowing 1500ms infinite;animation: glowing 1500ms infinite;';	
									if($vCount>0)
									{	
										if($vShowDauTien==-1) $vShowDauTien=4;
								?>
								<li><div id="hrtab_4" class="cssTab <?php echo $vAlarms;?>" onclick="RunDisableAll(4)"  title="<?php echo $vAlarms;?>" style="<?php echo $vAlarm;?>"><font style="font-size:14px!important">Duyệt phép<?php echo ($vCount>0)?"($vCount)":'';?></font></div></li>
								<?php
									}
								}
								$mojo_lv0012=new jo_lv0012($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0012');
								if($mojo_lv0012->GetApr()==1)
								{
									
									$vSoLanShow++;
									$vCount=$mojo_lv0012->GetCount();
									$mojo_lv0012->CountAlarm=$vCount;
									if($vCount==0)
										$vAlarms='';
									else
										$vAlarms='cssTabAlarm';//-webkit-animation: glowing 1500ms infinite;-moz-animation: glowing 1500ms infinite;-o-animation: glowing 1500ms infinite;animation: glowing 1500ms infinite;';	
									if($vCount>0)
									{	
										if($vShowDauTien==-1) $vShowDauTien=5;
								?>
								<li><div id="hrtab_5" class="cssTab <?php echo $vAlarms;?>" onclick="RunDisableAll(5)"  title="<?php echo $vAlarms;?>" style="<?php echo $vAlarm;?>"><font style="font-size:14px!important">BGĐ duyệt phép<?php echo ($vCount>0)?"($vCount)":'';?></font></div></li>
								<?php
									}
								}
								
								$mocr_lv0218=new cr_lv0218($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0218');
								if($mocr_lv0218->GetApr()==1)
								{
									if($vShowDauTien==-1) $vShowDauTien=19;
									$vSoLanShow++;
									$vCount=$mocr_lv0218->GetCount();
									
									$mocr_lv0218->CountAlarm=$vCount;
									$vAlarm='cssTabAlarm';
								?>
								<li><div id="hrtab_19" class="cssTab <?php echo $vAlarms;?>" onclick="RunDisableAll(19)"  title="<?php echo $vAlarms;?>" style="<?php echo $vAlarm;?>"><font style="font-size:14px!important">Duyệt bảng công<?php echo ($vCount>0)?"($vCount)":'';?></font></div></li>
								<?php
								}
	
								?>
							</ul>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<?php	
		if($mocr_lv0146->GetView()==1)
		{
		?>
		<div id="cl_15_1" style="display:none">
			<input type="hidden" name="cl_15_2" id="cl_15_2" value="home.php?lang=VN&opt=27&item=&link=Y3JfbHYwMTQ2L2NyX2x2MDE0Ni5waHA="/>
			<iframe  name="cl_15_3" id="cl_15_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
		</div>
		<?php
		}
		if($mocr_lv0218->GetView()==1)
		{
		?>
			<div id="cl_19_1" style="display:none">
				<input type="hidden" name="cl_19_2" id="cl_19_2" value="home.php?lang=VN&opt=8&item=&link=Y3JfbHYwMjE4L2NyX2x2MDIxOC5waHA=&ThongSoLuong=<?php echo $mocr_lv0218->ThongSoLuong;?>"/>
				<iframe  name="cl_19_3" id="cl_19_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
			</div>
		<?php			
		}
		?>
		<div id="cl_21_1" style="display:none">
			<input type="hidden" name="cl_21_2" id="cl_21_2" value="displayns.php?lang=VN"/>
			<iframe  name="cl_21_3" id="cl_21_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
		</div>
		<?php
		if($mojo_lv0004->GetAdd()==1)
		{
		?>
		<div id="cl_3_1" style="display:none">
			<input type="hidden" name="cl_3_2" id="cl_3_2" value="home.php?lang=VN&opt=27&item=&link=am9fbHYwMDA0L2pvX2x2MDAwNF8wLnBocA=="/>
			<iframe name="cl_3_3" id="cl_3_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
		</div>
		<?php
		}
		if($mojo_lv0008->GetApr()==1)
		{
		?>
		<div id="cl_4_1" style="display:none">
			<input type="hidden" name="cl_4_2" id="cl_4_2" value="home.php?lang=VN&opt=27&item=&link=am9fbHYwMDA4L2pvX2x2MDAwOC5waHA="/>
			<iframe name="cl_4_3" id="cl_4_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
		</div>
		<?php
		}
		if($mojo_lv0012->GetApr()==1)
		{
		?>
		<div id="cl_5_1" style="display:none">
			<input type="hidden" name="cl_5_2" id="cl_5_2" value="home.php?lang=VN&opt=27&item=&link=am9fbHYwMDEyL2pvX2x2MDAxMi5waHA="/>
			<iframe name="cl_5_3" id="cl_5_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
		</div>
		<?php
		}
	?>
		
		<script language="javascript">
	function RunDisableAll(cur)
	{
		var obj_left=parent.document.getElementById("sof_left");
		if(obj_left!=null) sof_left=obj_left.style.height;
		var o=document.getElementById("curTabView");
		o.value=cur;
		var vAlarm='-webkit-animation: glowing 1500ms infinite;-moz-animation: glowing 1500ms infinite;-o-animation: glowing 1500ms infinite;animation: glowing 1500ms infinite;';	
		for(var js=0;js<=49;js++)
		{
			var o1=document.getElementById("cl_"+js+"_1");
			var h1=document.getElementById("cl_"+js+"_2");
			var if1=document.getElementById("cl_"+js+"_3");
			var o3=document.getElementById("hrtab_"+js);
			if(cur==js)
			{
				if(o1!=null) 
				{
					if(sof_left!='') if1.style.height=sof_left;
					o1.style.display="block";
					if1.src=h1.value;
				}
				if(o3!=null) 
				{
					o3.style='';
					o3.className="curshow";
				}
				
			}
			else
			{
				if(o1!=null) 
				{
					o1.style.display="none";
					//if1.src=h1.value;
				}
				if(o3!=null) 
				{
					//o3.style=o3.title;
					o3.className="cssTab "+o3.title;
				}
			}
		}	
	}
	function jobshow(cur)
	{
		for(var js=0;js<=49;js++)
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
	<?php
	if(($vSoLanShow>0))
	{
		if(!isset($_POST['curTabView']))
		{
			$_POST['curTabView']=$vShowDauTien;
		}
	?>
	setTimeout("RunDisableAll(<?php echo (int)$_POST['curTabView'];?>)",100);
	<?php
	}
	?>
	</script>
	<?php
	require_once("../clsall/tc_lv0009.php");
	$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0064');
	require_once("../clsall/tc_lv0064.php");
	$motc_lv0064=new tc_lv0064($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0064');
	require_once("../clsall/tc_lv0013.php");
	$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
	if($motc_lv0013->GetApr()==1 && $motc_lv0013->GetUnApr()==1)
	{
		if(isset($_POST['txtCalID']))
		{
			$motc_lv0013->LV_SetCal($_POST['txtCalID']);
		}
		$motc_lv0013->LV_GetCal();
		/*
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
					<option value=""></option>
					<?php echo $motc_lv0013->LV_LinkField('lv999',$motc_lv0013->lv999);?>
				</select>
				<input type="submit" value="Chọn ngay" onclick="document.frmcalculate.submit()"/>
			</td>
			</tr>
			</tbody>
			</table>	
	<?php
			*/
	}
	if(getday($vNow)==20 || getday($vNow)==21 || getday($vNow)==22 || getday($vNow)==28)
	{
		$lvtc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
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
			$motc_lv0009->LV_UpdatePreHSo(getmonth($vNow),getyear($vNow));
		}
		$lvtc_lv0013->LV_LoadID($vCalID);
		$lvtc_lv0013->LV_UpdateFinishAuto($lvtc_lv0013->lv001);
		if($lvtc_lv0013->lv101==0)
		{
			$motc_lv0064->objtc_lv0013=$lvtc_lv0013;
			$motc_lv0064->LV_Aproval($lvtc_lv0013->lv001);
		}
	}
	require_once("../clsall/hr_lv0098.php");
	$mohr_lv0098=new hr_lv0098($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0098');
	if($mohr_lv0098->GetView()==1)
	{
		$mohr_lv0098->LV_AcceptDept();
	}
	
	if($mohr_lv0038->GetView()==1)
	{
		$mohr_lv0038->LV_AcceptPreActive();

	
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