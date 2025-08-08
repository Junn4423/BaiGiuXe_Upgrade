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
	case 'rpt4':
		include('report4.php');
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
	case 'rpt30':
		include('report30.php');
		break;
	case 'rpt31':
		include('report31.php');
		break;
	case 'rpt32':
		include('report32.php');
		break;
	case 'rpt33':
		include('report33.php');
		break;
	case 'rpt40':
		include('report40.php');
		break;
	case 'rpt41':
		include('report41.php');
		break;
	case 'rpt42':
		include('report42.php');
		break;
	case 'rpt43':
		include('report43.php');
		break;
	case 'rpt44':
		include('report44.php');
		break;
	case 'rpt67':
		include('report67.php');
		break;
	case 'rpt68':
		include('report68.php');
		break;
	case 'rpt51':
		include('report51.php');
		break;
	case 'rpt52':
		include('report52.php');
		break;
	case 'rpt53':
		include('report53.php');
		break;
	case 'rpt56':
		include('report56.php');
		break;
	case 'rpt58':
		include('report58.php');
		break;		
	case 'rpt':
		include('report1.php');
		break;
}
?>