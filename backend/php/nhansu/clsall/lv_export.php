if ($sExport == "html") {

    // Printer friendly
}
if ($sExport == "excel") {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename=' . EW_REPORT_TABLE_VAR .'.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word');
    header('Content-Disposition: attachment; filename=' . EW_REPORT_TABLE_VAR .'.doc');
}