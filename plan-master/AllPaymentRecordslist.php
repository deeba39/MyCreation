<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "AllPaymentRecordsinfo.php" ?>
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
$AllPaymentRecords_list = new cAllPaymentRecords_list();
$Page =& $AllPaymentRecords_list;

// Page init
$AllPaymentRecords_list->Page_Init();

// Page main
$AllPaymentRecords_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($AllPaymentRecords->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var AllPaymentRecords_list = new ew_Page("AllPaymentRecords_list");

// page properties
AllPaymentRecords_list.PageID = "list"; // page ID
AllPaymentRecords_list.FormID = "fAllPaymentRecordslist"; // form ID
var EW_PAGE_ID = AllPaymentRecords_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
AllPaymentRecords_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
AllPaymentRecords_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
AllPaymentRecords_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($AllPaymentRecords->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$AllPaymentRecords_list->lTotalRecs = $AllPaymentRecords->SelectRecordCount();
	} else {
		if ($rs = $AllPaymentRecords_list->LoadRecordset())
			$AllPaymentRecords_list->lTotalRecs = $rs->RecordCount();
	}
	$AllPaymentRecords_list->lStartRec = 1;
	if ($AllPaymentRecords_list->lDisplayRecs <= 0 || ($AllPaymentRecords->Export <> "" && $AllPaymentRecords->ExportAll)) // Display all records
		$AllPaymentRecords_list->lDisplayRecs = $AllPaymentRecords_list->lTotalRecs;
	if (!($AllPaymentRecords->Export <> "" && $AllPaymentRecords->ExportAll))
		$AllPaymentRecords_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $AllPaymentRecords_list->LoadRecordset($AllPaymentRecords_list->lStartRec-1, $AllPaymentRecords_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $AllPaymentRecords->TableCaption() ?>
<?php if ($AllPaymentRecords->Export == "" && $AllPaymentRecords->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $AllPaymentRecords_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $AllPaymentRecords_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $AllPaymentRecords_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$AllPaymentRecords_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fAllPaymentRecordslist" id="fAllPaymentRecordslist" class="ewForm" action="" method="post">
<div id="gmp_AllPaymentRecords" class="ewGridMiddlePanel">
<?php if ($AllPaymentRecords_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $AllPaymentRecords->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$AllPaymentRecords_list->RenderListOptions();

// Render list options (header, left)
$AllPaymentRecords_list->ListOptions->Render("header", "left");
?>
<?php if ($AllPaymentRecords->year->Visible) { // year ?>
	<?php if ($AllPaymentRecords->SortUrl($AllPaymentRecords->year) == "") { ?>
		<td><?php echo $AllPaymentRecords->year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AllPaymentRecords->SortUrl($AllPaymentRecords->year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AllPaymentRecords->year->FldCaption() ?></td><td style="width: 10px;"><?php if ($AllPaymentRecords->year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AllPaymentRecords->year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($AllPaymentRecords->request_date->Visible) { // request_date ?>
	<?php if ($AllPaymentRecords->SortUrl($AllPaymentRecords->request_date) == "") { ?>
		<td><?php echo $AllPaymentRecords->request_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AllPaymentRecords->SortUrl($AllPaymentRecords->request_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AllPaymentRecords->request_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($AllPaymentRecords->request_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AllPaymentRecords->request_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($AllPaymentRecords->programarea_id->Visible) { // programarea_id ?>
	<?php if ($AllPaymentRecords->SortUrl($AllPaymentRecords->programarea_id) == "") { ?>
		<td><?php echo $AllPaymentRecords->programarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AllPaymentRecords->SortUrl($AllPaymentRecords->programarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AllPaymentRecords->programarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($AllPaymentRecords->programarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AllPaymentRecords->programarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($AllPaymentRecords->request_status->Visible) { // request_status ?>
	<?php if ($AllPaymentRecords->SortUrl($AllPaymentRecords->request_status) == "") { ?>
		<td><?php echo $AllPaymentRecords->request_status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AllPaymentRecords->SortUrl($AllPaymentRecords->request_status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AllPaymentRecords->request_status->FldCaption() ?></td><td style="width: 10px;"><?php if ($AllPaymentRecords->request_status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AllPaymentRecords->request_status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($AllPaymentRecords->code->Visible) { // code ?>
	<?php if ($AllPaymentRecords->SortUrl($AllPaymentRecords->code) == "") { ?>
		<td><?php echo $AllPaymentRecords->code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AllPaymentRecords->SortUrl($AllPaymentRecords->code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AllPaymentRecords->code->FldCaption() ?></td><td style="width: 10px;"><?php if ($AllPaymentRecords->code->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AllPaymentRecords->code->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($AllPaymentRecords->financial_year_financial_year_id->Visible) { // financial_year_financial_year_id ?>
	<?php if ($AllPaymentRecords->SortUrl($AllPaymentRecords->financial_year_financial_year_id) == "") { ?>
		<td><?php echo $AllPaymentRecords->financial_year_financial_year_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AllPaymentRecords->SortUrl($AllPaymentRecords->financial_year_financial_year_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AllPaymentRecords->financial_year_financial_year_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($AllPaymentRecords->financial_year_financial_year_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AllPaymentRecords->financial_year_financial_year_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($AllPaymentRecords->amount->Visible) { // amount ?>
	<?php if ($AllPaymentRecords->SortUrl($AllPaymentRecords->amount) == "") { ?>
		<td><?php echo $AllPaymentRecords->amount->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AllPaymentRecords->SortUrl($AllPaymentRecords->amount) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AllPaymentRecords->amount->FldCaption() ?></td><td style="width: 10px;"><?php if ($AllPaymentRecords->amount->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AllPaymentRecords->amount->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$AllPaymentRecords_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($AllPaymentRecords->ExportAll && $AllPaymentRecords->Export <> "") {
	$AllPaymentRecords_list->lStopRec = $AllPaymentRecords_list->lTotalRecs;
} else {
	$AllPaymentRecords_list->lStopRec = $AllPaymentRecords_list->lStartRec + $AllPaymentRecords_list->lDisplayRecs - 1; // Set the last record to display
}
$AllPaymentRecords_list->lRecCount = $AllPaymentRecords_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $AllPaymentRecords_list->lStartRec > 1)
		$rs->Move($AllPaymentRecords_list->lStartRec - 1);
}

// Initialize aggregate
$AllPaymentRecords->RowType = EW_ROWTYPE_AGGREGATEINIT;
$AllPaymentRecords_list->RenderRow();
$AllPaymentRecords_list->lRowCnt = 0;
while (($AllPaymentRecords->CurrentAction == "gridadd" || !$rs->EOF) &&
	$AllPaymentRecords_list->lRecCount < $AllPaymentRecords_list->lStopRec) {
	$AllPaymentRecords_list->lRecCount++;
	if (intval($AllPaymentRecords_list->lRecCount) >= intval($AllPaymentRecords_list->lStartRec)) {
		$AllPaymentRecords_list->lRowCnt++;

	// Init row class and style
	$AllPaymentRecords->CssClass = "";
	$AllPaymentRecords->CssStyle = "";
	$AllPaymentRecords->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($AllPaymentRecords->CurrentAction == "gridadd") {
		$AllPaymentRecords_list->LoadDefaultValues(); // Load default values
	} else {
		$AllPaymentRecords_list->LoadRowValues($rs); // Load row values
	}
	$AllPaymentRecords->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$AllPaymentRecords_list->RenderRow();

	// Render list options
	$AllPaymentRecords_list->RenderListOptions();
?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
<?php

// Render list options (body, left)
$AllPaymentRecords_list->ListOptions->Render("body", "left");
?>
	<?php if ($AllPaymentRecords->year->Visible) { // year ?>
		<td<?php echo $AllPaymentRecords->year->CellAttributes() ?>>
<div<?php echo $AllPaymentRecords->year->ViewAttributes() ?>><?php echo $AllPaymentRecords->year->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($AllPaymentRecords->request_date->Visible) { // request_date ?>
		<td<?php echo $AllPaymentRecords->request_date->CellAttributes() ?>>
<div<?php echo $AllPaymentRecords->request_date->ViewAttributes() ?>><?php echo $AllPaymentRecords->request_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($AllPaymentRecords->programarea_id->Visible) { // programarea_id ?>
		<td<?php echo $AllPaymentRecords->programarea_id->CellAttributes() ?>>
<div<?php echo $AllPaymentRecords->programarea_id->ViewAttributes() ?>><?php echo $AllPaymentRecords->programarea_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($AllPaymentRecords->request_status->Visible) { // request_status ?>
		<td<?php echo $AllPaymentRecords->request_status->CellAttributes() ?>>
<div<?php echo $AllPaymentRecords->request_status->ViewAttributes() ?>><?php echo $AllPaymentRecords->request_status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($AllPaymentRecords->code->Visible) { // code ?>
		<td<?php echo $AllPaymentRecords->code->CellAttributes() ?>>
<div<?php echo $AllPaymentRecords->code->ViewAttributes() ?>><?php echo $AllPaymentRecords->code->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($AllPaymentRecords->financial_year_financial_year_id->Visible) { // financial_year_financial_year_id ?>
		<td<?php echo $AllPaymentRecords->financial_year_financial_year_id->CellAttributes() ?>>
<div<?php echo $AllPaymentRecords->financial_year_financial_year_id->ViewAttributes() ?>><?php echo $AllPaymentRecords->financial_year_financial_year_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($AllPaymentRecords->amount->Visible) { // amount ?>
		<td<?php echo $AllPaymentRecords->amount->CellAttributes() ?>>
<div<?php echo $AllPaymentRecords->amount->ViewAttributes() ?>><?php echo $AllPaymentRecords->amount->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$AllPaymentRecords_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($AllPaymentRecords->CurrentAction <> "gridadd")
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
<?php if ($AllPaymentRecords->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($AllPaymentRecords->CurrentAction <> "gridadd" && $AllPaymentRecords->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($AllPaymentRecords_list->Pager)) $AllPaymentRecords_list->Pager = new cPrevNextPager($AllPaymentRecords_list->lStartRec, $AllPaymentRecords_list->lDisplayRecs, $AllPaymentRecords_list->lTotalRecs) ?>
<?php if ($AllPaymentRecords_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($AllPaymentRecords_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $AllPaymentRecords_list->PageUrl() ?>start=<?php echo $AllPaymentRecords_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($AllPaymentRecords_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $AllPaymentRecords_list->PageUrl() ?>start=<?php echo $AllPaymentRecords_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $AllPaymentRecords_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($AllPaymentRecords_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $AllPaymentRecords_list->PageUrl() ?>start=<?php echo $AllPaymentRecords_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($AllPaymentRecords_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $AllPaymentRecords_list->PageUrl() ?>start=<?php echo $AllPaymentRecords_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $AllPaymentRecords_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $AllPaymentRecords_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $AllPaymentRecords_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $AllPaymentRecords_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($AllPaymentRecords_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($AllPaymentRecords_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($AllPaymentRecords->Export == "" && $AllPaymentRecords->CurrentAction == "") { ?>
<?php } ?>
<?php if ($AllPaymentRecords->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$AllPaymentRecords_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cAllPaymentRecords_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'AllPaymentRecords';

	// Page object name
	var $PageObjName = 'AllPaymentRecords_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $AllPaymentRecords;
		if ($AllPaymentRecords->UseTokenInUrl) $PageUrl .= "t=" . $AllPaymentRecords->TableVar . "&"; // Add page token
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
		global $objForm, $AllPaymentRecords;
		if ($AllPaymentRecords->UseTokenInUrl) {
			if ($objForm)
				return ($AllPaymentRecords->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($AllPaymentRecords->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cAllPaymentRecords_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (AllPaymentRecords)
		$GLOBALS["AllPaymentRecords"] = new cAllPaymentRecords();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["AllPaymentRecords"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "AllPaymentRecordsdelete.php";
		$this->MultiUpdateUrl = "AllPaymentRecordsupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'AllPaymentRecords', TRUE);

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
		global $AllPaymentRecords;

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
			$AllPaymentRecords->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$AllPaymentRecords->Export = $_POST["exporttype"];
		} else {
			$AllPaymentRecords->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $AllPaymentRecords->Export; // Get export parameter, used in header
		$gsExportFile = $AllPaymentRecords->TableVar; // Get export file, used in header
		if ($AllPaymentRecords->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($AllPaymentRecords->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $AllPaymentRecords;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($AllPaymentRecords->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $AllPaymentRecords->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$AllPaymentRecords->setSessionWhere($sFilter);
		$AllPaymentRecords->CurrentFilter = "";

		// Export data only
		if (in_array($AllPaymentRecords->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($AllPaymentRecords->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $AllPaymentRecords;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$AllPaymentRecords->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$AllPaymentRecords->CurrentOrderType = @$_GET["ordertype"];
			$AllPaymentRecords->UpdateSort($AllPaymentRecords->year); // year
			$AllPaymentRecords->UpdateSort($AllPaymentRecords->request_date); // request_date
			$AllPaymentRecords->UpdateSort($AllPaymentRecords->programarea_id); // programarea_id
			$AllPaymentRecords->UpdateSort($AllPaymentRecords->request_status); // request_status
			$AllPaymentRecords->UpdateSort($AllPaymentRecords->code); // code
			$AllPaymentRecords->UpdateSort($AllPaymentRecords->financial_year_financial_year_id); // financial_year_financial_year_id
			$AllPaymentRecords->UpdateSort($AllPaymentRecords->amount); // amount
			$AllPaymentRecords->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $AllPaymentRecords;
		$sOrderBy = $AllPaymentRecords->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($AllPaymentRecords->SqlOrderBy() <> "") {
				$sOrderBy = $AllPaymentRecords->SqlOrderBy();
				$AllPaymentRecords->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $AllPaymentRecords;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$AllPaymentRecords->setSessionOrderBy($sOrderBy);
				$AllPaymentRecords->year->setSort("");
				$AllPaymentRecords->request_date->setSort("");
				$AllPaymentRecords->programarea_id->setSort("");
				$AllPaymentRecords->request_status->setSort("");
				$AllPaymentRecords->code->setSort("");
				$AllPaymentRecords->financial_year_financial_year_id->setSort("");
				$AllPaymentRecords->amount->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$AllPaymentRecords->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $AllPaymentRecords;

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
		if ($AllPaymentRecords->Export <> "" ||
			$AllPaymentRecords->CurrentAction == "gridadd" ||
			$AllPaymentRecords->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $AllPaymentRecords;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . "<img src=\"images/view.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . "<img src=\"images/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $AllPaymentRecords;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $AllPaymentRecords;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$AllPaymentRecords->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$AllPaymentRecords->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $AllPaymentRecords->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$AllPaymentRecords->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$AllPaymentRecords->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$AllPaymentRecords->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $AllPaymentRecords;

		// Call Recordset Selecting event
		$AllPaymentRecords->Recordset_Selecting($AllPaymentRecords->CurrentFilter);

		// Load List page SQL
		$sSql = $AllPaymentRecords->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$AllPaymentRecords->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $AllPaymentRecords;
		$sFilter = $AllPaymentRecords->KeyFilter();

		// Call Row Selecting event
		$AllPaymentRecords->Row_Selecting($sFilter);

		// Load SQL based on filter
		$AllPaymentRecords->CurrentFilter = $sFilter;
		$sSql = $AllPaymentRecords->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$AllPaymentRecords->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $AllPaymentRecords;
		$AllPaymentRecords->payment_request_id->setDbValue($rs->fields('payment_request_id'));
		$AllPaymentRecords->year->setDbValue($rs->fields('year'));
		$AllPaymentRecords->request_date->setDbValue($rs->fields('request_date'));
		$AllPaymentRecords->programarea_id->setDbValue($rs->fields('programarea_id'));
		$AllPaymentRecords->request_status->setDbValue($rs->fields('request_status'));
		$AllPaymentRecords->code->setDbValue($rs->fields('code'));
		$AllPaymentRecords->financial_year_financial_year_id->setDbValue($rs->fields('financial_year_financial_year_id'));
		$AllPaymentRecords->amount->setDbValue($rs->fields('amount'));
		$AllPaymentRecords->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $AllPaymentRecords;

		// Initialize URLs
		$this->ViewUrl = $AllPaymentRecords->ViewUrl();
		$this->EditUrl = $AllPaymentRecords->EditUrl();
		$this->InlineEditUrl = $AllPaymentRecords->InlineEditUrl();
		$this->CopyUrl = $AllPaymentRecords->CopyUrl();
		$this->InlineCopyUrl = $AllPaymentRecords->InlineCopyUrl();
		$this->DeleteUrl = $AllPaymentRecords->DeleteUrl();

		// Call Row_Rendering event
		$AllPaymentRecords->Row_Rendering();

		// Common render codes for all row types
		// year

		$AllPaymentRecords->year->CellCssStyle = ""; $AllPaymentRecords->year->CellCssClass = "";
		$AllPaymentRecords->year->CellAttrs = array(); $AllPaymentRecords->year->ViewAttrs = array(); $AllPaymentRecords->year->EditAttrs = array();

		// request_date
		$AllPaymentRecords->request_date->CellCssStyle = ""; $AllPaymentRecords->request_date->CellCssClass = "";
		$AllPaymentRecords->request_date->CellAttrs = array(); $AllPaymentRecords->request_date->ViewAttrs = array(); $AllPaymentRecords->request_date->EditAttrs = array();

		// programarea_id
		$AllPaymentRecords->programarea_id->CellCssStyle = ""; $AllPaymentRecords->programarea_id->CellCssClass = "";
		$AllPaymentRecords->programarea_id->CellAttrs = array(); $AllPaymentRecords->programarea_id->ViewAttrs = array(); $AllPaymentRecords->programarea_id->EditAttrs = array();

		// request_status
		$AllPaymentRecords->request_status->CellCssStyle = ""; $AllPaymentRecords->request_status->CellCssClass = "";
		$AllPaymentRecords->request_status->CellAttrs = array(); $AllPaymentRecords->request_status->ViewAttrs = array(); $AllPaymentRecords->request_status->EditAttrs = array();

		// code
		$AllPaymentRecords->code->CellCssStyle = ""; $AllPaymentRecords->code->CellCssClass = "";
		$AllPaymentRecords->code->CellAttrs = array(); $AllPaymentRecords->code->ViewAttrs = array(); $AllPaymentRecords->code->EditAttrs = array();

		// financial_year_financial_year_id
		$AllPaymentRecords->financial_year_financial_year_id->CellCssStyle = ""; $AllPaymentRecords->financial_year_financial_year_id->CellCssClass = "";
		$AllPaymentRecords->financial_year_financial_year_id->CellAttrs = array(); $AllPaymentRecords->financial_year_financial_year_id->ViewAttrs = array(); $AllPaymentRecords->financial_year_financial_year_id->EditAttrs = array();

		// amount
		$AllPaymentRecords->amount->CellCssStyle = ""; $AllPaymentRecords->amount->CellCssClass = "";
		$AllPaymentRecords->amount->CellAttrs = array(); $AllPaymentRecords->amount->ViewAttrs = array(); $AllPaymentRecords->amount->EditAttrs = array();
		if ($AllPaymentRecords->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$AllPaymentRecords->payment_request_id->ViewValue = $AllPaymentRecords->payment_request_id->CurrentValue;
			$AllPaymentRecords->payment_request_id->CssStyle = "";
			$AllPaymentRecords->payment_request_id->CssClass = "";
			$AllPaymentRecords->payment_request_id->ViewCustomAttributes = "";

			// year
			$AllPaymentRecords->year->ViewValue = $AllPaymentRecords->year->CurrentValue;
			$AllPaymentRecords->year->CssStyle = "";
			$AllPaymentRecords->year->CssClass = "";
			$AllPaymentRecords->year->ViewCustomAttributes = "";

			// request_date
			$AllPaymentRecords->request_date->ViewValue = $AllPaymentRecords->request_date->CurrentValue;
			$AllPaymentRecords->request_date->ViewValue = ew_FormatDateTime($AllPaymentRecords->request_date->ViewValue, 7);
			$AllPaymentRecords->request_date->CssStyle = "";
			$AllPaymentRecords->request_date->CssClass = "";
			$AllPaymentRecords->request_date->ViewCustomAttributes = "";

			// programarea_id
			if (strval($AllPaymentRecords->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($AllPaymentRecords->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$AllPaymentRecords->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$AllPaymentRecords->programarea_id->ViewValue = $AllPaymentRecords->programarea_id->CurrentValue;
				}
			} else {
				$AllPaymentRecords->programarea_id->ViewValue = NULL;
			}
			$AllPaymentRecords->programarea_id->CssStyle = "";
			$AllPaymentRecords->programarea_id->CssClass = "";
			$AllPaymentRecords->programarea_id->ViewCustomAttributes = "";

			// request_status
			if (strval($AllPaymentRecords->request_status->CurrentValue) <> "") {
				switch ($AllPaymentRecords->request_status->CurrentValue) {
					case "NEWREQ":
						$AllPaymentRecords->request_status->ViewValue = "NEWREQ";
						break;
					case "REQUESTED":
						$AllPaymentRecords->request_status->ViewValue = "REQUESTED";
						break;
					case "DISBURSED":
						$AllPaymentRecords->request_status->ViewValue = "DISBURSED";
						break;
					case "LIQUIDATED":
						$AllPaymentRecords->request_status->ViewValue = "LIQUIDATED";
						break;
					default:
						$AllPaymentRecords->request_status->ViewValue = $AllPaymentRecords->request_status->CurrentValue;
				}
			} else {
				$AllPaymentRecords->request_status->ViewValue = NULL;
			}
			$AllPaymentRecords->request_status->CssStyle = "";
			$AllPaymentRecords->request_status->CssClass = "";
			$AllPaymentRecords->request_status->ViewCustomAttributes = "";

			// code
			$AllPaymentRecords->code->ViewValue = $AllPaymentRecords->code->CurrentValue;
			$AllPaymentRecords->code->CssStyle = "";
			$AllPaymentRecords->code->CssClass = "";
			$AllPaymentRecords->code->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			if (strval($AllPaymentRecords->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($AllPaymentRecords->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$AllPaymentRecords->financial_year_financial_year_id->ViewValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$AllPaymentRecords->financial_year_financial_year_id->ViewValue = $AllPaymentRecords->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$AllPaymentRecords->financial_year_financial_year_id->ViewValue = NULL;
			}
			$AllPaymentRecords->financial_year_financial_year_id->CssStyle = "";
			$AllPaymentRecords->financial_year_financial_year_id->CssClass = "";
			$AllPaymentRecords->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$AllPaymentRecords->amount->ViewValue = $AllPaymentRecords->amount->CurrentValue;
			$AllPaymentRecords->amount->CssStyle = "";
			$AllPaymentRecords->amount->CssClass = "";
			$AllPaymentRecords->amount->ViewCustomAttributes = "";

			// group_id
			$AllPaymentRecords->group_id->ViewValue = $AllPaymentRecords->group_id->CurrentValue;
			$AllPaymentRecords->group_id->CssStyle = "";
			$AllPaymentRecords->group_id->CssClass = "";
			$AllPaymentRecords->group_id->ViewCustomAttributes = "";

			// year
			$AllPaymentRecords->year->HrefValue = "";
			$AllPaymentRecords->year->TooltipValue = "";

			// request_date
			$AllPaymentRecords->request_date->HrefValue = "";
			$AllPaymentRecords->request_date->TooltipValue = "";

			// programarea_id
			$AllPaymentRecords->programarea_id->HrefValue = "";
			$AllPaymentRecords->programarea_id->TooltipValue = "";

			// request_status
			$AllPaymentRecords->request_status->HrefValue = "";
			$AllPaymentRecords->request_status->TooltipValue = "";

			// code
			$AllPaymentRecords->code->HrefValue = "";
			$AllPaymentRecords->code->TooltipValue = "";

			// financial_year_financial_year_id
			$AllPaymentRecords->financial_year_financial_year_id->HrefValue = "";
			$AllPaymentRecords->financial_year_financial_year_id->TooltipValue = "";

			// amount
			$AllPaymentRecords->amount->HrefValue = "";
			$AllPaymentRecords->amount->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($AllPaymentRecords->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$AllPaymentRecords->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $AllPaymentRecords;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $AllPaymentRecords->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($AllPaymentRecords->ExportAll) {
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
		if ($AllPaymentRecords->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($AllPaymentRecords, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($AllPaymentRecords->payment_request_id);
				$ExportDoc->ExportCaption($AllPaymentRecords->year);
				$ExportDoc->ExportCaption($AllPaymentRecords->request_date);
				$ExportDoc->ExportCaption($AllPaymentRecords->programarea_id);
				$ExportDoc->ExportCaption($AllPaymentRecords->request_status);
				$ExportDoc->ExportCaption($AllPaymentRecords->code);
				$ExportDoc->ExportCaption($AllPaymentRecords->financial_year_financial_year_id);
				$ExportDoc->ExportCaption($AllPaymentRecords->amount);
				$ExportDoc->ExportCaption($AllPaymentRecords->group_id);
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
				$AllPaymentRecords->CssClass = "";
				$AllPaymentRecords->CssStyle = "";
				$AllPaymentRecords->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($AllPaymentRecords->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('payment_request_id', $AllPaymentRecords->payment_request_id->ExportValue($AllPaymentRecords->Export, $AllPaymentRecords->ExportOriginalValue));
					$XmlDoc->AddField('year', $AllPaymentRecords->year->ExportValue($AllPaymentRecords->Export, $AllPaymentRecords->ExportOriginalValue));
					$XmlDoc->AddField('request_date', $AllPaymentRecords->request_date->ExportValue($AllPaymentRecords->Export, $AllPaymentRecords->ExportOriginalValue));
					$XmlDoc->AddField('programarea_id', $AllPaymentRecords->programarea_id->ExportValue($AllPaymentRecords->Export, $AllPaymentRecords->ExportOriginalValue));
					$XmlDoc->AddField('request_status', $AllPaymentRecords->request_status->ExportValue($AllPaymentRecords->Export, $AllPaymentRecords->ExportOriginalValue));
					$XmlDoc->AddField('code', $AllPaymentRecords->code->ExportValue($AllPaymentRecords->Export, $AllPaymentRecords->ExportOriginalValue));
					$XmlDoc->AddField('financial_year_financial_year_id', $AllPaymentRecords->financial_year_financial_year_id->ExportValue($AllPaymentRecords->Export, $AllPaymentRecords->ExportOriginalValue));
					$XmlDoc->AddField('amount', $AllPaymentRecords->amount->ExportValue($AllPaymentRecords->Export, $AllPaymentRecords->ExportOriginalValue));
					$XmlDoc->AddField('group_id', $AllPaymentRecords->group_id->ExportValue($AllPaymentRecords->Export, $AllPaymentRecords->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($AllPaymentRecords->payment_request_id);
					$ExportDoc->ExportField($AllPaymentRecords->year);
					$ExportDoc->ExportField($AllPaymentRecords->request_date);
					$ExportDoc->ExportField($AllPaymentRecords->programarea_id);
					$ExportDoc->ExportField($AllPaymentRecords->request_status);
					$ExportDoc->ExportField($AllPaymentRecords->code);
					$ExportDoc->ExportField($AllPaymentRecords->financial_year_financial_year_id);
					$ExportDoc->ExportField($AllPaymentRecords->amount);
					$ExportDoc->ExportField($AllPaymentRecords->group_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($AllPaymentRecords->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($AllPaymentRecords->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($AllPaymentRecords->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($AllPaymentRecords->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($AllPaymentRecords->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'AllPaymentRecords';
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
