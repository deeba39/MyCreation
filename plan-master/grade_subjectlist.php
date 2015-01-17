<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "grade_subjectinfo.php" ?>
<?php include "sponsored_studentinfo.php" ?>
<?php include "grade_yearinfo.php" ?>
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
$grade_subject_list = new cgrade_subject_list();
$Page =& $grade_subject_list;

// Page init
$grade_subject_list->Page_Init();

// Page main
$grade_subject_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($grade_subject->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var grade_subject_list = new ew_Page("grade_subject_list");

// page properties
grade_subject_list.PageID = "list"; // page ID
grade_subject_list.FormID = "fgrade_subjectlist"; // form ID
var EW_PAGE_ID = grade_subject_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
grade_subject_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grade_subject_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grade_subject_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($grade_subject->Export == "") { ?>
<?php
$gsMasterReturnUrl = "grade_yearlist.php";
if ($grade_subject_list->sDbMasterFilter <> "" && $grade_subject->getCurrentMasterTable() == "grade_year") {
	if ($grade_subject_list->bMasterRecordExists) {
		if ($grade_subject->getCurrentMasterTable() == $grade_subject->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "grade_yearmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$grade_subject_list->lTotalRecs = $grade_subject->SelectRecordCount();
	} else {
		if ($rs = $grade_subject_list->LoadRecordset())
			$grade_subject_list->lTotalRecs = $rs->RecordCount();
	}
	$grade_subject_list->lStartRec = 1;
	if ($grade_subject_list->lDisplayRecs <= 0 || ($grade_subject->Export <> "" && $grade_subject->ExportAll)) // Display all records
		$grade_subject_list->lDisplayRecs = $grade_subject_list->lTotalRecs;
	if (!($grade_subject->Export <> "" && $grade_subject->ExportAll))
		$grade_subject_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $grade_subject_list->LoadRecordset($grade_subject_list->lStartRec-1, $grade_subject_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grade_subject->TableCaption() ?>
<?php if ($grade_subject->Export == "" && $grade_subject->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $grade_subject_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $grade_subject_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $grade_subject_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($grade_subject->Export == "" && $grade_subject->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(grade_subject_list);" style="text-decoration: none;"><img id="grade_subject_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="grade_subject_list_SearchPanel">
<form name="fgrade_subjectlistsrch" id="fgrade_subjectlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="grade_subject">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $grade_subject_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="grade_subjectsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
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
$grade_subject_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fgrade_subjectlist" id="fgrade_subjectlist" class="ewForm" action="" method="post">
<div id="gmp_grade_subject" class="ewGridMiddlePanel">
<?php if ($grade_subject_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $grade_subject->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$grade_subject_list->RenderListOptions();

// Render list options (header, left)
$grade_subject_list->ListOptions->Render("header", "left");
?>
<?php if ($grade_subject->subject->Visible) { // subject ?>
	<?php if ($grade_subject->SortUrl($grade_subject->subject) == "") { ?>
		<td><?php echo $grade_subject->subject->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grade_subject->SortUrl($grade_subject->subject) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grade_subject->subject->FldCaption() ?></td><td style="width: 10px;"><?php if ($grade_subject->subject->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grade_subject->subject->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grade_subject->raw_score->Visible) { // raw_score ?>
	<?php if ($grade_subject->SortUrl($grade_subject->raw_score) == "") { ?>
		<td><?php echo $grade_subject->raw_score->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grade_subject->SortUrl($grade_subject->raw_score) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grade_subject->raw_score->FldCaption() ?></td><td style="width: 10px;"><?php if ($grade_subject->raw_score->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grade_subject->raw_score->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grade_subject->letter_score->Visible) { // letter_score ?>
	<?php if ($grade_subject->SortUrl($grade_subject->letter_score) == "") { ?>
		<td><?php echo $grade_subject->letter_score->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grade_subject->SortUrl($grade_subject->letter_score) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grade_subject->letter_score->FldCaption() ?></td><td style="width: 10px;"><?php if ($grade_subject->letter_score->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grade_subject->letter_score->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grade_subject->letter_description->Visible) { // letter_description ?>
	<?php if ($grade_subject->SortUrl($grade_subject->letter_description) == "") { ?>
		<td><?php echo $grade_subject->letter_description->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grade_subject->SortUrl($grade_subject->letter_description) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grade_subject->letter_description->FldCaption() ?></td><td style="width: 10px;"><?php if ($grade_subject->letter_description->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grade_subject->letter_description->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grade_subject->grade_year_grade_year_id->Visible) { // grade_year_grade_year_id ?>
	<?php if ($grade_subject->SortUrl($grade_subject->grade_year_grade_year_id) == "") { ?>
		<td><?php echo $grade_subject->grade_year_grade_year_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grade_subject->SortUrl($grade_subject->grade_year_grade_year_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grade_subject->grade_year_grade_year_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($grade_subject->grade_year_grade_year_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grade_subject->grade_year_grade_year_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$grade_subject_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($grade_subject->ExportAll && $grade_subject->Export <> "") {
	$grade_subject_list->lStopRec = $grade_subject_list->lTotalRecs;
} else {
	$grade_subject_list->lStopRec = $grade_subject_list->lStartRec + $grade_subject_list->lDisplayRecs - 1; // Set the last record to display
}
$grade_subject_list->lRecCount = $grade_subject_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $grade_subject_list->lStartRec > 1)
		$rs->Move($grade_subject_list->lStartRec - 1);
}

// Initialize aggregate
$grade_subject->RowType = EW_ROWTYPE_AGGREGATEINIT;
$grade_subject_list->RenderRow();
$grade_subject_list->lRowCnt = 0;
while (($grade_subject->CurrentAction == "gridadd" || !$rs->EOF) &&
	$grade_subject_list->lRecCount < $grade_subject_list->lStopRec) {
	$grade_subject_list->lRecCount++;
	if (intval($grade_subject_list->lRecCount) >= intval($grade_subject_list->lStartRec)) {
		$grade_subject_list->lRowCnt++;

	// Init row class and style
	$grade_subject->CssClass = "";
	$grade_subject->CssStyle = "";
	$grade_subject->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($grade_subject->CurrentAction == "gridadd") {
		$grade_subject_list->LoadDefaultValues(); // Load default values
	} else {
		$grade_subject_list->LoadRowValues($rs); // Load row values
	}
	$grade_subject->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$grade_subject_list->RenderRow();

	// Render list options
	$grade_subject_list->RenderListOptions();
?>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
<?php

// Render list options (body, left)
$grade_subject_list->ListOptions->Render("body", "left");
?>
	<?php if ($grade_subject->subject->Visible) { // subject ?>
		<td<?php echo $grade_subject->subject->CellAttributes() ?>>
<div<?php echo $grade_subject->subject->ViewAttributes() ?>><?php echo $grade_subject->subject->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($grade_subject->raw_score->Visible) { // raw_score ?>
		<td<?php echo $grade_subject->raw_score->CellAttributes() ?>>
<div<?php echo $grade_subject->raw_score->ViewAttributes() ?>><?php echo $grade_subject->raw_score->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($grade_subject->letter_score->Visible) { // letter_score ?>
		<td<?php echo $grade_subject->letter_score->CellAttributes() ?>>
<div<?php echo $grade_subject->letter_score->ViewAttributes() ?>><?php echo $grade_subject->letter_score->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($grade_subject->letter_description->Visible) { // letter_description ?>
		<td<?php echo $grade_subject->letter_description->CellAttributes() ?>>
<div<?php echo $grade_subject->letter_description->ViewAttributes() ?>><?php echo $grade_subject->letter_description->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($grade_subject->grade_year_grade_year_id->Visible) { // grade_year_grade_year_id ?>
		<td<?php echo $grade_subject->grade_year_grade_year_id->CellAttributes() ?>>
<div<?php echo $grade_subject->grade_year_grade_year_id->ViewAttributes() ?>><?php echo $grade_subject->grade_year_grade_year_id->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$grade_subject_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($grade_subject->CurrentAction <> "gridadd")
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
<?php if ($grade_subject->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($grade_subject->CurrentAction <> "gridadd" && $grade_subject->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($grade_subject_list->Pager)) $grade_subject_list->Pager = new cPrevNextPager($grade_subject_list->lStartRec, $grade_subject_list->lDisplayRecs, $grade_subject_list->lTotalRecs) ?>
<?php if ($grade_subject_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($grade_subject_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $grade_subject_list->PageUrl() ?>start=<?php echo $grade_subject_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($grade_subject_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $grade_subject_list->PageUrl() ?>start=<?php echo $grade_subject_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $grade_subject_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($grade_subject_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $grade_subject_list->PageUrl() ?>start=<?php echo $grade_subject_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($grade_subject_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $grade_subject_list->PageUrl() ?>start=<?php echo $grade_subject_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $grade_subject_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $grade_subject_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $grade_subject_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $grade_subject_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($grade_subject_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($grade_subject_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $grade_subject_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($grade_subject->Export == "" && $grade_subject->CurrentAction == "") { ?>
<?php } ?>
<?php if ($grade_subject->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$grade_subject_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrade_subject_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'grade_subject';

	// Page object name
	var $PageObjName = 'grade_subject_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grade_subject;
		if ($grade_subject->UseTokenInUrl) $PageUrl .= "t=" . $grade_subject->TableVar . "&"; // Add page token
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
		global $objForm, $grade_subject;
		if ($grade_subject->UseTokenInUrl) {
			if ($objForm)
				return ($grade_subject->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grade_subject->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrade_subject_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (grade_subject)
		$GLOBALS["grade_subject"] = new cgrade_subject();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["grade_subject"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "grade_subjectdelete.php";
		$this->MultiUpdateUrl = "grade_subjectupdate.php";

		// Table object (sponsored_student)
		$GLOBALS['sponsored_student'] = new csponsored_student();

		// Table object (grade_year)
		$GLOBALS['grade_year'] = new cgrade_year();

		// Table object (school_attendance)
		$GLOBALS['school_attendance'] = new cschool_attendance();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grade_subject', TRUE);

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
		global $grade_subject;

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
			$grade_subject->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$grade_subject->Export = $_POST["exporttype"];
		} else {
			$grade_subject->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $grade_subject->Export; // Get export parameter, used in header
		$gsExportFile = $grade_subject->TableVar; // Get export file, used in header
		if ($grade_subject->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($grade_subject->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $grade_subject;

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
			$grade_subject->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($grade_subject->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $grade_subject->getRecordsPerPage(); // Restore from Session
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
		$grade_subject->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$grade_subject->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$grade_subject->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $grade_subject->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $grade_subject->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $grade_subject->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($grade_subject->getMasterFilter() <> "" && $grade_subject->getCurrentMasterTable() == "grade_year") {
			global $grade_year;
			$rsmaster = $grade_year->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$grade_subject->setMasterFilter(""); // Clear master filter
				$grade_subject->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($grade_subject->getReturnUrl()); // Return to caller
			} else {
				$grade_year->LoadListRowValues($rsmaster);
				$grade_year->RowType = EW_ROWTYPE_MASTER; // Master row
				$grade_year->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$grade_subject->setSessionWhere($sFilter);
		$grade_subject->CurrentFilter = "";

		// Export data only
		if (in_array($grade_subject->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($grade_subject->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $grade_subject;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $grade_subject->grade_subject_id, FALSE); // grade_subject_id
		$this->BuildSearchSql($sWhere, $grade_subject->subject, FALSE); // subject
		$this->BuildSearchSql($sWhere, $grade_subject->raw_score, FALSE); // raw_score
		$this->BuildSearchSql($sWhere, $grade_subject->letter_score, FALSE); // letter_score
		$this->BuildSearchSql($sWhere, $grade_subject->letter_description, FALSE); // letter_description
		$this->BuildSearchSql($sWhere, $grade_subject->grade_year_grade_year_id, FALSE); // grade_year_grade_year_id

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($grade_subject->grade_subject_id); // grade_subject_id
			$this->SetSearchParm($grade_subject->subject); // subject
			$this->SetSearchParm($grade_subject->raw_score); // raw_score
			$this->SetSearchParm($grade_subject->letter_score); // letter_score
			$this->SetSearchParm($grade_subject->letter_description); // letter_description
			$this->SetSearchParm($grade_subject->grade_year_grade_year_id); // grade_year_grade_year_id
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
		global $grade_subject;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$grade_subject->setAdvancedSearch("x_$FldParm", $FldVal);
		$grade_subject->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$grade_subject->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$grade_subject->setAdvancedSearch("y_$FldParm", $FldVal2);
		$grade_subject->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $grade_subject;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $grade_subject->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $grade_subject->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $grade_subject->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $grade_subject->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $grade_subject->GetAdvancedSearch("w_$FldParm");
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
		global $grade_subject;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$grade_subject->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $grade_subject;
		$grade_subject->setAdvancedSearch("x_grade_subject_id", "");
		$grade_subject->setAdvancedSearch("x_subject", "");
		$grade_subject->setAdvancedSearch("x_raw_score", "");
		$grade_subject->setAdvancedSearch("z_raw_score", "");
		$grade_subject->setAdvancedSearch("v_raw_score", "AND");
		$grade_subject->setAdvancedSearch("y_raw_score", "");
		$grade_subject->setAdvancedSearch("w_raw_score", "");
		$grade_subject->setAdvancedSearch("x_letter_score", "");
		$grade_subject->setAdvancedSearch("x_letter_description", "");
		$grade_subject->setAdvancedSearch("x_grade_year_grade_year_id", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $grade_subject;
		$bRestore = TRUE;
		if (@$_GET["x_grade_subject_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_subject"] <> "") $bRestore = FALSE;
		if (@$_GET["x_raw_score"] <> "") $bRestore = FALSE;
		if (@$_GET["y_raw_score"] <> "") $bRestore = FALSE;
		if (@$_GET["x_letter_score"] <> "") $bRestore = FALSE;
		if (@$_GET["x_letter_description"] <> "") $bRestore = FALSE;
		if (@$_GET["x_grade_year_grade_year_id"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($grade_subject->grade_subject_id);
			$this->GetSearchParm($grade_subject->subject);
			$this->GetSearchParm($grade_subject->raw_score);
			$this->GetSearchParm($grade_subject->letter_score);
			$this->GetSearchParm($grade_subject->letter_description);
			$this->GetSearchParm($grade_subject->grade_year_grade_year_id);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $grade_subject;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$grade_subject->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$grade_subject->CurrentOrderType = @$_GET["ordertype"];
			$grade_subject->UpdateSort($grade_subject->subject); // subject
			$grade_subject->UpdateSort($grade_subject->raw_score); // raw_score
			$grade_subject->UpdateSort($grade_subject->letter_score); // letter_score
			$grade_subject->UpdateSort($grade_subject->letter_description); // letter_description
			$grade_subject->UpdateSort($grade_subject->grade_year_grade_year_id); // grade_year_grade_year_id
			$grade_subject->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $grade_subject;
		$sOrderBy = $grade_subject->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($grade_subject->SqlOrderBy() <> "") {
				$sOrderBy = $grade_subject->SqlOrderBy();
				$grade_subject->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $grade_subject;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$grade_subject->getCurrentMasterTable = ""; // Clear master table
				$grade_subject->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$grade_subject->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$grade_subject->grade_year_grade_year_id->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$grade_subject->setSessionOrderBy($sOrderBy);
				$grade_subject->subject->setSort("");
				$grade_subject->raw_score->setSort("");
				$grade_subject->letter_score->setSort("");
				$grade_subject->letter_description->setSort("");
				$grade_subject->grade_year_grade_year_id->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$grade_subject->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $grade_subject;

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
		if ($grade_subject->Export <> "" ||
			$grade_subject->CurrentAction == "gridadd" ||
			$grade_subject->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $grade_subject;
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
		global $Security, $Language, $grade_subject;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $grade_subject;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$grade_subject->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$grade_subject->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $grade_subject->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$grade_subject->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$grade_subject->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$grade_subject->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $grade_subject;

		// Load search values
		// grade_subject_id

		$grade_subject->grade_subject_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_grade_subject_id"]);
		$grade_subject->grade_subject_id->AdvancedSearch->SearchOperator = @$_GET["z_grade_subject_id"];

		// subject
		$grade_subject->subject->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_subject"]);
		$grade_subject->subject->AdvancedSearch->SearchOperator = @$_GET["z_subject"];

		// raw_score
		$grade_subject->raw_score->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_raw_score"]);
		$grade_subject->raw_score->AdvancedSearch->SearchOperator = @$_GET["z_raw_score"];
		$grade_subject->raw_score->AdvancedSearch->SearchCondition = @$_GET["v_raw_score"];
		$grade_subject->raw_score->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_raw_score"]);
		$grade_subject->raw_score->AdvancedSearch->SearchOperator2 = @$_GET["w_raw_score"];

		// letter_score
		$grade_subject->letter_score->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_letter_score"]);
		$grade_subject->letter_score->AdvancedSearch->SearchOperator = @$_GET["z_letter_score"];

		// letter_description
		$grade_subject->letter_description->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_letter_description"]);
		$grade_subject->letter_description->AdvancedSearch->SearchOperator = @$_GET["z_letter_description"];

		// grade_year_grade_year_id
		$grade_subject->grade_year_grade_year_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_grade_year_grade_year_id"]);
		$grade_subject->grade_year_grade_year_id->AdvancedSearch->SearchOperator = @$_GET["z_grade_year_grade_year_id"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $grade_subject;

		// Call Recordset Selecting event
		$grade_subject->Recordset_Selecting($grade_subject->CurrentFilter);

		// Load List page SQL
		$sSql = $grade_subject->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$grade_subject->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $grade_subject;
		$sFilter = $grade_subject->KeyFilter();

		// Call Row Selecting event
		$grade_subject->Row_Selecting($sFilter);

		// Load SQL based on filter
		$grade_subject->CurrentFilter = $sFilter;
		$sSql = $grade_subject->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$grade_subject->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $grade_subject;
		$grade_subject->grade_subject_id->setDbValue($rs->fields('grade_subject_id'));
		$grade_subject->subject->setDbValue($rs->fields('subject'));
		$grade_subject->raw_score->setDbValue($rs->fields('raw_score'));
		$grade_subject->letter_score->setDbValue($rs->fields('letter_score'));
		$grade_subject->letter_description->setDbValue($rs->fields('letter_description'));
		$grade_subject->grade_year_grade_year_id->setDbValue($rs->fields('grade_year_grade_year_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grade_subject;

		// Initialize URLs
		$this->ViewUrl = $grade_subject->ViewUrl();
		$this->EditUrl = $grade_subject->EditUrl();
		$this->InlineEditUrl = $grade_subject->InlineEditUrl();
		$this->CopyUrl = $grade_subject->CopyUrl();
		$this->InlineCopyUrl = $grade_subject->InlineCopyUrl();
		$this->DeleteUrl = $grade_subject->DeleteUrl();

		// Call Row_Rendering event
		$grade_subject->Row_Rendering();

		// Common render codes for all row types
		// subject

		$grade_subject->subject->CellCssStyle = ""; $grade_subject->subject->CellCssClass = "";
		$grade_subject->subject->CellAttrs = array(); $grade_subject->subject->ViewAttrs = array(); $grade_subject->subject->EditAttrs = array();

		// raw_score
		$grade_subject->raw_score->CellCssStyle = ""; $grade_subject->raw_score->CellCssClass = "";
		$grade_subject->raw_score->CellAttrs = array(); $grade_subject->raw_score->ViewAttrs = array(); $grade_subject->raw_score->EditAttrs = array();

		// letter_score
		$grade_subject->letter_score->CellCssStyle = ""; $grade_subject->letter_score->CellCssClass = "";
		$grade_subject->letter_score->CellAttrs = array(); $grade_subject->letter_score->ViewAttrs = array(); $grade_subject->letter_score->EditAttrs = array();

		// letter_description
		$grade_subject->letter_description->CellCssStyle = ""; $grade_subject->letter_description->CellCssClass = "";
		$grade_subject->letter_description->CellAttrs = array(); $grade_subject->letter_description->ViewAttrs = array(); $grade_subject->letter_description->EditAttrs = array();

		// grade_year_grade_year_id
		$grade_subject->grade_year_grade_year_id->CellCssStyle = ""; $grade_subject->grade_year_grade_year_id->CellCssClass = "";
		$grade_subject->grade_year_grade_year_id->CellAttrs = array(); $grade_subject->grade_year_grade_year_id->ViewAttrs = array(); $grade_subject->grade_year_grade_year_id->EditAttrs = array();
		if ($grade_subject->RowType == EW_ROWTYPE_VIEW) { // View row

			// grade_subject_id
			$grade_subject->grade_subject_id->ViewValue = $grade_subject->grade_subject_id->CurrentValue;
			$grade_subject->grade_subject_id->CssStyle = "";
			$grade_subject->grade_subject_id->CssClass = "";
			$grade_subject->grade_subject_id->ViewCustomAttributes = "";

			// subject
			$grade_subject->subject->ViewValue = $grade_subject->subject->CurrentValue;
			$grade_subject->subject->CssStyle = "";
			$grade_subject->subject->CssClass = "";
			$grade_subject->subject->ViewCustomAttributes = "";

			// raw_score
			$grade_subject->raw_score->ViewValue = $grade_subject->raw_score->CurrentValue;
			$grade_subject->raw_score->CssStyle = "";
			$grade_subject->raw_score->CssClass = "";
			$grade_subject->raw_score->ViewCustomAttributes = "";

			// letter_score
			$grade_subject->letter_score->ViewValue = $grade_subject->letter_score->CurrentValue;
			$grade_subject->letter_score->CssStyle = "";
			$grade_subject->letter_score->CssClass = "";
			$grade_subject->letter_score->ViewCustomAttributes = "";

			// letter_description
			$grade_subject->letter_description->ViewValue = $grade_subject->letter_description->CurrentValue;
			$grade_subject->letter_description->CssStyle = "";
			$grade_subject->letter_description->CssClass = "";
			$grade_subject->letter_description->ViewCustomAttributes = "";

			// grade_year_grade_year_id
			if (strval($grade_subject->grade_year_grade_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`grade_year_id` = " . ew_AdjustSql($grade_subject->grade_year_grade_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year` FROM `grade_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grade_subject->grade_year_grade_year_id->ViewValue = $rswrk->fields('year');
					$rswrk->Close();
				} else {
					$grade_subject->grade_year_grade_year_id->ViewValue = $grade_subject->grade_year_grade_year_id->CurrentValue;
				}
			} else {
				$grade_subject->grade_year_grade_year_id->ViewValue = NULL;
			}
			$grade_subject->grade_year_grade_year_id->CssStyle = "";
			$grade_subject->grade_year_grade_year_id->CssClass = "";
			$grade_subject->grade_year_grade_year_id->ViewCustomAttributes = "";

			// subject
			$grade_subject->subject->HrefValue = "";
			$grade_subject->subject->TooltipValue = "";

			// raw_score
			$grade_subject->raw_score->HrefValue = "";
			$grade_subject->raw_score->TooltipValue = "";

			// letter_score
			$grade_subject->letter_score->HrefValue = "";
			$grade_subject->letter_score->TooltipValue = "";

			// letter_description
			$grade_subject->letter_description->HrefValue = "";
			$grade_subject->letter_description->TooltipValue = "";

			// grade_year_grade_year_id
			$grade_subject->grade_year_grade_year_id->HrefValue = "";
			$grade_subject->grade_year_grade_year_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($grade_subject->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grade_subject->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $grade_subject;

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
		global $grade_subject;
		$grade_subject->grade_subject_id->AdvancedSearch->SearchValue = $grade_subject->getAdvancedSearch("x_grade_subject_id");
		$grade_subject->subject->AdvancedSearch->SearchValue = $grade_subject->getAdvancedSearch("x_subject");
		$grade_subject->raw_score->AdvancedSearch->SearchValue = $grade_subject->getAdvancedSearch("x_raw_score");
		$grade_subject->raw_score->AdvancedSearch->SearchOperator = $grade_subject->getAdvancedSearch("z_raw_score");
		$grade_subject->raw_score->AdvancedSearch->SearchCondition = $grade_subject->getAdvancedSearch("v_raw_score");
		$grade_subject->raw_score->AdvancedSearch->SearchValue2 = $grade_subject->getAdvancedSearch("y_raw_score");
		$grade_subject->raw_score->AdvancedSearch->SearchOperator2 = $grade_subject->getAdvancedSearch("w_raw_score");
		$grade_subject->letter_score->AdvancedSearch->SearchValue = $grade_subject->getAdvancedSearch("x_letter_score");
		$grade_subject->letter_description->AdvancedSearch->SearchValue = $grade_subject->getAdvancedSearch("x_letter_description");
		$grade_subject->grade_year_grade_year_id->AdvancedSearch->SearchValue = $grade_subject->getAdvancedSearch("x_grade_year_grade_year_id");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $grade_subject;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $grade_subject->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($grade_subject->ExportAll) {
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
		if ($grade_subject->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($grade_subject, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($grade_subject->grade_subject_id);
				$ExportDoc->ExportCaption($grade_subject->subject);
				$ExportDoc->ExportCaption($grade_subject->raw_score);
				$ExportDoc->ExportCaption($grade_subject->letter_score);
				$ExportDoc->ExportCaption($grade_subject->letter_description);
				$ExportDoc->ExportCaption($grade_subject->grade_year_grade_year_id);
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
				$grade_subject->CssClass = "";
				$grade_subject->CssStyle = "";
				$grade_subject->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($grade_subject->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('grade_subject_id', $grade_subject->grade_subject_id->ExportValue($grade_subject->Export, $grade_subject->ExportOriginalValue));
					$XmlDoc->AddField('subject', $grade_subject->subject->ExportValue($grade_subject->Export, $grade_subject->ExportOriginalValue));
					$XmlDoc->AddField('raw_score', $grade_subject->raw_score->ExportValue($grade_subject->Export, $grade_subject->ExportOriginalValue));
					$XmlDoc->AddField('letter_score', $grade_subject->letter_score->ExportValue($grade_subject->Export, $grade_subject->ExportOriginalValue));
					$XmlDoc->AddField('letter_description', $grade_subject->letter_description->ExportValue($grade_subject->Export, $grade_subject->ExportOriginalValue));
					$XmlDoc->AddField('grade_year_grade_year_id', $grade_subject->grade_year_grade_year_id->ExportValue($grade_subject->Export, $grade_subject->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($grade_subject->grade_subject_id);
					$ExportDoc->ExportField($grade_subject->subject);
					$ExportDoc->ExportField($grade_subject->raw_score);
					$ExportDoc->ExportField($grade_subject->letter_score);
					$ExportDoc->ExportField($grade_subject->letter_description);
					$ExportDoc->ExportField($grade_subject->grade_year_grade_year_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($grade_subject->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($grade_subject->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($grade_subject->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($grade_subject->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($grade_subject->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $grade_subject;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "grade_year") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $grade_subject->SqlMasterFilter_grade_year();
				$this->sDbDetailFilter = $grade_subject->SqlDetailFilter_grade_year();
				if (@$_GET["grade_year_id"] <> "") {
					$GLOBALS["grade_year"]->grade_year_id->setQueryStringValue($_GET["grade_year_id"]);
					$grade_subject->grade_year_grade_year_id->setQueryStringValue($GLOBALS["grade_year"]->grade_year_id->QueryStringValue);
					$grade_subject->grade_year_grade_year_id->setSessionValue($grade_subject->grade_year_grade_year_id->QueryStringValue);
					if (!is_numeric($GLOBALS["grade_year"]->grade_year_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@grade_year_id@", ew_AdjustSql($GLOBALS["grade_year"]->grade_year_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@grade_year_grade_year_id@", ew_AdjustSql($GLOBALS["grade_year"]->grade_year_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$grade_subject->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$grade_subject->setStartRecordNumber($this->lStartRec);
			$grade_subject->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$grade_subject->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "grade_year") {
				if ($grade_subject->grade_year_grade_year_id->QueryStringValue == "") $grade_subject->grade_year_grade_year_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $grade_subject->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $grade_subject->getDetailFilter(); // Restore detail filter
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
