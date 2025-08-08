<?php 
	echo "<img src='barcode.php?coderun=CODE39'>";
?>
<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td >&nbsp;</td>
		<?php $qstr = "barnumber=".$pContractID."&encode=\"CODE39\"&height=\"50\"&scale=\"2\"&color=\"#000000\"&bgcolor=\"#FFFFFF\"&type=\"png\"&file=\"\"";?>
		<td width="1" align="right" valign="bottom"><?php echo "<img src='../../clsall/barcode/barcode.php?".$qstr."'>";?></td>
	</tr>
</table>
<?php echo "<img src='../../clsall/barcode/barcode.php?barnumber=".$pContractID."'>";?>

		<tr>
			<td align="center" colspan="5">
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td >&nbsp;</td>
						<td width="1" align="right" valign="bottom"><?php echo "<img src='../../clsall/barcode/barcode.php?barnumber=".$pContractID."'>";?></td>
					</tr>
				</table>
			</td>
		</tr>
		
		
		substr($pFabricSampleID, 0, strlen($pFabricSampleID)-1)
		
		<?php if($vFlag==1){?>
		<tr>
			<td align="center" colspan="5">
				<table width="760" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td >&nbsp;</td>
						<td width="1" align="right" valign="bottom"><?php echo "<img src='../../clsall/barcode/barcode.php?barnumber=".$pContractID."'>";?></td>
					</tr>
				</table>
			</td>
		</tr>
		<?php } ?>