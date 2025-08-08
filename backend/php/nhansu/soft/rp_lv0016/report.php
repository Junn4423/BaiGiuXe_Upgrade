<?php
session_start();
$mohr_lv0020->isWork=$_POST['txtlvwork'];
$sExport=$_GET['func'];
$vNames="employees";
switch($mohr_lv0020->isWork)
{
	case 0:
		$vNames="dsnv_ngavaolam";
		break;
	case 1:
		$vNames="dsnv_nganghiviec";
		break;
	case 2:
		$vNames="dsnv_sinhnhatnhanvien";
		break;
	case 3:
		$vNames="dsnv_khenthuong_canhcao";
		break;
	case 4:
		$vNames="dsnv_dangkyphuthuoc";
		break;
	case 5:
		$vNames="dsnv_connhanvien";
		break;
}
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename='.$vNames.'.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename='.$vNames.'.doc');
}
if($sExport=="pdf"){
//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="'.$vNames.'.pdf"');
}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0020.php");

/////////////init object//////////////
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0016');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","AD0025.txt",$plang);
$mohr_lv0020->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0020->isWork=$_POST['txtlvwork'];
$mohr_lv0020->isPhuThuoc=$_POST['txtlvphuthuoc'];
$mohr_lv0020->isuptoyearold=$_POST['txtlvuptoyearold'];
$mohr_lv0020->isbirthday=$_POST['isbirthday'];
if($mohr_lv0020->isWork==2)
	$mohr_lv0020->ArrPush[0]='DANH SÁCH NHÂN VIÊN THEO SINH NHẬT';
elseif($mohr_lv0020->isWork==3)
	$mohr_lv0020->ArrPush[0]='DANH SÁCH NHÂN VIÊN KHEN THƯỞNG & CẢNH CÁO';
elseif($mohr_lv0020->isWork==4)
	$mohr_lv0020->ArrPush[0]='DANH SÁCH NHÂN VIÊN ĐĂNG KÝ PHỤ THUỘC';
elseif($mohr_lv0020->isWork==5)
	$mohr_lv0020->ArrPush[0]='DANH SÁCH CON NHÂN VIÊN';	
elseif($mohr_lv0020->isWork==1)
	$mohr_lv0020->ArrPush[0]='DANH SÁCH NHÂN VIÊN THEO NGÀY NGHỈ VIỆC';
elseif($mohr_lv0020->isWork==0)
	$mohr_lv0020->ArrPush[0]='DANH SÁCH NHÂN VIÊN THEO NGÀY VÀO LÀM';
elseif($mohr_lv0020->isWork==8)
	$mohr_lv0020->ArrPush[0]='BÁO CÁO BIẾN ĐỘNG NHÂN VIỆN THEO PHÒNG BAN';	
