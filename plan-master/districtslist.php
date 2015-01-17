<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "districtsinfo.php" ?>
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
$districts_list = new cdistricts_list();
$Page =& $districts_list;

// Page init
$districts_list->Page_Init();

// Page main
$districts_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($districts->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var districts_list = new ew_Page("districts_list");

// page properties
districts_list.PageID = "list"; // page ID
districts_list.FormID = "fdistrictslist"; // form ID
var EW_PAGE_ID = districts_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
districts_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
districts_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
districts_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($districts->Export == "") { ?>
<?php
$gsMasterReturnUrl = "programarealist.php";
if ($districts_list->sDbMasterFilter <> "" && $districts->getCurrentMasterTable() == "programarea") {
	if ($districts_list->bMasterRecordExists) {
		if ($districts->getCurrentMasterTable() == $districts->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "programareamaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$districts_list->lTotalRecs = $districts->SelectRecordCount();
	} else {
		if ($rs = $districts_list->LoadRecordset())
			$districts_list->lTotalRecs = $rs->RecordCount();
	}
	$districts_list->lStartRec = 1;
	if ($districts_list->lDisplayRecs <= 0 || ($districts->Export <> "" && $districts->ExportAll)) // Display all records
		$districts_list->lDisplayRecs = $districts_list->lTotalRecs;
	if (!($districts->Export <> "" && $districts->ExportAll))
		$districts_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $districts_list->LoadRecordset($districts_list->lStartRec-1, $districts_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $districts->TableCaption() ?>
<?php if ($districts->Export == "" && $districts->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $districts_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $districts_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $districts_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($districts->Export == "" && $districts->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(districts_list);" style="text-decoration: none;"><img id="districts_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="districts_list_SearchPanel">
<form name="fdistrictslistsrch" id="fdistrictslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="districts">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $districts_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="districtssrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
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
$districts_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fdistrictslist" id="fdistrictslist" class="ewForm" action="" method="post">
<div id="gmp_districts" class="ewGridMiddlePanel">
<?php if ($districts_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $districts->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$districts_list->RenderListOptions();

// Render list options (header, left)
$districts_list->ListOptions->Render("header", "left");
?>
<?php if ($districts->DistrictID->Visible) { // DistrictID ?>
	<?php if ($districts->SortUrl($districts->DistrictID) == "") { ?>
		<td><?php echo $districts->DistrictID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $districts->SortUrl($districts->DistrictID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $districts->DistrictID->FldCaption() ?></td><td style="width: 10px;"><?php if ($districts->DistrictID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($districts->DistrictID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($districts->District->Visible) { // District ?>
	<?php if ($districts->SortUrl($districts->District) == "") { ?>
		<td><?php echo $districts->District->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $districts->SortUrl($districts->District) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $districts->District->FldCaption() ?></td><td style="width: 10px;"><?php if ($districts->District->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($districts->District->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($districts->RegionID->Visible) { // RegionID ?>
	<?php if ($districts->SortUrl($districts->RegionID) == "") { ?>
		<td><?php echo $districts->RegionID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $districts->SortUrl($districts->RegionID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $districts->RegionID->FldCaption() ?></td><td style="width: 10px;"><?php if ($districts->RegionID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($districts->RegionID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($districts->programarea_programarea_id->Visible) { // programarea_programarea_id ?>
	<?php if ($districts->SortUrl($districts->programarea_programarea_id) == "") { ?>
		<td><?php echo $districts->programarea_programarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $districts->SortUrl($districts->programarea_programarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $districts->programarea_programarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($districts->programarea_programarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($districts->programarea_programarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$districts_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($districts->ExportAll && $districts->Export <> "") {
	$districts_list->lStopRec = $districts_list->lTotalRecs;
} else {
	$districts_list->lStopRec = $districts_list->lStartRec + $districts_list->lDisplayRecs - 1; // Set the last record to display
}
$districts_list->lRecCount = $districts_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $districts_list->lStartRec > 1)
		$rs->Move($districts_list->lStartRec - 1);
}

// Initialize aggregate
$districts->RowType = EW_ROWTYPE_AGGREGATEINIT;
$districts_list->RenderRow();
$districts_list->lRowCnt = 0;
while (($districts->CurrentAction == "gridadd" || !$rs->EOF) &&
	$districts_list->lRecCount < $districts_list->lStopRec) {
	$districts_list->lRecCount++;
	if (intval($districts_list->lRecCount) >= intval($districts_list->lStartRec)) {
		$districts_list->lRowCnt++;

	// Init row class and style
	$districts->CssClass = "";
	$districts->CssStyle = "";
	$districts->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($districts->CurrentAction == "gridadd") {
		$districts_list->LoadDefaultValues(); // Load default values
	} else {
		$districts_list->LoadRowValues($rs); // Load row values
	}
	$districts->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$districts_list->RenderRow();

	// Render list options
	$districts_list->RenderListOptions();
?>
	<tr<?php echo $districts->RowAttributes() ?>>
<?php

// Render list options (body, left)
$districts_list->ListOptions->Render("body", "left");
?>
	<?php if ($districts->DistrictID->Visible) { // DistrictID ?>
		<td<?php echo $districts->DistrictID->CellAttributes() ?>>
<div<?php echo $districts->DistrictID->ViewAttributes() ?>><?php echo $districts->DistrictID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($districts->District->Visible) { // District ?>
		<td<?php echo $districts->District->CellAttributes() ?>>
<div<?php echo $districts->District->ViewAttributes() ?>><?php echo $districts->District->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($districts->RegionID->Visible) { // RegionID ?>
		<td<?php echo $districts->RegionID->CellAttributes() ?>>
<div<?php echo $districts->RegionID->ViewAttributes() ?>><?php echo $districts->RegionID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($districts->programarea_programarea_id->Visible) { // programarea_programarea_id ?>
		<td<?php echo $districts->programarea_programarea_id->CellAttributes() ?>>
<div<?php echo $districts->programarea_programarea_id->ViewAttributes() ?>><?php echo $districts->programarea_programarea_id->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$districts_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($districts->CurrentAction <> "gridadd")
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
<?php if ($districts->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($districts->CurrentAction <> "gridadd" && $districts->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($districts_list->Pager)) $districts_list->Pager = new cPrevNextPager($districts_list->lStartRec, $districts_list->lDisplayRecs, $districts_list->lTotalRecs) ?>
<?php if ($districts_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($districts_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $districts_list->PageUrl() ?>start=<?php echo $districts_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($districts_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $districts_list->PageUrl() ?>start=<?php echo $districts_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $districts_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($districts_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $districts_list->PageUrl() ?>start=<?php echo $districts_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($districts_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $districts_list->PageUrl() ?>start=<?php echo $districts_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $districts_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $districts_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $districts_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $districts_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($districts_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($districts_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $districts_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($districts->Export == "" && $districts->CurrentAction == "") { ?>
<?php } ?>
<?php if ($districts->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$districts_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cdistricts_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'districts';

	// Page object name
	var $PageObjName = 'districts_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $districts;
		if ($districts->UseTokenInUrl) $PageUrl .= "t=" . $districts->TableVar . "&"; // Add page token
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
		global $objForm, $districts;
		if ($districts->UseTokenInUrl) {
			if ($objForm)
				return ($districts->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($districts->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdistricts_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (districts)
		$GLOBALS["districts"] = new cdistricts();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["districts"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "districtsdelete.php";
		$this->MultiUpdateUrl = "districtsupdate.php";

		// Table object (programarea)
		$GLOBALS['programarea'] = new cprogramarea();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'districts', TRUE);

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
		global $districts;

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
			$districts->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$districts->Export = $_POST["exporttype"];
		} else {
			$districts->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $districts->Export; // Get export parameter, used in header
		$gsExportFile = $districts->TableVar; // Get export file, used in header
		if ($districts->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($districts->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $districts;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterDetail();

			// Set up list options
			$this->SetupListOptions();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$districts->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($districts->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $districts->getRecordsPerPage(); // Restore from Session
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
		$districts->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$districts->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$districts->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $districts->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $districts->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $districts->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($districts->getMasterFilter() <> "" && $districts->getCurrentMasterTable() == "programarea") {
			global $programarea;
			$rsmaster = $programarea->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$districts->setMasterFilter(""); // Clear master filter
				$districts->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($districts->getReturnUrl()); // Return to caller
			} else {
				$programarea->LoadListRowValues($rsmaster);
				$programarea->RowType = EW_ROWTYPE_MASTER; // Master row
				$programarea->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$districts->setSessionWhere($sFilter);
		$districts->CurrentFilter = "";

		// Export data only
		if (in_array($districts->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($districts->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $districts;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $districts->DistrictID, FALSE); // DistrictID
		$this->BuildSearchSql($sWhere, $districts->District, FALSE); // District
		$this->BuildSearchSql($sWhere, $districts->RegionID, FALSE); // RegionID
		$this->BuildSearchSql($sWhere, $districts->programarea_programarea_id, FALSE); // programarea_programarea_id

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($districts->DistrictID); // DistrictID
			$this->SetSearchParm($districts->District); // District
			$this->SetSearchParm($districts->RegionID); // RegionID
			$this->SetSearchParm($districts->programarea_programarea_id); // programarea_programarea_id
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
		global $districts;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$districts->setAdvancedSearch("x_$FldParm", $FldVal);
		$districts->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$districts->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$districts->setAdvancedSearch("y_$FldParm", $FldVal2);
		$districts->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $districts;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $districts->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $districts->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $districts->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $districts->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $districts->GetAdvancedSearch("w_$FldParm");
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
		global $districts;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$districts->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $districts;
		$districts->setAdvancedSearch("x_DistrictID", "");
		$districts->setAdvancedSearch("x_District", "");
		$districts->setAdvancedSearch("x_RegionID", "");
		$districts->setAdvancedSearch("x_programarea_programarea_id", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $districts;
		$bRestore = TRUE;
		if (@$_GET["x_DistrictID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_District"] <> "") $bRestore = FALSE;
		if (@$_GET["x_RegionID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_programarea_programarea_id"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($districts->DistrictID);
			$this->GetSearchParm($districts->District);
			$this->GetSearchParm($districts->RegionID);
			$this->GetSearchParm($districts->programarea_programarea_id);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $districts;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$districts->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$districts->CurrentOrderType = @$_GET["ordertype"];
			$districts->UpdateSort($districts->DistrictID); // DistrictID
			$districts->UpdateSort($districts->District); // District
			$districts->UpdateSort($districts->RegionID); // RegionID
			$districts->UpdateSort($districts->programarea_programarea_id); // programarea_programarea_id
			$districts->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $districts;
		$sOrderBy = $districts->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($districts->SqlOrderBy() <> "") {
				$sOrderBy = $districts->SqlOrderBy();
				$districts->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $districts;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$districts->getCurrentMasterTable = ""; // Clear master table
				$districts->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$districts->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$districts->programarea_programarea_id->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$districts->setSessionOrderBy($sOrderBy);
				$districts->DistrictID->setSort("");
				$districts->District->setSort("");
				$districts->RegionID->setSort("");
				$districts->programarea_programarea_id->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$districts->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $districts;

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

		// "detail_community"
		$this->ListOptions->Add("detail_community");
		$item =& $this->ListOptions->Items["detail_community"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('community');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($districts->Export <> "" ||
			$districts->CurrentAction == "gridadd" ||
			$districts->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $districts;
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

		// "detail_community"
		$oListOpt =& $this->ListOptions->Items["detail_community"];
		if ($Security->AllowList('community')) {
			$oListOpt->Body = "<img src=\"images/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("community", "TblCaption");
			$oListOpt->Body = "<a href=\"communitylist.php?" . EW_TABLE_SHOW_MASTER . "=districts&DistrictID=" . urlencode(strval($districts->DistrictID->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $districts;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $districts;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$districts->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$districts->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $districts->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$districts->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$districts->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$districts->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $districts;

		// Load search values
		// DistrictID

		$districts->DistrictID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_DistrictID"]);
		$districts->DistrictID->AdvancedSearch->SearchOperator = @$_GET["z_DistrictID"];

		// District
		$districts->District->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_District"]);
		$districts->District->AdvancedSearch->SearchOperator = @$_GET["z_District"];

		// RegionID
		$districts->RegionID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_RegionID"]);
		$districts->RegionID->AdvancedSearch->SearchOperator = @$_GET["z_RegionID"];

		// programarea_programarea_id
		$districts->programarea_programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programarea_programarea_id"]);
		$districts->programarea_programarea_id->AdvancedSearch->SearchOperator = @$_GET["z_programarea_programarea_id"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $districts;

		// Call Recordset Selecting event
		$districts->Recordset_Selecting($districts->CurrentFilter);

		// Load List page SQL
		$sSql = $districts->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$districts->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $districts;
		$sFilter = $districts->KeyFilter();

		// Call Row Selecting event
		$districts->Row_Selecting($sFilter);

		// Load SQL based on filter
		$districts->CurrentFilter = $sFilter;
		$sSql = $districts->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$districts->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $districts;
		$districts->DistrictID->setDbValue($rs->fields('DistrictID'));
		$districts->District->setDbValue($rs->fields('District'));
		$districts->RegionID->setDbValue($rs->fields('RegionID'));
		$districts->programarea_programarea_id->setDbValue($rs->fields('programarea_programarea_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $districts;

		// Initialize URLs
		$this->ViewUrl = $districts->ViewUrl();
		$this->EditUrl = $districts->EditUrl();
		$this->InlineEditUrl = $districts->InlineEditUrl();
		$this->CopyUrl = $districts->CopyUrl();
		$this->InlineCopyUrl = $districts->InlineCopyUrl();
		$this->DeleteUrl = $districts->DeleteUrl();

		// Call Row_Rendering event
		$districts->Row_Rendering();

		// Common render codes for all row types
		// DistrictID

		$districts->DistrictID->CellCssStyle = ""; $districts->DistrictID->CellCssClass = "";
		$districts->DistrictID->CellAttrs = array(); $districts->DistrictID->ViewAttrs = array(); $districts->DistrictID->EditAttrs = array();

		// District
		$districts->District->CellCssStyle = ""; $districts->District->CellCssClass = "";
		$districts->District->CellAttrs = array(); $districts->District->ViewAttrs = array(); $districts->District->EditAttrs = array();

		// RegionID
		$districts->RegionID->CellCssStyle = ""; $districts->RegionID->CellCssClass = "";
		$districts->RegionID->CellAttrs = array(); $districts->RegionID->ViewAttrs = array(); $districts->RegionID->EditAttrs = array();

		// programarea_programarea_id
		$districts->programarea_programarea_id->CellCssStyle = ""; $districts->programarea_programarea_id->CellCssClass = "";
		$districts->programarea_programarea_id->CellAttrs = array(); $districts->programarea_programarea_id->ViewAttrs = array(); $districts->programarea_programarea_id->EditAttrs = array();
		if ($districts->RowType == EW_ROWTYPE_VIEW) { // View row

			// DistrictID
			$districts->DistrictID->ViewValue = $districts->DistrictID->CurrentValue;
			$districts->DistrictID->CssStyle = "";
			$districts->DistrictID->CssClass = "";
			$districts->DistrictID->ViewCustomAttributes = "";

			// District
			$districts->District->ViewValue = $districts->District->CurrentValue;
			$districts->District->CssStyle = "";
			$districts->District->CssClass = "";
			$districts->District->ViewCustomAttributes = "";

			// RegionID
			if (strval($districts->RegionID->CurrentValue) <> "") {
				$sFilterWrk = "`RegionID` = " . ew_AdjustSql($districts->RegionID->CurrentValue) . "";
			$sSqlWrk = "SELECT DISTINCT `Region` FROM `regions`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$districts->RegionID->ViewValue = $rswrk->fields('Region');
					$rswrk->Close();
				} else {
					$districts->RegionID->ViewValue = $districts->RegionID->CurrentValue;
				}
			} else {
				$districts->RegionID->ViewValue = NULL;
			}
			$districts->RegionID->CssStyle = "";
			$districts->RegionID->CssClass = "";
			$districts->RegionID->ViewCustomAttributes = "";

			// programarea_programarea_id
			if (strval($districts->programarea_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($districts->programarea_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT DISTINCT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$districts->programarea_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$districts->programarea_programarea_id->ViewValue = $districts->programarea_programarea_id->CurrentValue;
				}
			} else {
				$districts->programarea_programarea_id->ViewValue = NULL;
			}
			$districts->programarea_programarea_id->CssStyle = "";
			$districts->programarea_programarea_id->CssClass = "";
			$districts->programarea_programarea_id->ViewCustomAttributes = "";

			// DistrictID
			$districts->DistrictID->HrefValue = "";
			$districts->DistrictID->TooltipValue = "";

			// District
			$districts->District->HrefValue = "";
			$districts->District->TooltipValue = "";

			// RegionID
			$districts->RegionID->HrefValue = "";
			$districts->RegionID->TooltipValue = "";

			// programarea_programarea_id
			$districts->programarea_programarea_id->HrefValue = "";
			$districts->programarea_programarea_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($districts->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$districts->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $districts;

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
		global $districts;
		$districts->DistrictID->AdvancedSearch->SearchValue = $districts->getAdvancedSearch("x_DistrictID");
		$districts->District->AdvancedSearch->SearchValue = $districts->getAdvancedSearch("x_District");
		$districts->RegionID->AdvancedSearch->SearchValue = $districts->getAdvancedSearch("x_RegionID");
		$districts->programarea_programarea_id->AdvancedSearch->SearchValue = $districts->getAdvancedSearch("x_programarea_programarea_id");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $districts;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $districts->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($districts->ExportAll) {
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
		if ($districts->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($districts, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($districts->DistrictID);
				$ExportDoc->ExportCaption($districts->District);
				$ExportDoc->ExportCaption($districts->RegionID);
				$ExportDoc->ExportCaption($districts->programarea_programarea_id);
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
				$districts->CssClass = "";
				$districts->CssStyle = "";
				$districts->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($districts->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('DistrictID', $districts->DistrictID->ExportValue($districts->Export, $districts->ExportOriginalValue));
					$XmlDoc->AddField('District', $districts->District->ExportValue($districts->Export, $districts->ExportOriginalValue));
					$XmlDoc->AddField('RegionID', $districts->RegionID->ExportValue($districts->Export, $districts->ExportOriginalValue));
					$XmlDoc->AddField('programarea_programarea_id', $districts->programarea_programarea_id->ExportValue($districts->Export, $districts->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($districts->DistrictID);
					$ExportDoc->ExportField($districts->District);
					$ExportDoc->ExportField($districts->RegionID);
					$ExportDoc->ExportField($districts->programarea_programarea_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($districts->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($districts->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($districts->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($districts->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($districts->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $districts;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "programarea") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $districts->SqlMasterFilter_programarea();
				$this->sDbDetailFilter = $districts->SqlDetailFilter_programarea();
				if (@$_GET["programarea_id"] <> "") {
					$GLOBALS["programarea"]->programarea_id->setQueryStringValue($_GET["programarea_id"]);
					$districts->programarea_programarea_id->setQueryStringValue($GLOBALS["programarea"]->programarea_id->QueryStringValue);
					$districts->programarea_programarea_id->setSessionValue($districts->programarea_programarea_id->QueryStringValue);
					if (!is_numeric($GLOBALS["programarea"]->programarea_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@programarea_id@", ew_AdjustSql($GLOBALS["programarea"]->programarea_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@programarea_programarea_id@", ew_AdjustSql($GLOBALS["programarea"]->programarea_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$districts->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$districts->setStartRecordNumber($this->lStartRec);
			$districts->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$districts->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "programarea") {
				if ($districts->programarea_programarea_id->QueryStringValue == "") $districts->programarea_programarea_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $districts->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $districts->getDetailFilter(); // Restore detail filter
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
