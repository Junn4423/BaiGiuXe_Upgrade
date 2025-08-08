<?php
$vfunc=$_GET['func'] ?? '';
if (isset($_GET['ID'])) {
    $vID = $_GET['ID'];
} else {
    $vID = '';
}
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
	case 'child':
		include('child.php');
		break;
	case 'rpt':
		include('report1.php');
		break;
	case 'rpt1':
		include('report2.php');
		break;
	case 'xml':
		include('xml.php');
		break;
	case 'upload':
		include('upload.php');
		break;		
	case 'uploadchild':
		include('uploadchild.php');
		break;	
}
?>