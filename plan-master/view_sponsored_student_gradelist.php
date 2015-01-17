<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "view_sponsored_student_gradeinfo.php" ?>
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
include_once("ext/applicants.php");
$app=new applicants();
$programarea_id=0;
$grade_year=(int)$app->get_grade_record_year();


// Create page object
$view_sponsored_student_grade_list = new cview_sponsored_student_grade_list();
$Page =& $view_sponsored_student_grade_list;

// Page init
$view_sponsored_student_grade_list->Page_Init();

// Page main
$view_sponsored_student_grade_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($view_sponsored_student_grade->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var view_sponsored_student_grade_list = new ew_Page("view_sponsored_student_grade_list");

// page properties
view_sponsored_student_grade_list.PageID = "list"; // page ID
view_sponsored_student_grade_list.FormID = "fview_sponsored_student_gradelist"; // form ID
var EW_PAGE_ID = view_sponsored_student_grade_list.PageID; // for backward compatibility

// extend page with validate function for search
view_sponsored_student_grade_list.ValidateSearch = function(fobj) {
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
view_sponsored_student_grade_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
view_sponsored_student_grade_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
view_sponsored_student_grade_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($view_sponsored_student_grade->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$view_sponsored_student_grade_list->lTotalRecs = $view_sponsored_student_grade->SelectRecordCount();
	} else {
		if ($rs = $view_sponsored_student_grade_list->LoadRecordset())
			$view_sponsored_student_grade_list->lTotalRecs = $rs->RecordCount();
	}
	$view_sponsored_student_grade_list->lStartRec = 1;
	if ($view_sponsored_student_grade_list->lDisplayRecs <= 0 || ($view_sponsored_student_grade->Export <> "" && $view_sponsored_student_grade->ExportAll)) // Display all records
		$view_sponsored_student_grade_list->lDisplayRecs = $view_sponsored_student_grade_list->lTotalRecs;
	if (!($view_sponsored_student_grade->Export <> "" && $view_sponsored_student_grade->ExportAll))
		$view_sponsored_student_grade_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $view_sponsored_student_grade_list->LoadRecordset($view_sponsored_student_grade_list->lStartRec-1, $view_sponsored_student_grade_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $view_sponsored_student_grade->TableCaption() ?>
<?php if ($view_sponsored_student_grade->Export == "" && $view_sponsored_student_grade->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $view_sponsored_student_grade_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $view_sponsored_student_grade_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $view_sponsored_student_grade_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($view_sponsored_student_grade->Export == "" && $view_sponsored_student_grade->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(view_sponsored_student_grade_list);" style="text-decoration: none;"><img id="view_sponsored_student_grade_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="view_sponsored_student_grade_list_SearchPanel">
<form name="fview_sponsored_student_gradelistsrch" id="fview_sponsored_student_gradelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return view_sponsored_student_grade_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="view_sponsored_student_grade">
<?php
if ($gsSearchError == "")
	$view_sponsored_student_grade_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$view_sponsored_student_grade->RowType = EW_ROWTYPE_SEARCH;

// Render row
$view_sponsored_student_grade_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker"><?php echo $view_sponsored_student_grade->student_resident_programarea_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_student_resident_programarea_id" id="z_student_resident_programarea_id" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_student_resident_programarea_id" name="x_student_resident_programarea_id" title="<?php echo $view_sponsored_student_grade->student_resident_programarea_id->FldTitle() ?>"<?php echo $view_sponsored_student_grade->student_resident_programarea_id->EditAttributes() ?>>
<?php
if (is_array($view_sponsored_student_grade->student_resident_programarea_id->EditValue)) {
	$arwrk = $view_sponsored_student_grade->student_resident_programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($view_sponsored_student_grade->student_resident_programarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($view_sponsored_student_grade->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $view_sponsored_student_grade_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($view_sponsored_student_grade->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($view_sponsored_student_grade->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($view_sponsored_student_grade->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$view_sponsored_student_grade_list->ShowMessage();
?>
<?php
if($grade_year==false)
{
    echo "Grade recording is not open";
    exit();
}
else
{
    echo "Academic Year: $grade_year";
}
?>
<?php include "ext/recordgrade_form.php" ?>
<?php echo "<script>academic_year=$grade_year;</script>";?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fview_sponsored_student_gradelist" id="fview_sponsored_student_gradelist" class="ewForm" action="" method="post">
<div id="gmp_view_sponsored_student_grade" class="ewGridMiddlePanel">
<?php if ($view_sponsored_student_grade_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $view_sponsored_student_grade->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$view_sponsored_student_grade_list->RenderListOptions();

// Render list options (header, left)
$view_sponsored_student_grade_list->ListOptions->Render("header", "left");
?>
<?php if ($view_sponsored_student_grade->student_resident_programarea_id->Visible) { // student_resident_programarea_id ?>
	<?php if ($view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->student_resident_programarea_id) == "") { ?>
		<td><?php echo $view_sponsored_student_grade->student_resident_programarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->student_resident_programarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grade->student_resident_programarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grade->student_resident_programarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grade->student_resident_programarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grade->sponsored_student_id->Visible) { // sponsored_student_id ?>
	<?php if ($view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->sponsored_student_id) == "") { ?>
		<td><?php echo $view_sponsored_student_grade->sponsored_student_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->sponsored_student_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grade->sponsored_student_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grade->sponsored_student_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grade->sponsored_student_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grade->student_firstname->Visible) { // student_firstname ?>
	<?php if ($view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->student_firstname) == "") { ?>
		<td><?php echo $view_sponsored_student_grade->student_firstname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->student_firstname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grade->student_firstname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grade->student_firstname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grade->student_firstname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grade->student_lastname->Visible) { // student_lastname ?>
	<?php if ($view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->student_lastname) == "") { ?>
		<td><?php echo $view_sponsored_student_grade->student_lastname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->student_lastname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grade->student_lastname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grade->student_lastname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grade->student_lastname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grade->school_name->Visible) { // school_name ?>
	<?php if ($view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->school_name) == "") { ?>
		<td><?php echo $view_sponsored_student_grade->school_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->school_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grade->school_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grade->school_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grade->school_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grade->year->Visible) { // year ?>
	<?php if ($view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->year) == "") { ?>
		<td><?php echo $view_sponsored_student_grade->year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grade->year->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grade->year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grade->year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grade->class->Visible) { // class ?>
	<?php if ($view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->class) == "") { ?>
		<td><?php echo $view_sponsored_student_grade->class->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->class) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grade->class->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grade->class->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grade->class->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grade->programme->Visible) { // programme ?>
	<?php if ($view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->programme) == "") { ?>
		<td><?php echo $view_sponsored_student_grade->programme->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->programme) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grade->programme->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grade->programme->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grade->programme->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grade->english->Visible) { // english ?>
	<?php if ($view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->english) == "") { ?>
		<td><?php echo $view_sponsored_student_grade->english->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->english) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grade->english->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grade->english->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grade->english->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grade->math->Visible) { // math ?>
	<?php if ($view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->math) == "") { ?>
		<td><?php echo $view_sponsored_student_grade->math->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->math) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grade->math->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grade->math->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grade->math->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$view_sponsored_student_grade_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($view_sponsored_student_grade->ExportAll && $view_sponsored_student_grade->Export <> "") {
	$view_sponsored_student_grade_list->lStopRec = $view_sponsored_student_grade_list->lTotalRecs;
} else {
	$view_sponsored_student_grade_list->lStopRec = $view_sponsored_student_grade_list->lStartRec + $view_sponsored_student_grade_list->lDisplayRecs - 1; // Set the last record to display
}
$view_sponsored_student_grade_list->lRecCount = $view_sponsored_student_grade_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $view_sponsored_student_grade_list->lStartRec > 1)
		$rs->Move($view_sponsored_student_grade_list->lStartRec - 1);
}

// Initialize aggregate
$view_sponsored_student_grade->RowType = EW_ROWTYPE_AGGREGATEINIT;
$view_sponsored_student_grade_list->RenderRow();
$view_sponsored_student_grade_list->lRowCnt = 0;
while (($view_sponsored_student_grade->CurrentAction == "gridadd" || !$rs->EOF) &&
	$view_sponsored_student_grade_list->lRecCount < $view_sponsored_student_grade_list->lStopRec) {
	$view_sponsored_student_grade_list->lRecCount++;
	if (intval($view_sponsored_student_grade_list->lRecCount) >= intval($view_sponsored_student_grade_list->lStartRec)) {
		$view_sponsored_student_grade_list->lRowCnt++;

	// Init row class and style
	$view_sponsored_student_grade->CssClass = "";
	$view_sponsored_student_grade->CssStyle = "";
	$view_sponsored_student_grade->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($view_sponsored_student_grade->CurrentAction == "gridadd") {
		$view_sponsored_student_grade_list->LoadDefaultValues(); // Load default values
	} else {
		$view_sponsored_student_grade_list->LoadRowValues($rs); // Load row values
	}
	$view_sponsored_student_grade->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$view_sponsored_student_grade_list->RenderRow();

	// Render list options
	$view_sponsored_student_grade_list->RenderListOptions();
?>
	<tr<?php echo $view_sponsored_student_grade->RowAttributes() ?>>
<?php
$attendance_id=$view_sponsored_student_grade->school_attendance_id->CurrentValue;
$grade_year_id=$view_sponsored_student_grade->grade_year_id->CurrentValue;

// Render list options (body, left)
$view_sponsored_student_grade_list->ListOptions->Render("body", "left");
?>
	<?php if ($view_sponsored_student_grade->student_resident_programarea_id->Visible) { // student_resident_programarea_id ?>
		<td<?php echo $view_sponsored_student_grade->student_resident_programarea_id->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grade->student_resident_programarea_id->ViewAttributes() ?>><?php echo $view_sponsored_student_grade->student_resident_programarea_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grade->sponsored_student_id->Visible) { // sponsored_student_id ?>
		<td<?php echo $view_sponsored_student_grade->sponsored_student_id->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grade->sponsored_student_id->ViewAttributes() ?>><?php echo $view_sponsored_student_grade->sponsored_student_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grade->student_firstname->Visible) { // student_firstname ?>
		<td<?php echo $view_sponsored_student_grade->student_firstname->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grade->student_firstname->ViewAttributes() ?>><?php echo $view_sponsored_student_grade->student_firstname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grade->student_lastname->Visible) { // student_lastname ?>
		<td<?php echo $view_sponsored_student_grade->student_lastname->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grade->student_lastname->ViewAttributes() ?>><?php echo $view_sponsored_student_grade->student_lastname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grade->school_name->Visible) { // school_name ?>
		<td<?php echo $view_sponsored_student_grade->school_name->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grade->school_name->ViewAttributes() ?>><?php echo $view_sponsored_student_grade->school_name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grade->year->Visible) { // year ?>
		<td<?php echo $view_sponsored_student_grade->year->CellAttributes() ?>>
<div <?php echo "id='divYear$attendance_id'" ?><?php echo $view_sponsored_student_grade->year->ViewAttributes() ?>><?php echo $view_sponsored_student_grade->year->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grade->class->Visible) { // class ?>
		<td<?php echo $view_sponsored_student_grade->class->CellAttributes() ?>>
<div <?php echo "id='divClass$attendance_id'" ?><?php echo $view_sponsored_student_grade->class->ViewAttributes() ?>><?php echo $view_sponsored_student_grade->class->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grade->programme->Visible) { // programme ?>
		<td<?php echo $view_sponsored_student_grade->programme->CellAttributes() ?>>
<div <?php echo "id='divProgramme$attendance_id'" ?><?php echo $view_sponsored_student_grade->programme->ViewAttributes() ?>><?php echo $view_sponsored_student_grade->programme->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grade->english->Visible) { // english ?>
		<td<?php echo $view_sponsored_student_grade->english->CellAttributes() ?>>
<div <?php echo "id='divEnglish$attendance_id'" ?><?php echo $view_sponsored_student_grade->english->ViewAttributes() ?>><?php echo $view_sponsored_student_grade->english->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grade->math->Visible) { // math ?>
		<td<?php echo $view_sponsored_student_grade->math->CellAttributes() ?>>
<div <?php echo "id='divMath$attendance_id'" ?><?php echo $view_sponsored_student_grade->math->ViewAttributes() ?>><?php echo $view_sponsored_student_grade->math->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view_sponsored_student_grade_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($view_sponsored_student_grade->CurrentAction <> "gridadd")
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
<?php if ($view_sponsored_student_grade->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($view_sponsored_student_grade->CurrentAction <> "gridadd" && $view_sponsored_student_grade->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($view_sponsored_student_grade_list->Pager)) $view_sponsored_student_grade_list->Pager = new cPrevNextPager($view_sponsored_student_grade_list->lStartRec, $view_sponsored_student_grade_list->lDisplayRecs, $view_sponsored_student_grade_list->lTotalRecs) ?>
<?php if ($view_sponsored_student_grade_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($view_sponsored_student_grade_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $view_sponsored_student_grade_list->PageUrl() ?>start=<?php echo $view_sponsored_student_grade_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($view_sponsored_student_grade_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $view_sponsored_student_grade_list->PageUrl() ?>start=<?php echo $view_sponsored_student_grade_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $view_sponsored_student_grade_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($view_sponsored_student_grade_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $view_sponsored_student_grade_list->PageUrl() ?>start=<?php echo $view_sponsored_student_grade_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($view_sponsored_student_grade_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $view_sponsored_student_grade_list->PageUrl() ?>start=<?php echo $view_sponsored_student_grade_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $view_sponsored_student_grade_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $view_sponsored_student_grade_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $view_sponsored_student_grade_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $view_sponsored_student_grade_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($view_sponsored_student_grade_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($view_sponsored_student_grade_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($view_sponsored_student_grade->Export == "" && $view_sponsored_student_grade->CurrentAction == "") { ?>
<?php } ?>
<?php if ($view_sponsored_student_grade->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$view_sponsored_student_grade_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cview_sponsored_student_grade_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'view_sponsored_student_grade';

	// Page object name
	var $PageObjName = 'view_sponsored_student_grade_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $view_sponsored_student_grade;
		if ($view_sponsored_student_grade->UseTokenInUrl) $PageUrl .= "t=" . $view_sponsored_student_grade->TableVar . "&"; // Add page token
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
		global $objForm, $view_sponsored_student_grade;
		if ($view_sponsored_student_grade->UseTokenInUrl) {
			if ($objForm)
				return ($view_sponsored_student_grade->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($view_sponsored_student_grade->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cview_sponsored_student_grade_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (view_sponsored_student_grade)
		$GLOBALS["view_sponsored_student_grade"] = new cview_sponsored_student_grade();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["view_sponsored_student_grade"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "view_sponsored_student_gradedelete.php";
		$this->MultiUpdateUrl = "view_sponsored_student_gradeupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'view_sponsored_student_grade', TRUE);

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
		global $view_sponsored_student_grade;

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
			$view_sponsored_student_grade->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$view_sponsored_student_grade->Export = $_POST["exporttype"];
		} else {
			$view_sponsored_student_grade->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $view_sponsored_student_grade->Export; // Get export parameter, used in header
		$gsExportFile = $view_sponsored_student_grade->TableVar; // Get export file, used in header
		if ($view_sponsored_student_grade->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($view_sponsored_student_grade->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $view_sponsored_student_grade;

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
			$view_sponsored_student_grade->Recordset_SearchValidated();

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
		if ($view_sponsored_student_grade->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $view_sponsored_student_grade->getRecordsPerPage(); // Restore from Session
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
		$view_sponsored_student_grade->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$view_sponsored_student_grade->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$view_sponsored_student_grade->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $view_sponsored_student_grade->getSearchWhere();
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
		$view_sponsored_student_grade->setSessionWhere($sFilter);
		$view_sponsored_student_grade->CurrentFilter = "";

		// Export data only
		if (in_array($view_sponsored_student_grade->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($view_sponsored_student_grade->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $view_sponsored_student_grade;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $view_sponsored_student_grade->student_resident_programarea_id, FALSE); // student_resident_programarea_id
		$this->BuildSearchSql($sWhere, $view_sponsored_student_grade->school_attendance_id, FALSE); // school_attendance_id
		$this->BuildSearchSql($sWhere, $view_sponsored_student_grade->sponsored_student_id, FALSE); // sponsored_student_id
		$this->BuildSearchSql($sWhere, $view_sponsored_student_grade->student_firstname, FALSE); // student_firstname
		$this->BuildSearchSql($sWhere, $view_sponsored_student_grade->student_lastname, FALSE); // student_lastname
		$this->BuildSearchSql($sWhere, $view_sponsored_student_grade->schools_school_id, FALSE); // schools_school_id
		$this->BuildSearchSql($sWhere, $view_sponsored_student_grade->school_name, FALSE); // school_name
		$this->BuildSearchSql($sWhere, $view_sponsored_student_grade->grade_year_id, FALSE); // grade_year_id
		$this->BuildSearchSql($sWhere, $view_sponsored_student_grade->promoted, FALSE); // promoted
		$this->BuildSearchSql($sWhere, $view_sponsored_student_grade->year, FALSE); // year
		$this->BuildSearchSql($sWhere, $view_sponsored_student_grade->class, FALSE); // class
		$this->BuildSearchSql($sWhere, $view_sponsored_student_grade->programme, FALSE); // programme
		$this->BuildSearchSql($sWhere, $view_sponsored_student_grade->english, FALSE); // english
		$this->BuildSearchSql($sWhere, $view_sponsored_student_grade->math, FALSE); // math

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($view_sponsored_student_grade->student_resident_programarea_id); // student_resident_programarea_id
			$this->SetSearchParm($view_sponsored_student_grade->school_attendance_id); // school_attendance_id
			$this->SetSearchParm($view_sponsored_student_grade->sponsored_student_id); // sponsored_student_id
			$this->SetSearchParm($view_sponsored_student_grade->student_firstname); // student_firstname
			$this->SetSearchParm($view_sponsored_student_grade->student_lastname); // student_lastname
			$this->SetSearchParm($view_sponsored_student_grade->schools_school_id); // schools_school_id
			$this->SetSearchParm($view_sponsored_student_grade->school_name); // school_name
			$this->SetSearchParm($view_sponsored_student_grade->grade_year_id); // grade_year_id
			$this->SetSearchParm($view_sponsored_student_grade->promoted); // promoted
			$this->SetSearchParm($view_sponsored_student_grade->year); // year
			$this->SetSearchParm($view_sponsored_student_grade->class); // class
			$this->SetSearchParm($view_sponsored_student_grade->programme); // programme
			$this->SetSearchParm($view_sponsored_student_grade->english); // english
			$this->SetSearchParm($view_sponsored_student_grade->math); // math
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
		global $view_sponsored_student_grade;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$view_sponsored_student_grade->setAdvancedSearch("x_$FldParm", $FldVal);
		$view_sponsored_student_grade->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$view_sponsored_student_grade->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$view_sponsored_student_grade->setAdvancedSearch("y_$FldParm", $FldVal2);
		$view_sponsored_student_grade->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $view_sponsored_student_grade;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $view_sponsored_student_grade->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $view_sponsored_student_grade->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $view_sponsored_student_grade->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $view_sponsored_student_grade->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $view_sponsored_student_grade->GetAdvancedSearch("w_$FldParm");
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
		global $view_sponsored_student_grade;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		if (is_numeric($Keyword)) $this->BuildBasicSearchSQL($sWhere, $view_sponsored_student_grade->student_resident_programarea_id, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $view_sponsored_student_grade->student_firstname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $view_sponsored_student_grade->student_lastname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $view_sponsored_student_grade->school_name, $Keyword);
		if (is_numeric($Keyword)) $this->BuildBasicSearchSQL($sWhere, $view_sponsored_student_grade->year, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $view_sponsored_student_grade->class, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $view_sponsored_student_grade->programme, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $view_sponsored_student_grade->english, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $view_sponsored_student_grade->math, $Keyword);
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
		global $Security, $view_sponsored_student_grade;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $view_sponsored_student_grade->BasicSearchKeyword;
		$sSearchType = $view_sponsored_student_grade->BasicSearchType;
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
			$view_sponsored_student_grade->setSessionBasicSearchKeyword($sSearchKeyword);
			$view_sponsored_student_grade->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $view_sponsored_student_grade;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$view_sponsored_student_grade->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $view_sponsored_student_grade;
		$view_sponsored_student_grade->setSessionBasicSearchKeyword("");
		$view_sponsored_student_grade->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $view_sponsored_student_grade;
		$view_sponsored_student_grade->setAdvancedSearch("x_student_resident_programarea_id", "");
		$view_sponsored_student_grade->setAdvancedSearch("x_school_attendance_id", "");
		$view_sponsored_student_grade->setAdvancedSearch("x_sponsored_student_id", "");
		$view_sponsored_student_grade->setAdvancedSearch("x_student_firstname", "");
		$view_sponsored_student_grade->setAdvancedSearch("x_student_lastname", "");
		$view_sponsored_student_grade->setAdvancedSearch("x_schools_school_id", "");
		$view_sponsored_student_grade->setAdvancedSearch("x_school_name", "");
		$view_sponsored_student_grade->setAdvancedSearch("x_grade_year_id", "");
		$view_sponsored_student_grade->setAdvancedSearch("x_promoted", "");
		$view_sponsored_student_grade->setAdvancedSearch("x_year", "");
		$view_sponsored_student_grade->setAdvancedSearch("x_class", "");
		$view_sponsored_student_grade->setAdvancedSearch("x_programme", "");
		$view_sponsored_student_grade->setAdvancedSearch("x_english", "");
		$view_sponsored_student_grade->setAdvancedSearch("x_math", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $view_sponsored_student_grade;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_resident_programarea_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_school_attendance_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_sponsored_student_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_firstname"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_lastname"] <> "") $bRestore = FALSE;
		if (@$_GET["x_schools_school_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_school_name"] <> "") $bRestore = FALSE;
		if (@$_GET["x_grade_year_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_promoted"] <> "") $bRestore = FALSE;
		if (@$_GET["x_year"] <> "") $bRestore = FALSE;
		if (@$_GET["x_class"] <> "") $bRestore = FALSE;
		if (@$_GET["x_programme"] <> "") $bRestore = FALSE;
		if (@$_GET["x_english"] <> "") $bRestore = FALSE;
		if (@$_GET["x_math"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$view_sponsored_student_grade->BasicSearchKeyword = $view_sponsored_student_grade->getSessionBasicSearchKeyword();
			$view_sponsored_student_grade->BasicSearchType = $view_sponsored_student_grade->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($view_sponsored_student_grade->student_resident_programarea_id);
			$this->GetSearchParm($view_sponsored_student_grade->school_attendance_id);
			$this->GetSearchParm($view_sponsored_student_grade->sponsored_student_id);
			$this->GetSearchParm($view_sponsored_student_grade->student_firstname);
			$this->GetSearchParm($view_sponsored_student_grade->student_lastname);
			$this->GetSearchParm($view_sponsored_student_grade->schools_school_id);
			$this->GetSearchParm($view_sponsored_student_grade->school_name);
			$this->GetSearchParm($view_sponsored_student_grade->grade_year_id);
			$this->GetSearchParm($view_sponsored_student_grade->promoted);
			$this->GetSearchParm($view_sponsored_student_grade->year);
			$this->GetSearchParm($view_sponsored_student_grade->class);
			$this->GetSearchParm($view_sponsored_student_grade->programme);
			$this->GetSearchParm($view_sponsored_student_grade->english);
			$this->GetSearchParm($view_sponsored_student_grade->math);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $view_sponsored_student_grade;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$view_sponsored_student_grade->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$view_sponsored_student_grade->CurrentOrderType = @$_GET["ordertype"];
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->student_resident_programarea_id); // student_resident_programarea_id
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->sponsored_student_id); // sponsored_student_id
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->student_firstname); // student_firstname
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->student_lastname); // student_lastname
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->school_name); // school_name
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->year); // year
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->class); // class
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->programme); // programme
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->english); // english
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->math); // math
			$view_sponsored_student_grade->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $view_sponsored_student_grade;
		$sOrderBy = $view_sponsored_student_grade->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($view_sponsored_student_grade->SqlOrderBy() <> "") {
				$sOrderBy = $view_sponsored_student_grade->SqlOrderBy();
				$view_sponsored_student_grade->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $view_sponsored_student_grade;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$view_sponsored_student_grade->setSessionOrderBy($sOrderBy);
				$view_sponsored_student_grade->student_resident_programarea_id->setSort("");
				$view_sponsored_student_grade->sponsored_student_id->setSort("");
				$view_sponsored_student_grade->student_firstname->setSort("");
				$view_sponsored_student_grade->student_lastname->setSort("");
				$view_sponsored_student_grade->school_name->setSort("");
				$view_sponsored_student_grade->year->setSort("");
				$view_sponsored_student_grade->class->setSort("");
				$view_sponsored_student_grade->programme->setSort("");
				$view_sponsored_student_grade->english->setSort("");
				$view_sponsored_student_grade->math->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$view_sponsored_student_grade->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $view_sponsored_student_grade;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($view_sponsored_student_grade->Export <> "" ||
			$view_sponsored_student_grade->CurrentAction == "gridadd" ||
			$view_sponsored_student_grade->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $view_sponsored_student_grade;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $view_sponsored_student_grade;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $view_sponsored_student_grade;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$view_sponsored_student_grade->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$view_sponsored_student_grade->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $view_sponsored_student_grade->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$view_sponsored_student_grade->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$view_sponsored_student_grade->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$view_sponsored_student_grade->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $view_sponsored_student_grade;
		$view_sponsored_student_grade->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$view_sponsored_student_grade->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $view_sponsored_student_grade;

		// Load search values
		// student_resident_programarea_id

		$view_sponsored_student_grade->student_resident_programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_resident_programarea_id"]);
		$view_sponsored_student_grade->student_resident_programarea_id->AdvancedSearch->SearchOperator = @$_GET["z_student_resident_programarea_id"];

		// school_attendance_id
		$view_sponsored_student_grade->school_attendance_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_school_attendance_id"]);
		$view_sponsored_student_grade->school_attendance_id->AdvancedSearch->SearchOperator = @$_GET["z_school_attendance_id"];

		// sponsored_student_id
		$view_sponsored_student_grade->sponsored_student_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_sponsored_student_id"]);
		$view_sponsored_student_grade->sponsored_student_id->AdvancedSearch->SearchOperator = @$_GET["z_sponsored_student_id"];

		// student_firstname
		$view_sponsored_student_grade->student_firstname->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_firstname"]);
		$view_sponsored_student_grade->student_firstname->AdvancedSearch->SearchOperator = @$_GET["z_student_firstname"];

		// student_lastname
		$view_sponsored_student_grade->student_lastname->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_lastname"]);
		$view_sponsored_student_grade->student_lastname->AdvancedSearch->SearchOperator = @$_GET["z_student_lastname"];

		// schools_school_id
		$view_sponsored_student_grade->schools_school_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_schools_school_id"]);
		$view_sponsored_student_grade->schools_school_id->AdvancedSearch->SearchOperator = @$_GET["z_schools_school_id"];

		// school_name
		$view_sponsored_student_grade->school_name->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_school_name"]);
		$view_sponsored_student_grade->school_name->AdvancedSearch->SearchOperator = @$_GET["z_school_name"];

		// grade_year_id
		$view_sponsored_student_grade->grade_year_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_grade_year_id"]);
		$view_sponsored_student_grade->grade_year_id->AdvancedSearch->SearchOperator = @$_GET["z_grade_year_id"];

		// promoted
		$view_sponsored_student_grade->promoted->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_promoted"]);
		$view_sponsored_student_grade->promoted->AdvancedSearch->SearchOperator = @$_GET["z_promoted"];

		// year
		$view_sponsored_student_grade->year->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_year"]);
		$view_sponsored_student_grade->year->AdvancedSearch->SearchOperator = @$_GET["z_year"];

		// class
		$view_sponsored_student_grade->class->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_class"]);
		$view_sponsored_student_grade->class->AdvancedSearch->SearchOperator = @$_GET["z_class"];

		// programme
		$view_sponsored_student_grade->programme->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programme"]);
		$view_sponsored_student_grade->programme->AdvancedSearch->SearchOperator = @$_GET["z_programme"];

		// english
		$view_sponsored_student_grade->english->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_english"]);
		$view_sponsored_student_grade->english->AdvancedSearch->SearchOperator = @$_GET["z_english"];

		// math
		$view_sponsored_student_grade->math->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_math"]);
		$view_sponsored_student_grade->math->AdvancedSearch->SearchOperator = @$_GET["z_math"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $view_sponsored_student_grade;

		// Call Recordset Selecting event
		$view_sponsored_student_grade->Recordset_Selecting($view_sponsored_student_grade->CurrentFilter);

		// Load List page SQL
		$sSql = $view_sponsored_student_grade->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$view_sponsored_student_grade->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $view_sponsored_student_grade;
		$sFilter = $view_sponsored_student_grade->KeyFilter();

		// Call Row Selecting event
		$view_sponsored_student_grade->Row_Selecting($sFilter);

		// Load SQL based on filter
		$view_sponsored_student_grade->CurrentFilter = $sFilter;
		$sSql = $view_sponsored_student_grade->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$view_sponsored_student_grade->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $view_sponsored_student_grade;
		$view_sponsored_student_grade->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
		$view_sponsored_student_grade->school_attendance_id->setDbValue($rs->fields('school_attendance_id'));
		$view_sponsored_student_grade->sponsored_student_id->setDbValue($rs->fields('sponsored_student_id'));
		$view_sponsored_student_grade->student_firstname->setDbValue($rs->fields('student_firstname'));
		$view_sponsored_student_grade->student_lastname->setDbValue($rs->fields('student_lastname'));
		$view_sponsored_student_grade->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$view_sponsored_student_grade->school_name->setDbValue($rs->fields('school_name'));
		$view_sponsored_student_grade->grade_year_id->setDbValue($rs->fields('grade_year_id'));
		$view_sponsored_student_grade->promoted->setDbValue($rs->fields('promoted'));
		$view_sponsored_student_grade->year->setDbValue($rs->fields('year'));
		$view_sponsored_student_grade->class->setDbValue($rs->fields('class'));
		$view_sponsored_student_grade->programme->setDbValue($rs->fields('programme'));
		$view_sponsored_student_grade->english->setDbValue($rs->fields('english'));
		$view_sponsored_student_grade->math->setDbValue($rs->fields('math'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $view_sponsored_student_grade;

		// Initialize URLs
		$this->ViewUrl = $view_sponsored_student_grade->ViewUrl();
		$this->EditUrl = $view_sponsored_student_grade->EditUrl();
		$this->InlineEditUrl = $view_sponsored_student_grade->InlineEditUrl();
		$this->CopyUrl = $view_sponsored_student_grade->CopyUrl();
		$this->InlineCopyUrl = $view_sponsored_student_grade->InlineCopyUrl();
		$this->DeleteUrl = $view_sponsored_student_grade->DeleteUrl();

		// Call Row_Rendering event
		$view_sponsored_student_grade->Row_Rendering();

		// Common render codes for all row types
		// student_resident_programarea_id

		$view_sponsored_student_grade->student_resident_programarea_id->CellCssStyle = ""; $view_sponsored_student_grade->student_resident_programarea_id->CellCssClass = "";
		$view_sponsored_student_grade->student_resident_programarea_id->CellAttrs = array(); $view_sponsored_student_grade->student_resident_programarea_id->ViewAttrs = array(); $view_sponsored_student_grade->student_resident_programarea_id->EditAttrs = array();

		// sponsored_student_id
		$view_sponsored_student_grade->sponsored_student_id->CellCssStyle = ""; $view_sponsored_student_grade->sponsored_student_id->CellCssClass = "";
		$view_sponsored_student_grade->sponsored_student_id->CellAttrs = array(); $view_sponsored_student_grade->sponsored_student_id->ViewAttrs = array(); $view_sponsored_student_grade->sponsored_student_id->EditAttrs = array();

		// student_firstname
		$view_sponsored_student_grade->student_firstname->CellCssStyle = ""; $view_sponsored_student_grade->student_firstname->CellCssClass = "";
		$view_sponsored_student_grade->student_firstname->CellAttrs = array(); $view_sponsored_student_grade->student_firstname->ViewAttrs = array(); $view_sponsored_student_grade->student_firstname->EditAttrs = array();

		// student_lastname
		$view_sponsored_student_grade->student_lastname->CellCssStyle = ""; $view_sponsored_student_grade->student_lastname->CellCssClass = "";
		$view_sponsored_student_grade->student_lastname->CellAttrs = array(); $view_sponsored_student_grade->student_lastname->ViewAttrs = array(); $view_sponsored_student_grade->student_lastname->EditAttrs = array();

		// school_name
		$view_sponsored_student_grade->school_name->CellCssStyle = ""; $view_sponsored_student_grade->school_name->CellCssClass = "";
		$view_sponsored_student_grade->school_name->CellAttrs = array(); $view_sponsored_student_grade->school_name->ViewAttrs = array(); $view_sponsored_student_grade->school_name->EditAttrs = array();

		// year
		$view_sponsored_student_grade->year->CellCssStyle = ""; $view_sponsored_student_grade->year->CellCssClass = "";
		$view_sponsored_student_grade->year->CellAttrs = array(); $view_sponsored_student_grade->year->ViewAttrs = array(); $view_sponsored_student_grade->year->EditAttrs = array();

		// class
		$view_sponsored_student_grade->class->CellCssStyle = ""; $view_sponsored_student_grade->class->CellCssClass = "";
		$view_sponsored_student_grade->class->CellAttrs = array(); $view_sponsored_student_grade->class->ViewAttrs = array(); $view_sponsored_student_grade->class->EditAttrs = array();

		// programme
		$view_sponsored_student_grade->programme->CellCssStyle = ""; $view_sponsored_student_grade->programme->CellCssClass = "";
		$view_sponsored_student_grade->programme->CellAttrs = array(); $view_sponsored_student_grade->programme->ViewAttrs = array(); $view_sponsored_student_grade->programme->EditAttrs = array();

		// english
		$view_sponsored_student_grade->english->CellCssStyle = ""; $view_sponsored_student_grade->english->CellCssClass = "";
		$view_sponsored_student_grade->english->CellAttrs = array(); $view_sponsored_student_grade->english->ViewAttrs = array(); $view_sponsored_student_grade->english->EditAttrs = array();

		// math
		$view_sponsored_student_grade->math->CellCssStyle = ""; $view_sponsored_student_grade->math->CellCssClass = "";
		$view_sponsored_student_grade->math->CellAttrs = array(); $view_sponsored_student_grade->math->ViewAttrs = array(); $view_sponsored_student_grade->math->EditAttrs = array();
		if ($view_sponsored_student_grade->RowType == EW_ROWTYPE_VIEW) { // View row

			// student_resident_programarea_id
			if (strval($view_sponsored_student_grade->student_resident_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($view_sponsored_student_grade->student_resident_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view_sponsored_student_grade->student_resident_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$view_sponsored_student_grade->student_resident_programarea_id->ViewValue = $view_sponsored_student_grade->student_resident_programarea_id->CurrentValue;
				}
			} else {
				$view_sponsored_student_grade->student_resident_programarea_id->ViewValue = NULL;
			}
			$view_sponsored_student_grade->student_resident_programarea_id->CssStyle = "";
			$view_sponsored_student_grade->student_resident_programarea_id->CssClass = "";
			$view_sponsored_student_grade->student_resident_programarea_id->ViewCustomAttributes = "";

			// school_attendance_id
			$view_sponsored_student_grade->school_attendance_id->ViewValue = $view_sponsored_student_grade->school_attendance_id->CurrentValue;
			$view_sponsored_student_grade->school_attendance_id->CssStyle = "";
			$view_sponsored_student_grade->school_attendance_id->CssClass = "";
			$view_sponsored_student_grade->school_attendance_id->ViewCustomAttributes = "";

			// sponsored_student_id
			$view_sponsored_student_grade->sponsored_student_id->ViewValue = $view_sponsored_student_grade->sponsored_student_id->CurrentValue;
			$view_sponsored_student_grade->sponsored_student_id->CssStyle = "";
			$view_sponsored_student_grade->sponsored_student_id->CssClass = "";
			$view_sponsored_student_grade->sponsored_student_id->ViewCustomAttributes = "";

			// student_firstname
			$view_sponsored_student_grade->student_firstname->ViewValue = $view_sponsored_student_grade->student_firstname->CurrentValue;
			$view_sponsored_student_grade->student_firstname->CssStyle = "";
			$view_sponsored_student_grade->student_firstname->CssClass = "";
			$view_sponsored_student_grade->student_firstname->ViewCustomAttributes = "";

			// student_lastname
			$view_sponsored_student_grade->student_lastname->ViewValue = $view_sponsored_student_grade->student_lastname->CurrentValue;
			$view_sponsored_student_grade->student_lastname->CssStyle = "";
			$view_sponsored_student_grade->student_lastname->CssClass = "";
			$view_sponsored_student_grade->student_lastname->ViewCustomAttributes = "";

			// schools_school_id
			if (strval($view_sponsored_student_grade->schools_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($view_sponsored_student_grade->schools_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view_sponsored_student_grade->schools_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$view_sponsored_student_grade->schools_school_id->ViewValue = $view_sponsored_student_grade->schools_school_id->CurrentValue;
				}
			} else {
				$view_sponsored_student_grade->schools_school_id->ViewValue = NULL;
			}
			$view_sponsored_student_grade->schools_school_id->CssStyle = "";
			$view_sponsored_student_grade->schools_school_id->CssClass = "";
			$view_sponsored_student_grade->schools_school_id->ViewCustomAttributes = "";

			// school_name
			$view_sponsored_student_grade->school_name->ViewValue = $view_sponsored_student_grade->school_name->CurrentValue;
			$view_sponsored_student_grade->school_name->CssStyle = "";
			$view_sponsored_student_grade->school_name->CssClass = "";
			$view_sponsored_student_grade->school_name->ViewCustomAttributes = "";

			// grade_year_id
			$view_sponsored_student_grade->grade_year_id->ViewValue = $view_sponsored_student_grade->grade_year_id->CurrentValue;
			$view_sponsored_student_grade->grade_year_id->CssStyle = "";
			$view_sponsored_student_grade->grade_year_id->CssClass = "";
			$view_sponsored_student_grade->grade_year_id->ViewCustomAttributes = "";

			// promoted
			if (strval($view_sponsored_student_grade->promoted->CurrentValue) <> "") {
				switch ($view_sponsored_student_grade->promoted->CurrentValue) {
					case "PASS":
						$view_sponsored_student_grade->promoted->ViewValue = "PASS";
						break;
					case "FAIL":
						$view_sponsored_student_grade->promoted->ViewValue = "FAIL";
						break;
					default:
						$view_sponsored_student_grade->promoted->ViewValue = $view_sponsored_student_grade->promoted->CurrentValue;
				}
			} else {
				$view_sponsored_student_grade->promoted->ViewValue = NULL;
			}
			$view_sponsored_student_grade->promoted->CssStyle = "";
			$view_sponsored_student_grade->promoted->CssClass = "";
			$view_sponsored_student_grade->promoted->ViewCustomAttributes = "";

			// year
			$view_sponsored_student_grade->year->ViewValue = $view_sponsored_student_grade->year->CurrentValue;
			$view_sponsored_student_grade->year->CssStyle = "";
			$view_sponsored_student_grade->year->CssClass = "";
			$view_sponsored_student_grade->year->ViewCustomAttributes = "";

			// class
			$view_sponsored_student_grade->class->ViewValue = $view_sponsored_student_grade->class->CurrentValue;
			$view_sponsored_student_grade->class->CssStyle = "";
			$view_sponsored_student_grade->class->CssClass = "";
			$view_sponsored_student_grade->class->ViewCustomAttributes = "";

			// programme
			if (strval($view_sponsored_student_grade->programme->CurrentValue) <> "") {
				switch ($view_sponsored_student_grade->programme->CurrentValue) {
					case "BA":
						$view_sponsored_student_grade->programme->ViewValue = "Business";
						break;
					case "ART":
						$view_sponsored_student_grade->programme->ViewValue = "Arts";
						break;
					case "SCI":
						$view_sponsored_student_grade->programme->ViewValue = "Science";
						break;
					default:
						$view_sponsored_student_grade->programme->ViewValue = $view_sponsored_student_grade->programme->CurrentValue;
				}
			} else {
				$view_sponsored_student_grade->programme->ViewValue = NULL;
			}
			$view_sponsored_student_grade->programme->CssStyle = "";
			$view_sponsored_student_grade->programme->CssClass = "";
			$view_sponsored_student_grade->programme->ViewCustomAttributes = "";

			// english
			$view_sponsored_student_grade->english->ViewValue = $view_sponsored_student_grade->english->CurrentValue;
			$view_sponsored_student_grade->english->CssStyle = "";
			$view_sponsored_student_grade->english->CssClass = "";
			$view_sponsored_student_grade->english->ViewCustomAttributes = "";

			// math
			$view_sponsored_student_grade->math->ViewValue = $view_sponsored_student_grade->math->CurrentValue;
			$view_sponsored_student_grade->math->CssStyle = "";
			$view_sponsored_student_grade->math->CssClass = "";
			$view_sponsored_student_grade->math->ViewCustomAttributes = "";

			// student_resident_programarea_id
			$view_sponsored_student_grade->student_resident_programarea_id->HrefValue = "";
			$view_sponsored_student_grade->student_resident_programarea_id->TooltipValue = "";

			// sponsored_student_id
			$view_sponsored_student_grade->sponsored_student_id->HrefValue = "";
			$view_sponsored_student_grade->sponsored_student_id->TooltipValue = "";

			// student_firstname
			$view_sponsored_student_grade->student_firstname->HrefValue = "";
			$view_sponsored_student_grade->student_firstname->TooltipValue = "";

			// student_lastname
			$view_sponsored_student_grade->student_lastname->HrefValue = "";
			$view_sponsored_student_grade->student_lastname->TooltipValue = "";

			// school_name
			$view_sponsored_student_grade->school_name->HrefValue = "";
			$view_sponsored_student_grade->school_name->TooltipValue = "";

			// year
			$view_sponsored_student_grade->year->HrefValue = "";
			$view_sponsored_student_grade->year->TooltipValue = "";

			// class
			$view_sponsored_student_grade->class->HrefValue = "";
			$view_sponsored_student_grade->class->TooltipValue = "";

			// programme
			$view_sponsored_student_grade->programme->HrefValue = "";
			$view_sponsored_student_grade->programme->TooltipValue = "";

			// english
			$view_sponsored_student_grade->english->HrefValue = "";
			$view_sponsored_student_grade->english->TooltipValue = "";

			// math
			$view_sponsored_student_grade->math->HrefValue = "";
			$view_sponsored_student_grade->math->TooltipValue = "";
		} elseif ($view_sponsored_student_grade->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// student_resident_programarea_id
			$view_sponsored_student_grade->student_resident_programarea_id->EditCustomAttributes = "";
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
			$view_sponsored_student_grade->student_resident_programarea_id->EditValue = $arwrk;

			// sponsored_student_id
			$view_sponsored_student_grade->sponsored_student_id->EditCustomAttributes = "";
			$view_sponsored_student_grade->sponsored_student_id->EditValue = ew_HtmlEncode($view_sponsored_student_grade->sponsored_student_id->AdvancedSearch->SearchValue);

			// student_firstname
			$view_sponsored_student_grade->student_firstname->EditCustomAttributes = "";
			$view_sponsored_student_grade->student_firstname->EditValue = ew_HtmlEncode($view_sponsored_student_grade->student_firstname->AdvancedSearch->SearchValue);

			// student_lastname
			$view_sponsored_student_grade->student_lastname->EditCustomAttributes = "";
			$view_sponsored_student_grade->student_lastname->EditValue = ew_HtmlEncode($view_sponsored_student_grade->student_lastname->AdvancedSearch->SearchValue);

			// school_name
			$view_sponsored_student_grade->school_name->EditCustomAttributes = "";
			$view_sponsored_student_grade->school_name->EditValue = ew_HtmlEncode($view_sponsored_student_grade->school_name->AdvancedSearch->SearchValue);

			// year
			$view_sponsored_student_grade->year->EditCustomAttributes = "";
			$view_sponsored_student_grade->year->EditValue = ew_HtmlEncode($view_sponsored_student_grade->year->AdvancedSearch->SearchValue);

			// class
			$view_sponsored_student_grade->class->EditCustomAttributes = "";
			$view_sponsored_student_grade->class->EditValue = ew_HtmlEncode($view_sponsored_student_grade->class->AdvancedSearch->SearchValue);

			// programme
			$view_sponsored_student_grade->programme->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("BA", "Business");
			$arwrk[] = array("ART", "Arts");
			$arwrk[] = array("SCI", "Science");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$view_sponsored_student_grade->programme->EditValue = $arwrk;

			// english
			$view_sponsored_student_grade->english->EditCustomAttributes = "";
			$view_sponsored_student_grade->english->EditValue = ew_HtmlEncode($view_sponsored_student_grade->english->AdvancedSearch->SearchValue);

			// math
			$view_sponsored_student_grade->math->EditCustomAttributes = "";
			$view_sponsored_student_grade->math->EditValue = ew_HtmlEncode($view_sponsored_student_grade->math->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($view_sponsored_student_grade->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$view_sponsored_student_grade->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $view_sponsored_student_grade;

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
		global $view_sponsored_student_grade;
		$view_sponsored_student_grade->student_resident_programarea_id->AdvancedSearch->SearchValue = $view_sponsored_student_grade->getAdvancedSearch("x_student_resident_programarea_id");
		$view_sponsored_student_grade->school_attendance_id->AdvancedSearch->SearchValue = $view_sponsored_student_grade->getAdvancedSearch("x_school_attendance_id");
		$view_sponsored_student_grade->sponsored_student_id->AdvancedSearch->SearchValue = $view_sponsored_student_grade->getAdvancedSearch("x_sponsored_student_id");
		$view_sponsored_student_grade->student_firstname->AdvancedSearch->SearchValue = $view_sponsored_student_grade->getAdvancedSearch("x_student_firstname");
		$view_sponsored_student_grade->student_lastname->AdvancedSearch->SearchValue = $view_sponsored_student_grade->getAdvancedSearch("x_student_lastname");
		$view_sponsored_student_grade->schools_school_id->AdvancedSearch->SearchValue = $view_sponsored_student_grade->getAdvancedSearch("x_schools_school_id");
		$view_sponsored_student_grade->school_name->AdvancedSearch->SearchValue = $view_sponsored_student_grade->getAdvancedSearch("x_school_name");
		$view_sponsored_student_grade->grade_year_id->AdvancedSearch->SearchValue = $view_sponsored_student_grade->getAdvancedSearch("x_grade_year_id");
		$view_sponsored_student_grade->promoted->AdvancedSearch->SearchValue = $view_sponsored_student_grade->getAdvancedSearch("x_promoted");
		$view_sponsored_student_grade->year->AdvancedSearch->SearchValue = $view_sponsored_student_grade->getAdvancedSearch("x_year");
		$view_sponsored_student_grade->class->AdvancedSearch->SearchValue = $view_sponsored_student_grade->getAdvancedSearch("x_class");
		$view_sponsored_student_grade->programme->AdvancedSearch->SearchValue = $view_sponsored_student_grade->getAdvancedSearch("x_programme");
		$view_sponsored_student_grade->english->AdvancedSearch->SearchValue = $view_sponsored_student_grade->getAdvancedSearch("x_english");
		$view_sponsored_student_grade->math->AdvancedSearch->SearchValue = $view_sponsored_student_grade->getAdvancedSearch("x_math");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $view_sponsored_student_grade;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $view_sponsored_student_grade->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($view_sponsored_student_grade->ExportAll) {
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
		if ($view_sponsored_student_grade->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($view_sponsored_student_grade, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($view_sponsored_student_grade->student_resident_programarea_id);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->school_attendance_id);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->sponsored_student_id);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->student_firstname);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->student_lastname);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->schools_school_id);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->school_name);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->grade_year_id);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->promoted);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->year);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->class);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->programme);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->english);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->math);
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
				$view_sponsored_student_grade->CssClass = "";
				$view_sponsored_student_grade->CssStyle = "";
				$view_sponsored_student_grade->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($view_sponsored_student_grade->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('student_resident_programarea_id', $view_sponsored_student_grade->student_resident_programarea_id->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('school_attendance_id', $view_sponsored_student_grade->school_attendance_id->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('sponsored_student_id', $view_sponsored_student_grade->sponsored_student_id->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('student_firstname', $view_sponsored_student_grade->student_firstname->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('student_lastname', $view_sponsored_student_grade->student_lastname->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('schools_school_id', $view_sponsored_student_grade->schools_school_id->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('school_name', $view_sponsored_student_grade->school_name->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('grade_year_id', $view_sponsored_student_grade->grade_year_id->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('promoted', $view_sponsored_student_grade->promoted->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('year', $view_sponsored_student_grade->year->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('class', $view_sponsored_student_grade->class->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('programme', $view_sponsored_student_grade->programme->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('english', $view_sponsored_student_grade->english->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('math', $view_sponsored_student_grade->math->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($view_sponsored_student_grade->student_resident_programarea_id);
					$ExportDoc->ExportField($view_sponsored_student_grade->school_attendance_id);
					$ExportDoc->ExportField($view_sponsored_student_grade->sponsored_student_id);
					$ExportDoc->ExportField($view_sponsored_student_grade->student_firstname);
					$ExportDoc->ExportField($view_sponsored_student_grade->student_lastname);
					$ExportDoc->ExportField($view_sponsored_student_grade->schools_school_id);
					$ExportDoc->ExportField($view_sponsored_student_grade->school_name);
					$ExportDoc->ExportField($view_sponsored_student_grade->grade_year_id);
					$ExportDoc->ExportField($view_sponsored_student_grade->promoted);
					$ExportDoc->ExportField($view_sponsored_student_grade->year);
					$ExportDoc->ExportField($view_sponsored_student_grade->class);
					$ExportDoc->ExportField($view_sponsored_student_grade->programme);
					$ExportDoc->ExportField($view_sponsored_student_grade->english);
					$ExportDoc->ExportField($view_sponsored_student_grade->math);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($view_sponsored_student_grade->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($view_sponsored_student_grade->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($view_sponsored_student_grade->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($view_sponsored_student_grade->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($view_sponsored_student_grade->ExportReturnUrl());
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
    $this->ListOptions->Add("promote");
    $this->ListOptions->Items["promote"]->OnLeft = FALSE; // Link on left
    $this->ListOptions->Itmes["promote"]->Visible=TRUE;
}

		// ListOptions Rendered event
function ListOptions_Rendered() {
      global $view_sponsored_student_grade;

        $attendance_id=$view_sponsored_student_grade->school_attendance_id->CurrentValue;
        if($view_sponsored_student_grade->grade_year_id->CurrentValue==0){
            
            $this->ListOptions->Items["promote"]->Body.="<div onclick=\"startRecording(this,$attendance_id,0)\"
                       style=\"color:blue;text-decoration: underline; cursor: pointer\">record</div>";
            
        }else{
            $grade_year_id=$view_sponsored_student_grade->grade_year_id->CurrentValue;
			$p="";
			if($view_sponsored_student_grade->promoted->CurrentValue==1){
				$p="passed";
			}else{
				$p="failed";
			}
            $this->ListOptions->Items["promote"]->Body.="{$p}<span onclick=\"startRecording(this,$attendance_id,$grade_year_id)\"
                       style=\"color:blue;text-decoration: underline; cursor: pointer\"> edit</span>";
        }
                   
}                                                                                                  


}
?>
