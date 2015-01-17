<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "view_for_payment_refund_selectioninfo.php" ?>
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
$view_for_payment_refund_selection_list = new cview_for_payment_refund_selection_list();
$Page =& $view_for_payment_refund_selection_list;

// Page init
$view_for_payment_refund_selection_list->Page_Init();

// Page main
$view_for_payment_refund_selection_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($view_for_payment_refund_selection->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var view_for_payment_refund_selection_list = new ew_Page("view_for_payment_refund_selection_list");

// page properties
view_for_payment_refund_selection_list.PageID = "list"; // page ID
view_for_payment_refund_selection_list.FormID = "fview_for_payment_refund_selectionlist"; // form ID
var EW_PAGE_ID = view_for_payment_refund_selection_list.PageID; // for backward compatibility

// extend page with validate function for search
view_for_payment_refund_selection_list.ValidateSearch = function(fobj) {
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
view_for_payment_refund_selection_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
view_for_payment_refund_selection_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
view_for_payment_refund_selection_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($view_for_payment_refund_selection->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$view_for_payment_refund_selection_list->lTotalRecs = $view_for_payment_refund_selection->SelectRecordCount();
	} else {
		if ($rs = $view_for_payment_refund_selection_list->LoadRecordset())
			$view_for_payment_refund_selection_list->lTotalRecs = $rs->RecordCount();
	}
	$view_for_payment_refund_selection_list->lStartRec = 1;
	if ($view_for_payment_refund_selection_list->lDisplayRecs <= 0 || ($view_for_payment_refund_selection->Export <> "" && $view_for_payment_refund_selection->ExportAll)) // Display all records
		$view_for_payment_refund_selection_list->lDisplayRecs = $view_for_payment_refund_selection_list->lTotalRecs;
	if (!($view_for_payment_refund_selection->Export <> "" && $view_for_payment_refund_selection->ExportAll))
		$view_for_payment_refund_selection_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $view_for_payment_refund_selection_list->LoadRecordset($view_for_payment_refund_selection_list->lStartRec-1, $view_for_payment_refund_selection_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $view_for_payment_refund_selection->TableCaption() ?>
<?php if ($view_for_payment_refund_selection->Export == "" && $view_for_payment_refund_selection->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $view_for_payment_refund_selection_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $view_for_payment_refund_selection_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $view_for_payment_refund_selection_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($view_for_payment_refund_selection->Export == "" && $view_for_payment_refund_selection->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(view_for_payment_refund_selection_list);" style="text-decoration: none;"><img id="view_for_payment_refund_selection_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="view_for_payment_refund_selection_list_SearchPanel">
<form name="fview_for_payment_refund_selectionlistsrch" id="fview_for_payment_refund_selectionlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return view_for_payment_refund_selection_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="view_for_payment_refund_selection">
<?php
if ($gsSearchError == "")
	$view_for_payment_refund_selection_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$view_for_payment_refund_selection->RowType = EW_ROWTYPE_SEARCH;

// Render row
$view_for_payment_refund_selection_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker"><?php echo $view_for_payment_refund_selection->schools_school_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_schools_school_id" id="z_schools_school_id" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_schools_school_id" name="x_schools_school_id" title="<?php echo $view_for_payment_refund_selection->schools_school_id->FldTitle() ?>"<?php echo $view_for_payment_refund_selection->schools_school_id->EditAttributes() ?>>
<?php
if (is_array($view_for_payment_refund_selection->schools_school_id->EditValue)) {
	$arwrk = $view_for_payment_refund_selection->schools_school_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($view_for_payment_refund_selection->schools_school_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker"><?php echo $view_for_payment_refund_selection->programarea_payingarea_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_programarea_payingarea_id" id="z_programarea_payingarea_id" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_programarea_payingarea_id" name="x_programarea_payingarea_id" title="<?php echo $view_for_payment_refund_selection->programarea_payingarea_id->FldTitle() ?>"<?php echo $view_for_payment_refund_selection->programarea_payingarea_id->EditAttributes() ?>>
<?php
if (is_array($view_for_payment_refund_selection->programarea_payingarea_id->EditValue)) {
	$arwrk = $view_for_payment_refund_selection->programarea_payingarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($view_for_payment_refund_selection->programarea_payingarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker"><?php echo $view_for_payment_refund_selection->programarea_residentarea_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_programarea_residentarea_id" id="z_programarea_residentarea_id" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_programarea_residentarea_id" name="x_programarea_residentarea_id" title="<?php echo $view_for_payment_refund_selection->programarea_residentarea_id->FldTitle() ?>"<?php echo $view_for_payment_refund_selection->programarea_residentarea_id->EditAttributes() ?>>
<?php
if (is_array($view_for_payment_refund_selection->programarea_residentarea_id->EditValue)) {
	$arwrk = $view_for_payment_refund_selection->programarea_residentarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($view_for_payment_refund_selection->programarea_residentarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($view_for_payment_refund_selection->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $view_for_payment_refund_selection_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ResetSearch") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($view_for_payment_refund_selection->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($view_for_payment_refund_selection->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($view_for_payment_refund_selection->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$view_for_payment_refund_selection_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fview_for_payment_refund_selectionlist" id="fview_for_payment_refund_selectionlist" class="ewForm" action="" method="post">
<div id="gmp_view_for_payment_refund_selection" class="ewGridMiddlePanel">
<?php if ($view_for_payment_refund_selection_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $view_for_payment_refund_selection->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$view_for_payment_refund_selection_list->RenderListOptions();

// Render list options (header, left)
$view_for_payment_refund_selection_list->ListOptions->Render("header", "left");
?>
<?php if ($view_for_payment_refund_selection->sponsored_student_sponsored_student_id->Visible) { // sponsored_student_sponsored_student_id ?>
	<?php if ($view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->sponsored_student_sponsored_student_id) == "") { ?>
		<td><?php echo $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->sponsored_student_sponsored_student_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_for_payment_refund_selection->sponsored_student_sponsored_student_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_for_payment_refund_selection->sponsored_student_sponsored_student_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_for_payment_refund_selection->scholarship_type_scholarship_type->Visible) { // scholarship_type_scholarship_type ?>
	<?php if ($view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->scholarship_type_scholarship_type) == "") { ?>
		<td><?php echo $view_for_payment_refund_selection->scholarship_type_scholarship_type->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->scholarship_type_scholarship_type) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_for_payment_refund_selection->scholarship_type_scholarship_type->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_for_payment_refund_selection->scholarship_type_scholarship_type->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_for_payment_refund_selection->scholarship_type_scholarship_type->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_for_payment_refund_selection->grant_package_grant_package_id->Visible) { // grant_package_grant_package_id ?>
	<?php if ($view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->grant_package_grant_package_id) == "") { ?>
		<td><?php echo $view_for_payment_refund_selection->grant_package_grant_package_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->grant_package_grant_package_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_for_payment_refund_selection->grant_package_grant_package_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_for_payment_refund_selection->grant_package_grant_package_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_for_payment_refund_selection->grant_package_grant_package_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_for_payment_refund_selection->schools_school_id->Visible) { // schools_school_id ?>
	<?php if ($view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->schools_school_id) == "") { ?>
		<td><?php echo $view_for_payment_refund_selection->schools_school_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->schools_school_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_for_payment_refund_selection->schools_school_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_for_payment_refund_selection->schools_school_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_for_payment_refund_selection->schools_school_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_for_payment_refund_selection->programarea_payingarea_id->Visible) { // programarea_payingarea_id ?>
	<?php if ($view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->programarea_payingarea_id) == "") { ?>
		<td><?php echo $view_for_payment_refund_selection->programarea_payingarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->programarea_payingarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_for_payment_refund_selection->programarea_payingarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_for_payment_refund_selection->programarea_payingarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_for_payment_refund_selection->programarea_payingarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_for_payment_refund_selection->programarea_residentarea_id->Visible) { // programarea_residentarea_id ?>
	<?php if ($view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->programarea_residentarea_id) == "") { ?>
		<td><?php echo $view_for_payment_refund_selection->programarea_residentarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->programarea_residentarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_for_payment_refund_selection->programarea_residentarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_for_payment_refund_selection->programarea_residentarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_for_payment_refund_selection->programarea_residentarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_for_payment_refund_selection->payment_request_payment_request_id->Visible) { // payment_request_payment_request_id ?>
	<?php if ($view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->payment_request_payment_request_id) == "") { ?>
		<td><?php echo $view_for_payment_refund_selection->payment_request_payment_request_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->payment_request_payment_request_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_for_payment_refund_selection->payment_request_payment_request_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_for_payment_refund_selection->payment_request_payment_request_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_for_payment_refund_selection->payment_request_payment_request_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_for_payment_refund_selection->scholarship_package_scholarship_package_id->Visible) { // scholarship_package_scholarship_package_id ?>
	<?php if ($view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->scholarship_package_scholarship_package_id) == "") { ?>
		<td><?php echo $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->scholarship_package_scholarship_package_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_for_payment_refund_selection->scholarship_package_scholarship_package_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_for_payment_refund_selection->scholarship_package_scholarship_package_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_for_payment_refund_selection->scholarship_payment_id->Visible) { // scholarship_payment_id ?>
	<?php if ($view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->scholarship_payment_id) == "") { ?>
		<td><?php echo $view_for_payment_refund_selection->scholarship_payment_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_for_payment_refund_selection->SortUrl($view_for_payment_refund_selection->scholarship_payment_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_for_payment_refund_selection->scholarship_payment_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_for_payment_refund_selection->scholarship_payment_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_for_payment_refund_selection->scholarship_payment_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$view_for_payment_refund_selection_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($view_for_payment_refund_selection->ExportAll && $view_for_payment_refund_selection->Export <> "") {
	$view_for_payment_refund_selection_list->lStopRec = $view_for_payment_refund_selection_list->lTotalRecs;
} else {
	$view_for_payment_refund_selection_list->lStopRec = $view_for_payment_refund_selection_list->lStartRec + $view_for_payment_refund_selection_list->lDisplayRecs - 1; // Set the last record to display
}
$view_for_payment_refund_selection_list->lRecCount = $view_for_payment_refund_selection_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $view_for_payment_refund_selection_list->lStartRec > 1)
		$rs->Move($view_for_payment_refund_selection_list->lStartRec - 1);
}

// Initialize aggregate
$view_for_payment_refund_selection->RowType = EW_ROWTYPE_AGGREGATEINIT;
$view_for_payment_refund_selection_list->RenderRow();
$view_for_payment_refund_selection_list->lRowCnt = 0;
while (($view_for_payment_refund_selection->CurrentAction == "gridadd" || !$rs->EOF) &&
	$view_for_payment_refund_selection_list->lRecCount < $view_for_payment_refund_selection_list->lStopRec) {
	$view_for_payment_refund_selection_list->lRecCount++;
	if (intval($view_for_payment_refund_selection_list->lRecCount) >= intval($view_for_payment_refund_selection_list->lStartRec)) {
		$view_for_payment_refund_selection_list->lRowCnt++;

	// Init row class and style
	$view_for_payment_refund_selection->CssClass = "";
	$view_for_payment_refund_selection->CssStyle = "";
	$view_for_payment_refund_selection->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($view_for_payment_refund_selection->CurrentAction == "gridadd") {
		$view_for_payment_refund_selection_list->LoadDefaultValues(); // Load default values
	} else {
		$view_for_payment_refund_selection_list->LoadRowValues($rs); // Load row values
	}
	$view_for_payment_refund_selection->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$view_for_payment_refund_selection_list->RenderRow();

	// Render list options
	$view_for_payment_refund_selection_list->RenderListOptions();
?>
	<tr<?php echo $view_for_payment_refund_selection->RowAttributes() ?>>
<?php

// Render list options (body, left)
$view_for_payment_refund_selection_list->ListOptions->Render("body", "left");
?>
	<?php if ($view_for_payment_refund_selection->sponsored_student_sponsored_student_id->Visible) { // sponsored_student_sponsored_student_id ?>
		<td<?php echo $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_for_payment_refund_selection->scholarship_type_scholarship_type->Visible) { // scholarship_type_scholarship_type ?>
		<td<?php echo $view_for_payment_refund_selection->scholarship_type_scholarship_type->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->scholarship_type_scholarship_type->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->scholarship_type_scholarship_type->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_for_payment_refund_selection->grant_package_grant_package_id->Visible) { // grant_package_grant_package_id ?>
		<td<?php echo $view_for_payment_refund_selection->grant_package_grant_package_id->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->grant_package_grant_package_id->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->grant_package_grant_package_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_for_payment_refund_selection->schools_school_id->Visible) { // schools_school_id ?>
		<td<?php echo $view_for_payment_refund_selection->schools_school_id->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->schools_school_id->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->schools_school_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_for_payment_refund_selection->programarea_payingarea_id->Visible) { // programarea_payingarea_id ?>
		<td<?php echo $view_for_payment_refund_selection->programarea_payingarea_id->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->programarea_payingarea_id->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->programarea_payingarea_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_for_payment_refund_selection->programarea_residentarea_id->Visible) { // programarea_residentarea_id ?>
		<td<?php echo $view_for_payment_refund_selection->programarea_residentarea_id->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->programarea_residentarea_id->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->programarea_residentarea_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_for_payment_refund_selection->payment_request_payment_request_id->Visible) { // payment_request_payment_request_id ?>
		<td<?php echo $view_for_payment_refund_selection->payment_request_payment_request_id->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->payment_request_payment_request_id->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->payment_request_payment_request_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_for_payment_refund_selection->scholarship_package_scholarship_package_id->Visible) { // scholarship_package_scholarship_package_id ?>
		<td<?php echo $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_for_payment_refund_selection->scholarship_payment_id->Visible) { // scholarship_payment_id ?>
		<td<?php echo $view_for_payment_refund_selection->scholarship_payment_id->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->scholarship_payment_id->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->scholarship_payment_id->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view_for_payment_refund_selection_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($view_for_payment_refund_selection->CurrentAction <> "gridadd")
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
<?php if ($view_for_payment_refund_selection->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($view_for_payment_refund_selection->CurrentAction <> "gridadd" && $view_for_payment_refund_selection->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($view_for_payment_refund_selection_list->Pager)) $view_for_payment_refund_selection_list->Pager = new cPrevNextPager($view_for_payment_refund_selection_list->lStartRec, $view_for_payment_refund_selection_list->lDisplayRecs, $view_for_payment_refund_selection_list->lTotalRecs) ?>
<?php if ($view_for_payment_refund_selection_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($view_for_payment_refund_selection_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $view_for_payment_refund_selection_list->PageUrl() ?>start=<?php echo $view_for_payment_refund_selection_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($view_for_payment_refund_selection_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $view_for_payment_refund_selection_list->PageUrl() ?>start=<?php echo $view_for_payment_refund_selection_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $view_for_payment_refund_selection_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($view_for_payment_refund_selection_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $view_for_payment_refund_selection_list->PageUrl() ?>start=<?php echo $view_for_payment_refund_selection_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($view_for_payment_refund_selection_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $view_for_payment_refund_selection_list->PageUrl() ?>start=<?php echo $view_for_payment_refund_selection_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $view_for_payment_refund_selection_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $view_for_payment_refund_selection_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $view_for_payment_refund_selection_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $view_for_payment_refund_selection_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($view_for_payment_refund_selection_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($view_for_payment_refund_selection_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($view_for_payment_refund_selection->Export == "" && $view_for_payment_refund_selection->CurrentAction == "") { ?>
<?php } ?>
<?php if ($view_for_payment_refund_selection->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$view_for_payment_refund_selection_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cview_for_payment_refund_selection_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'view_for_payment_refund_selection';

	// Page object name
	var $PageObjName = 'view_for_payment_refund_selection_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $view_for_payment_refund_selection;
		if ($view_for_payment_refund_selection->UseTokenInUrl) $PageUrl .= "t=" . $view_for_payment_refund_selection->TableVar . "&"; // Add page token
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
		global $objForm, $view_for_payment_refund_selection;
		if ($view_for_payment_refund_selection->UseTokenInUrl) {
			if ($objForm)
				return ($view_for_payment_refund_selection->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($view_for_payment_refund_selection->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cview_for_payment_refund_selection_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (view_for_payment_refund_selection)
		$GLOBALS["view_for_payment_refund_selection"] = new cview_for_payment_refund_selection();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["view_for_payment_refund_selection"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "view_for_payment_refund_selectiondelete.php";
		$this->MultiUpdateUrl = "view_for_payment_refund_selectionupdate.php";

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
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'view_for_payment_refund_selection', TRUE);

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
		global $view_for_payment_refund_selection;

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
			$view_for_payment_refund_selection->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$view_for_payment_refund_selection->Export = $_POST["exporttype"];
		} else {
			$view_for_payment_refund_selection->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $view_for_payment_refund_selection->Export; // Get export parameter, used in header
		$gsExportFile = $view_for_payment_refund_selection->TableVar; // Get export file, used in header
		if ($view_for_payment_refund_selection->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($view_for_payment_refund_selection->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $view_for_payment_refund_selection;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

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
			$view_for_payment_refund_selection->Recordset_SearchValidated();

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
		if ($view_for_payment_refund_selection->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $view_for_payment_refund_selection->getRecordsPerPage(); // Restore from Session
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
		$view_for_payment_refund_selection->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$view_for_payment_refund_selection->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$view_for_payment_refund_selection->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $view_for_payment_refund_selection->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;
		if ($sFilter == "") {
			$sFilter = "0=101";
			$this->sSrchWhere = $sFilter;
		}

		// Set up filter in session
		$view_for_payment_refund_selection->setSessionWhere($sFilter);
		$view_for_payment_refund_selection->CurrentFilter = "";

		// Export data only
		if (in_array($view_for_payment_refund_selection->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($view_for_payment_refund_selection->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $view_for_payment_refund_selection;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $view_for_payment_refund_selection->sponsored_student_sponsored_student_id, FALSE); // sponsored_student_sponsored_student_id
		$this->BuildSearchSql($sWhere, $view_for_payment_refund_selection->scholarship_type_scholarship_type, FALSE); // scholarship_type_scholarship_type
		$this->BuildSearchSql($sWhere, $view_for_payment_refund_selection->grant_package_grant_package_id, FALSE); // grant_package_grant_package_id
		$this->BuildSearchSql($sWhere, $view_for_payment_refund_selection->schools_school_id, FALSE); // schools_school_id
		$this->BuildSearchSql($sWhere, $view_for_payment_refund_selection->programarea_payingarea_id, FALSE); // programarea_payingarea_id
		$this->BuildSearchSql($sWhere, $view_for_payment_refund_selection->programarea_residentarea_id, FALSE); // programarea_residentarea_id
		$this->BuildSearchSql($sWhere, $view_for_payment_refund_selection->payment_request_payment_request_id, FALSE); // payment_request_payment_request_id
		$this->BuildSearchSql($sWhere, $view_for_payment_refund_selection->scholarship_package_scholarship_package_id, FALSE); // scholarship_package_scholarship_package_id
		$this->BuildSearchSql($sWhere, $view_for_payment_refund_selection->scholarship_payment_id, FALSE); // scholarship_payment_id

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($view_for_payment_refund_selection->sponsored_student_sponsored_student_id); // sponsored_student_sponsored_student_id
			$this->SetSearchParm($view_for_payment_refund_selection->scholarship_type_scholarship_type); // scholarship_type_scholarship_type
			$this->SetSearchParm($view_for_payment_refund_selection->grant_package_grant_package_id); // grant_package_grant_package_id
			$this->SetSearchParm($view_for_payment_refund_selection->schools_school_id); // schools_school_id
			$this->SetSearchParm($view_for_payment_refund_selection->programarea_payingarea_id); // programarea_payingarea_id
			$this->SetSearchParm($view_for_payment_refund_selection->programarea_residentarea_id); // programarea_residentarea_id
			$this->SetSearchParm($view_for_payment_refund_selection->payment_request_payment_request_id); // payment_request_payment_request_id
			$this->SetSearchParm($view_for_payment_refund_selection->scholarship_package_scholarship_package_id); // scholarship_package_scholarship_package_id
			$this->SetSearchParm($view_for_payment_refund_selection->scholarship_payment_id); // scholarship_payment_id
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
		global $view_for_payment_refund_selection;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$view_for_payment_refund_selection->setAdvancedSearch("x_$FldParm", $FldVal);
		$view_for_payment_refund_selection->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$view_for_payment_refund_selection->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$view_for_payment_refund_selection->setAdvancedSearch("y_$FldParm", $FldVal2);
		$view_for_payment_refund_selection->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $view_for_payment_refund_selection;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $view_for_payment_refund_selection->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $view_for_payment_refund_selection->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $view_for_payment_refund_selection->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $view_for_payment_refund_selection->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $view_for_payment_refund_selection->GetAdvancedSearch("w_$FldParm");
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
		global $view_for_payment_refund_selection;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		if (is_numeric($Keyword)) $this->BuildBasicSearchSQL($sWhere, $view_for_payment_refund_selection->sponsored_student_sponsored_student_id, $Keyword);
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
		global $Security, $view_for_payment_refund_selection;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $view_for_payment_refund_selection->BasicSearchKeyword;
		$sSearchType = $view_for_payment_refund_selection->BasicSearchType;
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
			$view_for_payment_refund_selection->setSessionBasicSearchKeyword($sSearchKeyword);
			$view_for_payment_refund_selection->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $view_for_payment_refund_selection;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$view_for_payment_refund_selection->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $view_for_payment_refund_selection;
		$view_for_payment_refund_selection->setSessionBasicSearchKeyword("");
		$view_for_payment_refund_selection->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $view_for_payment_refund_selection;
		$view_for_payment_refund_selection->setAdvancedSearch("x_sponsored_student_sponsored_student_id", "");
		$view_for_payment_refund_selection->setAdvancedSearch("x_scholarship_type_scholarship_type", "");
		$view_for_payment_refund_selection->setAdvancedSearch("x_grant_package_grant_package_id", "");
		$view_for_payment_refund_selection->setAdvancedSearch("x_schools_school_id", "");
		$view_for_payment_refund_selection->setAdvancedSearch("x_programarea_payingarea_id", "");
		$view_for_payment_refund_selection->setAdvancedSearch("x_programarea_residentarea_id", "");
		$view_for_payment_refund_selection->setAdvancedSearch("x_payment_request_payment_request_id", "");
		$view_for_payment_refund_selection->setAdvancedSearch("x_scholarship_package_scholarship_package_id", "");
		$view_for_payment_refund_selection->setAdvancedSearch("x_scholarship_payment_id", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $view_for_payment_refund_selection;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_sponsored_student_sponsored_student_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_scholarship_type_scholarship_type"] <> "") $bRestore = FALSE;
		if (@$_GET["x_grant_package_grant_package_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_schools_school_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_programarea_payingarea_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_programarea_residentarea_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_payment_request_payment_request_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_scholarship_package_scholarship_package_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_scholarship_payment_id"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$view_for_payment_refund_selection->BasicSearchKeyword = $view_for_payment_refund_selection->getSessionBasicSearchKeyword();
			$view_for_payment_refund_selection->BasicSearchType = $view_for_payment_refund_selection->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($view_for_payment_refund_selection->sponsored_student_sponsored_student_id);
			$this->GetSearchParm($view_for_payment_refund_selection->scholarship_type_scholarship_type);
			$this->GetSearchParm($view_for_payment_refund_selection->grant_package_grant_package_id);
			$this->GetSearchParm($view_for_payment_refund_selection->schools_school_id);
			$this->GetSearchParm($view_for_payment_refund_selection->programarea_payingarea_id);
			$this->GetSearchParm($view_for_payment_refund_selection->programarea_residentarea_id);
			$this->GetSearchParm($view_for_payment_refund_selection->payment_request_payment_request_id);
			$this->GetSearchParm($view_for_payment_refund_selection->scholarship_package_scholarship_package_id);
			$this->GetSearchParm($view_for_payment_refund_selection->scholarship_payment_id);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $view_for_payment_refund_selection;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$view_for_payment_refund_selection->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$view_for_payment_refund_selection->CurrentOrderType = @$_GET["ordertype"];
			$view_for_payment_refund_selection->UpdateSort($view_for_payment_refund_selection->sponsored_student_sponsored_student_id); // sponsored_student_sponsored_student_id
			$view_for_payment_refund_selection->UpdateSort($view_for_payment_refund_selection->scholarship_type_scholarship_type); // scholarship_type_scholarship_type
			$view_for_payment_refund_selection->UpdateSort($view_for_payment_refund_selection->grant_package_grant_package_id); // grant_package_grant_package_id
			$view_for_payment_refund_selection->UpdateSort($view_for_payment_refund_selection->schools_school_id); // schools_school_id
			$view_for_payment_refund_selection->UpdateSort($view_for_payment_refund_selection->programarea_payingarea_id); // programarea_payingarea_id
			$view_for_payment_refund_selection->UpdateSort($view_for_payment_refund_selection->programarea_residentarea_id); // programarea_residentarea_id
			$view_for_payment_refund_selection->UpdateSort($view_for_payment_refund_selection->payment_request_payment_request_id); // payment_request_payment_request_id
			$view_for_payment_refund_selection->UpdateSort($view_for_payment_refund_selection->scholarship_package_scholarship_package_id); // scholarship_package_scholarship_package_id
			$view_for_payment_refund_selection->UpdateSort($view_for_payment_refund_selection->scholarship_payment_id); // scholarship_payment_id
			$view_for_payment_refund_selection->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $view_for_payment_refund_selection;
		$sOrderBy = $view_for_payment_refund_selection->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($view_for_payment_refund_selection->SqlOrderBy() <> "") {
				$sOrderBy = $view_for_payment_refund_selection->SqlOrderBy();
				$view_for_payment_refund_selection->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $view_for_payment_refund_selection;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$view_for_payment_refund_selection->setSessionOrderBy($sOrderBy);
				$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->setSort("");
				$view_for_payment_refund_selection->scholarship_type_scholarship_type->setSort("");
				$view_for_payment_refund_selection->grant_package_grant_package_id->setSort("");
				$view_for_payment_refund_selection->schools_school_id->setSort("");
				$view_for_payment_refund_selection->programarea_payingarea_id->setSort("");
				$view_for_payment_refund_selection->programarea_residentarea_id->setSort("");
				$view_for_payment_refund_selection->payment_request_payment_request_id->setSort("");
				$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->setSort("");
				$view_for_payment_refund_selection->scholarship_payment_id->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$view_for_payment_refund_selection->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $view_for_payment_refund_selection;

		// "detail_Payment_Refund"
		$this->ListOptions->Add("detail_Payment_Refund");
		$item =& $this->ListOptions->Items["detail_Payment_Refund"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('Payment Refund');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($view_for_payment_refund_selection->Export <> "" ||
			$view_for_payment_refund_selection->CurrentAction == "gridadd" ||
			$view_for_payment_refund_selection->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $view_for_payment_refund_selection;
		$this->ListOptions->LoadDefault();

		// "detail_Payment_Refund"
		$oListOpt =& $this->ListOptions->Items["detail_Payment_Refund"];
		if ($Security->AllowList('Payment Refund')) {
			$oListOpt->Body = "<img src=\"images/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("Payment_Refund", "TblCaption");
			$oListOpt->Body = "<a href=\"Payment_Refundlist.php?" . EW_TABLE_SHOW_MASTER . "=view_for_payment_refund_selection&scholarship_payment_id=" . urlencode(strval($view_for_payment_refund_selection->scholarship_payment_id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $view_for_payment_refund_selection;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $view_for_payment_refund_selection;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$view_for_payment_refund_selection->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$view_for_payment_refund_selection->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $view_for_payment_refund_selection->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$view_for_payment_refund_selection->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$view_for_payment_refund_selection->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$view_for_payment_refund_selection->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $view_for_payment_refund_selection;
		$view_for_payment_refund_selection->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$view_for_payment_refund_selection->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $view_for_payment_refund_selection;

		// Load search values
		// sponsored_student_sponsored_student_id

		$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_sponsored_student_sponsored_student_id"]);
		$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->AdvancedSearch->SearchOperator = @$_GET["z_sponsored_student_sponsored_student_id"];

		// scholarship_type_scholarship_type
		$view_for_payment_refund_selection->scholarship_type_scholarship_type->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_scholarship_type_scholarship_type"]);
		$view_for_payment_refund_selection->scholarship_type_scholarship_type->AdvancedSearch->SearchOperator = @$_GET["z_scholarship_type_scholarship_type"];

		// grant_package_grant_package_id
		$view_for_payment_refund_selection->grant_package_grant_package_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_grant_package_grant_package_id"]);
		$view_for_payment_refund_selection->grant_package_grant_package_id->AdvancedSearch->SearchOperator = @$_GET["z_grant_package_grant_package_id"];

		// schools_school_id
		$view_for_payment_refund_selection->schools_school_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_schools_school_id"]);
		$view_for_payment_refund_selection->schools_school_id->AdvancedSearch->SearchOperator = @$_GET["z_schools_school_id"];

		// programarea_payingarea_id
		$view_for_payment_refund_selection->programarea_payingarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programarea_payingarea_id"]);
		$view_for_payment_refund_selection->programarea_payingarea_id->AdvancedSearch->SearchOperator = @$_GET["z_programarea_payingarea_id"];

		// programarea_residentarea_id
		$view_for_payment_refund_selection->programarea_residentarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programarea_residentarea_id"]);
		$view_for_payment_refund_selection->programarea_residentarea_id->AdvancedSearch->SearchOperator = @$_GET["z_programarea_residentarea_id"];

		// payment_request_payment_request_id
		$view_for_payment_refund_selection->payment_request_payment_request_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_payment_request_payment_request_id"]);
		$view_for_payment_refund_selection->payment_request_payment_request_id->AdvancedSearch->SearchOperator = @$_GET["z_payment_request_payment_request_id"];

		// scholarship_package_scholarship_package_id
		$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_scholarship_package_scholarship_package_id"]);
		$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->AdvancedSearch->SearchOperator = @$_GET["z_scholarship_package_scholarship_package_id"];

		// scholarship_payment_id
		$view_for_payment_refund_selection->scholarship_payment_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_scholarship_payment_id"]);
		$view_for_payment_refund_selection->scholarship_payment_id->AdvancedSearch->SearchOperator = @$_GET["z_scholarship_payment_id"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $view_for_payment_refund_selection;

		// Call Recordset Selecting event
		$view_for_payment_refund_selection->Recordset_Selecting($view_for_payment_refund_selection->CurrentFilter);

		// Load List page SQL
		$sSql = $view_for_payment_refund_selection->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$view_for_payment_refund_selection->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $view_for_payment_refund_selection;
		$sFilter = $view_for_payment_refund_selection->KeyFilter();

		// Call Row Selecting event
		$view_for_payment_refund_selection->Row_Selecting($sFilter);

		// Load SQL based on filter
		$view_for_payment_refund_selection->CurrentFilter = $sFilter;
		$sSql = $view_for_payment_refund_selection->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$view_for_payment_refund_selection->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $view_for_payment_refund_selection;
		$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->setDbValue($rs->fields('sponsored_student_sponsored_student_id'));
		$view_for_payment_refund_selection->scholarship_type_scholarship_type->setDbValue($rs->fields('scholarship_type_scholarship_type'));
		$view_for_payment_refund_selection->grant_package_grant_package_id->setDbValue($rs->fields('grant_package_grant_package_id'));
		$view_for_payment_refund_selection->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$view_for_payment_refund_selection->programarea_payingarea_id->setDbValue($rs->fields('programarea_payingarea_id'));
		$view_for_payment_refund_selection->programarea_residentarea_id->setDbValue($rs->fields('programarea_residentarea_id'));
		$view_for_payment_refund_selection->payment_request_payment_request_id->setDbValue($rs->fields('payment_request_payment_request_id'));
		$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->setDbValue($rs->fields('scholarship_package_scholarship_package_id'));
		$view_for_payment_refund_selection->scholarship_payment_id->setDbValue($rs->fields('scholarship_payment_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $view_for_payment_refund_selection;

		// Initialize URLs
		$this->ViewUrl = $view_for_payment_refund_selection->ViewUrl();
		$this->EditUrl = $view_for_payment_refund_selection->EditUrl();
		$this->InlineEditUrl = $view_for_payment_refund_selection->InlineEditUrl();
		$this->CopyUrl = $view_for_payment_refund_selection->CopyUrl();
		$this->InlineCopyUrl = $view_for_payment_refund_selection->InlineCopyUrl();
		$this->DeleteUrl = $view_for_payment_refund_selection->DeleteUrl();

		// Call Row_Rendering event
		$view_for_payment_refund_selection->Row_Rendering();

		// Common render codes for all row types
		// sponsored_student_sponsored_student_id

		$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->CellCssStyle = ""; $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->CellCssClass = "";
		$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->CellAttrs = array(); $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->ViewAttrs = array(); $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->EditAttrs = array();

		// scholarship_type_scholarship_type
		$view_for_payment_refund_selection->scholarship_type_scholarship_type->CellCssStyle = ""; $view_for_payment_refund_selection->scholarship_type_scholarship_type->CellCssClass = "";
		$view_for_payment_refund_selection->scholarship_type_scholarship_type->CellAttrs = array(); $view_for_payment_refund_selection->scholarship_type_scholarship_type->ViewAttrs = array(); $view_for_payment_refund_selection->scholarship_type_scholarship_type->EditAttrs = array();

		// grant_package_grant_package_id
		$view_for_payment_refund_selection->grant_package_grant_package_id->CellCssStyle = ""; $view_for_payment_refund_selection->grant_package_grant_package_id->CellCssClass = "";
		$view_for_payment_refund_selection->grant_package_grant_package_id->CellAttrs = array(); $view_for_payment_refund_selection->grant_package_grant_package_id->ViewAttrs = array(); $view_for_payment_refund_selection->grant_package_grant_package_id->EditAttrs = array();

		// schools_school_id
		$view_for_payment_refund_selection->schools_school_id->CellCssStyle = ""; $view_for_payment_refund_selection->schools_school_id->CellCssClass = "";
		$view_for_payment_refund_selection->schools_school_id->CellAttrs = array(); $view_for_payment_refund_selection->schools_school_id->ViewAttrs = array(); $view_for_payment_refund_selection->schools_school_id->EditAttrs = array();

		// programarea_payingarea_id
		$view_for_payment_refund_selection->programarea_payingarea_id->CellCssStyle = ""; $view_for_payment_refund_selection->programarea_payingarea_id->CellCssClass = "";
		$view_for_payment_refund_selection->programarea_payingarea_id->CellAttrs = array(); $view_for_payment_refund_selection->programarea_payingarea_id->ViewAttrs = array(); $view_for_payment_refund_selection->programarea_payingarea_id->EditAttrs = array();

		// programarea_residentarea_id
		$view_for_payment_refund_selection->programarea_residentarea_id->CellCssStyle = ""; $view_for_payment_refund_selection->programarea_residentarea_id->CellCssClass = "";
		$view_for_payment_refund_selection->programarea_residentarea_id->CellAttrs = array(); $view_for_payment_refund_selection->programarea_residentarea_id->ViewAttrs = array(); $view_for_payment_refund_selection->programarea_residentarea_id->EditAttrs = array();

		// payment_request_payment_request_id
		$view_for_payment_refund_selection->payment_request_payment_request_id->CellCssStyle = ""; $view_for_payment_refund_selection->payment_request_payment_request_id->CellCssClass = "";
		$view_for_payment_refund_selection->payment_request_payment_request_id->CellAttrs = array(); $view_for_payment_refund_selection->payment_request_payment_request_id->ViewAttrs = array(); $view_for_payment_refund_selection->payment_request_payment_request_id->EditAttrs = array();

		// scholarship_package_scholarship_package_id
		$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->CellCssStyle = ""; $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->CellCssClass = "";
		$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->CellAttrs = array(); $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->ViewAttrs = array(); $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->EditAttrs = array();

		// scholarship_payment_id
		$view_for_payment_refund_selection->scholarship_payment_id->CellCssStyle = ""; $view_for_payment_refund_selection->scholarship_payment_id->CellCssClass = "";
		$view_for_payment_refund_selection->scholarship_payment_id->CellAttrs = array(); $view_for_payment_refund_selection->scholarship_payment_id->ViewAttrs = array(); $view_for_payment_refund_selection->scholarship_payment_id->EditAttrs = array();
		if ($view_for_payment_refund_selection->RowType == EW_ROWTYPE_VIEW) { // View row

			// sponsored_student_sponsored_student_id
			if (strval($view_for_payment_refund_selection->sponsored_student_sponsored_student_id->CurrentValue) <> "") {
				$sFilterWrk = "`sponsored_student_id` = " . ew_AdjustSql($view_for_payment_refund_selection->sponsored_student_sponsored_student_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `student_lastname`, `student_firstname` FROM `sponsored_student`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->ViewValue = $rswrk->fields('student_lastname');
					$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('student_firstname');
					$rswrk->Close();
				} else {
					$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->ViewValue = $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->CurrentValue;
				}
			} else {
				$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->ViewValue = NULL;
			}
			$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->CssStyle = "";
			$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->CssClass = "";
			$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->ViewCustomAttributes = "";

			// scholarship_type_scholarship_type
			if (strval($view_for_payment_refund_selection->scholarship_type_scholarship_type->CurrentValue) <> "") {
				$sFilterWrk = "`scholarship_type_id` = " . ew_AdjustSql($view_for_payment_refund_selection->scholarship_type_scholarship_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `scholarship_type_name` FROM `scholarship_type`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view_for_payment_refund_selection->scholarship_type_scholarship_type->ViewValue = $rswrk->fields('scholarship_type_name');
					$rswrk->Close();
				} else {
					$view_for_payment_refund_selection->scholarship_type_scholarship_type->ViewValue = $view_for_payment_refund_selection->scholarship_type_scholarship_type->CurrentValue;
				}
			} else {
				$view_for_payment_refund_selection->scholarship_type_scholarship_type->ViewValue = NULL;
			}
			$view_for_payment_refund_selection->scholarship_type_scholarship_type->CssStyle = "";
			$view_for_payment_refund_selection->scholarship_type_scholarship_type->CssClass = "";
			$view_for_payment_refund_selection->scholarship_type_scholarship_type->ViewCustomAttributes = "";

			// grant_package_grant_package_id
			if (strval($view_for_payment_refund_selection->grant_package_grant_package_id->CurrentValue) <> "") {
				$sFilterWrk = "`grant_package_id` = " . ew_AdjustSql($view_for_payment_refund_selection->grant_package_grant_package_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `grant_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view_for_payment_refund_selection->grant_package_grant_package_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$view_for_payment_refund_selection->grant_package_grant_package_id->ViewValue = $view_for_payment_refund_selection->grant_package_grant_package_id->CurrentValue;
				}
			} else {
				$view_for_payment_refund_selection->grant_package_grant_package_id->ViewValue = NULL;
			}
			$view_for_payment_refund_selection->grant_package_grant_package_id->CssStyle = "";
			$view_for_payment_refund_selection->grant_package_grant_package_id->CssClass = "";
			$view_for_payment_refund_selection->grant_package_grant_package_id->ViewCustomAttributes = "";

			// schools_school_id
			if (strval($view_for_payment_refund_selection->schools_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($view_for_payment_refund_selection->schools_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view_for_payment_refund_selection->schools_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$view_for_payment_refund_selection->schools_school_id->ViewValue = $view_for_payment_refund_selection->schools_school_id->CurrentValue;
				}
			} else {
				$view_for_payment_refund_selection->schools_school_id->ViewValue = NULL;
			}
			$view_for_payment_refund_selection->schools_school_id->CssStyle = "";
			$view_for_payment_refund_selection->schools_school_id->CssClass = "";
			$view_for_payment_refund_selection->schools_school_id->ViewCustomAttributes = "";

			// programarea_payingarea_id
			if (strval($view_for_payment_refund_selection->programarea_payingarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($view_for_payment_refund_selection->programarea_payingarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view_for_payment_refund_selection->programarea_payingarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$view_for_payment_refund_selection->programarea_payingarea_id->ViewValue = $view_for_payment_refund_selection->programarea_payingarea_id->CurrentValue;
				}
			} else {
				$view_for_payment_refund_selection->programarea_payingarea_id->ViewValue = NULL;
			}
			$view_for_payment_refund_selection->programarea_payingarea_id->CssStyle = "";
			$view_for_payment_refund_selection->programarea_payingarea_id->CssClass = "";
			$view_for_payment_refund_selection->programarea_payingarea_id->ViewCustomAttributes = "";

			// programarea_residentarea_id
			if (strval($view_for_payment_refund_selection->programarea_residentarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($view_for_payment_refund_selection->programarea_residentarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view_for_payment_refund_selection->programarea_residentarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$view_for_payment_refund_selection->programarea_residentarea_id->ViewValue = $view_for_payment_refund_selection->programarea_residentarea_id->CurrentValue;
				}
			} else {
				$view_for_payment_refund_selection->programarea_residentarea_id->ViewValue = NULL;
			}
			$view_for_payment_refund_selection->programarea_residentarea_id->CssStyle = "";
			$view_for_payment_refund_selection->programarea_residentarea_id->CssClass = "";
			$view_for_payment_refund_selection->programarea_residentarea_id->ViewCustomAttributes = "";

			// payment_request_payment_request_id
			if (strval($view_for_payment_refund_selection->payment_request_payment_request_id->CurrentValue) <> "") {
				$sFilterWrk = "`payment_request_id` = " . ew_AdjustSql($view_for_payment_refund_selection->payment_request_payment_request_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `code` FROM `payment_request`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view_for_payment_refund_selection->payment_request_payment_request_id->ViewValue = $rswrk->fields('code');
					$rswrk->Close();
				} else {
					$view_for_payment_refund_selection->payment_request_payment_request_id->ViewValue = $view_for_payment_refund_selection->payment_request_payment_request_id->CurrentValue;
				}
			} else {
				$view_for_payment_refund_selection->payment_request_payment_request_id->ViewValue = NULL;
			}
			$view_for_payment_refund_selection->payment_request_payment_request_id->CssStyle = "";
			$view_for_payment_refund_selection->payment_request_payment_request_id->CssClass = "";
			$view_for_payment_refund_selection->payment_request_payment_request_id->ViewCustomAttributes = "";

			// scholarship_package_scholarship_package_id
			if (strval($view_for_payment_refund_selection->scholarship_package_scholarship_package_id->CurrentValue) <> "") {
				$sFilterWrk = "`scholarship_package_id` = " . ew_AdjustSql($view_for_payment_refund_selection->scholarship_package_scholarship_package_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `group_id` FROM `scholarship_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->ViewValue = $rswrk->fields('group_id');
					$rswrk->Close();
				} else {
					$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->ViewValue = $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->CurrentValue;
				}
			} else {
				$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->ViewValue = NULL;
			}
			$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->CssStyle = "";
			$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->CssClass = "";
			$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->ViewCustomAttributes = "";

			// scholarship_payment_id
			$view_for_payment_refund_selection->scholarship_payment_id->ViewValue = $view_for_payment_refund_selection->scholarship_payment_id->CurrentValue;
			$view_for_payment_refund_selection->scholarship_payment_id->CssStyle = "";
			$view_for_payment_refund_selection->scholarship_payment_id->CssClass = "";
			$view_for_payment_refund_selection->scholarship_payment_id->ViewCustomAttributes = "";

			// sponsored_student_sponsored_student_id
			$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->HrefValue = "";
			$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->TooltipValue = "";

			// scholarship_type_scholarship_type
			$view_for_payment_refund_selection->scholarship_type_scholarship_type->HrefValue = "";
			$view_for_payment_refund_selection->scholarship_type_scholarship_type->TooltipValue = "";

			// grant_package_grant_package_id
			$view_for_payment_refund_selection->grant_package_grant_package_id->HrefValue = "";
			$view_for_payment_refund_selection->grant_package_grant_package_id->TooltipValue = "";

			// schools_school_id
			$view_for_payment_refund_selection->schools_school_id->HrefValue = "";
			$view_for_payment_refund_selection->schools_school_id->TooltipValue = "";

			// programarea_payingarea_id
			$view_for_payment_refund_selection->programarea_payingarea_id->HrefValue = "";
			$view_for_payment_refund_selection->programarea_payingarea_id->TooltipValue = "";

			// programarea_residentarea_id
			$view_for_payment_refund_selection->programarea_residentarea_id->HrefValue = "";
			$view_for_payment_refund_selection->programarea_residentarea_id->TooltipValue = "";

			// payment_request_payment_request_id
			$view_for_payment_refund_selection->payment_request_payment_request_id->HrefValue = "";
			$view_for_payment_refund_selection->payment_request_payment_request_id->TooltipValue = "";

			// scholarship_package_scholarship_package_id
			$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->HrefValue = "";
			$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->TooltipValue = "";

			// scholarship_payment_id
			$view_for_payment_refund_selection->scholarship_payment_id->HrefValue = "";
			$view_for_payment_refund_selection->scholarship_payment_id->TooltipValue = "";
		} elseif ($view_for_payment_refund_selection->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// sponsored_student_sponsored_student_id
			$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->EditCustomAttributes = "";

			// scholarship_type_scholarship_type
			$view_for_payment_refund_selection->scholarship_type_scholarship_type->EditCustomAttributes = "";

			// grant_package_grant_package_id
			$view_for_payment_refund_selection->grant_package_grant_package_id->EditCustomAttributes = "";

			// schools_school_id
			$view_for_payment_refund_selection->schools_school_id->EditCustomAttributes = "";
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
			$view_for_payment_refund_selection->schools_school_id->EditValue = $arwrk;

			// programarea_payingarea_id
			$view_for_payment_refund_selection->programarea_payingarea_id->EditCustomAttributes = "";
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
			$view_for_payment_refund_selection->programarea_payingarea_id->EditValue = $arwrk;

			// programarea_residentarea_id
			$view_for_payment_refund_selection->programarea_residentarea_id->EditCustomAttributes = "";
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
			$view_for_payment_refund_selection->programarea_residentarea_id->EditValue = $arwrk;

			// payment_request_payment_request_id
			$view_for_payment_refund_selection->payment_request_payment_request_id->EditCustomAttributes = "";

			// scholarship_package_scholarship_package_id
			$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->EditCustomAttributes = "";

			// scholarship_payment_id
			$view_for_payment_refund_selection->scholarship_payment_id->EditCustomAttributes = "";
			$view_for_payment_refund_selection->scholarship_payment_id->EditValue = ew_HtmlEncode($view_for_payment_refund_selection->scholarship_payment_id->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($view_for_payment_refund_selection->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$view_for_payment_refund_selection->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $view_for_payment_refund_selection;

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
		global $view_for_payment_refund_selection;
		$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->AdvancedSearch->SearchValue = $view_for_payment_refund_selection->getAdvancedSearch("x_sponsored_student_sponsored_student_id");
		$view_for_payment_refund_selection->scholarship_type_scholarship_type->AdvancedSearch->SearchValue = $view_for_payment_refund_selection->getAdvancedSearch("x_scholarship_type_scholarship_type");
		$view_for_payment_refund_selection->grant_package_grant_package_id->AdvancedSearch->SearchValue = $view_for_payment_refund_selection->getAdvancedSearch("x_grant_package_grant_package_id");
		$view_for_payment_refund_selection->schools_school_id->AdvancedSearch->SearchValue = $view_for_payment_refund_selection->getAdvancedSearch("x_schools_school_id");
		$view_for_payment_refund_selection->programarea_payingarea_id->AdvancedSearch->SearchValue = $view_for_payment_refund_selection->getAdvancedSearch("x_programarea_payingarea_id");
		$view_for_payment_refund_selection->programarea_residentarea_id->AdvancedSearch->SearchValue = $view_for_payment_refund_selection->getAdvancedSearch("x_programarea_residentarea_id");
		$view_for_payment_refund_selection->payment_request_payment_request_id->AdvancedSearch->SearchValue = $view_for_payment_refund_selection->getAdvancedSearch("x_payment_request_payment_request_id");
		$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->AdvancedSearch->SearchValue = $view_for_payment_refund_selection->getAdvancedSearch("x_scholarship_package_scholarship_package_id");
		$view_for_payment_refund_selection->scholarship_payment_id->AdvancedSearch->SearchValue = $view_for_payment_refund_selection->getAdvancedSearch("x_scholarship_payment_id");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $view_for_payment_refund_selection;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $view_for_payment_refund_selection->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($view_for_payment_refund_selection->ExportAll) {
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
		if ($view_for_payment_refund_selection->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($view_for_payment_refund_selection, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($view_for_payment_refund_selection->sponsored_student_sponsored_student_id);
				$ExportDoc->ExportCaption($view_for_payment_refund_selection->scholarship_type_scholarship_type);
				$ExportDoc->ExportCaption($view_for_payment_refund_selection->grant_package_grant_package_id);
				$ExportDoc->ExportCaption($view_for_payment_refund_selection->schools_school_id);
				$ExportDoc->ExportCaption($view_for_payment_refund_selection->programarea_payingarea_id);
				$ExportDoc->ExportCaption($view_for_payment_refund_selection->programarea_residentarea_id);
				$ExportDoc->ExportCaption($view_for_payment_refund_selection->payment_request_payment_request_id);
				$ExportDoc->ExportCaption($view_for_payment_refund_selection->scholarship_package_scholarship_package_id);
				$ExportDoc->ExportCaption($view_for_payment_refund_selection->scholarship_payment_id);
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
				$view_for_payment_refund_selection->CssClass = "";
				$view_for_payment_refund_selection->CssStyle = "";
				$view_for_payment_refund_selection->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($view_for_payment_refund_selection->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('sponsored_student_sponsored_student_id', $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->ExportValue($view_for_payment_refund_selection->Export, $view_for_payment_refund_selection->ExportOriginalValue));
					$XmlDoc->AddField('scholarship_type_scholarship_type', $view_for_payment_refund_selection->scholarship_type_scholarship_type->ExportValue($view_for_payment_refund_selection->Export, $view_for_payment_refund_selection->ExportOriginalValue));
					$XmlDoc->AddField('grant_package_grant_package_id', $view_for_payment_refund_selection->grant_package_grant_package_id->ExportValue($view_for_payment_refund_selection->Export, $view_for_payment_refund_selection->ExportOriginalValue));
					$XmlDoc->AddField('schools_school_id', $view_for_payment_refund_selection->schools_school_id->ExportValue($view_for_payment_refund_selection->Export, $view_for_payment_refund_selection->ExportOriginalValue));
					$XmlDoc->AddField('programarea_payingarea_id', $view_for_payment_refund_selection->programarea_payingarea_id->ExportValue($view_for_payment_refund_selection->Export, $view_for_payment_refund_selection->ExportOriginalValue));
					$XmlDoc->AddField('programarea_residentarea_id', $view_for_payment_refund_selection->programarea_residentarea_id->ExportValue($view_for_payment_refund_selection->Export, $view_for_payment_refund_selection->ExportOriginalValue));
					$XmlDoc->AddField('payment_request_payment_request_id', $view_for_payment_refund_selection->payment_request_payment_request_id->ExportValue($view_for_payment_refund_selection->Export, $view_for_payment_refund_selection->ExportOriginalValue));
					$XmlDoc->AddField('scholarship_package_scholarship_package_id', $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->ExportValue($view_for_payment_refund_selection->Export, $view_for_payment_refund_selection->ExportOriginalValue));
					$XmlDoc->AddField('scholarship_payment_id', $view_for_payment_refund_selection->scholarship_payment_id->ExportValue($view_for_payment_refund_selection->Export, $view_for_payment_refund_selection->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($view_for_payment_refund_selection->sponsored_student_sponsored_student_id);
					$ExportDoc->ExportField($view_for_payment_refund_selection->scholarship_type_scholarship_type);
					$ExportDoc->ExportField($view_for_payment_refund_selection->grant_package_grant_package_id);
					$ExportDoc->ExportField($view_for_payment_refund_selection->schools_school_id);
					$ExportDoc->ExportField($view_for_payment_refund_selection->programarea_payingarea_id);
					$ExportDoc->ExportField($view_for_payment_refund_selection->programarea_residentarea_id);
					$ExportDoc->ExportField($view_for_payment_refund_selection->payment_request_payment_request_id);
					$ExportDoc->ExportField($view_for_payment_refund_selection->scholarship_package_scholarship_package_id);
					$ExportDoc->ExportField($view_for_payment_refund_selection->scholarship_payment_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($view_for_payment_refund_selection->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($view_for_payment_refund_selection->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($view_for_payment_refund_selection->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($view_for_payment_refund_selection->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($view_for_payment_refund_selection->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
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
