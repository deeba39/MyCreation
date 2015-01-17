<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "application_statusinfo.php" ?>
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
$application_status_list = new capplication_status_list();
$Page =& $application_status_list;

// Page init
$application_status_list->Page_Init();

// Page main
$application_status_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($application_status->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var application_status_list = new ew_Page("application_status_list");

// page properties
application_status_list.PageID = "list"; // page ID
application_status_list.FormID = "fapplication_statuslist"; // form ID
var EW_PAGE_ID = application_status_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
application_status_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
application_status_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
application_status_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($application_status->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$application_status_list->lTotalRecs = $application_status->SelectRecordCount();
	} else {
		if ($rs = $application_status_list->LoadRecordset())
			$application_status_list->lTotalRecs = $rs->RecordCount();
	}
	$application_status_list->lStartRec = 1;
	if ($application_status_list->lDisplayRecs <= 0 || ($application_status->Export <> "" && $application_status->ExportAll)) // Display all records
		$application_status_list->lDisplayRecs = $application_status_list->lTotalRecs;
	if (!($application_status->Export <> "" && $application_status->ExportAll))
		$application_status_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $application_status_list->LoadRecordset($application_status_list->lStartRec-1, $application_status_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $application_status->TableCaption() ?>
<?php if ($application_status->Export == "" && $application_status->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $application_status_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $application_status_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $application_status_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$application_status_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fapplication_statuslist" id="fapplication_statuslist" class="ewForm" action="" method="post">
<div id="gmp_application_status" class="ewGridMiddlePanel">
<?php if ($application_status_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $application_status->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$application_status_list->RenderListOptions();

// Render list options (header, left)
$application_status_list->ListOptions->Render("header", "left");
?>
<?php if ($application_status->application_status_id->Visible) { // application_status_id ?>
	<?php if ($application_status->SortUrl($application_status->application_status_id) == "") { ?>
		<td><?php echo $application_status->application_status_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $application_status->SortUrl($application_status->application_status_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $application_status->application_status_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($application_status->application_status_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($application_status->application_status_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($application_status->application_status_1->Visible) { // application_status ?>
	<?php if ($application_status->SortUrl($application_status->application_status_1) == "") { ?>
		<td><?php echo $application_status->application_status_1->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $application_status->SortUrl($application_status->application_status_1) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $application_status->application_status_1->FldCaption() ?></td><td style="width: 10px;"><?php if ($application_status->application_status_1->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($application_status->application_status_1->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$application_status_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($application_status->ExportAll && $application_status->Export <> "") {
	$application_status_list->lStopRec = $application_status_list->lTotalRecs;
} else {
	$application_status_list->lStopRec = $application_status_list->lStartRec + $application_status_list->lDisplayRecs - 1; // Set the last record to display
}
$application_status_list->lRecCount = $application_status_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $application_status_list->lStartRec > 1)
		$rs->Move($application_status_list->lStartRec - 1);
}

// Initialize aggregate
$application_status->RowType = EW_ROWTYPE_AGGREGATEINIT;
$application_status_list->RenderRow();
$application_status_list->lRowCnt = 0;
while (($application_status->CurrentAction == "gridadd" || !$rs->EOF) &&
	$application_status_list->lRecCount < $application_status_list->lStopRec) {
	$application_status_list->lRecCount++;
	if (intval($application_status_list->lRecCount) >= intval($application_status_list->lStartRec)) {
		$application_status_list->lRowCnt++;

	// Init row class and style
	$application_status->CssClass = "";
	$application_status->CssStyle = "";
	$application_status->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($application_status->CurrentAction == "gridadd") {
		$application_status_list->LoadDefaultValues(); // Load default values
	} else {
		$application_status_list->LoadRowValues($rs); // Load row values
	}
	$application_status->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$application_status_list->RenderRow();

	// Render list options
	$application_status_list->RenderListOptions();
?>
	<tr<?php echo $application_status->RowAttributes() ?>>
<?php

// Render list options (body, left)
$application_status_list->ListOptions->Render("body", "left");
?>
	<?php if ($application_status->application_status_id->Visible) { // application_status_id ?>
		<td<?php echo $application_status->application_status_id->CellAttributes() ?>>
<div<?php echo $application_status->application_status_id->ViewAttributes() ?>><?php echo $application_status->application_status_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($application_status->application_status_1->Visible) { // application_status ?>
		<td<?php echo $application_status->application_status_1->CellAttributes() ?>>
<div<?php echo $application_status->application_status_1->ViewAttributes() ?>><?php echo $application_status->application_status_1->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$application_status_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($application_status->CurrentAction <> "gridadd")
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
<?php if ($application_status->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($application_status->CurrentAction <> "gridadd" && $application_status->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($application_status_list->Pager)) $application_status_list->Pager = new cPrevNextPager($application_status_list->lStartRec, $application_status_list->lDisplayRecs, $application_status_list->lTotalRecs) ?>
<?php if ($application_status_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($application_status_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $application_status_list->PageUrl() ?>start=<?php echo $application_status_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($application_status_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $application_status_list->PageUrl() ?>start=<?php echo $application_status_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $application_status_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($application_status_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $application_status_list->PageUrl() ?>start=<?php echo $application_status_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($application_status_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $application_status_list->PageUrl() ?>start=<?php echo $application_status_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $application_status_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $application_status_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $application_status_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $application_status_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($application_status_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($application_status_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $application_status_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($application_status->Export == "" && $application_status->CurrentAction == "") { ?>
<?php } ?>
<?php if ($application_status->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$application_status_list->Page_Terminate();
?>
<?php

//
// Page class
//
class capplication_status_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'application_status';

	// Page object name
	var $PageObjName = 'application_status_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $application_status;
		if ($application_status->UseTokenInUrl) $PageUrl .= "t=" . $application_status->TableVar . "&"; // Add page token
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
		global $objForm, $application_status;
		if ($application_status->UseTokenInUrl) {
			if ($objForm)
				return ($application_status->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($application_status->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function capplication_status_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (application_status)
		$GLOBALS["application_status"] = new capplication_status();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["application_status"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "application_statusdelete.php";
		$this->MultiUpdateUrl = "application_statusupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'application_status', TRUE);

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
		global $application_status;

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
			$application_status->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$application_status->Export = $_POST["exporttype"];
		} else {
			$application_status->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $application_status->Export; // Get export parameter, used in header
		$gsExportFile = $application_status->TableVar; // Get export file, used in header
		if ($application_status->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($application_status->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $application_status;

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
		if ($application_status->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $application_status->getRecordsPerPage(); // Restore from Session
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
		$application_status->setSessionWhere($sFilter);
		$application_status->CurrentFilter = "";

		// Export data only
		if (in_array($application_status->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($application_status->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $application_status;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$application_status->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$application_status->CurrentOrderType = @$_GET["ordertype"];
			$application_status->UpdateSort($application_status->application_status_id); // application_status_id
			$application_status->UpdateSort($application_status->application_status_1); // application_status
			$application_status->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $application_status;
		$sOrderBy = $application_status->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($application_status->SqlOrderBy() <> "") {
				$sOrderBy = $application_status->SqlOrderBy();
				$application_status->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $application_status;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$application_status->setSessionOrderBy($sOrderBy);
				$application_status->application_status_id->setSort("");
				$application_status->application_status_1->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$application_status->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $application_status;

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
		if ($application_status->Export <> "" ||
			$application_status->CurrentAction == "gridadd" ||
			$application_status->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $application_status;
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
		global $Security, $Language, $application_status;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $application_status;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$application_status->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$application_status->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $application_status->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$application_status->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$application_status->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$application_status->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $application_status;

		// Call Recordset Selecting event
		$application_status->Recordset_Selecting($application_status->CurrentFilter);

		// Load List page SQL
		$sSql = $application_status->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$application_status->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $application_status;
		$sFilter = $application_status->KeyFilter();

		// Call Row Selecting event
		$application_status->Row_Selecting($sFilter);

		// Load SQL based on filter
		$application_status->CurrentFilter = $sFilter;
		$sSql = $application_status->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$application_status->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $application_status;
		$application_status->application_status_id->setDbValue($rs->fields('application_status_id'));
		$application_status->application_status_1->setDbValue($rs->fields('application_status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $application_status;

		// Initialize URLs
		$this->ViewUrl = $application_status->ViewUrl();
		$this->EditUrl = $application_status->EditUrl();
		$this->InlineEditUrl = $application_status->InlineEditUrl();
		$this->CopyUrl = $application_status->CopyUrl();
		$this->InlineCopyUrl = $application_status->InlineCopyUrl();
		$this->DeleteUrl = $application_status->DeleteUrl();

		// Call Row_Rendering event
		$application_status->Row_Rendering();

		// Common render codes for all row types
		// application_status_id

		$application_status->application_status_id->CellCssStyle = ""; $application_status->application_status_id->CellCssClass = "";
		$application_status->application_status_id->CellAttrs = array(); $application_status->application_status_id->ViewAttrs = array(); $application_status->application_status_id->EditAttrs = array();

		// application_status
		$application_status->application_status_1->CellCssStyle = ""; $application_status->application_status_1->CellCssClass = "";
		$application_status->application_status_1->CellAttrs = array(); $application_status->application_status_1->ViewAttrs = array(); $application_status->application_status_1->EditAttrs = array();
		if ($application_status->RowType == EW_ROWTYPE_VIEW) { // View row

			// application_status_id
			$application_status->application_status_id->ViewValue = $application_status->application_status_id->CurrentValue;
			$application_status->application_status_id->CssStyle = "";
			$application_status->application_status_id->CssClass = "";
			$application_status->application_status_id->ViewCustomAttributes = "";

			// application_status
			$application_status->application_status_1->ViewValue = $application_status->application_status_1->CurrentValue;
			$application_status->application_status_1->CssStyle = "";
			$application_status->application_status_1->CssClass = "";
			$application_status->application_status_1->ViewCustomAttributes = "";

			// application_status_id
			$application_status->application_status_id->HrefValue = "";
			$application_status->application_status_id->TooltipValue = "";

			// application_status
			$application_status->application_status_1->HrefValue = "";
			$application_status->application_status_1->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($application_status->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$application_status->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $application_status;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $application_status->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($application_status->ExportAll) {
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
		if ($application_status->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($application_status, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($application_status->application_status_id);
				$ExportDoc->ExportCaption($application_status->application_status_1);
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
				$application_status->CssClass = "";
				$application_status->CssStyle = "";
				$application_status->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($application_status->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('application_status_id', $application_status->application_status_id->ExportValue($application_status->Export, $application_status->ExportOriginalValue));
					$XmlDoc->AddField('application_status_1', $application_status->application_status_1->ExportValue($application_status->Export, $application_status->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($application_status->application_status_id);
					$ExportDoc->ExportField($application_status->application_status_1);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($application_status->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($application_status->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($application_status->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($application_status->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($application_status->ExportReturnUrl());
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
