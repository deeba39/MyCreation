<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "Disburse_Paymentsinfo.php" ?>
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
$Disburse_Payments_list = new cDisburse_Payments_list();
$Page =& $Disburse_Payments_list;

// Page init
$Disburse_Payments_list->Page_Init();

// Page main
$Disburse_Payments_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($Disburse_Payments->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var Disburse_Payments_list = new ew_Page("Disburse_Payments_list");

// page properties
Disburse_Payments_list.PageID = "list"; // page ID
Disburse_Payments_list.FormID = "fDisburse_Paymentslist"; // form ID
var EW_PAGE_ID = Disburse_Payments_list.PageID; // for backward compatibility

// extend page with ValidateForm function
Disburse_Payments_list.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_financial_year_financial_year_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Disburse_Payments->financial_year_financial_year_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_amount"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Disburse_Payments->amount->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
Disburse_Payments_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
Disburse_Payments_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Disburse_Payments_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($Disburse_Payments->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$Disburse_Payments_list->lTotalRecs = $Disburse_Payments->SelectRecordCount();
	} else {
		if ($rs = $Disburse_Payments_list->LoadRecordset())
			$Disburse_Payments_list->lTotalRecs = $rs->RecordCount();
	}
	$Disburse_Payments_list->lStartRec = 1;
	if ($Disburse_Payments_list->lDisplayRecs <= 0 || ($Disburse_Payments->Export <> "" && $Disburse_Payments->ExportAll)) // Display all records
		$Disburse_Payments_list->lDisplayRecs = $Disburse_Payments_list->lTotalRecs;
	if (!($Disburse_Payments->Export <> "" && $Disburse_Payments->ExportAll))
		$Disburse_Payments_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $Disburse_Payments_list->LoadRecordset($Disburse_Payments_list->lStartRec-1, $Disburse_Payments_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $Disburse_Payments->TableCaption() ?>
<?php if ($Disburse_Payments->Export == "" && $Disburse_Payments->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Disburse_Payments_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Disburse_Payments_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Disburse_Payments_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($Disburse_Payments->Export == "" && $Disburse_Payments->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(Disburse_Payments_list);" style="text-decoration: none;"><img id="Disburse_Payments_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="Disburse_Payments_list_SearchPanel">
<form name="fDisburse_Paymentslistsrch" id="fDisburse_Paymentslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="Disburse_Payments">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $Disburse_Payments_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="Disburse_Paymentssrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
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
$Disburse_Payments_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fDisburse_Paymentslist" id="fDisburse_Paymentslist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="Disburse_Payments">
<div id="gmp_Disburse_Payments" class="ewGridMiddlePanel">
<?php if ($Disburse_Payments_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $Disburse_Payments->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$Disburse_Payments_list->RenderListOptions();

// Render list options (header, left)
$Disburse_Payments_list->ListOptions->Render("header", "left");
?>
<?php if ($Disburse_Payments->payment_request_id->Visible) { // payment_request_id ?>
	<?php if ($Disburse_Payments->SortUrl($Disburse_Payments->payment_request_id) == "") { ?>
		<td><?php echo $Disburse_Payments->payment_request_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Disburse_Payments->SortUrl($Disburse_Payments->payment_request_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Disburse_Payments->payment_request_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($Disburse_Payments->payment_request_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Disburse_Payments->payment_request_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Disburse_Payments->code->Visible) { // code ?>
	<?php if ($Disburse_Payments->SortUrl($Disburse_Payments->code) == "") { ?>
		<td><?php echo $Disburse_Payments->code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Disburse_Payments->SortUrl($Disburse_Payments->code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Disburse_Payments->code->FldCaption() ?></td><td style="width: 10px;"><?php if ($Disburse_Payments->code->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Disburse_Payments->code->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Disburse_Payments->programarea_id->Visible) { // programarea_id ?>
	<?php if ($Disburse_Payments->SortUrl($Disburse_Payments->programarea_id) == "") { ?>
		<td><?php echo $Disburse_Payments->programarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Disburse_Payments->SortUrl($Disburse_Payments->programarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Disburse_Payments->programarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($Disburse_Payments->programarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Disburse_Payments->programarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Disburse_Payments->year->Visible) { // year ?>
	<?php if ($Disburse_Payments->SortUrl($Disburse_Payments->year) == "") { ?>
		<td><?php echo $Disburse_Payments->year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Disburse_Payments->SortUrl($Disburse_Payments->year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Disburse_Payments->year->FldCaption() ?></td><td style="width: 10px;"><?php if ($Disburse_Payments->year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Disburse_Payments->year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Disburse_Payments->request_date->Visible) { // request_date ?>
	<?php if ($Disburse_Payments->SortUrl($Disburse_Payments->request_date) == "") { ?>
		<td><?php echo $Disburse_Payments->request_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Disburse_Payments->SortUrl($Disburse_Payments->request_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Disburse_Payments->request_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($Disburse_Payments->request_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Disburse_Payments->request_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Disburse_Payments->request_status->Visible) { // request_status ?>
	<?php if ($Disburse_Payments->SortUrl($Disburse_Payments->request_status) == "") { ?>
		<td><?php echo $Disburse_Payments->request_status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Disburse_Payments->SortUrl($Disburse_Payments->request_status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Disburse_Payments->request_status->FldCaption() ?></td><td style="width: 10px;"><?php if ($Disburse_Payments->request_status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Disburse_Payments->request_status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Disburse_Payments->financial_year_financial_year_id->Visible) { // financial_year_financial_year_id ?>
	<?php if ($Disburse_Payments->SortUrl($Disburse_Payments->financial_year_financial_year_id) == "") { ?>
		<td><?php echo $Disburse_Payments->financial_year_financial_year_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Disburse_Payments->SortUrl($Disburse_Payments->financial_year_financial_year_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Disburse_Payments->financial_year_financial_year_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($Disburse_Payments->financial_year_financial_year_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Disburse_Payments->financial_year_financial_year_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Disburse_Payments->amount->Visible) { // amount ?>
	<?php if ($Disburse_Payments->SortUrl($Disburse_Payments->amount) == "") { ?>
		<td><?php echo $Disburse_Payments->amount->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Disburse_Payments->SortUrl($Disburse_Payments->amount) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Disburse_Payments->amount->FldCaption() ?></td><td style="width: 10px;"><?php if ($Disburse_Payments->amount->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Disburse_Payments->amount->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$Disburse_Payments_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($Disburse_Payments->ExportAll && $Disburse_Payments->Export <> "") {
	$Disburse_Payments_list->lStopRec = $Disburse_Payments_list->lTotalRecs;
} else {
	$Disburse_Payments_list->lStopRec = $Disburse_Payments_list->lStartRec + $Disburse_Payments_list->lDisplayRecs - 1; // Set the last record to display
}
$Disburse_Payments_list->lRecCount = $Disburse_Payments_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $Disburse_Payments_list->lStartRec > 1)
		$rs->Move($Disburse_Payments_list->lStartRec - 1);
}

// Initialize aggregate
$Disburse_Payments->RowType = EW_ROWTYPE_AGGREGATEINIT;
$Disburse_Payments_list->RenderRow();
$Disburse_Payments_list->lRowCnt = 0;
if ($Disburse_Payments->CurrentAction == "gridedit")
	$Disburse_Payments_list->lRowIndex = 0;
while (($Disburse_Payments->CurrentAction == "gridadd" || !$rs->EOF) &&
	$Disburse_Payments_list->lRecCount < $Disburse_Payments_list->lStopRec) {
	$Disburse_Payments_list->lRecCount++;
	if (intval($Disburse_Payments_list->lRecCount) >= intval($Disburse_Payments_list->lStartRec)) {
		$Disburse_Payments_list->lRowCnt++;
		if ($Disburse_Payments->CurrentAction == "gridadd" || $Disburse_Payments->CurrentAction == "gridedit")
			$Disburse_Payments_list->lRowIndex++;

	// Init row class and style
	$Disburse_Payments->CssClass = "";
	$Disburse_Payments->CssStyle = "";
	$Disburse_Payments->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($Disburse_Payments->CurrentAction == "gridadd") {
		$Disburse_Payments_list->LoadDefaultValues(); // Load default values
	} else {
		$Disburse_Payments_list->LoadRowValues($rs); // Load row values
	}
	$Disburse_Payments->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($Disburse_Payments->CurrentAction == "gridedit") { // Grid edit
		$Disburse_Payments->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($Disburse_Payments->RowType == EW_ROWTYPE_EDIT && $Disburse_Payments->EventCancelled) { // Update failed
		if ($Disburse_Payments->CurrentAction == "gridedit")
			$Disburse_Payments_list->RestoreCurrentRowFormValues($Disburse_Payments_list->lRowIndex); // Restore form values
	}
	if ($Disburse_Payments->RowType == EW_ROWTYPE_EDIT) // Edit row
		$Disburse_Payments_list->lEditRowCnt++;
	if ($Disburse_Payments->RowType == EW_ROWTYPE_ADD || $Disburse_Payments->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
		$Disburse_Payments->RowAttrs = array_merge($Disburse_Payments->RowAttrs, array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);'));
		$Disburse_Payments->CssClass = "ewTableEditRow";
	}

	// Render row
	$Disburse_Payments_list->RenderRow();

	// Render list options
	$Disburse_Payments_list->RenderListOptions();
?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
<?php

// Render list options (body, left)
$Disburse_Payments_list->ListOptions->Render("body", "left");
?>
	<?php if ($Disburse_Payments->payment_request_id->Visible) { // payment_request_id ?>
		<td<?php echo $Disburse_Payments->payment_request_id->CellAttributes() ?>>
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $Disburse_Payments->payment_request_id->ViewAttributes() ?>><?php echo $Disburse_Payments->payment_request_id->EditValue ?></div><input type="hidden" name="x<?php echo $Disburse_Payments_list->lRowIndex ?>_payment_request_id" id="x<?php echo $Disburse_Payments_list->lRowIndex ?>_payment_request_id" value="<?php echo ew_HtmlEncode($Disburse_Payments->payment_request_id->CurrentValue) ?>">
<?php } ?>
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $Disburse_Payments->payment_request_id->ViewAttributes() ?>><?php echo $Disburse_Payments->payment_request_id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Disburse_Payments->code->Visible) { // code ?>
		<td<?php echo $Disburse_Payments->code->CellAttributes() ?>>
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $Disburse_Payments_list->lRowIndex ?>_code" id="x<?php echo $Disburse_Payments_list->lRowIndex ?>_code" title="<?php echo $Disburse_Payments->code->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $Disburse_Payments->code->EditValue ?>"<?php echo $Disburse_Payments->code->EditAttributes() ?>>
<?php } ?>
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $Disburse_Payments->code->ViewAttributes() ?>><?php echo $Disburse_Payments->code->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Disburse_Payments->programarea_id->Visible) { // programarea_id ?>
		<td<?php echo $Disburse_Payments->programarea_id->CellAttributes() ?>>
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $Disburse_Payments->programarea_id->ViewAttributes() ?>><?php echo $Disburse_Payments->programarea_id->EditValue ?></div><input type="hidden" name="x<?php echo $Disburse_Payments_list->lRowIndex ?>_programarea_id" id="x<?php echo $Disburse_Payments_list->lRowIndex ?>_programarea_id" value="<?php echo ew_HtmlEncode($Disburse_Payments->programarea_id->CurrentValue) ?>">
<?php } ?>
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $Disburse_Payments->programarea_id->ViewAttributes() ?>><?php echo $Disburse_Payments->programarea_id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Disburse_Payments->year->Visible) { // year ?>
		<td<?php echo $Disburse_Payments->year->CellAttributes() ?>>
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $Disburse_Payments->year->ViewAttributes() ?>><?php echo $Disburse_Payments->year->EditValue ?></div><input type="hidden" name="x<?php echo $Disburse_Payments_list->lRowIndex ?>_year" id="x<?php echo $Disburse_Payments_list->lRowIndex ?>_year" value="<?php echo ew_HtmlEncode($Disburse_Payments->year->CurrentValue) ?>">
<?php } ?>
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $Disburse_Payments->year->ViewAttributes() ?>><?php echo $Disburse_Payments->year->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Disburse_Payments->request_date->Visible) { // request_date ?>
		<td<?php echo $Disburse_Payments->request_date->CellAttributes() ?>>
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $Disburse_Payments->request_date->ViewAttributes() ?>><?php echo $Disburse_Payments->request_date->EditValue ?></div><input type="hidden" name="x<?php echo $Disburse_Payments_list->lRowIndex ?>_request_date" id="x<?php echo $Disburse_Payments_list->lRowIndex ?>_request_date" value="<?php echo ew_HtmlEncode($Disburse_Payments->request_date->CurrentValue) ?>">
<?php } ?>
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $Disburse_Payments->request_date->ViewAttributes() ?>><?php echo $Disburse_Payments->request_date->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Disburse_Payments->request_status->Visible) { // request_status ?>
		<td<?php echo $Disburse_Payments->request_status->CellAttributes() ?>>
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $Disburse_Payments_list->lRowIndex ?>_request_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x<?php echo $Disburse_Payments_list->lRowIndex ?>_request_status" id="x<?php echo $Disburse_Payments_list->lRowIndex ?>_request_status" title="<?php echo $Disburse_Payments->request_status->FldTitle() ?>" value="{value}"<?php echo $Disburse_Payments->request_status->EditAttributes() ?>></label></div>
<div id="dsl_x<?php echo $Disburse_Payments_list->lRowIndex ?>_request_status" repeatcolumn="5">
<?php
$arwrk = $Disburse_Payments->request_status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Disburse_Payments->request_status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $Disburse_Payments_list->lRowIndex ?>_request_status" id="x<?php echo $Disburse_Payments_list->lRowIndex ?>_request_status" title="<?php echo $Disburse_Payments->request_status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $Disburse_Payments->request_status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
<?php } ?>
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $Disburse_Payments->request_status->ViewAttributes() ?>><?php echo $Disburse_Payments->request_status->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Disburse_Payments->financial_year_financial_year_id->Visible) { // financial_year_financial_year_id ?>
		<td<?php echo $Disburse_Payments->financial_year_financial_year_id->CellAttributes() ?>>
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $Disburse_Payments_list->lRowIndex ?>_financial_year_financial_year_id" name="x<?php echo $Disburse_Payments_list->lRowIndex ?>_financial_year_financial_year_id" title="<?php echo $Disburse_Payments->financial_year_financial_year_id->FldTitle() ?>"<?php echo $Disburse_Payments->financial_year_financial_year_id->EditAttributes() ?>>
<?php
if (is_array($Disburse_Payments->financial_year_financial_year_id->EditValue)) {
	$arwrk = $Disburse_Payments->financial_year_financial_year_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Disburse_Payments->financial_year_financial_year_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $Disburse_Payments->financial_year_financial_year_id->ViewAttributes() ?>><?php echo $Disburse_Payments->financial_year_financial_year_id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Disburse_Payments->amount->Visible) { // amount ?>
		<td<?php echo $Disburse_Payments->amount->CellAttributes() ?>>
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $Disburse_Payments_list->lRowIndex ?>_amount" id="x<?php echo $Disburse_Payments_list->lRowIndex ?>_amount" title="<?php echo $Disburse_Payments->amount->FldTitle() ?>" size="30" value="<?php echo $Disburse_Payments->amount->EditValue ?>"<?php echo $Disburse_Payments->amount->EditAttributes() ?>>
<?php } ?>
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $Disburse_Payments->amount->ViewAttributes() ?>><?php echo $Disburse_Payments->amount->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Disburse_Payments_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($Disburse_Payments->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($Disburse_Payments->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($Disburse_Payments->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $Disburse_Payments_list->lRowIndex ?>">
<?php echo $Disburse_Payments_list->sMultiSelectKey ?>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($Disburse_Payments->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($Disburse_Payments->CurrentAction <> "gridadd" && $Disburse_Payments->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($Disburse_Payments_list->Pager)) $Disburse_Payments_list->Pager = new cPrevNextPager($Disburse_Payments_list->lStartRec, $Disburse_Payments_list->lDisplayRecs, $Disburse_Payments_list->lTotalRecs) ?>
<?php if ($Disburse_Payments_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Disburse_Payments_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $Disburse_Payments_list->PageUrl() ?>start=<?php echo $Disburse_Payments_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Disburse_Payments_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $Disburse_Payments_list->PageUrl() ?>start=<?php echo $Disburse_Payments_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $Disburse_Payments_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Disburse_Payments_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $Disburse_Payments_list->PageUrl() ?>start=<?php echo $Disburse_Payments_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Disburse_Payments_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $Disburse_Payments_list->PageUrl() ?>start=<?php echo $Disburse_Payments_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $Disburse_Payments_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $Disburse_Payments_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $Disburse_Payments_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $Disburse_Payments_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($Disburse_Payments_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($Disburse_Payments_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Disburse_Payments->CurrentAction <> "gridadd" && $Disburse_Payments->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->CanEdit()) { ?>
<?php if ($Disburse_Payments_list->lTotalRecs > 0) { ?>
<a href="<?php echo $Disburse_Payments_list->GridEditUrl ?>"><?php echo $Language->Phrase("GridEditLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($Disburse_Payments->CurrentAction == "gridedit") { ?>
<a href="" onclick="f=document.fDisburse_Paymentslist;if(Disburse_Payments_list.ValidateForm(f))f.submit();return false;"><?php echo $Language->Phrase("GridSaveLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $Disburse_Payments_list->PageUrl() ?>a=cancel"><?php echo $Language->Phrase("GridCancelLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($Disburse_Payments->Export == "" && $Disburse_Payments->CurrentAction == "") { ?>
<?php } ?>
<?php if ($Disburse_Payments->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$Disburse_Payments_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cDisburse_Payments_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'Disburse Payments';

	// Page object name
	var $PageObjName = 'Disburse_Payments_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $Disburse_Payments;
		if ($Disburse_Payments->UseTokenInUrl) $PageUrl .= "t=" . $Disburse_Payments->TableVar . "&"; // Add page token
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
		global $objForm, $Disburse_Payments;
		if ($Disburse_Payments->UseTokenInUrl) {
			if ($objForm)
				return ($Disburse_Payments->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($Disburse_Payments->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cDisburse_Payments_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (Disburse_Payments)
		$GLOBALS["Disburse_Payments"] = new cDisburse_Payments();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["Disburse_Payments"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "Disburse_Paymentsdelete.php";
		$this->MultiUpdateUrl = "Disburse_Paymentsupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'Disburse Payments', TRUE);

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
		global $Disburse_Payments;

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

		// Create form object
		$objForm = new cFormObj();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$Disburse_Payments->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$Disburse_Payments->Export = $_POST["exporttype"];
		} else {
			$Disburse_Payments->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $Disburse_Payments->Export; // Get export parameter, used in header
		$gsExportFile = $Disburse_Payments->TableVar; // Get export file, used in header
		if ($Disburse_Payments->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($Disburse_Payments->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $Disburse_Payments;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$Disburse_Payments->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($Disburse_Payments->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($Disburse_Payments->CurrentAction == "gridedit")
					$this->GridEditMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$Disburse_Payments->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if (($Disburse_Payments->CurrentAction == "gridupdate" || $Disburse_Payments->CurrentAction == "gridoverwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();
				}
			}

			// Set up list options
			$this->SetupListOptions();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$Disburse_Payments->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($Disburse_Payments->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $Disburse_Payments->getRecordsPerPage(); // Restore from Session
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
		$Disburse_Payments->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$Disburse_Payments->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$Disburse_Payments->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $Disburse_Payments->getSearchWhere();
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
		$Disburse_Payments->setSessionWhere($sFilter);
		$Disburse_Payments->CurrentFilter = "";

		// Export data only
		if (in_array($Disburse_Payments->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($Disburse_Payments->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $Disburse_Payments;
		$Disburse_Payments->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $Language, $objForm, $gsFormError, $Disburse_Payments;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();
		$this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateBegin")); // Batch update begin

		// Get old recordset
		$Disburse_Payments->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $Disburse_Payments->SQL();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));

		// Update all rows based on key
		while ($sThisKey <> "") {

			// Load all values and keys
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$bGridUpdate = FALSE; // Form error, reset action
				$this->setMessage($gsFormError);
			} else {
				if ($this->SetupKeyValues($sThisKey)) { // Set up key values
					$Disburse_Payments->SendEmail = FALSE; // Do not send email on update success
					$bGridUpdate = $this->EditRow(); // Update this row
				} else {
					$bGridUpdate = FALSE; // update failed
				}
			}
			if ($bGridUpdate) {
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			} else {
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		if ($bGridUpdate) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateSuccess")); // Batch update success
			$this->setMessage($Language->Phrase("UpdateSuccess")); // Set update success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			$this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateRollback")); // Batch update rollback
			if ($this->getMessage() == "")
				$this->setMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$Disburse_Payments->EventCancelled = TRUE; // Set event cancelled
			$Disburse_Payments->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $Disburse_Payments;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $Disburse_Payments->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		global $Disburse_Payments;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$Disburse_Payments->payment_request_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($Disburse_Payments->payment_request_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $Disburse_Payments;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($Disburse_Payments->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($Disburse_Payments->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($Disburse_Payments->payment_request_id->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $Disburse_Payments;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $Disburse_Payments->payment_request_id, FALSE); // payment_request_id
		$this->BuildSearchSql($sWhere, $Disburse_Payments->code, FALSE); // code
		$this->BuildSearchSql($sWhere, $Disburse_Payments->programarea_id, FALSE); // programarea_id
		$this->BuildSearchSql($sWhere, $Disburse_Payments->year, FALSE); // year
		$this->BuildSearchSql($sWhere, $Disburse_Payments->request_date, FALSE); // request_date
		$this->BuildSearchSql($sWhere, $Disburse_Payments->request_status, FALSE); // request_status
		$this->BuildSearchSql($sWhere, $Disburse_Payments->financial_year_financial_year_id, FALSE); // financial_year_financial_year_id
		$this->BuildSearchSql($sWhere, $Disburse_Payments->amount, FALSE); // amount
		$this->BuildSearchSql($sWhere, $Disburse_Payments->group_id, FALSE); // group_id

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($Disburse_Payments->payment_request_id); // payment_request_id
			$this->SetSearchParm($Disburse_Payments->code); // code
			$this->SetSearchParm($Disburse_Payments->programarea_id); // programarea_id
			$this->SetSearchParm($Disburse_Payments->year); // year
			$this->SetSearchParm($Disburse_Payments->request_date); // request_date
			$this->SetSearchParm($Disburse_Payments->request_status); // request_status
			$this->SetSearchParm($Disburse_Payments->financial_year_financial_year_id); // financial_year_financial_year_id
			$this->SetSearchParm($Disburse_Payments->amount); // amount
			$this->SetSearchParm($Disburse_Payments->group_id); // group_id
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
		global $Disburse_Payments;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$Disburse_Payments->setAdvancedSearch("x_$FldParm", $FldVal);
		$Disburse_Payments->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$Disburse_Payments->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$Disburse_Payments->setAdvancedSearch("y_$FldParm", $FldVal2);
		$Disburse_Payments->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $Disburse_Payments;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $Disburse_Payments->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $Disburse_Payments->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $Disburse_Payments->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $Disburse_Payments->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $Disburse_Payments->GetAdvancedSearch("w_$FldParm");
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
		global $Disburse_Payments;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$Disburse_Payments->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $Disburse_Payments;
		$Disburse_Payments->setAdvancedSearch("x_payment_request_id", "");
		$Disburse_Payments->setAdvancedSearch("x_code", "");
		$Disburse_Payments->setAdvancedSearch("x_programarea_id", "");
		$Disburse_Payments->setAdvancedSearch("x_year", "");
		$Disburse_Payments->setAdvancedSearch("x_request_date", "");
		$Disburse_Payments->setAdvancedSearch("x_request_status", "");
		$Disburse_Payments->setAdvancedSearch("x_financial_year_financial_year_id", "");
		$Disburse_Payments->setAdvancedSearch("x_amount", "");
		$Disburse_Payments->setAdvancedSearch("x_group_id", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $Disburse_Payments;
		$bRestore = TRUE;
		if (@$_GET["x_payment_request_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_code"] <> "") $bRestore = FALSE;
		if (@$_GET["x_programarea_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_year"] <> "") $bRestore = FALSE;
		if (@$_GET["x_request_date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_request_status"] <> "") $bRestore = FALSE;
		if (@$_GET["x_financial_year_financial_year_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_amount"] <> "") $bRestore = FALSE;
		if (@$_GET["x_group_id"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($Disburse_Payments->payment_request_id);
			$this->GetSearchParm($Disburse_Payments->code);
			$this->GetSearchParm($Disburse_Payments->programarea_id);
			$this->GetSearchParm($Disburse_Payments->year);
			$this->GetSearchParm($Disburse_Payments->request_date);
			$this->GetSearchParm($Disburse_Payments->request_status);
			$this->GetSearchParm($Disburse_Payments->financial_year_financial_year_id);
			$this->GetSearchParm($Disburse_Payments->amount);
			$this->GetSearchParm($Disburse_Payments->group_id);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $Disburse_Payments;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$Disburse_Payments->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$Disburse_Payments->CurrentOrderType = @$_GET["ordertype"];
			$Disburse_Payments->UpdateSort($Disburse_Payments->payment_request_id); // payment_request_id
			$Disburse_Payments->UpdateSort($Disburse_Payments->code); // code
			$Disburse_Payments->UpdateSort($Disburse_Payments->programarea_id); // programarea_id
			$Disburse_Payments->UpdateSort($Disburse_Payments->year); // year
			$Disburse_Payments->UpdateSort($Disburse_Payments->request_date); // request_date
			$Disburse_Payments->UpdateSort($Disburse_Payments->request_status); // request_status
			$Disburse_Payments->UpdateSort($Disburse_Payments->financial_year_financial_year_id); // financial_year_financial_year_id
			$Disburse_Payments->UpdateSort($Disburse_Payments->amount); // amount
			$Disburse_Payments->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $Disburse_Payments;
		$sOrderBy = $Disburse_Payments->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($Disburse_Payments->SqlOrderBy() <> "") {
				$sOrderBy = $Disburse_Payments->SqlOrderBy();
				$Disburse_Payments->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $Disburse_Payments;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$Disburse_Payments->setSessionOrderBy($sOrderBy);
				$Disburse_Payments->payment_request_id->setSort("");
				$Disburse_Payments->code->setSort("");
				$Disburse_Payments->programarea_id->setSort("");
				$Disburse_Payments->year->setSort("");
				$Disburse_Payments->request_date->setSort("");
				$Disburse_Payments->request_status->setSort("");
				$Disburse_Payments->financial_year_financial_year_id->setSort("");
				$Disburse_Payments->amount->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$Disburse_Payments->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Disburse_Payments;

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
		if ($Disburse_Payments->Export <> "" ||
			$Disburse_Payments->CurrentAction == "gridadd" ||
			$Disburse_Payments->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $Disburse_Payments;
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
		if ($Disburse_Payments->CurrentAction == "gridedit")
			$this->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->lRowIndex . "_key\" id=\"k" . $this->lRowIndex . "_key\" value=\"" . $Disburse_Payments->payment_request_id->CurrentValue . "\">";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $Disburse_Payments;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $Disburse_Payments;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$Disburse_Payments->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$Disburse_Payments->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $Disburse_Payments->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$Disburse_Payments->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$Disburse_Payments->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$Disburse_Payments->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $Disburse_Payments;

		// Load search values
		// payment_request_id

		$Disburse_Payments->payment_request_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_payment_request_id"]);
		$Disburse_Payments->payment_request_id->AdvancedSearch->SearchOperator = @$_GET["z_payment_request_id"];

		// code
		$Disburse_Payments->code->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_code"]);
		$Disburse_Payments->code->AdvancedSearch->SearchOperator = @$_GET["z_code"];

		// programarea_id
		$Disburse_Payments->programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programarea_id"]);
		$Disburse_Payments->programarea_id->AdvancedSearch->SearchOperator = @$_GET["z_programarea_id"];

		// year
		$Disburse_Payments->year->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_year"]);
		$Disburse_Payments->year->AdvancedSearch->SearchOperator = @$_GET["z_year"];

		// request_date
		$Disburse_Payments->request_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_request_date"]);
		$Disburse_Payments->request_date->AdvancedSearch->SearchOperator = @$_GET["z_request_date"];

		// request_status
		$Disburse_Payments->request_status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_request_status"]);
		$Disburse_Payments->request_status->AdvancedSearch->SearchOperator = @$_GET["z_request_status"];

		// financial_year_financial_year_id
		$Disburse_Payments->financial_year_financial_year_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_financial_year_financial_year_id"]);
		$Disburse_Payments->financial_year_financial_year_id->AdvancedSearch->SearchOperator = @$_GET["z_financial_year_financial_year_id"];

		// amount
		$Disburse_Payments->amount->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_amount"]);
		$Disburse_Payments->amount->AdvancedSearch->SearchOperator = @$_GET["z_amount"];

		// group_id
		$Disburse_Payments->group_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_group_id"]);
		$Disburse_Payments->group_id->AdvancedSearch->SearchOperator = @$_GET["z_group_id"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $Disburse_Payments;
		$Disburse_Payments->payment_request_id->setFormValue($objForm->GetValue("x_payment_request_id"));
		$Disburse_Payments->code->setFormValue($objForm->GetValue("x_code"));
		$Disburse_Payments->programarea_id->setFormValue($objForm->GetValue("x_programarea_id"));
		$Disburse_Payments->year->setFormValue($objForm->GetValue("x_year"));
		$Disburse_Payments->request_date->setFormValue($objForm->GetValue("x_request_date"));
		$Disburse_Payments->request_date->CurrentValue = ew_UnFormatDateTime($Disburse_Payments->request_date->CurrentValue, 7);
		$Disburse_Payments->request_status->setFormValue($objForm->GetValue("x_request_status"));
		$Disburse_Payments->financial_year_financial_year_id->setFormValue($objForm->GetValue("x_financial_year_financial_year_id"));
		$Disburse_Payments->amount->setFormValue($objForm->GetValue("x_amount"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $Disburse_Payments;
		$Disburse_Payments->payment_request_id->CurrentValue = $Disburse_Payments->payment_request_id->FormValue;
		$Disburse_Payments->code->CurrentValue = $Disburse_Payments->code->FormValue;
		$Disburse_Payments->programarea_id->CurrentValue = $Disburse_Payments->programarea_id->FormValue;
		$Disburse_Payments->year->CurrentValue = $Disburse_Payments->year->FormValue;
		$Disburse_Payments->request_date->CurrentValue = $Disburse_Payments->request_date->FormValue;
		$Disburse_Payments->request_date->CurrentValue = ew_UnFormatDateTime($Disburse_Payments->request_date->CurrentValue, 7);
		$Disburse_Payments->request_status->CurrentValue = $Disburse_Payments->request_status->FormValue;
		$Disburse_Payments->financial_year_financial_year_id->CurrentValue = $Disburse_Payments->financial_year_financial_year_id->FormValue;
		$Disburse_Payments->amount->CurrentValue = $Disburse_Payments->amount->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $Disburse_Payments;

		// Call Recordset Selecting event
		$Disburse_Payments->Recordset_Selecting($Disburse_Payments->CurrentFilter);

		// Load List page SQL
		$sSql = $Disburse_Payments->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$Disburse_Payments->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $Disburse_Payments;
		$sFilter = $Disburse_Payments->KeyFilter();

		// Call Row Selecting event
		$Disburse_Payments->Row_Selecting($sFilter);

		// Load SQL based on filter
		$Disburse_Payments->CurrentFilter = $sFilter;
		$sSql = $Disburse_Payments->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$Disburse_Payments->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $Disburse_Payments;
		$Disburse_Payments->payment_request_id->setDbValue($rs->fields('payment_request_id'));
		$Disburse_Payments->code->setDbValue($rs->fields('code'));
		$Disburse_Payments->programarea_id->setDbValue($rs->fields('programarea_id'));
		$Disburse_Payments->year->setDbValue($rs->fields('year'));
		$Disburse_Payments->request_date->setDbValue($rs->fields('request_date'));
		$Disburse_Payments->request_status->setDbValue($rs->fields('request_status'));
		$Disburse_Payments->financial_year_financial_year_id->setDbValue($rs->fields('financial_year_financial_year_id'));
		$Disburse_Payments->amount->setDbValue($rs->fields('amount'));
		$Disburse_Payments->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $Disburse_Payments;

		// Initialize URLs
		$this->ViewUrl = $Disburse_Payments->ViewUrl();
		$this->EditUrl = $Disburse_Payments->EditUrl();
		$this->InlineEditUrl = $Disburse_Payments->InlineEditUrl();
		$this->CopyUrl = $Disburse_Payments->CopyUrl();
		$this->InlineCopyUrl = $Disburse_Payments->InlineCopyUrl();
		$this->DeleteUrl = $Disburse_Payments->DeleteUrl();

		// Call Row_Rendering event
		$Disburse_Payments->Row_Rendering();

		// Common render codes for all row types
		// payment_request_id

		$Disburse_Payments->payment_request_id->CellCssStyle = ""; $Disburse_Payments->payment_request_id->CellCssClass = "";
		$Disburse_Payments->payment_request_id->CellAttrs = array(); $Disburse_Payments->payment_request_id->ViewAttrs = array(); $Disburse_Payments->payment_request_id->EditAttrs = array();

		// code
		$Disburse_Payments->code->CellCssStyle = ""; $Disburse_Payments->code->CellCssClass = "";
		$Disburse_Payments->code->CellAttrs = array(); $Disburse_Payments->code->ViewAttrs = array(); $Disburse_Payments->code->EditAttrs = array();

		// programarea_id
		$Disburse_Payments->programarea_id->CellCssStyle = ""; $Disburse_Payments->programarea_id->CellCssClass = "";
		$Disburse_Payments->programarea_id->CellAttrs = array(); $Disburse_Payments->programarea_id->ViewAttrs = array(); $Disburse_Payments->programarea_id->EditAttrs = array();

		// year
		$Disburse_Payments->year->CellCssStyle = ""; $Disburse_Payments->year->CellCssClass = "";
		$Disburse_Payments->year->CellAttrs = array(); $Disburse_Payments->year->ViewAttrs = array(); $Disburse_Payments->year->EditAttrs = array();

		// request_date
		$Disburse_Payments->request_date->CellCssStyle = ""; $Disburse_Payments->request_date->CellCssClass = "";
		$Disburse_Payments->request_date->CellAttrs = array(); $Disburse_Payments->request_date->ViewAttrs = array(); $Disburse_Payments->request_date->EditAttrs = array();

		// request_status
		$Disburse_Payments->request_status->CellCssStyle = ""; $Disburse_Payments->request_status->CellCssClass = "";
		$Disburse_Payments->request_status->CellAttrs = array(); $Disburse_Payments->request_status->ViewAttrs = array(); $Disburse_Payments->request_status->EditAttrs = array();

		// financial_year_financial_year_id
		$Disburse_Payments->financial_year_financial_year_id->CellCssStyle = ""; $Disburse_Payments->financial_year_financial_year_id->CellCssClass = "";
		$Disburse_Payments->financial_year_financial_year_id->CellAttrs = array(); $Disburse_Payments->financial_year_financial_year_id->ViewAttrs = array(); $Disburse_Payments->financial_year_financial_year_id->EditAttrs = array();

		// amount
		$Disburse_Payments->amount->CellCssStyle = ""; $Disburse_Payments->amount->CellCssClass = "";
		$Disburse_Payments->amount->CellAttrs = array(); $Disburse_Payments->amount->ViewAttrs = array(); $Disburse_Payments->amount->EditAttrs = array();
		if ($Disburse_Payments->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$Disburse_Payments->payment_request_id->ViewValue = $Disburse_Payments->payment_request_id->CurrentValue;
			$Disburse_Payments->payment_request_id->CssStyle = "";
			$Disburse_Payments->payment_request_id->CssClass = "";
			$Disburse_Payments->payment_request_id->ViewCustomAttributes = "";

			// code
			$Disburse_Payments->code->ViewValue = $Disburse_Payments->code->CurrentValue;
			$Disburse_Payments->code->CssStyle = "";
			$Disburse_Payments->code->CssClass = "";
			$Disburse_Payments->code->ViewCustomAttributes = "";

			// programarea_id
			if (strval($Disburse_Payments->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Disburse_Payments->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Disburse_Payments->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Disburse_Payments->programarea_id->ViewValue = $Disburse_Payments->programarea_id->CurrentValue;
				}
			} else {
				$Disburse_Payments->programarea_id->ViewValue = NULL;
			}
			$Disburse_Payments->programarea_id->CssStyle = "";
			$Disburse_Payments->programarea_id->CssClass = "";
			$Disburse_Payments->programarea_id->ViewCustomAttributes = "";

			// year
			$Disburse_Payments->year->ViewValue = $Disburse_Payments->year->CurrentValue;
			$Disburse_Payments->year->CssStyle = "";
			$Disburse_Payments->year->CssClass = "";
			$Disburse_Payments->year->ViewCustomAttributes = "";

			// request_date
			$Disburse_Payments->request_date->ViewValue = $Disburse_Payments->request_date->CurrentValue;
			$Disburse_Payments->request_date->ViewValue = ew_FormatDateTime($Disburse_Payments->request_date->ViewValue, 7);
			$Disburse_Payments->request_date->CssStyle = "";
			$Disburse_Payments->request_date->CssClass = "";
			$Disburse_Payments->request_date->ViewCustomAttributes = "";

			// request_status
			if (strval($Disburse_Payments->request_status->CurrentValue) <> "") {
				switch ($Disburse_Payments->request_status->CurrentValue) {
					case "NEWREQ":
						$Disburse_Payments->request_status->ViewValue = "NEWREQ";
						break;
					case "REQUESTED":
						$Disburse_Payments->request_status->ViewValue = "REQUESTED";
						break;
					case "DISBURSED":
						$Disburse_Payments->request_status->ViewValue = "DISBURSED";
						break;
					case "LIQUIDATED":
						$Disburse_Payments->request_status->ViewValue = "LIQUIDATED";
						break;
					default:
						$Disburse_Payments->request_status->ViewValue = $Disburse_Payments->request_status->CurrentValue;
				}
			} else {
				$Disburse_Payments->request_status->ViewValue = NULL;
			}
			$Disburse_Payments->request_status->CssStyle = "";
			$Disburse_Payments->request_status->CssClass = "";
			$Disburse_Payments->request_status->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			if (strval($Disburse_Payments->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($Disburse_Payments->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Disburse_Payments->financial_year_financial_year_id->ViewValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$Disburse_Payments->financial_year_financial_year_id->ViewValue = $Disburse_Payments->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$Disburse_Payments->financial_year_financial_year_id->ViewValue = NULL;
			}
			$Disburse_Payments->financial_year_financial_year_id->CssStyle = "";
			$Disburse_Payments->financial_year_financial_year_id->CssClass = "";
			$Disburse_Payments->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$Disburse_Payments->amount->ViewValue = $Disburse_Payments->amount->CurrentValue;
			$Disburse_Payments->amount->CssStyle = "";
			$Disburse_Payments->amount->CssClass = "";
			$Disburse_Payments->amount->ViewCustomAttributes = "";

			// payment_request_id
			$Disburse_Payments->payment_request_id->HrefValue = "";
			$Disburse_Payments->payment_request_id->TooltipValue = "";

			// code
			$Disburse_Payments->code->HrefValue = "";
			$Disburse_Payments->code->TooltipValue = "";

			// programarea_id
			$Disburse_Payments->programarea_id->HrefValue = "";
			$Disburse_Payments->programarea_id->TooltipValue = "";

			// year
			$Disburse_Payments->year->HrefValue = "";
			$Disburse_Payments->year->TooltipValue = "";

			// request_date
			$Disburse_Payments->request_date->HrefValue = "";
			$Disburse_Payments->request_date->TooltipValue = "";

			// request_status
			$Disburse_Payments->request_status->HrefValue = "";
			$Disburse_Payments->request_status->TooltipValue = "";

			// financial_year_financial_year_id
			$Disburse_Payments->financial_year_financial_year_id->HrefValue = "";
			$Disburse_Payments->financial_year_financial_year_id->TooltipValue = "";

			// amount
			$Disburse_Payments->amount->HrefValue = "";
			$Disburse_Payments->amount->TooltipValue = "";
		} elseif ($Disburse_Payments->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// payment_request_id
			$Disburse_Payments->payment_request_id->EditCustomAttributes = "";
			$Disburse_Payments->payment_request_id->EditValue = $Disburse_Payments->payment_request_id->CurrentValue;
			$Disburse_Payments->payment_request_id->CssStyle = "";
			$Disburse_Payments->payment_request_id->CssClass = "";
			$Disburse_Payments->payment_request_id->ViewCustomAttributes = "";

			// code
			$Disburse_Payments->code->EditCustomAttributes = "";
			$Disburse_Payments->code->EditValue = ew_HtmlEncode($Disburse_Payments->code->CurrentValue);

			// programarea_id
			$Disburse_Payments->programarea_id->EditCustomAttributes = "";
			if (strval($Disburse_Payments->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Disburse_Payments->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Disburse_Payments->programarea_id->EditValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Disburse_Payments->programarea_id->EditValue = $Disburse_Payments->programarea_id->CurrentValue;
				}
			} else {
				$Disburse_Payments->programarea_id->EditValue = NULL;
			}
			$Disburse_Payments->programarea_id->CssStyle = "";
			$Disburse_Payments->programarea_id->CssClass = "";
			$Disburse_Payments->programarea_id->ViewCustomAttributes = "";

			// year
			$Disburse_Payments->year->EditCustomAttributes = "";
			$Disburse_Payments->year->EditValue = $Disburse_Payments->year->CurrentValue;
			$Disburse_Payments->year->CssStyle = "";
			$Disburse_Payments->year->CssClass = "";
			$Disburse_Payments->year->ViewCustomAttributes = "";

			// request_date
			$Disburse_Payments->request_date->EditCustomAttributes = "";
			$Disburse_Payments->request_date->EditValue = $Disburse_Payments->request_date->CurrentValue;
			$Disburse_Payments->request_date->EditValue = ew_FormatDateTime($Disburse_Payments->request_date->EditValue, 7);
			$Disburse_Payments->request_date->CssStyle = "";
			$Disburse_Payments->request_date->CssClass = "";
			$Disburse_Payments->request_date->ViewCustomAttributes = "";

			// request_status
			$Disburse_Payments->request_status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("NEWREQ", "NEWREQ");
			$arwrk[] = array("REQUESTED", "REQUESTED");
			$arwrk[] = array("DISBURSED", "DISBURSED");
			$arwrk[] = array("LIQUIDATED", "LIQUIDATED");
			$Disburse_Payments->request_status->EditValue = $arwrk;

			// financial_year_financial_year_id
			$Disburse_Payments->financial_year_financial_year_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `financial_year_id`, `year_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `financial_year`";
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
			$Disburse_Payments->financial_year_financial_year_id->EditValue = $arwrk;

			// amount
			$Disburse_Payments->amount->EditCustomAttributes = "";
			$Disburse_Payments->amount->EditValue = ew_HtmlEncode($Disburse_Payments->amount->CurrentValue);

			// Edit refer script
			// payment_request_id

			$Disburse_Payments->payment_request_id->HrefValue = "";

			// code
			$Disburse_Payments->code->HrefValue = "";

			// programarea_id
			$Disburse_Payments->programarea_id->HrefValue = "";

			// year
			$Disburse_Payments->year->HrefValue = "";

			// request_date
			$Disburse_Payments->request_date->HrefValue = "";

			// request_status
			$Disburse_Payments->request_status->HrefValue = "";

			// financial_year_financial_year_id
			$Disburse_Payments->financial_year_financial_year_id->HrefValue = "";

			// amount
			$Disburse_Payments->amount->HrefValue = "";
		}

		// Call Row Rendered event
		if ($Disburse_Payments->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$Disburse_Payments->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $Disburse_Payments;

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

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $Disburse_Payments;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($Disburse_Payments->financial_year_financial_year_id->FormValue) && $Disburse_Payments->financial_year_financial_year_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $Disburse_Payments->financial_year_financial_year_id->FldCaption();
		}
		if (!ew_CheckInteger($Disburse_Payments->amount->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $Disburse_Payments->amount->FldErrMsg();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $Disburse_Payments;
		$sFilter = $Disburse_Payments->KeyFilter();
		$Disburse_Payments->CurrentFilter = $sFilter;
		$sSql = $Disburse_Payments->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// code
			$Disburse_Payments->code->SetDbValueDef($rsnew, $Disburse_Payments->code->CurrentValue, NULL, FALSE);

			// request_status
			$Disburse_Payments->request_status->SetDbValueDef($rsnew, $Disburse_Payments->request_status->CurrentValue, NULL, FALSE);

			// financial_year_financial_year_id
			$Disburse_Payments->financial_year_financial_year_id->SetDbValueDef($rsnew, $Disburse_Payments->financial_year_financial_year_id->CurrentValue, 0, FALSE);

			// amount
			$Disburse_Payments->amount->SetDbValueDef($rsnew, $Disburse_Payments->amount->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $Disburse_Payments->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($Disburse_Payments->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($Disburse_Payments->CancelMessage <> "") {
					$this->setMessage($Disburse_Payments->CancelMessage);
					$Disburse_Payments->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$Disburse_Payments->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $Disburse_Payments;
		$Disburse_Payments->payment_request_id->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_payment_request_id");
		$Disburse_Payments->code->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_code");
		$Disburse_Payments->programarea_id->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_programarea_id");
		$Disburse_Payments->year->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_year");
		$Disburse_Payments->request_date->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_request_date");
		$Disburse_Payments->request_status->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_request_status");
		$Disburse_Payments->financial_year_financial_year_id->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_financial_year_financial_year_id");
		$Disburse_Payments->amount->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_amount");
		$Disburse_Payments->group_id->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_group_id");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $Disburse_Payments;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $Disburse_Payments->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($Disburse_Payments->ExportAll) {
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
		if ($Disburse_Payments->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($Disburse_Payments, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($Disburse_Payments->payment_request_id);
				$ExportDoc->ExportCaption($Disburse_Payments->code);
				$ExportDoc->ExportCaption($Disburse_Payments->programarea_id);
				$ExportDoc->ExportCaption($Disburse_Payments->year);
				$ExportDoc->ExportCaption($Disburse_Payments->request_date);
				$ExportDoc->ExportCaption($Disburse_Payments->request_status);
				$ExportDoc->ExportCaption($Disburse_Payments->financial_year_financial_year_id);
				$ExportDoc->ExportCaption($Disburse_Payments->amount);
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
				$Disburse_Payments->CssClass = "";
				$Disburse_Payments->CssStyle = "";
				$Disburse_Payments->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($Disburse_Payments->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('payment_request_id', $Disburse_Payments->payment_request_id->ExportValue($Disburse_Payments->Export, $Disburse_Payments->ExportOriginalValue));
					$XmlDoc->AddField('code', $Disburse_Payments->code->ExportValue($Disburse_Payments->Export, $Disburse_Payments->ExportOriginalValue));
					$XmlDoc->AddField('programarea_id', $Disburse_Payments->programarea_id->ExportValue($Disburse_Payments->Export, $Disburse_Payments->ExportOriginalValue));
					$XmlDoc->AddField('year', $Disburse_Payments->year->ExportValue($Disburse_Payments->Export, $Disburse_Payments->ExportOriginalValue));
					$XmlDoc->AddField('request_date', $Disburse_Payments->request_date->ExportValue($Disburse_Payments->Export, $Disburse_Payments->ExportOriginalValue));
					$XmlDoc->AddField('request_status', $Disburse_Payments->request_status->ExportValue($Disburse_Payments->Export, $Disburse_Payments->ExportOriginalValue));
					$XmlDoc->AddField('financial_year_financial_year_id', $Disburse_Payments->financial_year_financial_year_id->ExportValue($Disburse_Payments->Export, $Disburse_Payments->ExportOriginalValue));
					$XmlDoc->AddField('amount', $Disburse_Payments->amount->ExportValue($Disburse_Payments->Export, $Disburse_Payments->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($Disburse_Payments->payment_request_id);
					$ExportDoc->ExportField($Disburse_Payments->code);
					$ExportDoc->ExportField($Disburse_Payments->programarea_id);
					$ExportDoc->ExportField($Disburse_Payments->year);
					$ExportDoc->ExportField($Disburse_Payments->request_date);
					$ExportDoc->ExportField($Disburse_Payments->request_status);
					$ExportDoc->ExportField($Disburse_Payments->financial_year_financial_year_id);
					$ExportDoc->ExportField($Disburse_Payments->amount);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($Disburse_Payments->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($Disburse_Payments->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($Disburse_Payments->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($Disburse_Payments->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($Disburse_Payments->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $Disburse_Payments;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($Disburse_Payments->group_id->CurrentValue);
			}
		}
		return TRUE;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'Disburse Payments';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $Disburse_Payments;
		$table = 'Disburse Payments';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['payment_request_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if ($Disburse_Payments->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($Disburse_Payments->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($Disburse_Payments->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						$oldvalue = "<MEMO>";
						$newvalue = "<MEMO>";
					} elseif ($Disburse_Payments->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "<XML>";
						$newvalue = "<XML>";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
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
