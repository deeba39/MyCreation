<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "payment_requestinfo.php" ?>
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
$payment_request_list = new cpayment_request_list();
$Page =& $payment_request_list;

// Page init
$payment_request_list->Page_Init();

// Page main
$payment_request_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($payment_request->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var payment_request_list = new ew_Page("payment_request_list");

// page properties
payment_request_list.PageID = "list"; // page ID
payment_request_list.FormID = "fpayment_requestlist"; // form ID
var EW_PAGE_ID = payment_request_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
payment_request_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
payment_request_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
payment_request_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script type="text/javascript" src="ext/submitrequest.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($payment_request->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$payment_request_list->lTotalRecs = $payment_request->SelectRecordCount();
	} else {
		if ($rs = $payment_request_list->LoadRecordset())
			$payment_request_list->lTotalRecs = $rs->RecordCount();
	}
	$payment_request_list->lStartRec = 1;
	if ($payment_request_list->lDisplayRecs <= 0 || ($payment_request->Export <> "" && $payment_request->ExportAll)) // Display all records
		$payment_request_list->lDisplayRecs = $payment_request_list->lTotalRecs;
	if (!($payment_request->Export <> "" && $payment_request->ExportAll))
		$payment_request_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $payment_request_list->LoadRecordset($payment_request_list->lStartRec-1, $payment_request_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $payment_request->TableCaption() ?>
<?php if ($payment_request->Export == "" && $payment_request->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $payment_request_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $payment_request_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $payment_request_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($payment_request->Export == "" && $payment_request->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(payment_request_list);" style="text-decoration: none;"><img id="payment_request_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="payment_request_list_SearchPanel">
<form name="fpayment_requestlistsrch" id="fpayment_requestlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="payment_request">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $payment_request_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="payment_requestsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
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
$payment_request_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fpayment_requestlist" id="fpayment_requestlist" class="ewForm" action="" method="post">
<div id="gmp_payment_request" class="ewGridMiddlePanel">
<?php if ($payment_request_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $payment_request->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$payment_request_list->RenderListOptions();

// Render list options (header, left)
$payment_request_list->ListOptions->Render("header", "left");
?>
<?php if ($payment_request->payment_request_id->Visible) { // payment_request_id ?>
	<?php if ($payment_request->SortUrl($payment_request->payment_request_id) == "") { ?>
		<td><?php echo $payment_request->payment_request_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $payment_request->SortUrl($payment_request->payment_request_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $payment_request->payment_request_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($payment_request->payment_request_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($payment_request->payment_request_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($payment_request->year->Visible) { // year ?>
	<?php if ($payment_request->SortUrl($payment_request->year) == "") { ?>
		<td><?php echo $payment_request->year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $payment_request->SortUrl($payment_request->year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $payment_request->year->FldCaption() ?></td><td style="width: 10px;"><?php if ($payment_request->year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($payment_request->year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($payment_request->request_date->Visible) { // request_date ?>
	<?php if ($payment_request->SortUrl($payment_request->request_date) == "") { ?>
		<td><?php echo $payment_request->request_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $payment_request->SortUrl($payment_request->request_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $payment_request->request_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($payment_request->request_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($payment_request->request_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($payment_request->programarea_id->Visible) { // programarea_id ?>
	<?php if ($payment_request->SortUrl($payment_request->programarea_id) == "") { ?>
		<td><?php echo $payment_request->programarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $payment_request->SortUrl($payment_request->programarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $payment_request->programarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($payment_request->programarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($payment_request->programarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($payment_request->request_status->Visible) { // request_status ?>
	<?php if ($payment_request->SortUrl($payment_request->request_status) == "") { ?>
		<td><?php echo $payment_request->request_status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $payment_request->SortUrl($payment_request->request_status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $payment_request->request_status->FldCaption() ?></td><td style="width: 10px;"><?php if ($payment_request->request_status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($payment_request->request_status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($payment_request->code->Visible) { // code ?>
	<?php if ($payment_request->SortUrl($payment_request->code) == "") { ?>
		<td><?php echo $payment_request->code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $payment_request->SortUrl($payment_request->code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $payment_request->code->FldCaption() ?></td><td style="width: 10px;"><?php if ($payment_request->code->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($payment_request->code->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($payment_request->financial_year_financial_year_id->Visible) { // financial_year_financial_year_id ?>
	<?php if ($payment_request->SortUrl($payment_request->financial_year_financial_year_id) == "") { ?>
		<td><?php echo $payment_request->financial_year_financial_year_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $payment_request->SortUrl($payment_request->financial_year_financial_year_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $payment_request->financial_year_financial_year_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($payment_request->financial_year_financial_year_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($payment_request->financial_year_financial_year_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($payment_request->amount->Visible) { // amount ?>
	<?php if ($payment_request->SortUrl($payment_request->amount) == "") { ?>
		<td><?php echo $payment_request->amount->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $payment_request->SortUrl($payment_request->amount) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $payment_request->amount->FldCaption() ?></td><td style="width: 10px;"><?php if ($payment_request->amount->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($payment_request->amount->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($payment_request->group_id->Visible) { // group_id ?>
	<?php if ($payment_request->SortUrl($payment_request->group_id) == "") { ?>
		<td><?php echo $payment_request->group_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $payment_request->SortUrl($payment_request->group_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $payment_request->group_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($payment_request->group_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($payment_request->group_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$payment_request_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($payment_request->ExportAll && $payment_request->Export <> "") {
	$payment_request_list->lStopRec = $payment_request_list->lTotalRecs;
} else {
	$payment_request_list->lStopRec = $payment_request_list->lStartRec + $payment_request_list->lDisplayRecs - 1; // Set the last record to display
}
$payment_request_list->lRecCount = $payment_request_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $payment_request_list->lStartRec > 1)
		$rs->Move($payment_request_list->lStartRec - 1);
}

// Initialize aggregate
$payment_request->RowType = EW_ROWTYPE_AGGREGATEINIT;
$payment_request_list->RenderRow();
$payment_request_list->lRowCnt = 0;
while (($payment_request->CurrentAction == "gridadd" || !$rs->EOF) &&
	$payment_request_list->lRecCount < $payment_request_list->lStopRec) {
	$payment_request_list->lRecCount++;
	if (intval($payment_request_list->lRecCount) >= intval($payment_request_list->lStartRec)) {
		$payment_request_list->lRowCnt++;

	// Init row class and style
	$payment_request->CssClass = "";
	$payment_request->CssStyle = "";
	$payment_request->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($payment_request->CurrentAction == "gridadd") {
		$payment_request_list->LoadDefaultValues(); // Load default values
	} else {
		$payment_request_list->LoadRowValues($rs); // Load row values
	}
	$payment_request->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$payment_request_list->RenderRow();

	// Render list options
	$payment_request_list->RenderListOptions();
?>
	<tr<?php echo $payment_request->RowAttributes() ?>>
<?php

// Render list options (body, left)
$payment_request_list->ListOptions->Render("body", "left");
?>
	<?php if ($payment_request->payment_request_id->Visible) { // payment_request_id ?>
		<td<?php echo $payment_request->payment_request_id->CellAttributes() ?>>
<div<?php echo $payment_request->payment_request_id->ViewAttributes() ?>><?php echo $payment_request->payment_request_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($payment_request->year->Visible) { // year ?>
		<td<?php echo $payment_request->year->CellAttributes() ?>>
<div<?php echo $payment_request->year->ViewAttributes() ?>><?php echo $payment_request->year->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($payment_request->request_date->Visible) { // request_date ?>
		<td<?php echo $payment_request->request_date->CellAttributes() ?>>
<div<?php echo $payment_request->request_date->ViewAttributes() ?>><?php echo $payment_request->request_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($payment_request->programarea_id->Visible) { // programarea_id ?>
		<td<?php echo $payment_request->programarea_id->CellAttributes() ?>>
<div<?php echo $payment_request->programarea_id->ViewAttributes() ?>><?php echo $payment_request->programarea_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($payment_request->request_status->Visible) { // request_status ?>
		<td<?php echo $payment_request->request_status->CellAttributes() ?>>
<div<?php echo $payment_request->request_status->ViewAttributes() ?>><?php echo $payment_request->request_status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($payment_request->code->Visible) { // code ?>
		<td<?php echo $payment_request->code->CellAttributes() ?>>
<div<?php echo $payment_request->code->ViewAttributes() ?>><?php echo $payment_request->code->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($payment_request->financial_year_financial_year_id->Visible) { // financial_year_financial_year_id ?>
		<td<?php echo $payment_request->financial_year_financial_year_id->CellAttributes() ?>>
<div<?php echo $payment_request->financial_year_financial_year_id->ViewAttributes() ?>><?php echo $payment_request->financial_year_financial_year_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($payment_request->amount->Visible) { // amount ?>
		<td<?php echo $payment_request->amount->CellAttributes() ?>>
<div<?php echo $payment_request->amount->ViewAttributes() ?>><?php echo $payment_request->amount->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($payment_request->group_id->Visible) { // group_id ?>
		<td<?php echo $payment_request->group_id->CellAttributes() ?>>
<div<?php echo $payment_request->group_id->ViewAttributes() ?>><?php echo $payment_request->group_id->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$payment_request_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($payment_request->CurrentAction <> "gridadd")
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
<?php if ($payment_request->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($payment_request->CurrentAction <> "gridadd" && $payment_request->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($payment_request_list->Pager)) $payment_request_list->Pager = new cPrevNextPager($payment_request_list->lStartRec, $payment_request_list->lDisplayRecs, $payment_request_list->lTotalRecs) ?>
<?php if ($payment_request_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($payment_request_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $payment_request_list->PageUrl() ?>start=<?php echo $payment_request_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($payment_request_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $payment_request_list->PageUrl() ?>start=<?php echo $payment_request_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $payment_request_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($payment_request_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $payment_request_list->PageUrl() ?>start=<?php echo $payment_request_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($payment_request_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $payment_request_list->PageUrl() ?>start=<?php echo $payment_request_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $payment_request_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $payment_request_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $payment_request_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $payment_request_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($payment_request_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($payment_request_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $payment_request_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($payment_request->Export == "" && $payment_request->CurrentAction == "") { ?>
<?php } ?>
<?php if ($payment_request->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$payment_request_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpayment_request_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'payment_request';

	// Page object name
	var $PageObjName = 'payment_request_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $payment_request;
		if ($payment_request->UseTokenInUrl) $PageUrl .= "t=" . $payment_request->TableVar . "&"; // Add page token
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
		global $objForm, $payment_request;
		if ($payment_request->UseTokenInUrl) {
			if ($objForm)
				return ($payment_request->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($payment_request->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpayment_request_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (payment_request)
		$GLOBALS["payment_request"] = new cpayment_request();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["payment_request"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "payment_requestdelete.php";
		$this->MultiUpdateUrl = "payment_requestupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'payment_request', TRUE);

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
		global $payment_request;

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
			$payment_request->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$payment_request->Export = $_POST["exporttype"];
		} else {
			$payment_request->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $payment_request->Export; // Get export parameter, used in header
		$gsExportFile = $payment_request->TableVar; // Get export file, used in header
		if ($payment_request->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($payment_request->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $payment_request;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$payment_request->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($payment_request->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $payment_request->getRecordsPerPage(); // Restore from Session
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
		$payment_request->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$payment_request->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$payment_request->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $payment_request->getSearchWhere();
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
		$payment_request->setSessionWhere($sFilter);
		$payment_request->CurrentFilter = "";

		// Export data only
		if (in_array($payment_request->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($payment_request->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $payment_request;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $payment_request->payment_request_id, FALSE); // payment_request_id
		$this->BuildSearchSql($sWhere, $payment_request->year, FALSE); // year
		$this->BuildSearchSql($sWhere, $payment_request->request_date, FALSE); // request_date
		$this->BuildSearchSql($sWhere, $payment_request->programarea_id, FALSE); // programarea_id
		$this->BuildSearchSql($sWhere, $payment_request->request_status, FALSE); // request_status
		$this->BuildSearchSql($sWhere, $payment_request->code, FALSE); // code
		$this->BuildSearchSql($sWhere, $payment_request->financial_year_financial_year_id, FALSE); // financial_year_financial_year_id
		$this->BuildSearchSql($sWhere, $payment_request->amount, FALSE); // amount
		$this->BuildSearchSql($sWhere, $payment_request->group_id, FALSE); // group_id

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($payment_request->payment_request_id); // payment_request_id
			$this->SetSearchParm($payment_request->year); // year
			$this->SetSearchParm($payment_request->request_date); // request_date
			$this->SetSearchParm($payment_request->programarea_id); // programarea_id
			$this->SetSearchParm($payment_request->request_status); // request_status
			$this->SetSearchParm($payment_request->code); // code
			$this->SetSearchParm($payment_request->financial_year_financial_year_id); // financial_year_financial_year_id
			$this->SetSearchParm($payment_request->amount); // amount
			$this->SetSearchParm($payment_request->group_id); // group_id
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
		global $payment_request;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$payment_request->setAdvancedSearch("x_$FldParm", $FldVal);
		$payment_request->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$payment_request->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$payment_request->setAdvancedSearch("y_$FldParm", $FldVal2);
		$payment_request->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $payment_request;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $payment_request->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $payment_request->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $payment_request->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $payment_request->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $payment_request->GetAdvancedSearch("w_$FldParm");
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
		global $payment_request;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$payment_request->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $payment_request;
		$payment_request->setAdvancedSearch("x_payment_request_id", "");
		$payment_request->setAdvancedSearch("x_year", "");
		$payment_request->setAdvancedSearch("x_request_date", "");
		$payment_request->setAdvancedSearch("x_programarea_id", "");
		$payment_request->setAdvancedSearch("x_request_status", "");
		$payment_request->setAdvancedSearch("x_code", "");
		$payment_request->setAdvancedSearch("x_financial_year_financial_year_id", "");
		$payment_request->setAdvancedSearch("x_amount", "");
		$payment_request->setAdvancedSearch("x_group_id", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $payment_request;
		$bRestore = TRUE;
		if (@$_GET["x_payment_request_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_year"] <> "") $bRestore = FALSE;
		if (@$_GET["x_request_date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_programarea_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_request_status"] <> "") $bRestore = FALSE;
		if (@$_GET["x_code"] <> "") $bRestore = FALSE;
		if (@$_GET["x_financial_year_financial_year_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_amount"] <> "") $bRestore = FALSE;
		if (@$_GET["x_group_id"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($payment_request->payment_request_id);
			$this->GetSearchParm($payment_request->year);
			$this->GetSearchParm($payment_request->request_date);
			$this->GetSearchParm($payment_request->programarea_id);
			$this->GetSearchParm($payment_request->request_status);
			$this->GetSearchParm($payment_request->code);
			$this->GetSearchParm($payment_request->financial_year_financial_year_id);
			$this->GetSearchParm($payment_request->amount);
			$this->GetSearchParm($payment_request->group_id);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $payment_request;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$payment_request->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$payment_request->CurrentOrderType = @$_GET["ordertype"];
			$payment_request->UpdateSort($payment_request->payment_request_id); // payment_request_id
			$payment_request->UpdateSort($payment_request->year); // year
			$payment_request->UpdateSort($payment_request->request_date); // request_date
			$payment_request->UpdateSort($payment_request->programarea_id); // programarea_id
			$payment_request->UpdateSort($payment_request->request_status); // request_status
			$payment_request->UpdateSort($payment_request->code); // code
			$payment_request->UpdateSort($payment_request->financial_year_financial_year_id); // financial_year_financial_year_id
			$payment_request->UpdateSort($payment_request->amount); // amount
			$payment_request->UpdateSort($payment_request->group_id); // group_id
			$payment_request->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $payment_request;
		$sOrderBy = $payment_request->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($payment_request->SqlOrderBy() <> "") {
				$sOrderBy = $payment_request->SqlOrderBy();
				$payment_request->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $payment_request;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$payment_request->setSessionOrderBy($sOrderBy);
				$payment_request->payment_request_id->setSort("");
				$payment_request->year->setSort("");
				$payment_request->request_date->setSort("");
				$payment_request->programarea_id->setSort("");
				$payment_request->request_status->setSort("");
				$payment_request->code->setSort("");
				$payment_request->financial_year_financial_year_id->setSort("");
				$payment_request->amount->setSort("");
				$payment_request->group_id->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$payment_request->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $payment_request;

		
		//customization-kgosafomaafo
		//customization-start
		global $custom_include_root;
		include $custom_include_root.'payment_request_row_init.php';
		//customization-end

                // "submit request"
		$this->ListOptions->Add("submitrequest");
		$item =& $this->ListOptions->Items["submitrequest"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = FALSE;

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
		if ($payment_request->Export <> "" ||
			$payment_request->CurrentAction == "gridadd" ||
			$payment_request->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $payment_request;
		$this->ListOptions->LoadDefault();

		//customization-kgosafomaafo
		//customization-start
		global $custom_include_root;
		include $custom_include_root.'payment_request_row_use.php';
		//customization-end

                 // "edit"
		$oListOpt =& $this->ListOptions->Items["submitrequest"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
                    if(strcasecmp($payment_request->request_status->CurrentValue,'NEWREQ')==0)
                    {
                        $id=$payment_request->payment_request_id->CurrentValue;
			$oListOpt->Body =
                        "<span style='color:blue;cursor:pointer;text-decoration:underline'
                            onclick='submitPaymentRequest(this,$id)'>submit request</span>";
                    }
		}
		
		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $this->ShowOptionLink() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . "<img src=\"images/view.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";

                // "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
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
		global $Security, $Language, $payment_request;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $payment_request;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$payment_request->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$payment_request->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $payment_request->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$payment_request->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$payment_request->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$payment_request->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $payment_request;

		// Load search values
		// payment_request_id

		$payment_request->payment_request_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_payment_request_id"]);
		$payment_request->payment_request_id->AdvancedSearch->SearchOperator = @$_GET["z_payment_request_id"];

		// year
		$payment_request->year->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_year"]);
		$payment_request->year->AdvancedSearch->SearchOperator = @$_GET["z_year"];

		// request_date
		$payment_request->request_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_request_date"]);
		$payment_request->request_date->AdvancedSearch->SearchOperator = @$_GET["z_request_date"];

		// programarea_id
		$payment_request->programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programarea_id"]);
		$payment_request->programarea_id->AdvancedSearch->SearchOperator = @$_GET["z_programarea_id"];

		// request_status
		$payment_request->request_status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_request_status"]);
		$payment_request->request_status->AdvancedSearch->SearchOperator = @$_GET["z_request_status"];

		// code
		$payment_request->code->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_code"]);
		$payment_request->code->AdvancedSearch->SearchOperator = @$_GET["z_code"];

		// financial_year_financial_year_id
		$payment_request->financial_year_financial_year_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_financial_year_financial_year_id"]);
		$payment_request->financial_year_financial_year_id->AdvancedSearch->SearchOperator = @$_GET["z_financial_year_financial_year_id"];

		// amount
		$payment_request->amount->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_amount"]);
		$payment_request->amount->AdvancedSearch->SearchOperator = @$_GET["z_amount"];

		// group_id
		$payment_request->group_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_group_id"]);
		$payment_request->group_id->AdvancedSearch->SearchOperator = @$_GET["z_group_id"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $payment_request;

		// Call Recordset Selecting event
		$payment_request->Recordset_Selecting($payment_request->CurrentFilter);

		// Load List page SQL
		$sSql = $payment_request->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$payment_request->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $payment_request;
		$sFilter = $payment_request->KeyFilter();

		// Call Row Selecting event
		$payment_request->Row_Selecting($sFilter);

		// Load SQL based on filter
		$payment_request->CurrentFilter = $sFilter;
		$sSql = $payment_request->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$payment_request->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $payment_request;
		$payment_request->payment_request_id->setDbValue($rs->fields('payment_request_id'));
		$payment_request->year->setDbValue($rs->fields('year'));
		$payment_request->request_date->setDbValue($rs->fields('request_date'));
		$payment_request->programarea_id->setDbValue($rs->fields('programarea_id'));
		$payment_request->request_status->setDbValue($rs->fields('request_status'));
		$payment_request->code->setDbValue($rs->fields('code'));
		$payment_request->financial_year_financial_year_id->setDbValue($rs->fields('financial_year_financial_year_id'));
		$payment_request->amount->setDbValue($rs->fields('amount'));
		$payment_request->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $payment_request;

		// Initialize URLs
		$this->ViewUrl = $payment_request->ViewUrl();
		$this->EditUrl = $payment_request->EditUrl();
		$this->InlineEditUrl = $payment_request->InlineEditUrl();
		$this->CopyUrl = $payment_request->CopyUrl();
		$this->InlineCopyUrl = $payment_request->InlineCopyUrl();
		$this->DeleteUrl = $payment_request->DeleteUrl();

		// Call Row_Rendering event
		$payment_request->Row_Rendering();

		// Common render codes for all row types
		// payment_request_id

		$payment_request->payment_request_id->CellCssStyle = ""; $payment_request->payment_request_id->CellCssClass = "";
		$payment_request->payment_request_id->CellAttrs = array(); $payment_request->payment_request_id->ViewAttrs = array(); $payment_request->payment_request_id->EditAttrs = array();

		// year
		$payment_request->year->CellCssStyle = ""; $payment_request->year->CellCssClass = "";
		$payment_request->year->CellAttrs = array(); $payment_request->year->ViewAttrs = array(); $payment_request->year->EditAttrs = array();

		// request_date
		$payment_request->request_date->CellCssStyle = ""; $payment_request->request_date->CellCssClass = "";
		$payment_request->request_date->CellAttrs = array(); $payment_request->request_date->ViewAttrs = array(); $payment_request->request_date->EditAttrs = array();

		// programarea_id
		$payment_request->programarea_id->CellCssStyle = ""; $payment_request->programarea_id->CellCssClass = "";
		$payment_request->programarea_id->CellAttrs = array(); $payment_request->programarea_id->ViewAttrs = array(); $payment_request->programarea_id->EditAttrs = array();

		// request_status
		$payment_request->request_status->CellCssStyle = ""; $payment_request->request_status->CellCssClass = "";
		$payment_request->request_status->CellAttrs = array(); $payment_request->request_status->ViewAttrs = array(); $payment_request->request_status->EditAttrs = array();

		// code
		$payment_request->code->CellCssStyle = ""; $payment_request->code->CellCssClass = "";
		$payment_request->code->CellAttrs = array(); $payment_request->code->ViewAttrs = array(); $payment_request->code->EditAttrs = array();

		// financial_year_financial_year_id
		$payment_request->financial_year_financial_year_id->CellCssStyle = ""; $payment_request->financial_year_financial_year_id->CellCssClass = "";
		$payment_request->financial_year_financial_year_id->CellAttrs = array(); $payment_request->financial_year_financial_year_id->ViewAttrs = array(); $payment_request->financial_year_financial_year_id->EditAttrs = array();

		// amount
		$payment_request->amount->CellCssStyle = ""; $payment_request->amount->CellCssClass = "";
		$payment_request->amount->CellAttrs = array(); $payment_request->amount->ViewAttrs = array(); $payment_request->amount->EditAttrs = array();

		// group_id
		$payment_request->group_id->CellCssStyle = ""; $payment_request->group_id->CellCssClass = "";
		$payment_request->group_id->CellAttrs = array(); $payment_request->group_id->ViewAttrs = array(); $payment_request->group_id->EditAttrs = array();
		if ($payment_request->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$payment_request->payment_request_id->ViewValue = $payment_request->payment_request_id->CurrentValue;
			$payment_request->payment_request_id->CssStyle = "";
			$payment_request->payment_request_id->CssClass = "";
			$payment_request->payment_request_id->ViewCustomAttributes = "";

			// year
			$payment_request->year->ViewValue = $payment_request->year->CurrentValue;
			$payment_request->year->CssStyle = "";
			$payment_request->year->CssClass = "";
			$payment_request->year->ViewCustomAttributes = "";

			// request_date
			$payment_request->request_date->ViewValue = $payment_request->request_date->CurrentValue;
			$payment_request->request_date->ViewValue = ew_FormatDateTime($payment_request->request_date->ViewValue, 7);
			$payment_request->request_date->CssStyle = "";
			$payment_request->request_date->CssClass = "";
			$payment_request->request_date->ViewCustomAttributes = "";

			// programarea_id
			if (strval($payment_request->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($payment_request->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$payment_request->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$payment_request->programarea_id->ViewValue = $payment_request->programarea_id->CurrentValue;
				}
			} else {
				$payment_request->programarea_id->ViewValue = NULL;
			}
			$payment_request->programarea_id->CssStyle = "";
			$payment_request->programarea_id->CssClass = "";
			$payment_request->programarea_id->ViewCustomAttributes = "";

			// request_status
			$payment_request->request_status->ViewValue = $payment_request->request_status->CurrentValue;
			$payment_request->request_status->CssStyle = "";
			$payment_request->request_status->CssClass = "";
			$payment_request->request_status->ViewCustomAttributes = "";

			// code
			$payment_request->code->ViewValue = $payment_request->code->CurrentValue;
			$payment_request->code->CssStyle = "";
			$payment_request->code->CssClass = "";
			$payment_request->code->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			if (strval($payment_request->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($payment_request->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$payment_request->financial_year_financial_year_id->ViewValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$payment_request->financial_year_financial_year_id->ViewValue = $payment_request->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$payment_request->financial_year_financial_year_id->ViewValue = NULL;
			}
			$payment_request->financial_year_financial_year_id->CssStyle = "";
			$payment_request->financial_year_financial_year_id->CssClass = "";
			$payment_request->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$payment_request->amount->ViewValue = $payment_request->amount->CurrentValue;
			$payment_request->amount->CssStyle = "";
			$payment_request->amount->CssClass = "";
			$payment_request->amount->ViewCustomAttributes = "";

			// group_id
			$payment_request->group_id->ViewValue = $payment_request->group_id->CurrentValue;
			$payment_request->group_id->CssStyle = "";
			$payment_request->group_id->CssClass = "";
			$payment_request->group_id->ViewCustomAttributes = "";

			// payment_request_id
			$payment_request->payment_request_id->HrefValue = "";
			$payment_request->payment_request_id->TooltipValue = "";

			// year
			$payment_request->year->HrefValue = "";
			$payment_request->year->TooltipValue = "";

			// request_date
			$payment_request->request_date->HrefValue = "";
			$payment_request->request_date->TooltipValue = "";

			// programarea_id
			$payment_request->programarea_id->HrefValue = "";
			$payment_request->programarea_id->TooltipValue = "";

			// request_status
			$payment_request->request_status->HrefValue = "";
			$payment_request->request_status->TooltipValue = "";

			// code
			$payment_request->code->HrefValue = "";
			$payment_request->code->TooltipValue = "";

			// financial_year_financial_year_id
			$payment_request->financial_year_financial_year_id->HrefValue = "";
			$payment_request->financial_year_financial_year_id->TooltipValue = "";

			// amount
			$payment_request->amount->HrefValue = "";
			$payment_request->amount->TooltipValue = "";

			// group_id
			$payment_request->group_id->HrefValue = "";
			$payment_request->group_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($payment_request->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$payment_request->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $payment_request;

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
		global $payment_request;
		$payment_request->payment_request_id->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_payment_request_id");
		$payment_request->year->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_year");
		$payment_request->request_date->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_request_date");
		$payment_request->programarea_id->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_programarea_id");
		$payment_request->request_status->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_request_status");
		$payment_request->code->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_code");
		$payment_request->financial_year_financial_year_id->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_financial_year_financial_year_id");
		$payment_request->amount->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_amount");
		$payment_request->group_id->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_group_id");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $payment_request;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $payment_request->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($payment_request->ExportAll) {
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
		if ($payment_request->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($payment_request, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($payment_request->payment_request_id);
				$ExportDoc->ExportCaption($payment_request->year);
				$ExportDoc->ExportCaption($payment_request->request_date);
				$ExportDoc->ExportCaption($payment_request->programarea_id);
				$ExportDoc->ExportCaption($payment_request->request_status);
				$ExportDoc->ExportCaption($payment_request->code);
				$ExportDoc->ExportCaption($payment_request->financial_year_financial_year_id);
				$ExportDoc->ExportCaption($payment_request->amount);
				$ExportDoc->ExportCaption($payment_request->group_id);
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
				$payment_request->CssClass = "";
				$payment_request->CssStyle = "";
				$payment_request->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($payment_request->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('payment_request_id', $payment_request->payment_request_id->ExportValue($payment_request->Export, $payment_request->ExportOriginalValue));
					$XmlDoc->AddField('year', $payment_request->year->ExportValue($payment_request->Export, $payment_request->ExportOriginalValue));
					$XmlDoc->AddField('request_date', $payment_request->request_date->ExportValue($payment_request->Export, $payment_request->ExportOriginalValue));
					$XmlDoc->AddField('programarea_id', $payment_request->programarea_id->ExportValue($payment_request->Export, $payment_request->ExportOriginalValue));
					$XmlDoc->AddField('request_status', $payment_request->request_status->ExportValue($payment_request->Export, $payment_request->ExportOriginalValue));
					$XmlDoc->AddField('code', $payment_request->code->ExportValue($payment_request->Export, $payment_request->ExportOriginalValue));
					$XmlDoc->AddField('financial_year_financial_year_id', $payment_request->financial_year_financial_year_id->ExportValue($payment_request->Export, $payment_request->ExportOriginalValue));
					$XmlDoc->AddField('amount', $payment_request->amount->ExportValue($payment_request->Export, $payment_request->ExportOriginalValue));
					$XmlDoc->AddField('group_id', $payment_request->group_id->ExportValue($payment_request->Export, $payment_request->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($payment_request->payment_request_id);
					$ExportDoc->ExportField($payment_request->year);
					$ExportDoc->ExportField($payment_request->request_date);
					$ExportDoc->ExportField($payment_request->programarea_id);
					$ExportDoc->ExportField($payment_request->request_status);
					$ExportDoc->ExportField($payment_request->code);
					$ExportDoc->ExportField($payment_request->financial_year_financial_year_id);
					$ExportDoc->ExportField($payment_request->amount);
					$ExportDoc->ExportField($payment_request->group_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($payment_request->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($payment_request->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($payment_request->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($payment_request->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($payment_request->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $payment_request;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($payment_request->group_id->CurrentValue);
			}
		}
		return TRUE;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'payment_request';
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
