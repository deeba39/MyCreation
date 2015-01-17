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
&nbsp;&nbsp;<a href="<?php echo $view_sponsored_student_grade_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $view_sponsored_student_grade_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $view_sponsored_student_grade_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($view_sponsored_student_grade->Export == "" && $view_sponsored_student_grade->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(view_sponsored_student_grade_list);" style="text-decoration: none;"><img id="view_sponsored_student_grade_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="view_sponsored_student_grade_list_SearchPanel">
<form name="fview_sponsored_student_gradelistsrch" id="fview_sponsored_student_gradelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="view_sponsored_student_grade">
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

<?php include("ext/recordgrade_form.php") ?>
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
<?php if ($view_sponsored_student_grade->schools_school_id->Visible) { // schools_school_id ?>
	<?php if ($view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->schools_school_id) == "") { ?>
		<td><?php echo $view_sponsored_student_grade->schools_school_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->schools_school_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grade->schools_school_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grade->schools_school_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grade->schools_school_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grade->grade_year_id->Visible) { // grade_year_id ?>
	<?php if ($view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->grade_year_id) == "") { ?>
		<td><?php echo $view_sponsored_student_grade->grade_year_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->grade_year_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grade->grade_year_id->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grade->grade_year_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grade->grade_year_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grade->class->Visible) { // class ?>
	<?php if ($view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->class) == "") { ?>
		<td><?php echo $view_sponsored_student_grade->class->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->class) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grade->class->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grade->class->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grade->class->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grade->year->Visible) { // year ?>
	<?php if ($view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->year) == "") { ?>
		<td><?php echo $view_sponsored_student_grade->year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grade->year->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grade->year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grade->year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grade->promoted->Visible) { // promoted ?>
	<?php if ($view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->promoted) == "") { ?>
		<td><?php echo $view_sponsored_student_grade->promoted->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grade->SortUrl($view_sponsored_student_grade->promoted) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grade->promoted->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grade->promoted->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grade->promoted->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
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

// Render list options (body, left)
$view_sponsored_student_grade_list->ListOptions->Render("body", "left");
?>
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
	<?php if ($view_sponsored_student_grade->schools_school_id->Visible) { // schools_school_id ?>
		<td<?php echo $view_sponsored_student_grade->schools_school_id->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grade->schools_school_id->ViewAttributes() ?>><?php echo $view_sponsored_student_grade->schools_school_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grade->grade_year_id->Visible) { // grade_year_id ?>
		<td<?php echo $view_sponsored_student_grade->grade_year_id->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grade->grade_year_id->ViewAttributes() ?>><?php echo $view_sponsored_student_grade->grade_year_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grade->class->Visible) { // class ?>
		<td<?php echo $view_sponsored_student_grade->class->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grade->class->ViewAttributes() ?>><?php echo $view_sponsored_student_grade->class->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grade->year->Visible) { // year ?>
		<td<?php echo $view_sponsored_student_grade->year->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grade->year->ViewAttributes() ?>><?php echo $view_sponsored_student_grade->year->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grade->promoted->Visible) { // promoted ?>
		<td<?php echo $view_sponsored_student_grade->promoted->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grade->promoted->ViewAttributes() ?>><?php echo $view_sponsored_student_grade->promoted->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grade->programme->Visible) { // programme ?>
		<td<?php echo $view_sponsored_student_grade->programme->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grade->programme->ViewAttributes() ?>><?php echo $view_sponsored_student_grade->programme->ListViewValue() ?></div>
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

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$view_sponsored_student_grade->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
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

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $view_sponsored_student_grade;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $view_sponsored_student_grade->student_firstname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $view_sponsored_student_grade->student_lastname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $view_sponsored_student_grade->grade_year_id, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $view_sponsored_student_grade->class, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $view_sponsored_student_grade->programme, $Keyword);
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
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $view_sponsored_student_grade;
		$view_sponsored_student_grade->setSessionBasicSearchKeyword("");
		$view_sponsored_student_grade->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $view_sponsored_student_grade;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$view_sponsored_student_grade->BasicSearchKeyword = $view_sponsored_student_grade->getSessionBasicSearchKeyword();
			$view_sponsored_student_grade->BasicSearchType = $view_sponsored_student_grade->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $view_sponsored_student_grade;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$view_sponsored_student_grade->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$view_sponsored_student_grade->CurrentOrderType = @$_GET["ordertype"];
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->sponsored_student_id); // sponsored_student_id
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->student_firstname); // student_firstname
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->student_lastname); // student_lastname
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->schools_school_id); // schools_school_id
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->grade_year_id); // grade_year_id
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->class); // class
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->year); // year
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->promoted); // promoted
			$view_sponsored_student_grade->UpdateSort($view_sponsored_student_grade->programme); // programme
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
				$view_sponsored_student_grade->sponsored_student_id->setSort("");
				$view_sponsored_student_grade->student_firstname->setSort("");
				$view_sponsored_student_grade->student_lastname->setSort("");
				$view_sponsored_student_grade->schools_school_id->setSort("");
				$view_sponsored_student_grade->grade_year_id->setSort("");
				$view_sponsored_student_grade->class->setSort("");
				$view_sponsored_student_grade->year->setSort("");
				$view_sponsored_student_grade->promoted->setSort("");
				$view_sponsored_student_grade->programme->setSort("");
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
		$view_sponsored_student_grade->sponsored_student_id->setDbValue($rs->fields('sponsored_student_id'));
		$view_sponsored_student_grade->student_firstname->setDbValue($rs->fields('student_firstname'));
		$view_sponsored_student_grade->student_lastname->setDbValue($rs->fields('student_lastname'));
		$view_sponsored_student_grade->school_attendance_id->setDbValue($rs->fields('school_attendance_id'));
		$view_sponsored_student_grade->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$view_sponsored_student_grade->grade_year_id->setDbValue($rs->fields('grade_year_id'));
		$view_sponsored_student_grade->class->setDbValue($rs->fields('class'));
		$view_sponsored_student_grade->year->setDbValue($rs->fields('year'));
		$view_sponsored_student_grade->promoted->setDbValue($rs->fields('promoted'));
		$view_sponsored_student_grade->programme->setDbValue($rs->fields('programme'));
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
		// sponsored_student_id

		$view_sponsored_student_grade->sponsored_student_id->CellCssStyle = ""; $view_sponsored_student_grade->sponsored_student_id->CellCssClass = "";
		$view_sponsored_student_grade->sponsored_student_id->CellAttrs = array(); $view_sponsored_student_grade->sponsored_student_id->ViewAttrs = array(); $view_sponsored_student_grade->sponsored_student_id->EditAttrs = array();

		// student_firstname
		$view_sponsored_student_grade->student_firstname->CellCssStyle = ""; $view_sponsored_student_grade->student_firstname->CellCssClass = "";
		$view_sponsored_student_grade->student_firstname->CellAttrs = array(); $view_sponsored_student_grade->student_firstname->ViewAttrs = array(); $view_sponsored_student_grade->student_firstname->EditAttrs = array();

		// student_lastname
		$view_sponsored_student_grade->student_lastname->CellCssStyle = ""; $view_sponsored_student_grade->student_lastname->CellCssClass = "";
		$view_sponsored_student_grade->student_lastname->CellAttrs = array(); $view_sponsored_student_grade->student_lastname->ViewAttrs = array(); $view_sponsored_student_grade->student_lastname->EditAttrs = array();

		// schools_school_id
		$view_sponsored_student_grade->schools_school_id->CellCssStyle = ""; $view_sponsored_student_grade->schools_school_id->CellCssClass = "";
		$view_sponsored_student_grade->schools_school_id->CellAttrs = array(); $view_sponsored_student_grade->schools_school_id->ViewAttrs = array(); $view_sponsored_student_grade->schools_school_id->EditAttrs = array();

		// grade_year_id
		$view_sponsored_student_grade->grade_year_id->CellCssStyle = ""; $view_sponsored_student_grade->grade_year_id->CellCssClass = "";
		$view_sponsored_student_grade->grade_year_id->CellAttrs = array(); $view_sponsored_student_grade->grade_year_id->ViewAttrs = array(); $view_sponsored_student_grade->grade_year_id->EditAttrs = array();

		// class
		$view_sponsored_student_grade->class->CellCssStyle = ""; $view_sponsored_student_grade->class->CellCssClass = "";
		$view_sponsored_student_grade->class->CellAttrs = array(); $view_sponsored_student_grade->class->ViewAttrs = array(); $view_sponsored_student_grade->class->EditAttrs = array();

		// year
		$view_sponsored_student_grade->year->CellCssStyle = ""; $view_sponsored_student_grade->year->CellCssClass = "";
		$view_sponsored_student_grade->year->CellAttrs = array(); $view_sponsored_student_grade->year->ViewAttrs = array(); $view_sponsored_student_grade->year->EditAttrs = array();

		// promoted
		$view_sponsored_student_grade->promoted->CellCssStyle = ""; $view_sponsored_student_grade->promoted->CellCssClass = "";
		$view_sponsored_student_grade->promoted->CellAttrs = array(); $view_sponsored_student_grade->promoted->ViewAttrs = array(); $view_sponsored_student_grade->promoted->EditAttrs = array();

		// programme
		$view_sponsored_student_grade->programme->CellCssStyle = ""; $view_sponsored_student_grade->programme->CellCssClass = "";
		$view_sponsored_student_grade->programme->CellAttrs = array(); $view_sponsored_student_grade->programme->ViewAttrs = array(); $view_sponsored_student_grade->programme->EditAttrs = array();
		if ($view_sponsored_student_grade->RowType == EW_ROWTYPE_VIEW) { // View row

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

			// school_attendance_id
			$view_sponsored_student_grade->school_attendance_id->ViewValue = $view_sponsored_student_grade->school_attendance_id->CurrentValue;
			$view_sponsored_student_grade->school_attendance_id->CssStyle = "";
			$view_sponsored_student_grade->school_attendance_id->CssClass = "";
			$view_sponsored_student_grade->school_attendance_id->ViewCustomAttributes = "";

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

			// grade_year_id
			$view_sponsored_student_grade->grade_year_id->ViewValue = $view_sponsored_student_grade->grade_year_id->CurrentValue;
			$view_sponsored_student_grade->grade_year_id->CssStyle = "";
			$view_sponsored_student_grade->grade_year_id->CssClass = "";
			$view_sponsored_student_grade->grade_year_id->ViewCustomAttributes = "";

			// class
			$view_sponsored_student_grade->class->CssStyle = "";
			$view_sponsored_student_grade->class->CssClass = "";
			$view_sponsored_student_grade->class->ViewCustomAttributes = "";

			// year
			$view_sponsored_student_grade->year->ViewValue = $view_sponsored_student_grade->year->CurrentValue;
			$view_sponsored_student_grade->year->CssStyle = "";
			$view_sponsored_student_grade->year->CssClass = "";
			$view_sponsored_student_grade->year->ViewCustomAttributes = "";

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

			// sponsored_student_id
			$view_sponsored_student_grade->sponsored_student_id->HrefValue = "";
			$view_sponsored_student_grade->sponsored_student_id->TooltipValue = "";

			// student_firstname
			$view_sponsored_student_grade->student_firstname->HrefValue = "";
			$view_sponsored_student_grade->student_firstname->TooltipValue = "";

			// student_lastname
			$view_sponsored_student_grade->student_lastname->HrefValue = "";
			$view_sponsored_student_grade->student_lastname->TooltipValue = "";

			// schools_school_id
			$view_sponsored_student_grade->schools_school_id->HrefValue = "";
			$view_sponsored_student_grade->schools_school_id->TooltipValue = "";

			// grade_year_id
			$view_sponsored_student_grade->grade_year_id->HrefValue = "";
			$view_sponsored_student_grade->grade_year_id->TooltipValue = "";

			// class
			$view_sponsored_student_grade->class->HrefValue = "";
			$view_sponsored_student_grade->class->TooltipValue = "";

			// year
			$view_sponsored_student_grade->year->HrefValue = "";
			$view_sponsored_student_grade->year->TooltipValue = "";

			// promoted
			$view_sponsored_student_grade->promoted->HrefValue = "";
			$view_sponsored_student_grade->promoted->TooltipValue = "";

			// programme
			$view_sponsored_student_grade->programme->HrefValue = "";
			$view_sponsored_student_grade->programme->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($view_sponsored_student_grade->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$view_sponsored_student_grade->Row_Rendered();
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
				$ExportDoc->ExportCaption($view_sponsored_student_grade->sponsored_student_id);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->student_firstname);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->student_lastname);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->school_attendance_id);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->schools_school_id);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->grade_year_id);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->class);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->year);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->promoted);
				$ExportDoc->ExportCaption($view_sponsored_student_grade->programme);
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
					$XmlDoc->AddField('sponsored_student_id', $view_sponsored_student_grade->sponsored_student_id->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('student_firstname', $view_sponsored_student_grade->student_firstname->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('student_lastname', $view_sponsored_student_grade->student_lastname->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('school_attendance_id', $view_sponsored_student_grade->school_attendance_id->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('schools_school_id', $view_sponsored_student_grade->schools_school_id->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('grade_year_id', $view_sponsored_student_grade->grade_year_id->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('class', $view_sponsored_student_grade->class->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('year', $view_sponsored_student_grade->year->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('promoted', $view_sponsored_student_grade->promoted->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
					$XmlDoc->AddField('programme', $view_sponsored_student_grade->programme->ExportValue($view_sponsored_student_grade->Export, $view_sponsored_student_grade->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($view_sponsored_student_grade->sponsored_student_id);
					$ExportDoc->ExportField($view_sponsored_student_grade->student_firstname);
					$ExportDoc->ExportField($view_sponsored_student_grade->student_lastname);
					$ExportDoc->ExportField($view_sponsored_student_grade->school_attendance_id);
					$ExportDoc->ExportField($view_sponsored_student_grade->schools_school_id);
					$ExportDoc->ExportField($view_sponsored_student_grade->grade_year_id);
					$ExportDoc->ExportField($view_sponsored_student_grade->class);
					$ExportDoc->ExportField($view_sponsored_student_grade->year);
					$ExportDoc->ExportField($view_sponsored_student_grade->promoted);
					$ExportDoc->ExportField($view_sponsored_student_grade->programme);
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
            /*$this->ListOptions->Add("program");
	    $this->ListOptions->Items["program"]->OnLeft = FALSE; // Link on left
	    $this->ListOptions->Itmes["program"]->Visible=TRUE;*/

	    $this->ListOptions->Add("promote");
	    $this->ListOptions->Items["promote"]->OnLeft = FALSE; // Link on left
	    $this->ListOptions->Itmes["promote"]->Visible=TRUE;
	}

		// ListOptions Rendered event
	function ListOptions_Rendered() {
            global $view_sponsored_student_grade;
            $attendance_id=$view_sponsored_student_grade->school_attendance_id->CurrentValue;
            if($view_sponsored_student_grade->grade_year_id->CurrentValue==0){
                
                $this->ListOptions->Items["promote"]->Body.="<span onclick=\"setPromoted(this,$attendance_id,2011,1)\"
	                       style=\"color:blue;text-decoration: underline; cursor: pointer\">passed</span> | ";
                $this->ListOptions->Items["promote"]->Body.="<span onclick=\"setPromoted(this,$attendance_id,2011,0)\"
	                       style=\"color:blue;text-decoration: underline; cursor: pointer\">failed</span>";
            }else{
                $grade_year_id=$view_sponsored_student_grade->grade_year_id->CurrentValue;
                if($view_sponsored_student_grade->promoted->CurrentValue==0)
                {
                    $this->ListOptions->Items["promote"]->Body="<span>failed</span> |";
                    $promoted=1;
                }else{
                    $this->ListOptions->Items["promote"]->Body="<span>passed</span> |";
                    $promoted=0;
                }
                $this->ListOptions->Items["promote"]->Body.="<span onclick=\"updatePromoted(this,$grade_year_id,$promoted)\"
	                       style=\"color:blue;text-decoration: underline; cursor: pointer\">update</span>";
                
            }
                

	       
	}                                                                                                  
}
?>
