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
$sponsored_student_detail_list = new csponsored_student_detail_list();
$Page =& $sponsored_student_detail_list;

// Page init
$sponsored_student_detail_list->Page_Init();

// Page main
$sponsored_student_detail_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($sponsored_student_detail->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var sponsored_student_detail_list = new ew_Page("sponsored_student_detail_list");

// page properties
sponsored_student_detail_list.PageID = "list"; // page ID
sponsored_student_detail_list.FormID = "fsponsored_student_detaillist"; // form ID
var EW_PAGE_ID = sponsored_student_detail_list.PageID; // for backward compatibility

// extend page with validate function for search
sponsored_student_detail_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";

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
sponsored_student_detail_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
sponsored_student_detail_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
sponsored_student_detail_list.ValidateRequired = false; // no JavaScript validation
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
<?php } ?>
<?php if ($sponsored_student_detail->Export == "") { ?>
<?php
$gsMasterReturnUrl = "programarealist.php";
if ($sponsored_student_detail_list->sDbMasterFilter <> "" && $sponsored_student_detail->getCurrentMasterTable() == "programarea") {
	if ($sponsored_student_detail_list->bMasterRecordExists) {
		if ($sponsored_student_detail->getCurrentMasterTable() == $sponsored_student_detail->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "programareamaster.php" ?>
<?php
	}
}
?>
<?php
$gsMasterReturnUrl = "communitylist.php";
if ($sponsored_student_detail_list->sDbMasterFilter <> "" && $sponsored_student_detail->getCurrentMasterTable() == "community") {
	if ($sponsored_student_detail_list->bMasterRecordExists) {
		if ($sponsored_student_detail->getCurrentMasterTable() == $sponsored_student_detail->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "communitymaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$sponsored_student_detail_list->lTotalRecs = $sponsored_student_detail->SelectRecordCount();
	} else {
		if ($rs = $sponsored_student_detail_list->LoadRecordset())
			$sponsored_student_detail_list->lTotalRecs = $rs->RecordCount();
	}
	$sponsored_student_detail_list->lStartRec = 1;
	if ($sponsored_student_detail_list->lDisplayRecs <= 0 || ($sponsored_student_detail->Export <> "" && $sponsored_student_detail->ExportAll)) // Display all records
		$sponsored_student_detail_list->lDisplayRecs = $sponsored_student_detail_list->lTotalRecs;
	if (!($sponsored_student_detail->Export <> "" && $sponsored_student_detail->ExportAll))
		$sponsored_student_detail_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $sponsored_student_detail_list->LoadRecordset($sponsored_student_detail_list->lStartRec-1, $sponsored_student_detail_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $sponsored_student_detail->TableCaption() ?>
<?php if ($sponsored_student_detail->Export == "" && $sponsored_student_detail->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $sponsored_student_detail_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $sponsored_student_detail_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $sponsored_student_detail_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($sponsored_student_detail->Export == "" && $sponsored_student_detail->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(sponsored_student_detail_list);" style="text-decoration: none;"><img id="sponsored_student_detail_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="sponsored_student_detail_list_SearchPanel">
<form name="fsponsored_student_detaillistsrch" id="fsponsored_student_detaillistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return sponsored_student_detail_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="sponsored_student_detail">
<?php
if ($gsSearchError == "")
	$sponsored_student_detail_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$sponsored_student_detail->RowType = EW_ROWTYPE_SEARCH;

// Render row
$sponsored_student_detail_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker"><?php echo $sponsored_student_detail->app_submission_year->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_app_submission_year" id="z_app_submission_year" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $sponsored_student_detail->student_resident_programarea_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_student_resident_programarea_id" id="z_student_resident_programarea_id" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if ($sponsored_student_detail->student_resident_programarea_id->getSessionValue() <> "") { ?>
<div<?php echo $sponsored_student_detail->student_resident_programarea_id->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_resident_programarea_id->ListViewValue() ?></div>
<input type="hidden" id="x_student_resident_programarea_id" name="x_student_resident_programarea_id" value="<?php echo ew_HtmlEncode($sponsored_student_detail->student_resident_programarea_id->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
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
<?php } ?>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $sponsored_student_detail->District->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_District" id="z_District" value="LIKE"></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_District" id="x_District" title="<?php echo $sponsored_student_detail->District->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $sponsored_student_detail->District->EditValue ?>"<?php echo $sponsored_student_detail->District->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($sponsored_student_detail->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $sponsored_student_detail_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="sponsored_student_detailsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($sponsored_student_detail->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($sponsored_student_detail->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($sponsored_student_detail->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$sponsored_student_detail_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fsponsored_student_detaillist" id="fsponsored_student_detaillist" class="ewForm" action="" method="post">
<div id="gmp_sponsored_student_detail" class="ewGridMiddlePanel">
<?php if ($sponsored_student_detail_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $sponsored_student_detail->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$sponsored_student_detail_list->RenderListOptions();

// Render list options (header, left)
$sponsored_student_detail_list->ListOptions->Render("header", "left");
?>
<?php if ($sponsored_student_detail->student_firstname->Visible) { // student_firstname ?>
	<?php if ($sponsored_student_detail->SortUrl($sponsored_student_detail->student_firstname) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student_detail->student_firstname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student_detail->SortUrl($sponsored_student_detail->student_firstname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student_detail->student_firstname->FldCaption() ?></td><td style="width: 10px;"><?php if ($sponsored_student_detail->student_firstname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student_detail->student_firstname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student_detail->student_middlename->Visible) { // student_middlename ?>
	<?php if ($sponsored_student_detail->SortUrl($sponsored_student_detail->student_middlename) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student_detail->student_middlename->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student_detail->SortUrl($sponsored_student_detail->student_middlename) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student_detail->student_middlename->FldCaption() ?></td><td style="width: 10px;"><?php if ($sponsored_student_detail->student_middlename->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student_detail->student_middlename->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student_detail->student_lastname->Visible) { // student_lastname ?>
	<?php if ($sponsored_student_detail->SortUrl($sponsored_student_detail->student_lastname) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student_detail->student_lastname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student_detail->SortUrl($sponsored_student_detail->student_lastname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student_detail->student_lastname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($sponsored_student_detail->student_lastname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student_detail->student_lastname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student_detail->student_telephone_1->Visible) { // student_telephone_1 ?>
	<?php if ($sponsored_student_detail->SortUrl($sponsored_student_detail->student_telephone_1) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student_detail->student_telephone_1->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student_detail->SortUrl($sponsored_student_detail->student_telephone_1) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student_detail->student_telephone_1->FldCaption() ?></td><td style="width: 10px;"><?php if ($sponsored_student_detail->student_telephone_1->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student_detail->student_telephone_1->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student_detail->student_telephone_2->Visible) { // student_telephone_2 ?>
	<?php if ($sponsored_student_detail->SortUrl($sponsored_student_detail->student_telephone_2) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student_detail->student_telephone_2->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student_detail->SortUrl($sponsored_student_detail->student_telephone_2) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student_detail->student_telephone_2->FldCaption() ?></td><td style="width: 10px;"><?php if ($sponsored_student_detail->student_telephone_2->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student_detail->student_telephone_2->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student_detail->student_dob->Visible) { // student_dob ?>
	<?php if ($sponsored_student_detail->SortUrl($sponsored_student_detail->student_dob) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student_detail->student_dob->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student_detail->SortUrl($sponsored_student_detail->student_dob) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student_detail->student_dob->FldCaption() ?></td><td style="width: 10px;"><?php if ($sponsored_student_detail->student_dob->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student_detail->student_dob->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student_detail->age->Visible) { // age ?>
	<?php if ($sponsored_student_detail->SortUrl($sponsored_student_detail->age) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student_detail->age->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student_detail->SortUrl($sponsored_student_detail->age) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student_detail->age->FldCaption() ?></td><td style="width: 10px;"><?php if ($sponsored_student_detail->age->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student_detail->age->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student_detail->student_gender->Visible) { // student_gender ?>
	<?php if ($sponsored_student_detail->SortUrl($sponsored_student_detail->student_gender) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student_detail->student_gender->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student_detail->SortUrl($sponsored_student_detail->student_gender) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student_detail->student_gender->FldCaption() ?></td><td style="width: 10px;"><?php if ($sponsored_student_detail->student_gender->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student_detail->student_gender->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student_detail->student_address->Visible) { // student_address ?>
	<?php if ($sponsored_student_detail->SortUrl($sponsored_student_detail->student_address) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student_detail->student_address->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student_detail->SortUrl($sponsored_student_detail->student_address) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student_detail->student_address->FldCaption() ?></td><td style="width: 10px;"><?php if ($sponsored_student_detail->student_address->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student_detail->student_address->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student_detail->app_submission_year->Visible) { // app_submission_year ?>
	<?php if ($sponsored_student_detail->SortUrl($sponsored_student_detail->app_submission_year) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student_detail->app_submission_year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student_detail->SortUrl($sponsored_student_detail->app_submission_year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student_detail->app_submission_year->FldCaption() ?></td><td style="width: 10px;"><?php if ($sponsored_student_detail->app_submission_year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student_detail->app_submission_year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student_detail->community->Visible) { // community ?>
	<?php if ($sponsored_student_detail->SortUrl($sponsored_student_detail->community) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student_detail->community->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student_detail->SortUrl($sponsored_student_detail->community) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student_detail->community->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($sponsored_student_detail->community->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student_detail->community->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student_detail->student_resident_programarea_id->Visible) { // student_resident_programarea_id ?>
	<?php if ($sponsored_student_detail->SortUrl($sponsored_student_detail->student_resident_programarea_id) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student_detail->student_resident_programarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student_detail->SortUrl($sponsored_student_detail->student_resident_programarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student_detail->student_resident_programarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($sponsored_student_detail->student_resident_programarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student_detail->student_resident_programarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student_detail->District->Visible) { // District ?>
	<?php if ($sponsored_student_detail->SortUrl($sponsored_student_detail->District) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student_detail->District->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student_detail->SortUrl($sponsored_student_detail->District) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student_detail->District->FldCaption() ?></td><td style="width: 10px;"><?php if ($sponsored_student_detail->District->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student_detail->District->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$sponsored_student_detail_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($sponsored_student_detail->ExportAll && $sponsored_student_detail->Export <> "") {
	$sponsored_student_detail_list->lStopRec = $sponsored_student_detail_list->lTotalRecs;
} else {
	$sponsored_student_detail_list->lStopRec = $sponsored_student_detail_list->lStartRec + $sponsored_student_detail_list->lDisplayRecs - 1; // Set the last record to display
}
$sponsored_student_detail_list->lRecCount = $sponsored_student_detail_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $sponsored_student_detail_list->lStartRec > 1)
		$rs->Move($sponsored_student_detail_list->lStartRec - 1);
}

// Initialize aggregate
$sponsored_student_detail->RowType = EW_ROWTYPE_AGGREGATEINIT;
$sponsored_student_detail_list->RenderRow();
$sponsored_student_detail_list->lRowCnt = 0;
while (($sponsored_student_detail->CurrentAction == "gridadd" || !$rs->EOF) &&
	$sponsored_student_detail_list->lRecCount < $sponsored_student_detail_list->lStopRec) {
	$sponsored_student_detail_list->lRecCount++;
	if (intval($sponsored_student_detail_list->lRecCount) >= intval($sponsored_student_detail_list->lStartRec)) {
		$sponsored_student_detail_list->lRowCnt++;

	// Init row class and style
	$sponsored_student_detail->CssClass = "";
	$sponsored_student_detail->CssStyle = "";
	$sponsored_student_detail->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($sponsored_student_detail->CurrentAction == "gridadd") {
		$sponsored_student_detail_list->LoadDefaultValues(); // Load default values
	} else {
		$sponsored_student_detail_list->LoadRowValues($rs); // Load row values
	}
	$sponsored_student_detail->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$sponsored_student_detail_list->RenderRow();

	// Render list options
	$sponsored_student_detail_list->RenderListOptions();
?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$sponsored_student_detail_list->ListOptions->Render("body", "left");
?>
	<?php if ($sponsored_student_detail->student_firstname->Visible) { // student_firstname ?>
		<td<?php echo $sponsored_student_detail->student_firstname->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_firstname->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_firstname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student_detail->student_middlename->Visible) { // student_middlename ?>
		<td<?php echo $sponsored_student_detail->student_middlename->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_middlename->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_middlename->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student_detail->student_lastname->Visible) { // student_lastname ?>
		<td<?php echo $sponsored_student_detail->student_lastname->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_lastname->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_lastname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student_detail->student_telephone_1->Visible) { // student_telephone_1 ?>
		<td<?php echo $sponsored_student_detail->student_telephone_1->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_telephone_1->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_telephone_1->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student_detail->student_telephone_2->Visible) { // student_telephone_2 ?>
		<td<?php echo $sponsored_student_detail->student_telephone_2->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_telephone_2->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_telephone_2->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student_detail->student_dob->Visible) { // student_dob ?>
		<td<?php echo $sponsored_student_detail->student_dob->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_dob->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_dob->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student_detail->age->Visible) { // age ?>
		<td<?php echo $sponsored_student_detail->age->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->age->ViewAttributes() ?>><?php echo $sponsored_student_detail->age->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student_detail->student_gender->Visible) { // student_gender ?>
		<td<?php echo $sponsored_student_detail->student_gender->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_gender->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_gender->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student_detail->student_address->Visible) { // student_address ?>
		<td<?php echo $sponsored_student_detail->student_address->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_address->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_address->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student_detail->app_submission_year->Visible) { // app_submission_year ?>
		<td<?php echo $sponsored_student_detail->app_submission_year->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->app_submission_year->ViewAttributes() ?>><?php echo $sponsored_student_detail->app_submission_year->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student_detail->community->Visible) { // community ?>
		<td<?php echo $sponsored_student_detail->community->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->community->ViewAttributes() ?>><?php echo $sponsored_student_detail->community->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student_detail->student_resident_programarea_id->Visible) { // student_resident_programarea_id ?>
		<td<?php echo $sponsored_student_detail->student_resident_programarea_id->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_resident_programarea_id->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_resident_programarea_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student_detail->District->Visible) { // District ?>
		<td<?php echo $sponsored_student_detail->District->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->District->ViewAttributes() ?>><?php echo $sponsored_student_detail->District->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$sponsored_student_detail_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($sponsored_student_detail->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($sponsored_student_detail->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($sponsored_student_detail->CurrentAction <> "gridadd" && $sponsored_student_detail->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($sponsored_student_detail_list->Pager)) $sponsored_student_detail_list->Pager = new cPrevNextPager($sponsored_student_detail_list->lStartRec, $sponsored_student_detail_list->lDisplayRecs, $sponsored_student_detail_list->lTotalRecs) ?>
<?php if ($sponsored_student_detail_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($sponsored_student_detail_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $sponsored_student_detail_list->PageUrl() ?>start=<?php echo $sponsored_student_detail_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($sponsored_student_detail_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $sponsored_student_detail_list->PageUrl() ?>start=<?php echo $sponsored_student_detail_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $sponsored_student_detail_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($sponsored_student_detail_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $sponsored_student_detail_list->PageUrl() ?>start=<?php echo $sponsored_student_detail_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($sponsored_student_detail_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $sponsored_student_detail_list->PageUrl() ?>start=<?php echo $sponsored_student_detail_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $sponsored_student_detail_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $sponsored_student_detail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $sponsored_student_detail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $sponsored_student_detail_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($sponsored_student_detail_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($sponsored_student_detail_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($sponsored_student_detail->Export == "" && $sponsored_student_detail->CurrentAction == "") { ?>
<?php } ?>
<?php if ($sponsored_student_detail->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$sponsored_student_detail_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csponsored_student_detail_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'sponsored_student_detail';

	// Page object name
	var $PageObjName = 'sponsored_student_detail_list';

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
	function csponsored_student_detail_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (sponsored_student_detail)
		$GLOBALS["sponsored_student_detail"] = new csponsored_student_detail();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["sponsored_student_detail"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "sponsored_student_detaildelete.php";
		$this->MultiUpdateUrl = "sponsored_student_detailupdate.php";

		// Table object (programarea)
		$GLOBALS['programarea'] = new cprogramarea();

		// Table object (community)
		$GLOBALS['community'] = new ccommunity();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'sponsored_student_detail', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$sponsored_student_detail->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$sponsored_student_detail->Export = $_POST["exporttype"];
		} else {
			$sponsored_student_detail->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $sponsored_student_detail->Export; // Get export parameter, used in header
		$gsExportFile = $sponsored_student_detail->TableVar; // Get export file, used in header
		if ($sponsored_student_detail->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($sponsored_student_detail->Export == "csv") {
			header('Content-Type: application/csv');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
		}

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

	// Class variables
	var $ListOptions; // List options
	var $lDisplayRecs = 20;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $sSrchWhere = ""; // Search WHERE clause
	var $lRecCnt = 0; // Record count
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex; // Row index
	var $lRecPerRow = 0;
	var $lColCnt = 0;
	var $sDbMasterFilter = ""; // Master filter
	var $sDbDetailFilter = ""; // Detail filter
	var $bMasterRecordExists;	
	var $sMultiSelectKey;
	var $RestoreSearch;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $sponsored_student_detail;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterDetail();

			// Set up list options
			$this->SetupListOptions();

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$sponsored_student_detail->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($sponsored_student_detail->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $sponsored_student_detail->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$sponsored_student_detail->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$sponsored_student_detail->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$sponsored_student_detail->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $sponsored_student_detail->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $sponsored_student_detail->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $sponsored_student_detail->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($sponsored_student_detail->getMasterFilter() <> "" && $sponsored_student_detail->getCurrentMasterTable() == "programarea") {
			global $programarea;
			$rsmaster = $programarea->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$sponsored_student_detail->setMasterFilter(""); // Clear master filter
				$sponsored_student_detail->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($sponsored_student_detail->getReturnUrl()); // Return to caller
			} else {
				$programarea->LoadListRowValues($rsmaster);
				$programarea->RowType = EW_ROWTYPE_MASTER; // Master row
				$programarea->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Load master record
		if ($sponsored_student_detail->getMasterFilter() <> "" && $sponsored_student_detail->getCurrentMasterTable() == "community") {
			global $community;
			$rsmaster = $community->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$sponsored_student_detail->setMasterFilter(""); // Clear master filter
				$sponsored_student_detail->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($sponsored_student_detail->getReturnUrl()); // Return to caller
			} else {
				$community->LoadListRowValues($rsmaster);
				$community->RowType = EW_ROWTYPE_MASTER; // Master row
				$community->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$sponsored_student_detail->setSessionWhere($sFilter);
		$sponsored_student_detail->CurrentFilter = "";

		// Export data only
		if (in_array($sponsored_student_detail->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($sponsored_student_detail->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $sponsored_student_detail;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $sponsored_student_detail->sponsored_student_id, FALSE); // sponsored_student_id
		$this->BuildSearchSql($sWhere, $sponsored_student_detail->student_firstname, FALSE); // student_firstname
		$this->BuildSearchSql($sWhere, $sponsored_student_detail->student_middlename, FALSE); // student_middlename
		$this->BuildSearchSql($sWhere, $sponsored_student_detail->student_lastname, FALSE); // student_lastname
		$this->BuildSearchSql($sWhere, $sponsored_student_detail->student_dob, FALSE); // student_dob
		$this->BuildSearchSql($sWhere, $sponsored_student_detail->age, FALSE); // age
		$this->BuildSearchSql($sWhere, $sponsored_student_detail->student_gender, FALSE); // student_gender
		$this->BuildSearchSql($sWhere, $sponsored_student_detail->student_address, FALSE); // student_address
		$this->BuildSearchSql($sWhere, $sponsored_student_detail->app_submission_year, FALSE); // app_submission_year
		$this->BuildSearchSql($sWhere, $sponsored_student_detail->community, FALSE); // community
		$this->BuildSearchSql($sWhere, $sponsored_student_detail->programarea_name, FALSE); // programarea_name
		$this->BuildSearchSql($sWhere, $sponsored_student_detail->student_resident_programarea_id, FALSE); // student_resident_programarea_id
		$this->BuildSearchSql($sWhere, $sponsored_student_detail->District, FALSE); // District
		$this->BuildSearchSql($sWhere, $sponsored_student_detail->community_districts_DistrictID, FALSE); // community_districts_DistrictID

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($sponsored_student_detail->sponsored_student_id); // sponsored_student_id
			$this->SetSearchParm($sponsored_student_detail->student_firstname); // student_firstname
			$this->SetSearchParm($sponsored_student_detail->student_middlename); // student_middlename
			$this->SetSearchParm($sponsored_student_detail->student_lastname); // student_lastname
			$this->SetSearchParm($sponsored_student_detail->student_dob); // student_dob
			$this->SetSearchParm($sponsored_student_detail->age); // age
			$this->SetSearchParm($sponsored_student_detail->student_gender); // student_gender
			$this->SetSearchParm($sponsored_student_detail->student_address); // student_address
			$this->SetSearchParm($sponsored_student_detail->app_submission_year); // app_submission_year
			$this->SetSearchParm($sponsored_student_detail->community); // community
			$this->SetSearchParm($sponsored_student_detail->programarea_name); // programarea_name
			$this->SetSearchParm($sponsored_student_detail->student_resident_programarea_id); // student_resident_programarea_id
			$this->SetSearchParm($sponsored_student_detail->District); // District
			$this->SetSearchParm($sponsored_student_detail->community_districts_DistrictID); // community_districts_DistrictID
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);		
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";

		//$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);

		//$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		if ($sWrk <> "") {
			if ($Where <> "") $Where .= " AND ";
			$Where .= "(" . $sWrk . ")";
		}
	}

	// Set search parameters
	function SetSearchParm(&$Fld) {
		global $sponsored_student_detail;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$sponsored_student_detail->setAdvancedSearch("x_$FldParm", $FldVal);
		$sponsored_student_detail->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$sponsored_student_detail->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$sponsored_student_detail->setAdvancedSearch("y_$FldParm", $FldVal2);
		$sponsored_student_detail->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $sponsored_student_detail;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $sponsored_student_detail->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $sponsored_student_detail->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $sponsored_student_detail->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $sponsored_student_detail->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $sponsored_student_detail->GetAdvancedSearch("w_$FldParm");
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $sponsored_student_detail;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $sponsored_student_detail->student_lastname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $sponsored_student_detail->community, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $sponsored_student_detail->programarea_name, $Keyword);
		if (is_numeric($Keyword)) $this->BuildBasicSearchSQL($sWhere, $sponsored_student_detail->student_resident_programarea_id, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . " LIKE " . ew_QuotedValue("%" . $Keyword . "%", $lFldDataType);
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $sponsored_student_detail;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $sponsored_student_detail->BasicSearchKeyword;
		$sSearchType = $sponsored_student_detail->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$sponsored_student_detail->setSessionBasicSearchKeyword($sSearchKeyword);
			$sponsored_student_detail->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $sponsored_student_detail;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$sponsored_student_detail->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $sponsored_student_detail;
		$sponsored_student_detail->setSessionBasicSearchKeyword("");
		$sponsored_student_detail->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $sponsored_student_detail;
		$sponsored_student_detail->setAdvancedSearch("x_sponsored_student_id", "");
		$sponsored_student_detail->setAdvancedSearch("x_student_firstname", "");
		$sponsored_student_detail->setAdvancedSearch("z_student_firstname", "");
		$sponsored_student_detail->setAdvancedSearch("y_student_firstname", "");
		$sponsored_student_detail->setAdvancedSearch("x_student_middlename", "");
		$sponsored_student_detail->setAdvancedSearch("z_student_middlename", "");
		$sponsored_student_detail->setAdvancedSearch("y_student_middlename", "");
		$sponsored_student_detail->setAdvancedSearch("x_student_lastname", "");
		$sponsored_student_detail->setAdvancedSearch("z_student_lastname", "");
		$sponsored_student_detail->setAdvancedSearch("y_student_lastname", "");
		$sponsored_student_detail->setAdvancedSearch("x_student_dob", "");
		$sponsored_student_detail->setAdvancedSearch("y_student_dob", "");
		$sponsored_student_detail->setAdvancedSearch("x_age", "");
		$sponsored_student_detail->setAdvancedSearch("x_student_gender", "");
		$sponsored_student_detail->setAdvancedSearch("x_student_address", "");
		$sponsored_student_detail->setAdvancedSearch("x_app_submission_year", "");
		$sponsored_student_detail->setAdvancedSearch("x_community", "");
		$sponsored_student_detail->setAdvancedSearch("x_programarea_name", "");
		$sponsored_student_detail->setAdvancedSearch("x_student_resident_programarea_id", "");
		$sponsored_student_detail->setAdvancedSearch("x_District", "");
		$sponsored_student_detail->setAdvancedSearch("x_community_districts_DistrictID", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $sponsored_student_detail;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_sponsored_student_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_firstname"] <> "") $bRestore = FALSE;
		if (@$_GET["y_student_firstname"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_middlename"] <> "") $bRestore = FALSE;
		if (@$_GET["y_student_middlename"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_lastname"] <> "") $bRestore = FALSE;
		if (@$_GET["y_student_lastname"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_dob"] <> "") $bRestore = FALSE;
		if (@$_GET["y_student_dob"] <> "") $bRestore = FALSE;
		if (@$_GET["x_age"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_gender"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_address"] <> "") $bRestore = FALSE;
		if (@$_GET["x_app_submission_year"] <> "") $bRestore = FALSE;
		if (@$_GET["x_community"] <> "") $bRestore = FALSE;
		if (@$_GET["x_programarea_name"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_resident_programarea_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_District"] <> "") $bRestore = FALSE;
		if (@$_GET["x_community_districts_DistrictID"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$sponsored_student_detail->BasicSearchKeyword = $sponsored_student_detail->getSessionBasicSearchKeyword();
			$sponsored_student_detail->BasicSearchType = $sponsored_student_detail->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($sponsored_student_detail->sponsored_student_id);
			$this->GetSearchParm($sponsored_student_detail->student_firstname);
			$this->GetSearchParm($sponsored_student_detail->student_middlename);
			$this->GetSearchParm($sponsored_student_detail->student_lastname);
			$this->GetSearchParm($sponsored_student_detail->student_dob);
			$this->GetSearchParm($sponsored_student_detail->age);
			$this->GetSearchParm($sponsored_student_detail->student_gender);
			$this->GetSearchParm($sponsored_student_detail->student_address);
			$this->GetSearchParm($sponsored_student_detail->app_submission_year);
			$this->GetSearchParm($sponsored_student_detail->community);
			$this->GetSearchParm($sponsored_student_detail->programarea_name);
			$this->GetSearchParm($sponsored_student_detail->student_resident_programarea_id);
			$this->GetSearchParm($sponsored_student_detail->District);
			$this->GetSearchParm($sponsored_student_detail->community_districts_DistrictID);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $sponsored_student_detail;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$sponsored_student_detail->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$sponsored_student_detail->CurrentOrderType = @$_GET["ordertype"];
			$sponsored_student_detail->UpdateSort($sponsored_student_detail->student_firstname); // student_firstname
			$sponsored_student_detail->UpdateSort($sponsored_student_detail->student_middlename); // student_middlename
			$sponsored_student_detail->UpdateSort($sponsored_student_detail->student_lastname); // student_lastname
			$sponsored_student_detail->UpdateSort($sponsored_student_detail->student_telephone_1); // student_telephone_1
			$sponsored_student_detail->UpdateSort($sponsored_student_detail->student_telephone_2); // student_telephone_2
			$sponsored_student_detail->UpdateSort($sponsored_student_detail->student_dob); // student_dob
			$sponsored_student_detail->UpdateSort($sponsored_student_detail->age); // age
			$sponsored_student_detail->UpdateSort($sponsored_student_detail->student_gender); // student_gender
			$sponsored_student_detail->UpdateSort($sponsored_student_detail->student_address); // student_address
			$sponsored_student_detail->UpdateSort($sponsored_student_detail->app_submission_year); // app_submission_year
			$sponsored_student_detail->UpdateSort($sponsored_student_detail->community); // community
			$sponsored_student_detail->UpdateSort($sponsored_student_detail->student_resident_programarea_id); // student_resident_programarea_id
			$sponsored_student_detail->UpdateSort($sponsored_student_detail->District); // District
			$sponsored_student_detail->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $sponsored_student_detail;
		$sOrderBy = $sponsored_student_detail->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($sponsored_student_detail->SqlOrderBy() <> "") {
				$sOrderBy = $sponsored_student_detail->SqlOrderBy();
				$sponsored_student_detail->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $sponsored_student_detail;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$sponsored_student_detail->getCurrentMasterTable = ""; // Clear master table
				$sponsored_student_detail->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$sponsored_student_detail->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$sponsored_student_detail->student_resident_programarea_id->setSessionValue("");
				$sponsored_student_detail->community_community_id->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$sponsored_student_detail->setSessionOrderBy($sOrderBy);
				$sponsored_student_detail->student_firstname->setSort("");
				$sponsored_student_detail->student_middlename->setSort("");
				$sponsored_student_detail->student_lastname->setSort("");
				$sponsored_student_detail->student_telephone_1->setSort("");
				$sponsored_student_detail->student_telephone_2->setSort("");
				$sponsored_student_detail->student_dob->setSort("");
				$sponsored_student_detail->age->setSort("");
				$sponsored_student_detail->student_gender->setSort("");
				$sponsored_student_detail->student_address->setSort("");
				$sponsored_student_detail->app_submission_year->setSort("");
				$sponsored_student_detail->community->setSort("");
				$sponsored_student_detail->student_resident_programarea_id->setSort("");
				$sponsored_student_detail->District->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$sponsored_student_detail->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $sponsored_student_detail;

		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = FALSE;

		// "detail_scholarship_package"
		$this->ListOptions->Add("detail_scholarship_package");
		$item =& $this->ListOptions->Items["detail_scholarship_package"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('scholarship_package');
		$item->OnLeft = FALSE;

		// "detail_school_attendance"
		$this->ListOptions->Add("detail_school_attendance");
		$item =& $this->ListOptions->Items["detail_school_attendance"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('school_attendance');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($sponsored_student_detail->Export <> "" ||
			$sponsored_student_detail->CurrentAction == "gridadd" ||
			$sponsored_student_detail->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $sponsored_student_detail;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . "<img src=\"images/view.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";

		// "detail_scholarship_package"
		$oListOpt =& $this->ListOptions->Items["detail_scholarship_package"];
		if ($Security->AllowList('scholarship_package')) {
			$oListOpt->Body = "<img src=\"images/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("scholarship_package", "TblCaption");
			$oListOpt->Body = "<a href=\"scholarship_packagelist.php?" . EW_TABLE_SHOW_MASTER . "=sponsored_student_detail&sponsored_student_id=" . urlencode(strval($sponsored_student_detail->sponsored_student_id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_school_attendance"
		$oListOpt =& $this->ListOptions->Items["detail_school_attendance"];
		if ($Security->AllowList('school_attendance')) {
			$oListOpt->Body = "<img src=\"images/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("school_attendance", "TblCaption");
			$oListOpt->Body = "<a href=\"school_attendancelist.php?" . EW_TABLE_SHOW_MASTER . "=sponsored_student_detail&sponsored_student_id=" . urlencode(strval($sponsored_student_detail->sponsored_student_id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $sponsored_student_detail;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $sponsored_student_detail;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$sponsored_student_detail->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$sponsored_student_detail->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $sponsored_student_detail->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$sponsored_student_detail->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$sponsored_student_detail->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$sponsored_student_detail->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $sponsored_student_detail;
		$sponsored_student_detail->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$sponsored_student_detail->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $sponsored_student_detail;

		// Load search values
		// sponsored_student_id

		$sponsored_student_detail->sponsored_student_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_sponsored_student_id"]);
		$sponsored_student_detail->sponsored_student_id->AdvancedSearch->SearchOperator = @$_GET["z_sponsored_student_id"];

		// student_firstname
		$sponsored_student_detail->student_firstname->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_firstname"]);
		$sponsored_student_detail->student_firstname->AdvancedSearch->SearchOperator = @$_GET["z_student_firstname"];
		$sponsored_student_detail->student_firstname->AdvancedSearch->SearchCondition = @$_GET["v_student_firstname"];
		$sponsored_student_detail->student_firstname->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_student_firstname"]);
		$sponsored_student_detail->student_firstname->AdvancedSearch->SearchOperator2 = @$_GET["w_student_firstname"];

		// student_middlename
		$sponsored_student_detail->student_middlename->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_middlename"]);
		$sponsored_student_detail->student_middlename->AdvancedSearch->SearchOperator = @$_GET["z_student_middlename"];
		$sponsored_student_detail->student_middlename->AdvancedSearch->SearchCondition = @$_GET["v_student_middlename"];
		$sponsored_student_detail->student_middlename->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_student_middlename"]);
		$sponsored_student_detail->student_middlename->AdvancedSearch->SearchOperator2 = @$_GET["w_student_middlename"];

		// student_lastname
		$sponsored_student_detail->student_lastname->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_lastname"]);
		$sponsored_student_detail->student_lastname->AdvancedSearch->SearchOperator = @$_GET["z_student_lastname"];
		$sponsored_student_detail->student_lastname->AdvancedSearch->SearchCondition = @$_GET["v_student_lastname"];
		$sponsored_student_detail->student_lastname->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_student_lastname"]);
		$sponsored_student_detail->student_lastname->AdvancedSearch->SearchOperator2 = @$_GET["w_student_lastname"];

		// student_dob
		$sponsored_student_detail->student_dob->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_dob"]);
		$sponsored_student_detail->student_dob->AdvancedSearch->SearchOperator = @$_GET["z_student_dob"];
		$sponsored_student_detail->student_dob->AdvancedSearch->SearchCondition = @$_GET["v_student_dob"];
		$sponsored_student_detail->student_dob->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_student_dob"]);
		$sponsored_student_detail->student_dob->AdvancedSearch->SearchOperator2 = @$_GET["w_student_dob"];

		// age
		$sponsored_student_detail->age->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_age"]);
		$sponsored_student_detail->age->AdvancedSearch->SearchOperator = @$_GET["z_age"];

		// student_gender
		$sponsored_student_detail->student_gender->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_gender"]);
		$sponsored_student_detail->student_gender->AdvancedSearch->SearchOperator = @$_GET["z_student_gender"];

		// student_address
		$sponsored_student_detail->student_address->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_address"]);
		$sponsored_student_detail->student_address->AdvancedSearch->SearchOperator = @$_GET["z_student_address"];

		// app_submission_year
		$sponsored_student_detail->app_submission_year->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_submission_year"]);
		$sponsored_student_detail->app_submission_year->AdvancedSearch->SearchOperator = @$_GET["z_app_submission_year"];

		// community
		$sponsored_student_detail->community->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_community"]);
		$sponsored_student_detail->community->AdvancedSearch->SearchOperator = @$_GET["z_community"];

		// programarea_name
		$sponsored_student_detail->programarea_name->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programarea_name"]);
		$sponsored_student_detail->programarea_name->AdvancedSearch->SearchOperator = @$_GET["z_programarea_name"];

		// student_resident_programarea_id
		$sponsored_student_detail->student_resident_programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_resident_programarea_id"]);
		$sponsored_student_detail->student_resident_programarea_id->AdvancedSearch->SearchOperator = @$_GET["z_student_resident_programarea_id"];

		// District
		$sponsored_student_detail->District->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_District"]);
		$sponsored_student_detail->District->AdvancedSearch->SearchOperator = @$_GET["z_District"];

		// community_districts_DistrictID
		$sponsored_student_detail->community_districts_DistrictID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_community_districts_DistrictID"]);
		$sponsored_student_detail->community_districts_DistrictID->AdvancedSearch->SearchOperator = @$_GET["z_community_districts_DistrictID"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $sponsored_student_detail;

		// Call Recordset Selecting event
		$sponsored_student_detail->Recordset_Selecting($sponsored_student_detail->CurrentFilter);

		// Load List page SQL
		$sSql = $sponsored_student_detail->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$sponsored_student_detail->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $sponsored_student_detail;
		$sFilter = $sponsored_student_detail->KeyFilter();

		// Call Row Selecting event
		$sponsored_student_detail->Row_Selecting($sFilter);

		// Load SQL based on filter
		$sponsored_student_detail->CurrentFilter = $sFilter;
		$sSql = $sponsored_student_detail->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$sponsored_student_detail->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $sponsored_student_detail;
		$sponsored_student_detail->sponsored_student_id->setDbValue($rs->fields('sponsored_student_id'));
		$sponsored_student_detail->student_firstname->setDbValue($rs->fields('student_firstname'));
		$sponsored_student_detail->student_middlename->setDbValue($rs->fields('student_middlename'));
		$sponsored_student_detail->student_lastname->setDbValue($rs->fields('student_lastname'));
		$sponsored_student_detail->student_telephone_1->setDbValue($rs->fields('student_telephone_1'));
		$sponsored_student_detail->student_telephone_2->setDbValue($rs->fields('student_telephone_2'));
		$sponsored_student_detail->student_dob->setDbValue($rs->fields('student_dob'));
		$sponsored_student_detail->age->setDbValue($rs->fields('age'));
		$sponsored_student_detail->student_gender->setDbValue($rs->fields('student_gender'));
		$sponsored_student_detail->student_address->setDbValue($rs->fields('student_address'));
		$sponsored_student_detail->app_submission_year->setDbValue($rs->fields('app_submission_year'));
		$sponsored_student_detail->community->setDbValue($rs->fields('community'));
		$sponsored_student_detail->community_community_id->setDbValue($rs->fields('community_community_id'));
		$sponsored_student_detail->programarea_name->setDbValue($rs->fields('programarea_name'));
		$sponsored_student_detail->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
		$sponsored_student_detail->District->setDbValue($rs->fields('District'));
		$sponsored_student_detail->community_districts_DistrictID->setDbValue($rs->fields('community_districts_DistrictID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $sponsored_student_detail;

		// Initialize URLs
		$this->ViewUrl = $sponsored_student_detail->ViewUrl();
		$this->EditUrl = $sponsored_student_detail->EditUrl();
		$this->InlineEditUrl = $sponsored_student_detail->InlineEditUrl();
		$this->CopyUrl = $sponsored_student_detail->CopyUrl();
		$this->InlineCopyUrl = $sponsored_student_detail->InlineCopyUrl();
		$this->DeleteUrl = $sponsored_student_detail->DeleteUrl();

		// Call Row_Rendering event
		$sponsored_student_detail->Row_Rendering();

		// Common render codes for all row types
		// student_firstname

		$sponsored_student_detail->student_firstname->CellCssStyle = "white-space: nowrap;"; $sponsored_student_detail->student_firstname->CellCssClass = "";
		$sponsored_student_detail->student_firstname->CellAttrs = array(); $sponsored_student_detail->student_firstname->ViewAttrs = array(); $sponsored_student_detail->student_firstname->EditAttrs = array();

		// student_middlename
		$sponsored_student_detail->student_middlename->CellCssStyle = "white-space: nowrap;"; $sponsored_student_detail->student_middlename->CellCssClass = "";
		$sponsored_student_detail->student_middlename->CellAttrs = array(); $sponsored_student_detail->student_middlename->ViewAttrs = array(); $sponsored_student_detail->student_middlename->EditAttrs = array();

		// student_lastname
		$sponsored_student_detail->student_lastname->CellCssStyle = "white-space: nowrap;"; $sponsored_student_detail->student_lastname->CellCssClass = "";
		$sponsored_student_detail->student_lastname->CellAttrs = array(); $sponsored_student_detail->student_lastname->ViewAttrs = array(); $sponsored_student_detail->student_lastname->EditAttrs = array();

		// student_telephone_1
		$sponsored_student_detail->student_telephone_1->CellCssStyle = "white-space: nowrap;"; $sponsored_student_detail->student_telephone_1->CellCssClass = "";
		$sponsored_student_detail->student_telephone_1->CellAttrs = array(); $sponsored_student_detail->student_telephone_1->ViewAttrs = array(); $sponsored_student_detail->student_telephone_1->EditAttrs = array();

		// student_telephone_2
		$sponsored_student_detail->student_telephone_2->CellCssStyle = "white-space: nowrap;"; $sponsored_student_detail->student_telephone_2->CellCssClass = "";
		$sponsored_student_detail->student_telephone_2->CellAttrs = array(); $sponsored_student_detail->student_telephone_2->ViewAttrs = array(); $sponsored_student_detail->student_telephone_2->EditAttrs = array();

		// student_dob
		$sponsored_student_detail->student_dob->CellCssStyle = "white-space: nowrap;"; $sponsored_student_detail->student_dob->CellCssClass = "";
		$sponsored_student_detail->student_dob->CellAttrs = array(); $sponsored_student_detail->student_dob->ViewAttrs = array(); $sponsored_student_detail->student_dob->EditAttrs = array();

		// age
		$sponsored_student_detail->age->CellCssStyle = "white-space: nowrap;"; $sponsored_student_detail->age->CellCssClass = "";
		$sponsored_student_detail->age->CellAttrs = array(); $sponsored_student_detail->age->ViewAttrs = array(); $sponsored_student_detail->age->EditAttrs = array();

		// student_gender
		$sponsored_student_detail->student_gender->CellCssStyle = "white-space: nowrap;"; $sponsored_student_detail->student_gender->CellCssClass = "";
		$sponsored_student_detail->student_gender->CellAttrs = array(); $sponsored_student_detail->student_gender->ViewAttrs = array(); $sponsored_student_detail->student_gender->EditAttrs = array();

		// student_address
		$sponsored_student_detail->student_address->CellCssStyle = "white-space: nowrap;"; $sponsored_student_detail->student_address->CellCssClass = "";
		$sponsored_student_detail->student_address->CellAttrs = array(); $sponsored_student_detail->student_address->ViewAttrs = array(); $sponsored_student_detail->student_address->EditAttrs = array();

		// app_submission_year
		$sponsored_student_detail->app_submission_year->CellCssStyle = "white-space: nowrap;"; $sponsored_student_detail->app_submission_year->CellCssClass = "";
		$sponsored_student_detail->app_submission_year->CellAttrs = array(); $sponsored_student_detail->app_submission_year->ViewAttrs = array(); $sponsored_student_detail->app_submission_year->EditAttrs = array();

		// community
		$sponsored_student_detail->community->CellCssStyle = "white-space: nowrap;"; $sponsored_student_detail->community->CellCssClass = "";
		$sponsored_student_detail->community->CellAttrs = array(); $sponsored_student_detail->community->ViewAttrs = array(); $sponsored_student_detail->community->EditAttrs = array();

		// student_resident_programarea_id
		$sponsored_student_detail->student_resident_programarea_id->CellCssStyle = "white-space: nowrap;"; $sponsored_student_detail->student_resident_programarea_id->CellCssClass = "";
		$sponsored_student_detail->student_resident_programarea_id->CellAttrs = array(); $sponsored_student_detail->student_resident_programarea_id->ViewAttrs = array(); $sponsored_student_detail->student_resident_programarea_id->EditAttrs = array();

		// District
		$sponsored_student_detail->District->CellCssStyle = "white-space: nowrap;"; $sponsored_student_detail->District->CellCssClass = "";
		$sponsored_student_detail->District->CellAttrs = array(); $sponsored_student_detail->District->ViewAttrs = array(); $sponsored_student_detail->District->EditAttrs = array();
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

			// student_firstname
			$sponsored_student_detail->student_firstname->HrefValue = "";
			$sponsored_student_detail->student_firstname->TooltipValue = "";

			// student_middlename
			$sponsored_student_detail->student_middlename->HrefValue = "";
			$sponsored_student_detail->student_middlename->TooltipValue = "";

			// student_lastname
			$sponsored_student_detail->student_lastname->HrefValue = "";
			$sponsored_student_detail->student_lastname->TooltipValue = "";

			// student_telephone_1
			$sponsored_student_detail->student_telephone_1->HrefValue = "";
			$sponsored_student_detail->student_telephone_1->TooltipValue = "";

			// student_telephone_2
			$sponsored_student_detail->student_telephone_2->HrefValue = "";
			$sponsored_student_detail->student_telephone_2->TooltipValue = "";

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

			// student_resident_programarea_id
			$sponsored_student_detail->student_resident_programarea_id->HrefValue = "";
			$sponsored_student_detail->student_resident_programarea_id->TooltipValue = "";

			// District
			$sponsored_student_detail->District->HrefValue = "";
			$sponsored_student_detail->District->TooltipValue = "";
		} elseif ($sponsored_student_detail->RowType == EW_ROWTYPE_SEARCH) { // Search row

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

			// student_telephone_1
			$sponsored_student_detail->student_telephone_1->EditCustomAttributes = "";
			$sponsored_student_detail->student_telephone_1->EditValue = ew_HtmlEncode($sponsored_student_detail->student_telephone_1->AdvancedSearch->SearchValue);

			// student_telephone_2
			$sponsored_student_detail->student_telephone_2->EditCustomAttributes = "";
			$sponsored_student_detail->student_telephone_2->EditValue = ew_HtmlEncode($sponsored_student_detail->student_telephone_2->AdvancedSearch->SearchValue);

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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $sponsored_student_detail;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $sponsored_student_detail->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($sponsored_student_detail->ExportAll) {
			$this->lDisplayRecs = $this->lTotalRecs;
			$this->lStopRec = $this->lTotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->lStartRec-1, $this->lDisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($sponsored_student_detail->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($sponsored_student_detail, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($sponsored_student_detail->sponsored_student_id);
				$ExportDoc->ExportCaption($sponsored_student_detail->student_firstname);
				$ExportDoc->ExportCaption($sponsored_student_detail->student_middlename);
				$ExportDoc->ExportCaption($sponsored_student_detail->student_lastname);
				$ExportDoc->ExportCaption($sponsored_student_detail->student_telephone_1);
				$ExportDoc->ExportCaption($sponsored_student_detail->student_telephone_2);
				$ExportDoc->ExportCaption($sponsored_student_detail->student_dob);
				$ExportDoc->ExportCaption($sponsored_student_detail->age);
				$ExportDoc->ExportCaption($sponsored_student_detail->student_gender);
				$ExportDoc->ExportCaption($sponsored_student_detail->student_address);
				$ExportDoc->ExportCaption($sponsored_student_detail->app_submission_year);
				$ExportDoc->ExportCaption($sponsored_student_detail->community);
				$ExportDoc->ExportCaption($sponsored_student_detail->community_community_id);
				$ExportDoc->ExportCaption($sponsored_student_detail->student_resident_programarea_id);
				$ExportDoc->ExportCaption($sponsored_student_detail->District);
				$ExportDoc->ExportCaption($sponsored_student_detail->community_districts_DistrictID);
				$ExportDoc->EndExportRow();
			}
		}

		// Move to first record
		$this->lRecCnt = $this->lStartRec - 1;
		if (!$rs->EOF) {
			$rs->MoveFirst();
			if (!$bSelectLimit && $this->lStartRec > 1)
				$rs->Move($this->lStartRec - 1);
		}
		while (!$rs->EOF && $this->lRecCnt < $this->lStopRec) {
			$this->lRecCnt++;
			if (intval($this->lRecCnt) >= intval($this->lStartRec)) {
				$this->LoadRowValues($rs);

				// Render row
				$sponsored_student_detail->CssClass = "";
				$sponsored_student_detail->CssStyle = "";
				$sponsored_student_detail->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($sponsored_student_detail->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('sponsored_student_id', $sponsored_student_detail->sponsored_student_id->ExportValue($sponsored_student_detail->Export, $sponsored_student_detail->ExportOriginalValue));
					$XmlDoc->AddField('student_firstname', $sponsored_student_detail->student_firstname->ExportValue($sponsored_student_detail->Export, $sponsored_student_detail->ExportOriginalValue));
					$XmlDoc->AddField('student_middlename', $sponsored_student_detail->student_middlename->ExportValue($sponsored_student_detail->Export, $sponsored_student_detail->ExportOriginalValue));
					$XmlDoc->AddField('student_lastname', $sponsored_student_detail->student_lastname->ExportValue($sponsored_student_detail->Export, $sponsored_student_detail->ExportOriginalValue));
					$XmlDoc->AddField('student_telephone_1', $sponsored_student_detail->student_telephone_1->ExportValue($sponsored_student_detail->Export, $sponsored_student_detail->ExportOriginalValue));
					$XmlDoc->AddField('student_telephone_2', $sponsored_student_detail->student_telephone_2->ExportValue($sponsored_student_detail->Export, $sponsored_student_detail->ExportOriginalValue));
					$XmlDoc->AddField('student_dob', $sponsored_student_detail->student_dob->ExportValue($sponsored_student_detail->Export, $sponsored_student_detail->ExportOriginalValue));
					$XmlDoc->AddField('age', $sponsored_student_detail->age->ExportValue($sponsored_student_detail->Export, $sponsored_student_detail->ExportOriginalValue));
					$XmlDoc->AddField('student_gender', $sponsored_student_detail->student_gender->ExportValue($sponsored_student_detail->Export, $sponsored_student_detail->ExportOriginalValue));
					$XmlDoc->AddField('student_address', $sponsored_student_detail->student_address->ExportValue($sponsored_student_detail->Export, $sponsored_student_detail->ExportOriginalValue));
					$XmlDoc->AddField('app_submission_year', $sponsored_student_detail->app_submission_year->ExportValue($sponsored_student_detail->Export, $sponsored_student_detail->ExportOriginalValue));
					$XmlDoc->AddField('community', $sponsored_student_detail->community->ExportValue($sponsored_student_detail->Export, $sponsored_student_detail->ExportOriginalValue));
					$XmlDoc->AddField('community_community_id', $sponsored_student_detail->community_community_id->ExportValue($sponsored_student_detail->Export, $sponsored_student_detail->ExportOriginalValue));
					$XmlDoc->AddField('student_resident_programarea_id', $sponsored_student_detail->student_resident_programarea_id->ExportValue($sponsored_student_detail->Export, $sponsored_student_detail->ExportOriginalValue));
					$XmlDoc->AddField('District', $sponsored_student_detail->District->ExportValue($sponsored_student_detail->Export, $sponsored_student_detail->ExportOriginalValue));
					$XmlDoc->AddField('community_districts_DistrictID', $sponsored_student_detail->community_districts_DistrictID->ExportValue($sponsored_student_detail->Export, $sponsored_student_detail->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($sponsored_student_detail->sponsored_student_id);
					$ExportDoc->ExportField($sponsored_student_detail->student_firstname);
					$ExportDoc->ExportField($sponsored_student_detail->student_middlename);
					$ExportDoc->ExportField($sponsored_student_detail->student_lastname);
					$ExportDoc->ExportField($sponsored_student_detail->student_telephone_1);
					$ExportDoc->ExportField($sponsored_student_detail->student_telephone_2);
					$ExportDoc->ExportField($sponsored_student_detail->student_dob);
					$ExportDoc->ExportField($sponsored_student_detail->age);
					$ExportDoc->ExportField($sponsored_student_detail->student_gender);
					$ExportDoc->ExportField($sponsored_student_detail->student_address);
					$ExportDoc->ExportField($sponsored_student_detail->app_submission_year);
					$ExportDoc->ExportField($sponsored_student_detail->community);
					$ExportDoc->ExportField($sponsored_student_detail->community_community_id);
					$ExportDoc->ExportField($sponsored_student_detail->student_resident_programarea_id);
					$ExportDoc->ExportField($sponsored_student_detail->District);
					$ExportDoc->ExportField($sponsored_student_detail->community_districts_DistrictID);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($sponsored_student_detail->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($sponsored_student_detail->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($sponsored_student_detail->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($sponsored_student_detail->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($sponsored_student_detail->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $sponsored_student_detail;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "programarea") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $sponsored_student_detail->SqlMasterFilter_programarea();
				$this->sDbDetailFilter = $sponsored_student_detail->SqlDetailFilter_programarea();
				if (@$_GET["programarea_id"] <> "") {
					$GLOBALS["programarea"]->programarea_id->setQueryStringValue($_GET["programarea_id"]);
					$sponsored_student_detail->student_resident_programarea_id->setQueryStringValue($GLOBALS["programarea"]->programarea_id->QueryStringValue);
					$sponsored_student_detail->student_resident_programarea_id->setSessionValue($sponsored_student_detail->student_resident_programarea_id->QueryStringValue);
					if (!is_numeric($GLOBALS["programarea"]->programarea_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@programarea_id@", ew_AdjustSql($GLOBALS["programarea"]->programarea_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@student_resident_programarea_id@", ew_AdjustSql($GLOBALS["programarea"]->programarea_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
			if ($sMasterTblVar == "community") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $sponsored_student_detail->SqlMasterFilter_community();
				$this->sDbDetailFilter = $sponsored_student_detail->SqlDetailFilter_community();
				if (@$_GET["community_id"] <> "") {
					$GLOBALS["community"]->community_id->setQueryStringValue($_GET["community_id"]);
					$sponsored_student_detail->community_community_id->setQueryStringValue($GLOBALS["community"]->community_id->QueryStringValue);
					$sponsored_student_detail->community_community_id->setSessionValue($sponsored_student_detail->community_community_id->QueryStringValue);
					if (!is_numeric($GLOBALS["community"]->community_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@community_id@", ew_AdjustSql($GLOBALS["community"]->community_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@community_community_id@", ew_AdjustSql($GLOBALS["community"]->community_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$sponsored_student_detail->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$sponsored_student_detail->setStartRecordNumber($this->lStartRec);
			$sponsored_student_detail->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$sponsored_student_detail->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "programarea") {
				if ($sponsored_student_detail->student_resident_programarea_id->QueryStringValue == "") $sponsored_student_detail->student_resident_programarea_id->setSessionValue("");
			}
			if ($sMasterTblVar <> "community") {
				if ($sponsored_student_detail->community_community_id->QueryStringValue == "") $sponsored_student_detail->community_community_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $sponsored_student_detail->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $sponsored_student_detail->getDetailFilter(); // Restore detail filter
		}
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example: 
		//$this->ListOptions->Add("new");
		//$this->ListOptions->Items["new"]->OnLeft = TRUE; // Link on left
		//$this->ListOptions->MoveItem("new", 0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
