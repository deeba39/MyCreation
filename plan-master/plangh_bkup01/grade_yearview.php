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
$grade_year_view = new cgrade_year_view();
$Page =& $grade_year_view;

// Page init
$grade_year_view->Page_Init();

// Page main
$grade_year_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($grade_year->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var grade_year_view = new ew_Page("grade_year_view");

// page properties
grade_year_view.PageID = "view"; // page ID
grade_year_view.FormID = "fgrade_yearview"; // form ID
var EW_PAGE_ID = grade_year_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
grade_year_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grade_year_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grade_year_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grade_year->TableCaption() ?>
<br><br>
<?php if ($grade_year->Export == "") { ?>
<a href="<?php echo $grade_year_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $grade_year_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $grade_year_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $grade_year_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('grade_subject')) { ?>
<a href="grade_subjectlist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=grade_year&grade_year_id=<?php echo urlencode(strval($grade_year->grade_year_id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("grade_subject", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$grade_year_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($grade_year->class->Visible) { // class ?>
	<tr<?php echo $grade_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_year->class->FldCaption() ?></td>
		<td<?php echo $grade_year->class->CellAttributes() ?>>
<div<?php echo $grade_year->class->ViewAttributes() ?>><?php echo $grade_year->class->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($grade_year->year->Visible) { // year ?>
	<tr<?php echo $grade_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_year->year->FldCaption() ?></td>
		<td<?php echo $grade_year->year->CellAttributes() ?>>
<div<?php echo $grade_year->year->ViewAttributes() ?>><?php echo $grade_year->year->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($grade_year->promoted->Visible) { // promoted ?>
	<tr<?php echo $grade_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_year->promoted->FldCaption() ?></td>
		<td<?php echo $grade_year->promoted->CellAttributes() ?>>
<div<?php echo $grade_year->promoted->ViewAttributes() ?>><?php echo $grade_year->promoted->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($grade_year->programme->Visible) { // programme ?>
	<tr<?php echo $grade_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_year->programme->FldCaption() ?></td>
		<td<?php echo $grade_year->programme->CellAttributes() ?>>
<div<?php echo $grade_year->programme->ViewAttributes() ?>><?php echo $grade_year->programme->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($grade_year->school_attendance_school_attendance_id->Visible) { // school_attendance_school_attendance_id ?>
	<tr<?php echo $grade_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_year->school_attendance_school_attendance_id->FldCaption() ?></td>
		<td<?php echo $grade_year->school_attendance_school_attendance_id->CellAttributes() ?>>
<div<?php echo $grade_year->school_attendance_school_attendance_id->ViewAttributes() ?>><?php echo $grade_year->school_attendance_school_attendance_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$grade_year_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrade_year_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'grade_year';

	// Page object name
	var $PageObjName = 'grade_year_view';

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
	function cgrade_year_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (grade_year)
		$GLOBALS["grade_year"] = new cgrade_year();

		// Table object (sponsored_student)
		$GLOBALS['sponsored_student'] = new csponsored_student();

		// Table object (school_attendance)
		$GLOBALS['school_attendance'] = new cschool_attendance();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grade_year', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
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
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("grade_yearlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

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
	var $lDisplayRecs = 1;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $lRecCnt;
	var $arRecKey = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $grade_year;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["grade_year_id"] <> "") {
				$grade_year->grade_year_id->setQueryStringValue($_GET["grade_year_id"]);
				$this->arRecKey["grade_year_id"] = $grade_year->grade_year_id->QueryStringValue;
			} else {
				$sReturnUrl = "grade_yearlist.php"; // Return to list
			}

			// Get action
			$grade_year->CurrentAction = "I"; // Display form
			switch ($grade_year->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "grade_yearlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "grade_yearlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$grade_year->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "grade_year_id=" . urlencode($grade_year->grade_year_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "grade_year_id=" . urlencode($grade_year->grade_year_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "grade_year_id=" . urlencode($grade_year->grade_year_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "grade_year_id=" . urlencode($grade_year->grade_year_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "grade_year_id=" . urlencode($grade_year->grade_year_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "grade_year_id=" . urlencode($grade_year->grade_year_id->CurrentValue);
		$this->AddUrl = $grade_year->AddUrl();
		$this->EditUrl = $grade_year->EditUrl();
		$this->CopyUrl = $grade_year->CopyUrl();
		$this->DeleteUrl = $grade_year->DeleteUrl();
		$this->ListUrl = $grade_year->ListUrl();

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

		// school_attendance_school_attendance_id
		$grade_year->school_attendance_school_attendance_id->CellCssStyle = ""; $grade_year->school_attendance_school_attendance_id->CellCssClass = "";
		$grade_year->school_attendance_school_attendance_id->CellAttrs = array(); $grade_year->school_attendance_school_attendance_id->ViewAttrs = array(); $grade_year->school_attendance_school_attendance_id->EditAttrs = array();
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

			// school_attendance_school_attendance_id
			$grade_year->school_attendance_school_attendance_id->HrefValue = "";
			$grade_year->school_attendance_school_attendance_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($grade_year->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grade_year->Row_Rendered();
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
}
?>