else
$mohr_lv0020->ArrPush[0]=$vLangArr[17];
$mohr_lv0020->ArrPush[1]=$vLangArr[18];
$mohr_lv0020->ArrPush[2]=$vLangArr[19];
$mohr_lv0020->ArrPush[3]=$vLangArr[20];
$mohr_lv0020->ArrPush[4]=$vLangArr[21];
$mohr_lv0020->ArrPush[5]=$vLangArr[22];
$mohr_lv0020->ArrPush[6]=$vLangArr[23];
$mohr_lv0020->ArrPush[7]=$vLangArr[24];
$mohr_lv0020->ArrPush[8]=$vLangArr[25];
$mohr_lv0020->ArrPush[9]=$vLangArr[26];
$mohr_lv0020->ArrPush[10]=$vLangArr[27];
$mohr_lv0020->ArrPush[11]=$vLangArr[28];
$mohr_lv0020->ArrPush[12]=$vLangArr[29];
$mohr_lv0020->ArrPush[13]=$vLangArr[30];
$mohr_lv0020->ArrPush[14]=$vLangArr[31];
$mohr_lv0020->ArrPush[15]=$vLangArr[32];
$mohr_lv0020->ArrPush[16]=$vLangArr[33];
$mohr_lv0020->ArrPush[17]=$vLangArr[34];
$mohr_lv0020->ArrPush[18]=$vLangArr[35];
$mohr_lv0020->ArrPush[19]=$vLangArr[36];
$mohr_lv0020->ArrPush[20]=$vLangArr[37];
$mohr_lv0020->ArrPush[21]=$vLangArr[38];
$mohr_lv0020->ArrPush[22]=$vLangArr[39];
$mohr_lv0020->ArrPush[23]=$vLangArr[40];
$mohr_lv0020->ArrPush[24]=$vLangArr[41];
$mohr_lv0020->ArrPush[25]=$vLangArr[42];
$mohr_lv0020->ArrPush[26]=$vLangArr[43];
$mohr_lv0020->ArrPush[27]=$vLangArr[44];
$mohr_lv0020->ArrPush[28]=$vLangArr[45];
$mohr_lv0020->ArrPush[29]=$vLangArr[46];
$mohr_lv0020->ArrPush[30]=$vLangArr[47];
$mohr_lv0020->ArrPush[31]=$vLangArr[48];
$mohr_lv0020->ArrPush[32]=$vLangArr[49];
$mohr_lv0020->ArrPush[33]=$vLangArr[50];
$mohr_lv0020->ArrPush[34]=$vLangArr[51];
$mohr_lv0020->ArrPush[35]=$vLangArr[52];
$mohr_lv0020->ArrPush[36]=$vLangArr[53];
$mohr_lv0020->ArrPush[37]=$vLangArr[54];
$mohr_lv0020->ArrPush[38]=$vLangArr[55];
$mohr_lv0020->ArrPush[39]=$vLangArr[56];
$mohr_lv0020->ArrPush[40]=$vLangArr[57];
$mohr_lv0020->ArrPush[41]=$vLangArr[58];
$mohr_lv0020->ArrPush[42]=$vLangArr[59];
$mohr_lv0020->ArrPush[43]=$vLangArr[60];
$mohr_lv0020->ArrPush[44]=$vLangArr[61];
$mohr_lv0020->ArrPush[45]=$vLangArr[62];
$mohr_lv0020->ArrPush[46]=$vLangArr[71];
$mohr_lv0020->ArrPush[47]=$vLangArr[72];
$mohr_lv0020->ArrPush[48]=$vLangArr[73];
$mohr_lv0020->ArrPush[49]=$vLangArr[74];
$mohr_lv0020->ArrPush[50]=$vLangArr[75];
$mohr_lv0020->ArrPush[51]=$vLangArr[76];
$mohr_lv0020->ArrPush[52]=$vLangArr[78];
$mohr_lv0020->ArrPush[53]=$vLangArr[79];
$mohr_lv0020->ArrPush[61]=$vLangArr[80];
$mohr_lv0020->ArrPush[62]=$vLangArr[81];
$mohr_lv0020->ArrPush[63]=$vLangArr[82];
$mohr_lv0020->ArrPush[64]=$vLangArr[83];
$mohr_lv0020->ArrPush[65]=$vLangArr[84];
$mohr_lv0020->ArrPush[66]=$vLangArr[85];
$mohr_lv0020->ArrPush[67]=$vLangArr[86];
$mohr_lv0020->ArrPush[100]='Code Machine';
$mohr_lv0020->ArrPush[103]='AL vào làm';
$mohr_lv0020->ArrPush[104]='AL/Năm';
$mohr_lv0020->ArrPush[151]='Tiền SN';
$mohr_lv0020->ArrPush[304]='Tên con';
$mohr_lv0020->ArrPush[305]='Quan hệ';
$mohr_lv0020->ArrPush[306]='Ngày sinh';
$mohr_lv0020->ArrPush[307]='Số CMND';
$mohr_lv0020->ArrPush[308]='Nghề nghiệp';
$mohr_lv0020->ArrPush[309]='Thu nhập';
$mohr_lv0020->ArrPush[310]='Nơi cư trú';
$mohr_lv0020->ArrPush[311]='Đơn vị';
$mohr_lv0020->ArrPush[312]='Người phụ thuộc';
$mohr_lv0020->ArrPush[313]='Phái';
$mohr_lv0020->ArrPush[314]='Ngày đăng ký';
$mohr_lv0020->ArrPush[200]='Phòng ban';

$mohr_lv0020->ArrFunc[0]='//Function';
$mohr_lv0020->ArrFunc[1]=$vLangArr[2];
$mohr_lv0020->ArrFunc[2]=$vLangArr[4];
$mohr_lv0020->ArrFunc[3]=$vLangArr[6];
$mohr_lv0020->ArrFunc[4]=$vLangArr[7];
$mohr_lv0020->ArrFunc[5]='';
$mohr_lv0020->ArrFunc[6]='';
$mohr_lv0020->ArrFunc[7]='';
$mohr_lv0020->ArrFunc[8]=$vLangArr[10];
$mohr_lv0020->ArrFunc[9]=$vLangArr[12];
$mohr_lv0020->ArrFunc[10]=$vLangArr[0];
$mohr_lv0020->ArrFunc[11]=$vLangArr[63];
$mohr_lv0020->ArrFunc[12]=$vLangArr[64];
$mohr_lv0020->ArrFunc[13]=$vLangArr[65];
$mohr_lv0020->ArrFunc[14]=$vLangArr[66];

