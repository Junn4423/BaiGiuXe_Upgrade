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
	case 'word-1':
		include('report-1.php');
		break;
	case 'excel-1':
		include('report-1.php');
		break;
	case 'pdf-1':
		include('report-1.php');
		break;		
	case 'child':
		include('child.php');
		break;
	case 'rpt':
		include('report1.php');
		break;
}
?>