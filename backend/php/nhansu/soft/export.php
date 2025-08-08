<?php 
ob_start();
//Define where you have placed the phptreeview folder.
define("TREEVIEW_SOURCE", "../");	 
include(TREEVIEW_SOURCE."clsall/treeviewclasses.php"); //Include the phptreeview engine.
session_start();
//Cấu hình 
	include("config.php");
	include("configrun.php");
	include("function.php")
?>
<table cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="12" >BÃNG TỔNG LƯƠNG</td>
  </tr>
  <tr>
    <td colspan="12">Thaùng 01-&gt;07 naêm    2010</td>
  </tr>
  <tr>
    <td rowspan="2" >Só    TT</td>
    <td rowspan="2">Họ và tên </td>
    <td rowspan="2" >Số tiền </td>
    <td rowspan="2" >Phụ cấp khác </td>
    <td rowspan="2" >Tổng số </td>
    <td colspan="5" >Các    khoản phải khấu trừ vào lương </td>
    <td colspan="2" >Kyø II    ñöôïc lónh</td>
  </tr>
  <tr>
    <td >BHXH<br>
      6%</td>
    <td >BHYT<br>
      1.5%</td>
    <td >BHTN<br>
      1%</td>
    <td >Thuế    TNCN PNộp</td>
    <td >Cộng </td>
    <td >Số    tiền </td>
    <td >Ký    nhận </td>
  </tr>
  <tr>
    <td>A</td>
    <td>B</td>
    <td>1</td>
    <td>2</td>
    <td>3</td>
    <td>4</td>
    <td>5</td>
    <td>6</td>
    <td>7</td>
    <td>8</td>
    <td>9</td>
    <td>C</td>
  </tr>
  <?php
  $vsql="select ten,sum(sotien) ssotien,sum(phucap) sphucap,sum(tongso) stongso,sum(bhxh) sbhxh,sum(bhyt) sbhyt,sum(bhtn) sbhtn,sum(tncn) stncn,sum(cong) scong,sum(sotiennew) ssotiennew from bangluongall group by ten";
  $vresult=db_query($vsql);
  $i=1;
		while($vrow=db_fetch_array($vresult))		
		{
  ?>
  <tr>
    <td><?php echo $i;?></td>
    <td><?php echo $vrow['ten'];?></td>
    <td><?php echo $vrow['ssotien'];?></td>
    <td><?php echo $vrow['sphucap'];?></td>
    <td><?php echo $vrow['stongso'];?></td>
    <td><?php echo $vrow['sbhxh'];?></td>
    <td><?php echo $vrow['sbhyt'];?></td>
    <td><?php echo $vrow['sbhtn'];?></td>
    <td><?php echo $vrow['stncn'];?></td>
    <td><?php echo $vrow['scong'];?></td>
    <td><?php echo $vrow['ssotiennew'];?></td>
    <td>&nbsp;</td>
  </tr>
  <?php
  $i++;
		}
  ?>
</table>
