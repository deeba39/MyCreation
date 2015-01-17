<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "financial_yearinfo.php" ?>
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
$financial_year_list = new cfinancial_year_list();
$Page =& $financial_year_list;

// Page init
$financial_year_list->Page_Init();

// Page main
$financial_year_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($financial_year->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var financial_year_list = new ew_Page("financial_year_list");

// page properties
financial_year_list.PageID = "list"; // page ID
financial_year_list.FormID = "ffinancial_yearlist"; // form ID
var EW_PAGE_ID = financial_year_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
financial_year_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
financial_year_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
financial_year_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($financial_year->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$financial_year_list->lTotalRecs = $financial_year->SelectRecordCount();
	} else {
		if ($rs = $financial_year_list->LoadRecordset())
			$financial_year_list->lTotalRecs = $rs->RecordCount();
	}
	$financial_year_list->lStartRec = 1;
	if ($financial_year_list->lDisplayRecs <= 0 || ($financial_year->Export <> "" && $financial_year->ExportAll)) // Display all records
		$financial_year_list->lDisplayRecs = $financial_year_list->lTotalRecs;
	if (!($financial_year->Export <> "" && $financial_year->ExportAll))
		$financial_year_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $financial_year_list->LoadRecordset($financial_year_list->lStartRec-1, $financial_year_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $financial_year->TableCaption() ?>
<?php if ($financial_year->Export == "" && $financial_year->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $financial_year_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $financial_year_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $financial_year_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($financial_year->Export == "" && $financial_year->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(financial_year_list);" style="text-decoration: none;"><img id="financial_year_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="financial_year_list_SearchPanel">
<form name="ffinancial_yearlistsrch" id="ffinancial_yearlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="financial_year">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($financial_year->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $financial_year_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($financial_year->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($financial_year->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($financial_year->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$financial_year_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="ffinancial_yearlist" id="ffinancial_yearlist" class="ewForm" action="" method="post">
<div id="gmp_financial_year" class="ewGridMiddlePanel">
<?php if ($financial_year_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $financial_year->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$financial_year_list->RenderListOptions();

// Render list options (header, left)
$financial_year_list->ListOptions->Render("header", "left");
?>
<?php if ($financial_year->financial_year_id->Visible) { // financial_year_id ?>
	<?php if ($financial_year->SortUrl($financial_year->financial_year_id) == "") { ?>
		<td><?php echo $financial_year->financial_year_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $financial_year->SortUrl($financial_year->financial_year_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $financial_year->financial_year_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($financial_year->financial_year_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($financial_year->financial_year_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($financial_year->year_name->Visible) { // year_name ?>
	<?php if ($financial_year->SortUrl($financial_year->year_name) == "") { ?>
		<td><?php echo $financial_year->year_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $financial_year->SortUrl($financial_year->year_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $financial_year->year_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($financial_year->year_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($financial_year->year_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($financial_year->date_start->Visible) { // date_start ?>
	<?php if ($financial_year->SortUrl($financial_year->date_start) == "") { ?>
		<td><?php echo $financial_year->date_start->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $financial_year->SortUrl($financial_year->date_start) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $financial_year->date_start->FldCaption() ?></td><td style="width: 10px;"><?php if ($financial_year->date_start->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($financial_year->date_start->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($financial_year->date_end->Visible) { // date_end ?>
	<?php if ($financial_year->SortUrl($financial_year->date_end) == "") { ?>
		<td><?php echo $financial_year->date_end->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $financial_year->SortUrl($financial_year->date_end) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $financial_year->date_end->FldCaption() ?></td><td style="width: 10px;"><?php if ($financial_year->date_end->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($financial_year->date_end->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$financial_year_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($financial_year->ExportAll && $financial_year->Export <> "") {
	$financial_year_list->lStopRec = $financial_year_list->lTotalRecs;
} else {
	$financial_year_list->lStopRec = $financial_year_list->lStartRec + $financial_year_list->lDisplayRecs - 1; // Set the last record to display
}
$financial_year_list->lRecCount = $financial_year_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $financial_year_list->lStartRec > 1)
		$rs->Move($financial_year_list->lStartRec - 1);
}

// Initialize aggregate
$financial_year->RowType = EW_ROWTYPE_AGGREGATEINIT;
$financial_year_list->RenderRow();
$financial_year_list->lRowCnt = 0;
while (($financial_year->CurrentAction == "gridadd" || !$rs->EOF) &&
	$financial_year_list->lRecCount < $financial_year_list->lStopRec) {
	$financial_year_list->lRecCount++;
	if (intval($financial_year_list->lRecCount) >= intval($financial_year_list->lStartRec)) {
		$financial_year_list->lRowCnt++;

	// Init row class and style
	$financial_year->CssClass = "";
	$financial_year->CssStyle = "";
	$financial_year->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($financial_year->CurrentAction == "gridadd") {
		$financial_year_list->LoadDefaultValues(); // Load default values
	} else {
		$financial_year_list->LoadRowValues($rs); // Load row values
	}
	$financial_year->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$financial_year_list->RenderRow();

	// Render list options
	$financial_year_list->RenderListOptions();
?>
	<tr<?php echo $financial_year->RowAttributes() ?>>
<?php

// Render list options (body, left)
$financial_year_list->ListOptions->Render("body", "left");
?>
	<?php if ($financial_year->financial_year_id->Visible) { // financial_year_id ?>
		<td<?php echo $financial_year->financial_year_id->CellAttributes() ?>>
<div<?php echo $financial_year->financial_year_id->ViewAttributes() ?>><?php echo $financial_year->financial_year_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($financial_year->year_name->Visible) { // year_name ?>
		<td<?php echo $financial_year->year_name->CellAttributes() ?>>
<div<?php echo $financial_year->year_name->ViewAttributes() ?>><?php echo $financial_year->year_name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($financial_year->date_start->Visible) { // date_start ?>
		<td<?php echo $financial_year->date_start->CellAttributes() ?>>
<div<?php echo $financial_year->date_start->ViewAttributes() ?>><?php echo $financial_year->date_start->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($financial_year->date_end->Visible) { // date_end ?>
		<td<?php echo $financial_year->date_end->CellAttributes() ?>>
<div<?php echo $financial_year->date_end->ViewAttributes() ?>><?php echo $financial_year->date_end->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$financial_year_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($financial_year->CurrentAction <> "gridadd")
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
<?php if ($financial_year->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($financial_year->CurrentAction <> "gridadd" && $financial_year->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($financial_year_list->Pager)) $financial_year_list->Pager = new cPrevNextPager($financial_year_list->lStartRec, $financial_year_list->lDisplayRecs, $financial_year_list->lTotalRecs) ?>
<?php if ($financial_year_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($financial_year_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $financial_year_list->PageUrl() ?>start=<?php echo $financial_year_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($financial_year_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $financial_year_list->PageUrl() ?>start=<?php echo $financial_year_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $financial_year_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($financial_year_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $financial_year_list->PageUrl() ?>start=<?php echo $financial_year_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($financial_year_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $financial_year_list->PageUrl() ?>start=<?php echo $financial_year_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $financial_year_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $financial_year_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $financial_year_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $financial_year_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($financial_year_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($financial_year_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $financial_year_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($financial_year->Export == "" && $financial_year->CurrentAction == "") { ?>
<?php } ?>
<?php if ($financial_year->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$financial_year_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cfinancial_year_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'financial_year';

	// Page object name
	var $PageObjName = 'financial_year_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $financial_year;
		if ($financial_year->UseTokenInUrl) $PageUrl .= "t=" . $financial_year->TableVar . "&"; // Add page token
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
		global $objForm, $financial_year;
		if ($financial_year->UseTokenInUrl) {
			if ($objForm)
				return ($financial_year->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($financial_year->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfinancial_year_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (financial_year)
		$GLOBALS["financial_year"] = new cfinancial_year();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["financial_year"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "financial_yeardelete.php";
		$this->MultiUpdateUrl = "financial_yearupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'financial_year', TRUE);

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
		global $financial_year;

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
			$financial_year->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$financial_year->Export = $_POST["exporttype"];
		} else {
			$financial_year->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $financial_year->Export; // Get export parameter, used in header
		$gsExportFile = $financial_year->TableVar; // Get export file, used in header
		if ($financial_year->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($financial_year->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $financial_year;

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
			$financial_year->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($financial_year->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $financial_year->getRecordsPerPage(); // Restore from Session
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
		$financial_year->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$financial_year->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$financial_year->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $financial_year->getSearchWhere();
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
		$financial_year->setSessionWhere($sFilter);
		$financial_year->CurrentFilter = "";

		// Export data only
		if (in_array($financial_year->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($financial_year->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $financial_year;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $financial_year->year_name, $Keyword);
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
		global $Security, $financial_year;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $financial_year->BasicSearchKeyword;
		$sSearchType = $financial_year->BasicSearchType;
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
			$financial_year->setSessionBasicSearchKeyword($sSearchKeyword);
			$financial_year->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $financial_year;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$financial_year->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $financial_year;
		$financial_year->setSessionBasicSearchKeyword("");
		$financial_year->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $financial_year;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$financial_year->BasicSearchKeyword = $financial_year->getSessionBasicSearchKeyword();
			$financial_year->BasicSearchType = $financial_year->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $financial_year;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$financial_year->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$financial_year->CurrentOrderType = @$_GET["ordertype"];
			$financial_year->UpdateSort($financial_year->financial_year_id); // financial_year_id
			$financial_year->UpdateSort($financial_year->year_name); // year_name
			$financial_year->UpdateSort($financial_year->date_start); // date_start
			$financial_year->UpdateSort($financial_year->date_end); // date_end
			$financial_year->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $financial_year;
		$sOrderBy = $financial_year->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($financial_year->SqlOrderBy() <> "") {
				$sOrderBy = $financial_year->SqlOrderBy();
				$financial_year->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $financial_year;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$financial_year->setSessionOrderBy($sOrderBy);
				$financial_year->financial_year_id->setSort("");
				$financial_year->year_name->setSort("");
				$financial_year->date_start->setSort("");
				$financial_year->date_end->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$financial_year->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $financial_year;

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

		// "copy"
		$this->ListOptions->Add("copy");
		$item =& $this->ListOptions->Items["copy"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanAdd();
		$item->OnLeft = FALSE;

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($financial_year->Export <> "" ||
			$financial_year->CurrentAction == "gridadd" ||
			$financial_year->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $financial_year;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->CanAdd() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $financial_year;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $financial_year;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$financial_year->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$financial_year->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $financial_year->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$financial_year->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$financial_year->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$financial_year->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $financial_year;
		$financial_year->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$financial_year->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $financial_year;

		// Call Recordset Selecting event
		$financial_year->Recordset_Selecting($financial_year->CurrentFilter);

		// Load List page SQL
		$sSql = $financial_year->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$financial_year->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $financial_year;
		$sFilter = $financial_year->KeyFilter();

		// Call Row Selecting event
		$financial_year->Row_Selecting($sFilter);

		// Load SQL based on filter
		$financial_year->CurrentFilter = $sFilter;
		$sSql = $financial_year->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$financial_year->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $financial_year;
		$financial_year->financial_year_id->setDbValue($rs->fields('financial_year_id'));
		$financial_year->year_name->setDbValue($rs->fields('year_name'));
		$financial_year->date_start->setDbValue($rs->fields('date_start'));
		$financial_year->date_end->setDbValue($rs->fields('date_end'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $financial_year;

		// Initialize URLs
		$this->ViewUrl = $financial_year->ViewUrl();
		$this->EditUrl = $financial_year->EditUrl();
		$this->InlineEditUrl = $financial_year->InlineEditUrl();
		$this->CopyUrl = $financial_year->CopyUrl();
		$this->InlineCopyUrl = $financial_year->InlineCopyUrl();
		$this->DeleteUrl = $financial_year->DeleteUrl();

		// Call Row_Rendering event
		$financial_year->Row_Rendering();

		// Common render codes for all row types
		// financial_year_id

		$financial_year->financial_year_id->CellCssStyle = ""; $financial_year->financial_year_id->CellCssClass = "";
		$financial_year->financial_year_id->CellAttrs = array(); $financial_year->financial_year_id->ViewAttrs = array(); $financial_year->financial_year_id->EditAttrs = array();

		// year_name
		$financial_year->year_name->CellCssStyle = ""; $financial_year->year_name->CellCssClass = "";
		$financial_year->year_name->CellAttrs = array(); $financial_year->year_name->ViewAttrs = array(); $financial_year->year_name->EditAttrs = array();

		// date_start
		$financial_year->date_start->CellCssStyle = ""; $financial_year->date_start->CellCssClass = "";
		$financial_year->date_start->CellAttrs = array(); $financial_year->date_start->ViewAttrs = array(); $financial_year->date_start->EditAttrs = array();

		// date_end
		$financial_year->date_end->CellCssStyle = ""; $financial_year->date_end->CellCssClass = "";
		$financial_year->date_end->CellAttrs = array(); $financial_year->date_end->ViewAttrs = array(); $financial_year->date_end->EditAttrs = array();
		if ($financial_year->RowType == EW_ROWTYPE_VIEW) { // View row

			// financial_year_id
			$financial_year->financial_year_id->ViewValue = $financial_year->financial_year_id->CurrentValue;
			$financial_year->financial_year_id->CssStyle = "";
			$financial_year->financial_year_id->CssClass = "";
			$financial_year->financial_year_id->ViewCustomAttributes = "";

			// year_name
			$financial_year->year_name->ViewValue = $financial_year->year_name->CurrentValue;
			$financial_year->year_name->CssStyle = "";
			$financial_year->year_name->CssClass = "";
			$financial_year->year_name->ViewCustomAttributes = "";

			// date_start
			$financial_year->date_start->ViewValue = $financial_year->date_start->CurrentValue;
			$financial_year->date_start->ViewValue = ew_FormatDateTime($financial_year->date_start->ViewValue, 7);
			$financial_year->date_start->CssStyle = "";
			$financial_year->date_start->CssClass = "";
			$financial_year->date_start->ViewCustomAttributes = "";

			// date_end
			$financial_year->date_end->ViewValue = $financial_year->date_end->CurrentValue;
			$financial_year->date_end->ViewValue = ew_FormatDateTime($financial_year->date_end->ViewValue, 7);
			$financial_year->date_end->CssStyle = "";
			$financial_year->date_end->CssClass = "";
			$financial_year->date_end->ViewCustomAttributes = "";

			// financial_year_id
			$financial_year->financial_year_id->HrefValue = "";
			$financial_year->financial_year_id->TooltipValue = "";

			// year_name
			$financial_year->year_name->HrefValue = "";
			$financial_year->year_name->TooltipValue = "";

			// date_start
			$financial_year->date_start->HrefValue = "";
			$financial_year->date_start->TooltipValue = "";

			// date_end
			$financial_year->date_end->HrefValue = "";
			$financial_year->date_end->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($financial_year->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$financial_year->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $financial_year;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $financial_year->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($financial_year->ExportAll) {
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
		if ($financial_year->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($financial_year, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($financial_year->financial_year_id);
				$ExportDoc->ExportCaption($financial_year->year_name);
				$ExportDoc->ExportCaption($financial_year->date_start);
				$ExportDoc->ExportCaption($financial_year->date_end);
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
				$financial_year->CssClass = "";
				$financial_year->CssStyle = "";
				$financial_year->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($financial_year->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('financial_year_id', $financial_year->financial_year_id->ExportValue($financial_year->Export, $financial_year->ExportOriginalValue));
					$XmlDoc->AddField('year_name', $financial_year->year_name->ExportValue($financial_year->Export, $financial_year->ExportOriginalValue));
					$XmlDoc->AddField('date_start', $financial_year->date_start->ExportValue($financial_year->Export, $financial_year->ExportOriginalValue));
					$XmlDoc->AddField('date_end', $financial_year->date_end->ExportValue($financial_year->Export, $financial_year->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($financial_year->financial_year_id);
					$ExportDoc->ExportField($financial_year->year_name);
					$ExportDoc->ExportField($financial_year->date_start);
					$ExportDoc->ExportField($financial_year->date_end);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($financial_year->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($financial_year->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($financial_year->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($financial_year->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($financial_year->ExportReturnUrl());
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
