<?php
$vfunc=$_GET['childfunc'];
$vChildID=$_GET['ChildID'];
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
	case 'download':
		include('download.php');
		break;
}
?>