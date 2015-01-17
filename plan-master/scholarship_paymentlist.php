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
$scholarship_payment_list = new cscholarship_payment_list();
$Page =& $scholarship_payment_list;

// Page init
$scholarship_payment_list->Page_Init();

// Page main
$scholarship_payment_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($scholarship_payment->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var scholarship_payment_list = new ew_Page("scholarship_payment_list");

// page properties
scholarship_payment_list.PageID = "list"; // page ID
scholarship_payment_list.FormID = "fscholarship_paymentlist"; // form ID
var EW_PAGE_ID = scholarship_payment_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
scholarship_payment_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
scholarship_payment_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
scholarship_payment_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($scholarship_payment->Export == "") { ?>
<?php
$gsMasterReturnUrl = "scholarship_packagelist.php";
if ($scholarship_payment_list->sDbMasterFilter <> "" && $scholarship_payment->getCurrentMasterTable() == "scholarship_package") {
	if ($scholarship_payment_list->bMasterRecordExists) {
		if ($scholarship_payment->getCurrentMasterTable() == $scholarship_payment->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "scholarship_packagemaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$scholarship_payment_list->lTotalRecs = $scholarship_payment->SelectRecordCount();
	} else {
		if ($rs = $scholarship_payment_list->LoadRecordset())
			$scholarship_payment_list->lTotalRecs = $rs->RecordCount();
	}
	$scholarship_payment_list->lStartRec = 1;
	if ($scholarship_payment_list->lDisplayRecs <= 0 || ($scholarship_payment->Export <> "" && $scholarship_payment->ExportAll)) // Display all records
		$scholarship_payment_list->lDisplayRecs = $scholarship_payment_list->lTotalRecs;
	if (!($scholarship_payment->Export <> "" && $scholarship_payment->ExportAll))
		$scholarship_payment_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $scholarship_payment_list->LoadRecordset($scholarship_payment_list->lStartRec-1, $scholarship_payment_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $scholarship_payment->TableCaption() ?>
<?php if ($scholarship_payment->Export == "" && $scholarship_payment->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $scholarship_payment_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $scholarship_payment_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $scholarship_payment_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($scholarship_payment->Export == "" && $scholarship_payment->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(scholarship_payment_list);" style="text-decoration: none;"><img id="scholarship_payment_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="scholarship_payment_list_SearchPanel">
<form name="fscholarship_paymentlistsrch" id="fscholarship_paymentlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="scholarship_payment">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $scholarship_payment_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="scholarship_paymentsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
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
$scholarship_payment_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fscholarship_paymentlist" id="fscholarship_paymentlist" class="ewForm" action="" method="post">
<div id="gmp_scholarship_payment" class="ewGridMiddlePanel">
<?php if ($scholarship_payment_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $scholarship_payment->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$scholarship_payment_list->RenderListOptions();

// Render list options (header, left)
$scholarship_payment_list->ListOptions->Render("header", "left");
?>
<?php if ($scholarship_payment->status->Visible) { // status ?>
	<?php if ($scholarship_payment->SortUrl($scholarship_payment->status) == "") { ?>
		<td><?php echo $scholarship_payment->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_payment->SortUrl($scholarship_payment->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_payment->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_payment->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_payment->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_payment->year->Visible) { // year ?>
	<?php if ($scholarship_payment->SortUrl($scholarship_payment->year) == "") { ?>
		<td><?php echo $scholarship_payment->year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_payment->SortUrl($scholarship_payment->year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_payment->year->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_payment->year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_payment->year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_payment->scholarship_package_scholarship_package_id->Visible) { // scholarship_package_scholarship_package_id ?>
	<?php if ($scholarship_payment->SortUrl($scholarship_payment->scholarship_package_scholarship_package_id) == "") { ?>
		<td><?php echo $scholarship_payment->scholarship_package_scholarship_package_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_payment->SortUrl($scholarship_payment->scholarship_package_scholarship_package_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_payment->scholarship_package_scholarship_package_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_payment->scholarship_package_scholarship_package_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_payment->scholarship_package_scholarship_package_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_payment->programarea_residentarea_id->Visible) { // programarea_residentarea_id ?>
	<?php if ($scholarship_payment->SortUrl($scholarship_payment->programarea_residentarea_id) == "") { ?>
		<td><?php echo $scholarship_payment->programarea_residentarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_payment->SortUrl($scholarship_payment->programarea_residentarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_payment->programarea_residentarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_payment->programarea_residentarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_payment->programarea_residentarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_payment->programarea_payingarea_id->Visible) { // programarea_payingarea_id ?>
	<?php if ($scholarship_payment->SortUrl($scholarship_payment->programarea_payingarea_id) == "") { ?>
		<td><?php echo $scholarship_payment->programarea_payingarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_payment->SortUrl($scholarship_payment->programarea_payingarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_payment->programarea_payingarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_payment->programarea_payingarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_payment->programarea_payingarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_payment->refund_amount->Visible) { // refund_amount ?>
	<?php if ($scholarship_payment->SortUrl($scholarship_payment->refund_amount) == "") { ?>
		<td><?php echo $scholarship_payment->refund_amount->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_payment->SortUrl($scholarship_payment->refund_amount) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_payment->refund_amount->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_payment->refund_amount->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_payment->refund_amount->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_payment->payment_request_payment_request_id->Visible) { // payment_request_payment_request_id ?>
	<?php if ($scholarship_payment->SortUrl($scholarship_payment->payment_request_payment_request_id) == "") { ?>
		<td><?php echo $scholarship_payment->payment_request_payment_request_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_payment->SortUrl($scholarship_payment->payment_request_payment_request_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_payment->payment_request_payment_request_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_payment->payment_request_payment_request_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_payment->payment_request_payment_request_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_payment->bankname->Visible) { // bankname ?>
	<?php if ($scholarship_payment->SortUrl($scholarship_payment->bankname) == "") { ?>
		<td><?php echo $scholarship_payment->bankname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_payment->SortUrl($scholarship_payment->bankname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_payment->bankname->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_payment->bankname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_payment->bankname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_payment->account_no->Visible) { // account_no ?>
	<?php if ($scholarship_payment->SortUrl($scholarship_payment->account_no) == "") { ?>
		<td><?php echo $scholarship_payment->account_no->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_payment->SortUrl($scholarship_payment->account_no) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_payment->account_no->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_payment->account_no->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_payment->account_no->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_payment->schools_school_id->Visible) { // schools_school_id ?>
	<?php if ($scholarship_payment->SortUrl($scholarship_payment->schools_school_id) == "") { ?>
		<td><?php echo $scholarship_payment->schools_school_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_payment->SortUrl($scholarship_payment->schools_school_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_payment->schools_school_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_payment->schools_school_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_payment->schools_school_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_payment->group_id->Visible) { // group_id ?>
	<?php if ($scholarship_payment->SortUrl($scholarship_payment->group_id) == "") { ?>
		<td><?php echo $scholarship_payment->group_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_payment->SortUrl($scholarship_payment->group_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_payment->group_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_payment->group_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_payment->group_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$scholarship_payment_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($scholarship_payment->ExportAll && $scholarship_payment->Export <> "") {
	$scholarship_payment_list->lStopRec = $scholarship_payment_list->lTotalRecs;
} else {
	$scholarship_payment_list->lStopRec = $scholarship_payment_list->lStartRec + $scholarship_payment_list->lDisplayRecs - 1; // Set the last record to display
}
$scholarship_payment_list->lRecCount = $scholarship_payment_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $scholarship_payment_list->lStartRec > 1)
		$rs->Move($scholarship_payment_list->lStartRec - 1);
}

// Initialize aggregate
$scholarship_payment->RowType = EW_ROWTYPE_AGGREGATEINIT;
$scholarship_payment_list->RenderRow();
$scholarship_payment_list->lRowCnt = 0;
while (($scholarship_payment->CurrentAction == "gridadd" || !$rs->EOF) &&
	$scholarship_payment_list->lRecCount < $scholarship_payment_list->lStopRec) {
	$scholarship_payment_list->lRecCount++;
	if (intval($scholarship_payment_list->lRecCount) >= intval($scholarship_payment_list->lStartRec)) {
		$scholarship_payment_list->lRowCnt++;

	// Init row class and style
	$scholarship_payment->CssClass = "";
	$scholarship_payment->CssStyle = "";
	$scholarship_payment->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($scholarship_payment->CurrentAction == "gridadd") {
		$scholarship_payment_list->LoadDefaultValues(); // Load default values
	} else {
		$scholarship_payment_list->LoadRowValues($rs); // Load row values
	}
	$scholarship_payment->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$scholarship_payment_list->RenderRow();

	// Render list options
	$scholarship_payment_list->RenderListOptions();
?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
<?php

// Render list options (body, left)
$scholarship_payment_list->ListOptions->Render("body", "left");
?>
	<?php if ($scholarship_payment->status->Visible) { // status ?>
		<td<?php echo $scholarship_payment->status->CellAttributes() ?>>
<div<?php echo $scholarship_payment->status->ViewAttributes() ?>><?php echo $scholarship_payment->status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_payment->year->Visible) { // year ?>
		<td<?php echo $scholarship_payment->year->CellAttributes() ?>>
<div<?php echo $scholarship_payment->year->ViewAttributes() ?>><?php echo $scholarship_payment->year->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_payment->scholarship_package_scholarship_package_id->Visible) { // scholarship_package_scholarship_package_id ?>
		<td<?php echo $scholarship_payment->scholarship_package_scholarship_package_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->scholarship_package_scholarship_package_id->ViewAttributes() ?>><?php echo $scholarship_payment->scholarship_package_scholarship_package_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_payment->programarea_residentarea_id->Visible) { // programarea_residentarea_id ?>
		<td<?php echo $scholarship_payment->programarea_residentarea_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->programarea_residentarea_id->ViewAttributes() ?>><?php echo $scholarship_payment->programarea_residentarea_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_payment->programarea_payingarea_id->Visible) { // programarea_payingarea_id ?>
		<td<?php echo $scholarship_payment->programarea_payingarea_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->programarea_payingarea_id->ViewAttributes() ?>><?php echo $scholarship_payment->programarea_payingarea_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_payment->refund_amount->Visible) { // refund_amount ?>
		<td<?php echo $scholarship_payment->refund_amount->CellAttributes() ?>>
<div<?php echo $scholarship_payment->refund_amount->ViewAttributes() ?>><?php echo $scholarship_payment->refund_amount->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_payment->payment_request_payment_request_id->Visible) { // payment_request_payment_request_id ?>
		<td<?php echo $scholarship_payment->payment_request_payment_request_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->payment_request_payment_request_id->ViewAttributes() ?>><?php echo $scholarship_payment->payment_request_payment_request_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_payment->bankname->Visible) { // bankname ?>
		<td<?php echo $scholarship_payment->bankname->CellAttributes() ?>>
<div<?php echo $scholarship_payment->bankname->ViewAttributes() ?>><?php echo $scholarship_payment->bankname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_payment->account_no->Visible) { // account_no ?>
		<td<?php echo $scholarship_payment->account_no->CellAttributes() ?>>
<div<?php echo $scholarship_payment->account_no->ViewAttributes() ?>><?php echo $scholarship_payment->account_no->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_payment->schools_school_id->Visible) { // schools_school_id ?>
		<td<?php echo $scholarship_payment->schools_school_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->schools_school_id->ViewAttributes() ?>><?php echo $scholarship_payment->schools_school_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_payment->group_id->Visible) { // group_id ?>
		<td<?php echo $scholarship_payment->group_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->group_id->ViewAttributes() ?>><?php echo $scholarship_payment->group_id->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$scholarship_payment_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($scholarship_payment->CurrentAction <> "gridadd")
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
<?php if ($scholarship_payment->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($scholarship_payment->CurrentAction <> "gridadd" && $scholarship_payment->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($scholarship_payment_list->Pager)) $scholarship_payment_list->Pager = new cPrevNextPager($scholarship_payment_list->lStartRec, $scholarship_payment_list->lDisplayRecs, $scholarship_payment_list->lTotalRecs) ?>
<?php if ($scholarship_payment_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($scholarship_payment_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $scholarship_payment_list->PageUrl() ?>start=<?php echo $scholarship_payment_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($scholarship_payment_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $scholarship_payment_list->PageUrl() ?>start=<?php echo $scholarship_payment_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $scholarship_payment_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($scholarship_payment_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $scholarship_payment_list->PageUrl() ?>start=<?php echo $scholarship_payment_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($scholarship_payment_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $scholarship_payment_list->PageUrl() ?>start=<?php echo $scholarship_payment_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $scholarship_payment_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $scholarship_payment_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $scholarship_payment_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $scholarship_payment_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($scholarship_payment_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($scholarship_payment_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $scholarship_payment_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($scholarship_payment->Export == "" && $scholarship_payment->CurrentAction == "") { ?>
<?php } ?>
<?php if ($scholarship_payment->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$scholarship_payment_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cscholarship_payment_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'scholarship_payment';

	// Page object name
	var $PageObjName = 'scholarship_payment_list';

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
	function cscholarship_payment_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (scholarship_payment)
		$GLOBALS["scholarship_payment"] = new cscholarship_payment();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["scholarship_payment"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "scholarship_paymentdelete.php";
		$this->MultiUpdateUrl = "scholarship_paymentupdate.php";

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
			define("EW_TABLE_NAME", 'scholarship_payment', TRUE);

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
			$scholarship_payment->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$scholarship_payment->Export = $_POST["exporttype"];
		} else {
			$scholarship_payment->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $scholarship_payment->Export; // Get export parameter, used in header
		$gsExportFile = $scholarship_payment->TableVar; // Get export file, used in header
		if ($scholarship_payment->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($scholarship_payment->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $scholarship_payment;

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
			$scholarship_payment->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($scholarship_payment->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $scholarship_payment->getRecordsPerPage(); // Restore from Session
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
		$scholarship_payment->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$scholarship_payment->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$scholarship_payment->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $scholarship_payment->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $scholarship_payment->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $scholarship_payment->getDetailFilter(); // Restore detail filter

		// Add master User ID filter
		if ($Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			if ($scholarship_payment->getCurrentMasterTable() == "scholarship_package")
				$this->sDbMasterFilter = $scholarship_payment->AddMasterUserIDFilter($this->sDbMasterFilter, "scholarship_package"); // Add master User ID filter
		}
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($scholarship_payment->getMasterFilter() <> "" && $scholarship_payment->getCurrentMasterTable() == "scholarship_package") {
			global $scholarship_package;
			$rsmaster = $scholarship_package->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$scholarship_payment->setMasterFilter(""); // Clear master filter
				$scholarship_payment->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($scholarship_payment->getReturnUrl()); // Return to caller
			} else {
				$scholarship_package->LoadListRowValues($rsmaster);
				$scholarship_package->RowType = EW_ROWTYPE_MASTER; // Master row
				$scholarship_package->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$scholarship_payment->setSessionWhere($sFilter);
		$scholarship_payment->CurrentFilter = "";

		// Export data only
		if (in_array($scholarship_payment->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($scholarship_payment->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $scholarship_payment;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $scholarship_payment->scholarship_payment_id, FALSE); // scholarship_payment_id
		$this->BuildSearchSql($sWhere, $scholarship_payment->date, FALSE); // date
		$this->BuildSearchSql($sWhere, $scholarship_payment->status, FALSE); // status
		$this->BuildSearchSql($sWhere, $scholarship_payment->amount, FALSE); // amount
		$this->BuildSearchSql($sWhere, $scholarship_payment->memo, FALSE); // memo
		$this->BuildSearchSql($sWhere, $scholarship_payment->year, FALSE); // year
		$this->BuildSearchSql($sWhere, $scholarship_payment->scholarship_package_scholarship_package_id, FALSE); // scholarship_package_scholarship_package_id
		$this->BuildSearchSql($sWhere, $scholarship_payment->programarea_residentarea_id, FALSE); // programarea_residentarea_id
		$this->BuildSearchSql($sWhere, $scholarship_payment->programarea_payingarea_id, FALSE); // programarea_payingarea_id
		$this->BuildSearchSql($sWhere, $scholarship_payment->refund_amount, FALSE); // refund_amount
		$this->BuildSearchSql($sWhere, $scholarship_payment->payment_request_payment_request_id, FALSE); // payment_request_payment_request_id
		$this->BuildSearchSql($sWhere, $scholarship_payment->bankname, FALSE); // bankname
		$this->BuildSearchSql($sWhere, $scholarship_payment->account_no, FALSE); // account_no
		$this->BuildSearchSql($sWhere, $scholarship_payment->schools_school_id, FALSE); // schools_school_id
		$this->BuildSearchSql($sWhere, $scholarship_payment->group_id, FALSE); // group_id

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($scholarship_payment->scholarship_payment_id); // scholarship_payment_id
			$this->SetSearchParm($scholarship_payment->date); // date
			$this->SetSearchParm($scholarship_payment->status); // status
			$this->SetSearchParm($scholarship_payment->amount); // amount
			$this->SetSearchParm($scholarship_payment->memo); // memo
			$this->SetSearchParm($scholarship_payment->year); // year
			$this->SetSearchParm($scholarship_payment->scholarship_package_scholarship_package_id); // scholarship_package_scholarship_package_id
			$this->SetSearchParm($scholarship_payment->programarea_residentarea_id); // programarea_residentarea_id
			$this->SetSearchParm($scholarship_payment->programarea_payingarea_id); // programarea_payingarea_id
			$this->SetSearchParm($scholarship_payment->refund_amount); // refund_amount
			$this->SetSearchParm($scholarship_payment->payment_request_payment_request_id); // payment_request_payment_request_id
			$this->SetSearchParm($scholarship_payment->bankname); // bankname
			$this->SetSearchParm($scholarship_payment->account_no); // account_no
			$this->SetSearchParm($scholarship_payment->schools_school_id); // schools_school_id
			$this->SetSearchParm($scholarship_payment->group_id); // group_id
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
		global $scholarship_payment;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$scholarship_payment->setAdvancedSearch("x_$FldParm", $FldVal);
		$scholarship_payment->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$scholarship_payment->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$scholarship_payment->setAdvancedSearch("y_$FldParm", $FldVal2);
		$scholarship_payment->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $scholarship_payment;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $scholarship_payment->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $scholarship_payment->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $scholarship_payment->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $scholarship_payment->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $scholarship_payment->GetAdvancedSearch("w_$FldParm");
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
		global $scholarship_payment;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$scholarship_payment->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $scholarship_payment;
		$scholarship_payment->setAdvancedSearch("x_scholarship_payment_id", "");
		$scholarship_payment->setAdvancedSearch("x_date", "");
		$scholarship_payment->setAdvancedSearch("z_date", "");
		$scholarship_payment->setAdvancedSearch("v_date", "AND");
		$scholarship_payment->setAdvancedSearch("y_date", "");
		$scholarship_payment->setAdvancedSearch("w_date", "");
		$scholarship_payment->setAdvancedSearch("x_status", "");
		$scholarship_payment->setAdvancedSearch("x_amount", "");
		$scholarship_payment->setAdvancedSearch("x_memo", "");
		$scholarship_payment->setAdvancedSearch("x_year", "");
		$scholarship_payment->setAdvancedSearch("x_scholarship_package_scholarship_package_id", "");
		$scholarship_payment->setAdvancedSearch("x_programarea_residentarea_id", "");
		$scholarship_payment->setAdvancedSearch("x_programarea_payingarea_id", "");
		$scholarship_payment->setAdvancedSearch("x_refund_amount", "");
		$scholarship_payment->setAdvancedSearch("x_payment_request_payment_request_id", "");
		$scholarship_payment->setAdvancedSearch("x_bankname", "");
		$scholarship_payment->setAdvancedSearch("x_account_no", "");
		$scholarship_payment->setAdvancedSearch("x_schools_school_id", "");
		$scholarship_payment->setAdvancedSearch("x_group_id", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $scholarship_payment;
		$bRestore = TRUE;
		if (@$_GET["x_scholarship_payment_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_date"] <> "") $bRestore = FALSE;
		if (@$_GET["y_date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_status"] <> "") $bRestore = FALSE;
		if (@$_GET["x_amount"] <> "") $bRestore = FALSE;
		if (@$_GET["x_memo"] <> "") $bRestore = FALSE;
		if (@$_GET["x_year"] <> "") $bRestore = FALSE;
		if (@$_GET["x_scholarship_package_scholarship_package_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_programarea_residentarea_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_programarea_payingarea_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_refund_amount"] <> "") $bRestore = FALSE;
		if (@$_GET["x_payment_request_payment_request_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_bankname"] <> "") $bRestore = FALSE;
		if (@$_GET["x_account_no"] <> "") $bRestore = FALSE;
		if (@$_GET["x_schools_school_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_group_id"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($scholarship_payment->scholarship_payment_id);
			$this->GetSearchParm($scholarship_payment->date);
			$this->GetSearchParm($scholarship_payment->status);
			$this->GetSearchParm($scholarship_payment->amount);
			$this->GetSearchParm($scholarship_payment->memo);
			$this->GetSearchParm($scholarship_payment->year);
			$this->GetSearchParm($scholarship_payment->scholarship_package_scholarship_package_id);
			$this->GetSearchParm($scholarship_payment->programarea_residentarea_id);
			$this->GetSearchParm($scholarship_payment->programarea_payingarea_id);
			$this->GetSearchParm($scholarship_payment->refund_amount);
			$this->GetSearchParm($scholarship_payment->payment_request_payment_request_id);
			$this->GetSearchParm($scholarship_payment->bankname);
			$this->GetSearchParm($scholarship_payment->account_no);
			$this->GetSearchParm($scholarship_payment->schools_school_id);
			$this->GetSearchParm($scholarship_payment->group_id);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $scholarship_payment;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$scholarship_payment->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$scholarship_payment->CurrentOrderType = @$_GET["ordertype"];
			$scholarship_payment->UpdateSort($scholarship_payment->status); // status
			$scholarship_payment->UpdateSort($scholarship_payment->year); // year
			$scholarship_payment->UpdateSort($scholarship_payment->scholarship_package_scholarship_package_id); // scholarship_package_scholarship_package_id
			$scholarship_payment->UpdateSort($scholarship_payment->programarea_residentarea_id); // programarea_residentarea_id
			$scholarship_payment->UpdateSort($scholarship_payment->programarea_payingarea_id); // programarea_payingarea_id
			$scholarship_payment->UpdateSort($scholarship_payment->refund_amount); // refund_amount
			$scholarship_payment->UpdateSort($scholarship_payment->payment_request_payment_request_id); // payment_request_payment_request_id
			$scholarship_payment->UpdateSort($scholarship_payment->bankname); // bankname
			$scholarship_payment->UpdateSort($scholarship_payment->account_no); // account_no
			$scholarship_payment->UpdateSort($scholarship_payment->schools_school_id); // schools_school_id
			$scholarship_payment->UpdateSort($scholarship_payment->group_id); // group_id
			$scholarship_payment->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $scholarship_payment;
		$sOrderBy = $scholarship_payment->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($scholarship_payment->SqlOrderBy() <> "") {
				$sOrderBy = $scholarship_payment->SqlOrderBy();
				$scholarship_payment->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $scholarship_payment;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$scholarship_payment->getCurrentMasterTable = ""; // Clear master table
				$scholarship_payment->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$scholarship_payment->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$scholarship_payment->scholarship_package_scholarship_package_id->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$scholarship_payment->setSessionOrderBy($sOrderBy);
				$scholarship_payment->status->setSort("");
				$scholarship_payment->year->setSort("");
				$scholarship_payment->scholarship_package_scholarship_package_id->setSort("");
				$scholarship_payment->programarea_residentarea_id->setSort("");
				$scholarship_payment->programarea_payingarea_id->setSort("");
				$scholarship_payment->refund_amount->setSort("");
				$scholarship_payment->payment_request_payment_request_id->setSort("");
				$scholarship_payment->bankname->setSort("");
				$scholarship_payment->account_no->setSort("");
				$scholarship_payment->schools_school_id->setSort("");
				$scholarship_payment->group_id->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$scholarship_payment->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $scholarship_payment;

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

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($scholarship_payment->Export <> "" ||
			$scholarship_payment->CurrentAction == "gridadd" ||
			$scholarship_payment->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $scholarship_payment;
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

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $this->ShowOptionLink() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . "<img src=\"images/delete.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $scholarship_payment;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $scholarship_payment;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$scholarship_payment->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$scholarship_payment->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $scholarship_payment->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$scholarship_payment->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$scholarship_payment->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$scholarship_payment->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $scholarship_payment;

		// Load search values
		// scholarship_payment_id

		$scholarship_payment->scholarship_payment_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_scholarship_payment_id"]);
		$scholarship_payment->scholarship_payment_id->AdvancedSearch->SearchOperator = @$_GET["z_scholarship_payment_id"];

		// date
		$scholarship_payment->date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_date"]);
		$scholarship_payment->date->AdvancedSearch->SearchOperator = @$_GET["z_date"];
		$scholarship_payment->date->AdvancedSearch->SearchCondition = @$_GET["v_date"];
		$scholarship_payment->date->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_date"]);
		$scholarship_payment->date->AdvancedSearch->SearchOperator2 = @$_GET["w_date"];

		// status
		$scholarship_payment->status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_status"]);
		$scholarship_payment->status->AdvancedSearch->SearchOperator = @$_GET["z_status"];

		// amount
		$scholarship_payment->amount->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_amount"]);
		$scholarship_payment->amount->AdvancedSearch->SearchOperator = @$_GET["z_amount"];

		// memo
		$scholarship_payment->memo->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_memo"]);
		$scholarship_payment->memo->AdvancedSearch->SearchOperator = @$_GET["z_memo"];

		// year
		$scholarship_payment->year->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_year"]);
		$scholarship_payment->year->AdvancedSearch->SearchOperator = @$_GET["z_year"];

		// scholarship_package_scholarship_package_id
		$scholarship_payment->scholarship_package_scholarship_package_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_scholarship_package_scholarship_package_id"]);
		$scholarship_payment->scholarship_package_scholarship_package_id->AdvancedSearch->SearchOperator = @$_GET["z_scholarship_package_scholarship_package_id"];

		// programarea_residentarea_id
		$scholarship_payment->programarea_residentarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programarea_residentarea_id"]);
		$scholarship_payment->programarea_residentarea_id->AdvancedSearch->SearchOperator = @$_GET["z_programarea_residentarea_id"];

		// programarea_payingarea_id
		$scholarship_payment->programarea_payingarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programarea_payingarea_id"]);
		$scholarship_payment->programarea_payingarea_id->AdvancedSearch->SearchOperator = @$_GET["z_programarea_payingarea_id"];

		// refund_amount
		$scholarship_payment->refund_amount->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_refund_amount"]);
		$scholarship_payment->refund_amount->AdvancedSearch->SearchOperator = @$_GET["z_refund_amount"];

		// payment_request_payment_request_id
		$scholarship_payment->payment_request_payment_request_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_payment_request_payment_request_id"]);
		$scholarship_payment->payment_request_payment_request_id->AdvancedSearch->SearchOperator = @$_GET["z_payment_request_payment_request_id"];

		// bankname
		$scholarship_payment->bankname->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_bankname"]);
		$scholarship_payment->bankname->AdvancedSearch->SearchOperator = @$_GET["z_bankname"];

		// account_no
		$scholarship_payment->account_no->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_account_no"]);
		$scholarship_payment->account_no->AdvancedSearch->SearchOperator = @$_GET["z_account_no"];

		// schools_school_id
		$scholarship_payment->schools_school_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_schools_school_id"]);
		$scholarship_payment->schools_school_id->AdvancedSearch->SearchOperator = @$_GET["z_schools_school_id"];

		// group_id
		$scholarship_payment->group_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_group_id"]);
		$scholarship_payment->group_id->AdvancedSearch->SearchOperator = @$_GET["z_group_id"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $scholarship_payment;

		// Call Recordset Selecting event
		$scholarship_payment->Recordset_Selecting($scholarship_payment->CurrentFilter);

		// Load List page SQL
		$sSql = $scholarship_payment->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$scholarship_payment->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $scholarship_payment;
		$sFilter = $scholarship_payment->KeyFilter();

		// Call Row Selecting event
		$scholarship_payment->Row_Selecting($sFilter);

		// Load SQL based on filter
		$scholarship_payment->CurrentFilter = $sFilter;
		$sSql = $scholarship_payment->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$scholarship_payment->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $scholarship_payment;
		$scholarship_payment->scholarship_payment_id->setDbValue($rs->fields('scholarship_payment_id'));
		$scholarship_payment->date->setDbValue($rs->fields('date'));
		$scholarship_payment->status->setDbValue($rs->fields('status'));
		$scholarship_payment->amount->setDbValue($rs->fields('amount'));
		$scholarship_payment->memo->setDbValue($rs->fields('memo'));
		$scholarship_payment->year->setDbValue($rs->fields('year'));
		$scholarship_payment->scholarship_package_scholarship_package_id->setDbValue($rs->fields('scholarship_package_scholarship_package_id'));
		$scholarship_payment->programarea_residentarea_id->setDbValue($rs->fields('programarea_residentarea_id'));
		$scholarship_payment->programarea_payingarea_id->setDbValue($rs->fields('programarea_payingarea_id'));
		$scholarship_payment->refund_amount->setDbValue($rs->fields('refund_amount'));
		$scholarship_payment->payment_request_payment_request_id->setDbValue($rs->fields('payment_request_payment_request_id'));
		$scholarship_payment->bankname->setDbValue($rs->fields('bankname'));
		$scholarship_payment->account_no->setDbValue($rs->fields('account_no'));
		$scholarship_payment->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$scholarship_payment->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $scholarship_payment;

		// Initialize URLs
		$this->ViewUrl = $scholarship_payment->ViewUrl();
		$this->EditUrl = $scholarship_payment->EditUrl();
		$this->InlineEditUrl = $scholarship_payment->InlineEditUrl();
		$this->CopyUrl = $scholarship_payment->CopyUrl();
		$this->InlineCopyUrl = $scholarship_payment->InlineCopyUrl();
		$this->DeleteUrl = $scholarship_payment->DeleteUrl();

		// Call Row_Rendering event
		$scholarship_payment->Row_Rendering();

		// Common render codes for all row types
		// status

		$scholarship_payment->status->CellCssStyle = ""; $scholarship_payment->status->CellCssClass = "";
		$scholarship_payment->status->CellAttrs = array(); $scholarship_payment->status->ViewAttrs = array(); $scholarship_payment->status->EditAttrs = array();

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

			// status
			$scholarship_payment->status->HrefValue = "";
			$scholarship_payment->status->TooltipValue = "";

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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $scholarship_payment;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $scholarship_payment->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($scholarship_payment->ExportAll) {
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
		if ($scholarship_payment->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($scholarship_payment, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($scholarship_payment->scholarship_payment_id);
				$ExportDoc->ExportCaption($scholarship_payment->date);
				$ExportDoc->ExportCaption($scholarship_payment->status);
				$ExportDoc->ExportCaption($scholarship_payment->amount);
				$ExportDoc->ExportCaption($scholarship_payment->year);
				$ExportDoc->ExportCaption($scholarship_payment->scholarship_package_scholarship_package_id);
				$ExportDoc->ExportCaption($scholarship_payment->programarea_residentarea_id);
				$ExportDoc->ExportCaption($scholarship_payment->programarea_payingarea_id);
				$ExportDoc->ExportCaption($scholarship_payment->refund_amount);
				$ExportDoc->ExportCaption($scholarship_payment->payment_request_payment_request_id);
				$ExportDoc->ExportCaption($scholarship_payment->bankname);
				$ExportDoc->ExportCaption($scholarship_payment->account_no);
				$ExportDoc->ExportCaption($scholarship_payment->schools_school_id);
				$ExportDoc->ExportCaption($scholarship_payment->group_id);
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
				$scholarship_payment->CssClass = "";
				$scholarship_payment->CssStyle = "";
				$scholarship_payment->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($scholarship_payment->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('scholarship_payment_id', $scholarship_payment->scholarship_payment_id->ExportValue($scholarship_payment->Export, $scholarship_payment->ExportOriginalValue));
					$XmlDoc->AddField('date', $scholarship_payment->date->ExportValue($scholarship_payment->Export, $scholarship_payment->ExportOriginalValue));
					$XmlDoc->AddField('status', $scholarship_payment->status->ExportValue($scholarship_payment->Export, $scholarship_payment->ExportOriginalValue));
					$XmlDoc->AddField('amount', $scholarship_payment->amount->ExportValue($scholarship_payment->Export, $scholarship_payment->ExportOriginalValue));
					$XmlDoc->AddField('year', $scholarship_payment->year->ExportValue($scholarship_payment->Export, $scholarship_payment->ExportOriginalValue));
					$XmlDoc->AddField('scholarship_package_scholarship_package_id', $scholarship_payment->scholarship_package_scholarship_package_id->ExportValue($scholarship_payment->Export, $scholarship_payment->ExportOriginalValue));
					$XmlDoc->AddField('programarea_residentarea_id', $scholarship_payment->programarea_residentarea_id->ExportValue($scholarship_payment->Export, $scholarship_payment->ExportOriginalValue));
					$XmlDoc->AddField('programarea_payingarea_id', $scholarship_payment->programarea_payingarea_id->ExportValue($scholarship_payment->Export, $scholarship_payment->ExportOriginalValue));
					$XmlDoc->AddField('refund_amount', $scholarship_payment->refund_amount->ExportValue($scholarship_payment->Export, $scholarship_payment->ExportOriginalValue));
					$XmlDoc->AddField('payment_request_payment_request_id', $scholarship_payment->payment_request_payment_request_id->ExportValue($scholarship_payment->Export, $scholarship_payment->ExportOriginalValue));
					$XmlDoc->AddField('bankname', $scholarship_payment->bankname->ExportValue($scholarship_payment->Export, $scholarship_payment->ExportOriginalValue));
					$XmlDoc->AddField('account_no', $scholarship_payment->account_no->ExportValue($scholarship_payment->Export, $scholarship_payment->ExportOriginalValue));
					$XmlDoc->AddField('schools_school_id', $scholarship_payment->schools_school_id->ExportValue($scholarship_payment->Export, $scholarship_payment->ExportOriginalValue));
					$XmlDoc->AddField('group_id', $scholarship_payment->group_id->ExportValue($scholarship_payment->Export, $scholarship_payment->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($scholarship_payment->scholarship_payment_id);
					$ExportDoc->ExportField($scholarship_payment->date);
					$ExportDoc->ExportField($scholarship_payment->status);
					$ExportDoc->ExportField($scholarship_payment->amount);
					$ExportDoc->ExportField($scholarship_payment->year);
					$ExportDoc->ExportField($scholarship_payment->scholarship_package_scholarship_package_id);
					$ExportDoc->ExportField($scholarship_payment->programarea_residentarea_id);
					$ExportDoc->ExportField($scholarship_payment->programarea_payingarea_id);
					$ExportDoc->ExportField($scholarship_payment->refund_amount);
					$ExportDoc->ExportField($scholarship_payment->payment_request_payment_request_id);
					$ExportDoc->ExportField($scholarship_payment->bankname);
					$ExportDoc->ExportField($scholarship_payment->account_no);
					$ExportDoc->ExportField($scholarship_payment->schools_school_id);
					$ExportDoc->ExportField($scholarship_payment->group_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($scholarship_payment->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($scholarship_payment->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($scholarship_payment->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($scholarship_payment->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($scholarship_payment->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $scholarship_payment;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($scholarship_payment->group_id->CurrentValue);
			}
		}
		return TRUE;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $scholarship_payment;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "scholarship_package") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $scholarship_payment->SqlMasterFilter_scholarship_package();
				$this->sDbDetailFilter = $scholarship_payment->SqlDetailFilter_scholarship_package();
				if (@$_GET["scholarship_package_id"] <> "") {
					$GLOBALS["scholarship_package"]->scholarship_package_id->setQueryStringValue($_GET["scholarship_package_id"]);
					$scholarship_payment->scholarship_package_scholarship_package_id->setQueryStringValue($GLOBALS["scholarship_package"]->scholarship_package_id->QueryStringValue);
					$scholarship_payment->scholarship_package_scholarship_package_id->setSessionValue($scholarship_payment->scholarship_package_scholarship_package_id->QueryStringValue);
					if (!is_numeric($GLOBALS["scholarship_package"]->scholarship_package_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@scholarship_package_id@", ew_AdjustSql($GLOBALS["scholarship_package"]->scholarship_package_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@scholarship_package_scholarship_package_id@", ew_AdjustSql($GLOBALS["scholarship_package"]->scholarship_package_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$scholarship_payment->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$scholarship_payment->setStartRecordNumber($this->lStartRec);
			$scholarship_payment->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$scholarship_payment->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "scholarship_package") {
				if ($scholarship_payment->scholarship_package_scholarship_package_id->QueryStringValue == "") $scholarship_payment->scholarship_package_scholarship_package_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $scholarship_payment->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $scholarship_payment->getDetailFilter(); // Restore detail filter
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'scholarship_payment';
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
