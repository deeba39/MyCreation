<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "scholarship_packageinfo.php" ?>
<?php include "sponsored_studentinfo.php" ?>
<?php include "grant_packageinfo.php" ?>
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
$scholarship_package_list = new cscholarship_package_list();
$Page =& $scholarship_package_list;

// Page init
$scholarship_package_list->Page_Init();

// Page main
$scholarship_package_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($scholarship_package->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var scholarship_package_list = new ew_Page("scholarship_package_list");

// page properties
scholarship_package_list.PageID = "list"; // page ID
scholarship_package_list.FormID = "fscholarship_packagelist"; // form ID
var EW_PAGE_ID = scholarship_package_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
scholarship_package_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
scholarship_package_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
scholarship_package_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($scholarship_package->Export == "") { ?>
<?php
$gsMasterReturnUrl = "grant_packagelist.php";
if ($scholarship_package_list->sDbMasterFilter <> "" && $scholarship_package->getCurrentMasterTable() == "grant_package") {
	if ($scholarship_package_list->bMasterRecordExists) {
		if ($scholarship_package->getCurrentMasterTable() == $scholarship_package->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "grant_packagemaster.php" ?>
<?php
	}
}
?>
<?php
$gsMasterReturnUrl = "sponsored_studentlist.php";
if ($scholarship_package_list->sDbMasterFilter <> "" && $scholarship_package->getCurrentMasterTable() == "sponsored_student") {
	if ($scholarship_package_list->bMasterRecordExists) {
		if ($scholarship_package->getCurrentMasterTable() == $scholarship_package->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "sponsored_studentmaster.php" ?>
<?php
	}
}
?>
<?php
$gsMasterReturnUrl = "sponsored_student_detaillist.php";
if ($scholarship_package_list->sDbMasterFilter <> "" && $scholarship_package->getCurrentMasterTable() == "sponsored_student_detail") {
	if ($scholarship_package_list->bMasterRecordExists) {
		if ($scholarship_package->getCurrentMasterTable() == $scholarship_package->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
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
		$scholarship_package_list->lTotalRecs = $scholarship_package->SelectRecordCount();
	} else {
		if ($rs = $scholarship_package_list->LoadRecordset())
			$scholarship_package_list->lTotalRecs = $rs->RecordCount();
	}
	$scholarship_package_list->lStartRec = 1;
	if ($scholarship_package_list->lDisplayRecs <= 0 || ($scholarship_package->Export <> "" && $scholarship_package->ExportAll)) // Display all records
		$scholarship_package_list->lDisplayRecs = $scholarship_package_list->lTotalRecs;
	if (!($scholarship_package->Export <> "" && $scholarship_package->ExportAll))
		$scholarship_package_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $scholarship_package_list->LoadRecordset($scholarship_package_list->lStartRec-1, $scholarship_package_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $scholarship_package->TableCaption() ?>
<?php if ($scholarship_package->Export == "" && $scholarship_package->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $scholarship_package_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $scholarship_package_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $scholarship_package_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$scholarship_package_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fscholarship_packagelist" id="fscholarship_packagelist" class="ewForm" action="" method="post">
<div id="gmp_scholarship_package" class="ewGridMiddlePanel">
<?php if ($scholarship_package_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $scholarship_package->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$scholarship_package_list->RenderListOptions();

// Render list options (header, left)
$scholarship_package_list->ListOptions->Render("header", "left");
?>
<?php if ($scholarship_package->scholarship_package_id->Visible) { // scholarship_package_id ?>
	<?php if ($scholarship_package->SortUrl($scholarship_package->scholarship_package_id) == "") { ?>
		<td><?php echo $scholarship_package->scholarship_package_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_package->SortUrl($scholarship_package->scholarship_package_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_package->scholarship_package_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_package->scholarship_package_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_package->scholarship_package_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_package->start_date->Visible) { // start_date ?>
	<?php if ($scholarship_package->SortUrl($scholarship_package->start_date) == "") { ?>
		<td><?php echo $scholarship_package->start_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_package->SortUrl($scholarship_package->start_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_package->start_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_package->start_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_package->start_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_package->end_date->Visible) { // end_date ?>
	<?php if ($scholarship_package->SortUrl($scholarship_package->end_date) == "") { ?>
		<td><?php echo $scholarship_package->end_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_package->SortUrl($scholarship_package->end_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_package->end_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_package->end_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_package->end_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_package->status->Visible) { // status ?>
	<?php if ($scholarship_package->SortUrl($scholarship_package->status) == "") { ?>
		<td><?php echo $scholarship_package->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_package->SortUrl($scholarship_package->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_package->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_package->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_package->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_package->annual_amount->Visible) { // annual_amount ?>
	<?php if ($scholarship_package->SortUrl($scholarship_package->annual_amount) == "") { ?>
		<td><?php echo $scholarship_package->annual_amount->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_package->SortUrl($scholarship_package->annual_amount) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_package->annual_amount->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_package->annual_amount->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_package->annual_amount->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_package->grant_package_grant_package_id->Visible) { // grant_package_grant_package_id ?>
	<?php if ($scholarship_package->SortUrl($scholarship_package->grant_package_grant_package_id) == "") { ?>
		<td><?php echo $scholarship_package->grant_package_grant_package_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_package->SortUrl($scholarship_package->grant_package_grant_package_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_package->grant_package_grant_package_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_package->grant_package_grant_package_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_package->grant_package_grant_package_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_package->sponsored_student_sponsored_student_id->Visible) { // sponsored_student_sponsored_student_id ?>
	<?php if ($scholarship_package->SortUrl($scholarship_package->sponsored_student_sponsored_student_id) == "") { ?>
		<td><?php echo $scholarship_package->sponsored_student_sponsored_student_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_package->SortUrl($scholarship_package->sponsored_student_sponsored_student_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_package->sponsored_student_sponsored_student_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_package->sponsored_student_sponsored_student_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_package->sponsored_student_sponsored_student_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_package->scholarship_type->Visible) { // scholarship_type ?>
	<?php if ($scholarship_package->SortUrl($scholarship_package->scholarship_type) == "") { ?>
		<td><?php echo $scholarship_package->scholarship_type->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_package->SortUrl($scholarship_package->scholarship_type) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_package->scholarship_type->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_package->scholarship_type->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_package->scholarship_type->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_package->scholarship_type_scholarship_type->Visible) { // scholarship_type_scholarship_type ?>
	<?php if ($scholarship_package->SortUrl($scholarship_package->scholarship_type_scholarship_type) == "") { ?>
		<td><?php echo $scholarship_package->scholarship_type_scholarship_type->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_package->SortUrl($scholarship_package->scholarship_type_scholarship_type) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_package->scholarship_type_scholarship_type->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_package->scholarship_type_scholarship_type->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_package->scholarship_type_scholarship_type->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_package->group_id->Visible) { // group_id ?>
	<?php if ($scholarship_package->SortUrl($scholarship_package->group_id) == "") { ?>
		<td><?php echo $scholarship_package->group_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_package->SortUrl($scholarship_package->group_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_package->group_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_package->group_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_package->group_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$scholarship_package_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($scholarship_package->ExportAll && $scholarship_package->Export <> "") {
	$scholarship_package_list->lStopRec = $scholarship_package_list->lTotalRecs;
} else {
	$scholarship_package_list->lStopRec = $scholarship_package_list->lStartRec + $scholarship_package_list->lDisplayRecs - 1; // Set the last record to display
}
$scholarship_package_list->lRecCount = $scholarship_package_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $scholarship_package_list->lStartRec > 1)
		$rs->Move($scholarship_package_list->lStartRec - 1);
}

// Initialize aggregate
$scholarship_package->RowType = EW_ROWTYPE_AGGREGATEINIT;
$scholarship_package_list->RenderRow();
$scholarship_package_list->lRowCnt = 0;
while (($scholarship_package->CurrentAction == "gridadd" || !$rs->EOF) &&
	$scholarship_package_list->lRecCount < $scholarship_package_list->lStopRec) {
	$scholarship_package_list->lRecCount++;
	if (intval($scholarship_package_list->lRecCount) >= intval($scholarship_package_list->lStartRec)) {
		$scholarship_package_list->lRowCnt++;

	// Init row class and style
	$scholarship_package->CssClass = "";
	$scholarship_package->CssStyle = "";
	$scholarship_package->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($scholarship_package->CurrentAction == "gridadd") {
		$scholarship_package_list->LoadDefaultValues(); // Load default values
	} else {
		$scholarship_package_list->LoadRowValues($rs); // Load row values
	}
	$scholarship_package->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$scholarship_package_list->RenderRow();

	// Render list options
	$scholarship_package_list->RenderListOptions();
?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
<?php

// Render list options (body, left)
$scholarship_package_list->ListOptions->Render("body", "left");
?>
	<?php if ($scholarship_package->scholarship_package_id->Visible) { // scholarship_package_id ?>
		<td<?php echo $scholarship_package->scholarship_package_id->CellAttributes() ?>>
<div<?php echo $scholarship_package->scholarship_package_id->ViewAttributes() ?>><?php echo $scholarship_package->scholarship_package_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_package->start_date->Visible) { // start_date ?>
		<td<?php echo $scholarship_package->start_date->CellAttributes() ?>>
<div<?php echo $scholarship_package->start_date->ViewAttributes() ?>><?php echo $scholarship_package->start_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_package->end_date->Visible) { // end_date ?>
		<td<?php echo $scholarship_package->end_date->CellAttributes() ?>>
<div<?php echo $scholarship_package->end_date->ViewAttributes() ?>><?php echo $scholarship_package->end_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_package->status->Visible) { // status ?>
		<td<?php echo $scholarship_package->status->CellAttributes() ?>>
<div<?php echo $scholarship_package->status->ViewAttributes() ?>><?php echo $scholarship_package->status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_package->annual_amount->Visible) { // annual_amount ?>
		<td<?php echo $scholarship_package->annual_amount->CellAttributes() ?>>
<div<?php echo $scholarship_package->annual_amount->ViewAttributes() ?>><?php echo $scholarship_package->annual_amount->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_package->grant_package_grant_package_id->Visible) { // grant_package_grant_package_id ?>
		<td<?php echo $scholarship_package->grant_package_grant_package_id->CellAttributes() ?>>
<div<?php echo $scholarship_package->grant_package_grant_package_id->ViewAttributes() ?>><?php echo $scholarship_package->grant_package_grant_package_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_package->sponsored_student_sponsored_student_id->Visible) { // sponsored_student_sponsored_student_id ?>
		<td<?php echo $scholarship_package->sponsored_student_sponsored_student_id->CellAttributes() ?>>
<div<?php echo $scholarship_package->sponsored_student_sponsored_student_id->ViewAttributes() ?>><?php echo $scholarship_package->sponsored_student_sponsored_student_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_package->scholarship_type->Visible) { // scholarship_type ?>
		<td<?php echo $scholarship_package->scholarship_type->CellAttributes() ?>>
<div<?php echo $scholarship_package->scholarship_type->ViewAttributes() ?>><?php echo $scholarship_package->scholarship_type->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_package->scholarship_type_scholarship_type->Visible) { // scholarship_type_scholarship_type ?>
		<td<?php echo $scholarship_package->scholarship_type_scholarship_type->CellAttributes() ?>>
<div<?php echo $scholarship_package->scholarship_type_scholarship_type->ViewAttributes() ?>><?php echo $scholarship_package->scholarship_type_scholarship_type->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_package->group_id->Visible) { // group_id ?>
		<td<?php echo $scholarship_package->group_id->CellAttributes() ?>>
<div<?php echo $scholarship_package->group_id->ViewAttributes() ?>><?php echo $scholarship_package->group_id->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$scholarship_package_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($scholarship_package->CurrentAction <> "gridadd")
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
<?php if ($scholarship_package->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($scholarship_package->CurrentAction <> "gridadd" && $scholarship_package->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($scholarship_package_list->Pager)) $scholarship_package_list->Pager = new cPrevNextPager($scholarship_package_list->lStartRec, $scholarship_package_list->lDisplayRecs, $scholarship_package_list->lTotalRecs) ?>
<?php if ($scholarship_package_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($scholarship_package_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $scholarship_package_list->PageUrl() ?>start=<?php echo $scholarship_package_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($scholarship_package_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $scholarship_package_list->PageUrl() ?>start=<?php echo $scholarship_package_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $scholarship_package_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($scholarship_package_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $scholarship_package_list->PageUrl() ?>start=<?php echo $scholarship_package_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($scholarship_package_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $scholarship_package_list->PageUrl() ?>start=<?php echo $scholarship_package_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $scholarship_package_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $scholarship_package_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $scholarship_package_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $scholarship_package_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($scholarship_package_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($scholarship_package_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($scholarship_package->Export == "" && $scholarship_package->CurrentAction == "") { ?>
<?php } ?>
<?php if ($scholarship_package->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$scholarship_package_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cscholarship_package_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'scholarship_package';

	// Page object name
	var $PageObjName = 'scholarship_package_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $scholarship_package;
		if ($scholarship_package->UseTokenInUrl) $PageUrl .= "t=" . $scholarship_package->TableVar . "&"; // Add page token
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
		global $objForm, $scholarship_package;
		if ($scholarship_package->UseTokenInUrl) {
			if ($objForm)
				return ($scholarship_package->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($scholarship_package->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cscholarship_package_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (scholarship_package)
		$GLOBALS["scholarship_package"] = new cscholarship_package();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["scholarship_package"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "scholarship_packagedelete.php";
		$this->MultiUpdateUrl = "scholarship_packageupdate.php";

		// Table object (sponsored_student)
		$GLOBALS['sponsored_student'] = new csponsored_student();

		// Table object (grant_package)
		$GLOBALS['grant_package'] = new cgrant_package();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (sponsored_student_detail)
		$GLOBALS['sponsored_student_detail'] = new csponsored_student_detail();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'scholarship_package', TRUE);

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
		global $scholarship_package;

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
			$scholarship_package->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$scholarship_package->Export = $_POST["exporttype"];
		} else {
			$scholarship_package->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $scholarship_package->Export; // Get export parameter, used in header
		$gsExportFile = $scholarship_package->TableVar; // Get export file, used in header
		if ($scholarship_package->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($scholarship_package->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $scholarship_package;

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

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($scholarship_package->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $scholarship_package->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $scholarship_package->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $scholarship_package->getDetailFilter(); // Restore detail filter

		// Add master User ID filter
		if ($Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			if ($scholarship_package->getCurrentMasterTable() == "grant_package")
				$this->sDbMasterFilter = $scholarship_package->AddMasterUserIDFilter($this->sDbMasterFilter, "grant_package"); // Add master User ID filter
			if ($scholarship_package->getCurrentMasterTable() == "sponsored_student")
				$this->sDbMasterFilter = $scholarship_package->AddMasterUserIDFilter($this->sDbMasterFilter, "sponsored_student"); // Add master User ID filter
			if ($scholarship_package->getCurrentMasterTable() == "sponsored_student_detail")
				$this->sDbMasterFilter = $scholarship_package->AddMasterUserIDFilter($this->sDbMasterFilter, "sponsored_student_detail"); // Add master User ID filter
		}
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($scholarship_package->getMasterFilter() <> "" && $scholarship_package->getCurrentMasterTable() == "grant_package") {
			global $grant_package;
			$rsmaster = $grant_package->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$scholarship_package->setMasterFilter(""); // Clear master filter
				$scholarship_package->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($scholarship_package->getReturnUrl()); // Return to caller
			} else {
				$grant_package->LoadListRowValues($rsmaster);
				$grant_package->RowType = EW_ROWTYPE_MASTER; // Master row
				$grant_package->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Load master record
		if ($scholarship_package->getMasterFilter() <> "" && $scholarship_package->getCurrentMasterTable() == "sponsored_student") {
			global $sponsored_student;
			$rsmaster = $sponsored_student->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$scholarship_package->setMasterFilter(""); // Clear master filter
				$scholarship_package->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($scholarship_package->getReturnUrl()); // Return to caller
			} else {
				$sponsored_student->LoadListRowValues($rsmaster);
				$sponsored_student->RowType = EW_ROWTYPE_MASTER; // Master row
				$sponsored_student->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Load master record
		if ($scholarship_package->getMasterFilter() <> "" && $scholarship_package->getCurrentMasterTable() == "sponsored_student_detail") {
			global $sponsored_student_detail;
			$rsmaster = $sponsored_student_detail->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$scholarship_package->setMasterFilter(""); // Clear master filter
				$scholarship_package->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($scholarship_package->getReturnUrl()); // Return to caller
			} else {
				$sponsored_student_detail->LoadListRowValues($rsmaster);
				$sponsored_student_detail->RowType = EW_ROWTYPE_MASTER; // Master row
				$sponsored_student_detail->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$scholarship_package->setSessionWhere($sFilter);
		$scholarship_package->CurrentFilter = "";

		// Export data only
		if (in_array($scholarship_package->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($scholarship_package->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $scholarship_package;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$scholarship_package->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$scholarship_package->CurrentOrderType = @$_GET["ordertype"];
			$scholarship_package->UpdateSort($scholarship_package->scholarship_package_id); // scholarship_package_id
			$scholarship_package->UpdateSort($scholarship_package->start_date); // start_date
			$scholarship_package->UpdateSort($scholarship_package->end_date); // end_date
			$scholarship_package->UpdateSort($scholarship_package->status); // status
			$scholarship_package->UpdateSort($scholarship_package->annual_amount); // annual_amount
			$scholarship_package->UpdateSort($scholarship_package->grant_package_grant_package_id); // grant_package_grant_package_id
			$scholarship_package->UpdateSort($scholarship_package->sponsored_student_sponsored_student_id); // sponsored_student_sponsored_student_id
			$scholarship_package->UpdateSort($scholarship_package->scholarship_type); // scholarship_type
			$scholarship_package->UpdateSort($scholarship_package->scholarship_type_scholarship_type); // scholarship_type_scholarship_type
			$scholarship_package->UpdateSort($scholarship_package->group_id); // group_id
			$scholarship_package->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $scholarship_package;
		$sOrderBy = $scholarship_package->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($scholarship_package->SqlOrderBy() <> "") {
				$sOrderBy = $scholarship_package->SqlOrderBy();
				$scholarship_package->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $scholarship_package;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$scholarship_package->getCurrentMasterTable = ""; // Clear master table
				$scholarship_package->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$scholarship_package->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$scholarship_package->grant_package_grant_package_id->setSessionValue("");
				$scholarship_package->sponsored_student_sponsored_student_id->setSessionValue("");
				$scholarship_package->sponsored_student_sponsored_student_id->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$scholarship_package->setSessionOrderBy($sOrderBy);
				$scholarship_package->scholarship_package_id->setSort("");
				$scholarship_package->start_date->setSort("");
				$scholarship_package->end_date->setSort("");
				$scholarship_package->status->setSort("");
				$scholarship_package->annual_amount->setSort("");
				$scholarship_package->grant_package_grant_package_id->setSort("");
				$scholarship_package->sponsored_student_sponsored_student_id->setSort("");
				$scholarship_package->scholarship_type->setSort("");
				$scholarship_package->scholarship_type_scholarship_type->setSort("");
				$scholarship_package->group_id->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$scholarship_package->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $scholarship_package;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = FALSE;

		// "detail_scholarship_payment"
		$this->ListOptions->Add("detail_scholarship_payment");
		$item =& $this->ListOptions->Items["detail_scholarship_payment"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('scholarship_payment');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($scholarship_package->Export <> "" ||
			$scholarship_package->CurrentAction == "gridadd" ||
			$scholarship_package->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $scholarship_package;
		$this->ListOptions->LoadDefault();

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $this->ShowOptionLink() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . "<img src=\"images/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		}

		// "detail_scholarship_payment"
		$oListOpt =& $this->ListOptions->Items["detail_scholarship_payment"];
		if ($Security->AllowList('scholarship_payment') && $this->ShowOptionLink()) {
			$oListOpt->Body = "<img src=\"images/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("scholarship_payment", "TblCaption");
			$oListOpt->Body = "<a href=\"scholarship_paymentlist.php?" . EW_TABLE_SHOW_MASTER . "=scholarship_package&scholarship_package_id=" . urlencode(strval($scholarship_package->scholarship_package_id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $scholarship_package;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $scholarship_package;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$scholarship_package->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$scholarship_package->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $scholarship_package->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$scholarship_package->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$scholarship_package->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$scholarship_package->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $scholarship_package;

		// Call Recordset Selecting event
		$scholarship_package->Recordset_Selecting($scholarship_package->CurrentFilter);

		// Load List page SQL
		$sSql = $scholarship_package->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$scholarship_package->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $scholarship_package;
		$sFilter = $scholarship_package->KeyFilter();

		// Call Row Selecting event
		$scholarship_package->Row_Selecting($sFilter);

		// Load SQL based on filter
		$scholarship_package->CurrentFilter = $sFilter;
		$sSql = $scholarship_package->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$scholarship_package->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $scholarship_package;
		$scholarship_package->scholarship_package_id->setDbValue($rs->fields('scholarship_package_id'));
		$scholarship_package->start_date->setDbValue($rs->fields('start_date'));
		$scholarship_package->end_date->setDbValue($rs->fields('end_date'));
		$scholarship_package->status->setDbValue($rs->fields('status'));
		$scholarship_package->annual_amount->setDbValue($rs->fields('annual_amount'));
		$scholarship_package->grant_package_grant_package_id->setDbValue($rs->fields('grant_package_grant_package_id'));
		$scholarship_package->sponsored_student_sponsored_student_id->setDbValue($rs->fields('sponsored_student_sponsored_student_id'));
		$scholarship_package->scholarship_type->setDbValue($rs->fields('scholarship_type'));
		$scholarship_package->scholarship_type_scholarship_type->setDbValue($rs->fields('scholarship_type_scholarship_type'));
		$scholarship_package->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $scholarship_package;

		// Initialize URLs
		$this->ViewUrl = $scholarship_package->ViewUrl();
		$this->EditUrl = $scholarship_package->EditUrl();
		$this->InlineEditUrl = $scholarship_package->InlineEditUrl();
		$this->CopyUrl = $scholarship_package->CopyUrl();
		$this->InlineCopyUrl = $scholarship_package->InlineCopyUrl();
		$this->DeleteUrl = $scholarship_package->DeleteUrl();

		// Call Row_Rendering event
		$scholarship_package->Row_Rendering();

		// Common render codes for all row types
		// scholarship_package_id

		$scholarship_package->scholarship_package_id->CellCssStyle = ""; $scholarship_package->scholarship_package_id->CellCssClass = "";
		$scholarship_package->scholarship_package_id->CellAttrs = array(); $scholarship_package->scholarship_package_id->ViewAttrs = array(); $scholarship_package->scholarship_package_id->EditAttrs = array();

		// start_date
		$scholarship_package->start_date->CellCssStyle = ""; $scholarship_package->start_date->CellCssClass = "";
		$scholarship_package->start_date->CellAttrs = array(); $scholarship_package->start_date->ViewAttrs = array(); $scholarship_package->start_date->EditAttrs = array();

		// end_date
		$scholarship_package->end_date->CellCssStyle = ""; $scholarship_package->end_date->CellCssClass = "";
		$scholarship_package->end_date->CellAttrs = array(); $scholarship_package->end_date->ViewAttrs = array(); $scholarship_package->end_date->EditAttrs = array();

		// status
		$scholarship_package->status->CellCssStyle = ""; $scholarship_package->status->CellCssClass = "";
		$scholarship_package->status->CellAttrs = array(); $scholarship_package->status->ViewAttrs = array(); $scholarship_package->status->EditAttrs = array();

		// annual_amount
		$scholarship_package->annual_amount->CellCssStyle = ""; $scholarship_package->annual_amount->CellCssClass = "";
		$scholarship_package->annual_amount->CellAttrs = array(); $scholarship_package->annual_amount->ViewAttrs = array(); $scholarship_package->annual_amount->EditAttrs = array();

		// grant_package_grant_package_id
		$scholarship_package->grant_package_grant_package_id->CellCssStyle = ""; $scholarship_package->grant_package_grant_package_id->CellCssClass = "";
		$scholarship_package->grant_package_grant_package_id->CellAttrs = array(); $scholarship_package->grant_package_grant_package_id->ViewAttrs = array(); $scholarship_package->grant_package_grant_package_id->EditAttrs = array();

		// sponsored_student_sponsored_student_id
		$scholarship_package->sponsored_student_sponsored_student_id->CellCssStyle = ""; $scholarship_package->sponsored_student_sponsored_student_id->CellCssClass = "";
		$scholarship_package->sponsored_student_sponsored_student_id->CellAttrs = array(); $scholarship_package->sponsored_student_sponsored_student_id->ViewAttrs = array(); $scholarship_package->sponsored_student_sponsored_student_id->EditAttrs = array();

		// scholarship_type
		$scholarship_package->scholarship_type->CellCssStyle = ""; $scholarship_package->scholarship_type->CellCssClass = "";
		$scholarship_package->scholarship_type->CellAttrs = array(); $scholarship_package->scholarship_type->ViewAttrs = array(); $scholarship_package->scholarship_type->EditAttrs = array();

		// scholarship_type_scholarship_type
		$scholarship_package->scholarship_type_scholarship_type->CellCssStyle = ""; $scholarship_package->scholarship_type_scholarship_type->CellCssClass = "";
		$scholarship_package->scholarship_type_scholarship_type->CellAttrs = array(); $scholarship_package->scholarship_type_scholarship_type->ViewAttrs = array(); $scholarship_package->scholarship_type_scholarship_type->EditAttrs = array();

		// group_id
		$scholarship_package->group_id->CellCssStyle = ""; $scholarship_package->group_id->CellCssClass = "";
		$scholarship_package->group_id->CellAttrs = array(); $scholarship_package->group_id->ViewAttrs = array(); $scholarship_package->group_id->EditAttrs = array();
		if ($scholarship_package->RowType == EW_ROWTYPE_VIEW) { // View row

			// scholarship_package_id
			$scholarship_package->scholarship_package_id->ViewValue = $scholarship_package->scholarship_package_id->CurrentValue;
			$scholarship_package->scholarship_package_id->CssStyle = "";
			$scholarship_package->scholarship_package_id->CssClass = "";
			$scholarship_package->scholarship_package_id->ViewCustomAttributes = "";

			// start_date
			$scholarship_package->start_date->ViewValue = $scholarship_package->start_date->CurrentValue;
			$scholarship_package->start_date->ViewValue = ew_FormatDateTime($scholarship_package->start_date->ViewValue, 7);
			$scholarship_package->start_date->CssStyle = "";
			$scholarship_package->start_date->CssClass = "";
			$scholarship_package->start_date->ViewCustomAttributes = "";

			// end_date
			$scholarship_package->end_date->ViewValue = $scholarship_package->end_date->CurrentValue;
			$scholarship_package->end_date->ViewValue = ew_FormatDateTime($scholarship_package->end_date->ViewValue, 7);
			$scholarship_package->end_date->CssStyle = "";
			$scholarship_package->end_date->CssClass = "";
			$scholarship_package->end_date->ViewCustomAttributes = "";

			// status
			if (strval($scholarship_package->status->CurrentValue) <> "") {
				switch ($scholarship_package->status->CurrentValue) {
					case "active":
						$scholarship_package->status->ViewValue = "Active";
						break;
					case "suspended":
						$scholarship_package->status->ViewValue = "Suspended";
						break;
					default:
						$scholarship_package->status->ViewValue = $scholarship_package->status->CurrentValue;
				}
			} else {
				$scholarship_package->status->ViewValue = NULL;
			}
			$scholarship_package->status->CssStyle = "";
			$scholarship_package->status->CssClass = "";
			$scholarship_package->status->ViewCustomAttributes = "";

			// annual_amount
			$scholarship_package->annual_amount->ViewValue = $scholarship_package->annual_amount->CurrentValue;
			$scholarship_package->annual_amount->CssStyle = "";
			$scholarship_package->annual_amount->CssClass = "";
			$scholarship_package->annual_amount->ViewCustomAttributes = "";

			// grant_package_grant_package_id
			$scholarship_package->grant_package_grant_package_id->ViewValue = $scholarship_package->grant_package_grant_package_id->CurrentValue;
			$scholarship_package->grant_package_grant_package_id->CssStyle = "";
			$scholarship_package->grant_package_grant_package_id->CssClass = "";
			$scholarship_package->grant_package_grant_package_id->ViewCustomAttributes = "";

			// sponsored_student_sponsored_student_id
			$scholarship_package->sponsored_student_sponsored_student_id->ViewValue = $scholarship_package->sponsored_student_sponsored_student_id->CurrentValue;
			$scholarship_package->sponsored_student_sponsored_student_id->CssStyle = "";
			$scholarship_package->sponsored_student_sponsored_student_id->CssClass = "";
			$scholarship_package->sponsored_student_sponsored_student_id->ViewCustomAttributes = "";

			// scholarship_type
			$scholarship_package->scholarship_type->ViewValue = $scholarship_package->scholarship_type->CurrentValue;
			$scholarship_package->scholarship_type->CssStyle = "";
			$scholarship_package->scholarship_type->CssClass = "";
			$scholarship_package->scholarship_type->ViewCustomAttributes = "";

			// scholarship_type_scholarship_type
			$scholarship_package->scholarship_type_scholarship_type->ViewValue = $scholarship_package->scholarship_type_scholarship_type->CurrentValue;
			$scholarship_package->scholarship_type_scholarship_type->CssStyle = "";
			$scholarship_package->scholarship_type_scholarship_type->CssClass = "";
			$scholarship_package->scholarship_type_scholarship_type->ViewCustomAttributes = "";

			// group_id
			$scholarship_package->group_id->ViewValue = $scholarship_package->group_id->CurrentValue;
			$scholarship_package->group_id->CssStyle = "";
			$scholarship_package->group_id->CssClass = "";
			$scholarship_package->group_id->ViewCustomAttributes = "";

			// scholarship_package_id
			$scholarship_package->scholarship_package_id->HrefValue = "";
			$scholarship_package->scholarship_package_id->TooltipValue = "";

			// start_date
			$scholarship_package->start_date->HrefValue = "";
			$scholarship_package->start_date->TooltipValue = "";

			// end_date
			$scholarship_package->end_date->HrefValue = "";
			$scholarship_package->end_date->TooltipValue = "";

			// status
			$scholarship_package->status->HrefValue = "";
			$scholarship_package->status->TooltipValue = "";

			// annual_amount
			$scholarship_package->annual_amount->HrefValue = "";
			$scholarship_package->annual_amount->TooltipValue = "";

			// grant_package_grant_package_id
			$scholarship_package->grant_package_grant_package_id->HrefValue = "";
			$scholarship_package->grant_package_grant_package_id->TooltipValue = "";

			// sponsored_student_sponsored_student_id
			$scholarship_package->sponsored_student_sponsored_student_id->HrefValue = "";
			$scholarship_package->sponsored_student_sponsored_student_id->TooltipValue = "";

			// scholarship_type
			$scholarship_package->scholarship_type->HrefValue = "";
			$scholarship_package->scholarship_type->TooltipValue = "";

			// scholarship_type_scholarship_type
			$scholarship_package->scholarship_type_scholarship_type->HrefValue = "";
			$scholarship_package->scholarship_type_scholarship_type->TooltipValue = "";

			// group_id
			$scholarship_package->group_id->HrefValue = "";
			$scholarship_package->group_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($scholarship_package->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$scholarship_package->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $scholarship_package;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $scholarship_package->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($scholarship_package->ExportAll) {
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
		if ($scholarship_package->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($scholarship_package, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($scholarship_package->scholarship_package_id);
				$ExportDoc->ExportCaption($scholarship_package->start_date);
				$ExportDoc->ExportCaption($scholarship_package->end_date);
				$ExportDoc->ExportCaption($scholarship_package->status);
				$ExportDoc->ExportCaption($scholarship_package->annual_amount);
				$ExportDoc->ExportCaption($scholarship_package->grant_package_grant_package_id);
				$ExportDoc->ExportCaption($scholarship_package->sponsored_student_sponsored_student_id);
				$ExportDoc->ExportCaption($scholarship_package->scholarship_type);
				$ExportDoc->ExportCaption($scholarship_package->scholarship_type_scholarship_type);
				$ExportDoc->ExportCaption($scholarship_package->group_id);
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
				$scholarship_package->CssClass = "";
				$scholarship_package->CssStyle = "";
				$scholarship_package->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($scholarship_package->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('scholarship_package_id', $scholarship_package->scholarship_package_id->ExportValue($scholarship_package->Export, $scholarship_package->ExportOriginalValue));
					$XmlDoc->AddField('start_date', $scholarship_package->start_date->ExportValue($scholarship_package->Export, $scholarship_package->ExportOriginalValue));
					$XmlDoc->AddField('end_date', $scholarship_package->end_date->ExportValue($scholarship_package->Export, $scholarship_package->ExportOriginalValue));
					$XmlDoc->AddField('status', $scholarship_package->status->ExportValue($scholarship_package->Export, $scholarship_package->ExportOriginalValue));
					$XmlDoc->AddField('annual_amount', $scholarship_package->annual_amount->ExportValue($scholarship_package->Export, $scholarship_package->ExportOriginalValue));
					$XmlDoc->AddField('grant_package_grant_package_id', $scholarship_package->grant_package_grant_package_id->ExportValue($scholarship_package->Export, $scholarship_package->ExportOriginalValue));
					$XmlDoc->AddField('sponsored_student_sponsored_student_id', $scholarship_package->sponsored_student_sponsored_student_id->ExportValue($scholarship_package->Export, $scholarship_package->ExportOriginalValue));
					$XmlDoc->AddField('scholarship_type', $scholarship_package->scholarship_type->ExportValue($scholarship_package->Export, $scholarship_package->ExportOriginalValue));
					$XmlDoc->AddField('scholarship_type_scholarship_type', $scholarship_package->scholarship_type_scholarship_type->ExportValue($scholarship_package->Export, $scholarship_package->ExportOriginalValue));
					$XmlDoc->AddField('group_id', $scholarship_package->group_id->ExportValue($scholarship_package->Export, $scholarship_package->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($scholarship_package->scholarship_package_id);
					$ExportDoc->ExportField($scholarship_package->start_date);
					$ExportDoc->ExportField($scholarship_package->end_date);
					$ExportDoc->ExportField($scholarship_package->status);
					$ExportDoc->ExportField($scholarship_package->annual_amount);
					$ExportDoc->ExportField($scholarship_package->grant_package_grant_package_id);
					$ExportDoc->ExportField($scholarship_package->sponsored_student_sponsored_student_id);
					$ExportDoc->ExportField($scholarship_package->scholarship_type);
					$ExportDoc->ExportField($scholarship_package->scholarship_type_scholarship_type);
					$ExportDoc->ExportField($scholarship_package->group_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($scholarship_package->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($scholarship_package->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($scholarship_package->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($scholarship_package->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($scholarship_package->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $scholarship_package;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($scholarship_package->group_id->CurrentValue);
			}
		}
		return TRUE;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $scholarship_package;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "grant_package") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $scholarship_package->SqlMasterFilter_grant_package();
				$this->sDbDetailFilter = $scholarship_package->SqlDetailFilter_grant_package();
				if (@$_GET["grant_package_id"] <> "") {
					$GLOBALS["grant_package"]->grant_package_id->setQueryStringValue($_GET["grant_package_id"]);
					$scholarship_package->grant_package_grant_package_id->setQueryStringValue($GLOBALS["grant_package"]->grant_package_id->QueryStringValue);
					$scholarship_package->grant_package_grant_package_id->setSessionValue($scholarship_package->grant_package_grant_package_id->QueryStringValue);
					if (!is_numeric($GLOBALS["grant_package"]->grant_package_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@grant_package_id@", ew_AdjustSql($GLOBALS["grant_package"]->grant_package_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@grant_package_grant_package_id@", ew_AdjustSql($GLOBALS["grant_package"]->grant_package_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
			if ($sMasterTblVar == "sponsored_student") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $scholarship_package->SqlMasterFilter_sponsored_student();
				$this->sDbDetailFilter = $scholarship_package->SqlDetailFilter_sponsored_student();
				if (@$_GET["sponsored_student_id"] <> "") {
					$GLOBALS["sponsored_student"]->sponsored_student_id->setQueryStringValue($_GET["sponsored_student_id"]);
					$scholarship_package->sponsored_student_sponsored_student_id->setQueryStringValue($GLOBALS["sponsored_student"]->sponsored_student_id->QueryStringValue);
					$scholarship_package->sponsored_student_sponsored_student_id->setSessionValue($scholarship_package->sponsored_student_sponsored_student_id->QueryStringValue);
					if (!is_numeric($GLOBALS["sponsored_student"]->sponsored_student_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@sponsored_student_id@", ew_AdjustSql($GLOBALS["sponsored_student"]->sponsored_student_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@sponsored_student_sponsored_student_id@", ew_AdjustSql($GLOBALS["sponsored_student"]->sponsored_student_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
			if ($sMasterTblVar == "sponsored_student_detail") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $scholarship_package->SqlMasterFilter_sponsored_student_detail();
				$this->sDbDetailFilter = $scholarship_package->SqlDetailFilter_sponsored_student_detail();
				if (@$_GET["sponsored_student_id"] <> "") {
					$GLOBALS["sponsored_student_detail"]->sponsored_student_id->setQueryStringValue($_GET["sponsored_student_id"]);
					$scholarship_package->sponsored_student_sponsored_student_id->setQueryStringValue($GLOBALS["sponsored_student_detail"]->sponsored_student_id->QueryStringValue);
					$scholarship_package->sponsored_student_sponsored_student_id->setSessionValue($scholarship_package->sponsored_student_sponsored_student_id->QueryStringValue);
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
			$scholarship_package->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$scholarship_package->setStartRecordNumber($this->lStartRec);
			$scholarship_package->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$scholarship_package->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "grant_package") {
				if ($scholarship_package->grant_package_grant_package_id->QueryStringValue == "") $scholarship_package->grant_package_grant_package_id->setSessionValue("");
			}
			if ($sMasterTblVar <> "sponsored_student") {
				if ($scholarship_package->sponsored_student_sponsored_student_id->QueryStringValue == "") $scholarship_package->sponsored_student_sponsored_student_id->setSessionValue("");
			}
			if ($sMasterTblVar <> "sponsored_student_detail") {
				if ($scholarship_package->sponsored_student_sponsored_student_id->QueryStringValue == "") $scholarship_package->sponsored_student_sponsored_student_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $scholarship_package->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $scholarship_package->getDetailFilter(); // Restore detail filter
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'scholarship_package';
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
