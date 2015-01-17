<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "school_typeinfo.php" ?>
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
$school_type_list = new cschool_type_list();
$Page =& $school_type_list;

// Page init
$school_type_list->Page_Init();

// Page main
$school_type_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($school_type->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var school_type_list = new ew_Page("school_type_list");

// page properties
school_type_list.PageID = "list"; // page ID
school_type_list.FormID = "fschool_typelist"; // form ID
var EW_PAGE_ID = school_type_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
school_type_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
school_type_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
school_type_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($school_type->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$school_type_list->lTotalRecs = $school_type->SelectRecordCount();
	} else {
		if ($rs = $school_type_list->LoadRecordset())
			$school_type_list->lTotalRecs = $rs->RecordCount();
	}
	$school_type_list->lStartRec = 1;
	if ($school_type_list->lDisplayRecs <= 0 || ($school_type->Export <> "" && $school_type->ExportAll)) // Display all records
		$school_type_list->lDisplayRecs = $school_type_list->lTotalRecs;
	if (!($school_type->Export <> "" && $school_type->ExportAll))
		$school_type_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $school_type_list->LoadRecordset($school_type_list->lStartRec-1, $school_type_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $school_type->TableCaption() ?>
<?php if ($school_type->Export == "" && $school_type->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $school_type_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $school_type_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $school_type_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($school_type->Export == "" && $school_type->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(school_type_list);" style="text-decoration: none;"><img id="school_type_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="school_type_list_SearchPanel">
<form name="fschool_typelistsrch" id="fschool_typelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="school_type">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $school_type_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="school_typesrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
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
$school_type_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fschool_typelist" id="fschool_typelist" class="ewForm" action="" method="post">
<div id="gmp_school_type" class="ewGridMiddlePanel">
<?php if ($school_type_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $school_type->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$school_type_list->RenderListOptions();

// Render list options (header, left)
$school_type_list->ListOptions->Render("header", "left");
?>
<?php if ($school_type->school_type_1->Visible) { // school_type ?>
	<?php if ($school_type->SortUrl($school_type->school_type_1) == "") { ?>
		<td><?php echo $school_type->school_type_1->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $school_type->SortUrl($school_type->school_type_1) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $school_type->school_type_1->FldCaption() ?></td><td style="width: 10px;"><?php if ($school_type->school_type_1->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($school_type->school_type_1->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($school_type->description->Visible) { // description ?>
	<?php if ($school_type->SortUrl($school_type->description) == "") { ?>
		<td><?php echo $school_type->description->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $school_type->SortUrl($school_type->description) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $school_type->description->FldCaption() ?></td><td style="width: 10px;"><?php if ($school_type->description->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($school_type->description->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$school_type_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($school_type->ExportAll && $school_type->Export <> "") {
	$school_type_list->lStopRec = $school_type_list->lTotalRecs;
} else {
	$school_type_list->lStopRec = $school_type_list->lStartRec + $school_type_list->lDisplayRecs - 1; // Set the last record to display
}
$school_type_list->lRecCount = $school_type_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $school_type_list->lStartRec > 1)
		$rs->Move($school_type_list->lStartRec - 1);
}

// Initialize aggregate
$school_type->RowType = EW_ROWTYPE_AGGREGATEINIT;
$school_type_list->RenderRow();
$school_type_list->lRowCnt = 0;
while (($school_type->CurrentAction == "gridadd" || !$rs->EOF) &&
	$school_type_list->lRecCount < $school_type_list->lStopRec) {
	$school_type_list->lRecCount++;
	if (intval($school_type_list->lRecCount) >= intval($school_type_list->lStartRec)) {
		$school_type_list->lRowCnt++;

	// Init row class and style
	$school_type->CssClass = "";
	$school_type->CssStyle = "";
	$school_type->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($school_type->CurrentAction == "gridadd") {
		$school_type_list->LoadDefaultValues(); // Load default values
	} else {
		$school_type_list->LoadRowValues($rs); // Load row values
	}
	$school_type->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$school_type_list->RenderRow();

	// Render list options
	$school_type_list->RenderListOptions();
?>
	<tr<?php echo $school_type->RowAttributes() ?>>
<?php

// Render list options (body, left)
$school_type_list->ListOptions->Render("body", "left");
?>
	<?php if ($school_type->school_type_1->Visible) { // school_type ?>
		<td<?php echo $school_type->school_type_1->CellAttributes() ?>>
<div<?php echo $school_type->school_type_1->ViewAttributes() ?>><?php echo $school_type->school_type_1->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($school_type->description->Visible) { // description ?>
		<td<?php echo $school_type->description->CellAttributes() ?>>
<div<?php echo $school_type->description->ViewAttributes() ?>><?php echo $school_type->description->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$school_type_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($school_type->CurrentAction <> "gridadd")
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
<?php if ($school_type->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($school_type->CurrentAction <> "gridadd" && $school_type->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($school_type_list->Pager)) $school_type_list->Pager = new cPrevNextPager($school_type_list->lStartRec, $school_type_list->lDisplayRecs, $school_type_list->lTotalRecs) ?>
<?php if ($school_type_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($school_type_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $school_type_list->PageUrl() ?>start=<?php echo $school_type_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($school_type_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $school_type_list->PageUrl() ?>start=<?php echo $school_type_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $school_type_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($school_type_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $school_type_list->PageUrl() ?>start=<?php echo $school_type_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($school_type_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $school_type_list->PageUrl() ?>start=<?php echo $school_type_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $school_type_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $school_type_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $school_type_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $school_type_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($school_type_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($school_type_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $school_type_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($school_type->Export == "" && $school_type->CurrentAction == "") { ?>
<?php } ?>
<?php if ($school_type->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$school_type_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cschool_type_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'school_type';

	// Page object name
	var $PageObjName = 'school_type_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $school_type;
		if ($school_type->UseTokenInUrl) $PageUrl .= "t=" . $school_type->TableVar . "&"; // Add page token
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
		global $objForm, $school_type;
		if ($school_type->UseTokenInUrl) {
			if ($objForm)
				return ($school_type->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($school_type->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cschool_type_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (school_type)
		$GLOBALS["school_type"] = new cschool_type();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["school_type"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "school_typedelete.php";
		$this->MultiUpdateUrl = "school_typeupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'school_type', TRUE);

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
		global $school_type;

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
			$school_type->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$school_type->Export = $_POST["exporttype"];
		} else {
			$school_type->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $school_type->Export; // Get export parameter, used in header
		$gsExportFile = $school_type->TableVar; // Get export file, used in header
		if ($school_type->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($school_type->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $school_type;

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
			$school_type->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($school_type->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $school_type->getRecordsPerPage(); // Restore from Session
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
		$school_type->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$school_type->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$school_type->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $school_type->getSearchWhere();
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
		$school_type->setSessionWhere($sFilter);
		$school_type->CurrentFilter = "";

		// Export data only
		if (in_array($school_type->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($school_type->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $school_type;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $school_type->school_type_id, FALSE); // school_type_id
		$this->BuildSearchSql($sWhere, $school_type->school_type_1, FALSE); // school_type
		$this->BuildSearchSql($sWhere, $school_type->description, FALSE); // description

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($school_type->school_type_id); // school_type_id
			$this->SetSearchParm($school_type->school_type_1); // school_type
			$this->SetSearchParm($school_type->description); // description
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
		global $school_type;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$school_type->setAdvancedSearch("x_$FldParm", $FldVal);
		$school_type->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$school_type->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$school_type->setAdvancedSearch("y_$FldParm", $FldVal2);
		$school_type->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $school_type;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $school_type->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $school_type->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $school_type->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $school_type->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $school_type->GetAdvancedSearch("w_$FldParm");
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
		global $school_type;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$school_type->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $school_type;
		$school_type->setAdvancedSearch("x_school_type_id", "");
		$school_type->setAdvancedSearch("x_school_type_1", "");
		$school_type->setAdvancedSearch("x_description", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $school_type;
		$bRestore = TRUE;
		if (@$_GET["x_school_type_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_school_type_1"] <> "") $bRestore = FALSE;
		if (@$_GET["x_description"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($school_type->school_type_id);
			$this->GetSearchParm($school_type->school_type_1);
			$this->GetSearchParm($school_type->description);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $school_type;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$school_type->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$school_type->CurrentOrderType = @$_GET["ordertype"];
			$school_type->UpdateSort($school_type->school_type_1); // school_type
			$school_type->UpdateSort($school_type->description); // description
			$school_type->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $school_type;
		$sOrderBy = $school_type->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($school_type->SqlOrderBy() <> "") {
				$sOrderBy = $school_type->SqlOrderBy();
				$school_type->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $school_type;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$school_type->setSessionOrderBy($sOrderBy);
				$school_type->school_type_1->setSort("");
				$school_type->description->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$school_type->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $school_type;

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
		if ($school_type->Export <> "" ||
			$school_type->CurrentAction == "gridadd" ||
			$school_type->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $school_type;
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
		global $Security, $Language, $school_type;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $school_type;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$school_type->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$school_type->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $school_type->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$school_type->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$school_type->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$school_type->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $school_type;

		// Load search values
		// school_type_id

		$school_type->school_type_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_school_type_id"]);
		$school_type->school_type_id->AdvancedSearch->SearchOperator = @$_GET["z_school_type_id"];

		// school_type
		$school_type->school_type_1->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_school_type_1"]);
		$school_type->school_type_1->AdvancedSearch->SearchOperator = @$_GET["z_school_type_1"];

		// description
		$school_type->description->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_description"]);
		$school_type->description->AdvancedSearch->SearchOperator = @$_GET["z_description"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $school_type;

		// Call Recordset Selecting event
		$school_type->Recordset_Selecting($school_type->CurrentFilter);

		// Load List page SQL
		$sSql = $school_type->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$school_type->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $school_type;
		$sFilter = $school_type->KeyFilter();

		// Call Row Selecting event
		$school_type->Row_Selecting($sFilter);

		// Load SQL based on filter
		$school_type->CurrentFilter = $sFilter;
		$sSql = $school_type->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$school_type->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $school_type;
		$school_type->school_type_id->setDbValue($rs->fields('school_type_id'));
		$school_type->school_type_1->setDbValue($rs->fields('school_type'));
		$school_type->description->setDbValue($rs->fields('description'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $school_type;

		// Initialize URLs
		$this->ViewUrl = $school_type->ViewUrl();
		$this->EditUrl = $school_type->EditUrl();
		$this->InlineEditUrl = $school_type->InlineEditUrl();
		$this->CopyUrl = $school_type->CopyUrl();
		$this->InlineCopyUrl = $school_type->InlineCopyUrl();
		$this->DeleteUrl = $school_type->DeleteUrl();

		// Call Row_Rendering event
		$school_type->Row_Rendering();

		// Common render codes for all row types
		// school_type

		$school_type->school_type_1->CellCssStyle = ""; $school_type->school_type_1->CellCssClass = "";
		$school_type->school_type_1->CellAttrs = array(); $school_type->school_type_1->ViewAttrs = array(); $school_type->school_type_1->EditAttrs = array();

		// description
		$school_type->description->CellCssStyle = ""; $school_type->description->CellCssClass = "";
		$school_type->description->CellAttrs = array(); $school_type->description->ViewAttrs = array(); $school_type->description->EditAttrs = array();
		if ($school_type->RowType == EW_ROWTYPE_VIEW) { // View row

			// school_type_id
			$school_type->school_type_id->ViewValue = $school_type->school_type_id->CurrentValue;
			$school_type->school_type_id->CssStyle = "";
			$school_type->school_type_id->CssClass = "";
			$school_type->school_type_id->ViewCustomAttributes = "";

			// school_type
			$school_type->school_type_1->ViewValue = $school_type->school_type_1->CurrentValue;
			$school_type->school_type_1->CssStyle = "";
			$school_type->school_type_1->CssClass = "";
			$school_type->school_type_1->ViewCustomAttributes = "";

			// description
			$school_type->description->ViewValue = $school_type->description->CurrentValue;
			$school_type->description->CssStyle = "";
			$school_type->description->CssClass = "";
			$school_type->description->ViewCustomAttributes = "";

			// school_type
			$school_type->school_type_1->HrefValue = "";
			$school_type->school_type_1->TooltipValue = "";

			// description
			$school_type->description->HrefValue = "";
			$school_type->description->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($school_type->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$school_type->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $school_type;

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
		global $school_type;
		$school_type->school_type_id->AdvancedSearch->SearchValue = $school_type->getAdvancedSearch("x_school_type_id");
		$school_type->school_type_1->AdvancedSearch->SearchValue = $school_type->getAdvancedSearch("x_school_type_1");
		$school_type->description->AdvancedSearch->SearchValue = $school_type->getAdvancedSearch("x_description");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $school_type;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $school_type->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($school_type->ExportAll) {
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
		if ($school_type->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($school_type, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($school_type->school_type_id);
				$ExportDoc->ExportCaption($school_type->school_type_1);
				$ExportDoc->ExportCaption($school_type->description);
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
				$school_type->CssClass = "";
				$school_type->CssStyle = "";
				$school_type->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($school_type->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('school_type_id', $school_type->school_type_id->ExportValue($school_type->Export, $school_type->ExportOriginalValue));
					$XmlDoc->AddField('school_type_1', $school_type->school_type_1->ExportValue($school_type->Export, $school_type->ExportOriginalValue));
					$XmlDoc->AddField('description', $school_type->description->ExportValue($school_type->Export, $school_type->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($school_type->school_type_id);
					$ExportDoc->ExportField($school_type->school_type_1);
					$ExportDoc->ExportField($school_type->description);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($school_type->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($school_type->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($school_type->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($school_type->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($school_type->ExportReturnUrl());
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
