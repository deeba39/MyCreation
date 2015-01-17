<?php

//custom_kgosafomaafo_2
// "paymentstudents"
$oListOpt =& $this->ListOptions->Items["paymentstudents"];
if ($oListOpt->Visible)

// CHECK: Make sure that status is NEW before displaying
$tmp_status = $payment_request->request_status->CurrentValue;
//$oListOpt->Body = '['.($payment_request->request_status->CurrentValue).']';
$oListOpt->Body ='';
if(strcasecmp($payment_request->request_status->CurrentValue,'NEWREQ')==0)
{
	$oListOpt->Body .= "<a" . "" . " href=\"" . 'sponsored_studentlist.php?action_task_save=payment_request_students&amp;payment_request='. ($payment_request->payment_request_id->CurrentValue) . "\">" . "Select Students for Payment" . "</a>";
}
/*if(strcasecmp($payment_request->request_status->CurrentValue,'REQUESTED')==0)
{
	$oListOpt->Body .= "<a" . "" . " href=\"" . 'sponsored_studentlist.php?action_task_save=payment_request_submit&amp;payment_request='. ($payment_request->payment_request_id->CurrentValue) . "\">" . "Submit Request" . "</a>";
}*/
$this->RenderListOptionsExt();

?>