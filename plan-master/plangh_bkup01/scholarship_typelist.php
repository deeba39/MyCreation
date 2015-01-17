<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "scholarship_typeinfo.php" ?>
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
$scholarship_type_list = new cscholarship_type_list();
$Page =& $scholarship_type_list;

// Page init
$scholarship_type_list->Page_Init();

// Page main
$scholarship_type_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($scholarship_type->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var scholarship_type_list = new ew_Page("scholarship_type_list");

// page properties
scholarship_type_list.PageID = "list"; // page ID
scholarship_type_list.FormID = "fscholarship_typelist"; // form ID
var EW_PAGE_ID = scholarship_type_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
scholarship_type_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
scholarship_type_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
scholarship_type_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($scholarship_type->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$scholarship_type_list->lTotalRecs = $scholarship_type->SelectRecordCount();
	} else {
		if ($rs = $scholarship_type_list->LoadRecordset())
			$scholarship_type_list->lTotalRecs = $rs->RecordCount();
	}
	$scholarship_type_list->lStartRec = 1;
	if ($scholarship_type_list->lDisplayRecs <= 0 || ($scholarship_type->Export <> "" && $scholarship_type->ExportAll)) // Display all records
		$scholarship_type_list->lDisplayRecs = $scholarship_type_list->lTotalRecs;
	if (!($scholarship_type->Export <> "" && $scholarship_type->ExportAll))
		$scholarship_type_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $scholarship_type_list->LoadRecordset($scholarship_type_list->lStartRec-1, $scholarship_type_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $scholarship_type->TableCaption() ?>
<?php if ($scholarship_type->Export == "" && $scholarship_type->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $scholarship_type_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $scholarship_type_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $scholarship_type_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($scholarship_type->Export == "" && $scholarship_type->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(scholarship_type_list);" style="text-decoration: none;"><img id="scholarship_type_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="scholarship_type_list_SearchPanel">
<form name="fscholarship_typelistsrch" id="fscholarship_typelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="scholarship_type">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($scholarship_type->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $scholarship_type_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($scholarship_type->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($scholarship_type->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($scholarship_type->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$scholarship_type_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fscholarship_typelist" id="fscholarship_typelist" class="ewForm" action="" method="post">
<div id="gmp_scholarship_type" class="ewGridMiddlePanel">
<?php if ($scholarship_type_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $scholarship_type->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$scholarship_type_list->RenderListOptions();

// Render list options (header, left)
$scholarship_type_list->ListOptions->Render("header", "left");
?>
<?php if ($scholarship_type->scholarship_type_id->Visible) { // scholarship_type_id ?>
	<?php if ($scholarship_type->SortUrl($scholarship_type->scholarship_type_id) == "") { ?>
		<td><?php echo $scholarship_type->scholarship_type_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_type->SortUrl($scholarship_type->scholarship_type_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_type->scholarship_type_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_type->scholarship_type_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_type->scholarship_type_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_type->scholarship_type_name->Visible) { // scholarship_type_name ?>
	<?php if ($scholarship_type->SortUrl($scholarship_type->scholarship_type_name) == "") { ?>
		<td><?php echo $scholarship_type->scholarship_type_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_type->SortUrl($scholarship_type->scholarship_type_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_type->scholarship_type_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($scholarship_type->scholarship_type_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_type->scholarship_type_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($scholarship_type->scholarship_type_scale->Visible) { // scholarship_type_scale ?>
	<?php if ($scholarship_type->SortUrl($scholarship_type->scholarship_type_scale) == "") { ?>
		<td><?php echo $scholarship_type->scholarship_type_scale->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $scholarship_type->SortUrl($scholarship_type->scholarship_type_scale) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $scholarship_type->scholarship_type_scale->FldCaption() ?></td><td style="width: 10px;"><?php if ($scholarship_type->scholarship_type_scale->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($scholarship_type->scholarship_type_scale->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$scholarship_type_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($scholarship_type->ExportAll && $scholarship_type->Export <> "") {
	$scholarship_type_list->lStopRec = $scholarship_type_list->lTotalRecs;
} else {
	$scholarship_type_list->lStopRec = $scholarship_type_list->lStartRec + $scholarship_type_list->lDisplayRecs - 1; // Set the last record to display
}
$scholarship_type_list->lRecCount = $scholarship_type_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $scholarship_type_list->lStartRec > 1)
		$rs->Move($scholarship_type_list->lStartRec - 1);
}

// Initialize aggregate
$scholarship_type->RowType = EW_ROWTYPE_AGGREGATEINIT;
$scholarship_type_list->RenderRow();
$scholarship_type_list->lRowCnt = 0;
while (($scholarship_type->CurrentAction == "gridadd" || !$rs->EOF) &&
	$scholarship_type_list->lRecCount < $scholarship_type_list->lStopRec) {
	$scholarship_type_list->lRecCount++;
	if (intval($scholarship_type_list->lRecCount) >= intval($scholarship_type_list->lStartRec)) {
		$scholarship_type_list->lRowCnt++;

	// Init row class and style
	$scholarship_type->CssClass = "";
	$scholarship_type->CssStyle = "";
	$scholarship_type->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($scholarship_type->CurrentAction == "gridadd") {
		$scholarship_type_list->LoadDefaultValues(); // Load default values
	} else {
		$scholarship_type_list->LoadRowValues($rs); // Load row values
	}
	$scholarship_type->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$scholarship_type_list->RenderRow();

	// Render list options
	$scholarship_type_list->RenderListOptions();
?>
	<tr<?php echo $scholarship_type->RowAttributes() ?>>
<?php

// Render list options (body, left)
$scholarship_type_list->ListOptions->Render("body", "left");
?>
	<?php if ($scholarship_type->scholarship_type_id->Visible) { // scholarship_type_id ?>
		<td<?php echo $scholarship_type->scholarship_type_id->CellAttributes() ?>>
<div<?php echo $scholarship_type->scholarship_type_id->ViewAttributes() ?>><?php echo $scholarship_type->scholarship_type_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_type->scholarship_type_name->Visible) { // scholarship_type_name ?>
		<td<?php echo $scholarship_type->scholarship_type_name->CellAttributes() ?>>
<div<?php echo $scholarship_type->scholarship_type_name->ViewAttributes() ?>><?php echo $scholarship_type->scholarship_type_name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($scholarship_type->scholarship_type_scale->Visible) { // scholarship_type_scale ?>
		<td<?php echo $scholarship_type->scholarship_type_scale->CellAttributes() ?>>
<div<?php echo $scholarship_type->scholarship_type_scale->ViewAttributes() ?>><?php echo $scholarship_type->scholarship_type_scale->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$scholarship_type_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($scholarship_type->CurrentAction <> "gridadd")
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
<?php if ($scholarship_type->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($scholarship_type->CurrentAction <> "gridadd" && $scholarship_type->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($scholarship_type_list->Pager)) $scholarship_type_list->Pager = new cPrevNextPager($scholarship_type_list->lStartRec, $scholarship_type_list->lDisplayRecs, $scholarship_type_list->lTotalRecs) ?>
<?php if ($scholarship_type_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($scholarship_type_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $scholarship_type_list->PageUrl() ?>start=<?php echo $scholarship_type_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($scholarship_type_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $scholarship_type_list->PageUrl() ?>start=<?php echo $scholarship_type_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $scholarship_type_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($scholarship_type_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $scholarship_type_list->PageUrl() ?>start=<?php echo $scholarship_type_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($scholarship_type_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $scholarship_type_list->PageUrl() ?>start=<?php echo $scholarship_type_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $scholarship_type_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $scholarship_type_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $scholarship_type_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $scholarship_type_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($scholarship_type_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($scholarship_type_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $scholarship_type_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($scholarship_type->Export == "" && $scholarship_type->CurrentAction == "") { ?>
<?php } ?>
<?php if ($scholarship_type->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$scholarship_type_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cscholarship_type_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'scholarship_type';

	// Page object name
	var $PageObjName = 'scholarship_type_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $scholarship_type;
		if ($scholarship_type->UseTokenInUrl) $PageUrl .= "t=" . $scholarship_type->TableVar . "&"; // Add page token
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
		global $objForm, $scholarship_type;
		if ($scholarship_type->UseTokenInUrl) {
			if ($objForm)
				return ($scholarship_type->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($scholarship_type->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cscholarship_type_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (scholarship_type)
		$GLOBALS["scholarship_type"] = new cscholarship_type();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["scholarship_type"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "scholarship_typedelete.php";
		$this->MultiUpdateUrl = "scholarship_typeupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'scholarship_type', TRUE);

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
		global $scholarship_type;

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
			$scholarship_type->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$scholarship_type->Export = $_POST["exporttype"];
		} else {
			$scholarship_type->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $scholarship_type->Export; // Get export parameter, used in header
		$gsExportFile = $scholarship_type->TableVar; // Get export file, used in header
		if ($scholarship_type->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($scholarship_type->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $scholarship_type;

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
			$scholarship_type->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($scholarship_type->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $scholarship_type->getRecordsPerPage(); // Restore from Session
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
		$scholarship_type->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$scholarship_type->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$scholarship_type->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $scholarship_type->getSearchWhere();
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
		$scholarship_type->setSessionWhere($sFilter);
		$scholarship_type->CurrentFilter = "";

		// Export data only
		if (in_array($scholarship_type->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($scholarship_type->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $scholarship_type;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $scholarship_type->scholarship_type_name, $Keyword);
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
		global $Security, $scholarship_type;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $scholarship_type->BasicSearchKeyword;
		$sSearchType = $scholarship_type->BasicSearchType;
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
			$scholarship_type->setSessionBasicSearchKeyword($sSearchKeyword);
			$scholarship_type->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $scholarship_type;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$scholarship_type->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $scholarship_type;
		$scholarship_type->setSessionBasicSearchKeyword("");
		$scholarship_type->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $scholarship_type;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$scholarship_type->BasicSearchKeyword = $scholarship_type->getSessionBasicSearchKeyword();
			$scholarship_type->BasicSearchType = $scholarship_type->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $scholarship_type;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$scholarship_type->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$scholarship_type->CurrentOrderType = @$_GET["ordertype"];
			$scholarship_type->UpdateSort($scholarship_type->scholarship_type_id); // scholarship_type_id
			$scholarship_type->UpdateSort($scholarship_type->scholarship_type_name); // scholarship_type_name
			$scholarship_type->UpdateSort($scholarship_type->scholarship_type_scale); // scholarship_type_scale
			$scholarship_type->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $scholarship_type;
		$sOrderBy = $scholarship_type->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($scholarship_type->SqlOrderBy() <> "") {
				$sOrderBy = $scholarship_type->SqlOrderBy();
				$scholarship_type->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $scholarship_type;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$scholarship_type->setSessionOrderBy($sOrderBy);
				$scholarship_type->scholarship_type_id->setSort("");
				$scholarship_type->scholarship_type_name->setSort("");
				$scholarship_type->scholarship_type_scale->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$scholarship_type->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $scholarship_type;

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
		if ($scholarship_type->Export <> "" ||
			$scholarship_type->CurrentAction == "gridadd" ||
			$scholarship_type->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $scholarship_type;
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
		global $Security, $Language, $scholarship_type;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $scholarship_type;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$scholarship_type->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$scholarship_type->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $scholarship_type->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$scholarship_type->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$scholarship_type->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$scholarship_type->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $scholarship_type;
		$scholarship_type->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$scholarship_type->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $scholarship_type;

		// Call Recordset Selecting event
		$scholarship_type->Recordset_Selecting($scholarship_type->CurrentFilter);

		// Load List page SQL
		$sSql = $scholarship_type->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$scholarship_type->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $scholarship_type;
		$sFilter = $scholarship_type->KeyFilter();

		// Call Row Selecting event
		$scholarship_type->Row_Selecting($sFilter);

		// Load SQL based on filter
		$scholarship_type->CurrentFilter = $sFilter;
		$sSql = $scholarship_type->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$scholarship_type->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $scholarship_type;
		$scholarship_type->scholarship_type_id->setDbValue($rs->fields('scholarship_type_id'));
		$scholarship_type->scholarship_type_name->setDbValue($rs->fields('scholarship_type_name'));
		$scholarship_type->scholarship_type_scale->setDbValue($rs->fields('scholarship_type_scale'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $scholarship_type;

		// Initialize URLs
		$this->ViewUrl = $scholarship_type->ViewUrl();
		$this->EditUrl = $scholarship_type->EditUrl();
		$this->InlineEditUrl = $scholarship_type->InlineEditUrl();
		$this->CopyUrl = $scholarship_type->CopyUrl();
		$this->InlineCopyUrl = $scholarship_type->InlineCopyUrl();
		$this->DeleteUrl = $scholarship_type->DeleteUrl();

		// Call Row_Rendering event
		$scholarship_type->Row_Rendering();

		// Common render codes for all row types
		// scholarship_type_id

		$scholarship_type->scholarship_type_id->CellCssStyle = ""; $scholarship_type->scholarship_type_id->CellCssClass = "";
		$scholarship_type->scholarship_type_id->CellAttrs = array(); $scholarship_type->scholarship_type_id->ViewAttrs = array(); $scholarship_type->scholarship_type_id->EditAttrs = array();

		// scholarship_type_name
		$scholarship_type->scholarship_type_name->CellCssStyle = ""; $scholarship_type->scholarship_type_name->CellCssClass = "";
		$scholarship_type->scholarship_type_name->CellAttrs = array(); $scholarship_type->scholarship_type_name->ViewAttrs = array(); $scholarship_type->scholarship_type_name->EditAttrs = array();

		// scholarship_type_scale
		$scholarship_type->scholarship_type_scale->CellCssStyle = ""; $scholarship_type->scholarship_type_scale->CellCssClass = "";
		$scholarship_type->scholarship_type_scale->CellAttrs = array(); $scholarship_type->scholarship_type_scale->ViewAttrs = array(); $scholarship_type->scholarship_type_scale->EditAttrs = array();
		if ($scholarship_type->RowType == EW_ROWTYPE_VIEW) { // View row

			// scholarship_type_id
			$scholarship_type->scholarship_type_id->ViewValue = $scholarship_type->scholarship_type_id->CurrentValue;
			$scholarship_type->scholarship_type_id->CssStyle = "";
			$scholarship_type->scholarship_type_id->CssClass = "";
			$scholarship_type->scholarship_type_id->ViewCustomAttributes = "";

			// scholarship_type_name
			$scholarship_type->scholarship_type_name->ViewValue = $scholarship_type->scholarship_type_name->CurrentValue;
			$scholarship_type->scholarship_type_name->CssStyle = "";
			$scholarship_type->scholarship_type_name->CssClass = "";
			$scholarship_type->scholarship_type_name->ViewCustomAttributes = "";

			// scholarship_type_scale
			$scholarship_type->scholarship_type_scale->ViewValue = $scholarship_type->scholarship_type_scale->CurrentValue;
			$scholarship_type->scholarship_type_scale->CssStyle = "";
			$scholarship_type->scholarship_type_scale->CssClass = "";
			$scholarship_type->scholarship_type_scale->ViewCustomAttributes = "";

			// scholarship_type_id
			$scholarship_type->scholarship_type_id->HrefValue = "";
			$scholarship_type->scholarship_type_id->TooltipValue = "";

			// scholarship_type_name
			$scholarship_type->scholarship_type_name->HrefValue = "";
			$scholarship_type->scholarship_type_name->TooltipValue = "";

			// scholarship_type_scale
			$scholarship_type->scholarship_type_scale->HrefValue = "";
			$scholarship_type->scholarship_type_scale->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($scholarship_type->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$scholarship_type->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $scholarship_type;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $scholarship_type->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($scholarship_type->ExportAll) {
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
		if ($scholarship_type->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($scholarship_type, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($scholarship_type->scholarship_type_id);
				$ExportDoc->ExportCaption($scholarship_type->scholarship_type_name);
				$ExportDoc->ExportCaption($scholarship_type->scholarship_type_scale);
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
				$scholarship_type->CssClass = "";
				$scholarship_type->CssStyle = "";
				$scholarship_type->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($scholarship_type->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('scholarship_type_id', $scholarship_type->scholarship_type_id->ExportValue($scholarship_type->Export, $scholarship_type->ExportOriginalValue));
					$XmlDoc->AddField('scholarship_type_name', $scholarship_type->scholarship_type_name->ExportValue($scholarship_type->Export, $scholarship_type->ExportOriginalValue));
					$XmlDoc->AddField('scholarship_type_scale', $scholarship_type->scholarship_type_scale->ExportValue($scholarship_type->Export, $scholarship_type->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($scholarship_type->scholarship_type_id);
					$ExportDoc->ExportField($scholarship_type->scholarship_type_name);
					$ExportDoc->ExportField($scholarship_type->scholarship_type_scale);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($scholarship_type->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($scholarship_type->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($scholarship_type->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($scholarship_type->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($scholarship_type->ExportReturnUrl());
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
