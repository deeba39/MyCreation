<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "communityinfo.php" ?>
<?php include "districtsinfo.php" ?>
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
$community_list = new ccommunity_list();
$Page =& $community_list;

// Page init
$community_list->Page_Init();

// Page main
$community_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($community->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var community_list = new ew_Page("community_list");

// page properties
community_list.PageID = "list"; // page ID
community_list.FormID = "fcommunitylist"; // form ID
var EW_PAGE_ID = community_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
community_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
community_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
community_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($community->Export == "") { ?>
<?php
$gsMasterReturnUrl = "districtslist.php";
if ($community_list->sDbMasterFilter <> "" && $community->getCurrentMasterTable() == "districts") {
	if ($community_list->bMasterRecordExists) {
		if ($community->getCurrentMasterTable() == $community->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "districtsmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$community_list->lTotalRecs = $community->SelectRecordCount();
	} else {
		if ($rs = $community_list->LoadRecordset())
			$community_list->lTotalRecs = $rs->RecordCount();
	}
	$community_list->lStartRec = 1;
	if ($community_list->lDisplayRecs <= 0 || ($community->Export <> "" && $community->ExportAll)) // Display all records
		$community_list->lDisplayRecs = $community_list->lTotalRecs;
	if (!($community->Export <> "" && $community->ExportAll))
		$community_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $community_list->LoadRecordset($community_list->lStartRec-1, $community_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $community->TableCaption() ?>
<?php if ($community->Export == "" && $community->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $community_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $community_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $community_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($community->Export == "" && $community->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(community_list);" style="text-decoration: none;"><img id="community_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="community_list_SearchPanel">
<form name="fcommunitylistsrch" id="fcommunitylistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="community">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $community_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="communitysrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
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
$community_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fcommunitylist" id="fcommunitylist" class="ewForm" action="" method="post">
<div id="gmp_community" class="ewGridMiddlePanel">
<?php if ($community_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $community->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$community_list->RenderListOptions();

// Render list options (header, left)
$community_list->ListOptions->Render("header", "left");
?>
<?php if ($community->community_1->Visible) { // community ?>
	<?php if ($community->SortUrl($community->community_1) == "") { ?>
		<td><?php echo $community->community_1->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $community->SortUrl($community->community_1) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $community->community_1->FldCaption() ?></td><td style="width: 10px;"><?php if ($community->community_1->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($community->community_1->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($community->programarea_programarea_id->Visible) { // programarea_programarea_id ?>
	<?php if ($community->SortUrl($community->programarea_programarea_id) == "") { ?>
		<td><?php echo $community->programarea_programarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $community->SortUrl($community->programarea_programarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $community->programarea_programarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($community->programarea_programarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($community->programarea_programarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($community->community_category_community_category_id->Visible) { // community_category_community_category_id ?>
	<?php if ($community->SortUrl($community->community_category_community_category_id) == "") { ?>
		<td><?php echo $community->community_category_community_category_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $community->SortUrl($community->community_category_community_category_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $community->community_category_community_category_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($community->community_category_community_category_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($community->community_category_community_category_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($community->community_districts_DistrictID->Visible) { // community_districts_DistrictID ?>
	<?php if ($community->SortUrl($community->community_districts_DistrictID) == "") { ?>
		<td><?php echo $community->community_districts_DistrictID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $community->SortUrl($community->community_districts_DistrictID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $community->community_districts_DistrictID->FldCaption() ?></td><td style="width: 10px;"><?php if ($community->community_districts_DistrictID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($community->community_districts_DistrictID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$community_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($community->ExportAll && $community->Export <> "") {
	$community_list->lStopRec = $community_list->lTotalRecs;
} else {
	$community_list->lStopRec = $community_list->lStartRec + $community_list->lDisplayRecs - 1; // Set the last record to display
}
$community_list->lRecCount = $community_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $community_list->lStartRec > 1)
		$rs->Move($community_list->lStartRec - 1);
}

// Initialize aggregate
$community->RowType = EW_ROWTYPE_AGGREGATEINIT;
$community_list->RenderRow();
$community_list->lRowCnt = 0;
while (($community->CurrentAction == "gridadd" || !$rs->EOF) &&
	$community_list->lRecCount < $community_list->lStopRec) {
	$community_list->lRecCount++;
	if (intval($community_list->lRecCount) >= intval($community_list->lStartRec)) {
		$community_list->lRowCnt++;

	// Init row class and style
	$community->CssClass = "";
	$community->CssStyle = "";
	$community->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($community->CurrentAction == "gridadd") {
		$community_list->LoadDefaultValues(); // Load default values
	} else {
		$community_list->LoadRowValues($rs); // Load row values
	}
	$community->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$community_list->RenderRow();

	// Render list options
	$community_list->RenderListOptions();
?>
	<tr<?php echo $community->RowAttributes() ?>>
<?php

// Render list options (body, left)
$community_list->ListOptions->Render("body", "left");
?>
	<?php if ($community->community_1->Visible) { // community ?>
		<td<?php echo $community->community_1->CellAttributes() ?>>
<div<?php echo $community->community_1->ViewAttributes() ?>><?php echo $community->community_1->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($community->programarea_programarea_id->Visible) { // programarea_programarea_id ?>
		<td<?php echo $community->programarea_programarea_id->CellAttributes() ?>>
<div<?php echo $community->programarea_programarea_id->ViewAttributes() ?>><?php echo $community->programarea_programarea_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($community->community_category_community_category_id->Visible) { // community_category_community_category_id ?>
		<td<?php echo $community->community_category_community_category_id->CellAttributes() ?>>
<div<?php echo $community->community_category_community_category_id->ViewAttributes() ?>><?php echo $community->community_category_community_category_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($community->community_districts_DistrictID->Visible) { // community_districts_DistrictID ?>
		<td<?php echo $community->community_districts_DistrictID->CellAttributes() ?>>
<div<?php echo $community->community_districts_DistrictID->ViewAttributes() ?>><?php echo $community->community_districts_DistrictID->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$community_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($community->CurrentAction <> "gridadd")
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
<?php if ($community->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($community->CurrentAction <> "gridadd" && $community->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($community_list->Pager)) $community_list->Pager = new cPrevNextPager($community_list->lStartRec, $community_list->lDisplayRecs, $community_list->lTotalRecs) ?>
<?php if ($community_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($community_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $community_list->PageUrl() ?>start=<?php echo $community_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($community_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $community_list->PageUrl() ?>start=<?php echo $community_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $community_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($community_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $community_list->PageUrl() ?>start=<?php echo $community_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($community_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $community_list->PageUrl() ?>start=<?php echo $community_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $community_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $community_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $community_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $community_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($community_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($community_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $community_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($community->Export == "" && $community->CurrentAction == "") { ?>
<?php } ?>
<?php if ($community->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$community_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ccommunity_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'community';

	// Page object name
	var $PageObjName = 'community_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $community;
		if ($community->UseTokenInUrl) $PageUrl .= "t=" . $community->TableVar . "&"; // Add page token
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
		global $objForm, $community;
		if ($community->UseTokenInUrl) {
			if ($objForm)
				return ($community->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($community->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccommunity_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (community)
		$GLOBALS["community"] = new ccommunity();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["community"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "communitydelete.php";
		$this->MultiUpdateUrl = "communityupdate.php";

		// Table object (districts)
		$GLOBALS['districts'] = new cdistricts();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'community', TRUE);

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
		global $community;

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
			$community->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$community->Export = $_POST["exporttype"];
		} else {
			$community->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $community->Export; // Get export parameter, used in header
		$gsExportFile = $community->TableVar; // Get export file, used in header
		if ($community->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($community->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $community;

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
			$community->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($community->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $community->getRecordsPerPage(); // Restore from Session
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
		$community->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$community->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$community->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $community->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $community->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $community->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($community->getMasterFilter() <> "" && $community->getCurrentMasterTable() == "districts") {
			global $districts;
			$rsmaster = $districts->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$community->setMasterFilter(""); // Clear master filter
				$community->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($community->getReturnUrl()); // Return to caller
			} else {
				$districts->LoadListRowValues($rsmaster);
				$districts->RowType = EW_ROWTYPE_MASTER; // Master row
				$districts->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$community->setSessionWhere($sFilter);
		$community->CurrentFilter = "";

		// Export data only
		if (in_array($community->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($community->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $community;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $community->community_1, FALSE); // community
		$this->BuildSearchSql($sWhere, $community->programarea_programarea_id, FALSE); // programarea_programarea_id
		$this->BuildSearchSql($sWhere, $community->community_category_community_category_id, FALSE); // community_category_community_category_id
		$this->BuildSearchSql($sWhere, $community->community_districts_DistrictID, FALSE); // community_districts_DistrictID

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($community->community_1); // community
			$this->SetSearchParm($community->programarea_programarea_id); // programarea_programarea_id
			$this->SetSearchParm($community->community_category_community_category_id); // community_category_community_category_id
			$this->SetSearchParm($community->community_districts_DistrictID); // community_districts_DistrictID
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
		global $community;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$community->setAdvancedSearch("x_$FldParm", $FldVal);
		$community->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$community->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$community->setAdvancedSearch("y_$FldParm", $FldVal2);
		$community->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $community;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $community->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $community->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $community->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $community->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $community->GetAdvancedSearch("w_$FldParm");
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
		global $community;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$community->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $community;
		$community->setAdvancedSearch("x_community_1", "");
		$community->setAdvancedSearch("x_programarea_programarea_id", "");
		$community->setAdvancedSearch("x_community_category_community_category_id", "");
		$community->setAdvancedSearch("x_community_districts_DistrictID", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $community;
		$bRestore = TRUE;
		if (@$_GET["x_community_1"] <> "") $bRestore = FALSE;
		if (@$_GET["x_programarea_programarea_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_community_category_community_category_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_community_districts_DistrictID"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($community->community_1);
			$this->GetSearchParm($community->programarea_programarea_id);
			$this->GetSearchParm($community->community_category_community_category_id);
			$this->GetSearchParm($community->community_districts_DistrictID);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $community;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$community->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$community->CurrentOrderType = @$_GET["ordertype"];
			$community->UpdateSort($community->community_1); // community
			$community->UpdateSort($community->programarea_programarea_id); // programarea_programarea_id
			$community->UpdateSort($community->community_category_community_category_id); // community_category_community_category_id
			$community->UpdateSort($community->community_districts_DistrictID); // community_districts_DistrictID
			$community->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $community;
		$sOrderBy = $community->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($community->SqlOrderBy() <> "") {
				$sOrderBy = $community->SqlOrderBy();
				$community->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $community;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$community->getCurrentMasterTable = ""; // Clear master table
				$community->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$community->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$community->community_districts_DistrictID->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$community->setSessionOrderBy($sOrderBy);
				$community->community_1->setSort("");
				$community->programarea_programarea_id->setSort("");
				$community->community_category_community_category_id->setSort("");
				$community->community_districts_DistrictID->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$community->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $community;

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

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($community->Export <> "" ||
			$community->CurrentAction == "gridadd" ||
			$community->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $community;
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
			$oListOpt->Body = "<a href=\"sponsored_student_detaillist.php?" . EW_TABLE_SHOW_MASTER . "=community&community_id=" . urlencode(strval($community->community_id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $community;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $community;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$community->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$community->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $community->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$community->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$community->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$community->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $community;

		// Load search values
		// community

		$community->community_1->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_community_1"]);
		$community->community_1->AdvancedSearch->SearchOperator = @$_GET["z_community_1"];

		// programarea_programarea_id
		$community->programarea_programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programarea_programarea_id"]);
		$community->programarea_programarea_id->AdvancedSearch->SearchOperator = @$_GET["z_programarea_programarea_id"];

		// community_category_community_category_id
		$community->community_category_community_category_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_community_category_community_category_id"]);
		$community->community_category_community_category_id->AdvancedSearch->SearchOperator = @$_GET["z_community_category_community_category_id"];

		// community_districts_DistrictID
		$community->community_districts_DistrictID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_community_districts_DistrictID"]);
		$community->community_districts_DistrictID->AdvancedSearch->SearchOperator = @$_GET["z_community_districts_DistrictID"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $community;

		// Call Recordset Selecting event
		$community->Recordset_Selecting($community->CurrentFilter);

		// Load List page SQL
		$sSql = $community->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$community->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $community;
		$sFilter = $community->KeyFilter();

		// Call Row Selecting event
		$community->Row_Selecting($sFilter);

		// Load SQL based on filter
		$community->CurrentFilter = $sFilter;
		$sSql = $community->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$community->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $community;
		$community->community_id->setDbValue($rs->fields('community_id'));
		$community->community_1->setDbValue($rs->fields('community'));
		$community->programarea_programarea_id->setDbValue($rs->fields('programarea_programarea_id'));
		$community->community_category_community_category_id->setDbValue($rs->fields('community_category_community_category_id'));
		$community->community_districts_DistrictID->setDbValue($rs->fields('community_districts_DistrictID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $community;

		// Initialize URLs
		$this->ViewUrl = $community->ViewUrl();
		$this->EditUrl = $community->EditUrl();
		$this->InlineEditUrl = $community->InlineEditUrl();
		$this->CopyUrl = $community->CopyUrl();
		$this->InlineCopyUrl = $community->InlineCopyUrl();
		$this->DeleteUrl = $community->DeleteUrl();

		// Call Row_Rendering event
		$community->Row_Rendering();

		// Common render codes for all row types
		// community

		$community->community_1->CellCssStyle = ""; $community->community_1->CellCssClass = "";
		$community->community_1->CellAttrs = array(); $community->community_1->ViewAttrs = array(); $community->community_1->EditAttrs = array();

		// programarea_programarea_id
		$community->programarea_programarea_id->CellCssStyle = ""; $community->programarea_programarea_id->CellCssClass = "";
		$community->programarea_programarea_id->CellAttrs = array(); $community->programarea_programarea_id->ViewAttrs = array(); $community->programarea_programarea_id->EditAttrs = array();

		// community_category_community_category_id
		$community->community_category_community_category_id->CellCssStyle = ""; $community->community_category_community_category_id->CellCssClass = "";
		$community->community_category_community_category_id->CellAttrs = array(); $community->community_category_community_category_id->ViewAttrs = array(); $community->community_category_community_category_id->EditAttrs = array();

		// community_districts_DistrictID
		$community->community_districts_DistrictID->CellCssStyle = ""; $community->community_districts_DistrictID->CellCssClass = "";
		$community->community_districts_DistrictID->CellAttrs = array(); $community->community_districts_DistrictID->ViewAttrs = array(); $community->community_districts_DistrictID->EditAttrs = array();
		if ($community->RowType == EW_ROWTYPE_VIEW) { // View row

			// community_id
			$community->community_id->ViewValue = $community->community_id->CurrentValue;
			$community->community_id->CssStyle = "";
			$community->community_id->CssClass = "";
			$community->community_id->ViewCustomAttributes = "";

			// community
			$community->community_1->ViewValue = $community->community_1->CurrentValue;
			$community->community_1->CssStyle = "";
			$community->community_1->CssClass = "";
			$community->community_1->ViewCustomAttributes = "";

			// programarea_programarea_id
			if (strval($community->programarea_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($community->programarea_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$community->programarea_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$community->programarea_programarea_id->ViewValue = $community->programarea_programarea_id->CurrentValue;
				}
			} else {
				$community->programarea_programarea_id->ViewValue = NULL;
			}
			$community->programarea_programarea_id->CssStyle = "";
			$community->programarea_programarea_id->CssClass = "";
			$community->programarea_programarea_id->ViewCustomAttributes = "";

			// community_category_community_category_id
			if (strval($community->community_category_community_category_id->CurrentValue) <> "") {
				$sFilterWrk = "`community_category_id` = " . ew_AdjustSql($community->community_category_community_category_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `community_category_name` FROM `community_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$community->community_category_community_category_id->ViewValue = $rswrk->fields('community_category_name');
					$rswrk->Close();
				} else {
					$community->community_category_community_category_id->ViewValue = $community->community_category_community_category_id->CurrentValue;
				}
			} else {
				$community->community_category_community_category_id->ViewValue = NULL;
			}
			$community->community_category_community_category_id->CssStyle = "";
			$community->community_category_community_category_id->CssClass = "";
			$community->community_category_community_category_id->ViewCustomAttributes = "";

			// community_districts_DistrictID
			if (strval($community->community_districts_DistrictID->CurrentValue) <> "") {
				$sFilterWrk = "`DistrictID` = " . ew_AdjustSql($community->community_districts_DistrictID->CurrentValue) . "";
			$sSqlWrk = "SELECT `District` FROM `districts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$community->community_districts_DistrictID->ViewValue = $rswrk->fields('District');
					$rswrk->Close();
				} else {
					$community->community_districts_DistrictID->ViewValue = $community->community_districts_DistrictID->CurrentValue;
				}
			} else {
				$community->community_districts_DistrictID->ViewValue = NULL;
			}
			$community->community_districts_DistrictID->CssStyle = "";
			$community->community_districts_DistrictID->CssClass = "";
			$community->community_districts_DistrictID->ViewCustomAttributes = "";

			// community
			$community->community_1->HrefValue = "";
			$community->community_1->TooltipValue = "";

			// programarea_programarea_id
			$community->programarea_programarea_id->HrefValue = "";
			$community->programarea_programarea_id->TooltipValue = "";

			// community_category_community_category_id
			$community->community_category_community_category_id->HrefValue = "";
			$community->community_category_community_category_id->TooltipValue = "";

			// community_districts_DistrictID
			$community->community_districts_DistrictID->HrefValue = "";
			$community->community_districts_DistrictID->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($community->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$community->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $community;

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
		global $community;
		$community->community_1->AdvancedSearch->SearchValue = $community->getAdvancedSearch("x_community_1");
		$community->programarea_programarea_id->AdvancedSearch->SearchValue = $community->getAdvancedSearch("x_programarea_programarea_id");
		$community->community_category_community_category_id->AdvancedSearch->SearchValue = $community->getAdvancedSearch("x_community_category_community_category_id");
		$community->community_districts_DistrictID->AdvancedSearch->SearchValue = $community->getAdvancedSearch("x_community_districts_DistrictID");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $community;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $community->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($community->ExportAll) {
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
		if ($community->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($community, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($community->community_id);
				$ExportDoc->ExportCaption($community->community_1);
				$ExportDoc->ExportCaption($community->programarea_programarea_id);
				$ExportDoc->ExportCaption($community->community_category_community_category_id);
				$ExportDoc->ExportCaption($community->community_districts_DistrictID);
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
				$community->CssClass = "";
				$community->CssStyle = "";
				$community->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($community->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('community_id', $community->community_id->ExportValue($community->Export, $community->ExportOriginalValue));
					$XmlDoc->AddField('community_1', $community->community_1->ExportValue($community->Export, $community->ExportOriginalValue));
					$XmlDoc->AddField('programarea_programarea_id', $community->programarea_programarea_id->ExportValue($community->Export, $community->ExportOriginalValue));
					$XmlDoc->AddField('community_category_community_category_id', $community->community_category_community_category_id->ExportValue($community->Export, $community->ExportOriginalValue));
					$XmlDoc->AddField('community_districts_DistrictID', $community->community_districts_DistrictID->ExportValue($community->Export, $community->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($community->community_id);
					$ExportDoc->ExportField($community->community_1);
					$ExportDoc->ExportField($community->programarea_programarea_id);
					$ExportDoc->ExportField($community->community_category_community_category_id);
					$ExportDoc->ExportField($community->community_districts_DistrictID);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($community->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($community->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($community->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($community->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($community->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $community;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "districts") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $community->SqlMasterFilter_districts();
				$this->sDbDetailFilter = $community->SqlDetailFilter_districts();
				if (@$_GET["DistrictID"] <> "") {
					$GLOBALS["districts"]->DistrictID->setQueryStringValue($_GET["DistrictID"]);
					$community->community_districts_DistrictID->setQueryStringValue($GLOBALS["districts"]->DistrictID->QueryStringValue);
					$community->community_districts_DistrictID->setSessionValue($community->community_districts_DistrictID->QueryStringValue);
					if (!is_numeric($GLOBALS["districts"]->DistrictID->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@DistrictID@", ew_AdjustSql($GLOBALS["districts"]->DistrictID->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@community_districts_DistrictID@", ew_AdjustSql($GLOBALS["districts"]->DistrictID->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$community->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$community->setStartRecordNumber($this->lStartRec);
			$community->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$community->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "districts") {
				if ($community->community_districts_DistrictID->QueryStringValue == "") $community->community_districts_DistrictID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $community->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $community->getDetailFilter(); // Restore detail filter
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
