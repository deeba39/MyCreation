<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "school_attendanceinfo.php" ?>
<?php include "sponsored_studentinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "sponsored_student_detailinfo.php" ?>
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
$school_attendance_list = new cschool_attendance_list();
$Page =& $school_attendance_list;

// Page init
$school_attendance_list->Page_Init();

// Page main
$school_attendance_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($school_attendance->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var school_attendance_list = new ew_Page("school_attendance_list");

// page properties
school_attendance_list.PageID = "list"; // page ID
school_attendance_list.FormID = "fschool_attendancelist"; // form ID
var EW_PAGE_ID = school_attendance_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
school_attendance_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
school_attendance_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
school_attendance_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($school_attendance->Export == "") { ?>
<?php
$gsMasterReturnUrl = "sponsored_studentlist.php";
if ($school_attendance_list->sDbMasterFilter <> "" && $school_attendance->getCurrentMasterTable() == "sponsored_student") {
	if ($school_attendance_list->bMasterRecordExists) {
		if ($school_attendance->getCurrentMasterTable() == $school_attendance->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "sponsored_studentmaster.php" ?>
<?php
	}
}
?>
<?php
$gsMasterReturnUrl = "sponsored_student_detaillist.php";
if ($school_attendance_list->sDbMasterFilter <> "" && $school_attendance->getCurrentMasterTable() == "sponsored_student_detail") {
	if ($school_attendance_list->bMasterRecordExists) {
		if ($school_attendance->getCurrentMasterTable() == $school_attendance->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "sponsored_student_detailmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$school_attendance_list->lTotalRecs = $school_attendance->SelectRecordCount();
	} else {
		if ($rs = $school_attendance_list->LoadRecordset())
			$school_attendance_list->lTotalRecs = $rs->RecordCount();
	}
	$school_attendance_list->lStartRec = 1;
	if ($school_attendance_list->lDisplayRecs <= 0 || ($school_attendance->Export <> "" && $school_attendance->ExportAll)) // Display all records
		$school_attendance_list->lDisplayRecs = $school_attendance_list->lTotalRecs;
	if (!($school_attendance->Export <> "" && $school_attendance->ExportAll))
		$school_attendance_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $school_attendance_list->LoadRecordset($school_attendance_list->lStartRec-1, $school_attendance_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $school_attendance->TableCaption() ?>
<?php if ($school_attendance->Export == "" && $school_attendance->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $school_attendance_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $school_attendance_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $school_attendance_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($school_attendance->Export == "" && $school_attendance->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(school_attendance_list);" style="text-decoration: none;"><img id="school_attendance_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="school_attendance_list_SearchPanel">
<form name="fschool_attendancelistsrch" id="fschool_attendancelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="school_attendance">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $school_attendance_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="school_attendancesrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$school_attendance_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fschool_attendancelist" id="fschool_attendancelist" class="ewForm" action="" method="post">
<div id="gmp_school_attendance" class="ewGridMiddlePanel">
<?php if ($school_attendance_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $school_attendance->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$school_attendance_list->RenderListOptions();

// Render list options (header, left)
$school_attendance_list->ListOptions->Render("header", "left");
?>
<?php if ($school_attendance->start_date->Visible) { // start_date ?>
	<?php if ($school_attendance->SortUrl($school_attendance->start_date) == "") { ?>
		<td><?php echo $school_attendance->start_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $school_attendance->SortUrl($school_attendance->start_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $school_attendance->start_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($school_attendance->start_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($school_attendance->start_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($school_attendance->end_date->Visible) { // end_date ?>
	<?php if ($school_attendance->SortUrl($school_attendance->end_date) == "") { ?>
		<td><?php echo $school_attendance->end_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $school_attendance->SortUrl($school_attendance->end_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $school_attendance->end_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($school_attendance->end_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($school_attendance->end_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($school_attendance->schools_school_id->Visible) { // schools_school_id ?>
	<?php if ($school_attendance->SortUrl($school_attendance->schools_school_id) == "") { ?>
		<td><?php echo $school_attendance->schools_school_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $school_attendance->SortUrl($school_attendance->schools_school_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $school_attendance->schools_school_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($school_attendance->schools_school_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($school_attendance->schools_school_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($school_attendance->entry_level->Visible) { // entry_level ?>
	<?php if ($school_attendance->SortUrl($school_attendance->entry_level) == "") { ?>
		<td><?php echo $school_attendance->entry_level->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $school_attendance->SortUrl($school_attendance->entry_level) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $school_attendance->entry_level->FldCaption() ?></td><td style="width: 10px;"><?php if ($school_attendance->entry_level->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($school_attendance->entry_level->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($school_attendance->sponsored_student_sponsored_student_id->Visible) { // sponsored_student_sponsored_student_id ?>
	<?php if ($school_attendance->SortUrl($school_attendance->sponsored_student_sponsored_student_id) == "") { ?>
		<td><?php echo $school_attendance->sponsored_student_sponsored_student_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $school_attendance->SortUrl($school_attendance->sponsored_student_sponsored_student_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $school_attendance->sponsored_student_sponsored_student_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($school_attendance->sponsored_student_sponsored_student_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($school_attendance->sponsored_student_sponsored_student_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($school_attendance->program->Visible) { // program ?>
	<?php if ($school_attendance->SortUrl($school_attendance->program) == "") { ?>
		<td><?php echo $school_attendance->program->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $school_attendance->SortUrl($school_attendance->program) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $school_attendance->program->FldCaption() ?></td><td style="width: 10px;"><?php if ($school_attendance->program->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($school_attendance->program->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($school_attendance->attendance_type->Visible) { // attendance_type ?>
	<?php if ($school_attendance->SortUrl($school_attendance->attendance_type) == "") { ?>
		<td><?php echo $school_attendance->attendance_type->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $school_attendance->SortUrl($school_attendance->attendance_type) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $school_attendance->attendance_type->FldCaption() ?></td><td style="width: 10px;"><?php if ($school_attendance->attendance_type->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($school_attendance->attendance_type->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($school_attendance->group_id->Visible) { // group_id ?>
	<?php if ($school_attendance->SortUrl($school_attendance->group_id) == "") { ?>
		<td><?php echo $school_attendance->group_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $school_attendance->SortUrl($school_attendance->group_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $school_attendance->group_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($school_attendance->group_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($school_attendance->group_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$school_attendance_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($school_attendance->ExportAll && $school_attendance->Export <> "") {
	$school_attendance_list->lStopRec = $school_attendance_list->lTotalRecs;
} else {
	$school_attendance_list->lStopRec = $school_attendance_list->lStartRec + $school_attendance_list->lDisplayRecs - 1; // Set the last record to display
}
$school_attendance_list->lRecCount = $school_attendance_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $school_attendance_list->lStartRec > 1)
		$rs->Move($school_attendance_list->lStartRec - 1);
}

// Initialize aggregate
$school_attendance->RowType = EW_ROWTYPE_AGGREGATEINIT;
$school_attendance_list->RenderRow();
$school_attendance_list->lRowCnt = 0;
while (($school_attendance->CurrentAction == "gridadd" || !$rs->EOF) &&
	$school_attendance_list->lRecCount < $school_attendance_list->lStopRec) {
	$school_attendance_list->lRecCount++;
	if (intval($school_attendance_list->lRecCount) >= intval($school_attendance_list->lStartRec)) {
		$school_attendance_list->lRowCnt++;

	// Init row class and style
	$school_attendance->CssClass = "";
	$school_attendance->CssStyle = "";
	$school_attendance->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($school_attendance->CurrentAction == "gridadd") {
		$school_attendance_list->LoadDefaultValues(); // Load default values
	} else {
		$school_attendance_list->LoadRowValues($rs); // Load row values
	}
	$school_attendance->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$school_attendance_list->RenderRow();

	// Render list options
	$school_attendance_list->RenderListOptions();
?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
<?php

// Render list options (body, left)
$school_attendance_list->ListOptions->Render("body", "left");
?>
	<?php if ($school_attendance->start_date->Visible) { // start_date ?>
		<td<?php echo $school_attendance->start_date->CellAttributes() ?>>
<div<?php echo $school_attendance->start_date->ViewAttributes() ?>><?php echo $school_attendance->start_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($school_attendance->end_date->Visible) { // end_date ?>
		<td<?php echo $school_attendance->end_date->CellAttributes() ?>>
<div<?php echo $school_attendance->end_date->ViewAttributes() ?>><?php echo $school_attendance->end_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($school_attendance->schools_school_id->Visible) { // schools_school_id ?>
		<td<?php echo $school_attendance->schools_school_id->CellAttributes() ?>>
<div<?php echo $school_attendance->schools_school_id->ViewAttributes() ?>><?php echo $school_attendance->schools_school_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($school_attendance->entry_level->Visible) { // entry_level ?>
		<td<?php echo $school_attendance->entry_level->CellAttributes() ?>>
<div<?php echo $school_attendance->entry_level->ViewAttributes() ?>><?php echo $school_attendance->entry_level->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($school_attendance->sponsored_student_sponsored_student_id->Visible) { // sponsored_student_sponsored_student_id ?>
		<td<?php echo $school_attendance->sponsored_student_sponsored_student_id->CellAttributes() ?>>
<div<?php echo $school_attendance->sponsored_student_sponsored_student_id->ViewAttributes() ?>><?php echo $school_attendance->sponsored_student_sponsored_student_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($school_attendance->program->Visible) { // program ?>
		<td<?php echo $school_attendance->program->CellAttributes() ?>>
<div<?php echo $school_attendance->program->ViewAttributes() ?>><?php echo $school_attendance->program->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($school_attendance->attendance_type->Visible) { // attendance_type ?>
		<td<?php echo $school_attendance->attendance_type->CellAttributes() ?>>
<div<?php echo $school_attendance->attendance_type->ViewAttributes() ?>><?php echo $school_attendance->attendance_type->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($school_attendance->group_id->Visible) { // group_id ?>
		<td<?php echo $school_attendance->group_id->CellAttributes() ?>>
<div<?php echo $school_attendance->group_id->ViewAttributes() ?>><?php echo $school_attendance->group_id->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$school_attendance_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($school_attendance->CurrentAction <> "gridadd")
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
<?php if ($school_attendance->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($school_attendance->CurrentAction <> "gridadd" && $school_attendance->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($school_attendance_list->Pager)) $school_attendance_list->Pager = new cPrevNextPager($school_attendance_list->lStartRec, $school_attendance_list->lDisplayRecs, $school_attendance_list->lTotalRecs) ?>
<?php if ($school_attendance_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($school_attendance_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $school_attendance_list->PageUrl() ?>start=<?php echo $school_attendance_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($school_attendance_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $school_attendance_list->PageUrl() ?>start=<?php echo $school_attendance_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $school_attendance_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($school_attendance_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $school_attendance_list->PageUrl() ?>start=<?php echo $school_attendance_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($school_attendance_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $school_attendance_list->PageUrl() ?>start=<?php echo $school_attendance_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $school_attendance_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $school_attendance_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $school_attendance_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $school_attendance_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($school_attendance_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($school_attendance_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $school_attendance_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($school_attendance->Export == "" && $school_attendance->CurrentAction == "") { ?>
<?php } ?>
<?php if ($school_attendance->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$school_attendance_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cschool_attendance_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'school_attendance';

	// Page object name
	var $PageObjName = 'school_attendance_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $school_attendance;
		if ($school_attendance->UseTokenInUrl) $PageUrl .= "t=" . $school_attendance->TableVar . "&"; // Add page token
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
		global $objForm, $school_attendance;
		if ($school_attendance->UseTokenInUrl) {
			if ($objForm)
				return ($school_attendance->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($school_attendance->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cschool_attendance_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (school_attendance)
		$GLOBALS["school_attendance"] = new cschool_attendance();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["school_attendance"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "school_attendancedelete.php";
		$this->MultiUpdateUrl = "school_attendanceupdate.php";

		// Table object (sponsored_student)
		$GLOBALS['sponsored_student'] = new csponsored_student();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (sponsored_student_detail)
		$GLOBALS['sponsored_student_detail'] = new csponsored_student_detail();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'school_attendance', TRUE);

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
		global $school_attendance;

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
			$school_attendance->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$school_attendance->Export = $_POST["exporttype"];
		} else {
			$school_attendance->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $school_attendance->Export; // Get export parameter, used in header
		$gsExportFile = $school_attendance->TableVar; // Get export file, used in header
		if ($school_attendance->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($school_attendance->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $school_attendance;

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

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$school_attendance->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($school_attendance->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $school_attendance->getRecordsPerPage(); // Restore from Session
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
		$school_attendance->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$school_attendance->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$school_attendance->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $school_attendance->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $school_attendance->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $school_attendance->getDetailFilter(); // Restore detail filter

		// Add master User ID filter
		if ($Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			if ($school_attendance->getCurrentMasterTable() == "sponsored_student")
				$this->sDbMasterFilter = $school_attendance->AddMasterUserIDFilter($this->sDbMasterFilter, "sponsored_student"); // Add master User ID filter
			if ($school_attendance->getCurrentMasterTable() == "sponsored_student_detail")
				$this->sDbMasterFilter = $school_attendance->AddMasterUserIDFilter($this->sDbMasterFilter, "sponsored_student_detail"); // Add master User ID filter
		}
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($school_attendance->getMasterFilter() <> "" && $school_attendance->getCurrentMasterTable() == "sponsored_student") {
			global $sponsored_student;
			$rsmaster = $sponsored_student->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$school_attendance->setMasterFilter(""); // Clear master filter
				$school_attendance->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($school_attendance->getReturnUrl()); // Return to caller
			} else {
				$sponsored_student->LoadListRowValues($rsmaster);
				$sponsored_student->RowType = EW_ROWTYPE_MASTER; // Master row
				$sponsored_student->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Load master record
		if ($school_attendance->getMasterFilter() <> "" && $school_attendance->getCurrentMasterTable() == "sponsored_student_detail") {
			global $sponsored_student_detail;
			$rsmaster = $sponsored_student_detail->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$school_attendance->setMasterFilter(""); // Clear master filter
				$school_attendance->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($school_attendance->getReturnUrl()); // Return to caller
			} else {
				$sponsored_student_detail->LoadListRowValues($rsmaster);
				$sponsored_student_detail->RowType = EW_ROWTYPE_MASTER; // Master row
				$sponsored_student_detail->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$school_attendance->setSessionWhere($sFilter);
		$school_attendance->CurrentFilter = "";

		// Export data only
		if (in_array($school_attendance->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($school_attendance->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $school_attendance;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $school_attendance->school_attendance_id, FALSE); // school_attendance_id
		$this->BuildSearchSql($sWhere, $school_attendance->start_date, FALSE); // start_date
		$this->BuildSearchSql($sWhere, $school_attendance->end_date, FALSE); // end_date
		$this->BuildSearchSql($sWhere, $school_attendance->schools_school_id, FALSE); // schools_school_id
		$this->BuildSearchSql($sWhere, $school_attendance->entry_level, FALSE); // entry_level
		$this->BuildSearchSql($sWhere, $school_attendance->entry_class, FALSE); // entry_class
		$this->BuildSearchSql($sWhere, $school_attendance->sponsored_student_sponsored_student_id, FALSE); // sponsored_student_sponsored_student_id
		$this->BuildSearchSql($sWhere, $school_attendance->program, FALSE); // program
		$this->BuildSearchSql($sWhere, $school_attendance->attendance_type, FALSE); // attendance_type
		$this->BuildSearchSql($sWhere, $school_attendance->group_id, FALSE); // group_id

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($school_attendance->school_attendance_id); // school_attendance_id
			$this->SetSearchParm($school_attendance->start_date); // start_date
			$this->SetSearchParm($school_attendance->end_date); // end_date
			$this->SetSearchParm($school_attendance->schools_school_id); // schools_school_id
			$this->SetSearchParm($school_attendance->entry_level); // entry_level
			$this->SetSearchParm($school_attendance->entry_class); // entry_class
			$this->SetSearchParm($school_attendance->sponsored_student_sponsored_student_id); // sponsored_student_sponsored_student_id
			$this->SetSearchParm($school_attendance->program); // program
			$this->SetSearchParm($school_attendance->attendance_type); // attendance_type
			$this->SetSearchParm($school_attendance->group_id); // group_id
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
		global $school_attendance;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$school_attendance->setAdvancedSearch("x_$FldParm", $FldVal);
		$school_attendance->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$school_attendance->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$school_attendance->setAdvancedSearch("y_$FldParm", $FldVal2);
		$school_attendance->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $school_attendance;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $school_attendance->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $school_attendance->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $school_attendance->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $school_attendance->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $school_attendance->GetAdvancedSearch("w_$FldParm");
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

	// Clear all search parameters
	function ResetSearchParms() {
		global $school_attendance;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$school_attendance->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $school_attendance;
		$school_attendance->setAdvancedSearch("x_school_attendance_id", "");
		$school_attendance->setAdvancedSearch("x_start_date", "");
		$school_attendance->setAdvancedSearch("x_end_date", "");
		$school_attendance->setAdvancedSearch("x_schools_school_id", "");
		$school_attendance->setAdvancedSearch("x_entry_level", "");
		$school_attendance->setAdvancedSearch("x_entry_class", "");
		$school_attendance->setAdvancedSearch("x_sponsored_student_sponsored_student_id", "");
		$school_attendance->setAdvancedSearch("x_program", "");
		$school_attendance->setAdvancedSearch("x_attendance_type", "");
		$school_attendance->setAdvancedSearch("x_group_id", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $school_attendance;
		$bRestore = TRUE;
		if (@$_GET["x_school_attendance_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_start_date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_end_date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_schools_school_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_entry_level"] <> "") $bRestore = FALSE;
		if (@$_GET["x_entry_class"] <> "") $bRestore = FALSE;
		if (@$_GET["x_sponsored_student_sponsored_student_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_program"] <> "") $bRestore = FALSE;
		if (@$_GET["x_attendance_type"] <> "") $bRestore = FALSE;
		if (@$_GET["x_group_id"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($school_attendance->school_attendance_id);
			$this->GetSearchParm($school_attendance->start_date);
			$this->GetSearchParm($school_attendance->end_date);
			$this->GetSearchParm($school_attendance->schools_school_id);
			$this->GetSearchParm($school_attendance->entry_level);
			$this->GetSearchParm($school_attendance->entry_class);
			$this->GetSearchParm($school_attendance->sponsored_student_sponsored_student_id);
			$this->GetSearchParm($school_attendance->program);
			$this->GetSearchParm($school_attendance->attendance_type);
			$this->GetSearchParm($school_attendance->group_id);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $school_attendance;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$school_attendance->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$school_attendance->CurrentOrderType = @$_GET["ordertype"];
			$school_attendance->UpdateSort($school_attendance->start_date); // start_date
			$school_attendance->UpdateSort($school_attendance->end_date); // end_date
			$school_attendance->UpdateSort($school_attendance->schools_school_id); // schools_school_id
			$school_attendance->UpdateSort($school_attendance->entry_level); // entry_level
			$school_attendance->UpdateSort($school_attendance->sponsored_student_sponsored_student_id); // sponsored_student_sponsored_student_id
			$school_attendance->UpdateSort($school_attendance->program); // program
			$school_attendance->UpdateSort($school_attendance->attendance_type); // attendance_type
			$school_attendance->UpdateSort($school_attendance->group_id); // group_id
			$school_attendance->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $school_attendance;
		$sOrderBy = $school_attendance->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($school_attendance->SqlOrderBy() <> "") {
				$sOrderBy = $school_attendance->SqlOrderBy();
				$school_attendance->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $school_attendance;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$school_attendance->getCurrentMasterTable = ""; // Clear master table
				$school_attendance->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$school_attendance->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$school_attendance->sponsored_student_sponsored_student_id->setSessionValue("");
				$school_attendance->sponsored_student_sponsored_student_id->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$school_attendance->setSessionOrderBy($sOrderBy);
				$school_attendance->start_date->setSort("");
				$school_attendance->end_date->setSort("");
				$school_attendance->schools_school_id->setSort("");
				$school_attendance->entry_level->setSort("");
				$school_attendance->sponsored_student_sponsored_student_id->setSort("");
				$school_attendance->program->setSort("");
				$school_attendance->attendance_type->setSort("");
				$school_attendance->group_id->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$school_attendance->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $school_attendance;

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

		// "detail_grade_year"
		$this->ListOptions->Add("detail_grade_year");
		$item =& $this->ListOptions->Items["detail_grade_year"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('grade_year');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($school_attendance->Export <> "" ||
			$school_attendance->CurrentAction == "gridadd" ||
			$school_attendance->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $school_attendance;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $this->ShowOptionLink() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . "<img src=\"images/view.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $this->ShowOptionLink() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . "<img src=\"images/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		}

		// "detail_grade_year"
		$oListOpt =& $this->ListOptions->Items["detail_grade_year"];
		if ($Security->AllowList('grade_year') && $this->ShowOptionLink()) {
			$oListOpt->Body = "<img src=\"images/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("grade_year", "TblCaption");
			$oListOpt->Body = "<a href=\"grade_yearlist.php?" . EW_TABLE_SHOW_MASTER . "=school_attendance&school_attendance_id=" . urlencode(strval($school_attendance->school_attendance_id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $school_attendance;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $school_attendance;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$school_attendance->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$school_attendance->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $school_attendance->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$school_attendance->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$school_attendance->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$school_attendance->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $school_attendance;

		// Load search values
		// school_attendance_id

		$school_attendance->school_attendance_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_school_attendance_id"]);
		$school_attendance->school_attendance_id->AdvancedSearch->SearchOperator = @$_GET["z_school_attendance_id"];

		// start_date
		$school_attendance->start_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_start_date"]);
		$school_attendance->start_date->AdvancedSearch->SearchOperator = @$_GET["z_start_date"];

		// end_date
		$school_attendance->end_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_end_date"]);
		$school_attendance->end_date->AdvancedSearch->SearchOperator = @$_GET["z_end_date"];

		// schools_school_id
		$school_attendance->schools_school_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_schools_school_id"]);
		$school_attendance->schools_school_id->AdvancedSearch->SearchOperator = @$_GET["z_schools_school_id"];

		// entry_level
		$school_attendance->entry_level->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_entry_level"]);
		$school_attendance->entry_level->AdvancedSearch->SearchOperator = @$_GET["z_entry_level"];

		// entry_class
		$school_attendance->entry_class->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_entry_class"]);
		$school_attendance->entry_class->AdvancedSearch->SearchOperator = @$_GET["z_entry_class"];

		// sponsored_student_sponsored_student_id
		$school_attendance->sponsored_student_sponsored_student_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_sponsored_student_sponsored_student_id"]);
		$school_attendance->sponsored_student_sponsored_student_id->AdvancedSearch->SearchOperator = @$_GET["z_sponsored_student_sponsored_student_id"];

		// program
		$school_attendance->program->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_program"]);
		$school_attendance->program->AdvancedSearch->SearchOperator = @$_GET["z_program"];

		// attendance_type
		$school_attendance->attendance_type->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_attendance_type"]);
		$school_attendance->attendance_type->AdvancedSearch->SearchOperator = @$_GET["z_attendance_type"];

		// group_id
		$school_attendance->group_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_group_id"]);
		$school_attendance->group_id->AdvancedSearch->SearchOperator = @$_GET["z_group_id"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $school_attendance;

		// Call Recordset Selecting event
		$school_attendance->Recordset_Selecting($school_attendance->CurrentFilter);

		// Load List page SQL
		$sSql = $school_attendance->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$school_attendance->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $school_attendance;
		$sFilter = $school_attendance->KeyFilter();

		// Call Row Selecting event
		$school_attendance->Row_Selecting($sFilter);

		// Load SQL based on filter
		$school_attendance->CurrentFilter = $sFilter;
		$sSql = $school_attendance->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$school_attendance->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $school_attendance;
		$school_attendance->school_attendance_id->setDbValue($rs->fields('school_attendance_id'));
		$school_attendance->start_date->setDbValue($rs->fields('start_date'));
		$school_attendance->end_date->setDbValue($rs->fields('end_date'));
		$school_attendance->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$school_attendance->entry_level->setDbValue($rs->fields('entry_level'));
		$school_attendance->entry_class->setDbValue($rs->fields('entry_class'));
		$school_attendance->sponsored_student_sponsored_student_id->setDbValue($rs->fields('sponsored_student_sponsored_student_id'));
		$school_attendance->program->setDbValue($rs->fields('program'));
		$school_attendance->attendance_type->setDbValue($rs->fields('attendance_type'));
		$school_attendance->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $school_attendance;

		// Initialize URLs
		$this->ViewUrl = $school_attendance->ViewUrl();
		$this->EditUrl = $school_attendance->EditUrl();
		$this->InlineEditUrl = $school_attendance->InlineEditUrl();
		$this->CopyUrl = $school_attendance->CopyUrl();
		$this->InlineCopyUrl = $school_attendance->InlineCopyUrl();
		$this->DeleteUrl = $school_attendance->DeleteUrl();

		// Call Row_Rendering event
		$school_attendance->Row_Rendering();

		// Common render codes for all row types
		// start_date

		$school_attendance->start_date->CellCssStyle = ""; $school_attendance->start_date->CellCssClass = "";
		$school_attendance->start_date->CellAttrs = array(); $school_attendance->start_date->ViewAttrs = array(); $school_attendance->start_date->EditAttrs = array();

		// end_date
		$school_attendance->end_date->CellCssStyle = ""; $school_attendance->end_date->CellCssClass = "";
		$school_attendance->end_date->CellAttrs = array(); $school_attendance->end_date->ViewAttrs = array(); $school_attendance->end_date->EditAttrs = array();

		// schools_school_id
		$school_attendance->schools_school_id->CellCssStyle = ""; $school_attendance->schools_school_id->CellCssClass = "";
		$school_attendance->schools_school_id->CellAttrs = array(); $school_attendance->schools_school_id->ViewAttrs = array(); $school_attendance->schools_school_id->EditAttrs = array();

		// entry_level
		$school_attendance->entry_level->CellCssStyle = ""; $school_attendance->entry_level->CellCssClass = "";
		$school_attendance->entry_level->CellAttrs = array(); $school_attendance->entry_level->ViewAttrs = array(); $school_attendance->entry_level->EditAttrs = array();

		// sponsored_student_sponsored_student_id
		$school_attendance->sponsored_student_sponsored_student_id->CellCssStyle = ""; $school_attendance->sponsored_student_sponsored_student_id->CellCssClass = "";
		$school_attendance->sponsored_student_sponsored_student_id->CellAttrs = array(); $school_attendance->sponsored_student_sponsored_student_id->ViewAttrs = array(); $school_attendance->sponsored_student_sponsored_student_id->EditAttrs = array();

		// program
		$school_attendance->program->CellCssStyle = ""; $school_attendance->program->CellCssClass = "";
		$school_attendance->program->CellAttrs = array(); $school_attendance->program->ViewAttrs = array(); $school_attendance->program->EditAttrs = array();

		// attendance_type
		$school_attendance->attendance_type->CellCssStyle = ""; $school_attendance->attendance_type->CellCssClass = "";
		$school_attendance->attendance_type->CellAttrs = array(); $school_attendance->attendance_type->ViewAttrs = array(); $school_attendance->attendance_type->EditAttrs = array();

		// group_id
		$school_attendance->group_id->CellCssStyle = ""; $school_attendance->group_id->CellCssClass = "";
		$school_attendance->group_id->CellAttrs = array(); $school_attendance->group_id->ViewAttrs = array(); $school_attendance->group_id->EditAttrs = array();
		if ($school_attendance->RowType == EW_ROWTYPE_VIEW) { // View row

			// school_attendance_id
			$school_attendance->school_attendance_id->ViewValue = $school_attendance->school_attendance_id->CurrentValue;
			$school_attendance->school_attendance_id->CssStyle = "";
			$school_attendance->school_attendance_id->CssClass = "";
			$school_attendance->school_attendance_id->ViewCustomAttributes = "";

			// start_date
			$school_attendance->start_date->ViewValue = $school_attendance->start_date->CurrentValue;
			$school_attendance->start_date->ViewValue = ew_FormatDateTime($school_attendance->start_date->ViewValue, 7);
			$school_attendance->start_date->CssStyle = "";
			$school_attendance->start_date->CssClass = "";
			$school_attendance->start_date->ViewCustomAttributes = "";

			// end_date
			$school_attendance->end_date->ViewValue = $school_attendance->end_date->CurrentValue;
			$school_attendance->end_date->ViewValue = ew_FormatDateTime($school_attendance->end_date->ViewValue, 7);
			$school_attendance->end_date->CssStyle = "";
			$school_attendance->end_date->CssClass = "";
			$school_attendance->end_date->ViewCustomAttributes = "";

			// schools_school_id
			if (strval($school_attendance->schools_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($school_attendance->schools_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$school_attendance->schools_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$school_attendance->schools_school_id->ViewValue = $school_attendance->schools_school_id->CurrentValue;
				}
			} else {
				$school_attendance->schools_school_id->ViewValue = NULL;
			}
			$school_attendance->schools_school_id->CssStyle = "";
			$school_attendance->schools_school_id->CssClass = "";
			$school_attendance->schools_school_id->ViewCustomAttributes = "";

			// entry_level
			if (strval($school_attendance->entry_level->CurrentValue) <> "") {
				switch ($school_attendance->entry_level->CurrentValue) {
					case "SSS":
						$school_attendance->entry_level->ViewValue = "SSS";
						break;
					case "TERTIARY":
						$school_attendance->entry_level->ViewValue = "TERTIARY";
						break;
					case "JSS":
						$school_attendance->entry_level->ViewValue = "JSS";
						break;
					case "PRIMARY":
						$school_attendance->entry_level->ViewValue = "PRIMARY";
						break;
					default:
						$school_attendance->entry_level->ViewValue = $school_attendance->entry_level->CurrentValue;
				}
			} else {
				$school_attendance->entry_level->ViewValue = NULL;
			}
			$school_attendance->entry_level->CssStyle = "";
			$school_attendance->entry_level->CssClass = "";
			$school_attendance->entry_level->ViewCustomAttributes = "";

			// entry_class
			$school_attendance->entry_class->ViewValue = $school_attendance->entry_class->CurrentValue;
			$school_attendance->entry_class->CssStyle = "";
			$school_attendance->entry_class->CssClass = "";
			$school_attendance->entry_class->ViewCustomAttributes = "";

			// sponsored_student_sponsored_student_id
			if (strval($school_attendance->sponsored_student_sponsored_student_id->CurrentValue) <> "") {
				$sFilterWrk = "`sponsored_student_id` = " . ew_AdjustSql($school_attendance->sponsored_student_sponsored_student_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `student_lastname`, `student_firstname` FROM `sponsored_student`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$school_attendance->sponsored_student_sponsored_student_id->ViewValue = $rswrk->fields('student_lastname');
					$school_attendance->sponsored_student_sponsored_student_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('student_firstname');
					$rswrk->Close();
				} else {
					$school_attendance->sponsored_student_sponsored_student_id->ViewValue = $school_attendance->sponsored_student_sponsored_student_id->CurrentValue;
				}
			} else {
				$school_attendance->sponsored_student_sponsored_student_id->ViewValue = NULL;
			}
			$school_attendance->sponsored_student_sponsored_student_id->CssStyle = "";
			$school_attendance->sponsored_student_sponsored_student_id->CssClass = "";
			$school_attendance->sponsored_student_sponsored_student_id->ViewCustomAttributes = "";

			// program
			$school_attendance->program->ViewValue = $school_attendance->program->CurrentValue;
			$school_attendance->program->CssStyle = "";
			$school_attendance->program->CssClass = "";
			$school_attendance->program->ViewCustomAttributes = "";

			// attendance_type
			if (strval($school_attendance->attendance_type->CurrentValue) <> "") {
				switch ($school_attendance->attendance_type->CurrentValue) {
					case "BOARDER":
						$school_attendance->attendance_type->ViewValue = "BOARDER";
						break;
					case "DAY":
						$school_attendance->attendance_type->ViewValue = "DAY";
						break;
					default:
						$school_attendance->attendance_type->ViewValue = $school_attendance->attendance_type->CurrentValue;
				}
			} else {
				$school_attendance->attendance_type->ViewValue = NULL;
			}
			$school_attendance->attendance_type->CssStyle = "";
			$school_attendance->attendance_type->CssClass = "";
			$school_attendance->attendance_type->ViewCustomAttributes = "";

			// group_id
			$school_attendance->group_id->ViewValue = $school_attendance->group_id->CurrentValue;
			$school_attendance->group_id->CssStyle = "";
			$school_attendance->group_id->CssClass = "";
			$school_attendance->group_id->ViewCustomAttributes = "";

			// start_date
			$school_attendance->start_date->HrefValue = "";
			$school_attendance->start_date->TooltipValue = "";

			// end_date
			$school_attendance->end_date->HrefValue = "";
			$school_attendance->end_date->TooltipValue = "";

			// schools_school_id
			$school_attendance->schools_school_id->HrefValue = "";
			$school_attendance->schools_school_id->TooltipValue = "";

			// entry_level
			$school_attendance->entry_level->HrefValue = "";
			$school_attendance->entry_level->TooltipValue = "";

			// sponsored_student_sponsored_student_id
			$school_attendance->sponsored_student_sponsored_student_id->HrefValue = "";
			$school_attendance->sponsored_student_sponsored_student_id->TooltipValue = "";

			// program
			$school_attendance->program->HrefValue = "";
			$school_attendance->program->TooltipValue = "";

			// attendance_type
			$school_attendance->attendance_type->HrefValue = "";
			$school_attendance->attendance_type->TooltipValue = "";

			// group_id
			$school_attendance->group_id->HrefValue = "";
			$school_attendance->group_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($school_attendance->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$school_attendance->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $school_attendance;

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
		global $school_attendance;
		$school_attendance->school_attendance_id->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_school_attendance_id");
		$school_attendance->start_date->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_start_date");
		$school_attendance->end_date->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_end_date");
		$school_attendance->schools_school_id->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_schools_school_id");
		$school_attendance->entry_level->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_entry_level");
		$school_attendance->entry_class->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_entry_class");
		$school_attendance->sponsored_student_sponsored_student_id->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_sponsored_student_sponsored_student_id");
		$school_attendance->program->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_program");
		$school_attendance->attendance_type->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_attendance_type");
		$school_attendance->group_id->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_group_id");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $school_attendance;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $school_attendance->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($school_attendance->ExportAll) {
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
		if ($school_attendance->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($school_attendance, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($school_attendance->school_attendance_id);
				$ExportDoc->ExportCaption($school_attendance->start_date);
				$ExportDoc->ExportCaption($school_attendance->end_date);
				$ExportDoc->ExportCaption($school_attendance->schools_school_id);
				$ExportDoc->ExportCaption($school_attendance->entry_level);
				$ExportDoc->ExportCaption($school_attendance->entry_class);
				$ExportDoc->ExportCaption($school_attendance->sponsored_student_sponsored_student_id);
				$ExportDoc->ExportCaption($school_attendance->program);
				$ExportDoc->ExportCaption($school_attendance->attendance_type);
				$ExportDoc->ExportCaption($school_attendance->group_id);
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
				$school_attendance->CssClass = "";
				$school_attendance->CssStyle = "";
				$school_attendance->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($school_attendance->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('school_attendance_id', $school_attendance->school_attendance_id->ExportValue($school_attendance->Export, $school_attendance->ExportOriginalValue));
					$XmlDoc->AddField('start_date', $school_attendance->start_date->ExportValue($school_attendance->Export, $school_attendance->ExportOriginalValue));
					$XmlDoc->AddField('end_date', $school_attendance->end_date->ExportValue($school_attendance->Export, $school_attendance->ExportOriginalValue));
					$XmlDoc->AddField('schools_school_id', $school_attendance->schools_school_id->ExportValue($school_attendance->Export, $school_attendance->ExportOriginalValue));
					$XmlDoc->AddField('entry_level', $school_attendance->entry_level->ExportValue($school_attendance->Export, $school_attendance->ExportOriginalValue));
					$XmlDoc->AddField('entry_class', $school_attendance->entry_class->ExportValue($school_attendance->Export, $school_attendance->ExportOriginalValue));
					$XmlDoc->AddField('sponsored_student_sponsored_student_id', $school_attendance->sponsored_student_sponsored_student_id->ExportValue($school_attendance->Export, $school_attendance->ExportOriginalValue));
					$XmlDoc->AddField('program', $school_attendance->program->ExportValue($school_attendance->Export, $school_attendance->ExportOriginalValue));
					$XmlDoc->AddField('attendance_type', $school_attendance->attendance_type->ExportValue($school_attendance->Export, $school_attendance->ExportOriginalValue));
					$XmlDoc->AddField('group_id', $school_attendance->group_id->ExportValue($school_attendance->Export, $school_attendance->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($school_attendance->school_attendance_id);
					$ExportDoc->ExportField($school_attendance->start_date);
					$ExportDoc->ExportField($school_attendance->end_date);
					$ExportDoc->ExportField($school_attendance->schools_school_id);
					$ExportDoc->ExportField($school_attendance->entry_level);
					$ExportDoc->ExportField($school_attendance->entry_class);
					$ExportDoc->ExportField($school_attendance->sponsored_student_sponsored_student_id);
					$ExportDoc->ExportField($school_attendance->program);
					$ExportDoc->ExportField($school_attendance->attendance_type);
					$ExportDoc->ExportField($school_attendance->group_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($school_attendance->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($school_attendance->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($school_attendance->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($school_attendance->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($school_attendance->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $school_attendance;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($school_attendance->group_id->CurrentValue);
			}
		}
		return TRUE;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $school_attendance;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "sponsored_student") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $school_attendance->SqlMasterFilter_sponsored_student();
				$this->sDbDetailFilter = $school_attendance->SqlDetailFilter_sponsored_student();
				if (@$_GET["sponsored_student_id"] <> "") {
					$GLOBALS["sponsored_student"]->sponsored_student_id->setQueryStringValue($_GET["sponsored_student_id"]);
					$school_attendance->sponsored_student_sponsored_student_id->setQueryStringValue($GLOBALS["sponsored_student"]->sponsored_student_id->QueryStringValue);
					$school_attendance->sponsored_student_sponsored_student_id->setSessionValue($school_attendance->sponsored_student_sponsored_student_id->QueryStringValue);
					if (!is_numeric($GLOBALS["sponsored_student"]->sponsored_student_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@sponsored_student_id@", ew_AdjustSql($GLOBALS["sponsored_student"]->sponsored_student_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@sponsored_student_sponsored_student_id@", ew_AdjustSql($GLOBALS["sponsored_student"]->sponsored_student_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
			if ($sMasterTblVar == "sponsored_student_detail") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $school_attendance->SqlMasterFilter_sponsored_student_detail();
				$this->sDbDetailFilter = $school_attendance->SqlDetailFilter_sponsored_student_detail();
				if (@$_GET["sponsored_student_id"] <> "") {
					$GLOBALS["sponsored_student_detail"]->sponsored_student_id->setQueryStringValue($_GET["sponsored_student_id"]);
					$school_attendance->sponsored_student_sponsored_student_id->setQueryStringValue($GLOBALS["sponsored_student_detail"]->sponsored_student_id->QueryStringValue);
					$school_attendance->sponsored_student_sponsored_student_id->setSessionValue($school_attendance->sponsored_student_sponsored_student_id->QueryStringValue);
					if (!is_numeric($GLOBALS["sponsored_student_detail"]->sponsored_student_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@sponsored_student_id@", ew_AdjustSql($GLOBALS["sponsored_student_detail"]->sponsored_student_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@sponsored_student_sponsored_student_id@", ew_AdjustSql($GLOBALS["sponsored_student_detail"]->sponsored_student_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$school_attendance->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$school_attendance->setStartRecordNumber($this->lStartRec);
			$school_attendance->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$school_attendance->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "sponsored_student") {
				if ($school_attendance->sponsored_student_sponsored_student_id->QueryStringValue == "") $school_attendance->sponsored_student_sponsored_student_id->setSessionValue("");
			}
			if ($sMasterTblVar <> "sponsored_student_detail") {
				if ($school_attendance->sponsored_student_sponsored_student_id->QueryStringValue == "") $school_attendance->sponsored_student_sponsored_student_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $school_attendance->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $school_attendance->getDetailFilter(); // Restore detail filter
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'school_attendance';
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
