<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "sponsored_student_detailinfo.php" ?>
<?php include "programareainfo.php" ?>
<?php include "communityinfo.php" ?>
<?php include "usersinfo.php" ?>
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
$sponsored_student_detail_search = new csponsored_student_detail_search();
$Page =& $sponsored_student_detail_search;

// Page init
$sponsored_student_detail_search->Page_Init();

// Page main
$sponsored_student_detail_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var sponsored_student_detail_search = new ew_Page("sponsored_student_detail_search");

// page properties
sponsored_student_detail_search.PageID = "search"; // page ID
sponsored_student_detail_search.FormID = "fsponsored_student_detailsearch"; // form ID
var EW_PAGE_ID = sponsored_student_detail_search.PageID; // for backward compatibility

// extend page with validate function for search
sponsored_student_detail_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_sponsored_student_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sponsored_student_detail->sponsored_student_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_student_dob"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sponsored_student_detail->student_dob->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_age"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sponsored_student_detail->age->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_community_districts_DistrictID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sponsored_student_detail->community_districts_DistrictID->FldErrMsg()) ?>");

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
sponsored_student_detail_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
sponsored_student_detail_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
sponsored_student_detail_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $sponsored_student_detail->TableCaption() ?><br><br>
<a href="<?php echo $sponsored_student_detail->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$sponsored_student_detail_search->ShowMessage();
?>
<form name="fsponsored_student_detailsearch" id="fsponsored_student_detailsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return sponsored_student_detail_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="sponsored_student_detail">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->sponsored_student_id->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->sponsored_student_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_sponsored_student_id" id="z_sponsored_student_id" value="="></span></td>
		<td<?php echo $sponsored_student_detail->sponsored_student_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_sponsored_student_id" id="x_sponsored_student_id" title="<?php echo $sponsored_student_detail->sponsored_student_id->FldTitle() ?>" value="<?php echo $sponsored_student_detail->sponsored_student_id->EditValue ?>"<?php echo $sponsored_student_detail->sponsored_student_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_firstname->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->student_firstname->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_student_firstname" id="z_student_firstname" onchange="ew_SrchOprChanged('z_student_firstname')"><option value="="<?php echo ($sponsored_student_detail->student_firstname->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($sponsored_student_detail->student_firstname->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($sponsored_student_detail->student_firstname->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($sponsored_student_detail->student_firstname->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($sponsored_student_detail->student_firstname->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($sponsored_student_detail->student_firstname->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($sponsored_student_detail->student_firstname->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($sponsored_student_detail->student_firstname->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($sponsored_student_detail->student_firstname->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($sponsored_student_detail->student_firstname->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $sponsored_student_detail->student_firstname->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_student_firstname" id="x_student_firstname" title="<?php echo $sponsored_student_detail->student_firstname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student_detail->student_firstname->EditValue ?>"<?php echo $sponsored_student_detail->student_firstname->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_student_firstname" name="btw1_student_firstname">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_student_firstname" name="btw1_student_firstname">
<input type="text" name="y_student_firstname" id="y_student_firstname" title="<?php echo $sponsored_student_detail->student_firstname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student_detail->student_firstname->EditValue2 ?>"<?php echo $sponsored_student_detail->student_firstname->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_middlename->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->student_middlename->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_student_middlename" id="z_student_middlename" onchange="ew_SrchOprChanged('z_student_middlename')"><option value="="<?php echo ($sponsored_student_detail->student_middlename->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($sponsored_student_detail->student_middlename->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($sponsored_student_detail->student_middlename->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($sponsored_student_detail->student_middlename->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($sponsored_student_detail->student_middlename->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($sponsored_student_detail->student_middlename->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($sponsored_student_detail->student_middlename->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($sponsored_student_detail->student_middlename->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($sponsored_student_detail->student_middlename->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($sponsored_student_detail->student_middlename->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $sponsored_student_detail->student_middlename->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_student_middlename" id="x_student_middlename" title="<?php echo $sponsored_student_detail->student_middlename->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student_detail->student_middlename->EditValue ?>"<?php echo $sponsored_student_detail->student_middlename->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_student_middlename" name="btw1_student_middlename">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_student_middlename" name="btw1_student_middlename">
<input type="text" name="y_student_middlename" id="y_student_middlename" title="<?php echo $sponsored_student_detail->student_middlename->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student_detail->student_middlename->EditValue2 ?>"<?php echo $sponsored_student_detail->student_middlename->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_lastname->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->student_lastname->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_student_lastname" id="z_student_lastname" onchange="ew_SrchOprChanged('z_student_lastname')"><option value="="<?php echo ($sponsored_student_detail->student_lastname->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($sponsored_student_detail->student_lastname->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($sponsored_student_detail->student_lastname->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($sponsored_student_detail->student_lastname->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($sponsored_student_detail->student_lastname->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($sponsored_student_detail->student_lastname->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($sponsored_student_detail->student_lastname->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($sponsored_student_detail->student_lastname->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($sponsored_student_detail->student_lastname->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($sponsored_student_detail->student_lastname->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $sponsored_student_detail->student_lastname->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_student_lastname" id="x_student_lastname" title="<?php echo $sponsored_student_detail->student_lastname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student_detail->student_lastname->EditValue ?>"<?php echo $sponsored_student_detail->student_lastname->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_student_lastname" name="btw1_student_lastname">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_student_lastname" name="btw1_student_lastname">
<input type="text" name="y_student_lastname" id="y_student_lastname" title="<?php echo $sponsored_student_detail->student_lastname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student_detail->student_lastname->EditValue2 ?>"<?php echo $sponsored_student_detail->student_lastname->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_dob->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->student_dob->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_student_dob" id="z_student_dob" value="BETWEEN"></span></td>
		<td<?php echo $sponsored_student_detail->student_dob->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_student_dob" id="x_student_dob" title="<?php echo $sponsored_student_detail->student_dob->FldTitle() ?>" value="<?php echo $sponsored_student_detail->student_dob->EditValue ?>"<?php echo $sponsored_student_detail->student_dob->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_student_dob" name="cal_x_student_dob" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_student_dob", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_student_dob" // button id
});
</script>
</span>
				<span class="ewSearchOpr" id="btw1_student_dob" name="btw1_student_dob">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" id="btw1_student_dob" name="btw1_student_dob">
<input type="text" name="y_student_dob" id="y_student_dob" title="<?php echo $sponsored_student_detail->student_dob->FldTitle() ?>" value="<?php echo $sponsored_student_detail->student_dob->EditValue2 ?>"<?php echo $sponsored_student_detail->student_dob->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_y_student_dob" name="cal_y_student_dob" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_student_dob", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_y_student_dob" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->age->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->age->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_age" id="z_age" value="="></span></td>
		<td<?php echo $sponsored_student_detail->age->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_age" id="x_age" title="<?php echo $sponsored_student_detail->age->FldTitle() ?>" size="30" value="<?php echo $sponsored_student_detail->age->EditValue ?>"<?php echo $sponsored_student_detail->age->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_gender->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->student_gender->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_student_gender" id="z_student_gender" value="LIKE"></span></td>
		<td<?php echo $sponsored_student_detail->student_gender->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_student_gender" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_student_gender" id="x_student_gender" title="<?php echo $sponsored_student_detail->student_gender->FldTitle() ?>" value="{value}"<?php echo $sponsored_student_detail->student_gender->EditAttributes() ?>></label></div>
<div id="dsl_x_student_gender" repeatcolumn="5">
<?php
$arwrk = $sponsored_student_detail->student_gender->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($sponsored_student_detail->student_gender->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_student_gender" id="x_student_gender" title="<?php echo $sponsored_student_detail->student_gender->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $sponsored_student_detail->student_gender->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_address->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->student_address->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_student_address" id="z_student_address" value="LIKE"></span></td>
		<td<?php echo $sponsored_student_detail->student_address->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_student_address" id="x_student_address" title="<?php echo $sponsored_student_detail->student_address->FldTitle() ?>" cols="30" rows="4"<?php echo $sponsored_student_detail->student_address->EditAttributes() ?>><?php echo $sponsored_student_detail->student_address->EditValue ?></textarea>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->app_submission_year->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->app_submission_year->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_app_submission_year" id="z_app_submission_year" value="="></span></td>
		<td<?php echo $sponsored_student_detail->app_submission_year->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_app_submission_year" name="x_app_submission_year" title="<?php echo $sponsored_student_detail->app_submission_year->FldTitle() ?>"<?php echo $sponsored_student_detail->app_submission_year->EditAttributes() ?>>
<?php
if (is_array($sponsored_student_detail->app_submission_year->EditValue)) {
	$arwrk = $sponsored_student_detail->app_submission_year->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($sponsored_student_detail->app_submission_year->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->community->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->community->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_community" id="z_community" value="LIKE"></span></td>
		<td<?php echo $sponsored_student_detail->community->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_community" id="x_community" title="<?php echo $sponsored_student_detail->community->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student_detail->community->EditValue ?>"<?php echo $sponsored_student_detail->community->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->programarea_name->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->programarea_name->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_programarea_name" id="z_programarea_name" value="LIKE"></span></td>
		<td<?php echo $sponsored_student_detail->programarea_name->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_programarea_name" id="x_programarea_name" title="<?php echo $sponsored_student_detail->programarea_name->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $sponsored_student_detail->programarea_name->EditValue ?>"<?php echo $sponsored_student_detail->programarea_name->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_resident_programarea_id->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->student_resident_programarea_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_student_resident_programarea_id" id="z_student_resident_programarea_id" value="="></span></td>
		<td<?php echo $sponsored_student_detail->student_resident_programarea_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_student_resident_programarea_id" name="x_student_resident_programarea_id" title="<?php echo $sponsored_student_detail->student_resident_programarea_id->FldTitle() ?>"<?php echo $sponsored_student_detail->student_resident_programarea_id->EditAttributes() ?>>
<?php
if (is_array($sponsored_student_detail->student_resident_programarea_id->EditValue)) {
	$arwrk = $sponsored_student_detail->student_resident_programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($sponsored_student_detail->student_resident_programarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->District->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->District->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_District" id="z_District" value="LIKE"></span></td>
		<td<?php echo $sponsored_student_detail->District->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_District" id="x_District" title="<?php echo $sponsored_student_detail->District->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $sponsored_student_detail->District->EditValue ?>"<?php echo $sponsored_student_detail->District->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->community_districts_DistrictID->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->community_districts_DistrictID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_community_districts_DistrictID" id="z_community_districts_DistrictID" value="="></span></td>
		<td<?php echo $sponsored_student_detail->community_districts_DistrictID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_community_districts_DistrictID" id="x_community_districts_DistrictID" title="<?php echo $sponsored_student_detail->community_districts_DistrictID->FldTitle() ?>" size="30" value="<?php echo $sponsored_student_detail->community_districts_DistrictID->EditValue ?>"<?php echo $sponsored_student_detail->community_districts_DistrictID->EditAttributes() ?>>
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
ew_SrchOprChanged('z_student_firstname');
ew_SrchOprChanged('z_student_middlename');
ew_SrchOprChanged('z_student_lastname');

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
$sponsored_student_detail_search->Page_Terminate();
?>
<?php

//
// Page class
//
class csponsored_student_detail_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'sponsored_student_detail';

	// Page object name
	var $PageObjName = 'sponsored_student_detail_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $sponsored_student_detail;
		if ($sponsored_student_detail->UseTokenInUrl) $PageUrl .= "t=" . $sponsored_student_detail->TableVar . "&"; // Add page token
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
		global $objForm, $sponsored_student_detail;
		if ($sponsored_student_detail->UseTokenInUrl) {
			if ($objForm)
				return ($sponsored_student_detail->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($sponsored_student_detail->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csponsored_student_detail_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (sponsored_student_detail)
		$GLOBALS["sponsored_student_detail"] = new csponsored_student_detail();

		// Table object (programarea)
		$GLOBALS['programarea'] = new cprogramarea();

		// Table object (community)
		$GLOBALS['community'] = new ccommunity();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'sponsored_student_detail', TRUE);

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
		global $sponsored_student_detail;

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
			$this->Page_Terminate("sponsored_student_detaillist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

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
		global $objForm, $Language, $gsSearchError, $sponsored_student_detail;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$sponsored_student_detail->CurrentAction = $objForm->GetValue("a_search");
			switch ($sponsored_student_detail->CurrentAction) {
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
						$sSrchStr = $sponsored_student_detail->UrlParm($sSrchStr);
						$this->Page_Terminate("sponsored_student_detaillist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$sponsored_student_detail->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $sponsored_student_detail;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student_detail->sponsored_student_id); // sponsored_student_id
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student_detail->student_firstname); // student_firstname
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student_detail->student_middlename); // student_middlename
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student_detail->student_lastname); // student_lastname
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student_detail->student_dob); // student_dob
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student_detail->age); // age
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student_detail->student_gender); // student_gender
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student_detail->student_address); // student_address
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student_detail->app_submission_year); // app_submission_year
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student_detail->community); // community
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student_detail->programarea_name); // programarea_name
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student_detail->student_resident_programarea_id); // student_resident_programarea_id
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student_detail->District); // District
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student_detail->community_districts_DistrictID); // community_districts_DistrictID
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
		global $objForm, $sponsored_student_detail;

		// Load search values
		// sponsored_student_id

		$sponsored_student_detail->sponsored_student_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_sponsored_student_id"));
		$sponsored_student_detail->sponsored_student_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_sponsored_student_id");

		// student_firstname
		$sponsored_student_detail->student_firstname->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_firstname"));
		$sponsored_student_detail->student_firstname->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_firstname");
		$sponsored_student_detail->student_firstname->AdvancedSearch->SearchCondition = $objForm->GetValue("v_student_firstname");
		$sponsored_student_detail->student_firstname->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_student_firstname"));
		$sponsored_student_detail->student_firstname->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_student_firstname");

		// student_middlename
		$sponsored_student_detail->student_middlename->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_middlename"));
		$sponsored_student_detail->student_middlename->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_middlename");
		$sponsored_student_detail->student_middlename->AdvancedSearch->SearchCondition = $objForm->GetValue("v_student_middlename");
		$sponsored_student_detail->student_middlename->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_student_middlename"));
		$sponsored_student_detail->student_middlename->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_student_middlename");

		// student_lastname
		$sponsored_student_detail->student_lastname->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_lastname"));
		$sponsored_student_detail->student_lastname->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_lastname");
		$sponsored_student_detail->student_lastname->AdvancedSearch->SearchCondition = $objForm->GetValue("v_student_lastname");
		$sponsored_student_detail->student_lastname->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_student_lastname"));
		$sponsored_student_detail->student_lastname->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_student_lastname");

		// student_dob
		$sponsored_student_detail->student_dob->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_dob"));
		$sponsored_student_detail->student_dob->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_dob");
		$sponsored_student_detail->student_dob->AdvancedSearch->SearchCondition = $objForm->GetValue("v_student_dob");
		$sponsored_student_detail->student_dob->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_student_dob"));
		$sponsored_student_detail->student_dob->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_student_dob");

		// age
		$sponsored_student_detail->age->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_age"));
		$sponsored_student_detail->age->AdvancedSearch->SearchOperator = $objForm->GetValue("z_age");

		// student_gender
		$sponsored_student_detail->student_gender->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_gender"));
		$sponsored_student_detail->student_gender->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_gender");

		// student_address
		$sponsored_student_detail->student_address->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_address"));
		$sponsored_student_detail->student_address->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_address");

		// app_submission_year
		$sponsored_student_detail->app_submission_year->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_app_submission_year"));
		$sponsored_student_detail->app_submission_year->AdvancedSearch->SearchOperator = $objForm->GetValue("z_app_submission_year");

		// community
		$sponsored_student_detail->community->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_community"));
		$sponsored_student_detail->community->AdvancedSearch->SearchOperator = $objForm->GetValue("z_community");

		// programarea_name
		$sponsored_student_detail->programarea_name->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_programarea_name"));
		$sponsored_student_detail->programarea_name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_programarea_name");

		// student_resident_programarea_id
		$sponsored_student_detail->student_resident_programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_resident_programarea_id"));
		$sponsored_student_detail->student_resident_programarea_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_resident_programarea_id");

		// District
		$sponsored_student_detail->District->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_District"));
		$sponsored_student_detail->District->AdvancedSearch->SearchOperator = $objForm->GetValue("z_District");

		// community_districts_DistrictID
		$sponsored_student_detail->community_districts_DistrictID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_community_districts_DistrictID"));
		$sponsored_student_detail->community_districts_DistrictID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_community_districts_DistrictID");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $sponsored_student_detail;

		// Initialize URLs
		// Call Row_Rendering event

		$sponsored_student_detail->Row_Rendering();

		// Common render codes for all row types
		// sponsored_student_id

		$sponsored_student_detail->sponsored_student_id->CellCssStyle = ""; $sponsored_student_detail->sponsored_student_id->CellCssClass = "";
		$sponsored_student_detail->sponsored_student_id->CellAttrs = array(); $sponsored_student_detail->sponsored_student_id->ViewAttrs = array(); $sponsored_student_detail->sponsored_student_id->EditAttrs = array();

		// student_firstname
		$sponsored_student_detail->student_firstname->CellCssStyle = ""; $sponsored_student_detail->student_firstname->CellCssClass = "";
		$sponsored_student_detail->student_firstname->CellAttrs = array(); $sponsored_student_detail->student_firstname->ViewAttrs = array(); $sponsored_student_detail->student_firstname->EditAttrs = array();

		// student_middlename
		$sponsored_student_detail->student_middlename->CellCssStyle = ""; $sponsored_student_detail->student_middlename->CellCssClass = "";
		$sponsored_student_detail->student_middlename->CellAttrs = array(); $sponsored_student_detail->student_middlename->ViewAttrs = array(); $sponsored_student_detail->student_middlename->EditAttrs = array();

		// student_lastname
		$sponsored_student_detail->student_lastname->CellCssStyle = ""; $sponsored_student_detail->student_lastname->CellCssClass = "";
		$sponsored_student_detail->student_lastname->CellAttrs = array(); $sponsored_student_detail->student_lastname->ViewAttrs = array(); $sponsored_student_detail->student_lastname->EditAttrs = array();

		// student_dob
		$sponsored_student_detail->student_dob->CellCssStyle = ""; $sponsored_student_detail->student_dob->CellCssClass = "";
		$sponsored_student_detail->student_dob->CellAttrs = array(); $sponsored_student_detail->student_dob->ViewAttrs = array(); $sponsored_student_detail->student_dob->EditAttrs = array();

		// age
		$sponsored_student_detail->age->CellCssStyle = ""; $sponsored_student_detail->age->CellCssClass = "";
		$sponsored_student_detail->age->CellAttrs = array(); $sponsored_student_detail->age->ViewAttrs = array(); $sponsored_student_detail->age->EditAttrs = array();

		// student_gender
		$sponsored_student_detail->student_gender->CellCssStyle = ""; $sponsored_student_detail->student_gender->CellCssClass = "";
		$sponsored_student_detail->student_gender->CellAttrs = array(); $sponsored_student_detail->student_gender->ViewAttrs = array(); $sponsored_student_detail->student_gender->EditAttrs = array();

		// student_address
		$sponsored_student_detail->student_address->CellCssStyle = ""; $sponsored_student_detail->student_address->CellCssClass = "";
		$sponsored_student_detail->student_address->CellAttrs = array(); $sponsored_student_detail->student_address->ViewAttrs = array(); $sponsored_student_detail->student_address->EditAttrs = array();

		// app_submission_year
		$sponsored_student_detail->app_submission_year->CellCssStyle = ""; $sponsored_student_detail->app_submission_year->CellCssClass = "";
		$sponsored_student_detail->app_submission_year->CellAttrs = array(); $sponsored_student_detail->app_submission_year->ViewAttrs = array(); $sponsored_student_detail->app_submission_year->EditAttrs = array();

		// community
		$sponsored_student_detail->community->CellCssStyle = ""; $sponsored_student_detail->community->CellCssClass = "";
		$sponsored_student_detail->community->CellAttrs = array(); $sponsored_student_detail->community->ViewAttrs = array(); $sponsored_student_detail->community->EditAttrs = array();

		// programarea_name
		$sponsored_student_detail->programarea_name->CellCssStyle = ""; $sponsored_student_detail->programarea_name->CellCssClass = "";
		$sponsored_student_detail->programarea_name->CellAttrs = array(); $sponsored_student_detail->programarea_name->ViewAttrs = array(); $sponsored_student_detail->programarea_name->EditAttrs = array();

		// student_resident_programarea_id
		$sponsored_student_detail->student_resident_programarea_id->CellCssStyle = ""; $sponsored_student_detail->student_resident_programarea_id->CellCssClass = "";
		$sponsored_student_detail->student_resident_programarea_id->CellAttrs = array(); $sponsored_student_detail->student_resident_programarea_id->ViewAttrs = array(); $sponsored_student_detail->student_resident_programarea_id->EditAttrs = array();

		// District
		$sponsored_student_detail->District->CellCssStyle = ""; $sponsored_student_detail->District->CellCssClass = "";
		$sponsored_student_detail->District->CellAttrs = array(); $sponsored_student_detail->District->ViewAttrs = array(); $sponsored_student_detail->District->EditAttrs = array();

		// community_districts_DistrictID
		$sponsored_student_detail->community_districts_DistrictID->CellCssStyle = ""; $sponsored_student_detail->community_districts_DistrictID->CellCssClass = "";
		$sponsored_student_detail->community_districts_DistrictID->CellAttrs = array(); $sponsored_student_detail->community_districts_DistrictID->ViewAttrs = array(); $sponsored_student_detail->community_districts_DistrictID->EditAttrs = array();
		if ($sponsored_student_detail->RowType == EW_ROWTYPE_VIEW) { // View row

			// sponsored_student_id
			$sponsored_student_detail->sponsored_student_id->ViewValue = $sponsored_student_detail->sponsored_student_id->CurrentValue;
			$sponsored_student_detail->sponsored_student_id->CssStyle = "";
			$sponsored_student_detail->sponsored_student_id->CssClass = "";
			$sponsored_student_detail->sponsored_student_id->ViewCustomAttributes = "";

			// student_firstname
			$sponsored_student_detail->student_firstname->ViewValue = $sponsored_student_detail->student_firstname->CurrentValue;
			$sponsored_student_detail->student_firstname->CssStyle = "";
			$sponsored_student_detail->student_firstname->CssClass = "";
			$sponsored_student_detail->student_firstname->ViewCustomAttributes = "";

			// student_middlename
			$sponsored_student_detail->student_middlename->ViewValue = $sponsored_student_detail->student_middlename->CurrentValue;
			$sponsored_student_detail->student_middlename->CssStyle = "";
			$sponsored_student_detail->student_middlename->CssClass = "";
			$sponsored_student_detail->student_middlename->ViewCustomAttributes = "";

			// student_lastname
			$sponsored_student_detail->student_lastname->ViewValue = $sponsored_student_detail->student_lastname->CurrentValue;
			$sponsored_student_detail->student_lastname->CssStyle = "";
			$sponsored_student_detail->student_lastname->CssClass = "";
			$sponsored_student_detail->student_lastname->ViewCustomAttributes = "";

			// student_telephone_1
			$sponsored_student_detail->student_telephone_1->ViewValue = $sponsored_student_detail->student_telephone_1->CurrentValue;
			$sponsored_student_detail->student_telephone_1->CssStyle = "";
			$sponsored_student_detail->student_telephone_1->CssClass = "";
			$sponsored_student_detail->student_telephone_1->ViewCustomAttributes = "";

			// student_telephone_2
			$sponsored_student_detail->student_telephone_2->ViewValue = $sponsored_student_detail->student_telephone_2->CurrentValue;
			$sponsored_student_detail->student_telephone_2->CssStyle = "";
			$sponsored_student_detail->student_telephone_2->CssClass = "";
			$sponsored_student_detail->student_telephone_2->ViewCustomAttributes = "";

			// student_dob
			$sponsored_student_detail->student_dob->ViewValue = $sponsored_student_detail->student_dob->CurrentValue;
			$sponsored_student_detail->student_dob->ViewValue = ew_FormatDateTime($sponsored_student_detail->student_dob->ViewValue, 7);
			$sponsored_student_detail->student_dob->CssStyle = "";
			$sponsored_student_detail->student_dob->CssClass = "";
			$sponsored_student_detail->student_dob->ViewCustomAttributes = "";

			// age
			$sponsored_student_detail->age->ViewValue = $sponsored_student_detail->age->CurrentValue;
			$sponsored_student_detail->age->CssStyle = "";
			$sponsored_student_detail->age->CssClass = "";
			$sponsored_student_detail->age->ViewCustomAttributes = "";

			// student_gender
			if (strval($sponsored_student_detail->student_gender->CurrentValue) <> "") {
				switch ($sponsored_student_detail->student_gender->CurrentValue) {
					case "M":
						$sponsored_student_detail->student_gender->ViewValue = "Male";
						break;
					case "F":
						$sponsored_student_detail->student_gender->ViewValue = "Female";
						break;
					default:
						$sponsored_student_detail->student_gender->ViewValue = $sponsored_student_detail->student_gender->CurrentValue;
				}
			} else {
				$sponsored_student_detail->student_gender->ViewValue = NULL;
			}
			$sponsored_student_detail->student_gender->CssStyle = "";
			$sponsored_student_detail->student_gender->CssClass = "";
			$sponsored_student_detail->student_gender->ViewCustomAttributes = "";

			// student_address
			$sponsored_student_detail->student_address->ViewValue = $sponsored_student_detail->student_address->CurrentValue;
			$sponsored_student_detail->student_address->CssStyle = "";
			$sponsored_student_detail->student_address->CssClass = "";
			$sponsored_student_detail->student_address->ViewCustomAttributes = "";

			// app_submission_year
			if (strval($sponsored_student_detail->app_submission_year->CurrentValue) <> "") {
				$sFilterWrk = "`app_year` = " . ew_AdjustSql($sponsored_student_detail->app_submission_year->CurrentValue) . "";
			$sSqlWrk = "SELECT `app_year` FROM `academic_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sponsored_student_detail->app_submission_year->ViewValue = $rswrk->fields('app_year');
					$rswrk->Close();
				} else {
					$sponsored_student_detail->app_submission_year->ViewValue = $sponsored_student_detail->app_submission_year->CurrentValue;
				}
			} else {
				$sponsored_student_detail->app_submission_year->ViewValue = NULL;
			}
			$sponsored_student_detail->app_submission_year->CssStyle = "";
			$sponsored_student_detail->app_submission_year->CssClass = "";
			$sponsored_student_detail->app_submission_year->ViewCustomAttributes = "";

			// community
			$sponsored_student_detail->community->ViewValue = $sponsored_student_detail->community->CurrentValue;
			$sponsored_student_detail->community->CssStyle = "";
			$sponsored_student_detail->community->CssClass = "";
			$sponsored_student_detail->community->ViewCustomAttributes = "";

			// community_community_id
			$sponsored_student_detail->community_community_id->ViewValue = $sponsored_student_detail->community_community_id->CurrentValue;
			$sponsored_student_detail->community_community_id->CssStyle = "";
			$sponsored_student_detail->community_community_id->CssClass = "";
			$sponsored_student_detail->community_community_id->ViewCustomAttributes = "";

			// programarea_name
			$sponsored_student_detail->programarea_name->ViewValue = $sponsored_student_detail->programarea_name->CurrentValue;
			$sponsored_student_detail->programarea_name->CssStyle = "";
			$sponsored_student_detail->programarea_name->CssClass = "";
			$sponsored_student_detail->programarea_name->ViewCustomAttributes = "";

			// student_resident_programarea_id
			if (strval($sponsored_student_detail->student_resident_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($sponsored_student_detail->student_resident_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sponsored_student_detail->student_resident_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$sponsored_student_detail->student_resident_programarea_id->ViewValue = $sponsored_student_detail->student_resident_programarea_id->CurrentValue;
				}
			} else {
				$sponsored_student_detail->student_resident_programarea_id->ViewValue = NULL;
			}
			$sponsored_student_detail->student_resident_programarea_id->CssStyle = "";
			$sponsored_student_detail->student_resident_programarea_id->CssClass = "";
			$sponsored_student_detail->student_resident_programarea_id->ViewCustomAttributes = "";

			// District
			$sponsored_student_detail->District->ViewValue = $sponsored_student_detail->District->CurrentValue;
			$sponsored_student_detail->District->CssStyle = "";
			$sponsored_student_detail->District->CssClass = "";
			$sponsored_student_detail->District->ViewCustomAttributes = "";

			// community_districts_DistrictID
			$sponsored_student_detail->community_districts_DistrictID->ViewValue = $sponsored_student_detail->community_districts_DistrictID->CurrentValue;
			$sponsored_student_detail->community_districts_DistrictID->CssStyle = "";
			$sponsored_student_detail->community_districts_DistrictID->CssClass = "";
			$sponsored_student_detail->community_districts_DistrictID->ViewCustomAttributes = "";

			// sponsored_student_id
			$sponsored_student_detail->sponsored_student_id->HrefValue = "";
			$sponsored_student_detail->sponsored_student_id->TooltipValue = "";

			// student_firstname
			$sponsored_student_detail->student_firstname->HrefValue = "";
			$sponsored_student_detail->student_firstname->TooltipValue = "";

			// student_middlename
			$sponsored_student_detail->student_middlename->HrefValue = "";
			$sponsored_student_detail->student_middlename->TooltipValue = "";

			// student_lastname
			$sponsored_student_detail->student_lastname->HrefValue = "";
			$sponsored_student_detail->student_lastname->TooltipValue = "";

			// student_dob
			$sponsored_student_detail->student_dob->HrefValue = "";
			$sponsored_student_detail->student_dob->TooltipValue = "";

			// age
			$sponsored_student_detail->age->HrefValue = "";
			$sponsored_student_detail->age->TooltipValue = "";

			// student_gender
			$sponsored_student_detail->student_gender->HrefValue = "";
			$sponsored_student_detail->student_gender->TooltipValue = "";

			// student_address
			$sponsored_student_detail->student_address->HrefValue = "";
			$sponsored_student_detail->student_address->TooltipValue = "";

			// app_submission_year
			$sponsored_student_detail->app_submission_year->HrefValue = "";
			$sponsored_student_detail->app_submission_year->TooltipValue = "";

			// community
			$sponsored_student_detail->community->HrefValue = "";
			$sponsored_student_detail->community->TooltipValue = "";

			// programarea_name
			$sponsored_student_detail->programarea_name->HrefValue = "";
			$sponsored_student_detail->programarea_name->TooltipValue = "";

			// student_resident_programarea_id
			$sponsored_student_detail->student_resident_programarea_id->HrefValue = "";
			$sponsored_student_detail->student_resident_programarea_id->TooltipValue = "";

			// District
			$sponsored_student_detail->District->HrefValue = "";
			$sponsored_student_detail->District->TooltipValue = "";

			// community_districts_DistrictID
			$sponsored_student_detail->community_districts_DistrictID->HrefValue = "";
			$sponsored_student_detail->community_districts_DistrictID->TooltipValue = "";
		} elseif ($sponsored_student_detail->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// sponsored_student_id
			$sponsored_student_detail->sponsored_student_id->EditCustomAttributes = "";
			$sponsored_student_detail->sponsored_student_id->EditValue = ew_HtmlEncode($sponsored_student_detail->sponsored_student_id->AdvancedSearch->SearchValue);

			// student_firstname
			$sponsored_student_detail->student_firstname->EditCustomAttributes = "";
			$sponsored_student_detail->student_firstname->EditValue = ew_HtmlEncode($sponsored_student_detail->student_firstname->AdvancedSearch->SearchValue);
			$sponsored_student_detail->student_firstname->EditCustomAttributes = "";
			$sponsored_student_detail->student_firstname->EditValue2 = ew_HtmlEncode($sponsored_student_detail->student_firstname->AdvancedSearch->SearchValue2);

			// student_middlename
			$sponsored_student_detail->student_middlename->EditCustomAttributes = "";
			$sponsored_student_detail->student_middlename->EditValue = ew_HtmlEncode($sponsored_student_detail->student_middlename->AdvancedSearch->SearchValue);
			$sponsored_student_detail->student_middlename->EditCustomAttributes = "";
			$sponsored_student_detail->student_middlename->EditValue2 = ew_HtmlEncode($sponsored_student_detail->student_middlename->AdvancedSearch->SearchValue2);

			// student_lastname
			$sponsored_student_detail->student_lastname->EditCustomAttributes = "";
			$sponsored_student_detail->student_lastname->EditValue = ew_HtmlEncode($sponsored_student_detail->student_lastname->AdvancedSearch->SearchValue);
			$sponsored_student_detail->student_lastname->EditCustomAttributes = "";
			$sponsored_student_detail->student_lastname->EditValue2 = ew_HtmlEncode($sponsored_student_detail->student_lastname->AdvancedSearch->SearchValue2);

			// student_dob
			$sponsored_student_detail->student_dob->EditCustomAttributes = "";
			$sponsored_student_detail->student_dob->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($sponsored_student_detail->student_dob->AdvancedSearch->SearchValue, 7), 7));
			$sponsored_student_detail->student_dob->EditCustomAttributes = "";
			$sponsored_student_detail->student_dob->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($sponsored_student_detail->student_dob->AdvancedSearch->SearchValue2, 7), 7));

			// age
			$sponsored_student_detail->age->EditCustomAttributes = "";
			$sponsored_student_detail->age->EditValue = ew_HtmlEncode($sponsored_student_detail->age->AdvancedSearch->SearchValue);

			// student_gender
			$sponsored_student_detail->student_gender->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("M", "Male");
			$arwrk[] = array("F", "Female");
			$sponsored_student_detail->student_gender->EditValue = $arwrk;

			// student_address
			$sponsored_student_detail->student_address->EditCustomAttributes = "";
			$sponsored_student_detail->student_address->EditValue = ew_HtmlEncode($sponsored_student_detail->student_address->AdvancedSearch->SearchValue);

			// app_submission_year
			$sponsored_student_detail->app_submission_year->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `app_year`, `app_year`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `academic_year`";
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
			$sponsored_student_detail->app_submission_year->EditValue = $arwrk;

			// community
			$sponsored_student_detail->community->EditCustomAttributes = "";
			$sponsored_student_detail->community->EditValue = ew_HtmlEncode($sponsored_student_detail->community->AdvancedSearch->SearchValue);

			// programarea_name
			$sponsored_student_detail->programarea_name->EditCustomAttributes = "";
			$sponsored_student_detail->programarea_name->EditValue = ew_HtmlEncode($sponsored_student_detail->programarea_name->AdvancedSearch->SearchValue);

			// student_resident_programarea_id
			$sponsored_student_detail->student_resident_programarea_id->EditCustomAttributes = "";
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
			$sponsored_student_detail->student_resident_programarea_id->EditValue = $arwrk;

			// District
			$sponsored_student_detail->District->EditCustomAttributes = "";
			$sponsored_student_detail->District->EditValue = ew_HtmlEncode($sponsored_student_detail->District->AdvancedSearch->SearchValue);

			// community_districts_DistrictID
			$sponsored_student_detail->community_districts_DistrictID->EditCustomAttributes = "";
			$sponsored_student_detail->community_districts_DistrictID->EditValue = ew_HtmlEncode($sponsored_student_detail->community_districts_DistrictID->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($sponsored_student_detail->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$sponsored_student_detail->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $sponsored_student_detail;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($sponsored_student_detail->sponsored_student_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sponsored_student_detail->sponsored_student_id->FldErrMsg();
		}
		if (!ew_CheckEuroDate($sponsored_student_detail->student_dob->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sponsored_student_detail->student_dob->FldErrMsg();
		}
		if (!ew_CheckEuroDate($sponsored_student_detail->student_dob->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sponsored_student_detail->student_dob->FldErrMsg();
		}
		if (!ew_CheckInteger($sponsored_student_detail->age->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sponsored_student_detail->age->FldErrMsg();
		}
		if (!ew_CheckInteger($sponsored_student_detail->community_districts_DistrictID->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sponsored_student_detail->community_districts_DistrictID->FldErrMsg();
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
		global $sponsored_student_detail;
		$sponsored_student_detail->sponsored_student_id->AdvancedSearch->SearchValue = $sponsored_student_detail->getAdvancedSearch("x_sponsored_student_id");
		$sponsored_student_detail->student_firstname->AdvancedSearch->SearchValue = $sponsored_student_detail->getAdvancedSearch("x_student_firstname");
		$sponsored_student_detail->student_firstname->AdvancedSearch->SearchOperator = $sponsored_student_detail->getAdvancedSearch("z_student_firstname");
		$sponsored_student_detail->student_firstname->AdvancedSearch->SearchValue2 = $sponsored_student_detail->getAdvancedSearch("y_student_firstname");
		$sponsored_student_detail->student_middlename->AdvancedSearch->SearchValue = $sponsored_student_detail->getAdvancedSearch("x_student_middlename");
		$sponsored_student_detail->student_middlename->AdvancedSearch->SearchOperator = $sponsored_student_detail->getAdvancedSearch("z_student_middlename");
		$sponsored_student_detail->student_middlename->AdvancedSearch->SearchValue2 = $sponsored_student_detail->getAdvancedSearch("y_student_middlename");
		$sponsored_student_detail->student_lastname->AdvancedSearch->SearchValue = $sponsored_student_detail->getAdvancedSearch("x_student_lastname");
		$sponsored_student_detail->student_lastname->AdvancedSearch->SearchOperator = $sponsored_student_detail->getAdvancedSearch("z_student_lastname");
		$sponsored_student_detail->student_lastname->AdvancedSearch->SearchValue2 = $sponsored_student_detail->getAdvancedSearch("y_student_lastname");
		$sponsored_student_detail->student_dob->AdvancedSearch->SearchValue = $sponsored_student_detail->getAdvancedSearch("x_student_dob");
		$sponsored_student_detail->student_dob->AdvancedSearch->SearchValue2 = $sponsored_student_detail->getAdvancedSearch("y_student_dob");
		$sponsored_student_detail->age->AdvancedSearch->SearchValue = $sponsored_student_detail->getAdvancedSearch("x_age");
		$sponsored_student_detail->student_gender->AdvancedSearch->SearchValue = $sponsored_student_detail->getAdvancedSearch("x_student_gender");
		$sponsored_student_detail->student_address->AdvancedSearch->SearchValue = $sponsored_student_detail->getAdvancedSearch("x_student_address");
		$sponsored_student_detail->app_submission_year->AdvancedSearch->SearchValue = $sponsored_student_detail->getAdvancedSearch("x_app_submission_year");
		$sponsored_student_detail->community->AdvancedSearch->SearchValue = $sponsored_student_detail->getAdvancedSearch("x_community");
		$sponsored_student_detail->programarea_name->AdvancedSearch->SearchValue = $sponsored_student_detail->getAdvancedSearch("x_programarea_name");
		$sponsored_student_detail->student_resident_programarea_id->AdvancedSearch->SearchValue = $sponsored_student_detail->getAdvancedSearch("x_student_resident_programarea_id");
		$sponsored_student_detail->District->AdvancedSearch->SearchValue = $sponsored_student_detail->getAdvancedSearch("x_District");
		$sponsored_student_detail->community_districts_DistrictID->AdvancedSearch->SearchValue = $sponsored_student_detail->getAdvancedSearch("x_community_districts_DistrictID");
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