////Other
$mohr_lv0020->ArrOther[1]=$vLangArr[61];
$mohr_lv0020->ArrOther[2]=$vLangArr[62];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0020->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0016');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mohr_lv0020->ListView;
$curPage = $mohr_lv0020->CurPage;
$maxRows =$mohr_lv0020->MaxRows;
$vOrderList=$mohr_lv0020->ListOrder;
$vSortNum=$mohr_lv0020->SortNum;
if($maxRows ==0) $maxRows = 10;
$mohr_lv0020->lv029=$_POST['txtlv029'];
if($mohr_lv0020->GetApr()==0)  $mohr_lv0020->lv029_=$mohr_lv0020->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
$mohr_lv0020->lv028=$_POST['txtlv028'];
$mohr_lv0020->lv009=$_POST['txtlv009'];
$mohr_lv0020->lv018=$_POST['txtlv018'];
$mohr_lv0020->lv042=$_POST['txtlv042'];
$mohr_lv0020->lv051=$_POST['txtlv051'];
$mohr_lv0020->lv001=$_POST['txtlv001'];
$mohr_lv0020->lv026=$_POST['txtlv026'];
$mohr_lv0020->lv304=$_POST['txtlv304'];
$mohr_lv0020->level=$_POST['txtlvlevel'];
$mohr_lv0020->isChildCheck=(int)$_POST['isChildCheck'];
$mohr_lv0020->isStaffOff=$_POST['isStaffOff'];
$mohr_lv0020->dateworkfrom=$_POST['txtdatefrom'];
$mohr_lv0020->dateworkto=$_POST['txtdateto'];
$totalRowsC=$mohr_lv0020->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if($mohr_lv0020->GetView()==1)
{
	if($mohr_lv0020->isWork==9)
	{
		$vYear=getyear(recoverdate($mohr_lv0020->dateworkfrom,$mohr_lv0020->lang));
		$mohr_lv0020->dateworkfrom='01/01/'.$vYear;
		$vMonth=getmonth(recoverdate($mohr_lv0020->dateworkto,$mohr_lv0020->lang));
	
?>
<style>
#tbl_staff tr td
{
	text-align:center;
}
</style>
<center>
<table border="0" cellpadding="0" cellspacing="0" style="width:800px;" width="812">
	<colgroup>
		<col span="10" style="width:48pt" width="64" />
		<col style="mso-width-source:userset;mso-width-alt:6290;width:129pt" width="172" /></colgroup>
	<tbody>
		<tr height="62" style="mso-height-source:userset;height:46.5pt">
			<td class="xl66" colspan="10" style="width:561pt" width="748">
				<table border="0" cellpadding="1" cellspacing="1" style="width: 100%;">
					<tbody>
						<tr>
							<td style="text-align: center;">
								TÊN ĐƠN VỊ/CÁ NHÂN<br/>
								<?php echo $mohr_lv0020->GetCompany();?><br/>
								Số : <input type="textbox" value="..........................." style="border:0px #fff solid;text-align:center;width:120px;"/>
							</td>
							<td style="text-align: center; width: 65%;">
								CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br/>Độc lập - Tự do - Hạnh phúc<br/>
								<center><input type="textbox" value="Vũng Tàu" style="border:0px #fff solid;text-align:right;width:80px;"/>&nbsp;ngày&nbsp;<input type="textbox" value="<?php echo getday($mohr_lv0020->DateCurrent) ;?>" style="border:0px #fff solid;text-align:center;width:20px;"/>&nbsp;tháng&nbsp;<input type="textbox" value="<?php echo getmonth($mohr_lv0020->DateCurrent) ;?>" style="border:0px #fff solid;text-align:center;width:20px;"/>&nbsp;năm&nbsp;<input type="textbox" value="<?php echo getyear($mohr_lv0020->DateCurrent) ;?>" style="border:0px #fff solid;text-align:center;width:30px;"/>&nbsp;</center>
							</td>
						</tr>
					</tbody>
				</table>
				<p style="text-align: center;"><strong><span style="font-size:22px;">BÁO CÁO TÌNH HÌNH THAY ĐỔI VỀ LAO ĐỘNG</span></strong></p>
				<p style="text-align: center;"><span  style="font-size:18px;"><?php echo (($vMonth!=12)?Fillnum($vMonth,2).' THÁNG ĐẦU NĂM '.$vYear:'CUỐI NĂM '.$vYear);?></span></p>
				<p>Kính gửi :&nbsp; Phòng Lao động - Thương binh và Xã hội quận - huyện/ (Hoặc Ban quản lý các khu chế xuất và công nghiệp/Ban quản lý khu công nghệ cao</p>
			</td>
		</tr>
		<tr height="141" style="mso-height-source:userset;height:105.75pt">
			<td class="xl66" colspan="10" style="width:561pt" width="748">1. Tên Cơ quan, tổ chức, doanh nghiệp, hộ kinh doanh cá thể <?php echo $mohr_lv0020->GetCompany();?><br />
				2. Loại hình hoạt động (Đơn vị hành chính, sự nghiệp, doanh nghiệp tư nhân, Công ty hợp danh, Công ty trách nhiệm hữu hạn một thành viên, Công ty trách nhiệm hữu hạn hai thành viên trở lên, Công ty cổ phần) : .................................................................................................<br />
				3. Địa chỉ hoạt động :<?php echo $mohr_lv0020->GetAddress();?><br />
				4. Điện thoại : <?php echo $mohr_lv0020->GetPhone();?>&nbsp;&nbsp;&nbsp;&nbsp;Fax: <?php echo $mohr_lv0020->GetFax();?>&nbsp;&nbsp;&nbsp;&nbsp; Email : ...........................................<br />
				Báo cáo tình hình thay đổi về lao động của đơn vị như sau :&nbsp;</td>
		</tr>
		<tr >
			<td class="xl66" colspan="10" style="width:561pt" width="748"><strong>I. Số lao động đầu kỳ</strong></td>
		</tr>
		<tr >
			<td class="xl66" colspan="10" style="width:561pt;padding-top:15px;padding-bottom:15px" width="748">
			<?php
				echo $mohr_lv0020->LV_StaffFirst($vYear-1,12);
			?>
			</td>
		</tr>
		<tr >
			<td class="xl66" colspan="10" style="width:561pt" width="748"><strong>II. Số lao động tăng trong kỳ</strong></td>
		</tr>
		<tr >
			<td class="xl66" colspan="10" style="width:561pt;padding-top:15px;padding-bottom:15px" width="748">
			<?php
				echo $mohr_lv0020->LV_StaffInOut(0);
			?>
			</td>
		</tr>
		<tr >
			<td class="xl66" colspan="10" style="width:561pt" width="748"><strong>III. Số lao động giảm trong kỳ</strong></td>
		</tr>
		<tr >
			<td class="xl66" colspan="10" style="width:561pt;padding-top:15px;padding-bottom:15px" width="748">
			<?php
				echo $mohr_lv0020->LV_StaffOut();
			?>
			</td>
		</tr>
		<tr >
			<td class="xl66" colspan="10" style="width:561pt" width="748"><strong>IV. Số lao động cuối kỳ</strong></td>
		</tr>
		<tr >
			<td class="xl66" colspan="10" style="width:561pt;padding-top:15px;padding-bottom:15px" width="748">
			<?php
				echo $mohr_lv0020->LV_StaffFirst($vYear,$vMonth);
			?>
			</td>
		</tr>
	</tbody>
</table>
</center>

						<?php 
	}
	else
	{
		
	
						if($mohr_lv0020->isWork==5 || $mohr_lv0020->isWork==6)
							echo $mohr_lv0020->LV_BuilListReportAdvanceChildren($vFieldList,'document.frmchoose','chkAll','lvChk',0,100000,$paging,$vOrderList,$vSortNum);
						elseif($mohr_lv0020->isWork==7)
							echo $mohr_lv0020->LV_BuilListReportAdvanceChildren1($vFieldList,'document.frmchoose','chkAll','lvChk',0,100000,$paging,$vOrderList,$vSortNum);
						elseif($mohr_lv0020->isWork==8)
							echo $mohr_lv0020->LV_BuilListReportDeptFull($vFieldList,'document.frmchoose','chkAll','lvChk',0,100000,$paging,$vOrderList,$vSortNum);
						elseif($mohr_lv0020->isWork==10)
							echo $mohr_lv0020->LV_BuilListReportDeptFullInOut($vFieldList,'document.frmchoose','chkAll','lvChk',0,100000,$paging,$vOrderList,$vSortNum);
						else
							echo $mohr_lv0020->LV_BuilListReportAdvance($vFieldList,'document.frmchoose','chkAll','lvChk',0,100000,$paging,$vOrderList,$vSortNum);
	
	}	?>
<?php
} else {
	include("../permit.php");
}
?>
