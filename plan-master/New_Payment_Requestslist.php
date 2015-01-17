<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "New_Payment_Requestsinfo.php" ?>
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
$New_Payment_Requests_list = new cNew_Payment_Requests_list();
$Page =& $New_Payment_Requests_list;

// Page init
$New_Payment_Requests_list->Page_Init();

// Page main
$New_Payment_Requests_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($New_Payment_Requests->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var New_Payment_Requests_list = new ew_Page("New_Payment_Requests_list");

// page properties
New_Payment_Requests_list.PageID = "list"; // page ID
New_Payment_Requests_list.FormID = "fNew_Payment_Requestslist"; // form ID
var EW_PAGE_ID = New_Payment_Requests_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
New_Payment_Requests_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
New_Payment_Requests_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
New_Payment_Requests_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($New_Payment_Requests->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$New_Payment_Requests_list->lTotalRecs = $New_Payment_Requests->SelectRecordCount();
	} else {
		if ($rs = $New_Payment_Requests_list->LoadRecordset())
			$New_Payment_Requests_list->lTotalRecs = $rs->RecordCount();
	}
	$New_Payment_Requests_list->lStartRec = 1;
	if ($New_Payment_Requests_list->lDisplayRecs <= 0 || ($New_Payment_Requests->Export <> "" && $New_Payment_Requests->ExportAll)) // Display all records
		$New_Payment_Requests_list->lDisplayRecs = $New_Payment_Requests_list->lTotalRecs;
	if (!($New_Payment_Requests->Export <> "" && $New_Payment_Requests->ExportAll))
		$New_Payment_Requests_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $New_Payment_Requests_list->LoadRecordset($New_Payment_Requests_list->lStartRec-1, $New_Payment_Requests_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $New_Payment_Requests->TableCaption() ?>
<?php if ($New_Payment_Requests->Export == "" && $New_Payment_Requests->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $New_Payment_Requests_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $New_Payment_Requests_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $New_Payment_Requests_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($New_Payment_Requests->Export == "" && $New_Payment_Requests->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(New_Payment_Requests_list);" style="text-decoration: none;"><img id="New_Payment_Requests_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="New_Payment_Requests_list_SearchPanel">
<form name="fNew_Payment_Requestslistsrch" id="fNew_Payment_Requestslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="New_Payment_Requests">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($New_Payment_Requests->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $New_Payment_Requests_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="New_Payment_Requestssrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($New_Payment_Requests->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($New_Payment_Requests->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($New_Payment_Requests->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$New_Payment_Requests_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fNew_Payment_Requestslist" id="fNew_Payment_Requestslist" class="ewForm" action="" method="post">
<div id="gmp_New_Payment_Requests" class="ewGridMiddlePanel">
<?php if ($New_Payment_Requests_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $New_Payment_Requests->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$New_Payment_Requests_list->RenderListOptions();

// Render list options (header, left)
$New_Payment_Requests_list->ListOptions->Render("header", "left");
?>
<?php if ($New_Payment_Requests->payment_request_id->Visible) { // payment_request_id ?>
	<?php if ($New_Payment_Requests->SortUrl($New_Payment_Requests->payment_request_id) == "") { ?>
		<td><?php echo $New_Payment_Requests->payment_request_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $New_Payment_Requests->SortUrl($New_Payment_Requests->payment_request_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $New_Payment_Requests->payment_request_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($New_Payment_Requests->payment_request_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($New_Payment_Requests->payment_request_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($New_Payment_Requests->year->Visible) { // year ?>
	<?php if ($New_Payment_Requests->SortUrl($New_Payment_Requests->year) == "") { ?>
		<td><?php echo $New_Payment_Requests->year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $New_Payment_Requests->SortUrl($New_Payment_Requests->year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $New_Payment_Requests->year->FldCaption() ?></td><td style="width: 10px;"><?php if ($New_Payment_Requests->year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($New_Payment_Requests->year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($New_Payment_Requests->request_date->Visible) { // request_date ?>
	<?php if ($New_Payment_Requests->SortUrl($New_Payment_Requests->request_date) == "") { ?>
		<td><?php echo $New_Payment_Requests->request_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $New_Payment_Requests->SortUrl($New_Payment_Requests->request_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $New_Payment_Requests->request_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($New_Payment_Requests->request_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($New_Payment_Requests->request_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($New_Payment_Requests->programarea_id->Visible) { // programarea_id ?>
	<?php if ($New_Payment_Requests->SortUrl($New_Payment_Requests->programarea_id) == "") { ?>
		<td><?php echo $New_Payment_Requests->programarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $New_Payment_Requests->SortUrl($New_Payment_Requests->programarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $New_Payment_Requests->programarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($New_Payment_Requests->programarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($New_Payment_Requests->programarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($New_Payment_Requests->request_status->Visible) { // request_status ?>
	<?php if ($New_Payment_Requests->SortUrl($New_Payment_Requests->request_status) == "") { ?>
		<td><?php echo $New_Payment_Requests->request_status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $New_Payment_Requests->SortUrl($New_Payment_Requests->request_status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $New_Payment_Requests->request_status->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($New_Payment_Requests->request_status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($New_Payment_Requests->request_status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($New_Payment_Requests->code->Visible) { // code ?>
	<?php if ($New_Payment_Requests->SortUrl($New_Payment_Requests->code) == "") { ?>
		<td><?php echo $New_Payment_Requests->code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $New_Payment_Requests->SortUrl($New_Payment_Requests->code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $New_Payment_Requests->code->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($New_Payment_Requests->code->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($New_Payment_Requests->code->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$New_Payment_Requests_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($New_Payment_Requests->ExportAll && $New_Payment_Requests->Export <> "") {
	$New_Payment_Requests_list->lStopRec = $New_Payment_Requests_list->lTotalRecs;
} else {
	$New_Payment_Requests_list->lStopRec = $New_Payment_Requests_list->lStartRec + $New_Payment_Requests_list->lDisplayRecs - 1; // Set the last record to display
}
$New_Payment_Requests_list->lRecCount = $New_Payment_Requests_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $New_Payment_Requests_list->lStartRec > 1)
		$rs->Move($New_Payment_Requests_list->lStartRec - 1);
}

// Initialize aggregate
$New_Payment_Requests->RowType = EW_ROWTYPE_AGGREGATEINIT;
$New_Payment_Requests_list->RenderRow();
$New_Payment_Requests_list->lRowCnt = 0;
while (($New_Payment_Requests->CurrentAction == "gridadd" || !$rs->EOF) &&
	$New_Payment_Requests_list->lRecCount < $New_Payment_Requests_list->lStopRec) {
	$New_Payment_Requests_list->lRecCount++;
	if (intval($New_Payment_Requests_list->lRecCount) >= intval($New_Payment_Requests_list->lStartRec)) {
		$New_Payment_Requests_list->lRowCnt++;

	// Init row class and style
	$New_Payment_Requests->CssClass = "";
	$New_Payment_Requests->CssStyle = "";
	$New_Payment_Requests->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($New_Payment_Requests->CurrentAction == "gridadd") {
		$New_Payment_Requests_list->LoadDefaultValues(); // Load default values
	} else {
		$New_Payment_Requests_list->LoadRowValues($rs); // Load row values
	}
	$New_Payment_Requests->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$New_Payment_Requests_list->RenderRow();

	// Render list options
	$New_Payment_Requests_list->RenderListOptions();
?>
	<tr<?php echo $New_Payment_Requests->RowAttributes() ?>>
<?php

// Render list options (body, left)
$New_Payment_Requests_list->ListOptions->Render("body", "left");
?>
	<?php if ($New_Payment_Requests->payment_request_id->Visible) { // payment_request_id ?>
		<td<?php echo $New_Payment_Requests->payment_request_id->CellAttributes() ?>>
<div<?php echo $New_Payment_Requests->payment_request_id->ViewAttributes() ?>><?php echo $New_Payment_Requests->payment_request_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($New_Payment_Requests->year->Visible) { // year ?>
		<td<?php echo $New_Payment_Requests->year->CellAttributes() ?>>
<div<?php echo $New_Payment_Requests->year->ViewAttributes() ?>><?php echo $New_Payment_Requests->year->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($New_Payment_Requests->request_date->Visible) { // request_date ?>
		<td<?php echo $New_Payment_Requests->request_date->CellAttributes() ?>>
<div<?php echo $New_Payment_Requests->request_date->ViewAttributes() ?>><?php echo $New_Payment_Requests->request_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($New_Payment_Requests->programarea_id->Visible) { // programarea_id ?>
		<td<?php echo $New_Payment_Requests->programarea_id->CellAttributes() ?>>
<div<?php echo $New_Payment_Requests->programarea_id->ViewAttributes() ?>><?php echo $New_Payment_Requests->programarea_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($New_Payment_Requests->request_status->Visible) { // request_status ?>
		<td<?php echo $New_Payment_Requests->request_status->CellAttributes() ?>>
<div<?php echo $New_Payment_Requests->request_status->ViewAttributes() ?>><?php echo $New_Payment_Requests->request_status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($New_Payment_Requests->code->Visible) { // code ?>
		<td<?php echo $New_Payment_Requests->code->CellAttributes() ?>>
<div<?php echo $New_Payment_Requests->code->ViewAttributes() ?>><?php echo $New_Payment_Requests->code->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$New_Payment_Requests_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($New_Payment_Requests->CurrentAction <> "gridadd")
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
<?php if ($New_Payment_Requests->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($New_Payment_Requests->CurrentAction <> "gridadd" && $New_Payment_Requests->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($New_Payment_Requests_list->Pager)) $New_Payment_Requests_list->Pager = new cPrevNextPager($New_Payment_Requests_list->lStartRec, $New_Payment_Requests_list->lDisplayRecs, $New_Payment_Requests_list->lTotalRecs) ?>
<?php if ($New_Payment_Requests_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($New_Payment_Requests_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $New_Payment_Requests_list->PageUrl() ?>start=<?php echo $New_Payment_Requests_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($New_Payment_Requests_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $New_Payment_Requests_list->PageUrl() ?>start=<?php echo $New_Payment_Requests_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $New_Payment_Requests_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($New_Payment_Requests_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $New_Payment_Requests_list->PageUrl() ?>start=<?php echo $New_Payment_Requests_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($New_Payment_Requests_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $New_Payment_Requests_list->PageUrl() ?>start=<?php echo $New_Payment_Requests_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $New_Payment_Requests_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $New_Payment_Requests_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $New_Payment_Requests_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $New_Payment_Requests_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($New_Payment_Requests_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($New_Payment_Requests_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($New_Payment_Requests->Export == "" && $New_Payment_Requests->CurrentAction == "") { ?>
<?php } ?>
<?php if ($New_Payment_Requests->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$New_Payment_Requests_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cNew_Payment_Requests_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'New_Payment_Requests';

	// Page object name
	var $PageObjName = 'New_Payment_Requests_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $New_Payment_Requests;
		if ($New_Payment_Requests->UseTokenInUrl) $PageUrl .= "t=" . $New_Payment_Requests->TableVar . "&"; // Add page token
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
		global $objForm, $New_Payment_Requests;
		if ($New_Payment_Requests->UseTokenInUrl) {
			if ($objForm)
				return ($New_Payment_Requests->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($New_Payment_Requests->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cNew_Payment_Requests_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (New_Payment_Requests)
		$GLOBALS["New_Payment_Requests"] = new cNew_Payment_Requests();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["New_Payment_Requests"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "New_Payment_Requestsdelete.php";
		$this->MultiUpdateUrl = "New_Payment_Requestsupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'New_Payment_Requests', TRUE);

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
		global $New_Payment_Requests;

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
			$New_Payment_Requests->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$New_Payment_Requests->Export = $_POST["exporttype"];
		} else {
			$New_Payment_Requests->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $New_Payment_Requests->Export; // Get export parameter, used in header
		$gsExportFile = $New_Payment_Requests->TableVar; // Get export file, used in header
		if ($New_Payment_Requests->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($New_Payment_Requests->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $New_Payment_Requests;

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
			$New_Payment_Requests->Recordset_SearchValidated();

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
		if ($New_Payment_Requests->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $New_Payment_Requests->getRecordsPerPage(); // Restore from Session
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
		$New_Payment_Requests->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$New_Payment_Requests->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$New_Payment_Requests->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $New_Payment_Requests->getSearchWhere();
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
		$New_Payment_Requests->setSessionWhere($sFilter);
		$New_Payment_Requests->CurrentFilter = "";

		// Export data only
		if (in_array($New_Payment_Requests->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($New_Payment_Requests->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $New_Payment_Requests;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $New_Payment_Requests->payment_request_id, FALSE); // payment_request_id
		$this->BuildSearchSql($sWhere, $New_Payment_Requests->year, FALSE); // year
		$this->BuildSearchSql($sWhere, $New_Payment_Requests->request_date, FALSE); // request_date
		$this->BuildSearchSql($sWhere, $New_Payment_Requests->programarea_id, FALSE); // programarea_id
		$this->BuildSearchSql($sWhere, $New_Payment_Requests->request_status, FALSE); // request_status
		$this->BuildSearchSql($sWhere, $New_Payment_Requests->code, FALSE); // code
		$this->BuildSearchSql($sWhere, $New_Payment_Requests->group_id, FALSE); // group_id

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($New_Payment_Requests->payment_request_id); // payment_request_id
			$this->SetSearchParm($New_Payment_Requests->year); // year
			$this->SetSearchParm($New_Payment_Requests->request_date); // request_date
			$this->SetSearchParm($New_Payment_Requests->programarea_id); // programarea_id
			$this->SetSearchParm($New_Payment_Requests->request_status); // request_status
			$this->SetSearchParm($New_Payment_Requests->code); // code
			$this->SetSearchParm($New_Payment_Requests->group_id); // group_id
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
		global $New_Payment_Requests;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$New_Payment_Requests->setAdvancedSearch("x_$FldParm", $FldVal);
		$New_Payment_Requests->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$New_Payment_Requests->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$New_Payment_Requests->setAdvancedSearch("y_$FldParm", $FldVal2);
		$New_Payment_Requests->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $New_Payment_Requests;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $New_Payment_Requests->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $New_Payment_Requests->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $New_Payment_Requests->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $New_Payment_Requests->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $New_Payment_Requests->GetAdvancedSearch("w_$FldParm");
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
		global $New_Payment_Requests;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $New_Payment_Requests->request_status, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $New_Payment_Requests->code, $Keyword);
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
		global $Security, $New_Payment_Requests;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $New_Payment_Requests->BasicSearchKeyword;
		$sSearchType = $New_Payment_Requests->BasicSearchType;
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
			$New_Payment_Requests->setSessionBasicSearchKeyword($sSearchKeyword);
			$New_Payment_Requests->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $New_Payment_Requests;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$New_Payment_Requests->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $New_Payment_Requests;
		$New_Payment_Requests->setSessionBasicSearchKeyword("");
		$New_Payment_Requests->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $New_Payment_Requests;
		$New_Payment_Requests->setAdvancedSearch("x_payment_request_id", "");
		$New_Payment_Requests->setAdvancedSearch("x_year", "");
		$New_Payment_Requests->setAdvancedSearch("x_request_date", "");
		$New_Payment_Requests->setAdvancedSearch("x_programarea_id", "");
		$New_Payment_Requests->setAdvancedSearch("x_request_status", "");
		$New_Payment_Requests->setAdvancedSearch("x_code", "");
		$New_Payment_Requests->setAdvancedSearch("x_group_id", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $New_Payment_Requests;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_payment_request_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_year"] <> "") $bRestore = FALSE;
		if (@$_GET["x_request_date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_programarea_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_request_status"] <> "") $bRestore = FALSE;
		if (@$_GET["x_code"] <> "") $bRestore = FALSE;
		if (@$_GET["x_group_id"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$New_Payment_Requests->BasicSearchKeyword = $New_Payment_Requests->getSessionBasicSearchKeyword();
			$New_Payment_Requests->BasicSearchType = $New_Payment_Requests->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($New_Payment_Requests->payment_request_id);
			$this->GetSearchParm($New_Payment_Requests->year);
			$this->GetSearchParm($New_Payment_Requests->request_date);
			$this->GetSearchParm($New_Payment_Requests->programarea_id);
			$this->GetSearchParm($New_Payment_Requests->request_status);
			$this->GetSearchParm($New_Payment_Requests->code);
			$this->GetSearchParm($New_Payment_Requests->group_id);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $New_Payment_Requests;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$New_Payment_Requests->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$New_Payment_Requests->CurrentOrderType = @$_GET["ordertype"];
			$New_Payment_Requests->UpdateSort($New_Payment_Requests->payment_request_id); // payment_request_id
			$New_Payment_Requests->UpdateSort($New_Payment_Requests->year); // year
			$New_Payment_Requests->UpdateSort($New_Payment_Requests->request_date); // request_date
			$New_Payment_Requests->UpdateSort($New_Payment_Requests->programarea_id); // programarea_id
			$New_Payment_Requests->UpdateSort($New_Payment_Requests->request_status); // request_status
			$New_Payment_Requests->UpdateSort($New_Payment_Requests->code); // code
			$New_Payment_Requests->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $New_Payment_Requests;
		$sOrderBy = $New_Payment_Requests->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($New_Payment_Requests->SqlOrderBy() <> "") {
				$sOrderBy = $New_Payment_Requests->SqlOrderBy();
				$New_Payment_Requests->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $New_Payment_Requests;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$New_Payment_Requests->setSessionOrderBy($sOrderBy);
				$New_Payment_Requests->payment_request_id->setSort("");
				$New_Payment_Requests->year->setSort("");
				$New_Payment_Requests->request_date->setSort("");
				$New_Payment_Requests->programarea_id->setSort("");
				$New_Payment_Requests->request_status->setSort("");
				$New_Payment_Requests->code->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$New_Payment_Requests->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $New_Payment_Requests;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($New_Payment_Requests->Export <> "" ||
			$New_Payment_Requests->CurrentAction == "gridadd" ||
			$New_Payment_Requests->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $New_Payment_Requests;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $New_Payment_Requests;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $New_Payment_Requests;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$New_Payment_Requests->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$New_Payment_Requests->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $New_Payment_Requests->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$New_Payment_Requests->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$New_Payment_Requests->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$New_Payment_Requests->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $New_Payment_Requests;
		$New_Payment_Requests->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$New_Payment_Requests->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $New_Payment_Requests;

		// Load search values
		// payment_request_id

		$New_Payment_Requests->payment_request_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_payment_request_id"]);
		$New_Payment_Requests->payment_request_id->AdvancedSearch->SearchOperator = @$_GET["z_payment_request_id"];

		// year
		$New_Payment_Requests->year->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_year"]);
		$New_Payment_Requests->year->AdvancedSearch->SearchOperator = @$_GET["z_year"];

		// request_date
		$New_Payment_Requests->request_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_request_date"]);
		$New_Payment_Requests->request_date->AdvancedSearch->SearchOperator = @$_GET["z_request_date"];

		// programarea_id
		$New_Payment_Requests->programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programarea_id"]);
		$New_Payment_Requests->programarea_id->AdvancedSearch->SearchOperator = @$_GET["z_programarea_id"];

		// request_status
		$New_Payment_Requests->request_status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_request_status"]);
		$New_Payment_Requests->request_status->AdvancedSearch->SearchOperator = @$_GET["z_request_status"];

		// code
		$New_Payment_Requests->code->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_code"]);
		$New_Payment_Requests->code->AdvancedSearch->SearchOperator = @$_GET["z_code"];

		// group_id
		$New_Payment_Requests->group_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_group_id"]);
		$New_Payment_Requests->group_id->AdvancedSearch->SearchOperator = @$_GET["z_group_id"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $New_Payment_Requests;

		// Call Recordset Selecting event
		$New_Payment_Requests->Recordset_Selecting($New_Payment_Requests->CurrentFilter);

		// Load List page SQL
		$sSql = $New_Payment_Requests->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$New_Payment_Requests->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $New_Payment_Requests;
		$sFilter = $New_Payment_Requests->KeyFilter();

		// Call Row Selecting event
		$New_Payment_Requests->Row_Selecting($sFilter);

		// Load SQL based on filter
		$New_Payment_Requests->CurrentFilter = $sFilter;
		$sSql = $New_Payment_Requests->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$New_Payment_Requests->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $New_Payment_Requests;
		$New_Payment_Requests->payment_request_id->setDbValue($rs->fields('payment_request_id'));
		$New_Payment_Requests->year->setDbValue($rs->fields('year'));
		$New_Payment_Requests->request_date->setDbValue($rs->fields('request_date'));
		$New_Payment_Requests->programarea_id->setDbValue($rs->fields('programarea_id'));
		$New_Payment_Requests->request_status->setDbValue($rs->fields('request_status'));
		$New_Payment_Requests->code->setDbValue($rs->fields('code'));
		$New_Payment_Requests->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $New_Payment_Requests;

		// Initialize URLs
		$this->ViewUrl = $New_Payment_Requests->ViewUrl();
		$this->EditUrl = $New_Payment_Requests->EditUrl();
		$this->InlineEditUrl = $New_Payment_Requests->InlineEditUrl();
		$this->CopyUrl = $New_Payment_Requests->CopyUrl();
		$this->InlineCopyUrl = $New_Payment_Requests->InlineCopyUrl();
		$this->DeleteUrl = $New_Payment_Requests->DeleteUrl();

		// Call Row_Rendering event
		$New_Payment_Requests->Row_Rendering();

		// Common render codes for all row types
		// payment_request_id

		$New_Payment_Requests->payment_request_id->CellCssStyle = ""; $New_Payment_Requests->payment_request_id->CellCssClass = "";
		$New_Payment_Requests->payment_request_id->CellAttrs = array(); $New_Payment_Requests->payment_request_id->ViewAttrs = array(); $New_Payment_Requests->payment_request_id->EditAttrs = array();

		// year
		$New_Payment_Requests->year->CellCssStyle = ""; $New_Payment_Requests->year->CellCssClass = "";
		$New_Payment_Requests->year->CellAttrs = array(); $New_Payment_Requests->year->ViewAttrs = array(); $New_Payment_Requests->year->EditAttrs = array();

		// request_date
		$New_Payment_Requests->request_date->CellCssStyle = ""; $New_Payment_Requests->request_date->CellCssClass = "";
		$New_Payment_Requests->request_date->CellAttrs = array(); $New_Payment_Requests->request_date->ViewAttrs = array(); $New_Payment_Requests->request_date->EditAttrs = array();

		// programarea_id
		$New_Payment_Requests->programarea_id->CellCssStyle = ""; $New_Payment_Requests->programarea_id->CellCssClass = "";
		$New_Payment_Requests->programarea_id->CellAttrs = array(); $New_Payment_Requests->programarea_id->ViewAttrs = array(); $New_Payment_Requests->programarea_id->EditAttrs = array();

		// request_status
		$New_Payment_Requests->request_status->CellCssStyle = ""; $New_Payment_Requests->request_status->CellCssClass = "";
		$New_Payment_Requests->request_status->CellAttrs = array(); $New_Payment_Requests->request_status->ViewAttrs = array(); $New_Payment_Requests->request_status->EditAttrs = array();

		// code
		$New_Payment_Requests->code->CellCssStyle = ""; $New_Payment_Requests->code->CellCssClass = "";
		$New_Payment_Requests->code->CellAttrs = array(); $New_Payment_Requests->code->ViewAttrs = array(); $New_Payment_Requests->code->EditAttrs = array();
		if ($New_Payment_Requests->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$New_Payment_Requests->payment_request_id->ViewValue = $New_Payment_Requests->payment_request_id->CurrentValue;
			$New_Payment_Requests->payment_request_id->CssStyle = "";
			$New_Payment_Requests->payment_request_id->CssClass = "";
			$New_Payment_Requests->payment_request_id->ViewCustomAttributes = "";

			// year
			$New_Payment_Requests->year->ViewValue = $New_Payment_Requests->year->CurrentValue;
			$New_Payment_Requests->year->CssStyle = "";
			$New_Payment_Requests->year->CssClass = "";
			$New_Payment_Requests->year->ViewCustomAttributes = "";

			// request_date
			$New_Payment_Requests->request_date->ViewValue = $New_Payment_Requests->request_date->CurrentValue;
			$New_Payment_Requests->request_date->ViewValue = ew_FormatDateTime($New_Payment_Requests->request_date->ViewValue, 7);
			$New_Payment_Requests->request_date->CssStyle = "";
			$New_Payment_Requests->request_date->CssClass = "";
			$New_Payment_Requests->request_date->ViewCustomAttributes = "";

			// programarea_id
			if (strval($New_Payment_Requests->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($New_Payment_Requests->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$New_Payment_Requests->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$New_Payment_Requests->programarea_id->ViewValue = $New_Payment_Requests->programarea_id->CurrentValue;
				}
			} else {
				$New_Payment_Requests->programarea_id->ViewValue = NULL;
			}
			$New_Payment_Requests->programarea_id->CssStyle = "";
			$New_Payment_Requests->programarea_id->CssClass = "";
			$New_Payment_Requests->programarea_id->ViewCustomAttributes = "";

			// request_status
			if (strval($New_Payment_Requests->request_status->CurrentValue) <> "") {
				switch ($New_Payment_Requests->request_status->CurrentValue) {
					case "NEWREQ":
						$New_Payment_Requests->request_status->ViewValue = "NEWREQ";
						break;
					case "REQUESTED":
						$New_Payment_Requests->request_status->ViewValue = "REQUESTED";
						break;
					case "DISBURSED":
						$New_Payment_Requests->request_status->ViewValue = "DISBURSED";
						break;
					case "LIQUIDATED":
						$New_Payment_Requests->request_status->ViewValue = "LIQUIDATED";
						break;
					default:
						$New_Payment_Requests->request_status->ViewValue = $New_Payment_Requests->request_status->CurrentValue;
				}
			} else {
				$New_Payment_Requests->request_status->ViewValue = NULL;
			}
			$New_Payment_Requests->request_status->CssStyle = "";
			$New_Payment_Requests->request_status->CssClass = "";
			$New_Payment_Requests->request_status->ViewCustomAttributes = "";

			// code
			$New_Payment_Requests->code->ViewValue = $New_Payment_Requests->code->CurrentValue;
			$New_Payment_Requests->code->CssStyle = "";
			$New_Payment_Requests->code->CssClass = "";
			$New_Payment_Requests->code->ViewCustomAttributes = "";

			// group_id
			$New_Payment_Requests->group_id->ViewValue = $New_Payment_Requests->group_id->CurrentValue;
			$New_Payment_Requests->group_id->CssStyle = "";
			$New_Payment_Requests->group_id->CssClass = "";
			$New_Payment_Requests->group_id->ViewCustomAttributes = "";

			// payment_request_id
			$New_Payment_Requests->payment_request_id->HrefValue = "";
			$New_Payment_Requests->payment_request_id->TooltipValue = "";

			// year
			$New_Payment_Requests->year->HrefValue = "";
			$New_Payment_Requests->year->TooltipValue = "";

			// request_date
			$New_Payment_Requests->request_date->HrefValue = "";
			$New_Payment_Requests->request_date->TooltipValue = "";

			// programarea_id
			$New_Payment_Requests->programarea_id->HrefValue = "";
			$New_Payment_Requests->programarea_id->TooltipValue = "";

			// request_status
			$New_Payment_Requests->request_status->HrefValue = "";
			$New_Payment_Requests->request_status->TooltipValue = "";

			// code
			$New_Payment_Requests->code->HrefValue = "";
			$New_Payment_Requests->code->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($New_Payment_Requests->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$New_Payment_Requests->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $New_Payment_Requests;

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
		global $New_Payment_Requests;
		$New_Payment_Requests->payment_request_id->AdvancedSearch->SearchValue = $New_Payment_Requests->getAdvancedSearch("x_payment_request_id");
		$New_Payment_Requests->year->AdvancedSearch->SearchValue = $New_Payment_Requests->getAdvancedSearch("x_year");
		$New_Payment_Requests->request_date->AdvancedSearch->SearchValue = $New_Payment_Requests->getAdvancedSearch("x_request_date");
		$New_Payment_Requests->programarea_id->AdvancedSearch->SearchValue = $New_Payment_Requests->getAdvancedSearch("x_programarea_id");
		$New_Payment_Requests->request_status->AdvancedSearch->SearchValue = $New_Payment_Requests->getAdvancedSearch("x_request_status");
		$New_Payment_Requests->code->AdvancedSearch->SearchValue = $New_Payment_Requests->getAdvancedSearch("x_code");
		$New_Payment_Requests->group_id->AdvancedSearch->SearchValue = $New_Payment_Requests->getAdvancedSearch("x_group_id");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $New_Payment_Requests;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $New_Payment_Requests->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($New_Payment_Requests->ExportAll) {
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
		if ($New_Payment_Requests->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($New_Payment_Requests, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($New_Payment_Requests->payment_request_id);
				$ExportDoc->ExportCaption($New_Payment_Requests->year);
				$ExportDoc->ExportCaption($New_Payment_Requests->request_date);
				$ExportDoc->ExportCaption($New_Payment_Requests->programarea_id);
				$ExportDoc->ExportCaption($New_Payment_Requests->request_status);
				$ExportDoc->ExportCaption($New_Payment_Requests->code);
				$ExportDoc->ExportCaption($New_Payment_Requests->group_id);
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
				$New_Payment_Requests->CssClass = "";
				$New_Payment_Requests->CssStyle = "";
				$New_Payment_Requests->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($New_Payment_Requests->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('payment_request_id', $New_Payment_Requests->payment_request_id->ExportValue($New_Payment_Requests->Export, $New_Payment_Requests->ExportOriginalValue));
					$XmlDoc->AddField('year', $New_Payment_Requests->year->ExportValue($New_Payment_Requests->Export, $New_Payment_Requests->ExportOriginalValue));
					$XmlDoc->AddField('request_date', $New_Payment_Requests->request_date->ExportValue($New_Payment_Requests->Export, $New_Payment_Requests->ExportOriginalValue));
					$XmlDoc->AddField('programarea_id', $New_Payment_Requests->programarea_id->ExportValue($New_Payment_Requests->Export, $New_Payment_Requests->ExportOriginalValue));
					$XmlDoc->AddField('request_status', $New_Payment_Requests->request_status->ExportValue($New_Payment_Requests->Export, $New_Payment_Requests->ExportOriginalValue));
					$XmlDoc->AddField('code', $New_Payment_Requests->code->ExportValue($New_Payment_Requests->Export, $New_Payment_Requests->ExportOriginalValue));
					$XmlDoc->AddField('group_id', $New_Payment_Requests->group_id->ExportValue($New_Payment_Requests->Export, $New_Payment_Requests->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($New_Payment_Requests->payment_request_id);
					$ExportDoc->ExportField($New_Payment_Requests->year);
					$ExportDoc->ExportField($New_Payment_Requests->request_date);
					$ExportDoc->ExportField($New_Payment_Requests->programarea_id);
					$ExportDoc->ExportField($New_Payment_Requests->request_status);
					$ExportDoc->ExportField($New_Payment_Requests->code);
					$ExportDoc->ExportField($New_Payment_Requests->group_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($New_Payment_Requests->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($New_Payment_Requests->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($New_Payment_Requests->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($New_Payment_Requests->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($New_Payment_Requests->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $New_Payment_Requests;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($New_Payment_Requests->group_id->CurrentValue);
			}
		}
		return TRUE;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'New_Payment_Requests';
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
