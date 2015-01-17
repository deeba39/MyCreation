<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "Payment_Refundinfo.php" ?>
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
$Payment_Refund_list = new cPayment_Refund_list();
$Page =& $Payment_Refund_list;

// Page init
$Payment_Refund_list->Page_Init();

// Page main
$Payment_Refund_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($Payment_Refund->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var Payment_Refund_list = new ew_Page("Payment_Refund_list");

// page properties
Payment_Refund_list.PageID = "list"; // page ID
Payment_Refund_list.FormID = "fPayment_Refundlist"; // form ID
var EW_PAGE_ID = Payment_Refund_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
Payment_Refund_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
Payment_Refund_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Payment_Refund_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($Payment_Refund->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$Payment_Refund_list->lTotalRecs = $Payment_Refund->SelectRecordCount();
	} else {
		if ($rs = $Payment_Refund_list->LoadRecordset())
			$Payment_Refund_list->lTotalRecs = $rs->RecordCount();
	}
	$Payment_Refund_list->lStartRec = 1;
	if ($Payment_Refund_list->lDisplayRecs <= 0 || ($Payment_Refund->Export <> "" && $Payment_Refund->ExportAll)) // Display all records
		$Payment_Refund_list->lDisplayRecs = $Payment_Refund_list->lTotalRecs;
	if (!($Payment_Refund->Export <> "" && $Payment_Refund->ExportAll))
		$Payment_Refund_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $Payment_Refund_list->LoadRecordset($Payment_Refund_list->lStartRec-1, $Payment_Refund_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $Payment_Refund->TableCaption() ?>
<?php if ($Payment_Refund->Export == "" && $Payment_Refund->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Payment_Refund_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Payment_Refund_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Payment_Refund_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($Payment_Refund->Export == "" && $Payment_Refund->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(Payment_Refund_list);" style="text-decoration: none;"><img id="Payment_Refund_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="Payment_Refund_list_SearchPanel">
<form name="fPayment_Refundlistsrch" id="fPayment_Refundlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="Payment_Refund">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $Payment_Refund_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="Payment_Refundsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
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
$Payment_Refund_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fPayment_Refundlist" id="fPayment_Refundlist" class="ewForm" action="" method="post">
<div id="gmp_Payment_Refund" class="ewGridMiddlePanel">
<?php if ($Payment_Refund_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $Payment_Refund->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$Payment_Refund_list->RenderListOptions();

// Render list options (header, left)
$Payment_Refund_list->ListOptions->Render("header", "left");
?>
<?php if ($Payment_Refund->status->Visible) { // status ?>
	<?php if ($Payment_Refund->SortUrl($Payment_Refund->status) == "") { ?>
		<td><?php echo $Payment_Refund->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Payment_Refund->SortUrl($Payment_Refund->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Payment_Refund->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($Payment_Refund->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Payment_Refund->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Payment_Refund->refund_amount->Visible) { // refund_amount ?>
	<?php if ($Payment_Refund->SortUrl($Payment_Refund->refund_amount) == "") { ?>
		<td><?php echo $Payment_Refund->refund_amount->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Payment_Refund->SortUrl($Payment_Refund->refund_amount) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Payment_Refund->refund_amount->FldCaption() ?></td><td style="width: 10px;"><?php if ($Payment_Refund->refund_amount->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Payment_Refund->refund_amount->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Payment_Refund->amount->Visible) { // amount ?>
	<?php if ($Payment_Refund->SortUrl($Payment_Refund->amount) == "") { ?>
		<td><?php echo $Payment_Refund->amount->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Payment_Refund->SortUrl($Payment_Refund->amount) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Payment_Refund->amount->FldCaption() ?></td><td style="width: 10px;"><?php if ($Payment_Refund->amount->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Payment_Refund->amount->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Payment_Refund->year->Visible) { // year ?>
	<?php if ($Payment_Refund->SortUrl($Payment_Refund->year) == "") { ?>
		<td><?php echo $Payment_Refund->year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Payment_Refund->SortUrl($Payment_Refund->year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Payment_Refund->year->FldCaption() ?></td><td style="width: 10px;"><?php if ($Payment_Refund->year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Payment_Refund->year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Payment_Refund->scholarship_package_scholarship_package_id->Visible) { // scholarship_package_scholarship_package_id ?>
	<?php if ($Payment_Refund->SortUrl($Payment_Refund->scholarship_package_scholarship_package_id) == "") { ?>
		<td><?php echo $Payment_Refund->scholarship_package_scholarship_package_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Payment_Refund->SortUrl($Payment_Refund->scholarship_package_scholarship_package_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Payment_Refund->scholarship_package_scholarship_package_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($Payment_Refund->scholarship_package_scholarship_package_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Payment_Refund->scholarship_package_scholarship_package_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Payment_Refund->programarea_payingarea_id->Visible) { // programarea_payingarea_id ?>
	<?php if ($Payment_Refund->SortUrl($Payment_Refund->programarea_payingarea_id) == "") { ?>
		<td><?php echo $Payment_Refund->programarea_payingarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Payment_Refund->SortUrl($Payment_Refund->programarea_payingarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Payment_Refund->programarea_payingarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($Payment_Refund->programarea_payingarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Payment_Refund->programarea_payingarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Payment_Refund->payment_request_payment_request_id->Visible) { // payment_request_payment_request_id ?>
	<?php if ($Payment_Refund->SortUrl($Payment_Refund->payment_request_payment_request_id) == "") { ?>
		<td><?php echo $Payment_Refund->payment_request_payment_request_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Payment_Refund->SortUrl($Payment_Refund->payment_request_payment_request_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Payment_Refund->payment_request_payment_request_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($Payment_Refund->payment_request_payment_request_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Payment_Refund->payment_request_payment_request_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Payment_Refund->bankname->Visible) { // bankname ?>
	<?php if ($Payment_Refund->SortUrl($Payment_Refund->bankname) == "") { ?>
		<td><?php echo $Payment_Refund->bankname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Payment_Refund->SortUrl($Payment_Refund->bankname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Payment_Refund->bankname->FldCaption() ?></td><td style="width: 10px;"><?php if ($Payment_Refund->bankname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Payment_Refund->bankname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Payment_Refund->account_no->Visible) { // account_no ?>
	<?php if ($Payment_Refund->SortUrl($Payment_Refund->account_no) == "") { ?>
		<td><?php echo $Payment_Refund->account_no->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Payment_Refund->SortUrl($Payment_Refund->account_no) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Payment_Refund->account_no->FldCaption() ?></td><td style="width: 10px;"><?php if ($Payment_Refund->account_no->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Payment_Refund->account_no->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Payment_Refund->schools_school_id->Visible) { // schools_school_id ?>
	<?php if ($Payment_Refund->SortUrl($Payment_Refund->schools_school_id) == "") { ?>
		<td><?php echo $Payment_Refund->schools_school_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Payment_Refund->SortUrl($Payment_Refund->schools_school_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Payment_Refund->schools_school_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($Payment_Refund->schools_school_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Payment_Refund->schools_school_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$Payment_Refund_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($Payment_Refund->ExportAll && $Payment_Refund->Export <> "") {
	$Payment_Refund_list->lStopRec = $Payment_Refund_list->lTotalRecs;
} else {
	$Payment_Refund_list->lStopRec = $Payment_Refund_list->lStartRec + $Payment_Refund_list->lDisplayRecs - 1; // Set the last record to display
}
$Payment_Refund_list->lRecCount = $Payment_Refund_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $Payment_Refund_list->lStartRec > 1)
		$rs->Move($Payment_Refund_list->lStartRec - 1);
}

// Initialize aggregate
$Payment_Refund->RowType = EW_ROWTYPE_AGGREGATEINIT;
$Payment_Refund_list->RenderRow();
$Payment_Refund_list->lRowCnt = 0;
while (($Payment_Refund->CurrentAction == "gridadd" || !$rs->EOF) &&
	$Payment_Refund_list->lRecCount < $Payment_Refund_list->lStopRec) {
	$Payment_Refund_list->lRecCount++;
	if (intval($Payment_Refund_list->lRecCount) >= intval($Payment_Refund_list->lStartRec)) {
		$Payment_Refund_list->lRowCnt++;

	// Init row class and style
	$Payment_Refund->CssClass = "";
	$Payment_Refund->CssStyle = "";
	$Payment_Refund->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($Payment_Refund->CurrentAction == "gridadd") {
		$Payment_Refund_list->LoadDefaultValues(); // Load default values
	} else {
		$Payment_Refund_list->LoadRowValues($rs); // Load row values
	}
	$Payment_Refund->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$Payment_Refund_list->RenderRow();

	// Render list options
	$Payment_Refund_list->RenderListOptions();
?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
<?php

// Render list options (body, left)
$Payment_Refund_list->ListOptions->Render("body", "left");
?>
	<?php if ($Payment_Refund->status->Visible) { // status ?>
		<td<?php echo $Payment_Refund->status->CellAttributes() ?>>
<div<?php echo $Payment_Refund->status->ViewAttributes() ?>><?php echo $Payment_Refund->status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($Payment_Refund->refund_amount->Visible) { // refund_amount ?>
		<td<?php echo $Payment_Refund->refund_amount->CellAttributes() ?>>
<div<?php echo $Payment_Refund->refund_amount->ViewAttributes() ?>><?php echo $Payment_Refund->refund_amount->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($Payment_Refund->amount->Visible) { // amount ?>
		<td<?php echo $Payment_Refund->amount->CellAttributes() ?>>
<div<?php echo $Payment_Refund->amount->ViewAttributes() ?>><?php echo $Payment_Refund->amount->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($Payment_Refund->year->Visible) { // year ?>
		<td<?php echo $Payment_Refund->year->CellAttributes() ?>>
<div<?php echo $Payment_Refund->year->ViewAttributes() ?>><?php echo $Payment_Refund->year->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($Payment_Refund->scholarship_package_scholarship_package_id->Visible) { // scholarship_package_scholarship_package_id ?>
		<td<?php echo $Payment_Refund->scholarship_package_scholarship_package_id->CellAttributes() ?>>
<div<?php echo $Payment_Refund->scholarship_package_scholarship_package_id->ViewAttributes() ?>><?php echo $Payment_Refund->scholarship_package_scholarship_package_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($Payment_Refund->programarea_payingarea_id->Visible) { // programarea_payingarea_id ?>
		<td<?php echo $Payment_Refund->programarea_payingarea_id->CellAttributes() ?>>
<div<?php echo $Payment_Refund->programarea_payingarea_id->ViewAttributes() ?>><?php echo $Payment_Refund->programarea_payingarea_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($Payment_Refund->payment_request_payment_request_id->Visible) { // payment_request_payment_request_id ?>
		<td<?php echo $Payment_Refund->payment_request_payment_request_id->CellAttributes() ?>>
<div<?php echo $Payment_Refund->payment_request_payment_request_id->ViewAttributes() ?>><?php echo $Payment_Refund->payment_request_payment_request_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($Payment_Refund->bankname->Visible) { // bankname ?>
		<td<?php echo $Payment_Refund->bankname->CellAttributes() ?>>
<div<?php echo $Payment_Refund->bankname->ViewAttributes() ?>><?php echo $Payment_Refund->bankname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($Payment_Refund->account_no->Visible) { // account_no ?>
		<td<?php echo $Payment_Refund->account_no->CellAttributes() ?>>
<div<?php echo $Payment_Refund->account_no->ViewAttributes() ?>><?php echo $Payment_Refund->account_no->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($Payment_Refund->schools_school_id->Visible) { // schools_school_id ?>
		<td<?php echo $Payment_Refund->schools_school_id->CellAttributes() ?>>
<div<?php echo $Payment_Refund->schools_school_id->ViewAttributes() ?>><?php echo $Payment_Refund->schools_school_id->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Payment_Refund_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($Payment_Refund->CurrentAction <> "gridadd")
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
<?php if ($Payment_Refund->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($Payment_Refund->CurrentAction <> "gridadd" && $Payment_Refund->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($Payment_Refund_list->Pager)) $Payment_Refund_list->Pager = new cPrevNextPager($Payment_Refund_list->lStartRec, $Payment_Refund_list->lDisplayRecs, $Payment_Refund_list->lTotalRecs) ?>
<?php if ($Payment_Refund_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Payment_Refund_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $Payment_Refund_list->PageUrl() ?>start=<?php echo $Payment_Refund_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Payment_Refund_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $Payment_Refund_list->PageUrl() ?>start=<?php echo $Payment_Refund_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $Payment_Refund_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Payment_Refund_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $Payment_Refund_list->PageUrl() ?>start=<?php echo $Payment_Refund_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Payment_Refund_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $Payment_Refund_list->PageUrl() ?>start=<?php echo $Payment_Refund_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $Payment_Refund_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $Payment_Refund_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $Payment_Refund_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $Payment_Refund_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($Payment_Refund_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($Payment_Refund_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($Payment_Refund->Export == "" && $Payment_Refund->CurrentAction == "") { ?>
<?php } ?>
<?php if ($Payment_Refund->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$Payment_Refund_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cPayment_Refund_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'Payment Refund';

	// Page object name
	var $PageObjName = 'Payment_Refund_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $Payment_Refund;
		if ($Payment_Refund->UseTokenInUrl) $PageUrl .= "t=" . $Payment_Refund->TableVar . "&"; // Add page token
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
		global $objForm, $Payment_Refund;
		if ($Payment_Refund->UseTokenInUrl) {
			if ($objForm)
				return ($Payment_Refund->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($Payment_Refund->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cPayment_Refund_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (Payment_Refund)
		$GLOBALS["Payment_Refund"] = new cPayment_Refund();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["Payment_Refund"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "Payment_Refunddelete.php";
		$this->MultiUpdateUrl = "Payment_Refundupdate.php";

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
			define("EW_TABLE_NAME", 'Payment Refund', TRUE);

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
		global $Payment_Refund;

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
			$Payment_Refund->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$Payment_Refund->Export = $_POST["exporttype"];
		} else {
			$Payment_Refund->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $Payment_Refund->Export; // Get export parameter, used in header
		$gsExportFile = $Payment_Refund->TableVar; // Get export file, used in header
		if ($Payment_Refund->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($Payment_Refund->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $Payment_Refund;

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
			$Payment_Refund->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($Payment_Refund->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $Payment_Refund->getRecordsPerPage(); // Restore from Session
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
		$Payment_Refund->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$Payment_Refund->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$Payment_Refund->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $Payment_Refund->getSearchWhere();
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
		$Payment_Refund->setSessionWhere($sFilter);
		$Payment_Refund->CurrentFilter = "";

		// Export data only
		if (in_array($Payment_Refund->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($Payment_Refund->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $Payment_Refund;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $Payment_Refund->scholarship_payment_id, FALSE); // scholarship_payment_id
		$this->BuildSearchSql($sWhere, $Payment_Refund->date, FALSE); // date
		$this->BuildSearchSql($sWhere, $Payment_Refund->status, FALSE); // status
		$this->BuildSearchSql($sWhere, $Payment_Refund->refund_amount, FALSE); // refund_amount
		$this->BuildSearchSql($sWhere, $Payment_Refund->amount, FALSE); // amount
		$this->BuildSearchSql($sWhere, $Payment_Refund->memo, FALSE); // memo
		$this->BuildSearchSql($sWhere, $Payment_Refund->year, FALSE); // year
		$this->BuildSearchSql($sWhere, $Payment_Refund->scholarship_package_scholarship_package_id, FALSE); // scholarship_package_scholarship_package_id
		$this->BuildSearchSql($sWhere, $Payment_Refund->programarea_residentarea_id, FALSE); // programarea_residentarea_id
		$this->BuildSearchSql($sWhere, $Payment_Refund->programarea_payingarea_id, FALSE); // programarea_payingarea_id
		$this->BuildSearchSql($sWhere, $Payment_Refund->payment_request_payment_request_id, FALSE); // payment_request_payment_request_id
		$this->BuildSearchSql($sWhere, $Payment_Refund->bankname, FALSE); // bankname
		$this->BuildSearchSql($sWhere, $Payment_Refund->account_no, FALSE); // account_no
		$this->BuildSearchSql($sWhere, $Payment_Refund->schools_school_id, FALSE); // schools_school_id
		$this->BuildSearchSql($sWhere, $Payment_Refund->group_id, FALSE); // group_id

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($Payment_Refund->scholarship_payment_id); // scholarship_payment_id
			$this->SetSearchParm($Payment_Refund->date); // date
			$this->SetSearchParm($Payment_Refund->status); // status
			$this->SetSearchParm($Payment_Refund->refund_amount); // refund_amount
			$this->SetSearchParm($Payment_Refund->amount); // amount
			$this->SetSearchParm($Payment_Refund->memo); // memo
			$this->SetSearchParm($Payment_Refund->year); // year
			$this->SetSearchParm($Payment_Refund->scholarship_package_scholarship_package_id); // scholarship_package_scholarship_package_id
			$this->SetSearchParm($Payment_Refund->programarea_residentarea_id); // programarea_residentarea_id
			$this->SetSearchParm($Payment_Refund->programarea_payingarea_id); // programarea_payingarea_id
			$this->SetSearchParm($Payment_Refund->payment_request_payment_request_id); // payment_request_payment_request_id
			$this->SetSearchParm($Payment_Refund->bankname); // bankname
			$this->SetSearchParm($Payment_Refund->account_no); // account_no
			$this->SetSearchParm($Payment_Refund->schools_school_id); // schools_school_id
			$this->SetSearchParm($Payment_Refund->group_id); // group_id
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
		global $Payment_Refund;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$Payment_Refund->setAdvancedSearch("x_$FldParm", $FldVal);
		$Payment_Refund->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$Payment_Refund->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$Payment_Refund->setAdvancedSearch("y_$FldParm", $FldVal2);
		$Payment_Refund->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $Payment_Refund;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $Payment_Refund->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $Payment_Refund->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $Payment_Refund->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $Payment_Refund->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $Payment_Refund->GetAdvancedSearch("w_$FldParm");
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
		global $Payment_Refund;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$Payment_Refund->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $Payment_Refund;
		$Payment_Refund->setAdvancedSearch("x_scholarship_payment_id", "");
		$Payment_Refund->setAdvancedSearch("x_date", "");
		$Payment_Refund->setAdvancedSearch("x_status", "");
		$Payment_Refund->setAdvancedSearch("x_refund_amount", "");
		$Payment_Refund->setAdvancedSearch("x_amount", "");
		$Payment_Refund->setAdvancedSearch("x_memo", "");
		$Payment_Refund->setAdvancedSearch("x_year", "");
		$Payment_Refund->setAdvancedSearch("x_scholarship_package_scholarship_package_id", "");
		$Payment_Refund->setAdvancedSearch("x_programarea_residentarea_id", "");
		$Payment_Refund->setAdvancedSearch("x_programarea_payingarea_id", "");
		$Payment_Refund->setAdvancedSearch("x_payment_request_payment_request_id", "");
		$Payment_Refund->setAdvancedSearch("x_bankname", "");
		$Payment_Refund->setAdvancedSearch("x_account_no", "");
		$Payment_Refund->setAdvancedSearch("x_schools_school_id", "");
		$Payment_Refund->setAdvancedSearch("x_group_id", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $Payment_Refund;
		$bRestore = TRUE;
		if (@$_GET["x_scholarship_payment_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_status"] <> "") $bRestore = FALSE;
		if (@$_GET["x_refund_amount"] <> "") $bRestore = FALSE;
		if (@$_GET["x_amount"] <> "") $bRestore = FALSE;
		if (@$_GET["x_memo"] <> "") $bRestore = FALSE;
		if (@$_GET["x_year"] <> "") $bRestore = FALSE;
		if (@$_GET["x_scholarship_package_scholarship_package_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_programarea_residentarea_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_programarea_payingarea_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_payment_request_payment_request_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_bankname"] <> "") $bRestore = FALSE;
		if (@$_GET["x_account_no"] <> "") $bRestore = FALSE;
		if (@$_GET["x_schools_school_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_group_id"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($Payment_Refund->scholarship_payment_id);
			$this->GetSearchParm($Payment_Refund->date);
			$this->GetSearchParm($Payment_Refund->status);
			$this->GetSearchParm($Payment_Refund->refund_amount);
			$this->GetSearchParm($Payment_Refund->amount);
			$this->GetSearchParm($Payment_Refund->memo);
			$this->GetSearchParm($Payment_Refund->year);
			$this->GetSearchParm($Payment_Refund->scholarship_package_scholarship_package_id);
			$this->GetSearchParm($Payment_Refund->programarea_residentarea_id);
			$this->GetSearchParm($Payment_Refund->programarea_payingarea_id);
			$this->GetSearchParm($Payment_Refund->payment_request_payment_request_id);
			$this->GetSearchParm($Payment_Refund->bankname);
			$this->GetSearchParm($Payment_Refund->account_no);
			$this->GetSearchParm($Payment_Refund->schools_school_id);
			$this->GetSearchParm($Payment_Refund->group_id);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $Payment_Refund;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$Payment_Refund->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$Payment_Refund->CurrentOrderType = @$_GET["ordertype"];
			$Payment_Refund->UpdateSort($Payment_Refund->status); // status
			$Payment_Refund->UpdateSort($Payment_Refund->refund_amount); // refund_amount
			$Payment_Refund->UpdateSort($Payment_Refund->amount); // amount
			$Payment_Refund->UpdateSort($Payment_Refund->year); // year
			$Payment_Refund->UpdateSort($Payment_Refund->scholarship_package_scholarship_package_id); // scholarship_package_scholarship_package_id
			$Payment_Refund->UpdateSort($Payment_Refund->programarea_payingarea_id); // programarea_payingarea_id
			$Payment_Refund->UpdateSort($Payment_Refund->payment_request_payment_request_id); // payment_request_payment_request_id
			$Payment_Refund->UpdateSort($Payment_Refund->bankname); // bankname
			$Payment_Refund->UpdateSort($Payment_Refund->account_no); // account_no
			$Payment_Refund->UpdateSort($Payment_Refund->schools_school_id); // schools_school_id
			$Payment_Refund->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $Payment_Refund;
		$sOrderBy = $Payment_Refund->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($Payment_Refund->SqlOrderBy() <> "") {
				$sOrderBy = $Payment_Refund->SqlOrderBy();
				$Payment_Refund->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $Payment_Refund;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$Payment_Refund->setSessionOrderBy($sOrderBy);
				$Payment_Refund->status->setSort("");
				$Payment_Refund->refund_amount->setSort("");
				$Payment_Refund->amount->setSort("");
				$Payment_Refund->year->setSort("");
				$Payment_Refund->scholarship_package_scholarship_package_id->setSort("");
				$Payment_Refund->programarea_payingarea_id->setSort("");
				$Payment_Refund->payment_request_payment_request_id->setSort("");
				$Payment_Refund->bankname->setSort("");
				$Payment_Refund->account_no->setSort("");
				$Payment_Refund->schools_school_id->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$Payment_Refund->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Payment_Refund;

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

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($Payment_Refund->Export <> "" ||
			$Payment_Refund->CurrentAction == "gridadd" ||
			$Payment_Refund->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $Payment_Refund;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $this->ShowOptionLink() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $this->ShowOptionLink() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $Payment_Refund;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $Payment_Refund;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$Payment_Refund->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$Payment_Refund->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $Payment_Refund->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$Payment_Refund->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$Payment_Refund->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$Payment_Refund->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $Payment_Refund;

		// Load search values
		// scholarship_payment_id

		$Payment_Refund->scholarship_payment_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_scholarship_payment_id"]);
		$Payment_Refund->scholarship_payment_id->AdvancedSearch->SearchOperator = @$_GET["z_scholarship_payment_id"];

		// date
		$Payment_Refund->date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_date"]);
		$Payment_Refund->date->AdvancedSearch->SearchOperator = @$_GET["z_date"];

		// status
		$Payment_Refund->status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_status"]);
		$Payment_Refund->status->AdvancedSearch->SearchOperator = @$_GET["z_status"];

		// refund_amount
		$Payment_Refund->refund_amount->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_refund_amount"]);
		$Payment_Refund->refund_amount->AdvancedSearch->SearchOperator = @$_GET["z_refund_amount"];

		// amount
		$Payment_Refund->amount->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_amount"]);
		$Payment_Refund->amount->AdvancedSearch->SearchOperator = @$_GET["z_amount"];

		// memo
		$Payment_Refund->memo->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_memo"]);
		$Payment_Refund->memo->AdvancedSearch->SearchOperator = @$_GET["z_memo"];

		// year
		$Payment_Refund->year->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_year"]);
		$Payment_Refund->year->AdvancedSearch->SearchOperator = @$_GET["z_year"];

		// scholarship_package_scholarship_package_id
		$Payment_Refund->scholarship_package_scholarship_package_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_scholarship_package_scholarship_package_id"]);
		$Payment_Refund->scholarship_package_scholarship_package_id->AdvancedSearch->SearchOperator = @$_GET["z_scholarship_package_scholarship_package_id"];

		// programarea_residentarea_id
		$Payment_Refund->programarea_residentarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programarea_residentarea_id"]);
		$Payment_Refund->programarea_residentarea_id->AdvancedSearch->SearchOperator = @$_GET["z_programarea_residentarea_id"];

		// programarea_payingarea_id
		$Payment_Refund->programarea_payingarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programarea_payingarea_id"]);
		$Payment_Refund->programarea_payingarea_id->AdvancedSearch->SearchOperator = @$_GET["z_programarea_payingarea_id"];

		// payment_request_payment_request_id
		$Payment_Refund->payment_request_payment_request_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_payment_request_payment_request_id"]);
		$Payment_Refund->payment_request_payment_request_id->AdvancedSearch->SearchOperator = @$_GET["z_payment_request_payment_request_id"];

		// bankname
		$Payment_Refund->bankname->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_bankname"]);
		$Payment_Refund->bankname->AdvancedSearch->SearchOperator = @$_GET["z_bankname"];

		// account_no
		$Payment_Refund->account_no->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_account_no"]);
		$Payment_Refund->account_no->AdvancedSearch->SearchOperator = @$_GET["z_account_no"];

		// schools_school_id
		$Payment_Refund->schools_school_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_schools_school_id"]);
		$Payment_Refund->schools_school_id->AdvancedSearch->SearchOperator = @$_GET["z_schools_school_id"];

		// group_id
		$Payment_Refund->group_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_group_id"]);
		$Payment_Refund->group_id->AdvancedSearch->SearchOperator = @$_GET["z_group_id"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $Payment_Refund;

		// Call Recordset Selecting event
		$Payment_Refund->Recordset_Selecting($Payment_Refund->CurrentFilter);

		// Load List page SQL
		$sSql = $Payment_Refund->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$Payment_Refund->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $Payment_Refund;
		$sFilter = $Payment_Refund->KeyFilter();

		// Call Row Selecting event
		$Payment_Refund->Row_Selecting($sFilter);

		// Load SQL based on filter
		$Payment_Refund->CurrentFilter = $sFilter;
		$sSql = $Payment_Refund->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$Payment_Refund->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $Payment_Refund;
		$Payment_Refund->scholarship_payment_id->setDbValue($rs->fields('scholarship_payment_id'));
		$Payment_Refund->date->setDbValue($rs->fields('date'));
		$Payment_Refund->status->setDbValue($rs->fields('status'));
		$Payment_Refund->refund_amount->setDbValue($rs->fields('refund_amount'));
		$Payment_Refund->amount->setDbValue($rs->fields('amount'));
		$Payment_Refund->memo->setDbValue($rs->fields('memo'));
		$Payment_Refund->year->setDbValue($rs->fields('year'));
		$Payment_Refund->scholarship_package_scholarship_package_id->setDbValue($rs->fields('scholarship_package_scholarship_package_id'));
		$Payment_Refund->programarea_residentarea_id->setDbValue($rs->fields('programarea_residentarea_id'));
		$Payment_Refund->programarea_payingarea_id->setDbValue($rs->fields('programarea_payingarea_id'));
		$Payment_Refund->payment_request_payment_request_id->setDbValue($rs->fields('payment_request_payment_request_id'));
		$Payment_Refund->bankname->setDbValue($rs->fields('bankname'));
		$Payment_Refund->account_no->setDbValue($rs->fields('account_no'));
		$Payment_Refund->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$Payment_Refund->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $Payment_Refund;

		// Initialize URLs
		$this->ViewUrl = $Payment_Refund->ViewUrl();
		$this->EditUrl = $Payment_Refund->EditUrl();
		$this->InlineEditUrl = $Payment_Refund->InlineEditUrl();
		$this->CopyUrl = $Payment_Refund->CopyUrl();
		$this->InlineCopyUrl = $Payment_Refund->InlineCopyUrl();
		$this->DeleteUrl = $Payment_Refund->DeleteUrl();

		// Call Row_Rendering event
		$Payment_Refund->Row_Rendering();

		// Common render codes for all row types
		// status

		$Payment_Refund->status->CellCssStyle = ""; $Payment_Refund->status->CellCssClass = "";
		$Payment_Refund->status->CellAttrs = array(); $Payment_Refund->status->ViewAttrs = array(); $Payment_Refund->status->EditAttrs = array();

		// refund_amount
		$Payment_Refund->refund_amount->CellCssStyle = ""; $Payment_Refund->refund_amount->CellCssClass = "";
		$Payment_Refund->refund_amount->CellAttrs = array(); $Payment_Refund->refund_amount->ViewAttrs = array(); $Payment_Refund->refund_amount->EditAttrs = array();

		// amount
		$Payment_Refund->amount->CellCssStyle = ""; $Payment_Refund->amount->CellCssClass = "";
		$Payment_Refund->amount->CellAttrs = array(); $Payment_Refund->amount->ViewAttrs = array(); $Payment_Refund->amount->EditAttrs = array();

		// year
		$Payment_Refund->year->CellCssStyle = ""; $Payment_Refund->year->CellCssClass = "";
		$Payment_Refund->year->CellAttrs = array(); $Payment_Refund->year->ViewAttrs = array(); $Payment_Refund->year->EditAttrs = array();

		// scholarship_package_scholarship_package_id
		$Payment_Refund->scholarship_package_scholarship_package_id->CellCssStyle = ""; $Payment_Refund->scholarship_package_scholarship_package_id->CellCssClass = "";
		$Payment_Refund->scholarship_package_scholarship_package_id->CellAttrs = array(); $Payment_Refund->scholarship_package_scholarship_package_id->ViewAttrs = array(); $Payment_Refund->scholarship_package_scholarship_package_id->EditAttrs = array();

		// programarea_payingarea_id
		$Payment_Refund->programarea_payingarea_id->CellCssStyle = ""; $Payment_Refund->programarea_payingarea_id->CellCssClass = "";
		$Payment_Refund->programarea_payingarea_id->CellAttrs = array(); $Payment_Refund->programarea_payingarea_id->ViewAttrs = array(); $Payment_Refund->programarea_payingarea_id->EditAttrs = array();

		// payment_request_payment_request_id
		$Payment_Refund->payment_request_payment_request_id->CellCssStyle = ""; $Payment_Refund->payment_request_payment_request_id->CellCssClass = "";
		$Payment_Refund->payment_request_payment_request_id->CellAttrs = array(); $Payment_Refund->payment_request_payment_request_id->ViewAttrs = array(); $Payment_Refund->payment_request_payment_request_id->EditAttrs = array();

		// bankname
		$Payment_Refund->bankname->CellCssStyle = ""; $Payment_Refund->bankname->CellCssClass = "";
		$Payment_Refund->bankname->CellAttrs = array(); $Payment_Refund->bankname->ViewAttrs = array(); $Payment_Refund->bankname->EditAttrs = array();

		// account_no
		$Payment_Refund->account_no->CellCssStyle = ""; $Payment_Refund->account_no->CellCssClass = "";
		$Payment_Refund->account_no->CellAttrs = array(); $Payment_Refund->account_no->ViewAttrs = array(); $Payment_Refund->account_no->EditAttrs = array();

		// schools_school_id
		$Payment_Refund->schools_school_id->CellCssStyle = ""; $Payment_Refund->schools_school_id->CellCssClass = "";
		$Payment_Refund->schools_school_id->CellAttrs = array(); $Payment_Refund->schools_school_id->ViewAttrs = array(); $Payment_Refund->schools_school_id->EditAttrs = array();
		if ($Payment_Refund->RowType == EW_ROWTYPE_VIEW) { // View row

			// scholarship_payment_id
			$Payment_Refund->scholarship_payment_id->ViewValue = $Payment_Refund->scholarship_payment_id->CurrentValue;
			$Payment_Refund->scholarship_payment_id->CssStyle = "";
			$Payment_Refund->scholarship_payment_id->CssClass = "";
			$Payment_Refund->scholarship_payment_id->ViewCustomAttributes = "";

			// date
			$Payment_Refund->date->ViewValue = $Payment_Refund->date->CurrentValue;
			$Payment_Refund->date->ViewValue = ew_FormatDateTime($Payment_Refund->date->ViewValue, 7);
			$Payment_Refund->date->CssStyle = "";
			$Payment_Refund->date->CssClass = "";
			$Payment_Refund->date->ViewCustomAttributes = "";

			// status
			if (strval($Payment_Refund->status->CurrentValue) <> "") {
				switch ($Payment_Refund->status->CurrentValue) {
					case "PENDING":
						$Payment_Refund->status->ViewValue = "PENDING";
						break;
					case "PAID":
						$Payment_Refund->status->ViewValue = "PAID";
						break;
					default:
						$Payment_Refund->status->ViewValue = $Payment_Refund->status->CurrentValue;
				}
			} else {
				$Payment_Refund->status->ViewValue = NULL;
			}
			$Payment_Refund->status->CssStyle = "";
			$Payment_Refund->status->CssClass = "";
			$Payment_Refund->status->ViewCustomAttributes = "";

			// refund_amount
			$Payment_Refund->refund_amount->ViewValue = $Payment_Refund->refund_amount->CurrentValue;
			$Payment_Refund->refund_amount->CssStyle = "";
			$Payment_Refund->refund_amount->CssClass = "";
			$Payment_Refund->refund_amount->ViewCustomAttributes = "";

			// amount
			$Payment_Refund->amount->ViewValue = $Payment_Refund->amount->CurrentValue;
			$Payment_Refund->amount->CssStyle = "";
			$Payment_Refund->amount->CssClass = "";
			$Payment_Refund->amount->ViewCustomAttributes = "";

			// year
			$Payment_Refund->year->ViewValue = $Payment_Refund->year->CurrentValue;
			$Payment_Refund->year->CssStyle = "";
			$Payment_Refund->year->CssClass = "";
			$Payment_Refund->year->ViewCustomAttributes = "";

			// scholarship_package_scholarship_package_id
			if (strval($Payment_Refund->scholarship_package_scholarship_package_id->CurrentValue) <> "") {
				$sFilterWrk = "`scholarship_package_id` = " . ew_AdjustSql($Payment_Refund->scholarship_package_scholarship_package_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `scholarship_type` FROM `scholarship_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->scholarship_package_scholarship_package_id->ViewValue = $rswrk->fields('scholarship_type');
					$rswrk->Close();
				} else {
					$Payment_Refund->scholarship_package_scholarship_package_id->ViewValue = $Payment_Refund->scholarship_package_scholarship_package_id->CurrentValue;
				}
			} else {
				$Payment_Refund->scholarship_package_scholarship_package_id->ViewValue = NULL;
			}
			$Payment_Refund->scholarship_package_scholarship_package_id->CssStyle = "";
			$Payment_Refund->scholarship_package_scholarship_package_id->CssClass = "";
			$Payment_Refund->scholarship_package_scholarship_package_id->ViewCustomAttributes = "";

			// programarea_residentarea_id
			if (strval($Payment_Refund->programarea_residentarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Payment_Refund->programarea_residentarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->programarea_residentarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Payment_Refund->programarea_residentarea_id->ViewValue = $Payment_Refund->programarea_residentarea_id->CurrentValue;
				}
			} else {
				$Payment_Refund->programarea_residentarea_id->ViewValue = NULL;
			}
			$Payment_Refund->programarea_residentarea_id->CssStyle = "";
			$Payment_Refund->programarea_residentarea_id->CssClass = "";
			$Payment_Refund->programarea_residentarea_id->ViewCustomAttributes = "";

			// programarea_payingarea_id
			if (strval($Payment_Refund->programarea_payingarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Payment_Refund->programarea_payingarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->programarea_payingarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Payment_Refund->programarea_payingarea_id->ViewValue = $Payment_Refund->programarea_payingarea_id->CurrentValue;
				}
			} else {
				$Payment_Refund->programarea_payingarea_id->ViewValue = NULL;
			}
			$Payment_Refund->programarea_payingarea_id->CssStyle = "";
			$Payment_Refund->programarea_payingarea_id->CssClass = "";
			$Payment_Refund->programarea_payingarea_id->ViewCustomAttributes = "";

			// payment_request_payment_request_id
			if (strval($Payment_Refund->payment_request_payment_request_id->CurrentValue) <> "") {
				$sFilterWrk = "`payment_request_id` = " . ew_AdjustSql($Payment_Refund->payment_request_payment_request_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `code` FROM `payment_request`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->payment_request_payment_request_id->ViewValue = $rswrk->fields('code');
					$rswrk->Close();
				} else {
					$Payment_Refund->payment_request_payment_request_id->ViewValue = $Payment_Refund->payment_request_payment_request_id->CurrentValue;
				}
			} else {
				$Payment_Refund->payment_request_payment_request_id->ViewValue = NULL;
			}
			$Payment_Refund->payment_request_payment_request_id->CssStyle = "";
			$Payment_Refund->payment_request_payment_request_id->CssClass = "";
			$Payment_Refund->payment_request_payment_request_id->ViewCustomAttributes = "";

			// bankname
			$Payment_Refund->bankname->ViewValue = $Payment_Refund->bankname->CurrentValue;
			$Payment_Refund->bankname->CssStyle = "";
			$Payment_Refund->bankname->CssClass = "";
			$Payment_Refund->bankname->ViewCustomAttributes = "";

			// account_no
			$Payment_Refund->account_no->ViewValue = $Payment_Refund->account_no->CurrentValue;
			$Payment_Refund->account_no->CssStyle = "";
			$Payment_Refund->account_no->CssClass = "";
			$Payment_Refund->account_no->ViewCustomAttributes = "";

			// schools_school_id
			if (strval($Payment_Refund->schools_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($Payment_Refund->schools_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->schools_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$Payment_Refund->schools_school_id->ViewValue = $Payment_Refund->schools_school_id->CurrentValue;
				}
			} else {
				$Payment_Refund->schools_school_id->ViewValue = NULL;
			}
			$Payment_Refund->schools_school_id->CssStyle = "";
			$Payment_Refund->schools_school_id->CssClass = "";
			$Payment_Refund->schools_school_id->ViewCustomAttributes = "";

			// group_id
			$Payment_Refund->group_id->ViewValue = $Payment_Refund->group_id->CurrentValue;
			$Payment_Refund->group_id->CssStyle = "";
			$Payment_Refund->group_id->CssClass = "";
			$Payment_Refund->group_id->ViewCustomAttributes = "";

			// status
			$Payment_Refund->status->HrefValue = "";
			$Payment_Refund->status->TooltipValue = "";

			// refund_amount
			$Payment_Refund->refund_amount->HrefValue = "";
			$Payment_Refund->refund_amount->TooltipValue = "";

			// amount
			$Payment_Refund->amount->HrefValue = "";
			$Payment_Refund->amount->TooltipValue = "";

			// year
			$Payment_Refund->year->HrefValue = "";
			$Payment_Refund->year->TooltipValue = "";

			// scholarship_package_scholarship_package_id
			$Payment_Refund->scholarship_package_scholarship_package_id->HrefValue = "";
			$Payment_Refund->scholarship_package_scholarship_package_id->TooltipValue = "";

			// programarea_payingarea_id
			$Payment_Refund->programarea_payingarea_id->HrefValue = "";
			$Payment_Refund->programarea_payingarea_id->TooltipValue = "";

			// payment_request_payment_request_id
			$Payment_Refund->payment_request_payment_request_id->HrefValue = "";
			$Payment_Refund->payment_request_payment_request_id->TooltipValue = "";

			// bankname
			$Payment_Refund->bankname->HrefValue = "";
			$Payment_Refund->bankname->TooltipValue = "";

			// account_no
			$Payment_Refund->account_no->HrefValue = "";
			$Payment_Refund->account_no->TooltipValue = "";

			// schools_school_id
			$Payment_Refund->schools_school_id->HrefValue = "";
			$Payment_Refund->schools_school_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($Payment_Refund->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$Payment_Refund->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $Payment_Refund;

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
		global $Payment_Refund;
		$Payment_Refund->scholarship_payment_id->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_scholarship_payment_id");
		$Payment_Refund->date->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_date");
		$Payment_Refund->status->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_status");
		$Payment_Refund->refund_amount->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_refund_amount");
		$Payment_Refund->amount->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_amount");
		$Payment_Refund->memo->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_memo");
		$Payment_Refund->year->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_year");
		$Payment_Refund->scholarship_package_scholarship_package_id->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_scholarship_package_scholarship_package_id");
		$Payment_Refund->programarea_residentarea_id->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_programarea_residentarea_id");
		$Payment_Refund->programarea_payingarea_id->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_programarea_payingarea_id");
		$Payment_Refund->payment_request_payment_request_id->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_payment_request_payment_request_id");
		$Payment_Refund->bankname->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_bankname");
		$Payment_Refund->account_no->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_account_no");
		$Payment_Refund->schools_school_id->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_schools_school_id");
		$Payment_Refund->group_id->AdvancedSearch->SearchValue = $Payment_Refund->getAdvancedSearch("x_group_id");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $Payment_Refund;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $Payment_Refund->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($Payment_Refund->ExportAll) {
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
		if ($Payment_Refund->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($Payment_Refund, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($Payment_Refund->scholarship_payment_id);
				$ExportDoc->ExportCaption($Payment_Refund->date);
				$ExportDoc->ExportCaption($Payment_Refund->status);
				$ExportDoc->ExportCaption($Payment_Refund->refund_amount);
				$ExportDoc->ExportCaption($Payment_Refund->amount);
				$ExportDoc->ExportCaption($Payment_Refund->year);
				$ExportDoc->ExportCaption($Payment_Refund->scholarship_package_scholarship_package_id);
				$ExportDoc->ExportCaption($Payment_Refund->programarea_residentarea_id);
				$ExportDoc->ExportCaption($Payment_Refund->programarea_payingarea_id);
				$ExportDoc->ExportCaption($Payment_Refund->payment_request_payment_request_id);
				$ExportDoc->ExportCaption($Payment_Refund->bankname);
				$ExportDoc->ExportCaption($Payment_Refund->account_no);
				$ExportDoc->ExportCaption($Payment_Refund->schools_school_id);
				$ExportDoc->ExportCaption($Payment_Refund->group_id);
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
				$Payment_Refund->CssClass = "";
				$Payment_Refund->CssStyle = "";
				$Payment_Refund->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($Payment_Refund->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('scholarship_payment_id', $Payment_Refund->scholarship_payment_id->ExportValue($Payment_Refund->Export, $Payment_Refund->ExportOriginalValue));
					$XmlDoc->AddField('date', $Payment_Refund->date->ExportValue($Payment_Refund->Export, $Payment_Refund->ExportOriginalValue));
					$XmlDoc->AddField('status', $Payment_Refund->status->ExportValue($Payment_Refund->Export, $Payment_Refund->ExportOriginalValue));
					$XmlDoc->AddField('refund_amount', $Payment_Refund->refund_amount->ExportValue($Payment_Refund->Export, $Payment_Refund->ExportOriginalValue));
					$XmlDoc->AddField('amount', $Payment_Refund->amount->ExportValue($Payment_Refund->Export, $Payment_Refund->ExportOriginalValue));
					$XmlDoc->AddField('year', $Payment_Refund->year->ExportValue($Payment_Refund->Export, $Payment_Refund->ExportOriginalValue));
					$XmlDoc->AddField('scholarship_package_scholarship_package_id', $Payment_Refund->scholarship_package_scholarship_package_id->ExportValue($Payment_Refund->Export, $Payment_Refund->ExportOriginalValue));
					$XmlDoc->AddField('programarea_residentarea_id', $Payment_Refund->programarea_residentarea_id->ExportValue($Payment_Refund->Export, $Payment_Refund->ExportOriginalValue));
					$XmlDoc->AddField('programarea_payingarea_id', $Payment_Refund->programarea_payingarea_id->ExportValue($Payment_Refund->Export, $Payment_Refund->ExportOriginalValue));
					$XmlDoc->AddField('payment_request_payment_request_id', $Payment_Refund->payment_request_payment_request_id->ExportValue($Payment_Refund->Export, $Payment_Refund->ExportOriginalValue));
					$XmlDoc->AddField('bankname', $Payment_Refund->bankname->ExportValue($Payment_Refund->Export, $Payment_Refund->ExportOriginalValue));
					$XmlDoc->AddField('account_no', $Payment_Refund->account_no->ExportValue($Payment_Refund->Export, $Payment_Refund->ExportOriginalValue));
					$XmlDoc->AddField('schools_school_id', $Payment_Refund->schools_school_id->ExportValue($Payment_Refund->Export, $Payment_Refund->ExportOriginalValue));
					$XmlDoc->AddField('group_id', $Payment_Refund->group_id->ExportValue($Payment_Refund->Export, $Payment_Refund->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($Payment_Refund->scholarship_payment_id);
					$ExportDoc->ExportField($Payment_Refund->date);
					$ExportDoc->ExportField($Payment_Refund->status);
					$ExportDoc->ExportField($Payment_Refund->refund_amount);
					$ExportDoc->ExportField($Payment_Refund->amount);
					$ExportDoc->ExportField($Payment_Refund->year);
					$ExportDoc->ExportField($Payment_Refund->scholarship_package_scholarship_package_id);
					$ExportDoc->ExportField($Payment_Refund->programarea_residentarea_id);
					$ExportDoc->ExportField($Payment_Refund->programarea_payingarea_id);
					$ExportDoc->ExportField($Payment_Refund->payment_request_payment_request_id);
					$ExportDoc->ExportField($Payment_Refund->bankname);
					$ExportDoc->ExportField($Payment_Refund->account_no);
					$ExportDoc->ExportField($Payment_Refund->schools_school_id);
					$ExportDoc->ExportField($Payment_Refund->group_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($Payment_Refund->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($Payment_Refund->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($Payment_Refund->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($Payment_Refund->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($Payment_Refund->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $Payment_Refund;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($Payment_Refund->group_id->CurrentValue);
			}
		}
		return TRUE;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'Payment Refund';
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
