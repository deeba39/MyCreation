<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "Liquidate_Payment_Requestinfo.php" ?>
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
$Liquidate_Payment_Request_list = new cLiquidate_Payment_Request_list();
$Page =& $Liquidate_Payment_Request_list;

// Page init
$Liquidate_Payment_Request_list->Page_Init();

// Page main
$Liquidate_Payment_Request_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($Liquidate_Payment_Request->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var Liquidate_Payment_Request_list = new ew_Page("Liquidate_Payment_Request_list");

// page properties
Liquidate_Payment_Request_list.PageID = "list"; // page ID
Liquidate_Payment_Request_list.FormID = "fLiquidate_Payment_Requestlist"; // form ID
var EW_PAGE_ID = Liquidate_Payment_Request_list.PageID; // for backward compatibility

// extend page with ValidateForm function
Liquidate_Payment_Request_list.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Liquidate_Payment_Request->financial_year_financial_year_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_amount"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Liquidate_Payment_Request->amount->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
Liquidate_Payment_Request_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
Liquidate_Payment_Request_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Liquidate_Payment_Request_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($Liquidate_Payment_Request->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$Liquidate_Payment_Request_list->lTotalRecs = $Liquidate_Payment_Request->SelectRecordCount();
	} else {
		if ($rs = $Liquidate_Payment_Request_list->LoadRecordset())
			$Liquidate_Payment_Request_list->lTotalRecs = $rs->RecordCount();
	}
	$Liquidate_Payment_Request_list->lStartRec = 1;
	if ($Liquidate_Payment_Request_list->lDisplayRecs <= 0 || ($Liquidate_Payment_Request->Export <> "" && $Liquidate_Payment_Request->ExportAll)) // Display all records
		$Liquidate_Payment_Request_list->lDisplayRecs = $Liquidate_Payment_Request_list->lTotalRecs;
	if (!($Liquidate_Payment_Request->Export <> "" && $Liquidate_Payment_Request->ExportAll))
		$Liquidate_Payment_Request_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $Liquidate_Payment_Request_list->LoadRecordset($Liquidate_Payment_Request_list->lStartRec-1, $Liquidate_Payment_Request_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $Liquidate_Payment_Request->TableCaption() ?>
<?php if ($Liquidate_Payment_Request->Export == "" && $Liquidate_Payment_Request->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Liquidate_Payment_Request_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Liquidate_Payment_Request_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Liquidate_Payment_Request_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($Liquidate_Payment_Request->Export == "" && $Liquidate_Payment_Request->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(Liquidate_Payment_Request_list);" style="text-decoration: none;"><img id="Liquidate_Payment_Request_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="Liquidate_Payment_Request_list_SearchPanel">
<form name="fLiquidate_Payment_Requestlistsrch" id="fLiquidate_Payment_Requestlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="Liquidate_Payment_Request">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $Liquidate_Payment_Request_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="Liquidate_Payment_Requestsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
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
$Liquidate_Payment_Request_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fLiquidate_Payment_Requestlist" id="fLiquidate_Payment_Requestlist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="Liquidate_Payment_Request">
<div id="gmp_Liquidate_Payment_Request" class="ewGridMiddlePanel">
<?php if ($Liquidate_Payment_Request_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $Liquidate_Payment_Request->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$Liquidate_Payment_Request_list->RenderListOptions();

// Render list options (header, left)
$Liquidate_Payment_Request_list->ListOptions->Render("header", "left");
?>
<?php if ($Liquidate_Payment_Request->payment_request_id->Visible) { // payment_request_id ?>
	<?php if ($Liquidate_Payment_Request->SortUrl($Liquidate_Payment_Request->payment_request_id) == "") { ?>
		<td><?php echo $Liquidate_Payment_Request->payment_request_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Liquidate_Payment_Request->SortUrl($Liquidate_Payment_Request->payment_request_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Liquidate_Payment_Request->payment_request_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($Liquidate_Payment_Request->payment_request_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Liquidate_Payment_Request->payment_request_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Liquidate_Payment_Request->year->Visible) { // year ?>
	<?php if ($Liquidate_Payment_Request->SortUrl($Liquidate_Payment_Request->year) == "") { ?>
		<td><?php echo $Liquidate_Payment_Request->year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Liquidate_Payment_Request->SortUrl($Liquidate_Payment_Request->year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Liquidate_Payment_Request->year->FldCaption() ?></td><td style="width: 10px;"><?php if ($Liquidate_Payment_Request->year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Liquidate_Payment_Request->year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Liquidate_Payment_Request->request_date->Visible) { // request_date ?>
	<?php if ($Liquidate_Payment_Request->SortUrl($Liquidate_Payment_Request->request_date) == "") { ?>
		<td><?php echo $Liquidate_Payment_Request->request_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Liquidate_Payment_Request->SortUrl($Liquidate_Payment_Request->request_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Liquidate_Payment_Request->request_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($Liquidate_Payment_Request->request_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Liquidate_Payment_Request->request_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Liquidate_Payment_Request->programarea_id->Visible) { // programarea_id ?>
	<?php if ($Liquidate_Payment_Request->SortUrl($Liquidate_Payment_Request->programarea_id) == "") { ?>
		<td><?php echo $Liquidate_Payment_Request->programarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Liquidate_Payment_Request->SortUrl($Liquidate_Payment_Request->programarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Liquidate_Payment_Request->programarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($Liquidate_Payment_Request->programarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Liquidate_Payment_Request->programarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Liquidate_Payment_Request->request_status->Visible) { // request_status ?>
	<?php if ($Liquidate_Payment_Request->SortUrl($Liquidate_Payment_Request->request_status) == "") { ?>
		<td><?php echo $Liquidate_Payment_Request->request_status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Liquidate_Payment_Request->SortUrl($Liquidate_Payment_Request->request_status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Liquidate_Payment_Request->request_status->FldCaption() ?></td><td style="width: 10px;"><?php if ($Liquidate_Payment_Request->request_status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Liquidate_Payment_Request->request_status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Liquidate_Payment_Request->code->Visible) { // code ?>
	<?php if ($Liquidate_Payment_Request->SortUrl($Liquidate_Payment_Request->code) == "") { ?>
		<td><?php echo $Liquidate_Payment_Request->code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Liquidate_Payment_Request->SortUrl($Liquidate_Payment_Request->code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Liquidate_Payment_Request->code->FldCaption() ?></td><td style="width: 10px;"><?php if ($Liquidate_Payment_Request->code->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Liquidate_Payment_Request->code->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Liquidate_Payment_Request->financial_year_financial_year_id->Visible) { // financial_year_financial_year_id ?>
	<?php if ($Liquidate_Payment_Request->SortUrl($Liquidate_Payment_Request->financial_year_financial_year_id) == "") { ?>
		<td><?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Liquidate_Payment_Request->SortUrl($Liquidate_Payment_Request->financial_year_financial_year_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($Liquidate_Payment_Request->financial_year_financial_year_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Liquidate_Payment_Request->financial_year_financial_year_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($Liquidate_Payment_Request->amount->Visible) { // amount ?>
	<?php if ($Liquidate_Payment_Request->SortUrl($Liquidate_Payment_Request->amount) == "") { ?>
		<td><?php echo $Liquidate_Payment_Request->amount->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $Liquidate_Payment_Request->SortUrl($Liquidate_Payment_Request->amount) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $Liquidate_Payment_Request->amount->FldCaption() ?></td><td style="width: 10px;"><?php if ($Liquidate_Payment_Request->amount->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Liquidate_Payment_Request->amount->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$Liquidate_Payment_Request_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($Liquidate_Payment_Request->ExportAll && $Liquidate_Payment_Request->Export <> "") {
	$Liquidate_Payment_Request_list->lStopRec = $Liquidate_Payment_Request_list->lTotalRecs;
} else {
	$Liquidate_Payment_Request_list->lStopRec = $Liquidate_Payment_Request_list->lStartRec + $Liquidate_Payment_Request_list->lDisplayRecs - 1; // Set the last record to display
}
$Liquidate_Payment_Request_list->lRecCount = $Liquidate_Payment_Request_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $Liquidate_Payment_Request_list->lStartRec > 1)
		$rs->Move($Liquidate_Payment_Request_list->lStartRec - 1);
}

// Initialize aggregate
$Liquidate_Payment_Request->RowType = EW_ROWTYPE_AGGREGATEINIT;
$Liquidate_Payment_Request_list->RenderRow();
$Liquidate_Payment_Request_list->lRowCnt = 0;
if ($Liquidate_Payment_Request->CurrentAction == "gridedit")
	$Liquidate_Payment_Request_list->lRowIndex = 0;
while (($Liquidate_Payment_Request->CurrentAction == "gridadd" || !$rs->EOF) &&
	$Liquidate_Payment_Request_list->lRecCount < $Liquidate_Payment_Request_list->lStopRec) {
	$Liquidate_Payment_Request_list->lRecCount++;
	if (intval($Liquidate_Payment_Request_list->lRecCount) >= intval($Liquidate_Payment_Request_list->lStartRec)) {
		$Liquidate_Payment_Request_list->lRowCnt++;
		if ($Liquidate_Payment_Request->CurrentAction == "gridadd" || $Liquidate_Payment_Request->CurrentAction == "gridedit")
			$Liquidate_Payment_Request_list->lRowIndex++;

	// Init row class and style
	$Liquidate_Payment_Request->CssClass = "";
	$Liquidate_Payment_Request->CssStyle = "";
	$Liquidate_Payment_Request->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($Liquidate_Payment_Request->CurrentAction == "gridadd") {
		$Liquidate_Payment_Request_list->LoadDefaultValues(); // Load default values
	} else {
		$Liquidate_Payment_Request_list->LoadRowValues($rs); // Load row values
	}
	$Liquidate_Payment_Request->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($Liquidate_Payment_Request->CurrentAction == "gridedit") { // Grid edit
		$Liquidate_Payment_Request->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_EDIT && $Liquidate_Payment_Request->EventCancelled) { // Update failed
		if ($Liquidate_Payment_Request->CurrentAction == "gridedit")
			$Liquidate_Payment_Request_list->RestoreCurrentRowFormValues($Liquidate_Payment_Request_list->lRowIndex); // Restore form values
	}
	if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_EDIT) // Edit row
		$Liquidate_Payment_Request_list->lEditRowCnt++;
	if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_ADD || $Liquidate_Payment_Request->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
		$Liquidate_Payment_Request->RowAttrs = array_merge($Liquidate_Payment_Request->RowAttrs, array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);'));
		$Liquidate_Payment_Request->CssClass = "ewTableEditRow";
	}

	// Render row
	$Liquidate_Payment_Request_list->RenderRow();

	// Render list options
	$Liquidate_Payment_Request_list->RenderListOptions();
?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
<?php

// Render list options (body, left)
$Liquidate_Payment_Request_list->ListOptions->Render("body", "left");
?>
	<?php if ($Liquidate_Payment_Request->payment_request_id->Visible) { // payment_request_id ?>
		<td<?php echo $Liquidate_Payment_Request->payment_request_id->CellAttributes() ?>>
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $Liquidate_Payment_Request->payment_request_id->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->payment_request_id->EditValue ?></div><input type="hidden" name="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_payment_request_id" id="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_payment_request_id" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->payment_request_id->CurrentValue) ?>">
<?php } ?>
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $Liquidate_Payment_Request->payment_request_id->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->payment_request_id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Liquidate_Payment_Request->year->Visible) { // year ?>
		<td<?php echo $Liquidate_Payment_Request->year->CellAttributes() ?>>
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $Liquidate_Payment_Request->year->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->year->EditValue ?></div><input type="hidden" name="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_year" id="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_year" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->year->CurrentValue) ?>">
<?php } ?>
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $Liquidate_Payment_Request->year->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->year->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Liquidate_Payment_Request->request_date->Visible) { // request_date ?>
		<td<?php echo $Liquidate_Payment_Request->request_date->CellAttributes() ?>>
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $Liquidate_Payment_Request->request_date->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->request_date->EditValue ?></div><input type="hidden" name="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_request_date" id="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_request_date" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->request_date->CurrentValue) ?>">
<?php } ?>
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $Liquidate_Payment_Request->request_date->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->request_date->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Liquidate_Payment_Request->programarea_id->Visible) { // programarea_id ?>
		<td<?php echo $Liquidate_Payment_Request->programarea_id->CellAttributes() ?>>
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $Liquidate_Payment_Request->programarea_id->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->programarea_id->EditValue ?></div><input type="hidden" name="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_programarea_id" id="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_programarea_id" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->programarea_id->CurrentValue) ?>">
<?php } ?>
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $Liquidate_Payment_Request->programarea_id->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->programarea_id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Liquidate_Payment_Request->request_status->Visible) { // request_status ?>
		<td<?php echo $Liquidate_Payment_Request->request_status->CellAttributes() ?>>
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_request_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_request_status" id="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_request_status" title="<?php echo $Liquidate_Payment_Request->request_status->FldTitle() ?>" value="{value}"<?php echo $Liquidate_Payment_Request->request_status->EditAttributes() ?>></label></div>
<div id="dsl_x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_request_status" repeatcolumn="5">
<?php
$arwrk = $Liquidate_Payment_Request->request_status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Liquidate_Payment_Request->request_status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_request_status" id="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_request_status" title="<?php echo $Liquidate_Payment_Request->request_status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $Liquidate_Payment_Request->request_status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
<?php } ?>
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $Liquidate_Payment_Request->request_status->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->request_status->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Liquidate_Payment_Request->code->Visible) { // code ?>
		<td<?php echo $Liquidate_Payment_Request->code->CellAttributes() ?>>
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_code" id="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_code" title="<?php echo $Liquidate_Payment_Request->code->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $Liquidate_Payment_Request->code->EditValue ?>"<?php echo $Liquidate_Payment_Request->code->EditAttributes() ?>>
<?php } ?>
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $Liquidate_Payment_Request->code->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->code->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Liquidate_Payment_Request->financial_year_financial_year_id->Visible) { // financial_year_financial_year_id ?>
		<td<?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->CellAttributes() ?>>
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_financial_year_financial_year_id" name="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_financial_year_financial_year_id" title="<?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->FldTitle() ?>"<?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->EditAttributes() ?>>
<?php
if (is_array($Liquidate_Payment_Request->financial_year_financial_year_id->EditValue)) {
	$arwrk = $Liquidate_Payment_Request->financial_year_financial_year_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Liquidate_Payment_Request->amount->Visible) { // amount ?>
		<td<?php echo $Liquidate_Payment_Request->amount->CellAttributes() ?>>
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_amount" id="x<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>_amount" title="<?php echo $Liquidate_Payment_Request->amount->FldTitle() ?>" size="30" value="<?php echo $Liquidate_Payment_Request->amount->EditValue ?>"<?php echo $Liquidate_Payment_Request->amount->EditAttributes() ?>>
<?php } ?>
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $Liquidate_Payment_Request->amount->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->amount->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Liquidate_Payment_Request_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($Liquidate_Payment_Request->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($Liquidate_Payment_Request->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $Liquidate_Payment_Request_list->lRowIndex ?>">
<?php echo $Liquidate_Payment_Request_list->sMultiSelectKey ?>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($Liquidate_Payment_Request->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($Liquidate_Payment_Request->CurrentAction <> "gridadd" && $Liquidate_Payment_Request->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($Liquidate_Payment_Request_list->Pager)) $Liquidate_Payment_Request_list->Pager = new cPrevNextPager($Liquidate_Payment_Request_list->lStartRec, $Liquidate_Payment_Request_list->lDisplayRecs, $Liquidate_Payment_Request_list->lTotalRecs) ?>
<?php if ($Liquidate_Payment_Request_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Liquidate_Payment_Request_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $Liquidate_Payment_Request_list->PageUrl() ?>start=<?php echo $Liquidate_Payment_Request_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Liquidate_Payment_Request_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $Liquidate_Payment_Request_list->PageUrl() ?>start=<?php echo $Liquidate_Payment_Request_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $Liquidate_Payment_Request_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Liquidate_Payment_Request_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $Liquidate_Payment_Request_list->PageUrl() ?>start=<?php echo $Liquidate_Payment_Request_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Liquidate_Payment_Request_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $Liquidate_Payment_Request_list->PageUrl() ?>start=<?php echo $Liquidate_Payment_Request_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $Liquidate_Payment_Request_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $Liquidate_Payment_Request_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $Liquidate_Payment_Request_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $Liquidate_Payment_Request_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($Liquidate_Payment_Request_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($Liquidate_Payment_Request_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Liquidate_Payment_Request->CurrentAction <> "gridadd" && $Liquidate_Payment_Request->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->CanEdit()) { ?>
<?php if ($Liquidate_Payment_Request_list->lTotalRecs > 0) { ?>
<a href="<?php echo $Liquidate_Payment_Request_list->GridEditUrl ?>"><?php echo $Language->Phrase("GridEditLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($Liquidate_Payment_Request->CurrentAction == "gridedit") { ?>
<a href="" onclick="f=document.fLiquidate_Payment_Requestlist;if(Liquidate_Payment_Request_list.ValidateForm(f))f.submit();return false;"><?php echo $Language->Phrase("GridSaveLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $Liquidate_Payment_Request_list->PageUrl() ?>a=cancel"><?php echo $Language->Phrase("GridCancelLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($Liquidate_Payment_Request->Export == "" && $Liquidate_Payment_Request->CurrentAction == "") { ?>
<?php } ?>
<?php if ($Liquidate_Payment_Request->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$Liquidate_Payment_Request_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cLiquidate_Payment_Request_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'Liquidate Payment Request';

	// Page object name
	var $PageObjName = 'Liquidate_Payment_Request_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $Liquidate_Payment_Request;
		if ($Liquidate_Payment_Request->UseTokenInUrl) $PageUrl .= "t=" . $Liquidate_Payment_Request->TableVar . "&"; // Add page token
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
		global $objForm, $Liquidate_Payment_Request;
		if ($Liquidate_Payment_Request->UseTokenInUrl) {
			if ($objForm)
				return ($Liquidate_Payment_Request->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($Liquidate_Payment_Request->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cLiquidate_Payment_Request_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (Liquidate_Payment_Request)
		$GLOBALS["Liquidate_Payment_Request"] = new cLiquidate_Payment_Request();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["Liquidate_Payment_Request"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "Liquidate_Payment_Requestdelete.php";
		$this->MultiUpdateUrl = "Liquidate_Payment_Requestupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'Liquidate Payment Request', TRUE);

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
		global $Liquidate_Payment_Request;

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
			$Liquidate_Payment_Request->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$Liquidate_Payment_Request->Export = $_POST["exporttype"];
		} else {
			$Liquidate_Payment_Request->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $Liquidate_Payment_Request->Export; // Get export parameter, used in header
		$gsExportFile = $Liquidate_Payment_Request->TableVar; // Get export file, used in header
		if ($Liquidate_Payment_Request->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($Liquidate_Payment_Request->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $Liquidate_Payment_Request;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$Liquidate_Payment_Request->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($Liquidate_Payment_Request->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($Liquidate_Payment_Request->CurrentAction == "gridedit")
					$this->GridEditMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$Liquidate_Payment_Request->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if (($Liquidate_Payment_Request->CurrentAction == "gridupdate" || $Liquidate_Payment_Request->CurrentAction == "gridoverwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
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
			$Liquidate_Payment_Request->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($Liquidate_Payment_Request->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $Liquidate_Payment_Request->getRecordsPerPage(); // Restore from Session
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
		$Liquidate_Payment_Request->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$Liquidate_Payment_Request->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$Liquidate_Payment_Request->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $Liquidate_Payment_Request->getSearchWhere();
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
		$Liquidate_Payment_Request->setSessionWhere($sFilter);
		$Liquidate_Payment_Request->CurrentFilter = "";

		// Export data only
		if (in_array($Liquidate_Payment_Request->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($Liquidate_Payment_Request->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $Liquidate_Payment_Request;
		$Liquidate_Payment_Request->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $Language, $objForm, $gsFormError, $Liquidate_Payment_Request;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();
		$this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateBegin")); // Batch update begin

		// Get old recordset
		$Liquidate_Payment_Request->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $Liquidate_Payment_Request->SQL();
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
					$Liquidate_Payment_Request->SendEmail = FALSE; // Do not send email on update success
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
			$Liquidate_Payment_Request->EventCancelled = TRUE; // Set event cancelled
			$Liquidate_Payment_Request->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $Liquidate_Payment_Request;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $Liquidate_Payment_Request->KeyFilter();
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
		global $Liquidate_Payment_Request;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$Liquidate_Payment_Request->payment_request_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($Liquidate_Payment_Request->payment_request_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $Liquidate_Payment_Request;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($Liquidate_Payment_Request->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($Liquidate_Payment_Request->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($Liquidate_Payment_Request->payment_request_id->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $Liquidate_Payment_Request;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $Liquidate_Payment_Request->payment_request_id, FALSE); // payment_request_id
		$this->BuildSearchSql($sWhere, $Liquidate_Payment_Request->year, FALSE); // year
		$this->BuildSearchSql($sWhere, $Liquidate_Payment_Request->request_date, FALSE); // request_date
		$this->BuildSearchSql($sWhere, $Liquidate_Payment_Request->programarea_id, FALSE); // programarea_id
		$this->BuildSearchSql($sWhere, $Liquidate_Payment_Request->request_status, FALSE); // request_status
		$this->BuildSearchSql($sWhere, $Liquidate_Payment_Request->code, FALSE); // code
		$this->BuildSearchSql($sWhere, $Liquidate_Payment_Request->financial_year_financial_year_id, FALSE); // financial_year_financial_year_id
		$this->BuildSearchSql($sWhere, $Liquidate_Payment_Request->amount, FALSE); // amount
		$this->BuildSearchSql($sWhere, $Liquidate_Payment_Request->group_id, FALSE); // group_id

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($Liquidate_Payment_Request->payment_request_id); // payment_request_id
			$this->SetSearchParm($Liquidate_Payment_Request->year); // year
			$this->SetSearchParm($Liquidate_Payment_Request->request_date); // request_date
			$this->SetSearchParm($Liquidate_Payment_Request->programarea_id); // programarea_id
			$this->SetSearchParm($Liquidate_Payment_Request->request_status); // request_status
			$this->SetSearchParm($Liquidate_Payment_Request->code); // code
			$this->SetSearchParm($Liquidate_Payment_Request->financial_year_financial_year_id); // financial_year_financial_year_id
			$this->SetSearchParm($Liquidate_Payment_Request->amount); // amount
			$this->SetSearchParm($Liquidate_Payment_Request->group_id); // group_id
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
		global $Liquidate_Payment_Request;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$Liquidate_Payment_Request->setAdvancedSearch("x_$FldParm", $FldVal);
		$Liquidate_Payment_Request->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$Liquidate_Payment_Request->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$Liquidate_Payment_Request->setAdvancedSearch("y_$FldParm", $FldVal2);
		$Liquidate_Payment_Request->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $Liquidate_Payment_Request;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $Liquidate_Payment_Request->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $Liquidate_Payment_Request->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $Liquidate_Payment_Request->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $Liquidate_Payment_Request->GetAdvancedSearch("w_$FldParm");
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
		global $Liquidate_Payment_Request;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$Liquidate_Payment_Request->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $Liquidate_Payment_Request;
		$Liquidate_Payment_Request->setAdvancedSearch("x_payment_request_id", "");
		$Liquidate_Payment_Request->setAdvancedSearch("x_year", "");
		$Liquidate_Payment_Request->setAdvancedSearch("x_request_date", "");
		$Liquidate_Payment_Request->setAdvancedSearch("x_programarea_id", "");
		$Liquidate_Payment_Request->setAdvancedSearch("x_request_status", "");
		$Liquidate_Payment_Request->setAdvancedSearch("x_code", "");
		$Liquidate_Payment_Request->setAdvancedSearch("x_financial_year_financial_year_id", "");
		$Liquidate_Payment_Request->setAdvancedSearch("x_amount", "");
		$Liquidate_Payment_Request->setAdvancedSearch("x_group_id", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $Liquidate_Payment_Request;
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
			$this->GetSearchParm($Liquidate_Payment_Request->payment_request_id);
			$this->GetSearchParm($Liquidate_Payment_Request->year);
			$this->GetSearchParm($Liquidate_Payment_Request->request_date);
			$this->GetSearchParm($Liquidate_Payment_Request->programarea_id);
			$this->GetSearchParm($Liquidate_Payment_Request->request_status);
			$this->GetSearchParm($Liquidate_Payment_Request->code);
			$this->GetSearchParm($Liquidate_Payment_Request->financial_year_financial_year_id);
			$this->GetSearchParm($Liquidate_Payment_Request->amount);
			$this->GetSearchParm($Liquidate_Payment_Request->group_id);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $Liquidate_Payment_Request;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$Liquidate_Payment_Request->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$Liquidate_Payment_Request->CurrentOrderType = @$_GET["ordertype"];
			$Liquidate_Payment_Request->UpdateSort($Liquidate_Payment_Request->payment_request_id); // payment_request_id
			$Liquidate_Payment_Request->UpdateSort($Liquidate_Payment_Request->year); // year
			$Liquidate_Payment_Request->UpdateSort($Liquidate_Payment_Request->request_date); // request_date
			$Liquidate_Payment_Request->UpdateSort($Liquidate_Payment_Request->programarea_id); // programarea_id
			$Liquidate_Payment_Request->UpdateSort($Liquidate_Payment_Request->request_status); // request_status
			$Liquidate_Payment_Request->UpdateSort($Liquidate_Payment_Request->code); // code
			$Liquidate_Payment_Request->UpdateSort($Liquidate_Payment_Request->financial_year_financial_year_id); // financial_year_financial_year_id
			$Liquidate_Payment_Request->UpdateSort($Liquidate_Payment_Request->amount); // amount
			$Liquidate_Payment_Request->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $Liquidate_Payment_Request;
		$sOrderBy = $Liquidate_Payment_Request->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($Liquidate_Payment_Request->SqlOrderBy() <> "") {
				$sOrderBy = $Liquidate_Payment_Request->SqlOrderBy();
				$Liquidate_Payment_Request->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $Liquidate_Payment_Request;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$Liquidate_Payment_Request->setSessionOrderBy($sOrderBy);
				$Liquidate_Payment_Request->payment_request_id->setSort("");
				$Liquidate_Payment_Request->year->setSort("");
				$Liquidate_Payment_Request->request_date->setSort("");
				$Liquidate_Payment_Request->programarea_id->setSort("");
				$Liquidate_Payment_Request->request_status->setSort("");
				$Liquidate_Payment_Request->code->setSort("");
				$Liquidate_Payment_Request->financial_year_financial_year_id->setSort("");
				$Liquidate_Payment_Request->amount->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$Liquidate_Payment_Request->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Liquidate_Payment_Request;

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
		if ($Liquidate_Payment_Request->Export <> "" ||
			$Liquidate_Payment_Request->CurrentAction == "gridadd" ||
			$Liquidate_Payment_Request->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $Liquidate_Payment_Request;
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
		if ($Liquidate_Payment_Request->CurrentAction == "gridedit")
			$this->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->lRowIndex . "_key\" id=\"k" . $this->lRowIndex . "_key\" value=\"" . $Liquidate_Payment_Request->payment_request_id->CurrentValue . "\">";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $Liquidate_Payment_Request;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $Liquidate_Payment_Request;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$Liquidate_Payment_Request->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$Liquidate_Payment_Request->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $Liquidate_Payment_Request->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$Liquidate_Payment_Request->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$Liquidate_Payment_Request->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$Liquidate_Payment_Request->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $Liquidate_Payment_Request;

		// Load search values
		// payment_request_id

		$Liquidate_Payment_Request->payment_request_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_payment_request_id"]);
		$Liquidate_Payment_Request->payment_request_id->AdvancedSearch->SearchOperator = @$_GET["z_payment_request_id"];

		// year
		$Liquidate_Payment_Request->year->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_year"]);
		$Liquidate_Payment_Request->year->AdvancedSearch->SearchOperator = @$_GET["z_year"];

		// request_date
		$Liquidate_Payment_Request->request_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_request_date"]);
		$Liquidate_Payment_Request->request_date->AdvancedSearch->SearchOperator = @$_GET["z_request_date"];

		// programarea_id
		$Liquidate_Payment_Request->programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programarea_id"]);
		$Liquidate_Payment_Request->programarea_id->AdvancedSearch->SearchOperator = @$_GET["z_programarea_id"];

		// request_status
		$Liquidate_Payment_Request->request_status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_request_status"]);
		$Liquidate_Payment_Request->request_status->AdvancedSearch->SearchOperator = @$_GET["z_request_status"];

		// code
		$Liquidate_Payment_Request->code->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_code"]);
		$Liquidate_Payment_Request->code->AdvancedSearch->SearchOperator = @$_GET["z_code"];

		// financial_year_financial_year_id
		$Liquidate_Payment_Request->financial_year_financial_year_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_financial_year_financial_year_id"]);
		$Liquidate_Payment_Request->financial_year_financial_year_id->AdvancedSearch->SearchOperator = @$_GET["z_financial_year_financial_year_id"];

		// amount
		$Liquidate_Payment_Request->amount->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_amount"]);
		$Liquidate_Payment_Request->amount->AdvancedSearch->SearchOperator = @$_GET["z_amount"];

		// group_id
		$Liquidate_Payment_Request->group_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_group_id"]);
		$Liquidate_Payment_Request->group_id->AdvancedSearch->SearchOperator = @$_GET["z_group_id"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $Liquidate_Payment_Request;
		$Liquidate_Payment_Request->payment_request_id->setFormValue($objForm->GetValue("x_payment_request_id"));
		$Liquidate_Payment_Request->year->setFormValue($objForm->GetValue("x_year"));
		$Liquidate_Payment_Request->request_date->setFormValue($objForm->GetValue("x_request_date"));
		$Liquidate_Payment_Request->request_date->CurrentValue = ew_UnFormatDateTime($Liquidate_Payment_Request->request_date->CurrentValue, 7);
		$Liquidate_Payment_Request->programarea_id->setFormValue($objForm->GetValue("x_programarea_id"));
		$Liquidate_Payment_Request->request_status->setFormValue($objForm->GetValue("x_request_status"));
		$Liquidate_Payment_Request->code->setFormValue($objForm->GetValue("x_code"));
		$Liquidate_Payment_Request->financial_year_financial_year_id->setFormValue($objForm->GetValue("x_financial_year_financial_year_id"));
		$Liquidate_Payment_Request->amount->setFormValue($objForm->GetValue("x_amount"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $Liquidate_Payment_Request;
		$Liquidate_Payment_Request->payment_request_id->CurrentValue = $Liquidate_Payment_Request->payment_request_id->FormValue;
		$Liquidate_Payment_Request->year->CurrentValue = $Liquidate_Payment_Request->year->FormValue;
		$Liquidate_Payment_Request->request_date->CurrentValue = $Liquidate_Payment_Request->request_date->FormValue;
		$Liquidate_Payment_Request->request_date->CurrentValue = ew_UnFormatDateTime($Liquidate_Payment_Request->request_date->CurrentValue, 7);
		$Liquidate_Payment_Request->programarea_id->CurrentValue = $Liquidate_Payment_Request->programarea_id->FormValue;
		$Liquidate_Payment_Request->request_status->CurrentValue = $Liquidate_Payment_Request->request_status->FormValue;
		$Liquidate_Payment_Request->code->CurrentValue = $Liquidate_Payment_Request->code->FormValue;
		$Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue = $Liquidate_Payment_Request->financial_year_financial_year_id->FormValue;
		$Liquidate_Payment_Request->amount->CurrentValue = $Liquidate_Payment_Request->amount->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $Liquidate_Payment_Request;

		// Call Recordset Selecting event
		$Liquidate_Payment_Request->Recordset_Selecting($Liquidate_Payment_Request->CurrentFilter);

		// Load List page SQL
		$sSql = $Liquidate_Payment_Request->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$Liquidate_Payment_Request->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $Liquidate_Payment_Request;
		$sFilter = $Liquidate_Payment_Request->KeyFilter();

		// Call Row Selecting event
		$Liquidate_Payment_Request->Row_Selecting($sFilter);

		// Load SQL based on filter
		$Liquidate_Payment_Request->CurrentFilter = $sFilter;
		$sSql = $Liquidate_Payment_Request->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$Liquidate_Payment_Request->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $Liquidate_Payment_Request;
		$Liquidate_Payment_Request->payment_request_id->setDbValue($rs->fields('payment_request_id'));
		$Liquidate_Payment_Request->year->setDbValue($rs->fields('year'));
		$Liquidate_Payment_Request->request_date->setDbValue($rs->fields('request_date'));
		$Liquidate_Payment_Request->programarea_id->setDbValue($rs->fields('programarea_id'));
		$Liquidate_Payment_Request->request_status->setDbValue($rs->fields('request_status'));
		$Liquidate_Payment_Request->code->setDbValue($rs->fields('code'));
		$Liquidate_Payment_Request->financial_year_financial_year_id->setDbValue($rs->fields('financial_year_financial_year_id'));
		$Liquidate_Payment_Request->amount->setDbValue($rs->fields('amount'));
		$Liquidate_Payment_Request->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $Liquidate_Payment_Request;

		// Initialize URLs
		$this->ViewUrl = $Liquidate_Payment_Request->ViewUrl();
		$this->EditUrl = $Liquidate_Payment_Request->EditUrl();
		$this->InlineEditUrl = $Liquidate_Payment_Request->InlineEditUrl();
		$this->CopyUrl = $Liquidate_Payment_Request->CopyUrl();
		$this->InlineCopyUrl = $Liquidate_Payment_Request->InlineCopyUrl();
		$this->DeleteUrl = $Liquidate_Payment_Request->DeleteUrl();

		// Call Row_Rendering event
		$Liquidate_Payment_Request->Row_Rendering();

		// Common render codes for all row types
		// payment_request_id

		$Liquidate_Payment_Request->payment_request_id->CellCssStyle = ""; $Liquidate_Payment_Request->payment_request_id->CellCssClass = "";
		$Liquidate_Payment_Request->payment_request_id->CellAttrs = array(); $Liquidate_Payment_Request->payment_request_id->ViewAttrs = array(); $Liquidate_Payment_Request->payment_request_id->EditAttrs = array();

		// year
		$Liquidate_Payment_Request->year->CellCssStyle = ""; $Liquidate_Payment_Request->year->CellCssClass = "";
		$Liquidate_Payment_Request->year->CellAttrs = array(); $Liquidate_Payment_Request->year->ViewAttrs = array(); $Liquidate_Payment_Request->year->EditAttrs = array();

		// request_date
		$Liquidate_Payment_Request->request_date->CellCssStyle = ""; $Liquidate_Payment_Request->request_date->CellCssClass = "";
		$Liquidate_Payment_Request->request_date->CellAttrs = array(); $Liquidate_Payment_Request->request_date->ViewAttrs = array(); $Liquidate_Payment_Request->request_date->EditAttrs = array();

		// programarea_id
		$Liquidate_Payment_Request->programarea_id->CellCssStyle = ""; $Liquidate_Payment_Request->programarea_id->CellCssClass = "";
		$Liquidate_Payment_Request->programarea_id->CellAttrs = array(); $Liquidate_Payment_Request->programarea_id->ViewAttrs = array(); $Liquidate_Payment_Request->programarea_id->EditAttrs = array();

		// request_status
		$Liquidate_Payment_Request->request_status->CellCssStyle = ""; $Liquidate_Payment_Request->request_status->CellCssClass = "";
		$Liquidate_Payment_Request->request_status->CellAttrs = array(); $Liquidate_Payment_Request->request_status->ViewAttrs = array(); $Liquidate_Payment_Request->request_status->EditAttrs = array();

		// code
		$Liquidate_Payment_Request->code->CellCssStyle = ""; $Liquidate_Payment_Request->code->CellCssClass = "";
		$Liquidate_Payment_Request->code->CellAttrs = array(); $Liquidate_Payment_Request->code->ViewAttrs = array(); $Liquidate_Payment_Request->code->EditAttrs = array();

		// financial_year_financial_year_id
		$Liquidate_Payment_Request->financial_year_financial_year_id->CellCssStyle = ""; $Liquidate_Payment_Request->financial_year_financial_year_id->CellCssClass = "";
		$Liquidate_Payment_Request->financial_year_financial_year_id->CellAttrs = array(); $Liquidate_Payment_Request->financial_year_financial_year_id->ViewAttrs = array(); $Liquidate_Payment_Request->financial_year_financial_year_id->EditAttrs = array();

		// amount
		$Liquidate_Payment_Request->amount->CellCssStyle = ""; $Liquidate_Payment_Request->amount->CellCssClass = "";
		$Liquidate_Payment_Request->amount->CellAttrs = array(); $Liquidate_Payment_Request->amount->ViewAttrs = array(); $Liquidate_Payment_Request->amount->EditAttrs = array();
		if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$Liquidate_Payment_Request->payment_request_id->ViewValue = $Liquidate_Payment_Request->payment_request_id->CurrentValue;
			$Liquidate_Payment_Request->payment_request_id->CssStyle = "";
			$Liquidate_Payment_Request->payment_request_id->CssClass = "";
			$Liquidate_Payment_Request->payment_request_id->ViewCustomAttributes = "";

			// year
			$Liquidate_Payment_Request->year->ViewValue = $Liquidate_Payment_Request->year->CurrentValue;
			$Liquidate_Payment_Request->year->CssStyle = "";
			$Liquidate_Payment_Request->year->CssClass = "";
			$Liquidate_Payment_Request->year->ViewCustomAttributes = "";

			// request_date
			$Liquidate_Payment_Request->request_date->ViewValue = $Liquidate_Payment_Request->request_date->CurrentValue;
			$Liquidate_Payment_Request->request_date->ViewValue = ew_FormatDateTime($Liquidate_Payment_Request->request_date->ViewValue, 7);
			$Liquidate_Payment_Request->request_date->CssStyle = "";
			$Liquidate_Payment_Request->request_date->CssClass = "";
			$Liquidate_Payment_Request->request_date->ViewCustomAttributes = "";

			// programarea_id
			if (strval($Liquidate_Payment_Request->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Liquidate_Payment_Request->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Liquidate_Payment_Request->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Liquidate_Payment_Request->programarea_id->ViewValue = $Liquidate_Payment_Request->programarea_id->CurrentValue;
				}
			} else {
				$Liquidate_Payment_Request->programarea_id->ViewValue = NULL;
			}
			$Liquidate_Payment_Request->programarea_id->CssStyle = "";
			$Liquidate_Payment_Request->programarea_id->CssClass = "";
			$Liquidate_Payment_Request->programarea_id->ViewCustomAttributes = "";

			// request_status
			if (strval($Liquidate_Payment_Request->request_status->CurrentValue) <> "") {
				switch ($Liquidate_Payment_Request->request_status->CurrentValue) {
					case "NEWREQ":
						$Liquidate_Payment_Request->request_status->ViewValue = "NEWREQ";
						break;
					case "REQUESTED":
						$Liquidate_Payment_Request->request_status->ViewValue = "REQUESTED";
						break;
					case "DISBURSED":
						$Liquidate_Payment_Request->request_status->ViewValue = "DISBURSED";
						break;
					case "LIQUIDATED":
						$Liquidate_Payment_Request->request_status->ViewValue = "LIQUIDATED";
						break;
					default:
						$Liquidate_Payment_Request->request_status->ViewValue = $Liquidate_Payment_Request->request_status->CurrentValue;
				}
			} else {
				$Liquidate_Payment_Request->request_status->ViewValue = NULL;
			}
			$Liquidate_Payment_Request->request_status->CssStyle = "";
			$Liquidate_Payment_Request->request_status->CssClass = "";
			$Liquidate_Payment_Request->request_status->ViewCustomAttributes = "";

			// code
			$Liquidate_Payment_Request->code->ViewValue = $Liquidate_Payment_Request->code->CurrentValue;
			$Liquidate_Payment_Request->code->CssStyle = "";
			$Liquidate_Payment_Request->code->CssClass = "";
			$Liquidate_Payment_Request->code->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			if (strval($Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Liquidate_Payment_Request->financial_year_financial_year_id->ViewValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$Liquidate_Payment_Request->financial_year_financial_year_id->ViewValue = $Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$Liquidate_Payment_Request->financial_year_financial_year_id->ViewValue = NULL;
			}
			$Liquidate_Payment_Request->financial_year_financial_year_id->CssStyle = "";
			$Liquidate_Payment_Request->financial_year_financial_year_id->CssClass = "";
			$Liquidate_Payment_Request->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$Liquidate_Payment_Request->amount->ViewValue = $Liquidate_Payment_Request->amount->CurrentValue;
			$Liquidate_Payment_Request->amount->CssStyle = "";
			$Liquidate_Payment_Request->amount->CssClass = "";
			$Liquidate_Payment_Request->amount->ViewCustomAttributes = "";

			// group_id
			$Liquidate_Payment_Request->group_id->ViewValue = $Liquidate_Payment_Request->group_id->CurrentValue;
			$Liquidate_Payment_Request->group_id->CssStyle = "";
			$Liquidate_Payment_Request->group_id->CssClass = "";
			$Liquidate_Payment_Request->group_id->ViewCustomAttributes = "";

			// payment_request_id
			$Liquidate_Payment_Request->payment_request_id->HrefValue = "";
			$Liquidate_Payment_Request->payment_request_id->TooltipValue = "";

			// year
			$Liquidate_Payment_Request->year->HrefValue = "";
			$Liquidate_Payment_Request->year->TooltipValue = "";

			// request_date
			$Liquidate_Payment_Request->request_date->HrefValue = "";
			$Liquidate_Payment_Request->request_date->TooltipValue = "";

			// programarea_id
			$Liquidate_Payment_Request->programarea_id->HrefValue = "";
			$Liquidate_Payment_Request->programarea_id->TooltipValue = "";

			// request_status
			$Liquidate_Payment_Request->request_status->HrefValue = "";
			$Liquidate_Payment_Request->request_status->TooltipValue = "";

			// code
			$Liquidate_Payment_Request->code->HrefValue = "";
			$Liquidate_Payment_Request->code->TooltipValue = "";

			// financial_year_financial_year_id
			$Liquidate_Payment_Request->financial_year_financial_year_id->HrefValue = "";
			$Liquidate_Payment_Request->financial_year_financial_year_id->TooltipValue = "";

			// amount
			$Liquidate_Payment_Request->amount->HrefValue = "";
			$Liquidate_Payment_Request->amount->TooltipValue = "";
		} elseif ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// payment_request_id
			$Liquidate_Payment_Request->payment_request_id->EditCustomAttributes = "";
			$Liquidate_Payment_Request->payment_request_id->EditValue = $Liquidate_Payment_Request->payment_request_id->CurrentValue;
			$Liquidate_Payment_Request->payment_request_id->CssStyle = "";
			$Liquidate_Payment_Request->payment_request_id->CssClass = "";
			$Liquidate_Payment_Request->payment_request_id->ViewCustomAttributes = "";

			// year
			$Liquidate_Payment_Request->year->EditCustomAttributes = "";
			$Liquidate_Payment_Request->year->EditValue = $Liquidate_Payment_Request->year->CurrentValue;
			$Liquidate_Payment_Request->year->CssStyle = "";
			$Liquidate_Payment_Request->year->CssClass = "";
			$Liquidate_Payment_Request->year->ViewCustomAttributes = "";

			// request_date
			$Liquidate_Payment_Request->request_date->EditCustomAttributes = "";
			$Liquidate_Payment_Request->request_date->EditValue = $Liquidate_Payment_Request->request_date->CurrentValue;
			$Liquidate_Payment_Request->request_date->EditValue = ew_FormatDateTime($Liquidate_Payment_Request->request_date->EditValue, 7);
			$Liquidate_Payment_Request->request_date->CssStyle = "";
			$Liquidate_Payment_Request->request_date->CssClass = "";
			$Liquidate_Payment_Request->request_date->ViewCustomAttributes = "";

			// programarea_id
			$Liquidate_Payment_Request->programarea_id->EditCustomAttributes = "";
			if (strval($Liquidate_Payment_Request->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Liquidate_Payment_Request->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Liquidate_Payment_Request->programarea_id->EditValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Liquidate_Payment_Request->programarea_id->EditValue = $Liquidate_Payment_Request->programarea_id->CurrentValue;
				}
			} else {
				$Liquidate_Payment_Request->programarea_id->EditValue = NULL;
			}
			$Liquidate_Payment_Request->programarea_id->CssStyle = "";
			$Liquidate_Payment_Request->programarea_id->CssClass = "";
			$Liquidate_Payment_Request->programarea_id->ViewCustomAttributes = "";

			// request_status
			$Liquidate_Payment_Request->request_status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("NEWREQ", "NEWREQ");
			$arwrk[] = array("REQUESTED", "REQUESTED");
			$arwrk[] = array("DISBURSED", "DISBURSED");
			$arwrk[] = array("LIQUIDATED", "LIQUIDATED");
			$Liquidate_Payment_Request->request_status->EditValue = $arwrk;

			// code
			$Liquidate_Payment_Request->code->EditCustomAttributes = "";
			$Liquidate_Payment_Request->code->EditValue = ew_HtmlEncode($Liquidate_Payment_Request->code->CurrentValue);

			// financial_year_financial_year_id
			$Liquidate_Payment_Request->financial_year_financial_year_id->EditCustomAttributes = "";
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
			$Liquidate_Payment_Request->financial_year_financial_year_id->EditValue = $arwrk;

			// amount
			$Liquidate_Payment_Request->amount->EditCustomAttributes = "";
			$Liquidate_Payment_Request->amount->EditValue = ew_HtmlEncode($Liquidate_Payment_Request->amount->CurrentValue);

			// Edit refer script
			// payment_request_id

			$Liquidate_Payment_Request->payment_request_id->HrefValue = "";

			// year
			$Liquidate_Payment_Request->year->HrefValue = "";

			// request_date
			$Liquidate_Payment_Request->request_date->HrefValue = "";

			// programarea_id
			$Liquidate_Payment_Request->programarea_id->HrefValue = "";

			// request_status
			$Liquidate_Payment_Request->request_status->HrefValue = "";

			// code
			$Liquidate_Payment_Request->code->HrefValue = "";

			// financial_year_financial_year_id
			$Liquidate_Payment_Request->financial_year_financial_year_id->HrefValue = "";

			// amount
			$Liquidate_Payment_Request->amount->HrefValue = "";
		}

		// Call Row Rendered event
		if ($Liquidate_Payment_Request->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$Liquidate_Payment_Request->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $Liquidate_Payment_Request;

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
		global $Language, $gsFormError, $Liquidate_Payment_Request;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($Liquidate_Payment_Request->financial_year_financial_year_id->FormValue) && $Liquidate_Payment_Request->financial_year_financial_year_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $Liquidate_Payment_Request->financial_year_financial_year_id->FldCaption();
		}
		if (!ew_CheckInteger($Liquidate_Payment_Request->amount->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $Liquidate_Payment_Request->amount->FldErrMsg();
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
		global $conn, $Security, $Language, $Liquidate_Payment_Request;
		$sFilter = $Liquidate_Payment_Request->KeyFilter();
		$Liquidate_Payment_Request->CurrentFilter = $sFilter;
		$sSql = $Liquidate_Payment_Request->SQL();
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

			// request_status
			$Liquidate_Payment_Request->request_status->SetDbValueDef($rsnew, $Liquidate_Payment_Request->request_status->CurrentValue, NULL, FALSE);

			// code
			$Liquidate_Payment_Request->code->SetDbValueDef($rsnew, $Liquidate_Payment_Request->code->CurrentValue, NULL, FALSE);

			// financial_year_financial_year_id
			$Liquidate_Payment_Request->financial_year_financial_year_id->SetDbValueDef($rsnew, $Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue, 0, FALSE);

			// amount
			$Liquidate_Payment_Request->amount->SetDbValueDef($rsnew, $Liquidate_Payment_Request->amount->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $Liquidate_Payment_Request->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($Liquidate_Payment_Request->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($Liquidate_Payment_Request->CancelMessage <> "") {
					$this->setMessage($Liquidate_Payment_Request->CancelMessage);
					$Liquidate_Payment_Request->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$Liquidate_Payment_Request->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $Liquidate_Payment_Request;
		$Liquidate_Payment_Request->payment_request_id->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_payment_request_id");
		$Liquidate_Payment_Request->year->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_year");
		$Liquidate_Payment_Request->request_date->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_request_date");
		$Liquidate_Payment_Request->programarea_id->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_programarea_id");
		$Liquidate_Payment_Request->request_status->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_request_status");
		$Liquidate_Payment_Request->code->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_code");
		$Liquidate_Payment_Request->financial_year_financial_year_id->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_financial_year_financial_year_id");
		$Liquidate_Payment_Request->amount->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_amount");
		$Liquidate_Payment_Request->group_id->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_group_id");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $Liquidate_Payment_Request;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $Liquidate_Payment_Request->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($Liquidate_Payment_Request->ExportAll) {
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
		if ($Liquidate_Payment_Request->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($Liquidate_Payment_Request, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($Liquidate_Payment_Request->payment_request_id);
				$ExportDoc->ExportCaption($Liquidate_Payment_Request->year);
				$ExportDoc->ExportCaption($Liquidate_Payment_Request->request_date);
				$ExportDoc->ExportCaption($Liquidate_Payment_Request->programarea_id);
				$ExportDoc->ExportCaption($Liquidate_Payment_Request->request_status);
				$ExportDoc->ExportCaption($Liquidate_Payment_Request->code);
				$ExportDoc->ExportCaption($Liquidate_Payment_Request->financial_year_financial_year_id);
				$ExportDoc->ExportCaption($Liquidate_Payment_Request->amount);
				$ExportDoc->ExportCaption($Liquidate_Payment_Request->group_id);
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
				$Liquidate_Payment_Request->CssClass = "";
				$Liquidate_Payment_Request->CssStyle = "";
				$Liquidate_Payment_Request->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($Liquidate_Payment_Request->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('payment_request_id', $Liquidate_Payment_Request->payment_request_id->ExportValue($Liquidate_Payment_Request->Export, $Liquidate_Payment_Request->ExportOriginalValue));
					$XmlDoc->AddField('year', $Liquidate_Payment_Request->year->ExportValue($Liquidate_Payment_Request->Export, $Liquidate_Payment_Request->ExportOriginalValue));
					$XmlDoc->AddField('request_date', $Liquidate_Payment_Request->request_date->ExportValue($Liquidate_Payment_Request->Export, $Liquidate_Payment_Request->ExportOriginalValue));
					$XmlDoc->AddField('programarea_id', $Liquidate_Payment_Request->programarea_id->ExportValue($Liquidate_Payment_Request->Export, $Liquidate_Payment_Request->ExportOriginalValue));
					$XmlDoc->AddField('request_status', $Liquidate_Payment_Request->request_status->ExportValue($Liquidate_Payment_Request->Export, $Liquidate_Payment_Request->ExportOriginalValue));
					$XmlDoc->AddField('code', $Liquidate_Payment_Request->code->ExportValue($Liquidate_Payment_Request->Export, $Liquidate_Payment_Request->ExportOriginalValue));
					$XmlDoc->AddField('financial_year_financial_year_id', $Liquidate_Payment_Request->financial_year_financial_year_id->ExportValue($Liquidate_Payment_Request->Export, $Liquidate_Payment_Request->ExportOriginalValue));
					$XmlDoc->AddField('amount', $Liquidate_Payment_Request->amount->ExportValue($Liquidate_Payment_Request->Export, $Liquidate_Payment_Request->ExportOriginalValue));
					$XmlDoc->AddField('group_id', $Liquidate_Payment_Request->group_id->ExportValue($Liquidate_Payment_Request->Export, $Liquidate_Payment_Request->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($Liquidate_Payment_Request->payment_request_id);
					$ExportDoc->ExportField($Liquidate_Payment_Request->year);
					$ExportDoc->ExportField($Liquidate_Payment_Request->request_date);
					$ExportDoc->ExportField($Liquidate_Payment_Request->programarea_id);
					$ExportDoc->ExportField($Liquidate_Payment_Request->request_status);
					$ExportDoc->ExportField($Liquidate_Payment_Request->code);
					$ExportDoc->ExportField($Liquidate_Payment_Request->financial_year_financial_year_id);
					$ExportDoc->ExportField($Liquidate_Payment_Request->amount);
					$ExportDoc->ExportField($Liquidate_Payment_Request->group_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($Liquidate_Payment_Request->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($Liquidate_Payment_Request->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($Liquidate_Payment_Request->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($Liquidate_Payment_Request->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($Liquidate_Payment_Request->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $Liquidate_Payment_Request;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($Liquidate_Payment_Request->group_id->CurrentValue);
			}
		}
		return TRUE;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'Liquidate Payment Request';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $Liquidate_Payment_Request;
		$table = 'Liquidate Payment Request';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['payment_request_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if ($Liquidate_Payment_Request->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($Liquidate_Payment_Request->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($Liquidate_Payment_Request->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						$oldvalue = "<MEMO>";
						$newvalue = "<MEMO>";
					} elseif ($Liquidate_Payment_Request->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
