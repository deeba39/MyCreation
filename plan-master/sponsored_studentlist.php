<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "sponsored_studentinfo.php" ?>
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
$sponsored_student_list = new csponsored_student_list();
$Page =& $sponsored_student_list;

// Page init
$sponsored_student_list->Page_Init();

// Page main
$sponsored_student_list->Page_Main();
?>
<?php include "header.php" ?>
<link rel="stylesheet" href="custom_style/custom.css" >
<?php if ($sponsored_student->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var sponsored_student_list = new ew_Page("sponsored_student_list");

// page properties
sponsored_student_list.PageID = "list"; // page ID
sponsored_student_list.FormID = "fsponsored_studentlist"; // form ID
var EW_PAGE_ID = sponsored_student_list.PageID; // for backward compatibility

// extend page with validate function for search
sponsored_student_list.ValidateSearch = function(fobj) {
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
sponsored_student_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
sponsored_student_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
sponsored_student_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<!--customization-start-->
<script src="custom_javascript/jquery-1.5.min_2.js"></script>
<script src="custom_javascript/jquery.js"></script>
<script src="custom_javascript/custom.js"></script>
<!--customization-end-->
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($sponsored_student->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$sponsored_student_list->lTotalRecs = $sponsored_student->SelectRecordCount();
	} else {
		if ($rs = $sponsored_student_list->LoadRecordset())
			$sponsored_student_list->lTotalRecs = $rs->RecordCount();
	}
	$sponsored_student_list->lStartRec = 1;
	if ($sponsored_student_list->lDisplayRecs <= 0 || ($sponsored_student->Export <> "" && $sponsored_student->ExportAll)) // Display all records
		$sponsored_student_list->lDisplayRecs = $sponsored_student_list->lTotalRecs;
	if (!($sponsored_student->Export <> "" && $sponsored_student->ExportAll))
		$sponsored_student_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $sponsored_student_list->LoadRecordset($sponsored_student_list->lStartRec-1, $sponsored_student_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $sponsored_student->TableCaption() ?>
<?php if ($sponsored_student->Export == "" && $sponsored_student->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $sponsored_student_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $sponsored_student_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $sponsored_student_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($sponsored_student->Export == "" && $sponsored_student->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(sponsored_student_list);" style="text-decoration: none;"><img id="sponsored_student_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="sponsored_student_list_SearchPanel">
<form name="fsponsored_studentlistsrch" id="fsponsored_studentlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return sponsored_student_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="sponsored_student">
<?php
if ($gsSearchError == "")
	$sponsored_student_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$sponsored_student->RowType = EW_ROWTYPE_SEARCH;

// Render row
$sponsored_student_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker"><?php echo $sponsored_student->student_resident_programarea_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_student_resident_programarea_id" id="z_student_resident_programarea_id" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_student_resident_programarea_id" name="x_student_resident_programarea_id" title="<?php echo $sponsored_student->student_resident_programarea_id->FldTitle() ?>"<?php echo $sponsored_student->student_resident_programarea_id->EditAttributes() ?>>
<?php
if (is_array($sponsored_student->student_resident_programarea_id->EditValue)) {
	$arwrk = $sponsored_student->student_resident_programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($sponsored_student->student_resident_programarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($sponsored_student->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $sponsored_student_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="sponsored_studentsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($sponsored_student->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($sponsored_student->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($sponsored_student->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
//customization-start kgosafomaafo
include $custom_include_root.'payment_request_config.php';
//customization-end
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$sponsored_student_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fsponsored_studentlist" id="fsponsored_studentlist" class="ewForm" action="" method="post">
<div id="gmp_sponsored_student" class="ewGridMiddlePanel">
<?php if ($sponsored_student_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $sponsored_student->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$sponsored_student_list->RenderListOptions();

// Render list options (header, left)
$sponsored_student_list->ListOptions->Render("header", "left");
?>
<?php if ($sponsored_student->sponsored_student_id->Visible) { // sponsored_student_id ?>
	<?php if ($sponsored_student->SortUrl($sponsored_student->sponsored_student_id) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student->sponsored_student_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student->SortUrl($sponsored_student->sponsored_student_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student->sponsored_student_id->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($sponsored_student->sponsored_student_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student->sponsored_student_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student->student_firstname->Visible) { // student_firstname ?>
	<?php if ($sponsored_student->SortUrl($sponsored_student->student_firstname) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student->student_firstname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student->SortUrl($sponsored_student->student_firstname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student->student_firstname->FldCaption() ?></td><td style="width: 10px;"><?php if ($sponsored_student->student_firstname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student->student_firstname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student->student_middlename->Visible) { // student_middlename ?>
	<?php if ($sponsored_student->SortUrl($sponsored_student->student_middlename) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student->student_middlename->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student->SortUrl($sponsored_student->student_middlename) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student->student_middlename->FldCaption() ?></td><td style="width: 10px;"><?php if ($sponsored_student->student_middlename->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student->student_middlename->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student->student_lastname->Visible) { // student_lastname ?>
	<?php if ($sponsored_student->SortUrl($sponsored_student->student_lastname) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student->student_lastname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student->SortUrl($sponsored_student->student_lastname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student->student_lastname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($sponsored_student->student_lastname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student->student_lastname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student->student_applicant_student_applicant_id->Visible) { // student_applicant_student_applicant_id ?>
	<?php if ($sponsored_student->SortUrl($sponsored_student->student_applicant_student_applicant_id) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student->student_applicant_student_applicant_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student->SortUrl($sponsored_student->student_applicant_student_applicant_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student->student_applicant_student_applicant_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($sponsored_student->student_applicant_student_applicant_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student->student_applicant_student_applicant_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sponsored_student->student_resident_programarea_id->Visible) { // student_resident_programarea_id ?>
	<?php if ($sponsored_student->SortUrl($sponsored_student->student_resident_programarea_id) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $sponsored_student->student_resident_programarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sponsored_student->SortUrl($sponsored_student->student_resident_programarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $sponsored_student->student_resident_programarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($sponsored_student->student_resident_programarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sponsored_student->student_resident_programarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$sponsored_student_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($sponsored_student->ExportAll && $sponsored_student->Export <> "") {
	$sponsored_student_list->lStopRec = $sponsored_student_list->lTotalRecs;
} else {
	$sponsored_student_list->lStopRec = $sponsored_student_list->lStartRec + $sponsored_student_list->lDisplayRecs - 1; // Set the last record to display
}
$sponsored_student_list->lRecCount = $sponsored_student_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $sponsored_student_list->lStartRec > 1)
		$rs->Move($sponsored_student_list->lStartRec - 1);
}

// Initialize aggregate
$sponsored_student->RowType = EW_ROWTYPE_AGGREGATEINIT;
$sponsored_student_list->RenderRow();
$sponsored_student_list->lRowCnt = 0;
while (($sponsored_student->CurrentAction == "gridadd" || !$rs->EOF) &&
	$sponsored_student_list->lRecCount < $sponsored_student_list->lStopRec) {
	$sponsored_student_list->lRecCount++;
	if (intval($sponsored_student_list->lRecCount) >= intval($sponsored_student_list->lStartRec)) {
		$sponsored_student_list->lRowCnt++;

	// Init row class and style
	$sponsored_student->CssClass = "";
	$sponsored_student->CssStyle = "";
	$sponsored_student->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($sponsored_student->CurrentAction == "gridadd") {
		$sponsored_student_list->LoadDefaultValues(); // Load default values
	} else {
		$sponsored_student_list->LoadRowValues($rs); // Load row values
	}
	$sponsored_student->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$sponsored_student_list->RenderRow();

	// Render list options
	$sponsored_student_list->RenderListOptions();
?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
<?php

// Render list options (body, left)
$sponsored_student_list->ListOptions->Render("body", "left");
?>
	<?php if ($sponsored_student->sponsored_student_id->Visible) { // sponsored_student_id ?>
		<td<?php echo $sponsored_student->sponsored_student_id->CellAttributes() ?>>
<div<?php echo $sponsored_student->sponsored_student_id->ViewAttributes() ?>><?php echo $sponsored_student->sponsored_student_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student->student_firstname->Visible) { // student_firstname ?>
		<td<?php echo $sponsored_student->student_firstname->CellAttributes() ?>>
<div<?php echo $sponsored_student->student_firstname->ViewAttributes() ?>><?php echo $sponsored_student->student_firstname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student->student_middlename->Visible) { // student_middlename ?>
		<td<?php echo $sponsored_student->student_middlename->CellAttributes() ?>>
<div<?php echo $sponsored_student->student_middlename->ViewAttributes() ?>><?php echo $sponsored_student->student_middlename->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student->student_lastname->Visible) { // student_lastname ?>
		<td<?php echo $sponsored_student->student_lastname->CellAttributes() ?>>
<div<?php echo $sponsored_student->student_lastname->ViewAttributes() ?>><?php echo $sponsored_student->student_lastname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student->student_applicant_student_applicant_id->Visible) { // student_applicant_student_applicant_id ?>
		<td<?php echo $sponsored_student->student_applicant_student_applicant_id->CellAttributes() ?>>
<div<?php echo $sponsored_student->student_applicant_student_applicant_id->ViewAttributes() ?>><?php echo $sponsored_student->student_applicant_student_applicant_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sponsored_student->student_resident_programarea_id->Visible) { // student_resident_programarea_id ?>
		<td<?php echo $sponsored_student->student_resident_programarea_id->CellAttributes() ?>>
<div<?php echo $sponsored_student->student_resident_programarea_id->ViewAttributes() ?>><?php echo $sponsored_student->student_resident_programarea_id->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$sponsored_student_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($sponsored_student->CurrentAction <> "gridadd")
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
<?php if ($sponsored_student->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($sponsored_student->CurrentAction <> "gridadd" && $sponsored_student->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($sponsored_student_list->Pager)) $sponsored_student_list->Pager = new cPrevNextPager($sponsored_student_list->lStartRec, $sponsored_student_list->lDisplayRecs, $sponsored_student_list->lTotalRecs) ?>
<?php if ($sponsored_student_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($sponsored_student_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $sponsored_student_list->PageUrl() ?>start=<?php echo $sponsored_student_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($sponsored_student_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $sponsored_student_list->PageUrl() ?>start=<?php echo $sponsored_student_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $sponsored_student_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($sponsored_student_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $sponsored_student_list->PageUrl() ?>start=<?php echo $sponsored_student_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($sponsored_student_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $sponsored_student_list->PageUrl() ?>start=<?php echo $sponsored_student_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $sponsored_student_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $sponsored_student_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $sponsored_student_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $sponsored_student_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($sponsored_student_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($sponsored_student_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($sponsored_student->Export == "" && $sponsored_student->CurrentAction == "") { ?>
<?php } ?>
<?php if ($sponsored_student->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$sponsored_student_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csponsored_student_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'sponsored_student';

	// Page object name
	var $PageObjName = 'sponsored_student_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $sponsored_student;
		if ($sponsored_student->UseTokenInUrl) $PageUrl .= "t=" . $sponsored_student->TableVar . "&"; // Add page token
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
		global $objForm, $sponsored_student;
		if ($sponsored_student->UseTokenInUrl) {
			if ($objForm)
				return ($sponsored_student->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($sponsored_student->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csponsored_student_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (sponsored_student)
		$GLOBALS["sponsored_student"] = new csponsored_student();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["sponsored_student"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "sponsored_studentdelete.php";
		$this->MultiUpdateUrl = "sponsored_studentupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'sponsored_student', TRUE);

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
		global $sponsored_student;

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
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate();
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$sponsored_student->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$sponsored_student->Export = $_POST["exporttype"];
		} else {
			$sponsored_student->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $sponsored_student->Export; // Get export parameter, used in header
		$gsExportFile = $sponsored_student->TableVar; // Get export file, used in header
		if ($sponsored_student->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($sponsored_student->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $sponsored_student;

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
			$sponsored_student->Recordset_SearchValidated();

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
		if ($sponsored_student->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $sponsored_student->getRecordsPerPage(); // Restore from Session
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
		$sponsored_student->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$sponsored_student->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$sponsored_student->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $sponsored_student->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$sponsored_student->setSessionWhere($sFilter);
		$sponsored_student->CurrentFilter = "";

		// Export data only
		if (in_array($sponsored_student->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($sponsored_student->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $sponsored_student;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $sponsored_student->sponsored_student_id, FALSE); // sponsored_student_id
		$this->BuildSearchSql($sWhere, $sponsored_student->student_firstname, FALSE); // student_firstname
		$this->BuildSearchSql($sWhere, $sponsored_student->student_middlename, FALSE); // student_middlename
		$this->BuildSearchSql($sWhere, $sponsored_student->student_lastname, FALSE); // student_lastname
		$this->BuildSearchSql($sWhere, $sponsored_student->student_grades, FALSE); // student_grades
		$this->BuildSearchSql($sWhere, $sponsored_student->student_resident_programarea_id, FALSE); // student_resident_programarea_id
		$this->BuildSearchSql($sWhere, $sponsored_student->group_id, FALSE); // group_id
		$this->BuildSearchSql($sWhere, $sponsored_student->community_community_id, FALSE); // community_community_id

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($sponsored_student->sponsored_student_id); // sponsored_student_id
			$this->SetSearchParm($sponsored_student->student_firstname); // student_firstname
			$this->SetSearchParm($sponsored_student->student_middlename); // student_middlename
			$this->SetSearchParm($sponsored_student->student_lastname); // student_lastname
			$this->SetSearchParm($sponsored_student->student_grades); // student_grades
			$this->SetSearchParm($sponsored_student->student_resident_programarea_id); // student_resident_programarea_id
			$this->SetSearchParm($sponsored_student->group_id); // group_id
			$this->SetSearchParm($sponsored_student->community_community_id); // community_community_id
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
		global $sponsored_student;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$sponsored_student->setAdvancedSearch("x_$FldParm", $FldVal);
		$sponsored_student->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$sponsored_student->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$sponsored_student->setAdvancedSearch("y_$FldParm", $FldVal2);
		$sponsored_student->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $sponsored_student;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $sponsored_student->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $sponsored_student->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $sponsored_student->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $sponsored_student->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $sponsored_student->GetAdvancedSearch("w_$FldParm");
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
		global $sponsored_student;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		if (is_numeric($Keyword)) $this->BuildBasicSearchSQL($sWhere, $sponsored_student->sponsored_student_id, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $sponsored_student->student_lastname, $Keyword);
		if (is_numeric($Keyword)) $this->BuildBasicSearchSQL($sWhere, $sponsored_student->student_resident_programarea_id, $Keyword);
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
		global $Security, $sponsored_student;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $sponsored_student->BasicSearchKeyword;
		$sSearchType = $sponsored_student->BasicSearchType;
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
			$sponsored_student->setSessionBasicSearchKeyword($sSearchKeyword);
			$sponsored_student->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $sponsored_student;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$sponsored_student->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $sponsored_student;
		$sponsored_student->setSessionBasicSearchKeyword("");
		$sponsored_student->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $sponsored_student;
		$sponsored_student->setAdvancedSearch("x_sponsored_student_id", "");
		$sponsored_student->setAdvancedSearch("x_student_firstname", "");
		$sponsored_student->setAdvancedSearch("z_student_firstname", "");
		$sponsored_student->setAdvancedSearch("y_student_firstname", "");
		$sponsored_student->setAdvancedSearch("x_student_middlename", "");
		$sponsored_student->setAdvancedSearch("z_student_middlename", "");
		$sponsored_student->setAdvancedSearch("y_student_middlename", "");
		$sponsored_student->setAdvancedSearch("x_student_lastname", "");
		$sponsored_student->setAdvancedSearch("z_student_lastname", "");
		$sponsored_student->setAdvancedSearch("y_student_lastname", "");
		$sponsored_student->setAdvancedSearch("x_student_grades", "");
		$sponsored_student->setAdvancedSearch("x_student_resident_programarea_id", "");
		$sponsored_student->setAdvancedSearch("x_group_id", "");
		$sponsored_student->setAdvancedSearch("x_community_community_id", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $sponsored_student;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_sponsored_student_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_firstname"] <> "") $bRestore = FALSE;
		if (@$_GET["y_student_firstname"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_middlename"] <> "") $bRestore = FALSE;
		if (@$_GET["y_student_middlename"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_lastname"] <> "") $bRestore = FALSE;
		if (@$_GET["y_student_lastname"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_grades"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_resident_programarea_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_group_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_community_community_id"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$sponsored_student->BasicSearchKeyword = $sponsored_student->getSessionBasicSearchKeyword();
			$sponsored_student->BasicSearchType = $sponsored_student->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($sponsored_student->sponsored_student_id);
			$this->GetSearchParm($sponsored_student->student_firstname);
			$this->GetSearchParm($sponsored_student->student_middlename);
			$this->GetSearchParm($sponsored_student->student_lastname);
			$this->GetSearchParm($sponsored_student->student_grades);
			$this->GetSearchParm($sponsored_student->student_resident_programarea_id);
			$this->GetSearchParm($sponsored_student->group_id);
			$this->GetSearchParm($sponsored_student->community_community_id);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $sponsored_student;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$sponsored_student->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$sponsored_student->CurrentOrderType = @$_GET["ordertype"];
			$sponsored_student->UpdateSort($sponsored_student->sponsored_student_id); // sponsored_student_id
			$sponsored_student->UpdateSort($sponsored_student->student_firstname); // student_firstname
			$sponsored_student->UpdateSort($sponsored_student->student_middlename); // student_middlename
			$sponsored_student->UpdateSort($sponsored_student->student_lastname); // student_lastname
			$sponsored_student->UpdateSort($sponsored_student->student_applicant_student_applicant_id); // student_applicant_student_applicant_id
			$sponsored_student->UpdateSort($sponsored_student->student_resident_programarea_id); // student_resident_programarea_id
			$sponsored_student->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $sponsored_student;
		$sOrderBy = $sponsored_student->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($sponsored_student->SqlOrderBy() <> "") {
				$sOrderBy = $sponsored_student->SqlOrderBy();
				$sponsored_student->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $sponsored_student;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$sponsored_student->setSessionOrderBy($sOrderBy);
				$sponsored_student->sponsored_student_id->setSort("");
				$sponsored_student->student_firstname->setSort("");
				$sponsored_student->student_middlename->setSort("");
				$sponsored_student->student_lastname->setSort("");
				$sponsored_student->student_applicant_student_applicant_id->setSort("");
				$sponsored_student->student_resident_programarea_id->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$sponsored_student->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $sponsored_student;

                //customization-start kgosafomaafo
		global $custom_include_root;
		include $custom_include_root.'sponsored_student_row_init.php';
		//customization-end
                //
		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = FALSE;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = FALSE;

		// "detail_school_attendance"
		$this->ListOptions->Add("detail_school_attendance");
		$item =& $this->ListOptions->Items["detail_school_attendance"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('school_attendance');
		$item->OnLeft = FALSE;

		// "detail_scholarship_package"
		$this->ListOptions->Add("detail_scholarship_package");
		$item =& $this->ListOptions->Items["detail_scholarship_package"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('scholarship_package');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($sponsored_student->Export <> "" ||
			$sponsored_student->CurrentAction == "gridadd" ||
			$sponsored_student->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $sponsored_student;
		$this->ListOptions->LoadDefault();

                 //customization-start kgosafomaafo
		global $custom_include_root;
		include $custom_include_root.'sponsored_student_row_use.php';
		//customization-end
                //
		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $this->ShowOptionLink() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . "<img src=\"images/view.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $this->ShowOptionLink() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . "<img src=\"images/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		}

		// "detail_school_attendance"
		$oListOpt =& $this->ListOptions->Items["detail_school_attendance"];
		if ($Security->AllowList('school_attendance') && $this->ShowOptionLink()) {
			$oListOpt->Body = "<img src=\"images/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("school_attendance", "TblCaption");
			$oListOpt->Body = "<a href=\"school_attendancelist.php?" . EW_TABLE_SHOW_MASTER . "=sponsored_student&sponsored_student_id=" . urlencode(strval($sponsored_student->sponsored_student_id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_scholarship_package"
		$oListOpt =& $this->ListOptions->Items["detail_scholarship_package"];
		if ($Security->AllowList('scholarship_package') && $this->ShowOptionLink()) {
			$oListOpt->Body = "<img src=\"images/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("scholarship_package", "TblCaption");
			$oListOpt->Body = "<a href=\"scholarship_packagelist.php?" . EW_TABLE_SHOW_MASTER . "=sponsored_student&sponsored_student_id=" . urlencode(strval($sponsored_student->sponsored_student_id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $sponsored_student;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $sponsored_student;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$sponsored_student->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$sponsored_student->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $sponsored_student->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$sponsored_student->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$sponsored_student->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$sponsored_student->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $sponsored_student;
		$sponsored_student->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$sponsored_student->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $sponsored_student;

		// Load search values
		// sponsored_student_id

		$sponsored_student->sponsored_student_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_sponsored_student_id"]);
		$sponsored_student->sponsored_student_id->AdvancedSearch->SearchOperator = @$_GET["z_sponsored_student_id"];

		// student_firstname
		$sponsored_student->student_firstname->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_firstname"]);
		$sponsored_student->student_firstname->AdvancedSearch->SearchOperator = @$_GET["z_student_firstname"];
		$sponsored_student->student_firstname->AdvancedSearch->SearchCondition = @$_GET["v_student_firstname"];
		$sponsored_student->student_firstname->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_student_firstname"]);
		$sponsored_student->student_firstname->AdvancedSearch->SearchOperator2 = @$_GET["w_student_firstname"];

		// student_middlename
		$sponsored_student->student_middlename->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_middlename"]);
		$sponsored_student->student_middlename->AdvancedSearch->SearchOperator = @$_GET["z_student_middlename"];
		$sponsored_student->student_middlename->AdvancedSearch->SearchCondition = @$_GET["v_student_middlename"];
		$sponsored_student->student_middlename->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_student_middlename"]);
		$sponsored_student->student_middlename->AdvancedSearch->SearchOperator2 = @$_GET["w_student_middlename"];

		// student_lastname
		$sponsored_student->student_lastname->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_lastname"]);
		$sponsored_student->student_lastname->AdvancedSearch->SearchOperator = @$_GET["z_student_lastname"];
		$sponsored_student->student_lastname->AdvancedSearch->SearchCondition = @$_GET["v_student_lastname"];
		$sponsored_student->student_lastname->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_student_lastname"]);
		$sponsored_student->student_lastname->AdvancedSearch->SearchOperator2 = @$_GET["w_student_lastname"];

		// student_grades
		$sponsored_student->student_grades->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_grades"]);
		$sponsored_student->student_grades->AdvancedSearch->SearchOperator = @$_GET["z_student_grades"];

		// student_resident_programarea_id
		$sponsored_student->student_resident_programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_resident_programarea_id"]);
		$sponsored_student->student_resident_programarea_id->AdvancedSearch->SearchOperator = @$_GET["z_student_resident_programarea_id"];

		// group_id
		$sponsored_student->group_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_group_id"]);
		$sponsored_student->group_id->AdvancedSearch->SearchOperator = @$_GET["z_group_id"];

		// community_community_id
		$sponsored_student->community_community_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_community_community_id"]);
		$sponsored_student->community_community_id->AdvancedSearch->SearchOperator = @$_GET["z_community_community_id"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $sponsored_student;

		// Call Recordset Selecting event
		$sponsored_student->Recordset_Selecting($sponsored_student->CurrentFilter);

		// Load List page SQL
		$sSql = $sponsored_student->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$sponsored_student->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $sponsored_student;
		$sFilter = $sponsored_student->KeyFilter();

		// Call Row Selecting event
		$sponsored_student->Row_Selecting($sFilter);

		// Load SQL based on filter
		$sponsored_student->CurrentFilter = $sFilter;
		$sSql = $sponsored_student->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$sponsored_student->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $sponsored_student;
		$sponsored_student->sponsored_student_id->setDbValue($rs->fields('sponsored_student_id'));
		$sponsored_student->student_firstname->setDbValue($rs->fields('student_firstname'));
		$sponsored_student->student_middlename->setDbValue($rs->fields('student_middlename'));
		$sponsored_student->student_lastname->setDbValue($rs->fields('student_lastname'));
		$sponsored_student->student_picture->Upload->DbValue = $rs->fields('student_picture');
		$sponsored_student->student_grades->setDbValue($rs->fields('student_grades'));
		$sponsored_student->student_applicant_student_applicant_id->setDbValue($rs->fields('student_applicant_student_applicant_id'));
		$sponsored_student->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
		$sponsored_student->group_id->setDbValue($rs->fields('group_id'));
		$sponsored_student->community_community_id->setDbValue($rs->fields('community_community_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $sponsored_student;

		// Initialize URLs
		$this->ViewUrl = $sponsored_student->ViewUrl();
		$this->EditUrl = $sponsored_student->EditUrl();
		$this->InlineEditUrl = $sponsored_student->InlineEditUrl();
		$this->CopyUrl = $sponsored_student->CopyUrl();
		$this->InlineCopyUrl = $sponsored_student->InlineCopyUrl();
		$this->DeleteUrl = $sponsored_student->DeleteUrl();

		// Call Row_Rendering event
		$sponsored_student->Row_Rendering();

		// Common render codes for all row types
		// sponsored_student_id

		$sponsored_student->sponsored_student_id->CellCssStyle = "white-space: nowrap;"; $sponsored_student->sponsored_student_id->CellCssClass = "";
		$sponsored_student->sponsored_student_id->CellAttrs = array(); $sponsored_student->sponsored_student_id->ViewAttrs = array(); $sponsored_student->sponsored_student_id->EditAttrs = array();

		// student_firstname
		$sponsored_student->student_firstname->CellCssStyle = "white-space: nowrap;"; $sponsored_student->student_firstname->CellCssClass = "";
		$sponsored_student->student_firstname->CellAttrs = array(); $sponsored_student->student_firstname->ViewAttrs = array(); $sponsored_student->student_firstname->EditAttrs = array();

		// student_middlename
		$sponsored_student->student_middlename->CellCssStyle = "white-space: nowrap;"; $sponsored_student->student_middlename->CellCssClass = "";
		$sponsored_student->student_middlename->CellAttrs = array(); $sponsored_student->student_middlename->ViewAttrs = array(); $sponsored_student->student_middlename->EditAttrs = array();

		// student_lastname
		$sponsored_student->student_lastname->CellCssStyle = "white-space: nowrap;"; $sponsored_student->student_lastname->CellCssClass = "";
		$sponsored_student->student_lastname->CellAttrs = array(); $sponsored_student->student_lastname->ViewAttrs = array(); $sponsored_student->student_lastname->EditAttrs = array();

		// student_applicant_student_applicant_id
		$sponsored_student->student_applicant_student_applicant_id->CellCssStyle = "white-space: nowrap;"; $sponsored_student->student_applicant_student_applicant_id->CellCssClass = "";
		$sponsored_student->student_applicant_student_applicant_id->CellAttrs = array(); $sponsored_student->student_applicant_student_applicant_id->ViewAttrs = array(); $sponsored_student->student_applicant_student_applicant_id->EditAttrs = array();

		// student_resident_programarea_id
		$sponsored_student->student_resident_programarea_id->CellCssStyle = "white-space: nowrap;"; $sponsored_student->student_resident_programarea_id->CellCssClass = "";
		$sponsored_student->student_resident_programarea_id->CellAttrs = array(); $sponsored_student->student_resident_programarea_id->ViewAttrs = array(); $sponsored_student->student_resident_programarea_id->EditAttrs = array();
		if ($sponsored_student->RowType == EW_ROWTYPE_VIEW) { // View row

			// sponsored_student_id
			$sponsored_student->sponsored_student_id->ViewValue = $sponsored_student->sponsored_student_id->CurrentValue;
			$sponsored_student->sponsored_student_id->CssStyle = "";
			$sponsored_student->sponsored_student_id->CssClass = "";
			$sponsored_student->sponsored_student_id->ViewCustomAttributes = "";

			// student_firstname
			$sponsored_student->student_firstname->ViewValue = $sponsored_student->student_firstname->CurrentValue;
			$sponsored_student->student_firstname->CssStyle = "";
			$sponsored_student->student_firstname->CssClass = "";
			$sponsored_student->student_firstname->ViewCustomAttributes = "";

			// student_middlename
			$sponsored_student->student_middlename->ViewValue = $sponsored_student->student_middlename->CurrentValue;
			$sponsored_student->student_middlename->CssStyle = "";
			$sponsored_student->student_middlename->CssClass = "";
			$sponsored_student->student_middlename->ViewCustomAttributes = "";

			// student_lastname
			$sponsored_student->student_lastname->ViewValue = $sponsored_student->student_lastname->CurrentValue;
			$sponsored_student->student_lastname->CssStyle = "";
			$sponsored_student->student_lastname->CssClass = "";
			$sponsored_student->student_lastname->ViewCustomAttributes = "";

			// student_applicant_student_applicant_id
			$sponsored_student->student_applicant_student_applicant_id->ViewValue = $sponsored_student->student_applicant_student_applicant_id->CurrentValue;
			if (strval($sponsored_student->student_applicant_student_applicant_id->CurrentValue) <> "") {
				$sFilterWrk = "`student_applicant_id` = " . ew_AdjustSql($sponsored_student->student_applicant_student_applicant_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `student_lastname`, `student_firstname` FROM `student_applicant`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sponsored_student->student_applicant_student_applicant_id->ViewValue = $rswrk->fields('student_lastname');
					$sponsored_student->student_applicant_student_applicant_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('student_firstname');
					$rswrk->Close();
				} else {
					$sponsored_student->student_applicant_student_applicant_id->ViewValue = $sponsored_student->student_applicant_student_applicant_id->CurrentValue;
				}
			} else {
				$sponsored_student->student_applicant_student_applicant_id->ViewValue = NULL;
			}
			$sponsored_student->student_applicant_student_applicant_id->CssStyle = "";
			$sponsored_student->student_applicant_student_applicant_id->CssClass = "";
			$sponsored_student->student_applicant_student_applicant_id->ViewCustomAttributes = "";

			// student_resident_programarea_id
			if (strval($sponsored_student->student_resident_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($sponsored_student->student_resident_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sponsored_student->student_resident_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$sponsored_student->student_resident_programarea_id->ViewValue = $sponsored_student->student_resident_programarea_id->CurrentValue;
				}
			} else {
				$sponsored_student->student_resident_programarea_id->ViewValue = NULL;
			}
			$sponsored_student->student_resident_programarea_id->CssStyle = "";
			$sponsored_student->student_resident_programarea_id->CssClass = "";
			$sponsored_student->student_resident_programarea_id->ViewCustomAttributes = "";

			// sponsored_student_id
			$sponsored_student->sponsored_student_id->HrefValue = "";
			$sponsored_student->sponsored_student_id->TooltipValue = "";

			// student_firstname
			$sponsored_student->student_firstname->HrefValue = "";
			$sponsored_student->student_firstname->TooltipValue = "";

			// student_middlename
			$sponsored_student->student_middlename->HrefValue = "";
			$sponsored_student->student_middlename->TooltipValue = "";

			// student_lastname
			$sponsored_student->student_lastname->HrefValue = "";
			$sponsored_student->student_lastname->TooltipValue = "";

			// student_applicant_student_applicant_id
			$sponsored_student->student_applicant_student_applicant_id->HrefValue = "";
			$sponsored_student->student_applicant_student_applicant_id->TooltipValue = "";

			// student_resident_programarea_id
			$sponsored_student->student_resident_programarea_id->HrefValue = "";
			$sponsored_student->student_resident_programarea_id->TooltipValue = "";
		} elseif ($sponsored_student->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// sponsored_student_id
			$sponsored_student->sponsored_student_id->EditCustomAttributes = "";
			$sponsored_student->sponsored_student_id->EditValue = ew_HtmlEncode($sponsored_student->sponsored_student_id->AdvancedSearch->SearchValue);

			// student_firstname
			$sponsored_student->student_firstname->EditCustomAttributes = "";
			$sponsored_student->student_firstname->EditValue = ew_HtmlEncode($sponsored_student->student_firstname->AdvancedSearch->SearchValue);
			$sponsored_student->student_firstname->EditCustomAttributes = "";
			$sponsored_student->student_firstname->EditValue2 = ew_HtmlEncode($sponsored_student->student_firstname->AdvancedSearch->SearchValue2);

			// student_middlename
			$sponsored_student->student_middlename->EditCustomAttributes = "";
			$sponsored_student->student_middlename->EditValue = ew_HtmlEncode($sponsored_student->student_middlename->AdvancedSearch->SearchValue);
			$sponsored_student->student_middlename->EditCustomAttributes = "";
			$sponsored_student->student_middlename->EditValue2 = ew_HtmlEncode($sponsored_student->student_middlename->AdvancedSearch->SearchValue2);

			// student_lastname
			$sponsored_student->student_lastname->EditCustomAttributes = "";
			$sponsored_student->student_lastname->EditValue = ew_HtmlEncode($sponsored_student->student_lastname->AdvancedSearch->SearchValue);
			$sponsored_student->student_lastname->EditCustomAttributes = "";
			$sponsored_student->student_lastname->EditValue2 = ew_HtmlEncode($sponsored_student->student_lastname->AdvancedSearch->SearchValue2);

			// student_applicant_student_applicant_id
			$sponsored_student->student_applicant_student_applicant_id->EditCustomAttributes = "";
			$sponsored_student->student_applicant_student_applicant_id->EditValue = ew_HtmlEncode($sponsored_student->student_applicant_student_applicant_id->AdvancedSearch->SearchValue);

			// student_resident_programarea_id
			$sponsored_student->student_resident_programarea_id->EditCustomAttributes = "";
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
			$sponsored_student->student_resident_programarea_id->EditValue = $arwrk;
		}

		// Call Row Rendered event
		if ($sponsored_student->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$sponsored_student->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $sponsored_student;

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
		global $sponsored_student;
		$sponsored_student->sponsored_student_id->AdvancedSearch->SearchValue = $sponsored_student->getAdvancedSearch("x_sponsored_student_id");
		$sponsored_student->student_firstname->AdvancedSearch->SearchValue = $sponsored_student->getAdvancedSearch("x_student_firstname");
		$sponsored_student->student_firstname->AdvancedSearch->SearchOperator = $sponsored_student->getAdvancedSearch("z_student_firstname");
		$sponsored_student->student_firstname->AdvancedSearch->SearchValue2 = $sponsored_student->getAdvancedSearch("y_student_firstname");
		$sponsored_student->student_middlename->AdvancedSearch->SearchValue = $sponsored_student->getAdvancedSearch("x_student_middlename");
		$sponsored_student->student_middlename->AdvancedSearch->SearchOperator = $sponsored_student->getAdvancedSearch("z_student_middlename");
		$sponsored_student->student_middlename->AdvancedSearch->SearchValue2 = $sponsored_student->getAdvancedSearch("y_student_middlename");
		$sponsored_student->student_lastname->AdvancedSearch->SearchValue = $sponsored_student->getAdvancedSearch("x_student_lastname");
		$sponsored_student->student_lastname->AdvancedSearch->SearchOperator = $sponsored_student->getAdvancedSearch("z_student_lastname");
		$sponsored_student->student_lastname->AdvancedSearch->SearchValue2 = $sponsored_student->getAdvancedSearch("y_student_lastname");
		$sponsored_student->student_grades->AdvancedSearch->SearchValue = $sponsored_student->getAdvancedSearch("x_student_grades");
		$sponsored_student->student_resident_programarea_id->AdvancedSearch->SearchValue = $sponsored_student->getAdvancedSearch("x_student_resident_programarea_id");
		$sponsored_student->group_id->AdvancedSearch->SearchValue = $sponsored_student->getAdvancedSearch("x_group_id");
		$sponsored_student->community_community_id->AdvancedSearch->SearchValue = $sponsored_student->getAdvancedSearch("x_community_community_id");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $sponsored_student;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $sponsored_student->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($sponsored_student->ExportAll) {
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
		if ($sponsored_student->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($sponsored_student, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($sponsored_student->sponsored_student_id);
				$ExportDoc->ExportCaption($sponsored_student->student_firstname);
				$ExportDoc->ExportCaption($sponsored_student->student_middlename);
				$ExportDoc->ExportCaption($sponsored_student->student_lastname);
				$ExportDoc->ExportCaption($sponsored_student->student_applicant_student_applicant_id);
				$ExportDoc->ExportCaption($sponsored_student->student_resident_programarea_id);
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
				$sponsored_student->CssClass = "";
				$sponsored_student->CssStyle = "";
				$sponsored_student->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($sponsored_student->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('sponsored_student_id', $sponsored_student->sponsored_student_id->ExportValue($sponsored_student->Export, $sponsored_student->ExportOriginalValue));
					$XmlDoc->AddField('student_firstname', $sponsored_student->student_firstname->ExportValue($sponsored_student->Export, $sponsored_student->ExportOriginalValue));
					$XmlDoc->AddField('student_middlename', $sponsored_student->student_middlename->ExportValue($sponsored_student->Export, $sponsored_student->ExportOriginalValue));
					$XmlDoc->AddField('student_lastname', $sponsored_student->student_lastname->ExportValue($sponsored_student->Export, $sponsored_student->ExportOriginalValue));
					$XmlDoc->AddField('student_applicant_student_applicant_id', $sponsored_student->student_applicant_student_applicant_id->ExportValue($sponsored_student->Export, $sponsored_student->ExportOriginalValue));
					$XmlDoc->AddField('student_resident_programarea_id', $sponsored_student->student_resident_programarea_id->ExportValue($sponsored_student->Export, $sponsored_student->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($sponsored_student->sponsored_student_id);
					$ExportDoc->ExportField($sponsored_student->student_firstname);
					$ExportDoc->ExportField($sponsored_student->student_middlename);
					$ExportDoc->ExportField($sponsored_student->student_lastname);
					$ExportDoc->ExportField($sponsored_student->student_applicant_student_applicant_id);
					$ExportDoc->ExportField($sponsored_student->student_resident_programarea_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($sponsored_student->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($sponsored_student->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($sponsored_student->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($sponsored_student->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($sponsored_student->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $sponsored_student;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($sponsored_student->group_id->CurrentValue);
			}
		}
		return TRUE;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'sponsored_student';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
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
    //$this->ListOptions->Add("detail");
    //$this->ListOptions->Items["detail"]->OnLeft = FALSE; // Link on left
    //$this->ListOptions->Itmes["detail"]->Visible=TRUE;
    
    
}

		// ListOptions Rendered event
function ListOptions_Rendered() {
    // Example:
    global $sponsored_student;
        //$this->ListOptions->Items["details"]->Body = "<a href='student_applicantview.php?student_applicant_id={$sponsored_student->student_applicant_student_applicant_id->CurrentValue}'>application</a>";
}


}
?>
