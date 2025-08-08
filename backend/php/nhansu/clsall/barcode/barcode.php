<?php
	require("barcode.inc.php");
//Set cac gia tri mac dinh cho barcode image khi khong co gia tri truyen vao
	///Kieu ma hoa (vd: 128, 39, ...)
	$encode=trim($_GET['encode']);
		$encode=($encode!="" || $encode!=NULL)?$encode:"CODE39";
	///Du lieu nhap vao de tao thanh barcode
	$barnumber=trim($_GET['barnumber']);
		$barnumber=($barnumber!="" || $barnumber!=NULL)?$barnumber:"123456789";
	///Chieu cao cua barcode image hien thi
	$height=trim($_GET['height']);
		$height=($height!="" || $height!=NULL)?$height:"40";
	///Ti le image hien thi
	$scale=trim($_GET['scale']);
		$scale=($scale!="" || $scale!=NULL)?$scale:"1";
	///Mau nen image hien thi
	$bgcolor=trim($_GET['bgcolor']);
		$bgcolor=($bgcolor!="" || $bgcolor!=NULL)?$bgcolor:"#FFFFFF";
	///Mau image hien thi
	$color=trim($_GET['color']);
		$color=($color!="" || $color!=NULL)?$color:"#000000";
	///Ten file image, neu ten file bo trong se khong tao ra file trong thu muc goc
	$file=trim($_GET['file']);
		$file;//=($file!="" || $file!=NULL)?$file:"";
	///Dinh dang file image duoc tao ra
	$type=trim($_GET['type']);
		$type=($type!="" || $type!=NULL)?$type:"png";

	$bar = new BARCODE();
	
	if($bar==false)
		die($bar->error());
	// OR $bar= new BARCODE("I2O5");

	//$barnumber=$_GET['barnumber'];
	//$barnumber="200780";
	//$barnumber="801221905";
	//$barnumber="A40146B";
	//$barnumber="Code 128";
	//$barnumber="TEST8052";
	//$barnumber="TEST93";
	
	$bar->setSymblogy($encode);
	$bar->setHeight($height);
	//$bar->setFont("arial");
	$bar->setScale($scale);
	$bar->setHexColor($color, $bgcolor);

	/*$bar->setSymblogy("UPC-E");
	$bar->setHeight(50);
	$bar->setFont("arial");
	$bar->setScale(2);
	$bar->setHexColor("#000000","#FFFFFF");*/

	//OR
	//$bar->setColor(255,255,255)   RGB Color
	//$bar->setBGColor(0,0,0)   RGB Color

	$return = $bar->genBarCode($barnumber, $type, $file);
	if($return==false)
		$bar->error(true);

/*Su dung: them doan code sau vao vi tri muon in ra barcode
<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td >&nbsp;</td>
		<?php $qstr = "barnumber=".$pContractID."&encode=\"CODE39\"&height=\"50\"&scale=\"2\"&color=\"#000000\"&bgcolor=\"#FFFFFF\"&type=\"png\"&file=\"\"";?>
		<td width="1" align="right" valign="bottom"><?php echo "<img src='../../clsall/barcode/barcode.php?".$qstr."'>";?></td>
	</tr>
</table>
*/
?>