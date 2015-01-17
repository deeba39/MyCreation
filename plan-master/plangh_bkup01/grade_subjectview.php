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
$grade_subject_view = new cgrade_subject_view();
$Page =& $grade_subject_view;

// Page init
$grade_subject_view->Page_Init();

// Page main
$grade_subject_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($grade_subject->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var grade_subject_view = new ew_Page("grade_subject_view");

// page properties
grade_subject_view.PageID = "view"; // page ID
grade_subject_view.FormID = "fgrade_subjectview"; // form ID
var EW_PAGE_ID = grade_subject_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
grade_subject_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grade_subject_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grade_subject_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grade_subject->TableCaption() ?>
<br><br>
<?php if ($grade_subject->Export == "") { ?>
<a href="<?php echo $grade_subject_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $grade_subject_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $grade_subject_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $grade_subject_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$grade_subject_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($grade_subject->grade_subject_id->Visible) { // grade_subject_id ?>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->grade_subject_id->FldCaption() ?></td>
		<td<?php echo $grade_subject->grade_subject_id->CellAttributes() ?>>
<div<?php echo $grade_subject->grade_subject_id->ViewAttributes() ?>><?php echo $grade_subject->grade_subject_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($grade_subject->subject->Visible) { // subject ?>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->subject->FldCaption() ?></td>
		<td<?php echo $grade_subject->subject->CellAttributes() ?>>
<div<?php echo $grade_subject->subject->ViewAttributes() ?>><?php echo $grade_subject->subject->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($grade_subject->raw_score->Visible) { // raw_score ?>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->raw_score->FldCaption() ?></td>
		<td<?php echo $grade_subject->raw_score->CellAttributes() ?>>
<div<?php echo $grade_subject->raw_score->ViewAttributes() ?>><?php echo $grade_subject->raw_score->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($grade_subject->letter_score->Visible) { // letter_score ?>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->letter_score->FldCaption() ?></td>
		<td<?php echo $grade_subject->letter_score->CellAttributes() ?>>
<div<?php echo $grade_subject->letter_score->ViewAttributes() ?>><?php echo $grade_subject->letter_score->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($grade_subject->letter_description->Visible) { // letter_description ?>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->letter_description->FldCaption() ?></td>
		<td<?php echo $grade_subject->letter_description->CellAttributes() ?>>
<div<?php echo $grade_subject->letter_description->ViewAttributes() ?>><?php echo $grade_subject->letter_description->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($grade_subject->grade_year_grade_year_id->Visible) { // grade_year_grade_year_id ?>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->grade_year_grade_year_id->FldCaption() ?></td>
		<td<?php echo $grade_subject->grade_year_grade_year_id->CellAttributes() ?>>
<div<?php echo $grade_subject->grade_year_grade_year_id->ViewAttributes() ?>><?php echo $grade_subject->grade_year_grade_year_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$grade_subject_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrade_subject_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'grade_subject';

	// Page object name
	var $PageObjName = 'grade_subject_view';

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
	function cgrade_subject_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (grade_subject)
		$GLOBALS["grade_subject"] = new cgrade_subject();

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
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grade_subject', TRUE);

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
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("grade_subjectlist.php");
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
		global $Language, $grade_subject;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["grade_subject_id"] <> "") {
				$grade_subject->grade_subject_id->setQueryStringValue($_GET["grade_subject_id"]);
				$this->arRecKey["grade_subject_id"] = $grade_subject->grade_subject_id->QueryStringValue;
			} else {
				$sReturnUrl = "grade_subjectlist.php"; // Return to list
			}

			// Get action
			$grade_subject->CurrentAction = "I"; // Display form
			switch ($grade_subject->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "grade_subjectlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "grade_subjectlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$grade_subject->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "grade_subject_id=" . urlencode($grade_subject->grade_subject_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "grade_subject_id=" . urlencode($grade_subject->grade_subject_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "grade_subject_id=" . urlencode($grade_subject->grade_subject_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "grade_subject_id=" . urlencode($grade_subject->grade_subject_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "grade_subject_id=" . urlencode($grade_subject->grade_subject_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "grade_subject_id=" . urlencode($grade_subject->grade_subject_id->CurrentValue);
		$this->AddUrl = $grade_subject->AddUrl();
		$this->EditUrl = $grade_subject->EditUrl();
		$this->CopyUrl = $grade_subject->CopyUrl();
		$this->DeleteUrl = $grade_subject->DeleteUrl();
		$this->ListUrl = $grade_subject->ListUrl();

		// Call Row_Rendering event
		$grade_subject->Row_Rendering();

		// Common render codes for all row types
		// grade_subject_id

		$grade_subject->grade_subject_id->CellCssStyle = ""; $grade_subject->grade_subject_id->CellCssClass = "";
		$grade_subject->grade_subject_id->CellAttrs = array(); $grade_subject->grade_subject_id->ViewAttrs = array(); $grade_subject->grade_subject_id->EditAttrs = array();

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

			// grade_subject_id
			$grade_subject->grade_subject_id->HrefValue = "";
			$grade_subject->grade_subject_id->TooltipValue = "";

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
