<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "school_attendanceinfo.php" ?>
<?php include "sponsored_studentinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "sponsored_student_detailinfo.php" ?>
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
$school_attendance_view = new cschool_attendance_view();
$Page =& $school_attendance_view;

// Page init
$school_attendance_view->Page_Init();

// Page main
$school_attendance_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($school_attendance->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var school_attendance_view = new ew_Page("school_attendance_view");

// page properties
school_attendance_view.PageID = "view"; // page ID
school_attendance_view.FormID = "fschool_attendanceview"; // form ID
var EW_PAGE_ID = school_attendance_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
school_attendance_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
school_attendance_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
school_attendance_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $school_attendance->TableCaption() ?>
<br><br>
<?php if ($school_attendance->Export == "") { ?>
<a href="<?php echo $school_attendance_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<?php if ($school_attendance_view->ShowOptionLink()) { ?>
<a href="<?php echo $school_attendance_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<?php if ($school_attendance_view->ShowOptionLink()) { ?>
<a href="<?php echo $school_attendance_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php if ($Security->AllowList('grade_year')) { ?>
<?php if ($school_attendance_view->ShowOptionLink()) { ?>
<a href="grade_yearlist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=school_attendance&school_attendance_id=<?php echo urlencode(strval($school_attendance->school_attendance_id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("grade_year", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$school_attendance_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($school_attendance->school_attendance_id->Visible) { // school_attendance_id ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->school_attendance_id->FldCaption() ?></td>
		<td<?php echo $school_attendance->school_attendance_id->CellAttributes() ?>>
<div<?php echo $school_attendance->school_attendance_id->ViewAttributes() ?>><?php echo $school_attendance->school_attendance_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->start_date->Visible) { // start_date ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->start_date->FldCaption() ?></td>
		<td<?php echo $school_attendance->start_date->CellAttributes() ?>>
<div<?php echo $school_attendance->start_date->ViewAttributes() ?>><?php echo $school_attendance->start_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->end_date->Visible) { // end_date ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->end_date->FldCaption() ?></td>
		<td<?php echo $school_attendance->end_date->CellAttributes() ?>>
<div<?php echo $school_attendance->end_date->ViewAttributes() ?>><?php echo $school_attendance->end_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->schools_school_id->Visible) { // schools_school_id ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->schools_school_id->FldCaption() ?></td>
		<td<?php echo $school_attendance->schools_school_id->CellAttributes() ?>>
<div<?php echo $school_attendance->schools_school_id->ViewAttributes() ?>><?php echo $school_attendance->schools_school_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->entry_level->Visible) { // entry_level ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->entry_level->FldCaption() ?></td>
		<td<?php echo $school_attendance->entry_level->CellAttributes() ?>>
<div<?php echo $school_attendance->entry_level->ViewAttributes() ?>><?php echo $school_attendance->entry_level->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->entry_class->Visible) { // entry_class ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->entry_class->FldCaption() ?></td>
		<td<?php echo $school_attendance->entry_class->CellAttributes() ?>>
<div<?php echo $school_attendance->entry_class->ViewAttributes() ?>><?php echo $school_attendance->entry_class->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->sponsored_student_sponsored_student_id->Visible) { // sponsored_student_sponsored_student_id ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->sponsored_student_sponsored_student_id->FldCaption() ?></td>
		<td<?php echo $school_attendance->sponsored_student_sponsored_student_id->CellAttributes() ?>>
<div<?php echo $school_attendance->sponsored_student_sponsored_student_id->ViewAttributes() ?>><?php echo $school_attendance->sponsored_student_sponsored_student_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->program->Visible) { // program ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->program->FldCaption() ?></td>
		<td<?php echo $school_attendance->program->CellAttributes() ?>>
<div<?php echo $school_attendance->program->ViewAttributes() ?>><?php echo $school_attendance->program->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->attendance_type->Visible) { // attendance_type ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->attendance_type->FldCaption() ?></td>
		<td<?php echo $school_attendance->attendance_type->CellAttributes() ?>>
<div<?php echo $school_attendance->attendance_type->ViewAttributes() ?>><?php echo $school_attendance->attendance_type->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->group_id->Visible) { // group_id ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->group_id->FldCaption() ?></td>
		<td<?php echo $school_attendance->group_id->CellAttributes() ?>>
<div<?php echo $school_attendance->group_id->ViewAttributes() ?>><?php echo $school_attendance->group_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($school_attendance->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$school_attendance_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cschool_attendance_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'school_attendance';

	// Page object name
	var $PageObjName = 'school_attendance_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $school_attendance;
		if ($school_attendance->UseTokenInUrl) $PageUrl .= "t=" . $school_attendance->TableVar . "&"; // Add page token
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
		global $objForm, $school_attendance;
		if ($school_attendance->UseTokenInUrl) {
			if ($objForm)
				return ($school_attendance->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($school_attendance->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cschool_attendance_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (school_attendance)
		$GLOBALS["school_attendance"] = new cschool_attendance();

		// Table object (sponsored_student)
		$GLOBALS['sponsored_student'] = new csponsored_student();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (sponsored_student_detail)
		$GLOBALS['sponsored_student_detail'] = new csponsored_student_detail();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'school_attendance', TRUE);

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
		global $school_attendance;

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
			$this->Page_Terminate("school_attendancelist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("school_attendancelist.php");
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
		global $Language, $school_attendance;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["school_attendance_id"] <> "") {
				$school_attendance->school_attendance_id->setQueryStringValue($_GET["school_attendance_id"]);
				$this->arRecKey["school_attendance_id"] = $school_attendance->school_attendance_id->QueryStringValue;
			} else {
				$sReturnUrl = "school_attendancelist.php"; // Return to list
			}

			// Get action
			$school_attendance->CurrentAction = "I"; // Display form
			switch ($school_attendance->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "school_attendancelist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "school_attendancelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$school_attendance->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $school_attendance;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$school_attendance->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$school_attendance->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $school_attendance->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$school_attendance->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$school_attendance->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$school_attendance->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $school_attendance;
		$sFilter = $school_attendance->KeyFilter();

		// Call Row Selecting event
		$school_attendance->Row_Selecting($sFilter);

		// Load SQL based on filter
		$school_attendance->CurrentFilter = $sFilter;
		$sSql = $school_attendance->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$school_attendance->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $school_attendance;
		$school_attendance->school_attendance_id->setDbValue($rs->fields('school_attendance_id'));
		$school_attendance->start_date->setDbValue($rs->fields('start_date'));
		$school_attendance->end_date->setDbValue($rs->fields('end_date'));
		$school_attendance->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$school_attendance->entry_level->setDbValue($rs->fields('entry_level'));
		$school_attendance->entry_class->setDbValue($rs->fields('entry_class'));
		$school_attendance->sponsored_student_sponsored_student_id->setDbValue($rs->fields('sponsored_student_sponsored_student_id'));
		$school_attendance->program->setDbValue($rs->fields('program'));
		$school_attendance->attendance_type->setDbValue($rs->fields('attendance_type'));
		$school_attendance->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $school_attendance;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "school_attendance_id=" . urlencode($school_attendance->school_attendance_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "school_attendance_id=" . urlencode($school_attendance->school_attendance_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "school_attendance_id=" . urlencode($school_attendance->school_attendance_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "school_attendance_id=" . urlencode($school_attendance->school_attendance_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "school_attendance_id=" . urlencode($school_attendance->school_attendance_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "school_attendance_id=" . urlencode($school_attendance->school_attendance_id->CurrentValue);
		$this->AddUrl = $school_attendance->AddUrl();
		$this->EditUrl = $school_attendance->EditUrl();
		$this->CopyUrl = $school_attendance->CopyUrl();
		$this->DeleteUrl = $school_attendance->DeleteUrl();
		$this->ListUrl = $school_attendance->ListUrl();

		// Call Row_Rendering event
		$school_attendance->Row_Rendering();

		// Common render codes for all row types
		// school_attendance_id

		$school_attendance->school_attendance_id->CellCssStyle = ""; $school_attendance->school_attendance_id->CellCssClass = "";
		$school_attendance->school_attendance_id->CellAttrs = array(); $school_attendance->school_attendance_id->ViewAttrs = array(); $school_attendance->school_attendance_id->EditAttrs = array();

		// start_date
		$school_attendance->start_date->CellCssStyle = ""; $school_attendance->start_date->CellCssClass = "";
		$school_attendance->start_date->CellAttrs = array(); $school_attendance->start_date->ViewAttrs = array(); $school_attendance->start_date->EditAttrs = array();

		// end_date
		$school_attendance->end_date->CellCssStyle = ""; $school_attendance->end_date->CellCssClass = "";
		$school_attendance->end_date->CellAttrs = array(); $school_attendance->end_date->ViewAttrs = array(); $school_attendance->end_date->EditAttrs = array();

		// schools_school_id
		$school_attendance->schools_school_id->CellCssStyle = ""; $school_attendance->schools_school_id->CellCssClass = "";
		$school_attendance->schools_school_id->CellAttrs = array(); $school_attendance->schools_school_id->ViewAttrs = array(); $school_attendance->schools_school_id->EditAttrs = array();

		// entry_level
		$school_attendance->entry_level->CellCssStyle = ""; $school_attendance->entry_level->CellCssClass = "";
		$school_attendance->entry_level->CellAttrs = array(); $school_attendance->entry_level->ViewAttrs = array(); $school_attendance->entry_level->EditAttrs = array();

		// entry_class
		$school_attendance->entry_class->CellCssStyle = ""; $school_attendance->entry_class->CellCssClass = "";
		$school_attendance->entry_class->CellAttrs = array(); $school_attendance->entry_class->ViewAttrs = array(); $school_attendance->entry_class->EditAttrs = array();

		// sponsored_student_sponsored_student_id
		$school_attendance->sponsored_student_sponsored_student_id->CellCssStyle = ""; $school_attendance->sponsored_student_sponsored_student_id->CellCssClass = "";
		$school_attendance->sponsored_student_sponsored_student_id->CellAttrs = array(); $school_attendance->sponsored_student_sponsored_student_id->ViewAttrs = array(); $school_attendance->sponsored_student_sponsored_student_id->EditAttrs = array();

		// program
		$school_attendance->program->CellCssStyle = ""; $school_attendance->program->CellCssClass = "";
		$school_attendance->program->CellAttrs = array(); $school_attendance->program->ViewAttrs = array(); $school_attendance->program->EditAttrs = array();

		// attendance_type
		$school_attendance->attendance_type->CellCssStyle = ""; $school_attendance->attendance_type->CellCssClass = "";
		$school_attendance->attendance_type->CellAttrs = array(); $school_attendance->attendance_type->ViewAttrs = array(); $school_attendance->attendance_type->EditAttrs = array();

		// group_id
		$school_attendance->group_id->CellCssStyle = ""; $school_attendance->group_id->CellCssClass = "";
		$school_attendance->group_id->CellAttrs = array(); $school_attendance->group_id->ViewAttrs = array(); $school_attendance->group_id->EditAttrs = array();
		if ($school_attendance->RowType == EW_ROWTYPE_VIEW) { // View row

			// school_attendance_id
			$school_attendance->school_attendance_id->ViewValue = $school_attendance->school_attendance_id->CurrentValue;
			$school_attendance->school_attendance_id->CssStyle = "";
			$school_attendance->school_attendance_id->CssClass = "";
			$school_attendance->school_attendance_id->ViewCustomAttributes = "";

			// start_date
			$school_attendance->start_date->ViewValue = $school_attendance->start_date->CurrentValue;
			$school_attendance->start_date->ViewValue = ew_FormatDateTime($school_attendance->start_date->ViewValue, 7);
			$school_attendance->start_date->CssStyle = "";
			$school_attendance->start_date->CssClass = "";
			$school_attendance->start_date->ViewCustomAttributes = "";

			// end_date
			$school_attendance->end_date->ViewValue = $school_attendance->end_date->CurrentValue;
			$school_attendance->end_date->ViewValue = ew_FormatDateTime($school_attendance->end_date->ViewValue, 7);
			$school_attendance->end_date->CssStyle = "";
			$school_attendance->end_date->CssClass = "";
			$school_attendance->end_date->ViewCustomAttributes = "";

			// schools_school_id
			if (strval($school_attendance->schools_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($school_attendance->schools_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$school_attendance->schools_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$school_attendance->schools_school_id->ViewValue = $school_attendance->schools_school_id->CurrentValue;
				}
			} else {
				$school_attendance->schools_school_id->ViewValue = NULL;
			}
			$school_attendance->schools_school_id->CssStyle = "";
			$school_attendance->schools_school_id->CssClass = "";
			$school_attendance->schools_school_id->ViewCustomAttributes = "";

			// entry_level
			if (strval($school_attendance->entry_level->CurrentValue) <> "") {
				switch ($school_attendance->entry_level->CurrentValue) {
					case "SSS":
						$school_attendance->entry_level->ViewValue = "SSS";
						break;
					case "TERTIARY":
						$school_attendance->entry_level->ViewValue = "TERTIARY";
						break;
					case "JSS":
						$school_attendance->entry_level->ViewValue = "JSS";
						break;
					case "PRIMARY":
						$school_attendance->entry_level->ViewValue = "PRIMARY";
						break;
					default:
						$school_attendance->entry_level->ViewValue = $school_attendance->entry_level->CurrentValue;
				}
			} else {
				$school_attendance->entry_level->ViewValue = NULL;
			}
			$school_attendance->entry_level->CssStyle = "";
			$school_attendance->entry_level->CssClass = "";
			$school_attendance->entry_level->ViewCustomAttributes = "";

			// entry_class
			$school_attendance->entry_class->ViewValue = $school_attendance->entry_class->CurrentValue;
			$school_attendance->entry_class->CssStyle = "";
			$school_attendance->entry_class->CssClass = "";
			$school_attendance->entry_class->ViewCustomAttributes = "";

			// sponsored_student_sponsored_student_id
			if (strval($school_attendance->sponsored_student_sponsored_student_id->CurrentValue) <> "") {
				$sFilterWrk = "`sponsored_student_id` = " . ew_AdjustSql($school_attendance->sponsored_student_sponsored_student_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `student_lastname`, `student_firstname` FROM `sponsored_student`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$school_attendance->sponsored_student_sponsored_student_id->ViewValue = $rswrk->fields('student_lastname');
					$school_attendance->sponsored_student_sponsored_student_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('student_firstname');
					$rswrk->Close();
				} else {
					$school_attendance->sponsored_student_sponsored_student_id->ViewValue = $school_attendance->sponsored_student_sponsored_student_id->CurrentValue;
				}
			} else {
				$school_attendance->sponsored_student_sponsored_student_id->ViewValue = NULL;
			}
			$school_attendance->sponsored_student_sponsored_student_id->CssStyle = "";
			$school_attendance->sponsored_student_sponsored_student_id->CssClass = "";
			$school_attendance->sponsored_student_sponsored_student_id->ViewCustomAttributes = "";

			// program
			$school_attendance->program->ViewValue = $school_attendance->program->CurrentValue;
			$school_attendance->program->CssStyle = "";
			$school_attendance->program->CssClass = "";
			$school_attendance->program->ViewCustomAttributes = "";

			// attendance_type
			if (strval($school_attendance->attendance_type->CurrentValue) <> "") {
				switch ($school_attendance->attendance_type->CurrentValue) {
					case "BOARDER":
						$school_attendance->attendance_type->ViewValue = "BOARDER";
						break;
					case "DAY":
						$school_attendance->attendance_type->ViewValue = "DAY";
						break;
					default:
						$school_attendance->attendance_type->ViewValue = $school_attendance->attendance_type->CurrentValue;
				}
			} else {
				$school_attendance->attendance_type->ViewValue = NULL;
			}
			$school_attendance->attendance_type->CssStyle = "";
			$school_attendance->attendance_type->CssClass = "";
			$school_attendance->attendance_type->ViewCustomAttributes = "";

			// group_id
			$school_attendance->group_id->ViewValue = $school_attendance->group_id->CurrentValue;
			$school_attendance->group_id->CssStyle = "";
			$school_attendance->group_id->CssClass = "";
			$school_attendance->group_id->ViewCustomAttributes = "";

			// school_attendance_id
			$school_attendance->school_attendance_id->HrefValue = "";
			$school_attendance->school_attendance_id->TooltipValue = "";

			// start_date
			$school_attendance->start_date->HrefValue = "";
			$school_attendance->start_date->TooltipValue = "";

			// end_date
			$school_attendance->end_date->HrefValue = "";
			$school_attendance->end_date->TooltipValue = "";

			// schools_school_id
			$school_attendance->schools_school_id->HrefValue = "";
			$school_attendance->schools_school_id->TooltipValue = "";

			// entry_level
			$school_attendance->entry_level->HrefValue = "";
			$school_attendance->entry_level->TooltipValue = "";

			// entry_class
			$school_attendance->entry_class->HrefValue = "";
			$school_attendance->entry_class->TooltipValue = "";

			// sponsored_student_sponsored_student_id
			$school_attendance->sponsored_student_sponsored_student_id->HrefValue = "";
			$school_attendance->sponsored_student_sponsored_student_id->TooltipValue = "";

			// program
			$school_attendance->program->HrefValue = "";
			$school_attendance->program->TooltipValue = "";

			// attendance_type
			$school_attendance->attendance_type->HrefValue = "";
			$school_attendance->attendance_type->TooltipValue = "";

			// group_id
			$school_attendance->group_id->HrefValue = "";
			$school_attendance->group_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($school_attendance->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$school_attendance->Row_Rendered();
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $school_attendance;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($school_attendance->group_id->CurrentValue);
			}
		}
		return TRUE;
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
