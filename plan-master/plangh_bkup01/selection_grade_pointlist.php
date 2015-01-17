<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "selection_grade_pointinfo.php" ?>
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
$selection_grade_point_list = new cselection_grade_point_list();
$Page =& $selection_grade_point_list;

// Page init
$selection_grade_point_list->Page_Init();

// Page main
$selection_grade_point_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($selection_grade_point->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var selection_grade_point_list = new ew_Page("selection_grade_point_list");

// page properties
selection_grade_point_list.PageID = "list"; // page ID
selection_grade_point_list.FormID = "fselection_grade_pointlist"; // form ID
var EW_PAGE_ID = selection_grade_point_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
selection_grade_point_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
selection_grade_point_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
selection_grade_point_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($selection_grade_point->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$selection_grade_point_list->lTotalRecs = $selection_grade_point->SelectRecordCount();
	} else {
		if ($rs = $selection_grade_point_list->LoadRecordset())
			$selection_grade_point_list->lTotalRecs = $rs->RecordCount();
	}
	$selection_grade_point_list->lStartRec = 1;
	if ($selection_grade_point_list->lDisplayRecs <= 0 || ($selection_grade_point->Export <> "" && $selection_grade_point->ExportAll)) // Display all records
		$selection_grade_point_list->lDisplayRecs = $selection_grade_point_list->lTotalRecs;
	if (!($selection_grade_point->Export <> "" && $selection_grade_point->ExportAll))
		$selection_grade_point_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $selection_grade_point_list->LoadRecordset($selection_grade_point_list->lStartRec-1, $selection_grade_point_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $selection_grade_point->TableCaption() ?>
<?php if ($selection_grade_point->Export == "" && $selection_grade_point->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $selection_grade_point_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $selection_grade_point_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $selection_grade_point_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$selection_grade_point_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fselection_grade_pointlist" id="fselection_grade_pointlist" class="ewForm" action="" method="post">
<div id="gmp_selection_grade_point" class="ewGridMiddlePanel">
<?php if ($selection_grade_point_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $selection_grade_point->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$selection_grade_point_list->RenderListOptions();

// Render list options (header, left)
$selection_grade_point_list->ListOptions->Render("header", "left");
?>
<?php if ($selection_grade_point->selection_grade_points_id->Visible) { // selection_grade_points_id ?>
	<?php if ($selection_grade_point->SortUrl($selection_grade_point->selection_grade_points_id) == "") { ?>
		<td><?php echo $selection_grade_point->selection_grade_points_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $selection_grade_point->SortUrl($selection_grade_point->selection_grade_points_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $selection_grade_point->selection_grade_points_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($selection_grade_point->selection_grade_points_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($selection_grade_point->selection_grade_points_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($selection_grade_point->grade_point->Visible) { // grade_point ?>
	<?php if ($selection_grade_point->SortUrl($selection_grade_point->grade_point) == "") { ?>
		<td><?php echo $selection_grade_point->grade_point->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $selection_grade_point->SortUrl($selection_grade_point->grade_point) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $selection_grade_point->grade_point->FldCaption() ?></td><td style="width: 10px;"><?php if ($selection_grade_point->grade_point->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($selection_grade_point->grade_point->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($selection_grade_point->min_grade->Visible) { // min_grade ?>
	<?php if ($selection_grade_point->SortUrl($selection_grade_point->min_grade) == "") { ?>
		<td><?php echo $selection_grade_point->min_grade->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $selection_grade_point->SortUrl($selection_grade_point->min_grade) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $selection_grade_point->min_grade->FldCaption() ?></td><td style="width: 10px;"><?php if ($selection_grade_point->min_grade->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($selection_grade_point->min_grade->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($selection_grade_point->max_grade->Visible) { // max_grade ?>
	<?php if ($selection_grade_point->SortUrl($selection_grade_point->max_grade) == "") { ?>
		<td><?php echo $selection_grade_point->max_grade->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $selection_grade_point->SortUrl($selection_grade_point->max_grade) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $selection_grade_point->max_grade->FldCaption() ?></td><td style="width: 10px;"><?php if ($selection_grade_point->max_grade->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($selection_grade_point->max_grade->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$selection_grade_point_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($selection_grade_point->ExportAll && $selection_grade_point->Export <> "") {
	$selection_grade_point_list->lStopRec = $selection_grade_point_list->lTotalRecs;
} else {
	$selection_grade_point_list->lStopRec = $selection_grade_point_list->lStartRec + $selection_grade_point_list->lDisplayRecs - 1; // Set the last record to display
}
$selection_grade_point_list->lRecCount = $selection_grade_point_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $selection_grade_point_list->lStartRec > 1)
		$rs->Move($selection_grade_point_list->lStartRec - 1);
}

// Initialize aggregate
$selection_grade_point->RowType = EW_ROWTYPE_AGGREGATEINIT;
$selection_grade_point_list->RenderRow();
$selection_grade_point_list->lRowCnt = 0;
while (($selection_grade_point->CurrentAction == "gridadd" || !$rs->EOF) &&
	$selection_grade_point_list->lRecCount < $selection_grade_point_list->lStopRec) {
	$selection_grade_point_list->lRecCount++;
	if (intval($selection_grade_point_list->lRecCount) >= intval($selection_grade_point_list->lStartRec)) {
		$selection_grade_point_list->lRowCnt++;

	// Init row class and style
	$selection_grade_point->CssClass = "";
	$selection_grade_point->CssStyle = "";
	$selection_grade_point->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($selection_grade_point->CurrentAction == "gridadd") {
		$selection_grade_point_list->LoadDefaultValues(); // Load default values
	} else {
		$selection_grade_point_list->LoadRowValues($rs); // Load row values
	}
	$selection_grade_point->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$selection_grade_point_list->RenderRow();

	// Render list options
	$selection_grade_point_list->RenderListOptions();
?>
	<tr<?php echo $selection_grade_point->RowAttributes() ?>>
<?php

// Render list options (body, left)
$selection_grade_point_list->ListOptions->Render("body", "left");
?>
	<?php if ($selection_grade_point->selection_grade_points_id->Visible) { // selection_grade_points_id ?>
		<td<?php echo $selection_grade_point->selection_grade_points_id->CellAttributes() ?>>
<div<?php echo $selection_grade_point->selection_grade_points_id->ViewAttributes() ?>><?php echo $selection_grade_point->selection_grade_points_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($selection_grade_point->grade_point->Visible) { // grade_point ?>
		<td<?php echo $selection_grade_point->grade_point->CellAttributes() ?>>
<div<?php echo $selection_grade_point->grade_point->ViewAttributes() ?>><?php echo $selection_grade_point->grade_point->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($selection_grade_point->min_grade->Visible) { // min_grade ?>
		<td<?php echo $selection_grade_point->min_grade->CellAttributes() ?>>
<div<?php echo $selection_grade_point->min_grade->ViewAttributes() ?>><?php echo $selection_grade_point->min_grade->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($selection_grade_point->max_grade->Visible) { // max_grade ?>
		<td<?php echo $selection_grade_point->max_grade->CellAttributes() ?>>
<div<?php echo $selection_grade_point->max_grade->ViewAttributes() ?>><?php echo $selection_grade_point->max_grade->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$selection_grade_point_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($selection_grade_point->CurrentAction <> "gridadd")
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
<?php if ($selection_grade_point->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($selection_grade_point->CurrentAction <> "gridadd" && $selection_grade_point->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($selection_grade_point_list->Pager)) $selection_grade_point_list->Pager = new cPrevNextPager($selection_grade_point_list->lStartRec, $selection_grade_point_list->lDisplayRecs, $selection_grade_point_list->lTotalRecs) ?>
<?php if ($selection_grade_point_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($selection_grade_point_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $selection_grade_point_list->PageUrl() ?>start=<?php echo $selection_grade_point_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($selection_grade_point_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $selection_grade_point_list->PageUrl() ?>start=<?php echo $selection_grade_point_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $selection_grade_point_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($selection_grade_point_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $selection_grade_point_list->PageUrl() ?>start=<?php echo $selection_grade_point_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($selection_grade_point_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $selection_grade_point_list->PageUrl() ?>start=<?php echo $selection_grade_point_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $selection_grade_point_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $selection_grade_point_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $selection_grade_point_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $selection_grade_point_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($selection_grade_point_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($selection_grade_point_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $selection_grade_point_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($selection_grade_point->Export == "" && $selection_grade_point->CurrentAction == "") { ?>
<?php } ?>
<?php if ($selection_grade_point->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$selection_grade_point_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cselection_grade_point_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'selection_grade_point';

	// Page object name
	var $PageObjName = 'selection_grade_point_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $selection_grade_point;
		if ($selection_grade_point->UseTokenInUrl) $PageUrl .= "t=" . $selection_grade_point->TableVar . "&"; // Add page token
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
		global $objForm, $selection_grade_point;
		if ($selection_grade_point->UseTokenInUrl) {
			if ($objForm)
				return ($selection_grade_point->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($selection_grade_point->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cselection_grade_point_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (selection_grade_point)
		$GLOBALS["selection_grade_point"] = new cselection_grade_point();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["selection_grade_point"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "selection_grade_pointdelete.php";
		$this->MultiUpdateUrl = "selection_grade_pointupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'selection_grade_point', TRUE);

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
		global $selection_grade_point;

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
			$selection_grade_point->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$selection_grade_point->Export = $_POST["exporttype"];
		} else {
			$selection_grade_point->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $selection_grade_point->Export; // Get export parameter, used in header
		$gsExportFile = $selection_grade_point->TableVar; // Get export file, used in header
		if ($selection_grade_point->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($selection_grade_point->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $selection_grade_point;

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
		if ($selection_grade_point->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $selection_grade_point->getRecordsPerPage(); // Restore from Session
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
		$selection_grade_point->setSessionWhere($sFilter);
		$selection_grade_point->CurrentFilter = "";

		// Export data only
		if (in_array($selection_grade_point->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($selection_grade_point->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $selection_grade_point;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$selection_grade_point->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$selection_grade_point->CurrentOrderType = @$_GET["ordertype"];
			$selection_grade_point->UpdateSort($selection_grade_point->selection_grade_points_id); // selection_grade_points_id
			$selection_grade_point->UpdateSort($selection_grade_point->grade_point); // grade_point
			$selection_grade_point->UpdateSort($selection_grade_point->min_grade); // min_grade
			$selection_grade_point->UpdateSort($selection_grade_point->max_grade); // max_grade
			$selection_grade_point->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $selection_grade_point;
		$sOrderBy = $selection_grade_point->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($selection_grade_point->SqlOrderBy() <> "") {
				$sOrderBy = $selection_grade_point->SqlOrderBy();
				$selection_grade_point->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $selection_grade_point;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$selection_grade_point->setSessionOrderBy($sOrderBy);
				$selection_grade_point->selection_grade_points_id->setSort("");
				$selection_grade_point->grade_point->setSort("");
				$selection_grade_point->min_grade->setSort("");
				$selection_grade_point->max_grade->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$selection_grade_point->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $selection_grade_point;

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
		if ($selection_grade_point->Export <> "" ||
			$selection_grade_point->CurrentAction == "gridadd" ||
			$selection_grade_point->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $selection_grade_point;
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
		global $Security, $Language, $selection_grade_point;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $selection_grade_point;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$selection_grade_point->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$selection_grade_point->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $selection_grade_point->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$selection_grade_point->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$selection_grade_point->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$selection_grade_point->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $selection_grade_point;

		// Call Recordset Selecting event
		$selection_grade_point->Recordset_Selecting($selection_grade_point->CurrentFilter);

		// Load List page SQL
		$sSql = $selection_grade_point->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$selection_grade_point->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $selection_grade_point;
		$sFilter = $selection_grade_point->KeyFilter();

		// Call Row Selecting event
		$selection_grade_point->Row_Selecting($sFilter);

		// Load SQL based on filter
		$selection_grade_point->CurrentFilter = $sFilter;
		$sSql = $selection_grade_point->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$selection_grade_point->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $selection_grade_point;
		$selection_grade_point->selection_grade_points_id->setDbValue($rs->fields('selection_grade_points_id'));
		$selection_grade_point->grade_point->setDbValue($rs->fields('grade_point'));
		$selection_grade_point->min_grade->setDbValue($rs->fields('min_grade'));
		$selection_grade_point->max_grade->setDbValue($rs->fields('max_grade'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $selection_grade_point;

		// Initialize URLs
		$this->ViewUrl = $selection_grade_point->ViewUrl();
		$this->EditUrl = $selection_grade_point->EditUrl();
		$this->InlineEditUrl = $selection_grade_point->InlineEditUrl();
		$this->CopyUrl = $selection_grade_point->CopyUrl();
		$this->InlineCopyUrl = $selection_grade_point->InlineCopyUrl();
		$this->DeleteUrl = $selection_grade_point->DeleteUrl();

		// Call Row_Rendering event
		$selection_grade_point->Row_Rendering();

		// Common render codes for all row types
		// selection_grade_points_id

		$selection_grade_point->selection_grade_points_id->CellCssStyle = ""; $selection_grade_point->selection_grade_points_id->CellCssClass = "";
		$selection_grade_point->selection_grade_points_id->CellAttrs = array(); $selection_grade_point->selection_grade_points_id->ViewAttrs = array(); $selection_grade_point->selection_grade_points_id->EditAttrs = array();

		// grade_point
		$selection_grade_point->grade_point->CellCssStyle = ""; $selection_grade_point->grade_point->CellCssClass = "";
		$selection_grade_point->grade_point->CellAttrs = array(); $selection_grade_point->grade_point->ViewAttrs = array(); $selection_grade_point->grade_point->EditAttrs = array();

		// min_grade
		$selection_grade_point->min_grade->CellCssStyle = ""; $selection_grade_point->min_grade->CellCssClass = "";
		$selection_grade_point->min_grade->CellAttrs = array(); $selection_grade_point->min_grade->ViewAttrs = array(); $selection_grade_point->min_grade->EditAttrs = array();

		// max_grade
		$selection_grade_point->max_grade->CellCssStyle = ""; $selection_grade_point->max_grade->CellCssClass = "";
		$selection_grade_point->max_grade->CellAttrs = array(); $selection_grade_point->max_grade->ViewAttrs = array(); $selection_grade_point->max_grade->EditAttrs = array();
		if ($selection_grade_point->RowType == EW_ROWTYPE_VIEW) { // View row

			// selection_grade_points_id
			$selection_grade_point->selection_grade_points_id->ViewValue = $selection_grade_point->selection_grade_points_id->CurrentValue;
			$selection_grade_point->selection_grade_points_id->CssStyle = "";
			$selection_grade_point->selection_grade_points_id->CssClass = "";
			$selection_grade_point->selection_grade_points_id->ViewCustomAttributes = "";

			// grade_point
			$selection_grade_point->grade_point->ViewValue = $selection_grade_point->grade_point->CurrentValue;
			$selection_grade_point->grade_point->CssStyle = "";
			$selection_grade_point->grade_point->CssClass = "";
			$selection_grade_point->grade_point->ViewCustomAttributes = "";

			// min_grade
			$selection_grade_point->min_grade->ViewValue = $selection_grade_point->min_grade->CurrentValue;
			$selection_grade_point->min_grade->CssStyle = "";
			$selection_grade_point->min_grade->CssClass = "";
			$selection_grade_point->min_grade->ViewCustomAttributes = "";

			// max_grade
			$selection_grade_point->max_grade->ViewValue = $selection_grade_point->max_grade->CurrentValue;
			$selection_grade_point->max_grade->CssStyle = "";
			$selection_grade_point->max_grade->CssClass = "";
			$selection_grade_point->max_grade->ViewCustomAttributes = "";

			// selection_grade_points_id
			$selection_grade_point->selection_grade_points_id->HrefValue = "";
			$selection_grade_point->selection_grade_points_id->TooltipValue = "";

			// grade_point
			$selection_grade_point->grade_point->HrefValue = "";
			$selection_grade_point->grade_point->TooltipValue = "";

			// min_grade
			$selection_grade_point->min_grade->HrefValue = "";
			$selection_grade_point->min_grade->TooltipValue = "";

			// max_grade
			$selection_grade_point->max_grade->HrefValue = "";
			$selection_grade_point->max_grade->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($selection_grade_point->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$selection_grade_point->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $selection_grade_point;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $selection_grade_point->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($selection_grade_point->ExportAll) {
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
		if ($selection_grade_point->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($selection_grade_point, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($selection_grade_point->selection_grade_points_id);
				$ExportDoc->ExportCaption($selection_grade_point->grade_point);
				$ExportDoc->ExportCaption($selection_grade_point->min_grade);
				$ExportDoc->ExportCaption($selection_grade_point->max_grade);
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
				$selection_grade_point->CssClass = "";
				$selection_grade_point->CssStyle = "";
				$selection_grade_point->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($selection_grade_point->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('selection_grade_points_id', $selection_grade_point->selection_grade_points_id->ExportValue($selection_grade_point->Export, $selection_grade_point->ExportOriginalValue));
					$XmlDoc->AddField('grade_point', $selection_grade_point->grade_point->ExportValue($selection_grade_point->Export, $selection_grade_point->ExportOriginalValue));
					$XmlDoc->AddField('min_grade', $selection_grade_point->min_grade->ExportValue($selection_grade_point->Export, $selection_grade_point->ExportOriginalValue));
					$XmlDoc->AddField('max_grade', $selection_grade_point->max_grade->ExportValue($selection_grade_point->Export, $selection_grade_point->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($selection_grade_point->selection_grade_points_id);
					$ExportDoc->ExportField($selection_grade_point->grade_point);
					$ExportDoc->ExportField($selection_grade_point->min_grade);
					$ExportDoc->ExportField($selection_grade_point->max_grade);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($selection_grade_point->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($selection_grade_point->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($selection_grade_point->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($selection_grade_point->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($selection_grade_point->ExportReturnUrl());
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
