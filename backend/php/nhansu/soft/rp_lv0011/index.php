<?php
$vfunc=$_GET['func'];
$vID= $_GET['ID'] ?? '';
switch($vfunc)
{
	case 'add':
		include('add.php');
		break;
	case 'edit':
		include('edit.php');
		break;
	case 'filter':
		include('filter.php');
		break;
	case 'word':
		include('report1.php');
		break;
	case 'excel':
		include('report1.php');
		break;
	case 'pdf':
		include('report1.php');
		break;
	case '':
		include('.php');
		break;
	case 'rpt':
		include('report1.php');
		break;
	case 'rptall':
		include('reportall.php');
		break;
		
}
?>