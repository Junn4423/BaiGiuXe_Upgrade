<?php
$vfunc=$_GET['childdetailfunc2'];
$vChildID= $_GET['ID'] ?? '';
switch($vfunc)
{
	case 'add':
		include('add.php');
		break;
	case 'add_1':
		include('add_1.php');
		break;
	case 'edit':
		include('edit.php');
		break;
	case 'edit_1':
		include('edit_1.php');
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
	case 'child':
		include('child.php');
		break;
	case 'rpt':
		include('report1.php');
		break;
}
?>