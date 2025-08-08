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
		include('report.php');
		break;
	case 'excel':
		include('report.php');
		break;
	case 'pdf':
		include('report.php');
		break;
	case 'rpt1':
		include('report2.php');
		break;
	case 'rpt2':
		include('report3.php');
		break;
	case 'rpt6':
		include('report6.php');
		break;
	case 'rpt7':
		include('report7.php');
		break;
	case 'rpt8':
		include('report8.php');
		break;
	case 'rpt9':
		include('report9.php');
		break;
	case 'rpt19':
		include('report19.php');
		break;
	case 'rpt10':
		include('report10.php');
		break;
	case 'rpt11':
		include('report11.php');
		break;
	case 'rpt12':
		include('report12.php');
		break;
	case 'rpt13':
		include('report13.php');
		break;
	case 'rpt14':
		include('report14.php');
		break;
	case 'rpt15':
		include('report15.php');
		break;
	case 'rpt16':
		include('report16.php');
		break;
	case 'rpt21':
		include('report21.php');
		break;
	case 'rpt22':
		include('report22.php');
		break;
	case 'rpt23':
		include('report23.php');
		break;
	case 'rpt24':
		include('report24.php');
		break;
	case 'rpt25':
		include('report25.php');
		break;
	case 'rpt26':
		include('report26.php');
		break;
	case 'rpt':
		include('report1.php');
		break;
}
?>