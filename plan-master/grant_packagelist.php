<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "grant_packageinfo.php" ?>
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
$grant_package_list = new cgrant_package_list();
$Page =& $grant_package_list;

// Page init
$grant_package_list->Page_Init();

// Page main
$grant_package_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($grant_package->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var grant_package_list = new ew_Page("grant_package_list");

// page properties
grant_package_list.PageID = "list"; // page ID
grant_package_list.FormID = "fgrant_packagelist"; // form ID
var EW_PAGE_ID = grant_package_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
grant_package_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grant_package_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grant_package_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($grant_package->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$grant_package_list->lTotalRecs = $grant_package->SelectRecordCount();
	} else {
		if ($rs = $grant_package_list->LoadRecordset())
			$grant_package_list->lTotalRecs = $rs->RecordCount();
	}
	$grant_package_list->lStartRec = 1;
	if ($grant_package_list->lDisplayRecs <= 0 || ($grant_package->Export <> "" && $grant_package->ExportAll)) // Display all records
		$grant_package_list->lDisplayRecs = $grant_package_list->lTotalRecs;
	if (!($grant_package->Export <> "" && $grant_package->ExportAll))
		$grant_package_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $grant_package_list->LoadRecordset($grant_package_list->lStartRec-1, $grant_package_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grant_package->TableCaption() ?>
<?php if ($grant_package->Export == "" && $grant_package->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $grant_package_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $grant_package_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $grant_package_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($grant_package->Export == "" && $grant_package->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(grant_package_list);" style="text-decoration: none;"><img id="grant_package_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="grant_package_list_SearchPanel">
<form name="fgrant_packagelistsrch" id="fgrant_packagelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="grant_package">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $grant_package_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="grant_packagesrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
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
$grant_package_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fgrant_packagelist" id="fgrant_packagelist" class="ewForm" action="" method="post">
<div id="gmp_grant_package" class="ewGridMiddlePanel">
<?php if ($grant_package_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $grant_package->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$grant_package_list->RenderListOptions();

// Render list options (header, left)
$grant_package_list->ListOptions->Render("header", "left");
?>
<?php if ($grant_package->name->Visible) { // name ?>
	<?php if ($grant_package->SortUrl($grant_package->name) == "") { ?>
		<td><?php echo $grant_package->name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grant_package->SortUrl($grant_package->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grant_package->name->FldCaption() ?></td><td style="width: 10px;"><?php if ($grant_package->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grant_package->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grant_package->code->Visible) { // code ?>
	<?php if ($grant_package->SortUrl($grant_package->code) == "") { ?>
		<td><?php echo $grant_package->code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grant_package->SortUrl($grant_package->code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grant_package->code->FldCaption() ?></td><td style="width: 10px;"><?php if ($grant_package->code->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grant_package->code->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grant_package->annual_amount->Visible) { // annual_amount ?>
	<?php if ($grant_package->SortUrl($grant_package->annual_amount) == "") { ?>
		<td><?php echo $grant_package->annual_amount->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grant_package->SortUrl($grant_package->annual_amount) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grant_package->annual_amount->FldCaption() ?></td><td style="width: 10px;"><?php if ($grant_package->annual_amount->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grant_package->annual_amount->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$grant_package_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($grant_package->ExportAll && $grant_package->Export <> "") {
	$grant_package_list->lStopRec = $grant_package_list->lTotalRecs;
} else {
	$grant_package_list->lStopRec = $grant_package_list->lStartRec + $grant_package_list->lDisplayRecs - 1; // Set the last record to display
}
$grant_package_list->lRecCount = $grant_package_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $grant_package_list->lStartRec > 1)
		$rs->Move($grant_package_list->lStartRec - 1);
}

// Initialize aggregate
$grant_package->RowType = EW_ROWTYPE_AGGREGATEINIT;
$grant_package_list->RenderRow();
$grant_package_list->lRowCnt = 0;
while (($grant_package->CurrentAction == "gridadd" || !$rs->EOF) &&
	$grant_package_list->lRecCount < $grant_package_list->lStopRec) {
	$grant_package_list->lRecCount++;
	if (intval($grant_package_list->lRecCount) >= intval($grant_package_list->lStartRec)) {
		$grant_package_list->lRowCnt++;

	// Init row class and style
	$grant_package->CssClass = "";
	$grant_package->CssStyle = "";
	$grant_package->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($grant_package->CurrentAction == "gridadd") {
		$grant_package_list->LoadDefaultValues(); // Load default values
	} else {
		$grant_package_list->LoadRowValues($rs); // Load row values
	}
	$grant_package->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$grant_package_list->RenderRow();

	// Render list options
	$grant_package_list->RenderListOptions();
?>
	<tr<?php echo $grant_package->RowAttributes() ?>>
<?php

// Render list options (body, left)
$grant_package_list->ListOptions->Render("body", "left");
?>
	<?php if ($grant_package->name->Visible) { // name ?>
		<td<?php echo $grant_package->name->CellAttributes() ?>>
<div<?php echo $grant_package->name->ViewAttributes() ?>><?php echo $grant_package->name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($grant_package->code->Visible) { // code ?>
		<td<?php echo $grant_package->code->CellAttributes() ?>>
<div<?php echo $grant_package->code->ViewAttributes() ?>><?php echo $grant_package->code->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($grant_package->annual_amount->Visible) { // annual_amount ?>
		<td<?php echo $grant_package->annual_amount->CellAttributes() ?>>
<div<?php echo $grant_package->annual_amount->ViewAttributes() ?>><?php echo $grant_package->annual_amount->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$grant_package_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($grant_package->CurrentAction <> "gridadd")
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
<?php if ($grant_package->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($grant_package->CurrentAction <> "gridadd" && $grant_package->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($grant_package_list->Pager)) $grant_package_list->Pager = new cPrevNextPager($grant_package_list->lStartRec, $grant_package_list->lDisplayRecs, $grant_package_list->lTotalRecs) ?>
<?php if ($grant_package_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($grant_package_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $grant_package_list->PageUrl() ?>start=<?php echo $grant_package_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($grant_package_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $grant_package_list->PageUrl() ?>start=<?php echo $grant_package_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $grant_package_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($grant_package_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $grant_package_list->PageUrl() ?>start=<?php echo $grant_package_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($grant_package_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $grant_package_list->PageUrl() ?>start=<?php echo $grant_package_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $grant_package_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $grant_package_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $grant_package_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $grant_package_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($grant_package_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($grant_package_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $grant_package_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($grant_package->Export == "" && $grant_package->CurrentAction == "") { ?>
<?php } ?>
<?php if ($grant_package->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$grant_package_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrant_package_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'grant_package';

	// Page object name
	var $PageObjName = 'grant_package_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grant_package;
		if ($grant_package->UseTokenInUrl) $PageUrl .= "t=" . $grant_package->TableVar . "&"; // Add page token
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
		global $objForm, $grant_package;
		if ($grant_package->UseTokenInUrl) {
			if ($objForm)
				return ($grant_package->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grant_package->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrant_package_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (grant_package)
		$GLOBALS["grant_package"] = new cgrant_package();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["grant_package"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "grant_packagedelete.php";
		$this->MultiUpdateUrl = "grant_packageupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grant_package', TRUE);

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
		global $grant_package;

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
			$grant_package->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$grant_package->Export = $_POST["exporttype"];
		} else {
			$grant_package->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $grant_package->Export; // Get export parameter, used in header
		$gsExportFile = $grant_package->TableVar; // Get export file, used in header
		if ($grant_package->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($grant_package->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $grant_package;

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
			$grant_package->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($grant_package->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $grant_package->getRecordsPerPage(); // Restore from Session
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
		$grant_package->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$grant_package->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$grant_package->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $grant_package->getSearchWhere();
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
		$grant_package->setSessionWhere($sFilter);
		$grant_package->CurrentFilter = "";

		// Export data only
		if (in_array($grant_package->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($grant_package->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $grant_package;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $grant_package->name, FALSE); // name
		$this->BuildSearchSql($sWhere, $grant_package->code, FALSE); // code
		$this->BuildSearchSql($sWhere, $grant_package->annual_amount, FALSE); // annual_amount

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($grant_package->name); // name
			$this->SetSearchParm($grant_package->code); // code
			$this->SetSearchParm($grant_package->annual_amount); // annual_amount
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
		global $grant_package;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$grant_package->setAdvancedSearch("x_$FldParm", $FldVal);
		$grant_package->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$grant_package->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$grant_package->setAdvancedSearch("y_$FldParm", $FldVal2);
		$grant_package->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $grant_package;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $grant_package->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $grant_package->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $grant_package->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $grant_package->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $grant_package->GetAdvancedSearch("w_$FldParm");
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
		global $grant_package;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$grant_package->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $grant_package;
		$grant_package->setAdvancedSearch("x_name", "");
		$grant_package->setAdvancedSearch("x_code", "");
		$grant_package->setAdvancedSearch("x_annual_amount", "");
		$grant_package->setAdvancedSearch("z_annual_amount", "");
		$grant_package->setAdvancedSearch("y_annual_amount", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $grant_package;
		$bRestore = TRUE;
		if (@$_GET["x_name"] <> "") $bRestore = FALSE;
		if (@$_GET["x_code"] <> "") $bRestore = FALSE;
		if (@$_GET["x_annual_amount"] <> "") $bRestore = FALSE;
		if (@$_GET["y_annual_amount"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($grant_package->name);
			$this->GetSearchParm($grant_package->code);
			$this->GetSearchParm($grant_package->annual_amount);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $grant_package;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$grant_package->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$grant_package->CurrentOrderType = @$_GET["ordertype"];
			$grant_package->UpdateSort($grant_package->name); // name
			$grant_package->UpdateSort($grant_package->code); // code
			$grant_package->UpdateSort($grant_package->annual_amount); // annual_amount
			$grant_package->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $grant_package;
		$sOrderBy = $grant_package->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($grant_package->SqlOrderBy() <> "") {
				$sOrderBy = $grant_package->SqlOrderBy();
				$grant_package->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $grant_package;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$grant_package->setSessionOrderBy($sOrderBy);
				$grant_package->name->setSort("");
				$grant_package->code->setSort("");
				$grant_package->annual_amount->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$grant_package->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $grant_package;

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

		// "detail_view_sponsored_student_grant_package"
		$this->ListOptions->Add("detail_view_sponsored_student_grant_package");
		$item =& $this->ListOptions->Items["detail_view_sponsored_student_grant_package"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('view_sponsored_student_grant_package');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($grant_package->Export <> "" ||
			$grant_package->CurrentAction == "gridadd" ||
			$grant_package->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $grant_package;
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

		// "detail_view_sponsored_student_grant_package"
		$oListOpt =& $this->ListOptions->Items["detail_view_sponsored_student_grant_package"];
		if ($Security->AllowList('view_sponsored_student_grant_package')) {
			$oListOpt->Body = "<img src=\"images/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("view_sponsored_student_grant_package", "TblCaption");
			$oListOpt->Body = "<a href=\"view_sponsored_student_grant_packagelist.php?" . EW_TABLE_SHOW_MASTER . "=grant_package&grant_package_id=" . urlencode(strval($grant_package->grant_package_id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $grant_package;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $grant_package;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$grant_package->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$grant_package->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $grant_package->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$grant_package->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$grant_package->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$grant_package->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $grant_package;

		// Load search values
		// name

		$grant_package->name->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_name"]);
		$grant_package->name->AdvancedSearch->SearchOperator = @$_GET["z_name"];

		// code
		$grant_package->code->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_code"]);
		$grant_package->code->AdvancedSearch->SearchOperator = @$_GET["z_code"];

		// annual_amount
		$grant_package->annual_amount->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_annual_amount"]);
		$grant_package->annual_amount->AdvancedSearch->SearchOperator = @$_GET["z_annual_amount"];
		$grant_package->annual_amount->AdvancedSearch->SearchCondition = @$_GET["v_annual_amount"];
		$grant_package->annual_amount->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_annual_amount"]);
		$grant_package->annual_amount->AdvancedSearch->SearchOperator2 = @$_GET["w_annual_amount"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $grant_package;

		// Call Recordset Selecting event
		$grant_package->Recordset_Selecting($grant_package->CurrentFilter);

		// Load List page SQL
		$sSql = $grant_package->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$grant_package->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $grant_package;
		$sFilter = $grant_package->KeyFilter();

		// Call Row Selecting event
		$grant_package->Row_Selecting($sFilter);

		// Load SQL based on filter
		$grant_package->CurrentFilter = $sFilter;
		$sSql = $grant_package->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$grant_package->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $grant_package;
		$grant_package->grant_package_id->setDbValue($rs->fields('grant_package_id'));
		$grant_package->name->setDbValue($rs->fields('name'));
		$grant_package->code->setDbValue($rs->fields('code'));
		$grant_package->annual_amount->setDbValue($rs->fields('annual_amount'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grant_package;

		// Initialize URLs
		$this->ViewUrl = $grant_package->ViewUrl();
		$this->EditUrl = $grant_package->EditUrl();
		$this->InlineEditUrl = $grant_package->InlineEditUrl();
		$this->CopyUrl = $grant_package->CopyUrl();
		$this->InlineCopyUrl = $grant_package->InlineCopyUrl();
		$this->DeleteUrl = $grant_package->DeleteUrl();

		// Call Row_Rendering event
		$grant_package->Row_Rendering();

		// Common render codes for all row types
		// name

		$grant_package->name->CellCssStyle = ""; $grant_package->name->CellCssClass = "";
		$grant_package->name->CellAttrs = array(); $grant_package->name->ViewAttrs = array(); $grant_package->name->EditAttrs = array();

		// code
		$grant_package->code->CellCssStyle = ""; $grant_package->code->CellCssClass = "";
		$grant_package->code->CellAttrs = array(); $grant_package->code->ViewAttrs = array(); $grant_package->code->EditAttrs = array();

		// annual_amount
		$grant_package->annual_amount->CellCssStyle = ""; $grant_package->annual_amount->CellCssClass = "";
		$grant_package->annual_amount->CellAttrs = array(); $grant_package->annual_amount->ViewAttrs = array(); $grant_package->annual_amount->EditAttrs = array();
		if ($grant_package->RowType == EW_ROWTYPE_VIEW) { // View row

			// grant_package_id
			$grant_package->grant_package_id->ViewValue = $grant_package->grant_package_id->CurrentValue;
			$grant_package->grant_package_id->CssStyle = "";
			$grant_package->grant_package_id->CssClass = "";
			$grant_package->grant_package_id->ViewCustomAttributes = "";

			// name
			$grant_package->name->ViewValue = $grant_package->name->CurrentValue;
			$grant_package->name->CssStyle = "";
			$grant_package->name->CssClass = "";
			$grant_package->name->ViewCustomAttributes = "";

			// code
			$grant_package->code->ViewValue = $grant_package->code->CurrentValue;
			$grant_package->code->CssStyle = "";
			$grant_package->code->CssClass = "";
			$grant_package->code->ViewCustomAttributes = "";

			// annual_amount
			$grant_package->annual_amount->ViewValue = $grant_package->annual_amount->CurrentValue;
			$grant_package->annual_amount->CssStyle = "";
			$grant_package->annual_amount->CssClass = "";
			$grant_package->annual_amount->ViewCustomAttributes = "";

			// name
			$grant_package->name->HrefValue = "";
			$grant_package->name->TooltipValue = "";

			// code
			$grant_package->code->HrefValue = "";
			$grant_package->code->TooltipValue = "";

			// annual_amount
			$grant_package->annual_amount->HrefValue = "";
			$grant_package->annual_amount->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($grant_package->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grant_package->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $grant_package;

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
		global $grant_package;
		$grant_package->name->AdvancedSearch->SearchValue = $grant_package->getAdvancedSearch("x_name");
		$grant_package->code->AdvancedSearch->SearchValue = $grant_package->getAdvancedSearch("x_code");
		$grant_package->annual_amount->AdvancedSearch->SearchValue = $grant_package->getAdvancedSearch("x_annual_amount");
		$grant_package->annual_amount->AdvancedSearch->SearchOperator = $grant_package->getAdvancedSearch("z_annual_amount");
		$grant_package->annual_amount->AdvancedSearch->SearchValue2 = $grant_package->getAdvancedSearch("y_annual_amount");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $grant_package;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $grant_package->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($grant_package->ExportAll) {
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
		if ($grant_package->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($grant_package, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($grant_package->grant_package_id);
				$ExportDoc->ExportCaption($grant_package->name);
				$ExportDoc->ExportCaption($grant_package->code);
				$ExportDoc->ExportCaption($grant_package->annual_amount);
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
				$grant_package->CssClass = "";
				$grant_package->CssStyle = "";
				$grant_package->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($grant_package->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('grant_package_id', $grant_package->grant_package_id->ExportValue($grant_package->Export, $grant_package->ExportOriginalValue));
					$XmlDoc->AddField('name', $grant_package->name->ExportValue($grant_package->Export, $grant_package->ExportOriginalValue));
					$XmlDoc->AddField('code', $grant_package->code->ExportValue($grant_package->Export, $grant_package->ExportOriginalValue));
					$XmlDoc->AddField('annual_amount', $grant_package->annual_amount->ExportValue($grant_package->Export, $grant_package->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($grant_package->grant_package_id);
					$ExportDoc->ExportField($grant_package->name);
					$ExportDoc->ExportField($grant_package->code);
					$ExportDoc->ExportField($grant_package->annual_amount);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($grant_package->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($grant_package->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($grant_package->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($grant_package->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($grant_package->ExportReturnUrl());
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
