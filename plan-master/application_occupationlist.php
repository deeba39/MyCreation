<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "application_occupationinfo.php" ?>
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
$application_occupation_list = new capplication_occupation_list();
$Page =& $application_occupation_list;

// Page init
$application_occupation_list->Page_Init();

// Page main
$application_occupation_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($application_occupation->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var application_occupation_list = new ew_Page("application_occupation_list");

// page properties
application_occupation_list.PageID = "list"; // page ID
application_occupation_list.FormID = "fapplication_occupationlist"; // form ID
var EW_PAGE_ID = application_occupation_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
application_occupation_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
application_occupation_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
application_occupation_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($application_occupation->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$application_occupation_list->lTotalRecs = $application_occupation->SelectRecordCount();
	} else {
		if ($rs = $application_occupation_list->LoadRecordset())
			$application_occupation_list->lTotalRecs = $rs->RecordCount();
	}
	$application_occupation_list->lStartRec = 1;
	if ($application_occupation_list->lDisplayRecs <= 0 || ($application_occupation->Export <> "" && $application_occupation->ExportAll)) // Display all records
		$application_occupation_list->lDisplayRecs = $application_occupation_list->lTotalRecs;
	if (!($application_occupation->Export <> "" && $application_occupation->ExportAll))
		$application_occupation_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $application_occupation_list->LoadRecordset($application_occupation_list->lStartRec-1, $application_occupation_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $application_occupation->TableCaption() ?>
<?php if ($application_occupation->Export == "" && $application_occupation->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $application_occupation_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $application_occupation_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $application_occupation_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($application_occupation->Export == "" && $application_occupation->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(application_occupation_list);" style="text-decoration: none;"><img id="application_occupation_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="application_occupation_list_SearchPanel">
<form name="fapplication_occupationlistsrch" id="fapplication_occupationlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="application_occupation">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $application_occupation_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="application_occupationsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
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
$application_occupation_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fapplication_occupationlist" id="fapplication_occupationlist" class="ewForm" action="" method="post">
<div id="gmp_application_occupation" class="ewGridMiddlePanel">
<?php if ($application_occupation_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $application_occupation->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$application_occupation_list->RenderListOptions();

// Render list options (header, left)
$application_occupation_list->ListOptions->Render("header", "left");
?>
<?php if ($application_occupation->name->Visible) { // name ?>
	<?php if ($application_occupation->SortUrl($application_occupation->name) == "") { ?>
		<td><?php echo $application_occupation->name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $application_occupation->SortUrl($application_occupation->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $application_occupation->name->FldCaption() ?></td><td style="width: 10px;"><?php if ($application_occupation->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($application_occupation->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($application_occupation->description->Visible) { // description ?>
	<?php if ($application_occupation->SortUrl($application_occupation->description) == "") { ?>
		<td><?php echo $application_occupation->description->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $application_occupation->SortUrl($application_occupation->description) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $application_occupation->description->FldCaption() ?></td><td style="width: 10px;"><?php if ($application_occupation->description->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($application_occupation->description->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($application_occupation->app_point->Visible) { // app_point ?>
	<?php if ($application_occupation->SortUrl($application_occupation->app_point) == "") { ?>
		<td><?php echo $application_occupation->app_point->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $application_occupation->SortUrl($application_occupation->app_point) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $application_occupation->app_point->FldCaption() ?></td><td style="width: 10px;"><?php if ($application_occupation->app_point->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($application_occupation->app_point->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$application_occupation_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($application_occupation->ExportAll && $application_occupation->Export <> "") {
	$application_occupation_list->lStopRec = $application_occupation_list->lTotalRecs;
} else {
	$application_occupation_list->lStopRec = $application_occupation_list->lStartRec + $application_occupation_list->lDisplayRecs - 1; // Set the last record to display
}
$application_occupation_list->lRecCount = $application_occupation_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $application_occupation_list->lStartRec > 1)
		$rs->Move($application_occupation_list->lStartRec - 1);
}

// Initialize aggregate
$application_occupation->RowType = EW_ROWTYPE_AGGREGATEINIT;
$application_occupation_list->RenderRow();
$application_occupation_list->lRowCnt = 0;
while (($application_occupation->CurrentAction == "gridadd" || !$rs->EOF) &&
	$application_occupation_list->lRecCount < $application_occupation_list->lStopRec) {
	$application_occupation_list->lRecCount++;
	if (intval($application_occupation_list->lRecCount) >= intval($application_occupation_list->lStartRec)) {
		$application_occupation_list->lRowCnt++;

	// Init row class and style
	$application_occupation->CssClass = "";
	$application_occupation->CssStyle = "";
	$application_occupation->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($application_occupation->CurrentAction == "gridadd") {
		$application_occupation_list->LoadDefaultValues(); // Load default values
	} else {
		$application_occupation_list->LoadRowValues($rs); // Load row values
	}
	$application_occupation->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$application_occupation_list->RenderRow();

	// Render list options
	$application_occupation_list->RenderListOptions();
?>
	<tr<?php echo $application_occupation->RowAttributes() ?>>
<?php

// Render list options (body, left)
$application_occupation_list->ListOptions->Render("body", "left");
?>
	<?php if ($application_occupation->name->Visible) { // name ?>
		<td<?php echo $application_occupation->name->CellAttributes() ?>>
<div<?php echo $application_occupation->name->ViewAttributes() ?>><?php echo $application_occupation->name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($application_occupation->description->Visible) { // description ?>
		<td<?php echo $application_occupation->description->CellAttributes() ?>>
<div<?php echo $application_occupation->description->ViewAttributes() ?>><?php echo $application_occupation->description->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($application_occupation->app_point->Visible) { // app_point ?>
		<td<?php echo $application_occupation->app_point->CellAttributes() ?>>
<div<?php echo $application_occupation->app_point->ViewAttributes() ?>><?php echo $application_occupation->app_point->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$application_occupation_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($application_occupation->CurrentAction <> "gridadd")
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
<?php if ($application_occupation->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($application_occupation->CurrentAction <> "gridadd" && $application_occupation->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($application_occupation_list->Pager)) $application_occupation_list->Pager = new cPrevNextPager($application_occupation_list->lStartRec, $application_occupation_list->lDisplayRecs, $application_occupation_list->lTotalRecs) ?>
<?php if ($application_occupation_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($application_occupation_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $application_occupation_list->PageUrl() ?>start=<?php echo $application_occupation_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($application_occupation_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $application_occupation_list->PageUrl() ?>start=<?php echo $application_occupation_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $application_occupation_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($application_occupation_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $application_occupation_list->PageUrl() ?>start=<?php echo $application_occupation_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($application_occupation_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $application_occupation_list->PageUrl() ?>start=<?php echo $application_occupation_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $application_occupation_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $application_occupation_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $application_occupation_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $application_occupation_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($application_occupation_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($application_occupation_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $application_occupation_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($application_occupation->Export == "" && $application_occupation->CurrentAction == "") { ?>
<?php } ?>
<?php if ($application_occupation->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$application_occupation_list->Page_Terminate();
?>
<?php

//
// Page class
//
class capplication_occupation_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'application_occupation';

	// Page object name
	var $PageObjName = 'application_occupation_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $application_occupation;
		if ($application_occupation->UseTokenInUrl) $PageUrl .= "t=" . $application_occupation->TableVar . "&"; // Add page token
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
		global $objForm, $application_occupation;
		if ($application_occupation->UseTokenInUrl) {
			if ($objForm)
				return ($application_occupation->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($application_occupation->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function capplication_occupation_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (application_occupation)
		$GLOBALS["application_occupation"] = new capplication_occupation();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["application_occupation"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "application_occupationdelete.php";
		$this->MultiUpdateUrl = "application_occupationupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'application_occupation', TRUE);

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
		global $application_occupation;

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
			$application_occupation->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$application_occupation->Export = $_POST["exporttype"];
		} else {
			$application_occupation->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $application_occupation->Export; // Get export parameter, used in header
		$gsExportFile = $application_occupation->TableVar; // Get export file, used in header
		if ($application_occupation->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($application_occupation->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $application_occupation;

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
			$application_occupation->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($application_occupation->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $application_occupation->getRecordsPerPage(); // Restore from Session
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
		$application_occupation->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$application_occupation->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$application_occupation->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $application_occupation->getSearchWhere();
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
		$application_occupation->setSessionWhere($sFilter);
		$application_occupation->CurrentFilter = "";

		// Export data only
		if (in_array($application_occupation->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($application_occupation->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $application_occupation;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $application_occupation->app_point, FALSE); // app_point

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($application_occupation->app_point); // app_point
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
		global $application_occupation;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$application_occupation->setAdvancedSearch("x_$FldParm", $FldVal);
		$application_occupation->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$application_occupation->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$application_occupation->setAdvancedSearch("y_$FldParm", $FldVal2);
		$application_occupation->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $application_occupation;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $application_occupation->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $application_occupation->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $application_occupation->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $application_occupation->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $application_occupation->GetAdvancedSearch("w_$FldParm");
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
		global $application_occupation;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$application_occupation->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $application_occupation;
		$application_occupation->setAdvancedSearch("x_app_point", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $application_occupation;
		$bRestore = TRUE;
		if (@$_GET["x_app_point"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($application_occupation->app_point);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $application_occupation;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$application_occupation->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$application_occupation->CurrentOrderType = @$_GET["ordertype"];
			$application_occupation->UpdateSort($application_occupation->name); // name
			$application_occupation->UpdateSort($application_occupation->description); // description
			$application_occupation->UpdateSort($application_occupation->app_point); // app_point
			$application_occupation->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $application_occupation;
		$sOrderBy = $application_occupation->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($application_occupation->SqlOrderBy() <> "") {
				$sOrderBy = $application_occupation->SqlOrderBy();
				$application_occupation->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $application_occupation;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$application_occupation->setSessionOrderBy($sOrderBy);
				$application_occupation->name->setSort("");
				$application_occupation->description->setSort("");
				$application_occupation->app_point->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$application_occupation->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $application_occupation;

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
		if ($application_occupation->Export <> "" ||
			$application_occupation->CurrentAction == "gridadd" ||
			$application_occupation->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $application_occupation;
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

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $application_occupation;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $application_occupation;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$application_occupation->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$application_occupation->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $application_occupation->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$application_occupation->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$application_occupation->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$application_occupation->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $application_occupation;

		// Load search values
		// app_point

		$application_occupation->app_point->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_point"]);
		$application_occupation->app_point->AdvancedSearch->SearchOperator = @$_GET["z_app_point"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $application_occupation;

		// Call Recordset Selecting event
		$application_occupation->Recordset_Selecting($application_occupation->CurrentFilter);

		// Load List page SQL
		$sSql = $application_occupation->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$application_occupation->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $application_occupation;
		$sFilter = $application_occupation->KeyFilter();

		// Call Row Selecting event
		$application_occupation->Row_Selecting($sFilter);

		// Load SQL based on filter
		$application_occupation->CurrentFilter = $sFilter;
		$sSql = $application_occupation->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$application_occupation->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $application_occupation;
		$application_occupation->application_occupation_id->setDbValue($rs->fields('application_occupation_id'));
		$application_occupation->name->setDbValue($rs->fields('name'));
		$application_occupation->description->setDbValue($rs->fields('description'));
		$application_occupation->app_point->setDbValue($rs->fields('app_point'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $application_occupation;

		// Initialize URLs
		$this->ViewUrl = $application_occupation->ViewUrl();
		$this->EditUrl = $application_occupation->EditUrl();
		$this->InlineEditUrl = $application_occupation->InlineEditUrl();
		$this->CopyUrl = $application_occupation->CopyUrl();
		$this->InlineCopyUrl = $application_occupation->InlineCopyUrl();
		$this->DeleteUrl = $application_occupation->DeleteUrl();

		// Call Row_Rendering event
		$application_occupation->Row_Rendering();

		// Common render codes for all row types
		// name

		$application_occupation->name->CellCssStyle = ""; $application_occupation->name->CellCssClass = "";
		$application_occupation->name->CellAttrs = array(); $application_occupation->name->ViewAttrs = array(); $application_occupation->name->EditAttrs = array();

		// description
		$application_occupation->description->CellCssStyle = ""; $application_occupation->description->CellCssClass = "";
		$application_occupation->description->CellAttrs = array(); $application_occupation->description->ViewAttrs = array(); $application_occupation->description->EditAttrs = array();

		// app_point
		$application_occupation->app_point->CellCssStyle = ""; $application_occupation->app_point->CellCssClass = "";
		$application_occupation->app_point->CellAttrs = array(); $application_occupation->app_point->ViewAttrs = array(); $application_occupation->app_point->EditAttrs = array();
		if ($application_occupation->RowType == EW_ROWTYPE_VIEW) { // View row

			// application_occupation_id
			$application_occupation->application_occupation_id->ViewValue = $application_occupation->application_occupation_id->CurrentValue;
			$application_occupation->application_occupation_id->CssStyle = "";
			$application_occupation->application_occupation_id->CssClass = "";
			$application_occupation->application_occupation_id->ViewCustomAttributes = "";

			// name
			$application_occupation->name->ViewValue = $application_occupation->name->CurrentValue;
			$application_occupation->name->CssStyle = "";
			$application_occupation->name->CssClass = "";
			$application_occupation->name->ViewCustomAttributes = "";

			// description
			$application_occupation->description->ViewValue = $application_occupation->description->CurrentValue;
			$application_occupation->description->CssStyle = "";
			$application_occupation->description->CssClass = "";
			$application_occupation->description->ViewCustomAttributes = "";

			// app_point
			$application_occupation->app_point->ViewValue = $application_occupation->app_point->CurrentValue;
			$application_occupation->app_point->CssStyle = "";
			$application_occupation->app_point->CssClass = "";
			$application_occupation->app_point->ViewCustomAttributes = "";

			// name
			$application_occupation->name->HrefValue = "";
			$application_occupation->name->TooltipValue = "";

			// description
			$application_occupation->description->HrefValue = "";
			$application_occupation->description->TooltipValue = "";

			// app_point
			$application_occupation->app_point->HrefValue = "";
			$application_occupation->app_point->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($application_occupation->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$application_occupation->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $application_occupation;

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
		global $application_occupation;
		$application_occupation->app_point->AdvancedSearch->SearchValue = $application_occupation->getAdvancedSearch("x_app_point");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $application_occupation;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $application_occupation->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($application_occupation->ExportAll) {
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
		if ($application_occupation->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($application_occupation, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($application_occupation->application_occupation_id);
				$ExportDoc->ExportCaption($application_occupation->name);
				$ExportDoc->ExportCaption($application_occupation->description);
				$ExportDoc->ExportCaption($application_occupation->app_point);
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
				$application_occupation->CssClass = "";
				$application_occupation->CssStyle = "";
				$application_occupation->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($application_occupation->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('application_occupation_id', $application_occupation->application_occupation_id->ExportValue($application_occupation->Export, $application_occupation->ExportOriginalValue));
					$XmlDoc->AddField('name', $application_occupation->name->ExportValue($application_occupation->Export, $application_occupation->ExportOriginalValue));
					$XmlDoc->AddField('description', $application_occupation->description->ExportValue($application_occupation->Export, $application_occupation->ExportOriginalValue));
					$XmlDoc->AddField('app_point', $application_occupation->app_point->ExportValue($application_occupation->Export, $application_occupation->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($application_occupation->application_occupation_id);
					$ExportDoc->ExportField($application_occupation->name);
					$ExportDoc->ExportField($application_occupation->description);
					$ExportDoc->ExportField($application_occupation->app_point);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($application_occupation->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($application_occupation->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($application_occupation->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($application_occupation->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($application_occupation->ExportReturnUrl());
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
