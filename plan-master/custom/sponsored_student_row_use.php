<?php
// "show"
global $_SESSION, $cusom_application_name;
if(isset($_SESSION[$cusom_application_name]['action_task']['payment_request_students']))
{
	$oListOpt =& $this->ListOptions->Items["show"];
	if ($oListOpt->Visible)
	{
		$tmp_id = $sponsored_student->sponsored_student_id->CurrentValue;
		$tmp_id_html = "payment_request_status_{$tmp_id}";
		$tmp_function = 'custom_payment_request_student_';
		$oListOpt->Body = 
		"Payment Request [".
		"<a class='alink' onclick=\"{$tmp_function}add($tmp_id);\"> "."Add"."</a>|".
		"<a class='alink' onclick=\"{$tmp_function}remove($tmp_id);\"> "."Remove"."</a>|".
		"<a class='alink' onclick=\"{$tmp_function}status($tmp_id);\">Status</a>:<span id='$tmp_id_html'> ...</span>]".
		"<script type='text/javascript'>custom_payment_request_student_status('$tmp_id');</script>";
	}
}
?>