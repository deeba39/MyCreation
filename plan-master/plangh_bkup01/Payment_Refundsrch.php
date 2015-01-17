<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "Payment_Refundinfo.php" ?>
<?php include "scholarship_packageinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "payment_requestinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$Payment_Refund_search = new cPayment_Refund_search();
$Page =& $Payment_Refund_search;

// Page init
$Payment_Refund_search->Page_Init();

// Page main
$Payment_Refund_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var Payment_Refund_search = new ew_Page("Payment_Refund_search");

// page properties
Payment_Refund_search.PageID = "search"; // page ID
Payment_Refund_search.FormID = "fPayment_Refundsearch"; // form ID
var EW_PAGE_ID = Payment_Refund_search.PageID; // for backward compatibility

// extend page with validate function for search
Payment_Refund_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_scholarship_payment_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Payment_Refund->scholarship_payment_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Payment_Refund->date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_refund_amount"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Payment_Refund->refund_amount->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_amount"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Payment_Refund->amount->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Payment_Refund->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_group_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Payment_Refund->group_id->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj))
			return false;
	}
	for (var i=0; i<fobj.elements.length; i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
Payment_Refund_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
Payment_Refund_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Payment_Refund_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $Payment_Refund->TableCaption() ?><br><br>
<a href="<?php echo $Payment_Refund->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$Payment_Refund_search->ShowMessage();
?>
<form name="fPayment_Refundsearch" id="fPayment_Refundsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return Payment_Refund_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="Payment_Refund">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->scholarship_payment_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->scholarship_payment_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_scholarship_payment_id" id="z_scholarship_payment_id" value="="></span></td>
		<td<?php echo $Payment_Refund->scholarship_payment_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_scholarship_payment_id" id="x_scholarship_payment_id" title="<?php echo $Payment_Refund->scholarship_payment_id->FldTitle() ?>" value="<?php echo $Payment_Refund->scholarship_payment_id->EditValue ?>"<?php echo $Payment_Refund->scholarship_payment_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->date->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_date" id="z_date" value="="></span></td>
		<td<?php echo $Payment_Refund->date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_date" id="x_date" title="<?php echo $Payment_Refund->date->FldTitle() ?>" value="<?php echo $Payment_Refund->date->EditValue ?>"<?php echo $Payment_Refund->date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_date" name="cal_x_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_date" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->status->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->status->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_status" id="z_status" value="="></span></td>
		<td<?php echo $Payment_Refund->status->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $Payment_Refund->status->FldTitle() ?>" value="{value}"<?php echo $Payment_Refund->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $Payment_Refund->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Payment_Refund->status->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $Payment_Refund->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $Payment_Refund->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->refund_amount->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->refund_amount->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_refund_amount" id="z_refund_amount" value="="></span></td>
		<td<?php echo $Payment_Refund->refund_amount->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_refund_amount" id="x_refund_amount" title="<?php echo $Payment_Refund->refund_amount->FldTitle() ?>" size="30" value="<?php echo $Payment_Refund->refund_amount->EditValue ?>"<?php echo $Payment_Refund->refund_amount->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->amount->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->amount->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_amount" id="z_amount" value="="></span></td>
		<td<?php echo $Payment_Refund->amount->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_amount" id="x_amount" title="<?php echo $Payment_Refund->amount->FldTitle() ?>" size="30" value="<?php echo $Payment_Refund->amount->EditValue ?>"<?php echo $Payment_Refund->amount->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->memo->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->memo->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_memo" id="z_memo" value="LIKE"></span></td>
		<td<?php echo $Payment_Refund->memo->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_memo" id="x_memo" title="<?php echo $Payment_Refund->memo->FldTitle() ?>" cols="35" rows="4"<?php echo $Payment_Refund->memo->EditAttributes() ?>><?php echo $Payment_Refund->memo->EditValue ?></textarea>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->year->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->year->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_year" id="z_year" value="="></span></td>
		<td<?php echo $Payment_Refund->year->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_year" id="x_year" title="<?php echo $Payment_Refund->year->FldTitle() ?>" size="30" value="<?php echo $Payment_Refund->year->EditValue ?>"<?php echo $Payment_Refund->year->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->scholarship_package_scholarship_package_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->scholarship_package_scholarship_package_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_scholarship_package_scholarship_package_id" id="z_scholarship_package_scholarship_package_id" value="="></span></td>
		<td<?php echo $Payment_Refund->scholarship_package_scholarship_package_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_scholarship_package_scholarship_package_id" name="x_scholarship_package_scholarship_package_id" title="<?php echo $Payment_Refund->scholarship_package_scholarship_package_id->FldTitle() ?>"<?php echo $Payment_Refund->scholarship_package_scholarship_package_id->EditAttributes() ?>>
<?php
if (is_array($Payment_Refund->scholarship_package_scholarship_package_id->EditValue)) {
	$arwrk = $Payment_Refund->scholarship_package_scholarship_package_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Payment_Refund->scholarship_package_scholarship_package_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->programarea_residentarea_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->programarea_residentarea_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_programarea_residentarea_id" id="z_programarea_residentarea_id" value="="></span></td>
		<td<?php echo $Payment_Refund->programarea_residentarea_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_programarea_residentarea_id" name="x_programarea_residentarea_id" title="<?php echo $Payment_Refund->programarea_residentarea_id->FldTitle() ?>"<?php echo $Payment_Refund->programarea_residentarea_id->EditAttributes() ?>>
<?php
if (is_array($Payment_Refund->programarea_residentarea_id->EditValue)) {
	$arwrk = $Payment_Refund->programarea_residentarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Payment_Refund->programarea_residentarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->programarea_payingarea_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->programarea_payingarea_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_programarea_payingarea_id" id="z_programarea_payingarea_id" value="="></span></td>
		<td<?php echo $Payment_Refund->programarea_payingarea_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_programarea_payingarea_id" name="x_programarea_payingarea_id" title="<?php echo $Payment_Refund->programarea_payingarea_id->FldTitle() ?>"<?php echo $Payment_Refund->programarea_payingarea_id->EditAttributes() ?>>
<?php
if (is_array($Payment_Refund->programarea_payingarea_id->EditValue)) {
	$arwrk = $Payment_Refund->programarea_payingarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Payment_Refund->programarea_payingarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->payment_request_payment_request_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->payment_request_payment_request_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_payment_request_payment_request_id" id="z_payment_request_payment_request_id" value="="></span></td>
		<td<?php echo $Payment_Refund->payment_request_payment_request_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_payment_request_payment_request_id" name="x_payment_request_payment_request_id" title="<?php echo $Payment_Refund->payment_request_payment_request_id->FldTitle() ?>"<?php echo $Payment_Refund->payment_request_payment_request_id->EditAttributes() ?>>
<?php
if (is_array($Payment_Refund->payment_request_payment_request_id->EditValue)) {
	$arwrk = $Payment_Refund->payment_request_payment_request_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Payment_Refund->payment_request_payment_request_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->bankname->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->bankname->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_bankname" id="z_bankname" value="LIKE"></span></td>
		<td<?php echo $Payment_Refund->bankname->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_bankname" id="x_bankname" title="<?php echo $Payment_Refund->bankname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $Payment_Refund->bankname->EditValue ?>"<?php echo $Payment_Refund->bankname->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->account_no->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->account_no->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_account_no" id="z_account_no" value="LIKE"></span></td>
		<td<?php echo $Payment_Refund->account_no->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_account_no" id="x_account_no" title="<?php echo $Payment_Refund->account_no->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $Payment_Refund->account_no->EditValue ?>"<?php echo $Payment_Refund->account_no->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->schools_school_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->schools_school_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_schools_school_id" id="z_schools_school_id" value="="></span></td>
		<td<?php echo $Payment_Refund->schools_school_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_schools_school_id" name="x_schools_school_id" title="<?php echo $Payment_Refund->schools_school_id->FldTitle() ?>"<?php echo $Payment_Refund->schools_school_id->EditAttributes() ?>>
<?php
if (is_array($Payment_Refund->schools_school_id->EditValue)) {
	$arwrk = $Payment_Refund->schools_school_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Payment_Refund->schools_school_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->group_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->group_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_group_id" id="z_group_id" value="="></span></td>
		<td<?php echo $Payment_Refund->group_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_group_id" name="x_group_id" title="<?php echo $Payment_Refund->group_id->FldTitle() ?>"<?php echo $Payment_Refund->group_id->EditAttributes() ?>>
<?php
if (is_array($Payment_Refund->group_id->EditValue)) {
	$arwrk = $Payment_Refund->group_id->EditValue;
	if ($arwrk[0][0] <> "") echo "<option value=\"\">" . $Language->Phrase("PleaseSelect") . "</option>";
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Payment_Refund->group_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } else { ?>
<input type="text" name="x_group_id" id="x_group_id" title="<?php echo $Payment_Refund->group_id->FldTitle() ?>" size="30" value="<?php echo $Payment_Refund->group_id->EditValue ?>"<?php echo $Payment_Refund->group_id->EditAttributes() ?>>
<?php } ?>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$Payment_Refund_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cPayment_Refund_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'Payment Refund';

	// Page object name
	var $PageObjName = 'Payment_Refund_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $Payment_Refund;
		if ($Payment_Refund->UseTokenInUrl) $PageUrl .= "t=" . $Payment_Refund->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $Payment_Refund;
		if ($Payment_Refund->UseTokenInUrl) {
			if ($objForm)
				return ($Payment_Refund->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($Payment_Refund->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cPayment_Refund_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (Payment_Refund)
		$GLOBALS["Payment_Refund"] = new cPayment_Refund();

		// Table object (scholarship_package)
		$GLOBALS['scholarship_package'] = new cscholarship_package();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (payment_request)
		$GLOBALS['payment_request'] = new cpayment_request();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'Payment Refund', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $Payment_Refund;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanSearch()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("Payment_Refundlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("Payment_Refundlist.php");
		}

		// Create form object
		$objForm = new cFormObj();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Payment_Refund;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$Payment_Refund->CurrentAction = $objForm->GetValue("a_search");
			switch ($Payment_Refund->CurrentAction) {
				case "S": // Get search criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $Payment_Refund->UrlParm($sSrchStr);
						$this->Page_Terminate("Payment_Refundlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$Payment_Refund->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $Payment_Refund;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $Payment_Refund->scholarship_payment_id); // scholarship_payment_id
	$this->BuildSearchUrl($sSrchUrl, $Payment_Refund->date); // date
	$this->BuildSearchUrl($sSrchUrl, $Payment_Refund->status); // status
	$this->BuildSearchUrl($sSrchUrl, $Payment_Refund->refund_amount); // refund_amount
	$this->BuildSearchUrl($sSrchUrl, $Payment_Refund->amount); // amount
	$this->BuildSearchUrl($sSrchUrl, $Payment_Refund->memo); // memo
	$this->BuildSearchUrl($sSrchUrl, $Payment_Refund->year); // year
	$this->BuildSearchUrl($sSrchUrl, $Payment_Refund->scholarship_package_scholarship_package_id); // scholarship_package_scholarship_package_id
	$this->BuildSearchUrl($sSrchUrl, $Payment_Refund->programarea_residentarea_id); // programarea_residentarea_id
	$this->BuildSearchUrl($sSrchUrl, $Payment_Refund->programarea_payingarea_id); // programarea_payingarea_id
	$this->BuildSearchUrl($sSrchUrl, $Payment_Refund->payment_request_payment_request_id); // payment_request_payment_request_id
	$this->BuildSearchUrl($sSrchUrl, $Payment_Refund->bankname); // bankname
	$this->BuildSearchUrl($sSrchUrl, $Payment_Refund->account_no); // account_no
	$this->BuildSearchUrl($sSrchUrl, $Payment_Refund->schools_school_id); // schools_school_id
	$this->BuildSearchUrl($sSrchUrl, $Payment_Refund->group_id); // group_id
	return $sSrchUrl;
}

// Build search URL
function BuildSearchUrl(&$Url, &$Fld) {
	global $objForm;
	$sWrk = "";
	$FldParm = substr($Fld->FldVar, 2);
	$FldVal = $objForm->GetValue("x_$FldParm");
	$FldOpr = $objForm->GetValue("z_$FldParm");
	$FldCond = $objForm->GetValue("v_$FldParm");
	$FldVal2 = $objForm->GetValue("y_$FldParm");
	$FldOpr2 = $objForm->GetValue("w_$FldParm");
	$FldVal = ew_StripSlashes($FldVal);
	if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
	$FldVal2 = ew_StripSlashes($FldVal2);
	if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
	$FldOpr = strtoupper(trim($FldOpr));
	$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
			"&z_" . $FldParm . "=" . urlencode($FldOpr);
	} else {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $lFldDataType)) {

			//$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $lFldDataType)) {

			//$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
			$sWrk .= "&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&w_" . $FldParm . "=" . urlencode($FldOpr2);
		}
	}
	if ($sWrk <> "") {
		if ($Url <> "") $Url .= "&";
		$Url .= $sWrk;
	}
}

// Convert search value for date
function ConvertSearchValue(&$Fld, $FldVal) {
	$Value = $FldVal;
	if ($Fld->FldDataType == EW_DATATYPE_DATE && $FldVal <> "")
		$Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
	return $Value;
}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $Payment_Refund;

		// Load search values
		// scholarship_payment_id

		$Payment_Refund->scholarship_payment_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_scholarship_payment_id"));
		$Payment_Refund->scholarship_payment_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_scholarship_payment_id");

		// date
		$Payment_Refund->date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_date"));
		$Payment_Refund->date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_date");

		// status
		$Payment_Refund->status->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_status"));
		$Payment_Refund->status->AdvancedSearch->SearchOperator = $objForm->GetValue("z_status");

		// refund_amount
		$Payment_Refund->refund_amount->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_refund_amount"));
		$Payment_Refund->refund_amount->AdvancedSearch->SearchOperator = $objForm->GetValue("z_refund_amount");

		// amount
		$Payment_Refund->amount->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_amount"));
		$Payment_Refund->amount->AdvancedSearch->SearchOperator = $objForm->GetValue("z_amount");

		// memo
		$Payment_Refund->memo->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_memo"));
		$Payment_Refund->memo->AdvancedSearch->SearchOperator = $objForm->GetValue("z_memo");

		// year
		$Payment_Refund->year->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_year"));
		$Payment_Refund->year->AdvancedSearch->SearchOperator = $objForm->GetValue("z_year");

		// scholarship_package_scholarship_package_id
		$Payment_Refund->scholarship_package_scholarship_package_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_scholarship_package_scholarship_package_id"));
		$Payment_Refund->scholarship_package_scholarship_package_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_scholarship_package_scholarship_package_id");

		// programarea_residentarea_id
		$Payment_Refund->programarea_residentarea_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_programarea_residentarea_id"));
		$Payment_Refund->programarea_residentarea_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_programarea_residentarea_id");

		// programarea_payingarea_id
		$Payment_Refund->programarea_payingarea_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_programarea_payingarea_id"));
		$Payment_Refund->programarea_payingarea_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_programarea_payingarea_id");

		// payment_request_payment_request_id
		$Payment_Refund->payment_request_payment_request_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_payment_request_payment_request_id"));
		$Payment_Refund->payment_request_payment_request_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_payment_request_payment_request_id");

		// bankname
		$Payment_Refund->bankname->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_bankname"));
		$Payment_Refund->bankname->AdvancedSearch->SearchOperator = $objForm->GetValue("z_bankname");

		// account_no
		$Payment_Refund->account_no->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_account_no"));
		$Payment_Refund->account_no->AdvancedSearch->SearchOperator = $objForm->GetValue("z_account_no");

		// schools_school_id
		$Payment_Refund->schools_school_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_schools_school_id"));
		$Payment_Refund->schools_school_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_schools_school_id");

		// group_id
		$Payment_Refund->group_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_group_id"));
		$Payment_Refund->group_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_group_id");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $Payment_Refund;

		// Initialize URLs
		// Call Row_Rendering event

		$Payment_Refund->Row_Rendering();

		// Common render codes for all row types
		// scholarship_payment_id

		$Payment_Refund->scholarship_payment_id->CellCssStyle = ""; $Payment_Refund->scholarship_payment_id->CellCssClass = "";
		$Payment_Refund->scholarship_payment_id->CellAttrs = array(); $Payment_Refund->scholarship_payment_id->ViewAttrs = array(); $Payment_Refund->scholarship_payment_id->EditAttrs = array();

		// date
		$Payment_Refund->date->CellCssStyle = ""; $Payment_Refund->date->CellCssClass = "";
		$Payment_Refund->date->CellAttrs = array(); $Payment_Refund->date->ViewAttrs = array(); $Payment_Refund->date->EditAttrs = array();

		// status
		$Payment_Refund->status->CellCssStyle = ""; $Payment_Refund->status->CellCssClass = "";
		$Payment_Refund->status->CellAttrs = array(); $Payment_Refund->status->ViewAttrs = array(); $Payment_Refund->status->EditAttrs = array();

		// refund_amount
		$Payment_Refund->refund_amount->CellCssStyle = ""; $Payment_Refund->refund_amount->CellCssClass = "";
		$Payment_Refund->refund_amount->CellAttrs = array(); $Payment_Refund->refund_amount->ViewAttrs = array(); $Payment_Refund->refund_amount->EditAttrs = array();

		// amount
		$Payment_Refund->amount->CellCssStyle = ""; $Payment_Refund->amount->CellCssClass = "";
		$Payment_Refund->amount->CellAttrs = array(); $Payment_Refund->amount->ViewAttrs = array(); $Payment_Refund->amount->EditAttrs = array();

		// memo
		$Payment_Refund->memo->CellCssStyle = ""; $Payment_Refund->memo->CellCssClass = "";
		$Payment_Refund->memo->CellAttrs = array(); $Payment_Refund->memo->ViewAttrs = array(); $Payment_Refund->memo->EditAttrs = array();

		// year
		$Payment_Refund->year->CellCssStyle = ""; $Payment_Refund->year->CellCssClass = "";
		$Payment_Refund->year->CellAttrs = array(); $Payment_Refund->year->ViewAttrs = array(); $Payment_Refund->year->EditAttrs = array();

		// scholarship_package_scholarship_package_id
		$Payment_Refund->scholarship_package_scholarship_package_id->CellCssStyle = ""; $Payment_Refund->scholarship_package_scholarship_package_id->CellCssClass = "";
		$Payment_Refund->scholarship_package_scholarship_package_id->CellAttrs = array(); $Payment_Refund->scholarship_package_scholarship_package_id->ViewAttrs = array(); $Payment_Refund->scholarship_package_scholarship_package_id->EditAttrs = array();

		// programarea_residentarea_id
		$Payment_Refund->programarea_residentarea_id->CellCssStyle = ""; $Payment_Refund->programarea_residentarea_id->CellCssClass = "";
		$Payment_Refund->programarea_residentarea_id->CellAttrs = array(); $Payment_Refund->programarea_residentarea_id->ViewAttrs = array(); $Payment_Refund->programarea_residentarea_id->EditAttrs = array();

		// programarea_payingarea_id
		$Payment_Refund->programarea_payingarea_id->CellCssStyle = ""; $Payment_Refund->programarea_payingarea_id->CellCssClass = "";
		$Payment_Refund->programarea_payingarea_id->CellAttrs = array(); $Payment_Refund->programarea_payingarea_id->ViewAttrs = array(); $Payment_Refund->programarea_payingarea_id->EditAttrs = array();

		// payment_request_payment_request_id
		$Payment_Refund->payment_request_payment_request_id->CellCssStyle = ""; $Payment_Refund->payment_request_payment_request_id->CellCssClass = "";
		$Payment_Refund->payment_request_payment_request_id->CellAttrs = array(); $Payment_Refund->payment_request_payment_request_id->ViewAttrs = array(); $Payment_Refund->payment_request_payment_request_id->EditAttrs = array();

		// bankname
		$Payment_Refund->bankname->CellCssStyle = ""; $Payment_Refund->bankname->CellCssClass = "";
		$Payment_Refund->bankname->CellAttrs = array(); $Payment_Refund->bankname->ViewAttrs = array(); $Payment_Refund->bankname->EditAttrs = array();

		// account_no
		$Payment_Refund->account_no->CellCssStyle = ""; $Payment_Refund->account_no->CellCssClass = "";
		$Payment_Refund->account_no->CellAttrs = array(); $Payment_Refund->account_no->ViewAttrs = array(); $Payment_Refund->account_no->EditAttrs = array();

		// schools_school_id
		$Payment_Refund->schools_school_id->CellCssStyle = ""; $Payment_Refund->schools_school_id->CellCssClass = "";
		$Payment_Refund->schools_school_id->CellAttrs = array(); $Payment_Refund->schools_school_id->ViewAttrs = array(); $Payment_Refund->schools_school_id->EditAttrs = array();

		// group_id
		$Payment_Refund->group_id->CellCssStyle = ""; $Payment_Refund->group_id->CellCssClass = "";
		$Payment_Refund->group_id->CellAttrs = array(); $Payment_Refund->group_id->ViewAttrs = array(); $Payment_Refund->group_id->EditAttrs = array();
		if ($Payment_Refund->RowType == EW_ROWTYPE_VIEW) { // View row

			// scholarship_payment_id
			$Payment_Refund->scholarship_payment_id->ViewValue = $Payment_Refund->scholarship_payment_id->CurrentValue;
			$Payment_Refund->scholarship_payment_id->CssStyle = "";
			$Payment_Refund->scholarship_payment_id->CssClass = "";
			$Payment_Refund->scholarship_payment_id->ViewCustomAttributes = "";

			// date
			$Payment_Refund->date->ViewValue = $Payment_Refund->date->CurrentValue;
			$Payment_Refund->date->ViewValue = ew_FormatDateTime($Payment_Refund->date->ViewValue, 7);
			$Payment_Refund->date->CssStyle = "";
			$Payment_Refund->date->CssClass = "";
			$Payment_Refund->date->ViewCustomAttributes = "";

			// status
			if (strval($Payment_Refund->status->CurrentValue) <> "") {
				switch ($Payment_Refund->status->CurrentValue) {
					case "PENDING":
						$Payment_Refund->status->ViewValue = "PENDING";
						break;
					case "PAID":
						$Payment_Refund->status->ViewValue = "PAID";
						break;
					default:
						$Payment_Refund->status->ViewValue = $Payment_Refund->status->CurrentValue;
				}
			} else {
				$Payment_Refund->status->ViewValue = NULL;
			}
			$Payment_Refund->status->CssStyle = "";
			$Payment_Refund->status->CssClass = "";
			$Payment_Refund->status->ViewCustomAttributes = "";

			// refund_amount
			$Payment_Refund->refund_amount->ViewValue = $Payment_Refund->refund_amount->CurrentValue;
			$Payment_Refund->refund_amount->CssStyle = "";
			$Payment_Refund->refund_amount->CssClass = "";
			$Payment_Refund->refund_amount->ViewCustomAttributes = "";

			// amount
			$Payment_Refund->amount->ViewValue = $Payment_Refund->amount->CurrentValue;
			$Payment_Refund->amount->CssStyle = "";
			$Payment_Refund->amount->CssClass = "";
			$Payment_Refund->amount->ViewCustomAttributes = "";

			// memo
			$Payment_Refund->memo->ViewValue = $Payment_Refund->memo->CurrentValue;
			$Payment_Refund->memo->CssStyle = "";
			$Payment_Refund->memo->CssClass = "";
			$Payment_Refund->memo->ViewCustomAttributes = "";

			// year
			$Payment_Refund->year->ViewValue = $Payment_Refund->year->CurrentValue;
			$Payment_Refund->year->CssStyle = "";
			$Payment_Refund->year->CssClass = "";
			$Payment_Refund->year->ViewCustomAttributes = "";

			// scholarship_package_scholarship_package_id
			if (strval($Payment_Refund->scholarship_package_scholarship_package_id->CurrentValue) <> "") {
				$sFilterWrk = "`scholarship_package_id` = " . ew_AdjustSql($Payment_Refund->scholarship_package_scholarship_package_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `scholarship_type` FROM `scholarship_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->scholarship_package_scholarship_package_id->ViewValue = $rswrk->fields('scholarship_type');
					$rswrk->Close();
				} else {
					$Payment_Refund->scholarship_package_scholarship_package_id->ViewValue = $Payment_Refund->scholarship_package_scholarship_package_id->CurrentValue;
				}
			} else {
				$Payment_Refund->scholarship_package_scholarship_package_id->ViewValue = NULL;
			}
			$Payment_Refund->scholarship_package_scholarship_package_id->CssStyle = "";
			$Payment_Refund->scholarship_package_scholarship_package_id->CssClass = "";
			$Payment_Refund->scholarship_package_scholarship_package_id->ViewCustomAttributes = "";

			// programarea_residentarea_id
			if (strval($Payment_Refund->programarea_residentarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Payment_Refund->programarea_residentarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->programarea_residentarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Payment_Refund->programarea_residentarea_id->ViewValue = $Payment_Refund->programarea_residentarea_id->CurrentValue;
				}
			} else {
				$Payment_Refund->programarea_residentarea_id->ViewValue = NULL;
			}
			$Payment_Refund->programarea_residentarea_id->CssStyle = "";
			$Payment_Refund->programarea_residentarea_id->CssClass = "";
			$Payment_Refund->programarea_residentarea_id->ViewCustomAttributes = "";

			// programarea_payingarea_id
			if (strval($Payment_Refund->programarea_payingarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Payment_Refund->programarea_payingarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->programarea_payingarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Payment_Refund->programarea_payingarea_id->ViewValue = $Payment_Refund->programarea_payingarea_id->CurrentValue;
				}
			} else {
				$Payment_Refund->programarea_payingarea_id->ViewValue = NULL;
			}
			$Payment_Refund->programarea_payingarea_id->CssStyle = "";
			$Payment_Refund->programarea_payingarea_id->CssClass = "";
			$Payment_Refund->programarea_payingarea_id->ViewCustomAttributes = "";

			// payment_request_payment_request_id
			if (strval($Payment_Refund->payment_request_payment_request_id->CurrentValue) <> "") {
				$sFilterWrk = "`payment_request_id` = " . ew_AdjustSql($Payment_Refund->payment_request_payment_request_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `code` FROM `payment_request`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->payment_request_payment_request_id->ViewValue = $rswrk->fields('code');
					$rswrk->Close();
				} else {
					$Payment_Refund->payment_request_payment_request_id->ViewValue = $Payment_Refund->payment_request_payment_request_id->CurrentValue;
				}
			} else {
				$Payment_Refund->payment_request_payment_request_id->ViewValue = NULL;
			}
			$Payment_Refund->payment_request_payment_request_id->CssStyle = "";
			$Payment_Refund->payment_request_payment_request_id->CssClass = "";
			$Payment_Refund->payment_request_payment_request_id->ViewCustomAttributes = "";

			// bankname
			$Payment_Refund->bankname->ViewValue = $Payment_Refund->bankname->CurrentValue;
			$Payment_Refund->bankname->CssStyle = "";
			$Payment_Refund->bankname->CssClass = "";
			$Payment_Refund->bankname->ViewCustomAttributes = "";

			// account_no
			$Payment_Refund->account_no->ViewValue = $Payment_Refund->account_no->CurrentValue;
			$Payment_Refund->account_no->CssStyle = "";
			$Payment_Refund->account_no->CssClass = "";
			$Payment_Refund->account_no->ViewCustomAttributes = "";

			// schools_school_id
			if (strval($Payment_Refund->schools_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($Payment_Refund->schools_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->schools_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$Payment_Refund->schools_school_id->ViewValue = $Payment_Refund->schools_school_id->CurrentValue;
				}
			} else {
				$Payment_Refund->schools_school_id->ViewValue = NULL;
			}
			$Payment_Refund->schools_school_id->CssStyle = "";
			$Payment_Refund->schools_school_id->CssClass = "";
			$Payment_Refund->schools_school_id->ViewCustomAttributes = "";

			// group_id
			$Payment_Refund->group_id->ViewValue = $Payment_Refund->group_id->CurrentValue;
			$Payment_Refund->group_id->CssStyle = "";
			$Payment_Refund->group_id->CssClass = "";
			$Payment_Refund->group_id->ViewCustomAttributes = "";

			// scholarship_payment_id
			$Payment_Refund->scholarship_payment_id->HrefValue = "";
			$Payment_Refund->scholarship_payment_id->TooltipValue = "";

			// date
			$Payment_Refund->date->HrefValue = "";
			$Payment_Refund->date->TooltipValue = "";

			// status
			$Payment_Refund->status->HrefValue = "";
			$Payment_Refund->status->TooltipValue = "";

			// refund_amount
			$Payment_Refund->refund_amount->HrefValue = "";
			$Payment_Refund->refund_amount->TooltipValue = "";

			// amount
			$Payment_Refund->amount->HrefValue = "";
			$Payment_Refund->amount->TooltipValue = "";

			// memo
			$Payment_Refund->memo->HrefValue = "";
			$Payment_Refund->memo->TooltipValue = "";

			// year
			$Payment_Refund->year->HrefValue = "";
			$Payment_Refund->year->TooltipValue = "";

			// scholarship_package_scholarship_package_id
			$Payment_Refund->scholarship_package_scholarship_package_id->HrefValue = "";
			$Payment_Refund->scholarship_package_scholarship_package_id->TooltipValue = "";

			// programarea_residentarea_id
			$Payment_Refund->programarea_residentarea_id->HrefValue = "";
			$Payment_Refund->programarea_residentarea_id->TooltipValue = "";

			// programarea_payingarea_id
			$Payment_Refund->programarea_payingarea_id->HrefValue = "";
			$Payment_Refund->programarea_payingarea_id->TooltipValue = "";

			// payment_request_payment_request_id
			$Payment_Refund->payment_request_payment_request_id->HrefValue = "";
			$Payment_Refund->payment_request_payment_request_id->TooltipValue = "";

			// bankname
			$Payment_Refund->bankname->HrefValue = "";
			$Payment_Refund->bankname->TooltipValue = "";

			// account_no
			$Payment_Refund->account_no->HrefValue = "";
			$Payment_Refund->account_no->TooltipValue = "";

			// schools_school_id
			$Payment_Refund->schools_school_id->HrefValue = "";
			$Payment_Refund->schools_school_id->TooltipValue = "";

			// group_id
			$Payment_Refund->group_id->HrefValue = "";
			$Payment_Refund->group_id->TooltipValue = "";
		} elseif ($Payment_Refund->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// scholarship_payment_id
			$Payment_Refund->scholarship_payment_id->EditCustomAttributes = "";
			$Payment_Refund->scholarship_payment_id->EditValue = ew_HtmlEncode($Payment_Refund->scholarship_payment_id->AdvancedSearch->SearchValue);

			// date
			$Payment_Refund->date->EditCustomAttributes = "";
			$Payment_Refund->date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($Payment_Refund->date->AdvancedSearch->SearchValue, 7), 7));

			// status
			$Payment_Refund->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("PENDING", "PENDING");
			$arwrk[] = array("PAID", "PAID");
			$Payment_Refund->status->EditValue = $arwrk;

			// refund_amount
			$Payment_Refund->refund_amount->EditCustomAttributes = "";
			$Payment_Refund->refund_amount->EditValue = ew_HtmlEncode($Payment_Refund->refund_amount->AdvancedSearch->SearchValue);

			// amount
			$Payment_Refund->amount->EditCustomAttributes = "";
			$Payment_Refund->amount->EditValue = ew_HtmlEncode($Payment_Refund->amount->AdvancedSearch->SearchValue);

			// memo
			$Payment_Refund->memo->EditCustomAttributes = "";
			$Payment_Refund->memo->EditValue = ew_HtmlEncode($Payment_Refund->memo->AdvancedSearch->SearchValue);

			// year
			$Payment_Refund->year->EditCustomAttributes = "";
			$Payment_Refund->year->EditValue = ew_HtmlEncode($Payment_Refund->year->AdvancedSearch->SearchValue);

			// scholarship_package_scholarship_package_id
			$Payment_Refund->scholarship_package_scholarship_package_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `scholarship_package_id`, `scholarship_type`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `scholarship_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			$sWhereWrk = $GLOBALS["scholarship_package"]->AddUserIDFilter($sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$Payment_Refund->scholarship_package_scholarship_package_id->EditValue = $arwrk;

			// programarea_residentarea_id
			$Payment_Refund->programarea_residentarea_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `programarea_id`, `programarea_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$Payment_Refund->programarea_residentarea_id->EditValue = $arwrk;

			// programarea_payingarea_id
			$Payment_Refund->programarea_payingarea_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `programarea_id`, `programarea_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$Payment_Refund->programarea_payingarea_id->EditValue = $arwrk;

			// payment_request_payment_request_id
			$Payment_Refund->payment_request_payment_request_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `payment_request_id`, `code`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `payment_request`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			$sWhereWrk = $GLOBALS["payment_request"]->AddUserIDFilter($sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$Payment_Refund->payment_request_payment_request_id->EditValue = $arwrk;

			// bankname
			$Payment_Refund->bankname->EditCustomAttributes = "";
			$Payment_Refund->bankname->EditValue = ew_HtmlEncode($Payment_Refund->bankname->AdvancedSearch->SearchValue);

			// account_no
			$Payment_Refund->account_no->EditCustomAttributes = "";
			$Payment_Refund->account_no->EditValue = ew_HtmlEncode($Payment_Refund->account_no->AdvancedSearch->SearchValue);

			// schools_school_id
			$Payment_Refund->schools_school_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `school_id`, `school_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$Payment_Refund->schools_school_id->EditValue = $arwrk;

			// group_id
			$Payment_Refund->group_id->EditCustomAttributes = "";
			if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin
			$sFilterWrk = "";
			$sFilterWrk = $GLOBALS["users"]->AddUserIDFilter("");
			$sSqlWrk = "SELECT `userlevelid`, `userlevelid` FROM `users`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$Payment_Refund->group_id->EditValue = $arwrk;
			} else {
			$Payment_Refund->group_id->EditValue = ew_HtmlEncode($Payment_Refund->group_id->AdvancedSearch->SearchValue);
			}
		}

		// Call Row Rendered event
		if ($Payment_Refund->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$Payment_Refund->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $Payment_Refund;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($Payment_Refund->scholarship_payment_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $Payment_Refund->scholarship_payment_id->FldErrMsg();
		}
		if (!ew_CheckEuroDate($Payment_Refund->date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $Payment_Refund->date->FldErrMsg();
		}
		if (!ew_CheckNumber($Payment_Refund->refund_amount->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $Payment_Refund->refund_amount->FldErrMsg();
		}
		if (!ew_CheckNumber($Payment_Refund->amount->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $Payment_Refund->amount->FldErrMsg();
		}
		if (!ew_CheckInteger($Payment_Refund->year->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $Payment_Refund->year->FldErrMsg();
		}
		if (!ew_CheckInteger($Payment_Refund->group_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $Payment_Refund->group_id->FldErrMsg();
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $Payment_Refund;
		$Payment_Refund->scholarship_payment_id->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_scholarship_payment_id");
		$Payment_Refund->date->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_date");
		$Payment_Refund->status->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_status");
		$Payment_Refund->refund_amount->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_refund_amount");
		$Payment_Refund->amount->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_amount");
		$Payment_Refund->memo->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_memo");
		$Payment_Refund->year->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_year");
		$Payment_Refund->scholarship_package_scholarship_package_id->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_scholarship_package_scholarship_package_id");
		$Payment_Refund->programarea_residentarea_id->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_programarea_residentarea_id");
		$Payment_Refund->programarea_payingarea_id->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_programarea_payingarea_id");
		$Payment_Refund->payment_request_payment_request_id->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_payment_request_payment_request_id");
		$Payment_Refund->bankname->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_bankname");
		$Payment_Refund->account_no->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_account_no");
		$Payment_Refund->schools_school_id->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_schools_school_id");
		$Payment_Refund->group_id->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_group_id");
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
