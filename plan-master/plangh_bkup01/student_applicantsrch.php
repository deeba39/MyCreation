<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "student_applicantinfo.php" ?>
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
$student_applicant_search = new cstudent_applicant_search();
$Page =& $student_applicant_search;

// Page init
$student_applicant_search->Page_Init();

// Page main
$student_applicant_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var student_applicant_search = new ew_Page("student_applicant_search");

// page properties
student_applicant_search.PageID = "search"; // page ID
student_applicant_search.FormID = "fstudent_applicantsearch"; // form ID
var EW_PAGE_ID = student_applicant_search.PageID; // for backward compatibility

// extend page with validate function for search
student_applicant_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_student_applicant_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($student_applicant->student_applicant_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_app_submission_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($student_applicant->app_submission_year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_app_status"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($student_applicant->app_status->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_app_points"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($student_applicant->app_points->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_app_grant_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($student_applicant->app_grant_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_student_dob"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($student_applicant->student_dob->FldErrMsg()) ?>");

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
student_applicant_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
student_applicant_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
student_applicant_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $student_applicant->TableCaption() ?><br><br>
<a href="<?php echo $student_applicant->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$student_applicant_search->ShowMessage();
?>
<form name="fstudent_applicantsearch" id="fstudent_applicantsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return student_applicant_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="student_applicant">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_applicant_id->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_applicant_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_student_applicant_id" id="z_student_applicant_id" value="="></span></td>
		<td<?php echo $student_applicant->student_applicant_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_student_applicant_id" id="x_student_applicant_id" title="<?php echo $student_applicant->student_applicant_id->FldTitle() ?>" value="<?php echo $student_applicant->student_applicant_id->EditValue ?>"<?php echo $student_applicant->student_applicant_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_submission_year->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_submission_year->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_app_submission_year" id="z_app_submission_year" value="="></span></td>
		<td<?php echo $student_applicant->app_submission_year->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="as_x_app_submission_year" style="z-index: 8980">
	<input type="text" name="sv_x_app_submission_year" id="sv_x_app_submission_year" value="<?php echo $student_applicant->app_submission_year->EditValue ?>" title="<?php echo $student_applicant->app_submission_year->FldTitle() ?>" size="30"<?php echo $student_applicant->app_submission_year->EditAttributes() ?>>&nbsp;<span id="em_x_app_submission_year" class="ewMessage" style="display: none"><?php echo $Language->Phrase("UnmatchedValue") ?></span>
	<div id="sc_x_app_submission_year"></div>
</div>
<input type="hidden" name="x_app_submission_year" id="x_app_submission_year" value="<?php echo $student_applicant->app_submission_year->AdvancedSearch->SearchValue ?>">
<?php
$sSqlWrk = "SELECT `app_year` FROM `academic_year`";
$sWhereWrk = "`app_year` = {query_value}";
if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
$sWhereWrk .= "(" . "active='ACTIVE'" . ")";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " ORDER BY `app_year` Desc";
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_app_submission_year" id="s_x_app_submission_year" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x_app_submission_year = new ew_AutoSuggest("sv_x_app_submission_year", "sc_x_app_submission_year", "s_x_app_submission_year", "em_x_app_submission_year", "x_app_submission_year", "", false);

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_resident_programarea_id->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_resident_programarea_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_student_resident_programarea_id" id="z_student_resident_programarea_id" value="="></span></td>
		<td<?php echo $student_applicant->student_resident_programarea_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_student_resident_programarea_id" name="x_student_resident_programarea_id" title="<?php echo $student_applicant->student_resident_programarea_id->FldTitle() ?>"<?php echo $student_applicant->student_resident_programarea_id->EditAttributes() ?>>
<?php
if (is_array($student_applicant->student_resident_programarea_id->EditValue)) {
	$arwrk = $student_applicant->student_resident_programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->student_resident_programarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->community_community_id->FldCaption() ?></td>
		<td<?php echo $student_applicant->community_community_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_community_community_id" id="z_community_community_id" value="="></span></td>
		<td<?php echo $student_applicant->community_community_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_community_community_id" name="x_community_community_id" title="<?php echo $student_applicant->community_community_id->FldTitle() ?>"<?php echo $student_applicant->community_community_id->EditAttributes() ?>>
<?php
if (is_array($student_applicant->community_community_id->EditValue)) {
	$arwrk = $student_applicant->community_community_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->community_community_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php
$sSqlWrk = "SELECT `community_id`, `community`, '' AS Disp2Fld FROM `community`";
$sWhereWrk = "";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_community_community_id" id="s_x_community_community_id" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x_community_community_id" id="lft_x_community_community_id" value="">
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_status->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_status->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_app_status" id="z_app_status" value="="></span></td>
		<td<?php echo $student_applicant->app_status->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="as_x_app_status" style="z-index: 8950">
	<input type="text" name="sv_x_app_status" id="sv_x_app_status" value="<?php echo $student_applicant->app_status->EditValue ?>" title="<?php echo $student_applicant->app_status->FldTitle() ?>" size="30"<?php echo $student_applicant->app_status->EditAttributes() ?>>&nbsp;<span id="em_x_app_status" class="ewMessage" style="display: none"><?php echo $Language->Phrase("UnmatchedValue") ?></span>
	<div id="sc_x_app_status"></div>
</div>
<input type="hidden" name="x_app_status" id="x_app_status" value="<?php echo $student_applicant->app_status->AdvancedSearch->SearchValue ?>">
<?php
$sSqlWrk = "SELECT `application_status_id`, `application_status` FROM `application_status`";
$sWhereWrk = "`application_status` LIKE '{query_value}%'";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_app_status" id="s_x_app_status" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x_app_status = new ew_AutoSuggest("sv_x_app_status", "sc_x_app_status", "s_x_app_status", "em_x_app_status", "x_app_status", "", false);
oas_x_app_status.formatResult = function(ar) {	
	var df1 = ar[1];
	return df1;
};
oas_x_app_status.ac.typeAhead = false;

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_points->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_points->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_app_points" id="z_app_points" value="="></span></td>
		<td<?php echo $student_applicant->app_points->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_app_points" id="x_app_points" title="<?php echo $student_applicant->app_points->FldTitle() ?>" size="30" value="<?php echo $student_applicant->app_points->EditValue ?>"<?php echo $student_applicant->app_points->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_grant_id->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_grant_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_app_grant_id" id="z_app_grant_id" value="="></span></td>
		<td<?php echo $student_applicant->app_grant_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="as_x_app_grant_id" style="z-index: 8930">
	<input type="text" name="sv_x_app_grant_id" id="sv_x_app_grant_id" value="<?php echo $student_applicant->app_grant_id->EditValue ?>" title="<?php echo $student_applicant->app_grant_id->FldTitle() ?>" size="30"<?php echo $student_applicant->app_grant_id->EditAttributes() ?>>&nbsp;<span id="em_x_app_grant_id" class="ewMessage" style="display: none"><?php echo $Language->Phrase("UnmatchedValue") ?></span>
	<div id="sc_x_app_grant_id"></div>
</div>
<input type="hidden" name="x_app_grant_id" id="x_app_grant_id" value="<?php echo $student_applicant->app_grant_id->AdvancedSearch->SearchValue ?>">
<?php
$sSqlWrk = "SELECT `grant_package_id`, `name` FROM `grant_package`";
$sWhereWrk = "`name` LIKE '{query_value}%'";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_app_grant_id" id="s_x_app_grant_id" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x_app_grant_id = new ew_AutoSuggest("sv_x_app_grant_id", "sc_x_app_grant_id", "s_x_app_grant_id", "em_x_app_grant_id", "x_app_grant_id", "", false);
oas_x_app_grant_id.formatResult = function(ar) {	
	var df1 = ar[1];
	return df1;
};
oas_x_app_grant_id.ac.typeAhead = false;

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_firstname->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_firstname->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_student_firstname" id="z_student_firstname" value="LIKE"></span></td>
		<td<?php echo $student_applicant->student_firstname->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_student_firstname" id="x_student_firstname" title="<?php echo $student_applicant->student_firstname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->student_firstname->EditValue ?>"<?php echo $student_applicant->student_firstname->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_middlename->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_middlename->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_student_middlename" id="z_student_middlename" value="LIKE"></span></td>
		<td<?php echo $student_applicant->student_middlename->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_student_middlename" id="x_student_middlename" title="<?php echo $student_applicant->student_middlename->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->student_middlename->EditValue ?>"<?php echo $student_applicant->student_middlename->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_lastname->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_lastname->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_student_lastname" id="z_student_lastname" value="LIKE"></span></td>
		<td<?php echo $student_applicant->student_lastname->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_student_lastname" id="x_student_lastname" title="<?php echo $student_applicant->student_lastname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->student_lastname->EditValue ?>"<?php echo $student_applicant->student_lastname->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_gender->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_gender->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_student_gender" id="z_student_gender" value="LIKE"></span></td>
		<td<?php echo $student_applicant->student_gender->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_student_gender" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_student_gender" id="x_student_gender" title="<?php echo $student_applicant->student_gender->FldTitle() ?>" value="{value}"<?php echo $student_applicant->student_gender->EditAttributes() ?>></label></div>
<div id="dsl_x_student_gender" repeatcolumn="5">
<?php
$arwrk = $student_applicant->student_gender->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->student_gender->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_student_gender" id="x_student_gender" title="<?php echo $student_applicant->student_gender->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $student_applicant->student_gender->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_dob->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_dob->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_student_dob" id="z_student_dob" value="BETWEEN"></span></td>
		<td<?php echo $student_applicant->student_dob->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_student_dob" id="x_student_dob" title="<?php echo $student_applicant->student_dob->FldTitle() ?>" value="<?php echo $student_applicant->student_dob->EditValue ?>"<?php echo $student_applicant->student_dob->EditAttributes() ?>>
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
<input type="text" name="y_student_dob" id="y_student_dob" title="<?php echo $student_applicant->student_dob->FldTitle() ?>" value="<?php echo $student_applicant->student_dob->EditValue2 ?>"<?php echo $student_applicant->student_dob->EditAttributes() ?>>
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
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_mother_name->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_mother_name->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_app_mother_name" id="z_app_mother_name" value="LIKE"></span></td>
		<td<?php echo $student_applicant->app_mother_name->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_app_mother_name" id="x_app_mother_name" title="<?php echo $student_applicant->app_mother_name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->app_mother_name->EditValue ?>"<?php echo $student_applicant->app_mother_name->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_mother_isalive->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_mother_isalive->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_app_mother_isalive" id="z_app_mother_isalive" value="="></span></td>
		<td<?php echo $student_applicant->app_mother_isalive->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_app_mother_isalive" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_app_mother_isalive" id="x_app_mother_isalive" title="<?php echo $student_applicant->app_mother_isalive->FldTitle() ?>" value="{value}"<?php echo $student_applicant->app_mother_isalive->EditAttributes() ?>></label></div>
<div id="dsl_x_app_mother_isalive" repeatcolumn="5">
<?php
$arwrk = $student_applicant->app_mother_isalive->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->app_mother_isalive->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_app_mother_isalive" id="x_app_mother_isalive" title="<?php echo $student_applicant->app_mother_isalive->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $student_applicant->app_mother_isalive->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_mother_occupation->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_mother_occupation->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_app_mother_occupation" id="z_app_mother_occupation" value="="></span></td>
		<td<?php echo $student_applicant->app_mother_occupation->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_app_mother_occupation" name="x_app_mother_occupation" title="<?php echo $student_applicant->app_mother_occupation->FldTitle() ?>"<?php echo $student_applicant->app_mother_occupation->EditAttributes() ?>>
<?php
if (is_array($student_applicant->app_mother_occupation->EditValue)) {
	$arwrk = $student_applicant->app_mother_occupation->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->app_mother_occupation->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_father_name->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_father_name->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_app_father_name" id="z_app_father_name" value="LIKE"></span></td>
		<td<?php echo $student_applicant->app_father_name->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_app_father_name" id="x_app_father_name" title="<?php echo $student_applicant->app_father_name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->app_father_name->EditValue ?>"<?php echo $student_applicant->app_father_name->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_father_occupation->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_father_occupation->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_app_father_occupation" id="z_app_father_occupation" value="="></span></td>
		<td<?php echo $student_applicant->app_father_occupation->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_app_father_occupation" name="x_app_father_occupation" title="<?php echo $student_applicant->app_father_occupation->FldTitle() ?>"<?php echo $student_applicant->app_father_occupation->EditAttributes() ?>>
<?php
if (is_array($student_applicant->app_father_occupation->EditValue)) {
	$arwrk = $student_applicant->app_father_occupation->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->app_father_occupation->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_father_isalive->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_father_isalive->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_app_father_isalive" id="z_app_father_isalive" value="="></span></td>
		<td<?php echo $student_applicant->app_father_isalive->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_app_father_isalive" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_app_father_isalive" id="x_app_father_isalive" title="<?php echo $student_applicant->app_father_isalive->FldTitle() ?>" value="{value}"<?php echo $student_applicant->app_father_isalive->EditAttributes() ?>></label></div>
<div id="dsl_x_app_father_isalive" repeatcolumn="5">
<?php
$arwrk = $student_applicant->app_father_isalive->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->app_father_isalive->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_app_father_isalive" id="x_app_father_isalive" title="<?php echo $student_applicant->app_father_isalive->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $student_applicant->app_father_isalive->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_guardian_name->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_guardian_name->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_app_guardian_name" id="z_app_guardian_name" value="LIKE"></span></td>
		<td<?php echo $student_applicant->app_guardian_name->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_app_guardian_name" id="x_app_guardian_name" title="<?php echo $student_applicant->app_guardian_name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->app_guardian_name->EditValue ?>"<?php echo $student_applicant->app_guardian_name->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_guardian_relation->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_guardian_relation->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_app_guardian_relation" id="z_app_guardian_relation" value="LIKE"></span></td>
		<td<?php echo $student_applicant->app_guardian_relation->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_app_guardian_relation" name="x_app_guardian_relation" title="<?php echo $student_applicant->app_guardian_relation->FldTitle() ?>"<?php echo $student_applicant->app_guardian_relation->EditAttributes() ?>>
<?php
if (is_array($student_applicant->app_guardian_relation->EditValue)) {
	$arwrk = $student_applicant->app_guardian_relation->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->app_guardian_relation->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_guardian_occupation->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_guardian_occupation->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_app_guardian_occupation" id="z_app_guardian_occupation" value="="></span></td>
		<td<?php echo $student_applicant->app_guardian_occupation->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_app_guardian_occupation" name="x_app_guardian_occupation" title="<?php echo $student_applicant->app_guardian_occupation->FldTitle() ?>"<?php echo $student_applicant->app_guardian_occupation->EditAttributes() ?>>
<?php
if (is_array($student_applicant->app_guardian_occupation->EditValue)) {
	$arwrk = $student_applicant->app_guardian_occupation->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->app_guardian_occupation->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->sponsored_child_no->FldCaption() ?></td>
		<td<?php echo $student_applicant->sponsored_child_no->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_sponsored_child_no" id="z_sponsored_child_no" value="LIKE"></span></td>
		<td<?php echo $student_applicant->sponsored_child_no->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_sponsored_child_no" id="x_sponsored_child_no" title="<?php echo $student_applicant->sponsored_child_no->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->sponsored_child_no->EditValue ?>"<?php echo $student_applicant->sponsored_child_no->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_grades->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_grades->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_student_grades" id="z_student_grades" value="LIKE"></span></td>
		<td<?php echo $student_applicant->student_grades->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_student_grades" id="x_student_grades" title="<?php echo $student_applicant->student_grades->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->student_grades->EditValue ?>"<?php echo $student_applicant->student_grades->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_address->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_address->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_student_address" id="z_student_address" value="LIKE"></span></td>
		<td<?php echo $student_applicant->student_address->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_student_address" id="x_student_address" title="<?php echo $student_applicant->student_address->FldTitle() ?>" cols="30" rows="4"<?php echo $student_applicant->student_address->EditAttributes() ?>><?php echo $student_applicant->student_address->EditValue ?></textarea>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_admitted_school_id->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_admitted_school_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_student_admitted_school_id" id="z_student_admitted_school_id" value="="></span></td>
		<td<?php echo $student_applicant->student_admitted_school_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_student_admitted_school_id" name="x_student_admitted_school_id" title="<?php echo $student_applicant->student_admitted_school_id->FldTitle() ?>"<?php echo $student_applicant->student_admitted_school_id->EditAttributes() ?>>
<?php
if (is_array($student_applicant->student_admitted_school_id->EditValue)) {
	$arwrk = $student_applicant->student_admitted_school_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->student_admitted_school_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_primary_school_id->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_primary_school_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_app_primary_school_id" id="z_app_primary_school_id" value="="></span></td>
		<td<?php echo $student_applicant->app_primary_school_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_app_primary_school_id" name="x_app_primary_school_id" title="<?php echo $student_applicant->app_primary_school_id->FldTitle() ?>"<?php echo $student_applicant->app_primary_school_id->EditAttributes() ?>>
<?php
if (is_array($student_applicant->app_primary_school_id->EditValue)) {
	$arwrk = $student_applicant->app_primary_school_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->app_primary_school_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_junior_secondary_id->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_junior_secondary_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_app_junior_secondary_id" id="z_app_junior_secondary_id" value="="></span></td>
		<td<?php echo $student_applicant->app_junior_secondary_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_app_junior_secondary_id" name="x_app_junior_secondary_id" title="<?php echo $student_applicant->app_junior_secondary_id->FldTitle() ?>"<?php echo $student_applicant->app_junior_secondary_id->EditAttributes() ?>>
<?php
if (is_array($student_applicant->app_junior_secondary_id->EditValue)) {
	$arwrk = $student_applicant->app_junior_secondary_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->app_junior_secondary_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_community_community_id','x_community_community_id',false]]);

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
$student_applicant_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cstudent_applicant_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'student_applicant';

	// Page object name
	var $PageObjName = 'student_applicant_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $student_applicant;
		if ($student_applicant->UseTokenInUrl) $PageUrl .= "t=" . $student_applicant->TableVar . "&"; // Add page token
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
		global $objForm, $student_applicant;
		if ($student_applicant->UseTokenInUrl) {
			if ($objForm)
				return ($student_applicant->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($student_applicant->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cstudent_applicant_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (student_applicant)
		$GLOBALS["student_applicant"] = new cstudent_applicant();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'student_applicant', TRUE);

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
		global $student_applicant;

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
			$this->Page_Terminate("student_applicantlist.php");
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
		global $objForm, $Language, $gsSearchError, $student_applicant;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$student_applicant->CurrentAction = $objForm->GetValue("a_search");
			switch ($student_applicant->CurrentAction) {
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
						$sSrchStr = $student_applicant->UrlParm($sSrchStr);
						$this->Page_Terminate("student_applicantlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$student_applicant->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $student_applicant;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->student_applicant_id); // student_applicant_id
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->app_submission_year); // app_submission_year
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->student_resident_programarea_id); // student_resident_programarea_id
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->community_community_id); // community_community_id
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->app_status); // app_status
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->app_points); // app_points
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->app_grant_id); // app_grant_id
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->student_firstname); // student_firstname
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->student_middlename); // student_middlename
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->student_lastname); // student_lastname
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->student_gender); // student_gender
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->student_dob); // student_dob
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->app_mother_name); // app_mother_name
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->app_mother_isalive); // app_mother_isalive
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->app_mother_occupation); // app_mother_occupation
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->app_father_name); // app_father_name
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->app_father_occupation); // app_father_occupation
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->app_father_isalive); // app_father_isalive
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->app_guardian_name); // app_guardian_name
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->app_guardian_relation); // app_guardian_relation
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->app_guardian_occupation); // app_guardian_occupation
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->sponsored_child_no); // sponsored_child_no
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->student_grades); // student_grades
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->student_address); // student_address
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->student_admitted_school_id); // student_admitted_school_id
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->app_primary_school_id); // app_primary_school_id
	$this->BuildSearchUrl($sSrchUrl, $student_applicant->app_junior_secondary_id); // app_junior_secondary_id
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
		global $objForm, $student_applicant;

		// Load search values
		// student_applicant_id

		$student_applicant->student_applicant_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_applicant_id"));
		$student_applicant->student_applicant_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_applicant_id");

		// app_submission_year
		$student_applicant->app_submission_year->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_app_submission_year"));
		$student_applicant->app_submission_year->AdvancedSearch->SearchOperator = $objForm->GetValue("z_app_submission_year");

		// student_resident_programarea_id
		$student_applicant->student_resident_programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_resident_programarea_id"));
		$student_applicant->student_resident_programarea_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_resident_programarea_id");

		// community_community_id
		$student_applicant->community_community_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_community_community_id"));
		$student_applicant->community_community_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_community_community_id");

		// app_status
		$student_applicant->app_status->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_app_status"));
		$student_applicant->app_status->AdvancedSearch->SearchOperator = $objForm->GetValue("z_app_status");

		// app_points
		$student_applicant->app_points->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_app_points"));
		$student_applicant->app_points->AdvancedSearch->SearchOperator = $objForm->GetValue("z_app_points");

		// app_grant_id
		$student_applicant->app_grant_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_app_grant_id"));
		$student_applicant->app_grant_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_app_grant_id");

		// student_firstname
		$student_applicant->student_firstname->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_firstname"));
		$student_applicant->student_firstname->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_firstname");

		// student_middlename
		$student_applicant->student_middlename->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_middlename"));
		$student_applicant->student_middlename->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_middlename");

		// student_lastname
		$student_applicant->student_lastname->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_lastname"));
		$student_applicant->student_lastname->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_lastname");

		// student_gender
		$student_applicant->student_gender->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_gender"));
		$student_applicant->student_gender->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_gender");

		// student_dob
		$student_applicant->student_dob->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_dob"));
		$student_applicant->student_dob->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_dob");
		$student_applicant->student_dob->AdvancedSearch->SearchCondition = $objForm->GetValue("v_student_dob");
		$student_applicant->student_dob->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_student_dob"));
		$student_applicant->student_dob->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_student_dob");

		// app_mother_name
		$student_applicant->app_mother_name->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_app_mother_name"));
		$student_applicant->app_mother_name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_app_mother_name");

		// app_mother_isalive
		$student_applicant->app_mother_isalive->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_app_mother_isalive"));
		$student_applicant->app_mother_isalive->AdvancedSearch->SearchOperator = $objForm->GetValue("z_app_mother_isalive");

		// app_mother_occupation
		$student_applicant->app_mother_occupation->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_app_mother_occupation"));
		$student_applicant->app_mother_occupation->AdvancedSearch->SearchOperator = $objForm->GetValue("z_app_mother_occupation");

		// app_father_name
		$student_applicant->app_father_name->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_app_father_name"));
		$student_applicant->app_father_name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_app_father_name");

		// app_father_occupation
		$student_applicant->app_father_occupation->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_app_father_occupation"));
		$student_applicant->app_father_occupation->AdvancedSearch->SearchOperator = $objForm->GetValue("z_app_father_occupation");

		// app_father_isalive
		$student_applicant->app_father_isalive->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_app_father_isalive"));
		$student_applicant->app_father_isalive->AdvancedSearch->SearchOperator = $objForm->GetValue("z_app_father_isalive");

		// app_guardian_name
		$student_applicant->app_guardian_name->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_app_guardian_name"));
		$student_applicant->app_guardian_name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_app_guardian_name");

		// app_guardian_relation
		$student_applicant->app_guardian_relation->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_app_guardian_relation"));
		$student_applicant->app_guardian_relation->AdvancedSearch->SearchOperator = $objForm->GetValue("z_app_guardian_relation");

		// app_guardian_occupation
		$student_applicant->app_guardian_occupation->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_app_guardian_occupation"));
		$student_applicant->app_guardian_occupation->AdvancedSearch->SearchOperator = $objForm->GetValue("z_app_guardian_occupation");

		// sponsored_child_no
		$student_applicant->sponsored_child_no->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_sponsored_child_no"));
		$student_applicant->sponsored_child_no->AdvancedSearch->SearchOperator = $objForm->GetValue("z_sponsored_child_no");

		// student_grades
		$student_applicant->student_grades->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_grades"));
		$student_applicant->student_grades->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_grades");

		// student_address
		$student_applicant->student_address->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_address"));
		$student_applicant->student_address->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_address");

		// student_admitted_school_id
		$student_applicant->student_admitted_school_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_admitted_school_id"));
		$student_applicant->student_admitted_school_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_admitted_school_id");

		// app_primary_school_id
		$student_applicant->app_primary_school_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_app_primary_school_id"));
		$student_applicant->app_primary_school_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_app_primary_school_id");

		// app_junior_secondary_id
		$student_applicant->app_junior_secondary_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_app_junior_secondary_id"));
		$student_applicant->app_junior_secondary_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_app_junior_secondary_id");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $student_applicant;

		// Initialize URLs
		// Call Row_Rendering event

		$student_applicant->Row_Rendering();

		// Common render codes for all row types
		// student_applicant_id

		$student_applicant->student_applicant_id->CellCssStyle = ""; $student_applicant->student_applicant_id->CellCssClass = "";
		$student_applicant->student_applicant_id->CellAttrs = array(); $student_applicant->student_applicant_id->ViewAttrs = array(); $student_applicant->student_applicant_id->EditAttrs = array();

		// app_submission_year
		$student_applicant->app_submission_year->CellCssStyle = ""; $student_applicant->app_submission_year->CellCssClass = "";
		$student_applicant->app_submission_year->CellAttrs = array(); $student_applicant->app_submission_year->ViewAttrs = array(); $student_applicant->app_submission_year->EditAttrs = array();

		// student_resident_programarea_id
		$student_applicant->student_resident_programarea_id->CellCssStyle = ""; $student_applicant->student_resident_programarea_id->CellCssClass = "";
		$student_applicant->student_resident_programarea_id->CellAttrs = array(); $student_applicant->student_resident_programarea_id->ViewAttrs = array(); $student_applicant->student_resident_programarea_id->EditAttrs = array();

		// community_community_id
		$student_applicant->community_community_id->CellCssStyle = ""; $student_applicant->community_community_id->CellCssClass = "";
		$student_applicant->community_community_id->CellAttrs = array(); $student_applicant->community_community_id->ViewAttrs = array(); $student_applicant->community_community_id->EditAttrs = array();

		// app_status
		$student_applicant->app_status->CellCssStyle = ""; $student_applicant->app_status->CellCssClass = "";
		$student_applicant->app_status->CellAttrs = array(); $student_applicant->app_status->ViewAttrs = array(); $student_applicant->app_status->EditAttrs = array();

		// app_points
		$student_applicant->app_points->CellCssStyle = ""; $student_applicant->app_points->CellCssClass = "";
		$student_applicant->app_points->CellAttrs = array(); $student_applicant->app_points->ViewAttrs = array(); $student_applicant->app_points->EditAttrs = array();

		// app_grant_id
		$student_applicant->app_grant_id->CellCssStyle = ""; $student_applicant->app_grant_id->CellCssClass = "";
		$student_applicant->app_grant_id->CellAttrs = array(); $student_applicant->app_grant_id->ViewAttrs = array(); $student_applicant->app_grant_id->EditAttrs = array();

		// student_firstname
		$student_applicant->student_firstname->CellCssStyle = ""; $student_applicant->student_firstname->CellCssClass = "";
		$student_applicant->student_firstname->CellAttrs = array(); $student_applicant->student_firstname->ViewAttrs = array(); $student_applicant->student_firstname->EditAttrs = array();

		// student_middlename
		$student_applicant->student_middlename->CellCssStyle = ""; $student_applicant->student_middlename->CellCssClass = "";
		$student_applicant->student_middlename->CellAttrs = array(); $student_applicant->student_middlename->ViewAttrs = array(); $student_applicant->student_middlename->EditAttrs = array();

		// student_lastname
		$student_applicant->student_lastname->CellCssStyle = ""; $student_applicant->student_lastname->CellCssClass = "";
		$student_applicant->student_lastname->CellAttrs = array(); $student_applicant->student_lastname->ViewAttrs = array(); $student_applicant->student_lastname->EditAttrs = array();

		// student_gender
		$student_applicant->student_gender->CellCssStyle = ""; $student_applicant->student_gender->CellCssClass = "";
		$student_applicant->student_gender->CellAttrs = array(); $student_applicant->student_gender->ViewAttrs = array(); $student_applicant->student_gender->EditAttrs = array();

		// student_dob
		$student_applicant->student_dob->CellCssStyle = ""; $student_applicant->student_dob->CellCssClass = "";
		$student_applicant->student_dob->CellAttrs = array(); $student_applicant->student_dob->ViewAttrs = array(); $student_applicant->student_dob->EditAttrs = array();

		// app_mother_name
		$student_applicant->app_mother_name->CellCssStyle = ""; $student_applicant->app_mother_name->CellCssClass = "";
		$student_applicant->app_mother_name->CellAttrs = array(); $student_applicant->app_mother_name->ViewAttrs = array(); $student_applicant->app_mother_name->EditAttrs = array();

		// app_mother_isalive
		$student_applicant->app_mother_isalive->CellCssStyle = ""; $student_applicant->app_mother_isalive->CellCssClass = "";
		$student_applicant->app_mother_isalive->CellAttrs = array(); $student_applicant->app_mother_isalive->ViewAttrs = array(); $student_applicant->app_mother_isalive->EditAttrs = array();

		// app_mother_occupation
		$student_applicant->app_mother_occupation->CellCssStyle = ""; $student_applicant->app_mother_occupation->CellCssClass = "";
		$student_applicant->app_mother_occupation->CellAttrs = array(); $student_applicant->app_mother_occupation->ViewAttrs = array(); $student_applicant->app_mother_occupation->EditAttrs = array();

		// app_father_name
		$student_applicant->app_father_name->CellCssStyle = ""; $student_applicant->app_father_name->CellCssClass = "";
		$student_applicant->app_father_name->CellAttrs = array(); $student_applicant->app_father_name->ViewAttrs = array(); $student_applicant->app_father_name->EditAttrs = array();

		// app_father_occupation
		$student_applicant->app_father_occupation->CellCssStyle = ""; $student_applicant->app_father_occupation->CellCssClass = "";
		$student_applicant->app_father_occupation->CellAttrs = array(); $student_applicant->app_father_occupation->ViewAttrs = array(); $student_applicant->app_father_occupation->EditAttrs = array();

		// app_father_isalive
		$student_applicant->app_father_isalive->CellCssStyle = ""; $student_applicant->app_father_isalive->CellCssClass = "";
		$student_applicant->app_father_isalive->CellAttrs = array(); $student_applicant->app_father_isalive->ViewAttrs = array(); $student_applicant->app_father_isalive->EditAttrs = array();

		// student_picture
		$student_applicant->student_picture->CellCssStyle = ""; $student_applicant->student_picture->CellCssClass = "";
		$student_applicant->student_picture->CellAttrs = array(); $student_applicant->student_picture->ViewAttrs = array(); $student_applicant->student_picture->EditAttrs = array();

		// app_guardian_name
		$student_applicant->app_guardian_name->CellCssStyle = ""; $student_applicant->app_guardian_name->CellCssClass = "";
		$student_applicant->app_guardian_name->CellAttrs = array(); $student_applicant->app_guardian_name->ViewAttrs = array(); $student_applicant->app_guardian_name->EditAttrs = array();

		// app_guardian_relation
		$student_applicant->app_guardian_relation->CellCssStyle = ""; $student_applicant->app_guardian_relation->CellCssClass = "";
		$student_applicant->app_guardian_relation->CellAttrs = array(); $student_applicant->app_guardian_relation->ViewAttrs = array(); $student_applicant->app_guardian_relation->EditAttrs = array();

		// app_guardian_occupation
		$student_applicant->app_guardian_occupation->CellCssStyle = ""; $student_applicant->app_guardian_occupation->CellCssClass = "";
		$student_applicant->app_guardian_occupation->CellAttrs = array(); $student_applicant->app_guardian_occupation->ViewAttrs = array(); $student_applicant->app_guardian_occupation->EditAttrs = array();

		// sponsored_child_no
		$student_applicant->sponsored_child_no->CellCssStyle = ""; $student_applicant->sponsored_child_no->CellCssClass = "";
		$student_applicant->sponsored_child_no->CellAttrs = array(); $student_applicant->sponsored_child_no->ViewAttrs = array(); $student_applicant->sponsored_child_no->EditAttrs = array();

		// student_grades
		$student_applicant->student_grades->CellCssStyle = ""; $student_applicant->student_grades->CellCssClass = "";
		$student_applicant->student_grades->CellAttrs = array(); $student_applicant->student_grades->ViewAttrs = array(); $student_applicant->student_grades->EditAttrs = array();

		// student_address
		$student_applicant->student_address->CellCssStyle = ""; $student_applicant->student_address->CellCssClass = "";
		$student_applicant->student_address->CellAttrs = array(); $student_applicant->student_address->ViewAttrs = array(); $student_applicant->student_address->EditAttrs = array();

		// student_admitted_school_id
		$student_applicant->student_admitted_school_id->CellCssStyle = ""; $student_applicant->student_admitted_school_id->CellCssClass = "";
		$student_applicant->student_admitted_school_id->CellAttrs = array(); $student_applicant->student_admitted_school_id->ViewAttrs = array(); $student_applicant->student_admitted_school_id->EditAttrs = array();

		// app_primary_school_id
		$student_applicant->app_primary_school_id->CellCssStyle = ""; $student_applicant->app_primary_school_id->CellCssClass = "";
		$student_applicant->app_primary_school_id->CellAttrs = array(); $student_applicant->app_primary_school_id->ViewAttrs = array(); $student_applicant->app_primary_school_id->EditAttrs = array();

		// app_junior_secondary_id
		$student_applicant->app_junior_secondary_id->CellCssStyle = ""; $student_applicant->app_junior_secondary_id->CellCssClass = "";
		$student_applicant->app_junior_secondary_id->CellAttrs = array(); $student_applicant->app_junior_secondary_id->ViewAttrs = array(); $student_applicant->app_junior_secondary_id->EditAttrs = array();
		if ($student_applicant->RowType == EW_ROWTYPE_VIEW) { // View row

			// student_applicant_id
			$student_applicant->student_applicant_id->ViewValue = $student_applicant->student_applicant_id->CurrentValue;
			$student_applicant->student_applicant_id->CssStyle = "";
			$student_applicant->student_applicant_id->CssClass = "";
			$student_applicant->student_applicant_id->ViewCustomAttributes = "";

			// app_submission_year
			$student_applicant->app_submission_year->ViewValue = $student_applicant->app_submission_year->CurrentValue;
			if (strval($student_applicant->app_submission_year->CurrentValue) <> "") {
				$sFilterWrk = "`app_year` = " . ew_AdjustSql($student_applicant->app_submission_year->CurrentValue) . "";
			$sSqlWrk = "SELECT `app_year` FROM `academic_year`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "active='ACTIVE'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `app_year` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_submission_year->ViewValue = $rswrk->fields('app_year');
					$rswrk->Close();
				} else {
					$student_applicant->app_submission_year->ViewValue = $student_applicant->app_submission_year->CurrentValue;
				}
			} else {
				$student_applicant->app_submission_year->ViewValue = NULL;
			}
			$student_applicant->app_submission_year->CssStyle = "";
			$student_applicant->app_submission_year->CssClass = "";
			$student_applicant->app_submission_year->ViewCustomAttributes = "";

			// student_resident_programarea_id
			if (strval($student_applicant->student_resident_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($student_applicant->student_resident_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->student_resident_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$student_applicant->student_resident_programarea_id->ViewValue = $student_applicant->student_resident_programarea_id->CurrentValue;
				}
			} else {
				$student_applicant->student_resident_programarea_id->ViewValue = NULL;
			}
			$student_applicant->student_resident_programarea_id->CssStyle = "";
			$student_applicant->student_resident_programarea_id->CssClass = "";
			$student_applicant->student_resident_programarea_id->ViewCustomAttributes = "";

			// community_community_id
			if (strval($student_applicant->community_community_id->CurrentValue) <> "") {
				$sFilterWrk = "`community_id` = " . ew_AdjustSql($student_applicant->community_community_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `community` FROM `community`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->community_community_id->ViewValue = $rswrk->fields('community');
					$rswrk->Close();
				} else {
					$student_applicant->community_community_id->ViewValue = $student_applicant->community_community_id->CurrentValue;
				}
			} else {
				$student_applicant->community_community_id->ViewValue = NULL;
			}
			$student_applicant->community_community_id->CssStyle = "";
			$student_applicant->community_community_id->CssClass = "";
			$student_applicant->community_community_id->ViewCustomAttributes = "";

			// app_status
			$student_applicant->app_status->ViewValue = $student_applicant->app_status->CurrentValue;
			if (strval($student_applicant->app_status->CurrentValue) <> "") {
				$sFilterWrk = "`application_status_id` = " . ew_AdjustSql($student_applicant->app_status->CurrentValue) . "";
			$sSqlWrk = "SELECT `application_status` FROM `application_status`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_status->ViewValue = $rswrk->fields('application_status');
					$rswrk->Close();
				} else {
					$student_applicant->app_status->ViewValue = $student_applicant->app_status->CurrentValue;
				}
			} else {
				$student_applicant->app_status->ViewValue = NULL;
			}
			$student_applicant->app_status->CssStyle = "";
			$student_applicant->app_status->CssClass = "";
			$student_applicant->app_status->ViewCustomAttributes = "";

			// app_points
			$student_applicant->app_points->ViewValue = $student_applicant->app_points->CurrentValue;
			$student_applicant->app_points->CssStyle = "";
			$student_applicant->app_points->CssClass = "";
			$student_applicant->app_points->ViewCustomAttributes = "";

			// app_grant_id
			$student_applicant->app_grant_id->ViewValue = $student_applicant->app_grant_id->CurrentValue;
			if (strval($student_applicant->app_grant_id->CurrentValue) <> "") {
				$sFilterWrk = "`grant_package_id` = " . ew_AdjustSql($student_applicant->app_grant_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `grant_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_grant_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_grant_id->ViewValue = $student_applicant->app_grant_id->CurrentValue;
				}
			} else {
				$student_applicant->app_grant_id->ViewValue = NULL;
			}
			$student_applicant->app_grant_id->CssStyle = "";
			$student_applicant->app_grant_id->CssClass = "";
			$student_applicant->app_grant_id->ViewCustomAttributes = "";

			// app_amount
			$student_applicant->app_amount->ViewValue = $student_applicant->app_amount->CurrentValue;
			$student_applicant->app_amount->CssStyle = "";
			$student_applicant->app_amount->CssClass = "";
			$student_applicant->app_amount->ViewCustomAttributes = "";

			// student_firstname
			$student_applicant->student_firstname->ViewValue = $student_applicant->student_firstname->CurrentValue;
			$student_applicant->student_firstname->CssStyle = "";
			$student_applicant->student_firstname->CssClass = "";
			$student_applicant->student_firstname->ViewCustomAttributes = "";

			// student_middlename
			$student_applicant->student_middlename->ViewValue = $student_applicant->student_middlename->CurrentValue;
			$student_applicant->student_middlename->CssStyle = "";
			$student_applicant->student_middlename->CssClass = "";
			$student_applicant->student_middlename->ViewCustomAttributes = "";

			// student_lastname
			$student_applicant->student_lastname->ViewValue = $student_applicant->student_lastname->CurrentValue;
			$student_applicant->student_lastname->CssStyle = "";
			$student_applicant->student_lastname->CssClass = "";
			$student_applicant->student_lastname->ViewCustomAttributes = "";

			// student_gender
			if (strval($student_applicant->student_gender->CurrentValue) <> "") {
				switch ($student_applicant->student_gender->CurrentValue) {
					case "M":
						$student_applicant->student_gender->ViewValue = "Male";
						break;
					case "F":
						$student_applicant->student_gender->ViewValue = "Female";
						break;
					default:
						$student_applicant->student_gender->ViewValue = $student_applicant->student_gender->CurrentValue;
				}
			} else {
				$student_applicant->student_gender->ViewValue = NULL;
			}
			$student_applicant->student_gender->CssStyle = "";
			$student_applicant->student_gender->CssClass = "";
			$student_applicant->student_gender->ViewCustomAttributes = "";

			// student_dob
			$student_applicant->student_dob->ViewValue = $student_applicant->student_dob->CurrentValue;
			$student_applicant->student_dob->ViewValue = ew_FormatDateTime($student_applicant->student_dob->ViewValue, 7);
			$student_applicant->student_dob->CssStyle = "";
			$student_applicant->student_dob->CssClass = "";
			$student_applicant->student_dob->ViewCustomAttributes = "";

			// app_mother_name
			$student_applicant->app_mother_name->ViewValue = $student_applicant->app_mother_name->CurrentValue;
			$student_applicant->app_mother_name->CssStyle = "";
			$student_applicant->app_mother_name->CssClass = "";
			$student_applicant->app_mother_name->ViewCustomAttributes = "";

			// app_mother_isalive
			if (strval($student_applicant->app_mother_isalive->CurrentValue) <> "") {
				switch ($student_applicant->app_mother_isalive->CurrentValue) {
					case "1":
						$student_applicant->app_mother_isalive->ViewValue = "Alive";
						break;
					case "0":
						$student_applicant->app_mother_isalive->ViewValue = "Deceased";
						break;
					default:
						$student_applicant->app_mother_isalive->ViewValue = $student_applicant->app_mother_isalive->CurrentValue;
				}
			} else {
				$student_applicant->app_mother_isalive->ViewValue = NULL;
			}
			$student_applicant->app_mother_isalive->CssStyle = "";
			$student_applicant->app_mother_isalive->CssClass = "";
			$student_applicant->app_mother_isalive->ViewCustomAttributes = "";

			// app_mother_occupation
			if (strval($student_applicant->app_mother_occupation->CurrentValue) <> "") {
				$sFilterWrk = "`application_occupation_id` = " . ew_AdjustSql($student_applicant->app_mother_occupation->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_mother_occupation->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_mother_occupation->ViewValue = $student_applicant->app_mother_occupation->CurrentValue;
				}
			} else {
				$student_applicant->app_mother_occupation->ViewValue = NULL;
			}
			$student_applicant->app_mother_occupation->CssStyle = "";
			$student_applicant->app_mother_occupation->CssClass = "";
			$student_applicant->app_mother_occupation->ViewCustomAttributes = "";

			// app_father_name
			$student_applicant->app_father_name->ViewValue = $student_applicant->app_father_name->CurrentValue;
			$student_applicant->app_father_name->CssStyle = "";
			$student_applicant->app_father_name->CssClass = "";
			$student_applicant->app_father_name->ViewCustomAttributes = "";

			// app_father_occupation
			if (strval($student_applicant->app_father_occupation->CurrentValue) <> "") {
				$sFilterWrk = "`application_occupation_id` = " . ew_AdjustSql($student_applicant->app_father_occupation->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_father_occupation->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_father_occupation->ViewValue = $student_applicant->app_father_occupation->CurrentValue;
				}
			} else {
				$student_applicant->app_father_occupation->ViewValue = NULL;
			}
			$student_applicant->app_father_occupation->CssStyle = "";
			$student_applicant->app_father_occupation->CssClass = "";
			$student_applicant->app_father_occupation->ViewCustomAttributes = "";

			// app_father_isalive
			if (strval($student_applicant->app_father_isalive->CurrentValue) <> "") {
				switch ($student_applicant->app_father_isalive->CurrentValue) {
					case "1":
						$student_applicant->app_father_isalive->ViewValue = "Alive";
						break;
					case "0":
						$student_applicant->app_father_isalive->ViewValue = "Deceased";
						break;
					default:
						$student_applicant->app_father_isalive->ViewValue = $student_applicant->app_father_isalive->CurrentValue;
				}
			} else {
				$student_applicant->app_father_isalive->ViewValue = NULL;
			}
			$student_applicant->app_father_isalive->CssStyle = "";
			$student_applicant->app_father_isalive->CssClass = "";
			$student_applicant->app_father_isalive->ViewCustomAttributes = "";

			// student_picture
			if (!ew_Empty($student_applicant->student_picture->Upload->DbValue)) {
				$student_applicant->student_picture->ViewValue = $student_applicant->student_picture->Upload->DbValue;
			} else {
				$student_applicant->student_picture->ViewValue = "";
			}
			$student_applicant->student_picture->CssStyle = "";
			$student_applicant->student_picture->CssClass = "";
			$student_applicant->student_picture->ViewCustomAttributes = "";

			// app_guardian_name
			$student_applicant->app_guardian_name->ViewValue = $student_applicant->app_guardian_name->CurrentValue;
			$student_applicant->app_guardian_name->CssStyle = "";
			$student_applicant->app_guardian_name->CssClass = "";
			$student_applicant->app_guardian_name->ViewCustomAttributes = "";

			// app_guardian_relation
			if (strval($student_applicant->app_guardian_relation->CurrentValue) <> "") {
				switch ($student_applicant->app_guardian_relation->CurrentValue) {
					case "NA":
						$student_applicant->app_guardian_relation->ViewValue = "not applicable";
						break;
					case "grandparent":
						$student_applicant->app_guardian_relation->ViewValue = "grandparent";
						break;
					case "grandparent":
						$student_applicant->app_guardian_relation->ViewValue = "grandparent";
						break;
					case "aunt":
						$student_applicant->app_guardian_relation->ViewValue = "aunt";
						break;
					case "sibling":
						$student_applicant->app_guardian_relation->ViewValue = "sibling";
						break;
					case "cousin":
						$student_applicant->app_guardian_relation->ViewValue = "cousin";
						break;
					case "in law":
						$student_applicant->app_guardian_relation->ViewValue = "in law";
						break;
					case "father family":
						$student_applicant->app_guardian_relation->ViewValue = "father family";
						break;
					case "mother family":
						$student_applicant->app_guardian_relation->ViewValue = "mother family";
						break;
					case "extended family":
						$student_applicant->app_guardian_relation->ViewValue = "extended family";
						break;
					case "other relation":
						$student_applicant->app_guardian_relation->ViewValue = "other relation";
						break;
					default:
						$student_applicant->app_guardian_relation->ViewValue = $student_applicant->app_guardian_relation->CurrentValue;
				}
			} else {
				$student_applicant->app_guardian_relation->ViewValue = NULL;
			}
			$student_applicant->app_guardian_relation->CssStyle = "";
			$student_applicant->app_guardian_relation->CssClass = "";
			$student_applicant->app_guardian_relation->ViewCustomAttributes = "";

			// app_guardian_occupation
			if (strval($student_applicant->app_guardian_occupation->CurrentValue) <> "") {
				$sFilterWrk = "`application_occupation_id` = " . ew_AdjustSql($student_applicant->app_guardian_occupation->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_guardian_occupation->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_guardian_occupation->ViewValue = $student_applicant->app_guardian_occupation->CurrentValue;
				}
			} else {
				$student_applicant->app_guardian_occupation->ViewValue = NULL;
			}
			$student_applicant->app_guardian_occupation->CssStyle = "";
			$student_applicant->app_guardian_occupation->CssClass = "";
			$student_applicant->app_guardian_occupation->ViewCustomAttributes = "";

			// app_referees
			$student_applicant->app_referees->ViewValue = $student_applicant->app_referees->CurrentValue;
			$student_applicant->app_referees->CssStyle = "";
			$student_applicant->app_referees->CssClass = "";
			$student_applicant->app_referees->ViewCustomAttributes = "";

			// sponsored_child_no
			$student_applicant->sponsored_child_no->ViewValue = $student_applicant->sponsored_child_no->CurrentValue;
			$student_applicant->sponsored_child_no->CssStyle = "";
			$student_applicant->sponsored_child_no->CssClass = "";
			$student_applicant->sponsored_child_no->ViewCustomAttributes = "";

			// student_grades
			$student_applicant->student_grades->ViewValue = $student_applicant->student_grades->CurrentValue;
			$student_applicant->student_grades->CssStyle = "";
			$student_applicant->student_grades->CssClass = "";
			$student_applicant->student_grades->ViewCustomAttributes = "";

			// student_address
			$student_applicant->student_address->ViewValue = $student_applicant->student_address->CurrentValue;
			$student_applicant->student_address->CssStyle = "";
			$student_applicant->student_address->CssClass = "";
			$student_applicant->student_address->ViewCustomAttributes = "";

			// student_telephone_1
			$student_applicant->student_telephone_1->ViewValue = $student_applicant->student_telephone_1->CurrentValue;
			$student_applicant->student_telephone_1->CssStyle = "";
			$student_applicant->student_telephone_1->CssClass = "";
			$student_applicant->student_telephone_1->ViewCustomAttributes = "";

			// student_telephone_2
			$student_applicant->student_telephone_2->ViewValue = $student_applicant->student_telephone_2->CurrentValue;
			$student_applicant->student_telephone_2->CssStyle = "";
			$student_applicant->student_telephone_2->CssClass = "";
			$student_applicant->student_telephone_2->ViewCustomAttributes = "";

			// student_admitted_school_id
			if (strval($student_applicant->student_admitted_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($student_applicant->student_admitted_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->student_admitted_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$student_applicant->student_admitted_school_id->ViewValue = $student_applicant->student_admitted_school_id->CurrentValue;
				}
			} else {
				$student_applicant->student_admitted_school_id->ViewValue = NULL;
			}
			$student_applicant->student_admitted_school_id->CssStyle = "";
			$student_applicant->student_admitted_school_id->CssClass = "";
			$student_applicant->student_admitted_school_id->ViewCustomAttributes = "";

			// app_primary_school_id
			if (strval($student_applicant->app_primary_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_id` = " . ew_AdjustSql($student_applicant->app_primary_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_name` FROM `applicant_school`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`applicant_school_type`=1" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_primary_school_id->ViewValue = $rswrk->fields('applicant_school_name');
					$rswrk->Close();
				} else {
					$student_applicant->app_primary_school_id->ViewValue = $student_applicant->app_primary_school_id->CurrentValue;
				}
			} else {
				$student_applicant->app_primary_school_id->ViewValue = NULL;
			}
			$student_applicant->app_primary_school_id->CssStyle = "";
			$student_applicant->app_primary_school_id->CssClass = "";
			$student_applicant->app_primary_school_id->ViewCustomAttributes = "";

			// app_junior_secondary_id
			if (strval($student_applicant->app_junior_secondary_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_id` = " . ew_AdjustSql($student_applicant->app_junior_secondary_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_name` FROM `applicant_school`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`applicant_school_type`=2" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_junior_secondary_id->ViewValue = $rswrk->fields('applicant_school_name');
					$rswrk->Close();
				} else {
					$student_applicant->app_junior_secondary_id->ViewValue = $student_applicant->app_junior_secondary_id->CurrentValue;
				}
			} else {
				$student_applicant->app_junior_secondary_id->ViewValue = NULL;
			}
			$student_applicant->app_junior_secondary_id->CssStyle = "";
			$student_applicant->app_junior_secondary_id->CssClass = "";
			$student_applicant->app_junior_secondary_id->ViewCustomAttributes = "";

			// app_scanneddocument
			if (!ew_Empty($student_applicant->app_scanneddocument->Upload->DbValue)) {
				$student_applicant->app_scanneddocument->ViewValue = $student_applicant->app_scanneddocument->Upload->DbValue;
			} else {
				$student_applicant->app_scanneddocument->ViewValue = "";
			}
			$student_applicant->app_scanneddocument->CssStyle = "";
			$student_applicant->app_scanneddocument->CssClass = "";
			$student_applicant->app_scanneddocument->ViewCustomAttributes = "";

			// group_id
			$student_applicant->group_id->ViewValue = $student_applicant->group_id->CurrentValue;
			$student_applicant->group_id->CssStyle = "";
			$student_applicant->group_id->CssClass = "";
			$student_applicant->group_id->ViewCustomAttributes = "";

			// student_applicant_id
			$student_applicant->student_applicant_id->HrefValue = "";
			$student_applicant->student_applicant_id->TooltipValue = "";

			// app_submission_year
			$student_applicant->app_submission_year->HrefValue = "";
			$student_applicant->app_submission_year->TooltipValue = "";

			// student_resident_programarea_id
			$student_applicant->student_resident_programarea_id->HrefValue = "";
			$student_applicant->student_resident_programarea_id->TooltipValue = "";

			// community_community_id
			$student_applicant->community_community_id->HrefValue = "";
			$student_applicant->community_community_id->TooltipValue = "";

			// app_status
			$student_applicant->app_status->HrefValue = "";
			$student_applicant->app_status->TooltipValue = "";

			// app_points
			$student_applicant->app_points->HrefValue = "";
			$student_applicant->app_points->TooltipValue = "";

			// app_grant_id
			$student_applicant->app_grant_id->HrefValue = "";
			$student_applicant->app_grant_id->TooltipValue = "";

			// student_firstname
			$student_applicant->student_firstname->HrefValue = "";
			$student_applicant->student_firstname->TooltipValue = "";

			// student_middlename
			$student_applicant->student_middlename->HrefValue = "";
			$student_applicant->student_middlename->TooltipValue = "";

			// student_lastname
			$student_applicant->student_lastname->HrefValue = "";
			$student_applicant->student_lastname->TooltipValue = "";

			// student_gender
			$student_applicant->student_gender->HrefValue = "";
			$student_applicant->student_gender->TooltipValue = "";

			// student_dob
			$student_applicant->student_dob->HrefValue = "";
			$student_applicant->student_dob->TooltipValue = "";

			// app_mother_name
			$student_applicant->app_mother_name->HrefValue = "";
			$student_applicant->app_mother_name->TooltipValue = "";

			// app_mother_isalive
			$student_applicant->app_mother_isalive->HrefValue = "";
			$student_applicant->app_mother_isalive->TooltipValue = "";

			// app_mother_occupation
			$student_applicant->app_mother_occupation->HrefValue = "";
			$student_applicant->app_mother_occupation->TooltipValue = "";

			// app_father_name
			$student_applicant->app_father_name->HrefValue = "";
			$student_applicant->app_father_name->TooltipValue = "";

			// app_father_occupation
			$student_applicant->app_father_occupation->HrefValue = "";
			$student_applicant->app_father_occupation->TooltipValue = "";

			// app_father_isalive
			$student_applicant->app_father_isalive->HrefValue = "";
			$student_applicant->app_father_isalive->TooltipValue = "";

			// student_picture
			if (!ew_Empty($student_applicant->student_picture->Upload->DbValue)) {
				$student_applicant->student_picture->HrefValue = ew_UploadPathEx(FALSE, $student_applicant->student_picture->UploadPath) . ((!empty($student_applicant->student_picture->ViewValue)) ? $student_applicant->student_picture->ViewValue : $student_applicant->student_picture->CurrentValue);
				if ($student_applicant->Export <> "") $student_applicant->student_picture->HrefValue = ew_ConvertFullUrl($student_applicant->student_picture->HrefValue);
			} else {
				$student_applicant->student_picture->HrefValue = "";
			}
			$student_applicant->student_picture->TooltipValue = "";

			// app_guardian_name
			$student_applicant->app_guardian_name->HrefValue = "";
			$student_applicant->app_guardian_name->TooltipValue = "";

			// app_guardian_relation
			$student_applicant->app_guardian_relation->HrefValue = "";
			$student_applicant->app_guardian_relation->TooltipValue = "";

			// app_guardian_occupation
			$student_applicant->app_guardian_occupation->HrefValue = "";
			$student_applicant->app_guardian_occupation->TooltipValue = "";

			// sponsored_child_no
			$student_applicant->sponsored_child_no->HrefValue = "";
			$student_applicant->sponsored_child_no->TooltipValue = "";

			// student_grades
			$student_applicant->student_grades->HrefValue = "";
			$student_applicant->student_grades->TooltipValue = "";

			// student_address
			$student_applicant->student_address->HrefValue = "";
			$student_applicant->student_address->TooltipValue = "";

			// student_admitted_school_id
			$student_applicant->student_admitted_school_id->HrefValue = "";
			$student_applicant->student_admitted_school_id->TooltipValue = "";

			// app_primary_school_id
			$student_applicant->app_primary_school_id->HrefValue = "";
			$student_applicant->app_primary_school_id->TooltipValue = "";

			// app_junior_secondary_id
			$student_applicant->app_junior_secondary_id->HrefValue = "";
			$student_applicant->app_junior_secondary_id->TooltipValue = "";
		} elseif ($student_applicant->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// student_applicant_id
			$student_applicant->student_applicant_id->EditCustomAttributes = "";
			$student_applicant->student_applicant_id->EditValue = ew_HtmlEncode($student_applicant->student_applicant_id->AdvancedSearch->SearchValue);

			// app_submission_year
			$student_applicant->app_submission_year->EditCustomAttributes = "";
			$student_applicant->app_submission_year->EditValue = ew_HtmlEncode($student_applicant->app_submission_year->AdvancedSearch->SearchValue);
			if (strval($student_applicant->app_submission_year->AdvancedSearch->SearchValue) <> "") {
				$sFilterWrk = "`app_year` = " . ew_AdjustSql($student_applicant->app_submission_year->AdvancedSearch->SearchValue) . "";
			$sSqlWrk = "SELECT `app_year` FROM `academic_year`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "active='ACTIVE'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `app_year` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_submission_year->EditValue = $rswrk->fields('app_year');
					$rswrk->Close();
				} else {
					$student_applicant->app_submission_year->EditValue = $student_applicant->app_submission_year->AdvancedSearch->SearchValue;
				}
			} else {
				$student_applicant->app_submission_year->EditValue = NULL;
			}

			// student_resident_programarea_id
			$student_applicant->student_resident_programarea_id->EditCustomAttributes = "";
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
			$student_applicant->student_resident_programarea_id->EditValue = $arwrk;

			// community_community_id
			$student_applicant->community_community_id->EditCustomAttributes = "";
			if (trim(strval($student_applicant->community_community_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`community_id` = " . ew_AdjustSql($student_applicant->community_community_id->AdvancedSearch->SearchValue) . "";
			}
			$sSqlWrk = "SELECT `community_id`, `community`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `community`";
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
			$student_applicant->community_community_id->EditValue = $arwrk;

			// app_status
			$student_applicant->app_status->EditCustomAttributes = "";
			$student_applicant->app_status->EditValue = ew_HtmlEncode($student_applicant->app_status->AdvancedSearch->SearchValue);
			if (strval($student_applicant->app_status->AdvancedSearch->SearchValue) <> "") {
				$sFilterWrk = "`application_status_id` = " . ew_AdjustSql($student_applicant->app_status->AdvancedSearch->SearchValue) . "";
			$sSqlWrk = "SELECT `application_status` FROM `application_status`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_status->EditValue = $rswrk->fields('application_status');
					$rswrk->Close();
				} else {
					$student_applicant->app_status->EditValue = $student_applicant->app_status->AdvancedSearch->SearchValue;
				}
			} else {
				$student_applicant->app_status->EditValue = NULL;
			}

			// app_points
			$student_applicant->app_points->EditCustomAttributes = "";
			$student_applicant->app_points->EditValue = ew_HtmlEncode($student_applicant->app_points->AdvancedSearch->SearchValue);

			// app_grant_id
			$student_applicant->app_grant_id->EditCustomAttributes = "";
			$student_applicant->app_grant_id->EditValue = ew_HtmlEncode($student_applicant->app_grant_id->AdvancedSearch->SearchValue);
			if (strval($student_applicant->app_grant_id->AdvancedSearch->SearchValue) <> "") {
				$sFilterWrk = "`grant_package_id` = " . ew_AdjustSql($student_applicant->app_grant_id->AdvancedSearch->SearchValue) . "";
			$sSqlWrk = "SELECT `name` FROM `grant_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_grant_id->EditValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_grant_id->EditValue = $student_applicant->app_grant_id->AdvancedSearch->SearchValue;
				}
			} else {
				$student_applicant->app_grant_id->EditValue = NULL;
			}

			// student_firstname
			$student_applicant->student_firstname->EditCustomAttributes = "";
			$student_applicant->student_firstname->EditValue = ew_HtmlEncode($student_applicant->student_firstname->AdvancedSearch->SearchValue);

			// student_middlename
			$student_applicant->student_middlename->EditCustomAttributes = "";
			$student_applicant->student_middlename->EditValue = ew_HtmlEncode($student_applicant->student_middlename->AdvancedSearch->SearchValue);

			// student_lastname
			$student_applicant->student_lastname->EditCustomAttributes = "";
			$student_applicant->student_lastname->EditValue = ew_HtmlEncode($student_applicant->student_lastname->AdvancedSearch->SearchValue);

			// student_gender
			$student_applicant->student_gender->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("M", "Male");
			$arwrk[] = array("F", "Female");
			$student_applicant->student_gender->EditValue = $arwrk;

			// student_dob
			$student_applicant->student_dob->EditCustomAttributes = "";
			$student_applicant->student_dob->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($student_applicant->student_dob->AdvancedSearch->SearchValue, 7), 7));
			$student_applicant->student_dob->EditCustomAttributes = "";
			$student_applicant->student_dob->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($student_applicant->student_dob->AdvancedSearch->SearchValue2, 7), 7));

			// app_mother_name
			$student_applicant->app_mother_name->EditCustomAttributes = "";
			$student_applicant->app_mother_name->EditValue = ew_HtmlEncode($student_applicant->app_mother_name->AdvancedSearch->SearchValue);

			// app_mother_isalive
			$student_applicant->app_mother_isalive->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Alive");
			$arwrk[] = array("0", "Deceased");
			$student_applicant->app_mother_isalive->EditValue = $arwrk;

			// app_mother_occupation
			$student_applicant->app_mother_occupation->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `application_occupation_id`, `name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `application_occupation`";
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
			$student_applicant->app_mother_occupation->EditValue = $arwrk;

			// app_father_name
			$student_applicant->app_father_name->EditCustomAttributes = "";
			$student_applicant->app_father_name->EditValue = ew_HtmlEncode($student_applicant->app_father_name->AdvancedSearch->SearchValue);

			// app_father_occupation
			$student_applicant->app_father_occupation->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `application_occupation_id`, `name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `application_occupation`";
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
			$student_applicant->app_father_occupation->EditValue = $arwrk;

			// app_father_isalive
			$student_applicant->app_father_isalive->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Alive");
			$arwrk[] = array("0", "Deceased");
			$student_applicant->app_father_isalive->EditValue = $arwrk;

			// student_picture
			$student_applicant->student_picture->EditCustomAttributes = "";
			if (!ew_Empty($student_applicant->student_picture->Upload->DbValue)) {
				$student_applicant->student_picture->EditValue = $student_applicant->student_picture->Upload->DbValue;
			} else {
				$student_applicant->student_picture->EditValue = "";
			}

			// app_guardian_name
			$student_applicant->app_guardian_name->EditCustomAttributes = "";
			$student_applicant->app_guardian_name->EditValue = ew_HtmlEncode($student_applicant->app_guardian_name->AdvancedSearch->SearchValue);

			// app_guardian_relation
			$student_applicant->app_guardian_relation->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("NA", "not applicable");
			$arwrk[] = array("grandparent", "grandparent");
			$arwrk[] = array("grandparent", "grandparent");
			$arwrk[] = array("aunt", "aunt");
			$arwrk[] = array("sibling", "sibling");
			$arwrk[] = array("cousin", "cousin");
			$arwrk[] = array("in law", "in law");
			$arwrk[] = array("father family", "father family");
			$arwrk[] = array("mother family", "mother family");
			$arwrk[] = array("extended family", "extended family");
			$arwrk[] = array("other relation", "other relation");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$student_applicant->app_guardian_relation->EditValue = $arwrk;

			// app_guardian_occupation
			$student_applicant->app_guardian_occupation->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `application_occupation_id`, `name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `application_occupation`";
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
			$student_applicant->app_guardian_occupation->EditValue = $arwrk;

			// sponsored_child_no
			$student_applicant->sponsored_child_no->EditCustomAttributes = "";
			$student_applicant->sponsored_child_no->EditValue = ew_HtmlEncode($student_applicant->sponsored_child_no->AdvancedSearch->SearchValue);

			// student_grades
			$student_applicant->student_grades->EditCustomAttributes = "";
			$student_applicant->student_grades->EditValue = ew_HtmlEncode($student_applicant->student_grades->AdvancedSearch->SearchValue);

			// student_address
			$student_applicant->student_address->EditCustomAttributes = "";
			$student_applicant->student_address->EditValue = ew_HtmlEncode($student_applicant->student_address->AdvancedSearch->SearchValue);

			// student_admitted_school_id
			$student_applicant->student_admitted_school_id->EditCustomAttributes = "";
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
			$student_applicant->student_admitted_school_id->EditValue = $arwrk;

			// app_primary_school_id
			$student_applicant->app_primary_school_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `applicant_school_id`, `applicant_school_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `applicant_school`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`applicant_school_type`=1" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$student_applicant->app_primary_school_id->EditValue = $arwrk;

			// app_junior_secondary_id
			$student_applicant->app_junior_secondary_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `applicant_school_id`, `applicant_school_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `applicant_school`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`applicant_school_type`=2" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$student_applicant->app_junior_secondary_id->EditValue = $arwrk;
		}

		// Call Row Rendered event
		if ($student_applicant->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$student_applicant->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $student_applicant;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($student_applicant->student_applicant_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $student_applicant->student_applicant_id->FldErrMsg();
		}
		if (!ew_CheckInteger($student_applicant->app_submission_year->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $student_applicant->app_submission_year->FldErrMsg();
		}
		if (!ew_CheckInteger($student_applicant->app_status->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $student_applicant->app_status->FldErrMsg();
		}
		if (!ew_CheckInteger($student_applicant->app_points->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $student_applicant->app_points->FldErrMsg();
		}
		if (!ew_CheckInteger($student_applicant->app_grant_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $student_applicant->app_grant_id->FldErrMsg();
		}
		if (!ew_CheckEuroDate($student_applicant->student_dob->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $student_applicant->student_dob->FldErrMsg();
		}
		if (!ew_CheckEuroDate($student_applicant->student_dob->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $student_applicant->student_dob->FldErrMsg();
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
		global $student_applicant;
		$student_applicant->student_applicant_id->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_applicant_id");
		$student_applicant->app_submission_year->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_submission_year");
		$student_applicant->student_resident_programarea_id->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_resident_programarea_id");
		$student_applicant->community_community_id->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_community_community_id");
		$student_applicant->app_status->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_status");
		$student_applicant->app_points->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_points");
		$student_applicant->app_grant_id->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_grant_id");
		$student_applicant->student_firstname->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_firstname");
		$student_applicant->student_middlename->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_middlename");
		$student_applicant->student_lastname->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_lastname");
		$student_applicant->student_gender->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_gender");
		$student_applicant->student_dob->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_dob");
		$student_applicant->student_dob->AdvancedSearch->SearchValue2 = $student_applicant->getAdvancedSearch("y_student_dob");
		$student_applicant->app_mother_name->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_mother_name");
		$student_applicant->app_mother_isalive->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_mother_isalive");
		$student_applicant->app_mother_occupation->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_mother_occupation");
		$student_applicant->app_father_name->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_father_name");
		$student_applicant->app_father_occupation->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_father_occupation");
		$student_applicant->app_father_isalive->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_father_isalive");
		$student_applicant->app_guardian_name->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_guardian_name");
		$student_applicant->app_guardian_relation->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_guardian_relation");
		$student_applicant->app_guardian_occupation->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_guardian_occupation");
		$student_applicant->sponsored_child_no->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_sponsored_child_no");
		$student_applicant->student_grades->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_grades");
		$student_applicant->student_address->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_address");
		$student_applicant->student_admitted_school_id->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_admitted_school_id");
		$student_applicant->app_primary_school_id->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_primary_school_id");
		$student_applicant->app_junior_secondary_id->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_junior_secondary_id");
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
