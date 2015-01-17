<?php

/**
 * @author 
 * @copyright 2009
 */

include_once('const.php');

$fn=get_data("fn");
if(!$fn)
{
	header('Location',"../generate_pdf.php");
	exit();
}


$filename=PDF_FOLDER.$fn;

$len=filesize($filename);
header('Content-type: application/pdf');
header("Content-Length: $len");
header('Content-Disposition: attachment; filename="'. $fn .'"');

@readfile($filename);

?>