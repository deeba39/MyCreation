<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "scholarship_paymentinfo.php" ?>
<?php include "sponsored_studentinfo.php" ?>
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
$scholarship_payment_search = new cscholarship_payment_search();
$Page =& $scholarship_payment_search;

// Page init
$scholarship_payment_search->Page_Init();

// Page main
$scholarship_payment_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var scholarship_payment_search = new ew_Page("scholarship_payment_search");

// page properties
scholarship_payment_search.PageID = "search"; // page ID
scholarship_payment_search.FormID = "fscholarship_paymentsearch"; // form ID
var EW_PAGE_ID = scholarship_payment_search.PageID; // for backward compatibility

// extend page with validate function for search
scholarship_payment_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_scholarship_payment_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_payment->scholarship_payment_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_payment->date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_amount"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_payment->amount->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_payment->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_refund_amount"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_payment->refund_amount->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_schools_school_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_payment->schools_school_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_group_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_payment->group_id->FldErrMsg()) ?>");

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
scholarship_payment_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
scholarship_payment_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
scholarship_payment_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $scholarship_payment->TableCaption() ?><br><br>
<a href="<?php echo $scholarship_payment->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$scholarship_payment_search->ShowMessage();
?>
<form name="fscholarship_paymentsearch" id="fscholarship_paymentsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return scholarship_payment_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="scholarship_payment">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->scholarship_payment_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->scholarship_payment_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_scholarship_payment_id" id="z_scholarship_payment_id" value="="></span></td>
		<td<?php echo $scholarship_payment->scholarship_payment_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_scholarship_payment_id" id="x_scholarship_payment_id" title="<?php echo $scholarship_payment->scholarship_payment_id->FldTitle() ?>" value="<?php echo $scholarship_payment->scholarship_payment_id->EditValue ?>"<?php echo $scholarship_payment->scholarship_payment_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->date->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->date->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_date" id="z_date" onchange="ew_SrchOprChanged('z_date')"><option value="="<?php echo ($scholarship_payment->date->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($scholarship_payment->date->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($scholarship_payment->date->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($scholarship_payment->date->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($scholarship_payment->date->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($scholarship_payment->date->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($scholarship_payment->date->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $scholarship_payment->date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_date" id="x_date" title="<?php echo $scholarship_payment->date->FldTitle() ?>" value="<?php echo $scholarship_payment->date->EditValue ?>"<?php echo $scholarship_payment->date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_date" name="cal_x_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_date" // button id
});
</script>
</span>
				<span class="ewSearchOpr" id="btw0_date" name="btw0_date"><label><input type="radio" name="v_date" id="v_date" value="AND"<?php if ($scholarship_payment->date->AdvancedSearch->SearchCondition <> "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("AND") ?></label>&nbsp;<label><input type="radio" name="v_date" id="v_date" value="OR"<?php if ($scholarship_payment->date->AdvancedSearch->SearchCondition == "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("OR") ?></label>&nbsp;</span>
				<span class="ewSearchOpr" id="btw1_date" name="btw1_date">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="ewSearchOpr" id="btw0_date" name="btw0_date" ><select name="w_date" id="w_date"><option value="="<?php echo ($scholarship_payment->date->AdvancedSearch->SearchOperator2=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($scholarship_payment->date->AdvancedSearch->SearchOperator2=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($scholarship_payment->date->AdvancedSearch->SearchOperator2=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($scholarship_payment->date->AdvancedSearch->SearchOperator2=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($scholarship_payment->date->AdvancedSearch->SearchOperator2==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($scholarship_payment->date->AdvancedSearch->SearchOperator2==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option></select></span>
				<span class="phpmaker" style="float: left;">
<input type="text" name="y_date" id="y_date" title="<?php echo $scholarship_payment->date->FldTitle() ?>" value="<?php echo $scholarship_payment->date->EditValue2 ?>"<?php echo $scholarship_payment->date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_y_date" name="cal_y_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_y_date" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->status->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->status->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_status" id="z_status" value="="></span></td>
		<td<?php echo $scholarship_payment->status->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $scholarship_payment->status->FldTitle() ?>" value="{value}"<?php echo $scholarship_payment->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $scholarship_payment->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($scholarship_payment->status->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $scholarship_payment->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $scholarship_payment->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->amount->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->amount->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_amount" id="z_amount" value="="></span></td>
		<td<?php echo $scholarship_payment->amount->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_amount" id="x_amount" title="<?php echo $scholarship_payment->amount->FldTitle() ?>" size="30" value="<?php echo $scholarship_payment->amount->EditValue ?>"<?php echo $scholarship_payment->amount->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->memo->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->memo->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_memo" id="z_memo" value="LIKE"></span></td>
		<td<?php echo $scholarship_payment->memo->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_memo" id="x_memo" title="<?php echo $scholarship_payment->memo->FldTitle() ?>" cols="40" rows="4"<?php echo $scholarship_payment->memo->EditAttributes() ?>><?php echo $scholarship_payment->memo->EditValue ?></textarea>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->year->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->year->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_year" id="z_year" value="="></span></td>
		<td<?php echo $scholarship_payment->year->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_year" id="x_year" title="<?php echo $scholarship_payment->year->FldTitle() ?>" size="30" value="<?php echo $scholarship_payment->year->EditValue ?>"<?php echo $scholarship_payment->year->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->scholarship_package_scholarship_package_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->scholarship_package_scholarship_package_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_scholarship_package_scholarship_package_id" id="z_scholarship_package_scholarship_package_id" value="="></span></td>
		<td<?php echo $scholarship_payment->scholarship_package_scholarship_package_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_scholarship_package_scholarship_package_id" name="x_scholarship_package_scholarship_package_id" title="<?php echo $scholarship_payment->scholarship_package_scholarship_package_id->FldTitle() ?>"<?php echo $scholarship_payment->scholarship_package_scholarship_package_id->EditAttributes() ?>>
<?php
if (is_array($scholarship_payment->scholarship_package_scholarship_package_id->EditValue)) {
	$arwrk = $scholarship_payment->scholarship_package_scholarship_package_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($scholarship_payment->scholarship_package_scholarship_package_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->programarea_residentarea_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->programarea_residentarea_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_programarea_residentarea_id" id="z_programarea_residentarea_id" value="="></span></td>
		<td<?php echo $scholarship_payment->programarea_residentarea_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_programarea_residentarea_id" name="x_programarea_residentarea_id" title="<?php echo $scholarship_payment->programarea_residentarea_id->FldTitle() ?>"<?php echo $scholarship_payment->programarea_residentarea_id->EditAttributes() ?>>
<?php
if (is_array($scholarship_payment->programarea_residentarea_id->EditValue)) {
	$arwrk = $scholarship_payment->programarea_residentarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($scholarship_payment->programarea_residentarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->programarea_payingarea_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->programarea_payingarea_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_programarea_payingarea_id" id="z_programarea_payingarea_id" value="="></span></td>
		<td<?php echo $scholarship_payment->programarea_payingarea_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_programarea_payingarea_id" name="x_programarea_payingarea_id" title="<?php echo $scholarship_payment->programarea_payingarea_id->FldTitle() ?>"<?php echo $scholarship_payment->programarea_payingarea_id->EditAttributes() ?>>
<?php
if (is_array($scholarship_payment->programarea_payingarea_id->EditValue)) {
	$arwrk = $scholarship_payment->programarea_payingarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($scholarship_payment->programarea_payingarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->refund_amount->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->refund_amount->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_refund_amount" id="z_refund_amount" value="="></span></td>
		<td<?php echo $scholarship_payment->refund_amount->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_refund_amount" id="x_refund_amount" title="<?php echo $scholarship_payment->refund_amount->FldTitle() ?>" size="30" value="<?php echo $scholarship_payment->refund_amount->EditValue ?>"<?php echo $scholarship_payment->refund_amount->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->payment_request_payment_request_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->payment_request_payment_request_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_payment_request_payment_request_id" id="z_payment_request_payment_request_id" value="="></span></td>
		<td<?php echo $scholarship_payment->payment_request_payment_request_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_payment_request_payment_request_id" name="x_payment_request_payment_request_id" title="<?php echo $scholarship_payment->payment_request_payment_request_id->FldTitle() ?>"<?php echo $scholarship_payment->payment_request_payment_request_id->EditAttributes() ?>>
<?php
if (is_array($scholarship_payment->payment_request_payment_request_id->EditValue)) {
	$arwrk = $scholarship_payment->payment_request_payment_request_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($scholarship_payment->payment_request_payment_request_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->bankname->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->bankname->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_bankname" id="z_bankname" value="LIKE"></span></td>
		<td<?php echo $scholarship_payment->bankname->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_bankname" id="x_bankname" title="<?php echo $scholarship_payment->bankname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $scholarship_payment->bankname->EditValue ?>"<?php echo $scholarship_payment->bankname->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->account_no->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->account_no->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_account_no" id="z_account_no" value="LIKE"></span></td>
		<td<?php echo $scholarship_payment->account_no->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_account_no" id="x_account_no" title="<?php echo $scholarship_payment->account_no->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $scholarship_payment->account_no->EditValue ?>"<?php echo $scholarship_payment->account_no->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->schools_school_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->schools_school_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_schools_school_id" id="z_schools_school_id" value="="></span></td>
		<td<?php echo $scholarship_payment->schools_school_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="as_x_schools_school_id" style="z-index: 8860">
	<input type="text" name="sv_x_schools_school_id" id="sv_x_schools_school_id" value="<?php echo $scholarship_payment->schools_school_id->EditValue ?>" title="<?php echo $scholarship_payment->schools_school_id->FldTitle() ?>" size="30"<?php echo $scholarship_payment->schools_school_id->EditAttributes() ?>>&nbsp;<span id="em_x_schools_school_id" class="ewMessage" style="display: none"><?php echo $Language->Phrase("UnmatchedValue") ?></span>
	<div id="sc_x_schools_school_id"></div>
</div>
<input type="hidden" name="x_schools_school_id" id="x_schools_school_id" value="<?php echo $scholarship_payment->schools_school_id->AdvancedSearch->SearchValue ?>">
<?php
$sSqlWrk = "SELECT `school_id`, `school_name` FROM `schools`";
$sWhereWrk = "`school_name` LIKE '{query_value}%'";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_schools_school_id" id="s_x_schools_school_id" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x_schools_school_id = new ew_AutoSuggest("sv_x_schools_school_id", "sc_x_schools_school_id", "s_x_schools_school_id", "em_x_schools_school_id", "x_schools_school_id", "", false);
oas_x_schools_school_id.formatResult = function(ar) {	
	var df1 = ar[1];
	return df1;
};
oas_x_schools_school_id.ac.typeAhead = false;

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->group_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->group_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_group_id" id="z_group_id" value="="></span></td>
		<td<?php echo $scholarship_payment->group_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_group_id" name="x_group_id" title="<?php echo $scholarship_payment->group_id->FldTitle() ?>"<?php echo $scholarship_payment->group_id->EditAttributes() ?>>
<?php
if (is_array($scholarship_payment->group_id->EditValue)) {
	$arwrk = $scholarship_payment->group_id->EditValue;
	if ($arwrk[0][0] <> "") echo "<option value=\"\">" . $Language->Phrase("PleaseSelect") . "</option>";
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($scholarship_payment->group_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<input type="text" name="x_group_id" id="x_group_id" title="<?php echo $scholarship_payment->group_id->FldTitle() ?>" size="30" value="<?php echo $scholarship_payment->group_id->EditValue ?>"<?php echo $scholarship_payment->group_id->EditAttributes() ?>>
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
ew_SrchOprChanged('z_date');

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$scholarship_payment_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cscholarship_payment_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'scholarship_payment';

	// Page object name
	var $PageObjName = 'scholarship_payment_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $scholarship_payment;
		if ($scholarship_payment->UseTokenInUrl) $PageUrl .= "t=" . $scholarship_payment->TableVar . "&"; // Add page token
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
		global $objForm, $scholarship_payment;
		if ($scholarship_payment->UseTokenInUrl) {
			if ($objForm)
				return ($scholarship_payment->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($scholarship_payment->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cscholarship_payment_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (scholarship_payment)
		$GLOBALS["scholarship_payment"] = new cscholarship_payment();

		// Table object (sponsored_student)
		$GLOBALS['sponsored_student'] = new csponsored_student();

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
			define("EW_TABLE_NAME", 'scholarship_payment', TRUE);

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
		global $scholarship_payment;

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
			$this->Page_Terminate("scholarship_paymentlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("scholarship_paymentlist.php");
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
		global $objForm, $Language, $gsSearchError, $scholarship_payment;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$scholarship_payment->CurrentAction = $objForm->GetValue("a_search");
			switch ($scholarship_payment->CurrentAction) {
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
						$sSrchStr = $scholarship_payment->UrlParm($sSrchStr);
						$this->Page_Terminate("scholarship_paymentlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$scholarship_payment->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $scholarship_payment;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $scholarship_payment->scholarship_payment_id); // scholarship_payment_id
	$this->BuildSearchUrl($sSrchUrl, $scholarship_payment->date); // date
	$this->BuildSearchUrl($sSrchUrl, $scholarship_payment->status); // status
	$this->BuildSearchUrl($sSrchUrl, $scholarship_payment->amount); // amount
	$this->BuildSearchUrl($sSrchUrl, $scholarship_payment->memo); // memo
	$this->BuildSearchUrl($sSrchUrl, $scholarship_payment->year); // year
	$this->BuildSearchUrl($sSrchUrl, $scholarship_payment->scholarship_package_scholarship_package_id); // scholarship_package_scholarship_package_id
	$this->BuildSearchUrl($sSrchUrl, $scholarship_payment->programarea_residentarea_id); // programarea_residentarea_id
	$this->BuildSearchUrl($sSrchUrl, $scholarship_payment->programarea_payingarea_id); // programarea_payingarea_id
	$this->BuildSearchUrl($sSrchUrl, $scholarship_payment->refund_amount); // refund_amount
	$this->BuildSearchUrl($sSrchUrl, $scholarship_payment->payment_request_payment_request_id); // payment_request_payment_request_id
	$this->BuildSearchUrl($sSrchUrl, $scholarship_payment->bankname); // bankname
	$this->BuildSearchUrl($sSrchUrl, $scholarship_payment->account_no); // account_no
	$this->BuildSearchUrl($sSrchUrl, $scholarship_payment->schools_school_id); // schools_school_id
	$this->BuildSearchUrl($sSrchUrl, $scholarship_payment->group_id); // group_id
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
		global $objForm, $scholarship_payment;

		// Load search values
		// scholarship_payment_id

		$scholarship_payment->scholarship_payment_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_scholarship_payment_id"));
		$scholarship_payment->scholarship_payment_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_scholarship_payment_id");

		// date
		$scholarship_payment->date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_date"));
		$scholarship_payment->date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_date");
		$scholarship_payment->date->AdvancedSearch->SearchCondition = $objForm->GetValue("v_date");
		$scholarship_payment->date->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_date"));
		$scholarship_payment->date->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_date");

		// status
		$scholarship_payment->status->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_status"));
		$scholarship_payment->status->AdvancedSearch->SearchOperator = $objForm->GetValue("z_status");

		// amount
		$scholarship_payment->amount->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_amount"));
		$scholarship_payment->amount->AdvancedSearch->SearchOperator = $objForm->GetValue("z_amount");

		// memo
		$scholarship_payment->memo->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_memo"));
		$scholarship_payment->memo->AdvancedSearch->SearchOperator = $objForm->GetValue("z_memo");

		// year
		$scholarship_payment->year->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_year"));
		$scholarship_payment->year->AdvancedSearch->SearchOperator = $objForm->GetValue("z_year");

		// scholarship_package_scholarship_package_id
		$scholarship_payment->scholarship_package_scholarship_package_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_scholarship_package_scholarship_package_id"));
		$scholarship_payment->scholarship_package_scholarship_package_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_scholarship_package_scholarship_package_id");

		// programarea_residentarea_id
		$scholarship_payment->programarea_residentarea_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_programarea_residentarea_id"));
		$scholarship_payment->programarea_residentarea_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_programarea_residentarea_id");

		// programarea_payingarea_id
		$scholarship_payment->programarea_payingarea_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_programarea_payingarea_id"));
		$scholarship_payment->programarea_payingarea_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_programarea_payingarea_id");

		// refund_amount
		$scholarship_payment->refund_amount->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_refund_amount"));
		$scholarship_payment->refund_amount->AdvancedSearch->SearchOperator = $objForm->GetValue("z_refund_amount");

		// payment_request_payment_request_id
		$scholarship_payment->payment_request_payment_request_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_payment_request_payment_request_id"));
		$scholarship_payment->payment_request_payment_request_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_payment_request_payment_request_id");

		// bankname
		$scholarship_payment->bankname->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_bankname"));
		$scholarship_payment->bankname->AdvancedSearch->SearchOperator = $objForm->GetValue("z_bankname");

		// account_no
		$scholarship_payment->account_no->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_account_no"));
		$scholarship_payment->account_no->AdvancedSearch->SearchOperator = $objForm->GetValue("z_account_no");

		// schools_school_id
		$scholarship_payment->schools_school_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_schools_school_id"));
		$scholarship_payment->schools_school_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_schools_school_id");

		// group_id
		$scholarship_payment->group_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_group_id"));
		$scholarship_payment->group_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_group_id");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $scholarship_payment;

		// Initialize URLs
		// Call Row_Rendering event

		$scholarship_payment->Row_Rendering();

		// Common render codes for all row types
		// scholarship_payment_id

		$scholarship_payment->scholarship_payment_id->CellCssStyle = ""; $scholarship_payment->scholarship_payment_id->CellCssClass = "";
		$scholarship_payment->scholarship_payment_id->CellAttrs = array(); $scholarship_payment->scholarship_payment_id->ViewAttrs = array(); $scholarship_payment->scholarship_payment_id->EditAttrs = array();

		// date
		$scholarship_payment->date->CellCssStyle = ""; $scholarship_payment->date->CellCssClass = "";
		$scholarship_payment->date->CellAttrs = array(); $scholarship_payment->date->ViewAttrs = array(); $scholarship_payment->date->EditAttrs = array();

		// status
		$scholarship_payment->status->CellCssStyle = ""; $scholarship_payment->status->CellCssClass = "";
		$scholarship_payment->status->CellAttrs = array(); $scholarship_payment->status->ViewAttrs = array(); $scholarship_payment->status->EditAttrs = array();

		// amount
		$scholarship_payment->amount->CellCssStyle = ""; $scholarship_payment->amount->CellCssClass = "";
		$scholarship_payment->amount->CellAttrs = array(); $scholarship_payment->amount->ViewAttrs = array(); $scholarship_payment->amount->EditAttrs = array();

		// memo
		$scholarship_payment->memo->CellCssStyle = ""; $scholarship_payment->memo->CellCssClass = "";
		$scholarship_payment->memo->CellAttrs = array(); $scholarship_payment->memo->ViewAttrs = array(); $scholarship_payment->memo->EditAttrs = array();

		// year
		$scholarship_payment->year->CellCssStyle = ""; $scholarship_payment->year->CellCssClass = "";
		$scholarship_payment->year->CellAttrs = array(); $scholarship_payment->year->ViewAttrs = array(); $scholarship_payment->year->EditAttrs = array();

		// scholarship_package_scholarship_package_id
		$scholarship_payment->scholarship_package_scholarship_package_id->CellCssStyle = ""; $scholarship_payment->scholarship_package_scholarship_package_id->CellCssClass = "";
		$scholarship_payment->scholarship_package_scholarship_package_id->CellAttrs = array(); $scholarship_payment->scholarship_package_scholarship_package_id->ViewAttrs = array(); $scholarship_payment->scholarship_package_scholarship_package_id->EditAttrs = array();

		// programarea_residentarea_id
		$scholarship_payment->programarea_residentarea_id->CellCssStyle = ""; $scholarship_payment->programarea_residentarea_id->CellCssClass = "";
		$scholarship_payment->programarea_residentarea_id->CellAttrs = array(); $scholarship_payment->programarea_residentarea_id->ViewAttrs = array(); $scholarship_payment->programarea_residentarea_id->EditAttrs = array();

		// programarea_payingarea_id
		$scholarship_payment->programarea_payingarea_id->CellCssStyle = ""; $scholarship_payment->programarea_payingarea_id->CellCssClass = "";
		$scholarship_payment->programarea_payingarea_id->CellAttrs = array(); $scholarship_payment->programarea_payingarea_id->ViewAttrs = array(); $scholarship_payment->programarea_payingarea_id->EditAttrs = array();

		// refund_amount
		$scholarship_payment->refund_amount->CellCssStyle = ""; $scholarship_payment->refund_amount->CellCssClass = "";
		$scholarship_payment->refund_amount->CellAttrs = array(); $scholarship_payment->refund_amount->ViewAttrs = array(); $scholarship_payment->refund_amount->EditAttrs = array();

		// payment_request_payment_request_id
		$scholarship_payment->payment_request_payment_request_id->CellCssStyle = ""; $scholarship_payment->payment_request_payment_request_id->CellCssClass = "";
		$scholarship_payment->payment_request_payment_request_id->CellAttrs = array(); $scholarship_payment->payment_request_payment_request_id->ViewAttrs = array(); $scholarship_payment->payment_request_payment_request_id->EditAttrs = array();

		// bankname
		$scholarship_payment->bankname->CellCssStyle = ""; $scholarship_payment->bankname->CellCssClass = "";
		$scholarship_payment->bankname->CellAttrs = array(); $scholarship_payment->bankname->ViewAttrs = array(); $scholarship_payment->bankname->EditAttrs = array();

		// account_no
		$scholarship_payment->account_no->CellCssStyle = ""; $scholarship_payment->account_no->CellCssClass = "";
		$scholarship_payment->account_no->CellAttrs = array(); $scholarship_payment->account_no->ViewAttrs = array(); $scholarship_payment->account_no->EditAttrs = array();

		// schools_school_id
		$scholarship_payment->schools_school_id->CellCssStyle = ""; $scholarship_payment->schools_school_id->CellCssClass = "";
		$scholarship_payment->schools_school_id->CellAttrs = array(); $scholarship_payment->schools_school_id->ViewAttrs = array(); $scholarship_payment->schools_school_id->EditAttrs = array();

		// group_id
		$scholarship_payment->group_id->CellCssStyle = ""; $scholarship_payment->group_id->CellCssClass = "";
		$scholarship_payment->group_id->CellAttrs = array(); $scholarship_payment->group_id->ViewAttrs = array(); $scholarship_payment->group_id->EditAttrs = array();
		if ($scholarship_payment->RowType == EW_ROWTYPE_VIEW) { // View row

			// scholarship_payment_id
			$scholarship_payment->scholarship_payment_id->ViewValue = $scholarship_payment->scholarship_payment_id->CurrentValue;
			$scholarship_payment->scholarship_payment_id->CssStyle = "";
			$scholarship_payment->scholarship_payment_id->CssClass = "";
			$scholarship_payment->scholarship_payment_id->ViewCustomAttributes = "";

			// date
			$scholarship_payment->date->ViewValue = $scholarship_payment->date->CurrentValue;
			$scholarship_payment->date->ViewValue = ew_FormatDateTime($scholarship_payment->date->ViewValue, 7);
			$scholarship_payment->date->CssStyle = "";
			$scholarship_payment->date->CssClass = "";
			$scholarship_payment->date->ViewCustomAttributes = "";

			// status
			if (strval($scholarship_payment->status->CurrentValue) <> "") {
				switch ($scholarship_payment->status->CurrentValue) {
					case "PENDING":
						$scholarship_payment->status->ViewValue = "PENDING";
						break;
					case "PAID":
						$scholarship_payment->status->ViewValue = "PAID";
						break;
					default:
						$scholarship_payment->status->ViewValue = $scholarship_payment->status->CurrentValue;
				}
			} else {
				$scholarship_payment->status->ViewValue = NULL;
			}
			$scholarship_payment->status->CssStyle = "";
			$scholarship_payment->status->CssClass = "";
			$scholarship_payment->status->ViewCustomAttributes = "";

			// amount
			$scholarship_payment->amount->ViewValue = $scholarship_payment->amount->CurrentValue;
			$scholarship_payment->amount->CssStyle = "";
			$scholarship_payment->amount->CssClass = "";
			$scholarship_payment->amount->ViewCustomAttributes = "";

			// memo
			$scholarship_payment->memo->ViewValue = $scholarship_payment->memo->CurrentValue;
			$scholarship_payment->memo->CssStyle = "";
			$scholarship_payment->memo->CssClass = "";
			$scholarship_payment->memo->ViewCustomAttributes = "";

			// year
			$scholarship_payment->year->ViewValue = $scholarship_payment->year->CurrentValue;
			$scholarship_payment->year->CssStyle = "";
			$scholarship_payment->year->CssClass = "";
			$scholarship_payment->year->ViewCustomAttributes = "";

			// scholarship_package_scholarship_package_id
			if (strval($scholarship_payment->scholarship_package_scholarship_package_id->CurrentValue) <> "") {
				$sFilterWrk = "`scholarship_package_id` = " . ew_AdjustSql($scholarship_payment->scholarship_package_scholarship_package_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `annual_amount` FROM `scholarship_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->scholarship_package_scholarship_package_id->ViewValue = $rswrk->fields('annual_amount');
					$rswrk->Close();
				} else {
					$scholarship_payment->scholarship_package_scholarship_package_id->ViewValue = $scholarship_payment->scholarship_package_scholarship_package_id->CurrentValue;
				}
			} else {
				$scholarship_payment->scholarship_package_scholarship_package_id->ViewValue = NULL;
			}
			$scholarship_payment->scholarship_package_scholarship_package_id->CssStyle = "";
			$scholarship_payment->scholarship_package_scholarship_package_id->CssClass = "";
			$scholarship_payment->scholarship_package_scholarship_package_id->ViewCustomAttributes = "";

			// programarea_residentarea_id
			if (strval($scholarship_payment->programarea_residentarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($scholarship_payment->programarea_residentarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->programarea_residentarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$scholarship_payment->programarea_residentarea_id->ViewValue = $scholarship_payment->programarea_residentarea_id->CurrentValue;
				}
			} else {
				$scholarship_payment->programarea_residentarea_id->ViewValue = NULL;
			}
			$scholarship_payment->programarea_residentarea_id->CssStyle = "";
			$scholarship_payment->programarea_residentarea_id->CssClass = "";
			$scholarship_payment->programarea_residentarea_id->ViewCustomAttributes = "";

			// programarea_payingarea_id
			if (strval($scholarship_payment->programarea_payingarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($scholarship_payment->programarea_payingarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->programarea_payingarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$scholarship_payment->programarea_payingarea_id->ViewValue = $scholarship_payment->programarea_payingarea_id->CurrentValue;
				}
			} else {
				$scholarship_payment->programarea_payingarea_id->ViewValue = NULL;
			}
			$scholarship_payment->programarea_payingarea_id->CssStyle = "";
			$scholarship_payment->programarea_payingarea_id->CssClass = "";
			$scholarship_payment->programarea_payingarea_id->ViewCustomAttributes = "";

			// refund_amount
			$scholarship_payment->refund_amount->ViewValue = $scholarship_payment->refund_amount->CurrentValue;
			$scholarship_payment->refund_amount->CssStyle = "";
			$scholarship_payment->refund_amount->CssClass = "";
			$scholarship_payment->refund_amount->ViewCustomAttributes = "";

			// payment_request_payment_request_id
			if (strval($scholarship_payment->payment_request_payment_request_id->CurrentValue) <> "") {
				$sFilterWrk = "`payment_request_id` = " . ew_AdjustSql($scholarship_payment->payment_request_payment_request_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `code` FROM `payment_request`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->payment_request_payment_request_id->ViewValue = $rswrk->fields('code');
					$rswrk->Close();
				} else {
					$scholarship_payment->payment_request_payment_request_id->ViewValue = $scholarship_payment->payment_request_payment_request_id->CurrentValue;
				}
			} else {
				$scholarship_payment->payment_request_payment_request_id->ViewValue = NULL;
			}
			$scholarship_payment->payment_request_payment_request_id->CssStyle = "";
			$scholarship_payment->payment_request_payment_request_id->CssClass = "";
			$scholarship_payment->payment_request_payment_request_id->ViewCustomAttributes = "";

			// bankname
			$scholarship_payment->bankname->ViewValue = $scholarship_payment->bankname->CurrentValue;
			$scholarship_payment->bankname->CssStyle = "";
			$scholarship_payment->bankname->CssClass = "";
			$scholarship_payment->bankname->ViewCustomAttributes = "";

			// account_no
			$scholarship_payment->account_no->ViewValue = $scholarship_payment->account_no->CurrentValue;
			$scholarship_payment->account_no->CssStyle = "";
			$scholarship_payment->account_no->CssClass = "";
			$scholarship_payment->account_no->ViewCustomAttributes = "";

			// schools_school_id
			$scholarship_payment->schools_school_id->ViewValue = $scholarship_payment->schools_school_id->CurrentValue;
			if (strval($scholarship_payment->schools_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($scholarship_payment->schools_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->schools_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$scholarship_payment->schools_school_id->ViewValue = $scholarship_payment->schools_school_id->CurrentValue;
				}
			} else {
				$scholarship_payment->schools_school_id->ViewValue = NULL;
			}
			$scholarship_payment->schools_school_id->CssStyle = "";
			$scholarship_payment->schools_school_id->CssClass = "";
			$scholarship_payment->schools_school_id->ViewCustomAttributes = "";

			// group_id
			$scholarship_payment->group_id->ViewValue = $scholarship_payment->group_id->CurrentValue;
			$scholarship_payment->group_id->CssStyle = "";
			$scholarship_payment->group_id->CssClass = "";
			$scholarship_payment->group_id->ViewCustomAttributes = "";

			// scholarship_payment_id
			$scholarship_payment->scholarship_payment_id->HrefValue = "";
			$scholarship_payment->scholarship_payment_id->TooltipValue = "";

			// date
			$scholarship_payment->date->HrefValue = "";
			$scholarship_payment->date->TooltipValue = "";

			// status
			$scholarship_payment->status->HrefValue = "";
			$scholarship_payment->status->TooltipValue = "";

			// amount
			$scholarship_payment->amount->HrefValue = "";
			$scholarship_payment->amount->TooltipValue = "";

			// memo
			$scholarship_payment->memo->HrefValue = "";
			$scholarship_payment->memo->TooltipValue = "";

			// year
			$scholarship_payment->year->HrefValue = "";
			$scholarship_payment->year->TooltipValue = "";

			// scholarship_package_scholarship_package_id
			$scholarship_payment->scholarship_package_scholarship_package_id->HrefValue = "";
			$scholarship_payment->scholarship_package_scholarship_package_id->TooltipValue = "";

			// programarea_residentarea_id
			$scholarship_payment->programarea_residentarea_id->HrefValue = "";
			$scholarship_payment->programarea_residentarea_id->TooltipValue = "";

			// programarea_payingarea_id
			$scholarship_payment->programarea_payingarea_id->HrefValue = "";
			$scholarship_payment->programarea_payingarea_id->TooltipValue = "";

			// refund_amount
			$scholarship_payment->refund_amount->HrefValue = "";
			$scholarship_payment->refund_amount->TooltipValue = "";

			// payment_request_payment_request_id
			$scholarship_payment->payment_request_payment_request_id->HrefValue = "";
			$scholarship_payment->payment_request_payment_request_id->TooltipValue = "";

			// bankname
			$scholarship_payment->bankname->HrefValue = "";
			$scholarship_payment->bankname->TooltipValue = "";

			// account_no
			$scholarship_payment->account_no->HrefValue = "";
			$scholarship_payment->account_no->TooltipValue = "";

			// schools_school_id
			$scholarship_payment->schools_school_id->HrefValue = "";
			$scholarship_payment->schools_school_id->TooltipValue = "";

			// group_id
			$scholarship_payment->group_id->HrefValue = "";
			$scholarship_payment->group_id->TooltipValue = "";
		} elseif ($scholarship_payment->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// scholarship_payment_id
			$scholarship_payment->scholarship_payment_id->EditCustomAttributes = "";
			$scholarship_payment->scholarship_payment_id->EditValue = ew_HtmlEncode($scholarship_payment->scholarship_payment_id->AdvancedSearch->SearchValue);

			// date
			$scholarship_payment->date->EditCustomAttributes = "";
			$scholarship_payment->date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($scholarship_payment->date->AdvancedSearch->SearchValue, 7), 7));
			$scholarship_payment->date->EditCustomAttributes = "";
			$scholarship_payment->date->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($scholarship_payment->date->AdvancedSearch->SearchValue2, 7), 7));

			// status
			$scholarship_payment->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("PENDING", "PENDING");
			$arwrk[] = array("PAID", "PAID");
			$scholarship_payment->status->EditValue = $arwrk;

			// amount
			$scholarship_payment->amount->EditCustomAttributes = "";
			$scholarship_payment->amount->EditValue = ew_HtmlEncode($scholarship_payment->amount->AdvancedSearch->SearchValue);

			// memo
			$scholarship_payment->memo->EditCustomAttributes = "";
			$scholarship_payment->memo->EditValue = ew_HtmlEncode($scholarship_payment->memo->AdvancedSearch->SearchValue);

			// year
			$scholarship_payment->year->EditCustomAttributes = "";
			$scholarship_payment->year->EditValue = ew_HtmlEncode($scholarship_payment->year->AdvancedSearch->SearchValue);

			// scholarship_package_scholarship_package_id
			$scholarship_payment->scholarship_package_scholarship_package_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `scholarship_package_id`, `annual_amount`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `scholarship_package`";
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
			$scholarship_payment->scholarship_package_scholarship_package_id->EditValue = $arwrk;

			// programarea_residentarea_id
			$scholarship_payment->programarea_residentarea_id->EditCustomAttributes = "";
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
			$scholarship_payment->programarea_residentarea_id->EditValue = $arwrk;

			// programarea_payingarea_id
			$scholarship_payment->programarea_payingarea_id->EditCustomAttributes = "";
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
			$scholarship_payment->programarea_payingarea_id->EditValue = $arwrk;

			// refund_amount
			$scholarship_payment->refund_amount->EditCustomAttributes = "";
			$scholarship_payment->refund_amount->EditValue = ew_HtmlEncode($scholarship_payment->refund_amount->AdvancedSearch->SearchValue);

			// payment_request_payment_request_id
			$scholarship_payment->payment_request_payment_request_id->EditCustomAttributes = "";
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
			$scholarship_payment->payment_request_payment_request_id->EditValue = $arwrk;

			// bankname
			$scholarship_payment->bankname->EditCustomAttributes = "";
			$scholarship_payment->bankname->EditValue = ew_HtmlEncode($scholarship_payment->bankname->AdvancedSearch->SearchValue);

			// account_no
			$scholarship_payment->account_no->EditCustomAttributes = "";
			$scholarship_payment->account_no->EditValue = ew_HtmlEncode($scholarship_payment->account_no->AdvancedSearch->SearchValue);

			// schools_school_id
			$scholarship_payment->schools_school_id->EditCustomAttributes = "";
			$scholarship_payment->schools_school_id->EditValue = ew_HtmlEncode($scholarship_payment->schools_school_id->AdvancedSearch->SearchValue);
			if (strval($scholarship_payment->schools_school_id->AdvancedSearch->SearchValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($scholarship_payment->schools_school_id->AdvancedSearch->SearchValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->schools_school_id->EditValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$scholarship_payment->schools_school_id->EditValue = $scholarship_payment->schools_school_id->AdvancedSearch->SearchValue;
				}
			} else {
				$scholarship_payment->schools_school_id->EditValue = NULL;
			}

			// group_id
			$scholarship_payment->group_id->EditCustomAttributes = "";
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
			$scholarship_payment->group_id->EditValue = $arwrk;
			} else {
			$scholarship_payment->group_id->EditValue = ew_HtmlEncode($scholarship_payment->group_id->AdvancedSearch->SearchValue);
			}
		}

		// Call Row Rendered event
		if ($scholarship_payment->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$scholarship_payment->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $scholarship_payment;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($scholarship_payment->scholarship_payment_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_payment->scholarship_payment_id->FldErrMsg();
		}
		if (!ew_CheckEuroDate($scholarship_payment->date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_payment->date->FldErrMsg();
		}
		if (!ew_CheckEuroDate($scholarship_payment->date->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_payment->date->FldErrMsg();
		}
		if (!ew_CheckNumber($scholarship_payment->amount->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_payment->amount->FldErrMsg();
		}
		if (!ew_CheckInteger($scholarship_payment->year->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_payment->year->FldErrMsg();
		}
		if (!ew_CheckNumber($scholarship_payment->refund_amount->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_payment->refund_amount->FldErrMsg();
		}
		if (!ew_CheckInteger($scholarship_payment->schools_school_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_payment->schools_school_id->FldErrMsg();
		}
		if (!ew_CheckInteger($scholarship_payment->group_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_payment->group_id->FldErrMsg();
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
		global $scholarship_payment;
		$scholarship_payment->scholarship_payment_id->AdvancedSearch->SearchValue = $scholarship_payment->getAdvancedSearch("x_scholarship_payment_id");
		$scholarship_payment->date->AdvancedSearch->SearchValue = $scholarship_payment->getAdvancedSearch("x_date");
		$scholarship_payment->date->AdvancedSearch->SearchOperator = $scholarship_payment->getAdvancedSearch("z_date");
		$scholarship_payment->date->AdvancedSearch->SearchCondition = $scholarship_payment->getAdvancedSearch("v_date");
		$scholarship_payment->date->AdvancedSearch->SearchValue2 = $scholarship_payment->getAdvancedSearch("y_date");
		$scholarship_payment->date->AdvancedSearch->SearchOperator2 = $scholarship_payment->getAdvancedSearch("w_date");
		$scholarship_payment->status->AdvancedSearch->SearchValue = $scholarship_payment->getAdvancedSearch("x_status");
		$scholarship_payment->amount->AdvancedSearch->SearchValue = $scholarship_payment->getAdvancedSearch("x_amount");
		$scholarship_payment->memo->AdvancedSearch->SearchValue = $scholarship_payment->getAdvancedSearch("x_memo");
		$scholarship_payment->year->AdvancedSearch->SearchValue = $scholarship_payment->getAdvancedSearch("x_year");
		$scholarship_payment->scholarship_package_scholarship_package_id->AdvancedSearch->SearchValue = $scholarship_payment->getAdvancedSearch("x_scholarship_package_scholarship_package_id");
		$scholarship_payment->programarea_residentarea_id->AdvancedSearch->SearchValue = $scholarship_payment->getAdvancedSearch("x_programarea_residentarea_id");
		$scholarship_payment->programarea_payingarea_id->AdvancedSearch->SearchValue = $scholarship_payment->getAdvancedSearch("x_programarea_payingarea_id");
		$scholarship_payment->refund_amount->AdvancedSearch->SearchValue = $scholarship_payment->getAdvancedSearch("x_refund_amount");
		$scholarship_payment->payment_request_payment_request_id->AdvancedSearch->SearchValue = $scholarship_payment->getAdvancedSearch("x_payment_request_payment_request_id");
		$scholarship_payment->bankname->AdvancedSearch->SearchValue = $scholarship_payment->getAdvancedSearch("x_bankname");
		$scholarship_payment->account_no->AdvancedSearch->SearchValue = $scholarship_payment->getAdvancedSearch("x_account_no");
		$scholarship_payment->schools_school_id->AdvancedSearch->SearchValue = $scholarship_payment->getAdvancedSearch("x_schools_school_id");
		$scholarship_payment->group_id->AdvancedSearch->SearchValue = $scholarship_payment->getAdvancedSearch("x_group_id");
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
