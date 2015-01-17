<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "grade_yearinfo.php" ?>
<?php include "sponsored_studentinfo.php" ?>
<?php include "school_attendanceinfo.php" ?>
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
$grade_year_list = new cgrade_year_list();
$Page =& $grade_year_list;

// Page init
$grade_year_list->Page_Init();

// Page main
$grade_year_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($grade_year->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var grade_year_list = new ew_Page("grade_year_list");

// page properties
grade_year_list.PageID = "list"; // page ID
grade_year_list.FormID = "fgrade_yearlist"; // form ID
var EW_PAGE_ID = grade_year_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
grade_year_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grade_year_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grade_year_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($grade_year->Export == "") { ?>
<?php
$gsMasterReturnUrl = "school_attendancelist.php";
if ($grade_year_list->sDbMasterFilter <> "" && $grade_year->getCurrentMasterTable() == "school_attendance") {
	if ($grade_year_list->bMasterRecordExists) {
		if ($grade_year->getCurrentMasterTable() == $grade_year->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "school_attendancemaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$grade_year_list->lTotalRecs = $grade_year->SelectRecordCount();
	} else {
		if ($rs = $grade_year_list->LoadRecordset())
			$grade_year_list->lTotalRecs = $rs->RecordCount();
	}
	$grade_year_list->lStartRec = 1;
	if ($grade_year_list->lDisplayRecs <= 0 || ($grade_year->Export <> "" && $grade_year->ExportAll)) // Display all records
		$grade_year_list->lDisplayRecs = $grade_year_list->lTotalRecs;
	if (!($grade_year->Export <> "" && $grade_year->ExportAll))
		$grade_year_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $grade_year_list->LoadRecordset($grade_year_list->lStartRec-1, $grade_year_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grade_year->TableCaption() ?>
<?php if ($grade_year->Export == "" && $grade_year->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $grade_year_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $grade_year_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $grade_year_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($grade_year->Export == "" && $grade_year->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(grade_year_list);" style="text-decoration: none;"><img id="grade_year_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="grade_year_list_SearchPanel">
<form name="fgrade_yearlistsrch" id="fgrade_yearlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="grade_year">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $grade_year_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="grade_yearsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
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
$grade_year_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fgrade_yearlist" id="fgrade_yearlist" class="ewForm" action="" method="post">
<div id="gmp_grade_year" class="ewGridMiddlePanel">
<?php if ($grade_year_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $grade_year->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$grade_year_list->RenderListOptions();

// Render list options (header, left)
$grade_year_list->ListOptions->Render("header", "left");
?>
<?php if ($grade_year->class->Visible) { // class ?>
	<?php if ($grade_year->SortUrl($grade_year->class) == "") { ?>
		<td><?php echo $grade_year->class->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grade_year->SortUrl($grade_year->class) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grade_year->class->FldCaption() ?></td><td style="width: 10px;"><?php if ($grade_year->class->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grade_year->class->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grade_year->year->Visible) { // year ?>
	<?php if ($grade_year->SortUrl($grade_year->year) == "") { ?>
		<td><?php echo $grade_year->year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grade_year->SortUrl($grade_year->year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grade_year->year->FldCaption() ?></td><td style="width: 10px;"><?php if ($grade_year->year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grade_year->year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grade_year->promoted->Visible) { // promoted ?>
	<?php if ($grade_year->SortUrl($grade_year->promoted) == "") { ?>
		<td><?php echo $grade_year->promoted->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grade_year->SortUrl($grade_year->promoted) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grade_year->promoted->FldCaption() ?></td><td style="width: 10px;"><?php if ($grade_year->promoted->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grade_year->promoted->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grade_year->programme->Visible) { // programme ?>
	<?php if ($grade_year->SortUrl($grade_year->programme) == "") { ?>
		<td><?php echo $grade_year->programme->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grade_year->SortUrl($grade_year->programme) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grade_year->programme->FldCaption() ?></td><td style="width: 10px;"><?php if ($grade_year->programme->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grade_year->programme->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$grade_year_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($grade_year->ExportAll && $grade_year->Export <> "") {
	$grade_year_list->lStopRec = $grade_year_list->lTotalRecs;
} else {
	$grade_year_list->lStopRec = $grade_year_list->lStartRec + $grade_year_list->lDisplayRecs - 1; // Set the last record to display
}
$grade_year_list->lRecCount = $grade_year_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $grade_year_list->lStartRec > 1)
		$rs->Move($grade_year_list->lStartRec - 1);
}

// Initialize aggregate
$grade_year->RowType = EW_ROWTYPE_AGGREGATEINIT;
$grade_year_list->RenderRow();
$grade_year_list->lRowCnt = 0;
while (($grade_year->CurrentAction == "gridadd" || !$rs->EOF) &&
	$grade_year_list->lRecCount < $grade_year_list->lStopRec) {
	$grade_year_list->lRecCount++;
	if (intval($grade_year_list->lRecCount) >= intval($grade_year_list->lStartRec)) {
		$grade_year_list->lRowCnt++;

	// Init row class and style
	$grade_year->CssClass = "";
	$grade_year->CssStyle = "";
	$grade_year->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($grade_year->CurrentAction == "gridadd") {
		$grade_year_list->LoadDefaultValues(); // Load default values
	} else {
		$grade_year_list->LoadRowValues($rs); // Load row values
	}
	$grade_year->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$grade_year_list->RenderRow();

	// Render list options
	$grade_year_list->RenderListOptions();
?>
	<tr<?php echo $grade_year->RowAttributes() ?>>
<?php

// Render list options (body, left)
$grade_year_list->ListOptions->Render("body", "left");
?>
	<?php if ($grade_year->class->Visible) { // class ?>
		<td<?php echo $grade_year->class->CellAttributes() ?>>
<div<?php echo $grade_year->class->ViewAttributes() ?>><?php echo $grade_year->class->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($grade_year->year->Visible) { // year ?>
		<td<?php echo $grade_year->year->CellAttributes() ?>>
<div<?php echo $grade_year->year->ViewAttributes() ?>><?php echo $grade_year->year->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($grade_year->promoted->Visible) { // promoted ?>
		<td<?php echo $grade_year->promoted->CellAttributes() ?>>
<div<?php echo $grade_year->promoted->ViewAttributes() ?>><?php echo $grade_year->promoted->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($grade_year->programme->Visible) { // programme ?>
		<td<?php echo $grade_year->programme->CellAttributes() ?>>
<div<?php echo $grade_year->programme->ViewAttributes() ?>><?php echo $grade_year->programme->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$grade_year_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($grade_year->CurrentAction <> "gridadd")
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
<?php if ($grade_year->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($grade_year->CurrentAction <> "gridadd" && $grade_year->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($grade_year_list->Pager)) $grade_year_list->Pager = new cPrevNextPager($grade_year_list->lStartRec, $grade_year_list->lDisplayRecs, $grade_year_list->lTotalRecs) ?>
<?php if ($grade_year_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($grade_year_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $grade_year_list->PageUrl() ?>start=<?php echo $grade_year_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($grade_year_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $grade_year_list->PageUrl() ?>start=<?php echo $grade_year_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $grade_year_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($grade_year_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $grade_year_list->PageUrl() ?>start=<?php echo $grade_year_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($grade_year_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $grade_year_list->PageUrl() ?>start=<?php echo $grade_year_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $grade_year_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $grade_year_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $grade_year_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $grade_year_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($grade_year_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($grade_year_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $grade_year_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($grade_year->Export == "" && $grade_year->CurrentAction == "") { ?>
<?php } ?>
<?php if ($grade_year->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$grade_year_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrade_year_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'grade_year';

	// Page object name
	var $PageObjName = 'grade_year_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grade_year;
		if ($grade_year->UseTokenInUrl) $PageUrl .= "t=" . $grade_year->TableVar . "&"; // Add page token
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
		global $objForm, $grade_year;
		if ($grade_year->UseTokenInUrl) {
			if ($objForm)
				return ($grade_year->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grade_year->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrade_year_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (grade_year)
		$GLOBALS["grade_year"] = new cgrade_year();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["grade_year"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "grade_yeardelete.php";
		$this->MultiUpdateUrl = "grade_yearupdate.php";

		// Table object (sponsored_student)
		$GLOBALS['sponsored_student'] = new csponsored_student();

		// Table object (school_attendance)
		$GLOBALS['school_attendance'] = new cschool_attendance();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grade_year', TRUE);

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
		global $grade_year;

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
			$grade_year->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$grade_year->Export = $_POST["exporttype"];
		} else {
			$grade_year->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $grade_year->Export; // Get export parameter, used in header
		$gsExportFile = $grade_year->TableVar; // Get export file, used in header
		if ($grade_year->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($grade_year->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $grade_year;

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
			$grade_year->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($grade_year->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $grade_year->getRecordsPerPage(); // Restore from Session
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
		$grade_year->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$grade_year->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$grade_year->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $grade_year->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $grade_year->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $grade_year->getDetailFilter(); // Restore detail filter

		// Add master User ID filter
		if ($Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			if ($grade_year->getCurrentMasterTable() == "school_attendance")
				$this->sDbMasterFilter = $grade_year->AddMasterUserIDFilter($this->sDbMasterFilter, "school_attendance"); // Add master User ID filter
		}
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($grade_year->getMasterFilter() <> "" && $grade_year->getCurrentMasterTable() == "school_attendance") {
			global $school_attendance;
			$rsmaster = $school_attendance->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$grade_year->setMasterFilter(""); // Clear master filter
				$grade_year->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($grade_year->getReturnUrl()); // Return to caller
			} else {
				$school_attendance->LoadListRowValues($rsmaster);
				$school_attendance->RowType = EW_ROWTYPE_MASTER; // Master row
				$school_attendance->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$grade_year->setSessionWhere($sFilter);
		$grade_year->CurrentFilter = "";

		// Export data only
		if (in_array($grade_year->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($grade_year->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $grade_year;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $grade_year->class, FALSE); // class
		$this->BuildSearchSql($sWhere, $grade_year->year, FALSE); // year
		$this->BuildSearchSql($sWhere, $grade_year->promoted, FALSE); // promoted
		$this->BuildSearchSql($sWhere, $grade_year->programme, FALSE); // programme
		$this->BuildSearchSql($sWhere, $grade_year->school_attendance_school_attendance_id, FALSE); // school_attendance_school_attendance_id

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($grade_year->class); // class
			$this->SetSearchParm($grade_year->year); // year
			$this->SetSearchParm($grade_year->promoted); // promoted
			$this->SetSearchParm($grade_year->programme); // programme
			$this->SetSearchParm($grade_year->school_attendance_school_attendance_id); // school_attendance_school_attendance_id
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
		global $grade_year;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$grade_year->setAdvancedSearch("x_$FldParm", $FldVal);
		$grade_year->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$grade_year->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$grade_year->setAdvancedSearch("y_$FldParm", $FldVal2);
		$grade_year->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $grade_year;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $grade_year->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $grade_year->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $grade_year->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $grade_year->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $grade_year->GetAdvancedSearch("w_$FldParm");
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
		global $grade_year;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$grade_year->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $grade_year;
		$grade_year->setAdvancedSearch("x_class", "");
		$grade_year->setAdvancedSearch("x_year", "");
		$grade_year->setAdvancedSearch("x_promoted", "");
		$grade_year->setAdvancedSearch("x_programme", "");
		$grade_year->setAdvancedSearch("x_school_attendance_school_attendance_id", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $grade_year;
		$bRestore = TRUE;
		if (@$_GET["x_class"] <> "") $bRestore = FALSE;
		if (@$_GET["x_year"] <> "") $bRestore = FALSE;
		if (@$_GET["x_promoted"] <> "") $bRestore = FALSE;
		if (@$_GET["x_programme"] <> "") $bRestore = FALSE;
		if (@$_GET["x_school_attendance_school_attendance_id"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($grade_year->class);
			$this->GetSearchParm($grade_year->year);
			$this->GetSearchParm($grade_year->promoted);
			$this->GetSearchParm($grade_year->programme);
			$this->GetSearchParm($grade_year->school_attendance_school_attendance_id);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $grade_year;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$grade_year->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$grade_year->CurrentOrderType = @$_GET["ordertype"];
			$grade_year->UpdateSort($grade_year->class); // class
			$grade_year->UpdateSort($grade_year->year); // year
			$grade_year->UpdateSort($grade_year->promoted); // promoted
			$grade_year->UpdateSort($grade_year->programme); // programme
			$grade_year->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $grade_year;
		$sOrderBy = $grade_year->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($grade_year->SqlOrderBy() <> "") {
				$sOrderBy = $grade_year->SqlOrderBy();
				$grade_year->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $grade_year;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$grade_year->getCurrentMasterTable = ""; // Clear master table
				$grade_year->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$grade_year->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$grade_year->school_attendance_school_attendance_id->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$grade_year->setSessionOrderBy($sOrderBy);
				$grade_year->class->setSort("");
				$grade_year->year->setSort("");
				$grade_year->promoted->setSort("");
				$grade_year->programme->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$grade_year->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $grade_year;

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

		// "detail_grade_subject"
		$this->ListOptions->Add("detail_grade_subject");
		$item =& $this->ListOptions->Items["detail_grade_subject"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('grade_subject');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($grade_year->Export <> "" ||
			$grade_year->CurrentAction == "gridadd" ||
			$grade_year->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $grade_year;
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

		// "detail_grade_subject"
		$oListOpt =& $this->ListOptions->Items["detail_grade_subject"];
		if ($Security->AllowList('grade_subject')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("grade_subject", "TblCaption");
			$oListOpt->Body = "<a href=\"grade_subjectlist.php?" . EW_TABLE_SHOW_MASTER . "=grade_year&grade_year_id=" . urlencode(strval($grade_year->grade_year_id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $grade_year;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $grade_year;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$grade_year->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$grade_year->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $grade_year->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$grade_year->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$grade_year->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$grade_year->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $grade_year;

		// Load search values
		// class

		$grade_year->class->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_class"]);
		$grade_year->class->AdvancedSearch->SearchOperator = @$_GET["z_class"];

		// year
		$grade_year->year->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_year"]);
		$grade_year->year->AdvancedSearch->SearchOperator = @$_GET["z_year"];

		// promoted
		$grade_year->promoted->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_promoted"]);
		$grade_year->promoted->AdvancedSearch->SearchOperator = @$_GET["z_promoted"];

		// programme
		$grade_year->programme->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programme"]);
		$grade_year->programme->AdvancedSearch->SearchOperator = @$_GET["z_programme"];

		// school_attendance_school_attendance_id
		$grade_year->school_attendance_school_attendance_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_school_attendance_school_attendance_id"]);
		$grade_year->school_attendance_school_attendance_id->AdvancedSearch->SearchOperator = @$_GET["z_school_attendance_school_attendance_id"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $grade_year;

		// Call Recordset Selecting event
		$grade_year->Recordset_Selecting($grade_year->CurrentFilter);

		// Load List page SQL
		$sSql = $grade_year->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$grade_year->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $grade_year;
		$sFilter = $grade_year->KeyFilter();

		// Call Row Selecting event
		$grade_year->Row_Selecting($sFilter);

		// Load SQL based on filter
		$grade_year->CurrentFilter = $sFilter;
		$sSql = $grade_year->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$grade_year->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $grade_year;
		$grade_year->grade_year_id->setDbValue($rs->fields('grade_year_id'));
		$grade_year->class->setDbValue($rs->fields('class'));
		$grade_year->year->setDbValue($rs->fields('year'));
		$grade_year->promoted->setDbValue($rs->fields('promoted'));
		$grade_year->programme->setDbValue($rs->fields('programme'));
		$grade_year->school_attendance_school_attendance_id->setDbValue($rs->fields('school_attendance_school_attendance_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grade_year;

		// Initialize URLs
		$this->ViewUrl = $grade_year->ViewUrl();
		$this->EditUrl = $grade_year->EditUrl();
		$this->InlineEditUrl = $grade_year->InlineEditUrl();
		$this->CopyUrl = $grade_year->CopyUrl();
		$this->InlineCopyUrl = $grade_year->InlineCopyUrl();
		$this->DeleteUrl = $grade_year->DeleteUrl();

		// Call Row_Rendering event
		$grade_year->Row_Rendering();

		// Common render codes for all row types
		// class

		$grade_year->class->CellCssStyle = ""; $grade_year->class->CellCssClass = "";
		$grade_year->class->CellAttrs = array(); $grade_year->class->ViewAttrs = array(); $grade_year->class->EditAttrs = array();

		// year
		$grade_year->year->CellCssStyle = ""; $grade_year->year->CellCssClass = "";
		$grade_year->year->CellAttrs = array(); $grade_year->year->ViewAttrs = array(); $grade_year->year->EditAttrs = array();

		// promoted
		$grade_year->promoted->CellCssStyle = ""; $grade_year->promoted->CellCssClass = "";
		$grade_year->promoted->CellAttrs = array(); $grade_year->promoted->ViewAttrs = array(); $grade_year->promoted->EditAttrs = array();

		// programme
		$grade_year->programme->CellCssStyle = ""; $grade_year->programme->CellCssClass = "";
		$grade_year->programme->CellAttrs = array(); $grade_year->programme->ViewAttrs = array(); $grade_year->programme->EditAttrs = array();
		if ($grade_year->RowType == EW_ROWTYPE_VIEW) { // View row

			// grade_year_id
			$grade_year->grade_year_id->ViewValue = $grade_year->grade_year_id->CurrentValue;
			$grade_year->grade_year_id->CssStyle = "";
			$grade_year->grade_year_id->CssClass = "";
			$grade_year->grade_year_id->ViewCustomAttributes = "";

			// class
			$grade_year->class->ViewValue = $grade_year->class->CurrentValue;
			$grade_year->class->CssStyle = "";
			$grade_year->class->CssClass = "";
			$grade_year->class->ViewCustomAttributes = "";

			// year
			$grade_year->year->ViewValue = $grade_year->year->CurrentValue;
			$grade_year->year->CssStyle = "";
			$grade_year->year->CssClass = "";
			$grade_year->year->ViewCustomAttributes = "";

			// promoted
			if (strval($grade_year->promoted->CurrentValue) <> "") {
				switch ($grade_year->promoted->CurrentValue) {
					case "1":
						$grade_year->promoted->ViewValue = "Yes";
						break;
					case "0":
						$grade_year->promoted->ViewValue = "No";
						break;
					default:
						$grade_year->promoted->ViewValue = $grade_year->promoted->CurrentValue;
				}
			} else {
				$grade_year->promoted->ViewValue = NULL;
			}
			$grade_year->promoted->CssStyle = "";
			$grade_year->promoted->CssClass = "";
			$grade_year->promoted->ViewCustomAttributes = "";

			// programme
			$grade_year->programme->ViewValue = $grade_year->programme->CurrentValue;
			$grade_year->programme->CssStyle = "";
			$grade_year->programme->CssClass = "";
			$grade_year->programme->ViewCustomAttributes = "";

			// school_attendance_school_attendance_id
			$grade_year->school_attendance_school_attendance_id->ViewValue = $grade_year->school_attendance_school_attendance_id->CurrentValue;
			$grade_year->school_attendance_school_attendance_id->CssStyle = "";
			$grade_year->school_attendance_school_attendance_id->CssClass = "";
			$grade_year->school_attendance_school_attendance_id->ViewCustomAttributes = "";

			// class
			$grade_year->class->HrefValue = "";
			$grade_year->class->TooltipValue = "";

			// year
			$grade_year->year->HrefValue = "";
			$grade_year->year->TooltipValue = "";

			// promoted
			$grade_year->promoted->HrefValue = "";
			$grade_year->promoted->TooltipValue = "";

			// programme
			$grade_year->programme->HrefValue = "";
			$grade_year->programme->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($grade_year->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grade_year->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $grade_year;

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
		global $grade_year;
		$grade_year->class->AdvancedSearch->SearchValue = $grade_year->getAdvancedSearch("x_class");
		$grade_year->year->AdvancedSearch->SearchValue = $grade_year->getAdvancedSearch("x_year");
		$grade_year->promoted->AdvancedSearch->SearchValue = $grade_year->getAdvancedSearch("x_promoted");
		$grade_year->programme->AdvancedSearch->SearchValue = $grade_year->getAdvancedSearch("x_programme");
		$grade_year->school_attendance_school_attendance_id->AdvancedSearch->SearchValue = $grade_year->getAdvancedSearch("x_school_attendance_school_attendance_id");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $grade_year;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $grade_year->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($grade_year->ExportAll) {
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
		if ($grade_year->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($grade_year, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($grade_year->grade_year_id);
				$ExportDoc->ExportCaption($grade_year->class);
				$ExportDoc->ExportCaption($grade_year->year);
				$ExportDoc->ExportCaption($grade_year->promoted);
				$ExportDoc->ExportCaption($grade_year->programme);
				$ExportDoc->ExportCaption($grade_year->school_attendance_school_attendance_id);
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
				$grade_year->CssClass = "";
				$grade_year->CssStyle = "";
				$grade_year->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($grade_year->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('grade_year_id', $grade_year->grade_year_id->ExportValue($grade_year->Export, $grade_year->ExportOriginalValue));
					$XmlDoc->AddField('class', $grade_year->class->ExportValue($grade_year->Export, $grade_year->ExportOriginalValue));
					$XmlDoc->AddField('year', $grade_year->year->ExportValue($grade_year->Export, $grade_year->ExportOriginalValue));
					$XmlDoc->AddField('promoted', $grade_year->promoted->ExportValue($grade_year->Export, $grade_year->ExportOriginalValue));
					$XmlDoc->AddField('programme', $grade_year->programme->ExportValue($grade_year->Export, $grade_year->ExportOriginalValue));
					$XmlDoc->AddField('school_attendance_school_attendance_id', $grade_year->school_attendance_school_attendance_id->ExportValue($grade_year->Export, $grade_year->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($grade_year->grade_year_id);
					$ExportDoc->ExportField($grade_year->class);
					$ExportDoc->ExportField($grade_year->year);
					$ExportDoc->ExportField($grade_year->promoted);
					$ExportDoc->ExportField($grade_year->programme);
					$ExportDoc->ExportField($grade_year->school_attendance_school_attendance_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($grade_year->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($grade_year->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($grade_year->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($grade_year->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($grade_year->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $grade_year;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "school_attendance") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $grade_year->SqlMasterFilter_school_attendance();
				$this->sDbDetailFilter = $grade_year->SqlDetailFilter_school_attendance();
				if (@$_GET["school_attendance_id"] <> "") {
					$GLOBALS["school_attendance"]->school_attendance_id->setQueryStringValue($_GET["school_attendance_id"]);
					$grade_year->school_attendance_school_attendance_id->setQueryStringValue($GLOBALS["school_attendance"]->school_attendance_id->QueryStringValue);
					$grade_year->school_attendance_school_attendance_id->setSessionValue($grade_year->school_attendance_school_attendance_id->QueryStringValue);
					if (!is_numeric($GLOBALS["school_attendance"]->school_attendance_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@school_attendance_id@", ew_AdjustSql($GLOBALS["school_attendance"]->school_attendance_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@school_attendance_school_attendance_id@", ew_AdjustSql($GLOBALS["school_attendance"]->school_attendance_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$grade_year->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$grade_year->setStartRecordNumber($this->lStartRec);
			$grade_year->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$grade_year->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "school_attendance") {
				if ($grade_year->school_attendance_school_attendance_id->QueryStringValue == "") $grade_year->school_attendance_school_attendance_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $grade_year->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $grade_year->getDetailFilter(); // Restore detail filter
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
