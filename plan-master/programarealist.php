<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "programareainfo.php" ?>
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
$programarea_list = new cprogramarea_list();
$Page =& $programarea_list;

// Page init
$programarea_list->Page_Init();

// Page main
$programarea_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($programarea->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var programarea_list = new ew_Page("programarea_list");

// page properties
programarea_list.PageID = "list"; // page ID
programarea_list.FormID = "fprogramarealist"; // form ID
var EW_PAGE_ID = programarea_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
programarea_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
programarea_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
programarea_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($programarea->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$programarea_list->lTotalRecs = $programarea->SelectRecordCount();
	} else {
		if ($rs = $programarea_list->LoadRecordset())
			$programarea_list->lTotalRecs = $rs->RecordCount();
	}
	$programarea_list->lStartRec = 1;
	if ($programarea_list->lDisplayRecs <= 0 || ($programarea->Export <> "" && $programarea->ExportAll)) // Display all records
		$programarea_list->lDisplayRecs = $programarea_list->lTotalRecs;
	if (!($programarea->Export <> "" && $programarea->ExportAll))
		$programarea_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $programarea_list->LoadRecordset($programarea_list->lStartRec-1, $programarea_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $programarea->TableCaption() ?>
<?php if ($programarea->Export == "" && $programarea->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $programarea_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $programarea_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $programarea_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($programarea->Export == "" && $programarea->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(programarea_list);" style="text-decoration: none;"><img id="programarea_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="programarea_list_SearchPanel">
<form name="fprogramarealistsrch" id="fprogramarealistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="programarea">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $programarea_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="programareasrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
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
$programarea_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fprogramarealist" id="fprogramarealist" class="ewForm" action="" method="post">
<div id="gmp_programarea" class="ewGridMiddlePanel">
<?php if ($programarea_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $programarea->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$programarea_list->RenderListOptions();

// Render list options (header, left)
$programarea_list->ListOptions->Render("header", "left");
?>
<?php if ($programarea->programarea_name->Visible) { // programarea_name ?>
	<?php if ($programarea->SortUrl($programarea->programarea_name) == "") { ?>
		<td><?php echo $programarea->programarea_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $programarea->SortUrl($programarea->programarea_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $programarea->programarea_name->FldCaption() ?></td><td style="width: 10px;"><?php if ($programarea->programarea_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($programarea->programarea_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($programarea->regionID->Visible) { // regionID ?>
	<?php if ($programarea->SortUrl($programarea->regionID) == "") { ?>
		<td><?php echo $programarea->regionID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $programarea->SortUrl($programarea->regionID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $programarea->regionID->FldCaption() ?></td><td style="width: 10px;"><?php if ($programarea->regionID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($programarea->regionID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$programarea_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($programarea->ExportAll && $programarea->Export <> "") {
	$programarea_list->lStopRec = $programarea_list->lTotalRecs;
} else {
	$programarea_list->lStopRec = $programarea_list->lStartRec + $programarea_list->lDisplayRecs - 1; // Set the last record to display
}
$programarea_list->lRecCount = $programarea_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $programarea_list->lStartRec > 1)
		$rs->Move($programarea_list->lStartRec - 1);
}

// Initialize aggregate
$programarea->RowType = EW_ROWTYPE_AGGREGATEINIT;
$programarea_list->RenderRow();
$programarea_list->lRowCnt = 0;
while (($programarea->CurrentAction == "gridadd" || !$rs->EOF) &&
	$programarea_list->lRecCount < $programarea_list->lStopRec) {
	$programarea_list->lRecCount++;
	if (intval($programarea_list->lRecCount) >= intval($programarea_list->lStartRec)) {
		$programarea_list->lRowCnt++;

	// Init row class and style
	$programarea->CssClass = "";
	$programarea->CssStyle = "";
	$programarea->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($programarea->CurrentAction == "gridadd") {
		$programarea_list->LoadDefaultValues(); // Load default values
	} else {
		$programarea_list->LoadRowValues($rs); // Load row values
	}
	$programarea->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$programarea_list->RenderRow();

	// Render list options
	$programarea_list->RenderListOptions();
?>
	<tr<?php echo $programarea->RowAttributes() ?>>
<?php

// Render list options (body, left)
$programarea_list->ListOptions->Render("body", "left");
?>
	<?php if ($programarea->programarea_name->Visible) { // programarea_name ?>
		<td<?php echo $programarea->programarea_name->CellAttributes() ?>>
<div<?php echo $programarea->programarea_name->ViewAttributes() ?>><?php echo $programarea->programarea_name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($programarea->regionID->Visible) { // regionID ?>
		<td<?php echo $programarea->regionID->CellAttributes() ?>>
<div<?php echo $programarea->regionID->ViewAttributes() ?>><?php echo $programarea->regionID->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$programarea_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($programarea->CurrentAction <> "gridadd")
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
<?php if ($programarea->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($programarea->CurrentAction <> "gridadd" && $programarea->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($programarea_list->Pager)) $programarea_list->Pager = new cPrevNextPager($programarea_list->lStartRec, $programarea_list->lDisplayRecs, $programarea_list->lTotalRecs) ?>
<?php if ($programarea_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($programarea_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $programarea_list->PageUrl() ?>start=<?php echo $programarea_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($programarea_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $programarea_list->PageUrl() ?>start=<?php echo $programarea_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $programarea_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($programarea_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $programarea_list->PageUrl() ?>start=<?php echo $programarea_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($programarea_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $programarea_list->PageUrl() ?>start=<?php echo $programarea_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $programarea_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $programarea_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $programarea_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $programarea_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($programarea_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($programarea_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $programarea_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($programarea->Export == "" && $programarea->CurrentAction == "") { ?>
<?php } ?>
<?php if ($programarea->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$programarea_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cprogramarea_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'programarea';

	// Page object name
	var $PageObjName = 'programarea_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $programarea;
		if ($programarea->UseTokenInUrl) $PageUrl .= "t=" . $programarea->TableVar . "&"; // Add page token
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
		global $objForm, $programarea;
		if ($programarea->UseTokenInUrl) {
			if ($objForm)
				return ($programarea->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($programarea->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cprogramarea_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (programarea)
		$GLOBALS["programarea"] = new cprogramarea();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["programarea"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "programareadelete.php";
		$this->MultiUpdateUrl = "programareaupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'programarea', TRUE);

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
		global $programarea;

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
			$programarea->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$programarea->Export = $_POST["exporttype"];
		} else {
			$programarea->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $programarea->Export; // Get export parameter, used in header
		$gsExportFile = $programarea->TableVar; // Get export file, used in header
		if ($programarea->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($programarea->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $programarea;

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
			$programarea->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($programarea->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $programarea->getRecordsPerPage(); // Restore from Session
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
		$programarea->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$programarea->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$programarea->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $programarea->getSearchWhere();
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
		$programarea->setSessionWhere($sFilter);
		$programarea->CurrentFilter = "";

		// Export data only
		if (in_array($programarea->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($programarea->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $programarea;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $programarea->programarea_name, FALSE); // programarea_name
		$this->BuildSearchSql($sWhere, $programarea->regionID, FALSE); // regionID

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($programarea->programarea_name); // programarea_name
			$this->SetSearchParm($programarea->regionID); // regionID
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
		global $programarea;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$programarea->setAdvancedSearch("x_$FldParm", $FldVal);
		$programarea->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$programarea->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$programarea->setAdvancedSearch("y_$FldParm", $FldVal2);
		$programarea->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $programarea;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $programarea->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $programarea->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $programarea->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $programarea->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $programarea->GetAdvancedSearch("w_$FldParm");
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
		global $programarea;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$programarea->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $programarea;
		$programarea->setAdvancedSearch("x_programarea_name", "");
		$programarea->setAdvancedSearch("x_regionID", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $programarea;
		$bRestore = TRUE;
		if (@$_GET["x_programarea_name"] <> "") $bRestore = FALSE;
		if (@$_GET["x_regionID"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($programarea->programarea_name);
			$this->GetSearchParm($programarea->regionID);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $programarea;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$programarea->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$programarea->CurrentOrderType = @$_GET["ordertype"];
			$programarea->UpdateSort($programarea->programarea_name); // programarea_name
			$programarea->UpdateSort($programarea->regionID); // regionID
			$programarea->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $programarea;
		$sOrderBy = $programarea->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($programarea->SqlOrderBy() <> "") {
				$sOrderBy = $programarea->SqlOrderBy();
				$programarea->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $programarea;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$programarea->setSessionOrderBy($sOrderBy);
				$programarea->programarea_name->setSort("");
				$programarea->regionID->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$programarea->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $programarea;

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

		// "detail_sponsored_student_detail"
		$this->ListOptions->Add("detail_sponsored_student_detail");
		$item =& $this->ListOptions->Items["detail_sponsored_student_detail"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('sponsored_student_detail');
		$item->OnLeft = FALSE;

		// "detail_schools"
		$this->ListOptions->Add("detail_schools");
		$item =& $this->ListOptions->Items["detail_schools"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('schools');
		$item->OnLeft = FALSE;

		// "detail_districts"
		$this->ListOptions->Add("detail_districts");
		$item =& $this->ListOptions->Items["detail_districts"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('districts');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($programarea->Export <> "" ||
			$programarea->CurrentAction == "gridadd" ||
			$programarea->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $programarea;
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

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . "<img src=\"images/delete.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";

		// "detail_sponsored_student_detail"
		$oListOpt =& $this->ListOptions->Items["detail_sponsored_student_detail"];
		if ($Security->AllowList('sponsored_student_detail')) {
			$oListOpt->Body = "<img src=\"images/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("sponsored_student_detail", "TblCaption");
			$oListOpt->Body = "<a href=\"sponsored_student_detaillist.php?" . EW_TABLE_SHOW_MASTER . "=programarea&programarea_id=" . urlencode(strval($programarea->programarea_id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_schools"
		$oListOpt =& $this->ListOptions->Items["detail_schools"];
		if ($Security->AllowList('schools')) {
			$oListOpt->Body = "<img src=\"images/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("schools", "TblCaption");
			$oListOpt->Body = "<a href=\"schoolslist.php?" . EW_TABLE_SHOW_MASTER . "=programarea&programarea_id=" . urlencode(strval($programarea->programarea_id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_districts"
		$oListOpt =& $this->ListOptions->Items["detail_districts"];
		if ($Security->AllowList('districts')) {
			$oListOpt->Body = "<img src=\"images/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("districts", "TblCaption");
			$oListOpt->Body = "<a href=\"districtslist.php?" . EW_TABLE_SHOW_MASTER . "=programarea&programarea_id=" . urlencode(strval($programarea->programarea_id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $programarea;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $programarea;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$programarea->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$programarea->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $programarea->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$programarea->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$programarea->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$programarea->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $programarea;

		// Load search values
		// programarea_name

		$programarea->programarea_name->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programarea_name"]);
		$programarea->programarea_name->AdvancedSearch->SearchOperator = @$_GET["z_programarea_name"];

		// regionID
		$programarea->regionID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_regionID"]);
		$programarea->regionID->AdvancedSearch->SearchOperator = @$_GET["z_regionID"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $programarea;

		// Call Recordset Selecting event
		$programarea->Recordset_Selecting($programarea->CurrentFilter);

		// Load List page SQL
		$sSql = $programarea->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$programarea->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $programarea;
		$sFilter = $programarea->KeyFilter();

		// Call Row Selecting event
		$programarea->Row_Selecting($sFilter);

		// Load SQL based on filter
		$programarea->CurrentFilter = $sFilter;
		$sSql = $programarea->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$programarea->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $programarea;
		$programarea->programarea_id->setDbValue($rs->fields('programarea_id'));
		$programarea->address->setDbValue($rs->fields('address'));
		$programarea->programarea_name->setDbValue($rs->fields('programarea_name'));
		$programarea->regionID->setDbValue($rs->fields('regionID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $programarea;

		// Initialize URLs
		$this->ViewUrl = $programarea->ViewUrl();
		$this->EditUrl = $programarea->EditUrl();
		$this->InlineEditUrl = $programarea->InlineEditUrl();
		$this->CopyUrl = $programarea->CopyUrl();
		$this->InlineCopyUrl = $programarea->InlineCopyUrl();
		$this->DeleteUrl = $programarea->DeleteUrl();

		// Call Row_Rendering event
		$programarea->Row_Rendering();

		// Common render codes for all row types
		// programarea_name

		$programarea->programarea_name->CellCssStyle = ""; $programarea->programarea_name->CellCssClass = "";
		$programarea->programarea_name->CellAttrs = array(); $programarea->programarea_name->ViewAttrs = array(); $programarea->programarea_name->EditAttrs = array();

		// regionID
		$programarea->regionID->CellCssStyle = ""; $programarea->regionID->CellCssClass = "";
		$programarea->regionID->CellAttrs = array(); $programarea->regionID->ViewAttrs = array(); $programarea->regionID->EditAttrs = array();
		if ($programarea->RowType == EW_ROWTYPE_VIEW) { // View row

			// programarea_id
			$programarea->programarea_id->ViewValue = $programarea->programarea_id->CurrentValue;
			$programarea->programarea_id->CssStyle = "";
			$programarea->programarea_id->CssClass = "";
			$programarea->programarea_id->ViewCustomAttributes = "";

			// programarea_name
			$programarea->programarea_name->ViewValue = $programarea->programarea_name->CurrentValue;
			$programarea->programarea_name->CssStyle = "";
			$programarea->programarea_name->CssClass = "";
			$programarea->programarea_name->ViewCustomAttributes = "";

			// regionID
			if (strval($programarea->regionID->CurrentValue) <> "") {
				$sFilterWrk = "`RegionID` = " . ew_AdjustSql($programarea->regionID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Region` FROM `regions`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$programarea->regionID->ViewValue = $rswrk->fields('Region');
					$rswrk->Close();
				} else {
					$programarea->regionID->ViewValue = $programarea->regionID->CurrentValue;
				}
			} else {
				$programarea->regionID->ViewValue = NULL;
			}
			$programarea->regionID->CssStyle = "";
			$programarea->regionID->CssClass = "";
			$programarea->regionID->ViewCustomAttributes = "";

			// programarea_name
			$programarea->programarea_name->HrefValue = "";
			$programarea->programarea_name->TooltipValue = "";

			// regionID
			$programarea->regionID->HrefValue = "";
			$programarea->regionID->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($programarea->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$programarea->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $programarea;

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
		global $programarea;
		$programarea->programarea_name->AdvancedSearch->SearchValue = $programarea->getAdvancedSearch("x_programarea_name");
		$programarea->regionID->AdvancedSearch->SearchValue = $programarea->getAdvancedSearch("x_regionID");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $programarea;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $programarea->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($programarea->ExportAll) {
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
		if ($programarea->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($programarea, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($programarea->programarea_id);
				$ExportDoc->ExportCaption($programarea->programarea_name);
				$ExportDoc->ExportCaption($programarea->regionID);
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
				$programarea->CssClass = "";
				$programarea->CssStyle = "";
				$programarea->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($programarea->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('programarea_id', $programarea->programarea_id->ExportValue($programarea->Export, $programarea->ExportOriginalValue));
					$XmlDoc->AddField('programarea_name', $programarea->programarea_name->ExportValue($programarea->Export, $programarea->ExportOriginalValue));
					$XmlDoc->AddField('regionID', $programarea->regionID->ExportValue($programarea->Export, $programarea->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($programarea->programarea_id);
					$ExportDoc->ExportField($programarea->programarea_name);
					$ExportDoc->ExportField($programarea->regionID);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($programarea->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($programarea->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($programarea->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($programarea->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($programarea->ExportReturnUrl());
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
