<?php
//custom_kgosafomaafo_1
// "pick students"
$this->ListOptions->Add("paymentstudents");
$item =& $this->ListOptions->Items["paymentstudents"];
$item->CssStyle = "white-space: nowrap;";
$item->Visible = TRUE;
$item->OnLeft = FALSE;
?>